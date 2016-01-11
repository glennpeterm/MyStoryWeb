<?php
Class M_Home extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->userid    = $this->session->userdata('kms_ad_id');
        $this->user_role = $this->session->userdata('kms_ad_role');      
        $this->language  = $this->config->item('language');
    }
   /** function for getting selfie videos uploaded count and published videos count**/
    function getSelfiesStatus()
    {
        $data = '';
     
        $result = $this->db->get_where('videos', array('video_type' => 'selfie'));
        
        $searchresult = $result->result();
        $total_count = $result->num_rows();
        if($total_count>0)
        {
            $publish_count = 0 ;
            //$reject_count = 0 ;
            foreach ($searchresult as $results)
            {          
                if($results->video_status == 1)
                {
                    ++$publish_count;
                }
                
            }
             $data['publish_count'] = $publish_count;
             $data['upload_count']  = $total_count;
        }
        else
        {
            $data['upload_count']  = 0;
            $data['publish_count'] = 0;
        }
         return $data;
    }
   /** end of code for getting selfie videos uploaded count and published videos count**/
   
    /** function for getting registered users count **/
    function getRegisteredUsersCount()
    {
        $result = $this->db->get('user');         
        return $result->num_rows();  
    }

 /**
     * Get user data for home page line chart
     *
     * @return  json string format of user data
     */
    function getUserDataForGraph()
    {
        $result = $this->db->get('user'); 
         $searchresult = $result->result();
        $total_count = $result->num_rows();
         $str="[";
        foreach ($searchresult as $results)
        {          
            $dateCreated = date("Y-m-d",strtotime($results->date_created));
            $str.='{"date":"'.$dateCreated.'","type":"user","count":1},';
        }
         $str=trim($str,',');
        $str.="]";
        return $str;
             
    }

 /**
     * Get selfie data for home page line chart
     *
     * @return  json string format of selfie data
     */
    function getSelfieDataForGraph()
    {
       $result = $this->db->get_where('videos', array('video_type' => 'selfie'));
        $searchresult = $result->result();
         $str="[";
        foreach ($searchresult as $results)
        {          
            $dateCreated = date("Y-m-d",strtotime($results->video_added_date));
            $str.='{"date":"'.$dateCreated.'","type":"selfie","count":1},';
        }
         $str=trim($str,',');
        $str.="]";
        return $str;
             
    }

 


}   
