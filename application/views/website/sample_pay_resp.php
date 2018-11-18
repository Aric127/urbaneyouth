<?php

 $amount=$this->session->userdata('app_user_amount'); 
 $product_id = '6804'; 

 $txn_ref = $_POST['txnref'];

$mackey = 'B668FF05B7B90C4A80F24FFC55DC2E1963F006CC861C215E5FD58CDABA70B52078FA481616A757D4CC7549A80ED4A6B8434381409D8CE0E0F6BACDC493291E6B';

$data = $product_id.$txn_ref.$mackey;

$hashed = hash('sha512', $data);

 $url = "https://webpay.interswitchng.com/paydirect/api/v1/gettransaction.json?productid=$product_id&transactionreference=$txn_ref&amount=$amount";

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
  $arr=json_decode($response);

  $amount=($arr->Amount/100);
  $trans_id=$arr->RetrievalReferenceNumber;
  $status=$arr->ResponseCode;
   $ResponseDescription=$arr->ResponseDescription;
  if($status =='00')
  {
  
  	redirect('website/pay_success/transaction_id/'.$trans_id);
 
  }else{
  		redirect('website/pay_failure/failed_desc/'.$ResponseDescription."/".$trans_id);
  }
}?>