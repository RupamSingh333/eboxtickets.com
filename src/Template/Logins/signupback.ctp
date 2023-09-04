<section id="login_page"><!--event_detail_page-->
<div class="container">
<hgroup class="innerpageheading">
<h2>Login</h2>
<ul>
<li><a href="<?php echo SITE_URL; ?>">Home</a></li>
<li><i class="fas fa-angle-double-right"></i></li>
<li>Login</li>
</ul>
</hgroup>

<div class="login_form">
		    <?php echo $this->Flash->render(); ?>

<h3 class="loinslogan">Get more things done with Login.</h3>
<h3 class="registerslogan">Get more things done with Registration</h3>

<ul class="nav nav-pills text-center">
    <li class="active"><a data-toggle="pill" href="#login_tab" class="logintabbtn">Login</a></li>
    <!--<li><a data-toggle="pill" href="#register_tab" class="registertabbtn">Register</a></li>-->
  </ul>
 <div class="tab-content">
    <div id="login_tab" class="tab-pane fade in active">
        <?php echo $this->Form->create($userDatas,array(
                       'class'=>'form-horizontal',
                       'controller'=>'logins',
                       'action'=>'frontlogin',
                       'enctype' => 'multipart/form-data',
                       'validate' )); ?>
  <div class="form-group">
    <div class="col-sm-4 col-xs-1"></div>
    <div class="col-sm-4 col-xs-10">
      <?php echo $this->Form->input('email',array('class'=>'form-control','value'=>$email,'placeholder'=>'E-Mail Address','id'=>'email','label' =>false,'required' => true)); ?>
    </div>
    <div class="col-sm-4 col-xs-1"></div>
  </div>
  <div class="form-group">
      <div class="col-sm-4 col-xs-1"></div>
    <div class="col-sm-4 col-xs-10"> 
       <?php echo $this->Form->input('password',array('type'=>'password','class'=>'form-control','placeholder'=>'Enter Password','value'=>$password, 'id'=>'password','label' =>false,'required' => true)); ?>
    </div>
    <div class="col-sm-4 col-xs-1"></div>
  </div>
  <div class="form-group"> 
    <div class="col-sm-12">
       <?php
          echo $this->Form->submit(
              'Login', 
              array('class' => 'main_button', 'id' => 'submit', 'title' => 'Login','style'=>'border: 2px solid #ec118a;')
          ); ?>
 
    </div>
  </div>
  
  <div class="form-group"> 
    <div class="col-sm-12 ">
        <a href="<?php echo $this->Url->build('/users/forgotcpassword'); ?>" class="forgotpassword">Forgot Password ?</a>
    </div>
  </div>
  
</form>
    </div>
    <div id="register_tab" class="tab-pane fade">
    
  <?php echo $this->Form->create('Users', array(
                       'class'=>'form-horizontal',
                       'id'=>'registration_form',
                       'enctype' => 'multipart/form-data',
                       'validate',
                       'autocomplete'=>'off','onsubmit'=>'return check_pass()' )); ?>

<div class="form-group">
    <div class="col-sm-4 col-xs-12"></div>
    <div class="col-sm-2 col-xs-6 text-right">
        <!--<label class=""><input type="radio" class="optn" name="role_id" value="3" checked>Customer</label>-->
   
   <div class="back-1"><div class="checkbox checkbox-success">
<input type="radio" class="optn" name="role_id" value="3" id="sign_ctmrd" checked>
<label for="sign_ctmrd"> Customer </label>
</div><!--checkbox--></div>

    </div>
     <div class="col-sm-2 col-xs-6 text-left">
        
   <!--<label class=""><input type="radio" class="optn" name="role_id" value="2">Organiser</label>-->
   
    <div class="back-1"> <div class="checkbox checkbox-success">
<input type="radio" class="optn" name="role_id" value="2" id="sign_orgrd">
<label for="sign_orgrd"> Organiser </label>
</div><!--checkbox--></div>
     <!--<input type="hidden" id="custId" name="custId" value="<?php ?>">-->

    </div>
    <div class="col-sm-4 col-xs-12"></div>
  </div>




  <div class="form-group">
    <div class="col-sm-4 col-xs-1"></div>
    <div class="col-sm-4 col-xs-10">
      <?php echo $this->Form->input('name',array('class'=>'form-control','placeholder'=>'Name','id'=>'username','label' =>false,'required' => true,'autocomplete'=>'off','pattern'=>'.*[^ ].*')); ?>
     <!--<input type="hidden" id="custId" name="custId" value="<?php ?>">-->

    </div>
    <div class="col-sm-4 col-xs-1"></div>
  </div>
  <div class="form-group">
      <div class="col-sm-4 col-xs-1"></div>
    <div class="col-sm-4 col-xs-10"> 
       <?php echo $this->Form->input('mobile',array('class'=>'form-control','placeholder'=>'Mobile Number','maxlength'=>12,'minlength'=>'10','id'=>'phone','label' =>false,'autocomplete'=>'off','required' => true,'pattern'=>'.*[^ ].*','onkeypress'=>'return isNumber(event);',)); ?>
  
  <span id="phonemessage" style="color:red; display:none">Mobile Number is already exist !</span>
     
    </div>
    <div class="col-sm-4 col-xs-1"></div>
  </div>
  <div class="form-group">
      <div class="col-sm-4 col-xs-1"></div>
    <div class="col-sm-4 col-xs-10"> 
        <?php echo $this->Form->input('email',array('class'=>'form-control','placeholder'=>'E-Mail Address','id'=>'myemail','label' =>false,'required' => true)); ?> 
  
  <span id="ntcs" style="color:red; display:none">Invalid email</span>
  <span id="emailar" style="color:red; display:none">Email is already exist !</span> 
     
    </div>
    <div class="col-sm-4 col-xs-1"></div>
  </div> 








  <div class="form-group">
      <div class="col-sm-4 col-xs-1"></div>
    <div class="col-sm-4 col-xs-10">
      <?php echo $this->Form->input('password',array('class'=>'form-control','placeholder'=>'Password','label' =>false,'required' => true,'type'=>'password','id'=>'p1')); ?> 
    </div>
    <div class="col-sm-4 col-xs-1"></div>
  </div>
  <div class="form-group">
      <div class="col-sm-4 col-xs-1"></div>
    <div class="col-sm-4 col-xs-10">
    <input type="password" name="confirmpassword" required="" class="form-control" id="registration" placeholder="Confirm Password" onfocus="validatePass(document.getElementById('p1'), this);"  oninput="validatePass(document.getElementById('p1'), this);" >
    
    </div>
    <div class="col-sm-4 col-xs-1"></div>
  </div>
  <div class="form-group"> 
    <div class="col-sm-12">
      <?php
          echo $this->Form->submit(
              'Submit', 
              array('class' => 'main_button','title' => 'Submit','style'=>'border: 2px solid #ec118a;')
          ); ?>

    </div>
  </div>
  
<?php echo $this->Form->end(); ?>
    </div>
  </div> 

</div>

</div> 
<div class="footer_buildings"></div>
</section><!--upcoming Event End-->
<script>
$(document).ready(function(){
    $(".registertabbtn").click(function(){
        $("#login_page .login_form").addClass("addtital"); 
    });
});
</script>
<script>
$(document).ready(function(){
    $(".logintabbtn").click(function(){
        $("#login_page .login_form").removeClass("addtital");
    });
});
</script>


<script type="text/javascript">
	
	
	
	
	
// validate Password
	function validatePass(p1, p2) 
	{

	if (p1.value != p2.value) {
		p2.setCustomValidity('Password incorrect');
	} else 
		{
		p2.setCustomValidity('');
		}
	}
	
	
	
	
	
// duplicate email check functionality
	
$(document).ready(function() {
	//alert("test");
	$( "#myemail" ).change(function() {
	var txt = $('#myemail').val();
	$('#ntcs').css('display','none');  
	$.ajax({ 
		type: 'POST', 
		url: '<?php echo SITE_URL; ?>Logins/checkemail',
		data: {'email':txt},
			success: function(data){  
			if(data == 0){
			$('#emailar').css('display','none');   
			}
			else{
			$('#emailar').css('display','block');   
			$('#myemail').val('');  
			}  
			}    
	});   

	});

});  

// duplicate phone number validation

$( "#phone" ).change(function() { 
var mobile = $('#phone').val(); 
      $.ajax({ 
        type: 'POST', 
        url: '<?php echo SITE_URL; ?>Logins/checkemail',
        data: {'mobile':mobile},
        success: function(data){  
         if(data==0){
        $('#phonemessage').css('display','none');   
     }
     else{
       
        $('#phonemessage').css('display','block');   
        $('#phone').val('');  
     }  
        },    
    });   

});



function isNumber(evt) {
   
evt = (evt) ? evt : window.event;
var charCode = (evt.which) ? evt.which : evt.keyCode;
if (charCode > 31 && (charCode < 46 || charCode > 57 || charCode == 47)) {
alert('<?php echo  __('Enter only numeric digits');?>');
return false;
}
return true;
}

 </script>


