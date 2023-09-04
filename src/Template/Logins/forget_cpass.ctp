<body id="sign-up">
<header class="header2">
  <div class="container">
    <div class="row">
      <div class="col-sm-3 text-left"><img src="<?php echo SITE_URL; ?>images/logo (1).png"></div>
      <div class="col-sm-3 text-center"><img src="<?php echo SITE_URL; ?>images/tveta-logo.png"></div>
      <div class="col-sm-3 text-center"><img src="<?php echo SITE_URL; ?>images/ntsa logo.png"></div>
      <div class="col-sm-3 text-right">
      <div id="main">
  <a href="#" onclick="openNav()"><i class="fas fa-align-justify"></i></a>
  
</div>
      <div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="<?php echo  SITE_URL; ?>">Home</a>
 <?php if($this->request->session()->read('Auth.User.id')){ ?>

	   
	    <a href="<?php echo  SITE_URL; ?>profile">Profile</a>
   <a href="<?php echo  SITE_URL; ?>testcenters">Exam Center</a> 
     <a href="<?php echo  SITE_URL; ?>testhistory">Test History</a>
     	   <a href="<?php echo  SITE_URL; ?>logins/logouts">Logout</a>
	   
	   <?php }else{ ?>
		   
		    <a href="<?php echo  SITE_URL; ?>logins">Login</a> 
		      <a href="<?php echo  SITE_URL; ?>signup">Sign up</a>
		      
   <a href="<?php echo  SITE_URL; ?>logins">Exam Center</a> 
     <a href="<?php echo  SITE_URL; ?>logins">Test History</a>
		   <?php } ?>
     
</div>
</div>
    </div>
  </div>
</header>
<section id="signup-slider">
<div class="pro-slider-cnt"

><h1>Reset Password</h1>
<ul>
<li><a href="<?php echo  SITE_URL; ?>">Home</a> </li>
<li><i class="fa fa-angle-double-right"></i></li>
<li>Reset Password</li>
</ul>


</div>



</section>
<section id="page-profile">
  <div class="container">
<?php echo $this->Flash->render(); ?>
  <h2 class="heading">Reset Password</h2>
  <div class="profile-form">

<?php echo $this->Form->create('User',array('url'=>array('controller'=>'logins','action'=>'forget_cpass/kp/'.$usrid),'type'=>'file','inputDefaults'=>array('div'=>false,'label'=>false),'class'=>'cont-form','role'=>'form','onsubmit'=>'return validate();')); ?>
 <?php if($ftyp==1) { ?>
    <div class="form-group">
      <div class="col-sm-12">
 <div class="inner-addon left-addon">
    <i class="fas fa-clipboard-check"></i>
   
      <input name="password" type="password" required="required" autocomplete="off" class="form-control" id="pass" placeholder="Enter New Password">

    </div>
       
      </div>
    </div>
<div class="form-group">
      <div class="col-sm-12">
  
<div class="inner-addon left-addon">
    <i class="fas fa-clipboard-check"></i>
      <input name="cpassword" type="password" required="required" autocomplete="off" class="form-control" id="cpass" placeholder="Enter Confirm Password">
      </div>
    </div> </div>
      <div class="form-group"> 
    <div class="col-sm-12">
<span id="sd" style="color:red; display:none;">Password and confirm password should be same !!!</span>
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </div>
      <?php } else {
 echo("<span style='color:red;align:center;margin-left:110px'>Invalid Key or Expired link !!!!</span>");    
 }
  
  ?>
   
 <?php echo $this->Form->end();   ?>
</div>
<div class="col-sm-4"></div>
</div>

</section>
<script type="text/javascript">
function validate(){

	
	if($('#pass').val()!=$('#cpass').val()){
		$('#sd').show();
		return false;
	}else
	return true;
}

</script>
