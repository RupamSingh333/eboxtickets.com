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

><h1>Forgot Password</h1>
<ul>
<li><a href="<?php echo  SITE_URL; ?>">Home</a> </li>
<li><i class="fa fa-angle-double-right"></i></li>
<li>Forgot Password</li>
</ul>


</div>



</section>
<section id="page-profile">
  <div class="container">
<?php echo $this->Flash->render(); ?>
  <h2 class="heading">Forgot your password </h2>
  <div class="profile-form">

         

<?php echo $this->Form->create('Users',array('url' => array('controller' => 'Logins', 'action' => 'forgotpassword'),'type'=>'file','inputDefaults'=>array('div'=>false,'label'=>false),'class'=>'form-horizontal','id'=>'LoginsIndexForm','autocomplete'=>'off')); ?>

    <div class="form-group">
      <div class="col-sm-12">
       <div class="inner-addon left-addon">
    <i class="fas fa-user"></i>
      <input name="email" type="email" autocomplete="off" class="form-control" id="inputEmail3" placeholder="Email">
    </div>
      </div>
    </div>

      <div class="form-group"> 
    <div class="col-sm-12">
      <button type="submit" class="btn btn-primary"><?php echo ($multiplelang[6]['title']) ? $multiplelang[6]['title'] : "Submit" ?></button>
    </div>
  </div>
    
 <?php echo $this->Form->end();   ?>
</div>
<div class="col-sm-4"></div>
</div>

</section>
