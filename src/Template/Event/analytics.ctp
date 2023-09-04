<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css"> -->
<!-- <link href="https://unpkg.com/carbon-components@latest/css/carbon-components.css" > -->
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.css" rel="stylesheet" type="text/css" /> -->
<section id="Dashboard_section">
    <div class="d-flex">

        <?php echo $this->element('organizerdashboard'); ?>
        <!-- <div class="col-sm-9"> -->
        <!-- ===================================== -->
        <div class="dsa_contant">
            <?php echo $this->element('allevent'); ?>
            <!-- ===================================== -->
            <h4>Dashboard</h4>
            <hr>
            <!-- <p>You can manage all your event settings here.</p> -->

            <ul class="tabes d-flex">
                <li><a class="<?php if ($this->request->params['action'] == "analytics") {
                                    echo "active";
                                } else {
                                    echo "";
                                } ?>" href="<?php echo SITE_URL; ?>event/analytics/<?php echo $id; ?>">Dashboard</a></li>
                <li><a class="<?php if ($this->request->params['action'] == "sales") {
                                    echo "active";
                                } else {
                                    echo "";
                                } ?>" href="<?php echo SITE_URL; ?>event/sales/<?php echo $id; ?>">Sales</a></li>
                <li><a class="<?php if ($this->request->params['action'] == "saleaddons") {
                                    echo "active";
                                } else {
                                    echo "";
                                } ?>" href="<?php echo SITE_URL; ?>event/saleaddons/<?php echo $id; ?>">Addons</a></li>
                <!--  <li><a href="#">Packages</a></li> -->
            </ul>

            <section class="analytics">
                <div class="row">

                    <div class="col-lg-12 col-sm-12">
                        <div class="contant_bg">
                            <h6>Sales</h6>
                            <h7 class="bold-text">
                                Total Sales: $ <?php echo  sprintf('%.2f',$completeSales);?> TTD</h7>
                            <h7 class="bold-text">
                                Total Earning: $ <?php echo  sprintf('%.2f',$completeEarnings);?> TTD</h7>

                            <div class="graph_section_H1">
                                <div id="chartdiv1"></div>
                            </div>
                        </div>
                    </div>



                    <div class="col-lg-6 col-sm-12">
                        <div class="contant_bg">
                            <h6>Total Ticket Sales</h6>
                            <div class="graph_section_H2">
                                <div id="piechart_3d" style="width: 100%; height: 250px;"></div>
                            </div>

                        </div>
                    </div>


                    <div class="col-lg-6 col-sm-12">
                        <div class="contant_bg">
                            <h6>Payment Method</h6>
                            <div class="graph_section_H2">
                                <div id="chartdiv"></div>
                            </div>

                        </div>
                    </div>



                    <div class="col-lg-12 col-sm-12">
                        <div class="contant_bg breakdown">
                            <h6>Requests Breakdown</h6>
                            <div class="graph_section_H4">

                                <style>
                                    #chartdiv2 {
                                        width: 100%;
                                        height: 300px;
                                    }
                                </style>
                                <div id="chartdiv2"></div>
                            </div>
                        </div>
                    </div>

            </section>

        </div>
        <!-- </div> -->
    </div>
</section>


<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>

<!-- Resources ------Sales----->
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

<!-- Payment Method----->

<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="http://cdn.amcharts.com/lib/4/themes/animated.js"></script>

<!-- --------------------Total Ticket Sales------------------ -->
<script src="https://www.gstatic.com/charts/loader.js"></script>

<!-- =-------------------Total Ticket Sales-------------------------- -->
<script type="text/javascript">
    google.charts.load("current", {
        packages: ["corechart"]
    });

    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Ticket Type');
        data.addColumn('number', 'Sales');

        var jsonData = '<?php echo $ticket_sales_all; ?>';
        var parsedData = JSON.parse(jsonData);

        for (var i = 0; i < parsedData.length; i++) {
            data.addRow(parsedData[i]);
        }

        var options = {
            title: '',
            is3D: true
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
    }
</script>


<!-- --------------Payment Method-------------- -->
<script>
    /**
     * ---------------------------------------
     * This demo was created using amCharts 4.
     *
     * For more information visit:
     * https://www.amcharts.com/
     *
     * Documentation is available at:
     * https://www.amcharts.com/docs/v4/
     * ---------------------------------------
     */

    // Set theme
    am4core.useTheme(am4themes_animated);

    // Create chart instance
    var chart = am4core.create("chartdiv", am4charts.PieChart3D);

    // Let's cut a hole in our Pie chart the size of 40% the radius
    chart.innerRadius = am4core.percent(0);

    // Add data
    chart.data = <?php echo $paymenttypewithSalepercentage; ?>

    // Add and configure Series
    var pieSeries = chart.series.push(new am4charts.PieSeries3D());
    pieSeries.dataFields.value = "amounts";
    pieSeries.dataFields.category = "paymenttype";
    pieSeries.slices.template.stroke = am4core.color("#fff");
    pieSeries.slices.template.strokeWidth = 2;
    pieSeries.slices.template.strokeOpacity = 1;

    // Disabling labels and ticks on inner circle
    pieSeries.labels.template.disabled = false;
    pieSeries.ticks.template.disabled = false;

    // Disable sliding out of slices
    pieSeries.slices.template.states.getKey("hover").properties.shiftRadius = 0;
    pieSeries.slices.template.states.getKey("hover").properties.scale = 1.1;
</script>
<!-- --------------Payment Method end-------------- -->

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


        // var data = generateDatas(5);

        var data = <?php echo $dates_data_all; ?>;
        // console.log(data);
        series.data.setAll(data);

        // Make stuff animate on load
        // https://www.amcharts.com/docs/v5/concepts/animations/
        series.appear(1000);
        chart.appear(1000, 100);

    }); // end am5.ready()
</script>
<!-- Sales end -->

<!-- Requests Breakdown start-->
<script>
    am5.ready(function() {

        // Create root element
        // https://www.amcharts.com/docs/v5/getting-started/#Root_element
        var root = am5.Root.new("chartdiv2");


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
            wheelX: "none",
            wheelY: "none",
            pinchZoomX: true
        }));

        // Add cursor
        // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
        var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
        cursor.lineY.set("visible", true);

        // Create axes
        // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
        var xRenderer = am5xy.AxisRendererX.new(root, {
            minGridDistance: 30
        });
        xRenderer.labels.template.setAll({
            rotation: 0,
            centerY: am5.p50,
            centerX: am5.p50,
            paddingRight: 0,
            // textAlign:centerX,
        });

        var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
            maxDeviation: 0.3,
            categoryField: "type",
            renderer: xRenderer,
            tooltip: am5.Tooltip.new(root, {})
        }));

        var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
            maxDeviation: 0.3,
            renderer: am5xy.AxisRendererY.new(root, {})
        }));


        // Create series
        // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
        var series = chart.series.push(am5xy.ColumnSeries.new(root, {
            name: "Series 1",
            xAxis: xAxis,
            yAxis: yAxis,
            valueYField: "value",
            sequencedInterpolation: true,
            categoryXField: "type",
            tooltip: am5.Tooltip.new(root, {
                labelText: "{valueY}"
            })
        }));

        series.columns.template.setAll({
            cornerRadiusTL: 5,
            cornerRadiusTR: 5
        });
        series.columns.template.adapters.add("fill", function(fill, target) {
            return chart.get("colors").getIndex(series.columns.indexOf(target));
        });

        series.columns.template.adapters.add("stroke", function(stroke, target) {
            return chart.get("colors").getIndex(series.columns.indexOf(target));
        });


        // Set data
        var data = [{
            type: "Total",
            value: <?php echo $totalcommitee_ticket; ?>
        }, {
            type: "Pending",
            value: <?php echo $totalcommitee_ticket - $total_completed_ticket; ?>
        }, {
            type: "Approved",
            value: <?php echo $total_approved_ticket;  ?>
        }, {
            type: "Completed",
            value: <?php echo $total_completed_ticket;  ?>
        }, ];


        xAxis.data.setAll(data);

        series.data.setAll(data);

        // Make stuff animate on load
        // https://www.amcharts.com/docs/v5/concepts/animations/
        series.appear(1000);
        chart.appear(1000, 100);


    }); // end am5.ready()
</script>
<!-- Requests Breakdown end -->