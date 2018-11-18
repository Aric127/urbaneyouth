// regenrate ticket


// function reset oyapin()
function reset_oyapin()
{
	$("#check_pin").modal('hide');
	$("#reset_oyapin").modal();
}
function reset_transfer_pin()
{
	var user_email=$("#reset_transfer_oyapin").val();
	var user_id=$("#reset_user_id").val();
	$.ajax({
			url : base_url + "reset_oyapin",
			type : "POST",
			data : {
				'user_email' : user_email,
				'user_id' : user_id

			},
			success : function(data) {
				
				var getdata = jQuery.parseJSON(data);
				var status = getdata.status;
				var message = getdata.message;
				$("#pin_change_status").text(message);
				setInterval(function() {
     $("#reset_oyapin").modal('hide');
}, 3000);
			}
		});
}
// function app link send to mobile no

function send_link()
{
	
	var mobile_no=$("#exampleInputname1").val();
	
	if(mobile_no.length == 11)
	{
		$.ajax({
		url : base_url + "send_app_link",
		type : "POST",
		data : {
			'mobile_no' : mobile_no

		},
		success : function(data) {
			$("#popup").modal('hide');
			$("#link_msg").html("Link sent to your contact no.");
$("#exampleInputname1").val('');
		}
	});
	}else{
		
		$("#link_msg").html("Please Enter valid contact no.");
	}
}
// function show terms and conditions of promotional offer
function show_terms_condtions(id)
	{
	
		
		$.ajax({
		url : base_url + "promotional_offer_terms",

		type : "POST",
		data : {
			'free_offer_id' : id

		},
		success : function(data) {
		$("#t_c").modal();

		var getdata = jQuery.parseJSON(data);
			var status = getdata.status;
			var html='';
			
				 var lines = getdata.coupon_terms.split('<br/>');
				  jQuery.each(lines, function() {
				 
				html += '<li style="display:block"><p>'+lines+'</p></li>';
				});
				$("#terms").html(html);
			
			
			}

		
		
	});
	}
// select operator from index page///
function select_mobile_operator(id, operator_name) {

	$("#mobile_operator_id").val(id);
	$("#mobile_operator_name").text(operator_name);
	$("#next_recharge").attr('style', 'display: block');
}

function select_dth_operator(id, operator_name) {
	$("#dth_operator_id").val(id);
	$("#dth_operator_name").text(operator_name);
	$("#dth_operator").modal('hide');
	$("#tv_prev, #tv_next").attr('style', 'display: block');
}

function select_datacard_operator(id, operator_name) {
	$("#datacard_operator_id").val(id);
	$("#datacard_operator_name").text(operator_name);
	$("#datacard_operator").modal('hide');
	$("#datacard_prev, #datacard_next").attr('style', 'display: block');
}
function select_electricty_operator(id, operator_name) {
	$("#electricty_operator_id").val(id);
	$("#electricity_operator_name").text(operator_name);
	$("#electricity_operator").modal('hide');
	$("#delectricity_prev, #electricity_next").attr('style', 'display: block');
}
function select_church_type(id,church_type)
{
	//alert(church_type);
	$("#church_category_id").val(id);
	$("#church_type").text(church_type);
	$("#churchtype_model").modal('hide');
	$("#church_prev, #church_next").attr('style', 'display: block');
}
function select_church_by_name(id,church_name,church_biller_id)
{
	//alert(church_type);
	$("#church_biller_id").val(church_biller_id);
	$("#church_selected_id").val(id);
	$("#select_church_name").text(church_name);
	$("#select_church_model").modal('hide');
	$("#church_prev, #church_next").attr('style', 'display: block');
}
function select_event_type(id,church_type)
{
	//alert(church_type);
	$("#event_category_id").val(id);
	$("#event_type").text(church_type);
	$("#eventtype_model").modal('hide');
	$("#event_prev, #event_next").attr('style', 'display: block');
}
function select_event_by_name(id,event_name,event_biller_id)
{
	//alert(church_type);
	$("#event_biller_id").val(event_biller_id);
	$("#event_selected_id").val(id);
	$("#select_event_name").text(event_name);
	$("#select_event").modal('hide');
	$.ajax({
		url : base_url + "get_event",

		type : "POST",
		data : {
			'event_id' : id

		},
		success : function(data) {
			
		var getdata = jQuery.parseJSON(data);
			var status = getdata.status;
			var html='';
			if(status=='true')
			{
					$("#event_details").modal();
				
				$("#select_event_name").text(getdata.event_name);
				html += '<div style="width:360px!important;" class="modal-dialog modal-sm "><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><h5 class="modal-title" id="gridSystemModalLabel">Event Details</h5></div><div class="modal-body"><img width="100%" height="100px" src="'+getdata.event_image+'" alt="..."/>';
         html += '<div class="event_detail_list"><ul type="none"><li class="big_font"><strong>'+getdata.event_name+'</strong></li></ul></div>';
         html += '<div class="event_detail_list"><ul type="none"><li>'+getdata.event_datetime+'</li><li class="right"><span><img src="<?php echo base_url(); ?>webassets/images/currency.png" alt="..."/></span><strong id="amt_price">0</strong></li><li>'+getdata.event_place+'</li></ul></div>';
         html += '<div class="descrptn"><dl><dt>Description</dt><dd>'+getdata.event_desc+'</dd></dl></div><input type="hidden" id="csv_ticket_ids" value="'+getdata.event_tickets_ids+'"><input type="hidden" id="event_id" value="'+getdata.event_id+'"><input type="hidden" id="final_amt_ticket" value="0">';
         	
         	html += '<div class="event-details">';
         
         	
         	$.each(getdata.event_pass, function(key, value) {
         		//alert("event_btn_id"+value.event_ticket_id);
         		$("#event_btn_id"+value.event_ticket_id).removeClass("btn-default").addClass("btn-green");
         	html += '<a onclick="select_event_ticket('+value.event_ticket_id+','+value.event_price+')" class="btn-green btn-padding" id="event_btn_id'+value.event_ticket_id+'">'+value.event_pass_name+'<input type="hidden" id="event_ticket_id'+value.event_ticket_id+'" value="'+value.event_ticket_id+'"><input type="hidden" id="event_ticket_price'+value.event_ticket_id+'" value="'+value.event_price+'"><input type="hidden" id="select_ticket_value'+value.event_ticket_id+'" value=""><input type="hidden" id="click_event_id" value="'+value.event_ticket_id+'"><input type="hidden" id="click_event_price" value="'+value.event_price+'"><input type="hidden" id="total_price_ticket" value="0"></a>&nbsp;';
         	});
         	
            html += '</div>&nbsp;';
            $.each(getdata.event_pass, function(key, value) {
 		html += '<div style="float:left;position:relative;top:10px;margin-left:22px;">'+value.event_price+'</div>&nbsp;&nbsp;';
 });
  html += '<div class="padding"><div class="pull-left"><span>Ticket Quantity</span></div>';
            html += '<div class="sp-quantity pull-right"><div class="sp-plus fff"><a class="ddd" href="#" data-multi="1" onclick="add_ticket()">+</a></div><div class="sp-input"><input id="ticket_value" type="text" class="quntity-input" value="0" readonly="" /></div><div class="sp-minus fff"><a class="ddd" href="#" data-multi="-1" onclick="minus_ticket()">-</a></div></div></div>';
           html += '<button class="event-submit-btn" onclick="check_ticket_avaliblity()" id="btn_book">Book</button><div id="error_status_ticket"></div></div></div></div>';
		  
			$("#event_details").html(html);
			}

		
		}
	});

	$("#event_prev, #event_next").attr('style', 'display: block');
}
function select_event_ticket(event_id,event_ticket_price)

{
	var amt=$("#total_price_ticket").val();
	$("#final_amt_ticket").val(amt);
	$("#click_event_id").val(event_id);
	$("#click_event_price").val(event_ticket_price);
	var previous_val =+ $("#select_ticket_value"+event_id).val();
		$("#select_ticket_value"+event_id).val(previous_val);
			var val =+ $("#select_ticket_value"+event_id).val();
		var ticket_val=$("#ticket_value").val(val);
}
function add_ticket()
{
	
	var event_id=$("#click_event_id").val();
	var price_event =+ $("#event_ticket_price"+event_id).val();
	var previous_val =+ $("#select_ticket_value"+event_id).val();
	var val=$("#ticket_value").val();
	var v =+ val+1;
	$("#ticket_value").val(v);
	var price=parseInt(price_event);
//	var amt=$("#final_amt_ticket").val();
	var amt=$("#amt_price").text();
	$("#total_price_ticket").val(parseInt(price)+parseInt(amt));
//$("#total_price_ticket").val(parseInt(price)+parseInt(p));
$("#amt_price").text(parseInt(price)+parseInt(amt));
	$("#select_ticket_value"+event_id).val(parseInt(v));
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
		   		  alert(value.ticket_name+'avlible is:'+value.ticket_limit);
		  
			
		   	}
			});
			
				if(ticket_not_avalible ==''){
			
			$("#event_details").modal('hide');
					var amt1=$("#total_price_ticket").val();
					localStorage.setItem("ticket_amount",amt1);
					localStorage.setItem("ticket_json_array",jsonAsString);
					localStorage.setItem("event_id",event_id);
					//localStorage["jsonAsString"] = $.stringify(jsonAsString);
					$.ajax({
					url : site_url + "check_login",
					type : "POST",
					data : {
					'event_id' : event_id,
					'total_price_ticket' : amt1,
					'ticket_json_array' : jsonAsString
					
					},
					success : function(data) {

					if (data == '2') {
						$('#loginPop').modal();
					} else if (data == '1') {
						location.href = site_url + "event_booking";
					}
				}
			});
				}			
			}else{
				$("#error_status_ticket").text("Please select atleast one ticket");
			}

		
		}
	});
	
		
	
}

function show_biller_category() {
	$("#biller_category").modal();
}

function select_biller_category(id, operator_name) {
	$("#biller_category_id").val(id);
	$("#biller_category_name").text(operator_name);
	$("#biller_category").modal('hide');
	$("#bill_recharge_next").attr('style', 'display: block');
}

function select_biller_provider(id, company) {
	$("#biller_service_provider_id").val(id);
	$("#service_provider_name").text(company);

}
$(function () {
  $('[data-toggle="tooltip"]').tooltip();
});
// function onclick function of select church
function select_church()
{

	var church_category_id=$("#church_category_id").val();
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
				$("#select_church_model").modal();
				$.each(getdata.church_list, function(key, value) {
				var church_name = value.church_name;
				var church_id = value.church_id;
				var church_biller_id=value.church_biller_id;
				html += '<li><label style="cursor:pointer" data-dismiss="modal" aria-label="Close"><img  data-toggle="tooltip" data-placement="top" title="'+church_name+'" style="cursor: pointer" width="70" height="70" class="img-circle" onclick="select_church_by_name(' + church_id + ',&quot;' + church_name + '&quot;,' + church_biller_id + ')" src=' + value.church_img + ' alt="..."   >';

				html += '<input type="radio" class="operatorRadio"/></label></li>';
			});
			$("#church_final_list_id").html(html);
			}

		
		}
	});
}
// function select event list
function select_event()
{

	var event_category_id=$("#event_category_id").val();
	
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
				$("#select_event").modal();
				$.each(getdata.event_list, function(key, value) {
				var event_name = value.event_name;
				var event_id = value.event_id;
				var event_biller_id=value.event_biller_id;
				html += '<li><label style="cursor:pointer" data-dismiss="modal" aria-label="Close"><img  data-toggle="tooltip" data-placement="top" title="'+event_name+'" style="cursor: pointer" width="70" height="70" class="img-circle" onclick="select_event_by_name(' + event_id + ',&quot;' + event_name + '&quot;,' + event_biller_id + ')" src=' + value.event_image + ' alt="..."   >';

				html += '<input type="radio" class="operatorRadio"/></label></li>';
			});
			$("#event_final_list_id").html(html);
			}

		
		}
	});
}

function show_service_provider() {
	$("#service_provider").modal();
	var biller_category_id = $("#biller_category_id").val();
	$.ajax({
		url : base_url + "bill_service_provider",
		type : "POST",
		data : {
			'biller_category' : biller_category_id

		},
		success : function(data) {
			$("#service_provider").modal();
			var getdata = jQuery.parseJSON(data);
			var html = '';
			$.each(getdata.service_provider, function(key, value) {
				var company_name = value.company;
				var biller_id = value.biller_id;

				html += '<li><label style="cursor:pointer" data-dismiss="modal" aria-label="Close"><img width="100%" onclick="select_biller_provider(' + biller_id + ',&quot;' + company_name + '&quot;)" src=' + value.biller_company_logo + ' alt="..."/ >';

				html += '<input type="radio" class="operatorRadio"/></label></li>';
			});

			$("#service_provider_list123").html(html);

		}
	});
}

function check_consumer_number() {
	var consumer_number = $("#consumer_number").val();
	if (consumer_number == '') {
		$("#consumer_number").attr('style', 'border-color: red!important');
		$("#error_consumer_no").text('Please Enter consumer number');
	} else if (isNaN(consumer_number)) {
		$("#consumer_number").attr('style', 'border-color: red!important');
		$("#error_consumer_no").text('Please Enter a valid consumer number');
	} else {
		$("#consumer_number").attr('style', 'border-color:');
		$("#error_consumer_no").hide();

	}
}

//// function pay bill from genrated by biller...
function pay_bill() {
	var biller_category_id = $("#biller_category_id").val();
	var biller_service_id = $("#biller_service_provider_id").val();
	var consumer_number = $("#consumer_number").val();
	if (biller_category_id == '') {
		$("#id_biller").attr('style', 'border-color: red!important');
	} else if (biller_service_id == '') {

		$("#id_service").attr('style', 'border-color: red!important');
	} else if (consumer_number == '') {
		$("#consumer_number").attr('style', 'border-color: red!important');
		$("#error_consumer_no").text('Please Enter consumer number');
	} else if (isNaN(consumer_number)) {
		$("#consumer_number").attr('style', 'border-color: red!important');
		$("#error_consumer_no").text('Please Enter a valid consumer number');
	} else {

		$.ajax({
			url : base_url + "get_consumer_details",
			type : "POST",
			data : {
				'biller_id' : biller_service_id,
				'consumer_no' : consumer_number

			},
			success : function(data) {
				var getdata = jQuery.parseJSON(data);
				var status = getdata.status;
				var message = getdata.message;
				if (status == 'true') {
					$.ajax({
						url : site_url + "check_login",
						type : "POST",
						data : {
							'biller_category_id' : biller_category_id,
							'biller_service_id' : biller_service_id,
							'consumer_number' : consumer_number

						},
						success : function(data) {

							if (data == '2') {
								$('#loginPop').modal();
							} else if (data == '1') {
								location.href = site_url + "pay_bill?consumer_number=" + consumer_number + "&biller_category_id=" + biller_category_id + "&biller_service_id=" + biller_service_id;
							}
						}
					});
				} else {
					$("#consumer_number").attr('style', 'border-color: red!important');
					$("#error_consumer_no").show();
					$("#error_consumer_no").text(message);
				}
			}
		});

	}
}

// Header page////
function home() {
	location.href = site_url + "home";
}

// close of popup of main page recharge type//////////
function close_pop_field() {
	$("#mRechargeSlider").removeClass('active');
	$("#tvRechargeSlider").removeClass('active');
	$("#dataRechargeSlider").removeClass('active');
	$("#electricityRechargeSlider").removeClass('active');
	$("#tollRechargeSlider").removeClass('active');
	$("#billerRechargeSlider").removeClass('active');
}

function change_number() {
	$('#OTP').modal('hide');
	$('#upgrate').modal();
}

function resend_otp() {
	//	var user_id=$("#user_id").val();
	var mb_number = $("#mb_number").val();

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
				$("#mob").text(mb_number);
				$("#otp_msg").text(message);
			} else {

			}
		}
	});
}

function check_signup_number() {
	var user_mobile = $("#user_mobile").val();
	if (user_mobile != '') {
		$("#user_mobile").attr('style', 'border-color: white');
	}
	if (isNaN(user_mobile)) {
		$("#user_mobile").attr('style', 'border-color: red');
		$("#signup_msg").text('Please Enter a valid number');
	}
	if (user_mobile.length < 11 || user_mobile.length > 11) {
		$("#user_mobile").attr('style', 'border-color: red');
		$("#signup_msg").text('Please Enter a 11 digit mobile number');
	}

}

function check_reffer_code() {
	var reffer_code = $("#reffer_code").val();
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
				$('#signup_msg').text(message);

			} else {
				$('#signup_msg').text(message);
			}
		}
	});
}

function check_password() {

	var user_password = $("#user_password").val();
	if (user_password != '') {
		$("#user_password").attr('style', 'border-color: white');
	}
	if (user_password.length < 6) {
		$("#user_password").attr('style', 'border-color: red');
		$("#signup_msg").text('Password atleast 6 character');
	}
}

function check_email() {
	var user_email = $("#user_email").val();
	if (user_email != '') {
		if (validateEmail(user_email)) {
			$("#user_email").attr('style', 'border-color: ');
			$("#signup_msg").text('');
		} else {
			$("#user_email").attr('style', 'border-color: red');
			$("#signup_msg").text('Please Enter a valid email');

		}
	} else {
		$("#user_email").attr('style', 'border-color: ');
		$("#signup_msg").text('');
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

function signup_user() {

	function validateEmail(sEmail) {
		var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
		if (filter.test(sEmail)) {
			return true;
		} else {
			return false;
		}
	}

	var user_mobile = $("#user_mobile").val();
	var reffer_code = $("#reffer_code").val();
	var user_email = $("#user_email").val();
	var user_password = $("#user_password").val();
	if (user_mobile == '') {
		$("#user_mobile").attr('style', 'border-color: red');
		$("#signup_msg").text('Please Enter Mobile Number');
	} else if (isNaN(user_mobile)) {
		$("#user_mobile").attr('style', 'border-color: red');
		$("#signup_msg").text('Please Enter a valid number');
	} else if (user_mobile.length < 11 || user_mobile.length > 11) {
		$("#user_mobile").attr('style', 'border-color: red');
		$("#signup_msg").text('Please Enter a 11 digit number');
	}
	else if (user_email == '') {
		$("#user_email").attr('style', 'border-color: red');
		$("#signup_msg").text('Please Enter email account');
	} 
	// else if(user_email !=''){
	//if (validateEmail(user_email)) {

	//}
	//else
	// {
	//	$("#user_email").attr('style','border-color: red');
	//	$("#signup_msg").text('Please Enter a valid email');

	//}

	//}
	else if (user_password.length < 6) {
		$("#user_password").attr('style', 'border-color: red');
		$("#signup_msg").text('Password atleast 6 character');
	} else if ((user_mobile != '') && (user_password != '')) {

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
					$("#user_reffer_code").val(reffer_code);
					$("#user_signup_id").val(user_id);
					$('#signup').modal('hide');
					$('#OTP').modal();
				} else {
					if (status == 'not_verify') {
						$("#mob").text(user_mobile);
						$("#mb_number").val(user_mobile);
						$('#signup').modal('hide');
						$('#OTP').modal();
					}
					$("#signup_msg").text(message);
					if (msg_status == '1') {
						$("#user_mobile").attr('style', 'border-color: red');
					} else if (msg_status == '2') {
						$("#user_email").attr('style', 'border-color: red');
					}

				}
			}
		});

	} else {
		if (user_mobile == '' && user_password == '') {
			$("#user_mobile").attr('style', 'border-color: red');
			$("#user_password").attr('style', 'border-color: red');
		}
		$("#signup_msg").text("These Field Are Required");
		if (user_mobile == '') {
			$("#user_mobile").attr('style', 'border-color: red');
		} else if (user_password == '') {
			$("#user_password").attr('style', 'border-color: red');
		}
		if (user_mobile != '') {
			$("#user_mobile").attr('style', 'border-color: white');
		}

		if (user_password != '') {
			$("#user_password").attr('style', 'border-color: white');
		}
		if (user_email != '') {
			$("#user_email").attr('style', 'border-color: white');
		}
	}
}

function send_otp() {

	var user_id = $("#userid").val();
	var mb_number = $("#mb_number").val();

	$('#mob').text(mb_number);

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
				$('#upgrate').modal('hide');
				$('#OTP').modal();
			} else {
				//$('#upgrate').modal();
				$("#mb_number").attr('style', 'border-color: red');
				$("#msg_num").text(message);
			}
		}
	});
}

function confirm_number() {
	var mb_number = $("#mb_number").val();

	var otp_code = $("#otp_code").val();
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
					$('#OTP').modal('hide');
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
									profile()
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
									profile()
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
					$("#otp_msg").text(message);
				}
			}
		});
	} else {
		$("#otp_code").attr('style', 'border-color: red');
		$("#otp_msg").text('Please Enter OTP Code');
	}
}

function check_login_filed() {
	var user_login = $("#user_name").val();
	var user_password = $("#user_pass").val();
	if (user_login != '') {
		$("#response_failed").text('');
		$("#user_name").attr('style', 'border-color: ');
	}
	if (user_password != '')
		$("#user_pass").attr('style', 'border-color: ');
	$("#response_failed").text('');
}

function user_login() {
	var user_login = $("#user_name").val();
	var user_password = $("#user_pass").val();

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
				var user_id = getdata.user_id;
				if (status == 'true') {

					var user_id = getdata.user_id;

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
						url : site_url + "user_login",
						type : "POST",
						data : {
							'user_id' : user_id,
							'user_name' : user_name,
							'user_email' : user_email,
							'user_mobile' : user_contact_no,
							'user_wallet' : user_wallet,
							'user_password' : user_password,
							'login_type' : login_type

						},
						success : function(data) {

						}
					});
					//	$("#response_success").text(message);
					if (getdata.mobile == '') {

					} else {

						setInterval(function() {
							profile()
						}, 1000);
					}
				} else if (status == 'false') {
					$("#response_failed").text(message);
					$("#user_name").attr('style', 'border-color: red');
					$("#user_pass").attr('style', 'border-color: red');
				} else if (status == 'not_verify') {

					$("#mb_number").val(mobile);
					$("#mob").val(mobile);
					$('#loginPop').modal('hide');
					$('#OTP').modal();
				}
			}

		}
	});
}

function upgrade_pop() {
	$('#loginPop').modal('hide');
	$('#upgrate').modal();
}

function profile() {
	$("#loader").attr('style', 'display: none');
	var mobile = $("#mobile").val();
	var tv_number = $("#tv_number").val();
	var data_card_number = $("#data_card_number").val();
	var consumer_no = $("#consumer_number").val();
	var electric_card_number = $("#electric_card_number").val();
	var church_price = $("#church_price").val();
	var event_selected_id = $("#event_selected_id").val();
	if (mobile) {
		var prepaid = $("#prepaid").val();
		var mobile_operator_id = $("#mobile_operator_id").val();
		var mobile_amount = $("#mobile_amount").val();
		location.href = site_url + "my_recharge?mobile=" + mobile + "&prepaid=" + prepaid + "&mobile_operator_id=" + mobile_operator_id + "&mobile_amount=" + mobile_amount;
	} else if (tv_number) {
		var tv_number = $("#tv_number").val();
		var tv_mobile_operator = $("#dth_operator_id").val();
		var tv_rec_amount = $("#tv_rec_amount").val();
		location.href = site_url + "tv_recharge?tv_number=" + tv_number + "&tv_operator_id=" + tv_mobile_operator + "&tv_rec_amount=" + tv_rec_amount;
	} else if (data_card_number) {
		var datacard_operator = $("#datacard_operator_id").val();
		var datacard_amount = $("#datacard_amount").val();
		var data_prepaid = $("#data_prepaid").val();
		location.href = site_url + "datacard_recharge?data_card_number=" + data_card_number + "&data_operator_id=" + datacard_operator + "&data_rec_amount=" + datacard_amount + "&data_prepaid=" + data_prepaid;
	} else if (consumer_no) {
		var consumer_no = $("#consumer_number").val();
		var biller_category_id = $("#biller_category_id").val();
		var biller_service_id = $("#biller_service_provider_id").val();
		location.href = site_url + "pay_bill?consumer_number=" + consumer_no + "&biller_category_id=" + biller_category_id + "&biller_service_id=" + biller_service_id;
	} else if (electric_card_number) {
		var electric_card_number = $("#electric_card_number").val();
		var electricty_operator_id = $("#electricty_operator_id").val();
		var electrice_amount = $("#electrice_amount").val();
		location.href = site_url + "electric_recharge?electric_card_number=" + electric_card_number + "&electricty_operator_id=" + electricty_operator_id + "&electrice_amount=" + electrice_amount;
	} else if (church_price) {
		var church_price = $("#church_price").val();
		var church_category_id = $("#church_category_id").val();
		var church_id = $("#church_selected_id").val();
		var church_biller_id=$("#church_biller_id").val();
		var church_p_id=$("#church_p_id").val();
		location.href = site_url + "church_recharge?church_price=" + church_price + "&church_category_id=" + church_category_id + "&church_id=" + church_id+ "&church_biller_id=" + church_biller_id+ "&church_p_id=" + church_p_id;
	}
	else if(event_selected_id)
	{
		location.href = site_url + "event_booking";
	} else {
		location.href = home_url;
	}

}

////facebook login///

window.fbAsyncInit = function() {
	FB.init({
		appId : '182570062196832',
		cookie : true, // enable cookies to allow the server to access
		// the session
		xfbml : true, // parse social plugins on this page
		version : 'v2.5' // use version 2.5
	});
};

// Load the SDK asynchronously
( function(d, s, id) {
		var js,
		    fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id))
			return;
		js = d.createElement(s);
		js.id = id;
		js.src = "//connect.facebook.net/en_US/sdk.js";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));

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

						$("#overlay").hide();
						var getdata = jQuery.parseJSON(data);
						var status = getdata.status;
						var message = getdata.message;
						var verify_status = getdata.verify_status;
						var user_id = getdata.user_id;
						$("#userid").val(user_id);
						var mobile = getdata.user_contact_no;
						var user_name = getdata.user_name;
						var user_name = getdata.user_name;
						var frnd_refferal_code = getdata.frnd_refferal_code;
						var user_pin_status = getdata.user_pin_status;

						var user_wallet = '0';
						//alert(user_name);
						if (status == 'true') {
							$.ajax({
								url : site_url + "fb_login",
								type : "POST",
								data : {
									'user_id' : user_id,
									'user_name' : user_name,
									'user_email' : email,
									'user_wallet' : user_wallet,
									'login_type' : login_type,
									'verify_status' : verify_status,
									'frnd_reffer_code' : frnd_refferal_code,
									'user_pin_status' : user_pin_status

								},
								success : function(data) {

								}
							});

							//   $("#response_success").text(message);
							if (verify_status == '2') {
								$('#loginPop').modal('hide');
								$('#upgrate').modal();
								//	setInterval(function(){upgrade_pop()}, 1000);
							} else {

								setInterval(function() {
									profile()
								}, 1000);
							}
						} else if (status == 'false') {
							$("#response_success").text(message);
						} else if (status == 'inactive') {
							$('#loginPop').modal();
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

//// google login/////
function google_login() {
	var mobile = $("#mobile").val();
	var tv_number = $("#tv_number").val();
	var data_card_number = $("#data_card_number").val();
	var prepaid = $("#prepaid").val();
	var mobile_operator_id = $("#mobile_operator_id").val();
	var mobile_amount = $("#mobile_amount").val();
	var tv_mobile_operator = $("#tv_operator_id").val();
	var tv_rec_amount = $("#tv_rec_amount").val();
	var datacard_operator = $("#datacard_operator_id").val();
	var datacard_amount = $("#datacard_amount").val();
	var data_prepaid = $("#data_prepaid").val();
	$.ajax({
		url : site_url + "google_login/Google",
		type : "POST",
		data : {
			'login_id' : 1,
		},
		success : function(data) {
			var getdata = jQuery.parseJSON(data);
			var status = getdata.status;

		}
	});
}

//// forget password///

function forget_password1() {
	//alert();
	var login_id = $("#login_id");
	$.ajax({
		url : base_url + "forget_password",
		type : "POST",
		data : {
			'login_id' : login_id,
		},
		success : function(data) {
			
			var getdata = jQuery.parseJSON(data);
			var status = getdata.status;
			var message = getdata.message;
			$("#response_success").text(message);
		}
	});

}

//index.php page///

var i = 0;
var j = 0;
function show_preview() {
	$("#rec_category").val(1);
	var mobile_number = $("#mobile").val();
	$.ajax({
		url : base_url + "check_operator",
		type : "POST",
		data : {
			'mobile' : mobile_number

		},
		success : function(data) {

			var getdata = jQuery.parseJSON(data);
			var operator_id = getdata.operator_id;
			var operator_name = getdata.operator_name;
			if (operator_id) {
				$("#mobile_operator_name").html(operator_name);
				$("#mobile_operator_id").val(operator_id);
			} else {
				$("#mobile_operator_name").html("Select Operator");
			}

		}
	});
	if (i < 4) {
		i++;
	}

	if (i == 1) {
		$("#preview_recharge").attr('style', 'display: block');
	}
	if(i == 2)
	{
			$("#next_recharge").attr('style', 'display: none');
	}
	if (i == 4) {
		//i=0;
		var mobile = $("#mobile").val();
		var prepaid = $("#prepaid").val();
		var mobile_operator_id = $("#mobile_operator_id").val();
		var mobile_amount = $("#mobile_amount").val();

		if (mobile_amount == '' || mobile_amount < 50 || mobile_amount > 10000) {

			$("#mobile_amount").attr('style', 'border-color: red!important');
			$("#amount_error").text("Please enter amount between 50 and 10000");
		} else {
			$.ajax({
				url : site_url + "check_login",
				type : "POST",
				data : {
					'mobile' : mobile,
					'prepaid' : prepaid,
					'mobile_operator_id' : mobile_operator_id,
					'mobile_amount' : mobile_amount
				},
				success : function(data) {

					if (data == '2') {
						$('#loginPop').modal();
					} else if (data == '1') {
						location.href = site_url + "my_recharge?mobile=" + mobile + "&prepaid=" + prepaid + "&mobile_operator_id=" + mobile_operator_id + "&mobile_amount=" + mobile_amount;
					}
				}
			});
		}
i--;
	}
	
}
function back_mobile_prev()
	{
		i--;
		if(i!=2)
		{
			$("#next_recharge").attr('style', 'display: block');
		}
	}
// tv recharge

var k = 0;

function show_tv_prev() {
	$("#rec_category").val(2);
	if (k < 3) {
		k++;
}
	if (k == 1) {
		$("#tv_prev").attr('style', 'display: block');
		$("#tv_next").attr('style', 'display: none');

	}
if(k==2){
	$("#tv_next").attr('style', 'display: none');
	var tv_number = $("#tv_number").val();
	var tv_operator_id = $("#dth_operator_id").val();
	
	$.ajax({
		url : base_url + "validate_tv_number",
		type : "POST",
		data : {
			'tv_number' : tv_number,
			'tv_operator_id' : tv_operator_id

		},
		success : function(data) {

			var getdata = jQuery.parseJSON(data);
				var status=getdata.status;
				if(status=='true')
				{
					$("#tv_next").attr('style', 'display: show');
					var customer_name = getdata.customer_name;
						$("#tv_number_name").val(customer_name);
						$("#service_id").val(getdata.service_id);
						$("#tv_new_number").val(getdata.customer_no);
				}else{
					var message = getdata.message;
				$("#tv_number_name").val(message);
				$("#tv_next").attr('style', 'display: none');
				}
				
				
				
			}
		
	});
}

	if (k == 3) {
		//i=0;
		var tv_operator_id = $("#dth_operator_id").val();
		var tv_number=$("#tv_new_number").val();
		var tv_rec_amount = $("#tv_rec_amount").val();
		var tv_rec_code = $("#tv_rec_code").val();
		var tv_number_name = $("#tv_number_name").val();
		localStorage.setItem("tv_rec_code",tv_rec_code);
		localStorage.setItem("tv_number_name",tv_number_name);
		localStorage.setItem("tv_customer_no",tv_number);
		if (tv_rec_amount == '') {

			$("#tv_rec_amount").attr('style', 'border-color: red!important');
		} else {
			$.ajax({
				url : site_url + "check_login",
				type : "POST",
				data : {
					'tv_number' : tv_number,
					'tv_operator_id' : tv_operator_id,
					'tv_rec_amount' : tv_rec_amount

				},
				success : function(data) {

					if (data == '2') {
						$('#loginPop').modal();
					} else if (data == '1') {
						location.href = site_url + "tv_recharge?tv_number=" + tv_number + "&tv_operator_id=" + tv_operator_id + "&tv_rec_amount=" + tv_rec_amount;
					}
				}
			});
		}
k--;
	}
	// alert(i);

}
function tv_prev_btn()
{
	k--;
	if(k!=1)
	{
		$("#tv_next").attr('style', 'display: none');
	}else{
		$("#tv_next").attr('style', 'display: block');
	}
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

	}
	if (dth_operator_id) {

		plan_operator_id = dth_operator_id;
	}
	if (data_operator_id) {
		plan_operator_id = data_operator_id;
	}
	if (mobile_operator_id) {
		var plan_type = '1';
	} else if (dth_operator_id) {
		var plan_type = '2';
	} else if (data_operator_id) {
		var plan_type = '3';
	}
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
			$("#RechagePlan").modal();
			var getdata = jQuery.parseJSON(data);
			var status = getdata.status;
			$("#operator_name").text(getdata.operator_name);
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
var l = 0;
function show_data_prev() {
	$("#rec_category").val(3);
	if (l < 3) {
		l++;
	}
	if (l == 1) {
		$("#datacard_prev").attr('style', 'display: block');
	}
	if (l == 2) {
		
	//$("#datacard_next").attr('style', 'display: block');
	$("#datacard_prev").attr('style', 'display: block');;
	//	var data_prepaid = $("#data_prepaid").val();
		var data_card_number = $("#data_card_number").val();
		var datacard_operator_id = $("#datacard_operator_id").val();
	
	$.ajax({
		url : base_url + "validate_data_number",
		type : "POST",
		data : {
			'data_number' : data_card_number,
			'data_operator_id' : datacard_operator_id

		},
		success : function(data) {

			var getdata = jQuery.parseJSON(data);
				var status=getdata.status;
				if(status=='true')
				{
					$("#datacard_next").attr('style', 'display: block');
					var customer_name = getdata.customer_name;
						$("#data_card_number_name12").val(customer_name);
						if(getdata.plans=='')
						{
							$("#plan_div").attr('style', 'display: none');
							$('#datacard_amount').attr('readonly', 'false');
						}else{
							$("#plan_div").attr('style', 'display: block');
							$('#datacard_amount').attr('readonly', 'true');
						}
				}else{
					var message = getdata.message;
					
				$("#data_card_number_name12").val(message);
				$("#datacard_next").attr('style', 'display: none');
				}
				
				
				
			}
		
	});
	}
	if (l == 3) {
		//i=0;
		
		var data_card_number = $("#data_card_number").val();
		var data_rec_amount = $("#datacard_amount").val();
		var data_code=$("#datacard_typecode").val();
		var datacard_operator_id = $("#datacard_operator_id").val();
		localStorage.setItem("tv_rec_code",data_code);
		if (data_rec_amount == '') {

			$("#datacard_amount").attr('style', 'border-color: red!important');
		} else {
			$.ajax({
				url : site_url + "check_login",
				type : "POST",
				data : {
					'data_card_number' : data_card_number,
					'data_operator_id' : datacard_operator_id,
					'data_rec_amount' : data_rec_amount

				},
				success : function(data) {

					if (data == '2') {
						$('#loginPop').modal();
					} else if (data == '1') {
						location.href = site_url + "datacard_recharge?data_card_number=" + data_card_number + "&data_operator_id=" + datacard_operator_id + "&data_rec_amount=" + data_rec_amount;
					}
				}
			});
		}
l--;
	}

}
function datacard_prev_btn()
{
	l--;
	if(l!=2)
	{
		$("#datacard_next").attr('style', 'display: block');
	}else{
		$("#datacard_next").attr('style', 'display: none');
	}
}


// plan list from api of data card
function data_plan()
{
	$("#RechagePlan").modal();
	var data_operator_id = '';
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
			
			var getdata = jQuery.parseJSON(data);
			var status = getdata.status;
			$("#operator_name").text(getdata.operator_name);
			// $("#plan_dynamic_id").val(value.default_plan_category);
		
				var html = '';
				var html1 = '';
				
				$.each(getdata.plans, function(key, value) { 
					
					html += '<a href="#" onclick="get_amount(' + value.amount + ',3,' + value.typeCode + ')"><div class="plan_list">';
					html += '<div class="plan_rate">₦<span id="select_amount">' + value.amount + '</span></div>';
					html += '<div class="plan_details"><p><span class="operator_name">' + value.description + '</span> </p>';
					

					html += '<div class="clearfix"></div></div></div></a>';
					//  }

				});
				$("#plan_category_list").html(html1);
				$("#Recommende").html(html);

			
		}
	});
}
var m = 0;
function show_bill_prev() {

	var biller_category_id = $("#biller_category_id").val();

	//$("#mobile_amount").val('');
	if (m < 2) {
		m++;
	}
	if (m == 1) {
		$("#bi_category").removeClass('active');
		$("#bi_service").addClass('active');
		$.ajax({
			url : base_url + "bill_service_provider",
			type : "POST",
			data : {
				'biller_category' : biller_category_id

			},
			success : function(data) {
				$("#service_provider").modal();
				var getdata = jQuery.parseJSON(data);
				var html = '';
				$.each(getdata.service_provider, function(key, value) {
					var company_name = value.biller_company_name;

					html += '<li><label data-dismiss="modal" aria-label="Close"><img width="100%" onclick="select_biller_provider(' + value.biller_id + ',' + company_name.toString() + ')" src=' + value.biller_company_logo + ' alt="..."/ >';

					html += '<input type="radio" class="operatorRadio"/></label></li>';
				});

				$("#service_provider_list123").html(html);

			}
		});
		$("#bill_recharge_prev").attr('style', 'display: block');
	}

	

}
var r=0;
function show_electricity_prev() {
	$("#rec_category").val(5);
	if (r < 3) {
		r++;
	}

	if (r == 1) {
		$("#electricity_prev").attr('style', 'display: block');
		//$("#electricity_next").attr('style','display:none');

	}

	if (r == 3) {
		//i=0;
		var electric_card_number = $("#electric_card_number").val();

		var electricty_operator_id = $("#electricty_operator_id").val();

		var electrice_amount = $("#electrice_amount").val();

		if (electrice_amount == '') {

			$("#electrice_amount").attr('style', 'border-color: red!important');
		} else {
			$.ajax({
				url : site_url + "check_login",
				type : "POST",
				data : {
					'electric_card_number' : electric_card_number,
					'electricty_operator_id' : electricty_operator_id,
					'electrice_amount' : electrice_amount

				},
				success : function(data) {

					if (data == '2') {
						$('#loginPop').modal();
					} else if (data == '1') {
						location.href = site_url + "electric_recharge?electric_card_number=" + electric_card_number + "&electricty_operator_id=" + electricty_operator_id + "&electrice_amount=" + electrice_amount;
					}
				}
			});
		}

	}
	// alert(i);

}


function hide_preview() {
	$("#mobile_amount").removeAttr('style', 'border-color: red');
	if (i >= 0) {
		//$("#mobile_amount").removeAttr('style','border-color: red');
		i--;
	}
	if (i == 0) {
		$('#preview_recharge').css('display', 'none');
	}
	//alert(i);

}
// show church neext prev button
var s=0;
function show_church_next()
{
	$("#rec_category").val(6);
	if (s <4 ) {
		s++;
	}

	if (s == 1) {
		$("#church_prev").attr('style', 'display: block');
		//$("#electricity_next").attr('style','display:none');

	}
		if(s==2)
		{
			var church_selected_id=$("#church_selected_id").val();
			$.ajax({
			url : base_url + "church_details",
			type : "POST",
			data : {
				'church_id' : church_selected_id

			},
			success : function(data) {
				//$("#service_provider").modal();
				var getdata = jQuery.parseJSON(data);
				var html = '';
				$("#church_p_id").val(getdata.c_product_id);
				$("#church_price").val(getdata.church_p_price);
				$.each(getdata.product, function(key, value) {
					var product_id = value.product_id;
					var price = value.price;
					var product_name = value.product_name;
					
					html += '<option value='+product_id+'>'+product_name+'('+price+')</option>';
				
				});

				$("#church_donation_price").html(html);

			}
		});
		}
		if(s==3)
		{
		
			var church_p_id=$("#church_p_id").val();
			$.ajax({
			url : site_url + "select_church_services",
			type : "POST",
			data : {
				'church_p_id' : church_p_id

			},
			success : function(data) {
				
				//$("#service_provider").modal();
				if(data!='2'){
					$("#church_price").val(data);
					$("#church_price").attr("readonly", "true");
				}else{
					$("#church_price").val('');
					$("#church_price").attr("placeholder", "Enter amount");
				}

				

			}
		});
		}
	if (s == 4) {
		//i=0;
		var church_p_id = $("#church_p_id").val();

		var church_id = $("#church_selected_id").val();

		var church_price_id = $("#church_p_id").val();
		var church_price = $("#church_price").val();
		var church_category_id=$("#church_category_id").val();
		if (church_price == '') {

			$("#church_price").attr('style', 'border-color: red!important');
		} else {
			$.ajax({
				url : site_url + "check_login",
				type : "POST",
				data : {
					'church_p_id' : church_p_id,
					'church_id' : church_id,
					'church_price_id' : church_price_id,
					'church_price':church_price,
					'church_category_id':church_category_id

				},
				success : function(data) {

					if (data == '2') {
						$('#loginPop').modal();
					} else if (data == '1') {
						//location.href = site_url + "church_donate?church_id=" + church_id + "&church_price=" + church_price + "&church_p_id=" + church_p_id+ "&church_price_id=" + church_price_id;
					
	location.href = site_url + "church_recharge?church_price=" + church_price + "&church_category_id=" + church_category_id + "&church_id=" + church_id+ "&church_biller_id=" + church_biller_id+ "&church_p_id=" + church_p_id;
	 
					}
				}
			});
		}

	}
	// alert(i);
}
function hide_preview() {
	$("#church_price").removeAttr('style', 'border-color: red');
	if (s >= 0) {
		//$("#mobile_amount").removeAttr('style','border-color: red');
		s--;
	}
	if (s == 0) {
		$('#church_prev').css('display', 'none');
	}
	//alert(i);

}
// seletc church price
function select_church_price(price_id)
{
	$("#church_p_id").val(price_id);
}
//Check credit card number///
function check_credit_number() {
	var card = $('#card_number').val();
	if (card == '') {
		$('#card_number').attr('style', 'border-color: red!important');
		$('#card_error').text('Please Enter card number');
	} else if (isNaN($('#card_number').val())) {

		$('#card_error').text('Please Enter a valid card number');
		$('#card_error').text('Please Enter a valid card number');
	} else if ($('#card_number').val().length < 13 || $('#card_number').val().length > 19) {
		$('#card_error').text('Please Enter a valid card number');
		$('#card_error').text('Please Enter a valid card number');
	} else {
		$('#card_number').attr('style', 'border-color: white');
		$('#card_error').text('');
	}

}

function check_cvv_number() {

	if ($('#cvv_no').val().length < 3 || $('#cvv_no').val().length > 3) {

		$('#cvv_no').attr('style', 'border-color: red!important');
		$('#cvv_error').text('Please Enter a valid cvv number');
	} else {
		$('#cvv_no').attr('style', 'border-color: white');
		$('#cvv_error').text('');
	}
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
					$("#response_feedback").text(message);
					setInterval(location.reload(), 15000);
				} else {
					$("#name").val('');
					$("#email").val('');
					$("#message").val('');
					$("#response_feedback").text(message);

					setInterval(location.reload(), 15000);
				}

			}
		});
	} else {
		$("#response_feedback").text("All Field are Required");
	}
}

var i = 0;
function plus() {
	i++;
}

function minus() {
	i--;
}

/// my profile page///
// match password nd confirm password
function match_pass() {
	var new_password = $("#new_password").val();
	var confirm_password = $("#confirm_password").val();
	if (new_password != confirm_password) {
		$('#confirm_password').attr('style', 'border-color: red!important');
		$('#new_password').attr('style', 'border-color: red!important');

		$('#error_status').text("New password and confirm password are mismatched");
	} else {
		$('#confirm_password').attr('style', 'border-color:');
		$('#new_password').attr('style', 'border-color:');
		$("#c_pass").val('1');
		$('#error_status').text("");
	}
}

//Check Password////

function check_pass() {
	var old_pass = $("#old_password").val();
	var user_id = $("#user_id").val();

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
				$('#old_password').attr('style', 'border-color:');

				$('#old_status').text("");
			} else if (status == 'false') {
				$('#old_password').attr('style', 'border-color: red!important');

				$('#old_status').text(message);

			}
		}
	});
}

//change password///
function change_password() {
	var old_pass = $("#old_password").val();
	var user_id = $("#user_id").val();
	var new_password = $("#new_password").val();
	var confirm_password = $("#confirm_password").val();
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
				$('#old_password').attr('style', 'border-color:');
				$('#old_status').text("");
				if (new_password != confirm_password) {
					$('#confirm_password').attr('style', 'border-color: red!important');
					$('#new_password').attr('style', 'border-color: red!important');
					$('#error_status').text("New password and confirm password are mismatched");
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
							var getdata = jQuery.parseJSON(data);
							var status = getdata.status;
							var message = getdata.message;
							$("#old_password").val('');
							$("#new_password").val('');
							$("#confirm_password").val('');
							$("#change_pass_popup").modal();
							$("#amt").text(message);

						}
					});

				}
			} else if (status == 'false') {
				$('#old_password').attr('style', 'border-color: red!important');

				$('#old_status').text(message);

			}
		}
	});
}

//Edit Profile//
function user_update() {
	var user_name = $("#user_name").val();
	var user_id = $("#user_id").val();
	var user_email = $("#user_email").val();
	var user_mobile = $("#user_contact_no").val();
	var old_password = $("#old_password").val();
	var new_password = $("#new_password").val();
	var pass_status = $("#pass_status").val();
	var c_pass = $("#c_pass").val();

	if (user_mobile != '') {
		var mobile = user_mobile;
	} else {
		var mobile = '';
	}
	if (user_name == '') {

		$('#error').css('display', 'block');
	} else {
		$('#error').css('display', 'none');
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
		'success' : function(data) {alert(data);
			var getdata = jQuery.parseJSON(data);
			var status = getdata.status;
			var message = getdata.message;
			var name = getdata.user_name;
			var email = getdata.user_email;
			var user_id = getdata.user_id;
			if (status == 'true') {
				$("#user_fullname").text(user_name);
				$("#useremail").text(user_email);
				$("#success_profile").css("display", "block");
				$("#success_profile").addClass("succ");
				$('#success_profile').text(message);
				$.ajax({
					url : site_url + "user_login",
					type : "POST",
					data : {
						'user_id' : user_id

					},
					success : function(data) {

					}
				});
			}
		}
	});
}

//ADD Wallet ///
function check_amount() {
	var amount = $("#amount").val();

	if (isNaN(amount)) {
		$("#amount").attr('style', 'border-color: red!important');
		$("#amt_msg").text('Please Enter a valid amount');
		$("#payment_gateway").attr('style', 'display:none ');
		$("#new_pay").attr('style', 'display:none ');
	} else if (amount < 50) {
		$("#amount").attr('style', 'border-color: red!important');
		$("#amt_msg").text('Please Enter a amount greater then 50');
		$("#amt_msg").attr('style', 'color: red!important');
		$("#payment_gateway").attr('style', 'display:none ');
		$("#new_pay").attr('style', 'display:none ');
	} else if (amount != '') {

		localStorage.removeItem("add_wallet_amt");
		localStorage.setItem("add_wallet_amt", amount);
	
		$("#amount").attr('style', 'border-color: ');
		$("#amt_msg").text('');
		$("#amt_msg").attr('style', 'color: ');
		$("#payment_gateway").attr('style', 'display:Block ');

	}
}

function check_month_year_card() {
	if ($('#card_year').val() == '0') {

		$('#card_year').attr('style', 'border-color: red!important');

	} else {
		$('#card_year').attr('style', 'border-color: ');
	}
	if ($('#card_type').val() == '0') {

		$('#card_type').attr('style', 'border-color: red!important');

	} else {
		$('#card_type').attr('style', 'border-color: ');
	}
	if ($('#card_month').val() == '0') {

		$('#card_month').attr('style', 'border-color: red!important');

	} else {
		$('#card_month').attr('style', 'border-color: ');
	}
}

// Function to save pin to add wallet///
function check_pin() {
	var rec_type = $("#pay_card_only").val();
	$("#SMS").modal('hide');
	var transfer_pin = $("#check_transfer_pin").val();
	var recharge_category_id = $("#recharge_category_id").val();
	var pin_type = $("#pin_type").val();
	var pay_status_wallet = localStorage.getItem("pay_status_wallet");
	var pay_status = $("#pay_status").val();
	var user_id = $("#user_id").val();
	$.ajax({
		url : base_url + "save_pin",
		'type' : 'POST',
		'data' : {
			'user_id' : user_id,
			'user_transfer_pin' : transfer_pin

		},
		'success' : function(data) {
			var getdata = jQuery.parseJSON(data);
			var status = getdata.status;
			var message = getdata.message;
			;
			if (status == 'true') {
				$.ajax({
					url : site_url + "change_transfer_pin_status",
					'type' : 'POST',
					'data' : {
						'user_id' : user_id

					},
					'success' : function(data) {

					}
				});
				$("#check_transfer_pin").val('');
				$("#check_pin").modal('hide');
				if (pin_type == '1') {
					add_wallet_money();
				} else if (pin_type == '5') {
					wallet_transfer_money();
				} else if (pin_type == '2_1' && recharge_category_id == '4') {
//alert();
					//paybill_from_wallet();
					var wallet_amount=$("#my_current_wallet").val();
					var rec_amount=$("#recharge_amt_without_wallet").val();
					var pay_status_wallet = localStorage.getItem("pay_status_wallet");
				
					if(pay_status_wallet=='2')
					{
						showModal();
						$("#interswitch_pay_gateway").attr("style","display:block");
					}else
					 if(pay_status_wallet=='1' && wallet_amount>rec_amount){
						$("#rechargeStep").modal();
						$("#interswitch_pay_gateway").attr("style","display:none");
					}else
					 if(pay_status_wallet=='1' && wallet_amount<rec_amount){
						showModal();
						$("#interswitch_pay_gateway").attr("style","display:block");
					}
				} else if (pin_type == '2_1' && recharge_category_id != '6'&& recharge_category_id != '7') {
					
					var wallet_amount=$("#my_current_wallet").val();
					var rec_amount=$("#recharge_amt_without_wallet").val();
					var pay_status_wallet = localStorage.getItem("pay_status_wallet");
				
					if(pay_status_wallet=='2')
					{
						showModal();
						$("#interswitch_pay_gateway").attr("style","display:block");
					}else
					 if(pay_status_wallet=='1' && wallet_amount>rec_amount){
						$("#rechargeStep").modal();
						$("#interswitch_pay_gateway").attr("style","display:none");
					}else
					 if(pay_status_wallet=='1' && wallet_amount<rec_amount){
						showModal();
						$("#interswitch_pay_gateway").attr("style","display:block");
					}
					
				} else if (pin_type == '2_2' && recharge_category_id != '6') {

					if (pay_status == '' && recharge_category_id == '') {
						rec_from_card();
					} else if (pay_status == '' && recharge_category_id == '4') {
						paybill_from_card();
					} else if (pay_status == '1' && rec_type == '1' && recharge_category_id == '') {

						rec_from_wallet_with_card();
					} else if (pay_status == '1' && rec_type == '1' && recharge_category_id == '4') {
						paybill_from_card_with_wallet();
					} else if (pay_status == '1' && rec_type == '2') {
						rec_from_card();
					}
				} else if (pin_type == '2_1'&& recharge_category_id == '6') {
					var pay_status_wallet = localStorage.getItem("pay_status_wallet");
					
					if(pay_status_wallet=='1'){
						donate_church();
					}else{
						showModal();
						
						$("#interswitch_pay_gateway").attr("style","display:block");
					}
					
					
				}else if (pin_type == '7_1') {
					sms_plan();
				} else if (pin_type == '7_2') {
					frnd_share_sms();
				}else if (pin_type == '2_1' && recharge_category_id == '7') {
					
					var wallet_amount=$("#my_current_wallet").val();
					var rec_amount=$("#recharge_amt_without_wallet").val();
					var pay_status_wallet = localStorage.getItem("pay_status_wallet");
			
					if(pay_status_wallet=='2')
					{
						
						showModal();
						$("#interswitch_pay_gateway").attr("style","display:block");
					}else
					 if(pay_status_wallet=='1' && wallet_amount>rec_amount){
					 
						$("#rechargeStep").modal();
						$("#interswitch_pay_gateway").attr("style","display:none");
					}else
					 if(pay_status_wallet=='1' && wallet_amount<rec_amount){
					 //	$("#rechargeStep").modal();
						showModal();
						$("#interswitch_pay_gateway").attr("style","display:block");
					}
				}

			} else {
				$("#pin_false_status").text(message);
			}
		}
	});
}

function save_pin() {
	var rec_type = $("#pay_card_only").val();
	$("#SMS").modal('hide');
	var transfer_pin = $("#transfer_pin").val();
	var pay_status = $("#pay_status").val();
	var conform_pin = $("#confirm_pin").val();
	var user_id = $("#user_id").val();
	var pin_type = $("#pin_type").val();
	var recharge_category_id = $("#recharge_category_id").val();
	var wallet_amount=$("#my_current_wallet").val();
	var rec_amount=$("#recharge_amt_without_wallet").val();
	if (transfer_pin == conform_pin) {
		$.ajax({
			url : base_url + "save_pin",
			'type' : 'POST',
			'data' : {
				'user_id' : user_id,
				'user_transfer_pin' : transfer_pin

			},
			'success' : function(data) {
				var getdata = jQuery.parseJSON(data);
				var status = getdata.status;
				var message = getdata.message;		
				if (status == 'true') {

					$.ajax({
						url : site_url + "change_transfer_pin_status",
						'type' : 'POST',
						'data' : {
							'user_id' : user_id

						},
						'success' : function(data) {

						}
					});

					$("#transfer_pin").val('');
					$("#confirm_pin").val('');
					$("#save_pin").modal('hide');
						if (pin_type == '1') {
					add_wallet_money();
				} else if (pin_type == '5') {
					wallet_transfer_money();
				} else if (pin_type == '2_1' && recharge_category_id == '4') {
//alert();
					//paybill_from_wallet();
					var wallet_amount=$("#my_current_wallet").val();
					var rec_amount=$("#recharge_amt_without_wallet").val();
					var pay_status_wallet = localStorage.getItem("pay_status_wallet");
				
					if(pay_status_wallet=='2')
					{
						showModal();
						$("#interswitch_pay_gateway").attr("style","display:block");
					}else
					 if(pay_status_wallet=='1' && wallet_amount>rec_amount){
						$("#rechargeStep").modal();
						$("#interswitch_pay_gateway").attr("style","display:none");
					}else
					 if(pay_status_wallet=='1' && wallet_amount<rec_amount){
						showModal();
						$("#interswitch_pay_gateway").attr("style","display:block");
					}
				} else if (pin_type == '2_1') {
					var wallet_amount=$("#my_current_wallet").val();
					var rec_amount=$("#recharge_amt_without_wallet").val();
					var pay_status_wallet = localStorage.getItem("pay_status_wallet");
				
					if(pay_status_wallet=='2')
					{
						showModal();
						$("#interswitch_pay_gateway").attr("style","display:block");
					}else
					 if(pay_status_wallet=='1' && wallet_amount>rec_amount){
						$("#rechargeStep").modal();
						$("#interswitch_pay_gateway").attr("style","display:none");
					}else
					 if(pay_status_wallet=='1' && wallet_amount<rec_amount){
						showModal();
						$("#interswitch_pay_gateway").attr("style","display:block");
					}
					
				} else if (pin_type == '2_2') {

					if (pay_status == '' && recharge_category_id == '') {
						rec_from_card();
					} else if (pay_status == '' && recharge_category_id == '4') {
						paybill_from_card();
					} else if (pay_status == '1' && rec_type == '1' && recharge_category_id == '') {

						rec_from_wallet_with_card();
					} else if (pay_status == '1' && rec_type == '1' && recharge_category_id == '4') {
						paybill_from_card_with_wallet();
					} else if (pay_status == '1' && rec_type == '2') {
						rec_from_card();
					}
				} else if (pin_type == '7_1') {
					sms_plan();
				} else if (pin_type == '7_2') {
					frnd_share_sms();
				}else if (pin_type == '2_1' && recharge_category_id == '7') {
					
					var wallet_amount=$("#my_current_wallet").val();
					var rec_amount=$("#recharge_amt_without_wallet").val();
					var pay_status_wallet = localStorage.getItem("pay_status_wallet");
			
					if(pay_status_wallet=='2')
					{
						
						showModal();
						$("#interswitch_pay_gateway").attr("style","display:block");
					}else
					 if(pay_status_wallet=='1' && wallet_amount>rec_amount){
					 
						$("#rechargeStep").modal();
						$("#interswitch_pay_gateway").attr("style","display:none");
					}else
					 if(pay_status_wallet=='1' && wallet_amount<rec_amount){
					 //	$("#rechargeStep").modal();
						showModal();
						$("#interswitch_pay_gateway").attr("style","display:block");
					}
				}
				}else{
					$("#share_sms_status").text(message);
					setInterval(function() {
     $("#save_pin").modal('hide');
}, 5000);
					
				}
			}
		});
	} else {
		$("#pin_status").text("Transfer pin and confirm pin are mismatched");
	}

}
// function donate church
function donate_church()
{
	$("#save_pin").modal('hide');
	$("#check_pin").modal('hide');
	$('.card_show').removeClass('active');
	$("#overlay").addClass('active');
	var user_id = $("#user_id").val();
	var church_id=$("#operator_id").val();
	var church_category_id = $("#church_category_id").val();
	var donation_amount = $("#recharge_amt_without_wallet").val();
	var church_p_id = $("#church_p_id").val();
	
	$.ajax({
		url : base_url + "church_donate",
		type : "POST",
		data : {
			'church_id' : church_id,
			'donar_user_id' : user_id,
			'church_category_id' : church_category_id,
			'church_product_id' : church_p_id,
			'church_product_price' : donation_amount
		
		},
		success : function(data) {

			$("#overlay").removeClass('active');
			$("#coupon_amount").val('');
			$("#coupon_id").val('');
			var getdata = jQuery.parseJSON(data);
			var status = getdata.status;
			var message = getdata.message;
			if (status == 'true') {
				$("#recharge").modal();
				if (church_category_id == '6') {
					$("#charge").attr("onclick", "another_donation()");
				} 
				$("#donation").modal();
				var wallet = getdata.wallet_amount;
				$("#donation_date").text(getdata.donation_date);
				$("#donation_amount").text(getdata.donation_amount);
				$("#trans_id").text(getdata.transaction_id);
				$(".wallet_amount").text(wallet_amount);
				$("#amnt").text(getdata.donation_amount);
				$('#msg').attr('style', 'color: #337D75');

			} else if (status == 'false') {
				$("#coupon_amount").val('');
				$("#coupon_id").val('');
				$('#msg').attr('style', 'color: red');
			}
			$("#msg").text(message);
		}
	});
}
function add_wallet_money() {

	var user_id = $("#user_id").val();
	var amount = $("#amount").val();
	var transfer_pin_status = $("#transfer_pin_status").val();
	var coupon_id = $("#coupon_id").val();

	var coupon_amount = $("#coupon_amount").val();
	if (coupon_id != '') {
		var coupon_id = coupon_id;
		var coupon_amount = coupon_amount;
	} else {
		var coupon_id = '';
		var coupon_amount = '';
	}
	$('#add_money_btn').attr('style', 'display: none');
	
	setTimeout(function() {
		wallet_add();
	}, 0);
	
	document.getElementById('amount').readOnly = true;
	$("#amt").val(amount * 100);

	var amt_detail = amount * 100;

	var detail = (amt_detail / 2);
localStorage.setItem("add_wallet_amount",amount);

	var xml_data = '<payment_item_detail><item_details detail_ref="REF1004" institution="ABC"><item_detail item_id="1" item_name="Butter" item_amt="' + detail + '" /><item_detail item_id="2" item_name="Juice" item_amt="' + detail + '" /></item_details></payment_item_detail>';

	$("#xml_d").val(xml_data);

	$.ajax({
		url : site_url + "set_wallet_add_value",
		'type' : 'POST',
		'data' : {
			'amount' : amount,

		},
		'success' : function(data) {

			var my_val = data.split(",");
			var hash_v = my_val[0];
			var txn_ref = my_val[1];
			
			localStorage.setItem("txn_ref",txn_ref);

			$("#hash").val(hash_v);
			$("#txn_r").val(txn_ref);
			$("#cust_id").val(txn_ref);
		}
	});
	

}
// function interswitch  payment gateway for recghareg==//
function payment_interswitch_gateway(user_id,wallet_amt,sendAmnt,pay_Amnt_status,mobile_no,rechareg_category_id,operator_id,wt_category)
{
	var amt_detail = sendAmnt * 100;
$("#amt1").val(amt_detail);
	var detail = (amt_detail / 2);

	var xml_data = '<payment_item_detail><item_details detail_ref="REF1004" institution="ABC"><item_detail item_id="1" item_name="Butter" item_amt="' + detail + '" /><item_detail item_id="2" item_name="Juice" item_amt="' + detail + '" /></item_details></payment_item_detail>';

	$("#xml_d2").val(xml_data);
		$.ajax({
		url : site_url + "set_recharge_add_value",
		'type' : 'POST',
		'data' : {
			'user_id':user_id,
			'amount' : sendAmnt,
			'wallet_amt':wallet_amt,
			'pay_Amnt_status':pay_Amnt_status,
			'mobile_no':mobile_no,
			'rechareg_category_id':rechareg_category_id,
			'operator_id':operator_id,
			'wt_category':wt_category

		},
		'success' : function(data) {

			var my_val = data.split(",");
			var hash_v = my_val[0];
			var txn_ref = my_val[1];
			localStorage.setItem("txn_ref_recharge",txn_ref);
			

			$("#hash1").val(hash_v);
			$("#txn_r1").val(txn_ref);
			$("#cust_id").val(txn_ref);
		}
	});
}
// redirect to again wallet page from add wallet call back page
function again_wallet_page() {
	location.href = site_url + "my_transaction";
}

function add_money() {

	var user_id = $("#user_id").val();
	var amount = $("#amount").val();
	var transfer_pin_status = localStorage.getItem("user_pin_status");
	//var transfer_pin_status = $("#transfer_pin_status").val();
	var coupon_id = $("#coupon_id").val();

	var coupon_amount = $("#coupon_amount").val();
	if (coupon_id != '') {
		var coupon_id = coupon_id;
		var coupon_amount = coupon_amount;
	} else {
		var coupon_id = '';
		var coupon_amount = '';
	}
	if (amount == '' || amount == '0' || amount > 10000) {

		$('#amount').attr('style', 'border-color: red!important');

		$('#amount_error').text('You can add upto 10000 into your wallet. ');
	} else if (transfer_pin_status) {
		if (transfer_pin_status == '2') {
			$("#save_pin").modal();
		} else if (transfer_pin_status == '1') {
			$("#check_pin").modal();
		}

	}
	// else{
	// $("#overlay").addClass('active');
	// $.ajax({
	// url: base_url+"add_money",
	// 'type':'POST',
	// 'data':{
	// 'card_number':card_no,
	// 'recharge_user_id':user_id,
	// 'cvv_no':cvv_no,
	// 'recharge_amount':amount,
	// 'coupon_amount':coupon_amount,
	// 'coupon_id':coupon_id
	//
	// },
	// 'success' : function(data)
	// {
	// var getdata=jQuery.parseJSON(data);
	// var status=getdata.status;
	// var wallet_amount=getdata.wallet_amount;
	// var message=getdata.message;
	// if(status=='true'){
	// $("#overlay").removeClass('active');
	// $("#wallet_popup").modal();
	// $('#card_number').attr('style','border-color: white');
	// $('#cvv_no').attr('style','border-color: white');
	// $('#amount').attr('style','border-color: white');
	// $("#card_number").val('');
	// var transaction_id=getdata.transaction_id;
	// $("#order_id").text(transaction_id);
	// var order_date=getdata.transaction_date;
	// $("#rec_date").text(order_date);
	// $("#amt").text(amount);
	// $("#cvv_no").val('');
	// $("#coupon_id").val('');
	// $("#coupon_amount").val('');
	// $("#amount").val('');
	// $("#promo_code").val('');
	// $("#wallet").text(wallet_amount);
	// $(".wallet_amount").text(wallet_amount);
	// $('#status').text(message);
	// $("#add_money").text(amount);
	// //location.reload();
	// }
	// }
	// });
	// }
}

// Repeat Add money transaction///
function repeat_add_money(amount, id) {
	var amount = amount;
	var wt_id = id;
	location.href = site_url + "my_wallet?amount=" + amount + "&wt_id=" + wt_id;
}

// repeat recharge transaction///
function repeat_recharge(id, wt_category_id, rec_id) {
	var wt_category_id = wt_category_id;
	var wt_id = id;
	var rec_id = rec_id;
	location.href = site_url + "repeat_recharge?wt_id=" + wt_id + "&wt_category_id=" + wt_category_id + "&rec_id=" + rec_id;

}

function repeat_transfer_money(id, rec_amount, number) {
	var rec_amount = rec_amount;
	if (rec_amount > 0 || amount < 10000) {
		var wt_id = id;
		var number = number;
		location.href = site_url + "repeat_transfer_money?wt_id=" + wt_id + "&rec_amount=" + rec_amount + "&transfer_number=" + number;
	} else {
		$('#transfer_amount').attr('style', 'border-color: red!important');
		$('#amount_error').text("Please Enter a proper amount to transfer");
	}
}

function repeat_share_sms(id, rec_amount, number) {
	var rec_amount = rec_amount;
	if (rec_amount > 0) {
		var wt_id = id;
		var number = number;
		location.href = site_url + "repeat_add_sms?wt_id=" + wt_id + "&rec_amount=" + rec_amount + "&transfer_number=" + number;
	} else {
		$('#transfer_amount').attr('style', 'border-color: red!important');
		$('#amount_error').text("Please Enter a proper amount to transfer");
	}
}

function repeat_add_sms() {
	location.href = site_url + "sms_management";
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
						url : site_url + "promocode_session",
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
					$('#coupon_status').attr('style', 'color: green');
					$('#promo_code').attr('style', 'border-color: white');
					$('#amount').attr('style', 'border-color: white');
				} else {
					$('#amount').attr('style', 'border-color: red');
					$('#coupon_status').attr('style', 'color: red');
					$("#coupon_status").text('promocode apply with ₦ ' + amount_price);
				}

			} else if (status == 'false') {

				$('#promo_code').attr('style', 'border-color: red');
				$('#coupon_status').attr('style', 'color: red');
				$("#coupon_status").text(message);
			}
		}
	});
}

function apply_promocode_add_wallet() {
	var amount = $("#amount").val();
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
				var coupon_price = getdata.amount_price;

				if (amount >= parseInt(coupon_price)) {

					var coupon_id = getdata.coupon_id;

					$.ajax({
						url : site_url + "promocode_session",
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
					$('#coupon_status').attr('style', 'color: green');
					$('#promo_code').attr('style', 'border-color: white');
					$('#amount').attr('style', 'border-color: white');
				} else {
					$('#amount').attr('style', 'border-color: red');
					$('#coupon_status').attr('style', 'color: red');
					$("#coupon_status").text('promocode apply with ₦ ' + coupon_price);
				}

			} else if (status == 'false') {

				$('#promo_code').attr('style', 'border-color: red');
				$('#coupon_status').attr('style', 'color: red');
				$("#coupon_status").text(message);
			}
		}
	});
}

function show_plans() {
	var mobile = $("#mobile").val();
	var prepaid = $("#prepaid").val();
	var mobile_operator_id = $("#mobile_operator_id").val();
	var top_up = $("#top_up").val();
	var mobile_amount = $("#mobile_amount").val();
	$('#RechagePlan').modal();

	$.ajax({
		url : base_url + "get_operator_name",
		type : "POST",
		data : {
			'operator_id' : mobile_operator_id
		},
		success : function(data) {
			var getdata = jQuery.parseJSON(data);
			var status = getdata.status;
			var operator_name = getdata.operator_name;
			$("#operator_name").text(operator_name);
			$(".operator_name").text(operator_name);
		}
	});
}

function get_amount(amount,plan_type,code) {
	
	if (plan_type == '1') {
		$("#mobile_amount").val(amount);
	} else if (plan_type == '3') {
		$("#datacard_amount").val(amount);
		$("#datacard_typecode").val(code);
	} else if (plan_type == '2') {
		$("#tv_rec_amount").val(amount);
		$("#tv_rec_code").val(code);
	}

	$('#RechagePlan').modal('hide');
}
function get_selected_amount(amount)
{
	$("#tv_rec_amount").val(amount);
	$('#RechagePlan').modal('hide');
}
// function recgharge page to redirect transaction page
function recharge_to_transaction() {
	location.href = site_url + "my_transaction";
}

///Recharge from wallet///
function pay_from_wallet() {

	$("#save_pin").modal('hide');
	$("#check_pin").modal('hide');
	$('.card_show').removeClass('active');
	$("#overlay").addClass('active');
	var user_id = $("#user_id").val();
	var recharge_category_id = $("#recharge_category_id").val();
	var operator_id = $("#operator_id").val();
	var recharge_amount = $("#recharge_amount").val();
	var recharge_number = $("#recharge_number").val();
	var coupon_id = $("#coupon_id").val();
	var coupon_amount = $("#coupon_amount").val();
	var wt_category = $("#wt_category").val();
	if (coupon_id) {
		var coupon_id = coupon_id;
		var coupon_amount = coupon_amount;
	} else {
		var coupon_id = '';
		var coupon_amount = '';
	}
	
	if(recharge_category_id!='6'&& recharge_category_id!='7' && recharge_category_id!='4'){
		var tv_rec_code = localStorage.getItem("tv_rec_code");
		var tv_customer_no = localStorage.getItem("tv_customer_no");
		var operator_code=$("#service_id").val();
		if(operator_code!="AWA" && operator_code=="AQA" && operator_code=="AQC")
		{
			var recharge_number=tv_customer_no;
		}else{
				var recharge_number=recharge_number;
		}
		var tv_number_name = localStorage.getItem("tv_number_name");
		
	$.ajax({
		url : base_url + "recharge",
		type : "POST",
		data : {
			'operator_id' : operator_id,
			'recharge_user_id' : user_id,
			'recharge_category_id' : recharge_category_id,
			'recharge_number' : recharge_number,
			'recharge_amount' : recharge_amount,
			'coupon_amount' : coupon_amount,
			'coupon_id' : coupon_id,
			'wt_category' : wt_category,
			'recharge_code':tv_rec_code,
			'customer_name':tv_number_name
		},
		success : function(data) {
			
			$("#overlay").removeClass('active');
			$("#coupon_amount").val('');
			$("#coupon_id").val('');
			var getdata = jQuery.parseJSON(data);
			var status = getdata.status;
			var message = getdata.message;
			
			if (status == 'true') {
				localStorage.setItem('tv_customer_no',"");
				$("#recharge").modal();
				if (recharge_category_id == '1') {
					$("#charge").attr("onclick", "another_mobile_recharge()");
				} else if (recharge_category_id == '2') {
					$("#another_recharge").attr("onclick", "tv_rech()");
				} else if (recharge_category_id == '3') {
					$("#another_recharge").attr("onclick", "data_recharge()");
				}else if (recharge_category_id == '5') {
					$("#another_recharge").attr("onclick", "electricity_recharge()");
				}
				if(recharge_category_id == '5')
				{
					$("#electricity_response").html('Electricity recharge');
				}
				$("#mobile_recharge").modal();
				$("#coupon_status").text('');
				$("#msg").text('');
				$("#promo_code").val('');
				var wallet = getdata.wallet_amount;
				$("#rec_date").text(getdata.recharge_date);
				$("#amt").text(recharge_amount);
				if(getdata.electricity_prepaid_token)
						{
							$("#order_id").text(getdata.electricity_prepaid_token);
							$("#elecrtic").html('Token No:');
						}else{
							$("#order_id").text(getdata.transaction_id);
						}
			
				$("#mob_num").text(recharge_number);
				$(".wallet_amount").text(wallet);
				$("#amnt").text(recharge_amount);
				$('#msg').attr('style', 'color: #337D75');

			} else if (status == 'false') {
				$("#transaction_failed").modal();
				$("#failed_rec_date").text(getdata.recharge_date);
				$("#failed_amt").text(recharge_amount);
				$("#failed_order_id").text(getdata.transaction_id);
				$("#failed_mob_num").text(recharge_number);
				//$(".wallet_amount").text(wallet);
				//$("#amnt").text(recharge_amount);
				$("#coupon_amount").val('');
				$("#coupon_id").val('');
				$('#msg').attr('style', 'color: red');
			}
			$("#msg").text(message);
		}
	});
	}else if(recharge_category_id=='6'){
		donate_church();
	}else if(recharge_category_id=='7'){
		event_ticket_booking();
	}else if(recharge_category_id=='4'){
		paybill_from_wallet();
	}
}

function paybill_from_wallet() {

	$("#save_pin").modal('hide');
	$("#check_pin").modal('hide');
	$('.card_show').removeClass('active');
	$("#overlay").addClass('active');
	var user_id = $("#user_id").val();
	var biller_category_id = $("#biller_category_id").val();
	var operator_id = $("#operator_id").val();
	var recharge_amount = $("#recharge_amount").val();
	var recharge_number = $("#recharge_number").val();
	var coupon_id = $("#coupon_id").val();
	var coupon_amount = $("#coupon_amount").val();
	var wt_category = $("#wt_category").val();
	if (coupon_id) {
		var coupon_id = coupon_id;
		var coupon_amount = coupon_amount;
	} else {
		var coupon_id = '';
		var coupon_amount = '';
	}
	$.ajax({
		url : base_url + "bill_recharge",
		type : "POST",
		data : {
			'biller_id' : operator_id,
			'recharge_user_id' : user_id,
			'bill_consumer_no' : recharge_number,
			'biller_category_id' : biller_category_id,
			'bill_amount' : recharge_amount,
			'coupon_amount' : coupon_amount,
			'coupon_id' : coupon_id,
			'wt_category' : wt_category
		},
		success : function(data) {

			$("#overlay").removeClass('active');
			$("#coupon_amount").val('');
			$("#coupon_id").val('');
			var getdata = jQuery.parseJSON(data);
			var status = getdata.status;
			var message = getdata.message;
			if (status == 'true') {
				$("#recharge").modal();
				if (recharge_category_id == '1') {
					$("#charge").attr("onclick", "another_mobile_recharge()");
				} else if (recharge_category_id == '2') {
					$("#another_recharge").attr("onclick", "tv_rech()");
				} else if (recharge_category_id == '3') {
					$("#another_recharge").attr("onclick", "data_recharge()");
				} else if (recharge_category_id == '4') {
					$("#another_recharge").attr("onclick", "bill_pay()");
				}
				$("#mobile_recharge").modal();
				$("#coupon_status").text('');
				$("#msg").text('');
				$("#promo_code").val('');
				var wallet = getdata.wallet_amount;
				$("#rec_date").text(getdata.recharge_date);
				$("#amt").text(recharge_amount);
				$("#order_id").text(getdata.transaction_id);
				$("#mob_num").text(recharge_number);
				$(".wallet_amount").text(wallet);
				$("#amnt").text(recharge_amount);
				$('#msg').attr('style', 'color: #337D75');

			} else if (status == 'false') {
				$("#coupon_amount").val('');
				$("#coupon_id").val('');
				$('#msg').attr('style', 'color: red');
			}
			$("#msg").text(message);
		}
	});
}

function paybill_from_card() {

	$("#save_pin").modal('hide');
	$("#check_pin").modal('hide');
	$('.card_show').removeClass('active');
	$("#overlay").addClass('active');
	var user_id = $("#user_id").val();
	var biller_category_id = $("#biller_category_id").val();
	var operator_id = $("#operator_id").val();
	var recharge_amount = $("#recharge_amount").val();
	var recharge_number = $("#recharge_number").val();
	var coupon_id = $("#coupon_id").val();
	var recharge_category_id = $("#recharge_category_id").val();
	var coupon_amount = $("#coupon_amount").val();
	var wt_category = $("#wt_category").val();
	if (coupon_id) {
		var coupon_id = coupon_id;
		var coupon_amount = coupon_amount;
	} else {
		var coupon_id = '';
		var coupon_amount = '';
	}
	$.ajax({
		url : base_url + "bill_pay_from_card",
		type : "POST",
		data : {
			'biller_id' : operator_id,
			'recharge_user_id' : user_id,
			'bill_consumer_no' : recharge_number,
			'biller_category_id' : biller_category_id,
			'bill_amount' : recharge_amount,
			'coupon_amount' : coupon_amount,
			'coupon_id' : coupon_id,
			'wt_category' : wt_category
		},
		success : function(data) {

			$("#overlay").removeClass('active');
			$("#coupon_amount").val('');
			$("#coupon_id").val('');
			var getdata = jQuery.parseJSON(data);
			var status = getdata.status;
			var message = getdata.message;
			if (status == 'true') {
				$("#recharge").modal();
				if (recharge_category_id == '1') {
					$("#charge").attr("onclick", "another_mobile_recharge()");
				} else if (recharge_category_id == '2') {
					$("#another_recharge").attr("onclick", "tv_rech()");
				} else if (recharge_category_id == '3') {
					$("#another_recharge").attr("onclick", "data_recharge()");
				} else if (recharge_category_id == '4') {
					$("#another_recharge").attr("onclick", "bill_pay()");
				}
				$("#mobile_recharge").modal();
				$("#coupon_status").text('');
				$("#msg").text('');
				$("#promo_code").val('');
				var wallet = getdata.wallet_amount;
				$("#rec_date").text(getdata.recharge_date);
				$("#amt").text(recharge_amount);
				$("#order_id").text(getdata.transaction_id);
				$("#mob_num").text(recharge_number);
				$(".wallet_amount").text(wallet);
				$("#amnt").text(recharge_amount);
				$('#msg').attr('style', 'color: #337D75');

			} else if (status == 'false') {
				$("#coupon_amount").val('');
				$("#coupon_id").val('');
				$('#msg').attr('style', 'color: red');
			}
			$("#msg").text(message);
		}
	});
}

function paybill_from_card_with_wallet() {

	$("#save_pin").modal('hide');
	$("#check_pin").modal('hide');
	$('.card_show').removeClass('active');
	$("#overlay").addClass('active');
	var user_id = $("#user_id").val();
	var biller_category_id = $("#biller_category_id").val();
	var operator_id = $("#operator_id").val();
	var recharge_amount = $("#recharge_amount").val();
	var recharge_number = $("#recharge_number").val();
	var coupon_id = $("#coupon_id").val();
	var recharge_category_id = $("#recharge_category_id").val();
	var coupon_amount = $("#coupon_amount").val();
	var wt_category = $("#wt_category").val();
	if (coupon_id) {
		var coupon_id = coupon_id;
		var coupon_amount = coupon_amount;
	} else {
		var coupon_id = '';
		var coupon_amount = '';
	}
	$.ajax({
		url : base_url + "bill_pay_card_with_wallet",
		type : "POST",
		data : {
			'biller_id' : operator_id,
			'recharge_user_id' : user_id,
			'bill_consumer_no' : recharge_number,
			'biller_category_id' : biller_category_id,
			'bill_amount' : recharge_amount,
			'coupon_amount' : coupon_amount,
			'coupon_id' : coupon_id,
			'wt_category' : wt_category
		},
		success : function(data) {

			$("#overlay").removeClass('active');
			$("#coupon_amount").val('');
			$("#coupon_id").val('');
			var getdata = jQuery.parseJSON(data);
			var status = getdata.status;
			var message = getdata.message;
			if (status == 'true') {
				$("#recharge").modal();
				if (recharge_category_id == '1') {
					$("#charge").attr("onclick", "another_mobile_recharge()");
				} else if (recharge_category_id == '2') {
					$("#another_recharge").attr("onclick", "tv_rech()");
				} else if (recharge_category_id == '3') {
					$("#another_recharge").attr("onclick", "data_recharge()");
				} else if (recharge_category_id == '4') {
					$("#another_recharge").attr("onclick", "bill_pay()");
				}
				$("#mobile_recharge").modal();
				$("#coupon_status").text('');
				$("#msg").text('');
				$("#promo_code").val('');
				var wallet = getdata.wallet_amount;
				$("#rec_date").text(getdata.recharge_date);
				$("#amt").text(recharge_amount);
				$("#order_id").text(getdata.transaction_id);
				$("#mob_num").text(recharge_number);
				$(".wallet_amount").text(wallet);
				$("#amnt").text(recharge_amount);
				$('#msg').attr('style', 'color: #337D75');

			} else if (status == 'false') {
				$("#coupon_amount").val('');
				$("#coupon_id").val('');
				$('#msg').attr('style', 'color: red');
			}
			$("#msg").text(message);
		}
	});
}

function recharge_from_wallet() {

	var transfer_pin_status = $("#transfer_pin_status").val();
	if (transfer_pin_status) {
		if (transfer_pin_status == '2') {
			$("#save_pin").modal();
		} else if (transfer_pin_status == '1') {
			$("#check_pin").modal();
		}

	}
}
function check_recharge_pin() {

	var transfer_pin_status = $("#transfer_pin_status").val();
	if (transfer_pin_status) {
		if (transfer_pin_status == '2') {
			$("#save_pin").modal();
		} else if (transfer_pin_status == '1') {
			$("#check_pin").modal();
		}

	}
}
///Recharge from card////
function recharge_from_card() {

	$("#pin_type").val('2_2');
	var transfer_pin_status = $("#transfer_pin_status").val();
	var user_id = $("#user_id").val();
	var recharge_category_id = $("#recharge_category_id").val();
	var operator_id = $("#operator_id").val();
	var recharge_amount = $("#recharge_amount").val();
	var recharge_number = $("#recharge_number").val();
	var card_no = $("#card_number").val();
	var cvv_no = $("#cvv_no").val();
	var amount = $("#amount").val();
	var coupon_id = $("#coupon_id").val();
	var coupon_amount = $("#coupon_amount").val();
	var card_type = $("#card_type").val();

	if (coupon_id != '') {
		var coupon_id = coupon_id;
		var coupon_amount = coupon_amount;
	} else {
		var coupon_id = '';
		var coupon_amount = '';
	}

	if (amount == '') {

		$('#amount').attr('style', 'border-color: red!important');

	} else if (card_type == '') {

		$('#card_type').attr('style', 'border-color: red!important');

	} else if (card_no == '') {

		$('#card_number').attr('style', 'border-color: red!important');
		$('#card_error').text('Please Enter a card number');
	} else if (isNaN($('#card_number').val())) {
		$('#card_error').attr('style', 'border-color: red!important');
		$('#card_error').text('Please Enter a valid card number');
	} else if ($('#card_number').val().length < 13 || $('#card_number').val().length > 19) {
		$('#card_error').attr('style', 'border-color: red!important');
		$('#card_error').text('Please Enter a valid card number');
	} else if ($('#cvv_no').val().length < 3 || $('#cvv_no').val().length > 3) {

		$('#cvv_no').attr('style', 'border-color: red!important');
		$('#cvv_error').text('Please Enter a valid cvv number');
	} else if ($('#card_year').val() == '0') {

		$('#card_year').attr('style', 'border-color: red!important');

	} else if ($('#card_month').val() == '0') {

		$('#card_month').attr('style', 'border-color: red!important');

	} else if (cvv_no == '') {
		$('#cvv_no').attr('style', 'border-color: red!important');
	} else if (transfer_pin_status) {
		if (transfer_pin_status == '2') {
			$("#save_pin").modal();
		} else if (transfer_pin_status == '1') {
			$("#check_pin").modal();
		}

	}
}

function rec_from_card() {
	var user_id = $("#user_id").val();
	var recharge_category_id = $("#recharge_category_id").val();
	var operator_id = $("#operator_id").val();
	var recharge_amount = $("#recharge_amount").val();
	var recharge_number = $("#recharge_number").val();
	var card_no = $("#card_number").val();
	var cvv_no = $("#cvv_no").val();
	var amount = $("#amount").val();
	var coupon_id = $("#coupon_id").val();
	var coupon_amount = $("#coupon_amount").val();
	var wt_category = $("#wt_category").val();
	
	if (coupon_id != '') {
		var coupon_id = coupon_id;
		var coupon_amount = coupon_amount;
	} else {
		var coupon_id = '';
		var coupon_amount = '';
	}
	$("#overlay").addClass('active');
	var tv_rec_code = localStorage.getItem("tv_rec_code");
		var tv_number_name = localStorage.getItem("tv_number_name");
	$.ajax({
		url : base_url + "recharge_from_card",
		type : "POST",
		data : {
			'operator_id' : operator_id,
			'recharge_user_id' : user_id,
			'recharge_category_id' : recharge_category_id,
			'recharge_number' : recharge_number,
			'recharge_amount' : recharge_amount,
			'coupon_amount' : coupon_amount,
			'coupon_id' : coupon_id,
			'wt_category' : wt_category,
			'recharge_code':tv_rec_code,
			'customer_name':tv_number_name
		},
		success : function(data) {

			$("#overlay").removeClass('active');
			var getdata = jQuery.parseJSON(data);
			var status = getdata.status;
			var message = getdata.message;
			if (status == 'true') {
				$("#coupon_amount").val('');
				$("#coupon_id").val('');
				$("#recharge").modal();
				$('#card_number').attr('style', 'border-color: white');
				$('#cvv_no').attr('style', 'border-color: white');
				$('.card_show').removeClass('active');
				$("#card_number").val('');
				$("#cvv_no").val('');
				$("#coupon_id").val('');
				$("#coupon_amount").val('');
				$("#amount").val('');
				$("#promo_code").val('');
				var wallet = getdata.wallet_amount;
				if (recharge_category_id == '1') {
					$("#charge").attr("onclick", "another_mobile_recharge()");
				} else if (recharge_category_id == '2') {
					$("#another_recharge").attr("onclick", "tv_rech()");
				} else if (recharge_category_id == '3') {
					$("#another_recharge").attr("onclick", "data_recharge()");
				}else if (recharge_category_id == '5') {
					$("#another_recharge").attr("onclick", "electricity_recharge()");
				}
				if(recharge_category_id == '5')
				{
					$("#electricity_response").html('Electricity recharge');
				}
				$("#rec_date").text(getdata.recharge_date);
				$("#amt").text(recharge_amount);
				if(getdata.electricity_prepaid_token)
						{
							$("#order_id").text(getdata.electricity_prepaid_token);
							$("#elecrtic").html('Token No:');
						}else{
							$("#order_id").text(getdata.transaction_id);
						}
				$("#mob_num").text(recharge_number);
				$(".wallet_amount").text(wallet);
				$("#amnt").text(recharge_amount);
				//$("#wallet_amounts").text(wallet);
				$('#msg').attr('style', 'color: #337D75');

			} else if (status == 'false') {
				$("#recharge_failed").modal();
				$('#msg').attr('style', 'color: red');
				$("#coupon_amount").val('');
				$("#coupon_id").val('');
			}
			$("#msg").text(message);
		}
	});
}

// function recharge from wallet with card

function rec_from_wallet_with_card() {
	var user_id = $("#user_id").val();
	var recharge_category_id = $("#recharge_category_id").val();
	var operator_id = $("#operator_id").val();
	var recharge_amount = $("#recharge_amount").val();
	var recharge_number = $("#recharge_number").val();
	var card_no = $("#card_number").val();
	var cvv_no = $("#cvv_no").val();
	var amount = $("#amount").val();
	var coupon_id = $("#coupon_id").val();
	var coupon_amount = $("#coupon_amount").val();
	var wt_category = $("#wt_category").val();
	if (coupon_id != '') {
		var coupon_id = coupon_id;
		var coupon_amount = coupon_amount;
	} else {
		var coupon_id = '';
		var coupon_amount = '';
	}
	$("#overlay").addClass('active');
	$.ajax({
		url : base_url + "recharge_from_wallet_with_card",
		type : "POST",
		data : {
			'operator_id' : operator_id,
			'recharge_user_id' : user_id,
			'recharge_category_id' : recharge_category_id,
			'recharge_number' : recharge_number,
			'recharge_amount' : recharge_amount,
			'coupon_amount' : coupon_amount,
			'coupon_id' : coupon_id,
			'wt_category' : wt_category
		},
		success : function(data) {

			$("#overlay").removeClass('active');
			var getdata = jQuery.parseJSON(data);
			var status = getdata.status;
			var message = getdata.message;
			if (status == 'true') {
				$("#coupon_amount").val('');
				$("#coupon_id").val('');
				$("#recharge").modal();
				$('#card_number').attr('style', 'border-color: white');
				$('#cvv_no').attr('style', 'border-color: white');
				$('.card_show').removeClass('active');
				$("#card_number").val('');
				$("#cvv_no").val('');
				$("#coupon_id").val('');
				$("#coupon_amount").val('');
				$("#amount").val('');
				$("#promo_code").val('');
				var wallet = getdata.wallet_amount;
				if (recharge_category_id == '1') {
					$("#charge").attr("onclick", "another_mobile_recharge()");
				} else if (recharge_category_id == '2') {
					$("#another_recharge").attr("onclick", "tv_rech()");
				} else if (recharge_category_id == '3') {
					$("#another_recharge").attr("onclick", "data_recharge()");
				}
				$("#rec_date").text(getdata.recharge_date);
				$("#amt").text(recharge_amount);
				$("#order_id").text(getdata.transaction_id);
				$("#mob_num").text(recharge_number);
				$(".wallet_amount").text(wallet);
				$("#my_wallet").text(wallet);
				var payble = recharge_amount - wallet;
				$("#payble_amount").text(payble);

				$("#amnt").text(recharge_amount);
				//$("#wallet_amounts").text(wallet);
				$('#msg').attr('style', 'color: #337D75');

			} else if (status == 'false') {
				$('#msg').attr('style', 'color: red');
				$("#coupon_amount").val('');
				$("#coupon_id").val('');
			}
			$("#msg").text(message);
		}
	});
}

// use wallet with card to recgharge////
function pay_card_value() {

	$('#pay_card_only').each(function() {
		var recharge_amt_without_wallet = $("#recharge_amt_without_wallet").val();
		var recharge_amt_with_wallet = $("#recharge_amt_with_wallet").val();

		if (this.checked == true) {
			localStorage.removeItem("amount");
			localStorage.removeItem("pay_status_wallet");
			localStorage.setItem("amount", recharge_amt_with_wallet);
			var myamount = localStorage.getItem("amount");
			localStorage.setItem("pay_status_wallet", '1');
			$("#pay_card_only").val('1');

		} else {
			localStorage.removeItem("pay_status_wallet");
			localStorage.removeItem("amount");
			localStorage.setItem("amount", recharge_amt_without_wallet);
			var myamount = localStorage.getItem("amount");
				
			localStorage.setItem("pay_status_wallet", '2');
			$("#pay_card_only").val('2');

		}
		var val = $("#pay_card_only").val();

	});
}

/// Forget password popup//
function forget() {
	$('#loginPop').modal('hide');
	$('#forget_pass').modal();

}

function forget_password() {
	var login_id = $('#login_id').val();
	if (login_id == '') {
		$('#login_id').attr('style', 'color: #337D75');
	} else {
		$.ajax({
			url : base_url + "forget_password",
			type : "POST",
			data : {
				'login_id' : login_id
			},
			success : function(data) {
				
				var getdata = jQuery.parseJSON(data);
				var status = getdata.status;
				var message = getdata.message;
				if (status == 'true') {

					$("#msg_num").attr('style', 'color: green');
					$("#msg_num").text(message);

				} else if (status == 'false') {

					$("#msg_num").attr('style', 'color: red');
					$("#msg_num").text(message);
				}

			}
		});
	}
}

// show signup popup//
function show_signup() {
	$("#user_email").val('');
	$("#signup_msg").text('');
	$("#user_email").attr('style', 'color: ');
	$("#user_mobile").attr('style', 'color: ');
	$("#user_password").attr('style', 'color: ');
	var user_mobile = $("#user_mobile").val('');
	var user_password = $("#user_password").val('');
	$('#loginPop').modal('hide');
	$('#signup').modal();

}

function login_popup() {
	$('#user_name').val('');
	$('#user_pass').val('');
	$('#response_failed').text('');
	$('#signup').modal('hide');
	$('#forget_pass').modal('hide');
	$('#loginPop').modal();
}

function login_ul() {
	$('.about-drop-down').toggleClass('active');
}


$(document).on("click", function(e) {
	if ($(e.target).is(".about-drop-down") === false) {
		$(".about-drop-down").removeClass("wide");
	}
});
/// change transaction view record////
function change_transaction_rec(id) {
	var wt_category = id;

	location.href = site_url + "my_transaction?wt_category=" + wt_category;
}

/// Recharge plan list///

function recharge_plan() {
	$("#plan_category_list").html('');
	$('#RechagePlan').modal();

	var recharge_category = $("#rec_category").val();

	var plan_operator_id = '';
	var mobile_operator_id = $("#mobile_operator_id").val();
	var data_operator_id = $("#datacard_operator_id").val();
	var dth_operator_id = $("#dth_operator_id").val();

	if (mobile_operator_id) {

		plan_operator_id = mobile_operator_id;

	}
	if (dth_operator_id) {

		plan_operator_id = dth_operator_id;
	}
	if (data_operator_id) {
		plan_operator_id = data_operator_id;
	}
	if (mobile_operator_id) {
		var plan_type = '1';
	} else if (dth_operator_id) {
		var plan_type = '2';
	} else if (data_operator_id) {
		var plan_type = '3';
	}

	var mobile = $("#mobile").val();
	$.ajax({
		url : base_url + "plan_category_listing",
		type : "POST",
		data : {
			'recharge_category' : recharge_category,
			'operator_id' : plan_operator_id
		},
		success : function(data) {

			var getdata = jQuery.parseJSON(data);
			var status = getdata.status;
			// $("#plan_dynamic_id").val(value.default_plan_category);
			if (status == 'true') {
				var html = '';
				var html1 = '';
				$.each(getdata.plan_category, function(key, value) {
					html1 += '<li role="presentation" class="active"><a href="#" onclick="change_plan(' + value.plan_category_id + ')" style="cursor:pointer">' + value.plan_category_name + '</a></li>';

				});
				$.each(getdata.recharge_details, function(key, value) {
					var recommended = value.plan_category_name;
					$("#operator_name").text(value.operator_name);
					//   if(recommended=='Recommended'){
					html += '<a href="#" onclick="get_amount(' + value.recharge_amount + ',' + plan_type + ')"><div class="plan_list">';
					html += '<div class="plan_rate">₦<span id="select_amount">' + value.recharge_amount + '</span></div>';
					html += '<div class="plan_details"><p><span class="operator_name">' + value.operator_name + '</span> GSM ' + value.recharge_data_pack + '</p>';
					html += '<p class="pull-left">' + value.recharge_validity + 'Validity | ' + value.recharge_desc + '</p> <p class="pull-right"> Talktime | ' + value.recharge_talktime + '</p></div>';

					html += '<div class="clearfix"></div></div></div></a>';
					//  }
plan_category_list
				});
				$("#plan_category_list").html(html1);
				$("#Recommende").html(html);

			}
		}
	});

	/*
	 $.ajax({
	 url: base_url+"recharge_plan",
	 type: "POST",
	 data: {
	 'operator_id':plan_operator_id,
	 'plan_category_id':id_cat_plan
	 },
	 success: function (data)
	 {

	 var getdata=jQuery.parseJSON(data);

	 var status=getdata.status;

	 if(status=='true'){
	 var html='';

	 $("#operator_name").text(getdata.operator_name);
	 $.each(getdata.recharge_details, function (key, value) {
	 var recommended=value.plan_category_name;
	 $("#operator_name").text(value.operator_name);
	 if(recommended=='Recommended'){
	 html += '<a href="#" onclick="get_amount('+value.recharge_amount+','+plan_type+')"><div class="plan_list">';
	 html += '<div class="plan_rate">₦<span id="select_amount">'+value.recharge_amount+'</span></div>';
	 html += '<div class="plan_details"><p><span class="operator_name">'+value.operator_name+'</span> GSM '+value.recharge_data_pack+'</p>';
	 html +=  '<p class="pull-left">'+value.recharge_validity+'Validity | '+value.recharge_desc+'</p> <p class="pull-right"> Talktime | '+value.recharge_talktime+'</p></div>';

	 html += '<div class="clearfix"></div></div></div></a>';

	 }

	 });
	 $("#Recommende").html(html);
	 }else if(status=='false'){

	 $("#operator_name").text("No Plans are avalible");
	 $("#Recommende").html('');
	 }

	 }
	 });*/

	$("#rec_category").val('');
}

function change_plan(plan_category_id) {
	var plan_operator_id = '';
	var mobile_operator_id = $("#mobile_operator_id").val();
	var data_operator_id = $("#datacard_operator_id").val();
	var dth_operator_id = $("#dth_operator_id").val();

	if (mobile_operator_id) {
		plan_operator_id = mobile_operator_id;
	}
	if (dth_operator_id) {
		plan_operator_id = dth_operator_id;
	}
	if (data_operator_id) {
		plan_operator_id = data_operator_id;
	}
	if (mobile_operator_id) {
		var plan_type = '1';
	} else if (dth_operator_id) {
		var plan_type = '2';
	} else if (data_operator_id) {
		var plan_type = '3';
	}
	var mobile = $("#mobile").val();

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

				$("#operator_name").text(getdata.operator_name);
				$.each(getdata.recharge_details, function(key, value) {
					$("#operator_name").text(value.operator_name);
					if (plan_category_id == value.plan_category_id) {
						html += '<a href="#" onclick="get_amount(' + value.recharge_amount + ',' + plan_type + ')"><div class="plan_list">';
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

// show recharge plan from footer with operator wise///
function show_recharge_plan(operator_id) {
	var operator_id = operator_id;

	//var mobile=$("#mobile").val();
	$('#RechagePlan').modal();
	$.ajax({
		url : base_url + "recharge_plan",
		type : "POST",
		data : {
			'operator_id' : operator_id
		},
		success : function(data) {
			var getdata = jQuery.parseJSON(data);
			var status = getdata.status;
			if (status == 'true') {
				var html = '';

				$("#operator_name").text(getdata.operator_name);
				$.each(getdata.recharge_details, function(key, value) {
					$("#operator_name").text(value.operator_name);
					html += '<a href="#" onclick="get_amount(' + value.recharge_amount + ')"><div class="plan_list">';
					html += '<div class="plan_rate">₦<span id="select_amount">' + value.recharge_amount + '</span></div>';
					html += '<div class="plan_details"><p><span class="operator_name">' + value.operator_name + '</span> GSM ' + value.recharge_data_pack + '|Post Free Usage with Validity left: 10p/10KB|Activation: USSD *141*322#</p>';
					html += '<p class="pull-left">' + value.recharge_validity + 'Validity | days</p> <p class="pull-right"> Talktime | ' + value.recharge_talktime + '</p></div>';

					html += '<div class="clearfix"></div></div></a>';

				});
				$("#Recommende").html(html);
			} else if (status == 'false') {

			}

		}
	});
}

function another_mobile_recharge() {

	location.href = site_url + "?another_rec=10";

}

function tv_rech() {

	location.href = site_url + "?another_rec=11";

}

function payment(recharge_category_id, mobile_no, recharge_amt, payble_amt, operator_id) {
	var recharge_category_id = recharge_category_id;
	var mobile_no = mobile_no;
	var recharge_amt = recharge_amt;
	var payble_amt = payble_amt;
	var operator_id = operator_id;

	localStorage.setItem("recharge_category_id", recharge_category_id);
	localStorage.setItem("mobile_no", mobile_no);
	localStorage.setItem("recharge_amt", recharge_amt);
	localStorage.setItem("payble_amt", payble_amt);
	localStorage.setItem("operator_id", operator_id);
	location.href = site_url + "payment";
}

function data_recharge() {

	location.href = site_url + "?another_rec=12";

}

function repeat_recharge1() {
	$("#overlay").addClass('active');
	var user_id = $("#user_id").val();
	var recharge_category_id = $("#recharge_category_id").val();
	var operator_id = $("#operator_id").val();
	var recharge_amount = $("#recharge_amount").val();
	var recharge_number = $("#recharge_number").val();
	$.ajax({
		url : base_url + "recharge",
		type : "POST",
		data : {
			'operator_id' : operator_id,
			'recharge_user_id' : user_id,
			'recharge_category_id' : recharge_category_id,
			'recharge_number' : recharge_number,
			'recharge_amount' : recharge_amount
		},
		success : function(data) {
			$("#overlay").removeClass('active');
			$("#recharge").modal();
			var getdata = jQuery.parseJSON(data);
			var status = getdata.status;
			var message = getdata.message;
			if (status == 'true') {
				var wallet = getdata.wallet_amount;
				$("#rec_date").text(getdata.recharge_date);
				$("#amt").text(recharge_amount);
				$("#order_id").text(getdata.transaction_id);
				$("#mob_num").text(recharge_number);
				$("#wallet_amounts").text(wallet);
				$("#amnt").text(recharge_amount);
				$('#msg').attr('style', 'color: #337D75');

			} else if (status == 'false') {
				$('#msg').attr('style', 'color: red');
			}
			$("#msg").text(message);
		}
	});
}

// function check field of transfer money page//
function check_amount_field() {
	var transfer_amount = $("#transfer_amount").val();
	var amount = parseInt(transfer_amount);

	if (isNaN(amount)) {
		$("#amount_error").text("Please Enter a valid amount");
		$("#amount_error").attr('style', 'color:red');
	} else {
		$("#amount_error").text("");
		$("#amount_error").attr('style', 'color:');
	}

}

function check_number_field() {

	var transfer_mobile_no = $("#transfer_mobile_no").val();
	var number = parseInt(transfer_mobile_no);
	if (isNaN(number)) {
		$("#number_error").text("Please Enter a valid number");
		$("#number_error").attr('style', 'color:red');
	} else if ($('#transfer_mobile_no').val().length > 10) {
		$("#number_error").text("Please Enter a 10 digit number");
		$("#number_error").attr('style', 'color:red');
	} else if ($('#transfer_mobile_no').val().length < 10) {
		$("#number_error").text("Please Enter a 10 digit number");
		$("#number_error").attr('style', 'color:red');
	} else {
		$("#number_error").text("");
		$("#number_error").attr('style', 'color:');
	}

}

// function transfer_money///
function transfer_money() {
	$("#transfer_pin").val('');
	$("#confirm_pin").val('');
	$("#check_transfer_pin").val('');
	var user_id = $("#user_id").val();
	var transfer_amount = $("#transfer_amount").val();
	var transfer_mobile_no = $("#transfer_mobile_no").val();
	var wallet_amount = $("#wallet").text();
	var transfer_pin_status = $("#transfer_pin_status").val();
	if (transfer_amount == '') {

		$("#amount_error").text('Please Enter amount');
		//$("#amount_error").attr('style','color: red!important');
	} else if (transfer_amount == 0) {

		$("#amount_error").text('Please Enter amount grater then 0 to transfers');
		//$("#amount_error").attr('style','color: red!important');
	} else if (transfer_amount > 10000) {

		$("#amount_error").text('You can transfer upto 10000 into your wallet. ');
		//	$("#amount_error").attr('style','color: red!important');
	} else if (transfer_mobile_no == '') {
		//	$('#transfer_mobile_no').attr('style','color: red!important');
		$("#number_error").text('Please Enter Mobile Number');
		//	$("#number_error").attr('style','color: red!important');
	} else if (transfer_amount <= wallet_amount) {
		$("#amount_error").text('These amount is not sufficient in your wallet');
		//	$('#transfer_amount').attr('style','color: red!important');
	} else if (transfer_pin_status) {

		if (transfer_pin_status == '2') {
			$("#save_pin").modal();
		} else if (transfer_pin_status == '1') {
			$("#check_pin").modal();
		}

	}

}

function wallet_transfer_money() {
	$("#overlay").addClass('active');
	var user_id = $("#user_id").val();
	var transfer_amount = $("#transfer_amount").val();
	var transfer_mobile_no = $("#transfer_mobile_no").val();
	var wallet_amount = $("#wallet").text();
	$.ajax({
		url : base_url + "transfer_money",
		type : "POST",
		data : {
			'user_id' : user_id,
			'mobile_no' : transfer_mobile_no,
			'amount' : transfer_amount

		},
		success : function(data) {
			$("#overlay").removeClass('active');
			var getdata = jQuery.parseJSON(data);
			var status = getdata.status;
			var message = getdata.message;
			if (status == 'true') {
				$("#save_pin").modal('hide');
				$("#check_pin").modal('hide');
				$("#transfer_popup").modal();
				$("#amt").text(transfer_amount);
				$("#mob_num").text(transfer_mobile_no);
				$("#wallet").text(getdata.main_wallet);
				$("#order_id").text(getdata.transaction_id);
				$("#rec_date").text(getdata.transfer_date);
				$("#transfer_amount").val('');
				$("#transfer_mobile_no").val('');

				$("#msg").attr('style', 'color: green');
				$("#msg").text(message);
				$(".wallet_amount").text(getdata.main_wallet);
			} else if (status == 'false') {

				$("#status").attr('style', 'color: red');
				$("#status").text(message);
			}

		}
	});
}

function sms_add_plan() {
	$("#pin_type").val('7_1');
	var transfer_pin_status = $("#transfer_pin_status").val();

	if (transfer_pin_status) {

		if (transfer_pin_status == '2') {
			$("#save_pin").modal();
		} else if (transfer_pin_status == '1') {
			$("#check_pin").modal();
		}

	}

}

// functionn  show sms plan //
function sms_plan() {
	//var operator_id=$("#mobile_operator_id").val();
	var operator_id = '1';

	$('#Smsplan').modal();
	$.ajax({
		url : base_url + "sms_plan",
		type : "POST",
		data : {
			'operator_id' : operator_id
		},
		success : function(data) {
			var getdata = jQuery.parseJSON(data);

			var status = getdata.status;
			if (status == 'true') {
				var html = '';

				$.each(getdata.sms_details, function(key, value) {

					html += '<a href="#" onclick="get_sms_plan(' + value.sms_plan_amount + ')"><div class="plan_list">';
					html += '<div class="plan_rate">₦<span id="select_amount">' + value.sms_plan_amount + '</span></div>';
					html += '<div class="plan_details"><p><span class="operator_name">' + value.message + '</span> </p></div>';

					html += '<div class="clearfix"></div></div></a>';

				});
				$("#Recommende").html(html);
			} else if (status == 'false') {

			}

		}
	});
}

function get_sms_plan(amount) {
	var user_id = $("#user_id").val();
	var amount = amount;
	if (confirm('Are you sure, You want use this plan?')) {
		$.ajax({
			url : base_url + "add_sms",
			type : "POST",
			data : {
				'user_id' : user_id,
				'sms_amount' : amount

			},
			success : function(data) {
				$('#Smsplan').modal('hide');
				var getdata = jQuery.parseJSON(data);
				var status = getdata.status;
				var message = getdata.message;
				if (status == 'true') {
					$("#sms_status").attr('style', 'color: green!important');
					$("#sms_status").text(message);
					$("#sms_get").text(getdata.total_sms);
					$("#remain_sms").text(getdata.remaining_sms);
					$(".wallet_amount").text(getdata.wallet_amount);
				} else if (status == 'false') {

					$("#sms_status").text(message);
				}

			}
		});

	}
}

function share_sms_popup() {
	$("#SMS").modal();
}

// function share sms to frnd//
function share_sms() {

	$("#pin_type").val('7_2');
	//$("#SMS").modal();
	var transfer_pin_status = $("#transfer_pin_status").val();
	var user_id = $("#user_id").val();

	var transfer_amount = $("#transfer_amount").val();

	var wallet_amount = $("#wallet_amount").val();
	var transfer_mobile_no = $("#transfer_mobile_no").val();
	if (transfer_amount == '') {

		// 	$('#transfer_amount').attr('style','color: red!important');
		$("#amount_error").text('Please Enter Number of sms');
		$("#amount_error").attr('style', 'color: red!important');
	} else if (transfer_mobile_no == '') {
		//	$('#transfer_mobile_no').attr('style','color: red!important');
		$("#number_error").text('Please Enter Mobile Number');
		$("#number_error").attr('style', 'color: red!important');
	}
	/* else if(transfer_amount!=''){
	if(transfer_amount>wallet_amount){
	$('#transfer_amount').attr('style','color: red!important');
	$("#amount_error").text('Not sufficeinet amount in your wallet');
	}
	}*/
	//
	else if (transfer_pin_status) {
		$("#SMS").modal('hide');
		if (transfer_pin_status == '2') {

			$("#save_pin").modal();
		} else if (transfer_pin_status == '1') {
			$("#check_pin").modal();
		}

	}
}

function frnd_share_sms() {
	var user_id = $("#user_id").val();
	var transfer_amount = $("#transfer_amount").val();
	var wallet_amount = $("#wallet_amount").val();
	var transfer_mobile_no = $("#transfer_mobile_no").val();
	$.ajax({
		url : base_url + "share_sms",
		type : "POST",
		data : {
			'user_id' : user_id,
			'mobile_no' : transfer_mobile_no,
			'share_sms' : transfer_amount

		},
		success : function(data) {
			var getdata = jQuery.parseJSON(data);
			var status = getdata.status;
			var message = getdata.message;
			if (status == 'true') {
				$("#pin_type").val('');
				$("#SMS").modal('hide');
				$("#transfer_amount").val('');
				$("#transfer_mobile_no").val('');
				$("#sms_status").attr('style', 'color: green');
				$("#sms_status").text(message);
				$("#remain_sms").text(getdata.main_user_sms);
			} else if (status == 'false') {

				$("#sms_error_status").attr('style', 'color: red');
				$("#sms_error_status").text(message);
			}

		}
	});
}

function mobile_show() {
	$('#mRechargeSlider').toggleClass('active');
	$('#tvRechargeSlider').removeClass('active');
	$('#dataRechargeSlider').removeClass('active');
	$('#electricityRechargeSlider').removeClass('active');
	$('#billerRechargeSlider').removeClass('active');
	$('#tollRechargeSlider').removeClass('active');
}

function tv_show() {
	$('#tvRechargeSlider').toggleClass('active');
	$('#mRechargeSlider').removeClass('active');
	$('#dataRechargeSlider').removeClass('active');
	$('#electricityRechargeSlider').removeClass('active');
	$('#billerRechargeSlider').removeClass('active');
	$('#tollRechargeSlider').removeClass('active');
}

function data_show() {
	$('#dataRechargeSlider').toggleClass('active');
	$('#mRechargeSlider').removeClass('active');
	$('#tvRechargeSlider').removeClass('active');
	$('#electricityRechargeSlider').removeClass('active');
	$('#billerRechargeSlider').removeClass('active');
	$('#tollRechargeSlider').removeClass('active');
}

function electricity_rec() {
	$('#electricityRechargeSlider').toggleClass('active');
	$('#mRechargeSlider').removeClass('active');
	$('#tvRechargeSlider').removeClass('active');
	$('#dataRechargeSlider').removeClass('active');
	$('#billerRechargeSlider').removeClass('active');
	$('#tollRechargeSlider').removeClass('active');
}

function toll_rec() {

	$('#tollRechargeSlider').toggleClass('active');
	$('#electricityRechargeSlider').removeClass('active');
	$('#mRechargeSlider').removeClass('active');
	$('#tvRechargeSlider').removeClass('active');
	$('#dataRechargeSlider').removeClass('active');
	$('#billerRechargeSlider').removeClass('active');
}

function biller_rec() {
	$('#billerRechargeSlider').toggleClass('active');
	$('#tollRechargeSlider').removeClass('active');
	$('#electricityRechargeSlider').removeClass('active');
	$('#mRechargeSlider').removeClass('active');
	$('#tvRechargeSlider').removeClass('active');
	$('#dataRechargeSlider').removeClass('active');
}
function event_rec() {
	$('#billerRechargeSlider').removeClass('active');
	$('#event_rec').toggleClass('active');
	$('#electricityRechargeSlider').removeClass('active');
	$('#mRechargeSlider').removeClass('active');
	$('#tvRechargeSlider').removeClass('active');
	$('#dataRechargeSlider').removeClass('active');
}
//  function free coupon offer part///
function get_coupon_cat_id(id) {
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

//  function mannage to all offer of promotional offer//
function add_coupon_offer(id) {

	$('.addedoffer_' + id).addClass('active');
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
				$.each(getdata.arr, function(key, value) {
					html += ' <div class="offer_img"><div class="del_img" onclick="delete_cart_offer(' + value.coupon_id + ')"><i class="fa fa-close"></i></div><img class="" width="50" height="40"  src="' + value.coupon_img + '" alt="..."/></div>';
					//html += '<p class="cpoupon-name">' + value.coupon_name + '</p>';
					//html += '  <p class="coupon-count">₦ ' + value.coupon_discount + ' <span style="cursor:pointer" class="delete" onclick="delete_cart_offer(' + value.coupon_id + ')"><i class="fa fa-close"></i></span></p>';

				});

				$("#free_oupons").html(html);
			} else {

			}
		}
	});
}

// function delete_cart item
function delete_cart_offer(id) {
	user_id = $("#user_id").val();
	coupon_id = id;
	$.ajax({
		url : site_url + "delete_cart_coupon",
		type : "POST",
		data : {
			'coupon_id' : id,
			'user_id' : user_id

		},
		success : function(data) {

			var html = '';
			if (data != '') {

				var getdata = jQuery.parseJSON(data);
				if (getdata.arr) {
					$.each(getdata.arr, function(key, value) {
						//html += '<p class="cpoupon-name">' + value.coupon_name + '</p>';
						//	html += '  <p class="coupon-count">₦ ' + value.coupon_discount + ' <span style="cursor:pointer" class="delete" onclick="delete_cart_offer(' + value.coupon_id + ')"><i class="fa fa-close"></i></span></p>';
						html += ' <div class="offer_img"><div class="del_img" onclick="delete_cart_offer(' + value.coupon_id + ')"><i class="fa fa-close"></i></div><img class="" width="50" height="40"  src="' + value.coupon_img + '" alt="..."/></div>';
					});

				} else {
					html += '<p class="pull-left">No Vouchers applied Yet! &nbsp;</p><a onclick="clickscroll()" href="#" class="label label-warning form-group voucher pull-left">Get Offer</a><div class="clearfix"></div>';
				}
				$("#free_oupons").html(html);
			}
		}
	});

}

function get_cart_coupon(user_id) {

	var user_id = user_id;
	$.ajax({
		url : site_url + "get_cart_coupon",
		type : "POST",
		data : {

			'user_id' : user_id

		},
		success : function(data) {

			var html = '';

			var getdata = jQuery.parseJSON(data);

			if (getdata.arr != '') {
				$.each(getdata.arr, function(key, value) {
					html += ' <div class="offer_img"><div class="del_img" onclick="delete_cart_offer(' + value.coupon_id + ')"><i class="fa fa-close"></i></div><img class="" width="50" height="40"  src="' + value.coupon_img + '" alt="..."/></div>';

				});

			} else {

				html += '<p class="pull-left">No Vouchers applied Yet! &nbsp;</p><a onclick="clickscroll()" href="#" class="label label-warning form-group voucher pull-left">Get Offer</a><div class="clearfix"></div>';
			}
			$("#free_oupons").html(html);

		}
	});
}

function close_popup_field() {
	$("#mRechargeSlider").removeClass("active");
	$("#electricityRechargeSlider").removeClass("active");
	$("#dataRechargeSlider").removeClass("active");
	$("#tvRechargeSlider").removeClass("active");
	$("#tollRechargeSlider").removeClass("active");
	$("#billerRechargeSlider").removeClass("active");
}

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
				//$("#electricity_next").attr('style','display:block');
				
				$("#customer_name").val(data);
			}else{
				$("#customer_name").val("Enter valid Meter / Account number");
			}
				
			}
		
	});
}
function event_ticket_booking()
{
	
	var ticket_json=localStorage.getItem("ticket_json_array");
	//var ticket_json= $.parseJSON( localStorage["mykey"] );
	var user_id = $("#user_id").val();
	var event_id = localStorage.getItem("event_id");
	var amount=localStorage.getItem("ticket_amount"); 
	$.ajax({
		url : base_url + "ticket_booking_payment",
		type : "POST",
		data : {
			'user_id' : user_id,
			'event_id' : event_id,
			'ticket_price' : amount,
			'tickets_records':ticket_json

		},
		success : function(data) {
			var getdata = jQuery.parseJSON(data);
			var status = getdata.status;
			var msg = getdata.message;
			if (status == 'true') {
				$("#overlay").removeClass('active');
				localStorage.setItem('event_id',"");
				localStorage.setItem('ticket_json_array',"");
				localStorage.setItem('ticket_amount',"");
				$("#recharge").modal();
				if (recharge_category_id == '1') {
					$("#charge").attr("onclick", "another_mobile_recharge()");
				} else if (recharge_category_id == '2') {
					$("#another_recharge").attr("onclick", "tv_rech()");
				} else if (recharge_category_id == '3') {
					$("#another_recharge").attr("onclick", "data_recharge()");
				}else if (recharge_category_id == '5') {
					$("#another_recharge").attr("onclick", "electricity_recharge()");
				}
				
					$("#electricity_response").html('Event Ticket Booking');
				
				$("#mobile_recharge").modal();
				$("#coupon_status").text('');
				$("#msg").text('');
				$("#promo_code").val('');
				var wallet = getdata.wallet_amount;
				$("#rec_date").text(getdata.booking_date);
				$("#amt").text(getdata.booking_amount);
				$("#order_id").text(getdata.transaction_id);
				$("#mob_num").text(msg);
				$(".wallet_amount").text(wallet);
				$("#amnt").text(getdata.booking_amount);
				$('#msg').attr('style', 'color: #337D75');
			}else{
				$("#recharge_failed").modal();
				$("#failed_rec_date").text(getdata.booking_date);
				$("#failed_amt").text(getdata.booking_amount);
				$("#failed_order_id").text(getdata.transaction_id);
				
				//$(".wallet_amount").text(wallet);
				//$("#amnt").text(recharge_amount);
				$("#coupon_amount").val('');
				$("#coupon_id").val('');
				$('#msg').attr('style', 'color: red');
			}

		}
	});
}
