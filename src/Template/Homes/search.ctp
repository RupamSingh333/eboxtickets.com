 <table class="table">
    <thead>
      <tr>
        <th>S. No</th>
        <th>Name</th>
        <th>Date and Time</th>
        <th>Venue</th>
        <th>Share Ticket</th>
        <th>Social Sharing</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php $i=1; foreach($event_search as $key=>$value){//pr($value);?>
      <tr>  
        <td><?php echo $i; ?></td>
        <td><?php echo $value['event']['name']; ?></td>
        <td>From <?php echo date('d M Y h:i A',strtotime($value['event']['date_from'])); ?><br>
            To <?php echo date('d M Y h:i A',strtotime($value['event']['date_to'])); ?>
        </td>
        <td><?php echo $value['location'];?></td>
        <td><a href="#" class="nocolor" data-toggle="modal" data-target="#myModal"><img src="<?php echo SITE_URL; ?>images/ticket_share_icon.png" alt="icon"></a> </td>
        <td class="show_share_icons"><i class="fas fa-share-alt"></i>
        <ul class="social_show">
        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
        <i class="fas fa-caret-down"></i>
        </ul>
        </td>
        <td><a href="#" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Generate Ticket</a></td>
      </tr>
      <?php $i++; } ?>
    </tbody>
  </table>