<!-- 
<link rel="stylesheet" href="https://ssl.uh.edu/css/uh-main.css?v=20141216" type="text/css"> -->
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
                            <li class="active">Questions</li>
                            <li>Committee</li>
                            <li>Settings</li>
                            <!-- <li>View Event</li> -->
                        </ul>
                        <!--  -->

                        <form method="post" enctype="multipart/form-data" accept-charset="utf-8" id="formsubmit" class="form-horizontal needs-validation">

                            <div style="display:none;">

                            </div>

                            <fieldset>
                                <h4>Create Question </h4>

                                <section id="register">
                                    <div class="register_contant">
                                        <!-- -------------------- -->
                                        <div class="addone">
                                            <!-- <form method="post"> -->
                                            <div class="row">
                                                <div class="col-md-3  mb-3">
                                                    <label for="lastname">Type</label>
                                                    <?php

                                                    if ($eventDetails) {
                                                        foreach ($eventDetails as $key => $value) {
                                                            if ($value['question']) {

                                                                $questiontype = $value['question']['type'];
                                                            }
                                                        }
                                                    } else if ($_SESSION['questions']) {
                                                        $questiontype = $_SESSION['questions']['type'][0];
                                                    }

                                                    $type = ['Select' => 'Select', 'Multiple' => 'Multiple', 'Text' => 'Text', 'Agree' => 'Agree'];

                                                    echo $this->Form->input(
                                                        'type[]',
                                                        ['empty' => 'Choose Type', 'options' => $type, 'class' => 'form-select', 'default' => ($questiontype) ? $questiontype : "", 'label' => false]
                                                    ); ?>
                                                </div>

                                                <div class="col-md-3  mb-3">
                                                    <?php
                                                    if ($eventDetails) {
                                                        foreach ($eventDetails as $key => $value) {
                                                            if ($value['question']) {

                                                                $question_name = $value['question']['name'];
                                                            }
                                                        }
                                                    } else if ($_SESSION['questions']) {
                                                        $question_name = $_SESSION['questions']['name'][0];
                                                    }
                                                    ?>

                                                    <label for="firstname">Question Name</label>
                                                    <input type="text" id="qname" class="form-control" placeholder="Question Name" value="<?php echo isset($question_name) ? $question_name : ""; ?>" name="name[]">
                                                </div>

                                                <div class="col-md-5 mb-3">
                                                    <label for="firstname">Question</label>
                                                    <?php
                                                    if ($eventDetails) {
                                                        foreach ($eventDetails as $key => $value) {
                                                            if ($value['question']) {
                                                                $question = $value['question']['question'];
                                                            }
                                                        }
                                                    } else if ($_SESSION['questions']) {
                                                        $question = $_SESSION['questions']['question'][0];
                                                    }
                                                    ?>
                                                    <input type="text" id="questions" class="form-control" placeholder="Question" name="question[]" value="<?php echo isset($question) ? $question : ""; ?>">
                                                </div>
                                                <div class="col-md-1 mb-3">
                                                    <input type="button" id="btnAdd" value="+" />
                                                </div>
                                                <label for="firstname">Link Your Questions with ticket type</label>

                                                <?php
                                                if ($eventDetails) {

                                                    foreach ($eventDetails as $key => $value) {
                                                        if ($value['question']) {
                                                            $checked = 'checked';
                                                        } else {
                                                            $checked = null;
                                                        }
                                                ?>

                                                        <div class="col-md-2 mb-3">
                                                            <div class="form-check">
                                                                <input class="form-check-input" <?php echo $checked; ?> type="checkbox" value="<?php echo $value['title']; ?>" id="flexCheckDefault" name="ticketquestion[]">
                                                                <label class="form-check-label" for="flexCheckDefault">
                                                                    <?php echo ucfirst($value['title']); ?>
                                                                </label>
                                                            </div>
                                                        </div>

                                                    <?php }
                                                } elseif ($_SESSION['ticketdetails']['title']) {
                                                    
                                                    $checked =0;
                                                    foreach ($_SESSION['ticketdetails']['title'] as $key => $value) {
                                                      
                                                        if ($value==$_SESSION['questions']['ticketquestion'][$key]) {
                                                            $checked = 'checked';
                                                        } else {
                                                            $checked = null;
                                                        }
                                                        
                                                        ?>

                                                        <div class="col-md-2 mb-3">
                                                            <div class="form-check">
                                                                <input class="form-check-input" <?php echo $checked;?> type="checkbox" value="<?php echo $value; ?>" id="flexCheckDefault" name="ticketquestion[]">
                                                                <label class="form-check-label" for="flexCheckDefault">
                                                                    <?php echo ucfirst($value); ?>
                                                                </label>
                                                            </div>
                                                        </div>

                                                <?php }
                                                }  ?>

                                                <h5 id="createquestion">Create Question Items </h5>
                                                <hr>

                                                <div class="col-md-6  mb-3" id="items">
                                                    <div id="itemmain">
                                                        <label for="firstname">item</label>
                                                        <?php
                                                        if ($eventDetails) {
                                                            foreach ($eventDetails as $key => $value) {
                                                                $itemss =  explode(",", $value['question']['items']); ?>
                                                                <div id="input-player-list">
                                                                    <input id="a-player1" class="itemss" value="<?php echo $itemss[$key]; ?>" placeholder="Item" type='text' name='items[]'><br>
                                                                </div>

                                                            <?php }
                                                        } elseif ($_SESSION['questions']) {

                                                            foreach ($_SESSION['questions']['items'] as $key => $value) { ?>
                                                                <div id="input-player-list">
                                                                    <input id="a-player1" class="itemss" value="<?php echo $value; ?>" placeholder="Item" type='text' name='items[]'><br>
                                                                </div>
                                                            <?php }
                                                        } else { ?>
                                                            <div id="input-player-list">
                                                                <input id="a-player1" class="itemss" placeholder="Item" type='text' name='items[]'><br>
                                                            </div>
                                                            <div id="input-player-list">
                                                                <input id="a-player1" class="itemss" placeholder="Item" type='text' name='items[]'><br>
                                                            </div>

                                                        <?php  }  ?>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-6  mb-3" id="items">
                                                    <div id="itemmain">
                                                        <label for="firstname">item</label>
                                                        <div id="input-player-list">
                                                            <input id="a-player1" class="itemss" placeholder="Item" type='text' name='items[]'><br>
                                                        </div>
                                                        <div id="input-player-list">
                                                            <input id="a-player1" class="itemss" placeholder="Item" type='text' name='items[]'><br>
                                                        </div>

                                                    </div>
                                                </div> -->


                                                <div class="col-md-6  mb-3" id="items2">
                                                    <div id="a-players">

                                                        <button class="save" type='button' id='addPlayer'>Add item</button>
                                                    </div>
                                                </div>

                                                <hr id="hr">

                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <a class="close " href="<?php echo SITE_URL; ?>homes/ticketdetails<?php echo isset($getId) ? '/' . $getId : '' ?>">Previous</a>
                                            <a href="#"><button type="submit" class="btn save">Proceed</button></a>
                                        </div>
                                </section>

                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<script>
    $(document).ready(function() {

        $('#type').on('change', function(e) {
            var type = e.target.value;

            if (type == 'Text') {
                $("#items").hide();
                $("#items2").hide();
                $("#hr").hide();
                $("#createquestion").hide();

            } else {
                $("#items").show();
                $("#items2").show();
                $("#hr").show();
                $("#createquestion").show();
            }
            if ((type == '')) {
                $("#qname").attr('required', false);
                $("#questions").attr('required', false);
                $(".itemss").attr('required', false);

            } else {
                $("#qname").attr('required', true);
                $("#questions").attr('required', true);
                $(".itemss").attr('required', true);
            }
        });

        // add more 

        $("#addPlayer").click(function() {
            $("#itemmain").append(`<div id="input-player-list" class="newest">
        <input id="a-player1" class="itemss" placeholder="Item" type='text' name='items[]'>
        <a href="javascript:void(0);" type="button" class="remove">-</a></div>`);
        });

        $("body").on("click", ".remove", function() {
            $(this).closest('.newest').remove();
        });

        $("#btnAdd").click(function() {
            $(".addone").append(`<div class="row newrow">
                <div class="col-md-3  mb-3">
                <label for="lastname">Type</label>
                <div class="input select"><select name="type[]" class="form-select" id="type"><option value="">Choose Type</option><option value="Select" selected="selected">Select</option><option value="Multiple">Multiple</option><option value="Text">Text</option><option value="Agree">Agree</option></select></div>                                                </div>

                <div class="col-md-3  mb-3">

                <label for="firstname">Question Name</label>
                <input type="text" id="qname" class="form-control" placeholder="Question Name" value="Notebook" name="name[]">
                </div>

                <div class="col-md-5 mb-3">
                <label for="firstname">Question</label>
                <input type="text" id="questions" class="form-control" placeholder="Question" name="question[]" value="are you sure to want to change the">
                </div>
                <div class="col-md-1 mb-3">
                <input type="button" id="removeques" value="-">
                </div>
                <label for="firstname">Link Your Questions with ticket type</label>


                <div class="col-md-2 mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="gold" id="flexCheckDefault" name="ticketquestion[]">
                        <label class="form-check-label" for="flexCheckDefault">
                            Gold                                                                </label>
                    </div>
                </div>


                <div class="col-md-2 mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="platinum" id="flexCheckDefault" name="ticketquestion[]">
                        <label class="form-check-label" for="flexCheckDefault">
                            Platinum                                                                </label>
                    </div>
                </div>


                <h5 id="createquestion">Create Question Items </h5>
                <hr>


                <div class="col-md-6  mb-3" id="items">
                <div id="itemmain">
                <label for="firstname">item</label>
                <div id="input-player-list">
                    <input id="a-player1" class="itemss" placeholder="Item" type="text" name="items[]"><br>
                </div>
                <div id="input-player-list">
                    <input id="a-player1" class="itemss" placeholder="Item" type="text" name="items[]"><br>
                </div>

                </div>
                </div>
                <div class="col-md-6  mb-3" id="items2">
                <div id="a-players">

                <button class="save" type="button" id="addPlayer">Add item</button>
                </div>
                </div>

                <hr id="hr"></div>`);
        });

        $("body").on("click", "#removeques", function() {
            $(this).closest('.newrow').remove();
        });
    });
</script>