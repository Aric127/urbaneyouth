// redirect to home
function Home()
{
	localStorage.setItem("mobileno","");
	localStorage.setItem("rec_category",'');
	localStorage.setItem("wt_category",'');
	localStorage.clear();
	location.href = home_url;
	
}
// function to show all tab
function open_tab()
{
	
	
	$("#mobileno,#mobile_operator_id,#mobile_recharge_amount,#dth_operator_id,#tv_number,#tv_rec_amount,#tv_number_name,#datacard_operator_id,#data_card_number,#datacard_amount,#data_card_number_name12,#electricty_operator_id,#electric_card_number,#electrice_amount,#electricity_customer_name,#biller,#service_provider_list,#consumer_number,#church_category_id,#church_id,#church_area,#church_donation_price,#church_price,#event_category_id,#event_id,#church_id,#church_area").val('');
	$("#mob_operator_error,#error_mobile_recharge,#mob_num_error,#error_mobile_recharge,#dth_operator_error,#dth_num_error,#dth_amt_error,#error_dth_recharge,#data_oper_error,#data_number_error,#data_amt_error,#data_num_error,#ele_oper_error,#ele_num_error,#ele_amt_error,#electricity_error,#biller_cat_errro,#biller_ser_errro,#error_consumer_no,#church_type_error,#church_select_error,#church_area_error,#church_service_error,#error_church_donation").text('');
	$("#mob_operator_error,#error_mobile_recharge,#mob_num_error,#error_mobile_recharge,#dth_operator_error,#dth_num_error,#dth_amt_error,#error_dth_recharge,#data_oper_error,#data_number_error,#data_amt_error,#ele_oper_error,#ele_num_error,#ele_amt_error,#electricity_error,#biller_cat_errro,#biller_ser_errro,#error_consumer_no,#church_type_error,#church_select_error,#church_area_error,#church_service_error,#error_church_donation").removeClass("errormsg");
}
$("#data_num_error").removeClass("erro-new-msg");
$("#data_num_error").removeClass("errormsg");
// function mobile recharge
function mobile_recharge()
{
	
	var mobileno			=	$("#mobileno").val();
	var rec_category		=	$("#rec_category").val();
	var mobile_amount		=	$("#mobile_recharge_amount").val();
	var operator_id			=	$("#mobile_operator_id option:selected").val();
	var mobile_topuptype    =   $('input[name=optionsRadios]:checked').val();
	if(mobileno.length !=11) {
		 $("#mob_num_error").text("Enter valid 11 digit mobile number");
		 $("#mob_num_error").addClass("errormsg");
		 }else if(isNaN(mobileno)){
		 	$("#mob_num_error").text("Enter valid 11 digit mobile number");
		 	$("#mob_num_error").addClass("errormsg");
		 }
		 else if(isNaN(mobile_amount)){
		 	$("#mob_num_error").text("Enter valid amount");
		 	$("#mob_num_error").addClass("errormsg");
		 }
		 else if(mobile_amount<50 || mobile_amount>50000)
		 {
		 	$("#error_mobile_recharge").addClass("errormsg");
		 	$("#error_mobile_recharge").text("Enter amount between 50 and 50000");
		 }else if(operator_id=='0')
		 {
		 	$("#mob_operator_error").addClass("errormsg");
		 	$("#mob_operator_error").text("Please select operator");
		 }else{
		 	$("#error_mobile_recharge").removeClass("errormsg");
		 	$.ajax({
				url : home_url + "check_login",
				type : "POST",
				data : {
					'mobile' : mobileno,
					'prepaid' : 1,
					'mobile_operator_id' : operator_id,
					'mobile_amount' : mobile_amount,
					'rec_category':rec_category,
					'wt_category':'2',
					'mobile_topuptype':mobile_topuptype
				},
				success : function(data) {
					
						localStorage.setItem("mobile_type",1);
						localStorage.setItem("mobileno",mobileno);
						localStorage.setItem("mobile_amount",mobile_amount);
						localStorage.setItem("operator_id",operator_id);
						localStorage.setItem("rec_category",rec_category);
						localStorage.setItem("wt_category",'2');
						localStorage.setItem("mobile_topuptype",mobile_topuptype);
					if (data == '2') {
						$('#LoginModal').modal();
					} else if (data == '1') {
						//location.href = home_url + "recharge_details?mobile";
						var send_data= home_url + "recharge_details?mobile=" + mobileno + "&mobile_topup=" + mobile_topuptype + "&mobile_operator_id=" + operator_id + "&mobile_amount=" + mobile_amount;
						location.href = send_data;
					}
				}
			});
		 }
}
function toppup_type(val) // check mobile recharge type // 1 for mobile topup,2 for data bundle
{
	
	if(val==2)
	{
		$("#mobile_recharge_amount").attr('readonly', 'readonly');
	}else if(val==1)
	{
		$('#mobile_recharge_amount').removeAttr('readonly');
	}
}
function repeat_recharge(operator_id,mobile_no,recharge_amt,recharge_category)
{
	if(recharge_category=='1')
	{
		localStorage.setItem("retry_mobileno",mobile_no);
		localStorage.setItem("rec_category",recharge_category);
		localStorage.setItem("retry_operator_id",operator_id);
		localStorage.setItem("retry_recharge_amt",recharge_amt);
		//localStorage.clear();
		location.href = home_url;
		
	}
}
// function Electrictiy bill  recharge
function electricity_recharge()
{
		var electric_card_number   = $("#electric_card_number").val();
		var electricty_operator_id = $("#electricty_operator_id option:selected").val();
		var electrice_amount 	   = $("#electrice_amount").val();
		var customer_name 	   = $("#electricity_customer_name").val();
		if (electricty_operator_id == '') 
		{
			$("#ele_oper_error").addClass("errormsg");
			$("#ele_oper_error").text('Please Select Service Provider');
			$("#ele_num_error").removeClass("errormsg");
			$("#ele_num_error").text('');
			$("#ele_amt_error").removeClass("errormsg");
			$("#ele_amt_error").text('');
			$("#electricity_error").removeClass("errormsg");
			$("#electricity_error").text('');
		}
		else if (electric_card_number == '') {
			
			$("#ele_num_error").addClass("errormsg");
			$("#ele_num_error").text('Please Enter Electricity Consumer Name');
			$("#ele_oper_error").removeClass("errormsg");
			$("#ele_oper_error").text('');
			$("#ele_amt_error").removeClass("errormsg");
			$("#ele_amt_error").text('');
			$("#electricity_error").removeClass("errormsg");
			$("#electricity_error").text('');
		}else if (electrice_amount == '') { 
			
			$("#ele_amt_error").addClass("errormsg");
			$("#ele_amt_error").text('Please Enter Amount');
			$("#ele_oper_error").removeClass("errormsg");
			$("#ele_oper_error").text('');
			$("#electricity_error").removeClass("errormsg");
			$("#electricity_error").text('');
		} else if (isNaN(electrice_amount)) { 
			
			$("#ele_amt_error").addClass("errormsg");
			$("#ele_amt_error").text('Please Enter Valid Amount');
			$("#ele_oper_error").removeClass("errormsg");
			$("#ele_oper_error").text('');
			$("#electricity_error").removeClass("errormsg");
			$("#electricity_error").text('');
		}else if (customer_name == '') {
			$("#electricity_error").addClass("errormsg");
			$("#electricity_error").text('Please Enter Valid Counsumer Number');
			$("#ele_oper_error").removeClass("errormsg");
			$("#ele_oper_error").text('');
			$("#ele_amt_error").removeClass("errormsg");
			$("#ele_amt_error").text('');
			$("#ele_num_error").removeClass("errormsg");
			$("#ele_num_error").text('');
		}else {
			$("#electricity_error").removeClass("errormsg");
			$("#electricity_error").text('');
			$("#ele_oper_error").removeClass("errormsg");
			$("#ele_oper_error").text('');
			$("#ele_amt_error").removeClass("errormsg");
			$("#ele_amt_error").text('');
			$("#ele_num_error").removeClass("errormsg");
			$("#ele_num_error").text('');
			$.ajax({
				url : home_url + "check_login",
				type : "POST",
				data : {
					'electricity_card_number' : electric_card_number,
					'electricity_operator_id' : electricty_operator_id,
					'electricity_amount' : electrice_amount,
					'wt_category':'12',
					'rec_category':'5'

				},
				success : function(data) {
						localStorage.setItem("electric_card_number",electric_card_number);
						localStorage.setItem("electrice_amount",electrice_amount);
						localStorage.setItem("electricty_operator_id",electricty_operator_id);
						localStorage.setItem("electricity_customer_name",customer_name);
						localStorage.setItem("wt_category",'12');
					if (data == '2') {
						$('#LoginModal').modal();
					} else if (data == '1') {
						var send_data= home_url + "recharge_details?mobile=" + electric_card_number + "&mobile_operator_id=" + electricty_operator_id + "&mobile_amount=" + electrice_amount+"&cn="+customer_name;
						location.href = send_data;
					}
				}
			});
		}
}
function check_electricity_mobile_amt(amt)
{
	if(amt=='')
	{
			$("#ele_amt_error").text('Please Enter Amount');
			$("#ele_amt_error").addClass("errormsg");
	}else if(isNaN(amt)){
			$("#ele_amt_error").text('Please Enter Valid Amount');
			$("#ele_amt_error").addClass("errormsg");
	}else{
			$("#ele_amt_error").text('');
			$("#ele_amt_error").removeClass("errormsg");
	}
			
}
//check_login_popup_msg
function check_login_popup_msg()
{
	$("#login_response_failed").removeClass("erro-new-msg");
	$("#login_response_failed").text("");
}
function user_login()
{

	var user_login = $("#user_mobile_login").val();
	var user_password = $("#user_password").val();
	if(user_login !='' && user_password !=''){
	if(user_login=='')
	{
			$("#login_mob_error").addClass("errormsg");
			$("#login_mob_error").text('Please Enter Email or Mobile No.');
	}else if(user_password=='')
	{
			$("#login_mob_error").removeClass("errormsg");
			$("#login_mob_error").text('');
			$("#login_pass_error").addClass("errormsg");
			$("#login_pass_error").text('Please Enter Password');
	}else{
			$("#login_mob_error").removeClass("errormsg");
			$("#login_mob_error").text('');
			$("#login_pass_error").removeClass("errormsg");
			$("#login_pass_error").text('');


	$.ajax({
		url : base_url + "login",
		type : "POST",
		data : {
			'login_id' : user_login,
			'user_password' : user_password
		},
		success : function(data) {
		if (data != '') {
				var getdata = jQuery.parseJSON(data);
				var status = getdata.status;
				var message = getdata.message;
				var mobile = getdata.mobile;
				var userid = getdata.user_id;

				if (status == 'true') {

					//var user_id = getdata.user_id;

					if (getdata.user_name != '') {
						var user_name = getdata.user_name;
					} else {
						var user_name = '';
					}
					if (getdata.user_email != '') {
						var user_email = getdata.user_email;
					} else {
						var user_email = '';
					}

					if (getdata.mobile != '') {
						var user_contact_no = getdata.mobile;
					} else {
						var user_contact_no = '';
					}
					var login_type = getdata.login_type;
					var user_wallet = getdata.wallet_amount;
					var user_password = getdata.user_password;
					
					$.ajax({
						url : home_url + "user_login",
						type : "POST",
						data : {
							'user_id' : userid,
							'user_name' : user_name,
							'user_email' : user_email,
							'user_mobile' : user_contact_no,
							'user_wallet' : user_wallet,
							'user_password' : user_password,
							'login_type' : login_type

						},
						success : function(data) {
						
							var rec_category=localStorage.getItem("rec_category");
							var wt_category=localStorage.getItem("wt_category");
								
							if(wt_category=='2'){
							if(rec_category==1)
							{
								var prepaid=localStorage.getItem("mobile_type");
								var mobile_topup = localStorage.getItem("mobile_topuptype");
								var mobile=localStorage.getItem("mobileno");
								var mobile_amount=localStorage.getItem("mobile_amount");
								var operator_id=localStorage.getItem("operator_id");
								var send_data= home_url + "recharge_details?mobile=" + mobile + "&mobile_topup=" + mobile_topup + "&mobile_operator_id=" + operator_id + "&mobile_amount=" + mobile_amount;
								location.href = send_data;
							}else if(rec_category==2)
							{
								var tv_number=localStorage.getItem("tv_rec_number");
								var tv_rec_amount=localStorage.getItem("tv_rec_amount");
								var tv_operator_id=localStorage.getItem("tv_operator_id");
								var send_data= home_url + "recharge_details?mobile=" + tv_number+ "&mobile_operator_id=" + tv_operator_id + "&mobile_amount=" + tv_rec_amount;
								location.href = send_data;
							}else if(rec_category==3)
							{
								var data_card_number=localStorage.getItem("data_card_number");
								var data_operator_id=localStorage.getItem("data_operator_id");
								var data_rec_amount=localStorage.getItem("data_rec_amount");
								var send_data= home_url + "recharge_details?mobile=" + data_card_number+ "&mobile_operator_id=" + data_operator_id + "&mobile_amount=" + data_rec_amount;
								location.href = send_data;
							}
							}
							else if(wt_category=='11')
							{
							var biller_category_id=localStorage.getItem("biller_category_id");
							var biller_service_id=localStorage.getItem("biller_service_id");
							var consumer_number=localStorage.getItem("consumer_number");
							var send_data= home_url + "pay_bill?i_n=" + consumer_number + "&biller_category_id=" + biller_category_id + "&biller_service_id=" + biller_service_id;
						     location.href = send_data;
						    }else if(wt_category=='12')
							{
							var electric_card_number=localStorage.getItem("electric_card_number");
							var electricty_operator_id=localStorage.getItem("electricty_operator_id");
							var electrice_amount=localStorage.getItem("electrice_amount");
							var customer_name = localStorage.getItem("electricity_customer_name");
							var send_data= home_url + "recharge_details?mobile=" + electric_card_number + "&mobile_operator_id=" + electricty_operator_id + "&mobile_amount=" + electrice_amount+"&cn="+customer_name;
								location.href = send_data;
							}else if(wt_category=='13'){
							
							var church_price=localStorage.getItem("church_price");
							var church_area=localStorage.getItem("church_area");
							var church_id=localStorage.getItem("church_id");
							var church_price_id=localStorage.getItem("church_price_id");
							var church_category_id=localStorage.getItem("church_cat_id");
								var send_data = home_url + "church_recharge?church_price=" + church_price + "&church_category_id=" +church_category_id+ "&church_id=" + church_id+ "&church_p_id=" + church_price_id+ "&church_area=" + church_area;
									location.href = send_data;
							}else if(wt_category=='16'){
							var ticket_amount=localStorage.getItem("ticket_amount");
							var ticket_json_array=localStorage.getItem("ticket_json_array");
							var event_id=localStorage.getItem("event_id");
						
								var send_data = home_url + "event_booking?event_ticket_price=" + ticket_amount + "&event_id=" +event_id+ "&ticket_json_array=" + ticket_json_array;
									location.href = send_data;
							}
							else{
								toastr.success("Login Successfully",'Success');
								location.href = home_url + "my_account";
							}
						}
					});
				} else if (status == 'false') {
					$("#login_mob_error").removeClass("errormsg");
					$("#login_mob_error").text('');
					$("#login_pass_error").removeClass("errormsg");
					$("#login_pass_error").text('');
					$("#login_response_failed").addClass("erro-new-msg");
					$("#login_response_failed").text(message);
					
				} else if (status == 'not_verify') {

					$("#mb_number").val(mobile);
					$("#mob").val(mobile);
					$('#LoginModal').modal('hide');
					$('#verification-modal').modal();
				}
			}

		}
	});
	}
	}else{
		$("#login_response_failed").addClass("erro-new-msg");
		$("#login_response_failed").text("Please Enter Email and password");
	}
}

//Logout
function Logout()
{
	if(confirm('Are you sure, You want logout?'))
	{

		localStorage.setItem("mobileno","");
		localStorage.setItem("mobileno","");
		localStorage.setItem("rec_category",'');
		localStorage.setItem("wt_category",'');
		localStorage.clear();
		location.href = home_url +"logout";
 }
}
function check_signup_number() {
	var user_mobile = $("#user_mobile_no").val();
	if (user_mobile == '') {
		$("#signup_mob_error").addClass("errormsg");
		$("#signup_mob_error").text('Please Enter a valid number');
	}else
	if (isNaN(user_mobile)) {
		$("#signup_mob_error").addClass("errormsg");
		$("#signup_mob_error").text('Please Enter a valid number');
	}else
	if (user_mobile.length < 11 || user_mobile.length > 11) {
		$("#signup_mob_error").addClass("errormsg");
		$("#signup_mob_error").text('Please Enter a 11 digit mobile number');
	}else{
		$("#signup_mob_error").removeClass("errormsg");
		$("#signup_mob_error").text('');
	}

}
function check_email() {
	var user_email = $("#user_email").val();
	if (user_email != '') {
		if (validateEmail(user_email)) {
			$("#signup_email_error").removeClass("errormsg");
			$("#signup_email_error").text('');
		} else {
			$("#signup_email_error").addClass("errormsg");
			$("#signup_email_error").text('Please Enter a Valid Email');

		}
	} else {
			$("#signup_email_error").removeClass("errormsg");
			$("#signup_email_error").text('');
	}
	function validateEmail(sEmail) {
		var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
		if (filter.test(sEmail)) {
			return true;
		} else {
			return false;
		}
	}

}


	function check_password() {

		var user_password = $("#user_pass").val();
		if (user_password == '') {
			$("#signup_pass_error").addClass("errormsg");
			$("#signup_pass_error").text('Please Enter 4 Digit Password.');
		}else if (user_password.length < 4 || user_password.length >4) {
			$("#signup_pass_error").addClass("errormsg");
			$("#signup_pass_error").text('Please length should be 4 digit.');
		}else if (isNaN(user_password)) {
			$("#signup_pass_error").addClass("errormsg");
			$("#signup_pass_error").text('Please enter number.');
		}else if ( isIncreasingSequence( user_password.split("") ) ) {
			$("#signup_pass_error").addClass("errormsg");
			$("#signup_pass_error").text('Password should not in sequence.');
		}else{
			$("#signup_pass_error").removeClass("errormsg");
			$("#signup_pass_error").text('');
		}
		$("#reffer_code").removeClass("errormsg");
		$("#reffer_code").text('');
	}


	function isIncreasingSequence(numbers) {

	  /**Check if numbers sequence is increasing
	  * @param {number} numbers - a sequence of input numbers;
	  * @return {boolean} - true if given sequence is increasing, false othrewise
	  */
	  let numArr = Array.prototype.slice.call(numbers);


	  let truthArray = [];

	  for (var num = 0; num < numArr.length; num++) {
	    while (numArr[num + 1] !== undefined) {
	      if (numArr[num] < numArr[num + 1]) {
	        truthArray.push(true);
	      } else {
	        truthArray.push(false);
	      }
	      num++
	    }
	  }

	  if (truthArray.includes(false)) {
	    return false;
	  } else {
	    return true;
	  }
}



function check_reffer_code() {
	var reffer_code = $("#reffer_code").val();
	if(reffer_code!=''){
	$.ajax({
		url : base_url + "check_reffer_code",

		type : "POST",
		data : {
			'reffer_code' : reffer_code

		},
		success : function(data) {
			var getdata = jQuery.parseJSON(data);
			var status = getdata.status;
			var message = getdata.message;
			if (status == 'true') {
				$("#signup_ref_error").removeClass("errormsg");
				$('#signup_ref_error').text(message);

			} else {
				$("#signup_ref_error").addClass("errormsg");
				$('#signup_ref_error').text(message);
			}
		}
	});
	}
}
// check electricity number
function check_electric_number(number)
{
	 electricity_number = number;
	var electricty_operator_id=$("#electricty_operator_id").val();

	$.ajax({
		url : base_url + "check_electricty_number",
		type : "POST",
		data : {
			'electricity_number' : electricity_number,
			'electricty_operator_id' : electricty_operator_id

		},
		success : function(data) { 
		if(data)
			{
				
			   $("#electricity_customer_name").val(data);
			}else{
				
				$("#electricity_customer_name").val("Enter valid Meter / Account number");
			}
				
			}
		
	});
}
function signup_user() {

	function validateEmail(sEmail) {
		var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
		if (filter.test(sEmail)) {
			return true;
		} else {
			return false;
		}
	}

	var user_mobile = $("#user_mobile_no").val();
	var reffer_code = $("#reffer_code").val();
	var user_email = $("#user_email").val();
	var user_password = $("#user_pass").val();
	if (user_mobile == '') {
		$("#signup_mob_error").addClass("errormsg");
		$("#signup_mob_error").text('Please Enter Mobile Number');
	} else if (isNaN(user_mobile)) {
		$("#signup_mob_error").addClass("errormsg");
		$("#signup_mob_error").text('Please Enter a valid number');
	} else if (user_mobile.length < 11 || user_mobile.length > 11) {
		$("#signup_mob_error").addClass("errormsg");
		$("#signup_mob_error").text('Please Enter a 11 digit number');
	}
	else if (user_email == '') {
		$("#signup_mob_error").removeClass("errormsg");
		$("#signup_mob_error").text('');
		$("#signup_email_error").addClass("errormsg");
		$("#signup_email_error").text('Please Enter email account');
	} 
	else if (user_password.length < 4 || user_password.length >4) {
		$("#signup_mob_error").removeClass("errormsg");
		$("#signup_mob_error").text('');
		$("#signup_email_error").removeClass("errormsg");
		$("#signup_email_error").text('');
		$("#signup_pass_error").addClass("errormsg");
		$("#signup_pass_error").text('Please Enter 5 Digit Passwordr');
	} else if (isNaN(user_password)) {
		$("#signup_mob_error").removeClass("errormsg");
		$("#signup_mob_error").text('');
		$("#signup_email_error").removeClass("errormsg");
		$("#signup_email_error").text('');
		$("#signup_pass_error").addClass("errormsg");
		$("#signup_pass_error").text('Please Enter 5 Digit Passwordr');
	}else  {
		$("#signup_mob_error").removeClass("errormsg");
		$("#signup_mob_error").text('');
		$("#signup_email_error").removeClass("errormsg");
		$("#signup_email_error").text('');
		$("#signup_pass_error").removeClass("errormsg");
		$("#signup_pass_error").text('');
		$("#signup_error").removeClass("errormsg");
		$.ajax({
			url : base_url + "signup",

			type : "POST",
			data : {
				'user_mobile_no' : user_mobile,
				'user_email' : user_email,
				'user_password' : user_password
			},
			success : function(data) {
				var getdata = jQuery.parseJSON(data);
				var status = getdata.status;
				var user_id = getdata.user_id;
				var msg_status = getdata.email_already;
				var message = getdata.message;
				
				if (status == 'true') {
					$("#mb_number").val(user_mobile);
					$("#mob_num_hidden").val(user_mobile);
					$("#user_mobile_number").text(user_mobile);
					$("#user_reffer_code").val(reffer_code);
					$("#user_signup_id").val(user_id);
					$('#SignupModal').modal('hide');
					$('#LoginModal').modal('hide');
					$('#verification-modal').modal();
				} else 
					if (status == 'not_verify') {
						$("#mob").text(user_mobile);
						$("#user_mobile_number").text(user_mobile);
						$("#mb_number").val(user_mobile);
						$("#mob_num_hidden").val(user_mobile);
						$('#SignupModal').modal('hide');
						$('#LoginModal').modal('hide');
						$('#verification-modal').modal();
						$("#mob_num_hidden").val(user_mobile);
					}else{
						$("#signup_mob_error").removeClass("errormsg");
						$("#signup_mob_error").text('');
						
					}
					 
					
					if (msg_status == '1') {
						$("#signup_mob_error").addClass("errormsg");
						$("#signup_mob_error").text(message);
					} else if (msg_status == '2') {
							$("#signup_email_error,#signup_mob_error").addClass("errormsg");
							$("#signup_mob_error").text(message);
						$("#signup_email_error").text(message);
					}

				
			}
		});

	} 
}
// function confirm_number
function confirm_number()
{

	var mb_number = $("#mob_num_hidden").val();

	var otp_code = $("#verification-code").val();
	var reffer_code = $("#user_reffer_code").val();
	if (otp_code != '' && otp_code != null) {

		$.ajax({
			url : base_url + "verification",

			type : "POST",
			data : {
				'user_mobile_no' : mb_number,
				'user_verification_code' : otp_code,
				'user_reffer_code' : reffer_code
			},
			success : function(data) {
				var getdata = jQuery.parseJSON(data);
				var status = getdata.status;
				var message = getdata.message;
				var user_id = getdata.user_id;
				var user_name = getdata.user_name;
				var login_type = getdata.login_type;
				var user_email = getdata.user_email;
				var user_contact_no = mb_number;
				var user_wallet = 0;
				if (status == 'true') {
					$('#verification-modal').modal('hide');
					$('#upgrate').modal('hide');

					if (login_type == '1') {

						$.ajax({
							url : site_url + "user_login",
							type : "POST",
							data : {
								'user_id' : user_id,
								'user_wallet' : user_wallet,
								'login_type' : login_type,
								'reffer_code' : reffer_code

							},
							success : function(data) {
								setInterval(function() {
									complete_signup()
								}, 1000);
								//	location.href=site_url;
							}
						});
					} else if (login_type == '3') {
						$.ajax({
							url : site_url + "g_login",
							type : "POST",
							data : {
								'user_id' : user_id,
								'user_email' : user_email,
								'user_name' : user_name
							},
							success : function(data) {
								setInterval(function() {
									complete_signup()
								}, 1000);
								//location.href=site_url;
							}
						});
					} else {
						location.href = site_url;

					}
					//location.href='https://oyacharge.com/';

					//location.href=site_url+"index?verify=" + 1+"user_id=" + user_id

				} else if (status == 'false') {
					$("#login_otp_error").addClass("errormsg");
					$("#login_otp_error").text(message);
				}
			}
		});
	} else {
		$("#otp_code").attr('style', 'border-color: red');
		$("#otp_msg").text('Please Enter OTP Code');
	}
}
function complete_signup()
{
							var rec_category=localStorage.getItem("rec_category");
							var wt_category=localStorage.getItem("wt_category");
						if(wt_category=='2'){
							if(rec_category==1)
							{
								var mobile_topup = localStorage.getItem("mobile_topuptype");
								var prepaid=localStorage.getItem("mobile_type");
								var mobile=localStorage.getItem("mobileno");
								var mobile_amount=localStorage.getItem("mobile_amount");
								var operator_id=localStorage.getItem("operator_id");
								var send_data= home_url + "recharge_details?mobile=" + mobile + "&mobile_topup=" + mobile_topup + "&mobile_operator_id=" + operator_id + "&mobile_amount=" + mobile_amount;
								location.href = send_data;
							}else if(rec_category==2)
							{
								var tv_number=localStorage.getItem("tv_rec_number");
								var tv_rec_amount=localStorage.getItem("tv_rec_amount");
								var tv_operator_id=localStorage.getItem("tv_operator_id");
								var send_data= home_url + "recharge_details?mobile=" + tv_number+ "&mobile_operator_id=" + tv_operator_id + "&mobile_amount=" + tv_rec_amount;
								location.href = send_data;
							}else if(rec_category==3)
							{
								var data_card_number=localStorage.getItem("data_card_number");
								var data_operator_id=localStorage.getItem("data_operator_id");
								var data_rec_amount=localStorage.getItem("data_rec_amount");
								var send_data= home_url + "recharge_details?mobile=" + data_card_number+ "&mobile_operator_id=" + data_operator_id + "&mobile_amount=" + data_rec_amount;
								location.href = send_data;
							}
							}else if(wt_category=='11')
							{
							var biller_category_id=localStorage.getItem("biller_category_id");
							var biller_service_id=localStorage.getItem("biller_service_id");
							var consumer_number=localStorage.getItem("consumer_number");
							var send_data= home_url + "pay_bill?i_n=" + consumer_number + "&biller_category_id=" + biller_category_id + "&biller_service_id=" + biller_service_id;
						     location.href = send_data;
							}else if(wt_category=='12')
							{
							var electric_card_number=localStorage.getItem("electric_card_number");
							var electricty_operator_id=localStorage.getItem("electricty_operator_id");
							var electrice_amount=localStorage.getItem("electrice_amount");
							var send_data= home_url + "recharge_details?mobile=" + electric_card_number + "&mobile_operator_id=" + electricty_operator_id + "&mobile_amount=" + electrice_amount;
						     location.href = send_data;
							}else if(wt_category=='13'){
							
							var church_price=localStorage.getItem("church_price");
							var church_area=localStorage.getItem("church_area");
							var church_id=localStorage.getItem("church_id");
							var church_price_id=localStorage.getItem("church_price_id");
							var church_category_id=localStorage.getItem("church_cat_id");
								var send_data = home_url + "church_recharge?church_price=" + church_price + "&church_category_id=" +church_category_id+ "&church_id=" + church_id+ "&church_p_id=" + church_p_id+ "&church_area=" + church_area;
									location.href = send_data;
							}else if(wt_category=='16'){
							var ticket_amount=localStorage.getItem("ticket_amount");
							var ticket_json_array=localStorage.getItem("ticket_json_array");
							var event_id=localStorage.getItem("event_id");
						
								var send_data = home_url + "event_booking?event_ticket_price=" + ticket_amount + "&event_id=" +event_id+ "&ticket_json_array=" + ticket_json_array;
									location.href = send_data;
							}
							else{
							location.href = home_url + "my_account";
							}
}
function recharge_plan() {
	$("#plan_category_list").html('');
	$("#data_num_error").text('');
	$("#error_dth_recharge").text("");

	var recharge_category = $("#rec_category").val();

	//var plan_operator_id = '';
	var mobile_operator_id = $("#mobile_operator_id option:selected").val();
		
	//var data_operator_id = $("#datacard_operator_id").val();
  	var dth_operator_id = $("#dth_operator_id option:selected").val();
  	var mobile_topuptype='';
	var plan_operator_id='';
	if (recharge_category=='1') {
		var plantypename="Mobile";
		plan_operator_id = mobile_operator_id;
		 mobile_topuptype= $('input[name=optionsRadios]:checked').val();

	};
	if (recharge_category=='2') {
		var plantypename="DTH";
		plan_operator_id = dth_operator_id;
	}
		// else if (data_operator_id) {
	//	var plan_type = '3';
	//}

	var mobile = $("#mobileno").val();
	$.ajax({
		url : base_url + "plan_category_listing",
		type : "POST",
		data : {
			'recharge_category' : recharge_category,
			'operator_id' : plan_operator_id,
			'mobile_topuptype':mobile_topuptype
		},
		success : function(data) { 
		$("#plan_type_name").text(plantypename);
		var getdata = jQuery.parseJSON(data);
			var status = getdata.status;
			// $("#plan_dynamic_id").val(value.default_plan_category);
			if (status == 'true') {
				var html = '';
				var html1 = '';
				var lm=0;
				if(mobile_topuptype!='' && mobile_topuptype==2)
				{
					html1 += '<li role="presentation" class=""><a style="cursor:pointer">DATA BUNDLE PLANS</a></li>';
				}else{
					$.each(getdata.plan_category, function(key, value) {
					if(lm=='0'){
						html1 += '<li role="presentation" class="active"><a  onclick="change_plan(' + value.plan_category_id + ')" style="cursor:pointer">' + value.plan_category_name + '</a></li>';
					}else{
						html1 += '<li role="presentation" class=""><a  onclick="change_plan(' + value.plan_category_id + ')" style="cursor:pointer">' + value.plan_category_name + '</a></li>';
					}
					lm++;

				 });
				}
			
				$.each(getdata.recharge_details, function(key, value) {
					var recommended = value.plan_category_name;
					$("#plan_type_name").text(value.operator_name);
					//   if(recommended=='Recommended'){
					html += '<a  onclick="get_amount(' + value.recharge_amount + ',' + recharge_category + ')"><div class="plan_list">';
					html += '<div class="plan_rate">₦<span id="select_amount"0>' + value.recharge_amount + '</span></div>';
					html += '<div class="plan_details"><p><span class="operator_name">' + value.operator_name + '</span> GSM ' + value.recharge_data_pack + '</p>';
					if(mobile_topuptype==2)
					{
						html += '<p class="pull-left">' + value.recharge_validity + ' Days Validity | ' + value.recharge_desc + '</p> </div>';
					}else{
						html += '<p class="pull-left">' + value.recharge_validity + ' Days Validity | ' + value.recharge_desc + '</p> <p class="pull-right"> Talktime | ' + value.recharge_talktime + '</p></div>';
					}
					

					html += '<div class="clearfix"></div></div></div></a>';
					//  }

				});
				
				if(recharge_category=='1')
				{
					$("#cat").show();
				$("#plan_category_list").html(html1);
				$("#Recommende").html(html);
				$('#viewPlanmobile').modal();
				}else if(recharge_category=='2')
				{
					
					$("#tvplan_category_list").html(html1);
					$("#tvRecommende").html(html);
					$('#viewPlanTv').modal();
				}
			}
		}
	});


	//$("#rec_category").val('');
}
// plan list from api
function plan_list()
{
	
	var plan_operator_id = '';
	var mobile_operator_id = $("#mobile_operator_id").val();
	var data_operator_id = $("#datacard_operator_id").val();
	var dth_operator_id = $("#dth_operator_id").val();

	if (mobile_operator_id) {

		plan_operator_id = mobile_operator_id;
		var plan_type = '1';
		var plantypename="Mobile";
	}
	if (dth_operator_id) {
		$("#dth_amt_error").removeClass("errormsg");
		plan_operator_id = dth_operator_id;
		var plan_type = '2';
		var plantypename="DTH";
	}
	if (data_operator_id) {
		plan_operator_id = data_operator_id;
		var plan_type = '3';
		var plantypename="Datacard";
	}
	/*
	if (mobile_operator_id) {
			var plan_type = '1';
		} else if (dth_operator_id) {
			var plan_type = '2';
		} else if (data_operator_id) {
			var plan_type = '3';
		}*/
	
	var service_id=$("#service_id").val();
	if(service_id=='AQA')
	{
		var api_name='dstv_plan';
		
	}else{
		var api_name='get_tv_product_no';
		
	}
	$.ajax({
		url : base_url + api_name,
		type : "POST",
		data : {
			'service_id' : service_id
		},
		success : function(data) { 
			$("#cat").hide();
			$("#plan_type_name").text(plantypename);
			$("#viewPlanmobile").modal();
			var getdata = jQuery.parseJSON(data);
			var status = getdata.status;
			//$("#dthoperator_name").text(getdata.operator_name);
			// $("#plan_dynamic_id").val(value.default_plan_category);
		
				var html = '';
				var html1 = '';
				var i=0;
				$.each(getdata.plans, function(key, value) { 
					if(value.service_id=='AQA')
					{
		
					var validity=value.validity;
					}else{
		
					var validity=value.invoicePeriods[0];
					}
					
					html += '<a href="#" onclick="get_amount(' + value.price + ',' + plan_type + ',&quot;' + value.code + '&quot;)" ><div class="plan_list">';
					html += '<div class="plan_rate" >₦<span id="select_amount">' + value.price + '</span></div>';
					html += '<div class="plan_details"><p><span class="operator_name">' + value.name + '</span> </p>';
					html += '<p class="pull-left">' +validity  + ' Month validity | </p> <p class="pull-right">  ' + value.name + '</p></div>';

					html += '<div class="clearfix"></div>';
					
					html += '<div class="addonce-conent"></div></div></div></div></a>';
					
i++;
				});
				$("#plan_category_list").html(html1);
				$("#Recommende").html(html);

			
		}
	});
}
// change plan 
function change_plan(plan_category_id) {
	var plan_operator_id = '';
	var mobile_operator_id = $("#mobile_operator_id").val();
	var data_operator_id = $("#datacard_operator_id").val();
	var dth_operator_id = $("#dth_operator_id").val();

	if (mobile_operator_id) {

		plan_operator_id = mobile_operator_id;
		var plan_type = '1';
		var plantypename="Mobile";
	}
	if (dth_operator_id) {

		plan_operator_id = dth_operator_id;
		var plan_type = '2';
		var plantypename="DTH";
	}
	if (data_operator_id) {
		plan_operator_id = data_operator_id;
		var plan_type = '3';
		var plantypename="Datacard";
	}
	var mobile = $("#mobileno").val();

	$.ajax({
		url : base_url + "recharge_plan",
		type : "POST",
		data : {
			'operator_id' : plan_operator_id,
			'plan_category_id' : plan_category_id
		},
		success : function(data) {

			var getdata = jQuery.parseJSON(data);
			var status = getdata.status;
			if (status == 'true') {
				var html = '';

				$("#plan_type_name").text(getdata.operator_name);
				$.each(getdata.recharge_details, function(key, value) {
					$("#operator_name").text(value.operator_name);
					if (plan_category_id == value.plan_category_id) {
						html += '<a href="#" onclick="get_amount(' + value.recharge_amount + ',' + plan_type + ',' + plan_type + ')"><div class="plan_list">';
						html += '<div class="plan_rate">₦<span id="select_amount">' + value.recharge_amount + '</span></div>';
						html += '<div class="plan_details"><p><span class="operator_name">' + value.operator_name + '</span> GSM ' + value.recharge_data_pack + '|' + value.recharge_desc + ' </p>';
						if (value.recharge_talktime) {
							html += '<p class="pull-left">' + value.recharge_validity + 'Validity</p> <p class="pull-right"> Talktime | ' + value.recharge_talktime + '</p></div>';
						}
						html += '<div class="clearfix"></div></div></div></a>';

					}

				});
				$("#Recommende").html(html);
			} else if (status == 'false') {

				$("#operator_name").text("No Plans are avalible");
				$("#Recommende").html('');
			}

		}
	});
}
// set amount in mobile amount
function get_amount(amount,plan_type,code) {
	
	if (plan_type == '1') {
		$("#mobile_recharge_amount").val(amount);
		$('#viewPlanmobile').modal('hide');
	} else if (plan_type == '3') {
		$("#datacard_amount").val(amount);
		$("#datacard_typecode").val(code);
		$('#viewPlanTV').modal('hide');
	} else if (plan_type == '2') {
		$("#tv_rec_amount").val(amount);
		$("#tv_rec_code").val(code);
		$("#viewPlanTV").removeClass("in");
		//$("#viewPlanTV .close").click();
	}

	
}

// plan list from api of data card
function data_plan()
{
	
//	var data_operator_id = '';
	var data_card_number = $("#data_card_number").val();
	var datacard_operator_id = $("#datacard_operator_id").val();

	
	$.ajax({
		url : base_url + "validate_data_number",
		type : "POST",
		data : {
			'data_operator_id' : datacard_operator_id,
			'data_number':data_card_number
		},
		success : function(data) {
			loader_start();
			var getdata = jQuery.parseJSON(data);
			var status = getdata.status;
			
			$("#operator_name").text(getdata.operator_name);
				var html = '';
				if(getdata.plans!=null){
					$("#plan_type_name").text("Data Card");
						$("#cat").hide();
					$("#viewPlanmobile").modal();
				$.each(getdata.plans, function(key, value) { 
					
					html += '<a href="#" onclick="get_amount(' + value.amount + ',3,' + value.typeCode + ')"><div class="plan_list">';
					html += '<div class="plan_rate">₦<span id="select_amount">' + value.amount + '</span></div>';
					html += '<div class="plan_details"><p><span class="operator_name">' + value.description + '</span> </p>';
					

					html += '<div class="clearfix"></div></div></div></a>';
					//  }

				});
				$("#Recommende").html(html);
				}else{
					$("#data_num_error").addClass("erro-new-msg");
					$("#data_num_error").text('No Plans Found!');
					//$("#data_num_error").text('No Plan Found');
				}
			
					

			
		}
	});
}
function loader_start()
{
	  $(window).load(function() {
                $('#preloader').fadeOut('slow', function() {
                    $(this).remove();
                });

            });

}
// function dth recharge
function dth_recharge()
{
	
		$("#error_mobile_recharge").text("");
		$("#data_num_error").text('');
		var rec_category		=	$("#rec_category").val();
		var tv_operator_id = $("#dth_operator_id").val();
		var tv_number=$("#tv_number").val();
		var tv_rec_amount = $("#tv_rec_amount").val();
		if(tv_operator_id=='')
		{
			$("#dth_operator_error").addClass("errormsg");
			$("#dth_operator_error").text("Please Select operator");
		
		}else if(tv_number=='')
		{
			$("#dth_amt_error").removeClass("errormsg");
			$("#dth_amt_error").text("");
			$("#dth_operator_error").removeClass("errormsg");
			$("#dth_operator_error").text("");
			$("#dth_num_error").addClass("errormsg");
			$("#dth_num_error").text("Please Enter DTH Number");
			
		}else if(tv_rec_amount=='')
		{
			$("#dth_amt_error").removeClass("errormsg");
			$("#dth_amt_error").text("");
			$("#dth_num_error").removeClass("errormsg");
			$("#dth_num_error").text("");
			$("#dth_amt_error").addClass("errormsg");
			$("#dth_amt_error").text("Please Enter Recharge Amount");
		
		}else{
			$("#dth_amt_error").removeClass("errormsg");
			$("#dth_amt_error").text("");
			$("#dth_num_error").removeClass("errormsg");
			$("#dth_num_error").text("");
			$("#dth_amt_error").removeClass("errormsg");
			$("#dth_amt_error").text("");
			$("#error_dth_recharge").removeClass("errormsg");
			var tv_rec_code = $("#tv_rec_code").val();
			var tv_number_name = $("#tv_number_name").val();
			localStorage.setItem("tv_rec_code",tv_rec_code);
			localStorage.setItem("tv_number_name",tv_number_name);
		//	localStorage.setItem("tv_customer_no",tv_number);
			$.ajax({
				url : home_url + "check_login",
				type : "POST",
				data : {
					'tv_number' : tv_number,
					'tv_operator_id' : tv_operator_id,
					'tv_rec_amount' : tv_rec_amount,
					'rec_category':rec_category,
					'wt_category':'2'
				},
				success : function(data) { 
					
					
						localStorage.setItem("tv_rec_number",tv_number);
						localStorage.setItem("tv_rec_amount",tv_rec_amount);
						localStorage.setItem("tv_operator_id",tv_operator_id);
						localStorage.setItem("rec_category",rec_category);
						localStorage.setItem("wt_category",'2');
					if (data == '2') {
						$('#LoginModal').modal();
					} else if (data == '1') {
						//location.href = home_url + "recharge_details?mobile";
						//var send_data= home_url + "recharge_details?mobile="+tv_number+ "&mobile_operator_id="+tv_operator_id+"&mobile_amount="+tv_rec_amount;
						var send_data= home_url + "recharge_details?mobile=" + tv_number+ "&mobile_operator_id=" + tv_operator_id + "&mobile_amount=" + tv_rec_amount;
								location.href = tv_rec_amount;
						location.href = send_data;
					}
				}
			});
		}
		
		
}
// datacard_recharge
function datacard_recharge(user_type)
{
		$("#error_mobile_recharge").text("");
		$("#error_dth_recharge").text("");
		var data_card_number = $("#data_card_number").val();
		var data_rec_amount = $("#datacard_amount").val();
		var datacard_operator_id = $("#datacard_operator_id").val();
		if(datacard_operator_id=='')
		{
			$("#data_oper_error").addClass("errormsg");
			$("#data_oper_error").text("Please Select operator");
			$("#data_number_error").removeClass("errormsg");
			$("#data_number_error").text("");
			$("#data_amt_error").removeClass("errormsg");
			$("#data_amt_error").text("");
		}else if(data_card_number=='')
		{
			$("#data_number_error").addClass("errormsg");
			$("#data_number_error").text("Please Enter Datacard Number");
			$("#data_oper_error").removeClass("errormsg");
			$("#data_oper_error").text("");
			$("#data_amt_error").removeClass("errormsg");
			$("#data_amt_error").text("");
			
		}else if(data_rec_amount=='')
		{
			
			$("#data_amt_error").addClass("errormsg");
			$("#data_amt_error").text("Please Enter Recharge Amount");
			$("#data_number_error").removeClass("errormsg");
			$("#data_number_error").text("");
			$("#data_oper_error").removeClass("errormsg");
			$("#data_oper_error").text("");
		}else{
			$("#data_amt_error").removeClass("errormsg");
			$("#data_amt_error").text("");
			$("#data_number_error").removeClass("errormsg");
			$("#data_number_error").text("");
			$("#data_oper_error").removeClass("errormsg");
			$("#data_oper_error").text("");
			$("#data_num_error").removeClass("errormsg");
		var data_code=$("#datacard_typecode").val();
		localStorage.setItem("tv_rec_code",data_code);
		var rec_category		=	$("#rec_category").val();
		if(user_type=='1')
		{
			$.ajax({
				url : home_url + "check_login",
				type : "POST",
				data : {
					'data_card_number' : data_card_number,
					'data_operator_id' : datacard_operator_id,
					'data_rec_amount' : data_rec_amount,
					'rec_category':rec_category,
					'wt_category':'2'

				},
				success : function(data) {
				
						
						localStorage.setItem("data_card_number",data_card_number);
						localStorage.setItem("data_rec_amount",data_rec_amount);
						localStorage.setItem("data_operator_id",datacard_operator_id);
						localStorage.setItem("rec_category",rec_category);
						localStorage.setItem("wt_category",'2');
					if (data == '2') {
						$('#LoginModal').modal();
					} else if (data == '1') {
						//location.href = home_url + "recharge_details?mobile";
					var send_data= home_url + "recharge_details?mobile=" + data_card_number+ "&mobile_operator_id=" + datacard_operator_id + "&mobile_amount=" + data_rec_amount;
						location.href = send_data;
					}
				}
			});
		}else if(user_type=='2')
		{
				localStorage.setItem("d_c_num",data_card_number);
				localStorage.setItem("d_rec_amt",data_rec_amount);
				localStorage.setItem("d_o_id",datacard_operator_id);
				localStorage.setItem("rec_cat",rec_category);
				localStorage.setItem("wt_cat",'2');
				$('#quickpay').modal();
		}
	}
}
function fb_login() {
	$("#overlay").addClass('active');
	$("#overlay").hide();
	$('#loginPop').modal('hide');
	//$("#loader").css('display','block');
	FB.login(function(response) {
		if (response.status === 'connected') {

			FB.api('/me?fields=id,name,email,first_name,last_name', function(response) {
				var getdata = JSON.stringify(response);
				var getdata = jQuery.parseJSON(getdata);
				var social_id = getdata.id;
				var first_name = getdata.first_name;
				var last_name = getdata.last_name;
				var email = getdata.email;
				var login_type = '2';
				$.ajax({
					url : base_url + "social_login",
					'type' : 'POST',
					'data' : {
						'user_social_id' : social_id,
						'user_firstname' : first_name,
						'user_lastname' : last_name,
						'user_email' : email,
						'login_type' : login_type
					},
					'success' : function(data) {
						var wt_category=localStorage.getItem("wt_category");
						$("#overlay").hide();
						var getdata = jQuery.parseJSON(data);
						var status = getdata.status;
						var message = getdata.message;
						var verify_status = getdata.verify_status;
						var user_id = getdata.user_id;
						//$("#userid").val(user_id);
						var mobile = getdata.user_contact_no;
						var user_name = getdata.user_name;
						var user_name = getdata.user_name;
						var frnd_refferal_code = getdata.frnd_refferal_code;
						var user_pin_status = getdata.user_pin_status;

						var user_wallet = '0';
					
						if (status == 'true') {
							$.ajax({
								url : home_url + "fb_login",
								type : "POST",
								data : {
									'userid' : user_id,
									'user_name' : user_name,
									'user_email' : email,
									'user_wallet' : user_wallet,
									'login_type' : login_type,
									'verify_status' : verify_status,
									'frnd_reffer_code' : frnd_refferal_code,
									'user_pin_status' : user_pin_status,
									'wt_category':wt_category

								},
								success : function(data) {
									
								if (verify_status == '2') {
								$('#LoginModal').modal('hide');
								$("#mob_user_id").val(user_id);
								$('#changenumber-modal').modal();
								//	setInterval(function(){upgrade_pop()}, 1000);
							} else {
									$('#LoginModal').modal('hide');
									var rec_category=localStorage.getItem("rec_category");
									
									if(wt_category=='2'){
							if(rec_category==1)
							{
								
								var prepaid=localStorage.getItem("mobile_type");
								var mobile=localStorage.getItem("mobileno");
								var mobile_amount=localStorage.getItem("mobile_amount");
								var operator_id=localStorage.getItem("operator_id");
								var send_data= home_url + "recharge_details?mobile=" + mobile + "&prepaid=" + prepaid + "&mobile_operator_id=" + operator_id + "&mobile_amount=" + mobile_amount;
								location.href = send_data;
							}else if(rec_category==2)
							{
								var tv_number=localStorage.getItem("tv_rec_number");
								var tv_rec_amount=localStorage.getItem("tv_rec_amount");
								var tv_operator_id=localStorage.getItem("tv_operator_id");
								var send_data= home_url + "recharge_details?mobile=" + tv_number+ "&mobile_operator_id=" + tv_operator_id + "&mobile_amount=" + tv_rec_amount;
								location.href = send_data;
							}else if(rec_category==3)
							{
								var data_card_number=localStorage.getItem("data_card_number");
								var data_operator_id=localStorage.getItem("data_operator_id");
								var data_rec_amount=localStorage.getItem("data_rec_amount");
								var send_data= home_url + "recharge_details?mobile=" + data_card_number+ "&mobile_operator_id=" + data_operator_id + "&mobile_amount=" + data_rec_amount;
								location.href = send_data;
							}
							}else if(wt_category=='11')
							{
							var biller_category_id=localStorage.getItem("biller_category_id");
							var biller_service_id=localStorage.getItem("biller_service_id");
							var consumer_number=localStorage.getItem("consumer_number");
							var send_data= home_url + "pay_bill?i_n=" + consumer_number + "&biller_category_id=" + biller_category_id + "&biller_service_id=" + biller_service_id;
						     location.href = send_data;
							}else if(wt_category=='12')
							{
							var electric_card_number=localStorage.getItem("electric_card_number");
							var biller_service_id=localStorage.getItem("biller_service_id");
							var consumer_number=localStorage.getItem("consumer_number");
							var send_data= home_url + "recharge_details?mobile=" + electric_card_number + "&mobile_operator_id=" + electricty_operator_id + "&mobile_amount=" + electrice_amount;
						     location.href = send_data;
							}else if(wt_category=='13'){
							
							var church_price=localStorage.getItem("church_price");
							var church_area=localStorage.getItem("church_area");
							var church_id=localStorage.getItem("church_id");
							var church_price_id=localStorage.getItem("church_price_id");
							var church_category_id=localStorage.getItem("church_cat_id");
								var send_data = home_url + "church_recharge?church_price=" + church_price + "&church_category_id=" +church_category_id+ "&church_id=" + church_id+ "&church_p_id=" + church_price_id+ "&church_area=" + church_area;
								location.href = send_data;
							}else if(wt_category=='16'){
							var ticket_amount=localStorage.getItem("ticket_amount");
							var ticket_json_array=localStorage.getItem("ticket_json_array");
							var event_id=localStorage.getItem("event_id");
						
								var send_data = home_url + "event_booking?event_ticket_price=" + ticket_amount + "&event_id=" +event_id+ "&ticket_json_array=" + ticket_json_array;
									location.href = send_data;
							}
							else{
								
							location.href = home_url + "my_account";
							}
									//location.href = home_url;
									//location.href = home_url + "event_booking";	
								/*
								setInterval(function() {
																	profile()
																}, 1000);*/
								
							}
								}
							});

							//   $("#response_success").text(message);
							
						} else if (status == 'false') {
							$("#response_success").text(message);
						} else if (status == 'inactive') {
							$('#LoginModal').modal();
							$("#response_failed").text(message);
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
	}, {
		scope : 'public_profile,email'
	});
}
/// Apply Promocode////
function apply_promocode() {
	var amount = $("#recharge_amount").val();
	var user_id = $("#user_id").val();
	var promo_code = $("#promo_code").val();
	$.ajax({
		url : base_url + "apply_promocode",
		'type' : 'POST',
		'data' : {
			'promo_code' : promo_code,
			'user_id' : user_id

		},
		'success' : function(data) {
			var getdata = jQuery.parseJSON(data);
			var status = getdata.status;
			var message = getdata.message;
			if (status == 'true') {

				var coupon_amount = getdata.coupon_amount;
				var amount_price = getdata.amount_price;
				if (amount >= parseInt(amount_price)) {
					var coupon_id = getdata.coupon_id;

					$.ajax({
						url : home_url + "promocode_session",
						'type' : 'POST',
						'data' : {
							'coupon_amount' : coupon_amount,
							'coupon_id' : coupon_id

						},
						'success' : function(data) {

						}
					});

					$("#coupon_status").text(message);
					$("#coupon_amount").val(coupon_amount);
					$("#coupon_id").val(coupon_id);
					$("#coupon_status").removeClass("errormsg");
					$('#coupon_status').attr('style', 'color: green');
					$('#promo_code').attr('style', 'border-color: white');
					$('#amount').attr('style', 'border-color: white');
				} else {
					$("#coupon_status").addClass("errormsg");
					$('#amount').attr('style', 'border-color: red');
					$("#coupon_status").text('promocode apply with ₦ ' + amount_price);
				}

			} else if (status == 'false') {
				 $("#coupon_status").addClass("errormsg");
				 $("#coupon_status").text(message);
			}
		}
	});
}
// Send feddback////

function send_feedback() {

	var name = $("#name").val();
	var email = $("#email").val();
	var msg = $("#message").val();
	if (name != '' && email != '' && msg != '') {
		$.ajax({
			url : base_url + "user_feedback",
			type : "POST",
			data : {

				'user_name' : name,
				'user_email' : email,
				'user_msg' : msg
			},
			success : function(data) {

				var getdata = jQuery.parseJSON(data);
				var status = getdata.status;
				var message = getdata.message;
				if (status == 'true') {
					$("#name").val('');
					$("#email").val('');
					$("#message").val('');
					 $("#response_feedback").addClass("succe-new-msg");
					$("#response_feedback").text(message);
					setInterval(location.reload(), 15000);
				} else {
					$("#name").val('');
					$("#email").val('');
					$("#message").val('');
					 $("#response_feedback").addClass("erro-new-msg");
					$("#response_feedback").text(message);

					setInterval(location.reload(), 15000);
				}

			}
		});
	} else {
		 $("#response_feedback").addClass("erro-new-msg");
		$("#response_feedback").text("All Field are Required");
	}
}
// church part
function select_church(church_category_id)
{


	$.ajax({
		url : base_url + "church_list",

		type : "POST",
		data : {
			'church_category' : church_category_id

		},
		success : function(data) {
		var getdata = jQuery.parseJSON(data);
			var status = getdata.status;
			var html='';
			if(status=='true')
			{
				html = '<option value="">Select Church</option>';
				$.each(getdata.church_list, function(key, value) {
				var church_name = value.church_name;
				var church_id = value.church_id;
				var church_biller_id=value.church_biller_id;
				html += '<option value='+church_id+'>'+church_name+'</option>';
			});
			$("#church_id").html(html);
			}
			$("#biller_category_id").val(church_category_id);
		
		}
	});
}
function select_church_area(church_id)
{
	$.ajax({
		url : base_url + "church_area",

		type : "POST",
		data : {
			'church_id' : church_id

		},
		success : function(data) {
		var getdata = jQuery.parseJSON(data);
			var status = getdata.status;
			var html='';
			if(status=='true')
			{
				$("#church_selectedid").val(church_id);
				html = '<option value="">Select Church</option>';
				$.each(getdata.church_list, function(key, value) {
				var church_area = value.church_area;
				var church_area_id = value.church_area_id;
				var church_biller_id=value.church_biller_id;
				html += '<option value='+church_area_id+'>'+church_area+'</option>';
			});
			$("#church_area").html(html);
			}

		
		}
	});
}
function select_church_products(id)
{

	$.ajax({
			url : base_url + "church_donation_product",
			type : "POST",
			data : {
				'church_area_id' : id

			},
			success : function(data) {
				//$("#service_provider").modal();
				var getdata = jQuery.parseJSON(data);
				var html = '';
				//$("#church_p_id").val(getdata.c_product_id);
				//$("#church_price").val(getdata.church_p_price);
				html = '<option value="">Select Services</option>';
				$.each(getdata.product, function(key, value) {
					var product_id = value.product_id;
					var price = value.price;
					var product_name = value.product_name;
					if(price!='')
					{
						html += '<option value='+product_id+'>'+product_name+'('+price+')</option>';
					}else{
						html += '<option value='+product_id+'>'+product_name+'</option>';
					}
					
				
				});

				$("#church_donation_price").html(html);

			}
		});
}
function select_church_service(church_p_id)
{
	$.ajax({
			url : site_url + "select_church_services",
			type : "POST",
			data : {
				'church_p_id' : church_p_id

			},
			success : function(data) {
				if(data!='2'){
					$("#church_price").val(data);
					$("#church_price").attr("readonly", "true");
				}else{
					$("#church_price").removeAttr("readonly");
					$("#church_price").val('');
					$("#church_price").attr("placeholder", "Enter amount");
				}

				

			}
		});
}
function church_donation(user_type)
{
		var church_area 	= $("#church_area").val();
		var church_id 		= $("#church_id").val();
		var church_p_id 	= $("#church_donation_price").val();
		var church_price 	= $("#church_price").val();
		var church_cat_id	= $("#biller_category_id").val();
		if(church_cat_id=='')
		{
			$("#church_type_error").addClass("errormsg");
			$("#church_type_error").text("Please Select Church Type");
			$("#church_select_error,#church_area_error,#church_service_error,#error_church_donation").removeClass("errormsg");
	$("#church_select_error,#church_area_error,#church_service_error,#error_church_donation").text("");
			
			
		}else if(church_id=='')
		{
			 $("#church_select_error").addClass("errormsg");
			$("#church_select_error").text("Please Select Church");
			$("#church_type_error,#church_area_error,#church_service_error,#error_church_donation").removeClass("errormsg");
	$("#church_type_error,#church_area_error,#church_service_error,#error_church_donation").text("");
			
		}else if(church_area=='')
		{
			 $("#church_area_error").addClass("errormsg");
			$("#church_area_error").text("Please Select Church Area");
			$("#church_type_error,#church_select_error,#church_service_error,#error_church_donation").removeClass("errormsg");
	$("#church_type_error,#church_select_error,#church_service_error,#error_church_donation").text("");
		
		}else if(church_p_id=='')
		{
			 $("#church_service_error").addClass("errormsg");
			$("#church_service_error").text("Please Select Church Donation Service");
			$("#church_type_error,#church_select_error,#church_area_error,#error_church_donation").removeClass("errormsg");
	$("#church_type_error,#church_select_error,#church_area_error,#error_church_donation").text("");
		}
		else if (church_price == '') {
			 $("#error_church_donation").addClass("errormsg");
			$("#error_church_donation").text("Please Enter Church Donation Amount");
			$("#church_type_error,#church_select_error,#church_area_error,#church_service_error").removeClass("errormsg");
	$("#church_type_error,#church_select_error,#church_area_error,#church_service_error").text("");
		} else {
			$("#church_type_error,#church_select_error,#church_area_error,#church_service_error,#error_church_donation").removeClass("errormsg");
	$("#church_type_error,#church_select_error,#church_area_error,#church_service_error,#error_church_donation").text("");
			if(user_type=='1')
			{
				$.ajax({
				url : site_url + "check_login",
				type : "POST",
				data : {
					'church_area' : church_area,
					'church_id' : church_id,
					'church_price_id' : church_p_id,
					'church_price':church_price,
					'church_category_id':church_cat_id,
					'wt_category':'13',
					'rec_category':'6'

				},
				success : function(data) {
						localStorage.setItem("church_cat_id",church_cat_id);
						localStorage.setItem("church_price",church_price);
						localStorage.setItem("church_area",church_area);
						localStorage.setItem("church_id",church_id);
						localStorage.setItem("church_price_id",church_p_id);
						localStorage.setItem("wt_category",'13');
					if (data == '2') {
						$('#LoginModal').modal();
					} else if (data == '1') {
						//location.href = site_url + "church_donate?church_id=" + church_id + "&church_price=" + church_price + "&church_p_id=" + church_p_id+ "&church_price_id=" + church_price_id;
				//	var send_data= home_url + "recharge_details?mobile=" + data_card_number+ "&mobile_operator_id=" + datacard_operator_id + "&mobile_amount=" + data_rec_amount;
						//location.href = send_data;
	location.href = home_url + "church_recharge?church_price=" + church_price + "&church_category_id=" + church_cat_id + "&church_id=" + church_id+ "&church_p_id=" + church_p_id+ "&church_area=" + church_area;
					
	 
					}
				}
			});
			}else if(user_type=='2')
			{
						localStorage.setItem("c_cat_id",church_cat_id);
						localStorage.setItem("c_price",church_price);
						localStorage.setItem("c_area",church_area);
						localStorage.setItem("c_id",church_id);
						localStorage.setItem("c_price_id",church_p_id);
						localStorage.setItem("wt_cat",'13');
						$('#quickpay').modal();
			}
			
		}

}
// biller part
function show_service_provider(biller_category)
{
	$.ajax({
		url : base_url + "bill_service_provider",
		type : "POST",
		data : {
			'biller_category' : biller_category

		},
		success : function(data) {
			$("#service_provider").modal();
			var getdata = jQuery.parseJSON(data);
			var html = '<option>Select Service Provider</option>';
			$.each(getdata.service_provider, function(key, value) {
				var company_name = value.company;
				var biller_id = value.biller_id;

				html += '<option value='+biller_id+'>'+company_name+'</option>';

				
			});

			$("#service_provider_list").html(html);
			$("#biller_id").val(biller_category);
		}
	});
	
}
function get_service_provider(provider_id)
{
	$("#bill_provider_id").val(provider_id);
}
function check_consumer_number() {
	var consumer_number = $("#consumer_number").val();
	if (consumer_number == '') {
		$("#error_consumer_no").addClass("errormsg");
		$("#error_consumer_no").text('Please Enter consumer number');
	} else if (isNaN(consumer_number)) {
		$("#error_consumer_no").addClass("errormsg");
		$("#error_consumer_no").text('Please Enter a valid consumer number');
	} else {
	
	$("#error_consumer_no").removeClass("errormsg");
	$("#error_consumer_no").text('');

	}
}
//// function pay bill from genrated by biller...
function pay_bill(user_type) {
	var biller_category_id = $("#biller_id").val();
	var biller_service_id = $("#bill_provider_id").val();
	var consumer_number = $("#consumer_number").val();
	
	if (biller_category_id == '') {
		$("#biller_cat_errro").addClass("errormsg");
		$("#biller_cat_errro").text('Please Select Biller Type');
		$("#biller_ser_errro,#error_consumer_no").removeClass("errormsg");
		$("#biller_ser_errro,#error_consumer_no").text('');
	} else if (biller_service_id == '') {

		$("#biller_ser_errro").addClass("errormsg");
		$("#biller_ser_errro").text('Please Select Service Provider');
		$("#biller_cat_errro,#error_consumer_no").removeClass("errormsg");
		$("#biller_cat_errro,#error_consumer_no").text('');
	} else if (consumer_number == '') {
		$("#error_consumer_no").addClass("errormsg");
		$("#error_consumer_no").text('Please Enter a valid consumer number');
		$("#biller_cat_errro,#biller_ser_errro").removeClass("errormsg");
		$("#biller_cat_errro,#biller_ser_errro").text('');
	} else if (isNaN(consumer_number)) {
		$("#error_consumer_no").addClass("errormsg");
		$("#error_consumer_no").text('Please Enter a valid consumer number');
		$("#biller_cat_errro,#biller_ser_errro").removeClass("errormsg");
		$("#biller_cat_errro,#biller_ser_errro").text('');
	} else {
			$("#biller_cat_errro,#biller_ser_errro,#error_consumer_no").removeClass("errormsg");
		$("#biller_cat_errro,#biller_ser_errro,#error_consumer_no").text('');
		if(user_type=='1')
		{
			$.ajax({
			url : base_url + "get_consumer_details",
			type : "POST",
			data : {
				'biller_id' : biller_service_id,
				'bill_invoice_no' : consumer_number

			},success : function(data) { 
				var getdata = jQuery.parseJSON(data);
				var status = getdata.status;
				var message = getdata.message;
				var amount	= getdata.bill_amount;
				var biller_id	= getdata.biller_id;
				if (status == 'true') {
					$.ajax({
						url : site_url + "check_login",
						type : "POST",
						data : {
							'biller_category_id' : biller_category_id,
							'biller_service_id' : biller_service_id,
							'consumer_number' : consumer_number,
							'wt_category':'11',
							'rec_category':'4',
							'bill_payment':amount,
							'biller_id':biller_id
						},
						success : function(data) { 
							localStorage.setItem("biller_category_id",biller_category_id);
							localStorage.setItem("biller_service_id",biller_service_id);
							localStorage.setItem("biller_id",biller_id);
							localStorage.setItem("consumer_number",consumer_number);
							localStorage.setItem("wt_category",'11');
							localStorage.setItem("bill_pay_amount",amount);
							if (data == '2') {
								$('#LoginModal').modal();
							} else if (data == '1') {
								location.href = site_url + "pay_bill?i_n=" + consumer_number + "&biller_category_id=" + biller_category_id + "&biller_service_id=" + biller_service_id+ "&bill_payment=" + amount+ "&biller_id=" + biller_id;
							}
						}
					});
					$("#error_consumer_no").removeClass("errormsg");
					$("#error_consumer_no").text('');
				} else {
					$("#error_consumer_no").addClass("errormsg");
					$("#error_consumer_no").text(message);
				}
			}
		});
		}else if(user_type=='2')
		{
			$('#quickpay').modal();
			localStorage.setItem("biller_cat_id",biller_category_id);
			localStorage.setItem("biller_s_id",biller_service_id);
			localStorage.setItem("bil_id",biller_id);
			localStorage.setItem("consumer_number",consumer_number);
			localStorage.setItem("wt_cat",'11');
			localStorage.setItem("billpay_amount",amount);
			
		}
		

	}
}
// church part
function get_event_list(event_category_id)
{
$.ajax({
		url : base_url + "event_list",

		type : "POST",
		data : {
			'event_category' : event_category_id

		},
		success : function(data) {
	
			var getdata = jQuery.parseJSON(data);
			var status = getdata.status; 
			var html='';
			if(status=='true')
			{
				
				html += '<option value="0">Select Event</option>';
				$.each(getdata.event_list, function(key, value) {
				var event_name = value.event_name;
				var event_id = value.event_id;
				var event_biller_id=value.event_biller_id;
				html += '<option value='+event_id+'>'+event_name+'</option>';
			
			});
			$("#event_id").html(html);
			}

		
		}
	});
}
function select_event(id)
{ 	var event_id=id;
	$.ajax({
		url : base_url + "get_event",

		type : "POST",
		data : {
			'event_id' : event_id

		},
		success : function(data) {
			
		var getdata = jQuery.parseJSON(data);
			var status = getdata.status;
			var html1='';
			var html111='';
			if(status=='true')
			{
				 $("#click_event_id").val(event_id);
				 $("#e_name").text(getdata.event_name);
				 $("#event_datetime").text(getdata.event_datetime);
				 $("#address_event").text(getdata.event_place);
				 $("#desc_event").text(getdata.event_desc);
				 $("#image_event").attr("src",getdata.event_image);
				 $("#csv_ticket_ids").val(getdata.event_tickets_ids);
				 	$.each(getdata.event_pass, function(key, value) 
				 	{
				 	html1 += '<button onclick="select_event_ticket('+value.event_ticket_id+','+value.event_price+')" id="event_btn_id'+value.event_ticket_id+'" type="button" class="btn btn-default" title="'+value.event_price+'">'+value.event_pass_name+'<input type="hidden" id="event_ticket_id'+value.event_ticket_id+'" value="'+value.event_ticket_id+'"><input type="hidden" id="event_ticket_price'+value.event_ticket_id+'" value="'+value.event_price+'"><input type="hidden" id="select_ticket_value'+value.event_ticket_id+'" value=""><input type="hidden" id="click_event_id" value="'+value.event_ticket_id+'"><input type="hidden" id="click_event_price" value="'+value.event_price+'"><input type="hidden" id="total_price_ticket" value="0"></button>';
				 	});
				 	$.each(getdata.event_pass, function(key1, value1) 
				 	{
				 	
				 	html111 +='<p class="event-btn"> &#8358;'+value1.event_price+ '</p>';
				 	});
				 	
				 $("#event_tkt_price").html(html111);
				 	$("#event_pass_record").html(html1);
			$("#eventDetailModal").modal();
			}
			}
	});
}

function add_ticket()
{
	
	var event_id     =	$("#click_event_id").val();
	var price_event  =+ $("#event_ticket_price"+event_id).val();
	var previous_val =+ $("#select_ticket_value"+event_id).val();
	var val			 =	$("#ticket_value").val();
	
	var price=parseInt(price_event);
	if(isNaN(price_event))
	{
		$("#error_status_ticket").css("display","block");
		$("#error_status_ticket").text("Please select atleast one ticket");
	}else{
		var v =+ val+1;
		$("#ticket_value").val(v);
		var amt=$("#final_amt_ticket").val();
		var total=price+parseInt(amt);
		$("#total_price_ticket").val(total);
		$("#final_amt_ticket").val(total);
		$("#amt_price").text(total);
		$("#select_ticket_value"+event_id).val(parseInt(v));
	}
	
}

function minus_ticket()
{
	
	var event_id=$("#click_event_id").val();
	var price_event =+ $("#event_ticket_price"+event_id).val();
	var previous_val =+ $("#select_ticket_value"+event_id).val();
	var val=$("#ticket_value").val();
	if(val>0){
	var v =+ val-1;
	var price=parseInt(price_event);
	var amt=$("#amt_price").text();
   $("#amt_price").text(parseInt(amt)-parseInt(price));
	}else{
		var v=0;
	}
	
//	$("#total_price_ticket").val(parseInt(price)-parseInt(amt));
//	$("#amt_price").text(parseInt(price)-parseInt(amt));
	$("#select_ticket_value"+event_id).val(parseInt(v));
	$("#ticket_value").val(v);
	//$("#select_ticket_value"+event_id).val(parseInt(v));
}
function select_event_ticket(event_id,event_ticket_price)

{
	$("#error_status_ticket").css("display","none");
	var amt=$("#total_price_ticket").val();
	$("#final_amt_ticket").val(amt);
	$("#click_event_id").val(event_id);
	$("#click_event_price").val(event_ticket_price);
	var previous_val =+ $("#select_ticket_value"+event_id).val();
		$("#select_ticket_value"+event_id).val(previous_val);
			var val =+ $("#select_ticket_value"+event_id).val();
		var ticket_val=$("#ticket_value").val(val);
		$("#event_btn_id"+event_id).addClass("active").siblings().removeClass("active");   
    	//$("#event_btn_id"+event_id).addClass('active');
}
function check_ticket_avaliblity()
{
	var csv_ticket_id=$("#csv_ticket_ids").val();
	var myarray = csv_ticket_id.split(',');
	var event_id=$("#event_id").val();
		var jsonArray =[];
	for(var i = 0; i < myarray.length; i++)
	{
	   var event_ticket_count=$("#select_ticket_value"+myarray[i]).val();
	   var ticket_id=[];
		var ticket_count=[];
		ticket_id.push(myarray[i]);
		ticket_count.push(event_ticket_count);
		var ent={};
		for(var k=0;k<ticket_id.length;k++)
		{
		ent.ticket_id=ticket_id[k];
		ent.ticket_count=ticket_count[k];
		var jsonObject = {'event_ticket_id':ent.ticket_id, 'event_quantity_ticket':ent.ticket_count};
		 jsonArray.push(jsonObject);
		}
		
	}
	var jsonAsString = JSON.stringify(jsonArray);
	$.ajax({
		url : base_url + "check_ticket_record",

		type : "POST",
		data : {
			'event_id' : event_id,
			'ticket_record':jsonAsString

		},
		success : function(data) {
			
		var getdata = jQuery.parseJSON(data);
			var status = getdata.status;
			var html='';
			if(status=='true')
			{
				var html='';
				var ticket_not_avalible=[];
		
		 $.each(getdata.records, function(key, value) {
		   	if(value.ticket_status=='2')
		   	{
		   		ticket_not_avalible.push(value.ticket_id);
		   		 // alert(value.ticket_name+'avlible is:'+value.ticket_limit);
		  
			
		   	}
			});
			
				if(ticket_not_avalible ==''){
			
					$("#eventDetailModal").modal('hide');
					var amt1=$("#total_price_ticket").val();
					localStorage.setItem("ticket_amount",amt1);
					localStorage.setItem("ticket_json_array",jsonAsString);
					localStorage.setItem("event_id",event_id);
					localStorage.setItem("wt_category",'16');
					//localStorage["jsonAsString"] = $.stringify(jsonAsString);
					$.ajax({
					url : site_url + "check_login",
					type : "POST",
					data : {
					'event_id' : event_id,
					'total_price_ticket' : amt1,
					'ticket_json_array' : jsonAsString,
					'wt_category':'16'
					
					},
					success : function(data) {

					if (data == '2') {
						$('#LoginModal').modal();
					} else if (data == '1') {
						location.href = home_url + "event_booking?event_ticket_price=" + amt1 + "&event_id=" +event_id+ "&ticket_json_array=" + jsonAsString;
						//location.href = site_url + "event_booking";
					}
				}
			});
				}			
			}else{
				$("#error_status_ticket").css("display","block");
				$("#error_status_ticket").text("Please select atleast one ticket");
			}

		
		}
	});
}

// edit profile 
function user_update() {
	var user_name = $("#user_name").val();
	var user_id = $("#user_id").val();
	var user_email = $("#user_email").val();
	var user_mobile = $("#user_mobile_no").val();

	var c_pass = $("#c_pass").val();

	if (user_mobile != '') {
		var mobile = user_mobile;
	} else {
		var mobile = '';
	}
	
	$.ajax({
		url : base_url + "edit_profile",
		'type' : 'POST',
		'data' : {
			'user_id' : user_id,
			'user_name' : user_name,
			'mobile' : mobile,
			'user_email' : user_email
		},
		'success' : function(data) {
			var getdata = jQuery.parseJSON(data);
			var status = getdata.status;
			var message = getdata.message;
			var name = getdata.user_name;
			var email = getdata.user_email;
			var user_id = getdata.user_id;
			if (status == 'true') {
				$("#user_name").text(user_name);
				$("#user_email").text(user_email);
				toastr.success(message, 'Success');
				$.ajax({
					url : site_url + "user_login",
					type : "POST",
					data : {
						'user_id' : user_id

					},
					success : function(data) {

					}
				});
			}else{
				$("#success_profile").css("display", "block");
				toastr.success(message);
				//$("#success_profile").addClass("warn");
				//$('#profile_success').text(message);
			}
		}
	});
}
//change password
function change_password() {
	var old_pass = $("#old_password").val();
	var user_id = $("#user_id").val();
	var new_password = $("#new_password").val();
	var confirm_password = $("#confirm_password").val();
	if (old_pass == '' ) {
		$("#old_pass_error").addClass("errormsg my_account-error");
		$("#old_pass_error").text('Please Enter Old Password');
		$('#new_password,#confirm_password').removeClass("errormsg my_account-error");
		$('#new_password,#confirm_password').text('');
	} else if (new_password == '') {

		$("#new_pass_error").addClass("errormsg my_account-error");
		$("#new_pass_error").text('Please Enter New Password');
		$('#old_pass_error,#confirm_password').removeClass("errormsg my_account-error");
		$('#old_pass_error,#confirm_password').text('');

	}else if (new_password.length < 4 || new_password.length >4) {

		$("#new_pass_error").addClass("errormsg my_account-error");
		$("#new_pass_error").text('Password length should be 4 digit.');
		$('#old_pass_error,#confirm_password').removeClass("errormsg my_account-error");
		$('#old_pass_error,#confirm_password').text('');

	}else if (isNaN(new_password)) {

		$("#new_pass_error").addClass("errormsg my_account-error");
		$("#new_pass_error").text('Please Enter Number');
		$('#old_pass_error,#confirm_password').removeClass("errormsg my_account-error");
		$('#old_pass_error,#confirm_password').text('');

	}else if ( isIncreasingSequence( new_password.split("") ) ) {

		$("#new_pass_error").addClass("errormsg my_account-error");
		$("#new_pass_error").text('Password should not in sequence.');
		$('#old_pass_error,#confirm_password').removeClass("errormsg my_account-error");
		$('#old_pass_error,#confirm_password').text('');

	} else if (confirm_password == '') {

		$("#confirm_pass_error").addClass("errormsg my_account-error");
		$("#confirm_pass_error").text('Please Enter Confirm Password');
		$('#old_pass_error,#new_pass_error').removeClass("errormsg my_account-error");
		$('#old_pass_error,#new_pass_error').text('');

	} else if (new_password != confirm_password) {

		$("#confirm_pass_error").addClass("errormsg my_account-error");
		$("#confirm_pass_error").text("New password and confirm password are mismatched");
		$('#old_pass_error,#new_pass_error').removeClass("errormsg my_account-error");
		$('#old_pass_error,#new_pass_error').text('');

	} else {
	$.ajax({
		url : base_url + "check_old_password",
		'type' : 'POST',
		'data' : {
			'old_password' : old_pass,
			'user_id' : user_id

		},
		'success' : function(data) {
			var getdata = jQuery.parseJSON(data);
			var status = getdata.status;
			var message = getdata.message;
			if (status == 'true') {
			
				if (new_password != confirm_password) {
					toastr.error('New password and confirm password are mismatched', 'Error');
					// $("#confirm_pass_error").addClass("errormsg my_account-error");
					// $('#confirm_pass_error').text("New password and confirm password are mismatched");
				} else {

					$.ajax({
						url : base_url + "change_password",
						type : "POST",
						data : {
							'user_id' : user_id,
							'old_password' : old_pass,
							'new_password' : new_password
						},
						success : function(data) {
						$('#old_pass_error,#new_pass_error,#confirm_pass_error').removeClass("errormsg my_account-error");
							$('#old_pass_error,#new_pass_error,#confirm_pass_error').text('');
							var getdata = jQuery.parseJSON(data);
							var status = getdata.status;
							var message = getdata.message;
							toastr.success(message, 'Success');
							// $("#success_password").css("display", "block");
							// $('#password_success').text(message);
							$("#old_password").val('');
							$("#new_password").val('');
							$("#confirm_password").val('');
							setTimeout(function(){
 							$("#success_password").css("display", "none");
							}, 5000);

						}
					});

				}
			} else if (status == 'false') {
				// $("#old_pass_error").addClass("errormsg my_account-error");
				// $('#old_pass_error').text(message);
				toastr.error(message, 'Error');
				$('#new_pass_error,#confirm_pass_error').removeClass("errormsg my_account-error");
				$('#new_pass_error,#confirm_pass_error').text('');

			}
		}
	});
	}
}
function check_empty_password()
{
	$('#old_pass_error,#new_pass_error,#confirm_pass_error').removeClass("errormsg my_account-error");
	$('#old_pass_error,#new_pass_error,#confirm_pass_error').text('');
}
//  function free coupon offer part///
function get_coupon_cat_id(id) {
	$("#coupons").html('');
	$.ajax({
		url : site_url + "get_offer_details",
		type : "POST",
		data : {
			'coupon_id' : id

		},
		success : function(data) {

			$("#coupons").html(data);

		}
	});
}
// function get all coupons
function get_all_coupon() {
	$("#coupons").html('');
	$.ajax({
		url : site_url + "get_all_coupon",
		type : "POST",
		data : {
			'coupon_id' : 1

		},
		success : function(data) {

			$("#coupons").html(data);

		}
	});
}

// Send -otp
function send_otp() {

	var user_id = $("#mob_user_id").val();
	var mb_number = $("#Mobile_number-code").val();

	$('#user_mobile_number').text(mb_number);
	$('#mob_num_hidden').val(mb_number);
	$.ajax({
		url : base_url + "send_otp",

		type : "POST",
		data : {
			'user_id' : user_id,
			'mb_number' : mb_number
		},
		success : function(data) {
			var getdata = jQuery.parseJSON(data);
			var status = getdata.status;
			var message = getdata.message;
			if (status == 'true') {
				$('#changenumber-modal').modal('hide');
				$('#verification-modal').modal();
			} else {
				//$('#upgrate').modal();
				$("#mobile_number_response").addClass("erro-new-msg");
				$("#mobile_number_response").text(message);
			}
		}
	});
}

function resend_otp() {
	//	var user_id=$("#user_id").val();
	var mb_number = $("#mob_num_hidden").val();

	$.ajax({
		url : base_url + "resend",

		type : "POST",
		data : {
			'user_mobile_no' : mb_number

		},
		success : function(data) {
			var getdata = jQuery.parseJSON(data);
			var status = getdata.status;
			var message = getdata.message;

			if (status == 'true') {
				$("#user_mobile_number").text(mb_number);
				$("#response_otp_msg").text(message);
			} else {

			}
		}
	});
}
//  function mannage to all offer of promotional offer//
function add_coupon_offer(id) {
$('.add_offer' + id).addClass('active');
	user_id = $("#user_id").val();
	$.ajax({
		url : site_url + "add_cart_coupon",
		type : "POST",
		data : {
			'coupon_id' : id,
			'user_id' : user_id

		},
		success : function(data) {

			var html = '';
			if (data != '2') {

				var getdata = jQuery.parseJSON(data);
				/*
				$.each(getdata.arr, function(key, value) {
									html += ' <div class="offer_img"><div class="del_img" onclick="delete_cart_offer(' + value.coupon_id + ')"><i class="fa fa-close"></i></div><img class="" width="50" height="40"  src="' + value.coupon_img + '" alt="..."/></div>';
									//html += '<p class="cpoupon-name">' + value.coupon_name + '</p>';
									//html += '  <p class="coupon-count">₦ ' + value.coupon_discount + ' <span style="cursor:pointer" class="delete" onclick="delete_cart_offer(' + value.coupon_id + ')"><i class="fa fa-close"></i></span></p>';
				
								});*/
				

				$("#picked_offer").html("Get");
			} else {

			}
		}
	});
}

function regenrate_ticket(bookind_id)
	{
		 
		$.ajax({
			url : base_url + "regenerate_event_ticket",
	
			type : "POST",
			data : {
				'booking_event_tickets_id' : bookind_id
	
			},
			success : function(data) {
				
				var getdata = jQuery.parseJSON(data);
				var status = getdata.status;
				var message = getdata.message; 
				toastr.success(getdata.message,"Success");
				$("#succes_span"+bookind_id).css("display","block");
				setTimeout(function(){
  					$("#succes_span"+bookind_id).css("display","none");
				}, 2000);
					/*
					$("#ticket_popup").modal();
										$("#booking_id").html(bookind_id);
										$("#genrate_response").html(message);*/
			}
		});
		 
	}
	//function save card
	function add_new_card()
	{
		var card_no			=	$("#card_no").val();
		var expiry_month	=	$("#expiry_month").val();
		var expiry_year		=	$("#expiry_year").val();
		var cvv_no			=	$("#savecvv_no").val();
		if(card_no=='')
		{
			$("#card_no_error").addClass("errormsg");
			$("#card_no_error").text("Please Enter valid Card Number");
		}else
		
		if (card_no.length < 18 || card_no.length > 22) {
			$("#card_no_error").addClass("errormsg");
			$("#card_no_error").text('Please Enter valid Card Number');
		}else 
		if(expiry_month=='')
		{
			$("#expiry_month_error").addClass("simple-msg");
			$("#expiry_month_error").text('Invalid Month');
		}else 
		if(expiry_year=='')
		{
			$("#expiry_year_error").addClass("simple-msg");
			$("#expiry_year_error").text('Invalid Year');
		}else 
		if(cvv_no=='')
		{
			$("#savecvv_error").addClass("simple-msg");
			$("#savecvv_error").text('Invalid CVV.');
		}else
		if (isNaN(cvv_no)) {
			$("#savecvv_error").addClass("errormsg");
			$("#savecvv_error").text('Please Enter 3 Digit Cvv Number');
		}else
		if (cvv_no.length < 3 || cvv_no.length > 3) {
			$("#savecvv_error").addClass("errormsg");
			$("#savecvv_error").text('Please Enter 3 Digit Cvv Number');
		}else{
			$("#savecard_form").submit();
			
				
		}
	}
// function delete  saved card
function delete_saved_card(save_card_id)
{
	if(confirm('Are you sure, You want delete this Saved card?')){
	var user_id=$("#usersessionid").val();
	$.ajax({
			url : base_url + "delete_savecard",
	
			type : "POST",
			data : {
				'save_card_id' : save_card_id,
				'user_id':user_id
	
			},
			success : function(data) {
				
				var getdata = jQuery.parseJSON(data);
				var status = getdata.status;
				var message = getdata.message; 
				
				//$("#delete_success").text(message);
				//$("#success_delete").css("display","block");
				setTimeout(function()
				{
 					//$("#success_delete").css("display","none");
					location.href=BaseUrl+"Save-Cards";
					}, 1000);
				toastr.success("Your Card Deleted Successfully","Success");
				}
		});
}else {
	return false;
}
}
// check add new card validation
function check_card_no(card_no)
	{
		
		var re16digit = new RegExp("^[0-9 -]+$");
	
		if(card_no=='')
		{
			$("#card_no_error").addClass("errormsg my_account-error");
			$("#card_no_error").text("Please Enter Valid Card Number");
			$("#validcard").css("display","none");
			$("#card_validtion").css("display","none");
			$(".verveCard").css("display", "none");
			$("#verve_card_status").val(2);
		}else
		if (!re16digit.test(card_no)) {
			
			$("#card_no_error").addClass("errormsg my_account-error");
			$("#card_no_error").text('Please Enter Valid Card Number');
			$("#validcard").css("display","none");
			$("#card_validtion").css("display","none");
			$(".verveCard").css("display", "none");
			$("#verve_card_status").val(2);
		}else
		if (card_no.length < 15 || card_no.length>23) {
			$("#card_no_error").addClass("errormsg my_account-error");
			$("#card_no_error").text('Please Enter Valid Card Number');
			$("#validcard").css("display","none");
			$("#card_validtion").css("display","none");
			$(".verveCard").css("display", "none");
			$("#verve_card_status").val(2);
		}else{
			
			$.ajax({
				url : base_url + "validate_card_number",
				type : "POST",
				data : {
					'card_number' : card_no
					
				},
				success : function(data) { 
					
						var getdata = jQuery.parseJSON(data);
						var status = getdata.status;
						if (status == 'true') {
							$("#card_no_error").removeClass("errormsg my_account-error");
							$("#card_no_error").text('');
							$("#validcard").css("display","block");
							$("#card_validtion").css("display","block");
							if(getdata.card_name == 'Verve'){
							  $("#verve_card_status").val(1);
							  $(".verveCard").css("display", "block");
							}else{
							  $("#verve_card_status").val(2);
							  $(".verveCard").css("display", "none");
							}
						}else{
							$("#card_no_error").addClass("errormsg my_account-error");
							$("#card_no_error").text('Please Enter Valid Card Number');
							$("#validcard").css("display","none");
							$("#card_validtion").css("display","none");
							$("#verve_card_status").val(2);
							$(".verveCard").css("display", "none");
						}
				}
			});
			
		}
	}
	


// Auto logout functionlity
function set_interval()
{
//the interval 'timer' is set as soon as the page loads
timer=setInterval("auto_logout()",3000000);
// the figure '10000' above indicates how many milliseconds the timer be set to.
//Eg: to set it to 5 mins, calculate 5min= 5x60=300 sec = 300,000 millisec. So set it to 3000000
}

function reset_interval()
{
//resets the timer. The timer is reset on each of the below events:
// 1. mousemove   2. mouseclick   3. key press 4. scroliing
//first step: clear the existing timer
clearInterval(3000000);
//second step: implement the timer again
timer=setInterval("auto_logout()",3000000);

}

function auto_logout()
{
//this function will redirect the user to the logout script
localStorage.setItem("mobileno","");
	location.href = home_url +"logout";
	localStorage.setItem("mobileno","");
	localStorage.setItem("rec_category",'');
	localStorage.setItem("wt_category",'');
	localStorage.clear();
}

// Guest User Functionlity
function quick_mobile_recharge()
{
	var prepaid				=	$("#mobile_type").val();
	var mobileno			=	$("#mobileno").val();
	var rec_category		=	$("#rec_category").val();
	var mobile_amount		=	$("#mobile_recharge_amount").val();
	var operator_id			=	$("#mobile_operator_id option:selected").val();
	if(mobileno.length !=11) {
		 $("#mob_num_error").text("Enter valid 11 digit mobile number");
		 $("#mob_num_error").addClass("errormsg");
		 }else if(isNaN(mobileno)){
		 	$("#mob_num_error").text("Enter valid 11 digit mobile number");
		 	$("#mob_num_error").addClass("errormsg");
		 }
		 else if(isNaN(mobile_amount)){
		 	$("#mob_num_error").text("Enter valid amount");
		 	$("#mob_num_error").addClass("errormsg");
		 }
		 else if(mobile_amount<50 || mobile_amount>50000)
		 {
		 	$("#error_mobile_recharge").addClass("errormsg");
		 	$("#error_mobile_recharge").text("Enter amount between 50 and 50000");
		 }else if(operator_id=='0')
		 {
		 	$("#mob_operator_error").addClass("errormsg");
		 	$("#mob_operator_error").text("Please select operator");
		 }else{
		 	$("#error_mobile_recharge").removeClass("errormsg");
		 	$("#mob_num_error,#error_mobile_recharge,#mob_operator_error").val("");
	
		 	$("#guest_user_mobile").val(mobileno);
		 				localStorage.setItem("m_type",prepaid);
						localStorage.setItem("m_no",mobileno);
						localStorage.setItem("m_amt",mobile_amount);
						localStorage.setItem("o_id",operator_id);
						localStorage.setItem("rec_cat",rec_category);
						localStorage.setItem("wt_cat",'2');
		 	   			$('#quickpay').modal();
					
		 }
}
// quick pay singup
function guest_user_signup()
{

	//alert(11);
	var guest_user_mobile = $("#guest_user_mobile").val();
	var guest_user_email  = $("#guest_user_email").val();
	
	if(guest_user_mobile !='' && guest_user_email !=''){
	if(guest_user_mobile=='')
	{

			$("#guest_mobile_error").addClass("errormsg");
			$("#guest_mobile_error").text('Please Enter Mobile No.');
	}else if(guest_user_email=='')
	{
			$("#guest_mobile_error").removeClass("errormsg");
			$("#guest_mobile_error").text('');
			$("#guest_email_error").addClass("errormsg");
			$("#guest_email_error").text('Please Enter Email');
	}else{

			$("#guest_mobile_error").removeClass("errormsg");
			$("#guest_mobile_error").text('');
			$("#guest_email_error").removeClass("errormsg");
			$("#guest_email_error").text('');

		$.ajax({
		url : base_url + "guest_login",
		type : "POST",
		data : {
			'guest_user_mobile' : guest_user_mobile,
			'guest_user_email'  : guest_user_email
		},
		success : function(data) {
		if (data != '') {
				var getdata = jQuery.parseJSON(data);
				var status 	= getdata.status;
				var message = getdata.message;
				var email  	= getdata.guest_user_email;
				var userid 	= getdata.guest_user_id;
				if (status 	== 'true') {
							localStorage.setItem("guest_user_id",userid);
							var rec_category=localStorage.getItem("rec_cat");
							var wt_category=localStorage.getItem("wt_cat");
							if(wt_category=='2'){
							if(rec_category==1)
							{
								var prepaid=localStorage.getItem("m_type");
								var mobile=localStorage.getItem("m_no");
								var mobile_amount=localStorage.getItem("m_amt");
								var operator_id=localStorage.getItem("o_id");
								var send_data= home_url + "guest_recharge_details?mo=" + mobile+ "&operator_id=" + operator_id + "&amount=" + mobile_amount+"&g_id="+userid+"&wt_rec="+wt_category+","+rec_category;
						
								location.href = send_data;
							}else if(rec_category==2)
							{
								var tv_number=localStorage.getItem("tv_recnumber");
								var tv_rec_amount=localStorage.getItem("tv_recamount");
								var tv_operator_id=localStorage.getItem("tvoperator_id");
								var send_data= home_url + "guest_recharge_details?mo=" + tv_number+ "&operator_id=" + tv_operator_id + "&amount=" + tv_rec_amount+"&g_id="+userid+"&wt_rec="+wt_category+","+rec_category;;
								location.href = send_data;
							}else if(rec_category==3)
							{
								var data_card_number=localStorage.getItem("d_c_num");
								var data_operator_id=localStorage.getItem("d_o_id");
								var data_rec_amount=localStorage.getItem("d_rec_amt");
								var send_data= home_url + "guest_recharge_details?mo=" + data_card_number+ "&operator_id=" + data_operator_id + "&amount=" + data_rec_amount+"&g_id="+userid+"&wt_rec="+wt_category+","+rec_category;;
								location.href = send_data;
							}
							}else if(wt_category=='11')
							{
							var biller_category_id=localStorage.getItem("biller_category_id");
							var biller_service_id=localStorage.getItem("biller_service_id");
							var consumer_number=localStorage.getItem("consumer_number");
							var send_data= home_url + "guest_payBill?i_n=" + consumer_number + "&bil_cat_id=" + biller_category_id + "&bil_serv_id=" + biller_service_id+"&g_id="+userid+"&wt_rec="+wt_category;
						     	location.href = send_data;
						   
							}else if(wt_category=='12')
							{
							var electric_card_number=localStorage.getItem("e_c_n");
							var electricty_operator_id=localStorage.getItem("e_o_id");
							var electrice_amount=localStorage.getItem("e_a");
							var send_data= home_url + "guest_recharge_details?mo=" + electric_card_number + "&operator_id=" + electricty_operator_id + "&amount=" + electrice_amount+"&g_id="+userid+"&wt_rec="+wt_category+","+rec_category;;
								location.href = send_data;
							}else if(wt_category=='13'){
							
							var church_price=localStorage.getItem("c_price");
							var church_area=localStorage.getItem("c_area");
							var church_id=localStorage.getItem("c_id");
							var church_price_id=localStorage.getItem("c_price_id");
							var church_category_id=localStorage.getItem("c_cat_id");
							var send_data = home_url + "guest_donation?c_p=" + church_price + "&c_c_id=" +church_category_id+ "&c_id=" + church_id+ "&c_p_id=" + church_price_id+ "&c_area=" + church_area+"&g_id="+userid+"&wt_rec="+wt_category;
								location.href = send_data;
							}else if(wt_category=='16'){
							var ticket_amount=localStorage.getItem("ticket_amount");
							var ticket_json_array=localStorage.getItem("ticket_json_array");
							var event_id=localStorage.getItem("event_id");
							var send_data = home_url + "event_booking?event_ticket_price=" + ticket_amount + "&event_id=" +event_id+ "&ticket_json_array=" + ticket_json_array+"&g_id="+userid+"&wt_rec="+wt_category+","+rec_category;;
								location.href = send_data;
							}
						
					
				} else if (status == 'false') {
					$("#login_mob_error").removeClass("errormsg");
					$("#login_mob_error").text('');
					$("#login_pass_error").removeClass("errormsg");
					$("#login_pass_error").text('');
					$("#login_response_failed").addClass("erro-new-msg");
					$("#login_response_failed").text(message);
					
				}
			}

		}
	});
	}
	}
}
// guest dth recharge
function quick_dth_recharge()
{
	$("#error_mobile_recharge").text("");
		$("#data_num_error").text('');
		var rec_category		=	$("#rec_category").val();
		var tv_operator_id = $("#dth_operator_id").val();
		var tv_number=$("#tv_number").val();
		var tv_rec_amount = $("#tv_rec_amount").val();
		if(tv_operator_id=='')
		{
			$("#dth_operator_error").addClass("errormsg");
			$("#dth_operator_error").text("Please Select operator");
		
		}else if(tv_number=='')
		{
			$("#dth_amt_error").removeClass("errormsg");
			$("#dth_amt_error").text("");
			$("#dth_operator_error").removeClass("errormsg");
			$("#dth_operator_error").text("");
			$("#dth_num_error").addClass("errormsg");
			$("#dth_num_error").text("Please Enter DTH Number");
			
		}else if(tv_rec_amount=='')
		{
			$("#dth_amt_error").removeClass("errormsg");
			$("#dth_amt_error").text("");
			$("#dth_num_error").removeClass("errormsg");
			$("#dth_num_error").text("");
			$("#dth_amt_error").addClass("errormsg");
			$("#dth_amt_error").text("Please Enter Recharge Amount");
		
		}else{
			$("#dth_amt_error").removeClass("errormsg");
			$("#dth_amt_error").text("");
			$("#dth_num_error").removeClass("errormsg");
			$("#dth_num_error").text("");
			$("#dth_amt_error").removeClass("errormsg");
			$("#dth_amt_error").text("");
			$("#error_dth_recharge").removeClass("errormsg");
			var tv_rec_code = $("#tv_rec_code").val();
			var tv_number_name = $("#tv_numbername").val();
			localStorage.setItem("tv_reccode",tv_rec_code);
			localStorage.setItem("tv_numbername",tv_number_name);
			localStorage.setItem("tv_recnumber",tv_number);
			localStorage.setItem("tv_recamount",tv_rec_amount);
			localStorage.setItem("tvoperator_id",tv_operator_id);
			localStorage.setItem("rec_cat",rec_category);
			localStorage.setItem("wt_cat",'2');
			$('#quickpay').modal();
	}				
}

// check guest electricity recharge
function quick_electricity_recharge()
{
		var electric_card_number   = $("#electric_card_number").val();//alert(electric_card_number);
		var electricty_operator_id = $("#electricty_operator_id option:selected").val();
		var electrice_amount 	   = $("#electrice_amount").val();
		var customer_name 	   	   = $("#electricity_customer_name").val();
		if (electricty_operator_id == '') 
		{
			$("#ele_oper_error").addClass("errormsg");
			$("#ele_oper_error").text('Please Select Service Provider');
			$("#ele_num_error").removeClass("errormsg");
			$("#ele_num_error").text('');
			$("#ele_amt_error").removeClass("errormsg");
			$("#ele_amt_error").text('');
			$("#electricity_error").removeClass("errormsg");
			$("#electricity_error").text('');
		}
		else if (electric_card_number == '') {
			
			$("#ele_num_error").addClass("errormsg");
			$("#ele_num_error").text('Please Enter Electricity Consumer Name');
			$("#ele_oper_error").removeClass("errormsg");
			$("#ele_oper_error").text('');
			$("#ele_amt_error").removeClass("errormsg");
			$("#ele_amt_error").text('');
			$("#electricity_error").removeClass("errormsg");
			$("#electricity_error").text('');
		}else if (electrice_amount == '') { 
			
			$("#ele_amt_error").addClass("errormsg");
			$("#ele_amt_error").text('Please Enter Amount');
			$("#ele_oper_error").removeClass("errormsg");
			$("#ele_oper_error").text('');
			$("#electricity_error").removeClass("errormsg");
			$("#electricity_error").text('');
		} else if (isNaN(electrice_amount)) { 
			
			$("#ele_amt_error").addClass("errormsg");
			$("#ele_amt_error").text('Please Enter Valid Amount');
			$("#ele_oper_error").removeClass("errormsg");
			$("#ele_oper_error").text('');
			$("#electricity_error").removeClass("errormsg");
			$("#electricity_error").text('');
		}else if (customer_name == '') {
			$("#electricity_error").addClass("errormsg");
			$("#electricity_error").text('Please Enter Valid Counsumer Number');
			$("#ele_oper_error").removeClass("errormsg");
			$("#ele_oper_error").text('');
			$("#ele_amt_error").removeClass("errormsg");
			$("#ele_amt_error").text('');
			$("#ele_num_error").removeClass("errormsg");
			$("#ele_num_error").text('');
		}else {
			$("#electricity_error").removeClass("errormsg");
			$("#electricity_error").text('');
			$("#ele_oper_error").removeClass("errormsg");
			$("#ele_oper_error").text('');
			$("#ele_amt_error").removeClass("errormsg");
			$("#ele_amt_error").text('');
			$("#ele_num_error").removeClass("errormsg");
			$("#ele_num_error").text('');
			localStorage.setItem("e_c_n",electric_card_number);
			localStorage.setItem("e_a",electrice_amount);
			localStorage.setItem("e_o_id",electricty_operator_id);
			localStorage.setItem("wt_cat",'12');
			$('#quickpay').modal();
		}
}
// check add new card validation
