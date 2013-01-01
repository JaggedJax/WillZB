<?php
/* Add nzb id to download queue */
$sh = new sabnzbd_helper($smarty);

$data = $sh->get_queue(0, 0);

$paused = (strtolower($data->paused) == 'true') ? true : false;
$pause_int = (trim($data->pause_int) == '0') ? 0 : trim($data->pause_int);
$general['kbpersec'] = $data->kbpersec;
$general['mb'] = $data->mb;
$general['mbleft'] = $data->mbleft;

$stats = 'Status: '.$data->status.' ';
if ($paused && $pause_int)
	$stats .= $pause_int;
$stats .= '<br>Speed: '.$data->kbpersec.' KB/s<br>Queue: '.$data->mbleft.'/'.$data->mb.' MB';

echo $stats;
?>
