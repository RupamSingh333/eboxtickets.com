<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

<style>
  .editIcos svg {
    width: 16px !important;
  }
</style>
<!-- <link href="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.css" rel="stylesheet" type="text/css" /> -->
<!-- <script src="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.js"></script> -->
<section id="Dashboard_section">
  <!-- <div class="row g-0"> -->
  <div class="d-flex">
    <?php echo $this->element('organizerdashboard'); ?>
    <!-- <div class="col-sm-9"> -->
    <div class="dsa_contant">
      <h4>My Events</h4>
      <hr>

      <?php echo $this->Flash->render(); ?>
      <div class="contant_bg2">
        <div class="event_settings">
          <section id="my_ticket">
            <div class="event-list-container" id="Mycity">
              <div class="event_detales">

                <!-- <div class="row"> -->
                <div class="table-responsive">
                  <!-- <div class="table_scroll"> -->
                  <table class="table table-hover">
                    <thead class="table-dark table_bg">
                      <tr>
                        <th style="width: 2%;" scope="col">#</th>
                        <th style="width: 14%;" scope="col">Name</th>
                        <th style="width: 17%;" scope="col">Date and Time</th>
                        <th style="width: 18%;" scope="col">Ticket Sale</th>
                        <th style="width: 8%;" scope="col">Venue</th>
                        <th style="width: 16%;" scope="col">Ticket Types</th>
                        <th style="width: 15%;" scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i = 1;
                      if (!empty($event)) {
                        foreach ($event as $key => $value) { ?>

                          <tr>
                            <th scope="row"><?php echo $i; ?></th>
                            <td><img src="<?php echo IMAGE_PATH . 'eventimages/' . $value['feat_image'] ?>" alt="Not Found">
                              <a href="<?php echo SITE_URL; ?>event/settings/<?php echo $value['id']; ?>"><?php echo ucwords(strtolower($value['name'])); ?></a>
                            </td>


                            <td><b>From</b> <?php echo date('d M, Y h:i A', strtotime($value['date_from'])); ?><br>
                              <b>To</b> <?php echo date('d M, Y h:i A', strtotime($value['date_to'])); ?>
                            </td>
                            <td>
                              <?php if (!empty($value['sale_start'])) { ?>
                                <b>From</b> <?php echo date('d M, Y h:i A', strtotime($value['sale_start'])); ?><br>
                                <b>To</b> <?php echo date('d M, Y h:i A', strtotime($value['sale_end'])); ?>
                              <?php } else { ?>
                                N/A
                              <?php }  ?>
                            </td>
                            <td><?php echo ucwords(strtolower($value['location'])); ?></td>

                            <td class="ticket_types">

                              <?php if (!empty($value['eventdetail'])) {

                                foreach ($value['eventdetail'] as $key => $tickettype) {

                                  if ($value['is_free'] == 'Y') { ?>
                                    <p><?php echo $tickettype['title']; ?> - <Span>Invitation</Span></p>
                                  <?php  } else { ?>

                                    <p><?php echo $tickettype['title']; ?> - <Span><?php echo ($tickettype['type'] == 'open_sales') ? 'Online' : 'Committee'; ?></Span></p>
                                  <?php } ?>


                                <?php }
                              } else { ?>
                                <p>Tickets not created</p>
                              <?php } ?>

                            </td>
                            <!-- <td class="Con_center">
                             
                                <button type="button" class="add_btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                  Add
                                </button>


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
                              <?php  //} else { 
                              ?>


                                <button type="button" class="add_btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                  Add
                                </button>


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
                              <?php //} 
                              ?>
                            </td>
                            <td class="Con_center">

                              <button type="button" class="sold_btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
                                View
                              </button>


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
                              <?php //if ($value['status'] == 'Y') {  
                              ?>

                                <button type="button" class="status_Active" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Active">
                                </button>

                              <?php // } else { 
                              ?>

                                <button type="button" class="status_Pending" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Pending">
                                </button>
                              <?php //} 
                              ?>
                            </td> -->
                            <td class="Con_center ">


                              <div class=" align-items-baseline justify-content-evenly editIcos ">

                                <!-- <a target="_blank" href="<?php //echo SITE_URL; 
                                                              ?>event/<?php //echo $value['slug']; 
                                                                      ?>" type="button" class="edit viewIcos" data-bs-toggle="tooltip" data-bs-placement="bottom" title="View"><i class="bi bi-eye-fill"></i> View
                                </a> -->




                                <a target="_blank" href="<?php echo SITE_URL; ?>event/<?php echo $value['slug']; ?>" class="edit viewIcos " data-bs-placement="bottom" title=""><i class="bi bi-eye-fill"></i> View
                                </a>

                                <a target="_blank" href="<?php echo SITE_URL; ?>event/settings/<?php echo $value['id']; ?> " class="edit viewIcos" data-bs-placement="bottom" title=""><i class="fas fa-edit"></i> Edit
                                </a>

                                <!-- <a href="<?php //echo SITE_URL; 
                                              ?>event/settings/<?php //echo $value['id']; 
                                                                ?> "class="edit viewIcos">

                                  <button type="button" class="edit" data-bs-placement="bottom" title="Edit"><i class="fas fa-edit"></i> Edit
                                  </button>
                                </a> -->


                                <a class="edit deleteIcos" href="<?php echo SITE_URL . 'event/deletevent/' . $value['id'];
                                                                  ?>" onclick="javascript: return confirm('Are you sure do you want to delete?')">

                                  <button type="button" class="edit" data-bs-placement="bottom" title=""> <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#fff" class="bi bi-trash" viewBox="0 0 16 16">
                                      <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
                                      <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>
                                    </svg> Delete
                                  </button>
                                </a>





                                <!-- <a href= ""><i class="bi bi-eye-fill"></i></a> -->
                              </div>
                              <div class="d-flex">
                                <?php if ($value['status'] == 'Y') {  ?>

                                  <a class="action_btn disable_btn" href="<?php echo SITE_URL; ?>event/eventstatus/<?php echo $value['id']; ?>/N" class="btn " data-bs-toggle="tooltip" data-bs-placement="bottom" title="Deactivate Event">
                                    <!-- <i class="bi bi-x-circle-fill"></i> -->
                                    <img class="del-icon" style="width:16px;" src="<?php echo SITE_URL; ?>images/delete.png" alt="">
                                 
                                  </a>


                                <?php } else { ?>


                                  <a class="action_btn enable_btn " href="<?php echo SITE_URL; ?>event/eventstatus/<?php echo $value['id']; ?>/Y" class="btn " data-bs-toggle="tooltip" data-bs-placement="bottom" title="Activate Event">
                                    <i class="bi bi-check-circle-fill"></i>
                                  </a>



                                <?php } ?>


                                <a class="action_btn excel_btn" href="<?php echo SITE_URL; ?>event/exporttickets/<?php echo $value['id']; ?>" class="btn " data-bs-toggle="tooltip" data-bs-placement="bottom" title="Export tickets">
                                <!-- <i class="fas fa-file-export"></i> -->

                                <img class="del-icon" style="width:16px;" src="<?php echo SITE_URL; ?>images/export-icon.png" alt="">
                                
                                </a>



                              </div>


                            </td>
                            <!-- <i class="fas fa-edit"></i></a></td> -->
                          </tr>

                        <?php $i++;
                        }
                      } else {  ?>
                        <tr>
                          <td colspan="7">
                            <center>
                              <p><i>You don`t have any event created.</i></p>
                            </center>
                          </td>
                        </tr>

                      <?php } ?>

                    </tbody>
                  </table>

                  <!-- </div> -->


                </div>
                <?php echo $this->element('admin/pagination'); ?>

                <!-- </div> -->

              </div>
            </div>
          </section>

        </div>
      </div>

    </div>
    <!-- </div> -->
  </div>
</section>

<!-- --------------------------------- -->