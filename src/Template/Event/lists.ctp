<!-- <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" /> -->
<!-- <link href="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.css" rel="stylesheet" type="text/css" /> -->
<!-- <script src="https://code.jquery.com/jquery-2.1.4.js"></script>
<script src="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.js"></script> -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

<section id="Dashboard_section">
    <div class="row g-0">
<?php echo $this->element('organizerdashboard'); ?>
        
        <!-- <div class="col-sm-9"> -->
            <div class="dsa_contant">
                <h4>Manage Event Settings</h4>
                <hr>
                <p>You can manage all your event settings here.</p>

                <ul class="tabes d-flex">
                    <li><a class="active" href="#">Settings</a></li>
                    <li><a href="#">Manage</a></li>
                    <li><a href="#">Addons</a></li>
                    <li><a href="#">Questions</a></li>
                </ul>
                <hr>

                <div class="contant_bg">
                    <div class="event_settings">
                        <form class="row g-3">
                            <h6>Event Settings</h6>
                            <!-- <p class="profile_subH">You can edit your profile below including updating your password.</p> -->
                            <div class="col-md-6">
                                <label for="inputName" class="form-label">Event Name</label>
                                <input type="text" class="form-control" id="inputEmail4" value="Beach Party">
                            </div>

                            <div class="col-md-6">
                                <label for="inputState" class="form-label">Company</label>
                                <select id="inputState" class="form-select">

                                    <option value="717">4Play Events</option>
                                    <option value="732" selected="selected">Island Events</option>
                                    <option value="743">DAAC</option>
                                    <option value="791">DAAC</option>
                                    <option value="805">SoftechIndia</option>

                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="inputState" class="form-label">Country</label>
                                <select id="inputState" class="form-select">
                                    <option value="">Choose Country</option>
                                    <option value="1">Afghanistan</option>
                                    <option value="2">Albania</option>
                                    <option value="3">Algeria</option>
                                    <option value="4">Andorra</option>
                                    <option value="5">Angola</option>
                                    <option value="6">Anguilla</option>
                                    <option value="7">Antigua and Barbuda</option>
                                    <option value="8">Argentina</option>
                                    <option value="9">Armenia</option>
                                    <option value="10">Aruba</option>
                                    <option value="11">Australia</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="inputName" class="form-label">Location</label>
                                <input type="text" class="form-control" id="inputEmail4" value="Baker Beach - San Francisco, CA">
                            </div>

                            <div class="col-md-6">
                                <label for="inputName" class="form-label">URL Slug</label>
                                <input type="text" class="form-control" id="inputEmail4" value="beach-sep">
                            </div>

                            <div class="col-md-6">
                                <label for="inputName" class="form-label">Share URL</label>
                                <input type="text" class="form-control" id="inputEmail4" value="https://islandetickets.com/event/beach-sep">
                            </div>

                            <div class="col-md-6">
                                <label for="inputName" class="form-label">Event start</label>
                              <input type="date" class="form-control" id="inputEmail4" value="beach-sep"> 
                                
                                <!-- <div class="ui calendar" id="example1">
                                    <div class="ui input left icon">
                                        <i class="calendar icon"></i>
                                        <input class="date_bg" type="text" placeholder="Date/Time">
                                    </div>
                                </div>  -->
                            </div>

                            <div class="col-md-6">
                                <label for="inputName" class="form-label">Event End</label>
                                <input type="date" class="form-control" id="inputEmail4" value="beach-sep">
                                <!-- <div class="ui calendar" id="example1 " class="form-control">
                                    <div class="ui input left icon">
                                        <i class="calendar icon"></i>
                                        <input class="date_bg" type="text" placeholder="Date/Time">
                                    </div>
                                </div> -->
                            </div>
                            <div class="col-md-12">
                                <label for="inputName" class="form-label">Description</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>

                            <div class="col-md-6">
                                <label for="inputName" class="form-label">Hide Home Page</label>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">(this hides the event from the home page)</label>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <label for="inputName" class="form-label">Hide Company Page</label>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">(this hides the event from the company page)</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="inputName" class="form-label">Payment Options</label>
                                <div class="d-flex">
                                    <div class="mb-3 form-check me-5">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">Online payments</label>
                                    </div>
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">Committee payments</label>
                                    </div>
                                </div>
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







<!-- <script>
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
</script> -->




<!-- =========================================== -->





<!-- =========================================== -->



<!-- ================================= -->

<!-- ================================= -->