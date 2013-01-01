<?php /* Smarty version Smarty-3.1.7, created on 2012-02-19 00:55:45
         compiled from "./templates/sabnzbd.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16729689164f29fd3950fb75-56850644%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1f5018bf949c07f9c939c7c316ff6e57873849d8' => 
    array (
      0 => './templates/sabnzbd.tpl',
      1 => 1329629452,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16729689164f29fd3950fb75-56850644',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f29fd3a7e319',
  'variables' => 
  array (
    'message' => 0,
    'general' => 0,
    'osType' => 0,
    'queue' => 0,
    'posList' => 0,
    'row' => 0,
    'history' => 0,
    'key' => 0,
    'stage' => 0,
    'action' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f29fd3a7e319')) {function content_4f29fd3a7e319($_smarty_tpl) {?><?php if (!is_callable('smarty_function_cycle')) include '/var/www/Smarty/plugins/function.cycle.php';
if (!is_callable('smarty_function_html_options')) include '/var/www/Smarty/plugins/function.html_options.php';
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>SABnzbd Download Queue</title>
<link href="css/standard.css" rel="Stylesheet" type="text/css" title="Standard">
<script type="text/javascript" src="js/functions.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>
</head>
<body onload="general_stats()">
<?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<div id='maincontent'>
	<h2>Download Queue</h2>
	<span id="servermessage"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</span>
	<h3>Queue</h3>
	<div class="floatright">
		<a href="index.php?p=sabnzbd&<?php if ($_smarty_tpl->tpl_vars['general']->value['status']=='Paused'){?>resumeall<?php }else{ ?>pauseall<?php }?>=1" class="link_<?php echo $_smarty_tpl->tpl_vars['osType']->value;?>
"><?php if ($_smarty_tpl->tpl_vars['general']->value['status']=='Paused'){?>Resume All<?php }else{ ?>Pause All<?php }?></a>
		<a href="#" onclick="swap_classes('pauseTime','hidden','visible'); return false;"><img src="images/bullet_arrow_down_<?php echo $_smarty_tpl->tpl_vars['osType']->value;?>
.png" border="0"></a>
		<div class="hidden indent" id="pauseTime">
			<a href="index.php?p=sabnzbd&pauseall=5" class="link_<?php echo $_smarty_tpl->tpl_vars['osType']->value;?>
">5 mins</a><br>
			<a href="index.php?p=sabnzbd&pauseall=15" class="link_<?php echo $_smarty_tpl->tpl_vars['osType']->value;?>
">15 mins</a><br>
			<a href="index.php?p=sabnzbd&pauseall=30" class="link_<?php echo $_smarty_tpl->tpl_vars['osType']->value;?>
">30 mins</a><br>
			<a href="index.php?p=sabnzbd&pauseall=60" class="link_<?php echo $_smarty_tpl->tpl_vars['osType']->value;?>
">1 hour</a><br>
			<a href="index.php?p=sabnzbd&pauseall=120" class="link_<?php echo $_smarty_tpl->tpl_vars['osType']->value;?>
">2 hours</a><br>
			<a href="index.php?p=sabnzbd&pauseall=180" class="link_<?php echo $_smarty_tpl->tpl_vars['osType']->value;?>
">3 hours</a><br>
			<a href="index.php?p=sabnzbd&pauseall=300" class="link_<?php echo $_smarty_tpl->tpl_vars['osType']->value;?>
">5 hours</a><br>
			<a href="#" class="link_<?php echo $_smarty_tpl->tpl_vars['osType']->value;?>
" onclick="var time=prompt('Please enter time to pause in minutes'); location.href='index.php?p=sabnzbd&pauseall='+time">Custom</a>
		</div>
	</div>
	<table class="browse" border="0">
	<tr class="head" align="left"><th></th><th class="filename">Name</th><th>Progress</th><th>Time Left</th><th>Size</th><th></th></tr>
	<form action="index.php?p=sabnzbd&move=1" name="sabnzbd" method="post">
	<?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['queue']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
		<tr class="<?php echo smarty_function_cycle(array('values'=>'odd,'),$_smarty_tpl);?>
 row_<?php echo $_smarty_tpl->tpl_vars['osType']->value;?>
" onmouseover="Highlight(this)" onmouseout="Lowlight(this)">
			<td><?php echo smarty_function_html_options(array('name'=>'newPos','options'=>$_smarty_tpl->tpl_vars['posList']->value,'selected'=>$_smarty_tpl->tpl_vars['row']->value['index'],'onchange'=>"move_queue('".($_smarty_tpl->tpl_vars['row']->value['nzo_id'])."', ".($_smarty_tpl->tpl_vars['row']->value['index']).");"),$_smarty_tpl);?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['row']->value['filename'];?>
</td>
			<td><progress value="<?php echo $_smarty_tpl->tpl_vars['row']->value['percent'];?>
" max="100" title="<?php echo $_smarty_tpl->tpl_vars['row']->value['mbleft'];?>
/<?php echo $_smarty_tpl->tpl_vars['row']->value['mb'];?>
 MB"></progress></td>
			<td><?php echo $_smarty_tpl->tpl_vars['row']->value['timeleft'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['row']->value['size'];?>
</td>
			<td>
				<a href="index.php?p=sabnzbd&<?php if ($_smarty_tpl->tpl_vars['row']->value['status']=='Paused'){?>resume<?php }else{ ?>pause<?php }?>=<?php echo $_smarty_tpl->tpl_vars['row']->value['nzo_id'];?>
"><img src="images/control_<?php if ($_smarty_tpl->tpl_vars['row']->value['status']=='Paused'){?>play<?php }else{ ?>pause<?php }?>.png" border="0"></a>&nbsp;&nbsp;
				<a href="index.php?p=sabnzbd&delete=<?php echo $_smarty_tpl->tpl_vars['row']->value['nzo_id'];?>
&mode=queue" onclick="return confirm('Really delete file \'<?php echo $_smarty_tpl->tpl_vars['row']->value['filename'];?>
\'?');"><img src="images/red_x_<?php echo $_smarty_tpl->tpl_vars['osType']->value;?>
.png" border="0"></a>
			</td>
		</tr>
	<?php } ?>
	</table>
	<input type="hidden" name="id" id="id">
	<input type="hidden" name="pos" id="pos" value="0">
	</form>
	<br><br>
	<h3>History</h3>
	<table><tr><td>
	<table class="browse" border="0">
	<tr class="head" align="left"><th></th><th class="filename">Name</th><th>Size</th><th>Status</th><th></th></tr>
	<?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['history']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
		<tr valign="top" class="<?php echo smarty_function_cycle(array('values'=>'odd,'),$_smarty_tpl);?>
 row_<?php echo $_smarty_tpl->tpl_vars['osType']->value;?>
" onmouseover="Highlight(this)" onmouseout="Lowlight(this)">
			<td><a href="javascript:void(0)" onclick="enable_disable_div('<?php echo $_smarty_tpl->tpl_vars['row']->value['nzo_id'];?>
')" class="link_<?php echo $_smarty_tpl->tpl_vars['osType']->value;?>
"><b>+</b></a></td>
			<td>
				<?php echo $_smarty_tpl->tpl_vars['row']->value['name'];?>

				<?php if ($_smarty_tpl->tpl_vars['row']->value['fail_message']){?><br><font color="#ff0000"><?php echo $_smarty_tpl->tpl_vars['row']->value['fail_message'];?>
</font> - <a href="index.php?p=sabnzbd&retry=<?php echo $_smarty_tpl->tpl_vars['row']->value['nzo_id'];?>
">Retry?</a><?php }?>
				<div id='<?php echo $_smarty_tpl->tpl_vars['row']->value['nzo_id'];?>
' class="hidden">
				<br> <!-- Download status messages -->
				<?php  $_smarty_tpl->tpl_vars['stage'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['stage']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['row']->value['log']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['stage']->key => $_smarty_tpl->tpl_vars['stage']->value){
$_smarty_tpl->tpl_vars['stage']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['stage']->key;
?>
					<b><?php echo $_smarty_tpl->tpl_vars['key']->value;?>
</b>
					<ul>
					<?php  $_smarty_tpl->tpl_vars['action'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['action']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['stage']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['action']->key => $_smarty_tpl->tpl_vars['action']->value){
$_smarty_tpl->tpl_vars['action']->_loop = true;
?>
						<li><?php echo $_smarty_tpl->tpl_vars['action']->value;?>
</li>
					<?php } ?>
					</ul>
				<?php } ?>
				</div>
			</td>
			<td><?php echo $_smarty_tpl->tpl_vars['row']->value['size'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['row']->value['status'];?>
</td>
			<td>
				<a href="index.php?p=sabnzbd&delete=<?php echo $_smarty_tpl->tpl_vars['row']->value['nzo_id'];?>
&mode=history" onclick="return confirm('Really delete file \'<?php echo $_smarty_tpl->tpl_vars['row']->value['nzb_name'];?>
\'?');"><img src="images/red_x_<?php echo $_smarty_tpl->tpl_vars['osType']->value;?>
.png" border="0"></a>
			</td>
		</tr>
	<?php } ?>
	</table>
	</td></tr><tr><td align="center">
	Size: <b><?php echo $_smarty_tpl->tpl_vars['general']->value['total_size'];?>
</b> | This month: <b><?php echo $_smarty_tpl->tpl_vars['general']->value['month_size'];?>
</b> | This week: <b><?php echo $_smarty_tpl->tpl_vars['general']->value['week_size'];?>
</b>
	</td></tr></table>
	<br><br>
</div>
<?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</body>
</html>
<?php }} ?>