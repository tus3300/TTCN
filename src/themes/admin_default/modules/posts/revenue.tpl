<!-- BEGIN: main -->
<h2>{PAGE_TITLE}</h2>
<form method="get" action="{NV_BASE_ADMINURL}index.php">
    <input type="hidden" name="{NV_NAME_VARIABLE}" value="{MODULE_NAME}">
    <input type="hidden" name="{NV_OP_VARIABLE}" value="revenue">
    <label>{LANG.start_date}: <input type="text" name="start_date" value="{START_DATE}" placeholder="DD/MM/YYYY"></label>
    <label>{LANG.end_date}: <input type="text" name="end_date" value="{END_DATE}" placeholder="DD/MM/YYYY"></label>
    <label><input type="checkbox" name="all" value="1" {ALL_CHECKED}> {LANG.filter_all}</label>
    <button type="submit">Lọc</button>
</form>

<h3>{LANG.total_revenue}: {TOTAL_REVENUE} VNĐ</h3>

<!-- BEGIN: chart -->
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script>
$(function() {
    $("input[name='start_date'], input[name='end_date']").datepicker({
        dateFormat: "dd/mm/yy"
    });
});
</script>

<!-- END: chart -->

<!-- BEGIN: no_data -->
<p>{LANG.no_data}</p>
<!-- END: no_data -->
<!-- END: main -->