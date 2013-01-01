<?php
/* @var $nh nzb_helper */

$query = isset( $_POST['query'] ) ? urlencode(trim($_POST['query'])) : null;
$category = isset( $_POST['category'] ) ? trim($_POST['category']) : null;
$numResults = isset( $_POST['numResults'] ) ? trim($_POST['numResults']) : 50;
$searchin = isset( $_POST['searchin'] ) ? trim($_POST['searchin']) : 'name';
//$minSize = (isset($_POST['minSize']) && is_numeric(trim($_POST['minSize']))) ? trim($_POST['minSize']) : 0;
//$maxSize = (isset($_POST['maxSize']) && is_numeric(trim($_POST['minSize']))) ? trim($_POST['maxSize']) : 0;

$nzbid = isset( $_GET['nzbid'] ) ? trim($_GET['nzbid']) : null;
$base_url = isset( $_GET['base_url'] ) ? trim($_GET['base_url']) : null;
$action = isset( $_GET['action'] ) ? trim($_GET['action']) : null;

$message = '';
if ($category != null)
	$_SESSION['category'] = $category;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if ($query){
//		$allResults = array();
//		for($i = 0; $i < count($nh->sitename); $i++){
//			$searchUrl = $nh->siteurl[$i]."/api?t=search&q=$query&englishonly=1&num=5&username={$nh->username[$i]}&apikey={$nh->apikey[$i]}&searchin=$searchin&o=json";
//			// Optional parameters
//			if ($category && $category != "0")
//				$searchUrl .= "&cat=$category";
//			$searchUrl .= '&attrs=comments,language,coverurl,usenetdate,group,grabs';
//			$response = http_get($searchUrl);
//			//echo "CALL: $searchUrl<br>RESULT: $response<br><br><br><br>";
//			$body = http_parse_message($response)->body;
//			$response = json_decode($body, true);
//			//echo 'Call: '.$searchUrl.'<br>Response: '.print_r($response['channel']['item'][0], true).'<br>';
//			$message = $nh->check_api_error($body);
//			unset($body);
//			$results = array();
//		
//			// Format data
//			$c = 0;
//			$data = $response['channel']['item'];
//			unset($response);
//			foreach ($data as $result){
//				foreach($result['attr'] as $attribute){
//					switch($attribute['@attributes']['name']){
//						case 'guid':
//							$results[$c]['NZBID'] = $attribute['@attributes']['value'];
//							break;
//						case 'grabs':
//							$results[$c]['HITS'] = $attribute['@attributes']['value'];
//							break;
//						case 'comments':
//							$results[$c]['COMMENTS'] = $attribute['@attributes']['value'];
//							break;
//						case 'group':
//							$results[$c]['GROUP'] = $attribute['@attributes']['value'];
//							break;
//						case 'usenetdate':
//							$results[$c]['USENET_DATE'] = $attribute['@attributes']['value'];
//							break;
//					}
//				}
//				
//				$results[$c]['SITE_URL'] = $nh->siteurl[$i];
//				$results[$c]['SITE_NAME'] = $nh->sitename[$i];
//				$results[$c]['NZBNAME'] = $result['description'];
//				$results[$c]['CATEGORY'] = str_replace(' >', ':', $result['category']);
//				$results[$c]['SIZE'] = formatBytes($result['enclosure']['@attributes']['length']);
//				$results[$c]['INDEX_DATE'] = strtotime($result['pubDate']);
//				$results[$c]['USENET_DATE'] = strtotime($results[$c]['USENET_DATE']);
//				$time = gmdate("U", time());
//				$results[$c]['INDEX_AGE'] = $nh->seconds_to_readable($time - $results[$c]['INDEX_DATE']);
//				$results[$c]['USENET_AGE'] = $nh->seconds_to_readable($time - $results[$c]['USENET_DATE']);
//				if ($result['image'])
//					list($results[$c]['IMGWIDTH'], $results[$c]['IMGHEIGHT']) = getimagesize($result['image']);
//				$c++;
//			}
//			if ($results){
//				$allResults = array_merge($allResults, $results);
//			}
//		}
//		$_SESSION['results'] = $allResults;
//		$smarty->assign('results', $allResults);
		
	}
	
	$smarty->assign('query', $query);
	$smarty->assign('category', $category);
	$smarty->assign('searchin', $searchin);
	// API Info
	$smarty->assign('sitename', $nh->sitename);
	$smarty->assign('siteurl', $nh->siteurl);
	$smarty->assign('username', $nh->username);
	$smarty->assign('apikey', $nh->apikey);
	
	$smarty->assign('message', $message);
	$smarty->display('result_nzb.tpl');
}
else if ($nzbid && $action){
	if ($action == 'queue'){
		$addMessage = $nh->add_nzb_id($base_url, $nzbid);
		if (substr($addMessage, 0, 6) == "ERROR:")
			$message = $addMessage;
		else{
			$result['id'] = $nzbid;
			$result['msg'] = $addMessage;
		}
		$smarty->assign('results', $_SESSION['results']);
		$smarty->assign('result', $result);
		$smarty->assign('message', $message);
		$smarty->display('result_nzb.tpl');
	}
	else if ($action == 'download'){
		list($filename, $body, $message) = $nh->download_nzb_id($base_url, $nzbid);
		$length = 0;
		if (!$message && $filename && $body){
			if (function_exists('mb_strlen')) {
				$length = mb_strlen($body, '8bit');
			} else {
				$length = strlen($body);
			}
			header('Content-Type: application/x-nzb'); 
			header("Content-length: " . $length); 
			header('Content-Disposition: attachment; filename="' . $filename . '"'); 
			echo $body;
		}
		else if (!$message){
			$smarty->assign('results', $_SESSION['results']);
			$smarty->assign('message', 'File was empty');
			$smarty->display('result_nzb.tpl');
		}
		else{
			$smarty->assign('results', $_SESSION['results']);
			$smarty->assign('message', $message);
			$smarty->display('result_nzb.tpl');
		}
	}
}
else{
	$smarty->assign('category', $_SESSION['category']);
	$smarty->assign('searchin', array('name' => 'Name', 'subject' => 'Subject', 'weblink' =>'Link'));
	$smarty->assign('categories', array(
		'0'=>'All Categories',
		'1000'=>'Console',
		'1010'=>'Console/NDS',
		'1020'=>'Console/PSP',
		'1030'=>'Console/Wii',
		'1040'=>'Console/XBox',
		'1050'=>'Console/XBox 360',
		'1060'=>'Console/Wiiware',
		'1070'=>'Console/XBox 360 DLC',
		'2000'=>'Movies',
		'2010'=>'Movies/Foreign',
		'2020'=>'Movies/Other',
		'2030'=>'Movies/SD',
		'2040'=>'Movies/HD',
		'2050'=>'Movies/BluRay',
		'2060'=>'Movies/3D',
		'3000'=>'Audio',
		'3010'=>'Audio/MP3',
		'3020'=>'Audio/Video',
		'3030'=>'Audio/Audiobook',
		'3040'=>'Audio/Lossless',
		'4000'=>'PC',
		'4010'=>'PC/0day',
		'4020'=>'PC/ISO',
		'4030'=>'PC/Mac',
		'4040'=>'PC/Mobile-Other',
		'4050'=>'PC/Games',
		'4060'=>'PC/Mobile-iOS',
		'4070'=>'PC/Mobile-Android',
		'5000'=>'TV',
		'5020'=>'TV/Foreign',
		'5030'=>'TV/SD',
		'5040'=>'TV/HD',
		'5050'=>'TV/Other',
		'5060'=>'TV/Sport',
		'6000'=>'XXX',
		'6010'=>'XXX/DVD',
		'6020'=>'XXX/WMV',
		'6030'=>'XXX/XviD',
		'6040'=>'XXX/x264',
		'7000'=>'Other',
		'7010'=>'Misc',
		'7020'=>'EBook',
		'7030'=>'Comics'));
	$smarty->display('search_nzb.tpl');
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
?>
