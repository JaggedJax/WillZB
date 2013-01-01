<?php

// Only allow admin to view
if ($_SESSION['user_level'] > 1){

	
	
	$smarty->assign('message', $message);
	$smarty->display('setup.tpl');
}
else
	$smarty->display('restricted.tpl');
?>
