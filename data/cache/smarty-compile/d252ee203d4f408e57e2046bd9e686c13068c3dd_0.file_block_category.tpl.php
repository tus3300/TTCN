<?php
/* Smarty version 5.4.3, created on 2025-03-30 11:47:31
  from 'file:block_category.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.3',
  'unifunc' => 'content_67e8cce322d010_94895699',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd252ee203d4f408e57e2046bd9e686c13068c3dd' => 
    array (
      0 => 'block_category.tpl',
      1 => 1743267132,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_67e8cce322d010_94895699 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\TTCN\\themes\\default\\modules\\news\\smarty';
$_smarty_tpl->getSmarty()->getRuntime('TplFunction')->registerTplFunctions($_smarty_tpl, array (
  'menu' => 
  array (
    'compiled_filepath' => 'C:\\xampp\\htdocs\\TTCN\\data\\cache\\smarty-compile\\d252ee203d4f408e57e2046bd9e686c13068c3dd_0.file_block_category.tpl.php',
    'uid' => 'd252ee203d4f408e57e2046bd9e686c13068c3dd',
    'call_name' => 'smarty_template_function_menu_27141880167e8cce2f23395_76386562',
  ),
));
if (( !true || empty($_smarty_tpl->getValue('CONFIGS')['title_length'])) || $_smarty_tpl->getValue('CONFIGS')['title_length'] < 50) {
$_tmp_array = $_smarty_tpl->getValue('CONFIGS') ?? [];
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array['title_length'] = 60;
$_smarty_tpl->assign('CONFIGS', $_tmp_array, false, NULL);
}?>



<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->getValue('NV_STATIC_URL');?>
themes/<?php echo $_smarty_tpl->getValue('TEMPLATE');?>
/css/jquery.metisMenu.css" />
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->getValue('ASSETS_STATIC_URL');?>
/js/jquery/jquery.metisMenu.js"><?php echo '</script'; ?>
>

<div class="clearfix panel metismenu">
    <aside class="sidebar">
        <nav class="sidebar-nav">
            <?php $_smarty_tpl->getSmarty()->getRuntime('TplFunction')->callTemplateFunction($_smarty_tpl, 'menu', array('data'=>$_smarty_tpl->getValue('MENU')), true);?>

        </nav>
    </aside>
</div>

<?php echo '<script'; ?>
>
$(function() {
    $('#menu_<?php echo $_smarty_tpl->getValue('MENUID');?>
').metisMenu({
    toggle: false
    });
});
<?php echo '</script'; ?>
>
<?php }
/* smarty_template_function_menu_27141880167e8cce2f23395_76386562 */
if (!function_exists('smarty_template_function_menu_27141880167e8cce2f23395_76386562')) {
function smarty_template_function_menu_27141880167e8cce2f23395_76386562(\Smarty\Template $_smarty_tpl,$params) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\TTCN\\themes\\default\\modules\\news\\smarty';
$params = array_merge(array('name'=>'menu','data'=>array()), $params);
foreach ($params as $key => $value) {
$_smarty_tpl->assign($key, $value);
}
?>

<?php $_smarty_tpl->assign('i', 0, false, NULL);
if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('data')) > 0) {
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('data'), 'entry');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('entry')->value) {
$foreach1DoElse = false;
if ($_smarty_tpl->getValue('i') == 0) {?>
<ul<?php if ($_smarty_tpl->getValue('entry')['parentid'] == 0) {?> id="menu_<?php echo $_smarty_tpl->getValue('MENUID');?>
"<?php }?>>
<?php }?>
<li<?php if ($_smarty_tpl->getValue('entry')['active']) {?> class="active"<?php }?>><a href="<?php echo $_smarty_tpl->getValue('entry')['link'];?>
" rel="dofollow"<?php if ($_smarty_tpl->getValue('entry')['parentid'] != 0) {?> class="sf-with-ul"<?php }?> title="<?php echo $_smarty_tpl->getValue('entry')['title'];?>
"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('truncate')($_smarty_tpl->getValue('entry')['title'],$_smarty_tpl->getValue('CONFIGS')['title_length'],"...");?>
</a><?php if ($_smarty_tpl->getValue('entry')['parentid'] == 0 && !( !true || empty($_smarty_tpl->getValue('entry')['sub']))) {?><span class="fa arrow expand"></span><?php }
if (!( !true || empty($_smarty_tpl->getValue('entry')['sub']))) {
$_smarty_tpl->getSmarty()->getRuntime('TplFunction')->callTemplateFunction($_smarty_tpl, 'menu', array('data'=>$_smarty_tpl->getValue('entry')['sub']), true);
}?></li>
<?php $_smarty_tpl->assign('i', $_smarty_tpl->getValue('i')+1, false, NULL);
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);
if ($_smarty_tpl->getValue('i') > 0) {?>
</ul>
<?php }
}
}}
/*/ smarty_template_function_menu_27141880167e8cce2f23395_76386562 */
}
