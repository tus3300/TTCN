<?php
if (!defined('NV_IS_FILE_ADMIN')) {
    exit('Stop!!!');
}

$page_title = $nv_Lang->getModule('revenue');

// Lấy tham số bộ lọc từ GET
$day = $nv_Request->get_int('day', 'get', 0);
$month = $nv_Request->get_int('month', 'get', 0);
$year = $nv_Request->get_int('year', 'get', 0);
$all = $nv_Request->get_bool('all', 'get', false);

// Xây dựng điều kiện WHERE
$where = "Status = 'Completed'";
if (!$all) {
    if ($day) $where .= " AND DAY(OrderDate) = " . $db->quote($day);
    if ($month) $where .= " AND MONTH(OrderDate) = " . $db->quote($month);
    if ($year) $where .= " AND YEAR(OrderDate) = " . $db->quote($year);
}

// Lấy danh sách đơn hàng
$sql = "SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_Orders WHERE " . $where . " ORDER BY OrderDate DESC";
$orders = $db->query($sql)->fetchAll();

// Tính tổng doanh thu
$total_revenue = 0;
foreach ($orders as $order) {
    $total_revenue += $order['TotalAmount'];
}

// Lấy dữ liệu cho biểu đồ (doanh thu theo ngày)
$sql_chart = "SELECT DATE(OrderDate) AS date, SUM(TotalAmount) AS daily_revenue 
              FROM " . NV_PREFIXLANG . "_" . $module_data . "_Orders 
              WHERE " . $where . " 
              GROUP BY DATE(OrderDate)";
$chart_data = $db->query($sql_chart)->fetchAll();

$labels = [];
$data = [];
foreach ($chart_data as $row) {
    $labels[] = $row['date'];
    $data[] = $row['daily_revenue'];
}
$labels_json = json_encode($labels);
$data_json = json_encode($data);

// Lấy chi tiết đơn hàng
$order_ids = array_column($orders, 'OrderID');
$order_details = [];
if (!empty($order_ids)) {
    $sql_details = "SELECT od.*, p.ProductName 
                    FROM " . NV_PREFIXLANG . "_" . $module_data . "_OrderDetails od 
                    JOIN " . NV_PREFIXLANG . "_" . $module_data . "_Products p 
                    ON od.ProductID = p.ProductID 
                    WHERE od.OrderID IN (" . implode(',', array_map('intval', $order_ids)) . ")";
    $details = $db->query($sql_details)->fetchAll();
    foreach ($details as $detail) {
        $order_details[$detail['OrderID']][] = $detail;
    }
}

// Tải template
$xtpl = new XTemplate('revenue.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$xtpl->assign('LANG', \NukeViet\Core\Language::$lang_module);
$xtpl->assign('PAGE_TITLE', $page_title);
$xtpl->assign('TOTAL_REVENUE', number_format($total_revenue, 0, ',', '.'));
$xtpl->assign('LABELS', $labels_json);
$xtpl->assign('DATA', $data_json);

// Hiển thị danh sách đơn hàng
foreach ($orders as $order) {
    $xtpl->assign('ORDER', [
        'OrderID' => $order['OrderID'],
        'OrderDate' => nv_date('d/m/Y', strtotime($order['OrderDate'])),
        'TotalAmount' => number_format($order['TotalAmount'], 0, ',', '.')
    ]);
    if (isset($order_details[$order['OrderID']])) {
        foreach ($order_details[$order['OrderID']] as $detail) {
            $xtpl->assign('DETAIL', [
                'ProductName' => $detail['ProductName'],
                'Quantity' => $detail['Quantity'],
                'Price' => number_format($detail['Price'], 0, ',', '.')
            ]);
            $xtpl->parse('main.order.detail');
        }
    }
    $xtpl->parse('main.order');
}

$xtpl->parse('main');
$contents = $xtpl->text('main');

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';