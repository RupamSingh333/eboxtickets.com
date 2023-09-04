  <?php echo $this->Form->create($event, array('class'=>'form-horizontal','id' => 'sevice_form', 'enctype' => 'multipart/form-data')); ?>
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header"><strong> <?php if(isset($event['id'])){ echo '<small> Edit Event</small>'; }else{ echo 'Add Complimentary ';} ?></strong></div>
      <div class="card-body card-block">

        <div class="col-sm-6">
          <div class="form-group">
            <label>User Name</label>
            <?php
            echo $this->Form->input('name', array('class' => 'longinput form-control input-medium','placeholder'=>'User name' ,'type'=>'text','label'=>false,'autocomplete'=>'off')); ?>
          </div>
        </div> 

        <div class="col-sm-6">
          <div class="form-group">
            <label>User Email</label>
            <?php
            echo $this->Form->input('email', array('class' => 'longinput form-control input-medium','placeholder'=>'User Email' ,'type'=>'email','required'=>true, 'label'=>false,'autocomplete'=>'off')); ?>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label>User Mobile</label>
            <?php
            echo $this->Form->input('mobile', array('class' => 'longinput form-control input-medium','placeholder'=>' Mobile Number' ,'type'=>'text','required'=>true,'label'=>false,'autocomplete'=>'off')); ?>
          </div>
        </div>

    
        <div class="col-sm-12">
          <div class="form-group">
           <div class="col-sm-1">
            <?php if(isset($event['id'])){
              echo $this->Form->submit('Update', array('title' => 'Update','div'=>false,
              'class'=>array('btn btn-primary btn-sm'))); }else{  ?>
                <button type="submit" class="btn btn-success">Submit</button>
              <?php  } ?>
            </div>
          </div>
        </div>
   
      </div>
  </div>
</div>
<?php echo $this->Form->end(); ?>




  



