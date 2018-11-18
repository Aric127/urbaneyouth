<?php if(!empty($rec_amount)){ ?>
	<script>
		$(document).ready(function()
		{
			$(window).on('load',function()
			{
						$("#SMS").modal();	
							
							
			});
		});
</script>
<?php }?>

<?php   $user_id= $this->session->userdata('user_id');?>
<?php  $wallet= $my_profile->user_pin_status;
 $pin_status= $this->session->userdata('user_pin_status');
 ?>
<div class="after_login_page">
    <div class="row">
        <div class="col-md-6 dvaider-sms">
            <div class="sms-management">
                <h4>SMS Management</h4>
            </div>
            <div class="wallet-charge">
                <div class="recharge-wallet">
                    <img width="111" src="<?php echo base_url(); ?>webassets/images/recharge_icon.png" alt="..."/>
                    <h1 id="sms_get"><?php echo $my_profile->total_sms; ?></h1>
                </div>
                <div class="sms-wallet">
                	<p>Your current balance of</p>
                    <h3>SMS</h3>
                    <div class="form-group">
                    		<input type="hidden"  id="pin_type" value="<?php echo "7_1";?>"/>
                    	<input type="hidden" class="btn btn-green" value="<?php echo $my_profile->user_id; ?>" id="user_id"/>
                    		<input type="hidden"  id="transfer_pin_status" value="<?php echo $pin_status;?>"/>
                    	<input type="hidden" class="btn btn-green" value="<?php echo $my_profile->wallet_amount; ?>" id="wallet_amount"/>
                    	<input type="submit" class="btn btn-green" value="Get SMS Plan" onclick="sms_add_plan()"/>
                        <input type="submit" class="btn btn-green" value="Share SMS " onclick="share_sms_popup()" />
                    </div>
                    <p id="sms_status" class=""></p>
                     <p id="sms_error_status" class="error_msg"></p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="sms-management">
                <h4>MY SMS</h4>
            </div>
            <div class="wallet-charge">
                <div class="recharge-wallet-p">
                    <h1 id="remain_sms"><?php echo $my_profile->remaining_sms; ?></h1>
                </div>
                <div class="sms-wallet">
                	<p>Remaining</p>
                    <h3>SMS</h3>
                </div>
            </div>
        </div>
    </div>
</div>



<!--- SMS Management ---->
<div class="modal fade popup bs-example-modal-sm" id="SMS" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body">
      <div class="close-pop" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></div>
        <div class="">
        	<div class="col-sm-12 col-xs-12 col-620 text-center offser-auto">
            	<div class="form-group">
                	<input type="text" class="field" placeholder="ENTER SMS" value="<?php if(!empty($rec_amount)){ echo $rec_amount;} ?>" id="transfer_amount" onblur="check_amount_field()">
               <p id="amount_error"></p>
                </div>
                <div class="form-group">
                	<input type="text" class="field" placeholder="ENTER MOBILE NUMBER" value="<?php if(!empty($transfer_number)){ echo $transfer_number;} ?>" id="transfer_mobile_no" onblur="check_number_field()">
                	  <p id="number_error"></p>
                </div>
                <div class="form-group">
                	<a style="cursor: pointer" class="field btn-green" onclick="share_sms()" >Share SMS</a>
                </div>
                 <p id="share_sms_status"></p>
            </div>
            <div class="clearfix"></div>
        </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

 <!------------- Recgarege plan popup -------------->          
<div class="modal fade popup" id="Smsplan" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        	<h3><span id="operator_name"></span> GET SMS Plans</h3>
            	<div class="scroll-tab">
            	 <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#Recommende" aria-controls="Recommende" role="tab" data-toggle="tab">Recommended</a></li>
                   
                  </ul>
                  </div>
                  <!-- Tab panes -->
                  <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="Recommende">
                    	<!-- <a href="#" onclick="get_amount(22)"><div class="plan_list">
                        	<div class="plan_rate">
                          		₦<span id="select_amount">22</span>
                            </div>
                            <div class="plan_details">
                            	<p><span class="operator_name"></span> GSM 100 MB|Post Free Usage with Validity left: 10p/10KB|Activation: USSD *141*322#</p>
								<p class="pull-left">Validity | 2 days</p> <p class="pull-right"> Talktime | 0</p>
								
                            </div>
                            <div class="clearfix"></div>
                        </div></a>
                        
                        <div class="clearfix"></div>
                        <a href="#" onclick="get_amount(35)"><div class="plan_list">
                        	<div class="plan_rate">
                          		₦<span id="select_amount">35</span>
                            </div>
                            <div class="plan_details">
                            	<p><span class="operator_name"></span> GSM ₦40 |Min 20 free for 11 to 7 Night|Activation: USSD *141*354#</p>
								<p class="pull-left">Validity | 5 days</p> <p class="pull-right"> Talktime | ₦10</p>
								
                            </div>
                            <div class="clearfix"></div>
                        </div></a>
                        
                        <div class="clearfix"></div>
                            <a href="#" onclick="get_amount(50)"><div class="plan_list">
                        	<div class="plan_rate">
                          		₦<span id="select_amount">50</span>
                            </div>
                            <div class="plan_details">
                            	<p><span class="operator_name"></span> GSM 250 MB|Post Free Usage with Validity left: 10p/10KB|Activation: USSD *141*722#</p>
								<p class="pull-left">Validity | 7 days</p> <p class="pull-right"> Talktime | ₦7</p>
								
                            </div>
                            <div class="clearfix"></div>
                        </div></a> -->
                        
                        <div class="clearfix"></div>
                    </div>
                    
                    <div role="tabpanel" class="tab-pane" id="FullTT">
                    	<a href="#" onclick="get_amount(55)"><div class="plan_list">
                        	<div class="plan_rate">
                          		₦<span id="select_amount">55</span>
                            </div>
                            <div class="plan_details">
                            	<p><span class="operator_name"></span> GSM ₦55|Activation: USSD *141*322#</p>
								<p class="pull-left">Validity | 0 days</p> <p class="pull-right"> Talktime | 55</p>
                            </div>
                            <div class="clearfix"></div>
                     </div></a>
                        <div class="clearfix"></div>
                    </div>
	           	</div>
      	</div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->