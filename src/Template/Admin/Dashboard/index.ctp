<?php echo $this->Html->script('admin/canvasjs.min.js');
// print_r($paymentdataWithtype);die;
?>
<script src="https://unpkg.com/carbon-components@latest/css/carbon-components.css"></script>

<style type="text/css">
    .card .card-footer {
        padding: 3.8rem 1.25rem !important;
        background-color: #fff;
        border-top: 1px solid #c2cfd6;

    }

    body {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
    }

    #chartdiv1 {
        width: 100%;
        height: 400px;
    }

    #chartdiv {
        width: 100%;
        height: 400px;
    }

    .revenue_gharf #chartdiv {
        width: 100%;
        padding-bottom: 22px;
        padding-top: 68px;
        height: 260px;
    }

    .bold-text {
        font-weight: bold;
    }

    .btnn {
        background: #2576c2;

        border-radius: 5px;
        border: 1px solid #2c62b0;
    }

    .btnn:hover {
        color: #fff;
        background-color: #286cb9;
        border-color: #2b67b4;
    }

    .btnn:active,
    .btn:focus {
        color: #fff;
        background-color: #237bc7 !important;
        border-color: #227cc8 !important;
    }
</style>

<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Dashboard</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active"></li>
                </ol>
            </div>
        </div>
    </div>
</div>


<div class="content mt-3" style="
    min-height: 100px;
">
    <?php $role_id = $this->request->session()->read('Auth.User.role_id');
    if ($role_id == '1') {
    ?>

        <!--<div class="col-sm-12">
                <div class="alert  alert-success alert-dismissible fade show" role="alert">
                  <span class="badge badge-pill badge-success">Success</span> You successfully read this important alert message.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>-->

        <div class="row mx-1">
            <div class="col-sm-6 col-lg">
                <div class="box_sec">
                    <div class="card text-white bg-flat-color-1 box_bg">
                        <div class="card-body pb-0 box-contant">
                            <!--  <div class="dropdown float-right">
                            <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton" data-toggle="dropdown">
                                <i class="fa fa-cog"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <div class="dropdown-menu-content">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>-->
                            <h4 class="mb-0">
                                <span class="count"><?php echo $totalcustomer; ?></span>/<span class="count"><?php echo $totaldisablecustomer; ?></span>
                            </h4>
                            <p class="text-light">Total Customers</p>

                            <!--<div class="chart-wrapper px-0" style="height:70px;" height="70">
                            <canvas id="widgetChart1"></canvas>
                        </div>-->

                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                            <path fill="#f3f4f5" fill-opacity="1" d="M0,64L18.5,85.3C36.9,107,74,149,111,176C147.7,203,185,213,222,186.7C258.5,160,295,96,332,74.7C369.2,53,406,75,443,106.7C480,139,517,181,554,197.3C590.8,213,628,203,665,213.3C701.5,224,738,256,775,245.3C812.3,235,849,181,886,170.7C923.1,160,960,192,997,197.3C1033.8,203,1071,181,1108,181.3C1144.6,181,1182,203,1218,186.7C1255.4,171,1292,117,1329,106.7C1366.2,96,1403,128,1422,144L1440,160L1440,320L1421.5,320C1403.1,320,1366,320,1329,320C1292.3,320,1255,320,1218,320C1181.5,320,1145,320,1108,320C1070.8,320,1034,320,997,320C960,320,923,320,886,320C849.2,320,812,320,775,320C738.5,320,702,320,665,320C627.7,320,591,320,554,320C516.9,320,480,320,443,320C406.2,320,369,320,332,320C295.4,320,258,320,222,320C184.6,320,148,320,111,320C73.8,320,37,320,18,320L0,320Z"></path>
                        </svg>

                    </div>
                </div>
            </div>
            <!-- =============== -->
            <!--/.col-->

            <div class="col-sm-6 col-lg">
                <div class="box_sec">
                    <div class="card text-white bg-flat-color-2 box_bg">
                        <div class="card-body pb-0 box-contant">

                            <h4 class="mb-0">
                                <span class="count"><?php echo $totalorganiser; ?></span>/<span class="count"><?php echo $totaldisableorganiser; ?></span>
                            </h4>
                            <p class="text-light">Event Organisers</p>

                            <!--    <div class="chart-wrapper px-0" style="height:70px;" height="70">
                            <canvas id="widgetChart2"></canvas>
                        </div>-->

                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                            <path fill="#f3f4f5" fill-opacity="1" d="M0,64L18.5,85.3C36.9,107,74,149,111,176C147.7,203,185,213,222,186.7C258.5,160,295,96,332,74.7C369.2,53,406,75,443,106.7C480,139,517,181,554,197.3C590.8,213,628,203,665,213.3C701.5,224,738,256,775,245.3C812.3,235,849,181,886,170.7C923.1,160,960,192,997,197.3C1033.8,203,1071,181,1108,181.3C1144.6,181,1182,203,1218,186.7C1255.4,171,1292,117,1329,106.7C1366.2,96,1403,128,1422,144L1440,160L1440,320L1421.5,320C1403.1,320,1366,320,1329,320C1292.3,320,1255,320,1218,320C1181.5,320,1145,320,1108,320C1070.8,320,1034,320,997,320C960,320,923,320,886,320C849.2,320,812,320,775,320C738.5,320,702,320,665,320C627.7,320,591,320,554,320C516.9,320,480,320,443,320C406.2,320,369,320,332,320C295.4,320,258,320,222,320C184.6,320,148,320,111,320C73.8,320,37,320,18,320L0,320Z"></path>
                        </svg>

                    </div>
                </div>

            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg">
                <div class="box_sec">
                    <div class="card text-white bg-flat-color-3 box_bg">
                        <div class="card-body pb-0 box-contant">

                            <h4 class="mb-0">

                                <span class="count"><?php echo $totalevent; ?></span>/<span class="count"><?php echo $totaldisableevent; ?></span>
                            </h4>
                            <p class="text-light">Total Events</p>

                        </div>

                        <!--   <div class="chart-wrapper px-0" style="height:70px;" height="70">
                            <canvas id="widgetChart3"></canvas>
                        </div>-->
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                            <path fill="#f3f4f5" fill-opacity="1" d="M0,64L18.5,85.3C36.9,107,74,149,111,176C147.7,203,185,213,222,186.7C258.5,160,295,96,332,74.7C369.2,53,406,75,443,106.7C480,139,517,181,554,197.3C590.8,213,628,203,665,213.3C701.5,224,738,256,775,245.3C812.3,235,849,181,886,170.7C923.1,160,960,192,997,197.3C1033.8,203,1071,181,1108,181.3C1144.6,181,1182,203,1218,186.7C1255.4,171,1292,117,1329,106.7C1366.2,96,1403,128,1422,144L1440,160L1440,320L1421.5,320C1403.1,320,1366,320,1329,320C1292.3,320,1255,320,1218,320C1181.5,320,1145,320,1108,320C1070.8,320,1034,320,997,320C960,320,923,320,886,320C849.2,320,812,320,775,320C738.5,320,702,320,665,320C627.7,320,591,320,554,320C516.9,320,480,320,443,320C406.2,320,369,320,332,320C295.4,320,258,320,222,320C184.6,320,148,320,111,320C73.8,320,37,320,18,320L0,320Z"></path>
                        </svg>
                    </div>

                </div>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg">
                <div class="box_sec">
                    <div class="card text-white bg-flat-color-4 box_bg">
                        <div class="card-body pb-0 box-contant">
                            <h4>
                                <span>$ </span></span><span class="count"><?php echo $Totalticketamount; ?></span>

                            </h4>
                            <p class="text-light">Total Sales</p>

                            <!--  <div class="chart-wrapper px-3" style="height:70px;" height="70">
                            <canvas id="widgetChart4"></canvas>
                        </div>-->

                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                            <path fill="#f3f4f5" fill-opacity="1" d="M0,64L18.5,85.3C36.9,107,74,149,111,176C147.7,203,185,213,222,186.7C258.5,160,295,96,332,74.7C369.2,53,406,75,443,106.7C480,139,517,181,554,197.3C590.8,213,628,203,665,213.3C701.5,224,738,256,775,245.3C812.3,235,849,181,886,170.7C923.1,160,960,192,997,197.3C1033.8,203,1071,181,1108,181.3C1144.6,181,1182,203,1218,186.7C1255.4,171,1292,117,1329,106.7C1366.2,96,1403,128,1422,144L1440,160L1440,320L1421.5,320C1403.1,320,1366,320,1329,320C1292.3,320,1255,320,1218,320C1181.5,320,1145,320,1108,320C1070.8,320,1034,320,997,320C960,320,923,320,886,320C849.2,320,812,320,775,320C738.5,320,702,320,665,320C627.7,320,591,320,554,320C516.9,320,480,320,443,320C406.2,320,369,320,332,320C295.4,320,258,320,222,320C184.6,320,148,320,111,320C73.8,320,37,320,18,320L0,320Z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <!--/.col-->
            <div class="col-sm-6 col-lg">
                <div class="box_sec">
                    <div class="card text-white bg-flat-color-5 box_bg">
                        <div class="card-body pb-0 box-contant">
                            <h4>
                                <span>$ </span></span><span class="count"><?php echo $TotalEarning; ?></span>

                            </h4>
                            <p class="text-light">Total Earning</p>

                            <!--  <div class="chart-wrapper px-3" style="height:70px;" height="70">
                            <canvas id="widgetChart4"></canvas>
                        </div>-->

                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                            <path fill="#f3f4f5" fill-opacity="1" d="M0,64L18.5,85.3C36.9,107,74,149,111,176C147.7,203,185,213,222,186.7C258.5,160,295,96,332,74.7C369.2,53,406,75,443,106.7C480,139,517,181,554,197.3C590.8,213,628,203,665,213.3C701.5,224,738,256,775,245.3C812.3,235,849,181,886,170.7C923.1,160,960,192,997,197.3C1033.8,203,1071,181,1108,181.3C1144.6,181,1182,203,1218,186.7C1255.4,171,1292,117,1329,106.7C1366.2,96,1403,128,1422,144L1440,160L1440,320L1421.5,320C1403.1,320,1366,320,1329,320C1292.3,320,1255,320,1218,320C1181.5,320,1145,320,1108,320C1070.8,320,1034,320,997,320C960,320,923,320,886,320C849.2,320,812,320,775,320C738.5,320,702,320,665,320C627.7,320,591,320,554,320C516.9,320,480,320,443,320C406.2,320,369,320,332,320C295.4,320,258,320,222,320C184.6,320,148,320,111,320C73.8,320,37,320,18,320L0,320Z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <!--/.col-->
        </div>

        <!-- <div class="row-eq-height"> -->

        <?php /* ?>
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                           <div class="col-sm-4">
                                <h4 class="card-title mb-0">Revenue Generated</h4>
                                <div class="small text-muted">July 2018</div>
                            </div>
                            <!--
                            <div class="col-sm-8 hidden-sm-down">
                                <button type="button" class="btn btn-primary float-right bg-flat-color-1"><i class="fa fa-cloud-download"></i></button>
                                <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                                    <div class="btn-group mr-3" data-toggle="buttons" aria-label="First group">
                                        <label class="btn btn-outline-secondary">
                                            <input type="radio" name="options" id="option1"> Day
                                        </label>
                                        <label class="btn btn-outline-secondary active">
                                            <input type="radio" name="options" id="option2" checked=""> Month
                                        </label>
                                        <label class="btn btn-outline-secondary">
                                            <input type="radio" name="options" id="option3"> Year
                                        </label>
                                    </div>
                                </div>
                            </div>
                            -->


                        </div><!--/.row-->
                     <div class="chart-wrapper mt-4" >
                            <canvas id="trafficChart" ></canvas>
                        </div>

                    </div>
                </div>
            </div>
            * 
            * <?php */ ?>

        <!-- </div> -->

    <?php } ?>



    <!------------------------------------------------>

    <div id="revenue">
        <div class="container-fluid">
            <div class="row">
                <!-- Payment Chart -->
                <div class="col-sm-8" id="updatechart">
                    <div class="revenue_gharf">
                        <script src="https://code.highcharts.com/highcharts.src.js"></script>
                        <div class="d-flex justify-content-between align-items-center gharf_h">
                            <h1>Payment Chart</h1>
                            <span class="bold-text">
                                Total Sales: <?php echo '$' . number_format($totalsale, 2); ?>
                            </span>
                            <span class="bold-text">
                                Total Earning: <?php echo '$' . number_format($totalEarningsuponsales, 2); ?>
                            </span>

                            <div class="dropdown">
                                <!-- <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Sales
                            </button> -->
                                <select class="btn btnn btn-secondary dropdown-toggle" onchange="changepaymentcolletion(this.value);">

                                    <option value="reset">Select</option>
                                    <option value="today">Today</option>
                                    <option value="last_week">Last Week</option>
                                    <option value="last_month">Last Month</option>
                                </select>
                                <!-- <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" onchange="changepaymentcolletion(this.value);">
                                <li value="7days"><a class="dropdown-item" href="#">Last 7 Days</a></li>
                                <li value="31"><a class="dropdown-item" href="#">Last Month</a></li>
                                <li><a class="dropdown-item" href="#">Current Month</a></li>
                            </ul> -->
                            </div>
                        </div>

                        <div id="chartdiv1" style="height: 290px; width: 100%">
                        </div>
                    </div>
                </div>

                <!--Payment Method -->
                <div class="col-sm-4" id="update_paymentmethod">
                    <div class="revenue_gharf">
                        <div class="d-flex justify-content-between gharf_h">
                            <h1>Payment Method</h1>
                            <!-- <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    Payment
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="#">Online Payment</a></li>
                                    <li><a class="dropdown-item" href="#">Offline Payment</a></li>
                                </ul>
                            </div> -->
                            <select class="btn btnn btn-secondary dropdown-toggle" onchange="paymentmethod(this.value);">
                                <option value="reset">Select</option>
                                <option value="today">Today</option>
                                <option value="last_week">Last Week</option>
                                <option value="last_month">Last Month</option>
                            </select>
                        </div>

                        <div id="chartdiv"></div>
                        <section>
                    </div>
                </div>

            </div>


        </div>
    </div>

    <!------------------------------------------------>

    <div class="content">
        <div class="animated fadeIn">
            <div class="row">

                <?php echo $this->Flash->render(); ?>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Latest </strong><span> Events</span>
                        </div>
                        <div class="card-body">


                            <table id="bootstrap-data-table" class="table table-striped table-bordered ">
                                <thead class="">
                                    <tr>
                                        <th scope="col"><?= $this->Paginator->sort('S.No') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('Organiser') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('Event Name') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('Date & Time') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('Venue') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('Ticket Types') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('Total Sales') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('Commision') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('Featured') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('Action') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($latestevent as $value) :
                                        // pr($value);exit;
                                        $complete_sale = $this->Comman->calculatepayment($value->id);
                                    ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>

                                            <td><?php echo ucfirst($value->user->name) ?></td>

                                            <td><a style="text-decoration: underline;line-height: 21px;" href="<?php echo SITE_URL . 'event/' . $value->slug; ?>" target="_blank">
                                                    <?php echo ucfirst($value->name); ?></a>
                                            </td>

                                            <td><b>From</b> <?php echo date('d M, Y h:i A', strtotime($value['date_from'])); ?><br>
                                                <b>To</b> <?php echo date('d M, Y h:i A', strtotime($value['date_to'])); ?>
                                            </td>

                                            <td><?php echo $value->location; ?></td>

                                            <td class="">

                                                <?php if (!empty($value['eventdetail'])) {

                                                    foreach ($value['eventdetail'] as $key => $tickettype) {

                                                        if ($value['is_free'] == 'Y') { ?>
                                                            <a><?php echo $tickettype['title']; ?> - <Span>Invitation</Span></a>
                                                        <?php  } else { ?>

                                                            <a><?php echo $tickettype['title']; ?> - <Span><?php echo ($tickettype['type'] == 'open_sales') ? 'Online' : 'Committee'; ?></Span></a><br>
                                                        <?php } ?>


                                                    <?php }
                                                } else { ?>
                                                    <a>Tickets not created</a>
                                                <?php } ?>

                                            </td>

                                            <td><a style="color: black;" href="<?php echo SITE_URL; ?>admin/event/eventdetail/<?php echo $value['id']; ?>">
                                                    <?php echo ($value['currency']['Currency_symbol']) ? $value['currency']['Currency_symbol'] : "$"; ?>
                                                    <?php echo number_format($complete_sale, 2); ?>
                                                    <?php echo ($value['currency']['Currency']) ? $value['currency']['Currency'] : "USD"; ?></strong>
                                                </a>
                                            </td>

                                            <td>
                                                <a style="color: black;">
                                                    <?php echo ($value['currency']['Currency_symbol']) ? $value['currency']['Currency_symbol'] : "$"; ?>
                                                    <?php echo number_format($complete_sale * $admin_info['feeassignment'] / 100, 2); ?>
                                                    <?php echo ($value['currency']['Currency']) ? $value['currency']['Currency'] : "USD"; ?>
                                                </a>
                                            </td>

                                            <td>
                                                <?php if ($value['featured'] == 'Y') {  ?>

                                                    <a class="feature y" href="event/featuredstatus/<?php echo $value['id'] . '/N'; ?>"><i class="fa fa-star" style="font-size: 18px !important; margin-right: 5px; color:green;" aria-hidden="true"></i></a>
                                                <?php  } else { ?>

                                                    <a class="feature n" href="event/featuredstatus/<?php echo $value['id'] . '/Y'; ?>"><i class="fa fa-star" style="font-size: 18px !important; margin-right: 5px;" aria-hidden="true"></i></a>

                                                <?php } ?>

                                                <!-- Get staff  -->
                                                <a href="<?php echo ADMIN_URL . 'event/getstaff/' . $value['event_org_id']; ?>" class="get_staff" title="View Staff"><i class="fa fa-eye" aria-hidden="true"></i></a>

                                            </td>
                                            <td class="actions">
                                                <?php if ($value['admineventstatus'] == 'Y') {  ?>
                                                    <a href="<?php echo ADMIN_URL ?>event/status/<?php echo $value['id'] . '/N'; ?>" title="Click to Inactive"><i class="fa fa-toggle-on" style="font-size: 20px !important; margin-left: 1px; color:green;" aria-hidden="true"></i></a>

                                                <?php  } else { ?>
                                                    <a href="<?php echo ADMIN_URL ?>event/status/<?php echo $value['id'] . '/Y'; ?>" title="Click to Active"><i class="fa fa-toggle-off" style="font-size: 20px !important; margin-left: 1px;" aria-hidden="true"></i></a>
                                                <?php } ?>

                                                <?php $this->Form->postLink(
                                                    __(''),
                                                    ['action' => 'delete', $value->id, 'Y'],
                                                    array('class' => 'fa fa-trash', 'title' => 'Delete', 'style' => 'font-size:17px; margin-right: 1px; color:red'),
                                                    ['onclick' => 'return confirm("Are you sure you want to delete application")']
                                                )

                                                ?>

                                            </td>

                                        </tr>
                                    <?php $i++;
                                    endforeach; ?>
                                </tbody>
                            </table>
                            <div class="paginator">
                                <div class="row">
                                    <div class="col-sm-8">

                                    </div>
                                    <div class="col-sm-4">
                                        <a href="<?php echo SITE_URL; ?>admin/event" class="btn btn-success btn-sm pull-right">View All</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Content mt -3-->

    <div class="content">
        <div class="animated fadeIn">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Latest </strong><span> Sold Tickets</span>
                        </div>
                        <div class="card-body">


                            <table id="bootstrap-data-table" class="table table-striped table-bordered ">
                                <thead class="">
                                    <tr>
                                        <th>S.No</th>
                                        <th>Purchase Date</th>
                                        <th>Ticket No.</th>
                                        <th>Event</th>
                                        <th>Event Date & Time</th>
                                        <th>Customer</th>
                                        <th>Mobile</th>
                                        <!-- <th>Purchase Ticket</th> -->
                                        <th>Qty.</th>
                                        <th style="width: 9%;">Amount</th>
                                        <!-- <th>Comm(<?php //echo $admin_info['feeassignment']; 
                                                        ?>%)</th> -->
                                        <th>Commision</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $total_amount = 0; // initialize total amount variable to 0
                                    $total_commission_amount = 0; // initialize total commission amount variable to 0
                                    $i = 1;
                                    foreach ($latestticket_book as $key => $value) {
                                        // pr($value['ticket']['adminfee']);
                                        $total_amount += $value['ticket']['amount']; // add amount to total amount
                                        $total_commission_amount += ($value['ticket']['amount'] * $value['ticket']['adminfee'] / 100); // add commission to total commission amount
                                    ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php if (isset($value['ticket']['created'])) {
                                                    echo date('d M, Y h:i A', strtotime($value['ticket']['created']));
                                                }  ?></td>

                                            <td><?php echo $value['ticket_num']; ?></td>
                                            <td><?php echo ucfirst($value['ticket']['event']['name']); ?></td>
                                            <td>
                                                <b>From</b> <?php echo date('d M, Y h:i A', strtotime($value['ticket']['event']['date_from'])); ?><br>
                                                <b>To</b> <?php echo date('d M, Y h:i A', strtotime($value['ticket']['event']['date_to'])); ?>
                                            </td>
                                            <td><?php echo ucwords($value['user']['name']) . ' ' . ucwords($value['user']['lname']); ?></td>
                                            <td><?php echo $value['user']['mobile']; ?></td>
                                            <td><?php echo $value['ticket']['ticket_buy']; ?></td>
                                            <td>
                                                <?php echo "$" . number_format($value['ticket']['amount'], 2) . " TTD"; ?>

                                            </td>
                                            <td>
                                                <a style="color: black;">
                                                    <?php echo "$" .  number_format($value['ticket']['amount'] * $value['ticket']['adminfee'] / 100, 2) . " TTD"; ?>

                                                </a>
                                            </td>
                                        </tr>
                                    <?php

                                    }
                                    ?>
                                </tbody>
                            </table>
                            <div class="paginator">
                                <div class="row">
                                    <div class="col-sm-8">

                                    </div>
                                    <div class="col-sm-4">
                                        <a href="<?php echo SITE_URL; ?>admin/ticket" class="btn btn-success btn-sm pull-right">View All</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content mt -3-->

</div>


<!-- ==================================================== -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script src="https://code.angularjs.org/1.2.21/angular.js"></script>
<!--  -->

<!-- Resources payment methd -->

<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>


<!-- ======================================================== -->

<!-- Resources -->
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
<!-- ======================================= -->


<!-- Resources ------Sales----->


<!-- Sales start also select option ajex code-->
<script>
    function changepaymentcolletion(params) {
        if (params == "") {
            return false;
        }
        $.ajax({
            type: 'POST',
            url: '<?php echo ADMIN_URL; ?>dashboard/getticketsales',
            data: {
                'params': params
            },

            success: function(data) {
                $('#updatechart').html(data);
            },

        });

    }

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

        // var data = [{
        //     "date": 1679976000000,
        //     "value": 0
        // }, {
        //     "date": 1680408000000,
        //     "value": 3
        // }, {
        //     "date": 1680840000000,
        //     "value": 0
        // }];
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


<!-- payment mathad -->
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script>
    function paymentmethod(paymenttype) {
        // alert(params)
        if (paymenttype == "") {
            return false;
        }
        $.ajax({
            type: 'POST',
            url: '<?php echo ADMIN_URL; ?>dashboard/changepaymentmethod',
            data: {
                'params': paymenttype
            },

            success: function(data) {
                $('#update_paymentmethod').html(data);
            },

        });

    }


    // Create chart instance
    var chart = am4core.create("chartdiv", am4charts.PieChart);

    // Add data
    chart.data = <?php echo $paymentdataWithtype; ?>;


    // Add and configure Series
    var pieSeries = chart.series.push(new am4charts.PieSeries());
    pieSeries.dataFields.value = "amounts";
    pieSeries.dataFields.category = "paymenttype";
</script>