<section id="dashboard_pg">
    <div class="container">

        <div class="dashboard_pg_btm">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between dash_menutog align-items-center">
                        <!--  -->
                        <nav class="navbar navbar-expand-lg navbar-light p-0">
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <div class="nav nav-pills" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-home-tab" href="#" role="tab" aria-controls="nav-home" aria-selected="true">Dashboard</a>
                                </div>
                            </div>
                        </nav>
                        <!--  -->
                        <ul class="list-inline dash_ulbtn">
                            <li class="list-inline-item ">

                                <a href="<?php echo SITE_URL; ?>homes/myevent"> <button type="submit" class="btn save">View Event</button></a>
                            </li>
                        </ul>
                        <!--  -->
                    </div>
                </div>

                <div class="form">
                    <h2><i class="far fa-calendar-plus"></i>Post Event</h2>
                    <div class="form_inner">
                        <!--  -->
                        <ul id="progressbar">
                            <li class="active">Event Info</li>
                            <li class="active">Manage Tickets & Addons</li>
                            <li>Questions</li>
                            <li>Committee</li>
                            <li>Settings</li>
                            <!-- <li>View Event</li> -->
                        </ul>
                        <!--  -->

                    </div>

                    <form method="post" enctype="multipart/form-data" accept-charset="utf-8" id="formsubmit" class="form-horizontal needs-validation">
                        <fieldset>
                            <h4>Manage Tickets</h4>

                            <section id="register">
                                <div class="register_contant">
                                    <!-- -------------------- -->

                                    <div class="property-fields__rows">
                                        <div id="property-fields__row-1" class="product_containesss property-fields__row property-fields__row-item">

                                            <?php
                                            if (!empty($_SESSION['ticketdetails']['title']) || $eventDetails['eventdetail']) {

                                                if ($_SESSION['ticketdetails']['title']) {

                                                    foreach ($_SESSION['ticketdetails']['title'] as $key => $value) { ?>

                                                        <div class="row product_containes <?php if ($key != 0) {
                                                                                                echo 'addmoreclass';
                                                                                            } ?>">
                                                            <div class="col-md-2  mb-3">
                                                                <label for="firstname">Name<strong style="color:red;">*</strong></label>

                                                                <?php echo $this->Form->input('title[]', array('class' => 'form-control price', 'type' => 'text', 'label' => false, 'placeholder' => 'Enter Ticket Type', 'required', 'maxlength' => '50', 'onkeypress' => 'return isCspecial()', 'autocomplete' => 'off', 'value' => $value)); ?>
                                                            </div>
                                                            <div class="col-md-2  mb-3">
                                                                <label for="lastname">Type<strong style="color:red;">*</strong></label>
                                                                <?php
                                                                $type = ['open_sales' => 'Open Sales', 'committee_sales' => 'Committee Sales'];
                                                                echo $this->Form->input(
                                                                    'type[]',
                                                                    ['empty' => 'Choose Company', 'options' => $type, 'default' => $_SESSION['ticketdetails']['type'][$key], 'required' => 'required', 'class' => 'form-select', 'label' => false]
                                                                ); ?>
                                                            </div>
                                                            <div class="col-md-2  mb-3">
                                                                <label for="firstname">Price<strong style="color:red;">*</strong></label>
                                                                <?php echo $this->Form->input('price[]', array('class' => 'form-control price', 'type' => 'text', 'label' => false, 'placeholder' => 'Enter Price', 'required', 'onkeypress' => 'return isPrice()', 'maxlength' => '8', 'autocomplete' => 'off', 'value' => $_SESSION['ticketdetails']['price'][$key])); ?>
                                                            </div>
                                                            <div class="col-md-2  mb-3" id="count">
                                                                <label for="firstname">Count<strong style="color:red;">*</strong></label>
                                                                <?php echo $this->Form->input('count[]', array('class' => 'form-control price', 'type' => 'text', 'label' => false, 'placeholder' => 'Enter Count', 'required', 'maxlength' => '5', 'onkeypress' => 'return isPrice()', 'autocomplete' => 'off', 'value' => $_SESSION['ticketdetails']['count'][$key])); ?>
                                                            </div>
                                                            <div class="col-md-3  mb-3">
                                                                <label for="lastname">Visibility<strong style="color:red;">*</strong></label>

                                                                <?php
                                                                $hidden = ['N' => 'Hidden', 'Y' => 'Visible'];
                                                                echo $this->Form->input(
                                                                    'hidden[]',
                                                                    ['empty' => 'Choose Company', 'options' => $hidden, 'required' => 'required', 'class' => 'form-select', 'default' => $_SESSION['ticketdetails']['hidden'][$key], 'label' => false]
                                                                ); ?>
                                                            </div>
                                                            <?php
                                                            if ($key == 0) { ?>
                                                                <div class="col-md-1 mb-3">
                                                                    <input type="button" id="btnAdd" value="+" />
                                                                </div>

                                                            <?php  } else { ?>

                                                                <div class="col-md-1">
                                                                    <a href="javascript:void(0);" type="button" class="remove">-</a>
                                                                </div>
                                                            <?php  } ?>


                                                        </div>

                                                    <?php }
                                                } elseif ($eventDetails['eventdetail']) {

                                                    foreach ($eventDetails['eventdetail'] as $key => $value) {

                                                    ?>
                                                        <div class="row product_containes <?php if ($key != 0) {
                                                                                                echo 'addmoreclass';
                                                                                            } ?>">
                                                            <div class="col-md-2  mb-3">
                                                                <label for="firstname">Name<strong style="color:red;">*</strong></label>

                                                                <?php echo $this->Form->input('title[]', array('class' => 'form-control price', 'type' => 'text', 'label' => false, 'placeholder' => 'Enter Ticket Type', 'required', 'maxlength' => '50', 'onkeypress' => 'return isCspecial()', 'autocomplete' => 'off', 'value' => $value['title'])); ?>
                                                            </div>
                                                            <div class="col-md-2  mb-3">
                                                                <label for="lastname">Type<strong style="color:red;">*</strong></label>
                                                                <?php
                                                                $type = ['open_sales' => 'Open Sales', 'committee_sales' => 'Committee Sales'];
                                                                echo $this->Form->input(
                                                                    'type[]',
                                                                    ['empty' => 'Choose Company', 'options' => $type, 'default' => $value['type'], 'required' => 'required', 'class' => 'form-select', 'label' => false]
                                                                ); ?>
                                                            </div>
                                                            <div class="col-md-2  mb-3">
                                                                <label for="firstname">Price<strong style="color:red;">*</strong></label>
                                                                <?php echo $this->Form->input('price[]', array('class' => 'form-control price', 'type' => 'text', 'label' => false, 'placeholder' => 'Enter Price', 'required', 'onkeypress' => 'return isPrice()', 'maxlength' => '8', 'autocomplete' => 'off', 'value' => $value['price'])); ?>
                                                            </div>
                                                            <div class="col-md-2  mb-3" id="count">
                                                                <label for="firstname">Count<strong style="color:red;">*</strong></label>
                                                                <?php echo $this->Form->input('count[]', array('class' => 'form-control price', 'type' => 'text', 'label' => false, 'placeholder' => 'Enter Count', 'required', 'maxlength' => '5', 'onkeypress' => 'return isPrice()', 'autocomplete' => 'off', 'value' => $value['count'])); ?>
                                                            </div>
                                                            <div class="col-md-3  mb-3">
                                                                <label for="lastname">Visibility<strong style="color:red;">*</strong></label>

                                                                <?php
                                                                $hidden = ['N' => 'Hidden', 'Y' => 'Visible'];
                                                                echo $this->Form->input(
                                                                    'hidden[]',
                                                                    ['empty' => 'Choose Company', 'options' => $hidden, 'required' => 'required', 'class' => 'form-select', 'default' => $value['hidden'], 'label' => false]
                                                                ); ?>
                                                            </div>
                                                            <?php
                                                            if ($key == 0) { ?>
                                                                <div class="col-md-1">
                                                                    <input type="button" id="btnAdd" value="+" />
                                                                </div>

                                                            <?php  } else { ?>

                                                                <div class="col-md-1">
                                                                    <a href="javascript:void(0);" type="button" class="remove">-</a>
                                                                </div>
                                                            <?php  } ?>
                                                            <!-- <div class="col-md-1">
                                                                <input type="button" id="btnAdd" value="+" />
                                                            </div> -->
                                                        </div>

                                                <?php  }
                                                }
                                            } else { ?>

                                                <div class="row product_containes align-items-end">
                                                    <div class="col-md-2  mb-3">
                                                        <label for="firstname">Name<strong style="color:red;">*</strong></label>

                                                        <?php echo $this->Form->input('title[]', array('class' => 'form-control price', 'type' => 'text', 'label' => false, 'placeholder' => 'Enter Ticket Type', 'required', 'maxlength' => '50', 'onkeypress' => 'return isCspecial()', 'autocomplete' => 'off', 'value' => $value['title'])); ?>
                                                    </div>
                                                    <div class="col-md-2  mb-3">
                                                        <label for="lastname">Type<strong style="color:red;">*</strong></label>
                                                        <?php
                                                        $type = ['open_sales' => 'Open Sales', 'committee_sales' => 'Committee Sales'];
                                                        echo $this->Form->input(
                                                            'type[]',
                                                            ['empty' => 'Choose Company', 'options' => $type, 'required' => 'required', 'class' => 'form-select', 'label' => false]
                                                        ); ?>
                                                    </div>
                                                    <div class="col-md-2  mb-3">
                                                        <label for="firstname">Price<strong style="color:red;">*</strong></label>
                                                        <?php echo $this->Form->input('price[]', array('class' => 'form-control price', 'type' => 'text', 'label' => false, 'placeholder' => 'Enter Price', 'required', 'onkeypress' => 'return isPrice()', 'maxlength' => '8', 'autocomplete' => 'off', 'value' => $value['price'])); ?>
                                                    </div>
                                                    <div class="col-md-2  mb-3" id="count">
                                                        <label for="firstname">Count<strong style="color:red;">*</strong></label>
                                                        <?php echo $this->Form->input('count[]', array('class' => 'form-control price', 'type' => 'text', 'label' => false, 'placeholder' => 'Enter Count', 'required', 'maxlength' => '5', 'onkeypress' => 'return isPrice()', 'autocomplete' => 'off', 'value' => $value['count'])); ?>
                                                    </div>
                                                    <div class="col-md-3  mb-3">
                                                        <label for="lastname">Visibility<strong style="color:red;">*</strong></label>

                                                        <?php
                                                        $hidden = ['N' => 'Hidden', 'Y' => 'Visible'];
                                                        echo $this->Form->input(
                                                            'hidden[]',
                                                            ['empty' => 'Choose Company', 'options' => $hidden, 'required' => 'required', 'class' => 'form-select', 'label' => false]
                                                        ); ?>
                                                    </div>
                                                    <div class="col-md-1 mb-3">
                                                        <input type="button" id="btnAdd" value="+" />
                                                    </div>
                                                </div>


                                            <?php  } ?>

                                        </div>


                                    </div>

                                    <!-- ------------------- -->
                                </div>
                            </section>


                            <hr>
                            <!--  -->
                            <h4>Addons</h4>
                            <div class="addone">
                                <div class="row addmoreaddons">
                                    <?php
                                    if (!empty($_SESSION['ticketdetails']['addon_name']) || $addons) {
                                        // for session 
                                        if ($_SESSION['ticketdetails']['addon_name']) {
                                            foreach ($_SESSION['ticketdetails']['addon_name'] as $key => $addonsSession) { ?>
                                                <div class="row <?php if ($key != 0) {
                                                                    echo 'removeaddon';
                                                                } ?> ">
                                                    <div class="col-md-4  mb-3">
                                                        <label for="firstname">Name</label>

                                                        <?php
                                                        $addon_name = $addonsSession;

                                                        echo $this->Form->input('addon_name[]', array('class' => 'form-control', 'type' => 'text', 'label' => false, 'placeholder' => 'Enter Name', 'maxlength' => '50', 'onkeypress' => 'return isCspecial()', 'autocomplete' => 'off', 'value' => ($addon_name) ? $addon_name : "")); ?>
                                                    </div>

                                                    <div class="col-md-2  mb-3">
                                                        <label for="firstname">Price</label>
                                                        <?php
                                                        $addon_price = $_SESSION['ticketdetails']['addon_price'][$key];

                                                        echo $this->Form->input('addon_price[]', array('class' => 'form-control price', 'type' => 'text', 'label' => false, 'placeholder' => 'Enter Price', 'onkeypress' => 'return isPrice()', 'maxlength' => '8', 'autocomplete' => 'off', 'value' => ($addon_price) ? $addon_price : "")); ?>
                                                    </div>

                                                    <div class="col-md-2  mb-3">
                                                        <label for="firstname">Count</label>

                                                        <?php

                                                        $addon_count =  $_SESSION['ticketdetails']['addon_count'][$key];


                                                        echo $this->Form->input('addon_count[]', array('class' => 'form-control', 'type' => 'text', 'label' => false, 'placeholder' => 'Enter Count', 'maxlength' => '5', 'onkeypress' => 'return isPrice()', 'autocomplete' => 'off', 'value' => ($addon_count) ? $addon_count : ""));  ?>
                                                    </div>

                                                    <div class="col-md-3  mb-3">
                                                        <label for="lastname">Visibility</label>
                                                        <?php
                                                        $hidden = ['N' => 'Hidden', 'Y' => 'Visible'];

                                                        $addon_hidden =  $_SESSION['ticketdetails']['addon_hidden'][$key];

                                                        echo $this->Form->input(
                                                            'addon_hidden[]',
                                                            ['empty' => 'Choose Company', 'options' => $hidden, 'default' => $addon_hidden, 'class' => 'form-select', 'label' => false]
                                                        ); ?>
                                                    </div>

                                                    <?php
                                                    if ($key == 0) { ?>
                                                        <div class="col-md-1 mb-3">
                                                            <input type="button" id="btnAddons" value="+" />
                                                        </div>

                                                    <?php  } else { ?>

                                                        <div class="col-md-1">
                                                            <a href="javascript:void(0);" type="button" class="removeaddons">-</a>
                                                        </div>
                                                    <?php  } ?>

                                                    <div class="col-md-12  mb-3">
                                                        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                                                        <?php
                                                        $addon_desc =  $_SESSION['ticketdetails']['addon_desc'][$key];

                                                        ?>
                                                        <textarea class="form-control" name="addon_desc[]" id="exampleFormControlTextarea1" rows="2" cols="60"><?php echo $addon_desc; ?></textarea>
                                                    </div>
                                                </div>
                                            <?php }
                                        } elseif (!empty($addons)) {

                                            foreach ($addons as $key => $addonsValue) { ?>
                                                <div class="col-md-4  mb-3">
                                                    <label for="firstname">Name</label>

                                                    <?php
                                                    echo $this->Form->input('addon_name[]', array('class' => 'form-control', 'type' => 'text', 'label' => false, 'placeholder' => 'Enter Name', 'maxlength' => '50', 'onkeypress' => 'return isCspecial()', 'autocomplete' => 'off', 'value' => ($addonsValue['name']) ? $addonsValue['name'] : "")); ?>
                                                </div>

                                                <div class="col-md-2  mb-3">
                                                    <label for="firstname">Price</label>

                                                    <?php
                                                    echo $this->Form->input('addon_price[]', array('class' => 'form-control price', 'type' => 'text', 'label' => false, 'placeholder' => 'Enter Price', 'onkeypress' => 'return isPrice()', 'maxlength' => '8', 'autocomplete' => 'off', 'value' => ($addonsValue['price']) ? $addonsValue['price'] : "")); ?>
                                                </div>

                                                <div class="col-md-2  mb-3">
                                                    <label for="firstname">Count</label>

                                                    <?php

                                                    echo $this->Form->input('addon_count[]', array('class' => 'form-control', 'type' => 'text', 'label' => false, 'placeholder' => 'Enter Count', 'maxlength' => '5', 'onkeypress' => 'return isPrice()', 'autocomplete' => 'off', 'value' => ($addonsValue['count']) ? $addonsValue['count'] : ""));  ?>
                                                </div>

                                                <div class="col-md-3  mb-3">
                                                    <label for="lastname">Visibility</label>
                                                    <?php
                                                    $hidden = ['N' => 'Hidden', 'Y' => 'Visible'];

                                                    echo $this->Form->input(
                                                        'addon_hidden[]',
                                                        ['empty' => 'Choose Company', 'options' => $hidden, 'default' => $addonsValue['hidden'], 'class' => 'form-select', 'label' => false]
                                                    ); ?>
                                                </div>

                                                <div class="col-md-1 mb-3">
                                                    <input type="button" id="btnAddons" value="+" />
                                                </div>

                                                <div class="col-md-12  mb-3">
                                                    <label for="exampleFormControlTextarea1" class="form-label">Description</label>

                                                    <textarea class="form-control" name="addon_desc[]" id="exampleFormControlTextarea1" rows="2" cols="60"><?php echo $addonsValue['description']; ?></textarea>
                                                </div>

                                        <?php  }
                                        }
                                    } else { ?>
                                        <div class="col-md-4  mb-3">
                                            <label for="firstname">Name</label>

                                            <?php
                                            echo $this->Form->input('addon_name[]', array('class' => 'form-control', 'type' => 'text', 'label' => false, 'placeholder' => 'Enter Name', 'maxlength' => '50', 'onkeypress' => 'return isCspecial()', 'autocomplete' => 'off', 'value' => ($addon_name) ? $addon_name : "")); ?>
                                        </div>

                                        <div class="col-md-2  mb-3">
                                            <label for="firstname">Price</label>
                                            <?php
                                            echo $this->Form->input('addon_price[]', array('class' => 'form-control price', 'type' => 'text', 'label' => false, 'placeholder' => 'Enter Price', 'onkeypress' => 'return isPrice()', 'maxlength' => '8', 'autocomplete' => 'off', 'value' => ($addon_price) ? $addon_price : "")); ?>
                                        </div>

                                        <div class="col-md-2  mb-3">
                                            <label for="firstname">Count</label>

                                            <?php
                                            echo $this->Form->input('addon_count[]', array('class' => 'form-control', 'type' => 'text', 'label' => false, 'placeholder' => 'Enter Count', 'maxlength' => '5', 'onkeypress' => 'return isPrice()', 'autocomplete' => 'off', 'value' => ($addon_count) ? $addon_count : ""));  ?>
                                        </div>

                                        <div class="col-md-3  mb-3">
                                            <label for="lastname">Visibility</label>
                                            <?php
                                            $hidden = ['N' => 'Hidden', 'Y' => 'Visible'];
                                            echo $this->Form->input(
                                                'addon_hidden[]',
                                                ['empty' => 'Choose Company', 'options' => $hidden, 'default' => $addon_hidden, 'class' => 'form-select', 'label' => false]
                                            ); ?>
                                        </div>

                                        <div class="col-md-1 mb-3">
                                            <input type="button" id="btnAddons" value="+" />
                                        </div>

                                        <div class="col-md-12  mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                                            <textarea class="form-control" name="addon_desc[]" id="exampleFormControlTextarea1" rows="2" cols="60"><?php echo $addon_desc; ?></textarea>
                                        </div>


                                    <?php  } ?>

                                </div>
                                </hr>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a class="close " href="<?php echo SITE_URL; ?>homes/postevent<?php echo isset($getId) ? '/' . $getId : '' ?>">Previous</a>
                                <a href="#"><button type="submit" class="btn save">Proceed</button></a>
                            </div>
                            <!--  -->
                        </fieldset>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
</section>

<script>
    function isCspecial(e) {
        var e = e || window.event;
        var k = e.which || e.keyCode;
        var s = String.fromCharCode(k);
        if (/^[\\\"\'\;\:\>\<\[\]\-\.\,\/\?\=\+\_\|~`!@#\$%^&*\(\)0-9]$/i.test(s)) {
            alert("Special characters not acceptable");
            return false;
        }
    }

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

<script>
    $(document).ready(function() {

        // add tickets 
        $("#btnAdd").click(function() {

            $(".product_containesss").append(`

            <div class="row addmoreclass">
            <div class="col-md-2  mb-3">
                <label for="firstname">Name<strong style="color:red;">*</strong></label>
                <!-- <input type="text" class="form-control" name="title[]" required> -->
                <?php echo $this->Form->input('title[]', array('class' => 'form-control price', 'type' => 'text', 'label' => false, 'placeholder' => 'Enter Ticket Type', 'required', 'maxlength' => '50', 'onkeypress' => 'return isCspecial()', 'autocomplete' => 'off', 'value' => $value['title'])); ?>
            </div>
            <div class="col-md-2  mb-3">
                <label for="lastname">Type<strong style="color:red;">*</strong></label>
                <?php
                $type = ['open_sales' => 'Open Sales', 'committee_sales' => 'Committee Sales'];
                echo $this->Form->input(
                    'type[]',
                    ['empty' => 'Choose Company', 'options' => $type, 'required' => 'required', 'class' => 'form-select', 'label' => false]
                ); ?>
            </div>
            <div class="col-md-2  mb-3">
                <label for="firstname">Price<strong style="color:red;">*</strong></label>
                <?php echo $this->Form->input('price[]', array('class' => 'form-control price', 'type' => 'text', 'label' => false, 'placeholder' => 'Enter Price', 'required', 'onkeypress' => 'return isPrice()', 'maxlength' => '8', 'autocomplete' => 'off', 'value' => $value['price'])); ?>
            </div>
            <div class="col-md-2  mb-3" id="count">
                <label for="firstname">Count<strong style="color:red;">*</strong></label>
                <?php echo $this->Form->input('count[]', array('class' => 'form-control price', 'type' => 'text', 'label' => false, 'placeholder' => 'Enter Count', 'required', 'maxlength' => '5', 'onkeypress' => 'return isPrice()', 'autocomplete' => 'off', 'value' => $value['count'])); ?>
            </div>
            <div class="col-md-3  mb-3">
                <label for="lastname">Visibility<strong style="color:red;">*</strong></label>

                <?php
                $hidden = ['N' => 'Hidden', 'Y' => 'Visible'];
                echo $this->Form->input(
                    'hidden[]',
                    ['empty' => 'Choose Company', 'options' => $hidden, 'required' => 'required', 'class' => 'form-select', 'label' => false]
                ); ?>
            </div>
            <div class="col-md-1">
            <a href="javascript:void(0);" type="button" class="remove">-</a>
                </div>
            </div>
            </div>
            `);

        });

        $("body").on("click", ".remove", function() {
            $(this).closest('.addmoreclass').remove();
        });

        // add addons 
        $("#btnAddons").click(function() {

            $(".addone").append(`
            <div class="row removeaddon">
                <div class="col-md-4  mb-3">
                <label for="firstname">Name</label>

                <?php
                echo $this->Form->input('addon_name[]', array('class' => 'form-control', 'type' => 'text', 'label' => false, 'placeholder' => 'Enter Name', 'maxlength' => '50', 'onkeypress' => 'return isCspecial()', 'autocomplete' => 'off')); ?>
                </div>

                <div class="col-md-2  mb-3">
                <label for="firstname">Price</label>
                <?php

                echo $this->Form->input('addon_price[]', array('class' => 'form-control price', 'type' => 'text', 'label' => false, 'placeholder' => 'Enter Price', 'onkeypress' => 'return isPrice()', 'maxlength' => '8', 'autocomplete' => 'off')); ?>
                </div>

                <div class="col-md-2  mb-3">
                <label for="firstname">Count</label>

                <?php

                echo $this->Form->input('addon_count[]', array('class' => 'form-control', 'type' => 'text', 'label' => false, 'placeholder' => 'Enter Count', 'maxlength' => '5', 'onkeypress' => 'return isPrice()', 'autocomplete' => 'off'));  ?>
                </div>
            
                <div class="col-md-3  mb-3">
                <label for="lastname">Visibility</label>
                <?php
                $hidden = ['N' => 'Hidden', 'Y' => 'Visible'];

                echo $this->Form->input(
                    'addon_hidden[]',
                    ['empty' => 'Choose Company', 'options' => $hidden, 'class' => 'form-select', 'label' => false]
                ); ?>
                </div>

                <div class="col-md-1">
                <a href="javascript:void(0);" type="button" class="removeaddons">-</a>
                </div>

                <div class="col-md-12  mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Description</label>

                <textarea class="form-control" name="addon_desc[]" id="exampleFormControlTextarea1" rows="2" cols="60"></textarea>
                </div>
            </div>
            `);

        });

        $("body").on("click", ".removeaddons", function() {
            $(this).closest('.removeaddon').remove();
        });
    });
</script>