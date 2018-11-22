 <div class="modal fade" id="SignupModal">
     <div class="log-in-pop">
        <div class="log-in-pop-left">
          <h2  style="text-transform: capitalize;">Welcome to oyacharge</h2>
          <p>Don't have an account? Create your account. It's take less then a minutes</p>
          <h4>Login with</h4>
          <ul>
            <li><a href="#"><i class="fa fa-facebook"></i> Facebook</a>
            </li>
            <li><a href="#"><i class="fa fa-google"></i> Google+</a>
            </li>
            <br><br><br>
          </ul>
        </div>
        <div class="log-in-pop-right">
          <a href="#" class="pop-close" data-dismiss="modal"><img src="images/cancel.html" alt="" />
          </a>
          <h4>Create an Account</h4>
          <p>Don't have an account? Create your account. It's take less then a minutes</p>
          <form class="s12" id="signup_form">
            <div>
              <div class="input-field s12">
               <div class="form-group">
                       
                         <input type="email" placeholder="Enter Your Email" class="form-control" required onblur="check_email()" value="" id="user_email" autocomplete="off">
                        <div class="d">
                            <span id="signup_email_error"></span>
                        </div>
                    </div>
              </div>
            </div>
            <div>
              <div class="input-field s12">
               <div class="form-group">
                        <input type="text" placeholder="Mobile Number" class="form-control" required id="user_mobile_no" value="" onkeyup="check_signup_number()" autocomplete="off">
                        <div class="d">
                            <span id="signup_mob_error"></span>
                        </div>
                    </div> 
              </div>
            </div>
            <div>
              <div class="input-field s12">
                 <div class="form-group">
                        <input type="Password" placeholder="Set Your 4 digit mpin" class="form-control" required onkeyup="check_password()" id="user_pass" value="" autocomplete="off" maxlength="4" minlength="4">
                        <div class="d">
                            <span id="signup_pass_error"></span>
                        </div>
                    </div> 
              </div>
            </div>
            <div>
              <div class="input-field s12">
               <div class="form-group">
                        <p>You have reffer code? Please Enter here.</p>
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="Enter Reffer Code (optional)" class="form-control" required onblur="check_reffer_code()" value="" id="reffer_code" autocomplete="off">
                        <div class="d">
                            <span id="signup_ref_error"></span>
                        </div>
                    </div>
              </div>
            </div>
            <div>
              <div class="input-field s4">
                <input type="submit" value="Register" class="waves-effect waves-light log-in-btn"  data-toggle="modal"   onclick="signup_user()"> </div>
            </div>
            <div>
              <div class="input-field s12"> <a href="#" data-toggle="modal"  onclick="show_login()">Are you a already member ? Login</a> </div>
            </div>
          </form>
        </div>
      </div>   
  </div> 


    <div id="LoginModal"   class="modal" data-easein="pulse"  tabindex="-1" role="dialog" aria-labelledby="costumModalLabel" aria-hidden="true">
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
                        Don't have an account? <a href="#SignupModal" data-toggle="modal" data-dismiss="modal" id="SignupModalbtn"> Signup here.</a>
                    </div>
                </div>
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

     <!-- view plan -->
    <div class="modal modal1 fade" id="viewPlanmobile" role="dialog" data-easein="bounceRightIn">
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