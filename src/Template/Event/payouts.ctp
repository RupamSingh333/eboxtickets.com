<section id="Dashboard_section">
    <div class="d-flex">
        <?php
        echo $this->element('organizerdashboard');
        ?>

        <!-- <div class="col-sm-9"> -->
        <div class="dsa_contant">
            <?php echo $this->element('allevent'); ?>
            <h4>Payouts</h4>
            <hr>
            <?php echo $this->Flash->render(); ?>


            <div class="contant_bg">
                <div class="event_settings">
                    <div class="col-sm-12 mb-3">
                        <div class="card shadow">
                            <div class="table-responsive">
                                <div class="Payouts">
                                    <div class="card-body">
                                        <!-- <h5 class="card-title">Online Payment Breakdown</h5> -->

                                        <div class="table committee-table">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Ticket Type</th>
                                                        <th>Price</th>
                                                        <th>Payment Type</th>
                                                        <th>Count</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php

                                                    if (!empty($onlinepurchasedticket)) {
                                                        foreach ($onlinepurchasedticket as $onlineticketkey => $onlineourchasedvalue) {

                                                            $total_eventticketvalue +=     $onlineourchasedvalue['eventdetail']['price'];
                                                            $total_onlineticektbuyvalue += $onlineourchasedvalue['ticketbuy'];

                                                            $onlinetotalsale_collection += $onlineourchasedvalue['eventdetail']['price'] * $onlineourchasedvalue['ticketbuy'];
                                                    ?>
                                                            <tr>
                                                                <td><?php echo $onlineourchasedvalue['eventdetail']['title']; ?>
                                                            </td>
                                                                <td>
                                                                    <?php echo $event['currency']['Currency_symbol']; ?>
                                                                    <?php echo sprintf('%.2f', $onlineourchasedvalue['eventdetail']['price']); ?> 
                                                                    <?php echo $event['currency']['Currency']; ?>
                                                               </td>
                                                                <td>
                                                                    <?php echo $onlineourchasedvalue['order']['paymenttype']; ?> 
                                                                </td>
                                                                <td>
                                                                    <?php echo $onlineourchasedvalue['ticketbuy']; ?> 
                                                                </td>
                                                                <td>
                                                                    <?php echo $event['currency']['Currency_symbol']; ?><?php echo  sprintf('%.2f', $onlineourchasedvalue['eventdetail']['price'] * $onlineourchasedvalue['ticketbuy']); ?>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                        <thead>
                                                            <tr>
                                                                <th>Total</th>
                                                                <th></th>
                                                                <th></th>
                                                                <th>
                                                                    <?php echo  $total_onlineticektbuyvalue; ?>
                                                                </th>
                                                                <th> 
                                                                    <?php echo $event['currency']['Currency_symbol']; ?> <?php echo number_format($onlinetotalsale_collection); ?>
                                                                    <?php echo $event['currency']['Currency']; ?>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                    <?php } else { ?>

                                                        <tr>
                                                            <td colspan="5" style="text-align:center;"> No Sales</td>
                                                        </tr>
                                                    <?php }  ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

        </div>
        <!-- </div> -->
    </div>
</section>