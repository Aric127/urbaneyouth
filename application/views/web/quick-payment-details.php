<?php 
$amount				=	$this->session->userdata('amount'); 
?>


<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      
      <title>OyaCharge</title>
      <!-- Bootstrap -->
      <script src="<?php echo base_url(); ?>webassets/js/jquery-1.11.1.min.js"></script>
      <script src="<?php echo base_url(); ?>wassets/js/config.js"></script>
    <script src="<?php echo base_url('wassets/js/my.js'); ?>"></script>
    <!-- Bootstrap -->
      <link href="<?php echo base_url('wassets/css/bootstrap.min.css');?>" rel="stylesheet">
      <link href="<?php echo base_url('wassets/css/style.css');?>" rel="stylesheet">
      <link href="<?php echo base_url('wassets/css/responsive.css');?>" rel="stylesheet">
      <link href="https://oyacharge.com/wassets/css/recharge.css" rel="stylesheet">

      <link href="<?php echo base_url('wassets/css/font-awesome.css');?>" rel="stylesheet">
      <link href="<?php echo base_url('wassets/css/simple-line-icons.css');?>" rel="stylesheet">
      <link href="<?php echo base_url('wassets/css/owl.carousel.css');?>" rel="stylesheet">
      <link href="<?php echo base_url('wassets/css/bootstrap-responsive-tabs.css');?>" rel="stylesheet">
      <link href="<?php echo base_url('wassets/css/owl.carousel.css');?>" rel="stylesheet">
      <link href="<?php echo base_url('wassets/css/bootstrap-select.css');?>" rel="stylesheet">
      <!--<link href="https://fonts.googleapis.com/css?family=Arima+Madurai:100,300,400,500,700,900" rel="stylesheet">-->
      <link href="https://fonts.googleapis.com/css?family=Arima+Madurai:100,300,400,500,700,900|Roboto:100,300,400,500,700" rel="stylesheet">
     
   </head>
   <body style="background-color: #f3f3f3;" onload="get_amount()">
   <!-------------------------Header Start------------------------>
      <div class="hero" id="top">
         <div class="navbar" id="scroll_to" role="navigation">
            <div class="container">
               <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-4">
                     <a href="<?php echo base_url('web') ?>" title="Lexi app landing page">
                     <img src="<?php echo base_url('wassets/images/logo.png');?>"> </a>
                  </div>
               </div>
            </div>
         </div>
        </div>
        <!-------------------------Header End------------------------>

<div class="container-fluid">
<div class="row heading-menu"> 
<div class="container">
    <nav role="navigation" class="navbar navbar-default menu-head-b">
        
        <div id="navbarCollapse" class="collapse navbar-collapse menu-head-b">

            <h3 class="text-center" style="color:#fff;">Quick pay</h3>

        </div>

    </nav> 
 </div><!--row-->
            </div><!--cont-->
</div><!--cont-fluid-->
 
<!-------------------------Header-menu End------------------------>

<div class="container-fluid"> 
      <div class="container over-lap-div payment-detail">
         <div class="col-sm-12 col-xs-12 col-lg-12 recharge-result" style="min-height: 560px; margin-top: -73px;">
         <div class="paymt-head-div">
            <h4>AMOUNT TO COMPLETE THIS TRANSACTION</h4>
            <h1><img src="<?php echo base_url('wassets/images/naira.png');?>" width="20"><span id="trnas_amount"><?php echo $amount; ?></span></h1>
         </div>
         <div class="">
          <div class="bhoechie-tab-container-paymt">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 bhoechie-tab-menu-paymt">
              <div class="list-group">
                <a href="#" class="list-group-item active text-center">
                  <h4 class=""> Debit/Credit Card </h4>
                </a>
              <!--   <a href="#" class="list-group-item text-center">
                  <h4 class=""> Net Banking </h4>
                </a> -->
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 bhoechie-tab-paymt">
                
                <div class="bhoechie-tab-content-paymt debt active">
                    <h3>Debit/Credit Card</h3>
                    <form action="<?php echo base_url('Guest-Via-Card') ?>" name="card_payment" id="card_payment"  novalidate="novalidate" method="post">
                    <div class="sv-card-des1">
                          <div class="form-group has-feedback">
                              <label for="usr">Card Number</label>                               
                              <input type="text" class="form-control" placeholder="" id="card_no" name="card_no" value="" onkeyup="check_card_no(this.value)" autocomplete="off" pattern="[0-9.]+" maxlength="19" autocomplete="off">
                             <span class="form-control-feedback glyphicon glyphicon-ok" id="validcard" style="display: none"></span>
                         
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
                    								<option value="2017">2017</option>
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
                                  <input type="text" class="form-control" placeholder="CVV" name="cvv_no" id="cvv_no" value="" maxlength="3">
                                   <span id="savecvv_error"></span>
                                </div>
                            </div>
                          </div>                     
                    </div>
                  

                    <input type="button" name="sub_btn" class="blue-btn btn proc" value="Proceed" onclick="paymentcard()">
                    <a href="<?php echo site_url('web') ?>" class="gray-btn btn proc">Cancel</a>
                       </form>

              </div>
    
                <!-- hotel search -->
                <div class="bhoechie-tab-content-paymt bank-act">
                     <h3>Net Banking</h3>
                    <form action="<?php echo base_url('web/guest_payment_via_bankaccount') ?>" method="post" >
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
                </div>
            </div>
            <div class="col-sm-3 col-xs-12">
            <label class="">We Accept</label>
            <img src="https://oyacharge.com/wassets/images/paymt-card-img1.png" width="196"  class="img-responsive">
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
		if (card_no.length < 18 || card_no.length>22 ) {
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

// function get_amount()
 // {
//   
  // var mobile_amount=localStorage.getItem("mobile_amount");
       // $("#trnas_amount").text(mobile_amount);       
// }

       
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