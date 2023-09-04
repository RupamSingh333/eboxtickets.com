<style type="text/css">
.card .card-footer {
	padding: 3.8rem 1.25rem !important;
	background-color: #fff;
	border-top: 1px solid #c2cfd6;
}
</style>
<?= $this->Html->script('admin/canvasjs.min.js') ?>


<script type="text/javascript">
window.onload = function () {

//monthlysales
  var chart = new CanvasJS.Chart("monthlyproject",
  {
  animationEnabled: true,
  height:250,
    zoomEnabled:false,
    colorSet: "blue",
    title:{
      text: "",
      fontColor: "#000",
                        fontSize: 14,
                        padding: 10,
                        fontWeight: "600",
      horizontalAlign: "left",
      fontFamily: "'Open Sans', sans-serif"
    },
    axisY: {
                        title:"",
      labelFontSize: 12,
      labelFontColor: "#000",
      valueFormatString:  "#,##,##0.##",
      labelFontFamily:"'Open Sans', sans-serif",
      maximum: 12000,
      gridThickness: 1,
      lineThickness: 1,
      tickThickness: 1,
      interval: 1000
    },
    axisX: {
                        title:"",
      
      labelFontSize: 12,
      labelFontFamily:"'Open Sans', sans-serif",
      lineThickness: 1,
      labelFontColor: "#000",
      
      interval:1,
    },
    data: [
    {
      type: "column",
      showInLegend: true, 
      legendText: "$<?php echo (round($total)); ?>",
      name: "Last Year",
      color: "#f9d520",
      dataPoints: <?php echo $collection; ?>     
    }
    
    ]
  });

  chart.render();


  
//
//monthlyearnings
var chart1 = new CanvasJS.Chart("monthlyproperty",
  {
    animationEnabled: true,
  height:250,
    zoomEnabled:false,
    colorSet: "blue",
    title:{
      text: "",
      fontColor: "#000",
                        fontSize: 14,
                        padding: 10,
                        fontWeight: "600",
      horizontalAlign: "left",
      fontFamily: "'Open Sans', sans-serif"
    },
    axisY: {
                        title:"",
      labelFontSize: 12,
      labelFontColor: "#000",
      valueFormatString:  "#,##,##0.##",
      labelFontFamily:"'Open Sans', sans-serif",
      maximum: 12000,
      gridThickness: 1,
      lineThickness: 1,
      tickThickness: 1,
      interval: 1000
    },
    axisX: {
                        title:"",
      
      labelFontSize: 12,
      labelFontFamily:"'Open Sans', sans-serif",
      lineThickness: 1,
      labelFontColor: "#000",
      
      interval:1,
    },
    data: [
    {
      type: "column",
      showInLegend: true, 
      legendText: "3,373,494",
      name: "Last Year",
      color: "#f9d520",
      dataPoints: [{"label":"January","y":187970},{"label":"February","y":176775},{"label":"March","y":304850},{"label":"April","y":235224},{"label":"May","y":387050},{"label":"June","y":370975},{"label":"July","y":280625},{"label":"August","y":378050},{"label":"September","y":239400},{"label":"October","y":180225},{"label":"November","y":378000},{"label":"December","y":254350}]     
    }
    
    ]
  });

  //chart1.render();

}
</script>
<!--<script type="text/javascript">
window.onload = function () { 

    CanvasJS.addColorSet("blue",
                [//colorSet Array
                "#2d95e3"              
                ]);
//all
  var chart = new CanvasJS.Chart("all",
  {
  
    animationEnabled: true,
      height:270,
      width:850,
    zoomEnabled:false,
    colorSet: "blue",
    title:{
      text: "Project:This Year",
      fontColor: "#000",
          fontSize: 14,
          padding: 10,
          fontWeight: "600",
      horizontalAlign: "left",
      fontFamily: "'Open Sans', sans-serif"
    },
    axisY: {title:"Price",
      labelFontSize: 12,
      labelFontColor: "#000",
      valueFormatString:  "#,##,##0.##",
      labelFontFamily:"'Open Sans', sans-serif",
      maximum: 10000,
      gridThickness: 1,
      lineThickness: 1,
      tickThickness: 1,
      interval: 1000
    },
    axisX: {title:"Duration",
      //valueFormatString: "MMM-YYYY",
      labelFontSize: 12,
      labelFontFamily:"'Open Sans', sans-serif",
      lineThickness: 1,
      labelFontColor: "#000",
      
      interval:1,
    },
    data: [
    {
      type: "column",
        dataPoints:<?php echo $totalcustomer_this_year; ?> ,
     
            }
    ]
  });
  chart.render();

}
</script>-->

<script inline="1">
          
//<![CDATA[
$(document).ready(function () {
  $("#Mysubscriptions").bind("change", function (event) {
    $.ajax({
      async:true,
      data:$("#Mysubscriptions").serialize(),
      dataType:"html", 
      type:"POST", 
     url:"<?php echo ADMIN_URL ;?>dashboards/search",
      success:function (data) {
    //  alert(data); 
        $("#examp").html(data); }, 
  });
    return false;
});});
//]]>
</script>
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
					<li class="active">Dashboard</li>
				</ol>
			</div>
		</div>
	</div>
</div>

<div class="content mt-3">

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
                                                <p class="text-light">Total Customers</p>

                        <h4 class="mb-0">
                        	<span class="count"><?php echo $totalcustomer; ?></span>
                        </h4>

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
                        <p class="text-light"> Event Organisers</p>

            			<h4 class="mb-0">
            				<span class="count"><?php echo $totalorganiser; ?></span>
            			</h4>

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
                        <p class="text-light">Total Events</p>

            			<h4 class="mb-0">
            				<span class="count"><?php echo $totalevent; ?></span>
            			</h4>

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
                            <p class="text-light">Total Earning</p>

                			<h4 class="mb-0">
                				KES <span class="count"><?php echo $Totalticketamount[0]['sum'];?></span>
                			</h4>

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
                                <div class="btn-toolbar float-right" role="toolbar" aria00-label="Toolbar with button groups">
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
                        	 <div id="monthlyproject" style="height: 270px; width: 100%;"></div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-xl-4">
            	<div class="card"style="height: 447px;">
            		<div class="card-footer">
            			<ul class="row" style="padding:35px;">
            				<li class="col-12" >
            					<div class="text-muted">This Week</div>
            					KES <strong><?php 
                  if(!empty($week_cash['0']['amount'])){
                    echo (round($week_cash['0']['amount']));
                  }else{
                    echo '0';
                  }
                ?> </strong>
            					<div class="progress progress-xs mt-2" style="height: 10px;">
            						<div class="progress-bar bg-success" role="progressbar" style="width: 40%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
            					</div>
            				</li>
            				<li class="col-12 hidden-sm-down" >
            					<div class="text-muted">This Month</div>
            				KES <strong><?php 
                  if(!empty($month1_cash['0']['amount'])){
                    echo (round($month1_cash['0']['amount']));
                  }else{
                    echo '0';
                  }
                ?> </strong>
            					<div class="progress progress-xs mt-2" style="height: 10px;">
            						<div class="progress-bar bg-info" role="progressbar" style="width: 20%;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
            					</div>
            				</li>
            				<li class="col-12" >
            					<div class="text-muted">Latest 3 Month</div>
            				KES <strong><?php 
                  if(!empty($month3_cash['0']['amount'])){
                    echo (round($month3_cash['0']['amount']));
                  }else{
                    echo '0';
                  }
                ?> </strong>
            					<div class="progress progress-xs mt-2" style="height: 10px;">
            						<div class="progress-bar bg-warning" role="progressbar" style="width: 60%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
            					</div>
            				</li>
            				<li class="col-12 hidden-sm-down " >
            					<div class="text-muted">Total Earning</div>
            					KES <strong><?php 
                  if(!empty($month12_cash['0']['amount'])){
                    echo (round($month12_cash['0']['amount']));
                  }else{
                    echo '0';
                  }
                ?> </strong>
            					<div class="progress progress-xs mt-2" style="height: 10px;">
            						<div class="progress-bar bg-danger" role="progressbar" style="width: 80%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
            					</div>
            				</li>
            			</ul>
            		</div>
            	</div>
            </div>
        </div>
<div class="content mt-3">
        	<div class="animated fadeIn">
        		<div class="row">

        			<?php echo $this->Flash->render(); ?>
        			<div class="col-md-12">
        				<div class="card">
        					<div class="card-header">
        						<strong class="card-title">Latest </strong><span> Events</span>
        					</div>
        					<div class="card-body">

        						
                        <table id="bootstrap-data-table" class="table table-striped table-bordered ">
                            <thead>
                                <tr>
                                    <th scope="col"><?= $this->Paginator->sort('S.no') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Event Organiser') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Event Name') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Event Date From') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Event Date To') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Venue') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Seats') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Price') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                <?php 




                 $i=1; foreach ($latestevent as $event)://pr($event);die;?>
                <tr>
                <td><?= $i ?></td>
                <td><?= $event->user->name ?></td>
                <td><?= $event->name ?></td>
                <td><?php if(isset($event['date_from'])){ echo strftime('%d-%b-%Y %H:%M:%S',strtotime($event['date_from']));}else{ echo 'N/A'; } ?></td>
                <td><?php if(isset($event['date_to'])){ echo strftime('%d-%b-%Y %H:%M:%S',strtotime($event['date_to']));}else{ echo 'N/A'; } ?></td>
                <td><?= $event->location ?></td>
                <td><?= $event->no_of_seats ?></td>
                <td><?= $event->amount ?></td>
               <td>

               <!-- <?php if($event->status=="Y"){  ?>

                <?=  $this->Html->link(__('Active'), ['action' => 'status', $event->id,'N'],array('class'=>'badge badge-success')) ?>
                <?php  }else {?>
                <?=  $this->Html->link(__('Inactive'), ['action' => 'status', $event->id,'Y'],array('class'=>'badge badge-warning')) ?>
                <?php } ?>

                </td>

                <td class="actions">
                 <?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?> 

                <?= $this->Html->link(__('Edit'), ['action' => 'add', $user->id,],array('class'=>'btn btn-success')) ?>

                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id],array('class'=>'btn btn-danger'), 
                ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
                </td>-->
                </tr>
                <?php $i++; endforeach; ?>
            </tbody>
        </table>
		<div class="paginator">
			<div class="row">
				<div class="col-sm-8">              	

				</div>
				<div class="col-sm-4">
					<a href="<?php echo SITE_URL;?>admin/event" class="btn btn-success btn-sm pull-right">View All</a>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
</div>
</div><!-- Content mt -3-->


<div class="content mt-3">
        	<div class="animated fadeIn">
        		<div class="row">

        			<?php echo $this->Flash->render(); ?>
        			<div class="col-md-12">
        				<div class="card">
        					<div class="card-header">
        						<strong class="card-title">Latest </strong><span> Sold Tickets</span>
        					</div>
        					<div class="card-body">


                        <table id="bootstrap-data-table" class="table table-striped table-bordered ">
                            <thead>
                                <tr>
                                    <th scope="col"><?= $this->Paginator->sort('S.no') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Event Title') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Event Date') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Time') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Customer Name') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Mobile') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Buy Ticket') ?></th>

                                </tr>
                            </thead>
                            <tbody>
                <?php $i=1; foreach ($latestticket_book as $ticketbook)://pr($ticketbook);die;?>
                <tr>
                <td><?= $i ?></td>
                <td><?= $ticketbook->event->name ?></td>
                <td><?php if(isset($ticketbook['event']['date_from'])){ echo strftime('%d-%b-%Y',strtotime($ticketbook['event']['date_from']));}else{ echo 'N/A'; } ?></td>
               <td><?php if(isset($ticketbook['event']['date_from'])){ echo strftime('%H:%M:%S',strtotime($ticketbook['event']['date_from']));}else{ echo 'N/A'; } ?></td>
                <td><?= $ticketbook->user->name ?></td>
                <td><?= $ticketbook->user->mobile ?></td>
                <td><?= $ticketbook->ticket_buy ?></td>
                
               <!-- <td> <img src="<?php echo SITE_URL; ?>images/<?php echo $user['cimage']; ?>" height="30px" width="30px" alt="image"></td>
                <td>

                <?php if($user->status=="Y"){  ?>

                <?=  $this->Html->link(__('Active'), ['action' => 'status', $user->id,'N'],array('class'=>'badge badge-success')) ?>
                <?php  }else {?>
                <?=  $this->Html->link(__('Inactive'), ['action' => 'status', $user->id,'Y'],array('class'=>'badge badge-warning')) ?>
                <?php } ?>

                </td>

                <td class="actions">
                  <?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?> 


                <?= $this->Html->link(__('Edit'), ['action' => 'add', $user->id,],array('class'=>'btn btn-success')) ?>

                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id],array('class'=>'btn btn-danger'), 
                ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
                </td>-->
                </tr>
                <?php $i++; endforeach; ?>
                
            </tbody>
        </table>
		<div class="paginator">
			<div class="row">
				<div class="col-sm-8">              	

				</div>
				<div class="col-sm-4">
					<a href="<?php echo SITE_URL;?>admin/ticket" class="btn btn-success btn-sm pull-right">View All</a>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
</div>
</div><!-- Content mt -3-->


<div class="content mt-3">
        	<div class="animated fadeIn">
        		<div class="row">

        			<?php echo $this->Flash->render(); ?>
        			<div class="col-md-12">
        				<div class="card">
        					<div class="card-header">
        						<strong class="card-title">Latest </strong><span> Event Organiser</span>
        					</div>
        					<div class="card-body">

        						
                        <table id="bootstrap-data-table" class="table table-striped table-bordered ">
                            <thead>
                                <tr>
                                    <th scope="col"><?= $this->Paginator->sort('S.no') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Name') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Email') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Mobile') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                <?php $i=1; foreach ($latestevent_organiser as $organiser): //pr($organiser);die?>
                <tr>
                <td><?= $i ?></td>
                <td><?= $organiser->name ?></td>
                <td><?= $organiser->email ?></td>
                <td><?= $organiser->mobile ?></td>
                <td>

                <?php /*if($user->status=="Y"){  ?>

                <?=  $this->Html->link(__('Active'), ['action' => 'status', $user->id,'N'],array('class'=>'badge badge-success')) ?>
                <?php  }else {?>
                <?=  $this->Html->link(__('Inactive'), ['action' => 'status', $user->id,'Y'],array('class'=>'badge badge-warning')) ?>
                <?php } ?>

                </td>

                <td class="actions">
                <!--  <?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?> -->


                <?= $this->Html->link(__('Edit'), ['action' => 'add', $user->id,],array('class'=>'btn btn-success')) ?>

                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id],array('class'=>'btn btn-danger'), 
                ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) */?>
                </td>
                </tr>
                <?php $i++; endforeach; ?>
                
            </tbody>
        </table>
		<div class="paginator">
			<div class="row">
				<div class="col-sm-8">              	

				</div>
				<div class="col-sm-4">
					<a href="<?php echo SITE_URL;?>admin/eventorganiser" class="btn btn-success btn-sm pull-right">View All</a>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
</div>
</div><!-- Content mt -3-->

        </div> <!-- .content -->
    </div><!-- /#right-panel -->
