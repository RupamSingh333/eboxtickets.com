<section id="employee">
  <div class="container">
    <div class="heading">
      <h1>My Staff</h1>
      <h2>My Staff</h2>
      <?php echo $this->Flash->render(); ?>
      <p class="mb-4 heading_p">You can manage your Staff!</p>

    </div>
    <div class="emplo text-end mb-2 mt-1">
      <a class="btn add_green" data-bs-toggle="modal" data-bs-target="#myemployeemodal" href="#"> Add Staff</a>
    </div>

    <div class="table-responsive">

      <table class="table table-hover">
        <thead class="table-dark table_bg">
          <tr>
            <th>S.No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Created</th>
            <!-- <th>Status</th> -->
            <th>Action</th>
          </tr>
        </thead>
        <tbody class="tbody_bg">
          <?php
          if ($employee) {
            foreach ($employee as $key => $values) {  ?>

              <tr>
                <td><?php echo ++$s; ?></td>
                <td><?php echo $values['name'] . ' ' . $values['lname']; ?></td>
                <td><?php echo $values['email']; ?></td>
                <td><?php echo $values['mobile']; ?></td>
                <td><?php echo date('d M Y h:i:s A', strtotime($values['created'])); ?></td>
                <td>
                  <?php if ($values['is_suspend'] == 'Y') { ?>
                    <a href="<?php echo SITE_URL; ?>users/employeedelete/<?php echo $values['id']; ?>/N"> <i style="color: #e62d56;margin-right: 5px;align-items: center;" class="bi bi-eye-slash-fill"></i></a>
                  <?php } else { ?>
                    <a href="<?php echo SITE_URL; ?>users/employeedelete/<?php echo $values['id']; ?>/Y"> <i style="color: #00972d;margin-right: 5px;align-items: center;" class="bi bi-eye-fill"></i></a>
                  <?php } ?>

                  <a data-toggle="modal" class='employeeedit edit viewIcos' href="<?php echo SITE_URL; ?>users/employeedit/<?php echo $values['id']; ?>"><i class="fas fa-edit"></i></a>
                </td>
              </tr>
            <?php
            }
          } else {  ?>
            <tr>
              <td colspan="6" align="center">No Records</td>
            </tr>
          <?php  } ?>
        </tbody>
      </table>
      <?php echo $this->element('admin/pagination'); ?>
    </div>

  </div>
</section>
<!--upcoming Event End-->


<script>
  $('.employeeedit').click(function(e) {
    e.preventDefault();
    $('#myModalempedit').modal('show').find('.modal-content').load($(this).attr('href'));
  });
</script>


<div id="myModalempedit" class="modal fade">
  <div class="modal-dialog">

    <div class="modal-content">
      <!-- <div class="modal-body"></div> -->
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->

</div>

<!-- Modal -->
<div class="modal fade" id="myemployeemodal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Staff</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form id="empform" action="<?php echo SITE_URL; ?>users/employee" method="post">
          <div class="row g-3 text-start">

            <div class="col-md-6">
              <label for="inputName" class="form-label">First Name</label>
              <div class="input text required"> <input type="text" name="name" class="form-control" id="inputEmail1" placeholder="First Name" required></div>
            </div>

            <div class="col-md-6">
              <label for="inputName" class="form-label">Last Name</label>
              <div class="input text required"> <input type="text" name="lname" class="form-control" id="inputEmail2" placeholder="Last Name" required></div>
            </div>

            <div class="col-md-12">
              <label for="inputName" class="form-label">Email</label>
              <div class="input text required">
                <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="Email" required>
                <span id="empemval" style="display: none; color: red; text-align: left;">Email already exist!!</span>
              </div>
            </div>

            <div class="col-md-6">
              <label for="inputName" class="form-label">Country Code</label>

              <?php
              echo $this->Form->input(
                'country_id',
                ['empty' => 'Choose Country', 'options' => $country, 'default' => ($userdata['gender']) ? $userdata['gender'] : "", 'required' => 'required', 'class' => 'form-select', 'label' => false, 'id' => 'countryy']
              ); ?>
            </div>

            <div class="col-md-6">
              <label for="inputName" class="form-label">Mobile</label>
              <div class="input text required">
                <input type="text" name="mobile" class="form-control" id="inputEmail4" placeholder="Mobile" minlength="10" maxlength="12" required>
                <span id="empmoval" style="display: none; color: red; text-align: left;">Mobile number already exist!!</span>
              </div>
            </div>
            <div class="col-md-12">
              <label for="inputName" class="form-label">Events</label>
              <select name="event_id[]" required class="form-select" multiple aria-label="multiple select example">
                <option value="" selected>Please select an item in the list</option>
                <?php
                foreach ($allevent as $eventName) { ?>
                  <option value="<?php echo $eventName['id']; ?>"><?php echo $eventName['name']; ?></option>
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
    </div>

  </div>
</div>

<script>
  $(document).ready(function() { //alert();
    $("#empform").submit(function(e) {
      e.preventDefault();
      var name = $('#inputEmail2').val();
      var email = $('#inputEmail3').val();
      var mobile = $('#inputEmail4').val();
      $.ajax({
        type: 'POST',
        url: '<?php echo SITE_URL; ?>/users/checkempdata',
        data: {
          email: email,
          mobile: mobile
        },
        success: function(data) { //alert(data);
          obj = JSON.parse(data);
          // alert(obj);
          if (obj.email == 1) {
            $("#empemval").css("display", "block");
            $("#empmoval").css("display", "none");
            return false;
          } else if (obj.mobile == 1) {
            $("#empemval").css("display", "none");
            $("#empmoval").css("display", "block");
            return false;
          } else {
            document.getElementById("empform").submit();
          }

        }

      });



    });
  });
</script>