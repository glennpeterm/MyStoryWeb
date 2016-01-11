<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class m_login extends CI_Model {

    function __construct(){
        parent::__construct();
    }
    
    function validateLogin(){
        $email = $this->input->post('email');
		$password = $this->input->post('password');
		$this->db->where('email', $email);
		$this->db->where('password', md5($password));
		$this->db->select("id,first_name,last_name,role");
		$this->db->from('admin_users');
                $this->db->where('status', 'active');
		$query = $this->db->get();
		if($query->num_rows() == 1){
			$row = $query->row();
                        $unreadEmails = $this->countAllUnreadMessages($row->role);
			$data = array(
			'kms_ad_id' => $row->id,
			'kms_ad_fname' => ucfirst(stripslashes($row->first_name)),
            'kms_ad_lname' => ucfirst(stripslashes($row->last_name)),
            'kms_ad_role' => ucfirst(stripslashes($row->role)),
            'kms_ad_unread_emails' => $unreadEmails
			);
                       
                        
			$this->session->set_userdata($data);
			return true;
		}
		return false;
    }
    
    function countAllUnreadMessages($role)
    {
       
        $language = $this->config->item('language');
        $this->db->select('inbox.*');
        $this->db->from('inbox');
        $this->db->where('status', 0);        
        if($role!=1)
        {
            $this->db->where('language', $language);
        }  
        $this->db->order_by('inbox.added_date', 'desc');        
        
        $result = $this->db->get();
        return $result->num_rows();       
   
    }
    
    function user_check_with_email($email)
    {
        $this->db->where(array('email'=>$email,'status '=>'active'));
        $result1 = $this->db->get('admin_users');
        $searchresult = $result1->result();
        return $searchresult;
        
    }

    public function updatePassword($userid,$password){
       
       
       $insert_data = array(                                                
                        'password'           => $password
                        
                      );
        $this->db->where('id',$userid);
        $this->db->update('admin_users', $insert_data);
        
        return true;
    }

}
?>
