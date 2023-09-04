
<style>
.anchr{margin-top: 30px; margin-bottom: 0px;}
.anchrr{margin-top: 8px; margin-bottom: 0px;}
</style>
<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">

                    
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                           <li><a href="<?php echo SITE_URL; ?>admin/dashboard ">Dashboard</a></li>
                            <li> Report Manager</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

       <!-- <?php //echo $this->Paginator->limitControl([10 => 10, 15 => 15,20=>20,25=>25,30=>30]);?> -->

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
 
<?php echo $this->Flash->render(); ?>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Fee Report</strong>
  <!--  <a href="<?php echo SITE_URL; ?>admin/newexam/add"><strong class=" btn btn-info card-title pull-right">Add</strong></a> -->
<a href=""><strong class=" btn btn-info card-title pull-right"> <i class="fa fa-file-excel-o"> Export CSV</i></strong></a>
</div>

 <div >
                        <div class="col-sm-2">
                        <div class="form-group">
                            <label for="company" class=" form-control-label">From</label>
                        <div class="bfh-datepicker" data-format="y-m-d" data-date="">
                        <div class="input-prepend bfh-datepicker-toggle" data-toggle="bfh-datepicker">
                        <span class="add-on"><i class="icon-calendar"></i></span>
                    <?php echo $this->Form->input('number', array('class' => 'longinput form-control input-medium','placeholder'=>'','required','label'=>false, 'readonly')); ?>
                        </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="company" class=" form-control-label">To</label>
                        <div class="bfh-datepicker" data-format="y-m-d" data-date="">
                        <div class="input-prepend bfh-datepicker-toggle" data-toggle="bfh-datepicker">
                        <span class="add-on"><i class="icon-calendar"></i></span>
                    <?php echo $this->Form->input('number', array('class' => 'longinput form-control input-medium','placeholder'=>'','required','label'=>false, 'readonly')); ?>
                        </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-sm-2 anchrr">
                        <div class="form-group">
                            <label></label>
                    <?php echo $this->Form->input('exam', array('class' => 'longinput form-control input-medium','placeholder'=>'Student Name','type'=>'search','label'=>false, )); ?>
                        </div>
                       
                    </div>
                    <div class="col-sm-2 anchrr">
                        <div class="form-group">
                            <label></label>
                    <?php echo $this->Form->input('exam', array('class' => 'longinput form-control input-medium','placeholder'=>'Test Center','type'=>'search','label'=>false, )); ?>
                        </div>
                       
                    </div>

                     <div class="col-sm-2 anchrr">
                        <div class="form-group">
                            <label></label>
                    <?php echo $this->Form->input('exam', array('class' => 'longinput form-control input-medium','placeholder'=>'Test Name','type'=>'search','label'=>false, )); ?>
                        </div>
                       
                    </div>
                   
                   
                    <div class="col-sm-1 anchr">
                        <div class="form-group">
                            
                          <a href="#" class=" btn btn-info card-title  ">Search</a>
                        </div>
                    </div>
                  
                    </div>


                        <div class="card-body">

<table id="bootstrap-data-table" class="table table-striped table-bordered ">
<thead>  
                <tr>
                <th scope="col"><?= $this->Paginator->sort('S.no') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Purchese Date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Test Name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Test Center') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Paid Amount') ?></th>
              <!--  <th scope="col" class="actions"><?= __('Actions') ?></th>-->
                </tr>
</thead>
                <tbody>
                <?php /* $i=1; foreach ($users as $user):?>
                <tr>
                <td><?= $i ?></td>
                <td><?= $user->name ?></td>
                <td><?= $user->course->name ?></td>
                <td><?= $user->duration ?></td>
                
                <td> <img src="<?php echo SITE_URL; ?>images/<?php echo $user['cimage']; ?>" height="30px" width="30px" alt="image"></td>
                <td>

                <?php if($user->status=="Y"){  ?>

                <?=  $this->Html->link(__('Active'), ['action' => 'status', $user->id,'N'],array('class'=>'badge badge-success')) ?>
                <?php  }else {?>
                <?=  $this->Html->link(__('Inactive'), ['action' => 'status', $user->id,'Y'],array('class'=>'badge badge-warning')) ?>
                <?php } ?>

                </td>

                <td class="actions">
                <!--  <?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?> -->


                <?= $this->Html->link(__('Edit'), ['action' => 'add', $user->id,],array('class'=>'btn btn-success')) ?>

                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id],array('class'=>'btn btn-danger'), 
                ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
                </td>
                </tr>
                <?php $i++; endforeach; */ ?>
                      
                <tr>
                <td>1</td>
                <td>02/08/2018</td>
                <td>Aditya</td>
                <td>Driving Test</td>
                <td>Driving Center</td>
                <td>$50</td>
              <?php  /*
                <td class="actions">
                <!--  <?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?> -->


                <!--<?= $this->Html->link(__('Edit'), ['action' => 'add', $user->id,],array('class'=>'btn btn-success btn-sm ')) ?>-->

                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id],array('class'=>'btn btn-danger btn-sm'), 
                ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
                </td> */ ?>
            </tr>
              </tbody>
<!--<thead>  
                <tr>
                <th scope="col" colspan="3">Total</th>
                <th scope="col"colspan="1" >$ 20</th>
              
                </tr>
</thead>-->
                  </table>
                  <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('First')) ?>
            <?= $this->Paginator->prev('< ' . __('Previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('Next') . ' >') ?>
            <?= $this->Paginator->last(__('Last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


