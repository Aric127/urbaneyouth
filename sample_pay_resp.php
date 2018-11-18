<?php

// print_r($_POST);

$product_id = '4980';

$txn_ref = $_POST['txnref'];

$mackey = 'C8C24E816BD825584AB4B7CEAD1763E11B997EE0C8BEB6E9D0E7C40A6C95680CC1C49E8C9658195A53AF3A1B9AE2B11E1745E1D46854E6338851427E07C581A5';

$data = $product_id.$txn_ref.$mackey;

$hashed = hash('sha512', $data);

$url = "https://stageserv.interswitchng.com/test_paydirect/api/v1/gettransaction.json?productid=$product_id&transactionreference=$txn_ref&amount=5000";

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "hash: $hashed",
    "useragent: Mozilla/4.0 (compatible; MSIE 6.0; MS Web Services Client Protocol 4.0.30319.239)"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}