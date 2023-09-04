  <section id="add_event_page">
    <!--event_detail_page-->
    <div class="container">
      <hgroup class="innerpageheading">
        <h2>Post Event</h2>
        <ul>
          <li><a href="#">Home</a></li>
          <li><i class="fas fa-angle-double-right"></i></li>
          <li>Post Event</li>
        </ul>
      </hgroup>

      <div class="add_event_form">

        <?php echo $this->Form->create($addevent, array('class' => 'form-horizontal', 'id' => 'sevice_form', 'enctype' => 'multipart/form-data')); ?> <div class="form-group">
          <div class="col-sm-4">
            <label>Event Name</label>
            <?php
            echo $this->Form->input('name', array('class' => 'longinput form-control input-medium', 'placeholder' => 'Event Name', 'type' => 'text', 'label' => false, 'id' => 'dis', 'required', 'autocomplete' => 'off', 'value' => $addevent['name'])); ?>
            <input type="hidden" id="custId" name="custId" value="3487">
          </div>
          <div class="col-sm-4">

            <label>From Date & Time</label>

            <?php echo $this->Form->input('date_from', array('class' => 'longinput form-control input-medium datetimepicker1', 'placeholder' => 'Date From', 'type' => 'text', 'required', 'label' => false, 'autocomplete' => 'off', 'value' => (!empty($addevent['date_from'])) ? date('Y-m-d H:m', strtotime($addevent['date_from'])) : '')); ?>



          </div>
          <div class="col-sm-4">

            <label>To Date & Time</label>

            <?php echo $this->Form->input('date_to', array('class' => 'longinput form-control input-medium datetimepicker2', 'placeholder' => 'Date To', 'required', 'type' => 'text', 'label' => false, 'autocomplete' => 'off', 'id' => 'changedate', 'value' => (!empty($addevent['date_to'])) ? date('Y-m-d H:m', strtotime($addevent['date_to'])) : '')); ?>



          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-6">
            <label>Featured Image</label>
            <div class="box">
              <input type="file" name="feat_image" id="file-7" class="inputfile inputfile-6 form-control" data-multiple-caption="{count} files selected" required>
              <label for="file-7" id="imagenamexx" class="form-control"><span placeholder="Browse Your Featured Image"></span> <strong><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
                    <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z" />
                  </svg></strong></label>
            </div>
            <span id="filesuplodmsg">Image height and width must 427*638</span>
            <span id="showfeatimage" style="color:red;display:none">Image only allows file types of PNG, JPG, JPEG !!!</span>
            <span id="showfeatsize" style="color:red;display:none">Image height and width must 427*638</span>
            <?php if ($addevent['feat_image']) { ?>
              <div class="col-sm-6">
                <div class="form-group">
                  <img src="<?php echo SITE_URL; ?>imagess/<?php echo $addevent['feat_image']; ?>" height="50px" width="100px" style="display:block;">
                </div>
              </div>
            <?php } ?>
          </div>
          <script type="text/javascript">
            $(document).ready(function() {
              $('input[type="file"]').change(function(e) {
                var fileName = e.target.files[0].name;
                $('#imagenamexx').html(fileName);
                var fuData = document.getElementById('file-7');
                var FileUploadPath = fuData.value;
                alert(FileUploadPath);
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

            function uploadimage(fileUpload) {
              if (typeof(fileUpload.files) != "undefined") {
                //Initiate the FileReader object.
                var reader = new FileReader();
                //Read the contents of Image File.
                reader.readAsDataURL(fileUpload.files[0]);
                reader.onload = function(e) {
                  //Initiate the JavaScript Image object.
                  var image = new Image();
                  //Set the Base64 string return from FileReader as source.
                  image.src = e.target.result;
                  image.onload = function() {
                    //Determine the Height and Width.
                    var height = this.height;
                    var width = this.width;

                    if (height > 427 || width > 638) {

                      document.getElementById("showfeatimage").style.display = "none";
                      document.getElementById("showfeatsize").style.display = "block";
                      document.getElementById("file-7").value = "";
                      document.getElementById("filesuplodmsg").style.display = "none";


                      $('#imagenamexx').html('');
                      return false;
                    }
                    document.getElementById("filesuplodmsg").style.display = "block";

                    document.getElementById("showfeatimage").style.display = "none";
                    document.getElementById("showfeatsize").style.display = "none";
                    return true;
                  };
                }
              }

            }
          </script>
          <scri>
            <div class="col-sm-6">
              <label>Youtube URL</label>
              <?php
              echo $this->Form->input('video_url', array('class' => 'longinput form-control input-medium', 'placeholder' => 'Video', 'type' => 'url', 'label' => false, 'autocomplete' => 'off', 'onchange' => 'return Validateyoutubeurl()', 'id' => 'viourl')); ?>
              <span id="showyoutubeurl" style="color:red;display:none">Please upload only you tube url !!!</span>
            </div>
        </div>
        <div class="form-group">
          <label class="col-sm-12">Ticket Detail</label>


          <div class="col-sm-6">
            <?php
            echo $this->Form->input('no_of_seats', array('class' => 'longinput form-control input-medium numberseat TGH', 'placeholder' => 'Number of Seats', 'type' => 'text', 'label' => false, 'required', 'autocomplete' => 'off', 'onkeypress' => 'return isNumberKey(event)', 'id' => 'seatsize', 'value' => $addevent['no_of_seats'])); ?>
            <span id="showmsgseatcheck" style="color:red;display:none">Not Decrease the seats</span>

            <span id="showmsg" style="color:red;display:none">Please Enter Only Numeric Characters !!!</span>
            <span id="showseatsize" style="color:red;display:none">Maximum seats exceed !!!</span>
            <span id="nummessag" style="font-size: 11px;color:red; display:none">Seats must be more than 0 !!</span>
          </div>

          <script>
            $(document).ready(function() {
              $(".TGH").keyup(function() {
                var fg = $(this).val();
                if (fg == '0') {
                  document.getElementById("nummessag").style.display = "block";
                  $(this).val("");
                  $(this).focus();
                } else {
                  document.getElementById("nummessag").style.display = "none";
                }
              });
            });
          </script>
          <div class="col-sm-1">
            <input type="text" value="KES" readonly class="longinput form-control">
          </div>
          <div class="col-sm-5">
            <?php
            echo $this->Form->input('amount', array('class' => 'longinput form-control input-medium', 'placeholder' => 'Ticket Price', 'type' => 'text', 'label' => false, 'required', 'autocomplete' => 'off', 'onkeypress' => 'return isNumberKey(event)', 'id' => 'amountsize')); ?>
            <span id="showamountsize" style="color:red;display:none">Maximum Amount exceed !!!</span>
          </div>
        </div>

        <div class="form-group">


          <div class="col-sm-12">
            <label>Venue</label>
            <?php echo $this->Form->input('location', array('class' =>
            'longinput form-control', 'placeholder' => 'Address', 'label' => false, 'id' => 'pac-input', 'required' => true, 'autocomplete' => 'off')); ?>
            <!-- <input id="pac-input" type="text" class="form-control" placeholder="Location" required  value=""name="location">-->
            <div id="map"></div>
            <?php echo $this->Form->input('lat', array('class' => 'form-control', 'type' => 'hidden', 'id' => 'latitude', 'label' => false)); ?>
            <?php echo $this->Form->input('longs', array('class' => 'form-control', 'type' => 'hidden', 'id' => 'longitude', 'label' => false)); ?>


          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-12">
            <label>Description</label>
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
                  url: '<?php echo SITE_URL; ?>',
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
            'longinput form-control summernote', 'placeholder' => 'Event Description', 'label' => false, 'type' => 'textarea', 'id' => 'summernote', 'autocomplete' => 'off')); ?>
            <input type="hidden" name="event_id" id="eventidval" value="<?php echo $addevent['id']; ?>">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12">
            <button type="submit" class="main_button">Save</button>
          </div>
        </div>
        </form>
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
    function delay(callback, ms) {
      var timer = 0;
      return function() {
        var context = this,
          args = arguments;
        clearTimeout(timer);
        timer = setTimeout(function() {
          callback.apply(context, args);
        }, ms || 0);
      };
    }


    $('.numberseat').keyup(delay(function() {

      //  e.preventDefault();
      var eventid = document.getElementById('eventidval').value;
      var seatsi = document.getElementById('seatsize').value;

      $.ajax({
        type: "POST",
        url: '<?php echo SITE_URL; ?>homes/seatcheck',
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

    }, 300));

    function isNumberKey(evt) {
      //alert("test");

      var seatsi = document.getElementById('seatsize').value;
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
        } else if (amountsizevalidate = 0) {

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
  <script type="text/javascript">
    function Validateyoutubeurl() {
      // alert("test");
      var url = document.getElementById('viourl');
      var Fileurl = url.value;
      //alert(Fileurl);
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
