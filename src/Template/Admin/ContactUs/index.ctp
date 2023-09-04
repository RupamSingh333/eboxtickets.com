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
          <li><a href="<?php echo SITE_URL; ?>admin/dashboard">Dashboard</a></li>
          <li>Contact Us Manager</li>
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
            <strong class="card-title">Contact Us Manager</strong>

          </div>

          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th style="width: 3%;">S.No.</th>
                  <th style="width: 10%;">Date</th>
                  <th style="width: 10%;">Name</th>
                  <th style="width: 10%;">Email</th>
                  <th>Subject</th>
                  <th style="width: 8%;">Event</th>
                  <th style="width:30%;">Description</th>
                </tr>
              </thead>
              <tbody>

                <?php
                $i = ($this->request->params['paging']['Coupancode']['page'] - 1) * $this->request->params['paging']['Coupancode']['perPage'];
                if (isset($contactusDetails) && !empty($contactusDetails)) {
                  foreach ($contactusDetails as $value) {
                    $i++;
                ?>
                    <tr>
                      <td><?php echo  $i; ?></td>
                      <td><?php echo date('d-M-Y', strtotime($value['created'])); ?></td>
                      <td><?php echo ucwords(strtolower($value['name'])); ?></td>
                      <td><?php echo $value['email']; ?></td>
                      <td><?php echo $value['subject']; ?></td>
                      <td><?php echo $value['event']; ?></td>
                      <td>
                        <a href="#" title="Click to View" data-toggle="modal" data-target="#contactModal_<?php echo $value['id']; ?>">
                          <?php echo substr($value['description'], 0, 200) . '...'; ?>
                        </a>
                      </td>
                    </tr>
                  <?php }
                } else { ?>
                  <tr>
                    <td colspan="7">No Data Available</td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
            <?php echo $this->element('admin/pagination'); ?>
          </div>

        </div>
        </section>
      </div>
      </body>
    </div>
  </div>
</div>
