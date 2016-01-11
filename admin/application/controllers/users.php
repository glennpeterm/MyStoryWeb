<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	function __construct(){
	   parent::__construct();
       //language files
       $this->lang->load('common');
       $this->lang->load('user');
       $this->lang->load('email');
       $this->load->library('email');
       $this->load->helper('form');
       $this->load->library('form_validation');
       $this->load->model('m_users');
	}
    
	public function index($msgCode='')
	{
        $data = array();
        $msg[100] = lang('saved');
        if(isset($msg[$msgCode]) && ($msg[$msgCode] != '')){
            $this->session->set_flashdata('msg', $msg[$msgCode]);
        }
        $data['users']  = $this->m_users->getUsers();
        $data['header'] = $this->load->view('v_header',$data, true);
		$data['menu'] = $this->load->view('v_leftmenu',$data, true);
		$data['footer'] = $this->load->view('v_footer',$data, true);
        $this->load->view('users/v_list',$data);
	}
    
    public function edit($id=0){
        $data = array();
        $data['id'] = $id;
        $data['details'] = array();
         $data['country_list'] = $this->m_users->getCountryList();
        
        if($id > 0){
            $details = $this->m_users->getUserDetails($id);
            $data['details'] = $details[0];
        }
        $data['header'] = $this->load->view('v_header',$data, true);
		$data['menu'] = $this->load->view('v_leftmenu',$data, true);
		$data['footer'] = $this->load->view('v_footer',$data, true);
        $this->load->view('users/v_edit',$data);
    }
    
    public function save(){
        
        $id = $this->input->post('id');
        $data = array();
        $data['header'] = $this->load->view('v_header',$data, true);
		$data['menu'] = $this->load->view('v_leftmenu',$data, true);
		$data['footer'] = $this->load->view('v_footer',$data, true);
                $data['country_list'] = $this->m_users->getCountryList();
        $data['id'] = $id;
        $uploadErr = 0;
        $file_name = '';   
        $action = $this->input->post('action');
        if(isset($action) && ($action == 'save')){
            $this->form_validation->set_rules('first_name', lang('first_name'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('last_name', lang('last_name'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
            $this->form_validation->set_rules('dob', lang('dob'), 'required|trim|xss_clean|callback_datevalidation_less');
            $this->form_validation->set_rules('country', lang('country'), 'trim|xss_clean|callback_select_validate');
            $this->form_validation->set_rules('state', lang('state'), 'trim|xss_clean');
            $this->form_validation->set_rules('city', lang('city'), 'trim|xss_clean');
            $this->form_validation->set_rules('zipcode', lang('zipcode'), 'trim|xss_clean');
            
            if ($this->form_validation->run() == FALSE){
                $this->load->view('users/v_edit',$data);return false;
            }else{
                //upload photo 
                if(isset($_FILES['userfile']['name']) && ($_FILES['userfile']['name'] != '')) { 
                    $fpath = $_FILES['userfile']['name'];
                    $ext = pathinfo($fpath, PATHINFO_EXTENSION);
                    $new_name = time().'.'.$ext;
                    $config['file_name'] = $new_name;
                    $config['upload_path'] = '../uploads/';
                    $config['allowed_types'] = 'gif|jpg|jpeg|png';
                    $config['max_size']	= '200';
                    $config['max_width']  = '250';
                    $config['max_height']  = '250';
                    $this->load->library('upload', $config);
                    if(!$this->upload->do_upload()){
                        $uploadErr = 1;
                        $error = array('error' => $this->upload->display_errors());
                        $data['errorMsg'] = $error['error'];
                        $this->load->view('users/v_edit', $data);
                    }else{
                        $data = array('upload_data' => $this->upload->data());
                        $file_name = $data['upload_data']['file_name'];
                        $this->load->view('users/v_edit', $data);
                    }
                }
                $res = $this->m_users->edit($file_name);
                if(isset($res) && (string)$res == 'exists') {
                    $data['errorMsg'] = lang('email_exists');
                    $this->load->view('users/v_edit',$data);return false;
                }else{
                    if($uploadErr == 0){
                        redirect(site_url('users/index/100'));exit;
                    }
                }
            }
        }else{
            $this->load->view('users/v_edit',$data);
        }
    }
    
    public function delete()
	{
        $res = $this->m_users->delete();
        if($res > 0){
            echo '1';exit;
        }
        echo 'failed';exit;
	}
    
    public function view($id=0){
        $data = array();
        $data['details'] = array();
        if($id > 0){
            $details = $this->m_users->getUserDetails($id);
            $data['details'] = $details[0];
        }
        $data['header'] = $this->load->view('v_header',$data, true);
		$data['menu'] = $this->load->view('v_leftmenu',$data, true);
		$data['footer'] = $this->load->view('v_footer',$data, true);
        $this->load->view('users/v_view',$data);
    }
    
    public function setstatus(){
        $newStatus    = $this->input->post('status'); 
        $userData       = $this->m_users->getUserDetails($this->input->post('id'));
        $res            = $this->m_users->setStatus();
        if($res)
        {
            if($newStatus=='active')
            {
                
                $subject        = lang('act_activate_mail_subject');
                $message        = lang('act_activate_mail_body');
            }
            else
            {
                $subject        = lang('act_deactivate_mail_subject');
                $message        = lang('act_deactivate_mail_body');
            }

            $user_email         = $userData['0']->email;
            $username           = $userData['0']->first_name;


            $this->email->set_mailtype("html");
            $this->email->from(WEBSITE_FROM_EMAIL,WEBSITE_FROM_NAME);
            $this->email->to($user_email);
            $this->email->subject($subject);
            $mail_content = $this->load->view('email_templates/v_account_status',array(),true);
            $mail_content = str_replace('{first_name}',ucfirst($username),$mail_content);
            $mail_content = str_replace('{message}',$message,$mail_content);      
            $this->email->message($mail_content);        
            $this->email->send();                    
            $this->session->set_flashdata('message', lang('act_status_changed_msg'));
           
           redirect(site_url('users/index'));exit;
        }
       redirect(site_url('users/index'));exit;
    }
    
    public function resetUserPassword($userid)
    {
        $activation_token = md5(microtime().rand());       
        
        $details = $this->m_users->getUserDetails($userid);        
        $usertokenUpdation = $this->m_users->userActivationtokenUpdation($userid,$activation_token);        
        
        $data['details']    =   $details[0];
        $username           =   $data['details']->first_name;
        $user_email         =   $data['details']->email;
         
        $subject  =  lang('reset_pwd_subj');        
        $message  = lang('reset_pwd_msg').'<a href="'.base_url().'users/resetpassword/'.$activation_token.' ">'.base_url().'users/resetpassword/'.$activation_token.'</a>';
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
        redirect('users');        
    }
    
    public function resetpassword($activation_token)
    {
      
        $data['activation_token'] = $activation_token;
        $this->load->view('users/v_reset_password',$data);
       
    }
    
    public function passwordResetAction()
    {
       
        if ($this->input->post('submit'))
        {
            $this->form_validation->set_rules('password', lang('password'), 'trim|required|xss_clean|matches[cpassword]');
            $this->form_validation->set_rules('cpassword', lang('cpassword'), 'trim|required|xss_clean');

            $data['activation_token']   = $this->input->post('activation_token');
            $data['password']           = $this->input->post('password');
            if ($this->form_validation->run() == FALSE)
            {
                $this->load->view('users/v_reset_password',$data);
                return false;
            } 
            else
            {
                $userdetails =  $this->m_users->validate_activationtoken($this->input->post('activation_token'));                
                if(!empty($userdetails))
                {
                    $user_id    =  $userdetails[0]->id;
                    $result     =  $this->m_users->updatePasswordAndToken($user_id,$this->input->post('password'));    
                    
                    redirect(''); 
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
       //Check for Date Greater than current date//
    function datevalidation_less($dateval) {
      
        $dob =  date("m/d/Y", strtotime($_POST['dob']));
        $currentdate = date("m/d/Y");
        $dateval1 = strtotime($dateval);
        $dateval2 = strtotime($currentdate);
        if ($dateval1 > $dateval2||$dateval1 == $dateval2) {
            $msg = lang('date_valdtn_err');
            $this->form_validation->set_message('datevalidation_less', $msg);
            return false;
        } else {
            
           return true;
        }
     
    }
    
     //**dropdown validation **//
    function select_validate($selectionval) 
    {

    if($selectionval == "select")
       {
            $msg = lang('dropdown_valdtn_msg');
            $this->form_validation->set_message('select_validate', $msg);
            return false;
       }
      else
       { 

         return true;
        }          
     }

    //}
    
}
