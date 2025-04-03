<?php
if (!defined('NV_IS_MOD_POSTS')) { 
    exit('Stop!!!');
}

$product_id = $nv_Request->get_int('id', 'get', 0);
if ($product_id <= 0) {
    nv_redirect_location(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name);
}

$sql = "SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_Products WHERE ProductID = :product_id AND Status = 'Visible'";
$sth = $db->prepare($sql);
$sth->bindParam(':product_id', $product_id, PDO::PARAM_INT);
$sth->execute();
$product = $sth->fetch();

if (!$product) {
    nv_redirect_location(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name);
}

$xtpl = new XTemplate('product_detail.tpl', NV_ROOTDIR . '/themes/' . $global_config['site_theme'] . '/modules/' . $module_file);
$xtpl->assign('LANG', \NukeViet\Core\Language::$lang_module);
$xtpl->assign('PRODUCT', [
    'ProductName' => $product['ProductName'],
    'ImageURL' => $product['ImageURL'],
    'Price' => number_format($product['Price'], 0, ',', '.'),
    'Description' => $product['Description'],
    'DetailedDescription' => $product['DetailedDescription']
]);

$xtpl->parse('main');
$contents = $xtpl->text('main');

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';