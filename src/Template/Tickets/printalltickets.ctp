<?php
$count = 1;
foreach ($orders as $orderkey => $orderdetails) {
    if (empty($orderdetails['ticketdetail'][0]['name'])) {
        continue;
    }
?>
    <!DOCTYPE html>
    <html>

    <head>
        <!-- Font Awesome JS -->
        <script defer src="https://use.fontawesome.com/releases/v5.8.1/js/all.js" integrity="sha384-g5uSoOSBd7KkhAMlnQILrecXvzst9TdC09/VM+pjDTCM+1il8RHz5fKANTFFb+gQ" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />

        <!-- ============================ -->
        <link rel="stylesheet" href="<?php echo SITE_URL; ?>css/all.min.css" type="text/css">
        <link rel="stylesheet" href="<?php echo SITE_URL; ?>css/owl.carousel.min.css" type="text/css">
        <link rel="stylesheet" href="<?php echo SITE_URL; ?>css/owl.theme.default.min.css" type="text/css">
        <link rel="stylesheet" href="<?php echo SITE_URL; ?>css/animate.min.css" type="text/css">
        <link rel="stylesheet" href="https://codepen.io/nosurprisethere/pen/rJzKOe.css" type="text/css">
        <link rel="stylesheet" href="<?php echo SITE_URL; ?>css/bootstrap.min.css" type="text/css">
        <link href="<?php echo SITE_URL; ?>css/style.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo SITE_URL; ?>css/responsive.css" rel="stylesheet" type="text/css">

        <script src="https://code.jquery.com/jquery-2.1.4.js"></script>
        <script src="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.js"></script>
        <link href="<?php echo SITE_URL; ?>css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css">
        <script href="<?php echo SITE_URL; ?>js/jquery-3.5.1.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        <!-- ================ -->
        <style type="text/css">
            /* =========================== */

            .over {
    margin: 10px;
}
            .progress-tab {
                counter-reset: step;
            }

            .progress-tab li {
                list-style-type: none;
                float: left;
                width: 25%;
                position: relative;
                text-align: center;
                color: #26c6da;
                cursor: pointer;
            }

            .progress-tab li:before {
                content: counter(step);
                counter-increment: step;
                width: 25px;
                height: 25px;
                line-height: 25px;
                border: 1px solid #26c6da;
                display: block;
                text-align: center;
                margin: 0 auto 10px auto;
                border-radius: 50%;
                background-color: #fff;
            }

            .progress-tab li:after {
                content: "";
                position: absolute;
                width: 100%;
                height: 1px;
                background-color: #26c6da;
                top: 13px;
                left: -50%;
                z-index: -1;
            }

            .progress-tab li:first-child:after {
                content: none;
            }


            /* ================================= */
            .details-header h4 {
                font-weight: 300 !important;
                border-bottom: 1px solid #E0DEDE;
                padding-bottom: 5px;
            }

            .cut {
                width: 100%;
                height: 1px;
                border-bottom: 1px dotted black;

                margin: 20px 0px;
                position: relative;
            }

            .cut-image {
                width: 15px;
                position: absolute;
                top: -7px;
                left: 0;
            }

            .logo {
                width: 200px;
            }

            .pagebreak {
                page-break-before: always;
            }

            .print-only {
                display: none;
            }

            @media print {
                .print-only {
                    display: table;
                }

                .display-only {
                    display: none
                }
            }
        </style>
    </head>

    <body>
        <div class="display-only">
            <!-- ==================================== -->
            <div class="ticket_P">
                <div class="modal-body">
                    <!-- <p class="modal_p">You can save the image to your mobile device or select print below.</p> -->
                    <div class="over">
                        <div class="ticket_bg">

                            <img src="<?php echo IMAGE_PATH . 'eventimages/' . $orderdetails['event']['feat_image']; ?>" class="img_bg">

                            <div class="ticket_contant">
                                <div class="row ">
                                    <div class="col-12 d-flex mb-4 justify-content-between align-items-center">
                                        <img class="ticket_logo" src="<?php echo IMAGE_PATH; ?>Logo.png" alt="logo">
                                        <h6>#<?php echo $count; ?></h6>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="ticket_info">
                                            <h6>EVENT</h6>
                                            <p><?php echo ucwords(strtolower($orderdetails['event']['name'])); ?></p>
                                            <h6>DATE</h6>
                                            <p><?php echo date('D, M jS Y / h:i A', strtotime($orderdetails['event']['date_from'])); ?></p>
                                            <!-- <p>Sat, Aug 20th 2022 / <span>03:30pm</span></p> -->
                                            <h6>TYPE</h6>
                                            <p><?php echo $orderdetails['eventdetail']['title']; ?></p>
                                            <h6>PURCHASER</h6>
                                            <p><?php echo $orderdetails['order']['user']['name'] . ' ' . $orderdetails['order']['user']['lname']; ?></p>
                                            <h6>NAME</h6>
                                            <p><?php echo $orderdetails['ticketdetail'][0]['name']; ?></p>
                                        </div>

                                    </div>
                                    <div class="col-sm-4">
                                        <img src="<?php echo IMAGE_PATH . 'eventimages/' . $orderdetails['event']['feat_image']; ?>" class="img-fluid img_t" alt="img">

                                    </div>

                                    <div class="col-12 my-4 text-center ">
                                        <img src="<?php echo SITE_URL . 'qrimages/temp/' . $orderdetails['ticketdetail'][0]['qrcode']; ?>" class="ticket_qucode" alt="img">

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>



        <div class="cut">
            <svg class="svg-inline--fa fa-cut fa-w-14 cut-image" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="cut" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                <path fill="currentColor" d="M278.06 256L444.48 89.57c4.69-4.69 4.69-12.29 0-16.97-32.8-32.8-85.99-32.8-118.79 0L210.18 188.12l-24.86-24.86c4.31-10.92 6.68-22.81 6.68-35.26 0-53.02-42.98-96-96-96S0 74.98 0 128s42.98 96 96 96c4.54 0 8.99-.32 13.36-.93L142.29 256l-32.93 32.93c-4.37-.61-8.83-.93-13.36-.93-53.02 0-96 42.98-96 96s42.98 96 96 96 96-42.98 96-96c0-12.45-2.37-24.34-6.68-35.26l24.86-24.86L325.69 439.4c32.8 32.8 85.99 32.8 118.79 0 4.69-4.68 4.69-12.28 0-16.97L278.06 256zM96 160c-17.64 0-32-14.36-32-32s14.36-32 32-32 32 14.36 32 32-14.36 32-32 32zm0 256c-17.64 0-32-14.36-32-32s14.36-32 32-32 32 14.36 32 32-14.36 32-32 32z"></path>
            </svg><!-- <i class="fas fa-cut cut-image"></i> -->
        </div>



        <table class="table print-only">
            <tr>
                <td>
                    <div class="ticket_P">
                        <div class="modal-body">
                            <!-- <p class="modal_p">You can save the image to your mobile device or select print below.</p> -->
                            <div class="over">
                                <div class="ticket_bg">

                                    <img src="<?php echo IMAGE_PATH . 'eventimages/' . $orderdetails['event']['feat_image']; ?>" class="img_bg">

                                    <div class="ticket_contant">
                                        <div class="row ">
                                            <div class="col-12 d-flex mb-4 justify-content-between align-items-center">
                                                <img class="ticket_logo" src="<?php echo IMAGE_PATH; ?>Logo.png" alt="logo">
                                                <h6>#<?php echo $count; ?></h6>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="ticket_info">
                                                    <h6>EVENT</h6>
                                                    <p><?php echo ucwords(strtolower($orderdetails['event']['name'])); ?></p>
                                                    <h6>DATE</h6>
                                                    <p><?php echo date('D, M jS Y / h:i A', strtotime($orderdetails['event']['date_from'])); ?></p>
                                                    <!-- <p>Sat, Aug 20th 2022 / <span>03:30pm</span></p> -->
                                                    <h6>TYPE</h6>
                                                    <p><?php echo $orderdetails['eventdetail']['title']; ?></p>
                                                    <h6>PURCHASER</h6>
                                                    <p><?php echo $orderdetails['order']['user']['name'] . ' ' . $orderdetails['order']['user']['lname']; ?></p>
                                                    <h6>NAME</h6>
                                                    <p><?php echo $orderdetails['ticketdetail'][0]['name']; ?></p>
                                                </div>

                                            </div>
                                            <div class="col-sm-4">
                                                <img src="<?php echo IMAGE_PATH . 'eventimages/' . $orderdetails['event']['feat_image']; ?>" class="img-fluid img_t" alt="img">

                                            </div>

                                            <div class="col-12 my-4 text-center ">
                                                <img src="<?php echo SITE_URL . 'qrimages/temp/' . $orderdetails['ticketdetail'][0]['qrcode']; ?>" class="ticket_qucode" alt="img">

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="print_TLogo">
                        <img style="width:300px; margin:20px 0px;" class="ticket_logo" src="<?php echo IMAGE_PATH; ?>Ebox-tickets_logo.png" alt="logo">
                    </div>


                    <div class="details-header">
                        <h4>Instructions</h4>
                    </div>

                    <ol>
                    <li>This ticket is your sole responsibility. Please keep it safe as duplicates will be prohibited from entry into the event</li>
					<li>This printed ticket allows entry into the event once presented by the Door</li>
					<li>Please use the appropriate gender notation if applicable (Male / Female)</li>
					<li>DO NOT FOLD this ticket through the QR CODE, as it may result in its inability to be Scanned on entry.</li>
                    </ol>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="cut">
                        <i class="fas fa-cut cut-image"></i>
                    </div>
                </td>
            </tr>
        </table>
    </body>

    <!--  -->
    <script src="<?php echo SITE_URL; ?>js/jquery-3.5.1.min.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL; ?>js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL; ?>js/owl.carousel.min.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL; ?>  https://codepen.io/nosurprisethere/pen/rJzKOe.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL; ?>js/wow.min.js" type="text/javascript"></script>
    <!--  -->

    </html>
<?php $count++;
} ?>