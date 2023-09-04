





<?php $id=$event['id'];?>

<section id="event_detail_page"><!--event_detail_page-->
  <div class="container">
    <hgroup class="innerpageheading">
      <h2>Event Detail</h2>
      <ul>
        <li><a href="<?php echo SITE_URL; ?>/homes">Home</a></li>
        <li><i class="fas fa-angle-double-right"></i></li>
        <li>Event Detail</li>
      </ul>
    </hgroup>

    <div class="event_detail_box">
      <?php echo $this->Flash->render(); ?>
      <h3><?php echo $event['name']; ?></h3>
      <div class="row">
        <div class="col-sm-6">
          <div class="dtl_img">
            <img src="<?php echo SITE_URL;?>imagess/<?php echo $event['feat_image'];?>">
            <!--<img src="<?php  echo SITE_URL ?>images/Flash_ticket_event_detail_03.jpg">-->
          </div>
        </div>
        <div class="col-sm-6">
          <div class="event_dtl_cntnt">
            <ul class="text-left datetoform">
              <!--<li class="calendar_icon"><i class="far fa-calendar"></i></li>-->
              <li>
                <ul>
                  <li>From Date And Time</li>
                  <li><?php echo date('d M Y H:i A',strtotime($event['date_from'])); ?></li>
                </ul>
              </li>
              <li>
                <ul>
                  <li>To Date And Time</li>
                  <li><?php echo date('d M Y H:i A',strtotime($event['date_to'])); ?></li>
                </ul>
              </li>
            </ul>
            <p class="text-left">
              <span>DESCRIPTION</span>
              <?php echo $event['desp']; ?>
            </p>
<!--<ul class="text-left">
<li class="point_color">Host</li>
<li>-</li>
<li>Mike Reid </li>
</ul>-->
<ul class="text-left">
  <li class="point_color">Address</li>

  <li class="address"><?php echo $event['location'];?></li>
</ul>

<?php /* ?>
<ul class="text-left">
<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
<li><a href="#"><i class="fab fa-twitter"></i></a></li>
<li><a href="#"><i class="fab fa-instagram"></i></a></li>
</ul>
<?php */ ?>

<ul class="social_show">



<?php /* ?>
<a href="http://www.facebook.com/sharer.php?s=100&p[title]=<?php echo $value['event']['name']; ?>&p[url]=<?php echo SITE_URL; ?>/homes/eventdetail/<?php echo $value['id'];  ?>&p[summary]=<?php echo $value['event']['location'];?>&p[images][0]=http://www.ffff.com">ss</a>

<?php */ ?>

<li>
  <a class="fab fa-facebook-f bg-face fb-share-button" href="http://www.facebook.com/sharer.php?s=100&p[title]=<?php echo $event['name']; ?>&p[url]=<?php echo SITE_URL; ?>homes/eventdetail/<?php echo $event['id'];?>&p[summary]=<?php echo $event['location'];?>"style="
  background-color: #365899;border-radius: 25px;
  "></a></li>


  <li><a href="http://twitter.com/intent/tweet?text=<?php echo $value['desc'] ?>&amp;url=<?php echo SITE_URL ?>homes/eventdetail/<?php echo $event['id']  ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" class="fab fa-twitter bg-twt text-white"style="
  background-color: #1da1f2;border-radius: 25px;
  "></a></li>


  <li><a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo SITE_URL ?>homes/eventdetail/<?php echo $event['id']  ?>" target="_blank" title="Share to LinkedIn" class="fab fa-linkedin bg-link" style="
  background-color:  #0073b1;
  border-radius: 25px;
  "></a></li>



</ul>
</td>




<a href="#event_tkt_dtl" class="main_button">Buy Ticket</a>




</div>
</div>
</div>
</div>
<?php   if($event['video_url']){ ?>
  <div class="event_video_box">

    <div class="videolay">

      <a href="javascript:void(0)" class="ytp-large-play-button ytp-button" aria-label="Play"><i class="far fa-play-circle"></i></a>
      <img src="<?//php echo SITE_URL; ?>images/video-img.jpg" alt="video">
    </div>


    <?php   if(preg_match('/youtube/', $event['video_url'])){


      $url = '//www.youtube.com/embed/'.explode('=', $event['video_url'])[1];
      echo "<iframe width='100%' height='460' src='$url' frameborder='0' allow='autoplay; encrypted-media' allowfullscreen></iframe>";

    }?>
    <?php 
$video_id = explode("?v=", $event['video_url']); // For videos like http://www.youtube.com/watch?v=...
if (empty($video_id[1]))
$video_id = explode("/v/",$event['video_url']); // For videos like http://www.youtube.com/watch/v/..

$video_id = explode("&", $video_id[1]); // Deleting any other params
$video_id = $video_id[0];
$thumbURL = 'http://img.youtube.com/vi/'.$video_id.'/hqdefault.jpg';
//echo '<img src="'.$thumbURL.'" alt="video"/>';

?>
<div class="videolay">
  <a class="ytp-large-play-button ytp-button" aria-label="Play"><i class="far fa-play-circle"></i></a>
  <img src="<?php echo $thumbURL; ?>" alt="video" width="100%" height="480px">
</div>

</div>
<?php  } ?>
<?php $data=$this->Comman->totalseatbook($event['id']); 
$ticketsoldout=0;
$ticketsoldout=$data['0']['ticketsold'];
$totalseat=$event['no_of_seats'];
  //pr($totalseat);die;
//$ticketsoldout=0;
$ticketremaining=$totalseat-$ticketsoldout;
 //pr($ticketremaining);die;
?>


<?php if($ticketremaining == 0) {  ?>


  <div id="event_tkt_dtl" class="event_form_box">

    <img src="<?php echo SITE_URL; ?>imagess/sold-out_1.png">
  </div>



<?php } else{ ?>
  <div id="event_tkt_dtl" class="event_form_box">



    <div class="textfield">

      <h3 class="text-left">Select Your Tickets</h3>
      <ul class="text-left">
        <!--<li class="type">Type</li>-->
        <li class="price">Ticket Type</li>
        <li class="price">Price</li>
        <li class="quantuty">Quantity</li>
        <li class="total">Total</li>
      </ul>
      <ul class="text-left textfieldcontent">
        <!--<li class="type">Regular Ticket</li>-->

        <li class="price">
          <span>
          <input   type="radio" name="title" value="Small" checked=""> Small
          <input  type="radio" name="title" value="Medium"> Medium 
          <input  type="radio" name="title" value="Large"> Large</span></li>

<?php foreach ($event['eventdetail'] as $key => $value) { //pr($value); die;
?>
 <?php  if($value['title']=='Small') {?>
  <div id="showtext1">
        <li class="price" >KES <?php echo $value['price']; ?></li>

         <li class="quantuty"><select id="eventseat" class="paynowsub">
          <option value="0">-- Select--</option>
          <?php   for($m=1;$m<=$ticketremaining;$m++) { ?>
            <option value="<?php echo $m; ?>"><?php echo $m; ?></option>
          <?php  } ?>
        </select></li>
        <li class="total" id="eventtotal">KES</span></li>
      </div>
      <?php } ?>

       <?php  if($value['title']=='Medium') {?>
        <div id="showtext2">
        <li class="price">KES <?php echo $value['price']; ?></li>
        <li class="quantuty"><select id="eventseat" class="paynowsub">
          <option value="0">-- Select--</option>
          <?php   for($m=1;$m<=$ticketremaining;$m++) { ?>
            <option value="<?php echo $m; ?>"><?php echo $m; ?></option>
          <?php  } ?>
        </select></li>
        <li class="total" id="eventtotal">KES</span></li>
      </div>
      <?php } ?>

       <?php  if($value['title']=='Large') {?>
         <div id="showtext3">
        <li class="price">KES <?php echo $value['price']; ?></li>
        <li class="quantuty"><select id="eventseat" class="paynowsub">
          <option value="0">-- Select--</option>
          <?php   for($m=1;$m<=$ticketremaining;$m++) { ?>
            <option value="<?php echo $m; ?>"><?php echo $m; ?></option>
          <?php  } ?>
        </select></li>
        <li class="total" id="eventtotal">KES</span></li>
      </div>
      <?php } ?>
<?php  } ?>

</ul>

    </div>

    <?php if ($this->request->session()->read('Auth.User.id')){ ?>
     <?php echo $this->Form->create($userDatas,array(
       'class'=>'form-horizontal',
       'controller'=>'homes',
       'action'=>'bookticket',
       'enctype' => 'multipart/form-data','onsubmit'=>'return validate();'
     )); ?>
     <div class="textfield">

      <h3 class="text-left">Enter Your Details</h3>
      <ul class="text-left detailtital">
        <li class="type">Name</li>
        <li class="price">E-Mail</li>
        <li class="quantuty">Mobile Number</li>

        <ul class="text-left textfieldcontent textfieldinput ">

          <li class="type">
            <?php
            echo $this->Form->input('name', array('class' => 'longinput form-control input-medium namepaynowsub','placeholder'=>'Enter Your Name' ,'type'=>'text','label'=>false,'autocomplete'=>'off','id'=>'name','readonly','pattern'=>'.*[^ ].*')); ?>

          </li>
          <li class="price"> <?php
          echo $this->Form->input('email', array('class' => 'longinput form-control input-medium emailpaynowsub','placeholder'=>'Enter Your E-Mail' ,'type'=>'email','label'=>false,'id'=>'emailuser','autocomplete'=>'off','id'=>'myemail','required'=>true,'readonly')); ?>

          <!-- <span id="ntcs" style="color:red;display:none">Please enter valid email address ! </span>-->
        </li>
        <li class="total"> <?php
        echo $this->Form->input('mobile', array('class' => 'longinput form-control input-medium mobilepaynowsub','placeholder'=>'Enter Your Number' ,'type'=>'text','label'=>false,'autocomplete'=>'off','id'=>'mobile','maxlength'=>12,'minlength'=>'10','readonly')); ?>

      </li>
      <?php foreach ($event['eventdetail'] as $key => $value) { //pr($value); die;
?>
      <input type="hidden" name="eventtotalamt" id="eventamount" value="<?php echo $value['price']; ?>">
      <input type="hidden" id="eventtotalamt" name="totalamt">
      <input type="hidden" id="cseat" name="ticket_buy">
      <input type="hidden" id="event_id" name="event_id" value="<?php echo $value['id'];?>">
<?php  }?>
    </ul>


    <ul class="text-left">
      <!--<li class="type">Type</li>-->
      <li class="price"> <span id="Paragraph_name" style="color:red;display:none"></span></li>
      <li class="quantuty"><span id="Paragraph_email" style="color:red;display:none"></span></li>
      <li class="total"><span id="Paragraph_mobile" style="color:red;display:none"></span></li>
    </ul>
    <?php  $login=$this->request->session()->read('Auth.User.id'); 

    if($login==$event['event_org_id']) {  ?>

      <center><button id="customerdetailsubmit" type="submit" class="main_button">Pay Now</button></center>

    <?php }else{ ?>

      <center><button id="customerdetailsubmit" type="submit" class="main_button">Pay Now</button></center>
    <?php } ?>
  </div>
</form>
<?php } else{?>

  <div class="textfield">
    <h3 class="text-left">Enter Your Details</h3>
    <ul class="text-left detailtital">
      <li class="type">Name</li>
      <li class="price">E-Mail</li>
      <li class="quantuty">Mobile Number</li>
      <ul class="text-left textfieldcontent textfieldinput ">
        <?php echo $this->Form->create($userDatas,array(
         'class'=>'form-horizontal',
         'controller'=>'homes',
         'action'=>'bookticket',
         'enctype' => 'multipart/form-data','onsubmit'=>'return validate();'
       )); ?>
        <li class="type"><?php
        echo $this->Form->input('name', array('class' => 'longinput form-control input-medium namepaynowsub','placeholder'=>'Enter Your Name' ,'type'=>'text','label'=>false,'autocomplete'=>'off','id'=>'name','pattern'=>'.*[^ ].*')); ?>

      </li>
      <li class="price"> <?php
      echo $this->Form->input('email', array('class' => 'longinput form-control input-medium emailpaynowsub','placeholder'=>'Enter Your E-Mail' ,'type'=>'email','label'=>false,'id'=>'emailuser','autocomplete'=>'off','id'=>'myemail','required'=>true)); ?>

      <!-- <span id="ntcs" style="color:red;display:none">Please enter valid email address ! </span>-->
    </li>
    <li class="total">  <?php
    echo $this->Form->input('mobile', array('class' => 'longinput form-control input-medium mobilepaynowsub','placeholder'=>'Enter Your Number' ,'type'=>'text','label'=>false,'autocomplete'=>'off','id'=>'phone','maxlength'=>12,'minlength'=>'10','onkeypress'=>'return isNumber(event);',)); ?>

    <input type="hidden" name="eventtotalamt" id="eventamount" value="<?php echo $event['amount']; ?>">
    <input type="hidden" id="eventtotalamt" name="totalamt">
    <input type="hidden" id="cseat" name="ticket_buy">
    <input type="hidden" id="event_id" name="event_id" value="<?php echo $event['id'];?>">


  </li>

</ul>
<span id="phonemessage" style="color:red; display:none; text-align: right;">Mobile Number is already exist !</span>


<span id="emailar" style="color:red; display:none; text-align: center;">Email is already exist please login!</span> 
<ul class="text-left">
  <!--<li class="type">Type</li>-->
  <li class="price"> <span id="Paragraph_name" style="color:red;display:none"></span></li>
  <li class="quantuty"><span id="Paragraph_email" style="color:red;display:none"></span></li>
  <li class="total"><span id="Paragraph_mobile" style="color:red;display:none"></span></li>
</ul>
<?php  $login=$this->request->session()->read('Auth.User.id'); 

if($login==$event['event_org_id']) {  ?>

  <center><button type="submit" class="main_button" data-toggle="modal" data-target="#ticketpeventpurmyModal">Pay Nowss</button></center>

<?php }else{ ?>

  <center><button type="submit" class="main_button" data-toggle="modal" data-target="#myModal" id="customerdetailsubmit">Pay Now</button></center>
<?php } ?>
</form>
<?php } ?>

</div>




<?php } ?>


</div>
</div>

<span id="totalff"></span>
<div class="footer_buildings"></div>

<?php echo $this->Form->end(); ?>


</section><!--upcoming Event End-->


<script>
  $(document).ready(function(){
    $("#eventseat").click(function(){
      //$("#eventseat").prop("required", "true");
      var eventamt = document.getElementById("eventamount").value;
      var eventseat = $('#eventseat').find(":selected").val();
      document.getElementById('cseat').value = eventseat;
      var totalamt = eventamt*eventseat;
      document.getElementById('eventtotal').innerHTML = 'KES '+totalamt;
      document.getElementById('eventtotalamt').value = totalamt;
    });
  });
</script>
<script type="text/javascript">

        //function call on click pay now button for requred field
        function validate(){ //alert();

         var selectseat = $(".paynowsub").val();
         var namepay = $(".namepaynowsub").val();
         var emailpay = $(".emailpaynowsub").val();
         var mobilepay = $(".mobilepaynowsub").val();
      //alert(selectseat);
      if (selectseat == 0) {
        alert("Please select number of seats");
        $('.paynowsub').focus();
        return false;
      }else if(namepay=="") {
        //alert("Name Required");
        $("#Paragraph_name").text("Please enter your name").show();
        $('.namepaynowsub').focus();
        return false;
      } else if(emailpay=="") {
        //alert("Email Required");
        $("#Paragraph_email").text("Please enter your valid email address").show();
        $('.emailpaynowsub').focus();
        return false;
      } else if(mobilepay=="") {
        //alert("Mobile Required");
        $("#Paragraph_mobile").text("Please enter your mobile number").show();
        $('.mobilepaynowsub').focus();
        return false; 
      }
      else	
      {
        alert("You will be taken to MPESA shortly on your registered number. Look at the phone with the following " + mobilepay + " to enter the PIN" );
      }		  


    }

  </script>

  <script>
    $(document).ready(function() {
    //email validation
    $( "#myemail" ).change(function() {
      var txt = $('#myemail').val();
//alert(txt);
var testCases = [txt];
var test = testCases; 
if(isValidEmailAddress(test)!=true){
    //$('#ntcs').css('display','block');
    $("#Paragraph_email").text("Please enter your valid email address").show();
    $('.emailpaynowsub').focus();
    return false;
  }
  else{
  // $('#ntcs').css('display','none');       
  $("#Paragraph_email").text("Please enter your valid email address").hide();
  return true;  
}
});
//name validation
$( "#name" ).change(function() { 
  var name = $('#name').val(); 
    //alert(name);
    if(name==''){
     $("#Paragraph_name").text("Please enter your name").show();   
   }
   else{
    $("#Paragraph_name").text("Please enter your name").hide(); 
  }  
}); 
   //mobile validation       
   $( "#mobile" ).change(function() { 
    var name = $('#mobile').val(); 
    if(mobile==''){
     $("#Paragraph_mobile").text("Please enter your mobile number").show();  
   }
   else{
     $("#Paragraph_mobile").text("Please enter your mobile number").hide();
   }  
 });      
 });
</script>

<script>
  $(document).ready(function(){
    $(".event_video_box a").click(function(){
      $(".videolay").css("display", "none");
    });
  });
</script>

<script>
 function isValidEmailAddress(emailAddress) {
  var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
  return pattern.test(emailAddress);
};
</script>




<script type="text/javascript">





// validate Password
function validatePass(p1, p2) 
{

  if (p1.value != p2.value) {
    p2.setCustomValidity('Password incorrect');
  } else 
  {
    p2.setCustomValidity('');
  }
}





// duplicate email check functionality

$(document).ready(function() {
  //alert("test");
  $( "#myemail" ).keyup(function() {
    var txt = $('#myemail').val();
    $('#ntcs').css('display','none');  
    $.ajax({ 
      type: 'POST', 
      url: '<?php echo SITE_URL; ?>Logins/checkemail',
      data: {'email':txt},
      success: function(data){  
        if(data == 0){
          $('#emailar').css('display','none');   
        }
        else{
          $('#emailar').css('display','block');   
          $('#myemail').val('');  
        }  
      }    
    });   

  });

});  


// duplicate phone number validation

$( "#phone" ).keyup(function() { 
  var mobile = $('#phone').val(); 
  $.ajax({ 
    type: 'POST', 
    url: '<?php echo SITE_URL; ?>Logins/checkemail',
    data: {'mobile':mobile},
    success: function(data){  
     if(data==0){
      $('#phonemessage').css('display','none');   
    }
    else{

      $('#phonemessage').css('display','block');   
      $('#phone').val('');  
    }  
  },    
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

<script>
  $(document).ready(function(){
     //alert();
     $('#showtext2').css('display','none');
           $('#showtext3').css('display','none');
    $('input[name=title]').click(function(){
      var title=$('input[name=title]:checked').val();
      //alert(title);
      if(title=='Small'){
         $('#showtext1').css('display','block');
          $('#showtext2').css('display','none');
           $('#showtext3').css('display','none');

       }
        if(title=='Medium'){
         $('#showtext1').css('display','none');
          $('#showtext2').css('display','block');
           $('#showtext3').css('display','none');
       }
        if(title=='Large'){
         $('#showtext1').css('display','none');
          $('#showtext2').css('display','none');
           $('#showtext3').css('display','block');
       }
});
});
</script>


<script type="text/javascript">
/*
  $( "#mpesacheck" ).change(function() { //alert();  
    var txte = $('#mpesacheck').val();
//alert(txte); 
$.ajax({ 
 type: 'POST', 
 url: '<?php echo SITE_URL; ?>homes/mpesacheck',
 data: {'mpesa':txte},
 success: function(data){  
 if(data=='1'){
	          $('#mpesamessage').css('display','block');   
	         $('#mpesacheck').val('');  
	         $('#mpesamessagealreday').css('display','none'); 


 }else if(data=='4'){
	 $('#mpesamessagealreday').css('display','block');   
	          $('#mpesacheck').val('');
	           $('#mpesamessage').css('display','none');   
	 	             
 }else if(data=='0'){
 $('#mpesamessagecheckvalue').css('display','block');
 	          $('#mpesacheck').val('');
  
 }else{

	 	 $('#mpesamessagecheckvalue').css('display','none'); 
	 	 $('#mpesamessage').css('display','none'); 
	  $('#mpesamessagealreday').css('display','none'); 
 }
    },    
  });   

});
*/
</script>
<!-- Modal -->
<div id="ticketpeventpurmyModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <div class="modal-body"><strong>
      You are owner of this event. You can't purchase ticket for this event.</strong></p>
    </div>

  </div>

</div>
</div>
