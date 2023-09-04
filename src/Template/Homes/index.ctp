<style>
    /* Loader - https://loading.io/css/*/


    .spinner {
        margin: 0px auto 0;
        width: 70px;
        text-align: center;
    }

    .spinner>div {
        width: 18px;
        height: 18px;
        background-color: #fe6c16;
        border-radius: 100%;
        display: inline-block;
        -webkit-animation: sk-bouncedelay 1.4s infinite ease-in-out both;
        animation: sk-bouncedelay 1.4s infinite ease-in-out both;
    }

    .spinner .bounce1 {
        -webkit-animation-delay: -0.32s;
        animation-delay: -0.32s;
    }

    .spinner .bounce2 {
        -webkit-animation-delay: -0.16s;
        animation-delay: -0.16s;
    }

    @-webkit-keyframes sk-bouncedelay {

        0%,
        80%,
        100% {
            -webkit-transform: scale(0)
        }

        40% {
            -webkit-transform: scale(1.0)
        }
    }

    @keyframes sk-bouncedelay {

        0%,
        80%,
        100% {
            -webkit-transform: scale(0);
            transform: scale(0);
        }

        40% {
            -webkit-transform: scale(1.0);
            transform: scale(1.0);
        }
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- -------------slider Start--------------- -->
<?php $adminsetting = $this->Comman->admindetail();  ?>
<section id="slider_sec">
    <div class="owl-carousel owl-theme owl-loaded slider_owl">
        <div class="owl-stage-outer">
            <div class="owl-stage">
                <?php
                if (!empty($slider_event)) {
                    foreach ($slider_event as $slider_eventkey => $slider_eventvalue) { ?>

                        <div class="owl-item">
                            <img src="<?php echo SITE_URL; ?>images/slider_bg6.jpg" alt="slider">
                            <div class="slider_overlay">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12 align-self-center">
                                            <div class="slider_txt">
                                                <h1>Creating Memories that Matter...<br>
                                                    <small></small>
                                                </h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php }
                } else { ?>
                    <div class="owl-item">
                        <img src="<?php echo SITE_URL; ?>images/slider_bg6.jpg" alt="slider">
                        <div class="slider_overlay">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12 align-self-center">
                                        <div class="slider_txt">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div>

        </div>
    </div>
</section>
<!-- -----------------------------------------slider And--------------- -->

<!-- --------------------------about-us------------------------- -->
<section id="events">
    <div class="container">
        <div class="heading">

            <h1>Events</h1>
            <h2>Upcoming Events</h2>
        </div>

        <!-- Searching evens start -->
        <div class="search_sec">
            <form class="d-flex">
                <input class="form-control me-2" type="text" placeholder="Search Events" aria-label="Search">
            </form>
            <svg width="20" height="20" viewBox="0 0 17 18" class="" xmlns="http://www.w3.org/2000/svg">
                <g fill="#2874F1" fill-rule="evenodd">
                    <path class="_34RNph" d="m11.618 9.897l4.225 4.212c.092.092.101.232.02.313l-1.465 1.46c-.081.081-.221.072-.314-.02l-4.216-4.203">
                    </path>
                    <path class="_34RNph" d="m6.486 10.901c-2.42 0-4.381-1.956-4.381-4.368 0-2.413 1.961-4.369 4.381-4.369 2.42 0 4.381 1.956 4.381 4.369 0 2.413-1.961 4.368-4.381 4.368m0-10.835c-3.582 0-6.486 2.895-6.486 6.467 0 3.572 2.904 6.467 6.486 6.467 3.582 0 6.486-2.895 6.486-6.467 0-3.572-2.904-6.467-6.486-6.467">
                    </path>
                </g>
            </svg>
        </div>
        <!-- Loader  -->
        <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>

        <!-- Searching events ends  -->
        <div id="up_events_all">
            <?php foreach ($event  as $eventvalue) { ?>

                <div class="month">
                    <h4><?php echo date('M', strtotime($eventvalue['date_to'])); ?></h4>
                </div>

                <div class="event-list-container" id="Mycity">
                    <?php $event_month =  date('m', strtotime($eventvalue['date_to'])); ?>
                    <?php $event_data = $this->Comman->eventfind($event_month); ?>
                    <?php foreach ($event_data as $key => $value) { ?>

                        <div class="up_events">
                            <a href="<?php echo SITE_URL; ?>event/<?php echo $value['slug']; ?>">
                                <div class="inner_box">
                                    <div class="row d-flex align-items-center justify-content-center">
                                        <div class="col-lg-2 col-md-3 col-sm-4 col-12 image_event  ">
                                            <img class="event_img" src="<?php echo IMAGE_PATH . 'eventimages/'; ?><?php echo $value['feat_image'] ?>" alt="">
                                        </div>
                                        <div class="col-lg-8 col-md-6 col-sm-8 col-12 detals-eve">
                                            <div class="event_contant">

                                                <h3 class="title"><?php echo ucwords(strtolower($value['name'])); ?></h3>

                                                <p class="mb-0 time"><i class="fa-solid fa-calendar-days"></i>
                                                    <strong>Start Date</strong> <span>:</span>
                                                    <?php echo  date('D, d M Y', strtotime($value['date_from'])); ?> |
                                                    <?php echo date('h:i A', strtotime($value['date_from'])); ?>
                                                </p>
                                                <p class="mb-0 time"><i class="fa-solid fa-calendar-days"></i>
                                                    <strong>End Date</strong> <span>:</span>
                                                    <?php echo  date('D, d M Y', strtotime($value['date_to'])); ?> |
                                                    <?php echo date('h:i A', strtotime($value['date_to'])); ?>
                                                </p>
                                                <span class="d-block my-1">Hosted By
                                                    <?php echo $value['company']['name']; ?></span>
                                                <span class="d-block">@ <?php echo ucwords(strtolower($value['location'])); ?>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-3 d-none d-md-block timing ">
                                            <div class="event_Date">
                                                <h2><?php echo date('d', strtotime($value['date_from'])); ?>
                                                    <span class="date_m"><?php echo date('M', strtotime($value['date_from'])); ?></span>
                                                </h2>
                                                <!-- <h6><?php //echo date('M', strtotime($value['date_from'])); 
                                                            ?></h6> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                    <?php } ?>


                </div>

            <?php  } ?>
        </div>



        <div class="view_btn">
            <a class=" site_b" href="<?php echo SITE_URL; ?>event/upcomingevent">
                <span>View All</span>
            </a>
        </div>

    </div>
</section>

<section id="scan_section">
    <div class="container">
        <div class="heading">

            <h1></h1>
            <h2></h2>
        </div>

        <div class="row">
            <div class="col-sm-4 col-12">
                <div class="card">
                    <div class="img_icon">
                        <img src="<?php echo SITE_URL; ?>/images/ticket-scanning-(1).png" class="card-img-top scan_img" alt="...">
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">Fast Ticket Scanning</h5>
                        <p class="card-text">Ticket scanning app for iOS or Android devices offers faster ticket
                            validation for larger audiences</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-12">
                <div class="card">
                    <div class="img_icon">
                        <img src="<?php echo SITE_URL; ?>/images/ticket-scanning-(2).png" class="card-img-top scan_img" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Scan Reporting</h5>
                        <p class="card-text">Ticket scan report shows which tickets have been scanned and which
                            customers have yet to arrive</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-12">
                <div class="card">
                    <div class="img_icon">
                        <img src="<?php echo SITE_URL; ?>/images/ticket-scanning-(3).png" class="card-img-top scan_img" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Committee Sales</h5>
                        <p class="card-text">Screen ticket requests through Committee Approval, ensuring tickets end up
                            in the right hands; resulting in your event hosting the Right Crowd</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<section id="manage_Audience" class="bg_color1">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-12 img_view">

                <div class="manage_img">
                    <img src="<?php echo SITE_URL; ?>/images/Manage_audience.png" class="audi_img" alt="...">
                </div>
            </div>


            <div class="col-md-6 col-sm-12">
                <div class="sec_Heading">
                    <h1>Promoters - Manage your Event ‘On the Go’</h1>

                    <ul class="list-inline facilities ">
                        <li class="d-flex align-items-start">
                            <img class="arrow-img" src="<?php echo SITE_URL; ?>/images/arrow.png" alt="">
                            <p>Multiple TTD/ USD Payment Options (Credit - Debit Card or Cash)</p>
                        </li>
                        <li class="d-flex align-items-start">
                            <img class="arrow-img" src="<?php echo SITE_URL; ?>/images/arrow.png" alt="">
                            <p>Sell Tickets through Committees (Credit - Debit Card or Cash)</p>
                        </li>
                        <li class="d-flex align-items-start">
                            <img class="arrow-img" src="<?php echo SITE_URL; ?>/images/arrow.png" alt="">
                            <p>Mobile App (iOS / Android)</p>
                        </li>
                        <li class="d-flex align-items-start">
                            <img class="arrow-img" src="<?php echo SITE_URL; ?>/images/arrow.png" alt="">
                            <p>Real Time Analytics</p>
                        </li>
                        <li class="d-flex align-items-start">
                            <img class="arrow-img" src="<?php echo SITE_URL; ?>/images/arrow.png" alt="">
                            <p>Faster Entry Times into Venues</p>
                        </li>
                        <li class="d-flex align-items-start">
                            <img class="arrow-img" src="<?php echo SITE_URL; ?>/images/arrow.png" alt="">
                            <p>Secure CC Transactions (Multi Factor Authentication)</p>
                        </li>
                        <li class="d-flex align-items-start">
                            <img class="arrow-img" src="<?php echo SITE_URL; ?>/images/arrow.png" alt="">
                            <p>Ticket Scanning Equipment & Staffing Resources (just ask)</p>
                        </li>
                        <li class="d-flex align-items-start">
                            <img class="arrow-img" src="<?php echo SITE_URL; ?>/images/arrow.png" alt="">
                            <p>Easy & Intuitive process</p>
                        </li>

                    </ul>

                    <!-- <p>Whether you're expecting 10 or 10,000 attendees at your event, eboxtickets provides entrance management solutions to meet your needs.</p>
                    <p>Small capacity venues may prefer to simply tick customers off a list as they arrive. Using our Committee Sales report, you can quickly print off your door list ready to check.</p>
                    <p>If you're facilitating a larger number of customers over a short period of time, our free ticket scanning app for iOS and Android devices offers faster ticket validation. Alternatively, our professional scanning kit is aimed at venues with multiple entrances, or high capacity events.</p> -->
                </div>
            </div>



        </div>
    </div>
</section>

<section id="manage_Audience" class="bg_color3">
    <div class="container">
        <div class="row">

            <div class="col-md-6 col-sm-12">
                <div class="sec_Heading">
                    <h1>Ticket scanning with your phone</h1>
                    <p>We have a free ticket scanning app that works alongside your eboxtickets account to enable you to
                        scan the code on your customer's tickets, in whatever format they have chosen.</p>
                    <p>The app checks the ticket reference in real time, so you'll need a Wi-Fi or 3G connection at the
                        venue to use it. You can have multiple devices scanning tickets, all updating your eboxtickets
                        account in real time.</p>

                    <div class="down_icon">
                        <a href="<?php echo $adminsetting['googleplaystore']; ?>"><img src="<?php echo SITE_URL; ?>images/play_stor.png"></a>
                        <a href="<?php echo $adminsetting['applestore']; ?>"><img src="<?php echo SITE_URL; ?>images/app_stor.png"></a>

                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-12 img_view">

                <div class="manage_img">
                    <img src="<?php echo SITE_URL; ?>/images/Manage_audience2.png" class="audi_img" alt="...">
                </div>
            </div>

        </div>
    </div>
</section>

<section id="manage_Audience" class="bg_color2">
    <div class="container">
        <div class="row">

            <div class="col-md-6 col-sm-12 img_view">
                <div class="manage_img">
                    <img src="<?php echo SITE_URL; ?>/images/Manage_audience3.png" class="audi_img" alt="...">
                </div>
            </div>

            <div class="col-md-6 col-sm-12">
                <div class="sec_Heading">
                    <h1>No internet connection?</h1>
                    <p>We have an offline ticket scanning app available for your Windows PC or laptop. Simply install
                        the software and download your event booking information before heading to the event.</p>
                    <p>When you're ready to start scanning tickets, simply plug-in a USB barcode scanner and start
                        scanning tickets – with no internet connection required.</p>
                    <p>Unrecognised booking confirmations are visibly and audibly rejected, speeding up your queue
                        management.</p>
                </div>
            </div>


        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        var timeout = false;
        $('.spinner').hide();
        $(".search_sec").on("keyup", function(e) {
            var pos = e.target.value;
            // if (pos != "") {
            $('.spinner').show();
            $.ajax({
                async: true,
                data: {
                    'search': pos
                },
                type: "post",
                url: "<?php echo SITE_URL; ?>homes/usersearch",
                success: function(data) {
                    if (timeout) {
                        clearTimeout(timeout);
                    }
                    timeout = setTimeout(function() {
                        $("#up_events_all").html(data);
                        $('.spinner').hide();
                    }, 800);

                },
            });
            return false;
            // }
        });
    });
</script>