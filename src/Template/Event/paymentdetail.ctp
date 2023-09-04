<style>
    .input_fields_wrap .form-control {
        margin-bottom: 15px;
    }

    #testUL ul {
        z-index: 999;
        overflow: scroll;
        height: 150px;
        list-style-type: none;
        background-color: #ffffff;
        margin: auto;
        padding: 2px 0px;
        width: 99%;
    }

    #searchevent ul {
        z-index: 999;
        overflow: scroll;
        height: 137px;
        list-style-type: none;
        background-color: #ffffff;
        margin: auto;
        padding: 2px 0px;
        width: 97%;
    }

    #testUL ul li a {
        color: black;
    }

    #searchevent ul li a {
        color: black;
    }

    .dotsInUl li {
        position: relative;
        padding-left: 15px;
    }

    .dotsInUl li:after {
        position: absolute;
        height: 8px;
        width: 8px;
        background-color: #3d6db5;
        left: 0px;
        top: 6px;
        display: block;
        content: '';
    }
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
<link href="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.css" rel="stylesheet" type="text/css" />
<script src="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.js"></script>
<section id="Dashboard_section">
    <div class="d-flex">
        <?php echo $this->element('organizerdashboard'); ?>
        <!-- <div class="col-sm-9"> -->
            <div class="dsa_contant">
                <h4>Order: <?php echo $order_id; ?></h4>
                <hr>

                <div class="contant_bg">
                    <div class="pay_settings">
                        <?php echo $this->Flash->render(); ?>

                        <div class="row g-3">
                            <!-- committee add here -->
                            <div class="col-md-8">
                                <div class="Committee">


                                    <div class="row Current_heading">
                                        <!-- <div class="col-sm-1"></div> -->
                                        <div class="col-sm-2">
                                            <p>Item</p>
                                        </div>
                                        <div class="col-sm-3 ">
                                            <p>Amount</p>
                                        </div>
                                        <div class="col-sm-3 ">
                                            <p>Fee</p>
                                        </div>
                                        <div class="col-sm-2 ">
                                            <p>Name</p>
                                        </div>
                                        <div class="col-sm-2 ">

                                        </div>
                                    </div>

                                    <?php foreach ($orders as $ticketvalue) { //pr($ticketvalue);die;
                                        $ticket_total_amount   +=  $ticketvalue['amount'];

                                    ?>
                                        <div class="mb-4">

                                            <div class="pay_detalis">
                                                <div class="row align-items-center">
                                                    <div class="col-sm-2">
                                                        <p class="my-1 icons"><?php echo $ticketvalue['eventdetail']['title']; ?> </p>

                                                    </div>
                                                    <div class="col-sm-3 ">
                                                        <p><?php echo $event['currency']['Currency']; ?><?php echo $event['currency']['Currency_symbol']; ?> <?php echo sprintf('%.2f', $ticketvalue['amount']); ?>  </p>
                                                    </div>
                                                    <div class="col-sm-3 ">
                                                       
                                                       <?php if($ticketvalue['order']['adminfee']){ ?>
                                                        <p>   <?php echo $event['currency']['Currency']; ?><?php echo $event['currency']['Currency_symbol']; ?> <?php echo  $ticketvalue['amount']*$ticketvalue['order']['adminfee']/100; ?>    
                                                    
                                                        <?php $total_fee_charges +=  $ticketvalue['amount']*$ticketvalue['order']['adminfee']/100; ?>
                                                    </p>
                                                       <?php }else{ ?>
                                                        <p>--</p>
                                                        <?php $total_fee_charges +=  0; ?>
                                                        <?php } ?>
                                                         
                                                        <?php $ticketvalue['amount']*$ticketvalue['adminfee']/100; ?> 
                                                    </div>
                                                    <div class="col-sm-2 ">
                                                        <p><?php echo $ticketvalue['ticketdetail'][0]['name'];?></p>
                                                    </div>
                                                    <div class="col-sm-2 text-end">
                                                        <div class="dropdown">
                                                            <button class="btn add_btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="bi bi-gear"></i>
                                                            </button>
                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                                <li> <a class="dropdown-item" href="#" title="Edit Tickets" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $ticketvalue['id']; ?>"> Rename </a></li>
                                                                <!-- <li> <a class="dropdown-item" href="#" title="Edit Tickets" data-bs-toggle="modal" data-bs-target="#exampleModa2"> Edit Answers</a> </li> -->
                                                                <?php                                        
                                                                $encode =base64_encode($ticketvalue['id'].'/'.str_replace(' ', '_',$ticketvalue['eventdetail']['title']));
                                                                ?>
                                                                <li> <a target="_blank" class="dropdown-item" href="<?php echo SITE_URL;?>tickets/printticket/<?php echo $encode;?>" title="Edit Tickets"> Print</a> </li>
                                                                <li> <a class="dropdown-item" href="#" title="Edit Tickets" data-bs-toggle="modal" data-bs-target="#exampleModa3"> Cancel</a> </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>


                                                <!-- Modal for Rename-->
                                                <div class="modal fade" id="exampleModal<?php echo $ticketvalue['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Rename Ticket</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="post" action="<?php echo SITE_URL; ?>event/nameupdate/<?php echo $ticketvalue['id']; ?>">
                                                                    <div class="row g-3">
                                                                        <div class="col-md-3">
                                                                            <label for="exampleInputEmail1" class="form-label mt-1">Ticket Name</label>
                                                                        </div>
                                                                        <div class="col-md-9">
                                                                            <input type="hidden" name="ticketid" value="<?php echo $ticketvalue['id'];?>">
                                                                            <input type="text" name="name" required class="form-control" placeholder="Ticket Name">
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn save">Save</button>
                                                            </div>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Modal -->
                                                <!-- <div class="modal fade" id="exampleModa2" tabindex="-1" aria-labelledby="exampleModalLabe1" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabe1">Edit Answers</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">

                                                                <form>
                                                                    <div class="row g-3">
                                                                        <div class="col-md-3">
                                                                            <label for="exampleInputEmail1" class="form-label mt-1">State</label>
                                                                        </div>
                                                                        <div class="col-md-9">
                                                                            <select id="inputState" class="form-select">
                                                                                <option selected>Choose One</option>
                                                                                <option>India</option>
                                                                                <option>Pakistan</option>
                                                                                <option>Russia</option>
                                                                                <option>Japan</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn save">Save</button>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> -->

                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModa3" tabindex="-1" aria-labelledby="exampleModalLabe1" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabe1">Confirm Action</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Are you sure you want to refund this order?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn save">Yes</button>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>



                                            </div>
                                            <div class="pay_detalis2">
                                                <div class="d-flex">
                                                    <span class="info_heading">Type</span>
                                                    <span class="con-dest">:</span>
                                                    <?php if ($ticketvalue['eventdetail']['type'] == "committee_sales") {
                                                        $type = "Committee";
                                                    } else if ($ticketvalue['eventdetail']['type'] == "open_sales") {
                                                        $type = "Open Sales";
                                                    } else {
                                                        $type = "Comps";
                                                    }
                                                    ?>
                                                    <span class="info_contant"><?php echo $type; ?></span>
                                                </div>

                                                <div class="d-flex">
                                                    <?php $commitee_user_approved = $this->Comman->finduserusingid($ticketvalue['committee_user_id']);?>
                                                    <span class="info_heading">Approved by </span>
                                                    <span class="con-dest">:</span>
                                                    <?php if ($ticketvalue['eventdetail']['type'] == "committee_sales") {  ?>
                                                        <span class="info_contant"><?php echo $commitee_user_approved['name']; ?></span>
                                                    <?php } else { ?>
                                                        <span class="info_contant">--</span>
                                                    <?php } ?>
                                                </div>

                                                <?php if ($ticketvalue['ticketdetail'][0]['status'] == 0) { ?>
                                                    <div class="d-flex">
                                                        <span class="info_heading">Scanned</span>
                                                        <span class="con-dest">:</span>
                                                        <span class="info_contant"> No</span>
                                                    </div>
                                                <?php } ?>
                                                <?php if ($ticketvalue['ticketdetail'][0]['status'] == 1) { ?>
                                                    <div class="d-flex">
                                                        <span class="info_heading">Scanned</span>
                                                        <span class="con-dest">:</span>
                                                        <span class="info_contant"> Yes | <?php echo date('d-m-Y H:i:s', strtotime($ticketvalue['ticketdetail'][0]['usedate'])); ?></span>
                                                    </div>
                                                <?php } ?>
                                                <?php $ticketquestion = $this->Comman->ticketquestion($ticketvalue['ticketdetail'][0]['id'], $ticketvalue['order_id']); ?>

                                                <div class="d-flex">
                                                    <span class="info_heading">Answers</span>
                                                    <!-- <span class="con-dest">:</span> -->

                                                </div>
                                                <ul class="dotsInUl">
                                                    <?php if (!empty($ticketquestion)) { ?>
                                                        <?php foreach ($ticketquestion as $questionval) { ?>
                                                            <li class="info_contant"><?php echo $questionval['question']['question']; ?> : <?php echo $questionval['user_reply']; ?></li>
                                                        <?php  }
                                                    } else { ?>
                                                        <li class="info_contant"> No Questions </li>
                                                    <?php } ?>
                                                </ul>


                                            </div>
                                        </div>
                                    <?php } ?>


                                    <?php if ($addons_order) { ?>
                                        <h4>Addons : </h4>
                                        <div class="pay_detalis">
                                            <div class="row align-items-center">

                                                <?php foreach ($addons_order as $addonkey => $addonvalue) {
                                                    $totaladdons += $addonvalue['price'];
                                                ?>
                                                    <div class="d-flex">
                                                        <span class="info_heading"><?php echo $addonvalue['addon']['name']; ?></span>
                                                        <span class="con-dest">:</span>
                                                        <span class="info_contant"><?php echo $event['currency']['Currency_symbol']; ?> <?php echo sprintf('%.2f', $addonvalue['price']); ?> <?php echo $event['currency']['Currency']; ?></span>
                                                    </div>
                                                <?php } ?>
                                            </div>

                                        </div>
                                    <?php } ?>
                                    <div class="row Current_heading">
                                        <!-- <div class="col-sm-1"></div> -->
                                        <div class="col-sm-2">
                                            <p>TOTAL</p>
                                        </div>
                                        <div class="col-sm-3 ">
                                            <p><?php echo $event['currency']['Currency']; ?><?php echo $event['currency']['Currency_symbol']; ?> <?php echo number_format($ticket_total_amount + $totaladdons); ?></p>
                                        </div>

                                        <div class="col-sm-3 "> 
                                            <p><?php if($total_fee_charges>0){ 
                                                 echo $event['currency']['Currency']."".$event['currency']['Currency_symbol']." ".number_format($total_fee_charges);
                                            }else{
                                                echo "--";
                                            }
                                                  ?> </p>
                                        </div>      
                                        <div class="col-sm-2"></div>                                   
                                        <div class="col-sm-2 text-end">
                                            <a class="print_icon" target="_blank" href="<?php 
                                            $orderid_eventid = $order_id.'/'.$id;
                                            echo SITE_URL.'tickets/printalltickets/'.base64_encode($orderid_eventid);?>"> <i class="bi bi-printer"></i></a>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- import committee -->
                            <div class="col-md-4">
                                <div class="import_committee">
                                    <div class="row">
                                        <div class="col-sm-3 img_style">

                                            <img src="<?php echo SITE_URL; ?>/images/Usersprofile/<?php echo $single_order['user']['profile_image']; ?>" alt="" class="img-fluid mb-3 ">
                                        </div>
                                        <div class="col-sm-9">
                                            <h5 class="card-title">
                                                <?php echo $single_order['user']['name']; ?></h5>
                                            <p class="info">
                                                <?php echo $single_order['user']['email']; ?> <br>
                                                <?php
                                                $date1ff =  date('Y-m-d 12:i:s', strtotime($single_order['user']['dob']));
                                                //echo  $date1ff."test"; die;
                                                $date1 =  strtotime($date1ff); //$date1ff;

                                                $date2ff =  date('Y-m-d H:i:s');
                                                //echo $date2ff;
                                                $date2 = strtotime($date2ff);

                                                // Formulate the Difference between two dates

                                                $diff = abs($date2 - $date1);

                                                // To get the year divide the resultant date into
                                                // total seconds in a year (365*60*60*24)
                                                $years = floor($diff / (365 * 60 * 60 * 24));

                                                ?>
                                                <?php echo $years; ?> years old<br>
                                                <?php echo $single_order['user']['gender']; ?> </p>
                                        </div>

                                        <div class="col-sm-12 mt-3">
                                            <div class="table_data">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <td>Order Number</td>
                                                            <td><?php echo $order_id; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Date</td>
                                                            <td><?php echo date('d M Y', strtotime($single_order['created'])); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Time</td>
                                                            <td><?php echo date('h:i A', strtotime($single_order['created'])); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Payment Type</td>
                                                            <td><?php echo $single_order['paymenttype']; ?></td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        <!-- </div> -->
    </div>
</section>

<script>
    // for searching user start 
    $(document).ready(function() {
        $(function() {
            $('.usersearch').bind('keyup', function() {
                var pos = $(this).val();
                var check = 0;
                $('#testUL').show();
                $('#retail_ids').val('');
                var count = pos.length;
                if (count > 0) {
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo SITE_URL; ?>event/getusersname',
                        data: {
                            'fetch': pos,
                            'check': check
                        },
                        success: function(data) {
                            $('#testUL ul').html(data);
                        },
                    });
                } else {
                    $('#testUL').hide();
                }
            });
        });


    });

    function selectsearch(name, id) {
        $('.usersearch').val(name);
        $('#testUL').hide();
        $('#retail_ids').val(id);
    }
    // end 


    // for import committee member - start 
    $(document).ready(function() {
        $(function() {
            $('.eventserach').bind('keyup', function() {
                var searchdata = $(this).val();
                var check = 0;
                var user_id = "<?php echo $user_id; ?>";
                $('#searchevent').show();
                $('#import_event_id').val('');
                var count = searchdata.length;
                if (count > 0) {
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo SITE_URL; ?>event/geteventcommittee',
                        data: {
                            'fetch': searchdata,
                            'check': check,
                            'user_id': user_id
                        },
                        success: function(data) {
                            $('#searchevent ul').html(data);
                        },
                    });
                } else {
                    $('#searchevent').hide();
                }
            });
        });


    });

    function selectevent(name, id) {
        $('.eventserach').val(name);
        $('#searchevent').hide();
        $('#import_event_id').val(id);
    }

    // end 
</script>