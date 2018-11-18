<script src="https://use.fontawesome.com/527280541e.js"></script>


 <div class="sidebar" data-color="rose" data-background-color="black" data-image="<?php echo base_url('biller_assets/img/sidebar-1.jpg');?>">
     <div class="logo">
        <a href="<?php echo base_url('event'); ?>" class="simple-text logo-mini">
         <img src="<?php echo base_url('biller_assets/img/logo_1.png');?>">
        </a>
      </div>
      <div class="sidebar-wrapper">
       <?php $segment = $this->uri->segment(2); ?>
        <ul class="nav">
          <li <?php if(($this->uri->segment(1) == 'event') && ($this->uri->segment(2) == '' || $this->uri->segment(2) == 'index')){ ?> class="active"
                            <?php } ?> class="nav-item ">
            <a class="nav-link" href="<?php echo base_url('event') ?>">
              <i class="material-icons">dashboard</i>
              <p> Dashboard </p>
            </a>
          </li>
          <li <?php if(($this->uri->segment(2) == 'event_profile')){ ?> class="active"
                            <?php } ?> class="nav-item ">
            <a class="nav-link" href="<?php echo base_url('event/event_profile') ?>">
              <i class="material-icons">perm_identity</i>
              <p> Profile
               
              </p>
            </a>
         </li>
         <?php if($biller_details[0]->biller_status==1){ ?>
          <li class="nav-item ">
            <a class="nav-link" href="<?php echo base_url('event/event_tickets'); ?>">
              
               <i class="material-icons">games</i>
              <p> Event Tickets</p>
            </a>
               <div <?php if($this->uri->segment(2) == 'event_tickets'){ ?> class="collapse show"
                                            <?php } ?> class="collapse" id="mapsExamples">
              <ul class="nav">
                <li <?php if($this->uri->segment(2) == 'event_tickets'){ ?> class="opened active"
                                            <?php } ?> class="nav-item ">
                  <a class="nav-link" 
                  href="<?php //echo site_url('biller/product_list'); ?>">
                   <i class="fa fa-cubes" aria-hidden="true" style="font-size: 13px;"></i>
                  <span class="sidebar-normal"> Event Tickets </span>
                  </a>
                </li>
                
                
              </ul>
            </div>
          </li>
          <li  <?php if($this->uri->segment(2) == 'event_list'){ ?> class="opened active"
                                            <?php } ?> class="nav-item ">
            <a class="nav-link" href="<?php echo site_url('event/event_list'); ?>">
              <i class="material-icons">description</i>
              <p> Events
               
              </p>
            </a>
                
         </li>
          
      
          <li<?php if($this->uri->segment(2) == 'event_transaction' || $this->uri->segment(2) == 'eventicket'){ ?> class="opened active" <?php } ?> class="nav-item " >
            <a class="nav-link" href="<?php echo site_url('event/event_transaction'); ?>">
              
             <i class="material-icons">swap_horiz</i>
              <p> Booking Transactions</p>
            </a>
            
          </li>
           <li class="nav-item" >
            <a class="nav-link" data-toggle="collapse" href="#tablesExamples">
              
             <i class="material-icons">swap_horiz</i>
              <p> Settlement <b class="caret"></b></p>

            </a>
          <div  <?php if($this->uri->segment(2) == 'sattlement'){ ?> class="collapse show"
                                            <?php } ?> class="collapse" id="tablesExamples">
              <ul class="nav">
                <li <?php if($this->uri->segment(2) == 'sattlement'){ ?> class="opened active"
                                            <?php } ?> class="nav-item ">
                  <a class="nav-link" href="<?php echo base_url('event/sattlement') ?>">
                    <span class="sidebar-normal">My settlement</span>
                  </a>
                </li>
                
                
              </ul>
            </div>
          </li>
        <li <?php if($this->uri->segment(2) == 'configuiration'){ ?> class="opened active" <?php } ?> class="nav-item ">
            <a class="nav-link" href="<?php echo site_url('event/configuiration'); ?>">
              
               <i class="material-icons">games</i>
              <p> Configuiration</p>
            </a>
        </li>
          <?php }else{ ?>
          <li<?php if($this->uri->segment(2) == 'church_product_list'){ ?> class="opened active"
                                            <?php } ?> class="nav-item ">
            <a class="nav-link" href="javascript:void(0);">
              
               <i class="material-icons">games</i>
              <p> Event Tickets </p>
            </a>
               <div class="collapse" id="mapsExamples">
              <ul class="nav">
                <li class="nav-item ">
                  <a class="nav-link" 
                  href="javascript:void(0);">
                   <i class="fa fa-cubes" aria-hidden="true" style="font-size: 13px;"></i>
                  <span class="sidebar-normal"> Event Tickets  </span>
                  </a>
                </li>
                
                
              </ul>
            </div>
          </li>
          <li class="nav-item " <?php if($this->uri->segment(2) == 'branch_list'){ ?> class="opened active"
                                            <?php } ?>>
            <a class="nav-link" href="javascript:void(0);">
              <i class="material-icons">description</i>
              <p>Event list</p>
            </a>
                <div class="collapse" id="componentsExamples">
              <ul class="nav">
                <li class="nav-item ">
                  <a class="nav-link"   href="javascript:void(0);">
                    <i class="fa fa-file-text-o" aria-hidden="true" style="font-size: 13px;"></i>

                    <span class="sidebar-normal"> Event list
                     
                    </span>
                  </a>
                 
                </li>
              </ul>
            </div>
         </li>
          
      
          <li<?php if($this->uri->segment(2) == 'donation_list'){ ?> class="opened active"
                                            <?php } ?>  class="nav-item ">
            <a class="nav-link" href="javascript:void(0);">
              
             <i class="material-icons">swap_horiz</i>
              <p>Transactions</p>
            </a>
             <div class="collapse" id="tablesExamples">
              <ul class="nav">
                <li class="nav-item ">
                  <a class="nav-link" href="javascript:void(0);">
                   <i class="fa fa-exchange" aria-hidden="true" style="font-size: 13px;"></i>

                    <span class="sidebar-normal">Event-Transactions</span>
                  </a>

                </li>
                </ul>
            </div>
          </li>
        <li <?php if($this->uri->segment(2) == 'configuiration'){ ?> class="opened active"<?php } ?> class="nav-item ">
            <a class="nav-link" href="javascript:void(0);">
              
               <i class="material-icons">games</i>
              <p> Configuiration</p>
            </a>
        </li>


       <?php   } ?>
        </ul>
      </div>
    </div>
     <div class="main-panel">
       <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top " id="navigation-example">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-minimize">
              <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
                <i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
                <i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
              </button>
            </div>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation" data-target="#navigation-example">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <form class="navbar-form">
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Search...">
                <button type="submit" class="btn btn-white btn-round btn-just-icon">
                  <i class="material-icons">search</i>
                  <div class="ripple-container"></div>
                </button>
              </div>
            </form>
            <ul class="navbar-nav">
              
              <li class="nav-item dropdown">
                <a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">notifications</i>
                  <span class="notification">5</span>
                  <p class="d-lg-none d-md-block">
                    Some Actions
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Mike John responded to your email</a>
                  <a class="dropdown-item" href="#">You have 5 new tasks</a>
                  <a class="dropdown-item" href="#">You're now friend with Andrew</a>
                  <a class="dropdown-item" href="#">Another Notification</a>
                  <a class="dropdown-item" href="#">Another One</a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" href="javascript:void(0)" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">person</i>
                  <p class="d-lg-none d-md-block">
                    Welcome <?php if(!empty($biller_details[0]->biller_name)){
                      echo $biller_details[0]->biller_name;
                    }else{
                      echo $biller_details[0]->biller_email;
                    }  ?>
                    <i class="material-icons">keyboard_arrow_down</i>
                  </p>

                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink" id="pwd">
                  <a class="dropdown-item" data-toggle="modal" data-target="#changepassword"><i class="material-icons">lock</i> Change Password</a>
                  <a class="dropdown-item" data-toggle="modal" data-target="#setmpin"> <i class="material-icons"> #</i>Set Mpin</a>
                  <a class="dropdown-item" href="<?php echo base_url('event/logout'); ?>"> <i class="material-icons">arrow_upward</i> Logout</a>
                  
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>