<?php foreach ($event  as $eventvalue) {     ?>

    <?php /*   <div class="month">
        <h4><?php echo date('M', strtotime($eventvalue['date_to'])); ?></h4>
    </div>

    <div class="event-list-container" id="Mycity">
        <?php $event_month =  date('m', strtotime($eventvalue['date_to']));
        ?>
        <?php $event_data = $this->Comman->eventfind($event_month, $eventsearch); ?>
        <?php foreach ($event_data as $key => $value) { ?>

            <div class="up_events">
                <a href="<?php echo SITE_URL; ?>event/<?php echo $value['slug']; ?>">
                    <div class="inner_box">
                        <div class="row d-flex align-items-center justify-content-center">
                            <div class="col-lg-2 col-md-3 col-sm-3 col-12 image_event  ">
                                <img class="event_img" src="<?php echo IMAGE_PATH . 'eventimages/'; ?><?php echo $value['feat_image'] ?>" alt="">
                            </div>
                            <div class="col-lg-8 col-md-6 col-sm-6 col-12 detals-eve">
                                <div class="event_contant">
                                    <h4 class="time"><?php echo date('h:i A', strtotime($value['date_from'])); ?> - <?php echo date('h:i A', strtotime($value['date_to'])); ?></h4>
                                    <h3 class="title"><?php echo ucwords(strtolower($value['name'])); ?></h3>
                                    <h4 class="author-info"> <?php echo substr($value['desp'], 0, 30); ?> </h4>
                                    <span>Hosted By <?php echo $value['company']['name']; ?></span><br>
                                    <span> @ <?php echo $value['country']['CountryName']; ?> </span>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-3 col-sm-3 col-12 timing ">
                                <div class="event_Date">


                                    <h2><?php echo date('d', strtotime($value['date_from'])); ?>
                                        <span class="date_m"><?php echo date('M', strtotime($value['date_from'])); ?></span>

                                    </h2>
                                    <!-- <h6><?php //echo date('M', strtotime($value['date_from'])); 
                                                ?></h6> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

        <?php } ?>


    </div>

    */ ?>

    <div class="month">
        <h4><?php echo date('M', strtotime($eventvalue['date_to'])); ?></h4>
    </div>

    <div class="event-list-container" id="Mycity">
        <?php $event_month =  date('m', strtotime($eventvalue['date_to']));
         $event_data = $this->Comman->eventfind($event_month);
         foreach ($event_data as $key => $value) { ?>

            <div class="up_events">
                <a href="<?php echo SITE_URL; ?>event/<?php echo $value['slug']; ?>">
                    <div class="inner_box">
                        <div class="row d-flex align-items-center justify-content-center">
                            <div class="col-lg-2 col-md-3 col-sm-3 col-12 image_event  ">
                                <img class="event_img" src="<?php echo IMAGE_PATH . 'eventimages/'; ?><?php echo $value['feat_image'] ?>" alt="Image">
                            </div>
                            <div class="col-lg-8 col-md-6 col-sm-6 col-12 detals-eve">
                                <div class="event_contant">

                                    <h3 class="title"><?php echo ucwords(strtolower($value['name'])); ?></h3>
                                    <p class="mb-0 time"><i class="fa-solid fa-calendar-days"></i>
                                        <strong>Start Date:</strong>
                                        <?php echo  date('D, d M Y', strtotime($value['date_from'])); ?> |
                                        <?php echo date('h:i A', strtotime($value['date_from'])); ?>
                                    </p>
                                    <p class="mb-0 time"><i class="fa-solid fa-calendar-days"></i>
                                        <strong>End Date:</strong>
                                        <?php echo  date('D, d M Y', strtotime($value['date_to'])); ?> |
                                        <?php echo date('h:i A', strtotime($value['date_to'])); ?>
                                    </p>
                                    <span class="d-block my-1">Hosted By
                                        <?php echo $value['company']['name']; ?></span>
                                    <span class="d-block">@ <?php echo ucwords(strtolower($value['location'])); ?>
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-3 col-sm-3 col-12 timing ">
                                <div class="event_Date">
                                    <h2><?php echo date('d', strtotime($value['date_from'])); ?>
                                        <span class="date_m"><?php echo date('M', strtotime($value['date_from'])); ?></span>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

        <?php } ?>


    </div>

<?php  } ?>