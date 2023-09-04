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
                            <!-- <li class="active"><a href="#">Post Event</a> </li>
                        <li class="active"><a href="#">Event Details</a> </li>
                        <li class="active"><a href="#">Manage Tickets</a></li>
                        <li><a href="#">Publish Event</a></li> -->
                            <!-- <li> <a href="#e/4">Manage Committee</a></li> -->
                            <!-- <li>View Event</li> -->

                            <li class="active"><a href="<?php echo SITE_URL; ?>event/settings/<?php echo $id; ?>">Manage Event</a> </li>
                            <li class="active"><a href="<?php echo SITE_URL; ?>event/manage/<?php echo $id; ?>">Manage Tickets</a></li>
                            <li><a href="<?php echo SITE_URL; ?>event/committee/<?php echo $id; ?>">Manage Committee</a> </li>
                            <li><a href="<?php echo SITE_URL; ?>event/generalsetting/<?php echo $id; ?>">Publish Event</a></li>
                        </ul>
                    </div>
                </div>
            </div>


            <h4>Manage Questions</h4>
            <hr>
            <p>You can manage all your questions here.</p>
            <?php echo $this->Flash->render(); ?>
            <div class="row align-items-baseline">
                <div class="col-sm-9 col-8">


                    <ul class="tabes d-flex">

                        <li><a href="<?php echo SITE_URL; ?>event/manage/<?php echo $id; ?>">Manage</a></li>
                        <li><a href="<?php echo SITE_URL; ?>event/addons/<?php echo $id; ?>">Addons</a></li>
                        <li><a class="active" href="<?php echo SITE_URL; ?>event/questions/<?php echo $id; ?>">Questions</a></li>
                        <li><a href="<?php echo SITE_URL; ?>event/package/<?php echo $id; ?>">Package</a></li>

                    </ul>
                    <!-- <hr> -->
                </div>
                <div class="col-sm-3 col-4 text-end addbtn">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn add" data-bs-toggle="modal" data-bs-target="#exampleModal">

                        <h6 class="add_ticket d-flex align-items-center"> <i class="bi bi-plus"></i> <span>Add Question</span> </h6>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="post" enctype="multipart/form-data" class="needs-validation">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Create Question</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- =============== -->
                                        <div class="row g-3 text-start">

                                            <div class="col-md-12">
                                                <label for="inputName" class="form-label">Type</label>
                                                <?php
                                                // 'Multiple' => 'Multiple',
                                                $type = ['Select' => 'Select', 'Text' => 'Text', 'Agree' => 'Agree'];

                                                echo $this->Form->input(
                                                    'type',
                                                    ['empty' => 'Choose Type', 'options' => $type, 'class' => 'form-select', 'label' => false, 'required']
                                                ); ?>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="inputname" class="form-label">Question Name</label>

                                                <?php
                                                echo $this->Form->input(
                                                    'name',
                                                    ['required', 'placeholder' => 'Question Name', 'class' => 'form-control', 'label' => false]
                                                ); ?>
                                            </div>

                                            <div class="col-md-12">
                                                <label for="inputname" class="form-label">Question</label>

                                                <?php echo $this->Form->input('question', array('class' => 'form-control', 'type' => 'text', 'label' => false, 'placeholder' => 'Question', 'required', 'autocomplete' => 'off')); ?>
                                            </div>

                                            <div class="col-md-10" id="itemmain">
                                                <label for="inputname" class="form-label">Items</label>

                                                <?php echo $this->Form->input('items[]', array('class' => 'form-control', 'type' => 'text', 'label' => false, 'placeholder' => 'Item', 'autocomplete' => 'off', 'id' => 'items1')); ?>
                                                &nbsp
                                                <?php echo $this->Form->input('items[]', array('class' => 'form-control', 'type' => 'text', 'label' => false, 'placeholder' => 'Item', 'autocomplete' => 'off', 'id' => 'items2')); ?>

                                            </div>
                                            <div class="col-md-2 text-end" id="itemmain_add">
                                                <button class="btn add_items" type='button' id='addPlayer'><i class="bi bi-plus"></i></button>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- ================== -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn save">Create Question</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Closed -->

                </div>
            </div>

            <div class="contant_bg">
                <div class="event_settings">

                    <h6>Link Questions With Tickets Type</h6>
                    <hr>
                    <!--  -->
                    <div class="table-responsive">
                        <div class="scroll_tab2">


                            <?php
                            if (!empty($findquestion)) {
                                foreach ($findquestion as $key => $value) {
                                    $ticket_id = explode(',', $value['ticket_type_id']);
                            ?>

                                    <div class="row d-flex justify-content-end align-items-start item_bg">

                                        <div class="col-sm-5 col-5 on_sale">
                                            <strong><?php echo $value['name']; ?></strong><br>
                                            <p>
                                                <strong>Question : </strong><?php echo $value['question']; ?><br>
                                                <strong>Type : </strong><?php echo $value['type']; ?><br>

                                            </p>
                                        </div>


                                        <div class="col-sm-3 col-3 on_sale">
                                            <div class="row d-flex justify-content-end align-items-center">
                                                <form action="<?php echo SITE_URL; ?>event/linktickets" method="post" enctype="multipart/form-data" class="needs-validation">

                                                    <?php foreach ($tickettype as $key => $type) { ?>

                                                        <div class="form-check">

                                                            <input class="form-check-input" type="checkbox" name="tickets[]" value="<?php echo $type['id']; ?>" id="flexCheckDefault" <?php if (in_array($type['id'], $ticket_id)) {
                                                                                                                                                                                            echo 'checked';
                                                                                                                                                                                        } ?>>
                                                            <label class="form-check-label" for="flexCheckDefault">
                                                                <strong> <?php echo $type['title']; ?> </strong>
                                                            </label>

                                                        </div>

                                                    <?php } ?>
                                                    <input type="hidden" name="event_id" value="<?php echo $value['event_id']; ?>">
                                                    <input type="hidden" name="question" value="<?php echo $value['id']; ?>">


                                            </div>
                                        </div>

                                        <div class="col-sm-4 col-4 ">
                                            <div class="d-flex text-end justify-content-end">
                                                <!-- <div class="dropdown me-2">
                                            <button class="btn add_btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-gear"></i>
                                            </button>
                                           <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <li><a class="globalModalssbid dropdown-item" href="<?php //echo SITE_URL; 
                                                                                                    ?>event/editquestion/<?php //echo $value['id']; 
                                                                                                                            ?>" title="Edit"> Edit</a> </li>

                                            </ul> 
                                        </div>  -->

                                                <button class="btn save me-3" type="submit">Link Ticket</button>
                                                <a class=" add_btn globalModalssbid " href="<?php echo SITE_URL; ?>event/editquestion/<?php echo $value['id']; ?>" title="Edit"> Edit</a>
                                            </div>

                                        </div>
                                        </form>
                                    </div>
                                <?php }
                            } else { ?>

                                <center>
                                    <p><i>You don`t have any Question created.</i></p>
                                </center>
                        </div>
                    </div>


                <?php } ?>
                </div>

            </div>
            <div class="next_prew_btn d-flex justify-content-between">
                <a class="prew" href="<?php echo SITE_URL; ?>event/settings/<?php echo $id; ?>">Previous</a>
                <a class="next" href="<?php echo SITE_URL; ?>event/committee/<?php echo $id; ?>">Next</a>
            </div>



        </div>
        <!-- </div> -->
    </div>
</section>

<!-- Edit question  start-->
<script>
    $(document).on('click', '.globalModalssbid', function(e) {
        $('#modifieddatebid').modal('show').find('.modal-body').html('<h6 style="color:red;">Loading....Please Wait</h6>');
        e.preventDefault();
        $('#modifieddatebid').modal('show').find('.modal-body').load($(this).attr('href'));
    });
</script>

<div class="modal fade" id="modifieddatebid">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Question</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>
<!-- Edit question end  -->

<script>
    $(document).ready(function() {

        $("#items1").attr('required', true);
        $("#items2").attr('required', true);

        $('#type').on('change', function(e) {
            var type = e.target.value;

            if (type == 'Text') {
                $("#itemmain").hide();
                $("#itemmain_add").hide();
                $("#items1").attr('required', false);
                $("#items2").attr('required', false);

            } else if (type == 'Agree') {
                $("#itemmain").hide();
                $("#itemmain_add").hide();
                $("#items1").attr('required', false);
                $("#items2").attr('required', false);

            } else {
                $("#itemmain").show();
                $("#itemmain_add").show();
                $("#items1").attr('required', true);
                $("#items2").attr('required', true);
            }

        });

        $("#addPlayer").click(function() {
            $("#itemmain").append(`&nbsp<div id="removeaddon">
            <input type="text" name="items[]" class="form-control" placeholder="Item" required="required" autocomplete="off">
            <a href="javascript:void(0);" type="button" class="btn remove"><i class="bi bi-dash"></i></a></div>`);
        });

        // $("$addPlayer").click(function() {
        //     var htmlclone = $(".box").html();
        //     $("#cell").append(htmlclone);
        // });

        $("body").on("click", ".remove", function() {
            $(this).closest('#removeaddon').remove();
        });


    });
</script>