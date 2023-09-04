<style>
/* Loader - https://loading.io/css/*/

.spinner {
    margin: 0px auto 0;
    width: 70px;
    text-align: center;
}

.spinner>div {
    width: 18px;
    height: 18px;
    background-color: #fe6c16;
    border-radius: 100%;
    display: inline-block;
    -webkit-animation: sk-bouncedelay 1.4s infinite ease-in-out both;
    animation: sk-bouncedelay 1.4s infinite ease-in-out both;
}

.spinner .bounce1 {
    -webkit-animation-delay: -0.32s;
    animation-delay: -0.32s;
}

.spinner .bounce2 {
    -webkit-animation-delay: -0.16s;
    animation-delay: -0.16s;
}

@-webkit-keyframes sk-bouncedelay {

    0%,
    80%,
    100% {
        -webkit-transform: scale(0)
    }

    40% {
        -webkit-transform: scale(1.0)
    }
}

@keyframes sk-bouncedelay {

    0%,
    80%,
    100% {
        -webkit-transform: scale(0);
        transform: scale(0);
    }

    40% {
        -webkit-transform: scale(1.0);
        transform: scale(1.0);
    }
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<section id="events_page">
    <div class="container">
        <div class="heading">
            <h1>Events</h1>
            <h2>Upcoming Events</h2>
        </div>

        <!-- Searching evens start -->
        <div class="search_sec">
            <form class="d-flex">
                <input class="form-control me-2" type="text" placeholder="Search Events" aria-label="Search">
            </form>
            <svg width="20" height="20" viewBox="0 0 17 18" class="" xmlns="http://www.w3.org/2000/svg">
                <g fill="#2874F1" fill-rule="evenodd">
                    <path class="_34RNph"
                        d="m11.618 9.897l4.225 4.212c.092.092.101.232.02.313l-1.465 1.46c-.081.081-.221.072-.314-.02l-4.216-4.203">
                    </path>
                    <path class="_34RNph"
                        d="m6.486 10.901c-2.42 0-4.381-1.956-4.381-4.368 0-2.413 1.961-4.369 4.381-4.369 2.42 0 4.381 1.956 4.381 4.369 0 2.413-1.961 4.368-4.381 4.368m0-10.835c-3.582 0-6.486 2.895-6.486 6.467 0 3.572 2.904 6.467 6.486 6.467 3.582 0 6.486-2.895 6.486-6.467 0-3.572-2.904-6.467-6.486-6.467">
                    </path>
                </g>
            </svg>
        </div>
        <!-- Loader  -->
        <div class="spinner" style="display: none;">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>

        <!-- Searching events ends  -->

        <div class="event-list-container" id="Mycity">
            <div class="event_detales">
                <?php foreach ($event  as $eventvalue) { //pr($eventvalue); ?>
                <div class="month">
                    <h4> <?php echo date('M Y', strtotime($eventvalue['date_to'])); ?> </h4>
                </div>
                <div class="row">
                    <?php $event_month =  date('m', strtotime($eventvalue['date_to'])); ?>
                    <?php $event_data = $this->Comman->eventfind($event_month); ?>
                    <?php foreach ($event_data as $key => $value) {
                        // if ($key!=0) {
                        //    continue;
                        // }
                        // ?>
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="up_events">
                            <a href="<?php echo SITE_URL; ?>event/<?php echo $value['slug']; ?>">
                                <div class="inner_box">
                                    <div class="row d-flex align-items-center justify-content-center">
                                        <div class="col-md-5 col-sm-6">
                                            <div class="image_br">
                                                <img class="event_img"
                                                    src="<?php echo IMAGE_PATH . 'eventimages/'; ?><?php echo $value['feat_image'] ?>"
                                                    alt="">
                                            </div>
                                        </div>
                                        <div class="col-md-7 col-sm-6">
                                            <div class="event_contant event_datles">
                                                <h3 class="title"><?php echo $value['name'] ?></h3>
                                                <!-- <h4 class="author-info"><?php// echo substr($value['desp'], 0, 30); ?> 
                                                </h4>-->
                                                <span>Hosted By <?php echo $value['company']['name']; ?></span><br>
                                                <span class="mb-2"> @ <?php echo $value['country']['CountryName']; ?>
                                                </span>
                                                <div class="event_time">
                                                    <p class="mb-0 time"><i class="fa-solid fa-calendar-days"></i>
                                                        <strong>Start Date</strong>
                                                        <span
                                                            style="display: inline-block; width: 10px; color: #333; font-weight: 700;">:</span>

                                                        <?php echo  date('D, d M Y', strtotime($value['date_from'])); ?>
                                                        |
                                                        <?php echo date('h:i A', strtotime($value['date_from'])); ?>
                                                    </p>
                                                    <p class="mb-0 time"><i class="fa-solid fa-calendar-days"></i>
                                                        <strong>End Date</strong>
                                                        <span
                                                            style="display: inline-block; width: 10px; color: #333; font-weight: 700;">:</span>

                                                        <?php echo  date('D, d M Y', strtotime($value['date_to'])); ?> |
                                                        <?php echo date('h:i A', strtotime($value['date_to'])); ?>
                                                    </p>
                                                </div>
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
            </div>
        </div>
    </div>
</section>


<script>
$(document).ready(function() {
    var timeout = false;
    $('.spinner').hide();
    $(".search_sec").on("keyup", function(e) {
        var pos = e.target.value;
        if (pos != "") {
            $('.spinner').show();
            $.ajax({
                async: true,
                data: {
                    'search': pos
                },
                type: "post",
                url: "<?php echo SITE_URL; ?>event/upcomingeventsearch",
                success: function(data) {
                    if (timeout) {
                        clearTimeout(timeout);
                    }
                    timeout = setTimeout(function() {
                        $("#Mycity").html(data);
                        $('.spinner').hide();
                    }, 800);

                },
            });
            return false;
        }
    });
});
</script>