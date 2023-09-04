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
                    <li>Static Manager</li>
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
                        <strong class="card-title">Static Manager</strong>
                        <a href="<?php echo SITE_URL; ?>admin/static/add"><strong class=" btn btn-info card-title pull-right">Add</strong></a>
                    </div>

                    <div class="card-body">

                        <table id="bootstrap-data-table" class="table table-striped table-bordered ">
                            <thead>
                                <tr>
                                    <th scope="col"><?= $this->Paginator->sort('S.no') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Title') ?></th>
                                    <th scope="col"><?= $this->Paginator->sort('Description') ?></th>
                                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($static as $value) : ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $value->title ?></td>
                                        <td><?= mb_strimwidth(strip_tags($value->descr), 0, 120, '...') ?></td>
                                        <!--<td><?= $value->amount ?></td>
                                            <?php if ($value->status == "Y") {  ?>

                                            <?= $this->Html->link(__('Active'), ['action' => 'status', $value->id, 'N'], array('class' => 'badge badge-success')) ?>
                                            <?php  } else { ?>
                                            <?= $this->Html->link(__('Inactive'), ['action' => 'status', $value->id, 'Y'], array('class' => 'badge badge-warning')) ?>
                                            <?php } ?>

                                            </td>-->

                                        <td class="actions">
                                            <!--<?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?> -->

                                            <?php echo $this->Html->link(__(''), ['action' => 'edit', $value->id], array('class' => 'fa fa-pencil-square-o fa-lg', 'title' => 'Edit', 'style' => 'font-size: 20px !important;margin-right:2px;')) ?>

                                            <?= $this->Form->postLink(
                                                __(''),
                                                ['action' => 'delete', $value->id],
                                                array('class' => 'fa fa-trash', 'style' => 'font-size:17px;color:red'),
                                                ['confirm' => __('Are you sure you want to delete # {0}?', $value->id)]
                                            ) ?>
                                        </td>
                                    </tr>
                                <?php $i++;
                                endforeach; ?>
                                                                    <!--<tr>
                                    <td class="actions">
                                    </td>
                                    </tr>-->
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