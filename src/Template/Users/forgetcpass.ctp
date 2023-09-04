<section id="reset">
  <div class="container">
    <div class="in_heading">
      <h1>Change Password</h1>
      <h2>Change Password</h2>
      <p>Enter your email below and an email will be sent to you with further instructions.</p>
    </div>
    <div class="form_contant">

      <div class="row     align-items-center">
        <div class="col-sm-6 sig_img">
          <img src="<?php echo SITE_URL; ?>images/reset-password.png" alt="no-Image">
        </div>
        <div class="col-sm-6">
          <div class="contact_form">
            <h2>Change Password</h2>
            <div class="form-group">
              <?php echo $this->Flash->render(); ?>
              <?php if ($ftyp == 1) { ?>
                <?php echo $this->Form->create('User', array(
                  'class' => 'form-horizontal',
                  'controller' => 'Users',
                  'action' => 'forget_cpass/kp/' . $usrid,
                  'type' => 'file',
                  'enctype' => 'multipart/form-data',
                  'validate',
                  'onsubmit' => 'return validate();'
                )); ?>
                <?php echo $this->Form->password('password', array('required', 'id' => 'pass', 'class' => 'form-control', 'placeholder' => ($multiplelang[14]['title']) ? $multiplelang[14]['title'] : "New Password")); ?>
                <?php echo $this->Form->password('cpassword', array('required', 'id' => 'cpass', 'class' => 'form-control', 'placeholder' => ($multiplelang[15]['title']) ? $multiplelang[15]['title'] : "Confirm Password")); ?>
            </div>
            <input type="submit" name="btnSubmit" value="Submit" class="btn btn-primary form-control">
          <?php } 
          // else {
          //       echo ("<span style='color:red;align:center;margin-left:110px'>Invalid Key or Expired link</span>");
          //     }

          ?>
          <?php echo $this->Form->end(); ?>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- =========================================== -->

<script type="text/javascript">
  function validate() {

    if ($('#pass').val() != $('#cpass').val()) {
      alert("Password and confirm password should be same");
      return false;
    } else
      return true;
  }
</script>