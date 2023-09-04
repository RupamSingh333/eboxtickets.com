<?php if(!empty($event)){ ?>
<?php foreach($event as $key=>$value){ ?>
<div class="up_events">
<a href="<?php echo SITE_URL; ?>event/<?php echo $value['slug']; ?>">
                        <div class="inner_box">
                            <div class="row d-flex align-items-center justify-content-center">
                                <div class="col-sm-2">
                                <img class="event_img" src="<?php echo IMAGE_PATH . 'eventimages/'; ?><?php echo $value['feat_image'] ?>" alt="">
                                </div>
                                <div class="col-sm-10">
                                    <div class="event_contant">
                                    <h3 class="title"><?php echo $value['name'] ?></h3>
                                        <h4 class="author-info"><?php echo substr($value['desp'], 0, 30); ?>  </h4>
                                        <h4 class="time">  <?php echo date('h:i A', strtotime($value['date_from'])); ?> - <?php echo date('h:i A', strtotime($value['date_to'])); ?></h4>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                    </a>
                </div>


                <?php } ?>

                <?php }else{ ?>
                <div class="up_events">
                    No Events
                </div>
                <?php } ?>