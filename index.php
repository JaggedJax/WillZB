<?php
// Autoload any required classes
function autoload($class_name) 
{
	require_once 'includes/'.$class_name.'.php';
}

// Set smarty directory
define('SMARTY_DIR',str_replace("\\","/",getcwd()).'/Smarty/');

require_once(SMARTY_DIR . 'Smarty.class.php');

$conf_file = 'settings.conf';
$smarty = new Smarty();
$smarty->config_overwrite=false; 

// Use our own autoloader now that smarty is loaded
spl_autoload_register('autoload');

$smarty->setTemplateDir('./templates');
$smarty->compile_dir = './compiled';
$smarty->config_dir = './configs';

// Load/Register filters
$smarty->loadFilter('output', 'trimwhitespace');

# Load general global settings
$smarty->configLoad($conf_file);

/*
$dbparams['host'] = $smarty->getConfigVars('host');
$dbparams['user'] = $smarty->getConfigVars('user');
$dbparams['password'] = $smarty->getConfigVars('password');
$dbparams['database'] = $smarty->getConfigVars('database');
// TODO connect to DB and login

unset($dbparams);
*/
$nh = new nzb_helper($smarty);
$sh = new sabnzbd_helper($smarty);
$um = new user_mgmt();

session_start();

$default_page = 'sabnzbd';
$p = isset( $_GET['p'] ) ? htmlspecialchars(trim($_GET['p'])) : $default_page;
switch ($p){
	case ('search_nzb'):
	case ('add_nzb_manual'): $_SESSION['maintab'] = 'add_nzb'; break;
	case ('sabnzbd'): $_SESSION['maintab'] = 'monitor'; break;
	case ('users'): $_SESSION['maintab'] = 'settings'; break;
}

// Always pass OS type for css display modifications
$_SESSION['osType'] = isset($_GET['osType']) ? trim($_GET['osType']) : (isset($_SESSION['osType']) ? $_SESSION['osType'] : 'desktop');
$osTypes = array('desktop', 'tablet', 'handheld'); // list of acceptable os types
if (!in_array($_SESSION['osType'], $osTypes))
	$_SESSION['osType'] = 'desktop';
$smarty->assign('osType', $_SESSION['osType']);
// Remove any osType and sanitize url
$smarty->assign('server_query', preg_replace('/<|%3C|>|%3E|\'|\"|%22|&osType=desktop|&osType=tablet/', '', $_SERVER['QUERY_STRING']));

if ($p != 'search_nzb')
	unset($_SESSION['results']);

if (isset($_SESSION['user_id'])){
	$_SESSION['start'] = null;
}
else{ // Force to login page if not logged in
	if ($p != 'login')
		$_SESSION['start'] = $p;
	$p = 'login';
}
if (isset($_GET['tab']))
	$_SESSION['maintab'] = trim($_GET['tab']);
if(file_exists('logic/'.$p.'.php'))
	require('logic/'.$p.'.php');

?>