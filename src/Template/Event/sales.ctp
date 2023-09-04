<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

<section id="Dashboard_section">
    <div class="d-flex">
        <?php
        echo $this->element('organizerdashboard');
        ?>

        <!-- <div class="col-sm-9"> -->
        <div class="dsa_contant">
            <?php echo $this->element('allevent'); ?>
            <h4>Sales</h4>
            <hr>
            <?php echo $this->Flash->render(); ?>

            <div class="d-flex justify-content-between">

                <ul class="tabes d-flex">
                    <?php //pr($this->request->params); 
                    ?>
                    <li><a class="<?php if ($this->request->params['action'] == "analytics") {
                                        echo "active";
                                    } else {
                                        echo "";
                                    } ?>" href="<?php echo SITE_URL; ?>event/analytics/<?php echo $id; ?>">Dashboard</a></li>

                    <li><a class="<?php if ($this->request->params['action'] == "sales") {
                                        echo "active";
                                    } else {
                                        echo "";
                                    } ?>" href="<?php echo SITE_URL; ?>event/sales/<?php echo $id; ?>">Sales</a></li>

                    <li><a class="<?php if ($this->request->params['action'] == "saleaddons") {
                                        echo "active";
                                    } else {
                                        echo "";
                                    } ?>" href="<?php echo SITE_URL; ?>event/saleaddons/<?php echo $id; ?>">Addons</a></li>
                    <!--<li><a href="#">Packages</a></li> -->


                    <!-- <li><a href="<?php //echo SITE_URL . 'event/committee/' . $id; 
                                        ?>">Manage</a></li>
                    <li><a class="active" href="<?php //echo SITE_URL . 'event/committeetickets/' . $id; 
                                                ?>">Tickets</a></li>
                    <li><a href="<?php //echo SITE_URL . 'event/committeegroups/' . $id; 
                                    ?>">Groups</a></li> -->
                </ul>

                <a class="exportTicket_btn d-flex align-items-center" href="<?php echo SITE_URL; ?>event/exporttickets/<?php echo $id; ?>"><i class="bi bi-file-earmark-excel"></i><span>Export Ticket </span></a>



            </div>


            <div class="contant_bg">
                <div class="event_settings">


                    <div class="col-sm-12 mb-3">
                        <div class="card shadow">
                            <div class="card-body">
                                <h5 class="card-title">Sales by Ticket</h5>

                                <div class="table committee-table">
                                    <!--  -->
                                    <div class="table-responsive">
                                        <div class="scroll3">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Ticket Type</th>
                                                        <th>Price</th>
                                                        <th>Count</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if (!empty($ticket_types)) {
                                                        foreach ($ticket_types as $key => $value) { //pr($value); 
                                                            $ticketsalecount = $this->Comman->ticketsalecount($id, $value['id']);
                                                            // pr($ticketsalecount);

                                                            $salesbyticket += $value['price'];
                                                            $salesbyticketsold += $ticketsalecount['ticketsold'];
                                                            $totalsalesbyticket += $value['price'] * $ticketsalecount['ticketsold'];

                                                    ?>
                                                            <?php if ($ticketsalecount['ticketsold'] > 0) { ?>

                                                                <tr>
                                                                    <td><?php echo $value['title']; ?></td>
                                                                    <td><?php echo $event['currency']['Currency']; ?><?php echo $event['currency']['Currency_symbol']; ?> <?php echo sprintf('%.2f', $value['price']); ?> </td>
                                                                    <td><?php echo $ticketsalecount['ticketsold']; ?></td>
                                                                    <td><?php echo $event['currency']['Currency_symbol']; ?> <?php echo  sprintf('%.2f', $value['price'] * $ticketsalecount['ticketsold']); ?> </td>

                                                                </tr>
                                                        <?php }
                                                        } ?>
                                                <tfoot>

                                                    <tr>
                                                        <th>Total</th>
                                                        <th><?php //echo $event['currency']['Currency_symbol']; 
                                                            ?><?php //echo sprintf('%.2f',$salesbyticket); 
                                                                ?> <?php //echo $event['currency']['Currency']; 
                                                                            ?></th>
                                                        <th><?php echo $salesbyticketsold; ?></th>
                                                        <th><?php echo $event['currency']['Currency']; ?><?php echo $event['currency']['Currency_symbol']; ?> <?php echo number_format($totalsalesbyticket); ?> </th>

                                                    </tr>
                                                </tfoot>

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



                    <div class="col-sm-12 mb-3">
                        <div class="card shadow">
                            <div class="card-body">
                                <h5 class="card-title">Sales by Method</h5>

                                <div class="table committee-table">
                                    <!--  -->
                                    <div class="table-responsive">
                                        <div class="scroll3">
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

                                                    if (!empty($purchasedticket)) {
                                                        foreach ($purchasedticket as $purchasedticketkey => $purchasedticketvalue) {

                                                            $total_eventticketvalue += $purchasedticketvalue['eventdetail']['price'];
                                                            $total_ticektbuyvalue += $purchasedticketvalue['ticketbuy'];

                                                            $totalsale_collection += $purchasedticketvalue['eventdetail']['price'] * $purchasedticketvalue['ticketbuy'];
                                                    ?>
                                                            <tr>
                                                                <td><?php echo $purchasedticketvalue['eventdetail']['title']; ?></td>
                                                                <td><?php echo $event['currency']['Currency']; ?><?php echo $event['currency']['Currency_symbol']; ?> <?php echo sprintf('%.2f', $purchasedticketvalue['eventdetail']['price']); ?> </td>
                                                                <td><?php echo $purchasedticketvalue['order']['paymenttype']; ?> </td>
                                                                <td><?php echo $purchasedticketvalue['ticketbuy']; ?> </td>
                                                                <td><?php echo $event['currency']['Currency_symbol']; ?><?php echo  sprintf('%.2f', $purchasedticketvalue['eventdetail']['price'] * $purchasedticketvalue['ticketbuy']); ?></td>
                                                            </tr>
                                                        <?php } ?>
                                                <tfoot>
                                                    <tr>
                                                        <th>Total</th>
                                                        <th><?php //echo $event['currency']['Currency_symbol']; 
                                                            ?><?php //echo sprintf('%.2f',$total_eventticketvalue); 
                                                                ?> <?php //echo $event['currency']['Currency']; 
                                                                            ?></th>
                                                        <th></th>
                                                        <th><?php echo  $total_ticektbuyvalue; ?> </th>
                                                        <th> <?php echo $event['currency']['Currency']; ?><?php echo $event['currency']['Currency_symbol']; ?> <?php echo  number_format($totalsale_collection); ?></th>
                                                    </tr>
                                                </tfoot>
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




                    <div class="col-sm-12 mb-3">
                        <div class="card shadow">
                            <div class="card-body">
                                <h5 class="card-title">Online Payment Breakdown</h5>

                                <div class="table committee-table">
                                    <!--  -->
                                    <div class="table-responsive">
                                        <div class="scroll3">
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

                                                            $total_eventticketvalue += $onlineourchasedvalue['eventdetail']['price'];
                                                            $total_onlineticektbuyvalue += $onlineourchasedvalue['ticketbuy'];

                                                            $onlinetotalsale_collection += $onlineourchasedvalue['eventdetail']['price'] * $onlineourchasedvalue['ticketbuy'];
                                                    ?>
                                                            <tr>
                                                                <td><?php echo $onlineourchasedvalue['eventdetail']['title']; ?></td>
                                                                <td><?php echo $event['currency']['Currency']; ?><?php echo $event['currency']['Currency_symbol']; ?> <?php echo sprintf('%.2f', $onlineourchasedvalue['eventdetail']['price']); ?> </td>
                                                                <td><?php echo $onlineourchasedvalue['order']['paymenttype']; ?> </td>
                                                                <td><?php echo $onlineourchasedvalue['ticketbuy']; ?> </td>
                                                                <td><?php echo $event['currency']['Currency_symbol']; ?><?php echo  sprintf('%.2f', $onlineourchasedvalue['eventdetail']['price'] * $onlineourchasedvalue['ticketbuy']); ?></td>
                                                            </tr>
                                                        <?php } ?>
                                                <tfoot>
                                                    <tr>
                                                        <th>Total</th>
                                                        <th><?php //echo $event['currency']['Currency_symbol']; 
                                                            ?><?php //echo sprintf('%.2f',$total_eventticketvalue); 
                                                                ?> <?php //echo $event['currency']['Currency']; 
                                                                            ?></th>
                                                        <th></th>
                                                        <th><?php echo  $total_onlineticektbuyvalue; ?> </th>
                                                        <th> <?php echo $event['currency']['Currency']; ?><?php echo $event['currency']['Currency_symbol']; ?> <?php echo  number_format($onlinetotalsale_collection); ?></th>
                                                    </tr>
                                                </tfoot>
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


                    <?php /* ?>                             
                    <div class="col-sm-12 mb-3">
                        <div class="card shadow">
                            <div class="card-body">
                                <h5 class="card-title">Online Payment Breakdown</h5>

                                <div class="table committee-table">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Currency</th>
                                                <th>Total</th>
                                                <th>Processor</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php if ($onlinepurchasedticket['ticketsold'] > 0) {  ?>
                                                <tr>
                                                    <td><?php echo $event['currency']['Currency_symbol']; ?> <?php echo $event['currency']['Currency']; ?> </td>
                                                    <td><?php echo $event['currency']['Currency']; ?><?php echo $event['currency']['Currency_symbol']; ?> <?php echo sprintf('%.2f', $onlinepurchasedticket['ticketsold']); ?>  </td>
                                                    <td><?php echo "Online"; ?></td>
                                                </tr>
                                        </tbody>

                                    <?php } else { ?>
                                        <tr>
                                            <td colspan="3" style="text-align:center;"> No Online Payment </td>
                                        </tr>

                                    <?php  } ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                                    <?php */ ?>


                    <div class="col-sm-12 mb-3">
                        <div class="card shadow">
                            <div class="card-body">
                                <h5 class="card-title">Cash Sales Breakdown</h5>

                                <div class="table committee-table">
                                    <!--  -->
                                    <div class="table-responsive">
                                        <div class="scroll3">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Responsible</th>
                                                        <th>Ticket Type</th>
                                                        <th>Price</th>
                                                        <th>Count</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <?php if (!empty($cashpurchasedticket)) {  //pr($event); 
                                                ?>
                                                    <tbody>
                                                        <?php foreach ($cashpurchasedticket as $cashpurchasedticketkey => $cashpurchasedticketvalue) {
                                                            //pr($cashpurchasedticketvalue); 
                                                        ?>

                                                            <?php
                                                            $committee_user = $this->Comman->finduserusingid($cashpurchasedticketvalue['committee_user_id']);
                                                            //  pr($committee_user); die; 
                                                            $committee_user_price += $cashpurchasedticketvalue['eventdetail']['price'];
                                                            $total_ticket_buy += $cashpurchasedticketvalue['ticketbuy'];
                                                            $total_ticket_buy_all_cash += $cashpurchasedticketvalue['eventdetail']['price'] * $cashpurchasedticketvalue['ticketbuy'];
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $committee_user['name']; ?></td>
                                                                <td><?php echo $cashpurchasedticketvalue['eventdetail']['title']; ?></td>
                                                                <td><?php echo $event['currency']['Currency']; ?><?php echo $event['currency']['Currency_symbol']; ?> <?php echo sprintf('%.2f', $cashpurchasedticketvalue['eventdetail']['price']); ?> </td>
                                                                <td><?php echo $cashpurchasedticketvalue['ticketbuy']; ?></td>
                                                                <td><?php echo $event['currency']['Currency_symbol']; ?><?php echo sprintf('%.2f', $cashpurchasedticketvalue['eventdetail']['price'] * $cashpurchasedticketvalue['ticketbuy']); ?></td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Total</th>
                                                            <th></th>
                                                            <th></th>
                                                            <th><?php echo $total_ticket_buy; ?> </th>
                                                            <th><?php echo $event['currency']['Currency']; ?><?php echo $event['currency']['Currency_symbol']; ?> <?php echo number_format(sprintf('%.2f', $total_ticket_buy_all_cash)); ?></th>
                                                        </tr>
                                                    </tfoot>
                                                <?php } else { ?>
                                                    <tr>
                                                        <td colspan="5" style="text-align:center;"> No Cash </td>
                                                    </tr>

                                                <?php  } ?>

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