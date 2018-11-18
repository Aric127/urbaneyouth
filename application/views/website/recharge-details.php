


<?php   $user_id= $this->session->userdata('user_id');?>
<?php  $wallet= $my_profile->user_pin_status;
 $pin_status= $this->session->userdata('user_pin_status');
 ?>
<!--<script src="https://sandbox.kongapay.com/plugins/web-plugin/js/kpay-sand.min.js"></script>-->
<div class="modal fade popup" id="recharge" tabindex="-1" role="dialog" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body modal-pop">
        <div class="close-pop" data-dismiss="modal" aria-label="Close"><i class="fa fa-close" onclick="recharge_to_transaction()"></i></div>
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-sm-8 col-xs-7 col-620 text-center offser-auto">
            <h2 class="text-green">Your <span id="electricity_response">recharge</span> for ₦ <span id="amt"></span> is successfully</h2>
            <div class="text-green"><span id="mob_num"></span></div>
            <div class="pop-order"><span id="elecrtic">Order ID: </span> <span id="order_id"></span> Date: <span id="rec_date"></span> </div>
           
          </div>
        </div>
        <div class="pop-btn">
          <input type="hidden" id="rec_type_repeat" value="" />
          <a class="btn btn-green"  onclick="another_mobile_recharge()" id="another_recharge" href="#">Do Another Recharge</a> </div>
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
   <!--       <a class="btn btn-green"  onclick="recahrge_again()" id="recahrge_again" href="#">Recharge Again</a> -->
          </div>
      </div>
      <div class="clearfix"></div>
    </div>
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>


<div class="modal fade popup" id="t_c" tabindex="-1" role="dialog" data-backdrop="static">
	
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body modal-pop">
        <div class="close-pop" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></div>
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-sm-8 col-xs-7 col-620 text-center offser-auto">
            <h2 class="text-green">Terms & Conditions</h2>
            <div class="text-green" id="terms">
            	
            </div>
            
           
          </div>
        </div>
      
      </div>
      <div class="clearfix"></div>
    </div>
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>



<div class="modal fade popup" id="donation" tabindex="-1" role="dialog" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body modal-pop">
        <div class="close-pop" data-dismiss="modal" aria-label="Close"><i class="fa fa-close" onclick="recharge_to_transaction()"></i></div>
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-sm-8 col-xs-7 col-620 text-center offser-auto">
            <h2 class="text-green">Your Donation of ₦ <span id="donation_amount"></span> is successfully doen</h2>
            <div class="text-green"><span id="mob_num"></span></div>
            <div class="pop-order"><span id="elecrtic">Order ID: </span> <span id="trans_id"></span> Date: <span id="donation_date"></span> </div>
           
          </div>
        </div>
        <div class="pop-btn">
          <input type="hidden" id="another_donation" value="" />
          <a class="btn btn-green"  onclick="another_mobile_recharge()" id="another_donation_amount" href="#">Do Another Donation</a> </div>
      </div>
      <div class="clearfix"></div>
    </div>
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>
<script>
	$(document).ready(function()
		{
			$(window).on('load',function()
			{
				localStorage.setItem("user_id",<?php echo $user_id; ?>);
				localStorage.setItem("wallet_amt",<?php echo $my_wallet; ?>);
				
			});
		});
</script>



<!-- /.modal -->
<div class="after_login_page">
  <div class=""> 
    <!--div class="or_devider">
            	<div class="or">
                	OR
                </div>
            </div-->
    <?php if(!empty($pay_status)){ ?>
    <script>
		$(document).ready(function()
		{
			$(window).on('load',function()
			{
				$("#pay_wallet").hide();
				$('.card_show').addClass('active');
			});
		});
</script>
    <?php }?>
    <?php if($recharge_category_id=='1' || $recharge_category_id=='2' || $recharge_category_id=='3'){ ?>
    <script>
	$(document).ready(function()
		{
			localStorage.setItem("amount",<?php echo $payble_amount; ?>);
			localStorage.setItem("pay_status_wallet",'1');
			$(window).on('load',function()
			{
				
				$("#wt_category").val('2');
				localStorage.setItem("wt_category",'2');
				
			});
		});
</script>
    <?php }else if($recharge_category_id=='4' ){ ?>
    <script>
	$(document).ready(function()
		{
			$(window).on('load',function()
			{
				$("#wt_category").val('11');
				localStorage.setItem("wt_category",'11');
				
			});
		});
</script>
    <?php }else if($recharge_category_id=='5' ){ ?>
    <script>
	$(document).ready(function()
		{
			$(window).on('load',function()
			{
				$("#wt_category").val('12');
				localStorage.setItem("wt_category",'12');
			});
		});
</script>
    <?php } else if($recharge_category_id=='6' ){ ?>
    	 <script>
			$(document).ready(function()
			{
				$(window).on('load',function()
					{
						
						$("#wt_category").val('13');
						localStorage.setItem("wt_category",'13');
						localStorage.setItem("church_category",'<?php echo $church_category_id; ?>');
						localStorage.setItem("church_p_id",'<?php echo $church_p_id; ?>');
						localStorage.setItem("amount",<?php echo $payble_amount; ?>);
					});
			});
</script>
    	<?php
    	$mobile='1';
    	 } else if($recharge_category_id=='7' ){ ?>
    	 	<script>
			$(document).ready(function()
			{
				$(window).on('load',function()
					{
						
						$("#wt_category").val('16');
						localStorage.setItem("wt_category",'16');
						localStorage.setItem("event_id",'<?php echo $mobile_operator_id; ?>');
						localStorage.setItem("amount",'<?php echo $mobile_amount; ?>');
						localStorage.setItem("ticket_json",<?php echo $this->session->userdata('ticket_json_array'); ?>);
					});
			});
</script>
    	 	<?php } ?>
    	 
    <h3>
      <?php if($recharge_category_id=='1'){ echo "Mobile Recharge";}else if($recharge_category_id=='2'){ echo "TV, DTH Recharge";}else if($recharge_category_id=='3'){ echo "Data Card Recharge";}else if($recharge_category_id=='4'){ echo "Pay Bill";}else if($recharge_category_id=='5'){ echo "Electricity Bill";}else if($recharge_category_id=='7'){ echo "Event Ticket Booking";} ?>
    </h3>
    <?php if(!empty($bill_details[0]->biller_user_name)) echo $bill_details[0]->biller_user_name; ?>
    <?php  if(!empty($bill_details))  if($bill_details[0]->bill_pay_status=='1'){ ?>
    <p>Bill Status- <span>
      <?php if(!empty($bill_details))  if($bill_details[0]->bill_pay_status=='1'){ echo "Bill paid" ;}?>
      </span></p>
    <p>Bill Date <span> <?php echo $bill_paid_date;?></span></p>
    <p>Transaction ID <span><?php echo $bill_transaction_no;?></span></p>
    <?php }?>
    <div class="row">
      <div class="gray-border">
        <div class="col-sm-3 col-xs-6 min-height-border">
          <div class="media">
            <div class="media-left">
              <?php if($recharge_category_id=='4'){?>
              <img src="<?php echo base_url('uploads/biller_company_logo').'/'.$bill_details[0]->biller_company_logo; ?>" width="80">
              <?php }
              else if($recharge_category_id=='6'){?>
              <img src="<?php echo base_url('uploads/church_image').'/'.$operator_image; ?>"width="100">
              <?php }else if($recharge_category_id=='7'){ ?>
              	   <img src="<?php echo $operator_image; ?>"width="100">
           <?php   } else{?>
              <img src="<?php echo base_url('uploads/operator').'/'.$operator_image; ?>"width="50">
              <?php }?>
            </div>
            <div class="media-body">
              <div class="recharge_detail">
                <h4 id="number1" class="m"><?php if($recharge_category_id!=6 && $recharge_category_id!=7 ){ echo $mobile; }?></h4>
                <p id="operator_name"><?php echo $operator_name; ?> </p>
                <input type="hidden"  id="transfer_pin_status" value="<?php echo $pin_status;?>"/>
                <input type="hidden" id="pay_status" value="<?php if(!empty($pay_status)){ echo $pay_status; } ?>">
                <input type="hidden" id="user_id" value="<?php echo $user_id;?>">
                <input type="hidden" id="recharge_category_id" value="<?php echo $recharge_category_id?>">
                 <input type="hidden" id="church_category_id" value="<?php if(!empty($church_category_id)) echo $church_category_id?>">
                 <input type="hidden" id="church_biller_id" value="<?php if(!empty($church_biller_id)) echo $church_biller_id?>">
                   <input type="hidden" id="church_p_id" value="<?php if(!empty($church_p_id)) echo $church_p_id?>">
                <input type="hidden" id="operator_id" value="<?php echo $mobile_operator_id;?>">
                <input type="hidden" id="wt_category" value="" >
                <input type="hidden" id="recharge_amount" value="<?php echo $mobile_amount;?>">
                <input type="hidden" id="recharge_number" value="<?php if($recharge_category_id!=6 && $recharge_category_id!=7){ echo $mobile; }?>">
                <input type="hidden" id="biller_category_id" value="<?php if(!empty($biller_category_id)) echo $biller_category_id;?>">
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-3 col-xs-6 min-height-border">
          <div class="recharge_detail">
            <h4 id="number1" class="m">
              <?php if($recharge_category_id=='4'){?>
              Bill
              <?php }else if($recharge_category_id=='6'){?>
              Donation
              <?php } else if($recharge_category_id=='7'){ ?>
              Ticket Booking
              <?php }else{ echo "Recharge" ;}?>
              Amount</h4>
            <p id="recharge_money">₦ <?php echo $mobile_amount; ?></p>
       <input type="hidden" id="recharge_amt_without_wallet" value="<?php echo $mobile_amount; ?>" />
       <input type="hidden" id="recharge_amt_with_wallet" value="<?php echo $payble_amount; ?>" />
       <input type="hidden" id="my_current_wallet" value="<?php echo $my_wallet; ?>" />
          </div>
        </div>
        <?php ?>
        <div class="col-sm-3 col-xs-6 min-height-border">
          <div class="recharge_detail">
            <h4 id="" class="m">Wallet Cash</h4>
            <p id="my_wallet">₦ <?php echo $my_wallet; ?></p>
          </div>
        </div>
        <div class="col-sm-3 col-xs-6 min-height-border">
          <div class="recharge_detail">
            <h4 id="" class="m">Payble Amount</h4>
            <p id="payble_amount">₦ <?php echo $payble_amount; ?></p>
          </div>
        </div>
        <div class="promocodearrow"></div>
      </div>
      
    </div>
    </div>
    <div class="clearfix"></div>
     <label>
    <input type="checkbox" id="pay_card_only" value="1" checked="checked" onclick="pay_card_value()">
       Use wallet 
    </label>
    <!--<div class=""><a  class="btn btn-green" data-toggle="modal" data-target="#">PROCEED TO PAY</a> </div>-->
    <div class=""><a  class="btn btn-green" onclick="check_recharge_pin()">PROCEED TO PAY</a> </div>
    
    <div class="card_holder">
      <h3 class="">Unlimited offers with your recharge.</h3>
      <div class="clearfix"></div>
      <br />
      <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#OfferCat1" aria-controls="home" role="tab" data-toggle="tab" onclick="get_all_coupon()">All</a></li>
        <?php foreach($coupon_category as $v){ ?>
        <li role="presentation" ><a href="#OfferCat2" aria-controls="profile" role="tab" data-toggle="tab" onclick="get_coupon_cat_id(<?php echo $v->free_coupon_category_id ?>)" ><?php echo $v->free_coupon_category_name; ?>
        	
        </a></li>
       
        <?php } ?>
      </ul>
      <!-- Tab panes -->
      <div class="tab-content" id="coupons">

      	 
      	<div role="tabpanel" class="tab-pane active" id="OfferCat1">
          <div class="row">
          <?php foreach($coupon_list as $v){ ?>
            <div class="col-md-3 col-sm-4 col-xs-2">
              <div class="offer_holder"> <img src="<?php echo free_coupon_image.'/'.$v->coupon_img;?>" alt="..."/>
                <div class="offer_info">
                  <h3><?php echo $v->coupon_description ?></h3>
                   <span style="position:absolute; bottom:0px; background: #78C2BB; color:#fff; padding:3PX; font-size: 14px; right:0;cursor: pointer" onclick="show_terms_condtions('<?php echo $v->free_coupon_id; ?>')" >T&C</span>
                </div>
                <div class="circle-offer add_offer" onclick="add_coupon_offer('<?php echo $v->free_coupon_id; ?>')"> Get Offer </div>
              </div>
            </div>
              <?php } ?>
      </div>
    </div>
  </div>
</div>
	

<!------------- Recgarege payment step -------------->
<div class="modal fade popup" id="rechargeStep" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="pdd15">
      <div class="modal-body pdd0"> <span id="msg" ></span>
      	<h5>Order Summary</h5>
        
        <div class="media">
        	<div class="media-left">
				<?php if($recharge_category_id=='4'){?>
                <img src="<?php echo base_url('uploads/biller_company_logo').'/'.$bill_details[0]->biller_company_logo; ?>" width="80">
                <?php }else if($recharge_category_id=='6'){ ?>
                	
					  <img src="<?php echo base_url('uploads/church_image').'/'.$operator_image; ?>"width="100">
					   
			 <?php }else if($recharge_category_id=='7'){ ?>
              	   <img src="<?php echo $operator_image; ?>"width="100">
           <?php         }          else{?>
                <img src="<?php echo base_url('uploads/operator').'/'.$operator_image; ?>"width="50">
                <?php }?>
            </div>
            <div class="media-body">
                <h4 id="number1" class="m"><?php if($recharge_category_id!=6 && $recharge_category_id!=7){ echo $mobile; } ?></h4>
                <?php if($recharge_category_id=='6'){ ?>
                 <p id="recharge_money">Church Name : <?php  echo $operator_name; ?></p>
                 <?php }else if($recharge_category_id=='7'){ ?>
                 	 <p id="recharge_money">Event Name : <?php  echo $operator_name; ?></p>
               <?php  } ?>
                <p id="recharge_money">₦ <?php  echo $mobile_amount; ?></p>
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
        <div class="clearfix"></div>
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
          			<div style="margin-top: 8px" id="kpay-pay-component" >
          	    	</div>
       			 </div>
    			</div>
         <script src="https://www.kongapay.com/plugins/web-plugin/js/kpay.min.js"></script>
          	 <script>
		
			function showModal() {
			
			var user_id = localStorage.getItem("user_id");
			get_cart_coupon(user_id);
			$("#rechargeStep").modal();
			var wallet_amt = localStorage.getItem("wallet_amt");
			var sendAmnt = 	localStorage.getItem("amount");
			var pay_Amnt_status = 	localStorage.getItem("pay_status_wallet");
			var wt_category=localStorage.getItem("wt_category");
			localStorage.setItem("mobile_amount",'<?php echo $mobile_amount;?>');
			localStorage.setItem("mobile",'<?php echo $mobile;?>');
			localStorage.setItem("recharge_category_id",'<?php echo $recharge_category_id;?>');
			localStorage.setItem("mobile_operator_id",'<?php echo $mobile_operator_id;?>');
			
			payment_interswitch_gateway(user_id,wallet_amt,sendAmnt,pay_Amnt_status,'<?php echo $mobile; ?>','<?php echo $recharge_category_id; ?>','<?php echo $mobile_operator_id; ?>',wt_category);
			new KongaPay({
    			
			        buttonSize: 140,
			        merchantId: "oyarecharge",
			       merchantName: "KongaPay",
			        callBack: "<?php echo site_url('website/callback')?>",
			        transactionReference: "TEST-" + Math.floor((Math.random() * 99999999) + 1),
			        amount: sendAmnt,
			       description: "Payment with KongaPay"
    			});
    		}
    	
</script>
          	</li>
 <li role="presentation" id="interswitch_pay_gateway">
   <form name="form1" action= "<?php echo webpay_url; ?>" method="post">
    <input name="product_id" type="hidden" value="<?php echo webpay_product_id; ?>" />
    <input name="amount" id="amt1" type="hidden" value="" />
    <input name="currency" type="hidden" value="566" />
    <input name="payment_params" type="hidden" value="" />
    <input name="site_redirect_url" type="hidden" value='<?php echo site_url("website/callback") ?>'/>
    <input name="site_name" type="hidden" value="http://localhost/" />
     <input name="cust_id" id="cust_id" type="hidden" value="" />
    <input name="cust_id_desc" type="hidden" value="Value Name" />
    <input name="txn_ref" id="txn_r1" type="hidden" value="" />
    <input name="pay_item_id" type="hidden" value="101" />
    <input name="pay_item_name" type="hidden" value="Payment Name" />
   <input name="xml_data" type="hidden" id="xml_d2" value='' />
<input name="cust_name" type="hidden" value="<?php echo $my_profile->user_name; ?>" />
    <input name="cust_name_desc" type="hidden" value="Full name" />
    <input name="hash" type="hidden" value="" id="hash1"/>
    <input type="submit" class="btn  webpay-btn" value=" ">  
</form>
          	</li>
          	
          	
          <li role="presentation">
            <input type="hidden"  id="pin_type" value="<?php echo "2_1";?>"/>
            <a id="pay_wallet" class="btn"  onclick="pay_from_wallet()" aria-label="Close" data-dismiss="modal" >Pay from Wallet</a> </li>
          </div>
        </ul>
    
            
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.modal-content --> 
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal-backdrop customdrop fade" style="display: none"></div>