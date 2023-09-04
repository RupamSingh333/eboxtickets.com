<?php

set_time_limit(60*60); // set title limit
header("Content-type: application/json; charset=utf-8");
require_once('include/authheader.php'); // record user authentication details

$json = file_get_contents('php://input'); 	
$arrays=json_decode($json,true);

if ($_SERVER['PHP_AUTH_USER'] == $authuser && $_SERVER['PHP_AUTH_PW'] == $authpass) //check username password
{
  //do STK Push Stuff here
    $CheckoutRequestID = $arrays['CheckoutRequestID']; 
	$business_code = $arrays['business_code'];

  if(empty($CheckoutRequestID) || empty($business_code))
  {
	    header("Content-type: application/json; charset=utf-8");
		$message = '{"status":"Error","StatusCode":"101","StatusMessage":"Bad Request - Parameter Missing Value"}';
		echo $message;
  }
  else
  {
		$querystkpush = query_mpesa_stkpush($CheckoutRequestID,$business_code);
		echo '<b><i><font size=3>'.$querystkpush.'</font></i></b>';
  }  
	
}
else
{
  header("WWW-Authenticate: Basic realm=\"Please enter your username and password to proceed further\"");
  header("HTTP/1.0 401 Unauthorized");
  header("Content-type: application/json; charset=utf-8");
  $message = '{"status":"Failed","StatusCode":"403","StatusMessage":"Authorization Failed"}';
  echo $message;
  exit;
}

?>