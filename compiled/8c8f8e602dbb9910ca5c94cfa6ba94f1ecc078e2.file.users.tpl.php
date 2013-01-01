<?php /* Smarty version Smarty-3.1.7, created on 2012-02-18 21:30:54
         compiled from "./templates/users.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8278872974f2a25d7585ec9-33396678%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8c8f8e602dbb9910ca5c94cfa6ba94f1ecc078e2' => 
    array (
      0 => './templates/users.tpl',
      1 => 1329629452,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8278872974f2a25d7585ec9-33396678',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f2a25d81c9a7',
  'variables' => 
  array (
    'mode' => 0,
    'users' => 0,
    'osType' => 0,
    'row' => 0,
    'user' => 0,
    'message' => 0,
    'user_id' => 0,
    'details' => 0,
    'userLevels' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f2a25d81c9a7')) {function content_4f2a25d81c9a7($_smarty_tpl) {?><?php if (!is_callable('smarty_function_cycle')) include '/var/www/Smarty/plugins/function.cycle.php';
if (!is_callable('smarty_function_html_options')) include '/var/www/Smarty/plugins/function.html_options.php';
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>Users</title>
<link href="css/standard.css" rel="Stylesheet" type="text/css" title="Standard">
<script type="text/javascript" src="js/functions.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>
</head>
<body onload="general_stats()">
<?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<div id='maincontent'>
	<?php if ($_smarty_tpl->tpl_vars['mode']->value=="browse"){?>
		<h2>Browse User Accounts</h2>
		<table class="browse" border="0">
		<tr class="head" align="left"><th>Name</th><th></th></tr>
		<?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['users']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
			<tr class="<?php echo smarty_function_cycle(array('values'=>'odd,'),$_smarty_tpl);?>
 row_<?php echo $_smarty_tpl->tpl_vars['osType']->value;?>
" onmouseover="Highlight(this)" onmouseout="Lowlight(this)">
				<td class="cursor" onclick="document.location.href='index.php?p=users&name=<?php echo $_smarty_tpl->tpl_vars['row']->value;?>
'"><?php echo $_smarty_tpl->tpl_vars['row']->value;?>
</td>
				<td>
					<a href="index.php?p=users&delete=<?php echo $_smarty_tpl->tpl_vars['row']->value;?>
" onclick="return confirm('Really delete user \'<?php echo $_smarty_tpl->tpl_vars['row']->value;?>
\'?');"><img src="images/red_x_<?php echo $_smarty_tpl->tpl_vars['osType']->value;?>
.png" border="0"></a>
				</td>
			</tr>
		<?php } ?>
		</table>
		<br><br>
		<button class="button_<?php echo $_smarty_tpl->tpl_vars['osType']->value;?>
" onClick="window.location='index.php?p=users&newUser=1'">New User</button>
	<?php }else{ ?>
		<h2><?php if ($_smarty_tpl->tpl_vars['mode']->value=="edit"){?>Edit User: <?php echo $_smarty_tpl->tpl_vars['user']->value['name'];?>
<?php }else{ ?>Add User<?php }?></h2>
		<span id="servermessage"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</span>
		<div id="general">
		<form action="index.php?p=users" method="post">
		<input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['user_id']->value;?>
">
		<table>
		<?php if ($_smarty_tpl->tpl_vars['mode']->value=="add"){?>
		<tr><td>Username:</td><td><input type="text" name="username" class="textbox_<?php echo $_smarty_tpl->tpl_vars['osType']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['details']->value['name'];?>
" size="20" maxlength="20"></td></tr>
		<tr><td>Password:</td><td><input type="password" name="password" class="textbox_<?php echo $_smarty_tpl->tpl_vars['osType']->value;?>
" size="20" maxlength="20"></td></tr>
		<?php }else{ ?>
		<tr><td>New Password:</td><td><input type="password" name="password" class="textbox_<?php echo $_smarty_tpl->tpl_vars['osType']->value;?>
" size="20" maxlength="20"> (leave blank to keep existing password)
		<input type="hidden" name="username" value="<?php echo $_smarty_tpl->tpl_vars['details']->value['name'];?>
">
		</td></tr>
		<?php }?>
		<tr><td>User Level:</td><td><?php echo smarty_function_html_options(array('name'=>"user_level",'options'=>$_smarty_tpl->tpl_vars['userLevels']->value,'selected'=>$_smarty_tpl->tpl_vars['details']->value['user_level'],'class'=>"textbox_".($_smarty_tpl->tpl_vars['osType']->value)),$_smarty_tpl);?>
</td></tr>
		</table>
		<?php if ($_smarty_tpl->tpl_vars['mode']->value=="edit"){?>
			<input type="submit" name="action" class="button_<?php echo $_smarty_tpl->tpl_vars['osType']->value;?>
" value="save">
			<input type="submit" name="action" class="button_<?php echo $_smarty_tpl->tpl_vars['osType']->value;?>
" value="delete" onclick="return confirm('Are you sure you want to delete this user?')">
		<?php }else{ ?>
			<input type="submit" name="action" class="button_<?php echo $_smarty_tpl->tpl_vars['osType']->value;?>
" value="add">
		<?php }?>
		<input type="submit" name="action" class="button_<?php echo $_smarty_tpl->tpl_vars['osType']->value;?>
" value="cancel">
		</form>
		</div>
	<?php }?>
	<br><br>
</div>
<?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</body>
</html>
<?php }} ?>