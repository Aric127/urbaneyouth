<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Website extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('login_model');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('email');
        define('category_image', base_url('uploads/category/'));
        define('category_thumb_image', base_url('uploads/category/thumb_img/'));
        define('product_image', base_url('uploads/product/'));
        define('product_thumb_image', base_url('uploads/product/thumb_img/'));
        define('invoice_image', base_url('uploads/invoice_logo/'));
		define('free_coupon_image', base_url('uploads/coupon_img/'));
		define('church_image', base_url('uploads/church_image/'));
		define('event_image', base_url('uploads/event/'));
		  define('country_code',"+234" );
    	// Live api key
    	define('webpay_hashkey',"B668FF05B7B90C4A80F24FFC55DC2E1963F006CC861C215E5FD58CDABA70B52078FA481616A757D4CC7549A80ED4A6B8434381409D8CE0E0F6BACDC493291E6B");
		define('webpay_product_id',"6804");
		define('webpay_url','https://webpay.interswitchng.com/paydirect/pay');
		define('webpay_jsonurl','https://webpay.interswitchng.com/paydirect/api/v1/gettransaction.json');
		
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
	 		$where_biller = array('biller_category_status' => 1,'category'=>'1');
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
    function index() {
    	$verify_status = $this->uri->segment(3);
		$f_data['user_id']=$this->uri->segment(4);
		$f_data['g_login']=$this->uri->segment(5);
		$f_data['verify_status']=$verify_status;
    	$f_data['main_content'] = $this->login_model->get_record('main_content');
		$f_data['recharge_content'] = $this->login_model->get_record('recharge_content');
    	$f_data['footer'] 			= 	$this->footer();
		$f_data['church'] 			= 	$this->church();
		$f_data['contact_details']  = 	$this->contact_details();
		$f_data['about_details'] 	= 	$this->about_details();
		$f_data['biller_category']	=	$this->biller_category();
		$f_data['event_category']	=	$this->event_category();
		$this->load->view('website/header',$f_data);
        $this->load->view('website/index',$f_data);
        $this->load->view('website/footer',$f_data);
    }
	function my_profile(){
		 if ($this->session->userdata('user_id') == FALSE) {
            redirect('website');
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
		$this->session->set_userdata(array('verify_status'=>'1')); 
		$this->load->view('website/inner-header',$data);
        $this->load->view('website/my-profile',$data);
        $this->load->view('website/inner-footer');
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
		}
		if(!empty($_REQUEST['electric_card_number'])){
			$electric_card_number=$_REQUEST['electric_card_number'];
			$electricty_operator_id=$_REQUEST['electricty_operator_id'];
			$electrice_amount=$_REQUEST['electrice_amount'];
		}
		if(!empty($_REQUEST['church_p_id'])){
			$church_p_id=$_REQUEST['church_p_id'];
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
		if(!empty($mobile_amount)){
			$this->session->set_userdata(array('mobile'=>$mobile,'prepaid'=>$prepaid,'mobile_operator_id'=>$mobile_operator_id,'mobile_amount'=>$mobile_amount)); 
		}else if(!empty($tv_number)){
			$this->session->set_userdata(array('tv_number'=>$tv_number,'tv_operator_id'=>$tv_operator_id,'tv_rec_amount'=>$tv_rec_amount)); 
		}else if(!empty($data_card_number)){
			$this->session->set_userdata(array('data_card_number'=>$data_card_number,'data_operator_id'=>$data_operator_id,'data_rec_amount'=>$data_rec_amount)); 
		}else if(!empty($consumer_number)){
			$this->session->set_userdata(array('consumer_number'=>$consumer_number,'biller_category_id'=>$biller_category_id,'biller_service_id'=>$biller_service_id)); 
		}else if(!empty($electric_card_number)){
			$this->session->set_userdata(array('electric_card_number'=>$electric_card_number,'electricty_operator_id'=>$electricty_operator_id,'electrice_amount'=>$electrice_amount)); 
		}else if(!empty($church_p_id)){
			$this->session->set_userdata(array('church_p_id'=>$church_p_id,'church_price_id'=>$church_price_id,'church_id'=>$church_id,'church_price'=>$church_price,'church_category_id'=>$church_category_id)); 
		}else if(!empty($event_id)){
			$this->session->set_userdata(array('event_id'=>$event_id,'total_price_ticket'=>$total_price_ticket,'ticket_json_array'=>$ticket_json_array)); 
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
            redirect('website');
        }
		$user_id= $this->session->userdata('user_id'); 
		$result=file_get_contents( base_url('webservices/api.php?rquest=user_profile&user_id='.$user_id));
		$wallet=json_decode($result);
		$data['my_profile']=json_decode($result);
		$data['my_wallet']=$wallet->wallet_amount;
		$data['mobile']=$wallet->user_contact_no;
			$data['user_id']=$user_id;
			$total_price_ticket= $this->session->userdata('total_price_ticket'); 
			$event_id= $this->session->userdata('event_id'); 
			$ticket_json_array= $this->session->userdata('ticket_json_array'); 
       //$data['church_price']=$_REQUEST['church_price']; 
	   $data['recharge_category_id']=7; // ] church
		$where = array('event_id' => $event_id);
        $event_list = $this->login_model->get_data_where_condition('event_list', $where);
		$data['operator_name']=$event_list[0]->event_name;  // church_name
		$data['operator_image']=event_image."/".$event_list[0]->event_image;   // church image
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
        	$data['coupon_list'] = $this->login_model->get_data_where_condition('free_coupon_list', $where11);
			
		$this->load->view('website/inner-header',$data);
        $this->load->view('website/recharge-details',$data);
        $this->load->view('website/inner-footer');
}
// function mycustom_dictionary() {
	// $mobile = $this->input->post("mobile");
	// $prepaid = $this->input->post("prepaid");
	// $mobile_operator_id = $this->input->post("mobile_operator_id");
	// $mobile_amount = $this->input->post("mobile_amount");
	// $this->session->userdata(array("mobile_amount"=>$mobile_amount,"mobile_operator_id"=>$mobile_operator_id,"prepaid"=>$prepaid,"mobile"=>$mobile));
// }

// function pay bill.....
function pay_bill(){
		if ($this->session->userdata('user_id') == FALSE) {
            redirect('website');
        }
		$user_id= $this->session->userdata('user_id'); 
		$result=file_get_contents( base_url('webservices/api.php?rquest=user_profile&user_id='.$user_id));
		$wallet=json_decode($result);
		$data['my_profile']=json_decode($result);
		$data['my_wallet']=$wallet->wallet_amount;
		 $data['recharge_category_id']='4'; // ] pay bill
		  $data['biller_category_id']=$_REQUEST['biller_category_id']; // ] pay bill
		 $data['mobile']=$_REQUEST['consumer_number']; 
		 $data['mobile_operator_id']=$_REQUEST['biller_service_id']; 
	 	$where=array('biller_customer_id_no'=>$_REQUEST['consumer_number']);
		$data['bill_details'] = $this->login_model->get_record_join_two_table('biller_user','biller_details','biller_id','biller_id','',$where);
		 $data['operator_name']=$data['bill_details'][0]->biller_company_name;
		 $data['mobile_amount']=$data['bill_details'][0]->bill_amount;
		 $data['bill_pay_status']=$data['bill_details'][0]->bill_pay_status;
		 if($data['bill_pay_status']=='1'){
		 	$where111 = array('bill_consumer_no' =>$_REQUEST['consumer_number']);
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
		
		$this->load->view('website/inner-header',$data);
        $this->load->view('website/recharge-details',$data);
        $this->load->view('website/inner-footer');
	}

	function my_recharge(){
		if ($this->session->userdata('user_id') == FALSE) {
            redirect('website');
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
			
		$this->load->view('website/inner-header',$data);
        $this->load->view('website/recharge-details',$data);
        $this->load->view('website/inner-footer');
	}
	function tv_recharge(){
			 if ($this->session->userdata('user_id') == FALSE) {
            redirect('website');
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
			
		$this->load->view('website/inner-header',$data);
        $this->load->view('website/recharge-details',$data);
        $this->load->view('website/inner-footer');
	}
	function datacard_recharge(){
		if ($this->session->userdata('user_id') == FALSE) 
		{
            redirect('website');
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
			
		$this->load->view('website/inner-header',$data);
        $this->load->view('website/recharge-details',$data);
        $this->load->view('website/inner-footer');
	}
	// function electricity recharge
		function electric_recharge(){
		if ($this->session->userdata('user_id') == FALSE) 
		{
            redirect('website');
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
			
		$this->load->view('website/inner-header',$data);
        $this->load->view('website/recharge-details',$data);
        $this->load->view('website/inner-footer');
	}
	
	
	function my_transaction(){
			 if ($this->session->userdata('user_id') == FALSE) {
            redirect('website');
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

	if(!empty($res->transaction_details)){
		
		$data['transaction']=$res->transaction_details; }else{
			$data['transaction']='';
		}
$where111 = array('free_coupon_category_status' =>1);
        	$data['coupon_category'] = $this->login_model->get_data_where_condition('free_coupon_category', $where111);
			$where11 = array('coupon_status' =>1);
        	$data['coupon_list'] = $this->login_model->get_data_where_condition('free_coupon_list', $where11);
		$data['wt_category']=$wt_category;
		$this->load->view('website/inner-header',$data);
        $this->load->view('website/transactionHistory',$data);
        $this->load->view('website/inner-footer');
	}
	function repeat_recharge(){
			 if ($this->session->userdata('user_id') == FALSE) {
            redirect('website');
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
		$this->load->view('website/inner-header',$data);
        $this->load->view('website/recharge-details',$data);
        $this->load->view('website/inner-footer');
		
	}
function repeat_transfer_money(){
		 if ($this->session->userdata('user_id') == FALSE) {
            redirect('website');
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
		
		$this->load->view('website/inner-header',$data);
        $this->load->view('website/transfer_money',$data);
        $this->load->view('website/inner-footer');
}
function repeat_add_sms(){
		 if ($this->session->userdata('user_id') == FALSE) {
            redirect('website');
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
		
		$this->load->view('website/inner-header',$data);
        $this->load->view('website/sms_management',$data);
        $this->load->view('website/inner-footer');
}
	function my_wallet(){
		
			 if ($this->session->userdata('user_id') == FALSE) {
            redirect('website');
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
	
		//$result=file_get_contents( base_url('webservices/api.php?rquest=user_profile&user_id='.$user_id));
		//$data['my_wallet']=json_decode($result);
		$this->load->view('website/inner-header',$data);
        $this->load->view('website/wallet',$data);
        $this->load->view('website/inner-footer');
	}
 	function about_us(){
 			 if ($this->session->userdata('user_id') == FALSE) {
            redirect('website');
        }
 		$f_data['footer'] = $this->footer();
 		$result=file_get_contents( base_url('webservices/api.php?rquest=about_us'));
		$result=json_decode($result);
		$data['about_us']=html_entity_decode($result->about_us);
		$this->load->view('website/header');
        $this->load->view('website/about',$data);
        $this->load->view('website/footer',$f_data);
 	}
		function contact_us()
		{
				$f_data['contact_details'] = $this->contact_details();
			$f_data['footer'] = $this->footer();
 			$result=file_get_contents( base_url('webservices/api.php?rquest=contact_us'));
			$data['result']=json_decode($result);
			$this->load->view('website/header');
	        $this->load->view('website/contact_us',$data);
	        $this->load->view('website/footer',$f_data);
		}
		function faq()
		{
			$f_data['footer'] = $this->footer();
 			$where111 = array('faq_status' =>'1');
        	$data['faq'] = $this->login_model->get_data_where_condition('faq', $where111);
			$this->load->view('website/header');
	        $this->load->view('website/faq',$data);
	        $this->load->view('website/footer',$f_data);
		}
		function terms_conditions(){
			$f_data['footer'] = $this->footer();
 			$result=file_get_contents( base_url('webservices/api.php?rquest=terms'));
			$result=json_decode($result);
			$data['terms']=html_entity_decode($result->terms);
			  $f_data['contact_details'] = $this->contact_details();
			$this->load->view('website/header');
	        $this->load->view('website/terms',$data);
	        $this->load->view('website/footer',$f_data);
		}
		function sms_management(){
				 if ($this->session->userdata('user_id') == FALSE) {
            redirect('website');
        }
		$user_id= $this->session->userdata('user_id');
		 $result=file_get_contents( base_url('webservices/api.php?rquest=user_profile&user_id='.$user_id));
			$wallet=json_decode($result);
		$data['my_profile']=json_decode($result);
		$data['my_wallet']=$wallet->wallet_amount;
			$this->load->view('website/inner-header',$data);
	        $this->load->view('website/sms_management');
	        $this->load->view('website/inner-footer');
		}
		function transfer_money(){
				 if ($this->session->userdata('user_id') == FALSE) {
            redirect('website');
        }
				 $user_id= $this->session->userdata('user_id');
		 $result=file_get_contents( base_url('webservices/api.php?rquest=user_profile&user_id='.$user_id));
		$wallet=json_decode($result);
		$data['my_profile']=json_decode($result);
		$data['my_wallet']=$wallet->wallet_amount;
			$this->load->view('website/inner-header',$data);
	        $this->load->view('website/transfer_money',$data);
	        $this->load->view('website/inner-footer');
		}
		function change_transfer_pin_status(){
			$user_id=$_REQUEST['user_id'];
			$this->session->set_userdata(array('user_pin_status'=>'1')); 
			 $this->session->userdata('user_pin_status');
			
		}
		function change_password(){
				 if ($this->session->userdata('user_id') == FALSE) {
            redirect('website');
        }
			 $user_id= $this->session->userdata('user_id');
			 $result=file_get_contents( base_url('webservices/api.php?rquest=user_profile&user_id='.$user_id));
		$wallet=json_decode($result);
		$data['my_profile']=json_decode($result);
		$data['my_wallet']=$wallet->wallet_amount;
			$this->load->view('website/inner-header',$data);
	        $this->load->view('website/change_password');
	        $this->load->view('website/inner-footer');
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
			$this->load->view('website/inner-header',$data);
	        $this->load->view('website/share_earn',$data);
	        $this->load->view('website/inner-footer');
		}
	function user_login(){
			$user_id=$_POST['user_id']; 
			$where = array('user_id' => $user_id);
            $user_record = $this->login_model->get_data_where_condition('user', $where);
			$user_pin_status=$user_record[0]->user_pin_status;
			$user_reffer_code=$user_record[0]->user_refferal_code;
		// if(!empty($_POST['reffer_code'])){
			// $reffer_code=$_POST['reffer_code'];
		// }
		// $user_reffer_code=$_POST['reffer_code']; 
		if(!empty($user_id)){
			$login_type=$_POST['login_type'];
		// $name=$_POST['user_name'];
		
		
		$user_wallet=$_POST['user_wallet']; 
		//$password=$_POST['user_password'];
		$this->session->set_userdata(array('user_id'=>$user_id)); 
		$this->session->set_userdata(array('user_id'=>$user_id,'user_wallet'=>$user_wallet,'login_type'=>$login_type,'reffer_code'=>$user_reffer_code,'user_pin_status'=>$user_pin_status)); 
		
			echo "1";
					
					}else{
						echo "2";
					}
				
		
		
	}
	function fb_login(){
		$user_id=$_POST['user_id'];
		if(!empty($user_id)){
		 $name=$_POST['user_name'];
		$login_type=$_POST['login_type'];
		 $email=$_POST['user_email'];
		$verify_status=$_POST['verify_status'];
		$user_wallet=$_POST['user_wallet']; 
		$frnd_reffer_code=$_REQUEST['frnd_reffer_code']; 
		$user_pin_status=$_REQUEST['user_pin_status']; 
		$this->session->set_userdata(array('user_id'=>$user_id,'user_email'=>$email,'user_wallet'=>$user_wallet,'user_name'=>$name,'login_type'=>$login_type,'verify_status'=>$verify_status,'reffer_code'=>$frnd_reffer_code,'user_pin_status'=>$user_pin_status)); 
			echo "1";
					
					}else{
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
							redirect('website/index/'.$verify_status.'/'.$result.'/'.'1');
						}else{
							redirect(site_url('website'));
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
						
							redirect('website/index/'.$verify_status.'/'.$user_id.'/'.'1');
						}else{
							$this->session->set_userdata(array('user_id'=>$user_id,'user_email'=>$user_email,'user_wallet'=>0,'user_name'=>$name,'login_type'=>3,'verify_status'=>'1','recharge_status'=>1,'user_pin_status'=>$user_pin_status)); 
							redirect(site_url('website'));
						}
					 }else{
					 //	$message="Account Inactive by admin, please contact to OyaCahrge"
					 	redirect('website/index/'.'11'.'/'.$user_id.'/'.'2');
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
	redirect('website');
}
	function view_offer(){
		$data=$this->input->post();
		//print_r($data);
	}
    function logout() {
    
        $this->session->sess_destroy();
        redirect('website');
    }
	
	// function get coupon
function get_offer_details(){
	$coupon_id=$_REQUEST['coupon_id'];
	$where = array('fee_coupon_category_id' => $coupon_id);
    $data['coupon_list'] = $this->login_model->get_data_where_condition('free_coupon_list', $where);
	 $this->load->view('website/free_coupon_ajax',$data);
}

// function get all coupons
 function get_all_coupon(){
	$coupon_id=$_REQUEST['coupon_id'];
	$where = array('coupon_status' => 1);
    $data['coupon_list'] = $this->login_model->get_data_where_condition('free_coupon_list', $where);
	 $this->load->view('website/free_coupon_ajax',$data);
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
            redirect('website');
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
			$this->load->view('website/inner-header',$data);
	        $this->load->view('website/callback');
	        $this->load->view('website/inner-footer');
}
function wallet_callback(){   // wallet call back function
			 if ($this->session->userdata('user_id') == FALSE) {
            redirect('website');
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
			$this->load->view('website/inner-header',$data);
	        $this->load->view('website/wallet_callback');
	        $this->load->view('website/inner-footer');
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
            redirect('website');
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
			$this->load->view('website/inner-header',$data);
	        $this->load->view('website/payment');
	        $this->load->view('website/inner-footer');
}
	function set_wallet_add_value(){
	 	$amt=$_REQUEST['amount']*100;
		$this->session->set_userdata(array('amt'=>$amt)); 

	$url=site_url("website/wallet_callback");
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
            redirect('website');
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
			$this->load->view('website/inner-header');
	        $this->load->view('website/wallet',$data);
	        $this->load->view('website/inner-footer');
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
	$url=site_url("website/callback");
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
		$this->load->view('website/sample_pay',$data);
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
	$url=site_url("website/webview_response");
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
	$this->load->view('website/sample_pay_resp');
}
function pay_success()
{
	
        $transaction_id = $this->uri->segment(4);
		$this->load->view('website/pay_success_response');
}
function pay_failure()
{
	 $transaction_id = $this->uri->segment(4);
	$this->load->view('website/pay_failure_response');
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
            redirect('website');
        }
		$user_id= $this->session->userdata('user_id'); 
		$result=file_get_contents( base_url('webservices/api.php?rquest=user_profile&user_id='.$user_id));
		$wallet=json_decode($result);
		$data['my_profile']=json_decode($result);
		$data['my_wallet']=$wallet->wallet_amount;
	 //	$data['mobile']=$_REQUEST['mobile']; 
	 	$data['user_id']=$user_id;
       //$data['church_price']=$_REQUEST['church_price']; 
	   $data['recharge_category_id']=6; // ] church
	$data['church_category_id']=$_REQUEST['church_category_id'];
	$data['church_biller_id']=$_REQUEST['church_biller_id'];
	$data['church_p_id']=$_REQUEST['church_p_id'];
	    $church_id=$_REQUEST['church_id']; 
		$where = array('church_id' => $church_id);
        $church_list = $this->login_model->get_data_where_condition('church_list', $where);
		$data['operator_name']=$church_list[0]->church_name;  // church_name
		$data['operator_image']=$church_list[0]->church_img;   // church image
		$data['mobile_operator_id']=$church_id;
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
			
		$this->load->view('website/inner-header',$data);
        $this->load->view('website/recharge-details',$data);
        $this->load->view('website/inner-footer');
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
  //------------------------------------------------------------------------------------
//----end class----//
}
