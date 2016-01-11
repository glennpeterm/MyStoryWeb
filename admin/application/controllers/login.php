<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller {
   
    function __construct(){
	   parent::__construct();
       $this->lang->load('user');
       $this->lang->load('message');
       $this->load->library('session');
       $this->lang->load('email');
       $this->load->library('email');
       $this->load->helper('form');
       $this->load->library('form_validation');
       $this->load->model('m_login');
        
        
        
	}
    
    public function index($errNo = 0){
        
         if($this->session->userdata('kms_ad_id')){
            redirect(site_url('home'));
         }  
         
        $data = array();
        $err[100] = 'Invalid Login';
        if(isset($err[$errNo]) && ($err[$errNo] != '')){
            $data['errorMsg'] = $err[$errNo];
        }
        $this->load->view('login/v_login',$data);
           
    }
    
    public function dologin(){
        
        if($this->session->userdata('kms_ad_id')){
            redirect(site_url('home'));
         }
        $data = array();
        $this->load->helper('form');
        $this->load->library('form_validation');
            
        $submit = $this->input->post('login');
        if(isset($submit) && ($submit == 'login')){
            
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'required|xss_clean|min_length[6]|max_length[16]');
            if ($this->form_validation->run() == FALSE){
                $this->load->view('login/v_login',$data);
                
            }else{
                $res = $this->m_login->validateLogin();
                if($res){                    
                    redirect(site_url('home'));exit;
                }else{
                    redirect(site_url('login/index/100'));exit;
                }
            }
        }else{
            $this->load->view('login/v_login',$data);
        }
    }
    
    public function dologout(){
        
       
        $this->session->unset_userdata('kms_ad_id');
        $this->session->unset_userdata('kms_ad_fname');
        $this->session->unset_userdata('kms_ad_lname');
        $this->session->unset_userdata('kms_ad_role');
        $this->session->sess_destroy(); 
        redirect(base_url(),'refresh'); 
    }
    
    
    function forgotpassword()
    {
      if($this->session->userdata('kms_ad_id')){
            redirect(site_url('home'));
         }
        $data = array();
        if ($this->input->post('submit'))
        {
            $data['email']     = $this->input->post('email');
            $this->form_validation->set_rules('email', lang('email'), 'trim|required|xss_clean|valid_email|callback_check_email_in_db');
          
        }
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('login/v_forgot_password_email',$data);
            return false;
        } 
        else
        {
            $details = $this->m_login->user_check_with_email($this->input->post('email'));
            $userid  =  $details[0]->id;       

            $data['details']    =   $details[0];
            $first_name         =   $data['details']->first_name;
            $email              =   $data['details']->email;
            $password           =   $this->generatePassword();
            $newpassword        =   md5($password);

            $details = $this->m_login->updatePassword($userid,$newpassword);

            $subject = lang('email_subject_newpassword');
            $this->load->library('email');
            $this->email->set_mailtype("html");
            $this->email->from(WEBSITE_FROM_EMAIL,WEBSITE_FROM_NAME);
            $this->email->to($email);
            $this->email->subject($subject);
            $mail_content = $this->load->view('email_templates/v_forgot_password',array(),true);
            $mail_content = str_replace('{first_name}',$first_name,$mail_content);
            $mail_content = str_replace('{email}',$email,$mail_content);
            $mail_content = str_replace('{password}',$password,$mail_content);
            $this->email->message($mail_content);
            $this->email->send();              
            $this->session->set_flashdata('message', lang('forgot_pwd_aftr_mail_send_msg'));
            redirect('');    

        }
        $this->load->view('login/v_forgot_password_email');
        
    }
    
    
    function check_email_in_db($email)
    {
        $result = $this->m_login->user_check_with_email($email);
        $resultrow=  count($result);
        if($resultrow==0)
        {
            $this->form_validation->set_message('check_email_in_db', lang('email_not_exists'));
            return false;
        }
        else 
        { 
            return true;
            
        }
    }
    
    function generatePassword($length=9, $strength=0) 
     {	
        $password = "";
        $possible = "2346789bcdfghjkmnpqrtvwxyzBCDFGHJKLMNPQRTVWXYZ";
        $maxlength = strlen($possible);
        if ($length > $maxlength) 
        {
          $length = $maxlength;
        }
        $i = 0; 
        while ($i < $length)
        { 
          $char = substr($possible, mt_rand(0, $maxlength-1), 1);
          if (!strstr($password, $char)) 
          { 
            $password .= $char;
            $i++;
          }
        }
        return $password;
    }
   
}
?>
