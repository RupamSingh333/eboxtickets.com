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

    #testUL ul li a {
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
                <h4>Committee Group: <?php echo $findgroup['name']; ?></h4>
                <hr>
                <p>Committee groups persist across events. This is a convenient way to manage different lists of committee members for different events or the even same event.</p>

                <ul class="tabes d-flex">
                    <li><a href="<?php echo SITE_URL.'event/committeetickets/'.$id; ?>">Manage</a></li>
                    <li><a href="<?php echo SITE_URL.'event/committeetickets/'.$id; ?>">Tickets</a></li>
                    <li><a class="active" href="<?php echo SITE_URL.'event/committeegroups/'.$id; ?>">Groups</a></li>
                </ul>
                <div class="contant_bg">
                    <div class="event_settings">
                        <?php echo $this->Flash->render(); ?>

                        <div class="row g-3">
                            <!-- committee add here -->
                            <div class="col-md-12">
                                <div class="Committee">

                                    <h6 class="">Groups</h6>

                                    <div class="row">
                                        <div class="col-9">
                                            <form action="#" method="post">
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
                                                        </svg>
                                                    </div>
                                                    <input type="hidden" name="user_id" id="retail_ids">
                                                    <input class="form-control me-2 usersearch" name="email" type="search" required placeholder="Search User Name" aria-label="Search" autocomplete="off">
                                                </div>
                                                <div id="testUL" style="display:none;" class="list-group">
                                                    <ul></ul>
                                                </div>
                                        </div>
                                        <div class="col-2">
                                            <button type="submit" class="btn btn-primary Add_com" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                Add
                                            </button>

                                        </div>
                                        </form>
                                    </div>

                                    <hr>

                                    <div class="row Current_heading">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-3">
                                            <p> Name</p>
                                        </div>
                                        <div class="col-sm-6 item-center">
                                            <p>Email</p>
                                        </div>
                                        <div class="col-sm-2 item-center">
                                            <p>Remove</p>
                                        </div>
                                    </div>

                                    <?php if (count($findmember) > 0) {
                                        foreach ($findmember as $key => $value) {

                                    ?>

                                            <div class="row item_list align-items-center">
                                                <div class="col-sm-1 item-center">
                                                    <div class="form-check">
                                                        <!-- <input class="form-check-input" type="checkbox" id="flexCheckDefault"> -->
                                                    </div>
                                                </div>

                                                <div class="col-sm-3">
                                                    <p><?php echo $value['user']['name']; ?></p><br>
                                                </div>
                                                <div class="col-sm-6 item-center">
                                                    <p>
                                                    <?php echo $value['user']['email']; ?>
                                                    </p>
                                                </div>
                                                <div class="col-sm-2 item-center">
                                                    <a href="<?php echo SITE_URL . 'event/deletemember/' . $value['id'].'/'.$value['group_id']; ?>"><i width="20" height="20" fill="#e62d56" class="bi bi-trash" onclick="javascript: return confirm('Are you sure do you want to delete this member')" style="color: #e0275a;"></i></a>
                                                </div>
                                            </div>

                                        <?php  }
                                    } else { ?>

                                        <center>
                                            <p><i>No member added for this group.</i></p>
                                        </center>

                                    <?php } ?>

                                </div>
                            </div>

                            <hr>

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
                var event_id = "<?php echo $id ;?>";
                $('#testUL').show();
                $('#retail_ids').val('');
                var count = pos.length;
                if (count > 0) {
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo SITE_URL; ?>event/getusersname',
                        data: {
                            'fetch': pos,
                            'check': check,
                            'event_id':event_id
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

</script>