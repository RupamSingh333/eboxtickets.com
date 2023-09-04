<?php
print_r($_SERVER);
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://www.idsprime.com/html2canvas.js"></script>

<!-- <canvas id="canvas"></canvas>

<script>
const canvas = document.getElementById('canvas');
const ctx = canvas.getContext('2d');

ctx.filter = 'blur(4px)';
ctx.font = '48px serif';
ctx.fillText('Hello world', 50, 100);

</script> -->



<!-- <canvas id="canvas" width="400" height="150"></canvas>
<div style="display:none;">
  <img id="source" src="https://eboxtickets.com/eventticketimages/1667295403ee26908bf9629eeb4b37dac350f4754a.png" />
</div>


<script>
const canvas = document.getElementById('canvas');
const ctx = canvas.getContext('2d');
const image = document.getElementById('source');

image.addEventListener('load', (e) => {
  // Draw unfiltered image


  ctx.drawImage(image, 0, 0, image.width * .6, image.height * .6);
ctx.filter = 'blur(4px)';
  // Draw image with filter
//   ctx.filter = 'contrast(1.4) sepia(1) drop-shadow(-9px 9px 3px #e81)';
  ctx.drawImage(image, 400, 0, -image.width * .6, image.height * .6);
});

</script> -->

<style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    overflow: hidden;
  }

  #mask {
    width: 430px;
    height: 430px;
    border-radius: 1%;
    overflow: hidden;
    position: absolute;
    top: calc(50% - 25px);
    left: calc(50% - 25px);
  }

  #unblurred {
    position: absolute;
    top: 0;
    left: 0;
    z-index: 999;
    width: 100%;
    height: 100%;
    overflow: hidden;
    -webkit-filter: blur(0px);
  }

  #unblurred img {
    position: fixed;
    left: 0;
    top: 0;
  }

  #blurred {
    -webkit-filter: blur(20px);
  }
     </style>
<div id="mask">
  <div id="unblurred">
    <img src="https://i.ytimg.com/vi/LRVsxe5OJVY/maxresdefault.jpg">
  </div>
</div>
<img id="blurred" src="https://i.ytimg.com/vi/LRVsxe5OJVY/maxresdefault.jpg">



<script>
$(function() {
        $( "#mask" ).draggable({ containment: "parent" });
    });
function saveMask() {
        $("#blurred").hide()
        html2canvas(document.querySelector("#mask"), {backgroundColor: null, allowTaint: true}).then(h2c => {
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
        });
    }
    $(function() {
        $("#mask").draggable({ containment: "parent" });
        //setTimeout(saveMask, 2000);
    });


</script>