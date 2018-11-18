<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Event extends CI_Controller {

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

    		 define('event_image',base_url('uploads/event'));
    		 define('event_ticket_image',base_url('uploads/event'));
    		 define('biller_sattlement',base_url('uploads/biller_sattlement'));
    		 $path='/var/www/html/Recharge/uploads/invoice/';
        if ($this->session->userdata('event_biller_id') == FALSE) {
            redirect('biller_login');
        }else{
        	$biller_id= $this->session->userdata('event_biller_id');
        }
    }
      function logout() {
        $this->session->sess_destroy();
        redirect('biller_login');
    }
    function eventicket()
    {
       $data1['biller_details'] = $this->biller_required_detils();
       $booking_ticket_id       = $this->uri->segment(3);
       $where                   = array('booking_event_tickets_id'=>$booking_ticket_id);
       $ticket_records          = $this -> login_model -> get_join_three_table_where('booking_event_tickets','user','event_list','user_id','booking_user_id','event_id','booking_event_id',$where);
       $data['booking_records']   = $ticket_records; 
      
       
         $sql            =   'SELECT * FROM `booking_event_tickets`  inner join  `booking_ticket_status` on `booking_ticket_status`.`booking_id`=`booking_event_tickets`.`booking_event_tickets_id` inner  join `event_ticket_record` on `event_ticket_record`.`event_ticket_id`=`booking_ticket_status`.`booking_ticket_id` inner join `events_tickets`on `events_tickets`.`events_tickets_id`=`booking_ticket_status`.`booking_ticket_id` where  `booking_ticket_status`.`booking_id`="'.$booking_ticket_id.'" GROUP BY `booking_ticket_status`.`booking_ticket_id`';
		$response=$this->login_model->get_simple_query($sql);
		$data['tickets'] = $response;
        $this->load->view('event/header');
        $this->load->view('event/sidebar',$data1);
        $this->load->view('event/ticket-invoice',$data);
        $this->load->view('event/footer');
    }
  function change_password() {
        if ($this->input->post('change')) {
            $where = array('biller_id' => $this->session->userdata('event_biller_id'), 'biller_password' => md5($this->input->post('old_pass')));
            $check_password = $this->login_model->get_record_where('biller_details', $where);
            if ($check_password == FALSE) {
                $this->session->set_flashdata('error', 'Old Password does not match');
                redirect('event/change_password');
            } else {
                $data = array('biller_password' => md5($this->input->post('new_pass')));
                $where = array('biller_id' => $this->session->userdata('event_biller_id'));
                $this->login_model->update_data('biller_details', $data, $where);

                //----------------Mail Start------------------//

                $message = '<h1>Oyacharge </h1></b></b><p>Your password has been changed successfully Your Email = ' . $this->session->userdata('biller_email') . '.</p>
			<p><a href="' . site_url('login') . '" [astyle]></a></p></b>,
			</b></b><p>The Admin</p>';

                $to = $this->session->userdata('biller_email');
                $subject = 'Password Changed';
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
                $headers .= 'From: Oyacharge' . "\r\n";
            //    mail($to, $subject, $message, $headers);
				$this->sendElasticEmail($to, $subject,"OyaCharge", $message, "care@oyacharge.com", "OyaCharge");
                //----------------Mail End------------------//

                $this->session->set_flashdata('success', 'Password successfully changed');
                redirect('event/change_password');
            }
        } else {

				$where22=array('biller_id'=>$this->session->userdata('event_biller_id'));
        	$data['biller_details'] = $this->login_model->get_record_join_two_table('biller_details', 'biller_category', 'biller_category_id', 'biller_category_id','*',$where22);
			
			//$data['biller_details'][0]->category=$biller[0]->category;
			
		//	print_r($data['biller_details']);die;
            $this->load->view('biller/menu',$data);
            $this->load->view('biller/header');
            $this->load->view('biller/change_password_view');
            $this->load->view('biller/footer');
        }
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
      echo $res;
      fclose($fp);
    }
   
    return $res;                  
}
    function index() {

   $biller_id=$this->session->userdata('event_biller_id');
    $sqlbiller="SELECT biller_type from biller_details where biller_id='".$biller_id."'";
    $biller_type=$this->login_model->get_simple_query($sqlbiller);
    $billerType=$biller_type[0]->biller_type;
  if($billerType=='3')
    {
      $sql11111="select count(*) as total_event from  event_list where event_biller_id='".$biller_id."'";
    $data['event_count']=$this->login_model->get_simple_query($sql11111);
    $sql11121="SELECT count(*) as event_user FROM `booking_event_tickets` where event_biller_id='".$biller_id."' ";
    $data['event_user']=$this->login_model->get_simple_query($sql11121);
    $sql="select sum(booking_ticket_price) as total_booking from  booking_event_tickets where event_biller_id='".$this->session->userdata('event_biller_id')."' and booking_event_tickets_status='1'";
    $data['Booking_amount']=$this->login_model->get_simple_query($sql);
    $sq1="select sum(booking_ticket_qty) as total_sold from booking_event_tickets join booking_ticket_status on booking_event_tickets.booking_event_tickets_id=booking_ticket_status. booking_id where `event_biller_id`='".$biller_id."'";
    $data['sold_ticket']=$this->login_model->get_simple_query($sq1);
    $bookingeventSql="select BE.booking_ticket_price,BE.transaction_id,U.user_name,U.user_contact_no,BE.transaction_date,E.event_name,BE.booking_event_tickets_id from booking_event_tickets BE join user U on U.user_id=BE.booking_user_id join event_list E on E.event_id=BE.booking_event_id where BE.event_biller_id='".$biller_id."' and booking_event_tickets_status='1' order by booking_event_tickets_id DESC limit 6";
     $data['event_trans']=$this->login_model->get_simple_query($bookingeventSql);
     $bookingeventuserSql="select BE.booking_ticket_price,BE.transaction_id,U.user_name,U.user_email,BE.transaction_date,E.event_name from booking_event_tickets BE join user U on U.user_id=BE.booking_user_id join event_list E on E.event_id=BE.booking_event_id where BE.event_biller_id='".$biller_id."' and booking_event_tickets_status='1' group by BE.booking_user_id order by booking_event_tickets_id DESC limit 5";
     $data['eventuser']=$this->login_model->get_simple_query($bookingeventuserSql);
      $sql="SELECT count(*) as past_event  FROM event_list WHERE  event_end_date < NOW() and event_biller_id='".$biller_id."'"; 
    $data['past_event']=$this->login_model->get_simple_query($sql);
     $sql="SELECT count(*) as start_event  FROM event_list WHERE event_date <= NOW() and event_end_date >= NOW() and event_biller_id='".$biller_id."'"; 
    $data['start_event']=$this->login_model->get_simple_query($sql);
    $sql="SELECT count(*) as upcoming_event  FROM event_list WHERE event_date > NOW() and event_end_date >= NOW() and event_biller_id='".$biller_id."'"; 
      $data['upcoming_event']=$this->login_model->get_simple_query($sql);
       $weeekly_booking ="SELECT count(*) as invoice_count,transaction_date from booking_event_tickets WHERE YEARWEEK(`transaction_date`, 1) = YEARWEEK(CURDATE(), 1) and event_biller_id='".$biller_id."' group by transaction_date";
       $data['week_invoice_count']=$this->login_model->get_simple_query($weeekly_booking);
         $weeekly_invoice ="SELECT sum(booking_ticket_price) as invoice_amount,transaction_date from booking_event_tickets WHERE YEARWEEK(`transaction_date`, 1) = YEARWEEK(CURDATE(), 1) and event_biller_id='".$biller_id."' and booking_event_tickets_status=1  group by transaction_date";
       $data['week_invoice_amount']=$this->login_model->get_simple_query($weeekly_invoice);

    }
    $biller_settlement = "SELECT SUM(settlement_amount) as settlement_amount,count(*) as settlement_count FROM biller_sattlement  where biller_id='".$biller_id."'";
     $settlement=$this->login_model->get_simple_query($biller_settlement);
     $data['settlement_amount']=$settlement[0]->settlement_amount;
     $data['settlement_count']=$settlement[0]->settlement_count;
      $sql_wallet="select wallet_amount from user where biller_id='".$biller_id."'";
      $data['oyawallet']=$this->login_model->get_simple_query($sql_wallet); 
     $data['BillerUserTransaction']=$this->getBillerUserTransactions();
     $data1['biller_details']=$this->biller_required_detils();
		    $this->load->view('event/header');
        $this->load->view('event/sidebar',$data1);
        $this->load->view('event/dashboard',$data);
        $this->load->view('event/footer');
		
    }
    function bill_paid_transaction()
    {
      $biller_id=$this->session->userdata('event_biller_id');
      $sql="SELECT bill_recharge.bill_consumer_no,bill_recharge.bill_invoice_no,bill_transaction_id,bill_recharge.bill_amount,bill_pay_date,biller_user_name,bill_product_name FROM `bill_recharge` join biller_user on biller_user.bill_invoice_no=bill_recharge.bill_invoice_no where bill_recharge.biller_id='".$biller_id."'";
      $bill_transactions=$this->login_model->get_simple_query($sql);
      return $bill_transactions;
    }
    function getBillerUserTransactions()
    {
      $biller_id=$this->session->userdata('event_biller_id');
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
	
	function event_profile()
  {
        $data1['biller_details']=$this->biller_required_detils();
        
         $sql="SELECT * FROM `bank_list` WHERE bank_status=1 order by bank_name ASC";
        $data['bank_list']=$this->login_model->get_simple_query($sql);

        $this->load->view('event/header');
        $this->load->view('event/sidebar',$data1);
        $this->load->view('event/profile',$data);
        $this->load->view('event/footer');
  }

  function get_wallet_amount()
  {
       $biller_id = $this->session->userdata('event_biller_id');
       $select="select user_id, wallet_amount from user where biller_id = '".$biller_id."'";
       $users=$this->login_model->get_simple_query($select);
       return $users;
  }
   function configuiration()
  {
        $data['biller_details']=$this->biller_required_detils();
        $data['get_wallet']  = $this->get_wallet_amount();
        $data['biller_config']=$this->login_model->get_simple_query("SELECT biller_name,biller_address,biller_contact_no,biller_email,qr_code,minimum_withdraw_amount,wallet_amount,agent_users.agent_margin,biller_company_logo FROM `biller_details` join user on user.biller_id=biller_details.biller_id LEFT join agent_users on agent_users.agent_user_id=user.user_id where biller_details.biller_id='".$this->session->userdata('event_biller_id')."'");
        $this->load->view('event/header');
        $this->load->view('event/sidebar',$data);
        $this->load->view('event/confrigation',$data);
        $this->load->view('event/footer');
  }
  function event_config()
  {
       $data = $this->input->post();
      $data12['minimum_withdraw_amount']=$data['minimum_withdraw_amount'];
        $where=array('biller_details.'.'biller_id'=>$this->session->userdata('event_biller_id'));
        $this->login_model->update_data('biller_details', $data12, $where);
        $this -> session -> set_flashdata('success', 'Your configuiration setting saved Successfully !');
        redirect('event/configuiration');
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
      $data12['bank_code']            = $data['bank_code'];
      $data12['bank_account_no']      = $data['bank_account_no'];
      $data12['bank_account_holder']  = $data['bank_account_holder'];
      $data12['biller_address']       = $data['biller_address'];
      $data12['biller_state']         = $data['biller_state'];
      $data12['biller_city']          = $data['biller_city'];
      $data12['biller_zipcode']       = $data['biller_zipcode'];
      $where12= array('bank_code'=>$data['bank_code']);
      $bank = $this->login_model->get_data_where_condition('bank_list', $where12);
      $data12['bank_name']       = $bank[0]->bank_name;
      $user_image = '';
      if ($_FILES['biller_company_logo']['name']) {
                $user_image = $_FILES['biller_company_logo']['name'];
          
                $file_extension = explode(".", $_FILES["biller_company_logo"]["name"]);
                $new_extension = strtolower(end($file_extension));
                $today = time();
                $custom_name = "church_" . $today;
                $file_name = $custom_name . "." . $new_extension;

                if ($new_extension == 'png' || $new_extension == 'jpeg' || $new_extension == 'jpg' || $new_extension == 'bmp') {
                   move_uploaded_file($_FILES['biller_company_logo']['tmp_name'], "./uploads/biller_company_logo/" . $file_name);
                    $imagename = $file_name;
                } else {
                    $this->session->set_flashdata('error', 'Invalid Image type');
                    redirect('event/event_profile');
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
                    redirect('event/event_profile');
                }
                $data12['biller_document']=$imagename1;
            }
        $where=array('biller_details.'.'biller_id'=>$this->session->userdata('event_biller_id'));
       $this->login_model->update_data('biller_details', $data12, $where);

         // $data011['church_img']=$imagename;
         // $where010=array('church_biller_id'=>$this->session->userdata('event_biller_id'));
         // $this->login_model->update_data('church_list', $data011, $where010);

       $this -> session -> set_flashdata('success', 'Your profile is successfully submitted.! Please wait for admin review and approval !');
      redirect('event/event_profile');
    }
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
		$url = "http://www.kudisms.net/components/com_spc/smsapi.php?username=abhishek.kumar@efficiencie.com&password=Abhi.ricky@12&sender=OyaCharge&recipient=$mobile&message=" . $encodedMessage;
		$ch = curl_init();
		curl_setopt_array($ch, array(CURLOPT_URL => $url, CURLOPT_RETURNTRANSFER => true, CURLOPT_POST => true,
		CURLOPT_FOLLOWLOCATION => true));
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$output = curl_exec($ch);

		curl_close($ch);
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

        if ($table == "biller_produt" && $function == "church_product_list") {
            if ($field_value != 1) {
                $message = 'SUCCESS! Product Status Change to InActive. ';
            } else {
                $message = 'SUCCESS! Product Status Change to Active. ';
            }
            $this->session->set_flashdata('status', $message);
            $path = 'event/' . $function;
            redirect($path);
        }
         if ($table == "events_tickets" && $function == "event_tickets") {
            if ($field_value != 1) {
                $message = 'SUCCESS! Product Status Change to InActive. ';
            } else {
                $message = 'SUCCESS! Product Status Change to Active. ';
            }
            $this->session->set_flashdata('status', $message);
            $path = 'event/' . $function;
            redirect($path);
        }
         if ($table == "event_list" && $function == "event_list") {
            if ($field_value != 1) {
                $message = 'SUCCESS! Event Status Change to InActive. ';
            } else {
                $message = 'SUCCESS! Event Status Change to Active. ';
            }
            $this->session->set_flashdata('status', $message);
            $path = 'event/' . $function;
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
                $message = 'Bill user deleted successfully!!';
                $this->session->set_flashdata('error', $message);
                redirect('biller/consumer_list');
            }
            if ($delete_type == 'delete_product') {
                $message = 'product deleted successfully!!';
                $this->session->set_flashdata('error', $message);
                redirect('church/church_product_list');
            }
			 if ($delete_type == 'delete_branch') {
                $message = 'Branch deleted successfully!!';
                $this->session->set_flashdata('error', $message);
                redirect('church/church_product_list');
            }
        } else {
            redirect('event');
        }
    }
	
function biller_required_detils()
{
	$where22=array('biller_id'=>$this->session->userdata('event_biller_id'));
	$biller_details = $this->login_model->get_record_join_two_table('biller_details', 'biller_category', 'biller_category_id', 'biller_category_id','*',$where22); 
	return $biller_details;
}

//===============event ============
///////=======Event part============//
function event_tickets()
{
		$data1['biller_details']=$this->biller_required_detils();
		$where = array('events_biller_id'=>$this->session->userdata('event_biller_id'));
    $data['events_tickets'] = $this->login_model->get_data_where_condition('events_tickets', $where);
			
			
        $this->load->view('event/header');
        $this->load->view('event/sidebar',$data1);
        $this->load->view('event/event_tickets', $data);
        $this->load->view('event/footer');
}

 function add_event_ticket()
	 {
	 	if ($this->input->post('submit')) {
           $data = $this->input->post();
            unset($data['submit']);
			$data['events_biller_id']=$this->session->userdata('event_biller_id');
			$user_image = '';
			if ($_FILES['events_tickets_image']['name']) {
             
                $file_extension = explode(".", $_FILES["events_tickets_image"]["name"]);
                $new_extension = strtolower(end($file_extension));
                $today = time();
                $custom_name = "event_ticket" . $today;
                $file_name = $custom_name . "." . $new_extension;

                if ($new_extension == 'png' || $new_extension == 'jpeg' || $new_extension == 'jpg' || $new_extension == 'bmp') {
                    move_uploaded_file($_FILES['events_tickets_image']['tmp_name'], "./uploads/event/" . $file_name);
                    $imagename = $file_name;
                } else {
                    $this->session->set_flashdata('error', 'Invalid Image type');
                    redirect('event/event_tickets');
                }
				      $data['events_tickets_image'] = $imagename;
            }
                    $this->load->library('ciqrcode');
                    $qr_image               = $this->input->post('events_tickets_no').'.png';
                    $params['data']         = $this->input->post('events_tickets_no');
                    $params['level']        = 'H';
                    $params['size']         = 8;
                    $params['savename']     = $_SERVER['DOCUMENT_ROOT'].'/uploads/event/'.$qr_image;
                    if($this->ciqrcode->generate($params))
                    {
                        $data['event_ticket_qrcode'] = $qr_image;
                        
                    }
			           $this->login_model->insert_data('events_tickets', $data);
                $this->session->set_flashdata('status', 'Ticket added successfully');
           
            redirect('event/event_tickets');
        } else {
	       redirect('event/event_tickets');
			
			}
	 }
function event_list()
{
	
		// $sql="SELECT count(*) as past_event  FROM event_list WHERE  event_end_date < NOW() and event_biller_id='".$this->session->userdata('event_biller_id')."'"; 
		// $data['past_event']=$this->login_model->get_simple_query($sql);
		//  $sql="SELECT count(*) as start_event  FROM event_list WHERE event_date <= NOW() and event_end_date >= NOW() and event_biller_id='".$this->session->userdata('event_biller_id')."'"; 
		// $data['start_event']=$this->login_model->get_simple_query($sql);
		//  $sql="SELECT count(*) as upcoming_event  FROM event_list WHERE event_date > NOW() and event_end_date >= NOW() and event_biller_id='".$this->session->userdata('event_biller_id')."'"; 
		// $data['upcoming_event']=$this->login_model->get_simple_query($sql);
		//  $sql="SELECT count(*) as total_event  FROM event_list where event_biller_id='".$this->session->userdata('event_biller_id')."'"; 
		// $data['total_event']=$this->login_model->get_simple_query($sql);
	
	
			$data1['biller_details']=$this->biller_required_detils();
			$where = array('events_biller_id'=>$this->session->userdata('event_biller_id'),'events_tickets_status'=>1);
       $data['events_tickets'] = $this->login_model->get_data_where_condition('events_tickets', $where);
       if(empty($data['events_tickets']))
       {
         $this->session->set_flashdata('status','Please Create Event tickets before create events');
          redirect('event/event_tickets');
       }
			$where = array('event_biller_id'=>$this->session->userdata('event_biller_id'));
            $events_list = $this->login_model->get_data_where_condition('event_list', $where,'event_id');
             
		    foreach($events_list as $val)
			{
				
				$ticket_ids= $val->event_tickets_id;
			  $sql="select sum(event_ticket_limit) as remaining_ticket from event_ticket_record where  FIND_IN_SET(event_ticket_id,'$ticket_ids') and event_id='".$val->event_id."'";
				$ticket_record[]=$this->login_model->get_simple_query($sql);
			}

			$data['events_list']=$events_list;
			for($i=0;$i<count($events_list);$i++)
			{
				$data['events_list'][$i]->remaining_ticket=$ticket_record[$i][0]->remaining_ticket;
				$data['events_list'][$i]->sold_tickets=$events_list[$i]->event_total_tickets-$ticket_record[$i][0]->remaining_ticket;
			}
	
			
			  $this->load->view('event/header');
        $this->load->view('event/sidebar',$data1);
        $this->load->view('event/event_list', $data);
        $this->load->view('event/footer');
			
}
function check_event_ticket()
{
	$biller_id=$_REQUEST['biller_id'];
	$where = array('events_biller_id'=>$biller_id);
    $events_tickets = $this->login_model->get_data_where_condition('events_tickets', $where);
	if(!empty($events_tickets))
	{
		echo "1";
	}else{
		echo "2";
	}
	
}
  function add_event()
	{
	 if ($this->input->post('submit')) 
	 {
           $data = $this->input->post();
   
	$total_tkt='0';
		if(!empty($data['event_tickets_id']))
		{
				 unset($data['submit']);
				
			for($i=0;$i<count($data['event_tickets_id']); $i++)
			{
				$where12=array('find_in_set(events_tickets_id, "'.$data['event_tickets_id'][$i].'") '=>NULL);
				$biller_product = $this->login_model->get_data_where_condition('events_tickets', $where12);
			
				$name[]=$biller_product[0]->events_tickets_name;
				$price[]=$biller_product[0]->events_tickets_price;
			
			}	
		   for($i=0;$i<count($data['ticket_limit']);$i++)
		   {
		  	if($data['ticket_limit'][$i]!=='0')
		  	{
				$ticket_limit[]=$data['ticket_limit'][$i];
				$total_tkt +=$data['ticket_limit'][$i];
			}
		   }
		  if(!empty($ticket_limit)){
			$data1['event_tickets_id']     = implode(",",$data['event_tickets_id']);
			
			$data1['event_tickets_name']   = implode(",",$name);
			$data1['event_tickets_price']  = implode(",",$price);
			$data1['event_tickets_limit']  = implode(",",$ticket_limit);
				
			/* if ($_FILES['event_image']['name']) {
                $user_image = $_FILES['event_image']['name'];
            }
            $attachment = $_FILES['event_image']['name'];

            if (!empty($attachment)) {
                $file_extension = explode(".", $_FILES["event_image"]["name"]);
                $new_extension = strtolower(end($file_extension));
                $today = time();
                $custom_name = "event_image" . $today;
                $file_name = $custom_name . "." . $new_extension;

                if ($new_extension == 'png' || $new_extension == 'jpeg' || $new_extension == 'jpg' || $new_extension == 'bmp') {
                    move_uploaded_file($_FILES['event_image']['tmp_name'], "./uploads/event/" . $file_name);
                    $imagename = $file_name;
                } else {
                    $this->session->set_flashdata('error', 'Invalid Image type');
                    redirect('event/event_list');
                }
				 $data1['event_image'] = $imagename;
            } */
			
			if ($_FILES['event_image']['name']) {	
                $user_image = $_FILES['event_image']['name'];
            }
             $attachment = $_FILES['event_image']['name'];
			 
			 if (!empty($attachment)) {
				$imagename='';
				for($i=0;$i<count($_FILES['event_image']['name']);$i++)
				{
					$filename = $_FILES['event_image']['name'][$i];
					$temp_name = $_FILES['event_image']['tmp_name'][$i];
					$file_type= $_FILES['event_image']['type'][$i];
					
					
					$file_extension = explode(".", $_FILES["event_image"]["name"][$i]);                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
					
					$new_extension = strtolower(end($file_extension));
					$today = time();
					$custom_name = "event_image" . $today.$i;
					$file_name = $custom_name . "." . $new_extension;

					if ($new_extension == 'png' || $new_extension == 'jpeg' || $new_extension == 'jpg' || $new_extension == 'bmp') {
						move_uploaded_file($temp_name, "./uploads/event/" . $file_name);
						if(empty($imagename))
						{
							$imagename = $file_name;
						}else{
							$imagename = $imagename.",".$file_name;
						}
						
					} else {
						$this->session->set_flashdata('error', 'Invalid Image type');
						redirect('event/event_list');
					}
					 
					
				}
				$data1['event_image'] = $imagename;
            }
			
			
			
	
			$data1['event_name']		         =	$data['event_name'];
      $data1['event_created_date']     =	date("Y-m-d H:i:s");
		  $data1['event_date']		         =	date("Y-m-d H:i:s", strtotime($data['event_date']));
		  $data1['event_time']		         =	date("H:i:s", strtotime($data['event_date']));
		  $data1['event_end_date']	       =	date("Y-m-d H:i:s", strtotime($data['event_end_date']));
		  $data1['event_end_time']	       =	date("H:i:s",strtotime($data['event_end_date']));
		  $data1['event_name']		         =	$data['event_name'];
			$data1['event_place']		         =	$data['event_place'];
			$data1['event_contact_no']       =	$data['event_contact_no'];
			$data1['event_desc']		         =	$data['event_desc'];
			$data1['event_place_lat']        =	$data['event_place_lat'];
			$data1['event_place_log']        =	$data['event_place_log'];
      $data1['contact_person_name']    =  $data['contact_person_name'];
			$data1['event_biller_id']	       =	$this->session->userdata('event_biller_id');
			$data1['event_total_tickets']    =		$total_tkt;
       $biller_category_name        = $data['event_category'];
                $where_biller_cat            = array('biller_category_name'=>$biller_category_name);
                $biller_category             = $this->login_model->get_record_where('biller_category',$where_biller_cat);
                if(empty($biller_category))
                {
                    $data2121['biller_category_name'] = $biller_category_name;
                    $data2121['category'] = 3;
                    $event_category           = $this->login_model->insert_data('biller_category', $data2121);
                }else{
                    $event_category           = $biller_category[0]->biller_category_id;
                }
      $data1['event_category']         =  $event_category;
		
    $data2['event_id']=$this->login_model->insert_data('event_list', $data1);
		for($i=0;$i<count($data['event_tickets_id']); $i++)
		{
			$where12=array('find_in_set(events_tickets_id, "'.$data['event_tickets_id'][$i].'") '=>NULL);
			$biller_product = $this->login_model->get_data_where_condition('events_tickets', $where12);
			
			$data2['event_ticket_price']=$biller_product[0]->events_tickets_price;
			$data2['event_ticket_id']=$data['event_tickets_id'][$i];
			if($data['ticket_limit'][$i]!=='0')
			{
				$data2['event_ticket_limit']=$data['ticket_limit'][$i];
			}
			$this->login_model->insert_data('event_ticket_record', $data2);
		}	
		  
                $this->session->set_flashdata('status', 'Event add successfully');
           
           redirect('event/event_list');
            }else{
            	 $this->session->set_flashdata('error', 'Sorry!! Please Select ticket limit of ticket');
            }
			}else{
				 $this->session->set_flashdata('status', 'Please Select atleast one ticket');
			}
            redirect('event/event_list');
			}
         else {
        	 $data1['biller_details']=$this->biller_required_detils();
			$where = array('events_biller_id'=>$this->session->userdata('event_biller_id'));
            $data['events_tickets'] = $this->login_model->get_data_where_condition('events_tickets', $where);
			$where1 = array('biller_id'=>$this->session->userdata('event_biller_id'));
            $biller = $this->login_model->get_data_where_condition('biller_details', $where1);
			$where12=array('find_in_set(biller_category_id, "'.$biller[0]->biller_category_id.'") '=>NULL);
			
			$biller_category = $this->login_model->get_data_where_condition('biller_category', $where12);
			$data['biller_category']=$biller_category;
		    $this->load->view('event/header');
        $this->load->view('event/sidebar',$data1);
        $this->load->view('event/event_list', $data);
        $this->load->view('event/footer');
			
			}
	 }
function edit_event()
{
  if ($this->input->post('submit')) {
      $data = $this->input->post();
			$where = array('event_id' => $this->input->post('event_id'));
      unset($data['biller_id']);
      unset($data['submit']);
       
		 	  $data['event_date']		=	date("Y-m-d H:i:s", strtotime($data['event_date']));
		  	$data['event_time']		=	date("H:i:s", strtotime($data['event_date']));
		  	$data['event_end_date']	=	date("Y-m-d H:i:s", strtotime($data['event_end_date']));
		   	$data['event_end_time']	=	date("H:i:s",strtotime($data['event_end_date']));
	
            $this->login_model->update_data('event_list', $data, $where);
            $this->session->set_flashdata('status', 'Event details Update successfully');
            

            redirect('biller/event_list');
        }  else {
            $event_id = $this->uri->segment(3);
            if (!empty($event_id)) {
					 $data['biller_details']=$this->biller_required_detils();
			
			$where1 = array('biller_id'=>$this->session->userdata('event_biller_id'));
            $biller = $this->login_model->get_data_where_condition('biller_details', $where1);
			$where12=array('find_in_set(biller_category_id, "'.$biller[0]->biller_category_id.'") '=>NULL);
			
			$biller_category = $this->login_model->get_data_where_condition('biller_category', $where12);
			$data['biller_category']=$biller_category;
      $where = array('event_id' => $event_id);
      $event_details = $this->login_model->get_data_where_condition('event_list', $where);
			$ids=$event_details[0]->event_tickets_id;
			$sql="select * from events_tickets join event_ticket_record on event_ticket_record.event_ticket_id=events_tickets.events_tickets_id where FIND_IN_SET(events_tickets.events_tickets_id,'$ids') GROUP BY events_tickets_id";
			$tickets=$this->login_model->get_simple_query($sql); 
			$data['event_details'] =$event_details;
			$data['event_details'][0]->event_ticket=$tickets;
		
                $this->load->view('biller/menu',$data);
                $this->load->view('biller/header');
                $this->load->view('biller/add/add_event', $data);
                $this->load->view('biller/footer');
            } else {
                redirect('Event_List');
            }
        }
}
//=== My sattelment===
function sattlement()
{
			$data1['biller_details']=$this->biller_required_detils();
			$where = array('biller_id'=>$this->session->userdata('event_biller_id'));
      $data['my_sattlement'] = $this->login_model->get_data_where_condition('biller_sattlement', $where);
			
			
			$this->load->view('event/header');
      $this->load->view('event/sidebar',$data1);
      $this->load->view('event/mysettelment',$data);
      $this->load->view('event/footer');
}
function booking_ticket()
{
	$event_id = $this->uri->segment(3);
	$biller_id=$this->session->userdata('event_biller_id');
	$where=array('event_biller_id'=>$biller_id,'booking_event_id'=>$event_id);
	$data['booking_user'] = $this->login_model->get_record_join_two_table('booking_event_tickets', 'user', 'booking_user_id', 'user_id','*',$where); 
	//$data['booking_user'] = $this->login_model->get_data_where_condition('booking_event_tickets1', $where);
		
	$data1['biller_details']=$this->biller_required_detils();
			$this->load->view('event/header');
      $this->load->view('event/sidebar',$data);
      $this->load->view('event/booking_tickets',$data);
      $this->load->view('event/footer');
}
function view_ticket_details()
{
	$booking_event_tickets_id = $this->uri->segment(3);
	$booking_event_user_id = $this->uri->segment(4);
	$sql="SELECT booking_event_tickets.*,U.user_name,U.user_email,U.user_contact_no,E.event_name FROM booking_event_tickets JOIN user U ON U.`user_id`=`booking_event_tickets`.`booking_user_id` join event_list E on E.event_id=booking_event_tickets.booking_event_id WHERE `booking_event_tickets_id` = '".$booking_event_tickets_id."'";
  $tickets =$this->login_model->get_simple_query($sql);
   $ids= $tickets[0]->booking_ticket_id;
  $booking_id= $tickets[0]->booking_event_tickets_id;
  $sql11111= "select booking_ticket_qty from booking_ticket_status where booking_id='".$booking_id."'"; 
  $ticket_records =$this->login_model->get_simple_query($sql11111);  
  $event_id=$tickets[0]->booking_event_id;
  $id_ticket=explode(",", $ids);
  $i=0;
 foreach ($id_ticket as $value) 
 {
 	    $where=array('event_ticket_id'=>$value,'event_id'=>$event_id);
      $result[] = $this->login_model->get_record_join_two_table('event_ticket_record', 'events_tickets', 'event_ticket_id', 'events_tickets_id','*',$where); 
     $i++;
 } 

  
    $data['biller_details']=$this->biller_required_detils();
    $data['booking_details']=$tickets;
    $data['ticket_details']=$result;
    $data['ticket_qty']=$ticket_records;
    $this->load->view('biller/menu',$data);
		$this->load->view('biller/header');
    $this->load->view('biller/listing/booking_ticket_details',$data);
    $this->load->view('biller/footer');
}
function event_transaction()
{
			$data1['biller_details']=$this->biller_required_detils();
			$where = array('events_biller_id'=>$this->session->userdata('event_biller_id'));
            $data['events_tickets'] = $this->login_model->get_data_where_condition('events_tickets', $where);
		 $sql="SELECT * FROM `wallet_transaction` join booking_event_tickets on booking_event_tickets.transaction_id=wallet_transaction.`transaction_id` join user on user.user_id=wallet_transaction.`wt_user_id` join event_list on event_list.event_id=booking_event_tickets.booking_event_id   where `booking_event_tickets`.`event_biller_id`='".$this->session->userdata('event_biller_id')."' order by wt_id DESC";
	    $booking = $this->login_model->get_simple_query($sql);

	    if(!empty($booking))
	    {
	    	$i=0;
	    	foreach ($booking as $value) {
	    		$user_id = $value->user_id;
	    		$booking_id = $value->booking_event_tickets_id;
	    		$sqlticket="SELECT sum(booking_ticket_qty) as ticket_qty FROM `booking_ticket_status` where booking_user_id='".$user_id."' and booking_id='".$booking_id."'";
	    		$tickets = $this->login_model->get_simple_query($sqlticket);
	    		$booking[$i]->ticket_qty = $tickets[0]->ticket_qty;
	    		$i++;
	    	}
	    }
	    
$data['transaction_record']=$booking;
      $this->load->view('event/header');
      $this->load->view('event/sidebar',$data1);
      $this->load->view('event/booking_tickets',$data);
      $this->load->view('event/footer');
}
	function event_perticuler_transaction(){
			$data['biller_details']=$this->biller_required_detils();
			$where = array('events_biller_id'=>$this->session->userdata('event_biller_id'));
            $data['events_tickets'] = $this->login_model->get_data_where_condition('events_tickets', $where);
   		$trans_id = $this->uri->segment(3);
   		$user_id = $this->uri->segment(4);
		$where=array('wt_user_id'=>$user_id,'wt_id'=>$trans_id);
		$sql="SELECT * FROM `wallet_transaction` join booking_event_tickets on booking_event_tickets.transaction_id=wallet_transaction.`transaction_id` join user on user.user_id=wallet_transaction.`wt_user_id` join event_list on event_list.event_id=booking_event_tickets.booking_event_id   where `booking_event_tickets`.`event_biller_id`='".$this->session->userdata('event_biller_id')."' and wallet_transaction.wt_user_id='".$user_id."' and wallet_transaction.wt_id='".$trans_id."'";
	    $data['transaction_record']=$this->login_model->get_simple_query($sql);
		
		$this->load->view('biller/menu',$data);
        $this->load->view('biller/header');
        $this->load->view('biller/listing/event_user_transactions', $data);
        $this->load->view('biller/footer');
   }
function ajax_event_transaction() {
	$date = $this->input->post('date');
	
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
            
	$query = "SELECT * FROM `wallet_transaction` join booking_event_tickets on booking_event_tickets.transaction_id=wallet_transaction.`transaction_id` join user on user.user_id=wallet_transaction.`wt_user_id` join event_list on event_list.event_id=booking_event_tickets.booking_event_id";
	$conditions = array();


	$sql = $query;
	
	if($first_date !='' && $second_date !='')
	$sql .= " AND `wt_datetime` BETWEEN '". $first_date ."' AND '". $second_date."'";
	

	$arr = $this->login_model->get_simple_query($sql);
	$data['transaction_record'] = $arr;
	$this->load->view('biller/ajax_transaction_filter_view', $data);
   }
}