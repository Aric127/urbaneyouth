<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('login_model');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('email');
		date_default_timezone_set("Africa/Lagos");
		define('church_image',base_url('uploads/church_image'));
 		define('operator_image', base_url('uploads/operator/'));
        define('category_thumb_image', base_url('uploads/category/thumb_img/'));
        define('biller_company_logo', base_url('uploads/biller_company_logo/'));
        define('product_thumb_image', base_url('uploads/product/thumb_img/'));
        define('invoice_image', base_url('uploads/invoice_logo/'));
        define('attribute_image', base_url('uploads/attribute/'));
		define('logo', base_url('uploads/logo.png'));
		define('coupon_logo', base_url('uploads/coupon_img/'));
		define('webservice_url', 'oyacharge.com/webservices/api');
		define('event_image',base_url('uploads/event'));
        define('BAxi_Api_test_token','+uwXEA2F3Shkeqnqmt9LcmALGgkEbf2L6MbKdUJcFwow6X8jOU/D36CyYjp5csR5gPTLedvPQDg1jJGmOnTJ2A==');
        define('BAxi_Api_live_token','wMkYszcHBpeDaNFo1T9vy1WDeIqxxGoQw/oXGdf9TAjB1P+y+8Y9m5p2B6XP2iKe0bR+dg6ubjGydce/RNKbtQ==');
        define("Baxi_proxy_live_url","https://baxi.capricorndigi.com/app/rest/consumer/v2/exchange/proxy"); // live 
       define("Baxi_proxy_test_url","https://test.platform.baxibox.com/app/rest/consumer/v2/exchange/proxy"); // test
        if ($this->session->userdata('userid') == FALSE) {
            redirect('login');
        }
    }
function one_card_balence(){
	ini_set("soap.wsdl_cache_enabled", "0");
	$a=array( "trace" => 1,"exceptions"=> 1);
	$wsdl = "http://202.140.50.116/EstelServices/services/EstelServices?wsdl";
	$client = new SoapClient ($wsdl, $a);
	$simpleresult  = $client->getBalance(array("agentCode"=>'TPR_EFF',"mpin"=>'ECE473FF47C2E97FF3F1D496271A9EB1'));
	$soaoresponce=$client->__getLastResponse();
	$xml = simplexml_load_string($soaoresponce, NULL, NULL, "http://schemas.xmlsoap.org/soap/envelope/");
	$ns = $xml->getNamespaces(true);
	$soap = $xml->children($ns['soapenv']);
	@$res = $soap->Body->children($ns['balanceRequestReturn'])->children($ns['ns7'])->amount;
     return $res[0];
	
}
function caricon_api()
{
	$signedData = "GET" . "\n" . gmdate('D, d M Y H:i:s T') . "\n" . "/rest/consumer/finance/status";
	$token = base64_decode('wMkYszcHBpeDaNFo1T9vy1WDeIqxxGoQw/oXGdf9TAjB1P+y+8Y9m5p2B6XP2iKe0bR+dg6ubjGydce/RNKbtQ==');
	$signature = hash_hmac('sha1', $signedData, $token, true);
	$encodedsignature = base64_encode($signature);
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt_array($curl, array(CURLOPT_URL => "https://baxi.capricorndigi.com/app/rest/consumer/finance/status", CURLOPT_RETURNTRANSFER => true, CURLOPT_ENCODING => "", CURLOPT_MAXREDIRS => 10, CURLOPT_TIMEOUT => 30, CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET", CURLOPT_HTTPHEADER => array("accept: application/json, application/*+json", "accept-encoding: gzip,deflate", "authorization: MSP efficiencie:" . $encodedsignature, "cache-control: no-cache", "connection: Keep-Alive", "host: 136.243.252.209", "postman-token: 857e074a-8286-bb95-7bee-87df7dea3bed", "user-agent: Apache-HttpClient/4.5.1 (Java/1.8.0_91)", "x-msp-date:" . gmdate('D, d M Y H:i:s T')), ));
	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);
	
	if ($err) {
		echo "error";
	} else {
		$data = json_decode($response);
	return $data->balance;
}

}
    function index() {
    	
    	$data['balence_mobile_air']=file_get_contents('https://mobileairtimeng.com/httpapi/balance.php?userid=08092230991&pass=01fa320f4048f4fa51a34');
    	//$data['balence_one_card'] = $this->one_card_balence();
		$data['balence_caricon_api'] = $this->caricon_api();
		$wh=array('user_mobile_verify_status'=>1);
		$data['user_count']=$this->login_model->count_records_where('user',$wh);
		$data['admin_wallet']= $this->login_model->get_record('admin');
		$sql="select sum(wallet_amount) as wallet_amount from user";
		$data['wallet_amount']=$this->login_model->get_simple_query($sql);
		$sql1="select count(payment_type) as oyacash_trans from wallet_transaction where payment_type='0'";
		$data['oyacash_transaction']=$this->login_model->get_simple_query($sql1);
		$sql2="select count(payment_type) as kongapay_transaction from wallet_transaction where payment_type='1'";
		$data['kongapay_transaction']=$this->login_model->get_simple_query($sql2);
		$sql3="select count(payment_type) as webpay_transaction from wallet_transaction where payment_type='2'";
		$data['webpay_transaction']=$this->login_model->get_simple_query($sql3);
		$sql4="select user_name,user_email,user_contact_no,user_created_date from user order by user_id DESC limit 5";
        $data['letest_user']=$this->login_model->get_simple_query($sql4);
        $whBiller=array('biller_type'=>1);
        $data['biller_merchent']=$this->login_model->count_records_where('biller_details',$whBiller);
        $whchurch=array('biller_type'=>2);
        $data['church_merchent']=$this->login_model->count_records_where('biller_details',$whchurch);
        $whEvent=array('biller_type'=>3);
        $data['event_merchent']=$this->login_model->count_records_where('biller_details',$whEvent);
        $trans_sql="SELECT * FROM `wallet_transaction` join user on user.user_id=wallet_transaction.`wt_user_id` order by wt_id DESC limit 5";
        $data['letest_trans']=$this->login_model->get_simple_query($trans_sql);
		$wh=array('user_device_type'=>0,'user_mobile_verify_status'=>1);
		$data['website']=$this->login_model->count_records_where('user',$wh);
		
		$wh=array('user_device_type'=>1,'user_mobile_verify_status'=>1);
		$data['Android']=$this->login_model->count_records_where('user',$wh);
		
		$wh=array('user_device_type'=>2,'user_mobile_verify_status'=>1);
		$data['Iphone']=$this->login_model->count_records_where('user',$wh);
		
		$this->load->view('admin/menu');
        $this->load->view('admin/header');
        $this->load->view('admin/home',$data);
        $this->load->view('admin/footer');
    }

    function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }
    function recharge_plan_sync()
    {
         if(!empty($this->input->post()))
         {
            $data21212 = $this->input->post();
             $service_id   = $data21212['service_id']; 
           // $service_id   = $_REQUEST['service_id'];
            // ACC = 'AIRTEL Bundle'
            // AEC = 'ETISALAT Bundle'
            // ADC = 'GLO Bundle'
            // AQA = 'MultiChoice DSTV' - standalone products
            // AQC = 'MultiChoice GOTV' - standalone products
            if($service_id=='ACC' || $service_id=='AEC' || $service_id=='ADC' ||$service_id=='ALC')
            {
                $arr1 =  array('serviceId' => $service_id);
            }else
            if($service_id=='AQA' || $service_id=='AQC')
            {
                $arr1 =  array('serviceId' => $service_id,'details'=>array('requestType'=>'FIND_STANDALONE_PRODUCTS'));
            }
           
            $requestBody = json_encode($arr1);
            $hashedRequestBody = base64_encode(hash('sha256', utf8_encode($requestBody), true));
            $date = gmdate('D, d M Y H:i:s T');
            $signedData = "POST" . "\n" . $hashedRequestBody . "\n" . $date . "\n" . "/rest/consumer/v2/exchange/proxy";

            $token = base64_decode(BAxi_Api_test_token);
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
                "host: ".$_SERVER['SERVER_ADDR'], 
                "x-msp-date:" . $date
                );

                $curl = curl_init();
                    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
                        curl_setopt_array($curl, array(CURLOPT_URL =>Baxi_proxy_test_url, 
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
                        if(!empty($arr->details))
                        {
                        			
                                    $plans = $arr->details->bundles; 
                                    if(!empty($plans))
                                    {
                                        foreach ($plans as  $value) 
                                        {
                                            $where = array('rechage_amount' => $value->price,'service_id'=>$service_id);
                                            $check_plans = $this->login_model->get_record_where('recharge_plan', $where);
                                            if($service_id=='ACC')
                                            {
                                                if(empty($check_plans))
                                                {
                                                 $data12['plan_category_id']     = 15;
                                                 $data12['recharge_category_id'] = 1;
                                                 $data12['recharge_operator_id']  = 2 ;
                                                 $data12['service_id'] = $service_id;
                                                 $data12['rechage_amount'] = $value->price;
                                                 $data12['recharge_data_pack']= $value->allowance;
                                                $data12['recharge_validity']= substr($value->validity, 0, strrpos($value->validity, ' '));
                                                $data12['ercValue']= $value->ercValue;
                                                $data12['recharge_desc'] = $value->name;
                                                $this->login_model->insert_data('recharge_plan', $data12);
                                                }else{
                                                     $data12['plan_category_id']     = 15;
                                                     $data12['recharge_category_id'] = 1;
                                                     $data12['recharge_operator_id']  = 2 ;
                                                     $data12['service_id'] = $service_id;
                                                     $data12['rechage_amount'] = $value->price;
                                                     $data12['recharge_data_pack']= $value->allowance;
                                                    $data12['recharge_validity']= substr($value->validity, 0, strrpos($value->validity, ' '));
                                                    $data12['ercValue']= $value->ercValue;
                                                    $data12['recharge_desc'] = $value->name;
                                                    $this->login_model->update_data('recharge_plan', $data12, $where);
                                                }
                                            }else if($service_id=='AEC')
                                            {
                                                if(empty($check_plans))
                                                {
                                                 $data12['plan_category_id']     = 15;
                                                 $data12['recharge_category_id'] = 1;
                                                 $data12['recharge_operator_id']  = 1;
                                                 $data12['service_id'] = $service_id;
                                                 $data12['rechage_amount'] = $value->price;
                                                 $data12['recharge_data_pack']= $value->allowance;
                                                $data12['recharge_validity']= substr($value->validity, 0, strrpos($value->validity, ' '));
                                                $data12['recharge_desc'] = 'Data Bundle';
                                                $this->login_model->insert_data('recharge_plan', $data12);
                                                }else{
                                                     $data12['plan_category_id']     = 15;
                                                     $data12['recharge_category_id'] = 1;
                                                     $data12['recharge_operator_id']  = 1;
                                                     $data12['service_id'] = $service_id;
                                                     $data12['rechage_amount'] = $value->price;
                                                $data12['recharge_data_pack']= $value->allowance;
                                                    $data12['recharge_validity']= substr($value->validity, 0, strrpos($value->validity, ' '));
                                                    $data12['recharge_desc'] = 'Data Bundle';
                                                    $this->login_model->update_data('recharge_plan', $data12, $where);
                                                }
                                            }else if($service_id=='ADC')
                                            {
                                                if(empty($check_plans))
                                                {
                                                 $data12['plan_category_id']     = 15;
                                                 $data12['recharge_category_id'] = 1;
                                                 $data12['recharge_operator_id']  = 16;
                                                 $data12['service_id'] = $service_id;
                                                 $data12['rechage_amount'] = $value->price;
                                                 $data12['recharge_data_pack']= $value->allowance;
                                              $data12['recharge_validity']= substr($value->validity, 0, strrpos($value->validity, ' '));
                                                $data12['ercValue']= $value->ersPlanId;
                                                $data12['recharge_desc'] = $value->planType."-".$value->planType;
                                                $this->login_model->insert_data('recharge_plan', $data12);
                                                }else{
                                                     $data12['plan_category_id']     = 15;
                                                     $data12['recharge_category_id'] = 1;
                                                     $data12['recharge_operator_id']  = 16;
                                                     $data12['service_id'] = $service_id;
                                                     $data12['rechage_amount'] = $value->price;
                                                $data12['recharge_data_pack']= $value->allowance;
                                                    $data12['recharge_validity']= substr($value->validity, 0, strrpos($value->validity, ' '));
                                                    $data12['ercValue']= $value->ersPlanId;
                                                $data12['recharge_desc'] = $value->planType."-".$value->planType;
                                                    $this->login_model->update_data('recharge_plan', $data12, $where);
                                                }
                                            }else if($service_id=='ALC') // MTN
                                            {
                                            	 if(empty($check_plans))
                                                {
                                                 $data12['plan_category_id']     = 15;
                                                 $data12['recharge_category_id'] = 1;
                                                 $data12['recharge_operator_id']  = 3;
                                                 $data12['service_id'] = $service_id;
                                                 $data12['rechage_amount'] = $value->price;
                                                 $data12['recharge_data_pack']= $value->allowance;
                                                $data12['recharge_validity']= substr($value->validity, 0, strrpos($value->validity, ' '));
                                                $data12['recharge_desc'] = 'Data Bundle';
                                                $this->login_model->insert_data('recharge_plan', $data12);
                                                }else{
                                                     $data12['plan_category_id']     = 15;
                                                     $data12['recharge_category_id'] = 1;
                                                     $data12['recharge_operator_id']  = 3;
                                                     $data12['service_id'] = $service_id;
                                                     $data12['rechage_amount'] = $value->price;
                                                $data12['recharge_data_pack']= $value->allowance;
                                                    $data12['recharge_validity']= substr($value->validity, 0, strrpos($value->validity, ' '));
                                                    $data12['recharge_desc'] = 'Data Bundle';
                                                    $this->login_model->update_data('recharge_plan', $data12, $where);
                                                }
                                            }
                                            
                                        }
                                    
                                
                                 $this->session->set_flashdata('status', 'Plan update Successfully');
                            }    
                            
                        }else{
                             $this->session->set_flashdata('error', 'Error in update plan');
                            
                        }
                        redirect('admin/plan_list');
                    }
            // if($service_id=='AQA')
            // {
            //     $arr2 = array('serviceId'=>$service_id,'details'=>array('primaryProductCode','requestType'=>'FIND_PRODUCT_ADDONS')
            // }
        }
    }
    function change_password() {
        if ($this->input->post('change')) {
            $where = array('admin_id' => $this->session->userdata('userid'), 'admin_password' => md5($this->input->post('old_pass')));
            $check_password = $this->login_model->get_record_where('admin', $where);
            if ($check_password == FALSE) {
                $this->session->set_flashdata('error', 'Old Password does not match');
                redirect('admin/change_password');
            } else {
                $data = array('admin_password' => md5($this->input->post('new_pass')));
                $where = array('admin_id' => $this->session->userdata('userid'));
                $this->login_model->update_data('admin', $data, $where);

                //----------------Mail Start------------------//

                $message = '<h1>Oyacharge </h1></b></b><p>Your password has been changed successfully Your Email = ' . $this->session->userdata('user_email') . '.</p>
			<p><a href="' . site_url('login') . '" [astyle]></a></p></b>,
			</b></b><p>The Admin</p>';

                $to = $this->session->userdata('user_email');
                $subject = 'Password Changed';
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
                $headers .= 'From: Oyacharge<"blm.ypsilon@gmail.com">' . "\r\n";
            //    mail($to, $subject, $message, $headers);
				$this->sendElasticEmail($to, $subject,"OyaCharge", $message, "care@oyacharge.com", "OyaCharge");
                //----------------Mail End------------------//

                $this->session->set_flashdata('success', 'Password successfully changed');
                redirect('admin/change_password');
            }
        } else {
            $this->load->view('admin/menu');
            $this->load->view('admin/header');
            $this->load->view('admin/change_password_view');
            $this->load->view('admin/footer');
        }
    }
    
    function change_email(){
        $where = array('admin_id' => $this->session->userdata('userid'));
		
        if($this->input->post('change')){
            $data = array('admin_email' => $this->input->post('a_email'));
            $this->login_model->update_data('admin', $data, $where);
            $this->session->unset_userdata('user_email');
            $this->session->set_userdata('user_email', $this->input->post('a_email'));
            $this->session->set_flashdata('success', 'Email updated successfully');
            redirect('admin/change_email');
        } else {
            $get_admin = $this->login_model->get_data_where_condition('admin', $where);
			
            $data['a_email'] = $get_admin[0]->admin_email;
            $this->load->view('admin/menu');
            $this->load->view('admin/header');
            $this->load->view('admin/change_email_view', $data);
            $this->load->view('admin/footer');
        }
    }

    function change_status() {
        $where_name = $this->uri->segment(3);
        $where_value = $this->uri->segment(4);
        $table = $this->uri->segment(5);
        $table_field = $this->uri->segment(6);
        $field_value = $this->uri->segment(7);
        $function = $this->uri->segment(8);
		
        //----------------Start Change Status--------------------//

        $where = array($where_name => $where_value);
        $data = array($table_field => $field_value);
        $this->login_model->update_data($table, $data, $where);

        //----------------End Change Status--------------------//

        if ($table == "user" && $function == "user_list") {
            if ($field_value != 1) {
                $message = 'SUCCESS! Activity Status Change to InActive. ';
            } else {
                $message = 'SUCCESS! Activity Status Change to Active. ';
            }
            $this->session->set_flashdata('status', $message);
            $path = 'admin/' . $function;
            redirect($path);
        }
        if ($table == "recharge_category" && $function == "recharge_category_list") {
            if ($field_value != 1) {
                $message = 'SUCCESS! Activity Status Change to InActive. ';
            } else {
                $message = 'SUCCESS! Activity Status Change to Active. ';
            }
            $this->session->set_flashdata('status', $message);
            $path = 'admin/' . $function;
            redirect($path);
        }
        if ($table == "recharge_type" && $function == "recharge_type_list") {
            if ($field_value != 1) {
                $message = 'SUCCESS! Activity Status Change to InActive. ';
            } else {
                $message = 'SUCCESS! Activity Status Change to Active. ';
            }
            $this->session->set_flashdata('status', $message);
            $path = 'admin/' . $function;
            redirect($path);
        }
        if ($table == "operator_list" && $function == "operator_list") {
            if ($field_value != 1) {
                $message = 'SUCCESS! Activity Status Change to InActive. ';
            } else {
                $message = 'SUCCESS! Activity Status Change to Active. ';
            }
            $this->session->set_flashdata('status', $message);
            $path = 'admin/' . $function;
            redirect($path);
        }
        if ($table == "offer_coupon" && $function == "coupon_list") {
            if ($field_value != 1) {
                $message = 'SUCCESS! Coupon Status Change to InActive. ';
            } else {
                $message = 'SUCCESS! Coupon Status Change to Active. ';
            }
            $this->session->set_flashdata('status', $message);
            $path = 'admin/' . $function;
            redirect($path);
        }
		 if ($table == "free_coupon_list" && $function == "free_coupon_list") {
            if ($field_value != 1) {
                $message = 'SUCCESS! Coupon Status Change to InActive. ';
            } else {
                $message = 'SUCCESS! Coupon Status Change to Active. ';
            }
            $this->session->set_flashdata('status', $message);
            $path = 'admin/' . $function;
            redirect($path);
        }
        if ($table == "biller_details" && $function == "biller_list") {
            if ($field_value != 1) {
                $message = 'SUCCESS! Biller Status Change to InActive. ';
            } else {
                $message = 'SUCCESS! Biller Status Change to Active. ';
            }
            $this->session->set_flashdata('status', $message);
            $path = 'admin/' . $function;
            redirect($path);
        }
        if ($table == "about_us" && $function == "about_us") {
            if ($field_value != 1) {
                $message = 'SUCCESS! Activity Status Change to InActive. ';
            } else {
                $message = 'SUCCESS! Activity Status Change to Active. ';
            }
            $this->session->set_flashdata('status', $message);
            $path = 'admin/' . $function;
            redirect($path);
        }
         if ($table == "biller_category" && $function == "biller_category") {
            if ($field_value != 1) {
                $message = 'SUCCESS! Biller Category Status Change to InActive. ';
            } else {
                $message = 'SUCCESS! Biller Category Status Change to Active. ';
            }
            $this->session->set_flashdata('status', $message);
            $path = 'admin/' . $function;
            redirect($path);
        }
       
		 if ($table == "free_coupon_category" && $function == "free_coupon_category") {
            if ($field_value != 1) {
                $message = 'SUCCESS! Coupon Category Status Change to InActive. ';
            } else {
                $message = 'SUCCESS! Coupon Category Status Change to Active. ';
            }
            $this->session->set_flashdata('status', $message);
            $path = 'admin/' . $function;
            redirect($path);
        }
        if ($table == "recharge_plan" && $function == "plan_list") {
            if ($field_value != 1) {
                $message = 'SUCCESS! Plan Status Change to InActive. ';
            } else {
                $message = 'SUCCESS! Plan Status Change to Active. ';
            }
            $this->session->set_flashdata('status', $message);
            $path = 'admin/' . $function;
            redirect($path);
        }
		 if ($table == "plan_category" && $function == "plan_category") {
            if ($field_value != 1) {
                $message = 'SUCCESS! Plan Category Status Change to InActive. ';
            } else {
                $message = 'SUCCESS! Plan Category Status Change to Active. ';
            }
            $this->session->set_flashdata('status', $message);
            $path = 'admin/' . $function;
            redirect($path);
        }
        if ($table == "skretch_card" && $function == "scratch_card") {
            if ($field_value != 1) {
                $message = 'SUCCESS! Scratch Card Status Change to InActive. ';
            } else {
                $message = 'SUCCESS! Scratch Card Status Change to Active. ';
            }
            $this->session->set_flashdata('status', $message);
            $path = 'admin/' . $function;
            redirect($path);
        }
         if ($table == "agent_users" && $function == "agent_list") {
            if ($field_value != 1) {
                $message = 'SUCCESS! Agent margin Status Change to InActive. ';
            } else {
                $message = 'SUCCESS! Agent margin Status Change to Active. ';
            }
            $this->session->set_flashdata('status', $message);
            $path = 'admin/' . $function;
            redirect($path);
        }
    }
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
    function send_email($from, $to, $subject, $message) {
        $this->load->library('email');
        $this->email->from($from);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        if (!$this->email->send()) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function delete() {
        $delete_type = $this->uri->segment(3);
        $delete_table = $this->uri->segment(4);
        $delete_where_name = $this->uri->segment(5);
        $delete_where_id = $this->uri->segment(6);
		$delete_where = array($delete_where_name => $delete_where_id);
        $delete = $this->login_model->delete_record($delete_table, $delete_where);
        if ($delete == TRUE) {
            if ($delete_type == 'delete_user') {
                $message = 'USer deleted successfully!!';
                $this->session->set_flashdata('error', $message);
                redirect('admin/user_list');
            }
            if ($delete_type == 'delete_category') {
                $message = 'Category deleted successfully!!';
                $this->session->set_flashdata('error', $message);
                redirect('admin/recharge_category_list');
            }
            if ($delete_type == 'delete_recharge_type') {
                $message = 'Recharge type deleted successfully!!';
                $this->session->set_flashdata('error', $message);
                redirect('admin/recharge_type_list');
            }
             if ($delete_type == 'delete_operator') {
                $message = 'operator deleted successfully!!';
                $this->session->set_flashdata('error', $message);
                redirect('admin/operator_list');
            }
             if ($delete_type == 'delete_coupon') {
                $message = 'coupon deleted successfully!!';
                $this->session->set_flashdata('error', $message);
                redirect('admin/coupon_list');
            }
			  if ($delete_type == 'delete_free_coupon') {
                $message = 'coupon deleted successfully!!';
                $this->session->set_flashdata('error', $message);
                redirect('admin/free_coupon_list');
            }
             if ($delete_type == 'delete_biller_category') {
                $message = 'Biller category deleted successfully!!';
                $this->session->set_flashdata('error', $message);
                redirect('admin/biller_category');
            }
			  if ($delete_type == 'delete_biller') {
                $message = 'Biller deleted successfully!!';
                $this->session->set_flashdata('error', $message);
                redirect('admin/biller_list');
            }
            if ($delete_type == 'delete_free_coupon_category') {
                $message = 'Coupon Category deleted successfully!!';
                $this->session->set_flashdata('error', $message);
                redirect('admin/free_coupon_category');
            }
            if ($delete_type == 'delete_about_us') {
                $message = 'Content deleted successfully!!';
                $this->session->set_flashdata('error', $message);
                redirect('admin/about_us');
            }
   
             if ($delete_type == 'delete_recharge_plan') {
                $message = 'Recharge Plan deleted successfully!!';
                $this->session->set_flashdata('error', $message);
                redirect('admin/plan_list');
            }
			 if ($delete_type == 'delete_skretch_coupon') {
                $message = 'Scratch card deleted successfully!!';
                $this->session->set_flashdata('error', $message);
                redirect('admin/scratch_card');
            }
            if ($delete_type == 'delete_brand_type') {
                $message = 'Brand Type deleted successfully!!';
                $this->session->set_flashdata('error', $message);
                redirect('admin/brand_type_list');
            }
            if ($delete_type == 'delete_ideal_for') {
                $message = 'Ideal for deleted successfully!!';
                $this->session->set_flashdata('error', $message);
                redirect('admin/ideal_for_list');
            }
			if ($delete_type == 'attribute_user') {
                $message = 'Attribute deleted successfully!!';
                $this->session->set_flashdata('error', $message);
                redirect('admin/attribute_list');
            }
        } else {
            redirect();
        }
    }
    function agent_list()
    {
         $sql="SELECT DISTINCT user_name,user_email,user_id,agant_service,agent_id,agent_service_operator,agent_users.agent_margin,agent_created_date,operator_name,agent_status,(select sum(wt_amount) as total_margin from wallet_transaction where wt_user_id=agent_users.agent_user_id and wt_category=21 group by wt_user_id ) as total_margin,(select count(wt_amount) as total_transactions from wallet_transaction where wt_user_id=agent_users.agent_user_id and wt_category=21 group by wt_user_id ) as total_transactions FROM `agent_users` join user on user.user_id=agent_users.agent_user_id join operator_list on operator_list.operator_id=agent_users.agent_service_operator group by user.user_id"; 
        $data['agent_list']=$this->login_model->get_simple_query($sql);
        $this->load->view('admin/menu');
        $this->load->view('admin/header');
        $this->load->view('admin/listing/agent_list', $data);
        $this->load->view('admin/footer');

    }

   function view_agent_list(){
    	$user_id = $this->uri->segment(4);
    	
    	$sql="SELECT user_name,user_email,user_id,agant_service,agent_id,agent_service_operator,agent_users.agent_margin,agent_created_date,operator_name,agent_status FROM `agent_users` join user on user.user_id=agent_users.agent_user_id join operator_list on operator_list.operator_id=agent_users.agent_service_operator where agent_user_id= $user_id"; 

        $data['agent_service_list']=$this->login_model->get_simple_query($sql);
        $this->load->view('admin/menu');
        $this->load->view('admin/header');
        $this->load->view('admin/listing/agent_service_list', $data);
        $this->load->view('admin/footer');

    } 
    function agent_view_transaction()
    {
        $user_id = $this->uri->segment(3);
        $sql="SELECT wt_id,wt_user_id,wt_datetime,wt_amount,payment_type,transaction_id,trans_ref_no,cashbackrecord_id,transaction_id,user_name,user_email,user_contact_no FROM `wallet_transaction` join user on user.user_id=wt_user_id WHERE `wt_user_id` = '".$user_id."' AND `wt_category` = 21 ORDER BY `wt_id` DESC ";
        $margin_trans=$this->login_model->get_simple_query($sql);
        if(!empty($margin_trans))
        {
            $i=0;
            foreach ($margin_trans as  $value) {
               $trans_ref_no = $value->trans_ref_no;
               if(!empty($trans_ref_no))
               {
                 $sql12="SELECT wt_amount,wt_desc,rechage_category,recharge_number,operator_name,recharge_id,recharge_amount FROM `wallet_transaction` join recharge on recharge.recharge_transaction_id='".$trans_ref_no."' join operator_list on operator_list.operator_id=recharge.operator_id WHERE `wt_user_id` = '".$user_id."' AND `trans_ref_no` = '".$trans_ref_no."'"; 
                 $wt_trans=$this->login_model->get_simple_query($sql12);
                 $margin_trans[$i]->recharge_amount = $wt_trans[0]->recharge_amount;
                  $margin_trans[$i]->trans_Desc = $wt_trans[0]->wt_desc;
                   $margin_trans[$i]->rechage_category = $wt_trans[0]->rechage_category;
                  $margin_trans[$i]->recharge_number = $wt_trans[0]->recharge_number;
                  $margin_trans[$i]->operator_name = $wt_trans[0]->operator_name;
              }else{
                 $margin_trans[$i]->recharge_amount = '';
                  $margin_trans[$i]->trans_Desc = '';
                   $margin_trans[$i]->rechage_category = '';
                  $margin_trans[$i]->recharge_number ='';
                  $margin_trans[$i]->operator_name = '';
              }
              

                 $i++;
            }
        }
        $data['agent_transactions'] = $margin_trans;
        $this->load->view('admin/menu');
        $this->load->view('admin/header');
        $this->load->view('admin/listing/agent_transaction_list', $data);
        $this->load->view('admin/footer');
      //  $sql1="elect wt_amount from wallet_transaction where trans_ref_no= wallet_transaction.transaction_id";

    }
   function edit_agent_list()
   {

        $user_id = $_REQUEST['user_id'];
        $sql="SELECT user_name,user_email,user_id,agant_service,agent_id,agent_service_operator,agent_users.agent_margin,agent_created_date,operator_name,agent_status FROM `agent_users` join user on user.user_id=agent_users.agent_user_id join operator_list on operator_list.operator_id=agent_users.agent_service_operator where agent_user_id= $user_id"; 
        $data['agent_service_list']=$this->login_model->get_simple_query($sql);
        if(!empty($data['agent_service_list']))
        {
            foreach ($data['agent_service_list'] as  $value) {
               $service_id[]  = $value->agant_service;
               $operator_id[] = $value->agent_service_operator;
               $margin[]      = $value->agent_margin;
            }
        }
        $data['user_id'] = $user_id;
        $data['service_id'] = $service_id;
        $data['operator_records'] = $operator_id;
        $data['margin_records'] = $margin;
         $where1 = array("operator_status" => 1);
        $data['operator']=$this->login_model->get_data_where_condition('operator_list', $where1);
         $where11 = array("category_status" => 1);
        $data['recharge_category']=$this->login_model->get_data_where_condition('recharge_category', $where11);
        $this->load->view('admin/listing/ajax_edit_agent', $data);
   }
function edit_agent()
{
    if(!empty($this->input->post()))
    {
        $data = $this->input->post();
       if(!empty($data['operator']))
            {
               $delete_where = array('agent_user_id' => $data['user_id']);
               $delete = $this->login_model->delete_record('agent_users', $delete_where);
               $operator = $data['operator'];
               $margins = $data['margin'];
               for ($i=0; $i <count($operator) ; $i++) 
               { 
                  $operator_id                = $operator[$i];
                  $data12['agent_margin']     = $margins[$i];

                $where=array('operator_id'=>$operator_id);
                $category = $this->login_model->get_record_where('operator_list',$where);
                $data12['agant_service'] = $category[0]->recharge_category_id;
                $data12['agent_service_operator']=$operator_id;
                $data12['agent_user_id']          = $data['user_id'];
                $data12['agent_created_date']     = date("Y-m-d H:i:s"); 
                $this->login_model->insert_data('agent_users', $data12);
               }
            }
        $this->session->set_flashdata('status','Agent service information update successfully');
            redirect(base_url('Agents'));
    }
}
// main slider content///
	function main_content()
	{
		$data['main_content'] = $this->login_model->get_record('main_content');
	 	$this->load->view('admin/menu');
        $this->load->view('admin/header');
        $this->load->view('admin/listing/main_content', $data);
        $this->load->view('admin/footer');
	}
	function edit_main_content(){
    	if ($this->input->post('submit')) {
            $data = $this->input->post();
            $where = array('main_content_id' => $this->input->post('main_content_id'));
            unset($data['main_content_id']);
            unset($data['submit']);
            $operator_id = $this->input->post('main_content_id');
           
                $this->login_model->update_data('main_content', $data, $where);
                $this->session->set_flashdata('status', 'Slider content Update successfully');
            

            redirect('admin/main_content');
        } else {
            $category_id = $this->uri->segment(3);
            if (!empty($category_id)) {

                $where = array('main_content_id' => $category_id);
                $data['main_content'] = $this->login_model->get_data_where_condition('main_content', $where);
                $this->load->view('admin/menu');
                $this->load->view('admin/header');
                $this->load->view('admin/add/edit_main_content', $data);
                $this->load->view('admin/footer');
            } else {
                redirect('admin/main_content');
            }
        }
        }
/// Recharge main page content//
function recharge_content()
	{
		$data['recharge_content'] = $this->login_model->get_record('recharge_content');
	 	$this->load->view('admin/menu');
        $this->load->view('admin/header');
        $this->load->view('admin/listing/recharge_content', $data);
        $this->load->view('admin/footer');
	}
	function edit_recharge_content(){
    	if ($this->input->post('submit')) {
            $data = $this->input->post();
            $where = array('recharge_content_id' => $this->input->post('recharge_content_id'));
            unset($data['recharge_content_id']);
            unset($data['submit']);
            $operator_id = $this->input->post('recharge_content_id');
           
                $this->login_model->update_data('recharge_content', $data, $where);
                $this->session->set_flashdata('status', 'Recharge content Update successfully');
            

            redirect('admin/recharge_content');
        } else {
            $category_id = $this->uri->segment(3);
            if (!empty($category_id)) {

                $where = array('recharge_content_id' => $category_id);
                $data['recharge_content'] = $this->login_model->get_data_where_condition('recharge_content', $where);
                $this->load->view('admin/menu');
                $this->load->view('admin/header');
                $this->load->view('admin/add/edit_recharge_content', $data);
                $this->load->view('admin/footer');
            } else {
                redirect('admin/recharge_content');
            }
        }
        }
    function user_list() {
  		$where11 = array('user_read_status' => '2');
		$data21['user_read_status']='1';
        $this->login_model->update_data('user', $data21, $where11);
   	$where1 = array('user_mobile_verify_status'=>1);
   	$data['user_list'] = $this->login_model->get_column_data_where('user','', $where1,'user_id');
	 $sql="SELECT count(*) as day_user FROM user WHERE user_created_date > DATE_SUB(NOW(), INTERVAL 1 Day)"; 
		$data['day_user']=$this->login_model->get_simple_query($sql);
		 $sql1="SELECT count(*) as week_user FROM user WHERE user_created_date > DATE_SUB(NOW(), INTERVAL 1 WEEK)"; 
		$data['week_user']=$this->login_model->get_simple_query($sql1);
	 $sql2="SELECT count(*) as month_user FROM user WHERE user_created_date > DATE_SUB(NOW(), INTERVAL 1 MONTH)"; 
		$data['month_user']=$this->login_model->get_simple_query($sql2);
		$sql3="SELECT count(*) as year_user FROM user WHERE user_created_date > DATE_SUB(NOW(), INTERVAL 1 YEAR)"; 
		$data['year_user']=$this->login_model->get_simple_query($sql3);
        $where = array("category_status" => 1);
        $data['rec_cat']=$this->login_model->get_data_where_condition('recharge_category', $where);
        $where1 = array("operator_status" => 1);
        $data['operator']=$this->login_model->get_data_where_condition('operator_list', $where1);
         $where11 = array("category_status" => 1);
        $data['recharge_category']=$this->login_model->get_data_where_condition('recharge_category', $where11);
      	$this->load->view('admin/menu');
        $this->load->view('admin/header');
        $this->load->view('admin/listing/user_list_view', $data);
        $this->load->view('admin/footer');
    }
    function get_operator()
    {
        $rechage_category_id= $_REQUEST['service_id'];
        $where=array('operator_status'=>1,'recharge_category_id'=>$rechage_category_id);
        $data['operator'] = $this->login_model->get_record_where('operator_list',$where);
        $this->load->view('admin/listing/ajax_operator', $data);
    }
    function add_agant(){
        if($this->input->post())
        {
            $data = $this->input->post();
            if(!empty($data['operator']))
            {
               $operator = $data['operator'];
               $margins = $data['margin'];
               for ($i=0; $i <count($operator) ; $i++) 
               { 
                  $operator_id                = $operator[$i];
                  $data12['agent_margin']     = $margins[$i];

                $where=array('operator_id'=>$operator_id);
                $category = $this->login_model->get_record_where('operator_list',$where);
                $data12['agant_service'] = $category[0]->recharge_category_id;
                $data12['agent_service_operator']=$operator_id;
                $data12['agent_user_id']          = $data['user_id'];
                $data12['agent_created_date']     = date("Y-m-d H:i:s"); 
                $this->login_model->insert_data('agent_users', $data12);
               }
            }

            
            $data21212['is_agent'] = 1;
           
            $where = array('user_id'=>$data['user_id']);
            $this->login_model->update_data('user', $data21212, $where);
            $this->session->set_flashdata('status', 'Agent added successfully');
            redirect('admin/user_list');
        }
    }
    function cancel_agent()
    {
    	$user_id  = $_REQUEST['user_id'];
    	$data21212['is_agent'] = 2;
       // $data21212['agent_margin'] = $data['margin'];
        $where = array('user_id'=>$user_id);
        $this->login_model->update_data('user', $data21212, $where);
        $delete_where = array('agent_user_id' => $user_id);
        $data212['agent_status'] = 2;
        $this->login_model->update_data('agent_users', $data212, $delete_where);
        //$delete = $this->login_model->delete_record('agent_users', $delete_where);
    }
	function view_transaction()
	{
		$user_id = $this->uri->segment(4);
		$where1 = array('user_id' => $user_id);
		 $where2 = array('wt_user_id' => $user_id,'refund_status !=' =>1);
       		$data['user_record'] = $this->login_model->get_data_where_condition('user', $where1);
			$data['transaction_record']=$this->login_model->get_data_join_four_tabel_where_leftjoin('wallet_transaction','user','recharge','operator_list','user_id','wt_user_id','recharge_user_id','wt_user_id','operator_id','operator_id','wt_datetime',$where1,$column='','wt_id');
	
		$this->load->view('admin/menu');
        $this->load->view('admin/header');
        $this->load->view('admin/listing/add_money_transaction', $data);
        $this->load->view('admin/footer');
	}
   	function user_perticuler_transaction()
   	{
   		$trans_id = $this->uri->segment(3);
   		$user_id = $this->uri->segment(4);
		$where=array('wt_user_id'=>$user_id,'wt_id'=>$trans_id);
		$data['transaction_record']=$this->login_model->get_data_join_four_tabel_where_leftjoin('wallet_transaction','user','recharge','operator_list','user_id','wt_user_id','recharge_user_id','wt_user_id','operator_id','operator_id','',$where,$column='');
		
		$this->load->view('admin/menu');
        $this->load->view('admin/header');
        $this->load->view('admin/listing/view_user_transactions', $data);
        $this->load->view('admin/footer');
   }
		function view_perticuler_transaction(){
   		$trans_id = $this->uri->segment(3);
   		$user_id = $this->uri->segment(4);
		$where=array('wt_user_id'=>$user_id,'wt_id'=>$trans_id);
		$data['transaction_record']=$this->login_model->get_data_join_four_tabel_where_leftjoin('wallet_transaction','user','recharge','operator_list','user_id','wt_user_id','recharge_transaction_id','transaction_id','operator_id','operator_id','',$where,$column='');
		
		$this->load->view('admin/menu');
        $this->load->view('admin/header');
        $this->load->view('admin/listing/view_user_transactions', $data);
        $this->load->view('admin/footer');
   }
	function GuestUser()
	{
		$sql3="SELECT * from guest_user order by guest_user_id DESC"; 
		$data['guest_user']=$this->login_model->get_simple_query($sql3);
		$this->load->view('admin/menu');
        $this->load->view('admin/header');
        $this->load->view('admin/listing/guest_user', $data);
        $this->load->view('admin/footer');
	}
    function recharge_category_list() {
        $data['category_list'] = $this->login_model->get_column_data_where('recharge_category');
        $this->load->view('admin/menu');
        $this->load->view('admin/header');
        $this->load->view('admin/listing/rec_category_list_view', $data);
        $this->load->view('admin/footer');
    }
	function add_recharge_category(){
		   if ($this->input->post('submit')) {
            $data = $this->input->post();
            unset($data['submit']);
			//$data['status']=1;
            $ch = array("category_name" => strtoupper($this->input->post("category_name")));
            $rec = $this->login_model->get_data_where_condition('recharge_category', $ch);
            if (empty($rec)) {
                $this->login_model->insert_data('recharge_category', $data);
                $this->session->set_flashdata('status', 'Recharge Category added successfully');
             } else {
                $this->session->set_flashdata('error', 'Recharge Category already exist');
            }
            redirect('admin/recharge_category_list');
        } else {
            
            $this->load->view('admin/menu');
            $this->load->view('admin/header');
            $this->load->view('admin/add/add_recharge_category');
            $this->load->view('admin/footer');
        }
	}
	function edit_recharge_category() {
        if ($this->input->post('submit')) {
            $data = $this->input->post();
            $where = array('recharge_category_id' => $this->input->post('recharge_category_id'));
            unset($data['recharge_category_id']);
            unset($data['submit']);
            $operator_id = $this->input->post('recharge_category_id');
            $name = $this->input->post('category_name');
            $where = array('recharge_category_id' => $operator_id);

            $data1 = array('category_name' => strtoupper($name), 'recharge_category_id !=' => $operator_id);
            $rec = $this->login_model->get_data_where_condition('recharge_category', $data1);
            if (empty($rec)) {
                unset($data['recharge_category_id']);
                unset($data['submit']);
                $this->login_model->update_data('recharge_category', $data, $where);
                $this->session->set_flashdata('status', 'Recharge Category Update successfully');
             } else {
                $this->session->set_flashdata('error', 'Recharge Category already exist');
            }

            redirect('admin/recharge_category_list');
        } else {
            $category_id = $this->uri->segment(3);
            if (!empty($category_id)) {

                $where = array('recharge_category_id' => $category_id);
                $data['recharge_category'] = $this->login_model->get_data_where_condition('recharge_category', $where);
                $this->load->view('admin/menu');
                $this->load->view('admin/header');
                $this->load->view('admin/add/add_recharge_category', $data);
                $this->load->view('admin/footer');
            } else {
                redirect('admin/recharge_category_list');
            }
        }
    }
    function recharge_type_list() {
        $data['recharge_type_list'] = $this->login_model->get_record_join_two_table('recharge_category', 'recharge_type', 'recharge_category_id', 'recharge_category_id','*',''); 
		$this->load->view('admin/menu');
        $this->load->view('admin/header');
        $this->load->view('admin/listing/recharge_type_list', $data);
        $this->load->view('admin/footer');
    }
	function add_recharge_type(){
		   if ($this->input->post('submit')) {
            $data = $this->input->post();
            unset($data['submit']);
			 $this->login_model->insert_data('recharge_type', $data);
                $this->session->set_flashdata('status', 'Recharge Category added successfully');
                 redirect('admin/recharge_type_list');
        } else {
        	$where=array('category_status'=>1);
            $data['recharge_category'] = $this->login_model->get_record_where('recharge_category',$where);
            $this->load->view('admin/menu');
            $this->load->view('admin/header');
            $this->load->view('admin/add/add_recharge_type',$data);
            $this->load->view('admin/footer');
        }
	}
	function edit_recharge_type() {
        if ($this->input->post('submit')) {
            $data = $this->input->post();
            $where = array('recharge_type_id' => $this->input->post('recharge_type_id'));
            unset($data['recharge_type_id']);
            unset($data['submit']);
            $operator_id = $this->input->post('recharge_type_id');
            $name = $this->input->post('recharge_type');
            $where = array('recharge_type_id' => $operator_id);
// 
            // $data1 = array('category_name' => strtoupper($name), 'recharge_category_id !=' => $operator_id);
           		unset($data['recharge_type_id']);
                unset($data['submit']);
                $this->login_model->update_data('recharge_type', $data, $where);
                $this->session->set_flashdata('status', 'Recharge Type Update successfully');
             	redirect('admin/recharge_type_list');
        } else {
            $category_id = $this->uri->segment(3);
            if (!empty($category_id)) {
				$where_type=array('category_status'=>1);
            $data['recharge_category'] = $this->login_model->get_record_where('recharge_category',$where_type);
                $where = array('recharge_type_id' => $category_id);
                $data['recharge_type'] = $this->login_model->get_data_where_condition('recharge_type', $where);
                $this->load->view('admin/menu');
                $this->load->view('admin/header');
                $this->load->view('admin/add/add_recharge_type', $data);
                $this->load->view('admin/footer');
            } else {
                redirect('admin/recharge_category_list');
            }
        }
    }
 function operator_list() {
        $data['operator_list'] = $this->login_model->get_record_join_two_table('recharge_category', 'operator_list', 'recharge_category_id', 'recharge_category_id','*',''); 
		$this->load->view('admin/menu');
        $this->load->view('admin/header');
        $this->load->view('admin/listing/operator_list', $data);
        $this->load->view('admin/footer');
    }
 function add_operator(){
		   if ($this->input->post('submit')) {
            $data = $this->input->post();
            unset($data['submit']);
			   $path="http://".$_SERVER['HTTP_HOST']."/uploads/operator/";
	   		$user_image = '';
			if ($_FILES['operator_image']['name']) {
                $user_image = $_FILES['operator_image']['name'];
            }
            $attachment = $_FILES['operator_image']['name'];

            if (!empty($attachment)) {
                $file_extension = explode(".", $_FILES["operator_image"]["name"]);
                $new_extension = strtolower(end($file_extension));
                $today = time();
                $custom_name = "operator_img" . $today;
                $file_name = $custom_name . "." . $new_extension;

                if ($new_extension == 'png' || $new_extension == 'jpeg' || $new_extension == 'jpg' || $new_extension == 'bmp') {
                    move_uploaded_file($_FILES['operator_image']['tmp_name'], "./uploads/operator/" . $file_name);
                    $imagename = $file_name;
                } else {
                    $this->session->set_flashdata('error', 'Invalid Image type');
                    redirect('admin/operator_list');
                }
            }
            $data['operator_image'] = $imagename;
                $this->login_model->insert_data('operator_list', $data);
                $this->session->set_flashdata('status', 'Operator added successfully');
           		 redirect('admin/operator_list');
        } else {
        	$where=array('category_status'=>1);
            $data['recharge_category'] = $this->login_model->get_record_where('recharge_category',$where);
            $this->load->view('admin/menu');
            $this->load->view('admin/header');
            $this->load->view('admin/add/add_operator',$data);
            $this->load->view('admin/footer');
        }
	}
	function edit_operator() {
        if ($this->input->post('submit')) {
            $data = $this->input->post();
            $where = array('operator_id' => $this->input->post('operator_id'));
            unset($data['operator_id']);
            unset($data['submit']);
            $operator_id = $this->input->post('operator_id');
            $name = $this->input->post('operator_list');
            $where = array('operator_id' => $operator_id);
		  	$path="http://".$_SERVER['HTTP_HOST']."/uploads/operator/";
	   		$user_image = '';
			if ($_FILES['operator_image']['name']) {
                $user_image = $_FILES['operator_image']['name'];
            }
            $attachment = $_FILES['operator_image']['name'];

            if (!empty($attachment)) {
                $file_extension = explode(".", $_FILES["operator_image"]["name"]);
                $new_extension = strtolower(end($file_extension));
                $today = time();
                $custom_name = "operator_img" . $today;
                $file_name = $custom_name . "." . $new_extension;

                if ($new_extension == 'png' || $new_extension == 'jpeg' || $new_extension == 'jpg' || $new_extension == 'bmp') {
                    move_uploaded_file($_FILES['operator_image']['tmp_name'], "./uploads/operator/" . $file_name);
                    $imagename = $file_name;
                } else {
                    $this->session->set_flashdata('error', 'Invalid Image type');
                    redirect('admin/operator_list');
                }
				 $data['operator_image'] = $imagename;
            }
           
                unset($data['operator_id']);
                unset($data['submit']);
                $this->login_model->update_data('operator_list', $data, $where);
                $this->session->set_flashdata('status', 'Operator Update successfully');
             // } else {
                // $this->session->set_flashdata('error', 'Recharge Category already exist');
            // }

            redirect('admin/operator_list');
        } else {
            $category_id = $this->uri->segment(3);
            if (!empty($category_id)) {
				$where_type=array('category_status'=>1);
            $data['recharge_category'] = $this->login_model->get_record_where('recharge_category',$where_type);
                $where = array('operator_id' => $category_id);
                $data['operator'] = $this->login_model->get_data_where_condition('operator_list', $where);
                $this->load->view('admin/menu');
                $this->load->view('admin/header');
                $this->load->view('admin/add/add_operator', $data);
                $this->load->view('admin/footer');
            } else {
                redirect('admin/operator_list');
            }
        }
    }
 	function coupon_list() {
  		$data['coupon_list'] = $this->login_model->get_record('offer_coupon');
	 	$this->load->view('admin/menu');
        $this->load->view('admin/header');
        $this->load->view('admin/listing/coupon_list_view', $data);
        $this->load->view('admin/footer');
    }
	function add_coupon() {
        if ($this->input->post('submit')) {
            $data = $this->input->post();
            unset($data['submit']);
			$data['coupon_create_date']=date("y-m-d");
            //$ch = array("brand_type_name" => strtoupper($this->input->post("brand_type_name")));
            //$rec = $this->login_model->get_data_where_condition('brand_type', $ch);
           // if (empty($rec)) {
                $this->login_model->insert_data('offer_coupon', $data);
                $this->session->set_flashdata('status', 'Coupon  added successfully');
            // } else {
            //    $this->session->set_flashdata('error', 'Brand Type already exist');
           // }
            redirect('admin/coupon_list');
        } else {
            
            $this->load->view('admin/menu');
            $this->load->view('admin/header');
            $this->load->view('admin/add/add_coupon');
            $this->load->view('admin/footer');
        }
    }
	function edit_coupon() {
        if ($this->input->post('submit')) {
            $data = $this->input->post();
            $where = array('coupon_id' => $this->input->post('coupon_id'));
            unset($data['coupon_id']);
            unset($data['submit']);
             $this->login_model->update_data('offer_coupon', $data, $where);
                $this->session->set_flashdata('status', 'Coupon Update successfully');
           

            redirect('admin/coupon_list');
        } else {
            $category_id = $this->uri->segment(3);
            if (!empty($category_id)) {

                $where = array('coupon_id' => $category_id);
                $data['coupon_details'] = $this->login_model->get_data_where_condition('offer_coupon', $where);
                $this->load->view('admin/menu');
                $this->load->view('admin/header');
                $this->load->view('admin/add/add_coupon', $data);
                $this->load->view('admin/footer');
            } else {
                redirect('admin/coupon_list');
            }
        }
    }
/// function of free coupon list//... like as pizza or other
function free_coupon_list() {
	 $data['free_coupon_list'] = $this->login_model->get_record_join_two_table('free_coupon_category', 'free_coupon_list', 'free_coupon_category_id', 'fee_coupon_category_id','*',''); 
		$this->load->view('admin/menu');
        $this->load->view('admin/header');
        $this->load->view('admin/listing/free_coupon_list_view', $data);
        $this->load->view('admin/footer');
    }
function add_free_coupon() {
        if ($this->input->post('submit')) {
            $data = $this->input->post();
            unset($data['submit']);
			$data['coupon_create_date']=date("y-m-d");
			 $user_image = '';
			if ($_FILES['coupon_img']['name']) {
                $user_image = $_FILES['coupon_img']['name'];
            }
            $attachment = $_FILES['coupon_img']['name'];

            if (!empty($attachment)) {
                $file_extension = explode(".", $_FILES["coupon_img"]["name"]);
                $new_extension = strtolower(end($file_extension));
                $today = time();
                $custom_name = "coupon_img" . $today;
                $file_name = $custom_name . "." . $new_extension;

                if ($new_extension == 'png' || $new_extension == 'jpeg' || $new_extension == 'jpg' || $new_extension == 'bmp') {
                    move_uploaded_file($_FILES['coupon_img']['tmp_name'], "./uploads/coupon_img/" . $file_name);
                    $imagename = $file_name;
                } else {
                    $this->session->set_flashdata('error', 'Invalid Image type');
                    redirect('admin/free_coupon_list');
                }
				  $data['coupon_img'] = $imagename;
            }
			/*
				 //------------------Image Uploading-------------------//
									 $config['upload_path'] = './uploads/coupon_img/';
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
			//                $config['max_size']    = '100';
							$config['max_width']  = '600';
							$config['max_height']  = '600';
									 $file_extension = end(explode(".", $_FILES["coupon_img"]["name"]));
						$new_extension = strtolower($file_extension);
						$today = time();
						$custom_name = "coupon_img" . $today;
						$file_name = $custom_name . "." . $new_extension;
						$config['file_name'] = $file_name;
						$this->load->library('upload', $config);
						$this->upload->do_upload('coupon_img', $config);
					   /*
						if (!$this->upload->do_upload('coupon_img', $config)) {
									   $file_name = '';
									   $this->session->set_flashdata('error', 'Maximum uploading 600*600 size image.');
									   redirect('admin/free_coupon_list');
								   }
											   $data['coupon_img'] = $file_name;*/
			
           $this->login_model->insert_data('free_coupon_list', $data);
           $this->session->set_flashdata('status', 'Coupon  added successfully');
           redirect('admin/free_coupon_list');
        } else {
             $where = array('free_coupon_category_status' => '1');
                $data['coupon_category'] = $this->login_model->get_data_where_condition('free_coupon_category', $where);
			$this->load->view('admin/menu');
            $this->load->view('admin/header');
            $this->load->view('admin/add/add_free_coupon',$data);
            $this->load->view('admin/footer');
        }
    }
function edit_free_coupon() {
        if ($this->input->post('submit')) {
            $data = $this->input->post();
            $where = array('free_coupon_id' => $this->input->post('free_coupon_id'));
            unset($data['free_coupon_id']);
            unset($data['submit']);
			  $user_image = '';
			if ($_FILES['coupon_img']['name']) {
                $user_image = $_FILES['coupon_img']['name'];
            }
            $attachment = $_FILES['coupon_img']['name'];

            if (!empty($attachment)) {
                $file_extension = explode(".", $_FILES["coupon_img"]["name"]);
                $new_extension = strtolower(end($file_extension));
                $today = time();
                $custom_name = "coupon_img" . $today;
                $file_name = $custom_name . "." . $new_extension;

                if ($new_extension == 'png' || $new_extension == 'jpeg' || $new_extension == 'jpg' || $new_extension == 'bmp') {
                    move_uploaded_file($_FILES['coupon_img']['tmp_name'], "./uploads/coupon_img/" . $file_name);
                    $imagename = $file_name;
                } else {
                    $this->session->set_flashdata('error', 'Invalid Image type');
                    redirect('admin/free_coupon_list');
                }
				  $data['coupon_img'] = $imagename;
            }
          
             $this->login_model->update_data('free_coupon_list', $data, $where);
                $this->session->set_flashdata('status', 'Coupon Update successfully');
           

            redirect('admin/free_coupon_list');
        } else {
            $category_id = $this->uri->segment(3);
            if (!empty($category_id)) {
$where = array('free_coupon_category_status' => '1');
                $data['coupon_category'] = $this->login_model->get_data_where_condition('free_coupon_category', $where);
                $where = array('free_coupon_id' => $category_id);
                $data['coupon_details'] = $this->login_model->get_data_where_condition('free_coupon_list', $where);
                $this->load->view('admin/menu');
                $this->load->view('admin/header');
                $this->load->view('admin/add/add_free_coupon', $data);
                $this->load->view('admin/footer');
            } else {
                redirect('admin/free_coupon_list');
            }
        }
    }
   function transaction_list(){
   		$where11 = array('trans_read_status' => '2');
		$data21['trans_read_status']='1';
        $this->login_model->update_data('wallet_transaction', $data21, $where11);
	
    $data['operator_list'] = $this->login_model->get_record('operator_list');
    $where=array('refund_status !=' =>1);
	$data['wallet_transaction'] = $this->login_model->get_record_join_two_table('wallet_transaction', 'user', 'wt_user_id', 'user_id','*',$where,'wt_id'); 
   if(!empty($data['wallet_transaction']))
   {
    $i=0;
        foreach ($data['wallet_transaction'] as  $value) {
           if($value->transaction_user_type=='2')
           {
            $sqlqqq="select guest_user_email,guest_user_mobile from guest_user where guest_user_id='".$value->wt_user_id."'";
                $recordsGuest=$this->login_model->get_simple_query($sqlqqq);
                if(!empty($recordsGuest))
                {
                        $data['wallet_transaction'][$i]->user_name=$recordsGuest[0]->guest_user_email;
                        $data['wallet_transaction'][$i]->user_email=$recordsGuest[0]->guest_user_mobile;
                        $data['wallet_transaction'][$i]->user_contact_no=$recordsGuest[0]->guest_user_mobile;
                }
           }
           $i++;
        }
   }
    $sql="SELECT count(*) as day_user FROM wallet_transaction WHERE wt_datetime > DATE_SUB(NOW(), INTERVAL 1 Day)"; 
		$data['day_user']=$this->login_model->get_simple_query($sql);
		 $sql1="SELECT count(*) as week_user FROM wallet_transaction WHERE wt_datetime > DATE_SUB(NOW(), INTERVAL 1 WEEK)"; 
		$data['week_user']=$this->login_model->get_simple_query($sql1);
	 $sql2="SELECT count(*) as month_user FROM wallet_transaction WHERE wt_datetime > DATE_SUB(NOW(), INTERVAL 1 MONTH)"; 
		$data['month_user']=$this->login_model->get_simple_query($sql2);
		$sql3="SELECT count(*) as year_user FROM wallet_transaction WHERE wt_datetime > DATE_SUB(NOW(), INTERVAL 1 YEAR)"; 
		$data['year_user']=$this->login_model->get_simple_query($sql3);
   
		$this->load->view('admin/menu');
        $this->load->view('admin/header');
        $this->load->view('admin/listing/transaction_list_view', $data);
        $this->load->view('admin/footer');
   }

   

      function transaction_list_fail(){
       
    
  //  $data['payment_transaction'] = $this->login_model->get_record('payment_transaction');
    $where=array('pay_trans_status' =>'Failed');

    $data['wallet_transaction'] = $this->login_model->get_record_join_two_table('payment_transaction', 'user', 'pay_trans_userid', 'user_id','*', $where,'pay_trans_id'); 

   // if(!empty($data['wallet_transaction']))
   // {
   //  $i=0;
   //      foreach ($data['wallet_transaction'] as  $value) {
   //         if($value->transaction_user_type=='2')
   //         {
   //          $sqlqqq="select guest_user_email,guest_user_mobile from guest_user where guest_user_id='".$value->wt_user_id."'";
   //              $recordsGuest=$this->login_model->get_simple_query($sqlqqq);
   //              if(!empty($recordsGuest))
   //              {
   //                      $data['wallet_transaction'][$i]->user_name=$recordsGuest[0]->guest_user_email;
   //                      $data['wallet_transaction'][$i]->user_email=$recordsGuest[0]->guest_user_mobile;
   //                      $data['wallet_transaction'][$i]->user_contact_no=$recordsGuest[0]->guest_user_mobile;
   //              }
   //         }
   //         $i++;
   //      }
   // }
  
   //print_r($data);
   //die();

        $this->load->view('admin/menu');
        $this->load->view('admin/header');
        $this->load->view('admin/listing/transaction_list_view_fail', $data);
        $this->load->view('admin/footer');
   }
   function ajax_transaction_filter() {
	$date = $this->input->post('date');
	$operator_id = $this->input->post('operator_id');
	$recharge_type = $this->input->post('recharge_type');
	$recharge_status = $this->input->post('recharge_status');
	$transaction_type = $this->input->post('transaction_type');
    $user_type = $this->input->post('user_type');
	if(!empty($date)){
	    $new=explode('-', $date);
	    $start_date = $new[0];
	    $first_date = date('Y-m-d H:i:s', strtotime($start_date)) ;

	    $end_date = $new[1];
	    $plus_date = strtotime("+1 day", strtotime($end_date));
	    $todate = date("Y-m-d", $plus_date);
	    $second_date = date('Y-m-d H:i:s', strtotime($todate));
	
	}else{
	    $first_date='';
	    $second_date='';
	}
	
	$where = "";			
            
	$query = "SELECT * FROM `wallet_transaction` JOIN `user` ON `wallet_transaction`.`wt_user_id`=`user`.`user_id` ";
	$conditions = array();

	if(!empty($operator_id)) {
	    $conditions[] = "`operator_id` = '". $operator_id ."'";
	    $where['operator_id'] = $operator_id;
	} 
	if(!empty($recharge_type)) {
	   $conditions[] = "`rechage_category` = '". $recharge_type ."'";
	   $where['rechage_category'] = $recharge_type;
	} 
	if(!empty($recharge_status)) {
	    $conditions[] = "`wt_status` = '". $recharge_status."'";
	    $where['wt_status'] = $recharge_status;
	}
	if(!empty($transaction_type)) {
	    $conditions[] = "`wt_category` = '". $transaction_type."'";
	    $where['wt_category'] = $transaction_type;
	}
	if(!empty($user_type)) {
        $conditions[] = "`transaction_user_type` = '". $user_type."'";
        $where['transaction_user_type'] = $user_type;
    }
	$sql = $query;
	if (count($conditions) > 0) {
	    $sql .= " WHERE " . implode(' AND ', $conditions); 
	}
	
	if($first_date !='' && $second_date !='')
	$sql .= " AND `wt_datetime` BETWEEN '". $first_date ."' AND '". $second_date."'";
	//echo $sql;die;
	$arr = $this->login_model->get_simple_query($sql);
	$data['wallet_transaction'] = $arr;
	$this->load->view('admin/ajax_transaction_filter_view', $data);
   }
   // function wallet to bank transaction list
   function wallet_bank_trans()
   {
        $query = "SELECT wallet_bank_transactions.*,user.user_name FROM `wallet_bank_transactions` JOIN `user` ON `wallet_bank_transactions`.`wallet_bank_trans_user_id`=`user`.`user_id`  ";
        $arr = $this->login_model->get_simple_query($query);
        $data['wallet_transactions'] = $arr;
        $this->load->view('admin/menu');
        $this->load->view('admin/header');
        $this->load->view('admin/listing/wallet_bank_trans', $data);
        $this->load->view('admin/footer');
   }
   /// refund from admin to user
   function refund(){
   	
   	 $user_id = $_POST['user_id']; 
	 $wt_trans_id = $_POST['wallet_id'];
	  $where = array('wt_id' => $wt_trans_id);
	 $transaction = $this->login_model->get_record_join_two_table('wallet_transaction', 'user', 'wt_user_id', 'user_id','*',$where); 
	
    $admin= $this->login_model->get_record('admin');
	$admin_wallet=$admin[0]->admin_wallet;
	 $data['wt_amount']=$transaction[0]->wt_amount;
	 $data['wt_datetime']=date("Y-m-d h:i:sa");
	 $data['wt_category']='3';
	 $data['wt_user_id']=$user_id;
	 $data['wt_desc']="Payment Refund because recharge transaction failed";
	 $user_wallet=$transaction[0]->wallet_amount;
	 $transfer=$this->login_model->insert_data('wallet_transaction', $data);
	
	 if(!empty($transfer)){
	 
	 	$datauser['wallet_amount']=$user_wallet+$transaction[0]->wt_amount;
		$where_user=array('user_id'=>$user_id);
		
		 $this->login_model->update_data('user',$datauser,$where_user);
		
		 $data1['admin_wallet']=$admin_wallet-$transaction[0]->wt_amount;
		 $where_admin=array('admin_status'=>1);
		  $this->login_model->update_data('admin', $data1,$where_admin);
	$refund_status['refund_status']=1;
		   $where_trans=array('wt_id'=>$wt_trans_id);
	//	print_r( $data_ref['refund_status']);die;
		   $this->login_model->update_data('wallet_transaction',$refund_status,$where_trans);
		echo 1;
	 }else{
	 	echo 2;
	 }
                
   }
   
   
    function add_category() {
        if ($this->input->post('submit')) {
            $data = $this->input->post();
            $n_width = 200;
            $n_height = 200;
           $path="http://".$_SERVER['HTTP_HOST']."/violet/uploads/category/";
	   		$user_image = '';
			if ($_FILES['category_image']['name']) {
                $user_image = $_FILES['category_image']['name'];
            }
            $attachment = $_FILES['category_image']['name'];

            if (!empty($attachment)) {
                $file_extension = explode(".", $_FILES["category_image"]["name"]);
                $new_extension = strtolower(end($file_extension));
                $today = time();
                $custom_name = "category_img" . $today;
                $file_name = $custom_name . "." . $new_extension;

                if ($new_extension == 'png' || $new_extension == 'jpeg' || $new_extension == 'jpg' || $new_extension == 'bmp') {
                    move_uploaded_file($_FILES['category_image']['tmp_name'], "./uploads/category/" . $file_name);
                    $imagename = $file_name;
                } else {
                    $this->session->set_flashdata('error', 'Invalid Image type');
                    redirect('admin/category_list');
                }
            }
            $data['category_image'] = $imagename;

            unset($data['submit']);

            $ch = array("category_name" => strtoupper($this->input->post("category_name")));
            $rec = $this->login_model->get_data_where_condition('category', $ch);
            if (empty($rec)) {
                $this->login_model->insert_data('category', $data);
                $this->session->set_flashdata('status', 'Category added successfully');
                $path = './uploads/category/';
                $path1 = './uploads/category/thumb_img/';
                $this->createThumbs($path, $path1, $file_name);
            } else {
                $this->session->set_flashdata('error', 'Category already exist');
            }
            redirect('admin/category_list');
        } else {
            $this->load->view('admin/menu');
            $this->load->view('admin/header');
            $this->load->view('admin/add/add_category');
            $this->load->view('admin/footer');
        }
    }

    function createThumbs($pathToImages, $pathToThumbs, $fname) {

        // parse path for the extension
        $info = pathinfo($pathToImages . $fname);

        // continue only if this is a JPEG image
        if (strtolower($info['extension']) == 'jpg') {
            // echo "Creating thumbnail for {$fname} <br />";
            // load image and get image size
            $img = imagecreatefromjpeg("{$pathToImages}{$fname}");
            $width = imagesx($img);
            $height = imagesy($img);

            // calculate thumbnail size
            $new_width = 100;
            $new_height = 100;

            // create a new temporary image
            $tmp_img = imagecreatetruecolor($new_width, $new_height);

            // copy and resize old image into new image
            imagecopyresized($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

            // save thumbnail into a file
            imagejpeg($tmp_img, "{$pathToThumbs}{$fname}");
        } else if (strtolower($info['extension']) == 'png') {
            // load image and get image size
            $img = imagecreatefrompng("{$pathToImages}{$fname}");
            $width = imagesx($img);
            $height = imagesy($img);

            // calculate thumbnail size
            $new_width = 100;
            $new_height = 100;

            // create a new temporary image
            $tmp_img = imagecreatetruecolor($new_width, $new_height);

            // copy and resize old image into new image
            imagecopyresized($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

            // save thumbnail into a file
            imagepng($tmp_img, "{$pathToThumbs}{$fname}");
        } else if (strtolower($info['extension']) == 'gif') {
            // load image and get image size
            $img = imagecreatefromgif("{$pathToImages}{$fname}");
            $width = imagesx($img);
            $height = imagesy($img);

            // calculate thumbnail size
            $new_width = $thumbWidth;
            $new_height = floor($height * ($thumbWidth / $width));

            // create a new temporary image
            $tmp_img = imagecreatetruecolor($new_width, $new_height);

            // copy and resize old image into new image
            imagecopyresized($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

            // save thumbnail into a file
            imagegif($tmp_img, "{$pathToThumbs}{$fname}");
        }
    }

    function edit_category() {
        if ($this->input->post('submit')) {
            $data = $this->input->post();
            $where = array('operator_id' => $this->input->post('category_id'));
            unset($data['category_id']);
            unset($data['submit']);

            $user_image = '';

            if ($_FILES['category_image']['name']) {
                $user_image = $_FILES['category_image']['name'];
            }
            $attachment = $_FILES['category_image']['name'];

            if (!empty($attachment)) {
                $file_extension = explode(".", $_FILES["category_image"]["name"]);
                $new_extension = strtolower(end($file_extension));
                $today = time();
                $custom_name = "category_img" . $today;
                $file_name = $custom_name . "." . $new_extension;

                if ($new_extension == 'png' || $new_extension == 'jpeg' || $new_extension == 'jpg' || $new_extension == 'bmp') {
                    move_uploaded_file($_FILES['category_image']['tmp_name'], "./uploads/category/" . $file_name);
                    $imagename = $file_name;
                } else {
                    $this->session->set_flashdata('error', 'Invalid Image type');
                    redirect('admin/category_list');
                }
            } else {
                $imagename = $this->input->post('category_image');
            }
            $data['category_image'] = $imagename;

            $operator_id = $this->input->post('category_id');
            $name = $this->input->post('category_name');
            $where = array('category_id' => $operator_id);

            $data1 = array('category_name' => strtoupper($name), 'category_id !=' => $operator_id);

            $rec = $this->login_model->get_data_where_condition('category', $data1);
            if (empty($rec)) {
                unset($data['category_id']);
                unset($data['submit']);
                $this->login_model->update_data('category', $data, $where);
                $this->session->set_flashdata('status', 'category Update successfully');
                $path = category_image;
                $path1 = category_thumb_image;

               // $this->createThumbs($path, $path1, $file_name);
            } else {
                $this->session->set_flashdata('error', 'category already exist');
            }

            redirect('admin/category_list');
        } else {
            $category_id = $this->uri->segment(3);
            if (!empty($category_id)) {

                $where = array('category_id' => $category_id);
                $data['category_details'] = $this->login_model->get_data_where_condition('category', $where);
                $this->load->view('admin/menu');
                $this->load->view('admin/header');
                $this->load->view('admin/add/add_category', $data);
                $this->load->view('admin/footer');
            } else {
                redirect('admin/category_list');
            }
        }
    }

  function about_us(){
  	$where = array('about_us_status' =>1);
        $data['about_us'] = $this->login_model->get_data_where_condition('about_us',$where);
		$this->load->view('admin/menu');
        $this->load->view('admin/header');
        $this->load->view('admin/listing/about_us_view', $data);
        $this->load->view('admin/footer');
  }
  function edit_about_content(){
    if ($this->input->post('submit')) {
            $data = $this->input->post();
            $where = array('about_us_id' => $this->input->post('about_us_id'));
            unset($data['about_us_id']);
            unset($data['submit']);
            $operator_id = $this->input->post('about_us_id');
            $name = $this->input->post('title');
            $where = array('about_us_id' => $operator_id);

            
                unset($data['about_us_id']);
                unset($data['submit']);
                $this->login_model->update_data('about_us', $data, $where);
                $this->session->set_flashdata('status', 'About us content Update successfully');
            

            redirect('admin/about_us');
        } else {
            $category_id = $this->uri->segment(3);
            if (!empty($category_id)) {

                $where = array('about_us_id' => $category_id);
                $data['about_us'] = $this->login_model->get_data_where_condition('about_us', $where);
                $this->load->view('admin/menu');
                $this->load->view('admin/header');
                $this->load->view('admin/add/add_about_content', $data);
                $this->load->view('admin/footer');
            } else {
                redirect('admin/about_us');
            }
        }
        }
function privecy_policy() {
  		$where = array('privacy_status' =>1);
        $data['privecy_policy'] = $this->login_model->get_data_where_condition('privacy_policy',$where);
		$this->load->view('admin/menu');
        $this->load->view('admin/header');
        $this->load->view('admin/listing/privecy_policy_view', $data);
        $this->load->view('admin/footer');
    }
  function edit_privecy_policy_content() {
        if ($this->input->post('submit')) {
            $data = $this->input->post();
            $where = array('privecy_policy_id' => $this->input->post('privecy_policy_id'));
            unset($data['privecy_policy_id']);
            unset($data['submit']);
            $operator_id = $this->input->post('privecy_policy_id');
            $name = $this->input->post('title');
            $where = array('privecy_policy_id' => $operator_id);

            
                unset($data['privecy_policy_id']);
                unset($data['submit']);
                $this->login_model->update_data('privacy_policy', $data, $where);
                $this->session->set_flashdata('status', 'Privecy policy Update successfully');
            

            redirect('admin/privecy_policy');
        } else {
            $category_id = $this->uri->segment(3);
            if (!empty($category_id)) {

                $where = array('privecy_policy_id' => $category_id);
                $data['privecy_policy'] = $this->login_model->get_data_where_condition('privacy_policy', $where);
                $this->load->view('admin/menu');
                $this->load->view('admin/header');
                $this->load->view('admin/add/add_privecy_policy_content', $data);
                $this->load->view('admin/footer');
            } else {
                redirect('admin/privecy_policy');
            }
        }
    }
function terms_conditions() {
  		$where = array('terms_status' =>1);
        $data['terms_conditions'] = $this->login_model->get_data_where_condition('terms_conditions',$where);
		
		$this->load->view('admin/menu');
        $this->load->view('admin/header');
        $this->load->view('admin/listing/terms_conditions_view', $data);
        $this->load->view('admin/footer');
    }
  function edit_terms_conditions() {
        if ($this->input->post('submit')) {
            $data = $this->input->post();
            $where = array('terms_id' => $this->input->post('terms_conditions_id'));
            unset($data['terms_conditions_id']);
        	 unset($data['submit']);
                $this->login_model->update_data('terms_conditions', $data, $where);
                $this->session->set_flashdata('status', 'Terms & Condtions Update successfully');
            

            redirect('admin/terms_conditions');
        } else {
            $category_id = $this->uri->segment(3);
            if (!empty($category_id)) {

                $where = array('terms_id' => $category_id);
                $data['terms_conditions'] = $this->login_model->get_data_where_condition('terms_conditions', $where);
                $this->load->view('admin/menu');
                $this->load->view('admin/header');
                $this->load->view('admin/add/add_terms_conditions', $data);
                $this->load->view('admin/footer');
            } else {
                redirect('admin/terms_conditions');
            }
        }
    }
function contact_us() {
  		$where = array('contact_us_status' =>1);
        $data['contact_us'] = $this->login_model->get_data_where_condition('contact_us',$where);
		$this->load->view('admin/menu');
        $this->load->view('admin/header');
        $this->load->view('admin/listing/contact_us_view', $data);
        $this->load->view('admin/footer');
    }
  function edit_contact_us() {
        if ($this->input->post('submit')) {
            $data = $this->input->post();
            $where = array('contact_us_id' => $this->input->post('contact_us_id'));
            unset($data['contact_us_id']);
            unset($data['submit']);
            $operator_id = $this->input->post('contact_us_id');
            $name = $this->input->post('title');
            $where = array('contact_us_id' => $operator_id);

            
                unset($data['contact_us_id']);
                unset($data['submit']);
                $this->login_model->update_data('contact_us', $data, $where);
                $this->session->set_flashdata('status', 'Contact Us details Update successfully');
            

            redirect('admin/contact_us');
        } else {
            $category_id = $this->uri->segment(3);
            if (!empty($category_id)) {

                $where = array('contact_us_id' => $category_id);
                $data['contact_us'] = $this->login_model->get_data_where_condition('contact_us', $where);
                $this->load->view('admin/menu');
                $this->load->view('admin/header');
                $this->load->view('admin/add/add_contact_us', $data);
                $this->load->view('admin/footer');
            } else {
                redirect('admin/contact_us');
            }
        }
    }
// biller category list//////
function biller_category(){
		$data['biller_category'] = $this->login_model->get_record_where_orderby('biller_category','biller_category_id');
	 	$this->load->view('admin/menu');
        $this->load->view('admin/header');
        $this->load->view('admin/listing/biller_category', $data);
        $this->load->view('admin/footer');
}
// add biller category///
function add_biller_category(){
		   if ($this->input->post('submit')) {
            $data = $this->input->post();
			  unset($data['submit']);
			
			$user_image = '';
		if ($_FILES['biller_category_logo']['name']) {
                $user_image = $_FILES['biller_category_logo']['name'];
            }
            $attachment = $_FILES['biller_category_logo']['name'];

            if (!empty($attachment)) {
          
                $file_extension = explode(".", $_FILES["biller_category_logo"]["name"]);
                $new_extension = strtolower(end($file_extension));
                $today = time();
                $custom_name = "biller_category_logo" . $today;
                $file_name = $custom_name . "." . $new_extension;

                if ($new_extension == 'png' || $new_extension == 'jpeg' || $new_extension == 'jpg' || $new_extension == 'bmp') {
                    move_uploaded_file($_FILES['biller_category_logo']['tmp_name'], "./uploads/biller_category_logo/" . $file_name);
                    $imagename = $file_name;
                } else {
                    $this->session->set_flashdata('error', 'Invalid Image type');
                    redirect('admin/biller_category');
                }
				$data['biller_category_logo'] = $imagename;
            }
            	
				
                $this->login_model->insert_data('biller_category', $data);
                $this->session->set_flashdata('status', 'Biller category added successfully');
             // } else {
                 // $this->session->set_flashdata('error', 'Biller Email already exist');
             // }
            redirect('admin/biller_category');
            
        } else {
        	//$where=array('account_type'=>2);
          //  $data['biller'] = $this->login_model->get_record_where('admin',$where);
            $this->load->view('admin/menu');
            $this->load->view('admin/header');
            $this->load->view('admin/add/add_biller_category');
            $this->load->view('admin/footer');
        }
	}
// edit biller category/////
 function edit_biller_category() {
        if ($this->input->post('submit')) {
            $data = $this->input->post();
            $where = array('biller_category_id' => $this->input->post('biller_category_id'));
            unset($data['biller_category_id']);
            unset($data['submit']);
       		$user_image = '';
		if ($_FILES['biller_category_logo']['name']) {
                $user_image = $_FILES['biller_category_logo']['name'];
            }
            $attachment = $_FILES['biller_category_logo']['name'];

            if (!empty($attachment)) {
          
                $file_extension = explode(".", $_FILES["biller_category_logo"]["name"]);
                $new_extension = strtolower(end($file_extension));
                $today = time();
                $custom_name = "biller_category_logo" . $today;
                $file_name = $custom_name . "." . $new_extension;

                if ($new_extension == 'png' || $new_extension == 'jpeg' || $new_extension == 'jpg' || $new_extension == 'bmp') {
                    move_uploaded_file($_FILES['biller_category_logo']['tmp_name'], "./uploads/biller_category_logo/" . $file_name);
                    $imagename = $file_name;
                } else {
                    $this->session->set_flashdata('error', 'Invalid Image type');
                    redirect('admin/biller_category');
                }
				$data['biller_category_logo'] = $imagename;
            }
				
                $this->login_model->update_data('biller_category', $data, $where);
                $this->session->set_flashdata('status', 'Category  Update successfully');
            

            redirect('admin/biller_category');
        } else {
            $category_id = $this->uri->segment(3);
            if (!empty($category_id)) {

                $where = array('biller_category_id' => $category_id);
                $data['biller_category'] = $this->login_model->get_data_where_condition('biller_category', $where);
                $this->load->view('admin/menu');
                $this->load->view('admin/header');
                $this->load->view('admin/add/add_biller_category', $data);
                $this->load->view('admin/footer');
            } else {
                redirect('admin/biller_category');
            }
        }
    }

function biller_list(){
	// $data['biller_details']
	$biller_details= $this->login_model->get_record('biller_details','biller_id');
	$data['biller_details']=$biller_details;

	for($i=0;$i<count($biller_details); $i++)
		{
		//	echo $i;
			$where12=array('find_in_set(biller_category_id, "'.$biller_details[$i]->biller_category_id.'") '=>NULL);
			
			$biller_category = $this->login_model->get_data_where_condition('biller_category', $where12);
			foreach($biller_category as $val)
			{
				$name[$i][]=$val->biller_category_name;
			}
	$data['biller_details'][$i]->category_name=implode(",",$name[$i]);
		
		}
		$this->load->view('admin/menu');
        $this->load->view('admin/header');
        $this->load->view('admin/listing/biller_list_view', $data);
        $this->load->view('admin/footer');
}
function view_biller_details()
	{
		$biller_id=$this->uri->segment(4);
	$where=array('biller_id'=>$biller_id);
	 $data['biller_details'] = $this->login_model->get_record_join_two_table('biller_details', 'biller_category', 'biller_category_id ', 'biller_category_id 	','*',$where); 
//	$data['biller_details'] = $this->login_model->get_record_where('biller_details',$where);
	
		$this->load->view('admin/menu');
        $this->load->view('admin/header');
        $this->load->view('admin/listing/view_biller_details', $data);
        $this->load->view('admin/footer');
	}
function add_biller(){
    
		   if ($this->input->post('submit')) {
            $data = $this->input->post();
			$data['biller_category_id']=implode(",",$data['biller_category_id']);
			   $biller_password=$data['biller_password'];
			   $data['biller_password']=md5($biller_password);
			   $data['biller_original_pass']=$biller_password;
			  $data['biller_created_date']=date("Y-m-d");
			  $data['biller_reg_type']='1';
            unset($data['submit']);
	     $ch = array("biller_email" =>$this->input->post("biller_email"));
            $rec = $this->login_model->get_data_where_condition('biller_details', $ch);
			
			if(empty($rec)){
	   		$user_image = '';
			if ($_FILES['biller_company_logo']['name']) {
                $user_image = $_FILES['biller_company_logo']['name'];
          
                $file_extension = explode(".", $_FILES["biller_company_logo"]["name"]);
                $new_extension = strtolower(end($file_extension));
                $today = time();
                $custom_name = "biller_company_logo" . $today;
                $file_name = $custom_name . "." . $new_extension;

                  $custom_name_ch = "church" . $today;
                $file_name_ch = $custom_name_ch. "." . $new_extension;


                if ($new_extension == 'png' || $new_extension == 'jpeg' || $new_extension == 'jpg' || $new_extension == 'bmp') {

                   
                    
                	 if(move_uploaded_file($_FILES['biller_company_logo']['tmp_name'], "./uploads/biller_company_logo/" . $file_name))
                     {
                        if($data['biller_type']==2){
                           //$oldPath = "./uploads/church_image/".$file_name;
                           // $newPath = "./uploads/church_image/".$file_name_ch;
                           
                           // $newName  = $newPath."a".$ext;
                      move_uploaded_file($_FILES['biller_company_logo']['tmp_name'], "./uploads/church_image/" .$file_name_ch);
                        
                    }
 
                     }

                         
                     
         


                    $imagename = $file_name;
                } else {
                    $this->session->set_flashdata('error', 'Invalid Image type');
                    redirect('admin/biller_list');
                }
            }
				$data['biller_company_logo']=$imagename;
            	$mobile=$data['biller_contact_no'];
				   $bill_id=$this->login_model->insert_data('biller_details', $data);
                   //die();

                  if($data['biller_type']==2){

                   //$this->add_church($data,$bill_id);

                 if(!empty($data['biller_company_name']))
              {
                            
            $church_name=$data['biller_company_name'];
            $where=array('church_name'=>$church_name);
            $church_record = $this->login_model->get_data_where_condition('church_list', $where);
            if(empty($church_record)){
           
         // if ($_FILES['biller_company_logo']['name']) {
         //        $user_image = $_FILES['biller_company_logo']['name'];
          
         //        $file_extension = explode(".", $_FILES["biller_company_logo"]["name"]);
         //        $new_extension = strtolower(end($file_extension));
         //        $today = time();
         //        $custom_name = "church" . $today;
         //        $file_name = $custom_name . "." . $new_extension;

         //        if ($new_extension == 'png' || $new_extension == 'jpeg' || $new_extension == 'jpg' || $new_extension == 'bmp') {
         //             move_uploaded_file($_FILES['biller_company_logo']['tmp_name'], "./uploads/church_image/" . $file_name);
         //            $imagename = $file_name;
         //        } else {
                    
         //        }

                
         //    }
                $data1['church_img']=$file_name_ch;
            // if ($_FILES['biller_company_logo']['name']) {
            //     $user_image = $_FILES['biller_company_logo']['name'];
            // }
            // $attachment = $_FILES['biller_company_logo']['name'];

            // if (!empty($attachment)) {
            //     $file_extension = explode(".", $_FILES["biller_company_logo"]["name"]);
            //     $new_extension = strtolower(end($file_extension));
            //     $today = time();
            //     $custom_name = "church" . $today;
            //     $file_name = $custom_name . "." . $new_extension;

            //     if ($new_extension == 'png' || $new_extension == 'jpeg' || $new_extension == 'jpg' || $new_extension == 'bmp') {
            //         move_uploaded_file($_FILES['biller_company_logo']['tmp_name'], "./uploads/church_image/" . $file_name);
            //         $imagename = $file_name;
            //     } else {
            //         $this->session->set_flashdata('error', 'Invalid Image type');
            //         redirect('biller/biller_list');
            //     }
            //           $data1['church_img'] = $imagename;
            // }
           $data1['church_name']=$data['biller_company_name'];
           $data1['church_created_date']=date("Y-m-d");
          $where212221=array('biller_id'=>$bill_id);
            $biller_details =$this->login_model->get_data_where_condition('biller_details', $where212221); 
            $data1['church_category']=$biller_details[0]->biller_category_id;
           $data1['church_biller_id']=$bill_id;
         //$data1['church_city']=$data['church_city'];

            $church_id=$this->login_model->insert_data('church_list', $data1);
            $curdatetime=date("Y-m-d H:i:s");
            // for($l=0;$l<count($data['church_area']);$l++)
            // {
            //     $data12['church_area']=$data['church_area'][$l];
            //     $data12['church_area_created']=$curdatetime;
            //     $data12['church_id']=$church_id;
            //     $area_id[]=$this->login_model->insert_data('church_area', $data12);
            // }
             // $ids_area=implode(",",$area_id);
             // $data211['church_area_ids']=$ids_area;
             // $w=array('church_id'=>$church_id);
             // $this->login_model->update_data('church_list', $data211, $w);
       //$this->session->set_flashdata('status', 'Church add successfully');
       //redirect('biller/church_list');
            }else{
                 $this->session->set_flashdata('error', 'These name of church already exist');
            }
            }


                    }

               

				$to = $this->input->post("biller_email");
        		$subject = "Biller Login Credential of OyaCharge";
         		$path=base_url('webassets');
         		$message= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
               
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>Untitled Document</title></head>

<body bgcolor="#f1f1f1">
<table cellpadding="0" cellspacing="0" width="600" style="background:#fff; border:1px solid #cbcbcb; margin:0 auto; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
	<thead class="header">
    	<tr>
        	<td style="background:#456776; height:62px; width:100%; padding:5px; border-bottom:1px solid #DDD;" valign="middle">
            	<a href="#" style="margin-left:10px;"><img width="100" src="'.$path.'/images/logo.png" alt="..."/></a>
                
            </td>
        </tr>
    </thead>
    <tbody style=" background:#FEFEFE; border-bottom:1px solid #ddd;">
    	<tr>
        	<td style="padding:10px 15px;">
            	<h1 style="margin-bottom:0px; color:#456776;">OyaCharge </h1>
            	<p >You have  successfully Registered with Oyacharge, Please login to get access of your account.</p>';
             $message .=  '<p>Username:<strong>' .$data["biller_email"];'</strong></p>';
              $message .=  '<p>Password:<strong>'.$biller_password;'</strong></p></td></tr>';
          $message .= '<tr><td style="background:#ddd; height:1px; width:100%;"></td></tr></tbody>';
    
   // $message .= '<tfoot style="background:#337d75; text-align:center; color:#fff;"><tr><td><p> Copyright © 2016 Recharge All right reserved </p></td><tr></tfoot></table></body></html>';
      $message .= '<tfoot style="background:#456776; text-align:center; color:#fff;"><tr><td><p> Copyright © 2016 Recharge All right reserved </p></td><tr></tfoot></table></body></html>';
			
			// $headers = "Organization: OyaCharge\r\n";
  	// 		$headers .= "MIME-Version: 1.0\r\n";
		 //  	$headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
		 //  	$headers .= "X-Priority: 3\r\n";
		 //  	$headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;
   //        	$header = "From:blm.ypsilon@gmail.com \r\n";
   //       	$header .= "Cc:blm.ypsilon@gmail.com \r\n";
   //       	$header .= "MIME-Version: 1.0\r\n";
   //       	$header .= "Content-type: text/html\r\n";
         //	$retval = mail ($to,$subject,$message,$header);
			$this->sendElasticEmail($to, $subject,"OyaCharge", $message, "care@oyacharge.com", "OyaCharge");
			
		//	 $this->send_msg($mobile,$message); 
              //  $this->session->set_flashdata('status', 'Biller added successfully');
              } else {
                 $this->session->set_flashdata('error', 'Biller Email already exist');
             }
           redirect('admin/biller_list');
        } else {
        	$where=array('biller_category_status'=>1);
           	$data['biller'] = $this->login_model->get_record_where('biller_category',$where);
			$this->load->view('admin/menu');
            $this->load->view('admin/header');
            $this->load->view('admin/add/add_biller',$data);
            $this->load->view('admin/footer');
        }
	}

	     function add_church($data,$biller_id)
     {
     
            if(!empty($data['biller_company_name']))
            {
                            
            $church_name=$data['biller_company_name'];
            $where=array('church_name'=>$church_name);
            $church_record = $this->login_model->get_data_where_condition('church_list', $where);
            if(empty($church_record)){
           

            if ($_FILES['biller_company_logo']['name']) {
                $user_image = $_FILES['biller_company_logo']['name'];
            }
            $attachment = $_FILES['biller_company_logo']['name'];

            if (!empty($attachment)) {
                $file_extension = explode(".", $_FILES["biller_company_logo"]["name"]);
                $new_extension = strtolower(end($file_extension));
                $today = time();
                $custom_name = "church" . $today;
                $file_name = $custom_name . "." . $new_extension;

                if ($new_extension == 'png' || $new_extension == 'jpeg' || $new_extension == 'jpg' || $new_extension == 'bmp') {
                    move_uploaded_file($_FILES['biller_company_logo']['tmp_name'], "./uploads/church_image/" . $file_name);
                    $imagename = $file_name;
                } else {
                    $this->session->set_flashdata('error', 'Invalid Image type');
                    redirect('biller/biller_list');
                }
                      $data1['church_img'] = $imagename;
            }
                 $data1['church_name']=$data['biller_company_name'];
           $data1['church_created_date']=date("Y-m-d");
          $where212221=array('biller_id'=>$biller_id);
            $biller_details =$this->login_model->get_data_where_condition('biller_details', $where212221); 
            $data1['church_category']=$biller_details[0]->biller_category_id;
           $data1['church_biller_id']=$biller_id;
         //$data1['church_city']=$data['church_city'];

            $church_id=$this->login_model->insert_data('church_list', $data1);
            $curdatetime=date("Y-m-d H:i:s");
            // for($l=0;$l<count($data['church_area']);$l++)
            // {
            //     $data12['church_area']=$data['church_area'][$l];
            //     $data12['church_area_created']=$curdatetime;
            //     $data12['church_id']=$church_id;
            //     $area_id[]=$this->login_model->insert_data('church_area', $data12);
            // }
             // $ids_area=implode(",",$area_id);
             // $data211['church_area_ids']=$ids_area;
             // $w=array('church_id'=>$church_id);
             // $this->login_model->update_data('church_list', $data211, $w);
       $this->session->set_flashdata('status', 'Church add successfully');
       redirect('biller/church_list');
            }else{
                 $this->session->set_flashdata('error', 'These name of church already exist');
            }
            }

           
       
     }


	function send_msg($mobile,$msg){
		$mobileNumber = $mobile;
		
         $encodedMessage = urlencode($msg);
       $route = "4";
       $authKey = "109829ANu1kqLdg570b4e25";
       $senderId = "Recharge";
       $postData = array(
     'authkey' => $authKey,
     'mobiles' => $mobileNumber,
     'message' => $encodedMessage,
     'sender' => $senderId,
     'route' => $route
);
 $url="http://api.msg91.com/api/sendhttp.php";
      $ch = curl_init();
curl_setopt_array($ch, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $postData
    ,CURLOPT_FOLLOWLOCATION => true
));
 curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
 $output = curl_exec($ch);
curl_close($ch);
		
	}
	
	
function edit_biller() {
        if ($this->input->post('submit')) {
            $data = $this->input->post();
            $where = array('biller_id' => $this->input->post('biller_id'));
			$biller_password=$data['biller_password'];
			   $data['biller_password']=md5($biller_password);
			   $data['biller_original_pass']=$biller_password;
            unset($data['biller_id']);
            unset($data['submit']);
			   
	   		$user_image = '';
			if ($_FILES['biller_company_logo']['name']) {
                $user_image = $_FILES['biller_company_logo']['name'];
          
                $file_extension = explode(".", $_FILES["biller_company_logo"]["name"]);
                $new_extension = strtolower(end($file_extension));
                $today = time();
                $custom_name = "biller_company_logo" . $today;
                $file_name = $custom_name . "." . $new_extension;

                if ($new_extension == 'png' || $new_extension == 'jpeg' || $new_extension == 'jpg' || $new_extension == 'bmp') {
                	 move_uploaded_file($_FILES['biller_company_logo']['tmp_name'], "./uploads/biller_company_logo/" . $file_name);
                    $imagename = $file_name;
                } else {
                    $this->session->set_flashdata('error', 'Invalid Image type');
                    redirect('admin/biller_list');
                }
				$data['biller_company_logo'] = $imagename;
            }
            	$this->login_model->update_data('biller_details', $data, $where);
				$data1['church_category']=$data['biller_category_id'];
				  $where1 = array('church_biller_id' => $this->input->post('biller_id'));
				$this->login_model->update_data('church_list', $data1, $where1);
                $this->session->set_flashdata('status', 'Biller  Update successfully');
            

            redirect('admin/biller_list');
        } else {
            $category_id = $this->uri->segment(3);
            if (!empty($category_id)) {

                $where = array('biller_id' => $category_id);
                $data['biller_details'] = $this->login_model->get_data_where_condition('biller_details', $where);
				$where1=array('biller_category_status'=>1);
           		$data['biller'] = $this->login_model->get_record_where('biller_category',$where1);
                $this->load->view('admin/menu');
                $this->load->view('admin/header');
                $this->load->view('admin/add/add_biller', $data);
                $this->load->view('admin/footer');
            } else {
                redirect('admin/biller_list');
            }
        }
    }
///----------- bill sttaus listing ---------------
function bill_status(){
		$where1=array('biller_status'=>1);
       $data['biller'] = $this->login_model->get_record_where('biller_details',$where1);
		$this->load->view('admin/menu');
        $this->load->view('admin/header');
        $this->load->view('admin/listing/bill_paid_status', $data);
        $this->load->view('admin/footer');
}
function bill_record_by_biller(){
	$biller_id=$_REQUEST['biller_id'];
	$where=array('biller_id'=>$biller_id);
		$data['biller_details'] = $this->login_model->get_data_where_condition('biller_user', $where);
		   $this->load->view('admin/listing/bill_list_view', $data);
}

function bill_record_by_bill_status(){
	$biller_id=$_REQUEST['biller_id'];
	$status=$_REQUEST['status'];
	$where=array('biller_id'=>$biller_id,'bill_pay_status'=>$status);
		$data['biller_details'] = $this->login_model->get_data_where_condition('biller_user', $where);
		   $this->load->view('admin/listing/bill_list_view', $data);
}
/// freee promotional code category list...////
function free_coupon_category(){
	$data['free_coupon_category'] = $this->login_model->get_record('free_coupon_category');
		$this->load->view('admin/menu');
        $this->load->view('admin/header');
        $this->load->view('admin/listing/free_coupon_list_category', $data);
        $this->load->view('admin/footer');
}
function add_free_coupon_category(){
		   if ($this->input->post('submit')) {
            $data = $this->input->post();
			$data['free_coupon_category_create']=date("Y-m-d");
			  unset($data['submit']);
				 $this->login_model->insert_data('free_coupon_category', $data);
                $this->session->set_flashdata('status', 'Free Coupon category added successfully');
           		redirect('admin/free_coupon_category');
            
        } else {
        	//$where=array('account_type'=>2);
          //  $data['biller'] = $this->login_model->get_record_where('admin',$where);
            $this->load->view('admin/menu');
            $this->load->view('admin/header');
            $this->load->view('admin/add/add_free_coupon_category');
            $this->load->view('admin/footer');
        }
	}
// edit biller category/////
 function edit_free_coupon_category() {
        if ($this->input->post('submit')) {
            $data = $this->input->post();
            $where = array('free_coupon_category_id' => $this->input->post('free_coupon_category_id'));
            unset($data['free_coupon_category_id']);
            unset($data['submit']);
       		$this->login_model->update_data('free_coupon_category', $data, $where);
            $this->session->set_flashdata('status', 'Free Coupon Category  Update successfully');
            redirect('admin/free_coupon_category');
        } else {
            $category_id = $this->uri->segment(3);
            if (!empty($category_id)) {

                $where = array('free_coupon_category_id' => $category_id);
                $data['free_coupon_category'] = $this->login_model->get_data_where_condition('free_coupon_category', $where);
                $this->load->view('admin/menu');
                $this->load->view('admin/header');
                $this->load->view('admin/add/add_free_coupon_category', $data);
                $this->load->view('admin/footer');
            } else {
                redirect('admin/free_coupon_category');
            }
        }
    }
// fnction plan category
	function plan_category()
	{
		$data['plan_category'] = $this->login_model->get_record_join_two_table('plan_category', 'recharge_category', 'plan_recharge_category_id', 'recharge_category_id','*',''); 
	//	$data['plan_category'] = $this->login_model->get_record('plan_category');
	    $this->load->view('admin/menu');
        $this->load->view('admin/header');
        $this->load->view('admin/listing/plan_category', $data);
        $this->load->view('admin/footer');
	}
	function add_plan_category(){
		   if ($this->input->post('submit')) {
            $data = $this->input->post();
			
			  unset($data['submit']);
				 $this->login_model->insert_data('plan_category', $data);
                $this->session->set_flashdata('status', 'Plan category added successfully');
           		redirect('admin/plan_category');
            
        } else {
        	$where=array('category_status'=>1);
            $data['recharge_category'] = $this->login_model->get_record_where('recharge_category',$where);
            $this->load->view('admin/menu');
            $this->load->view('admin/header');
            $this->load->view('admin/add/add_plan_category',$data);
            $this->load->view('admin/footer');
        }
	}
	 function edit_plan_category() {
        if ($this->input->post('submit')) {
            $data = $this->input->post();
            $where = array('plan_category_id' => $this->input->post('plan_category_id'));
            unset($data['plan_category_id']);
            unset($data['submit']);
       		$this->login_model->update_data('plan_category', $data, $where);
            $this->session->set_flashdata('status', 'Plan Category Update successfully');
            redirect('admin/plan_category');
        } else {
            $category_id = $this->uri->segment(3);
            if (!empty($category_id)) {

                $where = array('plan_category_id' => $category_id);
                $data['plan_category'] = $this->login_model->get_data_where_condition('plan_category', $where);
				$where=array('category_status'=>1);
            $data['recharge_category'] = $this->login_model->get_record_where('recharge_category',$where);
                $this->load->view('admin/menu');
                $this->load->view('admin/header');
                $this->load->view('admin/add/add_plan_category', $data);
                $this->load->view('admin/footer');
            } else {
                redirect('admin/plan_category');
            }
        }
    }

/// function rechargee plan list//
 function plan_list(){
 //	$data['plan_list'] = $this->login_model->get_join_three_table_where('recharge_plan','operator_list','plan_category','operator_id','recharge_operator_id','plan_category_id','plan_category_id','','','recharge_plan_id');
$data['plan_list'] = $this->login_model->get_data_join_four_tabel_where('recharge_plan','recharge_category','operator_list','plan_category','recharge_category_id','recharge_category_id','operator_id','recharge_operator_id','plan_category_id','plan_category_id','recharge_plan_id','','','');

		$this->load->view('admin/menu');
        $this->load->view('admin/header');
        $this->load->view('admin/listing/plan_list_view', $data);
        $this->load->view('admin/footer');
 }
 function add_recharge_plan(){
		   if ($this->input->post('submit')) {
            $data = $this->input->post();
			if($data['plan_category_id']==15 && $data['recharge_category_id']==1 && $data['recharge_operator_id']==2)
			{
				$data['ercValue'] = $data['rechage_amount']-1;
			}
			  unset($data['submit']);
				 $this->login_model->insert_data('recharge_plan', $data);
                $this->session->set_flashdata('status', 'Plan added successfully');
           		redirect('admin/plan_list');
            
        } else {
        	$where=array('category_status'=>1);
            $data['recharge_category'] = $this->login_model->get_record_where('recharge_category',$where);
            $this->load->view('admin/menu');
            $this->load->view('admin/header');
            $this->load->view('admin/add/add_recharge_plan',$data);
            $this->load->view('admin/footer');
        }
	}
function edit_recharge_plan() {
        if ($this->input->post('submit')) {
            $data = $this->input->post();
            $where = array('recharge_plan_id' => $this->input->post('recharge_plan_id'));
            unset($data['recharge_plan_id']);
            unset($data['submit']);
       		$this->login_model->update_data('recharge_plan', $data, $where);
            $this->session->set_flashdata('status', 'Plan Update successfully');
            redirect('admin/plan_list');
        } else {
            $category_id = $this->uri->segment(3);
            if (!empty($category_id)) {

                $where = array('recharge_plan_id' => $category_id);
                $data['recharge_plan'] = $this->login_model->get_data_where_condition('recharge_plan', $where);
				$where12=array('category_status'=>1);
            $data['recharge_category'] = $this->login_model->get_record_where('recharge_category',$where12);
			
                $this->load->view('admin/menu');
                $this->load->view('admin/header');
                $this->load->view('admin/add/add_recharge_plan', $data);
                $this->load->view('admin/footer');
            } else {
                redirect('admin/plan_list');
            }
        }
    }
 // function ajax change plan type//...
 function change_plan_type(){
 	 $recharge_category_id=$_REQUEST['recharge_category_id'];
	
	 $where=array('plan_recharge_category_id'=>$recharge_category_id);
	 $data['plan_type'] = $this->login_model->get_record_where('plan_category',$where);
	 $this->load->view('admin/add/ajax_plan_type',$data);
 }
function change_operator(){
	 $recharge_category_id=$_REQUEST['recharge_category_id'];
	  $where_operator=array('recharge_category_id'=>$recharge_category_id);
	 $data['operator'] = $this->login_model->get_record_where('operator_list',$where_operator);
	  $this->load->view('admin/add/ajax_operator',$data);
}
//function upload plan excel

function upload_plan_excel(){
	 		$this->load->view('admin/menu');
            $this->load->view('admin/header');
            $this->load->view('admin/listing/add_upload_plan');
            $this->load->view('admin/footer');
}
function upload_plans(){
	$this -> load -> library('Excel');
			$invalid = '';
			
			if (isset($_POST) && !empty($_FILES['plan_excel']['name'])) {
				
				$namearr = explode(".", $_FILES['plan_excel']['name']);
				
				if (end($namearr) != 'xls' && end($namearr) != 'xlsx') {
					
					// echo '<p> Invalid File </p>';
					$message = "Invalid File.Please Upload xls or xlsx file!";
					$this -> session -> set_flashdata('error', $message);
					redirect('admin/upload_plan_excel');
					$invalid = 1;
				}
				
				if ($invalid != 1) {
					$response = move_uploaded_file($_FILES['plan_excel']['tmp_name'], "./uploads/plan_excel/" . $_FILES['plan_excel']['name']);
					// Upload the file to the current folder
					
					if ($response) {
						try {
							
							$objPHPExcel = PHPExcel_IOFactory::load("./uploads/plan_excel/" . $_FILES['plan_excel']['name']);
						} catch(Exception $e) {
							
							//die('Error : Unable to load the file : "' . pathinfo($_FILES['region_excel']['name'], PATHINFO_BASENAME) . '": ' . $e -> getMessage());
							$message = 'Error : Unable to load the file : "' . pathinfo($_FILES['plan_excel']['name'], PATHINFO_BASENAME) . '": ' . $e -> getMessage();
						$this -> session -> set_flashdata('error', $message);
							redirect('biller/upload_plan_excel');
						}

						$allDataInSheet = $objPHPExcel -> getActiveSheet() -> toArray(null, true, true, true);
					//	print_r($allDataInSheet ); die;						
						$arrayCount = count($allDataInSheet);
						
						  
						// Total Number of rows in the uploaded EXCEL file
					//	 print_r($allDataInSheet);

						// $string = "INSERT INTO `employee_master_data`(`designation_id`, `branch_id`,`e_email`, `e_phone`, `reporting_to`, `e_name`, `category_id`, `m_designation_id`, `m_email`, `extra1`, `extra2`, `extra3`, `d_id`) VALUES ";
						$upload_count = 0;
						$not_upload_count = 0;
						$error_vin = array();
						for ($i = 2; $i <= $arrayCount; $i++) {
							$A = trim($allDataInSheet[$i]["A"]);
							$B=trim($allDataInSheet[$i]["B"]);
							$C = trim($allDataInSheet[$i]["C"]);
							$D=trim($allDataInSheet[$i]["D"]);
							$E= trim($allDataInSheet[$i]["E"]);
							$F=trim($allDataInSheet[$i]["F"]);
							$G = trim($allDataInSheet[$i]["G"]);
							$H = trim($allDataInSheet[$i]["H"]);
							$I = trim($allDataInSheet[$i]["I"]);
							$current_date=date("Y-m-d");
							
							 
				$plan_data = array("plan_category_id"=>$A,"recharge_category_id"=>$B,"recharge_operator_id"=>$C,"rechage_amount"=>$D,"recharge_data_pack"=>$E,"recharge_talktime"=>$F,"recharge_validity"=>$G,"recharge_activation_code"=>$H,"recharge_desc"=>$I);
	$rec['already'] = '';
	$where=array("plan_category_id"=>$A,"recharge_category_id"=>$B,"recharge_operator_id"=>$C,"rechage_amount"=>$D,"recharge_data_pack"=>$E,"recharge_talktime"=>$F,"recharge_validity"=>$G,"recharge_activation_code"=>$H);
	$rec['already'] = $this -> login_model -> get_data_where_condition('recharge_plan', $where);
					
					
							if(empty($rec['already']))
							{
								$this -> login_model -> insert_data('recharge_plan', $plan_data);
								}

						}

			
						$file = $_FILES['plan_excel']['name'];
						if (!unlink("./upload/plan_excel/" . $file)) {
							// echo("Error deleting $file");
						} else {
							// echo("Deleted $file");
						}
						
						$message = "Excel Upload Successfully!";
						$this -> session -> set_flashdata('success', $message);
							redirect('admin/plan_list');
					} else {
						// echo "Error in response";
						$message = "Error in response!";
						$this -> session -> set_flashdata('error', $message);
							redirect('admin/upload_plan_excel');
					}
				}
		}
}

// function view_biller_details...
function show_biller_details(){
	$biller_id=$this->uri->segment(3);
	$where=array('biller_id'=>$biller_id);
	$data['biller_details'] = $this->login_model->get_record_where('biller_details',$where);
	$this->load->view('admin/menu');
            $this->load->view('admin/header');
            $this->load->view('admin/listing/view_biller_details',$data);
            $this->load->view('admin/footer');
}
// ---function biller change status---///
function change_biller_status(){
		$biller_id=$this->uri->segment(4);
		$req_type=$this->uri->segment(5);
		$where=array('biller_id'=>$biller_id);
	
		$user_details = $this->login_model->get_record_where('user',$where);
		$user_id=$user_details[0]->user_id;
		 if($req_type=='1'){
		 	$data['biller_status']='1';
		 }else if($req_type=='2'){
		 	$data['biller_status']='3';
		 }
		$this->login_model->update_data('biller_details', $data, $where);
         $where1=array('user_id'=>$user_id);
		 if($req_type=='1'){
		 	$data1['biller_status']='1';
		 }else if($req_type=='2'){
		 	$data1['biller_status']='3';
		 }
		$this->login_model->update_data('user', $data1, $where1);  
		$biller_details = $this->login_model->get_record_join_two_table('biller_details', 'biller_category', 'biller_category_id', 'biller_category_id','*',$where); 
		$biller_status=$biller_details[0]->biller_status;
		$biller_category=$biller_details[0]->biller_category_name;
		$biller_name=$biller_details[0]->biller_name;
		$biller_email=$biller_details[0]->biller_email;
		$biller_company_name=$biller_details[0]->biller_company_name;
		$biller_password=$biller_details[0]->biller_original_pass;
		if($biller_status=='1'){
			$to = $biller_email;
        		$subject = "Biller Login Credential of OyaCharge";
         		$path=base_url('webassets');
				$biller_url=site_url('biller/');
         		$message= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>Untitled Document</title></head>

<body bgcolor="#f1f1f1">
<table cellpadding="0" cellspacing="0" width="600" style="background:#fff; border:1px solid #cbcbcb; margin:0 auto; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
	<thead class="header">
    	<tr>
        	<td style="background:#FFFFFF; height:62px; width:100%; padding:5px; border-bottom:1px solid #DDD;" valign="middle">
            	<a href="#" style="margin-left:10px;"><img width="100" src="'.$path.'/images/logo.png" alt="..."/></a>
                
            </td>
        </tr>
    </thead>
    <tbody style=" background:#FEFEFE; border-bottom:1px solid #ddd;">
    	<tr>
        	<td style="padding:10px 15px;">
            	<h1 style="margin-bottom:0px; color:#456776;">RECHARGE </h1>
            	<p >Biller Login Details</p>';
             $message .=  '<p>Useremail:<strong>' .$biller_email;'</strong></p>';
             $message .=  '<p>Password:<strong>'.$biller_password;'</strong></p>';
			 $message .=  '<p>Category:<strong>' .$biller_category;'</strong></p>';
             $message .=  '<p>Biller Name:<strong>'.$biller_name;'</strong></p>';
			 $message .= '<p>Biller Company:<strong>'.$biller_company_name;'</strong></p>';
			 $message .= '<p>Biller Link:<strong>'.$biller_url;'</strong></p>';
          	 $message .= '<tr><td style="background:#ddd; height:1px; width:100%;"></td></tr></tbody>';
    
    $message .= '<tfoot style="background:#456776; text-align:center; color:#fff;"><tr><td><p> Copyright © 2016 OyaCharge All right reserved </p></td><tr></tfoot></table></body></html>';
			
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
		}
		 $this->session->set_flashdata('status', 'Status changed successfully');
            redirect('admin/biller_list');
}
	function Track(){
		$this->load->view('admin/menu');
        $this->load->view('admin/header');
        $this->load->view('admin/listing/track_transaction');
        $this->load->view('admin/footer');
	}
// Track transaction record to chaeck transaction
	function track_transaction()
	{
	  // $transaction_id='kpay-wallet1470384063CQ7WC1U7RQ';
	   $transaction_id=$_REQUEST['transaction_id'];

		$where=array('(wallet_transaction.transaction_id ="'.$transaction_id.'" or wallet_transaction.payment_gateway_id ="'.$transaction_id.'")'=>NULL);
		$data['transaction_record']=$this->login_model->get_data_join_four_tabel_where_leftjoin('wallet_transaction','user','recharge','operator_list','user_id','wt_user_id','recharge_user_id','wt_user_id','operator_id','operator_id','',$where,$column='','wt_id');
	
      if(!empty($data['transaction_record'])){
      	 $this->load->view('admin/listing/track_transactions_record', $data);
      }else{
      	echo "2";  // No Record found
      }
	}
// function church donation list
function donation_list()
{
	  	$data['donation_details'] = $this->login_model->get_data_join_four_tabel_where_group('church_donate', 'church_list','user','church_product', 'church_id', 'donate_church_id','user_id','donate_user_id','church_product_id','church_p_id','church_donate_id','','church_list.church_name,user.user_name, church_product.church_product_name, church_donate.church_product_price,church_donate.donate_datetime,church_list.church_img,church_donate.payment_status',''); 
			$this->load->view('admin/menu');
			$this->load->view('admin/header');
            $this->load->view('admin/listing/donation_list',$data);
            $this->load->view('admin/footer');
}
//----------Skretch card function------//
function scratch_card()
{
			$data['skretch_card'] = $this->login_model->get_record_where_orderby('skretch_card','skretch_card_id');
			$this->load->view('admin/menu');
			$this->load->view('admin/header');
            $this->load->view('admin/listing/skretch_card',$data);
            $this->load->view('admin/footer');
}
 function add_scratch_card(){
		   if ($this->input->post('submit')) {
            $data = $this->input->post();
			$data['skretch_card_date']=date("Y-m-d");
			  unset($data['submit']);
				 $this->login_model->insert_data('skretch_card', $data);
                $this->session->set_flashdata('status', 'Scratch card added successfully');
           		redirect('admin/scratch_card');
            
        } else {
        	$this->load->view('admin/menu');
            $this->load->view('admin/header');
            $this->load->view('admin/add/add_skretch_card');
            $this->load->view('admin/footer');
        }
	}
 function edit_scratch_card() {
        if ($this->input->post('submit')) {
            $data = $this->input->post();
            $where = array('skretch_card_id' => $this->input->post('skretch_card_id'));
            unset($data['skretch_card_id']);
            unset($data['submit']);
       		$this->login_model->update_data('skretch_card', $data, $where);
            $this->session->set_flashdata('status', 'Scratch card Update successfully');
            redirect('admin/scratch_card');
        } else {
            $skretch_card_id = $this->uri->segment(3);
            if (!empty($skretch_card_id)) {

                $where = array('skretch_card_id' => $skretch_card_id);
                $data['skretch_coupon'] = $this->login_model->get_data_where_condition('skretch_card', $where);
			
                $this->load->view('admin/menu');
                $this->load->view('admin/header');
                $this->load->view('admin/add/add_skretch_card', $data);
                $this->load->view('admin/footer');
            } else {
                redirect('admin/scratch_card');
            }
        }
    }
// feedback user list---------------
function feedback()
{
	 			$where = array('feedback_status' => '1');
                $data['feedback_user'] = $this->login_model->get_data_where_condition('user_feedbacks', $where);
			
                $this->load->view('admin/menu');
                $this->load->view('admin/header');
                $this->load->view('admin/listing/feedback', $data);
                $this->load->view('admin/footer');
}
function church_list()
{
	 			$where = array('church_status' => '1');
              $data['church_list'] = $this->login_model->get_record_join_two_table('church_list', 'biller_category', 'church_category', 'biller_category_id','',$where,'church_id'); 
			
                $this->load->view('admin/menu');
                $this->load->view('admin/header');
                $this->load->view('admin/listing/church_list', $data);
                $this->load->view('admin/footer');
}
// Eveny part===================
function event_viewer()
{
	 			$where = array('category' => '3');
              $data['event_viewer_list'] = $this->login_model->get_record_join_two_table('biller_details', 'biller_category', 'biller_category_id', 'biller_category_id','',$where,'biller_id'); 

                $this->load->view('admin/menu');
                $this->load->view('admin/header');
                $this->load->view('admin/listing/event_viewer', $data);
                $this->load->view('admin/footer');
}
function ajax_biller_type()
{
	$biller_type=$_REQUEST['biller_type'];
	$where=array('category'=>$biller_type);
	 $data['biller'] = $this->login_model->get_data_where_condition('biller_category', $where);
	
	 $this->load->view('admin/add/ajax_biller_type', $data);
}
/// function faq part
function faq()
{
	 			$where = array('faq_status' => '1');
              	$data['faq'] =$this->login_model->get_data_where_condition('faq', $where);
                $this->load->view('admin/menu');
                $this->load->view('admin/header');
                $this->load->view('admin/listing/faq', $data);
                $this->load->view('admin/footer');
}
function edit_faq() {
        if ($this->input->post('submit')) {
            $data = $this->input->post();
			 $where = array('faq_id' => $this->input->post('faq_id'));
            unset($data['faq_id']);
            unset($data['submit']);
            
               $this->login_model->update_data('faq', $data, $where);
                $this->session->set_flashdata('status', 'FAQ details Update successfully');
            

            redirect('admin/faq');
        } else {
            $category_id = $this->uri->segment(3);
            if (!empty($category_id)) {

                $where = array('faq_id' => $category_id);
                $data['faq'] = $this->login_model->get_data_where_condition('faq', $where);
                $this->load->view('admin/menu');
                $this->load->view('admin/header');
                $this->load->view('admin/add/add_faq', $data);
                $this->load->view('admin/footer');
            } else {
                redirect('admin/faq');
            }
        }
    }
function sattlement()
{
				$sql3="select * from biller_sattlement join biller_details on biller_details.biller_id=biller_sattlement.biller_id order by biller_sattlement.sattlement_date DESC";
				$data['sattlement_list']=$this->login_model->get_simple_query($sql3);
                $this->load->view('admin/menu');
                $this->load->view('admin/header');
                $this->load->view('admin/listing/sattlement_list', $data);
                $this->load->view('admin/footer');
}
function biller_sattlement()
{
	 if ($this->input->post('submit')) {
            $data               =    $this->input->post();
          
			  unset($data['submit']);
			 $biller_id         =    $data['biller_id'];
             $sql3="select user_id from user where biller_id='".$biller_id."'";
                $users=$this->login_model->get_simple_query($sql3); 
                $user_id= $users[0]->user_id;
             $wallet_amount     =    $data['wallet_amount'];
             $minimum_withdraw_amount = $data['minimum_withdraw_amount'];
            
             $bank_name         = $data['bank_name'];
             
        $account_name   = $data['bank_account_holder'];
        $account_number = $data['bank_account_no'];
        $user_bank_code = $data['bank_code'];
        $transfer_amt   = $data['settlement_amount'];
        $apiURL         = base_url('webservices/api.php');
        $postField="------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"rquest\"\r\n\r\nwallet_to_bank\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"user_id\"\r\n\r\n$user_id\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"transfer_amount\"\r\n\r\n$transfer_amt\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"bankcode\"\r\n\r\n$user_bank_code\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"account_number\"\r\n\r\n$account_number\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"account_holder_name\"\r\n\r\n$account_name\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--";
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $apiURL,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => $postField,
          CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
            "postman-token: 0a1bf1c2-32ab-cfa4-3e40-18c49dea0c8f"
          ),
        ));

        $response = curl_exec($curl); 
        $err = curl_error($curl);
        curl_close($curl);
			if ($err) {
         $this->session->set_flashdata('error', 'Error in Biller sattlement amount');
         redirect('admin/sattlement');
        } else {

                $result                     =   json_decode($response);
                if($result->status=='false')
                {
                     $this->session->set_flashdata('error', $result->message);
                    redirect('admin/sattlement');
                }
                if(isset($result) && !empty($result))
                {

                    $data1['sattlement_status']     =   $result->status;
                    $data1['sattlement_note']       =   $result->message;
                    $data1['transaction_ref']       =   $result->transaction_ref;
                    $data1['transaction_date']      =   $result->transaction_date;
                    $data1['biller_id']             =    $data['biller_id'];
                    $data1['settlement_amount']     =   $transfer_amt;
                    $data1['sattlement_date']       =   $data1['transaction_date'];
                    $data1['account_holder_name']   =   $data['bank_account_holder'];
                    $data1['bank_account_no']       =   $data['bank_account_no'];
                    $data1['bank_code']             =   $data['bank_code'];
                    $data1['bank_name']             =   $data['bank_name'];
                    $this->login_model->insert_data('biller_sattlement', $data1);
                    $this->session->set_flashdata('status', 'Biller sattlement added successfully');
                }else{

                    $data1['status']            =   false;
                    $data1['message']           =   'Transaction Failed. Please try again.';
                    $data1['transaction_ref']   =   '';
                    $data1['transaction_date']  =   date('F-d-Y h:i A',strtotime("Y-m-d"));
                    $this->session->set_flashdata('error', 'Error in Biller sattlement amount');
                }
             // redirect('admin/sattlement');
          }
            }else{
				$where = array('biller_status' => '1');
				$data['biller_list'] = $this->login_model->get_data_where_condition('biller_details', $where);
				$this->load->view('admin/menu');
                $this->load->view('admin/header');
                $this->load->view('admin/add/add_sattlement', $data);
                $this->load->view('admin/footer');
			}
}
function biller_details_satelemnt()
{
    $biller_id = $_REQUEST['id'];
    $sql="select biller_name,bank_name,bank_code,bank_account_no,bank_account_holder,minimum_withdraw_amount,wallet_amount from biller_details join user on user.biller_id=biller_details.biller_id where biller_details.biller_id='".$biller_id."'";
    $biller_details=$this->login_model->get_simple_query($sql);
    if(!empty($biller_details))
    {
          $post = array('status'=>1,'biller_name'=>$biller_details[0]->biller_name,'bank_name'=>$biller_details[0]->bank_name,'bank_code'=>$biller_details[0]->bank_code,'bank_account_no'=>$biller_details[0]->bank_account_no,'bank_account_holder'=>$biller_details[0]->bank_account_holder,'minimum_withdraw_amount'=>$biller_details[0]->minimum_withdraw_amount,'wallet_amount'=>$biller_details[0]->wallet_amount);
    }else{
        $post = array('status'=>0);
    }
    echo json_encode($post);
  
}
// function dstv plan list
		function dstv_plan()
		{
				$where = array('tv_plans_status' => '1');
				$data['dstv_plan'] = $this->login_model->get_data_where_condition('tv_plans', $where);
				$this->load->view('admin/menu');
                $this->load->view('admin/header');
                $this->load->view('admin/listing/dstv_plan_list', $data);
                $this->load->view('admin/footer');
		}
function event_list()
{
		$sql="SELECT count(*) as past_event  FROM event_list WHERE  event_end_date < NOW()"; 
		$data['past_event']=$this->login_model->get_simple_query($sql);
		 $sql="SELECT count(*) as start_event  FROM event_list WHERE event_date <= NOW() and event_end_date >= NOW() "; 
		$data['start_event']=$this->login_model->get_simple_query($sql);
		 $sql="SELECT count(*) as upcoming_event  FROM event_list WHERE event_date > NOW() and event_end_date >= NOW() "; 
		$data['upcoming_event']=$this->login_model->get_simple_query($sql);
		 $sql="SELECT count(*) as total_event  FROM event_list "; 
		$data['total_event']=$this->login_model->get_simple_query($sql);
	 	$data['event_list'] = $this->login_model->get_record_join_two_table('event_list', 'biller_category', 'event_category', 'biller_category_id','','','event_id'); 
	 			$this->load->view('admin/menu');
                $this->load->view('admin/header');
                $this->load->view('admin/listing/event_list', $data);
                $this->load->view('admin/footer');
		
}
function event_transaction()
{
 $sql="SELECT * FROM `wallet_transaction` join booking_event_tickets on booking_event_tickets.transaction_id=wallet_transaction.`transaction_id` join user on user.user_id=wallet_transaction.`wt_user_id` join event_list on event_list.event_id=booking_event_tickets.booking_event_id where `wallet_transaction`.`wt_category`='16' order by wt_id DESC";
	    $data['transaction_record']=$this->login_model->get_simple_query($sql);

		$this->load->view('admin/menu',$data);
        $this->load->view('admin/header');
        $this->load->view('admin/listing/event_transaction_list', $data);
        $this->load->view('admin/footer');
}
function event_perticuler_transaction(){
		$trans_id = $this->uri->segment(3);
   		$user_id = $this->uri->segment(4);
		$where=array('wt_user_id'=>$user_id,'wt_id'=>$trans_id);
		 $sql="SELECT * FROM `wallet_transaction` join booking_event_tickets on booking_event_tickets.transaction_id=wallet_transaction.`transaction_id` join user on user.user_id=wallet_transaction.`wt_user_id` join event_list on event_list.event_id=booking_event_tickets.booking_event_id   where  wallet_transaction.wt_user_id='".$user_id."' and wallet_transaction.wt_id='".$trans_id."'";
		
	   $data['transaction_record']=$this->login_model->get_simple_query($sql);
		$this->load->view('admin/menu');
        $this->load->view('admin/header');
		$this->load->view('admin/listing/event_user_transactions', $data);
		$this->load->view('admin/footer');
   }
   function ajax_event_transaction() {
	$date = $this->input->post('date');
	$recharge_status = $this->input->post('transaction_status');
	if(!empty($date)){
	    $new=explode('-', $date);
	    $start_date = $new[0];
	    $first_date = date('Y-m-d H:i:s', strtotime($start_date)) ;

	    $end_date = $new[1];
	    $plus_date = strtotime("+1 day", strtotime($end_date));
	    $todate = date("Y-m-d", $plus_date);
	    $second_date = date('Y-m-d H:i:s', strtotime($todate));
	
	}else{
	    $first_date='';
	    $second_date='';
	}
	
	$where = "";			
            
	$query = "SELECT * FROM `wallet_transaction` join booking_event_tickets on booking_event_tickets.transaction_id=wallet_transaction.`transaction_id` join user on user.user_id=wallet_transaction.`wt_user_id` join event_list on event_list.event_id=booking_event_tickets.booking_event_id ";
	$conditions = array();

	
	if(!empty($recharge_status)) {
	    $conditions[] = "`wt_status` = '". $recharge_status."'";
	    $where['wt_status'] = $recharge_status;
	}
	
	
	$sql = $query;
	if (count($conditions) > 0) {
	    $sql .= " WHERE " . implode(' AND ', $conditions); 
	}
	
	if($first_date !='' && $second_date !='')
	$sql .= " AND `wt_datetime` BETWEEN '". $first_date ."' AND '". $second_date."'";
	
	$arr = $this->login_model->get_simple_query($sql);
	$data['wallet_transaction'] = $arr;
	$this->load->view('biller/ajax_transaction_filter_view', $data);
   }
	function counter()
	{
		    $sql="select count(*) as user_unread from user where user_read_status='2'"; 
			$record=$this->login_model->get_simple_query($sql);
			$user= $record[0]->user_unread;
			
			$sql1="select count(*) as trans_unread from wallet_transaction where trans_read_status='2'"; 
			$record1=$this->login_model->get_simple_query($sql1);
			$trans= $record1[0]->trans_unread;
			
			$sql1="select count(*) as event_trans_unread from wallet_transaction where trans_read_status='2' and wt_category='16'"; 
			$record1=$this->login_model->get_simple_query($sql1);
			$event_trans= $record1[0]->event_trans_unread;
			$post=array('user_count'=>$user,'trans'=>$trans,'event_trans'=>$event_trans);
			echo json_encode($post);
	}
// function curl json
 
	
//------------------------------------------------------------------------------------
//----end class----//
}
