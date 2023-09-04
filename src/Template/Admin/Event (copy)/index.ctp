<?php //pr($event);die;?>
<style>
.btn-default{
background-color: #4075fb;
color: #fff;
.card-title{ padding-right:5px}
}
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
<li>Event Manager</li>
</ol>
</div>
</div>
</div>
</div>
<!-- <?php //echo $this->Paginator->limitControl([10 => 10, 15 => 15,20=>20,25=>25,30=>30]);?> -->
<div class="content mt-3">
<div class="animated fadeIn">
<div class="row">

<?php

//pr($this->Flash);
 echo $this->Flash->render(); ?>
<div class="col-md-12">
<div class="card">
<div class="card-header">
<strong class="card-title">Event Manager</strong>
<a href="<?php echo SITE_URL; ?>admin/event/add" ><strong class=" btn btn-info card-title pull-right">Add</strong></a> 
                </div>
<div class="row" style="padding: 10px;">
  <script>          
                $(document).ready(function () {

                  $("#Mysubscriptionevent").bind("submit", function (event) {

                    $.ajax({
                      async:true,
                      data:$("#Mysubscriptionevent").serialize(),
                      dataType:"html", 
                      type:"POST", 
                     url:"<?php echo ADMIN_URL ;?>event/search",
                      success:function (data) {
                    //alert(data); 
                        $("#exampleevent").html(data); }, 
                  });
                    return false;
                });});
                //]]>
                </script> 
<div class="col-sm-3">
  <?php echo $this->Form->create('Mysubscription',array('type'=>'file','inputDefaults'=>array('div'=>false,'label'=>false),'id'=>'Mysubscriptionevent','class'=>'form-horizontal')); ?>
<div class="form-group">
<label for="company" class=" form-control-label">From</label>
<?php echo $this->Form->input('date_from', array('class' => 'longinput form-control input-medium datetimepicker1','placeholder'=>'Date From','type'=>'text','label' =>false,'autocomplete'=>'off')); ?>
</div>
</div>
<div class="col-sm-3">
<div class="form-group">
<label for="company" class=" form-control-label">To</label>
<?php echo $this->Form->input('date_to', array('class' => 'longinput form-control input-medium datetimepicker1','placeholder'=>'Date From','type'=>'text','label' =>false,'autocomplete'=>'off')); ?>
</div>
</div>
<div class="col-sm-3">
<div class="form-group">
<label>Event Name</label>
<?php
echo $this->Form->input('eventname', array('class' => 'longinput form-control input-medium ','placeholder'=>'Event Name' ,'type'=>'text','label'=>false,'autocomplete'=>'off')); ?>
</div>
</div>
<div class="col-sm-1" style="padding-top: 25px;">
<?php if(isset($ticket['id'])){
echo $this->Form->submit('Update', array('title' => 'Update','div'=>false,
'class'=>array('btn btn-primary btn-sm'))); }else{  ?>
<button type="submit" class="btn btn-success" id="Mysubscriptionevent">Search</button>
<?php  } ?>
</div>
 <?php echo $this->Form->end();?>  

    <a href="<?php echo SITE_URL; ?>admin/event/export"style="padding-top: 25px;"><strong class=" btn btn-info card-title pull-right"  style="margin-right: 10px;">Export CSV</strong></a> 
</div>
<div id="exampleevent" class="card-body">
<table id="bootstrap-data-table" class="table table-striped table-bordered ">
<thead>
<tr>
<th scope="col"><?= $this->Paginator->sort('SNo') ?></th>
<th scope="col"><?= $this->Paginator->sort('Event Organiser') ?></th>
<th scope="col"><?= $this->Paginator->sort('Event') ?></th>
<th scope="col"><?= $this->Paginator->sort('Date From') ?></th>
<th scope="col"><?= $this->Paginator->sort('Date To') ?></th>
<th scope="col"><?= $this->Paginator->sort('Venue') ?></th>
<th scope="col"><?= $this->Paginator->sort('Image') ?></th>
<th scope="col"><?= $this->Paginator->sort('Video') ?></th>
<th scope="col"><?= $this->Paginator->sort('Total seats') ?></th>
<th scope="col"><?= $this->Paginator->sort('Remaining seats') ?></th>
<th scope="col"><?= $this->Paginator->sort('Price') ?></th>
<!--<th scope="col"><?= $this->Paginator->sort('Status') ?></th>-->
<th scope="col" class="actions"><?= __('Actions') ?></th>
</tr>
</thead>
<tbody id="mypage">
<?php  $i=1; foreach ($event as $value):?>
<tr>
<td><?= $i ?></td>
<td><?= $value->user->name ?></td>
<td><?= $value->name ?></td>
<td><?php if(isset($value['date_from'])){ echo strftime('%d-%b-%Y %H:%M:%S',strtotime($value['date_from']));}else{ echo 'N/A'; } ?></td>
<td><?php if(isset($value['date_to'])){ echo strftime('%d-%b-%Y %H:%M:%S',strtotime($value['date_to']));}else{ echo 'N/A'; } ?></td>
<td><?= $value->location ?></td>
<td><img src="<?php echo SITE_URL;?>imagess/<?php echo $value['feat_image'];?>" height="75px" width="150px" style="display:block;"></td>
<td>
	<a data-toggle="modal" class="addlangcat btn btn-danger" style="background-color: #21b354;padding: 1px 5px;border-color: #21b354;" href="<?php echo ADMIN_URL?>event/event_info/<?php echo $value['id']; ?>"><?php $link = $value['video_url'];
$video_id = explode("?v=", $link); // For videos like http://www.youtube.com/watch?v=...
if (empty($video_id[1]))
$video_id = explode("/v/", $link); // For videos like http://www.youtube.com/watch/v/..
$video_id = explode("&", $video_id[1]); // Deleting any other params
$video_id = $video_id[0];
$thumbURL = 'http://img.youtube.com/vi/'.$video_id.'/0.jpg';
echo '<img src="'.$thumbURL.'" height="75px" width="150px"/>';
//$url = '//www.youtube.com/embed/'.explode('=', $value['video_url'])[1];
// echo "<iframe width='100%' height='50%' src='$url' frameborder='0' allowfullscreen></iframe>";?></a>
</td>
<td><?= $value->no_of_seats ?></td>

<?php $data=$this->Comman->totalseatbook($value['id']); 
$ticketsoldout=0;
$ticketsoldout=$data['0']['ticketsold'];
 $totalseat=$value['no_of_seats'];
  //pr($totalseat);die;
//$ticketsoldout=0;
$ticketremaining=$totalseat-$ticketsoldout;
 //pr($ticketremaining);die;
?>
<td><?= $ticketremaining ?></td>


<td><?= $value->amount ?></td>
<!--<td><?= $value->amount ?></td>
<?php if($value->status=="Y"){  ?>
<?=  $this->Html->link(__('Active'), ['action' => 'status', $value->id,'N'],array('class'=>'badge badge-success')) ?>
<?php  }else {?>
<?=  $this->Html->link(__('Inactive'), ['action' => 'status', $value->id,'Y'],array('class'=>'badge badge-warning')) ?>
<?php } ?>

</td>-->
<td class="actions">
 <!--<?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?> -->
<?php echo $this->Html->link(__(''), ['action' => 'edit', $value->id,],array('class'=>'fa fa-pencil','style'=>'font-size:24px;')) ?>
<?php  ?>
<?= $this->Form->postLink(__(''), ['action' => 'status', $value->id,'Y'],array('class'=>'fa fa-trash','style'=>'font-size:24px;color:red'), 
['confirm' => __('Are you sure you want to delete # {0}?', $value->id)]) ?>

<?php  ?>
</td>
</tr>
<?php $i++; endforeach; ?>
<!--<tr>
<td class="actions">
</td>
</tr>-->
</tbody>
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
<div class="modal" id="langcatmodal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>
<!-- /.modal -->
<script>
 $('.addlangcat').click(function(e){ 
  e.preventDefault();
  $('#langcatmodal').modal('show').find('.modal-body').load($(this).attr('href'));
});
</script>

<script>
 $('.infolangcat').click(function(e){ 
  e.preventDefault();
  $('#langcatinfo').modal('show').find('.modal-body').load($(this).attr('href'));
});
</script>
  <script type="text/javascript"> 
        $(function() { 
     var start = new Date();
// set end date to max one year period:
var end = new Date(new Date().setYear(start.getFullYear()+1));   
    $('.datetimepicker1').datetimepicker({
       pickTime: false,
    }).on('changeDate', function(){
     $(this).datetimepicker('hide');
});
    $('.datetimepicker2').datetimepicker({
      
       
    }).on('changeDate', function(){
 
     $(this).datetimepicker('hide');
});
      }); 
  </script>
<script type="text/javascript">
var site_url='<?php echo SITE_URL ?>';
  function checkfornotification(){
  $.ajax({
  type: "post",
  url: site_url+'admin/event/refine',
  success:function(data){ 
  $('#mypage').html(data);
  }
  });
    }


    setInterval(function(){ checkfornotification(); }, 2000);
</script>