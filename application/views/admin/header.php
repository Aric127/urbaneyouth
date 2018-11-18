<header class="header fixed-top clearfix">
<div class="brand">

    <a class="logo" href="<?php echo base_url('admin'); ?>">
        <img width="150" alt="" src="<?php echo base_url('assets/images/logo_1.png');?>">
    </a>
    <div class="sidebar-toggle-box">
       <a data-toggle="sidebar" href="#"> <i class="fa-bars"></i> </a>
    </div>
</div> 

<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <li>
            <input type="text" placeholder=" Search" class="form-control search">
        </li>
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <img src="<?php echo base_url(); ?>assets/images/avatar1_small.jpg" alt="user-image" class="img-circle img-inline userpic-32" width="28" />
                <span class="username"><?php echo $this->session->userdata('user_email');?></span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended userprofile logout">
                 <li>
                        <a href="<?php //echo site_url('admin/change_email'); ?>">
                            <i class=" fa fa-suitcase"></i>
                            Change Email
                        </a>
                    </li>
                    <li>
                        <a href="<?php //echo site_url('admin/change_password'); ?>">
                            <i class="fa fa-key"></i>
                            Change Password
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('admin/logout');?>">
                            <i class="fa-sign-out"></i>
                            Logout
                        </a>
                    </li>
                
            </ul>
        </li>
        <!-- user login dropdown end -->
		<!---
        <li>
            <div class="toggle-right-box">
                <div class="fa fa-bars"></div>
            </div>
        </li>-->
    </ul>
    <!--search & user info end-->
</div>
</header>

     

<div class="main-content">
 <!--<nav class="navbar user-info-navbar"  role="navigation">	
        <ul class="user-info-menu right-links list-inline list-unstyled">
            <li class="dropdown user-profile">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo base_url(); ?>assets/images/user-4.png" alt="user-image" class="img-circle img-inline userpic-32" width="28" />
                   <?php echo $this->session->userdata('user_email');?>

                    
                    <span>
                        <i class="fa-angle-down"></i>
                    </span>
                </a>
         
                <ul class="dropdown-menu user-profile-menu list-unstyled">
                   
                    <li>
                        <a href="<?php //echo site_url('admin/change_email'); ?>">
                            <i class="fa-user"></i>
                            Change Email
                        </a>
                    </li>
                    <li>
                        <a href="<?php //echo site_url('admin/change_password'); ?>">
                            <i class="fa-user"></i>
                            Change Password
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('admin/logout');?>">
                            <i class="fa-sign-out"></i>
                            Logout
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>-->
		