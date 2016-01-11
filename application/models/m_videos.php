<?php
Class M_Videos extends CI_Model
{
    function __construct()
    {
        parent::__construct();
       $this->table = 'videos';
       $this->language  = $this->config->item('language');
    }
    
    /**
    * video detail page 
    * 
    * @param   string videoid
    * @return  fetch video details of a particular video id
    */
   function getVideoDetails($videoid)
    {
        $this->db->select('videos.*');        
        $this->db->from('videos');                   
        $this->db->where(array('video_id'=> $videoid,'video_status'=>1));
        $result = $this->db->get();        
       // echo $str = $this->db->last_query();exit;
        $searchresult = $result->result();
        return $searchresult;
    }
       
    /**
    * video detail page 
    * 
    * @param   string videoid
    * @return  function for fetching hastag detils of a particular video id
    */
    
    function getVideoHahtagDetails($videoid)
    {
        $this->db->select('video_hash_relation.*,hash.*');
        $this->db->from('video_hash_relation');
        $this->db->join('hash', 'hash.hash_id = video_hash_relation.hash_id', 'left');            
        $this->db->where('video_hash_relation.video_id', $videoid);
        $result = $this->db->get();  
        $searchresult = $result->result();
        return $searchresult;
    }
    /**
    * video detail page 
    * 
    * @param   string videoid
    * @return  function for fetching topic detils of a particular video id
    */
    
    function getVideoTopicDetails($videoid)
    {
        $this->db->select('video_topic_relation.*,topic.*');
        $this->db->from('video_topic_relation');
        $this->db->join('topic', 'topic.topic_id = video_topic_relation.topic_id', 'left');            
        $this->db->where('video_topic_relation.video_id', $videoid);
        $result = $this->db->get();       
        $searchresult = $result->result();
        return $searchresult;
    }
    /**
    * footer page 
    * 
    * @return  function for fetching featured videos
    */
    function featuredVideos()
    {
        $this->db->select('videos.video_thumbnail_url,videos.video_id,videos.video_title,videos.video_youtube_id');        
        $this->db->from('videos');                   
        $this->db->where(array('video_status'=> 1,'video_highlight'=>'1'));
        $this->db->order_by('video_added_date', 'DESC');
        $this->db->limit('4');
        $result = $this->db->get(); 
        $searchresult = $result->result();
        return $searchresult;
    }
    /**
    * footer page 
    * 
    * @return  function for fetching recent videos
    */
    function recentStories()
    {
        $this->db->select('videos.video_id,videos.video_title');        
        $this->db->from('videos');                   
        $this->db->where(array('video_status'=> 1));
        $this->db->order_by('video_added_date', 'DESC');
        $this->db->limit('5');
        $result = $this->db->get();          
        $searchresult = $result->result();
        return $searchresult;
    }
    /**
    * searchpage 
    * 
    * @return  function for fetching all videos based on search keyword
    */
    function getAllVideosFromSearch($keyword,$lang,$limit, $offset)
    {
        $query ="SELECT videos.* FROM videos LEFT JOIN video_hash_relation ON video_hash_relation.video_id = videos.video_id
                                      LEFT JOIN video_topic_relation ON video_topic_relation.video_id = videos.video_id 
                                      LEFT JOIN topic ON video_topic_relation.topic_id = topic.topic_id 
                                      LEFT JOIN hash ON video_hash_relation.hash_id = hash.hash_id
                                      WHERE 1 AND videos.video_status ='1' AND videos.video_language = '$lang' AND ( videos.video_title LIKE '%$keyword%' OR videos.video_desc LIKE '%$keyword%'
                                                 OR  topic.topic_name LIKE '%$keyword%' OR hash.hash_name LIKE '%$keyword%')
                                       GROUP BY videos.video_id ORDER BY `videos`.`video_title` ASC LIMIT $offset,$limit
                                        ";
        $result = $this->db->query($query);  
        $searchresult = $result->result();
        return $searchresult;
    }
    /**
    * searchpage 
    * 
    * @return  function for fetching count of all videos based on search keyword
    */
    function videoSearchResultCount($keyword,$lang)
    {
         $query ="SELECT videos.* FROM videos LEFT JOIN video_hash_relation ON video_hash_relation.video_id = videos.video_id
                                      LEFT JOIN video_topic_relation ON video_topic_relation.video_id = videos.video_id 
                                      LEFT JOIN topic ON video_topic_relation.topic_id = topic.topic_id 
                                      LEFT JOIN hash ON video_hash_relation.hash_id = hash.hash_id
                                      WHERE 1 AND videos.video_status ='1' AND videos.video_language = '$lang' AND ( videos.video_title LIKE '%$keyword%' OR videos.video_desc LIKE '%$keyword%'
                                                 OR  topic.topic_name LIKE '%$keyword%' OR hash.hash_name LIKE '%$keyword%')
                                       GROUP BY videos.video_id  
                                        ";
        $result = $this->db->query($query);  
        return $result->num_rows();      
    }
    
    /**
    * tag filtering 
    * 
    * @return  function for fetching all videos based on tag
    */ 
    function getAllVideosFromTags($tags_id,$lang,$limit,$offset)
    {     
       
        $this->db->select('videos.*,video_hash_relation.*');       
        $this->db->from('videos'); 
        $this->db->join('video_hash_relation', 'video_hash_relation.video_id = videos.video_id', 'left'); 
        $this->db->where(array('videos.video_language'=>$lang,'videos.video_status' =>'1','video_hash_relation.hash_id'=>$tags_id));
        $this->db->order_by("video_title", "asc");
        $this->db->limit($limit, $offset);
        
        $result = $this->db->get();     
        $searchresult = $result->result();  
        return $searchresult;        
    }
    /**
    * tag filtering 
    * 
    * @return  function for fetching count of all videos based on tag
    */ 
    
    function countOfAllVideosFromTags($tags_id,$lang)
    {       
        $this->db->select('videos.*,video_hash_relation.*');       
        $this->db->from('videos'); 
        $this->db->join('video_hash_relation', 'video_hash_relation.video_id = videos.video_id', 'left'); 
        $this->db->where(array('videos.video_language'=>$lang,'videos.video_status' =>'1','video_hash_relation.hash_id'=>$tags_id));
                   
        $result = $this->db->get();     
        return $result->num_rows();
    }
    /**
    * tag filtering 
    * 
    * @return  function for fetching tagname based on tag id
    */ 
    function getTagname($tags_id,$lang)
    {
        $this->db->select('hash.hash_name');       
        $this->db->from('hash'); 
        $this->db->where(array('hash.hash_language'=>$lang,'hash.hash_id'=>$tags_id));                   
        $result = $this->db->get();    
        $searchresult = $result->result();  
        return $searchresult;
    }
    function getAllVideos()
    {
        $this->db->select('videos.*');        
        $this->db->from('videos');                   
        $this->db->where(array('video_status'=> 1));
        $this->db->order_by('video_added_date', 'DESC');
        $result = $this->db->get();          
        $searchresult = $result->result();
        return $searchresult;
    }

    function getIssues()
    {
        $this->db->select('flag_issues.*');       
        $this->db->from('flag_issues'); 
                         
        $result = $this->db->get();    
        $issueresult = $result->result();  
        return $issueresult;
    }

    function getIssueById($id)
    {
        $this->db->select('flag_issues.*');       
        $this->db->from('flag_issues'); 
        $this->db->where(array('flag_id'=> $id));                     
        $result = $this->db->get();    
        $issueresult = $result->result();  
        return $issueresult;
    }
     function addFlagReport($datas)
    {

        $insert_data = array(
            
                    'video_id'     => $datas['video_id'],                    
                    'first_name'    => $datas['fname'], 
                    'last_name'  => $datas['lname'],
                    'email'  => $datas['email'],
                    'flag_issue_id'  => $datas['issueTypeVal'],
                    'additional_comments'  => $datas['addilCmts'],
                    'added_on'     => date('Y-m-d H:i:s')
                
                           );   
        
         $this->db->insert('flag_videos', $insert_data);           
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