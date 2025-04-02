<?php

/**
 * NukeViet Content Management System
 * @version 5.x
 * @author VINADES.,JSC
 * @copyright (C) 2009-2025 VINADES.,JSC. All rights reserved
 * @license GNU/GPL version 2 or any later version
 */

if (!defined('NV_IS_FILE_ADMIN')) {
    exit('Stop!!!');
}

$productid = isset($_GET['id']) ? intval($_GET['id']) : 0;
$xtpl = new XTemplate('edit_product.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$xtpl->assign('LANG', \NukeViet\Core\Language::$lang_module);
$xtpl->assign('GLANG', \NukeViet\Core\Language::$lang_global);

// Kiểm tra ID hợp lệ
if ($productid <= 0) {
    header('Location: index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=main');
    exit();
}

// Truy vấn lấy thông tin sản phẩm
$sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_products WHERE productid = :productid';
$stmt = $db->prepare($sql);
$stmt->bindParam(':productid', $productid, PDO::PARAM_INT);
$stmt->execute();
$product = $stmt->fetch();

if (!$product) {
    header('Location: index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=main');
    exit();
}

// Nếu có dữ liệu gửi đi (POST), xử lý cập nhật
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productname = isset($_POST['productname']) ? trim($_POST['productname']) : '';
    $price = isset($_POST['price']) ? floatval($_POST['price']) : 0;
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 0;
    $status = isset($_POST['status']) ? intval($_POST['status']) : 0;
    $description = isset($_POST['description']) ? trim($_POST['description']) : '';
    $detaileddescription = isset($_POST['detaileddescription']) ? trim($_POST['detaileddescription']) : '';

    if (empty($productname) || $price <= 0) {
        echo '<script>alert("Tên sản phẩm và giá không hợp lệ!");</script>';
    } else {
        $sql = 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_products 
                SET productname = :productname, price = :price, quantity = :quantity, status = :status, 
                    description = :description, detaileddescription = :detaileddescription
                WHERE productid = :productid';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':productname', $productname, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price, PDO::PARAM_STR);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':detaileddescription', $detaileddescription, PDO::PARAM_STR);
        $stmt->bindParam(':productid', $productid, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo '<script>alert("Cập nhật sản phẩm thành công!"); window.location.href="index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=main";</script>';
        } else {
            echo '<script>alert("Lỗi! Không thể cập nhật sản phẩm.");</script>';
        }
    }
}

// Gán dữ liệu sản phẩm vào giao diện
$xtpl->assign('PRODUCT', $product);
$xtpl->parse('main');
$contents = $xtpl->text('main');
echo '<pre>';
print_r($product);
echo '</pre>';
include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
