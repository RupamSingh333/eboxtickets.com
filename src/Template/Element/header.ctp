<!DOCTYPE HTML>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Eboxtickets</title>
  <!---------bootstrap-------------------->
  <?= $this->Html->css('bootstrap.min.css') ?>
  <?= $this->Html->css('style.css') ?>
  <?= $this->Html->css('fontawesome-all.min.css') ?>
  <?= $this->Html->css('font-awesome.min.css') ?>
  <?= $this->Html->css('fonts.css') ?>
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
  <!------------font-awesome------------------>
  <?= $this->Html->css('fontawesome-all.min.css') ?>
  <?= $this->Html->css('font-awesome.min.css') ?>
  <?= $this->Html->css('fonts.css') ?>
  <!------------Poppins-font------------------>
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
  <!---------------genral---------------------->

  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link href="css/responsive.css" rel="stylesheet" type="text/css">
  
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-NLVRBDS');</script>

</head>

<body>
  <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NLVRBDS"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
  <div id="page-wrapper">
    <header id="header">
      <!--Header Start-->
      <nav class="navbar">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html"><img src="images/logo.png" alt="logo"></a>
          </div>
          <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
              <li>
                <form action="<?php echo SITE_URL  ?>homes/usersearch">
                  <input type="text" placeholder="Search Event" name="search" required>
                  <button type="submit" style="background-color:  transparent; position: absolute;top: 15px;right: 8px;"><i class="fas fa-search"></i></button>
                </form>
              </li>
              <li class="active"><a href="<?php echo SITE_URL; ?>signup"> Up</a></li>

              <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Event Organiser
                  <span class="caret"></span> </a>
                <ul class="dropdown-menu">
                  <li><a href="<?php echo SITE_URL; ?>dashboardmyevent">My Event</a></li>
                  <li><a href="<?php echo SITE_URL; ?>pastevent">Post Event</a></li>
                  <li><a href="#">Logout</a></li>
                </ul>
              </li>

              <li><a href="<?php echo SITE_URL; ?>checkticket">Check Ticket </a></li>
              <ul class="second_menu">
                <li><a href="<?php echo SITE_URL; ?>home">Home</a></li>
                <li class="dropdown"><a href="<?php echo SITE_URL; ?>upcomingevent">Upcoming Events </a></li>
                <!--<li><a href="Past event.html">Past Events</a></li>-->
              </ul>
            </ul>
            <div class="clearfix"></div>

          </div>
        </div>
      </nav>


    </header>
    <!--Header-End-->