<?php
/* Smarty version 5.4.3, created on 2025-03-30 11:47:21
  from 'file:widget_contacttotal.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.3',
  'unifunc' => 'content_67e8ccd99f4410_47425809',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '896266af7d2e5c306dc67bc44f9455415538b1f9' => 
    array (
      0 => 'widget_contacttotal.tpl',
      1 => 1743267132,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_67e8ccd99f4410_47425809 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\TTCN\\themes\\admin_future\\modules\\contact';
?><div class="card-body flex-grow-1 flex-shrink-1">
    <div class="d-flex justify-content-between">
        <div>
            <h5 class="card-title"><?php echo $_smarty_tpl->getValue('LANG')->getModule('siteinfo_all');?>
</h5>
            <div class="fs-2 fw-semibold">
                <?php echo $_smarty_tpl->getValue('NUM');?>

            </div>
        </div>
        <div>
            <div class="couter-icon">
                <span class="bg-info-subtle rounded-circle fs-2">
                    <i class="fa-solid fa-phone text-info"></i>
                </span>
            </div>
        </div>
    </div>
</div>
<?php }
}
