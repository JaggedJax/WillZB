<?php
class sabnzbd_helper{

	var $username;
	var $password;
	var $apikey;
	var $host;
	var $port;
	var $useapi;
	
	//*************************************************************************
	// Constructor. Takes smarty object and loads config data
	//*************************************************************************
	function __construct(&$smarty) {
		$this->username = $smarty->getConfigVars('sab_username');
		$this->password = base64_decode($smarty->getConfigVars('sab_password'));
		$this->apikey = $smarty->getConfigVars('sab_apikey');
		$this->host = $smarty->getConfigVars('sab_host');
		$this->port = $smarty->getConfigVars('sab_port');
		$this->useapi = ($this->apikey) ? true : false;
	}
	
	//*************************************************************************
	// Authenticates if username/password are being used
	//*************************************************************************
	function authenticate(){
		$response = http_get("http://{$this->host}:{$this->port}/sabnzbd/api?mode=auth", array("timeout"=>10));
		switch (strtolower(trim(http_parse_message($response)->body))){
			case 'apikey': $this->useapi = true; return true;
			case 'none': $this->useapi = false; return true;
			case 'login':
				$this->useapi = false;
				$response = http_get("http://{$this->host}:{$this->port}/sabnzbd/api?mode=queue&output=xml&ma_username={$this->username}&ma_password={$this->password}",
					array("timeout"=>15));
				if (strtolower(substr(http_parse_message($response)->body, 0, 5)) == 'error')
					return http_parse_message($response)->body;
				else
					return true;
		}
		return "Could not connect: ".http_parse_message($response)->body;
	}
	
	//*************************************************************************
	// Gets items and details in queue. Returns a SimpleXMLElement object
	//*************************************************************************
	function get_queue($start=0, $limit=0){
		$url = "http://{$this->host}:{$this->port}/sabnzbd/api?mode=queue&output=xml";
		if ($start)
			$url .= "&start=".$start;
		if ($limit)
			$url .= "&limit=".$limit;
		if ($this->useapi)
			$url .= "&apikey=".$this->apikey;
		$response = http_get($url, array("timeout"=>20));
		return simplexml_load_string(trim(http_parse_message($response)->body));
	}
	
	//*************************************************************************
	// Gets items and details in history. Returns a SimpleXMLElement object
	//*************************************************************************
	function get_history($start=0, $limit=0){
		$url = "http://{$this->host}:{$this->port}/sabnzbd/api?mode=history&output=xml";
		if ($start)
			$url .= "&start=".$start;
		if ($limit)
			$url .= "&limit=".$limit;
		if ($this->useapi)
			$url .= "&apikey=".$this->apikey;
		$response = http_get($url, array("timeout"=>20));
		return simplexml_load_string(trim(http_parse_message($response)->body));
	}
	
	//*************************************************************************
	// Pause everything. Specify a time in minutes to make it temporary
	//*************************************************************************
	function pause_all($time=0){
		if ($time)
			$url = "http://{$this->host}:{$this->port}/sabnzbd/api?mode=config&name=set_pause&value=$time";
		else
			$url = "http://{$this->host}:{$this->port}/sabnzbd/api?mode=pause";
		if ($this->useapi)
			$url .= "&apikey=".$this->apikey;
		$response = http_get($url, array("timeout"=>10));
		return true;
	}
	
	//*************************************************************************
	// Resume everything
	//*************************************************************************
	function resume_all(){
		$url = "http://{$this->host}:{$this->port}/sabnzbd/api?mode=resume";
		if ($this->useapi)
			$url .= "&apikey=".$this->apikey;
		$response = http_get($url, array("timeout"=>10));
		return true;
	}
	
	//*************************************************************************
	// Pause download with specific id
	//*************************************************************************
	function pause_id($id){
		$url = "http://{$this->host}:{$this->port}/sabnzbd/api?mode=queue&name=pause&value=$id";
		if ($this->useapi)
			$url .= "&apikey=".$this->apikey;
		$response = http_get($url, array("timeout"=>10));
		return true;
	}
	
	//*************************************************************************
	// Resume download with specific id
	//*************************************************************************
	function resume_id($id){
		$url = "http://{$this->host}:{$this->port}/sabnzbd/api?mode=queue&name=resume&value=$id";
		if ($this->useapi)
			$url .= "&apikey=".$this->apikey;
		$response = http_get($url, array("timeout"=>10));
		return true;
	}
	
	//*************************************************************************
	// Retry download with specific id
	//*************************************************************************
	function retry_id($id){
		$url = "http://{$this->host}:{$this->port}/sabnzbd/api?mode=retry&value=$id";
		if ($this->useapi)
			$url .= "&apikey=".$this->apikey;
		$response = http_get($url, array("timeout"=>10));
		return true;
	}
	
	//*************************************************************************
	// Delete file with specific id, from queue or history
	//*************************************************************************
	function delete_id($id, $mode){
		$url = "http://{$this->host}:{$this->port}/sabnzbd/api?mode=$mode&name=delete&value=$id";
		if ($this->useapi)
			$url .= "&apikey=".$this->apikey;
		$response = http_get($url, array("timeout"=>10));
		return true;
	}
	//*************************************************************************
	// Move queued item with specific id to given location in list
	//*************************************************************************
	function move_id($id, $pos){
		$url = "http://{$this->host}:{$this->port}/sabnzbd/api?mode=switch&value=$id&value2=$pos";
		if ($this->useapi)
			$url .= "&apikey=".$this->apikey;
		$response = http_get($url, array("timeout"=>10));
		return true;
	}
}
?>
