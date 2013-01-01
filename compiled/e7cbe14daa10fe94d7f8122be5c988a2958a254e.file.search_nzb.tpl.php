<?php /* Smarty version Smarty-3.1.7, created on 2012-04-06 23:56:59
         compiled from "./templates/search_nzb.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1211368724f29edfc27bcf2-77159604%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e7cbe14daa10fe94d7f8122be5c988a2958a254e' => 
    array (
      0 => './templates/search_nzb.tpl',
      1 => 1333781681,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1211368724f29edfc27bcf2-77159604',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f29edfe32d8a',
  'variables' => 
  array (
    'message' => 0,
    'osType' => 0,
    'category' => 0,
    'searchin' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f29edfe32d8a')) {function content_4f29edfe32d8a($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include '/var/www/Smarty/plugins/function.html_options.php';
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>Search for NZB Files to download</title>
<link href="css/standard.css" rel="Stylesheet" type="text/css" title="Standard">
<script type="text/javascript" src="js/ajax.js"></script>
</head>
<body onload="general_stats()">
<?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<div id='maincontent'>
	<h2>Search Files to Download</h2>
	<span id="servermessage"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</span>
	<form action="index.php?p=search_nzb" name="search" method="post">
	Search for NZBs to download by category.
	<br><br>
	<table>
		<tr>
			<td>Search: </td>
			<td><input type="text" name="query" size="30" class="textbox_<?php echo $_smarty_tpl->tpl_vars['osType']->value;?>
"> </td>
			<td> In: </td>
			<td>
				<select name="category" class="textbox_<?php echo $_smarty_tpl->tpl_vars['osType']->value;?>
">
				<option value="0" <?php if ($_smarty_tpl->tpl_vars['category']->value==0){?>SELECTED<?php }?>>(Everything)</option>
				<option value="movies-all" style="font-weight: bold;" <?php if ($_smarty_tpl->tpl_vars['category']->value=='movies-all'){?>SELECTED<?php }?>>Movies: ALL</option>
				<option value="1" <?php if ($_smarty_tpl->tpl_vars['category']->value==1){?>SELECTED<?php }?>>&nbsp;&nbsp;Movies: DVD</option>
				<option value="2" <?php if ($_smarty_tpl->tpl_vars['category']->value==2){?>SELECTED<?php }?>>&nbsp;&nbsp;Movies: Divx/Xvid</option>
				<option value="54" <?php if ($_smarty_tpl->tpl_vars['category']->value==54){?>SELECTED<?php }?>>&nbsp;&nbsp;Movies: BRRip</option>
				<option value="42" <?php if ($_smarty_tpl->tpl_vars['category']->value==42){?>SELECTED<?php }?>>&nbsp;&nbsp;Movies: HD (x264)</option>
				<option value="50" <?php if ($_smarty_tpl->tpl_vars['category']->value==50){?>SELECTED<?php }?>>&nbsp;&nbsp;Movies: HD (Image)</option>
				<option value="4" <?php if ($_smarty_tpl->tpl_vars['category']->value==4){?>SELECTED<?php }?>>&nbsp;&nbsp;Movies: Other</option>
				<option value="tv-all" style="font-weight: bold;" <?php if ($_smarty_tpl->tpl_vars['category']->value=='tv-all'){?>SELECTED<?php }?>>TV: ALL</option>
				<option value="5" <?php if ($_smarty_tpl->tpl_vars['category']->value==5){?>SELECTED<?php }?>>&nbsp;&nbsp;TV: DVD</option>
				<option value="6" <?php if ($_smarty_tpl->tpl_vars['category']->value==6){?>SELECTED<?php }?>>&nbsp;&nbsp;TV: SD</option>
				<option value="41" <?php if ($_smarty_tpl->tpl_vars['category']->value==41){?>SELECTED<?php }?>>&nbsp;&nbsp;TV: HD</option>
				<option value="7" <?php if ($_smarty_tpl->tpl_vars['category']->value==7){?>SELECTED<?php }?>>&nbsp;&nbsp;TV: Sport/Ent</option>
				<option value="8" <?php if ($_smarty_tpl->tpl_vars['category']->value==8){?>SELECTED<?php }?>>&nbsp;&nbsp;TV: Other</option>
				<option value="docu-all" style="font-weight: bold;" <?php if ($_smarty_tpl->tpl_vars['category']->value=='docu-all'){?>SELECTED<?php }?>>Documentaries: ALL</option>
				<option value="9" <?php if ($_smarty_tpl->tpl_vars['category']->value==9){?>SELECTED<?php }?>>&nbsp;&nbsp;Documentaries: STD</option>
				<option value="53" <?php if ($_smarty_tpl->tpl_vars['category']->value==53){?>SELECTED<?php }?>>&nbsp;&nbsp;Documentaries: HD</option>
				<option value="games-all" style="font-weight: bold;" <?php if ($_smarty_tpl->tpl_vars['category']->value=='games-all'){?>SELECTED<?php }?>>Games: ALL</option>
				<option value="10" <?php if ($_smarty_tpl->tpl_vars['category']->value==10){?>SELECTED<?php }?>>&nbsp;&nbsp;Games: PC</option>
				<option value="11" <?php if ($_smarty_tpl->tpl_vars['category']->value==11){?>SELECTED<?php }?>>&nbsp;&nbsp;Games: PS2</option>
				<option value="43" <?php if ($_smarty_tpl->tpl_vars['category']->value==43){?>SELECTED<?php }?>>&nbsp;&nbsp;Games: PS3</option>
				<option value="12" <?php if ($_smarty_tpl->tpl_vars['category']->value==12){?>SELECTED<?php }?>>&nbsp;&nbsp;Games: PSP</option>
				<option value="13" <?php if ($_smarty_tpl->tpl_vars['category']->value==13){?>SELECTED<?php }?>>&nbsp;&nbsp;Games: Xbox</option>
				<option value="14" <?php if ($_smarty_tpl->tpl_vars['category']->value==14){?>SELECTED<?php }?>>&nbsp;&nbsp;Games: Xbox360</option>
				<option value="56" <?php if ($_smarty_tpl->tpl_vars['category']->value==56){?>SELECTED<?php }?>>&nbsp;&nbsp;Games: Xbox360 (Other)</option>
				<option value="44" <?php if ($_smarty_tpl->tpl_vars['category']->value==44){?>SELECTED<?php }?>>&nbsp;&nbsp;Games: Wii</option>
				<option value="51" <?php if ($_smarty_tpl->tpl_vars['category']->value==51){?>SELECTED<?php }?>>&nbsp;&nbsp;Games: Wii VC</option>
				<option value="45" <?php if ($_smarty_tpl->tpl_vars['category']->value==45){?>SELECTED<?php }?>>&nbsp;&nbsp;Games: DS</option>
				<option value="17" <?php if ($_smarty_tpl->tpl_vars['category']->value==17){?>SELECTED<?php }?>>&nbsp;&nbsp;Games: Other</option>
				<option value="apps-all" style="font-weight: bold;" <?php if ($_smarty_tpl->tpl_vars['category']->value=='apps-all'){?>SELECTED<?php }?>>Apps: ALL</option>
				<option value="18" <?php if ($_smarty_tpl->tpl_vars['category']->value==18){?>SELECTED<?php }?>>&nbsp;&nbsp;Apps: PC</option>
				<option value="19" <?php if ($_smarty_tpl->tpl_vars['category']->value==19){?>SELECTED<?php }?>>&nbsp;&nbsp;Apps: Mac</option>
				<option value="52" <?php if ($_smarty_tpl->tpl_vars['category']->value==52){?>SELECTED<?php }?>>&nbsp;&nbsp;Apps: Portable</option>
				<option value="20" <?php if ($_smarty_tpl->tpl_vars['category']->value==20){?>SELECTED<?php }?>>&nbsp;&nbsp;Apps: Linux</option>
				<option value="21" <?php if ($_smarty_tpl->tpl_vars['category']->value==21){?>SELECTED<?php }?>>&nbsp;&nbsp;Apps: Other</option>
				<option value="music-all" style="font-weight: bold;" <?php if ($_smarty_tpl->tpl_vars['category']->value=='music-all'){?>SELECTED<?php }?>>Music: ALL</option>
				<option value="22" <?php if ($_smarty_tpl->tpl_vars['category']->value==22){?>SELECTED<?php }?>>&nbsp;&nbsp;Music: MP3 Albums</option>
				<option value="47" <?php if ($_smarty_tpl->tpl_vars['category']->value==47){?>SELECTED<?php }?>>&nbsp;&nbsp;Music: MP3 Singles</option>
				<option value="23" <?php if ($_smarty_tpl->tpl_vars['category']->value==23){?>SELECTED<?php }?>>&nbsp;&nbsp;Music: Lossless</option>
				<option value="24" <?php if ($_smarty_tpl->tpl_vars['category']->value==24){?>SELECTED<?php }?>>&nbsp;&nbsp;Music: DVD</option>
				<option value="25" <?php if ($_smarty_tpl->tpl_vars['category']->value==25){?>SELECTED<?php }?>>&nbsp;&nbsp;Music: Video</option>
				<option value="27" <?php if ($_smarty_tpl->tpl_vars['category']->value==27){?>SELECTED<?php }?>>&nbsp;&nbsp;Music: Other</option>
				<option value="28" style="font-weight: bold;" <?php if ($_smarty_tpl->tpl_vars['category']->value==28){?>SELECTED<?php }?>>Anime: ALL</option>
				<option value="other-all" style="font-weight: bold;" <?php if ($_smarty_tpl->tpl_vars['category']->value=='other-all'){?>SELECTED<?php }?>>Other: ALL</option>
				<option value="49" <?php if ($_smarty_tpl->tpl_vars['category']->value==49){?>SELECTED<?php }?>>&nbsp;&nbsp;Other: Audio Books</option>
				<option value="26" <?php if ($_smarty_tpl->tpl_vars['category']->value==26){?>SELECTED<?php }?>>&nbsp;&nbsp;Other: Radio</option>
				<option value="36" <?php if ($_smarty_tpl->tpl_vars['category']->value==36){?>SELECTED<?php }?>>&nbsp;&nbsp;Other: E-Books</option>
				<option value="37" <?php if ($_smarty_tpl->tpl_vars['category']->value==37){?>SELECTED<?php }?>>&nbsp;&nbsp;Other: Images</option>
				<option value="55" <?php if ($_smarty_tpl->tpl_vars['category']->value==55){?>SELECTED<?php }?>>&nbsp;&nbsp;Other: Android</option>
				<option value="38" <?php if ($_smarty_tpl->tpl_vars['category']->value==38){?>SELECTED<?php }?>>&nbsp;&nbsp;Other: iOS/iPhone</option>				
				<option value="39" <?php if ($_smarty_tpl->tpl_vars['category']->value==39){?>SELECTED<?php }?>>&nbsp;&nbsp;Other: Extra Pars/Fills</option>
				<option value="40" <?php if ($_smarty_tpl->tpl_vars['category']->value==40){?>SELECTED<?php }?>>&nbsp;&nbsp;Other: Other</option>
				</select>
			</td>
		</tr>
	</table>
	Optional:
	<table>
		<tr>
			<td>Min Filesize:</td>
			<td><input type="text" name="minSize" size="10" class="textbox_<?php echo $_smarty_tpl->tpl_vars['osType']->value;?>
">MB</td>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td>Max Filesize:</td>
			<td><input type="text" name="maxSize" size="10" class="textbox_<?php echo $_smarty_tpl->tpl_vars['osType']->value;?>
">MB</td>
		</td>
	</table>
	<table>
		<tr>
			<td>Match:</td>
			<td><?php echo smarty_function_html_options(array('name'=>'searchin','options'=>$_smarty_tpl->tpl_vars['searchin']->value,'selected'=>'name','class'=>"textbox_".($_smarty_tpl->tpl_vars['osType']->value)),$_smarty_tpl);?>
</td>
		</td>
	</table>
	<br>
	
	<input type="submit" name="action" value="Search" class="button_<?php echo $_smarty_tpl->tpl_vars['osType']->value;?>
">
	</form>
	<br><br>
</div>
<?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</body>
</html>
<?php }} ?>