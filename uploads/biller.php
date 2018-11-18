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

    		 define('church_image',base_url('uploads/church_image'));
    		 define('event_ticket_image',base_url('uploads/event'));
    		 define('biller_sattlement',base_url('uploads/biller_sattlement'));
    		 $path='/var/www/html/Recharge/uploads/invoice/';
        if ($this->session->userdata('biller_id') == FALSE) {
            redirect('biller_login');
        }else{
        	$biller_id= $this->session->userdata('biller_id');
        }
    }
  function change_password() {
        if ($this->input->post('change')) {
            $where = array('biller_id' => $this->session->userdata('biller_id'), 'biller_password' => md5($this->input->post('old_pass')));
            $check_password = $this->login_model->get_record_where('biller_details', $where);
            if ($check_password == FALSE) {
                $this->session->set_flashdata('error', 'Old Password does not match');
                redirect('biller/change_password');
            } else {
                $data = array('biller_password' => md5($this->input->post('new_pass')));
                $where = array('biller_id' => $this->session->userdata('biller_id'));
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
                redirect('biller/change_password');
            }
        } else {

				$where22=array('biller_id'=>$this->session->userdata('biller_id'));
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
      $sql_biller="SELECT `bill_recharge`.bill_pay_date as bill_pay_date,biller_user.bill_invoice_no as bill_invoice_no,bill_recharge.bill_consumer_no,bill_recharge.bill_transaction_id,bill_recharge.bill_amount as bill_amount,user.user_name as username,user.user_email as useremail FROM `bill_recharge` join biller_user on biller_user.bill_invoice_no=bill_recharge.bill_invoice_no join user on user.user_id=bill_recharge.bill_user_id where bill_recharge.biller_id='".$biller_id."' order by bill_recharge_id DESC limit 5";
      $data['biller_trans']=$this->login_model->get_simple_query($sql_biller);
      $sql_billerUser="SELECT biller_user_name,biller_user_email,bill_invoice_no,bill_invoice_date from biller_user where biller_id='".$biller_id."' order by biller_user_id DESC limit 5";
      $data['billerUSER']=$this->login_model->get_simple_query($sql_billerUser);
    }else if($billerType=='2')
    {
     
      $selectchurch ='select church_id from church_list where church_biller_id="'.$biller_id.'"';
      $churchResponse=$this->login_model->get_simple_query($selectchurch);
      $where223=array('church_id'=>$churchResponse[0]->church_id);
      $data['church_area'] = $this->login_model->count_records_where('church_area', $where223);
      $sql="select sum(church_product_price) as total_donation from  church_donate where church_biller_id='".$this->session->userdata('biller_id')."' and payment_status='1'";
      $data['domation_amount']=$this->login_model->get_simple_query($sql);
      $where1122=array('church_biller_id'=>$this->session->userdata('biller_id'),'payment_status'=>'1');
      $data['donate_transaction'] = $this->login_model->count_records_where('church_donate', $where1122);
      $donatesql="SELECT `church_donate`.*, user.user_email as useremail,user.user_name as username,user.user_contact_no as user_contact,church_area.church_area as branch_area FROM `church_donate`  join user on user.user_id=church_donate.donate_user_id join church_area on church_area.church_area_id=church_donate.church_area_id where church_biller_id='".$biller_id."' and payment_status='1'  order by church_donate_id DESC limit 5";
      $data['donate_trans']=$this->login_model->get_simple_query($donatesql);
      $donateusersql="SELECT `church_donate`.*, user.user_email as useremail,user.user_name as username,user.user_contact_no as user_contact FROM `church_donate` join user on user.user_id=church_donate.donate_user_id  where church_biller_id='".$biller_id."' group by donate_user_id order by church_donate_id DESC limit 5";
      $data['donate_user']=$this->login_model->get_simple_query($donateusersql);
    }else if($billerType=='3')
    {
    $sql11111="select count(*) as total_event from  event_list where event_biller_id='".$biller_id."'";
    $data['event_count']=$this->login_model->get_simple_query($sql11111);
    $sql11121="SELECT count(*) as event_user FROM `booking_event_tickets` where event_biller_id='".$biller_id."' ";
    $data['event_user']=$this->login_model->get_simple_query($sql11121);
    $sql="select sum(booking_ticket_price) as total_booking from  booking_event_tickets where event_biller_id='".$this->session->userdata('biller_id')."' and booking_event_tickets_status='1'";
    $data['Booking_amount']=$this->login_model->get_simple_query($sql);
    $sq1="select sum(booking_ticket_qty) as total_sold from booking_event_tickets join booking_ticket_status on booking_event_tickets.booking_event_tickets_id=booking_ticket_status. booking_id where `event_biller_id`='".$biller_id."'";
    $data['sold_ticket']=$this->login_model->get_simple_query($sq1);
    $bookingeventSql="select BE.booking_ticket_price,BE.transaction_id,U.user_name,U.user_email,BE.transaction_date,E.event_name from booking_event_tickets BE join user U on U.user_id=BE.booking_user_id join event_list E on E.event_id=BE.booking_event_id where BE.event_biller_id='".$biller_id."' and booking_event_tickets_status='1' order by booking_event_tickets_id DESC limit 5";
     $data['event_trans']=$this->login_model->get_simple_query($bookingeventSql);
     $bookingeventuserSql="select BE.booking_ticket_price,BE.transaction_id,U.user_name,U.user_email,BE.transaction_date,E.event_name from booking_event_tickets BE join user U on U.user_id=BE.booking_user_id join event_list E on E.event_id=BE.booking_event_id where BE.event_biller_id='".$biller_id."' and booking_event_tickets_status='1' group by BE.booking_user_id order by booking_event_tickets_id DESC limit 5";
     $data['eventuser']=$this->login_model->get_simple_query($bookingeventuserSql);
      $sql="SELECT count(*) as past_event  FROM event_list WHERE  event_end_date < NOW() and event_biller_id='".$biller_id."'"; 
    $data['past_event']=$this->login_model->get_simple_query($sql);
     $sql="SELECT count(*) as start_event  FROM event_list WHERE event_date <= NOW() and event_end_date >= NOW() and event_biller_id='".$biller_id."'"; 
    $data['start_event']=$this->login_model->get_simple_query($sql);
    $sql="SELECT count(*) as upcoming_event  FROM event_list WHERE event_date > NOW() and event_end_date >= NOW() and event_biller_id='".$biller_id."'"; 
      $data['upcoming_event']=$this->login_model->get_simple_query($sql);
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
		$where=array('biller_user.'.'biller_id'=>$this->session->userdata('biller_id'));
		$data['consumer_details'] = $this->login_model->get_data_where_condition('biller_user', $where,'biller_user_id');
		
				$data['biller_details']=$this->biller_required_detils();
		    
        $this->load->view('new_biller/header');
        $this->load->view('new_biller/sidebar',$data);
        $this->load->view('new_biller/invoicelist', $data);
        $this->load->view('new_biller/footer');
	}
	function biller_profile()
  {
        $data['biller_details']=$this->biller_required_detils();
        
         $sql="SELECT * FROM `bank_list` WHERE bank_status=1 order by bank_name ASC";
        $data['bank_list']=$this->login_model->get_simple_query($sql);
        $this->load->view('new_biller/header');
        $this->load->view('new_biller/sidebar',$data);
        $this->load->view('new_biller/profile',$data);
        $this->load->view('new_biller/footer');
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
                $custom_name = "biller_company_logo" . $today;
                $file_name = $custom_name . "." . $new_extension;

                if ($new_extension == 'png' || $new_extension == 'jpeg' || $new_extension == 'jpg' || $new_extension == 'bmp') {
                   move_uploaded_file($_FILES['biller_company_logo']['tmp_name'], "./uploads/biller_company_logo/" . $file_name);
                    $imagename = $file_name;
                } else {
                    $this->session->set_flashdata('error', 'Invalid Image type');
                    redirect('biller/biller_profile');
                }
            }
        $data12['biller_company_logo']=$imagename;
      $where=array('biller_details.'.'biller_id'=>$this->session->userdata('biller_id'));
      $this->login_model->update_data('biller_details', $data12, $where);
      redirect('biller/biller_profile');
    }
  }
  function biller_consumer()
  {
        $biller_id=$this->session->userdata('biller_id');
        $sql="select * from biller_user where biller_id='".$biller_id."'   group by biller_customer_id_no order by bill_invoice_date DESC";
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
		$url = "http://www.kudisms.net/components/com_spc/smsapi.php?username=abhishek.kumar@efficiencie.com&password=Abhi.ricky@12&sender=OyaCharge&recipient=$mobile&message=" . $encodedMessage;
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
                                                   <img src="http://expertteam.in/Recharge/wassets/images/logo.png" style="padding:10px;" width="130px" class=""/>
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
      $invoice_date=$data[0]->bill_invoice_date;
      $title='Bill Invoice'; 


     // $mpdf = new mPDF();
      $mpdf = new mPDF('utf-8', 'A4', 0, '', -5, -5, -5, -5, 0, 0);
     $html='
     <!DOCTYPE html>
<html lang="en">
  <head>
    
    <title></title>

   
  </head>
  <body>
     
      <table font-family:Helvetica,Helvetica,Arial,sans-serif; cellpadding="0" cellspacing="0" border="0" width="794px" align="center">
         <tr>
            <td>
         <table cellpadding="0" cellspacing="0" border="0" width="100%" align="center" style="background-color:#456776;">
            <tr>
               <td width="50%"> 
                    <img src="'.company_logo."/".$data[0]->biller_company_logo.'" style="padding:10px;" width="50px" class="">
              </td>
              <td width="50%" align="left" style="padding: 10px; text-align:centtre; color: #fff">   '.$title.'
             </td> 
           </tr>
           
         </table>
          <table cellpadding="0" cellspacing="0" border="0" width="100%"  style="padding: 15px">
           <tr>
            <td >
               <table style="padding: 10px">
                    <tr>
                       <td> Biller:'.$data[0]->biller_company_name.'<br> </td> 
                    </tr> 
                     <tr>
                       <td> Service -'.$data[0]->biller_category_name.'<br> </td> 
                    </tr> 
                     <tr>
                       <td> Email:- '.$data[0]->biller_email .'<br> </td> 
                    </tr> 
                     <tr>
                       <td> Phone:-  '.$data[0]->biller_contact_no  .'<br></td> 
                    </tr> 
                    <tr>
                       <td>Consumer No:- '.$data[0]->biller_customer_id_no.'<br></td> 
                    </tr> 
               </table> 
               <table style="padding: 10px; margin-top: 30px;">
                    <tr>
                       <td> Bill To,</td> 
                    </tr> 
                     <tr>
                       <td>  '.$data[0]->biller_user_name.'<br></td> 
                    </tr> 
                     <tr>
                       <td> Email:- '.$data[0]->biller_user_email  .'<br></td> 
                    </tr> 
                     <tr>
                       <td> Phone:- '.$data[0]->biller_user_contact_no  .'<br></td> 
                    </tr> 
                     
               </table> 
            </td> 
             <td style="text-align: right; vertical-align:top; display: block;">
               <table width="100%" style="margin-top:">
                  <tr>
                     <td> <strong> Date:-'.$invoice_date.' </strong> </td> 
                  </tr> 
                   <tr>
                     <td> Invoice No:- '.$data[0]->bill_invoice_no.' </td> 
                  </tr> 
                   <tr>
                     <td> Transaction No:-'.$data[0]->bill_transaction_id.'</td> 
                  </tr> 
                   
             </table> 
            </td> 
           </tr>

         </table>
          <table cellpadding="0" cellspacing="0" width="100%" style="border:1px solid #ccc; margin: 0 20px;">
            <thead>
               <tr>
                  <td style="padding:10px; border-right:1px solid #ccc; border-bottom:1px solid #ccc;"> Product Name </td>
                  <td style="padding:10px;border-right:1px solid #ccc; border-bottom:1px solid #ccc;"> Price per Unit </td>
                  <td style="padding:10px; border-right:1px solid #ccc; border-bottom:1px solid #ccc;"> Product Qty</td>
                <td style="padding:10px; border-bottom:1px solid #ccc;"> Total Price </td> 
               </tr>
            </thead>
            <tbody>';
               if(!empty($data[0]->bill_product_id))
    {
        for($i=0;$i<count($data[0]->bill_product_id); $i++)
        {
      
      $where12=array('biller_invoice_no'=>$data[0]->bill_invoice_no,'find_in_set(biller_invoice_product_id, "'.$data[0]->bill_product_id.'") '=>NULL);
      
      $biller_product = $this->login_model->get_data_where_condition('biller_invoice_products', $where12);
      $total=0;
      foreach ($biller_product as  $value) {
      $total+=($value->biller_invoice_product_price*$value->biller_invoice_product_qty);
               $html .='<tr>
                 <td style="padding:10px; border-right:1px solid #ccc; border-bottom:1px solid #ccc;"> '.$value->biller_invoice_product_name.' </td>
                 <td style="padding:10px; border-right:1px solid #ccc; border-bottom:1px solid #ccc;"> '.$value->biller_invoice_product_price.' </td>
                 <td style="padding:10px; border-right:1px solid #ccc; border-bottom:1px solid #ccc;"> '.$value->biller_invoice_product_qty.' </td>
                 <td style="padding:10px; border-bottom:1px solid #ccc;">'.$value->biller_invoice_product_price*$value->biller_invoice_product_qty.'<img  style="position:relative;top:8px;left:2px;" width="13px" src="http://image.flaticon.com/icons/svg/32/32974.svg"/> </td> 
               </tr>';
             }
                                           
          }                                    
}else{
   $total=$data[0]->bill_amount;
}
              $html .='<tr>
                 <td colspan="4">
                     <table width="100%"> 
                        <tr>
                            <td  style="padding:10px;border-bottom:1px solid #ccc;"> <strong> Total
                       </strong>  </td> 
                       <td  style="padding:10px; text-align:right;  border-bottom:1px solid #ccc;"> <strong> '.$total.'<img  style="position:relative;top:8px;left:2px;" width="13px" src="http://image.flaticon.com/icons/svg/32/32974.svg"/>
                       </strong>  </td>  
                        </tr>
                        <tr>
                           <td colspan="2">Description:  '.$data[0]->bill_description.' </td> 
                        </tr>
                     </table>
                 </td>
                
                 
               </tr>
            </tbody>
         </table>
         <table width="100%" style="padding: 15px; background-color:#ccc; margin: 30px 20px 0;">
             <tr>
                <td style="width: 50%"> 
                     <table>
                         <tr>
                            <td> Bill Consumer No.:  '.$data[0]->biller_customer_id_no.'  </td> 
                         </tr>
                         <tr>
                           <td> via OyaCharge </td>  
                         </tr>
                     </table>
                </td> 
                 <td style="width: 50%"> 
                      <table width="100%">
                         <tr>
                            <td style="text-align: right;"> 
                              <p style="margin: 0"> '.$data[0]->biller_company_name.'<br>
                                              </p> 
                              <p style="margin: 0">  ('.$data[0]->biller_name.') </p> 
                          </td> 
                         </tr>
                     </table>
                 </td>
             </tr> 
         </table>
          </td>
         </tr>
       </table>

  
  </body>
</html>';
 $mpdf->SetHTMLHeader($html);
      
$mpdf->SetHTMLFooter('
<table cellpadding="0" cellspacing="0" border="0" width="794" align="center">
            <tr>
               <td style="background-color:#16262d; padding:15px; text-align:center; color:#fff; font-size:14px;"> 
                    You are receiving this newsletter because you have subscribed to our newsletter.Not interested anymore? 
Unsubscribe instantly.
           </tr>
           <tr>
             <td style="background-color:#456776;text-align:center;color:#fff;font-size:13px; padding:5px;"> 
                <img src="http://expertteam.in/Recharge/wassets/images/powredby.png" style="pdding-top:8px;" width="170px" class=""/>   
              </td>

           </tr>
           <tr>
            <td style="background-color:#456776;text-align:center;color:#fff;font-size:13px; padding:5px;">  
             Address: 8B, Lalupon close, Ikoyi Lagos
              </td> </td> 
           </tr>

         </table>');

//$mpdf->Output(); 
$mpdf->Output('uploads/bill_invoice/'.$data[0]->bill_invoice_no.'.pdf','F');
$bill='././uploads/bill_invoice/'.$data[0]->bill_invoice_no.'.pdf';
return $bill;
}
// add biller user////
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
				  if($bill_desc<=600)
          {
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
          $bill=$this->create_new_pdf($this->input->post("bill_invoice_no")); 
        //  $bill = file_get_contents(SITE_URL . "createpdf/create_pdf/" . $invoice_no);
    			$send_msg=$this->send_bill_user_msg($biller_user_contact_no,$invoice_no,$consumer_no,$amt);
         // $data12['bill_invoice']=$invoice_no.'.pdf';
    			//$this->login_model->update_data('biller_user', $data12, $where);

          

    		  $biller_name=$data[0]->biller_company_name;
    			$message='Your Invoice INV#'.$invoice_no.' '.'of amount Naira'.' '.$amt.' '.' is generated by.'.' '.$biller_name.',Kindly make a payment via OyaCharge';
    			$this->sendElasticEmail($this->input->post("biller_user_email"), 'Bill Invoice of '.$invoice_no,"OyaCharge", $message, "care@oyacharge.com", "OyaCharge",$bill);
    			$this->session->set_flashdata('status','Your Invoice INV#'.$invoice_no.' '.'of amount Naira'.' '.$amt.' '.' is generated successfully');
    			              $this->load->library('email');
                        $this->email->from('care@oyacharge.com', 'OyaCharge');
                        $this->email->to($this->input->post("biller_user_email")); // $cc_admin_email
                        $this->email->subject('Bill Invoice of '.$invoice_no);
                        $this->email->message($message);
                        $this->email->attach($bill);
                        $this->email->send();
                        $this->email->clear(TRUE);
			      $this->session->set_flashdata('status', $message);
             } else {
                $this->session->set_flashdata('error', 'Bill Description between 100 and 600 character');
            }}else {
                $this->session->set_flashdata('error', 'Consumer Number bill already genrated');
            }
			       redirect('biller/consumer_list');
        } else {
        	  $where = array('prodcut_status' => '1','biller_id'=>$this->session->userdata('biller_id'));
            $data['product'] = $this->login_model->get_data_where_condition('biller_produt', $where);
            $data['invoice_no']= strtotime("now").mt_rand(10000000, 99999999);
				    $where=array('biller_user.'.'biller_id'=>$this->session->userdata('biller_id'));
		        $data['consumer_details']  = $this->login_model->get_data_where_condition('biller_user', $where);
		        $biller_id=$this->session->userdata('biller_id');
				    $data['biller_details']=$this->biller_required_detils();
    	      
            $this->load->view('new_biller/header');
            $this->load->view('new_biller/sidebar',$data);
            $this->load->view('new_biller/addinvoice',$data);
			      $this->load->view('new_biller/footer');
        }
}
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
    }
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
// edit bill user 
      function edit_bill_user() {
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
                    $this->load->view('biller/menu');
            $this->load->view('biller/header');
            $this->load->view('biller/add/add_bill_user',$data);
            $this->load->view('biller/footer');
            } else {
                redirect('biller/consumer_list');
            }
        }
    }
    function logout() {
        $this->session->sess_destroy();
         $Location = base_url('biller_login');
         header('Location:'.$Location);
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
					redirect('biller/upload_consumer_list');
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
							redirect('biller/upload_consumer_list');
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
							$invoice_no= strtotime("now").mt_rand(11, 99); 
							 
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
        	//$pdf->Output('/var/www/html/Recharge/uploads/invoice'.'/'.$consumer_no.'.pdf','F');
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
							redirect('biller/consumer_list');
					} else {
						
						$message = "Error in response!";
						$this -> session -> set_flashdata('error', $message);
						redirect('biller/upload_consumer_list');
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
	// function add product----->>
	function add_product(){
		if($this->input->post('submit')){
			 $data = $this->input->post();
            unset($data['submit']);
            unset($data['product_id']);
			//$data['status']=1;
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
							$A = trim($allDataInSheet[$i]["A"]);
							$B=trim($allDataInSheet[$i]["B"]);
							$C = trim($allDataInSheet[$i]["C"]);
							$current_date=date("Y-m-d");
							$product_code=substr($A, 0, 5).strtotime("now").mt_rand(100000, 999999);
							 
						   $plan_data = array("biller_id"=>$biller_id,"product_name"=>$A,"product_code"=>$product_code,"product_price"=>$B,"product_desc"=>$C,"product_created_date"=>$current_date);
	
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
                $message = 'Bill user deleted successfully!!';
                $this->session->set_flashdata('error', $message);
                redirect('biller/consumer_list');
            }
            if ($delete_type == 'delete_product') {
                $message = 'product deleted successfully!!';
                $this->session->set_flashdata('error', $message);
                redirect('biller/product_list');
            }
			 if ($delete_type == 'delete_branch') {
                $message = 'Branch deleted successfully!!';
                $this->session->set_flashdata('error', $message);
                redirect('Branches');
            }
        } else {
            redirect('biller');
        }
    }
	 // function church product list
	 function church_product_list()
	 {
	 	$biller_id=$this->session->userdata('biller_id');
	 	$where = array('biller_product_id' => $biller_id);
        $data['product_details'] = $this->login_model->get_data_where_condition('church_product', $where);
	 	
			$where22=array('biller_id'=>$biller_id);
			$data['biller_details'] = $this->login_model->get_record_join_two_table('biller_details', 'biller_category', 'biller_category_id', 'biller_category_id','*',$where22); 
			$this->load->view('biller/menu',$data);
			$this->load->view('biller/header');
            $this->load->view('biller/listing/church_product_list_view');
            $this->load->view('biller/footer');
		
	 }
	 function church_add_product()
	 {
	 	if ($this->input->post('submit')) {
           $data = $this->input->post();
            unset($data['submit']);
			$data['biller_product_id']=$this->session->userdata('biller_id');
			$this->login_model->insert_data('church_product', $data);
                $this->session->set_flashdata('status', 'Prodcut  added successfully');
           
            redirect('biller/church_product_list');
        } else {
	 	$where22=array('biller_id'=>$this->session->userdata('biller_id'));
			$data['biller_details'] = $this->login_model->get_record_join_two_table('biller_details', 'biller_category', 'biller_category_id', 'biller_category_id','*',$where22); 
			$this->load->view('biller/menu',$data);
			$this->load->view('biller/header');
            $this->load->view('biller/add/church_add_product');
            $this->load->view('biller/footer');
			
			}
	 }
	 // church list
	  function church_list()
	 {
	 		$where = array('church_biller_id' => $this->session->userdata('biller_id'));
        	$data['branch_list'] = $this->login_model->get_record_join_two_table('church_area', 'church_list', 'church_id', 'church_id','*',$where); 
			$data['biller_details']=$this->biller_required_detils();
			$this->load->view('biller/menu',$data);
			$this->load->view('biller/header');
            $this->load->view('biller/listing/church_list',$data);
            $this->load->view('biller/footer');
		
	 }

   // add branch of church
     function add_branch()
   {
    if ($this->input->post('submit')) {
      $biller_id=$this->session->userdata('biller_id');
           $data = $this->input->post();
      
      if(!empty($data['church_product_id']))
      {
              
      unset($data['submit']);
       $where=array('church_biller_id'=>$this->session->userdata('biller_id'));
        $church_record = $this->login_model->get_data_where_condition('church_list', $where);
        $church_areaID=$church_record[0]->church_area_ids;
        $church_id=$church_record[0]->church_id;

      if ($_FILES['church_img']['name']) {
                $user_image = $_FILES['church_img']['name'];
            }
            $attachment = $_FILES['church_img']['name'];

            if (!empty($attachment)) {
                $file_extension = explode(".", $_FILES["church_img"]["name"]);
                $new_extension = strtolower(end($file_extension));
                $today = time();
                $custom_name = "church" . $today;
                $file_name = $custom_name . "." . $new_extension;

                if ($new_extension == 'png' || $new_extension == 'jpeg' || $new_extension == 'jpg' || $new_extension == 'bmp') {
                    move_uploaded_file($_FILES['church_img']['tmp_name'], "./uploads/church_image/" . $file_name);
                    $imagename = $file_name;
                } else {
                    $this->session->set_flashdata('error', 'Invalid Image type');
                    redirect('Branches');
                }
              $data12['church_area_img'] = $imagename;
            }
        $data12['church_id']=$church_id;
        $data12['church_area_created']=date("Y-m-d H:i:s");
        $data12['church_product_ids']=implode(",",$data['church_product_id']);
        $data12['church_area']    =$data['church_area'];
        $area_id=$this->login_model->insert_data('church_area', $data12);
       
        $data211['church_area_ids']=$church_areaID.",".$ids_area;
        $w=array('church_id'=>$church_id);
        $this->login_model->update_data('church_list', $data211, $w);
        $this->session->set_flashdata('status', 'Branch add successfully');
       redirect('Branches');
    
      }else{
         $this->session->set_flashdata('error', 'Please Select atleast one product');
      }
            redirect('Branches');
      }
         else {
            $where = array('church_product_status' => '1','biller_product_id'=>$this->session->userdata('biller_id'));
            $data['product_details'] = $this->login_model->get_data_where_condition('church_product', $where);
            $where22=array('biller_id'=>$this->session->userdata('biller_id'));
            $data['biller_details'] = $this->login_model->get_record_join_two_table('biller_details', 'biller_category', 'biller_category_id', 'biller_category_id','*',$where22); 
            $this->load->view('biller/menu',$data);
            $this->load->view('biller/header');
            $this->load->view('biller/add/add_church');
            $this->load->view('biller/footer');
      
      }
   }
	 //add church
	  function add_church()
	 {
	 	if ($this->input->post('submit')) {
      $biller_id=$this->session->userdata('biller_id');
           $data = $this->input->post();
			
			if(!empty($data['church_product_id']))
			{
							
			$church_name=$data['church_name'];
			$where=array('church_name'=>$church_name);
			$church_record = $this->login_model->get_data_where_condition('church_list', $where);
			if(empty($church_record)){
            unset($data['submit']);
				
			for($i=0;$i<count($data['church_product_id']); $i++)
		{
			$where12=array('find_in_set(church_product_id, "'.$data['church_product_id'][$i].'") '=>NULL);
			$church_product = $this->login_model->get_data_where_condition('church_product', $where12);
			$name[]=$church_product[0]->church_product_name;
		}		  
			$data1['church_product_name']=implode(",",$name);
			
				$data1['church_product_id']=implode(",",$data['church_product_id']);
			if ($_FILES['church_img']['name']) {
                $user_image = $_FILES['church_img']['name'];
            }
            $attachment = $_FILES['church_img']['name'];

            if (!empty($attachment)) {
                $file_extension = explode(".", $_FILES["church_img"]["name"]);
                $new_extension = strtolower(end($file_extension));
                $today = time();
                $custom_name = "church" . $today;
                $file_name = $custom_name . "." . $new_extension;

                if ($new_extension == 'png' || $new_extension == 'jpeg' || $new_extension == 'jpg' || $new_extension == 'bmp') {
                    move_uploaded_file($_FILES['church_img']['tmp_name'], "./uploads/church_image/" . $file_name);
                    $imagename = $file_name;
                } else {
                    $this->session->set_flashdata('error', 'Invalid Image type');
                    redirect('biller/church_list');
                }
				      $data1['church_img'] = $imagename;
            }
			     $data1['church_name']=$data['church_name'];
           $data1['church_created_date']=date("Y-m-d");
		  $where212221=array('biller_id'=>$this->session->userdata('biller_id'));
			$biller_details =$this->login_model->get_data_where_condition('biller_details', $where212221); 
			$data1['church_category']=$biller_details[0]->biller_category_id;
		   $data1['church_biller_id']=$this->session->userdata('biller_id');
		 $data1['church_city']=$data['church_city'];
			$church_id=$this->login_model->insert_data('church_list', $data1);
			$curdatetime=date("Y-m-d H:i:s");
			for($l=0;$l<count($data['church_area']);$l++)
			{
				$data12['church_area']=$data['church_area'][$l];
				$data12['church_area_created']=$curdatetime;
				$data12['church_id']=$church_id;
				$area_id[]=$this->login_model->insert_data('church_area', $data12);
			}
			 $ids_area=implode(",",$area_id);
			 $data211['church_area_ids']=$ids_area;
			 $w=array('church_id'=>$church_id);
			 $this->login_model->update_data('church_list', $data211, $w);
       $this->session->set_flashdata('status', 'Church add successfully');
       redirect('biller/church_list');
			}else{
				 $this->session->set_flashdata('error', 'These name of church already exist');
			}
			}else{
				 $this->session->set_flashdata('error', 'Please Select atleast one product');
			}
            redirect('biller/church_list');
			}
         else {
        	 $where = array('church_product_status' => '1','biller_product_id'=>$this->session->userdata('biller_id'));
            $data['product_details'] = $this->login_model->get_data_where_condition('church_product', $where);
	 		$where22=array('biller_id'=>$this->session->userdata('biller_id'));
			$data['biller_details'] = $this->login_model->get_record_join_two_table('biller_details', 'biller_category', 'biller_category_id', 'biller_category_id','*',$where22); 
			$this->load->view('biller/menu',$data);
			$this->load->view('biller/header');
            $this->load->view('biller/add/add_church');
            $this->load->view('biller/footer');
			
			}
	 }
	function edit_church() {
        if ($this->input->post('submit')) {
            $data = $this->input->post();
            $where = array('church_id' => $this->input->post('church_id'));
            unset($data['church_id']);
            unset($data['submit']);
           	for($i=0;$i<count($data['church_product_id']); $i++)
		{
			$where12=array('find_in_set(church_product_id, "'.$data['church_product_id'][$i].'") '=>NULL);
			$church_product = $this->login_model->get_data_where_condition('church_product', $where12);
			$name[]=$church_product[0]->church_product_name;
		}		  
	
			$data['church_product_name']=implode(",",$name);
			
				$data['church_product_id']=implode(",",$data['church_product_id']);
		  
	   		$user_image = '';
			if ($_FILES['church_img']['name']) {
                $user_image = $_FILES['church_img']['name'];
            }
            $attachment = $_FILES['church_img']['name'];

            if (!empty($attachment)) {
                $file_extension = explode(".", $_FILES["church_img"]["name"]);
                $new_extension = strtolower(end($file_extension));
                $today = time();
                $custom_name = "church_img" . $today;
                $file_name = $custom_name . "." . $new_extension;

                if ($new_extension == 'png' || $new_extension == 'jpeg' || $new_extension == 'jpg' || $new_extension == 'bmp') {
                    move_uploaded_file($_FILES['church_img']['tmp_name'], "./uploads/church_image/" . $file_name);
                    $imagename = $file_name;
                } else {
                    $this->session->set_flashdata('error', 'Invalid Image type');
                    redirect('admin/church_list');
                }
				 $data['church_img'] = $imagename;
            }
           
                unset($data['church_id']);
                unset($data['submit']);
                $this->login_model->update_data('church_list', $data, $where);
                $this->session->set_flashdata('status', 'Church Update successfully');
             // } else {
                // $this->session->set_flashdata('error', 'Recharge Category already exist');
            // }

            redirect('biller/church_list');
        } else {
            $category_id = $this->uri->segment(3);
            if (!empty($category_id)) {
			$where = array('church_product_status' => '1','biller_product_id'=>$this->session->userdata('biller_id'));
            $data['product_details'] = $this->login_model->get_data_where_condition('church_product', $where);
	 	$where22=array('biller_id'=>$this->session->userdata('biller_id'));
			$data['biller_details'] = $this->login_model->get_record_join_two_table('biller_details', 'biller_category', 'biller_category_id', 'biller_category_id','*',$where22); 
                $where = array('church_id' => $category_id);
                $data['church_details'] = $this->login_model->get_data_where_condition('church_list', $where);
               	$this->load->view('biller/menu',$data);
			$this->load->view('biller/header');
            $this->load->view('biller/add/add_church',$data);
            $this->load->view('biller/footer');
            } else {
                redirect('biller/church_list');
            }
        }
    }
function biller_required_detils()
{
	$where22=array('biller_id'=>$this->session->userdata('biller_id'));
	$biller_details = $this->login_model->get_record_join_two_table('biller_details', 'biller_category', 'biller_category_id', 'biller_category_id','*',$where22); 
	return $biller_details;
}
function donation_list()
{
	  		$data['biller_details']=$this->biller_required_detils();
        $biller_id=$this->session->userdata('biller_id');
	  		//print_r($data['biller_details']);die;
			//$where22=array('church_donate.church_biller_id'=>$this->session->userdata('biller_id'));
		//	$data['donation_details'] = $this->login_model->get_data_join_four_tabel_where_group('church_donate', 'church_list','user','church_product', 'church_id', 'donate_church_id','user_id','donate_user_id','church_product_id','church_p_id','church_donate_id',$where22,'church_list.church_name,user.user_name,user.user_email,user.user_contact_no, church_product.church_product_name, church_donate.church_product_price,church_donate.donate_datetime,church_list.church_img,church_donate.payment_status'); 
		//echo "<pre>";print_r($data['donation_details']);die;
    $donatesql="SELECT `church_donate`.*, user.user_email as useremail,user.user_name as username,user.user_contact_no as user_contact,church_area.church_area as branch_area,church_area.church_area_img as church_img FROM `church_donate`  join user on user.user_id=church_donate.donate_user_id join church_area on church_area.church_area_id=church_donate.church_area_id where church_biller_id='".$biller_id."'  order by church_donate_id DESC";
    $data['donation_details']=$this->login_model->get_simple_query($donatesql);
			$this->load->view('biller/menu',$data);
			$this->load->view('biller/header');
            $this->load->view('biller/listing/donation_list',$data);
            $this->load->view('biller/footer');
}
//===============event ============
///////=======Event part============//
function event_tickets()
{
		$data['biller_details']=$this->biller_required_detils();
			$where = array('events_biller_id'=>$this->session->userdata('biller_id'));
            $data['events_tickets'] = $this->login_model->get_data_where_condition('events_tickets', $where);
			
			$this->load->view('biller/menu',$data);
			$this->load->view('biller/header');
            $this->load->view('biller/listing/event_tickets',$data);
            $this->load->view('biller/footer');
}
 function add_event_ticket()
	 {
	 	if ($this->input->post('submit')) {
           $data = $this->input->post();
            unset($data['submit']);
			$data['events_biller_id']=$this->session->userdata('biller_id');
			$user_image = '';
			if ($_FILES['events_tickets_image']['name']) {
                $user_image = $_FILES['events_tickets_image']['name'];
            }
            $attachment = $_FILES['events_tickets_image']['name'];

            if (!empty($attachment)) {
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
                    redirect('biller/event_tickets');
                }
				 $data['events_tickets_image'] = $imagename;
            }
			$this->login_model->insert_data('events_tickets', $data);
                $this->session->set_flashdata('status', 'Ticket added successfully');
           
            redirect('biller/event_tickets');
        } else {
	 $data['biller_details']=$this->biller_required_detils();
			$this->load->view('biller/menu',$data);
			$this->load->view('biller/header');
            $this->load->view('biller/add/add_event_tickets');
            $this->load->view('biller/footer');
			
			}
	 }
function event_list()
{
	
		$sql="SELECT count(*) as past_event  FROM event_list WHERE  event_end_date < NOW() and event_biller_id='".$this->session->userdata('biller_id')."'"; 
		$data['past_event']=$this->login_model->get_simple_query($sql);
		 $sql="SELECT count(*) as start_event  FROM event_list WHERE event_date <= NOW() and event_end_date >= NOW() and event_biller_id='".$this->session->userdata('biller_id')."'"; 
		$data['start_event']=$this->login_model->get_simple_query($sql);
		 $sql="SELECT count(*) as upcoming_event  FROM event_list WHERE event_date > NOW() and event_end_date >= NOW() and event_biller_id='".$this->session->userdata('biller_id')."'"; 
		$data['upcoming_event']=$this->login_model->get_simple_query($sql);
		 $sql="SELECT count(*) as total_event  FROM event_list where event_biller_id='".$this->session->userdata('biller_id')."'"; 
		$data['total_event']=$this->login_model->get_simple_query($sql);
	
	
			$data['biller_details']=$this->biller_required_detils();
			$where = array('events_biller_id'=>$this->session->userdata('biller_id'));
            $data['events_tickets'] = $this->login_model->get_data_where_condition('events_tickets', $where);
			$where = array('event_biller_id'=>$this->session->userdata('biller_id'));
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
	
			
			$this->load->view('biller/menu',$data);
			$this->load->view('biller/header');
            $this->load->view('biller/listing/event_list',$data);
            $this->load->view('biller/footer');
			
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
			
				$name[]=$biller_product[0]->events_tickets_name 	;
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
				
			if ($_FILES['event_image']['name']) {
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
                    redirect('biller/event_list');
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
			$data1['event_biller_id']	       =	$this->session->userdata('biller_id');
			$data1['event_total_tickets']    =		$total_tkt;
      $data1['event_category']         =  $data['event_category'];
		
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
           
            redirect('biller/event_list');
            }else{
            	 $this->session->set_flashdata('error', 'Sorry!! Please Select ticket limit of ticket');
            }
			}else{
				 $this->session->set_flashdata('status', 'Please Select atleast one ticket');
			}
            redirect('biller/event_list');
			}
         else {
        	 $data['biller_details']=$this->biller_required_detils();
			$where = array('events_biller_id'=>$this->session->userdata('biller_id'));
            $data['events_tickets'] = $this->login_model->get_data_where_condition('events_tickets', $where);
			$where1 = array('biller_id'=>$this->session->userdata('biller_id'));
            $biller = $this->login_model->get_data_where_condition('biller_details', $where1);
			$where12=array('find_in_set(biller_category_id, "'.$biller[0]->biller_category_id.'") '=>NULL);
			
			$biller_category = $this->login_model->get_data_where_condition('biller_category', $where12);
			$data['biller_category']=$biller_category;
			$this->load->view('biller/menu',$data);
			$this->load->view('biller/header');
            $this->load->view('biller/add/add_event',$data);
            $this->load->view('biller/footer');
			
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
			
			$where1 = array('biller_id'=>$this->session->userdata('biller_id'));
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
function booking_ticket()
{
	$event_id = $this->uri->segment(3);
	$biller_id=$this->session->userdata('biller_id');
	$where=array('event_biller_id'=>$biller_id,'booking_event_id'=>$event_id);
	$data['booking_user'] = $this->login_model->get_record_join_two_table('booking_event_tickets', 'user', 'booking_user_id', 'user_id','*',$where); 
	//$data['booking_user'] = $this->login_model->get_data_where_condition('booking_event_tickets1', $where);
		
	$data['biller_details']=$this->biller_required_detils();
			$this->load->view('biller/menu',$data);
			$this->load->view('biller/header');
            $this->load->view('biller/listing/ticket_booking_records',$data);
            $this->load->view('biller/footer');
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
			$data['biller_details']=$this->biller_required_detils();
			$where = array('events_biller_id'=>$this->session->userdata('biller_id'));
            $data['events_tickets'] = $this->login_model->get_data_where_condition('events_tickets', $where);
		 $sql="SELECT * FROM `wallet_transaction` join booking_event_tickets on booking_event_tickets.transaction_id=wallet_transaction.`transaction_id` join user on user.user_id=wallet_transaction.`wt_user_id` join event_list on event_list.event_id=booking_event_tickets.booking_event_id   where `booking_event_tickets`.`event_biller_id`='".$this->session->userdata('biller_id')."' order by wt_id DESC";
	    $data['transaction_record']=$this->login_model->get_simple_query($sql);

		$this->load->view('biller/menu',$data);
        $this->load->view('biller/header');
        $this->load->view('biller/listing/transaction_list_view', $data);
        $this->load->view('biller/footer');
}
	function event_perticuler_transaction(){
			$data['biller_details']=$this->biller_required_detils();
			$where = array('events_biller_id'=>$this->session->userdata('biller_id'));
            $data['events_tickets'] = $this->login_model->get_data_where_condition('events_tickets', $where);
   		$trans_id = $this->uri->segment(3);
   		$user_id = $this->uri->segment(4);
		$where=array('wt_user_id'=>$user_id,'wt_id'=>$trans_id);
		$sql="SELECT * FROM `wallet_transaction` join booking_event_tickets on booking_event_tickets.transaction_id=wallet_transaction.`transaction_id` join user on user.user_id=wallet_transaction.`wt_user_id` join event_list on event_list.event_id=booking_event_tickets.booking_event_id   where `booking_event_tickets`.`event_biller_id`='".$this->session->userdata('biller_id')."' and wallet_transaction.wt_user_id='".$user_id."' and wallet_transaction.wt_id='".$trans_id."'";
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