 <?php echo $this->Flash->render(); ?>
<?php echo $this->Form->create($Coursecategory, array('class'=>'form-horizontal','id' => 'sevice_form', 'enctype' => 'multipart/form-data')); ?>

                  <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header"><strong>New Test Detail</strong></div>
                      <div class="card-header">
                          
                          <?php if(isset($Course['id'])){ echo '<small> Edit Examiner Detail</small>'; }else{ echo 'Add Examiner';} ?>
                      </div>

                      <div class="card-body card-block">
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label for="company" class=" form-control-label">Test Name</label>
                            <?php echo $this->Form->input('name', array('class' => 
                    'longinput form-control','placeholder'=>'Enter Test Name','required','label'=>false)); ?>
                        </div>
                        </div>
                        <div class="col-sm-6">
                        <div class="form-group">
                            <label for="company" class=" form-control-label">Test Category</label>
                            <?php $sector=array('1'=>'Bike Ride');
                            echo $this->Form->input('email', array('class' => 
                    'longinput form-control','multiple', 'empty'=>'Car Drive','options'=>$sector,'required','label'=>false)); ?>
                        </div>

                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="company" class=" form-control-label">Test Type</label>
                             <?php $sector=array('1'=>'Hardest');
                            echo $this->Form->input('email', array('class' => 
                    'longinput form-control', 'empty'=>'Easy','options'=>$sector,'required','label'=>false)); ?>
                        </div>
                    </div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="company" class=" form-control-label">Date</label>
						<div class="bfh-datepicker" data-format="y-m-d" data-date="2018-01-01">
						<div class="input-prepend bfh-datepicker-toggle" data-toggle="bfh-datepicker">
						<span class="add-on"><i class="icon-calendar"></i></span>
					<?php echo $this->Form->input('number', array('class' => 'longinput form-control input-medium','placeholder'=>'','required','label'=>false, 'readonly')); ?>
						</div>
						</div>
						</div>
					</div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="company" class=" form-control-label">Duration (in Min)</label>
                            <?php echo $this->Form->input('number', array('class' => 
                    'longinput form-control','placeholder'=>'Test Duration','required','label'=>false)); ?>
                        </div>
                    </div>

<div class="col-sm-12">
<div class="form-group">
<label for="company" class=" form-control-label">Question Type</label>
<div class="input-group">
<span class="input-group-addon">Harder</span>
<input id="msg" type="text" class="form-control" name="msg" placeholder="Quetion">
<span class="input-group-addon">Hard</span>
<input id="msg" type="text" class="form-control" name="msg" placeholder="Quetion">
<span class="input-group-addon">Easy</span>
<input id="msg" type="text" class="form-control" name="msg" placeholder="Quetion">

</div>
</div>
</div>

                     <div class="col-sm-12">
                        <div class="form-group">
                            <label for="company" class=" form-control-label">Instruction</label>
                            <?php echo $this->Form->input('description', array('class' => 
                    'longinput form-control ckeditor','label'=>false,'type'=>'textarea')); ?>
                        </div>
                        </div>


        <div class="content mt-3">
                   <div class="row">
                    <div class="col-sm-1">
                     <a href="<?php echo SITE_URL ?>admin/newexam" class="btn btn-primary " >Back</a>
                    </div>
                    <div class="col-sm-1">
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

