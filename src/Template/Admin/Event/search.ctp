<table id="bootstrap-data-table" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th style="width: 2%;" scope="col">S.No</th>
      <th style="width: 8%;" scope="col">Organiser</th>
      <th style="width: 14%;" scope="col">Event Name</th>
      <th style="width: 18%;" scope="col">Date and Time</th>
      <th style="width: 8%;" scope="col">Venue</th>
      <th style="width: 15%;" scope="col">Ticket Types</th>
      <th style="width: 7%;" scope="col">Staff</th>
      <th style="width: 10%;" scope="col">Total Sales</th>
      <th style="width: 9%;" scope="col">Comm(<?php echo $admin_info['feeassignment']; ?>%)</th>
      <th style="width: 0%;" scope="col">Featured</th>
      <th style="width: 8%;" scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php $i = 1;
    foreach ($event_search as $value) :
      $complete_sale = $this->Comman->calculatepayment($value->id);
    ?>
      <tr>
        <td><?php echo $i; ?></td>

        <td><?php echo ucfirst($value->user->name) ?></td>

        <td><a style="text-decoration: underline;line-height: 21px;" href="<?php echo SITE_URL . 'event/' . $value->slug; ?>" target="_blank">
            <?php echo ucfirst($value->name); ?></a>
        </td>

        <td><b>From</b> <?php echo date('d M, Y h:i A', strtotime($value['date_from'])); ?><br>
          <b>To</b> <?php echo date('d M, Y h:i A', strtotime($value['date_to'])); ?>
        </td>

        <td><?php echo $value->location; ?></td>

        <td class="">

          <?php if (!empty($value['eventdetail'])) {

            foreach ($value['eventdetail'] as $key => $tickettype) {

              if ($value['is_free'] == 'Y') { ?>
                <a><?php echo $tickettype['title']; ?> - <Span>Invitation</Span></a>
              <?php  } else { ?>

                <a><?php echo $tickettype['title']; ?> - <Span><?php echo ($tickettype['type'] == 'open_sales') ? 'Online' : 'Committee'; ?></Span></a><br>
              <?php } ?>


            <?php }
          } else { ?>
            <a>Tickets not created</a>
          <?php } ?>

        </td>
        <td>
          <a style="color: black;">
            view
          </a>

        </td>

        <td><a style="color: black;" href="<?php echo SITE_URL; ?>admin/event/eventdetail/<?php echo $value['id']; ?>">
            <?php echo ($value['currency']['Currency_symbol']) ? $value['currency']['Currency_symbol'] : "$"; ?>
            <?php echo number_format($complete_sale, 2); ?>
            <?php echo ($value['currency']['Currency']) ? $value['currency']['Currency'] : "USD"; ?></strong>
          </a>
        </td>

        <td>
          <a style="color: black;">
            <?php echo ($value['currency']['Currency_symbol']) ? $value['currency']['Currency_symbol'] : "$"; ?>
            <?php echo number_format($complete_sale * $admin_info['feeassignment'] / 100, 2); ?>
            <?php echo ($value['currency']['Currency']) ? $value['currency']['Currency'] : "USD"; ?>
          </a>
        </td>

        <td>
          <?php if ($value['featured'] == 'Y') {  ?>

            <a class="feature y" href="event/featuredstatus/<?php echo $value['id'] . '/N'; ?>"><i class="fa fa-star" style="font-size: 18px !important; color:green;" aria-hidden="true"></i></a>
          <?php  } else { ?>

            <a class="feature n" href="event/featuredstatus/<?php echo $value['id'] . '/Y'; ?>"><i class="fa fa-star" style="font-size: 18px !important;" aria-hidden="true"></i></a>

          <?php } ?>
          <!-- Get staff  -->
          <a href="<?php echo ADMIN_URL . 'event/getstaff/' . $value['event_org_id']; ?>" class="get_staff" title="View Staff"><i class="fa fa-eye" aria-hidden="true"></i></a>
        </td>


        <td class="actions">
          <?php if ($value['admineventstatus'] == 'Y') {  ?>
            <a href="<?php echo ADMIN_URL ?>event/status/<?php echo $value['id'] . '/N'; ?>" title="Click to Inactive"><i class="fa fa-toggle-on" style="font-size: 20px !important; margin-left: 1px; color:green;" aria-hidden="true"></i></a>

          <?php  } else { ?>
            <a href="<?php echo ADMIN_URL ?>event/status/<?php echo $value['id'] . '/Y'; ?>" title="Click to Active"><i class="fa fa-toggle-off" style="font-size: 20px !important; margin-left: 1px;" aria-hidden="true"></i></a>
          <?php } ?>

          <?= $this->Form->postLink(
            __(''),
            ['action' => 'delete', $value->id, 'Y'],
            array('class' => 'fa fa-trash', 'title' => 'Delete', 'style' => 'font-size:17px; margin-right: 2px; color:red'),
            ['onclick' => 'return confirm("Are you sure you want to delete application")']
          )

          ?>

        </td>

      </tr>
    <?php $i++;
    endforeach; ?>
  </tbody>
</table>

<script>
  $(document).on("click", ".get_staff", function(e) {
    e.preventDefault();
    var href = $(this).attr('href');
    // console.log(href);
    $('#globalModalkoi .modal-content').load(href, function() {
      $('#globalModalkoi').modal({
        show: true
      });
    });
  });
</script>
<?php echo $this->element('admin/pagination'); ?>