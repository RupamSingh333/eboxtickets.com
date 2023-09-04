<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Login</title>
    <!-- Bootstrap CSS-->
    <link href="<?php  echo SITE_URL ?>vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
    <!-- Main CSS-->
    <link href="<?php  echo SITE_URL ?>css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="images/icon/logo.png" alt="CoolAdmin">
                            </a>
                        </div>
<div class="login-form">
<?php echo $this->Form->create('Logins',array('url'=>array('controller'=>'logins','action'=>'login')));?>
<div class="form-group">
<?php echo $this->Form->input('username',array('type'=>'text','class'=>'form-control', 
'placeholder'=>'username')); ?>
<!--<input type="email" class="form-control" placeholder="Email">-->
                        </div>
                        <div class="form-group">
                            
<div class="tip">
<?php echo $this->Form->input('password',array('class'=>'form-control', 'placeholder'=>'Password')); ?>
                            <!--<input type="password" class="form-control" placeholder="Password">-->
                        </div>


                         <div class="login-checkbox">
                                    <label>
                                        <input type="checkbox" name="remember">Remember Me
                                    </label>
                                    <label>
                                        <a href="#">Forgotten Password?</a>
                                    </label>
                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>
                                <div class="social-login-content">
                                    <div class="social-button">
                                        <button class="au-btn au-btn--block au-btn--blue m-b-20">sign in with facebook</button>
                                        <button class="au-btn au-btn--block au-btn--blue2">sign in with twitter</button>
                                    </div>
                                </div>
                            </form>
                            <div class="register-link">
                                <p>
                                    Don't you have account?
                                    <a href="#">Sign Up Here</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="<?php  echo SITE_URL ?>vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="<?php  echo SITE_URL ?>vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="<?php  echo SITE_URL ?>vendor/bootstrap-4.1/bootstrap.min.js"></script>
    
    <!-- Main JS-->
    <script src="<?php  echo SITE_URL ?>js/main.js"></script>

</body>

</html>
<!-- end document-->