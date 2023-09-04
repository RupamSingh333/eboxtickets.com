<div class="generate_ticket">
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <div class="ticket_icon_popup"><img src="<?php echo SITE_URL; ?>images/ticket_share_icon_2.png"></div>
        </div>
        <div class="modal-body">
          <h4>Share Tickets</h4>
          <form>
            <div class="phone_no"><input type="text" placeholder="Phone No."></div>
            <div class="phone_no"><input type="text" placeholder="Quantity"></div>
            <div class="phone_no_submit"><button class="main_button">Submit</button></div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>



<section id="my_ticket_page">
  <!--event_detail_page-->
  <div class="container">
    <hgroup class="innerpageheading">
      <h2>My Ticket</h2>
      <ul>
        <li><a href="#">Home</a></li>
        <li><i class="fas fa-angle-double-right"></i></li>
        <li>My Ticket</li>
      </ul>
    </hgroup>
    <?php echo $this->Flash->render(); ?>

    <div class="my_ticket_content">
      <div class="my_ticket_form">
        <script>
          $(document).ready(function() {
            $("#Mysubscriptionevent").bind("submit", function(event) {

              $.ajax({
                async: true,
                data: $("#Mysubscriptionevent").serialize(),
                dataType: "html",
                type: "POST",
                url: "<?php echo SITE_URL; ?>homes/search",
                success: function(data) {
                  //alert(data); 
                  $("#exampleevent").html(data);
                },
              });
              return false;
            });
          });
          //]]>
        </script>
        <?php /* ?>
            <?php echo $this->Form->create('Mysubscription',array('type'=>'file','inputDefaults'=>array('div'=>false,'label'=>false),'id'=>'Mysubscriptionevent','class'=>'form-horizontal')); ?>
                <div class="text-left">
                  <div class="ticket_title">
                    <?php
            echo $this->Form->input('eventname', array('class' => 'longinput form-control input-medium ','placeholder'=>'Event Name' ,'type'=>'text','label'=>false,'autocomplete'=>'off')); ?>
                    <!--<input type="text" placeholder="Ticket Title">-->
                  </div>
                <!-- <div class="ticket_type">
                    <select>
                    <option>Dance</option>
                    <option>Sketing</option>
                    <option>Zumba</option>
                    <option>Arobics</option>
                    </select>
                  </div>-->
                  <div class="from_date">
                    <!--<div class="input-append date form_datetime">
                    <?php //echo $this->Form->input('date_from', array('class' => 'longinput form-control input-medium','placeholder'=>'Date From','type'=>'text','label' =>false,'autocomplete'=>'off')); ?>
              <!-- <input size="16" type="text" value="" readonly="" placeholder="10 Sep. 2018 - 10.32">
                <span class="add-on"><i class="icon-th fas fa-calendar-alt"></i></span>
                </div> -->

                <?php echo $this->Form->input('date_from', array('class' => 'longinput form-control input-medium datetimepicker1','placeholder'=>'Date From','type'=>'text','label' =>false,'autocomplete'=>'off')); ?>
                  </div>
                  <div class="to_date">
                    <!--<div class="input-append date form_datetime3">
              <?php //echo $this->Form->input('date_to', array('class' => 'longinput form-control input-medium','placeholder'=>'Date From','type'=>'text','label' =>false,'autocomplete'=>'off')); ?>
                <span class="add-on"><i class="icon-th fas fa-calendar-alt"></i></span>
                </div> -->
                <?php echo $this->Form->input('date_to', array('class' => 'longinput form-control input-medium datetimepicker1','placeholder'=>'Date To','type'=>'text','label' =>false,'autocomplete'=>'off')); ?>
                  </div>
                  <div class="ticket_search">
                    <button type="submit" id="Mysubscriptionevent"><i class="fas fa-search"></i></button>
                  </div>
                </div>
            </form>

            </div>
            <?php **/ ?>
                    <?php /* ?>

            <ul class="nav nav-pills text-center">
                <li class="active"><a data-toggle="pill" href="#event_tab_1" class="logintabbtn">Upcoming Event</a></li>
                <li><a data-toggle="pill" href="#event_tab_2" class="registertabbtn">Past Event</a></li>
              </ul>


            <?php */ ?>
        <div class="tab-content">
          <div id="event_tab_1" class="tab-pane fade in active">
            <div id="exampleevent" class="table-responsive">

              <?php if ($currentticketbook) { ?>

                <table class="table">
                  <thead>
                    <tr>
                      <th>S. No</th>
                      <th>Name</th>
                      <th>Date and Time</th>
                      <th>Venue</th>
                      <th>Share Ticket</th>
                      <th>Social Sharing</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1;
                    foreach ($currentticketbook as $key => $value) { // pr($value);
                    ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $value['event']['name']; ?></td>
                        <td>From <?php echo date('d M Y h:i A', strtotime($value['event']['date_from'])); ?><br>
                          To <?php echo date('d M Y h:i A', strtotime($value['event']['date_to'])); ?>
                        </td>
                        <td><?php echo $value['event']['location']; ?></td>
                        <td><a href="#" class="nocolor" data-toggle="modal" data-target="#myModal"><img src="<?php echo SITE_URL; ?>images/ticket_share_icon.png" alt="icon"></a> </td>
                        <td class="show_share_icons"><i class="fas fa-share-alt"></i>
                          <ul class="social_show">
                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                            <i class="fas fa-caret-down"></i>
                          </ul>
                        </td>
                        <td><a href="#" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Generate Ticket</a></td>
                      </tr>


                    <?php $i++;
                    } ?>

                    <!--  <tr>
                        <td>2</td>
                      <td>Music Night with Jagjeet singh</td>
                      <td>From Sun, 30 Sep 2018 2:00 PM<br>
                          To Sun, 30 Sep 2018  3:00 PM 
                      </td>
                      <td>85 Golden Street, Kenya</td>
                      <td><a href="#" class="nocolor" data-toggle="modal" data-target="#myModal"><img src="images/ticket_share_icon.png" alt="icon"></a> </td>
                      <td class="show_share_icons"><i class="fas fa-share-alt"></i>
                      <ul class="social_show">
                      <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                      <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                      <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                      <i class="fas fa-caret-down"></i>
                      </ul>
                      </td>
                      <td><a href="#" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Generate Ticket</a></td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td>Music Night with Jagjeet singh</td>
                      <td>From Sun, 30 Sep 2018 2:00 PM<br>
                          To Sun, 30 Sep 2018  3:00 PM 
                      </td>
                      <td>85 Golden Street, Kenya</td>
                      <td><a href="#" class="nocolor" data-toggle="modal" data-target="#myModal"><img src="images/ticket_share_icon.png" alt="icon"></a> </td>
                      <td class="show_share_icons"><i class="fas fa-share-alt"></i>
                      <ul class="social_show">
                      <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                      <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                      <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                      <i class="fas fa-caret-down"></i>
                      </ul>
                      </td>
                      <td><a href="#" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Generate Ticket</a></td>
                    </tr>
                    <tr>
                      <td>4</td>
                      <td>Music Night with Jagjeet singh</td>
                      <td>From Sun, 30 Sep 2018 2:00 PM<br>
                          To Sun, 30 Sep 2018  3:00 PM 
                      </td>
                      <td>85 Golden Street, Kenya</td>
                      <td><a href="#" class="nocolor" data-toggle="modal" data-target="#myModal"><img src="images/ticket_share_icon.png" alt="icon"></a> </td>
                      <td class="show_share_icons"><i class="fas fa-share-alt"></i>
                      <ul class="social_show">
                      <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                      <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                      <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                      <i class="fas fa-caret-down"></i>
                      </ul>
                      </td>
                      <td><a href="#" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Generate Ticket</a></td>
                    </tr>
                    <tr>
                      <td>5</td>
                      <td>Music Night with Jagjeet singh</td>
                      <td>From Sun, 30 Sep 2018 2:00 PM<br>
                          To Sun, 30 Sep 2018  3:00 PM 
                      </td>
                      <td>85 Golden Street, Kenya</td>
                      <td><a href="#" class="nocolor" data-toggle="modal" data-target="#myModal"><img src="images/ticket_share_icon.png" alt="icon"></a> </td>
                      <td class="show_share_icons"><i class="fas fa-share-alt"></i>
                      <ul class="social_show">
                      <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                      <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                      <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                      <i class="fas fa-caret-down"></i>
                      </ul>
                      </td>
                      <td><a href="#" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Generate Ticket</a></td>
                    </tr>
                    <tr>
                      <td>6</td>
                      <td>Music Night with Jagjeet singh</td>
                      <td>From Sun, 30 Sep 2018 2:00 PM<br>
                          To Sun, 30 Sep 2018  3:00 PM 
                      </td>
                      <td>85 Golden Street, Kenya</td>
                      <td><a href="#" class="nocolor" data-toggle="modal" data-target="#myModal"><img src="images/ticket_share_icon.png" alt="icon"></a> </td>
                      <td class="show_share_icons"><i class="fas fa-share-alt"></i>
                      <ul class="social_show">
                      <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                      <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                      <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                      <i class="fas fa-caret-down"></i>
                      </ul>
                      </td>
                      <td><a href="#" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Generate Ticket</a></td>
                    </tr>
                    <tr>
                      <td>7</td>
                      <td>Music Night with Jagjeet singh</td>
                      <td>From Sun, 30 Sep 2018 2:00 PM<br>
                          To Sun, 30 Sep 2018  3:00 PM 
                      </td>
                      <td>85 Golden Street, Kenya</td>
                      <td><a href="#" class="nocolor" data-toggle="modal" data-target="#myModal"><img src="images/ticket_share_icon.png" alt="icon"></a> </td>
                      <td class="show_share_icons"><i class="fas fa-share-alt"></i>
                      <ul class="social_show">
                      <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                      <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                      <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                      <i class="fas fa-caret-down"></i>
                      </ul>
                      </td>
                      <td><a href="#" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Generate Ticket</a></td>
                    </tr>-->
                  </tbody>
                </table>

              <?php } else {

                echo  "No Tickets Book";
              } ?>

            </div>
          </div>

          <div id="event_tab_2" class="tab-pane fade">
            <div class="table-responsive">

              <?php if ($pastticketbook) { ?>
                <table class="table">
                  <thead>
                    <tr>
                      <th>S. No</th>
                      <th>Name</th>
                      <th>Date and Time</th>
                      <th>Venue</th>
                      <!--<th>Share Ticket</th>-->
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1;
                    foreach ($pastticketbook as $key => $value) { // pr($value);
                    ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $value['event']['name']; ?></td>
                        <td>From <?php echo date('d M Y h:i A', strtotime($value['event']['date_from'])); ?><br>
                          To <?php echo date('d M Y h:i A', strtotime($value['event']['date_to'])); ?>
                        </td>
                        <td><?php echo $value['event']['location']; ?></td>
                        <!--<td class="show_share_icons"><img src="images/ticket_share_icon.png" alt="icon"> 
                      <ul class="social_show">
                      <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                      <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                      <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                      <i class="fas fa-caret-down"></i>
                      </ul>
                      </td>
                      <td><a href="#" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Generate Ticket</a></td>-->
                                    </tr>
                                  <?php $i++;
                                  } ?>

                                  <?php /*<!--  <tr>
                      <td>2</td>
                      <td>Music Night with Jagjeet singh</td>
                      <td>From Sun, 8 Sep 2018 2:00 PM To Sun, 8 Sep 2018  3:00 PM 
                      </td>
                      <td>85 Golden Street, Kenya</td>
                      <!-<td class="show_share_icons"><img src="images/ticket_share_icon.png" alt="icon"> 
                      <ul class="social_show">
                      <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                      <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                      <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                      <i class="fas fa-caret-down"></i>
                      </ul>
                      </td>
                      <td><a href="#" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Generate Ticket</a></td>-->
                    </tr>
                    <tr>
                      <td>3</td>
                      <td>Music Night with Jagjeet singh</td>
                      <td>From Sun, 8 Sep 2018 2:00 PM To Sun, 8 Sep 2018  3:00 PM 
                      </td>
                      <td>85 Golden Street, Kenya</td>
                      <!--<td class="show_share_icons"><img src="images/ticket_share_icon.png" alt="icon"> 
                      <ul class="social_show">
                      <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                      <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                      <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                      <i class="fas fa-caret-down"></i>
                      </ul>
                      </td>
                      <td><a href="#" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Generate Ticket</a></td>-->
                    </tr>
                    <tr>
                      <td>4</td>
                      <td>Music Night with Jagjeet singh</td>
                      <td>From Sun, 8 Sep 2018 2:00 PM To Sun, 8 Sep 2018  3:00 PM 
                      </td>
                      <td>85 Golden Street, Kenya</td>
                      <!--<td class="show_share_icons"><img src="images/ticket_share_icon.png" alt="icon"> 
                      <ul class="social_show">
                      <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                      <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                      <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                      <i class="fas fa-caret-down"></i>
                      </ul>
                      </td>
                      <td><a href="#" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Generate Ticket</a></td>-->
                    </tr>
                    <tr>
                      <td>5</td>
                      <td>Music Night with Jagjeet singh</td>
                      <td>From Sun, 8 Sep 2018 2:00 PM To Sun, 8 Sep 2018  3:00 PM 
                      </td>
                      <td>85 Golden Street, Kenya</td>
                      <!--<td class="show_share_icons"><img src="images/ticket_share_icon.png" alt="icon"> 
                      <ul class="social_show">
                      <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                      <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                      <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                      <i class="fas fa-caret-down"></i>
                      </ul>
                      </td>
                      <td><a href="#" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Generate Ticket</a></td>-->
                    </tr>
                    <tr>
                      <td>6</td>
                      <td>Music Night with Jagjeet singh</td>
                      <td>From Sun, 8 Sep 2018 2:00 PM To Sun, 8 Sep 2018  3:00 PM 
                      </td>
                      <td>85 Golden Street, Kenya</td>
                      <!--<td class="show_share_icons"><img src="images/ticket_share_icon.png" alt="icon"> 
                      <ul class="social_show">
                      <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                      <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                      <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                      <i class="fas fa-caret-down"></i>
                      </ul>
                      </td>
                      <td><a href="#" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Generate Ticket</a></td>-->
                    </tr>
                    <tr>
                      <td>7</td>
                      <td>Music Night with Jagjeet singh</td>
                      <td>From Sun, 8 Sep 2018 2:00 PM To Sun, 8 Sep 2018  3:00 PM 
                      </td>
                      <td>85 Golden Street, Kenya</td>
                      <!--<td class="show_share_icons"><img src="images/ticket_share_icon.png" alt="icon"> 
                      <ul class="social_show">
                      <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                      <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                      <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                      <i class="fas fa-caret-down"></i>
                      </ul>
                      </td>
                      <td><a href="#" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Generate Ticket</a></td>-->
                    </tr>--> */ ?>
                  </tbody>
                </table>
              <?php } else {
                echo "No Past Tickets";
              } ?>
            </div>
          </div>
        </div>


      </div>

    </div>
    <div class="footer_buildings"></div>
</section>
<!--upcoming Event End-->






<script type="text/javascript">
  $(function() {
    var start = new Date();
    // set end date to max one year period:
    var end = new Date(new Date().setYear(start.getFullYear() + 1));
    $('.datetimepicker1').datetimepicker({
      pickTime: false,
    }).on('changeDate', function() {
      $(this).datetimepicker('hide');
    });
    $('.datetimepicker2').datetimepicker({


    }).on('changeDate', function() {

      $(this).datetimepicker('hide');
    });
  });
</script>