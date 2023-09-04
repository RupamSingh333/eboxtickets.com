  <?php   if(preg_match('/youtube/', $event_data['video_url'])){
  
    
  $url = '//www.youtube.com/embed/'.explode('=', $event_data['video_url'])[1];
   echo "<iframe width='100%' height='400px' src='$url' frameborder='0' allowfullscreen></iframe>";

}?>

	



