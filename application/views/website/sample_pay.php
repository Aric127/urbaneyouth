<?php
//txn_ref + product_id + pay_item_id + amount + site_redirect_url + mackey
 $user_id=$_REQUEST['user_id'];
 $amount=$_REQUEST['amount'];

if(!empty($user_id) && !empty($amount))
{
	
?>
<script src="<?php echo base_url(); ?>webassets/js/jquery-1.11.1.min.js"></script>
    <script src="<?php echo base_url(); ?>webassets/js/config.js"></script>
<script>
	$(document).ready(function(){
		$(window).on('load',function(){
			
			var amount='<?php echo $amount;?>';
			var user_id='<?php echo $user_id;?>';
			
			$("#amt12").val('<?php echo $amount;?>'*100);
			var amt_detail = amount * 100;
			var detail = (amt_detail / 2)

	var xml_data = '<payment_item_detail><item_details detail_ref="REF1004" institution="ABC"><item_detail item_id="1" item_name="Butter" item_amt="' + detail + '" /><item_detail item_id="2" item_name="Juice" item_amt="' + detail + '" /></item_details></payment_item_detail>';

	$("#xml_d").val(xml_data);
		
						$.ajax({
						url : site_url + "craete_hash",
						'type' : 'POST',
						'data' : {
							'amount' : amount,
							'user_id':user_id
				
						},
						'success' : function(data) {
		
							var my_val = data.split(",");
							var hash_v = my_val[0];
							var txn_ref = my_val[1];
							var username = my_val[2];
							$("#hash").val(hash_v);
							$("#txn_r").val(txn_ref);
							$("#cust_id").val(txn_ref);
							$("#cust_name").val(username);
						    $("#form1").submit();
						}
					});
			});
		});
</script>

<?php } ?>
<!--form name="form1" action="" method="post">-->
<form name="form1" id="form1" action= "<?php echo webpay_url; ?>" method="post">
    <input name="product_id" type="hidden" value="<?php echo webpay_product_id; ?>" />
    <input name="amount" id="amt12" type="hidden" value="" />
    <input name="currency" type="hidden" value="566" />
    <input name="payment_params" type="hidden" value="" />
    <input name="site_redirect_url" type="hidden" value="<?php echo site_url("website/webview_response");?>"/>
    <input name="site_name" type="hidden" value="<?php echo site_url('website/') ?>" />
    <input name="cust_id" id="cust_id" type="hidden" value="" />
    <input name="cust_id_desc" type="hidden" value="Value Name" />
    <input name="txn_ref" id="txn_r" type="hidden" value="" />
    <input name="pay_item_id" type="hidden" value="101" />
    <input name="pay_item_name" type="hidden" value="Payment Name" />
    <input name="xml_data" id="xml_d" type="hidden" value='' />
 <input name="cust_name" id="cust_name" type="hidden" value="" />
    <input name="cust_name_desc" type="hidden" value="Full name" />
    <input name="hash" id="hash" type="hidden" value="" />
   
</form>





