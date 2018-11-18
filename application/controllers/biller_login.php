
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Biller_login extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('login_model');
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->library('session');
        $this->output->set_header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
		$this->output->set_header("Cache-Control: post-check=0, pre-check=0", false);
		$this->output->set_header("Pragma: no-cache");  
        if ($this->session->userdata('user_id') == TRUE) {
            redirect('biller');
        }
    }

    public function index() {
        if($this->input->post()){
           
           
                $user_table = 'biller_details';
                $where = array('biller_email'=>  $this->input->post('biller_email'),'biller_password'=>  md5($this->input->post('biller_password')));
                $admin_details = $this->login_model->get_record_where($user_table,$where);
				if($admin_details == FALSE){
                    $data['error'] = 'Invalid Email or Password';
                    $message = "Invalid Email or Password";
                    $this -> session -> set_flashdata('error', $message);
                   redirect('biller_login');      
                } else {
                     $where_user     = array('biller_id'=>  $admin_details[0]->biller_id);
                     $biller_details = $this->login_model->get_record_where('user',$where_user); 
                    if(empty($biller_details[0]->qr_code))
                     {

                          $this->load->library('ciqrcode');
                           $qr_image               = $biller_details[0]->user_contact_no.'.png';
                            $params['data']         = $biller_details[0]->user_contact_no;
                            $params['level']        = 'H';
                            $params['size']         = 8;
                            $params['savename']     = $_SERVER['DOCUMENT_ROOT'].'/uploads/QR_Code/'.$qr_image;
                            if($this->ciqrcode->generate($params))
                            {
                                $where321= array('user_id'=>$biller_details[0]->user_id,'biller_id'=>$admin_details[0]->biller_id);
                                $data211222['qr_code'] = $qr_image;
                                $this->login_model->update_data('user', $data211222, $where321);
                            }
                     }
                     	if($admin_details[0]->email_verify_status==2)
	                	{
	                	  $message = "Please Verife your Email. check your email for activation link.";
                          $biller_status12=2;
	                	}else
	                	if(empty($admin_details[0]->bank_code))
	                	{
	                	  $message = "Please complete your profile for admin review and approval.";
                          $biller_status12=2;
	                	}elseif($admin_details[0]->biller_status==2)
	                	{
	                		 $message = "Your account is in under review of admin. Please wait for admin approval.!";
                             $biller_status12=2;
	                   }else{
	                   	if($admin_details[0]->verify_msg_read_status==2)
						{
	                   		$message = "Hello ".$admin_details[0]->biller_name.". Your account is approved from OyaCharge.! ";
	                   		$where_user= array('biller_id'=>$admin_details[0]->biller_id);
                    		$data21['verify_msg_read_status']=1;
                     		$this->login_model->update_data('biller_details', $data21, $where_user);
                            $biller_status12=2;
						}else{
							$message ='';
                            $biller_status12=1;
						}
					  }
                    
                    $this -> session -> set_flashdata('success', $message);
                	 $biller_type= $admin_details[0]->biller_type;
                     if($biller_type==1)
                    {
                        $this->session->set_userdata(array('biller_id'=>$admin_details[0]->biller_id,'biller_email'=>$admin_details[0]->biller_email,'biller_status'=>$admin_details[0]->biller_status,'user_id'=>$biller_details[0]->user_id,'approve_status'=>$biller_status12)); 
                        redirect('biller');
                    }else if($biller_type==2)
                    {
                        $this->session->set_userdata(array('church_biller_id'=>$admin_details[0]->biller_id,'biller_email'=>$admin_details[0]->biller_email,'biller_status'=>$admin_details[0]->biller_status,'user_id'=>$biller_details[0]->user_id,'approve_status'=>$biller_status12)); 
                        redirect('church');
                    }else if($biller_type==3)
                    {
                        $this->session->set_userdata(array('event_biller_id'=>$admin_details[0]->biller_id,'biller_email'=>$admin_details[0]->biller_email,'biller_status'=>$admin_details[0]->biller_status,'user_id'=>$biller_details[0]->user_id,'approve_status'=>$biller_status12)); 
                        redirect('event');
                    }
                    
                }
        
        } else {
            $this->load->view('new_biller/login_header');
            $this->load->view('new_biller/index');
            $this->load->view('new_biller/login_footer');
        }
    }
    function merchant()
    {
            $this->load->view('new_biller/login_header');
            $this->load->view('new_biller/merchant');
            $this->load->view('new_biller/login_footer');
    }
     function merchant_pos()
    {
            $this->load->view('new_biller/login_header');
            $this->load->view('new_biller/merchant-pos');
            $this->load->view('new_biller/login_footer');
    }
    function about()
    {
    	$this->load->view('new_biller/login_header');
            $this->load->view('new_biller/about');
            $this->load->view('new_biller/login_footer');
    }
    function register()
    {
        if(!empty($this->input->post()))
        {
                $data           = $this->input->post();
                $where          = array('biller_email'=>  $this->input->post('biller_email'),'email_verify_status'=>1);
                $biller_details = $this->login_model->get_record_where('biller_details',$where);
                if(!empty($biller_details))
                {
                    $message    = "These Email ID already exist";
                    $this -> session -> set_flashdata('error', $message);
                    redirect('biller_login/register');
                }
              
                unset($data['signup']);
                $data['biller_original_pass']= $data['biller_password'];
                $data['biller_password']     = md5($data['biller_password']);
                $data['biller_created_date'] = date("Y-m-d H:i:s");
                $biller_category_name        = $data['biller_category_name'];
             //   $where_biller_cat            = array('biller_category_name'=>$biller_category_name);
             //   $biller_category             = $this->login_model->get_record_where('biller_category',$where_biller_cat);
                // if(empty($biller_category))
                // {
                //     $data2121['biller_category_name'] = $biller_category_name;
                //     $data2121['category'] = $data['biller_type'];
                //     $biller_Cat           = $this->login_model->insert_data('biller_category', $data2121);
                // }else{
                    $biller_Cat           = $biller_category_name;
               // }
                unset($data['biller_category_name']);
                $data['biller_category_id']=$biller_Cat;
                $data['biller_reg_type']=3;
                $idbillUser=$this->login_model->insert_data('biller_details', $data);
                 $where_user          = array('user_email'=>  $this->input->post('biller_email'),
                 	'user_contact_no'=>$this->input->post('biller_contact_no'));
                $biller_details = $this->login_model->get_record_where('user',$where_user); 
                if(empty($biller_details))
                {
                	$data12['user_email']      = $this->input->post('biller_email');
                	$data12['user_contact_no'] =  $this->input->post('biller_contact_no');
                	$data12['user_name']       =  $this->input->post('biller_company_name');
                	$data12['user_ip_address'] =  $_SERVER['REMOTE_ADDR'];
                	$data12['biller_id']       =   $idbillUser;
                	$data12['user_created_date'] =  date("Y-m-d H:i:s");
                    $ref                    =   substr($this->input->post('biller_email'),0,3);	
                    $random                 =   rand(111,333);
                    $reffer                 =   substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 2);
                     $reffer_code           =   strtoupper($ref.$random.$reffer);
                     $data12['user_refferal_code'] = $reffer_code;
                    $user_phone             = $this->input->post('biller_contact_no');
                    $this->load->library('ciqrcode');
                    $qr_image               = $this->input->post('biller_contact_no').'.png';
                    $params['data']         = $this->input->post('biller_contact_no');
                    $params['level']        = 'H';
                    $params['size']         = 8;
                    $params['savename']     = $_SERVER['DOCUMENT_ROOT'].'/uploads/QR_Code/'.$qr_image;
                    if($this->ciqrcode->generate($params))
                    {
                        $data12['qr_code'] = $qr_image;
                        
                    }
                    $data12['biller_status'] = 2;
                	$user_id=$this->login_model->insert_data('user', $data12);

                }else{
                     $where_user1= array('user_id'=>$biller_details[0]->user_id);

                     if(empty($biller_details[0]->qr_code))
                     {
                          $this->load->library('ciqrcode');
                           $qr_image               = $biller_details[0]->user_contact_no.'.png';
                            $params['data']         = $biller_details[0]->user_contact_no;
                            $params['level']        = 'H';
                            $params['size']         = 8;
                            $params['savename']     = $_SERVER['DOCUMENT_ROOT'].'/uploads/QR_Code/'.$qr_image;
                            if($this->ciqrcode->generate($params))
                            {
                                $data2112['qr_code'] = $qr_image;
                                
                            }
                     }
                     $data2112['biller_id']=$idbillUser;
                     $this->login_model->update_data('user', $data2112, $where_user1);
                }

                 $this->session->set_userdata(array('biller_id'=>$idbillUser,'biller_email'=>$data['biller_email'],'biller_status'=>2)); 
                $message = "Your account is successfully created. Verify link send to your registered email. Please verify your email";
                    $this -> session -> set_flashdata('success', $message);
                    $this->send_verification_mail($data['biller_company_name'],$data['biller_email']);
                     if($data['biller_type']==1)
                    {
                         $Location = base_url('biller');
                    }else if($data['biller_type']==2)
                    {
                            $data1['church_name']=$data['biller_company_name'];
                            $data1['church_created_date']=date("Y-m-d");
                            $where212221=array('biller_id'=>$idbillUser);
                            $biller_details =$this->login_model->get_data_where_condition('biller_details', $where212221); 
                            $data1['church_category']=$biller_details[0]->biller_category_id;
                            $data1['church_biller_id']=$idbillUser;
                            $church_id=$this->login_model->insert_data('church_list', $data1);
                            $this->session->set_userdata(array('church_id'=>$church_id)); 
                          $Location = base_url('church');
                    }else if($data['biller_type']==3)
                    {
                          $Location = base_url('event');
                    }
                     header('Location:'.$Location);
        }else{
             $this->load->view('new_biller/login_header');
             $this->load->view('new_biller/register');
             $this->load->view('new_biller/login_footer');
        }
    }
    function get_biller_category()
    {
        $biller_type = $_REQUEST['biller_type'];
        $where = array('category'=>$biller_type,'biller_category_status'=>1);
        $data['biller_cat'] =$this->login_model->get_data_where_condition('biller_category', $where); 
       $this->load->view('new_biller/biller_category',$data);

    }
function get_user_details()
  {
    $email_phone = $_REQUEST['email_phone'];
    $type = $_REQUEST['type'];  //1 for email check
    if($type==1)
    {
      $where = array('user_email'=>$email_phone);
    }else if($type==2) //2 for mobile check
    {
      $where = array('user_contact_no'=>$email_phone);
    }
    $billerDetals = $this->login_model->get_data_where_condition('user', $where);
    if(!empty($billerDetals))
    {
      echo "1";
    }else{
      echo "2";
    }

  }
    function send_verification_mail($user_name,$user_email)
    {
        $path = base_url('biller_login');
    $path1=base_url('biller_assets/img/logo_1.png');
    $subject = 'Email verification link';
    
        
        $mail_msg = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
                <a href="#" style="margin-left:200px;"><img width="200" src="'.$path1.'" alt="..."/></a>
                
            </td>
        </tr>
    </thead>
    <tbody style=" border-bottom:1px solid #ddd;">
        <tr>
            <td style="padding:10px 15px;">
                <h1 style="margin-bottom:0px; color:#5BBE4F;">Dear ' . ucfirst($user_name) .  '</h1></br>
                Thank you for registering with Us. Before we can activate your account one last step must be taken to complete your registration!<br/><br/>
        Please note - you must complete this last step to become a registered member. You will only need to click on the link once, and your account will be updated.<br/>
        To complete your registration, click on the link below:<br/><br/>
        <div style="padding:20px; background-color: #70a93c; color:#fff; text-align:center;"><a href=' . $path . "/verify_email?email=" . base64_encode($user_email) . '>Please click here activate your accout</a></div>
         
                
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
            <td style="color:#666;"><p>© 2018, Oyacharge.com . All rights reserved by Oyacharge. </p></td>
        <tr>
    </tfoot>
    
</table>
</body>
</html>';

       $this->sendElasticEmail($user_email, $subject,"OyaCharge", $mail_msg, "care@oyacharge.com", "OyaCharge",'');
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
    function verify_email()
    {
      $params   = $_SERVER['QUERY_STRING'];
      $email    = str_replace("email=","",$params);
      $user_email = base64_decode($email);
      $where =array('biller_email'=>$user_email);
      $biller_details = $this->login_model->get_record_where('biller_details',$where);
                if(!empty($biller_details))
                {
                   $biller_id =$biller_details[0]->biller_id;
                   $data['email_verify_status'] = 1;
                    $this->login_model->update_data('biller_details', $data, $where);

                    $where_user= array('biller_id'=>$biller_id);
                    $data21['user_email_verify']=1;
                     $this->login_model->update_data('user', $data21, $where_user);

                    $this->session->set_userdata(array('biller_id'=>$biller_id,'biller_email'=>$user_email)); 
                    $message = "Your Email account is successfully verified. Please complete your profile.";
                    $this -> session -> set_flashdata('success', $message);
                    $Location = base_url('biller');
                    header('Location:'.$Location);
                }else{
                    echo "Error in approve email verification. Please Try Again.";
                }
    }
     function forgot_password(){
        if($this->input->post('send')){
            
                $email = $this->input->post('biller_email');
                $where = array('biller_email' => $email);
                $check_email = $this->login_model->get_record_where('biller_details', $where);
                if(!empty($check_email)){
                    $password = time();
                    $data = array('biller_password' => md5($password),'biller_original_pass'=>$password);
                    $update = $this->login_model->update_data('biller_details', $data, $where);
                    $message = "Your Password Update Successfully.
                    Your new password for login:" . $password;
                    // $this->load->library('email');
                    // $this->email->from('care@oyacharge.com', 'Oyacharge');
                    // $this->email->to($email);
                    // $this->email->subject('New Password : Oyacharge');
                    // $this->email->message($message);
                    // $this->email->set_mailtype("html");
                    // $this->email->send();
                    $this->sendElasticEmail($email,'New Password : Oyacharge', $message, '', 'care@oyacharge.com', 'Oyacharge','');
                    $message = "Password Update Successfully. Please check your mail";
                    $this -> session -> set_flashdata('success', $message);
                    redirect('biller_login'); 
                } else {
                     $message = "Invalid Email id";
                    $this -> session -> set_flashdata('error', $message);
                    redirect('biller_login');      
                }
          
        } else {
             redirect('biller_login');   
        }
    } 
}