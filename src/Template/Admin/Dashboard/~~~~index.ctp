

<style type="text/css">
    .card .card-footer {
    padding: 3.8rem 1.25rem !important;
    background-color: #fff;
    border-top: 1px solid #c2cfd6;
   
   }

</style>

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active"></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


<div class="content mt-3" style="
    min-height: 100px;
">
<?php echo $this->Flash->render(); ?>
<?php $role_id=$this->request->session()->read('Auth.User.role_id'); 
 if($role_id=='1') {
    ?>
            <!--<div class="col-sm-12">
                <div class="alert  alert-success alert-dismissible fade show" role="alert">
                  <span class="badge badge-pill badge-success">Success</span> You successfully read this important alert message.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>-->


           <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-1">
                    <div class="card-body pb-0">
                      <!--  <div class="dropdown float-right">
                            <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton" data-toggle="dropdown">
                                <i class="fa fa-cog"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <div class="dropdown-menu-content">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>-->
                        <h4 class="mb-0">
                            <span class="count"><?php echo $totalstudent;?></span>
                        </h4>
                        <p class="text-light">Visitor</p>

                     <!--   <div class="chart-wrapper px-0" style="height:70px;" height="70">
                            <canvas id="widgetChart1"></canvas>
                        </div>-->

                    </div>

                </div>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-2">
                    <div class="card-body pb-0">
                        
                        <h4 class="mb-0">
                            <span class="count"><?php echo $totaltestcenter;?></span>
                        </h4>
                        <p class="text-light">Total Center</p>

                    <!--    <div class="chart-wrapper px-0" style="height:70px;" height="70">
                            <canvas id="widgetChart2"></canvas>
                        </div>-->

                    </div>
                </div>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-3">
                    <div class="card-body pb-0">
                        
                        <h4 class="mb-0">
                            <!--<span class="count"><?php echo $totaltest;?></span>-->
                            <span class="count"><?php echo $totaltest;?></span>
                        </h4>
                        <p class="text-light">Total Test</p>

                    </div>

                     <!--   <div class="chart-wrapper px-0" style="height:70px;" height="70">
                            <canvas id="widgetChart3"></canvas>
                        </div>-->
                </div>
            </div>
            <!--/.col-->

         <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-4">
                    <div class="card-body pb-0">
                         <span>KES </span></span><span class="count">500</span>
                            
                        </h4>
                        <p class="text-light">Total Fee</p>

                      <!--  <div class="chart-wrapper px-3" style="height:70px;" height="70">
                            <canvas id="widgetChart4"></canvas>
                        </div>-->

                    </div>
                </div>
            </div>
            <!--/.col-->

 <div class="row-eq-height">
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                           <div class="col-sm-4">
                                <h4 class="card-title mb-0">Revenue Generated</h4>
                                <div class="small text-muted">July 2018</div>
                            </div>
                            <!--
                            <div class="col-sm-8 hidden-sm-down">
                                <button type="button" class="btn btn-primary float-right bg-flat-color-1"><i class="fa fa-cloud-download"></i></button>
                                <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                                    <div class="btn-group mr-3" data-toggle="buttons" aria-label="First group">
                                        <label class="btn btn-outline-secondary">
                                            <input type="radio" name="options" id="option1"> Day
                                        </label>
                                        <label class="btn btn-outline-secondary active">
                                            <input type="radio" name="options" id="option2" checked=""> Month
                                        </label>
                                        <label class="btn btn-outline-secondary">
                                            <input type="radio" name="options" id="option3"> Year
                                        </label>
                                    </div>
                                </div>
                            </div>col-->


                        </div><!--/.row-->
                     <div class="chart-wrapper mt-4" >
                            <canvas id="trafficChart" style="height:200px;" height="200"></canvas>
                        </div>

                    </div>
                </div>
            </div>
  <div class="col-xl-4">
                <div class="card">
                    <div class="card-footer">
                        <ul class="row">
                            <li class="col-12" >
                                <div class="text-muted">This Week</div>
                                <strong>0 KES</strong>
                                <div class="progress progress-xs mt-2" style="height: 10px;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 10%;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </li>
                            <li class="col-12 hidden-sm-down" >
                                <div class="text-muted">This Month</div>
                                <strong>0  KES</strong>
                                <div class="progress progress-xs mt-2" style="height: 10px;">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 10%;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </li>
                            <li class="col-12" >
                                <div class="text-muted">Latest 3 Month</div>
                                <strong>0  KES</strong>
                                <div class="progress progress-xs mt-2" style="height: 10px;">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 10%;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </li>
                            <li class="col-12 hidden-sm-down " >
                                <div class="text-muted">Total Earning</div>
                                <strong>0  KES</strong>
                                <div class="progress progress-xs mt-2" style="height: 10px;">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 10%;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div> 
</div>






 <?php }else if($role_id=='2') { ?>
        <div class="content mt-3" style="
    min-height: 100px;
">

            <!--<div class="col-sm-12">
                <div class="alert  alert-success alert-dismissible fade show" role="alert">
                  <span class="badge badge-pill badge-success">Success</span> You successfully read this important alert message.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>-->


           <div class="col-sm-6 col-lg-4">
                <div class="card text-white bg-flat-color-1">
                    <div class="card-body pb-0">
                      <!--  <div class="dropdown float-right">
                            <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton" data-toggle="dropdown">
                                <i class="fa fa-cog"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <div class="dropdown-menu-content">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>-->
                        <h4 class="mb-0">
                            <span class="count"><?php echo $totaltestcenter;?></span>
                        </h4>
                        <p class="text-light">Total Test</p>

                     <!--   <div class="chart-wrapper px-0" style="height:70px;" height="70">
                            <canvas id="widgetChart1"></canvas>
                        </div>-->

                    </div>

                </div>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-4">
                <div class="card text-white bg-flat-color-2">
                    <div class="card-body pb-0">
                        
                        <h4 class="mb-0">
                            <span class="count"><?php echo $totalstudent;?></span>
                        </h4>
                        <p class="text-light">Total Students</p>

                    <!--    <div class="chart-wrapper px-0" style="height:70px;" height="70">
                            <canvas id="widgetChart2"></canvas>
                        </div>-->

                    </div>
                </div>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-4">
                <div class="card text-white bg-flat-color-3">
                    <div class="card-body pb-0">
                        
                        <h4 class="mb-0">
                            <!--<span class="count">500 KES<?php echo $totaltest;?></span>--> 
                           <span>KES </span><span class="count">500</span>
                        </h4>
                        <p class="text-light">Total Fee</p>

                    </div>

                     <!--   <div class="chart-wrapper px-0" style="height:70px;" height="70">
                            <canvas id="widgetChart3"></canvas>
                        </div>-->
                </div>
            </div>
            <!--/.col-->

           <!-- <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-4">
                    <div class="card-body pb-0">
                        
                        <h4 class="mb-0">
                            <span class="count">0</span>
                        </h4>
                        <p class="text-light">Total Amount</p>

                      <!--  <div class="chart-wrapper px-3" style="height:70px;" height="70">
                            <canvas id="widgetChart4"></canvas>
                        </div>

                    </div>
                </div>
            </div>
            <!--/.col-->

<!--<div class="row-eq-height">
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body">
                        <!--<div class="row">
                            <!--<div class="col-sm-4">
                                <h4 class="card-title mb-0">Revenue Generated</h4>
                                <div class="small text-muted">July 2018</div>
                            </div>
                            <!--
                            <div class="col-sm-8 hidden-sm-down">
                                <button type="button" class="btn btn-primary float-right bg-flat-color-1"><i class="fa fa-cloud-download"></i></button>
                                <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                                    <div class="btn-group mr-3" data-toggle="buttons" aria-label="First group">
                                        <label class="btn btn-outline-secondary">
                                            <input type="radio" name="options" id="option1"> Day
                                        </label>
                                        <label class="btn btn-outline-secondary active">
                                            <input type="radio" name="options" id="option2" checked=""> Month
                                        </label>
                                        <label class="btn btn-outline-secondary">
                                            <input type="radio" name="options" id="option3"> Year
                                        </label>
                                    </div>
                                </div>
                            </div>col


                        </div><!--/.row-->
                       <!-- <div class="chart-wrapper mt-4" >
                            <canvas id="trafficChart" style="height:200px;" height="200"></canvas>
                        </div>

                    </div>
                </div>
            </div>-->
 <!--<div class="col-xl-4">
                <div class="card">
                    <div class="card-footer">
                        <ul class="row">
                            <li class="col-12" >
                                <div class="text-muted">This Week</div>
                                <strong>0 USD</strong>
                                <div class="progress progress-xs mt-2" style="height: 10px;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 10%;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </li>
                            <li class="col-12 hidden-sm-down" >
                                <div class="text-muted">This Month</div>
                                <strong>0  USD</strong>
                                <div class="progress progress-xs mt-2" style="height: 10px;">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 10%;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </li>
                            <li class="col-12" >
                                <div class="text-muted">Latest 3 Month</div>
                                <strong>0  USD</strong>
                                <div class="progress progress-xs mt-2" style="height: 10px;">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 10%;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </li>
                            <li class="col-12 hidden-sm-down " >
                                <div class="text-muted">Total Earning</div>
                                <strong>0  USD</strong>
                                <div class="progress progress-xs mt-2" style="height: 10px;">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 10%;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>-->
</div>
<?php } ?>

<!------------------------------------------------>



<div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
 
<?php echo $this->Flash->render(); ?>
<?php $role_id=$this->request->session()->read('Auth.User.role_id'); 
        if($role_id=='1') {
        ?> 
      <div class="col-md-12">
          <div class="card">
              <div class="card-header">
                    <strong class="card-title">Latest </strong><span> Test Center</span>
                        </div>
                        <div class="card-body">

<table id="bootstrap-data-table" class="table table-striped table-bordered ">
<thead>
                <tr>
                <th scope="col"><?= $this->Paginator->sort('S.no') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Test Center') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Email Id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Mobile') ?></th>
                <!--<th scope="col"><?= $this->Paginator->sort('Status') ?></th>
               <th scope="col" class="actions" ><?= __('Actions') ?></th>-->
                </tr>
</thead>
                <tbody>
                <?php   $i=1; foreach ($testcenters as $user)://pr($user);die;?>
                <tr>
                <td><?= $i ?></td>
                <td><?= $user->name ?></td>
                <td><?= $user->email ?></td>
                <td><?= $user->mobile ?></td>
                

                <!--Status-->
               <!-- <td>
                <?php if($user->status=="Y"){  ?>

                <?=  $this->Html->link(__('Active'),array('class'=>'badge badge-success')) ?>
                <?php  }else {?>
                <?=  $this->Html->link(__('Inactive'),array('class'=>'badge badge-warning')) ?>
                <?php } ?>
                </td>-->

                <!--<td class="actions">
                 <?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?>


                <?= $this->Html->link(__('Edit'), ['controller'=>'testcenters','action' => 'edit', $user->id,],array('class'=>'btn btn-success')) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller'=>'testcenters','action' => 'delete', $user->id],array('class'=>'btn btn-danger'), 
                ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
                </td>-->
                </tr>
                <?php $i++; endforeach;  ?>
                </tbody>
                  </table>
 <div class="paginator">
    <div class="row">
    <div class="col-sm-8">                  
   
    </div>
    <div class="col-sm-4">
        <a href="<?php echo SITE_URL;?>admin/testcenters" class="btn btn-success btn-sm pull-right">View All Test Center</a>
    </div>
</div>
</div>
 </div>
        </div>
   </div>
   <?php }else if($role_id=='2') { ?>


   <div class="col-md-12">
          <div class="card">
              <div class="card-header">
                    <strong class="card-title">Latest </strong><span> Students</span>
                        </div>
                        <div class="card-body">

<table id="bootstrap-data-table" class="table table-striped table-bordered ">
<thead>
                <tr>
                <th scope="col"><?= $this->Paginator->sort('S.no') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Mobile') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Test Name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Test Category') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('M-Pesa Id') ?></th>
               <!--  <th scope="col" class="actions" ><?= __('Actions') ?></th>-->
                </tr>
</thead>
                <tbody>
                <?php   $i=1; foreach ($student as $user):  //pr($user);die;?>
        

<?php $student=$this->Comman->studentdetail($user->sid); 

$category=$this->Comman->getcategory($user->test->t_category);?>
<td><?= $i ?></td>

<td><?=  $student->name; ?></td> 
<td><?=  $student->phone; ?></td> 
<td><?=  $student->email; ?></td> 
<td><?=  $user->test->testname; ?></td> 
<td><?=  $category->name; ?></td> 
<td><?=  date('Y-m-d',strtotime($user->date)); ?></td> 
<td><?=   $user->mpasaid; ?></td> 




                

                <!--Status-->
                 <!--<td>
                <?php if($user->status=="Y"){  ?>

                <?=  $this->Html->link(__('Active'),array('class'=>'badge badge-success')) ?>
                <?php  }else {?>
                <?=  $this->Html->link(__('Inactive'),array('class'=>'badge badge-warning')) ?>
                <?php } ?>
                </td>

                <!--<td class="actions">
                 <?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?>


                <?= $this->Html->link(__('Edit'), ['controller'=>'testcenters','action' => 'edit', $user->id,],array('class'=>'btn btn-success')) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller'=>'testcenters','action' => 'delete', $user->id],array('class'=>'btn btn-danger'), 
                ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
                </td>-->
                </tr>
                <?php $i++; endforeach;  ?>
                </tbody>
                  </table>
 <div class="paginator">
    <div class="row">
    <div class="col-sm-8">                  
   
    </div>
    <div class="col-sm-4">
        <a href="<?php echo SITE_URL;?>admin/student" class="btn btn-success btn-sm pull-right">View All Students</a>
    </div>
</div>
</div>
 </div>
        </div>
   </div>


<div class="col-md-12">
<div class="card">
<div class="card-header">
 <strong class="card-title">Latest </strong><span> Test</span>
</div>



<div class="card-body">

<table id="bootstrap-data-table" class="table table-striped table-bordered ">
<thead>

<tr>
<th scope="col"><?= $this->Paginator->sort('S.no') ?></th>
<th scope="col"><?= $this->Paginator->sort('Category') ?></th>
<th scope="col"><?= $this->Paginator->sort('Test') ?></th>
<th scope="col"><?= $this->Paginator->sort('Date') ?></th>
<th scope="col"><?= $this->Paginator->sort('Time') ?></th>
<th scope="col"><?= $this->Paginator->sort('Duration') ?></th>
<th scope="col"><?= $this->Paginator->sort('Capacity') ?></th>
<th scope="col"><?= $this->Paginator->sort('Question') ?></th>

</tr>
</thead>
<tbody>
<?php  $i=1; foreach ($test as $user): //pr($user);?>
<tr>
<td><?= $i ?></td>
<td><?= $user->examcategory->name ?></td> 
<td><?= $user->testname ?></td> 
<td><?=  date('Y-m-d',strtotime($user->start_date)); ?></td>
<td><?=  date('h:i A',strtotime($user->start_time)); ?></td>
<td><?= $user->duration ?></td>
<td><?= $user->capacity ?></td>
<td><?php $d= $user['q_harder'] + $user['q_hard'] + $user['q_easy'];

echo $d;
?></td>





</tr>
<?php $i++; endforeach;  ?>


</tbody>
</table>
<div class="paginator">
    <div class="row">
    <div class="col-sm-8">                  
   
    </div>
    <div class="col-sm-4">
        <a href="<?php echo SITE_URL;?>admin/test" class="btn btn-success btn-sm pull-right">View All Test</a>
    </div>
</div>
</div>
</div>
</div>
</div>

    


        <?php } ?>
</div>
</div>
</div><!-- Content mt -3-->




            <!--<div class="col-lg-3 col-md-6">
                <div class="social-box facebook">
                    <i class="fa fa-facebook"></i>
                    <ul>
                        <li>
                            <strong><span class="count">40</span> k</strong>
                            <span>friends</span>
                        </li>
                        <li>
                            <strong><span class="count">450</span></strong>
                            <span>feeds</span>
                        </li>
                    </ul>
                </div>
         
            </div>-->






        </div> <!-- .content -->
    </div><!-- /#right-panel -->


