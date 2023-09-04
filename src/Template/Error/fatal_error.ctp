<?php /*?>
<!DOCTYPE html>
<html lang="en">
<?php //echo $message; die; ?>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

  <title>404 Fatal Error HTML Template by eboxtickets</title>

  <!-- Google font -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:500" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Titillium+Web:700,900" rel="stylesheet">

  <!-- Custom stlylesheet -->
  <link type="text/css" rel="stylesheet" href="<?php echo SITE_URL; ?>css/errorsstyle.css" />

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

</head>


<body>
  <header>
    <div class="bg-grey"></div>

    <div class="container">
      <div class="row">

        <div class="col-sm-4 logo">
          <a href="#">
            <img src="<?php echo SITE_URL; ?>images/Logo.png" alt="logo" style=" margin-top:5px; ">
          </a></div>
        <div class="col-sm-8 text-right">

          <div class="in-grey-bg ">


          </div>
        </div>

      </div>
    </div>
  </header>
  <script>
function goBack() {
  window.history.back();
}
</script>
  <div id="notfound">
    <div class="notfound">
      <div class="notfound-404">
        <h1>404</h1>
      </div>
      <h2>Oops! This Page Could Not Be Found</h2>
      <p>Sorry but the page you are looking for does not exist, have been removed. name changed or is temporarily
        unavailable <button onclick="goBack()" style="background-color: green;
    /* background: #fe9809; 
    padding: 5px 12px;
    border-radius: 5px;
    color: #fff;
    font-weight: 600;cursor: pointer;
    font-size: 18px;">Go Back</button></p>


    </div>
  </div>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>

<?php */ ?>

<script>
  function goBack() {
    window.history.back();
  }
</script>

<section class="not_found_404">
  <img class="error_404" src="<?php echo SITE_URL; ?>/images/404.png" alt="">
  <h2>Oops! This Page Could Not Be Found</h2>
  <p class="error_p">Sorry but the page you are looking for does not exist, have been removed. name changed or is temporarily
    unavailable <br> <button class="go_back_btn" onclick="goBack()">Go Back</button></p>
</section>


<link href="https://fonts.googleapis.com/css?family=Montserrat:500" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Titillium+Web:700,900" rel="stylesheet">
<!-- Custom stlylesheet -->
<link type="text/css" rel="stylesheet" href="<?php echo SITE_URL; ?>css/errorsstyle.css" />