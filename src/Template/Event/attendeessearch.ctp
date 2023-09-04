<?php if (count($getUsers) > 0) {
  //it comes from attendees table
  if ($getUsers[0]['event_id']) {
    foreach ($getUsers as $key => $value) {
      $check = $this->Comman->chechguest($value['cust_id'], $value['event_id']);
?>

      <tr>
        <td><?php echo $value['user']['name'] . ' ' . $value['user']['lname'] . ' (' . $value['user']['email'] . ')'; ?></td>

        <td align="center">
          <span class="rsvp" data-bs-toggle="tooltip" data-bs-placement="left" title="<?php echo ($value['is_allowed_guest'] == 'N') ? 'Guest Not Allowed' : 'Guest Allowed'; ?>"><?php echo $value['is_allowed_guest']; ?></span>
        </td>

        <td align="center"><a data-bs-toggle="tooltip" data-bs-placement="left" title="Change RSVP Status" class="rsvp" onclick="enablersvp('<?php echo $value['id'] . '/' . $value['is_rsvp'] . '/' . $value['event_id']; ?>')"><?php echo $value['is_rsvp']; ?></a></td>

        <td align="center"><a data-bs-toggle="tooltip" data-bs-placement="right" title="Remove Attendees"><i width="20" height="20" fill="#e62d56" class="bi bi-trash" onclick="return deleteticket(<?php echo $value['event_id']; ?>,<?php echo $value['id']; ?>,'A')" style="color: #e0275a;"></i></a></td>

      </tr>

    <?php  }
  } else {
    //comes from the ticket page
    foreach ($getUsers as $key => $value) {
      // pr($value);
      // exit;
      $check = $this->Comman->chechguest($value['ticket']['cust_id'], $value['ticket']['event_id']);
    ?>

      <tr>
        <td><?php echo $value['user']['name'] . ' ' . $value['user']['lname'] . ' (' . $value['user']['email'] . ')'; ?></td>

        <td align="center">
          <span class="rsvp" data-bs-toggle="tooltip" data-bs-placement="left" title="<?php echo ($check == 'N') ? 'Guest Not Allowed' : 'Guest Allowed'; ?>"><?php echo $check; ?></span>
        </td>

        <td align="center"><a data-bs-toggle="tooltip" data-bs-placement="left" title="Change RSVP Status" class="rsvp" onclick="enablersvp('<?php echo $value['ticket']['id'] . '/0'; ?>')"><?php echo $value['is_rsvp']; ?></a></td>

        <td align="center"><a data-bs-toggle="tooltip" data-bs-placement="right" title="Remove Attendees"><i width="20" height="20" fill="#e62d56" class="bi bi-trash" onclick="return deleteticket(<?php echo $id; ?>,<?php echo $value['user_id']; ?>)" style="color: #e0275a;"></i></a></td>

      </tr>

  <?php }
  }
} else { ?>

  <tr>
    <td align="center" colspan="4">
      No invitations uploaded !!.
    </td>
  </tr>



<?php } ?>