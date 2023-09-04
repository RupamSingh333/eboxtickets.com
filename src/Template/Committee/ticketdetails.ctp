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
<section id="Committee">
    <div class="container">

        <div class="heading">
            <h1>Committee</h1>
            <h2>Committee</h2>
            <p class=" text-center mb-4">If you belong to any committees for events on eboxtickets, you can manage ticket requests here.</p>
            <?php echo $this->Flash->render(); ?>
        </div>
        <?php echo $this->element('committeeheader'); ?>

        <div class="count_ditals mt-4">
            <table class="table table-striped table-hover">
                <thead align="center">
                    <tr>
                        <th scope="col">
                            Count</th>
                        <th scope="col">
                            Type</th>
                        <th scope="col">Price</th>

                    </tr>
                </thead>
                <tbody align="center">
                    <?php if (!empty($ticketstype)) {
                        // $eventoffice_ticketssold = 0;
                        foreach ($ticketstype as $key => $value) {
                            // pr($value);
                            // exit;
                            if ($value['ticket_id'] != 0) {
                                // $getdata = $this->Comman->ticketdetails($value['ticket_id']);
                                $eventoffice_ticketssold = $this->Comman->ticketsalecount_committee($value['event_id'], $value['ticket_id']);
                                $total_left = $value['count'] - $eventoffice_ticketssold;
                            }
                            if ($total_left == 0) {
                                continue;
                            }
                    ?>
                            <tr>
                                <th><?php echo $total_left; ?></th>
                                <td><?php echo $value['eventdetail']['title']; ?></td>
                                <td>
                                    <?php echo $eventdetails['currency']['Currency_symbol']; ?>
                                    <?php echo ($value['eventdetail']['price']) ? sprintf('%.2f', $value['eventdetail']['price']) : "0.00"; ?>
                                    <?php $eventdetails['slug']; ?> <?php echo $eventdetails['currency']['Currency']; ?>
                                </td>
                            </tr>
                        <?php }
                    } else { ?>
                        <tr>
                            <td>
                                <center>
                                    <p>You have no tickets available for this event.</p>
                                </center>
                            </td>
                        </tr>
                    <?php  } ?>

                </tbody>
            </table>
        </div>

        <div class="count_box mt-4">
            <h4>Share Link</h4>
            <p>This link will have you as the committee member pre-selected so your friends can request tickets faster! Click the link to copy it now.</p>
            <div class="d-flex align-items-center input_links">
                <?php $user_id = $this->request->session()->read('Auth.User.id'); ?>
                <input type="URL" value="<?php echo SITE_URL . 'event/' . $eventdetails['slug']; ?>/<?php echo $user_id; ?>" id="sharelinkcopytext" class="form-control" readonly>
                <!-- <a href=""><?php //echo SITE_URL . 'event/' . $eventdetails['slug']; 
                                ?></a> -->
                <a href="javascript:void(0)" onclick="myFunction()" id="copied_check" title="Copy">
                    <img class="copy_icon" src="<?php echo SITE_URL; ?>images/link-icon.png" alt="">
                </a>
                <!-- <span class = "copied_check" style = "display:none;"></span>       class = "bi bi-clipboard"      -->


            </div>

        </div>
        <script>
            function myFunction() {
                // $('.copied_check').css("display","none");
                var copyText = document.getElementById("sharelinkcopytext");
                copyText.select();
                copyText.setSelectionRange(0, 99999);
                navigator.clipboard.writeText(copyText.value);
                // $("#copied_check").removeClass('bi bi-clipboard');
                // $("#copied_check").addClass('bi bi-clipboard-fill');
                $('#copied_check').prop('title', 'Link copied');
                // $('.copied_check').css("display","");
                // alert("Copied the text: " + copyText.value);
            }
        </script>

        <?php  ?>
        <div class="count_box mt-4">
            <h4>Ticket Push</h4>
            <p>This tool allows you to 'push' approvals to a patron's cart using their eboxtickets email address. If the ticket being 'pushed' is free, it will go straight to their 'My Tickets'. You cannot undo this operation!</p>


            <form method="post" action="<?php echo SITE_URL; ?>committee/ticketpush">
                <div class="row g-3 form_bg">
                    <div class="col-md-4">
                        <label for="inputEmail4" class="form-label">Email Address
                        </label>

                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control search user-typeahead" required name="email" id="inlineFormInputGroup" placeholder="Search" data-provide="typeahead" autocomplete="off">
                        <div id="testUL" class="list-group">
                            <ul></ul>
                        </div>
                    </div>


                    <?php if (!empty($ticketstype)) {
                        $total_ticket_data = 0;
                        foreach ($ticketstype as $key => $valuepush) { //pr($valuepush);

                            $ticket_sold = $this->Comman->ticketsalecount_committee($valuepush['event_id'], $valuepush['ticket_id']);
                            $ticket_name = str_replace(" ", "_", $valuepush['eventdetail']['title']);
                            $find_question_data = $this->Comman->findquestion($valuepush['event_id'], $valuepush['ticket_id']);
                            // pr($ticket_sold);
                            $total_ticket_data =  $valuepush['count'] - $ticket_sold;

                            if ($total_ticket_data == 0) {
                                continue;
                            }
                            // if ($valuepush['ticket_id'] != 0) {
                            //     // $getdata = $this->Comman->ticketdetails($valuepush['ticket_id']);
                            // }
                            ?>
                            <div class="col-md-4 ">
                                <label for=""><?php echo $valuepush['ticket_id'] == 0 ? "Comps" : $valuepush['eventdetail']['title']; ?> <?php echo $eventdetails['currency']['Currency_symbol']; ?><?php echo sprintf('%0.2f', $valuepush['eventdetail']['price']); ?> <?php echo $eventdetails['currency']['Currency']; ?> (<?php echo $total_ticket_data; ?>)</label>
                            </div>

                            <div class="col-md-8">
                                <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">

                                <select id="question_type_id" name="ticket_count[<?php echo $valuepush['eventdetail']['id']; ?>]" class="form-select rooms <?php if ($valuepush['eventdetail']['type'] == "committee_sales") {echo "commiteesalesticket";} ?>" data-val="<?php echo $valuepush['eventdetail']['title']; ?>" onchange="render_question(this.value,'<?php echo $ticket_name; ?>');">
                                    <option value="">0</option>
                                    <?php
                                    for ($x = 1; $x <= $total_ticket_data; $x++) { ?>
                                        <option value="<?php echo $x; ?>"><?php echo $x; ?></option>
                                    <?php } ?>
                                </select>
                                <!-- Question rander start  -->
                                <div class="<?php echo "eventquestion_" . $ticket_name; ?>" style="display:none">

                                    <?php if (!empty($find_question_data)) { ?>
                                        <h6 class="ticket_TH mt-3"><?php echo $valuepush['eventdetail']['title']; ?></h6>
                                        <div class="<?php echo "question_" . $ticket_name; ?>">
                                            <p class="attendee_no">Attendee #<span class="<?php echo "questioncount_" . $ticket_name; ?>" id="room-1">1</span></p>
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

                                <!-- Question rander end  -->
                            </div>

                        <?php }
                    } else { ?>
                        <center>
                            <p>You have no tickets available for this event.</p>
                        </center>
                    <?php } ?>


                    <div class="col-12">
                        <button type="submit" class="btn btn subtn">Submit</button>
                    </div>
                </div>
            </form>
        </div>
        <?php  ?>
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
        $('#testUL').hide();

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