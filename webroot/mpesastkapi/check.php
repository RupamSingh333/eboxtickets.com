<?php

		date_default_timezone_set('Africa/Nairobi');
		$venue="test";
		$idno=@$_POST['idnumber'];;

		if(!empty($idno))
		{
		$param = 'idnumber='.$idno.'&kmp_recipients='.$venue;			
		$url='http://www.ntsa.go.ke/ictsupport/app/index.php';
		$post = curl_init();
		curl_setopt($post, CURLOPT_URL, $url);
		curl_setopt($post, CURLOPT_POSTFIELDS, $param);
		curl_setopt($post, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($post);
		curl_close($post);
		$res = explode(":",$result);

		if($res[1] !="FAKE")
		{
		$cyear = (int) date('Y'); 
		$yob = (int) substr($res[3],0,4);
		$gender = $res[4];
		$age= $cyear - $yob;

		$result="Success";
		$description =$age.$gender; 
		}
		else
		{
			$result='Failed';
			$description="N/A";
		}

		$res = $result.':'.$description;
			
		echo $res;

}
else
{
	$msg = "Parameter Missing Value";
	echo  "{\"status\":\"".$msg."\"}";
}


?>