<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="//cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>
<style>
  .modal-header .close {
    margin-top: -21px;
  }
</style>

<div class="breadcrumbs">
  <div class="col-sm-4">
    <div class="page-header float-left">


    </div>
  </div>
  <div class="col-sm-8">
    <div class="page-header float-right">
      <div class="page-title">
        <ol class="breadcrumb text-right">
          <li><a href="<?php echo SITE_URL; ?>admin/emailtemplate">Dashboard</a></li>
          <li>Email Templates Manager</li>
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
            <strong class="card-title">Email Templates Manager</strong>
            <a href="<?php echo SITE_URL; ?>admin/emailtemplate/add"><strong class=" btn btn-info card-title pull-right">Add</strong></a>
          </div>

          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th class="align-top" style="width: 3%;">S.No.</th>
                  <th class="align-top" style="width: 30%;">Title</th>
                  <th class="align-top" style="width: 30%;">Subject</th>
                  <th class="align-top" style="width: 20%;">From email</th>
                  <th class="align-top" style="width: 20%;">From Name</th>
                  <th class="align-top" style="width:8%;">Format</th>
                  <th class="align-top" style="width: 12%;"><?= __('Actions') ?></th>
                </tr>
              </thead>
              <tbody>

                <?php   //pr($this->request->params); die;
                $i = ($this->request->params['paging']['Coupancode']['page'] - 1) * $this->request->params['paging']['Coupancode']['perPage'];
                if (isset($emailtemplate) &&     !empty($emailtemplate)) {
                  foreach ($emailtemplate as $value) {
                    $i++; //pr($value); 
                ?>
                    <tr>
                      <td><?php echo  $i; ?></td>
                      <td><b><?php echo $value['title']; ?></b> <br><b>Added on:</b> <?php echo date('d-M-Y', strtotime($value['created'])); ?></td>
                      <td><?php echo $value['subject']; ?></td>
                      <td><?php echo $value['fromemail']; ?></td>
                      <td><?php echo $value['fromname']; ?></td>
                      <td>
                        <a href="<?php echo ADMIN_URL ?>emailtemplate/viewtemplate/<?php echo $value['id']; ?>" data-toggle="modal" class="documentcls badge badge-primary" title="View Email Template">View Template</a>
                      </td>

                      <td>

                        <?php echo $this->Html->link(__(''), ['action' => 'edit', $value->id], array('class' => 'fa fa-pencil-square-o fa-lg', 'title' => 'Edit', 'style' => 'font-size: 20px !important;margin-right:2px;')) ?>
                      </td>
                    </tr>
                  <?php }
                } else { ?>
                  <tr>
                    <td colspan="12">No Data Available</td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
            <?php //echo $this->element('admin/pagination'); 
            ?>
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
        </section>
      </div>
      </body>
    </div>
  </div>
</div>

<div class="modal fade" id="mymodel">
  <div class="modal-dialog" style="max-width: 500px !important;">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Email Template Format</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>

<script>
  $('.documentcls').click(function(e) {
    e.preventDefault();
    $('#mymodel').modal('show').find('.modal-body').load($(this).attr('href'));
  });
</script>