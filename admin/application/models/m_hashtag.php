<?php
Class M_Hashtag extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->table = 'hash';
    }
   
    //  insert and update query function for hashtag        
    function saveDetails($datas)
    {
        $insert_data = array(                                                
                    'hash_name'        => $datas['hashtag_name'],                    
                    'hash_language'    => $datas['language'],                    
                           );    
         //update query
        if($datas['id'])
        {
            $this->db->where('hash_id',$datas['id']);
            $this->db->update($this->table, $insert_data);
            $lastid= $datas['id'];
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
    //  End of insert and update query function for hashtag   
    
    // Fetching all hashtag from hashtags table
    function getAllHashtags($language,$role)
    {
        $this->db->select('hash.*');
        $this->db->from($this->table);
        
        if($role!=1)
        {
            $this->db->where('hash_language', $language);
        }     
        $result = $this->db->get();        
        $searchresult = $result->result();
        return $searchresult;
    }
    
    // End of Fetching all hashtag from hashtags table
    
    // delete Hashtag based on id from hash table also hash tag realted video table
    function deleteHashtag($id)
    {
        $this->db->where('hash_id', $id)->delete('video_hash_relation');
        $this->db->where('hash_id', $id)->delete($this->table);
        return $id;
    }
    
    // fetching hashtag details based on hashtag id
    function getHashtagDetails($id)
    {
        $result = $this->db->get_where($this->table, array('hash_id'=>$id));
        return $result->row();
    }
    
    // end of fetching hashtag details based on hashtag id
    
    // checking function for hashtag already exist in DB
    function hashtagAlreadyExist($hashtaganme,$language,$role,$hashtagid)
    {
       $hashtagname = strtolower($hashtaganme);
    
        $this->db->select('hash.*');
        $this->db->from($this->table);        
        if($role!=1)
        {
            $this->db->where('hash_language', $language);
        }  
        $this->db->where(array('hash_name'=>$hashtagname,'hash_id !='=> $hashtagid));        
        
        $result = $this->db->get();         
        return $result->num_rows();  
    }
}   
