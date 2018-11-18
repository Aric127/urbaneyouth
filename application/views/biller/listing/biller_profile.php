<?php
if ($this->session->flashdata('status')) { ?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong><?php echo $this->session->flashdata('status'); ?></strong>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($this->session->flashdata('error')) { ?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong><?php echo $this->session->flashdata('error'); ?></strong>
            </div>
        </div>
    </div>
<?php } ?>
<div class="panel panel-default">

    <div class="panel-heading">
        <div class="panel-title">
            Biller Profie
        </div>
       
    </div>
<style type="text/css">
  
</style>


        <div class="row">
            <div class="col-md-12">
                <section class="panel">
                    <div class="panel-body profile-information">
                       <div class="col-md-3">
                           <div class="profile-pic text-center">
                               <img src="<?php if(!empty($biller_details)){
                                echo company_logo."/".$biller_details[0]->biller_company_logo;
                                } ?>" alt=""/>
                           </div>
                       </div>
                       <div class="col-md-6">
                           <div class="profile-desk">
                               <h1><?php if(!empty($biller_details)){
                                echo $biller_details[0]->biller_name;
                                } ?></h1>
                               <span class="text-muted"><?php if(!empty($biller_details)){
                                echo $biller_details[0]->biller_company_name;
                                } ?></span><br>
                               <p>
                                  <?php if(!empty($biller_details)){
                                echo $biller_details[0]->biller_address;
                                } ?>
                               </p>
                              <!--<a href="#" class="btn btn-primary">View Profile</a>-->
                           </div>
                       </div>
                       <div class="col-md-3">
                           <div class="profile-statistics">
                               <h1><?php if(!empty($BillerUserTransaction)){
                                echo $BillerUserTransaction['users'];
                                } ?></h1>
                               <p>Total Users</p>
                               <h1>₦<?php if(!empty($BillerUserTransaction)){
                                echo $BillerUserTransaction['transactions'];
                                } ?></h1>
                               <p>Total Transactions</p>
                               <ul>
                                   <li>
                                       <a href="#">
                                           <i class="fa fa-facebook"></i>
                                       </a>
                                   </li>
                                   <li class="active">
                                       <a href="#">
                                           <i class="fa fa-twitter"></i>
                                       </a>
                                   </li>
                                   <li>
                                       <a href="#">
                                           <i class="fa fa-google-plus"></i>
                                       </a>
                                   </li>
                               </ul>
                           </div>
                       </div>
                    </div>
                </section>
            </div>
            <div class="col-md-12">
                <section class="panel">
                    <header class="tab-bg-dark-navy-blue">
                        <ul class="nav nav-tabs nav-justified ">
                            <li class="active">
                                <a data-toggle="tab" href="#overview">
                                    Overview
                                </a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#contacts" class="contact-map">
                                    Contacts
                                </a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#settings">
                                    Settings
                                </a>
                            </li>
                        </ul>
                    </header>
                    <div class="panel-body">
                        <div class="tab-content tasi-tab">
                            <div id="overview" class="tab-pane active">
                                <div class="row">
                                   
                                    <div class="col-md-8">
                                       <div class="timeline-messages">
                                       <h3>Information</h3>
                                        <div class="msg-time-chat">
                                                <div class="message-body msg-in">
                                                    <span class="arrow"></span>
                                                    <div class="text">
                                                        <div class="first">
                                                            Biller Address
                                                        </div>
                                                        <div class="second bg-terques ">
                                                            <?php if(!empty($biller_details)){
                                                                echo $biller_details[0]->biller_address;
                                                            } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="msg-time-chat">
                                                <div class="message-body msg-in">
                                                    <span class="arrow"></span>
                                                    <div class="text">
                                                        <div class="first">
                                                            Biller Email
                                                        </div>
                                                        <div class="second bg-terques ">
                                                           <?php if(!empty($biller_details)){
                                                                echo $biller_details[0]->biller_email;
                                                            } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="msg-time-chat">
                                                <div class="message-body msg-in">
                                                    <span class="arrow"></span>
                                                    <div class="text">
                                                        <div class="first">
                                                           Business Email
                                                        </div>
                                                        <div class="second bg-terques ">
                                                            <?php if(!empty($biller_details)){
                                                                echo $biller_details[0]->biller_contact_no;
                                                            } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="msg-time-chat">
                                                <div class="message-body msg-in">
                                                    <span class="arrow"></span>
                                                    <div class="text">
                                                        <div class="first">
                                                            Biller Category 
                                                        </div>
                                                        <div class="second bg-terques ">
                                                             <?php if(!empty($biller_details)){
                                                                echo $biller_details[0]->biller_category_name;
                                                            } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="msg-time-chat">
                                                <div class="message-body msg-in">
                                                    <span class="arrow"></span>
                                                    <div class="text">
                                                        <div class="first">
                                                            Registraion No 
                                                        </div>
                                                        <div class="second bg-terques ">
                                                            <?php if(!empty($biller_details)){
                                                                echo $biller_details[0]->company_reg_no;
                                                            } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="msg-time-chat">
                                                <div class="message-body msg-in">
                                                    <span class="arrow"></span>
                                                    <div class="text">
                                                        <div class="first">
                                                            RC No
                                                        </div>
                                                        <div class="second bg-terques ">
                                                             <?php if(!empty($biller_details)){
                                                                echo $biller_details[0]->rc_no;
                                                            } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="msg-time-chat">
                                                <div class="message-body msg-in">
                                                    <span class="arrow"></span>
                                                    <div class="text">
                                                        <div class="first">
                                                            Tin No
                                                        </div>
                                                        <div class="second bg-terques ">
                                                            <?php if(!empty($biller_details)){
                                                                echo $biller_details[0]->tin_no;
                                                            } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                           
                                            <!-- <div class="msg-time-chat">
                                                <div class="message-body msg-in">
                                                    <span class="arrow"></span>
                                                    <div class="text">
                                                        <div class="first">
                                                            Bank Name
                                                        </div>
                                                        <div class="second bg-terques ">
                                                            Join as Product Asst. Manager
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="msg-time-chat">
                                                <div class="message-body msg-in">
                                                    <span class="arrow"></span>
                                                    <div class="text">
                                                        <div class="first">
                                                            Account Holder
                                                        </div>
                                                        <div class="second bg-terques ">
                                                            Join as Product Asst. Manager
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="msg-time-chat">
                                                <div class="message-body msg-in">
                                                    <span class="arrow"></span>
                                                    <div class="text">
                                                        <div class="first">
                                                            Account No
                                                        </div>
                                                        <div class="second bg-terques ">
                                                            Join as Product Asst. Manager
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> -->
                                       </div>
                                    </div>
                                    
                                  <!--   <div class="col-md-4">
                                        <div class="recent-act">
                                            <h1>Recent Activity</h1>
                                            <div class="activity-icon terques">
                                                <i class="fa fa-check"></i>
                                            </div>
                                            <div class="activity-desk">
                                                <h2>1 Hour Ago</h2>
                                                <p>Purchased new stationary items for head office</p>
                                            </div>
                                            <div class="activity-icon red">
                                                <i class="fa fa-beer"></i>
                                            </div>
                                            <div class="activity-desk">
                                                <h2 class="red">2 Hour Ago</h2>
                                                <p>Completed Coffee meeting with <a href="#" class="terques">Stive Martin</a> regarding the Product Promotion</p>
                                            </div>
                                            <div class="activity-icon purple">
                                                <i class="fa fa-tags"></i>
                                            </div>
                                            <div class="activity-desk">
                                                <h2 class="purple">today evening</h2>
                                                <p>3 photo Uploaded on facebook product page</p>
                                                <div class="photo-gl">
                                                    <a href="#">
                                                        <img src="images/sm-img-1.jpg" alt=""/>
                                                    </a>
                                                    <a href="#">
                                                        <img src="images/sm-img-2.jpg" alt=""/>
                                                    </a>
                                                    <a href="#">
                                                        <img src="images/sm-img-3.jpg" alt=""/>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="activity-icon green">
                                                <i class="fa fa-map-marker"></i>
                                            </div>
                                            <div class="activity-desk">
                                                <h2 class="green">yesterday</h2>
                                                <p>Outdoor visit at <a href="#" class="blue">California State Route</a> 85 with <a href="#" class="terques">John Boltana</a> & <a href="#" class="terques">Harry Piterson</a> regarding to setup a new show room.</p>
                                                <div class="loc-map">
                                                    location map goes here
                                                </div>
                                            </div>

                                            <div class="activity-icon yellow">
                                                <i class="fa fa-user-md"></i>
                                            </div>
                                            <div class="activity-desk">
                                                <h2 class="yellow">12 december 2013</h2>
                                                <p>Montly Regular Medical check up at Greenland Hospital.</p>
                                            </div>

                                        </div>
                                    </div>
                                     -->
                                </div>
                            </div>
                            
                            <div id="contacts" class="tab-pane ">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="prf-contacts">
                                            <h2> <span><i class="fa fa-map-marker"></i></span> location</h2>
                                            <div class="location-info">
                                                <p>Postal Address<br>
                                                    <?php if(!empty($biller_details)){
                                                                echo $biller_details[0]->biller_address;
                                                            } ?></p>
                                                <p>Headquarters<br>
                                                    <?php if(!empty($biller_details)){
                                                                echo $biller_details[0]->biller_address;
                                                            } ?></p>
                                            </div>
                                            <h2> <span><i class="fa fa-phone"></i></span> contacts</h2>
                                            <div class="location-info">
                                                <p>Phone	:   <?php if(!empty($biller_details)){
                                                                echo $biller_details[0]->biller_contact_no;
                                                            } ?> <br>
                                                </p>
                                                <p>Email		:  <?php if(!empty($biller_details)){
                                                                echo $biller_details[0]->biller_email;
                                                            } ?> <br>
                                                </p>
                                                <p>
                                                    Comapny	:  <?php if(!empty($biller_details)){
                                                                echo $biller_details[0]->biller_company_name;
                                                            } ?>  <br>
                                                    
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div id="map-canvas"></div>
                                    </div>
                                </div>
                            </div>
                          <!--   <div id="settings" class="tab-pane ">
                                <div class="position-center">
                                    <div class="prf-contacts sttng">
                                        <h2>  Personal Information</h2>
                                    </div>
                                    <form role="form" class="form-horizontal">
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label"> Avatar</label>
                                            <div class="col-lg-6">
                                                <input type="file" id="exampleInputFile" class="file-pos">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Company</label>
                                            <div class="col-lg-6">
                                                <input type="text" placeholder=" " id="c-name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Lives In</label>
                                            <div class="col-lg-6">
                                                <input type="text" placeholder=" " id="lives-in" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Country</label>
                                            <div class="col-lg-6">
                                                <input type="text" placeholder=" " id="country" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Description</label>
                                            <div class="col-lg-10">
                                                <textarea rows="10" cols="30" class="form-control" id="" name=""></textarea>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="prf-contacts sttng">
                                        <h2> socail networks</h2>
                                    </div>
                                    <form role="form" class="form-horizontal">
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Facebook</label>
                                            <div class="col-lg-6">
                                                <input type="text" placeholder=" " id="fb-name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Twitter</label>
                                            <div class="col-lg-6">
                                                <input type="text" placeholder=" " id="twitter" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Google plus</label>
                                            <div class="col-lg-6">
                                                <input type="text" placeholder=" " id="g-plus" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Flicr</label>
                                            <div class="col-lg-6">
                                                <input type="text" placeholder=" " id="flicr" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Youtube</label>
                                            <div class="col-lg-6">
                                                <input type="text" placeholder=" " id="youtube" class="form-control">
                                            </div>
                                        </div>

                                    </form>
                                    <div class="prf-contacts sttng">
                                        <h2>Contact</h2>
                                    </div>
                                    <form role="form" class="form-horizontal">
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Address 1</label>
                                            <div class="col-lg-6">
                                                <input type="text" placeholder=" " id="addr1" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Address 2</label>
                                            <div class="col-lg-6">
                                                <input type="text" placeholder=" " id="addr2" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Phone</label>
                                            <div class="col-lg-6">
                                                <input type="text" placeholder=" " id="phone" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Cell</label>
                                            <div class="col-lg-6">
                                                <input type="text" placeholder=" " id="cell" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Email</label>
                                            <div class="col-lg-6">
                                                <input type="text" placeholder=" " id="email" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Skype</label>
                                            <div class="col-lg-6">
                                                <input type="text" placeholder=" " id="skype" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-lg-offset-2 col-lg-10">
                                                <button class="btn btn-primary" type="submit">Save</button>
                                                <button class="btn btn-default" type="button">Cancel</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>

                            </div> -->
                        </div>
                    </div>
                </section>
            </div>
        </div>
