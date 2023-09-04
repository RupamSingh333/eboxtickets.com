<!-- https://www.youtube.com/watch?v=OK_JCtrrv-c -->
<style type="text/css">
  .are{margin-top: -6px;}
  .bfh-timepicker-popover table{width:280px;margin:0}
  select.form-control:not([size]):not([multiple]) {
    height: calc(1.99rem + 2px) !important;
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
          <li><a href="<?php echo ADMIN_URL; ?>dashboard ">Dashboard</a></li>
          <li><a href="<?php echo ADMIN_URL; ?>eventorganiser/index ">Event Organiser Manager</a></li>
        </ol>
      </div>
    </div>
  </div>
</div>  
  <?php echo $this->Flash->render(); ?>
  <?php echo $this->Form->create($addevent,array(
   'class'=>'form-horizontal',
   'controller'=>'eventorganiser',
   'action'=>'edit',
   'enctype' => 'multipart/form-data',
   'validate' )); ?>

   <div class="col-lg-12">
    <div class="card">
      <div class="card-header"><strong> <?php if(isset($event['id'])){ echo '<small> Edit Event</small>'; }else{ echo 'Add Event Organiser';} ?></strong></div>
      <div class="card-body card-block">
        <div class="col-sm-6">
          <div class="form-group">
            <label>Event Organiser</label>
            <?php
            echo $this->Form->input('name', array('class' => 'form-control longinput  input-medium','type'=>'text','required','placeholder'=>'Event Organiser','label'=>false,'id'=>'sta','autocomplete'=>'off')); ?>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="form-group">
            <label>Event Organiser Email</label>
            <?php
            echo $this->Form->input('email', array('class' => 'longinput form-control input-medium','placeholder'=>'Organiser Email' ,'type'=>'email','label'=>false,'id'=>'emailuser','data-val'=>$addevent['id'],'required','autocomplete'=>'off')); ?>
          </div>
 <span id="nummessag2" style="font-size: 11px;color:red; display:none">Email is already exist !!</span>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label>Event Organiser Mobile</label>
            <?php
            echo $this->Form->input('mobile', array('class' => 'longinput form-control input-medium','placeholder'=>'Organiser Mobile Number' ,'type'=>'text','label'=>false,'required','id'=>'addnum0','data-val'=>$addevent['id'],'onkeypress'=>'return isNumber(event);','autocomplete'=>'off')); ?>
          </div>
 <span id="nummessag" style="font-size: 11px;color:red; display:none">Mobile Number is already exist !!</span>
        </div>



        <div class="col-sm-12">
          <div class="form-group">
            <div class="col-sm-1">
             <a href="<?php echo ADMIN_URL ?>eventorganiser/index" class="btn btn-primary " >Back</a>
           </div>
           <div class="col-sm-1">
            <?php if(isset($event['id'])){
              echo $this->Form->submit('Update', array('title' => 'Update','div'=>false,
              'class'=>array('btn btn-primary btn-sm'))); }else{  ?>
                <button type="submit" class="btn btn-success">Submit</button>
              <?php  } ?>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
  <?php echo $this->Form->end(); ?>


 <script>
  //Duplicate number validation add more...
$( document ).ready(function() {
     $( "#addnum0" ).keyup(function() { 
        var addnumber = $('#addnum0').val(); 
var ids=$(this).data('val');
    
        $.ajax({ 
          type: 'POST', 
          url: '<?php echo SITE_URL; ?>admin/eventorganiser/chek_number',
          data: {'addnumber':addnumber,'ids':ids},
          success: function(data){ 

       console.log(data);  
           if(data==0){
          $('#nummessag').css('display','none');   
       }
       else{
         
          $('#nummessag').css('display','block');   
          $('#addnum0').val('');  
       }  
          },    
      });   
  });
  });
 </script>

 <script>
  //Duplicate number validation add more...
$( document ).ready(function() {
     $( "#emailuser" ).keyup(function() { 
    
var addemail = $('#emailuser').val();
var ids=$(this).data('val');
 
        $.ajax({ 
          type: 'POST', 
          url: '<?php echo SITE_URL; ?>admin/eventorganiser/chek_email',
          data: {'addemail':addemail, 'ids':ids},
          success: function(data){ 

       console.log(data);  
           if(data==0){
          $('#nummessag2').css('display','none');   
       }
       else{
         
          $('#nummessag2').css('display','block');   
          $('#addemail').val('');  
       }  
          },    
      });   
  });
  });
 </script> 
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
</script>
