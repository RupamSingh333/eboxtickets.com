<style>
  .payment .card-payment {
    /* height: 476px; */
    margin: 0 auto;
    position: relative;
    width: 100%;
  }

  .payment h3 {
    font-size: 30px;
    line-height: 50px;
    margin: 0 0 28px;
    text-align: center;
  }

  .payment ul {
    list-style: outside none none;
  }

  .payment ul,
  .payment h4 {
    border: 0 none;
    font: inherit;
    margin: 0;
    padding: 0;
    vertical-align: baseline;
  }

  .payment form {
    float: none;
  }

  /* .payment form,
  .payment .cardInfo {
    background-color: #f9f9f7;
    border: 1px solid #fff;
    border-radius: 5px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
    left: 0;
    margin: 0 auto;
    padding: 10px 10px;
    max-width: 320px;
  } */

  .payment form li {
    margin: 8px 0;
  }

  .payment form label {
    color: #555;
    display: block;
    font-size: 14px;
    font-weight: 400;
  }

  .payment form #card_number {
    background-image: url("<?php echo SITE_URL; ?>images/creditcardimages.png"), url("<?php echo SITE_URL; ?>images/creditcardimages.png");
    background-position: 2px -121px, 260px -61px;
    background-repeat: no-repeat;
    background-size: 120px 361px, 120px 361px;
    padding-left: 54px !important;
    width: 225px;
  }

  .payment form input {
    /* background-color: #fff;
    border: 1px solid #e5e5e5; */
    /* box-sizing: content-box; */
    /* color: #333;
    display: block;
    font-size: 18px;
    height: 32px;
    padding: 0 5px;
    width: 275px;
    outline: none; */
  }

  .payment form input::-moz-placeholder {
    color: #ddd;
    opacity: 1;
  }

  .payment .payment-btn {
    width: 100%;
    height: 34px;
    padding: 0;
    font-weight: bold;
    color: white;
    text-align: center;
    cursor: pointer;
    text-shadow: 0 -1px 1px rgba(0, 0, 0, 0.2);
    border: 1px solid;
    border-color: #005fb3;
    background: #0092d1;
    border-radius: 4px;
  }

  .payment form li .help {
    color: #aaa;
    display: block;
    font-size: 11px;
    font-weight: 400;
    line-height: 14px;
    padding-top: 14px;
  }

  .payment .vertical {
    overflow: hidden;
  }

  .payment .vertical li {
    float: left;
    width: 95px;
  }

  .payment .vertical input {
    width: 68px;
  }

  .payment .list {
    color: #767670;
    font-size: 16px;
    list-style: outside none disc;
    margin-bottom: 28px;
    margin-left: 25px;
  }

  .payment .card-payment .numbers {
    background-color: #fff;
    border: 1px solid #bbc;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
    margin-bottom: 28px;
    padding: 14px 20px;
    z-index: 10;
  }

  .payment .card-payment .numbers p {
    margin-bottom: 0;
    margin-top: 0;
  }

  .payment .card-payment .numbers .list {
    margin-bottom: 0;
    margin-left: 0px;
  }

  .payment .required {
    border: 1px solid #EA4335;
  }

  .payment .cardInfo p span {
    color: #FB4314;
  }
</style>

<section id="cart">
  <div class="container">
    <!-- <div class="in_heading">
      <h1>Profile</h1>
      <h2>Edit Profile</h2>
      <p class="mb-4">Your profile information is displayed below.</p>
    </div> -->
    <div class="in_heading2">
      <h2>Checkout</h2>
      <!-- <p> You can select items from your cart to checkout by checking or unchecking the checkbox next to the item. Once all the desired items are selected click the Checkout button.</p> -->
      <hr>
      <h5>Order Summary</h5>
      <?php echo $this->Flash->render(); ?>
    </div>

    <div class="cart_deaile">


      <div class="row">
        <div class="col-md-8">
          <div class="cart_item">
            <div class="row item_heading">

              <div class="col-sm-4 col-4 align-items-center d-flex">
                <p> Event</p>
              </div>

              <div class=" col-sm-3 col-3 d-flex align-items-center ">
                <p>Price</p>
                <a data-bs-toggle="popover" title="Price" data-bs-content="We process all payment in the United States so prices below are automatically converted to USD."><i class="bi bi-question-circle qus_icon"></i>
                </a>
              </div>
              <div class="col-sm-3 col-3 align-items-center d-flex">
                <p>Fee</p>

                <a data-bs-toggle="popover" title="Fees" data-bs-content="The fee below covers credit card processing fees as well as the eboxtickets service fee."><i class="bi bi-question-circle qus_icon"></i>
                </a>


              </div>
              <div class="col-sm-2  col-2 text-center align-items-center d-flex">
                <p>Remove</p>
              </div>

            </div>

            <?php if ($cart_data || $cart_data_packages) {
              // defining function
              function cal_percentage($num_amount, $num_total)
              {
                $count1 = $num_total * $num_amount / 100;
                $count = number_format($count1, 2);
                return $count;
              }

              $total_amt = 0;
              $total_fee = 0;
              if ($cart_data[0]) {
                // Show Tickets
                foreach ($cart_data as $key => $cart_value) { //pr($cart_value); die;
                  // if($cart_value['event']['currency']['id']==1){
                  $total_amt += $cart_value['eventdetail']['price'] * $cart_value['event']['currency']['conversion_rate'];
                  $total_fee += cal_percentage($fees, $cart_value['eventdetail']['price'] * $cart_value['event']['currency']['conversion_rate']);
                  // }else{
                  //   $total_amt += $cart_value['eventdetail']['price'];
                  //   $total_fee += cal_percentage($fees, $cart_value['eventdetail']['price']);
                  // }
            ?>

                  <div class="row item_list align-items-center">

                    <div class="col-sm-4  col-4">
                      <input type="hidden" name="ticketid[]" value="<?php echo $cart_value['id']; ?>">
                      <p class="p_h"><?php echo ucwords(strtolower($cart_value['event']['name'])); ?></p><span class="span_h"><?php echo $cart_value['eventdetail']['title']; ?></span>
                    </div>

                    <div class="col-sm-3  col-3  ">
                      <p>
                        <?php
                        // if($cart_value['event']['currency']['id']==1){
                        echo $cart_value['event']['currency']['Currency_symbol']; ?><?php echo sprintf('%0.2f', $cart_value['eventdetail']['price'] * $cart_value['event']['currency']['conversion_rate']) . ' TTD';
                                                                                    // echo $cart_value['event']['currency']['Currency_symbol']; 
                                                                                    ?><?php //echo sprintf('%0.2f', $cart_value['eventdetail']['price']); 
                                                                                      ?> <?php //echo $cart_value['event']['currency']['Currency'];
                                                                                          // } 
                                                                                          ?>

                      </p>
                    </div>

                    <div class="col-sm-3  col-3  ">
                      <p>
                        <?php
                        // if($cart_value['event']['currency']['id']==1){
                        echo $cart_value['event']['currency']['Currency_symbol']; ?><?php echo  cal_percentage($fees, $cart_value['eventdetail']['price'] * $cart_value['event']['currency']['conversion_rate']) . ' TTD';
                                                                                    // }else{
                                                                                    //   echo $cart_value['event']['currency']['Currency_symbol']; 
                                                                                    ?><?php //echo  cal_percentage($fees, //$cart_value['eventdetail']['price']); 
                                                                                      ?> <?php //echo $cart_value['event']['currency']['Currency']; 
                                                                                          // }                      
                                                                                          ?>
                      </p>
                    </div>

                    <div class="col-sm-2  col-2 text-center ">
                      <a href="<?php echo SITE_URL; ?>cart/cartdelete/<?php echo $cart_value['id']; ?>"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#e62d56" class="bi bi-trash" viewBox="0 0 16 16">
                          <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                          <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                        </svg></a>
                    </div>

                  </div>

                  <!-- Addons added into the cart  -->
                  <?php
                  $last_index = array_key_last($cart_data);
                  if ($last_index == $key) {
                    $cart_addon = $this->Comman->cart_addons($user_id);
                    $currency_get = '';
                    foreach ($cart_addon as $addon_id => $addons_name) {
                      $currency_get = $this->Comman->findeventdetail($addons_name['event_id']);
                      // if($currency_get['currency']['id']==1){
                      // pr($currency_get);exit;
                      $total_amt += $addons_name['addon']['price'] * $currency_get['currency']['conversion_rate'];
                      $total_fee += cal_percentage($fees, $addons_name['addon']['price'] * $currency_get['currency']['conversion_rate']);
                      // }else{
                      //   $total_amt += $addons_name['addon']['price'];
                      //   $total_fee += cal_percentage($fees, $addons_name['addon']['price']);
                      // }
                  ?>

                      <div class="row item_list align-items-center">

                        <div class="col-sm-4">
                          <input type="hidden" name="addonid[]" value="<?php echo $addons_name['id']; ?>">
                          <p class="p_h"><?php echo ucwords(strtolower($addons_name['addon']['name'])); ?></p>
                        </div>
                        <div class="col-sm-3 ">
                          <p><?php
                              // if($currency_get['currency']['id']==1){
                              echo $cart_value['event']['currency']['Currency_symbol']; ?><?php echo sprintf('%0.2f', $addons_name['addon']['price'] * $currency_get['currency']['conversion_rate']) . ' TTD';
                                                                                          // }else{
                                                                                          // echo $cart_value['event']['currency']['Currency_symbol']; 
                                                                                          ?><?php //echo sprintf('%0.2f', $addons_name['addon']['price']); 
                                                                                            ?> <?php //echo $cart_value['event']['currency']['Currency']; 
                                                                                                // }                        
                                                                                                ?></p>
                        </div>
                        <div class="col-sm-3 ">
                          <p><?php
                              //  if($currency_get['currency']['id']==1){
                              echo $cart_value['event']['currency']['Currency_symbol']; ?><?php echo  cal_percentage($fees, $addons_name['addon']['price'] * $currency_get['currency']['conversion_rate']) . ' TTD';
                                                                                          //  }else{
                                                                                          //  echo $cart_value['event']['currency']['Currency_symbol']; 
                                                                                          ?><?php //echo  cal_percentage($fees, $addons_name['addon']['price']); 
                                                                                            ?> <?php //echo $cart_value['event']['currency']['Currency']; 
                                                                                                //  }

                                                                                                ?></p>
                        </div>

                        <div class="col-sm-2 text-center ">
                          <a href="<?php echo SITE_URL; ?>cart/addondelete/<?php echo $addons_name['id']; ?>"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#e62d56" class="bi bi-trash" viewBox="0 0 16 16">
                              <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                              <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                            </svg></a>
                        </div>
                      </div>

                  <?php }
                  }
                  // <!-- Addons added into the cart End -->

                }
              } else {
                // Show packages Start
                $packageIds = [];
                foreach ($cart_data_packages as $cart_key => $cart_packages_details) {
                  // pr($cart_packages_details);exit;
                  $packageIds[] = $cart_packages_details['package_id'];
                  $total_amt += $cart_packages_details['package']['grandtotal'] * $cart_packages_details['event']['currency']['conversion_rate']*$cart_packages_details['no_tickets'];
                  $total_fee += cal_percentage($fees, $cart_packages_details['package']['grandtotal'] * $cart_packages_details['event']['currency']['conversion_rate']*$cart_packages_details['no_tickets']);
                  ?>

                  <div class="row item_list align-items-center">

                    <div class="col-sm-4  col-4">
                      <input type="hidden" name="cartId" value="<?php echo $cart_packages_details['id']; ?>">
                      <p class="p_h"><?php echo ucwords(strtolower($cart_packages_details['event']['name'])); ?></p>
                      <!-- <span class="span_h"><?php //echo $cart_packages_details['package']['name']; 
                                                ?></span> -->
                    </div>

                    <div class="col-sm-3  col-3  ">
                      <p>
                        <?php
                        echo $cart_packages_details['no_tickets'].' X '.$cart_packages_details['event']['currency']['Currency_symbol']; ?>
                        <?php echo sprintf('%0.2f', $cart_packages_details['package']['grandtotal'] * $cart_packages_details['event']['currency']['conversion_rate']) . ' TTD'; ?>

                      </p>
                    </div>

                    <div class="col-sm-3  col-3  ">
                      <p>
                        <?php
                        echo $cart_packages_details['event']['currency']['Currency_symbol']; ?>
                        <?php echo cal_percentage($fees, $cart_packages_details['package']['grandtotal'] * $cart_packages_details['event']['currency']['conversion_rate']*$cart_packages_details['no_tickets']) . ' TTD'; ?>
                      </p>
                    </div>

                    <div class="col-sm-2  col-2 text-center ">
                      <a href="<?php echo SITE_URL; ?>cart/cartdelete/<?php echo $cart_packages_details['id']; ?>"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#e62d56" class="bi bi-trash" viewBox="0 0 16 16">
                          <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                          <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                        </svg></a>
                    </div>


                    <div class="row align-items-center mb-2">
                      <div class="col-sm-12">
                        <div class="multipal_Pack cart_pack">
                          <h6 class="event_Sub_Ad">Package ( <?php echo $cart_packages_details['package']['name']; ?> )</h6>

                          <div class="package_info">

                            <?php
                            // pr($packdet);exit;
                            foreach ($cart_packages_details['package']['packagedetails'] as $packdet) {
                            ?>
                              <p><?php echo $packdet['eventdetail']['title']; ?> (<?php echo $packdet['qty']; ?> Tickets)</p>
                            <?php } ?>
                          </div>

                          <!-- // Addons Type -->
                          <?php
                          $getAddons = $this->Comman->getPackageDetails($cart_packages_details['package_id']);
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
                            <h6><?php echo $cart_packages_details['package']['description']; ?></h6>

                          </div>
                        </div>

                      </div>
                    </div>

                  </div>

              <?php
                }
                $commaSeparatedIds = implode(',', $packageIds);
                // Show packages End
              }
            } else { ?>
              <div class="row item_list" style="text-align:center"> No Data in Cart </div>
            <?php } ?>

          </div>

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


          <hr>

          <?php if (!empty($addondata)) {
            $add_count = 1;
            foreach ($addondata as $event_id) {
              $addons_data = $this->Comman->getAddongroup($event_id['event_id']); ?>
              <?php if ($add_count  == 1 && !empty($addons_data)) { ?><h5>Addons</h5> <?php } ?>
              <div class="addons_item mb-3">
                <?php if (!empty($addons_data)) { ?>
                  <div class="row item_heading">

                    <div class="col-sm-6">
                      <p> Event: <?php echo ucwords(strtolower($event_id['event']['name'])); ?></p>
                    </div>
                    <div class="col-sm-4"></div>
                    <div class="col-sm-2"> </div>

                  </div>
                <?php }

                foreach ($addons_data as $alladdons) {  //pr($alladdons); die; 
                  $currency_get_form = $this->Comman->findeventdetail($alladdons['event_id']);
                  // pr($currency_get_form);exit;

                ?>
                  <div class="row item_list align-items-center">

                    <div class="col-sm-6">
                      <form action="<?php echo SITE_URL; ?>cart/addonsadd" method="post">
                        <p class="p_h">
                          <?php
                          //  if($currency_get_form['currency']['id']==1){
                          echo $alladdons['name']; ?>: <?php echo $currency_get_form['currency']['Currency_symbol']; ?><?php echo sprintf('%0.2f', $alladdons['price'] * $currency_get_form['currency']['conversion_rate']); ?> TTD<?php //echo $currency_get_form['currency']['Currency'];// }else{// echo $alladdons['name'];  
                                                                                                                                                                                                                                    ?>: <?php //echo$currency_get_form['currency']['Currency_symbol']; 
                                                                                                                                                                                                                                                                                                                                      ?><?php //echo sprintf('%0.2f', $alladdons['price']);  
                                                                                                                                                                                                                                                                                                                                                                                                      ?> <?php //echo $cart_value['event']['currency']['Currency'];  // } 
                                                                                                                                                                                                                                                                                                                                                                                                                                                              ?>

                        </p>
                        <span class="span_h"><?php echo $alladdons['description']; ?></span>
                    </div>

                    <div class="col-sm-4 item-center">
                      <!-- <label for="inputState" class="form-label">State</label> -->
                      <input type="hidden" name="event_id" value="<?php echo $alladdons['event_id']; ?>">
                      <input type="hidden" name="addon_id" value="<?php echo $alladdons['id']; ?>">
                      <select id="inputState" name="addon_count" class="form-select">
                        <option selected value="1">1</option>
                      </select>

                    </div>
                    <div class="col-sm-2 item-center">
                      <button class="btn add_btn" type="submit">
                        + Add
                      </button>
                      </form>
                    </div>


                  </div>
                <?php  } ?>

              </div>

          <?php $add_count++;
            }
          } ?>


        </div>
        <!-- <div class="col-md-1">
                  
                </div> -->
        <div class="col-md-4">
          <div class="total_items">
            <h4>Total: <?php echo count($cart_data) + count($cart_data_packages); ?> Items</h4>
            <div class="cart_price ">
              <p class="d-flex justify-content-between">Price <span> <?php echo $cart_value['event']['currency']['Currency_symbol']; ?><?php echo sprintf('%0.2f', $total_amt); ?></span></p>
              <hr>
              <p class="d-flex justify-content-between">Fee <span><?php echo $cart_value['event']['currency']['Currency_symbol']; ?><?php echo sprintf('%0.2f', $total_fee); ?></span></p>
              <hr>
              <h6 class="d-flex justify-content-between">Total <span><?php echo $cart_value['event']['currency']['Currency_symbol']; ?><?php echo sprintf('%0.2f', $total_amt + $total_fee); ?></span></h6>
            </div>
            <hr>
            <img class="img-pow" src="<?php echo SITE_URL; ?>images/Powered-by-FAC_web.png" alt="">
            <!-- <h4 class="mt-3">Choose Your Payment Method</h4> -->
            <!--  -->

            <div class="payment">
              <form class="row g-3" action="<?php echo SITE_URL; ?>cart/processingpayment" method="post" id="paymentForm">

                <input type="hidden" name="packageIds" value="<?php echo $commaSeparatedIds; ?>">
                <div class="col-md-12">
                  <input type="text" required placeholder="1234 5678 9012 3456" maxlength='16' name="cardnumber" class="form-control" id="card_number">
                </div>
                <div class="col-4">
                  <input type="text" required name="monthyear" class="form-control" placeholder="MM" maxlength="2" id="expiry_month">
                </div>
                <div class="col-4">
                  <input type="text" required name="expiry_year" class="form-control" placeholder="YY" maxlength="2" id="expiry_year">
                </div>
                <div class="col-4">
                  <input type="text" required name="cvv" class="form-control" maxlength="3" placeholder="CVV" maxlength="5" id="cvv">
                </div>
                <div class="col-md-12">
                  <input type="text" required name="holdername" class="form-control" id="name_on_card" placeholder="Card Holder Name">
                </div>
                <div class="col-12">
                  <input type="text" required readonly="readonly" name="totalamount" class="form-control" value="<?php echo sprintf('%0.2f', $total_amt + $total_fee); ?>" id="inputAddress" placeholder="Amount">
                </div>

                <div class="col-12">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck" required>
                    <label class="form-check-label" for="gridCheck">
                      Check this to indicate that you have read and agree to our <span><a href="<?php echo SITE_URL; ?>pages/terms-and-conditions" target="_blank">Terms and Conditions</a></span> & <span><a href="<?php echo SITE_URL; ?>pages/refund" target="_blank">Refund Policy.</a></span>
                    </label>
                  </div>
                </div>
                <div class="col-12">
                  <!-- <input type="button" id="cardSubmitBtn" value="Pay Now" class="payment-btn btn save"> -->
                  <button type="submit" id="cardSubmitBtn" class="btn save">Pay Now</button>
                </div>
              </form>
            </div>
            <!-- <div class="cardInfo"></div> -->

            <!-- ========================== -->

          </div>
        </div>

      </div>
    </div>

    <!-- ============================== -->

  </div>
</section>

<!-- ================================= -->



<script>
  function formatString(e) {
    var inputChar = String.fromCharCode(event.keyCode);
    var code = event.keyCode;
    var allowedKeys = [8];
    if (allowedKeys.indexOf(code) !== -1) {
      return;
    }

    event.target.value = event.target.value.replace(
      /^([1-9]\/|[2-9])$/g, '0$1/' // 3 > 03/
    ).replace(
      /^(0[1-9]|1[0-2])$/g, '$1/' // 11 > 11/
    ).replace(
      /^([0-1])([3-9])$/g, '0$1/$2' // 13 > 01/3
    ).replace(
      /^(0?[1-9]|1[0-2])([0-9]{2})$/g, '$1/$2' // 141 > 01/41
    ).replace(
      /^([0]+)\/|[0]+$/g, '0' // 0/ > 0 and 00 > 0
    ).replace(
      /[^\d\/]|^[\/]*$/g, '' // To allow only digits and `/`
    ).replace(
      /\/\//g, '/' // Prevent entering more than 1 `/`
    );
  }
</script>