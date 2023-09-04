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
                            <li><a href="<?php echo SITE_URL; ?>event/committee/<?php echo $id; ?>">Manage Committee</a> </li>
                            <li><a href="<?php echo SITE_URL; ?>event/generalsetting/<?php echo $id; ?>">Publish Event</a></li>
                        </ul>
                    </div>
                </div>
            </div>


            <h4>Manage Addons</h4>
            <hr>
            <p>You can add additional items for sale at checkout here.</p>
            <?php echo $this->Flash->render(); ?>
            <div class="row align-items-baseline">
                <div class="col-sm-9 col-8">
                    <ul class="tabes d-flex">
                        <li><a href="<?php echo SITE_URL; ?>event/manage/<?php echo $id; ?>">Manage</a></li>
                        <li><a class="active" href="<?php echo SITE_URL; ?>event/addons/<?php echo $id; ?>">Addons</a></li>
                        <li><a href="<?php echo SITE_URL; ?>event/questions/<?php echo $id; ?>">Questions</a></li>
                        <li><a href="<?php echo SITE_URL; ?>event/package/<?php echo $id; ?>">Package</a></li>

                    </ul>
                    <!-- <hr> -->
                </div>
                <div class="col-sm-3 col-4 text-end addbtn ">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn add" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <h6 class="add_ticket d-flex align-items-center"> <i class="bi bi-plus"></i>  <span>Add Addons</span></h6>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="post" enctype="multipart/form-data" class="needs-validation">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Create Addon</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- =============== -->

                                        <div class="row g-3 text-start">
                                            <div class="col-md-6">
                                                <label for="inputName" class="form-label">Name</label>
                                                <?php

                                                echo $this->Form->input(
                                                    'name',
                                                    ['required' => 'required', 'class' => 'form-control', 'default' => '', 'placeholder' => 'Enter Name', 'label' => false]
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

                                            <div class="col-md-12">
                                                <label for="inputname" class="form-label">Description</label>
                                                <?php echo $this->Form->input('description', array('class' => 'form-control price price_error', 'type' => 'textarea', 'label' => false, 'placeholder' => 'Enter description', 'required', 'autocomplete' => 'off', 'value' => '')); ?>
                                            </div>


                                        </div>
                                        <!-- ================== -->
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn save">Add Addon</button>
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

                    <h6>Addons</h6>
                    <hr>
                    <?php
                    if (!empty($findaddons)) {
                        foreach ($findaddons as $key => $value) { ?>
                            <div class="row d-flex justify-content-end align-items-center item_bg">
                                <div class="col-sm-10 on_sale">



                                    <div class="row">
                                        <div class="col-12 mb-2">
                                            <p class="p_icon head">
                                                <?php echo ucwords(strtolower($value['name'])); ?>
                                            </p>
                                        </div>
                                        <hr>
                                        <div class="col-12 mb-3">
                                            <div class="row">
                                                <div class="col-sm-4 col-12">
                                                    <p class="p_icon">
                                                        <strong><i class="bi bi-cash"></i> Price:</strong> <?php echo ($event['currency']['Currency_symbol']) ? $event['currency']['Currency_symbol'] : "$"; ?><?php echo number_format($value['price'], 2); ?> <?php echo ($event['currency']['Currency']) ? $event['currency']['Currency'] : "USD"; ?>
                                                    </p>
                                                </div>

                                                <div class="col-sm-4 col-12">
                                                    <p class="p_icon">
                                                        <strong><i class="bi bi-eye"></i> Visibility:</strong> <?php echo $value['hidden'] == 'Y' ? 'Hidden' : 'Visible'; ?>
                                                    </p>
                                                </div>
                                                <div class="col-sm-4 col-12">
                                                    <p class="p_icon">
                                                        <strong><i class="bi bi-bag-plus-fill"></i> Count:</strong> <?php echo $value['count']; ?>
                                                    </p>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-12 mb-2">
                                            <p class="p_icon">
                                                <strong><i class="bi bi-card-list"></i> Description : </strong><?php echo ucfirst(strtolower($value['description'])); ?>
                                            </p>
                                        </div>


                                    </div>
                                    <!-- <p class="p_icon">
                                            <?php //echo ucwords(strtolower($value['name'])); 
                                            ?><br>
                                            <strong><i class="bi bi-cash"></i> Price:</strong> $<?php //echo number_format($value['price'], 2); 
                                                                                                ?> USD<br>
                                            <strong><i class="bi bi-bag-plus-fill"></i> Count:</strong> <?php //echo $value['count']; 
                                                                                                        ?><br>
                                            <strong><i class="bi bi-eye"></i> Visibility:</strong> <?php //echo $value['hidden'] == 'Y' ? 'Hidden' : 'Visible'; 
                                                                                                    ?><br>
                                            <strong><i class="bi bi-card-list"></i> Description:</strong><br><?php //echo ucfirst(strtolower($value['description'])); 
                                                                                                                ?>
                                        </p> -->
                                </div>
                                <div class="col-sm-2 text-end">

                                    <div class="dropdown">
                                        <button class="btn add_btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-gear"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li><a class="globalModalssbid dropdown-item" href="<?php echo SITE_URL; ?>event/editaddon/<?php echo $value['id']; ?>" title="Edit Addon"> Edit</a> </li>

                                            <li><a class="dropdown-item" href="<?php echo SITE_URL . 'event/toggle/hideaddon/' . $value['id']; ?>"><?php if ($value['hidden'] == 'Y') {
                                                                                                                                                        echo 'Show';
                                                                                                                                                    } else {
                                                                                                                                                        echo 'Hide';
                                                                                                                                                    } ?></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    } else { ?>

                        <center>
                            <p><i>You don`t have any addons created.</i></p>
                        </center>

                    <?php } ?>

                    <div class="next_prew_btn d-flex justify-content-between">

                        <a class="prew" href="<?php echo SITE_URL; ?>event/settings/<?php echo $id; ?>">Previous</a>
                        <a class="next" href="<?php echo SITE_URL; ?>event/committee/<?php echo $id; ?>">Next</a>
                    </div>

                </div>
            </div>

        </div>
        <!-- </div> -->
    </div>
</section>

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
                <h5 class="modal-title">Edit Addon</h5>
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