<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Biller extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('login_model');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('email');
    	  $this->load->library('pdf_genrator/mpdf');
         define('company_logo', base_url('uploads/biller_company_logo/'));
    	   define('bill_invoice', base_url('uploads/bill_invoice/'));
         define('invoice', base_url('uploads/invoice/'));
         define('powerd_by', base_url('wassets/imagespowredby.png'));
         define('bill_invoice_paid', base_url('uploads/bill_invoice_paid/'));
    		 define('church_image',base_url('uploads/church_image'));
    		 define('event_ticket_image',base_url('uploads/event'));
    		  define('QRCode',base_url('uploads/QR_Code'));
    		 define('biller_sattlement',base_url('uploads/biller_sattlement'));
         define('biller_product',base_url('uploads/biller_products/'));
         define('oyapad_product',base_url('uploads/oyapad/'));
    		 $path='/var/www/html/uploads/invoice/';
        if ($this->session->userdata('biller_id') == FALSE) {
            redirect('biller_login');
        }else{
        	$biller_id= $this->session->userdata('biller_id');
        }
    }
  function change_password() {
        if ($this->input->post()) {
            $where = array('biller_id' => $this->session->userdata('biller_id'), 'biller_password' => md5($this->input->post('old_password'))); 
            $check_password = $this->login_model->get_record_where('biller_details', $where); 
            if ($check_password == FALSE) {
                $post = array('status'=>0,'message'=>'Old Password does not match');
                echo json_encode($post);
                exit();
            } else {
                
                $where = array('biller_id' => $this->session->userdata('biller_id'));
                $data['biller_original_pass']=$this->input->post('new_password');
                $data['biller_password']=md5($this->input->post('new_password'));
                $this->login_model->update_data('biller_details', $data, $where);

                //----------------Mail Start------------------//

                $message = '<h1>Oyacharge </h1></b></b><p>Your password has been changed successfully Your Email = ' . $this->session->userdata('biller_email') . '.</p>
			<p><a href="' . base_url('biller_login') . '" [astyle]></a></p></b>,
			</b></b><p>The Admin</p>';

                $to = $this->session->userdata('biller_email');
                $subject = 'Password Changed';
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
                $headers .= 'From: Oyacharge' . "\r\n";
            //    mail($to, $subject, $message, $headers);
				$this->sendElasticEmail($to, $subject,"OyaCharge", $message, "care@oyacharge.com", "OyaCharge",'');
                //----------------Mail End------------------//
         		$post = array('status'=>1,'message'=>'Password successfully changed');
                echo json_encode($post);
                exit();
                //$this->session->set_flashdata('success', 'Password successfully changed');
               // redirect('biller/change_password');
            }
        } 
    }
function sendElasticEmail_old($to, $subject, $body_text, $body_html, $from, $fromName,$attachments)
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
	if($attachments)
      $data .= "&attachments=".urlencode($attachments);
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
      echo $res;
      fclose($fp);
    }
   
    return $res;                  
}


   function sendElasticEmail($to, $subject, $body_text, $body_html, $from, $fromName,$attachments)
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
 if($attachments)
 $data .= "&attachments=".urlencode($attachments);
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


function uploadAttachment($filepath, $filename) {
  $username=urlencode("care@oyacharge.com");
  $apikey=urlencode("9baa5dc0-e443-4f06-ac91-e547d3845151");

 $data = http_build_query(array('username' => $username,'api_key' => $apikey,'file' => $filename));
 $file = file_get_contents($filepath);
 $result = ''; 

 $fp = fsockopen('ssl://api.elasticemail.com', 443, $errno, $errstr, 30); 

 if ($fp){
 fputs($fp, "PUT /attachments/upload?".$data." HTTP/1.1\r\n");
 fputs($fp, "Host: api.elasticemail.com\r\n");
 fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
 fputs($fp, "Content-length: ". strlen($file) ."\r\n");
 fputs($fp, "Connection: close\r\n\r\n");
 fputs($fp, $file);
 while(!feof($fp)) {
 $result .= fgets($fp, 128);
 }
 } else { 
 return array(
 'status'=>false,
 'error'=>$errstr.'('.$errno.')',
 'result'=>$result);
 }
 fclose($fp);
 $result = explode("\r\n\r\n", $result, 2); 
 return array(
 'status' => true,
 'attachId' => isset($result[1]) ? $result[1] : ''
 );
}
    function index() {

   $biller_id=$this->session->userdata('biller_id');
    $sqlbiller="SELECT biller_type from biller_details where biller_id='".$biller_id."'";
    $biller_type=$this->login_model->get_simple_query($sqlbiller);
    $billerType=$biller_type[0]->biller_type;
    if($billerType=='1')
    {
      $where11=array('biller_id'=>$this->session->userdata('biller_id'));
      $data['bill_user'] = $this->login_model->count_records_where('biller_user', $where11);
      $where112=array('biller_id'=>$this->session->userdata('biller_id'),'bill_pay_status'=>'1');
      $data['bill_paid'] = $this->login_model->count_records_where('biller_user', $where112);
      $where1122=array('biller_id'=>$this->session->userdata('biller_id'),'bill_pay_status'=>'2');
      $data['bill_pending'] = $this->login_model->count_records_where('biller_user', $where1122);
      $sql="select sum(bill_amount) as total_donation,count(*) as total_trans from bill_recharge where biller_id='".$biller_id."' and bill_pay_status='1'";
      $data['Bill_amount']=$this->login_model->get_simple_query($sql);
      $sql_pending_invoice="select sum(bill_amount) as total_pending from biller_user where  biller_id='".$biller_id."' and bill_pay_status='2'";
      $data['pending_amount']=$this->login_model->get_simple_query($sql_pending_invoice);
      $sql_total_invoice="select sum(bill_amount) as total_amount from biller_user where  biller_id='".$biller_id."'";
      $data['total_amount']=$this->login_model->get_simple_query($sql_total_invoice);
      $sql_biller="SELECT `bill_recharge`.bill_pay_date as bill_pay_date,biller_user.bill_invoice_no as bill_invoice_no,bill_recharge.bill_consumer_no,bill_recharge.bill_transaction_id,bill_recharge.bill_amount as bill_amount,biller_user.biller_user_name as username,biller_user.bill_paid_invoice,user.user_email as useremail FROM `bill_recharge` join biller_user on biller_user.bill_invoice_no=bill_recharge.bill_invoice_no join user on user.user_id=bill_recharge.bill_user_id where bill_recharge.biller_id='".$biller_id."' order by bill_recharge_id DESC limit 5";
      $data['biller_trans']=$this->login_model->get_simple_query($sql_biller);
      $sql_billerUser="SELECT biller_user_name,biller_user_email,bill_invoice_no,bill_invoice_date from biller_user where biller_id='".$biller_id."' order by biller_user_id DESC limit 5";
      $data['billerUSER']=$this->login_model->get_simple_query($sql_billerUser);
      $sql_wallet="select wallet_amount,(select count(*) as count from biller_produt where biller_id='".$biller_id."') as product_count from user where biller_id='".$biller_id."'";
      $data['oyawallet']=$this->login_model->get_simple_query($sql_wallet); 
      $sql_consumner="SELECT biller_customer_id_no FROM `biller_user` where biller_id='".$biller_id."' group by biller_customer_id_no";
       $consumner_count=$this->login_model->get_simple_query($sql_consumner); 
       $data['count_consumer'] = count($consumner_count);
       $weeekly_invoice ="SELECT count(*) as invoice_count,bill_invoice_date from biller_user WHERE YEARWEEK(`bill_invoice_date`, 1) = YEARWEEK(CURDATE(), 1) and biller_id='".$biller_id."' group by bill_invoice_date";
       $data['week_invoice_count']=$this->login_model->get_simple_query($weeekly_invoice);
         $weeekly_invoice ="SELECT sum(bill_amount) as invoice_amount,bill_invoice_date from biller_user WHERE YEARWEEK(`bill_invoice_date`, 1) = YEARWEEK(CURDATE(), 1) and biller_id='".$biller_id."' and bill_pay_status=1  group by bill_invoice_date";
       $data['week_invoice_amount']=$this->login_model->get_simple_query($weeekly_invoice);
    }
    $biller_settlement = "SELECT SUM(settlement_amount) as settlement_amount,count(*) as settlement_count FROM biller_sattlement  where biller_id='".$biller_id."'";
     $settlement=$this->login_model->get_simple_query($biller_settlement);
     $data['settlement_amount']=$settlement[0]->settlement_amount;
     $data['settlement_count']=$settlement[0]->settlement_count;
     $data['biller_details']=$this->biller_required_detils();
     $data['BillerUserTransaction']=$this->getBillerUserTransactions();
		    $this->load->view('new_biller/header',$data);
        $this->load->view('new_biller/sidebar');
        $this->load->view('new_biller/dashboard',$data);
        $this->load->view('new_biller/footer');
		
    }
    function check_records()
    {
      $date   = date("Y-m-d");
      $ts     = strtotime($date);
      $year   = date('o', $ts);
      $week   = date('W', $ts);
     for($i = 1; $i <= 7; $i++) 
     {
      $ts = strtotime($year.'W'.$week.$i);
      print date("Y-m-d", $ts) . "\n";
     }
    }
    function bill_paid_transaction()
    {
      $biller_id=$this->session->userdata('biller_id');
      $sql="SELECT bill_recharge.bill_consumer_no,bill_recharge.bill_invoice_no,bill_transaction_id,bill_recharge.bill_amount,bill_pay_date,biller_user_name,bill_product_name FROM `bill_recharge` join biller_user on biller_user.bill_invoice_no=bill_recharge.bill_invoice_no where bill_recharge.biller_id='".$biller_id."'";
      $bill_transactions=$this->login_model->get_simple_query($sql);
      return $bill_transactions;
    }
    function getBillerUserTransactions()
    {
      $biller_id=$this->session->userdata('biller_id');
      $sqlbiller="SELECT biller_type from biller_details where biller_id='".$biller_id."'";
      $biller_type=$this->login_model->get_simple_query($sqlbiller);
      $billerType=$biller_type[0]->biller_type;
       if($billerType=='1')
      {
        $where11=array('biller_id'=>$biller_id);
        $users = $this->login_model->count_records_where('biller_user', $where11); 
        $sql_biller="SELECT SUM(bill_recharge.bill_amount) as amount FROM `bill_recharge` where bill_recharge.biller_id='".$biller_id."'";
        $transactions=$this->login_model->get_simple_query($sql_biller);
        $amount=$transactions[0]->amount;
      }else if($billerType=='2')
      {
        $donateusersql="SELECT count(*) as users FROM `church_donate` where church_biller_id='".$biller_id."'";
          $user=$this->login_model->get_simple_query($donateusersql);
          $users=$user[0]->users;
           $sql="select sum(church_product_price) as amount from  church_donate where church_biller_id='".$biller_id."' and payment_status='1'";
           $trans=$this->login_model->get_simple_query($sql);
           $amount=$trans[0]->amount;
      }else if($billerType=='3')
      {
           $sql11121="SELECT count(*) as event_user FROM `booking_event_tickets` where event_biller_id='".$biller_id."' ";
           $user=$this->login_model->get_simple_query($sql11121);
            $users=$user[0]->event_user;
           $sql="select sum(booking_ticket_price) as amount from  booking_event_tickets where event_biller_id='".$biller_id."' and booking_event_tickets_status='1'";
           $transactions=$this->login_model->get_simple_query($sql);
             $amount=$transactions[0]->amount;
      }
      $arr=array('users'=>$users,'transactions'=>$amount);
      return $arr;
    }
	// biller consumer list///
	function consumer_list()
	{
		$where=array('biller_user.'.'biller_id'=>$this->session->userdata('biller_id'),'invoice_create_status'=>1);
		$data['consumer_details'] = $this->login_model->get_data_where_condition('biller_user', $where,'biller_user_id');
		$data['biller_details']=$this->biller_required_detils();
	    $this->load->view('new_biller/header');
        $this->load->view('new_biller/sidebar',$data);
        $this->load->view('new_biller/invoicelist', $data);
        $this->load->view('new_biller/footer');
	}
	function invoice_details()
	{
		 $invoice_type = $this->uri->segment(3);
		 $invoice_no = $this->uri->segment(4);
		 if($invoice_type==2)
		 {
		 	$where =  array('bill_invoice_no'=>$invoice_no);
		 }else if($invoice_type==1){
		 	$where =  array('bill_paid_invoice_no'=>$invoice_no);
		 	$where1 =  array('bill_invoice_no'=>$invoice_no);
		 	$paid_details = $this->login_model->get_data_where_condition('bill_recharge', $where1);
		 	
		 }
		 	$data['invoice_details'] = $this->login_model->get_data_where_condition('biller_user', $where);
		 	if(!empty($data['invoice_details']))
		 	{
		 		 $bill_product_id = $data['invoice_details'][0]->bill_product_id; 
		 		 if(!empty($bill_product_id))
		 		 {
		 		 	$productids= explode(",", $bill_product_id);

		 		 	foreach ($productids as  $value) {
		 		 		$whereq =  array('biller_invoice_product_id'=>$value,'biller_invoice_no'=>$invoice_no);
		 				$products[] = $this->login_model->get_data_where_condition('biller_invoice_products', $whereq);
		 		 	}

          $data['invoice_details']['products'] = $products;
          
		 		 	if(!empty($paid_details) && $invoice_type==1)
		 		 	{
		 		 		$data['invoice_details'][0]->bill_transaction_id=$paid_details[0]->bill_transaction_id;
		 		 		$data['invoice_details'][0]->bill_pay_date=$paid_details[0]->bill_pay_date;
		 		 	}else{
		 		 		$data['invoice_details'][0]->bill_transaction_id='';
		 		 		$data['invoice_details'][0]->bill_pay_date='';
		 		 	}
		 		 	
		 		 }
		 	}

		 
		 
		 $data['biller_details']=$this->biller_required_detils();

	    $this->load->view('new_biller/header');
        $this->load->view('new_biller/sidebar',$data);
        $this->load->view('new_biller/newinvoicelist', $data);
        $this->load->view('new_biller/footer');
	}
  function get_wallet_amount()
  {
       $biller_id = $this->session->userdata('biller_id');
       $select="select user_id, wallet_amount from user where biller_id = '".$biller_id."'";
       $users=$this->login_model->get_simple_query($select);
       return $users;
  }
	function biller_profile()
  {
  
        $data['biller_details']=$this->biller_required_detils();
        $data['get_wallet']  = $this->get_wallet_amount();
         $sql="SELECT * FROM `bank_list` WHERE bank_status=1 order by bank_name ASC";
        $data['bank_list']=$this->login_model->get_simple_query($sql);
        $this->load->view('new_biller/header');
        $this->load->view('new_biller/sidebar',$data);
        $this->load->view('new_biller/profile',$data);
        $this->load->view('new_biller/footer');
  }
  function configuiration()
  {
        $data['biller_details']=$this->biller_required_detils();
        $data['get_wallet']  = $this->get_wallet_amount();
        $data['biller_config']=$this->login_model->get_simple_query("SELECT biller_name,biller_address,biller_contact_no,biller_email,qr_code,minimum_withdraw_amount,wallet_amount,agent_users.agent_margin,biller_company_logo FROM `biller_details` join user on user.biller_id=biller_details.biller_id LEFT join agent_users on agent_users.agent_user_id=user.user_id where biller_details.biller_id='".$this->session->userdata('biller_id')."'");
        $this->load->view('new_biller/header');
        $this->load->view('new_biller/sidebar',$data);
        $this->load->view('new_biller/confrigation',$data);
        $this->load->view('new_biller/footer');
  }
  function biller_config()
  {
  	   $data = $this->input->post();
  		$data12['minimum_withdraw_amount']=$data['minimum_withdraw_amount'];
        $where=array('biller_details.'.'biller_id'=>$this->session->userdata('biller_id'));
        $this->login_model->update_data('biller_details', $data12, $where);
        $this -> session -> set_flashdata('success', 'Your configuiration setting saved Successfully !');
        redirect('biller/configuiration');
  }
  function update_biller_info()
  {
    if($this->input->post('finish'))
    {
      $data = $this->input->post();
      $data12['biller_name']          = $data['biller_name'];
      $data12['biller_email']         = $data['biller_email'];
      $data12['biller_company_name']  = $data['biller_company_name'];
      $data12['biller_contact_no']    = $data['biller_contact_no'];
      $data12['company_reg_no']       = $data['company_reg_no'];
      $data12['rc_no']                = $data['rc_no'];
      $data12['tin_no']               = $data['tin_no'];
      if(!empty($data['bank_code']))
      {
      	 $data12['bank_code']            = $data['bank_code'];
      	 $data12['bank_account_no']      = $data['bank_account_no'];
         $data12['bank_account_holder']  = $data['bank_account_holder'];
          $where12= array('bank_code'=>$data['bank_code']);
      	  $bank = $this->login_model->get_data_where_condition('bank_list', $where12);
          $data12['bank_name']       = $bank[0]->bank_name;
      }
     
      $data12['biller_address']       = $data['biller_address'];
      $data12['biller_state']         = $data['biller_state'];
      $data12['biller_city']          = $data['biller_city'];
      $data12['biller_zipcode']       = $data['biller_zipcode'];
     
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
                     $source_image = "uploads/biller_company_logo/".$file_name;
			 		$this->make_thumb($source_image,$source_image,'400');
                } else {
                    $this->session->set_flashdata('error', 'Invalid Image type');
                    redirect('biller/biller_profile');
                }
                $data12['biller_company_logo']=$imagename;
            }
             $user_image1 = '';
          if ($_FILES['biller_document']['name']) {
                $user_image1 = $_FILES['biller_document']['name'];
          
                $file_extension1 = explode(".", $_FILES["biller_document"]["name"]);
                $new_extension1 = strtolower(end($file_extension1));
                $today1 = time();
                $custom_name1 = "biller_document" . $today1;
                $file_name1 = $custom_name1 . "." . $new_extension1;

                if ($new_extension1 == 'png' || $new_extension1 == 'jpeg' || $new_extension1 == 'jpg' || $new_extension1 == 'bmp') {
                   move_uploaded_file($_FILES['biller_document']['tmp_name'], "./uploads/biller_company_logo/" . $file_name1);
                    $imagename1 = $file_name1;
                } else {
                    $this->session->set_flashdata('error', 'Invalid Image type');
                    redirect('biller/biller_profile');
                }
                $data12['biller_document']=$imagename1;
            }
      $where=array('biller_details.'.'biller_id'=>$this->session->userdata('biller_id'));
      $this->login_model->update_data('biller_details', $data12, $where);

        $where1210= array('biller_id'=>$this->session->userdata('biller_id'));
      	  $billerDetals = $this->login_model->get_data_where_condition('biller_details', $where1210);
          $biller_status  = $billerDetals[0]->biller_status;
          if($biller_status==2)
          {
          	$this -> session -> set_flashdata('success', 'Your profile is successfully submitted.! Please wait for admin review and approval !');
          }else{
          	$this -> session -> set_flashdata('success', 'Your profile is successfully updated.!');
          }
       
      redirect('biller/biller_profile');
    }
  }
  function biller_consumer()
  {
        $biller_id=$this->session->userdata('biller_id');
        $sql="select *  from biller_user where biller_id='".$biller_id."'   group by biller_customer_id_no order by biller_user_id DESC";
        $data1['biller_consumer']=$this->login_model->get_simple_query($sql); 
        $data['biller_details']=$this->biller_required_detils();
        
        $this->load->view('new_biller/header');
        $this->load->view('new_biller/sidebar',$data);
        $this->load->view('new_biller/consumer',$data1);
        $this->load->view('new_biller/footer');
  }
  function biller_edit()
  {
        $data['biller_details']=$this->biller_required_detils();
        $this->load->view('biller/menu',$data);
        $this->load->view('biller/header');
        $this->load->view('biller/listing/bill_profile_edit');
        $this->load->view('biller/footer');
  }
	function pdf(){
		$this->load->library('PDF');
       
        $pdf = new PDF();
        // Data loading
        $pdf->AddPage();
			$where=array('biller_customer_id_no'=>'9110036974');
			$data= $this->login_model->get_join_three_table_where('biller_details','biller_user','biller_category','biller_id','biller_id','biller_category_id','biller_category_id',$where);
		//	print_r($data['rec']);
			 $data['image']=company_logo; 
		    $pdf->SignUp($data);
        $pdf->Output();
        //$pdf->Output('/var/www/Recharge/uploads/'.'Bill'.'.pdf','F');
	}
	
	function send_bill_user_msg($mobile,$invoice_no,$consumer_no,$amount)
	{
		 $message='Your Invoice INV#'.$invoice_no.' '.'of amount Naira'.' '.$amount.' '.' is generated of consumer no.'.' '.$consumer_no;
		$encodedMessage = urlencode($message);
		$url = "http://www.kudisms.net/components/com_spc/smsapi.php?username=abhishek.kumar@efficiencie.com&password=oyacharge_@1india2017&sender=OyaCharge&recipient=$mobile&message=" . $encodedMessage;
		$ch = curl_init();
		curl_setopt_array($ch, array(CURLOPT_URL => $url, CURLOPT_RETURNTRANSFER => true, CURLOPT_POST => true,
		CURLOPT_FOLLOWLOCATION => true));
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$output = curl_exec($ch);

		curl_close($ch);
	}
  function testpdf()
  {
    $this->create_new_pdf(1512370101833);
  }
		function create_new_pdf11111($invoice_no)
	{
		
		 $where=array('bill_invoice_no'=>$invoice_no);
      $data= $this->login_model->get_join_three_table_where('biller_details','biller_user','biller_category','biller_id','biller_id','biller_category_id','biller_category_id',$where);
      $invoice_date=$data[0]->bill_invoice_date;
      $title='Bill Invoice';
    
	
$html = '
<!DOCTYPE html>
<html>
   <head>
      <title></title>
   </head>
   <body>
      <div class="container">
         <div style="font-family:&quot;Trebuchet MS&quot;,&quot;Helvetica&quot;,Helvetica,Arial,sans-serif;line-height:1.6em;background-color:#fff;text-align:center">
            <table cellspacing="0" cellpadding="0" bgcolor="#fff" align="center" style="border-spacing:0;border-collapse:collapse;padding:20px;width:1024px">
               <tbody>
                  <tr>
                     <td bgcolor="#fff" style="border:1px solid #f0f0f0">
                        <div style="display:block;margin:0 auto;max-width:1024px"><table style="width:100%;border-spacing:0;border-collapse:collapse">
                              <tbody>
                                 <tr>
                                    <td style="text-align:center">
                                       <table style="width:100%;border-spacing:0;border-collapse:collapse;padding:15px 10px">
                                          <tbody>
                                             <tr>
                                                <td align="left" colspan="2" style="padding:10px 35px;background-color:#192a3b">
                                                   <a>
                                                   <img src="https://oyacharge.com/wassets/images/logo.png" style="padding:10px;" width="130px" class=""/>
                                                   </a>
                                                </td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td style="text-align:center;background-color:#57A9A0;text-transform:uppercase;padding:10px;color:#fff">
                                       '.$title.'
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>
                                      <table style="width: 100%;padding: 15px;color: gray">
                                          <tbody>
                                          <tr>
                                             <td style="text-align: left; font-size: 15px;">
                                               Biller:<br>
                                                '.$data[0]->biller_company_name.'<br>
                                                Service -'.$data[0]->biller_category_name.'<br>
                                              
                                                Email:- '.$data[0]->biller_email .'<br>
                                                Phone:- '.$data[0]->biller_contact_no  .'<br>
                                                  Consumer No:- '.$data[0]->biller_customer_id_no.'<br>
                                             </td>
                                             <td style="text-align: right;">
                                                <img src="'.company_logo."/".$data[0]->biller_company_logo.'" style="padding:10px;" width="120px" class="">
                                             </td>
                                          </tr>

                                          <tr style="border-top: 2px solid #bbb;">
                                             <td style="text-align: left;width: 50%;padding: 20px 0px">
                                                Bill To,<br>
                                                 '.$data[0]->biller_user_name.'<br>
                                                  Email:- '.$data[0]->biller_user_email  .'<br>
                                                  Phone:- '.$data[0]->biller_user_contact_no  .'<br>
                                             </td>
                                             <td style="text-align: right;padding: 20px 0px;text-align: right;padding: 20px 0px;font-size: 12px">
                                                <strong>Date:-'.$invoice_date.'</strong><br>
                                                Invoice No:- '.$data[0]->bill_invoice_no.'<br>
                                                Transaction  No:- '.$data[0]->bill_transaction_id.'<br>
                                             </td>
                                          </tr>
                                       </tbody>
                                       </table>
                                       <table border="1px solid" style="border:1px solid #ccc;width: 98%; border-collapse: collapse;margin: auto;border-color: #ccc;">
                                            <tr style="text-align: left;font-weight: 300;min-height: 100px;border:1px solid #ccc; ">
                                             <td style="width: 70%; padding: 5px;border-color: #ccc; border:1px solid #ccc;color:#CCC;font-weight:300 ">
                                                Product Name
                                             </td>
                                             <td style="width: 70%; padding: 5px;border-color: #ccc; border:1px solid #ccc;color:#CCC;font-weight:300 ">
                                                Price per Unit
                                             </td>
                                             <td style="width: 30%;padding: 5px;border-color: #ccc;text-align: right;border:1px solid #ccc;COLOR:#CCC">
                                                Product Qty
                                             </td>
                                               <td style="width: 30%;padding: 5px;border-color: #ccc;text-align: right;border:1px solid #ccc;COLOR:#CCC">
                                               Total Price 
                                             </td>
                                          </tr>';
    if(!empty($data[0]->bill_product_id))
    {
        for($i=0;$i<count($data[0]->bill_product_id); $i++)
        {
      
      $where12=array('biller_invoice_no'=>$data[0]->bill_invoice_no,'find_in_set(biller_invoice_product_id, "'.$data[0]->bill_product_id.'") '=>NULL);
      
      $biller_product = $this->login_model->get_data_where_condition('biller_invoice_products', $where12);
      $total=0;
      foreach ($biller_product as  $value) {
      $total+=($value->biller_invoice_product_price*$value->biller_invoice_product_qty);
    
                             $html .= '<tr style="text-align: left;font-weight: 300;color: #bbb!important;min-height: 100px; ">
                                             <td style="width: 70%;padding: 5px; border-color: #ccc;color:#bbb;border:1px solid;font-size:14px  ">
                                                <p>'.$value->biller_invoice_product_name.'.<p>

                                             </td>
                                             <td style="width: 30%;padding: 5px; border-color: #ccc;text-align: right;color:#bbb;border:1px solid;   ">
                                               
<p>'.$value->biller_invoice_product_price.'/-<p>
                                             </td>
                                               <td style="width: 30%;padding: 5px; border-color: #ccc;text-align: right;color:#bbb;border:1px solid;   ">
                                               
<p>'.$value->biller_invoice_product_qty.'<p>
                                             </td>
                                              <td style="width: 30%;padding: 5px; border-color: #ccc;text-align: right;color:#bbb;border:1px solid;   ">
                                               
<p>'.$value->biller_invoice_product_price*$value->biller_invoice_product_qty.'/-<p>
                                             </td>
                                          </tr>';
    }
                                           
          }                                    
}else{
   $total=$data[0]->bill_amount;
}
                                        $html .='<tr style="text-align: left;font-weight: 300;color: #bbb;min-height: 100px; ">
                                             <td style="width: 50%;padding: 5px; border-color: #ccc;color:#333;  ">
                                               <strong> Total<strong>
                                             </td>
                                             <td></td>
                                             <td></td>
                                             <td style="width: 50%;padding: 5px; border-color: #ccc;text-align: right;color:#333;   ">
                                               <strong>  '.$total.'<img  style="position:relative;top:8px;left:2px;" width="13px" src="http://image.flaticon.com/icons/svg/32/32974.svg"/></strong>
                                               
                                             </td>
                                          </tr>
                                         
                                         
                                       </table>
                                       <table border="1px solid" style="border:1px solid #ccc;width: 98%; border-collapse: collapse;margin: auto;border-color: #ccc;">
                                        <tr>
                                          <td>
                                              <p>Description: '.$data[0]->bill_description.'</p>
                                         </td></tr> 
                                       </table>
                                       <table style="width: 100%;background-color: #eee;margin-top: 20px;">
                                           <tr style="text-align: left;font-weight: 300;color: #bbb;min-height: 100px; ">
                                             <td style="width: 50%;padding: 10px; border-color: #ccc; color: #57A9A0 ">
                                                Bill Consumer No.: '.$data[0]->biller_customer_id_no.' <br>
                                                via OyaCharge
                                             </td>
                                             <td style="width: 50%;padding: 10px; border-color: #ccc;text-align: right;color: #57A9A0   ">
                                               OyaCharge<br>
                                              '.$data[0]->biller_company_name.'<br>
                                               ('.$data[0]->biller_name.')
                                             </td>
                                          </tr>
                                       </table>
                                    </td>
                                 </tr>
                                 <tr>
                                 
                                    <td style="background-color:#eee;padding:30px 15px 15px 10px">
                                       <table align="center" style="border-spacing:0;border-collapse:collapse">
                                          <tbody>
                                            
                                             <tr>
                                                <td style="padding:10px">
                                                   
                                                </td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </td>
                                 </tr>
                                  
                                 <tr>
                                    <td style="background-color:#1E1E1E;font-size:12px;color:#fff;text-align:center;padding:10px">
                                       <br>
                                       Address: 8B, Lalupon close, Ikoyi Lagos
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </td>
                     <td>
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
   </body>
</html>';
$mpdf = new mPDF();
$mpdf->WriteHTML($html);
//$mpdf->Output();die;
$mpdf->Output('uploads/bill_invoice/'.$data[0]->bill_invoice_no.'.pdf','F');
$bill='././uploads/bill_invoice/'.$data[0]->bill_invoice_no.'.pdf';
return $bill;
}
function create_new_pdf($invoice_no)
{
   $where=array('bill_invoice_no'=>$invoice_no);
      $data= $this->login_model->get_join_three_table_where('biller_details','biller_user','biller_category','biller_id','biller_id','biller_category_id','biller_category_id',$where);
     if($data[0]->bill_pay_status==2)
     {
      $invoice_date=$data[0]->bill_invoice_date;
     }else{
       $invoice_date=date("Y-m-d");
     }
      
      $title='Bill Invoice'; 


     // $mpdf = new mPDF();
      $mpdf = new mPDF('utf-8', 'A4', 0, '', -5, -5, -5, -5, 0, 0);

 if($data[0]->bill_pay_status==2)
  { 
    $date_type=  "Due";  }
    else 
    if($data[0]->bill_pay_status==1){ $date_type= "Paid";  
  }else 
    if($data[0]->bill_pay_status==3){ $date_type= "Cancelled";  
  }
  if($data[0]->bill_pay_status==2){ $invoicetype= "Draft";  }else if($data[0]->bill_pay_status==1){ $invoicetype=  "Paid";  }else if($data[0]->bill_pay_status==3){ $invoicetype=  "Cancelled";  }
   $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title> </title>
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 
</head>

<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" bgcolor="" style="background-color: #eee;font-family: sans-serif!important;">
  <table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
  
    <tr>

      <td align="center" valign="top" width="100%" class="background">
        <center>
          <table cellpadding="0" cellspacing="0" width="750px" style="box-shadow: 0 1px 4px 0 rgba(0, 0, 0, 0.14);margin-top: 10px;background-color: #fff;padding: 40px">

            <tr style="width: 100%">
              <td valign="top" class="wrap-cell" style="width: 40%;text-align: left;">
              
                <span style="background-color: #43a047;display: block;padding: 20px 0;
    border: 1px dotted #ddd;"><img  style="padding: 10px;width: 100px" src="'.company_logo."/".$data[0]->biller_company_logo.'"> 
              </td>
              <td style="width: 10%"></td>
              <td style="width: 50%;padding-left: 20px;text-align:left;">
                <h5 style="color: #43a047;display: block; padding: 5px 0;font-size: 14px;text-align:left;">'.$data[0]->biller_company_name.'</h5></br>
                <h6 style="color: #333;display: block;padding: 5px 0;font-size: 14px;font-weight:normal;">Name: '.$data[0]->biller_name .'</h6>
                <h6 style="font-weight:normal;color: #333;display: block;padding: 5px 0;font-size: 14px;"><i class="fa fa-phone" aria-hidden="true"></i> Mob.:  '.$data[0]->biller_contact_no  .'</h6>
                <h6 style="font-weight:normal;color: #333;display: block;padding: 5px 0;font-size: 14px;">Email:  '.$data[0]->biller_email .'</h6>
              </td>
            </tr>
             <tr><td colspan="3">&nbsp;</td></tr>
            <tr style="width: 100%;padding: 10px 0;">
              <td style="width: 45%;padding:20px 0;text-align:left;">
                <span style="color: #000;display: block;font-weight: bold;padding-bottom:10px;">Consumer</span>
                <h5 style="font-weight:normal;color: #333;display: block;padding: 3px 0;font-size: 14px;">Customer: #'.$data[0]->biller_customer_id_no.'</h5>
                <h6 style="font-weight:normal;color: #333;display: block;padding: 3px 0;font-size: 14px;">Name: '.$data[0]->biller_user_name.'</h6>
                <h6 style="font-weight:normal;color: #333;display: block;padding: 3px 0;font-size: 14px;">Mob.:  '.$data[0]->biller_user_contact_no.'</h6>
                <h6 style="font-weight:normal;color: #333;display: block;padding: 3px 0;font-size: 14px;">Email: '.$data[0]->biller_user_email.'</h6>
              </td>
              <td style="width: 10%;padding:20px 0;"></td>
              <td valign="top"  style="width: 50%;padding:10px 0;padding-top:20px; background-color: #2b2b2b;">
                <span style="display: table;background-color: #2b2b2b;padding:5px 0;">
                  <span style="color:#fff;display: block;text-align: center;padding:5px;font-size: 21px;">Invoice : #'.$data[0]->bill_invoice_no.'</span>
                <table style="width: 100%">
                  <tr style="text-align: center;">
                    <td style="width:35%;font-weight: bold;color: #fff;font-size: 12px;padding-top:10px;">Invoice Date</td>
                    <td style="width:30%;font-weight: bold;color: #fff;font-size: 12px;">'.$date_type.' Date</td>
                    <td style="width:25%;font-weight: bold;color: #fff;font-size: 12px;">Status</td>
                  </tr>
                   <tr style="text-align: center;">
                    <td style="width:30%;font-weight: lighter;color: #fff;font-size: 12px;padding: 5px 0">'.$data[0]->bill_invoice_date.'</td>
                    <td style="width:35%;font-weight: lighter;color: #fff;font-size: 12px;">'.$invoice_date.'</td>
                    <td style="width:25%;font-weight: lighter;color: #fff;font-size: 12px;">'.$invoicetype.'</td>
                  </tr>
                </table>
                </span>
              </td>
            </tr>
             <tr><td colspan="3">&nbsp;</td></tr>
             <tr><td colspan="3">&nbsp;</td></tr>
             <tr><td colspan="3">&nbsp;</td></tr>
            <tr>
              <td colspan="3" >
                <span style="background-color: #2b2b2b;padding: 5px;display: block;">
                <table style="width:100%">
                
                  <tr style="text-align: center;background-color: #2b2b2b;" cellpadding="0">
                    <td style="padding:5px;background-color: #2b2b2b;width:5%;font-weight: bold;color: #fff;font-size: 12px;">ID</td>
                    <td style="background-color: #2b2b2b;width:10%;font-weight: bold;color: #fff;font-size: 12px;">Item</td>
                   <td style="background-color: #2b2b2b;width:15%;font-weight: bold;color: #fff;font-size: 12px;">Quantity</td>
                    <td style="background-color: #2b2b2b;width:25%;font-weight: bold;color: #fff;font-size: 12px;">Unit Price</td>
                    <td style="background-color: #2b2b2b;width:25%;font-weight: bold;color: #fff;font-size: 12px;">Total</td>
                  </tr>   
                
                </table></span>
                <table style="width:100%">';
                          if(!empty($data[0]->bill_product_id))
    {
        for($i=0;$i<count($data[0]->bill_product_id); $i++)
        {
      
      $where12=array('biller_invoice_no'=>$data[0]->bill_invoice_no,'find_in_set(biller_invoice_product_id, "'.$data[0]->bill_product_id.'") '=>NULL);
      
      $biller_product = $this->login_model->get_data_where_condition('biller_invoice_products', $where12);
      $total=0;
      foreach ($biller_product as  $value) {
      $total+=($value->biller_invoice_product_price*$value->biller_invoice_product_qty);
      $subtotal = $value->biller_invoice_product_price*$value->biller_invoice_product_qty;
               $html .='
                  <tr style="text-align: center;border-bottom: 1px solid #eee;">
                    <td style="width:5%;font-weight: lighter;color: #000;font-size: 12px;padding:10px 0;border-bottom: 1px solid #eee;">1</td>
                    <td style="width:10%;font-weight: lighter;color: #000;font-size: 12px;border-bottom: 1px solid #eee;">'.$value->biller_invoice_product_name.'</td>
                   
                    <td style="width:15%;font-weight: lighter;color: #000;font-size: 12px;border-bottom: 1px solid #eee;">'.$value->biller_invoice_product_qty.'</td>
                    <td style="width:25%;font-weight: lighter;color: #000;font-size: 12px;border-bottom: 1px solid #eee;">&#8358;'.$value->biller_invoice_product_price.'</td>
                    <td style="width:25%;font-weight: lighter;color: #000;font-size: 12px;border-bottom: 1px solid #eee;"> &#8358; '.$subtotal.'</td>
                  </tr>';
             }
                                           
          }                                    
}else{
   $total=$data[0]->bill_amount;
}

                $html .='</table>
                <table style="width: 100%;">
 <tr><td colspan="2">&nbsp;</td></tr>
                  <tr style="width:100%;">
                    <td style="width: 50%;"></td>
                    <td style="marginwidth: 50%;padding: 10px 0;background-color: #ddd;line-height:20px;">
                      <span style="background-color: #ddd;display: block;padding: 10px;">
                        Total Amount:  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &#8358;'.$total.' 
                      </span>
                    </td>
                  </tr>
                  <tr><td colspan="2">&nbsp;</td></tr>
                  <tr>

                  <td colspan="2"> <p style="font-size:12px;color:gray;">'.$data[0]->bill_description.'</p></td>
                  </tr>
                </table>
              </td>
            </tr>
          
            



          </table>
        </center>
      </td>
    </tr>
  </table>

</body>
</html>';
 $mpdf->SetHTMLHeader($html);
 $mpdf->SetHTMLFooter('
<table cellpadding="0" cellspacing="0" border="0" width="794" align="center">
            <tr>
               <td  style="font-size: 12px;background-color: #43a047;padding: 10px;text-align: center;color: #fff;"> 

     Note:Please,check bill detail before proceeding for the payment, OyaCharge will not be responsible in any kind of discrepancies of biller,bills or amount payment.
           </tr>
           <tr>
             <td style="font-size: 12px;background-color: #343a40;padding: 15px;text-align: center;color: #fff;""> 
           
                  <img src= "https://oyacharge.com/wassets/images/footerby.png" style="padding:8px;" width="170px" class="">
              </td>

           </tr>
           <tr>
            <td style="font-size: 12px;background-color: #343a40;padding: 15px;text-align: center;color: #fff;"">  
            Powered by <img src="http://www.urbaneyouth.com/biller_assets/img/logo_1.png" style="width: 79px;margin-left: 3px;">
              </td> </td> 
           </tr>

         </table>');
 //$mpdf->Output();
if($data[0]->bill_pay_status==3)
{
$mpdf->Output('uploads/bill_cancel_invoice/'.$data[0]->bill_invoice_no.'.pdf','F');
}else{
  $mpdf->Output('uploads/bill_invoice/'.$data[0]->bill_invoice_no.'.pdf','F');
}

//$mpdf->Output('uploads/bill_invoice_101/'.$data[0]->bill_invoice_no.'.pdf','F');
//$bill='././uploads/bill_invoice/'.$data[0]->bill_invoice_no.'.pdf';

$bill= $_SERVER["DOCUMENT_ROOT"].'/uploads/bill_invoice/'.$data[0]->bill_invoice_no.'.pdf';

return $bill;
}

function create_new_pdf_paid($invoice_no)
{
   $where=array('bill_invoice_no'=>$invoice_no);
      $data= $this->login_model->get_join_three_table_where('biller_details','biller_user','biller_category','biller_id','biller_id','biller_category_id','biller_category_id',$where);
      $invoice_date=$data[0]->bill_invoice_date;
      $title='Bill Invoice'; 


     // $mpdf = new mPDF();
      $mpdf2 = new mPDF('utf-8', 'A4', 0, '', -5, -5, -5, -5, 0, 0);

      if($data[0]->bill_pay_status==2){ 
    $date_type=  "Due";  }else 
    if($data[0]->bill_pay_status==1){ $date_type= "Paid";  
  }
  if($data[0]->bill_pay_status==2){ $invoicetype= "Draft";  }else if($data[0]->bill_pay_status==1){ $invoicetype=  "Paid";  }
   $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title> </title>
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 
</head>

<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" bgcolor="" style="background-color: #eee;font-family: sans-serif!important;">
  <table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
  
    <tr>

      <td align="center" valign="top" width="100%" class="background">
        <center>
          <table cellpadding="0" cellspacing="0" width="750px" style="box-shadow: 0 1px 4px 0 rgba(0, 0, 0, 0.14);margin-top: 10px;background-color: #fff;padding: 40px">

            <tr style="width: 100%">
              <td valign="top" class="wrap-cell" style="width: 40%;text-align: left;">
              
                <span style="background-color: #43a047;display: block;padding: 20px 0;
    border: 1px dotted #ddd;"><img  style="padding: 10px;width: 100px" src="'.company_logo."/".$data[0]->biller_company_logo.'"> 
              </td>
              <td style="width: 10%"></td>
              <td style="width: 50%;padding-left: 20px;text-align:left;">
                <h5 style="color: #43a047;display: block; padding: 5px 0;font-size: 14px;text-align:left;">'.$data[0]->biller_company_name.'</h5></br>
                <h6 style="color: #333;display: block;padding: 5px 0;font-size: 14px;font-weight:normal;">Name: '.$data[0]->biller_name .'</h6>
                <h6 style="font-weight:normal;color: #333;display: block;padding: 5px 0;font-size: 14px;"><i class="fa fa-phone" aria-hidden="true"></i> Mob.:  '.$data[0]->biller_contact_no  .'</h6>
                <h6 style="font-weight:normal;color: #333;display: block;padding: 5px 0;font-size: 14px;">Email:  '.$data[0]->biller_email .'</h6>
              </td>
            </tr>
             <tr><td colspan="3">&nbsp;</td></tr>
            <tr style="width: 100%;padding: 10px 0;">
              <td style="width: 45%;padding:20px 0;text-align:left;">
                <span style="color: #000;display: block;font-weight: bold;padding-bottom:10px;">Consumer</span>
                <h5 style="font-weight:normal;color: #333;display: block;padding: 3px 0;font-size: 14px;">Customer: #'.$data[0]->biller_customer_id_no.'</h5>
                <h6 style="font-weight:normal;color: #333;display: block;padding: 3px 0;font-size: 14px;">Name: '.$data[0]->biller_user_name.'</h6>
                <h6 style="font-weight:normal;color: #333;display: block;padding: 3px 0;font-size: 14px;">Mob.:  '.$data[0]->biller_user_contact_no.'</h6>
                <h6 style="font-weight:normal;color: #333;display: block;padding: 3px 0;font-size: 14px;">Email: '.$data[0]->biller_user_email.'</h6>
              </td>
              <td style="width: 10%;padding:20px 0;"></td>
              <td valign="top"  style="width: 50%;padding:10px 0;padding-top:20px; background-color: #2b2b2b;">
                <span style="display: table;background-color: #2b2b2b;padding:5px 0;">
                  <span style="color:#fff;display: block;text-align: center;padding:5px;font-size: 21px;">Invoice : #'.$data[0]->bill_invoice_no.'</span>
                <table style="width: 100%">
                  <tr style="text-align: center;">
                    <td style="width:35%;font-weight: bold;color: #fff;font-size: 12px;padding-top:10px;">Invoice Date</td>
                    <td style="width:30%;font-weight: bold;color: #fff;font-size: 12px;">'.$date_type.' Date</td>
                    <td style="width:25%;font-weight: bold;color: #fff;font-size: 12px;">Status</td>
                  </tr>
                   <tr style="text-align: center;">
                    <td style="width:30%;font-weight: lighter;color: #fff;font-size: 12px;padding: 5px 0">'.$data[0]->bill_invoice_date.'</td>
                    <td style="width:35%;font-weight: lighter;color: #fff;font-size: 12px;">'.$data[0]->bill_due_date.'</td>
                    <td style="width:25%;font-weight: lighter;color: #fff;font-size: 12px;">'.$invoicetype.'</td>
                  </tr>
                </table>
                </span>
              </td>
            </tr>
             <tr><td colspan="3">&nbsp;</td></tr>
             <tr><td colspan="3">&nbsp;</td></tr>
             <tr><td colspan="3">&nbsp;</td></tr>
            <tr>
              <td colspan="3" >
                <span style="background-color: #2b2b2b;padding: 5px;display: block;">
                <table style="width:100%">
                
                  <tr style="text-align: center;background-color: #2b2b2b;" cellpadding="0">
                    <td style="padding:5px;background-color: #2b2b2b;width:5%;font-weight: bold;color: #fff;font-size: 12px;">ID</td>
                    <td style="background-color: #2b2b2b;width:10%;font-weight: bold;color: #fff;font-size: 12px;">Item</td>
                   <td style="background-color: #2b2b2b;width:15%;font-weight: bold;color: #fff;font-size: 12px;">Quantity</td>
                    <td style="background-color: #2b2b2b;width:25%;font-weight: bold;color: #fff;font-size: 12px;">Unit Price</td>
                    <td style="background-color: #2b2b2b;width:25%;font-weight: bold;color: #fff;font-size: 12px;">Total</td>
                  </tr>   
                
                </table></span>
                <table style="width:100%">';
                          if(!empty($data[0]->bill_product_id))
    {
        for($i=0;$i<count($data[0]->bill_product_id); $i++)
        {
      
      $where12=array('biller_invoice_no'=>$data[0]->bill_invoice_no,'find_in_set(biller_invoice_product_id, "'.$data[0]->bill_product_id.'") '=>NULL);
      
      $biller_product = $this->login_model->get_data_where_condition('biller_invoice_products', $where12);
      $total=0;
      foreach ($biller_product as  $value) {
      $total+=($value->biller_invoice_product_price*$value->biller_invoice_product_qty);
      $subtotal = $value->biller_invoice_product_price*$value->biller_invoice_product_qty;
               $html .='
                  <tr style="text-align: center;border-bottom: 1px solid #eee;">
                    <td style="width:5%;font-weight: lighter;color: #000;font-size: 12px;padding:10px 0;border-bottom: 1px solid #eee;">1</td>
                    <td style="width:10%;font-weight: lighter;color: #000;font-size: 12px;border-bottom: 1px solid #eee;">'.$value->biller_invoice_product_name.'</td>
                   
                    <td style="width:15%;font-weight: lighter;color: #000;font-size: 12px;border-bottom: 1px solid #eee;">'.$value->biller_invoice_product_qty.'</td>
                    <td style="width:25%;font-weight: lighter;color: #000;font-size: 12px;border-bottom: 1px solid #eee;">&#8358;'.$value->biller_invoice_product_price.'</td>
                    <td style="width:25%;font-weight: lighter;color: #000;font-size: 12px;border-bottom: 1px solid #eee;"> &#8358; '.$subtotal.'</td>
                  </tr>';
             }
                                           
          }                                    
}else{
   $total=$data[0]->bill_amount;
}

                $html .='</table>
                <table style="width: 100%;">
 <tr><td colspan="2">&nbsp;</td></tr>
                  <tr style="width:100%;">
                    <td style="width: 50%;"></td>
                    <td style="marginwidth: 50%;padding: 10px 0;background-color: #ddd;line-height:20px;">
                      <span style="background-color: #ddd;display: block;padding: 10px;">
                        Total Amount:  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &#8358;'.$total.' 
                      </span>
                    </td>
                  </tr>
                  <tr><td colspan="2">&nbsp;</td></tr>
                  <tr>

                  <td colspan="2"> <p style="font-size:12px;color:gray;">'.$data[0]->bill_description.'</p></td>
                  </tr>
                </table>
              </td>
            </tr>
          
            



          </table>
        </center>
      </td>
    </tr>
  </table>

</body>
</html>';
 $mpdf->SetHTMLHeader($html);
 $mpdf->SetHTMLFooter('
<table cellpadding="0" cellspacing="0" border="0" width="794" align="center">
            <tr>
               <td  style="font-size: 12px;background-color: #43a047;padding: 10px;text-align: center;color: #fff;"> 

     Note:Please,check bill detail before proceeding for the payment, OyaCharge will not be responsible in any kind of discrepancies of biller,bills or amount payment.
           </tr>
           <tr>
             <td style="font-size: 12px;background-color: #343a40;padding: 15px;text-align: center;color: #fff;""> 
           
                  <img src= "https://oyacharge.com/wassets/images/footerby.png" style="padding:8px;" width="170px" class="">
              </td>

           </tr>
           <tr>
            <td style="font-size: 12px;background-color: #343a40;padding: 15px;text-align: center;color: #fff;"">  
               Powered by <img src="http://www.urbaneyouth.com/biller_assets/img/logo_1.png" style="width: 79px;margin-left: 3px;">
              </td> </td> 
           </tr>

         </table>');
$mpdf2->Output('uploads/bill_invoice_101/'.$data[0]->bill_invoice_no.'.pdf','F');
//$bill='././uploads/bill_invoice_101/'.$data[0]->bill_invoice_no.'.pdf';
//return $bill;
}

function add_biller_user(){
 	  
	 if (!empty($_REQUEST['biller_customer_id_no'])) {
	 	 $_REQUEST['biller_customer_id_no'];
      $data = $this->input->post();	
      $billProductId=$data['bill_product_id']; 
			if(!empty($data['bill_product_id']))
			{
    		for($i=0;$i<count($data['bill_product_id']); $i++)
    		{
           $where12=array('find_in_set(product_id, "'.$data['bill_product_id'][$i].'") '=>NULL);
    			 $biller_product = $this->login_model->get_data_where_condition('biller_produt', $where12); 
    			 $name[]=$biller_product[0]->product_name;
           $price[]=$biller_product[0]->product_price;
    		}		  
			 $data['bill_product_name']=implode(",",$name);
			 $data['bill_product_id']=implode(",",$data['bill_product_id']);
			}
			$productQTY=$data['product_qt'];
			$bill_desc=$data['bill_description']; 
		  $invoice_no=$data['bill_invoice_no'];
          unset($data['submit']);
			$ch = array("bill_invoice_no" => strtoupper($this->input->post("bill_invoice_no")), 'biller_id ='=>$this->session->userdata('biller_id'));
      $rec = $this->login_model->get_data_where_condition('biller_user', $ch);
			if (empty($rec)) 
      {
         $data['biller_id']=$this->session->userdata('biller_id');
				 $bill_desc= strlen($bill_desc);
				  // if($bill_desc<=200)
      //     {
					  unset($data['btnSubmit']);
			     $timestamp = strtotime($data['bill_due_date']);
    			 $data['bill_due_date']=	 date("Y-m-d", $timestamp);
    			 $data['bill_invoice_date']=date("Y-m-d");
           $data['bill_invoice']=$invoice_no.'.pdf';
            unset($data['product_qt']);
            unset($data['finish']);

    			 $idbillUser=$this->login_model->insert_data('biller_user', $data);
          if(!empty($billProductId))
          {
            $curDate=date("Y-m-d H:i:s");
            for($k=0;$k<count($billProductId); $k++)
            {
             $data123['biller_invoice_no']=$this->input->post("bill_invoice_no");
             $data123['biller_invoice_id']=$idbillUser;
             $data123['biller_invoice_product_id']=$billProductId[$k];
             $data123['biller_invoice_product_name']=$name[$k];
             $data123['biller_invoice_product_qty']=$productQTY[$k];
             $data123['biller_invoice_datetime']=$curDate;
             $data123['biller_invoice_product_price']=$price[$k];
             $idbillUser=$this->login_model->insert_data('biller_invoice_products', $data123);
            }     
        }
    			$consumer_no=$this->input->post("biller_customer_id_no");
    			$where=array('biller_customer_id_no'=>$this->input->post("biller_customer_id_no"));
    			$data= $this->login_model->get_join_three_table_where('biller_details','biller_user','biller_category','biller_id','biller_id','biller_category_id','biller_category_id',$where);
    			$data['image']=company_logo; 
    			$amt=$this->input->post("bill_amount");
    			$biller_user_contact_no=$this->input->post("biller_user_contact_no");
         
           sleep(1);
           $where=array('bill_invoice_no'=>$invoice_no);
         $data= $this->login_model->get_join_three_table_where('biller_details','biller_user','biller_category','biller_id','biller_id','biller_category_id','biller_category_id',$where);
          $bill=$this->create_new_pdf($this->input->post("bill_invoice_no")); 
          $send_msg=$this->send_bill_user_msg($biller_user_contact_no,$invoice_no,$consumer_no,$amt);
          $biller_name=$data[0]->biller_company_name;
    			$message='Your Invoice INV#'.$invoice_no.' '.'of amount Naira'.' '.$amt.' '.' is generated by.'.' '.$biller_name.',Kindly make a payment via OyaCharge';

    	
          $attach = $this->uploadAttachment($bill, "Invoice.pdf");

         $list = array(''.$this->input->post("biller_user_email").'', ''.$data[0]->biller_email.'','care@oyacharge.com');


        $this->sendElasticEmail($this->input->post("biller_user_email"), 'Bill Invoice of '.$invoice_no,"OyaCharge", $message, "care@oyacharge.com", "OyaCharge",$attach['attachId']);
       
        $this->sendElasticEmail($data[0]->biller_email, 'Bill Invoice of '.$invoice_no,"OyaCharge", $message, "care@oyacharge.com", "OyaCharge",$attach['attachId']);
      
        $this->sendElasticEmail('care@oyacharge.com', 'Bill Invoice of '.$invoice_no,"OyaCharge", $message, "care@oyacharge.com", "OyaCharge",$attach['attachId']);

    			$this->session->set_flashdata('status','Your Invoice INV#'.$invoice_no.' '.'of amount Naira'.' '.$amt.' '.' is generated successfully');

               
			
            //  } else {
            //     $this->session->set_flashdata('error', 'Bill Description between 100 and 300 character');
            // }
          }else {
                $this->session->set_flashdata('error', 'Consumer Number bill already genrated');
            }
			       redirect('biller/consumer_list');
        } else {
        	  $where = array('prodcut_status' => '1','biller_id'=>$this->session->userdata('biller_id'));
            $data['product'] = $this->login_model->get_data_where_condition('biller_produt', $where);
            $data['invoice_no']= substr(strtotime("now").mt_rand(10, 99), 2);
				    $where=array('biller_user.'.'biller_id'=>$this->session->userdata('biller_id'));
		        $data['consumer_details']  = $this->login_model->get_data_where_condition('biller_user', $where);
		        $biller_id=$this->session->userdata('biller_id');
				    $data['biller_details']=$this->biller_required_detils();

            // print_r($data); exit;

    	    $this->load->view('new_biller/header');
            $this->load->view('new_biller/sidebar',$data);
            $this->load->view('new_biller/addinvoice',$data);
 			$this->load->view('new_biller/footer');
        }
}
function cancel_invoice()
{
  $bill_invoice_no = $this->uri->segment(3);
  $where12=array('bill_invoice_no'=>$bill_invoice_no);
  $invoice = $this->login_model->get_data_where_condition('biller_user', $where12); 
  if(!empty($invoice))
  {
    $paid_status = $invoice[0]->bill_pay_status;
    $biller_id = $invoice[0]->biller_id;
    if($paid_status==2)
    {
      $data['bill_pay_status']=3;
      $data['bill_cancel_date'] = date("Y-m-d");
      $this->login_model->update_data('biller_user', $data, $where12);
       $this->session->set_flashdata('status', 'Invoice No.' .$bill_invoice_no.' has been Cancelled Successfully');
         sleep(1);
       $bill= $this->create_new_pdf($bill_invoice_no); 
        $wherebiller=array('biller_id'=>$biller_id);
       $biller = $this->login_model->get_data_where_condition('biller_details', $wherebiller); 
        $biller_name=$biller[0]->biller_company_name;
        $biller_email=$biller[0]->biller_email;
        $amt=$invoice[0]->bill_amoun;
          $message='Your Invoice INV#'.$bill_invoice_no.' '.'of amount Naira'.' '.$amt.' '.' has been cancelled by.'.' '.$biller_name;
           $attach = $this->uploadAttachment($bill, "Invoice.pdf");

           $list = array(''.$invoice[0]->biller_user_emai.'', ''.$biller_email.'','care@oyacharge.com');
          $this->sendElasticEmail($invoice[0]->biller_user_email, 'Bill Invoice of '.$bill_invoice_no,"OyaCharge", $message, "care@oyacharge.com", "OyaCharge",$attach['attachId']);
       
         $this->sendElasticEmail($biller_email, 'Bill Invoice of '.$bill_invoice_no,"OyaCharge", $message, "care@oyacharge.com", "OyaCharge",$attach['attachId']);
      
        $this->sendElasticEmail('care@oyacharge.com', 'Bill Invoice of '.$bill_invoice_no,"OyaCharge", $message, "care@oyacharge.com", "OyaCharge",$attach['attachId']);
    }else{
       $this->session->set_flashdata('error', 'Invoice No.' .$bill_invoice_no.' has been already paid!');
    }
    
  }else{
     $this->session->set_flashdata('error', 'Invoice No.' .$bill_invoice_no.' not exist!');
  }
  redirect('Invoice');
}
// edit bill user 

function get_consumer_details()
{
  if(!empty($_REQUEST['consumer_no']))
  {
    $consumer_no = $_REQUEST['consumer_no'];
    $ch = array("biller_customer_id_no" => strtoupper($consumer_no), 'biller_id ='=>$this->session->userdata('biller_id'));
    $rec = $this->login_model->get_data_where_condition('biller_user', $ch);
    if(!empty($rec))
    {
      $post = array('status'=>1,'biller_user_name'=>$rec[0]->biller_user_name,'biller_user_email'=>$rec[0]->biller_user_email,'biller_user_contact_no'=>$rec[0]->biller_user_contact_no);
      echo json_encode($post);
    }else{
      $post = array('status'=>0);
      echo json_encode($post);
    }

  }else if(!empty($_REQUEST['type']))
  {
    $type= $_REQUEST['type'];
    $value= $_REQUEST['field_value'];
    if($type==1)
    {
      $ch = array("biller_user_email" => $value, 'biller_id ='=>$this->session->userdata('biller_id'));
    }else if($type==2)
    {
      $ch = array("biller_user_contact_no" => $value, 'biller_id ='=>$this->session->userdata('biller_id'));
    }

    $rec = $this->login_model->get_data_where_condition('biller_user', $ch);
    if(!empty($rec))
    {
      $post = array('status'=>1,'biller_user_name'=>$rec[0]->biller_user_name,'biller_user_email'=>$rec[0]->biller_user_email,'biller_user_contact_no'=>$rec[0]->biller_user_contact_no);
      echo json_encode($post);
    }else{
      $post = array('status'=>0);
      echo json_encode($post);
    }
  }
}
function add_consumer()
{
  if(!empty($this->input->post()))
  {
    $data      = $this->input->post();
    unset($data['submit']);
    $data['biller_id']=$this->session->userdata('biller_id');
    $data['invoice_create_status']=2;
    $consumers = $this->login_model->insert_data('biller_user', $data);
    $this->session->set_flashdata('status', 'New Consumer created Successfully!');
    redirect('Consumer');
  }
}
  public function getPrice(){
        $productId = $_POST['productId'];
        if(isset($productId ) && $productId != ''){

            $sql="SELECT * FROM biller_produt WHERE product_id = ".$productId." ";
            $pData = $this->login_model->get_simple_query($sql);

            // print_r($pData); exit;

            if(!empty( $pData )){
               echo json_encode(array('status' => 1, 'msg' => 'Data found!', 'price' =>  $pData[0]->product_price));
            }else{
              echo json_encode(array('status' => 0, 'msg' => 'Data no found!', 'price' => 0));
            }
         
        }else{
          echo json_encode(array('status' => 0, 'msg' => 'Data no found!', 'price' => 0));
        }

    }

    function logout() {
        $this->session->sess_destroy();
        redirect('biller_login');
    }
	
	function upload_consumer_list(){
		 
     $biller_id=$this->session->userdata('biller_id');
		//		$where=array('biller_user.'.'biller_id'=>$biller_id);
	//	$data['biller_details'] = $this->login_model->get_data_where_condition('biller_user', $where);
		
				$where22=array('biller_id'=>$biller_id);
			// $data['biller_details'] = $this->login_model->get_record_join_two_table('biller_details', 'biller_category', 'biller_category_id', 'biller_category_id','*',$where22);
			///$data['biller_details'][0]->category=$biller[0]->category;
            $data['biller_details']=$this->biller_required_detils();
			      $this->load->view('biller/menu',$data);
            $this->load->view('biller/header');
            $this->load->view('biller/add/add_upload_excel');
            $this->load->view('biller/footer');
	}
	
	   	function upload_consumer_excel() {

		$biller_id=$this->session->userdata('biller_id');
			$this -> load -> library('Excel');
			$invalid = '';
			   
			if (isset($_POST) && !empty($_FILES['consumer_excel']['name'])) {
				
				$namearr = explode(".", $_FILES['consumer_excel']['name']);
				
				if (end($namearr) != 'xls' && end($namearr) != 'xlsx') {
					
					// echo '<p> Invalid File </p>';
					$message = "Invalid File.Please Upload xls or xlsx file!";
					$this -> session -> set_flashdata('error', $message);
					redirect('Invoice');
					$invalid = 1;
				}
				
				if ($invalid != 1) {
					$response = move_uploaded_file($_FILES['consumer_excel']['tmp_name'], "./uploads/consumer_excel/" . $_FILES['consumer_excel']['name']);
					// Upload the file to the current folder
					
					if ($response) {
						try {
							
							$objPHPExcel = PHPExcel_IOFactory::load("./uploads/consumer_excel/" . $_FILES['consumer_excel']['name']);
						} catch(Exception $e) {
							
							//die('Error : Unable to load the file : "' . pathinfo($_FILES['region_excel']['name'], PATHINFO_BASENAME) . '": ' . $e -> getMessage());
							$message = 'Error : Unable to load the file : "' . pathinfo($_FILES['plan_excel']['name'], PATHINFO_BASENAME) . '": ' . $e -> getMessage();
						$this -> session -> set_flashdata('error', $message);
							redirect('Invoice');
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
							$B = trim($allDataInSheet[$i]["B"]);
							$C = trim($allDataInSheet[$i]["C"]);
							$D = trim($allDataInSheet[$i]["D"]);
							$E = trim($allDataInSheet[$i]["E"]);
							$F = trim($allDataInSheet[$i]["F"]);
							$G = trim($allDataInSheet[$i]["G"]);
							$H = trim($allDataInSheet[$i]["H"]);
			
							$current_date=date("Y-m-d");
							$invoice_no= substr(strtotime("now").mt_rand(10, 99), 2);
							 
				      $plan_data = array("biller_id"=>$biller_id,"biller_user_name"=>$B,"biller_customer_id_no"=>$C,"bill_amount"=>$D,"bill_invoice_date"=>$current_date,"bill_invoice_no"=>$invoice_no,"bill_due_date"=>$E,"biller_user_email"=>$F,"biller_user_contact_no"=>$G,"bill_description"=>$H);
	            $rec['already'] = '';
	            $where=array("biller_id"=>$biller_id,"bill_invoice_no"=>$invoice_no);
	            $rec['already'] = $this -> login_model -> get_data_where_condition('biller_user', $where);
					
					
							if(empty($rec['already']))
							{
								$this -> login_model -> insert_data('biller_user', $plan_data);
								}
							$this->load->library('PDF');
	       //	$pdf = new PDF();
        // Data loading
     //   $pdf->AddPage();
		  $consumer_no=$C;
			$where=array('bill_invoice_no'=>$invoice_no);
			$data= $this->login_model->get_join_three_table_where('biller_details','biller_user','biller_category','biller_id','biller_id','biller_category_id','biller_category_id',$where);
			 $data['image']=company_logo; 
		//	$pdf->SignUp($data);
			$amt=$D;
        //	$invoice_no= strtotime("now").mt_rand(10000000, 99999999);
      $bill='';
			 $bill=$this->create_new_pdf($invoice_no); 
        	//$pdf->Output('/var/www/html/uploads/invoice'.'/'.$consumer_no.'.pdf','F');
        $data12['bill_invoice']=$invoice_no.'.pdf';
			 $this->login_model->update_data('biller_user', $data12, $where);
			// $bill='././uploads/invoice/'.$consumer_no.'.pdf';
			 $biller_name=$data[0]->biller_company_name;
			 $message='Your Invoice INV#'.$invoice_no.' '.'of amount Naira'.' '.$amt.' '.' is generated by.'.' '.$biller_name.'. Powered by Oyacharge';
        $send_msg=$this->send_bill_user_msg($G,$invoice_no,$C,$D);
			  //$this->sendElasticEmail($F, 'Bill Invoice of '.$invoice_no,"OyaCharge", $message, "care@oyacharge.com", "OyaCharge",$bill);
                        $this->load->library('email');
                        $this->email->from('care@oyacharge.com', 'OyaCharge');
                        $this->email->to($F); // $cc_admin_email
                        $this->email->subject('Bill Invoice of '.$invoice_no);
                        $this->email->message($message);
						            $this->email->attach($bill);
                        $this->email->send();
                        $this->email->clear(TRUE);
                      
						}

			
					$message = "Excel Upload Successfully!";
						$this -> session -> set_flashdata('success', $message);
							redirect('Invoice');
					} else {
						
						$message = "Error in response!";
						$this -> session -> set_flashdata('error', $message);
						redirect('Invoice');
					}
				}
		}
	}

// function to add product....--
	function product_list(){
		$where=array('biller_id'=>$this->session->userdata('biller_id'));
		$data['product_details'] = $this->login_model->get_data_where_condition('biller_produt', $where,'product_id');
			$where=array('biller_user.'.'biller_id'=>$this->session->userdata('biller_id'));
		$data['biller_details'] = $this->login_model->get_data_where_condition('biller_user', $where);
		$biller_id=$this->session->userdata('biller_id');
				$where22=array('biller_id'=>$biller_id);
			$data['biller_details'] = $this->login_model->get_record_join_two_table('biller_details', 'biller_category', 'biller_category_id', 'biller_category_id','*',$where22);
			//$data['biller_details'][0]->category=$biller[0]->category;
			       
            $this->load->view('new_biller/header');
            $this->load->view('new_biller/sidebar',$data);
            $this->load->view('new_biller/productlist',$data);
            $this->load->view('new_biller/footer');
	}
	function compressImage($source_image, $compress_image) 
	{
			$image_info = getimagesize($source_image);
			if ($image_info['mime'] == 'image/jpeg') {
			$source_image = imagecreatefromjpeg($source_image);
			imagejpeg($source_image, $compress_image, 75);
			} elseif ($image_info['mime'] == 'image/gif') {
			$source_image = imagecreatefromgif($source_image);
			imagegif($source_image, $compress_image, 75);
			} elseif ($image_info['mime'] == 'image/png') {
			$source_image = imagecreatefrompng($source_image);
			imagepng($source_image, $compress_image, 6);
			}
			
		return $compress_image;
	}
	function make_thumb($src, $dest, $desired_width) 
{

	$source_image = imagecreatefromjpeg($src);
	$width = imagesx($source_image);
	$height = imagesy($source_image);
	$desired_height = floor($height * ($desired_width / $width));
	$virtual_image = imagecreatetruecolor($desired_width, $desired_height);
	imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
	imagejpeg($virtual_image, $dest);
}
	// function add product----->>
	function add_product(){
		if($this->input->post('submit')){
			 $data = $this->input->post();
            unset($data['submit']);
            unset($data['product_id']);
			
          $user_image1 = '';
          if ($_FILES['product_pic']['name']) {
                $user_image1 = $_FILES['product_pic']['name'];
          
                $file_extension1 = explode(".", $_FILES["product_pic"]["name"]);
                $new_extension1 = strtolower(end($file_extension1));
                $today1 = time();
                $custom_name1 = "product_pic" . $today1;
                $file_name1 = $custom_name1 . "." . $new_extension1;

                if ($new_extension1 == 'png' || $new_extension1 == 'jpeg' || $new_extension1 == 'jpg' || $new_extension1 == 'bmp') {
                   move_uploaded_file($_FILES['product_pic']['tmp_name'], "./uploads/biller_products/" . $file_name1);
                    $imagename1 = $file_name1;
                    $source_image = "uploads/biller_products/".$file_name1;
			 		$this->make_thumb($source_image,$source_image,'400');
                } else {
                    $this->session->set_flashdata('error', 'Invalid Image type');
                    redirect('biller/product_list');
                }
                $data['product_pic']=$imagename1;
            }
			$data['product_created_date']=date("Y-m-d");
           		$data['biller_id']=$this->session->userdata('biller_id');
                $this->login_model->insert_data('biller_produt', $data);
                $this->session->set_flashdata('status', 'Product added successfully');
            
            redirect('biller/product_list');
		}else{
			//$where=array('biller_user.'.'biller_id'=>$this->session->userdata('biller_id'));
		//$data['biller_details'] = $this->login_model->get_data_where_condition('biller_user', $where);
		$biller_id=$this->session->userdata('biller_id');
				$where22=array('biller_id'=>$biller_id);
			$data['biller_details'] = $this->login_model->get_record_join_two_table('biller_details', 'biller_category', 'biller_category_id', 'biller_category_id','*',$where22);
			//$data['biller_details'][0]->category=$biller[0]->category;
			     $this->load->view('biller/menu',$data);
            $this->load->view('biller/header');
            $this->load->view('biller/add/add_product');
            $this->load->view('biller/footer');
		}
	}
	function edit_product(){
		if ($this->input->post('submit')) {
            $data = $this->input->post(); 
            $where = array('product_id' => $this->input->post('product_id'));
            unset($data['product_id']);
            unset($data['submit']);
            $user_image1 = '';
          if ($_FILES['product_pic']['name']) {
                $user_image1 = $_FILES['product_pic']['name'];
          
                $file_extension1 = explode(".", $_FILES["product_pic"]["name"]);
                $new_extension1 = strtolower(end($file_extension1));
                $today1 = time();
                $custom_name1 = "product_pic" . $today1;
                $file_name1 = $custom_name1 . "." . $new_extension1;

                if ($new_extension1 == 'png' || $new_extension1 == 'jpeg' || $new_extension1 == 'jpg' || $new_extension1 == 'bmp') {
                   move_uploaded_file($_FILES['product_pic']['tmp_name'], "./uploads/biller_products/" . $file_name1);
                    $imagename1 = $file_name1;
                    $source_image = "uploads/biller_products/".$file_name1;
			 		$this->make_thumb($source_image,$source_image,'400');
                } else {
                    $this->session->set_flashdata('error', 'Invalid Image type');
                    redirect('biller/product_list');
                }
                $data['product_pic']=$imagename1;
            }
            $product_id = $this->input->post('product_id');
           $where=array('product_id'=>$product_id);             
                $this->login_model->update_data('biller_produt', $data, $where);
                $this->session->set_flashdata('status', 'Product Update successfully');
            

            redirect('biller/product_list');
        } else {
            $category_id = $this->uri->segment(3);
            if (!empty($category_id)) {

                $where = array('product_id' => $category_id);
                $data['product_details'] = $this->login_model->get_data_where_condition('biller_produt', $where);
				$where=array('biller_user.'.'biller_id'=>$this->session->userdata('biller_id'));
		$data['biller_details'] = $this->login_model->get_data_where_condition('biller_user', $where);
		$biller_id=$this->session->userdata('biller_id');
				$where22=array('biller_id'=>$biller_id);
			$biller = $this->login_model->get_record_join_two_table('biller_details', 'biller_category', 'biller_category_id', 'biller_category_id','*',$where22);
			$data['biller_details'][0]->category=$biller[0]->category;
                $this->load->view('biller/menu',$data);
            $this->load->view('biller/header');
            $this->load->view('biller/add/add_product',$data);
            $this->load->view('biller/footer');
            } else {
                redirect('biller/product_list');
            }
        }
	}

	function upload_product_list(){
		$where=array('biller_user.'.'biller_id'=>$this->session->userdata('biller_id'));
		$data['biller_details'] = $this->login_model->get_data_where_condition('biller_user', $where);
		$biller_id=$this->session->userdata('biller_id');
				$where22=array('biller_id'=>$biller_id);
			$biller = $this->login_model->get_record_join_two_table('biller_details', 'biller_category', 'biller_category_id', 'biller_category_id','*',$where22);
			$data['biller_details'][0]->category=$biller[0]->category;
			$this->load->view('biller/menu',$data);
            $this->load->view('biller/header');
            $this->load->view('biller/add/add_product_excel');
            $this->load->view('biller/footer');
	}
   ///------------upload product excel------------////
   function upload_product_excel() {
		$biller_id=$this->session->userdata('biller_id');
			$this -> load -> library('Excel');
			$invalid = '';
			
			if (isset($_POST) && !empty($_FILES['product_excel']['name'])) {
				
				$namearr = explode(".", $_FILES['product_excel']['name']);
				
				if (end($namearr) != 'xls' && end($namearr) != 'xlsx') {
					
					// echo '<p> Invalid File </p>';
					$message = "Invalid File.Please Upload xls or xlsx file!";
					$this -> session -> set_flashdata('error', $message);
					redirect('biller/upload_product_list');
					$invalid = 1;
				}
				
				if ($invalid != 1) {
					$response = move_uploaded_file($_FILES['product_excel']['tmp_name'], "./uploads/product_excel/" . $_FILES['product_excel']['name']);
					// Upload the file to the current folder
					
					if ($response) {
						try {
							
							$objPHPExcel = PHPExcel_IOFactory::load("./uploads/product_excel/" . $_FILES['product_excel']['name']);
						} catch(Exception $e) {
							
							//die('Error : Unable to load the file : "' . pathinfo($_FILES['region_excel']['name'], PATHINFO_BASENAME) . '": ' . $e -> getMessage());
							$message = 'Error : Unable to load the file : "' . pathinfo($_FILES['plan_excel']['name'], PATHINFO_BASENAME) . '": ' . $e -> getMessage();
						$this -> session -> set_flashdata('error', $message);
							redirect('biller/upload_product_list');
						}

						$allDataInSheet = $objPHPExcel -> getActiveSheet() -> toArray(null, true, true, true);
					//	print_r($allDataInSheet ); die;						
						$arrayCount = count($allDataInSheet);
						$upload_count = 0;
						$not_upload_count = 0;
						$error_vin = array();
						for ($i = 2; $i <= $arrayCount; $i++)
						 {
							$productname = trim($allDataInSheet[$i]["A"]);
							$productcode=trim($allDataInSheet[$i]["B"]);
							$productcost = trim($allDataInSheet[$i]["C"]);
							$productdesc = trim($allDataInSheet[$i]["D"]);
							$productbarcode = trim($allDataInSheet[$i]["E"]);
							$current_date=date("Y-m-d");
							$product_code=substr($A, 0, 5).strtotime("now").mt_rand(100000, 999999);
							 
						   $plan_data = array("biller_id"=>$biller_id,"product_name"=>$productname,"product_code"=>$productcode,"product_price"=>$productcost,"product_desc"=>$productdesc,"product_barcode"=>$productbarcode,"product_created_date"=>$current_date);
	
						   $this -> login_model -> insert_data('biller_produt', $plan_data);
						}
						
	       			    $file = $_FILES['product_excel']['name'];
						if (!unlink("./upload/product_excel/" . $file)) {
							// echo("Error deleting $file");
						} else {
							// echo("Deleted $file");
						}
						
						$message = "Excel Upload Successfully!";
						$this -> session -> set_flashdata('success', $message);
							redirect('biller/product_list');
					} else {
						// echo "Error in response";
						$message = "Error in response!";
						$this -> session -> set_flashdata('error', $message);
							redirect('biller/product_list');
					}
				}
		}
	}
	
function change_status() 
 {
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

        if ($table == "biller_produt" && $function == "product_list") {
            if ($field_value != 1) {
                $message = 'SUCCESS! Product Status Change to InActive. ';
            } else {
                $message = 'SUCCESS! Product Status Change to Active. ';
            }
            $this->session->set_flashdata('status', $message);
            $path = 'biller/' . $function;
            redirect($path);
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
            if ($delete_type == 'delete_bill_user') {
                $message = 'Invoice Deleted Successfully';
                $this->session->set_flashdata('error', $message);
                redirect('biller/consumer_list');
            }
            if ($delete_type == 'delete_product') {
                $message = 'Product Deleted Successfully!!';
                $this->session->set_flashdata('error', $message);
                redirect('biller/product_list');
            }
			 if ($delete_type == 'delete_oyapad_product') {
                $message = 'Product Deleted Successfully!!';
                $this->session->set_flashdata('error', $message);
                redirect('biller/oyapad_products');
            }
        } else {
            redirect('biller');
        }
    }

	
function biller_required_detils()
{
	$where22=array('biller_id'=>$this->session->userdata('biller_id'));
	$biller_details = $this->login_model->get_record_join_two_table('biller_details', 'biller_category', 'biller_category_id', 'biller_category_id','*',$where22); 
	return $biller_details;
}

 
//=== My sattelment===
function my_bill_sattlement()
{
			$data['biller_details']=$this->biller_required_detils();
			$where = array('biller_id'=>$this->session->userdata('biller_id'));
      $data['my_sattlement'] = $this->login_model->get_data_where_condition('biller_sattlement', $where);
			
			
			$this->load->view('new_biller/header');
      $this->load->view('new_biller/sidebar',$data);
      $this->load->view('new_biller/mysettelment',$data);
      $this->load->view('new_biller/footer');
}


   //** Oyapad Functionlity
  function oyapad_prod_cat() 
  {
         $where = array('p_cat_biller_id'=>$this->session->userdata('biller_id'));
         $data['oyapad_category'] = $this->login_model->get_data_where_condition('oyapad_p_cat', $where,'p_cate_id');
  	      $data['biller_details']=$this->biller_required_detils();
          $this->load->view('new_biller/header');
          $this->load->view('new_biller/sidebar',$data);
          $this->load->view('new_biller/oyapad_product_category');
          $this->load->view('new_biller/footer');
  }
  function add_oyapadcategory()
  {

  if(!empty($this->input->post()))
  {
    $data      = $this->input->post();
    unset($data['submit']);
     $where = array('p_cat_biller_id'=>$this->session->userdata('biller_id'),'p_cat_name'=>$data['p_cat_name']);
    $oyapad_category= $this->login_model->get_data_where_condition('oyapad_p_cat', $where);

      if(empty($oyapad_category))
      {
        $data12['p_cat_name']=strtoupper($data['p_cat_name']);
        $data12['p_cat_biller_id']=$this->session->userdata('biller_id');
        $data12['p_cat_datetime']=date("Y-m-d H:i:s");
        $this->login_model->insert_data('oyapad_p_cat', $data12);
        $this->session->set_flashdata('status', 'Category added Successfully!');
      }else{
        $cat_id = $oyapad_category[0]->p_cate_id;
        $wh = array('p_cate_id'=>$cat_id,'p_cat_biller_id'=>$this->session->userdata('biller_id'));
        $data12['p_cat_name']=strtoupper($this->input->post('p_cat_name'));
        $this->login_model->update_data('oyapad_p_cat', $data12, $wh);
         $this->session->set_flashdata('status', 'Category update Successfully!');
      }
    }

    redirect('biller/oyapad_prod_cat');
  }
 function edit_oyapadcategory()
 {
  if(!empty($this->input->post()))
  {
    $data = $this->input->post();
    $cat_id= $data['p_cate_id'];
    $wh = array('p_cate_id'=>$cat_id,'p_cat_biller_id'=>$this->session->userdata('biller_id'));
    $data12['p_cat_name']=strtoupper($this->input->post('p_cat_name'));
    $this->login_model->update_data('oyapad_p_cat', $data12, $wh);
    $this->session->set_flashdata('status', 'Category update Successfully!');
    redirect('biller/oyapad_prod_cat');
  }
 }

  function oyapad_products() 
  {
      $where = array('oya_biller_id'=>$this->session->userdata('biller_id'));
      $data2['oyapad_products'] = $this->login_model->get_record_join_two_table('oyapad_products','oyapad_p_cat','product_cat_id','p_cate_id','', $where,'oya_product_id');
      $where12 = array('p_cat_biller_id'=>$this->session->userdata('biller_id'));
      $data2['oyapad_category'] = $this->login_model->get_data_where_condition('oyapad_p_cat', $where12,'p_cate_id');
           $data['biller_details']=$this->biller_required_detils();
          $this->load->view('new_biller/header');
          $this->load->view('new_biller/sidebar',$data);
          $this->load->view('new_biller/oyapad_products',$data2);
          $this->load->view('new_biller/footer');
  }
  function get_oyapad_products()
  {
    if(!empty($_POST['cat_ID']))
    {
      $ctID = $_POST['cat_ID'];
     $where = array('oya_biller_id'=>$this->session->userdata('biller_id'),'p_cate_id'=>$ctID);
      $data2['oyapad_products'] = $this->login_model->get_record_join_two_table('oyapad_products','oyapad_p_cat','product_cat_id','p_cate_id','', $where,'oya_product_id');
     // print_r($data2['oyapad_products']);
      $this->load->view('new_biller/filter_oyapad_products',$data2);
    }
    

  }
    function add_oyapad_product(){
    if($this->input->post('submit')){
       $data = $this->input->post();
            unset($data['submit']);
            unset($data['product_id']);
      
          $user_image1 = '';
          if ($_FILES['product_pic']['name']) {
                $user_image1 = $_FILES['product_pic']['name'];
          
                $file_extension1 = explode(".", $_FILES["product_pic"]["name"]);
                $new_extension1 = strtolower(end($file_extension1));
                $today1 = time();
                $custom_name1 = "product_pic" . $today1;
                $file_name1 = $custom_name1 . "." . $new_extension1;

                if ($new_extension1 == 'png' || $new_extension1 == 'jpeg' || $new_extension1 == 'jpg' || $new_extension1 == 'bmp') {
                   move_uploaded_file($_FILES['product_pic']['tmp_name'], "./uploads/oyapad/" . $file_name1);
                    $imagename1 = $file_name1;
                     $source_image = "uploads/oyapad/".$file_name1;
			 		$this->make_thumb($source_image,$source_image,'400');
                } else {
                    $this->session->set_flashdata('error', 'Invalid Image type');
                    redirect('biller/oyapad_products');
                }
                $data['product_image']=$imagename1;
            }
              $data['product_created_date']=date("Y-m-d");
              $data['oya_biller_id']=$this->session->userdata('biller_id');
                $this->login_model->insert_data('oyapad_products', $data);
                $this->session->set_flashdata('status', 'Product added successfully');
            
            redirect('biller/oyapad_products');
    }
  }
  	function edit_oypad_product(){
		if ($this->input->post('submit')) {
            $data = $this->input->post(); 
            $where = array('product_id' => $this->input->post('product_id'));
            unset($data['product_id']);
            unset($data['submit']);
			     $user_image1 = '';
         //  print_r($_FILES);die;
          if ($_FILES['product_pic']['name']) {
                $user_image1 = $_FILES['product_pic']['name'];
          
                $file_extension1 = explode(".", $_FILES["product_pic"]["name"]);
                $new_extension1 = strtolower(end($file_extension1));
                $today1 = time();
                $custom_name1 = "product_pic" . $today1;
                $file_name1 = $custom_name1 . "." . $new_extension1;

                if ($new_extension1 == 'png' || $new_extension1 == 'jpeg' || $new_extension1 == 'jpg' || $new_extension1 == 'bmp') {
                   move_uploaded_file($_FILES['product_pic']['tmp_name'], "./uploads/oyapad/" . $file_name1);
                    $imagename1 = $file_name1;
                    $source_image = "uploads/oyapad/".$file_name1;
			 		$this->make_thumb($source_image,$source_image,'400');
                } else {
                    $this->session->set_flashdata('error', 'Invalid Image type');
                    redirect('biller/oyapad_products');
                }
                $data['product_image']=$imagename1;
            }
            $product_id = $this->input->post('oya_product_id');
           $where=array('oya_product_id'=>$product_id);             
                $this->login_model->update_data('oyapad_products', $data, $where);
                $this->session->set_flashdata('status', 'Product Update successfully');
            

            redirect('biller/oyapad_products');
        }
	}
  function oyapad_transactions() 
  {
          $where12 = array('trans_biller_id'=>$this->session->userdata('biller_id'));
          $data12['oyapad_transactions'] = $this->login_model->get_data_where_condition('oyapad_transaction_ref', $where12,'trans_ref_id');
          $data['biller_details']=$this->biller_required_detils();
          $this->load->view('new_biller/header');
          $this->load->view('new_biller/sidebar',$data);
          $this->load->view('new_biller/oyapad_transactions',$data12);
          $this->load->view('new_biller/footer');
  }
}