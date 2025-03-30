<?php
/* Smarty version 5.4.3, created on 2025-03-30 11:47:31
  from 'file:global.QR_code.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.3',
  'unifunc' => 'content_67e8cce3865470_74451897',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0995a8311ee38df737810fc5fd83df98faf35730' => 
    array (
      0 => 'global.QR_code.tpl',
      1 => 1743267132,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_67e8cce3865470_74451897 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\TTCN\\themes\\default\\blocks\\smarty';
?><button type="button" class="qrcode btn btn-primary active btn-xs text-black" title="<?php echo $_smarty_tpl->getValue('QRCODE')['title'];?>
" data-toggle="ftip" data-target=".barcode" data-click="y" data-load="no" data-img=".barcode img" data-url="<?php echo $_smarty_tpl->getValue('QRCODE')['selfurl'];?>
"><em class="icon-qrcode icon-lg"></em>&nbsp;QR-code</button>
<div class="barcode hidden">
    <img src="<?php echo (defined('ASSETS_STATIC_URL') ? constant('ASSETS_STATIC_URL') : null);?>
/images/pix.svg" alt="<?php echo $_smarty_tpl->getValue('QRCODE')['title'];?>
" title="<?php echo $_smarty_tpl->getValue('QRCODE')['title'];?>
" width="170" height="170">
</div>
<?php }
}
