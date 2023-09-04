<body id="home">
<header class="header2">
  <div class="container">
    <div class="row">
      <div class="col-sm-3 text-left"><img src="<?php echo  SITE_URL; ?>images/logo (1).png"></div>
      <div class="col-sm-3 text-center"><img src="<?php echo  SITE_URL; ?>images/tveta-logo.png"></div>
      <div class="col-sm-3 text-center"><img src="<?php echo  SITE_URL; ?>images/ntsa logo.png"></div>
      <div class="col-sm-3 text-right">
      <div id="main">
  <a href="#" onclick="openNav()"><i class="fas fa-align-justify"></i></a>
  
</div>
   <div id="mySidenav" class="sidenav">
     
      <?php if($this->request->session()->read('Auth.User.id')){ ?>

	   <a href="<?php echo  SITE_URL; ?>">Home</a>
	    <a href="<?php echo  SITE_URL; ?>profile">Profile</a>
   <a href="<?php echo  SITE_URL; ?>testcenters">Test Center</a> 
     <a href="<?php echo  SITE_URL; ?>testhistory">Test History</a>
     	   <a href="<?php echo  SITE_URL; ?>logins/logouts">Logout</a>
	   
	   <?php }else{ ?>
		   <a href="<?php echo  SITE_URL; ?>">Home</a>
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
<section id="pro-slider">
<div class="pro-slider-cnt"

><h1>My Profile</h1>
<ul>
<li><a href="<?php echo  SITE_URL; ?>">Home</a> </li>
<li><i class="fa fa-angle-double-right"></i></li>
<li>About Us</li>
</ul>


</div>



</section>
<section id="page-profile">
  <div class="container">

	    <?php echo $this->Flash->render(); ?>
  <h2 class="heading">My Profile</h2>
  <div class="profile-form">
  
  
<?php echo $this->Form->create($user, array('class'=>'form-horizontal','id' => 'sevice_form', 'enctype' => 'multipart/form-data')); ?>
  <div class="form-group row">
 <!--<div class="col-sm-12 text-right"><a href="<?php echo  SITE_URL; ?>logins/profile"><i class="fas fa-edit"></i>Edit Profile</a></div>-->
  </div>
  <div class="form-group row">
   
    <div class="col-sm-12">
    <div class="inner-addon left-addon">
    <i class="fas fa-user"></i>
      <?php echo $this->Form->input('name', array('class' => 
                    'longinput form-control','placeholder'=>'Enter Name','required','label'=>false)); ?>
    </div></div>
  </div>
  <div class="form-group row">
   
    <div class="col-sm-12">
    
    <div class="inner-addon left-addon">
    <i class="fas fa-envelope"></i>
       <?php echo $this->Form->input('email', array('class' => 
                    'longinput form-control','placeholder'=>'Email','type'=>'email','required','label'=>false)); ?>
                    </div></div>
  </div>
  <div class="form-group row">
   
    <div class="col-sm-12">
    <div class="inner-addon left-addon">
    <i class="fas fa-phone"></i>
<?php echo $this->Form->input('phone', array('class' => 
                    'longinput form-control' ,'placeholder'=>'Enter Mobile Number','required','onkeypress'=>'return isNumber(event);','maxlength'=>'12','label'=>false)); ?>    </div></div>
  </div>

  <div class="form-group row">
   
    <div class="col-sm-12">
    <div class="inner-addon left-addon">
    <i class="fas fa-lock"></i>
 <?php echo $this->Form->input('password', array('class' => 
                    'longinput form-control', 'type'=>'Password' ,'placeholder'=>'Password','required','label'=>false,'value'=>$user['cpassword'])); ?>    </div></div>
  </div>
  
  <div class="form-group row">
   
    <div class="col-sm-12">
    <div class="inner-addon left-addon">
   <i class="fas fa-clipboard-check"></i>
 <?php echo $this->Form->input('cpassword', array('class' => 
                    'longinput form-control', 'type'=>'Password' ,'placeholder'=>'Confirm Password','required','label'=>false)); ?>    </div></div>
  </div>
  
   <div class="col-sm-1" style=" margin-left: 190px;">
                    <?php if(isset($transports['id'])){
                    echo $this->Form->submit('Update', array('title' => 'Update','div'=>false,
                    'class'=>array('btn btn-primary btn-sm'))); }else{  ?>
                    <button type="submit" class="btn btn-success">Update</button>
                    <?php  } ?>
                    </div>
 <?php echo $this->Form->end(); ?>
  
  </div>
  
 </div>
</section>


