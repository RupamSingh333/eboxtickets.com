<!DOCTYPE html>
<html>
<head>
<style>
*{
	padding:0px;
	margin:0px;
}
div#divToPrint {
  width: 436px;
}
.ticket_bg {
  overflow: hidden;
  width: 436px;
  justify-content: center;
  position: relative;
  display: flex;
}
.ticket_P {
  width: 430px;
}
/* 
.ticket_bg img.img_bg {
  background-size: cover;
  background-repeat: no-repeat;
  filter: blur(10px);
  max-width: inherit;
  max-height: 600px;
  width: 100%;
  width: auto;
  max-width: inherit;
  width: 1200px;
} */

.ticket_bg img.ticket_qucode {
  width: 137px;
  margin-top: 27px;
}
.ticket_P .modal-body {
  padding: 0rem;
}

.ticket_contant {
  position: absolute;
  z-index: 9;
  top: 0;
  color: #ccc;
  padding: 18px;
  backdrop-filter: blur(
10px)
}

.ticket_contant .ticket_logo {
  width: 200px;
}

.ticket_info {
  background: rgba(0, 0, 0, 0.4);
  padding: 10px;
}

.ticket_info h6 {
  color: #b4d2ff;
  font-size: 13px;
  margin-bottom: 2px;
  font-weight: 400;
  margin-top: 10px;
}
.ticket_info p {
  color: #fff !important;
  font-size: 13px !important;
  margin-bottom: 5px !important;
}

button.btn.btn-secondary.close {
  padding: 5px 15px;
}

.Current_heading a.print_icon {
  color: #fff;
  font-size: 19px;
}

p.modal_p {
  margin-top: -22px !important;
}

img.img-fluid.img_t {
  border: 1px solid #383838;
}
</style>



<style>
  

  #mask {
     width: 436px;
     height:544px;
     position: relative;
}
  #unblurred {
    z-index: 9;
	width:100%;
    height: 100%;
    -webkit-filter: blur(0px);
	position: absolute;
	left:0px;
	top:0px;
	text-align:center;
	padding: 20px;
    box-sizing: border-box;
  }

  #blurred {
    -webkit-filter: blur(10px);
  }

.ticket_logo {
  width: 200px;
  display:block;
  margin-bottom: 20px;
}
.ticket_info {
  background: rgba(0, 0, 0, 0.4);
  padding: 10px;
  text-align:left;
}

.ticket_info h6 {
  color: #b4d2ff;
  font-size: 13px;
  margin-bottom: 2px;
  font-weight: 400;
  margin-top: 10px;
}
.ticket_info p {
  color: #fff !important;
  font-size: 13px !important;
  margin-bottom: 5px !important;
}
.img_t {
  border: 1px solid #383838;
}
.ticket_qucode {
  width: 137px;
  margin:auto;
  margin-top: 27px;
}
     </style>
     

</head>

<body>

<div id="mask">
  	<div id="unblurred">
		<div class="ticketData">
			<img class="ticket_logo" src="<?php echo IMAGE_PATH; ?>Logo.png" alt="logo">
			<div style="display:flex; justify-content:space-between;">
				<div style="width:55%">
					<div class="ticket_info">
						<h6>EVENT</h6>
						<p><?php echo ucwords(strtolower($ticketgen['ticket']['event']['name'])); ?></p>
						<h6>DATE</h6>
						<p><?php echo date('D, M jS Y / h:i A', strtotime($ticketgen['ticket']['event']['date_from'])); ?></p>
						<!-- <p>Sat, Aug 20th 2022 / <span>03:30pm</span></p> -->
						<h6>TYPE</h6>
						<p><?php echo ucwords(str_replace('_', ' ',$ticketname));?></p>
						<h6>PURCHASER</h6>
						<p><?php echo ucwords(strtolower($user_name));?></p>
						<h6>NAME</h6>
						<p><?php echo $ticketgen['name'];?></p>
					</div>
				</div>

				<div style="width:35%">
					<img src="<?php echo IMAGE_PATH . 'eventimages/' . $ticketgen['ticket']['event']['feat_image']; ?>" class="img-fluid img_t" alt="img" style="width:100%;">
				</div>
			</div>
			<img src="<?php echo SITE_URL.'qrimages/temp/'.$ticketgen['qrcode']; ?>" class="ticket_qucode" alt="img">
		</div>
	</div>
	<img id="blurred" style="width:100%;" src="<?php echo SITE_URL; ?>/eventblurimages/Jamdemicnew.jpg">
</div>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://www.idsprime.com/html2canvas.js"></script> -->




<!-- <script>
// $(function() {
//         $( "#mask" ).draggable({ containment: "parent" });
//     });
$(document).ready(function(){
        $("#blurred").hide()

		
        html2canvas(document.querySelector("#mask"), {backgroundColor: null, allowTaint: true}){
            var pos = $("#mask")[0].getBoundingClientRect();
            $("#mask").hide()
            var image = document.getElementById('blurred');
            var canvas = document.createElement("canvas");
            canvas.height = image.height;
            canvas.width = image.width;

            var ctx = canvas.getContext('2d')
            ctx.drawImage(image, 0, 0);
            ctx.filter = 'blur(6px)'
            ctx.drawImage(h2c, pos.x, pos.y);

            document.body.appendChild(canvas);

			var data = canvas.toDataURL('image/png');
			var image = new Image();
        	image.src = data;
			var file= dataURLtoBlob(data);
			var fd = new FormData();
			fd.append("imageNameHere", file);
			$.ajax({
				url: '<?php //echo SITE_URL; ?>/tickets/uploadticketimage',
				type: "POST",
				data: fd,
				processData: false,
				contentType: false,
				}).done(function(respond){
			});


        };
	});
    // $(function() {
    //     $("#mask").draggable({ containment: "parent" });
    //     //setTimeout(saveMask, 2000);
    // });

	function dataURLtoBlob(dataURL) { 
		var binary = atob(dataURL.split(',')[1]);
		var array = [];
		for(var i = 0; i < binary.length; i++) {
		array.push(binary.charCodeAt(i));
		}
		return new Blob([new Uint8Array(array)], {type: 'image/png'});
	}
</script> -->
<h2 id="demo"></h2>
 <script>
   setTimeout(myGreeting, 1000);
    function myGreeting() {
  console.log(test);
}
   $(document).ready(function(){
    console.log(test); 
    html2canvas([document.getElementById('mask')], {
    onrendered: function (canvas) {
        //document.getElementById('canvas').appendChild(canvas);
        var data = canvas.toDataURL('image/png');
        // AJAX call to send `data` to a PHP file that creates an image from the dataURI string and saves it to a directory on the server
        var image = new Image();
        image.src = data;
        var file= dataURLtoBlob(data);
        var fd = new FormData();
        fd.append("imageNameHere", file);
        $.ajax({
        url: '<?php echo SITE_URL; ?>/tickets/uploadticketimage',
        type: "POST",
        data: fd,
        processData: false, 
        contentType: false,
        }).done(function(respond){
        });
    }
    });
    function dataURLtoBlob(dataURL) {
    // Decode the dataURL    
    var binary = atob(dataURL.split(',')[1]);
    // Create 8-bit unsigned array
    var array = [];
    for(var i = 0; i < binary.length; i++) {
      array.push(binary.charCodeAt(i));
    }
    // Return our Blob object
    return new Blob([new Uint8Array(array)], {type: 'image/png'});
    }

});

</script> 
</body>
</html>