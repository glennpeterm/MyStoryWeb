<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_Settings extends CI_Controller {

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
        
	}
    
   
    public function chanagepassword()
    {
        $data = array();   
        $data['header'] = $this->load->view('v_header',$data, true);
        $data['menu']   = $this->load->view('v_leftmenu',$data, true);
        $data['footer'] = $this->load->view('v_footer',$data, true);
         if($this->input->post('submit'))
        {    
            $this->form_validation->set_rules('old_password',lang('old_password'), 'required|xss_clean|callback_userpassword_check');
            $this->form_validation->set_rules('new_password', lang('new_password'), 'required|xss_clean|min_length[6]|max_length[16]|matches[confirm_password]'); 
            $this->form_validation->set_rules('confirm_password', lang('confirm_password'), 'required|xss_clean|min_length[6]|max_length[16]'); 
            
            $data['old_password']         = $this->input->post('old_password');
            $data['new_password']         = $this->input->post('new_password');
            $data['confirm_password']     = $this->input->post('confirm_password');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->load->view('user_settings/v_change_password',$data);
                return false;
            }
            else 
            {
              
                $details            =   $this->m_adminusers->getUserDetails($this->userid);        
                $data['details']    =   $details[0];
                $username           =   $data['details']->first_name;
                $user_email         =   $data['details']->email;
                
                $datas = array(
                        'id'                => $this->userid, 
                        'confirm_password'  => $this->input->post('confirm_password')
                     );
                
                $result =$this->m_adminusers->updatePassword($datas);
               
                if($result=='false')
                {
                    $this->session->set_flashdata('error', lang('insertn_err_msg'));
                    redirect('user_settings/chanagepassword');
                }
                else if($result=='true')
                {
                    $subject  = lang('user_account_chng_pwd_subj');
                    $message  = lang('user_account_chng_pwd_msg');

                    $this->email->set_mailtype("html");
                    $this->email->from(WEBSITE_FROM_EMAIL,WEBSITE_FROM_NAME);
                    $this->email->to($user_email);
                    $this->email->subject($subject);
                    $mail_content = $this->load->view('email_templates/v_password_reset',array(),true);
                    $mail_content = str_replace('{first_name}',ucfirst($username),$mail_content);
                    $mail_content = str_replace('{message}',$message,$mail_content);      
                    $this->email->message($mail_content);        
                    $this->email->send();                    
                    $this->session->set_flashdata('message', lang('user_account_chng_pwd_send_msg'));
                    redirect('user_settings/chanagepassword');
                }
            }
        }
       $this->load->view('user_settings/v_change_password',$data); 
        
    }
    public function userpassword_check($input)
    {
        $res = $this->m_adminusers->passwordChkinDb($this->userid,$input);
         
        if($res!=0)
        {
           return true; 
        }
        else 
        {        
            $msg = lang('pwd_chk_db_err');
            $this->form_validation->set_message("userpassword_check", $msg);
            return false; 
        }
    }
    
 
    //user account details changing sections
     public function accountsettings()
    {
        
        
        $data = array();             
        $data['header'] = $this->load->view('v_header',$data, true);
        $data['menu']   = $this->load->view('v_leftmenu',$data, true);
        $data['footer'] = $this->load->view('v_footer',$data, true);
            
        $userid = $this->userid;
        $data['userdetails']= $this->m_adminusers->getUserDetails($userid);   
        if($this->input->post('submit'))
        {  

            
            $this->form_validation->set_rules('first_name', lang('first_name'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('last_name', lang('last_name'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('email_add', lang('email_add'), 'trim|required|xss_clean|valid_email|callback_useremail_check');
            
            
            $data['userdetails'][0]->first_name    = $this->input->post('first_name');
            $data['userdetails'][0]->last_name     = $this->input->post('last_name');
            $data['userdetails'][0]->email_add     = $this->input->post('email_add');
            
            if ($this->form_validation->run() === FALSE) 
            {
                $this->load->view('user_settings/v_account_settings', $data);                
                return false;
            } 
            else
            {
                
                $datas = array(                            
                         'first_name'   => $this->input->post('first_name'),
                         'last_name'    => $this->input->post('last_name'),      
                         'email'        => $this->input->post('email_add'),
                         'userid'       => $userid
                        );
                $this->session->set_flashdata('message', lang('profile_updt_msg'));
                $result =$this->m_adminusers->update_profile_data($datas);
                /* unsetting current session and add new session data*/
                $array_items = array('kms_ad_fname' => '', 'kms_ad_lname' => '');
                $this->session->unset_userdata($array_items);

                $this->session->set_userdata('kms_ad_fname', $this->input->post('first_name'));
                $this->session->set_userdata('kms_ad_lname', $this->input->post('last_name'));
                
                 /* end of code for unsetting current session and add new session data*/
                
                if( $this->user_role==1)
                {
                   redirect('adminusers');  
                }
                else
                {
                    redirect('home');
                }
               

            }
        }
                  
                  
            $this->load->view('user_settings/v_account_settings',$data);
        
    }
    //function for checking email id already in database
    public function useremail_check($input)
    {
       
        $res = $this->m_adminusers->check_useremail_in_db($input,$this->userid);
        if($res==0)
        {
           return true; 
        }
        else 
        {        
            $msg = lang('email_exists');
            $this->form_validation->set_message("useremail_check", $msg);
            return false; 
        }
    }
    
     // action for displying displying password reset form
    public function resetpassword($activation_token)
    {
      
        $data['activation_token'] = $activation_token;
        $this->load->view('user_settings/v_reset_password',$data);
       
    }
    // save function for password reset
    public function passwordResetAction()
    {
       
        if ($this->input->post('submit'))
        {

            
            $this->form_validation->set_rules('password',lang('password'), 'required|xss_clean|matches[cpassword]');
            $this->form_validation->set_rules('cpassword', lang('cpassword'), 'required|xss_clean');

            $data['activation_token']   = $this->input->post('activation_token');
            $data['password']           = $this->input->post('password');
            if ($this->form_validation->run() == FALSE)
            {
                $this->load->view('user_settings/v_reset_password',$data);
                return false;
            } 
            else
            {
                $userdetails =  $this->m_adminusers->validate_activationtoken($this->input->post('activation_token'));                
                if(!empty($userdetails))
                {
                    $user_id    =  $userdetails[0]->id;
                    $result     =  $this->m_adminusers->updatePasswordAndToken($user_id,$this->input->post('password')); 
                    
                    
                    $session_data = array(
			'kms_ad_id' => $userdetails[0]->id,
			'kms_ad_fname' => ucfirst(stripslashes($userdetails[0]->first_name)),
                        'kms_ad_lname' => ucfirst(stripslashes($userdetails[0]->last_name)),
                        'kms_ad_role' => ucfirst(stripslashes($userdetails[0]->role))
			);                       
                        
		    $this->session->set_userdata($session_data);
                    redirect(site_url('home'));
                    //redirect(''); user home page
                }
                else
                {
                    $this->session->set_flashdata('error', lang('invalid_token'));
                    redirect(''); 
                }
            }
        }
            redirect(''); 
      }
}
