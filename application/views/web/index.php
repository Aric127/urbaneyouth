<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>OyaCharge</title>
    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>webassets/js/jquery-1.11.1.min.js"></script>
    <script src="<?php echo base_url(); ?>wassets/js/config.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <script src="<?php echo base_url('wassets/js/my.js'); ?>"></script>
    <!-- Bootstrap -->
    <link href="<?php echo base_url('wassets/css/bootstrap.min.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('wassets/css/style.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('wassets/css/responsive.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('wassets/css/recharge.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('wassets/css/font-awesome.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('wassets/css/simple-line-icons.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('wassets/css/owl.carousel.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('wassets/css/bootstrap-responsive-tabs.css');?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link href="<?php echo base_url('wassets/css/owl.carousel.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('wassets/css/bootstrap-select.css');?>" rel="stylesheet">
    <!--<link href="https://fonts.googleapis.com/css?family=Arima+Madurai:100,300,400,500,700,900" rel="stylesheet">-->
    <link href="https://fonts.googleapis.com/css?family=Arima+Madurai:100,300,400,500,700,900|Roboto:100,300,400,500,700" rel="stylesheet">
    <style type="text/css">

    .log-in-pop {
    position: relative;
    overflow: hidden;
    /* height: 100%; */
    /* bottom: 0px; */
    background: #fff;
    width: 60%;
    margin: 0 auto;
    margin-top: 5%;
    margin-bottom: 5%;
}
      .log-in-pop-left {
    float: left;
    width: 40%;
    background: url(../images/login.html) no-repeat center center;
    padding: 11% 6%;
    color: #fff;
    height: 100%;
    bottom: 0px;
    /* min-height: 115%; */
    background: #728294 url(../images/mail/bg.png) repeat;
}

.log-in-pop-right {
    float: left;
    width: 60%;
    padding: 50px;
}
.log-in-pop-left h1 {
    color: #fff;
    font-size: 32px;
}
.log-in-pop-left h1 span {
    display: block;
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap;
    text-transform: capitalize;
    color: #fff;
    font-size: 24px;
    font-weight: 600;
    padding: 10px 0px;
}
.log-in-pop-left p {
    color: #fff;
}
.log-in-pop-left ul {
    margin-bottom: 0px;
}
.log-in-pop-left ul li {
    margin-bottom: 5px;
}
.log-in-pop-left ul li:nth-child(1) a {
    background: #39579A;
}
.log-in-pop-left ul li a {
    display: block;
    background: #3F51B5;
    color: #fff;
    padding: 12px;
    border-radius: 2px;
    font-family: 'Quicksand', sans-serif;
}
.log-in-pop-left ul li a i {
    padding-right: 7px;
}
.log-in-pop-right {
    float: left;
    width: 60%;
    padding: 50px;
}
.pop-close {
    color: #333;
    width: 24px;
    height: 24px;
    display: inline-block;
    position: absolute;
    top: 15px;
    right: 15px;
}
.log-in-pop-right a {
    color: #333;
}
.log-in-pop-right form input {
    border: 1px solid #dfdfdf;
    padding: 8px;
    box-sizing: border-box;
    height: 45px;
    border-radius: 2px;
    font-size: 15px;
    color: #636363;
}
.log-in-pop-right form label {
    font-size: 14px !important;
    font-weight: 200;
    left: 15px;
    top: 14px;
}
.log-in-pop-right form input[type="submit"] {
    color: #fff;
    font-size: 14px;
    font-weight: 600;
}
.log-in-btn {
    background: #f4364f;
    color: #fff;
    padding: 2px 10px;
    font-weight: 600;
}
.log-in-pop-left ul li:nth-child(2) a {
    background: #F24033;
}
.log-in-pop-left ul li:nth-child(3) a {
    background: #24A9E6;
}
ul:not(.browser-default) {
    padding-left: 0;
    list-style-type: none;
}
.log-in-pop-right form label {
    font-size: 14px !important;
    font-weight: 200;
    left: 15px;
    top: 14px;
}
    </style>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
    <!--<script>
	$(window).load(function() {
     localStorage.setItem("mobileno","");
});
</script>-->
<script>
$(function () {

    $('.ticket-type-btn_qunti button').click(function (e) {
        e.preventDefault();
        $(this).closest('button').addClass('active').siblings().removeClass('active');

    });

});
</script>

		

    <script>
        jQuery(document).ready(function($) {
        	
            // site preloader -- also uncomment the div in the header and the css style for #preloader
            $(window).load(function() {
                $('#preloader').fadeOut('slow', function() {
                    $(this).remove();
                });
					localStorage.setItem("m_type",'');
					localStorage.setItem("m_no",'');
					localStorage.setItem("m_amt",'');
					localStorage.setItem("o_id",'');
					localStorage.setItem("tv_recnumber",'');
					localStorage.setItem("tv_recamount",'');
					localStorage.setItem("tvoperator_id",'');
					localStorage.setItem("tv_reccode",'');
					localStorage.setItem("tv_numbername",'');
					localStorage.setItem("rec_cat",'');
					localStorage.setItem("wt_cat",'');
                    localStorage.setItem("e_c_n",'');
                    localStorage.setItem("e_a",'');
                    localStorage.setItem("e_o_id",'');
                    localStorage.setItem("c_cat_id",'');
                    localStorage.setItem("c_price",'');
                    localStorage.setItem("c_area",'');
                    localStorage.setItem("c_id",'');
                    localStorage.setItem("c_price_id",'');
                    localStorage.setItem("biller_cat_id",'');
                    localStorage.setItem("biller_s_id",'');
                    localStorage.setItem("bil_id",'');
                    localStorage.setItem("consumer_number",'');
                    localStorage.setItem("billpay_amount",'');
        
            });

        });

        $(document).ready(function() {
            $("#LoginModal").click(function(e) {

                $('#preloader').showLoading();

                $('#preloader').hideLoading();
            });

        });
        $(document).ready(function() {
            $("#SignupModalbtn").click(function(e) {
            		$("#user_email,#user_mobile_no,#user_pass,#reffer_code").val('');
            		$("#signup_mob_error").text('');
            		$("#signup_mob_error").removeClass('errormsg');

            });

        });
         $(document).ready(function() {
         	var recharge_category=localStorage.getItem("rec_category");
         	if(recharge_category=='1')
         	{
         			var retry_mobileno		=	localStorage.getItem("retry_mobileno");
         			var retry_operator_id	=	localStorage.getItem("retry_operator_id");
         			var retry_recharge_amt	=	localStorage.getItem("retry_recharge_amt");
         			$("#mobile_recharge_amount").val(retry_recharge_amt);
					$("#operator_id").val(retry_operator_id);
					$("#mobileno").val(retry_mobileno);
					  $('#mobile').tab('show');
					localStorage.setItem("retry_mobileno",'');
					localStorage.setItem("retry_operator_id",'');
					localStorage.setItem("retry_recharge_amt",'');
					
         	}
         	if(recharge_category=='2')
         	{
         			var retry_mobileno		=	localStorage.getItem("retry_mobileno");
         			var retry_operator_id	=	localStorage.getItem("retry_operator_id");
         			var retry_recharge_amt	=	localStorage.getItem("retry_recharge_amt");
         			$("#tv_rec_amount").val(retry_recharge_amt);
					$("#dth_operator_id").val(retry_operator_id);
					$("#tv_number").val(retry_mobileno);
					$('#dth').tab('show');
					localStorage.setItem("retry_mobileno",'');
					localStorage.setItem("retry_operator_id",'');
					localStorage.setItem("retry_recharge_amt",'');
					
         	}if(recharge_category=='3')
         	{
         			var retry_mobileno		=	localStorage.getItem("retry_mobileno");
         			var retry_operator_id	=	localStorage.getItem("retry_operator_id");
         			var retry_recharge_amt	=	localStorage.getItem("retry_recharge_amt");
         			$("#datacard_amount").val(retry_recharge_amt);
					$("#datacard_operator_id").val(retry_operator_id);
					$("#data_card_number").val(retry_mobileno);
					$('#datacard').tab('show');
					localStorage.setItem("retry_mobileno",'');
					localStorage.setItem("retry_operator_id",'');
					localStorage.setItem("retry_recharge_amt",'');
					
         	}
         	 });
    </script>
<style>
	
	
	
</style>


<script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=5bda7a8c4f97b900113a913b&product=sticky-share-buttons' async='async'></script>
</head>

<body onmousemove="reset_interval()" onclick="reset_interval()" onkeypress="reset_interval()" onscroll="reset_interval()">
    <!--<div id="preloader"></div>-->
    <div id="preloader" class="spinner"></div>
    <div class="hero home" id="top">

        <nav class="navbar  navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#"><a href="<?php echo base_url() ?>" title="Lexi app landing page">
                     <img src="<?php echo base_url('wassets/images/logo.png');?>"> </a></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      
      <ul class="nav navbar-nav navbar-right animated-nav">
         <li>
         	<a href="<?php echo base_url(); ?>"><span data-hover="Home">Home</span></a>
         </li>
         <li>
         	<a href="<?php echo base_url('About'); ?>"><span data-hover="About"> About</span></a>
         </li>
         <li class="share-menu">
           <a href="<?php echo base_url('ShareEarn'); ?>"> <span data-hover="Share & Earn"> Share & Earn</span></a>
        </li>
        <li>
        	<a href="#featureswrap" title="FAQ"><span data-hover="FAQ">FAQ</span></a>
        </li>
        <li>
        	<a target="_blank" href="<?php echo base_url('Merchant'); ?>" title="Merchant"><span data-hover="Merchant">Merchant</span></a>
        </li>
        <li>
        	<a href="<?php echo base_url('ContactUs') ?>" title="Contact"><span data-hover="Contact">Contact</span></a>
        </li>
        <?php $user_id= $this->session->userdata('user_id'); 
         if(empty($user_id)){?>
		         <li>
		         	<a onclick="show_login()" style="cursor: pointer" title="Login"><span data-hover="Login">Login</span></a>
		         </li>
          <?php }else { ?>
		         <li class="my-account">
		         	<a href="<?php echo base_url('My-Account');?>" title="Contact"><span data-hover="My Account">My Account</span></a>
		         </li>
		         <li>
		         	<a onclick="Logout()" title="Logout"><span data-hover="Logout"><i class="fa fa-user" aria-hidden="true"></i> Logout</span></a>
		         </li>
           <?php  } ?>
         
      </ul>
    </div>
  </div>
</nav>
  
        <div class="col-sm-12 col-xs-12 hidden-md hidden-lg hidden-sm visible-xs mobi">
            <div class="content-slider-right">
                <div class="owl-carousel owl-theme">
                    <div class="item">
                        <h4><span>GET UP TO 50%</span> OF YOUR SPENDINGS BACK</h4></div>
                    <div class="item">
                        <h4>SAVE MORE THAN YOU SPEND</h4></div>
                    <div class="item">
                        <h4>GET REWARDED EACH TIME YOU SPEND</h4></div>
                </div>
            </div>
        </div>
        <div class="recharge-slab-wrap">
            <div class="container">

              

                <div class="col-sm-8 home-pg-tb">
                    <ul class="nav nav-tabs  responsive-tabs">
                        <li class="active">
                            <a data-toggle="tab" href="#mobile" onclick="open_tab()">
                                <span> <img src="<?php echo base_url('wassets/images/fig_01.png');?>"> </span> Mobile </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#dth" onclick="open_tab()">
                                <span> <img src="<?php echo base_url('wassets/images/fig_02.png');?>"> </span> DTH </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#datacard" onclick="open_tab()">
                                <span> <img src="<?php echo base_url('wassets/images/fig_03.png');?>"> </span> DataCard </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#electricity" onclick="open_tab()">
                                <span> <img src="<?php echo base_url('wassets/images/fig_04.png');?>"> </span> Electricity </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#offering" onclick="open_tab()">
                                <span> <img src="<?php echo base_url('wassets/images/fig_05.png');?>"> </span> Offering </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#billers" onclick="open_tab()">
                                <span> <img src="<?php echo base_url('wassets/images/fig_06.png');?>"> </span> Billers </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#events" onclick="open_tab()">
                                <span> <img src="<?php echo base_url('wassets/images/fig_07.png');?>"> </span> Events </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="mobile" class="tab-pane in active">
                            <div class="frmnwrp">
                                <div class="form-group">
                                    <div class="radio-inline">
                                        <label>
                                            <input type="radio" name="optionsRadios" value="1" id="mobile_topup" checked onclick="toppup_type(1)"> Airtime
                                        </label>
                                    </div>
                                    <div class="radio-inline">
                                        <label>
                                            <input type="radio" name="optionsRadios" value="2" id="mobile_bundle" onclick="toppup_type(2)"> Data Bundle
                                        </label>
                                   </div>
                                </div>
                                <div class="form-group mo-m-o clearfix">
                                    <div class="col-sm-6">
                                    	<input type="hidden" value="1" id="mobile_type" readonly="readonly">
                                        <input type="text" class="form-control" placeholder="Enter your 11 digit mobile no" id="mobileno" value="" autocomplete="off">
                                        <input type="hidden" id="rec_category" value="">
                                        <div class="icn"><img src="<?php echo base_url('wassets/images/mobile_number.png');?>"> </div>
                                         <span id="mob_num_error"></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <select class="selectpicker margin-T-5" id="mobile_operator_id" data-container="body">
                                            <option value=""> Select operator</option>
                                            <?php if(!empty($operator))
                                 {
                                   foreach($operator as $value){

                                    if($value->recharge_category_id=='1')
                  { ?>
                                                <option value="<?php echo $value->operator_id ?>">
                                                    <?php echo $value->operator_name; ?>
                                                </option>
                                                <?php }
                                      }
                                   } ?>
                                        </select>
                                         <span id="mob_operator_error"></span>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" placeholder="How much to recharge?" id="mobile_recharge_amount">
                                        <div class="icn"><img src="<?php echo base_url('wassets/images/nyra_icon.png');?>"> </div>
                                        <span id="error_mobile_recharge"></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <button class="gray-btn btn quarter-width margin-T-5" onclick="recharge_plan()"> View plan </button>
                                        <button class="blue-btn btn quarter-width margin-T-5" onclick="mobile_recharge()"> Pay now </button>
                                        <?php if(isset($isLogin) && $isLogin == false) { ?>
                            <!--    <button class="brown-btn btn quarter-width margin-T-5" onclick="quick_mobile_recharge()" >Quick  Pay</button> -->

                                    <?php } ?>












                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="dth" class="tab-pane">
                            <div class="frmnwrp">
                                <div class="form-group mo-m-o clearfix">
                                    <div class="col-sm-6">
                                        <select class="selectpicker margin-T-5" id="dth_operator_id" data-container="body">
                                            <option value=""> Select operator</option>
                                            <?php if(!empty($operator)){
                                   foreach($operator as $value){

                                    if($value->recharge_category_id=='2')
                  { ?>
                                                <option value="<?php echo $value->operator_id ?>">
                                                    <?php echo $value->operator_name; ?>
                                                </option>
                                                <?php }
                                   }
                                   } ?>
                                        </select>
                                         <span id="dth_operator_error"></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control margin-T-5" placeholder="What's your DTH Number?" id="tv_number" value="" autocomplete="off">
                                        <div class="icn"><img src="<?php echo base_url('wassets/images/mobile_number.png');?>"> </div>
                                        <span id="dth_num_error"></span>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control margin-T-5" placeholder="Enter Amount" id="tv_rec_amount" autocomplete="off" readonly>
                                        <div class="icn"> <img src="<?php echo base_url('wassets/images/nyra_icon.png');?>"> </div>
                                         <span id="dth_amt_error"></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control margin-T-5 normal-input" placeholder="Name" id="tv_number_name" value="" autocomplete="off" readonly disabled="disabled">
                                        <input type="hidden" id="tv_rec_code" value="">
                                        <input type="hidden" id="tv_new_number" value="">
                                        <input type="hidden" id="service_id" value="">
                                        <div class="icn"> </div>
                                        <span id="error_dth_recharge"></span>

                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="col-sm-6">
                                        <button class="gray-btn btn quarter-width margin-T-5" onclick="plan_list()"> View plan </button>
                                        <button class=" btn blue-btn quarter-width margin-T-5" onclick="dth_recharge()"> Pay now </button>
                                        <?php if(isset($isLogin) && $isLogin == false) { ?>
                                         <button class="brown-btn btn quarter-width margin-T-5" onclick="quick_dth_recharge()" >Quick  Pay</button>
                                         <?php } ?>
                                    </div>
                                    <div class="col-sm-6">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="datacard" class="tab-pane">
                            <div class="frmnwrp">
                                <div class="form-group mo-m-o clearfix">
                                    <div class="col-sm-6">
                                        <select class="selectpicker margin-T-5" id="datacard_operator_id" data-container="body">
                                            <option value=""> Select operator</option>
                                            <?php if(!empty($operator)){
                                   					foreach($operator as $value){

                                    				if($value->recharge_category_id=='3')
                  										{ ?>
                                                			<option value="<?php echo $value->operator_id ?>">
                                                    			<?php echo $value->operator_name; ?>
                                                			</option>
                                   					<?php }}} ?>
                                        	</select>
                                         <span id="data_oper_error"></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control margin-T-5" placeholder="Enter your data card no" id="data_card_number" value="" autocomplete="off">
                                        <div class="icn"><img src="<?php echo base_url('wassets/images/mobile_number.png');?>"> </div>
                                         <span id="data_number_error"></span>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control margin-T-5" placeholder="Enter Amount" id="datacard_amount" autocomplete="off" readonly>
                                        <input type="hidden" placeholder="₦" id="datacard_typecode">
                                        <div class="icn"> <img src="<?php echo base_url('wassets/images/nyra_icon.png');?>"> </div>
                                        <span id="data_amt_error"></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control margin-T-5 normal-input" placeholder="Name" id="data_card_number_name12" value="" autocomplete="off" readonly>
                                        <!--<input type="hidden" id="tv_rec_code" value="">
                                        <input type="hidden" id="tv_new_number" value="">-->
                                        <div class="icn"> </div>
                                        
                                    </div>
									<div class="col-sm-12">
									<span id="data_num_error"></span>
									</div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="col-sm-6">
                                        <button class="gray-btn btn quarter-width margin-T-5" onclick="data_plan()"> View plan </button>
                                        <button class=" btn blue-btn quarter-width margin-T-5" onclick="datacard_recharge(1)"> Pay now </button>
                                        <?php if(isset($isLogin) && $isLogin == false) { ?>
                                         <button class="brown-btn btn quarter-width margin-T-5" onclick="quick_data_recharge()" >Quick  Pay</button>
                                        <?php } ?>
                                    </div>
                                    <div class="col-sm-6">

                                    </div>
                                </div>

                            </div>
                        </div>
                        <div id="electricity" class="tab-pane">
                            <div class="frmnwrp">
                                <div class="form-group mo-m-o clearfix">
                                    <div class="col-sm-6">
                                        <select id="electricty_operator_id" class="selectpicker margin-T-5" data-container="body">
                                            <option value="">Which operator?</option>
                                            <?php if(!empty($operator))
                               {
                                   foreach($operator as $value){

                                    if($value->recharge_category_id=='4')
								{ ?>
                                                <option value="<?php echo $value->operator_id ?>">
                                                    <?php echo $value->operator_name; ?>
                                                </option>
                                                <?php }
                                   }
                                 } ?>
                                        </select>
                                         <span id="ele_oper_error"></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <input id="electric_card_number" type="text" class="form-control margin-T-5" placeholder="Enter your Meter Number" onblur="check_electric_number(this.value)">
                                        <div class="icn"><img src="<?php echo base_url('wassets/images/mobile_number.png');?>"> </div>
                                         <span id="ele_num_error"></span>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control margin-T-5" placeholder="Enter Amount" id="electrice_amount" value="" onkeyup="check_electricity_mobile_amt(this.value)">
                                        <div class="icn"> <img src="<?php echo base_url('wassets/images/nyra_icon.png');?>"> </div>
                                         <span id="ele_amt_error"></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control margin-T-5 normal-input" placeholder="Customer Name" id="electricity_customer_name" value="" readonly disabled="disabled">
                                        <div class="icn"> </div>
                                        <span id="electricity_error"></span>
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="col-sm-6">
                                        <!--<button class="gray-btn btn quarter-width margin-T-5"> View plan </button>-->
                                        <button onclick="electricity_recharge()" class="blue-btn btn quarter-width margin-T-5"> Pay now </button>
                                        <?php if(isset($isLogin) && $isLogin == false) { ?>
                                         <button class="brown-btn btn quarter-width margin-T-5" onclick="quick_electricity_recharge()" >Quick  Pay</button>
                                         <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="billers" class="tab-pane">
                            <div class="frmnwrp">
                                <div class="form-group mo-m-o clearfix">
                                    <div class="col-sm-6">
                                        <select class="selectpicker margin-T-5" data-container="body" id="biller" onchange="show_service_provider(this.value)">
                                            <option value="">Select Biller Category</option>
                                            <?php if(!empty($biller_category)){
                                           	foreach ($biller_category as  $value) { ?>
                                                <option value="<?php echo $value->biller_category_id;?>">
                                                    <?php echo $value->biller_category_name; ?>
                                                </option>
                                                <?php	   }
                                           } ?>
                                        </select>
                                        <input type="hidden" id="biller_id" value="" />
                                          <span id="biller_cat_errro"></span>
                                    </div>
                                    <div class="col-sm-6 selectop1">
                                        <select class="cus-select" data-container="body" id="service_provider_list" onchange="get_service_provider(this.value)">
                                            <option>Select Service Provider</option>

                                        </select>
                                        <input type="hidden" id="bill_provider_id" value="" />
                                         <span id="biller_ser_errro"></span>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control margin-T-5 normal-input" placeholder="Enter Invoice Number" autocomplete="off" value="" id="consumer_number" onblur="check_consumer_number()">
                                        <div class="icn"> </div>
                                        <span id="error_consumer_no"></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <button class="blue-btn btn quarter-width margin-T-5" onclick="pay_bill(1)"> Pay now </button>
                                        <?php if(isset($isLogin) && $isLogin == false) { ?>
                                        <button class="brown-btn btn quarter-width margin-T-5" onclick="pay_bill(2)" >Quick  Pay</button>
                                        <?php } ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div id="offering" class="tab-pane">
                            <div class="frmnwrp">
                                <div class="form-group mo-m-o clearfix">
                                    <div class="col-sm-6 selectop">
                                        <select class="cus-select margin-T-5" data-container="body" id="church_category_id" onchange="select_church(this.value)">
                                            <option value="">Select Type</option>
                                            <?php if(!empty($church)){

                                            	foreach ($church as  $value) {
                                            		 if($value->category =='2'){ ?>
                                                <option value="<?php echo $value->biller_category_id;?>">
                                                    <?php echo $value->biller_category_name; ?>
                                                </option>
                                                <?php	}
												}
                                            } ?>

                                        </select>
                                        <input type="hidden" id="biller_category_id" value="">
                                          <span id="church_type_error"></span>
                                    </div>
                                    <div class="col-sm-6 selectop">
                                        <select class="cus-select" data-container="body" id="church_id" onchange="select_church_area(this.value)">
                                            <option value="">Select Church</option>

                                        </select>
                                        <input type="hidden" id="church_selectedid" value="">
                                        <input type="hidden" id="church_selected_id" value="">
                                        <input type="hidden" id="church_biller_id" value="">
                                         <span id="church_select_error"></span>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <div class="col-sm-6 selectop">
                                        <select class="cus-select" id="church_area" data-container="body" onchange="select_church_products(this.value)">
                                            <option value="">Select Area</option>

                                        </select>
                                        <span id="church_area_error"></span>
                                    </div>
                                    <div class="col-sm-6 selectop">
                                        <select class="cus-select" id="church_donation_price" data-container="body" onchange="select_church_service(this.value)">
                                            <option value="">Select Services</option>

                                        </select>
                                         <span id="church_service_error"></span>
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control margin-T-5 normal-input" placeholder="Service" id="church_price">
                                        <div class="icn"> </div>
                                        <span id="error_church_donation"></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <!--<button class="gray-btn btn quarter-width margin-T-5" data-toggle="modal" data-target="#viewPlanDTH"> View plan </button>-->
                                        <button class="blue-btn btn quarter-width margin-T-5" onclick="church_donation(1)"> Pay now </button>
                                        <?php if(isset($isLogin) && $isLogin == false) { ?>
                                         <button class="brown-btn btn quarter-width margin-T-5" onclick="church_donation(2)" >Quick  Pay</button>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="events" class="tab-pane">
                            <div class="frmnwrp">
                                <div class="form-group mo-m-o clearfix">
                                    <div class="col-sm-6">
                                        <select class="selectpicker margin-T-5" data-container="body" id="event_category_id" onchange="get_event_list(this.value)">
                                            <option>Select Event Category</option>
                                            <?php if(!empty($event_category)){

                                            	foreach ($event_category as  $val) {  ?>

                                                <option value="<?php echo $val->biller_category_id;?>">
                                                    <?php echo $val->biller_category_name; ?>
                                                </option>
                                                <?php	
												}
                                            } ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-6 selectop1">
                                        <!-- <option data-toggle="modal" data-target="#eventDetailModal" data-target=".bd-example-modal-lg">Event 1</option> -->
                                        <select class="margin-T-5 cus-select" data-container="body" id="event_id" onchange="select_event(this.value)">
                                            <option value="0">Select Event</option>

                                        </select>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="quickpay" class="modal fade quickp" role="dialog">
		  <div class="modal-dialog modal-sm" style="background: #fff">

		    <!-- Modal content-->
		    <div class="modal-conquickpaytent">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Quick  Pay</h4>
		      </div>
		      <div class="modal-body">
		        <form>
	        	 	<div class="form-group">
				    	<label for="exampleInputPassword1">Mobile No.</label>
				    	<input type="text" class="form-control" id="guest_user_mobile" placeholder="Mobile No.">
				    	 <div class="d">
                                <span id="guest_mobile_error"></span>
                          </div>
				  	</div>
				  	<div class="form-group">
				    	<label for="exampleInputPassword1">Email Id</label>
				    	<input type="email" class="form-control" id="guest_user_email" placeholder="Email Id">
				    	 <div class="d">
                                <span id="guest_email_error"></span>
                          </div>
				  	</div>
		        </form>
		      </div>
		      <div class="modal-footer">
		        <button class="brown-btn btn margin-T-5" onclick="guest_user_signup()" >Quick Pay</button>


		      	<!-- <a href="<?php echo site_url('web/quick_pay');?>" class="btn blue-btn" >Submit</a>
		        --> <button type="button" class="btn gray-btn" data-dismiss="modal">Close</button>
		      </div>
		    </div>

		  </div>
</div>
                <div class="col-sm-4 col-xs-12 hidden-xs visible-md visible-lg visible-sm">
                    <div class="content-slider-right">
                        <div class="owl-carousel owl-theme">
                            <div class="item">
                                <h4><span>GET UP TO 50%</span> OF YOUR SPENDINGS BACK</h4></div>
                            <div class="item">
                                <h4>SAVE MORE THAN YOU SPEND</h4></div>
                            <div class="item">
                                <h4>GET REWARDED EACH TIME YOU SPEND</h4></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   <!--  <section id="downloadapp" class="download-wrap">
        <div class="container">

        <?php if($this->session->flashdata('payment_msg')){

                    echo $this->session->flashdata('payment_msg');

        } ?>

            <div class="col-sm-4">
                <img src="<?php echo base_url('wassets/images/app_screen.png');?>" class="img-responsive center-block">
            </div>
            <div class="col-sm-7 col-md-6  col-sm-offset-1 col-md-offset-2 col-xs-offset-0">
                <div class="download-app-text">
                    <h1> Available on iOS and Android </h1>
                    <span> OyaCharge is available for download on the Google 
                  Playstore and AppStore. It is lightweight and very easy to install. </span>
                    <a href="https://itunes.apple.com/ng/app/oyacharge/id1173501594" class="btn btn-download">
                        <i class="fa fa-apple"> </i>
                        <small>Download on the </small>
                        <h3> App Store </h3>
                    </a>
                    <a href="https://play.google.com/store/search?q=oyacharge&hl=en" class="btn btn-download">
                        <i class="fa fa-android"> </i>
                        <small>Get it on</small>
                        <h3> Google Play</h3>
                    </a>
                </div>
            </div>
        </div>
    </section>-->
    <section id="chooseplan" class="choose-plan-wrap">
        <div class="container">
            <div class="section-title">
                <p>NEED HELP TO CHOOSING A PLAN?</p>
                <p> Our <span>[Service Selector]</span> can help you find the right plan for you.
                </p>
                 
            </div>
            <div class="row">
                <div id="owl-demo" class="owl-carousel owl-theme">
                    <div class="item">
                        <div class="customers">
                            <div class="customers-s"> <img src="<?php echo base_url('wassets/images/slide_rip_01.png');?>"></div>
                            <div class="customers-outer-1"></div>
                            <div class="customers-outer-2"></div>
                            <div class="customers-inner customers-inner1">
                                <div class="slide_title">Mobile Recharge </div>
                                <div class="customers-content">
                                    <p>Recharge your phone and buy data in just a click away. Get special rewards that include cashback and exciting coupons with you use our instant recharge app. It doesn't get much better than OyaCharge!</p>
                                </div>
                                <div class="customers-meta"> <a href="#">Get Plans & Offers </a> </div>
                            </div>
                            <div class="customers-outer-3"></div>
                            <div class="customers-outer-4"></div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="customers">
                            <div class="customers-s"> <img src="<?php echo base_url('wassets/images/slide_rip_02.png');?>"></div>
                            <div class="customers-outer-1"></div>
                            <div class="customers-outer-2"></div>
                            <div class="customers-inner customers-inner2">
                                <div class="slide_title">TV Recharge </div>
                                <div class="customers-content">
                                    <p>Conveniently pay your GOTV and DSTV subscription without hassles. Get it done simple, secure and quick with OyaCharge and get special rewards that include cashback and exciting coupons with you pay. It doesn't get much better than OyaCharge!</p>
                                </div>
                                <div class="customers-meta"> <a href="#">Get Plans & Offers </a> </div>
                            </div>
                            <div class="customers-outer-3"></div>
                            <div class="customers-outer-4"></div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="customers">
                            <div class="customers-s"> <img src="<?php echo base_url('wassets/images/slide_rip_03.png');?>"> </div>
                            <div class="customers-outer-1"></div>
                            <div class="customers-outer-2"></div>
                            <div class="customers-inner customers-inner3">
                                <div class="slide_title">Data Recharge </div>
                                <div class="customers-content">
                                    <p>Conveniently pay your GOTV and DSTV subscription without hassles. Get it done simple, secure and quick with OyaCharge and get special rewards that include cashback and exciting coupons with you pay. It doesn't get much better than OyaCharge!</p>
                                </div>
                                <div class="customers-meta"> <a href="#">Get Plans & Offers </a> </div>
                            </div>
                            <div class="customers-outer-3"></div>
                            <div class="customers-outer-4"></div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="customers">
                            <div class="customers-s"> <img src="<?php echo base_url('wassets/images/slide_rip_04.png');?>"> </div>
                            <div class="customers-outer-1"></div>
                            <div class="customers-outer-2"></div>
                            <div class="customers-inner customers-inner4">
                                <div class="slide_title">Electricity Recharge</div>
                                <div class="customers-content">
                                    <p>Recharge your phone and buy data in just a click away. Get special rewards that include cashback and exciting coupons with you use our instant recharge app. It doesn't get much better than OyaCharge!</p>
                                </div>
                                <div class="customers-meta"> <a href="#">Get Plans & Offers </a> </div>
                            </div>
                            <div class="customers-outer-3"></div>
                            <div class="customers-outer-4"></div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="customers">
                            <div class="customers-s"> <img src="<?php echo base_url('wassets/images/slide_rip_05.png');?>"> </div>
                            <div class="customers-outer-1"></div>
                            <div class="customers-outer-2"></div>
                            <div class="customers-inner customers-inner5">
                                <div class="slide_title">Offring Recharge</div>
                                <div class="customers-content">
                                    <p>Conveniently pay your GOTV and DSTV subscription without hassles. Get it done simple, secure and quick with OyaCharge and get special rewards that include cashback and exciting coupons with you pay. It doesn't get much better than OyaCharge!</p>
                                </div>
                                <div class="customers-meta"> <a href="#">Get Plans & Offers </a> </div>
                            </div>
                            <div class="customers-outer-3"></div>
                            <div class="customers-outer-4"></div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="customers">
                            <div class="customers-s"> <img src="<?php echo base_url('wassets/images/slide_rip_06.png');?>"> </div>
                            <div class="customers-outer-1"></div>
                            <div class="customers-outer-2"></div>
                            <div class="customers-inner customers-inner6">
                                <div class="slide_title">Biller</div>
                                <div class="customers-content">
                                    <p>Make your data recharges and top up your connection on the go. Instantly recharge your MTN, Airtel, Etisalat, Glo, Swift, Smile, Spectranet, Cobranet and Ntel subscription without hassles and get special rewards that include cashback and exciting coupon. It doesn't get much better than OyaCharge!</p>
                                </div>
                                <div class="customers-meta"> <a href="#">Get Plans & Offers </a> </div>
                            </div>
                            <div class="customers-outer-3"></div>
                            <div class="customers-outer-4"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>  
    <section class="section bg-light shadow-md pt-4 pb-3">
      <div class="container">
        <div class="row">
          <div class="col-sm-6 col-md-3">
            <div class="featured-box text-center">
              <div class="featured-box-icon"> <i class="fa fa-lock"></i> </div>
              <h4>100% Secure Payments</h4>
              <p>Moving your card details to a much more secured place.</p>
            </div>
          </div>
          <div class="col-sm-6 col-md-3">
            <div class="featured-box text-center">
              <div class="featured-box-icon"> <i class="fa fa-thumbs-up"></i> </div>
              <h4>Trust pay</h4>
              <p>100% Payment Protection. Easy Return Policy.</p>
            </div>
          </div>
          <div class="col-sm-6 col-md-3">
            <div class="featured-box text-center">
              <div class="featured-box-icon"> <i class="fa fa-bullhorn"></i> </div>
              <h4>Refer &amp; Earn</h4>
              <p>Invite a friend to sign up and earn up to &#8358; 5.</p>
            </div>
          </div>
          <div class="col-sm-6 col-md-3">
            <div class="featured-box text-center">
              <div class="featured-box-icon"> <i class="fa fa-life-ring"></i> </div>
              <h4>24X7 Support</h4>
              <p>We're here to help. Have a query and need help ? <a href="#">Click here</a></p>
            </div>
          </div>
        </div>
      </div>
    </section>
   <!-- <section id="featureswrap" class="features_wrap">
        <div class="container-fluid">
            <div class="col-sm-6 features-left">
                <div class="features-inner">
                    <div class="feat_title">
                        Share OUR APP to your friend and get chance to earn.
                    </div>
                    <?php if($recharge_content){
                      echo $recharge_content[0]->share_app_content;
                    }  ?>
                        <figure> <img src="<?php echo base_url('wassets/images/feature_img.png');?>" class="img-responsive center-block"> </figure>
                </div>
            </div>
            <div class="col-sm-6 features-right">
                <div class="features-inner">
                    <div class="feat_title">
                        Recharge Video
                        <small> This is the content block for about us section. </small>
                    </div>
                    <div class="spatidar">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/DhW9wRjVNOs?autoplay=1&rel=0&hd=1" frameborder="0" allowfullscreen></iframe>
                    </div>
                    <!-- <div class="video-frame">
                        <iframe width="100%" height="208px" src="<?php echo $about_details[0]->about_us_video; ?>?autoplay=1&rel=0&hd=1" frameborder="0" allowfullscreen> </iframe>
                        <!--
                     <div class="play_btn">
                                            <i class="fa fa-youtube-play"> </i> 
                                         </div>--

                    </div> -->
                </div>
            </div>
        </div>
    </section>
    
	
	
	
	
	
	
	
	
<!-- 	<section id="featureswrap" class="">
		<div class="features_wrap col-sm-6">
			<div class="features-inner">
                    <div class="feat_title">
                        Share OUR APP to your friend and get chance to earn.
                    </div>
                    <?php if($recharge_content){
                      echo $recharge_content[0]->share_app_content;
                    }  ?>
                        <figure> <img src="<?php echo base_url('wassets/images/feature_img.png');?>" class="img-responsive center-block"> </figure>
                </div>
		</div>
		<div class="features-right col-sm-6">
			<div class="features-inner">
                    <div class="feat_title">
                        Recharge Video
                        <small> This is the content block for about us section. </small>
                    </div>
                    <div class="spatidar">
                        <iframe autoplay="false" width="560" height="315" src="https://www.youtube.com/embed/DhW9wRjVNOs?autoplay=2&rel=0&hd=1" frameborder="0" allowfullscreen></iframe>
                    </div>
                    <div class="video-frame">
                        <iframe width="100%" height="208px" src="<?php echo $about_details[0]->about_us_video; ?>?autoplay=1&rel=0&hd=1" frameborder="0" allowfullscreen> </iframe>
                       
                     <div class="play_btn">
                                            <i class="fa fa-youtube-play"> </i> 
                                         </div> 

                    </div> 
                </div>
		</div>
</section>	 -->

<!-- 	<section id="ststwrpr-div" class="ststWrpr">
        <div class="ststCntnr owl-carousel owl-theme">
            <div class="item active">
                <p><i class="icons icon-bag"></i><span><b>2,50,000</b><small>+</small><em>Merchants</em></span></p>
            </div>
            <div class="item">
                <p><i class="icons icon-emotsmile"></i><span><b>40</b><small>+</small><em>Million Consumers</em></span></p>
            </div>
            <div class="item">
                <p><i class="icons icon-people"></i><span><b>100</b><small>+</small><em>New Users/min</em></span></p>
            </div>
            <div class="item">
                <p><i class="fa fa-money"></i><span><b>25</b><small>+</small><em>Payments/second</em></span></p>
            </div>
        </div>
    </section>
    <section id="feedbacksec" class="feedback-section">
        <div class="container">
            <div class="section-title"> Give your FEEDBACK so we can help you! </div>
            <div class="foodback_form">

                <div class="form-group clearfix">
                    <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="Name" id="name" name="name"> </div>
                    <div class="col-sm-6">
                        <input type="email" class="form-control margin-T-5" placeholder="E-mail" id="email" value="" name="email"> </div>
                </div>
                <div class="form-group clearfix">
                    <div class="col-sm-12">
                        <textarea cols="6" placeholder="Message" class="form-control" id="message" name="message" style="resize:none;"> </textarea>
                    </div>
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-submit" onclick="send_feedback()"> Send </button>
                       
                </div>
                <span id="response_feedback"></span>
                <div class="form-group">
                    <span> 
                     <a href="#"> <i class="icons icon-location-pin"> </i> <?php echo $contact_details[0]->contact_name ?> </a> 
                     </span>
                    <span> 
                     <a href="#"> <i class="icons icon-envelope-open"> </i> <?php echo $contact_details[0]->contact_email ?> </a> 
                     </span>
                    <span> 
                     <a href="#"> <i class="icons icon-phone"> </i> <?php echo $contact_details[0]->contact_number ?> </a> 
                     </span>
                </div>
             
                <div class="social-row text-center">
                    <span> <a href="#"> <i class="fa fa-facebook"> </i> </a> </span>
                    <span> <a href="#"> <i class="fa fa-twitter"> </i> </a> </span>
                    <span> <a href="#"> <i class="fa fa-google-plus"> </i> </a> </span>
                </div>

            </div>
        </div>
    </section> -->
    <footer>
        <div class="container">

            <div class="col-sm-3 col-xs-6">
                <div class="footer-inner">
                    <h3>TV Recharge</h3>
                    <ul class="list-unstyled">
                        <li> <a href="#">MultiChoice DSTV  </a> </li>
                        <li> <a href="#">Star Times Cable TV </a> </li>
                        <li> <a href="#">MultiChoice GOTV </a> </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-3 col-xs-6">
                <div class="footer-inner">
                    <h3>Mobile Recharge</h3>
                    <ul class="list-unstyled">
                        <li> <a href="#">Etisalat  </a> </li>
                        <li> <a href="#">Airtel </a> </li>
                        <li> <a href="#">MTN </a> </li>
                        <li> <a href="#">Glo </a> </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-3 col-xs-6">
                <div class="footer-inner">
                    <h3>Data Recharge</h3>
                    <ul class="list-unstyled">
                        <li> <a href="#">Smile Recharge   </a> </li>
                        <li> <a href="#">Smile Bundle </a> </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-3 col-xs-6">
                <div class="footer-inner">
                    <h3>Support</h3>
                    <ul class="list-unstyled">
                        <li> <a href="#"> care@oyacharge.com </a> </li>
                        <li> <a href="#vedio_section">About Us </a> </li>
                        <li> <a href="#contact_form ">Contact Us </a> </li>
                        <li> <a href="#">Terms &amp; Conditions</a> </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="copyright"> © 2017 All Rights Reserved. Developed by - <span class="footer-high-text">Oyecharge.com</span></div>
    </footer>
    <!-- view plan -->
    <div class="modal modal1 fade" id="viewPlanmobile" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><span id="plan_type_name"></span> Recharge Plans</h4>
                </div>
                <div class="modal-body">

                    <div class="scroll-tab" id="cat">
                        <ul class="nav nav-tabs" role="tablist" id="plan_category_list">
                        </ul>
                    </div>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="Recommende">

                        </div>

                        <div role="tabpanel" class="tab-pane" id="FullTT">

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- view plan -->
    <div class="modal fade" id="viewPlanTv" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><span id="dthoperator_name"></span>DTH Plans</h4>
                </div>
                <div class="modal-body">
                    <!--  <div class="scroll-tab">
                        <ul class="nav nav-tabs" role="tablist" id="tvplan_category_list">
                        </ul>
                    </div>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="tvRecommende">

                        </div>

                        <div role="tabpanel" class="tab-pane" id="FullTT">

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--Modal for Event book-->
    <div class="modal fade" id="eventDetailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Event Details</h4>
                </div>
                <div class="modal-body clearfix event-datail-sp">
                    <div class="col-sm-6 col-xs-12">
                        <div class="event-banner">
                            <img src="" id="image_event">
                        </div>
                    </div> 
                    <!--&#x20A6;--->
                    <div class="col-sm-6 col-xs-12">
                        <h4 id="e_name">BD Party</h4>
                        <h5 id="event_datetime">Thursday 1st of January 1970 12:00:00 AM </h5>
                        <p id="address_event">JV Complex, Race Course Road, New Palasia, Indore, Madhya Pradesh, India</p>
                        <h4>Description</h4>
                        <p id="desc_event">Thursday 1st of January 1970 12:00:00 AM JV Complex, Race Course Road, New Palasia, Indore, Madhya Pradesh, India</p>
                        <input type="hidden" id="csv_ticket_ids" value="">
                        <input type="hidden" id="click_event_id" value="">
                        <input type="hidden" id="final_amt_ticket" value="0">
                        <strong>Amount</strong>
                        <br>
						<span class="" id="amt_price"><b>0</b> </span>
                        <!-- <div class="ticket-type-btn_qunti">
              <div class="btn-group" role="group" aria-label="...">
                <button type="button" class="btn btn-default" title="400">Normal</button>
                <button type="button" class="btn btn-default" title="800">VIP</button>
              </div>
            </div>
            <div class="Quantity">
              <h5>Quntity <span class="pull-right">
                <div class="input-group">
              <span class="input-group-btn">
                  <button data-field="quant[2]" data-type="minus" class="btn btn-danger btn-number" type="button">
                    <span class="glyphicon glyphicon-minus"></span>
                  </button>
              </span>
              <input type="text" max="100" min="1" value="10" class="form-control input-number" name="quant[2]">
              <span class="input-group-btn">
                  <button data-field="quant[2]" data-type="plus" class="btn btn-success btn-number" type="button">
                      <span class="glyphicon glyphicon-plus"></span>
                  </button>
              </span>
              </div>
                  </span></h5>
            </div> -->
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <div class="col-sm-4">
                        <h5>
							<div class="ticket-type-btn_qunti pull-left" >
								<div id="event_tkt_price"></div>
								
								<div class="clearfix"></div>
							  <div class="btn-group" role="group" aria-label="..." id="event_pass_record">

							  </div>
							</div>
						</h5>
                    </div>
                    <div class="col-sm-5">
                        <div class="Quantity margin-T-20">
                            <h5 class="clearfix">
							<span class="qui pull-left">Quantity</span>
							<span class="pull-left">
								<div class="input-group">
								  <span class="input-group-btn">
									  <button data-field="quant[0]" data-type="minus" class="btn blue-btn btn-number" type="button" onclick="minus_ticket()">
										<span class="glyphicon glyphicon-minus"></span>
									  </button>
								  </span>
									<input type="text" max="100" min="0" value="0" class="form-control input-number" name="quant[1]" id="ticket_value" >
								  <span class="input-group-btn">
									  <button data-field="quant[2]" data-type="plus" class="btn blue-btn btn-number" type="button" onclick="add_ticket()">
										  <span class="glyphicon glyphicon-plus"></span>
									  </button>
								  </span>
								</div>
							</span>
							
				  </h5>
                        </div>
                    </div>
                    <div class="col-sm-3 margin-T-20">
                        <button type="button" class="btn blue-btn pull-right half-w-blue-btn" onclick="check_ticket_avaliblity()">Book</button>
                    </div>
                </div>
<span id="error_status_ticket" style="display: none"></span>
            </div>
        </div>
    </div>
    
    <style>
    	
.modal-content > span#error_status_ticket {
    background: rgba(228, 27, 27, 0.5) none repeat scroll 0 0;
    border-bottom: 1px solid red;
    border-top: 1px solid red;
    border: 1px solid red;
    color: #fff;
    display: block;
    padding: 10px 20px;
    position: relative;
    text-align: center;
    margin:10px auto;
    width:50%;
}
    </style>

    <!---changepassword-->
    <div id="verification-modal" class="modal fade change-psd">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
                    </button>
                    <h4 class="modal-title text-center">verify your mobile number</h4>
                </div>
                <div class="modal-body getway-block">
                    <form>
                        <div class="login-social">
                            <span>We have send a 4-degit confirmation code to-<span id="user_mobile_number"></span></span>
                        </div>
                        <div class="form-group">
                            <input type="text" required class="form-control" placeholder="Enter verification code" id="verification-code" value="">
                             <input type="hidden" id="mob_num_hidden" value="">
                            <div class="d">
                                <span id="login_otp_error"></span>
                            </div>
                        </div>
                        <div class="form-group  text-center">
                            <button onclick="confirm_number()" type="button" class="btn btn-submit full-width"> Confirm Number </button>
                        </div>
                        <div class="form-group  text-center">
                            <a href="javascript:void(0)" class="btn braun-btn proc" onclick="resend_otp()"> Resend </a>
                            <a href="javascript:void(0)" class="btn gray-btn proc" onclick="change_number()"> Change Number </a>
                        </div>

                    </form>
                </div>
                <div class="d">
                    <span id="response_otp_msg"></span>
                </div>
            </div>
        </div>
    </div>

    <div id="changenumber-modal" class="modal fade change-psd">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
                    </button>
                    <h4 class="modal-title text-center">Upgrade your account</h4>
                </div>
                <div class="modal-body getway-block">
                    <form>
                        <div class="login-social">
                            <span>We will send a verification code via SMS to this Number</span>
                        </div>
                        <div class="form-group">
                            <input type="text" required class="form-control" placeholder="Mobile Number" id="Mobile_number-code" value="">
                            <input type="hidden" id="mob_user_id" value="">
                            <div class="d">
                                <span id="login_mob_error"></span>
                            </div>
                        </div>
                        <div class="form-group  text-center">
                            <button type="button" class="btn btn-submit full-width" onclick="send_otp()"> Continue </button>
                        </div>
                    </form>
                </div>
                <div class="d">
                    <span id="mobile_number_response"></span>
                </div>
            </div>
        </div>
    </div>

    <!-- LoginModal HTML -->
    <div id="LoginModal"   class="modal" data-easein="pulse"  tabindex="-1" role="dialog" aria-labelledby="costumModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
                    </button>
                    <h4 class="modal-title text-center">Login</h4>
                </div>
                <div class="modal-body getway-block">
                    <form>
                        <div class="login-social">
                            <a href="javascript:void(0)" onclick="fb_login()" class="button login-facebook">
                                <!-- <i class=" fa fa-facebook"></i>Login with Facebook -->
                                <img src="<?php echo base_url('wassets/images/fb.png');?>">
                            </a>
                         <!--    <a href="<?php echo site_url('web/google_login/Google'); ?>" class="button login-googleplus">
                                <i class="fa fa-google-plus"></i>Login with Google+
                            </a> -->

                            <div class="seperator">
                                <label>OR</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" required class="form-control" placeholder="Enter Mobile Number or Email" id="user_mobile_login" value="" autocomplete="off" onblur="check_login_popup_msg()">
                            <div class="d">
                                <span id="login_mob_error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="Password" required class="form-control" placeholder="Enter Your Password" id="user_password" value="" autocomplete="off" onblur="check_login_popup_msg()" maxlength="4" minlength="4">
                            <div class="d">
                                <span id="login_pass_error"></span>
                            </div>
                        </div>
                        <div class="form-group  text-center">
                           <!--  <a href="#ForgotModal">Forgot Password? </a> -->

                            <a href="#ForgotModal" data-toggle="modal" data-dismiss="modal"> Forgot Password? </a>
                        </div>
                        <button type="button" class="btn btn-submit full-width" onclick="user_login()"> Log in </button>
                    </form>
                </div>
                <div class="d">
                    <span id="login_response_failed" class=""></span>
                </div>
                <div class="modal-footer">
                    <div class="text-center">
                        Don't have an account? <a href="#SignupModal" data-toggle="modal" data-dismiss="modal" id="SignupModalbtn"> Signup here.</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

   <div class="modal fade" id="SignupModal">
     <div class="log-in-pop">
        <div class="log-in-pop-left">
          <h2  style="text-transform: capitalize;">Welcome to oyacharge</h2>
          <p>Don't have an account? Create your account. It's take less then a minutes</p>
          <h4>Login with</h4>
          <ul>
            <li><a href="#"><i class="fa fa-facebook"></i> Facebook</a>
            </li>
            <li><a href="#"><i class="fa fa-google"></i> Google+</a>
            </li>
            <br><br><br>
          </ul>
        </div>
        <div class="log-in-pop-right">
          <a href="#" class="pop-close" data-dismiss="modal"><img src="images/cancel.html" alt="" />
          </a>
          <h4>Create an Account</h4>
          <p>Don't have an account? Create your account. It's take less then a minutes</p>
          <form class="s12" id="signup_form">
            <div>
              <div class="input-field s12">
               <div class="form-group">
                       
                         <input type="email" placeholder="Enter Your Email" class="form-control" required onblur="check_email()" value="" id="user_email" autocomplete="off">
                        <div class="d">
                            <span id="signup_email_error"></span>
                        </div>
                    </div>
              </div>
            </div>
            <div>
              <div class="input-field s12">
               <div class="form-group">
                        <input type="text" placeholder="Mobile Number" class="form-control" required id="user_mobile_no" value="" onkeyup="check_signup_number()" autocomplete="off">
                        <div class="d">
                            <span id="signup_mob_error"></span>
                        </div>
                    </div> 
              </div>
            </div>
            <div>
              <div class="input-field s12">
                 <div class="form-group">
                        <input type="Password" placeholder="Set Your 4 digit mpin" class="form-control" required onkeyup="check_password()" id="user_pass" value="" autocomplete="off" maxlength="4" minlength="4">
                        <div class="d">
                            <span id="signup_pass_error"></span>
                        </div>
                    </div> 
              </div>
            </div>
            <div>
              <div class="input-field s12">
               <div class="form-group">
                        <p>You have reffer code? Please Enter here.</p>
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="Enter Reffer Code (optional)" class="form-control" required onblur="check_reffer_code()" value="" id="reffer_code" autocomplete="off">
                        <div class="d">
                            <span id="signup_ref_error"></span>
                        </div>
                    </div>
              </div>
            </div>
            <div>
              <div class="input-field s4">
                <input type="submit" value="Register" class="waves-effect waves-light log-in-btn"  data-toggle="modal"   onclick="signup_user()"> </div>
            </div>
            <div>
              <div class="input-field s12"> <a href="#" data-toggle="modal"  onclick="show_login()">Are you a already member ? Login</a> </div>
            </div>
          </form>
        </div>
      </div>   
  </div> 
        <!--forgot modal-->

         <div   id="ForgotModal" class="modal" data-easein="pulse"  tabindex="-1" role="dialog" aria-labelledby="costumModalLabel" aria-hidden="true">
        <div class="modal-dialog">
           </div>
       </div>

       

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="<?php echo base_url('wassets/js/jquery.bootstrap-responsive-tabs.min.js');?>">
        </script>
        <script src="<?php echo base_url('wassets/js/bootstrap.min.js')?>">
        </script>
        <script src="<?php echo base_url('wassets/js/jquery-ui.min.js');?>">
        </script>
        <script src="<?php echo base_url('wassets/js/owl.carousel.js');?>">
        </script>
        <script src="<?php echo base_url('wassets/js/slick.min.js');?>"></script>
        <script src="<?php echo base_url('wassets/js/matchHeight.min.js');?>">
        </script>
        <script src="<?php echo base_url('wassets/js/bootstrap-select.js');?>">
        </script>
        <script src="<?php echo base_url('wassets/js/custom.js');?>">
        </script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/velocity/1.2.2/velocity.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/velocity/1.2.2/velocity.ui.min.js'></script>
        <script type="text/javascript">
          $(".modal").each(function(l){$(this).on("show.bs.modal",function(l){var o=$(this).attr("data-easein");"shake"==o?$(".modal-dialog").velocity("callout."+o):"pulse"==o?$(".modal-dialog").velocity("callout."+o):"tada"==o?$(".modal-dialog").velocity("callout."+o):"flash"==o?$(".modal-dialog").velocity("callout."+o):"bounce"==o?$(".modal-dialog").velocity("callout."+o):"swing"==o?$(".modal-dialog").velocity("callout."+o):$(".modal-dialog").velocity("transition."+o)})});
        </script>
        <script>
            $('.responsive-tabs').responsiveTabs({
                accordionOn: ['xs', 'sm']
            });
        </script>
        <script type="text/javascript">
            $('.ststCntnr').owlCarousel({
                loop: true,
                margin: 5,
                nav: true,
                dots: false,
                navText: ["<i class='icon-arrow-left'></i>", "<i class='icon-arrow-right'></i>"],
                autoPlay: 1000,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    1000: {
                        items: 4
                    }
                }
            });
        </script>
        <script type="text/javascript">
            $('#owl-demo').owlCarousel({
                loop: true,
                margin: 10,
                nav: false,
                autoPlay: 1000,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 1
                    },
                    1000: {
                        items: 3
                    }
                }
            });
        </script>

        <script>
            $(document).ready(function() {

                var owl = $("#owl-demo");

                owl.owlCarousel({
                    items: 3, //10 items above 1000px browser width
                    itemsDesktop: [1000, 3], //5 items between 1000px and 901px
                    itemsDesktopSmall: [900, 3], // betweem 900px and 601px
                    itemsTablet: [600, 2], //2 items between 600 and 0
                    itemsMobile: false // itemsMobile disabled - inherit from itemsTablet option

                });

                // Custom Navigation Events
                $(".next").click(function() {
                    owl.trigger('owl.next');
                })
                $(".prev").click(function() {
                    owl.trigger('owl.prev');
                })
                $(".play").click(function() {
                    owl.trigger('owl.play', 1000); //owl.play event accept autoPlay speed as second parameter
                })

            });

            //plugin bootstrap minus and plus
            //http://jsfiddle.net/laelitenetwork/puJ6G/
            $('.btn-number').click(function(e) {
                e.preventDefault();

                fieldName = $(this).attr('data-field');
                type = $(this).attr('data-type');
                var input = $("input[name='" + fieldName + "']");
                var currentVal = parseInt(input.val());
                if (!isNaN(currentVal)) {
                    if (type == 'minus') {

                        if (currentVal > input.attr('min')) {
                            input.val(currentVal - 1).change();
                        }
                        if (parseInt(input.val()) == input.attr('min')) {
                            $(this).attr('disabled', true);
                        }

                    } else if (type == 'plus') {

                        if (currentVal < input.attr('max')) {
                            input.val(currentVal + 1).change();
                        }
                        if (parseInt(input.val()) == input.attr('max')) {
                            $(this).attr('disabled', true);
                        }

                    }
                } else {
                    input.val(0);
                }
            });
            $('.input-number').focusin(function() {
                $(this).data('oldValue', $(this).val());
            });
            $('.input-number').change(function() {

                minValue = parseInt($(this).attr('min'));
                maxValue = parseInt($(this).attr('max'));
                valueCurrent = parseInt($(this).val());

                name = $(this).attr('name');
                if (valueCurrent >= minValue) {
                    $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
                } else {
                    alert('Sorry, the minimum value was reached');
                    $(this).val($(this).data('oldValue'));
                }
                if (valueCurrent <= maxValue) {
                    $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
                } else {
                    alert('Sorry, the maximum value was reached');
                    $(this).val($(this).data('oldValue'));
                }

            });
            $(".input-number").keydown(function(e) {
                // Allow: backspace, delete, tab, escape, enter and .
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                    // Allow: Ctrl+A
                    (e.keyCode == 65 && e.ctrlKey === true) ||
                    // Allow: home, end, left, right
                    (e.keyCode >= 35 && e.keyCode <= 39)) {
                    // let it happen, don't do anything
                    return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });

            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                autoPlay: 1000,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 1
                    },
                    1000: {
                        items: 1
                    }
                }
            })

            $('#EventDetails').on('shown.bs.modal', function() {
                $('#myInput').focus()
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#mobile').keyup(function() {

                    var mobile = document.getElementById("mobileno");
                    var value = $('#mobileno').val();

                    $.ajax({
                        url: base_url + "check_operator",
                        type: "POST",
                        data: {
                            'mobile': value

                        },
                        success: function(data) {
                           // alert('test');
                            $("#rec_category").val(1);

                            var getdata = jQuery.parseJSON(data);
                            var operator_id = getdata.operator_id;
                            var operator_name = getdata.operator_name;
                           
                            if (operator_id) {
                                $("#mobile_operator_id").val(operator_id).change();
                            } else {
                                $("#mobile_operator_id").val(0).change();
                            }

                        }
                    });
                    if (value.length == 11) {
                    	
                        $("#mob_num_error").removeClass("errormsg");
                        $("#mob_num_error").text("");
                    } else if (isNaN($('#mobile').val())) {
                        $("#mob_num_error").addClass("errormsg");
                      $("#mob_num_error").text("Enter valid 11 digit mobile number");
                    } else {
                        $("#mob_num_error").addClass("errormsg");
                        $("#mob_num_error").text("Enter valid 11 digit mobile number");
                    }

                });
                $('#tv_number').keyup(function() {

                    var tv_number = $('#tv_number').val();
                    if ($('#tv_number').val().length >= 5) {
                   //     $('#preloader').showLoading();

                        $("#dth_num_error").text("");
                        $("#dth_num_error").removeClass("errormsg");
                        var tv_operator_id = $("#dth_operator_id").val();
                        $.ajax({
                            url: base_url + "validate_tv_number",
                            type: "POST",
                            data: {
                                'tv_number': tv_number,
                                'tv_operator_id': tv_operator_id

                            },
                            success: function(data) {
                             //   $('#preloader').hideLoading();
                                $("#rec_category").val(2);
                                var getdata = jQuery.parseJSON(data);
                                var status = getdata.status;
                                if (status == 'true') {
                                    var customer_name = getdata.customer_name;
                                    $("#tv_number_name").val(customer_name);
                                    $("#service_id").val(getdata.service_id);
                                    $("#tv_new_number").val(getdata.customer_no);
                                } else {
                                    var message = getdata.message;
                                    $("#tv_number_name").val(message);

                                }

                            }

                        });
                    } else if (isNaN($('#tv_number').val())) {
                        $("#dth_num_error").addClass("errormsg");
                        $('#dth_num_error').text('Please Enter a valid Tv number');
                    } else {
                        $("#dth_num_error").addClass("errormsg");
                        $("#dth_num_error").text("Please Enter a valid Tv number");

                    }

                });

                $('#data_card_number').keyup(function() {
                    var value = $('#data_card_number').val();
                    if ($('#data_card_number').val().length >= 5) {
                        $("#data_number_error").text("");
                        $("#data_number_error").removeClass("errormsg");
                        var data_card_number = $("#data_card_number").val();
                        var datacard_operator_id = $("#datacard_operator_id").val();

                        $.ajax({
                            url: base_url + "validate_data_number",
                            type: "POST",
                            data: {
                                'data_number': data_card_number,
                                'data_operator_id': datacard_operator_id

                            },
                            success: function(data) {
                                $("#rec_category").val(3);
                                var getdata = jQuery.parseJSON(data);
                                var status = getdata.status;
                                if (status == 'true') {

                                    var customer_name = getdata.customer_name;
                                    $("#data_card_number_name12").val(customer_name);
                                    if (getdata.plans == '') {
                                        $("#plan_div").attr('style', 'display: none');
                                        $('#datacard_amount').attr('readonly', 'false');
                                    } else {
                                        $("#plan_div").attr('style', 'display: block');
                                        $('#datacard_amount').attr('readonly', 'true');
                                    }
                                } else {
                                    var message = getdata.message;

                                    $("#data_card_number_name12").val(message);
                                    $("#datacard_next").attr('style', 'display: none');
                                }

                            }

                        });
                    } else if (isNaN($('#data_card_number').val())) {
                        $("#data_number_error").addClass("errormsg");
                        $('#data_number_error').text('Please Enter a valid Data card number');
                    } else {
                        $("#data_number_error").addClass("errormsg");
                        $("#data_number_error").text("Please Enter minimum 5 digit Data card number");
                    }

                });

            });



        </script>

        <div id="fb-root"></div>
        <!--<script>
            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.8&appId=1716710845207683";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>-->
        <script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '594649877357899',
      xfbml      : true,
      version    : 'v3.1'
    });
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>

        <script>
            function show_login() {
            	
            	$("#SignupModal").modal('hide');
                $("#LoginModal").modal();
            }
            // Auto logout functionlity


function reset_interval()
{
//resets the timer. The timer is reset on each of the below events:
// 1. mousemove   2. mouseclick   3. key press 4. scroliing
//first step: clear the existing timer
clearInterval(3000000);
//second step: implement the timer again
timer=setInterval("Logout()",3000000);

}

function auto_logout()
{
//this function will redirect the user to the logout script
localStorage.setItem("mobileno","");
	location.href = home_url +"web/logout";
	 localStorage.clear();
}
        </script>
        





</body>

</html>