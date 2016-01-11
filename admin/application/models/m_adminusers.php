<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class m_adminusers extends CI_Model {

    function __construct(){
        parent::__construct();
    }
    
    function getAdminUsers(){
        $kms_ad_id = $this->session->userdata('kms_ad_id');
        $this->db->where('id != ', $kms_ad_id);
        $query = $this->db->get('admin_users');
        return $query->result();
    }
    
    function getUserDetails($id){
        $sql = "SELECT * FROM admin_users WHERE id = ?";
        $query =$this->db->query($sql, array($id)); 
        return $query->result();
    }

    function edit()
    {
        $id = $this->input->post('id');
        $resp = $this->checkExists($id);
       
        if($resp == 'exists'){
            return $resp;
        }else{
            if($id == 0){ //add
                $insDdata['first_name'] = htmlspecialchars($this->input->post('first_name',true)); 
                $insDdata['last_name'] = htmlspecialchars($this->input->post('last_name',true)); 
                $insDdata['email'] = htmlspecialchars($this->input->post('email',true)); 
                $insDdata['language'] = htmlspecialchars($this->input->post('language',true));
                $password = $this->generatePassword();
                $insDdata['password'] = md5($password); 
                $this->db->insert('admin_users', $insDdata);
                $this->sendEmail(array($insDdata['first_name'],$insDdata['email'],$password));
            }else{ //edit
                $insDdata['first_name'] = htmlspecialchars($this->input->post('first_name',true)); 
                $insDdata['last_name'] = htmlspecialchars($this->input->post('last_name',true)); 
                $insDdata['email'] = htmlspecialchars($this->input->post('email',true)); 
                $insDdata['language'] = htmlspecialchars($this->input->post('language',true)); 
                $this->db->update('admin_users', $insDdata, array('id' => $id));
            }
        }
        return true;
    }

    function checkExists($id){
        $email = htmlspecialchars($this->input->post('email',true)); 
        if($id == 0){ //add
            $query = $this->db->query("SELECT id FROM admin_users WHERE email = '$email'");
            if($query->num_rows() > 0){
                return 'exists';
            }
        }else if($id > 0){ //edit
            $query = $this->db->query("SELECT id FROM admin_users WHERE email = '$email' and id != '$id'");
            if($query->num_rows() > 0){
                return 'exists';
            }
        }
        return 'not_exists';
        
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
		$mail_content = $this->load->view('email_templates/v_register_email',array(),true);
        $mail_content = str_replace('{first_name}',$first_name,$mail_content);
        $mail_content = str_replace('{email}',$email,$mail_content);
        $mail_content = str_replace('{password}',$password,$mail_content);
		$this->email->message($mail_content);
		$this->email->send();
    }
    
    function delete()
    {
        $this->db->delete('admin_users', array('id' => $this->input->post('id')));
        return $this->db->affected_rows();
    }
    
    function passwordChkinDb($userid,$password)
    {
        $this->db->select('admin_users.*');
        $this->db->from('admin_users'); 
        $this->db->where(array('id'=>$userid,'password'=> md5($password))); 
        $result = $this->db->get();         
        return $result->num_rows();  
    }
    
    function updatePassword($datas)
    {
        $insert_data = array(                                                
                    'password'     => md5($datas['confirm_password']),                  
                         );    
        if($datas['id'])
        {
            $this->db->where('id',$datas['id']);
            $this->db->update('admin_users', $insert_data);           
            $result = 'true';
            return $result;
        }
        else
        {
            $result = 'false';
            return $result;
        }
    }

    public function setStatus(){
        
       $upDdata = array();
       $upDdata['status'] = $this->input->post('status'); 
       $this->db->update('admin_users', $upDdata, array('id' => $this->input->post('id')));        
       return true;
    }
    public function userActivationtokenUpdation($userid,$activationtoken){
        
       $upDdata = array();
       $upDdata['activation_token'] = $activationtoken; 
       $this->db->update('admin_users', $upDdata, array('id' => $userid));
       return true;
    }
    
    public function validate_activationtoken($activationtoken){
        
        $this->db->select('admin_users.*');
        $this->db->from('admin_users');        
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
        $this->db->update('admin_users', $insert_data);
        
        return true;
    }
    function update_profile_data($datas)
    {
        
        $data = array(
            'first_name'    =>  $datas['first_name'],
            'last_name'     =>  $datas['last_name'],
            'email'         =>  $datas['email']
            );

        $this->db->where('id', $datas['userid']);
        $this->db->update('admin_users', $data); 
        return $datas['userid'];
    }
    
    function check_useremail_in_db($email,$userid)
    {    
        $this->db->select('admin_users.*');
        $this->db->from('admin_users');        
        $this->db->where(array('email'=> $email,'id !='=> $userid));        
        
        $result = $this->db->get();         
        return $result->num_rows(); 
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
}
?>
