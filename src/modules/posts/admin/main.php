<?php

/**
 * NukeViet Content Management System
 * @version 5.x
 * @author VINADES.,JSC <contact@vinades.vn>
 * @copyright (C) 2009-2025 VINADES.,JSC. All rights reserved
 * @license GNU/GPL version 2 or any later version
 * @see https://github.com/nukeviet The NukeViet CMS GitHub project
 */

if (!defined('NV_IS_FILE_ADMIN')) {
    exit('Stop!!!');
}

$page_title = $nv_Lang->getModule('list_product');

// Lấy thông tin danh mục đang được chọn (nếu có)
$category_filter = isset($_GET['category_filter']) ? $_GET['category_filter'] : '';

// Truy vấn danh sách sản phẩm, có thể thêm điều kiện lọc theo danh mục
$sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_products';
if ($category_filter) {
    $sql .= ' WHERE CategoryID = ' . $category_filter;
}
$sql .= ' ORDER BY productid DESC';
$_rows = $db->query($sql)->fetchAll();
$num = count($_rows);

$xtpl = new XTemplate('main.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$xtpl->assign('LANG', \NukeViet\Core\Language::$lang_module);
$xtpl->assign('GLANG', \NukeViet\Core\Language::$lang_global);

// Lấy danh sách danh mục
$sql_categories = 'SELECT categoryid, categoryname FROM ' . NV_PREFIXLANG . '_' . $module_data . '_categories';
$list_categories = $db->query($sql_categories)->fetchAll();

// Gửi danh mục vào XTemplate
foreach ($list_categories as $category) {
    $xtpl->assign('CATEGORY', [
        'id' => $category['categoryid'],
        'name' => $category['categoryname'],
        'selected' => ($category_filter == $category['categoryid']) ? 'selected' : '' // Đánh dấu danh mục đang được chọn
    ]); 
    $xtpl->parse('main.category_option'); // Parse block danh mục
}

// Truyền path vào tpl để cho nút thêm mới
$create_url = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=create_product';
$xtpl->assign('CREATE_URL', $create_url);

$create_url = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=main';
$xtpl->assign('FIITER', $create_url);

// Truy vấn danh mục của sản phẩm
$sql_category_name = 'SELECT categoryname FROM ' . NV_PREFIXLANG . '_' . $module_data . '_categories WHERE categoryid = :categoryid';
$stmt = $db->prepare($sql_category_name);

if ($num) {
    // Hiện bảng dữ liệu
    foreach ($_rows as $row) {
        // Truy vấn tên danh mục
        $stmt->execute(['categoryid' => $row['categoryid']]);
        $category = $stmt->fetch();

        // Lưu tên danh mục vào mảng dữ liệu của sản phẩm
        $row['category_name'] = $category ? $category['categoryname'] : 'Chưa xác định';

        // Các đường dẫn
        $row['edit_url'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=edit_product&amp;id=' . $row['productid'];
        $row['delete_url'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=delete_product&amp;id=' . $row['productid'];

        $xtpl->assign('ROW', $row);
        $xtpl->parse('main.loop');
    }
    $xtpl->parse('main');
    $contents = $xtpl->text('main');
} else {
    // Hiện thông báo chưa có dữ liệu
    $xtpl->parse('empty');
    $contents = $xtpl->text('empty');
}

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
