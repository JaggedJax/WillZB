<?php

$siteurl = $_REQUEST['siteurl'];
$sitename = $_REQUEST['sitename'];
$username = $_REQUEST['username'];
$apikey = $_REQUEST['apikey'];
$query = urlencode($_REQUEST['query']);
$searchin = $_REQUEST['searchin'];
$category = $_REQUEST['category'];
$error = false;

$nh = new nzb_helper($smarty);

$searchUrl = "$siteurl/index.php?page=api&t=search&q=$query&englishonly=1&num=5&username={$username}&apikey={$apikey}&searchin=$searchin&o=json";
// Optional parameters
if ($category && $category != "0")
	$searchUrl .= "&cat=$category";
$searchUrl .= '&attrs=comments,language,coverurl,usenetdate,group,grabs';
try{
	ob_start();
	$response = http_get($searchUrl);
	//echo "CALL: $searchUrl<br>RESULT: $response";
	$body = http_parse_message($response)->body;
	$response = json_decode($body, true);
	//echo 'Call: '.$searchUrl.'<br>Response: '.print_r($response['channel']['item'][0], true).'<br>';
	$message = $nh->check_api_error($body);
	unset($body);
	$results = array();
	if(ob_get_contents()){
		$error = true;
	}
	ob_end_clean();
}catch(Exception $e){
	$message = 'Bad response from server';
}
if($response === null || $error === true){
	$message = 'Bad response from server';
}
// Format data
$c = 0;
$data = $response['channel']['item'];
if ($response['channel']['response']['@attributes']['total'] == '1'){
	$data = array($data);
}

//echo "response: ".print_r($response, true)."<br>";

unset($response);
if (is_array($data)){
	foreach ($data as $result){
		if ($result['attr']){
			foreach($result['attr'] as $attribute){
				switch($attribute['@attributes']['name']){
					case 'guid':
						$results[$c]['NZBID'] = $attribute['@attributes']['value'];
						break;
					case 'grabs':
						$results[$c]['HITS'] = $attribute['@attributes']['value'];
						break;
					case 'comments':
						$results[$c]['COMMENTS'] = $attribute['@attributes']['value'];
						break;
					case 'group':
						$results[$c]['GROUP'] = $attribute['@attributes']['value'];
						break;
					case 'usenetdate':
						$results[$c]['USENET_DATE'] = $attribute['@attributes']['value'];
						break;
					case 'coverurl':
						$results[$c]['IMAGE'] = $attribute['@attributes']['value'];
						break;
					case 'backdropcoverurl':
						if (!$results[$c]['IMAGE']){
							$results[$c]['IMAGE'] = $attribute['@attributes']['value'];
						}
						break;
				}
			}

			$results[$c]['SITE_URL'] = $siteurl;
			$results[$c]['SITE_NAME'] = $sitename;
			$results[$c]['NZBNAME'] = $result['description'];
			$results[$c]['CATEGORY'] = str_replace(' >', ':', $result['category']);
			$results[$c]['SIZE'] = formatBytes($result['enclosure']['@attributes']['length']);
			$results[$c]['INDEX_DATE'] = strtotime($result['pubDate']);
			$results[$c]['USENET_DATE'] = strtotime($results[$c]['USENET_DATE']);
			$results[$c]['INDEX_DATE_FORMATTED'] = date_format(new DateTime(date("c", $results[$c]['INDEX_DATE'])),"m/d/Y g:i a");
			$results[$c]['USENET_DATE_FORMATTED'] = date_format(new DateTime(date("c", $results[$c]['USENET_DATE'])),"m/d/Y g:i a");
			$results[$c]['USENET_DATE_NOHOUR'] = date_format(new DateTime(date("c", $results[$c]['USENET_DATE'])),"i:s");
			$time = gmdate("U", time());
			$results[$c]['INDEX_AGE'] = $nh->seconds_to_readable($time - $results[$c]['INDEX_DATE']);
			$results[$c]['USENET_AGE'] = $nh->seconds_to_readable($time - $results[$c]['USENET_DATE']);
			if (@$results[$c]['IMAGE'])
				list($results[$c]['IMGWIDTH'], $results[$c]['IMGHEIGHT']) = getimagesize($result['image']);
			$c++;
		}

	}
}
$results['sitename'] = $sitename;
$results['message'] = $message;
if ($results){
	echo json_encode($results);
}

// From http://stackoverflow.com/questions/2510434/php-format-bytes-to-kilobytes-megabytes-gigabytes
function formatBytes($bytes, $precision = 2) { 
	$units = array('B', 'KB', 'MB', 'GB', 'TB'); 

	$bytes = max($bytes, 0); 
	$pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
	$pow = min($pow, count($units) - 1); 

	// Uncomment one of the following alternatives
	// $bytes /= pow(1024, $pow);
	$bytes /= (1 << (10 * $pow)); 

	return round($bytes, $precision) . ' <span name="mobile_show"><!-- Extra break for mobile --></span>' . $units[$pow]; 
}
