<?php
/**
 * Template Name:Verifications Page
 */
 include_once('serverdetails.php');
 
 
if ( is_user_logged_in() ) {
    //echo 'Welcome, registered user!';
} else {
    //echo 'Welcome, visitor!';
 wp_redirect(home_url()."/?login=1");
 exit;
}

$user_id=get_current_user_id();
if(isset($_GET['data']))
{
	
	$config   = 'hybridauth_lib/hybridauth/config.php';
    require_once("hybridauth_lib/hybridauth/Hybrid/Auth.php" );
	if($_GET['data']=='Twitter')
	{
		
		session_start(); 
   // change the following paths if necessary 
  try{
  	// create an instance for Hybridauth with the configuration file path as parameter
  	$hybridauth = new Hybrid_Auth( $config );
	
	$twitter = $hybridauth->authenticate( "Twitter" ); 
	$twitter_user_profile = $twitter->getUserProfile();
	
	//echo "Ohai there! U are connected with: <b>{$twitter->id}</b><br />"; 
  	//echo "As: <b>{$twitter_user_profile->displayName}</b><br />"; 
  	//echo "And your provider user identifier is: <b>{$twitter_user_profile->identifier}</b><br />"; 
 
  	// debug the user profile
  	//print_r( $twitter_user_profile );
	// exp of using the twitter social api: Returns settings for the authenticating user.
  	$account_settings = $twitter->api()->get( 'account/settings.json' );
 
  	// print recived settings 
  	//echo "Your account settings on Twitter: " . print_r( $account_settings, true );
 
  	// disconnect the user ONLY form twitter
  	// this will not disconnect the user from others providers if any used nor from your application
  	//echo "Logging out.."; 
  	$twitter->logout();
	
	$quer_varification=mysql_query("select verification_id from wp_verification where authentication_id='".$twitter_user_profile->identifier."' and user_id='".$user_id."'")or die(mysql_error());
	$verification_row=mysql_num_rows($quer_varification);
	if($verification_row>0)
	{
	
	}
	else {
		
	$query_twitter=mysql_query("insert into wp_verification set user_id='".$user_id."',authenticate_by='Twitter',authentication_id='".$twitter_user_profile->identifier."',display_name='".$twitter_user_profile->displayName."',public_url='".$twitter_user_profile->profileURL."' ") or die(mysql_error());
	}
	}
  catch( Exception $e ){
  	
	    switch( $e->getCode() ){ 
  	  case 0 : echo "Unspecified error."; break;
  	  case 1 : echo "Hybriauth configuration error."; break;
  	  case 2 : echo "Provider not properly configured."; break;
  	  case 3 : echo "Unknown or disabled provider."; break;
  	  case 4 : echo "Missing provider application credentials."; break;
  	  case 5 : echo "Authentification failed. " 
  	              . "The user has canceled the authentication or the provider refused the connection."; 
  	           break;
  	  case 6 : echo "User profile request failed. Most likely the user is not connected "
  	              . "to the provider and he should authenticate again."; 
  	           $twitter->logout(); 
  	           break;
  	  case 7 : echo "User not connected to the provider."; 
  	           $twitter->logout(); 
  	           break;
  	  case 8 : echo "Provider does not support this feature."; break;
	  }
	  // well, basically your should not display this to the end user, just give him a hint and move on..
  	echo "<br /><br /><b>Original error message:</b> " . $e->getMessage(); 
  }
		
	}
	
	else if($_GET['data']=='Facebook')
	{
		session_start(); 
   // change the following paths if necessary 
  try{
  	// create an instance for Hybridauth with the configuration file path as parameter
  	$hybridauth = new Hybrid_Auth( $config );
	
	$facebook=$hybridauth->authenticate( "Facebook" ); 
	$facebook_user_profile =$facebook->getUserProfile();
	
	//echo "Ohai there! U are connected with: <b>{$linkedin->id}</b><br />"; 
  	//echo "As: <b>{$linkedin_user_profile->displayName}</b><br />"; 
  	//echo "And your provider user identifier is: <b>{$linkedin_user_profile->identifier}</b><br />"; 
 
  	// debug the user profile
  	//print_r( $facebook_user_profile );
	// exp of using the twitter social api: Returns settings for the authenticating user.
  	//$account_settings = $linkedin->api()->get('account/settings.json' );
 
  	// print recived settings 
  	//echo "Your account settings on Twitter: " . print_r( $account_settings, true );
 
  	// disconnect the user ONLY form twitter
  	// this will not disconnect the user from others providers if any used nor from your application
  	//echo "Logging out.."; 
  	$facebook->logout();
	$today=date("Y-m-d H:i:s");
	
	$quer_varification2=mysql_query("select verification_id from wp_verification where authentication_id='".$facebook_user_profile->identifier."' and user_id='".$user_id."'")or die(mysql_error());
	$verification_row2=mysql_num_rows($quer_varification2);
	
	if($verification_row2>0)
	{
		
	}
   else{
		
	$query_facebook=mysql_query("insert into wp_verification set user_id='".$user_id."',authenticate_by='Facebook',authentication_id='".$facebook_user_profile->identifier."',display_name='".$facebook_user_profile->displayName."',public_url='".$facebook_user_profile->profileURL."',verification_date='".$today."'") or die(mysql_error());
   }
}
  catch( Exception $e ){
  	
	    switch( $e->getCode() ){ 
  	  case 0 : echo "Unspecified error."; break;
  	  case 1 : echo "Hybriauth configuration error."; break;
  	  case 2 : echo "Provider not properly configured."; break;
  	  case 3 : echo "Unknown or disabled provider."; break;
  	  case 4 : echo "Missing provider application credentials."; break;
  	  case 5 : echo "Authentification failed. " 
  	              . "The user has canceled the authentication or the provider refused the connection."; 
  	           break;
  	  case 6 : echo "User profile request failed. Most likely the user is not connected "
  	              . "to the provider and he should authenticate again."; 
  	           $linkedin->logout(); 
  	           break;
  	  case 7 : echo "User not connected to the provider."; 
  	           $linkedin->logout(); 
  	           break;
  	  case 8 : echo "Provider does not support this feature."; break;
	  }
	  // well, basically your should not display this to the end user, just give him a hint and move on..
  	echo "<br /><br /><b>Original error message:</b> " . $e->getMessage(); 
  }	
     
		
	}
	else if($_GET['data']=='LinkedIn')
	{
				
		session_start(); 
   // change the following paths if necessary 
  try{
  	// create an instance for Hybridauth with the configuration file path as parameter
  	$hybridauth = new Hybrid_Auth( $config );
	
	$linkedin=$hybridauth->authenticate( "LinkedIn" ); 
	$linkedin_user_profile =$linkedin->getUserProfile();
	
	//echo "Ohai there! U are connected with: <b>{$linkedin->id}</b><br />"; 
  	//echo "As: <b>{$linkedin_user_profile->displayName}</b><br />"; 
  	//echo "And your provider user identifier is: <b>{$linkedin_user_profile->identifier}</b><br />"; 
 
  	// debug the user profile
  	//print_r( $linkedin_user_profile );
	// exp of using the twitter social api: Returns settings for the authenticating user.
  	//$account_settings = $linkedin->api()->get('account/settings.json' );
 
  	// print recived settings 
  	//echo "Your account settings on Twitter: " . print_r( $account_settings, true );
 
  	// disconnect the user ONLY form twitter
  	// this will not disconnect the user from others providers if any used nor from your application
  	//echo "Logging out.."; 
  	$linkedin->logout();
	$today=date("Y-m-d H:i:s");
	$quer_varification1=mysql_query("select verification_id from wp_verification where authentication_id='".$linkedin_user_profile->identifier."' and user_id='".$user_id."'")or die(mysql_error());
	$verification_row1=mysql_num_rows($quer_varification1);
	if($verification_row1>0)
	{
	
	}
	else {
	$query_linkedin=mysql_query("insert into wp_verification set user_id='".$user_id."',authenticate_by='LinkedIn',authentication_id='".$linkedin_user_profile->identifier."',display_name='".$linkedin_user_profile->displayName."',public_url='".$linkedin_user_profile->profileURL."',verification_date='".$today."'") or die(mysql_error());
	}
}
  catch( Exception $e ){
  	
	    switch( $e->getCode() ){ 
  	  case 0 : echo "Unspecified error."; break;
  	  case 1 : echo "Hybriauth configuration error."; break;
  	  case 2 : echo "Provider not properly configured."; break;
  	  case 3 : echo "Unknown or disabled provider."; break;
  	  case 4 : echo "Missing provider application credentials."; break;
  	  case 5 : echo "Authentification failed. " 
  	              . "The user has canceled the authentication or the provider refused the connection."; 
  	           break;
  	  case 6 : echo "User profile request failed. Most likely the user is not connected "
  	              . "to the provider and he should authenticate again."; 
  	           $linkedin->logout(); 
  	           break;
  	  case 7 : echo "User not connected to the provider."; 
  	           $linkedin->logout(); 
  	           break;
  	  case 8 : echo "Provider does not support this feature."; break;
	  }
	  // well, basically your should not display this to the end user, just give him a hint and move on..
  	echo "<br /><br /><b>Original error message:</b> " . $e->getMessage(); 
  }	
		
	}
}
/*
  
  

	
	$user_query=mysql_query("SELECT * FROM wp_users WHERE ID=$user_id");
	$user_array=mysql_fetch_array($user_query);*/
get_header();
?>
<script type="text/javascript">
	
	function remove_authentication(str_auth)
	{
	$.ajax({
			type: "get",
            url:'<?php echo get_page_link('470');?>&auth_by='+str_auth,
			success: function(data)
			{
				if(data==1)
				{
					window.location.href='<?php echo get_page_link('430');?>';
				}
			}
		});	
	}
</script>
<link rel="stylesheet" href="<?php bloginfo('template_url');?>/css/popup.css" />
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/tinybox.js"></script>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<div class="wraper_main_section" style=" border:1px solid #ccc;">

 <?php get_sidebar();?>
<div class="noti-narrowright">
	<div class="handler">
    
    
  <div class="f_l">
  
  <div class="wrap_edver">Verifications</div>

	    <p class="skills-input-p">You can add verifications to your account here to improve your public profile</p> 
       <!--<div class="verification-page">
        	<h3>Mobile Number</h3>
            <p>Enter your mobile number</p>
            <div style="display:inline;">
            <input class="verification-page-input" name="" type="text" /></div>
            <input class="verficatn-btn" type="submit" value="SEND VERIFICATION CODE" name="" />
        </div>-->
        
        
        
        <div class="verification-page" style="padding:10px 10px 100px;">
        	<h3>Social Verifications</h3>
            	<div>
            		<div class="fb_img">
      <?php       			
   $quer_varification_twitter=mysql_query("select verification_id from wp_verification where user_id='".$user_id."' and authenticate_by='Twitter'")or die(mysql_error());
	$verification_twitter_row=mysql_num_rows($quer_varification_twitter);
	if($verification_twitter_row>0)
	{
	?>
	<div style="float: left; display: block; overflow: hidden; width: 124px;margin-top:10px;">
	<img src="<?php echo get_template_directory_uri();?>/images/twiter.png"  style="display: block; overflow: hidden; margin-left: auto; margin-right: auto;">
            		 <div class="social" style="text-align: center;"> Twitter Connected</div>
   
 <a href="javascript:void(0);" onclick="remove_authentication('Twitter');" target="_parent"  style="text-align: center; display: block;"  class="add_fb">Remove </a>
 </div>
	
	
	<?php
	}
	else {
		?>
		
		<a href="<?php echo add_query_arg('data','Twitter',get_page_link('430'));?>" target="_parent" style="float:left;" class="add_fb">
            		
            	<img src="<?php echo get_template_directory_uri();?>/images/twiter.png" >
            		 <div class="social">Add Twitter</div>
   </a>
		
            		
	<?php
	
	}
        
    ?> 
    
        
            <?php       			
   $quer_varification_facebook=mysql_query("select verification_id from wp_verification where user_id='".$user_id."' and authenticate_by='Facebook'")or die(mysql_error());
	$verification_facebook_row=mysql_num_rows($quer_varification_facebook);
	if($verification_facebook_row>0)
	{
	?>
	   <div style="float: left; display: block; overflow: hidden; width: 124px;margin-top:10px;">
	  <img src="<?php echo get_template_directory_uri();?>facebook.png" style="display: block; overflow: hidden; margin-left: auto; margin-right: auto;" >
	  <img src="<?php echo get_template_directory_uri();?>/images/facebook.png" style="display: block; overflow: hidden; margin-left: auto; margin-right: auto;" >
        <div class="social" style="text-align: center;">Facebook Connected</div>
       <a href="javascript:void(0);" onclick="remove_authentication('Facebook');" target="_parent" style="text-align: center; display: block;" class="add_fb">Remove </a>
     </div>
	<?php	
	}
	else
	{
	?>
	
	
	 <a href="<?php echo add_query_arg('data','Facebook',get_page_link('430'));?>" target="_parent" style="float:left;" class="add_fb">
   

    <img src="<?php echo get_template_directory_uri();?>/images/facebook.png" >
     <div class="social">Add Facebook</div>
            		</a>
    <?php
	}
	?>   
    <?php       			
   $quer_varification_linkin=mysql_query("select verification_id from wp_verification where user_id='".$user_id."' and authenticate_by='LinkedIn'")or die(mysql_error());
	$verification_linkedin_row=mysql_num_rows($quer_varification_linkin);
	if($verification_linkedin_row>0)
	{
		?>
		<div style="float: left; display: block; overflow: hidden; width: 124px;margin-top:10px;">
		
		
		<img src="<?php echo get_template_directory_uri();?>/images/linkin.jpg" style="display: block; overflow: hidden; margin-left: auto; margin-right: auto;">
            		 <div class="social" style="text-align: center;"> Linkedin Connected</div>
           <a href="javascript:void(0);" onclick="remove_authentication('LinkedIn');" target="_parent" style="text-align: center; display: block;" class="add_fb">Remove </a>
		</div>
		
		<?php
		
	}
	else {
		?>
		
		<a href="<?php echo add_query_arg('data','LinkedIn',get_page_link('430')); ?>" target="_parent" style="float:left;" class="add_fb">
            	
            
            	<img src="<?php echo get_template_directory_uri();?>/images/linkin.jpg" >
            		<div class="social" style="margin-top:6px;" onclick="remove_authentication('');">Add Linkedin</div>
            		</a>
		<?php
	     }
	?>
            		
            		 
            		
                 <?php //echo do_shortcode('[SocialAuth-WP-Short-Code]');?>
                  
                 <!--
                 <a href="http://gotaskers.ypsilonitsolutions.com/wp-content/plugins/socialauth-wp/hybridauth/?hauth.done=Facebook" target="_blank" style="float:left;" class="add_fb">Add Facebook</a>
                <a href=" http://gotaskers.ypsilonitsolutions.com/wp-content/plugins/socialauth-wp/hybridauth/?hauth.done=LinkedIn" target="_blank" style="float:left;" class="add_ln">Add Linkedin</a>
                <a href=" http://gotaskers.ypsilonitsolutions.com/wp-content/plugins/socialauth-wp/hybridauth/?hauth.done=Twitter" target="_blank" style="float:left;" class="add_tw">Add Twitter</a>
                 -->
                 </div>
                 <br/><br/>
                 
                 
                
                </div>
            <div>
            
        </div>
        
        
        </div>
		<div class="clr"></div>
	</div>
</div>
</div>

<?php
get_footer(); 
?>