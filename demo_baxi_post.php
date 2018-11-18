<?php
//$requestBody = '{"details":{"phoneNumber":"08126396323","amount":100,"id":20,"paymentCollectorId":"CDL","paymentMethod":"PREPAID","serviceId":"ADB"}}';

// $requestBody = '{"details":{"phoneNumber":"08777722222","amount":100},"id":151,"paymentCollectorId":"CDL","paymentMethod":"PREPAID","serviceId":"ACA"}';
$phone='02110144711';
$service_id="AWA";
$amt='200';
$arr = array(
   'details' => array('smartCardNumber' => '020254152', 'amount' => '200'),
   'id' => 140,
   'paymentCollectorId' => 'CDL',
   'paymentMethod' => 'PREPAID',
   'serviceId' => $service_id
);

$requestBody = json_encode($arr);

$hashedRequestBody = base64_encode(hash('sha256', utf8_encode($requestBody), true));

 $date = gmdate('D, d M Y H:i:s T');
$signedData = "POST" . "\n" . $hashedRequestBody . "\n" . $date . "\n" . "/rest/consumer/v2/exchange";

$token = base64_decode('+uwXEA2F3Shkeqnqmt9LcmALGgkEbf2L6MbKdUJcFwow6X8jOU/D36CyYjp5csR5gPTLedvPQDg1jJGmOnTJ2A==');

$signature = hash_hmac('sha1', $signedData, $token, true);

 $encodedsignature = base64_encode($signature);

$arr = array(
"accept: application/json, application/*+json", 
"accept-encoding: gzip,deflate", 
"authorization: MSP efficiencie:" . $encodedsignature, 
"cache-control: no-cache", 
"connection: Keep-Alive", 
"content-type: application/json", 
"host: 136.243.252.209", 
"x-msp-date:" . $date
);

$curl = curl_init();
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt_array($curl, array(CURLOPT_URL => "https://136.243.252.209/app/rest/consumer/v2/exchange", 
CURLOPT_RETURNTRANSFER => true, 
CURLOPT_ENCODING => "", 
CURLOPT_MAXREDIRS => 10, 
CURLOPT_TIMEOUT => 300, 
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1, 
CURLOPT_CUSTOMREQUEST => "POST", 
CURLOPT_POSTFIELDS => $requestBody, 
CURLOPT_HTTPHEADER => $arr));
$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	//echo $response;
	$arr=json_decode($response);
	echo "<pre>";
	print_r($arr);
	 print_r($arr->details->exchangeReference);
}

	

//print_r($arr);








