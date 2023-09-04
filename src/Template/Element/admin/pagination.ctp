<div class="paginator col-sm-12">
  <ul class="pagination justify-content-center">
    <?= $this->Paginator->first('<< ' . __('First')) ?>
    <?= $this->Paginator->prev('< ' . __('Previous')) ?>
    <?= $this->Paginator->numbers() ?>
    <?= $this->Paginator->next(__('Next') . ' >') ?>
    <?= $this->Paginator->last(__('Last') . ' >>') ?>
  </ul>
  <div class="text-center" style="">
    <p class="paginate_p"><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
  </div>
</div>

<style type="text/css">
  .pagination {
    margin: 10px 0 2px;
  }

  p {
    margin: 10px 0 2px;
  }

  p.paginate_p {
    font-size: 14px;
    color: #5d5d5d;
    margin-bottom: 17px;
  }
</style>