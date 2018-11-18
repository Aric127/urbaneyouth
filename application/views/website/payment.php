<div class="after_login_page">
<div class="pdd15">
      <div class="modal-body pdd0"> <span id="msg" ></span>
      	<h5>Order Summary</h5>
        
        <div class="media">
        	<div class="media-left">
				<?php if($recharge_category_id=='4'){?>
                <img src="<?php echo base_url('uploads/biller_company_logo').'/'.$bill_details[0]->biller_company_logo; ?>" width="80">
                <?php }else{?>
                <img src="<?php echo base_url('uploads/operator').'/'.$operator_image; ?>"width="50">
                <?php }?>
            </div>
            <div class="media-body">
                <h4 id="number1" class="m"><?php echo $mobile; ?></h4>
                <p id="recharge_money">₦ <?php echo $mobile_amount; ?></p>
                <input type="hidden" id="amt" value="<?php echo $mobile_amount; ?>" />
            </div>
        </div>
        <h5>Coupons picked</h5>
        <div class="cpoupons" id="free_oupons">
        	<!--
			<p class="cpoupon-name">The Fourfountains Spa x 1</p>
						<p class="coupon-count">₦ 0 <span class="delete"><i class="fa fa-close"></i></span></p>-->
			
        </div>
        </div>
        <div class="apply-promo">
          <input type="text" class="promo" placeholder="Enter Freefund / Promocode" id="promo_code">
          <input type="hidden" id="coupon_amount" value="">
          <input type="hidden" id="coupon_id" value="">
          <input type="submit" class="promo-btn" value="Apply" onclick="apply_promocode()">
          <div id="coupon_status" style="color:red;"></div>
        </div>
        <div class="clearfix"></div>
        <div class="card_holder">
        <!-- Nav tabs -->
        
        <ul class="nav nav-tabs" role="tablist">
          <!--li role="presentation" ><a href="#Savedcard" aria-controls="home" role="tab" data-toggle="tab">Saved Card</a></li-->
          <li role="presentation" class="active">
          	<!--<a href="#cards" aria-controls="profile" role="tab" data-toggle="tab">Pay from Card</a>-->	
          	  <div class="pull_left">
        		<div class="cart_total">
          			<div style="margin-top: 8px" id="kpay-pay-component" onclick="set_local_val()">
          	    	</div>
       			 </div>
    </div>
          	 <script src="https://sandbox.kongapay.com/plugins/web-plugin/js/kpay-sand.min.js"></script>
          	 <script>
			//localStorage.setItem("amount",<?php  // echo $payble_amount;?>);
			var myamount = '';
		function set_local_val () {
			  
			
			myamount = localStorage.getItem("amount");
			alert(myamount);
		}
			new KongaPay({
    			
			        buttonSize: 140,
			        merchantId: "testmerchant",
			        merchantName: "KongaPay Test",
			        callBack: "<?php echo site_url('website/callback')?>",
			        transactionReference: '<?php echo $payble_amount.",".$mobile.",".$recharge_category_id.",".$mobile_operator_id.",".rand(111,999);?>',
			        amount: myamount,
			        description: "Testing Payment with KongaPay"
    			});
    		//}
</script>
          	</li>
          <li role="presentation">
            <input type="hidden"  id="pin_type" value="<?php echo "2_1";?>"/>
            <a id="pay_wallet" class="btn"  onclick="recharge_from_wallet()" aria-label="Close" data-dismiss="modal" >Pay from Wallet</a> </li>
          </div>
        </ul>
      </div>
      </div>