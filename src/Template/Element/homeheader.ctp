<!DOCTYPE html>
<html lang="en">

<head>
    <!-- start 12/12/2022 -->
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-MTMS7M2');
    </script>
    <!-- End Google Tag Manager -->
    <!-- end 12/12/2022 -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo SITE_URL; ?>images/favicon.png">
    <title>eboxtickets</title>

    <link rel="stylesheet" href="<?php echo SITE_URL; ?>css/all.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>css/owl.theme.default.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>css/animate.min.css" type="text/css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

    <!-- <script src="https://code.jquery.com/jquery-2.1.4.js"></script>
<script src="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.js"></script> -->
    <!-- <link rel="stylesheet" href="https://codepen.io/nosurprisethere/pen/rJzKOe.css" type="text/css"> -->
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>css/bootstrap.min.css" type="text/css">
    <link href="<?php echo SITE_URL; ?>css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <link href="<?php echo SITE_URL; ?>css/style.css" rel="stylesheet" type="text/css">
    <link href="<?php echo SITE_URL; ?>css/responsive.css" rel="stylesheet" type="text/css">
</head>

<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MTMS7M2"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->


    <div style="background-color: rgba(255, 255, 255, 0.8); height: 100%; padding-top: 28%; position: fixed; text-align: center; width: 100%; z-index: 99999999; display: none;" class="preloader"><img src="<?php echo IMAGE_PATH . 'eboxtickets_loader.png'; ?>" alt="preloader"></div>
    <header>
        <div class="whatsapp"><a href="https://api.whatsapp.com/send?phone=+1.868.778.6837" class="pin_trest" target="_blank"><i class="fab fa-whatsapp"></i></a></div>

        <!-- ====================head_btm======================== -->
        <div class="head_btm">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <!-- <div class="container-fluid"> -->
                    <a class="navbar-brand" href="<?php echo SITE_URL; ?>">
                        <img class="logo" src="<?php echo SITE_URL; ?>images/Logo.png" alt="lOGO">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"><i class="bi bi-list"></i></span>
                    </button>
                    <?php if (!empty($this->request->session()->read('Auth.User.id'))) {
                        $Username = explode(" ", $this->request->session()->read('Auth.User.name'));
                        $name = $Username[0];
                        $roleid = $this->request->session()->read('Auth.User.role_id');

                    ?>
                        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                            <div class="d-blog justify-content-end">
                                <div class="d-flex justify-content-end">

                                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                                        <li class="nav-item">
                                            <a class="nav-link active" aria-current="page" href="<?php echo SITE_URL; ?>">Home</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" aria-current="page" href="<?php echo SITE_URL; ?>calendar/index">Event Calendar</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" aria-current="page" href="<?php echo SITE_URL; ?>tickets/myticket">My Tickets</a>

                                        </li>
                                        <?php $committee_assigned_ticket = $this->Comman->committee_assigned_ticket();
                                        if ($committee_assigned_ticket) { ?>
                                            <li class="nav-item">
                                                <a class="nav-link position-relative" href="<?php echo SITE_URL; ?>committee/event"> Committee
                                                    <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-success">
                                                        <?php
                                                        $getdata_committee = $this->Comman->committee_assigned();
                                                        echo  $getdata_committee['cart_data_pending'];
                                                        ?>
                                                        <span class="visually-hidden">unread messages</span>
                                                    </span>
                                                </a>
                                            </li>
                                        <?php  } ?>
                                        <li class="nav-item">
                                            <a class="nav-link position-relative" href="<?php echo SITE_URL; ?>cart/index"> Cart
                                                <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-danger">
                                                    <?php
                                                    $cartcount = $this->Comman->findcartcount($this->request->session()->read('Auth.User.id'));
                                                    echo  $cartcount;
                                                    ?>
                                                    <span class="visually-hidden">unread messages</span>
                                                </span>
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" aria-current="page" href="<?php echo SITE_URL; ?>contactus">Contact Us</a>
                                        </li>

                                        <li>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Welcome <?php echo $name; ?>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

                                                    <li><a class="dropdown-item das_btn" href="<?php echo SITE_URL; ?>event/myevent"><i class="bi bi-speedometer2"></i>Dashboard</a></li>
                                                    <li><a class="dropdown-item" href="<?php echo SITE_URL; ?>users/viewprofile"><i class="bi bi-person"></i>My Profile</a></li>


                                                    <li><a class="dropdown-item" href="<?php echo SITE_URL; ?>tickets/myticket"><i class="bi bi-ticket-perforated"></i>My Tickets</a></li>

                                                    <?php if ($roleid == '2') { ?>
                                                        <li><a class="dropdown-item" href="<?php echo SITE_URL; ?>event/myevent"><i class="bi bi-calendar-event"></i>My Events </a></li>

                                                        <li><a class="dropdown-item" href="<?php echo SITE_URL; ?>users/employee"><i class="bi bi-people"></i>My Staff</a></li>
                                                    <?php } ?>
                                                    <li><a class="dropdown-item" href="<?php echo SITE_URL; ?>event/postevent"><i class="bi bi-calendar2-event"></i>Post Event</a></li>

                                                    <li><a class="dropdown-item" href="<?php echo SITE_URL; ?>logins/frontlogout"><i class="bi bi-box-arrow-right"></i>Logout</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    <?php } else { ?>
                        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                            <div class="d-blog justify-content-end">
                                <!-- <ul class="d-flex justify-content-end mb-3 list-inline info_ul">
        
                                            <li>
                                                <a class="nav-link site_c" href="#">
                                                    <span class="te_btn">Create an Event</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="nav-link site_h" href="#">
                                                    <span class="te_btn">Start Hosting</span>
                                                </a>
                                            </li>
        
                                        </ul> -->
                                <div class="d-flex justify-content-end">

                                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                                        <li class="nav-item">
                                            <a class="nav-link active" aria-current="page" href="<?php echo SITE_URL; ?>">Home</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" aria-current="page" href="<?php echo SITE_URL; ?>calendar/index">Event Calendar</a>
                                        </li>
                                        <!-- <li class="nav-item">
                                                <a class="nav-link" aria-current="page" href="#">My Tickets</a>
                                            </li> -->
                                        <!-- <li class="nav-item">
                                                <a class="nav-link" aria-current="page" href="<?php //echo SITE_URL; 
                                                                                                ?>cart/index">Cart</a>
                                            </li> -->
                                        <li class="nav-item">
                                            <a class="nav-link" aria-current="page" href="<?php echo SITE_URL; ?>contactus">Contact Us</a>
                                        </li>
                                        <li>
                                            <a class="nav-link site_c" href="<?php echo SITE_URL; ?>login">
                                                <span class="te_btn">Login / Register</span>
                                            </a>

                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <!-- </div> -->
            </div>
            </nav>
    </header>