w<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Xenon Boostrap Admin Panel" />
    <meta name="author" content="" />

    <title>OyaCharge</title>
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arimo:400,700,400italic">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/fonts/linecons/css/linecons.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/xenon-core.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/xenon-forms.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/xenon-components.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-reset.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/biller_custom.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
   <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/images/favicon.ico">

    <script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.min.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

<style>
body, a, p, span {
    font-family: Arimo, "Helvetica Neue", Helvetica, Arial, sans-serif;
}
.sidebar-menu {
    display: table-cell;
    position: relative;
    width: 240px;
    /*background: url(<?php echo base_url(); ?>assets/images/dash-bg-img.jpg);*/
	background:#323641;
    z-index: 1;
    transition: all 0.3s ease-in-out 0s;
    background-attachment: fixed;
    background-repeat: no-repeat;
    height: 100%;
}
.sidebar-menu .main-menu {
    padding-left: 0px;
    padding-right: 0px;
    margin-top:60px;
    margin-bottom: 20px;
    list-style: none;
    background:none;
}
footer.main-footer {
    padding: 8px 30px;
    border-top: 1px solid #ddd;
    font-size: 12px;
    margin-left: -30px;
    margin-right: -30px;
    margin-top: 10px;
    background-color: #62584e;
    color: #fff;
}
footer.main-footer .go-up {
    float: right;
    margin-bottom: 0px;
}
footer.main-footer .go-up a {
    display: inline-block;
    background-color: rgba(255, 255, 255, 0.1);
    padding: 2px 5px;
    color: #fff;
}



</style>



</head>

<body class="page-body">

    <div class="page-container">
        <!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->

        <!-- Add "fixed" class to make the sidebar fixed always to the browser viewport. -->
        <!-- Adding class "toggle-others" will keep only one menu item open at a time. -->
        <!-- Adding class "collapsed" collapse sidebar root elements and show only icons. -->
        <div class="sidebar-menu toggle-others fixed">
            <div class="sidebar-menu-inner">
                
                <?php $segment = $this->uri->segment(2); ?>
                    <ul id="main-menu" class="main-menu">
                        <li <?php if(($this->uri->segment(1) == 'biller') && ($this->uri->segment(2) == '' || $this->uri->segment(2) == 'index')){ ?>class="active"
                            <?php } ?>>
                                <a href="<?php echo base_url('index.php/biller') ?>">
                                    <i class="fa fa fa-tachometer"></i>
                                    <span class="title">Dashboard</span>
                                </a>
                        </li>
                        <li <?php if(($this->uri->segment(1) == 'biller') && ($this->uri->segment(2) == '' || $this->uri->segment(2) == 'index')){ ?>class="active"
                            <?php } ?>>
                                <a href="<?php echo base_url('index.php/biller/biller_profile') ?>">
                                    <i class="fa fa-user-circle-o"></i>
                                    <span class="title">Profile</span>
                                </a>
                        </li>
                        <?php

                        if($biller_details[0]->category=='1'){?>
                            <li <?php if($this->uri->segment(1) == 'Invoice' || $this->uri->segment(2) == 'add_consumer_list'|| $this->uri->segment(2) == 'edit_consumer_list'){ ?>class="opened active"
                                <?php } ?>>
                                    <a href="<?php echo base_url('Invoice'); ?>">
                                        <i class="fa fa-file-text-o"></i>
                                        <span class="title">Invoice </span>
                                    </a>
                                    <ul>
                                        <li <?php if($this->uri->segment(2) == 'Invoice'){ ?>class="active"
                                            <?php } ?>>
                                                <a href="<?php echo site_url('Invoice'); ?>">
                                                    <span class="title">Invoice List</span>
                                                </a>
                                        </li>
                                    </ul>

                                    <ul>
                                        <li <?php if($this->uri->segment(2) == 'upload_consumer_list'){ ?>class="active"
                                            <?php } ?>>
                                                <a href="<?php echo site_url('biller/upload_consumer_list'); ?>">
                                                    <span class="title">Upload Invoice Excel</span>
                                                </a>
                                        </li>
                                    </ul>
                            </li>
                             <li <?php if($this->uri->segment(1) == 'Consumer'){ ?>class="opened active"
                                <?php } ?>>
                                    <a href="<?php echo site_url('Consumer'); ?>">
                                        <i class="fa fa-user"></i>
                                        <span class="title">Consumers </span>
                                    </a>
                                   
                            </li>
                            <li <?php if($this->uri->segment(2) == 'my_bill_sattlement' || $this->uri->segment(2) == 'my_bill_sattlement'){ ?>class="opened active"
                                <?php } ?>>
                                    <a href="<?php echo site_url('biller/my_bill_sattlement'); ?>">
                                        <i class="fa fa-exchange"></i>
                                        <span class="title">settlement </span>
                                    </a>
                                    <ul>

                                        <li <?php if($this->uri->segment(2) == 'my_bill_sattlement'){ ?>class="active"
                                            <?php } ?>>
                                                <a href="<?php echo site_url('biller/my_bill_sattlement'); ?>">
                                                    <span class="title">My settlement</span>
                                                </a>
                                        </li>
                                    </ul>
                            </li>
                            <li <?php if($this->uri->segment(2) == 'product_list' || $this->uri->segment(2) == 'add_product'|| $this->uri->segment(2) == 'edit_product'|| $this->uri->segment(2) == 'upload_product_list'){ ?>class="opened active"
                                <?php } ?>>
                                    <a href="<?php echo site_url('biller/product_list'); ?>">
                                        <i class="fa fa-cubes"></i>
                                        <span class="title">Products </span>
                                    </a>
                                    <ul>
                                        <li <?php if($this->uri->segment(2) == 'product_list'){ ?>class="active"
                                            <?php } ?>>
                                                <a href="<?php echo site_url('biller/product_list'); ?>">
                                                    <span class="title">Products List</span>
                                                </a>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li <?php if($this->uri->segment(2) == 'upload_product_list'){ ?>class="active"
                                            <?php } ?>>
                                                <a href="<?php echo site_url('biller/upload_product_list'); ?>">
                                                    <span class="title">Upload Product Excel</span>
                                                </a>
                                        </li>
                                    </ul>
                            </li>

                            <?php }else if($biller_details[0]->category=='2'){ ?>
                                <li <?php if($this->uri->segment(2) == 'church_product_list' || $this->uri->segment(2) == 'church_add_product'|| $this->uri->segment(2) == 'church_edit_product'){ ?>class="opened active"
                                    <?php } ?>>
                                        <a href="<?php echo site_url('biller/church_product_list'); ?>">
                                            <i class="fa fa-user"></i>
                                            <span class="title">Products </span>
                                        </a>
                                        <ul>
                                            <li <?php if($this->uri->segment(2) == 'church_product_list'){ ?>class="active"
                                                <?php } ?>>
                                                    <a href="<?php echo site_url('biller/church_product_list'); ?>">
                                                        <span class="title">Products List</span>
                                                    </a>
                                            </li>
                                        </ul>

                                </li>
                                <li <?php if($this->uri->segment(1) == 'Branches' || $this->uri->segment(1) == 'Add-Branch'|| $this->uri->segment(2) == 'edit_church'){ ?>class="opened active"
                                    <?php } ?>>
                                        <a href="<?php echo site_url('Branches'); ?>">
                                            <i class="fa fa-user"></i>
                                            <span class="title">Branches </span>
                                        </a>
                                        <ul>
                                            <li <?php if($this->uri->segment(1) == 'Branches'){ ?>class="active"
                                                <?php } ?>>
                                                    <a href="<?php echo site_url('Branches'); ?>">
                                                        <span class="title">Branch List</span>
                                                    </a>
                                            </li>
                                        </ul>

                                </li>
                                <li <?php if($this->uri->segment(2) == 'donation_list'){ ?>class="opened active"
                                    <?php } ?>>
                                        <a href="<?php echo site_url('biller/donation_list'); ?>">
                                            <i class="fa fa-user"></i>
                                            <span class="title">Donation </span>
                                        </a>
                                        <ul>
                                            <li <?php if($this->uri->segment(2) == 'donation_list'){ ?>class="active"
                                                <?php } ?>>
                                                    <a href="<?php echo site_url('biller/donation_list'); ?>">
                                                        <span class="title">Donate User</span>
                                                    </a>
                                            </li>
                                        </ul>

                                </li>
                                <?php } if($biller_details[0]->category=='3'){?>

                                    <li <?php if($this->uri->segment(1) == 'Event_List' || $this->uri->segment(1) == 'add_event'|| $this->uri->segment(1) == 'edit_event'|| $this->uri->segment(1) == 'add_event_ticket'|| $this->uri->segment(1) == 'edit_event_ticket'|| $this->uri->segment(1) == 'event_tickets'|| $this->uri->segment(1) == 'Event-Transactions'){ ?>class="opened active"
                                        <?php } ?>>
                                            <a href="<?php echo site_url('Event_List'); ?>">
                                                <i class="fa fa-user"></i>
                                                <span class="title">Events </span>
                                            </a>
                                            <ul>
                                                <li <?php if($this->uri->segment(2) == 'event_tickets' || $this->uri->segment(2) == 'add_event_ticket'|| $this->uri->segment(2) == 'edit_event_ticket'){ ?>class="active"
                                                    <?php } ?>>
                                                        <a href="<?php echo site_url('biller/event_tickets'); ?>">
                                                            <span class="title">Event Tickets</span>
                                                        </a>
                                                </li>
                                            </ul>
                                            <ul>
                                                <li <?php if($this->uri->segment(2) == 'Event_List'){ ?>class="active"
                                                    <?php } ?>>
                                                        <a href="<?php echo site_url('Event_List'); ?>">
                                                            <span class="title">Event List</span>
                                                        </a>
                                                </li>
                                            </ul>
                                            <ul>
                                                <li <?php if($this->uri->segment(2) == 'Event-Transactions'){ ?>class="active"
                                                    <?php } ?>>
                                                        <a href="<?php echo site_url('Event-Transactions'); ?>">
                                                            <span class="title">Event Transactions</span>
                                                        </a>
                                                </li>
                                            </ul>

                                    </li>
                                    <li <?php if($this->uri->segment(2) == 'my_bill_sattlement' || $this->uri->segment(2) == 'my_bill_sattlement'){ ?>class="opened active"
                                        <?php } ?>>
                                            <a href="<?php echo site_url('biller/my_bill_sattlement'); ?>">
                                                <i class="fa fa-user"></i>
                                                <span class="title">Sattlement </span>
                                            </a>
                                            <ul>

                                                <li <?php if($this->uri->segment(2) == 'my_bill_sattlement'){ ?>class="active"
                                                    <?php } ?>>
                                                        <a href="<?php echo site_url('biller/my_bill_sattlement'); ?>">
                                                            <span class="title">My Sattlement</span>
                                                        </a>
                                                </li>
                                            </ul>
                                    </li>
                                    </li>
                                    <?php } ?>
                    </ul>
            </div>
        </div>


                <header class="header fixed-top clearfix">

                    <!-- logo -->
                    <div class="brand">
                        <a href="<?php echo site_url('biller'); ?>" class="logo">
                            <img src="<?php echo base_url(); ?>assets/images/logo_1.png" width="150px" alt="" />
                        </a>

                        <a href="<?php echo site_url(); ?>" class="logo-collapsed">
                            <img src="<?php echo base_url(); ?>assets/images/logo-collapsed@2x.png" width="40" alt="" />
                        </a>
                        <div class="sidebar-toggle-box">
					       <a data-toggle="sidebar" href="#"> <i class="fa-bars"></i> </a>
					    </div>
                    </div>

<nav class="top-nav clearfix"  role="navigation"><!-- User Info, Notifications and Menu Bar --> 
        <ul class="nav pull-right top-menu">
            <li class="dropdown user-profile">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        
                    <img src="<?php echo base_url(); ?>assets/images/user-4.png" alt="user-image" class="img-circle img-inline userpic-32" width="28" />
                    <span class="username"><?php echo $this->session->userdata('biller_email');?></span>
                    <span>
                        <i class="fa-angle-down"></i>
                    </span>
                </a>
                <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.1.2/css/buttons.dataTables.min.css">

                <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
                <script src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
                <script src="https://cdn.datatables.net/buttons/1.1.2/js/dataTables.buttons.min.js"></script>
                <script src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.flash.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
                <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
                <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
                <script src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.html5.min.js"></script>
                <script src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.print.min.js"></script>
                <script src="<?php echo base_url('assets/js/calender/jquery-ui.js');?>" type="text/javascript"></script>
                <script src="<?php echo base_url('assets/js/calender/jquery-1.9.1.js');?>" type="text/javascript"></script>
                <ul class="dropdown-menu user-profile-menu list-unstyled">
                    <!--<li>
                        <a href="#">
                            <i class="fa-wrench"></i>
                            Settings
                        </a>
                    </li>
                    <li>
                        <a href="<?php //echo site_url('admin/change_email'); ?>">
                            <i class="fa-user"></i>
                            Change Email
                        </a>
                    </li>-->
                    <li>
                        <a href="<?php echo site_url('biller/change_password'); ?>">
                            <i class="fa-user"></i>
                            Change Password
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('biller/logout');?>">
                            <i class="fa-sign-out"></i>
                            Logout
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>




                    <!-- This will toggle the mobile menu and will be visible only on mobile devices -->
                    <div class="mobile-menu-toggle visible-xs">
                        <a href="#" data-toggle="user-info-menu">
                            <i class="fa-arrow-circle-o-down"></i>
                        </a>

                        <a href="#" data-toggle="mobile-menu">
                            <i class="fa-bars"></i>
                        </a>
                    </div>

                </header>












