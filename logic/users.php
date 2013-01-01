<?php

// Only allow admin to view
if ($_SESSION['user_level'] > 1){

	$delete = isset( $_GET['delete'] ) ? trim($_GET['delete']) : NULL;
	$name = isset( $_GET['name'] ) ? trim($_GET['name']) : NULL;
	$newUser = isset( $_GET['newUser'] ) ? trim($_GET['newUser']) : NULL;
	
	$userLevels = array(0 => 'View Only', 1 => 'View and Add', 2 => 'Admin');
	$mode = "browse";

	if ($delete)
		$um->delete_user($delete);
	elseif ($name){
		$details = $um->user_details($name);
		if ($details)
			$mode = "edit";
	}
	elseif ($newUser)
		$mode = "add";
	elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$user_level = isset( $_POST['user_level'] ) ? trim($_POST['user_level']) : NULL;
		$username = isset( $_POST['username'] ) ? trim($_POST['username']) : NULL;
		$password = isset( $_POST['password'] ) ? trim($_POST['password']) : NULL;
		
		switch ($_POST['action']) {
		case 'add':
			$result = $um->new_user($username, $password, $user_level);
			if ($result == true)
				$mode = 'browse';
			else {
				$smarty->assign('message', $result);
				$mode = 'add';
				$details['user_level'] = $user_level;
				$details['name'] = $username;
				$smarty->assign('details', $details);
			}
			break;
		case 'save':
			if ($password)
				$um->change_password($username, $password);
			$um->change_level($username, $user_level);
			$mode = 'browse';
			break;
		case 'delete':
			$sp->delete_user($username);
			$mode = 'browse';
			break;
		default:
			$mode = 'browse';
		}
	}
	else
		$mode = "browse";
	
	switch ($mode){
	case 'browse':
		$users = $um->list_users();
		$smarty->assign('users', $users);
		break;
	case 'add':
		$smarty->assign('userLevels', $userLevels);
		break;
	case 'edit':
		$smarty->assign('details', $details);
		$smarty->assign('userLevels', $userLevels);
		break;
	}
	
	$smarty->assign('message', $message);
	$smarty->assign('mode', $mode);
	$smarty->display('users.tpl');
}
else
	$smarty->display('restricted.tpl');
?>