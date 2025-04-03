<?php
if (!defined('NV_IS_MOD_POST')) {
    exit('Stop!!!');
}

$xtpl = new XTemplate('products.tpl', NV_ROOTDIR . '/themes/' . $global_config['site_theme'] . '/modules/' . $module_file);
$xtpl->assign('LANG', \NukeViet\Core\Language::$lang_module);
$xtpl->assign('MODULE_NAME', $module_name);

$sql = "SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_Products WHERE Status = 'Visible'";
$products = $db->query($sql)->fetchAll();

foreach ($products as $product) {
    $xtpl->assign('PRODUCT', [
        'ProductID' => $product['ProductID'],
        'ProductName' => $product['ProductName'],
        'ImageURL' => $product['ImageURL'],
        'Price' => number_format($product['Price'], 0, ',', '.')
    ]);
    $xtpl->parse('main.product');
}

$xtpl->parse('main');
$contents = $xtpl->text('main');

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';