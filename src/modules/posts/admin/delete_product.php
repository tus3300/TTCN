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
$confirm = isset($_GET['confirm']) ? intval($_GET['confirm']) : 0;

// Kiểm tra ID hợp lệ
if ($productid <= 0) {
    echo '<script>alert("ID sản phẩm không hợp lệ!"); window.location.href="index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=main";</script>';
    exit();
}

// Kiểm tra sản phẩm có tồn tại không
$sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_products WHERE productid = :productid';
$stmt = $db->prepare($sql);
$stmt->bindParam(':productid', $productid, PDO::PARAM_INT);
$stmt->execute();
$product = $stmt->fetch();

if (!$product) {
    echo '<script>alert("Sản phẩm không tồn tại!"); window.location.href="index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=main";</script>';
    exit();
}

// Nếu chưa có xác nhận từ người dùng, hiển thị hộp thoại xác nhận
if ($confirm !== 1) {
    echo '<script>
        if (confirm("Bạn có chắc chắn muốn xóa sản phẩm: ' . addslashes($product['productname']) . ' không?")) {
            window.location.href = "index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=delete_product&id=' . $productid . '&confirm=1";
        } else {
            window.location.href = "index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=main";
        }
    </script>';
    exit();
}

// Nếu đã xác nhận, thực hiện xóa sản phẩm
$sql = 'DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_products WHERE productid = :productid';
$stmt = $db->prepare($sql);
$stmt->bindParam(':productid', $productid, PDO::PARAM_INT);

if ($stmt->execute()) {
    echo '<script>alert("Xóa sản phẩm thành công!"); window.location.href="index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=main";</script>';
} else {
    echo '<script>alert("Lỗi! Không thể xóa sản phẩm."); window.location.href="index.php?' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=main";</script>';
}
