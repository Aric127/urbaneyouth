<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>OyaCharge</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>webassets/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>webassets/css/recharge.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>webassets/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://oyacharge.com/webassets/images/favicon.png" type="image/png" rel="shortcut icon">
    <link href="<?php echo base_url(); ?>webassets/css/magicsuggest.css" rel="stylesheet"> 
    <script src="<?php echo base_url(); ?>webassets/js/jquery-1.11.1.min.js"></script>
    <script src="<?php echo base_url(); ?>webassets/js/config.js"></script>
    <script src="<?php echo base_url(); ?>webassets/js/my.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
     <link href='https://fonts.googleapis.com/css?family=Alegreya+Sans:300' rel='stylesheet' type='text/css'>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
		$(document).ready(function(){
			$(window).on('load',function(){
				$("#overlay").addClass('active');
				 setTimeout(function (){ loader() }, 2000);
				 function loader(){
					$("#overlay").removeClass('active');
				 }
				//$("#overlay").addClass('active');
			})
		
		});
	
	</script>
    <style>
		body{font-family: 'Roboto', sans-serif;}
	</style>
  </head>
  <body class="bg"> 
<div id="overlay" class="overlay">
<div id="loader"></div>
</div>
  <div class="inner-header">
  	<div class="menu-button">
    	<div class="menu_bar"></div>
        <div class="menu_bar"></div>
        <div class="menu_bar"></div>
    </div>
    <div class="user_box">
        <div class="user-icon">
            <img width="96" src="<?php echo base_url(); ?>webassets/images/login_icon.png" alt="..."/>
        </div>
        <div class="user-login">
            <?php // $user_id= $this->session->userdata('user_id');
               $user_email= $this->session->userdata('user_email');
       ?>
            <h4 id="user_fullname"><?php if(!empty($my_profile)){echo $my_profile->user_name;}?></h4>
            <p id="useremail"><?php  if(!empty($my_profile)){echo $my_profile->user_email;}?></p>
            
        </div>
    </div>
  	<div class="menu_inner">
    	<div class="logo">
    		<img width="160" src="<?php echo base_url(); ?>webassets/images/logo.png" alt="..."/>
    	</div>
        <ul>
        	<!--<li><a href="<?php echo site_url('website') ?>"><i class="menu-icons home"></i>  Home</a></li>-->
        	<li><a href="#" onclick="home()"><i class="menu-icons home"></i>  Home</a></li>
            <li><a href="<?php echo site_url('website/my_profile') ?>"><i class="menu-icons user"></i>  My Account</a></li>
            <li><a href="<?php echo site_url('website/my_transaction') ?>" ><i class="menu-icons clock-o "></i>  My Transactions</a></li>
            <li><a href="<?php echo site_url('website/my_wallet') ?>"><i class="menu-icons wallet"></i>  Wallet <span class="wallet_amount"><?php echo $my_wallet ;?></span></a></li>
            <li><a href="<?php echo site_url('website/transfer_money') ?>"><i class="menu-icons transfer-icon"></i>  Transfer Money</a></li>
            <li><a href="<?php echo site_url('website/sms_management') ?>"><i class="menu-icons envelope"></i>  SMS Management</a></li>
             <li><a href="<?php echo site_url('website/share_earn') ?>"><i class="menu-icons share"></i>  Share and Earn</a></li>
              <li><a href="<?php echo site_url('website/change_password') ?>"><i class="menu-icons user"></i>Change Password</a></li>
            <li><a href="<?php echo site_url('website/logout'); ?>"><i class="menu-icons lock"></i>  Logout</a></li>
        </ul>
    </div>
  </div>
  <div class="clearfix"></div>
  

