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
    <link href="<?php echo SITE_URL ?>vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
    <!-- Main CSS-->
    <link href="<?php echo SITE_URL ?>css/theme.css" rel="stylesheet" media="all">

    <!-- favicon icon  -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo SITE_URL;?>images/favicon.png">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <div class="row">
                                    <div class="newddd">
                                    </div>
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-6">

                                        <img src="<?php echo SITE_URL; ?>images/Logoblack.png" alt="eboxticket">
                                    </div>
                                    <div class="col-sm-6"></div>
                                </div>
                            </a>
                        </div>

                        <div class="login-form">
                            <?php echo $this->Flash->render(); ?>
                            <?php echo $this->Form->create('user', array('url' => array('controller' => 'logins', 'action' => 'login'))); ?>
                            <div class="form-group">
                                <?php echo $this->Form->input('email', array(
                                    'value' => $email, 'type' => 'email', 'class' => 'form-control',
                                    'placeholder' => 'Username'
                                )); ?>
                                <!--<input type="email" class="form-control" placeholder="Email">-->
                            </div>
                            <div class="form-group">

                                <div class="tip">
                                    <?php echo $this->Form->input('password', array('value' => $password, 'class' => 'form-control', 'placeholder' => 'Password')); ?>
                                    <!--<input type="password" class="form-control" placeholder="Password">-->
                                </div>


                                <div class="login-checkbox">
                                    <label>
                                        <?php if ($remember_me == 1) {
                                            $checked = 'checked';
                                        }
                                        echo $this->Form->input('remember_me', array('type' => 'checkbox', 'checked' => $checked, 'value' => 1));
                                        ?>
                                    </label>

                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Jquery JS-->
        <script src="<?php echo SITE_URL ?>vendor/jquery-3.2.1.min.js"></script>
        <!-- Bootstrap JS-->
        <script src="<?php echo SITE_URL ?>vendor/bootstrap-4.1/popper.min.js"></script>
        <script src="<?php echo SITE_URL ?>vendor/bootstrap-4.1/bootstrap.min.js"></script>

        <!-- Main JS-->
        <script src="<?php echo SITE_URL ?>js/main.js"></script>

</body>

</html>
<!-- end document-->