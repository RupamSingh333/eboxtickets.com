<script src="https://code.jquery.com/jquery-2.1.4.js"></script>
<!-- <script src="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.js"></script> -->


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

<section id="Dashboard_section">
    <div class="row g-0">
        <?php echo $this->element('organizerdashboard'); ?>

        <div class="col-sm-9">
            <div class="dsa_contant">
                <h4>Box Office</h4>
                <hr>
                <p>You can manage all your event Box Office here.</p>

                <ul class="tabes d-flex">
                    <li><a class="active" href="#">Cash Sale</a></li>
                    <li><a href="<?php echo SITE_URL; ?>event/manage/<?php echo $id; ?>">Search Approved</a></li>
                </ul>

                <div class="contant_bg">
                    <div class="event_settings">
                        <?php echo $this->Flash->render(); ?>
                        <form method="post" enctype="multipart/form-data" accept-charset="utf-8" id="formsubmit" class="row g-3 needs-validation">

                                <label class="control-label ticket-push col-sm-5 col-lg-5">For other $0.00 USD</label>
                                <div class="controls col-sm-2 col-lg-1">
                                    <input type="hidden" name="price_id[]" value="8469">
                                    <select name="amount[]" class="form-control amount private price-holder price-8469">
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>

                                    </select>
                                </div>

                            <div class="col-12">
                                <button type="submit" class="btn save">Save</button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
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