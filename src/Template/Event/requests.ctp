<!-- <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.css" rel="stylesheet" type="text/css" /> -->
<script src="https://code.jquery.com/jquery-2.1.4.js"></script>
<!-- <script src="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.js"></script> -->


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

<section id="Dashboard_section">
    <div class="d-flex">
        <?php echo $this->element('organizerdashboard'); ?>

        <!-- <div class="col-sm-9"> -->
            <div class="dsa_contant">
                <h4>Manage Event Settings</h4>
                <hr>
                <p>You can manage all your event settings here.</p>

                <ul class="tabes d-flex">
                    <li><a class="active" href="#">Settings</a></li>
                    <li><a href="<?php echo SITE_URL; ?>event/manage/<?php echo $id;?>">Tickets</a></li>
                    <li><a href="#">Publish</a></li>
                </ul>
                <hr>

                <div class="contant_bg">
                    <div class="event_settings">
                        <?php echo $this->Flash->render(); ?>
                        <form method="post" enctype="multipart/form-data" accept-charset="utf-8" id="formsubmit" class="row g-3 needs-validation">
                            <!-- <div class="row g-3"> -->
                            <h6>Event Settings</h6>

                            <div class="col-md-6">
                                <label for="inputName" class="form-label">Event Name</label>
                                <?php
                                if ($eventDetails['name']) {
                                    $name = $eventDetails['name'];
                                }
                                ?>
                                <input type="text" class="form-control" name="name" placeholder="Event Name" required value="<?php echo isset($name) ? $name : '' ?>">
                            </div>

                            <div class="col-md-6">
                                <label for="inputName" class="form-label">Location</label>

                                <?php
                                if ($eventDetails['location']) {
                                    $location = $eventDetails['location'];
                                }
                                echo $this->Form->input('location', array('class' => 'form-control ', 'type' => 'text', 'placeholder' => 'Location', 'required', 'label' => false, 'value' => ($location) ? $location : "")); ?>
                            </div>

                            <div class="col-md-6">
                                <label for="inputState" class="form-label">Company</label>
                                <?php
                                if ($eventDetails['company_id']) {
                                    $company_id = $eventDetails['company_id'];
                                }
                                echo $this->Form->input(
                                    'company_id',
                                    ['empty' => 'Choose Company', 'options' => $company, 'default' => ($company_id) ? $company_id : "", 'required' => 'required', 'class' => 'form-select', 'label' => false]
                                ); ?>
                            </div>
                            <div class="col-md-6">
                                <label for="inputState" class="form-label">Country</label>
                                <?php
                                if ($eventDetails['country_id']) {
                                    $country_id = $eventDetails['country_id'];
                                }
                                echo $this->Form->input(
                                    'country_id',
                                    ['empty' => 'Choose Country', 'options' => $country, 'default' => ($country_id) ? $country_id : "", 'required' => 'required', 'class' => 'form-select', 'label' => false]
                                ); ?>
                            </div>

                            <div class="col-md-6">
                                <label for="inputName" class="form-label">URL Slug</label>
                                <?php
                                if ($eventDetails['slug']) {
                                    $slug = $eventDetails['slug'];
                                }
                                ?>
                                <input type="text" class="form-control slug" placeholder="Slug" name="slug" value="<?php echo isset($slug) ? $slug : '' ?>">
                            </div>

                            <div class="col-md-6">
                                <label for="inputName" class="form-label">Share URL</label>
                                <span class="slug-display form-control">https://staging.eboxtickets.com/event/<?php echo isset($slug) ? $slug : ''; ?></span>
                            </div>

                            <div class="col-md-6">
                                <label for="inputName" class="form-label">Event start</label>

                                <div class="ui calendar" id="example1">
                                    <div class="ui input left icon">
                                        <i class="calendar icon"></i>
                                        <?php
                                        if ($eventDetails['date_from']) {

                                            $date_from = date('d-m-Y h:i:sA', strtotime($eventDetails['date_from']));
                                        }
                                        ?>
                                        <input class="form-control" required type="text" name="date_from" placeholder="Date/Time" autocomplete="off" value="<?php echo isset($date_from) ? $date_from : '' ?>">
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <label for="inputName" class="form-label">Event End</label>
                                <div class="ui calendar" id="exampleE">
                                    <div class="ui input left icon">
                                        <i class="calendar icon"></i>
                                        <?php
                                        if ($eventDetails['date_to']) {
                                            $date_to = date('d-m-Y h:i:sA', strtotime($eventDetails['date_to']));
                                        }
                                        ?>
                                        <input class="form-control" required type="text" name="date_to" value="<?php echo isset($date_to) ? $date_to : '' ?>" placeholder="Date/Time" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12  mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Description<strong style="color:red;">*</strong></label>
                                <?php
                                if ($eventDetails['desp']) {
                                    $desp = $eventDetails['desp'];
                                }
                                ?>
                                <textarea class="form-control" required name="desp" id="exampleFormControlTextarea1" rows="3"><?php echo isset($desp) ? $desp : '' ?></textarea>
                            </div>

                            <hr>
                            <div class="col-12">
                                <button type="submit" class="btn save">Save</button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        <!-- </div> -->
    </div>
</section>
<script>
    $(document).ready(function() {

        var slugify = function(text) {
            return text.toString()
                .replace(/\s+/g, '-') // Replace spaces with -
                .replace(/[^\w\-]+/g, '') // Remove all non-word chars
                .replace(/\-\-+/g, '-') // Replace multiple - with single -
                .replace(/^-+/, '') // Trim - from start of text
                .replace(/-+$/, ''); // Trim - from end of text
        }

        $('.slug').on('keyup', function(e) {
            text = $(e.target).val();
            if (text) {
                $('.slug-display').empty().append('https://staging.eboxtickets.com/event/<strong>' + slugify(text) + '</strong>');
            } else {
                $('.slug-display').empty().append('https://staging.eboxtickets.com/event/' + '<strong>270402</strong>');
            }
        }).on('blur', function(e) {
            $(e.target).val(slugify(e.target.value));
        });
    });
</script>

<!-- Calendra 1  -->
<script>
    $('#example1').calendar();
    $('#example2').calendar({
        type: 'date'
    });
    $('#example3').calendar({
        type: 'time'
    });
    $('#rangestart').calendar({
        type: 'date',
        endCalendar: $('#rangeend')
    });
    $('#rangeend').calendar({
        type: 'date',
        startCalendar: $('#rangestart')
    });
    $('#example4').calendar({
        startMode: 'year'
    });
    $('#example5').calendar();
    $('#example6').calendar({
        ampm: false,
        type: 'time'
    });
    $('#example7').calendar({
        type: 'month'
    });
    $('#example8').calendar({
        type: 'year'
    });
    $('#example9').calendar();
    $('#example10').calendar({
        on: 'hover'
    });
    var today = new Date();
    $('#example11').calendar({
        minDate: new Date(today.getFullYear(), today.getMonth(), today.getDate() - 5),
        maxDate: new Date(today.getFullYear(), today.getMonth(), today.getDate() + 5)
    });
    $('#example12').calendar({
        monthFirst: false
    });
    $('#example13').calendar({
        monthFirst: false,
        formatter: {
            date: function(date, settings) {
                if (!date) return '';
                var day = date.getDate();
                var month = date.getMonth() + 1;
                var year = date.getFullYear();
                return day + '/' + month + '/' + year;
            }
        }
    });
    $('#example14').calendar({
        inline: true
    });
    $('#example15').calendar();
</script>

<!-- =============================== -->
<!-- Calendra 2  -->
<script>
    $('#exampleE').calendar();
    $('#example2').calendar({
        type: 'date'
    });
    $('#example3').calendar({
        type: 'time'
    });
    $('#rangestart').calendar({
        type: 'date',
        endCalendar: $('#rangeend')
    });
    $('#rangeend').calendar({
        type: 'date',
        startCalendar: $('#rangestart')
    });
    $('#example4').calendar({
        startMode: 'year'
    });
    $('#example5').calendar();
    $('#example6').calendar({
        ampm: false,
        type: 'time'
    });
    $('#example7').calendar({
        type: 'month'
    });
    $('#example8').calendar({
        type: 'year'
    });
    $('#example9').calendar();
    $('#example10').calendar({
        on: 'hover'
    });
    var today = new Date();
    $('#example11').calendar({
        minDate: new Date(today.getFullYear(), today.getMonth(), today.getDate() - 5),
        maxDate: new Date(today.getFullYear(), today.getMonth(), today.getDate() + 5)
    });
    $('#example12').calendar({
        monthFirst: false
    });
    $('#example13').calendar({
        monthFirst: false,
        formatter: {
            date: function(date, settings) {
                if (!date) return '';
                var day = date.getDate();
                var month = date.getMonth() + 1;
                var year = date.getFullYear();
                return day + '/' + month + '/' + year;
            }
        }
    });
    $('#example14').calendar({
        inline: true
    });
    $('#example15').calendar();
</script>