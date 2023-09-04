<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.css" rel="stylesheet" type="text/css" />
<script src="https://code.jquery.com/jquery-2.1.4.js"></script>
<script src="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.js"></script>
<section id="dashboard_pg">
  <div class="container">

    <div class="dashboard_pg_btm">
      <div class="row">
        <div class="col-md-12">
          <div class="d-flex justify-content-between dash_menutog align-items-center">
            <!--  -->
            <nav class="navbar navbar-expand-lg navbar-light p-0">
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="nav nav-pills" id="nav-tab" role="tablist">
                  <a class="nav-item nav-link active" id="nav-home-tab" href="#" role="tab" aria-controls="nav-home" aria-selected="true">Dashboard</a>
                </div>
              </div>
            </nav>
            <!--  -->
            <ul class="list-inline dash_ulbtn">
              <li class="list-inline-item ">

                <a href="<?php echo SITE_URL; ?>homes/myevent"> <button type="submit" class="btn save">View Event</button></a>
              </li>
            </ul>
            <!--  -->
          </div>
        </div>
        <form method="post" enctype="multipart/form-data" accept-charset="utf-8" id="formsubmit" class="form-horizontal needs-validation">
          <div class="form">
            <h2><i class="far fa-calendar-plus"></i>Manage Settings</h2>
            <div class="form_inner">
              <!--  -->
              <ul id="progressbar">
                <li class="active">Event Info</li>
                <li class="active">Manage Tickets & Addons</li>
                <li class="active">Questions</li>
                <li class="active">Committee</li>
                <li class="active">Manage Settings</li>
                <!-- <li>View Event</li> -->
              </ul>
              <!--  -->

            </div>

            <fieldset>
              <h4>General Settings</h4>
              <div class="addone">
                <div class="row">

                  <div class="col-md-3  mb-3">
                    <label for="lastname">Ticket Limit</label>
                    <?php
                    $limit = ['1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10'];

                    if ($eventDetails['ticket_limit']) {
                      $ticket_limite = $eventDetails['ticket_limit'];
                    }

                    echo $this->Form->input(
                      'ticket_limite',
                      ['empty' => 'Choose Limite', 'options' => $limit, 'default' => isset($ticket_limite) ? $ticket_limite : "", 'required' => 'required', 'class' => 'form-select', 'label' => false]
                    ); ?>
                  </div>

                  <div class="col-md-3  mb-3">
                    <label for="lastname">Approval Expiry</label>
                    <?php
                    $approve = ['1' => '1', '2' => '2'];

                    if ($eventDetails['approve_timer']) {
                      $approve_timer = $eventDetails['approve_timer'];
                    }

                    echo $this->Form->input(
                      'approve_timer',
                      ['empty' => 'Choose Days', 'options' => $approve, 'default' => isset($approve_timer) ? $approve_timer : "", 'required' => 'required', 'class' => 'form-select', 'label' => false]
                    ); ?>
                  </div>

                  <div class="col-md-3  mb-3">
                    <label for="firstname">Sale start</label>
                    <div class="ui calendar" id="example1">
                      <div class="ui input left icon">
                        <i class="calendar icon"></i>
                        <?php
                        if ($eventDetails['sale_start']) {
                          $sale_start =  date('Y-m-d H:i:s', strtotime($eventDetails['sale_start']));
                        }

                        ?>
                        <input class="form-control" value="<?php echo isset($sale_start) ? $sale_start : ''; ?>" type="text" name="sale_start" placeholder="Date/Time" autocomplete="off">
                        <?php //echo $this->Form->input('sale_start', array('class' => 'longinput form-control input-medium datetimepicker1', 'placeholder' => 'Date From', 'type' => 'text', 'required', 'label' => false, 'autocomplete' => 'off', 'value' => (!empty($addevent['sale_start'])) ? date('Y-m-d H:m', strtotime($addevent['sale_start'])) : '')); 
                        ?>
                      </div>
                    </div>

                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="firstname">Sale End</label>

                    <div class="ui calendar" id="examplesecond">
                      <div class="ui input left icon">
                        <i class="calendar icon"></i>
                        <?php
                        if ($eventDetails['sale_end']) {
                          $sale_end =  date('Y-m-d H:i:s', strtotime($eventDetails['sale_end']));
                        }

                        ?>
                        <input class="form-control" type="text" value="<?php echo isset($sale_end) ? $sale_end : ''; ?>" name="sale_end" placeholder="Date/Time" autocomplete="off">
                      </div>
                    </div>
                  </div>
                  
                  <hr>
                  <div class="d-flex justify-content-between">
                    <!-- <a class="close " onclick="history.back()">Previous</a> -->
                    <a class="close " href="<?php echo SITE_URL; ?>homes/committee<?php echo isset($getId) ? '/' . $getId : '' ?>">Previous</a>
                    <?php
                    if (empty($getId)) { ?>
                      <a><button type="submit" class="btn save">Submit</button></a>
                    <?php } ?>
                  </div>

                </div>
              </div>
              <!--  -->
            </fieldset>
          </div>
        </form>
      </div>
    </div>
  </div>
  </div>
  </div>
</section>

<script>
  $(document).ready(function() {
    var num = $('.property-fields__row').length;
    if (num - 1 == 0)
      $('#btnDel').attr('disabled', 'disabled');

    $('#btnAdd').click(function() {

      var num = $('.property-fields__row').length;
      var newNum = num + 1;
      var newElem = $('#property-fields__row-1').clone().attr('id', 'property-fields__row-' + newNum);


      newElem.find('.line-item-property__year label').attr('for', 'year_' + newNum).val('');
      newElem.find('.line-item-property__year input').attr('id', 'year_' + newNum).attr('name', 'properties[YEAR ' + newNum + ']').val('');

      newElem.find('.line-item-property__team label').attr('for', 'team-name_' + newNum).val('');
      newElem.find('.line-item-property__team input').attr('id', 'team-name_' + newNum).attr('name', 'properties[TEAM NAME ' + newNum + ']').val('');

      newElem.find('.line-item-property__name label').attr('for', 'winner-name_' + newNum).val('');
      newElem.find('.line-item-property__name input').attr('id', 'winner-name_' + newNum).attr('name', 'properties[WINNER NAME ' + newNum + ']').val('');


      $('#property-fields__row-' + num).after(newElem);

      $('#btnDel').attr('disabled', false);

      if (newNum == 19)

        $('#btnAdd').attr('disabled', 'disabled');

    });

    $('#btnDel').click(function() {
      var num = $('.property-fields__row').length;

      $('#property-fields__row-' + num).remove();

      $('#btnAdd').attr('disabled', false);

      if (num - 1 == 1)

        $('#btnDel').attr('disabled', 'disabled');

    });
  });

  $('#type').on('change', function(e) {
    var type = e.target.value;
    // console.log(type)
    if (type == 'open_sales' || type == '') {
      $("#count").show();
    } else {
      $("#count").hide();
    }
  });

  function isCspecial(e) {
    var e = e || window.event;
    var k = e.which || e.keyCode;
    var s = String.fromCharCode(k);
    if (/^[\\\"\'\;\:\>\<\[\]\-\.\,\/\?\=\+\_\|~`!@#\$%^&*\(\)0-9]$/i.test(s)) {
      alert("Special characters not acceptable");
      return false;
    }
  }

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
  $('#examplesecond').calendar();
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

<!-- <script>
  $(document).ready(function() {

    $("$addmore").click(function() {
      var htmlclone = $(".box").html();
      $("#cell").append(htmlclone);
    });

    $("body").on("click",".remove",function(){
      $(this).closest(".box").remove();
    });
    
  });
</script> -->