<?php   $user_id= $this->session->userdata('user_id');?>
<?php $wallet= $my_profile->wallet_amount;
 $pin_status= $this->session->userdata('user_pin_status');

 ?>
<script>
	$(document).ready(function()
		{
			$(window).on('load',function()
			{
			
				localStorage.setItem("user_pin_status",<?php echo $pin_status; ?>);
				
				
			});
		});
</script>

	<div class="after_login_page">
     	<h3 class="text-green">Balance ₦ <span id="wallet"><?php echo $wallet; ?></span></h3>
        <br>
        <div id="status" style="color: #337d75"></div>
        <h3>Add Money</h3>
         <div class="profile-box">
        	<div class="form-group">
            	<input class="input" type="text" placeholder="Enter Amount" id="amount" onblur="check_amount()" value="<?php if(!empty($amount)){ echo $amount; } ?>"/>
            	<div id="amt_msg"></div>
            	<input type="hidden"  id="user_id" value="<?php echo $user_id;?>"/>
            	<input type="hidden"  id="pin_type" value="<?php echo "1";?>"/>
            	<input type="hidden"  id="transfer_pin_status" value="<?php echo $pin_status;?>"/>
            </div>
            <p id="amount_error"> </p>
        </div>
        <div class="clearfix"></div>

        <div class="card_holder">
        	<!-- Nav tabs -->
              <!-- Tab panes -->
              <div class="">
                <div role="tabpanel" class="tab-pane active" id="cards">
                	<div class="card_box">
                    	<div class="form-group">
                        	<h4>Pay with</h4>
                        </div>
                      
                        <div class="clearfix"></div>
                        <div class="apply-promo form-group">
                            <input type="text" class="promo" placeholder="Apply Promocode" id="promo_code" value="">
                            <input type="hidden" id="coupon_amount" value="">
                            <input type="hidden" id="coupon_id" value="">
                            <input type="submit" class="promo-btn" value="Apply" onclick="apply_promocode_add_wallet()"> <div id="coupon_status" style="color:red;"></div>
                        </div>
      <div id="payment_gateway" style="display: none">
        <script src="https://www.kongapay.com/plugins/web-plugin/js/kpay.min.js"></script>
  			<div class="form-group">
               <div class="cart_total">
          			<div style="margin-top: 8px" id="kpay-pay-component" ></div>
       		   </div>
       		  
    		</div>
         <script>
         function wallet_add(){
         $("#new_pay").attr('style', 'display:Block ');
         	var sendAmnt = 	localStorage.getItem("add_wallet_amt");
		//	var sendAmnt = 100;
			new KongaPay({
    			
			        buttonSize: 140,
			        merchantId: "oyarecharge",
			        merchantName: "KongaPay",
			        callBack: "<?php echo site_url('website/wallet_callback')?>",
			        transactionReference: "Pay-" + Math.floor((Math.random() * 99999999) + 1),
			        amount: sendAmnt,
			        description: "Payment with KongaPay"
    			});
    		}
      </script>
      
     </div>
      <div class="cart_total" style="display: none" id="new_pay">
<!--https://stageserv.interswitchng.com/test_paydirect/pay-->
<form name="form1" action= "<?php echo webpay_url; ?>" method="post">
    <input name="product_id" type="hidden" value="<?php echo webpay_product_id; ?>" />
    <input name="amount" id="amt" type="hidden" value="" />
    <input name="currency" type="hidden" value="566" />
    <input name="payment_params" type="hidden" value="" />
    <input name="site_redirect_url" type="hidden" value='<?php echo site_url("website/wallet_callback") ?>'/>
    <input name="site_name" type="hidden" value="<?php echo site_url("website/wallet_callback") ?>" />
    <input name="cust_id" type="hidden"  id="cust_id" value="" />
    <input name="cust_id_desc" type="hidden" value="Value Name" />
    <input name="txn_ref" id="txn_r" type="hidden" value="" />
    <input name="pay_item_id" type="hidden" value="101" />
    <input name="pay_item_name" type="hidden" value="Payment Name" />
   <input name="xml_data" type="hidden" id="xml_d" value='' />
    <input name="cust_name" id="cust_name" type="hidden" value="<?php echo $my_profile->user_name; ?>" />
    <input name="cust_name_desc"  type="hidden" value="Full name" />
    <input name="hash" type="hidden" value="" id="hash"/>
    <input class="webpay-btn2" type="submit">
</form>
       	</div>
        	<a id="add_money_btn" class="btn btn-green" onclick="add_money()">PROCEED TO PAY</a>
                       
                    </div>
                </div>
              </div>
        </div>
    </div>
    <!-- <div class="card_holder"> -->
    <?php
    
    // if(isset($_POST)){
    	// echo "<pre>";
		// print_r($_POST);
		// echo "</pre>";
    // }
	
	?>
	<!-- </div> -->
	
	
	

