<?php
$message = '&nbsp;';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (isset($_POST['logout'])) {
		unset($_SESSION['user_id']);
	} else {
		$user = $um->authenticate(preg_replace('/<|%3C|>|%3E|\'|\"|%22/', '',trim($_POST['username'])), preg_replace('/<|%3C|>|%3E|\'|\"|%22/', '',trim($_POST['password'])));
		if ($user) {
			$_SESSION['user_id'] = $user['id'];
			$_SESSION['username'] = $user['name'];
			$_SESSION['user_level'] = $user['user_level'];
			$p = isset( $_SESSION['start'] ) ? $_SESSION['start'] : '';
			header('HTTP/1.1 302 Object Moved');
			if ($p && $p != 'login')
				header('Location: index.php?p='.htmlspecialchars($p));
			else
				header('Location: index.php');
			exit;
		} else {
			$message = 'Invalid username or password';
		}
	}
}
$smarty->assign('message', $message);
$smarty->display('login.tpl');
?>
