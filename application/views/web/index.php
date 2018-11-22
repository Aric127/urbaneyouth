
        <div class="col-sm-12 col-xs-12 hidden-md hidden-lg hidden-sm visible-xs mobi">
            <div class="content-slider-right">
                <div class="owl-carousel owl-theme">
                    <div class="item">
                        <h4><span>GET UP TO 50%</span> OF YOUR SPENDINGS BACK</h4></div>
                    <div class="item">
                        <h4>SAVE MORE THAN YOU SPEND</h4></div>
                    <div class="item">
                        <h4>GET REWARDED EACH TIME YOU SPEND</h4></div>
                </div>
            </div>
        </div>
        <div class="recharge-slab-wrap">
            <div class="container">

              

                <div class="col-sm-8 home-pg-tb">
                    <ul class="nav nav-tabs  responsive-tabs">
                        <li class="active">
                            <a data-toggle="tab" href="#mobile" onclick="open_tab()">
                                <span> <img src="<?php echo base_url('wassets/images/fig_01.png');?>"> </span> Mobile </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#dth" onclick="open_tab()">
                                <span> <img src="<?php echo base_url('wassets/images/fig_02.png');?>"> </span> DTH </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#datacard" onclick="open_tab()">
                                <span> <img src="<?php echo base_url('wassets/images/fig_03.png');?>"> </span> DataCard </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#electricity" onclick="open_tab()">
                                <span> <img src="<?php echo base_url('wassets/images/fig_04.png');?>"> </span> Electricity </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#offering" onclick="open_tab()">
                                <span> <img src="<?php echo base_url('wassets/images/fig_05.png');?>"> </span> Offering </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#billers" onclick="open_tab()">
                                <span> <img src="<?php echo base_url('wassets/images/fig_06.png');?>"> </span> Billers </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#events" onclick="open_tab()">
                                <span> <img src="<?php echo base_url('wassets/images/fig_07.png');?>"> </span> Events </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="mobile" class="tab-pane in active">
                            <div class="frmnwrp">
                                <div class="form-group">
                                    <div class="radio-inline">
                                        <label>
                                            <input type="radio" name="optionsRadios" value="1" id="mobile_topup" checked onclick="toppup_type(1)"> Airtime
                                        </label>
                                    </div>
                                    <div class="radio-inline">
                                        <label>
                                            <input type="radio" name="optionsRadios" value="2" id="mobile_bundle" onclick="toppup_type(2)"> Data Bundle
                                        </label>
                                   </div>
                                </div>
                                <div class="form-group mo-m-o clearfix">
                                    <div class="col-sm-6">
                                    	<input type="hidden" value="1" id="mobile_type" readonly="readonly">
                                        <input onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" type="text" class="form-control" placeholder="Enter your 11 digit mobile no" id="mobileno" value="" autocomplete="off">
                                        <input type="hidden" id="rec_category" value="">
                                        <div class="icn"><img src="<?php echo base_url('wassets/images/mobile_number.png');?>"> </div>
                                         <span id="mob_num_error"></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <select class="selectpicker margin-T-5" id="mobile_operator_id" data-container="body">
                                            <option value=""> Select operator</option>
                                            <?php if(!empty($operator))
                                 {
                                   foreach($operator as $value){

                                    if($value->recharge_category_id=='1')
                  { ?>
                                                <option value="<?php echo $value->operator_id ?>">
                                                    <?php echo $value->operator_name; ?>
                                                </option>
                                                <?php }
                                      }
                                   } ?>
                                        </select>
                                         <span id="mob_operator_error"></span>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" placeholder="How much to recharge?" id="mobile_recharge_amount" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                        <div class="icn"><img src="<?php echo base_url('wassets/images/nyra_icon.png');?>"> </div>
                                        <span id="error_mobile_recharge"></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <button class="gray-btn btn quarter-width margin-T-5" onclick="recharge_plan()"> View plan </button>
                                        <button class="blue-btn btn quarter-width margin-T-5" onclick="mobile_recharge()"> Pay now </button>
                                        <?php if(isset($isLogin) && $isLogin == false) { ?>
                            <!--    <button class="brown-btn btn quarter-width margin-T-5" onclick="quick_mobile_recharge()" >Quick  Pay</button> -->

                                    <?php } ?>












                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="dth" class="tab-pane">
                            <div class="frmnwrp">
                                <div class="form-group mo-m-o clearfix">
                                    <div class="col-sm-6">
                                        <select class="selectpicker margin-T-5" id="dth_operator_id" data-container="body">
                                            <option value=""> Select operator</option>
                                            <?php if(!empty($operator)){
                                   foreach($operator as $value){

                                    if($value->recharge_category_id=='2')
                  { ?>
                                                <option value="<?php echo $value->operator_id ?>">
                                                    <?php echo $value->operator_name; ?>
                                                </option>
                                                <?php }
                                   }
                                   } ?>
                                        </select>
                                         <span id="dth_operator_error"></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control margin-T-5" placeholder="What's your DTH Number?" id="tv_number" value="" autocomplete="off" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                        <div class="icn"><img src="<?php echo base_url('wassets/images/mobile_number.png');?>"> </div>
                                        <span id="dth_num_error"></span>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control margin-T-5" placeholder="Enter Amount" id="tv_rec_amount" autocomplete="off" readonly onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                        <div class="icn"> <img src="<?php echo base_url('wassets/images/nyra_icon.png');?>"> </div>
                                         <span id="dth_amt_error"></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control margin-T-5 normal-input" placeholder="Name" id="tv_number_name" value="" autocomplete="off" readonly disabled="disabled">
                                        <input type="hidden" id="tv_rec_code" value="" readonly="">
                                        <input type="hidden" id="tv_new_number" value="" readonly="">
                                        <input type="hidden" id="service_id" value="" readonly="">
                                        <div class="icn"> </div>
                                        <span id="error_dth_recharge"></span>

                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="col-sm-6">
                                        <button class="gray-btn btn quarter-width margin-T-5" onclick="plan_list()"> View plan </button>
                                        <button class=" btn blue-btn quarter-width margin-T-5" onclick="dth_recharge()"> Pay now </button>
                                        <?php if(isset($isLogin) && $isLogin == false) { ?>
                                         <button class="brown-btn btn quarter-width margin-T-5" onclick="quick_dth_recharge()" >Quick  Pay</button>
                                         <?php } ?>
                                    </div>
                                    <div class="col-sm-6">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="datacard" class="tab-pane">
                            <div class="frmnwrp">
                                <div class="form-group mo-m-o clearfix">
                                    <div class="col-sm-6">
                                        <select class="selectpicker margin-T-5" id="datacard_operator_id" data-container="body">
                                            <option value=""> Select operator</option>
                                            <?php if(!empty($operator)){
                                   					foreach($operator as $value){

                                    				if($value->recharge_category_id=='3')
                  										{ ?>
                                                			<option value="<?php echo $value->operator_id ?>">
                                                    			<?php echo $value->operator_name; ?>
                                                			</option>
                                   					<?php }}} ?>
                                        	</select>
                                         <span id="data_oper_error"></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control margin-T-5" placeholder="Enter your data card no" id="data_card_number" value="" autocomplete="off" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                        <div class="icn"><img src="<?php echo base_url('wassets/images/mobile_number.png');?>"> </div>
                                         <span id="data_number_error"></span>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control margin-T-5" placeholder="Enter Amount" id="datacard_amount" autocomplete="off" readonly onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                        <input type="hidden" placeholder="₦" id="datacard_typecode">
                                        <div class="icn"> <img src="<?php echo base_url('wassets/images/nyra_icon.png');?>"> </div>
                                        <span id="data_amt_error"></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control margin-T-5 normal-input" placeholder="Name" id="data_card_number_name12" value="" autocomplete="off" readonly onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                        <!--<input type="hidden" id="tv_rec_code" value="">
                                        <input type="hidden" id="tv_new_number" value="">-->
                                        <div class="icn"> </div>
                                        
                                    </div>
									<div class="col-sm-12">
									<span id="data_num_error"></span>
									</div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="col-sm-6">
                                        <button class="gray-btn btn quarter-width margin-T-5" onclick="data_plan()"> View plan </button>
                                        <button class=" btn blue-btn quarter-width margin-T-5" onclick="datacard_recharge(1)"> Pay now </button>
                                        <?php if(isset($isLogin) && $isLogin == false) { ?>
                                         <button class="brown-btn btn quarter-width margin-T-5" onclick="quick_data_recharge()" >Quick  Pay</button>
                                        <?php } ?>
                                    </div>
                                    <div class="col-sm-6">

                                    </div>
                                </div>

                            </div>
                        </div>
                        <div id="electricity" class="tab-pane">
                            <div class="frmnwrp">
                                <div class="form-group mo-m-o clearfix">
                                    <div class="col-sm-6">
                                        <select id="electricty_operator_id" class="selectpicker margin-T-5" data-container="body">
                                            <option value="">Which operator?</option>
                                            <?php if(!empty($operator))
                               {
                                   foreach($operator as $value){

                                    if($value->recharge_category_id=='4')
								{ ?>
                                                <option value="<?php echo $value->operator_id ?>">
                                                    <?php echo $value->operator_name; ?>
                                                </option>
                                                <?php }
                                   }
                                 } ?>
                                        </select>
                                         <span id="ele_oper_error"></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <input id="electric_card_number" type="text" class="form-control margin-T-5" placeholder="Enter your Meter Number" onblur="check_electric_number(this.value)" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                        <div class="icn"><img src="<?php echo base_url('wassets/images/mobile_number.png');?>"> </div>
                                         <span id="ele_num_error"></span>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control margin-T-5" placeholder="Enter Amount" id="electrice_amount" value="" onblur="check_electricity_mobile_amt(this.value)" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                        <div class="icn"> <img src="<?php echo base_url('wassets/images/nyra_icon.png');?>"> </div>
                                         <span id="ele_amt_error"></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control margin-T-5 normal-input" placeholder="Customer Name" id="electricity_customer_name" value="" readonly disabled="disabled">
                                        <div class="icn"> </div>
                                        <span id="electricity_error"></span>
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="col-sm-6">
                                        <!--<button class="gray-btn btn quarter-width margin-T-5"> View plan </button>-->
                                        <button onclick="electricity_recharge()" class="blue-btn btn quarter-width margin-T-5"> Pay now </button>
                                        <?php if(isset($isLogin) && $isLogin == false) { ?>
                                         <button class="brown-btn btn quarter-width margin-T-5" onclick="quick_electricity_recharge()" >Quick  Pay</button>
                                         <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="billers" class="tab-pane">
                            <div class="frmnwrp">
                                <div class="form-group mo-m-o clearfix">
                                    <div class="col-sm-6">
                                        <select class="selectpicker margin-T-5" data-container="body" id="biller" onchange="show_service_provider(this.value)">
                                            <option value="">Select Biller Category</option>
                                            <?php if(!empty($biller_category)){
                                           	foreach ($biller_category as  $value) { ?>
                                                <option value="<?php echo $value->biller_category_id;?>">
                                                    <?php echo $value->biller_category_name; ?>
                                                </option>
                                                <?php	   }
                                           } ?>
                                        </select>
                                        <input type="hidden" id="biller_id" value="" />
                                          <span id="biller_cat_errro"></span>
                                    </div>
                                    <div class="col-sm-6 selectop1">
                                        <select class="cus-select" data-container="body" id="service_provider_list" onchange="get_service_provider(this.value)">
                                            <option>Select Service Provider</option>

                                        </select>
                                        <input type="hidden" id="bill_provider_id" value="" />
                                         <span id="biller_ser_errro"></span>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control margin-T-5 normal-input" placeholder="Enter Invoice Number" autocomplete="off" value="" id="consumer_number" onblur="check_consumer_number()" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                        <div class="icn"> </div>
                                        <span id="error_consumer_no"></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <button class="blue-btn btn quarter-width margin-T-5" onclick="pay_bill(1)"> Pay now </button>
                                        <?php if(isset($isLogin) && $isLogin == false) { ?>
                                        <button class="brown-btn btn quarter-width margin-T-5" onclick="pay_bill(2)" >Quick  Pay</button>
                                        <?php } ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div id="offering" class="tab-pane">
                            <div class="frmnwrp">
                                <div class="form-group mo-m-o clearfix">
                                    <div class="col-sm-6 selectop">
                                        <select class="cus-select margin-T-5" data-container="body" id="church_category_id" onchange="select_church(this.value)">
                                            <option value="">Select Type</option>
                                            <?php if(!empty($church)){

                                            	foreach ($church as  $value) {
                                            		 if($value->category =='2'){ ?>
                                                <option value="<?php echo $value->biller_category_id;?>">
                                                    <?php echo $value->biller_category_name; ?>
                                                </option>
                                                <?php	}
												}
                                            } ?>

                                        </select>
                                        <input type="hidden" id="biller_category_id" value="">
                                          <span id="church_type_error"></span>
                                    </div>
                                    <div class="col-sm-6 selectop">
                                        <select class="cus-select" data-container="body" id="church_id" onchange="select_church_area(this.value)">
                                            <option value="">Select Church</option>

                                        </select>
                                        <input type="hidden" id="church_selectedid" value="">
                                        <input type="hidden" id="church_selected_id" value="">
                                        <input type="hidden" id="church_biller_id" value="">
                                         <span id="church_select_error"></span>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <div class="col-sm-6 selectop">
                                        <select class="cus-select" id="church_area" data-container="body" onchange="select_church_products(this.value)">
                                            <option value="">Select Area</option>

                                        </select>
                                        <span id="church_area_error"></span>
                                    </div>
                                    <div class="col-sm-6 selectop">
                                        <select class="cus-select" id="church_donation_price" data-container="body" onchange="select_church_service(this.value)">
                                            <option value="">Select Services</option>

                                        </select>
                                         <span id="church_service_error"></span>
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control margin-T-5 normal-input" placeholder="Service" id="church_price"  onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                        <div class="icn"> </div>
                                        <span id="error_church_donation"></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <!--<button class="gray-btn btn quarter-width margin-T-5" data-toggle="modal" data-target="#viewPlanDTH"> View plan </button>-->
                                        <button class="blue-btn btn quarter-width margin-T-5" onclick="church_donation(1)"> Pay now </button>
                                        <?php if(isset($isLogin) && $isLogin == false) { ?>
                                         <button class="brown-btn btn quarter-width margin-T-5" onclick="church_donation(2)" >Quick  Pay</button>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="events" class="tab-pane">
                            <div class="frmnwrp">
                                <div class="form-group mo-m-o clearfix">
                                    <div class="col-sm-6">
                                        <select class="selectpicker margin-T-5" data-container="body" id="event_category_id" onchange="get_event_list(this.value)">
                                            <option>Select Event Category</option>
                                            <?php if(!empty($event_category)){

                                            	foreach ($event_category as  $val) {  ?>

                                                <option value="<?php echo $val->biller_category_id;?>">
                                                    <?php echo $val->biller_category_name; ?>
                                                </option>
                                                <?php	
												}
                                            } ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-6 selectop1">
                                        <!-- <option data-toggle="modal" data-target="#eventDetailModal" data-target=".bd-example-modal-lg">Event 1</option> -->
                                        <select class="margin-T-5 cus-select" data-container="body" id="event_id" onchange="select_event(this.value)">
                                            <option value="0">Select Event</option>

                                        </select>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="quickpay" class="modal fade quickp" role="dialog">
		  <div class="modal-dialog modal-sm" style="background: #fff">

		    <!-- Modal content-->
		    <div class="modal-conquickpaytent">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Quick  Pay</h4>
		      </div>
		      <div class="modal-body">
		        <form>
	        	 	<div class="form-group">
				    	<label for="exampleInputPassword1">Mobile No.</label>
				    	<input type="text" class="form-control" id="guest_user_mobile" placeholder="Mobile No.">
				    	 <div class="d">
                                <span id="guest_mobile_error"></span>
                          </div>
				  	</div>
				  	<div class="form-group">
				    	<label for="exampleInputPassword1">Email Id</label>
				    	<input type="email" class="form-control" id="guest_user_email" placeholder="Email Id">
				    	 <div class="d">
                                <span id="guest_email_error"></span>
                          </div>
				  	</div>
		        </form>
		      </div>
		      <div class="modal-footer">
		        <button class="brown-btn btn margin-T-5" onclick="guest_user_signup()" >Quick Pay</button>


		      	<!-- <a href="<?php echo site_url('web/quick_pay');?>" class="btn blue-btn" >Submit</a>
		        --> <button type="button" class="btn gray-btn" data-dismiss="modal">Close</button>
		      </div>
		    </div>

		  </div>
</div>
                <div class="col-sm-4 col-xs-12 hidden-xs visible-md visible-lg visible-sm">
                    <div class="content-slider-right">
                        <div class="owl-carousel owl-theme">
                            <div class="item">
                                <h4><span>GET UP TO 50%</span> OF YOUR SPENDINGS BACK</h4></div>
                            <div class="item">
                                <h4>SAVE MORE THAN YOU SPEND</h4></div>
                            <div class="item">
                                <h4>GET REWARDED EACH TIME YOU SPEND</h4></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   <!--  <section id="downloadapp" class="download-wrap">
        <div class="container">

        <?php if($this->session->flashdata('payment_msg')){

                    echo $this->session->flashdata('payment_msg');

        } ?>

            <div class="col-sm-4">
                <img src="<?php echo base_url('wassets/images/app_screen.png');?>" class="img-responsive center-block">
            </div>
            <div class="col-sm-7 col-md-6  col-sm-offset-1 col-md-offset-2 col-xs-offset-0">
                <div class="download-app-text">
                    <h1> Available on iOS and Android </h1>
                    <span> OyaCharge is available for download on the Google 
                  Playstore and AppStore. It is lightweight and very easy to install. </span>
                    <a href="https://itunes.apple.com/ng/app/oyacharge/id1173501594" class="btn btn-download">
                        <i class="fa fa-apple"> </i>
                        <small>Download on the </small>
                        <h3> App Store </h3>
                    </a>
                    <a href="https://play.google.com/store/search?q=oyacharge&hl=en" class="btn btn-download">
                        <i class="fa fa-android"> </i>
                        <small>Get it on</small>
                        <h3> Google Play</h3>
                    </a>
                </div>
            </div>
        </div>
    </section>-->
    <section id="chooseplan" class="choose-plan-wrap">
        <div class="container">
            <div class="section-title">
                <p>NEED HELP TO CHOOSING A PLAN?</p>
                <p> Our <span>[Service Selector]</span> can help you find the right plan for you.
                </p>
                 
            </div>
            <div class="row">
                <div id="owl-demo" class="owl-carousel owl-theme">
                    <div class="item">
                        <div class="customers">
                            <div class="customers-s"> <img src="<?php echo base_url('wassets/images/slide_rip_01.png');?>"></div>
                            <div class="customers-outer-1"></div>
                            <div class="customers-outer-2"></div>
                            <div class="customers-inner customers-inner1">
                                <div class="slide_title">Mobile Recharge </div>
                                <div class="customers-content">
                                    <p>Recharge your phone and buy data in just a click away. Get special rewards that include cashback and exciting coupons with you use our instant recharge app. It doesn't get much better than OyaCharge!</p>
                                </div>
                                <div class="customers-meta"> <a href="#">Get Plans & Offers </a> </div>
                            </div>
                            <div class="customers-outer-3"></div>
                            <div class="customers-outer-4"></div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="customers">
                            <div class="customers-s"> <img src="<?php echo base_url('wassets/images/slide_rip_02.png');?>"></div>
                            <div class="customers-outer-1"></div>
                            <div class="customers-outer-2"></div>
                            <div class="customers-inner customers-inner2">
                                <div class="slide_title">TV Recharge </div>
                                <div class="customers-content">
                                    <p>Conveniently pay your GOTV and DSTV subscription without hassles. Get it done simple, secure and quick with OyaCharge and get special rewards that include cashback and exciting coupons with you pay. It doesn't get much better than OyaCharge!</p>
                                </div>
                                <div class="customers-meta"> <a href="#">Get Plans & Offers </a> </div>
                            </div>
                            <div class="customers-outer-3"></div>
                            <div class="customers-outer-4"></div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="customers">
                            <div class="customers-s"> <img src="<?php echo base_url('wassets/images/slide_rip_03.png');?>"> </div>
                            <div class="customers-outer-1"></div>
                            <div class="customers-outer-2"></div>
                            <div class="customers-inner customers-inner3">
                                <div class="slide_title">Data Recharge </div>
                                <div class="customers-content">
                                    <p>Conveniently pay your GOTV and DSTV subscription without hassles. Get it done simple, secure and quick with OyaCharge and get special rewards that include cashback and exciting coupons with you pay. It doesn't get much better than OyaCharge!</p>
                                </div>
                                <div class="customers-meta"> <a href="#">Get Plans & Offers </a> </div>
                            </div>
                            <div class="customers-outer-3"></div>
                            <div class="customers-outer-4"></div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="customers">
                            <div class="customers-s"> <img src="<?php echo base_url('wassets/images/slide_rip_04.png');?>"> </div>
                            <div class="customers-outer-1"></div>
                            <div class="customers-outer-2"></div>
                            <div class="customers-inner customers-inner4">
                                <div class="slide_title">Electricity Recharge</div>
                                <div class="customers-content">
                                    <p>Recharge your phone and buy data in just a click away. Get special rewards that include cashback and exciting coupons with you use our instant recharge app. It doesn't get much better than OyaCharge!</p>
                                </div>
                                <div class="customers-meta"> <a href="#">Get Plans & Offers </a> </div>
                            </div>
                            <div class="customers-outer-3"></div>
                            <div class="customers-outer-4"></div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="customers">
                            <div class="customers-s"> <img src="<?php echo base_url('wassets/images/slide_rip_05.png');?>"> </div>
                            <div class="customers-outer-1"></div>
                            <div class="customers-outer-2"></div>
                            <div class="customers-inner customers-inner5">
                                <div class="slide_title">Offring Recharge</div>
                                <div class="customers-content">
                                    <p>Conveniently pay your GOTV and DSTV subscription without hassles. Get it done simple, secure and quick with OyaCharge and get special rewards that include cashback and exciting coupons with you pay. It doesn't get much better than OyaCharge!</p>
                                </div>
                                <div class="customers-meta"> <a href="#">Get Plans & Offers </a> </div>
                            </div>
                            <div class="customers-outer-3"></div>
                            <div class="customers-outer-4"></div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="customers">
                            <div class="customers-s"> <img src="<?php echo base_url('wassets/images/slide_rip_06.png');?>"> </div>
                            <div class="customers-outer-1"></div>
                            <div class="customers-outer-2"></div>
                            <div class="customers-inner customers-inner6">
                                <div class="slide_title">Biller</div>
                                <div class="customers-content">
                                    <p>Make your data recharges and top up your connection on the go. Instantly recharge your MTN, Airtel, Etisalat, Glo, Swift, Smile, Spectranet, Cobranet and Ntel subscription without hassles and get special rewards that include cashback and exciting coupon. It doesn't get much better than OyaCharge!</p>
                                </div>
                                <div class="customers-meta"> <a href="#">Get Plans & Offers </a> </div>
                            </div>
                            <div class="customers-outer-3"></div>
                            <div class="customers-outer-4"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>  
    <section class="section bg-light shadow-md pt-4 pb-3">
      <div class="container">
        <div class="row">
          <div class="col-sm-6 col-md-3">
            <div class="featured-box text-center">
              <div class="featured-box-icon"> <i class="fa fa-lock"></i> </div>
              <h4>100% Secure Payments</h4>
              <p>Moving your card details to a much more secured place.</p>
            </div>
          </div>
          <div class="col-sm-6 col-md-3">
            <div class="featured-box text-center">
              <div class="featured-box-icon"> <i class="fa fa-thumbs-up"></i> </div>
              <h4>Trust pay</h4>
              <p>100% Payment Protection. Easy Return Policy.</p>
            </div>
          </div>
          <div class="col-sm-6 col-md-3">
            <div class="featured-box text-center">
              <div class="featured-box-icon"> <i class="fa fa-bullhorn"></i> </div>
              <h4>Refer &amp; Earn</h4>
              <p>Invite a friend to sign up and earn up to &#8358; 5.</p>
            </div>
          </div>
          <div class="col-sm-6 col-md-3">
            <div class="featured-box text-center">
              <div class="featured-box-icon"> <i class="fa fa-life-ring"></i> </div>
              <h4>24X7 Support</h4>
              <p>We're here to help. Have a query and need help ? <a href="#">Click here</a></p>
            </div>
          </div>
        </div>
      </div>
    </section>
   <!-- <section id="featureswrap" class="features_wrap">
        <div class="container-fluid">
            <div class="col-sm-6 features-left">
                <div class="features-inner">
                    <div class="feat_title">
                        Share OUR APP to your friend and get chance to earn.
                    </div>
                    <?php if($recharge_content){
                      echo $recharge_content[0]->share_app_content;
                    }  ?>
                        <figure> <img src="<?php echo base_url('wassets/images/feature_img.png');?>" class="img-responsive center-block"> </figure>
                </div>
            </div>
            <div class="col-sm-6 features-right">
                <div class="features-inner">
                    <div class="feat_title">
                        Recharge Video
                        <small> This is the content block for about us section. </small>
                    </div>
                    <div class="spatidar">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/DhW9wRjVNOs?autoplay=1&rel=0&hd=1" frameborder="0" allowfullscreen></iframe>
                    </div>
                    <!-- <div class="video-frame">
                        <iframe width="100%" height="208px" src="<?php echo $about_details[0]->about_us_video; ?>?autoplay=1&rel=0&hd=1" frameborder="0" allowfullscreen> </iframe>
                        <!--
                     <div class="play_btn">
                                            <i class="fa fa-youtube-play"> </i> 
                                         </div>--

                    </div> -->
                </div>
            </div>
        </div>
    </section>
    
    
   
    </div>
    
   

   