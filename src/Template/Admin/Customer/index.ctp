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
                    <li>Customer Manager</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<?php //echo $this->Paginator->limitControl([2 => 2, 3 => 3, 20 => 20, 25 => 25, 30 => 30]); 
?>

<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">

            <?php echo $this->Flash->render(); ?>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Customer Manager</strong>
                    </div>

                    <div class="card-body">

                        <table id="bootstrap-data-table" class="table table-striped table-bordered ">
                            <thead>
                                <tr>
                                    <th scope="col"><?= $this->Paginator->sort('S.no') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Name') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Email') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Mobile') ?></th>
                                    <th scope="col" class="actions"><?= __('Status') ?></th>
                                    <?php /* ?>    <th scope="col" class="actions"><?= __('Actions') ?></th> <?php */ ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($ticketcustomer as $customer) : ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= ucfirst($customer->name) ?></td>
                                        <td><?= $customer->email ?></td>
                                        <td><?= $customer->mobile ?></td>


                                        <td>

                                            <?php if ($customer->status == "Y") {  ?>

                                                <a href="<?php echo ADMIN_URL ?>customer/status/<?php echo $customer->id . '/Y'; ?>" style="color:green" title="Click to Inactive"><i class="fa fa-toggle-on" style="font-size: 20px !important; margin-left: 1px; color:green;" aria-hidden="true"></i></a>

                                            <?php  } else { ?>
                                                <a href="<?php echo ADMIN_URL ?>customer/status/<?php echo $customer->id . '/N'; ?>" title="Click to Active"><i class="fa fa-toggle-off" style="font-size: 20px !important; margin-left: 1px;" aria-hidden="true"></i></a>
                                            <?php } ?>

                                        </td>
                                        <!-- 
                <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?> 


                <?= $this->Html->link(__('Edit'), ['action' => 'add', $organiser->id,], array('class' => 'btn btn-success')) ?>

                <?= $this->Form->postLink(__(''), ['action' => 'delete', $customer->id], array('class' => 'fa fa-trash', 'style' => 'font-size:24px;color:red'), ['confirm' => __('Are you sure you want to delete # {0}?', $customer->id)]) ?>
                </td>
-->
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