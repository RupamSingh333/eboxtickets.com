<!-- <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.css" rel="stylesheet" type="text/css" /> -->
<!-- <script src="https://code.jquery.com/jquery-2.1.4.js"></script> -->
<!-- <script src="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.js"></script> -->
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css"> -->

<section id="Dashboard_section">
    <div class="d-flex">
        <?php echo $this->element('organizerdashboard'); ?>

        <div class="dsa_contant">
            <?php echo $this->element('allevent'); ?>

            <h4>Payments</h4>
            <hr>

            <?php echo $this->Flash->render(); ?>
            <div class="contant_bg2">
                <div class="event_payment">
                    <section id="my_ticket">
                        <div class="event-list-container" id="Mycity">
                            <div class="event_detales">

                                <div class="row">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead class="table-dark table_bg">
                                                <tr>

                                                    <th style="width: 40%;" scope="col">Name</th>
                                                    <th style="width: 10%;" scope="col">Tickets</th>
                                                    <th style="width: 20%;" scope="col">Total Amount</th>
                                                    <th style="width: 15%;" scope="col">Ticket Type</th>
                                                    <th style="width: 15%;" scope="col">Date</th>

                                                </tr>
                                            </thead>
                                            <tbody class="tbody_bg">
                                                <?php if (!empty($orders)) { ?>

                                                    <?php foreach ($orders as $key => $value) { //pr($value); 
                                                    ?>
                                                        <tr>
                                                            <td>
                                                                <h6><?php echo $value['order']['user']['name']; ?></h6>

                                                                <p class="order">Order : <span><a href="<?php echo SITE_URL; ?>event/paymentdetail/<?php echo $id; ?>/<?php echo $value['order_id']; ?>"><?php echo $value['order_id']; ?></a></span> </p>
                                                            </td>
                                                            <td>
                                                                <?php $ticket_count = $this->Comman->ticketcount_event($value['order_id'], $id);
                                                                // pr($ticket_count);  die;
                                                                ?>
                                                                <p class="t_data"><?php echo $ticket_count[0]['ticketsold']; ?></p>
                                                            </td>

                                                            <td>
                                                                <p class="t_data">
                                                                    <?php echo $event['currency']['Currency_symbol']; ?> <?php echo sprintf('%.2f', $value['order']['total_amount']); ?>
                                                                    <?php echo $event['currency']['Currency']; ?>
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <p class="t_data"><?php echo $value['order']['paymenttype']; ?></p>
                                                            </td>
                                                            <td>
                                                                <p class="t_data"><?php echo date('d M Y', strtotime($value['order']['created'])); ?></p>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>


                                                <?php } else { ?>
                                                    <tr>
                                                        <td colspan="5" style="text-align:center"><b>No Orders</b></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <?php echo $this->element('admin/pagination'); ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </section>

                </div>
            </div>

        </div>
    </div>
</section>