<?php

require_once ("Rest.inc.php");
include_once 'db.class.php';
include_once 'config.php';

//include_once 'fpdf.php';

class API extends REST {

	public $data = "";

	const DB_SERVER = "localhost";
	const DB_USER = "oyarech_user";
	const DB_PASSWORD = "xjXpRTP3dNuGpAteroot";
	const DB = "oyarech_db";

	// const DB_SERVER = "localhost";
	// const DB_USER = "recharge_user";
	// const DB_PASSWORD = "wKGmKN9UBbmSJS7f";
	// const DB = "recharge_db";

	private $db = NULL;
	private $conn;

	public function __construct() {
		parent::__construct();
		// Init parent contructor
		$this -> dbConnect();
		// Initiate Database connection
		$this -> conn = new DB;
	}

	/*
	 *  Database connection
	 */

	private function dbConnect() {
		$this -> db = mysql_connect(self::DB_SERVER, self::DB_USER, self::DB_PASSWORD);
		if ($this -> db)
			mysql_select_db(self::DB, $this -> db);
	}

	/*
	 * Public method for access api.
	 * This method dynmically call the method based on the query string
	 *
	 */

	public function processApi() {
		$func = strtolower(trim(str_replace("/", "", $_REQUEST['rquest'])));
		if ((int) method_exists($this, $func) > 0)
			$this -> $func();
		else
			$this -> response('', 404);
		// If the method not exist with in this class, response would be "Page not found".
	}

	//== smtp mail function===
	function sendElasticEmail($to, $subject, $body_text, $body_html, $from, $fromName)
	{
    $res = "";

    $data = "username=".urlencode("care@oyacharge.com");
    $data .= "&api_key=".urlencode("9baa5dc0-e443-4f06-ac91-e547d3845151");
    $data .= "&from=".urlencode($from);
    $data .= "&from_name=".urlencode($fromName);
    $data .= "&to=".urlencode($to);
    $data .= "&subject=".urlencode($subject);
    if($body_html)
      $data .= "&body_html=".urlencode($body_html);
    if($body_text)
      $data .= "&body_text=".urlencode($body_text);

    $header = "POST /mailer/send HTTP/1.0\r\n";
    $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
    $header .= "Content-Length: " . strlen($data) . "\r\n\r\n";
    $fp = fsockopen('ssl://api.elasticemail.com', 443, $errno, $errstr, 30);

    if(!$fp)
      return "ERROR. Could not open connection";
    else {
      fputs ($fp, $header.$data);
      while (!feof($fp)) {
        $res .= fread ($fp, 1024);
      }
      fclose($fp);
    }
    return $res;                  
	}
function stable_version()
{
	$post = array("status" => "true", "message" => "Version found",'android_version'=>4,'ios_version'=>'1.0');
	echo $this -> json($post);
}
	// admin login///
	// function check reffer nd share code////


	
	

function check_secure_pin()
{
	if(!empty($_REQUEST['user_id']) && !empty($_REQUEST['secure_pin']))
	{
		$user_id	=	$_REQUEST['user_id'];
		$pin		=	$_REQUEST['secure_pin'];
		
		$pin_records = $this -> conn -> get_table_field_doubles('user', 'user_id', $user_id, 'user_password', md5($pin));
			if(!empty($pin_records))
			{
				$post = array("status" => "true", "message" => "Pin checked Successfully");
			}else{
				$post = array("status" => "false", "message" => "Pin is invalid");
			}
			
	}else{
		$post = array("status" => "false", "message" => "Missing parameter",'user_id'=>$_REQUEST['user_id'],'secure_pin'>$_REQUEST['secure_pin']);
	}
			echo $this -> json($post);
}


	function set_mpin()
	{
		if(!empty($_REQUEST['user_id']) && !empty($_REQUEST['mpin']))
		{

			$array  = array_map('intval', str_split($_REQUEST['mpin']));

			$isSequence = $this->is_arithmetic($array);

			if( $isSequence != true){
				$post = array('status' => "false", "message" => 'MPIN shoud not be a sequence.');
				echo $this -> json($post); exit;	

			}

			$user_id=$_REQUEST['user_id'];
			$mpin=$_REQUEST['mpin'];
			$data['user_password'] = md5($_REQUEST['mpin']);
			$data['user_pin_status'] = 1;
			$update_mpin = $this -> conn -> updatetablebyid('user', 'user_id', $user_id, $data);
			$post = array('status' => "true", "message" => "MPin set successfully", 'mpin' => $_REQUEST['mpin'],'mpin_status'=>1);
			
		}else{
			$post = array('status' => "false", "message" => "Missing Parameter", 'mpin' => $_REQUEST['mpin'],'user_id'=>$_REQUEST['user_id']);
			
		}
		echo $this -> json($post);
	}


	  function is_arithmetic($arr)
	  {
	   $delta = $arr[1] - $arr[0];
	   for($index=0; $index<sizeof($arr)-1; $index++)
	    {
	        if (($arr[$index + 1] - $arr[$index]) != $delta)
	        {
	             
	             return true;
	        }       
	    }
	    return false;
	 }

	
	
	// function check reffer nd scretch code////
	function check_reffer_code() {
		$reffer_code = $_REQUEST['reffer_code'];
		$current_date=date("Y-m-d");
		if (!empty($reffer_code)) {
			
			$reffer_records = $this -> conn -> get_table_row_byidvalue('user', 'user_refferal_code', $reffer_code);
			if (!empty($reffer_records)) {
				$user_id = $reffer_records[0]['user_id'];
				$user_reffer_code = $reffer_records[0]['user_refferal_code'];

				//if($user_reffer_code==$reffer_code){
				if (strcmp($user_reffer_code, $reffer_code) == 0) {
					$post = array("status" => "true", "message" => "Reffer code avalible", 'reffer_code' => $reffer_code, 'user_id' => $user_id,'code_type'=>'1');
				} else {
					$post = array("status" => "false", "message" => "Invalid reffer code");
				}

			} else {
				
			$skretch_records = $this -> conn -> get_table_field_doubles('skretch_card', 'skretch_card_code', $reffer_code, 'skretch_card_status', '1');
				if(!empty($skretch_records))
				{
					$coupon_amount = $skretch_records[0]['skretch_card_amount'];
					$skretch_card_validity = $skretch_records[0]['skretch_card_validity'];
					$skretch_card_user = $skretch_records[0]['skretch_card_user'];
					$skretch_card_id = $skretch_records[0]['skretch_card_id'];
					if (strcmp($reffer_code, $reffer_code) == 0) {
						
						
				if ($skretch_card_validity >= $current_date && $skretch_card_user > 0) {
					$coupon_record = $this -> conn -> get_table_field_doubles('coupon_details', 'coupon_id', $coupon_id, 'user_id', $user_id);
					$post = array("status" => "true", "message" => "Scratch code avalible", 'reffer_code' => $reffer_code, 'coupon_amount' => $coupon_amount,'code_type'=>'2','skretch_card_id'=>$skretch_card_id);
				} else {
					$post = array("status" => "false", "message" => "Invalid Skrecth code");
				}
				}else{
					$post = array("status" => "false", "message" => "Invalid Skrecth code");
				}
				}else{
					$post = array("status" => "false", "message" => "Invalid Code");
				}
				
			}
		} else {
			$post = array("status" => "false", "message" => "Missing parameter", 'reffer_code' => $reffer_code);
		}
		echo $this -> json($post);
	}
	//==== Refferal amount set by admin=====////
	function reffer_amount() {
		$user_id = $_REQUEST['user_id'];
		if (!empty($user_id)) {
			$reffer_records = $this -> conn -> get_all_records('reffer_amount');
			$refferal_amount = $reffer_records[0]['reffer_amount'];

			$records = $this -> conn -> get_table_row_byidvalue_sum('refferal_records', 'refferal_frnd_id', $user_id, 'refferal_amount');
			$user_reffer_amount = $records[0]['total'];
			if (!empty($user_reffer_amount)) {
				$user_reffer_amount = $user_reffer_amount;
			} else {
				$user_reffer_amount = '0';
			}
			$post = array("status" => "true", 'reffer_amount' => $refferal_amount, 'user_total_reffer_amount' => $user_reffer_amount, 'user_id' => $user_id);

		} else {
			$post = array("status" => "false", 'message' => 'missing parameter', 'user_id' => $user_id);
		}
		echo $this -> json($post);
	}

	/// complete refferal amount nd user refferal balence

	function login() {

		//$email = $this -> _request['user_email'];
		$u_password = $this -> _request['user_password'];
		$password = $this -> _request['user_password'];
		$login_id = $this -> _request['login_id'];

		// Input validations
		if (!empty($login_id) && !empty($password)) {
			$mobile = $login_id;
			$records = $this -> conn -> get_table_row_byidvalue('user', 'user_contact_no', $mobile);
			$verify_status = $records[0]['user_mobile_verify_status'];
			$mob = $records[0]['user_contact_no'];
			$id_user = $records[0]['user_id'];
			if (!empty($records)) {

				$records_user = $this -> conn -> get_table_field_doubles('user', 'user_contact_no', $mobile, 'user_password', md5($password));
				if (!empty($records_user)) {
					$email_status = $records_user[0]['user_email_verify'];
					
					$status = $records_user[0]['user_status'];
					if ($status == '1') {
						if ($verify_status == '1') {

							$pin_status = $records_user[0]['user_pin_status'];
							$reffer_code = $records_user[0]['user_refferal_code'];
							$user_id = $records_user[0]['user_id'];
							$user_mobile = $records_user[0]['user_contact_no'];
							$user_email = $records_user[0]['user_email'];
							$user_name = $records_user[0]['user_name'];
							$wallet_amount = $records_user[0]['wallet_amount'];
							$profile_pic = $records_user['0']['user_profile_pic'];
							$user_password = $records_user['0']['user_password'];
							if (!empty($profile_pic)) {
								$img = self_img_url . $profile_pic;
							} else {
								$img = '';
							}
							$data['user_ip_address'] = $_SERVER['REMOTE_ADDR'];
							$update_toekn = $this -> conn -> updatetablebyid('user', 'user_id', $user_id, $data);
							$post = array("status" => "true", "message" => "Login Successfully", 'user_id' => $user_id, 'user_status' => $status, 'user_name' => $user_name, 'wallet_amount' => $wallet_amount, 'user_profile_pic' => $img, 'user_email' => $user_email, 'user_password' => $u_password, 'mobile' => $user_mobile, 'login_type' => 1, 'user_pin_status' => $pin_status, 'frnd_refferal_code' => $reffer_code);
						} else {
							$token = $this -> send_code($mob);
							$data['user_verified_code'] = $token;
							$update_toekn = $this -> conn -> updatetablebyid('user', 'user_id', $id_user, $data);
							$post = array('status' => "not_verify", "message" => "User Mobile verification pending", 'mobile' => $mob);
							echo $this -> json($post);
							exit();
						}
					} else {
						$post = array("status" => "false", "message" => "Account Inactive by admin, please contact to OyaCahrge");
					}
				} else {
					$post = array("status" => "false", "message" => "Invalid Login ID or Password");
				}
			} elseif (empty($records)) {

				$records = $this -> conn -> get_table_row_byidvalue('user', 'user_email', $login_id);
				$verify_status = $records[0]['user_mobile_verify_status'];
				$mob = $records[0]['user_contact_no'];
				$id_user = $records[0]['user_id'];
				if (!empty($records)) {

					$records_user = $this -> conn -> get_table_field_doubles('user', 'user_email', $login_id, 'user_password', md5($password));
					if (!empty($records_user)) {
							
						$status = $records_user[0]['user_status'];
						if ($status == '1') {
							if ($verify_status == '1') {

								$pin_status = $records_user[0]['user_pin_status'];
								$user_id = $records_user[0]['user_id'];
								$reffer_code = $records_user[0]['user_refferal_code'];
								$user_name = $records_user[0]['user_name'];
								$user_mobile = $records_user[0]['user_contact_no'];
								$wallet_amount = $records_user[0]['wallet_amount'];
								$profile_pic = $records_user['0']['user_profile_pic'];
								$user_email = $records_user[0]['user_email'];
								$user_password = $records_user['0']['user_password'];
								if (!empty($user_profile_pic)) {
									$img = $path . $user_profile_pic;
								} else {
									$img = 'No image';
								}
							$data['user_ip_address'] = $_SERVER['REMOTE_ADDR'];
							$update_toekn = $this -> conn -> updatetablebyid('user', 'user_id', $user_id, $data);
								$post = array("status" => "true", "message" => "Login Successfully", 'user_id' => $user_id, 'user_status' => $status, 'user_name' => $user_name, 'wallet_amount' => $wallet_amount, 'profile_pic' => $img, 'user_email' => $user_email, 'user_password' => $u_password, 'mobile' => $user_mobile, 'login_type' => 1, 'user_pin_status' => $pin_status, 'frnd_refferal_code' => $reffer_code);

							} else {
								$token = $this -> send_code($mob);
								$data['user_verified_code'] = $token;
								$update_toekn = $this -> conn -> updatetablebyid('user', 'user_id', $id_user, $data);
								$post = array('status' => "not_verify", "message" => "User Mobile verification pending", 'mobile' => $mob);

								echo $this -> json($post);
								exit();
							}
						} else {
							$post = array("status" => "false", "message" => "Account Inactive by admin, please contact to OyaCahrge");
						}
					} else {
						$post = array("status" => "false", "message" => "Invalid Login ID or Password");
					}
				} else {
					$post = array('status' => "false", "message" => "Invalid Login ID or Password");
				}
			}

		} else {
			$post = array('status' => "false", "message" => "Login ID and Password are Required", 'login_id' => $login_id, 'user_password' => $user_password);
			
		}
		echo $this -> json($post);
}

	function social_login() {

		$user_email = $_REQUEST['user_email'];
		$user_firstname = $_REQUEST['user_firstname'];
		$user_lastname = $_REQUEST['user_lastname'];
		$user_name = $user_firstname . ' ' . $user_lastname;
		$user_social_id = $_REQUEST['user_social_id'];
		//Social ID
		$login_type = $_REQUEST['login_type'];
		$current_date = date("Y-m-d H:i:s");
		$user_device_type = $_REQUEST['user_device_type'];
		$user_device_token = $_REQUEST['user_device_token'];
		$profile_pic = $_REQUEST['user_profile_pic'];

		if (!empty($user_email) && !empty($user_social_id) && !empty($login_type)) {
			$records = $this -> conn -> get_table_row_byidvalue('user', 'user_email', $user_email);
			$user_id = $records[0]['user_id'];

			$wallet_amount = $records[0]['wallet_amount'];
			$user_email = $records[0]['user_email'];
			$user_contact_no = $records[0]['user_contact_no'];
			$verify_status = $records[0]['user_mobile_verify_status'];
			$pin_status = $records[0]['user_pin_status'];
			$user_refferal_code=$records[0]['user_refferal_code'];
			if (!empty($user_id)) {
				$status = $records[0]['user_status'];
				if ($status == '1') {
					$data['user_name'] = $user_name;
					$data['user_email'] = $user_email;
					$data['user_social_id'] = $user_social_id;
					$data['user_login_type'] = $login_type;
					$data['user_created_date'] = $current_date;
					$data['user_device_type'] = $user_device_type;
					$data['user_device_token'] = $user_device_token;
					$data['user_profile_pic'] = $profile_pic;
					$data['user_ip_address'] = $_SERVER['REMOTE_ADDR'];
					$update_toekn = $this -> conn -> updatetablebyid('user', 'user_id', $user_id, $data);

					$post = array("status" => "true", "message" => "Login Successfully", 'user_id' => $user_id, 'login_type' => $login_type, 'user_name' => $user_name, 'wallet_amount' => $wallet_amount, 'profile_pic' => $profile_pic, 'user_email' => $user_email, 'user_contact_no' =>$user_contact_no, 'verify_status' => $verify_status, 'user_pin_status' => $pin_status,'frnd_refferal_code'=>$user_refferal_code,'mpin_status'=>$pin_status);
				} else {
					$post = array("status" => "inactive", "message" => "Account Inactive by admin, please contact to OyaCahrge");
				}
			} else {
				//$reffer_code = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 6);
		$ref=substr($_POST['user_email'],0,3);
		$random=rand(111,333);
		$reffer = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 2);
		$reffer_code=strtoupper($ref.$random.$reffer);
		$user_ip_address = $_SERVER['REMOTE_ADDR'];
				$user_email = $_POST['user_email'];
				$insert = $this -> conn -> insertnewrecords('user', 'user_name,user_email,user_social_id,user_login_type,user_created_date,user_profile_pic,user_device_type,user_device_token,user_refferal_code,user_ip_address', '"' . $user_name . '","' . $user_email . '","' . $user_social_id . '","' . $login_type . '","' . $current_date . '","' . $profile_pic . '","' . $user_device_type . '","' . $user_device_token . '","' . $reffer_code . '","' . $user_ip_address . '"');
				if ($insert) {
					$wallet_amount = 0;

					$post = array("status" => "true", "message" => "Login Successfully", 'user_id' => $insert, 'login_type' => $login_type, 'user_name' => $user_name, 'wallet_amount' => $wallet_amount, 'profile_pic' => $profile_pic, 'user_email' => $user_email, 'user_contact_no' => '', 'verify_status' => '2', 'user_pin_status' => '2', 'frnd_refferal_code' => $reffer_code,'mpin_status'=>'2');
				}
			}
		} else {
			$post = array('status' => "Failed", "message" => "Missing parameter", 'user_email' => $user_email, 'user_social_id' => $user_social_id);
		}
		echo $this -> json($post);
	}

	function logout() {

		session_start();
		session_destroy();
		echo 1;
	}

	function signup() {

		//country_code = $_POST['country_code'];
		$number 				= 	$_REQUEST['user_mobile_no'];
		$mobile 				= 	$_REQUEST['user_mobile_no'];
		$user_email 			= 	$_REQUEST['user_email'];
		$user_password 			= 	$_REQUEST['user_password'];
		$password 				= 	md5($_REQUEST['user_password']);
		$frnd_reffer_code 		= 	$_REQUEST['frnd_reffer_code'];


		$array  = array_map('intval', str_split($_REQUEST['user_password']));

		$isSequence = $this->is_arithmetic($array);

		if( $isSequence != true){
			$post = array('status' => "false", "message" => 'Password shoud not be a sequence.');
			echo $this -> json($post); exit;	

		}


		if (!empty($frnd_reffer_code)) 
		{
			$frnd_reffer_code 	= $frnd_reffer_code;
		} else {
			$frnd_reffer_code 	= '';
		}
		$current_date 			=   date("Y-m-d H:i:s");
		$user_device_type 		= 	$_REQUEST['user_device_type'];  //1 android, 2 iphone
		$user_device_token 		= 	$_REQUEST['user_device_token'];
		$wallet_amount 			= 	0;
		$ref					=	substr($user_email,0,3);
		$random					=	rand(111,333);
		$reffer 				= 	substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 2);
		if (empty($user_email)) {
		//	$this->email_verification($user_email);
			$post 				= 	array("status" => "false", "message" => "Please enter email id");
			echo $this -> json($post);
			exit();
		}
		$reffer_code			=	strtoupper($ref.$random.$reffer);
		$mobile_records 		= 	$this -> conn -> get_table_row_byidvalue('user', 'user_contact_no', $number);
		$otp 					= 	$mobile_records[0]['user_mobile_verify_status'];
		if ($otp == '2') {
			$token 				= 	$this -> send_code($number);
			$post 				= 	array("status" => "not_verify", "message" => "Please verify your mobile number", 'mobile' => $mobile, 'token' => $token);
			echo $this -> json($post);
			exit();
		}
		
		if (!empty($user_email)) {
			$email_records 		= 	$this -> conn -> get_table_row_byidvalue('user', 'user_email', $user_email);

			if (!empty($email_records)) {
				$post 			= 	array("status" => "false", "message" => "This Email is already registered", 'email' => $user_email, 'email_already' => 2);
				echo $this -> json($post);
				exit();
			}
		} else {
			$user_email 		= 	'';
		}
		if (!empty($number) && !empty($user_password)) {

			$records 			= 	$this -> conn -> get_table_row_byidvalue('user', 'user_contact_no', $number);

			if (!empty($records)) {

				$post 			= 	array("status" => "false", "message" => "This number is already registered", 'mobile' => $number, 'email_already' => 1);
				echo $this -> json($post);

			} else {

				$token 			= 	$this -> send_code($number);
				$insert 		= 	$this -> conn -> insertnewrecords('user', 'user_email, user_contact_no,user_password,user_verified_code,user_created_date,otp_send_time,user_device_type,user_device_token,user_refferal_code', '"' . $user_email . '","' . $number . '","' . $password . '","' . $token . '","' . $current_date . '","' . $current_date . '","' . $user_device_type . '","' . $user_device_token . '","' . $reffer_code . '"');
				if ($insert > 0) {
					$this->email_verification($user_email);
						
					$post 		= 	array("status" => "true", "message" => "OTP sent to the registered number", 'user_id' => $insert, 'token' => $token, 'mobile' => $mobile, 'wallet_amount' => $wallet_amount, 'user_email' => $user_email, 'user_password' => $user_password, 'user_status' => 1, 'login_type' => '1', 'self_refferal_code' => $reffer_code, 'frnd_refferal_code' => $frnd_reffer_code);
					echo $this -> json($post);
				}
			}
		} else {
			$error 				= 	array('status' => "Failed", "message" => "Missing parameter", 'user_mobile_no' => $_POST['user_mobile_no'], 'user_password' => $user_password);
			echo $this -> json($error);
		}
	}

function email_verification($user_email)
{
	$path = 'http://'.$_SERVER['HTTP_HOST'].'/email_verify/';
	$path1='http://'.$_SERVER['HTTP_HOST'].'/webassets/images/logo.png';
	$subject = 'Email verification link';
	$mail_msg .= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Untitled Document</title>
	</head>

	<body bgcolor="#f1f1f1">
	<table cellpadding="0" cellspacing="0" width="600" style="background:#fff; border:1px solid #cbcbcb; margin:0 auto; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
		<thead class="header">
    	<tr>
        	<td style="background:#fff; height:62px; width:100%; padding:5px; border-bottom:1px solid #DDD;" valign="middle">
            	<a href="#" style="margin-left:10px;"><img width="100" src="'.$path1.'" alt="..."/></a>
                
            </td>
        </tr>
    </thead>
    <tbody style=" border-bottom:1px solid #ddd;">
    	<tr>
        	<td style="padding:10px 15px;">
            	<h1 style="margin-bottom:0px; color:#5BBE4F;">Dear ' . ucfirst($user_email) .  '</h1>
            	Thank you for registering with Us. Before we can activate your account one last step must be taken to complete your registration!<br/><br/>
		Please note - you must complete this last step to become a registered member. You will only need to click on the link once, and your account will be updated.<br/>
		To complete your registration, click on the link below:<br/><br/>
		<div style="padding:20px; background-color: #70a93c; color:#fff; text-align:center;"><a href=' . $path . "verify_email.php?email=" . base64_encode($user_email) . '>Please click here activate your accout</a></div>
		 
               	
            </td>
        </tr>
        <tr>
        	<td style="padding:10px 15px;">
            	
            </td>
        </tr>
        
        <tr>
        	<td style="background:#ddd; height:1px; width:100%;"></td>
        </tr>
    </tbody>
    
    <tfoot style="background:#fff; text-align:center; color:#333;">
        <tr>
        	<td style="color:#666;"><p>Copyright © 2015 Your plate All right reserved - site by Ypsilon It Solution</p></td>
        <tr>
    </tfoot>
    
</table>
</body>
</html>';
				$headers  = "Organization: OyaCharge\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
				$headers .= "X-Priority: 3\r\n";
				$headers .= "X-Mailer: PHP" . phpversion() . "\r\n";
				$header   = "From:blm.ypsilon@gmail.com \r\n";
				$header  .= "Cc:blm.ypsilon@gmail.com \r\n";
				$header  .= "MIME-Version: 1.0\r\n";
				$header  .= "Content-type: text/html\r\n";
				$this->sendElasticEmail($user_email, $subject, "OyaCharge", $mail_msg, "care@oyacharge.com", "OyaCharge");
}
	///// Verification of send otp to registered number//////
	function verification() {
		$reffer_code 		= 	$_REQUEST['user_reffer_code'];
		$coupon_type 		= 	$_REQUEST['coupon_type'];
		$coupon_amount 		= 	$_REQUEST['coupon_amount'];
		$code 				= 	$_REQUEST['user_verification_code'];
		$skretch_card_id 	= 	$_REQUEST['skretch_card_id'];
		$mobile 			= 	$_REQUEST['user_mobile_no'];
		//$token = $_POST['token'];
		if (!empty($code)) {

			// Refferal amount
			$reffer_records123  	= 	$this -> conn -> get_all_records('reffer_amount');
			$refferal_amount 		= 	$reffer_records123[0]['reffer_amount'];
			//-----------------/////

			$records 				= 	$this -> conn -> get_table_row_byidvalue('user', 'user_contact_no', $mobile);
			if (!empty($records)) {

				$user_id 			= 	$records['0']['user_id'];
				$token 				= 	$records['0']['user_verified_code'];
				$status 			= 	$records['0']['user_mobile_verify_status'];
				$user_email 		= 	$records['0']['user_email'];
				$user_self_reffer 	= 	$records['0']['user_refferal_code'];
				$wallet_amount 		= 	$records[0]['wallet_amount'];
				$user_profile_pic 	= 	$records[0]['user_profile_pic'];
				if (!empty($user_profile_pic)) {
					if (filter_var($user_profile_pic, FILTER_VALIDATE_URL)) {
						$img 		= $user_profile_pic;
					} else {
						$img 		= self_img_url . $user_profile_pic;
					}
				} else {
					$img 			= '';
				}
				if ($code != $token) {
					$post 			= 	array('status' => 'false', 'message' => 'Invalid Varification code');
					echo $this -> json($post);
				} else if ($code == $token) {
					if ($status == '1') {
						$post 		= 	array('status' => 'false', 'message' => 'Already verified');
						echo $this -> json($post);
						exit();
					}
					$data['user_ip_address'] = $_SERVER['REMOTE_ADDR'];
					$data['user_mobile_verify_status'] = 1;
					$update_toekn = $this -> conn -> updatetablebyid('user', 'user_id', $user_id, $data);

					//check reffer code
					if (!empty($reffer_code)) {
							$reffer_records = $this -> conn -> get_table_row_byidvalue('user', 'user_refferal_code', $reffer_code);
					if(!empty($reffer_records))
					{
						$user11_id 	= 	$reffer_records['0']['user_id'];

						$data12['reffer_user_id'] 		= 	$user11_id;
						$data12['amount_offer_code'] 	= 	$reffer_code;
						$data12['amount_offer_type'] 	= 	'1';
						$update_toekn = $this -> conn -> updatetablebyid('user', 'user_id', $user_id, $data12);
							}else if($coupon_type=='2' && !empty($coupon_amount)){
								 $transaction_id= strtotime("now").mt_rand(10, 99);
								 $current_date=date("Y-m-d H:i:s");
								 $wt_type='2';
								  $wt_category='15';
								  $wt_desc="Amount added in wallet used to scratch card";
								$add_money = $this -> conn -> insertnewrecords('wallet_transaction', 'wt_user_id, wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc,payment_type', '"' . $user_id . '","' . $current_date . '","' . $wt_type . '","' . $coupon_amount . '","' . $wt_category . '","' . $transaction_id . '","' . $wt_desc . '","0"');
								$ref_records = $this -> conn -> get_table_row_byidvalue('skretch_card', 'skretch_card_id', $skretch_card_id);
								$user_count = $ref_records['0']['skretch_card_user'];
								$data1211['skretch_card_user'] = $user_count-1;
								$update_toekn = $this -> conn -> updatetablebyid('skretch_card', 'skretch_card_id', $skretch_card_id, $data1211);
								
								$data12['wallet_amount'] = $coupon_amount;
								$data12['amount_offer_code'] = $reffer_code;
								$data12['amount_offer_type'] = '2';
						$update_toekn = $this -> conn -> updatetablebyid('user', 'user_id', $user_id, $data12);
							}
						

					}
					$email_verify = $records['0']['user_email_verify'];
					if ($email_verify == '2') {
						$msg12 = 'Please verify your regsitered email address';
						
					}else{
						$msg12='';
					}
					$post = array("status" => "true", "message" => "Successfully verified! ".$msg12, "mobile" => $_REQUEST['user_mobile_no'], 'user_id' => $user_id, 'user_wallet' => $wallet_amount, 'user_email' => $user_email, 'login_type' => 1, 'frnd_refferal_code' => $user_self_reffer, 'profile_pic' => $img, 'user_pin_status' => '2');
					echo $this -> json($post);
				}

			} else {
				$error = array('status' => "false", "message" => "User not Exist");
				echo $this -> json($error);
			}
		} else {
			$error = array('status' => "false", "message" => "Please Enter a valid verification code", 'user_mobile_no' => $_POST['user_mobile_no'], 'verification_code' => $_POST['user_verification_code']);
			echo $this -> json($error);
		}
	}

	////Forget Password////
	function forget_password() {
		$login_id = $_POST['login_id'];
		$mobile = $login_id;
		if (!empty($login_id)) {
			$records_user = $this -> conn -> get_table_field_doubles('user', 'user_contact_no', $mobile, 'user_status', 1);
			
			if (!empty($records_user)) {
				$user_id 				= 	$records_user[0]['user_id'];
				$mobile 				= 	$records_user[0]['user_contact_no'];
				$email 					= 	$records_user[0]['user_email'];
				$name 					= 	$records_user[0]['user_name'];
				$token 					= 	$this -> forget_send_code($mobile);
				$password 				= 	md5($token);
				$data['user_password'] 	= 	$password;
				$update_toekn 			= 	$this -> conn -> updatetablebyid('user', 'user_id', $user_id, $data);
				$user_email 			= 	$email;
				$subject = 'Forget Password of OyaCharge Login';
				$message= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>Untitled Document</title></head>

<body bgcolor="#f1f1f1">
<table cellpadding="0" cellspacing="0" width="600" style="background:#fff; border:1px solid #cbcbcb; margin:0 auto; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
	<thead class="header">
    	<tr>
        	<td style="background:#FFFFFF; height:62px; width:100%; padding:5px; border-bottom:1px solid #DDD;" valign="middle">
            	<a href="#" style="margin-left:10px;"><img width="100" src="'.mail_logo.'" alt="..."/></a>
                
            </td>
        </tr>
    </thead>
    <tbody style=" background:#FEFEFE; border-bottom:1px solid #ddd;">
    	<tr>
        	<td style="padding:10px 15px;">
            	<h1 style="margin-bottom:0px; color:#337d75;">OyaCharge </h1>
            	<p> Dear '.$name.', below is the new password as per request. 
</p>';
            $message .=  '<p>Username:<strong>' .$email;'</strong></p>';
            $message .=  '<p>Password:<strong>'.$token;'</strong></p></td></tr>';
          	$message .= '<tr><td style="background:#ddd; height:1px; width:100%;"></td></tr></tbody>';
    		$message .= '<tfoot style="background:#337d75; text-align:center; color:#fff;"><tr><td><p> Copyright © 2016 OyaCharge All right reserved </p></td><tr></tfoot></table></body></html>';
			
			$headers = "Organization: OyaCharge\r\n";
  			$headers .= "MIME-Version: 1.0\r\n";
		  	$headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
		  	$headers .= "X-Priority: 3\r\n";
		  	$headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;
          	$header = "From:blm.ypsilon@gmail.com \r\n";
         	$header .= "Cc:blm.ypsilon@gmail.com \r\n";
         	$header .= "MIME-Version: 1.0\r\n";
         	$header .= "Content-type: text/html\r\n";
         //	$retval = mail ($to,$subject,$message,$header);
			$this->sendElasticEmail($email, $subject,"OyaCharge", $message, "care@oyacharge.com", "OyaCharge");
				//$mail = mail($user_email, $subject, $mail_msg, $headers);
				$post = array('status' => "true", "message" => "New Password send to your mobile number and Registered Email");
			
			} else if (empty($records_user)) {

				$records_user 		= $this -> conn -> get_table_field_doubles('user', 'user_email', $login_id, 'user_status', 1);
				if (!empty($records_user)) {
					$user_id 		= 	$records_user[0]['user_id'];
					$mobile 		= 	$records_user[0]['user_contact_no'];
					$name 			= 	$records_user[0]['user_name'];
					$email 			= 	$records_user[0]['user_email'];
					$token 			= 	$this -> forget_send_code($mobile);
					$password 		= 	md5($token);
					$data['user_password'] = $password;
					$update_toekn 	= $this -> conn -> updatetablebyid('user', 'user_id', $user_id, $data);
					$user_email 	= $email;
					$subject = 'Forget Password of OyaCharge Login';
					$message= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>Untitled Document</title></head>

<body bgcolor="#f1f1f1">
<table cellpadding="0" cellspacing="0" width="600" style="background:#fff; border:1px solid #cbcbcb; margin:0 auto; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
	<thead class="header">
    	<tr>
        	<td style="background:#FFFFFF; height:62px; width:100%; padding:5px; border-bottom:1px solid #DDD;" valign="middle">
            	<a href="#" style="margin-left:10px;"><img width="100" src="'.mail_logo.'" alt="..."/></a>
                
            </td>
        </tr>
    </thead>
    <tbody style=" background:#FEFEFE; border-bottom:1px solid #ddd;">
    	<tr>
        	<td style="padding:10px 15px;">
            	<h1 style="margin-bottom:0px; color:#337d75;">OyaCharge </h1>
            	<p > Dear '.$name.', below is the new password as per request. 
</p>';
             $message .=  '<p>Username:<strong>' .$email;'</strong></p>';
              $message .=  '<p>Password:<strong>'.$token;'</strong></p></td></tr>';
          $message .= '<tr><td style="background:#ddd; height:1px; width:100%;"></td></tr></tbody>';
    
    $message .= '<tfoot style="background:#337d75; text-align:center; color:#fff;"><tr><td><p> Copyright © 2016 OyaCharge All right reserved </p></td><tr></tfoot></table></body></html>';
			
			$headers    = "Organization: OyaCharge\r\n";
  			$headers   .= "MIME-Version: 1.0\r\n";
		  	$headers   .= "Content-type: text/plain; charset=iso-8859-1\r\n";
		  	$headers   .= "X-Priority: 3\r\n";
		  	$headers   .= "X-Mailer: PHP". phpversion() ."\r\n" ;
          	$header 	= "From:blm.ypsilon@gmail.com \r\n";
         	$header    .= "Cc:blm.ypsilon@gmail.com \r\n";
         	$header    .= "MIME-Version: 1.0\r\n";
         	$header    .= "Content-type: text/html\r\n";
         //	$retval = mail ($to,$subject,$message,$header);
			$this->sendElasticEmail($email, $subject,"OyaCharge", $message, "care@oyacharge.com", "OyaCharge");
					$post = array('status' => "true", "message" => "New Password send to your mobile number and Registered Email");
				} else {
					$post = array('status' => "false", "message" => "Invalid Email OR Mobile No");
				}
			}
			echo $this -> json($post);
		} else {
			$post = array('status' => "false", "message" => "Please Enter Login ID", 'login_id' => $login_id);
			echo $this -> json($post);
		}
	}

	//wallet amount///

	function wallet_amount() {
		$user_id = $_REQUEST['user_id'];
		if (!empty($user_id)) {
			$records = $this -> conn -> get_table_row_byidvalue('user', 'user_id', $user_id);
			if (!empty($records)) {
				$user_id = $records['0']['user_id'];
				$wallet_amount = $records['0']['wallet_amount'];
				$total_sms = $records['0']['total_sms'];
				$get_sms = $records['0']['get_sms'];
				$biller_id = $records['0']['biller_id'];
				$biller_status = $records['0']['biller_status'];
				$post = array("status" => "true", "user_id" => $user_id, 'wallet_amount' => $wallet_amount, 'remaining_sms' => $total_sms, 'total_sms' => $get_sms, 'biller_status' => $biller_status, 'biller_id' => $biller_id);
			} else {
				$post = array('status' => "false", "message" => "Invalid user id", 'user_id' => $user_id);
			}

		} else {
			$post = array('status' => "false", "message" => "Missing parameter", 'user_id' => $user_id);
		}
		echo $this -> json($post);
	}

	///// User profile////
	function user_profile() {
		$user_id = $_REQUEST['user_id'];
		if (!empty($user_id)) {
			$records = $this -> conn -> get_table_row_byidvalue('user', 'user_id', $user_id);
			if (!empty($records)) {
				$user_id = $records['0']['user_id'];
				$user_name = $records['0']['user_name'];
				$user_email = $records['0']['user_email'];
				$user_contact_no = $records['0']['user_contact_no'];
				$login_type = $records['0']['user_login_type'];
				$profile_pic = $records['0']['user_profile_pic'];
				$self_reffer_code = $records['0']['user_refferal_code'];
				$wallet_amount = $records[0]['wallet_amount'];
				$pin_status = $records[0]['user_pin_status'];
				$get_sms = $records['0']['get_sms'];
				$total_sms = $records[0]['total_sms'];
				if (!empty($profile_pic)) {
					if (filter_var($profile_pic, FILTER_VALIDATE_URL)) {
						$img = $profile_pic;
					} else {
						$img = self_img_url . $profile_pic;
					}
				} else {
					$img = '';
				}
				$user_refferal_codel = $records['0']['user_refferal_code'];
				$post = array("status" => "true", "user_id" => $user_id, 'user_name' => $user_name, 'user_email' => $user_email, "user_contact_no" => $user_contact_no, 'user_login_type' => $login_type, 'wallet_amount' => $wallet_amount, 'profile_pic' => $img, 'total_sms' => $get_sms, 'remaining_sms' => $total_sms, 'user_pin_status' => $pin_status, 'reffer_code' => $self_reffer_code);
			} else {
				$post = array('status' => "false", "message" => "No user exist", 'user_id' => $user_id);
			}

		} else {
			$post = array('status' => "false", "message" => "Missing parameter", 'user_id' => $user_id);
		}
		echo $this -> json($post);
	}

	// Change Password...
	function change_password() {
		$user_id = $_POST['user_id'];
		$old_password = $_POST['old_password'];
		$new_password = $_POST['new_password'];
		if (!empty($user_id)) {
			$records = $this -> conn -> get_table_row_byidvalue('user', 'user_id', $user_id);
			$old_user_password = $records['0']['user_password'];
			$old_password = md5($old_password);
			if ($old_password == $old_user_password) 
			{
				$data['user_password'] = md5($new_password);
				$update_toekn = $this -> conn -> updatetablebyid('user', 'user_id', $user_id, $data);
				$post = array('status' => "true", "message" => "Password changed successfully", 'user_id' => $user_id);
			} else {
				$post = array('status' => "false", "message" => "Invalid Old password", 'user_id' => $user_id);
				echo $this -> json($post);
				exit();
			}
		} else {
			$post = array('status' => "false", "message" => "Missing parameter", 'user_id' => $user_id);
		}
		echo $this -> json($post);

	}

	////Edit profile/////

	function edit_profile() {
		$user_id = $_POST['user_id'];
		if (!empty($user_id)) {

			$user_name = $_POST['user_name'];
			if (!empty($user_name)) {
				$data['user_name'] = $user_name;
			}
			$user_email = $_REQUEST['user_email'];
			if (!empty($user_email)) {
				$records_user = $this -> conn -> get_table_field_doubles_not('user', 'user_email', $user_email,'user_id',$user_id);
				if(empty($records_user)){
					$data['user_email'] = $user_email;
				}else{
					$post = array('status' => "false", "message" => "This email is already registered", 'user_email' => $user_email);
						echo $this -> json($post);
					exit();
				}
				
			}

			$new_password = $_POST['new_password'];
			$old_password = $_POST['old_password'];

			$array  = array_map('intval', str_split($new_password));

			$isSequence = $this->is_arithmetic($array);

			if( $isSequence != true){
				$post = array('status' => "false", "message" => 'New password shoud not be a sequence.');
				echo $this -> json($post); exit;	

			}


			
			if (!empty($new_password) && !empty($old_password)) {
				$records = $this -> conn -> get_table_row_byidvalue('user', 'user_id', $user_id);
				$old_user_password = $records['0']['user_password'];

				$old_password = md5($old_password);
				if ($old_password == $old_user_password) {
					$data['user_password'] = md5($new_password);
				} else {
					$post = array('status' => "false", "message" => "Invalid Old password", 'user_id' => $user_id);
					echo $this -> json($post);
					exit();
				}
			}

			$user_image = '';
			if ($_FILES['self_img']['name']) {
				$user_image = $_FILES['self_img']['name'];
			}
			$attachment = $_FILES['self_img']['name'];

			if (!empty($attachment)) {
				$file_extension = explode(".", $_FILES["self_img"]["name"]);
				$new_extension = strtolower(end($file_extension));
				$today = time();
				$custom_name = "self_img" . $today;
				$file_name = $custom_name . "." . $new_extension;

				if ($new_extension == 'png' || $new_extension == 'jpeg' || $new_extension == 'jpg' || $new_extension == 'bmp') {
					move_uploaded_file($_FILES['self_img']['tmp_name'], "../uploads/self_img/" . $file_name);

				}

			}

			if (!empty($file_name)) {
				$data['user_profile_pic'] = $file_name;
			}

			$update_toekn = $this -> conn -> updatetablebyid('user', 'user_id', $user_id, $data);
			$records_user = $this -> conn -> get_table_row_byidvalue('user', 'user_id', $user_id);
			$name = $records_user['0']['user_name'];
			$email = $records_user['0']['user_email'];
			$user_login_type = $records_user['0']['user_login_type'];
			$profile_pic = $records_user['0']['user_profile_pic'];
			if($user_login_type=='1')
			{
				$image = self_img_url . $profile_pic;
			}else if($user_login_type!='1'){
				$image=$profile_pic;
			}else{
				$image = '';
			}
			$post = array('status' => "true", "message" => "Profile Update Successfully", 'user_id' => $user_id, 'user_name' => $name, 'user_email' => $email, 'user_id' => $user_id, 'user_profile_pic' => $image);

		} else {
			$post = array('status' => "false", "message" => "Missing parameter", 'user_id' => $user_id);
		}
		echo $this -> json($post);
	}

	///Check_old_password///
	function check_old_password() {
		$user_id = $_REQUEST['user_id'];
		$old_password = $_REQUEST['old_password'];
		$pass = md5($_REQUEST['old_password']);
		$records_user = $this -> conn -> get_table_field_doubles('user', 'user_id', $user_id, 'user_password', $pass);
		if (empty($records_user)) {
			$post = array('status' => "false", "message" => "Invalid old password");
		} else {
			$post = array('status' => "true");
		}
		echo $this -> json($post);
	}

	/// Recharge plan ///////
	function recharge_plan() {
		$operator_id = $_REQUEST['operator_id'];
		$plan_id = $_REQUEST['plan_category_id'];
		if (!empty($operator_id)) {
		$records_plan = $this -> conn -> join_four_table_new_with_two_field('recharge_plan', 'operator_list', 'recharge_category', 'plan_category', 'recharge_operator_id', 'operator_id', 'recharge_category_id', 'recharge_category_id', 'plan_category_id', 'plan_category_id', 'recharge_operator_id', $operator_id, 'recharge_plan`.' . '`plan_category_id', $plan_id, 'rechage_amount');
		if (!empty($records_plan)) {
				foreach ($records_plan as $v) {
					$recharge_category_id = $v['recharge_category_id'];
					$plan_category_id = $v['plan_category_id'];

					$plan_category_name = $v['plan_category_name'];
					$category_name = $v['category_name'];
					$operator_name = $v['operator_name'];
					$recharge_amount = $v['rechage_amount'];
					$recharge_data_pack = $v['recharge_data_pack'];
					$recharge_activation_code = $v['recharge_activation_code'];
					$recharge_talktime = $v['recharge_talktime'];
					$recharge_validity = $v['recharge_validity'];
					$recharge_desc = strip_tags(html_entity_decode($v['recharge_desc'], ENT_QUOTES, 'UTF-8'));
					$arr[] = array('recharge_category_id' => $recharge_category_id, 'category_name' => $category_name, 'plan_category_id' => $plan_category_id, 'plan_category_name' => $plan_category_name, 'operator_name' => $operator_name, 'recharge_amount' => $recharge_amount, 'recharge_data_pack' => $recharge_data_pack, 'recharge_talktime' => $recharge_talktime, 'recharge_validity' => $recharge_validity, 'recharge_desc' => $recharge_desc, 'recharge_activation_code' => $recharge_activation_code);
				}
				$post = array('status' => "true", "recharge_details" => $arr);
			} else {
				$post = array('status' => "false", "message" => "No Data Avalible");
			}
		} else {
			$post = array('status' => "false", 'message' => 'missing parameter', 'operator_id' => $operator_id);
		}
		echo $this -> json($post);
	}

	// repeat recharge///
	//plan category listing

function plan_category_listing() {
		$operator_id = $_REQUEST['operator_id'];
		$recharge_category = $_REQUEST['recharge_category'];
		//1 mobile, 2-dth
		if (!empty($recharge_category)) {
			$records = $this -> conn -> get_table_field_doubles('plan_category', 'plan_recharge_category_id', $recharge_category, 'plan_category_status', 1);
			$plan_category_id_default = $records[0]['plan_category_id'];
			foreach ($records as $v) {
				$plan_category_id = $v['plan_category_id'];
				$plan_cat_id[] = $v['plan_category_id'];
				$plan_category_name = $v['plan_category_name'];
				$arr[] = array('plan_category_id' => $plan_category_id, 'plan_category_name' => $plan_category_name);
			}
			//print_r($plan_cat_id);die;
for($m=0;$m<count($plan_cat_id);$m++){
	$records_plan = $this -> conn -> join_four_table_new_with_three_field('recharge_plan', 'operator_list', 'recharge_category', 'plan_category', 'recharge_operator_id', 'operator_id', 'recharge_category_id', 'recharge_category_id', 'plan_category_id', 'plan_category_id', 'recharge_plan`.' . '`plan_category_id', $plan_cat_id[$m], 'recharge_operator_id', $operator_id, 'recharge_plan`.' . '`recharge_category_id', $recharge_category, 'rechage_amount');
			foreach ($records_plan as $v) {
				$recharge_category_id = $v['recharge_category_id'];
				$plan_category_id = $v['plan_category_id'];

				$plan_category_name = $v['plan_category_name'];
				$category_name = $v['category_name'];
				$operator_name = $v['operator_name'];
				$recharge_amount = $v['rechage_amount'];
				$recharge_data_pack = $v['recharge_data_pack'];
				$recharge_activation_code = $v['recharge_activation_code'];
				$recharge_talktime = $v['recharge_talktime'];
				$recharge_dth_channel = $v['recharge_dth_channel'];
				$recharge_validity = $v['recharge_validity'];
				$recharge_desc = strip_tags(html_entity_decode($v['recharge_desc'], ENT_QUOTES, 'UTF-8'));

				$arr111[] = array('recharge_category_id' => $recharge_category_id, 'category_name' => $category_name, 'plan_category_id' => $plan_category_id, 'plan_category_name' => $plan_category_name, 'operator_name' => $operator_name, 'recharge_amount' => $recharge_amount, 'recharge_data_pack' => $recharge_data_pack, 'recharge_talktime' => $recharge_talktime, 'recharge_validity' => $recharge_validity, 'dth_channel' => $recharge_dth_channel, 'recharge_desc' => $recharge_desc, 'recharge_activation_code' => $recharge_activation_code, 'default_plan_category' => $plan_category_id_default);
			}
$post = array('status' => "true", "plan_category" => $arr, "recharge_details" => $arr111);
			}
			
			

		} else {
			$post = array('status' => "false", 'message' => 'missing parameter', 'recharge_category' => $recharge_category);
		}
		echo $this -> json($post);
	}

	function repeat_recharge() {
		$wt_id = $_REQUEST['wt_id'];
		$rec_id = $_REQUEST['rec_id'];
		$wt_category_id = $_REQUEST['wt_category_id'];
		if (!empty($wt_id)) {
			if ($wt_category_id == '2') {
				$transaction = $this -> conn -> join_three_table_leftjoin_where_new('wallet_transaction', 'recharge', 'operator_list', 'transaction_id', 'recharge_transaction_id', 'operator_id', 'operator_id', 'wt_id', $wt_id);
			}
			if ($wt_category_id == '1') {
				$transaction = $this -> conn -> get_table_row_byidvalue('wallet_transaction', 'wt_id', $wt_id);
			}

			$operator_id = $transaction['0']['operator_id'];
			if (!empty($operator_id)) {
				$operator_id = $operator_id;
			} else {
				$operator_id = '';
			}
			$operator_name = $transaction['0']['operator_name'];
			$operator_image = $transaction['0']['operator_image'];
			if (!empty($operator_name)) {
				$operator_name = $operator_name;
			} else {
				$operator_name = '';
			}
			$wallet_amount = $transaction['0']['wt_amount'];
			$recharge_number = $transaction['0']['recharge_number'];
			$recharge_amount = $transaction['0']['recharge_amount'];
			if (!empty($recharge_number)) {
				$recharge_number = $recharge_number;
			} else {
				$recharge_number = '';
			}
			$wt_category_id = $transaction['0']['wt_category'];
			$rec_category_id = $transaction['0']['recharge_category'];
			$wt_user_id = $transaction['0']['wt_user_id'];
			$post = array('status' => "true", 'operator_id' => $operator_id, 'operataor_name' => $operator_name, 'wallet_amount' => $wallet_amount, 'recharge_number' => $recharge_number, 'wt_category_id' => $recharge_category_id, 'user_id' => $wt_user_id, 'rec_category_id' => $rec_category_id, 'operator_image' => $operator_image, 'recharge_amount' => $recharge_amount);
		} else {
			$post = array('status' => "false", 'message' => 'missing parameter', 'wt_id' => $wt_id);
		}
		echo $this -> json($post);
	}

	//// transaction history////
	function transaction_history() {
		$user_id = $_REQUEST['user_id'];
		$wallet_category = $_REQUEST['wt_category'];
		$recharge_status = $_REQUEST['status'];
		if (!empty($user_id)) {

			$records = $this -> conn -> get_table_row_byidvalue_order('wallet_transaction', 'wt_user_id', $user_id, 'wt_datetime', 'wt_category');

			if (!empty($records)) {
				if (empty($wallet_category)) {
					$arr=array();
					$arr2=array();
					foreach ($records as $values) {

						$wt_category = $values['wt_category'];
						if ($wt_category == '1') {
							//echo "string";
							$transaction = $this -> conn -> get_table_field_doubles_order('wallet_transaction', 'wt_category', $wt_category, 'wt_user_id', $user_id, 'wt_id');

							//	$transaction = $this -> conn -> get_table_row_byidvalue('wallet_transaction', 'wt_category', $wt_category);
						} else if ($wt_category == '2') {

							$transaction = $this -> conn -> join_three_table_leftjoin('wallet_transaction', 'recharge', 'operator_list', 'transaction_id', 'recharge_transaction_id', 'operator_id', 'operator_id', 'wt_user_id', $user_id, 'wt_id');
						} else if ($wt_category == '3') {// refund

							$transaction = $this -> conn -> get_table_field_doubles_order('wallet_transaction', 'wt_category', $wt_category, 'wt_user_id', $user_id, 'wt_id');
						} else if ($wt_category == '4') {
							//echo "string";
							$transaction = $this -> conn -> get_table_field_doubles_order('wallet_transaction', 'wt_category', $wt_category, 'wt_user_id', $user_id, 'wt_id');
						} else if ($wt_category == '5') {
							//echo "string";
							$transaction = $this -> conn -> get_table_field_doubles_order('wallet_transaction', 'wt_category', $wt_category, 'wt_user_id', $user_id, 'wt_id');
						} else if ($wt_category == '6') {
							//echo "string";
							$transaction = $this -> conn -> get_table_field_doubles_order('wallet_transaction', 'wt_category', $wt_category, 'wt_user_id', $user_id, 'wt_id');
						} else if ($wt_category == '7') {
							//echo "string";
							$transaction = $this -> conn -> get_table_field_doubles_order('wallet_transaction', 'wt_category', $wt_category, 'wt_user_id', $user_id, 'wt_id');
						} else if ($wt_category == '8') {
							//echo "string";
							$transaction = $this -> conn -> get_table_field_doubles_order('wallet_transaction', 'wt_category', $wt_category, 'wt_user_id', $user_id, 'wt_id');
						} else if ($wt_category == '9') {
							//echo "string";
							$transaction = $this -> conn -> get_table_field_doubles_order('wallet_transaction', 'wt_category', $wt_category, 'wt_user_id', $user_id, 'wt_id');
						} else if ($wt_category == '10') {
							//echo "string";
							$transaction = $this -> conn -> get_table_field_doubles_order('wallet_transaction', 'wt_category', $wt_category, 'wt_user_id', $user_id, 'wt_id');
						} else if ($wt_category == '11') {
							$transaction = $this -> conn -> join_four_table('wallet_transaction', 'bill_recharge', 'biller_details', 'biller_user', 'transaction_id', 'bill_transaction_id', 'biller_id', 'biller_id', 'biller_customer_id_no', 'bill_consumer_no', 'wt_user_id', $user_id, 'wt_id');

						} else if ($wt_category == '12') {
							//echo "string";
							$transaction = $this -> conn -> join_three_table_leftjoin('wallet_transaction', 'recharge', 'operator_list', 'transaction_id', 'recharge_transaction_id', 'operator_id', 'operator_id', 'wt_user_id', $user_id, 'wt_id');
						} else if ($wt_category == '13') {
							//echo "string";
							$transaction = $this -> conn -> join_four_table_leftjoin('wallet_transaction', 'church_donate', 'church_list','church_area', 'transaction_id', 'transaction_id', 'church_id', 'donate_church_id','church_id','church_id', 'wt_user_id', $user_id, 'wt_id', 'wt_id');
						}else if ($wt_category == '15') {// refund

							$transaction = $this -> conn -> get_table_field_doubles_order('wallet_transaction', 'wt_category', $wt_category, 'wt_user_id', $user_id, 'wt_id');
						}else if ($wt_category == '16') {// refund

							$transaction = $this -> conn -> join_three_table_leftjoin('wallet_transaction', 'booking_event_tickets', 'event_list', 'transaction_id', 'transaction_id', 'event_id', 'booking_event_id', 'wt_user_id', $user_id, 'wt_id');
						}
//print_r($transaction);
						foreach ($transaction as $v) {
						
							$transaction_mobile_number = $v['recharge_number'];
							//$transaction_mobile_number = substr($transaction_mobile_number, 4);
							$event_id 			= 	$v['event_id'];
							$event_name 		= 	$v['event_name'];
							$event_image		=	event_image.$v['event_image'];
							$booking_event_tickets_id=$v['booking_event_tickets_id'];
							if(empty($event_id))
							{
								$event_id		=	"";
								$event_name		=	"";
								$event_image	=	"";
								$booking_event_tickets_id='';
							}
							$trans_ref_no		=	$v['trans_ref_no'];
							$cashback_mobile_number = $v['cashbackrecord_id'];
							$consumer_id = $v['bill_consumer_no'];
							$consumer_name = $v['biller_user_name'];
							$biller_company = $v['biller_company_name'];
							$biller_company_logo = $v['biller_company_logo'];
						 	$transaction_type = $v['wt_category'];
							/*
							if(!empty($biller_company_logo))
														{
															$biller_company_logo=biller_company_logo.$v['biller_company_logo'];
														}else{
															$biller_company_logo="";
														}*/
							
							$cashback_record = $cashback_mobile_number;
							if (!empty($consumer_id)) {
								$consumer_id = $consumer_id;
								$consumer_name = $consumer_name;
								$biller_company = $biller_company;
							} else {
								$consumer_id = '';
								$consumer_name = '';
								$biller_company = '';
							}

							if (!empty($cashback_record)) {
								$cashback_record = $cashback_record;
							} else {
								$cashback_record = '';
							}
							if (!empty($transaction_mobile_number)) {
								$number = $transaction_mobile_number;
							} else {
								$number = $cashback_record;
							}
							$payment_gateway_id = $v['payment_gateway_id'];
							if(!empty($payment_gateway_id))
							{
								$transaction_id=$payment_gateway_id;
							}else{
								$transaction_id = $v['transaction_id'];
							}
					
	if($transaction_type ==5 || $transaction_type==3 || $transaction_type==1)
	{
			
		$operator_image='';
		
		
	}else{
		
							if (!empty($v['operator_image'])) {
								$operator_image = operator_img_url . $v['operator_image'];
							} else if(!empty($v['church_img']))
							{
								$operator_image=church_image.$v['church_img'];
							}else if(!empty($biller_company_logo))
							{
								$operator_image=biller_company_logo.$v['biller_company_logo'];
							}else if(!empty($v['event_image']))
							{
								
								$operator_image=event_image.$v['event_image'];
							}
							}

							if (!empty($v['operator_name'])) {
								$operator = $v['operator_name'];
							} else {
								$operator = '';
							}
							$operator_id = $v['operator_id'];
							if (!empty($operator_id)) {
								$operator_id = $operator_id;
							} else {
								$operator_id = '';
							}
							$recharge_category = $v['rechage_category'];
							if (!empty($recharge_category)) {
								$recharge_category = $recharge_category;
							} else {
								$recharge_category = '';
							}
							$p_type = $v['payment_type'];
							if($p_type=='0')
							{
								$pay_type="OyaCash";
							}else if($p_type=='1')
							{
								$pay_type="Moneywave";
							}
							$transaction_amount = $v['wt_amount'];
							$transaction_date = $v['wt_datetime'];
							
							$electrice_token_no = $v['electrice_token_no'];
							$transaction_status = $v['wt_status'];
							$transaction_desc =  str_replace("%20"," ",$v['wt_desc']);
							$card_no = $v['wt_card_no'];
							if ($transaction_status == '1') {
								if ($transaction_type == '1') {
									$transaction_desc = "Amount has been added to your wallet";
								} else if ($transaction_type == '2') {
									if ($recharge_category == '1') {
										$transaction_desc = "Mobile Recharge has been successfully done";
									} else if ($recharge_category == '2') {
										$transaction_desc = "TV,DTH Recharge has been successfully done";
									} else if ($recharge_category == '3') {
										$transaction_desc = "Data Card Recharge has been successfully done";
									}

								} else if ($transaction_type == '4') {
									$transaction_desc = "Cashback is Recieved on Recharge of " . $cashback_record;
								} else if ($transaction_type == '5') {
									$transaction_desc = $transaction_desc;
								} else if ($transaction_type == '6') {
									$transaction_desc = $transaction_desc;
								} else if ($transaction_type == '7') {
									$transaction_desc = $transaction_desc;
								} else if ($transaction_type == '8') {
									$transaction_desc = $transaction_desc;
								} else if ($transaction_type == '9') {
									$transaction_desc = $transaction_desc;
								} else if ($transaction_type == '10') {
									$transaction_desc = $transaction_desc;
								} else if ($transaction_type == '11') {
									$transaction_desc = $transaction_desc;
								} else if ($transaction_type == '12') {
									$transaction_desc = $transaction_desc;
								} else if ($transaction_type == '13') {
									 $church_name = $v['church_name'];
									if(!empty($church_name)){
										$church_name=$church_name;
									}else{
										$church_name='';
									}
									$church_img=$v['church_img'];
									if(!empty($church_img)){
										$church_img=$church_img;
									}else{
										$church_img='';
									}
									
									
									$transaction_desc = $transaction_desc;
								}else if ($transaction_type == '15') {
									$transaction_desc = $transaction_desc;
								} else if ($transaction_type == '16') {
									$transaction_desc = $transaction_desc;
								} 
							} else if ($transaction_status == '3') {
								if ($transaction_type == '1') {
									$transaction_desc = $transaction_desc;
								} else if ($transaction_type == '2') {
									$transaction_desc = $transaction_desc;
								}else if ($transaction_type == '13') {
									 $church_name = $v['church_name'];
									  $operator = $v['church_area'];
									if(!empty($church_name)){
										$church_name=$church_name;
									}else{
										$church_name='';
									
									}
									/*
									$church_img=$v['church_img'];
																		if(!empty($church_img)){
																			$church_img=$church_img;
																		}else{
																			$church_img='';
																		}*/
									
									
									
									$transaction_desc = $transaction_desc;
								}
							}
							if(empty($church_name))
							{
								$church_name='';
							}if(empty($church_img))
							{
								$church_img='';
							}
							if(!empty($v['church_area']))
							{
								$church_area=$v['church_area'];
							}else{
								$church_area='';
							}
							$arr[] = array('wt_id' => $v['wt_id'], 'transction_date' => date('F-d-Y h:i A',strtotime($transaction_date)), 'mobile_number' => $number, 'transaction_number' => $transaction_id, 'operator_id' => $operator_id, 'operator_name' => $operator, 'recharge_amount' => $transaction_amount, 'transaction_type' => $transaction_type, 'transaction_desc' => $transaction_desc, 'transaction_status' => $transaction_status, 'recharge_category' => $recharge_category, 'wt_category' => $wt_category, 'cashback_recharge_number' => $cashback_record, 'operator_image' => $operator_image, 'consumer_no' => $consumer_id, 'consumer_name' => $consumer_name, 'biller_company' => $biller_company,'church_name'=>$church_name,'church_image'=>$church_img,'wt_category'=>$transaction_type,'electrice_token_no'=>$electrice_token_no,'pay_type'=>$pay_type,'biller_company_logo'=>$biller_company_logo,'event_id'=>$event_id,'event_name'=>$event_name,'event_image'=>$event_image,'booking_event_tickets_id'=>$booking_event_tickets_id,'trans_ref_no'=>$trans_ref_no,'church_area'=>$church_area);

						}

					}

					//	arsort($arr);
$data1=$arr;
				//	$arr2 = array_values($arr);
foreach ($data1 as $key => $row22) {
   $date2[$key] = $row22['wt_id'];
}
array_multisort($date2, SORT_DESC, $data1);

foreach($data1 as $k => $v)
{
   foreach($data1 as $key => $value)
   {
       if($k != $key && $v['wt_id'] == $value['wt_id'])
       {
            unset($data1[$k]);
       }
   }
}

foreach ($data1 as $key) {
$data2[] = $key;
}
					// print_r($arr2);
					// echo json_encode($arr);
					// die;
					$post = array('status' => "true", "transaction_details" => $data2);
					echo $this -> json($post);
					exit();

				} else {
					if ($wallet_category == '1') {

						$transaction = $this -> conn -> get_table_field_doubles_order('wallet_transaction', 'wt_category', $wallet_category, 'wt_user_id', $user_id, 'wt_id');

						//	$transaction = $this -> conn -> get_table_row_byidvalue('wallet_transaction', 'wt_category', $wt_category);
					} else if ($wallet_category == '2') {

						$transaction = $this -> conn -> join_three_table_leftjoin_where_two_field('wallet_transaction', 'recharge', 'operator_list', 'transaction_id', 'recharge_transaction_id', 'operator_id', 'operator_id', 'wt_user_id', $user_id, 'wt_category', $wallet_category, 'wt_id');
					} else if ($wallet_category == '3') {// refund

						$transaction = $this -> conn -> get_table_field_doubles_order('wallet_transaction', 'wt_category', $wallet_category, 'wt_user_id', $user_id, 'wt_id');
					} else if ($wallet_category == '4') {// cash back

						$transaction = $this -> conn -> get_table_field_doubles_order('wallet_transaction', 'wt_category', $wallet_category, 'wt_user_id', $user_id, 'wt_id');
					} else if ($wallet_category == '5') {// transfer money

						$transaction = $this -> conn -> get_table_field_doubles_order('wallet_transaction', 'wt_category', $wallet_category, 'wt_user_id', $user_id, 'wt_id');
					} else if ($wallet_category == '7') {// add sms

						$transaction = $this -> conn -> get_table_field_doubles_order('wallet_transaction', 'wt_category', $wallet_category, 'wt_user_id', $user_id, 'wt_id');
					} else if ($wallet_category == '8') {// share sms

						$transaction = $this -> conn -> get_table_field_doubles_order('wallet_transaction', 'wt_category', $wallet_category, 'wt_user_id', $user_id, 'wt_id');
					} else if ($wallet_category == '9') {
						//echo "string";
						$transaction = $this -> conn -> get_table_field_doubles_order('wallet_transaction', 'wt_category', $wt_category, 'wt_user_id', $user_id, 'wt_id');
					} else if ($wallet_category == '10') {
						//echo "string";
						$transaction = $this -> conn -> get_table_field_doubles_order('wallet_transaction', 'wt_category', $wt_category, 'wt_user_id', $user_id, 'wt_id');
					} else if ($wallet_category == '11') {

						$transaction = $this -> conn -> join_four_table('wallet_transaction', 'bill_recharge', 'biller_details', 'biller_user', 'transaction_id', 'bill_transaction_id', 'biller_id', 'biller_id', 'biller_customer_id_no', 'bill_consumer_no', 'wt_user_id', $user_id, 'wt_id');

					} else if ($wallet_category == '12') {
						//echo "string";
						$transaction = $this -> conn -> join_three_table_leftjoin_where_two_field('wallet_transaction', 'recharge', 'operator_list', 'transaction_id', 'recharge_transaction_id', 'operator_id', 'operator_id', 'wt_user_id', $user_id, 'wt_category', $wallet_category, 'wt_id');
					}else if ($wt_category == '13') {
							//echo "string";
							$transaction = $this -> conn -> join_three_table_leftjoin('wallet_transaction', 'church_donate', 'church_list', 'transaction_id', 'transaction_id', 'church_id', 'donate_church_id', 'wt_user_id', $user_id, 'wt_id');
						}else if ($wt_category == '15') {// refund

							$transaction = $this -> conn -> get_table_field_doubles_order('wallet_transaction', 'wt_category', $wt_category, 'wt_user_id', $user_id, 'wt_id');
						}

				foreach ($transaction as $v) {
//print_r($v);die;
							$transaction_mobile_number = $v['recharge_number'];
							//$transaction_mobile_number = substr($transaction_mobile_number, 4);

							$cashback_mobile_number = $v['cashbackrecord_id'];
							$consumer_id = $v['bill_consumer_no'];
							$consumer_name = $v['biller_user_name'];
							$biller_company = $v['biller_company_name'];
							$biller_company_logo = $v['biller_company_logo'];
							if(!empty($biller_company_logo))
							{
								$biller_company_logo=biller_company_logo.$v['biller_company_logo'];
							}else{
								$biller_company_logo="";
							}
							$cashback_record = $cashback_mobile_number;
							if (!empty($consumer_id)) {
								$consumer_id = $consumer_id;
								$consumer_name = $consumer_name;
								$biller_company = $biller_company;
							} else {
								$consumer_id = '';
								$consumer_name = '';
								$biller_company = '';
							}

							if (!empty($cashback_record)) {
								$cashback_record = $cashback_record;
							} else {
								$cashback_record = '';
							}
							if (!empty($transaction_mobile_number)) {
								$number = $transaction_mobile_number;
							} else {
								$number = $cashback_record;
							}
							$transaction_id = $v['transaction_id'];
							$operator_name = $v['operator_name'];
							if (!empty($v['operator_image'])) {
								$operator_image = operator_img_url . $v['operator_image'];
							} else {
								$operator_image = '';
							}

							if (!empty($operator_name)) {
								$operator = $operator_name;
							} else {
								$operator = '';
							}
							$operator_id = $v['operator_id'];
							if (!empty($operator_id)) {
								$operator_id = $operator_id;
							} else {
								$operator_id = '';
							}
							$recharge_category = $v['rechage_category'];
							if (!empty($recharge_category)) {
								$recharge_category = $recharge_category;
							} else {
								$recharge_category = '';
							}
							$p_type = $v['payment_type'];
							if($p_type=='0')
							{
								$pay_type="OyaCash";
							}else if($p_type=='1')
							{
								$pay_type="Kongapay";
							}else if($p_type=='2')
							{
								$pay_type="Interswitch";
							}
							$transaction_amount = $v['wt_amount'];
							$transaction_date = $v['wt_datetime'];
							$transaction_type = $v['wt_category'];
							$electrice_token_no = $v['electrice_token_no'];
							$transaction_status = $v['wt_status'];
							$transaction_desc =  str_replace("%20"," ",$v['wt_desc']);
							$card_no = $v['wt_card_no'];
							if ($transaction_status == '1') {
								if ($transaction_type == '1') {
									$transaction_desc = "Amount has been added to your wallet";
								} else if ($transaction_type == '2') {
									if ($recharge_category == '1') {
										$transaction_desc = "Mobile Recharge has been successfully done";
									} else if ($recharge_category == '2') {
										$transaction_desc = "TV,DTH Recharge has been successfully done";
									} else if ($recharge_category == '3') {
										$transaction_desc = "Data Card Recharge has been successfully done";
									}

								} else if ($transaction_type == '4') {
									$transaction_desc = "Cashback is Recieved on Recharge of " . $cashback_record;
								} else if ($transaction_type == '5') {
									$transaction_desc = $transaction_desc;
								} else if ($transaction_type == '6') {
									$transaction_desc = $transaction_desc;
								} else if ($transaction_type == '7') {
									$transaction_desc = $transaction_desc;
								} else if ($transaction_type == '8') {
									$transaction_desc = $transaction_desc;
								} else if ($transaction_type == '9') {
									$transaction_desc = $transaction_desc;
								} else if ($transaction_type == '10') {
									$transaction_desc = $transaction_desc;
								} else if ($transaction_type == '11') {
									$transaction_desc = $transaction_desc;
								} else if ($transaction_type == '12') {
									$transaction_desc = $transaction_desc;
								} else if ($transaction_type == '13') {
									 $church_name = $v['church_name'];
									if(!empty($church_name)){
										$church_name=$church_name;
									}else{
										$church_name='';
									}
									$church_img=$v['church_img'];
									if(!empty($church_img)){
										$church_img=$church_img;
									}else{
										$church_img='';
									}
									
									
									$transaction_desc = $transaction_desc;
								}else if ($transaction_type == '15') {
									$transaction_desc = $transaction_desc;
								} 
							} else if ($transaction_status == '3') {
								if ($transaction_type == '1') {
									$transaction_desc = $transaction_desc;
								} else if ($transaction_type == '2') {
									$transaction_desc = $transaction_desc;
								}else if ($transaction_type == '13') {
									 $church_name = $v['church_name'];
									if(!empty($church_name)){
										$church_name=$church_name;
									}else{
										$church_name='';
									}
									$church_img=$v['church_img'];
									if(!empty($church_img)){
										$church_img=$church_img;
									}else{
										$church_img='';
									}
									
									
									$transaction_desc = $transaction_desc;
								}
							}
							
							$arr[] = array('wt_id' => $v['wt_id'], 'transction_date' => $transaction_date, 'mobile_number' => $number, 'transaction_number' => $transaction_id, 'operator_id' => $operator_id, 'operator_name' => $operator, 'recharge_amount' => $transaction_amount, 'transaction_type' => $transaction_type, 'transaction_desc' => $transaction_desc, 'transaction_status' => $transaction_status, 'recharge_category' => $recharge_category, 'wt_category' => $wt_category, 'card_no' => $card_no, 'cashback_recharge_number' => $cashback_record, 'operator_image' => $operator_image, 'consumer_no' => $consumer_id, 'consumer_name' => $consumer_name, 'biller_company' => $biller_company,'church_name'=>$church_name,'church_image'=>$church_img,'wt_category'=>$transaction_type,'electrice_token_no'=>$electrice_token_no,'pay_type'=>$pay_type,'biller_company_logo'=>$biller_company_logo);

						}
				}

			$data1=$arr;
				//	$arr2 = array_values($arr);
foreach ($data1 as $key => $row22) {
   $date2[$key] = $row22['wt_id'];
}
array_multisort($date2, SORT_DESC, $data1);

foreach($data1 as $k => $v)
{
   foreach($data1 as $key => $value)
   {
       if($k != $key && $v['wt_id'] == $value['wt_id'])
       {
            unset($data1[$k]);
       }
   }
}

foreach ($data1 as $key) {
$data2[] = $key;
}

				if (!empty($data2)) {
					$post = array('status' => "true", "transaction_details" => $data2);
				} else {
					$post = array('status' => "false", "message" => 'No Record Found');
				}

			} else {
				$post = array('status' => "false", "message" => "NO Transaction Record Found", 'user_id' => $user_id);
			}
		} else {
			$post = array('status' => "false", "message" => "Missing parameter", 'user_id' => $user_id);
		}
		echo $this -> json($post);
	}

	///Send OTP///
	function send_otp() {
		$user_id = $_REQUEST['user_id'];
		$user_mobile = $_REQUEST['mb_number'];
		if (!empty($user_mobile)) {
			$records_user = $this -> conn -> get_table_field_doubles('user', 'user_contact_no', $user_mobile, 'user_mobile_verify_status', 1);
			if (empty($records_user)) {
				$token = $this -> send_code($user_mobile);
				$data['user_contact_no'] = $user_mobile;
				$data['user_verified_code'] = $token;
				$update_toekn = $this -> conn -> updatetablebyid('user', 'user_id', $user_id, $data);
				$post = array('status' => "true", "message" => "OTP Send  to your Number", 'user_mobile_no' => $user_mobile);
			} else {
				$post = array('status' => "false", "message" => "This Number are already registered", 'user_mobile_no' => $user_mobile);
			}
		} else {
			$post = array('status' => "false", "message" => "Please Enter a Number with country Code", 'user_mobile_no' => $user_mobile);
		}
		echo $this -> json($post);
	}

	///// Resend OTP//////
	function resend() {
		$mobile =  $_POST['user_mobile_no'];
		if (!empty($mobile)) {
			$records = $this -> conn -> get_table_row_byidvalue('user', 'user_contact_no', $mobile);
			$user_id = $records['0']['user_id'];
			$token = $this -> send_code($mobile);
			$data['user_verified_code'] = $token;
			$update_toekn = $this -> conn -> updatetablebyid('user', 'user_id', $user_id, $data);
			$post = array("status" => "true", "message" => "OTP sent to the registered number", 'token' => $token, 'mobile' => $mobile);

		} else {
			$post = array('status' => "false", "message" => "Missing parameter", 'user_mobile_no' => $mobile);
		}
		echo $this -> json($post);
	}

	///// operator list- Idea, Airtrl, TV//////
	function operator_list() {

		$recharge_category_id = $_REQUEST['recharge_category_id'];
		if (!empty($recharge_category_id)) {
			$category = $this -> conn -> get_table_field_doubles('operator_list', 'operator_status', 1, 'recharge_category_id', $recharge_category_id);

			foreach ($category as $key => $value) {

				$name = $value['operator_name'];
				$category_id = $value['operator_id'];
				$category_code = $value['operator_code'];
				$operator_image = operator_img_url . $value['operator_image'];
				$response[] = array('operator_id' => $category_id, 'operator_name' => $name, 'operator_image' => $operator_image,'operator_code'=>$category_code);
			}

			if (!empty($response)) {
				$post = array("status" => "true", 'recharge_category_id' => $recharge_category_id, "operator_list" => $response);
			} else {
				$post = array('status' => "false", 'recharge_category_id' => $recharge_category_id, "operator" => "No Record Found");
			}

		} else {
			$post = array('status' => "false", "message" => "Missing parameter", 'recharge_category_id' => $recharge_category_id);
		}
		echo $this -> json($post);
	}

	///// recharge category 1-Mobile, 2-TV, 3-DTH//////
	function recharge_category() {

		$category = $this -> conn -> get_table_row_byidvalue('recharge_category', 'category_status', 1);
		foreach ($category as $key => $value) {

			$name = $value['category_name'];
			$category_id = $value['recharge_category_id'];

			$response[] = array('recharge_category_id' => $category_id, 'category_name' => $name);
		}
		if (!empty($response)) {
			$post = array("status" => "true", "message" => $response);
		} else {
			$post = array('status' => "false", "message" => "No Record Found");
		}

		echo $this -> json($post);
	}

	///// recharge recharge_type 1-Top up, 2-Special//////
	function recharge_type() {
		$recharge_category_id = $_POST['recharge_category_id'];
		if (!empty($recharge_category_id)) {
			$category = $this -> conn -> get_table_field_doubles('recharge_type', 'recharge_type_status', 1, 'recharge_category_id', $recharge_category_id);
			foreach ($category as $key => $value) {

				$name = $value['recharge_type'];
				$category_id = $value['recharge_type_id'];

				$response[] = array('recharge_type_id' => $category_id, 'recharge_type' => $name, 'recharge_category_id' => $recharge_category_id);
			}
			if (!empty($response)) {
				$post = array("status" => "true", 'recharge_category_id' => $recharge_category_id, "message" => $response);
			} else {
				$post = array('status' => "false", 'recharge_category_id' => $recharge_category_id, "message" => "No Record Found");
			}

		} else {
			$post = array('status' => "false", "message" => "Missing parameter", 'recharge_category_id' => $recharge_category_id);
		}
		echo $this -> json($post);
	}

	// add about us
	/// user feedback///
	function user_feedback() {
		$user_email = $_POST['user_email'];
		$user_name = $_POST['user_name'];
		$user_msg = $_POST['user_msg'];
		if (!empty($user_email) && !empty($user_msg) && !empty($user_name)) {
			$admin_records = $this -> conn -> get_table_row_byidvalue('admin', 'admin_status', 1);
			$admin_email=$admin_records[0]['admin_email'];
			$insert = $this -> conn -> insertnewrecords('user_feedbacks', 'user_email, user_name,user_msg', '"' . $user_email . '","' . $user_name . '","' . $user_msg . '"');
				$user_email = $user_email;
				$subject = 'Feedback Details';
				$message= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>Untitled Document</title></head>

<body bgcolor="#f1f1f1">
<table cellpadding="0" cellspacing="0" width="600" style="background:#fff; border:1px solid #cbcbcb; margin:0 auto; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
	<thead class="header">
    	<tr>
        	<td style="background:#FFFFFF; height:62px; width:100%; padding:5px; border-bottom:1px solid #DDD;" valign="middle">
            	<a href="#" style="margin-left:10px;"><img width="100" src="'.mail_logo.'" alt="..."/></a>
                
            </td>
        </tr>
    </thead>
    <tbody style=" background:#FEFEFE; border-bottom:1px solid #ddd;">
    	<tr>
        	<td style="padding:10px 15px;">
            	<h1 style="margin-bottom:0px; color:#337d75;">OyaCharge </h1>
            	<p> Dear '.$name.', Thanks for Feedback.. 
</p>';
             $message .=  '<p>User Email:<strong>' .$user_email;'</strong></p>';
             $message .=  '<p>User Name:<strong>'.$user_name;'</strong></p>';
             $message .=  '<p>User Message:<strong>'.$user_msg;'</strong></p>';
             $message .=  '</td></tr>';
             $message .= '<tr><td style="background:#ddd; height:1px; width:100%;"></td></tr></tbody>';
    
    		$message .= '<tfoot style="background:#337d75; text-align:center; color:#fff;"><tr><td><p> Copyright © 2016 OyaCharge All right reserved </p></td><tr></tfoot></table></body></html>';
			
			$headers = "Organization: OyaCharge\r\n";
  			$headers .= "MIME-Version: 1.0\r\n";
		  	$headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
		  	$headers .= "X-Priority: 3\r\n";
		  	$headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;
          	
         	$header .= "MIME-Version: 1.0\r\n";
         	$header .= "Content-type: text/html\r\n";
       		$this->sendElasticEmail($user_email, $subject,"OyaCharge", $message, "care@oyacharge.com", "OyaCharge");
			if (!empty($insert)) {
			$this->sendElasticEmail('care@oyacharge.com', $subject,"OyaCharge", $message, "care@oyacharge.com", "OyaCharge");
				$post = array('status' => "true", "message" => "Thanks for your feedback");
			}
		} else {
			$post = array('status' => "false", "message" => "Missing parameter", 'user_email' => $user_email, 'user_name' => $user_name, 'user_msg' => $user_msg);
		}
		echo $this -> json($post);
	}

	function about_us() {
		$about = $this -> conn -> get_table_row_byidvalue('about_us', 'about_us_status', '1');
		$about_us_content = html_entity_decode($about['0']['about_us_content']);
		$version = $about['0']['version'];

		$text = str_ireplace('<p>', '', $about_us_content);
		$text = str_ireplace('</p>', '', $text);
		$text = str_ireplace('<big>', '', $text);
		$text = str_ireplace('</big>', '', $text);
		$text = str_ireplace('<h2>', '', $text);
		$text = str_ireplace('</h2>', '', $text);
		$text = str_ireplace('<q>', '', $text);
		$text = str_ireplace('</q>', '', $text);
		$text = str_ireplace('<code>', '', $text);
		$text = str_ireplace('</code>', '', $text);
		$text = str_ireplace('<strong>', '', $text);
		$text = str_ireplace('</strong>', '', $text);

		if (!empty($text)) {
			$about_us_content = $text;
		} else {
			$about_us_content = '';
		}
		$post = array('version' => $version, "about_us" => $about_us_content);
		echo $this -> json($post);
	}

	function privecy() {
		$privecy = $this -> conn -> get_all_records('privacy_policy');

		$privecy_us_content = html_entity_decode($privecy['0']['privacy_policy_content']);
		$text = str_ireplace('<p>', '', $privecy_us_content);
		$text = str_ireplace('</p>', '', $text);
		if (!empty($text)) {
			$privecy_us_content = $text;
		} else {
			$privecy_us_content = '';
		}

		$post = array("privecy_policy" => $privecy_us_content);
		echo $this -> json($post);
	}

	function terms() {
		$terms = $this -> conn -> get_table_row_byidvalue('terms_conditions', 'terms_status', '1');
		//$terms_content  = $terms['0']['terms_content'];
		$terms_content = html_entity_decode($terms['0']['terms_content']);
		$text = str_ireplace('<p>', '', $terms_content);
		$text = str_ireplace('</p>', '', $text);
		//$terms_content  = $about['0']['terms_conditions'];
		if (!empty($text)) {
			$terms_content = $text;
		} else {
			$terms_content = '';
		}
		$post = array("terms" => $terms_content);
		echo $this -> json($post);

	}

	function contact_us() {
		$contact_us = $this -> conn -> get_table_row_byidvalue('contact_us', 'contact_us_status', '1');
		$contact_name = $contact_us['0']['contact_name'];
		$contact_email = $contact_us['0']['contact_email'];
		$contact_number = $contact_us['0']['contact_number'];
		$conatct_website = $contact_us['0']['conatct_website'];
		//$terms_content  = $about['0']['terms_conditions'];
		if (!empty($contact_name)) {
			$contact_name = $contact_name;
		} else {
			$contact_name = '';
		}
		if (!empty($contact_email)) {
			$contact_email = $contact_email;
		} else {
			$contact_email = '';
		}
		if (!empty($contact_number)) {
			$contact_number = $contact_number;
		} else {
			$contact_number = '';
		}
		if (!empty($conatct_website)) {
			$conatct_website = $conatct_website;
		} else {
			$conatct_website = '';
		}
		$post = array("name" => $contact_name, 'email' => $contact_email, 'mobile' => $contact_number, 'website' => $conatct_website);
		echo $this -> json($post);

	}

	////-------Add money from payment gateway-------------///
	/*
	function add_money() {
			$coupon_id = $_REQUEST['coupon_id'];
			$coupon_amount = $_REQUEST['coupon_amount'];
			$user_id = $_REQUEST['recharge_user_id'];
			$user_amount = $_REQUEST['recharge_amount'];
			$transaction_id = $_REQUEST['transection_id'];
			$final_amount = $coupon_amount + $user_amount;
			$payment_gateway_type = $_REQUEST['payment_gateway_type'];  // 1-kongopay,2-webpay
			$wt_type = 1;
			// credit
			$current_date = date("Y-m-d h:i:sa");
			$wt_category = 1;
			// 1-Add moeny, 2-Recharge
			$w_category = 6;
			$trans_ref_no = $_REQUEST['trans_ref_no'];
			$w_desc = "Amount Recieved when add money " . $user_amount . " with get amount " . $coupon_amount;
			$wt_desc = "Add Money";
			if (!empty($user_id) && !empty($user_amount) && !empty($transaction_id)) {
				$records = $this -> conn -> get_table_row_byidvalue('user', 'user_id', $user_id);
				$wallet_amount = $records['0']['wallet_amount'];
				$user_wallet = $wallet_amount + $final_amount;
				$add_money = $this -> conn -> insertnewrecords('wallet_transaction', 'wt_user_id, wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc,payment_type,trans_ref_no', '"' . $user_id . '","' . $current_date . '","' . $wt_type . '","' . $user_amount . '","' . $wt_category . '","' . $transaction_id . '","' . $wt_desc . '","' . $payment_gateway_type . '","' . $trans_ref_no . '"');
				if (!empty($add_money)) {
					if (!empty($coupon_id)) {
	
						$add_money = $this -> conn -> insertnewrecords('coupon_details', 'coupon_id, user_id,coupon_apply_date', '"' . $coupon_id . '","' . $user_id . '","' . $current_date . '"');
						if ($add_money) {
							$records_coupon = $this -> conn -> get_table_row_byidvalue('offer_coupon', 'coupon_id', $coupon_id);
							
							$coupon_count = $records_coupon['0']['coupon_limit'];
							if($coupon_count>0){
								$data_coupon['coupon_limit'] = $coupon_count - 1;
							$update_toekn = $this -> conn -> updatetablebyid('offer_coupon', 'coupon_id', $coupon_id, $data_coupon);
							}
							
						$transaction_id = strtotime("now") . mt_rand(10, 99);
							$walletrecharge = $this -> conn -> insertnewrecords('wallet_transaction', 'wt_user_id,wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc,cashbackrecord_id', '"' . $user_id . '","' . $current_date . '","' . $wt_type . '","' . $coupon_amount . '","' . $w_category . '","' . $transaction_ids . '","' . $w_desc . '","' . $transaction_id . '"');
						}
					}
					$data['wallet_amount'] = $user_wallet;
					$update_toekn = $this -> conn -> updatetablebyid('user', 'user_id', $user_id, $data);
					$post = array("status" => "true", 'message' => "Add amount successfully", "transaction_id" => $transaction_id, 'add_amount' => $user_amount, 'wallet_amount' => $user_wallet, 'transaction_date' => $current_date);
	
				} else {
					$post = array('status' => "false", "message" => "Transaction Failed");
				}
			} else {
				$post = array('status' => "false", "message" => "Missing parameter", 'recharge_user_id' => $user_id, 'recharge_amount' => $user_amount, 'transection_id' => $transection_id);
			}
			echo $this -> json($post);
		}
	*/
	function add_money() {
		$payment_type 		= 	$_REQUEST['payment_type'];    // 1-card,2-bank account
		$savecard_status	= 	$_REQUEST['savecard_status']; // 1- Save , 2 for not save
		$card_pay_type 		= 	$_REQUEST['card_pay_type'];   // 1-card, 2- card_token
		$coupon_id 			= 	$_REQUEST['coupon_id'];
		$coupon_amount  	= 	$_REQUEST['coupon_amount'];
		$user_id 			= 	$_REQUEST['recharge_user_id'];
		$user_amount 		= 	$_REQUEST['recharge_amount'];
		$card_no			=	$_REQUEST['card_no'];
		$expiry_month		=	$_REQUEST['expiry_month'];
		$expiry_year		=	$_REQUEST['expiry_year'];
		$cvv_no				=	$_REQUEST['cvv_no'];
		$recipient_bank		=	$_REQUEST['recipient_bank'];
		$rec_ac_no			=	$_REQUEST['recipient_account_number'];
		$sender_ac_no		=	sender_account_number;
		$sender_bank		=	sender_bank;
		$passcode			=	$_REQUEST['passcode'];
		$card_token			=	$_REQUEST['card_token'];
		// verve card parameters
		$verve_card_status 	= 	$_REQUEST['verve_card_status'];
		$verve_card_pin 	= 	$_REQUEST['verve_card_pin'];
		$current_date = date("Y-m-d H:i:s");
		if($payment_type == '1')
		{
			$transaction_via="Credit/Debit Card";
			if($card_pay_type=='1')
			{
				$pay			=	$this->payment_card($card_no,$expiry_month,$expiry_year,$cvv_no,$user_id,$user_amount,$savecard_status,$verve_card_status,$verve_card_pin,'1');
			}else 
				if($card_pay_type=='2')
				{
					
					$records_cards 	= $this -> conn -> get_table_field_doubles('save_card_details', 'save_card_userid', $user_id, 'save_card_token', $card_token);
					$cardid			=	$records_cards[0]['card_id'];
					 $cardtoken		=	$records_cards[0]['save_card_token'];
					$save_card_no	=	$records_cards[0]['save_card_no'];
				    $cardfour_digit	= 	substr($save_card_no, -4);
					$pay			=	$this->payment_card_token($cardfour_digit,$cardtoken,$cvv_no,$user_id,$user_amount,$cardid);
				}
		}
		else 
		if($payment_type == '2')
		{
			$transaction_via="Bank Account";
			$pay			=	$this->payment_bank($recipient_bank,$rec_ac_no,$sender_ac_no,$sender_bank,$passcode,$user_id,$user_amount);
		}
	//	$pay	=	$this->payment_card($card_no,$expiry_month,$expiry_year,$cvv_no,$user_id,$user_amount);
		$para				= explode("/", $pay);
		$status				= $para[0];
		
		$PAYtransaction_id		= $para[1];
		$trans_ref_no		= $para[2];
		$data_store_id		= $para[3];
		if($status=='error')
		{
			$post = array('status' => "false", "message" => $PAYtransaction_id,'transaction_date' => date('F-d-Y h:i A',strtotime($current_date)),'transaction_via'=>$transaction_via);
			echo $this -> json($post);
			
			exit();
		}
		//$transaction_id = $_REQUEST['transection_id'];
		$final_amount = $coupon_amount + $user_amount;
		$payment_gateway_type = $_REQUEST['payment_gateway_type'];  // 1-kongopay,2-webpay
		$wt_type = 1;
		// credit
		$current_date = date("Y-m-d H:i:s");
		$wt_category = 1;
		// 1-Add moeny, 2-Recharge
		$w_category = 6;
		//$trans_ref_no = $_REQUEST['trans_ref_no'];
		$w_desc = "Amount Recieved when add money " . $user_amount . " with get amount " . $coupon_amount;
		$wt_desc = "Add Money";
		if (!empty($user_id) && !empty($user_amount) && !empty($PAYtransaction_id)) {
			$records = $this -> conn -> get_table_row_byidvalue('user', 'user_id', $user_id);
			$wallet_amount = $records['0']['wallet_amount'];
			$user_wallet = $wallet_amount + $final_amount;
			$sql="insert into wallet_transaction (wt_user_id,wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc,trans_ref_no,transaction_data_id,payment_type) values ('$user_id','$current_date','$wt_type','$user_amount','$wt_category','$PAYtransaction_id','$wt_desc','$trans_ref_no','$data_store_id','1')";
			mysql_query($sql);
			$rows=mysql_insert_id();
			//$add_money = $this -> conn -> insertnewrecords('wallet_transaction', 'wt_user_id, wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc,payment_type,trans_ref_no', '"' . $user_id . '","' . $current_date . '","' . $wt_type . '","' . $user_amount . '","' . $wt_category . '","' . $transaction_id . '","' . $wt_desc . '","' . $payment_gateway_type . '","' . $trans_ref_no . '"');
			if (!empty($rows)) {
				if (!empty($coupon_id)) {

					$add_money = $this -> conn -> insertnewrecords('coupon_details', 'coupon_id, user_id,coupon_apply_date', '"' . $coupon_id . '","' . $user_id . '","' . $current_date . '"');
					if ($add_money) {
						$records_coupon = $this -> conn -> get_table_row_byidvalue('offer_coupon', 'coupon_id', $coupon_id);
						
						$coupon_count = $records_coupon['0']['coupon_limit'];
						if($coupon_count>0){
							$data_coupon['coupon_limit'] = $coupon_count - 1;
						$update_toekn = $this -> conn -> updatetablebyid('offer_coupon', 'coupon_id', $coupon_id, $data_coupon);
						}
						
						$transaction_id = strtotime("now") . mt_rand(10, 99);
						$walletrecharge = $this -> conn -> insertnewrecords('wallet_transaction', 'wt_user_id,wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc,cashbackrecord_id', '"' . $user_id . '","' . $current_date . '","' . $wt_type . '","' . $coupon_amount . '","' . $w_category . '","' . $transaction_ids . '","' . $w_desc . '","' . $transaction_id . '"');
					}
				}
				$data['wallet_amount'] = $user_wallet;
				$update_toekn = $this -> conn -> updatetablebyid('user', 'user_id', $user_id, $data);
				$post = array("status" => "true", 'message' => "Add amount successfully", "transaction_id" => $PAYtransaction_id, 'add_amount' => $user_amount, 'wallet_amount' => $user_wallet, 'transaction_date' => date('F-d-Y h:i A',strtotime($current_date)),'transaction_ref'=>$trans_ref_no,'transaction_via'=>$transaction_via);

			} else {
				$post = array('status' => "false", "message" => "Transaction Failed");
			}
		} else {
			$post = array('status' => "false", "message" => "Missing parameter", 'recharge_user_id' => $user_id, 'recharge_amount' => $user_amount, 'transection_id' => $transection_id);
		}
		echo $this -> json($post);
	}
	
	/// add quick contects///
	function add_quick_contact() {
		$user_id = $_POST['user_id'];
		$contact_list = $_POST['user_contacts'];
		$contact_name = $_POST['user_name'];
		if (!empty($contact_list) && !empty($user_id)) {
			for ($i = 0; $i < count($contact_list); $i++) {
				$contact = $_POST['user_contacts'][$i];
				$contactname = $_POST['user_name'][$i];
				$add_contacts = $this -> conn -> insertnewrecords('quick_contacts', 'quick_contact_user_id, quick_contacts_name,quick_contacts_number', '"' . $user_id . '","' . $contactname . '","' . $contact . '"');
				if (!empty($add_contacts)) {
					$posts[] = array("user_contacts" => $_POST['user_contacts'][$i], "user_name" => $_POST['user_name'][$i]);
				} else {
					$posts = array('status' => "false", "message" => "Error in adding contacts");
				}

			}
			$post = array('status' => 'true', 'quick_contacts' => $posts);
		} else {
			$post = array('status' => "false", "message" => "Missing parameter", 'user_id' => $user_id, 'contacts' => $contact_list);
		}
		echo $this -> json($post);
	}

	////function add quick contact list with profile pic////
	function add_contact() {
		//$path = 'http://'.$_SERVER['HTTP_HOST'].'/uploads/contacts/';
		$user_id = $_POST['user_id'];
		$contact_number = $_POST['contcat_no'];
		$contact_name = $_POST['contact_name'];
		$mobile = $_POST['contcat_no'];
		;
		if (!empty($user_id) && !empty($contact_name) && !empty($contact_number)) {
			$records_contact_no = $this -> conn -> get_table_field_doubles('quick_contacts', 'quick_contact_user_id', $user_id, 'quick_contacts_number', $contact_number);
			if (empty($records_contact_no)) {
				$records = $this -> conn -> get_table_row_count('quick_contacts', 'quick_contact_user_id', $user_id);
				if ($records < 7) {
					//$contact_number=$_POST['contcat_no'];
					//$contact_name=$_POST['contact_name'];
					$user_image = '';
					if ($_FILES['user_image']) {
						$user_image = $_FILES['user_image']['name'];
					}
					$attachment = $_FILES['user_image']['name'];

					if (!empty($attachment)) {
						$file_extension = end(explode(".", $_FILES["user_image"]["name"]));
						$new_extension = strtolower($file_extension);
						$today = time();
						$custom_name = "user_img" . $today;
						$file_name = $custom_name . "." . $new_extension;
						move_uploaded_file($_FILES['user_image']['tmp_name'], "../uploads/contacts/" . $file_name);

					}
					$user_contact_pic = $file_name;
					$image = contact_img_url . $user_contact_pic;
					$add_contacts = $this -> conn -> insertnewrecords('quick_contacts', 'quick_contact_user_id, quick_contacts_name,quick_contacts_number,user_contact_pic', '"' . $user_id . '","' . $contact_name . '","' . $contact_number . '","' . $user_contact_pic . '"');
					if (!empty($add_contacts)) {
						$posts = array('status' => 'true', 'user_id' => $user_id, 'contact_name' => $contact_name, 'contact_numer' => $mobile, 'user_image_url' => $image);
					} else {
						$posts = array('status' => 'false', 'message' => 'Error in adding contacts');
					}

				} else {
					$posts = array('status' => "false", "message" => "7 Contacts are already exist");
				}
			} else {
				$posts = array('status' => "false", "message" => "These number are already exis");
			}
		} else {
			$posts = array('status' => "false", "message" => "missing parameter", 'user_id' => $user_id, 'contact_name' => $contact_name, 'contact_no' => $contact_number);
		}
		echo $this -> json($posts);
	}

	///qyuick_contact_list

	function quick_contact_list() {
		$user_id = $_POST['user_id'];
		if (!empty($user_id)) {
			$records = $this -> conn -> get_table_row_byidvalue('quick_contacts', 'quick_contact_user_id', $user_id);
			if (!empty($records)) {
				foreach ($records as $key => $value) {
					$count_records = $this -> conn -> get_table_row_count('quick_contacts', 'quick_contact_user_id', $user_id);
					if (!empty($count_records)) {
						$count_records = $count_records;
					} else {
						$count_records = 0;
					}
					$contact_id = $value['quick_contacts_id'];
					$contact_name = $value['quick_contacts_name'];

					$pieces = explode(" ", $contact_name);
					$pieces[0];
					// piece1
					$pieces[1];
					// piece2
					$firstCharacter = substr($pieces[0], 0, 1);
					$lasstCharacter = substr($pieces[1], 0, 1);
					$name = strtoupper($firstCharacter . $lasstCharacter);
					$contact_number = $value['quick_contacts_number'];
					$mobile = $value['quick_contacts_number'];
					if(!empty($value['user_contact_pic']))
					{
						$contact_user_pic = contact_img_url .$value['user_contact_pic'];
					}else{
						$contact_user_pic='';
					}
					
					$response[] = array('contact_id' => $contact_id, 'contact_name' => $contact_name, 'contact_number' => $mobile, 'contact_user_pic' =>  $contact_user_pic, 'name' => $name, 'first_name' => $pieces[0]);
				}
				$post = array("status" => "true", 'user_id' => $user_id, "result" => $response, 'user_count' => $count_records);
			} else {
				$post = array('status' => "false", "message" => "No Record Found", 'user_id' => $user_id);
			}

		} else {
			$post = array('status' => "false", "message" => "Missing parameter", 'user_id' => $user_id);
		}
		echo $this -> json($post);
	}

	// Edit quick contact list///
	function edit_quick_contact() {
		$user_id = $_REQUEST['user_id'];
		$contact_id = $_REQUEST['quick_contacts_id'];

		if (!empty($user_id) && ($contact_id)) {
			$records_contact_no = $this -> conn -> get_table_field_doubles('quick_contacts', 'quick_contact_user_id', $user_id, 'quick_contacts_id', $contact_id);

			if (!empty($records_contact_no)) {
				$name = $records_contact_no[0]['quick_contacts_name'];
				$mobile = $records_contact_no[0]['quick_contacts_number'];
				$pic = $records_contact_no[0]['user_contact_pic'];
				if ($_FILES['user_image']) {
					$user_image = $_FILES['user_image']['name'];
				}
				$attachment = $_FILES['user_image']['name'];

				if (!empty($attachment)) {
					$file_extension = end(explode(".", $_FILES["user_image"]["name"]));
					$new_extension = strtolower($file_extension);
					$today = time();
					$custom_name = "user_img" . $today;
					$file_name = $custom_name . "." . $new_extension;
					move_uploaded_file($_FILES['user_image']['tmp_name'], "../uploads/contacts/" . $file_name);
					$user_contact_pic = $file_name;
					$image = contact_img_url . $user_contact_pic;
					$data['user_contact_pic'] = $user_contact_pic;
				} else {
					$image = contact_img_url . $pic;
				}

				$contact_name = $_POST['contact_name'];
				if (!empty($contact_name)) {
					$data['quick_contacts_name'] = $contact_name;
					$name = $contact_name;
				} else {
					$name = $name;
				}
				$contact_number = $_POST['contcat_no'];
				if (!empty($contact_number)) {
					$data['quick_contacts_number'] =$contact_number;
					$number = $contact_number;
				} else {
					$number = $mobile;
					;
				}
				$update_toekn = $this -> conn -> updatetablebyid('quick_contacts', 'quick_contacts_id', $contact_id, $data);
				$post = array('status' => "true", "message" => "Quick contact update successfully", 'user_id' => $user_id, 'quick_contact_id' => $contact_id, 'contact_name' => $name, 'contact_no' => $number, 'user_contact_pic' => $image);
			} else {
				$post = array('status' => "false", "message" => "Quick Contact not exist", 'user_id' => $user_id, 'quick_contact_id' => $contact_id);
			}
		} else {
			$post = array('status' => "false", "message" => "Missing parameter", 'user_id' => $user_id, 'quick_contact_id' => $contact_id);
		}
		echo $this -> json($post);
	}

	// Delete quick contact list//
	function delete_quick_contact() {
		$user_id = $_REQUEST['user_id'];
		$contact_id = $_REQUEST['quick_contacts_id'];
		if (!empty($user_id) && ($contact_id)) {
			$records_contact_no = $this -> conn -> get_table_field_doubles('quick_contacts', 'quick_contact_user_id', $user_id, 'quick_contacts_id', $contact_id);

			if (!empty($records_contact_no)) {
				$name = $records_contact_no[0]['quick_contacts_name'];
				$mobile = $records_contact_no[0]['quick_contacts_number'];
				$pic = $records_contact_no[0]['user_contact_pic'];
				$delete = $this -> conn -> deletedataintablebytwocol('quick_contacts', 'quick_contact_user_id', $user_id, 'quick_contacts_id', $contact_id);
				if (!empty($delete)) {
					$post = array('status' => "true", "message" => "Successfully delete", 'user_id' => $user_id, 'quick_contact_id' => $contact_id, 'contact_no' => $mobile, 'contact_name' => $name);
				} else {
					$post = array('status' => "false", "message" => "error in deleting contact", 'user_id' => $user_id, 'quick_contact_id' => $contact_id);
				}
			} else {
				$post = array('status' => "false", "message" => "Quick Contact not exist", 'user_id' => $user_id, 'quick_contact_id' => $contact_id);
			}
		} else {
			$post = array('status' => "false", "message" => "Missing parameter", 'user_id' => $user_id, 'quick_contact_id' => $contact_id);
		}
		echo $this -> json($post);

	}

	function recharge() {
		$coupon_id = $_REQUEST['coupon_id'];
		$coupon_amount = $_REQUEST['coupon_amount'];
		$recharge_user_id = $_REQUEST['recharge_user_id'];
		$wt_category = $_REQUEST['wt_category'];
		$recharge_category_id = $_REQUEST['recharge_category_id'];
		//1- Mobile,2-DTH
		$operator_id = $_REQUEST['operator_id'];
		//$recharge_type_id = $_POST['recharge_type_id'];// 1-Topup, 2-special
		$recharge_number = $_REQUEST['recharge_number'];
		$mobile_number = $_REQUEST['recharge_number'];
		$recharge_amount = $_REQUEST['recharge_amount'];
		$rec_number = $_REQUEST['recharge_number'];
		$wallet_type = 2;
		// 1- Credit, 2-Debit
		$recharge_status = 1;
		$recharge_code=$_REQUEST['recharge_code'];  // for tv rechragre
		$customer_name=$_REQUEST['customer_name'];
		$wallet_category = '4';
		// 4- Cashback
		$current_date = date("Y-m-d H:i:s");

		if ($wt_category == '1') {
			$wt_desc = 'Add-Money';
		} else if ($wt_category == '2') {
			$wt_desc = 'Recharge';
		} else if ($wt_category == '3') {
			$wt_desc = 'Refund';
		} else if ($wallet_category == '4') {
			$w_desc = 'Cashback';
		}else if ($wallet_category == '12') {
			$w_desc = 'Electricity Bill';
		}

		if (!empty($recharge_user_id) && !empty($operator_id) && !empty($recharge_number) && !empty($recharge_amount)) {
			$records = $this -> conn -> get_table_row_byidvalue('user', 'user_id', $recharge_user_id);

			$wallet_amount = $records['0']['wallet_amount'];
			$user_number = $records['0']['user_contact_no'];
			$admin = $this -> conn -> get_all_records('admin');
			$admin_wallet = $admin['0']['admin_wallet'];
			$transaction_id = strtotime("now") . mt_rand(10, 99);
			$reffer_status = $records['0']['reffer_amount_status'];
			$reffer_user_id = $records['0']['reffer_user_id'];
			$user_email = $records['0']['user_email'];
			$recharge_response = '';
		if ($wallet_amount >= $recharge_amount) {
				// $recharge_status=$this->mobile_recharge_api($operator_id,$mobile_number,$recharge_amount);
$recharge_status = $this -> mobile_recharge_api($operator_id, $mobile_number, $recharge_amount,$recharge_code,$customer_name);
		$biller_records = $this -> conn -> get_table_row_byidvalue('operator_list', 'operator_id', $operator_id);
//$recharge_status='1';
		$operator_name = $biller_records['0']['operator_name'];
		$operator_code = $biller_records['0']['operator_code'];
		if ($operator_code == 'MTN') {
		
				if ($recharge_status == '100') {
					$recharge_response = '1';

				} else {
					$recharge_response = '2';
				}
			} else {
				$iparr = split("\,", $recharge_status);
				$recharge_response = $iparr[0];
				$transaction_id = $iparr[1];
				$electricity_token = $iparr[2];
			}
			if (!empty($transaction_id)) {
				$transaction_id = $transaction_id;
			} else {
				$transaction_id = strtotime("now") . mt_rand(10, 99);
			}
			if($recharge_response=='1'){
					if(!empty($electricity_token))
					{
						$electricity_token=$electricity_token;
					}else{
						$electricity_token='';
					}
				//$transaction_id='5454';
				$recharge = $this -> conn -> insertnewrecords('wallet_transaction', 'wt_user_id, wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc,electrice_token_no', '"' . $recharge_user_id . '","' . $current_date . '","' . $wallet_type . '","' . $recharge_amount . '","' . $wt_category . '","' . $transaction_id . '","' . $wt_desc . '","' . $electricity_token . '"');

				if ($recharge) {

					$walletrecharge = $this -> conn -> insertnewrecords('recharge', 'recharge_transaction_id,recharge_user_id, rechage_category,operator_id,rechage_type,recharge_number,recharge_amount,recharge_date,recharge_status', '"' . $transaction_id . '","' . $recharge_user_id . '","' . $recharge_category_id . '","' . $operator_id . '","' . $recharge_type_id . '","' . $recharge_number . '","' . $recharge_amount . '","' . $current_date . '","' . $recharge_status . '"');

					//reffer amount when user first recharge then beifits add in frnd wallet
					
					$cashback_record_id = $recharge_number;
					if (!empty($coupon_id)) {
		$coupon_id = $_REQUEST['coupon_id'];
		$coupon_amount = $_REQUEST['coupon_amount'];
						$coupon_apply = $this -> conn -> insertnewrecords('coupon_details', 'coupon_id, user_id,coupon_apply_date', '"' . $coupon_id . '","' . $recharge_user_id . '","' . $current_date . '"');
						if (!empty($coupon_apply)) {
								
							$records_coupon = $this -> conn -> get_table_row_byidvalue('offer_coupon', 'coupon_id', $coupon_id);
						
						$coupon_count = $records_coupon['0']['coupon_limit'];
						if($coupon_count>0){
							$data_coupon['coupon_limit'] = $coupon_count - 1;
						$update_toekn = $this -> conn -> updatetablebyid('offer_coupon', 'coupon_id', $coupon_id, $data_coupon);
						}
						
							$transaction_id = strtotime("now") . mt_rand(10, 99);
							$walletrecharge = $this -> conn -> insertnewrecords('wallet_transaction', 'wt_user_id,wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc,cashbackrecord_id', '"' . $recharge_user_id . '","' . $current_date . '","' . $wallet_type . '","' . $coupon_amount . '","' . $wallet_category . '","' . $transaction_id . '","' . $w_desc . '","' . $cashback_record_id . '"');
						}
					}
					$user_wallet = $wallet_amount - $recharge_amount + $coupon_amount;
					$data['wallet_amount'] = $user_wallet;

					$update_toekn = $this -> conn -> updatetablebyid('user', 'user_id', $recharge_user_id, $data);
					// Admin wallet update
					$admin_update_wallet = $admin_wallet + $recharge_amount - $coupon_amount;
					$data_admin['admin_wallet'] = $admin_update_wallet;
					$update_toekn = $this -> conn -> updatetablebyid('admin', 'admin_id', 1, $data_admin);
					if($recharge_category_id=='1'){
						$recharge_type= "Mobile";
					}else if($recharge_category_id=='2')
					{
						$recharge_type= "TV";
					}else if($recharge_category_id=='3')
					{
						$recharge_type= "Data";
					}
					if ($reffer_status == '2') 
						{
							$this->refferal_code($recharge_user_id,$reffer_user_id,$user_number,$wallet_amount);	
						}
					
					$this->recharge_mail($recharge_user_id,$operator_id,$recharge_number,$transaction_id,$recharge_amount,$recharge_type,"0",'1');
					$this -> recharge_message($user_number, $recharge_amount, $transaction_id,$recharge_number,'1');
					$post = array("status" => "true", 'message' => "Recharge Successfully", "recharge_id" => $recharge, 'recharge_number' => $rec_number, 'recharge_amount' => $recharge_amount, 'wallet_amount' => $user_wallet, 'transaction_date' => date('F-d-Y h:i A',strtotime($current_date)), 'transaction_id' => $transaction_id,'electricity_prepaid_token'=>$electricity_token);
					$this->free_offer_mail($recharge_user_id);

				} else {
					$post = array('status' => "false", "message" => "Recharge failed");
				}
			

			 }else{
			$transaction_id = strtotime("now") . mt_rand(10, 99);
			 $recharge = $this -> conn -> insertnewrecords('wallet_transaction','wt_user_id, wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc,wt_status', '"' . $recharge_user_id . '","' . $current_date . '","' . $wallet_type . '","' . $recharge_amount . '","' . $wt_category .'","'.$transaction_id. '","'.$wt_desc .'","3"');
			 $walletrecharge = $this -> conn -> insertnewrecords('recharge','recharge_transaction_id,recharge_user_id, rechage_category,operator_id,rechage_type,recharge_number,recharge_amount,recharge_date,recharge_status','"'.$transaction_id . '","' . $recharge_user_id . '","' . $recharge_category_id . '","' . $operator_id . '","' . $recharge_type_id . '","' .$recharge_number. '","' . $recharge_amount . '","' . $current_date . '","3"');
			 $this->recharge_mail($recharge_user_id,$operator_id,$recharge_number,$transaction_id,$recharge_amount,$recharge_type,$payment_gateway_type,'2');
					$this -> recharge_message($user_number, $recharge_amount, $transaction_id,$recharge_number,'2');
			 $post = array('status' => "false","message" => "Recharge failed", "recharge_id" => $recharge,'recharge_number'=>$rec_number,'recharge_amount'=>$recharge_amount,'wallet_used_amount'=>$wallet_used_amount,'card_used_amount'=>$card_deduct_amount,'wallet_amount'=>$wallet_amount,'transaction_date'=>date('F-d-Y h:i A',strtotime($current_date)),'transaction_id'=>$transaction_id);

			 }
				} else {
				$pay_amount = $recharge_amount - $wallet_amount;
				$post = array('status' => "false", "message" => "Not sufficent amount in  your wallet", 'wallet_amount' => $wallet_amount, 'recharge_amount' => $rec_number, 'payble_amount' => $pay_amount);
				echo $this -> json($post);
				exit();
				//$add=$this->add_money_recharge($recharge_user_id,$recharge_amount,$recharge_transaction_id);
				//$this->recharge();
			}
		} else {
			$post = array('status' => "false", "message" => "Missing parameter", 'recharge_user_id' => $recharge_user_id, 'recharge_category_id' => $recharge_category_id, 'operator_id' => $operator_id, 'recharge_type_id' => $recharge_type_id, 'recharge_number' => $recharge_number, 'recharge_amount' => $recharge_amount);
		}
		echo $this -> json($post);
	}
function off_mail_send()
{
	$doner_user_id=$_REQUEST['user_id'];
	
	$trans_id=$_REQUEST['trans_id'];
	
	$this->free_offer_mail($doner_user_id);
}
	function free_offer_mail($user_id)
	{
		$header_logo=mail_image."logo_header.png";
			$recharge_user_id = $user_id;
		$frnd_records = $this -> conn -> get_table_row_byidvalue('user', 'user_id', $recharge_user_id);
		$user_name = $frnd_records['0']['user_name'];
		$user_email = $frnd_records['0']['user_email'];
		  $frnd_number = $frnd_records['0']['user_contact_no'];
		//	$offer_records = $this -> conn -> get_table_row_byidvalue('add_cart_offer', 'cart_user_id', 12);
		$offer_records = $this -> conn -> get_table_row_byidvalue('add_cart_offer', 'cart_user_id', $recharge_user_id);
	
		$current_date = date("Y-m-d H:i:s");
		if (!empty($offer_records)) {

			foreach ($offer_records as $value) {

				$coupon_id = $value['cart_offer_id'];
				$frnd_records = $this -> conn -> join_two_table('free_coupon_list', 'free_coupon_category', 'fee_coupon_category_id', 'free_coupon_category_id', 'free_coupon_id', $coupon_id);
				//$transaction = $this->login_model->join_two_table('free_coupon_list','free_coupon_category', 'fee_coupon_category_id', 'free_coupon_category_id','free_coupon_id',$coupon_id);

				$free_coupon_id = $frnd_records['0']['free_coupon_id'];
				$coupon_name = $frnd_records['0']['coupon_name'];
				$coupon_discount = $frnd_records['0']['coupon_discount'];
				$coupon_code = $frnd_records['0']['coupon_code'];
				$coupon_expiry_date = $frnd_records['0']['coupon_expiry_date'];
				$coupon_refference_url = $frnd_records['0']['refference_website'];
				$coupon_terms = strip_tags($frnd_records['0']['coupon_terms'],"<br></br><p></p>&lt;p&gt;");
			
				$coupon_image_url = offer_coupon_img . '/' . $frnd_records['0']['coupon_img'];
				// $to='blm.ypsilon@gmail.com';
				$to = $user_email;

				$subject = "Promotional offer code details";
				$path = mail_logo;
				$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>OyaCharge</title>
</head>
<body>
<table style="width:100%; font-size:12px; max-width:600px; margin:0 auto;background-color:#80d6cd" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td width=""><table width="100%" cellspacing="0" cellpadding="0" align="center">
          <tbody>
            <tr>
              <td colspan="2" style="text-align:center;padding-top:15px;padding-left:20px"><img src="'.$header_logo.'" alt="Oyacharge" title="Oyacharge" class="" /></td>
              <td style="text-align:right; padding-top:20px; padding-right:20px; color:#fff; font-family:Arial, Helvetica, sans-serif;">
              <h3>Deals receipt</h3>
              <p style="margin:1px;"><strong>Order Date:</strong><br />'.$current_date.'</p>
              <p style="margin:1px;"><strong>Mob.:</strong> '.$frnd_number.'</p>
              <p style="margin:1px;"><strong>Email:</strong> '.$user_email.'</p>
              </td>
              
            </tr>
          </tbody>
        </table></td>
    </tr>
    <tr>
      <td height="10"></td>
    </tr>
    <tr>
      <td height="40"></td>
    </tr>

    <tr>
      <td height="20" align="center" style=" border-top:1px dashed #57A9A0;border-bottom:1px dashed #57A9A0; padding:10px;"><p style="font-size:18px;font-family:Arial,Helvetica,sans-serif;color:#fff; margin:0;">Your Deals</p></td>
    </tr>
    <tr>
        <td>
        	<table cellpadding="0" cellspacing="0">
            	<tbody>
                	<tr>
                    	<td width="60%" style="padding:10px; padding-right:0;"><img width="100%" src="'.$coupon_image_url.'" alt="Oyacharge" title="Oyacharge" style=""/></td>
                        <td width="40%" style="background:#57A9A0; position:relative; padding-left:25px;"><p style="font-size:14px;font-family:Arial,Helvetica,sans-serif;color:#fff;"> <br /><strong style="font-size:18px;">Code : '.$coupon_code.'</strong> </p>
					<div style="position:absolute; margin-left:-65px; top:39%; bottom:auto; background:#57A9A0; width:40px; height:80px;"></div>
</td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
      <td style="height:20px; border-bottom:1px dotted #fff;">
      
      </td>
    </tr>
    <tr>
      <td height="15"></td>
    </tr>
    <tr>
      <td style="font-size:14px; color:#fff; font-family:Arial, Helvetica, sans-serif; text-align:left; padding:0px 10px;">
      
      	<h2 style="padding-left:25px;">Terms & Conditions</h2>
        <ol>
        	
            <li>'.$coupon_terms.'</li>
      </td>
    </tr>
  
    <tr>
      <td height="15"></td>
    </tr>

    <tr>
      <td style="padding:10px; border-top:2px dotted #fff;"><span class="m_678193774613953679HOEnZb"><font color="#fff"> </font></span><span class="m_678193774613953679HOEnZb"><font color="#fff"> </font></span><span class="m_678193774613953679HOEnZb"><font color="#fff"> </font></span>
        <table align="center" width="100%">
          <tbody>
            <tr>
              <td style="width:50%;text-align:left;padding-left:15px"><table>
                  <tbody>
                    <tr>
                      <td><a href="#" target="_blank" data-saferedirecturl=""><img src="'.mail_image.'/fb.png" class="CToWUd" width="25" /></a></td>
                      <td><a href="#" target="_blank" data-saferedirecturl=""><img src="'.mail_image.'/tweet.png" class="CToWUd" width="25" /></a></td>
                      <td><a href="#" target="_blank" data-saferedirecturl=""><img src="'.mail_image.'/google.png" class="CToWUd" width="25" /></a></td>
                    </tr>
                  </tbody>
                </table>
                </td>
              <td style="width:50%; font-size:11px;font-family:Arial,Helvetica,sans-serif;color:#fff;width:50%;text-align:right">&copy; Oyacharge 2016 </td>
            </tr>
          </tbody>
        </table>
        <span class="HOEnZb"><font color="#888888"><span class="m_678193774613953679HOEnZb"><font color="#888888"> </font></span></font></span></td>
    </tr>
  </tbody>
</table>

<map name="Map" id="Map">
  <area shape="poly" coords="213,310" href="#" />
  <area shape="rect" coords="60,257,213,312" href="122" target="_blank" />
  <area shape="rect" coords="215,257,376,314" href="#" target="_blank" />
</map>

</body>
</html>';
//print_r($message);die;
$headers = "Organization: OyaCharge\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
				$headers .= "X-Priority: 3\r\n";
				$headers .= "X-Mailer: PHP" . phpversion() . "\r\n";
				$header = "From:blm.ypsilon@gmail.com \r\n";
				$header .= "Cc:blm.ypsilon@gmail.com \r\n";
				$header .= "MIME-Version: 1.0\r\n";
				$header .= "Content-type: text/html\r\n";
				$this->sendElasticEmail($user_email, $subject, "OyaCharge", $message, "care@oyacharge.com", "OyaCharge");
				$delete_records = $this -> conn -> deletedataintablebytwocol('add_cart_offer', 'cart_user_id', $user_id,'cart_offer_id',$coupon_id);
				}
				}
	}
	/// Recharge from wallet with card
	function offer_mail($recharge_user_id) {
		$recharge_user_id = $recharge_user_id;
		$frnd_records = $this -> conn -> get_table_row_byidvalue('user', 'user_id', $recharge_user_id);
		$user_name = $frnd_records['0']['user_name'];
		$user_email = $frnd_records['0']['user_email'];
		//  $frnd_number = $frnd_records['0']['user_contact_no'];
		//	$offer_records = $this -> conn -> get_table_row_byidvalue('add_cart_offer', 'cart_user_id', 12);
		$offer_records = $this -> conn -> get_table_field_doubles('add_cart_offer', 'cart_user_id', $recharge_user_id, 'cart_offer_status', 2);

		if (!empty($offer_records)) {

			foreach ($offer_records as $value) {

				$coupon_id = $value['cart_offer_id'];
				$frnd_records = $this -> conn -> join_two_table('free_coupon_list', 'free_coupon_category', 'fee_coupon_category_id', 'free_coupon_category_id', 'free_coupon_id', $coupon_id);
				//$transaction = $this->login_model->join_two_table('free_coupon_list','free_coupon_category', 'fee_coupon_category_id', 'free_coupon_category_id','free_coupon_id',$coupon_id);

				$free_coupon_id = $frnd_records['0']['free_coupon_id'];
				$coupon_name = $frnd_records['0']['coupon_name'];
				$coupon_discount = $frnd_records['0']['coupon_discount'];
				$coupon_code = $frnd_records['0']['coupon_code'];
				$coupon_expiry_date = $frnd_records['0']['coupon_expiry_date'];
				$coupon_refference_url = $frnd_records['0']['refference_website'];
				$coupon_image_url = coupon_logo . '/' . $frnd_records['0']['coupon_img'];
				// $to='blm.ypsilon@gmail.com';
				$to = $user_email;

				$subject = "Promotional offer code details";
				$path = mail_logo;
				$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>Untitled Document</title></head>

<body bgcolor="#f1f1f1">
<table cellpadding="0" cellspacing="0" width="600" style="background:#fff; border:1px solid #cbcbcb; margin:0 auto; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
	<thead class="header">
    	<tr>
        	<td style="background:#FFFFFF; height:62px; width:100%; padding:5px; border-bottom:1px solid #DDD;" valign="middle">
            	<a href="#" style="margin-left:10px;"><img width="100" src="' . $path . '" alt="..."/></a>
                
            </td>
        </tr>
    </thead>
    <tbody style=" background:#FEFEFE; border-bottom:1px solid #ddd;">
    	<tr>
        	<td style="padding:10px 15px;">
            	<h1 style="margin-bottom:0px; color:#337d75;">RECHARGE </h1>
            	<p >Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since</p>';
				$message .= '<p>Coupon name:<strong>' . $coupon_name;
				'</strong></p>';
				$message .= '<p>Coupon Discount:<strong>' . $coupon_discount;
				'</strong></p></td></tr>';
				$message .= '<p>Coupon Code:<strong>' . $coupon_code;
				'</strong></p>';
				$message .= '<p>Coupon Expiry Date:<strong>' . $coupon_expiry_date;
				'</strong></p></td></tr>';
				$message .= '<p>Refference Website:<strong>' . $coupon_refference_url;
				'</strong></p></td></tr>';
				$message .= '<tr><td style="background:#ddd; height:1px; width:100%;"></td></tr></tbody>';

				$message .= '<tfoot style="background:#337d75; text-align:center; color:#fff;"><tr><td><p> Copyright © 2016 Recharge All right reserved </p></td><tr></tfoot></table></body></html>';

				//
				// $message= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				// <html xmlns="http://www.w3.org/1999/xhtml">
				// <head>
				// <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				// <title>Untitled Document</title>
				// </head>
				//
				// <body>
				// <table width="550" cellspacing="0" cellpadding="0" align="center" style="width:550px; font-family:Arial, Helvetica, sans-serif; border:1px solid #ddd;">
				// <tbody>
				// <tr>
				// <td><table width="100%" cellspacing="0" cellpadding="0" border="0">
				// <tbody>
				// <tr bgcolor="#60c4ba">
				// <td align="left"><img src="'.$path.'" width="150" alt="..."/></td>
				// </tr>
				// </tbody>
				// </table>
				// &nbsp;
				// <table width="100%" cellspacing="0" cellpadding="0" border="0" style="padding:10px;">
				// <tbody>
				// <tr>
				// <td valign="bottom" style="font-size:14px;text-align:left;font-family:arial;text-transform:capitalize">Dear "'.$user_name	.'",</td>
				// </tr>
				// </tbody>
				// </table>
				// <p style="margin:0;min-height:20px padding:10px;">&nbsp;</p>
				// <p style="margin:0 0 0 0;color:#000000; padding:10px;text-align:left;font-size:14px;font-weight:normal;line-height:20px">Your recharge has officially been made free! Your free coupons have been listed below. Please note, e-coupons can be redeemed instantly.</p>
				// <p style="font-size:14px;padding:10px;margin:0;color:#000000;text-align:justify;line-height:18px">If theres anything else we can do to make you smile, please dont hesitate to get in touch with us.</p>
				// <p style="font-size:14px;padding:10px;margin:0;text-align:left;font-weight:bold"><span style="text-transform:uppercase">Insta coupon(s)</span> - <span style="font-weight:normal;padding:10px;color:#666;font-size:12px">Delivered instantly via email to your registered email id.</span></p>
				// <table width="100%" cellspacing="0" cellpadding="0" style="border:2px dashed #0d2651;padding:10px;background:#fefdf5">
				// <tbody>
				// <tr>
				// <td colspan="5"><div style="min-height:10px">&nbsp;</div></td>
				// </tr>
				// <tr>
				// <td width="10" rowspan="2">&nbsp;</td>
				// <td width="95" align="center" style="font-size:11px;padding:0px" rowspan="2"><a style="text-decoration:none;border:0;font-size:11px;color:#000000" rel="external"><img width="95" height="50" title="Dominos.co.in 15% OFF" style="min-height:50px;display:block;text-decoration:none;border:0;word-break:break-all" src=".$coupon_image_url." alt="Dominos.co.in 15% OFF" class="CToWUd"></a></td>
				// <td width="290" valign="top" style="text-align:left;padding:0px;padding-left:7px"><span style="color:#999;font-size:14px;font-weight:bold;display:block"><a data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://Dominos.co.in&amp;source=gmail&amp;ust=1465984931028000&amp;usg=AFQjCNGti07GxKef8IQLYh-4J9SikJsGZQ" target="_blank" rel="external" href="http://Dominos.co.in">Dominos.co.in</a> 15% OFF</span></td>
				// <td width="135" style="text-align:right;padding:0"><strong style="color:#0d2651;font-size:28px;font-weight:bold;text-align:center"><span style="font-size:17px">Rs.</span> 50</strong></td>
				// <td width="10" rowspan="2">&nbsp;</td>
				// </tr>
				// <tr>
				// <td style="padding:0;margin:0"><table width="100%" cellspacing="0" cellpadding="0" border="0">
				// <tbody>
				// <tr>
				// <td width="90" valign="middle" style="text-align:left;padding:0px;padding-left:7px"><span style="color:#999;font-size:12px;line-height:18px">Coupon Code:</span></td>
				// <td width="200"><div style="background:none repeat scroll 0 0 #eee;border:1px dashed #333333;font-size:16px;font-weight:bold;padding:1px 0px;display:block;text-align:center;width:185px;margin:0 5px">Frchr01</div></td>
				// </tr>
				// </tbody>
				// </table></td>
				// <td style="text-align:right;padding:0;font-size:16px;color:#000000"><p style="margin:0;padding:0;font-size:11px;color:#999">Expire on: &nbsp; <span data-term="goog_1872809791" class="aBn" tabindex="0"><span class="aQJ">31 Aug 2016</span></span></p></td>
				// </tr>
				// <tr>
				// <td colspan="5"><div style="min-height:18px">&nbsp;</div></td>
				// </tr>
				// </tbody>
				// </table>
				// <table cellspacing="0" cellpadding="0" style="padding:10px;">
				// <tbody>
				// <tr>
				// <td style="padding:15px 0px;background:#fff;border-bottom:3px solid #f9f9f9" colspan=""><p style="font-size:11px;color:#999;line-height:16px;margin:0;padding:0"><strong>Terms &amp; Conditions:</strong> Offer Highlights: Enjoy flat 15% discount on minimum billing of Rs. 350 at <a data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://www.dominos.co.in&amp;source=gmail&amp;ust=1465984931028000&amp;usg=AFQjCNHKk0HpqXE9TW5R1pA62PZ9rbGT2Q" target="_blank" rel="external" href="http:number//www.dominos.co.in">www.dominos.co.in</a> How to redeem this Offer: You will receive an coupon code via e-mail as soon as your transaction is successful. You need to apply the coupon code at the time of placing the order on <a data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://www.dominos.co.in&amp;source=gmail&amp;ust=1465984931028000&amp;usg=AFQjCNHKk0HpqXE9TW5R1pA62PZ9rbGT2Q" target="_blank" rel="external" href="http://www.dominos.co.in">www.dominos.co.in</a> Terms of this Offer: Offer not valid on Simply Veg, Simply Non Veg Pizzas, Pizza Mania Combos and Beverages. Only one Coupon Code is valid per transaction and cannot be clubbed with any other offer or promotion. Offer valid only on orders placed ONLINE. Offer valid till <span data-term="goog_1872809792" class="aBn" tabindex="0"><span class="aQJ">31st August, 2016</span></span>.</p></td>
				// </tr>
				// </tbody>
				// </table>
				// <p style="font-size:12px;margin:0;color:#000000;padding:10px;text-align:left">Lots of love,</p>
				// <p style="font-size:12px;margin:0;color:#000000;padding:10px;text-align:left">The OyaCharge Family</p>
				// <p style="font-size:12px;margin:0;color:#000000;padding:10px;text-align:left;font-weight:normal">This is a system-generated mail, please do not respond to this e-mail Id. Got a question or need clarifications? You can either visit <a data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://support.freecharge.in/&amp;source=gmail&amp;ust=1465984931028000&amp;usg=AFQjCNEm1EolVTUsdJj69XGVn3lMVSSUeg" target="_blank" rel="external" href="http://support.freecharge.in/">support.Oyacharge.in</a> or write in to <a target="_blank" href="mailto:care@freecharge.com">care@oyacharge.com</a> we will get in touch with you asap.</p></td>
				// </tr>
				// </tbody>
				// </table>
				// </body>
				// </html>';
				//
				$headers = "Organization: OyaCharge\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
				$headers .= "X-Priority: 3\r\n";
				$headers .= "X-Mailer: PHP" . phpversion() . "\r\n";
				$header = "From:blm.ypsilon@gmail.com \r\n";
				$header .= "Cc:blm.ypsilon@gmail.com \r\n";
				$header .= "MIME-Version: 1.0\r\n";
				$header .= "Content-type: text/html\r\n";
				$this->sendElasticEmail($to, $subject,"OyaCharge", $message, "care@oyacharge.com", "OyaCharge");
				//$retval = mail($to, $subject, $message, $header);
				$data_frnd['cart_offer_status'] = 1;
				$update_toekn = $this -> conn -> updatetablebyid('user', 'cart_offer_id', $coupon_id, $data_frnd);
			}

		}
	}

	function recharge_from_wallet_with_card() {
		$coupon_id = $_REQUEST['coupon_id'];
		$coupon_amount = $_REQUEST['coupon_amount'];
		$recharge_user_id = $_REQUEST['recharge_user_id'];
		
		$recharge_code=$_REQUEST['recharge_code'];  // for tv rechragre
		$customer_name=$_REQUEST['customer_name'];
	//	$transaction_id = strtotime("now") . mt_rand(10, 99);
		$refund_amount = $_REQUEST['payment_gateway_amt'];
		$recharge_category_id = $_REQUEST['recharge_category_id'];
		//1- Mobile,2-DTH
		$operator_id = $_REQUEST['operator_id'];
		$rec_number = $_REQUEST['recharge_number'];
		$recharge_number = $_REQUEST['recharge_number'];
		$mobile_number = $_REQUEST['recharge_number'];
		$recharge_amount = $_REQUEST['recharge_amount'];
		$wallet_type = 2;
		// 1- Credit, 2-Debit
		$recharge_status = 1;
		$wt_category = $_REQUEST['wt_category'];
		//  1-Add money,2-Recharge
		$wallet_category = '4';
		// 4- Cashback
		$current_date = date("Y-m-d H:i:s");
		$payment_type 		=   $_REQUEST['payment_type'];  // 1-card,2-bank account
		$savecard_status	= 	$_REQUEST['savecard_status']; // 1- Save , 2 for not save
		$card_pay_type 		= 	$_REQUEST['card_pay_type'];   // 1-card, 2- card_token
		$card_no			=	$_REQUEST['card_no'];
		$expiry_month		=	$_REQUEST['expiry_month'];
		$expiry_year		=	$_REQUEST['expiry_year'];
		$cvv_no				=	$_REQUEST['cvv_no'];

		$recipient_bank		=	$_REQUEST['recipient_bank'];
		$rec_ac_no			=	$_REQUEST['recipient_account_number'];
		$sender_ac_no		=	sender_account_number;
		$sender_bank		=	sender_bank;
		$passcode			=	$_REQUEST['passcode'];
		$rec_ac_no			=	$_REQUEST['recipient_account_number'];
		$card_token			=	$_REQUEST['card_token'];
		if($payment_type == '1')
		{
			if($card_pay_type=='1')
			{
				$pay = $this->payment_card($card_no,$expiry_month,$expiry_year,$cvv_no,$recharge_user_id,$refund_amount,$savecard_status,$verve_card_status,$verve_card_pin,'1');
			}else 
				if($card_pay_type=='2')
				{
					$records_cards = $this -> conn -> get_table_field_doubles('save_card_details', 'save_card_userid', $recharge_user_id, 'save_card_token', $card_token);
					$cardid		=	$records_cards[0]['card_id'];
					$cardtoken	=	$records_cards[0]['save_card_token'];
					$save_card_no	=	$records_cards[0]['save_card_no'];
					$cardfour_digit= substr($save_card_no, -4);
					$pay			=	$this->payment_card_token($cardfour_digit,$cardtoken,$cvv_no,$recharge_user_id,$refund_amount,$cardid);
					
				}
		}
		else 
		if($payment_type == '2')
		{
			$pay = $this->payment_bank($recipient_bank,$rec_ac_no,$sender_ac_no,$sender_bank,$passcode,$recharge_user_id,$refund_amount);
		}
		$para					= explode("/", $pay);
		$status					= $para[0];
		$payment_transaction_id		= $para[1];
		$trans_ref_no				= $para[2];
		$data_store_id				= $para[3];
		if($status=='error')
		{
			$post = array('status' => "false", "message" => $payment_transaction_id);
			echo $this -> json($post);
			exit();
		}
		$payment_gateway_type =$payment_type;  // 1-card,2-bank account
		if (!empty($recharge_user_id) && !empty($operator_id) && !empty($recharge_number) && !empty($recharge_amount)) {
			$records = $this -> conn -> get_table_row_byidvalue('user', 'user_id', $recharge_user_id);
			$wallet_amount = $records['0']['wallet_amount'];
			$wallet_used_amount = $records['0']['wallet_amount'];
			$reffer_status = $records['0']['reffer_amount_status'];
			$reffer_user_id = $records['0']['reffer_user_id'];
			
			$card_deduct_amount = $recharge_amount - $wallet_amount;
			$user_number = $records['0']['user_contact_no'];
			$admin = $this -> conn -> get_all_records('admin');
			$admin_wallet = $admin['0']['admin_wallet'];
			$recharge_response = '';
			//	if($operator_id=='3'){
		//	$recharge_status = $this -> mobile_recharge_api($operator_id, $mobile_number, $recharge_amount);
			$recharge_status = $this -> mobile_recharge_api($operator_id, $mobile_number, $recharge_amount,$recharge_code,$customer_name);
			$biller_records = $this -> conn -> get_table_row_byidvalue('operator_list', 'operator_id', $operator_id);

		$operator_name = $biller_records['0']['operator_name'];
		$operator_code = $biller_records['0']['operator_code'];
		if ($operator_code == 'MTN') {
				if ($recharge_status == '100') {
					$recharge_response = '1';

				} else {
					$recharge_response = '2';
				}
			} else {
				$iparr = split("\,", $recharge_status);
				$recharge_response = $iparr[0];
				$transaction_id = $iparr[1];
				$electricity_token = $iparr[2];
			}
			if (!empty($transaction_id)) {
				$transaction_id = $transaction_id;
			} else {
				$transaction_id = strtotime("now") . mt_rand(10, 99);
			}
			//}
			if ($recharge_response == '1') {
				if(!empty($electricity_token))
					{
						$electricity_token=$electricity_token;
					}else{
						$electricity_token='';
					}
				$recharge = $this -> conn -> insertnewrecords('wallet_transaction', 'wt_user_id, wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc,user_wallet_rec_amount,user_card_card_rec_amount,payment_gateway_id,electrice_token_no,payment_type,trans_ref_no', '"' . $recharge_user_id . '","' . $current_date . '","' . $wallet_type . '","' . $recharge_amount . '","' . $wt_category . '","' . $transaction_id . '","' . $wt_desc . '","' . $wallet_amount . '","' . $card_deduct_amount . '","' . $payment_transaction_id . '","' . $electricity_token . '","' . $payment_gateway_type . '","' . $trans_ref_no . '"');

				if ($recharge) {
			
$walletrecharge = $this -> conn -> insertnewrecords('recharge', 'recharge_transaction_id,recharge_user_id,rechage_category,operator_id,rechage_type,recharge_number,recharge_amount,recharge_date,recharge_status,payment_gateway_id,electrice_token_no', '"' . $transaction_id . '","' . $recharge_user_id . '","' . $recharge_category_id . '","' . $operator_id . '","' . $recharge_type_id . '","' . $recharge_number . '","' . $recharge_amount . '","' . $current_date . '","' . $recharge_status . '","' . $payment_transaction_id . '","' . $electricity_token . '"');

					//reffer amount when user first recharge then beifits add in frnd wallet
					

					$cashback_record_id = $recharge_number;
					if (!empty($coupon_id)) {

						$coupon_apply = $this -> conn -> insertnewrecords('coupon_details', 'coupon_id, user_id,coupon_apply_date', '"' . $coupon_id . '","' . $recharge_user_id . '","' . $current_date . '"');
						if (!empty($coupon_apply)) {

			$records_coupon = $this -> conn -> get_table_row_byidvalue('offer_coupon', 'coupon_id', $coupon_id);
						
						$coupon_count = $records_coupon['0']['coupon_limit'];
						if($coupon_count>0){
							$data_coupon['coupon_limit'] = $coupon_count - 1;
						$update_toekn = $this -> conn -> updatetablebyid('offer_coupon', 'coupon_id', $coupon_id, $data_coupon);
						}




							$walletrecharge = $this -> conn -> insertnewrecords('wallet_transaction', 'wt_user_id,wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc,cashbackrecord_id', '"' . $recharge_user_id . '","' . $current_date . '","' . $wallet_type . '","' . $coupon_amount . '","' . $wallet_category . '","' . $transaction_id . '","' . $w_desc . '","' . $cashback_record_id . '"');

							// wallet amont set zero
							$wallet_amount = 0;
							$user_wallet = $wallet_amount + $coupon_amount;
							$data['wallet_amount'] = $user_wallet;

							$update_toekn = $this -> conn -> updatetablebyid('user', 'user_id', $recharge_user_id, $data);
						}
					} else {
						$wallet_amount = 0;
						$user_wallet = $wallet_amount + $coupon_amount;
						$data['wallet_amount'] = $user_wallet;

						$update_toekn = $this -> conn -> updatetablebyid('user', 'user_id', $recharge_user_id, $data);
					}
					// Admin wallet update
					$admin_update_wallet = $admin_wallet + $recharge_amount;
					$data_admin['admin_wallet'] = $admin_update_wallet;
					$update_toekn = $this -> conn -> updatetablebyid('admin', 'admin_id', 1, $data_admin);
					if($recharge_category_id=='1'){
						$recharge_type= "Mobile";
					}else if($recharge_category_id=='2')
					{
						$recharge_type= "TV";
					}else if($recharge_category_id=='3')
					{
						$recharge_type= "Data";
					}
					if ($reffer_status == '2') 
						{
							$this->refferal_code($recharge_user_id,$reffer_user_id,$user_number,$wallet_amount);	
						}
				$this->recharge_mail($recharge_user_id,$operator_id,$recharge_number,$transaction_id,$recharge_amount,$recharge_type,$payment_gateway_type,'1');
					$this -> recharge_message($user_number, $recharge_amount, $transaction_id,$recharge_number,'1');
					$post = array("status" => "true", 'message' => "Recharge Successfully", "recharge_id" => $recharge, 'recharge_number' => $rec_number, 'recharge_amount' => $recharge_amount, 'wallet_used_amount' => $wallet_used_amount, 'card_used_amount' => $card_deduct_amount, 'wallet_amount' => $wallet_amount, 'transaction_id' => $payment_transaction_id,'electricity_prepaid_token'=>$electricity_token,'transaction_date' => date('F-d-Y h:i A',strtotime($current_date)),'transaction_ref'=>$trans_ref_no);
					//print_r($post);die;
				//	$this -> offer_mail($recharge_user_id);
				$this->free_offer_mail($recharge_user_id);
					
				} else {
					$post = array('status' => "false", "message" => "Recharge failed");
				}
			} else {
				$transaction_id = strtotime("now") . mt_rand(10, 99);
				$trans_id = $transaction_id;
				$recharge = $this -> conn -> insertnewrecords('wallet_transaction', 'wt_user_id, wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc,wt_status,payment_gateway_id,trans_ref_no', '"' . $recharge_user_id . '","' . $current_date . '","' . $wallet_type . '","' . $recharge_amount . '","' . $wt_category . '","' . $transaction_id . '","' . $wt_desc . '","3","' . $payment_transaction_id . '","'.$trans_ref_no.'"');

				$walletrecharge = $this -> conn -> insertnewrecords('recharge', 'recharge_transaction_id,recharge_user_id, rechage_category,operator_id,rechage_type,recharge_number,recharge_amount,recharge_date,recharge_status,payment_gateway_id', '"' . $transaction_id . '","' . $recharge_user_id . '","' . $recharge_category_id . '","' . $operator_id . '","' . $recharge_type_id . '","' . $recharge_number . '","' . $recharge_amount . '","' . $current_date . '","3","' . $payment_transaction_id . '"');

				// REfund money when paymemt deduct from paymnet gateway but recharge failed
				$data12['wallet_amount'] = $wallet_amount + $refund_amount;
				$update_wallet = $this -> conn -> updatetablebyid('user', 'user_id', $recharge_user_id, $data12);

				$transaction_id = strtotime("now") . mt_rand(10, 99);
				$refund_desc = "amount is refund for failed transaction of recharge";
				$recharge = $this -> conn -> insertnewrecords('wallet_transaction', 'wt_user_id, wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc,wt_status', '"' . $recharge_user_id . '","' . $current_date . '","' . $wallet_type . '","' . $refund_amount . '","3","' . $transaction_id . '","' . $refund_desc . '","1"');

				$data_refund['refund_status'] = 1;
				$data_refund['cashbackrecord_id'] = $transaction_id;
				$update_wallet = $this -> conn -> updatetablebyid('wallet_transaction', 'transaction_id', $trans_id, $data_refund);

				$this->recharge_mail($recharge_user_id,$operator_id,$recharge_number,$transaction_id,$recharge_amount,$recharge_type,$payment_gateway_type,'2');
					$this -> recharge_message($user_number, $recharge_amount, $transaction_id,$recharge_number,'2');
				$post = array('status' => "false", "message" => "Recharge failed", "recharge_id" => $recharge, 'recharge_number' => $rec_number, 'recharge_amount' => $recharge_amount, 'wallet_used_amount' => $wallet_used_amount, 'card_used_amount' => $card_deduct_amount, 'wallet_amount' => $wallet_amount, 'recharge_date' => date('F-d-Y h:i A',strtotime($current_date)), 'transaction_id' => $payment_transaction_id);
			}

		} else {
			$post = array('status' => "false", "message" => "Missing parameter", 'recharge_user_id' => $recharge_user_id, 'recharge_category_id' => $recharge_category_id, 'operator_id' => $operator_id, 'recharge_type_id' => $recharge_type_id, 'recharge_number' => $recharge_number, 'recharge_amount' => $recharge_amount);
		}
		
		echo $this -> json($post);

	}

	// Recharge from card///
	function recharge_from_card() {
		$payment_type 		=   $_REQUEST['payment_type'];  // 1-card,2-bank account
		$savecard_status	= 	$_REQUEST['savecard_status']; // 1- Save , 2 for not save
		$card_pay_type 		= 	$_REQUEST['card_pay_type'];   // 1-card, 2- card_token
		$coupon_id 			= 	$_REQUEST['coupon_id'];
		$coupon_amount 		= 	$_REQUEST['coupon_amount'];
		$recharge_user_id 	= 	$_REQUEST['recharge_user_id'];
		// verve card parameters
		$verve_card_status 	= 	$_REQUEST['verve_card_status'];
		$verve_card_pin 	= 	$_REQUEST['verve_card_pin'];

		
		$recharge_code		=	$_REQUEST['recharge_code'];  // for tv rechragre
		$customer_name		=	$_REQUEST['customer_name'];
		//$recharge_transaction_id=$_POST['recharge_transaction_id'];
		$recharge_category_id = $_REQUEST['recharge_category_id'];
		//1- Mobile,2-DTH
		$operator_id 		= $_REQUEST['operator_id'];
		$rec_number 		= $_REQUEST['recharge_number'];
		$recharge_number 	=  $_REQUEST['recharge_number'];
		$mobile_number 		= $_REQUEST['recharge_number'];
		$refund_amount 		= $_REQUEST['payment_gateway_amt'];
		$recharge_amount 	= $_REQUEST['recharge_amount'];
		//$trans_ref_no 		= $_REQUEST['trans_ref_no'];
		$wallet_type 		= 2;
		// 1- Credit, 2-Debit
		$recharge_status = 1;
		//$wt_category = '2';
		$wt_category = $_REQUEST['wt_category'];
		//  1-Add money,2-Recharge
		$wallet_category = '4';
		// 4- Cashback
		$current_date = date("Y-m-d H:i:s");
		if ($wt_category == '1') {
			$wt_desc = 'Add-Money';
		} else if ($wt_category == '2') {
			$wt_desc = 'Recharge';
		} else if ($wt_category == '3') {
			$wt_desc = 'Refund';
		}else if ($wt_category == '12') {
			$wt_desc = 'Electricity Bill';
		}
		if ($wallet_category == '4') {
			$w_desc = 'Cashback';
		}
		$card_no		=	$_REQUEST['card_no'];
		$expiry_month	=	$_REQUEST['expiry_month'];
		$expiry_year	=	$_REQUEST['expiry_year'];
		$cvv_no			=	$_REQUEST['cvv_no'];

		$recipient_bank	=	$_REQUEST['recipient_bank'];
		$rec_ac_no		=	$_REQUEST['recipient_account_number'];
		$sender_ac_no	=	sender_account_number;
		$sender_bank	=	sender_bank;
		$passcode		=	$_REQUEST['passcode'];
		$card_token		=	$_REQUEST['card_token'];
		
		if($payment_type == '1')
		{
			$transaction_via="Credit/Debit Card";
			if($card_pay_type=='1')
			{
				$pay = $this->payment_card($card_no,$expiry_month,$expiry_year,$cvv_no,$recharge_user_id,$recharge_amount,$savecard_status,$verve_card_status,$verve_card_pin,'1');

				// print_r($pay); exit;
				
			}else 
				if($card_pay_type=='2')
				{
					$records_cards = $this -> conn -> get_table_field_doubles('save_card_details', 'save_card_userid', $recharge_user_id, 'save_card_token', $card_token);
					
					$cardid		=	$records_cards[0]['card_id'];
					$cardtoken	=	$records_cards[0]['save_card_token'];
					$save_card_no	=	$records_cards[0]['save_card_no'];
					$cardfour_digit= substr($save_card_no, -4);
					$pay			=	$this->payment_card_token($cardfour_digit,$cardtoken,$cvv_no,$recharge_user_id,$recharge_amount,$cardid);
					
				}
		}
		else 
		if($payment_type == '2')
		{
				$transaction_via="Bank Account";
			$pay = $this->payment_bank($recipient_bank,$rec_ac_no,$sender_ac_no,$sender_bank,$passcode,$recharge_user_id,$recharge_amount);
		}

//	$pay	=	$this->payment_card($card_no,$expiry_month,$expiry_year,$cvv_no,$recharge_user_id,$refund_amount);
		$para						= explode("/", $pay);
		$status						= $para[0];
		
	 	$payment_transaction_id		= $para[1];
	 	$trans_ref_no				= $para[2];
		$data_store_id				= $para[3];
		if($status=='error')
		{
			$post = array('status' => "false", "message" => $payment_transaction_id,'transaction_date' => date('F-d-Y h:i A',strtotime($current_date)),'transaction_via'=>$transaction_via);
			echo $this -> json($post);
			exit();
		}
		$payment_gateway_type =$payment_type;  // 1-card,2-bank account
		if (!empty($recharge_user_id) && !empty($operator_id) && !empty($recharge_number) && !empty($recharge_amount)) {
			$records = $this -> conn -> get_table_row_byidvalue('user', 'user_id', $recharge_user_id);
			$wallet_amount 		= 	$records['0']['wallet_amount'];
			$user_number 		=	$records['0']['user_contact_no'];
			$reffer_status 		= 	$records['0']['reffer_amount_status'];
			$reffer_user_id 	= 	$records['0']['reffer_user_id'];
			$admin = $this -> conn -> get_all_records('admin');
			$admin_wallet 		= 	$admin['0']['admin_wallet'];
			$recharge_response 	= '';
			//	if($operator_id=='3'){
		//	$recharge_status = $this -> mobile_recharge_api($operator_id, $mobile_number, $recharge_amount);
		$recharge_status = $this -> mobile_recharge_api($operator_id, $recharge_number, $recharge_amount,$recharge_code,$customer_name);
		$biller_records = $this -> conn -> get_table_row_byidvalue('operator_list', 'operator_id', $operator_id);

		$operator_name 			= 	$biller_records['0']['operator_name'];
		$operator_code 			= 	$biller_records['0']['operator_code'];
		if ($operator_code == 'MTN') {
				if ($recharge_status == '100') {
					$recharge_response = '1';

				} else {
					$recharge_response = '2';
				}
			} else {
				$iparr = split("\,", $recharge_status);
				$recharge_response 	= $iparr[0];
				$transaction_id 	= $iparr[1];
				$electricity_token 	= $iparr[2];
			}
			if (!empty($transaction_id)) {
				$transaction_id 	= $transaction_id;
			} else {
				$transaction_id 	= strtotime("now") . mt_rand(10, 99);
			}
			//}
			if ($recharge_response == '1') {
				if(!empty($electricity_token))
				{
					$electricity_token=$electricity_token;
					
				}else{
					$electricity_token="";
				}
				$recharge = $this -> conn -> insertnewrecords('wallet_transaction', 'wt_user_id, wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc,payment_gateway_id,electrice_token_no,	payment_type,trans_ref_no,transaction_data_id', '"' . $recharge_user_id . '","' . $current_date . '","' . $wallet_type . '","' . $recharge_amount . '","' . $wt_category . '","' . $transaction_id . '","' . $wt_desc . '","' . $payment_transaction_id . '","' . $electricity_token . '","' . $payment_gateway_type . '","' . $trans_ref_no . '","'.$data_store_id.'"');

				if ($recharge) {
					$walletrecharge = $this -> conn -> insertnewrecords('recharge', 'recharge_transaction_id,recharge_user_id,rechage_category,operator_id,rechage_type,recharge_number,recharge_amount,recharge_date,recharge_status,payment_gateway_id,electrice_token_no', '"' . $transaction_id . '","' . $recharge_user_id . '","' . $recharge_category_id . '","' . $operator_id . '","' . $recharge_type_id . '","' . $recharge_number . '","' . $recharge_amount . '","' . $current_date . '","' . $recharge_status . '","' . $payment_transaction_id . '","' . $electricity_token . '"');

					//reffer amount when user first recharge then beifits add in frnd wallet
					

					$cashback_record_id = $recharge_number;
					if (!empty($coupon_id)) {
						$coupon_apply = $this -> conn -> insertnewrecords('coupon_details', 'coupon_id, user_id,coupon_apply_date', '"' . $coupon_id . '","' . $recharge_user_id . '","' . $current_date . '"');
						if (!empty($coupon_apply)) {
							
						$records_coupon = $this -> conn -> get_table_row_byidvalue('offer_coupon', 'coupon_id', $coupon_id);
						$coupon_count = $records_coupon['0']['coupon_limit'];
						if($coupon_count>0)
						{
							$data_coupon['coupon_limit'] = $coupon_count - 1;
							$update_toekn = $this -> conn -> updatetablebyid('offer_coupon', 'coupon_id', $coupon_id, $data_coupon);
						}
							
							$walletrecharge = $this -> conn -> insertnewrecords('wallet_transaction', 'wt_user_id,wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc,cashbackrecord_id', '"' . $recharge_user_id . '","' . $current_date . '","' . $wallet_type . '","' . $coupon_amount . '","' . $wallet_category . '","' . $transaction_id . '","' . $w_desc . '","' . $cashback_record_id . '"');
							$user_wallet = $wallet_amount + $coupon_amount;
							$data['wallet_amount'] = $user_wallet;

							$update_toekn = $this -> conn -> updatetablebyid('user', 'user_id', $recharge_user_id, $data);
						}
					}
					if ($reffer_status == '2') 
						{
							$this->refferal_code($recharge_user_id,$reffer_user_id,$user_number,$wallet_amount);	
						}
					// Admin wallet update
					$admin_update_wallet = $admin_wallet + $recharge_amount;
					$data_admin['admin_wallet'] = $admin_update_wallet;
					$update_toekn = $this -> conn -> updatetablebyid('admin', 'admin_id', 1, $data_admin);
					
					if($recharge_category_id=='1'){
						$recharge_type= "Mobile";
					}else if($recharge_category_id=='2')
					{
						$recharge_type= "TV";
					}else if($recharge_category_id=='3')
					{
						$recharge_type= "Data";
					}
					$this->recharge_mail($recharge_user_id,$operator_id,$recharge_number,$transaction_id,$recharge_amount,$recharge_type,$payment_gateway_type,'1');
					$this -> recharge_message($user_number, $recharge_amount, $transaction_id,$recharge_number,'1');
					$post1 = array('status' => 'true', 'message' => "Recharge Successfully","recharge_id" =>$recharge, 'recharge_number' => $rec_number, 'recharge_amount' => $recharge_amount, 'wallet_amount' => $wallet_amount,'transaction_id' => $payment_transaction_id,'electricity_prepaid_token'=>$electricity_token,'transaction_date' => date('F-d-Y h:i A',strtotime($current_date)),'transaction_ref'=>$trans_ref_no,'transaction_via'=>$transaction_via);
//$post=array('status'=>'true');
				
					echo $this -> json($post1);
					exit(0);
					$this->free_offer_mail($recharge_user_id);
				} else {
					$post = array('status' => "false", "message" => "Recharge failed");
				}

			} else {
				$transaction_id = strtotime("now") . mt_rand(10, 99);
				$trans_id = $transaction_id;
				$recharge = $this -> conn -> insertnewrecords('wallet_transaction', 'wt_user_id, wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc,wt_status,payment_gateway_id,trans_ref_no', '"' . $recharge_user_id . '","' . $current_date . '","' . $wallet_type . '","' . $recharge_amount . '","' . $wt_category . '","' . $payment_transaction_id . '","' . $wt_desc . '","3","' . $payment_transaction_id . '","' . $trans_ref_no . '"');

				$walletrecharge = $this -> conn -> insertnewrecords('recharge', 'recharge_transaction_id,recharge_user_id, rechage_category,operator_id,rechage_type,recharge_number,recharge_amount,recharge_date,recharge_status,payment_gateway_id', '"' . $payment_transaction_id . '","' . $recharge_user_id . '","' . $recharge_category_id . '","' . $operator_id . '","' . $recharge_type_id . '","' . $recharge_number . '","' . $recharge_amount . '","' . $current_date . '","3","' . $payment_transaction_id . '"');

				// REfund money when paymemt deduct from paymnet gateway but recharge failed
				$data12['wallet_amount'] = $wallet_amount + $refund_amount;
				$update_wallet = $this -> conn -> updatetablebyid('user', 'user_id', $recharge_user_id, $data12);

			//$transaction_id = strtotime("now") . mt_rand(10, 99);
				$refund_desc = "amount is refund for failed transaction of recharge";
				$refund_record = $this -> conn -> insertnewrecords('wallet_transaction', 'wt_user_id, wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc,wt_status', '"' . $recharge_user_id . '","' . $current_date . '","' . $wallet_type . '","' . $refund_amount . '","3","' . $payment_transaction_id . '","' . $refund_desc . '","1"');

				$data_refund['refund_status'] = 1;
				$data_refund['cashbackrecord_id'] = $transaction_id;
				$update_wallet = $this -> conn -> updatetablebyid('wallet_transaction', 'transaction_id', $payment_transaction_id, $data_refund);

$this->recharge_mail($recharge_user_id,$operator_id,$recharge_number,$payment_transaction_id,$recharge_amount,$recharge_type,$payment_gateway_type,'2');
					$this -> recharge_message($user_number, $recharge_amount, $payment_transaction_id,$recharge_number,'2');
				$post = array('status' => "false", "message" => "Recharge failed", "recharge_id" => $recharge, 'recharge_number' => $rec_number, 'recharge_amount' => $recharge_amount, 'wallet_amount' => $wallet_amount, 'transaction_id' => $payment_transaction_id, 'transaction_date' => date('F-d-Y h:i A',strtotime($current_date)),'transaction_ref'=>$trans_ref_no,'transaction_via'=>$transaction_via);
			}

		}else 
		{
$post = array('status' => "false", "message" => "Missing parameter", 'recharge_user_id' => $recharge_user_id, 'recharge_category_id' => $recharge_category_id, 'operator_id' => $operator_id, 'recharge_number' => $recharge_number, 'recharge_amount' => $recharge_amount);
		}
	echo $this -> json($post);
	}

	/// last recharge////

	function last_recharge() {
	
		$user_id = $_POST['user_id'];
		$recharge_category_id = $_POST['recharge_category_id'];
		if (!empty($user_id)) {
			$records = $this -> conn -> get_table_field_doubles_orderby('recharge', 'recharge_user_id', $user_id, 'rechage_category', $recharge_category_id, 'recharge_id', 'recharge_number', '3');
			
			if (!empty($records)) {
			
				foreach ($records as $value) {
					$recharge_id = $value['recharge_id'];
					$rechage_category = $value['rechage_category'];
					//1-Mobile,2-DTH
					$operator_id = $value['operator_id'];
					$operator_records = $this -> conn -> get_table_row_byidvalue('operator_list', 'operator_id', $operator_id);
					$operator_name = $operator_records['0']['operator_name'];
					$operator_image = operator_img_url . $operator_records['0']['operator_image'];
					$rechage_type = $value['rechage_type'];
					//1-Topup, 2-Special
					$recharge_number = $value['recharge_number'];
					$rec_num = $recharge_number;
					if (!empty($rec_num)) {
						$rec_num = $rec_num;
					} else {
						$rec_num = '';
					}
					$recharge_amount = $value['recharge_amount'];
					$recharge_status = $value['recharge_status'];
					$arr[] = array('user_id' => $user_id, 'recharge_id' => $recharge_id, 'rechage_category' => $rechage_category, 'operator_id' => $operator_id, 'rechage_type' => $rechage_type, 'recharge_number' => $rec_num, 'recharge_amount' => $recharge_amount, 'recharge_status' => $recharge_status, 'operator_name' => $operator_name, 'operator_image' => $operator_image);
				}

				$post = array('status' => "true", "Last Recharge" => $arr);

			} else {
				$post = array('status' => "false", "message" => "No Recharge found", 'user_id' => $user_id);
			}
		} else {
			$post = array('status' => "false", "message" => "Missing parameter", 'user_id' => $user_id);
		}
		echo $this -> json($post);
	}

	// Apply promocode//
	function apply_promocode() {
		$code = $_REQUEST['promo_code'];
		$user_id = $_REQUEST['user_id'];
		$records_coupon = $this -> conn -> get_table_field_doubles('offer_coupon', 'coupon_code', $code, 'coupon_status', 1);
		if (!empty($records_coupon)) {
			$amount = $records_coupon['0']['coupon_price'];
			$amount_price = $records_coupon['0']['coupon_minimum_price'];
			$coupon_id = $records_coupon['0']['coupon_id'];
			$coupon_code = $records_coupon['0']['coupon_code'];
			$coupon_limit = $records_coupon['0']['coupon_limit'];
			$coupon_expire_date = $records_coupon['0']['coupon_expire_date'];
			$current_date = date("Y-m-d");

			if (strcmp($coupon_code, $code) == 0) {
				if ($coupon_expire_date >= $current_date && $coupon_limit>0) {
					$user_record = $this -> conn -> get_table_field_doubles('coupon_details', 'coupon_id', $coupon_id, 'user_id', $user_id);
					if (!empty($user_record)) {
						$post = array('status' => "false", "message" => "This promocode is already used by you");
					} else {
						$post = array('status' => "true", "message" => "Promocode Applied successfully", 'coupon_id' => $coupon_id, 'coupon_amount' => $amount, 'amount_price' => $amount_price);
					}

				} else {
					$post = array('status' => "false", "message" => "Invalid promocode3");
				}
			} else {
				$post = array('status' => "false", "message" => "Invalid promocode2");
			}
		} else {
			$post = array('status' => "false", "message" => "Invalid promocode1");
		}
		echo $this -> json($post);
	}

	/// get operator name//
	function get_operator_name() {
		$operator_id = $_REQUEST['operator_id'];
		if (!empty($operator_id)) {
			$records = $this -> conn -> get_table_row_byidvalue('operator_list', 'operator_id', $operator_id);
			$operator_name = $records['0']['operator_name'];
			$post = array('status' => 'true', 'operator_name' => $operator_name);
		}
		echo $this -> json($post);
	}

	//// Share money from your wallet to another user////

	function transfer_money() {
		$user_id 	= 	$_REQUEST['user_id'];
		$mobile 	= 	$_REQUEST['mobile_no'];
		$amount 	= 	$_REQUEST['amount'];
		$mobile_no 	= 	$_REQUEST['mobile_no'];

		//$transaction_id= mt_rand( 10000000, 99999999);
		$wallet_type_main = 2;
		// amount debit in user self
		$wallet_type_frnd = 1;
		// amount credit in frnd
		$wallet_category_to = 5;
		// transfer money to
		$wallet_category_from = 10;
		// transfer money from
		$current_date = date("Y-m-d H:i:s");
		if (!empty($mobile)) {
			$user_records = $this -> conn -> get_table_row_byidvalue('user', 'user_id', $user_id);
			if (!empty($user_records)) {
				$main_wallet = $user_records['0']['wallet_amount'];
				$contact_number_main = $user_records['0']['user_contact_no'];
				// main user mobile number
				if ($main_wallet >= $amount) {
					$records = $this -> conn -> get_table_row_byidvalue('user', 'user_contact_no', $mobile);
					if (!empty($records)) {
						$contact_number_frnd = $records['0']['user_contact_no'];
						// frnd mobile number
						$frnd_wallet = $records['0']['wallet_amount'];
						$frnd_id = $records['0']['user_id'];
						if ($frnd_id != $user_id) {
							// amount transfer to another
						$transaction_id1 = strtotime("now") . mt_rand(10, 99);
							$w_to_desc = "Amount transfer to " . $contact_number_frnd;
							$wallet_to_transfer = $this -> conn -> insertnewrecords('wallet_transaction', 'wt_user_id,wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc,cashbackrecord_id', '"' . $user_id . '","' . $current_date . '","' . $wallet_type_main . '","' . $amount . '","' . $wallet_category_to . '","' . $transaction_id1 . '","' . $w_to_desc . '","' . $contact_number_frnd . '"');
							if (!empty($wallet_to_transfer)) {
								//amount recieved by transfer
								$transaction_id = strtotime("now") . mt_rand(10, 99);
								$w_by_desc = "Amount transfer from " . $contact_number_main;
								$wallet_by_transfer = $this -> conn -> insertnewrecords('wallet_transaction', 'wt_user_id,wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc,cashbackrecord_id', '"' . $frnd_id . '","' . $current_date . '","' . $wallet_type_main . '","' . $amount . '","' . $wallet_category_from . '","' . $transaction_id . '","' . $w_by_desc . '","' . $contact_number_main . '"');
							}
							if (!empty($wallet_by_transfer)) {
								$main_wallet_money = $main_wallet - $amount;
								$frnd_wallet_money = $frnd_wallet + $amount;
								// update main user wallet
								$data['wallet_amount'] = $main_wallet_money;
								$update_toekn = $this -> conn -> updatetablebyid('user', 'user_id', $user_id, $data);
								// update frnd wallet//
								$data1['wallet_amount'] = $frnd_wallet_money;
								$update_toekn = $this -> conn -> updatetablebyid('user', 'user_id', $frnd_id, $data1);
								$post = array('status' => 'true', 'message' => 'Transfer money successfully', 'main_user_id' => $user_id, 'main_wallet' => $main_wallet_money, 'frnd_wallet' => $frnd_wallet_money, 'frnd_id' => $frnd_id, 'transfer_mobile' => $mobile_no, 'transfer_amount' => $amount, 'transaction_id' => $transaction_id1, 'transaction_date' => date('F-d-Y h:i A',strtotime($current_date)));
							} else {
								$post = array('status' => "false", "message" => "Error in transfering amount");
							}

						} else {
							$post = array('status' => "false", "message" => "Please enter another user number");
						}
					} else {
						$post = array('status' => "false", "message" => "This user is not exist of given number");
					}

				} else {
					$post = array('status' => "false", "message" => "Wallet amount is not sufficent to transfer money");
				}
			} else {
				$post = array('status' => "false", "message" => "invalid user", 'user_id' => $user_id);
			}

		} else {
			$post = array('status' => "false", "message" => "missing parameter", 'user_id' => $user_id, 'amount' => $amount, 'mobile' => $moble);
		}
		echo $this -> json($post);
	}

	// .............Save pin..............///

	function save_pin() {
		$pin = $_REQUEST['user_transfer_pin'];
		$user_id = $_REQUEST['user_id'];
		$user_records = $this -> conn -> get_table_row_byidvalue('user', 'user_id', $user_id);
				$email_verify = $user_records[0]['user_email_verify'];
	   /*
	   if ($email_verify == '2') {
				   $post = array("status" => "false", "message" => "Please verify your email address");
				   echo $this -> json($post);
				   exit();
			   }*/
	   
		if (!empty($user_id) && ($pin)) {
			$records = $this -> conn -> get_table_row_byidvalue('save_pin', 'user_id', $user_id);
			if (!empty($records)) {
				
				$records_contact_no = $this -> conn -> get_table_field_doubles('save_pin', 'user_id', $user_id, 'user_transfer_pin', $pin);
				if (!empty($records_contact_no)) {
					$transfer_pin = $records_contact_no[0]['user_transfer_pin'];
					$post = array('status' => "true", 'user_id' => $user_id, 'user_transfer_pin' => $transfer_pin);
				} else {
					$post = array('status' => "false", 'message' => 'Please Enter a valid pin');
				}
			} else {
				$add_pin = $this -> conn -> insertnewrecords('save_pin', 'user_id, user_transfer_pin', '"' . $user_id . '","' . $pin . '"');
				if (!empty($add_pin)) {
					$data['user_pin_status'] = '1';
					$update_toekn = $this -> conn -> updatetablebyid('user', 'user_id', $user_id, $data);
					$post = array('status' => "true", 'user_id' => $user_id, 'user_transfer_pin' => $pin);
				}
			}

		} else {
			$post = array('status' => "false", "message" => "Missing parameter", 'user_id' => $user_id, 'transfer_pin' => $pin);
		}
		echo $this -> json($post);
	}

	// Add sms////
	function add_sms() {
		$user_id = $_REQUEST['user_id'];
		$sms_amount = $_REQUEST['sms_amount'];
		if (!empty($user_id) && !empty($sms_amount)) {
			$sms_status = '1';
			// 1- sms add success
			$sms_records = $this -> conn -> get_table_row_byidvalue('sms_plans', 'sms_plan_amount', $sms_amount);

			if (!empty($sms_records)) {
				$sms = $sms_records['0']['sms'];
				$current_date = date("Y-m-d H:i:s");
				$wallet_category = 7;
				// add sms
				$wallet_type = 2;
				// amount debit from wallet when u purches sms
				$user_records = $this -> conn -> get_table_row_byidvalue('user', 'user_id', $user_id);
				if (!empty($user_records)) {
					$main_wallet = $user_records['0']['wallet_amount'];
					$total_sms = $user_records['0']['total_sms'];
					$get_sms = $user_records['0']['get_sms'];
					$transaction_id = strtotime("now") . mt_rand(10, 99);
					$w_to_desc = $sms . " SMS added successfully";
					if ($main_wallet >= $sms_amount) {
						$wallet_sms = $this -> conn -> insertnewrecords('wallet_transaction', 'wt_user_id,wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc', '"' . $user_id . '","' . $current_date . '","' . $wallet_type . '","' . $sms_amount . '","' . $wallet_category . '","' . $transaction_id . '","' . $w_to_desc . '"');
						if (!empty($wallet_sms)) {

							$data1['wallet_amount'] = $main_wallet - $sms_amount;
							$data1['total_sms'] = $total_sms + $sms;
							// my totol sms get or transfer
							$data1['get_sms'] = $get_sms + $sms;
							// total sms get only sms purches or share by another
							$update_sms = $this -> conn -> updatetablebyid('user', 'user_id', $user_id, $data1);
							$post = array('status' => "true", "message" => "SMS Added successfully", 'user_id' => $user_id, 'sms_add' => $sms, 'remaining_sms' => $data1['total_sms'], 'total_sms' => $data1['get_sms'], 'wallet_amount' => $data1['wallet_amount']);

						} else {
							$post = array('status' => "false", "message" => "error in adding sms in your sms wallet");

						}
					} else {
						$post = array('status' => "false", "message" => "Wallet amount is not sufficent to transfer money");

					}
				}
			}
		} else {
			$post = array('status' => "false", "message" => "missing parameter", 'user_id' => $user_id, 'sms_amount' => $sms_amount);
		}
		echo $this -> json($post);
	}

	// sms plan//////
	function sms_plan() {
		$sms_records = $this -> conn -> get_table_row_byidvalue('sms_plans', 'sms_status', 1);
		foreach ($sms_records as $v) {
			$sms_id = $v['sms_plan_id'];
			$sms_plan_amount = $v['sms_plan_amount'];
			$sms = $v['sms'];

			$arr[] = array('sms_id' => $sms_id, 'sms_plan_amount' => $sms_plan_amount, 'sms' => $sms, 'message' => "You will get " . $sms . " SMS in this plan");

		}
		$post = array('status' => "true", "sms_details" => $arr);
		echo $this -> json($post);
	}

	// share money////

	function share_sms() {
		$user_id = $_REQUEST['user_id'];
		$mobile = $_REQUEST['mobile_no'];
		$share_sms = $_REQUEST['share_sms'];
		$mobile_no = $_REQUEST['mobile_no'];

		//$transaction_id= mt_rand( 10000000, 99999999);
		$wallet_type_main = 2;
		// amount debit in user self
		$wallet_type_frnd = 1;
		// amount credit in frnd
		$wallet_category = 8;
		// share sms

		$current_date = date("Y-m-d H:i:s");
		if (!empty($mobile)) {
			$user_records = $this -> conn -> get_table_row_byidvalue('user', 'user_id', $user_id);
			if (!empty($user_records)) {
				$total_sms = $user_records['0']['total_sms'];
				$contact_number_main = $user_records['0']['user_contact_no'];
				// main user mobile number
				if ($total_sms >= $share_sms) {
					$records = $this -> conn -> get_table_row_byidvalue('user', 'user_contact_no', $mobile);
					if (!empty($records)) {
						$contact_number_frnd = $records['0']['user_contact_no'];
						// frnd mobile number
						$frnd_sms = $records['0']['total_sms'];
						$frnd_get_sms = $records['0']['get_sms'];
						$frnd_id = $records['0']['user_id'];
						if ($frnd_id != $user_id) {
							// amount transfer to another
						$transaction_id = strtotime("now") . mt_rand(10, 99);
							$w_to_desc = "SMS share to " . $contact_number_frnd;
							$wallet_to_transfer = $this -> conn -> insertnewrecords('wallet_transaction', 'wt_user_id,wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc,cashbackrecord_id', '"' . $user_id . '","' . $current_date . '","' . $wallet_type_main . '","' . $share_sms . '","' . $wallet_category . '","' . $transaction_id . '","' . $w_to_desc . '","' . $contact_number_frnd . '"');
							if (!empty($wallet_to_transfer)) {
								//amount recieved by transfer
							$transaction_id = strtotime("now") . mt_rand(10, 99);
								$w_by_desc = "SMS share from " . $contact_number_main;
								$wallet_by_transfer = $this -> conn -> insertnewrecords('wallet_transaction', 'wt_user_id,wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc,cashbackrecord_id', '"' . $frnd_id . '","' . $current_date . '","' . $wallet_type_main . '","' . $share_sms . '","' . $wallet_category . '","' . $transaction_id . '","' . $w_by_desc . '","' . $contact_number_main . '"');
							}
							if (!empty($wallet_by_transfer)) {
								$main_sms = $total_sms - $share_sms;
								$frnd_sms = $frnd_sms;
								// update main user wallet
								$data['total_sms'] = $main_sms;

								$update_toekn = $this -> conn -> updatetablebyid('user', 'user_id', $user_id, $data);
								// update frnd wallet//
								$data1['total_sms'] = $frnd_sms + $share_sms;
								$data1['get_sms'] = $frnd_get_sms + $share_sms;
								$update_toekn = $this -> conn -> updatetablebyid('user', 'user_id', $frnd_id, $data1);
								$post = array('status' => 'true', 'message' => 'SMS share successfully', 'main_user_id' => $user_id, 'main_user_sms' => $main_sms, 'frnd_sms' => $frnd_sms, 'frnd_id' => $frnd_id);
							} else {
								$post = array('status' => "false", "message" => "Error in shareing sms");
							}

						} else {
							$post = array('status' => "false", "message" => "Please enter another user number");
						}
					} else {
						$post = array('status' => "false", "message" => "This user is not exist of given number");
					}

				} else {
					$post = array('status' => "false", "message" => "Sms amount is not sufficent to share sms");
				}
			} else {
				$post = array('status' => "false", "message" => "invalid user", 'user_id' => $user_id);
			}

		} else {
			$post = array('status' => "false", "message" => "missing parameter", 'user_id' => $user_id, 'amount' => $share_sms, 'mobile' => $moble);
		}
		echo $this -> json($post);
	}

	/// function of show  list of biller category////////
	function biller_category() {
		$records = $this -> conn -> get_table_row_byidvalue('biller_category', 'biller_category_status', 1);
		if (!empty($records)) {
			foreach ($records as $v) {
				$biller_category_id = $v['biller_category_id'];
				$biller_category_name = $v['biller_category_name'];
				$biller_type = $v['category'];
				// frnd mobile number
				$biller_category_logo = biller_category_logo . $v['biller_category_logo'];
				$posts[] = array('biller_category_id' => $biller_category_id, "biller_category_name" => $biller_category_name, 'biller_category_logo' => $biller_category_logo,'biller_type'=>$biller_type);
			}
			$post = array('status' => 'true', 'biller_category' => $posts);
		} else {
			$post = array('status' => "false", "message" => "Coming soon");
		}
		echo $this -> json($post);
	}

	//// function to given biller from category according/////
	function bill_service_provider() {
		$biller_category = $_REQUEST['biller_category'];
		$records_type = $this -> conn -> get_table_row_byidvalue('biller_category', 'biller_category_id', $biller_category);
		$biller_type=$records_type[0]['category'];
		if (!empty($biller_category)) {
			//$records = $this -> conn -> get_table_row_byidvalue('biller_details', 'biller_category_id', $biller_category);
			$records = $this -> conn -> get_record_in('biller_details', 'biller_category_id', $biller_category);
			//print_r($records);die;
		//	$biller_in_id = 'biller_user.biller_customer_id_no';
//$records = $this -> conn -> join_two_table('biller_category', 'biller_details', 'biller_category_id', 'biller_category_id', 'biller_category.biller_category_id', $biller_category);
			if ($records) {
				foreach ($records as $v) {

					$biller_id = $v['biller_id'];
					$biller_category_id = $v['biller_category_id'];
					
					
					$biller_name = $v['biller_name'];
					$biller_contact_no = $v['biller_contact_no'];
					$biller_email = $v['biller_email'];
					$biller_company_name = $v['biller_company_name'];
					$biller_company_logo = biller_company_logo . $v['biller_company_logo'];

					$post1[] = array('biller_id' => $biller_id, "biller_name" => $biller_name, 'biller_contact_no' => $biller_contact_no, "biller_email" => $biller_email, 'biller_company_name' => $biller_company_name, 'company' => (string)$biller_company_name, "biller_company_logo" => $biller_company_logo, 'biller_category_id' => $biller_category,'biller_type'=>$biller_type);
				}
				$post = array('status' => "true", "service_provider" => $post1);
			} else {
				$post = array('status' => "false", "message" => "No Service Provider Found");
			}
		} else {
			$post = array('status' => "false", "message" => "Missing Parameter", 'biller_category_id' => $biller_category);
		}
		echo $this -> json($post);
	}
	///  function to check consumer of bill///

	function get_consumer_details() {
		$invoice_no = $_REQUEST['bill_invoice_no'];
		$biller_id = $_REQUEST['biller_id'];
		if (!empty($invoice_no) && !empty($biller_id)) {
		//	$biller_in_id = 'biller_user.bill_invoice_no';
			//$records_consumer = $this -> conn -> join_two_table_where_two_field('biller_user', 'biller_details', 'biller_id', 'biller_id', $biller_in_id, $consumer_no, 'biller_user.biller_id', $biller_id);
			$records_consumer =$this -> conn ->get_record_in('biller_user', 'bill_invoice_no', $invoice_no);
			if (!empty($records_consumer)) {
				$biller_id  				= $records_consumer[0]['biller_id'];
				$biller_customer_id 		= $records_consumer[0]['biller_customer_id_no'];
				$bill_amount  				= $records_consumer[0]['bill_amount'];
				$bill_due_date  			= $records_consumer[0]['bill_due_date'];
				$biller_user_email  		= $records_consumer[0]['biller_user_email'];
				$biller_user_name  			= $records_consumer[0]['biller_user_name'];
				$biller_user_contact_no 	= $records_consumer[0]['biller_user_contact_no'];
				$bill_pay_status 			= $records_consumer[0]['bill_pay_status'];
				$bill_invoice_no 			= $records_consumer[0]['bill_invoice_no'];
				$bill_description 			= $records_consumer[0]['bill_description'];
				$current_date 				= date("Y-m-d");
				if ($bill_due_date >= $current_date) {
					if ($bill_pay_status == '1') {
						$post = array('status' => "false", "message" => "Bill already paid");
					} else {
						$biller_records = $this -> conn -> get_table_row_byidvalue('biller_details', 'biller_id', $biller_id);
						$biller_company = $biller_records['0']['biller_company_name'];
						$biller_name    = $biller_records['0']['biller_name'];
						$biller_address = $biller_records['0']['biller_address'];
						$biller_company_logo = biller_company_logo . $biller_records[0]['biller_company_logo'];

						$products =$this->conn->get_table_row_byidvalue('biller_invoice_products', 'biller_invoice_no',$invoice_no);
						$pr=array();
						if(!empty($products))
						{
							$total=0;
							foreach ($products as $value) {
								$qty 	=	$value['biller_invoice_product_qty'];
								$name 	=	$value['biller_invoice_product_name'];
								$price  =	$value['biller_invoice_product_price'];
								$total += 	$qty*$price;
								$pr[] 	=	array('product_name'=>$name,'product_qty'=>$qty,'product_price'=>$price,'total'=>$total);
								$total=0;
							}
						}
						$post = array('status' => 'true', "biller_id" => $biller_id, 'biller_company' => $biller_company, 'biller_logo' => $biller_company_logo, 'consumer_name' => $biller_user_name, 'consumer_id' => $bill_invoice_no, 'bill_amount' => $bill_amount, 'due_date' => $bill_due_date, 'consumer_email' => $biller_user_email, 'consumer_contact_no' => $biller_user_contact_no, 'bill_pay_status' => $bill_pay_status, 'bill_invoice_no' => $bill_invoice_no,'biller_name'=>$biller_name,'biller_address'=>$biller_address,'products'=>$pr,'bill_description'=>$bill_description);
					}
				} else {
					$post = array('status' => "false", "message" => "Bill Paid date is expired");
				}
			} else {
				$post = array('status' => "false", "message" => "No Bill Found from this consumer no");
			}
		} else {
			$post = array('status' => "false", "message" => "Missing Parameter", 'consumer_no' => $consumer_no, 'biller_id' => $biller_id);
		}
		echo $this -> json($post);

	}

	/// bill recharge function //////

	function bill_recharge() 
	{
		$coupon_id 			= 	$_REQUEST['coupon_id'];
		$coupon_amount  	= 	$_REQUEST['coupon_amount'];
		$recharge_user_id 	= 	$_REQUEST['recharge_user_id'];
		$wt_category 		= 	$_REQUEST['wt_category'];
		// wt_category = 11 pay bill
		$bill_category_id 	= 	$_REQUEST['bill_category_id'];
		// 1- Water, 2- Movies etc
		$biller_id 			= 	$_REQUEST['biller_id'];
		$bill_amount 		=	$_REQUEST['bill_amount'];
		$invoice_no 		= 	$_REQUEST['bill_invoice_no'];
		$wallet_type 		= 	2;
		// 1- Credit, 2-Debit
		$bill_pay_status 	= 	1;

		$wallet_category 	= 	'4';
		// 4- Cashback
		$current_date 		= 	date("Y-m-d H:i:s");

		if ($wt_category == '11') {
			$wt_desc = 'PaY Bill';
		}

		if (!empty($invoice_no) && !empty($bill_amount) && !empty($recharge_user_id)) {
		
			$bill_records =$this -> conn ->get_record_in('biller_user', 'bill_invoice_no', $invoice_no);
			if (!empty($bill_records)) {
				$biller_id 				= 	$bill_records['0']['biller_id'];
				$bill_user_id 			= 	$bill_records['0']['biller_user_id'];
				$bill_pay_status 		= 	$bill_records['0']['bill_pay_status'];
				if ($bill_pay_status == '2') {

					$records 			= $this -> conn -> get_table_row_byidvalue('user', 'user_id', $recharge_user_id);
					$wallet_amount 		= $records['0']['wallet_amount'];
					$user_number 		= $records['0']['user_contact_no'];
					$admin 				= $this -> conn -> get_all_records('admin');
					$admin_wallet 		= $admin['0']['admin_wallet'];
					$transaction_id 	= strtotime("now") . mt_rand(10, 99);
					$reffer_status 		= $records['0']['reffer_amount_status'];
					$reffer_user_id 	= $records['0']['reffer_user_id'];
					if ($wallet_amount >= $bill_amount) {
						//$transaction_id='5454';
						$recharge = $this -> conn -> insertnewrecords('wallet_transaction', 'wt_user_id, wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc', '"' . $recharge_user_id . '","' . $current_date . '","' . $wallet_type . '","' . $bill_amount . '","' . $wt_category . '","' . $transaction_id . '","' . $wt_desc . '"');

						if ($recharge) {
								
							$walletrecharge = $this -> conn -> insertnewrecords('bill_recharge', 'bill_user_id,bill_transaction_id,bill_category_id, biller_id,bill_consumer_no,bill_amount,bill_pay_date,bill_pay_status,bill_invoice_no', '"' . $recharge_user_id . '","' . $payment_transaction_id . '","' . $bill_category_id . '","' . $biller_id . '","' . $bill_consumer_no . '","' . $bill_amount . '","' . $current_date . '","1","' . $invoice_no . '"');

							// change status of bill///
							if (!empty($walletrecharge)) {

								$data_frnd['bill_pay_status'] = 1;
								$data_frnd['bill_paid_date'] = $current_date;
								$update_toekn = $this -> conn -> updatetablebyid('biller_user', 'biller_user_id', $bill_user_id, $data_frnd);

							}

							//reffer amount when user first recharge then beifits add in frnd wallet
						
							$cashback_record_id = $recharge_number;
							if (!empty($coupon_id)) {

								$coupon_apply = $this -> conn -> insertnewrecords('coupon_details', 'coupon_id, user_id,coupon_apply_date', '"' . $coupon_id . '","' . $recharge_user_id . '","' . $current_date . '"');
								if (!empty($coupon_apply)) {
									$transaction_id = strtotime("now") . mt_rand(10, 99);

									$walletrecharge = $this -> conn -> insertnewrecords('wallet_transaction', 'wt_user_id,wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc,cashbackrecord_id', '"' . $recharge_user_id . '","' . $current_date . '","' . $wallet_type . '","' . $coupon_amount . '","' . $wallet_category . '","' . $transaction_id . '","' . $w_desc . '","' . $cashback_record_id . '"');
								}
							}
							$user_wallet = $wallet_amount - $bill_amount + $coupon_amount;
							$data['wallet_amount'] = $user_wallet;

							$update_toekn = $this -> conn -> updatetablebyid('user', 'user_id', $recharge_user_id, $data);
							// Admin wallet update
							$admin_update_wallet = $admin_wallet + $bill_amount - $coupon_amount;
							$data_admin['admin_wallet'] = $admin_update_wallet;
							$update_toekn = $this -> conn -> updatetablebyid('admin', 'admin_id', 1, $data_admin);
						if ($reffer_status == '2') 
						{
							$this->refferal_code($recharge_user_id,$reffer_user_id,$user_number,$wallet_amount);	
						}
							$res = file_get_contents(SITE_URL . "createpdf/pdf/" . $invoice_no."/".$biller_id);
							$this->send_bill_user_msg($user_number,$res,$bill_consumer_no,$bill_amount);
							$this->free_offer_mail($recharge_user_id);
							$post = array("status" => "true", 'message' => "Bill Pay Successfully", "bill_recharge_id" => $recharge, 'consumer_no' => $invoice_no, 'bill_amount' => $bill_amount, 'wallet_amount' => $user_wallet ,'transaction_date'=>date('F-d-Y h:i A',strtotime($current_date)),'transaction_id'=>$transaction_id);
						} else {
							$post = array('status' => "false", "message" => "Pay bill failed",'transaction_date'=>date('F-d-Y h:i A',strtotime($current_date)),'transaction_id'=>$transaction_id);
						}
					} else {
						$pay_amount = $recharge_amount - $wallet_amount;
						$post = array('status' => "false", "message" => "Not sufficent amount in  your wallet", 'wallet_amount' => $wallet_amount, 'bill_amount' => $bill_amount, 'payble_amount' => $pay_amount,'transaction_date'=>date('F-d-Y h:i A',strtotime($current_date)),'transaction_id'=>$transaction_id);
						echo $this -> json($post);
						exit();
					}

				} else {
					$post = array('status' => "false", "message" => "These Bill already paid");
				}
			}
		} else {
			$post = array('status' => "false", "message" => "Missing parameter", 'recharge_user_id' => $recharge_user_id, 'bill_category_id' => $bill_category_id, 'biller_id' => $biller_id, 'wt_category' => $wt_category, 'consumer_no' => $invoice_no, 'bill_amount' => $bill_amount);
		}
		echo $this -> json($post);
	}

	function pdf() {

		$bill_consumer_no = $_REQUEST['bill_consumer_no'];
			$res = file_get_contents(SITE_URL . "createpdf/pdf/" . $bill_consumer_no."/".$biller_id);
	}

	// Bill pay from card
	function bill_pay_from_card() {
		$coupon_id = $_REQUEST['coupon_id'];
		$coupon_amount = $_REQUEST['coupon_amount'];
		$recharge_user_id = $_REQUEST['recharge_user_id'];
		$wt_category = $_REQUEST['wt_category'];
		// wt_category = 11 pay bill
		$bill_category_id = $_REQUEST['bill_category_id'];
		// 1- Water, 2- Movies etc
		$biller_id = $_REQUEST['biller_id'];
		$bill_amount = $_REQUEST['bill_amount'];
		$invoice_no = $_REQUEST['bill_invoice_no'];
		$wallet_type = 2;
		// 1- Credit, 2-Debit
		$bill_pay_status = 1;
		$wallet_category = '4';
		// 4- Cashback
		$current_date = date("Y-m-d H:i:s");
		$wt_desc = 'PaY Bill';
		if (!empty($invoice_no) && !empty($biller_id) && !empty($bill_amount) && !empty($recharge_user_id)) {
		$bill_records =$this -> conn ->get_record_in('biller_user', 'bill_invoice_no', $invoice_no);
	if (!empty($bill_records)) 
	{
		$bill_consumer_no	=	$bill_records[0]['biller_customer_id_no'];
		$payment_type 		=   $_REQUEST['payment_type'];  // 1-card,2-bank account
		$savecard_status	= 	$_REQUEST['savecard_status']; // 1- Save , 2 for not save
		$card_pay_type 		= 	$_REQUEST['card_pay_type'];   // 1-card, 2- card_token
		$card_no			=	$_REQUEST['card_no'];
		$expiry_month		=	$_REQUEST['expiry_month'];
		$expiry_year		=	$_REQUEST['expiry_year'];
		$cvv_no				=	$_REQUEST['cvv_no'];

		$recipient_bank		=	$_REQUEST['recipient_bank'];
		$rec_ac_no			=	$_REQUEST['recipient_account_number'];
		$sender_ac_no		=	sender_account_number;
		$sender_bank		=	sender_bank;
		$passcode			=	$_REQUEST['passcode'];
		$rec_ac_no			=	$_REQUEST['recipient_account_number'];
		$card_token			=	$_REQUEST['card_token'];
		if($payment_type == '1')
		{
			if($card_pay_type=='1')
			{
				$pay = $this->payment_card($card_no,$expiry_month,$expiry_year,$cvv_no,$recharge_user_id,$bill_amount,$savecard_status,$verve_card_status,$verve_card_pin,'1');
			}else 
				if($card_pay_type=='2')
				{
					$records_cards = $this -> conn -> get_table_field_doubles('save_card_details', 'save_card_userid', $recharge_user_id, 'save_card_token', $card_token);
					$cardid			=	$records_cards[0]['card_id'];
					$cardtoken		=	$records_cards[0]['save_card_token'];
					$save_card_no	=	$records_cards[0]['save_card_no'];
					$cardfour_digit = substr($save_card_no, -4);
					$pay			=	$this->payment_card_token($cardfour_digit,$cardtoken,$cvv_no,$recharge_user_id,$bill_amount,$cardid);
				}
		}
		else 
		if($payment_type == '2')
		{
			$pay = $this->payment_bank($recipient_bank,$rec_ac_no,$sender_ac_no,$sender_bank,$passcode,$recharge_user_id,$bill_amount);
		}
		$para							= explode("/", $pay);
		$status							= $para[0];
		
		$payment_transaction_id			= $para[1];
		$trans_ref_no					= $para[2];
		$data_store_id					= $para[3];
		if($status=='error')
		{
			$post = array('status' => "false", "message" => $payment_transaction_id,'transaction_date'=>date('F-d-Y h:i A',strtotime($current_date)),'transaction_id'=>$payment_transaction_id,'transaction_ref_no'=>$trans_ref_no);
			echo $this -> json($post);
			exit();
		}
				$payment_gateway_type =	$payment_type;  // 1-card,2-bank account
				$bill_user_id 		  = $bill_records['0']['biller_user_id'];
				$bill_pay_status 	  = $bill_records['0']['bill_pay_status'];
				if ($bill_pay_status == '2') {
					$records = $this -> conn -> get_table_row_byidvalue('user', 'user_id', $recharge_user_id);
					$wallet_amount = $records['0']['wallet_amount'];
					$user_number = $records['0']['user_contact_no'];
					$reffer_status = $records['0']['reffer_amount_status'];
					$reffer_user_id = $records['0']['reffer_user_id'];
					$admin = $this -> conn -> get_all_records('admin');
					$admin_wallet = $admin['0']['admin_wallet'];
					$transaction_id = strtotime("now") . mt_rand(10, 99);
					$recharge = $this -> conn -> insertnewrecords('wallet_transaction', 'wt_user_id, wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc,trans_ref_no,payment_gateway_id,payment_type', '"' . $recharge_user_id . '","' . $current_date . '","' . $wallet_type . '","' . $bill_amount . '","' . $wt_category . '","' . $payment_transaction_id . '","' . $wt_desc . '","' . $trans_ref_no . '","' . $payment_transaction_id . '","' . $payment_gateway_type . '"');

					if ($recharge) {
						$walletrecharge = $this -> conn -> insertnewrecords('bill_recharge', 'bill_user_id,bill_transaction_id,bill_category_id, biller_id,bill_consumer_no,bill_amount,bill_pay_date,bill_pay_status,bill_invoice_no', '"' . $recharge_user_id . '","' . $payment_transaction_id . '","' . $bill_category_id . '","' . $biller_id . '","' . $bill_consumer_no . '","' . $bill_amount . '","' . $current_date . '","1","' . $invoice_no . '"');

						if (!empty($walletrecharge)) {

							$data_frnd['bill_paid_date'] = $current_date;
							$data_frnd['bill_pay_status'] = 1;
							$update_toekn = $this -> conn -> updatetablebyid('biller_user', 'biller_user_id', $bill_user_id, $data_frnd);

						}

						//reffer amount when user first recharge then beifits add in frnd wallet
					
						$cashback_record_id = $recharge_number;
						if (!empty($coupon_id)) {

							$coupon_apply = $this -> conn -> insertnewrecords('coupon_details', 'coupon_id, user_id,coupon_apply_date', '"' . $coupon_id . '","' . $recharge_user_id . '","' . $current_date . '"');
							if (!empty($coupon_apply)) {

								$walletrecharge = $this -> conn -> insertnewrecords('wallet_transaction', 'wt_user_id,wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc,cashbackrecord_id', '"' . $recharge_user_id . '","' . $current_date . '","' . $wallet_type . '","' . $coupon_amount . '","' . $wallet_category . '","' . $transaction_id . '","' . $w_desc . '","' . $cashback_record_id . '"');
								$user_wallet = $wallet_amount + $coupon_amount;
								$data['wallet_amount'] = $user_wallet;

								$update_toekn = $this -> conn -> updatetablebyid('user', 'user_id', $recharge_user_id, $data);
							}
						}
						if ($reffer_status == '2') 
						{
						$this->refferal_code($recharge_user_id,$reffer_user_id,$user_number,$wallet_amount);	
						}
						$this->free_offer_mail($recharge_user_id);
						// Admin wallet update
						$admin_update_wallet = $admin_wallet + $recharge_amount;
						$data_admin['admin_wallet'] = $admin_update_wallet;
						$update_toekn = $this -> conn -> updatetablebyid('admin', 'admin_id', 1, $data_admin);
							$res = file_get_contents(SITE_URL . "createpdf/pdf/" . $bill_consumer_no."/".$biller_id);
							$this->send_bill_user_msg($user_number,$res,$bill_consumer_no,$bill_amount);
						$post = array("status" => "true", 'message' => "Bill Paid Successfully", "bill_recharge_id" => $recharge, 'consumer_no' => $bill_consumer_no,'bill_invoice_no'=>$invoice_no, 'bill_amount' => $bill_amount, 'wallet_amount' => $wallet_amount, 'transaction_id' => $payment_transaction_id,'transaction_date' => date('F-d-Y h:i A',strtotime($current_date)),'transaction_ref'=>$trans_ref_no);
					} else {
						$post = array('status' => "false", "message" => "Pay Bill failed",'transaction_date'=>date('F-d-Y h:i A',strtotime($current_date)),'transaction_id'=>$payment_transaction_id,'transaction_ref_no'=>$trans_ref_no);
					}

				} else {
					$post = array('status' => "false", "message" => "These Bill already paid");
				}
			}
		} else {
			$post = array('status' => "false", "message" => "Missing parameter", 'recharge_user_id' => $recharge_user_id, 'bill_category_id' => $bill_category_id, 'biller_id' => $biller_id, 'wt_category' => $wt_category, 'consumer_no' => $bill_consumer_no, 'bill_amount' => $bill_amount, 'bill_invoice_no' => $invoice_no);
		}
		echo $this -> json($post);

	}

	// bill pay from card with wallet///
	function bill_pay_card_with_wallet() {
		$coupon_id = $_REQUEST['coupon_id'];
		$coupon_amount = $_REQUEST['coupon_amount'];
		$recharge_user_id = $_REQUEST['recharge_user_id'];
		$wt_category = $_REQUEST['wt_category'];
		// wt_category = 11 pay bill
		$bill_category_id = $_REQUEST['bill_category_id'];
		// 1- Water, 2- Movies etc
		$biller_id = $_REQUEST['biller_id'];
		$bill_amount = $_REQUEST['bill_amount'];
		$invoice_no = $_REQUEST['bill_invoice_no'];
	//	$bill_consumer_no = $_REQUEST['bill_consumer_no'];
		$wallet_type = 2;
		// 1- Credit, 2-Debit
		$bill_pay_status = 1;
		$current_date = date("Y-m-d H:i:s");
		$wt_desc = 'PaY Bill';
		if (!empty($bill_amount) && !empty($biller_id) && !empty($bill_amount) && !empty($recharge_user_id)) {
			//$bill_records = $this -> conn -> get_table_row_byidvalue('biller_user', 'biller_customer_id_no', $bill_consumer_no);
			$bill_records =$this -> conn ->get_record_in('biller_user', 'bill_invoice_no', $invoice_no);
	if (!empty($bill_records)) 
	{
		$bill_consumer_no	=	$bill_records[0]['biller_customer_id_no'];
		$payment_type 		=   $_REQUEST['payment_type'];  // 1-card,2-bank account
		$savecard_status	= 	$_REQUEST['savecard_status']; // 1- Save , 2 for not save
		$card_pay_type 		= 	$_REQUEST['card_pay_type'];   // 1-card, 2- card_token
		$card_no			=	$_REQUEST['card_no'];
		$expiry_month		=	$_REQUEST['expiry_month'];
		$expiry_year		=	$_REQUEST['expiry_year'];
		$cvv_no				=	$_REQUEST['cvv_no'];

		$recipient_bank		=	$_REQUEST['recipient_bank'];
		$rec_ac_no			=	$_REQUEST['recipient_account_number'];
		$sender_ac_no		=	sender_account_number;
		$sender_bank		=	sender_bank;
		$passcode			=	$_REQUEST['passcode'];
		$rec_ac_no			=	$_REQUEST['recipient_account_number'];
		$card_token			=	$_REQUEST['card_token'];
		if($payment_type == '1')
		{
			if($card_pay_type=='1')
			{
				$pay = $this->payment_card($card_no,$expiry_month,$expiry_year,$cvv_no,$recharge_user_id,$bill_amount,$savecard_status,$verve_card_status,$verve_card_pin,'1');
			}else 
				if($card_pay_type   == '2')
				{
					$records_cards  = $this -> conn -> get_table_field_doubles('save_card_details', 'save_card_userid', $user_id, 'save_card_token', $card_token);
					$cardid			=	$records_cards[0]['card_id'];
					$cardtoken		=	$records_cards[0]['save_card_token'];
					$save_card_no	=	$records_cards[0]['save_card_no'];
					$cardfour_digit = substr($save_card_no, -4);
					$pay			=	$this->payment_card_token($cardfour_digit,$cardtoken,$cvv_no,$recharge_user_id,$bill_amount,
						$cardid);
				}
		}
		else 
		if($payment_type == '2')
		{
			$pay = $this->payment_bank($recipient_bank,$rec_ac_no,$sender_ac_no,$sender_bank,$passcode,$recharge_user_id,$bill_amount);
		}
		$para					    = explode("/", $pay);
		$status					    = $para[0];
		
		$payment_transaction_id		= $para[1];
		$trans_ref_no				= $para[2];
		$data_store_id				= $para[3];
		if($status=='error')
		{
			$post = array('status' => "false", "message" => $payment_transaction_id,'transaction_date'=>date('F-d-Y h:i A',strtotime($current_date)),'transaction_id'=>$payment_transaction_id,'transaction_ref_no'=>$trans_ref_no);
			echo $this -> json($post);
			exit();
		}
				$payment_gateway_type =$payment_type;  // 1-card,2-bank account
				$bill_user_id = $bill_records['0']['biller_user_id'];
				$bill_pay_status = $bill_records['0']['bill_pay_status'];
				if ($bill_pay_status == '2') {
					$records = $this -> conn -> get_table_row_byidvalue('user', 'user_id', $recharge_user_id);
					$wallet_amount = $records['0']['wallet_amount'];
					$wallet_used_amount = $records['0']['wallet_amount'];
					$reffer_status = $records['0']['reffer_amount_status'];
					$reffer_user_id = $records['0']['reffer_user_id'];
					$card_deduct_amount = $bill_amount - $wallet_amount;
					$user_number = $records['0']['user_contact_no'];
					$admin = $this -> conn -> get_all_records('admin');
					$admin_wallet = $admin['0']['admin_wallet'];
					$recharge = $this -> conn -> insertnewrecords('wallet_transaction', 'wt_user_id, wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc,user_wallet_rec_amount,user_card_card_rec_amount,trans_ref_no', '"' . $recharge_user_id . '","' . $current_date . '","' . $wallet_type . '","' . $bill_amount . '","' . $wt_category . '","' . $payment_transaction_id . '","' . $wt_desc . '","' . $wallet_amount . '","' . $card_deduct_amount . '","' . $trans_ref_no . '"');

					if ($recharge) {
						$walletrecharge = $this -> conn -> insertnewrecords('bill_recharge', 'bill_user_id,bill_transaction_id,bill_category_id, biller_id,bill_consumer_no,bill_amount,bill_pay_date,bill_pay_status,bill_invoice_no', '"' . $recharge_user_id . '","' . $payment_transaction_id . '","' . $bill_category_id . '","' . $biller_id . '","' . $bill_consumer_no . '","' . $bill_amount . '","' . $current_date . '","1","' . $invoice_no . '"');

						if (!empty($walletrecharge)) {

							$data_frnd['bill_paid_date'] = $current_date;
							$data_frnd['bill_pay_status'] = 1;
							$update_toekn = $this -> conn -> updatetablebyid('biller_user', 'biller_user_id', $bill_user_id, $data_frnd);

						}

						//reffer amount when user first recharge then beifits add in frnd wallet
						
						$cashback_record_id = $recharge_number;
						if (!empty($coupon_id)) {

							$coupon_apply = $this -> conn -> insertnewrecords('coupon_details', 'coupon_id, user_id,coupon_apply_date', '"' . $coupon_id . '","' . $recharge_user_id . '","' . $current_date . '"');
							if (!empty($coupon_apply)) {

								$walletrecharge = $this -> conn -> insertnewrecords('wallet_transaction', 'wt_user_id,wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc,cashbackrecord_id', '"' . $recharge_user_id . '","' . $current_date . '","' . $wallet_type . '","' . $coupon_amount . '","' . $wallet_category . '","' . $transaction_id . '","' . $w_desc . '","' . $cashback_record_id . '"');
								$this->free_offer_mail($recharge_user_id);
								// wallet amont set zero
								$wallet_amount = 0;
								$user_wallet = $wallet_amount + $coupon_amount;
								$data['wallet_amount'] = $user_wallet;

								$update_toekn = $this -> conn -> updatetablebyid('user', 'user_id', $recharge_user_id, $data);
							}
						} else {
							$wallet_amount = 0;
							$user_wallet = $wallet_amount + $coupon_amount;
							$data['wallet_amount'] = $user_wallet;

							$update_toekn = $this -> conn -> updatetablebyid('user', 'user_id', $recharge_user_id, $data);
						}
						if ($reffer_status == '2') 
						{
						$this->refferal_code($recharge_user_id,$reffer_user_id,$user_number,$wallet_amount);	
						}
						// Admin wallet update
						$admin_update_wallet = $admin_wallet + $recharge_amount;
						$data_admin['admin_wallet'] = $admin_update_wallet;
						$update_toekn = $this -> conn -> updatetablebyid('admin', 'admin_id', 1, $data_admin);
							$res = file_get_contents(SITE_URL . "createpdf/pdf/" . $bill_consumer_no."/".$biller_id);
							$this->send_bill_user_msg($user_number,$res,$bill_consumer_no,$bill_amount);
						$post = array("status" => "true", 'message' => "Bill Paid Successfully", "recharge_id" => $recharge, 'recharge_number' => $rec_number, 'bill_amount' => $bill_amount, 'wallet_used_amount' => $wallet_used_amount, 'card_used_amount' => $card_deduct_amount, 'wallet_amount' => $wallet_amount, 'transaction_id' => $payment_transaction_id,'transaction_date' => date('F-d-Y h:i A',strtotime($current_date)),'transaction_ref'=>$trans_ref_no);
					} else {
						$post = array('status' => "false", "message" => "bill pay failed",'transaction_date'=>date('F-d-Y h:i A',strtotime($current_date)),'transaction_id'=>$payment_transaction_id,'transaction_ref_no'=>$trans_ref_no);
					}
				} else {
					$post = array('status' => "false", "message" => "These Bill already paid");
				}
			}

		} else {
			$post = array('status' => "false", "message" => "Missing parameter", 'recharge_user_id' => $recharge_user_id, 'bill_category_id' => $bill_category_id, 'biller_id' => $biller_id, 'wt_category' => $wt_category, 'consumer_no' => $bill_consumer_no, 'bill_amount' => $bill_amount);
		}
		echo $this -> json($post);

	}

	//--function became a biller--///
	function biller_registration() {
		$user_id 				= 	$_REQUEST['user_id'];
		$company_name 			= 	$_REQUEST['company_name'];
		$company_reg_no 		= 	$_REQUEST['company_reg_no'];
		$rc_no 					= 	$_REQUEST['rc_no'];
		$tin_no 				= 	$_REQUEST['tin_no'];
		$bussiness_phone 		= 	$_REQUEST['bussiness_phone'];
		$bussiness_address 		=	$_REQUEST['bussiness_address'];
		$biller_name 			= 	$_REQUEST['biller_name'];
		$biller_email 			= 	$_REQUEST['biller_email'];
		$biller_category_id 	= 	$_REQUEST['biller_category_id'];
		$biller_reg_type 		= 	'2';
		$image 					= 	$_FILES['bussiness_logo']['name'];
		$current_date 			=   date("Y-m-d H:i:s");
		$biller_status 			= 	'2';
		//--1 approved, 2- pending
		if (!empty($company_name) && ($company_reg_no)  && !empty($bussiness_phone) && !empty($biller_name) && !empty($biller_name) && !empty($_FILES['bussiness_logo']['name']) && !empty($user_id)) {
			$biller_records = $this -> conn -> get_table_row_byidvalue('biller_details', 'biller_email', $biller_email);
			if (empty($biller_records)) {

					$user_image 	= 	'';
				if ($_FILES['bussiness_logo']['name']) {
					$user_image 	= $_FILES['bussiness_logo']['name'];
				}
					$attachment 	= $_FILES['bussiness_logo']['name'];

				if (!empty($attachment)) {
					$file_extension = explode(".", $_FILES["bussiness_logo"]["name"]);
					$new_extension 	= strtolower(end($file_extension));
					$today 			= time();
					$custom_name 	= "bussiness_logo" . $today;
					$file_name 		= $custom_name . "." . $new_extension;

					if ($new_extension == 'png' || $new_extension == 'jpeg' || $new_extension == 'jpg' || $new_extension == 'bmp') {
						move_uploaded_file($_FILES['bussiness_logo']['tmp_name'], "../uploads/biller_company_logo/" . $file_name);
						$biller_company_logo = $file_name;
					}
					$original_pass 	= rand('10000000', '99999999');
					$biller_pass 	= md5($original_pass);
					$biller_insert 	= $this -> conn -> insertnewrecords('biller_details', 'biller_category_id,biller_name,biller_email,company_reg_no,rc_no,tin_no,biller_address,biller_contact_no,biller_company_name,biller_company_logo,biller_created_date,biller_status,biller_reg_type,biller_password,biller_original_pass', '"' . $biller_category_id . '","' . $biller_name . '","' . $biller_email . '","' . $company_reg_no . '","' . $rc_no . '","' . $tin_no . '","' . $bussiness_address . '","' . $bussiness_phone . '","' . $company_name . '","' . $biller_company_logo . '","' . $current_date . '","' . $biller_status . '","' . $biller_reg_type . '","' . $biller_pass . '","' . $original_pass . '"');

					if (!empty($biller_insert)) {
						$data_admin['biller_id'] 		= $biller_insert;
						$data_admin['biller_status'] 	= 2;
						$update_toekn 					= $this -> conn -> updatetablebyid('user', 'user_id', $user_id, $data_admin);
						$post = array('status' => "true", "message" => "Biller added successfully, please wait for admin approval.");
					} else {
						$post = array('status' => "false", "message" => "Technical server error");
					}
				}
			} else {
				$post = array('status' => "false", "message" => "These Bussiness email already exist");
			}
		} else {
			$post = array('status' => "false", "message" => "Missing parameter", 'company_name' => $company_name, 'company_reg_no' => $company_reg_no, 'rc_no' => $rc_no, 'tin_no' => $tin_no, 'bussiness_phone' => $bussiness_phone, 'biller_name' => $biller_name, 'biller_email' => $biller_email, 'image' => $image, 'user_id' => $user_id, 'biller_category_id' => $biller_category_id);
		}
		echo $this -> json($post);
	}

	//-- function change app biller status---
	function check_biller_status() {
		$user_id = $_REQUEST['user_id'];
		if (!empty($user_id)) {
			$biller_records 	= $this -> conn -> get_table_row_byidvalue('user', 'user_id', $user_id);
			if (!empty($biller_records)) {
				$biller_status 	= $biller_records[0]['biller_status'];
				$user_id        = $biller_records[0]['user_id'];
				$biller_id      = $biller_records[0]['biller_id'];
				$post           = array('status' => "true", "biller_status" => $biller_status, 'user_id' => $user_id, 'biller_id' => $biller_id);
			} else {
				$post = array('status' => "false", "message" => "Invalid user id");
			}
		} else {
			$post = array('status' => "false", "message" => "Missing parameter", 'user_id' => $user_id);
		}
		echo $this -> json($post);
	}
// add biller products
	function biller_add_product()
	{
		if(!empty($_REQUEST['biller_id']) && !empty($_REQUEST['product_name']) && !empty($_REQUEST['product_code'])&& !empty($_REQUEST['product_price'])&& !empty($_REQUEST['product_desc']))
		{
			$biller_id 			=	$_REQUEST['biller_id'];
			$product_name 		=	$_REQUEST['product_name'];
			$product_code 		=	$_REQUEST['product_code'];
			$product_price 		=	$_REQUEST['product_price'];
			$product_desc 		=	$_REQUEST['product_desc'];
			$current_date 		= 	date("Y-m-d H:i:s");
			$product_record 	= 	$this -> conn -> get_table_field_doubles('biller_produt', 'product_code', $product_code,'biller_id',$biller_id);
			if(empty($product_record))
			{
				$addbiller_product 	= 	$this -> conn -> insertnewrecords('biller_produt', 'biller_id,product_name,product_code,product_price,product_desc,product_created_date', '"' . $biller_id . '","' . $product_name . '","' . $product_code . '","' . $product_price . '","' . $product_desc . '","' . $current_date . '"');
				if($addbiller_product)
				{
					$post           = array('status' => "true", "message" => 'Products add successfully');
				}else{
					$post           = array('status' => "false", "message" => 'Error in add product');
				}
			}else{
			$post           = array('status' => "false", "message" => 'These Product already exist');
			}
			
		}else{
			$post 			= array('status'=>'false','message'=>'missing parameter','biller_id'=>$_REQUEST['biller_id'],'product_name'=>$_REQUEST['product_name'],'product_code'=>$_REQUEST['product_code'],'product_price'=>$_REQUEST['product_price'],'product_desc'=>$_REQUEST['product_desc']);
		}
		echo $this -> json($post);
	}
	function biller_product() {
		$biller_id = $_REQUEST['biller_id'];
		if (!empty($biller_id)) {
			$records = $this -> conn -> get_table_row_byidvalue('biller_produt', 'biller_id', $biller_id);

			if ($records) {
				foreach ($records as $v) {
					$biller_id 		= $v['biller_id'];
					$product_id 	= $v['product_id'];
					$product_name 	= $v['product_name'];
					$product_code 	= $v['product_code'];
					$product_price 	= $v['product_price'];
					$post1[] 		= array('biller_id' => $biller_id, "product_id" => $product_id, 'product_name' => $product_name, 'product_code' => $product_code,'product_price'=>$product_price);
				}
				$post = array('status' => "true", "product_list" => $post1);
			} else {
				$post = array('status' => "false", "message" => "No Record Found");
			}
		} else {
			$post = array('status' => "false", "message" => "Missing parameter", 'biller_id' => $biller_id);
		}
		echo $this -> json($post);
	}

	//--- function create invoice---///
	function create_invoice() {

		$biller_id 				= $_REQUEST['biller_id'];
		$category_id 			= $_REQUEST['biller_category_id'];
		$consumer_name 			= $_REQUEST['consumer_name'];
		$invoice_no 			= $_REQUEST['invoice_no'];
		$consumer_no 			= $_REQUEST['consumer_no'];
		$consumer_email 		= $_REQUEST['consumer_email'];
		$consumer_contact_no 	= $_REQUEST['consumer_contact_no'];
		$bill_amount 			= $_REQUEST['bill_amount'];
		$bill_product_id 		= $_REQUEST['bill_product_id']; // recive json of invoice products
		$product_record 		= json_decode($bill_product_id);
		if(!empty($bill_product_id))
		{
			for($i=0;$i<count($product_record);$i++)
			{
				$productid[] 		=	$product_record[$i]->product_id;
				$productname[] 		= 	$product_record[$i]->product_name;
			}
				$bill_product_id 	= implode(",", $productid);
				$bill_product_name 	= implode(",", $productname);
		}else
		{
				$bill_product_id 		= '';
				$bill_product_name 		= '';
		}
		
		
		$bill_desc 			= $_REQUEST['bill_desc'];
		$current_date 		= date("Y-m-d H:i:s");
		$timestamp 			= strtotime($_REQUEST['bill_last_date']);
		$bill_last_date 	= date("Y-m-d", $timestamp);

		if (!empty($biller_id) && !empty($consumer_name) && !empty($invoice_no) && !empty($consumer_no) && !empty($consumer_email) && !empty($consumer_contact_no) && !empty($bill_amount) && !empty($bill_last_date) && !empty($bill_desc)) {

			$bill_records = $this -> conn -> get_table_row_byidvalue('biller_user', 'bill_invoice_no', $invoice_no);
			if (empty($bill_records)) 
			{
				$bill_insert = $this->conn->insertnewrecords('biller_user', 'biller_id,biller_user_name,biller_customer_id_no,bill_description,bill_amount,bill_invoice_no,bill_invoice_date,bill_due_date,biller_user_email,biller_user_contact_no,bill_product_id,bill_product_name,biller_category_id', '"' . $biller_id . '","' . $consumer_name . '","' . $consumer_no . '","' . $bill_desc . '","' . $bill_amount . '","' . $invoice_no . '","' . $current_date . '","' . $bill_last_date . '","' . $consumer_email . '","' . $consumer_contact_no . '","' . $bill_product_id . '","' . $bill_product_name . '","' . $category_id . '"');
		
		if(!empty($bill_product_id))
		{
			for($i=0;$i<count($product_record);$i++)
			{
				$product_id 		=	$product_record[$i]->product_id;
				$product_price 		= 	$product_record[$i]->product_price;
				$product_quantity 	= 	$product_record[$i]->product_quantity;
				$product_name 		= 	$product_record[$i]->product_name;
				$product_insert 	= 	$this -> conn -> insertnewrecords('biller_invoice_products', 'biller_invoice_no,biller_invoice_id,biller_invoice_product_id,biller_invoice_product_name,biller_invoice_product_qty,biller_invoice_datetime,biller_invoice_product_price', '"'.$invoice_no.'","'.$bill_insert.'","'.$product_id.'","'.$product_name.'","'.$product_quantity.'","'.$current_date.'","'.$product_price.'"');
				
			}
		}
		
				if (!empty($bill_insert)) {
					$res = file_get_contents(SITE_URL . "createpdf/create_pdf/" . $invoice_no);
					$this->send_bill_user_msg($consumer_no,$res,$invoice_no,$bill_amount);
					$post = array('status' => "true", "message" => "Invoice create successfully", 'bill_id' => $bill_insert);
				} else {
					$post = array('status' => "false", "message" => "");
				}

			} else {
				$post = array('status' => "false", "message" => "These Invoice already exist");
			}

		} else {
			$post = array('status' => "false", "message" => "Missing parameter");
		}
		echo $this -> json($post);
	}
    // get invoice details 
    function get_invoice_details()
    {
    	if(!empty($_REQUEST['biller_id']) && !empty($_REQUEST['consumer_number']))
    	{
    		$biller_id  	 =	$_REQUEST['biller_id'];
    		$consumer_no 	 =	$_REQUEST['consumer_number'];
    		$consumer_record = $this -> conn -> get_table_field_doubles('biller_user', 'biller_id', $biller_id,'biller_customer_id_no',$consumer_no);
    		if (!empty($consumer_record)) 
    		{
				$consumer_name 	= $consumer_record[0]['biller_user_name'];
				$product_id 	= $consumer_record[0]['bill_product_id'];
				$product_name 	= $consumer_record[0]['bill_product_name'];
				$consumer_email = $consumer_record[0]['biller_user_email'];
				$consumer_number= $consumer_record[0]['biller_user_contact_no'];
				$post = array('status' => 'true', 'consumer_no' => $consumer_no, 'consumer_no' => $consumer_no, 'consumer_name' => $consumer_name, 'product_id' => $product_id, 'product_name' => $product_name, 'consumer_email' => $consumer_email, 'consumer_number' => $consumer_number);
			}
			else 
			{
				$post = array('status' => 'false', 'message' => "No Record Found");
			}
    	}else{
    		$post = array('status' => 'false', 'message' => "Missing parameter",'biller_id'=>$_REQUEST['biller_id'],'consumer_number'=>$_REQUEST['consumer_number']);
    	}
    	echo $this -> json($post);
    }
	///--- function check_operator....
	function check_operator() {
		$mobile_no = $_REQUEST['mobile'];
		$mob=substr($mobile_no,1);
		$series = str_split($mob, 3);
		$series_num = $series[0];
		$operator_records = $this -> conn -> get_table_row_byidvalue('number_series', 'series', $series_num);
		$operator_id = $operator_records[0]['operator_id'];
		$operator_list = $this -> conn -> get_table_row_byidvalue('operator_list', 'operator_id', $operator_id);
		if (!empty($operator_list)) {
			$operator_name = $operator_list[0]['operator_name'];
			$operator_id = $operator_list[0]['operator_id'];
			$operator_image = operator_img_url . $operator_list[0]['operator_image'];
			$response = array('status' => 'true', 'operator_id' => $operator_id, 'operator_name' => $operator_name, 'operator_image' => $operator_image);
		} else {
			$response = array('status' => 'false', 'message' => "No Record Found");
		}

		echo $this -> json($response);
	}
	
	function promotional_offer_terms()
	{
		if(!empty($_REQUEST['free_offer_id']))
		{
			
		$offer_id=$_REQUEST['free_offer_id'];
		$coupon_list = $this -> conn -> get_table_row_byidvalue('free_coupon_list', 'free_coupon_id', $offer_id);
	//print_r($coupon_list);die;
		if (!empty($coupon_list)) {
		
					$coupon_terms = strip_tags(html_entity_decode($coupon_list[0]['coupon_terms'], ENT_QUOTES, 'UTF-8'));
				$post = array('status' => "true",'coupon_terms'=>$coupon_terms);
				
				}else{
					$post = array('status' => "false");
				}
			echo $this -> json($post);
	     }
	} 
// function promotional offer
	function promotional_offer()
	{
		if(!empty($_REQUEST['user_id']))
		{
			
		$user_id=$_REQUEST['user_id'];
		$coupon_list = $this -> conn -> get_table_row_byidvalue('free_coupon_list', 'coupon_status', '1');
		if (!empty($coupon_list)) {
			foreach ($coupon_list as $v) {
					$free_coupon_id = $v['free_coupon_id'];
					$free_coupon_category_name = $v['fee_coupon_category_id'];
					$coupon_name = $v['coupon_name'];
					$coupon_type=$v['coupon_type'];
					$coupon_amount = $v['coupon_amount'];
					if(!empty($coupon_amount))
					{
						$coupon_amount=$coupon_amount;
					}else{
						$coupon_amount='0';
					}
					$coupon_terms = strip_tags(html_entity_decode($v['coupon_terms'], ENT_QUOTES, 'UTF-8'));
					$coupon_img = coupon_img.'/'.$v['coupon_img'];
					$coupon_description = strip_tags(html_entity_decode($v['coupon_description'], ENT_QUOTES, 'UTF-8'));
					$post1[] = array('coupon_id'=> $free_coupon_id, 'free_coupon_category_id' => $free_coupon_category_name, 'coupon_name' => $coupon_name, 'coupon_img' => $coupon_img, 'coupon_description' => $coupon_description,'coupon_status'=>$coupon_type,'coupon_amount'=>$coupon_amount,'coupon_terms'=>$coupon_terms);
				}
			$coupon_list = $this -> conn -> join_two_table('add_cart_offer','free_coupon_list','cart_offer_id','free_coupon_id', 'cart_user_id', $user_id);
				foreach ($coupon_list as $v) 
				{
					$cart_user_id = $v['cart_user_id'];
					$free_coupon_id = $v['cart_offer_id'];
					$free_coupon_category_name = $v['fee_coupon_category_id'];
					$coupon_name = $v['coupon_name'];
					$coupon_type=$v['coupon_type'];
					$coupon_amount = $v['coupon_amount'];
					if(!empty($coupon_amount))
					{
						$coupon_amount=$coupon_amount;
					}else{
						$coupon_amount='';
					}
					$coupon_img = coupon_img.'/'.$v['coupon_img'];
					$coupon_description = strip_tags(html_entity_decode($v['coupon_description'], ENT_QUOTES, 'UTF-8'));
					$coupon_terms = strip_tags(html_entity_decode($v['coupon_terms'], ENT_QUOTES, 'UTF-8'));
					$post12[] = array('user_id'=>$cart_user_id,'coupon_id'=> $free_coupon_id, 'free_coupon_category_id' => $free_coupon_category_name, 'coupon_name' => $coupon_name, 'coupon_img' => $coupon_img, 'coupon_description' => $coupon_description,'coupon_terms'=>$coupon_terms);
				}
				if(!empty($post12))
				{
					$post12=$post12;
				}else{
					$post12=array();
				}
				$post = array('status' => "true", "coupon_list" => $post1,'user_coupon_list'=>$post12);
		} else {
			$post = array('status' => 'false', 'message' => "No Record Found");
		}
}else{
		
			$post = array('status' => "false", "message" => "Missing parameter",'user_id'=>$_REQUEST['user_id']);
		}

		echo $this -> json($post);
	}
// function add cart_promotinal_offer
	function add_cart_promotional_offer()
	{
		if(!empty($_REQUEST['user_id']) && !empty($_REQUEST['offer_id']))
		{
			$user_id=$_REQUEST['user_id'];
			$offer_id=$_REQUEST['offer_id'];
			$offer_records = $this -> conn -> get_table_row_byidvalue('add_cart_offer', 'cart_user_id', $user_id);
			if(empty($offer_records))
			{
				$record = $this -> conn -> insertnewrecords('add_cart_offer', 'cart_user_id,cart_offer_id', '"' . $user_id . '","' . $offer_id . '"');
				
			}else{
				//$delete_records = $this -> conn -> deletedataintablebytwocol('add_cart_offer', 'cart_user_id', $user_id,'cart_offer_id',$offer_id);
				$data_admin['cart_offer_id'] =$offer_id;
						$update_toekn = $this -> conn -> updatetablebyid('add_cart_offer', '	cart_user_id', $user_id, $data_admin);
			}
				
					$user_id=$_REQUEST['user_id'];
					$offer_id=$_REQUEST['offer_id'];
					$coupon_list = $this -> conn -> join_two_table('add_cart_offer','free_coupon_list','cart_offer_id','free_coupon_id', 'cart_user_id', $user_id);
				foreach ($coupon_list as $v) 
				{
					$cart_user_id = $v['cart_user_id'];
					$free_coupon_id = $v['cart_offer_id'];
					$free_coupon_category_name = $v['fee_coupon_category_id'];
					$coupon_name = $v['coupon_name'];
					$coupon_type=$v['coupon_type'];
					$coupon_amount = $v['coupon_amount'];
					if(!empty($coupon_amount))
					{
						$coupon_amount=$coupon_amount;
					}else{
						$coupon_amount='0';
					}
	$coupon_terms = strip_tags(html_entity_decode($v['coupon_terms'], ENT_QUOTES, 'UTF-8'));
					$coupon_img = coupon_img.'/'.$v['coupon_img'];
					$coupon_description = strip_tags(html_entity_decode($v['coupon_description'], ENT_QUOTES, 'UTF-8'));
					$post1[] = array('user_id'=>$cart_user_id,'coupon_id'=> $free_coupon_id, 'free_coupon_category_id' => $free_coupon_category_name, 'coupon_name' => $coupon_name, 'coupon_img' => $coupon_img, 'coupon_description' => $coupon_description,'coupon_status'=>$coupon_type,'coupon_amount'=>$coupon_amount,'coupon_terms'=>$coupon_terms);
				}
				$post = array('status' => "true", "coupon_list" => $post1);
				
			
		
		}else{
			$post = array('status' => "false", "message" => "Missing parameter");
		}		
		echo $this -> json($post);
	}
function remove_offer_cart()
{
	if(!empty($_REQUEST['user_id']) && !empty($_REQUEST['offer_id']))
		{
			$user_id=$_REQUEST['user_id'];
			$offer_id=$_REQUEST['offer_id'];
			$offer_records = $this -> conn -> get_table_field_doubles('add_cart_offer', 'cart_user_id', $user_id,'cart_offer_id',$offer_id);
			if(!empty($offer_records))
			{
			
				$delete_records = $this -> conn -> deletedataintablebytwocol('add_cart_offer', 'cart_user_id', $user_id,'cart_offer_id',$offer_id);
			}
				
					$user_id=$_REQUEST['user_id'];
					$offer_id=$_REQUEST['offer_id'];
					$coupon_list = $this -> conn -> join_two_table('add_cart_offer','free_coupon_list','cart_offer_id','free_coupon_id', 'cart_user_id', $user_id);
				foreach ($coupon_list as $v) 
				{
					$cart_user_id = $v['cart_user_id'];
					$free_coupon_id = $v['cart_offer_id'];
					$free_coupon_category_name = $v['fee_coupon_category_id'];
					$coupon_name = $v['coupon_name'];
					$coupon_type=$v['coupon_type'];
					$coupon_amount = $v['coupon_amount'];
					if(!empty($coupon_amount))
					{
						$coupon_amount=$coupon_amount;
					}else{
						$coupon_amount='0';
					}
					$coupon_terms = strip_tags(html_entity_decode($v['coupon_terms'], ENT_QUOTES, 'UTF-8'));
					$coupon_img = coupon_img.'/'.$v['coupon_img'];
					$coupon_description = strip_tags(html_entity_decode($v['coupon_description'], ENT_QUOTES, 'UTF-8'));
					$post1[] = array('user_id'=>$cart_user_id,'coupon_id'=> $free_coupon_id, 'free_coupon_category_id' => $free_coupon_category_name, 'coupon_name' => $coupon_name, 'coupon_img' => $coupon_img, 'coupon_description' => $coupon_description,'coupon_status'=>$coupon_type,'coupon_amount'=>$coupon_amount,'coupon_terms'=>$coupon_terms);
				}
				$post = array('status' => "true", "coupon_list" => $post1);
				
			
		
		}else{
			$post = array('status' => "false", "message" => "Missing parameter");
		}		
		echo $this -> json($post);
}
	function user_promotional_offer_list()
	{
		if(!empty($_REQUEST['user_id']))
		{
			$user_id=$_REQUEST['user_id'];
			$coupon_list = $this -> conn -> join_two_table('add_cart_offer','free_coupon_list','cart_offer_id','free_coupon_id', 'cart_user_id', $user_id);
				foreach ($coupon_list as $v) 
				{
					$cart_user_id = $v['cart_user_id'];
					$free_coupon_id = $v['cart_offer_id'];
					$free_coupon_category_name = $v['fee_coupon_category_id'];
					$coupon_name = $v['coupon_name'];
					$coupon_type=$v['coupon_type'];
					$coupon_amount = $v['coupon_amount'];
					if(!empty($coupon_amount))
					{
						$coupon_amount=$coupon_amount;
					}else{
						$coupon_amount='0';
					}
					$coupon_img = coupon_img.'/'.$v['coupon_img'];
					$coupon_description = strip_tags(html_entity_decode($v['coupon_description'], ENT_QUOTES, 'UTF-8'));
					$coupon_terms = strip_tags(html_entity_decode($v['coupon_terms'], ENT_QUOTES, 'UTF-8'));
					$post1[] = array('user_id'=>$cart_user_id,'coupon_id'=> $free_coupon_id, 'free_coupon_category_id' => $free_coupon_category_name, 'coupon_name' => $coupon_name, 'coupon_img' => $coupon_img, 'coupon_description' => $coupon_description,'coupon_status'=>$coupon_type,'coupon_amount'=>$coupon_amount,'coupon_terms'=>$coupon_terms);
				}
				$post = array('status' => "true", "coupon_list" => $post1);
				
		}
		else{
			$post = array('status' => "false", "message" => "Missing parameter",'user_id'=>$_REQUEST['user_id']);
		}
		echo $this -> json($post);
	}
	// function recharge api function////
	function recharge_dstv()
	{
		$operator_id=$_REQUEST['operator_id'];
		$mobile=$_REQUEST['mobile'];
		$amount=$_REQUEST['amount'];
		$recharge_code=$_REQUEST['recharge_code'];
		$customer_name=$_REQUEST['cust_name'];
		$this->mobile_recharge_api($operator_id,$mobile,$amount,$recharge_code,$customer_name);
	}
	function mobile_recharge_api($operator_id, $mobile, $amount,$recharge_code,$customer_name) {
		
		$rec_code=explode(',', $recharge_code);
		if(count($rec_code)>1)
		{
			$recharge_code = $rec_code;
		}else{
			$recharge_code=$recharge_code;
		}
		
	
		$operator_id = $operator_id;
		$mobile1 = $mobile;
		$amount = $amount;
		$biller_records = $this -> conn -> get_table_row_byidvalue('operator_list', 'operator_id', $operator_id);

		$operator_name = $biller_records['0']['operator_name'];
		$operator_code = $biller_records['0']['operator_code'];
		if ($operator_code == 'MTN' || $operator_code == 'VISAF') 
	{

			$userid = '08092230991';
			// $pass = '01fa320f4048f4fa51a34';
			$pass = '51902151a313343975367';
			$url = "http://mobileairtimeng.com/httpapi/?userid=$userid&pass=$pass&network=15&phone=$mobile1&amt=$amount";
			$str = file_get_contents($url);

			$sdk = explode("|", $str);
			$pos = $sdk[0];
			return $pos;
		} 
		/*
		else if ($operator_code == 'ETST' || $operator_code == 'AIRT' || $operator_code == 'Glo' || $operator_code == 'VISAF') {
		
					
		
					ini_set("soap.wsdl_cache_enabled", "0");
					$a = array("trace" => 1, "exceptions" => 1);
					$wsdl = "http://202.140.50.116/EstelServices/services/EstelServices?wsdl";
					$client = new SoapClient($wsdl, $a);
					$simpleresult = $client -> getTopup(array("agentCode" => 'TPR_EFF', "mpin" => 'ECE473FF47C2E97FF3F1D496271A9EB1', "destination" => $mobile1, "amount" => $amount, "productCode" => $operator_code, "comments" => "topup", "agenttransid" => '1234', "type" => 'PC'));
		
					$soaoresponce = $client -> __getLastResponse();
		
					$xml = simplexml_load_string($soaoresponce, NULL, NULL, "http://schemas.xmlsoap.org/soap/envelope/");
					$ns = $xml -> getNamespaces(true);
					$soap = $xml -> children($ns['soapenv']);
					$agentCode = $soap -> Body -> children($ns['topupRequestReturn']) -> children($ns['ns1']) -> agentCode;
					$productcode = $soap -> Body -> children($ns['topupRequestReturn']) -> children($ns['ns5']) -> productcode;
					$destination = $soap -> Body -> children($ns['topupRequestReturn']) -> children($ns['ns6']) -> destination;
					$agenttransid = $soap -> Body -> children($ns['topupRequestReturn']) -> children($ns['ns8']) -> agenttransid;
					$amount = $soap -> Body -> children($ns['topupRequestReturn']) -> children($ns['ns9']) -> amount;
					$transid = $soap -> Body -> children($ns['topupRequestReturn']) -> children($ns['ns12']) -> transid;
					$resultdescription = $soap -> Body -> children($ns['topupRequestReturn']) -> children($ns['ns26']) -> resultdescription;
		
					if ($resultdescription[0] == 'Transaction Successful') {
						//echo "transid=".$transid[0].'<br>';
						$recharge_status = '1';
						$transaction_id = $transid[0];
						$result = $recharge_status . "," . $transid[0];
						//$result=array("recharge_status"=>$recharge_status,'transaction_id'=>$transid[0]);
					} else {
						$result = "2" . "0";
					}
					return $result;
				}*/
		
     // corncone api for recharge==================//////////////////==========
		else if($operator_code == 'AQA' || $operator_code == 'AWA' || $operator_code == 'AQC' || $operator_code == 'ANA'||  $operator_code == 'ANB'||  $operator_code == 'APA' || $operator_code == 'AEA' || $operator_code == 'ACA' || $operator_code == 'APB'  || $operator_code == "ADA"|| $operator_code == "AUB")
		{
			$phone=$mobile1;
			$id=rand('1000','9999');
			$service_id=$operator_code;
			$amt=$amount;
			if($operator_code == 'ACA'||$operator_code == 'ADA')
			{
				$arr = array('details' => array('phoneNumber' => $phone, 'amount' => $amt),
					   'id' => $id,
					   'paymentCollectorId' => 'CDL',
					   'paymentMethod' => 'PREPAID',
					   'serviceId' => $service_id
						);
						
				
			}else
			if($operator_code == 'AEA')
			{
			
				$arr = array(
					   'details' => array('phoneNumber' => $phone, 'amount' => $amt),
					   'id' => $id,
					   'paymentCollectorId' => 'CDL',
					   'paymentMethod' => 'PREPAID',
					   'serviceId' => $service_id
						);
						
			}
			else
			if($operator_code == 'APA')
			{
			
				$arr = array(
					   'details' => array('accountNumber' => $phone, 'amount' => $amt),
					   'id' => $id,
					   'paymentCollectorId' => 'CDL',
					   'paymentMethod' => 'PREPAID',
					   'serviceId' => $service_id
						);
			}else 
			if(  $operator_code == 'ANA')
			{
			
				$arr = array(
					   'details' => array('customerAccountId' => $phone, 'amount' => $amt),
					   'id' => $id,
					   'paymentCollectorId' => 'CDL',
					   'paymentMethod' => 'PREPAID',
					   'serviceId' => $service_id
						);
				
			}else if($operator_code == 'ANB')
			{
				$arr = array(
					   'details' => array('bundleTypeCode' => $recharge_code,'customerAccountId'=>$phone, 'amount' => $amt,'quantity'=>'1'),
					   'id' => $id,
					   'paymentCollectorId' => 'CDL',
					   'paymentMethod' => 'PREPAID',
					   'serviceId' => $service_id
						);
						
			}
			else 
			if($operator_code == 'AQC' || $operator_code == 'AQA')
			{
	
	
			$arr = array(
					   'details' => array('productsCodes' => $recharge_code,'customerNumber'=>$phone, 'amount' => $amt,'customerName'=>$customer_name,'invoicePeriod'=>1),
					   'id' => $id,
					   'paymentCollectorId' => 'CDL',
					   'paymentMethod' => 'PREPAID',
					   'serviceId' => $service_id
						);
						
			
			}
			else 
			if($operator_code == 'AWA')
			{
			$arr = array(
					   'details' => array('smartCardNumber' => $phone, 'amount' => $amt),
					   'id' => $id,
					   'paymentCollectorId' => 'CDL',
					   'paymentMethod' => 'PREPAID',
					   'serviceId' => $service_id
						);
				
			}
			/*
			else 
						if($operator_code == 'AQA')
						{
							$arr = array(
								   'details' => array('productsCodes' => $recharge_code,'customerNumber'=>$phone, 'amount' => $amt,'customerName'=>$customer_name,'invoicePeriod'=>1),
								   'id' => $id,
								   'paymentCollectorId' => 'CDL',
								   'paymentMethod' => 'PREPAID',
								   'serviceId' => $service_id
									);
							
						}*/
			else
			
			if($operator_code == 'APB')
						{
						
							$arr = array(
								   'details' => array('meterNumber' => $phone, 'amount' => $amt),
								   'id' => $id,
								   'paymentCollectorId' => 'CDL',
								   'paymentMethod' => 'PREPAID',
								   'serviceId' => $service_id
									);
									
						}
			else
			if($operator_code == 'APA')
						{
						
							$arr = array(
								   'details' => array('accountNumber' => $phone, 'amount' => $amt),
								   'id' => $id,
								   'paymentCollectorId' => 'CDL',
								   'paymentMethod' => 'PREPAID',
								   'serviceId' => $service_id
									);
						}else
			if($operator_code == 'AUB')
						{
						
							$arr = array(
								   'details' => array('customerName' => $customer_name, 'customerReference' => $phone,'customerType'=>'PREPAID','thirdPartyCode'=>'ONLI','amount'=>$amt),
								   'id' => $id,
								   'paymentCollectorId' => 'CDL',
								   'paymentMethod' => 'PREPAID',
								   'serviceId' => $service_id
									);
						
						}
						}else{
							$arr = array('details' => array('phoneNumber' => $phone, 'amount' => $amt),
					   'id' => $id,
					   'paymentCollectorId' => 'CDL',
					   'paymentMethod' => 'PREPAID',
					   'serviceId' => $service_id
						);
						}

			
			$requestBody = json_encode($arr);
			$hashedRequestBody = base64_encode(hash('sha256', utf8_encode($requestBody), true));
			$date = gmdate('D, d M Y H:i:s T');
			$signedData = "POST" . "\n" . $hashedRequestBody . "\n" . $date . "\n" . "/rest/consumer/v2/exchange";
			$token = base64_decode('wMkYszcHBpeDaNFo1T9vy1WDeIqxxGoQw/oXGdf9TAjB1P+y+8Y9m5p2B6XP2iKe0bR+dg6ubjGydce/RNKbtQ==');
			$signature = hash_hmac('sha1', $signedData, $token, true);
			$encodedsignature = base64_encode($signature);

			$arr = 
			array(
				"accept: application/json, application/*+json", 
				"accept-encoding: gzip,deflate", 
				"authorization: MSP efficiencie:" . $encodedsignature, 
				"cache-control: no-cache", 
				"connection: Keep-Alive", 
				"content-type: application/json", 
				"host: 136.243.252.209", 
				"x-msp-date:" . $date
				);

					$curl = curl_init();
					curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
					curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
					curl_setopt_array($curl, array(CURLOPT_URL => "https://baxi.capricorndigi.com/app/rest/consumer/v2/exchange", 
					CURLOPT_RETURNTRANSFER => true, 
					CURLOPT_ENCODING => "", 
					CURLOPT_MAXREDIRS => 10, 
					CURLOPT_TIMEOUT => 300, 
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1, 
					CURLOPT_CUSTOMREQUEST => "POST", 
					CURLOPT_POSTFIELDS => $requestBody, 
					CURLOPT_HTTPHEADER => $arr));
					$response = curl_exec($curl);
					$err = curl_error($curl);
					curl_close($curl);

					if ($err) {
						echo "cURL Error #:" . $err;
					} else {
					
						$arr=json_decode($response); 
						// echo 'hemant';
						//print_r($arr); exit;


					$transaction_id=$arr->details->exchangeReference;
						 $responseMessage=$arr->details->responseMessage;
						 $status=$arr->details->status;
						  $statusCode=$arr->details->statusCode;
						  $creditToken=$arr->details->token;
						  if($status=='ACCEPTED')
						  {
						  	$recharge_status='1';
						  	$result = $recharge_status . "," . $transaction_id.",".$creditToken;
						  }else{
						  	$result = "2" . "0";
						  }
						  return $result;
					}
			
		

	}

// function check tv recharge number
function validate_tv_number()
{
		$tv_operator_id=$_REQUEST['tv_operator_id'];
		$tv_number=$_REQUEST['tv_number'];
		$operator_records = $this -> conn -> get_table_row_byidvalue('operator_list', 'operator_id', $tv_operator_id);
		$service_id = $operator_records['0']['operator_code'];
		if($service_id == 'AQA' || $service_id=='AQC')
		{
						
			$arr = array(
				'details' => array('number' => $tv_number,"requestType"=>"VALIDATE_DEVICE_NUMBER"),
								'serviceId' => $service_id);
								
		}
		else if($service_id == 'AWA')
	    {
						
			$arr = array('details' => array('smartCardNumber' => $tv_number),
								   	'serviceId' => $service_id);
									
		}
		
		$requestBody = json_encode($arr);	
			$hashedRequestBody = base64_encode(hash('sha256', utf8_encode($requestBody), true));
			$date = gmdate('D, d M Y H:i:s T');
			$signedData = "POST" . "\n" . $hashedRequestBody . "\n" . $date . "\n" . "/rest/consumer/v2/exchange/proxy";
			$token = base64_decode('wMkYszcHBpeDaNFo1T9vy1WDeIqxxGoQw/oXGdf9TAjB1P+y+8Y9m5p2B6XP2iKe0bR+dg6ubjGydce/RNKbtQ==');
			$signature = hash_hmac('sha1', $signedData, $token, true);
			$encodedsignature = base64_encode($signature);

			$arr = 
			array(
				"accept: application/json, application/*+json", 
				"accept-encoding: gzip,deflate", 
				"authorization: MSP efficiencie:" . $encodedsignature, 
				"cache-control: no-cache", 
				"connection: Keep-Alive", 
				"content-type: application/json", 
				"host: 136.243.252.209", 
				"x-msp-date:" . $date
				);

					$curl = curl_init();
					curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
					curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
					curl_setopt_array($curl, array(CURLOPT_URL => "https://baxi.capricorndigi.com/app/rest/consumer/v2/exchange/proxy", 
					CURLOPT_RETURNTRANSFER => true, 
					CURLOPT_ENCODING => "", 
					CURLOPT_MAXREDIRS => 10, 
					CURLOPT_TIMEOUT => 300, 
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1, 
					CURLOPT_CUSTOMREQUEST => "POST", 
					CURLOPT_POSTFIELDS => $requestBody, 
					CURLOPT_HTTPHEADER => $arr));
					$response = curl_exec($curl);
					$err = curl_error($curl);
					curl_close($curl);

					if ($err) {
						echo "cURL Error #:" . $err;
					} else {
						$arr=json_decode($response);
						$accountStatus=$arr->details->accountStatus;
						$returntStatus=$arr->details->returnMessage;
						$returnCode=$arr->details->returnCode;
						if($accountStatus=='Success' || $accountStatus=='OPEN')
						{
							if($accountStatus=='Success')
							{
								$firstName=$arr->details->customerName;
							}else if($accountStatus=='OPEN')
							{
								$fName=$arr->details->firstName;
								$lastName=$arr->details->lastName;
								$firstName=$fName." ".$lastName;
							}
								$customer_no=$arr->details->customerNumber;
						   		$name=$firstName;
						 $post = array('status' => "true", "customer_name" => $name,'service_id'=>$service_id,'customer_no'=>$customer_no);
						}else if($returntStatus=='OPEN' || $returntStatus=='Success')
						{
							
							 if($returntStatus=='OPEN'){
							$firstName=$arr->details->firstName;
								 
						 $lastName=$arr->details->lastName;
						  $name=$firstName." ".$lastName;
							 }else if($returntStatus=='Succes$names'){
							 	$firstName=$arr->details->customerName;
								 $name=$firstName;
							 }
						 
						 $customer_no=$arr->details->customerNumber;
						    $post = array('status' => "true", "customer_name" => $name,'service_id'=>$service_id,'customer_no'=>$customer_no);
						}else if($accountStatus=='SUSPENDED')
						{
							$fName=$arr->details->firstName;
								$lastName=$arr->details->lastName;
								
							  $name=$firstName." ".$lastName;
							  $customer_no=$arr->details->customerNumber;
						   $post = array('status' => "true", "customer_name" => $name,'service_id'=>$service_id,'customer_no'=>$customer_no);
						}else if($returnCode=='0')
						{
								$firstName=$arr->details->customerName;
								  $post = array('status' => "true", "customer_name" => $firstName,'service_id'=>$service_id,'customer_no'=>'');
						}
						 
						 else{
						 	 $post = array('status' => "false", "message" => 'Tv Number not valid');
						 }
						
							echo $this -> json($post);
					}
		
}
function get_tv_product_no()
{
	$service_id=$_REQUEST['service_id'];
	$operator_records = $this -> conn -> get_table_row_byidvalue('operator_list', 'operator_code', $service_id);
	$operator_name= $operator_records['0']['operator_name'];
	$arr = array('details' => array("requestType"=>"FIND_STANDALONE_PRODUCTS"),
								'serviceId' => $service_id);
			$requestBody = json_encode($arr);	
			$hashedRequestBody = base64_encode(hash('sha256', utf8_encode($requestBody), true));
			$date = gmdate('D, d M Y H:i:s T');
			$signedData = "POST" . "\n" . $hashedRequestBody . "\n" . $date . "\n" . "/rest/consumer/v2/exchange/proxy";
			$token = base64_decode('wMkYszcHBpeDaNFo1T9vy1WDeIqxxGoQw/oXGdf9TAjB1P+y+8Y9m5p2B6XP2iKe0bR+dg6ubjGydce/RNKbtQ==');
			$signature = hash_hmac('sha1', $signedData, $token, true);
			$encodedsignature = base64_encode($signature);

			$arr = 
			array(
				"accept: application/json, application/*+json", 
				"accept-encoding: gzip,deflate", 
				"authorization: MSP efficiencie:" . $encodedsignature, 
				"cache-control: no-cache", 
				"connection: Keep-Alive", 
				"content-type: application/json", 
				"host: 136.243.252.209", 
				"x-msp-date:" . $date
				);

					$curl = curl_init();
					curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
					curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
					curl_setopt_array($curl, array(CURLOPT_URL => "https://baxi.capricorndigi.com/app/rest/consumer/v2/exchange/proxy", 
					CURLOPT_RETURNTRANSFER => true, 
					CURLOPT_ENCODING => "", 
					CURLOPT_MAXREDIRS => 10, 
					CURLOPT_TIMEOUT => 300, 
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1, 
					CURLOPT_CUSTOMREQUEST => "POST", 
					CURLOPT_POSTFIELDS => $requestBody, 
					CURLOPT_HTTPHEADER => $arr));
					$response = curl_exec($curl);
					$err = curl_error($curl);
					curl_close($curl);
					$arr=json_decode($response);
			
				$new_data=$arr->details->items;
				$arr_1 = array();
				for($i=0;$i<count($new_data)-1;$i++){
									$arr121 = array('details' => array("primaryProductCode"=>$new_data[$i]->code,"requestType"=>"FIND_PRODUCT_ADDONS"),'serviceId' => 'AQA');
							$requestBody1 = json_encode($arr121);	
							$hashedRequestBody1 = base64_encode(hash('sha256', utf8_encode($requestBody1), true));
							$date1 = gmdate('D, d M Y H:i:s T');
							$signedData1 = "POST" . "\n" . $hashedRequestBody1 . "\n" . $date1 . "\n" . "/rest/consumer/v2/exchange/proxy";
							$token1 = base64_decode('wMkYszcHBpeDaNFo1T9vy1WDeIqxxGoQw/oXGdf9TAjB1P+y+8Y9m5p2B6XP2iKe0bR+dg6ubjGydce/RNKbtQ==');
							$signature1 = hash_hmac('sha1', $signedData1, $token1, true);
							$encodedsignature1 = base64_encode($signature1);
				
							$arr111 = 
							array(
								"accept: application/json, application/*+json", 
								"accept-encoding: gzip,deflate", 
								"authorization: MSP efficiencie:" . $encodedsignature1, 
								"cache-control: no-cache", 
								"connection: Keep-Alive", 
								"content-type: application/json", 
								"host: 136.243.252.209", 
								"x-msp-date:" . $date1
								);
				
									$curl1 = curl_init();
									curl_setopt($curl1, CURLOPT_SSL_VERIFYHOST, 0);
									curl_setopt($curl1, CURLOPT_SSL_VERIFYPEER, 0);
									curl_setopt_array($curl1, array(CURLOPT_URL => "https://baxi.capricorndigi.com/app/rest/consumer/v2/exchange/proxy", 
									CURLOPT_RETURNTRANSFER => true, 
									CURLOPT_ENCODING => "", 
									CURLOPT_MAXREDIRS => 10, 
									CURLOPT_TIMEOUT => 300, 
									CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1, 
									CURLOPT_CUSTOMREQUEST => "POST", 
									CURLOPT_POSTFIELDS => $requestBody1, 
									CURLOPT_HTTPHEADER => $arr111));
									$response1 = curl_exec($curl1);
									$err1 = curl_error($curl1);
									curl_close($curl1);
									$arr1=json_decode($response1);
									//print_R($arr1->details->items);
									//$new_data->addons=$arr1;
									$new_data[$i]->addons = $arr1->details->items;
									$arr_1[] = $new_data[$i];
									}
					
					//$new_data=$arr->details->items;
			if(!empty($arr_1)){
				$post=array('status'=>'true','plans'=>$arr_1,'operator_name'=>$operator_name);
}else{
	$post=array('status'=>'false','message'=>'No plans Found','operator_name'=>$operator_name);
}
				echo $this -> json($post);
}
// function check data recharge number
function validate_data_number()
{
		$data_operator_id=$_REQUEST['data_operator_id'];
		$data_number=$_REQUEST['data_number'];
		$operator_records = $this -> conn -> get_table_row_byidvalue('operator_list', 'operator_id', $data_operator_id);
		$service_id = $operator_records['0']['operator_code'];
		$operator_name = $operator_records['0']['operator_name'];
		if($service_id == 'ANA' || $service_id == 'ANB')
		{
						
			$arr = array(
				'details' => array('customerAccountId' => $data_number,"requestType"=>"VALIDATE_ACCOUNT"),
								'serviceId' => $service_id);
								
		}
		$requestBody = json_encode($arr);	
			$hashedRequestBody = base64_encode(hash('sha256', utf8_encode($requestBody), true));
			$date = gmdate('D, d M Y H:i:s T');
			$signedData = "POST" . "\n" . $hashedRequestBody . "\n" . $date . "\n" . "/rest/consumer/v2/exchange/proxy";
			$token = base64_decode('wMkYszcHBpeDaNFo1T9vy1WDeIqxxGoQw/oXGdf9TAjB1P+y+8Y9m5p2B6XP2iKe0bR+dg6ubjGydce/RNKbtQ==');
			$signature = hash_hmac('sha1', $signedData, $token, true);
			$encodedsignature = base64_encode($signature);

			$arr = 
			array(
				"accept: application/json, application/*+json", 
				"accept-encoding: gzip,deflate", 
				"authorization: MSP efficiencie:" . $encodedsignature, 
				"cache-control: no-cache", 
				"connection: Keep-Alive", 
				"content-type: application/json", 
				"host: 136.243.252.209", 
				"x-msp-date:" . $date
				);

					$curl = curl_init();
					curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
					curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
					curl_setopt_array($curl, array(CURLOPT_URL => "https://baxi.capricorndigi.com/app/rest/consumer/v2/exchange/proxy", 
					CURLOPT_RETURNTRANSFER => true, 
					CURLOPT_ENCODING => "", 
					CURLOPT_MAXREDIRS => 10, 
					CURLOPT_TIMEOUT => 300, 
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1, 
					CURLOPT_CUSTOMREQUEST => "POST", 
					CURLOPT_POSTFIELDS => $requestBody, 
					CURLOPT_HTTPHEADER => $arr));
					$response = curl_exec($curl);
					$err = curl_error($curl);
					curl_close($curl);

					if ($err) {
						echo "cURL Error #:" . $err;
					} else {
				
						$arr=json_decode($response);
						 $firstName=$arr->details->firstName;
						  $middleName=$arr->details->middleName;
						   $lastName=$arr->details->lastName;
						   $name=$firstName." ".$middleName." ".$lastName;
						 if(!empty($firstName))
						 {

						
						 	if($service_id=='ANB')
								{
										
									$arr = array('details' => array("customerAccountId"=>$data_number,"requestType"=>"GET_BUNDLES"),'serviceId' => 'ANB');
							$requestBody = json_encode($arr);	
							$hashedRequestBody = base64_encode(hash('sha256', utf8_encode($requestBody), true));
							$date = gmdate('D, d M Y H:i:s T');
							$signedData = "POST" . "\n" . $hashedRequestBody . "\n" . $date . "\n" . "/rest/consumer/v2/exchange/proxy";
							$token = base64_decode('wMkYszcHBpeDaNFo1T9vy1WDeIqxxGoQw/oXGdf9TAjB1P+y+8Y9m5p2B6XP2iKe0bR+dg6ubjGydce/RNKbtQ==');
							$signature = hash_hmac('sha1', $signedData, $token, true);
							$encodedsignature = base64_encode($signature);
				
							$arr = 
							array(
								"accept: application/json, application/*+json", 
								"accept-encoding: gzip,deflate", 
								"authorization: MSP efficiencie:" . $encodedsignature, 
								"cache-control: no-cache", 
								"connection: Keep-Alive", 
								"content-type: application/json", 
								"host: 136.243.252.209", 
								"x-msp-date:" . $date
								);
				
									$curl = curl_init();
									curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
									curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
									curl_setopt_array($curl, array(CURLOPT_URL => "https://baxi.capricorndigi.com/app/rest/consumer/v2/exchange/proxy", 
									CURLOPT_RETURNTRANSFER => true, 
									CURLOPT_ENCODING => "", 
									CURLOPT_MAXREDIRS => 10, 
									CURLOPT_TIMEOUT => 300, 
									CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1, 
									CURLOPT_CUSTOMREQUEST => "POST", 
									CURLOPT_POSTFIELDS => $requestBody, 
									CURLOPT_HTTPHEADER => $arr));
									$response1 = curl_exec($curl);
									$err = curl_error($curl);
									curl_close($curl);
									$arr1=json_decode($response1);
									$numberOfBundles=$arr1->details->numberOfBundles;
									$plan_array=$arr1->details->bundles;
									
								
								}
if(empty($plan_array))
{
	$plan="";
	$numberOfBundles="";
}
	$post = array('status' => "true", "customer_name" => $name,'operator_name'=>$operator_name,'bundle_no'=>$numberOfBundles,'plans'=>$plan_array);
		}else{
		$post = array('status' => "false", "message" => 'Data Card number not valid');
		}
						
		echo $this -> json($post);
	}
		
}


// function check electricty website number===//
function check_electricty_number()
{
		$ele_operator_id=$_REQUEST['electricty_operator_id'];
		$ele_number=$_REQUEST['electricity_number'];
		$operator_records = $this -> conn -> get_table_row_byidvalue('operator_list', 'operator_id', $ele_operator_id);
		$service_id = $operator_records['0']['operator_code'];
		if($service_id == 'APB')
		{
						
			$arr = array(
				'details' => array('meterNumber' => $ele_number),
								'serviceId' => $service_id);
		}
		else if($service_id == 'APA')
	    {
						
			$arr = array('details' => array('customerNumber' => $ele_number),
								   	'serviceId' => $service_id);
		}
		else if($service_id == 'AUB')
	    {
						
			$arr = array('details' => array('customerReference' => $ele_number),
								   	'serviceId' => $service_id);
									
		}
		$requestBody = json_encode($arr);	
			$hashedRequestBody = base64_encode(hash('sha256', utf8_encode($requestBody), true));
			$date = gmdate('D, d M Y H:i:s T');
			$signedData = "POST" . "\n" . $hashedRequestBody . "\n" . $date . "\n" . "/rest/consumer/v2/exchange/proxy";
			$token = base64_decode('wMkYszcHBpeDaNFo1T9vy1WDeIqxxGoQw/oXGdf9TAjB1P+y+8Y9m5p2B6XP2iKe0bR+dg6ubjGydce/RNKbtQ==');
			$signature = hash_hmac('sha1', $signedData, $token, true);
			$encodedsignature = base64_encode($signature);

			$arr = 
			array(
				"accept: application/json, application/*+json", 
				"accept-encoding: gzip,deflate", 
				"authorization: MSP efficiencie:" . $encodedsignature, 
				"cache-control: no-cache", 
				"connection: Keep-Alive", 
				"content-type: application/json", 
				"host: 136.243.252.209", 
				"x-msp-date:" . $date
				);

					$curl = curl_init();
					curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
					curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
					curl_setopt_array($curl, array(CURLOPT_URL => "https://baxi.capricorndigi.com/app/rest/consumer/v2/exchange/proxy", 
					CURLOPT_RETURNTRANSFER => true, 
					CURLOPT_ENCODING => "", 
					CURLOPT_MAXREDIRS => 10, 
					CURLOPT_TIMEOUT => 300, 
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1, 
					CURLOPT_CUSTOMREQUEST => "POST", 
					CURLOPT_POSTFIELDS => $requestBody, 
					CURLOPT_HTTPHEADER => $arr));
					$response = curl_exec($curl); 
					$err = curl_error($curl);
					curl_close($curl);

					if ($err) {
						echo "cURL Error #:" . $err;
					} else {
				
						$arr=json_decode($response);
					//	print_r($arr);
						$status=$arr->details->status;
						if($status==0)
						{
							$firstName=$arr->details->firstName;
							$lastName=$arr->details->lastName;
							echo $firstName." ".$lastName;
						}else if($status=='1')
						{
							echo  'Meter number or account number not valid';
						}else if($status=='2')
						{
							echo  'Expired Payment';
						}if(empty($status))
						 {
						 echo	$firstName=$arr->details->name;
							// $post = array('status' => "true", "customer_name" => $firstName);
						 }
					}
		
}
// function validate electirc number for app

function validate_electricty_number()
{
		$ele_operator_id=$_REQUEST['electricty_operator_id'];
		$ele_number=$_REQUEST['electricity_number'];
		$operator_records = $this -> conn -> get_table_row_byidvalue('operator_list', 'operator_id', $ele_operator_id);
		$service_id = $operator_records['0']['operator_code'];
		if($service_id == 'APB')
		{
						
			$arr = array(
				'details' => array('meterNumber' => $ele_number),
								'serviceId' => $service_id);
		}
		else if($service_id == 'APA')
	    {
						
			$arr = array('details' => array('customerNumber' => $ele_number),
								   	'serviceId' => $service_id);
		}
		else if($service_id == 'AUB')
	    {
						
			$arr = array('details' => array('customerReference' => $ele_number),
								   	'serviceId' => $service_id);
							
		}
		$requestBody = json_encode($arr);	
			$hashedRequestBody = base64_encode(hash('sha256', utf8_encode($requestBody), true));
			$date = gmdate('D, d M Y H:i:s T');
			$signedData = "POST" . "\n" . $hashedRequestBody . "\n" . $date . "\n" . "/rest/consumer/v2/exchange/proxy";
			$token = base64_decode('wMkYszcHBpeDaNFo1T9vy1WDeIqxxGoQw/oXGdf9TAjB1P+y+8Y9m5p2B6XP2iKe0bR+dg6ubjGydce/RNKbtQ==');
			$signature = hash_hmac('sha1', $signedData, $token, true);
			$encodedsignature = base64_encode($signature);

			$arr = 
			array(
				"accept: application/json, application/*+json", 
				"accept-encoding: gzip,deflate", 
				"authorization: MSP efficiencie:" . $encodedsignature, 
				"cache-control: no-cache", 
				"connection: Keep-Alive", 
				"content-type: application/json", 
				"host: 136.243.252.209", 
				"x-msp-date:" . $date
				);

					$curl = curl_init();
					curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
					curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
					curl_setopt_array($curl, array(CURLOPT_URL => "https://baxi.capricorndigi.com/app/rest/consumer/v2/exchange/proxy", 
					CURLOPT_RETURNTRANSFER => true, 
					CURLOPT_ENCODING => "", 
					CURLOPT_MAXREDIRS => 10, 
					CURLOPT_TIMEOUT => 300, 
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1, 
					CURLOPT_CUSTOMREQUEST => "POST", 
					CURLOPT_POSTFIELDS => $requestBody, 
					CURLOPT_HTTPHEADER => $arr));
					$response = curl_exec($curl);
					$err = curl_error($curl);
					curl_close($curl);

					if ($err) {
						echo "cURL Error #:" . $err;
					} else {
				
						$arr=json_decode($response);

						$status=$arr->details->status;
						$errorMessage=$arr->details->errorMessage;
						if($status=='0')
						{
							//echo "string";
							$firstName=$arr->details->firstName;
							$lastName=$arr->details->lastName;
							 $post = array('status' => "true", "customer_name" => $firstName." ".$lastName);
						
					
						 	
						 }else if($status=='1'){
						 	 $post = array('status' => "false", "message" => 'Meter number or account number not valid');
						 }else if($status=='2'){
						 	 $post = array('status' => "false", "message" => 'Expired
Payment');
						 }else if($status!='0' && $status!='1' && $status!='2' && empty($errorMessage))
						 {
						 	$firstName=$arr->details->name;
							 $post = array('status' => "true", "customer_name" => $firstName);
						 } if(!empty($errorMessage))
						 {
						 	$post = array('status' => "false", "message" => $errorMessage);
						 }
						
							echo $this -> json($post);
					}
		
}

	function recharge_message($mobile_no, $amount, $transaction_id,$recharge_no,$status) {

		$user_name=sms_user_name;
		$password=sms_password;
		$mobile =  $mobile_no;
		if($status=='1')
		{
				$msg= "Recharge Successfully done from OyaCharge on : " . $recharge_no . " with amount NGN " . $amount . " For more services visit www.oyacharge.com Happy to Help !!!  care@oyacharge.com";
		}else if($status=='2')
		{
				$msg= "Recharge failed from OyaCharge on : " . $recharge_no . " with amount NGN " . $amount . " For more services visit www.oyacharge.com Happy to Help !!!  care@oyacharge.com";
		}
	$encodedMessage = urlencode($msg);
	$url = "http://www.kudisms.net/components/com_spc/smsapi.php?username=$user_name&password=$password&sender=OyaCharge&recipient=$mobile&message=" .$encodedMessage;
		$ch = curl_init();
		curl_setopt_array($ch, array(CURLOPT_URL => $url, CURLOPT_RETURNTRANSFER => true, CURLOPT_POST => true, CURLOPT_FOLLOWLOCATION => true));
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$output = curl_exec($ch);
		curl_close($ch);
	//	return $code;
	}
function church_message($mobile_no, $amount, $transaction_id,$status) {
$user_name=sms_user_name;
$password=sms_password;
		$mobile =  $mobile_no;
		if($status=='1')
		{
			$msg= "Donation Successfully done from OyaCharge  with amount NGN " . $amount . " For more services visit www.oyacharge.com Happy to Help !!!  care@oyacharge.com";
		}else if($status=='2')
		{
			$msg= "Donation Failed from OyaCharge  with amount NGN " . $amount . " For more services visit www.oyacharge.com Happy to Help !!!  care@oyacharge.com";
		}
		$encodedMessage = urlencode($msg);
		$url = "http://www.kudisms.net/components/com_spc/smsapi.php?username=$user_name&password=$password&sender=OyaCharge&recipient=$mobile&message=" .$encodedMessage;
		$ch = curl_init();
		curl_setopt_array($ch, array(CURLOPT_URL => $url, CURLOPT_RETURNTRANSFER => true, CURLOPT_POST => true, CURLOPT_FOLLOWLOCATION => true));
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$output = curl_exec($ch);
		curl_close($ch);
	//	return $code;
	}
function sendsms_by91() {
		$mobile=$_REQUEST['mobile'];
		$amount=$_REQUEST['amount'];
		$msg= "Recharge Successfully done from OyaCharge on : " . $mobile . " with amount NGN " . $amount . " For more services visit www.oyacharge.com Happy to Help !!!  care@oyacharge.com";
		$authKey = "128873ABrb77LxbxWt58088825";

//Multiple mobiles numbers separated by comma
    $mobileNumber = $mobile;

//Sender ID,While using route4 sender id should be 6 characters long.
    $senderId = "PICKME";
	//$senderId = "102234";
//Your message to send, Add URL encoding here.
    $message = urlencode($msg);

//Define route 
//1 for default & 4 for live credit
    $route = "4";
//Prepare you post parameters
    $postData = array(
        'authkey' => $authKey,
        'mobiles' => $mobileNumber,
        'message' => $message,
        'sender' => $senderId,
        'route' => $route,
        'country' => 0
    );

//API URL
    $url = "https://control.msg91.com/api/sendhttp.php";

// init the resource
    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $postData
            //,CURLOPT_FOLLOWLOCATION => true
    ));


//Ignore SSL certificate verification
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


//get response
     $output = curl_exec($ch);
   // print_r($output);
//Print error if any
   if (curl_errno($ch)) {
      echo 'error:' . curl_error($ch);
   }

    curl_close($ch);
		
		
	}

// function church_list
// function church_list
function church_list()
{
	if(!empty($_REQUEST['church_category']))
	{
		$church_category=$_REQUEST['church_category'];
		$church_records = $this -> conn -> get_table_row_byidvalue('church_list', 'church_category', $church_category);
		if(!empty($church_records))
		{
		foreach ($church_records as $v) {
				$church_id = $v['church_id'];
				$church_biller_id = $v['church_biller_id'];
				$church_category = $v['church_category'];
				$church_img = church_image .  $v['church_img'];
				$church_name = $v['church_name'];
				$church_city = $v['church_city'];
				$post[] = array('church_id' => $church_id, 'church_category' => $church_category, 'church_name' => $church_name, 'church_city' => $church_city, 'church_img' => $church_img,'church_biller_id'=>$church_biller_id);
			}
			$post = array('status' => "true", "church_list" => $post);
	
	}else{
		$post = array('status' => "false", "message" => "No Church found");
	}
		}else{
		
	$post = array('status' => "false", "message" => "Missing parameter", 'church_category' => $_REQUEST['church_category']);
		}
		echo $this -> json($post);
}
function church_area()
{
	
	if(!empty($_REQUEST['church_id']))
	{
		$church_id=$_REQUEST['church_id'];
		$sql="select * from church_list join church_area on church_area.church_id=church_list.church_id where church_area.church_id='".$church_id."'";
		$record=$this->conn->getData($sql);
			if(!empty($record))
		{
		foreach ($record as $v) {
				$church_id = $v['church_id'];
				$church_biller_id = $v['church_biller_id'];
				$church_category = $v['church_category'];
				$church_img = church_image .  $v['church_img'];
				$church_name = $v['church_name'];
				$church_city = $v['church_city'];
				$church_area = $v['church_area'];
				$church_area_id = $v['church_area_id'];
				$post[] = array('church_id' => $church_id, 'church_category' => $church_category, 'church_name' => $church_name, 'church_city' => $church_city, 'church_img' => $church_img,'church_biller_id'=>$church_biller_id,'church_area'=>$church_area,'church_area_id'=>$church_area_id);
			}
			$post = array('status' => "true", "church_list" => $post);
	
	}else{
		$post = array('status' => "false", "message" => "No Church found");
	}
		//$area_list = $this -> conn -> join_two_table('church_list','church_area','church_id','church_id', 'church_id', $church_id);
		
	}else{
		$post = array('status' => "false", "message" => "Missing parameter", 'church_id' => $_REQUEST['church_id']);
	}
	echo $this -> json($post);
}
function church_donation_product()
{
	if(!empty($_REQUEST['church_area_id']))
	{
			$area_id=$_REQUEST['church_area_id'];
			 $sql="select * from church_area join church_product on  FIND_IN_SET(church_product.church_product_id,church_area.church_product_ids) where church_area.church_area_id='".$area_id."'";
			$church_records=$this->conn->getData($sql);
			if(!empty($church_records))
			{
					foreach ($church_records as  $value) {
						$product_id 	=	$value['church_product_id'];
						$price 			=	$value['church_product_price'];
						$product_name 	=	$value['church_product_name'];
						$products[] 	=	array('product_id'=>$product_id,'product_name'=>$product_name,'price'=>$price);
					}
					$post=array('status'=>'true','nessage'=>'church product list','product'=>$products);
			}else{
				$post=array('status'=>'false','message'=>'No Product Found');
			}
	}else{
		$post=array('status'=>'false','message'=>'Missing Parameter');
	}
	echo $this -> json($post);
}
function church_details()
{
	if(!empty($_REQUEST['church_id']))
	{
		$church_id=$_REQUEST['church_id'];
		//$church_records = $this -> conn -> get_table_row_byidvalue('church_list', 'church_id', $church_category);
		$sql="select * from church_list join church_area on church_area.church_id=church_list.church_id where church_area.church_id='".$church_id."'";
		$church_records=$this->conn->getData($sql);
		$churchrecord=$church_records;
		if(!empty($church_records))
		{
		
				$church_id = $church_records[0]['church_id'];
				$church_category = $church_records[0]['church_category'];
				$church_img = church_image .  $church_records[0]['church_img'];
				$church_name = $church_records[0]['church_name'];
				$church_city = $church_records[0]['church_city'];
				
				$church_product_id = explode(",",$church_records[0]['church_product_id']);
				$c_pid=$church_product_id[0];
				$church_rec = $this -> conn -> get_table_row_byidvalue('church_product', 'church_product_id', $c_pid);
					$church_p_price=$church_rec[0]['church_product_price'];
			$church_product_name = explode(",",$church_records[0]['church_product_name']);
				for($i=0;$i<count($church_product_id);$i++)
				{
					$church_productid= $church_product_id[$i];
					$church_records = $this -> conn -> get_table_row_byidvalue('church_product', 'church_product_id', $church_productid);
					$church_product_price=$church_records[0]['church_product_price'];
					$church_productname= $church_product_name[$i];
					$data[]=array('product_id'=>$church_productid,'product_name'=>$church_productname,'price'=>$church_product_price);
				}
				
				foreach ($churchrecord as $v) {
					$church_area = $v['church_area'];
				$church_area_id = $v['church_area_id'];
				$post[] = array(church_area=>$church_area,'church_area_id'=>$church_area_id);
				}
				$post = array('status' => "true",'church_id' => $church_id, 'church_category' => $church_category, 'church_name' => $church_name, 'church_city' => $church_city, 'church_img' => $church_img,'product'=>$data,'c_product_id'=>$c_pid,'church_p_price'=>$church_p_price,'church_area'=>$post);
			
			//$post = array('status' => "true", "church_list" => $post);
	
	}else{
		$post = array('status' => "false", "message" => "No Church found");
	}
		}else{
		
	$post = array('status' => "false", "message" => "Missing parameter", 'church_category' => $_REQUEST['church_category']);
		}
		echo $this -> json($post);
}
// function church donate 
// function church donate 
function church_donate()
{
	if(!empty($_REQUEST['church_id'])&&($_REQUEST['donar_user_id'])&&($_REQUEST['church_category_id'])&&($_REQUEST['church_product_id'])&&($_REQUEST['church_product_price'])&&($_REQUEST['church_area_id']))
	{
		$church_id=$_REQUEST['church_id'];
		$church_area_id=$_REQUEST['church_area_id'];
		$donar_user_id=$_REQUEST['donar_user_id'];
		$church_category_id=$_REQUEST['church_category_id'];
		$church_product_id=$_REQUEST['church_product_id'];
		$church_product_price=$_REQUEST['church_product_price'];
	//	$transaction_id=$_REQUEST['transaction_id'];
		$current_date = date("Y-m-d H:i:s");
	//	$payment_gateway_id=$_REQUEST['payment_gateway_id'];
		$wt_category='13';
		$wt_desc="Donation to church";
		$coupon_id				=	$_REQUEST['coupon_id'];
		$coupon_amount			=	$_REQUEST['coupon_amount'];
			$bill_records = $this -> conn -> get_table_row_byidvalue('church_list', 'church_id', $church_id);
			if (!empty($bill_records)) {
				$church_biller_id = $bill_records['0']['church_biller_id'];
				
				

					$records 		= 	$this -> conn -> get_table_row_byidvalue('user', 'user_id', $donar_user_id);
					$wallet_amount  = 	$records['0']['wallet_amount'];
					$admin 			= 	$this -> conn -> get_all_records('admin');
					$admin_wallet 	= 	$admin['0']['admin_wallet'];
					$transaction_id = 	strtotime("now") . mt_rand(10, 99);
					$reffer_status 	= 	$records['0']['reffer_amount_status'];
					$reffer_user_id = 	$records['0']['reffer_user_id'];
					$user_number 	= 	$records['0']['user_contact_no'];
					if ($wallet_amount >= $church_product_price) {
						$recharge = $this -> conn -> insertnewrecords('wallet_transaction', 'wt_user_id, wt_datetime,wt_category,wt_amount,transaction_id,wt_desc', '"' . $donar_user_id . '","' . $current_date . '","' . $wt_category . '","' . $church_product_price . '","' . $transaction_id . '","' . $wt_desc . '"');

						if ($recharge) {

							$church_donate = $this -> conn -> insertnewrecords('church_donate', 'donate_church_id,church_area_id,church_biller_id,donate_user_id, church_p_id,transaction_id,church_product_price,donate_datetime,payment_status', '"' . $church_id . '","' . $church_area_id. '","' . $church_biller_id . '","' . $donar_user_id . '","' . $church_product_id . '","' . $transaction_id . '","' . $church_product_price . '","' . $current_date . '","1"');

							// change status of bill///
							

							//reffer amount when user first recharge then beifits add in frnd wallet
						
							$cashback_record_id = $recharge_number;
						
							$user_wallet = $wallet_amount - $church_product_price;
							$data['wallet_amount'] = $user_wallet;

							$update_toekn = $this -> conn -> updatetablebyid('user', 'user_id', $donar_user_id, $data);
							// Admin wallet update
							$admin_update_wallet = $admin_wallet + $church_product_price;
							$data_admin['admin_wallet'] = $admin_update_wallet;
							$update_toekn = $this -> conn -> updatetablebyid('admin', 'admin_id', 1, $data_admin);
							if ($reffer_status == '2') 
							{
								$this->refferal_code($donar_user_id,$reffer_user_id,$user_number,$wallet_amount);	
							}
							
					     if (!empty($coupon_id)) {
							$coupon_apply = $this -> conn -> insertnewrecords('coupon_details', 'coupon_id,user_id,coupon_apply_date', '"' . $coupon_id . '","' . $donar_user_id . '","' . $current_date . '"');
							if (!empty($coupon_apply)) {
								$walletrecharge = $this -> conn -> insertnewrecords('wallet_transaction', 'wt_user_id,wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc,cashbackrecord_id', '"' . $donar_user_id . '","' . $current_date . '","2","' . $coupon_amount . '","4","' . $payment_transaction_id . '","' . $w_desc . '","' . $cashback_record_id . '"');
								$user_wallet = $wallet_amount + $coupon_amount;
								$data['wallet_amount'] = $user_wallet;
								$update_toekn = $this -> conn -> updatetablebyid('user', 'user_id', $recharge_user_id, $data);
							}
						}

						$this->church_mail($donar_user_id,$church_id,$transaction_id,$church_product_price,$payment_gateway_type,'1');
						$this -> church_message($user_number, $church_product_price, $transaction_id,'1');
						$post = array("status" => "true", 'message' => "Donation Successfully", "donation_pay_id" => $recharge, 'church_id' => $church_id, 'donation_amount' => $church_product_price, 'wallet_amount' => $user_wallet, 'transaction_id' => $transaction_id,'transaction_date' => date('F-d-Y h:i A',strtotime($current_date)));
						} else {
							$post = array('status' => "false", "message" => "Donation pay failed", 'transaction_id' => $transaction_id,'transaction_date' => date('F-d-Y h:i A',strtotime($current_date)));
						}
					} else {
						$pay_amount = $recharge_amount - $wallet_amount;
						$post = array('status' => "false", "message" => "Not sufficent amount in  your wallet", 'wallet_amount' => $wallet_amount, 'donate_amount' => $church_product_price, 'transaction_id' => $transaction_id,'transaction_date' => date('F-d-Y h:i A',strtotime($current_date)));
						echo $this -> json($post);
						exit();
						//$add=$this->add_money_recharge($recharge_user_id,$recharge_amount,$recharge_transaction_id);
						//$this->recharge();
					}

				
			}else{
				$post = array('status' => "false", "message" => "No church avalible of this church id", 'church_id' => $church_id);
			}
	}else{
	$post = array('status' => "false", "message" => "Missing parameter", 'church_id' => $_REQUEST['church_id'], 'donar_user_id' => $_REQUEST['donar_user_id'], 'church_product_price' => $_REQUEST['church_product_price'], 'church_product_id' => $_REQUEST['church_product_id'], 'church_product_id' => $_REQUEST['church_product_id']);
		}
		echo $this -> json($post);
}
// function select_chuech service
function donate_church_with_card()
{
	if(!empty($_REQUEST['church_id'])&&($_REQUEST['donar_user_id'])&&($_REQUEST['church_category_id'])&&($_REQUEST['church_product_id'])&&($_REQUEST['church_product_price']) &&($_REQUEST['church_area_id']))
	{
		$wt_category			=	$_REQUEST['wt_category'];
		$church_id				=	$_REQUEST['church_id'];
		$church_area_id			=	$_REQUEST['church_area_id'];
		$donar_user_id			=	$_REQUEST['donar_user_id'];
		$church_category_id		=	$_REQUEST['church_category_id'];
		$church_product_id		=	$_REQUEST['church_product_id'];
		$church_product_price	=	$_REQUEST['church_product_price'];
		$current_date 			= 	date("Y-m-d H:i:s");
		$payment_type 			=   $_REQUEST['payment_type'];  // 1-card,2-bank account
		$savecard_status		= 	$_REQUEST['savecard_status']; // 1- Save , 2 for not save
		$card_pay_type 			= 	$_REQUEST['card_pay_type'];   // 1-card, 2- card_token
		$card_no				=	$_REQUEST['card_no'];
		$expiry_month			=	$_REQUEST['expiry_month'];
		$expiry_year			=	$_REQUEST['expiry_year'];
		$cvv_no					=	$_REQUEST['cvv_no'];
		$recipient_bank			=	$_REQUEST['recipient_bank'];
		$rec_ac_no				=	$_REQUEST['recipient_account_number'];
		$sender_ac_no			=	sender_account_number;
		$sender_bank			=	sender_bank;
		$passcode				=	$_REQUEST['passcode'];
		$rec_ac_no				=	$_REQUEST['recipient_account_number'];
		$card_token				=	$_REQUEST['card_token'];
		$coupon_id				=	$_REQUEST['coupon_id'];
		$coupon_amount			=	$_REQUEST['coupon_amount'];
		$wt_desc="Donation to church";
		if($payment_type == '1')
		{
			$transaction_via="Credit/Debit Card";
			if($card_pay_type=='1')
			{
				$pay = $this->payment_card($card_no,$expiry_month,$expiry_year,$cvv_no,$donar_user_id,$church_product_price,$savecard_status,$verve_card_status,$verve_card_pin,'1');
			}else 
				if($card_pay_type=='2')
				{
					$records_cards 	= $this -> conn -> get_table_field_doubles('save_card_details', 'save_card_userid', $donar_user_id, 'save_card_token', $card_token);
					$cardid		 	=	$records_cards[0]['card_id'];
					$cardtoken	 	=	$records_cards[0]['save_card_token'];
					$save_card_no	=	$records_cards[0]['save_card_no'];
					$cardfour_digit	= substr($save_card_no, -4);
					$pay			=	$this->payment_card_token($cardfour_digit,$cardtoken,$cvv_no,$donar_user_id,$church_product_price,$cardid);
				}
		}
		else 
		if($payment_type == '2')
		{
			$transaction_via="Bank Account";
			$pay = $this->payment_bank($recipient_bank,$rec_ac_no,$sender_ac_no,$sender_bank,$passcode,$donar_user_id,$church_product_price);
		}
		$para						= explode("/", $pay);
		$status						= $para[0];
		
		$payment_transaction_id		= $para[1];
		$trans_ref_no				= $para[2];
		$data_store_id				= $para[3];
		if($status=='error')
		{
			$post = array('status' => "false", "message" => $payment_transaction_id, 'transaction_id' => $payment_transaction_id,'transaction_date' => date('F-d-Y h:i A',strtotime($current_date)),'transaction_ref'=>$trans_ref_no);
			echo $this -> json($post);
			exit();
		}
		$payment_gateway_type 		=	$payment_type;  // 1-card,2-bank account
		
		$bill_records = $this -> conn -> get_table_row_byidvalue('church_list', 'church_id', $church_id);
			if (!empty($bill_records)) {
				$church_biller_id = $bill_records['0']['church_biller_id'];
				
				

					$records 		= $this -> conn -> get_table_row_byidvalue('user', 'user_id', $donar_user_id);
					$wallet_amount 	= $records['0']['wallet_amount'];
					$admin 		   	= $this -> conn -> get_all_records('admin');
					$admin_wallet  	= $admin['0']['admin_wallet'];
					$reffer_status 	= $records['0']['reffer_amount_status'];
					$user_number   	= $records['0']['user_contact_no'];
					$reffer_user_id = $records['0']['reffer_user_id'];
					if (!empty($payment_transaction_id)) {
						//$transaction_id='5454';
						$recharge 	= $this -> conn -> insertnewrecords('wallet_transaction', 'wt_user_id, wt_datetime,wt_category,wt_amount,transaction_id,wt_desc,trans_ref_no,payment_gateway_id,payment_type', '"' . $donar_user_id . '","' . $current_date . '","' . $wt_category . '","' . $church_product_price . '","' . $payment_transaction_id . '","' . $wt_desc . '","' . $trans_ref_no . '","' . $payment_transaction_id . '","' . $payment_type . '"');

						if ($recharge) {

						$church_donate = $this -> conn -> insertnewrecords('church_donate', 'donate_church_id,church_biller_id,donate_user_id, church_p_id,transaction_id,church_product_price,donate_datetime,payment_status', '"' . $church_id . '","' . $church_biller_id . '","' . $donar_user_id . '","' . $church_product_id . '","' . $payment_transaction_id . '","' . $church_product_price . '","' . $current_date . '","1"');

							// change status of bill///
							

							//reffer amount when user first recharge then beifits add in frnd wallet
							
							$cashback_record_id = $recharge_number;
						    $admin_update_wallet = $admin_wallet + $church_product_price;
							$data_admin['admin_wallet'] = $admin_update_wallet;
							$update_toekn = $this -> conn -> updatetablebyid('admin', 'admin_id', 1, $data_admin);
						if ($reffer_status == '2') 
						{
							$this->refferal_code($donar_user_id,$reffer_user_id,$user_number,$wallet_amount);	
						}
						$this->free_offer_mail($donar_user_id);
						$this->church_mail($donar_user_id,$church_id,$transaction_id,$church_product_price,$payment_gateway_type,'1');
						$this -> church_message($user_number, $church_product_price, $transaction_id,'1');
						// apply promocode
						if (!empty($coupon_id)) {
							$coupon_apply = $this -> conn -> insertnewrecords('coupon_details', 'coupon_id, user_id,coupon_apply_date', '"' . $coupon_id . '","' . $donar_user_id . '","' . $current_date . '"');
							if (!empty($coupon_apply)) {
								$walletrecharge = $this -> conn -> insertnewrecords('wallet_transaction', 'wt_user_id,wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc,cashbackrecord_id', '"' . $donar_user_id . '","' . $current_date . '","2","' . $coupon_amount . '","4","' . $payment_transaction_id . '","' . $w_desc . '","' . $cashback_record_id . '"');
								$user_wallet = $wallet_amount + $coupon_amount;
								$data['wallet_amount'] = $user_wallet;
								$update_toekn = $this -> conn -> updatetablebyid('user', 'user_id', $recharge_user_id, $data);
							}
						}
						
						
						$post = array("status" => "true", 'message' => "Donation Successfully", "donation_pay_id" => $recharge, 'church_id' => $church_id, 'donation_amount' => $church_product_price, 'wallet_amount' => $wallet_amount, 'transaction_id' => $payment_transaction_id,'transaction_date' => date('F-d-Y h:i A',strtotime($current_date)),'transaction_ref'=>$trans_ref_no);
						} else {
						$post = array('status' => "false", "message" => "Donation pay failed", 'transaction_id' => $payment_transaction_id,'transaction_date' => date('F-d-Y h:i A',strtotime($current_date)),'transaction_ref'=>$trans_ref_no);
						}
					} else {
						
						$post = array('status' => "false", "message" => "Transaction Failed", 'transaction_id' => $payment_transaction_id,'transaction_date' => date('F-d-Y h:i A',strtotime($current_date)),'transaction_ref'=>$trans_ref_no);
						echo $this -> json($post);
						exit();
						//$add=$this->add_money_recharge($recharge_user_id,$recharge_amount,$recharge_transaction_id);
						//$this->recharge();
					}

				
			}else{
				$post = array('status' => "false", "message" => "No church avalible of this church id", 'church_id' => $church_id);
			}
	}
	else{
	$post = array('status' => "false", "message" => "Missing parameter", 'church_id' => $_REQUEST['church_id'], 'donar_user_id' => $_REQUEST['donar_user_id'], 'church_product_price' => $_REQUEST['church_product_price'], 'church_product_id' => $_REQUEST['church_product_id'], 'church_product_id' => $_REQUEST['church_area_id']);
		}
		echo $this -> json($post);
	
}



// function donate for church wallet wih card
function donate_church_wallet_with_card()
{
	if(!empty($_REQUEST['church_id'])&&($_REQUEST['donar_user_id'])&&($_REQUEST['church_category_id'])&&($_REQUEST['church_product_id'])&&($_REQUEST['church_product_price'])&& $_REQUEST['payment_gateway_price'])
	{
		$church_id					=	$_REQUEST['church_id'];
		$donar_user_id				=	$_REQUEST['donar_user_id'];
		$church_category_id			=	$_REQUEST['church_category_id'];
		$church_product_id			=	$_REQUEST['church_product_id'];
		$church_product_price		=	$_REQUEST['church_product_price'];
		$transaction_id				=	$_REQUEST['payment_gateway_id'];
		$current_date 				= 	date("Y-m-d H:i:s");
		$wallet_amt					=	$_REQUEST['church_product_price']-$_REQUEST['payment_gateway_price'];
		$card_rec_amt				=	$_REQUEST['payment_gateway_price'];
		$wt_category				=	'13';
		$trans_ref_no 				= 	$_REQUEST['trans_ref_no'];
		$wt_desc					=	"Donation to church";
		$payment_type 				=   $_REQUEST['payment_type'];  // 1-card,2-bank account
		$savecard_status			= 	$_REQUEST['savecard_status']; // 1- Save , 2 for not save
		$card_pay_type 				= 	$_REQUEST['card_pay_type'];   // 1-card, 2- card_token
		$card_no					=	$_REQUEST['card_no'];
		$expiry_month				=	$_REQUEST['expiry_month'];
		$expiry_year				=	$_REQUEST['expiry_year'];
		$cvv_no						=	$_REQUEST['cvv_no'];
		$recipient_bank				=	$_REQUEST['recipient_bank'];
		$rec_ac_no					=	$_REQUEST['recipient_account_number'];
		$sender_ac_no				=	sender_account_number;
		$sender_bank				=	sender_bank;
		$passcode					=	$_REQUEST['passcode'];
		$rec_ac_no					=	$_REQUEST['recipient_account_number'];
		$card_token					=	$_REQUEST['card_token'];
if($payment_type == '1')
		{
			if($card_pay_type=='1')
			{
				$pay = $this->payment_card($card_no,$expiry_month,$expiry_year,$cvv_no,$donar_user_id,$church_product_price,$savecard_status,$verve_card_status,$verve_card_pin,'1');
			}else 
				if($card_pay_type=='2')
				{
					$records_cards = $this -> conn -> get_table_field_doubles('save_card_details', 'save_card_userid', $donar_user_id, 'save_card_token', $card_token);
					$cardid		=	$records_cards[0]['card_id'];
					$cardtoken	=	$records_cards[0]['save_card_token'];
					$save_card_no	=	$records_cards[0]['save_card_no'];
					$cardfour_digit= substr($save_card_no, -4);
					$pay			=	$this->payment_card_token($cardfour_digit,$cardtoken,$cvv_no,$donar_user_id,$church_product_price,$cardid);
				}
		}
		else 
		if($payment_type == '2')
		{
			$pay = $this->payment_bank($recipient_bank,$rec_ac_no,$sender_ac_no,$sender_bank,$passcode,$donar_user_id,$church_product_price);
		}
		$para					= explode("/", $pay);
		$status					= $para[0];
		
		$payment_transaction_id			= $para[1];
		$trans_ref_no				= $para[2];
		$data_store_id				= $para[3];
		if($status=='error')
		{
			$post = array('status' => "false", "message" => $payment_transaction_id, 'transaction_id' => $payment_transaction_id,'transaction_date' => date('F-d-Y h:i A',strtotime($current_date)),'transaction_ref'=>$trans_ref_no);
			echo $this -> json($post);
			exit();
		}
		$payment_gateway_type =$payment_type;  // 1-card,2-bank account
		$bill_records = $this -> conn -> get_table_row_byidvalue('church_list', 'church_id', $church_id);
			if (!empty($bill_records)) {
				$church_biller_id = $bill_records['0']['church_biller_id'];
				
				

					$records = $this -> conn -> get_table_row_byidvalue('user', 'user_id', $donar_user_id);
					$wallet_amount = $records['0']['wallet_amount'];
					$admin = $this -> conn -> get_all_records('admin');
					$admin_wallet = $admin['0']['admin_wallet'];
					$reffer_status = $records['0']['reffer_amount_status'];
					$reffer_user_id = $records['0']['reffer_user_id'];
					$user_number = $records['0']['user_contact_no'];
					$card_deduct_amount = $wallet_amt;
					if($card_deduct_amount<=$wallet_amount){
				
				//	$transaction_id = strtotime("now") . mt_rand(10, 99);
					
					
					
						$recharge = $this -> conn -> insertnewrecords('wallet_transaction', 'wt_user_id, wt_datetime,wt_amount,wt_category,transaction_id,wt_desc,user_wallet_rec_amount,user_card_card_rec_amount,trans_ref_no', '"' . $donar_user_id . '","' . $current_date . '","' . $church_product_price . '","' . $wt_category . '","' . $payment_transaction_id . '","' . $wt_desc . '","' . $wallet_amt . '","' . $card_rec_amt . '","' . $trans_ref_no . '"');
						//$transaction_id='5454';
					//	$recharge = $this -> conn -> insertnewrecords('wallet_transaction', 'wt_user_id, wt_datetime,wt_category,wt_amount,transaction_id,wt_desc', '"' . $donar_user_id . '","' . $current_date . '","' . $wt_category . '","' . $church_product_price . '","' . $transaction_id . '","' . $wt_desc . '"');

						if ($recharge) {

							$church_donate = $this -> conn -> insertnewrecords('church_donate', 'donate_church_id,church_biller_id,donate_user_id, church_p_id,transaction_id,church_product_price,donate_datetime,payment_status', '"' . $church_id . '","' . $church_biller_id . '","' . $donar_user_id . '","' . $church_product_id . '","'.$payment_transaction_id. '","' . $church_product_price . '","' . $current_date . '","1"');

							// change status of bill///
							

							//reffer amount when user first recharge then beifits add in frnd wallet
					
							//$cashback_record_id = $recharge_number;
						
							$user_wallet = $wallet_amount - $wallet_amt;
							$data['wallet_amount'] = $user_wallet;

							$update_toekn = $this -> conn -> updatetablebyid('user', 'user_id', $donar_user_id, $data);
							if ($reffer_status == '2') 
						{
							$this->refferal_code($donar_user_id,$reffer_user_id,$user_number,$wallet_amount);	
						}
							// Admin wallet update
							$admin_update_wallet = $admin_wallet + $church_product_price;
							$data_admin['admin_wallet'] = $admin_update_wallet;
							$update_toekn = $this -> conn -> updatetablebyid('admin', 'admin_id', 1, $data_admin);

							$this->free_offer_mail($donar_user_id);
							$this->church_mail($donar_user_id,$church_id,$transaction_id,$church_product_price,$payment_gateway_type,'1');
							$this -> church_message($user_number, $church_product_price, $transaction_id,'1');
				
							$post = array("status" => "true", 'message' => "Donation Successfully", "donation_pay_id" => $recharge, 'church_id' => $church_id, 'donation_amount' => $church_product_price, 'wallet_amount' => $user_wallet,  'transaction_id' => $payment_transaction_id,'card_amount'=>$card_rec_amt,'wallet_used_amount'=>$wallet_amt,'transaction_date' => date('F-d-Y h:i A',strtotime($current_date)),'transaction_ref'=>$trans_ref_no);
						} else {
							$post = array('status' => "false", "message" => "Donation pay failed", 'transaction_id' => $payment_transaction_id,'transaction_date' => date('F-d-Y h:i A',strtotime($current_date)),'transaction_ref'=>$trans_ref_no);
						}
						
					} else {
						
						$post = array('status' => "false", "message" => "Not sufficent amount in  your wallet", 'wallet_amount' => $wallet_amount, 'donate_amount' => $church_product_price, 'transaction_id' => $payment_transaction_id,'transaction_date' => date('F-d-Y h:i A',strtotime($current_date)),'transaction_ref'=>$trans_ref_no);
						echo $this -> json($post);
						exit();
						//$add=$this->add_money_recharge($recharge_user_id,$recharge_amount,$recharge_transaction_id);
						//$this->recharge();
					}

				
			}else{
				$post = array('status' => "false", "message" => "No church avalible of this church id", 'church_id' => $church_id);
			}
	}
	else{
	$post = array('status' => "false", "message" => "Missing parameter", 'church_id' => $_REQUEST['church_id'], 'donar_user_id' => $_REQUEST['donar_user_id'], 'church_product_price' => $_REQUEST['church_product_price'], 'church_product_id' => $_REQUEST['church_product_id'], 'church_product_id' => $_REQUEST['church_product_id'],'payment_gateway_price'=>$_REQUEST['payment_gateway_price']);
		}
		echo $this -> json($post);
	
}
// function failed transaction  14 oct 2016
function donate_church_with_card_failed()
{
	if(!empty($_REQUEST['church_id'])&&($_REQUEST['donar_user_id'])&&($_REQUEST['church_category_id'])&&($_REQUEST['church_product_id'])&&($_REQUEST['church_product_price']) && $_REQUEST['wt_category'] )
	{
		//$transaction_id=$_REQUEST['trans_id'];
		$transaction_id = strtotime("now") . mt_rand(10, 99);
		$church_id=$_REQUEST['church_id'];
		$donar_user_id=$_REQUEST['donar_user_id'];
		$church_category_id=$_REQUEST['church_category_id'];
		$church_product_id=$_REQUEST['church_product_id'];
		$church_product_price=$_REQUEST['church_product_price'];
		$current_date = date("Y-m-d H:i:s");
		$wallet_amt=$_REQUEST['church_product_price']-$_REQUEST['payment_gateway_price'];
		$card_rec_amt=$_REQUEST['payment_gateway_price'];
		$wt_category='13';
		$wt_desc = $_REQUEST['failed_desc'];
		$trans_ref_no = $_REQUEST['trans_ref_no'];
		$payment_gateway_type = $_REQUEST['payment_gateway_type'];  // 1-kongopay,2-webpay
		$recharge = $this -> conn -> insertnewrecords('wallet_transaction', 'wt_user_id, wt_datetime,wt_category,wt_amount,transaction_id,wt_desc,wt_status,payment_type,trans_ref_no', '"' . $donar_user_id . '","' . $current_date . '","' . $wt_category . '","' . $church_product_price . '","' .$transaction_id . '","' . $wt_desc . '","3","'.$payment_gateway_type.'","'.$trans_ref_no.'"');

						if ($recharge) {
							$bill_records = $this -> conn -> get_table_row_byidvalue('church_list', 'church_id', $church_id);
		
							$church_biller_id = $bill_records['0']['church_biller_id'];
							$church_donate = $this -> conn -> insertnewrecords('church_donate', 'donate_church_id,church_biller_id,donate_user_id, church_p_id,transaction_id,church_product_price,donate_datetime,payment_status', '"' . $church_id . '","' . $church_biller_id . '","' . $donar_user_id . '","' . $church_product_id . '","' . $transaction_id . '","' . $church_product_price . '","' . $current_date . '","3"');
				$this->church_mail($donar_user_id,$church_id,$transaction_id,$church_product_price,$payment_gateway_type,'2');	
				$this -> church_message($user_number, $church_product_price, $transaction_id,'2');			
			$post = array('status' => "true", "message" => "Failed transaction", 'wt_category' => $wt_category, 'amount' => $church_product_price, 'recharge_user_id' => $donar_user_id,'trans_id'=>$transaction_id,'failed_date'=>$current_date,'failed_desc'=>$wt_desc,'payment_type'=>$payment_gateway_type);
			}
				
			 
		else{
			
			$post = array('status' => "false", "message" => " Error Failed transaction");
		}
		
	}else{
			$post = array('status' => "false", "message" => "Missing parameter", 'church_id' => $_REQUEST['church_id'], 'donar_user_id' => $_REQUEST['donar_user_id'], 'church_product_price' => $_REQUEST['church_product_price'], 'church_category_id' => $_REQUEST['church_category_id'], 'church_product_id' => $_REQUEST['church_product_id'], 'wt_category' => $_REQUEST['wt_category']);
	}
	echo $this -> json($post);
} 
function bill_pay_failed()
{
		$recharge_user_id = $_REQUEST['recharge_user_id'];
		$wt_category = $_REQUEST['wt_category'];
		// wt_category = 11 pay bill
		$bill_category_id = $_REQUEST['bill_category_id'];
		// 1- Water, 2- Movies etc
		$biller_id = $_REQUEST['biller_id'];
		$bill_amount = $_REQUEST['bill_amount'];
		$bill_consumer_no = $_REQUEST['bill_consumer_no'];
		$wt_desc = $_REQUEST['failed_desc'];
		$payment_gateway_type = $_REQUEST['payment_gateway_type'];  // 1-kongopay,2-webpay
		$trans_ref_no = $_REQUEST['trans_ref_no'];
		$wallet_type = 2;
		// 1- Credit, 2-Debit
		$bill_pay_status = 2;
		//$transaction_id=$_REQUEST['trans_id'];
		$transaction_id = strtotime("now") . mt_rand(10, 99);
		$wallet_category = '4';
		// 4- Cashback
		$current_date = date("Y-m-d H:i:s");
	
		if (!empty($bill_consumer_no) && !empty($biller_id) && !empty($bill_amount) && !empty($recharge_user_id)) {
			$bill_records = $this -> conn -> get_table_field_doubles('biller_user', 'biller_customer_id_no', $bill_consumer_no, 'biller_id', $biller_id);
					$bill_user_id = $bill_records['0']['biller_user_id'];
				$recharge = $this -> conn -> insertnewrecords('wallet_transaction', 'wt_user_id, wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc,wt_status,payment_type,trans_ref_no', '"' . $recharge_user_id . '","' . $current_date . '","' . $wallet_type . '","' . $bill_amount . '","' . $wt_category . '","' . $transaction_id . '","' . $wt_desc . '","3","' . $payment_gateway_type . '","' . $trans_ref_no . '"');

					
						$walletrecharge = $this -> conn -> insertnewrecords('bill_recharge', 'bill_user_id,bill_transaction_id,bill_category_id, biller_id,bill_consumer_no,bill_amount,bill_pay_date,bill_pay_status', '"' . $recharge_user_id . '","' . $transaction_id . '","' . $bill_category_id . '","' . $biller_id . '","' . $bill_consumer_no . '","' . $bill_amount . '","' . $current_date . '","' . $bill_pay_status . '"');
							$post = array('status' => "true", "message" => "Failed transaction", 'wt_category' => $wt_category, 'amount' => $bill_amount, 'recharge_user_id' => $recharge_user_id,'trans_id'=>$transaction_id,'failed_date'=>$current_date,'failed_desc'=>$wt_desc,'payment_type'=>$payment_gateway_type);
						}else{
							
						$post = array('status' => "false", "message" => "Missing parameter", 'recharge_user_id' => $recharge_user_id, 'bill_category_id' => $bill_category_id, 'biller_id' => $biller_id, 'wt_category' => $wt_category, 'consumer_no' => $bill_consumer_no, 'bill_amount' => $bill_amount);
		}
		echo $this -> json($post);
}
function recharge_failed()
{
		$recharge_user_id = $_REQUEST['recharge_user_id'];
		$transaction_id = strtotime("now") . mt_rand(10, 99);
		//	$transaction_id=$_REQUEST['trans_id'];
		$refund_amount = $_REQUEST['payment_gateway_amt'];
		$recharge_category_id = $_REQUEST['recharge_category_id'];
		//1- Mobile,2-DTH
		$operator_id = $_REQUEST['operator_id'];
		$rec_number = $_REQUEST['recharge_number'];
		$recharge_number = $_REQUEST['recharge_number'];
		$mobile_number = $_REQUEST['recharge_number'];
		$recharge_amount = $_REQUEST['recharge_amount'];
		$wt_desc = $_REQUEST['failed_desc'];
		$payment_gateway_type = $_REQUEST['payment_gateway_type'];  // 1-kongopay,2-webpay
		$wallet_type = 2;
		// 1- Credit, 2-Debit
		$recharge_status = 3;
		$wt_category = $_REQUEST['wt_category'];
		//  1-Add money,2-Recharge
		$wallet_category = '4';
	//	$wt_desc="Recharge Failed";
		$current_date = date("Y-m-d H:i:s");
		$trans_ref_no = $_REQUEST['trans_ref_no'];
		if (!empty($recharge_user_id) && !empty($operator_id) && !empty($recharge_number) && !empty($recharge_amount)) {
		
			$recharge = $this -> conn -> insertnewrecords('wallet_transaction', 'wt_user_id, wt_datetime,wt_amount,wt_category,transaction_id,wt_desc,user_wallet_rec_amount,user_card_card_rec_amount,electrice_token_no,wt_status,payment_type,trans_ref_no', '"' . $recharge_user_id . '","' . $current_date . '","' . $recharge_amount . '","' . $wt_category . '","' . $transaction_id . '","' . $wt_desc . '","' . $wallet_amount . '","' . $card_deduct_amount . '","' . $electricity_token . '","3","' . $payment_gateway_type . '","' . $trans_ref_no . '"');

				$walletrecharge = $this -> conn -> insertnewrecords('recharge', 'recharge_transaction_id,recharge_user_id,rechage_category,operator_id,rechage_type,recharge_number,recharge_amount,recharge_date,recharge_status,electrice_token_no', '"' . $transaction_id . '","' . $recharge_user_id . '","' . $recharge_category_id . '","' . $operator_id . '","' . $recharge_type_id . '","' . $recharge_number . '","' . $recharge_amount . '","' . $current_date . '","' . $recharge_status . '","' . $electricity_token . '"');
				 $this->recharge_mail($recharge_user_id,$operator_id,$recharge_number,$transaction_id,$recharge_amount,$wt_category,$payment_gateway_type,'2');
				 $this -> recharge_message($user_number, $recharge_amount, $transaction_id,$recharge_number,'2');
				$post = array('status' => "true", "message" => "Failed transaction", 'wt_category' => $wt_category, 'amount' => $recharge_amount, 'recharge_user_id' => $recharge_user_id,'trans_id'=>$transaction_id,'failed_date'=>$current_date,'failed_desc'=>$wt_desc,'payment_type'=>$payment_gateway_type);
					}else{
						$post = array('status' => "false", "message" => "Missing parameter", 'recharge_user_id' => $recharge_user_id, 'recharge_category_id' => $recharge_category_id, 'operator_id' => $operator_id, 'recharge_type_id' => $recharge_type_id, 'recharge_number' => $recharge_number, 'recharge_amount' => $recharge_amount);
					}
echo $this -> json($post);
}
////-------Add money from payment gateway failed transaction-------------///
	function failed_add_money() {
		$user_id = $_REQUEST['recharge_user_id'];
		$user_amount = $_REQUEST['recharge_amount'];
		$transaction_id = strtotime("now") . mt_rand(10, 99);
		//	$transaction_id=$_REQUEST['trans_id'];
		$final_amount = $user_amount;
		$trans_ref_no = $_REQUEST['trans_ref_no'];
		$wt_desc 	  = $_REQUEST['failed_desc'];
		$payment_gateway_type = $_REQUEST['payment_gateway_type'];  // 1-kongopay,2-webpay
		$wt_type = 1;
		// credit
		$current_date = date("Y-m-d H:i:s");
		$wt_category = 1;
		// 1-Add moeny, 2-Recharge
		$w_category = 6;
		//$w_desc = "Amount Recieved when add money " . $user_amount . " with get amount " . $coupon_amount;
		//$wt_desc = "Add Money";
	
		if (!empty($user_id) && !empty($user_amount)) {
			$records = $this -> conn -> get_table_row_byidvalue('user', 'user_id', $user_id);
			$wallet_amount = $records['0']['wallet_amount'];
			$user_wallet = $wallet_amount + $final_amount;
			$add_money = $this -> conn -> insertnewrecords('wallet_transaction', 'wt_user_id, wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc,payment_type,wt_status,trans_ref_no', '"' . $user_id . '","' . $current_date . '","' . $wt_type . '","' . $user_amount . '","' . $wt_category . '","' . $transaction_id . '","' . $wt_desc . '","' . $payment_gateway_type . '","3","' . $trans_ref_no . '"');
			if (!empty($add_money)) {
				
				
				$post = array('status' => "true", "message" => "Failed transaction", 'wt_category' => $wt_category, 'amount' => $final_amount, 'recharge_user_id' => $user_id,'trans_id'=>$transaction_id,'failed_date'=>$current_date,'failed_desc'=>$wt_desc,'payment_type'=>$payment_gateway_type);

			} else {
				$post = array('status' => "false", "message" => "Error in transaction insert");
			}
		} else {
			$post = array('status' => "false", "message" => "Missing parameter", 'recharge_user_id' => $user_id, 'recharge_amount' => $user_amount);
		}
		echo $this -> json($post);
	}
// function send recharge mail
function mail_send()
{
	$recharge_user_id=$_REQUEST['user_id'];
	$operator_id=$_REQUEST['operator'];
	$recharge_number=$_REQUEST['number'];
	$transaction_id=$_REQUEST['trans_id'];
	$recharge_amount=$_REQUEST['amount'];
		$rechage_type=$_REQUEST['recharge_type'];
	 $this->recharge_mail($recharge_user_id,$operator_id,$recharge_number,$transaction_id,$recharge_amount,$rechage_type);
}
	function recharge_mail($recharge_user_id,$operator_id,$recharge_no,$trans_id,$recharge_amount,$rechage_type,$paytype,$status) {
		$header_logo=mail_image."logo_header.png";
		$img_icon=mail_image."img_icon.png";
		if($paytype=='0')
		{
			$pay_image=mail_image."logo_header.png";
		}else  if($paytype=='1')
		{
			$pay_image=mail_image."logo_header.jpg";
		}else if($paytype=='2')
		{
			$pay_image=mail_image."logo_header.png";
			
		}
		
		$currency_icon=mail_image."currency.png";
		$web_icon=mail_image."web.png";
		$current_date = date("Y-m-d h:i:sa");
		$recharge_user_id = $recharge_user_id;
		$frnd_records = $this -> conn -> get_table_row_byidvalue('user', 'user_id', $recharge_user_id);
		$user_name = $frnd_records['0']['user_name'];
		$user_email = $frnd_records['0']['user_email'];
		$operator_records = $this -> conn -> get_table_row_byidvalue('operator_list', 'operator_id', $operator_id);
		$operator = $operator_records['0']['operator_image'];
		$operator_image=operator_img_url.$operator;
		$operator_name = $operator_records['0']['operator_name'];
				$to = $user_email;

				$subject = "Recharge Details of OyaCharge";
				$path = mail_logo;
				if($status=='1'){
				$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>OyaCharge</title>
</head>
<body>
<table style="width:100%; max-width:600px; margin:0 auto;background-color:#80d6cd" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td width=""><table width="" cellspacing="0" cellpadding="0" align="center">
          <tbody>
            <tr>
              <td colspan="2" style="text-align:center;padding-top:15px;padding-left:20px"><img src="'.$header_logo.'" alt="Oyacharge" title="Oyacharge" class="CToWUd" /></td>
              
            </tr>
          </tbody>
        </table></td>
    </tr>
    <tr>
      <td style="text-align:center; padding-top:20px;"><img width="100" src="'.$img_icon.'" alt="Payment successful" title="Payment successful" class="CToWUd" /></td>
    </tr>
    <tr>
      <td height="30"></td>
    </tr>
    <tr align="center">
      <td style="font-size:18px;font-family:Arial,Helvetica,sans-serif;color:#fff"> Your '.$recharge_type.' Recharge Successful! </td>
    </tr>
    <tr>
      <td height="10"></td>
    </tr>
    <tr align="center">
      <td style="font-size:11px;font-family:Arial,Helvetica,sans-serif;color:#fff"> '.$current_date.' </td>
    </tr>
    <tr>
      <td height="15"></td>
    </tr>
    <tr align="center">
      <td style="font-size:12px;font-family:Arial,Helvetica,sans-serif;color:#fff"><p>Dear '.$user_name.', thanks for transacting with us.</p>
        <p>Below is your recharge details.</p></td>
    </tr>
    <tr>
      <td height="20"></td>
    </tr>
    <tr>
      <td><table style="background-color:#fff;border-width:1px;border-color:#d1d1d1;border-top-color:#57a9a0;border-style:solid;border-top-width:2px" align="center">
          <tbody>
            <tr>
              <td style="padding-left:10px" width="54"><img src="'.$operator_image.'" alt="" title="" class="CToWUd" /></td>
              <td style="font-size:15px;font-family:Arial,Helvetica,sans-serif;color:#6b6a6b;border-right:1px solid #d1d1d1" width="190">'.$recharge_no;
              $message.='<p style="margin:0;font-size:9px;font-family:Arial,Helvetica,sans-serif;color:#a7a7a7;text-transform:uppercase;margin-top:5px"> '.$operator_name.' </p></td>
              <td style="padding-left:10px" width="54"><img width="100px"  src="'.$pay_image.'" alt="card" title="" class="CToWUd" /></td>
              <td style="font-size:15px;font-family:Arial,Helvetica,sans-serif;color:#6b6a6b" width="190"><p><span><img src="'.$currency_icon.'" /></span>'.$recharge_amount.'</p></td>
            </tr>
            <tr>
              <td colspan="4" style="text-transform:uppercase;font-size:9px;font-family:Arial,Helvetica,sans-serif;color:#a7a7a7;border-top:1px solid #d1d1d1;padding:15px 20px"> ORDER ID: <span style="font-size:13px;color:#6b6a6b">'.$trans_id.'</span></td>
            </tr>
          </tbody>
        </table></td>
    </tr>
    <tr>
      <td height="15"></td>
    </tr>
    <tr>
      <td height="75" style="font-size:24px; color:#fff; font-family:Arial, Helvetica, sans-serif; text-align:center;">Download our apps</td>
    </tr>
    <tr align="center">
      <td><img width="100%" src="'.$web_icon.'" alt="FreeCharge GO" usemap="#Map" class="CToWUd" border="0" /></td>
    </tr>
    <tr>
      <td height="15"></td>
    </tr>
    <tr>
      <td style="font-size:12px;font-family:Arial,Helvetica,sans-serif;color:#6b6a6b;padding:15px;line-height:20px">
      <table align="center"width="100%">
          <tbody>
            <tr>
              <td style="font-size:12px;font-family:Arial,Helvetica,sans-serif;color:#fff;padding:0 15px 15px 15px;line-height:20px"><a href="#" style="text-decoration:none; color:#fff;">For More Recharge Go To Our <span style="text-decoration:underline;">Website</span></a></td>
            </tr>
            <tr>
              <td style="font-size:12px;font-family:Arial,Helvetica,sans-serif;color:#fff;padding:0 15px 15px 15px;line-height:20px"> Best,<br />
                Team Oyacharge </td>
            </tr>
          </tbody>
        </table></td>
    </tr>
    <tr>
      <td style="padding:10px;"><span class="m_678193774613953679HOEnZb"><font color="#fff"> </font></span><span class="m_678193774613953679HOEnZb"><font color="#fff"> </font></span><span class="m_678193774613953679HOEnZb"><font color="#fff"> </font></span>
        <table align="center" width="100%">
          <tbody>
            <tr>
              <td style="width:50%;text-align:left;padding-left:15px"><table>
                  <tbody>
                    <tr>
                      <td><a href="#" target="_blank" data-saferedirecturl=""><img src="'.mail_image.'/fb.png" class="CToWUd" width="25" /></a></td>
                      <td><a href="#" target="_blank" data-saferedirecturl=""><img src="'.mail_image.'/tweet.png" class="CToWUd" width="25" /></a></td>
                      <td><a href="#" target="_blank" data-saferedirecturl=""><img src="'.mail_image.'/google.png" class="CToWUd" width="25" /></a></td>
                    </tr>
                  </tbody>
                </table>
                </td>
              <td style="width:50%; font-size:11px;font-family:Arial,Helvetica,sans-serif;color:#fff;width:50%;text-align:right">&copy; Oyacharge 2016 </td>
            </tr>
          </tbody>
        </table>
        <span class="HOEnZb"><font color="#888888"><span class="m_678193774613953679HOEnZb"><font color="#888888"> </font></span></font></span></td>
    </tr>
  </tbody>
</table>

<map name="Map" id="Map">
  <area shape="poly" coords="213,310" href="#" />
  <area shape="rect" coords="60,257,213,312" href="122" target="_blank" />
  <area shape="rect" coords="215,257,376,314" href="#" target="_blank" />
</map>

</body>
</html>'; }else if($status=='2')
{
	$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>OyaCharge</title>
</head>
<body>
<table style="width:100%; max-width:600px; margin:0 auto;background-color:#80d6cd" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td width=""><table width="" cellspacing="0" cellpadding="0" align="center">
          <tbody>
            <tr>
              <td colspan="2" style="text-align:center;padding-top:15px;padding-left:20px"><img src="'.$header_logo.'" alt="Oyacharge" title="Oyacharge" class="CToWUd" /></td>
              
            </tr>
          </tbody>
        </table></td>
    </tr>
    <tr>
      <td style="text-align:center; padding-top:20px;"><img width="100" src="'.failed_recharge_logo.'" alt="Payment Failed" title="Payment Failed" class="CToWUd" /></td>
    </tr>
    <tr>
      <td height="30"></td>
    </tr>
    <tr align="center">
      <td style="font-size:18px;font-family:Arial,Helvetica,sans-serif;color:#fff"> Your '.$recharge_type.' Recharge Failed! </td>
    </tr>
    <tr>
      <td height="10"></td>
    </tr>
    <tr align="center">
      <td style="font-size:11px;font-family:Arial,Helvetica,sans-serif;color:#fff"> '.$current_date.' </td>
    </tr>
    <tr>
      <td height="15"></td>
    </tr>
    <tr align="center">
      <td style="font-size:12px;font-family:Arial,Helvetica,sans-serif;color:#fff"><p>Dear '.$user_name.', thanks for transacting with us.</p>
        <p>Below is your recharge details.</p></td>
    </tr>
    <tr>
      <td height="20"></td>
    </tr>
    <tr>
      <td><table style="background-color:#fff;border-width:1px;border-color:#d1d1d1;border-top-color:#57a9a0;border-style:solid;border-top-width:2px" align="center">
          <tbody>
            <tr>
              <td style="padding-left:10px" width="54"><img src="'.$operator_image.'" alt="" title="" class="CToWUd" /></td>
              <td style="font-size:15px;font-family:Arial,Helvetica,sans-serif;color:#6b6a6b;border-right:1px solid #d1d1d1" width="190">'.$recharge_no;
              $message.='<p style="margin:0;font-size:9px;font-family:Arial,Helvetica,sans-serif;color:#a7a7a7;text-transform:uppercase;margin-top:5px"> '.$operator_name.' </p></td>
              <td style="padding-left:10px" width="54"><img width="100px" src="'.$pay_image.'" alt="card" title="" class="CToWUd" /></td>
              <td style="font-size:15px;font-family:Arial,Helvetica,sans-serif;color:#6b6a6b" width="190"><p><span><img src="'.$currency_icon.'" /></span>'.$recharge_amount.'</p></td>
            </tr>
            <tr>
              <td colspan="4" style="text-transform:uppercase;font-size:9px;font-family:Arial,Helvetica,sans-serif;color:#a7a7a7;border-top:1px solid #d1d1d1;padding:15px 20px"> ORDER ID: <span style="font-size:13px;color:#6b6a6b">'.$trans_id.'</span></td>
            </tr>
          </tbody>
        </table></td>
    </tr>
    <tr>
      <td height="15"></td>
    </tr>
    <tr>
      <td height="75" style="font-size:24px; color:#fff; font-family:Arial, Helvetica, sans-serif; text-align:center;">Download our apps</td>
    </tr>
    <tr align="center">
      <td><img width="100%" src="'.$web_icon.'" alt="FreeCharge GO" usemap="#Map" class="CToWUd" border="0" /></td>
    </tr>
    <tr>
      <td height="15"></td>
    </tr>
    <tr>
      <td style="font-size:12px;font-family:Arial,Helvetica,sans-serif;color:#6b6a6b;padding:15px;line-height:20px">
      <table align="center"width="100%">
          <tbody>
            <tr>
              <td style="font-size:12px;font-family:Arial,Helvetica,sans-serif;color:#fff;padding:0 15px 15px 15px;line-height:20px"><a href="#" style="text-decoration:none; color:#fff;">For More Recharge Go To Our <span style="text-decoration:underline;">Website</span></a></td>
            </tr>
            <tr>
              <td style="font-size:12px;font-family:Arial,Helvetica,sans-serif;color:#fff;padding:0 15px 15px 15px;line-height:20px"> Best,<br />
                Team Oyacharge </td>
            </tr>
          </tbody>
        </table></td>
    </tr>
    <tr>
      <td style="padding:10px;"><span class="m_678193774613953679HOEnZb"><font color="#fff"> </font></span><span class="m_678193774613953679HOEnZb"><font color="#fff"> </font></span><span class="m_678193774613953679HOEnZb"><font color="#fff"> </font></span>
        <table align="center" width="100%">
          <tbody>
            <tr>
              <td style="width:50%;text-align:left;padding-left:15px"><table>
                  <tbody>
                    <tr>
                      <td><a href="#" target="_blank" data-saferedirecturl=""><img src="'.mail_image.'/fb.png" class="CToWUd" width="25" /></a></td>
                      <td><a href="#" target="_blank" data-saferedirecturl=""><img src="'.mail_image.'/tweet.png" class="CToWUd" width="25" /></a></td>
                      <td><a href="#" target="_blank" data-saferedirecturl=""><img src="'.mail_image.'/google.png" class="CToWUd" width="25" /></a></td>
                    </tr>
                  </tbody>
                </table>
                </td>
              <td style="width:50%; font-size:11px;font-family:Arial,Helvetica,sans-serif;color:#fff;width:50%;text-align:right">&copy; Oyacharge 2016 </td>
            </tr>
          </tbody>
        </table>
        <span class="HOEnZb"><font color="#888888"><span class="m_678193774613953679HOEnZb"><font color="#888888"> </font></span></font></span></td>
    </tr>
  </tbody>
</table>

<map name="Map" id="Map">
  <area shape="poly" coords="213,310" href="#" />
  <area shape="rect" coords="60,257,213,312" href="122" target="_blank" />
  <area shape="rect" coords="215,257,376,314" href="#" target="_blank" />
</map>

</body>
</html>';
}


				$headers = "Organization: OyaCharge\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
				$headers .= "X-Priority: 3\r\n";
				$headers .= "X-Mailer: PHP" . phpversion() . "\r\n";
				$header = "From:blm.ypsilon@gmail.com \r\n";
				$header .= "Cc:blm.ypsilon@gmail.com \r\n";
				$header .= "MIME-Version: 1.0\r\n";
				$header .= "Content-type: text/html\r\n";
				$this->sendElasticEmail($to, $subject, "OyaCharge", $message, "care@oyacharge.com", "OyaCharge");
					
				//$retval = mail($to, $subject, $message, $header);
	}
function church_mail_send()
{
	$doner_user_id=$_REQUEST['user_id'];
	$church_id=$_REQUEST['church_id'];
	$trans_id=$_REQUEST['trans_id'];
	$donation_amount=$_REQUEST['amount'];
	$paytype=$_REQUEST['pay_type'];
	$this->church_mail($doner_user_id,$church_id,$trans_id,$donation_amount,$paytype);
}


function church_mail($doner_user_id,$church_id,$trans_id,$donation_amount,$paytype,$status) {
		$header_logo=maillogo;
		$img_icon=mail_image."img_icon.png";
		if($paytype=='0')
		{
			$pay_image=mail_image."logo_header.png";
		}else  if($paytype=='1')
		{
			$pay_image=mail_image."KongaPay.jpg";
		}else if($paytype=='2')
		{
			$pay_image=mail_image."webpay.png";
			
		}
		
		$currency_icon=mail_image."currency.png";
		$web_icon=mail_image."web.png";
		$current_date = date("Y-m-d h:i:sa");
		$recharge_user_id = $doner_user_id;
		$frnd_records = $this -> conn -> get_table_row_byidvalue('user', 'user_id', $recharge_user_id);
		$user_name = $frnd_records['0']['user_name'];
		$user_email = $frnd_records['0']['user_email'];
		$operator_records = $this -> conn -> get_table_row_byidvalue('church_list', 'church_id', $church_id);
		
		$church_image=church_image.$operator_records['0']['church_img'];
		$church_name = $operator_records['0']['church_name'];
		$church_records = $this -> conn -> get_table_row_byidvalue('church_list', 'church_id', $church_id);	
			$church_biller_id = $church_records['0']['church_biller_id'];
			$biller_records = $this -> conn -> get_table_row_byidvalue('biller_details', 'biller_id', $church_biller_id);
		
				$biller_email=$biller_records['0']['biller_email'];
				$to = $user_email;

				$subject = "Church Donation Details of OyaCharge";
				$path = mail_logo;
				if($status=='1'){
				$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>OyaCharge</title>
</head>
<body>
<table style="width:100%; max-width:600px; margin:0 auto;background-color:#80d6cd" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td width=""><table width="" cellspacing="0" cellpadding="0" align="center">
          <tbody>
            <tr>
              <td colspan="2" style="text-align:center;padding-top:15px;padding-left:20px"><img src="'.$header_logo.'" alt="Oyacharge" title="Oyacharge" class="CToWUd" /></td>
              
            </tr>
          </tbody>
        </table></td>
    </tr>
    <tr>
      <td style="text-align:center; padding-top:20px;"><img width="100" src="'.$img_icon.'" alt="Payment successful" title="Payment successful" class="CToWUd" /></td>
    </tr>
    <tr>
      <td height="30"></td>
    </tr>
    <tr align="center">
      <td style="font-size:18px;font-family:Arial,Helvetica,sans-serif;color:#fff"> Your '.$church_name.' Donation Successful! </td>
    </tr>
    <tr>
      <td height="10"></td>
    </tr>
    <tr align="center">
      <td style="font-size:11px;font-family:Arial,Helvetica,sans-serif;color:#fff"> '.$current_date.' </td>
    </tr>
    <tr>
      <td height="15"></td>
    </tr>
    <tr align="center">
      <td style="font-size:12px;font-family:Arial,Helvetica,sans-serif;color:#fff"><p>Dear '.$user_name.', thanks for transacting with us.</p>
        <p>Below Is Your Donation Details.</p>
        
    </tr>
    <tr>
      <td height="20"></td>
    </tr>
    <tr>
      <td><table style="background-color:#fff;border-width:1px;border-color:#d1d1d1;border-top-color:#57a9a0;border-style:solid;border-top-width:2px" align="center">
          <tbody>
            <tr>
              <td style="padding-left:10px" width="54"><img width="100px" src="'.$church_image.'" alt="" title="" class="CToWUd"   /></td>';
              $message.='<td style="padding-left:10px" width="54"><img width="100px" src="'.$pay_image.'" alt="card" title="" class="CToWUd" width="100px" /></td>
              <td style="font-size:15px;font-family:Arial,Helvetica,sans-serif;color:#6b6a6b" width="190"><p><span><img src="'.$currency_icon.'" /></span>'.$donation_amount.'</p></td>
            </tr>
            <tr>
              <td colspan="4" style="text-transform:uppercase;font-size:9px;font-family:Arial,Helvetica,sans-serif;color:#a7a7a7;border-top:1px solid #d1d1d1;padding:15px 20px"> Transition ID: <span style="font-size:13px;color:#6b6a6b">'.$trans_id.'</span></td>
            </tr>
          </tbody>
        </table></td>
    </tr>
    <tr>
      <td height="15"></td>
    </tr>
    <tr>
      <td height="75" style="font-size:24px; color:#fff; font-family:Arial, Helvetica, sans-serif; text-align:center;">Download our apps</td>
    </tr>
    <tr align="center">
      <td><img width="100%" src="'.$web_icon.'" alt="FreeCharge GO" usemap="#Map" class="CToWUd" border="0" /></td>
    </tr>
    <tr>
      <td height="15"></td>
    </tr>
    <tr>
      <td style="font-size:12px;font-family:Arial,Helvetica,sans-serif;color:#6b6a6b;padding:15px;line-height:20px">
      <table align="center"width="100%">
          <tbody>
            <tr>
              <td style="font-size:12px;font-family:Arial,Helvetica,sans-serif;color:#fff;padding:0 15px 15px 15px;line-height:20px"><a href="#" style="text-decoration:none; color:#fff;">For More Recharge Go To Our <span style="text-decoration:underline;">Website</span></a></td>
            </tr>
            <tr>
              <td style="font-size:12px;font-family:Arial,Helvetica,sans-serif;color:#fff;padding:0 15px 15px 15px;line-height:20px"> Best,<br />
                Team Oyacharge </td>
            </tr>
          </tbody>
        </table></td>
    </tr>
    <tr>
      <td style="padding:10px;"><span class="m_678193774613953679HOEnZb"><font color="#fff"> </font></span><span class="m_678193774613953679HOEnZb"><font color="#fff"> </font></span><span class="m_678193774613953679HOEnZb"><font color="#fff"> </font></span>
        <table align="center" width="100%">
          <tbody>
            <tr>
              <td style="width:50%;text-align:left;padding-left:15px"><table>
                  <tbody>
                    <tr>
                      <td><a href="#" target="_blank" data-saferedirecturl=""><img src="'.mail_image.'/fb.png" class="CToWUd" width="25" /></a></td>
                      <td><a href="#" target="_blank" data-saferedirecturl=""><img src="'.mail_image.'/tweet.png" class="CToWUd" width="25" /></a></td>
                      <td><a href="#" target="_blank" data-saferedirecturl=""><img src="'.mail_image.'/google.png" class="CToWUd" width="25" /></a></td>
                    </tr>
                  </tbody>
                </table>
                </td>
              <td style="width:50%; font-size:11px;font-family:Arial,Helvetica,sans-serif;color:#fff;width:50%;text-align:right">&copy; Oyacharge 2016 </td>
            </tr>
          </tbody>
        </table>
        <span class="HOEnZb"><font color="#888888"><span class="m_678193774613953679HOEnZb"><font color="#888888"> </font></span></font></span></td>
    </tr>
  </tbody>
</table>

<map name="Map" id="Map">
  <area shape="poly" coords="213,310" href="#" />
  <area shape="rect" coords="60,257,213,312" href="122" target="_blank" />
  <area shape="rect" coords="215,257,376,314" href="#" target="_blank" />
</map>

</body>
</html>';
}else if($status=='2')
{
	$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>OyaCharge</title>
</head>
<body>
<table style="width:100%; max-width:600px; margin:0 auto;background-color:#80d6cd" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td width=""><table width="" cellspacing="0" cellpadding="0" align="center">
          <tbody>
            <tr>
              <td colspan="2" style="text-align:center;padding-top:15px;padding-left:20px"><img src="'.$header_logo.'" alt="Oyacharge" title="Oyacharge" class="CToWUd" /></td>
              
            </tr>
          </tbody>
        </table></td>
    </tr>
    <tr>
      <td style="text-align:center; padding-top:20px;"><img width="100" src="'.$img_icon.'" alt="Payment Failed" title="Payment Failed" class="CToWUd" /></td>
    </tr>
    <tr>
      <td height="30"></td>
    </tr>
    <tr align="center">
      <td style="font-size:18px;font-family:Arial,Helvetica,sans-serif;color:#fff"> Your '.$church_name.' Donation has been failed! </td>
    </tr>
    <tr>
      <td height="10"></td>
    </tr>
    <tr align="center">
      <td style="font-size:11px;font-family:Arial,Helvetica,sans-serif;color:#fff"> '.$current_date.' </td>
    </tr>
    <tr>
      <td height="15"></td>
    </tr>
    <tr align="center">
      <td style="font-size:12px;font-family:Arial,Helvetica,sans-serif;color:#fff"><p>Dear '.$user_name.', thanks for transacting with us.</p>
        <p>Below Is Your Donation Details.</p>
        
    </tr>
    <tr>
      <td height="20"></td>
    </tr>
    <tr>
      <td><table style="background-color:#fff;border-width:1px;border-color:#d1d1d1;border-top-color:#57a9a0;border-style:solid;border-top-width:2px" align="center">
          <tbody>
            <tr>
              <td style="padding-left:10px" width="54"><img width="100px" src="'.$church_image.'" alt="" title="" class="CToWUd"   /></td>';
              $message.='<td style="padding-left:10px" width="54"><img width="100px" src="'.$pay_image.'" alt="card" title="" class="CToWUd" width="100px" /></td>
              <td style="font-size:15px;font-family:Arial,Helvetica,sans-serif;color:#6b6a6b" width="190"><p><span><img src="'.$currency_icon.'" /></span>'.$donation_amount.'</p></td>
            </tr>
            <tr>
              <td colspan="4" style="text-transform:uppercase;font-size:9px;font-family:Arial,Helvetica,sans-serif;color:#a7a7a7;border-top:1px solid #d1d1d1;padding:15px 20px"> ORDER ID: <span style="font-size:13px;color:#6b6a6b">'.$trans_id.'</span></td>
            </tr>
          </tbody>
        </table></td>
    </tr>
    <tr>
      <td height="15"></td>
    </tr>
    <tr>
      <td height="75" style="font-size:24px; color:#fff; font-family:Arial, Helvetica, sans-serif; text-align:center;">Download our apps</td>
    </tr>
    <tr align="center">
      <td><img width="100%" src="'.$web_icon.'" alt="OyaCharge GO" usemap="#Map" class="CToWUd" border="0" /></td>
    </tr>
    <tr>
      <td height="15"></td>
    </tr>
    <tr>
      <td style="font-size:12px;font-family:Arial,Helvetica,sans-serif;color:#6b6a6b;padding:15px;line-height:20px">
      <table align="center"width="100%">
          <tbody>
            <tr>
              <td style="font-size:12px;font-family:Arial,Helvetica,sans-serif;color:#fff;padding:0 15px 15px 15px;line-height:20px"><a href="#" style="text-decoration:none; color:#fff;">For More Recharge Go To Our <span style="text-decoration:underline;">Website</span></a></td>
            </tr>
            <tr>
              <td style="font-size:12px;font-family:Arial,Helvetica,sans-serif;color:#fff;padding:0 15px 15px 15px;line-height:20px"> Best,<br />
                Team Oyacharge </td>
            </tr>
          </tbody>
        </table></td>
    </tr>
    <tr>
      <td style="padding:10px;"><span class="m_678193774613953679HOEnZb"><font color="#fff"> </font></span><span class="m_678193774613953679HOEnZb"><font color="#fff"> </font></span><span class="m_678193774613953679HOEnZb"><font color="#fff"> </font></span>
        <table align="center" width="100%">
          <tbody>
            <tr>
              <td style="width:50%;text-align:left;padding-left:15px"><table>
                  <tbody>
                    <tr>
                      <td><a href="#" target="_blank" data-saferedirecturl=""><img src="'.mail_image.'/fb.png" class="CToWUd" width="25" /></a></td>
                      <td><a href="#" target="_blank" data-saferedirecturl=""><img src="'.mail_image.'/tweet.png" class="CToWUd" width="25" /></a></td>
                      <td><a href="#" target="_blank" data-saferedirecturl=""><img src="'.mail_image.'/google.png" class="CToWUd" width="25" /></a></td>
                    </tr>
                  </tbody>
                </table>
                </td>
              <td style="width:50%; font-size:11px;font-family:Arial,Helvetica,sans-serif;color:#fff;width:50%;text-align:right">&copy; Oyacharge 2016 </td>
            </tr>
          </tbody>
        </table>
        <span class="HOEnZb"><font color="#888888"><span class="m_678193774613953679HOEnZb"><font color="#888888"> </font></span></font></span></td>
    </tr>
  </tbody>
</table>

<map name="Map" id="Map">
  <area shape="poly" coords="213,310" href="#" />
  <area shape="rect" coords="60,257,213,312" href="122" target="_blank" />
  <area shape="rect" coords="215,257,376,314" href="#" target="_blank" />
</map>

</body>
</html>';
}

				$headers = "Organization: OyaCharge\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
				$headers .= "X-Priority: 3\r\n";
				$headers .= "X-Mailer: PHP" . phpversion() . "\r\n";
				$header = "From:blm.ypsilon@gmail.com \r\n";
				$header .= "Cc:blm.ypsilon@gmail.com \r\n";
				$header .= "MIME-Version: 1.0\r\n";
				$header .= "Content-type: text/html\r\n";
				$this->sendElasticEmail($to, $subject, "OyaCharge", $message, "care@oyacharge.com", "OyaCharge");
			
				$this->sendElasticEmail($biller_email, $subject, "OyaCharge", $message, "care@oyacharge.com", "OyaCharge");
		
			$admin_records = $this -> conn -> get_table_row_byidvalue('admin', 'admin_status', 1);
			$admin_email=$admin_records['0']['admin_email'];
				$this->sendElasticEmail('payment@oyacash.com', $subject, "OyaCharge", $message, "care@oyacharge.com", "OyaCharge");


		
	}


	/// forget send code///
	function forget_send_code($mobile) {
		$user_name=sms_user_name;
		$password=sms_password;
		$varifycode = rand('1000', '9999');
		//$code = 1234;
		$code = str_pad($varifycode, 3, '0', STR_PAD_LEFT);
		$mobileNumber = substr($mobile, 1);
		$msg = "New Password of Recharge login : " . $code;
		$encodedMessage = urlencode($msg);
		$url = "http://www.kudisms.net/components/com_spc/smsapi.php?username=$user_name&password=$password&sender=OyaCharge&recipient=$mobile&message=" .$encodedMessage;
		$ch = curl_init();
		curl_setopt_array($ch, array(CURLOPT_URL => $url, CURLOPT_RETURNTRANSFER => true, CURLOPT_POST => true, CURLOPT_POSTFIELDS => $postData, CURLOPT_FOLLOWLOCATION => true));
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$output = curl_exec($ch);
		curl_close($ch);
		return $code;
	}


function test_sms_api()
{
	$mobile_no=$_REQUEST['mobile_no'];
	 $user_name=sms_user_name;
		$password=sms_password;
		$varifycode = rand('1000', '9999');
		$code = str_pad($varifycode, 3, '0', STR_PAD_LEFT);
	//	$code = 1234;
		$mobile =  $mobile_no;
		// $mobileNumber = substr($mobile_no, 1);
		$msg="Your OyaCharge Account activation code is : '".$code."', use this secure code to register with OyaCharge";
	//	$msg = "Recharge Verification Code : " . $code;
		$encodedMessage = urlencode($msg);
		$url = "http://www.kudisms.net/components/com_spc/smsapi.php?username=$user_name&password=$password&sender=OyaCharge&recipient=$mobile&message=" .$encodedMessage;
		// $url="http://api.msg91.com/api/sendhttp.php";
		$ch = curl_init();
		curl_setopt_array($ch, array(CURLOPT_URL => $url, CURLOPT_RETURNTRANSFER => true, CURLOPT_POST => true,
		CURLOPT_FOLLOWLOCATION => true));
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$output = curl_exec($ch);
		curl_close($ch);
		return $code;
}
	///c/// send code //////
	function send_code($mobile_no) {
		$user_name=sms_user_name;
		$password=sms_password;
		$varifycode = rand('1111', '9999');
		$code = str_pad($varifycode, 3, '0', STR_PAD_LEFT);
	//	$code = 1234;
		$mobile =  $mobile_no;
		// $mobileNumber = substr($mobile_no, 1);
		$msg="Your OyaCharge Account activation code is : $code, use this secure code to register with OyaCharge";
	//	$msg = "Recharge Verification Code : " . $code;
		$encodedMessage = urlencode($msg);
		$url = "http://www.kudisms.net/components/com_spc/smsapi.php?username=$user_name&password=$password&sender=OyaCharge&recipient=$mobile&message=" .$encodedMessage;
		// $url="http://api.msg91.com/api/sendhttp.php";
		$ch = curl_init();
		curl_setopt_array($ch, array(CURLOPT_URL => $url, CURLOPT_RETURNTRANSFER => true, CURLOPT_POST => true,
		CURLOPT_FOLLOWLOCATION => true));
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$output = curl_exec($ch);
		curl_close($ch);
		return $code;
		//echo $output;
	}
//----- function send app link
function send_bill_user_msg($mobile,$invoice_no,$consumer_no,$amount)
{
	$user_name=sms_user_name;
	$password=sms_password;
	
		 $message='Your Invoice INV#'.$invoice_no.' '.'of amount Naira'.' '.$amount.' '.' is generated of consumer no.'.' '.$consumer_no;
		$encodedMessage = urlencode($message);
		 $url = "http://www.kudisms.net/components/com_spc/smsapi.php?username=$user_name&password=$password&sender=OyaCharge&recipient=$mobile&message=" .$encodedMessage;
		
		$ch = curl_init();
		curl_setopt_array($ch, array(CURLOPT_URL => $url, CURLOPT_RETURNTRANSFER => true, CURLOPT_POST => true,
		CURLOPT_FOLLOWLOCATION => true));
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$output = curl_exec($ch);
		curl_close($ch);
}
function send_app_link()
{
	if(!empty($_REQUEST['mobile_no']))
	{
		$user_name=sms_user_name;
		$password=sms_password;
		$mobile=$_REQUEST['mobile_no'];
		$msg="Download and get offer from our app : https://goo.gl/EVVl2b ";
		$encodedMessage = urlencode($msg);
		$url = "http://www.kudisms.net/components/com_spc/smsapi.php?username=$user_name&password=$password&sender=OyaCharge&recipient=$mobile&message=" .$encodedMessage;
		$ch = curl_init();
		curl_setopt_array($ch, array(CURLOPT_URL => $url, CURLOPT_RETURNTRANSFER => true, CURLOPT_POST => true,
		CURLOPT_FOLLOWLOCATION => true));
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$output = curl_exec($ch);
		curl_close($ch);
		echo "1";
	}
}
// function ==--------Event part------====
function event_list()
{
	if(!empty($_REQUEST['event_category']))
	{
	 $event_category=$_REQUEST['event_category'];
	$events_records = $this -> conn -> get_table_field_doubles_by_date('event_list', 'event_status', '1', 'event_category', $event_category,'event_date');
	
	}else{
				$events_records = $this -> conn -> get_table_row_byidvalue_by_date('event_list', 'event_status', '1','event_date');
	}
		if(!empty($events_records))
		{
			foreach($events_records as $val)
			{
				$event_id			=	$val['event_id'];
				$event_name 		=	$val['event_name'];
				$event_place		=	$val['event_place'];
				$event_date 		=	$val['event_date'];
				$date_event 		=   date("d", strtotime($event_date));
				$Month_event		=   date('M', strtotime($event_date));
				$event_date 		=	date("d-m-Y", strtotime($event_date));
				$event_time 		=	$val['event_time'];
				$event_biller_id	=	$val['event_biller_id'];
				$event_tickets_id	=	$val['event_tickets_id'];
				$event_add_lat		=	$val['event_place_lat'];
				$event_add_log		=	$val['event_place_log'];
				$events_tickets 	=   $this -> conn -> get_record_find_in_set('events_tickets', 'events_tickets_id', $event_tickets_id);
					$arr=array();
					for($i=0;$i<count($events_tickets);$i++){
				$arr[]=array('event_ticket_id'=>$events_tickets[$i]['events_tickets_id'],'event_pass_name'=>$events_tickets[$i]['events_tickets_name'],'event_price'=>$events_tickets[$i]['events_tickets_price']);
					}
				$event_image=$val['event_image'];
				$event_contact_no=$val['event_contact_no'];
				$event_desc=$val['event_desc'];
				$data[]=array('event_id'=>$event_id,'event_name'=>$event_name,'event_place'=>$event_place,'event_date'=>$event_date,'event_time'=>$event_time,'event_biller_id'=>$event_biller_id,'event_pass'=>$arr,'event_image'=>event_image.$event_image,'event_contact_no'=>$event_contact_no,'event_desc'=>$event_desc,'day_event'=>$date_event,'month_event'=>$Month_event,'event_place_lat'=>$event_add_lat,'event_place_log'=>$event_add_log);
			}
			$post=array('status'=>'true','message'=>'Event list found','event_list'=>$data);
		}else{
			$post=array('status'=>'false','message'=>'No Event Found');
		}
	// }else{
		//	$post=array('status'=>'false','message'=>'Missing Parameter','event_category'=>$_REQUEST['event_category']);
//	}
echo $this -> json($post);
}
// function get_event
function get_event()
{
	if(!empty($_REQUEST['event_id']))
	{
		$event_id=$_REQUEST['event_id'];
		$events_records = $this -> conn -> get_table_field_doubles_by_date('event_list', 'event_status', '1', 'event_id', $event_id,'event_date');
		if(!empty($events_records))
		{
				$event_id			=	$events_records[0]['event_id'];
				$event_name			=	$events_records[0]['event_name'];
				$event_place		=	$events_records[0]['event_place'];
				$event_date			=	$events_records[0]['event_date'];
				$event_time			=	$events_records[0]['event_time'];
				$event_add_lat		=	$events_records[0]['event_place_lat'];
				$event_add_log		=	$events_records[0]['event_place_log'];
				$event_datetime 	=	date('l, d F Y h:i:s A',strtotime($event_date)); 
				$event_biller_id	=	$events_records[0]['event_biller_id'];
				$event_tickets_id	=	$events_records[0]['event_tickets_id'];
					$events_tickets = $this -> conn -> get_record_find_in_set('events_tickets', 'events_tickets_id', $event_tickets_id);
					$arr=array();
					
					//	$event_ids=implode(',', $events_tickets[$i]['events_tickets_id']);
			for($i=0;$i<count($events_tickets);$i++){
				$id_event_ticket[]=$events_tickets[$i]['events_tickets_id'];
					$arr[]=array('event_ticket_id'=>$events_tickets[$i]['events_tickets_id'],'event_pass_name'=>$events_tickets[$i]['events_tickets_name'],'event_price'=>$events_tickets[$i]['events_tickets_price']);
					}
				$event_ids			=	implode(",",$id_event_ticket);
				$event_image		=	$events_records[0]['event_image'];
				$event_contact_no	=	$events_records[0]['event_contact_no'];
				$event_desc			=	$events_records[0]['event_desc'];
				
				$post=array('status'=>'true','message'=>'Event list found','event_id'=>$event_id,'event_name'=>$event_name,'event_place'=>$event_place,'event_date'=>$event_date,'event_time'=>$event_time,'event_biller_id'=>$event_biller_id,'event_pass'=>$arr,'event_image'=>event_image.$event_image,'event_contact_no'=>$event_contact_no,'event_desc'=>$event_desc,'event_datetime'=>$event_datetime,'event_tickets_ids'=>$event_ids,'event_place_lat'=>$event_add_lat,'event_place_log'=>$event_add_log);
		}else{
			$post=array('status'=>'false','message'=>'No Event Found');
		}
		}else{
			$post=array('status'=>'false','message'=>'Missing Parameter','event_category'=>$_REQUEST['event_category']);
		}
echo $this -> json($post);
		
	
}
//=== rating of user====
function user_rating()
{
	
	if(!empty($_REQUEST['user_id']) && !empty($_REQUEST['rating']))
	{
		$user_id=$_REQUEST['user_id'];
	$rating=$_REQUEST['rating'];
	$comments=$_REQUEST['comments'];
	$user_records = $this -> conn -> get_table_row_byidvalue('user', 'user_id', $user_id);
		if(!empty($user_records))
		{
		$data['rating_datetime'] = date("Y-m-d h:i:s");
		$data['rating'] = $rating;
		$data['rating_comments'] = $comments;
		$update_rating = $this -> conn -> updatetablebyid('user', 'user_id', $user_id, $data);	
		$post=array('status'=>'true','message'=>'rating save successfully','user_id'=>$user_id,'rating'=>$rating,'comments'=>$comments);
		//$post=array('status'=>'true','message'=>'rating save successfully');
		}else{
			$post=array('status'=>'false','message'=>'user not found');
		}
		}else{
			$post=array('status'=>'false','message'=>'missing parameter','user_id'=>$_REQUEST['user_id'],'rating'=>$_REQUEST['rating']);
		}
		echo $this -> json($post);
}
// function add cart event ticket
function check_ticket_record()
{
	
	$ticket_record=json_decode($_REQUEST['ticket_record']);
	for($i=0;$i<count($ticket_record);$i++)
		{
			//$event_id=$ticket_record[$i]->event_id;
			$ticket_count +=$ticket_record[$i]->event_quantity_ticket;
		}
		if($ticket_count<=0)
		{
			
			$post=array('status'=>'false','message'=>'Please select atleast one ticket');
			echo $this -> json($post);
			exit();
		
		}
		
	 $event_id=$_REQUEST['event_id'];
	 	if(!empty($ticket_record) && !empty($event_id))
	{
	 $event_records = $this -> conn -> get_table_row_byidvalue('event_list', 'event_id', $event_id);
	 if(!empty($event_records)){
	
//$ticket_record=json_decode($ticket_record);
	
		for($i=0;$i<count($ticket_record);$i++)
		{
			//$event_id=$ticket_record[$i]->event_id;
			$ticket_id=$ticket_record[$i]->event_ticket_id;
			$ticket_count=$ticket_record[$i]->event_quantity_ticket;
			//$ticket_records = $this -> conn -> get_table_row_byidvalue('event_ticket_record', 'event_id', '1');
			$ticket_records = $this -> conn -> join_two_table_where_two_field('event_ticket_record','events_tickets','event_ticket_id','events_tickets_id', 'event_id', $event_id, 'event_ticket_id', $ticket_id);
			
	//	$ticket_records = $this -> conn -> get_table_field_doubles('event_ticket_record', 'event_id', $event_id, 'event_ticket_id', $ticket_id);
			
			if($ticket_records[0]['event_ticket_limit']>=$ticket_count)
			{
				
				$post1[]=array('ticket_status'=>'1','ticket_id'=>$ticket_records[0]['event_ticket_id'],'ticket_required'=>$ticket_count,'ticket_limit'=>$ticket_records[0]['event_ticket_limit'],'ticket_name'=>$ticket_records[0]['events_tickets_name']);
			}else{
				
				//$data[]=array('ticket_id'=>$ticket_records[0]['event_ticket_id'],'ticket_limit'=>$ticket_records[0]['event_ticket_limit']);
				$post1[]=array('ticket_status'=>'2','ticket_id'=>$ticket_records[0]['event_ticket_id'],'ticket_required'=>$ticket_count,'ticket_limit'=>$ticket_records[0]['event_ticket_limit'],'ticket_name'=>$ticket_records[0]['events_tickets_name']);
			}
				
			}

		$post=array('status'=>'true','message'=>'ticket_record','records'=>$post1);
		}else{
				$post=array('status'=>'false','message'=>'Invalid Event ID');
		}
	}else{
		
	$post=array('status'=>'false','message'=>'missing parameter','ticket_record'=>$_REQUEST['ticket_record'],'event_id'=>$_REQUEST['event_id']);
		}
		echo $this -> json($post);
}
/// dstv plan
function dstv_plan()
{
	$plan_records = $this -> conn -> get_table_row_byidvalue('tv_plans', 'tv_plans_status', '1');
	if(!empty($plan_records))
	{
		foreach($plan_records as $val)
		{
			
			$tv_plans_id=$val['tv_plans_id'];
			$service_id=$val['service_id'];
			$tv_plans_name=$val['tv_plans_name'];
			$tv_plans_price=$val['tv_plans_price'];
			$tv_plans_code=$val['tv_plans_code'];
			$tv_plans_validity=$val['plan_validity'];
				$description=$val['description'];
			$data[]=array('plan_id'=>$tv_plans_id,'service_id'=>$service_id,'name'=>$tv_plans_name,'price'=>$tv_plans_price,'code'=>$tv_plans_code,'validity'=>$tv_plans_validity,'description'=>$description);
		}
		$post=array('status'=>'true','message'=>'plans avalible','plans'=>$data);
	}else{
		$post=array('status'=>'false','message'=>'plans not avalible');
	}
	echo $this -> json($post);
		
}
//function reset oya_pin
function reset_oyapin()
{
	if(!empty($_REQUEST['user_email']) && !empty($_REQUEST['user_id']))
	{
		$email=$_REQUEST['user_email'];
		$user_id=$_REQUEST['user_id'];
			$user_records = $this -> conn -> get_table_field_doubles('user', 'user_email', $email, 'user_id', $user_id);
		//$user_records = $this -> conn -> get_table_row_byidvalue('user', 'user_email', $email);
		if(!empty($user_records))
		{
			$user_id=$user_records[0]['user_id'];
			$pin_records = $this -> conn -> get_table_row_byidvalue('save_pin', 'user_id', $user_id);
			$pin_id=$pin_records[0]['save_pin_id'];
			$pin=rand('1111','9999');
			$data['user_transfer_pin']=$pin;
			$update_pin= $this -> conn -> updatetablebyid('save_pin', 'user_id', $user_id, $data);	
			$user_email = $email;
				$subject = 'New Oya-pin of OyaCharge';
				$message= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>Untitled Document</title></head>

<body bgcolor="#f1f1f1">
<table cellpadding="0" cellspacing="0" width="600" style="background:#fff; border:1px solid #cbcbcb; margin:0 auto; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
	<thead class="header">
    	<tr>
        	<td style="background:#FFFFFF; height:62px; width:100%; padding:5px; border-bottom:1px solid #DDD;" valign="middle">
            	<a href="#" style="margin-left:10px;"><img width="100" src="'.mail_logo.'" alt="..."/></a>
                
            </td>
        </tr>
    </thead>
    <tbody style=" background:#FEFEFE; border-bottom:1px solid #ddd;">
    	<tr>
        	<td style="padding:10px 15px;">
            	<h1 style="margin-bottom:0px; color:#337d75;">OyaCharge </h1>
            	<p> Dear '.$name.', below is the new oya-pin as per request. 
</p>';
             $message .=  '<p>Username:<strong>' .$email;'</strong></p>';
              $message .=  '<p>Oya Pin:<strong>'.$pin;'</strong></p></td></tr>';
          $message .= '<tr><td style="background:#ddd; height:1px; width:100%;"></td></tr></tbody>';
    
    $message .= '<tfoot style="background:#337d75; text-align:center; color:#fff;"><tr><td><p> Copyright © 2016 OyaCharge All right reserved </p></td><tr></tfoot></table></body></html>';
			
			$headers = "Organization: OyaCharge\r\n";
  			$headers .= "MIME-Version: 1.0\r\n";
		  	$headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
		  	$headers .= "X-Priority: 3\r\n";
		  	$headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;
          	
         	$header .= "MIME-Version: 1.0\r\n";
         	$header .= "Content-type: text/html\r\n";
         //	$retval = mail ($to,$subject,$message,$header);
			$this->sendElasticEmail($email, $subject,"OyaCharge", $message, "care@oyacharge.com", "OyaCharge");
			$post=array('status'=>'true','message'=>'New OYAPIN sent to registered email');
		}else{
			$post=array('status'=>'false','message'=>'Email not valid! Please Contact to Oyacharge Support');
		}
		
	}else{
		$post=array('status'=>'false','message'=>'Missing parameter','user_email'=>$_REQUEST['user_email']);
	}
	echo $this -> json($post);
}


function ticket_booking_payment()
{
	if(!empty($_REQUEST['event_id'])&&($_REQUEST['tickets_records'])&&($_REQUEST['user_id'])&&($_REQUEST['ticket_price']))
	{
		
		$coupon_id = $_REQUEST['coupon_id'];
		$coupon_amount = $_REQUEST['coupon_amount'];
		$event_id=$_REQUEST['event_id'];
		$tickets_record=json_decode($_REQUEST['tickets_records']);
		$ticket_json_record=$tickets_record;
		$ticket_price=$_REQUEST['ticket_price'];
		//$event_records = $this -> conn -> get_table_row_byidvalue('event_list', 'event_id', $event_id);
		$event_records = $this -> conn -> join_two_table('event_list','biller_details','event_biller_id','biller_id', 'event_id', $event_id);
		$biller_email = $event_records['0']['biller_email'];
		$biller_contact_no = $event_records['0']['biller_contact_no'];
		$biller_id = $event_records['0']['event_biller_id'];
		$event_name = $event_records['0']['event_name'];

	if (!empty($event_records)) 
	{
		for($i=0;$i<count($tickets_record);$i++)
		{
			//print_r($tickets_record[$i]->event_ticket_id);
			$ticket_id=$tickets_record[$i]->event_ticket_id;
			$ticket_rec[]=$tickets_record[$i]->event_ticket_id;
			$ticket_count=$tickets_record[$i]->event_quantity_ticket;
			//$ticket_records = $this -> conn -> get_table_row_byidvalue('event_ticket_record', 'event_id', '1');
			$ticket_records = $this -> conn -> join_two_table_where_two_field('event_ticket_record','events_tickets','event_ticket_id','events_tickets_id', 'event_id', $event_id, 'event_ticket_id', $ticket_id);
		if(!empty($ticket_count)){
			if($ticket_records[0]['event_ticket_limit']>=$ticket_count)
			{
				$true_record[]=array('ticket_id'=>$ticket_records[0]['event_ticket_id'],'ticket_required'=>$ticket_count);
			}else{
				$false_record[]=array('ticket_status'=>'2','ticket_id'=>$ticket_records[0]['event_ticket_id'],'ticket_required'=>$ticket_count,'ticket_limit'=>$ticket_records[0]['event_ticket_limit']);
			}
			}		
			}
	
if(!empty($true_record) && empty($false_record))
{
				$user_id=$_REQUEST['user_id'];
			
				$current_date = date("Y-m-d H:i:s");
				$wt_category='16';
				$wt_desc="Event Ticket Booking";
				$records = $this -> conn -> get_table_row_byidvalue('user', 'user_id', $user_id);
					$wallet_amount = $records['0']['wallet_amount'];
					$admin = $this -> conn -> get_all_records('admin');
					$admin_wallet = $admin['0']['admin_wallet'];
					$transaction_id = strtotime("now") . mt_rand(10, 99);
					$reffer_status = $records['0']['reffer_amount_status'];
					$reffer_user_id = $records['0']['reffer_user_id'];
					$user_number = $records['0']['user_contact_no'];
					$user_email = $records['0']['user_email'];
					$rec_ticket=implode(',', $ticket_rec);
					if ($wallet_amount >= $ticket_price) {
						$recharge = $this -> conn -> insertnewrecords('wallet_transaction', 'wt_user_id, wt_datetime,wt_category,wt_amount,transaction_id,wt_desc', '"' . $user_id . '","' . $current_date . '","' . $wt_category . '","' . $ticket_price . '","' . $transaction_id . '","' . $wt_desc . '"');
						if ($recharge) {
							
								$ticket_booking = $this -> conn -> insertnewrecords('booking_event_tickets','booking_event_id,booking_user_id,booking_ticket_id, booking_ticket_price,transaction_id,transaction_date,event_biller_id', '"' . $event_id . '","' . $user_id . '","' . $rec_ticket . '","' . $ticket_price . '","' . $transaction_id . '","' . $current_date . '","' . $biller_id . '"');
				
					if (!empty($coupon_id)) {

						$coupon_apply = $this -> conn -> insertnewrecords('coupon_details', 'coupon_id, user_id,coupon_apply_date', '"' . $coupon_id . '","' . $user_id . '","' . $current_date . '"');
						if (!empty($coupon_apply)) {
								
							$records_coupon = $this -> conn -> get_table_row_byidvalue('offer_coupon', 'coupon_id', $coupon_id);
						
						$coupon_count = $records_coupon['0']['coupon_limit'];
						if($coupon_count>0){
							$data_coupon['coupon_limit'] = $coupon_count - 1;
						$update_toekn = $this -> conn -> updatetablebyid('offer_coupon', 'coupon_id', $coupon_id, $data_coupon);
						}
						
							$transaction_id = strtotime("now") . mt_rand(10, 99);
							$walletrecharge = $this -> conn -> insertnewrecords('wallet_transaction', 'wt_user_id,wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc', '"' . $user_id . '","' . $current_date . '","' . $wallet_type . '","' . $coupon_amount . '","' . $wallet_category . '","' . $transaction_id . '","' . $w_desc . '"');
						}
					}
	
						$user_wallet = $wallet_amount - $ticket_price+ $coupon_amount;
						$data['wallet_amount'] = $user_wallet;
						$update_toekn = $this -> conn -> updatetablebyid('user', 'user_id', $user_id, $data);
						if ($reffer_status == '2') 
						{
							$this->refferal_code($user_id,$reffer_user_id,$user_number,$wallet_amount);	
						}
						$this->ticket_update($ticket_json_record,$event_id);
						$this->booking_ticket($ticket_json_record,$ticket_booking,$current_date,$user_id);
						$this->event_ticket_mail($ticket_booking,$biller_email);
						$this->send_event_msg($user_number,$event_name,$biller_contact_no);

						
						//$this->free_offer_mail($user_id);
					//	$this -> church_message($user_number, $ticket_price, $transaction_id,'1');
						//$this->church_mail($user_id,$church_id,$transaction_id,$church_product_price,'0','1');
							$post = array("status" => "true", 'message' => "Event Ticket booking Successfully", "wallet_id" => $recharge, 'event_id' => $event_id, 'booking_amount' => $ticket_price, 'wallet_amount' => $user_wallet, 'transaction_id' => $transaction_id,'transaction_date' => date('F-d-Y h:i A',strtotime($current_date)));
						}
					}else{
						$pay_amount = $recharge_amount - $wallet_amount;
						$post = array('status' => "false", "message" => "Not sufficent amount in  your wallet", 'wallet_amount' => $wallet_amount, 'booking_amount' => $ticket_price, 'transaction_id' => $transaction_id,'transaction_date' => date('F-d-Y h:i A',strtotime($current_date)));
						echo $this -> json($post);
						exit();
					}
					
}else{
	$post = array('status' => "false", "message" => "Ticket is not avalible", 'ticket_record' => $false_record, 'booking_amount' => $ticket_price);
						echo $this -> json($post);
						exit();
}
}else
	{
		$post = array('status' => "false", "message" => "No event avalible of this event id", 'event_id' => $church_id);				
	}
				
			
	}else{
	$post = array('status' => "false", "message" => "Missing parameter", 'event_id' => $_REQUEST['event_id'], 'user_id' => $_REQUEST['user_id'], 'ticket_price' => $_REQUEST['ticket_price']);
		}
		echo $this -> json($post);
}
function booking_ticket($tickets_record,$ticket_booking,$current_date,$user_id)
{
	
	for($i=0;$i<count($tickets_record);$i++)
	{
		$ticket_id=$tickets_record[$i]->event_ticket_id;
		$ticket_count=$tickets_record[$i]->event_quantity_ticket;
		$booking = $this -> conn -> insertnewrecords('booking_ticket_status','booking_id,booking_ticket_id,booking_ticket_qty, booking_ticket_date,booking_user_id', '"' . $ticket_booking . '","' . $ticket_id . '","' . $ticket_count . '","' . $current_date . '","' . $user_id . '"');
	}
	
}
function ticket_update($tickets_record,$event_id)
{
	
		for($i=0;$i<count($tickets_record);$i++)
		{
			$ticket_id=$tickets_record[$i]->event_ticket_id;
			$ticket_count=$tickets_record[$i]->event_quantity_ticket;
		
			$tickets = $this -> conn -> get_table_field_doubles('event_ticket_record', 'event_id', $event_id, 'event_ticket_id', $ticket_id); 
			$event_ticket_limit = $tickets['0']['event_ticket_limit'];
			$event_ticket_record_id = $tickets['0']['event_ticket_record_id'];
			$data['event_ticket_limit'] = $event_ticket_limit-$ticket_count;
			$update_toekn = $this -> conn -> updatetablebyid('event_ticket_record', 'event_ticket_record_id', $event_ticket_record_id, $data);
		}		
}

function ticket_booking_payment_with_card()
{

	if(!empty($_REQUEST['event_id']) && ($_REQUEST['tickets_records']) && ($_REQUEST['user_id']) && ($_REQUEST['ticket_price']) && ($_REQUEST['payment_gateway_price']))
	{
		$user_id=$_REQUEST['user_id'];
		$coupon_id = $_REQUEST['coupon_id'];
		$coupon_amount = $_REQUEST['coupon_amount'];
		 $payment_gateway_price=$_REQUEST['payment_gateway_price'];
		$event_id=$_REQUEST['event_id'];
		$tickets_record=json_decode($_REQUEST['tickets_records']);
		$ticket_json_record=$tickets_record;
	//	$event_records = $this -> conn -> get_table_row_byidvalue('event_list', 'event_id', $event_id);
		$event_records = $this -> conn -> join_two_table('event_list','biller_details','event_biller_id','biller_id', 'event_id', $event_id);
		$biller_email = $event_records['0']['biller_email'];
		$biller_contact_no = $event_records['0']['biller_contact_no'];
		$biller_id = $event_records['0']['event_biller_id'];
		$event_name = $event_records['0']['event_name'];
	if (!empty($event_records)) 
	{
		for($i=0;$i<count($tickets_record);$i++)
		{
			$ticket_id=$tickets_record[$i]->event_ticket_id;
			$ticket_rec[]=$tickets_record[$i]->event_ticket_id;
			$ticket_count=$tickets_record[$i]->event_quantity_ticket;
			$ticket_records = $this -> conn -> join_two_table_where_two_field('event_ticket_record','events_tickets','event_ticket_id','events_tickets_id', 'event_id', $event_id, 'event_ticket_id', $ticket_id);
		if(!empty($ticket_count)){
			if($ticket_records[0]['event_ticket_limit']>=$ticket_count)
			{
				$true_record[]=array('ticket_id'=>$ticket_records[0]['event_ticket_id'],'ticket_required'=>$ticket_count);
			}else{
				
				$false_record[]=array('ticket_id'=>$ticket_records[0]['event_ticket_id'],'ticket_required'=>$ticket_count);
			}
	}		
}
	
if(!empty($true_record) && empty($false_record))
{
		$payment_type 			=   $_REQUEST['payment_type'];  // 1-card,2-bank account
		$savecard_status		= 	$_REQUEST['savecard_status']; // 1- Save , 2 for not save
		$card_pay_type 			= 	$_REQUEST['card_pay_type'];   // 1-card, 2- card_token
		$card_no				=	$_REQUEST['card_no'];
		$expiry_month			=	$_REQUEST['expiry_month'];
		$expiry_year			=	$_REQUEST['expiry_year'];
		$cvv_no					=	$_REQUEST['cvv_no'];

		$recipient_bank			=	$_REQUEST['recipient_bank'];
		$rec_ac_no				=	$_REQUEST['recipient_account_number'];
		$sender_ac_no			=	sender_account_number;
		$sender_bank			=	sender_bank;
		$passcode				=	$_REQUEST['passcode'];
		$rec_ac_no				=	$_REQUEST['recipient_account_number'];
		$card_token				=	$_REQUEST['card_token'];
		if($payment_type == '1')
		{
			$transaction_via="Credit/Debit Card";
			if($card_pay_type=='1')
			{
				$pay = $this->payment_card($card_no,$expiry_month,$expiry_year,$cvv_no,$user_id,$payment_gateway_price,$savecard_status,$verve_card_status,$verve_card_pin,'1');
			}else 
				if($card_pay_type=='2')
				{
					$records_cards = $this -> conn -> get_table_field_doubles('save_card_details', 'save_card_userid', $user_id, 'save_card_token', $card_token);
					$cardid			=	$records_cards[0]['card_id'];
					$cardtoken		=	$records_cards[0]['save_card_token'];
					$save_card_no	=	$records_cards[0]['save_card_no'];
					$cardfour_digit = substr($save_card_no, -4);
					$pay			=	$this->payment_card_token($cardfour_digit,$cardtoken,$cvv_no,$user_id,$payment_gateway_price,$cardid);
				}
		}
		else 
		if($payment_type == '2')
		{
			$transaction_via="Bank Account";
			$pay = $this->payment_bank($recipient_bank,$rec_ac_no,$sender_ac_no,$sender_bank,$passcode,$user_id,$payment_gateway_price);
		}
		$para						= explode("/", $pay);
		$status						= $para[0];
		
		$payment_transaction_id		= $para[1];
		$trans_ref_no				= $para[2];
		$data_store_id				= $para[3];
		if($status=='error')
		{
			$post = array('status' => "false", "message" => $payment_transaction_id, 'transaction_id' => $payment_transaction_id,'transaction_date' => date('F-d-Y h:i A',strtotime($current_date)),'transaction_ref'=>$trans_ref_no,'transaction_via'=>$transaction_via);
			echo $this -> json($post);
			exit();
		}
				$payment_gateway_type =	$payment_type;  // 1-card,2-bank account
				$ticket_price 		  =	$_REQUEST['ticket_price'];
				$current_date 		  = date("Y-m-d H:i:s");
				$wt_category 		  = '16';
				$wt_desc 			  =	"Event Ticket Booking";
				$records = $this -> conn -> get_table_row_byidvalue('user', 'user_id', $user_id);
					$wallet_amount 	  = $records['0']['wallet_amount'];
					$user_email       = $records['0']['user_email'];
					//$admin = $this -> conn -> get_all_records('admin');
					//$admin_wallet = $admin['0']['admin_wallet'];
					$transaction_id  = strtotime("now") . mt_rand(10, 99);
					$reffer_status   = $records['0']['reffer_amount_status'];
					$reffer_user_id  = $records['0']['reffer_user_id'];
					$user_number     = $records['0']['user_contact_no'];
					$rec_ticket      = implode(',', $ticket_rec);
					$recharge        = $this -> conn -> insertnewrecords('wallet_transaction', 'wt_user_id, wt_datetime,wt_category,wt_amount,transaction_id,wt_desc,payment_type,payment_gateway_id,user_card_card_rec_amount,trans_ref_no', '"' . $user_id . '","' . $current_date . '","' . $wt_category . '","' . $ticket_price . '","' . $transaction_id . '","' . $wt_desc . '","' . $payment_gateway_type . '","' . $payment_gateway_id . '","' . $payment_gateway_price . '","' . $trans_ref_no . '"');
						if ($recharge) {
							
							$ticket_booking = $this -> conn -> insertnewrecords('booking_event_tickets','booking_event_id,booking_user_id,booking_ticket_id, booking_ticket_price,transaction_id,transaction_date,event_biller_id', '"' . $event_id . '","' . $user_id . '","' . $rec_ticket . '","' . $ticket_price . '","' . $transaction_id . '","' . $current_date . '","' . $biller_id . '"');
						
						if (!empty($coupon_id)) {

						$coupon_apply = $this -> conn -> insertnewrecords('coupon_details', 'coupon_id, user_id,coupon_apply_date', '"' . $coupon_id . '","' . $user_id . '","' . $current_date . '"');
						if (!empty($coupon_apply)) {
								
							$records_coupon = $this -> conn -> get_table_row_byidvalue('offer_coupon', 'coupon_id', $coupon_id);
						
						$coupon_count = $records_coupon['0']['coupon_limit'];
						if($coupon_count>0){
							$data_coupon['coupon_limit'] = $coupon_count - 1;
						$update_toekn = $this -> conn -> updatetablebyid('offer_coupon', 'coupon_id', $coupon_id, $data_coupon);
						}
						
							$transaction_id = strtotime("now") . mt_rand(10, 99);
							$walletrecharge = $this -> conn -> insertnewrecords('wallet_transaction', 'wt_user_id,wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc', '"' . $user_id . '","' . $current_date . '","' . $wallet_type . '","' . $coupon_amount . '","' . $wallet_category . '","' . $transaction_id . '","' . $w_desc . '"');
						}
					}
					$user_wallet = $wallet_amount  + $coupon_amount;
					$data['wallet_amount'] = $user_wallet;

					$update_toekn = $this -> conn -> updatetablebyid('user', 'user_id', $user_id, $data);
						if ($reffer_status == '2') 
						{
							$this->refferal_code($user_id,$reffer_user_id,$user_number,$wallet_amount);	
						}
						$this->ticket_update($ticket_json_record,$event_id);
						$this->booking_ticket($ticket_json_record,$ticket_booking,$current_date,$user_id);
						// event Biller
						$this->event_ticket_mail($ticket_booking,$biller_email);
						$this->send_event_msg($user_number,$event_name,$biller_contact_no);
						// User mail and msg
						
				
							$post = array("status" => "true", 'message' => "Event Ticket booking Successfully", "wallet_id" => $recharge, 'event_id' => $event_id, 'booking_amount' => $ticket_price, 'wallet_amount' => $wallet_amount,'transaction_id' => $payment_transaction_id,'transaction_date' => date('F-d-Y h:i A',strtotime($current_date)),'transaction_ref'=>$trans_ref_no,'transaction_via'=>$transaction_via);
						}
					
					
}else{
	$post = array('status' => "false", "message" => "Ticket is not avalible", 'ticket_record' => $false_record, 'booking_amount' => $ticket_price,'transaction_date' => date('F-d-Y h:i A',strtotime($current_date)));
						echo $this -> json($post);
						exit();
}
}else
	{
		$post = array('status' => "false", "message" => "No event avalible of this event id", 'event_id' => $church_id);				
	}
				
			
	}else{
	$post = array('status' => "false", "message" => "Missing parameter", 'event_id' => $_REQUEST['event_id'], 'user_id' => $_REQUEST['user_id'], 'ticket_price' => $_REQUEST['ticket_price'], 'payment_gateway_id' => $_REQUEST['payment_gateway_id'], 'payment_gateway_price' => $_REQUEST['payment_gateway_price'],'payment_gateway_type'=>$_REQUEST['payment_gateway_type']);
		}
		echo $this -> json($post);
}
function ticket_booking_payment_wallet_with_card()
{
	if(!empty($_REQUEST['event_id'])&&($_REQUEST['tickets_records']) &&($_REQUEST['user_id'])&&($_REQUEST['ticket_price'])  && $_REQUEST['payment_gateway_price'])
	{
		$event_id=$_REQUEST['event_id'];
		$tickets_record=json_decode($_REQUEST['tickets_records']);
		$ticket_json_record=$tickets_record;
		$user_id=$_REQUEST['user_id'];
		$ticket_price=$_REQUEST['ticket_price'];
		$current_date = date("Y-m-d H:i:s");
		$wallet_amt=$_REQUEST['ticket_price']-$_REQUEST['payment_gateway_price'];
		$card_rec_amt=$_REQUEST['payment_gateway_price'];
		$payment_gateway_type = $_REQUEST['payment_gateway_type'];  // 1-kongopay,2-webpay
		$coupon_id = $_REQUEST['coupon_id'];
		$coupon_amount = $_REQUEST['coupon_amount'];
		$wt_category='16';
		$wt_desc="Event Ticket Booking";
	//	$event_records = $this -> conn -> get_table_row_byidvalue('event_list', 'event_id', $event_id);
		$event_records = $this -> conn -> join_two_table('event_list','biller_details','event_biller_id','biller_id', 'event_id', $event_id);
		$biller_email = $event_records['0']['biller_email'];
		$biller_id = $event_records['0']['event_biller_id'];
			$event_name = $event_records['0']['event_name'];
	if (!empty($event_records)) 
	{
		
		for($i=0;$i<count($tickets_record);$i++)
		{
			$ticket_id=$tickets_record[$i]->event_ticket_id;
			$ticket_rec[]=$tickets_record[$i]->event_ticket_id;
			$ticket_count=$tickets_record[$i]->event_quantity_ticket;
			$ticket_records = $this -> conn -> join_two_table_where_two_field('event_ticket_record','events_tickets','event_ticket_id','events_tickets_id', 'event_id', $event_id, 'event_ticket_id', $ticket_id);
		  if(!empty($ticket_count))
		  {
			if($ticket_records[0]['event_ticket_limit']>=$ticket_count)
			{
				$true_record[]=array('ticket_id'=>$ticket_records[0]['event_ticket_id'],'ticket_required'=>$ticket_count);
			}else
			{
				
				$false_record[]=array('ticket_id'=>$ticket_records[0]['event_ticket_id'],'ticket_required'=>$ticket_count);
			}
		  }		
		}
	if(!empty($true_record) && empty($false_record))
	{
		$payment_type 			=   $_REQUEST['payment_type'];  // 1-card,2-bank account
		$savecard_status		= 	$_REQUEST['savecard_status']; // 1- Save , 2 for not save
		$card_pay_type 			= 	$_REQUEST['card_pay_type'];   // 1-card, 2- card_token
		$card_no				=	$_REQUEST['card_no'];
		$expiry_month			=	$_REQUEST['expiry_month'];
		$expiry_year			=	$_REQUEST['expiry_year'];
		$cvv_no					=	$_REQUEST['cvv_no'];

		$recipient_bank			=	$_REQUEST['recipient_bank'];
		$rec_ac_no				=	$_REQUEST['recipient_account_number'];
		$sender_ac_no			=	sender_account_number;
		$sender_bank			=	sender_bank;
		$passcode				=	$_REQUEST['passcode'];
		$rec_ac_no				=	$_REQUEST['recipient_account_number'];
		$card_token				=	$_REQUEST['card_token'];
if($payment_type == '1')
		{
			if($card_pay_type=='1')
			{
				$pay = $this->payment_card($card_no,$expiry_month,$expiry_year,$cvv_no,$user_id,$payment_gateway_price,$savecard_status,$verve_card_status,$verve_card_pin,'1');
			}else 
				if($card_pay_type=='2')
				{
					$records_cards = $this -> conn -> get_table_field_doubles('save_card_details', 'save_card_userid', $user_id, 'save_card_token', $card_token);
					$cardid		=	$records_cards[0]['card_id'];
					$cardtoken	=	$records_cards[0]['save_card_token'];
					$save_card_no	=	$records_cards[0]['save_card_no'];
					$cardfour_digit= substr($save_card_no, -4);
					$pay			=	$this->payment_card_token($cardfour_digit,$cardtoken,$cvv_no,$user_id,$payment_gateway_price,$cardid);
				}
		}
		else 
		if($payment_type == '2')
		{
			$pay = $this->payment_bank($recipient_bank,$rec_ac_no,$sender_ac_no,$sender_bank,$passcode,$user_id,$payment_gateway_price);
		}
		$para					= explode("/", $pay);
		$status					= $para[0];
		
		$payment_transaction_id			= $para[1];
		$trans_ref_no				= $para[2];
		$data_store_id				= $para[3];
		if($status=='error')
		{
			$post = array('status' => "false", "message" => $payment_transaction_id, 'transaction_id' => $payment_transaction_id,'transaction_date' => date('F-d-Y h:i A',strtotime($current_date)),'transaction_ref'=>$trans_ref_no);
			echo $this -> json($post);
			exit();
		}
		$payment_gateway_type =$payment_type;  // 1-card,2-bank account
			
				$records = $this -> conn -> get_table_row_byidvalue('user', 'user_id', $user_id);
					$wallet_amount = $records['0']['wallet_amount'];
					$admin = $this -> conn -> get_all_records('admin');
					$admin_wallet = $admin['0']['admin_wallet'];
					$reffer_status = $records['0']['reffer_amount_status'];
					$reffer_user_id = $records['0']['reffer_user_id'];
					$user_number = $records['0']['user_contact_no'];
					$card_deduct_amount = $wallet_amt;
					$rec_ticket=implode(',', $ticket_rec);
					if($card_deduct_amount<=$wallet_amount){
					$recharge = $this -> conn -> insertnewrecords('wallet_transaction', 'wt_user_id, wt_datetime,wt_category,wt_amount,transaction_id,wt_desc,payment_type,payment_gateway_id,user_wallet_rec_amount,user_card_card_rec_amount,trans_ref_no', '"' . $user_id . '","' . $current_date . '","' . $wt_category . '","' . $ticket_price . '","' . $transaction_id . '","' . $wt_desc . '","' . $payment_gateway_type . '","' . $payment_gateway_id . '","' . $wallet_amt . '","' . $card_rec_amt . '","' . $trans_ref_no . '"');
					
					if ($recharge) {

					$ticket_booking = $this -> conn -> insertnewrecords('booking_event_tickets','booking_event_id,booking_user_id,booking_ticket_id, booking_ticket_price,transaction_id,transaction_date,event_biller_id', '"' . $event_id . '","' . $user_id . '","' . $rec_ticket . '","' . $ticket_price . '","' . $transaction_id . '","' . $current_date . '","' . $biller_id . '"');
					$user_wallet = $wallet_amount - $wallet_amt;
					$data['wallet_amount'] = $user_wallet;
					$update_toekn = $this -> conn -> updatetablebyid('user', 'user_id', $user_id, $data);
							if ($reffer_status == '2') 
						{
							$this->refferal_code($user_id,$reffer_user_id,$user_number,$wallet_amount);	
						}
						$this->ticket_update($ticket_json_record,$event_id);
						$this->booking_ticket($ticket_json_record,$ticket_booking,$current_date,$user_id);
						
						$biller_contact_no = $event_records['0']['biller_contact_no'];
						$this->send_event_msg($user_number,$event_name,$biller_contact_no);
						$this->event_ticket_mail($ticket_booking,$biller_email);


							// Admin wallet update
							$admin_update_wallet = $admin_wallet + $church_product_price;
							$data_admin['admin_wallet'] = $admin_update_wallet;
							$update_toekn = $this -> conn -> updatetablebyid('admin', 'admin_id', 1, $data_admin);

						//	$this->free_offer_mail($donar_user_id);
						//	$this->church_mail($donar_user_id,$church_id,$transaction_id,$church_product_price,$payment_gateway_type,'1');
			//	$this -> church_message($user_number, $church_product_price, $transaction_id,'1');
							$post = array("status" => "true", 'message' => "Event Ticket booking Successfully", "wallet_id" => $recharge, 'event_id' => $event_id, 'booking_amount' => $ticket_price, 'wallet_amount' => $wallet_amount, 'transaction_id' => $payment_gateway_id,'payment_gateway_id'=>$payment_gateway_id,'payment_gateway_type'=>$payment_gateway_type,'transaction_date' => date('F-d-Y h:i A',strtotime($current_date)),'transaction_ref'=>$trans_ref_no);
						} else {
							$post = array('status' => "false", "message" => "Event Ticket Failed", 'transaction_id' => $payment_transaction_id,'transaction_date' => date('F-d-Y h:i A',strtotime($current_date)),'transaction_ref'=>$trans_ref_no);
						}
						
					} else {
						
						$post = array('status' => "false", "message" => "Not sufficent amount in  your wallet", 'wallet_amount' => $wallet_amount, 'booking_amount' => $ticket_price, 'transaction_id' => $payment_transaction_id,'transaction_date' => date('F-d-Y h:i A',strtotime($current_date)),'transaction_ref'=>$trans_ref_no);
						echo $this -> json($post);
						exit();
					}
}else
	{
		$post = array('status' => "false", "message" => "No event avalible of this event id", 'event_id' => $event_id);				
	}

				
			}else{
				$post = array('status' => "false", "message" => "No event avalible of this event id", 'event_id' => $church_id);
			}
	}
	else{
		$post = array('status' => "false", "message" => "Missing parameter", 'event_id' => $_REQUEST['event_id'], 'user_id' => $_REQUEST['user_id'], 'ticket_price' => $_REQUEST['ticket_price'], 'payment_gateway_id' => $_REQUEST['payment_gateway_id'], 'payment_gateway_type' => $_REQUEST['payment_gateway_type'],'payment_gateway_price'=>$_REQUEST['payment_gateway_price']);

		}
		echo $this -> json($post);
	
}


//== function refferal code
function refferal_code($user_id,$reffer_user_id,$user_number,$user_wallet)
{
	$user_records = $this -> conn -> get_table_row_byidvalue('user', 'user_id', $user_id); 
	$user_wallet = $user_records['0']['wallet_amount'];
	$frnd_records = $this -> conn -> get_table_row_byidvalue('user', 'user_id', $reffer_user_id); 
if(!empty($frnd_records)){
								$reffer_records = $this -> conn -> get_all_records('reffer_amount');
								$refferal_amount = $reffer_records[0]['reffer_amount'];
								$reffer_code_database = $frnd_records['0']['user_refferal_code'];
								$wallet = $frnd_records['0']['wallet_amount'];
								$frnd_number = $frnd_records['0']['user_contact_no'];
								$current_date = date("Y-m-d H:i:s");
								$transaction_id = strtotime("now") . mt_rand(10, 99);
								$wt_type = 2;
								// credit in frnd acconnt
								$refferamount = $refferal_amount;
								// reffer amount
								$wt_category = 9;
								// refferal amount recieved in wallet
								$wt_desc = "Refferal amount add in your wallet using by " . $frnd_number;

								$add_reffer_money = $this -> conn -> insertnewrecords('refferal_records', 'refferal_user_id,refferal_frnd_id,refferal_amount,refferal_date', '"' . $user_id . '","' . $reffer_user_id . '","' . $refferamount . '","' . $current_date . '"');

								$add_money = $this -> conn -> insertnewrecords('wallet_transaction', 'wt_user_id, wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc,cashbackrecord_id', '"' . $user_id . '","' . $current_date . '","' . $wt_type . '","' . $refferamount . '","' . $wt_category . '","' . $transaction_id . '","' . $wt_desc . '","' . $frnd_number . '"');

								// modify wallet of frnd using reffer code///
								$data_frnd['wallet_amount'] = $user_wallet + $refferal_amount;
								$data_frnd['reffer_amount_status'] = 1;
								$update_toekn = $this -> conn -> updatetablebyid('user', 'user_id', $user_id, $data_frnd);

								// Cahnge user status when refeer amount add in frnd wallet
								
								// add money from user who used refferal code
$wt_desc = "Refferal amount add in your wallet using by " .$user_number;
$transaction_id = strtotime("now") . mt_rand(10, 99);
						$add_reffer_money = $this -> conn -> insertnewrecords('refferal_records', 'refferal_user_id,refferal_frnd_id,refferal_amount,refferal_date', '"' . $reffer_user_id . '","' . $user_id . '","' . $refferamount . '","' . $current_date . '"');

						$add_money = $this -> conn -> insertnewrecords('wallet_transaction', 'wt_user_id, wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc,cashbackrecord_id', '"' . $reffer_user_id . '","' . $current_date . '","' . $wt_type . '","' . $refferamount . '","' . $wt_category . '","' . $transaction_id . '","' . $wt_desc . '","' . $user_number . '"');


						$data_frnd12['wallet_amount'] = $wallet + $refferal_amount;
						$update_toekn = $this -> conn -> updatetablebyid('user', 'user_id', $reffer_user_id, $data_frnd12);
						}
}
	function ticket_booking_failed()
	{
		$event_id=$_REQUEST['event_id'];
		$tickets_record=json_decode($_REQUEST['tickets_records']); 
		$user_id=$_REQUEST['user_id'];
		$ticket_price=$_REQUEST['ticket_price'];
		$transaction_id = strtotime("now") . mt_rand(10, 99);
		//	$transaction_id=$_REQUEST['trans_id'];
		$payment_gateway_price = $_REQUEST['payment_gateway_price'];
		$wallet_amount=$ticket_price-$refund_amount;
		$wt_desc = $_REQUEST['failed_desc'];
		if(empty($wt_desc))
		{
			$wt_desc="Transaction Cancelled";
		}
		$payment_gateway_type = $_REQUEST['payment_gateway_type'];  // 1-kongopay,2-webpay
		$recharge_status = 3;
		$wt_category = '16';
		$current_date = date("Y-m-d H:i:s");
		$trans_ref_no = $_REQUEST['trans_ref_no'];
		if (!empty($event_id) && !empty($tickets_record) && !empty($user_id) && !empty($ticket_price)) 
		{
		$event_records = $this -> conn -> get_table_row_byidvalue('event_list', 'event_id', $event_id);
		$biller_id = $event_records['0']['event_biller_id'];
		if (!empty($event_records)) 
		{
		
		for($i=0;$i<count($tickets_record);$i++)
		{
			$ticket_id=$tickets_record[$i]->event_ticket_id;
			$ticket_rec[]=$tickets_record[$i]->event_ticket_id;
			$ticket_count=$tickets_record[$i]->event_quantity_ticket;
			$ticket_records = $this -> conn -> join_two_table_where_two_field('event_ticket_record','events_tickets','event_ticket_id','events_tickets_id', 'event_id', $event_id, 'event_ticket_id', $ticket_id);
		  if(!empty($ticket_count))
		  {
			if($ticket_records[0]['event_ticket_limit']>=$ticket_count)
			{
				$true_record[]=array('ticket_id'=>$ticket_records[0]['event_ticket_id'],'ticket_required'=>$ticket_count);
			}else
			{
				
				$false_record[]=array('ticket_id'=>$ticket_records[0]['event_ticket_id'],'ticket_required'=>$ticket_count);
			}
		  }		
		}
	}
	$rec_ticket=implode(',', $ticket_rec);
	$recharge = $this -> conn -> insertnewrecords('wallet_transaction', 'wt_user_id, wt_datetime,wt_amount,wt_category,transaction_id,wt_desc,user_wallet_rec_amount,user_card_card_rec_amount,wt_status,payment_type,trans_ref_no', '"' . $user_id . '","' . $current_date . '","' . $ticket_price . '","' . $wt_category . '","' . $transaction_id . '","' . $wt_desc . '","' . $wallet_amount . '","' . $payment_gateway_price . '","3","' . $payment_gateway_type . '","' . $trans_ref_no . '"');


	$ticket_booking = $this -> conn -> insertnewrecords('booking_event_tickets','booking_event_id,booking_user_id,booking_ticket_id, booking_ticket_price,transaction_id,transaction_date,booking_event_tickets_status,event_biller_id', '"' . $event_id . '","' . $user_id . '","' . $rec_ticket . '","' . $ticket_price . '","' . $transaction_id . '","' . $current_date . '","2","' . $biller_id . '"');
				
				 //$this->recharge_mail($recharge_user_id,$operator_id,$recharge_number,$transaction_id,$recharge_amount,$wt_category,$payment_gateway_type,'2');
				 //$this -> recharge_message($user_number, $recharge_amount, $transaction_id,$recharge_number,'2');
				$post = array('status' => "true", "message" => "Failed transaction", 'wt_category' => $wt_category, 'amount' => $ticket_price, 'user_id' => $user_id,'trans_id'=>$transaction_id,'failed_date'=>$current_date,'failed_desc'=>$wt_desc,'payment_type'=>$payment_gateway_type,'wt_id'=>$recharge);
					}else{
						$post = array('status' => "false", "message" => "Missing parameter", 'user_id' => $user_id, 'event_id' => $event_id, 'tickets_records' => $tickets_record, 'ticket_price' => $ticket_price);
					}
echo $this -> json($post);
}

function event_ticket_mail($booking_ticket_id,$biller_email)
{
	
	
$ticket_records = $this -> conn -> join_three_table('event_list','booking_event_tickets','user','event_id','booking_event_id','user_id','booking_user_id', 'booking_event_tickets_id', $booking_ticket_id);

$booking_event_tickets_id	=	$ticket_records[0]['booking_event_tickets_id'];
$booking_ticket_price		=	$ticket_records[0]['booking_ticket_price'];
$ids						= 	$ticket_records[0]['booking_ticket_id'];
$event_id 					=	$ticket_records[0]['booking_event_id'];
$event_name 				=	$ticket_records[0]['event_name'];
$event_date 				=	$ticket_records[0]['event_date'];
$event_end_date 			= 	$ticket_records[0]['event_end_date'];
$event_date 				=	$ticket_records[0]['event_date'];
$event_starttime			= 	$ticket_records[0]['event_time'];
$event_end_time				=	$ticket_records[0]['event_end_time'];
$event_place 				=	$ticket_records[0]['event_place'];
$event_image 				=	event_image.$ticket_records[0]['event_image'];
$event_contact_no 			=	$ticket_records[0]['event_contact_no'];
$user_name 					=	$ticket_records[0]['user_name'];
$user_email 				=	$ticket_records[0]['user_email'];
$user_contact_no 			=	$ticket_records[0]['user_contact_no'];
$id_ticket 					=	explode(",", $ids);
$sql 						= 	'SELECT * FROM `booking_event_tickets`  inner join  `booking_ticket_status` on `booking_ticket_status`.`booking_id`=`booking_event_tickets`.`booking_event_tickets_id` inner  join `event_ticket_record` on `event_ticket_record`.`event_ticket_id`=`booking_ticket_status`.`booking_ticket_id` inner join `events_tickets`on `events_tickets`.`events_tickets_id`=`booking_ticket_status`.`booking_ticket_id` where  `booking_ticket_status`.`booking_id`="'.$booking_event_tickets_id.'" GROUP BY `booking_ticket_status`.`booking_ticket_id`';
	$response=mysql_query($sql);
	
$message = '<!DOCTYPE html PUBLIC " ">
<html xmlns=" ">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>oya charge </title>
  <style type="text/css">
    @import url(http://fonts.googleapis.com/css?family=Lato:400);

    /* Take care of image borders and formatting */

    img {
      max-width: 600px;
      outline: none;
      text-decoration: none;
      -ms-interpolation-mode: bicubic;
    }

    a {
      text-decoration: none;
      border: 0;
      outline: none;
    }

    a img {
      border: none;
    }

    /* General styling */

    td, h1, h2, h3  {
      font-family: Helvetica, Arial, sans-serif;
      font-weight: 400;
    }

    body {
      -webkit-font-smoothing:antialiased;
      -webkit-text-size-adjust:none;
      width: 100%;
      height: 100%;
      color: #37302d;
      background: #ffffff;
    }

     table {
      border-collapse: collapse !important;
    }


    h1, h2, h3 {
      padding: 0;
      margin: 0;
      color: #ffffff;
      font-weight: 400;
    }

    h3 {
      color: #21c5ba;
      font-size: 24px;
    }

    .important-font {
      color: #21BEB4;
      font-weight: bold;
    }

    .hide {
      display: none !important;
    }

    .force-full-width {
      width: 100% !important;
    }
  </style>

  <style type="text/css" media="screen">
    @media screen {
       /* Thanks Outlook 2013! http://goo.gl/XLxpyl*/
      td, h1, h2, h3 {
        font-family: "Lato", "Helvetica Neue", "Arial", "sans-serif" !important;
      }
    }
  </style>

  <style type="text/css" media="only screen and (max-width: 480px)">
    /* Mobile styles */
    @media only screen and (max-width: 480px) {
      table[class="w320"] {
        width: 320px !important;
      }

      table[class="w300"] {
        width: 300px !important;
      }

      table[class="w290"] {
        width: 290px !important;
      }

      td[class="w320"] {
        width: 320px !important;
      }

      td[class="mobile-center"] {
        text-align: center !important;
      }

      td[class="mobile-padding"] {
        padding-left: 20px !important;
        padding-right: 20px !important;
        padding-bottom: 20px !important;
      }

      td[class="mobile-block"] {
        display: block !important;
        width: 100% !important;
        text-align: left !important;
        padding-bottom: 20px !important;
      }

      td[class="mobile-border"] {
        border: 0 !important;
      }

      td[class*="reveal"] {
        display: block !important;
      }
    }
  </style>
</head>
<body class="body" style="padding:0; margin:0; display:block; background:#ffffff; -webkit-text-size-adjust:none" bgcolor="#ffffff">
<table align="center" cellpadding="0" cellspacing="0" width="40%" height="100%" >
  <tr>
    <td align="center" valign="top" bgcolor="#ffffff"  width="100%">

    <table cellspacing="0" cellpadding="0" width="100%">
      <tr>
        <td style="border-bottom: 3px solid #3bcdc3;" width="100%">
          <center>
            <table cellspacing="0" cellpadding="0" width="500" class="w320">
              <tr>
                <td valign="top" style="padding:10px 0; text-align:left;" class="mobile-center">
                  <img width="200" height="62" src="'.maillogo.'">
                </td>
              </tr>
            </table>
          </center>
        </td>
      </tr>
      <tr>
        <td background="1.jpg" bgcolor="#8b8284" valign="top" style="background: url('.$event_image.') no-repeat center; background-color: #8b8284; background-position: center;>
          <!--[if gte mso 9]>
          <v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="mso-width-percent:1000;height:303px;">
            <v:fill type="tile" src="https://www.filepicker.io/api/file/kmlo6MonRpWsVuuM47EG" color="#8b8284" />
            <v:textbox inset="0,0,0,0">
          <![endif]-->
          <div>
            <center>
              <table cellspacing="0" cellpadding="0" width="530" height="303" class="w320">
                <tr>
                  <td valign="middle" style="vertical-align:middle; padding-right: 15px; padding-left: 15px; text-align:left;" height="303">

                    <table cellspacing="0" cellpadding="0" width="100%">
                      <tr>
                        <td>
                          <h1>THANK YOU FOR YOUR TICKET BOOKING </h1><br>
                          <h2>Please review your email below .</h2>
                          <br>
                        </td>
                      </tr>
                    </table>

                    <table cellspacing="0" cellpadding="0" width="100%">
                    <tr>
                    <td class="hide reveal">
                      &nbsp;
                    </td>
                      <td style="width:150px; height:33px; background-color: #3bcdc3;" >
                        <div>
                          <a href="#" style="background-color:#3bcdc3;border-radius:4px;color:#ffffff;display:inline-block;font-family:sans-serif;font-size:13px;font-weight:bold;line-height:40px;text-align:center;text-decoration:none;width:150px;-webkit-text-size-adjust:none;"></a>
                          </div>
                      </td>
                      <td>
                        &nbsp;
                      </td>
                    </tr>
                  </table>
                  </td>
                </tr>
              </table>
            </center>
          </div>
          <!--[if gte mso 9]>
            </v:textbox>
          </v:rect>
          <![endif]-->
        </td>
      </tr>
      <tr>
        <td valign="top">

          <center>
            <table cellspacing="0" cellpadding="0" width="500" class="w320">
              <tr>
                <td valign="top" style="border-bottom:1px solid #a1a1a1;">


                <table cellspacing="0" cellpadding="0" width="100%">
                  <tr>
                    <td style="padding: 30px 0;" class="mobile-padding">

                    <table class="force-full-width" cellspacing="0" cellpadding="0">
                      <tr>
                        <td style="text-align: left;">
                          <span class="important-font">
                           Dear,'.$user_name.'  <br>
                          </span>
                          '.$user_email.' <br>
                          '.$user_contact_no.' <br>
                          
                        </td>
                        <td style="text-align: right; vertical-align:top;">
                          <span class="important-font">
                           Event Venue<br>
                          </span>
                          '.$event_name.' <br>
                         '.$event_place.' <br>
                          '.$event_date.' '.'-'.' '.$event_end_date.' <br>
                          '.$event_contact_no.'

                        </td>
                      </tr>
                    </table>

                    </td>
                  </tr>
                  <tr>
                    <td style="padding-bottom: 30px;" class="mobile-padding">

                      <table class="force-full-width" cellspacing="0" cellpadding="0">
                        <tr>

                          <td class="mobile-block" width="33%">
                                  <table cellspacing="0" cellpadding="0" class="force-full-width">
                              <tr>
                                <td class="mobile-border" style="background-color: #3bcdc3; color: #ffffff; padding: 5px; border-right: 3px solid #ffffff;">
                                  Ticket Name
                                </td>
                                 <td class="mobile-border" style="background-color: #3bcdc3; color: #ffffff; padding: 5px; border-right: 3px solid #ffffff;">
                                  Ticket ID
                                </td>
                                 <td style="background-color: #3bcdc3; color: #ffffff; padding: 5px;">
                                  Quantity
                                </td>
                                  <td style="background-color: #3bcdc3; color: #ffffff; padding: 5px;">
                                  Amount
                                </td>
                              </tr>';
							while($row=mysql_fetch_array($response)){
							  if($row['booking_ticket_qty']!='0'){
                             $message .= '<tr>
                                <td style="background-color: #ebebeb; padding: 8px; border-top: 3px solid #ffffff;border-right: 3px solid #ffffff;">
                                 '.$row['events_tickets_name'].'
                                </td>
                                 <td style="background-color: #ebebeb; padding: 8px; border-top: 3px solid #ffffff;border-right: 3px solid #ffffff;">
                                 '.$row['events_tickets_no'].'
                                </td>
                                 <td style="background-color: #ebebeb; padding: 8px; border-top: 3px solid #ffffff;">
                               '.$row['booking_ticket_qty'].'
                                </td> 
                                <td style="background-color: #ebebeb; padding: 8px; border-top: 3px solid #ffffff;">
                               '.$row['event_ticket_price'].'
                                </td>
                              </tr>';
                              }}
                            $message .= '</table>
                          </td>

                        </tr>
                      </table>

                    </td>
                  </tr>
                  <tr>
                    <td class="mobile-padding">

                      <table cellspacing="0" cellpadding="0" width="100%">
                        <tr>
                          <td style="text-align: left;">
                            The amount of '.$booking_ticket_price.'  has been charged on the booking event ticket of '.$event_name.'
                            <br>
                            <br>
                          </td>
                        </tr>
                      </table>

                    </td>
                  </tr>
                </table>
                </td>
              </tr>
            </table>
            <table cellspacing="0" cellpadding="0" width="500" class="w320">
              <tr>
                <td>
                  <table cellspacing="0" cellpadding="0" width="100%">
                    <tr>
                      <td class="mobile-padding" style="text-align:left;">
                      <br>
                        Thank you for your Interest. Please <a href="#">contact us</a> with any questions regarding this invoice.
                      <br>
                      <br>
                      Oya Charge 
                      <br>
                      <br>
                      <br>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </center>
        </td>
      </tr>
      <tr>
        <td style="background-color:#c2c2c2;">
          <center>
            <table cellspacing="0" cellpadding="0" width="500" class="w320">
              <tr>
                <td>
                  <table cellspacing="0" cellpadding="30" width="100%">
                    <tr>
                      <td style="text-align:center;">
                        <a href="#">
                          <img width="61" height="51" src="https://www.filepicker.io/api/file/vkoOlof0QX6YCDF9cCFV" alt="twitter" />
                        </a>
                        <a href="#">
                          <img width="61" height="51" src="https://www.filepicker.io/api/file/fZaNDx7cSPaE23OX2LbB" alt="google plus" />
                        </a>
                        <a href="#">
                          <img width="61" height="51" src="https://www.filepicker.io/api/file/b3iHzECrTvCPEAcpRKPp" alt="facebook" />
                        </a>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td>
                  <center>
                    <table style="margin:0 auto;" cellspacing="0" cellpadding="5" width="100%">
                      <tr>
                        <td style="text-align:center; margin:0 auto;" width="100%">
                           <a href="#" style="text-align:center;color: #A1A1A1;">
                              &copy; Oyacharge All right reserved.
                           </a>
                        </td>
                      </tr>
                    </table>
                  </center>
                </td>
              </tr>
            </table>
          </center>
        </td>
      </tr>
    </table>
    </td>
  </tr>
</table>
</body>
</html>';

				$subject  = 'Event Ticket Booking Confirmation of Event - '.$event_name;
				$headers  = "Organization: OyaCharge\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
				$headers .= "X-Priority: 3\r\n";
				$headers .= "X-Mailer: PHP" . phpversion() . "\r\n";
				$header  .= "MIME-Version: 1.0\r\n";
				$header  .= "Content-type: text/html\r\n";
				$res 	  =  file_get_contents(SITE_URL . "createpdf/event_new_pdf/" . $booking_ticket_id."/".$biller_email);
				$mail     =   $this->sendElasticEmail($user_email, $subject, "OyaCharge", $message, "care@oyacharge.com", "OyaCharge",$res);
			if($mail)
			{
				$subject1 = 'Event Ticket Booking Confirmation of '.$user_email;
				$this->sendElasticEmail($biller_email, $subject1, "OyaCharge", $message, "care@oyacharge.com", "OyaCharge",$res);			
			}
			    		$this->load->library('email');
                        $this->email->from('care@oyacharge.com', 'OyaCharge');
                        $this->email->to($user_email); // $cc_admin_email
                        $this->email->subject($subject1);
                        $this->email->message($message);
                        $this->email->attach($res);
                        $this->email->send();
                        $this->email->clear(TRUE);
			
}

function send_event_msg($mobile,$event_name,$biller_no)
{
	$user_name=sms_user_name;
	$password=sms_password;
	
		 $message='Your Event Ticket is booking successfully of this event:-'.$event_name;
		$encodedMessage = urlencode($message);
		$url = "http://www.kudisms.net/components/com_spc/smsapi.php?username=$user_name&password=$password&sender=OyaCharge&recipient=$mobile&message=" .$encodedMessage;
		$ch = curl_init();
		curl_setopt_array($ch, array(CURLOPT_URL => $url, CURLOPT_RETURNTRANSFER => true, CURLOPT_POST => true,
		CURLOPT_FOLLOWLOCATION => true));
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$output = curl_exec($ch);
		curl_close($ch);
		
		$message='Event Ticket is booking successfully of this event:-'.$event_name.'from '.$mobile;
		$encodedMessage = urlencode($message);
		$url = "http://www.kudisms.net/components/com_spc/smsapi.php?username=$user_name&password=$password&sender=OyaCharge&recipient=$mobile&message=" .$encodedMessage;
		$ch = curl_init();
		curl_setopt_array($ch, array(CURLOPT_URL => $url, CURLOPT_RETURNTRANSFER => true, CURLOPT_POST => true,
		CURLOPT_FOLLOWLOCATION => true));
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$output = curl_exec($ch);
		curl_close($ch);
}
function regenerate_event_ticket()
{
	$event_id		=	$_REQUEST['event_id'];
	$user_id		=	$_REQUEST['user_id'];
	$booking_id		= 	$_REQUEST['booking_event_tickets_id'];
	$tickets = $this -> conn -> get_table_row_byidvalue('booking_event_tickets', 'booking_event_tickets_id', $booking_id); 
	$event_records = $this -> conn -> join_two_table('event_list','biller_details','event_biller_id','biller_id', 'event_id', $event_id);
	$biller_email = $event_records['0']['biller_email'];
			if(!empty($tickets))
			{
				 $this->event_ticket_mail($booking_id,$biller_email);
				$post = array('status' => "true", "message" => "Ticket regenrate successfully");
			}else{
				$post = array('status' => "false", "message" => "No ticket found");
			}
	echo $this -> json($post);
}

function payment_card($card_no,$expiry_month,$expiry_year,$cvv_no,$user_id,$amount,$save_card_status,$verve_card_status,$verve_card_pin,$userType)
{

	//echo 'here'; exit;


	// echo '</br> card_no' . $card_no;
	// echo '</br> expiry_month' . $expiry_month;
	// echo '</br> expiry_year' . $expiry_year;
	// echo '</br> cvv_no' . $cvv_no;
	// echo '</br> user_id' . $user_id;
	// echo '</br> amount' . $amount;
	// echo '</br> save_card_status' . $save_card_status;
	// echo '</br> verve_card_status' . $verve_card_status;
	// echo '</br> verve_card_pin' . $verve_card_pin;
	// echo '</br> userType' . $userType;

	// exit;


	$verve_card_status='2';
	// $token			=	$_REQUEST['token'];
//	$apikey			=	$_REQUEST['api_key'];
	if(!empty($card_no) && !empty($expiry_month) && !empty($expiry_year) && !empty($cvv_no)&& !empty($user_id)&& !empty($amount))
	{
		if($userType=='1')   // 1 for registered user
		{

			//echo 'here'; exit;
			$user_records 		=   $this -> conn -> get_table_row_byidvalue('user', 'user_id', $user_id); 
		$user_email 			=	$user_records['0']['user_email'];
		$user_contact_no    	=  "+".$user_records['0']['user_contact_no'];
		 $user_name 			= 	$user_records['0']['user_name'];
		} else if($userType=='2') // 2 for guest user
		{
			$user_records 		=   $this -> conn -> get_table_row_byidvalue('guest_user', 'guest_user_id', $user_id);
			$user_email 			=	$user_records['0']['guest_user_email'];
			$user_contact_no    	=  "+".$user_records['0']['guest_user_mobile'];
		 	$user_name 			= 	$user_records['0']['guest_user_email'];
		}
		
		if(empty($user_name))
		{
			$user_name			=	$user_contact_no;
			$last_name			=	$user_name;
		}else{
			$last_name			=	$user_name;
		}
		
		  $token=$this->create_token_moneywave(); 
		if(!empty($token))
		{
			
			$recipient_bank		=	recipient_bank;
			$recipient_ac_no 	=	recipient_account_number;
			$apikey				=	api_key_moneywave;
			$redirecturl 		=	redirecturl;
			$recipient 			=	'wallet';
			$charge_auth  		=	'PIN';
			if($verve_card_status=='1')   // use verve card
			{
						$requestData		=	"{\n             \"firstname\": \"$user_name\",\n             \"lastname\": \"$last_name\",\n             \"phonenumber\": \"$user_contact_no\",\n             \"email\": \"$user_email\",\n             \"recipient_bank\": \"$recipient_bank\",\n             \"recipient_account_number\": \"$recipient_ac_no\",\n             \"card_no\": \"$card_no\",\n             \"cvv\": \"$cvv_no\",\n             \"expiry_year\": \"$expiry_year\",\n             \"expiry_month\": \"$expiry_month\",\n             \"apiKey\": \"$apikey\",\n             \"amount\": \"$amount\",\n             \"fee\": \"0\",\n             \"redirecturl\": \"$redirecturl\",\n             \"medium\": \"mobile\",\n \"pin\": \"$verve_card_pin\",\n \"charge_auth\": \"$charge_auth\",\n \"recipient\": \"$recipient\"\n}";

			}else if($verve_card_status=='2')    // normal card
			{
				$requestData		="{\n             \"firstname\": \"$user_name\",\n             \"lastname\": \"$last_name\",\n             \"phonenumber\": \"$user_contact_no\",\n             \"email\": \"$user_email\",\n             \"recipient_bank\": \"$recipient_bank\",\n             \"recipient_account_number\": \"$recipient_ac_no\",\n             \"card_no\": \"$card_no\",\n             \"cvv\": \"$cvv_no\",\n             \"expiry_year\": \"$expiry_year\",\n             \"expiry_month\": \"$expiry_month\",\n             \"apiKey\": \"$apikey\",\n             \"amount\": \"$amount\",\n             \"fee\": \"0\",\n             \"redirecturl\": \"$redirecturl\",\n             \"medium\": \"mobile\"\n}";
			}

	$curl = curl_init();

  curl_setopt_array($curl, array(
  CURLOPT_URL => "https://moneywave.herokuapp.com/v1/transfer",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 300,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS =>$requestData ,
  CURLOPT_HTTPHEADER => array(
    "authorization: $token",
    "cache-control: no-cache",
    "content-type: application/json",
    "postman-token: 377fcb8b-86fe-ad23-1c2d-98f89250e875"
  ),
));
 $response = curl_exec($curl); 

  $data		= json_decode($response);


  //print_r($data); exit;


    $store_data		= json_encode($response);
   $msg		=	$data->message;	
$err = curl_error($curl);

curl_close($curl);

if ($err) {
 // echo "cURL Error #:" . $err;
} else {
  $data= json_decode($response);

   $status	=	$data->status;
  if($status == 'success')
  {
  	
  	 $record 		=  $data->data->transfer;
	// $trans_id		=	$record->id;
	 $trans_status	=	$record->status;
	 $trans_id		= 	$record->flutterChargeReference;
	 $ref_id		= 	$record->ref;
	 $trans_amount	= 	$record->amountToSend;
	 $cardid		= 	$record->cardId;
	 $response_msg =	$record->flutterChargeResponseMessage;
	 $payment_type	=	'1';  // 1 for card 
	 $current_date	=	date("Y-m-d H:i:s");
	 $data1212		=	json_encode($record);
	 $sql="insert into payment_transaction (pay_trans_userid,p_transaction_id,p_reffernce_id,pay_trans_amount,trans_pay_type,p_response_msg,pay_trans_data,pay_trans_status,p_trans_datetime) values ('$user_id','$trans_id','$ref_id','$trans_amount','$payment_type','$response_msg',$store_data,'$status','$current_date')";
	 $im= mysql_query($sql);
	 $last_id=mysql_insert_id();
	// $insert = $this -> conn -> insertnewrecords('payment_transaction','pay_trans_userid,p_transaction_id,p_reffernce_id, pay_trans_amount,trans_pay_type,p_response_msg,pay_trans_data,pay_trans_status,p_trans_datetime', '"' . $user_id . '","' . $trans_id . '","' . $ref_id . '","' . $trans_amount . '","' . $payment_type . '","' . $respoonse_msg . '", "'".$data1212."'" ,"'.$status.'","' . $current_date . '"');
	if($save_card_status=='1')
			{
				
				// $token=$this->create_token_moneywave();
				 $save_card=$this->save_card_details($card_no,$expiry_month,$expiry_year,$cvv_no,$token,$user_id,$cardid);
				
			}
		return $status."/".$trans_id."/".$ref_id."/".$last_id;
	  
  }else{
  	
  	return  $data->status."/".$msg;
  }
}
		}
	}
	
}

function payment_card_token($cardlast_four,$cardtoken,$cvv_no,$user_id,$amount,$cardid)
{
	if(!empty($cardlast_four) && !empty($cardtoken) && !empty($cvv_no) && !empty($user_id)&& !empty($amount))
	{
	
		$user_records 		=   $this -> conn -> get_table_row_byidvalue('user', 'user_id', $user_id); 
		$user_email 		=	$user_records['0']['user_email'];
		$user_contact_no    =  "+".$user_records['0']['user_contact_no'];
		 $user_name 			= 	$user_records['0']['user_name'];
		if(empty($user_name))
		{
			$user_name			=	$user_contact_no;
			$last_name			=	$user_name;
		}else{
			$last_name			=	$user_name;
		}
		
		  $token=$this->create_token_moneywave();
		if(!empty($token))
		{
			
			$recipient_bank		=	recipient_bank;
			$recipient_ac_no 	=	recipient_account_number;
			$apikey				=	api_key_moneywave;
			$redirecturl 		=	redirecturl;
			
			$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://moneywave.herokuapp.com/v1/transfer",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 300,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
   CURLOPT_POSTFIELDS => "{\n\n              \"firstname\": \"$user_name\",\n              \"lastname\": \"$last_name\",\n              \"phonenumber\": \"$user_contact_no\",\n              \"email\": \"$user_email\",\n              \"recipient_bank\": \"$recipient_bank\",\n              \"recipient_account_number\": \"$recipient_ac_no\",\n              \"apiKey\": \"$apikey\",\n              \"amount\": \"$amount\",\n              \"fee\": \"0\",\n              \"redirecturl\": \"$redirecturl\",\n              \"medium\": \"mobile\",\n              \"charge_with\":\"tokenized_card\",\n              \"card_last4\":\"$cardlast_four\",\n              \"card_token\":\"$cardtoken\",\n              \"cvv\":\"$cvv_no\",\n              \"card_id\":\"$cardid\"\n}",
  CURLOPT_HTTPHEADER => array(
    "authorization: $token",
    "cache-control: no-cache",
    "content-type: application/json",
    "postman-token: ccae9287-1851-c11e-3594-b2b9703b8c85"
  ),
));
 $response = curl_exec($curl);
  $data		= json_decode($response);
    $store_data		= json_encode($response);
   $msg		=	$data->message;	
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  $data= json_decode($response);
   $status	=	$data->status;
  if($status == 'success')
  {
  	
  	 $record 		=  $data->data->transfer;
	 //$trans_id		=	$record->id;
	 $trans_status	=	$record->status;
	 $trans_id		= 	$record->flutterChargeReference;
	 $ref_id		= 	$record->ref;
	 $trans_amount	= 	$record->amountToSend;
	 $cardid		= 	$record->cardId;
	 $response_msg =	$record->flutterChargeResponseMessage;
	 $payment_type	=	'1';  // 1 for card 
	 $current_date	=	date("Y-m-d H:i:s");
	 $data1212		=	json_encode($record);
	 $sql="insert into payment_transaction (pay_trans_userid,p_transaction_id,p_reffernce_id,pay_trans_amount,trans_pay_type,p_response_msg,pay_trans_data,pay_trans_status,p_trans_datetime) values ('$user_id','$trans_id','$ref_id','$trans_amount','$payment_type','$response_msg',$store_data,'$status','$current_date')";
	 $im= mysql_query($sql);
	 $last_id=mysql_insert_id();
	// $insert = $this -> conn -> insertnewrecords('payment_transaction','pay_trans_userid,p_transaction_id,p_reffernce_id, pay_trans_amount,trans_pay_type,p_response_msg,pay_trans_data,pay_trans_status,p_trans_datetime', '"' . $user_id . '","' . $trans_id . '","' . $ref_id . '","' . $trans_amount . '","' . $payment_type . '","' . $respoonse_msg . '", "'".$data1212."'" ,"'.$status.'","' . $current_date . '"');
	
		return $status."/".$trans_id."/".$ref_id."/".$last_id;
	  
  }else{
  	
  	return  $data->status."/".$msg;
  }
}
		}
	}
	
}

function payment_bank($recipient_bank,$rec_ac_no,$sender_ac_no,$sender_bank,$passcode,$user_id,$user_amount)
{
	
 if(!empty($recipient_bank) && !empty($rec_ac_no) && !empty($sender_ac_no) && !empty($sender_bank) && !empty($passcode)&& !empty($user_id)&& !empty($user_amount))
	{
		$user_records 		=   $this -> conn -> get_table_row_byidvalue('user', 'user_id', $user_id); 
		 $user_email 		=	$user_records['0']['user_email'];
		$user_contact_no    =  "+".$user_records['0']['user_contact_no'];
		$user_name 			= 	$user_records['0']['user_name'];
		if(empty($user_name))
		{
			$user_name			=	$user_contact_no;
			$last_name			=	$user_name;
		}else{
			$last_name			=	$user_name;
		}
		if(empty($user_email))
		{
			$user_email='email@gmail.com';
		}
		 $token=$this->create_token_moneywave();
		if(!empty($token))
		{
			$apikey				=	api_key_moneywave;
			$redirecturl 		=	redirecturl;	
		$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://moneywave.herokuapp.com/v1/transfer",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 300,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\n\n              \"firstname\": \"$user_name\",\n              \"lastname\": \"$last_name\",\n              \"phonenumber\": \"$user_contact_no\",\n              \"email\": \"$user_email\",\n              \"recipient_bank\": \"$recipient_bank\",\n              \"recipient_account_number\": \"$rec_ac_no\",\n              \"sender_account_number\": \"$sender_ac_no\",\n              \"sender_bank\": \"$sender_bank\",\n              \"passcode\":\"$passcode\",\n              \"apiKey\": \"$apikey\",\n              \"amount\": \"$user_amount\",\n              \"fee\": \"0\",\n              \"redirecturl\": \"$redirecturl\",\n              \"medium\": \"mobile\",\n              \"charge_with\":\"account\"\n}",
  CURLOPT_HTTPHEADER => array(
    "authorization: $token",
    "cache-control: no-cache",
    "content-type: application/json",
    "postman-token: b2091de1-8da9-1cd6-0eed-3fc548c11a79"
  ),
));

 $response = curl_exec($curl);

  $data		= json_decode($response);
  $store_data		= json_encode($response);
   $msg		=	$data->message;	
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {

   $status	=	$data->status;
 
  if($status == 'success')
  {
  	
  	 $record 		=  $data->data->transfer;
	// $trans_id		=	$record->id;
	 $trans_status	=	$record->status;
	 $trans_id		= 	$record->flutterChargeReference;
	 $ref_id		= 	$record->ref;
	 $trans_amount	= 	$record->amountToSend;
	 $response_msg =	$record->flutterChargeResponseMessage;
	 $payment_type	=	'1';  // 1 for card 
	 $current_date	=	date("Y-m-d H:i:s");
	 $data1212		=	json_encode($record);
	 $sql="insert into payment_transaction (pay_trans_userid,p_transaction_id,p_reffernce_id,pay_trans_amount,trans_pay_type,p_response_msg,pay_trans_data,pay_trans_status,p_trans_datetime) values ('$user_id','$trans_id','$ref_id','$trans_amount','$payment_type','$response_msg',$store_data,'$status','$current_date')";
	 $im= mysql_query($sql);
	  $last_id=mysql_insert_id();
	
	
	 	return $status."/".$trans_id."/".$ref_id."/".$last_id;
	
  }else{
  	
  	return  $data->status."/".$msg;
  }
}
		}
	}else{
			$post = array('status' => "false", "message" => "Error in create token");
			echo $this -> json($post);
			exit();
	}
}

function create_token_moneywave()
{
	
 	$apikey		=	api_key_moneywave;
 	$secret_key =	secret_key_moneywave;
	$curl = curl_init();

	curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://moneywave.herokuapp.com/v1/merchant/verify",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 300,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => "  {\n              \"apiKey\": \"$apikey\",\n              \"secret\": \"$secret_key\"\n }",
		  CURLOPT_HTTPHEADER => array(
		    "cache-control: no-cache",
		    "content-type: application/json",
		    "postman-token: bab5f90a-f1a9-5121-24aa-535e907a875b"
		  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  $result=  json_decode($response);
  $status=$result->status;
  if($status=='success')
  {
  	$token=$result->token;
	return $token;
  }
}
}

// function saved card
function save_cards()
{
	$user_id		=	$_REQUEST['user_id'];
	$card_no		=	$_REQUEST['card_no'];
	$expiry_month	=	$_REQUEST['expiry_month'];
	$expiry_year	=	$_REQUEST['expiry_year'];
	$cvv_no			=	$_REQUEST['cvv_no'];
	 $token=$this->create_token_moneywave();
	if(!empty($token)){
		$result=$this->save_card_details($card_no,$expiry_month,$expiry_year,$cvv_no,$token,$user_id);
		return $result;
	}else{
		$result="Error in creating token";
		return $result;
	}
	
}


function save_card_details($card_no,$expiry_month,$expiry_year,$cvv_no,$token,$user_id,$cardid)
{

	$curl = curl_init();

   curl_setopt_array($curl, array(
  CURLOPT_URL => save_card_url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\t\n\t\"card_no\":\"$card_no\",\n\"expiry_year\": \"$expiry_year\",\n\"expiry_month\": \"$expiry_month\",\n\"cvv\": \"$cvv_no\"\n\n\n\n\n}",
  CURLOPT_HTTPHEADER => array(
    "authorization: $token",
    "cache-control: no-cache",
    "content-type: application/json",
    "postman-token: d9cdc9bf-25fd-b837-3c15-c1b483dfd91c"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
	//echo $response;
  $data=json_decode($response);
  if($data->status=='success')
  {
  	$card_records = $this -> conn -> get_table_field_doubles('save_card_details', 'save_card_userid',$user_id, 'save_card_no', $card_no);
  	$cardtoken=$data->data->cardToken;
	
	if(empty($card_records))
	{
 $cardfour_lastdigit= substr($card_no, -4);
 $cardfour_startdigit= substr($card_no,0, 4);
 $storecard=$cardfour_startdigit."XXXXXXXX".$cardfour_lastdigit;
 $save_card_db = $this -> conn -> insertnewrecords('save_card_details','save_card_userid,save_card_no,save_card_last4, save_card_token,card_id,card_expiry_month,card_expiry_year', '"' . $user_id . '","' . $card_no . '","' . $storecard . '","' . $cardtoken . '","' . $cardid . '","' . $expiry_month . '","' . $expiry_year . '"');
	}else{
		$update_sql="update save_card_details set save_card_token='".$cardtoken."' where save_card_userid ='".$user_id."' and save_card_no='".$card_no."'" ;
		$mysql=mysql_query($update_sql);
	}
	$post=array('status'=>'true','message'=>$data->message);
	return $cardtoken;
  }else{
  	$post=array('status'=>'false','message'=>$data->message);
  }
 echo $this -> json($post);
}
}
// function add card
function add_card()
{
	if(!empty($_REQUEST['user_id']) && !empty($_REQUEST['card_no']) && !empty($_REQUEST['expiry_month']) && !empty($_REQUEST
	['expiry_year']) && !empty($_REQUEST['cvv_no']))
	{
		$user_id		=	$_REQUEST['user_id'];
		$card_no		=	$_REQUEST['card_no'];
		$expiry_month	=	$_REQUEST['expiry_month'];
		$expiry_year	=	$_REQUEST['expiry_year'];
		$cvv_no			=	$_REQUEST['cvv_no'];
		$token			=	$this->create_token_moneywave();
		$save			=	$this->save_card_details($card_no,$expiry_month,$expiry_year,$cvv_no,$token,$user_id);
		if(!empty($save))
		{
		$post = array('status' => "true", "message" => "Card saved successfully");
		echo $this -> json($post);
		}else{
			$post = array('status' => "false", "message" => "Error in save card");
			echo $this -> json($post);
		}
	}else{
		$post = array('status' => "false", "message" => "missing parameter",'user_id'=>$_REQUEST['user_id'],'card_no'=>$_REQUEST['card_no'],'expiry_month'=>$_REQUEST['expiry_month'],'expiry_year'=>$_REQUEST['expiry_year'],'cvv_no'=>$_REQUEST['cvv_no']);
		echo $this -> json($post);
	}
	
}
function get_savecard()
{
	if(!empty($_REQUEST['user_id']))
	{
		$user_id=$_REQUEST['user_id'];
		$card_records = $this -> conn -> get_table_row_byidvalue('save_card_details', 'save_card_userid', $user_id);
		if(!empty($card_records))
		{
			foreach($card_records as $value)
			{
				$save_card_id		=	$value['save_card_id'];
				$save_card_no		=	$value['save_card_no'];
				 $cardsix_startdigit=substr($save_card_no,0, 6);
								$curl = curl_init();
								curl_setopt_array($curl, array(
							  CURLOPT_URL => "https://bins.payout.com/api/v1/bins/".$cardsix_startdigit,
							  CURLOPT_RETURNTRANSFER => true,
							  CURLOPT_ENCODING => "",
							  CURLOPT_MAXREDIRS => 10,
							  CURLOPT_TIMEOUT => 300,
							  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
							  CURLOPT_CUSTOMREQUEST => "GET",
							  CURLOPT_HTTPHEADER => array(
							    "cache-control: no-cache",
							    "postman-token: f706e9f3-3c5f-2b2f-78ce-4865daa25186"
							  ),
							));
							
					$response = curl_exec($curl);
					$err = curl_error($curl);
							
							curl_close($curl);
							
					if ($err) {
							  //echo "cURL Error #:" . $err;
							} else {
							  $data= json_decode($response);
							  $cardname=$data->brand;
							  $cardbank=$data->issuer;
							  $cardtype=$data->type;
							}
				$card_no			=	$value['save_card_last4'];
				$card_expiry_month	=	$value['card_expiry_month'];
				$card_expiry_year	=	$value['card_expiry_year'];
				$save_card_token	=	$value['save_card_token'];
				$card_name			=	$cardname;
				$card_bank			=	$cardbank;
				$card_type			=	$cardtype;
				$arr[]				=	array('save_card_id'=>$save_card_id,'card_no'=>$card_no,'card_expiry_month'=>$card_expiry_month,'card_expiry_year'=>$card_expiry_year,'card_token'=>$save_card_token,'card_name'=>$card_name,'card_bank'=>$card_bank,'card_type'=>$card_type,'saved_card_no'=>$save_card_no);
			}
		$post = array('status' => "true", "message" => "card_list",'card_list'=>$arr);
		}else{
			$post = array('status' => "false", "message" => "No Card Found");
		}
	}else{
		
	$post = array('status' => "false", "message" => "Missing parameter",'user_id'=>$user_id);
	}
	echo $this -> json($post);
}

// function delete card
function delete_savecard()
{
	if(!empty($_REQUEST['save_card_id']) && !empty($_REQUEST['user_id']))
	{
		$savecardid	=	$_REQUEST['save_card_id'];
		$user_id	=	$_REQUEST['user_id'];
		$card_records = $this -> conn -> get_table_field_doubles('save_card_details', 'save_card_userid', $user_id, 'save_card_id', $savecardid);
		if(!empty($card_records))
		{
					$delete = $this -> conn -> deletedataintablebytwocol('save_card_details', 'save_card_userid', $user_id, 'save_card_id', $savecardid);
			if (!empty($delete)) 
			{
					$post = array('status' => "true", "message" => "Successfully delete", 'user_id' => $user_id, 'save_card_userid' => $savecardid);
				} else {
					$post = array('status' => "false", "message" => "error in deleting contact", 'user_id' => $user_id, 'save_card_userid' => $savecardid);
				}
		}
		
	}else{
		$post = array('status' => "false", "message" => "Missing parameter",'user_id'=>$user_id,'save_card_id'=>$_REQUEST['save_card_id']);
	}
	echo $this -> json($post);
}
// check balence in moneywave wallet
function check_moneywave_balence($token)
{
  $curl = curl_init();
  curl_setopt_array($curl, array(
  CURLOPT_URL => wallet_balence_url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "authorization: $token",
    "cache-control: no-cache",
    "content-type: application/x-www-form-urlencoded",
    "postman-token: 62344c33-83a5-713e-1d24-8414e4eb54f4"
  ),
));
  $response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
 $data=json_decode($response);
 print_R($data);

}
}


// wallet to Bank transfer amount
function wallet_to_bank()
{
	if(!empty($_REQUEST['user_id']) && !empty($_REQUEST['transfer_amount']) && !empty($_REQUEST['bankcode'])&& !empty($_REQUEST['account_number'])&& !empty($_REQUEST['account_holder_name'])){
	$user_id 		=	$_REQUEST['user_id'];
	$sql='select * from user where user_id="'.$user_id.'"';
	$user_records 	= $this -> conn -> getData($sql);
	if(empty($user_records)){
		$post=array('status'=>'false','message'=>'Invalid User ID','user_id'=>$user_id);
		echo $this -> json($post); 
		exit();
	}
	$user_email 		=	$user_records['0']['user_email'];
	$user_contact_no    =  "+".$user_records['0']['user_contact_no'];
	$wallet_amount 		=	$user_records['0']['wallet_amount'];
	
	$user_name			=	$_REQUEST['account_holder_name'];
	
	$date = new DateTime();
    $lock_pass 	=	wallet_pass;
	$amount 	=	$_REQUEST['transfer_amount'];
	$trans_chage=   transfer_charge;
	$total_deduct_amt= $amount+$trans_chage;
	$bank_code 	=	$_REQUEST['bankcode'];
	$ac_number 	=	$_REQUEST['account_number'];
	$currency 	=	currency;
	$narration  =	'Wallet To Bank Transfer in '.$user_name.' with account number is '.$ac_number;
	$ref_number =	$date->getTimestamp().rand(111111,999999);
	$current_date 		=	date("Y-m-d H:i:s");
	$payment_type 		=	3;
	$wt_category 		=	17;  // wallet to Bank
     if($wallet_amount>$total_deduct_amt)
     {
     	$token=$this->create_token_moneywave();
	  if(!empty($token))
	  {
	  		//$balence=$this->check_moneywave_balence($token);  // check balence in wallet
	  		$postField="lock=$lock_pass&amount=$amount&bankcode=$bank_code&accountNumber=$ac_number&currency=$currency&senderName=$user_name&narration=$narration&ref=$ref_number";
	  		 	$curl = curl_init();
  				curl_setopt_array($curl, array(
				  CURLOPT_URL => wallet_bank_url,
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 300,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "POST",
				  CURLOPT_POSTFIELDS => $postField,
				  CURLOPT_HTTPHEADER => array(
			    "authorization:$token",
			    "cache-control: no-cache",
			    "content-type: application/x-www-form-urlencoded",
			    "postman-token: 35210e9c-caa9-1b21-c19e-b23db51aca52"
			  ),
			));

				 $response = curl_exec($curl);
			
				 $err = curl_error($curl);
				 curl_close($curl);
				 $data=json_decode($response);
				  $error_message=$data->message;
				  $status=$data->status;
				if ($err) {
					
				 $sql11 				=	"insert into payment_transaction (pay_trans_userid,p_transaction_id,p_reffernce_id,pay_trans_amount,trans_pay_type,p_response_msg,pay_trans_data,pay_trans_status,p_trans_datetime) values ('$user_id','$ref_number','$ref_number','$total_deduct_amt','$payment_type','$err','$response','$status','$current_date')";
	 					 $im= mysql_query($sql11);
	 					$last_id=mysql_insert_id();
	 					$transfer = $this -> conn -> insertnewrecords('wallet_transaction', 'wt_user_id, wt_datetime,wt_category,wt_amount,transaction_id,wt_desc,payment_type,payment_gateway_id,trans_ref_no,wt_status', '"' . $user_id . '","' . $current_date . '","' . $wt_category . '","' . $total_deduct_amt . '","' . $ref_number . '","' . $narration . '","' . $payment_type . '","' . $ref_number . '","' . $ref_number . '","2"');

	 					$walletbank = $this -> conn -> insertnewrecords('wallet_bank_transactions', 'wallet_bank_trans_user_id, wallet_bank_trans_amount,wallet_bank_trans_bankcode,wallet_bank_trans_account_no,wallet_bank_trans_date,wallet_bank_transactions,wallet_bank_trans_status,wallet_bank_trans_id,wallet_bank_trans_ref,wallet_bank_trans_msg', "'" . $user_id . "','" . $total_deduct_amt . "','". $bank_code . "','" . $ac_number . "','" . $current_date . "','".$response."','" . $status . "','" . $ref_number . "','" . $ref_number . "','" . $error_message . "'");
	 						
							$post=array('status'=>'false','message'=>$data->message, 'transaction_id' => $ref_number,'transaction_date' => date('F-d-Y h:i A',strtotime($current_date)),'transaction_ref'=>$ref_number);
	 					
				} else {
				

				  if($data->status=='success')
				  {
				  		$status 			=	$data->status;
				  		$response_code 		=	$data->data['responsecode'];
				  		$uniquereference 	=	$data->data['uniquereference'];
				  		$internalreference 	=	$data->data['internalreference'];
				  		$oya_refference 	=	$data->data['ref'];
				  		$respoonse_msg 		=	$data->data['responsemessage'];
				  		

				  		
				  		$sql11 				=	"insert into payment_transaction (pay_trans_userid,p_transaction_id,p_reffernce_id,pay_trans_amount,trans_pay_type,p_response_msg,pay_trans_data,pay_trans_status,p_trans_datetime) values ('$user_id','$uniquereference','$internalreference','$total_deduct_amt','$payment_type','$respoonse_msg','$response','$status','$current_date')";
	 					 $im= mysql_query($sql11);
	 					$last_id=mysql_insert_id();
	 					$transfer = $this -> conn -> insertnewrecords('wallet_transaction', 'wt_user_id, wt_datetime,wt_category,wt_amount,transaction_id,wt_desc,payment_type,payment_gateway_id,trans_ref_nowt_status', '"' . $user_id . '","' . $current_date . '","' . $wt_category . '","' . $total_deduct_amt . '","' . $oya_refference . '","' . $narration . '","' . $payment_type . '","' . $uniquereference . '","' . $internalreference . '","1"');

	 					$walletbank = $this -> conn -> insertnewrecords('wallet_bank_transactions', 'wallet_bank_trans_user_id, wallet_bank_trans_amount,wallet_bank_trans_bankcode,wallet_bank_trans_account_no,wallet_bank_trans_date,wallet_bank_transactions,wallet_bank_trans_status,wallet_bank_trans_id,wallet_bank_trans_ref,wallet_bank_trans_msg', "'" . $user_id . "','" . $total_deduct_amt . "','". $bank_code . "','" . $ac_number . "','" . $current_date . "','".$response."','" . $status . "','" . $uniquereference . "','" . $oya_refference . "','" . $respoonse_msg . "'");
	 					if($transfer>0)
	 					{
	 						$deduct_amount=$wallet_amount-$total_deduct_amt;
	 						$data11111['wallet_amount'] = $deduct_amount;
							$update_amount = $this -> conn -> updatetablebyid('user', 'user_id', $user_id, $data11111);
							$post=array('status'=>'true','message'=>'Wallet to Bank Transfer amount is successfully done', 'transaction_id' => $oya_refference,'transaction_date' => date('F-d-Y h:i A',strtotime($current_date)),'transaction_ref'=>$internalreference);

	 					}
				  }else if($data->status=='error'){
				  		
				  		 $sql11 				=	"insert into payment_transaction (pay_trans_userid,p_transaction_id,p_reffernce_id,pay_trans_amount,trans_pay_type,p_response_msg,pay_trans_data,pay_trans_status,p_trans_datetime) values ('$user_id','$ref_number','$ref_number','$total_deduct_amt','$payment_type','$error_message','$response','$status','$current_date')";
	 					 $im= mysql_query($sql11);
	 					$last_id=mysql_insert_id();
	 					$transfer = $this -> conn -> insertnewrecords('wallet_transaction', 'wt_user_id, wt_datetime,wt_category,wt_amount,transaction_id,wt_desc,payment_type,payment_gateway_id,trans_ref_no,wt_status', '"' . $user_id . '","' . $current_date . '","' . $wt_category . '","' . $total_deduct_amt . '","' . $ref_number . '","' . $narration . '","' . $payment_type . '","' . $ref_number . '","' . $ref_number . '","2"');

					$walletbank = $this -> conn -> insertnewrecords('wallet_bank_transactions', 'wallet_bank_trans_user_id, wallet_bank_trans_amount,wallet_bank_trans_bankcode,wallet_bank_trans_account_no,wallet_bank_trans_date,wallet_bank_transactions,wallet_bank_trans_status,wallet_bank_trans_id,wallet_bank_trans_ref,wallet_bank_trans_msg', "'" . $user_id . "','" . $total_deduct_amt . "','". $bank_code . "','" . $ac_number . "','" . $current_date . "','".$response."','" . $status . "','" . $ref_number . "','" . $ref_number . "','" . $error_message . "'");

				  		$post=array('status'=>'false','message'=>$data->message, 'transaction_id' => $ref_number,'transaction_date' => date('F-d-Y h:i A',strtotime($current_date)),'transaction_ref'=>$ref_number);
				  }
			}
				

	  }else{
	  	$post=array('status'=>'false','message'=>'Invalid token or errro in token create');
	  }
	}else{
		$post=array('status'=>'false','message'=>'Insufficent amount in your wallet');
	}
	 
 }else{
 	$post=array('status'=>'false','message'=>'Missing Parameter','user_id'=>$_REQUEST['user_id'],'transfer_amount'=>$_REQUEST['transfer_amount'],'bankcode'=>$_REQUEST['bankcode'],'account_number'=>$_REQUEST['account_number'],'account_holder_name'=>$_REQUEST['account_holder_name']);
 }
 echo $this -> json($post); 
}
// function validate account number
function validate_bank_account_number()
{
	if(!empty($_REQUEST['account_number']) && !empty($_REQUEST['bank_code']))
	{
			$ac_number = $_REQUEST['account_number'];
			$bank_code = $_REQUEST['bank_code'];
			 $token=$this->create_token_moneywave();
			if(!empty($token))
			{
				$postField="account_number=$ac_number&bank_code=$bank_code";
				$url=validate_account_number;
				$response=$this->calling_curl_method($url,$token,$postField);
				$data=json_decode($response);
				$status=$data->status;
				if($status=='success')
				{
					$name=$data->data->account_name;
					$post=array('status'=>'true','message'=>'Account Holder Name get successfully','name'=>$name);
				}else{
					$post=array('status'=>'false','message'=>'Invalid Account Number or Bank');
				}
				
				
				
			}else{
				$post=array('status'=>'false','message'=>'Invalid token or errro in token create');
			}
	}else{
		$post=array('status'=>'false','message'=>'Missing Parameter','account_number'=>$_REQUEST['account_number'],'bank_code'=>$_REQUEST['bank_code']);
	}
	echo $this -> json($post); 
}

// calling curl method
function calling_curl_method($url,$token,$postField)
{
				$curl = curl_init();

				curl_setopt_array($curl, array(
				  CURLOPT_URL =>$url,
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 30,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "POST",
				  CURLOPT_POSTFIELDS => $postField,
				  CURLOPT_HTTPHEADER => array(
				    "authorization:$token",
				    "cache-control: no-cache",
				    "content-type: application/x-www-form-urlencoded",
				    "postman-token: e48aede1-7c65-f7ca-efa5-571270a5735a"
				  ),
			));

			$response = curl_exec($curl);
			$err = curl_error($curl);

			curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  return $response;
		}
}
// function get bank details
function bank_details()
{
	$token=$this->create_token_moneywave();
	
	
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://moneywave.herokuapp.com/banks",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_HTTPHEADER => array(
    "authorization: $token",
    "cache-control: no-cache",
    "content-type: application/json",
    "postman-token: 0c589dac-cb4d-9476-46a2-ce748146e8e0"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  $data		= json_decode($response);
 
  $status	=$data->status;
  $message	=$data->message;
  $post=array('status'=>$status,'message'=>$message,'banks'=>$data->data);
  echo $this -> json($post);
}
}
function validate_card_number()
{
	if(!empty($_REQUEST['card_number']))
	{
		$card_number=$_REQUEST['card_number'];
		$card_number = preg_replace("/[^a-zA-Z0-9]+/", "", $card_number);
		$cards = array(
        "visa" => "/^([4]{1})([0-9]{12,15})$/",
        "amex" => "(3[47]\d{13})",
        "jcb" => "(35[2-8][89]\d\d\d{10})",
        "maestro" => "((?:5020|5038|6304|6579|6761)\d{12}(?:\d\d)?)",
        "solo" => "((?:6334|6767)\d{12}(?:\d\d)?\d?)",
        "mastercard" => "(5[1-5]\d{14})",
        "switch" => "(?:(?:(?:4903|4905|4911|4936|6333|6759)\d{12})|(?:(?:564182|633110)\d{10})(\d\d)?\d?)",
      "verve" => "(506[0-9]{13}(?:[0-9]{3})?)",    
    );
	
    $names = array("Visa", "American Express", "JCB", "Maestro", "Solo", "Mastercard", "Switch");

    $matches = array();
    $pattern = "#^(?:".implode("|", $cards).")$#";
		
    $result = preg_match($pattern, str_replace(" ", "", $card_number), $matches);
	
	 if( $result > 0){
      //  $result = ($this->validatecard($card_number))?1:0;
		// $res=($result>0)?$names[sizeof($matches)-2]:false;
		  $cardnumber=preg_replace("/\D|\s/", "", $cardnumber);  # strip any non-digits
    	  $cardlength=strlen($cardnumber);
		 $post=array('status'=>'true','card_name'=>$res);
    }else{
    	$post=array('status'=>'false');
    }
   
	 echo $this -> json($post);
	}
	
}
function validatecard($cardnumber) {
    $cardnumber=preg_replace("/\D|\s/", "", $cardnumber);  # strip any non-digits
    $cardlength=strlen($cardnumber);
    $parity=$cardlength % 2;
    $sum=0;
    for ($i=0; $i<$cardlength; $i++) {
      $digit=$cardnumber[$i];
      if ($i%2==$parity) $digit=$digit*2;
      if ($digit>9) $digit=$digit-9;
      $sum=$sum+$digit;
    }
    $valid=($sum%10==0);
    return $valid;
}

// api for guest User
	function guest_login()
	{
		if(!empty($_REQUEST['guest_user_mobile']) && !empty($_REQUEST['guest_user_email']))
		{
				$current_date		=	date("Y-m-d H:i:s");
				$guest_user_email	=	$_REQUEST['guest_user_email'];
				$guest_user_mobile	=	$_REQUEST['guest_user_mobile'];
				$guest_ip 			=	 $_SERVER['REMOTE_ADDR'];
				 $sql="insert into guest_user (guest_user_email,guest_user_mobile,guest_user_created,guest_user_ip) values ('$guest_user_email','$guest_user_mobile','$current_date','$guest_ip')";
	 			$im= mysql_query($sql);
	  			$last_id=mysql_insert_id();
	  			if($last_id)
	  			{
	  				$post=array('status'=>'true','message'=>'Signup Successfully','guest_user_id'=>$last_id,'guest_user_email'=>$guest_user_email,'guest_user_mobile'=>$guest_user_mobile);
	  			}
		}else{
			$post=array('status'=>'false','message'=>'missing parameter','guest_user_mobile'=>$_REQUEST['guest_user_mobile'],'guest_user_email'=>$_REQUEST['guest_user_email']);
		}
		echo $this -> json($post);
	}
	// Recharge from card///
	function guest_recharge_from_card() {
		$payment_type 		=   $_REQUEST['payment_type'];  // 1-card,2-bank account 
		$savecard_status	= 	2; // 1- Save , 2 for not save
		$card_pay_type 		= 	$_REQUEST['card_pay_type'];   // 1-card, 2- card_token
		$recharge_user_id 	= 	$_REQUEST['recharge_user_id'];
		// verve card parameters
		$verve_card_status 	= 	2;
		//$verve_card_status 	= 	$_REQUEST['verve_card_status'];
		$verve_card_pin 	= 	$_REQUEST['verve_card_pin'];

		
		$recharge_code		=	$_REQUEST['recharge_code'];  // for tv rechragre
		$customer_name		=	$_REQUEST['customer_name'];
		//$recharge_transaction_id=$_POST['recharge_transaction_id'];
		$recharge_category_id = $_REQUEST['recharge_category_id'];
		//1- Mobile,2-DTH
		$operator_id 		= $_REQUEST['operator_id'];
		$rec_number 		= $_REQUEST['recharge_number'];
		$recharge_number 	=  $_REQUEST['recharge_number'];
		$mobile_number 		= $_REQUEST['recharge_number'];
		$refund_amount 		= $_REQUEST['payment_gateway_amt'];
		$recharge_amount 	= $_REQUEST['recharge_amount'];
		//$trans_ref_no 		= $_REQUEST['trans_ref_no'];
		$wallet_type 		= 2;
		// 1- Credit, 2-Debit
		$recharge_status = 1;
		//$wt_category = '2';
		$wt_category = $_REQUEST['wt_category'];
		//  1-Add money,2-Recharge
		$wallet_category = '4';
		// 4- Cashback
		$current_date = date("Y-m-d H:i:s");
		if ($wt_category == '1') {
			$wt_desc = 'Add-Money';
		} else if ($wt_category == '2') {
			if($recharge_category_id=='1')
			{
				$wt_desc = 'Mobile Recharge';
			}else if($recharge_category_id=='2')
			{
				$wt_desc = 'DTH Recharge';
			}else if($recharge_category_id=='3')
			{
				$wt_desc = 'DataCard Recharge';
			}
			
		} else if ($wt_category == '3') {
			$wt_desc = 'Refund';
		}else if ($wt_category == '12') {
			$wt_desc = 'Electricity Bill';
		}
		if ($wallet_category == '4') {
			$w_desc = 'Cashback';
		}
		$card_no		=	$_REQUEST['card_no'];
		$expiry_month	=	$_REQUEST['expiry_month'];
		$expiry_year	=	$_REQUEST['expiry_year'];
		$cvv_no			=	$_REQUEST['cvv_no'];

		$recipient_bank	=	$_REQUEST['recipient_bank'];
		$rec_ac_no		=	$_REQUEST['recipient_account_number'];
		$sender_ac_no	=	sender_account_number;
		$sender_bank	=	sender_bank;
		$passcode		=	$_REQUEST['passcode'];
		$card_token		=	$_REQUEST['card_token'];
		
		if($payment_type == '1')
		{
			 $transaction_via="Credit/Debit Card";
			if($card_pay_type=='1')
			{
				 $pay = $this->payment_card($card_no,$expiry_month,$expiry_year,$cvv_no,$recharge_user_id,$recharge_amount,$savecard_status,$verve_card_status,$verve_card_pin,'2');
			
			}else 
				if($card_pay_type=='2')
				{
					$records_cards = $this -> conn -> get_table_field_doubles('save_card_details', 'save_card_userid', $recharge_user_id, 'save_card_token', $card_token);
					
					$cardid		=	$records_cards[0]['card_id'];
					$cardtoken	=	$records_cards[0]['save_card_token'];
					$save_card_no	=	$records_cards[0]['save_card_no'];
					$cardfour_digit= substr($save_card_no, -4);
					$pay			=	$this->payment_card_token($cardfour_digit,$cardtoken,$cvv_no,$recharge_user_id,$recharge_amount,$cardid);
					
				}
		}
		else 
		if($payment_type == '2')
		{
				$transaction_via="Bank Account";
			$pay = $this->payment_bank($recipient_bank,$rec_ac_no,$sender_ac_no,$sender_bank,$passcode,$recharge_user_id,$recharge_amount);
		}

//	$pay	=	$this->payment_card($card_no,$expiry_month,$expiry_year,$cvv_no,$recharge_user_id,$refund_amount);
		$para						= explode("/", $pay);
		$status						= $para[0];
		
	 	$payment_transaction_id		= $para[1];
	 	$trans_ref_no				= $para[2];
		$data_store_id				= $para[3];
		if($status=='error')
		{
			$post = array('status' => "false", "message" => $payment_transaction_id,'transaction_date' => date('F-d-Y h:i A',strtotime($current_date)),'transaction_via'=>$transaction_via);
			echo $this -> json($post);
			exit();
		}
		$payment_gateway_type =$payment_type;  // 1-card,2-bank account
		if (!empty($recharge_user_id) && !empty($operator_id) && !empty($recharge_number) && !empty($recharge_amount)) {
			$records = $this -> conn -> get_table_row_byidvalue('guest_user', 'user_id', $recharge_user_id);
			
			$recharge_response 	= '';
			//	if($operator_id=='3'){
		//	$recharge_status = $this -> mobile_recharge_api($operator_id, $mobile_number, $recharge_amount);
		$recharge_status = $this -> mobile_recharge_api($operator_id, $recharge_number, $recharge_amount,$recharge_code,$customer_name);
		$biller_records = $this -> conn -> get_table_row_byidvalue('operator_list', 'operator_id', $operator_id);

		$operator_name 			= 	$biller_records['0']['operator_name'];
		$operator_code 			= 	$biller_records['0']['operator_code'];
		if ($operator_code == 'MTN') {
				if ($recharge_status == '100') {
					$recharge_response = '1';

				} else {
					$recharge_response = '2';
				}
			} else {
				$iparr = split("\,", $recharge_status);
				$recharge_response 	= $iparr[0];
				$transaction_id 	= $iparr[1];
				$electricity_token 	= $iparr[2];
			}
			if (!empty($transaction_id)) {
				$transaction_id 	= $transaction_id;
			} else {
				$transaction_id 	= strtotime("now") . mt_rand(10, 99);
			}
			//}
			if ($recharge_response == '1') {
				if(!empty($electricity_token))
				{
					$electricity_token=$electricity_token;
					
				}else{
					$electricity_token="";
				}
				$recharge = $this -> conn -> insertnewrecords('wallet_transaction', 'wt_user_id, wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc,payment_gateway_id,electrice_token_no,payment_type,trans_ref_no,transaction_data_id,transaction_user_type', '"' . $recharge_user_id . '","' . $current_date . '","' . $wallet_type . '","' . $recharge_amount . '","' . $wt_category . '","' . $transaction_id . '","' . $wt_desc . '","' . $payment_transaction_id . '","' . $electricity_token . '","' . $payment_gateway_type . '","' . $trans_ref_no . '","'.$data_store_id.'","2"');

				if ($recharge) {

					$walletrecharge = $this -> conn -> insertnewrecords('recharge', 'recharge_transaction_id,recharge_user_id,rechage_category,operator_id,rechage_type,recharge_number,recharge_amount,recharge_date,recharge_status,payment_gateway_id,electrice_token_no', '"' . $transaction_id . '","' . $recharge_user_id . '","' . $recharge_category_id . '","' . $operator_id . '","' . $recharge_type_id . '","' . $recharge_number . '","' . $recharge_amount . '","' . $current_date . '","' . $recharge_status . '","' . $payment_transaction_id . '","' . $electricity_token . '"');

					$data_admin['guest_user_transaction_id'] = $transaction_id;
					$data_admin['payment_type'] = $payment_type;
					$data_admin['guest_user_transaction_type'] = $wt_category;
					$data_admin['guest_user_trans_amount'] = $recharge_amount;
					$data_admin['guest_user_trans_ref'] = $trans_ref_no;
					$data_admin['guest_user_trans_datetime'] = $current_date;
					$data_admin['guest_user_trans_status'] = 1;
					$data_admin['guest_user_trans_comments'] = $data_store_id;
					$data_admin['guest_user_trans_desc'] = $wt_desc;
					$update_toekn = $this -> conn -> updatetablebyid('guest_user', 'guest_user_id', $recharge_user_id, $data_admin);

					
					
					if($recharge_category_id=='1'){
						$recharge_type= "Mobile";
					}else if($recharge_category_id=='2')
					{
						$recharge_type= "TV";
					}else if($recharge_category_id=='3')
					{
						$recharge_type= "Data";
					}
					$this->recharge_mail($recharge_user_id,$operator_id,$recharge_number,$transaction_id,$recharge_amount,$recharge_type,$payment_gateway_type,'1');
					$this -> recharge_message($user_number, $recharge_amount, $transaction_id,$recharge_number,'1');
					$post1 = array('status' => 'true', 'message' => "Recharge Successfully","recharge_id" =>$recharge, 'recharge_number' => $rec_number, 'recharge_amount' => $recharge_amount, 'wallet_amount' => $wallet_amount,'transaction_id' => $payment_transaction_id,'electricity_prepaid_token'=>$electricity_token,'transaction_date' => date('F-d-Y h:i A',strtotime($current_date)),'transaction_ref'=>$trans_ref_no,'transaction_via'=>$transaction_via);
//$post=array('status'=>'true');
				
					echo $this -> json($post1);
					exit(0);
					$this->free_offer_mail($recharge_user_id);
				} else {
					$post = array('status' => "false", "message" => "Recharge failed");
				}

			} else {
				$transaction_id = strtotime("now") . mt_rand(10, 99);
				$trans_id = $transaction_id;
				$recharge = $this -> conn -> insertnewrecords('wallet_transaction', 'wt_user_id, wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc,wt_status,payment_gateway_id,trans_ref_no', '"' . $recharge_user_id . '","' . $current_date . '","' . $wallet_type . '","' . $recharge_amount . '","' . $wt_category . '","' . $payment_transaction_id . '","' . $wt_desc . '","3","' . $payment_transaction_id . '","' . $trans_ref_no . '"');

				$walletrecharge = $this -> conn -> insertnewrecords('recharge', 'recharge_transaction_id,recharge_user_id, rechage_category,operator_id,rechage_type,recharge_number,recharge_amount,recharge_date,recharge_status,payment_gateway_id', '"' . $payment_transaction_id . '","' . $recharge_user_id . '","' . $recharge_category_id . '","' . $operator_id . '","' . $recharge_type_id . '","' . $recharge_number . '","' . $recharge_amount . '","' . $current_date . '","3","' . $payment_transaction_id . '"');

				// REfund money when paymemt deduct from paymnet gateway but recharge failed
				$data12['wallet_amount'] = $wallet_amount + $refund_amount;
				$update_wallet = $this -> conn -> updatetablebyid('user', 'user_id', $recharge_user_id, $data12);

			//$transaction_id = strtotime("now") . mt_rand(10, 99);
				$refund_desc = "amount is refund for failed transaction of recharge";
				$refund_record = $this -> conn -> insertnewrecords('wallet_transaction', 'wt_user_id, wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc,wt_status', '"' . $recharge_user_id . '","' . $current_date . '","' . $wallet_type . '","' . $refund_amount . '","3","' . $payment_transaction_id . '","' . $refund_desc . '","1"');

				$data_refund['refund_status'] = 1;
				$data_refund['cashbackrecord_id'] = $transaction_id;
				$update_wallet = $this -> conn -> updatetablebyid('wallet_transaction', 'transaction_id', $payment_transaction_id, $data_refund);

$this->recharge_mail($recharge_user_id,$operator_id,$recharge_number,$payment_transaction_id,$recharge_amount,$recharge_type,$payment_gateway_type,'2');
					$this -> recharge_message($user_number, $recharge_amount, $payment_transaction_id,$recharge_number,'2');
				$post = array('status' => "false", "message" => "Recharge failed", "recharge_id" => $recharge, 'recharge_number' => $rec_number, 'recharge_amount' => $recharge_amount, 'wallet_amount' => $wallet_amount, 'transaction_id' => $payment_transaction_id, 'transaction_date' => date('F-d-Y h:i A',strtotime($current_date)),'transaction_ref'=>$trans_ref_no,'transaction_via'=>$transaction_via);
			}

		}else 
		{
$post = array('status' => "false", "message" => "Missing parameter", 'recharge_user_id' => $recharge_user_id, 'recharge_category_id' => $recharge_category_id, 'operator_id' => $operator_id, 'recharge_number' => $recharge_number, 'recharge_amount' => $recharge_amount);
		}
	echo $this -> json($post);
	}
	// function guest church donation 
function guest_donate_church_with_card()
{
	if(!empty($_REQUEST['church_id'])&&($_REQUEST['donar_user_id'])&&($_REQUEST['church_category_id'])&&($_REQUEST['church_product_id'])&&($_REQUEST['church_product_price']) &&($_REQUEST['church_area_id']))
	{
		$wt_category			=	$_REQUEST['wt_category'];
		$church_id				=	$_REQUEST['church_id'];
		$church_area_id			=	$_REQUEST['church_area_id'];
		$donar_user_id			=	$_REQUEST['donar_user_id'];
		$church_category_id		=	$_REQUEST['church_category_id'];
		$church_product_id		=	$_REQUEST['church_product_id'];
		$church_product_price	=	$_REQUEST['church_product_price'];
		$current_date 			= 	date("Y-m-d H:i:s");
		$payment_type 			=   $_REQUEST['payment_type'];  // 1-card,2-bank account
		$savecard_status		= 	$_REQUEST['savecard_status']; // 1- Save , 2 for not save
		$card_pay_type 			= 	$_REQUEST['card_pay_type'];   // 1-card, 2- card_token
		$card_no				=	$_REQUEST['card_no'];
		$expiry_month			=	$_REQUEST['expiry_month'];
		$expiry_year			=	$_REQUEST['expiry_year'];
		$cvv_no					=	$_REQUEST['cvv_no'];
		$recipient_bank			=	$_REQUEST['recipient_bank'];
		$auth_key				=	$_REQUEST['auth_key'];
		$rec_ac_no				=	$_REQUEST['recipient_account_number'];
		$sender_ac_no			=	sender_account_number;
		$sender_bank			=	sender_bank;
		$passcode				=	$_REQUEST['passcode'];
		$rec_ac_no				=	$_REQUEST['recipient_account_number'];
		$card_token				=	$_REQUEST['card_token'];
		$wt_desc 				=	"Donation to church";
		$string 				= 	$_SERVER['REMOTE_ADDR'].$card_no;
		
		$auth 					= md5($string);
		// if($auth_key!=$auth)
		// {
		// 		$post = array('status' => "false", "message" => 'Authorization Failed, Please Try again','transaction_date' => date('F-d-Y h:i A',strtotime($current_date)));
		// 	echo $this -> json($post);
		// 	exit();
		// }
		if($payment_type == '1')
		{
			$transaction_via="Credit/Debit Card";
			if($card_pay_type=='1')
			{
				$pay = $this->payment_card($card_no,$expiry_month,$expiry_year,$cvv_no,$donar_user_id,$church_product_price,$savecard_status,$verve_card_status,$verve_card_pin,'2');
			}else 
				if($card_pay_type=='2')
				{
					$records_cards 	= $this -> conn -> get_table_field_doubles('save_card_details', 'save_card_userid', $donar_user_id, 'save_card_token', $card_token);
					$cardid		 	=	$records_cards[0]['card_id'];
					$cardtoken	 	=	$records_cards[0]['save_card_token'];
					$save_card_no	=	$records_cards[0]['save_card_no'];
					$cardfour_digit	= substr($save_card_no, -4);
					$pay			=	$this->payment_card_token($cardfour_digit,$cardtoken,$cvv_no,$donar_user_id,$church_product_price,$cardid);
				}
		}
		else 
		if($payment_type == '2')
		{
			$transaction_via="Bank Account";
			$pay = $this->payment_bank($recipient_bank,$rec_ac_no,$sender_ac_no,$sender_bank,$passcode,$donar_user_id,$church_product_price);
		}
		$para						= explode("/", $pay);
		$status						= $para[0];
		
		$payment_transaction_id		= $para[1];
		$trans_ref_no				= $para[2];
		$data_store_id				= $para[3];
		if($status=='error')
		{
				$transaction_id = strtotime("now") . mt_rand(10, 99);
				$recharge 		= $this -> conn -> insertnewrecords('wallet_transaction', 'wt_user_id, wt_datetime,wt_category,wt_amount,transaction_id,wt_desc,trans_ref_no,payment_gateway_id,payment_type,transaction_user_type,wt_status', '"' . $donar_user_id . '","' . $current_date . '","' . $wt_category . '","' . $church_product_price . '","' . $transaction_id . '","' . $wt_desc . '","' . $trans_ref_no . '","' . $transaction_id . '","' . $payment_type . '","2","2"');

				$church_donate = $this -> conn -> insertnewrecords('church_donate', 'donate_church_id,church_biller_id,donate_user_id, church_p_id,transaction_id,church_product_price,donate_datetime,payment_status,church_area_id,payment_gateway_id,payment_status', '"' . $church_id . '","' . $church_biller_id . '","' . $donar_user_id . '","' . $church_product_id . '","' . $payment_transaction_id . '","' . $church_product_price . '","' . $current_date . '","1","' . $church_area_id . '","'.$payment_transaction_id.'","2"');

							$data_admin['guest_user_transaction_id'] 	= $transaction_id;
							$data_admin['payment_type'] 			 	= $payment_type;
							$data_admin['guest_user_transaction_type'] 	= $wt_category;
							$data_admin['guest_user_trans_amount'] 	  	= $church_product_price;
							$data_admin['guest_user_trans_datetime']  	= $current_date;
							$data_admin['guest_user_trans_status']    	= 2;
							$data_admin['guest_user_trans_comments']  	= $payment_transaction_id;
							$data_admin['guest_user_trans_desc'] 	  	= $payment_transaction_id;
							$update_toekn = $this -> conn -> updatetablebyid('guest_user', 'guest_user_id', $donar_user_id, $data_admin);
					
						$this->free_offer_mail($donar_user_id);
						$this->church_mail($donar_user_id,$church_id,$transaction_id,$church_product_price,$payment_gateway_type,'2');
						$this -> church_message($user_number, $church_product_price, $transaction_id,'2');

			$post = array('status' => "false", "message" => $payment_transaction_id, 'transaction_id' => $payment_transaction_id,'transaction_date' => date('F-d-Y h:i A',strtotime($current_date)),'transaction_ref'=>$trans_ref_no);
			echo $this -> json($post);
			exit();
		}
		$payment_gateway_type 		=	$payment_type;  // 1-card,2-bank account
		
		$bill_records = $this -> conn -> get_table_row_byidvalue('church_list', 'church_id', $church_id);
			if (!empty($bill_records)) {
				$church_biller_id = $bill_records['0']['church_biller_id'];
				
				if (!empty($payment_transaction_id)) {
						//$transaction_id='5454';
						$recharge 	= $this -> conn -> insertnewrecords('wallet_transaction', 'wt_user_id, wt_datetime,wt_category,wt_amount,transaction_id,wt_desc,trans_ref_no,payment_gateway_id,payment_type,transaction_user_type', '"' . $donar_user_id . '","' . $current_date . '","' . $wt_category . '","' . $church_product_price . '","' . $payment_transaction_id . '","' . $wt_desc . '","' . $trans_ref_no . '","' . $payment_transaction_id . '","' . $payment_type . '","2"');

						if ($recharge) {

						$church_donate = $this -> conn -> insertnewrecords('church_donate', 'donate_church_id,church_biller_id,donate_user_id, church_p_id,transaction_id,church_product_price,donate_datetime,payment_status,church_area_id,payment_gateway_id', '"' . $church_id . '","' . $church_biller_id . '","' . $donar_user_id . '","' . $church_product_id . '","' . $payment_transaction_id . '","' . $church_product_price . '","' . $current_date . '","1","' . $church_area_id . '","' . $payment_transaction_id . '"');

							$data_admin['guest_user_transaction_id'] = $payment_transaction_id;
							$data_admin['payment_type'] 			 = $payment_type;
							$data_admin['guest_user_transaction_type'] = $wt_category;
							$data_admin['guest_user_trans_amount'] 	  = $church_product_price;
							$data_admin['guest_user_trans_ref']       = $trans_ref_no;
							$data_admin['guest_user_trans_datetime']  = $current_date;
							$data_admin['guest_user_trans_status']    = 1;
							$data_admin['guest_user_trans_comments']  = $data_store_id;
							$data_admin['guest_user_trans_desc'] 	  = $wt_desc;
							$update_toekn = $this -> conn -> updatetablebyid('guest_user', 'guest_user_id', $donar_user_id, $data_admin);
					
						$this->free_offer_mail($donar_user_id);
						$this->church_mail($donar_user_id,$church_id,$transaction_id,$church_product_price,$payment_gateway_type,'1');
						$this -> church_message($user_number, $church_product_price, $transaction_id,'1');
						
						
						
						$post = array("status" => "true", 'message' => "Donation Successfully", "donation_pay_id" => $recharge, 'church_id' => $church_id, 'donation_amount' => $church_product_price, 'wallet_amount' => $wallet_amount, 'transaction_id' => $payment_transaction_id,'transaction_date' => date('F-d-Y h:i A',strtotime($current_date)),'transaction_ref'=>$trans_ref_no);
						} else {
						$post = array('status' => "false", "message" => "Donation pay failed", 'transaction_id' => $payment_transaction_id,'transaction_date' => date('F-d-Y h:i A',strtotime($current_date)),'transaction_ref'=>$trans_ref_no);
						}
					} else {
						
						$post = array('status' => "false", "message" => "Transaction Failed", 'transaction_id' => $payment_transaction_id,'transaction_date' => date('F-d-Y h:i A',strtotime($current_date)),'transaction_ref'=>$trans_ref_no);
						echo $this -> json($post);
						exit();
						//$add=$this->add_money_recharge($recharge_user_id,$recharge_amount,$recharge_transaction_id);
						//$this->recharge();
					}

				
			}else{
				$post = array('status' => "false", "message" => "No church avalible of this church id", 'church_id' => $church_id);
			}
	}
	else{
	$post = array('status' => "false", "message" => "Missing parameter", 'church_id' => $_REQUEST['church_id'], 'donar_user_id' => $_REQUEST['donar_user_id'], 'church_product_price' => $_REQUEST['church_product_price'], 'church_product_id' => $_REQUEST['church_product_id'], 'church_product_id' => $_REQUEST['church_area_id']);
		}
		echo $this -> json($post);
	
}
//Guest Bill pay from card
	function guest_bill_pay_from_card() {
		
		$recharge_user_id = $_REQUEST['recharge_user_id'];
		$wt_category = $_REQUEST['wt_category'];
		// wt_category = 11 pay bill
		$bill_category_id = $_REQUEST['bill_category_id'];
		// 1- Water, 2- Movies etc
		$biller_id = $_REQUEST['biller_id'];
		$bill_consumer_no = $_REQUEST['bill_consumer_no'];
		//$res = file_get_contents(SITE_URL . "createpdf/pdf/" . $bill_consumer_no."/".$biller_id);
		//print_r($res);die;
		$bill_amount = $_REQUEST['bill_amount'];
		

		$wallet_type = 2;
		// 1- Credit, 2-Debit
		$bill_pay_status = 1;
		$wallet_category = '4';
		// 4- Cashback
		$current_date = date("Y-m-d H:i:s");
		$wt_desc = 'PaY Bill';
		if (!empty($bill_consumer_no) && !empty($biller_id) && !empty($bill_amount) && !empty($recharge_user_id)) {
			$bill_records = $this -> conn -> get_table_field_doubles('biller_user', 'bill_invoice_no', $bill_consumer_no, 'biller_id', $biller_id);
		if (!empty($bill_records)) {
		$payment_type 		=   $_REQUEST['payment_type'];  // 1-card,2-bank account
		$savecard_status	= 	$_REQUEST['savecard_status']; // 1- Save , 2 for not save
		$card_pay_type 		= 	$_REQUEST['card_pay_type'];   // 1-card, 2- card_token
		$card_no			=	$_REQUEST['card_no'];
		$expiry_month		=	$_REQUEST['expiry_month'];
		$expiry_year		=	$_REQUEST['expiry_year'];
		$cvv_no				=	$_REQUEST['cvv_no'];

		$recipient_bank		=	$_REQUEST['recipient_bank'];
		$rec_ac_no			=	$_REQUEST['recipient_account_number'];
		$sender_ac_no		=	sender_account_number;
		$sender_bank		=	sender_bank;
		$passcode			=	$_REQUEST['passcode'];
		$rec_ac_no			=	$_REQUEST['recipient_account_number'];
		$card_token			=	$_REQUEST['card_token'];
		if($payment_type == '1')
		{
			if($card_pay_type=='1')
			{
				$pay = $this->payment_card($card_no,$expiry_month,$expiry_year,$cvv_no,$recharge_user_id,$bill_amount,$savecard_status,$verve_card_status,$verve_card_pin,'2');
			}else 
				if($card_pay_type=='2')
				{
					$records_cards = $this -> conn -> get_table_field_doubles('save_card_details', 'save_card_userid', $recharge_user_id, 'save_card_token', $card_token);
					$cardid			=	$records_cards[0]['card_id'];
					$cardtoken		=	$records_cards[0]['save_card_token'];
					$save_card_no	=	$records_cards[0]['save_card_no'];
					$cardfour_digit = substr($save_card_no, -4);
					$pay			=	$this->payment_card_token($cardfour_digit,$cardtoken,$cvv_no,$recharge_user_id,$bill_amount,$cardid);
				}
		}
		else 
		if($payment_type == '2')
		{
			$pay = $this->payment_bank($recipient_bank,$rec_ac_no,$sender_ac_no,$sender_bank,$passcode,$recharge_user_id,$bill_amount);
		}
		$para							= explode("/", $pay);
		$status							= $para[0];
		
		$payment_transaction_id			= $para[1];
		$trans_ref_no					= $para[2];
		$data_store_id					= $para[3];
		if($status=='error')
		{
					$transaction_id = strtotime("now") . mt_rand(10, 99);
					$recharge = $this -> conn -> insertnewrecords('wallet_transaction', 'wt_user_id, wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc,trans_ref_no,payment_gateway_id,payment_type,transaction_user_type,wt_status', '"' . $recharge_user_id . '","' . $current_date . '","' . $wallet_type . '","' . $bill_amount . '","' . $wt_category . '","' . $payment_transaction_id . '","' . $wt_desc . '","' . $trans_ref_no . '","' . $payment_transaction_id . '","' . $payment_gateway_type . '","2","2"');
					$walletrecharge = $this -> conn -> insertnewrecords('bill_recharge', 'bill_user_id,bill_transaction_id,bill_category_id, biller_id,bill_consumer_no,bill_amount,bill_pay_date,bill_pay_status,bill_invoice_no', '"' . $recharge_user_id . '","' . $payment_transaction_id . '","' . $bill_category_id . '","' . $biller_id . '","' . $bill_consumer_no . '","' . $bill_amount . '","' . $current_date . '","2","' . $bill_consumer_no . '"');

						$data_frnd['bill_paid_date'] = $current_date;
							$data_frnd['bill_pay_status'] = 1;
							$update_toekn = $this -> conn -> updatetablebyid('biller_user', 'biller_user_id', $bill_user_id, $data_frnd);
							$data_admin['guest_user_transaction_id']   = $transaction_id;
							$data_admin['payment_type'] 			   = $payment_type;
							$data_admin['guest_user_transaction_type'] = $wt_category;
							$data_admin['guest_user_trans_amount'] 	   = $bill_amount;
							$data_admin['guest_user_trans_ref']        = $trans_ref_no;
							$data_admin['guest_user_trans_datetime']   = $current_date;
							$data_admin['guest_user_trans_status']     = 2;
							$data_admin['guest_user_trans_comments']   = $payment_transaction_id;
							$data_admin['guest_user_trans_desc'] 	   = $payment_transaction_id;
							$update_toekn = $this -> conn -> updatetablebyid('guest_user', 'guest_user_id', $bill_user_id, $data_admin);
			$post = array('status' => "false", "message" => $payment_transaction_id,'transaction_date'=>date('F-d-Y h:i A',strtotime($current_date)),'transaction_id'=>$payment_transaction_id,'transaction_ref_no'=>$trans_ref_no);
			echo $this -> json($post);
			exit();
		}
				$payment_gateway_type =	$payment_type;  // 1-card,2-bank account
				$bill_user_id 		  = $bill_records['0']['biller_user_id'];
				$bill_pay_status 	  = $bill_records['0']['bill_pay_status'];
				if ($bill_pay_status == '2') {
					
					$transaction_id = strtotime("now") . mt_rand(10, 99);
					$recharge = $this -> conn -> insertnewrecords('wallet_transaction', 'wt_user_id, wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc,trans_ref_no,payment_gateway_id,payment_type,transaction_user_type', '"' . $recharge_user_id . '","' . $current_date . '","' . $wallet_type . '","' . $bill_amount . '","' . $wt_category . '","' . $payment_transaction_id . '","' . $wt_desc . '","' . $trans_ref_no . '","' . $payment_transaction_id . '","' . $payment_gateway_type . '","2"');

					if ($recharge) {
						$walletrecharge = $this -> conn -> insertnewrecords('bill_recharge', 'bill_user_id,bill_transaction_id,bill_category_id, biller_id,bill_consumer_no,bill_amount,bill_pay_date,bill_pay_status,bill_invoice_no', '"' . $recharge_user_id . '","' . $payment_transaction_id . '","' . $bill_category_id . '","' . $biller_id . '","' . $bill_consumer_no . '","' . $bill_amount . '","' . $current_date . '","' . $bill_pay_status . '","' . $bill_consumer_no . '"');

						if (!empty($walletrecharge)) {

							$data_frnd['bill_paid_date'] = $current_date;
							$data_frnd['bill_pay_status'] = 1;
							$update_toekn = $this -> conn -> updatetablebyid('biller_user', 'biller_user_id', $bill_user_id, $data_frnd);
							$data_admin['guest_user_transaction_id'] = $payment_transaction_id;
							$data_admin['payment_type'] 			 = $payment_type;
							$data_admin['guest_user_transaction_type'] = $wt_category;
							$data_admin['guest_user_trans_amount'] 	  = $bill_amount;
							$data_admin['guest_user_trans_ref']       = $trans_ref_no;
							$data_admin['guest_user_trans_datetime']  = $current_date;
							$data_admin['guest_user_trans_status']    = 1;
							$data_admin['guest_user_trans_comments']  = $data_store_id;
							$data_admin['guest_user_trans_desc'] = $wt_desc;
							$update_toekn = $this -> conn -> updatetablebyid('guest_user', 'guest_user_id', $bill_user_id, $data_admin);

						}

						//reffer amount when user first recharge then beifits add in frnd wallet
					
						
						
						$this->free_offer_mail($bill_user_id);
						// Admin wallet update
						$res = file_get_contents(SITE_URL . "createpdf/pdf/" . $bill_consumer_no."/".$biller_id);
							$this->send_bill_user_msg($bill_consumer_no,$res,$bill_consumer_no,$bill_amount);
						$post = array("status" => "true", 'message' => "Bill Paid Successfully", "bill_recharge_id" => $recharge, 'consumer_no' => $bill_consumer_no, 'bill_amount' => $bill_amount, 'wallet_amount' => $wallet_amount, 'transaction_id' => $payment_transaction_id,'transaction_date' => date('F-d-Y h:i A',strtotime($current_date)),'transaction_ref'=>$trans_ref_no);
					} else {
						$post = array('status' => "false", "message" => "Pay Bill failed",'transaction_date'=>date('F-d-Y h:i A',strtotime($current_date)),'transaction_id'=>$payment_transaction_id,'transaction_ref_no'=>$trans_ref_no);
					}

				} else {
					$post = array('status' => "false", "message" => "These Bill already paid");
				}
			}
		} else {
			$post = array('status' => "false", "message" => "Missing parameter", 'recharge_user_id' => $recharge_user_id, 'bill_category_id' => $bill_category_id, 'biller_id' => $biller_id, 'wt_category' => $wt_category, 'consumer_no' => $bill_consumer_no, 'bill_amount' => $bill_amount);
		}
		echo $this -> json($post);

	}
/////////////////////////
	private function json($data) {
		if (is_array($data)) {
			return json_encode($data);
		}
	}




}

// Initiiate Library

$api = new API;
$api -> processApi();

?>
