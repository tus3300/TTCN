<?php
if (!defined('NV_IS_FILE_ADMIN')) {
    exit('Stop!!!');
}

// Xử lý logic cho trang tạo sản phẩm
$xtpl = new XTemplate('create_product.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$xtpl->assign('LANG', \NukeViet\Core\Language::$lang_module);
$xtpl->assign('GLANG', \NukeViet\Core\Language::$lang_global);

// Nếu form được gửi, xử lý dữ liệu
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $product_name = $_POST['productname'];
    $category_id = $_POST['categoryid'];
    $description = $_POST['description'];
    $detailed_description = $_POST['detaileddescription'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $status = $_POST['status'];
    
    // Thư mục lưu ảnh
    $upload_dir = NV_ROOTDIR . '/src/uploads/products/';
    $image_url = '';

    // Kiểm tra nếu có ảnh được tải lên
    if (!empty($_FILES['imageurl']['name'])) {
        $image_name = time() . '_' . basename($_FILES['imageurl']['name']); // Đổi tên ảnh để tránh trùng
        $image_path = $upload_dir . $image_name;

        // Kiểm tra và tạo thư mục nếu chưa tồn tại
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        // Kiểm tra định dạng file hợp lệ
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($_FILES['imageurl']['type'], $allowed_types)) {
            // Di chuyển file tải lên thư mục đích
            if (move_uploaded_file($_FILES['imageurl']['tmp_name'], $image_path)) {
                $image_url = 'src/uploads/products/' . $image_name; // Đường dẫn ảnh lưu vào DB
            }
        }
    }

    // Lưu dữ liệu vào cơ sở dữ liệu (sử dụng prepare để tránh lỗi SQL Injection)
    $sql = "INSERT INTO " . NV_PREFIXLANG . "_" . $module_data . "_products (productname, categoryid, description, detaileddescription, imageurl, quantity, price, status) 
            VALUES (:productname, :categoryid, :description, :detaileddescription, :imageurl, :quantity, :price, :status)";
    
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':productname', $product_name);
    $stmt->bindParam(':categoryid', $category_id);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':detaileddescription', $detailed_description);
    $stmt->bindParam(':imageurl', $image_url);
    $stmt->bindParam(':quantity', $quantity);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':status', $status);
    $stmt->execute();

    // Chuyển hướng sau khi lưu
    nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=main');
}

// Lấy danh mục để hiển thị trong form
$sql_categories = "SELECT categoryid, categoryname FROM " . NV_PREFIXLANG . "_" . $module_data . "_categories";
$list_categories = $db->query($sql_categories)->fetchAll();

// Truyền dữ liệu vào template
foreach ($list_categories as $category) {
    $xtpl->assign('CATEGORY', [
        'id' => $category['categoryid'],
        'name' => $category['categoryname']
    ]);
    $xtpl->parse('main.category_option');
}

$xtpl->parse('main');
$contents = $xtpl->text('main');

// Hiển thị nội dung
include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
?>
