 <?php echo $this->Flash->render(); ?>

<?php echo $this->Form->create($Coursecategory, array('class'=>'form-horizontal','id' => 'sevice_form', 'enctype' => 'multipart/form-data')); ?>

                  <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header"><strong>Test Category </strong></div>
                      <div class="card-header">
                          
                          <?php if(isset($Course['id'])){ echo '<small> Edit Test Category Detail</small>'; }else{ echo 'Add Test Category';} ?>
                      </div>

                      <div class="card-body card-block">
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label for="company" class=" form-control-label">Test Category</label>
                            <?php echo $this->Form->input('name', array('class' => 
                    'longinput form-control','placeholder'=>'Add Category','required','label'=>false)); ?>
                        </div>
                        </div>
</div>

        <div class="content mt-3">
                   <div class="row">
                    <div class="col-sm-1">
                     <a href="<?php echo SITE_URL ?>admin/examcategory" class="btn btn-primary " >Back</a>
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

 