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
    <link href="<?php echo base_url('wassets/css/owl.carousel.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('wassets/css/bootstrap-select.css');?>" rel="stylesheet">
    <!--<link href="https://fonts.googleapis.com/css?family=Arima+Madurai:100,300,400,500,700,900" rel="stylesheet">-->
    <link href="https://fonts.googleapis.com/css?family=Arima+Madurai:100,300,400,500,700,900|Roboto:100,300,400,500,700" rel="stylesheet">
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
