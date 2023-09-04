<?php $getdata = $this->Comman->countreq($user_id);?>
<section id="Committee">
    <div class="container">

        <div class="heading">
            <h1>Committee</h1>
            <h2>Committee</h2>
            <p class=" text-center mb-4">If you belong to any committees for events on eboxtickets, you can manage
                ticket requests here.</p>
        </div>
        <?php echo $this->element('committeeheader'); ?>

        <div class="row mt-4">

            <?php if (!empty($ticketstype)) {
                foreach ($ticketstype as $key => $value) {
            ?>
            <div class="col-md-6 col-sm-12">
                <a href="<?php echo SITE_URL; ?>committee/ticketdetails/<?php echo $value['event']['id']; ?>"
                    class="committeeEventTile">
                    <div class="inner_box">
                        <div class="row align-items-center">
                            <div class="col-sm-4 col-12">
                                <div class="img_size">
                                    <img class="event_img"
                                        src="<?php echo IMAGE_PATH; ?>eventimages/<?php echo $value['event']['feat_image']; ?>"
                                        alt="">
                                </div>
                            </div>
                            <div class="col-sm-8 col-12 count">
                                <h5><?php echo ucwords($value['event']['name']); ?></h5>
                                <p>@ <?php echo $value['event']['location']; ?> </p>

                                <div class="event_time">
                                    <p class="mb-0 time"><i class="fa-solid fa-calendar-days"></i>
                                        <strong>Start Date</strong>
                                        <span
                                            style="display: inline-block; width: 10px; color: #333; font-weight: 700;">:</span>

                                        <?php echo  date('D, d M Y', strtotime($value['event']['date_from'])); ?>
                                        |
                                        <?php echo date('h:i A', strtotime($value['event']['date_from'])); ?>
                                    </p>
                                    <p class="mb-0 time"><i class="fa-solid fa-calendar-days"></i>
                                        <strong>End Date</strong>
                                        <span
                                            style="display: inline-block; width: 10px; color: #333; font-weight: 700;">:</span>

                                        <?php echo  date('D, d M Y', strtotime($value['event']['date_to'])); ?> |
                                        <?php echo date('h:i A', strtotime($value['event']['date_to'])); ?>
                                    </p>
                                    <!-- <h4 class="date">
                                            <?php //echo date('D dS', strtotime($value['event']['date_from'])); ?>
                                            <span class="date_m"><?php //echo date('F', strtotime($value['event']['date_from'])); ?></span>
                                        </h4> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <?php }
            } ?>
        </div>
    </div>
</section>