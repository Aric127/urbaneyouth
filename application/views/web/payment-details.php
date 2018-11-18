<?php $wt_category=$this->session->userdata('wt_category');
$coupon_id=$this->session->userdata('coupon_id');
$coupon_amount=$this->session->userdata('coupon_amount'); ?>
<?php $this->load->view('alert'); ?>
<div class="container-fluid"> 
      <div class="container over-lap-div payment-detail">
         <div class="col-sm-12 col-xs-12 col-lg-12 recharge-result" style="min-height: 560px;">
         <div class="paymt-head-div">
            <h4>ADDING AMOUNT TO COMPLETE THIS TRANSACTION</h4>
            <h1><img src="<?php echo base_url('wassets/images/naira.png');?>" width="20"><?php if(!empty($amount)) echo $amount;?> </h1>
         </div>
         <div class="">
          <div class="bhoechie-tab-container-paymt">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 bhoechie-tab-menu-paymt">
              <div class="list-group">
                <a href="#" class="list-group-item active text-center">
                  <h4 class=""> Saved Cards </h4>
                </a>
                <a href="#" class="list-group-item text-center">
                  <h4 class=""> Debit/Credit Card </h4>
                </a>
              <!--   <a href="#" class="list-group-item text-center">
                  <h4 class=""> Bank Account </h4>
                </a> -->
                <?php if($wt_category!='1'){ ?>
                <a href="#" class="list-group-item text-center">
                  <h4 class=""> Oya Cash </h4>
                </a>
                <?php } ?>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 bhoechie-tab-paymt">
                <!-- flight section -->
                <div class="bhoechie-tab-content-paymt active">
                    <h3>Your Saved Cards</h3>
                    <form action="<?php echo base_url('web/payment_via_savecard') ?>" method="post" name="payment_savecard" id="payment_savecard">
					
						<div class="sv-crd">
						
                    	<input type="hidden" name="card_selected" id="card_selected" value=""/>
                    	   <input type="hidden" name="coupon_amount"  value="<?php if(!empty($coupon_amount))echo $coupon_amount; ?>"> 
                          <input type="hidden" name="coupon_id"  value="<?php if(!empty($coupon_id))echo $coupon_id; ?>"> 
                    	<?php if(!empty($save_card)){ 
                    	$i=0;
							foreach($save_card as $val){
								if($val->card_name=='Visa')
								{
									$img=base_url('wassets/images/default_logos/visa_logo@3x.png');
								}else if($val->card_name=='DISCOVER')
								{
									$img=base_url('wassets/images/default_logos/discover_logo@3x.png');
								}else if($val->card_name=='Mastercard')
								{
									$img=base_url('wassets/images/default_logos/maestro@3x.png');
								}else if($val->card_name=='JCB')
								{
									$img=base_url('wassets/images/default_logos/jcb@3x.png');
								}else if($val->card_name=='American Express')
								{
									$img=base_url('wassets/images/default_logos/american_express@3x.png');
								}else 
								{
									$img=base_url('wassets/images/default_logos/maestro@3x.png');
								}
                    	 ?>
								<a href="javascript:void(0)"  class="sv-card-des" onclick="select_card('<?php  echo $val->card_token ?>')">
								<!--<em></em>-->
									
								<i><img src="<?php echo $img; ?>" width="50"></i>
								<font><?php echo $val->card_no ?></font>
								<span class="cvv-in-des">
								  <div class="cvv">
									  <div class="form-group">                               
									   <input type="text" class="form-control" placeholder="CVV" id="cvv" name="cvv_no[]"   maxlength="3" minlength="3" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
									   <input type="hidden" class="form-control" name="card_token[]" value="<?php  echo $val->card_token ?>">
										</div>
								  </div>
								</span>
								</a>
						
                    <?php $i++; }?> 
                    <input type="button" name="sub_btn" class="blue-btn btn proc" value="Proceed" onclick="paymentsaved_card()">
                    <a href="<?php echo site_url('web') ?>" class="gray-btn btn proc pull-right">Cancel</a> 
                    <span id="savedcarderror"></span>
                    
                    <?php }else{ ?>
                       	 <i><img src="<?php echo base_url("wassets/images/sorry.png"); ?>" width="91%"></i>
                       <?php } ?>
                     </div>
                    
                   
                       </form>
                </div>
                <!-- train section -->
                <div class="bhoechie-tab-content-paymt debt">
                    <h3>Debit/Credit Card</h3>
                    <form action="<?php echo base_url('Payment-Via-Card') ?>" name="card_payment" id="card_payment"  novalidate="novalidate" method="post">
                    <div class="sv-card-des1">
                          <div class="form-group has-feedback">
                              <label for="usr">Card Number</label>                               
                              <input placeholder="xxxx-xxxx-xxxx-xxxx" type="text" class="form-control" placeholder="" id="card_no" name="card_no" value="" onkeyup="check_card_no(this.value)" autocomplete="off" pattern="[0-9.]+" maxlength="23" autocomplete="off">

                             <span class="form-control-feedback glyphicon glyphicon-ok" id="validcard" style="display: none"></span>

                              <input type="hidden" name="coupon_amount"  value="<?php if(!empty($coupon_amount))echo $coupon_amount; ?>"> 

                              <input type="hidden" name="coupon_id"  value="<?php if(!empty($coupon_id))echo $coupon_id; ?>"> 
                           <span id="card_no_error"></span>
                              
                          </div>
                          <div class="row">
                            <div class="col-sm-4 padding-R-0">
                              <div class="form-group">
                                <label for="usr">Expiry Month</label>                               
                              <select id="expiry_month" class="card-select-op" name="expiry_month">
                               	<option value="">MM</option>
                								<option value="01">01</option>
                								<option value="02">02</option>
                								<option value="03">03</option>
                								<option value="04">04</option>
                								<option value="05">05</option>
                								<option value="06">06</option> 
                								<option value="07">07</option>
                								<option value="08">08</option>
                								<option value="09">09</option>
                								<option value="10">10</option>
                								<option value="11">11</option>
                								<option value="12">12</option>                               
                               </select>
                               <span id="expiry_month_error"></span>
                          </div>
                            </div>
                             <div class="col-sm-4 padding-L-0 padding-R-0">
                                <div class="form-group">
                                  <label for="usr">Expiry Year</label>                               
                                 
                              <select id="expiry_year" class="card-select-op" name="expiry_year">
                               	        <option value="">YYYY</option>
                        								<option value="2018">2018</option>
                        								<option value="2019">2019</option>
                        								<option value="2020">2020</option>
                        								<option value="2021">2021</option>
                        								<option value="2022">2022</option> 
                        								<option value="2023">2023</option>
                        								<option value="2024">2024</option>
                        								<option value="2025">2025</option>
                        								<option value="2026">2026</option>
                        								<option value="2027">2027</option>
                        								<option value="2028">2028</option>               
                        								<option value="2029">2029</option>
                        								<option value="2030">2030</option>                               
                               </select>
                                <span id="expiry_year_error"></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                  <label for="usr">CVV Number</label>                               
                                  <input type="text" class="form-control" placeholder="CVV" name="cvv_no" id="cvv_no" value="" maxlength="3" minlength="3" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                   <span id="savecvv_error"></span>
                                </div>
                            </div>
                          </div>


                           <input type="hidden" name="verve_card_status" id="verve_card_status" value="2">

                           <div class="form-group has-feedback verveCard" style="display: none;">
                              <label for="usr">PIN</label>                               
                               <input type="text" class="form-control" placeholder="Enter PIN" id="verve_card_pin" name="verve_card_pin" value="" autocomplete="off" pattern="[0-9.]+" maxlength="4" autocomplete="off">
                              
                          </div>


                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" value="1" name="save_card_status" id="save_card_status">Save this Card.<span class="gray"> (We do not store CVV)</span>
                        </label>
                      </div>

                    <input type="button" name="sub_btn" class="blue-btn btn proc" value="Proceed" onclick="paymentcard()">
                    <a href="<?php echo site_url('web') ?>" class="gray-btn btn proc">Cancel</a>
                       </form>

                </div>
    
                <!-- hotel search -->
               <!--  <div class="bhoechie-tab-content-paymt bank-act">
                     <h3>Bank Account</h3>
                    <form action="<?php echo base_url('web/payment_via_bankaccount') ?>" method="post" >
                    <div class="col-sm-8 col-xs-12 bank-select-op">
                      <div class="form-group">
                        <label for="usr">Account Number</label>
                        <input type="text" class="form-control" id="usr" placeholder="Account No." name="user_ac_no" required="" value="">
                          <input type="hidden" name="coupon_amount"  value="<?php if(!empty($coupon_amount))echo $coupon_amount; ?>"> 
                          <input type="hidden" name="coupon_id"  value="<?php if(!empty($coupon_id))echo $coupon_id; ?>"> 
                      </div>
                      <div class="form-group">
                          <label for="usr">Other Bank</label>
                              <select class="selectpicker" id="bank_code" name="bank_code" required="">
                                <option value="">Select Bank</option>
                                <?php if(!empty($bank_list)){
                           
                              foreach ($bank_list as $key => $value) { ?>
                                <option value="<?php echo $key ?>"><?php echo $value;?></option>
                                  
                         <?php   }
                              } ?>
                          </select>
                      </div>
                      <div class="form-group">
                        <label for="usr">Passcode</label>
                        <input type="password" class="form-control" id="usr" placeholder="Passcode" name="passcode" required="" value="">
                      </div>

                    </div>
                    <div class="col-sm-4 col-xs-12">
                    </div>
					 <br>
                        <div class="clearfix"></div>
                    <input type="submit" name="sub_btn" class="blue-btn btn proc" value="Proceed">
                    <a href="<?php echo site_url('web') ?>" class="gray-btn btn proc">Cancel</a>
                       </form>
                </div> -->
                <div class="bhoechie-tab-content-paymt oyacash">
                     <h3>Oya Cash Wallet</h3>
                     <br>
                    <form action="<?php echo base_url('web/payment_via_wallet'); ?>" method="post">
                        <h2><img src="<?php echo base_url('wassets/images/naira.png');?>" width="18"><?php if(!empty($my_wallet)) echo $my_wallet; ?></h2> 
                       
                        <br>                              
                        <div class="clearfix"></div>
                        <div class="clearfix"></div>
                        <input type="hidden" name="coupon_amount"  value="<?php if(!empty($coupon_amount))echo $coupon_amount; ?>"> 
                          <input type="hidden" name="coupon_id"  value="<?php if(!empty($coupon_id))echo $coupon_id; ?>"> 
                    <input type="submit" name="sub_btn_wallet" class="blue-btn btn proc" value="Proceed">
                    <a href="" class="gray-btn btn proc">Cancel</a>
                       </form>
                </div>

            </div>
            <div class="col-sm-3 col-xs-12">
            <label class="">We Accept</label>
            <img src="<?php echo base_url('wassets/images/paymt-card-img1.png');?>" width="196"  class="img-responsive">
            </div>

        </div>


         </div><!--row-->

         </div><!--recharge-details-->
      </div>
</div><!--cont-fluid-->

<script type="text/javascript">
  $('.sv-crd a').click(function(e) {
        e.preventDefault();
        $('a').removeClass('active');
        $(this).addClass('active');
    });
	
</script>

<!-- <script type="text/javascript">
  function showDiv() {
   document.getElementById('promo_input').style.display = "block";
   document.getElementById('promo_d').style.display = "none";
}  
</script> -->

<script type="text/javascript">
  $(document).ready(function() {
    $("div.bhoechie-tab-menu-paymt>div.list-group>a").click(function(e) {
        e.preventDefault();
        $(this).siblings('a.active').removeClass("active");
        $(this).addClass("active");
        var index = $(this).index();
        $("div.bhoechie-tab-paymt>div.bhoechie-tab-content-paymt").removeClass("active");
        $("div.bhoechie-tab-paymt>div.bhoechie-tab-content-paymt").eq(index).addClass("active");
    });
});


</script>





 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script src="<?php echo base_url('wassets/js/jquery.bootstrap-responsive-tabs.min.js');?>"> </script>
      <script src="<?php echo base_url('wassets/js/bootstrap.min.js')?>"> </script>
      <script src="<?php echo base_url('wassets/js/jquery-ui.min.js');?>"> </script>
      <script src="<?php echo base_url('wassets/js/owl.carousel.js');?>"> </script>
      <script src="<?php echo base_url('wassets/js/slick.min.js');?>"></script>
      <script src="<?php echo base_url('wassets/js/matchHeight.min.js');?>"> </script>
      <script src="<?php echo base_url('wassets/js/bootstrap-select.js');?>"> </script>
      <script src="<?php echo base_url('wassets/js/custom.js');?>"> </script>
      <script>
         $('.responsive-tabs').responsiveTabs({
           accordionOn: ['xs', 'sm']
         });
      </script>
<script type="text/javascript">
		$('.dropdown-select').on( 'click', '.dropdown-menu li a', function() { 
	   var target = $(this).html();

	   //Adds active class to selected item
	   $(this).parents('.dropdown-menu').find('li').removeClass('active');
	   $(this).parent('li').addClass('active');

	   //Displays selected text on dropdown-toggle button
	   $(this).parents('.dropdown-select').find('.dropdown-toggle').html(target + ' <span class="caret"></span>');
	});


</script>
 <script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
 

<script>
	function select_card(card_id)
	{
		$("#card_selected").val(card_id);
		$('#savedcarderror').removeClass("errormsg my_account-error");
		$('#savedcarderror').text('');
	}
		//function save card
	function paymentcard()
	{
		var card_no			=	$("#card_no").val();
		var expiry_month	=	$("#expiry_month").val();
		var expiry_year		=	$("#expiry_year").val();
		var cvv_no			=	$("#cvv_no").val();
		var re16digit = new RegExp("^[0-9 -]+$");
		if(card_no=='')
		{
			$("#card_no_error").addClass("simple-msg");
			$("#card_no_error").text("Please Enter Valid Card Number");
			$('#expiry_month_error,#expiry_year_error,#savecvv_error').removeClass("simple-msg");
			$('#expiry_month_error,#expiry_year_error,#savecvv_error').text('');
			$("#validcard").css("display","none");
		}else
		if (!re16digit.test(card_no)) {
			$("#card_no_error").addClass("simple-msg");
			$("#card_no_error").text('Please Enter Valid Card Number');
			$('#expiry_month_error,#expiry_year_error,#savecvv_error').removeClass("simple-msg");
			$('#expiry_month_error,#expiry_year_error,#savecvv_error').text('');
			$("#validcard").css("display","none");
		}else
		if (card_no.length < 18 || card_no.length>23 ) {
			$("#card_no_error").addClass("simple-msg");
			$("#card_no_error").text('Please Enter Valid Card Number');
			$('#expiry_month_error,#expiry_year_error,#savecvv_error').removeClass("simple-msg");
			$('#expiry_month_error,#expiry_year_error,#savecvv_error').text('');
			$("#validcard").css("display","none");
		}else 
		if(expiry_month=='')
		{
			$("#expiry_month_error").addClass("simple-msg");
			$("#expiry_month_error").text('Invalid Month');
			$('#card_no_error,#expiry_year_error,#savecvv_error').removeClass("simple-msg");
			$('#card_no_error,#expiry_year_error,#savecvv_error').text('');
		}else 
		if(expiry_year=='')
		{
			$("#expiry_year_error").addClass("simple-msg");
			$("#expiry_year_error").text('Invalid Year');
			$('#card_no_error,#expiry_month_error,#savecvv_error').removeClass("simple-msg");
			$('#card_no_error,#expiry_month_error,#savecvv_error').text('');
		}else 
		if(cvv_no=='')
		{
			$("#savecvv_error").addClass("simple-msg");
			$("#savecvv_error").text('Invalid CVV.');
			$('#card_no_error,#expiry_month_error,#expiry_year_error').removeClass("simple-msg");
			$('#card_no_error,#expiry_month_error,#expiry_year_error').text('');
		}else
		if (isNaN(cvv_no)) {
			$("#savecvv_error").addClass("simple-msg");
			$("#savecvv_error").text('Please Enter 3 Digit Cvv Number');
			$('#card_no_error,#expiry_month_error,#expiry_year_error').removeClass("simple-msg");
			$('#card_no_error,#expiry_month_error,#expiry_year_error').text('');
		}else
		if (cvv_no.length < 3 || cvv_no.length > 3) {
			$("#savecvv_error").addClass("simple-msg");
			$("#savecvv_error").text('Please Enter 3 Digit Cvv Number');
			$('#card_no_error,#expiry_month_error,#expiry_year_error').removeClass("simple-msg");
			$('#card_no_error,#expiry_month_error,#expiry_year_error').text('');
		}else{
			$('#card_no_error,#expiry_month_error,#expiry_year_error,#savecvv_error').removeClass("simple-msg");
			$('#card_no_error,#expiry_month_error,#expiry_year_error,#savecvv_error').text('');
			$("#card_payment").submit();
		}
	}
</script>
<script>
	
	function paymentsaved_card()
	{
		var card_selected	=	$("#card_selected").val();
		var cvv				=	$("#cvv").val();
		if(card_selected!='' && cvv!='')
		{
			$("#payment_savecard").submit();
		}else{
			$('#savedcarderror').addClass("errormsg my_account-error");
			$('#savedcarderror').text('Please Select Card');
		}
	}
$('#card_no').keyup(function() {
  var foo = $(this).val().split("-").join(""); // remove hyphens
  if (foo.length > 0) {
    foo = foo.match(new RegExp('.{1,4}', 'g')).join("-");
  }
  $(this).val(foo);
});
</script>
</body>
</html>