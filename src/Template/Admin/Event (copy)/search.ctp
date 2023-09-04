<table id="bootstrap-data-table" class="table table-striped table-bordered ">
<thead>
<tr>
<th scope="col"><?= $this->Paginator->sort('S.no') ?></th>
<th scope="col"><?= $this->Paginator->sort('EO') ?></th>
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
<tbody>
<?php  $i=1; foreach ($event_search as $value):?>
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
<td><?= $value->no_of_seats ?></td>
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


<?= $this->Html->link(__('Edit'), ['action' => 'edit', $value->id,],array('class'=>'btn btn-success','style'=>'
    width: 72px;')) ?>

<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $value->id],array('class'=>'btn btn-danger'), 
['confirm' => __('Are you sure you want to delete # {0}?', $value->id)]) ?>
</td>
</tr>
<?php $i++; endforeach; ?>
<!--<tr>
<td class="actions">
</td>
</tr>-->
</tbody>
</table>