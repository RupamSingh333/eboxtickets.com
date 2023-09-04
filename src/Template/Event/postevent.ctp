<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.css"
    rel="stylesheet" type="text/css" />
<script src="https://code.jquery.com/jquery-2.1.4.js"></script>
<script src="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.js">
</script>
<script href="<?php echo SITE_URL; ?>js/datetimepicker_ra.js"></script>


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    crossorigin="anonymous" />
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" crossorigin="anonymous"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.css" rel="stylesheet" />

<style>
#dashboard_pg [type="button"]:not(:disabled) {
    cursor: pointer;
    width: inherit;
    border: none;
    height: inherit;
    color: inherit;
    background-color: inherit;
    font-weight: 600;
    margin-top: 0px;
    padding-bottom: 5px;
    font-size: 12px;
    text-align: center;
    line-height: 26px;
    line-height: 27px;
}
</style>
<section id="dashboard_pg">
    <div class="container">
        <div class="dashboard_pg_btm">
            <div class="dsa_contant">
                <!--  -->
                <!-- <div class="progress_bg">
                  <ul class="progress-tab">
                    <li class="active">Basic Info</li>
                    <li>Event Details</li>
                    <li>Manage Tickets</li>
                    <li>Manage Committee</li>
                    <li>Publish Event</li>
                  </ul>
                </div> -->
                <!-- <div class="form_inner">
                <ul id="progressbar">
                  <li class="active">Event Info</li>
                  <li class="active">Manage Tickets & Addons</li>
                  <li>Questions</li>
                  <li>Settings</li>
                </ul>
              </div> -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-between dash_menutog align-items-center">
                            <!-- <nav class="navbar navbar-expand-lg navbar-light p-0">
                              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <div class="nav nav-pills" id="nav-tab" role="tablist">
                                  <a class="nav-item nav-link active" id="nav-home-tab" href="#" role="tab" aria-controls="nav-home" aria-selected="true">Post Event</a>
                                </div>
                              </div>
                            </nav> -->
                            <div class="top_h">
                                <p class="des_h">Post Event</p>
                            </div>
                            <ul class="list-inline dash_ulbtn">
                                <li class="list-inline-item ">
                                    <a href="<?php echo SITE_URL; ?>event/myevent"> <button type="submit"
                                            class="btn save">View Event</button></a>
                                </li>
                            </ul>
                        </div>
                        <div class="form">
                            <h2><i class="far fa-calendar-plus"></i>Post Event</h2>
                            <div class="form_inner">
                                <!--  -->
                                <div class="table-responsive">
                                    <div class="scroll_tab">
                                        <ul id="progressbar">
                                            <li class="active"><a href="#">Post Event</a> </li>
                                            <li><a href="#">Event Details</a> </li>
                                            <li><a href="#">Manage Tickets</a></li>
                                            <!-- <li> <a href="#e/4">Manage Committee</a></li> -->
                                            <li><a href="#">Publish Event</a></li>
                                            <!-- <li>View Event</li> -->
                                        </ul>
                                    </div>
                                </div>
                                <!--  -->
                                <?php echo $this->Flash->render(); ?>
                                <form method="post" enctype="multipart/form-data" accept-charset="utf-8" id="formsubmit"
                                    class="form-horizontal needs-validation">
                                    <h4>Event Info</h4>
                                    <section id="register">
                                        <div class="register_contant">

                                            <div class="row">
                                                <div class="col-lg-4 col-md-6 col-sm-12 col-12  mb-3">

                                                    <div class="row d-flex align-items-end">
                                                        <div class="col-sm-9 col-8">
                                                            <label for="lastname">
                                                                Company
                                                                <strong style="color:red;">*</strong></label>

                                                            <?php
                                                            // pr($_SESSION);exit;
                                                            if ($_SESSION['postevent']['company_id']) {
                                                                $company_id = $_SESSION['postevent']['company_id'];
                                                            }
                                                            echo $this->Form->input(
                                                                'company_id',
                                                                ['empty' => 'Choose Company', 'options' => $company, 'default' => ($company_id) ? $company_id : "", 'required' => 'required', 'class' => 'form-select', 'label' => false]
                                                            ); ?>
                                                        </div>

                                                        <div class="col-sm-3 col-4">

                                                            <!-- Button trigger modal -->
                                                            <button type="button" class="btn btn-primary Add_com"
                                                                data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                                Add
                                                            </button>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col-lg-4 col-md-6 col-sm-12 col-12  mb-3">
                                                    <label for="firstname">Event Name<strong
                                                            style="color:red;">*</strong></label>
                                                    <?php
                                                    if ($_SESSION['postevent']['name']) {
                                                        $name = $_SESSION['postevent']['name'];
                                                    }
                                                    ?>
                                                    <input type="text" class="form-control" name="name"
                                                        placeholder="Event Name" required
                                                        value="<?php echo isset($name) ? $name : '' ?>">
                                                </div>

                                                <div class="col-lg-4 col-md-6 col-sm-12 col-12  mb-3">
                                                    <label for="lastname">Country<strong
                                                            style="color:red;">*</strong></label>

                                                    <?php
                                                    if ($_SESSION['postevent']['country_id']) {
                                                        $country_id = $_SESSION['postevent']['country_id'];
                                                    }
                                                    echo $this->Form->input(
                                                        'country_id',
                                                        ['empty' => 'Choose Country', 'options' => $country, 'default' => ($country_id) ? $country_id : "", 'required' => 'required', 'class' => 'form-select', 'label' => false]
                                                    ); ?>
                                                </div>

                                                <div class="col-lg-4 col-md-6 col-sm-12 col-12  mb-3">
                                                    <label for="firstname">Location<strong
                                                            style="color:red;">*</strong></label>

                                                    <?php
                                                    if ($_SESSION['postevent']['location']) {
                                                        $location = $_SESSION['postevent']['location'];
                                                    }
                                                    echo $this->Form->input('location', array('class' => 'form-control ', 'type' => 'text', 'placeholder' => 'Location', 'required', 'label' => false, 'value' => ($location) ? $location : "")); ?>

                                                    <!-- <input type="text" class="form-control" name="location" placeholder="Location" required value=""> -->
                                                </div>

                                                <div class="col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                                    <label for="formFile" class="form-label">Upload Image
                                                        <strong style="color:red; font-size:12px;">(Size
                                                            550*550)*JPG,JPEG,PNG</strong>
                                                    </label>
                                                    <?php
                                                    if ($_SESSION['postevent']['event_image']) {
                                                        $event_image = $_SESSION['postevent']['event_image'];
                                                    }
                                                    ?>
                                                    <input class="form-control" id="myImg" <?php if (empty($event_image)) {
                                                                                                echo '';
                                                                                            } ?> type="file"
                                                        name="event_image" required
                                                        accept="image/png, image/gif, image/jpeg"
                                                        value="<?php echo isset($event_image) ? $event_image : '' ?>" />

                                                </div>

                                                <div class="col-lg-4 col-md-6 col-sm-12 col-12  mb-3">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <div class="">
                                                            <label style="opacity:0; padding-top: 4px;"
                                                                class="form-label mb-0">This</label>
                                                            <div class="form-check freeEventCheck colorOrange"
                                                                style="padding-left:1.7rem;">
                                                                <input class="form-check-input" type="checkbox"
                                                                    id="is_free"
                                                                    <?php echo ($_SESSION['postevent']['is_free'] == 'Y') ? 'checked' : ''; ?>
                                                                    name="is_free" value="Y" onchange="valueChanged()">
                                                                <label class="form-check-label mb-0" for="is_free">
                                                                    This Event is FREE
                                                                    <!-- <span class="freeBlink">FREE</span> -->
                                                                </label>
                                                            </div>

                                                            <!-- <label for="formFile" style="" class="form-label">This Event is
                                                          <span class="freeBlink">FREE</span></label>

                                                          <input type="checkbox" id="is_free"
                                                              <? //php echo ($_SESSION['postevent']['is_free'] == 'Y') ? 'checked' : ''; 
                                                                ?>
                                                              name="is_free" value="Y" onchange="valueChanged()"
                                                              class="form-controll"> -->
                                                        </div>
                                                        <div class="request_rsvp">
                                                            <label style="opacity:0; padding-top: 4px;"
                                                                class="form-label mb-0">This</label>
                                                            <div class="form-check freeEventCheck colorGreen"
                                                                style="padding-left:1.7rem;">
                                                                <input class="form-check-input" type="checkbox"
                                                                    id="is_allow"
                                                                    <?php echo ($_SESSION['postevent']['allow_register'] == 'Y') ? 'checked' : ''; ?>
                                                                    name="allow_register" value="Y">
                                                                <label class="form-check-label mb-0" for="is_allow">
                                                                    Allow Registration
                                                                </label>
                                                            </div>

                                                            <!-- <div class="col-lg-2 col-md-6 col-sm-12 col-12 mb-3 request_rsvp">
                                                                <label for="formFile" style="text-decoration: underline;" class="form-label">Allow Registration</label>
                                                                <input type="checkbox" <?php //echo ($_SESSION['postevent']['allow_register'] == 'Y') ? 'checked' : ''; ?> 
                                                                name="allow_register" value="Y" class="form-controll"> -->
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-lg-4 col-md-6 col-sm-12 col-12  mb-3 free">
                                                    <label for="firstname">Currency<strong
                                                            style="color:red;">*</strong></label>
                                                    <?php if ($_SESSION['postevent']['payment_currency']) {
                                                            $payment_currency = $_SESSION['postevent']['payment_currency'];
                                                        }
                                                        echo $this->Form->input(
                                                            'payment_currency',
                                                            ['empty' => 'Choose Payment Type', 'options' => $currency, 'default' => $payment_currency, 'required' => 'required', 'class' => 'form-select', 'label' => false]
                                                        );  ?>

                                                </div>


                                                <div class="col-lg-4 col-md-6 col-sm-12 col-12  mb-3">
                                                    <label for="firstname">Event Start<strong
                                                            style="color:red;">*</strong></label>
                                                    <div class="ui calendar" id="example1">
                                                        <div class="ui input left icon">
                                                            <i class="calendar icon"></i>
                                                            <?php
                                                                if ($_SESSION['postevent']['date_from']) {
                                                                    $date_from = date("F d,Y g:i A", strtotime($_SESSION['postevent']['date_from']));
                                                                }
                                                                ?>
                                                            <input class="form-control" required type="text"
                                                                name="date_from" placeholder="Date/Time"
                                                                autocomplete="off"
                                                                value="<?php echo isset($date_from) ? $date_from : '' ?>">
                                                        </div>
                                                    </div>

                                                    <!-- <input type="date" class="form-control" name="name" required="" value=""> -->
                                                    <?php //echo $this->Form->input('date_from', array('class' => 'longinput form-control input-medium datetimepicker1', 'placeholder' => 'Date From', 'type' => 'datetime-local', 'required', 'label' => false, 'autocomplete' => 'off', 'value' => (!empty($addevent['date_from'])) ? date('Y-m-d H:m', strtotime($addevent['date_from'])) : '')); 
                                                        ?>

                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                                    <label for="firstname">Event End<strong
                                                            style="color:red;">*</strong></label>

                                                    <div class="ui calendar" id="exampleE">
                                                        <div class="ui input left icon">
                                                            <i class="calendar icon"></i>
                                                            <?php
                                                                if ($_SESSION['postevent']['date_to']) {
                                                                    $date_to = date("F d,Y g:i A", strtotime($_SESSION['postevent']['date_to']));
                                                                }
                                                                ?>
                                                            <input class="form-control" required type="text"
                                                                name="date_to" id="date_to"
                                                                value="<?php echo isset($date_to) ? $date_to : '' ?>"
                                                                placeholder="Date/Time" autocomplete="off" disabled>
                                                        </div>
                                                    </div>

                                                    <!-- <input type="date" class="form-control" name="name" required="" value=""> -->
                                                    <?php //echo $this->Form->input('date_to', array('class' => 'longinput form-control input-medium datetimepicker2', 'placeholder' => 'Date To', 'required', 'type' => 'datetime-local', 'label' => false, 'autocomplete' => 'off', 'id' => 'changedate', 'value' => (!empty($addevent['date_to'])) ? date('Y-m-d H:m', strtotime($addevent['date_to'])) : '')); 
                                                        ?>
                                                </div>

                                                <div class="col-lg-4 col-md-6 col-sm-12 col-12  mb-3 free">
                                                    <label for="firstname">Sale Start<strong
                                                            style="color:red;">*</strong></label>
                                                    <?php
                                                        if ($_SESSION['postevent']['sale_start']) {
                                                            $sale_start = date("F d,Y g:i A", strtotime($_SESSION['postevent']['sale_start']));
                                                        }
                                                        ?>
                                                    <div class="ui calendar" id="example3">
                                                        <div class="ui input left icon">
                                                            <i class="calendar icon"></i>
                                                            <input class="form-control"
                                                                value="<?php echo isset($sale_start) ? $sale_start : ''; ?>"
                                                                type="text" name="sale_start" placeholder="Date/Time"
                                                                autocomplete="off" id="sale_start" required disabled>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col-lg-4 col-md-6 col-sm-12 col-12 mb-3 free">
                                                    <label for="firstname">Sale End<strong
                                                            style="color:red;">*</strong></label>

                                                    <div class="ui calendar" id="example4">
                                                        <div class="ui input left icon">
                                                            <i class="calendar icon"></i>
                                                            <?php
                                                                if ($_SESSION['postevent']['sale_end']) {
                                                                    $sale_end = date("F d,Y g:i A", strtotime($_SESSION['postevent']['sale_end']));
                                                                }
                                                                ?>
                                                            <input class="form-control" required type="text"
                                                                name="sale_end"
                                                                value="<?php echo isset($sale_end) ? $sale_end : '' ?>"
                                                                placeholder="Date/Time" autocomplete="off" id="sale_end"
                                                                disabled>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4 col-md-6 col-sm-12 col-12  mb-3 free">
                                                    <label for="firstname">Ticket Limit per person<strong
                                                            style="color:red;">*</strong></label>

                                                    <?php
                                                        $limit = ['1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10'];
                                                        if ($_SESSION['postevent']['ticket_limit']) {
                                                            $ticket_limit = $_SESSION['postevent']['ticket_limit'];
                                                        }

                                                        echo $this->Form->input(
                                                            'ticket_limit',
                                                            ['empty' => 'Choose Limit', 'options' => $limit, 'default' => $ticket_limit, 'required' => 'required', 'class' => 'form-select', 'label' => false]
                                                        ); ?>

                                                </div>

                                                <div class="col-lg-4 col-md-6 col-sm-12 col-12  mb-3 request_rsvp">
                                                    <label for="firstname">Request RSVP By<strong
                                                            style="color:red;">*</strong></label>

                                                    <div class="ui calendar" id="req_rsvp">
                                                        <div class="ui input left icon">
                                                            <i class="calendar icon"></i>
                                                            <?php
                                                                if ($_SESSION['postevent']['request_rsvp']) {
                                                                    $sale_end = date("F d,Y g:i A", strtotime($_SESSION['postevent']['request_rsvp']));
                                                                }
                                                                ?>
                                                            <input class="form-control" required type="text"
                                                                name="request_rsvp"
                                                                value="<?php echo isset($sale_end) ? $sale_end : '' ?>"
                                                                placeholder="Date/Time" autocomplete="off"
                                                                id="req_rsvp_input" disabled>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4 col-md-6 col-sm-12 col-12  mb-3">
                                                    <label for="firstname">URL Slug <strong
                                                            style="color:red;">*</strong></label>
                                                    <?php
                                                        if ($_SESSION['postevent']['slug']) {
                                                            $slug = $_SESSION['postevent']['slug'];
                                                        }
                                                        ?>
                                                    <input type="text" class="form-control slug" id="slugyfy"
                                                        placeholder="Slug" required name="slug"
                                                        value="<?php echo isset($slug) ? $slug : '' ?>">
                                                    <span id="checkalready"><strong style="color:red;">Already
                                                            exist</strong></span>
                                                </div>


                                                <div class="col-lg-4 col-md-6 col-sm-12 col-12  mb-3 free">
                                                    <label for="firstname">Approval Expiry<strong
                                                            style="color:red;">*</strong></label>

                                                    <?php
                                                        $approve = ['1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7'];

                                                        if ($_SESSION['postevent']['approve_timer']) {
                                                            $approve_timer = $_SESSION['postevent']['approve_timer'];
                                                        }

                                                        echo $this->Form->input(
                                                            'approve_timer',
                                                            ['empty' => 'Choose Days', 'options' => $approve, 'default' => $approve_timer, 'required' => 'required', 'class' => 'form-select', 'label' => false]
                                                        ); ?>

                                                </div>

                                                <div class="col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                                                    <?php
                                                        if ($_SESSION['postevent']['video_url']) {
                                                            $video_url = $_SESSION['postevent']['video_url'];
                                                        }
                                                        ?>
                                                    <label for="formFile" class="form-label">Youtube URL</label>
                                                    <input class="form-control"
                                                        value="<?php echo ($video_url) ? $video_url : ''; ?>" type="url"
                                                        id="formFile" name="video_url" placeholder="Youtube URL">
                                                </div>

                                                <div class="col-md-6  mb-3">
                                                    <label for="firstname">Share URL</label>
                                                    <span
                                                        class="slug-display"><?php echo SITE_URL; ?>event/<?php echo isset($slug) ? $slug : ''; ?></span>
                                                </div>
                                                <div class="col-md-12  mb-3">
                                                    <label for="exampleFormControlTextarea1"
                                                        class="form-label">Description<strong
                                                            style="color:red;">*</strong></label>
                                                    <?php
                                                        if ($_SESSION['postevent']['desp']) {
                                                            $desp = $_SESSION['postevent']['desp'];
                                                        }
                                                        ?>
                                                    <textarea class="form-control" required name="desp" id="summernote"
                                                        rows="3"><?php echo isset($desp) ? $desp : '' ?></textarea>
                                                </div>

                                                <div class="col-md-12 text-end">
                                                    <a href="#"> <button type="submit"
                                                            class="btn submit">Submit</button></a>
                                                </div>


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
                            <input type="text" required name="name" placeholder="Company name" value=""
                                class="form-control">
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
$(function() { //shorthand document.ready function
    $('#formsubmit').on('submit', function(e) { //use on if jQuery 1.7+
        $('.preloader').show();
    });
});


function valueChanged() {
    if ($('#is_free').is(":checked")) {
        $(".free").hide();
        $(".request_rsvp").show();
        $('#req_rsvp_input').prop('required', true);
        $('#payment-currency').prop('required', false);
        $('#sale_start').prop('required', false);
        $('#sale_end').prop('required', false);
        $('#ticket-limit').prop('required', false);
        $('#approve-timer').prop('required', false);
    } else {
        $(".free").show();
        $(".request_rsvp").hide();
        // $(".request_rsvp").value('');
        $('#ticket-limit').prop('required', true);
        $('#req_rsvp_input').prop('required', false);
        $('#approve-timer').prop('required', true);
        $('#payment-currency').prop('required', true);
        $('#sale_start').prop('required', true);
        $('#sale_end').prop('required', true);
    }

}

// image validation 
var _URL = window.URL || window.webkitURL;
$("#myImg").change(function(e) {
    var file, img, Extension;
    Extension = this.files[0]['name'].split('.').pop();

    if (Extension == "png" || Extension == "jpeg" || Extension == "jpg") {
        // To Display
        var img = document.getElementById("myImg");
        if (img.files[0]) // validation according to file size
        {
            // uploadimage(img);
        }
    } else {
        document.getElementById("myImg").value = "";
        $('#imagenamexx').html('');
        alert('Uploaded file is not a valid image. Only JPG, PNG and JPEG files are allowed.')
        return false;
    }

    if ((file = this.files[0])) {
        img = new Image();
        var objectUrl = _URL.createObjectURL(file);
        img.onload = function() {
            if (this.width < 200 || this.height < 200) {
                alert(
                    `Image dimensions are too small. Minimum (Size 200*200)*. Uploaded image (Size ${this.height} px * ${this.width})`
                );
                document.getElementById("myImg").value = "";
            }
            _URL.revokeObjectURL(objectUrl);
        };
        img.src = objectUrl;
    }
});


$(document).ready(function() {
    var is_free = '<?php echo $_SESSION['postevent']['is_free'] ?>';
    $(".request_rsvp").hide();
    $("#is_allow_register").hide();
    $('#req_rsvp_input').prop('required', false);
    if (is_free == 'Y') {
        $(".free").hide();
        $(".request_rsvp").show();
        $('#payment-currency').prop('required', false);
        $('#sale_start').prop('required', false);
        $('#sale_end').prop('required', false);
        $('#ticket-limit').prop('required', false);
        $('#approve-timer').prop('required', false);
    } else {
        $(".free").show();
        $(".request_rsvp").hide();
        $('#ticket-limit').prop('required', true);
        $('#approve-timer').prop('required', true);
        $('#payment-currency').prop('required', true);
        $('#sale_start').prop('required', true);
        $('#sale_end').prop('required', true);
    }
    var SITE_URL = '<?php echo SITE_URL . 'event/'; ?>';
    var lateventid = '<?php echo $lateventid; ?>';

    $("#checkalready").hide();

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
        if (text) {
            $('.slug-display').empty().append(SITE_URL + '<strong>' + slugify(text) + '</strong>');
        } else {
            $('.slug-display').empty().append(SITE_URL + '<strong>' + lateventid + '</strong>');
            return false;
        }

        $.ajax({
            async: true,
            data: {
                'exist_slug': text
            },
            dataType: "json",
            type: "POST",
            url: "<?php echo SITE_URL; ?>event/checkexist",
            success: function(data) {
                // console.log(data);
                if (data != null) {
                    $("#checkalready").show();
                    $("#slugyfy").val('');
                    $('.slug-display').empty().append(SITE_URL);
                } else {
                    $("#checkalready").hide();
                }
            },
        });


    }).on('blur', function(e) {
        $(e.target).val(slugify(e.target.value));
    });

});
</script>

<!-- Calendra 1  -->
<script>
var today = new Date();

$('#example1').calendar({
    type: 'datetime',
    minDate: new Date(today.getFullYear(), today.getMonth(), today.getDate(), today.getHours() + 1),
    onChange: function(date, text) {
        var fffsss = new Date(text);
        var event_end_date = new Date(text);
        $('#date_to').removeAttr("disabled")
        // $('span[id^="event_start_date"]').remove();
        if ($('#exampleE').val()) {

        } else {
            $('#exampleE').calendar({
                type: 'datetime',
                dateFormat: "yymmdd",
                minDate: new Date(fffsss.getFullYear(), fffsss.getMonth(), fffsss.getDate(), fffsss
                    .getHours() + 1),
                onChange: function(date, text) {
                    var fffsss = new Date(text);
                    $('#sale_start').removeAttr("disabled")
                    $('#req_rsvp_input').removeAttr("disabled")
                    $('#example3').calendar({
                        type: 'datetime',
                        minDate: new Date(today.getFullYear(), today.getMonth(), today
                            .getDate(), today.getHours()),
                        maxDate: new Date(fffsss.getFullYear(), fffsss.getMonth(),
                            fffsss.getDate(), fffsss.getHours() - 1),
                        onChange: function(date, text) {
                            $('#sale_end').removeAttr("disabled")
                            var fffsssdddss = new Date(text);
                            $('#example4').calendar({
                                type: 'datetime',
                                minDate: new Date(fffsssdddss.getFullYear(),
                                    fffsssdddss.getMonth(), fffsssdddss
                                    .getDate(), fffsssdddss.getHours()),
                                maxDate: new Date(fffsss.getFullYear(),
                                    fffsss.getMonth(), fffsss.getDate(),
                                    fffsss.getHours() - 1),
                            });
                        }
                    });

                    $('#example4').calendar({
                        type: 'datetime',
                        minDate: new Date(today.getFullYear(), today.getMonth(), today
                            .getDate(), today.getHours()),
                        maxDate: new Date(fffsss.getFullYear(), fffsss.getMonth(),
                            fffsss.getDate(), fffsss.getHours() - 1),
                    });

                }
            });

        }

        $('#req_rsvp').calendar({
            type: 'datetime',
            dateFormat: "dd.mm.yy",
            minDate: new Date(today.getFullYear(), today.getMonth(), today.getDate(), today
                .getHours() - 1),
            maxDate: new Date(event_end_date.getFullYear(), event_end_date.getMonth(),
                event_end_date.getDate(), event_end_date.getHours() - 1),
            // onChange: function(date, text) {
            //   var req_rsvp = new Date(text);
            //   $('#req_rsvp').calendar({
            //     type: 'datetime',
            //     minDate: new Date(today.getFullYear(), today.getMonth(), today.getDate(), today.getHours() - 1),
            //     maxDate: new Date(event_end_date.getFullYear(), event_end_date.getMonth(), event_end_date.getDate(), event_end_date.getHours() - 1),
            //   });
            // }
        });

    }
});

//   $('#exampleE').calendar({
//   type: 'datetime',
//   minDate: new Date(today.getFullYear(), today.getMonth(), today.getDate()),
//   onChange: function (date, text) {
//     $('span[id^="event_start_date"]').remove();
//     if($('#example1').val()){
//     }else{
//       //alert('test');
//       $("#example1").after('<span class="error" id ="event_start_date" style="color:red">Select Event start date</span>');
//       var fffsss = new Date(text);
//       $('#example1').calendar({
//         type: 'datetime',
//         minDate: new Date(today.getFullYear(), today.getMonth(), today.getDate()),
//         maxDate: new Date(fffsss.getFullYear(), fffsss.getMonth(), fffsss.getDate()),
//         onChange: function (date, text) {
//           $('span[id^="event_start_date"]').remove();
//         }
//     });


//     }
//     $('#example3').calendar({
//         type: 'datetime',
//         minDate: new Date(today.getFullYear(), today.getMonth(), today.getDate()),
//         maxDate: new Date(fffsss.getFullYear(), fffsss.getMonth(), fffsss.getDate()),
//         onChange: function (date, text) {
//         var fffsss = new Date(text);    
//         //alert('test');
//         var fffssdds = new Date($('#exampleE').val());    
//           $('#example4').calendar({
//           type: 'datetime',
//           minDate: new Date(fffsss.getFullYear(), fffsss.getMonth(), fffsss.getDate()),
//           maxDate: new Date(fffssdds.getFullYear(), fffssdds.getMonth(), fffssdds.getDate()),
//           });
//         }
//     });

//     $('#example4').calendar({
//         type: 'datetime',
//         minDate: new Date(today.getFullYear(), today.getMonth(), today.getDate()),
//         maxDate: new Date(fffsss.getFullYear(), fffsss.getMonth(), fffsss.getDate()),
//     });

//   }
// });

// $('#example3').calendar({
//         type: 'datetime',
//         minDate: new Date(today.getFullYear(), today.getMonth(), today.getDate()),
//         onChange: function (date, text) {
//         var fffsss = new Date(text);    

//         var fffssdds = new Date($('#exampleE').val());    
//           $('#example4').calendar({
//           type: 'datetime',
//           minDate: new Date(fffsss.getFullYear(), fffsss.getMonth(), fffsss.getDate()),
//           maxDate: new Date(fffssdds.getFullYear(), fffssdds.getMonth(), fffssdds.getDate()),
//           });
//         }
//     });

//     $('#example4').calendar({
//         type: 'datetime',
//         minDate: new Date(today.getFullYear(), today.getMonth(), today.getDate()),
//     });
</script>
<script>
$('#myModal').on('shown.bs.modal', function() {
    $('#myInput').trigger('focus')
})
</script>