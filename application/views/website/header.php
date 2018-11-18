<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta property="og:url"           content="http://www.oyacharge.com" />
	<meta property="og:type"          content="website" />
	<meta property="og:title"         content="OyaCharge Recharge" />
	<meta property="og:description"   content="OyaCharge Recharge Website" />
	<meta property="og:image"         content="<?php echo base_url('webassets/images/webpay.png') ?>" />
</head>
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>OyaCharge</title>
 <script src="<?php echo base_url(); ?>webassets/js/jquery-1.11.1.min.js"></script>
    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>webassets/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>webassets/css/recharge.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>webassets/css/font-awesome.min.css" rel="stylesheet">
     <link href="<?php echo base_url(); ?>webassets/css/magicsuggest.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>webassets/css/owl.carousel.css" rel="stylesheet"> 
   <link rel="shortcut icon" type="image/png" href="<?php echo base_url(); ?>webassets/images/favicon.png"/>

    <script src="<?php echo base_url(); ?>webassets/js/config.js"></script>
    <script src="<?php echo base_url(); ?>webassets/js/my.js"></script>
    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>webassets/css/dd.css" />
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Alegreya+Sans:300' rel='stylesheet' type='text/css'>
    
	<script src="<?php echo base_url(); ?>webassets/js/jquery.dd.min.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
 

<script>
		$(document).ready(function(){
						$(window).on('load',function(){
							localStorage.setItem('tv_customer_no',"");
							$("#overlay").addClass('active');
							 setTimeout(function (){ loader() }, 2000);
							 function loader(){
							 	$("#overlay").removeClass('active');
							 }
							//$("#overlay").addClass('active');
							$("#tv_number").val('');
							$("#data_card_number").val('');
							var status="<?php  echo $this->uri->segment(3); ?>";
							var user_id='<?php echo  $this->uri->segment(4); ?>';
							var g_login='<?php echo  $this->uri->segment(5); ?>';
							if(g_login =='1'){
							if(status=='2'){
								
								$("#userid").val(user_id);
								$('#upgrate').modal('show');
								$("#user_signup_id").val(user_id);
								
							}else if(status=='11'){
								
								var msg='Account Inactive by admin, please contact to OyaCahrge';
								$('#loginPop').modal('show');
								$("#response_failed").text(msg);
								
						
							  }
							}else if(status=='11'){
								if(g_login=='2'){
								var msg='Account Inactive by admin, please contact to OyaCahrge';
								$('#loginPop').modal('show');
								$("#response_failed").text(msg);
								}
							}
							
							});
						});
					//});
</script>

<?php if(!empty($_REQUEST['another_rec'])){ ?>
	<script>
		$(document).ready(function()
		{
				localStorage.removeItem("amount");
			$(window).on('load',function()
			{
							var another="<?php  echo $_REQUEST['another_rec']; ?>";
							if(another==10)
							{
								$("#mRechargeSlider").addClass('active');
							}
							if(another==11)
							{
								
								$("#tvRechargeSlider").addClass('active');
							}
							if(another==12)
							{
								$("#dataRechargeSlider").addClass('active');
							}
			});
		});
</script>
<?php }?>
<?php
 $recharge_status= $this->session->userdata('recharge_status'); 
 $mobile= $this->session->userdata('mobile'); 
  $tv_number= $this->session->userdata('tv_number'); 
   $data_card_number= $this->session->userdata('data_card_number'); 
 if((!empty($recharge_status) && ($mobile)) || !empty($recharge_status) && ($tv_number)|| !empty($recharge_status) && ($data_card_number)){?>
 	<script>
 		$(document).ready(function()
		{
			$(window).on('load',function()
			{ 
				var mobile="<?php  echo $this->session->userdata('mobile'); ?>";
				var tv_number="<?php  echo $this->session->userdata('tv_number'); ?>";
				var data_card_number="<?php  echo $this->session->userdata('data_card_number'); ?>";
				if(mobile){
			 	 var mobile_operator_id="<?php echo $this->session->userdata('mobile_operator_id');?>";
				 var prepaid="<?php echo $this->session->userdata('prepaid');?>";
			 	 var mobile_amount="<?php echo $this->session->userdata('mobile_amount');?>"
				 location.href=site_url+"my_recharge?mobile=" +mobile + "&prepaid=" + prepaid+"&mobile_operator_id="+mobile_operator_id+"&mobile_amount="+mobile_amount;
			 }else if(tv_number){
			 
			    var tv_mobile_operator="<?php echo $this->session->userdata('tv_operator_id');?>";
			   var tv_rec_amount="<?php echo $this->session->userdata('tv_rec_amount');?>";
			   location.href=site_url+"tv_recharge?tv_number=" +tv_number + "&tv_operator_id=" + tv_mobile_operator+"&tv_rec_amount="+tv_rec_amount;
			 }else if(data_card_number){
			 	
			 	var datacard_operator="<?php echo $this->session->userdata('data_operator_id');?>";
				var datacard_amount="<?php echo $this->session->userdata('data_rec_amount');?>";
				var data_prepaid="<?php echo $this->session->userdata('data_prepaid');?>";
				location.href=site_url+"datacard_recharge?data_card_number=" +data_card_number + "&data_operator_id=" + data_operator_id+"&data_rec_amount="+data_rec_amount+"&data_prepaid="+data_prepaid;
			 }
			});
		});
		</script>
<?php }
  ?>
<!--div id="overlay" class="overlay">
	<div id="loader"></div>
</div-->
  </head>
  <body class="bg">
  	
  	<div class="open_popup" id="popup">
        <div class="notify_bell">
            <i class="fa fa-bell-o text-center" aria-hidden="true"></i>
        </div>
        <div class="txt">
        	<p>Stay tuned for more offers with OyaCharge !!!</p>
        </div>
    	<div class="form-group">
    		<button type="button" class="close"  onclick="close_pop_field()">
            <span aria-hidden="true">&times;</span></button>
    	</div>
        <div class="form-group">
        	<input type="text" class="form-control" id="exampleInputname1" placeholder="Mobile No." value="">
        </div>
        <div class="clearfix"></div>
         <div class="text-center">
        	<button type="button" class="btn btn-default" onclick="send_link();">Send</button>
        	<span id="link_msg" style="color:red"></span>
        </div>
    </div>
  <div class="overlay-menu"></div>
  <header>
  <div class="container">
    <div class="row">
        <div class="col-sm-12 col-xs-12">
            <nav class="nav_block">
                <div class="main-header logo"> 
                    <img src="<?php echo base_url(); ?>webassets/images/logo-main.png" alt="..."/>
                </div>
                <div class="menu-bar">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <div class="menu" >
                    <ul>
                        <li<?php if(($this->uri->segment(1) == 'website') && ($this->uri->segment(2) == '' || $this->uri->segment(2) == 'index')){ ?> class="active"<?php } ?>><a href="<?php echo site_url('website') ?>">Home</a></li>
                        <li <?php if($this->uri->segment(2) == 'about_us'){ ?>class="active"<?php } ?>><a href="#vedio_section">About</a></li>
                        <li ><a href="#share_section">Share & Earn</a></li>
                       <!-- <li><a href="#" data-toggle="modal" data-target="#LoginPop">SMS Management</a></li>-->
                       <li <?php if($this->uri->segment(2) == 'faq'){ ?> class="active" <?php } ?> >
                       <a href="<?php echo site_url('website/faq') ?>">FAQ</a></li>
                       <li <?php if($this->uri->segment(2) == 'contact_us'){ ?>class="active" <?php } ?>><a href="#contact_form ">Contact</a></li>
                        <?php   $user_id= $this->session->userdata('user_id'); 
								$verify_status= $this->session->userdata('verify_status');  
                        if (empty($user_id)) { ?>
           
                        <li onclick="login_popup();"><a href="#">Login</a></li>
                        <?php }else { ?>
                        <li  onclick="login_ul();"><a href="#"><span class="login-icon"><img width="25" src="<?php echo base_url(); ?>webassets/images/login_icon.png"/></span> </a>
                             <ul class="about-drop-down" type="none">
                                <li><a href="<?php echo site_url('website/my_profile') ?>">Account</a></li>
                                <li><a href="<?php echo site_url('website/my_wallet') ?>">Wallet</a></li>
                                <li><a href="<?php echo site_url('website/my_transaction') ?>">Transaction</a></li>
                                <li><a href="<?php echo site_url('website/logout'); ?>">Logout</a></li>
                            </ul>
                        </li>
                       <?php }?>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    </div>
    </header>

     
 <!------------- login popup -------------->          
<div class="modal fade popup" id="loginPop" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body padd-30">
      	 <div class="close-pop" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></div>
        <div class="row">
        	<div class="col-sm-7 col-xs-7 col-620">
            	<span class="text-green">Signin With Your OyaCharge Account</span>
            	<div id="response_success" style="color: green"></div>
            	
            </br>
          
            	<div class="form-group">
                	<input type="text" class="field" placeholder="Please Enter Mobile Number or Email " id="user_name" name="user_name" onblur="check_login_filed()">
                </div>
                <div class="form-group">
                	<input type="password" class="field" placeholder="Enter Password" id="user_pass" name="user_pass" onblur="check_login_filed()">
                </div>
                <div class="form-group">
                	<a href="#" onclick="forget()">Forgot Password?</a>
                </div>
                <div class="form-group">
                	<a class="field btn-green" href="javascript:void(0)" onclick="user_login()">LOGIN</a>
                </div>
            <div id="response_failed" style="color: red"></div>
            </div>
            <div class="col-sm-5 col-xs-5 col-620">
            	<span class="text-green">Or Login with</span>
            </br></br>
            	<div class="form-group">
                	<a style="cursor: pointer"><img src="<?php echo base_url(); ?>webassets/images/facebook_btn.png" alt="..." class="img-responsive" onclick="fb_login()"></a>
                </div>
                <div class="form-group">
                	<!-- <a style="cursor: pointer"><img src="<?php echo base_url(); ?>webassets/images/google_btn.png" alt="..." class="img-responsive" onclick="google_login()"></a> -->
                	<a href="<?php echo site_url('website/google_login/Google')?>" ><img src="<?php echo base_url(); ?>webassets/images/google_btn.png" alt="..." class="img-responsive"></a>
                </div>
            </div>
             <div class="clearfix"></div>
            <hr>
            <div class="col-sm-12 col-xs-12">
            	<p>Don't have an account? <a href="#" onclick="show_signup()">Signup here.</a></p>
            </div>
        </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!------------- signup popup -------------->          
<div class="modal fade popup" id="signup" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body padd-30">
      	 <div class="close-pop" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></div>
        <div class="row">
        	<div class="col-sm-12 col-xs-12">
            	<h2 class="text-green">Create Account</h2>
                 <div class="form-group">
                	<input type="text" class="field" placeholder="Mobile Number" id="user_mobile" onblur="check_signup_number()" autocomplete="off">
                </div>
                <div class="form-group">
                	<input type="text" class="field" placeholder="Enter Your Email" id="user_email" onblur="check_email()">
                </div>
                <div class="form-group">
                	<input type="password" class="field" placeholder="Enter Password" id="user_password" onblur="check_password()">
                </div>
                 <div class="form-group">
                	<p>You have reffer code? Please Enter here.</p>
                </div>
                <div class="form-group">
                	<input type="text" class="field" placeholder="Enter Refer Code (Optional)" id="reffer_code" value="" onblur="check_reffer_code()">
                </div>
                <div class="form-group">
                	<p>Tip: Protect your account. Use a mixed case alphanumeric password with special characters.</p>
                </div>
                <div class="form-group">
                	<a class="field btn-green" onclick="signup_user()" style="cursor: pointer" >CREATE ACCOUNT</a>
               </div>
               <div id="signup_msg" style="color:red"></div>
            </div>
             <div class="clearfix"></div>
            <hr>
            <div class="col-sm-12 col-xs-12">
            	<p>Already have an account? <a href="#" onclick="login_popup()">Login here.</a></p>
            </div>
        </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!---Forget Password---->
<div class="modal fade popup" id="forget_pass" tabindex="-1" role="dialog" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
      <div class="close-pop" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></div>
        <div class="row">
        	<div class="col-sm-8 col-xs-7 col-620 text-center offser-auto">
            	<h2 class="text-green">Forget Password</h2>
                <p>Enter Registered Email or Mobile Number</p>
            	<div class="form-group">
                	<input type="text" class="field" placeholder="ENTER YOUR MOBILE NUMBER OR EMAIL" id="login_id" value="">
                	
                </div>
                 <div class="form-group">
                 	<a  class="btn btn-green" id="send_btn" style="cursor: pointer" onclick="forget_password()" >Send</a>
                    <a  class="btn btn-green" id="resend_btn" style="cursor: pointer; display:none;" onclick="forget_password()" >Resend</a>
                    <a  class="btn btn-green" id="login_btn" style="cursor: pointer; display:none;" onclick="login_popup()" >Login</a>
                </div>
                <div id="msg_num"></div>
            </div>
            <div class="clearfix"></div>
        </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

 <!------------- Upgrate account popup -------------->          
<div class="modal fade popup" id="upgrate" tabindex="-1" role="dialog" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
      <div class="close-pop" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></div>
      <div class="clearfix"></div>
        <div class="row">
        	<div class="col-sm-8 col-xs-7 col-620 text-center offser-auto">
            	<h2 class="text-green">Upgrade your account</h2>
                <p>We will send a verification code via SMS to this number</p>
            	<div class="form-group">
                	<input type="text" class="field" placeholder="ENTER YOUR MOBILE NUMBER" id="mb_number">
                	<input type="hidden" id="userid" value="">
                </div>
                 <div class="form-group">
                 	<a  class="field btn-green" style="cursor: pointer" onclick="send_otp()" >Continue</a>
                </div>
                <div id="msg_num"></div>
            </div>
            <div class="clearfix"></div>
        </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

 <!------------- OTP Verification popup -------------->          
<div class="modal fade popup" id="OTP" tabindex="-1" role="dialog" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
      <div class="close-pop" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></div>
        <div class="row">
        	<div class="col-sm-8 col-xs-7 col-620 text-center offser-auto">
            	<h2 class="text-green">Verify your mobile number</h2>
                <p>We have send a 4-degit confirmation code to <span id="mob"></span></p>
            	<div class="form-group">
                	<input type="password" class="field" value="" placeholder="ENTER VERIFICATION CODE" id="otp_code">
                	<input type="hidden" id="user_signup_id" value="">
                	<input type="hidden" id="user_reffer_code" value="">
             </div></br>
                 <div class="form-group">
                	
                	<a class="field btn-green" style="cursor: pointer"  onclick="confirm_number()" >CONFIRM NUMBER</a>
                </div>
                <div class="form-group">
                	<p>Din't receive the pin?</p>
                    <div class="clearfix"></div>
                    <a href="#" class="btn btn-sm btn-default" onclick="resend_otp()">Resend</a>
                    <a href="#" class="btn btn-sm btn-warning change-num" onclick="change_number()">Change Number</a>
                </div>
                <div id="otp_msg" class="error_msg"></div>
            </div>
            <div class="clearfix"></div>
        </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

 <!------------- Recgarege plan popup -------------->          
<div class="modal fade popup" id="RechagePlan" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        	<h3><span id="operator_name"></span> Recharge Plans</h3>
            	<div class="scroll-tab">
            	 <ul class="nav nav-tabs" role="tablist" id="plan_category_list">
            	 	<!-- <li role="presentation" class="active"><a href="#Recommende" aria-controls="Recommende" role="tab" data-toggle="tab">Recommended</a></li> -->
                    <!-- <li role="presentation" class="active"><a href="#Recommende" aria-controls="Recommende" role="tab" data-toggle="tab">Recommended</a></li>
                    <li role="presentation"><a href="#FullTT" aria-controls="FullTT" role="tab" data-toggle="tab">Full TT</a></li>
                    <li role="presentation"><a href="#SPL" aria-controls="SPL" role="tab" data-toggle="tab">SPL/ Rate Cutter</a></li>
                    <li role="presentation"><a href="#3G" aria-controls="3G" role="tab" data-toggle="tab">3G/4G</a></li> -->
                  </ul>
                  </div>
                  <!-- Tab panes -->
                  <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="Recommende">
                    	<!-- <a href="#" onclick="get_amount(22)"><div class="plan_list">
                        	<div class="plan_rate">
                          		₦<span id="select_amount">22</span>
                            </div>
                            <div class="plan_details">
                            	<p><span class="operator_name"></span> GSM 100 MB|Post Free Usage with Validity left: 10p/10KB|Activation: USSD *141*322#</p>
								<p class="pull-left">Validity | 2 days</p> <p class="pull-right"> Talktime | 0</p>
								
                            </div>
                            <div class="clearfix"></div>
                        </div></a>
                        
                        <div class="clearfix"></div>
                        <a href="#" onclick="get_amount(35)"><div class="plan_list">
                        	<div class="plan_rate">
                          		₦<span id="select_amount">35</span>
                            </div>
                            <div class="plan_details">
                            	<p><span class="operator_name"></span> GSM ₦40 |Min 20 free for 11 to 7 Night|Activation: USSD *141*354#</p>
								<p class="pull-left">Validity | 5 days</p> <p class="pull-right"> Talktime | ₦10</p>
								
                            </div>
                            <div class="clearfix"></div>
                        </div></a>
                        
                        <div class="clearfix"></div>
                            <a href="#" onclick="get_amount(50)"><div class="plan_list">
                        	<div class="plan_rate">
                          		₦<span id="select_amount">50</span>
                            </div>
                            <div class="plan_details">
                            	<p><span class="operator_name"></span> GSM 250 MB|Post Free Usage with Validity left: 10p/10KB|Activation: USSD *141*722#</p>
								<p class="pull-left">Validity | 7 days</p> <p class="pull-right"> Talktime | ₦7</p>
								
                            </div>
                            <div class="clearfix"></div>
                        </div></a> -->
                        
                        <div class="clearfix"></div>
                    </div>
                    
                    <div role="tabpanel" class="tab-pane" id="FullTT">
                    	<a href="#" onclick="get_amount(55)"><div class="plan_list">
                        	<div class="plan_rate">
                          		₦<span id="select_amount">55</span>
                            </div>
                            <div class="plan_details">
                            	<p><span class="operator_name"></span> GSM ₦55|Activation: USSD *141*322#</p>
								<p class="pull-left">Validity | 0 days</p> <p class="pull-right"> Talktime | 55</p>
                            </div>
                            <div class="clearfix"></div>
                     </div></a>
                        <div class="clearfix"></div>
                    </div>
	           	</div>
      	</div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->