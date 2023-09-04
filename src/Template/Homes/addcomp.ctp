<?php echo $this->Form->create($event, array('class'=>'form-horizontal','id' => 'sevice_form', 'enctype' => 'multipart/form-data')); ?> 
 <div id="exampleevent" class="card-body">
  <table id="bootstrap-data-table" class="table table-striped table-bordered ">
    <thead>
      <tr >
        <th style="text-align: center !important;">Name</th>
        <th style="text-align: center !important;">Email Id</th>
        <th style="text-align: center !important;">Mobile Number</th>
      </tr>
    </thead>
    <tbody id="mypage">
      <tr>
        <td>
          <?php
            echo $this->Form->input('name', array('class' => 'longinput form-control input-medium','placeholder'=>'User name' ,'type'=>'text','label'=>false,'autocomplete'=>'off')); ?>
        </td>
        <td>
          <?php
            echo $this->Form->input('email', array('class' => 'longinput form-control input-medium','placeholder'=>'User Email' ,'type'=>'email','required'=>true, 'label'=>false,'autocomplete'=>'off')); ?>
        </td>
        <td>
          <?php
            echo $this->Form->input('mobile', array('class' => 'longinput form-control input-medium','placeholder'=>' Mobile Number' ,'type'=>'text','required'=>true, 'maxlength'=>'12', 'onkeypress'=>'return isNumber(event);', 'label'=>false,'autocomplete'=>'off')); ?>
        </td>
      
      </tr>
      <tr>
      <td colspan="3"><button type="submit" class="btn btn-success">Submit</button></td>
      </tr>
    </tbody>
  </table>

</div>

<?php echo $this->Form->end(); ?>

<script>
  function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 46 || charCode > 57 || charCode == 47)) {
     alert("Please Enter Only Numeric Characters!!!!");
     return false;
   }
   return true;

 }
/script>