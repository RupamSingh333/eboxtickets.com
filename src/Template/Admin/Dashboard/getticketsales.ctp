<!-- Sales start-->
<script>
    am5.ready(function() {

        // Create root element
        // https://www.amcharts.com/docs/v5/getting-started/#Root_element
        var root = am5.Root.new("chartdiv1");

        // Set themes
        // https://www.amcharts.com/docs/v5/concepts/themes/
        root.setThemes([
            am5themes_Animated.new(root)
        ]);

        // Create chart
        // https://www.amcharts.com/docs/v5/charts/xy-chart/
        var chart = root.container.children.push(am5xy.XYChart.new(root, {
            panX: true,
            panY: true,
            // wheelX: "panX",
            // wheelY: "zoomX",
            pinchZoomX: false
        }));

        // Add cursor
        // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
        var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
            behavior: "none"
        }));
        cursor.lineY.set("visible", true);


        // Generate random data
        var date = new Date();
        date.setHours(0, 0, 0, 0);
        var value = 100;

        function generateData() {
            value = Math.round((Math.random() * 10 - 5) + value);
            // console.log(date.getTime());
            am5.time.add(date, "day", 1);
            return {
                date: date.getTime(),
                value: value
            };
        }

        function generateDatas(count) {
            var data = [];
            for (var i = 0; i < count; ++i) {
                data.push(generateData());
            }
            return data;
        }



        // Create axes
        // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
        var xAxis = chart.xAxes.push(am5xy.DateAxis.new(root, {
            maxDeviation: 0.5,
            baseInterval: {
                timeUnit: "day",
                count: 1
            },
            renderer: am5xy.AxisRendererX.new(root, {
                pan: "zoom"
            }),
            tooltip: am5.Tooltip.new(root, {})
        }));

        var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
            maxDeviation: 1,
            renderer: am5xy.AxisRendererY.new(root, {
                pan: "zoom"
            })
        }));


        // Add series
        // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
        var series = chart.series.push(am5xy.SmoothedXLineSeries.new(root, {
            name: "Series",
            xAxis: xAxis,
            yAxis: yAxis,
            valueYField: "value",
            valueXField: "date",
            tooltip: am5.Tooltip.new(root, {
                labelText: "{valueY}"
            })
        }));

        series.fills.template.setAll({
            visible: true,
            fillOpacity: 0.2
        });

        series.bullets.push(function() {
            return am5.Bullet.new(root, {
                locationY: 0,
                sprite: am5.Circle.new(root, {
                    radius: 4,
                    stroke: root.interfaceColors.get("background"),
                    strokeWidth: 2,
                    fill: series.get("fill")
                })
            });
        });


        // Add scrollbar
        // https://www.amcharts.com/docs/v5/charts/xy-chart/scrollbars/
        chart.set("scrollbarX", am5.Scrollbar.new(root, {
            orientation: "horizontal"
        }));

        var data = <?php echo $dates_data_all; ?>;
        // console.log('paymet hssdh', data);
        series.data.setAll(data);

        // Make stuff animate on load
        // https://www.amcharts.com/docs/v5/concepts/animations/
        series.appear(1000);
        chart.appear(1000, 100);

    }); // end am5.ready()
</script>
<!-- Sales end -->

<div class="revenue_gharf">
    <div class="d-flex justify-content-between align-items-center gharf_h">
        <h1>Payment Chart</h1>
        <span class="bold-text">
            Total Sales: <?php echo '$' . number_format($totalsale, 2); ?>
        </span>
        <span class="bold-text">
            Total Earning: <?php echo '$' . number_format($totalEarningsuponsales, 2); ?>
        </span>
        <div class="dropdown">

            <select class="btn btnn btn-secondary dropdown-toggle" onchange="changepaymentcolletion(this.value);">
                <option value="reset">Select</option>
                <option <?php echo ($params == 'today') ? 'selected' : ''; ?> value="today">Today</option>
                <option <?php echo ($params == 'last_week') ? 'selected' : ''; ?> value="last_week">Last Week</option>
                <option <?php echo ($params == 'last_month') ? 'selected' : ''; ?> value="last_month">Last Month</option>
            </select>

        </div>
    </div>

    <div id="chartdiv1" style="height: 290px; width: 100%">
    </div>
</div>