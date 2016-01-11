<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adminusers extends CI_Controller {

	function __construct(){
	   parent::__construct();
       //language files
       $this->lang->load('common');
       $this->lang->load('user');
       $this->lang->load('email');
       $this->load->library('email');
       $this->load->helper('form');
       $this->load->library('form_validation');
       $this->load->model('m_adminusers');
       $this->load->model('m_login');
       $this->userid    = $this->session->userdata('kms_ad_id');
       $this->user_role = $this->session->userdata('kms_ad_role');      
       $this->language  = $this->config->item('language');
        
	}
    
	public function index($msgCode='')
	{
            $data = array();
            $msg[100] = lang('saved');
            if(isset($msg[$msgCode]) && ($msg[$msgCode] != ''))
            {
                $data['msg']  = $msg[$msgCode];
            }
            if( $this->user_role==1)
            {
                $data['adminUsers']  = $this->m_adminusers->getAdminUsers();
                $data['header'] = $this->load->view('v_header',$data, true);
                $data['menu'] = $this->load->view('v_leftmenu',$data, true);
                $data['footer'] = $this->load->view('v_footer',$data, true);
                $this->load->view('adminusers/v_list',$data);
            }
            else
            {
                redirect('home');
            }
	}
    
    public function edit($id=0){
        $data = array();
        $data['id'] = $id;
        $data['details'] = array();
        if($id > 0){
            $details = $this->m_adminusers->getUserDetails($id);
            $data['details'] = $details[0];
        }
        $data['header'] = $this->load->view('v_header',$data, true);
		$data['menu'] = $this->load->view('v_leftmenu',$data, true);
		$data['footer'] = $this->load->view('v_footer',$data, true);
        $this->load->view('adminusers/v_edit',$data);
    }
    
    public function save(){
       
        $id = $this->input->post('id');
        $data = array();
        $data['header'] = $this->load->view('v_header',$data, true);
		$data['menu'] = $this->load->view('v_leftmenu',$data, true);
		$data['footer'] = $this->load->view('v_footer',$data, true);
        $data['id'] = $id;
        
            
        $action = $this->input->post('action');
        if(isset($action) && ($action == 'save')){
            $this->form_validation->set_rules('first_name', lang('first_name'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('last_name', lang('last_name'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
            if ($this->form_validation->run() == FALSE){
                $this->load->view('adminusers/v_edit',$data);return false;
            }else{
                $res = $this->m_adminusers->edit();
                if(isset($res) && (string)$res == 'exists') {
                    $data['errorMsg'] = lang('email_exists');
                    $this->load->view('adminusers/v_edit',$data);return false;
                }else{
                    redirect(site_url('adminusers/index/100'));exit;
                }
            }
        }else{
            $this->load->view('adminusers/v_edit',$data);
        }
    }
    
    public function delete()
	{
        $res = $this->m_adminusers->delete();
        if($res > 0){
            echo 'success';exit;
        }
        echo 'failed';exit;
	}
    
    
     public function setstatus(){
        $res = $this->m_adminusers->setStatus();
        if($res){
            echo 'success';exit;
        }
        echo 'failed';exit;
    }
    /* Function for resetting the password 
     *  Mail with password restting link option will send to the user account 
     * on clickong the link user will redirect to resetpassword() action
     * 
     */
    public function resetUserPassword($userid)
    {
        $activation_token = md5(microtime().rand());       
        
        $details = $this->m_adminusers->getUserDetails($userid);        
        $usertokenUpdation = $this->m_adminusers->userActivationtokenUpdation($userid,$activation_token);        
        
        $data['details']    =   $details[0];
        $username           =   $data['details']->first_name;
        $user_email         =   $data['details']->email;
         
        $subject  = lang('reset_pwd_subj');
        $message  = lang('reset_pwd_msg').' <a href="'.base_url().'user_settings/resetpassword/'.$activation_token.' ">'.base_url().'user_settings/resetpassword/'.$activation_token.'</a>';
        
	$this->email->set_mailtype("html");
	$this->email->from(WEBSITE_FROM_EMAIL,WEBSITE_FROM_NAME);
	$this->email->to($user_email);
	$this->email->subject($subject);
	$mail_content = $this->load->view('email_templates/v_password_reset',array(),true);
        $mail_content = str_replace('{first_name}',ucfirst($username),$mail_content);
        $mail_content = str_replace('{message}',$message,$mail_content);      
    	$this->email->message($mail_content);     
        $this->email->send();        
        $this->session->set_flashdata('message', lang('reset_pwd_mail'));
        redirect('adminusers');        
    }
    
   
    
}
