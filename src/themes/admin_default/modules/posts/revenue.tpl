<!-- BEGIN: main -->
<h2>{PAGE_TITLE}</h2>
<form method="get">
    <input type="hidden" name="nv" value="{MODULE_NAME}">
    <input type="hidden" name="op" value="revenue">
    <label>{LANG.filter_day}: <input type="text" name="day"></label>
    <label>{LANG.filter_month}: <input type="text" name="month"></label>
    <label>{LANG.filter_year}: <input type="text" name="year"></label>
    <label><input type="checkbox" name="all" value="1"> {LANG.filter_all}</label>
    <button type="submit">Lọc</button>
</form>
<h3>{LANG.total_revenue}: {TOTAL_REVENUE} VNĐ</h3>
<canvas id="revenueChart"></canvas>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
var ctx = document.getElementById('revenueChart').getContext('2d');
var chart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: {LABELS},
        datasets: [{
            label: 'Doanh thu',
            data: {DATA},
            borderColor: 'blue',
            fill: false
        }]
    }
});
</script>
<table>
    <thead>
        <tr>
            <th>{LANG.order_id}</th>
            <th>{LANG.order_date}</th>
            <th>{LANG.total_amount}</th>
            <th>{LANG.details}</th>
        </tr>
    </thead>
    <tbody>
        <!-- BEGIN: order -->
        <tr>
            <td>{ORDER.OrderID}</td>
            <td>{ORDER.OrderDate}</td>
            <td>{ORDER.TotalAmount} VNĐ</td>
            <td><a href="#" onclick="toggleDetail({ORDER.OrderID})">{LANG.details}</a></td>
        </tr>
        <tr id="detail_{ORDER.OrderID}" style="display:none;">
            <td colspan="4">
                <table>
                    <thead>
                        <tr>
                            <th>{LANG.product_name}</th>
                            <th>{LANG.quantity}</th>
                            <th>{LANG.price}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- BEGIN: detail -->
                        <tr>
                            <td>{DETAIL.ProductName}</td>
                            <td>{DETAIL.Quantity}</td>
                            <td>{DETAIL.Price} VNĐ</td>
                        </tr>
                        <!-- END: detail -->
                    </tbody>
                </table>
            </td>
        </tr>
        <!-- END: order -->
    </tbody>
</table>
<script>
function toggleDetail(orderId) {
    var detailRow = document.getElementById('detail_' + orderId);
    detailRow.style.display = (detailRow.style.display === 'none') ? 'table-row' : 'none';
}
</script>
<!-- END: main -->