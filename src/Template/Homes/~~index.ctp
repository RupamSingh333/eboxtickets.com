

<section id="slider"> <!--Slider Start-->


<div class="owl-carousel owl-theme owl-loaded slider-carousel">
    <div class="owl-stage-outer">
        <div class="owl-stage">

       <?php foreach($event as $key=>$value) {//pr($value);die; ?>
<input type="hidden" value="<?php echo date('D M d Y H:i:s',strtotime($value->date_to)); ?>" class="gend" data-sl="fd">


            <div id= "1"class="numberslider owl-item">
				<img src="<?php echo SITE_URL;?>imagess/<?php echo $value['feat_image'];?>" alt="event_img" data-slider="<?php echo date('D M d Y H:i:s',strtotime($value->date_to)); ?>">

<div class="slider_cuntent">
    <div class="container">
    <div class="row">
    <div class="col-sm-7">  
    <div class="slider_text">
     <h3 style="padding:30px 0px 0px 0px;"><span style=" font-size: 30px; color: #fff;font-weight: 400; padding-bottom: 0px"><?php echo date('D M d Y H:i',strtotime($value['date_to']));?></span> </h3>
    <h1><span style=" font-size: 40px; font-weight: 600"><?php echo $value['name'];?></span> </h1>

    <a href="<?php echo SITE_URL ?>/homes/eventdetail /<?php echo $value['id']  ?>">Buy Ticket Now</a>
    </div>
    </div>
    <div class="col-sm-5">
    <div class="timer">
    <img src="images/timer-bg.png" alt="timerbg">
 

    <div id="countdown">
  <div id='tiles'>
  <span class="sliderdaysvalue"></span>
  <span class="sliderhoursvalue"></span>
  <span class="sliderminutevalue"></span>
  <span class="slidersecondvalue"></span>
  </div>
  <div class="labels">
    <li>Days 
</li>
    <li>Hours
</li>
    <li>Minutes
</li>
    <li>Seconds
</li>
  </div>
  <div class="timer_border"><img src="images/timer-border.png" alt="timer_border"></div>
</div>


    
    </div>
    
    
    </div>
    </div>
    </div>
    </div>


            </div>



            <!--<div class="owl-item"><img src="<?php echo SITE_URL; ?>images/slider_1.jpg" alt="slider_2"></div>
            <div class="owl-item"><img src="<?php echo SITE_URL; ?>images/slider_2.jpg" alt="slider_3"></div>
            <div class="owl-item"><img src="<?php echo SITE_URL; ?>images/slider_3.jpg" alt="slider_4"></div>
            <div class="owl-item"><img src="<?php echo SITE_URL; ?>images/slider_4.jpg" alt="slider_5"></div>-->

       
<?php }  ?>

        </div>
    </div>
</div>

</section> <!--Slider End--> 



<section id="upcoming_event"><!--upcoming Event Start-->
<div class="container">
<hgroup>
<h2>Upcoming Events</h2>
<p>Buy tickets in advance to popular events</p>
</hgroup>

<ul class="event_date_bar row">
	
		<?php foreach($event as $key=>$value){ //pr($value);?>
<li class="col-sm-4"><?php echo date('F',strtotime($value['date_from'])); ?> <?php echo date('Y',strtotime($value['date_from'])); ?> <span><?php echo date('d',strtotime($value['date_from'])); ?></span></li>
<?php } ?>
</ul>

<div class="row">
	



 
<?php foreach($event as $key=>$value){  

$data=$this->Comman->totalseatbook($value['id']); 
//pr($data);
$ticketsoldout=0;
foreach($data as $key=>$value1){ 
$ticketsoldout=$value1['ticketsold'];
}
$totalseat=$value['no_of_seats'];
$ticketremaining=$totalseat-$ticketsoldout;
	//pr($value['id']);?>
<div class="col-sm-4">
<div class="event_box">
<a href="<?php echo SITE_URL; ?>/homes/eventdetail/<?php echo $value['id'];?>">

<?php if($ticketremaining==0){?>
   
   <img class="watermark" src="<?php echo SITE_URL;?>imagess/<?php echo $value['feat_image'];?>" alt="event_img" height="auto">

   <img class="watermarks" src="<?php echo SITE_URL; ?>imagess/watermark.png"  height="175px">


<?php } else {?>

<img class="watermark" src="<?php echo SITE_URL;?>imagess/<?php echo $value['feat_image'];?>" alt="event_img" height="250px">

<?php } ?>
<div class="event_dtl">
<h3><?php echo $value['name']; ?></h3>
<p><?php echo date('F d, Y',strtotime($value['date_from'])); ?></p>
</div>
</a>
</div>
</div>

<?php  } ?>


</div>

<a href="<?php echo SITE_URL; ?>event/upcomingevent" class="main_button">View All Event</a>

</div>


</section><!--upcoming Event End-->
<?php /* ?>
<section id="past_event"><!--upcoming Event Start-->
<div class="container">
<hgroup>
<h2>Past Events</h2> 
<p>Buy tickets in advance to popular events</p>
</hgroup>

<ul class="event_date_bar row">
	
		<?php foreach($pastevent as $key=>$value){ //pr($value);?>
<li class="col-sm-4"><?php echo date('F',strtotime($value['date_from'])); ?> <?php echo date('Y',strtotime($value['date_from'])); ?> <span><?php echo date('d',strtotime($value['date_from'])); ?></span></li>
<?php } ?>
</ul>

<div class="row">
	
	
<?php foreach($pastevent as $key=>$value){ //pr($value);?>
<div class="col-sm-4">
<div class="event_box">
<a href="<?php echo SITE_URL; ?>/homes/eventdetail/<?php echo $value['id'];?>">
<img src="<?php echo SITE_URL;?>imagess/<?php echo $value['feat_image'];?>" alt="event_img" height="250px">
<div class="event_dtl">
<h3><?php echo $value['name']; ?></h3>
<p><?php echo date('F d, Y',strtotime($value['date_from'])); ?>
	</p>
</div>
</a>
</div>
</div>

<?php  } ?>


</div>

<a href="<?php echo SITE_URL; ?>event/pastevent" class="main_button">View All Event</a>

</div>

</section><!--upcoming Event End-->
<?php  */ ?>
<div class="footer_buildings"></div>


<?php   





?>
<?php 	$test_orgenize_time=date('D M d Y H:i:s',strtotime($value->date_to));

 ?>
<script> <!--Timer script Start-->
	
		//alert(mydatetime);
var target_date = new Date(mydatetime).getTime(); // set the countdown date

//alert(new Date(mydatetime));
var days, hours, minutes, seconds; // variables for time units
var countdown = document.getElementById("tiles"); // get tag element

setInterval(function () { getCountdown(); }, 1000);



function getCountdown(target_date){
	
	var target_date = new Date(target_date).getTime(); // set the countdown date
alert(target_date);
	
//find the amount of "seconds" between now and target
var current_date = new Date().getTime();
//alert(new Date());
var seconds_left = (target_date - current_date) / 1000;
days = pad( parseInt(seconds_left / 86400) );
seconds_left = seconds_left % 86400;
     
hours = pad( parseInt(seconds_left / 3600) );
seconds_left = seconds_left % 3600;
    
minutes = pad( parseInt(seconds_left / 60) );
seconds = pad( parseInt( seconds_left % 60 ) );


 $(".sliderdaysvalue").text(days);
 $(".sliderhoursvalue").text(hours);
 $(".sliderminutevalue").text(minutes);
 $(".slidersecondvalue").text(seconds);

  // format countdown string + set tag value
countdown.innerHTML = "<span>" + days + "</span><span>" + hours + "</span><span>" + minutes + "</span><span>" + seconds + "</span>"; 



}
function pad(n) {
   return (n < 10 ? '0' : '') + n;
}


</script> <!--Timer script End--> 


