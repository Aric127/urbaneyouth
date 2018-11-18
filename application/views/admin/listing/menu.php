<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Xenon Boostrap Admin Panel" />
	<meta name="author" content="" />

	<title>OyaCharge</title>

	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Arimo:400,700,400italic">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/fonts/linecons/css/linecons.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/fonts/fontawesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/xenon-core.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/xenon-forms.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/xenon-components.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/xenon-skins.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css">
	<link rel="shortcut icon" type="image/png" href="<?php echo base_url(); ?>assets/images/favicon.png"/>
	<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.min.js"></script>

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->


</head>
<body class="page-body">
	
	<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
			
		<!-- Add "fixed" class to make the sidebar fixed always to the browser viewport. -->
		<!-- Adding class "toggle-others" will keep only one menu item open at a time. -->
		<!-- Adding class "collapsed" collapse sidebar root elements and show only icons. -->
		<div class="sidebar-menu toggle-others fixed">
		
			<div class="sidebar-menu-inner">
				
				<header class="logo-env">
		
					<!-- logo -->
					<div class="logo">
                                            <a href="<?php echo site_url('admin'); ?>" class="logo-expanded">
							<img src="<?php echo base_url(); ?>assets/images/logo_1.png" width="150" alt="" />
						</a>
		
						<a href="<?php echo site_url('admin'); ?>" class="logo-collapsed">
							<img src="<?php echo base_url(); ?>assets/images/logo-collapsed@2x.png" width="40" alt="" />
						</a>
					</div>
		
					<!-- This will toggle the mobile menu and will be visible only on mobile devices -->
					<div class="mobile-menu-toggle visible-xs">
						<a href="#" data-toggle="user-info-menu">
							<i class="fa-arrow-circle-o-down"></i>
						</a>
		
						<a href="#" data-toggle="mobile-menu">
							<i class="fa-bars"></i>
						</a>
					</div>
		
					<!-- This will open the popup with user profile settings, you can use for any purpose, just be creative 
					<div class="settings-icon">
						<a href="#" data-toggle="settings-pane" data-animate="true">
							<i class="linecons-cog"></i>
						</a>
					</div>
					-->
					
				</header>
   <?php $segment = $this->uri->segment(2); ?>
    <ul id="main-menu" class="main-menu">
    <li <?php if(($this->uri->segment(1) == 'admin') && ($this->uri->segment(2) == '' || $this->uri->segment(2) == 'index')){ ?>class="active"<?php } ?>>
        <a href="<?php echo base_url('index.php/admin') ?>">
            <i class="linecons-cog"></i>
            <span class="title">Dashboard</span>
        </a>
    </li>
   <li <?php if($this->uri->segment(2) == 'user_list' || $this->uri->segment(2) == 'user_list'|| $this->uri->segment(2) == 'view_transaction'|| $this->uri->segment(2) == 'user_perticuler_transaction'){ ?>class="opened active"<?php } ?>>
        <a href="<?php echo site_url('admin/user_list'); ?>">
            <i class="fa fa-user"></i>
            <span class="title">User </span>
        </a>
        <ul>
            <li <?php if($this->uri->segment(2) == 'user_list'){ ?>class="active"<?php } ?>>
                <a href="<?php echo site_url('admin/user_list'); ?>">
                    <span class="title">User List</span>
                </a>
            </li>
            
        </ul>
    </li>
     <li <?php if($this->uri->segment(2) == 'biller_category' || $this->uri->segment(2) == 'add_biller_category'|| $this->uri->segment(2) == 'edit_biller_category'){ ?>class="opened active"<?php } ?>>
        <a href="<?php echo site_url('admin/biller_category'); ?>">
            <i class="fa fa-user"></i>
            <span class="title">Billers Category </span>
        </a>
        <ul>
            <li <?php if($this->uri->segment(2) == 'biller_category'){ ?>class="active"<?php } ?>>
                <a href="<?php echo site_url('admin/biller_category'); ?>">
                    <span class="title">Biller Category</span>
                </a>
            </li>
            
        </ul>
    </li>
       <li <?php if($this->uri->segment(2) == 'biller_list' ||$this->uri->segment(2) == 'view_biller_details' || $this->uri->segment(2) == 'add_biller'|| $this->uri->segment(2) == 'edit_biller' ||$this->uri->segment(2) == 'bill_status'){ ?>class="opened active"<?php } ?>>
        <a href="<?php echo site_url('admin/biller_list'); ?>">
            <i class="fa fa-user"></i>
            <span class="title">Billers </span>
        </a>
        <ul>
            <li <?php if($this->uri->segment(2) == 'biller_list'){ ?>class="active"<?php } ?>>
                <a href="<?php echo site_url('admin/biller_list'); ?>">
                    <span class="title">Biller List</span>
                </a>
            </li>
         </ul>
          <ul>
            <li <?php if($this->uri->segment(2) == 'bill_status'){ ?>class="active"<?php } ?>>
                <a href="<?php echo site_url('admin/bill_status'); ?>">
                    <span class="title">Bill Status</span>
                </a>
            </li>
         </ul>
    </li>
    <li <?php if($this->uri->segment(2) == 'donation_list' || $this->uri->segment(2) == 'church_list'){ ?>class="opened active"<?php } ?>>
        <a href="<?php echo site_url('admin/donation_list'); ?>">
            <i class="fa fa-user"></i>
            <span class="title">Church </span>
        </a>
         <ul>
            <li <?php if($this->uri->segment(2) == 'church_list'){ ?>class="active"<?php } ?>>
                <a href="<?php echo site_url('admin/church_list'); ?>">
                    <span class="title">Church List</span>
                </a>
            </li>
       </ul>
        <ul>
            <li <?php if($this->uri->segment(2) == 'donation_list'){ ?>class="active"<?php } ?>>
                <a href="<?php echo site_url('admin/donation_list'); ?>">
                    <span class="title">Donate User</span>
                </a>
            </li>
       </ul>
     
    </li>
        <li <?php if($this->uri->segment(2) == 'event_viewer' ||$this->uri->segment(2) == 'event_viewer_details' || $this->uri->segment(2) == 'add_eventer'|| $this->uri->segment(2) == 'edit_eventer' ||$this->uri->segment(2) == 'bill_status'){ ?>class="opened active"<?php } ?>>
        <a href="<?php echo site_url('admin/event_viewer'); ?>">
            <i class="fa fa-user"></i>
            <span class="title">Events </span>
        </a>
        <ul>
            <li <?php if($this->uri->segment(2) == 'event_viewer'){ ?>class="active"<?php } ?>>
                <a href="<?php echo site_url('admin/event_viewer'); ?>">
                    <span class="title">Event Viewer</span>
                </a>
            </li>
         </ul>
         
    </li>
       <li <?php if($this->uri->segment(2) == 'recharge_category_list' || $this->uri->segment(2) == 'add_recharge_category' || $this->uri->segment(2) == 'edit_recharge_category' ||$this->uri->segment(2) == 'recharge_type_list' || $this->uri->segment(2) == 'add_recharge_type' || $this->uri->segment(2) == 'edit_recharge_type'||$this->uri->segment(2) == 'operator_list' || $this->uri->segment(2) == 'add_operator' || $this->uri->segment(2) == 'edit_operator'){ ?>class="opened active"<?php } ?>>
        <a href="<?php echo site_url('admin/recharge_category_list'); ?>">
            <i class="fa fa-list-ol"></i>
            <span class="title">Operators </span>
        </a>
        <ul>
            <li <?php if($this->uri->segment(2) == 'recharge_category_list' || $this->uri->segment(2) == 'add_recharge_category' || $this->uri->segment(2) == 'edit_recharge_category'){ ?>class="active"<?php } ?>>
                <a href="<?php echo site_url('admin/recharge_category_list'); ?>">
                    <span class="title">Recharge Category List</span>
                </a>
            </li>
            
        </ul>
     <!--    <ul>
            <li <?php if($this->uri->segment(2) == 'recharge_type_list' || $this->uri->segment(2) == 'add_recharge_type' || $this->uri->segment(2) == 'edit_recharge_type'){ ?>class="active"<?php } ?>>
                <a href="<?php echo site_url('admin/recharge_type_list'); ?>">
                    <span class="title">Recharge Type List</span>
                </a>
            </li>
            
        </ul>-->
         <ul>
            <li <?php if($this->uri->segment(2) == 'operator_list' || $this->uri->segment(2) == 'add_operator' || $this->uri->segment(2) == 'edit_operator'){ ?>class="active"<?php } ?>>
                <a href="<?php echo site_url('admin/operator_list'); ?>">
                    <span class="title">Operator List</span>
                </a>
            </li>
            
        </ul>
    </li>
        <li <?php if($this->uri->segment(2) == 'plan_list' || $this->uri->segment(2) == 'add_recharge_plan'|| $this->uri->segment(2) == 'edit_recharge_plan' || $this->uri->segment(2) == 'plan_category' || $this->uri->segment(2) == 'add_plan_category'|| $this->uri->segment(2) == 'edit_plan_category'){ ?>class="opened active"<?php } ?>>
        <a href="<?php echo site_url('admin/plan_list'); ?>">
            <i class="fa fa-user"></i>
            <span class="title">Recharge Plan </span>
        </a>
           <ul>
            <li <?php if($this->uri->segment(2) == 'plan_category' || $this->uri->segment(2) == 'add_plan_category'|| $this->uri->segment(2) == 'edit_plan_category'){ ?>class="active"<?php } ?>>
                <a href="<?php echo site_url('admin/plan_category'); ?>">
                    <span class="title">Plan Category</span>
                </a>
            </li>
            
        </ul>
        <ul>
            <li <?php if($this->uri->segment(2) == 'plan_list' || $this->uri->segment(2) == 'add_recharge_plan'|| $this->uri->segment(2) == 'edit_recharge_plan'){ ?>class="active"<?php } ?>>
                <a href="<?php echo site_url('admin/plan_list'); ?>">
                    <span class="title">Plan List</span>
                </a>
            </li>
            
        </ul>
    </li>
 <li <?php if($this->uri->segment(2) == 'coupon_list' || $this->uri->segment(2) == 'add_coupon'|| $this->uri->segment(2) == 'edit_coupon'|| $this->uri->segment(2) == 'free_coupon_list' || $this->uri->segment(2) == 'add_free_coupon'){ ?>class="opened active"<?php } ?>>
        <a href="<?php echo site_url('admin/coupon_list'); ?>">
            <i class="fa fa-user"></i>
            <span class="title">Offer Coupons </span>
        </a>
        <ul>
            <li <?php if($this->uri->segment(2) == 'coupon_list'){ ?>class="active"<?php } ?>>
                <a href="<?php echo site_url('admin/coupon_list'); ?>">
                    <span class="title">Coupons List</span>
                </a>
            </li>
            
        </ul>
           <ul>
            <li <?php if($this->uri->segment(2) == 'free_coupon_category' || $this->uri->segment(2) == 'add_free_coupon_category'|| $this->uri->segment(2) == 'edit_free_coupon_category'){ ?>class="active"<?php } ?>>
                <a href="<?php echo site_url('admin/free_coupon_category'); ?>">
                    <span class="title">Free Coupons Category</span>
                </a>
            </li>
            
        </ul>
          <ul>
            <li <?php if($this->uri->segment(2) == 'free_coupon_list' || $this->uri->segment(2) == 'add_free_coupon'){ ?>class="active"<?php } ?>>
                <a href="<?php echo site_url('admin/free_coupon_list'); ?>">
                    <span class="title">Free Coupons List</span>
                </a>
            </li>
            
        </ul>
    </li>
    <li <?php if($this->uri->segment(2) == 'scratch_card' || $this->uri->segment(2) == 'add_scratch_card' | $this->uri->segment(2) == 'edit_scratch_card' ){ ?>class="opened active"<?php } ?>>
        <a href="<?php echo site_url('admin/scratch_card'); ?>">
            <i class="fa fa-user"></i>
            <span class="title">Scratch Card </span>
        </a>
        <ul>
            <li <?php if($this->uri->segment(2) == 'scratch_card'){ ?>class="active"<?php } ?>>
                <a href="<?php echo site_url('admin/scratch_card'); ?>">
                    <span class="title">Scratch Card</span>
                </a>
            </li>
        </ul>
          
    </li>
 <li <?php if($this->uri->segment(2) == 'transaction_list' || $this->uri->segment(2) == 'view_perticuler_transaction' ){ ?>class="opened active"<?php } ?>>
        <a href="<?php echo site_url('admin/transaction_list'); ?>">
            <i class="fa fa-user"></i>
            <span class="title">Transactions </span>
        </a>
        <ul>
            <li <?php if($this->uri->segment(2) == 'transaction_list'){ ?>class="active"<?php } ?>>
                <a href="<?php echo site_url('admin/transaction_list'); ?>">
                    <span class="title">Transactions List</span>
                </a>
            </li>
        </ul>
          
    </li>
 <li <?php if($this->uri->segment(2) == 'Track'  ){ ?>class="opened active"<?php } ?>>
        <a href="<?php echo site_url('admin/Track'); ?>">
            <i class="fa fa-user"></i>
            <span class="title">Track Record </span>
        </a>
       
          <ul>
            <li <?php if($this->uri->segment(2) == 'Track'){ ?>class="active"<?php } ?>>
                <a href="<?php echo site_url('admin/Track'); ?>">
                    <span class="title">Track Transactions</span>
                </a>
            </li>
        </ul>
    </li>
       <li <?php if($this->uri->segment(2) == 'about_us' || $this->uri->segment(2) == 'add_about_content'){ ?>class="opened active"<?php } ?>>
        <a href="<?php echo site_url('admin/about_us'); ?>">
            <i class="fa fa-info-circle"></i>
            <span class="title">About us </span>
        </a>
        <ul>
            <li <?php if($this->uri->segment(2) == 'about_us' ||$this->uri->segment(2) == 'terms_conditions' || $this->uri->segment(2) == 'edit_terms_conditions'||$this->uri->segment(2) == 'shipping_delivery' || $this->uri->segment(2) == 'edit_shipping_delivery_content'||$this->uri->segment(2) == 'privecy_policy' || $this->uri->segment(2) == 'edit_privecy_policy_content'){ ?>class="active"<?php } ?>>
                <a href="<?php echo site_url('admin/about_us'); ?>">
                    <span class="title">About us content</span>
                </a>
            </li>
          	<li <?php if($this->uri->segment(2) == 'privecy_policy' || $this->uri->segment(2) == 'edit_privecy_policy_content'){ ?>class="active"<?php } ?>>
                <a href="<?php echo site_url('admin/privecy_policy'); ?>">
                    <span class="title">Privecy & Policy</span>
                </a>
            </li>
            <li <?php if($this->uri->segment(2) == 'terms_conditions' || $this->uri->segment(2) == 'edit_terms_conditions'){ ?>class="active"<?php } ?>>
                <a href="<?php echo site_url('admin/terms_conditions'); ?>">
                    <span class="title">Terms & Conditions</span>
                </a>
            </li>
        </ul>
    </li>
   
     <li <?php if($this->uri->segment(2) == 'contact_us' || $this->uri->segment(2) == 'edit_contact_us'){ ?>class="opened active"<?php } ?>>
        <a href="<?php echo site_url('admin/contact_us'); ?>">
            <i class="fa fa-cart-arrow-down"></i>
            <span class="title">Contact Us </span>
        </a>
        <ul>
            <li <?php if($this->uri->segment(2) == 'contact_us' || $this->uri->segment(2) == 'edit_contact_us'){ ?>class="active"<?php } ?>>
                <a href="<?php echo site_url('admin/contact_us'); ?>">
                    <span class="title">Contact Us</span>
                </a>
            </li>
            
        </ul>
    </li>
     <li <?php if($this->uri->segment(2) == 'main_content' || $this->uri->segment(2) == 'main_content'){ ?>class="opened active"<?php } ?>>
     	
        <a href="<?php echo site_url('admin/main_content'); ?>">
            <i class="fa fa-cart-arrow-down"></i>
            <span class="title">Content </span>
        </a>
        <ul>
            <li <?php if($this->uri->segment(2) == 'main_content' || $this->uri->segment(2) == 'edit_main_content'){ ?>class="active"<?php } ?>>
                <a href="<?php echo site_url('admin/main_content'); ?>">
                    <span class="title">Slider Content</span>
                </a>
            </li>
            
        </ul>
          <ul>
            <li <?php if($this->uri->segment(2) == 'recharge_content' || $this->uri->segment(2) == 'edit_recharge_content'){ ?>class="active"<?php } ?>>
                <a href="<?php echo site_url('admin/recharge_content'); ?>">
                    <span class="title">Recharge Content</span>
                </a>
            </li>
            
        </ul>
           <!-- <ul>
            <li <?php if($this->uri->segment(2) == 'recharge_video_upload' || $this->uri->segment(2) == 'edit_video_upload'){ ?>class="active"<?php } ?>>
                <a href="<?php echo site_url('admin/recharge_video_upload'); ?>">
                    <span class="title">Recharge Video</span>
                </a>
            </li>
            
        </ul> -->
    </li>
     <li <?php if($this->uri->segment(2) == 'feedback'){ ?>class="opened active"<?php } ?>>
        <a href="<?php echo site_url('admin/contact_us'); ?>">
            <i class="fa fa-cart-arrow-down"></i>
            <span class="title">Feedback </span>
        </a>
        <ul>
            <li <?php if($this->uri->segment(2) == 'feedback' ){ ?>class="active"<?php } ?>>
                <a href="<?php echo site_url('admin/feedback'); ?>">
                    <span class="title">Feedback User</span>
                </a>
            </li>
            
        </ul>
    </li>
</ul>
</div>
</div>
	
