<?php /* Smarty version Smarty-3.1.7, created on 2012-02-18 21:30:55
         compiled from "./templates/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11350538884f29edfe3522b0-61950316%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '97c13ae6868bbc459509c9f1b968154acd23eecc' => 
    array (
      0 => './templates/header.tpl',
      1 => 1329629452,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11350538884f29edfe3522b0-61950316',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f29edfea9dbc',
  'variables' => 
  array (
    'osType' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f29edfea9dbc')) {function content_4f29edfea9dbc($_smarty_tpl) {?><div id="header">
<img src="images/willzb_logo-sm.png" width="144" height="41" alt="Cio Remote" id="logo">
<div id="loginform">
<form action="index.php?p=login" method="post" name="logout">
<input type="submit" name="logout" class="button_<?php echo $_smarty_tpl->tpl_vars['osType']->value;?>
" value="logout"><br>
</form>
<span id="header_stats">
Status: <br>
Speed: 0.00 KB/s<br>
Queue: 0.00/0.00 MB
&nbsp;&nbsp;
</span>
</div>
&nbsp;
<div id="mainmenu">
<ul id="mainav_<?php echo $_smarty_tpl->tpl_vars['osType']->value;?>
">
	<li<?php if ($_SESSION['maintab']=="add_nzb"){?> class="active"<?php }?>><a href="index.php?p=search_nzb&tab=add_nzb">Add NZB's</a></li>
	<li<?php if ($_SESSION['maintab']=="monitor"){?> class="active"<?php }?>><a href="index.php?p=sabnzbd&tab=monitor">Monitor</a></li>
<?php if ($_SESSION['user_level']>1){?>
	<li<?php if ($_SESSION['maintab']=="settings"){?> class="active"<?php }?>><a href="index.php?p=users&tab=settings">Settings</a></li>
<?php }?>
	</ul>
<ul id="subnav_<?php echo $_smarty_tpl->tpl_vars['osType']->value;?>
">
<?php if ($_SESSION['maintab']=="add_nzb"){?>
	<li><a href="index.php?p=search_nzb">Search</a></li>
	<li><a href="index.php?p=add_nzb_manual">Add Manually</a></li>
<?php }elseif($_SESSION['maintab']=="monitor"){?>
	<li><a href="index.php?p=sabnzbd">Monitor</a></li>
<?php }elseif($_SESSION['maintab']=="settings"){?>
	<li><a href="index.php?p=users">Users</a></li>
	<li><a href="index.php?p=cpu">CPU</a></li>
	<li><a href="index.php?p=setup">Setup</a></li>
<?php }else{ ?>
	<li><a href="">Subnav 1: <?php echo $_SESSION['maintab'];?>
</a></li>
<?php }?>
</ul>
</div>
</div>
&nbsp;
<?php }} ?>