<link href="<?php echo base_url('wassets/css/owl.carousel.css');?>" rel="stylesheet">

<div class="container-fluid">
    <div class="container over-lap-div">
        <div class="col-sm-12 col-xs-12 col-lg-12 recharge-result" style="min-height: 450px;">
            <div class="trans-head-div">
                <h2><i class="icon-user"></i>My Account</h2>
            </div>
           
            <div class="col-sm-12 col-xs-12 ">
                <div class="tabbable-panel ">
                    <div class="tabbable-line my-accoun">
                        <ul class="nav nav-tabs ">
                            <li class="active ">
                                <a href="#tab_default_1" data-toggle="tab" class="clearfix">
                                    <i class="icon-user pull-left"></i> <p class="pull-right">Personal Info </p></a>
                            </li>
                            <?php if(!empty($my_profile)){
                            	if($my_profile->user_login_type=='1'){ ?>
                            <li class="">
                                <a href="#tab_default_2" data-toggle="tab" class="clearfix">
                                    <i class="icon-key pull-left"></i> <p class="pull-right"> Change Password </p></a>
                            </li>
                            <?php } } ?>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_default_1">
                                <div class="col-sm-5 col-xs-12">
                                	
                                	<div class="outerblock titleBlock succ" id="success_profile" style="display: none">
							         <i class="fa fa-check" aria-hidden="true"></i>
							         <div class="titlecont"><b class="ln25"><span id="profile_success"></span> </b>
							         </div>
							         </div> 
                                	
                                    <br>
                                    <div class="">
                                     
                                            <div class="form-group">
                                                <label for="usr">Name</label>
                                                <input class="form-control" id="user_name" placeholder="Name" name="user_name" required="" value="<?php if(!empty($my_profile->user_name)){ echo $my_profile->user_name; } ?>" type="text">
                                                <input type="hidden" placeholder="Enter Name" id="user_id" name="user_id" value="<?php if(!empty($my_profile->user_id)){ echo $my_profile->user_id; } ?>"/>
                                            </div>

                                            <div class="form-group">
                                                <label for="usr">Email ID</label>
                                                <input class="form-control" id="user_email" placeholder="Email Id" name="user_email" <?php if(!empty($my_profile->user_email)){ ?> readonly="readonly"  <?php } ?> value="<?php if(!empty($my_profile->user_email)){ echo $my_profile->user_email; } ?>" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label for="usr">Mobile No.</label>
                                                <input class="form-control" id="user_mobile_no" placeholder="Mobile Number" name="user_mobile_no" required="" value="<?php if(!empty($my_profile->user_contact_no)){ echo $my_profile->user_contact_no; } ?>" type="text" readonly="readonly">
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <button class="btn blue-btn half-w-blue-btn" onclick="user_update()">Update</button>
                                            </div>
                                      
                                    </div>
                                </div>
                                <div class="col-sm-1 col-xs-12">
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <img src="<?php if(!empty($my_profile->qr_code)){ echo $my_profile->qr_code; } else { echo base_url('wassets/images/my-profile-patten.png'); }?>" width="60%" class="center-block qr-code-box">

                                    <!-- <button class="btn btn-success btn-small">Share</button> -->
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_default_2">
                                <div class="col-sm-5 col-xs-12">
                                	<div class="outerblock titleBlock succ" id="success_password" style="display: none">
							         <i class="fa fa-check" aria-hidden="true"></i>
							         <div class="titlecont"><b class="ln25"><span id="password_success"></span> </b>
							         </div>
							         </div> 
                                    <br>
                                    <div class="">
                                      
                                            <div class="form-group">
                                                <label for="usr">Old Password</label>
                                                <input class="form-control" id="old_password" placeholder="Old Password" name="old_password" required="" value="" type="password" onblur="check_empty_password()">
                                                 <input type="hidden" placeholder="Enter Name" id="change_user_id" name="change_user_id" value="<?php if(!empty($my_profile->user_id)){ echo $my_profile->user_id; } ?>"/>
                                                 <span id="old_pass_error"></span>
                                            </div>

                                            <div class="form-group">
                                                <label for="usr">New Password</label>
                                                <input class="form-control" id="new_password" placeholder="New Password" name="new_password" required="" value="" type="password" onblur="check_empty_password()" maxlength="4" minlength="4">
                                                 <span id="new_pass_error"></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="usr">Confirm Password</label>
                                                <input class="form-control" id="confirm_password" placeholder="Confirm Password" name="confirm_password" required="" value="" type="password" oninput="check(this)"  maxlength="4" minlength="4">
                                                 <span id="confirm_pass_error"></span>
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <button class="btn blue-btn half-w-blue-btn" onclick="change_password()">Update</button>
                                            </div>
                                  
                                    </div>
                                </div>
                                <div class="col-sm-1 col-xs-12">
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <img src="<?php echo base_url('wassets/images/change-pass-patten.png');?>" width="60%" class="center-block">
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <!--recharge-details-->
</div>
</div>
<!--cont-fluid-->

<script>
    var owl = $('.owl-carousel');
    owl.owlCarousel({
        margin: 10,
        loop: true,
        /*    autoPlay:1000,*/
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 2
            }
        }
    })
</script>
<script>
    $('.responsive-tabs').responsiveTabs({
        accordionOn: ['xs', 'sm']
    });
</script>

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
<script src="<?php echo base_url('wassets/js/jquery.bootstrap-responsive-tabs.min.js');?>">
</script>
<script src="<?php echo base_url('wassets/js/bootstrap.min.js')?>">
</script>
<script src="<?php echo base_url('wassets/js/jquery-ui.min.js');?>">
</script>
<script src="<?php echo base_url('wassets/js/owl.carousel.js');?>">
</script>
<script src="<?php echo base_url('wassets/js/slick.min.js');?>"></script>
<script src="<?php echo base_url('wassets/js/matchHeight.min.js');?>">
</script>
<script src="<?php echo base_url('wassets/js/bootstrap-select.js');?>">
</script>
<script src="<?php echo base_url('wassets/js/custom.js');?>">
</script>
<script>
    $('.responsive-tabs').responsiveTabs({
        accordionOn: ['xs', 'sm']
    });
</script>
<script type="text/javascript">
    $('.dropdown-select').on('click', '.dropdown-menu li a', function() {
        var target = $(this).html();

        //Adds active class to selected item
        $(this).parents('.dropdown-menu').find('li').removeClass('active');
        $(this).parent('li').addClass('active');

        //Displays selected text on dropdown-toggle button
        $(this).parents('.dropdown-select').find('.dropdown-toggle').html(target + ' <span class="caret"></span>');
    });
</script>
<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
<script>
    // When the browser is ready...
    $(function() {

        // Setup form validation on the #register-form element
        $("#card_payment").validate({

            // Specify the validation rules
            rules: {
                expiry_month: "required",
                expiry_year: "required",
                card_no: {
                    required: true,
                    minlength: 16
                },
                cvv_no: {
                    required: true,
                    minlength: 3,
                    maxlength: 3
                },
                agree: "required"
            },

            // Specify the validation error messages
            messages: {
                firstname: "Please enter card expiry month",
                lastname: "Please enter card expiry year",
                card_no: {
                    required: "Please enter a valid card number",
                    minlength: "Please enter 16 digit card number"
                },
                cvv_no: {
                    required: "Please enter a valid cvv number",
                    minlength: "Please enter 3 digit cvv number"
                }
            },

            submitHandler: function(form) {
                form.submit();
            }
        });

    });
</script>
<script type="text/javascript">
    $(document).ready(function() {

        var owl = $(".owl-carousel");

        owl.owlCarousel({
            items: 1, //10 items above 1000px browser width
            itemsDesktop: [1000, 3], //5 items between 1000px and 901px
            itemsDesktopSmall: [900, 3], // betweem 900px and 601px
            itemsTablet: [600, 2], //2 items between 600 and 0
            itemsMobile: false // itemsMobile disabled - inherit from itemsTablet option

        });

        // Custom Navigation Events
        $(".next").click(function() {
            owl.trigger('owl.next');
        })
        $(".prev").click(function() {
            owl.trigger('owl.prev');
        })
        $(".play").click(function() {
            owl.trigger('owl.play', 1000); //owl.play event accept autoPlay speed as second parameter
        })

    });
</script>
<script language='javascript' type='text/javascript'>
    function check(input) {
        if (input.value != document.getElementById('new_password').value) {
            input.setCustomValidity('Password Must be Matching.');
        } else {
            // input is valid -- reset the error message
            input.setCustomValidity('Password does not match!');
        }
    }
</script>
</body>

</html>