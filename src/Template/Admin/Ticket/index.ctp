<style type="text/css">
    #myUL {
        position: relative;
        z-index: 999;
    }

    #myUL ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        max-height: 100px;
        position: absolute;
        background-color: #fff;

    }

    #myUL li {
        font: 200 15px/1.5 Helvetica, Verdana, sans-serif;
        border-bottom: 1px solid #ccc;
        background-color: #fff;
    }

    #myUL li li:last-child {
        border: none;
    }

    #myUL li a {
        text-decoration: none;
        color: #000;
        display: block;
        width: 258px;


    }

    #orgUL {
        position: relative;
        z-index: 999;
    }

    #orgUL ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        max-height: 100px;
        position: absolute;
        background-color: #fff;

    }

    #orgUL li {
        font: 30px/ Helvetica, Verdana, sans-serif;
        border-bottom: 1px solid #ccc;
        background-color: #fff;
    }

    #orgUL li li:last-child {
        border: none;
    }

    #orgUL li a {
        text-decoration: none;
        color: #000;
        display: block;
        width: 258px;
    }
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
                    <li><a href="<?php echo SITE_URL; ?>admin/dashboard ">Dashboard</a></li>
                    <li><a href="<?php echo ADMIN_URL; ?>ticket/index">Ticket Manager</a></li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- <?php //echo $this->Paginator->limitControl([10 => 10, 15 => 15,20=>20,25=>25,30=>30]);
        ?> -->

<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">

            <?php echo $this->Flash->render(); ?>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Ticket Manager</strong>
                    </div>

                    <div class="row" style="padding: 10px;">
                        <script>
                            $(document).ready(function() {

                                $("#Mysubscriptionsf").bind("submit", function(event) {

                                    $.ajax({
                                        async: true,
                                        data: $("#Mysubscriptionsf").serialize(),
                                        dataType: "html",
                                        type: "POST",
                                        url: "<?php echo ADMIN_URL; ?>ticket/search",
                                        success: function(data) {
                                            // alert(data); 
                                            $("#example23").html(data);
                                        },
                                    });
                                    return false;
                                });
                            });

                            $(document).on('click', '.pagination a', function(e) {
                                var target = $(this).attr('href');
                                var res = target.replace("/ticket/search", "/ticket");
                                window.location = res;
                                return false;
                            });

                            //]]>
                        </script>
                        <div class="col-sm-3">
                            <?php echo $this->Form->create('Mysubscription', array('type' => 'file', 'inputDefaults' => array('div' => false, 'label' => false), 'id' => 'Mysubscriptionsf', 'class' => 'form-horizontal')); ?>

                            <div class="form-group">
                                <label>Customer</label>
                                <?php
                                echo $this->Form->input('customername', array('class' => 'longinput form-control input-medium ', 'placeholder' => 'Customer', 'type' => 'text', 'label' => false, 'value' => $customername)); ?>
                            </div>
                        </div>

                        <div class="col-sm-3">

                            <div class="form-group">
                                <label>Mobile</label>
                                <?php
                                echo $this->Form->input('customermobile', array('class' => 'longinput form-control input-medium ', 'placeholder' => 'Mobile', 'type' => 'number', 'label' => false, 'value' => $customermobile)); ?>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="company" class=" form-control-label">Purchase From</label>
                                <?php echo $this->Form->input('date_from', array('class' => 'longinput form-control input-medium ', 'placeholder' => 'Date From', 'type' => 'text', 'label' => false, 'autocomplete' => 'off', 'id' => 'datetimepicker1')); ?>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="company" class=" form-control-label">Purchase To</label>
                                <?php echo $this->Form->input('date_to', array('class' => 'longinput form-control input-medium ', 'placeholder' => 'Date To', 'type' => 'text', 'label' => false, 'autocomplete' => 'off', 'id' => 'datetimepicker2')); ?>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Event</label>
                                <!-- <input type="hidden" id="location_ids" name="eventid"> -->
                                <?php echo $this->Form->input('eventname', array('class' => 'longinput form-control input-medium secrh-loc', 'placeholder' => 'Event Name', 'autocomplete' => 'off', 'type' => 'search', 'label' => false, 'value' => $eventname)); ?>
                                <div id="myUL">
                                    <ul></ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Organiser</label>
                                <input type="hidden" id="organiser_search" name="organiser_id" value="<?php echo
                                                                                                        isset($organiser_id) ? $organiser_id : ''; ?>">
                                <?php echo $this->Form->input('organiser', array('class' => 'longinput form-control input-medium organiser_search', 'placeholder' => 'Organiser Name', 'autocomplete' => 'off', 'type' => 'search', 'label' => false, 'value' => $abc)); ?>
                                <div id="orgUL">
                                    <ul></ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Ticket Number</label>
                                <?php
                                echo $this->Form->input('ticket_number', array(
                                    'class' => 'longinput form-control input-medium',
                                    'placeholder' => 'Ticket Number',
                                    'type' => 'text',
                                    'label' => false,
                                    'oninput' => 'this.value = this.value.toUpperCase()'
                                ));
                                ?>
                            </div>
                        </div>


                        <div class="col-sm-1" style="padding-top: 25px;">
                            <?php if (isset($ticket['id'])) {
                                echo $this->Form->submit('Update', array(
                                    'title' => 'Update', 'div' => false,
                                    'class' => array('btn btn-primary btn-sm')
                                ));
                            } else {  ?>
                                <button type="submit" class="btn btn-success" id="Mysubscriptionsg">Search</button>
                            <?php  } ?>
                        </div>
                        <?php echo $this->Form->end(); ?>
                        <a href="<?php echo SITE_URL; ?>admin/ticket/export" style="padding-top: 25px;"><strong class=" btn btn-info card-title pull-right" style="margin-right: 10px;">Export CSV</strong></a>


                    </div>

                    <div class="card-body" id="example23">

                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Purchase Date</th>
                                    <th>Ticket No.</th>
                                    <th>Event</th>
                                    <th>Event Date & Time</th>
                                    <th>Customer</th>
                                    <th>Mobile</th>
                                    <!-- <th>Purchase Ticket</th> -->
                                    <th>Qty.</th>
                                    <th style="width: 9%;">Amount</th>
                                    <!-- <th>Comm(<?php //echo $admin_info['feeassignment']; 
                                                    ?>%)</th> -->
                                    <th>Commision</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total_amount = 0; // initialize total amount variable to 0
                                $total_commission_amount = 0; // initialize total commission amount variable to 0
                                $i = 1;
                                foreach ($ticket as $key => $value) {
                                    // pr($value['ticket']['adminfee']);
                                    $total_amount += $value['ticket']['amount']; // add amount to total amount
                                    $total_commission_amount += ($value['ticket']['amount'] * $value['ticket']['adminfee'] / 100); // add commission to total commission amount
                                ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php if (isset($value['ticket']['created'])) {
                                                echo date('d M, Y h:i A', strtotime($value['ticket']['created']));
                                            }  ?></td>

                                        <td><?php echo $value['ticket_num']; ?></td>
                                        <td><?php echo ucfirst($value['ticket']['event']['name']); ?></td>
                                        <td>
                                            <b>From</b> <?php echo date('d M, Y h:i A', strtotime($value['ticket']['event']['date_from'])); ?><br>
                                            <b>To</b> <?php echo date('d M, Y h:i A', strtotime($value['ticket']['event']['date_to'])); ?>
                                        </td>
                                        <td><?php echo ucwords($value['user']['name']) . ' ' . ucwords($value['user']['lname']); ?></td>
                                        <td><?php echo $value['user']['mobile']; ?></td>
                                        <td><?php echo $value['ticket']['ticket_buy']; ?></td>
                                        <td>
                                            <?php echo "$" . number_format($value['ticket']['amount'], 2) . " TTD"; ?>

                                        </td>
                                        <td>
                                            <a style="color: black;">
                                                <?php echo "$" .  number_format($value['ticket']['amount'] * $value['ticket']['adminfee'] / 100, 2) . " TTD"; ?>

                                            </a>
                                        </td>
                                    </tr>
                                <?php

                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="8" style="text-align: right"><strong>Total Amount:</strong></td>
                                    <td>
                                        <strong>
                                            <?php echo "$" . number_format($total_amount, 2) . " TTD"; ?></strong>
                                    </td>

                                    <td>
                                        <strong>
                                            <?php echo "$" . number_format($total_commission_amount, 2) . " TTD"; ?></strong>
                                    </td>


                                </tr>
                            </tfoot>
                        </table>
                        <?php echo $this->element('admin/pagination'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    function cllbck(id, cid) {
        $('.secrh-loc').val(id);
        $('#location_ids').val(cid);
        $('#myUL').hide();
    }
    $(function() {
        $('.secrh-loc').bind('keyup', function() {
            var pos = $(this).val();
            $('#myUL').show();
            $('#location_ids').val('');
            var count = pos.length;

            if (count > 0) {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo SITE_URL; ?>admin/ticket/loction',
                    data: {
                        'fetch': pos
                    },
                    success: function(data) {
                        // console.log(data);
                        $('#myUL ul').html(data);
                    },
                });
            } else {
                $('#myUL').hide();
            }
        });
    });

    // search organiser
    $('.organiser_search').bind('keyup', function() {
        var pos = $(this).val();

        $('#orgUL').show();
        $('#organiser_search').val('');
        var count = pos.length;

        if (count > 0) {
            $.ajax({
                type: 'POST',
                url: '<?php echo SITE_URL; ?>admin/event/organiser_search',
                data: {
                    'fetch': pos
                },
                success: function(data) {
                    // console.log(data);
                    $('#orgUL ul').html(data);
                },
            });
        } else {
            $('#orgUL').hide();
        }
    });

    function searchbck(id, cid) {
        $('.organiser_search').val(id);
        $('#organiser_search').val(cid);
        $('#orgUL').hide();
    }
</script>

<link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

<script type="text/javascript">
    $(function() {
        $("#datetimepicker1").datepicker();
        $("#datetimepicker2").datepicker();
    });
</script>