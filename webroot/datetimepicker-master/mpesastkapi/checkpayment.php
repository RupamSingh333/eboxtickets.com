<?php

$mobile = @$_REQUEST['mobile'];
$amount = @$_REQUEST['amount'];
$txref = @$_REQUEST['txref'];

$con = conDB();

if(!empty($mobile) && !empty($amount) && !empty($txref))
{
	$amount = $amount.'.00';
	$query = mysqli_query($con,"select * from transactions_logs where MSISDN='$mobile' AND AMOUNT='$amount' AND MPESA_REF_ID='$txref'") or die(mysqli_error($con));
	$numrows = mysqli_num_rows($query);
	
    if($numrows > 0)
	{
		$res = "SUCCESS";
	}
	else
	{
		$res = "FAIL";
	}
	
	echo $res;
}
else
{
	header("Content-type: application/json; charset=utf-8");
	$msg = "Authorization Failed";
	echo  "{\"status\":\"".$msg."\"}";
	
}



function conDB()
{
	/* local db configuration */
	$db_host= "localhost";
	$db_name= "coopself_mpesa"; 
	$db_username = "coopself_372222"; 
	$db_password = "372222";

	//open database connection
	$con = mysqli_connect($db_host,$db_username,$db_password,$db_name);
	if (mysqli_connect_errno())
	{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	return $con;
	
}

?>



