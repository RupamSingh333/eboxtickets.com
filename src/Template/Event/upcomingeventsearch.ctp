    <div class="event_detales">
        <?php if (!empty($event)) { ?>
            <?php foreach ($event  as $eventvalue) { //pr($eventvalue); 
            ?>
                <div class="month">
                    <h4>
                        <h4><?php echo date('M Y', strtotime($eventvalue['date_to'])); ?></h4>
                    </h4>
                </div>
                <div class="row">
                    <?php $event_month =  date('m', strtotime($eventvalue['date_to'])); ?>
                    <?php $event_data = $this->Comman->eventfindsearch($event_month, $searchquery); ?>

                    <?php foreach ($event_data as $key => $value) { ?>
                        <div class="col-md-6">
                            <div class="up_events">

                                <a href="<?php echo SITE_URL; ?>event/eventdetail/<?php echo $value['id']; ?>">
                                    <div class="inner_box">
                                        <div class="row d-flex align-items-center justify-content-center">
                                            <div class="col-sm-6">
                                                <div class="image_br">
                                                    <img class="event_img" src="<?php echo IMAGE_PATH . 'eventimages/'; ?><?php echo $value['feat_image'] ?>" alt="">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="event_contant">
                                                    <h3 class="title"><?php echo $value['name'] ?></h3>
                                                    <h4 class="author-info"><?php echo substr($value['desp'], 0, 30); ?> </h4>
                                                    <span>Hosted By <?php echo $value['company']['name']; ?></span><br>
                                                    <span class="mb-2"> @ <?php echo $value['country']['CountryName']; ?> </span>
                                                    <h4 class="author-info d-flex align-items-center mt-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                                            <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z" />
                                                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z" />
                                                        </svg>
                                                        <?php echo date('h:i A', strtotime($value['date_from'])); ?> - <?php echo date('h:i A', strtotime($value['date_to'])); ?>
                                                    </h4>
                                                    <h4 class="time"><?php echo date('d M Y', strtotime($value['date_from'])); ?></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                            </div>
                        </div>

                    <?php } ?>


                </div>

            <?php  } ?>

        <?php } else { ?>
            <?php echo "No Event found"; ?>
        <?php } ?>

    </div>