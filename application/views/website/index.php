<div class="img-background"></div>
<input type="hidden" id="plan_dynamic_id" value="">

<div class="modal fade bs-example-modal-sm" id="mobile_operator" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" data-backdrop="false">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
       <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h5 class="modal-title" id="gridSystemModalLabel">Select Operator</h5>
      </div>
      <div class="body">
      	<ul>
      		
      		  <?php if(!empty($footer)){
      		  
                        $i=0;
                        foreach ($footer as  $value) {
                        if($value->recharge_category_id =='1'){ ?>
        	<li>
                <label data-dismiss="modal" aria-label="Close">
                    <img onclick="select_mobile_operator('<?php echo $value->operator_id;?>','<?php echo $value->operator_name; ?>')" src="<?php echo  base_url('uploads/operator').'/'.$value->operator_image; ?>" alt="..."/ >
                    <input type="radio" class="operatorRadio"/>
                </label>
            </li>
            <?php   }
                            $i++;
                            }
                        } ?>
                        <input type="hidden" id="mobile_operator_id" value="">
        </ul>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bs-example-modal-sm" id="dth_operator" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" data-backdrop="false">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
       <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h5 class="modal-title" id="gridSystemModalLabel">Select Operator</h5>
      </div>
      <div class="body">
      	<ul>
      		  <?php if(!empty($footer)){
                        $i=0;
                        foreach ($footer as  $value) {
                        if($value->recharge_category_id =='2'){ ?>
        	<li>
                <label data-dismiss="modal" aria-label="Close">
                    <img onclick="select_dth_operator('<?php echo $value->operator_id;?>','<?php echo $value->operator_name; ?>')" src="<?php echo  base_url('uploads/operator').'/'.$value->operator_image; ?>" alt="..."/>
                    <input type="radio" class="operatorRadio" />
                </label>
            </li>
            <?php   }
                            $i++;
                            }
                        } ?>
                         <input type="hidden"  id="dth_operator_id" value="">
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="modal fade bs-example-modal-sm" id="datacard_operator" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" data-backdrop="false">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
       <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h5 class="modal-title" id="gridSystemModalLabel">Select Operator</h5>
      </div>
      <div class="body">
      	<ul>
      		  <?php if(!empty($footer)){
                        $i=0;
                        foreach ($footer as  $value) {
                        if($value->recharge_category_id =='3'){ ?>
        	<li>
                <label data-dismiss="modal" aria-label="Close">
                    <img onclick="select_datacard_operator('<?php echo $value->operator_id;?>','<?php echo $value->operator_name; ?>')" src="<?php echo  base_url('uploads/operator').'/'.$value->operator_image; ?>" alt="..." title="<?php echo $value->operator_name; ?>"/>
                    <input type="radio" class="operatorRadio" />
                </label>
            </li>
            <?php   }
                            $i++;
                            }
                        } ?>
                              <input type="hidden"  id="datacard_operator_id" value="">
        </ul>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bs-example-modal-sm" id="electricity_operator" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" data-backdrop="false">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
       <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h5 class="modal-title" id="gridSystemModalLabel">Select Operator</h5>
      </div>
      <div class="bo<div class="img-background"></div>dy">
      	<ul>
      		  <?php if(!empty($footer)){
                        $i=0;
                        foreach ($footer as  $value) {
                        if($value->recharge_category_id =='4'){ ?>
        	<li>
                <label data-dismiss="modal" aria-label="Close">
                    <img onclick="select_electricty_operator('<?php echo $value->operator_id;?>','<?php echo $value->operator_name; ?>')" src="<?php echo  base_url('uploads/operator').'/'.$value->operator_image; ?>" title="<?php echo $value->operator_name; ?>"/>
                    <input type="radio" class="operatorRadio" />
                </label>
            </li>
            <?php   }
                            $i++;
                            }
                        } ?>
                              <input type="hidden"  id="electricty_operator_id" value="">
        </ul>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bs-example-modal-sm" id="biller_category" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" data-backdrop="false">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
       <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h5 class="modal-title" id="gridSystemModalLabel">Select Biller Category</h5>
      </div>
      <div class="body">
      	<ul>
      		   <?php if(!empty($biller_category)){
                        $i=0;
                        foreach ($biller_category as  $value) {
                         ?>
        	<li>
                <label data-dismiss="modal" aria-label="Close">
                    <img style="cursor:pointer" width="100%" onclick="select_biller_category('<?php echo $value->biller_category_id;?>','<?php echo $value->biller_category_name; ?>')" src="<?php echo  base_url('uploads/biller_category_logo').'/'.$value->biller_category_logo; ?>" alt="..."/ >
                    <input type="radio" class="operatorRadio"/>
                </label>
            </li>
            <?php   
                            $i++;
                            }
                        } ?>
                        <input type="hidden"  id="biller_category_id" value="">
        </ul>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bs-example-modal-sm" id="churchtype_model" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" data-backdrop="false">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
       <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h5 class="modal-title" id="gridSystemModalLabel">Select Church Type</h5>
      </div>
      <div class="body">
      	<ul>
      		
      		  <?php if(!empty($church)){
      		  
                        $i=0;
                        foreach ($church as  $value) {
                        if($value->category =='2'){ ?>
        	<li>
                <label data-dismiss="modal" aria-label="Close">
                    <img style="cursor: pointer" width="70" height="70" class="img-circle" onclick="select_church_type('<?php echo $value->biller_category_id;?>','<?php echo $value->biller_category_name; ?>')" src="<?php echo  base_url('uploads/biller_category_logo').'/'.$value->biller_category_logo; ?>" alt="..." title="<?php echo $value->biller_category_name; ?>"/ >
                    <input type="radio" class="operatorRadio"/>
                </label>
            </li>
            <?php   }
                            $i++;
                            }
                        } ?>
                        <input type="hidden" id="church_category_id" value="">
        </ul>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bs-example-modal-sm" id="select_church_model" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" data-backdrop="false">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
       <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h5 class="modal-title" id="gridSystemModalLabel">Select Church Type</h5>
      </div>
      <div class="body">
      	<ul>
      		<div id="church_final_list_id">
        
		</div>
           <input type="hidden" id="church_selected_id" value="">
             <input type="hidden" id="church_biller_id" value="">
        </ul>
      </div>
    </div>
  </div>
</div>
<!--- Event popup-->
<div class="modal fade bs-example-modal-sm" id="eventtype_model" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" data-backdrop="false">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
       <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h5 class="modal-title" id="gridSystemModalLabel">Select Event Type</h5>
      </div>
      <div class="body">
      	<ul>
      		
      		  <?php if(!empty($event_category)){
      		  
                        $i=0;
                        foreach ($event_category as  $value) {
                        if($value->category =='3'){ ?>
        	<li>
                <label data-dismiss="modal" aria-label="Close">
                    <img style="cursor: pointer" width="70" height="70" class="img-circle" onclick="select_event_type('<?php echo $value->biller_category_id;?>','<?php echo $value->biller_category_name; ?>')" src="<?php echo  base_url('uploads/biller_category_logo').'/'.$value->biller_category_logo; ?>" alt="..." title="<?php echo $value->biller_category_name; ?>"/ >
                    <input type="radio" class="operatorRadio"/>
                </label>
            </li>
            <?php   }
                            $i++;
                            }
                        } ?>
                        <input type="hidden" id="event_category_id" value="">
        </ul>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bs-example-modal-sm" id="select_event" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" data-backdrop="false">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
       <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h5 class="modal-title" id="gridSystemModalLabel">Select Event</h5>
      </div>
      <div class="body">
      	<ul>
      		<div id="event_final_list_id">
        
		</div>
           <input type="hidden" id="event_selected_id" value="">
             <input type="hidden" id="event_biller_id" value="">
        </ul>
      </div>
    </div>
  </div>
</div>
<!--event details-->
<div class="modal fade bs-example-modal-sm" id="event_details" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" data-backdrop="false">
 
</div>
<!--End event popup-->
<div id="service_provider" class="modal fade bs-example-modal-sm" id="service_provider" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" data-backdrop="false">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
       <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h5 class="modal-title" id="gridSystemModalLabel">Service provider</h5>
      </div>
      <div class="body" >
      	<ul>
      	<div id="service_provider_list123">
        
		</div>
          <input type="hidden"  id="biller_service_provider_id" value="">
        </ul>
      </div>
    </div>
  </div>
</div>


 
        <div class="col-sm-12 col-xs-12">
            <div id="mainSlider" class="carousel slide" data-ride="carousel">
              <!-- Indicators -->
              <div class="caption-indicator-holder">
                  <a class="left carousel-control" href="#mainSlider" role="button" data-slide="prev">
                    <img src="<?php echo base_url(); ?>webassets/images/right-slide-arrow.png" alt="..."/>
                  </a>
                  <ol class="carousel-indicators">
                    <li data-target="#mainSlider" data-slide-to="0" class="active"></li>
                    <li data-target="#mainSlider" data-slide-to="1"></li>
                    <li data-target="#mainSlider" data-slide-to="2"></li>
                  </ol>
                  <a class="right carousel-control" href="#mainSlider" role="button" data-slide="next">
                   <img src="<?php echo base_url(); ?>webassets/images/left-slide-arrow.png" alt="..."/>
                  </a>
              </div>
              <!-- Wrapper for slides -->
              <div class="carousel-inner" role="listbox">
                <div class="item active">
                  <div class="carousel-caption">
                    <h1><?php if($main_content){
                    	echo $main_content[0]->slider1_heading;
                    } ?></h1>
                    <p><?php if($main_content){
                    	echo $main_content[0]->slider1;
                    }  ?></p>
                  </div>
                </div>
                <div class="item">
                  <div class="carousel-caption">
                    <h1><?php if($main_content){
                    	echo $main_content[0]->slider2_heading;
                    } ?></h1>
                    <p><?php if($main_content){
                    	echo $main_content[0]->slider2;
                    }  ?></p>
                  </div>
                </div>
                <div class="item">
                  <div class="carousel-caption">
                    <h1><?php if($main_content){
                    	echo $main_content[0]->slider3_heading;
                    } ?></h1>
                    <p><?php if($main_content){
                    	echo $main_content[0]->slider3;
                    }  ?></p>
                  </div>
                </div>
              </div>
            
              <!-- Controls -->
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-12 text-right form-group">
        <a href="https://play.google.com/store/search?q=oyacharge&hl=en">
          <img width="90" alt="..." src="<?php echo base_url(); ?>webassets/images/android.png">
        </a>
        <a href="https://itunes.apple.com/ng/app/oyacharge/id1173501594">
          <img  width="90" alt="..." src="<?php echo base_url(); ?>webassets/images/app.png">
        </a>
        </div>
        <div class="clearfix"></div>
</div>

<div id="mRechargeSlider" class="recharge-fields carousel slide" data-ride="carousel">
	<div  class="close-pop-field"><i class="fa fa-close" onclick="close_popup_field()"></i></div>
    <ol class="carousel-indicators">
        <li id="firstc" data-slide-to="0" class="active"></li>
        <li data-slide-to="1"></li>
        <li data-slide-to="2"></li>
        <li data-slide-to="5"></li>
    </ol>
	<div class="clearfix"></div>
    <div class="carousel-inner" role="listbox">
        <div class="item active" id="m">
            <h3>Enter your Mobile number</h3>
            <div class="recharge-form-inline">
                <div class="text-input">
                	<div class="form-inline">
                    	<!--<div class="form-group countrycode">+234</div>-->
                        <div class="form-group">
                    	<input type="number" placeholder="Enter Mobile Number" id="mobile" value="" autocomplete="off">
                        </div>
                	</div>
                    <div class="clearfix"></div>
                    <p id="num_error" style="color: red"></p>
                </div>
            </div>
        </div>
        <div class="item">
            <h3>Prepaid or Postpaid?</h3>
            <div class="recharge-form-inline">
                <div class="text-input">
                    <label class="radio-style-box radio-inline active">
                    	<div class="radio-style"></div>
                    	<input type="radio" name="radio" id="prepaid" value="1" > <span>Prepaid</span>
                    </label>
                    <label class="radio-style-box  radio-inline">
                    	<div class="radio-style"></div>
                    	<input type="radio" name="radio" id="prepaid" value="2"> <span>Postpaid</span>
                    </label>
                </div>
            </div>
        </div>
        <div class="item">
        	<h3>Which operator?</h3>
        	<div class="recharge-form-inline">
        		<div class="text-input">
        			<div class="select" data-toggle="modal" data-target="#mobile_operator" ><span id="mobile_operator_name"> Select Operator</span></div>
       			 </div>
        	</div>
        </div>
        <div class="item">
            <h3>How much to recharge?</h3>
            <div class="recharge-form-inline">
            	<div class="text-input rupee">
            		<input type="number" placeholder="₦" id="mobile_amount" value="">
            		<input type="hidden" id="rec_category" value="">
            		     <p id="amount_error" class="error_msg"></p>
            	</div>
            	<div class="plan">
            		<a href="#" onclick="recharge_plan()">View Plans</a>
            	</div>
            </div>
        </div>
    </div>
    <div class="button-holder">
    <a class="button-prev" href="#mRechargeSlider" role="button" data-slide="prev" id="preview_recharge" onclick="back_mobile_prev()">Prev</a>
    <a class="button-next" href="#mRechargeSlider" role="button" data-slide="next" id="next_recharge" onclick="show_preview()" >Next</a>
    </div>
</div>
<!----------- mobile recharge ------------>  
  
<div id="tvRechargeSlider" class="recharge-fields carousel slide" data-ride="carousel">
<div  class="close-pop-field"><i class="fa fa-close" onclick="close_popup_field()"></i></div>
<ol class="carousel-indicators">
    <li data-target="#tvRechargeSlider" data-slide-to="0" class="active"></li>
    <li data-target="#tvRechargeSlider" data-slide-to="1"></li>
    <li data-target="#tvRechargeSlider" data-slide-to="2"></li>
</ol>
<div class="clearfix"></div>
<div class="carousel-inner" role="listbox">
	   <div class="item active">
         <h3>Pay your DTH bill. Which operator?</h3>
         <div class="recharge-form-inline widthoperator">
            <div class="text-input">
                <div class="select" data-toggle="modal" data-target="#dth_operator"> <span id="dth_operator_name"> Select Operator</span></div>
            </div>
        </div>
    </div>
    <div class="item ">
         <h3>What's your DTH Number?</h3>
         <div class="recharge-form-inline">
            <div class="text-input">
                <input type="number" placeholder="Enter DTH Number" id="tv_number" value="" autocomplete="off">
                  <p id="tv_num_error" class="error_msg"></p>
            </div>
        </div>
    </div>
  <div class="item ">
         <h3>Name</h3>
         <div class="recharge-form-inline">
            <div class="text-input">
                <input type="text" id="tv_number_name" value="" autocomplete="off">
                  <input type="hidden" id="service_id" value="">
            </div>
        </div>
    </div>
    
    <div class="item">
         <h3>How much to recharge?</h3>
         <div class="recharge-form-inline">
            <div class="text-input rupee ">
                <input type="number" placeholder="₦" id="tv_rec_amount" autocomplete="off" readonly="">
                <input type="hidden" id="rec_category" value="">
                <input type="hidden" id="tv_rec_code" value="">
                 <input type="hidden" id="tv_new_number" value="">
            </div>
            	<div class="plan">
            		<a href="#" onclick="plan_list()">View Plans</a>
            	</div>
           
        </div>
    </div>
</div>
<div class="button-holder">
    <a class="button-prev" href="#tvRechargeSlider" role="button" data-slide="prev" id="tv_prev" onclick="tv_prev_btn()">Prev</a>
    <a class="button-next" href="#tvRechargeSlider" role="button" data-slide="next" id="tv_next" onclick="show_tv_prev()">Next</a>
</div>
</div>  
<!----------- tv recharge ------------> 

<div id="dataRechargeSlider" class="recharge-fields carousel slide" data-ride="carousel">
<div  class="close-pop-field"><i class="fa fa-close" onclick="close_popup_field()"></i></div>
<ol class="carousel-indicators">
    <li id="myLi" data-target="#dataRechargeSlider" data-slide-to="0" class="active"></li>
    <li data-target="#dataRechargeSlider" data-slide-to="1"></li>
    <li data-target="#dataRechargeSlider" data-slide-to="2"></li>
    <li data-target="#dataRechargeSlider" data-slide-to="3" class=""></li>
</ol>

<div class="clearfix"></div>
<div class="carousel-inner" role="listbox">
	<div class="item active">
         <h3>Which operator?</h3>
         <div class="recharge-form-inline">
            <div class="text-input">
               <div class="select" data-toggle="modal" data-target="#datacard_operator">  <span id="datacard_operator_name"> Select Operator</span></div>
            </div>
        </div>
    </div>
   <!-- <div class="item">
         <h3>Prepaid or Postpaid?</h3>
         <div class="recharge-form-inline">
            <div class="text-input">
                <label class="radio-style-box radio-inline active">
                    <div class="radio-style"></div>
                    <input type="radio" name="radio"  id="data_prepaid" value="1" > <span>Prepaid</span>
                </label>
                <label class="radio-style-box  radio-inline">
                    <div class="radio-style"></div>
                    <input type="radio" name="radio"  id="data_prepaid" value="2" > <span>Postpaid</span>
                </label>
            </div>
        </div>
   </div>-->
    <div class="item ">
        <h3>Enter your datacard number</h3>
        <div class="recharge-form-inline">
            <div class="text-input">
                <input type="text" placeholder="Enter Number" id="data_card_number" value="">
                 <p id="data_num_error" class="error_msg"></p>
            </div>
        </div>
    </div>
 <div class="item ">
        <h3>Smartcard number name</h3>
        <div class="recharge-form-inline">
            <div class="text-input">
                <input type="text"  id="data_card_number_name12" value="">
                 
            </div>
        </div>
    </div>

    <div class="item">
        <h3>How much to recharge?</h3>
        <div class="recharge-form-inline">
            <div class="text-input rupee">
                <input type="number" placeholder="₦" id="datacard_amount">
                <input type="hidden" placeholder="₦" id="datacard_typecode">
            </div>
            <div class="plan" id="plan_div">
                <a  onclick="data_plan()">View Plans</a>
            </div>
        </div>
    </div>
</div>
<div class="button-holder">
    <a class="button-prev" href="#dataRechargeSlider" role="button" data-slide="prev" id="datacard_prev" onclick="datacard_prev_btn()">Prev</a>
    <a class="button-next" href="#dataRechargeSlider" role="button" data-slide="next" id="datacard_next" onclick="show_data_prev()">Next</a>
</div>
</div>
<!---------End-- data recharge ------------> 
<!-- -------  Electricity Recharge --------------->
<div id="electricityRechargeSlider" class="recharge-fields carousel slide" data-ride="carousel">
<div  class="close-pop-field"><i class="fa fa-close" onclick="close_popup_field()"></i></div>
<ol class="carousel-indicators">
    <li id="myLi" data-target="#electricityRechargeSlider" data-slide-to="0" class="active"></li>
    <li data-target="#electricityRechargeSlider" data-slide-to="1"></li>
    <li data-target="#electricityRechargeSlider" data-slide-to="2"></li>
     <li data-target="#electricityRechargeSlider" data-slide-to="3"></li>
   
</ol>

<div class="clearfix"></div>
<div class="carousel-inner" role="listbox">
	<div class="item active">
         <h3>Which operator?</h3>
         <div class="recharge-form-inline">
            <div class="text-input">
               <div class="select" data-toggle="modal" data-target="#electricity_operator">  <span id="electricity_operator_name"> Select Operator</span></div>
            </div>
        </div>
    </div>
    <div class="item ">
        <h3>Enter your Meter Number</h3>
        <div class="recharge-form-inline">
            <div class="text-input">
                <input type="text" placeholder="Enter Number" id="electric_card_number" value="" onblur="check_electric_number(this.value)" autocomplete="off">
                 <p id="" class="error_msg"><span id="ele_num_error"></span></p>
            </div>
        </div>
    </div>
     <div class="item ">
        <h3>Customer Name</h3>
        <div class="recharge-form-inline">
            <div class="text-input">
                <input type="text" placeholder="" id="customer_name" value="" autocomplete="off">
                
            </div>
        </div>
    </div>
    <div class="item ">
        <h3>Enter amount</h3>
        <div class="recharge-form-inline">
            <div class="text-input">
                <input type="number" placeholder="Enter amount" id="electrice_amount" autocomplete="off">
                 <p id="data_num_error1" class="error_msg"></p>
            </div>
        </div>
    </div>
</div>
<div class="button-holder">
    <a class="button-prev" href="#electricityRechargeSlider" role="button" data-slide="prev" id="electricity_prev">Prev</a>
    <a class="button-next" href="#electricityRechargeSlider" role="button" data-slide="next" id="electricity_next" onclick="show_electricity_prev()">Next</a>
</div>
</div>
<!-- ----End---  Electricity Recharge --------------->

<!-- -------  Electricity Recharge --------------->
<div id="tollRechargeSlider" class="recharge-fields carousel slide" data-ride="carousel">
<div  class="close-pop-field"><i class="fa fa-close" onclick="close_popup_field()"></i></div>
<ol class="carousel-indicators">
    <li id="myLi" data-target="#tollRechargeSlider" data-slide-to="0" class="active"></li>
    <li data-target="#tollRechargeSlider" data-slide-to="1"></li>
    <li data-target="#tollRechargeSlider" data-slide-to="2"></li>
    <li data-target="#tollRechargeSlider" data-slide-to="3" class=""></li>
</ol>

<div class="clearfix"></div>
<div class="carousel-inner" role="listbox">
	<div class="item active">
      <div class="recharge-form-inline">
      	 <h3>Church Donate</h3>
            <div class="text-input">
               <div class="recharge-form-inline">
            <div class="text-input">
               <div class="select" data-toggle="modal" data-target="#churchtype_model">  <span id="church_type"> Select Church Type</span></div>
            </div>
        </div>
            </div>
        </div>
    </div>
   
    <div class="item">
         <h3>Select Church</h3>
         <div class="recharge-form-inline">
            <div class="text-input">
               <div class="select" onclick="select_church()">  <span id="select_church_name"> Select church</span></div>
            </div>
        </div>
    </div>
        <div class="item">
         <h3>Select Service</h3>
         <div class="recharge-form-inline">
            <div class="text-input">
             <select class="select" id="church_donation_price" onchange="select_church_price(this.value)">
                    
                  
                </select>
                <input type="hidden" name="church_p_id" id="church_p_id" value="">
            </div>
        </div>
    </div>

    <div class="item">
        <h3>Price</h3>
        <div class="recharge-form-inline">
            <div class="text-input rupee">
                <input type="text" id="church_price" value="">
            </div>
           
        </div>
    </div>
</div>
<div class="button-holder">
    <a class="button-prev" href="#tollRechargeSlider" role="button" data-slide="prev" id="event_prev" onclick="select_church_prev()">Prev</a>
    <a class="button-next" href="#tollRechargeSlider" role="button" data-slide="next" id="event_next" onclick="show_church_next()">Next</a>
</div>
</div>
<br />

<!-- -------  Event Recharge --------------->
<div id="event_rec" class="recharge-fields carousel slide" data-ride="carousel">
<div  class="close-pop-field"><i class="fa fa-close" onclick="close_popup_field()"></i></div>
<ol class="carousel-indicators">
    <li id="myLi" data-target="#event_rec" data-slide-to="0" class="active"></li>
    <li data-target="#event_rec" data-slide-to="1"></li>
   <!-- <li data-target="#event_rec" data-slide-to="2"></li>
    <li data-target="#event_rec" data-slide-to="3" class=""></li>-->
</ol>

<div class="clearfix"></div>
<div class="carousel-inner" role="listbox">
	<div class="item active">
      <div class="recharge-form-inline">
      	 <h3>Event Category</h3>
            <div class="text-input">
               <div class="recharge-form-inline">
            <div class="text-input">
               <div class="select" data-toggle="modal" data-target="#eventtype_model">  <span id="event_type"> Select Event Type</span></div>
            </div>
        </div>
            </div>
        </div>
    </div>
   
    <div class="item">
         <h3>Select Event</h3>
         <div class="recharge-form-inline">
            <div class="text-input">
               <div class="select" onclick="select_event()">  <span id="select_event_name"> Select Event</span></div>
            </div>
        </div>
    </div>
      <!--  <div class="item">
         <h3>Select Service</h3>
         <div class="recharge-form-inline">
            <div class="text-input">
             <select class="select" id="church_donation_price" onchange="select_church_price(this.value)">
                    
                  
                </select>
                <input type="hidden" name="church_p_id" id="church_p_id" value="">
            </div>
        </div>
    </div>

    <div class="item">
        <h3>Price</h3>
        <div class="recharge-form-inline">
            <div class="text-input rupee">
                <input type="text" id="church_price" value="">
            </div>
           
        </div>
    </div>-->
</div>
<div class="button-holder">
    <a class="button-prev" href="#event_rec" role="button" data-slide="prev" id="event_prev" >Prev</a>
    <a class="button-next" href="#event_rec" role="button" data-slide="next" id="church_next" >Next</a>
</div>
</div>
</div>
<!-- ----End---  Toll Recharge --------------->

<!-- -------  Biller Recharge --------------->
<div id="billerRechargeSlider" class="recharge-fields carousel slide" data-ride="carousel">
<div  class="close-pop-field"><i class="fa fa-close" onclick="close_popup_field()"></i></div>
<!--ol class="carousel-indicators">
    <li id="myLi" data-target="#billerRechargeSlider" data-slide-to="0" class="active"></li>
    <li data-target="#billerRechargeSlider" data-slide-to="1"></li>
    <li data-target="#billerRechargeSlider" data-slide-to="2"></li>
    <li data-target="#billerRechargeSlider" data-slide-to="3" class=""></li>
</ol-->

<div class="clearfix"></div>
<div class="carousel-inner" role="listbox">
	<div class="item active">
      <div class="recharge-form-inline">
      	 <h3>Pay your bill</h3>
            <div class="text-input pull-left width50">
        			<div style="cursor:pointer" class="select" onclick="show_biller_category()" id="id_biller"><span id="biller_category_name"> Select Category</span></div>
       	   </div>
            <div class="text-input pull-right width50">
             <div style="cursor:pointer" class="select operator"  onclick="show_service_provider()" id="id_service"><span id="service_provider_name">Service Provider</span></div>
           </div>
         <div class="text-input form-group float-none">
            <input type="number" autocomplete="off" value="" id="consumer_number" placeholder="Enter Consumer Number" onblur="check_consumer_number()">
         </div>
         <div class="clearfix"></div>
        <div class="button-holder">
        <a role="button" href="#" class="button-next" style="display: block" onclick="pay_bill()" id="pay_btn">Pay</a>
        </div>
        <p id="error_consumer_no" class="error_msg"></p>
        </div>
    </div>
    
</div>
</div>
<!-- ----End---  Toll Recharge --------------->

<div class="service_selector">
	<div class="owl-carousel">
        <div class="item">
            <div class="col-sm-12 col-xs-12 mobile_recharge focus-pop" id="mob_rec" onclick="mobile_show()" >
                <span><img src="<?php echo base_url(); ?>webassets/images/mobile_tab_icon.png" alt="..."/> <span>Mobile Recharge</span></span>
            </div>
         </div>
         <div class="item">
            <div class="col-sm-12 col-xs-12 tv_recharge focus-pop" id="tv_rec" onclick="tv_show()"> 
                <span><img src="<?php echo base_url(); ?>webassets/images/tv_recharge_icon.png" alt="..."/> <span>TV Recharge</span></span>
            </div>
         </div>
         <div class="item">
            <div class="col-sm-12 col-xs-12 data_recharge focus-pop" id="data_rec" onclick="data_show()">
                <span><img src="<?php echo base_url(); ?>webassets/images/deta_recharge_tab_icon.png" alt="..."/> <span>Data Recharge</span></span>
            </div>
         </div>
         <div class="item">
            <div class="col-sm-12 col-xs-12 mobile_recharge focus-pop" id="ele_rec" onclick="electricity_rec()" >
                <span><img src="<?php echo base_url(); ?>webassets/images/electricity_recharge_icon.png" alt="..."/> <span>Electricity</span></span>
            </div>
         </div>
         <div class="item">
            <div class="col-sm-12 col-xs-12 tv_recharge focus-pop" id="toll_rec" onclick="toll_rec()"> 
                <span><img src="<?php echo base_url(); ?>webassets/images/church_icon.png" alt="..."/> <span>Church</span></span>
            </div>
         </div>
         <div class="item">
            <div class="col-sm-12 col-xs-12 data_recharge focus-pop" id="biller_rec" onclick="biller_rec()">
                <span><img src="<?php echo base_url(); ?>webassets/images/biller_recharge_icon.png" alt="..."/> <span>Billers</span></span>
         </div>
         
   </div>
         <div class="item">
            <div class="col-sm-12 col-xs-12 tv_recharge focus-pop" id="event_rec" onclick="event_rec()"> 
                <span><img src="<?php echo base_url(); ?>webassets/images/event_icon.png" alt="..."/> <span>Events</span></span>
            </div>
         </div>
</div>
</div>
</div>
<div class="clearfix"></div>
    <div class="swipe">
        Swipe left to get more option <i aria-hidden="true" class="fa fa-hand-pointer-o"></i>
    </div>
<div class="clearfix"></div>
<!------- Mobile Section ------>
<div class="mobile_sec section-offset">
	<div class="container">
    	<div class="col-md-7">
    	<h1>Available on iOS and Android</h1>
        <p>OyaCharge is available for download on the Google Playstore and AppStore.
It is lightweight and very easy to install.</p>
        <br />
        <br />
        <a href="https://play.google.com/store/search?q=oyacharge&hl=en">
            	<img src="<?php echo base_url(); ?>webassets/images/android.png" alt="..." />
            </a>
            <a href="https://itunes.apple.com/ng/app/oyacharge/id1173501594">
            	<img src="<?php echo base_url(); ?>webassets/images/app.png" alt="..."/ >
            </a>
        </div>
        <div class="col-md-5 mbl_img text-center">
        	<img class="img-responsive" src="<?php echo base_url(); ?>webassets/images/mobile-3.png" alt="..."/>
       	</div>
    </div>
</div>
<!----------- Service selector ---------->
<div class="clearfix"></div> 
<div class="section-offset">   
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center service_heading">
                <h1>NEED HELP TO CHOOSING A PLAN?</h1>
                <h3>Our <span class="color-seagreen">[Service Selector]</span> can help you find the right plan for you.</span>
            </div>
        </div>
        <div class="row offset-top-30">
            <div class="offer-slide">
                <div class="item">
                    <div class="col-sm-12 col-xs-12 offset-botton-767 text-center">
                        <img src="<?php echo base_url(); ?>webassets/images/service_one.png" alt="..."/>
                        <h3>Mobile Recharge</h3>
                        <div class="clearfix"></div>
                        <p><?php if($recharge_content){
                                echo $recharge_content[0]->mobile_recharge;
                            }  ?> </p>
                        <div class="clearfix"></div>
                        <a href="#" class="btn btn-border offset-top-30"><span></span>Get Plans & Offers</a>
                    </div>
                </div>
                <div class="item">
                    <div class="col-sm-12 col-xs-12 offset-botton-767 text-center">
                        <img src="<?php echo base_url(); ?>webassets/images/service_two.png" alt="..."/>
                        <h3>TV Recharge</h3>
                        <div class="clearfix"></div>
                        <p><?php if($recharge_content){
                                echo $recharge_content[0]->tv_recharge;
                            }  ?> </p>
                        <div class="clearfix"></div>
                        <a href="#" class="btn btn-border offset-top-30"><span></span>Get Plans & Offers</a>
                    </div>
                </div>
                <div class="item">
                    <div class="col-sm-12 col-xs-12 offset-botton-767 text-center">
                        <img src="<?php echo base_url(); ?>webassets/images/service_three.png" alt="..."/>
                        <h3>Data Recharge</h3>
                        <div class="clearfix"></div>
                        <p><?php if($recharge_content){
                                echo $recharge_content[0]->data_recharge;
                            }  ?> </p>
                        <div class="clearfix"></div>
                        <a href="#" class="btn btn-border offset-top-30"><span></span>Get Plans & Offers</a>
                    </div>
                </div>
                <div class="item">
                    <div class="col-sm-12 col-xs-12 offset-botton-767 tv_recharge text-center">
                        <img src="<?php echo base_url(); ?>webassets/images/service_four.png" alt="..."/>
                        <h3>Electricity Recharge</h3>
                        <div class="clearfix"></div>
                        <p><?php if($recharge_content){
                                echo $recharge_content[0]->electricity_recharge;
                            }  ?> </p>
                        <div class="clearfix"></div>
                        <a href="#" class="btn btn-border offset-top-30"><span></span>Get Plans & Offers</a>
                    </div>
                </div>
                <div class="item">
                    <div class="col-sm-12 col-xs-12 offset-botton-767 text-center">
                        <img src="<?php echo base_url(); ?>webassets/images/church_icon(2).png" alt="..."/>
                        <h3>Church Donation</h3>
                        <div class="clearfix"></div>
                        <p><?php if($recharge_content){
                                echo $recharge_content[0]->church_content;
                            }  ?> </p>
                        <div class="clearfix"></div>
                        <a href="#" class="btn btn-border offset-top-30"><span></span>Get Plans & Offers</a>
                    </div>
                </div>
                <div class="item">
                    <div class="col-sm-12 col-xs-12 offset-botton-767 text-center">
                        <img src="<?php echo base_url(); ?>webassets/images/service_six.png" alt="..."/>
                        <h3>Biller</h3>
                        <div class="clearfix"></div>
                        <p><?php if($recharge_content){
                                echo $recharge_content[0]->biller_content;
                            }  ?> </p>
                        <div class="clearfix"></div>
                        <a href="#" class="btn btn-border offset-top-30"><span></span>Get Plans & Offers</a>
                    </div>
                </div>
            </div>
    	</div>
	</div>
<br />
<br />
<div class="clearfix"></div>
    <div class="swipe minus-margin">
        Swipe left to get more plans <i aria-hidden="true" class="fa fa-hand-pointer-o"></i>
    </div>
<div class="clearfix"></div>
</div>

<!-------------- plan selector -------------->
<!-------------- Share app -------------->

<div class="clearfix"></div>
<div id="vedio_section" class="feedback section-offset video_sec">
<div class="container">
    <h1>Recharge Video</h1>
    <p><?php echo $about_details[0]->about_us_content; ?> </p>
    <div class="videoWrapper">
   
        <!-- Copy & Pasted from YouTube -->
        <iframe width="100%" height="349" src="<?php echo $about_details[0]->about_us_video; ?>?autoplay=1&rel=0&hd=1" frameborder="0" allowfullscreen>       </iframe>
	</div>
</div>	
</div>
<!-------------- Video Section -------------->
<div id="share_section" class="section-offset">
	<div class="container">
    	<div class="col-sm-6 col-xs-12 service_heading">
        	<h3>Share <span class="color-seagreen">OUR APP</span> to your friend and get chance to earn.</h3>
            <p><?php if($recharge_content){
                    	echo $recharge_content[0]->share_app_content;
                    }  ?> </p>
            
            <div class="clearfix"></div>
            <ul class="share">
            	<li><a href="#" class="whatsapp"><i class="fa fa-whatsapp"></i></a></li>
                <li><div class="fb-share-button" data-href="http://www.oyacharge.com" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Share</a></div></li>
                <li><a href="https://plus.google.com/share?url=http://www.oyacharge.com" onclick="javascript:window.open(this.href,
  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img
  src="https://www.gstatic.com/images/icons/gplus-32.png" alt="Share on Google+"/></a></li>
                <li><a href="http://twitter.com/share?text=OyaCharge&url=http://www.oyacharge.com" class="twitter"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#" class="other">...</a></li>
            </ul>
        </div>
        <div class="col-sm-6 col-xs-12 share-img">
        	<img src="<?php echo base_url(); ?>webassets/images/share_icons.png" alt="..."/>
        </div>
    </div>
</div>

<!-------------- Share app -------------->

<div id="contact_form" class="feedback section-offset">
	<h1>Give your <span class="size36">FEEDBACK</span> so we can help you!</h1>
	<div class="container offset-top-30">
        <form class="foodback_form" >
        	<div class="border_block form-group">
            <input type="text" placeholder="NAME" id="name" name="name" value="">
            <input type="email" placeholder="EMAIL" id="email" value="" name="email"/>
            <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
			<div class="border_block">
            <textarea placeholder="Message" rows="2" value="" id="message" name="message"></textarea>
            <input type="button" value="SEND" onclick="send_feedback()">
           
            <div class="clearfix"></div>
            </div>
             <div id="response_feedback"></div>
        </form>
        <div class="contact-details">
        	<span><i class="fa fa-map-marker" aria-hidden="true"></i><?php echo $contact_details[0]->contact_name ?></span><br> 
        	<span><i class="fa fa-envelope-o" aria-hidden="true"></i> <?php echo $contact_details[0]->contact_email ?></span><br> 
 <span><i class="fa fa-phone" aria-hidden="true"></i>  <?php echo $contact_details[0]->contact_number ?>   </span>
 			  <ul class="social">
        	<a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-google-plus"></i></a>
        </ul>
        </div>
    </div>
</div>

	
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.8&appId=182570062196832";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>







