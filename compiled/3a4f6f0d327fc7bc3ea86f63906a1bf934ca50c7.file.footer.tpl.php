<?php /* Smarty version Smarty-3.1.7, created on 2012-02-18 21:30:55
         compiled from "./templates/footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2496386624f29edfeabecc0-46338063%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3a4f6f0d327fc7bc3ea86f63906a1bf934ca50c7' => 
    array (
      0 => './templates/footer.tpl',
      1 => 1329629452,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2496386624f29edfeabecc0-46338063',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f29edfec7f19',
  'variables' => 
  array (
    'server_query' => 0,
    'osType' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f29edfec7f19')) {function content_4f29edfec7f19($_smarty_tpl) {?><div id="footer">
<a href="index.php?<?php echo $_smarty_tpl->tpl_vars['server_query']->value;?>
&osType=<?php if ($_smarty_tpl->tpl_vars['osType']->value=='tablet'){?>desktop<?php }else{ ?>tablet<?php }?>" class="link_<?php echo $_smarty_tpl->tpl_vars['osType']->value;?>
">Switch to <?php if ($_smarty_tpl->tpl_vars['osType']->value=='tablet'){?>desktop<?php }else{ ?>tablet<?php }?> view</a>
</div><?php }} ?>