<?php
/* Smarty version 5.4.3, created on 2025-03-30 11:47:33
  from 'file:block.contact_form.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.3',
  'unifunc' => 'content_67e8cce53e77d8_53585420',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4c37a52857c6b9b516761240e7aa747d842d6c8d' => 
    array (
      0 => 'block.contact_form.tpl',
      1 => 1743267132,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_67e8cce53e77d8_53585420 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\TTCN\\themes\\default\\modules\\contact\\smarty';
?><link rel="StyleSheet" href="<?php echo $_smarty_tpl->getValue('CSS');?>
">
<!-- START FORFOOTER -->
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->getValue('JS');?>
"><?php echo '</script'; ?>
>
<div id="contactButton" class="box-shadow">
    <button type="button" class="ctb btn btn-primary btn-sm" data-module="<?php echo $_smarty_tpl->getValue('MODULE');?>
"><em class="fa fa-pencil-square-o"></em><?php echo $_smarty_tpl->getValue('LANG')->getGlobal('feedback');?>
</button>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <button type="button" class="close">&times;</button>
            <?php echo $_smarty_tpl->getValue('LANG')->getGlobal('feedback');?>

        </div>
        <div class="panel-body" data-cs="<?php echo (defined('NV_CHECK_SESSION') ? constant('NV_CHECK_SESSION') : null);?>
"></div>
    </div>
</div>
<!-- END FORFOOTER -->
<?php }
}
