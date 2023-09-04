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
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
<link href="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.css" rel="stylesheet" type="text/css" />
<script src="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.js"></script>
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
                            <li class="active"><a href="<?php echo SITE_URL; ?>event/manage/<?php echo $id; ?>">Manage Tickets</a></li>
                            <li class="active"><a href="<?php echo SITE_URL; ?>event/committee/<?php echo $id; ?>">Manage Committee</a> </li>
                            <!-- <li> <a href="#e/4">Manage Committee</a></li> -->
                            <li><a href="<?php echo SITE_URL; ?>event/generalsetting/<?php echo $id; ?>">Publish Event</a></li>
                        </ul>
                    </div>
                </div>
            </div>


            <h4>Committee Manager</h4>
            <hr>
            <p>You can add users to manage your events here.</p>

            <ul class="tabes d-flex">
                <li><a class="active" href="#">Manage</a></li>
                <li><a href="<?php echo SITE_URL . 'event/committeetickets/' . $id; ?>">Tickets</a></li>
                <li><a href="<?php echo SITE_URL . 'event/committeegroups/' . $id; ?>">Groups</a></li>
            </ul>
            <div class="contant_bg">
                <div class="event_settings">
                    <?php echo $this->Flash->render(); ?>

                    <div class="row g-3">
                        <!-- committee add here -->
                        <div class="col-lg-8 col-md-12">
                            <div class="Committee">

                                <h6 class="">Current Committee</h6>

                                <div class="row">
                                    <div class="col-md-10 col-sm-8 col-8">
                                        <form action="#" method="post">
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
                                                    </svg>
                                                </div>
                                                <input type="hidden" name="user_id" id="retail_ids">
                                                <input class="form-control me-2 usersearch" name="email" type="search" required placeholder="Search users email" aria-label="Search" autocomplete="off">
                                            </div>
                                    </div>
                                    <div id="testUL" style="display:none;" class="list-group">
                                        <ul></ul>
                                    </div>
                                    <div class="col-md-2 col-sm-4 col-4">
                                        <button type="submit" class="btn btn-primary Add_com" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            Add
                                        </button>

                                    </div>
                                    </form>
                                </div>

                                <hr>

                                <div class="table-responsive">
                                    <div class="scroll_tab">

                                        <div class="row Current_heading">
                                            <!-- <div class="col-sm-1"></div> -->
                                            <div class="col-8">
                                                <p> Name</p>
                                            </div>
                                            <div class="col-2 item-center">
                                                <p>Status</p>
                                            </div>
                                            <div class="col-2 item-center">
                                                <p>Remove</p>
                                            </div>
                                        </div>
                                        <?php 
                                        
                                        // $page = $this->request->params['paging']['event']['page'];
                                        // $limit = $this->request->params['paging']['event']['perPage'];
                                        // $counter = ($page * $limit) - $limit + 1;
                                        // pr($limit);exit;

                                        ?>


                                        <?php if (count($findcommittee) > 0) {
                                            foreach ($findcommittee as $key => $value) {

                                                // for statis icon change 
                                                if ($value['status'] == 'Y') {
                                                    $statusicon = 'class="bi bi-eye-fill" style=" color: #00972d; margin-right: 5px;align-items: center;"';
                                                } else {

                                                    $statusicon = 'class="bi bi-eye-slash-fill" style=" color: #e62d56; margin-right: 5px;align-items: center;"';
                                                }

                                        ?>

                                                <div class="row item_list align-items-center">
                                                    <!-- <div class="col-sm-1 item-center">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="flexCheckDefault">
                                                    </div>
                                                </div> -->

                                                    <div class="col-8">
                                                        <p class="my-1 icons"><i class="bi bi-person "></i> <?php echo $value['user']['name'] . ' ' . $value['user']['lname']; ?></p>
                                                        <p class="my-1 icons"><i class="bi bi-envelope"></i> <?php echo $value['user']['email']; ?></p>
                                                        <p class="my-1 icons"><i class="bi bi-phone"></i> <?php if ($value['user']['mobile']) {
                                                                                                                echo  $value['user']['mobile'];
                                                                                                            } else {
                                                                                                                echo "N/A";
                                                                                                            } ?></p>
                                                    </div>
                                                    <div class="col-2 item-center">
                                                        <p>
                                                            <a href="<?php echo SITE_URL . 'event/committeoptions/' . $value['id'] . '/status'; ?>"><i <?php echo $statusicon; ?>></i></a>
                                                        </p>
                                                    </div>
                                                    <div class="col-2 item-center">
                                                        <a href="<?php echo SITE_URL . 'event/committeoptions/' . $value['id']; ?>"><i width="20" height="20" fill="#e62d56" class="bi bi-trash" onclick="return confirm('Are you sure do you want to delete this committee')" style="color: #e0275a;"></i></a>
                                                    </div>
                                                </div>

                                            <?php  }
                                        } else { ?>

                                            <center>
                                                <p><i>You have no committee for this event.</i></p>
                                            </center>

                                        <?php } ?>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- import committee -->
                        <div class="col-lg-4 col-md-12">
                            <div class="import_committee">
                                <h6>Import Committee</h6>
                                <form class="row g-3 align-items-center" action="<?php echo SITE_URL . 'event/importcommittee'; ?>" method="post">
                                    <div class="col-12">
                                        <!-- <label class="visually-hidden" for="inlineFormInputGroupUsername">search</label> -->
                                        <div class="input-group">
                                            <div class="input-group-text">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
                                                </svg>
                                            </div>
                                            <input type="hidden" name="import_event_id" id="import_event_id">
                                            <input type="hidden" name="to_event_id" value="<?php echo $id; ?>">
                                            <input class="form-control me-2 eventserach" type="search" placeholder="Search Events" required aria-label="Search">

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
                        </div>

                    </div>
                    <hr>
                    <div class="next_prew_btn d-flex justify-content-between">
                        <a class="prew" href="<?php echo SITE_URL; ?>event/manage/<?php echo $id; ?>">Previous</a>
                        <a class="next" href="<?php echo SITE_URL; ?>event/generalsetting/<?php echo $id; ?>">Next</a>
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
                var eventId = "<?php echo $id; ?>";
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
                            'event_id':eventId,
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