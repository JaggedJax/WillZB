<?php
$message = "";
$delay = isset( $_POST['delay'] ) ? trim($_POST['delay']) : 0;
// Only allow admin to view
if ($_SESSION['user_level'] > 1){
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$output = array();
		if ($delay && is_numeric($delay) && $delay > 0)
			$time = date('H:i', strtotime("+$delay minutes"));
		else
			$time = "now";
		switch ($_POST['action']) {
		case 'Shutdown':
			echo "at -f /var/www/scripts/shutdown.sh $time";
			exec("at -f /var/www/scripts/shutdown.sh $time", $output);
			break;
		case 'Restart':
			exec("at -f /var/www/scripts/output.sh $time", $output);
			break;
		case 'Cancel':
			exec('sudo shutdown -c', $output);
			break;
		}
		// Put output into display message
		foreach ($output as $outLine){
			$message .= $outLine."<br>";
		}
	}
	$smarty->assign('message', $message);
	$smarty->display('cpu.tpl');
}
else
	$smarty->display('restricted.tpl');
?>
