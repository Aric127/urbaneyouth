<div class="after_login_page">
	<?php   $user_id= $this->session->userdata('user_id');?>

    	<h2><?php  if(!empty($my_profile)){echo $my_profile->user_name;}?>	</h2>
		<p><?php  if(!empty($my_profile)){echo $my_profile->user_email;}?></p>

     <!--  <div id="status" style="color:green;display: none"></div>-->
        <div class="profile-box">
        	
          
         <h4 class="offset-top-30">Change Password</h4>
            <div class="form-group">
            	<input class="input" type="password" placeholder="Enter Old Password" id="old_password" onblur="check_pass()" autocomplete="off"/>
            	<input type="hidden" placeholder="Enter Name" id="user_id" name="user_id" value="<?php echo $user_id;?>"/>
            	<div id="old_status" style="color: red!important"></div>
            </div>
            <div class="form-group">
            	<input class="input" type="password" placeholder="Enter New Password" id="new_password"/>
            </div>
            <div class="form-group">
            	<input class="input" type="password" placeholder="Enter Confirm Password" id="confirm_password" onblur="match_pass()"/>
            	
            	<div id="error_status" style="color: red!important"></div>
            </div>
            
            
            <div class="form-group">
            	<input type="submit" class="btn btn-green" value="Update" onclick="change_password()"/>
            </div>
           
        </div>
    </div>
   <div class="modal fade popup" id="change_pass_popup" tabindex="-1" role="dialog" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body modal-pop">
      <div class="close-pop" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></div>
        <div class="row">
        	<div class="col-sm-8 col-xs-7 col-620 text-center offser-auto">
            	<h2 class="text-green"><span id="amt"></span></h2>
               
            </div>
        </div>
      
      </div>
   
   
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
  