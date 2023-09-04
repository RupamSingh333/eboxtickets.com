<script type="text/javascript">
  function isPrice(e) {
    var e = e || window.event;
    var k = e.which || e.keyCode;
    var s = String.fromCharCode(k);
    if (/^[\\\"\'\;\:\.\,\[\]\>\<\/\?\=\+\_\|~`!@#\$%^&*\(\)a-z\A-Z]$/i.test(s)) {
      alert("Special characters not acceptable");
      return false;
    }
  }
</script>
<script type="text/javascript">
  function isCspecial(e) {
    var e = e || window.event;
    var k = e.which || e.keyCode;
    var s = String.fromCharCode(k);
    if (/^[\\\"\'\;\:\>\<\[\]\-\.\,\/\?\=\+\_\|~`!@#\$%^&*\(\)0-9]$/i.test(s)) {
      alert("Special characters not acceptable");
      return false;
    }
  }
</script>
<?php //pr($event);die;
?>
<!-- https://www.youtube.com/watch?v=OK_JCtrrv-c -->
<style type="text/css">
  .are {
    margin-top: -6px;
  }

  .bfh-timepicker-popover table {
    width: 280px;
    margin: 0
  }

  select.form-control:not([size]):not([multiple]) {
    height: calc(1.99rem + 2px) !important;
  }
</style>
</style>
<div class="breadcrumbs">
  <div class="col-sm-4">
    <div class="page-header float-left">
    </div>
  </div>
  <div class="col-sm-8">
    <div class="page-header float-right">
      <div class="page-title">
        <ol class="breadcrumb text-right">
          <li><a href="<?php echo ADMIN_URL; ?>dashboard ">Dashboard</a></li>
          <li><a href="<?php echo ADMIN_URL; ?>event/index ">Event Manager</a></li>
        </ol>
      </div>
    </div>
  </div>
</div>
<!--<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">-->

<?php echo $this->Flash->render(); ?>
<?php echo $this->Form->create($event, array('class' => 'form-horizontal', 'id' => 'sevice_form', 'enctype' => 'multipart/form-data')); ?>

<div class="col-lg-12">
  <div class="card">
    <div class="card-header"><strong> <?php if (isset($event['id'])) {
                                        echo 'Edit Event';
                                      } else {
                                        echo 'Add Event';
                                      } ?></strong></div>
    <div class="card-body card-block">
      <div class="col-sm-6">
        <div class="form-group">
          <label>Event Organiser</label>
          <?php
          echo $this->Form->input('event_org_id', array('class' => 'form-control longinput  input-medium', 'empty' => 'Select Organiser', 'options' => $event_org_list, 'required', 'label' => false, 'id' => 'sta', 'autocomplete' => 'off', 'value' => $event['event_org_id'], 'readonly', 'disabled')); ?>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="form-group">
          <label>Event Name</label>
          <?php
          echo $this->Form->input('name', array('class' => 'longinput form-control input-medium', 'placeholder' => 'Event Name', 'type' => 'text', 'label' => false, 'id' => 'dis', 'required', 'autocomplete' => 'off')); ?>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="form-group">
          <label>Event Organiser Email</label>
          <?php
          echo $this->Form->input('email', array('class' => 'longinput form-control input-medium', 'placeholder' => 'Organiser Email', 'type' => 'email', 'label' => false, 'id' => 'emailuser', 'readonly', 'value' => $event_organizer['email'], 'autocomplete' => 'off', 'disabled')); ?>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="form-group">
          <label>Event Organiser Mobile</label>
          <?php
          echo $this->Form->input('mobile', array('class' => 'longinput form-control input-medium', 'placeholder' => 'Organiser Mobile Number', 'type' => 'text', 'label' => false, 'readonly', 'id' => 'mobileuser', 'value' => $event_organizer['mobile'], 'autocomplete' => 'off', 'disabled')); ?>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="form-group">
          <label for="company" class=" form-control-label">Event Date From</label>

          <?php echo $this->Form->input('date_from', array('class' => 'longinput form-control input-medium datetimepicker1', 'placeholder' => 'Date From', 'required' => true, 'type' => 'text', 'required', 'label' => false, 'value' => strftime('%d-%b-%Y %H:%M:%S', strtotime($event['date_from'])), 'autocomplete' => 'off')); ?>
          <!--<input type="text" name="date_from" id="datepicker1" class="longinput form-control input-medium" placeholder ="Event Date From" readonly />-->


        </div>
      </div>
      <div class="col-sm-6">
        <div class="form-group">
          <label for="company" class=" form-control-label">Event Date To</label>

          <?php echo $this->Form->input('date_to', array('class' => 'longinput form-control input-medium datetimepicker2', 'placeholder' => 'Date To', 'required' => true, 'type' => 'text', 'required', 'label' => false, 'value' => strftime('%d-%b-%Y %H:%M:%S', strtotime($event['date_to'])), 'autocomplete' => 'off')); ?>
          <!-- <input type="text" name="date_to" id="datepicker2" class="longinput form-control input-medium" placeholder ="Event Date To" readonly />-->
        </div>
      </div>

      <div class="col-sm-6">
        <div class="form-group">
          <label>Featured Image</label>
          <?php
          echo $this->Form->input('feat_image', array('class' => 'longinput form-control input-medium are', 'type' => 'file', 'label' => false, 'autocomplete' => 'off', 'onchange' => 'return ValidateFileUpload()', 'id' => 'fileChooser')); ?>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="form-group">
          <label>Youtube URL</label>
          <?php
          echo $this->Form->input('video_url', array('class' => 'longinput form-control input-medium', 'placeholder' => 'Enter youtube url', 'type' => 'url', 'label' => false, 'autocomplete' => 'off', 'onchange' => 'return Validateyoutubeurl()', 'id' => 'viourl')); ?>
        </div>
      </div>

      <div class="col-sm-6">
        <div class="form-group">
          <span id="showfeatimage" style="color:red;display:none">Image only allows file types of PNG, JPG, JPEG !!!</span>
          <span id="showfeatsize" style="color:red;display:none">Image size too large !!!</span>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="form-group">
          <span id="showyoutubeurl" style="color:red;display:none">Please upload only you tube url !!!</span>
        </div>
      </div>

      <?php if ($event['feat_image']) { ?>
        <div class="col-sm-6">
          <div class="form-group">
            <img src="<?php echo SITE_URL; ?>images/eventimages//<?php echo $event['feat_image']; ?>" height="70px" width="150px" style="display:block;">
          </div>
        </div>
      <?php } ?>

      <div class="col-sm-12">
        <h6><strong>Ticket Details</strong></h6>
      </div>
      <div class="col-sm-12">
        <div class="multi-field-wrapper formmrgn">
          <div class="form-group product_containes " style="padding: 15px;">
            <?php
            foreach ($evntdetail['eventdetail'] as $key => $value) {
              // pr($value);die;
            ?>
              <div class="video_details row" style="margin-bottom: 10px;">
                <label for="inputEmail3" class="col-sm-1 control-label">Ticket Type</label>
                <div class="col-sm-2 input_fields_wrap">
                  <?php echo $this->Form->input('title[]', array('class' => 'form-control price', 'type' => 'text', 'label' => false, 'placeholder' => 'Enter Ticket Type', 'required', 'maxlength' => '50', 'onkeypress' => 'return isCspecial()', 'autocomplete' => 'off', 'value' => $value['title'])); ?>
                  <h5 id="pmsg" style="display:none;" class="text">**Special characters not acceptable</h5>
                </div>
                <label for="inputEmail3" class="col-sm-1 control-label">Quantity</label>
                <div class="col-sm-2 input_fields_wrap">
                  <?php echo $this->Form->input('count[]', array('class' => 'form-control price', 'type' => 'text', 'label' => false, 'placeholder' => 'Enter Quantity', 'required', 'maxlength' => '3', 'onkeypress' => 'return isPrice()', 'autocomplete' => 'off', 'value' => $value['count'])); ?>
                </div>
                <label for="inputEmail3" class="col-sm-1 control-label">Price</label>
                <div class="col-sm-1">
                  <input type="text" value="US $" readonly class="longinput form-control">
                </div>
                <div class="col-sm-3 input_fields_wrap">
                  <?php echo $this->Form->input('price[]', array('class' => 'form-control price', 'type' => 'text', 'label' => false, 'placeholder' => 'Enter Price', 'required', 'onkeypress' => 'return isPrice()', 'maxlength' => '5', 'autocomplete' => 'off', 'value' => $value['price'])); ?>
                </div>

                <?php if ($key == 0) { ?>
                  <div class="col-sm-2">
                    <a href="javascript:void(0);" class="add-batch-fields" id="handing_btn"><i class="fa fa-plus-circle" style="font-weight: bold; font-size: 15px; display:inline-block; margin-top:12px; color: #337ab7;"></i></a>
                  </div>
                <?php } else { ?>
                  <div class="col-sm-2">
                    <a href="javascript:void(0);" class="remove text-danger">
                      <i class="fa fa-minus-circle" style="font-weight: bold; font-size: 15px; display:inline-block; margin-top:12px;">
                      </i></a>
                  </div>
                <?php  } ?>
              </div>
            <?php  } ?>
          </div>
        </div>
      </div>
      <div class="col-sm-12">
        <span id="showmsg" style="color:red;display:none">Please Enter Only Numeric Characters !!!</span>
        <span id="showseatsize" style="color:red;display:none">Maximum seats exceed !!!</span>
        <span id="showamountsize" style="color:red;display:none">Maximum Amount exceed !!!</span>
      </div>
      <div class="col-sm-4">
        <label for="lastname">Company<strong style="color:red;">*</strong></label>

        <?php
        if ($_SESSION['postevent']['company_id']) {
          $company_id = $_SESSION['postevent']['company_id'];
        } else if ($eventDetails['company_id']) {
          $company_id = $eventDetails['company_id'];
        }
        echo $this->Form->input(
          'company_id',
          ['empty' => 'Choose Company', 'options' => $company, 'default' => ($company_id) ? $company_id : "", 'required' => 'required', 'class' => 'form-control', 'label' => false]
        ); ?>
      </div>
      <div class="col-sm-4">
        <label for="lastname">Country<strong style="color:red;">*</strong></label>

        <?php
        if ($_SESSION['postevent']['country_id']) {
          $country_id = $_SESSION['postevent']['country_id'];
        } else if ($eventDetails['country_id']) {
          $country_id = $eventDetails['country_id'];
        }
        echo $this->Form->input(
          'country_id',
          ['empty' => 'Choose Country', 'options' => $country, 'default' => ($country_id) ? $country_id : "", 'required' => 'required', 'class' => 'form-control', 'label' => false]
        ); ?>

      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <label>Venue</label>
          <?php echo $this->Form->input('location', array('class' =>
          'longinput form-control', 'placeholder' => 'Location', 'label' => false, 'id' => 'pac-input', 'autocomplete' => 'off')); ?>
          <!-- <input id="pac-input" type="text" class="form-control" placeholder="Location" required  value=""name="location">-->
          <div id="map"></div>
          <?php echo $this->Form->input('lat', array('class' => 'form-control', 'type' => 'hidden', 'id' => 'latitude', 'label' => false)); ?>
          <?php echo $this->Form->input('longs', array('class' => 'form-control', 'type' => 'hidden', 'id' => 'longitude', 'label' => false)); ?>
        </div>
      </div>

      <div class="col-sm-12">
        <div class="form-group">
          <label>Event Descripion</label>

          <script>
            var site_url = '<?php echo SITE_URL; ?>';

            $(document).ready(function() {
              $("#summernote").summernote({
                placeholder: 'enter directions here...',
                height: 300,
                callbacks: {
                  onImageUpload: function(files, editor, welEditable) {

                    for (var i = files.length - 1; i >= 0; i--) {
                      sendFile(files[i], this);
                    }
                  }
                },
                toolbar: [
                  // [groupName, [list of button]]
                  ['style', ['bold', 'italic', 'underline', 'clear', 'fontname', 'fontsize', 'color', 'bold', 'italic', 'underline']],
                  ['font', ['strikethrough', 'superscript', 'subscript', 'clear']],
                  ['fontsize', ['fontsize']],
                  ['color', ['color']],
                  ['para', ['ul', 'ol', 'paragraph']],
                  ['height', ['height']],
                  ['picture', ['picture']],
                  ['Misc', ['fullscreen', 'codeview', 'undo', 'redo']]
                ]
              });
            });

            function sendFile(file, el) {
              var form_data = new FormData();
              form_data.append('file', file);
              $.ajax({
                data: form_data,
                type: "POST",
                url: '<?php echo ADMIN_URL; ?>Event/uploadimage',
                cache: false,
                contentType: false,
                processData: false,
                success: function(url) {
                  //alert(url);
                  $(el).summernote('editor.insertImage', url);
                }
              });
            }
          </script>

          <?php echo $this->Form->input('desp', array('class' =>
          'longinput form-control summernote', 'placeholder' => 'Event Descripation', 'label' => false, 'type' => 'textarea', 'autocomplete' => 'off')); ?>
        </div>
      </div>
      <input type="hidden" name="event_id" id="eventidval" value="<?php echo $event['id']; ?>">
      <div class="col-sm-12">
        <div class="form-group">
          <div class="col-sm-1">
            <a href="<?php echo ADMIN_URL ?>event/index" class="btn btn-primary ">Back</a>
          </div>
          <div class="col-sm-1">
            <?php if (isset($event['id'])) {
              echo $this->Form->submit('Update', array(
                'title' => 'Update', 'div' => false,
                'class' => array('btn btn-success')
              ));
            } else {  ?>
              <button type="submit" class="btn btn-success">Update</button>
            <?php  } ?>
          </div>
        </div>
      </div>

    </div>

    <!--<div class="content mt-3">
       <div class="row">
        <div class="col-sm-1">
         <a href="<?php echo ADMIN_URL ?>event/index" class="btn btn-primary " >Back</a>
       </div>
       <div class="col-sm-1">
        <?php if (isset($event['id'])) {
          echo $this->Form->submit('Update', array(
            'title' => 'Update', 'div' => false,
            'class' => array('btn btn-primary btn-sm')
          ));
        } else {  ?>
            <button type="submit" class="btn btn-success">Submit</button>
          <?php  } ?>
        </div>
      </div>
    </div>-->
  </div>
</div>
<?php echo $this->Form->end(); ?>
<script type="text/javascript">
  $(function() {
    var start = new Date();
    // set end date to max one year period:
    var end = new Date(new Date().setYear(start.getFullYear() + 1));
    $('.datetimepicker1').datetimepicker({
      format: 'MM dd,yyyy hh:ii',
      language: 'en',
      pickTime: false,
      pick12HourFormat: true,
      startDate: start,
      endDate: end,
    }).on('changeDate', function() {
      $('.datetimepicker2').datetimepicker('setStartDate', new Date($(this).val()));
      $(this).datetimepicker('hide');
    });
    $('.datetimepicker2').datetimepicker({
      format: 'MM dd,yyyy hh:ii',
      language: 'en',
      pickTime: false,
      pick12HourFormat: true,
      startDate: start,
      endDate: end,
    }).on('changeDate', function() {
      $(this).datetimepicker('hide');
    });
  });
</script>


<script>
  $(document).ready(function() {
    $('#sta').on('change', function() {
      var id = $('#sta').val();
      //alert(id);;
      $.ajax({
        type: 'POST',
        url: '<?php echo ADMIN_URL; ?>Event/findevent',
        data: {
          'id': id
        },
        success: function(data) {

          if (data) {
            //alert(data);
            var o = JSON.parse(data);
            console.log(o.email);
            $('#emailuser').val(o.email);
            $('#mobileuser').val(o.mobile);
          }
        },

      });
    });
  });
</script>

<script>
  $('.numberseat').change(function() {

    //  e.preventDefault();
    var eventid = document.getElementById('eventidval').value;
    var seatsi = document.getElementById('seatsize').value;

    $.ajax({
      type: "POST",
      url: '<?php echo SITE_URL; ?>admin/event/seatcheck',
      data: {
        'id': eventid,
        'seat': seatsi
      },
      cache: false,
      success: function(data) {
        //alert(data);
        if (data == 0) {

          document.getElementById("showmsgseatcheck").style.display = "block";
          document.getElementById("seatsize").value = '';

        } else {
          document.getElementById("showmsgseatcheck").style.display = "none";

        }

      }
    });

  });




  function isNumberKey(evt) {
    var seatsi = document.getElementById('seatsize');
    var amountsi = document.getElementById('amountsize');
    var seatsizevalidate = seatsi.value.length;
    var amountsizevalidate = amountsi.value.length;
    //alert(seatsizevalidate);
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if (charCode == 8) //back space
      return true;
    if (charCode < 48 || charCode > 57) //0-9
    {
      document.getElementById("showmsg").style.display = "block";
      //alert("Please Enter Only Numbers");
      return false;
    } else {
      if (seatsizevalidate > 5) {
        document.getElementById("showseatsize").style.display = "block";
        document.getElementById("seatsize").value = '';
        return false;
      } else if (amountsizevalidate > 5) {

        document.getElementById("showamountsize").style.display = "block";
        document.getElementById("amountsize").value = '';
        return false;
      } else {
        document.getElementById("showmsg").style.display = "none";
        document.getElementById("showseatsize").style.display = "none";
        document.getElementById("showamountsize").style.display = "none";
        return true;
      }

    }
  }
</script>

<script type="text/javascript">
  function ValidateFileUpload() {
    var fuData = document.getElementById('fileChooser');
    var FileUploadPath = fuData.value;

    //To check if user upload any file
    if (FileUploadPath == '') {
      alert("Please upload an image");
    } else {
      var Extension = FileUploadPath.substring(
        FileUploadPath.lastIndexOf('.') + 1).toLowerCase();
      //The file uploaded is an image

      if (Extension == "png" || Extension == "jpeg" || Extension == "jpg") {

        // To Display

        var img = document.getElementById("fileChooser");


        if (img.files[0].size < 1048576) // validation according to file size
        {
          //alert(img.files[0].size);
          document.getElementById("showfeatimage").style.display = "none";
          document.getElementById("showfeatsize").style.display = "none";
          return true;
        } else {
          document.getElementById("showfeatimage").style.display = "none";
          document.getElementById("showfeatsize").style.display = "block";
          document.getElementById("fileChooser").value = "";
          return false;

        }


      }
      //The file upload is NOT an image
      else {
        document.getElementById("showfeatimage").style.display = "block";
        document.getElementById("fileChooser").value = "";
        return false;
      }
    }
  }
</script>

<script>
  $(document).ready(function() {
    $(".add-batch-fields").click(function() {

      $(".product_containes").append(`
      <div class="video_details row" style="margin-bottom: 10px;">
      <label for="inputEmail3" class="col-sm-1 control-label">Ticket Type</label>
      <div class="col-sm-2 input_fields_wrap">
      <?php echo $this->Form->input('title[]', array('class' => 'form-control price', 'type' => 'text', 'required', 'label' => false, 'placeholder' => 'Enter Ticket Type', 'autocomplete' => 'off', 'onkeypress' => 'return isCspecial()', 'maxlength' => '50')); ?>
      </div>
      <label for="inputEmail3" class="col-sm-1 control-label">Quantity</label>
      <div class="col-sm-2 input_fields_wrap">
      <?php echo $this->Form->input('quantity[]', array('class' => 'form-control price', 'type' => 'text', 'required', 'label' => false, 'placeholder' => 'Enter Quantity', 'onkeypress' => 'return isPrice()', 'maxlength' => '3', 'autocomplete' => 'off')); ?>
      </div>
      <label for="inputEmail3" class="col-sm-1 control-label">Price</label>
      <div class="col-sm-1">
      <input type="text" value="US $" readonly class="longinput form-control">
      </div>
      <div class="col-sm-3 input_fields_wrap">
      <?php echo $this->Form->input('price[]', array('class' => 'form-control price', 'type' => 'text', 'required', 'label' => false, 'placeholder' => 'Enter price', 'onkeypress' => 'return isPrice()', 'maxlength' => '5', 'autocomplete' => 'off')); ?>
      </div>
      <div class="col-sm-2">
      <a href="javascript:void(0);" class="remove text-danger">
      <i class="fa fa-minus-circle" style="font-weight: bold; font-size: 15px; display:inline-block; margin-top:12px;">
      </i></a></div>
      </div>
      </div>`);

    });

    $("body").on("click", ".remove", function() {
      $(this).closest('.video_details').remove();
    });
  });
</script>

<script type="text/javascript">
  function Validateyoutubeurl() {
    //alert("test");
    var url = document.getElementById('viourl');
    var Fileurl = url.value;
    // alert(Fileurl);
    var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=|\?v=)([^#\&\?]*).*/;
    if (Fileurl == '') {
      alert("Please upload an youtube url");
    } else {

      var match = Fileurl.match(regExp);
      if (match) {
        //alert("match");
        document.getElementById("showyoutubeurl").style.display = "none";
        return true;
      } else {
        //alert("not match");
        document.getElementById("showyoutubeurl").style.display = "block";
        document.getElementById("viourl").value = "";
        return false;
      }
    }
  }
</script>


<style>
  input[data-readonly] {
    pointer-events: none;
  }

  .col-sm-3 {
    -webkit-box-flex: 0;
    -ms-flex: 0 0 25%;
    flex: 0 0 16%;
    max-width: 16%;
  }
</style>