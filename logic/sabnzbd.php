<?php

$queuePage = isset( $_GET['queuePage'] ) ? trim($_GET['queuePage']) : 0;
$queueLimit = isset( $_GET['queueLimit'] ) ? trim($_GET['queueLimit']) : 15;
$queueStart = $queuePage*$queueLimit;
$histPage = isset( $_GET['histPage'] ) ? trim($_GET['histPage']) : 0;
$histLimit = isset( $_GET['histLimit'] ) ? trim($_GET['histLimit']) : 20;
$histStart = $histPage*$histLimit;


$pauseall = (isset($_GET['pauseall']) && is_numeric(trim($_GET['pauseall']))) ? trim($_GET['pauseall']) : 0;
$resumeall = isset( $_GET['resumeall'] ) ? trim($_GET['resumeall']) : 0;
$pause = isset( $_GET['pause'] ) ? trim($_GET['pause']) : NULL;
$resume = isset( $_GET['resume'] ) ? trim($_GET['resume']) : NULL;
$retry = isset( $_GET['retry'] ) ? trim($_GET['retry']) : NULL;
$delete = isset( $_GET['delete'] ) ? trim($_GET['delete']) : NULL;
$mode = isset( $_GET['mode'] ) ? trim($_GET['mode']) : NULL;
$pos = isset( $_REQUEST['pos'] ) ? trim($_REQUEST['pos']) : NULL;
$id = isset( $_REQUEST['id'] ) ? trim($_REQUEST['id']) : NULL;
$move = isset( $_GET['move'] ) ? true : false;

$loggedin = false;

if (($result = $sh->authenticate()) !== true)
	$smarty->assign('message', $result);
else
	$loggedin = true;

if ($loggedin){
	if ($pauseall == 1)
		$sh->pause_all();
	else if ($pauseall)
		$sh->pause_all($pauseall);
	if ($resumeall)
		$sh->resume_all();
	if ($pause)
		$sh->pause_id($pause);
	if ($resume)
		$sh->resume_id($resume);
	if ($retry)
		$sh->retry_id($retry);
	if ($move && $id)
		$sh->move_id($id, $pos);
	if ($delete)
		$sh->delete_id($delete, $mode);
	$general = array();
	// QUEUE
	$queueXML = $sh->get_queue($queueStart, $queueLimit);
	if ($queueXML){
		$queue = array();
		$posList = array();
		$general['paused'] = (strtolower($queueXML->paused) == 'true') ? true : false;
		$general['restart_req'] = $queueXML->restart_req;
		$general['uptime'] = $queueXML->uptime;
		$general['status'] = $queueXML->status;
		$general['pause_int'] = (trim($queueXML->pause_int) == '0') ? 0 : trim($queueXML->pause_int);
		$general['have_warnings'] = $queueXML->have_warnings;
		$general['mb'] = $queueXML->mb;
		$general['mbleft'] = $queueXML->mbleft;
		$general['kbpersec'] = $queueXML->kbpersec;
		$num = 0;
		foreach ($queueXML->slots->slot as $slot){
			$posList[$num] = $num;
			$queue[$num]['status'] = $slot->status;
			$queue[$num]['index'] = $slot->index;
			$queue[$num]['eta'] = $slot->eta;
			$queue[$num]['timeleft'] = $slot->timeleft;
			$queue[$num]['mb'] = $slot->mb;
			$queue[$num]['mbleft'] = $slot->mbleft;
			$queue[$num]['filename'] = $slot->filename;
			$queue[$num]['nzo_id'] = $slot->nzo_id;
			$queue[$num]['size'] = $slot->size;
			$queue[$num]['percent'] = $slot->percentage;
			//$queue[$num]['percent'] = 100-number_format($queue[$num]['mbleft']/$queue[$num]['mb']*100, 2);
			$num++;
		}
		$smarty->assign('queue', $queue);
		$smarty->assign('numqueued', count($queue));
		$smarty->assign('posList', $posList);
	}
	// HISTORY
	$historyXML = $sh->get_history($histStart, $histLimit);
	if ($historyXML){
		$history = array();
		$general['total_size'] = $historyXML->total_size;
		$general['month_size'] = $historyXML->month_size;
		$general['week_size'] = $historyXML->week_size;
		$num = 0;
		$details = array();
		foreach ($historyXML->slots->slot as $slot){
			$history[$num]['fail_message'] = trim($slot->fail_message);
			if ($slot->completed){
				$history[$num]['completed'] = date('M jS Y \a\t g:ia', (int)$slot->completed);
			}
			$history[$num]['nzo_id'] = $slot->nzo_id;
			$history[$num]['size'] = $slot->size;
			$history[$num]['completeness'] = $slot->completeness;
			$history[$num]['name'] = $slot->name;
			$history[$num]['nzb_name'] = $slot->nzb_name;
			$history[$num]['status'] = $slot->status;
			$nzb = $history[$num]['nzo_id'];
			foreach ($slot->stage_log->slot as $stage){
				$name = (String)($stage->name);
				$details[$name] = $stage->actions->item;
			}
			$history[$num]['log'] = $details;
			$num++;
		}
		
		$smarty->assign('history', $history);
	}
	$smarty->assign('general', $general);
}
	
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
}

$smarty->display('sabnzbd.tpl');
?>
