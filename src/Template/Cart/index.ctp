<section id="cart">
  <div class="container">
    <!-- <div class="in_heading">
      <h1>Profile</h1>
      <h2>Edit Profile</h2>
      <p class="mb-4">Your profile information is displayed below.</p>
    </div> -->
    <div class="in_heading2">
      <h2>Cart</h2>
      <!-- <p> You can select items from your cart to checkout by checking or unchecking the checkbox next to the item. Once all the desired items are selected click the Checkout button.</p> -->
      <?php echo $this->Flash->render(); ?>
    </div>

    <div class="cart_deaile">

      <div class="row">
        <div class="col-md-8">
          <div class="cart_item">
            <div class="row item_heading">
              <!-- <div class="col-sm-1"></div> -->
              <div class="col-6">
                <p> Event</p>
              </div>
              <!-- <div class="col-sm-5"></div> -->
              <div class="col-3">
                <p>Price</p>
              </div>
              <div class="col-3 text-center">
                <p>Remove</p>
              </div>

            </div>
            <?php if ($cart_data || $cart_data_packages) { ?>
              <?php foreach ($cart_data as $cart_value) { //pr($cart_value); die;
              ?>

                <div class="row item_list align-items-center">

                  <div class="col-6">
                    <p class="p_h"><?php echo $cart_value['event']['name']; ?></p><span class="span_h"><?php echo $cart_value['eventdetail']['title']; ?></span>
                  </div>
                  <div class="col-3 ">

                    <p>
                      <?php
                      echo $cart_value['event']['currency']['Currency_symbol']; ?><?php echo sprintf('%.2f', $cart_value['eventdetail']['price']); ?> <?php echo $cart_value['event']['currency']['Currency'];  ?>
                    </p>

                  </div>
                  <div class="col-3 text-center">
                    <a href="<?php echo SITE_URL; ?>cart/cartdelete/<?php echo $cart_value['id'] . '/' . $cart_value['serial_no']; ?>" onclick="javascript: return confirm('Are you sure do you want to delete?')"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#e62d56" class="bi bi-trash" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                      </svg>
                    </a>
                  </div>
                </div>

              <?php }
              foreach ($cart_data_packages as $packages_details) {
                // pr($packages_details['no_tickets']);exit;
              ?>

                <!-- <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<Package show >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> -->
                <div class="row item_list align-items-center">

                  <div class="col-6">
                    <p class="p_h"><?php echo $packages_details['event']['name']; ?></p>
                    <!-- <span class="span_h"><?php //echo $packages_details['package']['name']; 
                                              ?></span> -->
                  </div>

                  <div class="col-3 ">
                    <p>
                      <?php

                      if($packages_details['no_tickets']>1){
                        
                        echo $packages_details['no_tickets'] . ' X '. $packages_details['event']['currency']['Currency_symbol']; ?><?php echo sprintf('%.2f', $packages_details['package']['grandtotal']); ?> <?php echo $packages_details['event']['currency']['Currency'];
                        
                      }else{
                        
                        echo $packages_details['event']['currency']['Currency_symbol']; ?><?php echo sprintf('%.2f', $packages_details['package']['grandtotal']); ?> <?php echo $packages_details['event']['currency']['Currency'];

                      }
                      ?>
                    </p>

                  </div>

                  <div class="col-3 text-center">
                    <a href="<?php echo SITE_URL; ?>cart/cartdelete/<?php echo $packages_details['id'] . '/' . $packages_details['serial_no']; ?>" onclick="javascript: return confirm('Are you sure do you want to delete?')"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#e62d56" class="bi bi-trash" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                      </svg>
                    </a>
                  </div>

                  <div class="row align-items-center mb-2">
                    <div class="col-sm-12">
                      <div class="multipal_Pack cart_pack">
                        <h6 class="event_Sub_Ad">Package ( <?php echo $packages_details['package']['name']; ?> )</h6>

                        <div class="package_info">
                          <?php
                          foreach ($packages_details['package']['packagedetails'] as $packdet) {
                          ?>
                            <p><?php echo $packdet['eventdetail']['title']; ?> (<?php echo $packdet['qty']; ?> Tickets)</p>
                          <?php } ?>
                        </div>
                        <?php
                        // <!-- Addons Type  -->
                        $getAddons = $this->Comman->getPackageDetails($packages_details['package_id']);
                        if (!empty($getAddons[0]['id'])) {
                        ?>
                          <div class="addon_pack">
                            <h6 class="event_Sub_Ad">Addons</h6>
                            <div class="package_info">
                              <?php
                              foreach ($getAddons as $addonsIndividual) {
                              ?>
                                <p><?php echo $addonsIndividual['qty']; ?> <?php echo $addonsIndividual['addon']['name'] . ' (' . $addonsIndividual['addon']['description'] . ' )'; ?></p>
                              <?php } ?>
                            </div>

                          </div>
                        <?php } ?>

                        <div class="discretion">
                          <h6><?php echo $packages_details['package']['description']?></h6>
                        </div>
                      </div>

                    </div>
                  </div>

                </div>

              <?php }
            } else { ?>
              <div class="row">
                <div class="item_list" style="text-align:center">
                  <div class="col-12">
                    No Data in Cart
                  </div>
                </div>

              </div>
            <?php } ?>

            <!--  -->
            <!-- <div class="row align-items-center mb-2">
              <div class="col-sm-12">
                <div class="multipal_Pack cart_pack">
                  <h6 class="event_Sub_Ad">Package</h6>
                  <div class="package_info">

                    <p>VIP Tickets (6 Tickets)</p>
                    <p>Female Tickets (2 Tickets)</p>
                    <p>Male Tickets (3 Tickets)</p>
                  </div>
                  <div class="addon_pack">
                    <h6 class="event_Sub_Ad">Addons</h6>
                    <div class="package_info">
                      <p>4 bottles</p>
                      <p>2 Premium</p>
                      <p>Male (1)</p>
                    </div>

                  </div>
                  <div class="discretion">
                    <h6>Looking for something to do on this mini Mexican holiday.

                      Come join us at Tapas Sports Bar for Weislandgames Ultimate Drinking Game Night Cinco De Mayo edition. </h6>

                  </div>
                </div>

              </div>
            </div> -->
            <!--  -->

          </div>
        </div>
        <!-- <div class="col-md-1">
                  
                </div> -->
        <?php if (!empty($cart_data) || !empty($cart_data_packages)) { ?>
          <div class="col-md-4">
            <div class="total_items">
              <h4>Total: <?php echo count($cart_data) + count($cart_data_packages); ?> items</h4>

              <a href="<?php echo SITE_URL; ?>cart/checkout"><button type="submit" class="btn reg">
                  <svg class="mr-3" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" class="bi bi-wallet2" viewBox="0 0 16 16">
                    <path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z" />
                  </svg>
                  Pay with Credit / Debit Card</button>
              </a>
            </div>

          </div>
        <?php } ?>
      </div>
    </div>
    <hr style="width: 92%;margin: auto;">

    <!-- ============================== -->
    <?php if (!empty($cart_data_comitee)) { ?>
      <div class="in_heading2 mt-5">
        <h2>Pending Requests</h2>
        <p> When your requests are approved you'll get an email notification. You can delete requests below which will allow you to request from someone else.</p>
      </div>

      <div class="cart_deaile">
        <div class="cart_pending">

          <div class="row item_heading2">
            <div class="col-sm-9 col-8">Event</div>
            <div class="col-sm-3 col-4 text-center">Actions</div>
          </div>

          <?php foreach ($cart_data_comitee as $cart_data_value) {
            $commusername = $this->Comman->finduser($cart_data_value['commitee_user_id']);

          ?>
            <div class="row item_list">
              <div class="col-sm-9 col-8">
                <h6 class="padding_itams"> <?php echo ucwords(strtolower($cart_data_value['event']['name'])); ?> </h6>
                <span><?php echo $cart_data_value['eventdetail']['title']; ?></span>
                <p>Price: <span><?php echo $cart_data_value['event']['currency']['Currency_symbol']; ?><?php echo sprintf('%.2f', $cart_data_value['eventdetail']['price']); ?> <?php echo $cart_data_value['event']['currency']['Currency']; ?></span> </p>
                <p class="padding_by">Requested from: <span><?php echo $commusername['name'] . ' ' . $commusername['lname']; ?></span></p>
              </div>
              <div class="col-sm-3 col-4 text-center">
                <a href="<?php echo SITE_URL; ?>cart/cartdelete/<?php echo $cart_data_value['id']; ?>" onclick="javascript: return confirm('Are you sure do you want to cancel?')" class="btn cancel">Cancel</a>
                <!-- <button type="submit" class="btn cancel"> Cancel</button> -->
              </div>
            </div>

          <?php } ?>


        </div>
      </div>

    <?php } ?>

  </div>
  </div>
  <!--  -->

  </div>
</section>