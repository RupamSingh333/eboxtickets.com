<?php
error_reporting('E^ALL');
require_once('functions.php');

if (!isset($_SERVER['PHP_AUTH_USER']) && !isset($_SERVER['PHP_AUTH_PW'])) {
 header("WWW-Authenticate: Basic realm=\"Please enter your username and password to proceed further\"");
 header("HTTP/1.0 401 Unauthorized");
 header("Content-type: application/json; charset=utf-8");
 $message = '{"StatusCode":"403","StatusMessage":"Authorization Failed"}';
 echo $message;
 exit;
}

$authuser ='MPesaSTK';
$authpass ='STK@2019!#';


date_default_timezone_set("Africa/Nairobi");

?>