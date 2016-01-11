<?php
Class M_Topics extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->table = 'topic';
    }
   
    //  insert and update query function for topic        
    function saveDetails($datas)
    {
        $insert_data = array(                                                
                    'topic_name'        => $datas['topic_name'],                    
                    'topic_language'    => $datas['language'],                    
                           );    
         //update query
        if($datas['id'])
        {
            $this->db->where('topic_id',$datas['id']);
            $this->db->update($this->table, $insert_data);
            $lastid= $datas['id'];
        }
        else 
        {  
            $this->db->insert($this->table, $insert_data);           
            $lastid = $this->db->insert_id();        
        }
        if($lastid != '')
        {
            return $lastid;
        }
        else
        {
            return false;
        }
    }
    //  End of insert and update query function for topic   
    
    // Fetching all topic from topics table
    function getAllTopics($language,$role)
    {
        $this->db->select('topic.*');
        $this->db->from($this->table);
        
        if($role!=1)
        {
            $this->db->where('topic_language', $language);
        }     
        $this->db->order_by('topic.added_date ', 'desc');
        $result = $this->db->get();        
        $searchresult = $result->result();
        return $searchresult;
    }
    
    // End of Fetching all topic from topics table
    
    // delete topics based on ids
    function deleteTopics($id)
    {
        $this->db->where('topic_id', $id)->delete('selfie_video_topic_relation');
        $this->db->where('topic_id', $id)->delete('scripture_video_topic_relation');
        $this->db->where('topic_id', $id)->delete('testimonial_video_topic_relation');
        $this->db->where('topic_id', $id)->delete($this->table);
        return $id;
    }
    
    // fetching topic details based on topic id
    function getTopicDetails($id)
    {
        $result = $this->db->get_where($this->table, array('topic_id'=>$id));
        return $result->row();
    }
    
    // end of fetching topic details based on topic id
    
    // checking function for topic already exist in DB
    function topicAlreadyExist($topicanme,$language,$role,$topicid)
    {
       $topicname = strtolower($topicanme);
    
        $this->db->select('topic.*');
        $this->db->from($this->table);        
        if($role!=1)
        {
            $this->db->where('topic_language', $language);
        }  
        $this->db->where(array('topic_name'=>$topicname,'topic_id !='=> $topicid));        
        
        $result = $this->db->get();         
        return $result->num_rows();  
    }
}   
