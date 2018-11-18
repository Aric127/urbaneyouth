<?php //
ini_set("display_errors", "1");
error_reporting(E_ALL);

$signedData = "GET" . "\n" . gmdate('D, d M Y H:i:s T') . "\n" . "/rest/consumer/finance/status";
$token = base64_decode('+uwXEA2F3Shkeqnqmt9LcmALGgkEbf2L6MbKdUJcFwow6X8jOU/D36CyYjp5csR5gPTLedvPQDg1jJGmOnTJ2A==');
$signature = hash_hmac('sha1', $signedData, $token, true);
$encodedsignature = base64_encode($signature);
$curl = curl_init();
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt_array($curl, array(CURLOPT_URL => "https://136.243.252.209/app/rest/consumer/finance/status", CURLOPT_RETURNTRANSFER => true, CURLOPT_ENCODING => "", CURLOPT_MAXREDIRS => 10, CURLOPT_TIMEOUT => 30, CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => "GET", CURLOPT_HTTPHEADER => array("accept: application/json, application/*+json", "accept-encoding: gzip,deflate", "authorization: MSP efficiencie:" . $encodedsignature, "cache-control: no-cache", "connection: Keep-Alive", "host: 136.243.252.209", "postman-token: 857e074a-8286-bb95-7bee-87df7dea3bed", "user-agent: Apache-HttpClient/4.5.1 (Java/1.8.0_91)", "x-msp-date:" . gmdate('D, d M Y H:i:s T')), ));
$response = curl_exec($curl);
print_r($response);
$err = curl_error($curl);
curl_close($curl);

if ($err) {
	echo "error";
} else {
	$data = json_decode($response);
	//echo $data->balance;

	/*
	 $requestBody = '{"details":{"phoneNumber":"08126396323","amount":100,"id":20,"paymentCollectorId":"CDL","paymentMethod":"PREPAID","serviceId":"ACA"}}';

	 $hashedRequestBody = base64_encode(hash('sha256', utf8_encode($requestBody), true));

	 $signedData="POST"."\n".$hashedRequestBody."\n".gmdate('D, d M Y H:i:s T')."\n"."/rest/consumer/v2/exchange";

	 $token = base64_decode('+uwXEA2F3Shkeqnqmt9LcmALGgkEbf2L6MbKdUJcFwow6X8jOU/D36CyYjp5csR5gPTLedvPQDg1jJGmOnTJ2A==');

	 $signature = hash_hmac('sha1', $signedData, $token, true);

	 $encodedsignature = base64_encode($signature);

	 $post= "serviceId=ACA&id=20&paymentCollectorId=CDL&paymentMethod=PREPAID&details=details:phoneNumber:08126396323,amount:100,id:20,paymentCollectorId:CDL,paymentMethod:PREPAID,serviceId:ACA&x-msp-date='".gmdate('D, d M Y H:i:s T')."'&Authorization=MSP%20efficiencie.$encodedsignature";
	 // print_r($post);
	 $curl = curl_init();
	 curl_setopt ($curl, CURLOPT_SSL_VERIFYHOST, 0);
	 curl_setopt ($curl, CURLOPT_SSL_VERIFYPEER, 0);
	 curl_setopt_array($curl, array(
	 CURLOPT_URL => "https://136.243.252.209/app/rest/consumer/v2/exchange",
	 CURLOPT_RETURNTRANSFER => true,
	 CURLOPT_ENCODING => "",
	 CURLOPT_MAXREDIRS => 10,
	 CURLOPT_TIMEOUT => 30,
	 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	 CURLOPT_CUSTOMREQUEST => "POST",
	 CURLOPT_POSTFIELDS =>$requestBody,
	 CURLOPT_HTTPHEADER => array(
	 "accept: application/json, application/*+json",
	 "accept-encoding: gzip,deflate",
	 "authorization: MSP efficiencie:".$encodedsignature,
	 "cache-control: no-cache",
	 "connection: Keep-Alive",
	 "content-type: application/x-www-form-urlencoded",
	 "host: 136.243.252.209",
	 "postman-token: 83638bef-9ed7-30e1-b261-39207cd36461",
	 "user-agent: Apache-HttpClient/4.5.1 (Java/1.8.0_91)",
	 "x-msp-date:".gmdate('D, d M Y H:i:s T')
	 ),
	 ));
	 $response = curl_exec($curl);
	 $err = curl_error($curl);

	 curl_close($curl);

	 if ($err) {
	 echo "cURL Error #:" . $err;
	 } else {
	 echo $response;
	 }*/
	$requestBody = '{"details":{"phoneNumber":"08126396323","amount":100,"id":20,"paymentCollectorId":"CDL","paymentMethod":"PREPAID","serviceId":"ADB"}}';

	$hashedRequestBody = base64_encode(hash('sha256', utf8_encode($requestBody), true));

	$date = gmdate('D, d M Y H:i:s T');
	$signedData = "POST" . "\n" . $hashedRequestBody . "\n" . $date . "\n" . "/rest/consumer/v2/exchange";

	$token = base64_decode('+uwXEA2F3Shkeqnqmt9LcmALGgkEbf2L6MbKdUJcFwow6X8jOU/D36CyYjp5csR5gPTLedvPQDg1jJGmOnTJ2A==');

	$signature = hash_hmac('sha1', $signedData, $token, true);

	$encodedsignature = base64_encode($signature);

	$curl = curl_init();
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt_array($curl, array(
	CURLOPT_URL => "https://136.243.252.209/app/rest/consumer/v2/exchange", 
	CURLOPT_RETURNTRANSFER => true, 
	CURLOPT_ENCODING => "", 
	CURLOPT_MAXREDIRS => 10, 
	CURLOPT_TIMEOUT => 30, 
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1, 
	CURLOPT_CUSTOMREQUEST => "POST", 
	CURLOPT_POSTFIELDS => $requestBody, 
	CURLOPT_HTTPHEADER => array("accept: application/json, application/*+json", "accept-encoding: gzip,deflate", "authorization: MSP efficiencie:" . $encodedsignature, "cache-control: no-cache", "connection: Keep-Alive", "content-type: application/json", "host: 136.243.252.209", "x-msp-date:" . $date), ));
	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
		echo "cURL Error #:" . $err;
	} else {
		echo $response;
	}

}
