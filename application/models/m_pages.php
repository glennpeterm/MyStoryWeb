<?php
Class M_Pages extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->language  = $this->config->item('language');
        $this->table     = 'inbox';
    }
    
    function saveDetails($datas)
    {
        $insert_data = array(
            
                    'inbox_name'     => $datas['contact_name'],                    
                    'inbox_email'    => $datas['contact_email'], 
                    'inbox_message'  => $datas['contact_message'],
                    'added_date'     => date('Y-m-d H:i:s'),
                    'language'       => $this->language
                
                           );   
        
         $this->db->insert($this->table, $insert_data);           
         $lastid = $this->db->insert_id(); 
        
        if($lastid != '')
        {
            return $lastid;
        }
        else
        {
            return false;
        }
    }
}