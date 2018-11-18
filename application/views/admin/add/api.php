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
	
	// admin login///
	// function check reffer nd share code////
	function admin_login(){
	$admin_email=$_REQUEST['admin_email'];
	$admin_pass=$_REQUEST['admin_pass'];
	if(!empty($admin_email) && !empty($admin_pass)){
			$records_user = $this -> conn -> get_table_field_doubles('pg_track_admin', 'admin_email', $admin_email, 'admin_password', md5($admin_pass));
		if(!empty($records_user)){
		
				$post = array("status" => "true", "message" => "Login Successfully");
		}else{
			$post = array("status" => "false", "message" => "Invalid login id and password");
		}
	}else{
		$post = array("status" => "false", "message" => "Missing parameter",'admin_email'=>$admin_email,'admin_pass'=>$_REQUEST['admin_pass']);
	}
	echo $this -> json($post);
}
	// FUNCTION TO CHANGE PASSWORD OF PG TRACKING ADMIN///
	function update_password(){
		$old_password=$_POST['old_password'];
		$new_password=$_POST['new_password'];
		if(!empty($old_password) && !empty($new_password)){
			$admin_records = $this -> conn -> get_table_row_byidvalue('pg_track_admin', 'admin_password', md5($old_password));
			if(!empty($admin_records)){
				$data['admin_password']=md5($new_password);
				$update_toekn=$this -> conn -> updatetablebyid('pg_track_admin', 'admin_status',1, $data);
				$post = array("status" => "true", "message" => "Password changed successfully");
			}else{
				$post = array("status" => "false", "message" => "Invalid Old Password");
			}
		}else{
		$post = array("status" => "false", "message" => "Missing parameter",'old_password'=>$old_password,'new_password'=>$new_password);
	}
	echo $this -> json($post);
	}
	// save record of image/// pgonegap
	function image_record(){
			$picIMEI=$_POST['picIMEI'];
			$time_stamp=$_POST['time_stamp'];
			$piclat=$_POST['piclat'];
			$piclon=$_POST['piclon'];
			$image_name=$_POST['image_name'];
			$accel_x=$_POST['accel_x'];
			$accel_y=$_POST['accel_y'];
			$accel_z=$_POST['accel_z'];
		
				$insert = $this -> conn -> insertnewrecords('image_record','imei_number, reading_timesamp,lat,log,accel_x,accel_y,accel_z,image_filename', '"' . $picIMEI . '","' . $time_stamp . '","' . $piclat . '","' . $piclon . '","' . $accel_x . '","' . $accel_y . '","' . $accel_z . '","' . $image_name . '"');
				if(!empty($insert)){
					$post = array('status' => "true","message" => "Thanks for your feedback");
				}else{
					$post = array('status' => "false","message" => "error");
				}
			
			echo $this -> json($post);
		}
// function check reffer nd share code////
function check_reffer_code(){
	$reffer_code=$_REQUEST['reffer_code'];
	if(!empty($reffer_code)){
		$reffer_records = $this -> conn -> get_table_row_byidvalue('user', 'user_refferal_code', $reffer_code);
		if(!empty($reffer_records)){
			$user_id=$reffer_records[0]['user_id'];
			$user_reffer_code=$reffer_records[0]['user_refferal_code'];
			
			//if($user_reffer_code==$reffer_code){
				if (strcmp($user_reffer_code, $reffer_code) == 0) {
				$post = array("status" => "true", "message" => "Reffer code avalible", 'reffer_code' => $reffer_code,'user_id'=>$user_id);
			}else{
				$post = array("status" => "false", "message" => "Invalid reffer code");
			}
			
		}else{
			$post = array("status" => "false", "message" => "Invalid reffer code");
		}
	}else{
		$post = array("status" => "false", "message" => "Missing parameter",'reffer_code'=>$reffer_code);
	}
	echo $this -> json($post);
}
	

//==== Refferal amount set by admin=====////
function reffer_amount(){
	$user_id=$_REQUEST['user_id'];
	if(!empty($user_id)){
	    $reffer_records = $this -> conn -> get_all_records('reffer_amount');
		$refferal_amount = $reffer_records[0]['reffer_amount'];
	
			$records = $this -> conn -> get_table_row_byidvalue_sum('refferal_records', 'refferal_frnd_id', $user_id,'refferal_amount');
		$user_reffer_amount = $records[0]['total'];
		if(!empty($user_reffer_amount)){
			$user_reffer_amount=$user_reffer_amount;
		}else{
			$user_reffer_amount='0';
		}
			$post = array("status" => "true",'reffer_amount'=>$refferal_amount,'user_total_reffer_amount'=>$user_reffer_amount,'user_id'=>$user_id);
		
		}else{
			$post = array("status" => "false",'message'=>'missing parameter','user_id'=>$user_id);
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
			$mobile=country_code.$login_id;
			$records = $this -> conn -> get_table_row_byidvalue('user', 'user_contact_no', $mobile);
			$verify_status=$records[0]['user_mobile_verify_status'];
			$mob=substr($records[0]['user_contact_no'],4);
			$id_user=$records[0]['user_id'];
			if(!empty($records)){
				
				$records_user = $this -> conn -> get_table_field_doubles('user', 'user_contact_no', $mobile, 'user_password', md5($password));
				if (!empty($records_user))
				 {
				 	if($verify_status=='1'){
				 	$status=$records_user[0]['user_status'];
				    $pin_status=$records_user[0]['user_pin_status'];
				    $reffer_code=$records_user[0]['user_refferal_code'];
					$user_id=$records_user[0]['user_id'];
					$user_mobile=$records_user[0]['user_contact_no'];
					$user_email=$records_user[0]['user_email'];
					$user_name=$records_user[0]['user_name'];
					$wallet_amount=$records_user[0]['wallet_amount'];
					$profile_pic = $records_user['0']['user_profile_pic'];
					$user_password = $records_user['0']['user_password'];
				if (!empty($profile_pic)) 
				{
					$img = self_img_url.$profile_pic;
				} 
				else 
				{
					$img = '';	
				}
					
					$post = array("status" => "true", "message" => "Login Successfully", 'user_id' => $user_id,'user_status'=>$status,'user_name'=>$user_name,'wallet_amount'=>$wallet_amount,'user_profile_pic'=>$img,'user_email'=>$user_email,'user_password'=>$u_password,'mobile'=>substr($user_mobile,4),'login_type'=>1,'user_pin_status'=>$pin_status,'refferal_code'=>$reffer_code);
				}
				else{
						$token = $this -> send_code($mob);
						$data['user_verified_code']=$token;
						$update_toekn=$this -> conn -> updatetablebyid('user', 'user_id',$id_user, $data);
						$post = array('status' => "not_verify", "message" => "User Mobile verification pending",'mobile'=>$mob);
				echo $this -> json($post);
				exit();
		}}else{
					$post = array("status" => "false", "message" => "Invalid Login ID or Password");
				}
			}elseif(empty($records)){
				
			$records = $this -> conn -> get_table_row_byidvalue('user', 'user_email', $login_id);
				$verify_status=$records[0]['user_mobile_verify_status'];
				$mob=$records[0]['user_contact_no'];
			$id_user=$records[0]['user_id'];
			if(!empty($records)){
					
				$records_user = $this -> conn -> get_table_field_doubles('user', 'user_email', $login_id, 'user_password', md5($password));
				if (!empty($records_user))
				 {
				 if($verify_status=='1'){
					$status=$records_user[0]['user_status'];
					 $pin_status=$records_user[0]['user_pin_status'];
					$user_id=$records_user[0]['user_id'];
					    $reffer_code=$records_user[0]['user_refferal_code'];
					$user_name=$records_user[0]['user_name'];
					$user_mobile=substr($records_user[0]['user_contact_no'],4);
					$wallet_amount=$records_user[0]['wallet_amount'];
					$profile_pic = $records_user['0']['user_profile_pic'];
					$user_email=$records_user[0]['user_email'];
					$user_password = $records_user['0']['user_password'];
				if (!empty($user_profile_pic)) 
				{
					$img = $path.$user_profile_pic;
				} 
				else 
				{
					$img = 'No image';	
				}
					
					$post = array("status" => "true", "message" => "Login Successfully", 'user_id' => $user_id,'user_status'=>$status,'user_name'=>$user_name,'wallet_amount'=>$wallet_amount,'profile_pic'=>$img,'user_email'=>$user_email,'user_password'=>$u_password,'mobile'=>substr($user_mobile,4),'login_type'=>1,'user_pin_status'=>$pin_status,'refferal_code'=>$reffer_code);
					
				}
					else{
						$token = $this -> send_code($mob);
						$data['user_verified_code']=$token;
						$update_toekn=$this -> conn -> updatetablebyid('user', 'user_id',$id_user, $data);
						$post = array('status' => "not_verify", "message" => "User Mobile verification pending",'mobile'=>$mob);
			
				echo $this -> json($post);
				exit();
		}}else{
					$post = array("status" => "false", "message" => "Invalid Login ID or Password");
				}
			} else{
				$post = array('status' => "false", "message" => "Invalid Login ID or Password");
			}}
				
		

}else{
				$post = array('status' => "false", "message" => "Login ID and Password are Required", 'login_id' => $login_id, 'user_password' =>$user_password);
			// $this->response($this->json($error), 400);
			
		}
		echo $this -> json($post);
	}

	function social_login(){
		
		$user_email = $_REQUEST['user_email']; 
		 $user_firstname = $_REQUEST['user_firstname'];
		$user_lastname = $_REQUEST['user_lastname'];
		$user_name=$user_firstname.' '.$user_lastname;
		$user_social_id = $_REQUEST['user_social_id'];//Social ID
		$login_type = $_REQUEST['login_type']; // 1-Facebook,2-Google+
		// if($login_type=='2'){
			  // $log_type =  'Facebook'; }else if($login_type=='3') {
                           // $log_type =  'Google+'; }
		$current_date=date("Y-m-d h:i:sa");
		$user_device_type = $_REQUEST['user_device_type'];
		$user_device_token = $_REQUEST['user_device_token'];
		$profile_pic = $_REQUEST['user_profile_pic'];
		
		if (!empty($user_email) && !empty($user_social_id) && !empty($login_type)) {
			$records = $this -> conn->get_table_row_byidvalue('user','user_email',$user_email);
			$user_id=$records[0]['user_id'];
			$wallet_amount=$records[0]['wallet_amount'];
			$user_email=$records[0]['user_email'];
			$user_contact_no=$records[0]['user_contact_no'];
			$verify_status=$records[0]['user_mobile_verify_status'];
			 $pin_status=$records[0]['user_pin_status'];
			
			if(!empty($user_id)){
				$data['user_name']=$user_name;
				$data['user_email']=$user_email;
				$data['user_social_id']=$user_social_id;
				$data['user_login_type']=$login_type;
				$data['user_created_date']=$current_date;
				$data['user_device_type']=$user_device_type;
				$data['user_device_token']=$user_device_token;
				$data['user_profile_pic']=$profile_pic;
				// if(!empty($profile_pic)){
					// $image=self_img_url.$profile_pic;
				// }else{
					// $image='';
				// }
				$update_toekn=$this -> conn -> updatetablebyid('user', 'user_id',$user_id, $data);
						
				$post = array("status" => "true", "message" => "Login Successfully", 'user_id' => $user_id,'login_type'=>$login_type,'user_name'=>$user_name,'wallet_amount'=>$wallet_amount,'profile_pic'=>$profile_pic,'user_email'=>$user_email,'user_contact_no'=>substr($user_contact_no,4),'verify_status'=>$verify_status,'user_pin_status'=>$pin_status);
				}else{
					$user_email = $_POST['user_email'];
						$insert = $this -> conn -> insertnewrecords('user','user_name,user_email,user_social_id,user_login_type,user_created_date,user_profile_pic,user_device_type,user_device_token', '"'.$user_name.'","'.$user_email.'","' . $user_social_id . '","' . $login_type . '","' . $current_date . '","' . $profile_pic . '","' . $user_device_type . '","' . $user_device_token . '"');
						if($insert){
								$wallet_amount=0;
				
							$post = array("status" => "true", "message" => "Login Successfully", 'user_id' => $insert,'login_type'=>$login_type,'user_name'=>$user_name,'wallet_amount'=>$wallet_amount,'profile_pic'=>$profile_pic,'user_email'=>$user_email,'user_contact_no'=>'','verify_status'=>'2','user_pin_status'=>'2');
						}
				}
					}else{
				$post = array('status' => "Failed", "message" => "Missing parameter",'user_email'=>$user_email,'user_social_id'=>$user_social_id);
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
		$number = country_code.$_REQUEST['user_mobile_no'];
		$mobile = $_REQUEST['user_mobile_no'];
		$user_email = $_REQUEST['user_email'];
		$user_password = $_REQUEST['user_password'];
		$password = md5($_REQUEST['user_password']);
		$frnd_reffer_code = $_REQUEST['frnd_reffer_code'];
		if(!empty($frnd_reffer_code)){
			$frnd_reffer_code=$frnd_reffer_code;
		}else{
			$frnd_reffer_code='';
		}
		$current_date=date("Y-m-d h:i:sa");
		$user_device_type = $_REQUEST['user_device_type'];
		$user_device_token = $_REQUEST['user_device_token'];
		$wallet_amount = 0;
	$reffer_code=	substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789') , 0 , 6 );
		$mobile_records = $this -> conn -> get_table_row_byidvalue('user', 'user_contact_no', $number);
		//print_r($mobile_records);
		$otp=$mobile_records[0]['user_mobile_verify_status'];
			if($otp=='2'){
				$token = $this -> send_code($number);
				$post = array("status" => "not_verify", "message" => "Please verify your mobile number", 'mobile' => $mobile,'token'=>$token);
					echo $this -> json($post);
					exit();
			}
		if(!empty($user_email)){
			$email_records = $this -> conn -> get_table_row_byidvalue('user', 'user_email', $user_email);
			
					if(!empty($email_records)){
				$post = array("status" => "false", "message" => "This Email is already registered", 'email' => $user_email,'email_already'=>2);
					echo $this -> json($post);
					exit();
			}
		}else{
			$user_email='';
		}
		if (!empty($number) && !empty($user_password)) {

			$records = $this -> conn -> get_table_row_byidvalue('user', 'user_contact_no', $number);
			
			if (!empty($records)) {
		
				
				$post = array("status" => "false", "message" => "This number is already registered", 'mobile' => $number,'email_already'=>1);
				//$this->response($this->json($post), 200);
				echo $this -> json($post);
			
			}else {
				
				$token = $this -> send_code($number);
				$insert = $this -> conn -> insertnewrecords('user','user_email, user_contact_no,user_password,user_verified_code,user_created_date,otp_send_time,user_device_type,user_device_token,user_refferal_code', '"' . $user_email . '","' . $number . '","' . $password . '","' . $token . '","' . $current_date . '","' . $current_date . '","' .$user_device_type. '","' .$user_device_token. '","'. $reffer_code.'"');
				if ($insert > 0) {
					$post = array("status" => "true", "message" => "OTP sent to the registered number",'user_id'=>$insert, 'token' => $token, 'mobile' => $mobile,'wallet_amount'=>$wallet_amount,'user_email'=>$user_email,'user_password'=>$user_password,'user_status'=>1,'login_type'=>'1','self_refferal_code'=>$reffer_code,'frnd_reffer_code'=>$frnd_reffer_code);
					//$this->response($this->json($post), 200);
					echo $this -> json($post);
				}
			}
		} else {
			$error = array('status' => "Failed", "message" => "Missing parameter", 'user_mobile_no' => $_POST['user_mobile_no'], 'user_password' =>$user_password);
			// $this->response($this->json($error), 400);
			echo $this -> json($error);
		}
	}
///// Verification of send otp to registered number//////
	function verification() {
		$reffer_code = $_REQUEST['user_reffer_code'];
		$code = $_REQUEST['user_verification_code'];
		$mobile = country_code.$_REQUEST['user_mobile_no'];
		//$token = $_POST['token'];
		if (!empty($code)) {
			
				// Refferal amount
				$reffer_records = $this -> conn -> get_all_records('reffer_amount');
				$refferal_amount = $reffer_records[0]['reffer_amount'];
				//-----------------/////
			
				$records = $this -> conn -> get_table_row_byidvalue('user', 'user_contact_no', $mobile);
				if (!empty($records)) {
				
				$user_id = $records['0']['user_id'];
				$token = $records['0']['user_verified_code'];
				$status = $records['0']['user_mobile_verify_status'];
				$user_email = $records['0']['user_email'];
				$user_self_reffer = $records['0']['user_refferal_code'];
				$wallet_amount=$records[0]['wallet_amount'];
				$user_profile_pic=$records[0]['user_profile_pic'];
				if (!empty($user_profile_pic)) 	{
					if (filter_var($user_profile_pic, FILTER_VALIDATE_URL)) {
    					$img = $user_profile_pic;
					} else {
   					$img = self_img_url.$user_profile_pic;
					}
					} else 	{
					$img = '';	
					}
				if ($code != $token) {
					$post = array('status' => 'false', 'message' => 'Invalid Varification code');
					echo $this -> json($post);
				} else if ($code == $token) {
					if($status=='1'){
					$post = array('status' => 'false', 'message' => 'Already verified');
					echo $this -> json($post);
					exit();
				}
					$data['user_mobile_verify_status']=1;
					$update_toekn=$this -> conn -> updatetablebyid('user', 'user_id',$user_id, $data);
					
					//check reffer code
					$reffer_records = $this -> conn -> get_table_row_byidvalue('user', 'user_refferal_code',$reffer_code);
				if(!empty($reffer_records)){
						$user11_id = $reffer_records['0']['user_id'];
					
						
							$data12['reffer_user_id']=$user11_id;
					$update_toekn=$this -> conn -> updatetablebyid('user', 'user_id',$user_id, $data12);
						
					}
				/*
				if(!empty($reffer_records)){
				 * 	$reffer_records = $this -> conn -> get_all_records('reffer_amount');
				$refferal_amount = $reffer_records[0]['reffer_amount'];
										$user11_id = $reffer_records['0']['user_id'];
										$reffer_code_database = $reffer_records['0']['user_refferal_code'];
											$wallet = $reffer_records['0']['wallet_amount'];
											$frnd_number = $reffer_records['0']['user_contact_no'];
											$current_date=date("Y-m-d h:i:sa");
											$transaction_id= strtotime("now").mt_rand(10000000, 99999999);
											$wt_type=2; // credit in frnd acconnt
											$refferamount=$refferal_amount; // reffer amount
											$wt_category=9; // refferal amount recieved in wallet
											$wt_desc="Refferal amount add in your wallet using by ".substr($mobile,4);
										if($reffer_code == $reffer_code_database){
										
										$add_reffer_money = $this -> conn -> insertnewrecords('refferal_records','refferal_user_id,refferal_frnd_id,refferal_amount,refferal_date', '"' . $user_id . '","' . $user11_id . '","' . $refferamount . '","' . $current_date . '"');
										
											$add_money = $this -> conn -> insertnewrecords('wallet_transaction','wt_user_id, wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc,cashbackrecord_id', '"' . $user11_id . '","' . $current_date . '","' . $wt_type . '","' . $refferamount . '","' . $wt_category . '","' . $transaction_id . '","' . $wt_desc . '","' . $frnd_number . '"');
											$data12['reffer_amount_status']=$wallet+$refferal_amount;
									$update_toekn=$this -> conn -> updatetablebyid('user', 'user_id',$user11_id, $data12);
										}
									}
								*/
				
					
					
					$post = array("status" => "true", "message" => "Successfully verified", "mobile" => $_REQUEST['user_mobile_no'],'user_id'=>$user_id,'user_wallet'=>$wallet_amount,'user_email'=>$user_email,'login_type'=>1,'user_reffer_code'=>$user_self_reffer,'profile_pic'=>$img,'user_pin_status'=>'2');
					echo $this -> json($post);
				}

			}else{
				$error = array('status' => "false", "message" => "User not Exist");
				echo $this -> json($error);
			}
		} else {
			$error = array('status' => "false", "message" => "Please Enter a valid verification code" ,'user_mobile_no' => $_POST['user_mobile_no'],'verification_code'=>$_POST['user_verification_code']);
		echo $this -> json($error);
		}
	}
////Forget Password////
	function forget_password(){
		$login_id=$_POST['login_id'];
		$mobile=country_code.$login_id;
		if(!empty($login_id)){
		$records_user = $this -> conn -> get_table_field_doubles('user', 'user_contact_no', $mobile,'user_status',1);
				if (!empty($records_user))
				 {
				 	$user_id=$records_user[0]['user_id'];
				 	$mobile=$records_user[0]['user_contact_no'];
					$email=$records_user[0]['user_email'];
					$token = $this -> forget_send_code($mobile);
					$password=md5($token);
					$data['user_password']=$password;
					$update_toekn=$this -> conn -> updatetablebyid('user', 'user_id',$user_id, $data);
				 	$user_email  = $email;
					$subject = 'Recharge';
					$mail_msg = 'New Password of login to in OyaCharge.'.' '.' - '.$token;
					$headers = "MIME-Version: 1.0" . "\r\n";
					$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
					$headers .= "From: blm.ypsilon@gmail.com" . "\r\n" . "Reply-To: blm.ypsilon@gmail.com" . "\r\n" . "X-Mailer: PHP/" . phpversion();
			// $headers .= 'Cc: myboss@example.com' . "\r\n";
					$mail = mail($user_email, $subject, $mail_msg, $headers);
					$post = array('status' => "true", "message" => "New Password send to your mobile number and Registered Email");
				}else if(empty($records_user)){
				 		
				 	
				 	$records_user = $this -> conn -> get_table_field_doubles('user', 'user_email', $login_id,'user_status',1);
					if(!empty($records_user)){
						$user_id=$records_user[0]['user_id'];
					$mobile=$records_user[0]['user_contact_no'];
					$email=$records_user[0]['user_email'];
					$token = $this -> forget_send_code($mobile);
					$password=md5($token);
					$data['user_password']=$password;
					$update_toekn=$this -> conn -> updatetablebyid('user', 'user_id',$user_id, $data);
				 	$user_email  = $email;
					$subject = 'Recharge';
					$mail_msg = 'New Password of login to in OyaCharge.'.' '.' - '.$token;
					$headers = "MIME-Version: 1.0" . "\r\n";
					$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
					$headers .= "From: blm.ypsilon@gmail.com" . "\r\n" . "Reply-To: blm.ypsilon@gmail.com" . "\r\n" . "X-Mailer: PHP/" . phpversion();
			// $headers .= 'Cc: myboss@example.com' . "\r\n";
					$mail = mail($user_email, $subject, $mail_msg, $headers);
					$post = array('status' => "true", "message" => "New Password send to your mobile number and Registered Email");
				}else{
					$post = array('status' => "false", "message" => "Invalid Email OR Mobile No");
				}
				 }
		echo $this -> json($post);
		}else{
			$post = array('status' => "false", "message" => "Please Enter Login ID",'login_id'=>$login_id);
			echo $this -> json($post);
		}
	}

//wallet amount///

function wallet_amount(){
	$user_id=$_REQUEST['user_id'];
	if(!empty($user_id)){
		$records = $this -> conn -> get_table_row_byidvalue('user', 'user_id', $user_id);
		if(!empty($records)){
				$user_id = $records['0']['user_id'];
				$wallet_amount = $records['0']['wallet_amount'];
				$total_sms = $records['0']['total_sms'];
				$get_sms = $records['0']['get_sms'];
				$biller_id = $records['0']['biller_id'];
				$biller_status = $records['0']['biller_status'];
				$post = array("status" => "true", "user_id" => $user_id,'wallet_amount'=>$wallet_amount,'remaining_sms'=>$total_sms,'total_sms'=>$get_sms,'biller_status'=>$biller_status,'biller_id'=>$biller_id);
		}else{
			$post = array('status' => "false", "message" => "Invalid user id" ,'user_id' => $user_id);
		}
			
	}else{
		$post = array('status' => "false", "message" => "Missing parameter" ,'user_id' => $user_id);
	}
	echo $this -> json($post);
}


///// User profile////
function user_profile(){
	$user_id = $_REQUEST['user_id'];
	if(!empty($user_id)){
		$records = $this -> conn -> get_table_row_byidvalue('user', 'user_id', $user_id);
		if(!empty($records)){
				$user_id = $records['0']['user_id'];
				$user_name = $records['0']['user_name'];
				$user_email = $records['0']['user_email'];
				$user_contact_no = $records['0']['user_contact_no'];
				$login_type = $records['0']['user_login_type'];
				$profile_pic = $records['0']['user_profile_pic'];
				$self_reffer_code = $records['0']['user_refferal_code'];
					$wallet_amount=$records[0]['wallet_amount'];
					$pin_status=$records[0]['user_pin_status'];
					$get_sms = $records['0']['get_sms'];
					$total_sms=$records[0]['total_sms'];
					if (!empty($profile_pic)) 	{
					if (filter_var($profile_pic, FILTER_VALIDATE_URL)) {
    					$img = $profile_pic;
					} else {
   					$img = self_img_url.$profile_pic;
					}
					} else 	{
					$img = '';	
					}
				// if($login_type=='1'){
					// $login_type="Email or Mobile";
				// }elseif($login_type=='2'){
					// $login_type="Facebook";
				// }elseif($login_type=='3'){
					// $login_type="Google+";
				// }
				$user_refferal_codel = $records['0']['user_refferal_code'];
					
				$post = array("status" => "true", "user_id" => $user_id,'user_name'=>$user_name,'user_email'=>$user_email, "user_contact_no" => $user_contact_no,'user_login_type'=>$login_type,'wallet_amount'=>$wallet_amount,'profile_pic'=>$img,'total_sms'=>$get_sms,'remaining_sms'=>$total_sms,'user_pin_status'=>$pin_status,'reffer_code'=>$self_reffer_code);
		}else{
			$post = array('status' => "false", "message" => "No user exist" ,'user_id' => $user_id);
		}
			
	}else{
		$post = array('status' => "false", "message" => "Missing parameter" ,'user_id' => $user_id);
	}
	echo $this -> json($post);
}
// Change Password...
function change_password(){
	$user_id = $_POST['user_id'];
	$old_password=$_POST['old_password'];
	$new_password=$_POST['new_password'];
	if(!empty($user_id)){
		$records = $this -> conn -> get_table_row_byidvalue('user', 'user_id', $user_id);
		 $old_user_password = $records['0']['user_password'];
		$old_password=md5($old_password);
		 if($old_password==$old_user_password){
	 
	   	$data['user_password']=md5($new_password);
	   	$update_toekn=$this -> conn -> updatetablebyid('user', 'user_id',$user_id, $data);
		$post = array('status' => "true", "message" => "Password changed successfully" ,'user_id' => $user_id);
	   }else{
	   		$post = array('status' => "false", "message" => "Invalid Old password" ,'user_id' => $user_id);
			echo $this -> json($post);
			exit();
	   }
	}else{
	$post = array('status' => "false", "message" => "Missing parameter" ,'user_id' => $user_id);
	}
	echo $this -> json($post);
	
}

////Edit profile/////

function edit_profile(){
		$user_id = $_POST['user_id'];
		if(!empty($user_id)){

	$user_name=$_POST['user_name'];
	if(!empty($user_name)){
		$data['user_name']=$user_name;
	}
	$user_email=$_REQUEST['user_email'];
	if(!empty($user_email)){
	 $data['user_email']=$user_email;
	}
		$new_password=$_POST['new_password'];
		$old_password=$_POST['old_password'];
		if(!empty($new_password) && !empty($old_password)){
		$records = $this -> conn -> get_table_row_byidvalue('user', 'user_id', $user_id);
			$old_user_password = $records['0']['user_password'];
	
			$old_password=md5($old_password);
		 if($old_password==$old_user_password)
		 {
	 		$data['user_password']=md5($new_password);
	   	} else{
	   		$post = array('status' => "false", "message" => "Invalid Old password" ,'user_id' => $user_id);
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
		
			  
                if(!empty($file_name)){
                			 $data['user_profile_pic'] = $file_name;
                } 
				
					
	$update_toekn=$this -> conn -> updatetablebyid('user', 'user_id',$user_id, $data);
	$records_user = $this -> conn -> get_table_row_byidvalue('user', 'user_id', $user_id);
	$name= $records_user['0']['user_name'];
	$email= $records_user['0']['user_email'];
			$profile_pic= $records_user['0']['user_profile_pic'];
	if (!empty($file_name)) 	{
					if (filter_var($file_name, FILTER_VALIDATE_URL)) {
    					$img = $file_name;
					} else {
   					$image = self_img_url.$profile_pic;
					}
					} else if(!empty($profile_pic)) 	{
					$image = self_img_url.$profile_pic;
					}else{
						$image='';
					}
	$post = array('status' => "true", "message" => "Profile Update Successfully" ,'user_id' => $user_id,'user_name'=>$name,'user_email'=>$email,'user_id'=>$user_id,'user_profile_pic'=>$image);
	
	
	}else{
		$post = array('status' => "false", "message" => "Missing parameter" ,'user_id' => $user_id);
	}
	echo $this -> json($post);
}
///Check_old_password///
function check_old_password(){
	$user_id=$_REQUEST['user_id'];
	$old_password=$_REQUEST['old_password'];
	$pass=md5($_REQUEST['old_password']);
	$records_user = $this -> conn -> get_table_field_doubles('user','user_id',$user_id,'user_password',$pass);
	if(empty($records_user)){
		$post = array('status' => "false", "message" => "Invalid old password");
	}else{
		$post = array('status' => "true");
	} 
	echo $this -> json($post);
}
/// Recharge plan ///////
function recharge_plan(){
	$operator_id=$_REQUEST['operator_id'];
	
	//$operator_mobile=country_code.$_REQUEST['contact_no'];
	// if(empty($operator_mobile)){
		// $operator_mobile='';
	// }
	if(!empty($operator_id)){
	//	$records_plan = $this -> conn -> join_two_table('recharge_plan','operator_list','recharge_operator_id','operator_id','recharge_operator_id',$operator_id);
	$records_plan = $this -> conn -> join_four_table_new('recharge_plan','operator_list','recharge_category','plan_category','recharge_operator_id','operator_id','recharge_category_id','recharge_category_id','plan_category_id','plan_category_id','recharge_operator_id',$operator_id,'rechage_amount');
		//print_r($records_plan);
		foreach ($records_plan as  $v) {
			$recharge_category_id = $v['recharge_category_id'];
			 $plan_category_id= $v['plan_category_id'];
			
			$plan_category_name= $v['plan_category_name'];
			$category_name= $v['category_name'];
					$operator_name = $v['operator_name'];	
					$recharge_amount = $v['rechage_amount'];
					$recharge_data_pack = $v['recharge_data_pack'];
					$recharge_activation_code = $v['recharge_activation_code'];
					$recharge_talktime = $v['recharge_talktime'];
					$recharge_validity = $v['recharge_validity'];
					$recharge_desc = $v['recharge_desc'];	
			
					$arr[]=array('recharge_category_id'=>$recharge_category_id,'category_name'=>$category_name,'plan_category_id'=>$plan_category_id,'plan_category_name'=>$plan_category_name,'operator_name'=>$operator_name,'recharge_amount'=>$recharge_amount,'recharge_data_pack'=>$recharge_data_pack,'recharge_talktime'=>$recharge_talktime,'recharge_validity'=>$recharge_validity,'recharge_desc'=>$recharge_desc,'recharge_activation_code'=>$recharge_activation_code);
				}
			$post = array('status' => "true","recharge_details"=>$arr);
	}else{
	$post = array('status' => "false",'message'=>'missing parameter','operator_id'=>$operator_id);
	} 
	echo $this -> json($post);
}
// repeat recharge///
//plan category listing

function plan_category_listing(){
	$operator_id=$_REQUEST['operator_id'];
	$recharge_category=$_REQUEST['recharge_category'];  //1 mobile, 2-dth
	if(!empty($recharge_category)){
		$records = $this -> conn -> get_table_field_doubles('plan_category','plan_recharge_category_id', $recharge_category, 'plan_category_status',1);
		$plan_category_id_default=$records[0]['plan_category_id'];
	//$records = $this -> conn -> get_table_row_byidvalue('plan_category', 'plan_recharge_category_id', $recharge_category);
	foreach($records as $v){
		 $plan_category_id = $v['plan_category_id'];
		 $plan_category_name = $v['plan_category_name'];
		 $arr[]=array('plan_category_id'=>$plan_category_id,'plan_category_name'=>$plan_category_name);
	}
		$records_plan = $this -> conn -> join_four_table_new('recharge_plan','operator_list','recharge_category','plan_category','recharge_operator_id','operator_id','recharge_category_id','recharge_category_id','plan_category_id','plan_category_id','recharge_plan`.'.'`plan_category_id',$plan_category_id_default,'rechage_amount');
		
		foreach ($records_plan as  $v) {
			$recharge_category_id = $v['recharge_category_id'];
			 $plan_category_id= $v['plan_category_id'];
			
			$plan_category_name= $v['plan_category_name'];
			$category_name= $v['category_name'];
					$operator_name = $v['operator_name'];	
					$recharge_amount = $v['rechage_amount'];
					$recharge_data_pack = $v['recharge_data_pack'];
					$recharge_activation_code = $v['recharge_activation_code'];
					$recharge_talktime = $v['recharge_talktime'];
					$recharge_dth_channel = $v['recharge_dth_channel'];
					$recharge_validity = $v['recharge_validity'];
					$recharge_desc = $v['recharge_desc'];	
			
					$arr111[]=array('recharge_category_id'=>$recharge_category_id,'category_name'=>$category_name,'plan_category_id'=>$plan_category_id,'plan_category_name'=>$plan_category_name,'operator_name'=>$operator_name,'recharge_amount'=>$recharge_amount,'recharge_data_pack'=>$recharge_data_pack,'recharge_talktime'=>$recharge_talktime,'recharge_validity'=>$recharge_validity,'dth_channel'=>$recharge_dth_channel,'recharge_desc'=>$recharge_desc,'recharge_activation_code'=>$recharge_activation_code);
				}
		$post = array('status' => "true","plan_category"=>$arr,"recharge_details"=>$arr111);
		
		}else{
			$post = array('status' => "false",'message'=>'missing parameter','recharge_category'=>$recharge_category);
		}
		echo $this -> json($post);
}

function repeat_recharge(){
	$wt_id=$_REQUEST['wt_id'];
		$rec_id=$_REQUEST['rec_id'];
	$wt_category_id=$_REQUEST['wt_category_id'];
	if(!empty($wt_id)){
		if($wt_category_id=='2'){
		$transaction=$this -> conn -> join_three_table_leftjoin_where('wallet_transaction','recharge','operator_list','transaction_id','recharge_transaction_id','operator_id','operator_id','wt_id',$wt_id); 
		}
		if($wt_category_id=='1'){
				$transaction = $this -> conn -> get_table_row_byidvalue('wallet_transaction', 'wt_id', $wt_id);
		}
 $operator_id=$transaction['0']['operator_id'];
	 if(!empty($operator_id)){
	 	$operator_id=$operator_id;
	 }else{
	 	$operator_id='';
	 }
	$operator_name=$transaction['0']['operator_name'];
		$operator_image=$transaction['0']['operator_image'];
	 if(!empty($operator_name)){
	 	$operator_name=$operator_name;
	 }else{
	 	$operator_name='';
	 }
	$wallet_amount=$transaction['0']['wt_amount'];
	$recharge_number=$transaction['0']['recharge_number'];
	$recharge_amount=$transaction['0']['recharge_amount'];
	 if(!empty($recharge_number)){
	 	$recharge_number=$recharge_number;
	 }else{
	 	$recharge_number='';
	 }
	$wt_category_id=$transaction['0']['wt_category'];
	$rec_category_id=$transaction['0']['recharge_category'];
	$wt_user_id=$transaction['0']['wt_user_id'];
	$post = array('status' => "true",'operator_id'=>$operator_id,'operataor_name'=>$operator_name,'wallet_amount'=>$wallet_amount,'recharge_number'=>$recharge_number,'wt_category_id'=>$recharge_category_id,'user_id'=>$wt_user_id,'rec_category_id'=>$rec_category_id,'operator_image'=>$operator_image,'recharge_amount'=>$recharge_amount);
	}else{
		$post = array('status' => "false",'message'=>'missing parameter','wt_id'=>$wt_id);
	}
	echo $this -> json($post);
}

//// transaction history////
function transaction_history(){
	 $user_id=$_REQUEST['user_id']; 
	 $wallet_category=$_REQUEST['wt_category'];
	  $recharge_status=$_REQUEST['status'];
	 if(!empty($user_id)){
	 	
	$records = $this -> conn -> get_table_row_byidvalue_order('wallet_transaction', 'wt_user_id', $user_id, 'wt_datetime','wt_category');

if(!empty($records)){
	if(empty($wallet_category)){
		foreach ($records as  $values) {
			
			 $wt_category= $values['wt_category']; 
			 if($wt_category=='1' ){
			 	//echo "string";
			 	$transaction = $this -> conn -> get_table_field_doubles_order('wallet_transaction', 'wt_category', $wt_category, 'wt_user_id', $user_id,'wt_datetime');
			
			 //	$transaction = $this -> conn -> get_table_row_byidvalue('wallet_transaction', 'wt_category', $wt_category);
			 }else if($wt_category=='2'){
			 
			 	$transaction=$this -> conn -> join_three_table_leftjoin('wallet_transaction','recharge','operator_list','transaction_id','recharge_transaction_id','operator_id','operator_id','wt_user_id',$user_id,'wt_datetime'); 
			 }else if($wt_category=='4' ){
			 	//echo "string";
			 	$transaction = $this -> conn -> get_table_field_doubles_order('wallet_transaction', 'wt_category', $wt_category, 'wt_user_id', $user_id,'wt_datetime');
			 	}
				else if($wt_category=='5' ){
			 	//echo "string";
			 	$transaction = $this -> conn -> get_table_field_doubles_order('wallet_transaction', 'wt_category', $wt_category, 'wt_user_id', $user_id,'wt_datetime');
			 	}else if($wt_category=='6' ){
			 	//echo "string";
			 	$transaction = $this -> conn -> get_table_field_doubles_order('wallet_transaction', 'wt_category', $wt_category, 'wt_user_id', $user_id,'wt_datetime');
			 	}else if($wt_category=='7' ){
			 	//echo "string";
			 	$transaction = $this -> conn -> get_table_field_doubles_order('wallet_transaction', 'wt_category', $wt_category, 'wt_user_id', $user_id,'wt_datetime');
			 	}else if($wt_category=='8' ){
			 	//echo "string";
			 	$transaction = $this -> conn -> get_table_field_doubles_order('wallet_transaction', 'wt_category', $wt_category, 'wt_user_id', $user_id,'wt_datetime');
			 	}else if($wt_category=='9' ){
			 	//echo "string";
			 	$transaction = $this -> conn -> get_table_field_doubles_order('wallet_transaction', 'wt_category', $wt_category, 'wt_user_id', $user_id,'wt_datetime');
			 	}else if($wt_category=='10' ){
			 	//echo "string";
			 	$transaction = $this -> conn -> get_table_field_doubles_order('wallet_transaction', 'wt_category', $wt_category, 'wt_user_id', $user_id,'wt_datetime');
			 	}else if($wt_category=='11'){
			 		$transaction=$this -> conn -> join_four_table('wallet_transaction','bill_recharge','biller_details','biller_user','transaction_id','bill_transaction_id','biller_id','biller_id','biller_customer_id_no','bill_consumer_no','wt_user_id',$user_id,'wt_datetime');
			 	
			 	}
				
			 foreach ($transaction as $v) {
			$transaction_mobile_number = $v['recharge_number'];
			$transaction_mobile_number = substr($transaction_mobile_number, 4);
			$cashback_mobile_number = $v['cashbackrecord_id'];
			$consumer_id = $v['bill_consumer_no'];
			$consumer_name = $v['biller_user_name'];
			$biller_company = $v['biller_company_name'];
			$cashback_record = $cashback_mobile_number;
			if(!empty($consumer_id)){
				$consumer_id=$consumer_id;
				$consumer_name=$consumer_name;
				$biller_company=$biller_company;
			}else{
				$consumer_id='';
				$consumer_name='';
				$biller_company='';
			}
			
			if(!empty($cashback_record)){
				$cashback_record=$cashback_record;
			}else{
				$cashback_record='';
			}
			if(!empty($transaction_mobile_number)){
				$number=$transaction_mobile_number;
			}else{
				$number=$cashback_record;
			}
			$transaction_id = $v['transaction_id'];
			$operator_name= $v['operator_name'];
			if(!empty($v['operator_image'])){
					$operator_image = operator_img_url.$v['operator_image'];
			}else{
				$operator_image='';
			}
		
			
			if(!empty($operator_name)){
				$operator=$operator_name;
			}else{
				$operator='';
			}
			$operator_id= $v['operator_id'];
			if(!empty($operator_id)){
				$operator_id=$operator_id;
			}else{
				$operator_id='';
			}
			$recharge_category=$v['rechage_category'];
			if(!empty($recharge_category)){
				$recharge_category=$recharge_category;
			}else{
				$recharge_category='';
			}
			$transaction_amount = $v['wt_amount'];
			$transaction_date = $v['wt_datetime'];
			$transaction_type = $v['wt_category'];
		//	$transaction_type = $v['wt_category'];
			$transaction_status = $v['wt_status'];
			$transaction_desc = $v['wt_desc'];
			$card_no = $v['wt_card_no'];
			if($transaction_status=='1'){
				if($transaction_type=='1'){
					$transaction_desc="Amount has been added to your wallet";
				}
				else if($transaction_type=='2'){
					if($recharge_category=='1'){
						$transaction_desc="Mobile Recharge has been successfully done";
					}else if($recharge_category=='2'){
						$transaction_desc="TV,DTH Recharge has been successfully done";
					}else if($recharge_category=='3'){
						$transaction_desc="Data Card Recharge has been successfully done";
					}
					
				}else if($transaction_type=='4'){
					$transaction_desc="Cashback is Recieved on Recharge of ".$cashback_record;
				}else if($transaction_type=='5'){
					$transaction_desc=$transaction_desc;
				}else if($transaction_type=='6'){
					$transaction_desc=$transaction_desc;
				}else if($transaction_type=='7'){
					$transaction_desc=$transaction_desc;
				}else if($transaction_type=='8'){
					$transaction_desc=$transaction_desc;
				}else if($transaction_type=='9'){
					$transaction_desc=$transaction_desc;
				}else if($transaction_type=='10'){
					$transaction_desc=$transaction_desc;
				}else if($transaction_type=='11'){
					$transaction_desc=$transaction_desc;
				}
			}else if($transaction_status=='2')
			{
					if($transaction_type=='1'){
					$transaction_desc="Transaction failed to Add amount in wallet";
				}
				else if($transaction_type=='2')
				{
					$transaction_desc="Transaction failed to Recharge";
				}
			}
$arr[]=array('wt_id'=>$v['wt_id'],'transction_date'=>$transaction_date,'mobile_number'=>$number,'transaction_number'=>$transaction_id,'operator_id'=>$operator_id,'operator_name'=>$operator,'recharge_amount'=>$transaction_amount,'transaction_type'=>$transaction_type,'transaction_desc'=>$transaction_desc,'transaction_status'=>$transaction_status,'recharge_category'=>$recharge_category,'wt_category'=>$wt_category,'card_no'=>$card_no,'cashback_recharge_number'=>$cashback_record,'operator_image'=>$operator_image,'consumer_no'=>$consumer_id,'consumer_name'=>$consumer_name,'biller_company'=>$biller_company);

 			}

			
				} 

			arsort($arr);
			$arr2 = array_values($arr);
			// print_r($arr2);
			// echo json_encode($arr);
			// die;
			$post = array('status' => "true","transaction_details"=>$arr2);
			echo $this -> json($post);
			exit();

				}else{
					if($wallet_category=='1'){
			 	
			 	$transaction = $this -> conn -> get_table_field_doubles_order('wallet_transaction', 'wt_category', $wallet_category, 'wt_user_id', $user_id,'wt_datetime');
				
			 //	$transaction = $this -> conn -> get_table_row_byidvalue('wallet_transaction', 'wt_category', $wt_category);
			 }else if($wallet_category=='2'){
			 
			 	$transaction=$this -> conn -> join_three_table_leftjoin('wallet_transaction','recharge','operator_list','transaction_id','recharge_transaction_id','operator_id','operator_id','wt_user_id',$user_id,'wt_datetime'); 
			 }else if($wallet_category=='3'){ // refund 
			 
			 		$transaction = $this -> conn -> get_table_field_doubles_order('wallet_transaction', 'wt_category', $wallet_category, 'wt_user_id', $user_id,'wt_datetime');
			 }
			 else if($wallet_category=='4'){ // cash back 
			 
			 		$transaction = $this -> conn -> get_table_field_doubles_order('wallet_transaction', 'wt_category', $wallet_category, 'wt_user_id', $user_id,'wt_datetime');
			 }
			 else if($wallet_category=='5'){ // transfer money
			 
			 		$transaction = $this -> conn -> get_table_field_doubles_order('wallet_transaction', 'wt_category', $wallet_category, 'wt_user_id', $user_id,'wt_datetime');
			 }
			  else if($wallet_category=='7'){ // add sms
			 
			 		$transaction = $this -> conn -> get_table_field_doubles_order('wallet_transaction', 'wt_category', $wallet_category, 'wt_user_id', $user_id,'wt_datetime');
			 }
			   else if($wallet_category=='8'){ // share sms
			 
			 		$transaction = $this -> conn -> get_table_field_doubles_order('wallet_transaction', 'wt_category', $wallet_category, 'wt_user_id', $user_id,'wt_datetime');
			 }else if($wt_category=='9' ){
			 	//echo "string";
			 	$transaction = $this -> conn -> get_table_field_doubles_order('wallet_transaction', 'wt_category', $wt_category, 'wt_user_id', $user_id,'wt_datetime');
			 	}else if($wt_category=='10' ){
			 	//echo "string";
			 	$transaction = $this -> conn -> get_table_field_doubles_order('wallet_transaction', 'wt_category', $wt_category, 'wt_user_id', $user_id,'wt_datetime');
			 	}else if($wallet_category=='11'){
			 	
			 		$transaction=$this -> conn -> join_four_table('wallet_transaction','bill_recharge','biller_details','biller_user','transaction_id','bill_transaction_id','biller_id','biller_id','biller_customer_id_no','bill_consumer_no','wt_user_id',$user_id,'wt_datetime');
			 	
			 	}

			foreach ($transaction as $v) {
			$transaction_mobile_number = $v['recharge_number'];
			$cashback_mobile_number = $v['cashbackrecord_id'];
			$cashback_record =$cashback_mobile_number;
			$consumer_id = $v['bill_consumer_no'];
			$consumer_name = $v['biller_user_name'];
			$biller_company = $v['biller_company_name'];
		
			if(!empty($consumer_id)){
				$consumer_id=$consumer_id;
				$consumer_name=$consumer_name;
				$biller_company=$biller_company;
			}else{
				$consumer_id='';
				$consumer_name='';
				$biller_company='';
			}
			
			if(!empty($cashback_record)){
				$cashback_record=$cashback_record;
			}else{
				$cashback_record='';
			}
			$transaction_mobile_number = substr($transaction_mobile_number, 4);
			if(!empty($transaction_mobile_number)){
				$number=$transaction_mobile_number;
			}else{
				$number='';
			}
			if(!empty($v['operator_image'])){
					$operator_image = operator_img_url.$v['operator_image'];
			}else{
				$operator_image='';
			}
			$transaction_id = $v['transaction_id'];
			$operator_name= $v['operator_name'];
			$operator_id= $v['operator_id'];
			if(!empty($operator_id)){
				$operator_id=$operator_id;
			}else{
				$operator_id='';
			}
			if(!empty($operator_name)){
				$operator=$operator_name;
			}else{
				$operator='';
			}
			$card_no = $v['wt_card_no'];
			$recharge_category=$v['rechage_category'];
			if(!empty($recharge_category)){
				$recharge_category=$recharge_category;
			}else{
				$recharge_category='';
			}
			$transaction_amount = $v['wt_amount'];
			$transaction_date = $v['wt_datetime'];
			$transaction_type = $v['wt_category'];
			$transaction_type = $v['wt_category'];
			$transaction_status = $v['wt_status'];
			$transaction_desc = $v['wt_desc'];
			if($transaction_status=='1'){
				if($transaction_type=='1'){
					$transaction_desc="Amount has been added to your wallet";
				}
				else if($transaction_type=='2'){
					if($recharge_category=='1'){
						$transaction_desc="Mobile Recharge has been successfully done";
					}else if($recharge_category=='2'){
						$transaction_desc="TV,DTH Recharge has been successfully done";
					}else if($recharge_category=='3'){
						$transaction_desc="Data Card Recharge has been successfully done";
					}
				}else if($transaction_type=='3'){
					$transaction_desc="Recharge has been successfully done";
				}else if($transaction_type=='4'){
						$transaction_desc="Cashback is Recieved on Recharge of ".$cashback_record;
				}else if($transaction_type=='5'){
						$transaction_desc=$transaction_desc;
				}
			}else if($transaction_status=='2')
			{
					if($transaction_type=='1'){
					$transaction_desc="Transaction failed to Add amount in wallet";
				}
				else if($transaction_type=='2')
				{
					$transaction_desc="Transaction failed to Recharge";
				}
			}
$arr[]=array('wt_id'=>$v['wt_id'],'transction_date'=>$transaction_date,'mobile_number'=>$number,'transaction_number'=>$transaction_id,'operator_id'=>$operator_id,'operator_name'=>$operator,'recharge_amount'=>$transaction_amount,'transction_date'=>$transaction_date,'transaction_type'=>$transaction_type,'transaction_desc'=>$transaction_desc,'transaction_status'=>$transaction_status,'recharge_category'=>$recharge_category,'operaror_image'=>$operator_image,'cashback_recharge_number'=>$cashback_record,'consumer_no'=>$consumer_id,'consumer_name'=>$consumer_name,'biller_company'=>$biller_company);
 			}
				}
			
	arsort($arr);
			$arr2 = array_values($arr);
		
			if(!empty($arr2)){
				$post = array('status' => "true","transaction_details"=>$arr);
			}else{
				$post = array('status' => "false","message"=>'No Record Found');
			}
			
			
			}else{
				$post = array('status' => "false", "message" => "NO Transaction Record Found" ,'user_id' => $user_id);
			}
			}else{
			$post = array('status' => "false", "message" => "Missing parameter" ,'user_id' => $user_id);
		}
	echo $this -> json($post);
}
///Send OTP///
function send_otp(){
	$user_id=$_REQUEST['user_id'];
	$user_mobile=country_code.$_REQUEST['mb_number'];
	if(!empty($user_mobile)){
	$records_user = $this -> conn -> get_table_field_doubles('user','user_contact_no', $user_mobile, 'user_mobile_verify_status',1);
	if(empty($records_user)){
		$token = $this -> send_code($user_mobile);
		$data['user_contact_no']=$user_mobile;
		$data['user_verified_code']=$token;
			$update_toekn=$this -> conn -> updatetablebyid('user', 'user_id',$user_id, $data);
			$post = array('status' => "true", "message" => "OTP Send  to your Number" ,'user_mobile_no' => substr($user_mobile,4));
	}else{
			$post = array('status' => "false", "message" => "This Number are already registered",'user_mobile_no' => $user_mobile);
		}
	}else{
		$post = array('status' => "false", "message" => "Please Enter a Number with country Code",'user_mobile_no' => $user_mobile);
	}
		echo $this -> json($post);
}

///// Resend OTP//////
	function resend() {
		$mobile = country_code.$_POST['user_mobile_no'];
			if(!empty($mobile)){
			$records = $this -> conn -> get_table_row_byidvalue('user', 'user_contact_no', $mobile);
			$user_id = $records['0']['user_id'];
			$token = $this -> send_code($mobile);
			$data['user_verified_code']=$token;
			$update_toekn=$this -> conn -> updatetablebyid('user', 'user_id',$user_id, $data);
			$post = array("status" => "true", "message" => "OTP sent to the registered number", 'token' => $token, 'mobile' => $mobile);
			
		}else{
			$post = array('status' => "false", "message" => "Missing parameter" ,'user_mobile_no' => $mobile);
		}
		echo $this -> json($post);
	}
///// operator list- Idea, Airtrl, TV//////
	function operator_list() {
	
		$recharge_category_id = $_REQUEST['recharge_category_id'];
		if(!empty($recharge_category_id)){
		$category = $this -> conn -> get_table_field_doubles('operator_list', 'operator_status', 1, 'recharge_category_id', $recharge_category_id);
			
		foreach ($category as $key => $value) {

			$name = $value['operator_name'];
			$category_id = $value['operator_id'];
			$operator_image = operator_img_url.$value['operator_image'];
			$response[] = array('operator_id' => $category_id, 'operator_name' => $name,'operator_image'=>$operator_image);
		}
		
		if(!empty($response)){
			$post = array("status" => "true",'recharge_category_id'=>$recharge_category_id,"operator_list" => $response);
		}else{
			$post = array('status' => "false",'recharge_category_id'=>$recharge_category_id,"operator" => "No Record Found");
		}
		
			
		}else{
			$post = array('status' => "false","message" => "Missing parameter",'recharge_category_id'=>$recharge_category_id);
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
		if(!empty($response)){
			$post = array("status" => "true","message" => $response);
		}else{
			$post = array('status' => "false","message" => "No Record Found");
		}
		
		echo $this -> json($post);
	}
	///// recharge recharge_type 1-Top up, 2-Special//////
		function recharge_type() {
		$recharge_category_id = $_POST['recharge_category_id'];
		if(!empty($recharge_category_id)){
		$category = $this -> conn -> get_table_field_doubles('recharge_type', 'recharge_type_status', 1, 'recharge_category_id', $recharge_category_id);
		foreach ($category as $key => $value) {

			$name = $value['recharge_type'];
			$category_id = $value['recharge_type_id'];
			
			$response[] = array('recharge_type_id' => $category_id, 'recharge_type' => $name,'recharge_category_id'=>$recharge_category_id);
		}
		if(!empty($response)){
			$post = array("status" => "true",'recharge_category_id'=>$recharge_category_id,"message" => $response);
		}else{
			$post = array('status' => "false",'recharge_category_id'=>$recharge_category_id,"message" => "No Record Found");
		}
		
			
		}else{
			$post = array('status' => "false","message" => "Missing parameter",'recharge_category_id'=>$recharge_category_id);
		}
		echo $this -> json($post);
	}
		// add about us
		/// user feedback///
		function user_feedback(){
			$user_email=$_POST['user_email'];
			$user_name=$_POST['user_name'];
			$user_msg=$_POST['user_msg'];
			if(!empty($user_email) && !empty($user_msg) && !empty($user_name))
			{
				$insert = $this -> conn -> insertnewrecords('user_feedbacks','user_email, user_name,user_msg', '"' . $user_email . '","' . $user_name . '","' . $user_msg . '"');
				if(!empty($insert)){
					$post = array('status' => "true","message" => "Thanks for your feedback");
				}
			}
			else
			{
				$post = array('status' => "false","message" => "Missing parameter",'user_email'=>$user_email,'user_name'=>$user_name,'user_msg'=>$user_msg);
		}
			echo $this -> json($post);
		}
		
		function about_us() {
		$about = $this -> conn -> get_table_row_byidvalue('about_us', 'about_us_status', '1');
		$about_us_content  = html_entity_decode($about['0']['about_us_content']);
		$version  = $about['0']['version'];
	
		$text=str_ireplace('<p>','',$about_us_content);
		$text=str_ireplace('</p>','',$text);    
			$text=str_ireplace('<big>','',$text);  
			$text=str_ireplace('</big>','',$text);   
			$text=str_ireplace('<h2>','',$text);  
			$text=str_ireplace('</h2>','',$text);   
			$text=str_ireplace('<q>','',$text);  
			$text=str_ireplace('</q>','',$text);   
			$text=str_ireplace('<code>','',$text);  
			$text=str_ireplace('</code>','',$text);   
			$text=str_ireplace('<strong>','',$text);  
			$text=str_ireplace('</strong>','',$text);     
				  
			if(!empty($text))
			{
				$about_us_content=$text;
			}else{
					$about_us_content='';
			}
			$post = array('version'=>$version,"about_us" =>$about_us_content);
			echo $this -> json($post);
		}
		function privecy(){
		$privecy= $this -> conn -> get_all_records('privacy_policy');
		
		$privecy_us_content  = html_entity_decode($privecy['0']['privacy_policy_content']);
		$text=str_ireplace('<p>','',$privecy_us_content);
		$text=str_ireplace('</p>','',$text);  
			if(!empty($text))
			{
				$privecy_us_content=$text;
			}else{
				$privecy_us_content='';
			}
			
			$post = array("privecy_policy" =>$privecy_us_content);
			echo $this -> json($post);
		}
		function terms(){
		$terms= $this -> conn -> get_table_row_byidvalue('terms_conditions', 'terms_status', '1');
			//$terms_content  = $terms['0']['terms_content'];
			$terms_content  = html_entity_decode($terms['0']['terms_content']);
		$text=str_ireplace('<p>','',$terms_content);
		$text=str_ireplace('</p>','',$text);  
			//$terms_content  = $about['0']['terms_conditions'];
			if(!empty($text))
			{
				$terms_content=$text;
			}else{
					$terms_content='';
			}
			$post = array("terms" =>$terms_content);
			echo $this -> json($post);

	}
		function contact_us(){
		$contact_us= $this -> conn -> get_table_row_byidvalue('contact_us', 'contact_us_status', '1');
			$contact_name  = $contact_us['0']['contact_name'];
			$contact_email  = $contact_us['0']['contact_email'];
			$contact_number  = $contact_us['0']['contact_number'];
			$conatct_website  = $contact_us['0']['conatct_website'];
			//$terms_content  = $about['0']['terms_conditions'];
			if(!empty($contact_name))
			{
				$contact_name=$contact_name;
			}else{
					$contact_name='';
			}
			if(!empty($contact_email))
			{
				$contact_email=$contact_email;
			}else{
					$contact_email='';
			}
			if(!empty($contact_number))
			{
				$contact_number=$contact_number;
			}else{
					$contact_number='';
			}
			if(!empty($conatct_website))
			{
				$conatct_website=$conatct_website;
			}else{
					$conatct_website='';
			}
			$post = array("name" =>$contact_name,'email'=>$contact_email,'mobile'=>$contact_number,'website'=>$conatct_website);
			echo $this -> json($post);

	}
	////-------Add money from payment gateway-------------///
	function add_money(){
		$coupon_id=$_REQUEST['coupon_id'];
		$coupon_amount=$_REQUEST['coupon_amount'];
		$user_id=$_REQUEST['recharge_user_id'];
		$user_amount=$_REQUEST['recharge_amount'];
		$final_amount=$coupon_amount+$user_amount;
	//	$wt_type=$_POST['wt_type'];  //1- debit in account, 2- credit in account
		$wt_type=1; // credit
		$current_date=date("Y-m-d h:i:sa");
		$wt_category=1;  // 1-Add moeny, 2-Recharge
		$w_category=6;  // Amount Recieved when coupon code apply
		//$card_no=$_REQUEST['card_number'];
		//$cvv_no=$_REQUEST['cvv_no'];
		$w_desc="Amount Recieved when add money ".$user_amount ." with get amount ".$coupon_amount;
			$transaction_id= strtotime("now").mt_rand(10000000, 99999999);
		//$transaction_id =$_POST['recharge_transaction_id']; // if wt_category=1 then payment gateway transaction id and 2 for recharge id;
		$wt_desc="Add Money"; // description of transaction like as add moeny, recharge;
		if(!empty($user_id) && !empty($user_amount) && !empty($transaction_id)){
			$records = $this -> conn -> get_table_row_byidvalue('user', 'user_id', $user_id);
			$wallet_amount = $records['0']['wallet_amount'];
			$user_wallet=$wallet_amount + $final_amount;
					$add_money = $this -> conn -> insertnewrecords('wallet_transaction','wt_user_id, wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc', '"' . $user_id . '","' . $current_date . '","' . $wt_type . '","' . $user_amount . '","' . $wt_category . '","' . $transaction_id . '","' . $wt_desc . '"');
			if(!empty($add_money)){
				if(!empty($coupon_id)){
					
					$add_money = $this -> conn -> insertnewrecords('coupon_details','coupon_id, user_id,coupon_apply_date', '"' . $coupon_id . '","' . $user_id . '","' . $current_date . '"');
					if($add_money){
						$transaction_ids= strtotime("now").mt_rand(10000000, 99999999);
						$walletrecharge = $this -> conn -> insertnewrecords('wallet_transaction','wt_user_id,wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc,cashbackrecord_id', '"' . $user_id . '","' . $current_date . '","' . $wt_type . '","' . $coupon_amount . '","' . $w_category . '","' .$transaction_ids . '","' . $w_desc . '","' . $transaction_id . '"');
					}
				}
					 $data['wallet_amount']=$user_wallet;
					$update_toekn=$this -> conn -> updatetablebyid('user','user_id',$user_id, $data);
					$post = array("status" => "true",'message'=>"Add amount successfully", "transaction_id" =>$transaction_id,'add_amount'=>$user_amount,'wallet_amount'=>$user_wallet,'transaction_date'=>$current_date,'card_no'=>$card_no);
					
			}else{
				$post = array('status' => "false","message" => "Transaction Failed");
			}
		}else{
		$post = array('status' => "false","message" => "Missing parameter",'recharge_user_id'=>$user_id,'recharge_amount'=>$user_amount,'card_number'=>$card_no,'cvv_no'=>$cvv_no);
		}
		echo $this -> json($post);
	}
/// add quick contects///
function add_quick_contact(){
	$user_id=$_POST['user_id'];
	$contact_list=$_POST['user_contacts'];
	$contact_name=$_POST['user_name'];
	if(!empty($contact_list) && !empty($user_id)){
		for($i=0;$i<count($contact_list);$i++){
			$contact=$_POST['user_contacts'][$i];
			$contactname=$_POST['user_name'][$i];
			$add_contacts = $this -> conn -> insertnewrecords('quick_contacts','quick_contact_user_id, quick_contacts_name,quick_contacts_number', '"' . $user_id . '","' . $contactname . '","' . $contact . '"');
			if(!empty($add_contacts)){
				$posts[] = array("user_contacts"=>$_POST['user_contacts'][$i],"user_name"=>$_POST['user_name'][$i]);
			}else{
				$posts = array('status' => "false","message" => "Error in adding contacts");
			}
			
		}
$post=array('status'=>'true','quick_contacts'=>$posts);
	}else{
		$post = array('status' => "false","message" => "Missing parameter",'user_id'=>$user_id,'contacts'=>$contact_list);
	}
	echo $this -> json($post);
}


////function add quick contact list with profile pic////
function add_contact(){
	//$path = 'http://'.$_SERVER['HTTP_HOST'].'/uploads/contacts/';
	$user_id=$_POST['user_id'];
	$contact_number=country_code.$_POST['contcat_no'];
	$contact_name=$_POST['contact_name'];
	$mobile=$_POST['contcat_no'];;
	if(!empty($user_id) && !empty($contact_name) && !empty($contact_number)){
		$records_contact_no = $this -> conn -> get_table_field_doubles('quick_contacts', 'quick_contact_user_id', $user_id,'quick_contacts_number',$contact_number);
	if(empty($records_contact_no)){
	 $records = $this -> conn -> get_table_row_count('quick_contacts', 'quick_contact_user_id', $user_id);
	if($records <7){
	//$contact_number=$_POST['contcat_no'];
	//$contact_name=$_POST['contact_name'];
		$user_image = '';
		if($_FILES['user_image'])
		{
			$user_image = $_FILES['user_image']['name'];
		}
		$attachment = $_FILES['user_image']['name'];

		if (!empty($attachment)) {
			$file_extension = end(explode(".",$_FILES["user_image"]["name"]));
       		 $new_extension =strtolower($file_extension);
        	$today = time();
        	$custom_name = "user_img".$today;
        	$file_name = $custom_name.".".$new_extension;
			move_uploaded_file($_FILES['user_image']['tmp_name'], "../uploads/contacts/" . $file_name);

		}
			$user_contact_pic=$file_name;
			 $image=contact_img_url.$user_contact_pic;
			$add_contacts = $this -> conn -> insertnewrecords('quick_contacts','quick_contact_user_id, quick_contacts_name,quick_contacts_number,user_contact_pic', '"' . $user_id . '","' . $contact_name . '","' . $contact_number . '","' . $user_contact_pic . '"');
			if(!empty($add_contacts)){
				$posts = array('status' => 'true','user_id' =>$user_id,'contact_name'=>$contact_name,'contact_numer'=>$mobile,'user_image_url'=>$image);
			}else{
				$posts = array('status' => 'false','message' => 'Error in adding contacts');
			}
				
	
		 }else{
		 	$posts = array('status' => "false","message" => "7 Contacts are already exist");
		 }}else{
		 		$posts = array('status' => "false","message" => "These number are already exis");
		 }
		  }else{
		 	$posts = array('status' => "false","message" => "missing parameter",'user_id'=>$user_id,'contact_name'=>$contact_name,'contact_no'=>$contact_number);
		 }
 echo $this -> json($posts);
 }
///qyuick_contact_list


function quick_contact_list(){
	$user_id=$_POST['user_id'];
	if(!empty($user_id)){
		$records = $this -> conn -> get_table_row_byidvalue('quick_contacts', 'quick_contact_user_id', $user_id);
			if(!empty($records)){
				foreach ($records as $key => $value) {
		 $count_records = $this -> conn -> get_table_row_count('quick_contacts', 'quick_contact_user_id', $user_id);
					if(!empty($count_records)){
						$count_records=$count_records;
					}else{
						$count_records=0;
					}
					$contact_id = $value['quick_contacts_id'];
						$contact_name = $value['quick_contacts_name'];
						
						$pieces = explode(" ", $contact_name);
						 $pieces[0]; // piece1
						 $pieces[1]; // piece2
						     $firstCharacter = substr($pieces[0], 0, 1);
							$lasstCharacter = substr($pieces[1], 0, 1);
							$name=strtoupper($firstCharacter.$lasstCharacter);
							$contact_number = $value['quick_contacts_number'];
							$mobile=substr($value['quick_contacts_number'], 4);
								$contact_user_pic = $value['user_contact_pic'];
					$response[] = array('contact_id' => $contact_id, 'contact_name' => $contact_name,'contact_number'=>$mobile,'contact_user_pic'=>contact_img_url.$contact_user_pic,'name'=>$name,'first_name'=> $pieces[0]);
				}
				$post = array("status" => "true",'user_id'=>$user_id,"result" => $response,'user_count'=>$count_records);
			}else{
				$post = array('status' => "false","message" => "No Record Found",'user_id'=>$user_id);
			}
			
		}else{
		$post = array('status' => "false","message" => "Missing parameter",'user_id'=>$user_id);
	}
	echo $this -> json($post);
}
// Edit quick contact list///
function edit_quick_contact(){
		$user_id=$_REQUEST['user_id'];
		$contact_id = $_REQUEST['quick_contacts_id'];
			
		
		if(!empty($user_id)&& ($contact_id)){
			$records_contact_no = $this -> conn -> get_table_field_doubles('quick_contacts', 'quick_contact_user_id', $user_id,'quick_contacts_id',$contact_id);
			
			if(!empty($records_contact_no)){
				$name=$records_contact_no[0]['quick_contacts_name'] ;
				$mobile=$records_contact_no[0]['quick_contacts_number'];
				$pic=$records_contact_no[0]['user_contact_pic'];
			if($_FILES['user_image'])
		{
			$user_image = $_FILES['user_image']['name'];
		}
		$attachment = $_FILES['user_image']['name'];

		if (!empty($attachment)) {
			$file_extension = end(explode(".",$_FILES["user_image"]["name"]));
       		 $new_extension =strtolower($file_extension);
        	$today = time();
        	$custom_name = "user_img".$today;
        	$file_name = $custom_name.".".$new_extension;
			move_uploaded_file($_FILES['user_image']['tmp_name'], "../uploads/contacts/" . $file_name);
			$user_contact_pic=$file_name;
			 $image=contact_img_url.$user_contact_pic;
			 $data['user_contact_pic']=$user_contact_pic;
		}else{
			$image=contact_img_url.$pic;
		}
	
		 $contact_name=$_POST['contact_name'];
		if(!empty($contact_name)){
			$data['quick_contacts_name']=$contact_name;
			$name=$contact_name;
		}else{
			$name=$name;
		}
		$contact_number=$_POST['contcat_no'];
			if(!empty($contact_number)){
				$data['quick_contacts_number']=country_code.$contact_number;
				$number=$contact_number;
			}else{
				$number=substr($mobile, 4);;
			}
				$update_toekn=$this -> conn -> updatetablebyid('quick_contacts', 'quick_contacts_id',$contact_id, $data);
				$post = array('status' => "true","message" => "Quick contact update successfully",'user_id'=>$user_id,'quick_contact_id'=>$contact_id,'contact_name'=>$name,'contact_no'=>$number,'user_contact_pic'=>$image);
		}else{
			$post = array('status' => "false","message" => "Quick Contact not exist",'user_id'=>$user_id,'quick_contact_id'=>$contact_id);	
		}
			}else{
		$post = array('status' => "false","message" => "Missing parameter",'user_id'=>$user_id,'quick_contact_id'=>$contact_id);
	}
	echo $this -> json($post);
}
// Delete quick contact list//
function delete_quick_contact(){
	$user_id=$_REQUEST['user_id'];
	$contact_id = $_REQUEST['quick_contacts_id'];
	if(!empty($user_id)&& ($contact_id)){
			$records_contact_no = $this -> conn -> get_table_field_doubles('quick_contacts', 'quick_contact_user_id', $user_id,'quick_contacts_id',$contact_id);
			
			if(!empty($records_contact_no)){
				$name=$records_contact_no[0]['quick_contacts_name'] ;
				$mobile=$records_contact_no[0]['quick_contacts_number'];
				$pic=$records_contact_no[0]['user_contact_pic'];
				$delete=$this->conn->deletedataintablebytwocol('quick_contacts','quick_contact_user_id',$user_id,'quick_contacts_id',$contact_id);
				if(!empty($delete)){
					$post = array('status' => "true","message" => "Successfully delete",'user_id'=>$user_id,'quick_contact_id'=>$contact_id,'contact_no'=>$mobile,'contact_name'=>$name);
				}else{
					$post = array('status' => "false","message" => "error in deleting contact",'user_id'=>$user_id,'quick_contact_id'=>$contact_id);	
				}
					}else{
			$post = array('status' => "false","message" => "Quick Contact not exist",'user_id'=>$user_id,'quick_contact_id'=>$contact_id);	
			}
			}else{
		$post = array('status' => "false","message" => "Missing parameter",'user_id'=>$user_id,'quick_contact_id'=>$contact_id);
	}
	echo $this -> json($post);
		
}

	////
	function recharge(){
		 $coupon_id=$_REQUEST['coupon_id'];
	    $coupon_amount=$_REQUEST['coupon_amount'];
		$recharge_user_id = $_REQUEST['recharge_user_id']; 
		$wt_category = $_REQUEST['wt_category'];
			//$card_no=$_REQUEST['card_number'];
			//$cvv_no=$_REQUEST['cvv_no'];
			
			
			//$recharge_transaction_id=$_POST['recharge_transaction_id'];
			$recharge_category_id = $_REQUEST['recharge_category_id']; //1- Mobile,2-DTH
			$operator_id = $_REQUEST['operator_id'];
			//$recharge_type_id = $_POST['recharge_type_id'];// 1-Topup, 2-special
			 $recharge_number = country_code.$_REQUEST['recharge_number'];
			 $mobile_number=$_REQUEST['recharge_number'];
			$recharge_amount = $_REQUEST['recharge_amount'];
			$rec_number=$_REQUEST['recharge_number'];
			$wallet_type = 2; // 1- Credit, 2-Debit
			$recharge_status = 1;
			
			$wallet_category='4'; // 4- Cashback
			$current_date=date("Y-m-d h:i:sa");
			
			if($wt_category=='1'){
				$wt_desc='Add-Money'; 
			}else if($wt_category=='2'){
				$wt_desc='Recharge'; 
			}else if($wt_category=='3'){
				$wt_desc='Refund'; 
			}else if($wallet_category=='4'){
				$w_desc='Cashback'; 
			}
	
			
		if(!empty($recharge_user_id)  && !empty($operator_id)&&  !empty($recharge_number)&& !empty($recharge_amount))
		{
				$records = $this -> conn -> get_table_row_byidvalue('user', 'user_id', $recharge_user_id);
			
				$wallet_amount = $records['0']['wallet_amount'];
				$admin=$this->conn->get_all_records('admin');
				$admin_wallet = $admin['0']['admin_wallet'];
					$transaction_id= strtotime("now").mt_rand(10000000, 99999999);
					$reffer_status = $records['0']['reffer_amount_status'];
					$reffer_user_id = $records['0']['reffer_user_id'];
					$user_email = $records['0']['user_email'];
					$recharge_response='';
					//if($operator_id=='3'){
					 $recharge_status=$this->mobile_recharge_api($operator_id,$mobile_number,$recharge_amount);
					 if($operator_id=='3'){
					 	if($recharge_status=='100')
							{
								$recharge_response='1';
								
							}else{
								$recharge_response='2';
							}
					 }else{
					 	$iparr = split ("\,", $recharge_status); 
   					    $recharge_response=$iparr[0];
						$transaction_id=$iparr[1];
					 }
					  
  
					 
							
								
					//}
					
		if($recharge_response=='1'){
		if($wallet_amount>=$recharge_amount)
		{
			//$transaction_id='5454';
$recharge = $this -> conn -> insertnewrecords('wallet_transaction','wt_user_id, wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc', '"' . $recharge_user_id . '","' . $current_date . '","' . $wallet_type . '","' . $recharge_amount . '","' . $wt_category .'","'.$transaction_id. '","'.$wt_desc .'"');

				if($recharge){
					
					$walletrecharge = $this -> conn -> insertnewrecords('recharge','recharge_transaction_id,recharge_user_id, rechage_category,operator_id,rechage_type,recharge_number,recharge_amount,recharge_date,recharge_status','"'.$transaction_id . '","' . $recharge_user_id . '","' . $recharge_category_id . '","' . $operator_id . '","' . $recharge_type_id . '","' .$recharge_number. '","' . $recharge_amount . '","' . $current_date . '","' . $recharge_status . '"'); 
		
					//reffer amount when user first recharge then beifits add in frnd wallet
					if($reffer_status=='2'){
						$frnd_records = $this -> conn -> get_table_row_byidvalue('user', 'user_id', $reffer_user_id);
						
							$reffer_records = $this -> conn -> get_all_records('reffer_amount');
							$refferal_amount = $reffer_records[0]['reffer_amount'];
										$user11_id = $frnd_records['0']['user_id'];
										$reffer_code_database = $frnd_records['0']['user_refferal_code'];
											$wallet = $frnd_records['0']['wallet_amount'];
											$frnd_number = $frnd_records['0']['user_contact_no'];
											$current_date=date("Y-m-d h:i:sa");
											$transaction_id= strtotime("now").mt_rand(10000000, 99999999);
											$wt_type=2; // credit in frnd acconnt
											$refferamount=$refferal_amount; // reffer amount
											$wt_category=9; // refferal amount recieved in wallet
											$wt_desc="Refferal amount add in your wallet using by ".substr($mobile,4);
										
										
										$add_reffer_money = $this -> conn -> insertnewrecords('refferal_records','refferal_user_id,refferal_frnd_id,refferal_amount,refferal_date', '"' . $recharge_user_id . '","' . $user11_id . '","' . $refferamount . '","' . $current_date . '"');
										
											$add_money = $this -> conn -> insertnewrecords('wallet_transaction','wt_user_id, wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc,cashbackrecord_id', '"' . $user11_id . '","' . $current_date . '","' . $wt_type . '","' . $refferamount . '","' . $wt_category . '","' . $transaction_id . '","' . $wt_desc . '","' . $frnd_number . '"');
									
							// modify wallet of frnd using reffer code///
						$data_frnd['wallet_amount']=$wallet+$refferal_amount;
									$update_toekn=$this -> conn -> updatetablebyid('user', 'user_id',$user11_id, $data_frnd);
									
											
							// Cahnge user status when refeer amount add in frnd wallet
											$data12['reffer_amount_status']=1;
									$update_toekn=$this -> conn -> updatetablebyid('user', 'user_id',$recharge_user_id, $data12);
										
					}
					$cashback_record_id=$recharge_number;
					if(!empty($coupon_id)){
					
					$coupon_apply = $this -> conn -> insertnewrecords('coupon_details','coupon_id, user_id,coupon_apply_date', '"' . $coupon_id . '","' . $recharge_user_id . '","' . $current_date . '"');
						if(!empty($coupon_apply)){
								$transaction_id= strtotime("now").mt_rand(10000000, 99999999);
						
							$walletrecharge = $this -> conn -> insertnewrecords('wallet_transaction','wt_user_id,wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc,cashbackrecord_id', '"' . $recharge_user_id . '","' . $current_date . '","' . $wallet_type . '","' . $coupon_amount . '","' . $wallet_category . '","' .$transaction_id . '","' . $w_desc . '","' . $cashback_record_id . '"');
						}
					}
					$user_wallet=$wallet_amount-$recharge_amount+$coupon_amount;
					$data['wallet_amount']=$user_wallet;
					
					$update_toekn=$this -> conn -> updatetablebyid('user', 'user_id',$recharge_user_id, $data);
					// Admin wallet update
					$admin_update_wallet=$admin_wallet+$recharge_amount-$coupon_amount;
					$data_admin['admin_wallet']=$admin_update_wallet;
					$update_toekn=$this -> conn -> updatetablebyid('admin', 'admin_id',1, $data_admin);
					
					
					$post = array("status" => "true",'message'=>"Recharge Successfully", "recharge_id" => $recharge,'recharge_number'=>$rec_number,'recharge_amount'=>$recharge_amount,'wallet_amount'=>$user_wallet,'recharge_date'=>$current_date,'transaction_id'=>$transaction_id);
				$this ->offer_mail($recharge_user_id);
			
					
				}else{
						$post = array('status' => "false","message" => "Recharge failed");
				}
			}else{
				$pay_amount=$recharge_amount-$wallet_amount;
			$post = array('status' => "false","message" => "Not sufficent amount in  your wallet",'wallet_amount'=>$wallet_amount,'recharge_amount'=>$rec_number,'payble_amount'=>$pay_amount);
				echo $this -> json($post);
				exit();
				//$add=$this->add_money_recharge($recharge_user_id,$recharge_amount,$recharge_transaction_id);
				//$this->recharge();
			}
			 }else{
				 $post = array('status' => "false","message" => "Recharge failed");
			 }
		}
		else
		{
			$post = array('status' => "false","message" => "Missing parameter",'recharge_user_id'=>$recharge_user_id,'recharge_category_id'=>$recharge_category_id,'operator_id'=>$operator_id,'recharge_type_id'=>$recharge_type_id,'recharge_number'=>$recharge_number,'recharge_amount'=>$recharge_amount);
		}
		echo $this -> json($post);
	}
/// Recharge from wallet with card
function offer_mail($recharge_user_id){
	 $recharge_user_id=$recharge_user_id; 
	 $frnd_records = $this -> conn -> get_table_row_byidvalue('user', 'user_id', $recharge_user_id);
	 $user_name = $frnd_records['0']['user_name'];
	  $user_email = $frnd_records['0']['user_email'];
	//  $frnd_number = $frnd_records['0']['user_contact_no'];
	//	$offer_records = $this -> conn -> get_table_row_byidvalue('add_cart_offer', 'cart_user_id', 12);
	$offer_records = $this -> conn -> get_table_field_doubles('add_cart_offer', 'cart_user_id', $recharge_user_id,'cart_offer_status',2);

	if(!empty($offer_records)){

		foreach ($offer_records as  $value) {
			
		$coupon_id=$value['cart_offer_id'];
		$frnd_records = $this -> conn -> join_two_table('free_coupon_list','free_coupon_category','fee_coupon_category_id','free_coupon_category_id','free_coupon_id',$coupon_id);
	 //$transaction = $this->login_model->join_two_table('free_coupon_list','free_coupon_category', 'fee_coupon_category_id', 'free_coupon_category_id','free_coupon_id',$coupon_id); 


		 $free_coupon_id=$frnd_records['0']['free_coupon_id'];
		  $coupon_name=$frnd_records['0']['coupon_name'];
		 $coupon_discount=$frnd_records['0']['coupon_discount'];
		  $coupon_code=$frnd_records['0']['coupon_code'];
		  $coupon_expiry_date=$frnd_records['0']['coupon_expiry_date'];
		   $coupon_refference_url=$frnd_records['0']['refference_website'];
		    $coupon_image_url=coupon_logo.'/'.$frnd_records['0']['coupon_img'];
		  // $to='blm.ypsilon@gmail.com';
		  $to = $user_email;
					
        	 $subject = "Promotional offer code details";
         $path=mail_logo;
         	$message= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>Untitled Document</title></head>

<body bgcolor="#f1f1f1">
<table cellpadding="0" cellspacing="0" width="600" style="background:#fff; border:1px solid #cbcbcb; margin:0 auto; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
	<thead class="header">
    	<tr>
        	<td style="background:#FFFFFF; height:62px; width:100%; padding:5px; border-bottom:1px solid #DDD;" valign="middle">
            	<a href="#" style="margin-left:10px;"><img width="100" src="'.$path.'" alt="..."/></a>
                
            </td>
        </tr>
    </thead>
    <tbody style=" background:#FEFEFE; border-bottom:1px solid #ddd;">
    	<tr>
        	<td style="padding:10px 15px;">
            	<h1 style="margin-bottom:0px; color:#337d75;">RECHARGE </h1>
            	<p >Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since</p>';
             $message .=  '<p>Coupon name:<strong>' .$coupon_name;'</strong></p>';
              $message .=  '<p>Coupon Discount:<strong>'.$coupon_discount;'</strong></p></td></tr>';
			   $message .=  '<p>Coupon Code:<strong>' .$coupon_code;'</strong></p>';
              $message .=  '<p>Coupon Expiry Date:<strong>'.$coupon_expiry_date;'</strong></p></td></tr>';
			   $message .=  '<p>Refference Website:<strong>'.$coupon_refference_url;'</strong></p></td></tr>';
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
              // <td style="padding:15px 0px;background:#fff;border-bottom:3px solid #f9f9f9" colspan=""><p style="font-size:11px;color:#999;line-height:16px;margin:0;padding:0"><strong>Terms &amp; Conditions:</strong> Offer Highlights: Enjoy flat 15% discount on minimum billing of Rs. 350 at <a data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://www.dominos.co.in&amp;source=gmail&amp;ust=1465984931028000&amp;usg=AFQjCNHKk0HpqXE9TW5R1pA62PZ9rbGT2Q" target="_blank" rel="external" href="http://www.dominos.co.in">www.dominos.co.in</a> How to redeem this Offer: You will receive an coupon code via e-mail as soon as your transaction is successful. You need to apply the coupon code at the time of placing the order on <a data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://www.dominos.co.in&amp;source=gmail&amp;ust=1465984931028000&amp;usg=AFQjCNHKk0HpqXE9TW5R1pA62PZ9rbGT2Q" target="_blank" rel="external" href="http://www.dominos.co.in">www.dominos.co.in</a> Terms of this Offer: Offer not valid on Simply Veg, Simply Non Veg Pizzas, Pizza Mania Combos and Beverages. Only one Coupon Code is valid per transaction and cannot be clubbed with any other offer or promotion. Offer valid only on orders placed ONLINE. Offer valid till <span data-term="goog_1872809792" class="aBn" tabindex="0"><span class="aQJ">31st August, 2016</span></span>.</p></td>
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
		  	$headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;
          	$header = "From:blm.ypsilon@gmail.com \r\n";
         	$header .= "Cc:blm.ypsilon@gmail.com \r\n";
         	$header .= "MIME-Version: 1.0\r\n";
         	$header .= "Content-type: text/html\r\n";
         	$retval = mail ($to,$subject,$message,$header);
		 	$data_frnd['cart_offer_status']=1;
			$update_toekn=$this -> conn -> updatetablebyid('user', 'cart_offer_id',$coupon_id, $data_frnd);
	}
	
	 }
}
function recharge_from_wallet_with_card(){
			$coupon_id=$_REQUEST['coupon_id'];
			$coupon_amount=$_REQUEST['coupon_amount'];
			$recharge_user_id = $_REQUEST['recharge_user_id'];
			$card_no=$_REQUEST['card_number'];
			$cvv_no=$_REQUEST['cvv_no'];
			$transaction_id= strtotime("now").mt_rand(10000000, 99999999);
			//$recharge_transaction_id=$_POST['recharge_transaction_id'];
			$recharge_category_id = $_REQUEST['recharge_category_id']; //1- Mobile,2-DTH
			$operator_id = $_REQUEST['operator_id'];
			$rec_number=$_REQUEST['recharge_number'];
			$recharge_number = country_code.$_REQUEST['recharge_number'];
			 $mobile_number=$_REQUEST['recharge_number'];
			$recharge_amount = $_REQUEST['recharge_amount'];
			$wallet_type = 2; // 1- Credit, 2-Debit
			$recharge_status = 1;
			$wt_category='2';//  1-Add money,2-Recharge
			$wallet_category='4'; // 4- Cashback
			$current_date=date("Y-m-d h:i:sa");
				if(!empty($recharge_user_id)  && !empty($operator_id)&&  !empty($recharge_number)&& !empty($recharge_amount))
		{
				$records = $this -> conn -> get_table_row_byidvalue('user', 'user_id', $recharge_user_id);
				$wallet_amount = $records['0']['wallet_amount'];
				$wallet_used_amount = $records['0']['wallet_amount'];
				$reffer_status = $records['0']['reffer_amount_status'];
				$reffer_user_id = $records['0']['reffer_user_id'];
				$card_deduct_amount=$recharge_amount-$wallet_amount;
				
				$admin=$this->conn->get_all_records('admin');
				$admin_wallet = $admin['0']['admin_wallet'];
				$recharge_response='';
				//	if($operator_id=='3'){
					$recharge_status=$this->mobile_recharge_api($operator_id,$mobile_number,$recharge_amount);
							if($operator_id=='3'){
					 	if($recharge_status=='100')
							{
								$recharge_response='1';
								
							}else{
								$recharge_response='2';
							}
					 }else{
					 	$iparr = split ("\,", $recharge_status); 
   					    $recharge_response=$iparr[0];
						$transaction_id=$iparr[1];
					 }
								
					//}
					if($recharge_response=='1'){
			$recharge = $this -> conn -> insertnewrecords('wallet_transaction','wt_user_id, wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc,user_wallet_rec_amount,user_card_card_rec_amount', '"' . $recharge_user_id . '","' . $current_date . '","' . $wallet_type . '","' . $recharge_amount . '","' . $wt_category . '","' .$transaction_id . '","' . $wt_desc . '","' .$wallet_amount . '","' . $card_deduct_amount . '"');
						
				if($recharge){
					$walletrecharge = $this -> conn -> insertnewrecords('recharge','recharge_transaction_id,recharge_user_id, rechage_category,operator_id,rechage_type,recharge_number,recharge_amount,recharge_date,recharge_status','"'.$transaction_id . '","' . $recharge_user_id . '","' . $recharge_category_id . '","' . $operator_id . '","' . $recharge_type_id . '","' . $recharge_number . '","' . $recharge_amount . '","' . $current_date . '","' . $recharge_status . '"');
					
							//reffer amount when user first recharge then beifits add in frnd wallet
					if($reffer_status=='2'){
						$frnd_records = $this -> conn -> get_table_row_byidvalue('user', 'user_id', $reffer_user_id);
						
							$reffer_records = $this -> conn -> get_all_records('reffer_amount');
							$refferal_amount = $reffer_records[0]['reffer_amount'];
										$user11_id = $frnd_records['0']['user_id'];
										$reffer_code_database = $frnd_records['0']['user_refferal_code'];
											$wallet = $frnd_records['0']['wallet_amount'];
											$frnd_number = $frnd_records['0']['user_contact_no'];
											$current_date=date("Y-m-d h:i:sa");
											$transaction_id= strtotime("now").mt_rand(10000000, 99999999);
											$wt_type=2; // credit in frnd acconnt
											$refferamount=$refferal_amount; // reffer amount
											$wt_category=9; // refferal amount recieved in wallet
											$wt_desc="Refferal amount add in your wallet using by ".substr($mobile,4);
										
										
										$add_reffer_money = $this -> conn -> insertnewrecords('refferal_records','refferal_user_id,refferal_frnd_id,refferal_amount,refferal_date', '"' . $recharge_user_id . '","' . $user11_id . '","' . $refferamount . '","' . $current_date . '"');
										
											$add_money = $this -> conn -> insertnewrecords('wallet_transaction','wt_user_id, wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc,cashbackrecord_id', '"' . $user11_id . '","' . $current_date . '","' . $wt_type . '","' . $refferamount . '","' . $wt_category . '","' . $transaction_id . '","' . $wt_desc . '","' . $frnd_number . '"');
									
							// modify wallet of frnd using reffer code///
						$data_frnd['wallet_amount']=$wallet+$refferal_amount;
									$update_toekn=$this -> conn -> updatetablebyid('user', 'user_id',$user11_id, $data_frnd);
									
											
							// Cahnge user status when refeer amount add in frnd wallet
											$data12['reffer_amount_status']=1;
									$update_toekn=$this -> conn -> updatetablebyid('user', 'user_id',$recharge_user_id, $data12);
										
					}
					
					$cashback_record_id=$recharge_number;
				if(!empty($coupon_id)){
					
					$coupon_apply = $this -> conn -> insertnewrecords('coupon_details','coupon_id, user_id,coupon_apply_date', '"' . $coupon_id . '","' . $recharge_user_id . '","' . $current_date . '"');
						if(!empty($coupon_apply)){
							
							$walletrecharge = $this -> conn -> insertnewrecords('wallet_transaction','wt_user_id,wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc,cashbackrecord_id', '"' . $recharge_user_id . '","' . $current_date . '","' . $wallet_type . '","' . $coupon_amount . '","' . $wallet_category . '","' .$transaction_id . '","' . $w_desc . '","' . $cashback_record_id . '"');
					
					// wallet amont set zero 
					$wallet_amount=0;		
					$user_wallet=$wallet_amount+$coupon_amount;
					$data['wallet_amount']=$user_wallet;
					
					$update_toekn=$this -> conn -> updatetablebyid('user', 'user_id',$recharge_user_id, $data);
						}
				}else{
					$wallet_amount=0;		
					$user_wallet=$wallet_amount+$coupon_amount;
					$data['wallet_amount']=$user_wallet;
					
					$update_toekn=$this -> conn -> updatetablebyid('user', 'user_id',$recharge_user_id, $data);
				}
					// Admin wallet update
					$admin_update_wallet=$admin_wallet+$recharge_amount;
					$data_admin['admin_wallet']=$admin_update_wallet;
					$update_toekn=$this -> conn -> updatetablebyid('admin', 'admin_id',1, $data_admin);
					$post = array("status" => "true",'message'=>"Recharge Successfully", "recharge_id" => $recharge,'recharge_number'=>$rec_number,'recharge_amount'=>$recharge_amount,'wallet_used_amount'=>$wallet_used_amount,'card_used_amount'=>$card_deduct_amount,'wallet_amount'=>$wallet_amount,'recharge_date'=>$current_date,'transaction_id'=>$transaction_id,'MTN_recharge_status'=>$recharge_response);
					$this ->offer_mail($recharge_user_id);
					}else{
						$post = array('status' => "false","message" => "Recharge failed");
					}	}else{
						$post = array('status' => "false","message" => "Recharge failed");
				}
		
			
		}
		else
		{
			$post = array('status' => "false","message" => "Missing parameter",'recharge_user_id'=>$recharge_user_id,'recharge_category_id'=>$recharge_category_id,'operator_id'=>$operator_id,'recharge_type_id'=>$recharge_type_id,'recharge_number'=>$recharge_number,'recharge_amount'=>$recharge_amount);
		}
		echo $this -> json($post);
			
			
			
}



// Recharge from card///
		function recharge_from_card(){
			$coupon_id=$_REQUEST['coupon_id'];
			$coupon_amount=$_REQUEST['coupon_amount'];
			$recharge_user_id = $_REQUEST['recharge_user_id'];
			$card_no=$_REQUEST['card_number'];
			$cvv_no=$_REQUEST['cvv_no'];
			$transaction_id= strtotime("now").mt_rand(10000000, 99999999);
			//$recharge_transaction_id=$_POST['recharge_transaction_id'];
			$recharge_category_id = $_REQUEST['recharge_category_id']; //1- Mobile,2-DTH
			$operator_id = $_REQUEST['operator_id'];
			$rec_number=$_REQUEST['recharge_number'];
			$recharge_number = country_code.$_REQUEST['recharge_number'];
			 $mobile_number=$_REQUEST['recharge_number'];
			$recharge_amount = $_REQUEST['recharge_amount'];
			$wallet_type = 2; // 1- Credit, 2-Debit
			$recharge_status = 1;
			$wt_category='2';//  1-Add money,2-Recharge
			$wallet_category='4'; // 4- Cashback
			$current_date=date("Y-m-d h:i:sa");
			if($wt_category=='1'){
				$wt_desc='Add-Money'; 
			}else if($wt_category=='2'){
				$wt_desc='Recharge'; 
			}else if($wt_category=='3'){
				$wt_desc='Refund'; 
			}
			 if($wallet_category=='4'){
				$w_desc='Cashback'; 
			}
			
		if(!empty($recharge_user_id)  && !empty($operator_id)&&  !empty($recharge_number)&& !empty($recharge_amount))
		{
				$records = $this -> conn -> get_table_row_byidvalue('user', 'user_id', $recharge_user_id);
				$wallet_amount = $records['0']['wallet_amount'];
				$reffer_status = $records['0']['reffer_amount_status'];
				$reffer_user_id = $records['0']['reffer_user_id'];
				$admin=$this->conn->get_all_records('admin');
				$admin_wallet = $admin['0']['admin_wallet'];
				$recharge_response='';
				//	if($operator_id=='3'){
						$recharge_status=$this->mobile_recharge_api($operator_id,$mobile_number,$recharge_amount);
							if($operator_id=='3'){
					 	if($recharge_status=='100')
							{
								$recharge_response='1';
								
							}else{
								$recharge_response='2';
							}
					 }else{
					 	$iparr = split ("\,", $recharge_status); 
   					    $recharge_response=$iparr[0];
						$transaction_id=$iparr[1];
					 }
								
					//}
					if($recharge_response=='1'){
			$recharge = $this -> conn -> insertnewrecords('wallet_transaction','wt_user_id, wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc', '"' . $recharge_user_id . '","' . $current_date . '","' . $wallet_type . '","' . $recharge_amount . '","' . $wt_category . '","' .$transaction_id . '","' . $wt_desc . '"');
						
				if($recharge){
					$walletrecharge = $this -> conn -> insertnewrecords('recharge','recharge_transaction_id,recharge_user_id, rechage_category,operator_id,rechage_type,recharge_number,recharge_amount,recharge_date,recharge_status','"'.$transaction_id . '","' . $recharge_user_id . '","' . $recharge_category_id . '","' . $operator_id . '","' . $recharge_type_id . '","' . $recharge_number . '","' . $recharge_amount . '","' . $current_date . '","' . $recharge_status . '"');
					
								//reffer amount when user first recharge then beifits add in frnd wallet
					if($reffer_status=='2'){
						$frnd_records = $this -> conn -> get_table_row_byidvalue('user', 'user_id', $reffer_user_id);
						
							$reffer_records = $this -> conn -> get_all_records('reffer_amount');
							$refferal_amount = $reffer_records[0]['reffer_amount'];
										$user11_id = $frnd_records['0']['user_id'];
										$reffer_code_database = $frnd_records['0']['user_refferal_code'];
											$wallet = $frnd_records['0']['wallet_amount'];
											$frnd_number = $frnd_records['0']['user_contact_no'];
											$current_date=date("Y-m-d h:i:sa");
											$transaction_id= strtotime("now").mt_rand(10000000, 99999999);
											$wt_type=2; // credit in frnd acconnt
											$refferamount=$refferal_amount; // reffer amount
											$wt_category=9; // refferal amount recieved in wallet
											$wt_desc="Refferal amount add in your wallet using by ".substr($mobile,4);
										
										
										$add_reffer_money = $this -> conn -> insertnewrecords('refferal_records','refferal_user_id,refferal_frnd_id,refferal_amount,refferal_date', '"' . $recharge_user_id . '","' . $user11_id . '","' . $refferamount . '","' . $current_date . '"');
										
											$add_money = $this -> conn -> insertnewrecords('wallet_transaction','wt_user_id, wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc,cashbackrecord_id', '"' . $user11_id . '","' . $current_date . '","' . $wt_type . '","' . $refferamount . '","' . $wt_category . '","' . $transaction_id . '","' . $wt_desc . '","' . $frnd_number . '"');
									
							// modify wallet of frnd using reffer code///
							$data_frnd['wallet_amount']=$wallet+$refferal_amount;
									$update_toekn=$this -> conn -> updatetablebyid('user', 'user_id',$user11_id, $data_frnd);
									
											
							// Cahnge user status when refeer amount add in frnd wallet
											$data12['reffer_amount_status']=1;
									$update_toekn=$this -> conn -> updatetablebyid('user', 'user_id',$recharge_user_id, $data12);
										
					}
					
					$cashback_record_id=$recharge_number;
				if(!empty($coupon_id)){
					
					$coupon_apply = $this -> conn -> insertnewrecords('coupon_details','coupon_id, user_id,coupon_apply_date', '"' . $coupon_id . '","' . $recharge_user_id . '","' . $current_date . '"');
						if(!empty($coupon_apply)){
							
							$walletrecharge = $this -> conn -> insertnewrecords('wallet_transaction','wt_user_id,wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc,cashbackrecord_id', '"' . $recharge_user_id . '","' . $current_date . '","' . $wallet_type . '","' . $coupon_amount . '","' . $wallet_category . '","' .$transaction_id . '","' . $w_desc . '","' . $cashback_record_id . '"');
					$user_wallet=$wallet_amount+$coupon_amount;
					$data['wallet_amount']=$user_wallet;
					
					$update_toekn=$this -> conn -> updatetablebyid('user', 'user_id',$recharge_user_id, $data);
						}
				}
			
				
				
					// Admin wallet update
					$admin_update_wallet=$admin_wallet+$recharge_amount;
					$data_admin['admin_wallet']=$admin_update_wallet;
					$update_toekn=$this -> conn -> updatetablebyid('admin', 'admin_id',1, $data_admin);
					$post = array("status" => "true",'message'=>"Recharge Successfully", "recharge_id" => $recharge,'recharge_number'=>$rec_number,'recharge_amount'=>$recharge_amount,'wallet_amount'=>$wallet_amount,'recharge_date'=>$current_date,'transaction_id'=>$transaction_id,'MTN_recharge_status'=>$recharge_response);
					$this ->offer_mail($recharge_user_id);
				}else{
						$post = array('status' => "false","message" => "Recharge failed");
					}}else{
						$post = array('status' => "false","message" => "Recharge failed");
				}
		
			
		}
		else
		{
			$post = array('status' => "false","message" => "Missing parameter",'recharge_user_id'=>$recharge_user_id,'recharge_category_id'=>$recharge_category_id,'operator_id'=>$operator_id,'recharge_type_id'=>$recharge_type_id,'recharge_number'=>$recharge_number,'recharge_amount'=>$recharge_amount);
		}
		echo $this -> json($post);
}

	/// last recharge////
	
	function last_recharge(){
		$user_id=$_POST['user_id'];
		$recharge_category_id=$_POST['recharge_category_id'];
		if(!empty($user_id))
		{
				$records = $this -> conn -> get_table_field_doubles_orderby('recharge', 'recharge_user_id', $user_id,'rechage_category',$recharge_category_id,'recharge_id','recharge_number','3');
			if(!empty($records)){
					foreach ($records as  $value) {
					$recharge_id=	$value['recharge_id'];
					$rechage_category = $value['rechage_category']; //1-Mobile,2-DTH
				$operator_id = $value['operator_id'];
				$operator_records = $this -> conn -> get_table_row_byidvalue('operator_list', 'operator_id', $operator_id);
				$operator_name = $operator_records['0']['operator_name'];
				$operator_image = operator_img_url.$operator_records['0']['operator_image'];
				$rechage_type = $value['rechage_type']; //1-Topup, 2-Special
				$recharge_number = $value['recharge_number']; 
				$rec_num=substr($recharge_number, 4);
				if(!empty($rec_num)){
					$rec_num=$rec_num;
				}else{
					$rec_num='';
				}
				$recharge_amount = $value['recharge_amount'];
				$recharge_status = $value['recharge_status'];
					$arr[]=array('user_id'=>$user_id,'recharge_id'=>$recharge_id,'rechage_category'=>$rechage_category,'operator_id'=>$operator_id,'rechage_type'=>$rechage_type,'recharge_number'=>$rec_num,'recharge_amount'=>$recharge_amount,'recharge_status'=>$recharge_status,'operator_name'=>$operator_name,'operator_image'=>$operator_image);
					}

				$post = array('status' => "true","Last Recharge"=>$arr);
		
}else{
	$post = array('status' => "false","message" => "No Recharge found",'user_id'=>$user_id);
}}else{
			$post = array('status' => "false","message" => "Missing parameter",'user_id'=>$user_id);
		}
		echo $this -> json($post);
	}
	// Apply promocode//
	function apply_promocode(){
		$code=$_REQUEST['promo_code'];
		$user_id=$_REQUEST['user_id'];
		$records_coupon = $this -> conn -> get_table_field_doubles('offer_coupon', 'coupon_code', $code	, 'coupon_status', 1);
		if(!empty($records_coupon)){
			$amount=$records_coupon['0']['coupon_price'];
			$amount_price=$records_coupon['0']['coupon_minimum_price'];
			$coupon_id=$records_coupon['0']['coupon_id'];
			$coupon_code=$records_coupon['0']['coupon_code'];
			$coupon_expire_date=$records_coupon['0']['coupon_expire_date'];
			$current_date=date("Y-m-d");
			
			if (strcmp($coupon_code, $code) == 0) {
				if($coupon_expire_date>=$current_date){
			$user_record=$this -> conn -> get_table_field_doubles('coupon_details', 'coupon_id', $coupon_id, 'user_id',$user_id);
			if(!empty($user_record)){
				$post = array('status' => "false","message" => "This promocode is already used by you");
			}else{
				$post = array('status' => "true","message" => "Promocode Applied successfully",'coupon_id'=>$coupon_id,'coupon_amount'=>$amount,'amount_price'=>$amount_price);
			}
			
		}else{
			$post = array('status' => "false","message" => "Invalid promocode");
		}}else{
			$post = array('status' => "false","message" => "Invalid promocode");
		}}else{
			$post = array('status' => "false","message" => "Invalid promocode");
		}
		echo $this -> json($post);
	}
	/// get operator name//
	function get_operator_name(){
		$operator_id=$_REQUEST['operator_id'];
		if(!empty($operator_id)){
			$records = $this -> conn -> get_table_row_byidvalue('operator_list', 'operator_id', $operator_id);
			$operator_name=$records['0']['operator_name'];
			$post=array('status'=>'true','operator_name'=>$operator_name);
		}
echo $this -> json($post);
	}
	//// Share money from your wallet to another user////
	
	function transfer_money(){
		$user_id=$_REQUEST['user_id'];
		$mobile=country_code.$_REQUEST['mobile_no'];
		$amount=$_REQUEST['amount'];
		$mobile_no=$_REQUEST['mobile_no'];
	 
		
		//$transaction_id= mt_rand( 10000000, 99999999);
		$wallet_type_main=2;// amount debit in user self
		$wallet_type_frnd=1;// amount credit in frnd
		$wallet_category_to=5;// transfer money to
		$wallet_category_from=10;// transfer money from
		$current_date=date("Y-m-d h:i:sa");
		if(!empty($mobile)){
			$user_records = $this -> conn -> get_table_row_byidvalue('user', 'user_id', $user_id);
			if(!empty($user_records)){
			$main_wallet=$user_records['0']['wallet_amount'];
			$contact_number_main=substr($user_records['0']['user_contact_no'],4); // main user mobile number
			if($main_wallet>=$amount){
				$records = $this -> conn -> get_table_row_byidvalue('user', 'user_contact_no', $mobile);
				if(!empty($records)){
				$contact_number_frnd=substr($records['0']['user_contact_no'],4); // frnd mobile number
				$frnd_wallet=$records['0']['wallet_amount']; 
				$frnd_id=$records['0']['user_id'];
				if($frnd_id !=$user_id){
					// amount transfer to another
			$transaction_id1= strtotime("now").mt_rand(10000000, 99999999);
					$w_to_desc="Amount transfer to ".$contact_number_frnd;
						$wallet_to_transfer = $this -> conn -> insertnewrecords('wallet_transaction','wt_user_id,wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc,cashbackrecord_id', '"' . $user_id . '","' . $current_date . '","' . $wallet_type_main . '","' . $amount . '","' . $wallet_category_to . '","' .$transaction_id1 . '","' . $w_to_desc . '","' . $contact_number_frnd . '"');
						if(!empty($wallet_to_transfer)){
							//amount recieved by transfer
						$transaction_id= strtotime("now").mt_rand(10000000, 99999999);
					$w_by_desc="Amount transfer from ".$contact_number_main;
						$wallet_by_transfer = $this -> conn -> insertnewrecords('wallet_transaction','wt_user_id,wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc,cashbackrecord_id', '"' . $frnd_id . '","' . $current_date . '","' . $wallet_type_main . '","' . $amount . '","' . $wallet_category_from . '","' .$transaction_id . '","' . $w_by_desc . '","' . $contact_number_main . '"');
						}
						if(!empty($wallet_by_transfer)){
								$main_wallet_money=$main_wallet-$amount;
								$frnd_wallet_money=$frnd_wallet+$amount;
								// update main user wallet
								$data['wallet_amount']=$main_wallet_money;
								$update_toekn=$this -> conn -> updatetablebyid('user', 'user_id',$user_id, $data);
								// update frnd wallet//
								$data1['wallet_amount']=$frnd_wallet_money;
								$update_toekn=$this -> conn -> updatetablebyid('user', 'user_id',$frnd_id, $data1);
									$post=array('status'=>'true','message'=>'Transfer money successfully','main_user_id'=>$user_id,'main_wallet'=>$main_wallet_money,'frnd_wallet'=>$frnd_wallet_money,'frnd_id'=>$frnd_id,'transfer_mobile'=>$mobile_no,'transfer_amount'=>$amount,'transaction_id'=>$transaction_id1,'transfer_date'=>$current_date);
						}else{
							$post = array('status' => "false","message" => "Error in transfering amount");
						}
			
				}else{
					$post = array('status' => "false","message" => "Please enter another user number");
				}
				}else{
					$post = array('status' => "false","message" => "This user is not exist of given number");
				}
				
			}else{
				$post = array('status' => "false","message" => "Wallet amount is not sufficent to transfer money");
			}
			}else{
			$post = array('status' => "false","message" => "invalid user",'user_id'=>$user_id);
		}
			
		}else{
			$post = array('status' => "false","message" => "missing parameter",'user_id'=>$user_id,'amount'=>$amount,'mobile'=>$moble);
		}
echo $this -> json($post);
	}

// .............Save pin..............///

function save_pin(){
	$pin=$_REQUEST['user_transfer_pin'];
	$user_id=$_REQUEST['user_id'];
		if(!empty($user_id)&& ($pin)){
			$records = $this -> conn -> get_table_row_byidvalue('save_pin', 'user_id', $user_id);
			if(!empty($records)){
				$records_contact_no = $this -> conn -> get_table_field_doubles('save_pin', 'user_id', $user_id,'user_transfer_pin',$pin);
				if(!empty($records_contact_no)){
					$transfer_pin=$records_contact_no[0]['user_transfer_pin'];
					$post = array('status' => "true",'user_id'=>$user_id,'user_transfer_pin'=>$transfer_pin);
				}else{
					$post = array('status' => "false",'message'=>'Please Enter a valid pin');
				}
			}else{
					$add_pin = $this -> conn -> insertnewrecords('save_pin','user_id, user_transfer_pin', '"' . $user_id . '","' . $pin . '"');
					if(!empty($add_pin)){
						$data['user_pin_status']='1';
						$update_toekn=$this -> conn -> updatetablebyid('user', 'user_id',$user_id, $data);
						$post = array('status' => "true",'user_id'=>$user_id,'user_transfer_pin'=>$pin);
					}
			}
			
			}else{
		$post = array('status' => "false","message" => "Missing parameter",'user_id'=>$user_id,'transfer_pin'=>$pin);
}
    echo $this -> json($post);
}


// Add sms////
function add_sms(){
	$user_id=$_REQUEST['user_id'];
	$sms_amount=$_REQUEST['sms_amount'];
	if(!empty($user_id)&& !empty($sms_amount)){
	$sms_status='1';  // 1- sms add success
	$sms_records = $this -> conn -> get_table_row_byidvalue('sms_plans','sms_plan_amount',$sms_amount);
		
	if(!empty($sms_records)){
		$sms=$sms_records['0']['sms'];
		$current_date=date("Y-m-d h:i:sa");
	$wallet_category=7;// add sms
	$wallet_type=2; // amount debit from wallet when u purches sms
	$user_records = $this -> conn -> get_table_row_byidvalue('user', 'user_id', $user_id);
			if(!empty($user_records)){
			$main_wallet=$user_records['0']['wallet_amount'];
			$total_sms=$user_records['0']['total_sms'];
			$get_sms=$user_records['0']['get_sms'];
			$transaction_id= strtotime("now").mt_rand(10000000, 99999999);
					$w_to_desc=$sms." SMS added successfully";
					if($main_wallet>=$sms_amount){
						$wallet_sms = $this -> conn -> insertnewrecords('wallet_transaction','wt_user_id,wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc', '"' . $user_id . '","' . $current_date . '","' . $wallet_type . '","' . $sms_amount . '","' . $wallet_category . '","' .$transaction_id . '","' . $w_to_desc . '"');
						if(!empty($wallet_sms)){
							
								$data1['wallet_amount']=$main_wallet-$sms_amount;
								$data1['total_sms']=$total_sms+$sms; // my totol sms get or transfer
								$data1['get_sms']=$get_sms+$sms;  // total sms get only sms purches or share by another
								$update_sms=$this -> conn -> updatetablebyid('user', 'user_id',$user_id, $data1);
								$post = array('status' => "true","message" => "SMS Added successfully",'user_id'=>$user_id,'sms_add'=>$sms,'remaining_sms'=>$data1['total_sms'],'total_sms'=>$data1['get_sms'],'wallet_amount'=>$data1['wallet_amount']);
							
						}
						else{
							$post = array('status' => "false","message" => "error in adding sms in your sms wallet");
						
						}
						}else{
							$post = array('status' => "false","message" => "Wallet amount is not sufficent to transfer money");
							
						}
			}
	}
	}else{
		$post = array('status' => "false","message" => "missing parameter",'user_id'=>$user_id,'sms_amount'=>$sms_amount);
	}
		echo $this -> json($post);
}

// sms plan//////
function sms_plan(){
		$sms_records = $this -> conn -> get_table_row_byidvalue('sms_plans', 'sms_status',1);
		foreach ($sms_records as  $v) {
					$sms_id = $v['sms_plan_id'];	
					$sms_plan_amount = $v['sms_plan_amount'];
					$sms = $v['sms'];
					
					$arr[]=array('sms_id'=>$sms_id,'sms_plan_amount'=>$sms_plan_amount,'sms'=>$sms,'message'=>"You will get ".$sms ." SMS in this plan");
					
				}
			$post = array('status' => "true","sms_details"=>$arr);
			echo $this -> json($post);
}
// share money////

function share_sms(){
		$user_id=$_REQUEST['user_id'];
		$mobile=country_code.$_REQUEST['mobile_no'];
	$share_sms=$_REQUEST['share_sms'];
	$mobile_no=$_REQUEST['mobile_no'];
	 
		
		//$transaction_id= mt_rand( 10000000, 99999999);
		$wallet_type_main=2;// amount debit in user self
		$wallet_type_frnd=1;// amount credit in frnd
		$wallet_category=8;// share sms
		
		$current_date=date("Y-m-d h:i:sa");
		if(!empty($mobile)){
			$user_records = $this -> conn -> get_table_row_byidvalue('user', 'user_id', $user_id);
			if(!empty($user_records)){
			$total_sms=$user_records['0']['total_sms'];
			$contact_number_main=substr($user_records['0']['user_contact_no'],4); // main user mobile number
			if($total_sms>=$share_sms){
				$records = $this -> conn -> get_table_row_byidvalue('user', 'user_contact_no', $mobile);
				if(!empty($records)){
				$contact_number_frnd=substr($records['0']['user_contact_no'],4); // frnd mobile number
				$frnd_sms=$records['0']['total_sms']; 
				$frnd_get_sms=$records['0']['get_sms']; 
				$frnd_id=$records['0']['user_id'];
				if($frnd_id !=$user_id){
					// amount transfer to another
			$transaction_id= strtotime("now").mt_rand(10000000, 99999999);
					$w_to_desc="SMS share to ".$contact_number_frnd;
						$wallet_to_transfer = $this -> conn -> insertnewrecords('wallet_transaction','wt_user_id,wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc,cashbackrecord_id', '"' . $user_id . '","' . $current_date . '","' . $wallet_type_main . '","' . $share_sms . '","' . $wallet_category . '","' .$transaction_id . '","' . $w_to_desc . '","' . $contact_number_frnd . '"');
						if(!empty($wallet_to_transfer)){
							//amount recieved by transfer
						$transaction_id= strtotime("now").mt_rand(10000000, 99999999);
					$w_by_desc="SMS share from ".$contact_number_main;
						$wallet_by_transfer = $this -> conn -> insertnewrecords('wallet_transaction','wt_user_id,wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc,cashbackrecord_id', '"' . $frnd_id . '","' . $current_date . '","' . $wallet_type_main . '","' . $share_sms . '","' . $wallet_category . '","' .$transaction_id . '","' . $w_by_desc . '","' . $contact_number_main . '"');
						}
						if(!empty($wallet_by_transfer)){
								$main_sms=$total_sms-$share_sms;
								$frnd_sms=$frnd_sms;
								// update main user wallet
								$data['total_sms']=$main_sms;
								
								$update_toekn=$this -> conn -> updatetablebyid('user', 'user_id',$user_id, $data);
								// update frnd wallet//
								$data1['total_sms']=$frnd_sms+$share_sms;
								$data1['get_sms']=$frnd_get_sms+$share_sms;
								$update_toekn=$this -> conn -> updatetablebyid('user', 'user_id',$frnd_id, $data1);
									$post=array('status'=>'true','message'=>'SMS share successfully','main_user_id'=>$user_id,'main_user_sms'=>$main_sms,'frnd_sms'=>$frnd_sms,'frnd_id'=>$frnd_id);
						}else{
							$post = array('status' => "false","message" => "Error in shareing sms");
						}
			
				}else{
					$post = array('status' => "false","message" => "Please enter another user number");
				}
				}else{
					$post = array('status' => "false","message" => "This user is not exist of given number");
				}
				
			}else{
				$post = array('status' => "false","message" => "Sms amount is not sufficent to share sms");
			}
			}else{
			$post = array('status' => "false","message" => "invalid user",'user_id'=>$user_id);
		}
			
		}else{
			$post = array('status' => "false","message" => "missing parameter",'user_id'=>$user_id,'amount'=>$share_sms,'mobile'=>$moble);
		}
echo $this -> json($post);
	}
/// function of show  list of biller category////////
function biller_category(){
	$records = $this -> conn -> get_table_row_byidvalue('biller_category', 'biller_category_status', 1);
	if(!empty($records))
     {
     	foreach ($records as  $v)
		 {
		 	$biller_category_id=$v['biller_category_id'];
			$biller_category_name=$v['biller_category_name']; // frnd mobile number
			$biller_category_logo=biller_category_logo.$v['biller_category_logo']; 
			$posts[] = array('biller_category_id'=>$biller_category_id,"biller_category_name" => $biller_category_name,'biller_category_logo'=>$biller_category_logo);
	 	}
		 $post=array('status'=>'true','biller_category'=>$posts);
	 }else{
	 	$post = array('status' => "false","message" => "Coming soon");
	 }
	 echo $this -> json($post);
}
//// function to given biller from category according/////
function bill_service_provider(){
	$biller_category=$_REQUEST['biller_category'];
	if(!empty($biller_category))
	{
		$records = $this -> conn -> get_table_row_byidvalue('biller_details', 'biller_category_id', $biller_category);
		
		if($records){
			foreach ($records as  $v)
		 {
		 
			$biller_id=$v['biller_id']; 
			$biller_name=$v['biller_name']; 
			$biller_contact_no=$v['biller_contact_no']; 
			$biller_email=$v['biller_email']; 
			$biller_company_name=$v['biller_company_name']; 
			$biller_company_logo=biller_company_logo.$v['biller_company_logo']; 
			
			$post1[] = array('biller_id'=>$biller_id,"biller_name" => $biller_name,'biller_contact_no'=>$biller_contact_no,"biller_email" => $biller_email,'biller_company_name'=>$biller_company_name,'company'=>(string)$biller_company_name,"biller_company_logo" => $biller_company_logo,'biller_category_id'=>$biller_category);
		 }
		 $post = array('status' => "true","service_provider" => $post1);
		}else{
			$post = array('status' => "false","message" => "No Service Provider Found");
		}
	}else{
			$post = array('status' => "false","message" => "Missing Parameter",'biller_category_id'=>$biller_category);
	}
	echo $this -> json($post);
}
///  function to check consumer of bill///

function get_consumer_details(){
	$consumer_no=$_REQUEST['consumer_no'];
	$biller_id=$_REQUEST['biller_id'];
	if(!empty($consumer_no) && !empty($biller_id)){
		$biller_in_id='biller_user.biller_customer_id_no';
	$records_consumer = $this -> conn -> join_two_table_where_two_field('biller_user','biller_details','biller_id','biller_id',$biller_in_id,$consumer_no,'biller_user.biller_id',$biller_id);

		if(!empty($records_consumer)){
			$biller_id=$records_consumer[0]['biller_id'];
			$biller_company=$records_consumer[0]['biller_company_name'];
			$biller_company_logo=biller_company_logo.$records_consumer[0]['biller_company_logo'];
			$biller_user_name=$records_consumer[0]['biller_user_name'];
			$biller_customer_id=$records_consumer[0]['biller_customer_id_no'];
			$bill_amount=$records_consumer[0]['bill_amount'];
			 $bill_due_date=$records_consumer[0]['bill_due_date'];
			$biller_user_email=$records_consumer[0]['biller_user_email'];
			$biller_user_contact_no=$records_consumer[0]['biller_user_contact_no'];
			$bill_pay_status=$records_consumer[0]['bill_pay_status'];
			$current_date=date("Y-m-d");
			if($bill_due_date>=$current_date){
			  if($bill_pay_status=='1'){
					$post = array('status' => "false","message" => "Bill already paid");
			  }else{
			  $post=array('status'=>'true',"biller_id"=>$biller_id,'biller_company'=>$biller_company,'biller_logo'=>$biller_company_logo,'consumer_name'=>$biller_user_name,'consumer_id'=>$biller_customer_id,'bill_amount'=>$bill_amount,'due_date'=>$bill_due_date,'consumer_email'=>$biller_user_email,'consumer_contact_no'=>$biller_user_contact_no,'bill_pay_status'=>$bill_pay_status);
		 } }else{
		 	$post = array('status' => "false","message" => "Bill Paid date is expired");
		 }
		}else{
			$post = array('status' => "false","message" => "No Bill Found from this consumer no");
		}
	}else{
		$post = array('status' => "false","message" => "Missing Parameter",'consumer_no'=>$consumer_no,'biller_id'=>$biller_id);
	}
	echo $this -> json($post);
	
}

/// bill recharge function //////

function bill_recharge(){
		 $coupon_id=$_REQUEST['coupon_id'];
	    $coupon_amount=$_REQUEST['coupon_amount'];
		$recharge_user_id = $_REQUEST['recharge_user_id'];
		$wt_category = $_REQUEST['wt_category']; // wt_category = 11 pay bill
			$bill_category_id = $_REQUEST['bill_category_id']; // 1- Water, 2- Movies etc
			$biller_id = $_REQUEST['biller_id'];
			$bill_amount = $_REQUEST['bill_amount'];
			$bill_consumer_no=$_REQUEST['bill_consumer_no'];
			$wallet_type = 2; // 1- Credit, 2-Debit
			$bill_pay_status = 1;
			
			$wallet_category='4'; // 4- Cashback
			$current_date=date("Y-m-d h:i:sa");
			
			if($wt_category=='11'){
				$wt_desc='PaY Bill'; 
			}
	
			
		if(!empty($bill_consumer_no)  && !empty($biller_id)&&  !empty($bill_amount)&& !empty($recharge_user_id))
		{
			//$bill_records = $this -> conn -> get_table_row_byidvalue('biller_user', 'biller_customer_id_no',$bill_consumer_no);
			$bill_records = $this -> conn -> get_table_field_doubles('biller_user', 'biller_customer_id_no', $bill_consumer_no,'biller_id',$biller_id);
			if(!empty($bill_records)){
				$bill_user_id = $bill_records['0']['biller_user_id'];
				$bill_pay_status = $bill_records['0']['bill_pay_status'];
				if($bill_pay_status=='2'){
				
				$records = $this -> conn -> get_table_row_byidvalue('user', 'user_id', $recharge_user_id);
				$wallet_amount = $records['0']['wallet_amount'];
				$admin=$this->conn->get_all_records('admin');
				$admin_wallet = $admin['0']['admin_wallet'];
					$transaction_id= strtotime("now").mt_rand(10000000, 99999999);
					$reffer_status = $records['0']['reffer_amount_status'];
					$reffer_user_id = $records['0']['reffer_user_id'];
		if($wallet_amount>=$bill_amount)
		{
			//$transaction_id='5454';
$recharge = $this -> conn -> insertnewrecords('wallet_transaction','wt_user_id, wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc', '"' . $recharge_user_id . '","' . $current_date . '","' . $wallet_type . '","' . $bill_amount . '","' . $wt_category .'","'.$transaction_id. '","'.$wt_desc .'"');

				if($recharge){
					
					$walletrecharge = $this -> conn -> insertnewrecords('bill_recharge','bill_user_id,bill_transaction_id,bill_category_id, biller_id,bill_consumer_no,bill_amount,bill_pay_date,bill_pay_status','"'.$recharge_user_id . '","'.$transaction_id . '","' . $bill_category_id . '","' . $biller_id . '","' . $bill_consumer_no . '","' . $bill_amount . '","' .$current_date. '","' . $bill_pay_status . '"'); 
		
		// change status of bill///
		if(!empty($walletrecharge)){
			
			
					$data_frnd['bill_pay_status']=1;
					$update_toekn=$this -> conn -> updatetablebyid('biller_user', 'biller_user_id',$bill_user_id, $data_frnd);
			
		}
		
					//reffer amount when user first recharge then beifits add in frnd wallet
					if($reffer_status=='2'){
						$frnd_records = $this -> conn -> get_table_row_byidvalue('user', 'user_id', $reffer_user_id);
						
							$reffer_records = $this -> conn -> get_all_records('reffer_amount');
							$refferal_amount = $reffer_records[0]['reffer_amount'];
										$user11_id = $frnd_records['0']['user_id'];
										$reffer_code_database = $frnd_records['0']['user_refferal_code'];
											$wallet = $frnd_records['0']['wallet_amount'];
											$frnd_number = $frnd_records['0']['user_contact_no'];
											$current_date=date("Y-m-d h:i:sa");
											$transaction_id= strtotime("now").mt_rand(10000000, 99999999);
											$wt_type=2; // credit in frnd acconnt
											$refferamount=$refferal_amount; // reffer amount
											$wt_category=9; // refferal amount recieved in wallet
											$wt_desc="Refferal amount add in your wallet using by ".substr($mobile,4);
										
										
										$add_reffer_money = $this -> conn -> insertnewrecords('refferal_records','refferal_user_id,refferal_frnd_id,refferal_amount,refferal_date', '"' . $recharge_user_id . '","' . $user11_id . '","' . $refferamount . '","' . $current_date . '"');
										
											$add_money = $this -> conn -> insertnewrecords('wallet_transaction','wt_user_id, wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc,cashbackrecord_id', '"' . $user11_id . '","' . $current_date . '","' . $wt_type . '","' . $refferamount . '","' . $wt_category . '","' . $transaction_id . '","' . $wt_desc . '","' . $frnd_number . '"');
									
							// modify wallet of frnd using reffer code///
						$data_frnd['wallet_amount']=$wallet+$refferal_amount;
									$update_toekn=$this -> conn -> updatetablebyid('user', 'user_id',$user11_id, $data_frnd);
									
											
							// Cahnge user status when refeer amount add in frnd wallet
											$data12['reffer_amount_status']=1;
									$update_toekn=$this -> conn -> updatetablebyid('user', 'user_id',$recharge_user_id, $data12);
										
					}
					$cashback_record_id=$recharge_number;
					if(!empty($coupon_id)){
					
					$coupon_apply = $this -> conn -> insertnewrecords('coupon_details','coupon_id, user_id,coupon_apply_date', '"' . $coupon_id . '","' . $recharge_user_id . '","' . $current_date . '"');
						if(!empty($coupon_apply)){
								$transaction_id= strtotime("now").mt_rand(10000000, 99999999);
						
							$walletrecharge = $this -> conn -> insertnewrecords('wallet_transaction','wt_user_id,wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc,cashbackrecord_id', '"' . $recharge_user_id . '","' . $current_date . '","' . $wallet_type . '","' . $coupon_amount . '","' . $wallet_category . '","' .$transaction_id . '","' . $w_desc . '","' . $cashback_record_id . '"');
						}
					}
					$user_wallet=$wallet_amount-$bill_amount+$coupon_amount;
					$data['wallet_amount']=$user_wallet;
					
					$update_toekn=$this -> conn -> updatetablebyid('user', 'user_id',$recharge_user_id, $data);
					// Admin wallet update
					$admin_update_wallet=$admin_wallet+$bill_amount-$coupon_amount;
					$data_admin['admin_wallet']=$admin_update_wallet;
					$update_toekn=$this -> conn -> updatetablebyid('admin', 'admin_id',1, $data_admin);
					
					$res=file_get_contents(SITE_URL."/createpdf/pdf/".$bill_consumer_no);
					$post = array("status" => "true",'message'=>"Bill Pay Successfully", "bill_recharge_id" => $recharge,'consumer_no'=>$bill_consumer_no,'bill_amount'=>$bill_amount,'wallet_amount'=>$user_wallet,'bill_pay_date'=>$current_date,'transaction_id'=>$transaction_id);
				}else{
						$post = array('status' => "false","message" => "Pay bill failed");
				}
			}else{
				$pay_amount=$recharge_amount-$wallet_amount;
			$post = array('status' => "false","message" => "Not sufficent amount in  your wallet",'wallet_amount'=>$wallet_amount,'bill_amount'=>$bill_amount,'payble_amount'=>$pay_amount);
				echo $this -> json($post);
				exit();
				//$add=$this->add_money_recharge($recharge_user_id,$recharge_amount,$recharge_transaction_id);
				//$this->recharge();
			}
			
		}else{
			$post = array('status' => "false","message" => "These Bill already paid");
		}
		}
		}
		else
		{
			$post = array('status' => "false","message" => "Missing parameter",'recharge_user_id'=>$recharge_user_id,'bill_category_id'=>$bill_category_id,'biller_id'=>$biller_id,'wt_category'=>$wt_category,'consumer_no'=>$bill_consumer_no,'bill_amount'=>$bill_amount);
		}
		echo $this -> json($post);
	}
function pdf(){
	
	 $bill_consumer_no=$_REQUEST['bill_consumer_no'];
	// echo SITE_URL."/biller/bill_paid/bill_consumer_no/".$bill_consumer_no;
	echo $result=file_get_contents(SITE_URL."/createpdf/pdf/".$bill_consumer_no);
	 
	// echo $result;
	//print_r($result);
	// $ch=curl_init();
    // curl_setopt($ch,CURLOPT_URL,SITE_URL."/biller/bill_paid");
    // curl_setopt($ch,CURLOPT_POST,1);
    // curl_setopt($ch,CURLOPT_POSTFIELDS,"bill_consumer_no=".$bill_consumer_no);
    // curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    // $branch_output=curl_exec($ch);
// 	
    // curl_close ($ch);
// //	echo "string";
	// print_r($branch_output);
	//$result=file_get_contents(base_url('biller/bill_paid&bill_consumer_no='.$bill_consumer_no));
	//print_r($result);
 	 // $pdf = new PDF();
        // // // Data loading
         // $pdf->AddPage();
         // $data = $this -> conn -> get_table_row_byidvalue('biller_user', 'biller_customer_id_no', $bill_consumer_no);
		  // $pdf->SignUp($data);
         // print_r($pdf->Output());
       // $pdf->Output('/var/www/uploads/invoice/'.'Bill'.'.pdf','F');
}
// Bill pay from card
function bill_pay_from_card(){
 $coupon_id=$_REQUEST['coupon_id'];
	    $coupon_amount=$_REQUEST['coupon_amount'];
		$recharge_user_id = $_REQUEST['recharge_user_id']; 
		$wt_category = $_REQUEST['wt_category']; // wt_category = 11 pay bill
			$bill_category_id = $_REQUEST['bill_category_id']; // 1- Water, 2- Movies etc
			$biller_id = $_REQUEST['biller_id'];
			$bill_amount = $_REQUEST['bill_amount'];
			$bill_consumer_no=$_REQUEST['bill_consumer_no'];
			$card_no=$_REQUEST['card_number'];
			$cvv_no=$_REQUEST['cvv_no'];
			$wallet_type = 2; // 1- Credit, 2-Debit
			$bill_pay_status = 1;
			
			$wallet_category='4'; // 4- Cashback
			$current_date=date("Y-m-d h:i:sa");
			$wt_desc='PaY Bill'; 
			if(!empty($bill_consumer_no)  && !empty($biller_id)&&  !empty($bill_amount)&& !empty($recharge_user_id))
		{
			$bill_records = $this -> conn -> get_table_field_doubles('biller_user', 'biller_customer_id_no', $bill_consumer_no,'biller_id',$biller_id);
			//$bill_records = $this -> conn -> get_table_row_byidvalue('biller_user', 'biller_customer_id_no', $bill_consumer_no);
			//print_r($bill_records);
			if(!empty($bill_records)){
				$bill_user_id = $bill_records['0']['biller_user_id'];
				$bill_pay_status = $bill_records['0']['bill_pay_status'];
				if($bill_pay_status=='2'){
				$records = $this -> conn -> get_table_row_byidvalue('user', 'user_id', $recharge_user_id);
				$wallet_amount = $records['0']['wallet_amount'];
				$reffer_status = $records['0']['reffer_amount_status'];
				$reffer_user_id = $records['0']['reffer_user_id'];
				$admin=$this->conn->get_all_records('admin');
				$admin_wallet = $admin['0']['admin_wallet'];
			 $transaction_id= strtotime("now").mt_rand(10000000, 99999999);
$recharge = $this -> conn -> insertnewrecords('wallet_transaction','wt_user_id, wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc', '"' . $recharge_user_id . '","' . $current_date . '","' . $wallet_type . '","' . $bill_amount . '","' . $wt_category . '","'.$transaction_id . '","' . $wt_desc . '"');
						
				if($recharge){
					$walletrecharge = $this -> conn -> insertnewrecords('bill_recharge','bill_user_id,bill_transaction_id,bill_category_id, biller_id,bill_consumer_no,bill_amount,bill_pay_date,bill_pay_status','"'.$recharge_user_id . '","'.$transaction_id . '","' . $bill_category_id . '","' . $biller_id . '","' . $bill_consumer_no . '","' . $bill_amount . '","' .$current_date. '","' . $bill_pay_status . '"'); 
					
					if(!empty($walletrecharge)){
			
			
					$data_frnd['bill_pay_status']=1;
					$update_toekn=$this -> conn -> updatetablebyid('biller_user', 'biller_user_id',$bill_user_id, $data_frnd);
			
		}
					
								//reffer amount when user first recharge then beifits add in frnd wallet
					if($reffer_status=='2'){
						$frnd_records = $this -> conn -> get_table_row_byidvalue('user', 'user_id', $reffer_user_id);
						
							$reffer_records = $this -> conn -> get_all_records('reffer_amount');
							$refferal_amount = $reffer_records[0]['reffer_amount'];
										$user11_id = $frnd_records['0']['user_id'];
										$reffer_code_database = $frnd_records['0']['user_refferal_code'];
											$wallet = $frnd_records['0']['wallet_amount'];
											$frnd_number = $frnd_records['0']['user_contact_no'];
											$current_date=date("Y-m-d h:i:sa");
											$transaction_id= strtotime("now").mt_rand(10000000, 99999999);
											$wt_type=2; // credit in frnd acconnt
											$refferamount=$refferal_amount; // reffer amount
											$wt_category=9; // refferal amount recieved in wallet
											$wt_desc="Refferal amount add in your wallet using by ".substr($mobile,4);
										
										
										$add_reffer_money = $this -> conn -> insertnewrecords('refferal_records','refferal_user_id,refferal_frnd_id,refferal_amount,refferal_date', '"' . $recharge_user_id . '","' . $user11_id . '","' . $refferamount . '","' . $current_date . '"');
										
											$add_money = $this -> conn -> insertnewrecords('wallet_transaction','wt_user_id, wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc,cashbackrecord_id', '"' . $user11_id . '","' . $current_date . '","' . $wt_type . '","' . $refferamount . '","' . $wt_category . '","' . $transaction_id . '","' . $wt_desc . '","' . $frnd_number . '"');
									
							// modify wallet of frnd using reffer code///
							$data_frnd['wallet_amount']=$wallet+$refferal_amount;
									$update_toekn=$this -> conn -> updatetablebyid('user', 'user_id',$user11_id, $data_frnd);
									
											
							// Cahnge user status when refeer amount add in frnd wallet
											$data12['reffer_amount_status']=1;
									$update_toekn=$this -> conn -> updatetablebyid('user', 'user_id',$recharge_user_id, $data12);
										
					}
					
					$cashback_record_id=$recharge_number;
				if(!empty($coupon_id)){
					
					$coupon_apply = $this -> conn -> insertnewrecords('coupon_details','coupon_id, user_id,coupon_apply_date', '"' . $coupon_id . '","' . $recharge_user_id . '","' . $current_date . '"');
						if(!empty($coupon_apply)){
							
							$walletrecharge = $this -> conn -> insertnewrecords('wallet_transaction','wt_user_id,wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc,cashbackrecord_id', '"' . $recharge_user_id . '","' . $current_date . '","' . $wallet_type . '","' . $coupon_amount . '","' . $wallet_category . '","' .$transaction_id . '","' . $w_desc . '","' . $cashback_record_id . '"');
					$user_wallet=$wallet_amount+$coupon_amount;
					$data['wallet_amount']=$user_wallet;
					
					$update_toekn=$this -> conn -> updatetablebyid('user', 'user_id',$recharge_user_id, $data);
						}
				}
			
				// Admin wallet update
					$admin_update_wallet=$admin_wallet+$recharge_amount;
					$data_admin['admin_wallet']=$admin_update_wallet;
					$update_toekn=$this -> conn -> updatetablebyid('admin', 'admin_id',1, $data_admin);
					$res=file_get_contents(SITE_URL."/createpdf/pdf/".$bill_consumer_no);
					$post = array("status" => "true",'message'=>"Bill Pay Successfully", "bill_recharge_id" => $recharge,'consumer_no'=>$bill_consumer_no,'bill_amount'=>$bill_amount,'wallet_amount'=>$wallet_amount,'bill_pay_date'=>$current_date,'transaction_id'=>$transaction_id);
				}else{
						$post = array('status' => "false","message" => "Pay Bill failed");
				}
		
			}else{
			$post = array('status' => "false","message" => "These Bill already paid");
		}
		}
		}
		else
		{
			$post = array('status' => "false","message" => "Missing parameter",'recharge_user_id'=>$recharge_user_id,'bill_category_id'=>$bill_category_id,'biller_id'=>$biller_id,'wt_category'=>$wt_category,'consumer_no'=>$bill_consumer_no,'bill_amount'=>$bill_amount);
		}
		echo $this -> json($post);
			
}
// bill pay from card with wallet///
function bill_pay_card_with_wallet(){
	 $coupon_id=$_REQUEST['coupon_id'];
	    $coupon_amount=$_REQUEST['coupon_amount'];
		$recharge_user_id = $_REQUEST['recharge_user_id'];
		$wt_category = $_REQUEST['wt_category']; // wt_category = 11 pay bill
			$bill_category_id = $_REQUEST['bill_category_id']; // 1- Water, 2- Movies etc
			$biller_id = $_REQUEST['biller_id'];
			$bill_amount = $_REQUEST['bill_amount'];
			$bill_consumer_no=$_REQUEST['bill_consumer_no'];
			$card_no=$_REQUEST['card_number'];
			$cvv_no=$_REQUEST['cvv_no'];
			$wallet_type = 2; // 1- Credit, 2-Debit
			$bill_pay_status = 1;
			
			
			$current_date=date("Y-m-d h:i:sa");
			$wt_desc='PaY Bill'; 
			if(!empty($bill_consumer_no)  && !empty($biller_id)&&  !empty($bill_amount)&& !empty($recharge_user_id))
		{
			//$bill_records = $this -> conn -> get_table_row_byidvalue('biller_user', 'biller_customer_id_no', $bill_consumer_no);
			$bill_records = $this -> conn -> get_table_field_doubles('biller_user', 'biller_customer_id_no', $bill_consumer_no,'biller_id',$biller_id);
			if(!empty($bill_records)){
				$bill_user_id = $bill_records['0']['biller_user_id'];
				$bill_pay_status = $bill_records['0']['bill_pay_status'];
				if($bill_pay_status=='2'){
				$records = $this -> conn -> get_table_row_byidvalue('user', 'user_id', $recharge_user_id);
				$wallet_amount = $records['0']['wallet_amount'];
				$wallet_used_amount = $records['0']['wallet_amount'];
				$reffer_status = $records['0']['reffer_amount_status'];
				$reffer_user_id = $records['0']['reffer_user_id'];
				$card_deduct_amount=$bill_amount-$wallet_amount;
				
				$admin=$this->conn->get_all_records('admin');
				$admin_wallet = $admin['0']['admin_wallet'];
		 $transaction_id= strtotime("now").mt_rand(10000000, 99999999);
			$recharge = $this -> conn -> insertnewrecords('wallet_transaction','wt_user_id, wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc,user_wallet_rec_amount,user_card_card_rec_amount', '"' . $recharge_user_id . '","' . $current_date . '","' . $wallet_type . '","' . $bill_amount . '","' . $wt_category . '","' .$transaction_id . '","' . $wt_desc . '","' .$wallet_amount . '","' . $card_deduct_amount . '"');
						
				if($recharge){
					$walletrecharge = $this -> conn -> insertnewrecords('bill_recharge','bill_user_id,bill_transaction_id,bill_category_id, biller_id,bill_consumer_no,bill_amount,bill_pay_date,bill_pay_status','"'.$recharge_user_id . '","'.$transaction_id . '","' . $bill_category_id . '","' . $biller_id . '","' . $bill_consumer_no . '","' . $bill_amount . '","' .$current_date. '","' . $bill_pay_status . '"'); 
					
					if(!empty($walletrecharge)){
			
			
					$data_frnd['bill_pay_status']=1;
					$update_toekn=$this -> conn -> updatetablebyid('biller_user', 'biller_user_id',$bill_user_id, $data_frnd);
			
		}
					
							//reffer amount when user first recharge then beifits add in frnd wallet
					if($reffer_status=='2'){
						$frnd_records = $this -> conn -> get_table_row_byidvalue('user', 'user_id', $reffer_user_id);
						
							$reffer_records = $this -> conn -> get_all_records('reffer_amount');
							$refferal_amount = $reffer_records[0]['reffer_amount'];
										$user11_id = $frnd_records['0']['user_id'];
										$reffer_code_database = $frnd_records['0']['user_refferal_code'];
											$wallet = $frnd_records['0']['wallet_amount'];
											$frnd_number = $frnd_records['0']['user_contact_no'];
											$current_date=date("Y-m-d h:i:sa");
											$transaction_id= strtotime("now").mt_rand(10000000, 99999999);
											$wt_type=2; // credit in frnd acconnt
											$refferamount=$refferal_amount; // reffer amount
											$wt_category=9; // refferal amount recieved in wallet
											$wt_desc="Refferal amount add in your wallet using by ".substr($mobile,4);
										
										
										$add_reffer_money = $this -> conn -> insertnewrecords('refferal_records','refferal_user_id,refferal_frnd_id,refferal_amount,refferal_date', '"' . $recharge_user_id . '","' . $user11_id . '","' . $refferamount . '","' . $current_date . '"');
										
											$add_money = $this -> conn -> insertnewrecords('wallet_transaction','wt_user_id, wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc,cashbackrecord_id', '"' . $user11_id . '","' . $current_date . '","' . $wt_type . '","' . $refferamount . '","' . $wt_category . '","' . $transaction_id . '","' . $wt_desc . '","' . $frnd_number . '"');
									
							// modify wallet of frnd using reffer code///
						$data_frnd['wallet_amount']=$wallet+$refferal_amount;
									$update_toekn=$this -> conn -> updatetablebyid('user', 'user_id',$user11_id, $data_frnd);
									
											
							// Cahnge user status when refeer amount add in frnd wallet
											$data12['reffer_amount_status']=1;
									$update_toekn=$this -> conn -> updatetablebyid('user', 'user_id',$recharge_user_id, $data12);
										
					}
					
					$cashback_record_id=$recharge_number;
				if(!empty($coupon_id)){
					
					$coupon_apply = $this -> conn -> insertnewrecords('coupon_details','coupon_id, user_id,coupon_apply_date', '"' . $coupon_id . '","' . $recharge_user_id . '","' . $current_date . '"');
						if(!empty($coupon_apply)){
							
							$walletrecharge = $this -> conn -> insertnewrecords('wallet_transaction','wt_user_id,wt_datetime,wt_type,wt_amount,wt_category,transaction_id,wt_desc,cashbackrecord_id', '"' . $recharge_user_id . '","' . $current_date . '","' . $wallet_type . '","' . $coupon_amount . '","' . $wallet_category . '","' .$transaction_id . '","' . $w_desc . '","' . $cashback_record_id . '"');
					
					// wallet amont set zero 
					$wallet_amount=0;		
					$user_wallet=$wallet_amount+$coupon_amount;
					$data['wallet_amount']=$user_wallet;
					
					$update_toekn=$this -> conn -> updatetablebyid('user', 'user_id',$recharge_user_id, $data);
						}
				}else{
					$wallet_amount=0;		
					$user_wallet=$wallet_amount+$coupon_amount;
					$data['wallet_amount']=$user_wallet;
					
					$update_toekn=$this -> conn -> updatetablebyid('user', 'user_id',$recharge_user_id, $data);
				}
					// Admin wallet update
					$admin_update_wallet=$admin_wallet+$recharge_amount;
					$data_admin['admin_wallet']=$admin_update_wallet;
					$update_toekn=$this -> conn -> updatetablebyid('admin', 'admin_id',1, $data_admin);
						$res=file_get_contents(SITE_URL."/createpdf/pdf/".$bill_consumer_no);
					$post = array("status" => "true",'message'=>"Recharge Successfully", "recharge_id" => $recharge,'recharge_number'=>$rec_number,'bill_amount'=>$bill_amount,'wallet_used_amount'=>$wallet_used_amount,'card_used_amount'=>$card_deduct_amount,'wallet_amount'=>$wallet_amount,'recharge_date'=>$current_date,'transaction_id'=>$transaction_id);
				}else{
						$post = array('status' => "false","message" => "bill pay failed");
				}
		}else{
			$post = array('status' => "false","message" => "These Bill already paid");
		}
		}
			
		}
		else
		{
			$post = array('status' => "false","message" => "Missing parameter",'recharge_user_id'=>$recharge_user_id,'bill_category_id'=>$bill_category_id,'biller_id'=>$biller_id,'wt_category'=>$wt_category,'consumer_no'=>$bill_consumer_no,'bill_amount'=>$bill_amount);
		}
		echo $this -> json($post);
			
			
}	

//--function became a biller--///
function biller_registration(){
	$user_id=$_REQUEST['user_id'];
	$company_name=$_REQUEST['company_name'];
	$company_reg_no=$_REQUEST['company_reg_no'];
	$rc_no=$_REQUEST['rc_no'];
	$tin_no=$_REQUEST['tin_no'];
	$bussiness_phone=$_REQUEST['bussiness_phone'];
	$bussiness_address=$_REQUEST['bussiness_address'];
	$biller_name=$_REQUEST['biller_name'];
	$biller_email=$_REQUEST['biller_email'];
	$biller_category_id=$_REQUEST['biller_category_id'];
	$biller_reg_type='2';
	$image=$_FILES['bussiness_logo']['name'];
		$current_date=date("Y-m-d h:i:sa");
		$biller_status='2'; //--1 approved, 2- pending
	if(!empty($company_name) && ($company_reg_no) && !empty($rc_no) && !empty($tin_no) && !empty($bussiness_phone) && !empty($biller_name) && !empty($biller_name) && !empty($_FILES['bussiness_logo']['name']) && !empty($user_id)){
	$biller_records = $this -> conn -> get_table_row_byidvalue('biller_details', 'biller_email', $biller_email);
	if(empty($biller_records)){
				
		$user_image = '';
			if ($_FILES['bussiness_logo']['name']) {
                $user_image = $_FILES['bussiness_logo']['name'];
            }
            $attachment = $_FILES['bussiness_logo']['name'];

            if (!empty($attachment)) {
                $file_extension = explode(".", $_FILES["bussiness_logo"]["name"]);
                $new_extension = strtolower(end($file_extension));
                $today = time();
                $custom_name = "bussiness_logo" . $today;
                $file_name = $custom_name . "." . $new_extension;

                if ($new_extension == 'png' || $new_extension == 'jpeg' || $new_extension == 'jpg' || $new_extension == 'bmp') {
                    move_uploaded_file($_FILES['bussiness_logo']['tmp_name'], "../uploads/biller_logo/" . $file_name);
					 $biller_company_logo=$file_name; 
				}
			$biller_insert = $this -> conn -> insertnewrecords('biller_details','biller_category_id,biller_name,biller_email,company_reg_no,rc_no,tin_no,biller_address,biller_contact_no,biller_company_name,biller_company_logo,biller_created_date,biller_status,biller_reg_type', '"' . $biller_category_id . '","' . $biller_name . '","' . $biller_email . '","' . $company_reg_no . '","' . $rc_no . '","' .$tin_no . '","' . $bussiness_address . '","' . $bussiness_phone . '","' .$company_name . '","' . $biller_company_logo . '","' . $current_date . '","' .$biller_status . '","' .$biller_reg_type . '"');
			
			if(!empty($biller_insert)){
				   $data_admin['biller_id']=$biller_insert;
				 $data_admin['biller_status']=2;
					$update_toekn=$this -> conn -> updatetablebyid('user', 'user_id',$user_id, $data_admin);
				$post = array('status' => "true","message" => "Biller added successfully, please wait for admin approval.");
			}else{
				$post = array('status' => "false","message" => "Technical server error");
			}
			}
	}else{
		$post = array('status' => "false","message" => "These Bussiness email already exist");
	}
}else{
	$post = array('status' => "false","message" => "Missing parameter",'company_name'=>$company_name,'company_reg_no'=>$company_reg_no,'rc_no'=>$rc_no,'tin_no'=>$tin_no,'bussiness_phone'=>$bussiness_phone,'biller_name'=>$biller_name,'biller_email'=>$biller_email,'image'=>$image,'user_id'=>$user_id,'biller_category_id'=>$biller_category_id);
}
echo $this -> json($post);
}

//-- function change app biller status---
   function check_biller_status(){
   	$user_id=$_REQUEST['user_id'];
   	if(!empty($user_id))
   	{
   		$biller_records = $this -> conn -> get_table_row_byidvalue('user', 'user_id', $user_id);
		if(!empty($biller_records))
   		{
   			$biller_status=$biller_records[0]['biller_status'];
			$user_id=$biller_records[0]['user_id'];
			$biller_id=$biller_records[0]['biller_id'];
			$post = array('status' => "true","biller_status" => $biller_status,'user_id'=>$user_id,'biller_id'=>$biller_id);
   		}else{
   			$post = array('status' => "false","message" => "Invalid user id");
   		}
	}else
	{
			$post = array('status' => "false","message" => "Missing parameter",'user_id'=>$user_id);
	}
	echo $this -> json($post);
   }
//--- function create invoice---///
function create_invoice(){

	$biller_id=$_REQUEST['biller_id'];
	$consumer_name=$_REQUEST['consumer_name'];
	$invoice_no=$_REQUEST['invoice_no'];
	$consumer_no=$_REQUEST['consumer_no'];
	$consumer_email=$_REQUEST['consumer_email'];
	$consumer_contact_no=$_REQUEST['consumer_contact_no'];
	$bill_amount=$_REQUEST['bill_amount'];
	$bill_last_date=$_REQUEST['bill_last_date'];
	$bill_desc=$_REQUEST['bill_desc'];
		$current_date=date("Y-m-d h:i:sa");
		
	
	if(!empty($biller_id) && !empty($consumer_name) && !empty($invoice_no) && !empty($consumer_no) && !empty($consumer_email) && !empty($consumer_contact_no) && !empty($bill_amount) &&!empty($bill_last_date) && !empty($bill_last_date) && !empty($bill_desc)){
				
		$bill_records = $this -> conn -> get_table_row_byidvalue('biller_user', 'biller_customer_id_no', $consumer_no);	
		if(empty($bill_records)){
			$bill_insert = $this -> conn -> insertnewrecords('biller_user','biller_id,biller_user_name,biller_customer_id_no,bill_description, 	bill_amount,bill_invoice_no,bill_invoice_date,bill_due_date,biller_user_email,biller_user_contact_no', '"' . $biller_id . '","' . $consumer_name . '","' . $consumer_no . '","' . $bill_desc . '","' . $bill_amount . '","' .$invoice_no . '","' . $current_date . '","' . $bill_last_date . '","' .$consumer_email . '","' . $consumer_contact_no . '"');
			if(!empty($bill_insert)){
				$res=file_get_contents(SITE_URL."/createpdf/create_pdf/".$consumer_no);
				$post = array('status' => "true","message" => "Invoice craete successfully",'bill_id'=>$bill_insert);
			}else{
				$post = array('status' => "false","message" => "");
			}
			
			
			
		}else{
			$post = array('status' => "false","message" => "These consumer number already exist");
		}
		
	}else{
		$post = array('status' => "false","message" => "Missing parameter");
	}
		echo $this -> json($post);
}

///--- function check_operator....
function check_operator(){
	$mobile_no=$_REQUEST['mobile'];
	$series=str_split($mobile_no, 3);
	$series_num=$series[0];
	$operator_records = $this -> conn -> get_table_row_byidvalue('number_series', 'series', $series_num);	
	$operator_id=$operator_records[0]['operator_id'];
	$operator_list = $this -> conn -> get_table_row_byidvalue('operator_list', 'operator_id', $operator_id);
	if(!empty($operator_list)){
		$operator_name=$operator_list[0]['operator_name']; 
		$operator_id=$operator_list[0]['operator_id']; 
		$response = array('status'=>'true','operator_id' => $operator_id, 'operator_name' => $operator_name);
	}else{
		$response = array('status'=>'false','message' => "No Record Found");
	}
	
	echo $this -> json($response);
}
// function recharge api function////
function mobile_recharge_api($operator_id,$mobile,$amount)
{
	$operator_id=$operator_id; 
		$operator_list = $this -> conn -> get_table_row_byidvalue('operator_list', 'operator_id', $operator_id);	
	$operator_code=$operator_records[0]['operator_code'];
			$mobile='0'.$mobile; 
			$amount=$amount;
	if($operator_code=='MTN')
	{
			
				$userid='08092230991';
				$pass='01fa320f4048f4fa51a34';
					  $url="http://mobileairtimeng.com/httpapi/?userid=$userid&pass=$pass&network=5&phone=$mobile&amt=$amount"; 
				$str = file_get_contents($url); 
				
				$sdk=explode("|",$str); 
				$pos=$sdk[0]; 
				return $pos;
	}else{
		/*
		$biller_records = $this -> conn -> get_table_row_byidvalue('operator_list', 'operator_id', $operator_id);
					$operator_name = $biller_records['0']['operator_name'];
					if($operator_name == "Airtel"){
						 $operator='AIRT'; 
					}else 
					if($operator_name=='Glo'){
						$operator='Glo';
					}else 
					{
						$operator='ETST';
					}*/
		
			
		ini_set("soap.wsdl_cache_enabled", "0");
		$a=array( "trace" => 1,"exceptions"=> 1);
		$wsdl = "http://202.140.50.116/EstelServices/services/EstelServices?wsdl";
		$client = new SoapClient ($wsdl, $a);
		$simpleresult  = $client->getTopup(array("agentCode"=>'TPR_EFF',"mpin"=>'ECE473FF47C2E97FF3F1D496271A9EB1',"destination"=>$mobile,"amount"=>$amount,"productCode"=>$operator_code,"comments"=>"topup","agenttransid"=>'1234',"type"=>'PC'));
	$soaoresponce = $client->__getLastResponse();
	$xml = simplexml_load_string($soaoresponce, NULL, NULL, "http://schemas.xmlsoap.org/soap/envelope/");
	$ns = $xml->getNamespaces(true);
	$soap = $xml->children($ns['soapenv']);
	$agentCode = $soap->Body->children($ns['topupRequestReturn'])->children($ns['ns1'])->agentCode;
$productcode = $soap->Body->children($ns['topupRequestReturn'])->children($ns['ns5'])->productcode;
$destination = $soap->Body->children($ns['topupRequestReturn'])->children($ns['ns6'])->destination;
$agenttransid = $soap->Body->children($ns['topupRequestReturn'])->children($ns['ns8'])->agenttransid;
$amount = $soap->Body->children($ns['topupRequestReturn'])->children($ns['ns9'])->amount;
$transid = $soap->Body->children($ns['topupRequestReturn'])->children($ns['ns12'])->transid;
$resultdescription = $soap->Body->children($ns['topupRequestReturn'])->children($ns['ns26'])->resultdescription;

if($resultdescription[0]=='Transaction Successful'){
	//echo "transid=".$transid[0].'<br>';
	$recharge_status='1';
	$transaction_id=$transid[0];
	$result=$recharge_status.",".$transid[0];
	//$result=array("recharge_status"=>$recharge_status,'transaction_id'=>$transid[0]);
}else{
	$result="2"."0";
}
return $result;
	}

}
	/// forget send code///
	function forget_send_code($mobile){
		$varifycode = rand('10000000', '99999999');
		//$code = 1234;
		  $code = str_pad($varifycode, 3, '0', STR_PAD_LEFT);
		 $mobileNumber = substr($mobile, 1);
		 $msg = "New Password of Recharge login : " . $code;
         $encodedMessage = urlencode($msg);
       // $route = "4";
       // $authKey = "109829ANu1kqLdg570b4e25";
       // $senderId = "Recharge";
       // $postData = array(
     // 'authkey' => $authKey,
     // 'mobiles' => $mobileNumber,
     // 'message' => $encodedMessage,
     // 'sender' => $senderId,
     // 'route' => $route
// );
 //$url="http://api.msg91.com/api/sendhttp.php";
 $url="http://www.kudisms.net/components/com_spc/smsapi.php?username=smerp&password=abhishek&sender=kudisms&recipient='".$mobile."'&message=".$encodedMessage;
      $ch = curl_init();
curl_setopt_array($ch, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $postData
    ,CURLOPT_FOLLOWLOCATION => true
));
// 
// 
// //Ignore SSL certificate verification
 curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
// 
// 
// //get response
 $output = curl_exec($ch);
//  
  // if (curl_errno($ch)) {
	 // $result = array('status' => 'false', 'message' => 'Error in sending OTP, please verify your contact number and try again.');
 // echo json_encode($result);
			   // exit();
// // // // 
		  // }
  curl_close($ch);
		return $code;
	}


	///c/// send code //////
	function send_code($mobile_no) {

		$varifycode = rand('1000', '9999');
		$code = str_pad($varifycode, 3, '0', STR_PAD_LEFT);
		$code = 1234;
		$mobile="0".$mobile_no;
		// $mobileNumber = substr($mobile_no, 1);
		$msg = "Recharge Verification Code : " . $code;
         $encodedMessage = urlencode($msg);
      // $route = "4";
      // $authKey = "109829ANu1kqLdg570b4e25";
      // $senderId = "Recharge";
      // $postData = array(
    // 'authkey' => $authKey,
    // 'mobiles' => $mobileNumber,
    // 'message' => $encodedMessage,
    // 'sender' => $senderId,
    // 'route' => $route
// );
 $url="http://www.kudisms.net/components/com_spc/smsapi.php?username=smerp&password=abhishek&sender=kudisms&recipient=$mobile&message=".$encodedMessage;
// $url="http://api.msg91.com/api/sendhttp.php";
      $ch = curl_init();
 curl_setopt_array($ch, array(
     CURLOPT_URL => $url,
     CURLOPT_RETURNTRANSFER => true,
     CURLOPT_POST => true,
    // CURLOPT_POSTFIELDS => $postData
    CURLOPT_FOLLOWLOCATION => true
 ));
// 
// 
// //Ignore SSL certificate verification
 curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
// 
// 
// //get response
 $output = curl_exec($ch);
//  
  // if (curl_errno($ch)) {
	 // $result = array('status' => 'false', 'message' => 'Error in sending OTP, please verify your contact number and try again.');
 // echo json_encode($result);
			   // exit();
// // // // 
		  // }
  curl_close($ch);
return $code;
		//echo $output;
	}



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
