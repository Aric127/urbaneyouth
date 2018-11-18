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
      <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
      <script src="<?php echo base_url(); ?>wassets/js/config.js"></script>
    <script src="<?php echo base_url('wassets/js/my.js'); ?>"></script>
    <!-- Bootstrap -->
      <link href="<?php echo base_url('wassets/css/bootstrap.min.css');?>" rel="stylesheet">
      <link href="<?php echo base_url('wassets/css/style.css');?>" rel="stylesheet">
      <link href="<?php echo base_url('wassets/css/responsive.css');?>" rel="stylesheet">
      <link href="<?php echo base_url('wassets/css/recharge.css');?>" rel="stylesheet">

      <link href="<?php echo base_url('wassets/css/font-awesome.css');?>" rel="stylesheet">
      <link href="<?php echo base_url('wassets/css/simple-line-icons.css');?>" rel="stylesheet">
      <link href="<?php echo base_url('wassets/css/owl.carousel.css');?>" rel="stylesheet">
      <link href="<?php echo base_url('wassets/css/bootstrap-responsive-tabs.css');?>" rel="stylesheet">
      <link href="<?php echo base_url('wassets/css/owl.carousel.css');?>" rel="stylesheet">
      <link href="<?php echo base_url('wassets/css/bootstrap-select.css');?>" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
      <!--<link href="https://fonts.googleapis.com/css?family=Arima+Madurai:100,300,400,500,700,900" rel="stylesheet">-->
      <link href="https://fonts.googleapis.com/css?family=Arima+Madurai:100,300,400,500,700,900|Roboto:100,300,400,500,700" rel="stylesheet">
      <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
   </head>
   <body style="background-color: #f3f3f3;" onmousemove="reset_interval()" onclick="reset_interval()" onkeypress="reset_interval()" onscroll="reset_interval()">
   <!-------------------------Header Start------------------------>
      <div class="hero" id="top">
         <div class="navbar " id="scroll_to" role="navigation">
            <div class="container">
               <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-4">
                     <a href="<?php echo base_url('web') ?>" title="OyaCharge">
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




    <nav role="navigation" class="navbar navbar-default menu-head-b menu-for-mobile-inner">
        <div class="navbar-header">

            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">

                <span class="sr-only">Toggle navigation</span>

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>

            </button>
        </div>

        <div id="navbarCollapse" class="collapse navbar-collapse menu-head-b">

            <ul class="nav navbar-nav">

                <li ><a href="javascript:void(0)" onclick="Home()">
                    <div class="inner-heading-m">
                      <figure>
                        <i class="icon-home"></i>
                        <p>Home</p>
                      </figure>
                    </div>
                  </a>
                </li>

                <li <?php  if(!empty($uri_segment)) if($uri_segment=='my_profile'){ ?> class="active" <?php } ?>>
                <a href="<?php echo base_url('My-Account');?>">
                    <div class="inner-heading-m">
                      <figure>
                        <i class="icon-user"></i>
                        <p>My Account</p>
                      </figure>
                    </div>
                  </a>
                </li>
				
				      <li <?php if(!empty($uri_segment)) if($uri_segment=='save_card'){ ?> class="active" <?php } ?>>
                <a href="<?php echo base_url('Save-Cards');?>">
                    <div class="inner-heading-m">
                      <figure>
                        <i class="icon-credit-card"></i>
                        <p>Save Cards</p>
                      </figure>
                    </div>
                  </a>
                </li>

                <li <?php if(!empty($uri_segment)) if($uri_segment=='my_trans'){ ?> class="active" <?php } ?>>
                  <a href="<?php echo base_url('Transaction');?>">
                    <div class="inner-heading-m">
                      <figure>
                        <img src="<?php echo base_url('wassets/images/my-transaction.png');?>"  width="28">
                        <p>My Transactions</p>
                      </figure>
                    </div>
                  </a>

                </li>

                <li <?php if(!empty($uri_segment)) if($uri_segment=='wallet_amount'){ ?> class="active" <?php } ?>>
                  <a href="<?php echo base_url('Wallet');?>">
                    <div class="inner-heading-m">
                      <figure>
                        <img src="<?php echo base_url('wassets/images/wallet-icon-head.png');?>"  width="29">
                        <p>Wallet</p>
                      </figure>
                    </div>
                  </a>

                </li>
                <!-- <li>
                  <a href="#">
                    <div class="inner-heading-m">
                      <figure>
                        <img src="https://oyacharge.com/wassets/images/sms-management.png" width="28">
                        <p>SMS Management</p>
                      </figure>
                    </div>
                  </a>

                </li>
                <li>
                  <a href="#">
                    <div class="inner-heading-m">
                      <figure>
                        <i class="icon-key"></i>
                        <p>Change Password</p>
                      </figure>
                    </div>
                  </a>
                </li> -->
                <li>
                  <a onclick="Logout()" title="Logout" href="#">
                    <div class="inner-heading-m">
                      <figure>
                        <i class="icon-logout"></i>
                        <p>Logout</p>
                      </figure>
                    </div>
                  </a>

                </li>

            </ul>

        </div>

    </nav> 

<script>
         $('.responsive-tabs').responsiveTabs({
           accordionOn: ['xs', 'sm']
         });
</script>




             <!--<div class="menu-head-b clearfix col-sm-12 col-md-12 col-xs-12">
                  <a href="#">
                    <div class="inner-heading-m">
                      <figure>
                        <i class="icon-home"></i>
                        <p>Home</p>
                      </figure>
                    </div>
                  </a>
                  <a href="#">
                    <div class="inner-heading-m">
                      <figure>
                        <i class="icon-user"></i>
                        <p>My Account</p>
                      </figure>
                    </div>
                  </a>
                  <a href="#">
                    <div class="inner-heading-m">
                      <figure>
                        <img src="https://oyacharge.com/wassets/images/my-transaction.png"  width="28">
                        <p>My Transactions</p>
                      </figure>
                    </div>
                  </a>
                  <a href="#">
                    <div class="inner-heading-m">
                      <figure>
                        <i class="icon-wallet"></i>
                        <p>Wallet</p>
                      </figure>
                    </div>
                  </a>
                   <a href="#">
                    <div class="inner-heading-m">
                      <figure>
                        <img src="https://oyacharge.com/wassets/images/sms-management.png" width="28">
                        <p>SMS Management</p>
                      </figure>
                    </div>
                  </a>
                  <a href="#">
                    <div class="inner-heading-m">
                      <figure>
                        <i class="icon-key"></i>
                        <p>Change Password</p>
                      </figure>
                    </div>
                  </a>
                  <a onclick="Logout()" title="Logout" href="#">
                    <div class="inner-heading-m">
                      <figure>
                        <i class="icon-logout"></i>
                        <p>Logout</p>
                      </figure>
                    </div>
                  </a>
              </div>-->  <!--menu-head-b-->
            </div><!--row-->
            </div><!--cont-->
</div><!--cont-fluid-->

<!-------------------------Header-menu End------------------------>