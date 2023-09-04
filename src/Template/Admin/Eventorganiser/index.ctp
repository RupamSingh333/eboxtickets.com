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
                    <li>Event Organiser Manager</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- <?php //echo $this->Paginator->limitControl([10 => 10, 15 => 15,20=>20,25=>25,30=>30]);
        ?> -->

<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">

            <?php echo $this->Flash->render(); ?>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Event Organiser Manager</strong>
                        <a href="<?php echo SITE_URL; ?>admin/eventorganiser/add"><strong class=" btn btn-info card-title pull-right">Add</strong></a>
                    </div>



                    <div class="card-body">

                        <table id="bootstrap-data-table" class="table table-striped table-bordered ">
                            <thead>
                                <tr>
                                    <th scope="col"><?= $this->Paginator->sort('S.no') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Name') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Email') ?></th>
                                    <th scope="col" class="actions"><?= $this->Paginator->sort('Mobile') ?></th>
                                    <th scope="col" class="actions"><?= __('Status') ?></th>
                                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($event_org as $organiser) : ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= ucfirst($organiser->name) ?></td>
                                        <td><?= $organiser->email ?></td>
                                        <td><?= $organiser->mobile ?></td>
                                        <td>
                                            <?php if ($organiser->status == "Y") {  ?>
                                                <a href="<?php echo ADMIN_URL ?>eventorganiser/status/<?php echo $organiser->id . '/N'; ?>" title="Click to Inactive"><i class="fa fa-toggle-on" style="font-size: 20px !important; margin-left: 1px; color:green;" aria-hidden="true"></i></a>
                                            <?php  } else { ?>

                                                <a href="<?php echo ADMIN_URL ?>eventorganiser/status/<?php echo $organiser->id . '/Y'; ?>" title="Click to Active"><i class="fa fa-toggle-off" style="font-size: 20px !important; margin-left: 1px;" aria-hidden="true"></i></a>
                                            <?php } ?>


                                        </td>

                                        <td class="actions">

                                            <?php echo $this->Html->link(__(''), ['action' => 'edit', $organiser->id], array('class' => 'fa fa-pencil-square-o fa-lg', 'title' => 'Edit', 'style' => 'font-size: 20px !important;margin-right:5px;')) ?>

                                    </tr>
                                <?php $i++;
                                endforeach;  ?>

                            </tbody>
                        </table>
                        <div class="paginator">
                            <ul class="pagination">
                                <?= $this->Paginator->first('<< ' . __('First')) ?>
                                <?= $this->Paginator->prev('< ' . __('Previous')) ?>
                                <?= $this->Paginator->numbers() ?>
                                <?= $this->Paginator->next(__('Next') . ' >') ?>
                                <?= $this->Paginator->last(__('Last') . ' >>') ?>
                            </ul>
                            <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>