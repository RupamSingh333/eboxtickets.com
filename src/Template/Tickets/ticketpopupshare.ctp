<?php  //echo pr($ticketshare['ticket_num']);//die;?>
<style>
  table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 77%;
    margin-left: 85px;
  }

  td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
  }

  .phone_no{
   padding-top:10px;
 }

</style>
<h4>Share Tickets</h4> 
<?php echo $this->Form->create($tick,array(
  'class'=>'form-horizontal',
  'controller'=>'tickets',
  'action'=>'ticketshare',
  'enctype' => 'multipart/form-data',
  'validate' )); ?>
  <div class="table-responsive">
    <table>
      <tr>
        <th>S.No</th>


        <th>Number Of Ticket</th>
        <th>QR Code</th>
        <th>Action</th>
        <th>Shared Ticket</th>
        <th>Generate Ticket</th>
      </tr>
      
      
      <?php 
      $i=1;
    foreach($tick as $iteam)   { //pr($iteam); 
      $sharedticket=$this->Comman->sharedticket($iteam['id']);
//pr($sharedticket);
      ?>
      
      <tr>
       
       <td style="text-align:center;"><?php  echo $i ?></td>

       <td style="text-align:center;"><?php echo $iteam['ticket_num']; ?></td>
       
       <td><img src="<?php echo SITE_URL;?>webroot/qrimages/temp/<?php echo $iteam['qrcode'];?>" height="85px" width="85px" style="display:block;"></td>
       

       
       <td>

         <input type="checkbox" name="ticket_num[]" placeholder="Enter number of tickets" autocomplete="off" maxlength="401" id="ticket-num" value="<?php  echo $iteam['id']  ?>"<?php if(in_array($iteam['id'], $checkedticket)){ ?> checked  <?php }?>  >
       </td>

       <td>

        <?php
        foreach($sharedticket as $iteams)   { 
         echo $iteams['share_mobile']."<br>"; } ?>
       </td>
       <td>
        <?php if(in_array($iteam['id'], $checkedticket)){ echo "Shared"; }else{ ?>
          <a target="_blank" href="<?php echo SITE_URL ?>tickets/persnlticketgen/<?php echo $iteam['id'];?>/">Generate Ticket</a>
        <?php } ?>
      </td> 
      
    </tr>
    <?php $i++;  } ?>
  </table>
</div>
<div class="phone_no"><?php
echo $this->Form->input('mobile', array('class' => 'longinput form-control input-medium','placeholder'=>'Mobile Number','type'=>'text','label'=>false,'onkeypress'=>'return isNumber(event);','autocomplete'=>'off','required','id'=>'phone','minlength'=>10,'maxlength'=>12)); ?></div>
<span id="phonemessage" style="color:red; display:none">This mobile number is not register Plz download app in this Mobile Number!</span>
<span id="phonemessage2" style="color:red; display:none">You are not authorized to share ticket on your own number !</span>
<input type="hidden" name="tid" value="<?php echo $iteam['tid'];?>">
<input type="hidden" name="user_id" value="<?php echo $iteam['user_id'];?>">




                 <!--  <div class="phone_no_submit"><button class="main_button">Submit</button></div>
                 </form>-->
                 
                 
                 <div class="phone_no_submit">
                  <?php if(isset($transports['id'])){
                    echo $this->Form->submit('Update', array('title' => 'Update','div'=>false,
                    'class'=>array('btn btn-primary btn-sm'))); }else{  ?>
                      <button type="submit" disabled class="main_button">Submit</button>
                    <?php  } ?>
                  </div>

                  

                  
                  <script>
                    $(document).ready(function() {
//alert("test");
$( "#phone" ).change(function() {
  var mobile = $('#phone').val(); 

  $.ajax({ 
    type: 'POST', 
    url: '<?php echo SITE_URL; ?>tickets/checksharemobile',
    data: {'mobile':mobile},
    success: function(data){
      
     if(data==0){
       $('#phonemessage').css('display','block');
       setTimeout(function(){  $('#phonemessage').css('display','none');  }, 3000);

       
       $('#phone').val('');  
     }else if(data==2){
       $('#phonemessage2').css('display','block');
       setTimeout(function(){  $('#phonemessage2').css('display','none');  }, 3000); 
       $('#phone').val('');  
     }
     else{
       
      $('#phonemessage').css('display','none'); 
      $('.main_button').removeAttr("disabled");
      
      
    }  
  },    
});  
});  

});



                    function isNumber(evt) {
                      evt = (evt) ? evt : window.event;
                      var charCode = (evt.which) ? evt.which : evt.keyCode;
                      if (charCode > 31 && (charCode < 46 || charCode > 57 || charCode == 47)) {
                       alert("Please Enter Only Numeric Characters!");
                       return false;
                     }
                     return true;

                   }
                 </script>
               </script>
