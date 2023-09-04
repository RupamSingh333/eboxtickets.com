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
                            <?php if ($event['is_free'] == 'Y') { ?>
                                <li><a href="<?php echo SITE_URL; ?>event/attendees/<?php echo $id; ?>">Manage Attendees</a></li>
                            <?php } else { ?>
                                <li class="active"><a href="<?php echo SITE_URL; ?>event/manage/<?php echo $id; ?>">Manage Tickets</a></li>
                                <li><a href="<?php echo SITE_URL . "event/committee/" . $id; ?>">Manage Committee</a> </li>
                            <?php  } ?>
                            <li><a href="<?php echo SITE_URL; ?>event/generalsetting/<?php echo $id; ?>">Publish Event</a></li>
                        </ul>
                    </div>
                </div>
            </div>


            <h4>Manage Tickets</h4>
            <hr>
            <p>You can manage all your tickets here.</p>
            <?php echo $this->Flash->render(); ?>
            <div class="row align-items-baseline">
                <div class="col-sm-10 col-8 ">
                    <ul class="tabes d-flex">
                        <li><a class="active" href="<?php echo SITE_URL; ?>event/manage/<?php echo $id; ?>">Manage</a></li> <?php if ($event['is_free'] == 'N') {  ?>
                            <li><a href="<?php echo SITE_URL; ?>event/addons/<?php echo $id; ?>">Addons</a></li>
                            <li><a href="<?php echo SITE_URL; ?>event/questions/<?php echo $id; ?>">Questions</a></li>
                            <li><a href="<?php echo SITE_URL; ?>event/package/<?php echo $id; ?>">Package</a></li>
                        <?php } ?>
                    </ul>
                    <!-- <hr> -->
                </div>
                <?php if ($event['is_free'] == 'N') {  ?>

                    <div class="col-sm-2 col-2 addbtn">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn add_green" data-bs-toggle="modal" data-bs-target="#exampleModal">

                            <h6 class="add_ticket d-flex align-items-center"> <i class="bi bi-plus"></i> <span>Add Ticket</span> </h6>
                        </button>
                    </div>
                <?php } ?>
            </div>

            <!--Add Ticket Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="post" enctype="multipart/form-data" class="needs-validation">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Ticket</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- =============== -->

                                <div class="row g-3 text-start">
                                    <div class="col-md-12">
                                        <label for="inputName" class="form-label">Name</label>
                                        <?php
                                        echo $this->Form->input(
                                            'title',
                                            ['required' => 'required', 'class' => 'form-control', 'default' => '', 'placeholder' => 'Enter Ticket Name', 'label' => false]
                                        ); ?>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputState" class="form-label">Type</label>
                                        <?php
                                        $type = ['open_sales' => 'Open Sales', 'committee_sales' => 'Committee Sales'];
                                        echo $this->Form->input(
                                            'type',
                                            ['empty' => 'Choose Type', 'options' => $type, 'default' => '', 'required' => 'required', 'class' => 'form-select', 'label' => false]
                                        ); ?>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputname" class="form-label">Price</label>

                                        <?php
                                        echo $this->Form->input(
                                            'price',
                                            ['required' => 'required', 'placeholder' => 'Price', 'class' => 'form-control', 'label' => false, 'onkeypress' => 'return isPrice()']
                                        ); ?>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="inputname" class="form-label">Count</label>
                                        <?php echo $this->Form->input('count', array('class' => 'form-control price price_error', 'type' => 'text', 'label' => false, 'placeholder' => 'Enter Count', 'required', 'maxlength' => '5', 'onkeypress' => 'return isPrice()', 'autocomplete' => 'off', 'value' => '')); ?>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="inputState" class="form-label">Visibility</label>
                                        <?php
                                        $hidden = ['Y' => 'Visible', 'N' => 'Hidden'];
                                        echo $this->Form->input(
                                            'hidden',
                                            ['empty' => 'Choose One', 'options' => $hidden, 'required' => 'required', 'class' => 'form-select', 'default' => '', 'label' => false]
                                        ); ?>
                                    </div>

                                </div>
                                <!-- ================== -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn save">Add Ticket</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Add Ticket Modal Closed -->

            <div class="contant_bg">
                <div class="event_settings">

                    <h6>Tickets Types</h6>
                    <hr>
                    <?php if (empty($findtickets)) {  ?>

                        <div class="row d-flex justify-content-end align-items-center item_bg">
                            <div class="col-sm-8 col-7 hidden">
                                <p>
                                    <strong>Comps</strong> (<?php echo ($event['currency']['Currency_symbol']) ? $event['currency']['Currency_symbol'] : "$"; ?>0.00 <?php echo ($event['currency']['Currency']) ? $event['currency']['Currency'] : "USD"; ?>) <br>
                                    Sold: 0
                                </p>

                                <div class="row d-flex justify-content-end align-items-center">
                                    <div class="col-md-4">
                                        <p class="d-flex"><i class="bi bi-lock-fill"></i></i>Committee Sales</p>

                                    </div>
                                    <div class="col-md-3">
                                        <p> <i class="bi bi-eye-slash-fill"></i> Hidden </p>

                                    </div>
                                    <div class="col-md-3">
                                    </div>
                                    <div class="col-md-2">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-5 d-flex justify-content-end">

                            </div>
                        </div>

                    <?php } ?>

                    <?php foreach ($findtickets as $key => $value) {
                        $ticketsalecount = $this->Comman->ticketsalecount($id, $value['id']);
                    ?>
                        <div class="row d-flex justify-content-end align-items-center item_bg">
                            <div class="col-sm-8 on_sale">
                                <p>
                                    <strong><?php echo $value['title']; ?></strong> (<?php echo ($event['currency']['Currency_symbol']) ? $event['currency']['Currency_symbol'] : "$"; ?><?php echo number_format($value['price'], 2); ?> <?php echo ($event['currency']['Currency']) ? $event['currency']['Currency'] : "USD"; ?>) <br>
                                    <?php if ($value['type'] == 'open_sales') { ?>
                                        Sold: <?php echo ($ticketsalecount['ticketsold']) ? $ticketsalecount['ticketsold'] : 0; ?> / <?php echo $value['count']; ?>

                                    <?php  } else { ?>
                                        Sold: <?php echo ($ticketsalecount['ticketsold']) ? $ticketsalecount['ticketsold'] : 0; ?>
                                    <?php } ?>


                                </p>

                                <div class="row d-flex justify-content-end align-items-center">
                                    <div class="col-md-4">
                                        <?php if ($value['type'] == 'open_sales') { ?>
                                            <p class="d-flex"><i class="bi bi-unlock-fill"></i> Open Sales</p>
                                        <?php  } else { ?>
                                            <p class="d-flex hidden"><i class="bi bi-lock-fill"></i></i>Committee Sales</p>
                                        <?php } ?>
                                    </div>
                                    <div class="col-md-3">
                                        <?php if ($value['hidden'] == 'Y') { ?>
                                            <p> <i class="bi bi-eye-fill"></i> Visible </p>
                                        <?php  } else { ?>
                                            <p class="hidden"> <i class="bi bi-eye-slash-fill"></i> Hidden </p>
                                        <?php } ?>
                                    </div>
                                    <div class="col-md-3">
                                        <?php if ($value['sold_out'] == 'Y') { ?>
                                            <p class="status_Deactive"> Sold Out </p>
                                        <?php  } else { ?>
                                            <p class="status_Active"> On Sale </p>
                                        <?php } ?>

                                    </div>
                                    <div class="col-md-2">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 d-flex justify-content-end">
                                <?php if ($value['type'] != 'open_sales' && $event['is_free'] == 'N') {  ?>
                                    <a class="committee_btn" style="background-color:#ff9800;" href="<?php echo SITE_URL; ?>event/committee/<?php echo $id; ?>">Committee</a>
                                <?php } ?>
                                <?php if ($value['type'] != 'comps' && $value['title'] != 'Comps') { ?>

                                    <div class="dropdown">
                                        <button class="btn add_btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-gear"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

                                            <li>
                                                <a class="globalModalssbid dropdown-item" href="<?php echo SITE_URL; ?>event/edittickets/<?php echo $value['id']; ?>" title="Edit Tickets"> Edit</a>

                                            </li>

                                            <li><a class="dropdown-item" href="<?php echo SITE_URL . 'event/toggle/type/' . $value['id']; ?>"><?php if ($value['type'] == 'open_sales') {
                                                                                                                                                    echo 'Committee Sales';
                                                                                                                                                } else {
                                                                                                                                                    echo 'Open Sales';
                                                                                                                                                } ?></a></li>

                                            <li><a class="dropdown-item" href="<?php echo SITE_URL . 'event/toggle/hidden/' . $value['id']; ?>"><?php if ($value['hidden'] == 'Y') {
                                                                                                                                                    echo 'Hide';
                                                                                                                                                } else {
                                                                                                                                                    echo 'Show';
                                                                                                                                                } ?></a></li>

                                            <li><a class="dropdown-item" href="<?php echo SITE_URL . 'event/toggle/sold_out/' . $value['id']; ?>"><?php if ($value['sold_out'] == 'Y') {
                                                                                                                                                        echo 'On Sale';
                                                                                                                                                    } else {
                                                                                                                                                        echo 'Sold Out';
                                                                                                                                                    } ?></a></li>
                                        </ul>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php  } ?>

                </div>
                <div class="next_prew_btn d-flex justify-content-between">
                    <!-- <a href="https://eboxtickets.com/event/settings/21">Prew</a> -->
                    <a class="prew" href="<?php echo SITE_URL; ?>event/settings/<?php echo $id; ?>">Previous</a>
                    <?php if ($event['is_free'] == 'Y') { ?>
                        <a class="next" href="<?php echo SITE_URL; ?>event/generalsetting/<?php echo $id; ?>">Next</a>
                    <?php  } else { ?>
                        <a class="next" href="<?php echo SITE_URL; ?>event/committee/<?php echo $id; ?>">Next</a>
                    <?php  } ?>

                </div>
            </div>

        </div>
        <!-- </div> -->
    </div>
</section>
<!-- =========================================== -->
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
                <h5 class="modal-title">Edit Ticket</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>

<script>
    function isPrice(e) {
        var e = e || window.event;
        var k = e.which || e.keyCode;
        var s = String.fromCharCode(k);
        if (/^[\\\"\'\;\:\.\,\[\]\>\<\/\?\=\+\_\|~`!@#\$%^&*\(\)a-z\A-Z]$/i.test(s)) {
            alert("Special characters not acceptable");
            return false;
        }
    }

    jQuery($ => {
        let $checkBox = $('#type').on('change', e => {
            if (e.target.value == 'committee_sales') {
                $('#count').prop('disabled', 'disabled');

            } else {
                $('#count').prop('disabled', false);
                $('#count').attr('required', true);
            }

        });
    });
</script>