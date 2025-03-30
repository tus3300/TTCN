<?php
/* Smarty version 5.4.3, created on 2025-03-30 11:47:21
  from 'file:widget_usrtotal.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.3',
  'unifunc' => 'content_67e8ccd98a99f6_52531707',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f2734904626ca9b9772dc5f14cba9a4d24195bd1' => 
    array (
      0 => 'widget_usrtotal.tpl',
      1 => 1743267132,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_67e8ccd98a99f6_52531707 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\TTCN\\themes\\admin_future\\modules\\users';
?><div class="card-body flex-grow-1 flex-shrink-1">
    <div class="d-flex justify-content-between">
        <div>
            <h5 class="card-title"><?php echo $_smarty_tpl->getValue('LANG')->getModule('siteinfo_user');?>
</h5>
            <div class="fs-2 fw-semibold">
                <?php echo $_smarty_tpl->getValue('NUM');?>

            </div>
        </div>
        <div>
            <div class="couter-icon">
                <span class="bg-info-subtle rounded-circle fs-2">
                    <i class="fa-regular fa-user text-info"></i>
                </span>
            </div>
        </div>
    </div>
</div>
<?php }
}
