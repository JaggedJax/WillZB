<?php /* Smarty version Smarty-3.1.7, created on 2012-02-18 21:30:59
         compiled from "./templates/cpu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17276972944f2a25da69fe46-22604421%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'aff2197dc90df154599ab156d8bd2788275ebea3' => 
    array (
      0 => './templates/cpu.tpl',
      1 => 1329629452,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17276972944f2a25da69fe46-22604421',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f2a25daae7b2',
  'variables' => 
  array (
    'message' => 0,
    'osType' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f2a25daae7b2')) {function content_4f2a25daae7b2($_smarty_tpl) {?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>CPU Settings</title>
<link href="css/standard.css" rel="Stylesheet" type="text/css" title="Standard">
<script type="text/javascript" src="js/ajax.js"></script>
<script type="text/javascript" src="js/functions.js"></script>
</head>
<body onload="general_stats()">
<?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<div id='maincontent'>
	<?php if ($_smarty_tpl->tpl_vars['message']->value){?>
		Output:<br>
		<span id="serverresponse"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</span>
	<?php }?>
	<form action="index.php?p=cpu" name="cpu" method="post">
	<input type="hidden" name="delay" value="0">
	<h2>Shutdown</h2>
	<input type="submit" name="action" class="button_<?php echo $_smarty_tpl->tpl_vars['osType']->value;?>
" value="Shutdown" onclick="var num=prompt('How many minutes before shutting down? 0 For shutdown now.','0'); if (num>=0) setDelay(num);">
	&nbsp;&nbsp;
	<input type="submit" name="action" class="button_<?php echo $_smarty_tpl->tpl_vars['osType']->value;?>
" value="Restart" onclick="var num=prompt('How many minutes before restarting? 0 For restart now.','0'); if (num>=0) setDelay(num);">
	&nbsp;&nbsp;
	<input type="submit" name="action" class="button_<?php echo $_smarty_tpl->tpl_vars['osType']->value;?>
" value="Cancel">
	</form>
	<br><br>
</div>
<?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</body>
</html>
<?php }} ?>