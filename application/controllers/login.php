<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('login_model');
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->library('session');
        if ($this->session->userdata('userid') == TRUE) {
            redirect('admin');
        }
    }

    public function index() {
        if($this->input->post('login')){
            $this->form_validation->set_error_delimiters('<span class="validate-has-error">', '</span>');
            if ($this->form_validation->run('login') == FALSE)
            {
                $this->load->view('admin/login_view');
            }
            else
            {
                $user_table = 'admin';
                $where = array('admin_email'=>  $this->input->post('user_email'),'admin_password'=>  md5($this->input->post('user_password')));
                $admin_details = $this->login_model->get_record_where($user_table,$where);
                if($admin_details == FALSE){
                    $data['error'] = 'Invalid Email or Password';
                    $this->load->view('admin/login_view',$data);
                } else {
                    $this->session->set_userdata(array('userid'=>$admin_details[0]->admin_id,'user_email'=>$admin_details[0]->admin_email)); 
                    redirect('admin');
                }
            }
        } else {
            $this->load->view('admin/login_view');
        }
    }
    
    /* function forgot_password(){
        if($this->input->post('send')){
            $this->form_validation->set_error_delimiters('<span class="validate-has-error">', '</span>');
            if ($this->form_validation->run('forgot_pass') == FALSE){
                $this->load->view('admin/forgot_password_view');
            } else {
                $email = $this->input->post('user_email');
                $where = array('admin_email' => $email);
                $check_email = $this->login_model->get_record_where('admin', $where);
                if(!empty($check_email)){
                    $password = time();
                    $data = array('admin_password' => md5($password));
                    $update = $this->login_model->update_data('admin', $data, $where);
                    $message = "Your Password Update Successfully.
                        <br/>
                        Your new password for login:&nbsp;<strong>" . $password . "</strong>
                        <br/>
                        & Email Id : " . $email;
                    $this->load->library('email');
                    $this->email->from('info@actually.com', 'Actually');
                    $this->email->to($email);
                    $this->email->subject('Forgot Password');
                    $this->email->message($message);
                    $this->email->set_mailtype("html");
                    $this->email->send();
                    $data['success'] = 'Password Update Successfully. Please check your mail!';
                    $this->load->view('admin/forgot_password_view', $data);
                } else {
                    $data['error'] = 'Invalid Email ID!';
                    $this->load->view('admin/forgot_password_view', $data);
                }
            }
        } else {
            $this->load->view('admin/forgot_password_view');
        }
    } */
}