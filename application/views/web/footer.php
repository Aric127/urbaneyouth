 <footer>
        <div class="container">

            <div class="col-sm-3 col-xs-6">
                <div class="footer-inner">
                    <h3>TV Recharge</h3>
                    <ul class="list-unstyled">
                        <li> <a href="#">MultiChoice DSTV  </a> </li>
                        <li> <a href="#">Star Times Cable TV </a> </li>
                        <li> <a href="#">MultiChoice GOTV </a> </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-3 col-xs-6">
                <div class="footer-inner">
                    <h3>Mobile Recharge</h3>
                    <ul class="list-unstyled">
                        <li> <a href="#">Etisalat  </a> </li>
                        <li> <a href="#">Airtel </a> </li>
                        <li> <a href="#">MTN </a> </li>
                        <li> <a href="#">Glo </a> </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-3 col-xs-6">
                <div class="footer-inner">
                    <h3>Data Recharge</h3>
                    <ul class="list-unstyled">
                        <li> <a href="#">Smile Recharge   </a> </li>
                        <li> <a href="#">Smile Bundle </a> </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-3 col-xs-6">
                <div class="footer-inner">
                    <h3>Support</h3>
                    <ul class="list-unstyled">
                        <li> <a href="#"> care@oyacharge.com </a> </li>
                        <li> <a href="#vedio_section">About Us </a> </li>
                        <li> <a href="#contact_form ">Contact Us </a> </li>
                        <li> <a href="#">Terms &amp; Conditions</a> </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="copyright"> © 2017 All Rights Reserved. Developed by - <span class="footer-high-text">Oyecharge.com</span></div>
    </footer>
    <!-- view plan -->
    <div class="modal modal1 fade" id="viewPlanmobile" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><span id="plan_type_name"></span> Recharge Plans</h4>
                </div>
                <div class="modal-body">

                    <div class="scroll-tab" id="cat">
                        <ul class="nav nav-tabs" role="tablist" id="plan_category_list">
                        </ul>
                    </div>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="Recommende">

                        </div>

                        <div role="tabpanel" class="tab-pane" id="FullTT">

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- view plan -->
    <div class="modal fade" id="viewPlanTv" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><span id="dthoperator_name"></span>DTH Plans</h4>
                </div>
                <div class="modal-body">
                    <!--  <div class="scroll-tab">
                        <ul class="nav nav-tabs" role="tablist" id="tvplan_category_list">
                        </ul>
                    </div>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="tvRecommende">

                        </div>

                        <div role="tabpanel" class="tab-pane" id="FullTT">

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--Modal for Event book-->
    <div class="modal fade" id="eventDetailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Event Details</h4>
                </div>
                <div class="modal-body clearfix event-datail-sp">
                    <div class="col-sm-6 col-xs-12">
                        <div class="event-banner">
                            <img src="" id="image_event">
                        </div>
                    </div> 
                    <!--&#x20A6;--->
                    <div class="col-sm-6 col-xs-12">
                        <h4 id="e_name">BD Party</h4>
                        <h5 id="event_datetime">Thursday 1st of January 1970 12:00:00 AM </h5>
                        <p id="address_event">JV Complex, Race Course Road, New Palasia, Indore, Madhya Pradesh, India</p>
                        <h4>Description</h4>
                        <p id="desc_event">Thursday 1st of January 1970 12:00:00 AM JV Complex, Race Course Road, New Palasia, Indore, Madhya Pradesh, India</p>
                        <input type="hidden" id="csv_ticket_ids" value="">
                        <input type="hidden" id="click_event_id" value="">
                        <input type="hidden" id="final_amt_ticket" value="0">
                        <strong>Amount</strong>
                        <br>
						<span class="" id="amt_price"><b>0</b> </span>
                        <!-- <div class="ticket-type-btn_qunti">
              <div class="btn-group" role="group" aria-label="...">
                <button type="button" class="btn btn-default" title="400">Normal</button>
                <button type="button" class="btn btn-default" title="800">VIP</button>
              </div>
            </div>
            <div class="Quantity">
              <h5>Quntity <span class="pull-right">
                <div class="input-group">
              <span class="input-group-btn">
                  <button data-field="quant[2]" data-type="minus" class="btn btn-danger btn-number" type="button">
                    <span class="glyphicon glyphicon-minus"></span>
                  </button>
              </span>
              <input type="text" max="100" min="1" value="10" class="form-control input-number" name="quant[2]">
              <span class="input-group-btn">
                  <button data-field="quant[2]" data-type="plus" class="btn btn-success btn-number" type="button">
                      <span class="glyphicon glyphicon-plus"></span>
                  </button>
              </span>
              </div>
                  </span></h5>
            </div> -->
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <div class="col-sm-4">
                        <h5>
							<div class="ticket-type-btn_qunti pull-left" >
								<div id="event_tkt_price"></div>
								
								<div class="clearfix"></div>
							  <div class="btn-group" role="group" aria-label="..." id="event_pass_record">

							  </div>
							</div>
						</h5>
                    </div>
                    <div class="col-sm-5">
                        <div class="Quantity margin-T-20">
                            <h5 class="clearfix">
							<span class="qui pull-left">Quantity</span>
							<span class="pull-left">
								<div class="input-group">
								  <span class="input-group-btn">
									  <button data-field="quant[0]" data-type="minus" class="btn blue-btn btn-number" type="button" onclick="minus_ticket()">
										<span class="glyphicon glyphicon-minus"></span>
									  </button>
								  </span>
									<input type="text" max="100" min="0" value="0" class="form-control input-number" name="quant[1]" id="ticket_value" >
								  <span class="input-group-btn">
									  <button data-field="quant[2]" data-type="plus" class="btn blue-btn btn-number" type="button" onclick="add_ticket()">
										  <span class="glyphicon glyphicon-plus"></span>
									  </button>
								  </span>
								</div>
							</span>
							
				  </h5>
                        </div>
                    </div>
                    <div class="col-sm-3 margin-T-20">
                        <button type="button" class="btn blue-btn pull-right half-w-blue-btn" onclick="check_ticket_avaliblity()">Book</button>
                    </div>
                </div>
<span id="error_status_ticket" style="display: none"></span>
            </div>
        </div>
    </div>
    
    <style>
    	
.modal-content > span#error_status_ticket {
    background: rgba(228, 27, 27, 0.5) none repeat scroll 0 0;
    border-bottom: 1px solid red;
    border-top: 1px solid red;
    border: 1px solid red;
    color: #fff;
    display: block;
    padding: 10px 20px;
    position: relative;
    text-align: center;
    margin:10px auto;
    width:50%;
}
    </style>

    <!---changepassword-->
    <div id="verification-modal" class="modal fade change-psd">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
                    </button>
                    <h4 class="modal-title text-center">verify your mobile number</h4>
                </div>
                <div class="modal-body getway-block">
                    <form>
                        <div class="login-social">
                            <span>We have send a 4-degit confirmation code to-<span id="user_mobile_number"></span></span>
                        </div>
                        <div class="form-group">
                            <input type="text" required class="form-control" placeholder="Enter verification code" id="verification-code" value="">
                             <input type="hidden" id="mob_num_hidden" value="">
                            <div class="d">
                                <span id="login_otp_error"></span>
                            </div>
                        </div>
                        <div class="form-group  text-center">
                            <button onclick="confirm_number()" type="button" class="btn btn-submit full-width"> Confirm Number </button>
                        </div>
                        <div class="form-group  text-center">
                            <a href="javascript:void(0)" class="btn braun-btn proc" onclick="resend_otp()"> Resend </a>
                            <a href="javascript:void(0)" class="btn gray-btn proc" onclick="change_number()"> Change Number </a>
                        </div>

                    </form>
                </div>
                <div class="d">
                    <span id="response_otp_msg"></span>
                </div>
            </div>
        </div>
    </div>

    <div id="changenumber-modal" class="modal fade change-psd">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
                    </button>
                    <h4 class="modal-title text-center">Upgrade your account</h4>
                </div>
                <div class="modal-body getway-block">
                    <form>
                        <div class="login-social">
                            <span>We will send a verification code via SMS to this Number</span>
                        </div>
                        <div class="form-group">
                            <input type="text" required class="form-control" placeholder="Mobile Number" id="Mobile_number-code" value="">
                            <input type="hidden" id="mob_user_id" value="">
                            <div class="d">
                                <span id="login_mob_error"></span>
                            </div>
                        </div>
                        <div class="form-group  text-center">
                            <button type="button" class="btn btn-submit full-width" onclick="send_otp()"> Continue </button>
                        </div>
                    </form>
                </div>
                <div class="d">
                    <span id="mobile_number_response"></span>
                </div>
            </div>
        </div>
    </div>

    <!-- LoginModal HTML -->
    <div id="LoginModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
                    </button>
                    <h4 class="modal-title text-center">Login</h4>
                </div>
                <div class="modal-body getway-block">
                    <form>
                        <div class="login-social">
                            <a href="javascript:void(0)" onclick="fb_login()" class="button login-facebook">
                                <!-- <i class=" fa fa-facebook"></i>Login with Facebook -->
                                <img src="<?php echo base_url('wassets/images/fb.png');?>">
                            </a>
                         <!--    <a href="<?php echo site_url('web/google_login/Google'); ?>" class="button login-googleplus">
                                <i class="fa fa-google-plus"></i>Login with Google+
                            </a> -->

                            <div class="seperator">
                                <label>OR</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" required class="form-control" placeholder="Enter Mobile Number or Email" id="user_mobile_login" value="" autocomplete="off" onblur="check_login_popup_msg()">
                            <div class="d">
                                <span id="login_mob_error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="Password" required class="form-control" placeholder="Enter Your Password" id="user_password" value="" autocomplete="off" onblur="check_login_popup_msg()" maxlength="4" minlength="4">
                            <div class="d">
                                <span id="login_pass_error"></span>
                            </div>
                        </div>
                        <div class="form-group  text-center">
                           <!--  <a href="#ForgotModal">Forgot Password? </a> -->

                            <a href="#ForgotModal" data-toggle="modal" data-dismiss="modal"> Forgot Password? </a>
                        </div>
                        <button type="button" class="btn btn-submit full-width" onclick="user_login()"> Log in </button>
                    </form>
                </div>
                <div class="d">
                    <span id="login_response_failed" class=""></span>
                </div>
                <div class="modal-footer">
                    <div class="text-center">
                        Don't have an account? <a href="#SignupModal" data-toggle="modal" data-dismiss="modal"> Signup here.</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

      <div class="modal fade" id="SignupModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button"> &times; </button>
                    <h4 class="modal-title text-center">Signup</h4>
                </div>
                <div class="modal-body getway-block">
                   
                    
                    <div class="form-group">
                       
                         <input type="email" placeholder="Enter Your Email" class="form-control" required onblur="check_email()" value="" id="user_email" autocomplete="off">
                        <div class="d">
                            <span id="signup_email_error"></span>
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-sm-6">
                           <div class="form-group">
                        <input type="text" placeholder="Mobile Number" class="form-control" required id="user_mobile_no" value="" onkeyup="check_signup_number()" autocomplete="off">
                        <div class="d">
                            <span id="signup_mob_error"></span>
                        </div>
                    </div> 
                        </div>
                        <div class="col-sm-6">
                          
                    <div class="form-group">
                        <input type="Password" placeholder="Set Your 4 digit mpin" class="form-control" required onkeyup="check_password()" id="user_pass" value="" autocomplete="off" maxlength="4" minlength="4">
                        <div class="d">
                            <span id="signup_pass_error"></span>
                        </div>
                    </div>  
                        </div>
                    </div>
                    <div class="form-group">
                        <p>You have reffer code? Please Enter here.</p>
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="Enter Reffer Code (optional)" class="form-control" required onblur="check_reffer_code()" value="" id="reffer_code" autocomplete="off">
                        <div class="d">
                            <span id="signup_ref_error"></span>
                        </div>
                    </div>
                  <!--   <div class="form-group">
                        <p> Tip: Protect your account. Use a mixed case alphanumeric password with special characters. </p>
                    </div> -->
                    <div class="form-group">
                        <button class="btn btn-submit full-width" data-toggle="modal" type="button" onclick="signup_user()"> Signup </button>
                    </div>
                    <div class="form-group">
                        <div class="d">
                            <span id="signup_error"></span>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <div class="text-center">
                        Already have an account? <a data-dismiss="modal" data-toggle="modal" href="#LoginModal"> Login</a>
                    </div>
                </div>

            </div>

        </div>

        <!--forgot modal-->

         <div class="modal fade" id="ForgotModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button"> &times; </button>
                    <h4 class="modal-title text-center">Signup</h4>
                </div>
                <div class="modal-body getway-block">
                    <div class="form-group">
                        <input type="text" placeholder="Mobile Number" class="form-control" required id="user_mobile_no" value="" onkeyup="check_signup_number()" autocomplete="off">
                        <div class="d">
                            <span id="signup_mob_error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="email" placeholder="Enter Your Email" class="form-control" required onblur="check_email()" value="" id="user_email" autocomplete="off">
                        <div class="d">
                            <span id="signup_email_error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="Password" placeholder="Enter Password" class="form-control" required onkeyup="check_password()" id="user_pass" value="" autocomplete="off" maxlength="4" minlength="4">
                        <div class="d">
                            <span id="signup_pass_error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <p>You have reffer code? Please Enter here.</p>
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="Enter Reffer Code (optional)" class="form-control" required onblur="check_reffer_code()" value="" id="reffer_code" autocomplete="off">
                        <div class="d">
                            <span id="signup_ref_error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <p> Tip: Protect your account. Use a mixed case alphanumeric password with special characters. </p>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-submit full-width" data-toggle="modal" type="button" onclick="signup_user()"> Signup </button>
                    </div>
                    <div class="form-group">
                        <div class="d">
                            <span id="signup_error"></span>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <div class="text-center">
                        Already have an account? <a data-dismiss="modal" data-toggle="modal" href="#LoginModal"> Login</a>
                    </div>
                </div>

            </div>

        </div>

       

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
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
            $('.ststCntnr').owlCarousel({
                loop: true,
                margin: 5,
                nav: true,
                dots: false,
                navText: ["<i class='icon-arrow-left'></i>", "<i class='icon-arrow-right'></i>"],
                autoPlay: 1000,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    1000: {
                        items: 4
                    }
                }
            });
        </script>
        <script type="text/javascript">
            $('#owl-demo').owlCarousel({
                loop: true,
                margin: 10,
                nav: false,
                autoPlay: 1000,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 1
                    },
                    1000: {
                        items: 3
                    }
                }
            });
        </script>

        <script>
            $(document).ready(function() {

                var owl = $("#owl-demo");

                owl.owlCarousel({
                    items: 3, //10 items above 1000px browser width
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

            //plugin bootstrap minus and plus
            //http://jsfiddle.net/laelitenetwork/puJ6G/
            $('.btn-number').click(function(e) {
                e.preventDefault();

                fieldName = $(this).attr('data-field');
                type = $(this).attr('data-type');
                var input = $("input[name='" + fieldName + "']");
                var currentVal = parseInt(input.val());
                if (!isNaN(currentVal)) {
                    if (type == 'minus') {

                        if (currentVal > input.attr('min')) {
                            input.val(currentVal - 1).change();
                        }
                        if (parseInt(input.val()) == input.attr('min')) {
                            $(this).attr('disabled', true);
                        }

                    } else if (type == 'plus') {

                        if (currentVal < input.attr('max')) {
                            input.val(currentVal + 1).change();
                        }
                        if (parseInt(input.val()) == input.attr('max')) {
                            $(this).attr('disabled', true);
                        }

                    }
                } else {
                    input.val(0);
                }
            });
            $('.input-number').focusin(function() {
                $(this).data('oldValue', $(this).val());
            });
            $('.input-number').change(function() {

                minValue = parseInt($(this).attr('min'));
                maxValue = parseInt($(this).attr('max'));
                valueCurrent = parseInt($(this).val());

                name = $(this).attr('name');
                if (valueCurrent >= minValue) {
                    $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
                } else {
                    alert('Sorry, the minimum value was reached');
                    $(this).val($(this).data('oldValue'));
                }
                if (valueCurrent <= maxValue) {
                    $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
                } else {
                    alert('Sorry, the maximum value was reached');
                    $(this).val($(this).data('oldValue'));
                }

            });
            $(".input-number").keydown(function(e) {
                // Allow: backspace, delete, tab, escape, enter and .
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                    // Allow: Ctrl+A
                    (e.keyCode == 65 && e.ctrlKey === true) ||
                    // Allow: home, end, left, right
                    (e.keyCode >= 35 && e.keyCode <= 39)) {
                    // let it happen, don't do anything
                    return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });

            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                autoPlay: 1000,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 1
                    },
                    1000: {
                        items: 1
                    }
                }
            })

            $('#EventDetails').on('shown.bs.modal', function() {
                $('#myInput').focus()
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#mobile').keyup(function() {

                    var mobile = document.getElementById("mobileno");
                    var value = $('#mobileno').val();

                    $.ajax({
                        url: base_url + "check_operator",
                        type: "POST",
                        data: {
                            'mobile': value

                        },
                        success: function(data) {
                           // alert('test');
                            $("#rec_category").val(1);

                            var getdata = jQuery.parseJSON(data);
                            var operator_id = getdata.operator_id;
                            var operator_name = getdata.operator_name;
                           
                            if (operator_id) {
                                $("#mobile_operator_id").val(operator_id).change();
                            } else {
                                $("#mobile_operator_id").val(0).change();
                            }

                        }
                    });
                    if (value.length == 11) {
                    	
                        $("#mob_num_error").removeClass("errormsg");
                        $("#mob_num_error").text("");
                    } else if (isNaN($('#mobile').val())) {
                        $("#mob_num_error").addClass("errormsg");
                      $("#mob_num_error").text("Enter valid 11 digit mobile number");
                    } else {
                        $("#mob_num_error").addClass("errormsg");
                        $("#mob_num_error").text("Enter valid 11 digit mobile number");
                    }

                });
                $('#tv_number').keyup(function() {

                    var tv_number = $('#tv_number').val();
                    if ($('#tv_number').val().length >= 5) {
                   //     $('#preloader').showLoading();

                        $("#dth_num_error").text("");
                        $("#dth_num_error").removeClass("errormsg");
                        var tv_operator_id = $("#dth_operator_id").val();
                        $.ajax({
                            url: base_url + "validate_tv_number",
                            type: "POST",
                            data: {
                                'tv_number': tv_number,
                                'tv_operator_id': tv_operator_id

                            },
                            success: function(data) {
                             //   $('#preloader').hideLoading();
                                $("#rec_category").val(2);
                                var getdata = jQuery.parseJSON(data);
                                var status = getdata.status;
                                if (status == 'true') {
                                    var customer_name = getdata.customer_name;
                                    $("#tv_number_name").val(customer_name);
                                    $("#service_id").val(getdata.service_id);
                                    $("#tv_new_number").val(getdata.customer_no);
                                } else {
                                    var message = getdata.message;
                                    $("#tv_number_name").val(message);

                                }

                            }

                        });
                    } else if (isNaN($('#tv_number').val())) {
                        $("#dth_num_error").addClass("errormsg");
                        $('#dth_num_error').text('Please Enter a valid Tv number');
                    } else {
                        $("#dth_num_error").addClass("errormsg");
                        $("#dth_num_error").text("Please Enter a valid Tv number");

                    }

                });

                $('#data_card_number').keyup(function() {
                    var value = $('#data_card_number').val();
                    if ($('#data_card_number').val().length >= 5) {
                        $("#data_number_error").text("");
                        $("#data_number_error").removeClass("errormsg");
                        var data_card_number = $("#data_card_number").val();
                        var datacard_operator_id = $("#datacard_operator_id").val();

                        $.ajax({
                            url: base_url + "validate_data_number",
                            type: "POST",
                            data: {
                                'data_number': data_card_number,
                                'data_operator_id': datacard_operator_id

                            },
                            success: function(data) {
                                $("#rec_category").val(3);
                                var getdata = jQuery.parseJSON(data);
                                var status = getdata.status;
                                if (status == 'true') {

                                    var customer_name = getdata.customer_name;
                                    $("#data_card_number_name12").val(customer_name);
                                    if (getdata.plans == '') {
                                        $("#plan_div").attr('style', 'display: none');
                                        $('#datacard_amount').attr('readonly', 'false');
                                    } else {
                                        $("#plan_div").attr('style', 'display: block');
                                        $('#datacard_amount').attr('readonly', 'true');
                                    }
                                } else {
                                    var message = getdata.message;

                                    $("#data_card_number_name12").val(message);
                                    $("#datacard_next").attr('style', 'display: none');
                                }

                            }

                        });
                    } else if (isNaN($('#data_card_number').val())) {
                        $("#data_number_error").addClass("errormsg");
                        $('#data_number_error').text('Please Enter a valid Data card number');
                    } else {
                        $("#data_number_error").addClass("errormsg");
                        $("#data_number_error").text("Please Enter minimum 5 digit Data card number");
                    }

                });

            });
        </script>
        <div id="fb-root"></div>
        <!--<script>
            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.8&appId=1716710845207683";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>-->
        <script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '594649877357899',
      xfbml      : true,
      version    : 'v3.1'
    });
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>

        <script>
            function show_login() {
                $("#LoginModal").modal();
            }
            // Auto logout functionlity


function reset_interval()
{
//resets the timer. The timer is reset on each of the below events:
// 1. mousemove   2. mouseclick   3. key press 4. scroliing
//first step: clear the existing timer
clearInterval(3000000);
//second step: implement the timer again
timer=setInterval("Logout()",3000000);

}

function auto_logout()
{
//this function will redirect the user to the logout script
localStorage.setItem("mobileno","");
	location.href = home_url +"web/logout";
	 localStorage.clear();
}
        </script>
        





</body>

</html>