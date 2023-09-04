<section id="my_ticket">
  <div class="container">
    <div class="heading">
      <h1>Tickets</h1>
      <h2>My Tickets</h2>
    </div>
    <?php echo $this->Flash->render(); ?>

    <div class="event-list-container" id="Mycity">
      <div class="event_detales">

        <div class="row">

          <?php
          if (!empty($currentticketbook)) {
            foreach ($currentticketbook as $key => $value) {
              //Package Tickets 
              if ($value['package_id']) { ?>

                <div class="col-lg-6 col-md-12">
                  
                  <div class="up_events">
                  <div class="Package">
                    <h1>Package</h1>

                  </div>
                    <a href="<?php echo SITE_URL . 'tickets/ticketdetails/' . $value['event_id'] . '/package'; ?>">
                      <div class="inner_box">
                        <div class="row d-flex align-items-center justify-content-center g-0">
                          <div class="col-sm-5">
                            <div class="image_br">
                              <img class="event_img" src="<?php echo IMAGE_PATH . 'eventimages/' . $value['event']['feat_image']; ?>" alt="IMG">
                            </div>
                          </div>
                          <div class="col-sm-7">
                            <div class="event_contant">
                              <h3 class="title">
                                <?php echo ucwords(strtolower($value['event']['name'])); ?> </h3>
                              <p class="mb-0 time"><i class="fa-solid fa-calendar-days"></i>
                                <strong style="display:inline-block; width:70px;">Start
                                  Date</strong> <span style="display:inline-block; width:10px; color:#333; font-weight:700;">:</span>
                                <?php echo date('D, d M Y', strtotime($value['event']['date_from']));
                                ?> | <?php echo date('h:i A', strtotime($value['event']['date_from'])); ?>

                              </p>
                              <p class="mb-0 time"><i class="fa-solid fa-calendar-days"></i>
                                <strong style="display:inline-block; width:70px;">End Date</strong>
                                <span style="display:inline-block; width:10px; color:#333; font-weight:700;">:</span>
                                <?php echo date('D, d M Y', strtotime($value['event']['date_to']));
                                ?> | <?php echo date('h:i A', strtotime($value['event']['date_to'])); ?>
                              </p>

                              <span class="mb-2 d-block"> @
                                <?php echo ucwords(strtolower($value['event']['location'])); ?>
                              </span>
                           

                            </div>
                          </div>
                        </div>
                      </div>
                    </a>
                  </div>
                </div>

              <?php  } else {  ?>

                <!-- Normal Tickets  -->
                <div class="col-lg-6 col-md-12">
                  <div class="up_events">
                    <a href="<?php echo SITE_URL . 'tickets/ticketdetails/' . $value['event_id']; ?>">
                      <div class="inner_box">
                        <div class="row d-flex align-items-center justify-content-center g-0">
                          <div class="col-sm-5">
                            <div class="image_br">
                              <img class="event_img" src="<?php echo IMAGE_PATH . 'eventimages/' . $value['event']['feat_image']; ?>" alt="IMG">
                            </div>
                          </div>
                          <div class="col-sm-7">
                            <div class="event_contant">
                              <h3 class="title">
                                <?php echo ucwords(strtolower($value['event']['name'])); ?> </h3>
                              <p class="mb-0 time"><i class="fa-solid fa-calendar-days"></i>
                                <strong style="display:inline-block; width:70px;">Start
                                  Date</strong> <span style="display:inline-block; width:10px; color:#333; font-weight:700;">:</span>
                                <?php echo date('D, d M Y', strtotime($value['event']['date_from']));
                                ?> | <?php echo date('h:i A', strtotime($value['event']['date_from'])); ?>

                              </p>
                              <p class="mb-0 time"><i class="fa-solid fa-calendar-days"></i>
                                <strong style="display:inline-block; width:70px;">End Date</strong>
                                <span style="display:inline-block; width:10px; color:#333; font-weight:700;">:</span>
                                <?php echo date('D, d M Y', strtotime($value['event']['date_to']));
                                ?> | <?php echo date('h:i A', strtotime($value['event']['date_to'])); ?>
                              </p>
                              <!-- <h4 class="author-info"> Unforgettable Events Ltd will </h4> -->

                              <!-- <h4 class="author-info d-flex align-items-center mt-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                  <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z" />
                                  <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z" /></svg>
                                <span><?php //echo date('h:i A', strtotime($value['event']['date_from'])); 
                                      ?> - <?php //echo date('h:i A', strtotime($value['event']['date_to'])); 
                                            ?></span>
                              </h4> -->
                              <span class="mb-2 d-block"> @
                                <?php echo ucwords(strtolower($value['event']['location'])); ?>
                              </span>

                            </div>
                          </div>
                        </div>
                      </div>
                    </a>
                  </div>
                </div>

              <?php }  ?>


            <?php }
          } else { ?>
            <center><span>No tickets booked</span></center>
          <?php } ?>


          <!-- <div class="col-md-6">
            <div class="up_events">
              <a href="./ticketdetails">
                <div class="inner_box">
                  <div class="row d-flex align-items-center justify-content-center">
                    <div class="col-sm-5">
                      <div class="image_br">
                        <img class="event_img" src="https://staging.eboxtickets.com/images/event_img2.png" alt="">
                      </div>
                    </div>
                    <div class="col-sm-7">
                      <div class="event_contant">
                        <h3 class="title">Ishant Arora </h3>
                        <h4 class="author-info"> Unforgettable Events Ltd will </h4>
                        <span class="mb-2"> @ Antigua and Barbuda </span>
                        <h4 class="author-info d-flex align-items-center mt-2">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                            <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z" />
                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z" />
                          </svg>
                          12:00 PM - 05:00 PM
                        </h4>
                        <h4 class="time">18 August 2022</h4>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div> -->

        </div>
        <?php echo $this->element('admin/pagination'); ?>

      </div>
    </div>

  </div>
</section>