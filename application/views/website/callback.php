
<?php
if(!empty($_GET['status'])){
	
	 ?>
	
<?php if($_GET['status']=='success'){
	 $_GET['transaction_reference'];
	$reffernce_var=$_GET['transaction_reference']; // transaction refference
	
	/*
	if($recharge_category=='4')
		{
				$biller_id= $this->session->userdata('biller_id'); 
				$biller_category_id= $this->session->userdata('biller_category_id'); 
				$consumer_number= $this->session->userdata('consumer_number');
				$biller_service_id= $this->session->userdata('biller_service_id'); 
					   }*/
	
// 1-mobile_amount. 2-recharge_number,3-recharge_category(1-mobile,2-dth,3-data),4-operator_id
		$payment_reference=$_GET['payment_reference']; // payment_reference
			 $user_id= $this->session->userdata('user_id'); 
		    $coupon_id= $this->session->userdata('coupon_id'); 
			$coupon_amount= $this->session->userdata('coupon_amount'); ?>
	
	<script>
	
			var wt_category = localStorage.getItem("wt_category");
			var myamount = localStorage.getItem("amount");
			var recharge_category = localStorage.getItem("recharge_category_id");
			var operator_id = localStorage.getItem("mobile_operator_id");
			var recharge_number = localStorage.getItem("mobile");
			var mobile_amount = localStorage.getItem("mobile_amount");
			var pay_status_wallet = localStorage.getItem("pay_status_wallet");
			if(myamount){
			$(document).ready(function(){
						$(window).on('load',function(){
							
						var recharge_category_id=recharge_category
					
						var recharge_amount=mobile_amount
						var trans_id='<?php echo $payment_reference;?>'
						var recharge_type=pay_status_wallet
						alert(recharge_type);
						if(recharge_type=='1' && recharge_category_id!='4' && recharge_category_id!='6'){
							var pay="recharge_from_wallet_with_card";
						}else if(recharge_type=='2' && recharge_category_id!='4' && recharge_category_id!='6'){
							var pay="recharge_from_card";
						}else if(recharge_type=='1' && recharge_category_id=='4'){
							var pay="bill_pay_from_card";
						}else if(recharge_type=='2' && recharge_category_id=='4'){
							var pay="bill_pay_card_with_wallet";
						}else if(recharge_type=='1' && recharge_category_id=='6'){
							var pay="donate_church_with_card";
						}else if(recharge_type=='2' && recharge_category_id=='6'){
							var pay="donate_church_wallet_with_card";
						}else if(recharge_type=='1' && recharge_category_id=='7'){
							var pay="ticket_booking_payment_with_card";
						}else if(recharge_type=='2' && recharge_category_id=='7'){
							var pay="ticket_booking_payment_wallet_with_card";
						}
						
				if(recharge_category_id!=4 && recharge_category_id != '6')
				{
				 var data1=
				 {
				   'operator_id':operator_id,
				   'recharge_user_id': '<?php echo $user_id;?>',
				   'recharge_category_id': recharge_category,
				   'recharge_number':recharge_number,
				   'recharge_amount':mobile_amount,
				   'coupon_amount':'<?php echo $coupon_amount;?>',
	            	'coupon_id':'<?php echo $coupon_id;?>',
	            	'wt_category':wt_category,
	            	'trans_id':trans_id,
	            	'payment_gateway_type':1,
	            	'payment_gateway_amt':myamount
				 }
			   }else if(recharge_category_id == '6')
				{
					
				 var data1=
				 {
				   'church_id': operator_id,
				   'donar_user_id': '<?php echo $user_id;?>',
				   'church_category_id': localStorage.getItem("church_category"),
				   'church_product_id': localStorage.getItem("church_p_id"),
				   'church_product_price': mobile_amount,
				    'wt_category':wt_category,
	            	'payment_gateway_id':trans_id,
	            	'payment_gateway_type':1,
	            	'payment_gateway_amt':myamount,
	            	'trans_id':trans_id
				 }else if(recharge_category_id == '7')
				{
					var event_id= localStorage.getItem("event_id");
				 var data1=
				 {
				   'event_id': event_id,
				   'user_id': '<?php echo $user_id;?>',
				  'tickets_records': localStorage.getItem("ticket_json_array"),
				   'ticket_price': localStorage.getItem("ticket_amount"),
				   'church_product_price': mobile_amount,
				    'wt_category':wt_category,
	            	'payment_gateway_id':trans_id,
	            	'payment_gateway_type':1,
	            	'payment_gateway_price':myamount
	            	
				 }
			   }else if(recharge_category_id != '6' && recharge_category_id == '4'&& recharge_category_id != '7'){
			   
			   	 var data1=
				 {
				   'operator_id': operator_id,
				   'recharge_user_id': '<?php echo $user_id;?>',
				   'bill_category_id': recharge_category,
				   'bill_consumer_no': '<?php if(!empty($consumer_number)) echo $consumer_number;?>',
				   'bill_amount': mobile_amount,
				   'coupon_amount':'<?php echo $coupon_amount;?>',
	            	'coupon_id':'<?php echo $coupon_id;?>',
	            	'wt_category':wt_category,
	            	'trans_id':trans_id,
	            	'payment_gateway_amt':myamount,
	            	'payment_gateway_type':1,
	            	'biller_id':<?php if(!empty($biller_id)) {  echo $biller_id; } else { echo "1"; } ?>
	            	
				 }
			   }
			  
			$.ajax({
				url: base_url+pay,
				 type: "POST",
				data: data1,
				 success: function (data) 
					{
				
						$("#overlay").removeClass('active');
					     var getdata=jQuery.parseJSON(data);
					   var status=getdata.status;
                		var message=getdata.message;
                		if(status=='true'){
                			localStorage.removeItem("amount");
                			$.ajax({
									url: site_url+"remove_session_coupon",
									 type: "POST",
									data: {
										'coupon_amount':'<?php echo $coupon_amount;?>',
						            	'coupon_id':'<?php echo $coupon_id;?>'
						            	 },
				 					success: function (data) 
										{
											localStorage.removeItem("amount");
					     	
					   					}
									});
                			
                			$("#recharge").modal();
                			var wallet=getdata.wallet_amount;
                			if(recharge_category_id=='1'){
                			$("#charge").attr("onclick", "another_mobile_recharge()");
                			}else if(recharge_category_id=='2'){amnt
                				$("#another_recharge").attr("onclick", "tv_rech()");
                			}else if(recharge_category_id=='3'){
                				$("#another_recharge").attr("onclick", "data_recharge()");
                			}else if(recharge_category_id == '5') {
								$("#another_recharge").attr("onclick", "electricity_recharge()");
							}else if(recharge_category_id == '4') {
								$("#another_recharge").attr("onclick", "bill_recharge()");
							}
							if(recharge_category_id == '5')
							{
								$("#electricity_response").html('Electricity recharge');
							}else
							if(recharge_category_id == '4')
							{
								$("#electricity_response").html('Bill Recharge');
							}else
							if(recharge_category_id == '6')
							{
								$("#electricity_response").html('Donation ');
							}if(recharge_category_id == '6')
							{
								$("#electricity_response").html('Ticket Booking ');
							}
                		$("#rec_date").text(getdata.recharge_date);
                		$("#amt").text(mobile_amount);
                		if(getdata.electricity_prepaid_token)
						{
							$("#order_id").text(getdata.electricity_prepaid_token);
							$("#elecrtic").html('Token No:');
						}else{
							$("#order_id").text(getdata.transaction_id);
						}
						if(recharge_category_id != '6')
							{
								$("#mob_num").text(recharge_number);
								$("#amnt").text(recharge_amount);
								$("#rec_date").text(getdata.recharge_date);
							}else{
								$("#rec_date").text(getdata.booking_date);
								$("#amt").text(getdata.booking_amount);
								$("#amnt").text(getdata.booking_amount);
							}
             
                		$(".wallet_amount").text(wallet);
                		
                		//$("#wallet_amounts").text(wallet);
                		$('#msg').attr('style','color: #337D75');
                		
                		}else if(status=='false'){
                			localStorage.removeItem("amount");
                			$("#recharge").modal();
                			$("#failed_status_response").html("Failed");
                		if(recharge_category_id != '7')
							{
								$("#mob_num").text(recharge_number);
								$("#amnt").text(recharge_amount);
								$("#rec_date").text(getdata.recharge_date);
							}else{
								$("#rec_date").text(getdata.booking_date);
								$("#amt").text(getdata.booking_amount);
								$("#amnt").text(getdata.booking_amount);
							}
                			$("#order_id").text(getdata.transaction_id);
                			$("#mob_num").text(recharge_number);
                			$(".wallet_amount").text(wallet);
                			$('#msg').attr('style','color: red');
                			$("#coupon_amount").val('');
                				$("#coupon_id").val('');
                				//$("#recharge_failed").modal();
                		}
                		 $("#msg").text(message);        	
					   }
				});
				

							});
						});
					}else{
						
						location.href=site_url+"my_transaction"
					}
	 </script>
	 <?php
}else if($_GET['status']=='error'){
	$desc=$_GET['comment'];
	$user_id= $this->session->userdata('user_id'); 
	$reffernce_var=$_GET['transaction_reference']; // transaction refference
	
	 ?>
	<script>
	$(document).ready(function(){
						$(window).on('load',function(){
							$("#trans_ref").text('<?php echo $reffernce_var;?>');
							var data1;
							var wt_category = localStorage.getItem("wt_category");	alert(wt_category);
							var myamount = localStorage.getItem("amount");
							var recharge_category = localStorage.getItem("recharge_category_id");
							var operator_id = localStorage.getItem("mobile_operator_id");
							var recharge_number = localStorage.getItem("mobile");
							var mobile_amount = localStorage.getItem("mobile_amount");
							var recharge_type = localStorage.getItem("pay_status_wallet");
						
						 if(wt_category=='13'){
							var pay="donate_church_with_card_failed";
						}else
						if(wt_category=='16'){
							var pay="ticket_booking_failed";
						}else
						if(wt_category=='11'){
							var pay="bill_pay_failed";
						}else{
						if(wt_category!='13' && wt_category!='11' && wt_category!='16'){
							var pay="recharge_failed";
						}		
						}
						
				if(wt_category!='13' && wt_category != '11'&& wt_category!='16')
				{
				 data1=
				 {
				   'operator_id': operator_id,
				   'recharge_user_id': '<?php echo $user_id;?>',
				   'recharge_category_id': recharge_category,
				   'recharge_number':recharge_number,
				   'recharge_amount':mobile_amount,
	            	'wt_category':wt_category,
	            	'payment_gateway_type':1,
	            	'failed_desc':'<?php echo $desc;?>',
	            	'payment_gateway_amt':myamount
	            	
				 }
			   }else if(wt_category == '11'){
			   
			   	 data1=
				 {
				   'operator_id': operator_id,
				   'recharge_user_id': '<?php echo $user_id;?>',
				   'bill_category_id': recharge_category,
				   'bill_consumer_no': '<?php if(!empty($consumer_number)) echo $consumer_number;?>',
				   'bill_amount': mobile_amount,
	            	'wt_category':11,
	            	'payment_gateway_type':1,
	            	'payment_gateway_amt':myamount,
	            	'failed_desc':'<?php echo $desc;?>',
	            	'biller_id':<?php if(!empty($biller_id)) {  echo $biller_id; } else { echo "1"; } ?>
	            	
	            	
				 }
			   }else if(wt_category == '13')
				{
					
				data1=
				 {
				   'church_id': operator_id,
				   'donar_user_id': '<?php echo $user_id;?>',
				   'church_category_id': localStorage.getItem("church_category"),
				   'church_product_id': localStorage.getItem("church_p_id"),
				   'church_product_price': mobile_amount,
				    'wt_category':wt_category,
	            	'payment_gateway_type':1,
	            	'failed_desc':'<?php echo $desc;?>',
	            	'payment_gateway_amt':myamount
	            	
				 }
			   }else if(wt_category == '16')
				{
					var event_id= localStorage.getItem("event_id");
				data1=
				 {
				   'event_id': event_id,
				   'user_id': '<?php echo $user_id;?>',
				   'tickets_records': localStorage.getItem("ticket_json_array"),
				   'ticket_price': localStorage.getItem("ticket_amount"),
				   'wt_category':wt_category,
	            	'payment_gateway_type':1,
	            	'failed_desc':'<?php echo $desc;?>',
	            	'payment_gateway_amt':myamount
	            	
				 }
			   }
							$.ajax({
									url: base_url+pay,
									 type: "POST",
									data: data1,
				 					success: function (result) 
										{
											
											localStorage.removeItem("amount");
											 var getdata=jQuery.parseJSON(result);
					   						var amount=getdata.amount;
					   						if(getdata.payment_type=='1')
					   						{
					   							var type="KongaPay";
					   						}else if(getdata.payment_type=='2')
					   						{
					   							var type="InterSwitch";
					   						}
									     	$("#wallet_error").modal();
				                			
				                			$("#amt11").text(mobile_amount);
				                			$("#rec_date1").text(getdata.failed_date);
				                			$("#order_id1").text(getdata.trans_id);
				                			$("#payment_type1").text(type);
				                			$("#pay_status1").text(getdata.failed_desc);
									     	
					   					}
									});
							
							});
						});
			
	</script>
	
<?php }
}

if(!empty($_POST['txnref']))
{
	$amt= $this->session->userdata('amt');
	 $product_id = '6804'; 

 $txn_ref = $_POST['txnref'];

$mackey = 'B668FF05B7B90C4A80F24FFC55DC2E1963F006CC861C215E5FD58CDABA70B52078FA481616A757D4CC7549A80ED4A6B8434381409D8CE0E0F6BACDC493291E6B';

$data = $product_id.$txn_ref.$mackey;

$hashed = hash('sha512', $data);

 $url = "https://stageserv.interswitchng.com/test_paydirect/api/v1/gettransaction.json?productid=$product_id&transactionreference=$txn_ref&amount=$amt";

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
 
  $user_id= $this->session->userdata('user_id'); 
  $coupon_id= $this->session->userdata('coupon_id'); 
  $coupon_amount= $this->session->userdata('coupon_amount');
   $recharge_category= $this->session->userdata('recharge_category_id'); 
  $recharge_number= $this->session->userdata('mobile_no');
   $payment_type= $this->session->userdata('pay_amount_status'); 
 	$mobile_amt= $this->session->userdata('amt')/100;
   $payment_type= $this->session->userdata('pay_amount_status'); 
    $operator_id= $this->session->userdata('operator_id'); 
	 $wt_category= $this->session->userdata('wt_category'); 
	
	 if($recharge_category=='4')
	{
			$biller_id= $this->session->userdata('biller_id'); 
		    $biller_category_id= $this->session->userdata('biller_category_id'); 
			$consumer_number= $this->session->userdata('consumer_number');
			$biller_service_id= $this->session->userdata('biller_service_id'); 
		  
	}
   ?>
  	
<script>
  var status='<?php echo $status;?>';
 
  if(status=='00')
  {
	$(document).ready(function(){
						$(window).on('load',function(){
						
						var myamount = localStorage.getItem("amount");
						var wt_category = localStorage.getItem("wt_category");	
						var recharge_category_id='<?php echo $recharge_category;?>'
						var recharge_number='<?php echo $recharge_number;?>'
						var recharge_amount='<?php echo $mobile_amt;?>'
						var trans_id='<?php echo $trans_id;?>'
						var recharge_type='<?php echo $payment_type;?>'
						if(recharge_type=='1' && recharge_category_id!='4' && recharge_category_id!='7'){
							var pay="recharge_from_wallet_with_card";
						}else if(recharge_type=='2' && recharge_category_id!='4' && recharge_category_id!='7'){
							var pay="recharge_from_card";
						}else if(recharge_type=='1' && recharge_category_id=='4'){
							var pay="bill_pay_from_card";
						}else if(recharge_type=='2' && recharge_category_id=='4'){
							var pay="bill_pay_card_with_wallet";
						}else if(recharge_type=='2' && recharge_category_id=='6'){
							var pay="donate_church_with_card";
						}else if(recharge_type=='1' && recharge_category_id=='7'){
							var pay="ticket_booking_payment_with_card";
						}else if(recharge_type=='2' && recharge_category_id=='7'){
							var pay="ticket_booking_payment_wallet_with_card";
						}
						
					if(recharge_category_id!='4' && recharge_category_id != '6' && recharge_category_id!='7')
				{
				 var data1=
				 {
				   'operator_id': '<?php echo $operator_id;?>',
				   'recharge_user_id': '<?php echo $user_id;?>',
				   'recharge_category_id': '<?php echo $recharge_category;?>',
				   'recharge_number': '<?php echo $recharge_number;?>',
				   'recharge_amount': '<?php echo $mobile_amt;?>',
				   'coupon_amount':'<?php echo $coupon_amount;?>',
	            	'coupon_id':'<?php echo $coupon_id;?>',
	            	'wt_category':wt_category,
	            	'payment_gateway_type':2,
	            	'payment_gateway_amt':myamount,
	            	'trans_ref_no':'<?php echo $txn_ref;  ?>'
				 }
			   }else if(recharge_category_id == '6')
				{
					
				 var data1=
				 {
				   'church_id': '<?php echo $operator_id;?>',
				   'donar_user_id': '<?php echo $user_id;?>',
				   'church_category_id': localStorage.getItem("church_category"),
				   'church_product_id': localStorage.getItem("church_p_id"),
				   'church_product_price': '<?php echo $mobile_amt;?>',
				    'wt_category':13,
				    'payment_gateway_type':2,
	            	'payment_gateway_id':trans_id,
	            	'payment_gateway_amt':myamount,
	            	'trans_ref_no':'<?php echo $txn_ref;  ?>'
				 }
			   }else if(recharge_category_id == '7')
				{
					
				var event_id= localStorage.getItem("event_id");
				 var data1=
				 {
				   'event_id': event_id,
				   'user_id': '<?php echo $user_id;?>',
				  'tickets_records': localStorage.getItem("ticket_json_array"),
				   'ticket_price': localStorage.getItem("ticket_amount"),
				   'church_product_price': mobile_amount,
				    'wt_category':wt_category,
	            	'payment_gateway_id':trans_id,
	            	'payment_gateway_type':2,
	            	'payment_gateway_price':myamount,
	            	'trans_ref_no':'<?php echo $txn_ref;  ?>'
	            	
				 }
			   }else if(recharge_category_id != '6' && recharge_category_id == '4' && recharge_category_id!='7'){
			   
			   	 var data1=
				 {
				   'operator_id': '<?php echo $operator_id;?>',
				   'recharge_user_id': '<?php echo $user_id;?>',
				   'bill_category_id': '<?php echo $recharge_category;?>',
				   'bill_consumer_no': '<?php if(!empty($consumer_number)) echo $consumer_number;?>',
				   'bill_amount': '<?php echo $mobile_amt;?>',
				   'coupon_amount':'<?php echo $coupon_amount;?>',
	            	'coupon_id':'<?php echo $coupon_id;?>',
	            	'wt_category':11,
	            	'payment_gateway_type':2,
	            	'payment_gateway_amt':myamount,
	            	'trans_ref_no':'<?php echo $txn_ref;  ?>',
	            	'biller_id':<?php if(!empty($biller_id)) {  echo $biller_id; } else { echo "1"; } ?>
	            	
				 }
			   }
			   if(myamount){
			$.ajax({
				url: base_url+pay,
				 type: "POST",
				data: data1,
				 success: function (data) 
					{
					
						$("#overlay").removeClass('active');
					     var getdata=jQuery.parseJSON(data);
					   var status=getdata.status;
                		var message=getdata.message;
                		if(status=='true'){
                			localStorage.removeItem("amount");
                			$.ajax({
									url: site_url+"remove_session_coupon",
									 type: "POST",
									data: {
										'coupon_amount':'<?php echo $coupon_amount;?>',
						            	'coupon_id':'<?php echo $coupon_id;?>'
						            	 },
				 					success: function (data) 
										{
											localStorage.removeItem("amount");
					     	
					   					}
									});
                			
                			$("#recharge").modal();
                			var wallet=getdata.wallet_amount;
                		if(recharge_category_id=='1'){
                			$("#charge").attr("onclick", "another_mobile_recharge()");
                			}else if(recharge_category_id=='2'){
                				$("#another_recharge").attr("onclick", "tv_rech()");
                			}else if(recharge_category_id=='3'){
                				$("#another_recharge").attr("onclick", "data_recharge()");
                			}else if(recharge_category_id == '5') {
								$("#another_recharge").attr("onclick", "electricity_recharge()");
							}else if(recharge_category_id == '4') {
								$("#another_recharge").attr("onclick", "bill_recharge()");
							}
							if(recharge_category_id == '5')
							{
								$("#electricity_response").html('Electricity recharge');
							}else
							if(recharge_category_id == '4')
							{
								$("#electricity_response").html('Bill Recharge');
							}else
							if(recharge_category_id == '6')
							{
								$("#electricity_response").html('Ticket Booking');
							}
                		
                		$("#amnt").text(recharge_amount);
                		if(getdata.electricity_prepaid_token)
						{
							$("#order_id").text(getdata.electricity_prepaid_token);
							$("#elecrtic").html('Token No:');
						}else{
							$("#order_id").text(getdata.transaction_id);
						}
						if(recharge_category_id != '7')
							{
								$("#mob_num").text(recharge_number);
								$("#amnt").text(recharge_amount);
								$("#rec_date").text(getdata.recharge_date);
							}else{
								$("#rec_date").text(getdata.booking_date);
								$("#amt").text(getdata.booking_amount);
							}
                		
                		$(".wallet_amount").text(wallet);
                	
                		//$("#wallet_amounts").text(wallet);
                		$('#msg').attr('style','color: #337D75');
                		
                		}else if(status=='false'){
                			localStorage.removeItem("amount");
                			$("#recharge").modal();
                			$("#failed_status_response").html("Failed");
                			if(recharge_category_id != '7')
							{
								$("#mob_num").text(recharge_number);
								$("#amnt").text(recharge_amount);
								$("#rec_date").text(getdata.recharge_date);
								$("#amt").text(recharge_amount);
							}else{
								$("#rec_date").text(getdata.booking_date);
								$("#amt").text(getdata.booking_amount);
								$("#amt").text(getdata.booking_amount);
							}
                			$("#order_id").text(getdata.transaction_id);
                			$(".wallet_amount").text(wallet);
                			$('#msg').attr('style','color: red');
                			$("#coupon_amount").val('');
                				$("#coupon_id").val('');
                				//$("#recharge_failed").modal();
                		}
                		 $("#msg").text(message);        	
					   }
				});
				}else{
					location.href=site_url+"my_transaction";
				}

							});
						});
  		
		}else
		{
			$(document).ready(function(){
						$(window).on('load',function(){
							var wt_category = localStorage.getItem("wt_category");	
							var myamount = localStorage.getItem("amount");
							var txt_ref = localStorage.getItem("txn_ref_recharge");
							var church_category_id=localStorage.getItem("church_category");
							var recharge_category_id=wt_category
						var recharge_number='<?php echo $recharge_number;?>'
						var recharge_amount='<?php echo $mobile_amt;?>'
						var trans_id='<?php echo $trans_id;?>'
						var recharge_type='<?php echo $payment_type;?>'
						 if(recharge_category_id=='13'){
							var pay="donate_church_with_card_failed";
						}else
						if(recharge_category_id=='11'){
							var pay="bill_pay_failed";
						}else
						if(recharge_category_id=='16'){
							var pay="ticket_booking_failed";
						}else{
						if(recharge_category_id!='13' && recharge_category_id!='11'&& recharge_category_id!='16'){
							var pay="recharge_failed";
						}		
						}
						 
					$.ajax({
									url: site_url+"re_query_webpay",
									 type: "POST",
									data: {
									
									   'txnref':txt_ref,
									   'amount':myamount
						            	
						            		
						            	
										  },
											 success: function (desc) 
												{
													
					if(recharge_category_id!='13' && recharge_category_id != '11'&& recharge_category_id != '16')
				{
				 var data1=
				 {
				   'operator_id': '<?php echo $operator_id;?>',
				   'recharge_user_id': '<?php echo $user_id;?>',
				   'recharge_category_id': '<?php echo $recharge_category;?>',
				   'recharge_number': '<?php echo $recharge_number;?>',
				   'recharge_amount': myamount,
				   'coupon_amount':'<?php echo $coupon_amount;?>',
	            	'coupon_id':'<?php echo $coupon_id;?>',
	            	'wt_category':wt_category,
	            	'failed_desc':desc,
	            	'payment_gateway_type':2,
	            	'payment_gateway_amt':myamount,
	            	'trans_ref_no':'<?php echo $txn_ref;  ?>'
				 }
			   }else if(recharge_category_id == '13')
				{
					
				 var data1=
				 {
				   'church_id': '<?php echo $operator_id;?>',
				   'donar_user_id': '<?php echo $user_id;?>',
				   'church_category_id': church_category_id,
				   'church_product_id': localStorage.getItem("church_p_id"),
				   'church_product_price': myamount,
				    'wt_category':13,
	            	'failed_desc':desc,
	            	'payment_gateway_type':2,
	            	'payment_gateway_amt':myamount,
	            	'trans_ref_no':'<?php echo $txn_ref;  ?>'
				 }
			   }else if(recharge_category_id == '16')
				{
					
				var event_id= localStorage.getItem("event_id");
				data1=
				 {
				   'event_id': event_id,
				   'user_id': '<?php echo $user_id;?>',
				   'tickets_records': localStorage.getItem("ticket_json_array"),
				   'ticket_price': localStorage.getItem("ticket_amount"),
				   'wt_category':wt_category,
	            	'payment_gateway_type':2,
	            	'failed_desc':desc,
	            	'payment_gateway_amt':myamount,
	            	'trans_ref_no':'<?php echo $txn_ref;  ?>'
	            	
				 }
			   }else if(recharge_category_id != '13' && recharge_category_id == '11' && recharge_category_id != '16'){
			   
			   	 var data1=
				 {
				   'operator_id': '<?php echo $operator_id;?>',
				   'recharge_user_id': '<?php echo $user_id;?>',
				   'bill_category_id': '<?php echo $recharge_category;?>',
				   'bill_consumer_no': '<?php if(!empty($consumer_number)) echo $consumer_number;?>',
				   'bill_amount': myamount,
				   'coupon_amount':'<?php echo $coupon_amount;?>',
	            	'coupon_id':'<?php echo $coupon_id;?>',
	            	'wt_category':11,
	            	'failed_desc':desc,
	            	'payment_gateway_type':2,
	            	'payment_gateway_amt':myamount,
	            	'trans_ref_no':'<?php echo $txn_ref;  ?>',
	            	'biller_id':<?php if(!empty($biller_id)) {  echo $biller_id; } else { echo "1"; } ?>
	            	
				 }
			   }
			  
							$.ajax({
									url: base_url+pay,
									 type: "POST",
									data: data1,
				 					success: function (result) 
										{
											
											localStorage.removeItem("amount");
											 var getdata=jQuery.parseJSON(result);
					   						var amount=getdata.amount;
					   						if(getdata.payment_type=='1')
					   						{
					   							var type="KongaPay";
					   						}else if(getdata.payment_type=='2')
					   						{
					   							var type="InterSwitch";
					   						}
									     	$("#wallet_error").modal();
				                			
				                			$("#amt11").text(amount);
				                			$("#rec_date1").text(getdata.failed_date);
				                			$("#order_id1").text(getdata.trans_id);
				                			$("#payment_type1").text(type);
				                			$("#pay_status1").text(getdata.failed_desc);
				                			$("#trans_ref").text(txt_ref);
					   					}
									});
							}
							});
						});
						});
			
		}
		
	
  </script>
  	
  	
  <?php }}
?>
<div class="modal fade popup" id="recharge" tabindex="-1" role="dialog" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body modal-pop">
        <div class="close-pop" data-dismiss="modal" aria-label="Close"><i class="fa fa-close" onclick="recharge_to_transaction()"></i></div>
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-sm-8 col-xs-7 col-620 text-center offser-auto">
            <h2 class="text-green">Your <span id="electricity_response">recharge </span> for ₦ <span id="amnt"></span> is <span id="failed_status_response">successfully</span></h2>
            <div class="text-green"><span id="mob_num"></span></div>
            <div class="pop-order"> <span id="elecrtic">Order ID: </span><span id="order_id"></span> Date: <span id="rec_date"></span> </div>
          </div>
        </div>
       
      </div>
      <div class="clearfix"></div>
    </div>
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>

<!-- recharge failed popup-->
<div class="modal fade popup" id="transaction_failed" tabindex="-1" role="dialog" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body modal-pop">
        <div class="close-pop" data-dismiss="modal" aria-label="Close"><i class="fa fa-close" onclick="recharge_to_transaction()"></i></div>
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-sm-8 col-xs-7 col-620 text-center offser-auto">
            <h2 class="text-green">Your recharge for ₦ <span id="failed_amt"></span> is Failed</h2>
            <div class="text-green"><span id="failed_mob_num"></span></div>
            <div class="pop-order">
            	 Order ID: <span id="failed_order_id"></span> Date: <span id="failed_rec_date"></span> 	
            </div>
          </div>
        </div>
        <div class="pop-btn">
          <input type="hidden" id="rec_type_repeat" value="" />
          <a class="btn btn-green"  onclick="recahrge_again()" id="recahrge_again" href="#">Recharge Again</a> </div>
      </div>
      <div class="clearfix"></div>
    </div>
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>


<div class="modal fade popup" id="wallet_error" tabindex="-1" role="dialog" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body modal-pop">
      <div class="close-pop" data-dismiss="modal" aria-label="Close"><i class="fa fa-close" onclick="recharge_to_transaction()"></i></div>
        <div class="row">
        	<div class="col-sm-8 col-xs-7 col-620 text-center offser-auto">
            	<h2 class="text-green"> Transaction Failed</h2>
            </div>
        </div>
        <div class="pop-order">
        	<div class="row">
        		<div class="col-sm-6 col-xs-12">
        			<div class="amount-fld">₦ <span id="amt11"></span> </div> 
        			Trans Ref ID: <span id="trans_ref"></span><br/>
        			Order ID: <span id="order_id1"></span><br/>
        			Date: <span id="rec_date1"></span></br>
        		</div>
        		<div class="col-sm-6 col-xs-12">
        			Paymeht Type :  <span id="payment_type1"></span><br/>
          Status: <span id="pay_status1"></span>
        		</div>
        	</div>
           
      </div>
      </div>
     
      <div class="clearfix"></div>
     
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
