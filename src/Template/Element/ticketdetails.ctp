<!-- Ticket timer -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flipclock/0.7.8/flipclock.css">
<!--  -->
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
                    <div class="timber">
                        <div class="clock"></div>
                    </div>
                </div>
            </div>

            <div class="col-md-7 ">
                <div class=" wow fadeInUp">
                    <div class="ticket_h">
                        <h3><?php echo ucwords(strtolower($event_get['name'])); ?></h3>
                        <h6>Hosted By <a href="#"><?php echo $event_get['company']['name']; ?></a></h6>
                    </div>

                    <div class="info">
                        <ul class="d-flex">

                            <li class="d-flex ">

                                <div>
                                    <h6>Date</h6><span><?php echo date('D dS M , Y', strtotime($event_get['date_from'])); ?></span>
                                </div>
                            </li>

                            <li class="d-flex ">
                                <div>
                                    <h6>Time</h6><span><?php echo date('h:i A', strtotime($event_get['date_from'])); ?> - <?php echo date('h:i A', strtotime($event_get['date_to'])); ?></span>
                                </div>
                            </li>
                            <li class="d-flex ">
                                <div>
                                    <h6>Location </h6><span><?php echo $event_get['location']; ?></span>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <hr>

                    <div class="ticket_dis">
                        <h4>Tickets</h4>
                        <p>
                            You have to name all your tickets below before you can print or download them.
                        </p>
                        <?php echo $this->Flash->render(); ?>
                        <span id="flash"></span>
                    </div>

                    <form action="<?php echo SITE_URL; ?>tickets/ticketdetails/<?php echo $event_get['id']; ?>" method="post">
                        <?php
                        if (!empty($findtickets)) {
                            foreach ($findtickets as $key => $value) { //pr($value);exit; 
                        ?>
                                <div class="form_detals mb-3" id="update_ticket">
                                    <div class="mt-2">
                                        <div class="row">


                                            <div class="d-flex mb-3">
                                                <span class="info_heading">Ticket Type</span>
                                                <span class="con-dest">:</span>
                                                <span class="info_contant"><strong><?php echo ucwords($value['ticket']['eventdetail']['title']); ?></strong></span>
                                            </div>

                                            <div class="d-flex mb-3">
                                                <?php if (!empty($value['questionbook'])) { ?>
                                                    <span class="info_heading">Answers</span>
                                                    <span class="con-dest">:</span>
                                                    <span class="info_contant">
                                                        <?php foreach ($value['questionbook'] as $andid => $questreply) { ?>
                                                            <?php echo $questreply['question']['question']; ?> : <?php echo $questreply['user_reply']; ?><br>
                                                        <?php } ?>
                                                    </span>
                                                <?php } ?>
                                            </div>
                                            <div class="col-sm-4"> <label for="exampleInputEmail1" class="form-label">Ticket Holder Name</label></div>
                                            <div class="col-sm-8">
                                                <input type="text" <?php echo ($event_get['is_free'] == 'Y') ? 'readonly' : ''; ?> name="name[]" required class="form-control" value="<?php echo $value['name']; ?>" id="ticketname_save<?php echo $value['id']; ?>" placeholder="Enter Full Name" aria-describedby="emailHelp">
                                                <input type="hidden" name="tid[]" value="<?php echo $value['id']; ?>">
                                            </div>
                                        </div>

                                    </div>
                                    <hr>
                                    <div class=" d-flex justify-content-end mb-2">

                                        <?php
                                        $request_rsvp =  date("Y-m-d H:i:s A", strtotime($event_get['request_rsvp']));
                                        $startTime = date("Y-m-d H:i:s A");

                                        if (!empty($value['name']) && $request_rsvp >= $startTime) { ?>
                                            <a class="printtickets down" style="margin-top: 0px;" href="<?php echo SITE_URL; ?>tickets/generatetic/<?php echo $value['id']; ?>/<?php echo str_replace(' ', '_', $value['ticket']['eventdetail']['title']); ?>" title="Download">Print ticket</a>

                                        <?php } else if ($event_get['is_free'] == 'N') { ?>
                                            <a href="javascript:void(0)" class="btn btn subtn ms-2" onclick="savename('<?php echo $value['id']; ?>')">Save Name</a>
                                        <?php }
                                        if ($event_get['is_free'] == 'Y') { ?>
                                            <a href="javascript:void(0)" <?php echo ($value['is_rsvp'] == 'N') ? 'style="  background-color: orange;"' : 'style="background-color: red;"'; ?> class="btn btn subtn ms-2" onclick="enablersvp('<?php echo $value['id'] . '/' . $value['is_rsvp']; ?>')"><?php echo ($value['is_rsvp'] == 'N') ? 'Accept' : 'Decline'; ?> RSVP</a>
                                        <?php } ?>
                                    </div>
                                </div>

                            <?php } ?>
                    </form>

                <?php } else {  ?>
                    <center>No tickets available</center>
                <?php  } ?>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).on('click', '.printtickets', function(e) {
        $('#Ticketgenerate').modal('show').find('.modal-body').html('<h6 style="color:red;">Loading....Please Wait</h6>');
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
                if (status) {
                    $("#update_ticket").load(" #update_ticket > *", function() {});
                    $('.preloader').hide();
                    $('#flash').html(`<div class="alert alert-${status} alert-dismissible fade show" role="alert"> ${newData.message}.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>`);
                } else {

                    $("#update_ticket").load(" #update_ticket > *", function() {});
                    $('.preloader').hide();
                    $('#flash').html(`<div class="alert alert-success alert-dismissible fade show" role="alert"> ${newData}.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>`);
                }

            }
        });
    }
</script>

<div class="modal fade" id="Ticketgenerate">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">View Ticket</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>
<!-- -------------------------------- -->