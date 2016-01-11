<?php
Class M_Configuration extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->table = 'configuration';
    }
   
    //  insert and update query function for config data        
    function saveDetails($datas)
    {
       
         //update query



        foreach ($datas as $key => $value)
        {
            $val = array('configuration_data' => $value );
            $this->db->where('configuration_name',$key);
            $this->db->update($this->table, $val);
            

        }

    
    }
    //  End of insert and update query function for topic   
    
   
    
   
    
    // fetching topic details based on configdata
    function getConfigurationDetails($configname)
    {
        $result = $this->db->get_where($this->table, array('configuration_name'=>$configname));
        return $result->row();
    }
    
    // end of fetching topic details based on configdata
    
    
}   
