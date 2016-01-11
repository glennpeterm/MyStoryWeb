<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class m_users extends CI_Model {

    function __construct(){
        parent::__construct();
       
        $this->user_role = $this->session->userdata('kms_ad_role');
        $this->userid    = $this->session->userdata('kms_ad_id');      
        $this->language  = $this->config->item('language');
    }
    
    function getUsers(){
        $query = $this->db->select("*,DATE_FORMAT(date_created, '%d/%m/%Y %h:%i:%S') as date_created",false);
        $this->db->from('user');
        $query = $this->db->get();
        return $query->result();
    }
    
    function getUserDetails($id){
      
        $this->db->select('user.*');
        $this->db->from('user');
         $this->db->where('id',  $id);
        if($this->user_role!=1)
        {
            $this->db->where('language',  $this->language);
        }     
        $result = $this->db->get();  
        $searchresult = $result->result();        
        return $searchresult;  
    }

    function edit($fileName = '')
    {
        $id = $this->input->post('id');
       
        $dob =  date("Y-m-d", strtotime($_POST['dob']));
        
        $resp = $this->checkExists($id);
        if($resp == 'exists')return $resp;
        $insDdata = array();
        if(isset($fileName) && ($fileName != ''))$insDdata['photo'] = $fileName;
        if($id == 0){ //add
            $insDdata['first_name'] = htmlspecialchars($this->input->post('first_name',true)); 
            $insDdata['last_name'] = htmlspecialchars($this->input->post('last_name',true)); 
            $insDdata['gender'] = htmlspecialchars($this->input->post('gender',true)); 
            $insDdata['address'] = htmlspecialchars($this->input->post('address',true)); 
            $insDdata['phone'] = htmlspecialchars($this->input->post('phone',true)); 
            $insDdata['email'] = htmlspecialchars($this->input->post('email',true)); 
           
            
            if(isset($_POST['submit_notify'])){
                $password = $this->generatePassword();
                $insDdata['password'] = md5($password);
            }
            
            $insDdata['language'] = htmlspecialchars($this->input->post('language',true)); 
            $this->db->insert('user', $insDdata);
            if(isset($_POST['submit_notify'])){
                $this->sendEmail(array($insDdata['first_name'],$insDdata['email'],$password));
            }
        }else{ //edit
            $insDdata['first_name']= htmlspecialchars($this->input->post('first_name',true)); 
            $insDdata['last_name']= htmlspecialchars($this->input->post('last_name',true)); 
            $insDdata['gender']   = htmlspecialchars($this->input->post('gender',true)); 
            $insDdata['address']  = htmlspecialchars($this->input->post('address',true)); 
            $insDdata['phone']    = htmlspecialchars($this->input->post('phone',true)); 
            $insDdata['email']    = htmlspecialchars($this->input->post('email',true)); 
            $insDdata['language'] = htmlspecialchars($this->input->post('language',true)); 
            $insDdata['country']  = htmlspecialchars($this->input->post('country',true));
            $insDdata['state']    = htmlspecialchars($this->input->post('state',true));
            $insDdata['city']     = htmlspecialchars($this->input->post('city',true));
            $insDdata['zipcode'] = htmlspecialchars($this->input->post('zipcode',true));
            $insDdata['dob']      = $dob;
            $this->db->update('user', $insDdata, array('id' => $id));
        }
        return 'done';
    }
    
    function checkExists($id){
        $email = htmlspecialchars($this->input->post('email',true)); 
        if($id == 0){ //add
            $query = $this->db->query("SELECT first_name FROM user WHERE email = '$email'");
            if($query->num_rows() > 0){
                return 'exists';
            }
        }else if($id > 0){ //edit
            $query = $this->db->query("SELECT first_name FROM user WHERE email = '$email' AND id != '$id'");
            if($query->num_rows() > 0){
                return 'exists';
            }
        }
        return '';
        
    }

    function sendEmail($args = array()){
        $first_name = $args[0];
		$email = $args[1];
		$password = $args[2];
        $subject = lang('email_subject_account');
		$this->load->library('email');
		$this->email->set_mailtype("html");
		$this->email->from(WEBSITE_FROM_EMAIL,WEBSITE_FROM_NAME);
		$this->email->to($email);
		$this->email->subject($subject);
		$mail_content = $this->load->view('email_templates/v_adduser_email',array(),true);
        $mail_content = str_replace('{first_name}',$first_name,$mail_content);
        $mail_content = str_replace('{email}',$email,$mail_content);
        $mail_content = str_replace('{password}',$password,$mail_content);
		$this->email->message($mail_content);
		$this->email->send();
    }
    
    function delete()
    {
        $this->db->delete('user', array('id' => $this->input->post('id')));
        return $this->db->affected_rows();
    }
    
    function generatePassword($length=9, $strength=0) {	
		$password = "";
		$possible = "2346789bcdfghjkmnpqrtvwxyzBCDFGHJKLMNPQRTVWXYZ";
		$maxlength = strlen($possible);
		if ($length > $maxlength) {
		  $length = $maxlength;
		}
		$i = 0; 
		while ($i < $length) { 
		  $char = substr($possible, mt_rand(0, $maxlength-1), 1);
		  if (!strstr($password, $char)) { 
			$password .= $char;
			$i++;
		  }
		}
		return $password;
   }
   
    public function setStatus(){
        
       $upDdata = array();
       $upDdata['status'] = $this->input->post('status'); 
       $this->db->update('user', $upDdata, array('id' => $this->input->post('id')));        
       return true;
    }
    
    public function userActivationtokenUpdation($userid,$activationtoken){
        
       $upDdata = array();
       $upDdata['activation_token'] = $activationtoken; 
       $this->db->update('user', $upDdata, array('id' => $userid));
       return true;
    }
    
    public function validate_activationtoken($activationtoken){
        
        $this->db->select('user.*');
        $this->db->from('user');        
        $this->db->where('activation_token', $activationtoken);        
        $result = $this->db->get();        
        $searchresult = $result->result();        
        return $searchresult;
    }
    
    public function updatePasswordAndToken($userid,$password){
       
       
       $insert_data = array(                                                
                        'password'           => md5($password),
                        'activation_token'   => ' '
                        
                      );
        $this->db->where('id',$userid);
        $this->db->update('user', $insert_data);
        
        return true;
    }
    
    function getCountryList(){
        
        $this->db->select('countries.*');
        $this->db->from('countries');        
             
        $result = $this->db->get();        
        $searchresult = $result->result();        
        return $searchresult;
    }

  
}
?>
