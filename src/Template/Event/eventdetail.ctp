<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" type="text/css"> -->
<!-- ---------------------------------------- -->
<?php
$this->set('title', $event['name']);
$this->set('description', strip_tags($event['desp']));
$this->set('image', IMAGE_PATH . 'eventimages/' . $event['feat_image']);
$id = $event['id'];
// pr($authEmail);exit;
?>
<section id="ticker_sec">
    <div class="container">
        <div class="row">

            <div class="col-md-6">
                <div class="ticker_img fadeInLeft">
                    <?php //pr($event);  
                    ?>
                    <div class="ticker_imgmn wow fadeInLeft">
                        <img src="<?php echo IMAGE_PATH . 'eventimages/' . $event['feat_image']; ?>" alt="img">
                    </div>
                    <img class="event_bg" src="<?php echo IMAGE_PATH; ?>detals-bg.png" alt="img">
                    <div class="social mt-4 d-flex social_bg">
                        <h5 class="">Share With Friends</h5>
                        <ul class="list-inline social_ul">
                            <li class="list-inline-item">
                                <a href="https://www.facebook.com/sharer.php?u=<?php echo SITE_URL; ?>event/<?php echo $event['slug']; ?>" target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="https://twitter.com/share?url=<?php echo SITE_URL; ?>event/<?php echo $event['slug']; ?>&text=<?php echo $event['name']; ?>" target="_blank">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="mailto:?subject=Ebox Tickets: <?php echo $event['name']; ?>&body=Check out this event: <?php echo SITE_URL; ?>event/<?php echo $event['slug']; ?>&title=Share by Email" target="_blank">
                                    <!-- <i class="fab fas fa-envelope"></i> -->
                                    <i class="fa-solid fa-envelope"></i>
                                    <!-- <i class="fab fa-envelope"></i> -->
                                </a>
                            </li>
                            <!-- <li class="list-inline-item">
                                <a href="#">
                                  <i class="fab fa-instagram"></i>
                                </a>
                              </li>
                              <li class="list-inline-item">
                                <a href="#" target="_blank">
                                  <i class="fab fa-google-plus-g"></i>
                                </a>
                              </li> -->
                            <!-- <li class="list-inline-item">
                              <a href="#" target="_blank">
                                <i class="fab fa-linkedin-in"></i>
                              </a>
                            </li> -->
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <?php echo $this->Form->create($event, array('class' => 'form-horizontal', 'id' => 'sevice_form', 'enctype' => 'multipart/form-data', 'url' => array('controller' => 'cart', 'action' => 'buyticket'))); ?>
                <div class=" wow fadeInUp">
                    <div class="ticket_h">
                        <!-- <h1>History</h1> -->
                        <input type="hidden" name="event_id" value="<?php echo $id; ?>">
                        <h3><?php echo ucwords(strtolower($event['name'])); ?></h3>
                        <h6>Hosted By <a href="#"><?php echo $event['company']['name']; ?></a></h6>
                        <div class="heading-border-line left-style"></div>
                    </div>
                    <div class="info">
                        <ul class="d-flex">
                            <li class="flex-fill" style="width:inherit !important">
                                <div>
                                    <h6><i class="fa-solid fa-calendar-days"></i> Start Date</h6>
                                    <span style="text-align:left;">
                                        <?php echo date('D, dS M Y', strtotime($event['date_from'])); ?> |
                                        <?php echo date('h:i A', strtotime($event['date_from'])); ?>
                                    </span>
                                </div>
                            </li>
                            <li class="flex-fill" style="width:inherit !important">
                                <div>
                                    <h6><i class="fa-solid fa-calendar-days"></i> End Date</h6>
                                    <span style="text-align:left;">
                                        <?php echo date('D, dS M Y', strtotime($event['date_to'])); ?> |
                                        <?php echo date('h:i A', strtotime($event['date_to'])); ?>
                                    </span>
                                </div>
                            </li>
                            <!-- <li class="d-flex ">
                              <div>
                                  <h6>Time</h6><span><?php //echo date('h:i A', strtotime($event_get['date_from']));
                                                        ?>
                                  - <?php //echo date('h:i A', strtotime($event_get['date_to']));
                                    ?></span>
                              </div>
                          </li> -->
                            <li class="flex-fill" style="width:inherit !important">
                                <div>
                                    <h6><i class="fa-solid fa-location-dot"></i> Location </h6>
                                    <span style="text-align:left;"><?php echo ucwords($event['location']); ?></span>
                                </div>
                            </li>
                        </ul>

                        <?php /*  
                        <ul class="d-flex">
                          <li class="d-flex ">
                            <!-- <i class="fas fa-phone-alt mr-1 mr-2"></i> -->
                            <div>
                              <h6>Date</h6>
                              <span><?php echo date('D, dS M Y', strtotime($event['date_from'])); ?></span>
                        <br>
                        <span><?php echo date('D, dS M Y', strtotime($event['date_to'])); ?></span>
                    </div>
                    </li>
                    <li class="d-flex ">
                        <!-- <i class="fas fa-map-marker-alt mr-1 mr-2"></i> -->
                        <div>
                            <h6>Time</h6><span><?php echo date('h:i A', strtotime($event['date_from'])); ?> -
                                <?php echo date('h:i A', strtotime($event['date_to'])); ?></span>
                        </div>
                    </li>
                    <li class="d-flex ">
                        <!-- <i class="fas fa-map-marker-alt mr-1 mr-2"></i> -->
                        <div>
                            <h6>Location </h6>
                            <span><?php echo ucwords($event['location']); ?> </span>
                        </div>
                    </li>
                    </ul>
                    */ ?>
                    </div>

                    <!-- <div class="countdown">
             <div id="title">
              <h4>Countdown For Event</h4>
            </div>
            <div id="countdown"></div>
            <p id="note"></p>
            <div id="title">
              <h1 class="text-center">Timer Countdown</h1>
            </div>
            <div id="countdown"></div>
            <p id="note"></p>
          </div> -->

                    <!-- <div class="countdown">
            <div id="title">
              <h5 class="mt-4 event_Sub_h">Countdown For Event</h5>
            </div>
            <div id="countdown" class="countdownHolder"><span class="countDays"><span class="position"> <span class="digit static" style="top: 0px; opacity: 1;">0</span> </span> <span class="position"> <span class="digit static" style="top: 0px; opacity: 1;">9</span> </span></span><span class="countDiv countDiv0"></span><span class="countHours"><span class="position"> <span class="digit static" style="top: 0px; opacity: 1;">2</span> </span> <span class="position"> <span class="digit static" style="top: 0px; opacity: 1;">2</span> </span></span><span class="countDiv countDiv1"></span><span class="countMinutes"><span class="position"> <span class="digit static" style="top: 0px; opacity: 1;">2</span> </span> <span class="position"> <span class="digit static" style="top: 0px; opacity: 1;">7</span> </span></span><span class="countDiv countDiv2"></span><span class="countSeconds"><span class="position"> <span class="digit static" style="top: 0px; opacity: 1;">2</span> </span> <span class="position"> <span class="digit static" style="top: 0px; opacity: 1;">3</span> </span></span></div>
            <p id="note">9 days, 22 hours, 27 minutes and 23 seconds <br>left to 10 days from now!</p>

          </div> -->

                    <!-- <div class="countdown">
            <div id="title">
              <h4>Countdown For Event</h4>
            </div>
            <div id="countdown"></div>
            <p id="note"></p>

          </div> -->
                    <?php if ($event['status'] == 'N') { ?>
                        <div class="alert alert-danger mt-2" role="alert">
                            Event not yet Published
                        </div>
                    <?php } else if ($event['admineventstatus'] == 'N') { ?>
                        <div class="alert alert-danger mt-2" role="alert">
                            Event approval Pending
                        </div>
                    <?php } elseif ($event['is_free'] == 'Y') { ?>
                        <div class="alert alert-danger mt-2" role="alert">
                            This is an invite only Event.
                        </div>
                    <?php
                    } else { ?>
                        <h5 class="event_Sub_h">Tickets</h5>
                    <?php }
                    $cartcount = $this->Comman->findcartcount($this->request->session()->read('Auth.User.id'), $id);
                    // pr($cartcount);exit;

                    if (!empty($cartcount)) {
                        $total_ticket_data = $event['ticket_limit'] - $cartcount;
                    } else {
                        $total_ticket_data =  $event['ticket_limit'] - $totalticket['sum'];
                    }

                    ?>
                    <?php if ($event['is_free'] == 'N') { ?>
                        <p class="event_pra">The maximum number of tickets one account is allowed to purchase is
                            <?php echo $event['ticket_limit']; ?>. You have <span class="tickets-left"><?php echo  $total_ticket_data; ?></span> more tickets left.</p>
                    <?php } ?>

                    <?php echo $this->Flash->render(); ?>

                    <p class="ticket_limit_over sufee-alert alert with-close alert-danger alert-dismissible fade show">You
                        are only allowed <?php echo $event['ticket_limit']; ?> tickets for this event. You have no tickets
                        left.</p>

                    <div class="form-group ticket_all">
                        <ul>
                            <?php
                            $date = date("Y-m-d H:i:s");
                            $sale_end = date('Y-m-d H:i:s', strtotime($event['sale_end']));

                            if (!empty($event_ticket_type) && (strtotime($sale_end) >= strtotime($date))) {
                                foreach ($event_ticket_type as $key => $ticket_type) {
                                    $ticketsalecount = $this->Comman->ticketsalecount($ticket_type['eventid'], $ticket_type['id']);
                            ?>
                                    <?php if ($ticket_type['sold_out'] == 'N') {
                                    ?>
                                        <li class="list-item-none">
                                            <div class="row align-items-center">
                                                <div class="col-sm-6 col-4 price-name">
                                                    <h6><?php echo $ticket_type['title']; ?></h6>
                                                </div>

                                                <?php if ($ticket_type['type'] == 'open_sales' && $ticket_type['count'] - $ticketsalecount['ticketsold'] == 0) { ?>

                                                    <div class="col-sm-6 col-8  price-details">
                                                        <span class="sold_out"><?php echo $event['currency']['Currency_symbol']; ?><?php echo sprintf('%0.2f', $ticket_type['price']); ?>
                                                            <?php echo $event['currency']['Currency']; ?> <span class="s_out">Sold
                                                                Out</span> </span>
                                                    </div>

                                                <?php } else { ?>

                                                    <div class="col-sm-6 col-8 price-details">
                                                        <div class="row align-items-center">
                                                            <div class="col-6  d-flex align-items-center justify-content-end">
                                                                <span class="price"><?php echo $event['currency']['Currency_symbol']; ?><?php echo sprintf('%0.2f', $ticket_type['price']); ?>
                                                                    <?php echo $event['currency']['Currency']; ?></span>
                                                            </div>
                                                            <?php $ticketname = $ticket_type['title'];
                                                            $ticket_name = str_replace(" ", "_", $ticket_type['title']);

                                                            ?>
                                                            <div class="col-6 ">
                                                                <select id="<?php echo $ticket_name; ?>" name="ticket_count[<?php echo $ticket_type['id']; ?>]" class="form-select tickets rooms <?php if ($ticket_type['type'] == "committee_sales") {
                                                                                                                                                                                                        echo "commiteesalesticket";
                                                                                                                                                                                                    } ?>" data-val="<?php echo $ticket_type['title']; ?>" onchange="render_question(this.value,'<?php echo $ticket_name; ?>');">
                                                                    <option value="0">0</option>
                                                                    <?php for ($x = 1; $x <= $event['ticket_limit']; $x++) { ?>
                                                                        <option value="<?php echo $x; ?>"><?php echo $x; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                <?php  } ?>


                                            </div>

                                        </li>

                                    <?php } else { ?>
                                        <li class="list-item-none">
                                            <div class="row align-items-center">
                                                <div class="col-sm-6 price-name">
                                                    <h6><?php echo $ticket_type['title']; ?></h6>
                                                </div>

                                                <div class="col-sm-6 price-details">
                                                    <span class="sold_out"><?php echo $event['currency']['Currency_symbol']; ?>
                                                        <?php echo sprintf('%0.2f', $ticket_type['price']); ?>
                                                        <?php echo $event['currency']['Currency']; ?> Sold Out</span>
                                                </div>

                                            </div>

                                        </li>

                                    <?php } ?>

                                <?php }
                            } else { ?>

                            <?php }  ?>


                            <!-- //    <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<  Package Start >>>>>>>>>>>>>>>>>>>>>>>>>>>>> -->

                            <h5 class="event_Sub_h">Package</h5>
                            <?php if (!empty($package_type) && (strtotime($sale_end) >= strtotime($date))) {
                                foreach ($package_type as $package_id => $package_details) {
                                    // pr($package_details);exit;
                                    // Ticket counts check 
                                    $packagesalecount = $this->Comman->packagesalecount($package_details['id']);
                            ?>

                                    <li class="list-item-none">
                                        <div class="row align-items-center">

                                            <div class="col-sm-6 col-4 price-name">
                                                <h6><?php echo $package_details['name']; ?></h6>
                                            </div>

                                            <?php if ($package_details['package_limit'] - $packagesalecount == 0) { ?>

                                                <div class="col-sm-6 col-8  price-details">
                                                    <span class="sold_out">

                                                        <?php echo $event['currency']['Currency_symbol']; ?><?php echo sprintf('%0.2f', $package_details['grandtotal']); ?>
                                                        <?php echo $event['currency']['Currency']; ?>
                                                        <span class="s_out">Sold Out</span>

                                                    </span>
                                                </div>

                                            <?php } else { ?>

                                                <div class="col-sm-6 col-8 price-details">
                                                    <div class="row align-items-center">
                                                        <div class="col-6 d-flex align-items-center justify-content-end">
                                                            <span class="price"><?php echo $event['currency']['Currency_symbol']; ?><?php echo sprintf('%0.2f', $package_details['grandtotal']); ?>
                                                                <?php echo $event['currency']['Currency']; ?></span>
                                                        </div>
                                                        <?php
                                                        $packageName = str_replace(" ", "_", $package_details['name']);

                                                        ?>
                                                        <div class="col-6 ">
                                                            <select id="<?php echo $packageName; ?>" name="package_details[<?php echo $package_details['id']; ?>]" class="form-select rooms packages" data-val="<?php echo $package_details['name']; ?>" onchange="packageHandler(this.value,'<?php echo $package_details['id']; ?>');">
                                                                <option value="0">0</option>
                                                                <?php for ($x = 1; $x <= $event['ticket_limit']; $x++) { ?>
                                                                    <option value="<?php echo $x; ?>"><?php echo $x; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>
                                            <?php  } ?>


                                        </div>

                                        <!--  -->
                                        <div class="row align-items-center">
                                            <div class="col-sm-12">
                                                <div class="multipal_Pack">

                                                    <div class="package_info">
                                                        <?php foreach ($package_details['packagedetails'] as $packagedetailsKey => $packdet) { ?>

                                                            <p><?php echo $packdet['eventdetail']['title']; ?> (<?php echo $packdet['qty']; ?> Tickets)</p>

                                                        <?php } ?>
                                                    </div>
                                                    <?php
                                                    // <!-- Addons Type  -->
                                                    $getAddons = $this->Comman->getPackageDetails($package_details['id']);
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
                                                        <h6><?php echo $package_details['description']; ?> </h6>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <!--  -->

                                    </li>

                            <?php  }
                            } ?>


                            <div class="package_main_div">
                                <h5 class="event_Sub_h">Message</h5>
                                <p class="event_pra">You can write a short message to the event organizer member as part of your request to purchase package. You have 500 characters remaining</p>

                                <div class="mb-3">
                                    <textarea class="form-control" id="package_descriptions" rows="3" name="package_descriptions" placeholder="Enter your message" maxlength="500" spellcheck="true"></textarea>
                                </div>

                            </div>
                            <!-- //    <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<  Package End  >>>>>>>>>>>>>>>>>>>>>>>>>>>>> -->
                        </ul>
                    </div>

                    <script>
                        $(document).ready(function() {
                            $(".ticket_limit_over").hide();
                            $("#submit_button").hide();
                            $("#register_login").hide();
                            $(".package_main_div").hide();

                        });

                        // committee ticket 
                        $('select').on('change', function() {

                            $("#submit_button").show();
                            $("#submit_button").val('Request & Buy Now');

                            $("#register_login").show();
                            var total = 0;
                            var limit = "<?php echo $total_ticket_data; ?>";

                            var tickets = $('.rooms');
                            var tickets_hidden = $('.ticket-count-hidden');
                            for (var i = 0; i < tickets.length; i++) {
                                total += $(tickets[i]).val() * 1;
                                $(tickets_hidden[i]).val($(tickets[i]).val());
                            }


                            if (total > limit) {
                                $(".ticket_limit_over").show();
                                $(".ticket_limit_over").text("You are only allowed <?php echo $event['ticket_limit']; ?> tickets for this event. You have no tickets left.");
                                $("#submit_button").hide();

                            } else if (total == 0) {
                                $('.tickets-left').text(limit);
                                $(".ticket_limit_over").hide();
                                $("#submit_button").hide();

                            } else {
                                $('.tickets-left').text(limit - total);
                                $(".ticket_limit_over").hide();
                                $("#submit_button").show();
                                $("#submit_button").val('Request & Buy Now');

                                $("#register_login").show();
                                // submit_button
                            }

                            var arr = $('select.commiteesalesticket').map(function() {
                                return this.value
                            }).get();
                            let text = arr.toString();
                            var array = text.split(",");
                            committee = 0;
                            $.each(array, function(i) {
                                if (array[i] != 0) {
                                    committee = 1;
                                }
                                if (committee == 1) {
                                    $(".committee").css("display", "block");
                                    $("#submit_button").val('Request & Buy Now');
                                    $('.committee:visible').find('select').prop("required", true);
                                } else {
                                    $("#submit_button").val('Buy Now');
                                    $('.committee:hidden').find('select').prop("required", false);

                                    $(".committee").css("display", "none");
                                }
                            });

                        });

                        // package related code here 
                        function packageHandler(selectedValue, ticketId) {
                            $(".package_main_div").show();
                            var limit = "<?php echo $total_ticket_data; ?>";
                            var packageDetails = $('.packages');
                            let totalSelectedPackage = 0;
                            for (var j = 0; j < packageDetails.length; j++) {
                                totalSelectedPackage += $(packageDetails[j]).val() * 1;
                            }
                            // console.log('totalSelectedPackage', totalSelectedPackage);

                            if (totalSelectedPackage > 0) {
                                $(".tickets").attr("disabled", true);
                            } else {
                                $(".tickets").attr("disabled", false);
                                $(".package_main_div").hide();

                            }

                            if (totalSelectedPackage > limit) {
                                $(".ticket_limit_over").show();
                                $(".ticket_limit_over").text("You are only allowed <?php echo $event['ticket_limit']; ?> packages for this event. You have no packages left.");
                                $("#submit_button").hide();
                                $('.tickets-left').text(limit);

                            } else if (totalSelectedPackage == 0) {
                                $('.tickets-left').text(limit);
                                $(".ticket_limit_over").hide();
                                $("#submit_button").hide();

                            } else {
                                $('.tickets-left').text(limit - totalSelectedPackage);
                                $(".ticket_limit_over").hide();
                                $("#submit_button").show();
                                $("#submit_button").val('Request & Buy Now');
                                $("#register_login").show();
                                // submit_button
                            }


                        }


                        // function render_question(quevalue, ticketname) {

                        //     var htmlclone = $(".question_" + ticketname).html();
                        //     $("#question_" + ticketname + "_clone").html('');
                        //     //$("#question_"+ticketname+"_clone").empty().append(htmlclone);
                        //     num = 1;
                        //     var all_q = 0;
                        //     $(".rooms option:selected").each(function() {
                        //         if ($(this).val() > 0) {
                        //             all_q = 1;
                        //         }
                        //         if (all_q == 1) {
                        //             $(".question").css("display", "block");
                        //         } else {
                        //             $(".question").css("display", "none");
                        //         }
                        //     });


                        //     var ticketDetails = $('.rooms');
                        //     let totalSelectedPackage = 0;
                        //     for (var j = 0; j < ticketDetails.length; j++) {
                        //         totalSelectedPackage += $(ticketDetails[j]).val() * 1;
                        //     }

                        //     if (totalSelectedPackage > 0) {
                        //         $(".packages").attr("disabled", true);
                        //     } else {
                        //         $(".packages").attr("disabled", false);
                        //     }


                        //     if (quevalue == 0) {
                        //         $(".eventquestion_" + ticketname).css("display", "none");
                        //         $(".eventquestion_" + ticketname + ':hidden').find('select').prop("required", false);
                        //     } else {
                        //         $(".eventquestion_" + ticketname + ':hidden').find('select').prop("required", true);
                        //         $(".eventquestion_" + ticketname).css("display", "block");
                        //     }


                        //     if (quevalue > 1) {

                        //         var length = quevalue - 1;
                        //         for (i = num; i <= length; i++) {

                        //             var lastid = $(".questioncount_" + ticketname + ":last").attr("id");
                        //             var sublastid = $(".subquestioncount_" + ticketname + ":last").attr("id");

                        //             $("#question_" + ticketname + "_clone").append(htmlclone);
                        //             var result = lastid.split('-');
                        //             var dd = parseInt((result[1])) + 1;
                        //             var ddfff = "room-" + dd;
                        //             $(".questioncount_" + ticketname + ":last").attr('id', ddfff);
                        //             $(".questioncount_" + ticketname + ":last").text(dd);

                        //             var resultsub = sublastid.split('-');
                        //             var ddsub = parseInt((resultsub[1])) + 1;
                        //             var ddfffsub = "subquestion-" + ddsub;
                        //             $(".subquestioncount_" + ticketname + ":last").attr('id', ddfffsub);

                        //             var ddfffclass = "question" + ticketname + "_" + dd + "[]";
                        //             $("#" + ddfffsub + " .subquestion_" + ticketname).attr('name', ddfffclass);

                        //             var ddfffclassddd = "questionid" + ticketname + "_" + dd + "[]";
                        //             $("#" + ddfffsub + " .subquestionid_" + ticketname).attr('name', ddfffclassddd);

                        //         }


                        //     }

                        // }

                        function render_question(quevalue, ticketname) {
                            $(".package_main_div").hide();

                            // Clone the HTML of the question element
                            const questionElement = $(".question_" + ticketname);
                            const questionHtml = questionElement.html();

                            // Clear out the clone container
                            const questionCloneContainer = $("#question_" + ticketname + "_clone");
                            questionCloneContainer.empty();

                            // Determine whether to show or hide the question element based on the selected rooms
                            let showQuestions = false;
                            $(".rooms option:selected").each(function() {
                                if ($(this).val() > 0) {
                                    showQuestions = true;
                                }
                            });
                            $(".question").css("display", showQuestions ? "block" : "none");

                            // Determine whether to disable or enable the packages based on the number of selected rooms
                            const ticketDetails = $('.rooms');
                            let totalSelectedPackage = 0;
                            for (let i = 0; i < ticketDetails.length; i++) {
                                totalSelectedPackage += $(ticketDetails[i]).val() * 1;
                            }
                            $(".packages").attr("disabled", totalSelectedPackage > 0);

                            // Show or hide the event question based on the selected value
                            const eventQuestionElement = $(".eventquestion_" + ticketname);
                            if (quevalue == 0) {
                                eventQuestionElement.css("display", "none");
                                eventQuestionElement.find('select').prop("required", false);
                            } else {
                                eventQuestionElement.css("display", "block");
                                eventQuestionElement.find('select').prop("required", true);
                            }

                            // Add additional question elements if necessary
                            if (quevalue > 1) {
                                const length = quevalue - 1;
                                for (let i = 1; i <= length; i++) {

                                    // Clone the question element and update the IDs
                                    const newQuestionHtml = questionHtml.replace(/questioncount_\w+-\d+/g, "room-" + (questionCloneContainer.children().length + 1));
                                    const newSubquestionHtml = newQuestionHtml.replace(/subquestion_\w+/g, "subquestion-" + (questionCloneContainer.children().length + 1));
                                    questionCloneContainer.append(newSubquestionHtml);

                                    // Update the names of the cloned subquestion elements
                                    const newQuestionIndex = questionCloneContainer.children().length;
                                    const subquestionElement = $("#" + "subquestion-" + newQuestionIndex);
                                    subquestionElement.find('.subquestion_' + ticketname).attr('name', `question${ticketname}_${newQuestionIndex}[]`);
                                    subquestionElement.find('.subquestionid_' + ticketname).attr('name', `questionid${ticketname}_${newQuestionIndex}[]`);
                                }
                            }
                        }


                        $(document).ready(function() {
                            $('#sevice_form').submit(function(event) {

                                $("#submit_button").attr("disabled", true);

                            });
                        });
                    </script>

                    <!-- Question section start ----->
                    <?php $user_id = $this->request->session()->read('Auth.User.id');
                    if (!empty($user_id)) { ?>
                        <div class="question" style="display:none;">
                            <?php
                            if (!empty($event_ticket_type)) {
                                $ic = 1;
                                foreach ($event_ticket_type as $key => $ticket_type) { //pr($ticket_type); 
                                    $ticket_name = str_replace(" ", "_", $ticket_type['title']);
                            ?>
                                    <?php $find_question_data = $this->Comman->findquestion($ticket_type['eventid'], $ticket_type['id']);
                                    // pr($find_question_data);

                                    ?>
                                    <?php if ($ic == 1) { ?>
                                        <?php if (!empty($find_question_data)) { ?>
                                            <h5 class="event_Sub_h">Questions</h5>
                                            <p class="event_pra">The ticket type you selected requires you to answer a few questions below.</p>
                                        <?php } ?>
                                    <?php } ?>
                                    <div class="<?php echo "eventquestion_" . $ticket_name; ?>" style="display:none">

                                        <?php if (!empty($find_question_data)) { ?>
                                            <h6 class="ticket_TH"><?php echo $ticket_type['title']; ?></h6>
                                            <div class="<?php echo "question_" . $ticket_name; ?>">
                                                <p>Attendee #<span class="<?php echo "questioncount_" . $ticket_name; ?>" id="room-1">1</span></p>
                                                <div class="<?php echo "subquestioncount_" . $ticket_name; ?>" id="subquestion-1">
                                                    <?php $ques = 1;

                                                    foreach ($find_question_data as $find_question_value) { ?>
                                                        <!-- <form class="form_bg" action=""> -->
                                                        <div class="row mb-3">
                                                            <label for="inputName" class="col-sm-5 col-6 col-form-label"><?php echo $find_question_value['question']; ?></label>
                                                            <?php $find_question_items = $this->Comman->findquestionitems($find_question_value['id']); ?>

                                                            <div class="col-sm-7 col-6">
                                                                <input type="hidden" class="subquestionid_<?php echo $ticket_name; ?>" name="questionid<?php echo $ticket_name; ?>_1[]" value="<?php echo $find_question_value['id']; ?>">
                                                                <?php if ($find_question_value['type'] == "Select") { ?>
                                                                    <select id="inputState" class="form-select subquestion_<?php echo $ticket_name; ?>" name="question<?php echo $ticket_name; ?>_1[]">
                                                                        <option value="">Choose One</option>
                                                                        <?php foreach ($find_question_items as $find_question_value) { ?>
                                                                            <option value="<?php echo $find_question_value['items']; ?>">
                                                                                <?php echo $find_question_value['items']; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                <?php } ?>
                                                                <?php if ($find_question_value['type'] == "Multiple") { ?>
                                                                    <select id="inputState" class="form-select subquestion_<?php echo $ticket_name; ?>" name="question<?php echo $ticket_name; ?>_1[]" multiple>
                                                                        <?php foreach ($find_question_items as $find_question_value) { ?>
                                                                            <option value="<?php echo $find_question_value['items']; ?>">
                                                                                <?php echo $find_question_value['items']; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                <?php } ?>

                                                                <?php if ($find_question_value['type'] == "Text") { ?>
                                                                    <input type="text" class="form-control subquestion_<?php echo $ticket_name; ?>" name="question<?php echo $ticket_name; ?>_1[]">
                                                                <?php } ?>

                                                                <?php if ($find_question_value['type'] == "Agree") { ?>
                                                                    <div class="form-group form-check">
                                                                        <input type="checkbox" value="Agree" class="form-check-input subquestion_<?php echo $ticket_name; ?>" id="exampleCheck1" name="question<?php echo $ticket_name; ?>_1[]">
                                                                        <label class="form-check-label" for="exampleCheck1">Agree</label>
                                                                    </div>
                                                                <?php } ?>
                                                            </div>
                                                        </div>

                                                    <?php $ques++;
                                                    }
                                                    ?>
                                                </div>

                                            </div>
                                        <?php } ?>
                                        <div id="<?php echo "question_" . $ticket_name . "_clone"; ?>"></div>
                                    </div>
                            <?php $ic++;
                                }
                            } ?>

                        </div>
                        <!-- Question section end ----->
                    <?php } ?>
                    <?php if (!empty($user_id)) { ?>
                        <?php if (!empty($event_ticket_type)) {
                        ?>
                            <?php $find_commitee_data = $this->Comman->findcommittee($ticket_type['eventid'], $ticket_type['id']); ?>
                            <?php if ($find_commitee_data) { ?>
                                <div class="committee" style="display:none;">
                                    <h5 class="event_Sub_h">Committee</h5>
                                    <p class="event_pra">The ticket you selected is private and requires you to request your ticket from
                                        a committee member</p>
                                    <form action="">
                                        <select id="inputState" class="form-select" name="commitee_user_id">
                                            <option value="">--Select a Committee Member--</option>
                                            <?php foreach ($committe_user as $committe_value) {
                                            ?>
                                                <option value="<?php echo $committe_value['user']['id']; ?>" <?php if ($committe_value['user']['id'] == $selectedcommitte_user) {
                                                                                                                    echo "selected";
                                                                                                                } ?>>
                                                    <?php echo ucfirst(strtolower($committe_value['user']['name'])) . ' ' . ucfirst(strtolower($committe_value['user']['lname'])); ?>
                                                </option>

                                            <?php  } ?>
                                        </select>
                                    </form>
                                </div>


                                <div class="committee" style="display:none;">
                                    <h5 class="event_Sub_h">Message</h5>
                                    <p class="event_pra">You can write a short message to the committee member as part of your request
                                        to purchase tickets. You have 140 characters remaining</p>

                                    <div class="mb-3">

                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="commitee_message" maxlength="140"></textarea>
                                    </div>

                            <?php }
                        } ?>
                                </div>
                            <?php } ?>

                            <div class="view_btn">
                                <?php if ($this->request->session()->read('Auth.User.id')) { ?>
                                    <input type="submit" class="btn btn-primary" value="" id="submit_button">
                                <?php } else { ?>
                                    <a id="register_login" class="nav-link site_c" href="<?php echo SITE_URL; ?>login">
                                        <span class="te_btn">Login / Register</span>
                                    </a>
                                <?php } ?>
                            </div>

                            <h5 class="event_Sub_h">Description</h5>
                            <div class="event_desp">
                                <?php echo $event['desp']; ?>
                            </div>

                            <hr style="margin:10px 0px;">

                            <?php if ($event['allow_register'] == 'Y') { ?>
                                <!-- Button trigger modal -->
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <?php echo $dis = ($authid) ? 'Download Ticket' : 'Register now'; ?>
                                    </button>
                                </div>
                            <?php } ?>

                </div>
            </div>
        </div>
    </div>
    <?php echo $this->Form->end(); ?>
</section>
<!-- self registration for free event Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Self Registration</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data" accept-charset="utf-8" class="form-horizontal" id="selfregister" autocomplete="off" action="<?php echo SITE_URL; ?>event/selfregistration">
                    <section id="rsigin">

                        <div class="form_contant mt-0">

                            <div class="contact_form newuserform">
                                <!-- <h3 id="empemval" style="text-align: center;">Register Now</h3> -->

                                <div class="form-group">
                                    <input type="hidden" name="event_id" value="<?php echo $id; ?>">
                                    <input type="hidden" id="checknew" name="isnew">
                                    <input type="hidden" id="countrycode" name="countrycode">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control exist formvalidation m-0 mb-2" name="fname" placeholder="First Name*" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control exist formvalidation m-0 mb-2" name="lname" placeholder="Last Name*" required>
                                        </div>
                                    </div>

                                    <input type="email" class="form-control onkeyup m-0 mb-2" name="email" id="inputEmail1" placeholder="Email*" required>


                                    <input type="password" class="form-control exist formvalidation" name="password" placeholder="Password*" minlength="8" required>


                                    <div class="row align-items-center exist formvalidation">

                                        <div class="col-sm-4">

                                            <?php
                                            echo $this->Form->input(
                                                'country_id',
                                                ['empty' => '--Country--', 'options' => $country, 'required' => 'required', 'class' => 'form-select formvalidation m-0 mb-2 checkmobile', 'label' => false, 'id' => 'countryy']
                                            ); ?>

                                        </div>

                                        <div class="col-sm-8">
                                            <div class="input-group">

                                                <span class="input-group-text m-0 mb-2" id="inputGroupPrepend">

                                                </span>
                                                <?php
                                                echo $this->Form->input(
                                                    'mobile',
                                                    ['required' => 'required', 'type' => 'text', 'class' => 'form-control formvalidation m-0 mb-2 checkmobile', 'placeholder' => '479XXXXX', 'min' => '15', 'max' => '15', 'label' => false, 'pattern' => '[0-9]*'] // regular expression to match numbers only]
                                                );  ?>

                                            </div>
                                        </div>



                                    </div>

                                    <!-- <input type="number" class="form-control exist formvalidation m-0 mb-2" name="mobile" placeholder="+1868XXXXXXX" required> -->
                                </div>

                                <div class="row align-items-center">

                                    <label for="inputEmail3" class="col-sm-4 form-label mb-0">Position</label>
                                    <div class="col-sm-8">
                                        <!-- <div class="col-sm-12" id="positionchange"> -->
                                        <input type="text" class="form-control  m-0 mb-2" name="position" placeholder="Position*" required>

                                    </div>
                                </div>


                                <div class="row align-items-center">
                                    <label for="inputEmail3" class="col-sm-4 form-label mb-0">Divisions</label>
                                    <div class="col-sm-8">
                                        <input type="radio" name="divisions" class="" required value="IRD" style="vertical-align:-1px;">
                                        <label for="inputEmail3" class="col-form-label me-3">IRD</label>
                                        <input type="radio" name="divisions" class="" value="CED" style="vertical-align:-1px;">
                                        <label for="inputEmail3" class="col-form-label">CED</label>
                                    </div>
                                </div>


                                <div class="row align-items-center exist formvalidation">
                                    <label for="inputEmail3" class="col-sm-4 form-label mb-0">Gender</label>
                                    <div class="col-sm-8">
                                        <input type="radio" name="gender" class="formvalidation" value="male" checked="checked" style="vertical-align:-1px;">
                                        <label for="inputEmail3" class="col-form-label me-3">Male</label>
                                        <input type="radio" name="gender" class="formvalidation" value="female" style="vertical-align:-1px;">
                                        <label for="inputEmail3" class="col-form-label">Female</label>
                                    </div>
                                </div>

                                <div class="row align-items-center exist">
                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Date of Birth</label>
                                    <div class="col-sm-8">
                                        <input type="date" class="form-control formvalidation m-0 mb-2" name="dob" required value="2000-01-01">
                                    </div>
                                </div>


                                <div class="row align-items-center mt-2">
                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Choose Date</label>
                                    <div class="col-sm-8">

                                        <select class="form-select" aria-label="Default select example" name="choosedate" required>
                                            <option value="" selected disabled>--Select Date--</option>
                                            <?php
                                            // Convert the from and to dates to DateTime objects
                                            $dateFrom = new DateTime($event['date_from']);
                                            $dateTo = new DateTime($event['date_to']);

                                            // Loop over the range of dates and generate an option element for each date
                                            $interval = new DateInterval('P1D'); // Interval of 1 day
                                            $dateRange = new DatePeriod($dateFrom, $interval, $dateTo);
                                            foreach ($dateRange as $date) {
                                                $value = $date->format('d-m-Y'); // Format the date as YYYY-MM-DD
                                                $label = $date->format('l jS F Y'); // Format the date as "Weekday Day Month Year"
                                                echo '<option value="' . $value . '">' . $label . '</option>';
                                            }
                                            ?>
                                        </select>

                                    </div>
                                </div>

                                <!-- Information And Discussion Session fro this evet -->
                                <?php if ($event['id'] == '137') { ?>
                                    <div class="row align-items-center mt-2">
                                        <div for="inputEmail3" class="col-sm-4 col-form-label">Time Slot-1</div>
                                        <div class="col-sm-8">
                                            <input type="radio" name="timeslot" required class="" value="8:00 AM – 10:00 AM" style="vertical-align:-1px;">
                                            <label for="inputEmail3" class="col-form-label me-3">8:00 AM – 10:00 AM</label>
                                        </div>
                                    </div>

                                    <div class="row align-items-center  mt-1">
                                        <div for="inputEmail3" class="col-sm-4 col-form-label">Time Slot-2</div>
                                        <div class="col-sm-8">
                                            <input type="radio" name="timeslot" class="" value="10:00 AM – 12:00 NOON" style="vertical-align:-1px;">
                                            <label for="inputEmail3" class="col-form-label me-3">10:00 AM – 12:00 NOON</label>
                                        </div>
                                    </div>

                                    <div class="row align-items-center  mt-1">
                                        <div for="inputEmail3" class="col-sm-4 col-form-label">Time Slot-3</div>
                                        <div class="col-sm-8">
                                            <input type="radio" name="timeslot" class="" value="1:00 PM – 3:00 PM" style="vertical-align:-1px;">
                                            <label for="inputEmail3" class="col-form-label me-3">1:00 PM – 3:00 PM</label>
                                        </div>
                                    </div>

                                <?php  } else { ?>

                                    <div class="row align-items-center mt-2">
                                        <div for="inputEmail3" class="col-sm-4 col-form-label">Time Slot-1</div>
                                        <div class="col-sm-8">
                                            <input type="radio" name="timeslot" required class="" value="9:00 AM – 11:00 AM" style="vertical-align:-1px;">
                                            <label for="inputEmail3" class="col-form-label me-3">9:00 AM – 11:00 AM</label>
                                        </div>
                                    </div>

                                    <div class="row align-items-center  mt-1">
                                        <div for="inputEmail3" class="col-sm-4 col-form-label">Time Slot-2</div>
                                        <div class="col-sm-8">
                                            <input type="radio" name="timeslot" class="" value="1:00 PM – 3:00 PM" style="vertical-align:-1px;">
                                            <label for="inputEmail3" class="col-form-label me-3">1:00 PM – 3:00 PM</label>
                                        </div>
                                    </div>

                                    <div class="row align-items-center  mt-1">
                                        <div for="inputEmail3" class="col-sm-4 col-form-label">Time Slot-3</div>
                                        <div class="col-sm-8">
                                            <input type="radio" name="timeslot" class="" value="3:00 PM – 5:00 PM" style="vertical-align:-1px;">
                                            <label for="inputEmail3" class="col-form-label me-3">3:00 PM – 5:00 PM</label>
                                        </div>
                                    </div>
                                <?php } ?>

                            </div>

                            <div class="form_checkb d-flex align-items-start mt-3">
                                <input type="checkbox" class="exist formvalidation" name="termscheck" required>
                                <p class="chack_cont second" style="font-size:12px;">By Creating An Account You
                                    Agree To Our <span><a target="_blank" href="<?php echo SITE_URL; ?>pages/privacy-policy" style="color:#3d6db5;">Privacy
                                            Policy</a></span> and Accept Our <span> <a target="_blank" href="<?php echo SITE_URL; ?>pages/terms-and-conditions" style="color:#3d6db5;">Terms and
                                            Conditions.</a></span></p>
                            </div>
                            <button type="submit" class="btn reg subtn rticket-btn">Register</button>
                            <!-- <a href="#" class="btn btn subtn rticket-btn">Download Ticket</a> -->
                            <!-- <hr> -->
                </form>
            </div>
        </div>

    </div>
    </section>
</div>

</div>
</div>
</div>
<!--  -->

<!-- get country code  -->
<script type="text/javascript">
    $('#countryy').bind('change', function() {

        $('#mobile').val("");
        $.ajax({
            async: true,
            type: 'post',
            success: function(data) {
                obj = JSON.parse(data);
                // console.log(obj);
                if (obj === null) {
                    $('#inputGroupPrepend').text('');
                } else {
                    $('#inputGroupPrepend').text(obj.words);
                    $('#countrycode').val(obj.words);

                }

            },
            url: "<?php echo SITE_URL; ?>users/getcountrycode",
            data: $('#countryy').serialize()
        })
    })



    // check mobile number exist
    $(".checkmobile").on("change", function(event) {
        var mobile = $('#mobile').val();
        var countryy = $('#countryy').val();

        if (!mobile) {
            console.log('Mobile number is empty');
            return;
        }

        if (!/^\d+$/.test(mobile)) {
            alert('Please enter only numbers');
            $('#mobile').val("");
            return;
        }

        if (!countryy) {
            // console.log('Country is empty');
            return;
        }

        var countrycode = $('#inputGroupPrepend').text().trim();

        if (countrycode && mobile) {
            let mobileWithcountrycode = countrycode + mobile;
            // console.log(mobileWithcountrycode);

            $.ajax({
                type: 'POST',
                url: '<?php echo SITE_URL; ?>/users/userdata',
                data: {
                    mobile: mobileWithcountrycode
                },
                success: function(data) {
                    obj = JSON.parse(data);
                    if (obj.mobile === true) {
                        $('#exampleModalLabel').text('Mobile number is already exist.').css({
                            'color': 'red'
                        });
                        $(".rticket-btn").prop('disabled', true);
                    } else {
                        $('#exampleModalLabel').text('Self Registration.').css({
                            'color': 'black'
                        });
                        $(".rticket-btn").prop('disabled', false);
                    }
                }

            });
        } else {
            console.log('Invalid mobile number or missing country code');
        }

    });
</script>


<!-- Self registration for free event  -->
<script>
    $(document).ready(function() {

        var auth = '<?php echo $dis = ($authid) ? true : false; ?>';
        if (auth) {
            $(".exist").css("display", "none");
            $(".second").css("display", "none");
            $(".reg").html('Download Ticket');
            $('.formvalidation').attr('required', false);
            $('#exampleModalLabel').text('You are already a member of eboxtickets.').css({
                'color': 'black'
            });
            $('#checknew').val('already');
            $('#inputEmail1').val('<?php echo $authEmail; ?>');
        }
        $('#checknew').val('new');
        // var timeout = null;

        $(".onkeyup").on("change", function(event) {

            // clearTimeout(timeout);
            // timeout = setTimeout(() => {
            var email = $('#inputEmail1').val();
            $.ajax({
                type: 'POST',
                url: '<?php echo SITE_URL; ?>/users/userdata',
                data: {
                    email: email
                },
                success: function(data) {
                    obj = JSON.parse(data);
                    if (obj.email.id) {
                        $(".exist").css("display", "none");
                        $(".second").css("display", "none");
                        $(".reg").html('Download Ticket');
                        $('.formvalidation').attr('required', false);
                        $('#exampleModalLabel').text('You are already a member of eboxtickets.').css({
                            'color': 'black'
                        });
                        $('#checknew').val('already');
                        $(".rticket-btn").prop('disabled', false);
                        $("#positionchange").removeClass("col-sm-6").addClass("col-sm-12");
                    } else {
                        $('.formvalidation').attr('required', true);
                        $('.reg').text('Register');
                        $(".exist").css("display", "flex");
                        $(".second").css("display", "block");
                        $('#exampleModalLabel').text('Self Registration.').css({
                            'color': 'black'
                        });
                        $('#checknew').val('new');
                        $("#positionchange").removeClass("col-sm-12").addClass("col-sm-6");
                        // document.getElementById("empform").submit();
                    }
                }

            });
            // }, 1500);

        });

        $(function() {
            $('#selfregister').on('submit', function(e) { //use on if jQuery 1.7+
                $('.preloader').show();

            });
        });

    });
</script>