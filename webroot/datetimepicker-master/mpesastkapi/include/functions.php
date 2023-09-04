<?php
// STK Push functions

function generate_access_token()
{

	$accesstokenendpoint = 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
	$stkpushconsumerkey="f4OGsAcJkQcA0jScGFE5LFmjlCg3ne5G";
	$stkpushconsumersecret="Jgct2lPxyxxiEGAX";

	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $accesstokenendpoint);
	$credentials = base64_encode(''.$stkpushconsumerkey.':'.$stkpushconsumersecret.'');
	curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic '.$credentials)); //setting a custom header
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

	$curl_response = curl_exec($curl);

	//echo $curl_response;

	$arrays=json_decode($curl_response,true);
	$access_token = $arrays['access_token'];

	return $access_token;

}

function process_mpesa_stkpush($customer_phone,$accountno,$transactiondesc,$amount,$business_code)
{

	$passkey = "121a9f9189110d29d1b838a9b1d245182f7fb5bbe159745a72a3c019398ca378";
	$stkpushendpoint = 'https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
	$stkpushcallbackurl = 'http://198.154.230.163/~coopself/372222/logs/stkpushlog.php'; // CallBackURL
	
	$access_token =generate_access_token();

	$timestamp = date("YmdHis");
	$password = base64_encode($business_code.$passkey.$timestamp);
	$transactiontype = "CustomerPayBillOnline";

	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $stkpushendpoint);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$access_token.'')); //setting custom header


	$curl_post_data = array(
	  //Fill in the request parameters with valid values
	  'BusinessShortCode' => ''.$business_code.'',
	  'Password' => ''.$password.'',
	  'Timestamp' => ''.$timestamp.'',
	  'TransactionType' => ''.$transactiontype.'',
	  'Amount' => ''.$amount.'',
	  'PartyA' => ''.$customer_phone.'',
	  'PartyB' => ''.$business_code.'',
	  'PhoneNumber' => ''.$customer_phone.'',
	  'CallBackURL' => ''.$stkpushcallbackurl.'',
	  'AccountReference' => ''.$accountno.'',
	  'TransactionDesc' => ''.$transactiondesc.''
	);

	$data_string = json_encode($curl_post_data);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);

	$curl_response = curl_exec($curl);

	return $curl_response;
}


function query_mpesa_stkpush($CheckoutRequestID,$business_code)
{
	$passkey = "121a9f9189110d29d1b838a9b1d245182f7fb5bbe159745a72a3c019398ca378";
	$stkpushqueryendpoint = 'https://api.safaricom.co.ke/mpesa/stkpushquery/v1/query'; // Query STK Push Status
	$access_token =generate_access_token();
	$timestamp = date("YmdHis");
	$password = base64_encode($business_code.$passkey.$timestamp);
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $stkpushqueryendpoint);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$access_token.'')); //setting custom header


$curl_post_data = array(
  //Fill in the request parameters with valid values
  'BusinessShortCode' => ''.$business_code.'',
  'Password' => ''.$password.'',
  'Timestamp' => ''.$timestamp.'',
  'CheckoutRequestID' => ''.$CheckoutRequestID.''
);

$data_string = json_encode($curl_post_data);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);

$curl_response = curl_exec($curl);
//print_r($curl_response);

return $curl_response;
}





?>