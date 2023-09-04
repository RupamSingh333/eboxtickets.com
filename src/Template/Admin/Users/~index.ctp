
<style>

.chngpass{ margin-left:15px}

</style>
<?php echo $this->Flash->render(); ?>

<?php echo $this->Form->create($Users, array('class'=>'form-horizontal','id' => 'sevice_form', 'enctype' => 'multipart/form-data')); ?>

<div class="col-lg-12">
<div class="card">
<div class="card-header"><strong>Profile setting</strong></div>


<div class="card-body card-block">
<div class="row">

<div class="col-sm-6">
<div class="form-group">
<label for="company" class=" form-control-label">Name</label>
<?php echo $this->Form->input('first_name',array('class'=>'form-control','placeholder'=>'Name', 'id'=>'first_name','label' =>false)); ?>
</div>
</div>

<div class="col-sm-6">
<div class="form-group">
<label for="company" class=" form-control-label">Mobile</label>
<?php echo $this->Form->input('Mobile',array('class'=>'form-control','placeholder'=>'Mobile Number', 'id'=>'Mobile','label' =>false)); ?>
</div>
</div>

<div class="col-sm-6">
<div class="form-group">
<label for="company" class=" form-control-label">Contact Email</label>
<?php echo $this->Form->input('Mobile',array('class'=>'form-control','placeholder'=>'Email Address', 'id'=>'Mobile','label' =>false)); ?>
</div>
</div>

 
</div>

</div>







<div class="row">
<div class="col-sm-12">
<div class="form-group">

<a href="javascript:void(0)" class="chngpass "  >Do you want to change password ?</a>

</div>
</div>
<div class="col-sm-12" style="padding-bottom: 15px;">
<div class="passdata" style="display:none;">
<div class="form-group">
<div class="col-sm-6">
<label for="inputEmail3" class="form-control-label">New Password</label>
<?php echo $this->Form->input('new_password',array('class'=>'form-control','placeholder'=>'New Password', 'id'=>'password','label' =>false)); ?>
</div>
</div>

<div class="form-group">
<div class="col-sm-6">
<label for="inputEmail3" class="form-control-label">Confirm Password</label>
<?php echo $this->Form->input('confirm_pass',array('class'=>'form-control','placeholder'=>'Confirm Password', 'id'=>'confirm_pass','label' =>false)); ?>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="col-lg-1">
<div class="card-body">

<?php if(isset($transports['id'])){
echo $this->Form->submit('Update', array('title' => 'Update','div'=>false,
'class'=>array('btn btn-primary btn-sm'))); }else{  ?>
<button type="submit" class="btn btn-success">Submit</button>
<?php  } ?>
</div>
</div>

</div>
</div>
</div>

<?php echo $this->Form->end(); ?>

</div>







