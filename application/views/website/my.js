	function user_login(){
		
			var user_login=$("#user_name").val();
			var user_password=$("#user_pass").val();
			 $.ajax({
                    url: "<?php echo base_url('webservices/api.php?rquest=login')?>",
                    type: "POST",
                    data: {
                        'login_id': user_login,
                        'user_password': user_password
                    },
                    success: function (data) {
                    	
                    	if(data!=''){
                    		var getdata=jQuery.parseJSON(data);
                    		var status=getdata.status;
                    			var message=getdata.message;
                    		
                    		if(status=='true')
                    		{
                    			  
                    			var user_id=getdata.user_id;
                    			
                    			if(getdata.user_name!=''){
                    				var user_name=getdata.user_name;
                    			}else{
                    				var user_name='';
                    			}
                    			if(getdata.user_email!=''){
                    				var user_email=getdata.user_email;
                    			}else{
                    				var user_email='';
                    				}
                    			
                    		if(getdata.mobile!=''){
                    			var user_contact_no=getdata.mobile;
                    		}else{
                    			var user_contact_no='';
                    		}
                    			var login_type=getdata.login_type;
                    			var user_wallet=getdata.wallet_amount;
                    			var user_password=getdata.user_password;
                    		
                    			 $.ajax({
					                    url: "<?php echo site_url('website/user_login')?>",
					                    type: "POST",
					                    data: {
					                        'user_id': user_id,
					                        'user_name': user_name,
					                        'user_email': user_email,
					                        'user_mobile': user_contact_no,
					                        'user_wallet': user_wallet,
					                        'user_password': user_password,
					                        'login_type':login_type
					
					                    },
					                    success: function (data) 
					                    {
					                    	
					                    }
					                   	});
					                   		
					                   	$("#response_success").text(message);
					                   	setInterval(function(){profile()}, 1000);
					                  }else if(status=='false'){
					                 
					                  	$("#response_success").text(message);
					                  }
                    		        }
                   		
                    }

                });
		}
		function profile(){
			var mobile =$("#mobile").val();
			var prepaid=$("#prepaid").val();
			var mobile_operator_id=$("#mobile_operator_id").val();
			var top_up=$("#top_up").val();
			var mobile_amount=$("#mobile_amount").val();
			if(mobile==''){
				location.href="<?php echo site_url('website/my_profile'); ?>"
			}else{
				location.href="<?php echo site_url('website/my_recharge'); ?>?mobile=" + mobile + "&prepaid=" + prepaid+"&mobile_operator_id="+mobile_operator_id+"&top_up="+top_up+"&mobile_amount="+mobile_amount;
			}
			
		}

	     // fb//
         window.fbAsyncInit = function() {
       FB.init({
            appId      : '1716710845207683',
            cookie     : true,  // enable cookies to allow the server to access 
                                // the session
            xfbml      : true,  // parse social plugins on this page
            version    : 'v2.5' // use version 2.5
        });
    };

    // Load the SDK asynchronously
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
  
    function fb_login(){
        FB.login(function(response) {
            if (response.status === 'connected') {
            	
                FB.api('/me?fields=id,name,email,first_name,last_name', function(response) {
                	  var getdata= JSON.stringify(response);
                	  var getdata=jQuery.parseJSON(getdata);
                	  var social_id=getdata.id;
                	  var first_name=getdata.first_name;
					    var last_name=getdata.last_name;
						var email=getdata.email;
						var login_type='2';
                    $.ajax({
                         url: "<?php echo base_url('webservices/api.php?rquest=social_login')?>",
                        'type':'POST',
                        'data':{
                        	'user_social_id':social_id,
                        	'user_firstname':first_name,
                        	'user_lastname':last_name,
                        	'user_email':email,
                        	'login_type':login_type
                        	},
                        'success' : function(data)
                        { 
                        	var getdata=jQuery.parseJSON(data);
                        	var status=getdata.status;
                    		var message=getdata.message;
                    	
                    		var user_id=getdata.user_id;
                    			
                    		var user_name=getdata.user_name;
                    		var user_wallet='0';
                    		//alert(user_name);
                    		if(status =='true'){
                    		 $.ajax({
					                    url: "<?php echo site_url('website/fb_login')?>",
					                    type: "POST",
					                    data: {
					                        'user_id': user_id,
					                        'user_name': user_name,
					                        'user_email': email,
					                       'user_wallet': user_wallet,
					                     	  'login_type':login_type
					
					                    },
					                    success: function (data) 
					                    {
					                    	
					                    }
					                });
					                  
					            $("#response_success").text(message);
					            setInterval(function(){profile()}, 1000);
					            function reload(){
					            	location.href="<?php echo site_url('website'); ?>"
					            }
                          }else if(status=='false'){
                          		$("#response_success").text(message);
                          }
                      
                         
                        }
                    });
                });
            } else if (response.status === 'not_authorized') {
                // The person is logged into Facebook, but not your app.
            } else {
                // The person is not logged into Facebook, so we're not sure if
                // they are logged into this app or not.
            }
        }, {scope: 'public_profile,email'});
    }
    
    
    	function forget_password(){
    		var login_id=$("#login_id");
    		 $.ajax({
					 url: "<?php echo base_url('webservices/api.php?rquest=forget_password')?>",
					 type: "POST",
					  data: {
					         'login_id': login_id,
					        },
					   success: function (data) 
					      {
					      	var getdata=jQuery.parseJSON(data);
                        	var status=getdata.status;
                    		var message=getdata.message;
					          $("#response_success").text(message);          	
					       }
					});
					                  
    	}