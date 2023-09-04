<section id="my_ticket">
  <div class="container">
    <div class="heading">
      <h1>Events</h1>
      <h2>My Events</h2>
    </div>

    <div class="event-list-container" id="Mycity">
      <div class="event_detales">

        <div class="row">
          <table class="table table-hover">
            <thead class="table-dark">
              <tr>
                <th style="width: 2%;" scope="col">#</th>
                <th style="width: 15%;" scope="col">Name</th>
                <th style="width: 18%;" scope="col">Date and Time</th>
                <th style="width: 18%;" scope="col">Ticket Sale</th>
                <th style="width: 10%;" scope="col">Venue</th>
                <th style="width: 14%;" scope="col">Ticket Types</th>
                <th style="width: 8%;" scope="col">Add Complementary</th>
                <th style="width: 8%;" scope="col">View Sold Tickets</th>
                <th style="width: 5%;" scope="col">Status</th>
                <th style="width: 3%;" scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1;
              foreach ($event as $key => $value) { //pr($value);die;
              ?>

                <tr>
                  <th scope="row"><?php echo $i; ?></th>
                  <td><?php echo $value['name']; ?></td>
                  <td>From <?php echo date('d M Y H:i A', strtotime($value['date_from'])); ?><br>
                    To <?php echo date('d M Y H:i A', strtotime($value['date_to'])); ?>
                  </td>
                  <td>
                    From <?php echo date('d M Y H:i A', strtotime($value['sale_start'])); ?><br>
                    To <?php echo date('d M Y H:i A', strtotime($value['sale_end'])); ?>
                  </td>
                  <td><?php echo $value['location']; ?> India</td>

                  <td class="ticket_types">
                    <p>Gold - <Span>Online</Span></p>
                    <p>Silver - <Span>Committee</Span></p>
                    <p>Platinum - <Span>Online</Span></p>
                    <p>VIP - <Span>Committee</Span></p>
                  </td>
                  <td class="Con_center">
                    <?php if ($value['status'] == 'Y') {  ?>
                      <!-- <a data-toggle="modal" class="infolangcat nocolor" href="<?php //echo SITE_URL 
                                                                                    ?>homes/addcomp/<?php echo $value['id']; ?>"><button style="border-radius: 5px !important;">Add</button></a> -->
                      <!-- Button trigger modal -->
                      <button type="button" class="add_btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Add
                      </button>

                      <!-- Modal -->
                      <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="staticBackdropLabel">Add Complementary</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <form>
                                <div class="mb-3">
                                  <label for="recipient-name" class="col-form-label">Recipient:</label>
                                  <input type="text" class="form-control" id="recipient-name">
                                </div>
                                <div class="mb-3">
                                  <label for="message-text" class="col-form-label">Message:</label>
                                  <textarea class="form-control" id="message-text"></textarea>
                                </div>
                              </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <button type="button" class="btn btn-primary">Save</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php  } else { ?>
                      <!-- <a data-toggle="modal" class="nocomp nocolor" href="<?php //echo SITE_URL 
                                                                                ?>homes/aaddcomp"><button style="border-radius: 5px !important;">Add</button></a> -->
                      <!-- Button trigger modal -->
                      <button type="button" class="add_btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Add
                      </button>

                      <!-- Modal -->
                      <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="staticBackdropLabel">Add Complementary</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <form>
                                <div class="mb-3">
                                  <label for="recipient-name" class="col-form-label">Recipient:</label>
                                  <input type="text" class="form-control" id="recipient-name">
                                </div>
                                <div class="mb-3">
                                  <label for="message-text" class="col-form-label">Message:</label>
                                  <textarea class="form-control" id="message-text"></textarea>
                                </div>
                              </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <button type="button" class="btn btn-primary">Save</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php } ?>
                  </td>
                  <td class="Con_center">
                    <!-- <a data-toggle="modal" class="infolangcat nocolor" href="<?php //echo SITE_URL 
                                                                                  ?>homes/viewcomp/<?php echo $value['id']; ?>"> <button style="border-radius: 5px !important;">View</button></a> -->
                    <!-- Button trigger modal -->
                    <button type="button" class="sold_btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
                      View
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">View Sold Tickets</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <form>
                              <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Recipient:</label>
                                <input type="text" class="form-control" id="recipient-name">
                              </div>
                              <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Recipient:</label>
                                <input type="text" class="form-control" id="recipient-name">
                              </div>
                              <div class="mb-3">
                                <label for="message-text" class="col-form-label">Message:</label>
                                <textarea class="form-control" id="message-text"></textarea>
                              </div>
                            </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>



                  <td class="Con_center">
                    <?php if ($value['status'] == 'Y') {  ?>
                      <!-- <a href="#" class="status_Active"></a> -->
                      <button type="button" class="status_Active" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Active">
                      </button>

                    <?php  } else { ?>
                      <!-- <a href="#" class="status_Pending "></a> -->
                      <button type="button" class="status_Pending" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Pending">
                      </button>
                    <?php } ?>
                  </td>
                  <td class="Con_center"><a href="<?php echo SITE_URL; ?>event/tickets/<?php echo $value['slug']; ?>/<?php echo $value['id']; ?>">

                   <button type="button" class="edit" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"><i class="fas fa-edit"></i>
                      </button>
                  <!-- <i class="fas fa-edit"></i></a></td> -->
                </tr>


              <?php $i++;
              } ?>

            </tbody>
          </table>
        </div>

      </div>
    </div>

  </div>
</section>




