<style type="text/css">
    .modal-header .close {
        margin-top: -33px;
    }

    .modal-content {
        width: 131%;
    }
</style>

<?php 
$popupdat = str_replace(array('{SITE_URL}'), array(SITE_URL), $popupdata['description']);
echo  $popupdat; 

?>