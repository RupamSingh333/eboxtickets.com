<?php

function ConnectDB()
{
	/* local db configuration */
	$db_host= "localhost";
	$db_name= ""; 
	$db_username = ""; 
	$db_password = "";  

	//open database connection
	$con = mysqli_connect($db_host,$db_username,$db_password,$db_name);
	if (mysqli_connect_errno())
	{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	return $con;

}



?>

