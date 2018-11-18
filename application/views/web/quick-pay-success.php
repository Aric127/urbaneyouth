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
      <link href="https://oyacharge.com/wassets/css/recharge.css" rel="stylesheet">

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
   </head>
   <body style="background-color: #f3f3f3;" onmousemove="reset_interval()" onclick="reset_interval()" onkeypress="reset_interval()" onscroll="reset_interval()">
   <!-------------------------Header Start------------------------>
      <div class="hero" id="top">
         <div class="navbar" id="scroll_to" role="navigation">
            <div class="container">
               <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-4">
                     <a href="<?php echo base_url('web') ?>" title="Lexi app landing page">
                     <img src="<?php echo base_url('wassets/images/logo.png');?>"> </a>
                  </div>
                  <!-- <div class="col-md-8 col-sm-6 col-xs-12">
                      <ul class="nav animated-nav navbar-nav">
                        <li><a href="#"><span data-hover="Home">Home</span></a></li>
                        <li><a href="#"><span data-hover="About"> About</span></a></li>
                        <li><a href="#"> <span data-hover="Share & Earn"> Share & Earn</span></a></li>
                        <li><a href="#faq" title="FAQ"><span data-hover="FAQ">FAQ</span></a></li>
                        <li><a href="#contact" title="Contact"><span data-hover="Contact">Contact</span></a></li>
                        <?php $user_id= $this->session->userdata('user_id'); 
                        if(empty($user_id)){?>
                <li><a href="<?php echo site_url('web/recharge_details') ?>" data-toggle="modal" title="Contact"><span data-hover="Login">Login</span></a></li>
                 <!--  <li><a href="#LoginModal" data-toggle="modal" title="Contact"><span data-hover="Login">Login</span></a></li> --
                <?php }else { ?>
                    <li><a onclick="Logout()" title="Logout"><span data-hover="Logout">Logout</span></a></li>
              <?php  } ?>
                     </ul>  
                  </div> -->
                  <!-- <div class="col-md-2 col-sm-3 col-xs-5 menu">
                     <a href="#">Menu</a> 
                     <div id="nav_icon">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                     </div>
                  </div> -->
               </div>
            </div>
         </div>
        </div>
        <!-------------------------Header End------------------------>

<div class="container-fluid">
<div class="row heading-menu"> 
            <div class="container">
    
<script>
         $('.responsive-tabs').responsiveTabs({
           accordionOn: ['xs', 'sm']
         });
</script>




             
            </div><!--row-->
            </div><!--cont-->
</div><!--cont-fluid-->

<!-------------------------Header-menu End------------------------>


<div class="container-fluid"> 
      <div class="container over-lap-div">
         <div class="col-sm-12 col-xs-12 col-lg-12 recharge-result" style="min-height: 450px; margin-top: -83px;">
			<div class="col-sm-12 col-xs-12 col-lg-12">
				
			 
			
		 
<!------------------------------- mass. box --------------------------------->
<!-------------------------------- mass. box -------------------------------->
         <?php if(!empty($status)){ if($status=='true'){ ?>
          <div class="alert alert-success alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			 </button>
		  
					<strong>Success!</strong> <?php if(!empty($message)) echo $message;?>
				</div>
		 
           
<?php }}
 if(!empty($status)){ if($status=='false'){ ?>
 
				<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					 </button>
					<strong>Error!</strong> <?php if(!empty($recharge_type)) echo $recharge_type." ";?><?php if(!empty($message)) echo $message;?>
				 </div>
          
<?php  }} ?>
</div>
<!--------------------------------mass. box-------------------------------->
<!--------------------------------mass. box-------------------------------->

         <div class="clearfix"></div>

         <div class="col-sm-12 detail-success">
             <div class="col-md-6 spd">
                 <div class="row"><!-- ngIf: currentWorkflow.formData.connectionNumber -->
                <?php if($wt_category!='1' && $wt_category!='13' && $wt_category!='16' && $wt_category!='11' && $wt_category!='17'){ ?>
                   <div>
                       <div class="col-md-6 head-detail-succ"> <p><?php if(!empty($recharge_type)) echo $recharge_type;?> Number </p>
                       </div>
                       <div class="col-md-6 det-detail-succ"> <p> <?php if(!empty($recharge_no)) echo $recharge_no; ?> </p>
                       </div>
                       <div class="clearfix"></div>
                   </div>
                   <?php } ?>
                 <!-- end ngIf: currentWorkflow.formData.connectionNumber -->
                       <?php if($wt_category!='1' && $wt_category!='5' && $wt_category!='13' && $wt_category!='11'&& $wt_category!='16' && $wt_category!='17'){ ?>
                     <div>
                     <div class="col-md-6 head-detail-succ"> <p> Operator </p> </div>
                     <div class="col-md-6 det-detail-succ"> <p><img src="<?php if(!empty($operator_image)) echo $operator_image ?>" width="20" class="img-responsive pull-left" style="margin-left: 66%;"> <?php if(!empty($operator_name)) echo $operator_name; ?> </p>
                     </div>
                     <div class="clearfix"></div>
                     </div>
                       <?php } ?>
                        <?php  if($wt_category =='13'){ ?>
                     <div>
					 <div class="col-md-12">
					 <span class="img-succ-div">
						<img src="<?php if(!empty($operator_image)) echo $operator_image ?>" class="img-circle center-block" width="100" height="100">
						<h4 class="text-center">Church</h4>
					 </span>
					 
					 </div>
					 <div class="clearfix"></div>
					 <p></p><p></p>
					 <!--
                     <div class="col-md-6 head-detail-succ"> <p> Church </p> </div>
                     <div class="col-md-6 det-detail-succ"> <!--<p>
                     	<img src="<?php // if(!empty($operator_image)) echo $operator_image ?>" width="50" class="img-responsive pull-left" style="margin-left: 66%;">  </p>--
                     		 </div>-->
                     	  <div class="col-md-6 head-detail-succ"> <p> Church Name</p> </div> 
                     	  <div class="col-md-6 det-detail-succ"> <p><?php if(!empty($operator_name)) echo $operator_name; ?> </p>
                     </div>
                      <div class="col-md-6 head-detail-succ"> <p> Church Area</p> </div> 
                     	  <div class="col-md-6 det-detail-succ"> <p><?php if(!empty($church_area)) echo $church_area; ?> </p>
                     </div>
                     <div class="clearfix"></div>
                     </div>
                       <?php } ?>
                         <?php  if($wt_category =='11'){ ?>
                     <div>
                     <div class="col-md-6 head-detail-succ succus"> <p> Biller  </p> </div>
                     <div class="col-md-6 det-detail-succ succus"> <p>
                     	<img src="<?php if(!empty($operator_image)) echo $operator_image ?>" width="50" class="img-responsive pull-left" style="margin-left: 66%;">  </p>
                     		 </div>
                     	  <div class="col-md-6 head-detail-succ"> <p> Biller Name</p> </div> 
                     	  <div class="col-md-6 det-detail-succ"> <p><?php if(!empty($operator_name)) echo $operator_name; ?> </p>
                     </div>
                     
                     <div class="clearfix"></div>
                     </div>
                       <?php } ?>
                       <?php  if($wt_category =='16'){ ?>
                     <div>
                     <div class="col-md-6 head-detail-succ succus"> <p> Event </p> </div>
                     <div class="col-md-6 det-detail-succ succus"> <p>
                     	<img src="<?php if(!empty($operator_image)) echo $operator_image ?>" width="50" class="img-responsive pull-left" style="margin-left: 66%;">  </p>
                     		 </div>
                     		 <div class="clearfix"></div>
                     	  <div class="col-md-6 head-detail-succ succus"> <p> Event Name</p> </div> 
                     	  <div class="col-md-6 det-detail-succ succus"> <p><?php if(!empty($operator_name)) echo $operator_name; ?> </p>
                     </div>
                      <div class="col-md-6 head-detail-succ succus"> <p> Event Date</p> </div> 
                     	  <div class="col-md-6 det-detail-succ succus"> <p><?php if(!empty($event_date)) echo $event_date; ?> </p>
                     </div>
                    <!-- <?php print_r($ticket_records); ?>
                     <div class="col-md-6 head-detail-succ succus"> <p> Tickets</p> </div> 
                     	  <div class="col-md-6 det-detail-succ succus ticke"> <p>Gold<span>(3)</span>, silver <span>(5)</span>, platinum <span>(5)</span></p>
                     </div>-->
                     
                     
                     
                      <div class="col-md-6 head-detail-succ succus"> <p> Event Place</p> </div> 
                     	  <div class="col-md-6 det-detail-succ succus"> <p><?php if(!empty($event_place)) echo $event_place; ?> </p>
                     </div>
                     <div class="clearfix"></div>
                     </div>
                       <?php }else if($wt_category =='17'){ ?>

                    <div>
                  
                     <div class="col-md-6 det-detail-succ succus"> <p>
                      <img src="<?php if(!empty($operator_image)) echo $operator_image ?>" width="50" class="img-responsive pull-left" style="margin-left: 66%;">  </p>
                         </div>
                         <div class="clearfix"></div>
                        <div class="col-md-6 head-detail-succ succus"> <p> Account Holder Name</p> </div> 
                        <div class="col-md-6 det-detail-succ succus"> <p><?php if(!empty($account_name)) echo $account_name; ?> </p>
                     </div>
                      <div class="col-md-6 head-detail-succ succus"> <p> Account Number</p> </div> 
                        <div class="col-md-6 det-detail-succ succus"> <p><?php if(!empty($account_number)) echo $account_number; ?> </p>
                     </div>
                   <div class="col-md-6 head-detail-succ succus"> <p> Bank Code</p> </div> 
                        <div class="col-md-6 det-detail-succ succus"> <p><?php if(!empty($user_bank_code)) echo $user_bank_code; ?> </p>
                     </div>
                     <div class="clearfix"></div>
                     </div>

                        <?php } ?>
                     <!-- ngIf: currentWorkflow.formData.orderId -->
                 
                     <div>
                         <div class="col-md-6 head-detail-succ succus"><p> Transaction ID </p></div>
                         <div class="col-md-6 det-detail-succ succus"><p><?php  if(!empty($transaction_ref))echo $transaction_ref; ?></p></div>

                         <div class="clearfix"></div>
                     </div>
                      <div>
                         <div class="col-md-6 head-detail-succ succus"><p> Transaction Date</p></div>
                         <div class="col-md-6 det-detail-succ succus"><p><?php if(!empty($trans_date))echo $trans_date; ?></p></div>

                         <div class="clearfix"></div>
                     </div>
                     <div>
                         <div class="col-md-6 head-detail-succ succus"><p> Payment via</p></div>
                         <div class="col-md-6 det-detail-succ succus"><p><?php if(!empty($transaction_via))echo $transaction_via; ?></p></div>

                         <div class="clearfix"></div>
                     </div>

                     <!-- end ngIf: currentWorkflow.formData.orderId --><!-- ngIf: currentWorkflow.formData.viewPmntKeys && currentWorkflow.formData.viewPmntKeys.screen3 -->

                     </div>
                 <div class="clearfix"></div>
                 <hr>
                 <div class="clearfix"></div>
                     <div class="row">
                     <div class="col-md-6">Amount</div>
                     <div class="col-md-6 det-detail-succ">&#8358; <?php if(!empty($amount))echo $amount; ?>
                     </div>
                     <div class="clearfix"></div>
                     <!-- ngIf: $root.supercash.enabled && currentWorkflow.formData.payViaSupercash > 0 && !currentWorkflow.formData.promoSelected -->
                     </div>
                 <div class="clearfix"></div>
                     <div class="paid-btn-tot">
                     <div class="row">
                       <div class="col-md-6">
                            <b>Total Amount Paid</b>
                       </div>
                       <div class="col-md-6 text-right">
                            <b>&#8358; <?php if(!empty($amount))echo $amount; ?></b>
                       </div>
                     </div>
                     </div>
              </div>
             <div class="col-md-6 rgtcolm">
                   <div class="center-block">
                   <img src="https://oyacharge.com/wassets/images/happy1.png" width="100%" >
                   <!-- <img src="https://oyacharge.com/wassets/images/happy1.png" width="100%"> -->






                   </div>
             </div>
         </div>


















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




</body>
</html>