<section id="reset">
  <div class="container">
    <div class="heading">
      <h1>Reset Password</h1>
      <h2>Reset Password</h2>
      <p>Enter your email below and an email will be sent to you with further instructions.</p>
    </div>
    <div class="form_contant">
      
      <div class="row     align-items-center">
        <div class="col-md-6 col-sm-12 sig_img">
          <img src="<?php echo SITE_URL; ?>images/reset-password.png" alt="no-Image">
        </div>
        <div class="col-md-6 col-sm-12">
          <div class="contact_form">
            <h2>Reset Password</h2>
            <div class="form-group">
              <?php echo $this->Flash->render(); ?>
            <?php echo $this->Form->create('forget',array(
                       'class'=>'form-horizontal',
                       'controller'=>'users',
                       'action'=>'forgotcpassword',
                       'enctype' => 'multipart/form-data',
                       'validate' )); ?>
              <!-- <input type="email" class="form-control" name="email" placeholder="E-Mail Address*" required> -->
              <?php echo $this->Form->input('email',array('class'=>'form-control','placeholder'=>'E-Mail Address','label' =>false,'required'=>true)); ?>
            </div>
            <input type="submit" name="btnSubmit" value="Forgot Password" class="btn btn-primary form-control">
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- =========================================== -->



<!-- ================================= -->