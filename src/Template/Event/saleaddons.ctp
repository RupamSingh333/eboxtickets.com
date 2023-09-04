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
            <div class="contant_bg">
                <div class="event_settings">


                    <div class="col-sm-12 mb-3">
                        <div class="card shadow">
                            <div class="card-body">
                                <h5 class="card-title">Sales by Addons</h5>

                                <div class="table committee-table">
                                    <div class="table-responsive">
                                        <div class="scroll3">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Addons Type</th>
                                                        <th>Price</th>
                                                        <th>Count</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if (!empty($addons_types)) {
                                                        foreach ($addons_types as $key => $value) { //pr($value); 
                                                            $addonesale = $this->Comman->addonsale($value['id']);
                                                            //pr($addonesale);
                                                            $total_price += $value['price'];
                                                            $total_count += count($addonesale);

                                                            $total_sale_all  += $value['price'] * count($addonesale);
                                                    ?>
                                                            <?php if (count($addonesale) > 0) { ?>
                                                                <tr>
                                                                    <td><?php echo $value['name']; ?></td>
                                                                    <td><?php echo $event['currency']['Currency']; ?><?php echo $event['currency']['Currency_symbol']; ?> <?php echo sprintf('%.2f', $value['price']); ?> </td>
                                                                    <td><?php echo count($addonesale); ?></td>
                                                                    <td><?php echo $event['currency']['Currency_symbol']; ?><?php echo sprintf('%.2f', $value['price'] * count($addonesale)); ?> </td>

                                                                </tr>
                                                        <?php }
                                                        } ?>
                                                        <thead>
                                                            <tr>
                                                                <th>Total</th>
                                                                <th><?php echo $event['currency']['Currency']; ?><?php echo $event['currency']['Currency_symbol']; ?> <?php echo sprintf('%.2f', $total_price); ?> </th>
                                                                <th><?php echo $total_count; ?></th>
                                                                <th><?php echo $event['currency']['Currency']; ?><?php echo $event['currency']['Currency_symbol']; ?> <?php echo sprintf('%.2f', $total_sale_all); ?> </th>
                                                            </tr>
                                                        </thead>

                                                    <?php } else { ?>
                                                        <tr>
                                                            <td colspan="4" style="text-align:center;"> No Addon sales </td>
                                                        </tr>
                                                    <?php } ?>
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