<script src="https://code.jquery.com/jquery-2.1.4.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
<style>
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
</style>
<section id="Dashboard_section">
    <div class="d-flex">
        <!-- <div class="row g-0"> -->
        <?php echo $this->element('organizerdashboard'); ?>

        <!-- <div class="col-sm-9"> -->
        <div class="dsa_contant">
            <h4>Event Office</h4>
            <hr>
            <p>You can manage all your event Event Office here.</p>
            <?php echo $this->Flash->render(); ?>
            <ul class="tabes d-flex">
                <li><a class="active" href="#">Cash Sale</a></li>
            </ul>

            <div class="contant_bg">
                <form method="post" enctype="multipart/form-data" accept-charset="utf-8" id="formsubmit" class="row g-3 needs-validation">
                    <?php if (!empty($findtickets)) {
                        foreach ($findtickets as $key => $value) {
                            $ticket_name = str_replace(" ", "_", $value['eventdetail']['title']);
                            $find_question_data = $this->Comman->findquestion($value['event_id'], $value['ticket_id']); ?>

                            <div class="event_settings mt-2">

                                <div class="row">
                                    <div class="controls col-sm-8 col-12">
                                        <div class="row">
                                            <div class="col-sm-6 col-7">
                                                <label class="control-label ticket-push "><?php echo $value['eventdetail']['title'] . ' $' . sprintf('%.2f', $value['eventdetail']['price']) . ' ' . $event['currency']['Currency']; ?></label>
                                            </div>
                                            <div class="col-sm-6 col-5">
                                                <input type="hidden" name="ticketid" value="<?php echo $value['eventdetail']['id']; ?>">
                                                <select id="question_type_id" name="ticket_count[<?php echo $value['eventdetail']['id']; ?>]" class="form-select rooms <?php if ($value['eventdetail']['type'] == "committee_sales") {
                                                                                                                                                                            echo "commiteesalesticket";
                                                                                                                                                                        } ?>" data-val="<?php echo $value['eventdetail']['title']; ?>" onchange="render_question(this.value,'<?php echo $ticket_name; ?>');">
                                                    <option value="">0</option>
                                                    <?php
                                                    $ticket_sold = $this->Comman->ticketsalecount_committee($value['event_id'], $value['ticket_id']);
                                                    $total_ticket_data =  $value['count'] - $ticket_sold;
                                                    for ($x = 1; $x <= $total_ticket_data; $x++) { ?>
                                                        <option value="<?php echo $x; ?>"><?php echo $x; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>


                                    </div>
                                </div>

                                <div class="<?php echo "eventquestion_" . $ticket_name; ?>" style="display:none">

                                    <?php if (!empty($find_question_data)) { ?>
                                        <h6 class="ticket_TH mt-3"><?php echo $value['eventdetail']['title']; ?></h6>
                                        <div class="<?php echo "question_" . $ticket_name; ?>">
                                            <p>Attendee #<span class="<?php echo "questioncount_" . $ticket_name; ?>" id="room-1">1</span></p>
                                            <div class="<?php echo "subquestioncount_" . $ticket_name; ?>" id="subquestion-1">
                                                <?php $ques = 1;

                                                foreach ($find_question_data as $find_question_value) { ?>
                                                    <!-- <form class="form_bg" action=""> -->
                                                    <div class="row mb-3">
                                                        <label for="inputName" class="col-sm-5 col-6 col-form-label"><?php echo $find_question_value['question']; ?></label>
                                                        <?php $find_question_items = $this->Comman->findquestionitems($find_question_value['id']); ?>

                                                        <div class="col-sm-7 col-6">
                                                            <input type="hidden" class="subquestionid_<?php echo $ticket_name; ?>" name="questionid<?php echo $ticket_name; ?>_1[]" value="<?php echo $find_question_value['id']; ?>">
                                                            <?php if ($find_question_value['type'] == "Select") { ?>
                                                                <select id="inputState" class="form-select subquestion_<?php echo $ticket_name; ?>" name="question<?php echo $ticket_name; ?>_1[]">
                                                                    <option value="">Choose One</option>
                                                                    <?php foreach ($find_question_items as $find_question_value) { ?>
                                                                        <option value="<?php echo $find_question_value['items']; ?>"><?php echo $find_question_value['items']; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            <?php } ?>
                                                            <?php if ($find_question_value['type'] == "Multiple") { ?>
                                                                <select id="inputState" class="form-select subquestion_<?php echo $ticket_name; ?>" name="question<?php echo $ticket_name; ?>_1[]" multiple>
                                                                    <?php foreach ($find_question_items as $find_question_value) { ?>
                                                                        <option value="<?php echo $find_question_value['items']; ?>"><?php echo $find_question_value['items']; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            <?php } ?>

                                                            <?php if ($find_question_value['type'] == "Text") { ?>
                                                                <input type="text" class="form-control subquestion_<?php echo $ticket_name; ?>" name="question<?php echo $ticket_name; ?>_1[]">
                                                            <?php } ?>

                                                            <?php if ($find_question_value['type'] == "Agree") { ?>
                                                                <div class="form-group form-check">
                                                                    <input type="checkbox" value="Agree" class="form-check-input subquestion_<?php echo $ticket_name; ?>" id="exampleCheck1" name="question<?php echo $ticket_name; ?>_1[]">
                                                                    <label class="form-check-label" for="exampleCheck1">Agree</label>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                    </div>

                                                <?php $ques++;
                                                }
                                                ?>
                                            </div>

                                        </div>
                                    <?php } ?>
                                    <div id="<?php echo "question_" . $ticket_name . "_clone"; ?>"></div>
                                </div>
                            </div>


                        <?php } ?>
                        <div class="controls col-sm-3 col-3">
                            <button type="submit" class="btn save">Add</button>
                        </div>
                </form>
            <?php } else { ?>
                <p>
                    <center>No any tickets assign</center>
                </p>
            <?php  } ?>
            </div>

            <?php if (!empty($findcart)) { ?>
                <div class="contant_bg">
                    <div class="table-responsive">
                        <div class="scroll_tab">
                            <div class="event_settings mt-2">
                                <table class="table border table-stripped">
                                    <thead>
                                        <tr>
                                            <th>Ticket Type</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // $amt = 0;
                                        foreach ($findcart as $cartid => $cartvalue) {
                                            $count =  $this->Comman->ticketeventofficecount($user_id, $cartvalue['ticket_id']);
                                            $amt += $cartvalue['eventdetail']['price'] * $count;
                                        ?>

                                            <tr>
                                                <td><?php echo $cartvalue['eventdetail']['title']; ?></td>
                                                <td><?php echo $cartvalue['event']['currency']['Currency_symbol']; ?><?php echo sprintf('%0.2f',  $cartvalue['eventdetail']['price']); ?> <?php echo $cartvalue['event']['currency']['Currency']; ?></td>
                                                <td><?php echo $count; ?></td>
                                                <td>
                                                    <a href="<?php echo SITE_URL; ?>eventoffice/remove/<?php echo $cartvalue['id']; ?>"><i width="20" height="20" fill="#e62d56" class="bi bi-trash" onclick="javascript: return confirm('Are you sure do you want to delete ?')" style="color: #e0275a;"></i></a>
                                                </td>
                                            </tr>

                                        <?php  }
                                        ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="contant_bg">

                    <div class="card-body">
                        <h5 class="card-title">Chekout Options</h5>

                        <form action="<?php echo SITE_URL; ?>eventoffice/checkout/<?php echo $id; ?>" method="POST">
                            <div class="form-group row mt-2 mt-1">
                                <label for="" class="col-md-3 col-sm-6 col-12 col- col-form-label">Payment Type</label>
                                <div class="col-md-9 col-sm-6 col-12">
                                    <select class="form-control" name="payment_type">
                                        <option value="cash">Cash</option>
                                        <!-- <option value="online">Online</option> -->
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <label for="" class="col-md-3 col-sm-6 col-12 col-form-label">Ticket Delivery</label>
                                <div class="col-md-9 col-sm-6 col-12">
                                    <select name="delivery" required id="" class="form-control delivery">
                                        <option value="" selected>Choose One</option>
                                        <option value="email">Email</option>
                                        <option value="print">Print</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mt-2  email hide">
                                <label for="" class="col-md-3 col-sm-6 col-12 col-form-label">Email</label>
                                <div class="col-md-9 col-sm-6 col-12">
                                    <input type="text" class="form-control search user-typeahead" name="email" id="inlineFormInputGroup" placeholder="Search" data-provide="typeahead" autocomplete="off">
                                    <div id="testUL" class="list-group">
                                        <ul></ul>
                                    </div>
                                </div>

                            </div>

                            <?php

                            $totalamt = sprintf('%0.2f', $amt * $event['currency']['conversion_rate']);
                            $count1 = $totalamt * $fees / 100;
                            $feescal = number_format($count1, 2);
                            ?>
                            <div class="form-group row mt-2">
                                <label for="" class="col-md-3 col-sm-6 col-12 col-form-label">Total (including fees)</label>
                                <div class="col-md-9 col-sm-6 col-12 amount">
                                    <?php echo $event['currency']['Currency_symbol']; ?><?php echo $totalamt + $feescal; ?>

                                    <?php echo ' (' . $event['currency']['Currency_symbol']; ?><?php echo $totalamt . ' TTD + $' . $feescal . ' TTD) '; ?>
                                </div>
                            </div>

                            <div class="payment hide">
                                <div class="form-group row mt-2">
                                    <label for="" class="col-md-3 col-sm-6 col-12 col-form-label"></label>
                                    <div class="col-md-9 col-sm-6 col-12 amount">
                                        <button type="submit" class="btn btn-success">
                                            &nbsp; Checkout
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            <?php } ?>
        </div>
        <!-- </div> -->
        <!-- </div> -->
    </div>
</section>

<script>
    function render_question(quevalue, ticketname) {
        var htmlclone = $(".question_" + ticketname).html();
        $("#question_" + ticketname + "_clone").html('');
        //$("#question_"+ticketname+"_clone").empty().append(htmlclone);
        num = 1;
        // alert(quevalue);
        // alert(ticketname);
        var all_q = 0;
        $(".rooms option:selected").each(function() {
            if ($(this).val() > 0) {
                // console.log($(this).val());
                all_q = 1;
            }
            //   console.log(all_q);
            if (all_q == 1) {
                $(".question").css("display", "block");
            } else {
                $(".question").css("display", "none");
            }
        });



        if (quevalue == 0) {
            //$(".question").css("display", "none");  
            // $('.committee:visible').find('select').prop("required", false);
            $(".eventquestion_" + ticketname).css("display", "none");
            $(".eventquestion_" + ticketname + ':hidden').find('select').prop("required", false);
            // $(".eventquestion_" + ticketname+':hidden').find('checkbox').prop("required", false);
            // $(".eventquestion_" + ticketname+':hidden').find('text').prop("required", false);

        } else {
            // $('.committee:hidden').find('select').prop("required", false);    
            $(".eventquestion_" + ticketname + ':hidden').find('select').prop("required", true);
            // $(".eventquestion_" + ticketname+':hidden').find('checkbox').prop("required", true);         
            // $(".eventquestion_" + ticketname+':hidden').find('text').prop("required", true);
            $(".eventquestion_" + ticketname).css("display", "block");
        }
        // $("#question_"+ticketname+"_clone").empty().append(htmlclone);
        if (quevalue > 1) {
            var length = quevalue - 1;
            for (i = num; i <= length; i++) {

                var lastid = $(".questioncount_" + ticketname + ":last").attr("id");
                var sublastid = $(".subquestioncount_" + ticketname + ":last").attr("id");

                $("#question_" + ticketname + "_clone").append(htmlclone);
                var result = lastid.split('-');
                var dd = parseInt((result[1])) + 1;
                var ddfff = "room-" + dd;
                $(".questioncount_" + ticketname + ":last").attr('id', ddfff);
                $(".questioncount_" + ticketname + ":last").text(dd);

                var resultsub = sublastid.split('-');
                var ddsub = parseInt((resultsub[1])) + 1;
                var ddfffsub = "subquestion-" + ddsub;
                $(".subquestioncount_" + ticketname + ":last").attr('id', ddfffsub);


                var ddfffclass = "question" + ticketname + "_" + dd + "[]";
                $("#" + ddfffsub + " .subquestion_" + ticketname).attr('name', ddfffclass);

                var ddfffclassddd = "questionid" + ticketname + "_" + dd + "[]";
                $("#" + ddfffsub + " .subquestionid_" + ticketname).attr('name', ddfffclassddd);

                //$('.question:visible').find('select').prop("required", true);
                // $('.question:visible').find('checkbox').prop("required", true);
                // $('.question:visible').find('text').prop("required", true); 

            }


        }

    }

    $(document).ready(function() {
        var site_url = '<?php echo SITE_URL; ?>';

        // var handleOptions = function(elm) {
        //     var price_id = $(elm).attr('class').match(/price-(\d+)/)[1];

        //     if ($('.questions.price-' + price_id).length == 0) {
        //         return;
        //     }

        //     var count = elm.value;
        //     //var name = $(elm).find('.price-name').text().trim();
        //     var $question_template = $('.questions.price-' + price_id).clone().removeClass('price-' + price_id);
        //     var $question_content = $('.question-price-' + price_id + ' .questions-content').empty();
        //     var $question_container = $('.question-price-' + price_id);

        //     // if more than one price is selected we put mulitple questions to match and number them
        //     for (var i = 0; i < count; i++) {
        //         $question_content.append($question_template.clone().find(":input:not(.exclude)").attr('name', 'items_' + price_id + '_' + i + '[]').end().find('.attendee-count').html(i + 1).end());
        //     }

        //     if (count > 0) {
        //         $('.questions').show();
        //         $question_container.show();
        //     } else {
        //         $question_container.hide();
        //     }

        //     $(".form-check-input.exclude:visible").on('change', function() {
        //         $check = $(this);

        //         if ($check.is(":checked")) {
        //             $check.siblings(".form-check-proxy").val("1");
        //         } else {
        //             $check.siblings(".form-check-proxy").val("");
        //         }
        //     });
        // };



        // $('.amount').on('change', function() {
        //     handleOptions(this);
        // }).trigger('cheange');

        // $('.currency').on('change', function() {
        //     window.location = window.iet.config.site_url + "event_manager/box_office/manage/270402/" + $(this).val();
        // });
        $('.payment').hide();
        $('#testUL').hide();
        $('.email').hide();


        $('.delivery').on('change', function() {
            var type = $(this).val();
            if (type == 'email') {
                $('#inlineFormInputGroup').attr('required', 'required');
                $('.email').slideDown();
                $('.user-typeahead').val('');
            } else {
                $('#inlineFormInputGroup').attr('required', false);
                $('.email').slideUp();
                $('.user-typeahead').val('');
            }

            if (type.length != "") {
                $(".payment").slideDown();
            } else {
                $(".payment").slideUp();
            }
        });


        $(function() {
            $('.user-typeahead').bind('keyup', function() {
                var pos = $(this).val();
                var check = 0;
                $('#testUL').show();
                $('#retail_ids').val('');
                var count = pos.length;
                if (count > 0) {
                    $.ajax({
                        type: 'POST',
                        url: site_url + 'event/getusersname',
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
        $('.search').val(name);
        $('#testUL').hide();
        // $('#retail_ids').val(id);
    }
</script>