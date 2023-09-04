

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




