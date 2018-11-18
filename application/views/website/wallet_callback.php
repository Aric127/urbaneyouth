
<?php
if(!empty($_GET['status'])){
if($_GET['status']=='success'){
	
		
	
// 1-mobile_amount. 2-recharge_number,3-recharge_category(1-mobile,2-dth,3-data),4-operator_id
		$payment_reference=$_GET['payment_reference']; // payment_reference
			$user_id= $this->session->userdata('user_id'); 
		    $coupon_id= $this->session->userdata('coupon_id'); 
			$coupon_amount= $this->session->userdata('coupon_amount'); ?>

	<script>
	var sendAmnt = 	localStorage.getItem("add_wallet_amt");
	
	if(sendAmnt){
				$(document).ready(function(){
						$(window).on('load',function(){
					
						var recharge_amt=sendAmnt;
						var user_id='<?php echo $user_id;?>';
					
			$.ajax({
				  url: base_url+"add_money",
						'type':'POST',
				          'data':{
				          
				            'recharge_user_id':user_id,
				       		'recharge_amount':recharge_amt,
				             'coupon_amount':'<?php echo $coupon_amount;?>',
	            			'coupon_id':'<?php echo $coupon_id;?>',
	            			'payment_gateway_type':1,
	            			'transection_id':'<?php echo $payment_reference;?>'
				         
			             	},
				 success: function (data) 
					{
					
							var getdata=jQuery.parseJSON(data);
			                var status=getdata.status;
			                var wallet_amount=getdata.wallet_amount;
			               	var message=getdata.message;
                			if(status=='true'){
                				
                				var transaction_id=getdata.transaction_id;
			    				$("#order_id").text(transaction_id);
			    				var order_date=getdata.transaction_date;
			    				$("#rec_date").text(order_date);
			    				$("#amt").text(recharge_amt);
                			$.ajax({
									url: site_url+"remove_session_coupon",
									 type: "POST",
									data: {
									
									   'coupon_amount':'<?php echo $coupon_amount;?>',
						            	'coupon_id':'<?php echo $coupon_id;?>'
						            	
										  },
				 success: function (data) 
					{
						localStorage.removeItem("add_wallet_amt");
					$("#wallet_popup").modal();
					     	
					   }
				});
                			
                			
                			
                		$("#recharge").modal();
                		var wallet=getdata.wallet_amount;
                	
                		$("#rec_date").text(getdata.recharge_date);
                		$("#amt").text(sendAmnt);
                		$("#order_id").text(getdata.transaction_id);
                	//	$("#mob_num").text(recharge_number);
                		$(".wallet_amount").text(wallet);
                		$("#amnt").text(sendAmnt);
                		//$("#wallet_amounts").text(wallet);
                		$('#msg').attr('style','color: #337D75');
                		
                		}else if(status=='false'){
                			$('#msg').attr('style','color: red');
                			$("#coupon_amount").val('');
                				$("#coupon_id").val('');
                		}
                		 $("#msg").text(message);        	
					   }
				});
				

							});
						});
					}else{
						location.href=site_url+"my_wallet"
					}
	 </script>
	
	 <?php
}else if($_GET['status']=='error'){ 
	$reffernce_var=$_GET['transaction_reference'];
		$user_id= $this->session->userdata('user_id'); ?>
<script>
$(document).ready(function(){
			$(window).on('load',function(){
				$("#trans_ref").text('<?php echo $reffernce_var;?>');
				var sendAmnt = 	localStorage.getItem("add_wallet_amt");
				$.ajax({
				  url: base_url+"failed_add_money",
						'type':'POST',
				          'data':{
				          
				            'recharge_user_id':'<?php echo $user_id;?>',
				       		'recharge_amount':sendAmnt,
				             'failed_desc':'<?php  if(!empty($ResponseDescription)){ echo $ResponseDescription;}else {
				             	 echo "Transaction failed by user";
				             };?>',
	            			'payment_gateway_type':'1'
	            	
	            			},
				 			success: function (result) 
									{
							
											localStorage.removeItem("add_wallet_amt");
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
				                			//location.href=site_url+"my_transaction";
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

 $url = "https://webpay.interswitchng.com/paydirect/api/v1/gettransaction.json?productid=$product_id&transactionreference=$txn_ref&amount=$amt";

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
  $user_id= $this->session->userdata('user_id'); 
  $coupon_id= $this->session->userdata('coupon_id'); 
  $coupon_amount= $this->session->userdata('coupon_amount'); ?>
  	
 <script>
  var status='<?php echo $status;?>';
 	var sendAmnt = 	localStorage.getItem("add_wallet_amount");
	if(sendAmnt!=''){
  if(status=='00')
  {
	
  		$(document).ready(function(){
			$(window).on('load',function(){
			$.ajax({
				  url: base_url+"add_money",
						'type':'POST',
				          'data':{
				          
				            'recharge_user_id':<?php echo $user_id;?>,
				       		'recharge_amount':<?php echo $amount;?>,
				             'coupon_amount':'<?php echo $coupon_amount;?>',
	            			'coupon_id':'<?php echo $coupon_id;?>',
	            			'transection_id':'<?php echo $trans_id;?>',
	            			'payment_gateway_type':'2',
	            			'trans_ref_no':'<?php echo $txn_ref;  ?>'
				         
			             	},
				 success: function (data) 
					{
				
							var getdata=jQuery.parseJSON(data);
			                var status=getdata.status;
			                var wallet_amount=getdata.wallet_amount;
			               	var message=getdata.message;
                			if(status=='true'){
                				
                				var transaction_id=getdata.transaction_id;
			    				$("#order_id").text(transaction_id);
			    				var order_date=getdata.transaction_date;
			    				$("#rec_date").text(order_date);
			    				$("#amt").text('<?php echo $amount;?>');
                			$.ajax({
									url: site_url+"remove_session_coupon",
									 type: "POST",
									data: {
									
									   'coupon_amount':'<?php echo $coupon_amount;?>',
						            	'coupon_id':'<?php echo $coupon_id;?>'
						            		
						            	
										  },
											 success: function (data) 
												{
													//localStorage.removeItem("add_wallet_amt");
													//localStorage.removeItem("add_wallet_amt");
												$("#wallet_popup").modal();
												     	
												   }
											});
                			
                			
                			
                		$("#wallet_popup").modal();
                		var wallet=getdata.wallet_amount;
                	
                		$("#rec_date").text(getdata.recharge_date);
                		$("#amt").text('<?php echo $amount;?>');
                		$("#order_id").text(getdata.transaction_id);
                		//$("#mob_num").text(recharge_number);
                		$(".wallet_amount").text(wallet);
                		$("#amnt").text('<?php echo $amount;?>');
                		//$("#wallet_amounts").text(wallet);
                		$('#msg').attr('style','csendAmntolor: #337D75');
                		
                		}else if(status=='false'){
                			
                			$('#msg').attr('style','color: red');
                			$("#coupon_amount").val('');
                				$("#coupon_id").val('');
                		}
                		 $("#msg").text(message);        	
					   }
				});
				

			});
			});
		
		}
		else
		{
			$(document).ready(function(){
			$(window).on('load',function(){
				var txt_ref=localStorage.getItem("txn_ref");
					var sendAmnt = 	localStorage.getItem("add_wallet_amount");
					$.ajax({
									url: site_url+"re_query_webpay",
									 type: "POST",
									data: {
									
									   'txnref':txt_ref,
									   'amount':sendAmnt
						            	
						            		
						            	
										  },
											 success: function (data) 
												{
													
				$.ajax({
				  url: base_url+"failed_add_money",
						'type':'POST',
				          'data':{
				          
				            'recharge_user_id':'<?php echo $user_id;?>',
				       		'recharge_amount':sendAmnt,
				            'failed_desc':data,
	            			'payment_gateway_type':'2',
	            			'trans_ref_no':'<?php echo $txn_ref;  ?>'
	            			},
				 			success: function (result) 
									{
							
										//	localStorage.removeItem("add_wallet_amt");
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
				                			//location.href=site_url+"my_transaction";
					   					}
									});
							
							}
						});
												 });
											});
				
		}
		}else{
			location.href=site_url+"my_transaction"
		}
	
  </script>
  	
  	
  <?php }}
?>

<div class="modal fade popup" id="wallet_popup" tabindex="-1" role="dialog" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body modal-pop">
      <div class="close-pop" data-dismiss="modal" aria-label="Close"><i class="fa fa-close" onclick="recharge_to_transaction()"></i></div>
        <div class="row">
        	<div class="col-sm-8 col-xs-7 col-620 text-center offser-auto">
            	<h2 class="text-green">₦ <span id="amt"></span> Amount is successfully added in your wallet</h2>
                <div class="text-green"><span id="mob_num"></span></div>
            </div>
        </div>
      
      </div>
      <div class="clearfix"></div>
      <div class="pop-order">
          Order ID: <span id="order_id"></span><br/>
          Date: <span id="rec_date"></span>
      </div>
      <div class="clearfix"></div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->




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
