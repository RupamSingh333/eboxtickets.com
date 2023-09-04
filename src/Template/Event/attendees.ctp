<!-- <link href="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.css" rel="stylesheet" type="text/css" />
<script src="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.js"></script> -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

<style>
    a {
        cursor: pointer;
    }

    /* #titlesshow {
        position: absolute;
        background-color: #f1f1f1;
        border: 1px solid #ddd;
        padding: 10px;
    }

    #titlesshow::after {
        content: "";
        position: absolute;
        top: 100%;
        left: 50%;
        margin-left: -5px;
        border-width: 5px;
        border-style: solid;
        border-color: #ddd transparent transparent transparent;
    } */
</style>

<section id="Dashboard_section">
    <div class="d-flex">
        <?php echo $this->element('organizerdashboard'); ?>

        <!-- <div class="col-sm-9"> -->
        <div class="dsa_contant">
            <?php echo $this->element('allevent'); ?>
            <div class="pro_section">
                <!--  -->
                <div class="table-responsive">
                    <div class="scroll_tab">
                        <ul id="progressbar">

                            <li class="active"><a href="<?php echo SITE_URL; ?>event/settings/<?php echo $id; ?>">Manage Event</a> </li>
                            <?php if ($findevent['is_free'] == 'Y') { ?>
                                <li class="active"><a href="<?php echo SITE_URL; ?>event/attendees/<?php echo $id; ?>">Manage Attendees</a></li>
                            <?php } else { ?>
                                <li class="active"><a href="<?php echo SITE_URL; ?>event/manage/<?php echo $id; ?>">Manage Tickets</a></li>
                                <li class="active"><a href="<?php echo $retVal = ($findevent['is_free'] == 'Y') ? '#' : SITE_URL . 'event/committee/' . $id; ?>">Manage Committee</a> </li>
                            <?php  } ?>
                            <li><a href="<?php echo SITE_URL; ?>event/generalsetting/<?php echo $id; ?>">Publish Event</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php echo $this->Flash->render(); ?>
            <span id="flash"></span>
            <h4>Manage Attendees <span></span></h4>
            <hr>
            <p>Total Count of Attendees invited – <?php echo '(' . $userCount . ')'; ?></p>
            <!-- For Excel Export free users -->

            <div class="contant_bg">
                <div class="event_settings">

                    <div class="row g-3">
                        <!-- committee add here -->
                        <div class="col-lg-8 col-md-12">
                            <div class="Committee">

                                <h6 class="d-flex justify-content-between align-items-center heding-excel"> <span> Search Attendees</span>
                                    <!-- for searching user -->
                                    <!-- </div> -->
                                    <div class="d-flex rsvp_sec">
                                        <div class="d-flex align-items-center rsvp_btn">
                                            <label for="" class="me-2" style="font-size: 15px;">RSVP</label>
                                            <select name="type" id="select_type" required="required" class="form-select searchinguser">
                                                <option value="" selected="selected">Select</option>
                                                <option value="Y">Y</option>
                                                <option value="N">N</option>
                                            </select>

                                        </div>
                                        <a href="<?php echo SITE_URL; ?>event/downloadattendees/<?php echo $id; ?>" class="btn export_icon" data-bs-toggle="tooltip" data-bs-placement="right" title="Download Attendees List">
                                            <i class="bi bi-file-earmark-excel"></i>
                                        </a>

                                    </div>


                                </h6>


                                <div class="row">
                                    <div class="col-md-8 col-sm-6 col-6">
                                        <form action="<?php echo SITE_URL . 'event/attendees/' . $id; ?>" id="sevice_form" method="post">
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
                                                    </svg>
                                                </div>
                                                <input type="hidden" name="user_id" id="retail_ids">
                                                <input class="form-control me-2 usersearch" name="email" type="search" required placeholder="Search users email to add" aria-label="Search" autocomplete="off">
                                            </div>
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-2" style="display: flex; align-items: center;padding:0px">
                                        <input type="checkbox" id="is_allowed_guest" name="is_allowed_guest" value="Y" style="margin-right:10px;">
                                        <label for="is_allowed_guest">Allow Guest</label>
                                    </div>

                                    <div class="col-md-2 col-sm-4 col-4">
                                        <button type="submit" class="btn btn-primary Add_com" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            Add
                                        </button>

                                    </div>
                                    <div id="testUL" style="display:none; width:66%;" class="list-group">
                                        <ul></ul>
                                    </div>
                                    </form>
                                </div>
                                <!-- // table start -->
                                <hr>
                                <div class="table-responsive">
                                    <div class="scroll_tab">

                                        <!-- --------------Search Attendees----------------- -->
                                        <table class="display table table-hover table-striped" id="myTable">
                                            <thead class="tcolor">
                                                <tr>
                                                    <th width="85%" scope="col">Name (E-mail)</th>
                                                    <th width="5%" scope="col">Guest</th>
                                                    <th width="5%" scope="col">RSVP</th>
                                                    <th width="5%" scope="col">Remove</th>
                                                </tr>
                                            </thead>
                                            <tbody id="example2">

                                                <?php if (count($getUsers) > 0) {
                                                    // print_r($getUsersCount);die;
                                                    // after publish even
                                                    if ($getUsers[0]['is_rsvp']) {
                                                        foreach ($getUsers as $key => $value) {
                                                ?>
                                                            <tr>
                                                                <td><?php echo $value['user']['name'] . ' ' . $value['user']['lname'] . ' (' . $value['user']['email'] . ')'; ?></td>

                                                                <td align="center">
                                                                    <span class="rsvp" data-bs-toggle="tooltip" data-bs-placement="left" title="<?php echo ($value['is_allowed_guest'] == 'N') ? 'Guest Not Allowed' : 'Guest Allowed'; ?>"><?php echo $value['is_allowed_guest']; ?></span>
                                                                </td>

                                                                <td align="center"><a data-bs-toggle="tooltip" data-bs-placement="left" title="Change RSVP Status" class="rsvp" onclick="enablersvp('<?php echo $value['id'] . '/' . $value['is_rsvp'] . '/' . $value['event_id']; ?>')"><?php echo $value['is_rsvp']; ?></a></td>

                                                                <td align="center"><a data-bs-toggle="tooltip" data-bs-placement="right" title="Remove Attendees"><i width="20" height="20" fill="#e62d56" class="bi bi-trash" onclick="return deleteticket(<?php echo $id; ?>,<?php echo $value['id']; ?>,'A')" style="color: #e0275a;"></i></a></td>

                                                            </tr>

                                                        <?php  }
                                                    } else {
                                                        // before publish event 
                                                        foreach ($getUsers as $key => $value) {  //pr($value);exit;
                                                            $check = $this->Comman->chechguest($value['cust_id'], $value['event_id']);
                                                            // pr($check);exit;
                                                        ?>

                                                            <tr>
                                                                <td>
                                                                    <span onclick="showTitle()"><?php echo $value['user']['name'] . ' ' . $value['user']['lname'] . ' (' . $value['user']['email'] . ')'; ?>
                                                                    </span>
                                                                    <?php /* <div id="titlesshow">
                                                                        <span class="title">Position:<?php echo $value['ticketdetail'][0]['position']; ?></span><br>
                                                                        <span class="title">Divisions: <?php echo $value['ticketdetail'][0]['divisions']; ?></span><br>
                                                                        <span class="title">Time Slot: <?php echo $value['ticketdetail'][0]['timeslot']; ?></span><br>
                                                                        <span class="title">Chose Date: <?php echo $value['ticketdetail'][0]['choosedate']; ?></span>
                                                                    </div>
                                                                    <?php */?>

                                                                </td>

                                                                <td align="center">
                                                                    <span class="rsvp" data-bs-toggle="tooltip" data-bs-placement="left" title="<?php echo ($check == 'N') ? 'Guest Not Allowed' : 'Guest Allowed'; ?>"><?php echo $check; ?></span>
                                                                </td>

                                                                <td align="center"><a data-bs-toggle="tooltip" data-bs-placement="left" title="Change RSVP Status" class="rsvp" onclick="enablersvp('<?php echo $value['id'] . '/0'; ?>')"><?php echo $value['ticketdetail'][0]['is_rsvp']; ?></a></td>


                                                                <td align="center">
                                                                    <a data-bs-toggle="tooltip" data-bs-placement="right" title="Remove Attendees"><i width="20" height="20" fill="#e62d56" class="bi bi-trash" onclick="return deleteticket(<?php echo $id; ?>,<?php echo $value['ticketdetail'][0]['user_id']; ?>)" style="color: #e0275a;"></i>
                                                                    </a>

                                                                </td>

                                                            </tr>

                                                    <?php }
                                                    }
                                                } else { ?>

                                                    <tr>
                                                        <td align="center" colspan="4">
                                                            No invitations uploaded !!.
                                                        </td>
                                                    </tr>



                                                <?php } ?>

                                            </tbody>
                                        </table>
                                        <?php echo $this->element('admin/pagination'); ?>
                                    </div>
                                </div>
                                <!-- // table end -->

                            </div>
                        </div>
                        <!-- right tab -->
                        <div class="col-lg-4 col-md-12">

                            <!-- import Attendees from previous event-->
                            <div class="import_committee">
                                <h6>Import Attendees</h6>
                                <form class="row g-3 align-items-center" id="sevice_form2" action="<?php echo SITE_URL . 'event/importprattendees/' . $id; ?>" autocomplete="off" method="post">
                                    <div class="col-12">
                                        <div class="input-group">
                                            <div class="input-group-text">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
                                                </svg>
                                            </div>
                                            <input type="hidden" name="import_event_id" id="import_event_id">
                                            <input type="hidden" name="to_event_id" value="<?php echo $id; ?>">
                                            <input class="form-control me-2 eventserach" type="search" placeholder="Search Events" name="event_name" required aria-label="Search">

                                        </div>
                                        <div id="searchevent" style="display:none;" class="list-group">
                                            <ul></ul>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <a href="#"><button type="submit" class="btn save">Import</button></a>
                                    </div>

                                </form>

                                <div class="cart_price ">

                                </div>

                            </div>

                            <!--importattendees Upload Excel -->
                            <div class="import_committee mt-3">
                                <h6>Upload Excel</h6>
                                <a class="click_here" data-bs-toggle="tooltip" data-bs-placement="right" title="Download Excel Template" href="<?php echo SITE_URL . 'event/exportexcel/' . $id ?>">Click Here to Download the Sample Excel Template</a>
                                <form class="row g-3 align-items-center" id="sevice_form1" action="<?php echo SITE_URL . 'event/importattendees/' . $id; ?>" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="event_id">
                                    <div class="col-12">
                                        <input type="file" class="form-control" accept=".xlsx, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel, application/vnd.ms-excel.sheet.macroEnabled.12" name="file" onchange="return fileValidation()" required="required" id="title">

                                    </div>

                                    <div class="col-12">
                                        <a href="#"><button type="submit" class="btn save">Upload Excel</button></a>
                                    </div>
                                </form>
                                <div class="cart_price ">
                                </div>
                            </div>

                        </div>

                    </div>
                    <hr>
                    <div class="next_prew_btn d-flex justify-content-between">
                        <a class="prew" href="<?php echo SITE_URL; ?>event/settings/<?php echo $id; ?>">Previous</a>
                        <a class="next" href="<?php echo SITE_URL; ?>event/generalsetting/<?php echo $id; ?>">Next</a>
                    </div>

                </div>
            </div>

        </div>
        <!-- </div> -->
    </div>
</section>

<script>
    // var title = document.getElementById("titlesshow");
    // title.style.display = "none";

    // function showTitle() {
    //     if (title.style.display === "none") {
    //         title.style.display = "block";
    //     } else {
    //         title.style.display = "none";
    //     }
    // }



    //enable rsvp            
    function enablersvp(data) {
        // console.log(data); return false;

        if (confirm('Are you sure do you want to change RSVP Status')) {
            $('.preloader').show();
            $.ajax({
                type: 'POST',
                url: '<?php echo SITE_URL; ?>/tickets/isrsvp',
                data: {
                    'ticket_id': data,
                },
                success: async function(data) {
                    let newData = (JSON.parse(data));
                    let status = newData.status;
                    if (status) {
                        $("#example2").load(" #example2 > *", function() {});
                        $('#flash').html(`<div class="alert alert-${status} alert-dismissible fade show" role="alert"> ${newData.message}.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>`);
                    } else {

                        $("#example2").load(" #example2 > *", function() {});
                        $('#flash').html(`<div class="alert alert-success alert-dismissible fade show" role="alert"> ${newData}.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>`);
                    }
                    $('.preloader').hide();

                },
                error: function(xhr, status, error) {
                    console.log("AJAX Error: " + error); // handle the error here
                }
            });
        } else {
            // console.log(ty);
        }
    }

    //delete user ticket 
    function deleteticket(id, userid, attendees) {
        // alert(attendees)
        if (confirm('Are you sure do you want to remove this user')) {
            $('.preloader').show();
            $.ajax({
                type: 'POST',
                url: '<?php echo SITE_URL; ?>/tickets/deleteticket',
                data: {
                    'event_id': id,
                    'user_id': userid,
                    'attendees': attendees,
                },
                success: async function(data) {
                    // location.reload();
                    console.log(JSON.parse(data));
                    $("#example2").load(" #example2 > *", function() {});
                    $('.preloader').hide();
                    $('#flash').html(`<div class="alert alert-success alert-dismissible fade show" role="alert">  <strong>Success!</strong> ${JSON.parse(data)}.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>`);

                }
            });
        }
    }

    function fileValidation() {
        var fileInput = document.getElementById('title');
        var filePath = fileInput.value;
        var allowedExtensions = /(\.xlsx)$/i;
        if (!allowedExtensions.exec(filePath)) {
            alert('Please upload file having extensions .xlsx only.');
            fileInput.value = '';
            return false;
        } else {
            //Image preview
            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {};
                reader.readAsDataURL(fileInput.files[0]);
            }
        }
    }

    $(function() { //shorthand document.ready function
        $('#sevice_form').on('submit', function(e) { //use on if jQuery 1.7+
            $('.preloader').show();
        });
    });

    $(function() { //shorthand document.ready function
        $('#sevice_form2').on('submit', function(e) { //use on if jQuery 1.7+
            $('.preloader').show();
        });
    });

    $(function() { //shorthand document.ready function
        $('#sevice_form1').on('submit', function(e) { //use on if jQuery 1.7+
            $('.preloader').show();
        });
    });

    var free = '<?php echo $findevent['is_free']; ?>';
    if (free == 'Y') {
        var li = document.getElementById('progressbar');
        let lis = document.getElementById('progressbar').getElementsByTagName('li');
        // document.getElementById('progressbar').style.background ="red";
        for (var i = 0; i < lis.length; i++) {
            lis[i].classList.add("changeprogressbar");
        }
    }

    $(document).ready(function() {
        var IsFree = '<?php echo ($findevent['is_free'] == 'Y') ? 'Y' : 'N'; ?>';
        // for import committee member - start 
        $(function() {
            $('.eventserach').bind('keyup', function() {
                var searchdata = $(this).val();
                var check = 0;
                var user_id = "<?php echo $user_id; ?>";
                var event_id = "<?php echo $id; ?>";
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
                            'user_id': user_id,
                            'event_id': event_id,
                            'IsFree': IsFree,

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
        // end 

        // for searching user start 
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
        // end 
    });


    function selectevent(name, id) {
        $('.eventserach').val(name);
        $('#searchevent').hide();
        $('#import_event_id').val(id);
    }

    function selectsearch(name, id) {
        $('.usersearch').val(name);
        $('#testUL').hide();
        $('#retail_ids').val(id);
    }

    // for searching searchinguser start 
    $(function() {
        $('.searchinguser').bind('change', function() {
            // $('.searchinguser').bind('change', function() {
            var pos = $(this).val();
            var eventid = '<?php echo $id; ?>';
            var count = pos.length;
            $('.preloader').show();
            $.ajax({
                type: 'POST',
                url: '<?php echo SITE_URL; ?>event/attendeessearch',
                data: {
                    'fetch': pos,
                    'eventid': eventid
                },
                success: function(data) {
                    $("#example2").html(data);
                    $('.preloader').hide();
                },
            });

        });
    });
</script>