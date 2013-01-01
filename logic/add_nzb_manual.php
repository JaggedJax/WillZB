<?php

$file = isset( $_FILES['nzbFile']['name'] ) ? $_FILES['nzbFile']['name'] : null;
$url = isset( $_POST['nzbURL'] ) ? trim($_POST['nzbURL']) : null;
unset($_SESSION['results']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if ($file){
		$message = '';
		if(!move_uploaded_file($_FILES['nzbFile']['tmp_name'], $nh->temp_dir.$file))
			$message = 'Failed to get file';
		else{
			// Do anything we want to file here, then move it.
			// TODO check that file is an nzb file
			if (!rename($nh->temp_dir.$file, $nh->watch_dir.$file))
				$message = 'Failed to move file';
			else
				$result['file'] = "<i>$file</i> uploaded and added";
		}
	}
	if ($url){
		$addMessage = $nh->add_nzb_url($url);
		if (substr($addMessage, 0, 6) == "ERROR:")
			$message = $addMessage;
		else
			$result['url'] = $addMessage;
	}
	
	$smarty->assign('message', $message);
	$smarty->assign('result', $result);
}

$smarty->display('add_nzb_manual.tpl');
?>