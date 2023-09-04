<!--Payment Method -->
<div class="revenue_gharf">
    <div class="d-flex justify-content-between gharf_h">
        <h1>Payment Method</h1>

        <select class="btn btnn btn-secondary dropdown-toggle" onchange="paymentmethod(this.value);">
            <option value="reset">Select</option>
            <option <?php echo ($params == 'today') ? 'selected' : ''; ?> value="today">Today</option>
            <option <?php echo ($params == 'last_week') ? 'selected' : ''; ?> value="last_week">Last Week</option>
            <option <?php echo ($params == 'last_month') ? 'selected' : ''; ?> value="last_month">Last Month</option>
        </select>
    </div>

    <div id="chartdiv"></div>
    <section>
</div>

<script>
    // Create chart instance
    var chart = am4core.create("chartdiv", am4charts.PieChart);

    // Add data
    chart.data = <?php echo $paymentdataWithtype; ?>;
    // console.log(chart.data);

    // Add and configure Series
    var pieSeries = chart.series.push(new am4charts.PieSeries());
    pieSeries.dataFields.value = "amounts";
    pieSeries.dataFields.category = "paymenttype";
</script>