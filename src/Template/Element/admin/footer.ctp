

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="<?php echo SITE_URL ?>js/admin/plugins.js"></script>

    <script src="<?php echo SITE_URL ?>js/admin/lib/chart-js/Chart.bundle.js"></script>
    <script src="<?php echo SITE_URL ?>js/admin/dashboard.js"></script>
    <script src="<?php echo SITE_URL ?>js/admin/widgets.js"></script>
   
    <script src="<?php echo SITE_URL ?>js/admin/lib/vector-map/country/jquery.vmap.world.js"></script>
    <script src="<?php echo SITE_URL ?>ckeditor/ckeditor.js"></script>
    <script src="<?php echo SITE_URL ?>js/admin/bootstrap-datetimepicker.js"></script>


<!--
    <script src="<?php echo SITE_URL ?>js/admin/lib/chart-js/Chart.bundle.js"></script>

    <script src="<?php echo SITE_URL ?>js/admin/lib/vector-map/country/jquery.vmap.world.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="<?php echo SITE_URL ?>js/admin/plugins.js"></script>
    <script src="<?php echo SITE_URL ?>js/admin/lib/chart-js/Chart.bundle.js"></script>
    <script src="<?php echo SITE_URL ?>js/admin/dashboard.js"></script>
    <script src="<?php echo SITE_URL ?>js/admin/widgets.js"></script>
    <script src="<?php echo SITE_URL ?>js/admin/bootstrap-datetimepicker.js"></script>
-->
<script>
$(document).ready(function(){
    $(".chngpass").click(function(){
        $(".passdata").toggle();
    });
});
</script>


<script>
$(document).ready(function(){
jquery(".passdata").toggle();
});
</script> 

    <script>
        ( function ( $ ) {
            "use strict";

            jQuery( '#vmap' ).vectorMap( {
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#1de9b6',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: [ '#1de9b6', '#03a9f5' ],
                normalizeFunction: 'polynomial'
            } );
        } )( jQuery );
    </script>

<script>
        $('#left-panel').hover(function(){
  $("body").removeClass("open", 3000);
}, function(){
  $("body").addClass("open", 3000);
});
    </script>
</body>
</html>
