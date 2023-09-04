<script src="https://code.jquery.com/jquery-2.1.4.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

<section id="Dashboard_section">
    <div class="d-flex">
        <!-- <div class="row g-0"> -->
        <?php echo $this->element('organizerdashboard'); ?>

        <!-- <div class="col-sm-9"> -->
        <div class="dsa_contant">
            <h4>Event Office</h4>
            <hr>
            <!-- <p>You can manage all your event Event Office here.</p> -->
            <?php echo $this->Flash->render(); ?>
            <ul class="tabes d-flex">
                <li><a class="active" href="#">Order Summary</a></li>
            </ul>

            <div class="contant_bg">
                <table class="table table-stripped">
                    <thead>
                        <tr>
                            <th>Ticket Type</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($order_details as $key => $order_value) {
                            // pr($order_value);exit;
                        ?>
                            <tr>
                                <td><?php
                                    $price += sprintf('%.2f', $order_value['eventdetail']['price']);
                                    echo $order_value['eventdetail']['title']; ?></td>
                                <td>1</td>
                                <td><?php echo $order_value['event']['currency']['Currency_symbol'] . sprintf('%.2f', $order_value['eventdetail']['price']) . ' ' . $order_value['event']['currency']['Currency']; ?></td>
                            </tr>
                        <?php }
                        $totalamt = $price * $order_value['event']['currency']['conversion_rate'];
                        $count1 = $totalamt * $fees / 100;
                        $feescal = number_format($count1, 2);
                        ?>
                        <tr>
                            <td colspan="2"><strong>Total (including fees)</strong></td>
                            <td>
                                <span><?php echo '$' . sprintf('%.2f', $totalamt + $feescal); ?> TTD</span>

                                <?php echo '(' . $order_value['event']['currency']['Currency_symbol'] . sprintf('%.2f', $totalamt) ?> TTD + <?php echo '$' . $feescal ?> TTD)
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="contant_bg">
                <h5 class="card-title">Tickets</h5>
                <form method="POST" class="form1">
                    <?php
                    $x = 1;
                    $print = false;
                    foreach ($order_details as $id => $ticketname) {
                        //pr($ticketname);exit;
                        if ($ticketname['ticketdetail'][0]['name']) {
                            $print = true;
                        }
                    ?>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">#<?php echo $x++; ?> <?php echo $ticketname['eventdetail']['title']; ?></label>
                            <div class="col-sm-9 col-lg-3 col-md-6">
                                <input type="text" required name="name[]" value="<?php if ($ticketname['ticketdetail'][0]['id']) {
                                                                                        echo $ticketname['ticketdetail'][0]['name'];
                                                                                    } ?>" placeholder="Enter Your Name" class="form-control onair">
                                <input type="hidden" name="ticket_id[]" value="<?php echo $ticketname['ticketdetail'][0]['id']; ?>">
                            </div>
                        </div>
                    <?php } ?>
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-9">
                            <button style="background-color: #3d6db5; color: #fff !important; display: inline-block;    display: flex;  text-align: center;  margin-bottom: 5px; padding: 7px 5px; font-size: 12px;  width: 100px;  border-radius: 5px; display: inline-block;    border: none;">
                                Save
                            </button>
                            <?php if ($print) { ?>

                                <a href="https://eboxtickets.com/tickets/printalltickets/<?php echo $event_order; ?>" target="_blank" class="btn btn-primary" target="_blank" style="background-color: #e62d56;    color: #fff !important;display: inline-block;display: flex;text-align: center;    margin-bottom: 5px;padding: 7px 5px;font-size: 12px;width: 100px;border-radius: 5px;display: inline-block;    border: none;margin-top: 5px;">
                                    <i class="fas fa-print"></i> &nbsp;Print</a>
                            <?php } ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- </div> -->
        <!-- </div> -->
    </div>
</section>

<script>
    $(document).on('submit', 'form.form1', function() {
        var all = document.querySelectorAll(".onair");
        var supplied = 0;
        for (var i = 0; i < all.length; i++) {
            var input = all[i];
            if (input.value.length > 0) {
                supplied++;
            }
        }

        if (supplied < 1) {
            alert('The Name field is required.');
            return false;
        }

    });
</script>