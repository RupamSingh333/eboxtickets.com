<?php
// pr($this->request->params);die;
if ($this->request->params['controller'] == "Homes" && $this->request->params['action'] == "index") { ?>
<?= $this->element('homeheader') ?>
<?php } else { ?>
<?php //$this->element('homeheader') ?>
<?=$this->element('allheader') ?>
<?php } ?>

<?php echo $this->fetch('content') ?>

<?php
if ($this->request->params['controller'] == "Homes" && $this->request->params['action'] == "index") { ?>

<?= $this->element('homefooter') ?>

<?php } else { ?>

<?= $this->element('footer'); ?>

<?php } ?>