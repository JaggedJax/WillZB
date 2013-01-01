<?php
class nzb_helper{

	var $username;
	var $apikey;
	var $sitename;
	var $siteurl;
	var $watch_dir;
	var $temp_dir;
	var $nzb_errors;
	
	//*************************************************************************
	// Constructor. Takes smarty object and loads config data
	//*************************************************************************
	function __construct($smarty) {
		$this->username = $smarty->getConfigVars('nzb_username');
		$this->apikey = $smarty->getConfigVars('nzb_apikey');
		$this->sitename = $smarty->getConfigVars('nzb_sitename');
		$this->siteurl = $smarty->getConfigVars('nzb_siteurl');
		$this->watch_dir = $smarty->getConfigVars('watch_dir');
		$this->temp_dir = $smarty->getConfigVars('temp_dir');
		
		$this->nzb_errors = array('error:invalid_login' => 'There is a problem with the username',
			'error:invalid_api' => 'There is a problem with the API Key', 
			'error:invalid_nzbid' => 'There is a problem with the requested report id',
			'error:vip_only' => 'You need to be VIP or higher to access', 
			'error:disabled_account' => 'User Account Disabled',
			'error:no_nzb_found' => 'No NZB file found',
			'error:no_search' => 'Missing search query',
			'error:nothing_found' => 'No results found');
	}

	//*************************************************************************
	// Check if body of returned post contains a nzbmatrix api error
	// If so return a friendly message
	//*************************************************************************
	function check_api_error($body){
		$error = @simplexml_load_string($body);
		if ($error && $error->getName() == 'error'){
			$attrs = $error->attributes();
			return 'Status '.$attrs['code'].' - '.$attrs['description'];
		}
		
		return false;
		$body = substr($body, 0, 25);
		$message = "";
		if (isset($this->nzb_errors[$body]))
			$message = $this->nzb_errors[$body];
		else if (substr($body, 7) == '_daily_limit')
			$message = "You have reached the daily download limit";
		else if (substr($body, 0, 17) == 'error:please_wait_')
			$message = "Please wait ".substr($body, 18)." seconds before retrying";
		return $message;
	}

	//*************************************************************************
	// Add nzb to queue given url
	//*************************************************************************
	function add_nzb_url($url){
		$matches = array();
		preg_match('@^(?:https?://)?([^/]+)@i',$url, $matches);
		$base_url = $matches[0];
		if (in_array($base_url, $this->siteurl)){
			// get host name from URL
			$pos = strpos($url, 'getnzb')+7;
			$end = strpos($url, '/', $pos);
			if ($end)
				$id = substr($url, $pos, $end-$pos);
			else
				$id = substr($url, $pos);
			return $this->add_nzb_id($base_url, $id);
		}
		//else if (is_numeric($url))
		//	return $this->add_nzb_id($base_url, $url);
		else
			return "ERROR: Unsupported Site";
	}
	
	//*************************************************************************
	// Add nzb to queue given NZBMatrix id
	//*************************************************************************
	function add_nzb_id($base_url, $id){
		list($filename, $body, $message) = $this->download_nzb_id($base_url, $id);
		if ($message)
			return $message;
		else{
			$fh = fopen($this->temp_dir.$filename, 'w');
			fwrite($fh, $body);
			fclose($fh);
			// Move file
			if (!rename($this->temp_dir.$filename, $this->watch_dir.$filename))
				return "ERROR: Failed to move file.";
			else
				return "<i>$filename</i> added";
		
		}
	}
	
	//*************************************************************************
	// Download and return nzb file for given NZBMatrix id
	//*************************************************************************
	function download_nzb_id($base_url, $id, $url=null, $attempts=0){
		if ($attempts > 3){
			return array(null, null, 'Error: Too Many Redirects.');
		}
		else if ($url){
			$response = http_get($url, array("timeout"=>600));
		}
		else{
			$username = $this->get_param_from_base($base_url, 'username');
			$apikey = $this->get_param_from_base($base_url, 'apikey');
			//$response = http_get("http://api.nzbmatrix.com/v1.1/download.php?id=$id&username={$this->username}&apikey={$this->apikey}",
			$response = http_get("$base_url/api?t=get&id=$id&username={$username}&apikey={$apikey}",
				array("timeout"=>600));
		}
		if (!$response) // http get failed
			return array(null, null, 'ERROR: Failed to get file. Attempt at '.$base_url.': '.($attempts+1));
		else
		{
			$raw = $response;
			$response = http_parse_message($response);
			$temp = $response->headers;
			if ($response->responseCode != 200 && $temp['Location']){
				return $this->download_nzb_id(null, null, $base_url.$temp['Location'], ($attempts+1));
			}
			$body = $response->body;
			unset($response);
			$message = $this->check_api_error($body);
			if ($message)
				return array(null, null, "ERROR: ".$message);
			else{	// Content returned
				$pos = strpos($temp['Content-Disposition'], 'filename=')+10;
				$filename = substr($temp['Content-Disposition'], $pos, strpos($temp['Content-Disposition'], '"', $pos)-$pos);
				return array($filename, $body, null);
			}
		}
	}
	
	/**
	 * Get the correct parameter given a base_url
	 * @param type $base_url
	 * @param type $param
	 * @return boolean
	 */
	function get_param_from_base($base_url, $param){
		$base_url = trim(substr($base_url, strpos($base_url, '\\\\')),'\\');
		$count=0;
		foreach($this->siteurl as $url){
			if ($base_url == trim(substr($url, strpos($url, '\\\\')),'\\')){
				return $this->{$param}[$count];
			}
			$count++;
		}
		return false;
	}
	
	//*************************************************************************
	// Return a human readable time period
	//*************************************************************************
	function seconds_to_readable($sec){
		$hms = "";
		
		// Days Old
		$time = intval(intval($sec) / 86400);
		if ($time >= 1)
			return "$time d";
		// Hours Old
		$time = intval(intval($sec) / 3600);
		if ($time >= 1)
			return "$time hr";
		// Minutes Old
		$time = intval(intval($sec) / 60);
		if ($time >= 1)
			return "$time m";
		
		return "Just Now!";
	}

}
?>
