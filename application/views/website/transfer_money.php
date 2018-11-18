
<?php   $user_id= $this->session->userdata('user_id');?>
<?php  $wallet= $my_profile->user_pin_status;
 $pin_status= $this->session->userdata('user_pin_status');
 ?>

	<div class="after_login_page">
		<h3 class="text-green">Balance ₦ <span id="wallet"> <?php echo $my_profile->wallet_amount; ?></span></h3>
        <br>
        <div id="status"></div>
        <h3>Transfer Money</h3>
         <div class="profile-box">
         	<!--<p id="msg" class="error_msg"></p>-->
        	<div class="form-group">
            	<input class="input" type="number" placeholder="Enter Amount" id="transfer_amount" value="<?php if(!empty($rec_amount)){ echo $rec_amount;} ?>" onblur="check_amount_field()"/>
            	
            	<p id="amount_error" class="error_msg"></p>
            	<input class="input" type="hidden"  id="user_id" value="<?php echo $my_profile->user_id; ?>"/>
            	<input type="hidden"  id="pin_type" value="<?php echo "5";?>"/>
            	<input type="hidden"  id="transfer_pin_status" value="<?php echo $pin_status;?>"/>
            </div>
            <div class="form-group">
            	<input class="input" type="number" placeholder="Enter Friend Mobile Number" id="transfer_mobile_no" onblur="check_number_field()" value="<?php if(!empty($transfer_number)){ echo $transfer_number;} ?>"/>
            <p id="number_error" class="error_msg"></p>
            </div>
            <div class="form-group">
            	<a class="btn btn-green"  onclick="transfer_money()">TRANSFER MONEY</a> 
            </div>
        </div>
        <div class="clearfix"></div>
    </div>

 <div class="modal fade popup" id="transfer_popup" tabindex="-1" role="dialog" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body modal-pop">
      <div class="close-pop" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></div>
        <div class="row">
        	<div class="col-sm-8 col-xs-7 col-620 text-center offser-auto">
            	<h2 class="text-green">₦ <span id="amt"></span> Amount is successfully Transfer to</h2>
                <div class="text-green"><span id="mob_num"></span></div>
            </div>
        </div>
      
      </div>
      <div class="clearfix"></div>
      <div class="pop-order">
          Order ID: <span id="order_id"></span><br/>
          Date: <span id="rec_date"></span>
      </div>
      <div class="clearfix"></div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

