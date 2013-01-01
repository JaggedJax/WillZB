<?php /* Smarty version Smarty-3.1.7, created on 2012-02-18 23:48:05
         compiled from "./templates/login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11469540204f29fd15b53843-69257386%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f5f63cf8bf5077cbe9e40e023158dd20352e878a' => 
    array (
      0 => './templates/login.tpl',
      1 => 1329629452,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11469540204f29fd15b53843-69257386',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f29fd15ede71',
  'variables' => 
  array (
    'server_query' => 0,
    'osType' => 0,
    'message' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f29fd15ede71')) {function content_4f29fd15ede71($_smarty_tpl) {?><html>
<head>
<title>WillZB</title>
<link href="css/standard.css" rel="Stylesheet" type="text/css" title="Standard">
<script type="text/javascript" src="js/functions.js"></script>
<script type="text/javascript">
var ua = navigator.userAgent.toLowerCase();
var url = document.location.href;
var isAndroid = ua.indexOf("android") > -1;
var isApple = ua.indexOf("iphone") > -1;
var isMobile = ua.indexOf("mobile") > -1;
var tabletView = url.indexOf("tablet") > -1;
if((isAndroid || isApple || isMobile) && !tabletView) {
	// Redirect to Tablet version
	window.location = "index.php?<?php echo $_smarty_tpl->tpl_vars['server_query']->value;?>
&osType=tablet";
}
</script>
</head>
<body onload="document.loginform.username.focus()">
<div id="centered">
	<form action="index.php?p=login" method="post" name="loginform">
	<table id="getlogin">
		<tr><td colspan="2"><img src="images/willzb_logo-sm.png" width="144" height="41" alt="WillZB"></td></tr>
		<tr><td class="fn">Username</td><td><input type="text" name="username" class="textbox_<?php echo $_smarty_tpl->tpl_vars['osType']->value;?>
"></td></tr>
		<tr><td class="fn">Password</td><td><input type="password" name="password" class="textbox_<?php echo $_smarty_tpl->tpl_vars['osType']->value;?>
"></td></tr>
		<tr><td></td><td><input type="submit" name="login" class="button_<?php echo $_smarty_tpl->tpl_vars['osType']->value;?>
" onclick="return true;" value="login"></td></tr>
	</table>
	<span id="servermessage"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</span>
	</form>
</div>
</body>
</html>
<?php }} ?>