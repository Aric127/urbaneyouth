



<?php   $user_id= $this->session->userdata('user_id');?>
<?php  $wallet= $my_profile->user_pin_status;
 $pin_status= $this->session->userdata('user_pin_status');
 ?>
<script src="https://sandbox.kongapay.com/plugins/web-plugin/js/kpay-sand.min.js"></script>

<div class="modal fade popup" id="recharge" tabindex="-1" role="dialog" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body modal-pop">
        <div class="close-pop" data-dismiss="modal" aria-label="Close"><i class="fa fa-close" onclick="recharge_to_transaction()"></i></div>
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-sm-8 col-xs-7 col-620 text-center offser-auto">
            <h2 class="text-green">Your recharge for ₦ <span id="amt"></span> is successfully</h2>
            <div class="text-green"><span id="mob_num"></span></div>
            <div class="pop-order"> Order ID: <span id="order_id"></span> Date: <span id="rec_date"></span> </div>
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
<script>
	$(document).ready(function()
		{
			$(window).on('load',function()
			{
				localStorage.setItem("user_id",<?php echo $user_id; ?>);
				localStorage.setItem("wallet_amt",<?php echo $my_wallet; ?>);
				get_cart_coupon('<?php echo $user_id; ?>');
			});
		});
</script>



<!-- /.modal -->
<div class="after_login_page" id="offertop">
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
				
			});
		});
</script>
    <?php }else{ ?>
    <script>
	$(document).ready(function()
		{
			$(window).on('load',function()
			{
				$("#wt_category").val('11');
				
			});
		});
</script>
    <?php } ?>
    <h3>
      <?php if($recharge_category_id=='1'){ echo "Mobile Recharge";}else if($recharge_category_id=='2'){ echo "TV, DTH Recharge";}else if($recharge_category_id=='3'){ echo "Data Card Recharge";}else if($recharge_category_id=='4'){ echo "Pay Bill";} ?>
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
              <?php }else{?>
              <img src="<?php echo base_url('uploads/operator').'/'.$operator_image; ?>"width="50">
              <?php }?>
            </div>
            <div class="media-body">
              <div class="recharge_detail">
                <h4 id="number1" class="m"><?php echo $mobile; ?></h4>
                <p id="operator_name"><?php echo $operator_name; ?> </p>
                <input type="hidden"  id="transfer_pin_status" value="<?php echo $pin_status;?>"/>
                <input type="hidden" id="pay_status" value="<?php if(!empty($pay_status)){ echo $pay_status; } ?>">
                <input type="hidden" id="user_id" value="<?php echo $user_id;?>">
                <input type="hidden" id="recharge_category_id" value="<?php echo $recharge_category_id?>">
                <input type="hidden" id="operator_id" value="<?php echo $mobile_operator_id;?>">
                <input type="hidden" id="wt_category" value="" >
                <input type="hidden" id="recharge_amount" value="<?php echo $mobile_amount;?>">
                <input type="hidden" id="recharge_number" value="<?php echo $mobile;?>">
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
              <?php }else{?>
              Recharge
              <?php }?>
              Amount</h4>
            <p id="recharge_money">₦ <?php echo $mobile_amount; ?></p>
       <input type="hidden" id="recharge_amt_without_wallet" value="<?php echo $mobile_amount; ?>" />
       <input type="hidden" id="recharge_amt_with_wallet" value="<?php echo $payble_amount; ?>" />
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
        <div class="clearfix"></div>
        <div class="cpoupons">
        		<h4>Deals and Vouchers applied</h4>
        	<div class=""  id="free_oupons">
            
                <p class="pull-left">No Vouchers applied Yet! &nbsp;</p>
                <a href="#" onclick="clickscroll()" class="label label-warning form-group voucher pull-left">Get Offer</a>
                <div class="clearfix"></div>
               
                
            </div>
        </div>
        <div class="promocodearrow"></div>
        
        
      </div>
      
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
     <label>
    <input type="checkbox" id="pay_card_only" value="1" checked="checked" onclick="pay_card_value()">
       Use wallet 
    </label>
    <div class="clearfix"></div>
    <a  class="btn btn-green" id="kpay-pay-component"></a> 
    <input type="hidden"  id="pin_type" value="<?php echo "2_1";?>"/>
    <a id="pay_wallet" class="btn btn-green"  onclick="recharge_from_wallet()" aria-label="Close" data-dismiss="modal" >Pay from Wallet</a>
    
    <div class="card_holder" id='voucher'>
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
                </div>
                <div class="circle-offer add_offer_<?php echo $v->free_coupon_id; ?>" onclick="add_coupon_offer('<?php echo $v->free_coupon_id; ?>')"> <span>Get Offer</span><span class="addedoffer"><i class="fa fa-check"></i></span> </div>
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
        
        </div>
        
        <div class="clearfix"></div>
        <div class="card_holder">
        <!-- Nav tabs -->
       
        <ul class="nav nav-tabs" role="tablist">
          <!--li role="presentation" ><a href="#Savedcard" aria-controls="home" role="tab" data-toggle="tab">Saved Card</a></li-->
          <li role="presentation" class="active">
          	<!--<a href="#cards" aria-controls="profile" role="tab" data-toggle="tab">Pay from Card</a>-->	
          	  <div class="pull_left">
        		
       			 </div>
    </div>
          	 <script src="https://sandbox.kongapay.com/plugins/web-plugin/js/kpay-sand.min.js"></script>
          	 <script>
			//localStorage.setItem("amount",<?php  // echo $payble_amount;?>);
			function showModal() {
			var user_id = localStorage.getItem("user_id");
			get_cart_coupon(user_id);
			$("#rechargeStep").modal();
			var wallet_amt = localStorage.getItem("wallet_amt");
			var sendAmnt = 	localStorage.getItem("amount");
			var pay_Amnt_status = 	localStorage.getItem("pay_status_wallet");
			
			new KongaPay({
    			
			        buttonSize: 140,
			        merchantId: "testmerchant",
			        merchantName: "KongaPay Test",
			        callBack: "<?php echo site_url('website/callback')?>",
			        transactionReference: '<?php echo $mobile_amount.",".$mobile.",".$recharge_category_id.",".$mobile_operator_id.",".rand(111,999).",";?>'+pay_Amnt_status,
			        amount: sendAmnt,
			        description: "Testing Payment with KongaPay"
    			});
    		}
    	
</script>
          	</li>
          <li role="presentation">
             </li>
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


<script>
function clickscroll(){
	
	$('html, body').animate({
        scrollTop: $("#voucher").offset().top
    }, 1000);
}
$(".circle-offer").click(function() {
	
    $('html, body').animate({
        scrollTop: $("#offertop").offset().top
    }, 1000);
});

</script>