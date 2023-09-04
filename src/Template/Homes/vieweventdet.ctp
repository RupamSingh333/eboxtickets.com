<section id="dashboard_pg">
    <div class="container">
    <?php echo $this->Flash->render(); ?>
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

                                <a href="#"> <button type="submit" class="btn save">View Event</button></a>
                            </li>
                        </ul>
                        <!--  -->
                    </div>
                </div>
                <form method="post" enctype="multipart/form-data" accept-charset="utf-8" id="formsubmit" class="form-horizontal needs-validation">
                    <div class="form">
                        <h2><i class="far fa-calendar-plus"></i>Manage Event</h2>
                        <div class="form_inner">
                            <!--  -->
                            <ul id="progressbar">
                                <li class="active">Event Info</li>
                                <li class="active">Manage Tickets & Addons</li>
                                <li class="active">Questions</li>
                                <li class="active">Manage Settings</li>
                                <!-- <li class="active">View Event</li> -->
                            </ul>
                            <!--  -->

                        </div>

                        <fieldset>
                            <h4>General Settings</h4>
                            <div class="addone">
                                <div class="row">

                                    <div class="col-md-3  mb-3">
                                        <label for="lastname">Ticket Limit</label>
                                        <?php
                                        $limit = ['1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10'];
                                        echo $this->Form->input(
                                            'ticket_limite',
                                            ['empty' => 'Choose Limite', 'options' => $limit, 'required' => 'required', 'class' => 'form-select', 'label' => false]
                                        ); ?>
                                    </div>

                                    <div class="col-md-3  mb-3">
                                        <label for="lastname">Approval Expiry</label>
                                        <?php
                                        $approve = ['1' => '1', '2' => '2'];
                                        echo $this->Form->input(
                                            'approve_timer',
                                            ['empty' => 'Choose Days', 'options' => $approve, 'required' => 'required', 'class' => 'form-select', 'label' => false]
                                        ); ?>
                                    </div>

                                    <div class="col-md-3  mb-3">
                                        <label for="firstname">Sale start</label>
                                        <div class="ui calendar" id="example1">
                                            <div class="ui input left icon">
                                                <i class="calendar icon"></i>
                                                <input class="form-control" type="text" name="sale_start" placeholder="Date/Time">
                                                <?php //echo $this->Form->input('sale_start', array('class' => 'longinput form-control input-medium datetimepicker1', 'placeholder' => 'Date From', 'type' => 'text', 'required', 'label' => false, 'autocomplete' => 'off', 'value' => (!empty($addevent['sale_start'])) ? date('Y-m-d H:m', strtotime($addevent['sale_start'])) : '')); 
                                                ?>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="firstname">Sale End</label>

                                        <div class="ui calendar" id="examplesecond">
                                            <div class="ui input left icon">
                                                <i class="calendar icon"></i>
                                                <input class="form-control" type="text" name="sale_end" placeholder="Date/Time">
                                            </div>
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="d-flex justify-content-between">
                                        <a class="close " onclick="history.back()">Previous</a>
                                        <a><button type="submit" class="btn save">Proceed</button></a>
                                    </div>

                                </div>
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