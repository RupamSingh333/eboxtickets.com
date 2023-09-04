<body id="login">
  <header class="header2">
    <div class="container">
      <div class="row">
        <div class="col-sm-3 text-left"><img src="images/logo (1).png"></div>
        <div class="col-sm-3 text-center"><img src="images/tveta-logo.png"></div>
        <div class="col-sm-3 text-center"><img src="images/ntsa logo.png"></div>
        <div class="col-sm-3 text-right">
          <div id="main">
            <a href="#" onclick="openNav()"><i class="fas fa-align-justify"></i></a>

          </div>
          <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a href="<?php echo  SITE_URL; ?>">Home</a>
            <?php if ($this->request->session()->read('Auth.User.id')) { ?>


              <a href="<?php echo  SITE_URL; ?>profile">Profile</a>
              <a href="<?php echo  SITE_URL; ?>testcenters">Test Center</a>
              <a href="<?php echo  SITE_URL; ?>testhistory">Test History</a>
              <a href="<?php echo  SITE_URL; ?>logins/logouts">Logout</a>

            <?php } else { ?>

              <a href="<?php echo  SITE_URL; ?>logins">Login</a>
              <a href="<?php echo  SITE_URL; ?>signup">Sign up</a>


              <a href="<?php echo  SITE_URL; ?>logins">Test Center</a>
              <a href="<?php echo  SITE_URL; ?>logins">Test History</a>
            <?php } ?>




          </div>
        </div>
      </div>
    </div>
  </header>
  <section id="signup-slider">
    <div class="pro-slider-cnt">
      <h1>Login</h1>
      <ul>
        <li><a href="<?php echo  SITE_URL; ?>">Home</a> </li>
        <li><i class="fa fa-angle-double-right"></i></li>
        <li>Login</li>
      </ul>


    </div>



  </section>
  <section id="page-login">
    <div class="container">
      <?php echo $this->Flash->render(); ?>
      <h2 class="heading">Login</h2>

      <div class="row no-gutters log-box">


        <div class="col-lg-5 login-lft"></div>
        <div class="col-lg-7 log-r">
          <div class="profile-form log_in">


            <?php echo $this->Form->create('user', array('url' => array('controller' => 'logins', 'action' => 'logins'))); ?>
            <div class="form-group row">

              <div class="col-sm-12">
                <div class="inner-addon left-addon">
                  <i class="fas fa-user"></i>
                  <input name="email" type="email" autocomplete="off" class="form-control" id="inputEmail3" placeholder="Email">
                </div>
              </div>
            </div>



            <div class="form-group row">
              <div class="col-sm-12">
                <div class="inner-addon left-addon">
                  <i class="fas fa-clipboard-check"></i>
                  <input name="password" type="password" autocomplete="off" class="form-control" id="inputEmail3" placeholder="Confirm Password">
                </div>
              </div>
            </div>
            <div class="form-group row pl-3">

              <div class="col-sm-6 text-left">
                <input type="checkbox" style="display:none;" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" style="display:none;" for="exampleCheck1">Remember me </label>
              </div>
              <div class="col-sm-6 text-right"><a href="<?php echo  SITE_URL; ?>forgotpassword">Forgot Password</a></div>


            </div>
            <div class="form-group row">

              <div class="col-sm-12">
                <button type="submit" class="btn btn-primary">Login</button>


              </div>
            </div>

            </form>

          </div>
        </div>

      </div>
    </div>
  </section>