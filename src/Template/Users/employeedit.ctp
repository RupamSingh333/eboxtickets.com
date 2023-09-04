<div class="modal-header">
  <h5 class="modal-title" id="exampleModalLabel">Edit Staff</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="empform" action="<?php echo SITE_URL; ?>users/employeedit" method="post">
  <div class="modal-body">
    <input type="hidden" name="emp_id" id="inputEmail1" value="<?php echo $emp_id['id'] ?>">
    <div class="row g-3 text-start">

      <div class="col-md-6">
        <label for="inputName" class="form-label">First Name</label>
        <div class="input text required">
          <input type="text" name="name" value="<?php echo $emp_id['name'] ?>" class="form-control" id="inputEmail1" placeholder="First Name" required>

        </div>
      </div>

      <div class="col-md-6">
        <label for="inputName" class="form-label">Last Name</label>
        <div class="input text required"> <input type="text" name="lname" value="<?php echo $emp_id['lname'] ?>" class="form-control" id="inputEmail2" placeholder="Last Name" required></div>
      </div>

      <div class="col-md-12">
        <label for="inputName" class="form-label">Email</label>
        <div class="input text required">
          <input type="email" disabled value="<?php echo $emp_id['email'] ?>" class="form-control" id="inputEmail3" placeholder="Email" required>
          <span id="empemval" style="display: none; color: red; text-align: left;">Email already exist!!</span>
        </div>
      </div>

      <div class="col-md-12">
        <label for="inputName" class="form-label">Mobile</label>
        <div class="input text required">
          <input type="text" disabled value="<?php echo $emp_id['mobile'] ?>" class="form-control" id="inputEmail4" placeholder="Mobile" minlength="10" maxlength="12" required>
          <span id="empmoval" style="display: none; color: red; text-align: left;">Mobile number already exist!!</span>
        </div>
      </div>

      <div class="col-md-12">
        <label for="inputName" class="form-label">Events</label>
        <?php 
        $multiple_eventid = (explode(",", $emp_id['eventId']));?>
        <select name="event_id[]" required class="form-select" multiple aria-label="multiple select example">
          <option value="">Please select an item in the list</option>
          <?php
          foreach ($allevent as $eventName) { ?>
            <option value="<?php echo $eventName['id']; ?>" <?php if(in_array($eventName['id'], $multiple_eventid)){echo 'selected';} ?>><?php echo $eventName['name']; ?></option>
          <?php } ?>
        </select>
      </div>

    </div>
    <!-- ================== -->
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn save">Submit</button>
  </div>
</form>

<!-- <script>
  $(document).ready(function() { //alert();
    $("#empform").submit(function(e) {
      e.preventDefault();
      var name = $('#inputEmail2').val();
      var email = $('#inputEmail3').val();
      var mobile = $('#inputEmail4').val();
      var id_data = $('#inputEmail1').val();

      $.ajax({
        type: 'POST',
        url: '<?php //echo SITE_URL; ?>/users/checkempdataedit',
        data: {
          email: email,
          mobile: mobile,
          id_data: id_data
        },
        success: function(data) { //alert(data);

          obj = JSON.parse(data);
          // console.log(obj.email);

          if (obj.email == 1) {
            $("#empemval").css("display", "block");
            // $("#empemval").css("display", "none");
            return false;
          } else if (obj.mobile == 1) {
            // $("#empemval").css("display", "none");
            $("#empmoval").css("display", "block");
            return false;
          } else {
            document.getElementById("empform").submit();
          }

        }
      });
    });
  });
</script> -->