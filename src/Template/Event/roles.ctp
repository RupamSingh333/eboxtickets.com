<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

<section id="Dashboard_section">
    <div class="d-flex">
        <?php echo $this->element('organizerdashboard'); ?>

        <!-- <div class="col-sm-9"> -->
        <div class="dsa_contant">
            <?php echo $this->element('allevent'); ?>
            <h4>User Manager</h4>
            <hr>
            <p>You can add users to manage your events here.</p>

            <ul class="tabes d-flex">
                <li><a class="<?php if ($this->request->params['action'] == "usersmanager") {
                                    echo "active";
                                } else {
                                    echo "";
                                } ?>" href="<?php echo SITE_URL; ?>event/usersmanager/<?php echo $id; ?>">Manage</a></li>
                <li><a class="<?php if ($this->request->params['action'] == "roles") {
                                    echo "active";
                                } else {
                                    echo "";
                                } ?>" href="<?php echo SITE_URL; ?>event/roles/<?php echo $id; ?>">Roles</a></li>
            </ul>

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

                                                    <th scope="col">Name</th>
                                                    <th scope="col">Options</th>

                                                </tr>
                                            </thead>
                                            <tbody class="tbody_bg">
                                                <?php if (!empty($orders)) { ?>

                                                    <?php foreach ($orders as $key => $value) {  ?>
                                                        <tr>
                                                            <td>
                                                                <h6><?php echo $value['order']['user']['name']; ?></h6>

                                                                <p class="order">Order : <span><a href="<?php echo SITE_URL; ?>event/paymentdetail/<?php echo $id; ?>/<?php echo $value['order_id']; ?>"><?php echo $value['order_id']; ?></a></span> </p>
                                                                <!-- <p>Responsible : <span>Marvin Marcelle</span> </p>
                                                        <p>Approved by : <span>Marvin Marcelle</span></p> -->
                                                            </td>
                                                            <td>
                                                                <?php $ticket_count = $this->Comman->ticketcount_event($value['order_id'], $id);
                                                                // pr($ticket_count);  die;
                                                                ?>
                                                                <p class="t_data"><?php echo $ticket_count[0]['ticketsold']; ?></p>
                                                            </td>

                                                            <td>
                                                                <p class="t_data"><?php echo $event['currency']['Currency']; ?><?php echo $event['currency']['Currency_symbol']; ?> <?php echo $value['order']['total_amount']; ?></p>
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
                                                        <td colspan="4" style="text-align:center"><b>No Orders</b></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </section>

                </div>
            </div>


        </div>
        <!-- </div> -->
    </div>
</section>
<style>