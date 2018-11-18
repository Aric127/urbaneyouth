  <!-- Include all compiled plugins (below), or include individual files as needed -->
     <script src="<?php echo base_url(); ?>webassets/js/jquery-1.11.1.min.js"></script>
   


<script src="<?php echo base_url(); ?>webassets/js/bootstrap.min.js"></script>
    
       <script>
		$(document).ready(function(e) {
            $('.menu-button').click(function(){
				$('.menu_inner, .menu_inner li a, .menu-button').toggleClass('active');
			});
        });
	</script>
	

  <!----- show pin pop up--->

<div class="modal fade popup bs-example-modal-sm" id="save_pin" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body">
      <div class="close-pop" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></div>
        <div class="">
        	 <h5 class="text-center">Secure Pin</h5>
        	<div class="col-sm-12 col-xs-12 col-620 text-center offser-auto">
            	<div class="form-group">
                	<input type="password" class="field" placeholder="ENTER PIN" value="" id="transfer_pin">
                </div>
                <div class="form-group">
                	<input type="password" class="field" placeholder="CONFIRM PIN" value="" id="confirm_pin">
                </div>
                 <p id="pin_status" class="error_msg"></p>
            	<div class="form-group">
                	<a class="field btn-green" style="cursor: pointer" onclick="save_pin()" >Save and Go</a>
                </div>
                 <p id="share_sms_status"></p>
            </div>
            <div class="clearfix"></div>
        </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!---- check transfer pin--->
<div class="modal fade popup bs-example-modal-sm" id="check_pin" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body">
      <div class="close-pop" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></div>
        <div class="">
          <h5 class="text-center">Secure Pin</h5>
        	<div class="col-sm-12 col-xs-12 col-620 text-center offser-auto">
            	<div class="form-group">
                	<input type="password" class="field" placeholder="ENTER PIN" value="" id="check_transfer_pin">
                </div>
              	<div class="form-group">
                	<a class="field btn-green" style="cursor: pointer" onclick="check_pin()" >Confirm</a>
                </div>
                 <p id="pin_false_status"></p>
                  <h4><a href="#" onclick="reset_oyapin()">Reset Oyapin</a></h4>
            </div>
            <div class="clearfix"></div>
        </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!---- reset  transfer pin--->
<div class="modal fade popup bs-example-modal-sm" id="reset_oyapin" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body">
      <div class="close-pop" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></div>
        <div class="">
          <h5 class="text-center">Reset Pin</h5>
        	<div class="col-sm-12 col-xs-12 col-620 text-center offser-auto">
            	<div class="form-group">
                	<input type="email" class="field" placeholder="ENTER EMAIL" value="" id="reset_transfer_oyapin">
                	<input type="hidden" id="reset_user_id" value="<?php echo $this->session->userdata('user_id'); ?>" />
                </div>
              	<div class="form-group">
                	<a class="field btn-green" style="cursor: pointer" onclick="reset_transfer_pin()" >Reset</a>
                </div>
                 <p id="pin_change_status"></p>
                
            </div>
            <div class="clearfix"></div>
        </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->