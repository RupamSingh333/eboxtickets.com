<section id="signup">
  <div class="container">
    <div class="heading">
      <h1>Create Account</h1>
      <h2>Register</h2>
      <p>Enter your information below to create your account</p>
    </div>

    <div class="form_contant">
      <?php echo $this->Flash->render(); ?>
     
      <div class="row">
        <div class="col-md-6 col-sm-12 sig_img">
          <img src="<?php echo SITE_URL; ?>images/signup1.png" alt="">
        </div>

        <div class="col-md-6 col-sm-12">
       
          <div class="contact_form">
          <h2>Register</h2>
            <!-- <h3>Get In Touch</h3> -->
            <?php echo $this->Form->create($userDatas, array(
              'class' => 'form-horizontal',
              'controller' => 'logins',
              'action' => 'signup',
              'enctype' => 'multipart/form-data',
              'autocomplete' => 'off',
              'validate'
            )); ?>

            <div class="form-group">

              <input type="text" class="form-control" name="fname" placeholder="First Name*" required>

              <input type="text" class="form-control" name="lname" placeholder="Last Name*" required>

              <input type="email" class="form-control" name="email" placeholder="Email*" required>

              <input type="password" class="form-control" name="password" placeholder="Password*" required>

              <div class="row align-items-center">
                <label for="inputEmail3" class="col-sm-3 col-form-label">Gender</label>
                <div class="col-sm-9">
                  <input type="radio" name="gender" value="male" checked="checked">
                  <label for="inputEmail3" class="col-form-label mr-3">Male</label>
                  <input type="radio" name="gender" value="female" >
                  <label for="inputEmail3" class="col-form-label">Female</label>
                  <!-- <input type="radio" name="gender" value="other" >
                  <label for="inputEmail3" class="col-form-label">Other</label> -->
                </div>
              </div>

              <div class="row align-items-center">
                <label for="inputEmail3" class="col-sm-3 col-form-label">Date of Birth</label>
                <div class="col-sm-9">
                  <input type="date" class="form-control" name="dob" required>
                </div>
              </div>


            </div>

            <div class="form_checkb d-flex align-items-start">
            <input type = "checkbox" name="termscheck" required>
            <p class="chack_cont">By Creating An Account You Agree To Our <span><a target="_blank" href="<?php echo SITE_URL; ?>pages/privacy-policy">Privacy Policy</a></span> and Accept Our <span> <a target="_blank" href="<?php echo SITE_URL; ?>pages/terms-and-conditions">Terms and Conditions.</a></span></p>
            


            </div>                


            <!-- <div class="row d-flex justify-content-space-between">
              <div class="col-6"><button type="submit" class="btn mt-3 reg">Register</button></div>
            
    
            </div> -->
            <button type="submit" class="btn reg">Register</button>
            </form>
            <hr>
            
            <div class="reg_btn">
              <!-- <h6>Register</h6> -->
              <p>Already have an account?<a class="rg" href="login"> Log in</a> </p>
            </div>
          </div>
        </div>

      </div>

    </div>


  </div>
</section>

<!-- =========================================== -->



<!-- ================================= -->