<?php
if (!defined('NV_IS_FILE_ADMIN')) {
    exit('Stop!!!');
}

$page_title = $nv_Lang->getModule('revenue');

// Lấy tham số bộ lọc từ GET
$start_date = $nv_Request->get_title('start_date', 'get', '');
$end_date = $nv_Request->get_title('end_date', 'get', '');
$all = $nv_Request->get_bool('all', 'get', false);

// Khởi tạo các biến mặc định
$total_revenue = 0;
$orders = [];
$labels_json = json_encode([]);
$data_json = json_encode([]);

// Chỉ thực hiện truy vấn nếu có start_date, hoặc chọn "Tất cả"
if ($all || $start_date) {
    // Xây dựng điều kiện WHERE
    $where = "status = 'Completed'";
    if (!$all) {
        // Chuyển định dạng ngày từ DD/MM/YYYY sang YYYY-MM-DD để so sánh trong SQL
        $start_date_sql = implode('-', array_reverse(explode('/', $start_date)));
        
        if ($end_date) {
            // Nếu có cả start_date và end_date, lấy trong khoảng thời gian
            $end_date_sql = implode('-', array_reverse(explode('/', $end_date)));
            $where .= " AND orderdate BETWEEN '" . $start_date_sql . " 00:00:00' AND '" . $end_date_sql . " 23:59:59'";
        } else {
            // Nếu chỉ có start_date, lấy doanh thu của ngày đó
            $where .= " AND DATE(orderdate) = '" . $start_date_sql . "'";
        }
    }

    // Lấy danh sách đơn hàng
    $sql = "SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_orders WHERE " . $where . " ORDER BY orderdate DESC";
    $orders = $db->query($sql)->fetchAll();

    // Tính tổng doanh thu
    foreach ($orders as $order) {
        $total_revenue += isset($order['totalamount']) ? (int)$order['totalamount'] : 0;
    }

    // Lấy dữ liệu cho biểu đồ (doanh thu theo ngày)
    $sql_chart = "SELECT DATE(orderdate) AS date, SUM(totalamount) AS daily_revenue 
                  FROM " . NV_PREFIXLANG . "_" . $module_data . "_orders 
                  WHERE " . $where . " 
                  GROUP BY DATE(orderdate)";
    $chart_data = $db->query($sql_chart)->fetchAll();

    $labels = [];
    $data = [];
    foreach ($chart_data as $row) {
        $labels[] = $row['date'];
        $data[] = $row['daily_revenue'];
    }
    $labels_json = json_encode($labels);
    $data_json = json_encode($data);
}

if ($start_date) {
    $start_date_parts = explode('/', $start_date);
    if (count($start_date_parts) !== 3 || !checkdate($start_date_parts[1], $start_date_parts[0], $start_date_parts[2])) {
        $start_date = ''; // Bỏ qua nếu định dạng sai
    }
}
if ($end_date) {
    $end_date_parts = explode('/', $end_date);
    if (count($end_date_parts) !== 3 || !checkdate($end_date_parts[1], $end_date_parts[0], $end_date_parts[2])) {
        $end_date = ''; // Bỏ qua nếu định dạng sai
    }
}

// Tải template
$xtpl = new XTemplate('revenue.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$xtpl->assign('LANG', \NukeViet\Core\Language::$lang_module);
$xtpl->assign('PAGE_TITLE', $page_title);
$xtpl->assign('TOTAL_REVENUE', number_format($total_revenue, 0, ',', '.'));
$xtpl->assign('LABELS', $labels_json);
$xtpl->assign('DATA', $data_json);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('NV_BASE_ADMINURL', NV_BASE_ADMINURL);
$xtpl->assign('NV_NAME_VARIABLE', NV_NAME_VARIABLE);
$xtpl->assign('NV_OP_VARIABLE', NV_OP_VARIABLE);
$xtpl->assign('START_DATE', $start_date);
$xtpl->assign('END_DATE', $end_date);
$xtpl->assign('ALL_CHECKED', $all ? 'checked' : '');

// Hiển thị biểu đồ hoặc thông báo không có dữ liệu
if (!empty($orders)) {
    $xtpl->parse('main.chart'); // Hiển thị biểu đồ
} else {
    $xtpl->parse('main.no_data'); // Hiển thị thông báo không có dữ liệu
}

$xtpl->parse('main');
$contents = $xtpl->text('main');

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';