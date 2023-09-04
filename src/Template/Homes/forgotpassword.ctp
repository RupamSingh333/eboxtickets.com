<section id="forgot_password_page"><!--event_detail_page-->
<div class="container">
<hgroup class="innerpageheading">
<h2>Forgot Password</h2>
<ul>
<li><a href="#">Home</a></li>
<li><i class="fas fa-angle-double-right"></i></li>
<li>Forgot Password</li>
</ul>
</hgroup>

<div class="forgot_form">
<h3>Can't Sign In? Forgot Password?</h3>

 <div class="tab-content">
    <div id="login_tab" class="tab-pane fade in active">
     <?php echo $this->Form->create('login',array('url'=>array('controller'=>'logins','action'=>'forgotcpassword')));?>
  <div class="form-group">
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
       <?php echo $this->Form->input('email',array('class'=>'form-control','placeholder'=>'E-Mail Address','label' =>false,'required'=>true)); ?>
    </div>
    <div class="col-sm-4"></div>
  </div>
  
  <div class="form-group"> 
    <div class="col-sm-12">
       <?php
          echo $this->Form->submit(
              'Forgot Password', 
              array('class' => 'main_button', 'id' => 'submit', 'title' => 'Forgot Password')
          ); ?>
      <button type="submit" class="main_button">Forgot Password</button>
    </div>
  </div>
  
  
  
</form>
    </div>
  </div> 

</div>

</div> 
<div class="footer_buildings"></div>
</section><!--upcoming Event End-->