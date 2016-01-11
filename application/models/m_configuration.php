<?php
Class M_Configuration extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->table = 'configuration';
    }
   
    
    // fetching topic details based on configdata
    function getConfigurationDetails($configname)
    {
        $result = $this->db->get_where($this->table, array('configuration_name'=>$configname));
        return $result->row();
    }
    
    // end of fetching topic details based on configdata
    
    
}   
