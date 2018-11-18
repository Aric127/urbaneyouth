<div class="after_login_page">
	<?php   $user_id= $this->session->userdata('user_id');?>

    	<h2><?php  if(!empty($my_profile)){echo $my_profile->user_name;}?>	</h2>
		<p><?php  if(!empty($my_profile)){echo $my_profile->user_email;}?></p>
     	
       <br><br><br>
       <div id="status" style="color:green;display: none"></div>
        <div class="profile-box">
        	<div class="form-group">
            	<input class="input" type="text" placeholder="Enter Name" id="user_name" name="user_name" value="<?php echo  $my_profile->user_name;?>"/>
            	<input type="hidden" placeholder="Enter Name" id="user_id" name="user_id" value="<?php echo $user_id;?>"/>
            	<div id="error" style="color: red;display: none">User field are required</div>
            </div>
            <div class="form-group">
            	<input class="input" type="text" placeholder="Enter Email" id="user_email" name="user_email" value="<?php  if(!empty($my_profile)){echo $my_profile->user_email;}?>" />
            </div>
            <div class="form-group">
            
            	<input class="input" type="text" placeholder="Enter Mobile" id="user_contact_no" name="user_contact_no" value="<?php echo  $my_profile->user_contact_no;?>" 	 readonly="readonly"  >
            </div>
            <?php if($my_profile->user_login_type=='1'){ ?>
           <!--<h4 class="offset-top-30">Change Password</h4>
            <div class="form-group">
            	<input class="input" type="text" placeholder="Enter Old Password" id="old_password" onblur="check_pass()"/>
            	
            	<div id="old_status"></div>
            </div>
            <div class="form-group">
            	<input class="input" type="text" placeholder="Enter New Password" id="new_password"/>
            </div>
            <div class="form-group">
            	<input class="input" type="text" placeholder="Enter Confirm Password" id="confirm_password" onblur="match_pass()"/>
            	
            	<div id="error_status"></div>
            </div>-->
             <?php } ?>
            
            <div class="form-group">
            	<input type="submit" class="btn btn-green" value="Update" onclick="user_update()"/>
            </div>
           
        </div>
    </div>
  <script>
 
  </script>
  