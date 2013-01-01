<?php /* Smarty version Smarty-3.1.7, created on 2012-02-18 23:48:20
         compiled from "./templates/result_nzb.tpl" */ ?>
<?php /*%%SmartyHeaderCode:645548244f29fd20f07a04-62175857%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '058cf232fe97224eaf7eca4b9f9e08dca3b5aa03' => 
    array (
      0 => './templates/result_nzb.tpl',
      1 => 1329629452,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '645548244f29fd20f07a04-62175857',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f29fd21e73a7',
  'variables' => 
  array (
    'osType' => 0,
    'message' => 0,
    'results' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f29fd21e73a7')) {function content_4f29fd21e73a7($_smarty_tpl) {?><?php if (!is_callable('smarty_function_cycle')) include '/var/www/Smarty/plugins/function.cycle.php';
if (!is_callable('smarty_modifier_date_format')) include '/var/www/Smarty/plugins/modifier.date_format.php';
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>NZB Search Results</title>
<link href="css/standard.css" rel="Stylesheet" type="text/css" title="Standard">
<script type="text/javascript" src="js/functions.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>
<script type="text/javascript">
	var saved_id;
	function add_to_queue(nzbid){
		saved_id = nzbid;
		document.getElementById('addlink_'+nzbid).innerHTML = 'Please Wait...';
		MakeRequest('ajax.php?p=add_nzb_id&nzbid='+nzbid, nzbid, '<b><i>', '</i></b>', null, 'added_to_queue', false);
	}

	function added_to_queue(){
		var id = saved_id;
		var span = document.getElementById('addlink_'+id);
		var result = document.getElementById(id);
		if (result.innerHTML.indexOf("ERROR: ") != -1)
			span.innerHTML = "<a href=\"javascript:add_to_queue('"+id+"');\" class=\"link_<?php echo $_smarty_tpl->tpl_vars['osType']->value;?>
\">Add To Queue</a>";
		else
			span.innerHTML = 'Successfully Added';
	}
</script>
</head>
<body onload="general_stats()">
<div id="dhtmltooltip"></div> <!-- For ddrive -->
<script type="text/javascript" src="js/ddrive.js"></script>
<?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<div id='maincontent'>
	<h2>Search Results</h2>
	<span id="servermessage"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</span>
	<?php if ($_smarty_tpl->tpl_vars['results']->value){?>
	<table class="browse" border="0">
	<tr class="head"><th>Image</th><th>Details</th><th>Size</th><th>Hits/Comm</th><th>Age</th></tr>
	<?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['results']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
	<tr class="<?php echo smarty_function_cycle(array('values'=>'odd,'),$_smarty_tpl);?>
 row_<?php echo $_smarty_tpl->tpl_vars['osType']->value;?>
" onmouseover="Highlight(this)" onmouseout="Lowlight(this)">
		<td onmouseover="<?php if ($_smarty_tpl->tpl_vars['row']->value['IMAGE']){?>ddrivetip('<img src=\'<?php echo $_smarty_tpl->tpl_vars['row']->value['IMAGE'];?>
\'>', '#EFEFEF', <?php echo $_smarty_tpl->tpl_vars['row']->value['IMGWIDTH'];?>
);<?php }?>" onmouseout="<?php if ($_smarty_tpl->tpl_vars['row']->value['IMAGE']){?>hideddrivetip();<?php }?>">
			<?php if ($_smarty_tpl->tpl_vars['row']->value['IMAGE']){?><img src="<?php echo $_smarty_tpl->tpl_vars['row']->value['IMAGE'];?>
" width="90" height="130" border="0" alt="Image <?php echo $_smarty_tpl->tpl_vars['row']->value['NZBID'];?>
"><?php }else{ ?><img src="images/no-image.jpg" border="0" alt="No image available"><?php }?>
		</td>
		<td valign="top">
			<b><?php echo $_smarty_tpl->tpl_vars['row']->value['NZBNAME'];?>
</b><br>
			> <?php echo $_smarty_tpl->tpl_vars['row']->value['CATEGORY'];?>
<br>
			<b>Uploaded on:</b> <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['row']->value['USENET_DATE'],"%m/%d/%Y %l:%M %p");?>
, <?php echo $_smarty_tpl->tpl_vars['row']->value['USENET_AGE'];?>
 (ago)<br>
			<b>Indexed on:</b> <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['row']->value['INDEX_DATE'],"%m/%d/%Y %l:%M %p");?>
, <?php echo $_smarty_tpl->tpl_vars['row']->value['INDEX_AGE'];?>
 (ago)<br>
			<b>Size:</b> <?php echo $_smarty_tpl->tpl_vars['row']->value['SIZE'];?>
<br>
			<b>Group:</b> <a href="http://nzbmatrix.com/nzb.php?grp=<?php echo $_smarty_tpl->tpl_vars['row']->value['GROUP'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['row']->value['GROUP'];?>
</a><br>
			<br>
			<span id='addlink_<?php echo $_smarty_tpl->tpl_vars['row']->value['NZBID'];?>
'><a href="javascript:enable_div('break_<?php echo $_smarty_tpl->tpl_vars['row']->value['NZBID'];?>
'); add_to_queue('<?php echo $_smarty_tpl->tpl_vars['row']->value['NZBID'];?>
');" class="link_<?php echo $_smarty_tpl->tpl_vars['osType']->value;?>
">Add To Queue</a></span>&nbsp;&nbsp;|&nbsp;
			<a href="index.php?p=search_nzb&nzbid=<?php echo $_smarty_tpl->tpl_vars['row']->value['NZBID'];?>
&action=download" class="link_<?php echo $_smarty_tpl->tpl_vars['osType']->value;?>
">Download NZB</a>&nbsp;&nbsp;|&nbsp;
			<a href="http://nzbmatrix.com/nzb-details.php?id=<?php echo $_smarty_tpl->tpl_vars['row']->value['NZBID'];?>
&hit=1" target="_blank" class="link_<?php echo $_smarty_tpl->tpl_vars['osType']->value;?>
">View on NZBMatrix</a>
			<div id='break_<?php echo $_smarty_tpl->tpl_vars['row']->value['NZBID'];?>
' class='hidden'>
				<span id='<?php echo $_smarty_tpl->tpl_vars['row']->value['NZBID'];?>
'></span>
			</div>
		</td>
		<td align="center"><?php echo $_smarty_tpl->tpl_vars['row']->value['SIZE'];?>
</td>
		<td align="center"><?php echo $_smarty_tpl->tpl_vars['row']->value['HITS'];?>
/<?php echo $_smarty_tpl->tpl_vars['row']->value['COMMENTS'];?>
</td>
		<td align="center"><?php echo $_smarty_tpl->tpl_vars['row']->value['INDEX_AGE'];?>
</td>
	</tr>
	<?php } ?>
	</table>
	<?php }?>
	<br><br>
	<a href="index.php?p=search_nzb" class="link_<?php echo $_smarty_tpl->tpl_vars['osType']->value;?>
">Search again</a>
</div>
<?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</body>
</html>
<?php }} ?>