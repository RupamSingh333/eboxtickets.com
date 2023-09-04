<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
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
<section id="Dashboard_section">
    <div class="d-flex">
        <?php echo $this->element('organizerdashboard'); ?>

        <!-- <div class="col-sm-9"> -->
        <div class="dsa_contant">
            <?php echo $this->element('allevent'); ?>
            <h4>User Manager</h4>
            <hr>
            <p>You can add users to manage your events here.</p>
            <?php echo $this->Flash->render(); ?>

            <div class="row align-items-baseline">
                <div class="col-sm-10 col-10 ">
                    <ul class="tabes d-flex">
                        <li><a class="<?php if ($this->request->params['action'] == "usersmanager") {
                                            echo "active";
                                        } else {
                                            echo "";
                                        } ?>" href="<?php echo SITE_URL; ?>event/usersmanager/<?php echo $id; ?>">Manage</a></li>
                        <li><a class="<?php if ($this->request->params['action'] == "roles") {
                                            echo "active";
                                        } else {
                                            echo "";
                                        } ?>" href="<?php echo SITE_URL; ?>event/roles/<?php echo $id; ?>">Roles</a></li>
                    </ul>
                </div>
                <div class="col-sm-2 col-2 text-end pe-3 addbtn">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn add_green" data-bs-toggle="modal" data-bs-target="#exampleModal">

                        <h6 class="add_ticket d-flex align-items-center"> <i class="bi bi-plus"></i> <span></span> </h6>
                    </button>
                </div>
            </div>

            <div class="contant_bg2">
                <div class="event_payment">
                    <section id="my_ticket">
                        <div class="event-list-container" id="Mycity">
                            <div class="event_detales">

                                <div class="row">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead class="table-dark table_bg">
                                                <tr>

                                                    <th style="width: 70%;" scope="col">Name</th>
                                                    <th style="width: 30%;" scope="col">Options</th>

                                                </tr>
                                            </thead>
                                            <tbody class="tbody_bg">
                                                <?php if (!empty($allUsers)) {   ?>

                                                    <?php foreach ($allUsers as $key => $value) { //pr($value); die;
                                                    ?>
                                                        <tr>
                                                            <td>
                                                                <div class="col-8">
                                                                    <p class="my-1 icons"><i class="bi bi-person "></i> <?php echo ucfirst(strtolower($value['user']['name'])) . ' ' . ucfirst(strtolower($value['user']['lname'])); ?></p>
                                                                    <p class="my-1 icons"><i class="bi bi-envelope"></i> <?php echo $value['user']['email']; ?></p>
                                                                    <p class="my-1 icons"><i class="bi bi-phone"></i> <?php echo $value['user']['mobile']; ?></p>
                                                                </div>

                                                            </td>

                                                            <td>
                                                                <div class="col-8">
                                                                    <form action="<?php echo SITE_URL; ?>event/usersmanager/<?php echo $id; ?>" method="post">
                                                                        <input type="hidden" name="user_id" value="<?php echo $value['id']; ?>">
                                                                        <button class="btn save">Delete</button>
                                                                    </form>
                                                                </div>

                                                            </td>
                                                        </tr>
                                                    <?php  }
                                                    ?>

                                                <?php } else {
                                                ?>
                                                    <tr>
                                                        <td colspan="4" style="text-align:center"><b>No Orders</b></td>
                                                    </tr>
                                                <?php }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </section>

                </div>
            </div>


        </div>
        <!-- </div> -->
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" autocomplete="off" enctype="multipart/form-data" class="needs-validation">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Search User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- =============== -->

                    <div class="row">
                        <div class="col-sm-3 col-3">
                            <label for="inputName" class="form-label">Search</label>
                        </div>
                        <div class="col-sm-9 col-9">
                            <?php
                            echo $this->Form->input(
                                'email',
                                ['required' => 'required', 'class' => 'form-control usersearch', 'default' => '', 'placeholder' => 'Search', 'label' => false]
                            ); ?>
                            <input type="hidden" name="user_id" id="retail_ids">
                            <!-- <input class="form-control me-2 usersearch" name="email" type="search" required placeholder="Search users email" aria-label="Search" autocomplete="off"> -->
                        </div>
                        <div id="testUL" style="display:none;" class="list-group">
                            <ul></ul>
                        </div>

                        <!-- <div class="col-sm-3 col-3">
                            <label for="inputState" class="form-label">Visibility</label>
                        </div> -->
                        <!-- <div class="col-sm-3 col-3">
                            <?php
                            // $hidden = ['' => 'Ticket Scanner'];
                            // echo $this->Form->input(
                            //     'hidden',
                            //     ['empty' => 'Choose One', 'options' => $hidden, 'required' => 'required', 'class' => 'form-select', 'default' => '', 'label' => false]
                            //); 
                            ?>
                        </div> -->
                    </div>
                    <!-- ================== -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn save">Add User</button>
                </div>
            </form>
        </div>
    </div>
</div>

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
</script>