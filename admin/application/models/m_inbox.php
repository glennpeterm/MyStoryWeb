<?php
Class M_Inbox extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->table = 'projects';
    }
   
    // fetching all inbox details       
    function getAllMessages($language,$role)
    {
        $this->db->select('inbox.*');
        $this->db->from('inbox');
        
        if($role!=1)
        {
            $this->db->where('language', $language);
        }     
        $this->db->order_by('inbox.added_date', 'desc');
        $this->db->order_by("inbox.status", 0); 
        $result = $this->db->get();
        $searchresult = $result->result();
        return $searchresult;
    }
    
    // delete inbox mails based on id
    function deleteMails($id)
    {
        $this->db->where('inbox_id', $id)->delete('inbox');
        return $id;
    }
    
    // count all unread mails from inbox table
    function countAllUnreadMessages()
    {
        $role = $this->session->userdata('kms_ad_role');      
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
    
    // update query  to change inbox mail status 
    function updateMessageStatus($id ,$status)
    {
       $data = array(
                'status'    =>$status
                );
       if($status == 1)
       {
           $this->db->where('status', 0);
       }       
        $this->db->where('inbox_id', $id);
        $this->db->update('inbox', $data);        
        
        return $id; 
    }
    
    function countAllMessages($keyword=NULL,$language,$role)
    {       
        $this->db->select('inbox.*');
        $this->db->from('inbox');        
        if($keyword)
        {
          $this->db->like('inbox.inbox_name', $keyword);
        }  
        if($role!=1)
        {
            $this->db->where('language', $language);
        }  
        $this->db->order_by('inbox.added_date', 'desc');        
        
        $result = $this->db->get();
        return $result->num_rows();       
   
    }
    
 
}   
