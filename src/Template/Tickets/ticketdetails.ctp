<!-- Ticket timer -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flipclock/0.7.8/flipclock.css">
<!--  -->

<style>
    #countdown {
        text-align: center;
        min-width: 225px;
    }

    #countdown ul li {
        list-style: none;
        width: max-content;
        text-align: center;
        font-family: Arial;
        font-size: 10px;
        font-weight: bold;
        color: rgb(74, 83, 98);
        padding: 5px;
    }

    #countdown ul {
        padding-left: 0rem;
        display: inline-block;
        border: 2px dashed #fe9809;
        padding: 5px;
        margin-top: 20px;

    }


    #countdown h1 {
        font-weight: normal;
        letter-spacing: .125rem;
        text-transform: uppercase;
    }

    #countdown li {
        display: inline-block;
        font-size: 1.5em;
        list-style-type: none;
        padding: 1em;
        text-transform: uppercase;
    }

    li span {
        display: block;
        font-size: 20px;
        font-size: 28px;
        text-align: center;
        font-weight: bold;
        font-style: normal;
        color: rgb(240, 171, 0);
    }

    .emoji {
        display: none;
        padding: 1rem;
    }

    .emoji span {
        font-size: 4rem;
        padding: 0 .5rem;
    }

    @media all and (max-width: 768px) {
        h1 {
            font-size: calc(1.5rem * var(--smaller));
        }

        li {
            font-size: calc(1.125rem * var(--smaller));
        }

        li span {
            font-size: calc(3.375rem * var(--smaller));
        }
    }
</style>

<section class="ticketdetails" id="ticker_sec">
    <div class="heading ">
        <h1>Ticket</h1>
        <h2>Ticket Details</h2>
    </div>
    <div class="container">
        <div class="row mt-5">

            <div class="col-md-5 ">
                <div class="about_img fadeInLeft">
                    <div class="about_imgmn wow fadeInLeft">
                        <img src="<?php echo IMAGE_PATH . 'eventimages/' . $event_get['feat_image'] ?>" alt="img">
                    </div>
                    <!-- <div class="timber">
                        <div class="clock"></div>
                    </div> -->

                    <div id="content" class="emoji">
                    </div>
                </div>
            </div>

            <div class="col-md-7 ">
                <div class=" wow fadeInUp">
                    <div class="ticket_h d-flex justify-content-between">
                        <div class="flex-fill pe-2">
                            <h3><?php echo ucwords(strtolower($event_get['name'])); ?></h3>
                            <h6>Hosted By <a href="#"><?php echo $event_get['company']['name']; ?></a></h6>
                        </div>

                        <div id="countdown">
                            <ul class="mt-0">
                                <li><span id="days"></span>days</li>
                                <li><span id="hours"></span>Hours</li>
                                <li><span id="minutes"></span>Minutes</li>
                                <li><span id="seconds"></span>Seconds</li>
                            </ul>
                        </div>
                    </div>
                    <div class="info">
                        <ul class="d-flex">
                            <li class="flex-fill" style="width:inherit !important">
                                <div>
                                    <h6><i class="fa-solid fa-calendar-days"></i> Start Date</h6>
                                    <span style="text-align:left;">
                                        <?php echo date('D dS M , Y', strtotime($event_get['date_from'])); ?> |
                                        <?php echo date('h:i A', strtotime($event_get['date_from'])); ?>
                                    </span>
                                </div>
                            </li>
                            <li class="flex-fill" style="width:inherit !important">
                                <div>
                                    <h6><i class="fa-solid fa-calendar-days"></i> End Date</h6>
                                    <span style="text-align:left;">
                                        <?php echo date('D dS M , Y', strtotime($event_get['date_to'])); ?> |
                                        <?php echo date('h:i A', strtotime($event_get['date_to'])); ?>
                                    </span>
                                </div>
                            </li>
                            <!-- <li class="d-flex ">
                                <div>
                                    <h6>Location </h6><span><?php //echo $event_get['location'];
                                                            ?></span>
                                </div>
                            </li> -->
                            <li class="flex-fill" style="width:inherit !important">
                                <div>
                                    <h6><i class="fa-solid fa-location-dot"></i> Location </h6>
                                    <span style="text-align:left;"><?php echo $event_get['location']; ?></span>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- <hr> -->
                    <div class="ticket_dis mt-3">
                        <h4><?php echo ($findtickets[0]['package_id'] != '') ? "Package" : "Tickets"; ?></h4>
                        <p>
                            You have to name all your tickets below before you can print or download them.
                        </p>
                        <?php echo $this->Flash->render(); ?>
                        <span id="flash"></span>
                    </div>

                    <!-- For Package show here  -->
                    <?php


                    if ($allPackagesWithData != '' && $isPackage) { ?>

                        <form action="<?php echo SITE_URL; ?>tickets/ticketdetails/<?php echo $event_get['id']; ?>" method="post">
                            <?php
                            if (!empty($allPackagesWithData)) {
                                foreach ($allPackagesWithData as $packageName => $value) { //pr($value);exit; 
                            ?>
                                    <div class="event-tipe2 mb-3">

                                        <?php foreach ($value as $keyid => $value2) { ?>

                                            <script>
                                                let isAccepted = '<?php echo $value2['is_rsvp']; ?>';
                                            </script>

                                            <div class="form_detals " id="update_ticket">
                                                <div class="mt-2">
                                                    <div class="row">
                                                        <div class="d-flex mb-3">
                                                            <span class="info_heading">Ticket Type</span>
                                                            <span class="con-dest">:</span>
                                                            <span class="info_contant"><strong><?php echo ucwords($value2['ticket']['eventdetail']['title']); ?> (<?php echo $packageName; ?>)</strong></span>
                                                        </div>

                                                        <div class="d-flex mb-3">
                                                            <span class="info_heading">Purchase Date</span>
                                                            <span class="con-dest">:</span>
                                                            <span class="info_contant"><strong><?php echo date('D, d M Y | h:i A', strtotime($value2['created'])); ?></strong></span>
                                                        </div>

                                                        <div class="d-flex mb-3">
                                                            <span class="info_heading">Location</span>
                                                            <span class="con-dest">:</span>
                                                            <span class="info_contant"><strong><?php echo ucwords(strtolower($event_get['location'])); ?></strong></span>
                                                        </div>

                                                        <div class="d-flex mb-3">
                                                            <span class="info_heading">Ticket Holder Name</span>
                                                            <span class="con-dest">:</span>
                                                            <!-- <div class="col-sm-8"> -->

                                                            <span class="info_contant holder-name d-flex">

                                                                <input type="text" <?php echo ($event_get['is_free'] == 'Y') ? 'readonly' : ''; ?> name="name[]" required class="form-control" value="<?php echo $value2['name']; ?>" id="ticketname_save<?php echo $value2['id']; ?>" placeholder="Enter Full Name" aria-describedby="emailHelp">
                                                                <input type="hidden" name="tid[]" value="<?php echo $value2['id']; ?>">

                                                                <div class="">

                                                                    <?php
                                                                    $request_rsvp =  date("Y-m-d H:i:s", strtotime($event_get['request_rsvp']));
                                                                    $startTime = date("Y-m-d H:i:s");

                                                                    if (!empty($value2['name'])  && $value2['is_rsvp'] == 'Y') { ?>
                                                                        <a class="printtickets down ms-2" style="" href="<?php echo SITE_URL; ?>tickets/generatetic/<?php echo $value2['id']; ?>/<?php echo str_replace(' ', '_', $value2['ticket']['eventdetail']['title']); ?>" title="Download">Print ticket</a>

                                                                    <?php } else if (!empty($value2['name']) && $event_get['is_free'] == 'N') { ?>

                                                                        <a class="printtickets down ms-2" style="" href="<?php echo SITE_URL; ?>tickets/generatetic/<?php echo $value2['id']; ?>/<?php echo str_replace(' ', '_', $value2['ticket']['eventdetail']['title']); ?>" title="Download">Print ticket</a>

                                                                    <?php } else if ($event_get['is_free'] == 'Y' && $value2['is_rsvp'] == 'N' && $request_rsvp >= $startTime) { ?>
                                                                        <a href="javascript:void(0)" <?php echo ($value2['is_rsvp'] == 'N') ? 'style="  background-color: orange;"' : 'style="background-color: red;"'; ?> class="btn btn subtn ms-2" onclick="enablersvp('<?php echo $value2['tid'] . '/0'; ?>')"><?php echo ($value2['is_rsvp'] == 'N') ? 'Accept' : 'Decline'; ?>
                                                                            RSVP</a>
                                                                    <?php }
                                                                    if (empty($value2['name'])) { ?>
                                                                        <a href="javascript:void(0)" class="btn btn subtn ms-2" onclick="savename('<?php echo $value2['id']; ?>')">Save Name</a>
                                                                    <?php } ?>
                                                                </div>
                                                            </span>
                                                        </div>
                                                    </div>

                                                </div>

                                                <hr>

                                            </div>
                                        <?php   }

                                        // $pac = $this->Comman->packageDetails($value['package_id']);
                                        ?>

                                        <!-- For addons  -->
                                        <?php
                                        $adoons = $this->Comman->getPackageDetails($value[0]['package_id']);
                                        foreach ($adoons as $addonKye => $adoonValue) { ?>

                                            <div class="form_detals " id="update_ticket">
                                                <!-- <div class="mt-2"> -->
                                                <div class="row">
                                                    <div class="d-flex mb-3">
                                                        <span class="info_heading">Addons</span>
                                                        <span class="con-dest">:</span>
                                                        <span class="info_contant"><strong><?php echo $adoonValue['addon']['name']; ?></strong></span>
                                                    </div>

                                                </div>

                                                <!-- </div> -->
                                            </div>


                                        <?php
                                        }
                                        ?>

                                    </div>

                                <?php } ?>


                                <!-- ---------------------------------------------------------------
                        ------------------------------------------------------------------------------------- -->
                                <!-- <div class="event-tipe2 mb-3"> -->


                                <!-- <div class="form_detals " id="update_ticket">
                                    <div class="mt-2">
                                        <div class="row">
                                            <div class="d-flex mb-3">
                                                <span class="info_heading">Ticket Type</span>
                                                <span class="con-dest">:</span>
                                                <span class="info_contant"><strong>Male (Testing Package)</strong></span>
                                            </div>

                                            <div class="d-flex mb-3">
                                                <span class="info_heading">Purchase Date</span>
                                                <span class="con-dest">:</span>
                                                <span class="info_contant"><strong>Sat, 06 May 2023 | 08:20 AM</strong></span>
                                            </div>

                                            <div class="d-flex mb-3">
                                                <span class="info_heading">Location</span>
                                                <span class="con-dest">:</span>
                                                <span class="info_contant"><strong>Goa</strong></span>
                                            </div>
                                            <div class="d-flex mb-2">

                                                <span class="info_heading">Answers</span>
                                                <span class="con-dest">:</span>
                                                <span class="info_contant"><strong>
                                                        3333333333333333333333333333333</strong>
                                                </span>

                                            </div>
                                            <div class="d-flex mb-3">
                                                <span class="info_heading">Ticket Holder Name</span>
                                                <span class="con-dest">:</span>

                                                <span class="info_contant holder-name d-flex">
                                                    <input type="text" class="form-control" placeholder="Name">
                                                    <div class="">

                                                        <a href="javascript:void(0)" class="btn btn subtn ms-2">Save Name</a>

                                                    </div>

                                                </span>
                                            </div>
                                        </div>

                                    </div>

                                    <hr>

                                </div> -->


                                <!-- For addons  -->
                                <!-- <div class="form_detals " id="update_ticket">
                                    <div class="mt-2">
                                        <div class="row">
                                            <div class="d-flex mb-3">
                                                <span class="info_heading">Addons</span>
                                                <span class="con-dest">:</span>
                                                <span class="info_contant"><strong>Male (Testing Package)</strong></span>
                                            </div>

                                            <div class="d-flex mb-3">
                                                <span class="info_heading">Purchase Date</span>
                                                <span class="con-dest">:</span>
                                                <span class="info_contant"><strong>Sat, 06 May 2023 | 08:20 AM</strong></span>
                                            </div>

                                        </div>

                                    </div>
                                </div> -->

                                <!-- </div> -->


                                <!-- -----------------------------------------------------------------------
                    -------------------------------------------------------------------------------------------- -->

                        </form>

                    <?php } else {  ?>
                        <center>No Package available</center>
                    <?php  } ?>

                <?php   } else { ?>

                    <!-- For Normal Tickets -->

                    <form action="<?php echo SITE_URL; ?>tickets/ticketdetails/<?php echo $event_get['id']; ?>" method="post">
                        <?php
                        if (!empty($findtickets)) {
                            foreach ($findtickets as $key => $value) {
                                // pr($value);exit;
                        ?>
                                <script>
                                    let isAccepted = '<?php echo $value['is_rsvp']; ?>';
                                </script>

                                <div class="form_detals mb-3" id="update_ticket">
                                    <div class="mt-2">
                                        <div class="row">
                                            <div class="d-flex mb-3">
                                                <span class="info_heading">Ticket Type</span>
                                                <span class="con-dest">:</span>
                                                <span class="info_contant"><strong><?php echo ucwords($value['ticket']['eventdetail']['title']); ?></strong></span>
                                            </div>
                                            <?php if ($event_get['is_free'] == 'Y') { ?>
                                                <div class="d-flex mb-3">
                                                    <span class="info_heading">Status</span>
                                                    <span class="con-dest">:</span>
                                                    <span class="info_contant"><strong><?php echo ($value['is_rsvp'] == 'N') ? 'Not Attending' : 'Attending'; ?></strong></span>
                                                </div>

                                                <div class="d-flex mb-3">
                                                    <span class="info_heading">Invitation Date</span>
                                                    <span class="con-dest">:</span>
                                                    <span class="info_contant"><strong><?php echo date('D, d M Y | h:i A', strtotime($value['created'])); ?></strong></span>
                                                </div>
                                            <?php } else { ?>
                                                <div class="d-flex mb-3">
                                                    <span class="info_heading">Purchase Date</span>
                                                    <span class="con-dest">:</span>
                                                    <span class="info_contant"><strong><?php echo date('D, d M Y | h:i A', strtotime($value['created'])); ?></strong></span>
                                                </div>

                                            <?php } ?>
                                            <div class="d-flex mb-3">
                                                <span class="info_heading">Location</span>
                                                <span class="con-dest">:</span>
                                                <span class="info_contant"><strong><?php echo ucwords(strtolower($event_get['location'])); ?></strong></span>
                                            </div>
                                            <div class="d-flex mb-2">
                                                <?php if (!empty($value['questionbook'])) { ?>
                                                    <span class="info_heading">Answers</span>
                                                    <span class="con-dest">:</span>
                                                    <span class="info_contant">
                                                        <?php foreach ($value['questionbook'] as $andid => $questreply) { ?>
                                                            <?php echo $questreply['question']['question']; ?> :
                                                            <?php echo $questreply['user_reply']; ?><br>
                                                        <?php } ?>
                                                    </span>
                                                <?php } ?>
                                            </div>
                                            <div class="d-flex mb-3">
                                                <span class="info_heading">Ticket Holder Name</span>
                                                <span class="con-dest">:</span>
                                                <!-- <div class="col-sm-8"> -->
                                                <span class="info_contant">
                                                    <input type="text" <?php echo ($event_get['is_free'] == 'Y') ? 'readonly' : ''; ?> name="name[]" required class="form-control" value="<?php echo $value['name']; ?>" id="ticketname_save<?php echo $value['id']; ?>" placeholder="Enter Full Name" aria-describedby="emailHelp">
                                                    <input type="hidden" name="tid[]" value="<?php echo $value['id']; ?>">
                                                </span>
                                            </div>
                                        </div>

                                    </div>

                                    <hr>
                                    <div class=" d-flex justify-content-end mb-2">

                                        <?php
                                        $request_rsvp =  date("Y-m-d H:i:s", strtotime($event_get['request_rsvp']));
                                        $startTime = date("Y-m-d H:i:s");

                                        if (!empty($value['name'])  && $value['is_rsvp'] == 'Y') { ?>
                                            <a class="printtickets down" style="margin-top: 0px;" href="<?php echo SITE_URL; ?>tickets/generatetic/<?php echo $value['id']; ?>/<?php echo str_replace(' ', '_', $value['ticket']['eventdetail']['title']); ?>" title="Download">Print ticket</a>

                                        <?php } else if (!empty($value['name']) && $event_get['is_free'] == 'N') { ?>

                                            <a class="printtickets down" style="margin-top: 0px;" href="<?php echo SITE_URL; ?>tickets/generatetic/<?php echo $value['id']; ?>/<?php echo str_replace(' ', '_', $value['ticket']['eventdetail']['title']); ?>" title="Download">Print ticket</a>

                                        <?php } else if ($event_get['is_free'] == 'Y' && $value['is_rsvp'] == 'N' && $request_rsvp >= $startTime) { ?>
                                            <a href="javascript:void(0)" <?php echo ($value['is_rsvp'] == 'N') ? 'style="  background-color: orange;"' : 'style="background-color: red;"'; ?> class="btn btn subtn ms-2" onclick="enablersvp('<?php echo $value['tid'] . '/0'; ?>')"><?php echo ($value['is_rsvp'] == 'N') ? 'Accept' : 'Decline'; ?>
                                                RSVP</a>
                                        <?php }
                                        if (empty($value['name'])) { ?>
                                            <a href="javascript:void(0)" class="btn btn subtn ms-2" onclick="savename('<?php echo $value['id']; ?>')">Save Name</a>
                                        <?php } ?>
                                    </div>
                                </div>

                            <?php } ?>
                    </form>

                <?php } else {  ?>
                    <center>No tickets available</center>
                <?php  } ?>



            <?php  } ?>


                </div>
            </div>

        </div>
    </div>
</section>
<script>
    $(document).on('click', '.printtickets', function(e) {
        $('#Ticketgenerate').modal('show').find('.modal-body').html(
            '<h6 style="color:red;">Loading....Please Wait</h6>');
        e.preventDefault();
        $('#Ticketgenerate').modal('show').find('.modal-body').load($(this).attr('href'));
    });


    function savename(id) {
        $('.preloader').show();
        const delay = (delayInms) => {
            return new Promise(resolve => setTimeout(resolve, delayInms));
        }
        var ticket_holdername = $('#ticketname_save' + id).val();
        // alert(ticket_holdername); die;
        $.ajax({
            type: 'POST',
            url: '<?php echo SITE_URL; ?>/tickets/savesingleticketname',
            data: {
                'ticket_id': id,
                'ticketholdername': ticket_holdername,
            },
            success: async function(data) {
                let delayres = await delay(1000);
                location.reload();
            }
        });
    }

    //enable rsvp
    function enablersvp(id) {
        $('.preloader').show();
        $.ajax({
            type: 'POST',
            url: '<?php echo SITE_URL; ?>/tickets/isrsvp',
            data: {
                'ticket_id': id,
            },
            success: async function(data) {
                let newData = (JSON.parse(data));
                let status = newData.status;
                console.log(newData);
                if (status) {
                    $("#update_ticket").load(" #update_ticket > *", function() {});
                    $('.preloader').hide();
                    $('#flash').html(
                        `<div class="alert alert-${status} alert-dismissible fade show" role="alert"> ${newData.message}.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>`
                    );
                } else {
                    $("#countdown").hide();
                    $("#update_ticket").load(" #update_ticket > *", function() {});
                    $('.preloader').hide();
                    $('#flash').html(
                        `<div class="alert alert-success alert-dismissible fade show" role="alert"> ${newData}.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>`
                    );
                }

            }
        });
    }
</script>

<script>
    let isFree = '<?php echo ($event_get['is_free'] == 'Y') ? true : false; ?>';
    let rsvp_deadline = null;

    if (isFree) {
        rsvp_deadline = '<?php echo date("Y-m-d H:i:s", strtotime($event_get['request_rsvp'])); ?>';
        console.log(rsvp_deadline);
    } else {
        rsvp_deadline = '<?php echo date("Y-m-d H:i:s", strtotime($event_get['date_from'])); ?>';
    }

    if (isAccepted == 'N') {
        const second = 1000,
            minute = second * 60,
            hour = minute * 60,
            day = hour * 24;

        let today = new Date();
        let diff = new Date(rsvp_deadline).getTime() / 1000 - today.getTime() / 1000;

        dd = String(today.getDate()).padStart(2, "0");
        mm = String(today.getMonth() + 1).padStart(2, "0");
        yyyy = today.getFullYear();

        const countDown = new Date(rsvp_deadline).getTime(),
            myInterval = setInterval(function() {
                const now = new Date().getTime(),
                    distance = countDown - now;
                document.getElementById("days").innerText = Math.floor(distance / (day));
                document.getElementById("hours").innerText = Math.floor((distance % (day)) / (hour));
                document.getElementById("minutes").innerText = Math.floor((distance % (hour)) / (minute));
                document.getElementById("seconds").innerText = Math.floor((distance % (minute)) / second);

                //do something later when date is reached
                if (distance < 0) {
                    document.getElementById("days").innerText = 0,
                        document.getElementById("hours").innerText = 0,
                        document.getElementById("minutes").innerText = 0,
                        document.getElementById("seconds").innerText = 0;
                    if (isFree) {
                        $('#flash').html(
                            `<div class="alert alert-danger alert-dismissible fade show" role="alert">The time has elapsed to Accept the RSVP Invitation<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>`
                        );
                        $("#countdown").hide();
                    }
                    if (isFree == false) {
                        $("#countdown").hide();
                    }
                    clearInterval(myInterval);
                }
            }, 1000);
    } else {
        $("#countdown").hide();
    }


    // console.log(x);
</script>

<div class="modal fade" id="Ticketgenerate">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- <div class="modal-header">
                <h5 class="modal-title">View Ticket</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div> -->
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>
<!-- -------------------------------- -->