<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="<?php echo SITE_URL; ?>admin/dashboard ">Dashboard</a></li>
                    <li>Event Manager</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">

            <?php echo $this->Flash->render(); ?>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Event Detail</strong>
                        <a href="<?php echo SITE_URL; ?>admin/event/index"><strong class=" btn btn-info card-title pull-right">Back</strong></a>
                    </div>
                    <div class="card-body">

                        <table id="bootstrap-data-table" class="table table-striped table-bordered ">
                            <thead>
                                <tr>
                                    <th scope="col">S.no</th>
                                    <th scope="col">Ticket Type</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Sold out</th>
                                    <th scope="col">Remaining Seats</th>
                                    <th scope="col">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = ($this->request->params['paging']['Event']['page'] - 1) * $this->request->params['paging']['Event']['perPage'];
                                if (isset($evntdetail) && !empty($evntdetail)) {
                                    $data = 0;
                                    $ticketsoldout = 0;
                                    $totalseat = 0;
                                    $ticketremaining =null;
                                    foreach ($evntdetail['eventdetail'] as $value) {
                                        // pr($evntdetail['currency']['']);die;
                                        $i++;

                                        if($value['type']=='open_sales'){
                                            $data = $this->Comman->totalseatbook($value['id']);
                                            $ticketsoldout = $data['ticketsold'];
                                            $totalseat = $value['count'];
                                            $ticketremaining = $totalseat - $ticketsoldout;
                                        }else{
                                            $data = $this->Comman->totalseatbook($value['id']);
                                            $ticketsoldout = $data['ticketsold'];
                                            $totalseat = 0;
                                            $ticketremaining =null;

                                        }

                                ?>

                                        <tr>
                                            <td><?php echo  $i; ?></td>
                                            <td><?php echo $value['title']; ?> - <Span><?php echo ($value['type'] == 'open_sales') ? 'Online' : 'Committee'; ?></Span></td>
                                            <td><?php echo  $totalseat; ?></td>
                                            <td><?php echo  $ticketsoldout; ?></td>
                                            <td><?php echo $ticketremaining; ?></td>
                                            <td><?php echo ($evntdetail['currency']['Currency_symbol']) ? $evntdetail['currency']['Currency_symbol'] : "$"; ?>
                                                <?php echo number_format($value['price'], 2); ?>
                                                <?php echo ($evntdetail['currency']['Currency']) ? $evntdetail['currency']['Currency'] : "USD"; ?> </td>
                                        </tr>
                                    <?php }
                                } else { ?>
                                    <tr>
                                        <td colspan="12">No Data Available</td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                        <?php echo $this->element('admin/pagination'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>