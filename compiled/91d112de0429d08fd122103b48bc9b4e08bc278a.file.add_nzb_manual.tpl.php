<?php /* Smarty version Smarty-3.1.7, created on 2012-02-19 00:55:18
         compiled from "./templates/add_nzb_manual.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18413353074f29ee01227de9-03334318%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '91d112de0429d08fd122103b48bc9b4e08bc278a' => 
    array (
      0 => './templates/add_nzb_manual.tpl',
      1 => 1329629452,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18413353074f29ee01227de9-03334318',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f29ee0170efe',
  'variables' => 
  array (
    'message' => 0,
    'osType' => 0,
    'result' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f29ee0170efe')) {function content_4f29ee0170efe($_smarty_tpl) {?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>Manually Add NZB Files to download</title>
<link href="css/standard.css" rel="Stylesheet" type="text/css" title="Standard">
<script type="text/javascript" src="js/ajax.js"></script>
</head>
<body onload="general_stats()">
<?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<div id='maincontent'>
	<h2>Add Files to Download</h2>
	<span id="servermessage"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</span>
	<form enctype="multipart/form-data" action="index.php?p=add_nzb_manual" name="nzbfile" method="post">
	<br>
	<table>
		<tr>
			<td>Upload an NZB's or provide the url of one to be downloaded.</td>
		</tr>
		<tr>
			<td> <br>
				Select NZB File:<br>
				<input type="file" name="nzbFile" size="40" class="textbox_<?php echo $_smarty_tpl->tpl_vars['osType']->value;?>
">
			</td>
		</tr>
		<?php if (isset($_smarty_tpl->tpl_vars['result']->value['file'])){?>
			<tr><td><?php echo $_smarty_tpl->tpl_vars['result']->value['file'];?>
</td></tr>
		<?php }?>
	</table>
	<br>
	<table>
		<tr>
			<td>NZB URL:</td>
		</tr>
		<tr>
			<td><input type="text" name="nzbURL" size="70" class="textbox_<?php echo $_smarty_tpl->tpl_vars['osType']->value;?>
"></td>
		</tr>
		<?php if (isset($_smarty_tpl->tpl_vars['result']->value['url'])){?>
			<tr><td><?php echo $_smarty_tpl->tpl_vars['result']->value['url'];?>
</td></tr>
		<?php }?>
	</table>
	<br>
	<input type="submit" name="action" value="Submit File" class="button_<?php echo $_smarty_tpl->tpl_vars['osType']->value;?>
">
	</form>
	<br><br>
</div>
<?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</body>
</html>
<?php }} ?>