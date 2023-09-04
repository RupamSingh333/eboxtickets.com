<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" type="text/css"> -->
<!-- ---------------------------------------- -->
<?php

// $data = $this->Comman->totalseatbook($event['id']);
$id = $event['id'];
// pr($event);exit;

?>
<section id="ticker_sec">
  <div class="container">
    <div class="row">

      <div class="col-md-6">
        <div class="ticker_img fadeInLeft">

          <div class="ticker_imgmn wow fadeInLeft">
            <img src="<?php echo IMAGE_PATH . 'eventimages/' . $event['feat_image'] ?>" alt="img">
          </div>
          <img class="event_bg" src="<?php echo IMAGE_PATH; ?>detals-bg.png" alt="img">
          <div class="social mt-4 d-flex social_bg">
            <h5 class="">Share With Friends</h5>
            <ul class="list-inline social_ul">
              <li class="list-inline-item">
                <a href="#" target="_blank">
                  <i class="fab fa-facebook-f"></i>
                </a>
              </li>

              <li class="list-inline-item">
                <a href="#" target="_blank">
                  <i class="fab fa-twitter"></i>
                </a>
              </li>

              <li class="list-inline-item">
                <a href="#">
                  <i class="fab fa-instagram"></i>
                </a>
              </li>

              <li class="list-inline-item">
                <a href="#" target="_blank">
                  <i class="fab fa-google-plus-g"></i>
                </a>
              </li>

              <li class="list-inline-item">
                <a href="#" target="_blank">
                  <i class="fab fa-linkedin-in"></i>
                </a>
              </li>

            </ul>
          </div>
        </div>
      </div>


      <div class="col-md-6">
        <div class=" wow fadeInUp">
          <div class="ticket_h">
            <!-- <h1>History</h1> -->
            <h3><?php echo $event['name']; ?></h3>
            <h6>By <a href="#"><?php echo $event['name']; ?></a></h6>
            <div class="heading-border-line left-style"></div>
          </div>

          <div class="info">
            <ul class="d-flex">

              <li class="d-flex ">
                <!-- <i class="fas fa-phone-alt mr-1 mr-2"></i> -->
                <div>
                  <h6>Date</h6><span><?php echo date('D dS M , Y', strtotime($event['date_from'])); ?></span>
                </div>
              </li>

              <li class="d-flex ">
                <!-- <i class="fas fa-map-marker-alt mr-1 mr-2"></i> -->
                <div>
                  <h6>Time</h6><span><?php echo date('h:i A', strtotime($event['date_from'])); ?> - <?php echo date('h:i A', strtotime($event['date_to'])); ?></span>
                </div>
              </li>
              <li class="d-flex ">
                <!-- <i class="fas fa-map-marker-alt mr-1 mr-2"></i> -->
                <div>
                  <h6>Location </h6><span><?php echo $event['location']; ?> (India)</span>
                </div>
              </li>
            </ul>
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



          <div class="countdown">
            <div id="title">
              <h5 class="mt-4 event_Sub_h">Countdown For Event</h5>
            </div>
            <div id="countdown" class="countdownHolder"><span class="countDays"><span class="position"> <span class="digit static" style="top: 0px; opacity: 1;">0</span> </span> <span class="position"> <span class="digit static" style="top: 0px; opacity: 1;">9</span> </span></span><span class="countDiv countDiv0"></span><span class="countHours"><span class="position"> <span class="digit static" style="top: 0px; opacity: 1;">2</span> </span> <span class="position"> <span class="digit static" style="top: 0px; opacity: 1;">2</span> </span></span><span class="countDiv countDiv1"></span><span class="countMinutes"><span class="position"> <span class="digit static" style="top: 0px; opacity: 1;">2</span> </span> <span class="position"> <span class="digit static" style="top: 0px; opacity: 1;">7</span> </span></span><span class="countDiv countDiv2"></span><span class="countSeconds"><span class="position"> <span class="digit static" style="top: 0px; opacity: 1;">2</span> </span> <span class="position"> <span class="digit static" style="top: 0px; opacity: 1;">3</span> </span></span></div>
            <p id="note">9 days, 22 hours, 27 minutes and 23 seconds <br>left to 10 days from now!</p>

          </div>

          <!-- <div class="countdown">
            <div id="title">
              <h4>Countdown For Event</h4>
            </div>
            <div id="countdown"></div>
            <p id="note"></p>

          </div> -->

          <h5 class="event_Sub_h">Tickets</h5>
          <p class="event_pra">The maximum number of tickets one account is allowed to purchase is 10. You have 8 more tickets left.</p>

          <div class="form-group">
            <ul>

              <li class="list-item-none">
                <div class="row align-items-center">
                  <div class="col-sm-6 price-name">
                    <h6>VIP</h6>
                  </div>
                  <div class="col-sm-6 price-details">
                    <span class="sold_out">$200.00 TTD Sold Out</span>

                  </div>
                </div>

              </li>
              <?php
              if (!empty($event_ticket_type)) {
                foreach ($event_ticket_type as $key => $ticket_type) { ?>

                  <li class="list-item-none">
                    <div class="row align-items-center">
                      <div class="col-sm-6 price-name">
                        <h6><?php echo $ticket_type['title']; ?> (Early Bird)</h6>
                      </div>
                      <div class="col-sm-6 price-details">
                        <div class="row align-items-center">
                          <div class="col-6 d-flex align-items-center justify-content-end">
                            <span class="price">$<?php echo sprintf('%0.2f', $ticket_type['price']); ?> TTD</span>
                          </div>
                          <div class="col-6">
                            <select id="inputState" class="form-select">
                              <option selected>0</option>
                              <option>1</option>
                              <option>2</option>
                              <option>3</option>
                              <option>4</option>
                              <option>5</option>
                            </select>
                          </div>
                        </div>

                      </div>
                    </div>

                  </li>



                <?php }
              } else { ?>

                <li class="list-item-none">
                  <div class="row align-items-center">
                    <div class="col-sm-6 price-name">
                      <h6>Not Available</h6>
                    </div>
                    <div class="col-sm-6 price-details">
                      <div class="row align-items-center">
                        <div class="col-6 d-flex align-items-center justify-content-end">
                          <span class="price">$0.00 TTD</span>
                        </div>
                        <div class="col-6">
                          <select id="inputState" class="form-select">
                            <!-- <option selected>0</option>
                              <option>1</option>
                              <option>2</option>
                              <option>3</option> -->
                          </select>
                        </div>
                      </div>

                    </div>
                  </div>

                </li>
              <?php } ?>


              <!-- <li class="list-item-none">
                    <div class="row align-items-center">
                      <div class="col-sm-6 price-name">
                        <h6>Male (Early Bird)</h6>
                      </div>
                      <div class="col-sm-6 price-details">

                        <div class="row align-items-center">
                          <div class="col-6 d-flex align-items-center justify-content-end">
                            <span class="price">$450.00 TTD</span>
                          </div>
                          <div class="col-6">
                            <select id="inputState" class="form-select">
                              <option selected>0</option>
                              <option>1</option>
                              <option>2</option>
                              <option>3</option>
                            </select>
                          </div>
                        </div>


                      </div>
                    </div>

                  </li>

                  <li class="list-item-none">
                    <div class="row align-items-center">
                      <div class="col-sm-6 price-name">
                        <h6>VIP</h6>
                      </div>
                      <div class="col-sm-6 price-details">

                        <div class="row align-items-center">
                          <div class="col-6 d-flex align-items-center justify-content-end">
                            <span class="price">$750.00 TTD</span>
                          </div>
                          <div class="col-6">
                            <select id="inputState" class="form-select">
                              <option selected>0</option>
                              <option>1</option>
                              <option>2</option>
                              <option>3</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>

                  </li> -->

            </ul>
          </div>


          <div class="committee">
            <h5 class="event_Sub_h">Questions</h5>
            <p class="event_pra">The ticket type you selected requires you to answer a few questions below.</p>
            <h6 class="ticket_TH">General</h6>
            <p>Attendee #1</p>

            <form class="form_bg" action="">
              <div class="row mb-3">
                <label for="inputName" class="col-sm-5 col-form-label">Who do you support?</label>
                <div class="col-sm-7">
                  <select id="inputState" class="form-select">
                    <option selected>Choose One</option>
                    <option>CUFF MMA</option>
                    <option>Southern Warriors</option>
                    <option>Phoenix MMA</option>
                    <option>Southside MMA</option>
                    <option>10th Planet Etobikoe</option>
                  </select>
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputName" class="col-sm-5 col-form-label">Who do you support?</label>
                <div class="col-sm-7">
                  <select id="inputState" class="form-select">
                    <option selected>Choose One</option>
                    <option>CUFF MMA</option>
                    <option>Southern Warriors</option>
                    <option>Phoenix MMA</option>
                    <option>Southside MMA</option>
                    <option>10th Planet Etobikoe</option>
                  </select>
                </div>
              </div>

            </form>

            <h6 class="ticket_TH">VIP</h6>

            <p>Attendee #1</p>

            <form class="form_bg" action="">
              <div class="row mb-3">
                <label for="inputName" class="col-sm-5 col-form-label">Who do you support?</label>
                <div class="col-sm-7">
                  <select id="inputState" class="form-select">
                    <option selected>Choose One</option>
                    <option>CUFF MMA</option>
                    <option>Southern Warriors</option>
                    <option>Phoenix MMA</option>
                    <option>Southside MMA</option>
                    <option>10th Planet Etobikoe</option>
                  </select>
                </div>
              </div>


            </form>
          </div>

          <div class="committee">
            <h5 class="event_Sub_h">Committee</h5>
            <p class="event_pra">The ticket you selected is private and requires you to request your ticket from a committee member</p>
            <form action="">
              <select id="inputState" class="form-select">
                <option selected>Select a Committee Member</option>
                <option>Committee Member</option>
                <option>Committee Member</option>
                <option>Committee Member</option>
                <option>Committee Member</option>
                <option>Committee Member</option>
              </select>
            </form>
          </div>

          <div class="committee">
            <h5 class="event_Sub_h">Message</h5>
            <p class="event_pra">You can went a short message to the committee member you are requesting from. You have 140 characters remaining</p>
            <form action="">
              <div class="mb-3">

                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
              </div>
              <div class="view_btn">
                <a class=" request_T" href="#">
                  Request Ticket
                </a>
              </div>
            </form>
          </div>
          <h5 class="event_Sub_h">Description</h5>
          <p class="event_pra">
            <?php echo $event['desp']; ?>
          </p>

          <div class="view_btn">
            <a class=" site_b" href="#">
              <span>Buy Ticket</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> -->
<!-- ===================Countdown For Event============================= -->
<script>
  /* Conuntdown Script */
  /**
   * @name		jQuery Countdown Plugin
   * @author		Martin Angelov
   * @version 	1.0
   * @url			http://tutorialzine.com/2011/12/countdown-jquery/
   * @license		MIT License
   */

  (function($) {

    // Number of seconds in every time division
    var days = 24 * 60 * 60,
      hours = 60 * 60,
      minutes = 60;

    // Creating the plugin
    $.fn.countdown = function(prop) {

      var options = $.extend({
        callback: function() {},
        timestamp: 0
      }, prop);

      var left, d, h, m, s, positions;

      // Initialize the plugin
      init(this, options);

      positions = this.find('.position');

      (function tick() {

        // Time left
        left = Math.floor((options.timestamp - (new Date())) / 1000);

        if (left < 0) {
          left = 0;
        }

        // Number of days left
        d = Math.floor(left / days);
        updateDuo(0, 1, d);
        left -= d * days;

        // Number of hours left
        h = Math.floor(left / hours);
        updateDuo(2, 3, h);
        left -= h * hours;

        // Number of minutes left
        m = Math.floor(left / minutes);
        updateDuo(4, 5, m);
        left -= m * minutes;

        // Number of seconds left
        s = left;
        updateDuo(6, 7, s);

        // Calling an optional user supplied callback
        options.callback(d, h, m, s);

        // Scheduling another call of this function in 1s
        setTimeout(tick, 1000);
      })();

      // This function updates two digit positions at once
      function updateDuo(minor, major, value) {
        switchDigit(positions.eq(minor), Math.floor(value / 10) % 10);
        switchDigit(positions.eq(major), value % 10);
      }

      return this;
    };


    function init(elem, options) {
      elem.addClass('countdownHolder');

      // Creating the markup inside the container
      $.each(['Days', 'Hours', 'Minutes', 'Seconds'], function(i) {
        $('<span class="count' + this + '">').html(
          '<span class="position">\
					<span class="digit static">0</span>\
				</span>\
				<span class="position">\
					<span class="digit static">0</span>\
				</span>'
        ).appendTo(elem);

        if (this != "Seconds") {
          elem.append('<span class="countDiv countDiv' + i + '"></span>');
        }
      });

    }

    // Creates an animated transition between the two numbers
    function switchDigit(position, number) {

      var digit = position.find('.digit')

      if (digit.is(':animated')) {
        return false;
      }

      if (position.data('digit') == number) {
        // We are already showing this number
        return false;
      }

      position.data('digit', number);

      var replacement = $('<span>', {
        'class': 'digit',
        css: {
          top: '-2.1em',
          opacity: 0
        },
        html: number
      });

      // The .static class is added when the animation
      // completes. This makes it run smoother.

      digit
        .before(replacement)
        .removeClass('static')
        .animate({
          top: '2.5em',
          opacity: 0
        }, 'fast', function() {
          digit.remove();
        })

      replacement
        .delay(100)
        .animate({
          top: 0,
          opacity: 1
        }, 'fast', function() {
          replacement.addClass('static');
        });
    }
  })(jQuery);

  /* initialization main script */

  $(function() {

    var note = $('#note'),
      ts = new Date(2012, 0, 1),
      newYear = true;

    if ((new Date()) > ts) {
      // The new year is here! Count towards something else.
      // Notice the *1000 at the end - time must be in milliseconds
      ts = (new Date()).getTime() + 10 * 24 * 60 * 60 * 1000;
      newYear = false;
    }

    $('#countdown').countdown({
      timestamp: ts,
      callback: function(days, hours, minutes, seconds) {

        var message = "";

        message += days + " day" + (days == 1 ? '' : 's') + ", ";
        message += hours + " hour" + (hours == 1 ? '' : 's') + ", ";
        message += minutes + " minute" + (minutes == 1 ? '' : 's') + " and ";
        message += seconds + " second" + (seconds == 1 ? '' : 's') + " <br />";

        if (newYear) {
          message += "left until the new year!";
        } else {
          message += "left to 10 days from now!";
        }

        note.html(message);
      }
    });

  });
</script>

<!-- -------------------------------- -->