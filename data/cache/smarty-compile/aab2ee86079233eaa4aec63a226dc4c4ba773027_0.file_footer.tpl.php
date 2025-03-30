<?php
/* Smarty version 5.4.3, created on 2025-03-30 11:46:42
  from 'file:footer.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.3',
  'unifunc' => 'content_67e8ccb20cc172_15326065',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'aab2ee86079233eaa4aec63a226dc4c4ba773027' => 
    array (
      0 => 'footer.tpl',
      1 => 1743267132,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_67e8ccb20cc172_15326065 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\TTCN\\themes\\admin_future\\system';
?>        [THEME_ERROR_INFO]
    <?php if ($_smarty_tpl->getValue('IS_IE')) {?>
    <div class="nv-offcanvas text-bg-warning p-3 show">
        <?php echo $_smarty_tpl->getValue('LANG')->getGlobal('chromeframe');?>

    </div>
    <?php }?>
    <?php echo '<script'; ?>
 type="text/javascript" src="<?php echo (defined('NV_BASE_SITEURL') ? constant('NV_BASE_SITEURL') : null);?>
themes/<?php echo $_smarty_tpl->getValue('ADMIN_THEME');?>
/js/bootstrap.bundle.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript" src="<?php echo (defined('NV_BASE_SITEURL') ? constant('NV_BASE_SITEURL') : null);?>
themes/<?php echo $_smarty_tpl->getValue('ADMIN_THEME');?>
/js/nv.core.js"><?php echo '</script'; ?>
>
    <?php if (!( !true || empty($_smarty_tpl->getValue('GCONFIG')['notification_active'])) && !(!( !$_smarty_tpl->hasVariable('MODULE_NAME') || empty($_smarty_tpl->getValue('MODULE_NAME'))) && $_smarty_tpl->getValue('MODULE_NAME') == 'siteinfo' && $_smarty_tpl->getValue('OP') == 'notification')) {?>
    <?php echo '<script'; ?>
 src="<?php echo (defined('ASSETS_STATIC_URL') ? constant('ASSETS_STATIC_URL') : null);?>
/js/jquery/jquery.timeago.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo (defined('ASSETS_STATIC_URL') ? constant('ASSETS_STATIC_URL') : null);?>
/js/language/jquery.timeago-<?php echo (defined('NV_LANG_INTERFACE') ? constant('NV_LANG_INTERFACE') : null);?>
.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo (defined('NV_BASE_SITEURL') ? constant('NV_BASE_SITEURL') : null);?>
themes/<?php echo $_smarty_tpl->getValue('ADMIN_THEME');?>
/js/nv.notification.js"><?php echo '</script'; ?>
>
    <?php }?>
</body>
</html>
<?php }
}
