<?php
if (!defined('NV_IS_MOD_POSTS')) { 
    exit('Stop!!!');
}

// Đường dẫn cơ bản của module
$base_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name;

// Lấy số trang hiện tại
$page = $nv_Request->get_int('page', 'get', 1);
if ($page <= 0) {
    $page = 1;
}

// Thiết lập URL canonical cho SEO
$page_url = $base_url;
if ($page > 1) {
    $page_url .= '&page=' . $page;
}
$canonicalUrl = NV_MAIN_DOMAIN . $page_url;

// Thiết lập tiêu đề và từ khóa
$page_title = $module_info['site_title'];
$key_words = $module_info['keywords'];

// Số sản phẩm trên mỗi trang
$per_page = 10; // Bạn có thể thay đổi số này tùy ý

// Lấy tổng số sản phẩm
$db->sqlreset()
    ->select('COUNT(*)')
    ->from(NV_PREFIXLANG . '_' . $module_data . '_products')
    ->where('Status = "Visible"');
$num_items = $db->query($db->sql())->fetchColumn();

// Tạo phân trang
$prevPage = $nextPage = 0;
betweenURLs($page, ceil($num_items / $per_page), $base_url, '/page-', $prevPage, $nextPage);

// Lấy danh sách sản phẩm
$array_data = [];
$db->sqlreset()
    ->select('*')
    ->from(NV_PREFIXLANG . '_' . $module_data . '_products')
    ->where('Status = "Visible"')
    ->order('productid DESC')
    ->limit($per_page)
    ->offset(($page - 1) * $per_page);

$result = $db->query($db->sql());
while ($row = $result->fetch()) {
    $row['ImageURL'] = !empty($row['imageurl']) ? NV_BASE_SITEURL . $row['imageurl'] : '';
    $row['Price'] = number_format($row['price'], 0, ',', '.');
    $array_data[$row['productid']] = $row;
}

// Tạo phân trang HTML
$generate_page = nv_alias_page($page_title, $base_url, $num_items, $per_page, $page);

// Cập nhật tiêu đề nếu ở trang lớn hơn 1
if ($page > 1) {
    $page_title .= NV_TITLEBAR_DEFIS . $nv_Lang->getGlobal('page') . ' ' . $page;
}

// Tải template
$xtpl = new XTemplate('products.tpl', NV_ROOTDIR . '/themes/' . $global_config['site_theme'] . '/modules/' . $module_file);
$xtpl->assign('LANG', \NukeViet\Core\Language::$lang_module);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('NV_BASE_SITEURL', NV_BASE_SITEURL);
$xtpl->assign('NV_LANG_VARIABLE', NV_LANG_VARIABLE);
$xtpl->assign('NV_LANG_DATA', NV_LANG_DATA);
$xtpl->assign('NV_NAME_VARIABLE', NV_NAME_VARIABLE);
$xtpl->assign('NV_OP_VARIABLE', NV_OP_VARIABLE);

// Hiển thị danh sách sản phẩm
foreach ($array_data as $product) {
    $xtpl->assign('PRODUCT', [
        'ProductID' => $product['productid'],
        'ProductName' => $product['productname'],
        'ImageURL' => $product['ImageURL'],
        'Price' => $product['Price']
    ]);
    $xtpl->parse('main.product');
}

// Thêm phân trang vào template
$xtpl->assign('GENERATE_PAGE', $generate_page);
$xtpl->parse('main.generate_page');

$xtpl->parse('main');
$contents = $xtpl->text('main');

// Thiết lập các meta tag cho SEO
$meta_property['og:title'] = $page_title;
$meta_property['og:description'] = $module_info['description'] ?? $page_title;
$meta_property['og:url'] = $canonicalUrl;

// Xuất giao diện
include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';