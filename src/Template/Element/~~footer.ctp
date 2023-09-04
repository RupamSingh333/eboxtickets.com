<footer id="footer">
<div class="container">
<div class="row">
<div class="col-sm-4 col-xs-12 text-left">
<div class="foot_about">
<h4>About</h4>
<p>Launched in 2004, is self-funded and still run by its founders. We are a dedicated team with a passion for helping event organisers to run their events smoothly and successfully.</p>
</div>
</div>
<div class="col-sm-1 col-xs-12"></div>
<div class="col-sm-3 col-xs-6 text-left">
<div class="foot_about">
<h4>Useful Links</h4>
<ul>
<li><a href="#">Home</a></li>                    
<li><a href="#">About</a></li>                    
<li><a href="#">Events</a></li>
<li><a href="#">FAQ</a></li>
<li><a href="#">Contact</a></li>
</ul>
</div>
</div>
<div class="col-sm-4 col-xs-6 text-left">
<div class="foot_about">
<h4>Plan Events</h4>
<ul>
<li><a href="#">Conference Management Software</a></li>                    
<li><a href="#">Food and Drink Ticketing</a></li>                    
<li><a href="#">Nonprofits & Fundraisers</a></li>
<li><a href="#">Sell Tickets</a></li>
<li><a href="#">Event Management</a></li>




</ul>
</div>
</div>
</div>
<div class="foot_bottom">
<ul class="footer_social_icon text-center">
<li><a href="<?php echo $trem['fburl']; ?> "><i class="fab fa-facebook-f"></i></a></li>
<li><a href="<?php echo $trem['Twitterurl']; ?>"><i class="fab fa-twitter"></i></a></li>
<li><a href="<?php echo $trem['instaurl']; ?>"><i class="fab fa-instagram"></i></a></li>
</ul>
</div>

</div>        
</footer><!--Footer End-->
</div>
<!--page-wrapper-->

<!------min.js-----------------> 
<script src="<?php echo SITE_URL; ?>js/jquery.min.js" type="text/javascript"></script> 
<!--------------bootstyrap-js--------------------------> 
<script src="<?php echo SITE_URL; ?>js/bootstrap.min.js" type="text/javascript"></script> 
<!--------------owl_carousel_js--------------------------> 
<script src="<?php echo SITE_URL; ?>js/owl.carousel.js"></script> 
           <script src="<?php echo SITE_URL; ?>js/bootstrap-datetimepicker.min.js" type="text/javascript"></script> 

<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
</script>

<script>
                      $(document).ready(function() { 
              $('.slider-carousel').owlCarousel({ 
                loop: true,
				autoplay:true,
                responsiveClass: true,
            
                
				smartSpeed:1000,
                  onInitialized  : counter, 
				onTranslated : counter, 
                responsive: {
                  0: {
                    items: 1,
                    nav: false
                  },
                  600: {
                    items: 1,
                    nav: false
                  },
                  1000: {
                    items: 1,
                    nav: false,
                    loop: true
                  }
                }
                
                
                
              });
              
              function counter(property) { 

    var current = this.currentItem;
    
    
     var current = property.item.index;
    var datadate = $(property.target).find(".owl-item").eq(current).find("img").attr('data-slider');
  getCountdown(datadate);
    /*
   var tes = $('.active').find("img").attr('src');
      alert(tes);
      var item      = elem.item.index; 
      alert(item);
      */
      
}
            });
       
          </script>  

<script>
$(document).ready(function(){
    $(".profile_menu").click(function(){
        $(".profile_menu_opetion").slideToggle();
    });
});
</script>
<script type="text/javascript">
    $(".form_datetime").datetimepicker({
        format: "MM dd yyyy - hh:ii",
        autoclose: true,
        todayBtn: true,
        pickerPosition: "bottom-left"
    });
</script>

<script type="text/javascript">
    $(".form_datetime2").datetimepicker({
        format: "MM dd yyyy - hh:ii",
        autoclose: true,
        todayBtn: true,
        pickerPosition: "bottom-right"
    });
</script>


<script> <!--Timer script Start-->
var target_date = new Date().getTime() + (1000*3600*48); // set the countdown date
var days, hours, minutes, seconds; // variables for time units

var countdown = document.getElementById("tiles"); // get tag element

getCountdown();

setInterval(function () { getCountdown(); }, 1000);

function getCountdown(){

  // find the amount of "seconds" between now and target
  var current_date = new Date().getTime();
  var seconds_left = (target_date - current_date) / 1000;

  days = pad( parseInt(seconds_left / 86400) );
  seconds_left = seconds_left % 86400;
     
  hours = pad( parseInt(seconds_left / 3600) );
  seconds_left = seconds_left % 3600;
      
  minutes = pad( parseInt(seconds_left / 60) );
  seconds = pad( parseInt( seconds_left % 60 ) );

  // format countdown string + set tag value
  countdown.innerHTML = "<span>" + days + "</span><span>" + hours + "</span><span>" + minutes + "</span><span>" + seconds + "</span>"; 
}

function pad(n) {
  return (n < 10 ? '0' : '') + n;
}
</script> <!--Timer script End-->       
</body>
</html>
