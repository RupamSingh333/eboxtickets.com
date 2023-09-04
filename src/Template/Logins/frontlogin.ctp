<section id="sigin">
  <div class="container">
    <div class="heading">
      <h1>Login</h1>
      <h2>Login</h2>
      <p>Existing users use the form below to sign in.</p>

    </div>
    <div class="form_contant">
      <?php echo $this->Flash->render(); ?>

      <div class="row">
        <div class="col-md-6 col-sm-12 sig_img">
          <img class="" src="<?php echo SITE_URL; ?>images/sigin.png" alt="">
        </div>

        <div class="col-md-6 col-sm-12">
          <div class="contact_form">
            <!-- <h3>Get In Touch</h3> -->
            <h2>Login to Your Account</h2>


            <div class="form-group">
              <?php echo $this->Form->create($userDatas, array(
                'class' => 'form-horizontal',
                'controller' => 'logins',
                'action' => 'frontlogin',
                'enctype' => 'multipart/form-data',
                'autocomplete' => 'off',
                'validate'
              )); ?>
              <!-- <input type="email" class="form-control" name="email" placeholder="Email" required>
              <input type="password" class="form-control" name="password" placeholder="Password" required> -->
              <?php echo $this->Form->input('email', array(
                'value' => $email, 'type' => 'email', 'class' => 'form-control',
                'placeholder' => 'Username', 'required' => 'required'
              )); ?>

              <?php echo $this->Form->input('password', array('value' => $password, 'class' => 'form-control', 'placeholder' => 'Password', 'required' => 'required')); ?>


              <div id="html_element" class="login_capcher"></div>


              <div class="row justify-content-space-between">
                <div class="col-6">
                  <div class="form-check">
                    <!-- <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Remember</label> -->
                    <?php if ($remember_me == 1) {
                      $checked = 'checked';
                    }
                    echo $this->Form->input('remember_me', array('type' => 'checkbox', 'class' => 'form-check-input', 'checked' => $checked, 'value' => 1));
                    ?>
                  </div>
                </div>

                <div class="col-6">
                  <a href="users/forgotcpassword">
                    <p class="for_pass">Forgot your password?</p>
                  </a>

                </div>
              </div>

              <button type="submit" class="btn reg">Login</button>
            </div>

            </form>
            <hr>
            <div class="reg_btn">
              <!-- <h6>Register</h6> -->
              <p>Don't have an account? <a class="rg" href="signup">Sign up</a> </p>
            </div>


          </div>
        </div>

      </div>

    </div>


  </div>
</section>

<!-- =========================================== -->

<style>
  #g-recaptcha-response {
    display: block !important;
    position: absolute;
    margin: -78px 0 0 0 !important;
    width: 302px !important;
    height: 76px !important;
    z-index: -999999;
    opacity: 0;
}
</style>

<!-- ================================= -->
<script type="text/javascript">
  var onloadCallback = function() {
    grecaptcha.render('html_element', {
      'sitekey': '6LeB9HAiAAAAACkicqxER3FNn7DzH0shkLfYvGk1'
    });
  };

  window.onload = function() {
    var $recaptcha = document.querySelector('#g-recaptcha-response');

    if ($recaptcha) {
      $recaptcha.setAttribute("required", "required");
    }
  };
</script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>