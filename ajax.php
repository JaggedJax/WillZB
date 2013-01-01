<?php
// Autoload any required classes
function autoload($class_name) 
{
	require_once 'includes/'.$class_name.'.php';
}

set_time_limit(600); // Set long timeout for ajax 
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

$smarty->configLoad($conf_file);

/*
$dbparams['host'] = $smarty->getConfigVars('host');
$dbparams['user'] = $smarty->getConfigVars('user');
$dbparams['password'] = $smarty->getConfigVars('password');
$dbparams['database'] = $smarty->getConfigVars('database');
// TODO connect to DB and login

unset($dbparams);
*/
$p = $_GET['p'];
if(file_exists('includes/ajax/'.$p.'.php'))
	require('includes/ajax/' . $p . '.php');
	
set_time_limit(60); // Set timeout back to 60 seconds
?>
