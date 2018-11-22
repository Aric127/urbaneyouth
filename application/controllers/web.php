<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Web extends CI_Controller {

var $mydata;
    function __construct() {
    	session_start();
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('login_model');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('email');
        $this->load->library('toastr');
		date_default_timezone_set("Africa/Lagos");
        define('category_image', base_url('uploads/category/'));
        define('category_thumb_image', base_url('uploads/category/thumb_img/'));
        define('product_image', base_url('uploads/product/'));
        define('product_thumb_image', base_url('uploads/product/thumb_img/'));
        define('invoice_image', base_url('uploads/invoice_logo/'));
		define('free_coupon_image', base_url('uploads/coupon_img/'));
		define('church_image', base_url('uploads/biller_company_logo/'));
		define('event_image', base_url('uploads/event/'));
		define('operator_image', base_url('uploads/operator/'));
		define('biller_company_logo', base_url('uploads/biller_company_logo/')); 
		define('default_logo', base_url('wassets/images/default_img.png'));
		define('country_code',"+234" );
    	// Live api key
    	define('webpay_hashkey',"B668FF05B7B90C4A80F24FFC55DC2E1963F006CC861C215E5FD58CDABA70B52078FA481616A757D4CC7549A80ED4A6B8434381409D8CE0E0F6BACDC493291E6B");
		define('webpay_product_id',"6804");
		define('webpay_url','https://webpay.interswitchng.com/paydirect/pay');
		define('webpay_jsonurl','https://webpay.interswitchng.com/paydirect/api/v1/gettransaction.json');
		//date_default_timezone_set("Asia/Calcutta");
		// Demo api key
		//define('webpay_hashkey',"C8C24E816BD825584AB4B7CEAD1763E11B997EE0C8BEB6E9D0E7C40A6C95680CC1C49E8C9658195A53AF3A1B9AE2B11E1745E1D46854E6338851427E07C581A5");
		//define('webpay_product_id',"4980");
		//define('webpay_url','https://stageserv.interswitchng.com/test_paydirect/pay');
		//define('webpay_jsonurl','https://stageserv.interswitchng.com/test_paydirect/api/v1/gettransaction.json');
        
    }
	function footer(){
		  $where_operator = array('operator_status' => 1);
          $operator_list = $this->login_model->get_data_where_condition('operator_list', $where_operator);
		  return $operator_list;
		
	}
	function church(){
		  $where_operator = array('category' => 2,'biller_category_status'=>'1');
          $church_list = $this->login_model->get_data_where_condition('biller_category', $where_operator);
		  return $church_list;
	}
function biller_category(){
	 $where_biller = array('biller_category_status' => 1,'category' => 1);
          $biller_list = $this->login_model->get_data_where_condition('biller_category', $where_biller);
		  return  $biller_list;
}
function event_category(){
	 $where_biller = array('biller_category_status' => 1,'category'=>'3');
          $biller_list = $this->login_model->get_data_where_condition('biller_category', $where_biller);
		  return  $biller_list;
}
function contact_details(){
	 $where_biller = array('contact_us_status' => 1);
          $contact_list = $this->login_model->get_data_where_condition('contact_us', $where_biller);
		  return  $contact_list;
}
function about_details(){
	 $where_biller = array('about_us_status' => 1);
          $contact_list = $this->login_model->get_data_where_condition('about_us', $where_biller);
		  return  $contact_list;
}
function operator_list()
{
	 		$where_biller = array('operator_status' => 1);
            $operator_list = $this->login_model->get_data_where_condition('operator_list', $where_biller);
		    return  $operator_list;
}
function quick_pay()
{
	//$this->load->view('web/inner-header');
        $this->load->view('web/quick-payment-details');
        $this->load->view('web/inner_footer');
}
    function index() {

    	$user_id = $this->session->userdata('user_id');
    	if( empty($user_id) )
    	  $f_data['isLogin'] = false;
    	else
    	  $f_data['isLogin'] = true;

    	$f_data['contact_details']  = 	$this->contact_details();
    	$f_data['recharge_content'] = 	$this->login_model->get_record('recharge_content');
    	$f_data['about_details'] 	= 	$this->about_details();
    	$f_data['operator'] 		= 	$this->operator_list();
		$f_data['church'] 			= 	$this->church();
		$f_data['biller_category'] 	= 	$this->biller_category();
		$f_data['event_category'] 	= 	$this->event_category();
		$this->load->view('web/header',$f_data);
		$this->load->view('web/index',$f_data);
		 $this->load->view('web/footer');
        
    }
    function shareearn()
    {
    	$this->load->view('web/header');
        $this->load->view('web/shareearn');
        $this->load->view('web/footer');
    }


 function get_client_ip()
 {
      $ipaddress = '';
      if (getenv('HTTP_CLIENT_IP'))
          $ipaddress = getenv('HTTP_CLIENT_IP');
      else if(getenv('HTTP_X_FORWARDED_FOR'))
          $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
      else if(getenv('HTTP_X_FORWARDED'))
          $ipaddress = getenv('HTTP_X_FORWARDED');
      else if(getenv('HTTP_FORWARDED_FOR'))
          $ipaddress = getenv('HTTP_FORWARDED_FOR');
      else if(getenv('HTTP_FORWARDED'))
          $ipaddress = getenv('HTTP_FORWARDED');
      else if(getenv('REMOTE_ADDR'))
          $ipaddress = getenv('REMOTE_ADDR');
      else
          $ipaddress = 'UNKNOWN';

      return $ipaddress;
 }
    function contactus()
    {
    		if(!empty($this->input->post()))
			{
					$data  = $this->input->post();
					unset($data['btnSubmit']);
					$data['feedback_created_datetime']=date("Y-m-d H:i:s");
					$data['user_ip']=$this->get_client_ip();
					$result = $this -> login_model -> insert_data('user_feedbacks', $data);
					if(!empty($result))
					{
						$this->toastr->success("Thanks for contact us.. we will shortly contact you.");
						//	 $this->session->set_flashdata('status', "Thanks for contact us.. we will shortly contact you.");
					}else {
						$this->toastr->error("Have Some Technical issue. Please try after some time.");
						//$this->session->set_flashdata('error', $message);
					}
					
					redirect(base_url('ContactUs'));
			}else
			{
				$data['contact_us_data'] = $this->login_model->get_column_data_where('contact_us');
		    	$this->load->view('web/header');
		        $this->load->view('web/contactus',$data);
		        $this->load->view('web/footer');
    		}
    }
	function my_profile(){
		 if ($this->session->userdata('user_id') == FALSE) {
            redirect('web');
        }
		$user_id= $this->session->userdata('user_id'); 
		if(!empty($user_id)){
			$user_id=$user_id;
		}else{
			$user_id=$_REQUEST['user_id'];
			$this->session->set_userdata(array('user_id'=>$user_id)); 
		}
		
		$result=file_get_contents(base_url('webservices/api.php?rquest=user_profile&user_id='.$user_id));
		$wallet=json_decode($result);
		$data['my_profile']=json_decode($result);
		$data['my_wallet']=$wallet->wallet_amount;
		$this->session->set_userdata(array('verify_status'=>'1')); 
		$this->load->view('web/inner-header',$data);
        $this->load->view('web/my-profile',$data);
        $this->load->view('web/inner_footer');
	}
	function login_in()
	{
		  $this->load->view('web/admin-index');
	}
	function recharge_details()
	{
	if ($this->session->userdata('user_id') == FALSE)
	 {
            redirect('web');
      }
		 $user_id= $this->session->userdata('user_id');
		$result=file_get_contents( base_url('webservices/api.php?rquest=user_profile&user_id='.$user_id));
		$wallet=json_decode($result);
		$data['my_profile']=json_decode($result);
		$data['my_wallet']=$wallet->wallet_amount;
	 	$data['mobile']=$_REQUEST['mobile']; 
	 	$data['user_id']=$user_id;
		if(!empty($_REQUEST['prepaid'])){
       $data['prepaid']=$_REQUEST['prepaid'];  }
	   $data['recharge_category_id']='1'; // ] Mobile
		if(!empty($_REQUEST['mobile_topup']))
		{
			$data['mobile_topup'] = $_REQUEST['mobile_topup'];
			$mobile_topup = $_REQUEST['mobile_topup'];
		}else{
			$data['mobile_topup'] = '';
			$mobile_topup='';
		}
		if(!empty($_REQUEST['cn']))
		{
			$data['cn']= $_REQUEST['cn'];
		}else{
			$data['cn'] = '';
		}
	    $mobile_operator_id=$_REQUEST['mobile_operator_id']; 
		$where = array('operator_id' => $mobile_operator_id);
        $operator = $this->login_model->get_data_where_condition('operator_list', $where);
		$data['operator_name']=$operator[0]->operator_name;
		$data['operator_image']=operator_image."/".$operator[0]->operator_image;
		$data['mobile_operator_id']=$mobile_operator_id;
		$data['mobile_amount']=$_REQUEST['mobile_amount']; 
		if($data['mobile_amount']>$data['my_wallet']){
			$data['pay_status']='1';
			$data['payble_amount']=$data['mobile_amount']-$data['my_wallet'];
		}else{
			$data['pay_status']='';
			$data['payble_amount']=$data['mobile_amount'];
		}
			$where111 = array('free_coupon_category_status' =>1);
        	$data['coupon_category'] = $this->login_model->get_data_where_condition('free_coupon_category', $where111);
			$where11 = array('coupon_status' =>1);
        	$coupon = $this->login_model->get_data_where_condition('free_coupon_list', $where11);
			$data['coupon_list']=$coupon;
			$data['coupon_count']=count($coupon);
		
		 $this->session->set_userdata(array('recharge_no'=>$_REQUEST['mobile'],'operator_id'=>$mobile_operator_id,'mobile_amount'=>$_REQUEST['mobile_amount'],'mobile_topup'=>$mobile_topup,'cn'=>$data['cn'])); 
		// echo $this->session->userdata('mobile_amount');;die;
		 $this->load->view('web/inner-header');
		 $this->load->view('web/recharge_details',$data);
		  $this->load->view('web/inner_footer');
	}
function  free_coupon_list()
{
			$where111 = array('free_coupon_category_status' =>1);
        	$data['coupon_category'] = $this->login_model->get_data_where_condition('free_coupon_category', $where111);
			$where11 = array('coupon_status' =>1);
        	$coupon = $this->login_model->get_data_where_condition('free_coupon_list', $where11);
			$data['coupon_list']=$coupon;
			$data['coupon_count']=count($coupon);
			return $data;
}
function user_details()
{
	if ($this->session->userdata('user_id') == FALSE)
	 {
            redirect('web');
      }
	$user_id= $this->session->userdata('user_id');
	$req=file_get_contents( base_url('webservices/api.php?rquest=user_profile&user_id='.$user_id));
	return 	$wallet=json_decode($req);
}
// function saved card
function savedcard()
{
	if ($this->session->userdata('user_id') == FALSE)
	 {
            redirect('web');
      }
    $user_id= $this->session->userdata('user_id');
	$data=$this->input->post();
	if(!empty($data))
	{
	$card_no			=	$data['card_no'];
	$card_no 			= str_replace('-', '', $card_no);
	$expiry_month		=	$data['expiry_month'];
	$expiry_year		=	$data['expiry_year'];
	$cvv_no				=	$data['cvv_no'];
	$request=file_get_contents( base_url('webservices/api.php?rquest=save_cards&user_id='.$user_id.'&card_no='.$card_no.'&expiry_month='.$expiry_month.'&expiry_year='.$expiry_year.'&cvv_no='.$cvv_no));
		$result=json_decode($request);
		if(empty($result))
		{
			$this->toastr->error('Some Technical issue to save card details. Please try after sometime');
			redirect(base_url('Save-Cards'));
		}
		 $status=$result->status;
		 $message=$result->message; 
		if($status=='true')
		{
			$this->toastr->success("Card Add Successfully");
			// $this->session->set_flashdata('status', "Card Add Successfully");
		}else {
			$this->toastr->error($message);
			//$this->session->set_flashdata('error', $message);
		}
		
		redirect(base_url('Save-Cards'));
	}
}
	function payment_details()
	{
		if ($this->session->userdata('user_id') == FALSE)
	 	{
            redirect('web');
      	}
			 $user_id= $this->session->userdata('user_id'); 
			
			$wallet=$this->user_details();
			$data['my_wallet']=$wallet->wallet_amount;
			$data['amount'] = $this->session->userdata('mobile_amount');
			$bank=file_get_contents( base_url('webservices/api.php?rquest=bank_details'));
			$bank_json=json_decode($bank);
			$data['bank_list']=$bank_json->banks;
			$card=file_get_contents( base_url('webservices/api.php?rquest=get_savecard&user_id='.$user_id));
			$card_json=json_decode($card);
			if(!empty($card_json) && $card_json->status=='true')
			{
				
				$data['save_card']=$card_json->card_list;
				//print_r($data['save_card']);die;
				$i=0;
				foreach($data['save_card'] as $c){
			  
				$cardno=chunk_split($c->saved_card_no, 4, ' ');
				$check = $this->check_cc($cardno, true);
			   	$data['save_card'][$i]->card_name=$check;
			   	$i++;
				}
			}else{
				$data['save_card']='';
			}
			
		 $data1['uri_segment']='';
		 $this->load->view('web/inner-header',$data1);
		 $this->load->view('web/payment-details',$data);
		 $this->load->view('web/inner_footer');
	}
	// check validation of card
	function check_cc($cc, $extra_check = false){
    $cards = array(
        "visa" => "(4\d{12}(?:\d{3})?)",
        "amex" => "(3[47]\d{13})",
        "jcb" => "(35[2-8][89]\d\d\d{10})",
        "maestro" => "((?:5020|5038|6304|6579|6761)\d{12}(?:\d\d)?)",
        "solo" => "((?:6334|6767)\d{12}(?:\d\d)?\d?)",
        "mastercard" => "(5[1-5]\d{14})",
        "switch" => "(?:(?:(?:4903|4905|4911|4936|6333|6759)\d{12})|(?:(?:564182|633110)\d{10})(\d\d)?\d?)",
          "verve" => "(^506[0-9]{13}(?:[0-9]{3})?$)",
    );
    $names = array("Visa", "American Express", "JCB", "Maestro", "Solo", "Mastercard", "Switch",'verve');

    $matches = array();
    $pattern = "#^(?:".implode("|", $cards).")$#";
		
    $result = preg_match($pattern, str_replace(" ", "", $cc), $matches);
	
    if( $result > 0){
        $result = ($this->validatecard($cc))?1:0;
    }
    return ($result>0)?$names[sizeof($matches)-2]:false;
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
	
	// payment_via_card
	function payment_via_card()
	{


	$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
 
	$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; 

	if ($this->session->userdata('user_id') == FALSE)
	 {
            redirect('web');
     }


    $data				=	$this->input->post();

	if(isset($_GET) && !empty($_GET)){


		// $data = $_GET;
		$data['card_no'] 		= "";
		$data['expiry_month'] 	= "";
		$data['expiry_year'] 	= "";
		$data['cvv_no'] 		= "";
		$data['coupon_amount'] 	= isset($_SESSION['coupon_amount']) && $_SESSION['coupon_amount'] != '' ? $_SESSION['coupon_amount'] : '';

		$data['coupon_id'] 		= isset($_SESSION['coupon_id']) && $_SESSION['coupon_id'] != '' ? $_SESSION['coupon_id'] : '';

		$data['verve_card_status'] 		= isset($_SESSION['verve_card_status']) && $_SESSION['verve_card_status'] != '' ? $_SESSION['verve_card_status'] : '';
		$data['verve_card_pin'] 		= "";
		$data['step'] 					= 2;

		if($data['verve_card_status'] == 1){
			$parts = parse_url($url);
			parse_str($parts['query'], $query);
			$data['url']  =	$query['url'];
		}else{
			$data['url']  =	isset($url) && $url != '' ? $url: '';
		}



		$data['para'] 					= json_encode( array('status' => $_SESSION['status'],'trans_id' => $_SESSION['payment_transaction_id'],'ref_id' => $_SESSION['trans_ref_no'],'last_id' => $_SESSION['data_store_id']) );

	}


	if(!empty($data))
	{
		
	$user_id            = 	$this->session->userdata('user_id'); 
 	$card_no			= 	str_replace('-', '',$data['card_no']);
	$expiry_month		=	$data['expiry_month'];
	$expiry_year		=   $data['expiry_year'];
	$cvv_no				=	$data['cvv_no'];
	$coupon_amount		=	$_SESSION['coupon_amount']  =	$data['coupon_amount'];
	$coupon_id			=	$_SESSION['coupon_id']      =	$data['coupon_id'];
	$url				=	isset($data['url']) && $data['url'] != '' ? $data['url'] : '';
	$para				=	isset($data['para']) && $data['para'] != '' ? $data['para'] : '';

	$verve_card_status	=  $_SESSION['verve_card_status'] = isset($data['verve_card_status']) && $data['verve_card_status'] != '' ? $data['verve_card_status'] : 2;
	$verve_card_pin		= isset($data['verve_card_pin']) && $data['verve_card_pin'] != '' ? $data['verve_card_pin'] : '';
	$step				=	isset($data['step']) && $data['step'] != '' ? $data['step'] : 1;

	if(!empty($data['save_card_status']))
	{
		$save_card_status='1';
	}else{
		$save_card_status='2';
	}
	$amount				=	$this->session->userdata('mobile_amount'); 
	$recharge_no		=	$this->session->userdata('recharge_no'); 
	$operator_id		=	$this->session->userdata('operator_id'); 
 	$wt_category		=	$this->session->userdata('wt_category'); 
	$rec_category		=	$this->session->userdata('rec_category'); 
	$cn		            =	$this->session->userdata('cn'); 


	if($wt_category=='1'){
		
		$request=file_get_contents( base_url('webservices/api.php?rquest=add_money&recharge_user_id='.$user_id.'&payment_type=1&savecard_status='.$save_card_status.'&card_pay_type=1&payment_gateway_amt='.$amount.'&recharge_amount='.$amount.'&card_no='.$card_no.'&expiry_month='.$expiry_month.'&expiry_year='.$expiry_year.'&cvv_no='.$cvv_no.'&coupon_id='.$coupon_id.'&coupon_amount='.$coupon_amount.'&step='.$step.'&verve_card_status='.$verve_card_status.'&verve_card_pin='.$verve_card_pin.'&apiFrom=1'.'&url='.urlencode($url).'&para='.$para));
	}else 
	if($wt_category=='2' || $wt_category=='12'){

	//	echo 'verve_card_status = : '.   $url; exit;
		
$request=file_get_contents( base_url('webservices/apiweb.php?rquest=recharge_from_card&recharge_user_id='.$user_id.'&payment_type=1&savecard_status='.$save_card_status.'&card_pay_type=1&recharge_category_id='.$rec_category.'&operator_id='.$operator_id.'&recharge_number='.$recharge_no.'&payment_gateway_amt='.$amount.'&recharge_amount='.$amount.'&card_no='.$card_no.'&expiry_month='.$expiry_month.'&expiry_year='.$expiry_year.'&cvv_no='.$cvv_no.'&wt_category='.$wt_category.'&step='.$step.'&verve_card_status='.$verve_card_status.'&verve_card_pin='.$verve_card_pin.'&apiFrom=1'.'&url='.urlencode($url).'&para='.$para.'&cn='.$cn));
	}else if($wt_category=='11')
	{
		$consumer_number		=	$this->session->userdata('consumer_number'); 
		$biller_category_id		=	$this->session->userdata('biller_category_id');
		$biller_service_id		=	$this->session->userdata('biller_service_id'); 
		$biller_id				=	$this->session->userdata('biller_id'); 
		$recharge_no=$consumer_number;
		$request=file_get_contents( base_url('webservices/api.php?rquest=bill_pay_from_card&recharge_user_id='.$user_id.'&payment_type=1&savecard_status='.$save_card_status.'&card_pay_type=1&payment_gateway_amt='.$amount.'&recharge_amount='.$amount.'&card_no='.$card_no.'&expiry_month='.$expiry_month.'&expiry_year='.$expiry_year.'&cvv_no='.$cvv_no.'&wt_category='.$wt_category.'&bill_category_id='.$biller_category_id.'&bill_consumer_no='.$consumer_number.'&bill_amount='.$amount.'&biller_id='.$biller_id.'&step='.$step.'&verve_card_status='.$verve_card_status.'&verve_card_pin='.$verve_card_pin.'&apiFrom=1'.'&url='.urlencode($url).'&para='.$para));
		
		
	}else if($wt_category=='13')
	{
		$church_id				=	$this->session->userdata('church_id'); 
		$church_category_id		=	$this->session->userdata('church_category_id');
		$church_area_id			=	$this->session->userdata('church_area_id'); 
		$church_product_id		=	$this->session->userdata('church_product_id'); 
		$request=file_get_contents( base_url('webservices/api.php?rquest=donate_church_with_card&donar_user_id='.$user_id.'&payment_type=1&savecard_status='.$save_card_status.'&card_pay_type=1&wt_category='.$wt_category.'&church_id='.$church_id.'&church_area_id='.$church_area_id.'&church_category_id='.$church_category_id.'&church_product_id='.$church_product_id.'&church_product_price='.$amount.'&card_no='.$card_no.'&expiry_month='.$expiry_month.'&expiry_year='.$expiry_year.'&cvv_no='.$cvv_no.'&step='.$step.'&verve_card_status='.$verve_card_status.'&verve_card_pin='.$verve_card_pin.'&apiFrom=1'.'&url='.urlencode($url).'&para='.$para));

	}else if($wt_category=='16')
	{
		$event_id				=	$this->session->userdata('event_id'); 
		$mobile_amount			=	$this->session->userdata('mobile_amount');
		$ticket_json_array		=	$this->session->userdata('ticket_json_array'); 
		
			$request=file_get_contents( base_url('webservices/api.php?rquest=ticket_booking_payment_with_card&user_id='.$user_id.'&payment_type=1&savecard_status='.$save_card_status.'&card_pay_type=1&payment_gateway_price='.$amount.'&ticket_price='.$amount.'&card_no='.$card_no.'&expiry_month='.$expiry_month.'&expiry_year='.$expiry_year.'&cvv_no='.$cvv_no.'&wt_category='.$wt_category.'&event_id='.$event_id.'&tickets_records='.$ticket_json_array.'&step='.$step.'&verve_card_status='.$verve_card_status.'&verve_card_pin='.$verve_card_pin.'&apiFrom=1'.'&url='.urlencode($url).'&para='.$para));
		
	}
		  $result=json_decode($request);
		  if($step == 1){

		    	if($result->para->status == 'error'){
		    		//$this->session->set_flashdata('payment_msg', $result->para->message);
		    		$this->toastr->error($result->para->message);
		    		redirect('web/payment_details'); 
		    	}

		    	$_SESSION['status'] = $result->status;
		    	$_SESSION['payment_transaction_id'] = $result->para->trans_id;
		    	$_SESSION['trans_ref_no'] = $result->para->ref_id;
		    	$_SESSION['data_store_id'] = $result->para->last_id;

		    	if($result->para->chargeMethod == 'VBVSECURECODE'){
		    	 	header('Location: '.  $result->para->authurl); exit;
		    	}else{
		    		// open otp screen
		    		redirect('web/openModal?id='.base64_encode($result->para->trans_id).'&redirecturl='.base64_encode('Payment-Via-Card') ); 
		    		exit;
		    	}

		    }

		  

			$data1['status']=$result->status;
			$data1['message']=$result->message;
			$data1['trans_date']=$result->transaction_date;
			if(!empty($result->transaction_via))
			{
				$data1['transaction_via']=$result->transaction_via;
			}
			if(!empty($result->transaction_ref))
			{
				$data1['transaction_ref']=$result->transaction_ref;
			}
			if($wt_category=='1')
			{
				$data1['recharge_type']='Add Money';
			}else if($wt_category=='2')
			{
				if($rec_category=='1')
				{
					$data1['recharge_type']='Mobile';
				}elseif($rec_category=='2'){
					$data1['recharge_type']='DTH';
				}else{
					$data1['recharge_type']='Datacard';
				}

			}else if($wt_category=='13')
			{
				$data1['recharge_type']='Church Donation';
			}else if($wt_category=='11')
			{
				$data1['recharge_type']='Consumer Bill';
			}else if($wt_category=='16')
			{
				$data1['recharge_type']='Event Ticket';
			}
				$data1['wt_category']=$wt_category;
				$data1['amount']=$amount;
				$data1['recharge_no']=$recharge_no;
			if($wt_category!='13' && $wt_category!='11'&& $wt_category!='16')
			{
				$where = array('operator_id' => $operator_id);
        		$operator = $this->login_model->get_data_where_condition('operator_list', $where);
				$data1['operator_name']=$operator[0]->operator_name;
				$data1['operator_image']=operator_image."/".$operator[0]->operator_image;
			}else if($wt_category=='13'){
				$where1 = array('church_area_id' =>$church_area_id);
				$church_area = $this->login_model->get_data_where_condition('church_area', $where1);
				$where = array('church_id' => $church_id);
				$church_list = $this->login_model->get_data_where_condition('church_list', $where);
				$data1['operator_name']=$church_list[0]->church_name;  // church_name
				$data1['operator_image']=church_image."/".$church_list[0]->church_img;   // church image
				$data1['church_area']=$church_area[0]->church_area; 
			}else if($wt_category=='11'){
				$where=array('bill_invoice_no'=>$consumer_number);
				$bill_details = $this->login_model->get_record_join_two_table('biller_user','biller_details','biller_id','biller_id','',$where);
				$data1['operator_name']=$bill_details[0]->biller_company_name;
		 		$data1['operator_image']=biller_company_logo."/".$bill_details[0]->biller_company_logo;
				
			}else if($wt_category=='16'){
				
			$data['event_details'] = $this->login_model->get_simple_query("select event_name,event_image,event_date,event_place from event_list where event_id='".$event_id."'");
			$data1['operator_name']=$data['event_details'][0]->event_name;
		 	$data1['operator_image']=event_image."/".$data['event_details'][0]->event_image;
			$data1['event_date']=$data['event_details'][0]->event_date;
			$data1['event_place']=$data['event_details'][0]->event_place;
		
			}
			$this->session->set_userdata('array',$data1);
			if($result->status=='true')
			{
				$this->toastr->success($result->message,'Success');
			}else{
				$this->toastr->error($result->message,'Error');
			}
			
			
			redirect('Payment-Response');
	}
	}
function response()
{
	
	$data = $this->session->userdata('array'); 
	$this->load->view('web/inner-header');
	$this->load->view('web/add-money-success',$data);
	$this->load->view('web/inner_footer');
}
function payment_via_wallet()
{
	if ($this->session->userdata('user_id') == FALSE)
	 {
            redirect('web');
      }
	$user_id			= 	$this->session->userdata('user_id');
	$req 				=	file_get_contents( base_url('webservices/api.php?rquest=user_profile&user_id='.$user_id));
	$wallet				=	json_decode($req);
	$my_wallet			=	$wallet->wallet_amount; 
	$amount				=	$this->session->userdata('mobile_amount'); 
	if($my_wallet>=$amount)
	{
	$recharge_no		=	$this->session->userdata('recharge_no'); 
	$operator_id		=	$this->session->userdata('operator_id'); 
	$wt_category		=	$this->session->userdata('wt_category');
	$rec_category		=	$this->session->userdata('rec_category'); 
	$mobile_topup		=	$this->session->userdata('mobile_topup'); 
	$cn                 =   $this->session->userdata('cn');
	if($wt_category=='2'  || $wt_category=='12')
	{
		$request=file_get_contents( base_url('webservices/api.php?rquest=recharge&recharge_user_id='.$user_id.'&wt_category='.$wt_category.'&recharge_category_id='.$rec_category.'&operator_id='.$operator_id.'&recharge_number='.$recharge_no.'&recharge_amount='.$amount.'&mobile_topup='.$mobile_topup.'&cn='.$cn));
	}else if($wt_category=='11')
	{
		$consumer_number		=	$this->session->userdata('consumer_number'); 
		$biller_category_id		=	$this->session->userdata('biller_category_id');
		$biller_service_id		=	$this->session->userdata('biller_service_id'); 
		$request=file_get_contents(base_url('webservices/api.php?rquest=bill_recharge&recharge_user_id='.$user_id.'&wt_category='.$wt_category.'&bill_category_id='.$biller_category_id.'&bill_invoice_no='.$consumer_number.'&bill_amount='.$amount));
	}
	else if($wt_category=='13')
	{
		$church_id				=	$this->session->userdata('church_id'); 
		$church_category_id		=	$this->session->userdata('church_category_id');
		$church_area_id			=	$this->session->userdata('church_area_id'); 
		$church_product_id		=	$this->session->userdata('church_product_id'); 
		
		$request=file_get_contents( base_url('webservices/api.php?rquest=church_donate&donar_user_id='.$user_id.'&wt_category='.$wt_category.'&church_id='.$church_id.'&church_area_id='.$church_area_id.'&church_category_id='.$church_category_id.'&church_product_id='.$church_product_id.'&church_product_price='.$amount));
	}else if($wt_category=='16')
	{
		$event_id				=	$this->session->userdata('event_id'); 
		$mobile_amount			=	$this->session->userdata('mobile_amount');
		$ticket_json_array		=	$this->session->userdata('ticket_json_array'); 
		$request=file_get_contents( base_url('webservices/api.php?rquest=ticket_booking_payment&user_id='.$user_id.'&wt_category='.$wt_category.'&event_id='.$event_id.'&tickets_records='.$ticket_json_array.'&ticket_price='.$amount));
	}
			$result=json_decode($request);
			//print_r($result);die;
			$data1['status']=$result->status;
			$data1['message']=$result->message;
			if($result->status=='true')
			{
				$this->toastr->success($result->message,"Success");
			}else{
				$this->toastr->error($result->message,"Error");
			}
			$data1['trans_date']=$result->transaction_date;
			if($rec_category=='1')
			{
				$data1['recharge_type']='Mobile';
			}
			if(!empty($result->transaction_id))
			{
				$data1['transaction_ref']=$result->transaction_id;
			}
			if($wt_category=='1')
			{
				$data1['recharge_type']='Add Money';
			}else if($wt_category=='2')
			{
				if($rec_category=='1')
				{
					$data1['recharge_type']='Mobile';
				}
			}else if($wt_category=='11')
			{
				$data1['recharge_type']='Bill Payment';
			}else if($wt_category=='13')
			{
				$data1['recharge_type']='Church Donation';
			}else if($wt_category=='16')
			{
				$data1['recharge_type']='Event Ticket';
			}
			$data1['wt_category']=$wt_category;
			if($wt_category!='13' && $wt_category!='16' && $wt_category!='11')
			{
			$where = array('operator_id' => $operator_id);
        	$operator = $this->login_model->get_data_where_condition('operator_list', $where);
			$data1['operator_name']=$operator[0]->operator_name;
			$data1['operator_image']=operator_image."/".$operator[0]->operator_image;
			}else if($wt_category=='13'){
				$where1 = array('church_area_id' =>$church_area_id);
				$church_area = $this->login_model->get_data_where_condition('church_area', $where1);
				$where = array('church_id' => $church_id);
				$church_list = $this->login_model->get_data_where_condition('church_list', $where);
				$data1['operator_name']=$church_list[0]->church_name;  // church_name
				$data1['operator_image']=church_image."/".$church_list[0]->church_img;   // church image
				$data1['church_area']=$church_area[0]->church_area; 
			}else if($wt_category=='11'){
					$where=array('bill_invoice_no'=>$consumer_number);
		$data['bill_details'] = $this->login_model->get_record_join_two_table('biller_user','biller_details','biller_id','biller_id','',$where);
			 $data1['operator_name']=$data['bill_details'][0]->biller_company_name;
		 	$data1['operator_image']=biller_company_logo."/".$data['bill_details'][0]->biller_company_logo;
				
			}else if($wt_category=='16'){
				
			$data['event_details'] = $this->login_model->get_simple_query("select event_name,event_image,event_date,event_place from event_list where event_id='".$event_id."'");
			$data1['operator_name']=$data['event_details'][0]->event_name;
		 	$data1['operator_image']=event_image."/".$data['event_details'][0]->event_image;
			$data1['event_date']=$data['event_details'][0]->event_date;
			$data1['event_place']=$data['event_details'][0]->event_place;
			$data1['ticket_records']=$ticket_json_array;
			}
			$data1['transaction_via']='Oyacash';
			$data1['amount']=$amount;
			$data1['recharge_no']=$recharge_no;
			if($result->status=='true')
			{
				$this->toastr->success($result->message,'Success');
			}else{
				$this->toastr->error($result->message,'Error');
			}
			$this->session->set_userdata('array',$data1);
			redirect('Payment-Response');
	}else{
		 redirect(base_url('Payment-Details'));
	}
	}

// function payment via bank account
function payment_via_bankaccount()
{

	$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; 

	if ($this->session->userdata('user_id') == FALSE)
	 {
            redirect('web');
      }
	 $data				=	$this->input->post();


	if(isset($_GET) && !empty($_GET)){

		$parts = parse_url($url);
		parse_str($parts['query'], $query);

		$data['coupon_amount'] 	= isset($_SESSION['coupon_amount']) && $_SESSION['coupon_amount'] != '' ? $_SESSION['coupon_amount'] : '';

		$data['coupon_id'] 		= isset($_SESSION['coupon_id']) && $_SESSION['coupon_id'] != '' ? $_SESSION['coupon_id'] : '';
		$data['step'] 					= 2;
		$data['url'] 					= $query['url'];
		$data['para'] 					= json_encode( array('status' => $_SESSION['status'],'trans_id' => $_SESSION['payment_transaction_id'],'ref_id' => $_SESSION['trans_ref_no'],'last_id' => $_SESSION['data_store_id']) );

		$data['user_ac_no'] 			= "";
		$data['bank_code'] 				= "";
		$data['passcode'] 				= "";
	}


	if(!empty($data))
	{
		$user_id            =   $this->session->userdata('user_id'); 
 		$user_ac_no			=	$data['user_ac_no'];
		$bank_code			=	$data['bank_code'];
		$passcode			=	$data['passcode'];
		$coupon_amount		=	$data['coupon_amount'];
		$coupon_id			=	$data['coupon_id'];
		$rec_category		=	$this->session->userdata('rec_category'); 
		$amount				=	$this->session->userdata('mobile_amount'); 
		$recharge_no		=	$this->session->userdata('recharge_no'); 
		$operator_id		=	$this->session->userdata('operator_id'); 
		$wt_category		=	$this->session->userdata('wt_category'); 
		$operator_id		=	$this->session->userdata('operator_id'); 
		$cn                 =   $this->session->userdata('cn');

		$url				=	isset($data['url']) && $data['url'] != '' ? $data['url'] : '';
		$para				=	isset($data['para']) && $data['para'] != '' ? $data['para'] : '';

		$step				=	isset($data['step']) && $data['step'] != '' ? $data['step'] : 1;

		if($wt_category=='1'){
		
	$request=file_get_contents( base_url('webservices/api.php?rquest=add_money&recharge_user_id='.$user_id.'&payment_type=2&coupon_id='.$coupon_id.'&coupon_amount='.$coupon_amount.'&payment_gateway_amt='.$amount.'&recharge_amount='.$amount.'&recipient_bank='.$bank_code.'&recipient_account_number='.$user_ac_no.'&passcode='.$passcode));
	}
	if($wt_category=='2'  || $wt_category=='12'){

		$request=file_get_contents( base_url('webservices/api.php?rquest=recharge_from_card&recharge_user_id='.$user_id.'&payment_type=2&recharge_category_id='.$wt_category.'&operator_id='.$operator_id.'&recharge_number='.$recharge_no.'&payment_gateway_amt='.$amount.'&recharge_amount='.$amount.'&recipient_bank='.$bank_code.'&recipient_account_number='.$user_ac_no.'&passcode='.$passcode.'&step='.$step.'&apiFrom=1'.'&url='.urlencode($url).'&para='.$para.'&cn='.$cn ));
	}else if($wt_category=='11')
	{
		$consumer_number		=	$this->session->userdata('consumer_number'); 
		$biller_category_id		=	$this->session->userdata('biller_category_id');
		$biller_service_id		=	$this->session->userdata('biller_service_id'); 
		
		$request=file_get_contents( base_url('webservices/api.php?rquest=bill_pay_from_card&recharge_user_id='.$user_id.'&wt_category='.$wt_category.'&bill_category_id='.$biller_category_id.'&bill_invoice_no='.$consumer_number.'&bill_amount='.$amount.'&recipient_bank='.$bank_code.'&recipient_account_number='.$user_ac_no.'&passcode='.$passcode.'&payment_type=2&coupon_id='.$coupon_id.'&coupon_amount='.$coupon_amount));
	}	else if($wt_category=='13')
	{
		$church_id				=	$this->session->userdata('church_id'); 
		$church_category_id		=	$this->session->userdata('church_category_id');
		$church_area_id			=	$this->session->userdata('church_area_id'); 
		$church_product_id		=	$this->session->userdata('church_product_id'); 
		$request=file_get_contents( base_url('webservices/api.php?rquest=donate_church_with_card&donar_user_id='.$user_id.'&wt_category='.$wt_category.'&church_id='.$church_id.'&church_area_id='.$church_area_id.'&church_category_id='.$church_category_id.'&church_product_id='.$church_product_id.'&church_product_price='.$amount.'&recipient_bank='.$bank_code.'&recipient_account_number='.$user_ac_no.'&passcode='.$passcode.'&payment_type=2&coupon_id='.$coupon_id.'&coupon_amount='.$coupon_amount));
	}else if($wt_category=='16')
	{
		$event_id				=	$this->session->userdata('event_id'); 
		$ticket_json_array		=	$this->session->userdata('ticket_json_array'); 
		
		$request=file_get_contents( base_url('webservices/api.php?rquest=ticket_booking_payment_with_card&user_id='.$user_id.'&wt_category='.$wt_category.'&event_id='.$event_id.'&tickets_records='.$ticket_json_array.'&ticket_price='.$amount.'&payment_gateway_price='.$amount.'&recipient_bank='.$bank_code.'&recipient_account_number='.$user_ac_no.'&passcode='.$passcode.'&payment_type=2&coupon_id='.$coupon_id.'&coupon_amount='.$coupon_amount));
	}


		   $result = json_decode($request);

		   if($step == 1){

		   	   if($result->para->status == 'error'){
		    		$this->session->set_flashdata('payment_msg', $result->para->message);
		    		redirect('web'); exit;
		    	}

		    	$_SESSION['status'] = $result->status;
		    	$_SESSION['payment_transaction_id'] = $result->para->trans_id;
		    	$_SESSION['trans_ref_no'] = $result->para->ref_id;
		    	$_SESSION['data_store_id'] = $result->para->last_id;

		    	if($result->para->chargeMethod == 'AUTH'){

		    		// open otp screen
		    		redirect('web/openModalBankAcc?id='.base64_encode($result->para->trans_id).'&redirecturl='.base64_encode('web/payment_via_bankaccount') ); 
		    		exit;

		    	}

		    }

		   // print_r($result); exit;
			
			$data1['status']=$result->status;
			$data1['message']=$result->message;

			$data1['trans_date']=$result->transaction_date;
			$data1['transaction_via']="Bank Account";
			
			if(!empty($result->transaction_ref))
			{
				$data1['transaction_ref']=$result->transaction_ref;
			}
			if($wt_category=='1')
			{
				$data1['recharge_type']='Add Money';
			}else if($wt_category=='2')
			{
				if($rec_category=='1')
				{
					$data1['recharge_type']='Mobile';
				}
			}else if($wt_category=='11')
			{
				$data1['recharge_type']='Bill Payment';
			}else if($wt_category=='13')
			{
				$data1['recharge_type']='Church Donation';
			}else if($wt_category=='16')
			{
				$data1['recharge_type']='Event Ticket';
			}
			$data1['wt_category']=$wt_category;
			$data1['amount']=$amount;
			$data1['recharge_no']=$recharge_no;
		if($wt_category!='13' && $wt_category!='16' && $wt_category!='11')
			{
			$where = array('operator_id' => $operator_id);
        	$operator = $this->login_model->get_data_where_condition('operator_list', $where);
			$data1['operator_name']=$operator[0]->operator_name;
			$data1['operator_image']=operator_image."/".$operator[0]->operator_image;
			}else if($wt_category=='13'){
				$where1 = array('church_area_id' => $church_area_id);
				$church_area = $this->login_model->get_data_where_condition('church_area', $where1);
				$where = array('church_id' => $church_id);
				$church_list = $this->login_model->get_data_where_condition('church_list', $where);
				$data1['operator_name']=$church_list[0]->church_name;  // church_name
				$data1['operator_image']=church_image."/".$church_list[0]->church_img;   // church image
				$data1['church_area']=$church_area[0]->church_area; 
			}else if($wt_category=='11'){
					$where=array('bill_invoice_no'=>$consumer_number);
		$data1['bill_details'] = $this->login_model->get_record_join_two_table('biller_user','biller_details','biller_id','biller_id','',$where);
			 $data1['operator_name']=$data['bill_details'][0]->biller_company_name;
		 	$data1['operator_image']=biller_company_logo."/".$data['bill_details'][0]->biller_company_logo;
				
			}else if($wt_category=='16'){
				
			$data['event_details'] = $this->login_model->get_simple_query("select event_name,event_image,event_date,event_place from event_list where event_id='".$event_id."'");
			$data1['operator_name']=$data['event_details'][0]->event_name;
		 	$data1['operator_image']=event_image."/".$data['event_details'][0]->event_image;
			$data1['event_date']=$data['event_details'][0]->event_date;
			$data1['event_place']=$data['event_details'][0]->event_place;
			$data1['ticket_records']=$ticket_json_array;
			}
			if($result->status=='true')
			{
				$this->toastr->success($result->message,'Success');
			}else{
				$this->toastr->error($result->message,'Error');
			}
			$this->session->set_userdata('array',$data1);
			redirect('Payment-Response');
		
	}
}
// function paymewnt via save cardarray_combine($output, $output);
function payment_via_savecard()
{

	$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; 
 
	if ($this->session->userdata('user_id') == FALSE)
	 {
            redirect('web');
     }

	 $data			=	$this->input->post();


	 if(isset($_GET) && !empty($_GET)){

		$data['card_selected']		= $_SESSION['card_selected'];
		$data['card_token']			= $_SESSION['card_token'];

		$data['coupon_amount'] 	= isset($_SESSION['coupon_amount']) && $_SESSION['coupon_amount'] != '' ? $_SESSION['coupon_amount'] : '';

		$data['coupon_id'] 		= isset($_SESSION['coupon_id']) && $_SESSION['coupon_id'] != '' ? $_SESSION['coupon_id'] : '';

		$data['verve_card_status'] 		= isset($_SESSION['verve_card_status']) && $_SESSION['verve_card_status'] != '' ? $_SESSION['verve_card_status'] : '';
		$data['verve_card_pin'] 		= "";
		$data['step'] 					= 2;

		if($data['verve_card_status'] == 1){
			$parts = parse_url($url);
			parse_str($parts['query'], $query);
			$data['url']  =	$query['url'];
		}else{
			$data['url']  =	isset($url) && $url != '' ? $url: '';
		}

		$data['para'] 					= json_encode( array('status' => $_SESSION['status'],'trans_id' => $_SESSION['payment_transaction_id'],'ref_id' => $_SESSION['trans_ref_no'],'last_id' => $_SESSION['data_store_id']) );

	}

		
	 if(!empty($data))
	{
		$user_id= $this->session->userdata('user_id'); 
		$select_card_token = $_SESSION['card_selected'] = $data['card_selected'];
		$card_token = $_SESSION['card_token'] = $data['card_token'];
		for($i=0;$i<count($card_token);$i++)
		{
			if($data['card_token'][$i]==$select_card_token)
			{
				$card_token=$data['card_token'][$i];
				@$cvv_no=$data['cvv_no'][$i];
			}
		}
 		$coupon_amount		=	$_SESSION['coupon_amount'] = $data['coupon_amount'];
		$coupon_id			=	$_SESSION['coupon_id'] = $data['coupon_id'];
		$amount				=	$this->session->userdata('mobile_amount'); 
		$recharge_no		=	$this->session->userdata('recharge_no'); 
		$operator_id		=	$this->session->userdata('operator_id'); 
		$wt_category		=	$this->session->userdata('wt_category'); 
		$rec_category		=	$this->session->userdata('rec_category'); 
		$cn                 =   $this->session->userdata('cn');
		$url				=	isset($data['url']) && $data['url'] != '' ? $data['url'] : '';
		$para				=	isset($data['para']) && $data['para'] != '' ? $data['para'] : '';

		$verve_card_status	=  $_SESSION['verve_card_status'] = isset($data['verve_card_status']) && $data['verve_card_status'] != '' ? $data['verve_card_status'] : 2;
		$verve_card_pin		= isset($data['verve_card_pin']) && $data['verve_card_pin'] != '' ? $data['verve_card_pin'] : '';
		$step				=	isset($data['step']) && $data['step'] != '' ? $data['step'] : 1;

		if(!empty($data['save_card_status']))
		{
			$save_card_status='1';
		}else{
			$save_card_status='2';
		}


		if($wt_category=='1'){
			
			$request=file_get_contents( base_url('webservices/api.php?rquest=add_money&recharge_user_id='.$user_id.'&payment_type=1&&card_pay_type=2&wt_category='.$wt_category.'&coupon_id='.$coupon_id.'&coupon_amount='.$coupon_amount.'&payment_gateway_amt='.$amount.'&recharge_amount='.$amount.'&card_token='.$card_token.'&cvv_no='.$cvv_no.'&step='.$step.'&verve_card_status='.$verve_card_status.'&verve_card_pin='.$verve_card_pin.'&apiFrom=1'.'&url='.urlencode($url).'&para='.$para));
	}if($wt_category=='2'  || $wt_category=='12'){
		
	$request=file_get_contents( base_url('webservices/api.php?rquest=recharge_from_card&recharge_user_id='.$user_id.'&payment_type=1&&card_pay_type=2&wt_category='.$wt_category.'&coupon_id='.$coupon_id.'&coupon_amount='.$coupon_amount.'&recharge_category_id='.$rec_category.'&operator_id='.$operator_id.'&recharge_number='.$recharge_no.'&payment_gateway_amt='.$amount.'&recharge_amount='.$amount.'&card_token='.$card_token.'&cvv_no='.$cvv_no.'&step='.$step.'&verve_card_status='.$verve_card_status.'&verve_card_pin='.$verve_card_pin.'&apiFrom=1'.'&url='.urlencode($url).'&para='.$para.'&cn='.$cn));
	}else if($wt_category=='11')
	{
		$consumer_number		=	$this->session->userdata('consumer_number'); 
		$biller_category_id		=	$this->session->userdata('biller_category_id');
		$biller_service_id		=	$this->session->userdata('biller_service_id'); 
		$biller_id				=	$this->session->userdata('biller_id'); 
		$recharge_no=$consumer_number;
		
		$request=file_get_contents( base_url('webservices/api.php?rquest=bill_pay_from_card&recharge_user_id='.$user_id.'&payment_type=1&&card_pay_type=2&payment_gateway_amt='.$amount.'&coupon_id='.$coupon_id.'&coupon_amount='.$coupon_amount.'&recharge_amount='.$amount.'&card_token='.$card_token.'&cvv_no='.$cvv_no.'&wt_category='.$wt_category.'&bill_category_id='.$biller_category_id.'&bill_consumer_no='.$consumer_number.'&bill_amount='.$amount.'&biller_id='.$biller_id.'&step='.$step.'&verve_card_status='.$verve_card_status.'&verve_card_pin='.$verve_card_pin.'&apiFrom=1'.'&url='.urlencode($url).'&para='.$para));
		
		
	}else if($wt_category=='13')
	{
		$church_id				=	$this->session->userdata('church_id'); 
		$church_category_id		=	$this->session->userdata('church_category_id');
		$church_area_id			=	$this->session->userdata('church_area_id'); 
		$church_product_id		=	$this->session->userdata('church_product_id'); 
		$request=file_get_contents( base_url('webservices/api.php?rquest=donate_church_with_card&payment_type=1&&card_pay_type=2&donar_user_id='.$user_id.'&wt_category='.$wt_category.'&church_id='.$church_id.'&church_area_id='.$church_area_id.'&church_category_id='.$church_category_id.'&church_product_id='.$church_product_id.'&church_product_price='.$amount.'&card_token='.$card_token.'&cvv_no='.$cvv_no.'&coupon_id='.$coupon_id.'&coupon_amount='.$coupon_amount.'&step='.$step.'&verve_card_status='.$verve_card_status.'&verve_card_pin='.$verve_card_pin.'&apiFrom=1'.'&url='.urlencode($url).'&para='.$para));
	}else if($wt_category=='16')
	{
		$event_id				=	$this->session->userdata('event_id'); 
		$mobile_amount			=	$this->session->userdata('mobile_amount');
		$ticket_json_array		=	$this->session->userdata('ticket_json_array'); 
		
			$request=file_get_contents( base_url('webservices/api.php?rquest=ticket_booking_payment_with_card&user_id='.$user_id.'&payment_type=1&&card_pay_type=2&payment_gateway_price='.$amount.'&ticket_price='.$amount.'&card_token='.$card_token.'&cvv_no='.$cvv_no.'&wt_category='.$wt_category.'&event_id='.$event_id.'&tickets_records='.$ticket_json_array.'&coupon_id='.$coupon_id.'&coupon_amount='.$coupon_amount.'&step='.$step.'&verve_card_status='.$verve_card_status.'&verve_card_pin='.$verve_card_pin.'&apiFrom=1'.'&url='.urlencode($url).'&para='.$para));
		
	}
			$result=json_decode($request);

			if($step == 1){

			 	if($result->para->status == 'error'){
		    	//	$this->session->set_flashdata('payment_msg', $result->para->message);
			 		$this->toastr->error($result->para->message,"Error");
		    		redirect('web/payment_details'); exit;
		    	}

		    	$_SESSION['status'] = $result->status;
		    	$_SESSION['payment_transaction_id'] = $result->para->trans_id;
		    	$_SESSION['trans_ref_no'] = $result->para->ref_id;
		    	$_SESSION['data_store_id'] = $result->para->last_id;

		    	if($result->para->chargeMethod == 'VBVSECURECODE'){
		    	 	header('Location: '.  $result->para->authurl); exit;
		    	}else{
		    		// open otp screen
		    		redirect('web/openModal?id='.base64_encode($result->para->trans_id).'&redirecturl='.base64_encode('web/payment_via_savecard') ); 
		    		exit;
		    	}

		    }

			$data1['status']=$result->status;
			$data1['message']=$result->message;
			$data1['trans_date']=$result->transaction_date;
			$data1['transaction_via']="Saved Card";
			
			if(!empty($result->transaction_ref))
			{
				$data1['transaction_ref']=$result->transaction_ref;
			}
			if($wt_category=='1')
			{
				$data1['recharge_type']='Add Money';
			}else if($wt_category=='2')
			{
				if($rec_category=='1')
				{
					$data1['recharge_type']='Mobile';
				}
			}else if($wt_category=='11')
			{
				$data1['recharge_type']='Bill Payment';
			}else if($wt_category=='13')
			{
				$data1['recharge_type']='Church Donation';
			}else if($wt_category=='16')
			{
				$data1['recharge_type']='Event Ticket';
			}

			$data1['wt_category']=$wt_category;
			$data1['amount']=$amount;
			$data1['recharge_no']=$recharge_no;
		if($wt_category!='13' && $wt_category!='16' && $wt_category!='11')
			{
			$where = array('operator_id' => $operator_id);
        	$operator = $this->login_model->get_data_where_condition('operator_list', $where);
			$data1['operator_name']=$operator[0]->operator_name;
			$data1['operator_image']=operator_image."/".$operator[0]->operator_image;
			}else if($wt_category=='13'){
				$where1 = array('church_area_id' => $church_area_id);
				$church_area = $this->login_model->get_data_where_condition('church_area', $where1);
				$where = array('church_id' => $church_id);
				$church_list = $this->login_model->get_data_where_condition('church_list', $where);
				$data1['operator_name']=$church_list[0]->church_name;  // church_name
				$data1['operator_image']=church_image."/".$church_list[0]->church_img;   // church image
				$data1['church_area']=$church_area[0]->church_area; 
			}else if($wt_category=='11'){
					$where=array('bill_invoice_no'=>$consumer_number);
		$data['bill_details'] = $this->login_model->get_record_join_two_table('biller_user','biller_details','biller_id','biller_id','',$where);
			 $data1['operator_name']=$data['bill_details'][0]->biller_company_name;
		 	$data1['operator_image']=biller_company_logo."/".$data['bill_details'][0]->biller_company_logo;
				
			}else if($wt_category=='16'){
				
			$data['event_details'] = $this->login_model->get_simple_query("select event_name,event_image,event_date,event_place from event_list where event_id='".$event_id."'");
			$data1['operator_name']=$data['event_details'][0]->event_name;
		 	$data1['operator_image']=event_image."/".$data['event_details'][0]->event_image;
			$data1['event_date']=$data['event_details'][0]->event_date;
			$data1['event_place']=$data['event_details'][0]->event_place;
			$data1['ticket_records']=$ticket_json_array;
			}
			if($result->status=='true')
			{
				$this->toastr->success($result->message,'Success');
			}else{
				$this->toastr->error($result->message,'Error');
			}
			$this->session->set_userdata('array',$data1);
			redirect('Payment-Response');
		
	
		
	}
}
	function my_account()
	{
		$data1['uri_segment']='my_profile';
		$data['my_profile']=$this->user_details();
		$this->load->view('web/inner-header',$data1);
		 $this->load->view('web/my-account',$data);
		 $this->load->view('web/inner_footer');
	}
	function Save_Cards()
	{
		if ($this->session->userdata('user_id') == FALSE)
	 {
            redirect('web');
      }
	 
		$user_id= $this->session->userdata('user_id'); 
		$card=file_get_contents( base_url('webservices/api.php?rquest=get_savecard&user_id='.$user_id));
			$card_json=json_decode($card);
			if(!empty($card_json) && $card_json->status=='true')
			{
				$data['save_card']=$card_json->card_list;
				$i=0;
				foreach($data['save_card'] as $c){
			  
				$cardno=chunk_split($c->saved_card_no, 4, ' ');
				$check = $this->check_cc($cardno, true);
			   	$data['save_card'][$i]->card_name=$check;
			   	$i++;
				}
			}else{
				$data['save_card']='';
			}
		 $data['uri_segment']='save_card';
		 $this->load->view('web/inner-header',$data);
		 $this->load->view('web/Save_Cards',$data);
		 $this->load->view('web/inner_footer');
	}

	function wallet()
	{
		if ($this->input->post('sub_btn')) {
            $data 			= 	$this->input->post();
          	$amount			=	$data['amount'];
			$promo_code		=	$data['promo_code'];
			$coupon_amount	=	$data['coupon_amount'];
			$coupon_id		=	$data['coupon_id'];
			$this->session->set_userdata(array('mobile_amount'=>$amount,'promo_code'=>$promo_code,'coupon_amount'=>$coupon_amount,'coupon_id'=>$coupon_id,'wt_category'=>'1')); 
            redirect('web/payment_details');
        } else {
        $wallet=$this->user_details(); 
		$data['my_wallet']=$wallet->wallet_amount;
		$bank=file_get_contents( base_url('webservices/api.php?rquest=bank_details'));
		$bank_json=json_decode($bank);
		$data['bank_list']=$bank_json->banks;
		$data['uri_segment']='wallet_amount';
		$this->load->view('web/inner-header',$data);
		$this->load->view('web/wallet',$data);
		$this->load->view('web/inner_footer');
		}
	}
	


	function change_password()
	{
		//echo "hii";die;
		 $this->load->view('web/inner-header');
		 $this->load->view('web/change-password');
		 $this->load->view('web/inner_footer');
	}

	function my_transactions111()
	{
		//echo "hii";die;
		 $this->load->view('web/inner-header');
		 $this->load->view('web/my-transactions');
		 $this->load->view('web/inner_footer');
	}

	function add_money()
	{
		//echo "hii";die;
		 $this->load->view('web/inner-header');
		 $this->load->view('web/add-money');
		 $this->load->view('web/inner_footer');
	}

	function add_money_success()
	{
		//echo "hii";die;
		 $this->load->view('web/inner-header');
		 $this->load->view('web/add-money-success');
		 $this->load->view('web/inner_footer');
	}
	// recgarge mobile///
	function check_login(){
		$user_id= $this->session->userdata('user_id');
		if(!empty($_REQUEST['mobile'])){
			$mobile=$_REQUEST['mobile'];
			$prepaid=$_REQUEST['prepaid'];
			$mobile_operator_id=$_REQUEST['mobile_operator_id'];
			$mobile_amount=$_REQUEST['mobile_amount'];
		}
		if(!empty($_REQUEST['tv_number'])){
			$tv_number=$_REQUEST['tv_number'];
			$tv_operator_id=$_REQUEST['tv_operator_id'];
			$tv_rec_amount=$_REQUEST['tv_rec_amount'];
		}
		
		if(!empty($_REQUEST['data_card_number'])){
			$data_card_number=$_REQUEST['data_card_number'];
			//$data_prepaid=$_REQUEST['data_prepaid'];
			$data_operator_id=$_REQUEST['data_operator_id'];
			$data_rec_amount=$_REQUEST['data_rec_amount'];
		}
		if(!empty($_REQUEST['consumer_number'])){
			$consumer_number=$_REQUEST['consumer_number'];
			$biller_category_id=$_REQUEST['biller_category_id'];
			$biller_service_id=$_REQUEST['biller_service_id'];
			$bill_payment=$_REQUEST['bill_payment'];
			$biller_id=$_REQUEST['biller_id'];
		}
		if(!empty($_REQUEST['electricity_card_number'])){
			$electric_card_number=$_REQUEST['electricity_card_number'];
			$electricty_operator_id=$_REQUEST['electricity_operator_id'];
			$electrice_amount=$_REQUEST['electricity_amount'];
		}
		if(!empty($_REQUEST['church_area'])){
			$church_area=$_REQUEST['church_area'];
			$church_price_id=$_REQUEST['church_price_id'];
			$church_id=$_REQUEST['church_id'];
			$church_price=$_REQUEST['church_price'];
			$church_category_id=$_REQUEST['church_category_id'];
		}
		if(!empty($_REQUEST['event_id'])){
			$event_id=$_REQUEST['event_id'];
			$total_price_ticket=$_REQUEST['total_price_ticket'];
			$ticket_json_array=$_REQUEST['ticket_json_array'];
			
		}
		if(!empty($_REQUEST['rec_category']))
		{
			$rec_category		=	$_REQUEST['rec_category'];
		}
		 	
			  $wt_category		=	$_REQUEST['wt_category'];
		if(!empty($mobile)){
			$this->session->set_userdata(array('mobile'=>$mobile,'prepaid'=>$prepaid,'mobile_operator_id'=>$mobile_operator_id,'mobile_amount'=>$mobile_amount,'rec_category'=>$rec_category,'wt_category'=>$wt_category)); 
		}else if(!empty($tv_number)){
			$this->session->set_userdata(array('tv_number'=>$tv_number,'tv_operator_id'=>$tv_operator_id,'mobile_amount'=>$tv_rec_amount,'wt_category'=>$wt_category,'rec_category'=>$rec_category)); 
		}else if(!empty($data_card_number)){
			$this->session->set_userdata(array('data_card_number'=>$data_card_number,'data_operator_id'=>$data_operator_id,'mobile_amount'=>$data_rec_amount,'wt_category'=>$wt_category,'rec_category'=>$rec_category)); 
		}else if(!empty($consumer_number)){
			$this->session->set_userdata(array('consumer_number'=>$consumer_number,'biller_category_id'=>$biller_category_id,'biller_service_id'=>$biller_service_id,'wt_category'=>$wt_category,'mobile_amount'=>$bill_payment,'biller_id'=>$biller_id)); 
		}else if(!empty($electric_card_number)){
			$this->session->set_userdata(array('electric_card_number'=>$electric_card_number,'electricty_operator_id'=>$electricty_operator_id,'mobile_amount'=>$electrice_amount,'wt_category'=>$wt_category)); 
		}else if(!empty($church_p_id)){
			$this->session->set_userdata(array('church_area'=>$church_area,'church_price_id'=>$church_price_id,'church_id'=>$church_id,'mobile_amount'=>$church_price,'church_category_id'=>$church_category_id,'wt_category'=>$wt_category)); 
		}else if(!empty($event_id)){
			$this->session->set_userdata(array('event_id'=>$event_id,'mobile_amount'=>$total_price_ticket,'ticket_json_array'=>$ticket_json_array,'wt_category'=>$wt_category)); 
		}
		if(empty($user_id)){
		
			echo 2;
			
		}else{
			echo 1;
		}
		
		
	}
function event_booking()
{
	if ($this->session->userdata('user_id') == FALSE) {
            redirect('web');
        }
		$user_id= $this->session->userdata('user_id'); 
		$result=file_get_contents( base_url('webservices/api.php?rquest=user_profile&user_id='.$user_id));
		$wallet=json_decode($result);
		$data['my_profile']=json_decode($result);
		$data['my_wallet']=$wallet->wallet_amount;
		$data['mobile']=$wallet->user_contact_no;
		$data['user_id']=$user_id;
		$total_price_ticket= $_REQUEST['event_ticket_price']; 
		$event_id= $_REQUEST['event_id']; 
		$ticket_json_array= $_REQUEST['ticket_json_array']; 
       //$data['church_price']=$_REQUEST['church_price']; 
	   	$data['recharge_category_id']=7; // ] church
		$where = array('event_id' => $event_id);
        $event_list = $this->login_model->get_data_where_condition('event_list', $where);
		$data['operator_name']=$event_list[0]->event_name;  // church_name
		$event_image = explode(",",$event_list[0]->event_image);
		$data['operator_image']=event_image."/".$event_image[0];   // church image
		$data['mobile_operator_id']=$event_id;
		$data['mobile_amount']=$total_price_ticket; 
		if($data['mobile_amount']>$data['my_wallet']){
			$data['pay_status']='1';
			$data['payble_amount']=$data['mobile_amount']-$data['my_wallet'];
		}else{
			$data['pay_status']='';
			$data['payble_amount']=$data['mobile_amount'];
		}
			$where111 = array('free_coupon_category_status' =>1);
        	$data['coupon_category'] = $this->login_model->get_data_where_condition('free_coupon_category', $where111);
			$where11 = array('coupon_status' =>1);
        	$coupon = $this->login_model->get_data_where_condition('free_coupon_list', $where11);
			$data['coupon_list']=$coupon;
			$data['coupon_count']=count($coupon);
        	
			
			$this->session->set_userdata(array('event_id'=>$event_id,'total_price_ticket'=>$total_price_ticket,'ticket_json_array'=>$ticket_json_array)); 
		
		 $this->load->view('web/inner-header');
		 $this->load->view('web/recharge_details',$data);
		 $this->load->view('web/inner_footer');
}

// function pay bill.....
function pay_bill(){
		if ($this->session->userdata('user_id') == FALSE) {
            redirect('web');
        }
		$user_id= $this->session->userdata('user_id'); 
		$result=file_get_contents( base_url('webservices/api.php?rquest=user_profile&user_id='.$user_id));
		$wallet=json_decode($result);
		$data['my_profile']=json_decode($result);
		$data['my_wallet']=$wallet->wallet_amount;
		 $data['recharge_category_id']='4'; // ] pay bill
		  $data['biller_category_id']=$_REQUEST['biller_category_id']; // ] pay bill
		 $data['mobile']=$_REQUEST['i_n']; 
		 $data['mobile_operator_id']=$_REQUEST['biller_service_id']; 
	 	$where=array('bill_invoice_no'=>$_REQUEST['i_n']);
		$data['bill_details'] = $this->login_model->get_record_join_two_table('biller_user','biller_details','biller_id','biller_id','',$where);
		 $data['operator_name']=$data['bill_details'][0]->biller_company_name;
		 $data['operator_image']=biller_company_logo."/".$data['bill_details'][0]->biller_company_logo;
		 $data['mobile_amount']=$data['bill_details'][0]->bill_amount;
		 $data['bill_pay_status']=$data['bill_details'][0]->bill_pay_status;
		 if($data['bill_pay_status']=='1'){
		 	$where111 = array('	bill_invoice_no' =>$_REQUEST['i_n']);
        	$data['bill_pay_details'] = $this->login_model->get_data_where_condition('bill_recharge', $where111);
		$data['bill_paid_date']=$data['bill_pay_details'][0]->bill_pay_date;
		$data['bill_transaction_no']=$data['bill_pay_details'][0]->bill_transaction_id ;
		 }
		$where111 = array('free_coupon_category_status' =>1);
        	$data['coupon_category'] = $this->login_model->get_data_where_condition('free_coupon_category', $where111);
			$where11 = array('coupon_status' =>1);
        	$data['coupon_list'] = $this->login_model->get_data_where_condition('free_coupon_list', $where11);
		 	if($data['mobile_amount']>$data['my_wallet']){
			$data['pay_status']='1';
			$data['payble_amount']=$data['mobile_amount']-$data['my_wallet'];
		}else{
			$data['payble_amount']=$data['mobile_amount'];
		}
		
		$this->session->set_userdata(array('biller_category_id'=>$data['biller_category_id'],'consumer_number'=>$data['mobile'],'biller_service_id'=> $data['mobile_operator_id'],'biller_id'=>$data['bill_details'][0]->biller_id)); 
		
		 $this->load->view('web/inner-header');
		 $this->load->view('web/recharge_details',$data);
		 $this->load->view('web/inner_footer');
	}

	function my_recharge(){
		if ($this->session->userdata('user_id') == FALSE) 
		{
            redirect('web');
        }
		$user_id= $this->session->userdata('user_id'); 
		$result=file_get_contents( base_url('webservices/api.php?rquest=user_profile&user_id='.$user_id));
		$wallet=json_decode($result);
		$data['my_profile']=json_decode($result);
		$data['my_wallet']=$wallet->wallet_amount;
	 	$data['mobile']=$_REQUEST['mobile']; 
	 	$data['user_id']=$user_id;
       $data['prepaid']=$_REQUEST['prepaid']; 
	   $data['recharge_category_id']='1'; // ] Mobile
	
	    $mobile_operator_id=$_REQUEST['mobile_operator_id']; 
		$where = array('operator_id' => $mobile_operator_id);
        $operator = $this->login_model->get_data_where_condition('operator_list', $where);
		$data['operator_name']=$operator[0]->operator_name;
		$data['operator_image']=$operator[0]->operator_image;
		$data['mobile_operator_id']=$mobile_operator_id;
		$data['mobile_amount']=$_REQUEST['mobile_amount']; 
		if($data['mobile_amount']>$data['my_wallet']){
			$data['pay_status']='1';
			$data['payble_amount']=$data['mobile_amount']-$data['my_wallet'];
		}else{
			$data['pay_status']='';
			$data['payble_amount']=$data['mobile_amount'];
		}
		$where111 = array('free_coupon_category_status' =>1);
        	$data['coupon_category'] = $this->login_model->get_data_where_condition('free_coupon_category', $where111);
			$where11 = array('coupon_status' =>1);
        	$data['coupon_list'] = $this->login_model->get_data_where_condition('free_coupon_list', $where11);
			
		$this->load->view('web/inner-header',$data);
        $this->load->view('web/recharge-details',$data);
        $this->load->view('web/inner-footer');
	}



	function tv_recharge(){
			 if ($this->session->userdata('user_id') == FALSE) {
            redirect('web');
        }
		$user_id= $this->session->userdata('user_id');
		$result=file_get_contents( base_url('webservices/api.php?rquest=user_profile&user_id='.$user_id));
		$wallet=json_decode($result);
		$data['my_profile']=json_decode($result);
		$data['my_wallet']=$wallet->wallet_amount;
	 $data['mobile']=$_REQUEST['tv_number']; 
	 $data['user_id']=$user_id;
       
	  $data['recharge_category_id']='2'; // ] Mobile
	    $tv_operator_id=$_REQUEST['tv_operator_id']; 
		 $where = array('operator_id' => $tv_operator_id);
            $operator = $this->login_model->get_data_where_condition('operator_list', $where);
			$data['operator_name']=$operator[0]->operator_name;
			$data['operator_image']=$operator[0]->operator_image;
		 $data['mobile_operator_id']=$tv_operator_id;
		  $data['mobile_amount']=$_REQUEST['tv_rec_amount']; 
		  if($data['my_wallet']<$_REQUEST['tv_rec_amount']){
			$data['pay_status']='1';
			$data['payble_amount']=$_REQUEST['tv_rec_amount']-$data['my_wallet'];
		}else{
			$data['payble_amount']=$_REQUEST['tv_rec_amount'];
		}
			$where111 = array('free_coupon_category_status' =>1);
        	$data['coupon_category'] = $this->login_model->get_data_where_condition('free_coupon_category', $where111);
			$where11 = array('coupon_status' =>1);
        	$data['coupon_list'] = $this->login_model->get_data_where_condition('free_coupon_list', $where11);
			
		$this->load->view('web/inner-header',$data);
        $this->load->view('web/recharge-details',$data);
        $this->load->view('web/inner-footer');
	}
	function datacard_recharge(){
		if ($this->session->userdata('user_id') == FALSE) 
		{
            redirect('web');
        }
	$user_id= $this->session->userdata('user_id');
	$result=file_get_contents( base_url('webservices/api.php?rquest=user_profile&user_id='.$user_id));
	$wallet=json_decode($result);
	$data['my_wallet']=$wallet->wallet_amount;
	$data['my_profile']=json_decode($result);
	$data['mobile']=$_REQUEST['data_card_number']; 
	$data['user_id']=$user_id;
       
	  $data['recharge_category_id']='3'; // ] Mobile
	  $data_operator_id=$_REQUEST['data_operator_id']; 
	  $where = array('operator_id' => $data_operator_id);
      $operator = $this->login_model->get_data_where_condition('operator_list', $where);
	  $data['operator_name']=$operator[0]->operator_name;
	  $data['operator_image']=$operator[0]->operator_image;
//		 $data['data_prepaid_id']=$_REQUEST['data_prepaid'];
	  $data['mobile_operator_id']=$data_operator_id;
	  $data['mobile_amount']=$_REQUEST['data_rec_amount']; 
		   if($data['my_wallet']<$_REQUEST['data_rec_amount']){
			$data['pay_status']='1';
			$data['payble_amount']=$data['mobile_amount']-$data['my_wallet'];
		}else{
			$data['payble_amount']=$data['mobile_amount'];
		}
		$where111 = array('free_coupon_category_status' =>1);
        $data['coupon_category'] = $this->login_model->get_data_where_condition('free_coupon_category', $where111);
		$where11 = array('coupon_status' =>1);
        $data['coupon_list'] = $this->login_model->get_data_where_condition('free_coupon_list', $where11);
			
		$this->load->view('web/inner-header',$data);
        $this->load->view('web/recharge-details',$data);
        $this->load->view('web/inner-footer');
	}
	// function electricity recharge
		function electric_recharge(){
		if ($this->session->userdata('user_id') == FALSE) 
		{
            redirect('web');
        }
		$user_id= $this->session->userdata('user_id');
		$result=file_get_contents( base_url('webservices/api.php?rquest=user_profile&user_id='.$user_id));
		$wallet=json_decode($result);
		$data['my_wallet']=$wallet->wallet_amount;
		$data['my_profile']=json_decode($result);
	 $data['mobile']=$_REQUEST['electric_card_number']; 
	 $data['user_id']=$user_id;
       
	  $data['recharge_category_id']='5'; // ] Electricity
	    $electricty_operator_id=$_REQUEST['electricty_operator_id']; 
		 $where = array('operator_id' => $electricty_operator_id);
            $operator = $this->login_model->get_data_where_condition('operator_list', $where);
			$data['operator_name']=$operator[0]->operator_name;
				$data['operator_image']=$operator[0]->operator_image;
		
		  $data['mobile_operator_id']=$electricty_operator_id;
		  $data['mobile_amount']=$_REQUEST['electrice_amount']; 
		   if($data['my_wallet']<$_REQUEST['electrice_amount']){
			$data['pay_status']='1';
			$data['payble_amount']=$data['mobile_amount']-$data['my_wallet'];
		}else{
			$data['payble_amount']=$data['mobile_amount'];
		}
			$where111 = array('free_coupon_category_status' =>1);
        	$data['coupon_category'] = $this->login_model->get_data_where_condition('free_coupon_category', $where111);
			$where11 = array('coupon_status' =>1);
        	$data['coupon_list'] = $this->login_model->get_data_where_condition('free_coupon_list', $where11);
			
		$this->load->view('web/inner-header',$data);
        $this->load->view('web/recharge-details',$data);
        $this->load->view('web/inner_footer');
	}
	
	
	function my_transactions(){
		if ($this->session->userdata('user_id') == FALSE)
		{
            redirect('web');
        }
		$user_id= $this->session->userdata('user_id');
		$result=file_get_contents( base_url('webservices/api.php?rquest=user_profile&user_id='.$user_id));
		$data['my_profile']=json_decode($result);
		$wallet=json_decode($result);
		$data['my_wallet']=$wallet->wallet_amount;
		
		if(!empty($_REQUEST['wt_category'])){
			$wt_category=$_REQUEST['wt_category'];
			$result=file_get_contents(base_url("webservices/api.php?rquest=transaction_history&user_id=".$user_id."&wt_category=".$wt_category));
		}else{
			$wt_category='';
			$result=file_get_contents(base_url("webservices/api.php?rquest=transaction_history&user_id=".$user_id.""));
		}
	
		
	$res=json_decode($result);
	if(!empty($res->transaction_details))
	{
		$data['transaction']=$res->transaction_details; 
	}
	else
	{
		$data['transaction']='';
	}
		$where111 = array('free_coupon_category_status' =>1);
        $data['coupon_category'] = $this->login_model->get_data_where_condition('free_coupon_category', $where111);
		$where11 = array('coupon_status' =>1);
        $data['coupon_list'] = $this->login_model->get_data_where_condition('free_coupon_list', $where11);
		$data['wt_category']=$wt_category;
		$data['uri_segment']='my_trans';
		$this->load->view('web/inner-header',$data);
        $this->load->view('web/my-transactions',$data);
      	$this->load->view('web/inner_footer');
	}
	function repeat_recharge(){
	if ($this->session->userdata('user_id') == FALSE) {
            redirect('web');
        }
		$user_id= $this->session->userdata('user_id');
		$result=file_get_contents( base_url('webservices/api.php?rquest=user_profile&user_id='.$user_id));
		$wallet=json_decode($result);
 
		$data['my_profile']=$wallet;
		$data['my_wallet']=$wallet->wallet_amount;
		 $data['user_id']=$user_id;
		$wt_id=$_REQUEST['wt_id'];
		$rec_id=$_REQUEST['rec_id'];
		$wt_category_id=$_REQUEST['wt_category_id'];
		
		$url=base_url('webservices/api.php?rquest=repeat_recharge&wt_id='.$wt_id.'&wt_category_id='.$wt_category_id.'&rec_id='.$rec_id);
		$result11=file_get_contents($url);
	
		$res=json_decode($result11);
		
		$data['recharge_category_id']=$rec_id;
		 $data['operator_name']=$res->operataor_name;
		 $data['operator_image']=$res->operator_image;
		  $data['recharge_amount']=$res->recharge_amount;
		$data['mobile']=substr($res->recharge_number,4);
		 $data['user_id']=$user_id;
       $data['prepaid']=1; 
	 $data['mobile_operator_id']=$res->operator_id;
		$data['mobile_amount']=$res->wallet_amount;
		if($data['my_wallet']<$data['recharge_amount']){
			$data['pay_status']='1';
			$data['payble_amount']=$data['mobile_amount']-$data['my_wallet'];
		}else{
			$data['payble_amount']=$data['mobile_amount'];
		} 
		$where111 = array('free_coupon_category_status' =>1);
        	$data['coupon_category'] = $this->login_model->get_data_where_condition('free_coupon_category', $where111);
			$where11 = array('coupon_status' =>1);
        	$data['coupon_list'] = $this->login_model->get_data_where_condition('free_coupon_list', $where11);
		$this->load->view('web/inner-header',$data);
        $this->load->view('web/recharge-details',$data);
        $this->load->view('web/inner-footer');
		
	}
function repeat_transfer_money(){
		 if ($this->session->userdata('user_id') == FALSE) {
            redirect('web');
        }
	$user_id= $this->session->userdata('user_id');
		$result=file_get_contents( base_url('webservices/api.php?rquest=user_profile&user_id='.$user_id));
		$wallet=json_decode($result);
		$data['my_profile']=$wallet;
		$data['my_wallet']=$wallet->wallet_amount;
		 $data['user_id']=$user_id;
		 $data['wt_id']=$_REQUEST['wt_id'];
		 	 $data['transfer_number']=$_REQUEST['transfer_number'];
		$data['rec_amount']=$_REQUEST['rec_amount'];
		
		$this->load->view('web/inner-header',$data);
        $this->load->view('web/transfer_money',$data);
        $this->load->view('web/inner-footer');
}
function repeat_add_sms(){
		 if ($this->session->userdata('user_id') == FALSE) {
            redirect('web');
        }
	$user_id= $this->session->userdata('user_id');
		$result=file_get_contents( base_url('webservices/api.php?rquest=user_profile&user_id='.$user_id));
		$wallet=json_decode($result);
		$data['my_profile']=$wallet;
		$data['my_wallet']=$wallet->wallet_amount;
		 $data['user_id']=$user_id;
		 $data['wt_id']=$_REQUEST['wt_id'];
		 	 $data['transfer_number']=$_REQUEST['transfer_number'];
		$data['rec_amount']=$_REQUEST['rec_amount'];
		
		$this->load->view('web/inner-header',$data);
        $this->load->view('web/sms_management',$data);
        $this->load->view('web/inner-footer');
}
	function my_wallet(){
		
			 if ($this->session->userdata('user_id') == FALSE) {
            redirect('web');
        }
		if(!empty($_REQUEST['amount'])){
			$data['amount']=$_REQUEST['amount'];
			$wt_id=$_REQUEST['wt_id'];
				$where = array('wt_id' => $wt_id);
            $trans = $this->login_model->get_data_where_condition('wallet_transaction', $where);
			$card_no=$trans[0]->wt_card_no;
			$data['card_no']=$card_no;
		} 
		
		 $user_id= $this->session->userdata('user_id');
		 $result=file_get_contents( base_url('webservices/api.php?rquest=user_profile&user_id='.$user_id));
		$wallet=json_decode($result);
		$data['my_profile']=json_decode($result);
		$data['my_wallet']=$wallet->wallet_amount;
		$data['uri_segment']='wallet_amount';
		//$result=file_get_contents( base_url('webservices/api.php?rquest=user_profile&user_id='.$user_id));
		//$data['my_wallet']=json_decode($result);
		$this->load->view('web/inner-header',$data);
        $this->load->view('web/wallet',$data);
        $this->load->view('web/inner-footer');
	}
 	function about_us(){
 		// if ($this->session->userdata('user_id') == FALSE) {
   //          redirect('web');
   //      }
 		$f_data['footer'] = $this->footer();
 		$result=file_get_contents( base_url('webservices/api.php?rquest=about_us'));
		$result=json_decode($result);
		$data['about_us']=html_entity_decode($result->about_us);
		$data['about_us_data'] = $this->login_model->get_column_data_where('about_us');
		$where = array('operator_status' => '1');
		$data['about_us_operator'] = $this->login_model->get_record_where('operator_list',$where);

		$this->load->view('web/header');
        $this->load->view('web/about',$data);
        $this->load->view('web/footer',$f_data);
 	}
		function contact_us()
		{
			
				$f_data['contact_details'] = $this->contact_details();
				$f_data['footer'] = $this->footer();
	 			$result=file_get_contents( base_url('webservices/api.php?rquest=contact_us'));
				$data['result']=json_decode($result);
				$data['contact_us_data'] = $this->login_model->get_column_data_where('contact_us');

				$this->load->view('web/header');
		        $this->load->view('web/contact_us',$data);
		        $this->load->view('web/footer',$f_data);

			
		}
		function faq()
		{
			$f_data['footer'] = $this->footer();
 			$where111 = array('faq_status' =>'1');
        	$data['faq'] = $this->login_model->get_data_where_condition('faq', $where111);
			$this->load->view('web/header');
	        $this->load->view('web/faq',$data);
	        $this->load->view('web/footer',$f_data);
		}
		function terms_conditions(){
			$f_data['footer'] = $this->footer();
 			$result=file_get_contents( base_url('webservices/api.php?rquest=terms'));
			$result=json_decode($result);
			$data['terms']=html_entity_decode($result->terms);
			  $f_data['contact_details'] = $this->contact_details();
			$this->load->view('web/header');
	        $this->load->view('web/terms',$data);
	        $this->load->view('web/footer',$f_data);
		}
		function sms_management(){
				 if ($this->session->userdata('user_id') == FALSE) {
            redirect('web');
        }
		$user_id= $this->session->userdata('user_id');
		 $result=file_get_contents( base_url('webservices/api.php?rquest=user_profile&user_id='.$user_id));
			$wallet=json_decode($result);
		$data['my_profile']=json_decode($result);
		$data['my_wallet']=$wallet->wallet_amount;
			$this->load->view('web/inner-header',$data);
	        $this->load->view('web/sms_management');
	        $this->load->view('web/inner-footer');
		}
		function transfer_money(){
				 if ($this->session->userdata('user_id') == FALSE) {
            redirect('web');
        }
		$user_id= $this->session->userdata('user_id');
		if ($this->input->post('sub_btn')) {
            $data 			= 	$this->input->post();
          	$amount			=	$data['transfer_amount'];
			$mobile_no		=	$data['transfer_mobile_no'];
		 $result=file_get_contents( base_url('webservices/api.php?rquest=transfer_money&user_id='.$user_id.'&mobile_no='.$mobile_no.'&amount='.$amount));
			$result=json_decode($result);
		
			$data1['status']=$result->status;
			$data1['message']=$result->message;
			$data1['trans_date']=$result->transaction_date;
			
				$data1['transaction_via']='Oyacash';
			
			if(!empty($result->transaction_id))
			{
				$data1['transaction_ref']=$result->transaction_id;
			}
			$data1['recharge_type']='Transfer Money';
			
			$data1['wt_category']=5;
			$data1['amount']=$amount;
			$data1['recharge_no']=$mobile_no;
			if($result->status=='true')
				{
					$this->toastr->success($result->message,'Success');
				}else{
					$this->toastr->error($result->message,'Error');
				}
			$this->session->set_userdata('array',$data1);
			redirect('Payment-Response');
        }
		

		}
		function change_transfer_pin_status(){
			$user_id=$_REQUEST['user_id'];
			$this->session->set_userdata(array('user_pin_status'=>'1')); 
			 $this->session->userdata('user_pin_status');
			
		}
		function change_password1(){
				 if ($this->session->userdata('user_id') == FALSE) {
            redirect('web');
        }
			 $user_id= $this->session->userdata('user_id');
			 $result=file_get_contents( base_url('webservices/api.php?rquest=user_profile&user_id='.$user_id));
		$wallet=json_decode($result);
		$data['my_profile']=json_decode($result);
		$data['my_wallet']=$wallet->wallet_amount;
			$this->load->view('web/inner-header',$data);
	        $this->load->view('web/change_password');
	        $this->load->view('web/inner-footer');
		}
		
		function share_earn(){
			$user_id= $this->session->userdata('user_id');
			$result=file_get_contents( base_url('webservices/api.php?rquest=user_profile&user_id='.$user_id));
			$wallet=json_decode($result);
			$data['my_profile']=json_decode($result);
			$data['my_wallet']=$wallet->wallet_amount;
			$reffer_code=$wallet->reffer_code;
			$this->session->set_userdata(array('reffer_code'=>$reffer_code)); 
			$reffer_result=file_get_contents( base_url('webservices/api.php?rquest=reffer_amount&user_id='.$user_id));
			$reffer=json_decode($reffer_result);
			$data['reffer_amount']=$reffer->user_total_reffer_amount;
			$this->load->view('web/inner-header',$data);
	        $this->load->view('web/share_earn',$data);
	        $this->load->view('web/inner-footer');
		}
	function user_login()
	{
			header('Access-Control-Allow-Origin: *'); 
			 $user_id=$_REQUEST['user_id']; 
			$where = array('user_id' => $user_id);
            $user_record = $this->login_model->get_data_where_condition('user', $where);
			$user_pin_status=$user_record[0]->user_pin_status;
			$user_reffer_code=$user_record[0]->user_refferal_code;
			if(!empty($user_id))
			{
				$login_type=$user_record[0]->user_login_type;
				$user_wallet=$user_record[0]->wallet_amount;
				$this->session->set_userdata(array('user_id'=>$user_id,'user_wallet'=>$user_wallet,'login_type'=>$login_type,'reffer_code'=>$user_reffer_code,'user_pin_status'=>$user_pin_status)); 

				echo "1";
					
			}else
			{
				echo "2";
			}
	}
// functoon cancel requet
function cancel()
{
	redirect(base_url());
}
	function fb_login()
	{
		$user_id=$_POST['userid'];
		if(!empty($user_id))
		{
		 	$name				=	$_REQUEST['user_name'];
			$login_type			=	$_REQUEST['login_type'];
		 	$email				=	$_REQUEST['user_email'];
			$verify_status		=	$_REQUEST['verify_status'];
			$user_wallet		=	$_REQUEST['user_wallet']; 
			$frnd_reffer_code	=	$_REQUEST['frnd_reffer_code']; 
			$user_pin_status	=	$_REQUEST['user_pin_status']; 
			$wt_category		=	$_REQUEST['wt_category']; 
			$this->session->set_userdata(array('user_id'=>$user_id,'user_email'=>$email,'user_wallet'=>$user_wallet,'user_name'=>$name,'login_type'=>$login_type,'verify_status'=>$verify_status,'reffer_code'=>$frnd_reffer_code,'user_pin_status'=>$user_pin_status,'wt_category'=>$wt_category)); 
			echo "1";
					
		}
		else
	    {
			echo "2";
		}
	}
	function google_login($Google) {
	
		if (isset($Google)) {

			$config = 'hybridauth_lib/hybridauth/config.php';
			require_once ("hybridauth_lib/hybridauth/Hybrid/Auth.php");

			if ($Google == 'Google') {
			
				// change the following paths if necessary
				try {
					
			// create an instance for Hybridauth with the configuration file path as parameter
					$hybridauth = new Hybrid_Auth($config);
					$google = $hybridauth -> authenticate("Google");
					$google_user_profile = $google -> getUserProfile();
					$access_token = $google -> getAccessToken();
					$google_data[] = $google_user_profile;
					foreach ($google_data as $val) {
						$fb_id = $val -> identifier;
						$doc_name = $val -> displayName;
						$web_username = $val -> firstName;
						$web_lastname = $val -> lastName; 
						$email = $val -> email;
				
						$contact = $val -> phone;
						$address = $val -> address;
						$dob = $val -> birthYear . '-' . $val -> birthMonth . '-' . $val -> birthDay;
						$image = $val -> photoURL;
					}
					
					$google -> logout();
					$length = 10;

					//$password = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
//					$data_fb = $this -> doctorlogin_model -> check_fb_login_user($email);
					$table_name = 'user';
					$check_unique = array('user_email' => $email);
					$check_email = $this -> login_model -> get_data_where_condition($table_name, $check_unique);
				
	$name=$web_username.' '.$web_lastname;
					if (empty($check_email)) {
					
						$data = array('user_name' => $name ,'user_email' => $email, 'user_social_id' => $fb_id,'user_login_type' => '3','wallet_amount'=>0);
						$result = $this -> login_model -> insert_data($table_name, $data);
						
						//$this->session->set_userdata(array('user_id'=>$result,'user_email'=>$email,'user_wallet'=>0,'user_name'=>$name,'login_type'=>3,'verify_status'=>'2')); 
						$verify_status='2'; 
						if($verify_status=='2'){
							redirect('web/index/'.$verify_status.'/'.$result.'/'.'1');
						}else{
							redirect(base_url('web'));
						}
						
					} else {
							
						$user_status=$check_email[0]->user_status;
						if($user_status=='1'){
						$data = array('user_name' => $name,'user_email' => $email, 'user_social_id' => $fb_id,'user_login_type' => '2','user_pin_status'=>'2');
						$check_duplicate_id = array('user_email' => $email);
						$edit = $this -> login_model -> update_data($table_name, $data, $check_duplicate_id);
						$get_id = $this -> login_model -> get_record_where($table_name, $check_duplicate_id);
					$user_id=$get_id[0]->user_id;
					$user_email=$get_id[0]->user_email;
					$user_wallet=$get_id[0]->wallet_amount;
					 $verify_status=$get_id[0]->user_mobile_verify_status; 
					 $user_pin_status=$get_id[0]->user_pin_status;
				//	$this->session->set_userdata(array('user_id'=>$user_id,'user_email'=>$user_email,'user_wallet'=>0,'user_name'=>$name,'login_type'=>3,'verify_status'=>'2')); 
		//echo "<pre>"; echo "string111";	print_r($check_email);die;
						if($verify_status=='2'){
						
							redirect('web/index/'.$verify_status.'/'.$user_id.'/'.'1');
						}else{
							$this->session->set_userdata(array('user_id'=>$user_id,'user_email'=>$user_email,'user_wallet'=>0,'user_name'=>$name,'login_type'=>3,'verify_status'=>'1','recharge_status'=>1,'user_pin_status'=>$user_pin_status)); 
							redirect(base_url('web'));
						}
					 }else{
					 //	$message="Account Inactive by admin, please contact to OyaCahrge"
					 	redirect('web/index/'.'11'.'/'.$user_id.'/'.'2');
					 }
					}

					$today = date("Y-m-d H:i:s");

				} catch( Exception $e ) {

					switch( $e->getCode() ) {
						case 0 :
							echo "Unspecified error.";
							break;
						case 1 :
							echo "Hybriauth configuration error.";
							break;
						case 2 :
							echo "Provider not properly configured.";
							break;
						case 3 :
							echo "Unknown or disabled provider.";
							break;
						case 4 :
							echo "Missing provider application credentials.";
							break;
						case 5 :
							echo "Authentification failed. " . "The user has canceled the authentication or the provider refused the connection.";
							break;
						case 6 :
							echo "User profile request failed. Most likely the user is not connected " . "to the provider and he should authenticate again.";
							$google-> logout();
							break;
						case 7 :
							echo "User not connected to the provider.";
							$google-> logout();
							break;
						case 8 :
							echo "Provider does not support this feature.";
							break;
					}
					// well, basically your should not display this to the end user, just give him a hint and move on..
					echo "<br /><br /><b>Original error message:</b> " . $e -> getMessage();
				}

			}

		}

	}
function g_login(){
$user_email=$_REQUEST['user_email'];
	$user_name=$_REQUEST['user_name'];
	$user_id=$_REQUEST['user_id']; 
	//$this->session->set_userdata(array('user_id'=>$user_id,'user_email'=>$user_email,'user_wallet'=>0,'user_name'=>$user_name,'login_type'=>3)); 
	$this->session->set_userdata(array('user_id'=>$user_id,'user_email'=>$user_email,'user_wallet'=>0,'user_name'=>$user_name,'login_type'=>3,'recharge_status'=>1));
	echo "1";
}
function home(){
	$array_items = array('recharge_status' => '');
	$this->session->unset_userdata($array_items);
	redirect('web');
}
	function view_offer(){
		$data=$this->input->post();
		
	}
    function logout() {
    
        $this->session->sess_destroy();
        redirect(base_url());
    }
	
	// function get coupon
function get_offer_details(){
	$coupon_id=$_REQUEST['coupon_id'];
	$where = array('fee_coupon_category_id' => $coupon_id);
    $data['coupon_list'] = $this->login_model->get_data_where_condition('free_coupon_list', $where);
	 $this->load->view('web/free_coupon_ajax',$data);
}

// function get all coupons
 function get_all_coupon(){
	$coupon_id=$_REQUEST['coupon_id'];
	$where = array('coupon_status' => 1);
    $data['coupon_list'] = $this->login_model->get_data_where_condition('free_coupon_list', $where);
	 $this->load->view('web/free_coupon_ajax',$data);
}
 
 function get_cart_coupon(){
 	$user_id=$_REQUEST['user_id'];
	$where1 = array('cart_user_id'=>$user_id);
    $coupon_record_all = $this->login_model->get_data_where_condition('add_cart_offer', $where1);
	$arr=array();
		foreach ($coupon_record_all as  $value) {
		$coupon_id=$value->cart_offer_id;
		$where12 = array('free_coupon_id' => $coupon_id,'coupon_status'=>1);
	 	$transaction = $this->login_model->get_record_join_two_table('free_coupon_list', 'free_coupon_category', 'fee_coupon_category_id', 'free_coupon_category_id','*',$where12); 
		$free_coupon_id=$transaction[0]->free_coupon_id;
		  $coupon_name=$transaction[0]->coupon_name;
		 $coupon_discount=$transaction[0]->coupon_discount;
		  $coupon_code=$transaction[0]->coupon_code;
		  $coupon_expiry_date=$transaction[0]->coupon_expiry_date;
		   $coupon_img=free_coupon_image."/".$transaction[0]->coupon_img;
		  $arr[]=array('coupon_id'=>$free_coupon_id,'coupon_name'=>$coupon_name,'coupon_discount'=>$coupon_discount,'coupon_code'=>$coupon_code,'coupon_expiry'=>$coupon_expiry_date,'coupon_img'=>$coupon_img);
	}
		 echo json_encode(array('arr'=>$arr));
 }
 // get coupon id in add cart//
 function add_cart_coupon(){
 	$coupon_id=$_REQUEST['coupon_id'];
	$user_id=$_REQUEST['user_id'];
	$where = array('cart_user_id'=>$user_id);
    $coupon_record = $this->login_model->get_data_where_condition('add_cart_offer', $where);
	if(empty($coupon_record)){
		$data = array('cart_user_id' => $user_id ,'cart_offer_id' => $coupon_id);
		$result = $this -> login_model -> insert_data('add_cart_offer', $data);
		$where1 = array('cart_user_id'=>$user_id);
		}else{
		$data = array('cart_offer_id' => $coupon_id);
		$result = $this -> login_model -> update_data('add_cart_offer', $data,$where);
	}
    $coupon_record_all = $this->login_model->get_data_where_condition('add_cart_offer', $where);
	$arr=array();
		foreach ($coupon_record_all as  $value) {
		$coupon_id=$value->cart_offer_id;
		$where12 = array('free_coupon_id' => $coupon_id,'coupon_status'=>1);
	 $transaction = $this->login_model->get_record_join_two_table('free_coupon_list', 'free_coupon_category', 'fee_coupon_category_id', 'free_coupon_category_id','*',$where12); 
	// print_r($transaction);
	
		 $free_coupon_id=$transaction[0]->free_coupon_id;
		  $coupon_name=$transaction[0]->coupon_name;
		 $coupon_discount=$transaction[0]->coupon_amount;
		  $coupon_code=$transaction[0]->coupon_code;
		  $coupon_expiry_date=$transaction[0]->coupon_expiry_date;
		    $coupon_img=free_coupon_image."/".$transaction[0]->coupon_img;
		  $arr[]=array('coupon_id'=>$free_coupon_id,'coupon_name'=>$coupon_name,'coupon_discount'=>$coupon_discount,'coupon_code'=>$coupon_code,'coupon_expiry'=>$coupon_expiry_date,'coupon_img'=>$coupon_img);
	}
		 echo json_encode(array('arr'=>$arr));
	
 }
 function offer_in_cart(){
 	$user_id=$_REQUEST['user_id'];
	$where = array('cart_user_id'=>$user_id);
    $coupon_record = $this->login_model->get_data_where_condition('add_cart_offer', $where);
if(!empty($coupon_record)){
	$arr=array();
		foreach ($coupon_record as  $value) {
		$coupon_id=$value->cart_offer_id;
		$where12 = array('free_coupon_id' => $coupon_id,'coupon_status'=>1);
	 $transaction = $this->login_model->get_record_join_two_table('free_coupon_list', 'free_coupon_category', 'fee_coupon_category_id', 'free_coupon_category_id','*',$where12); 
	// print_r($transaction);
	
		 $free_coupon_id=$transaction[0]->free_coupon_id;
		  $coupon_name=$transaction[0]->coupon_name;
		 $coupon_discount=$transaction[0]->coupon_discount;
		  $coupon_code=$transaction[0]->coupon_code;
		  $coupon_expiry_date=$transaction[0]->coupon_expiry_date;
		  $coupon_img=free_coupon_image."/".$transaction[0]->coupon_img;
		  $arr[]=array('coupon_id'=>$free_coupon_id,'coupon_name'=>$coupon_name,'coupon_discount'=>$coupon_discount,'coupon_code'=>$coupon_code,'coupon_expiry'=>$coupon_expiry_date,'coupon_img'=>$coupon_img);
	}
	 echo json_encode(array('arr'=>$arr));
	}
 }
function delete_cart_coupon(){
	$user_id=$_REQUEST['user_id'];
	$coupon_id=$_REQUEST['coupon_id'];
	$where = array('cart_offer_id' =>$coupon_id,'cart_user_id'=>$user_id);
    $coupon_record_delete = $this->login_model->delete_record('add_cart_offer', $where);
	$where112 = array('cart_user_id' => $user_id);
	$coupon_record = $this->login_model->get_data_where_condition('add_cart_offer', $where112);
	$arr=array();
		if(!empty($coupon_record)){

		foreach ($coupon_record as  $value) {
		$coupon_id=$value->cart_offer_id;
		$where12 = array('free_coupon_id' => $coupon_id,'coupon_status'=>1);
	 $transaction = $this->login_model->get_record_join_two_table('free_coupon_list', 'free_coupon_category', 'fee_coupon_category_id', 'free_coupon_category_id','*',$where12); 
	
	
		 $free_coupon_id=$transaction[0]->free_coupon_id;
		  $coupon_name=$transaction[0]->coupon_name;
		 $coupon_discount=$transaction[0]->coupon_discount;
		  $coupon_code=$transaction[0]->coupon_code;
		  $coupon_expiry_date=$transaction[0]->coupon_expiry_date;
		  $coupon_img=free_coupon_image."/".$transaction[0]->coupon_img;
		  $arr[]=array('coupon_id'=>$free_coupon_id,'coupon_name'=>$coupon_name,'coupon_discount'=>$coupon_discount,'coupon_code'=>$coupon_code,'coupon_expiry'=>$coupon_expiry_date,'coupon_img'=>$coupon_img);
	}
	 echo json_encode(array('arr'=>$arr));
	 }else{
	 	echo json_encode(array('arr'=>''));
	 }
	
}
function callback(){   // recharge call back function
			 if ($this->session->userdata('user_id') == FALSE) {
            redirect('web');
        }
		$user_id= $this->session->userdata('user_id'); 
		if(!empty($user_id)){
			$user_id=$user_id;
		}else{
			$user_id=$_REQUEST['user_id'];
			$this->session->set_userdata(array('user_id'=>$user_id)); 
		}
		
		//$user_id= $this->session->userdata('user_id');
		$result=file_get_contents(base_url('webservices/api.php?rquest=user_profile&user_id='.$user_id));
			$wallet=json_decode($result);
		$data['my_profile']=json_decode($result);
		$data['my_wallet']=$wallet->wallet_amount;
			$this->load->view('web/inner-header',$data);
	        $this->load->view('web/callback');
	        $this->load->view('web/inner-footer');
}
function wallet_callback(){   // wallet call back function
			 if ($this->session->userdata('user_id') == FALSE) {
            redirect('web');
        }
		$user_id= $this->session->userdata('user_id'); 
		if(!empty($user_id)){
			$user_id=$user_id;
		}else{
			$user_id=$_REQUEST['user_id'];
			$this->session->set_userdata(array('user_id'=>$user_id)); 
		}
		
		//$user_id= $this->session->userdata('user_id');
		$result=file_get_contents(base_url('webservices/api.php?rquest=user_profile&user_id='.$user_id));
			$wallet=json_decode($result);
		$data['my_profile']=json_decode($result);
		$data['my_wallet']=$wallet->wallet_amount;
			$this->load->view('web/inner-header',$data);
	        $this->load->view('web/wallet_callback');
	        $this->load->view('web/inner-footer');
}
function promocode_session(){
	$coupon_id=$_REQUEST['coupon_id'];
	$coupon_amount=$_REQUEST['coupon_amount'];
	$this->session->set_userdata(array('coupon_id'=>$coupon_id,'coupon_amount'=>$coupon_amount)); 
}
function remove_session_coupon(){
		$coupon_id=$_REQUEST['coupon_id'];
	$coupon_amount=$_REQUEST['coupon_amount'];
	$this->session->unset_userdata('coupon_id');
	$this->session->unset_userdata('amt');
	$this->session->unset_userdata('coupon_amount');
}
function check_user_wallet_balence(){
	$rec_amt=$_REQUEST['recharge_amt'];
	$user_id=$_REQUEST['user_id'];
		$where = array('user_id' =>$user_id);
    $user_record = $this->login_model->get_data_where_condition('user', $where);
	$wallet_balence=$user_record[0]->wallet_amount;
	if($wallet_balence>$rec_amt){
		echo "1"; // sufficent amount
	}else{
		echo "2"; //insufficient amount
	}
}
function payment(){
	if ($this->session->userdata('user_id') == FALSE) {
            redirect('web');
        }
		$user_id= $this->session->userdata('user_id'); 
		if(!empty($user_id)){
			$user_id=$user_id;
		}else{
			$user_id=$_REQUEST['user_id'];
			$this->session->set_userdata(array('user_id'=>$user_id)); 
		}
		
		//$user_id= $this->session->userdata('user_id');
		$result=file_get_contents(base_url('webservices/api.php?rquest=user_profile&user_id='.$user_id));
			$wallet=json_decode($result);
		$data['my_profile']=json_decode($result);
		$data['my_wallet']=$wallet->wallet_amount;
			$this->load->view('web/inner-header',$data);
	        $this->load->view('web/payment');
	        $this->load->view('web/inner-footer');
}
	function set_wallet_add_value(){
	 	$amt=$_REQUEST['amount']*100;
		$this->session->set_userdata(array('amt'=>$amt)); 

	$url=base_url("web/wallet_callback");
	$txn_ref = 'Oyacharge'.time();
	$product_id = webpay_product_id;
	$pay_item_id = '101';
	$site_redirect_url = $url;
	$mackey = webpay_hashkey;
	
	$data = $txn_ref.$product_id.$pay_item_id.$amt.$site_redirect_url.$mackey;
	$hashed = hash('sha512', $data);
echo	 $hashed.",".$txn_ref;
	
}
	function payment_response()
	{
		if ($this->session->userdata('user_id') == FALSE) {
            redirect('web');
        }
		$user_id= $this->session->userdata('user_id'); 
		if(!empty($user_id)){
			$user_id=$user_id;
		}else{
			$user_id=$_REQUEST['user_id'];
			$this->session->set_userdata(array('user_id'=>$user_id)); 
		}
		
		//$user_id= $this->session->userdata('user_id');
		$result=file_get_contents(base_url('webservices/api.php?rquest=user_profile&user_id='.$user_id));
			$wallet=json_decode($result);
		$data['my_profile']=json_decode($result);
		$data['my_wallet']=$wallet->wallet_amount;
		$data['my_amt']=$this->session->userdata('amt'); 
			$this->load->view('web/inner-header');
	        $this->load->view('web/wallet',$data);
	        $this->load->view('web/inner-footer');
	}

function set_recharge_add_value(){
	 	$amt=$_REQUEST['amount']*100;
		$user_id=$_REQUEST['user_id'];
		
		$wallet_amt=$_REQUEST['wallet_amt'];
		$pay_Amnt_status=$_REQUEST['pay_Amnt_status'];
		$mobile_no=$_REQUEST['mobile_no'];
		$rechareg_category_id=$_REQUEST['rechareg_category_id'];
		$operator_id=$_REQUEST['operator_id'];
		$wt_category=$_REQUEST['wt_category'];
		$this->session->set_userdata(array('amt'=>$amt,'user_id'=>$user_id,'recharge_amount'=>$amt,'wallet_amount'=>$wallet_amt,'pay_amount_status'=>$pay_Amnt_status,'mobile_no'=>$mobile_no,'recharge_category_id'=>$rechareg_category_id,'operator_id'=>$operator_id,'wt_category'=>$wt_category));
	$url=base_url("web/callback");
	$txn_ref = 'Oyacharge'.time();
	$product_id = webpay_product_id;
	$pay_item_id = '101';
	$site_redirect_url = $url;
	$mackey = webpay_hashkey;
	
	$data = $txn_ref.$product_id.$pay_item_id.$amt.$site_redirect_url.$mackey;
	$hashed = hash('sha512', $data);
echo	 $hashed.",".$txn_ref;
	
}
function webview_payment_gateway()
{
	$user_id=$_REQUEST['user_id'];
	$amount=$_REQUEST['amount'];
	if(!empty($user_id) && !empty($amount))
	{
		$data['user_id']=$user_id;
		$data['amount']=$amount;
		$this->load->view('web/sample_pay',$data);
	}
	 
}
function craete_hash()
{
	$amt=$_REQUEST['amount']*100;
	$user_id=$_REQUEST['user_id'];
	$result=file_get_contents(base_url('webservices/api.php?rquest=user_profile&user_id='.$user_id));
			
		$user=json_decode($result);
		$user_name=$user->user_name;
	$this->session->set_userdata(array('user_id'=>$user_id,'app_user_amount'=>$amt)); 
	$url=base_url("web/webview_response");
	$txn_ref = 'Oyacharge'.time();
	$product_id = webpay_product_id;
	$pay_item_id = '101';
	$site_redirect_url = $url;
	$mackey = webpay_hashkey;
	
	$data = $txn_ref.$product_id.$pay_item_id.$amt.$site_redirect_url.$mackey;
	$hashed = hash('sha512', $data);
echo	 $hashed.",".$txn_ref.",".$user_name;
}
function webview_response()
{
	$this->load->view('web/sample_pay_resp');
}
function pay_success()
{
	
        $transaction_id = $this->uri->segment(4);
		$this->load->view('web/pay_success_response');
}
function pay_failure()
{
	 $transaction_id = $this->uri->segment(4);
	$this->load->view('web/pay_failure_response');
}
function select_church_services()
{
	$c_product_id=$_REQUEST['church_p_id'];
	$where=array('church_product_id'=>$c_product_id);
	 $church_record = $this->login_model->get_data_where_condition('church_product', $where);
	$church_product_price=$church_record[0]->church_product_price;
	if(!empty($church_product_price))
	{
		echo $church_product_price;
	}else{
		echo "2";  // empty price
	}
}
function church_recharge(){
	if ($this->session->userdata('user_id') == FALSE) {
            redirect('web');
        }
		$user_id= $this->session->userdata('user_id'); 
		$result=file_get_contents( base_url('webservices/api.php?rquest=user_profile&user_id='.$user_id));
		$wallet=json_decode($result);
		$data['my_profile']=json_decode($result);
		$data['my_wallet']=$wallet->wallet_amount;
	 //	$data['mobile']=$_REQUEST['mobile']; 
	 	$data['user_id']=$user_id;
       //$data['church_price']=$_REQUEST['church_price']; 
	   	$data['recharge_category_id']=6; //  church
		$data['church_category_id']=$_REQUEST['church_category_id'];
		$data['church_area']=$_REQUEST['church_area'];
		$data['church_p_id']=$_REQUEST['church_p_id'];
	    $church_id=$_REQUEST['church_id']; 
		$where1 = array('church_area_id' => $_REQUEST['church_area']);
		$where = array('church_id' => $church_id);
		$church_area = $this->login_model->get_data_where_condition('church_area', $where1);
        $church_list = $this->login_model->get_data_where_condition('church_list', $where);
		$data['operator_name']=$church_list[0]->church_name;  // church_name
		$data['operator_image']=church_image."/".$church_list[0]->church_img;   // church image
		$data['mobile_operator_id']=$church_id;
		$data['mobile']= $church_area[0]->church_area;
		 $data['mobile_amount']=$_REQUEST['church_price']; 
		if($data['mobile_amount']>$data['my_wallet']){
			$data['pay_status']='1';
			$data['payble_amount']=$data['mobile_amount']-$data['my_wallet'];
		}else{
			$data['pay_status']='';
			$data['payble_amount']=$data['mobile_amount'];
		}
		$where111 = array('free_coupon_category_status' =>1);
        	$data['coupon_category'] = $this->login_model->get_data_where_condition('free_coupon_category', $where111);
			$where11 = array('coupon_status' =>1);
        	$data['coupon_list'] = $this->login_model->get_data_where_condition('free_coupon_list', $where11);
			 $this->session->set_userdata(array('mobile_amount'=>$_REQUEST['church_price'],'church_id'=>$_REQUEST['church_id'],'church_category_id'=>$_REQUEST['church_category_id'],'church_area_id'=>$_REQUEST['church_area'],'church_product_id'=>$_REQUEST['church_p_id'],'wt_category'=>'13')); 
		$this->load->view('web/inner-header');
		 $this->load->view('web/recharge_details',$data);
}
function re_query_webpay()
{
	 $product_id = webpay_product_id; 

  $txn_ref = $_REQUEST['txnref'];
 $amount=$_REQUEST['amount']*100;
  $mackey = webpay_hashkey;

$data = $product_id.$txn_ref.$mackey;

  $hashed = hash('sha512', $data);

 $url = "https://stageserv.interswitchng.com/test_paydirect/api/v1/gettransaction.json?productid=$product_id&transactionreference=$txn_ref&amount=$amount";


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "hash: $hashed",
    "useragent: Mozilla/4.0 (compatible; MSIE 6.0; MS Web Services Client Protocol 4.0.30319.239)"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
	
  $arr=json_decode($response);
 $amount=($arr->Amount/100);
  $trans_id=$arr->RetrievalReferenceNumber;
$status=$arr->ResponseCode;
echo  $ResponseDescription=$arr->ResponseDescription;
  
}
}
function getBankDetails()
{
	$bank=file_get_contents( base_url('webservices/api.php?rquest=bank_details'));
	$bank_json=json_decode($bank);
	return $bank_json->banks;
}
/// Guest User functionblity
function guest_recharge_details()
	{
	
		 
		$operator_id=$_REQUEST['operator_id'];
		$wt_rec=$_REQUEST['wt_rec'];
		$res=explode(",",$wt_rec);
		$wt_category=$res[0];
		$rec_category=$res[1];
		$user_id=$_REQUEST['g_id'];
		 $this->session->set_userdata(array('recharge_no'=>$_REQUEST['mo'],'operator_id'=>$operator_id,'amount'=>$_REQUEST['amount'],'guest_user_id'=>$_REQUEST['g_id'],'wt_category'=>$wt_category,'rec_category'=>$rec_category)); 
		 $data['bank_list']=$this->getBankDetails();
		 $this->load->view('web/quick-payment-details',$data);
         $this->load->view('web/inner_footer');
	}
// guest church donation 
	function guest_donation()
	{
		 $this->session->set_userdata(array('amount'=>$_REQUEST['c_p'],'church_id'=>$_REQUEST['c_id'],'church_category_id'=>$_REQUEST['c_c_id'],'church_area_id'=>$_REQUEST['c_area'],'church_product_id'=>$_REQUEST['c_p_id'],'wt_category'=>'13','guest_user_id'=>$_REQUEST['g_id'])); 
		  $data['bank_list']=$this->getBankDetails();
		  	$this->load->view('web/quick-payment-details',$data);
        		$this->load->view('web/inner_footer');
	}
	function guest_payBill()
	{
			$where=array('bill_invoice_no'=>$_REQUEST['i_n']);
			$data['bill_details'] = $this->login_model->get_record_join_two_table('biller_user','biller_details','biller_id','biller_id','',$where);
		$this->session->set_userdata(array('biller_category_id'=>$_REQUEST['bil_cat_id'],'consumer_number'=>$_REQUEST['i_n'],'biller_service_id'=> $_REQUEST['bil_serv_id'],'biller_id'=>$data['bill_details'][0]->biller_id,'wt_category'=>'11','amount'=>$data['bill_details'][0]->bill_amount,'guest_user_id'=>$_REQUEST['g_id'])); 
			 $data['bank_list']=$this->getBankDetails();
			$this->load->view('web/quick-payment-details',$data);
        	$this->load->view('web/inner_footer');
	}

	function Guest_user_Payment_Card()
{
	
	$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
 
	$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; 

	// if ($this->session->userdata('guest_user_id') == FALSE)
	//  {
 //            redirect('web');
 //     }


    $data				=	$this->input->post();

	if(isset($_GET) && !empty($_GET)){


		// $data = $_GET;
		$data['card_no'] 		= "";
		$data['expiry_month'] 	= "";
		$data['expiry_year'] 	= "";
		$data['cvv_no'] 		= "";
		$data['coupon_amount'] 	= isset($_SESSION['coupon_amount']) && $_SESSION['coupon_amount'] != '' ? $_SESSION['coupon_amount'] : '';

		$data['coupon_id'] 		= isset($_SESSION['coupon_id']) && $_SESSION['coupon_id'] != '' ? $_SESSION['coupon_id'] : '';

		$data['verve_card_status'] 		= isset($_SESSION['verve_card_status']) && $_SESSION['verve_card_status'] != '' ? $_SESSION['verve_card_status'] : '';
		$data['verve_card_pin'] 		= "";
		$data['step'] 					= 2;

		if($data['verve_card_status'] == 1){
			$parts = parse_url($url);
			parse_str($parts['query'], $query);
			$data['url']  =	$query['url'];
		}else{
			$data['url']  =	isset($url) && $url != '' ? $url: '';
		}



		$data['para'] 					= json_encode( array('status' => $_SESSION['status'],'trans_id' => $_SESSION['payment_transaction_id'],'ref_id' => $_SESSION['trans_ref_no'],'last_id' => $_SESSION['data_store_id']) );

	}


	if(!empty($data))
	{
		
	//$user_id            = 	$this->session->userdata('user_id'); 
	$user_id 			= 	$this->session->userdata('guest_user_id'); 
 	$card_no			= 	str_replace('-', '',$data['card_no']);
	$expiry_month		=	$data['expiry_month'];
	$expiry_year		=   $data['expiry_year'];
	$cvv_no				=	$data['cvv_no'];
	$save_card_status	=	'2';
	//$coupon_amount		=	$_SESSION['coupon_amount']  =	$data['coupon_amount'];
	//$coupon_id			=	$_SESSION['coupon_id']      =	$data['coupon_id'];
	$url				=	isset($data['url']) && $data['url'] != '' ? $data['url'] : '';
	$para				=	isset($data['para']) && $data['para'] != '' ? $data['para'] : '';

	//$verve_card_status	=  $_SESSION['verve_card_status'] = isset($data['verve_card_status']) && $data['verve_card_status'] != '' ? $data['verve_card_status'] : 2;
	//$verve_card_pin		= isset($data['verve_card_pin']) && $data['verve_card_pin'] != '' ? $data['verve_card_pin'] : '';
	$step				=	isset($data['step']) && $data['step'] != '' ? $data['step'] : 1;
//$step				=	isset($data['step']) && $data['step'] != '' ? $data['step'] : 1;

	if(!empty($data['save_card_status']))
	{
		$save_card_status='1';
	}else{
		$save_card_status='2';
	}
	$amount				=	$this->session->userdata('amount'); 
	$recharge_no		=	$this->session->userdata('recharge_no'); 
	$operator_id		=	$this->session->userdata('operator_id'); 
 	$wt_category		=	$this->session->userdata('wt_category'); 
	$rec_category		=	$this->session->userdata('rec_category'); 

    $string 			= $_SERVER['REMOTE_ADDR'].$card_no;
     $auth 				= md5($string);

	if($wt_category=='2' || $wt_category=='12'){

	//	echo 'verve_card_status = : '.   $url; exit;
		
$request=file_get_contents( base_url('webservices/api.php?rquest=guest_recharge_from_card&recharge_user_id='.$user_id.'&payment_type=1&savecard_status='.$save_card_status.'&card_pay_type=1&recharge_category_id='.$rec_category.'&operator_id='.$operator_id.'&recharge_number='.$recharge_no.'&payment_gateway_amt='.$amount.'&recharge_amount='.$amount.'&card_no='.$card_no.'&expiry_month='.$expiry_month.'&expiry_year='.$expiry_year.'&cvv_no='.$cvv_no.'&wt_category='.$wt_category.'&step='.$step.'&verve_card_status='.$verve_card_status.'&verve_card_pin='.$verve_card_pin.'&apiFrom=1'.'&url='.urlencode($url).'&para='.$para));
	}else if($wt_category=='11')
	{
		$consumer_number		=	$this->session->userdata('consumer_number'); 
		$biller_category_id		=	$this->session->userdata('biller_category_id');
		$biller_service_id		=	$this->session->userdata('biller_service_id'); 
		$biller_id				=	$this->session->userdata('biller_id'); 
		$recharge_no=$consumer_number;
		$request=file_get_contents( base_url('webservices/api.php?rquest=bill_pay_from_card&recharge_user_id='.$user_id.'&payment_type=1&savecard_status='.$save_card_status.'&card_pay_type=1&payment_gateway_amt='.$amount.'&recharge_amount='.$amount.'&card_no='.$card_no.'&expiry_month='.$expiry_month.'&expiry_year='.$expiry_year.'&cvv_no='.$cvv_no.'&wt_category='.$wt_category.'&bill_category_id='.$biller_category_id.'&bill_consumer_no='.$consumer_number.'&bill_amount='.$amount.'&biller_id='.$biller_id.'&step='.$step.'&verve_card_status='.$verve_card_status.'&verve_card_pin='.$verve_card_pin.'&apiFrom=1'.'&url='.urlencode($url).'&para='.$para));
		
		
	}else if($wt_category=='13')
	{
		$church_id				=	$this->session->userdata('church_id'); 
		$church_category_id		=	$this->session->userdata('church_category_id');
		$church_area_id			=	$this->session->userdata('church_area_id'); 
		$church_product_id		=	$this->session->userdata('church_product_id'); 
		$request=file_get_contents( base_url('webservices/api.php?rquest=donate_church_with_card&donar_user_id='.$user_id.'&payment_type=1&savecard_status='.$save_card_status.'&card_pay_type=1&wt_category='.$wt_category.'&church_id='.$church_id.'&church_area_id='.$church_area_id.'&church_category_id='.$church_category_id.'&church_product_id='.$church_product_id.'&church_product_price='.$amount.'&card_no='.$card_no.'&expiry_month='.$expiry_month.'&expiry_year='.$expiry_year.'&cvv_no='.$cvv_no.'&step='.$step.'&verve_card_status='.$verve_card_status.'&verve_card_pin='.$verve_card_pin.'&apiFrom=1'.'&url='.urlencode($url).'&para='.$para));

	}else if($wt_category=='16')
	{
		$event_id				=	$this->session->userdata('event_id'); 
		$mobile_amount			=	$this->session->userdata('mobile_amount');
		$ticket_json_array		=	$this->session->userdata('ticket_json_array'); 
		
			$request=file_get_contents( base_url('webservices/api.php?rquest=ticket_booking_payment_with_card&user_id='.$user_id.'&payment_type=1&savecard_status='.$save_card_status.'&card_pay_type=1&payment_gateway_price='.$amount.'&ticket_price='.$amount.'&card_no='.$card_no.'&expiry_month='.$expiry_month.'&expiry_year='.$expiry_year.'&cvv_no='.$cvv_no.'&wt_category='.$wt_category.'&event_id='.$event_id.'&tickets_records='.$ticket_json_array.'&step='.$step.'&verve_card_status='.$verve_card_status.'&verve_card_pin='.$verve_card_pin.'&apiFrom=1'.'&url='.urlencode($url).'&para='.$para));
		
	}
		  $result=json_decode($request);
		  
        
		    if($step == 1){
      //print_r($result);
         //   exit();
		    	if($result->para->status == 'error'){
		    		$this->session->set_flashdata('payment_msg', $result->para->message);
		    		redirect('web'); exit;
		    	}

		    	$_SESSION['status'] = $result->status;
		    	$_SESSION['payment_transaction_id'] = $result->para->trans_id;
		    	$_SESSION['trans_ref_no'] = $result->para->ref_id;
		    	$_SESSION['data_store_id'] = $result->para->last_id;

		    	if($result->para->chargeMethod == 'VBVSECURECODE'){
		    	 	header('Location: '.  $result->para->authurl); exit;
		    	}else{
		    		// open otp screen
		    		redirect('web/openModal?id='.base64_encode($result->para->trans_id).'&redirecturl='.base64_encode('Payment-Via-Card') ); 
		    		exit;
		    	}

		    }

		  

			$data1['status']=$result->status;
			$data1['message']=$result->message;
			$data1['trans_date']=$result->transaction_date;
			if(!empty($result->transaction_via))
			{
				$data1['transaction_via']=$result->transaction_via;
			}
			if(!empty($result->transaction_ref))
			{
				$data1['transaction_ref']=$result->transaction_ref;
			}
			if($wt_category=='1')
			{
				$data1['recharge_type']='Add Money';
			}else if($wt_category=='2')
			{
				if($rec_category=='1')
				{
					$data1['recharge_type']='Mobile';
				}elseif($rec_category=='2'){
					$data1['recharge_type']='DTH';
				}else{
					$data1['recharge_type']='Datacard';
				}

			}else if($wt_category=='13')
			{
				$data1['recharge_type']='Church Donation';
			}else if($wt_category=='11')
			{
				$data1['recharge_type']='Consumer Bill';
			}else if($wt_category=='16')
			{
				$data1['recharge_type']='Event Ticket';
			}
				$data1['wt_category']=$wt_category;
				$data1['amount']=$amount;
				$data1['recharge_no']=$recharge_no;
			if($wt_category!='13' && $wt_category!='11'&& $wt_category!='16')
			{
				$where = array('operator_id' => $operator_id);
        		$operator = $this->login_model->get_data_where_condition('operator_list', $where);
				$data1['operator_name']=$operator[0]->operator_name;
				$data1['operator_image']=operator_image."/".$operator[0]->operator_image;
			}else if($wt_category=='13'){
				$where1 = array('church_area_id' =>$church_area_id);
				$church_area = $this->login_model->get_data_where_condition('church_area', $where1);
				$where = array('church_id' => $church_id);
				$church_list = $this->login_model->get_data_where_condition('church_list', $where);
				$data1['operator_name']=$church_list[0]->church_name;  // church_name
				$data1['operator_image']=church_image."/".$church_list[0]->church_img;   // church image
				$data1['church_area']=$church_area[0]->church_area; 
			}else if($wt_category=='11'){
				$where=array('bill_invoice_no'=>$consumer_number);
				$bill_details = $this->login_model->get_record_join_two_table('biller_user','biller_details','biller_id','biller_id','',$where);
				$data1['operator_name']=$bill_details[0]->biller_company_name;
		 		$data1['operator_image']=biller_company_logo."/".$bill_details[0]->biller_company_logo;
				
			}else if($wt_category=='16'){
				
			$data['event_details'] = $this->login_model->get_simple_query("select event_name,event_image,event_date,event_place from event_list where event_id='".$event_id."'");
			$data1['operator_name']=$data['event_details'][0]->event_name;
			$img_event = explode(",",$data['event_details'][0]->event_image);
		 	$data1['operator_image']=event_image."/".$img_event[0];
			$data1['event_date']=$data['event_details'][0]->event_date;
			$data1['event_place']=$data['event_details'][0]->event_place;
		
			}
			$this->session->set_userdata('array',$data1);
			//redirect('Payment-Response');
			redirect('Quick-Response');
	}
}

function Guest_user_Payment_Card_old()
{
	
	$data				=	$this->input->post();
	if(!empty($data))
	{
		
	$user_id 			= 	$this->session->userdata('guest_user_id'); 
 	$card_no			=	str_replace('-', '',$data['card_no']);
	$expiry_month		=	$data['expiry_month'];
	$expiry_year		=	$data['expiry_year'];
	$cvv_no				=	$data['cvv_no'];
	$save_card_status	=	'2';
	
	$amount				=	$this->session->userdata('amount'); 
	$recharge_no		=	$this->session->userdata('recharge_no'); 
	$operator_id		=	$this->session->userdata('operator_id'); 
 	$wt_category		=	$this->session->userdata('wt_category'); 
	$rec_category		=	$this->session->userdata('rec_category'); 
	
	$string 			= $_SERVER['REMOTE_ADDR'].$card_no;
	

	$auth 				= md5($string);
	
	if($wt_category=='2' || $wt_category=='12')
	{
		$sql= base_url('webservices/api.php?rquest=guest_recharge_from_card&recharge_user_id='.$user_id.'&payment_type=1&savecard_status='.$save_card_status.'&card_pay_type=1&recharge_category_id='.$rec_category.'&operator_id='.$operator_id.'&recharge_number='.$recharge_no.'&payment_gateway_amt='.$amount.'&recharge_amount='.$amount.'&card_no='.$card_no.'&expiry_month='.$expiry_month.'&expiry_year='.$expiry_year.'&cvv_no='.$cvv_no.'&wt_category='.$wt_category.'&auth_key='.$auth);
			$request=file_get_contents($sql);

			print_r($sql);
			die();

	}else if($wt_category=='11')
	{
		$consumer_number		=	$this->session->userdata('consumer_number'); 
		$biller_category_id		=	$this->session->userdata('biller_category_id');
		$biller_service_id		=	$this->session->userdata('biller_service_id'); 
		$biller_id				=	$this->session->userdata('biller_id'); 
		$recharge_no=$consumer_number;
		$request 				=	file_get_contents( base_url('webservices/api.php?rquest=guest_bill_pay_from_card&recharge_user_id='.$user_id.'&payment_type=1&savecard_status='.$save_card_status.'&card_pay_type=1&payment_gateway_amt='.$amount.'&recharge_amount='.$amount.'&card_no='.$card_no.'&expiry_month='.$expiry_month.'&expiry_year='.$expiry_year.'&cvv_no='.$cvv_no.'&wt_category='.$wt_category.'&bill_category_id='.$biller_category_id.'&bill_consumer_no='.$consumer_number.'&bill_amount='.$amount.'&biller_id='.$biller_id.'&auth_key='.$auth));
		
		
	}else if($wt_category=='13')
	{
		$church_id				=	$this->session->userdata('church_id'); 
		$church_category_id		=	$this->session->userdata('church_category_id');
		$church_area_id			=	$this->session->userdata('church_area_id'); 
		$church_product_id		=	$this->session->userdata('church_product_id'); 
		$request 				=	file_get_contents( base_url('webservices/api.php?rquest=guest_donate_church_with_card&donar_user_id='.$user_id.'&payment_type=1&savecard_status='.$save_card_status.'&card_pay_type=1&wt_category='.$wt_category.'&church_id='.$church_id.'&church_area_id='.$church_area_id.'&church_category_id='.$church_category_id.'&church_product_id='.$church_product_id.'&church_product_price='.$amount.'&card_no='.$card_no.'&expiry_month='.$expiry_month.'&expiry_year='.$expiry_year.'&cvv_no='.$cvv_no.'&auth_key='.$auth));
	}else if($wt_category=='16')
	{
		$event_id				=	$this->session->userdata('event_id'); 
		$mobile_amount			=	$this->session->userdata('mobile_amount');
		$ticket_json_array		=	$this->session->userdata('ticket_json_array'); 
		$request 				=	file_get_contents( base_url('webservices/api.php?rquest=ticket_booking_payment_with_card&user_id='.$user_id.'&payment_type=1&savecard_status='.$save_card_status.'&card_pay_type=1&payment_gateway_price='.$amount.'&ticket_price='.$amount.'&card_no='.$card_no.'&expiry_month='.$expiry_month.'&expiry_year='.$expiry_year.'&cvv_no='.$cvv_no.'&wt_category='.$wt_category.'&event_id='.$event_id.'&tickets_records='.$ticket_json_array.'&auth_key='.$auth));
		
	}

		$result=json_decode($request);

			$data1['status']=$result->status;
			$data1['message']=$result->message;
			$data1['trans_date']=$result->transaction_date;
			if(!empty($result->transaction_via))
			{
				$data1['transaction_via']=$result->transaction_via;
			}
			if(!empty($result->transaction_ref))
			{
				$data1['transaction_ref']=$result->transaction_ref;
			}
			if($wt_category=='1')
			{
				$data1['recharge_type']='Add Money';
			}else if($wt_category=='2')
			{
				if($rec_category=='1')
				{
					$data1['recharge_type']='Mobile';
				}
			}else if($wt_category=='13')
			{
				$data1['recharge_type']='Church Donation';
			}else if($wt_category=='11')
			{
				$data1['recharge_type']='Consumer Bill';
			}else if($wt_category=='16')
			{
				$data1['recharge_type']='Event Ticket';
			}
				$data1['wt_category']=$wt_category;
				$data1['amount']=$amount;
				$data1['recharge_no']=$recharge_no;
				
			if($wt_category!='13' && $wt_category!='11'&& $wt_category!='16')
			{
				$where = array('operator_id' => $operator_id);
        		$operator = $this->login_model->get_data_where_condition('operator_list', $where);
				$data1['operator_name']=$operator[0]->operator_name;
				$data1['operator_image']=operator_image."/".$operator[0]->operator_image;
			}else if($wt_category=='13'){
				$where1 = array('church_area_id' =>$church_area_id);
				$church_area = $this->login_model->get_data_where_condition('church_area', $where1);
				$where = array('church_id' => $church_id);
				$church_list = $this->login_model->get_data_where_condition('church_list', $where);
				$data1['operator_name']=$church_list[0]->church_name;  // church_name
				$data1['operator_image']=church_image."/".$church_list[0]->church_img;   // church image
				$data1['church_area']=$church_area[0]->church_area; 
			}else if($wt_category=='11'){
				$where=array('bill_invoice_no'=>$consumer_number);
				$bill_details = $this->login_model->get_record_join_two_table('biller_user','biller_details','biller_id','biller_id','',$where);
				$data1['operator_name']=$bill_details[0]->biller_company_name;
		 	    $data1['operator_image']=biller_company_logo."/".$bill_details[0]->biller_company_logo;
				
			}else if($wt_category=='16'){
				
			$data['event_details'] = $this->login_model->get_simple_query("select event_name,event_image,event_date,event_place from event_list where event_id='".$event_id."'");
			$data1['operator_name']=$data['event_details'][0]->event_name;
		 	$data1['operator_image']=event_image."/".$data['event_details'][0]->event_image;
			$data1['event_date']=$data['event_details'][0]->event_date;
			$data1['event_place']=$data['event_details'][0]->event_place;
		
			}
			
			$this->session->set_userdata('array',$data1);
			redirect('Quick-Response');
	}
}
// function payment via bank account
function guest_payment_via_bankaccount()
{
	$data				=	$this->input->post();
	if(!empty($data))
	{
		$user_id 			= 	$this->session->userdata('guest_user_id'); 
 		$user_ac_no			=	$data['user_ac_no'];
		$bank_code			=	$data['bank_code'];
		$passcode			=	$data['passcode'];
		$coupon_amount		=	$data['coupon_amount'];
		$coupon_id			=	$data['coupon_id'];
		$rec_category		=	$this->session->userdata('rec_category'); 
		$amount				=	$this->session->userdata('amount'); 
		$recharge_no		=	$this->session->userdata('recharge_no'); 
		$operator_id		=	$this->session->userdata('operator_id'); 
		$wt_category		=	$this->session->userdata('wt_category'); 
		$operator_id		=	$this->session->userdata('operator_id'); 
		
	if($wt_category=='2'  || $wt_category=='12'){
	$request=file_get_contents( base_url('webservices/api.php?rquest=guest_recharge_from_card&recharge_user_id='.$user_id.'&payment_type=2&recharge_category_id='.$wt_category.'&operator_id='.$operator_id.'&recharge_number='.$recharge_no.'&payment_gateway_amt='.$amount.'&recharge_amount='.$amount.'&recipient_bank='.$bank_code.'&recipient_account_number='.$user_ac_no.'&passcode='.$passcode));
	}else if($wt_category=='11')
	{
		$consumer_number		=	$this->session->userdata('consumer_number'); 
		$biller_category_id		=	$this->session->userdata('biller_category_id');
		$biller_service_id		=	$this->session->userdata('biller_service_id'); 
		$biller_id 				=	$this->session->userdata('biller_id'); 

		$request=file_get_contents( base_url('webservices/api.php?rquest=guest_bill_pay_from_card&recharge_user_id='.$user_id.'&wt_category='.$wt_category.'&bill_category_id='.$biller_category_id.'&bill_consumer_no='.$consumer_number.'&bill_amount='.$amount.'&recipient_bank='.$bank_code.'&recipient_account_number='.$user_ac_no.'&passcode='.$passcode.'&payment_type=2&coupon_id='.$coupon_id.'&coupon_amount='.$coupon_amount.'&biller_id='.$biller_id));
	}	else if($wt_category=='13')
	{
		$church_id				=	$this->session->userdata('church_id'); 
		$church_category_id		=	$this->session->userdata('church_category_id');
		$church_area_id			=	$this->session->userdata('church_area_id'); 
		$church_product_id		=	$this->session->userdata('church_product_id'); 

		$request=file_get_contents( base_url('webservices/api.php?rquest=guest_donate_church_with_card&donar_user_id='.$user_id.'&wt_category='.$wt_category.'&church_id='.$church_id.'&church_area_id='.$church_area_id.'&church_category_id='.$church_category_id.'&church_product_id='.$church_product_id.'&church_product_price='.$amount.'&recipient_bank='.$bank_code.'&recipient_account_number='.$user_ac_no.'&passcode='.$passcode.'&payment_type=2&coupon_id='.$coupon_id.'&coupon_amount='.$coupon_amount));
	}else if($wt_category=='16')
	{
		$event_id				=	$this->session->userdata('event_id'); 
		$ticket_json_array		=	$this->session->userdata('ticket_json_array'); 
		
		$request=file_get_contents( base_url('webservices/api.php?rquest=ticket_booking_payment_with_card&user_id='.$user_id.'&wt_category='.$wt_category.'&event_id='.$event_id.'&tickets_records='.$ticket_json_array.'&ticket_price='.$amount.'&payment_gateway_price='.$amount.'&recipient_bank='.$bank_code.'&recipient_account_number='.$user_ac_no.'&passcode='.$passcode.'&payment_type=2&coupon_id='.$coupon_id.'&coupon_amount='.$coupon_amount));
	}
			$result=json_decode($request);
			$data1['status']=$result->status;
			$data1['message']=$result->message;
			$data1['trans_date']=$result->transaction_date;
			$data1['transaction_via']="Bank Account";
			
			if(!empty($result->transaction_ref))
			{
				$data1['transaction_ref']=$result->transaction_ref;
			}
			if($wt_category=='1')
			{
				$data1['recharge_type']='Add Money';
			}else if($wt_category=='2')
			{
				if($rec_category=='1')
				{
					$data1['recharge_type']='Mobile';
				}
			}else if($wt_category=='11')
			{
				$data1['recharge_type']='Bill Payment';
			}else if($wt_category=='13')
			{
				$data1['recharge_type']='Church Donation';
			}else if($wt_category=='16')
			{
				$data1['recharge_type']='Event Ticket';
			}
			$data1['wt_category']=$wt_category;
			$data1['amount']=$amount;
			$data1['recharge_no']=$recharge_no;
		if($wt_category!='13' && $wt_category!='16' && $wt_category!='11')
			{
			$where = array('operator_id' => $operator_id);
        	$operator = $this->login_model->get_data_where_condition('operator_list', $where);
			$data1['operator_name']=$operator[0]->operator_name;
			$data1['operator_image']=operator_image."/".$operator[0]->operator_image;
			}else if($wt_category=='13'){
				$where1 = array('church_area_id' => $church_area_id);
				$church_area = $this->login_model->get_data_where_condition('church_area', $where1);
				$where = array('church_id' => $church_id);
				$church_list = $this->login_model->get_data_where_condition('church_list', $where);
				$data1['operator_name']=$church_list[0]->church_name;  // church_name
				$data1['operator_image']=church_image."/".$church_list[0]->church_img;   // church image
				$data1['church_area']=$church_area[0]->church_area; 
			}else if($wt_category=='11'){
					$where=array('bill_invoice_no'=>$consumer_number);
			$data1['bill_details'] = $this->login_model->get_record_join_two_table('biller_user','biller_details','biller_id','biller_id','',$where);

			 $data1['operator_name']=$data1['bill_details'][0]->biller_company_name;
		 	$data1['operator_image']=biller_company_logo."/".$data1['bill_details'][0]->biller_company_logo;
				
			}else if($wt_category=='16'){
				
			$data['event_details'] = $this->login_model->get_simple_query("select event_name,event_image,event_date,event_place from event_list where event_id='".$event_id."'");
			$data1['operator_name']=$data['event_details'][0]->event_name;
		 	$data1['operator_image']=event_image."/".$data['event_details'][0]->event_image;
			$data1['event_date']=$data['event_details'][0]->event_date;
			$data1['event_place']=$data['event_details'][0]->event_place;
			$data1['ticket_records']=$ticket_json_array;
			}
			if($result->status=='true')
			{
				$this->toastr->success($result->message,'Success');
			}else{
				$this->toastr->error($result->message,'Error');
			}
			$this->session->set_userdata('array',$data1);
			redirect('Quick-Response');
	}
}
function quick_response()
{
	
	$data = $this->session->userdata('array');
	$this->load->view('web/quick-pay-success',$data);
	$this->load->view('web/inner_footer');
}
// wallet to bank transfer
function wallet_to_bank()
{
	if ($this->session->userdata('user_id') == FALSE) {
            redirect('web');
        }
	$user_id= $this->session->userdata('user_id'); 
	$data				=	$this->input->post();
	if(!empty($data))
	{
		$account_name   = $data['account_holder_name'];
		$account_number = $data['user_ac_no'];
		$user_bank_code = $data['user_bank_code'];
		$transfer_amt   = $data['transfer_amount'];
		$apiURL 		= base_url('webservices/api.php');
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
		  $this->toastr->error($err,'Error');
			
		} else {

		 		$result 					=	json_decode($response);

		 		if(isset($result) && !empty($result)){

					$data1['status'] 			=	$result->status;
					$data1['message']			=	$result->message;
					$data1['transaction_ref']	=	$result->transaction_ref;
					$data1['trans_date']		=	$result->transaction_date;

				}else{

					$data1['status'] 			=	false;
					$data1['message']			=	'Transaction Failed. Please try again.';
					$data1['transaction_ref']	=	'';
					$data1['trans_date']		=	date('F-d-Y h:i A',strtotime("Y-m-d"));

				}

				$data1['transaction_via']	=	"Wallet to Bank Transfer";
				$data1['wt_category'] 		=	 17;
				$data1['amount']			=	$transfer_amt;
				$data1['account_name']		=	$account_name;
				$data1['account_number']	=	$account_number;
				$data1['user_bank_code']	=	$user_bank_code;

				//print_r($data1); exit;
				if($result->status=='true')
				{
					$this->toastr->success($result->message,'Success');
				}else{
					$this->toastr->error($result->message,'Error');
				}
				$this->session->set_userdata('array',$data1);
				redirect('Payment-Response');
		}
		
	}
}
// function validate account number
function validate_account_number()
{
	if ($this->session->userdata('user_id') == FALSE) {
            redirect('web');
        }
	 $account_no 	= $_POST['account_no'];
	 $bank_code  	= $_POST['bank_code'];

	 $request=file_get_contents( base_url('webservices/api.php?rquest=validate_bank_account_number&account_number='.$account_no.'&bank_code='.$bank_code));
				$result 			=	json_decode($request);
				$status				=	$result->status;
				$message			=	$result->message;
				if($status=='true')
				{
					
					$name				=	$result->name;
				}else{

						$name			=   '';
				}
				
				$post=array('status'=>$status,'message'=>$message,'name'=>$name);
				echo json_encode($post);
		
}
// calling curl method
function calling_curl_method($url,$postField)
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


function openModal()  { 

	if(isset($_GET['id']) && $_GET['id'] != '' && isset($_GET['redirecturl']) && $_GET['redirecturl'] != ''){
	  $data['id'] = base64_decode($_GET['id']);
	  $data['redirecturl'] = base64_decode($_GET['redirecturl']);
	  $this->load->view('web/modal',$data);
	}else{
	  redirect(base_url($data['redirecturl'].'?url=error'));
	}

}


function openModalBankAcc()  {

	if(isset($_GET['id']) && $_GET['id'] != '' && isset($_GET['redirecturl']) && $_GET['redirecturl'] != ''){
	  $data['id'] = base64_decode($_GET['id']);
	  $data['redirecturl'] = base64_decode($_GET['redirecturl']);
	  $this->load->view('web/accountModal',$data);
	}else{
	  redirect(base_url($data['redirecturl'].'?url=error'));
	}

}




// valid otp verve card
function chargeAuth()
{
	if ($this->session->userdata('user_id') == FALSE) {
            redirect('web');
        }
	 $transactionRef 	= $_POST['transactionRef'];
	 $otp  				= $_POST['otp'];
	 $redirecturl  		= $_POST['redirecturl'];

	 $request=file_get_contents( base_url('webservices/api.php?rquest=chargeAuth&transactionRef='.$transactionRef.'&otp='.$otp));
				$result 			=	json_decode($request);

	$status				=	$result->status;
	$message			=	$result->message;

	redirect(base_url($redirecturl.'?url='.$status));


		
}


// valid otp bank account
function AcoountOtpVerify()
{
	if ($this->session->userdata('user_id') == FALSE) {
            redirect('web');
        }
	 $transactionRef 	= $_POST['transactionRef'];
	 $otp  				= $_POST['otp'];
	 $redirecturl  		= $_POST['redirecturl'];

	 $request=file_get_contents( base_url('webservices/api.php?rquest=AcoountOtpVerify&transactionRef='.$transactionRef.'&otp='.$otp));
				$result 			=	json_decode($request);

	$status				=	$result->status;
	$message			=	$result->message;

	redirect(base_url($redirecturl.'?url='.$status));
		
}
function genrate_QRCode()
	{
		$user_id    			= $_REQUEST['user_id'];
			$user_phone 			= $_REQUEST['user_phone'];
			$this->load->library('ciqrcode');
			$qr_image 				= $user_phone.'.png';
			$params['data'] 		= $user_phone;
			$params['level'] 		= 'H';
			$params['size'] 		= 8;
			$params['savename'] 	= $_SERVER['DOCUMENT_ROOT'].'/uploads/QR_Code/'.$qr_image;
			if($this->ciqrcode->generate($params))
			{
				$where = array('user_id'=>$user_id);
				$data['qr_code'] = $qr_image;
				$update = $this->login_model->update_data('user',$data,$where);
			

			}
		
		
	}

  //------------------------------------------------------------------------------------
//----end class----//
}
