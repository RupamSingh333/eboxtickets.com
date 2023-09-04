<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.css" rel="stylesheet" type="text/css" />
<script src="https://code.jquery.com/jquery-2.1.4.js"></script>
<script src="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.js"></script>
<script href="https://staging.eboxtickets.com/js/datetimepicker_ra.js"></script>
<section id="dashboard_pg">
  <div class="container">

    <div class="dashboard_pg_btm">
      <div class="row">
        <div class="col-md-12">
          <div class="d-flex justify-content-between dash_menutog align-items-center">
            <nav class="navbar navbar-expand-lg navbar-light p-0">
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="nav nav-pills" id="nav-tab" role="tablist">
                  <a class="nav-item nav-link active" id="nav-home-tab" href="#" role="tab" aria-controls="nav-home" aria-selected="true">Dashboard</a>
                </div>
              </div>
            </nav>
            <ul class="list-inline dash_ulbtn">
              <li class="list-inline-item ">
                <a href="<?php echo SITE_URL; ?>homes/myevent"> <button type="submit" class="btn save">View Event</button></a>
              </li>

            </ul>
          </div>


          <div class="form">
            <h2><i class="far fa-calendar-plus"></i>Post Event</h2>
            <div class="form_inner">
              <!-- <ul id="progressbar">
                <a href="<?php //echo SITE_URL; ?>homes/postevent<?php //if ($getId) { //echo '/' . $getId; } ?>">
                  <li class="active">Event Info</li>
                </a>
                <li>Manage Tickets & Addons</li>
                <li>Questions</li>
                <li>Committee</li>
                <li>Settings</li>
           <li>View Event</li> 
              </ul>-->
              <?php echo $this->Flash->render(); ?>
              <form method="post" enctype="multipart/form-data" accept-charset="utf-8" id="formsubmit" class="form-horizontal needs-validation">

                <fieldset>
                  <h4>Event Info</h4>

                  <section id="register">
                    <div class="container">


                      <div class="register_contant">

                        <div class="row">
                          <div class="col-md-4  mb-3">

                            <div class="row d-flex align-items-end">
                              <div class="col-sm-9">
                                <label for="lastname">Company<strong style="color:red;">*</strong></label>

                                <?php
                                if ($_SESSION['postevent']['company_id']) {
                                  $company_id = $_SESSION['postevent']['company_id'];
                                } else if ($eventDetails['company_id']) {
                                  $company_id = $eventDetails['company_id'];
                                }
                                echo $this->Form->input(
                                  'company_id',
                                  ['empty' => 'Choose Company', 'options' => $company, 'default' => ($company_id) ? $company_id : "", 'required' => 'required', 'class' => 'form-select', 'label' => false]
                                ); ?>
                              </div>

                              <div class="col-sm-3">

                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary Add_com" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                  Add
                                </button>
                              </div>
                            </div>

                          </div>

                          <div class="col-md-4  mb-3">
                            <label for="firstname">Event Name<strong style="color:red;">*</strong></label>
                            <?php
                            if ($_SESSION['postevent']['name']) {
                              $name = $_SESSION['postevent']['name'];
                            } else if ($eventDetails['name']) {
                              $name = $eventDetails['name'];
                            }
                            // pr($name);exit;
                            ?>
                            <input type="text" class="form-control" name="name" placeholder="Event Name" required value="<?php echo isset($name) ? $name : '' ?>">
                          </div>

                          <div class="col-md-4  mb-3">
                            <label for="lastname">Country<strong style="color:red;">*</strong></label>

                            <?php
                            if ($_SESSION['postevent']['country_id']) {
                              $country_id = $_SESSION['postevent']['country_id'];
                            } else if ($eventDetails['country_id']) {
                              $country_id = $eventDetails['country_id'];
                            }
                            echo $this->Form->input(
                              'country_id',
                              ['empty' => 'Choose Country', 'options' => $country, 'default' => ($country_id) ? $country_id : "", 'required' => 'required', 'class' => 'form-select', 'label' => false]
                            ); ?>

                          </div>

                          <div class="col-md-4  mb-3">
                            <label for="firstname">Location<strong style="color:red;">*</strong></label>

                            <?php
                            if ($_SESSION['postevent']['location']) {
                              $location = $_SESSION['postevent']['location'];
                            } else if ($eventDetails['location']) {
                              $location = $eventDetails['location'];
                            }
                            echo $this->Form->input('location', array('class' => 'form-control ', 'type' => 'text', 'placeholder' => 'Location', 'required', 'label' => false, 'value' => ($location) ? $location : "")); ?>

                            <!-- <input type="text" class="form-control" name="location" placeholder="Location" required value=""> -->
                          </div>

                          <div class="col-md-4 mb-3">
                            <label for="formFile" class="form-label">Upload Image<strong style="color:red;">*</strong></label>

                            <?php
                            if ($_SESSION['postevent']['event_image']) {
                              $event_image = $_SESSION['postevent']['event_image'];
                            } else if ($eventDetails['feat_image']) {
                              $event_image = $eventDetails['feat_image'];
                            }
                            ?>
                            <input class="form-control" <?php if (empty($event_image)) {
                                                          echo '';
                                                        } ?> type="file" name="event_image" accept="image/png, image/gif, image/jpeg" value="<?php echo isset($event_image) ? $event_image : '' ?>" />
                            <!-- <input type="hidden" value="<?php //echo isset($event_image) ? $event_image : '' 
                                                              ?>"> -->
                          </div>

                          <div class="col-md-4 mb-3">
                            <label for="formFile" class="form-label">Youtube URL</label>
                            <input class="form-control" type="url" id="formFile" name="video_url" placeholder="Youtube URL">
                          </div>

                          <div class="col-md-4  mb-3">
                            <label for="firstname">Event start<strong style="color:red;">*</strong></label>
                            <div class="ui calendar" id="example1">
                              <div class="ui input left icon">
                                <i class="calendar icon"></i>
                                <?php
                                if ($_SESSION['postevent']['date_from']) {
                                  $date_from = date("d-m-Y h:i:sA", strtotime($_SESSION['postevent']['date_from']));
                                } else if ($eventDetails['date_from']) {

                                  $date_from = date('d-m-Y h:i:sA', strtotime($eventDetails['date_from']));
                                }
                                ?>
                                <input class="form-control" required type="text" name="date_from" placeholder="Date/Time" autocomplete="off" value="<?php echo isset($date_from) ? $date_from : '' ?>">
                              </div>
                            </div>

                            <!-- <input type="date" class="form-control" name="name" required="" value=""> -->
                            <?php //echo $this->Form->input('date_from', array('class' => 'longinput form-control input-medium datetimepicker1', 'placeholder' => 'Date From', 'type' => 'datetime-local', 'required', 'label' => false, 'autocomplete' => 'off', 'value' => (!empty($addevent['date_from'])) ? date('Y-m-d H:m', strtotime($addevent['date_from'])) : '')); 
                            ?>

                          </div>
                          <div class="col-md-4 mb-3">
                            <label for="firstname">Event End<strong style="color:red;">*</strong></label>

                            <div class="ui calendar" id="exampleE">
                              <div class="ui input left icon">
                                <i class="calendar icon"></i>
                                <?php
                                if ($_SESSION['postevent']['date_to']) {
                                  $date_to = date("d-m-Y h:i:sA", strtotime($_SESSION['postevent']['date_to']));
                                } else if ($eventDetails['date_to']) {
                                  $date_to = date('d-m-Y h:i:sA', strtotime($eventDetails['date_to']));
                                }
                                ?>
                                <input class="form-control" required type="text" name="date_to" value="<?php echo isset($date_to) ? $date_to : '' ?>" placeholder="Date/Time" autocomplete="off">
                              </div>
                            </div>

                            <!-- <input type="date" class="form-control" name="name" required="" value=""> -->
                            <?php //echo $this->Form->input('date_to', array('class' => 'longinput form-control input-medium datetimepicker2', 'placeholder' => 'Date To', 'required', 'type' => 'datetime-local', 'label' => false, 'autocomplete' => 'off', 'id' => 'changedate', 'value' => (!empty($addevent['date_to'])) ? date('Y-m-d H:m', strtotime($addevent['date_to'])) : '')); 
                            ?>
                          </div>

                          <div class="col-md-4  mb-3">
                            <label for="firstname">URL Slug</label>
                            <?php
                            if ($_SESSION['postevent']['slug']) {
                              $slug = $_SESSION['postevent']['slug'];
                            } else if ($eventDetails['slug']) {
                              $slug = $eventDetails['slug'];
                            }
                            ?>
                            <input type="text" class="form-control slug" placeholder="Slug" name="slug" required="" value="<?php echo isset($slug) ? $slug : '' ?>">
                          </div>

                          <div class="col-md-6  mb-3">
                            <label for="firstname">Share URL</label>

                            <span class="slug-display">https://staging.eboxtickets.com/event/<?php echo isset($slug) ? $slug : ''; ?></span>
                          </div>


                          <div class="col-md-12  mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Description<strong style="color:red;">*</strong></label>
                            <?php
                            if ($_SESSION['postevent']['desp']) {
                              $desp = $_SESSION['postevent']['desp'];
                            } else if ($eventDetails['desp']) {
                              $desp = $eventDetails['desp'];
                            }
                            // pr($desp);exit;
                            ?>
                            <textarea class="form-control" required name="desp" id="exampleFormControlTextarea1" rows="3"><?php echo isset($desp) ? $desp : '' ?></textarea>
                          </div>



                          <!-- <div class="col-md-6  mb-3">
                    <label for="mobilenumber">Mobile Number</label>
                                        <input type="number" class="form-control" name="mobile" required="" value="">
                </div>
                <div class="col-md-6  mb-3">
                    <label for="emailaddress">Email Address</label>
                                        <input type="email" name="username" class="form-control" id="emli" placeholder="Email" maxlength="255" required="" onchange="return chkcsells(this.id);" value="">
                    <div style="display:none; color: red;" id="forgotd">Email Already Exist!!!</div>
                </div> -->


                          <!-- <div class="col-md-12  mb-2">

                            <div class="row align-items-center">
                              <div class="col-sm-3">
                                <label for="legalrepresentativeconfirm">Hide Home Page</label>
                              </div>

                              <div class="col-sm-9">
                                <div class="me-3">
                                  <div class="" style="padding-top: 5px;">
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" name="hidden_homepage" id="Representative1" value="Y">
                                      <label class="form-check-label d-block" style="line-height:26px;" for="Representative1">
                                        (this hides the event from the home page)
                                      </label>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>


                          <div class="col-md-12  mb-2">

                            <div class="row align-items-center">
                              <div class="col-sm-3">
                                <label for="legalrepresentativeconfirm">Hide Company Page</label>
                              </div>

                              <div class="col-sm-9">
                                <div class="me-3">
                                  <div class="" style="padding-top: 5px;">
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" name="hidden_company" id="Representative1" value="Y">
                                      <label class="form-check-label d-block" style="line-height:26px;" for="Representative1">
                                        (this hides the event from the company page)
                                      </label>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>


                          <div class="col-md-12  mb-2">

                            <div class="row align-items-center">
                              <div class="col-sm-3">
                                <label for="legalrepresentativeconfirm">Payment Options</label>
                              </div>

                              <div class="col-sm-9 d-flex">
                                <div class="me-3">
                                  <div class="" style="padding-top: 5px;">
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" name="online_payments" id="Representative1" value="Y">
                                      <label class="form-check-label d-block" style="line-height:26px;" for="Representative1">
                                        Online payments
                                      </label>
                                    </div>
                                  </div>
                                </div>
                                <div class="me-3">
                                  <div class="" style="padding-top: 5px;">
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" name="committee_payments" id="Representative1" value="Y">
                                      <label class="form-check-label d-block" style="line-height:26px;" for="Representative1">
                                        Committee payments
                                      </label>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div> -->


                          <hr>
                          <a href="#"> <button type="submit" class="btn save">Proceed</button></a>

                          <!-- </form> -->
                        </div>

                      </div>
                  </section>
                  <!--  -->
              </form>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Company</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" action="<?php echo SITE_URL; ?>homes/company">

        <div class="modal-body">
          <div class="form-group row">
            <label class="col-form-label col-sm-3">Name</label>
            <div class="col-sm-8">
              <input type="text" required name="name" placeholder="Company name" value="" class="form-control">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Create</button>
        </div>

      </form>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    // bsCustomFileInput.init();


    var slugify = function(text) {
      return text.toString()
        .replace(/\s+/g, '-') // Replace spaces with -
        .replace(/[^\w\-]+/g, '') // Remove all non-word chars
        .replace(/\-\-+/g, '-') // Replace multiple - with single -
        .replace(/^-+/, '') // Trim - from start of text
        .replace(/-+$/, ''); // Trim - from end of text
    }

    $('.slug').on('keyup', function(e) {
      text = $(e.target).val();
      // alert(text);

      if (text) {
        $('.slug-display').empty().append('https://staging.eboxtickets.com/event/<strong>' + slugify(text) + '</strong>');
      } else {
        $('.slug-display').empty().append('https://staging.eboxtickets.com/event/' + '<strong>270402</strong>');
      }
    }).on('blur', function(e) {
      $(e.target).val(slugify(e.target.value));
    });


    $('input[type="file"]').change(function(e) {
      var fileName = e.target.files[0].name;
      $('#imagenamexx').html(fileName);
      var fuData = document.getElementById('file-7');
      var FileUploadPath = fuData.value;
      // alert(FileUploadPath);
      //To check if user upload any file
      if (FileUploadPath == '') {
        alert("Please upload an image");
      } else {
        var Extension = FileUploadPath.substring(
          FileUploadPath.lastIndexOf('.') + 1).toLowerCase();
        //The file uploaded is an image
        if (Extension == "png" || Extension == "jpeg" || Extension == "jpg") {
          // To Display
          var img = document.getElementById("file-7");


          if (img.files[0]) // validation according to file size
          {
            uploadimage(img);

          }
        }
        //The file upload is NOT an image
        else {
          document.getElementById("showfeatimage").style.display = "block";
          document.getElementById("file-7").value = "";
          $('#imagenamexx').html('');

          return false;
        }
      }

    });

  });
</script>

<!-- Calendra 1  -->
<script>
  $('#example1').calendar();
  $('#example2').calendar({
    type: 'date'
  });
  $('#example3').calendar({
    type: 'time'
  });
  $('#rangestart').calendar({
    type: 'date',
    endCalendar: $('#rangeend')
  });
  $('#rangeend').calendar({
    type: 'date',
    startCalendar: $('#rangestart')
  });
  $('#example4').calendar({
    startMode: 'year'
  });
  $('#example5').calendar();
  $('#example6').calendar({
    ampm: false,
    type: 'time'
  });
  $('#example7').calendar({
    type: 'month'
  });
  $('#example8').calendar({
    type: 'year'
  });
  $('#example9').calendar();
  $('#example10').calendar({
    on: 'hover'
  });
  var today = new Date();
  $('#example11').calendar({
    minDate: new Date(today.getFullYear(), today.getMonth(), today.getDate() - 5),
    maxDate: new Date(today.getFullYear(), today.getMonth(), today.getDate() + 5)
  });
  $('#example12').calendar({
    monthFirst: false
  });
  $('#example13').calendar({
    monthFirst: false,
    formatter: {
      date: function(date, settings) {
        if (!date) return '';
        var day = date.getDate();
        var month = date.getMonth() + 1;
        var year = date.getFullYear();
        return day + '/' + month + '/' + year;
      }
    }
  });
  $('#example14').calendar({
    inline: true
  });
  $('#example15').calendar();
</script>

<!-- =============================== -->
<!-- Calendra 2  -->
<script>
  $('#exampleE').calendar();
  $('#example2').calendar({
    type: 'date'
  });
  $('#example3').calendar({
    type: 'time'
  });
  $('#rangestart').calendar({
    type: 'date',
    endCalendar: $('#rangeend')
  });
  $('#rangeend').calendar({
    type: 'date',
    startCalendar: $('#rangestart')
  });
  $('#example4').calendar({
    startMode: 'year'
  });
  $('#example5').calendar();
  $('#example6').calendar({
    ampm: false,
    type: 'time'
  });
  $('#example7').calendar({
    type: 'month'
  });
  $('#example8').calendar({
    type: 'year'
  });
  $('#example9').calendar();
  $('#example10').calendar({
    on: 'hover'
  });
  var today = new Date();
  $('#example11').calendar({
    minDate: new Date(today.getFullYear(), today.getMonth(), today.getDate() - 5),
    maxDate: new Date(today.getFullYear(), today.getMonth(), today.getDate() + 5)
  });
  $('#example12').calendar({
    monthFirst: false
  });
  $('#example13').calendar({
    monthFirst: false,
    formatter: {
      date: function(date, settings) {
        if (!date) return '';
        var day = date.getDate();
        var month = date.getMonth() + 1;
        var year = date.getFullYear();
        return day + '/' + month + '/' + year;
      }
    }
  });
  $('#example14').calendar({
    inline: true
  });
  $('#example15').calendar();
</script>
<script>
  $('#myModal').on('shown.bs.modal', function() {
    $('#myInput').trigger('focus')
  })
</script>