<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
     Profile  Manager
       
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
       <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
		    <div class="box-header with-border">
		      <h3 class="box-title">Add Profile setting</h3>
		    </div>
            <!-- /.box-header -->
            <!-- form start -->
<?php //pr($page); die; ?>
		<?php echo $this->Flash->render(); ?>

 <?php $role_id=$this->request->session()->read('Auth.User.role_id'); ?>
	
         		<?php	if($role_id=='1') {
		?>    
		<?php echo $this->Form->create($sitesetting , array(
                       
                       'class'=>'form-horizontal',
			'id' => 'sitesetting_form',
                       'enctype' => 'multipart/form-data',
                       'novalidate'
                     	)); ?>
            <?php }else { ?>    
				<?php echo $this->Form->create($sitesetting , array(
                       'url'=>array('controller'=>'users','action'=>'changepassword'), 
                       'class'=>'form-horizontal',
			           'id' => 'sitesetting_form',
                       'enctype' => 'multipart/form-data',
                       'novalidate'
                     	)); ?>	
				
				     	
		   <?php } ?>
		      <div class="box-body">
			<?php	if($role_id=='1') {
		?> 	  
		        <div class="form-group">
		          <label for="inputEmail3" class="col-sm-2 control-label">First Name</label>

		          <div class="col-sm-10">
			<?php echo $this->Form->input('first_name',array('class'=>'form-control','placeholder'=>'First Name', 'id'=>'first_name','label' =>false)); ?>
		           
		          </div>
		        </div>
			<div class="form-group">
		          <label for="inputEmail3" class="col-sm-2 control-label">Last Name</label>

		          <div class="col-sm-10">
			<?php echo $this->Form->input('last_name',array('class'=>'form-control','placeholder'=>'Last Name', 'id'=>'last_name','label' =>false)); ?>
		           
		          </div>
		        </div>
		        
		  <div class="form-group">
		          <label for="inputEmail3" class="col-sm-2 control-label">Mobile</label>

		          <div class="col-sm-10">
			<?php echo $this->Form->input('mobile',array('class'=>'form-control','placeholder'=>'Mobile','maxlength'=>'20', 'id'=>'last_name','label' =>false)); ?>
		           
		          </div>
		        </div>      
		        
			<div class="form-group">
		          <label for="inputEmail3" class="col-sm-2 control-label">Contact Email</label>

		          <div class="col-sm-10">
			<?php echo $this->Form->input('contact_email',array('class'=>'form-control','placeholder'=>'Contact Email', 'id'=>'contact_email','label' =>false)); ?>
		           
		          </div>
		        </div>
		        
		     	  <div class="form-group">
		          <label for="inputEmail3" class="col-sm-2 control-label">Visitor Blocked From Visitor Manager Then Message for user In app</label>

		          <div class="col-sm-10">
			<?php echo $this->Form->input('message1',array('class'=>'form-control','placeholder'=>'Message','label' =>false)); ?>
		           
		          </div>
		        </div>   
		        
		   		   <div class="form-group">
		          <label for="inputEmail3" class="col-sm-2 control-label">Visitor Blocked From Visitor Subscription Manager Then Message for user In app</label>

		          <div class="col-sm-10">
			<?php echo $this->Form->input('message2',array('class'=>'form-control','placeholder'=>'Message','label' =>false)); ?>
		           
		          </div>
		        </div>   
		         
		            
		   		   <div class="form-group">
		          <label for="inputEmail3" class="col-sm-2 control-label">Disclaimer</label>

		          <div class="col-sm-10">
			<?php echo $this->Form->input('disclaimer',array('class'=>'form-control','placeholder'=>'Message','label' =>false)); ?>
		           
		          </div>
		        </div>       
		             
		        
	          <?php } ?>
		        
			<div class="form-group">
				  <div class="col-sm-10" style="margin-left: 148px;">
		        <a href="javascript:void(0)" class="chngpassword"  >Do you want to change password ?</a>
		        </div>
		        </div>

			<div class="passdata" style="display:none;">
			<div class="form-group">
		          <label for="inputEmail3" class="col-sm-2 control-label">New Password</label>

		          <div class="col-sm-10">
			<?php echo $this->Form->input('new_password',array('class'=>'form-control','placeholder'=>'New Password', 'id'=>'password','label' =>false)); ?>
		           
		          </div>
		        </div>
			<div class="form-group">
		          <label for="inputEmail3" class="col-sm-2 control-label">Confirm Password</label>

		          <div class="col-sm-10">
			<?php echo $this->Form->input('confirm_pass',array('class'=>'form-control','placeholder'=>'Confirm Password', 'id'=>'confirm_pass','label' =>false)); ?>
		           
		          </div>
		        </div>
			</div>
			
			</div>
		      
		       
		      <!-- /.box-body -->
		      <div class="box-footer">
			<?php
			echo $this->Html->link('Cancel', [
			'controller' => 'visitors',	
			    'action' => 'index'
			   
			],['class'=>'btn btn-default']); ?>
		      
			<?php
			if($role_id=='1') {
				if(isset($work['id'])){
				echo $this->Form->submit(
				    'Update', 
				    array('class' => 'btn btn-info pull-right', 'title' => 'Update')
				); }else{ 
				echo $this->Form->submit(
				    'Add', 
				    array('class' => 'btn btn-info pull-right', 'title' => 'Add')
				);
				}
			}
			else{
			echo $this->Form->submit(
				    'Update', 
				    array('class' => 'btn btn-info pull-right', 'title' => 'Update')
				);		
			}
		       ?>
		      </div>
		      <!-- /.box-footer -->
		  <?php echo $this->Form->end(); ?>
          </div>
         
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>


		<?php	if($role_id=='1') {
		?> 	
<script>
$(document).ready(function(){
    $(".chngpassword").click(function(){
        $(".passdata").toggle();
    });
});
</script>

<?php }else{ ?>
<script>
$(document).ready(function(){
$(".passdata").toggle();
});
</script>	
	
	<?php } ?>

