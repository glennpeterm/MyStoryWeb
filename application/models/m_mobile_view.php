<?php
Class M_Mobile_View extends CI_Model
{
    function __construct()
    {
        parent::__construct();
       $this->table = 'videos';
    }
     // function for fetching all videodetials
    function getAllSelfieVideos($userid,$lang)
    {
        $this->db->select('videos.*');       
        $this->db->from('videos'); 
        $this->db->where(array('video_type'=>'selfie','user_id'=>$userid));
         
        $result = $this->db->get();        
        $searchresult = $result->result();   
        //echo $this->db->last_query();exit;
        return $searchresult;        
    }
    function getYoutubeVideoid($videoid)
    {
        $this->db->select('videos.video_youtube_id');       
        $this->db->from('videos'); 
        $this->db->where(array('video_id'=>$videoid,'video_status' =>'1'));  
        $result = $this->db->get();
        $searchresult = $result->result();   
        return $searchresult;              
    }
    function deleteVideoHashTopicDetails($videoid)
    {
        $del_query ="DELETE FROM video_hash_relation, video_topic_relation
                    USING  video_hash_relation,  video_topic_relation
                    WHERE video_hash_relation.video_id  = video_topic_relation.video_id  AND
                    video_topic_relation.video_id  = ".$videoid;
        $this->db->query($del_query);
        return $videoid;
      
    }
    
    function deleteSelfieVideos($video_id)
    {       
        $videoid = $this->deleteVideoHashTopicDetails($video_id);
        $this->db->where(array('video_id'=> $video_id))->delete('videos');
        return $video_id;
    }
    
    function getAllChannelVideos($lang,$limit, $offset)
    {
        $this->db->select('videos.*');       
        $this->db->from('videos'); 
        $this->db->where(array('video_status' =>'1'));  
         $this->db->limit($limit, $offset);
        $result = $this->db->get();     
        //echo $this->db->last_query();
        $searchresult = $result->result();   
        return $searchresult;        
    }
   
    function getAllChannelVideosCount($lang)
    {
        $this->db->select('videos.*');       
        $this->db->from('videos'); 
        $this->db->where(array('video_status' =>'1'));  
        $result = $this->db->get();        
        return $result->num_rows();       
    }
    
    
    function getAllTopics($language)
    {
        $this->db->select('topic.*');
        $this->db->from('topic');        
        $this->db->where('topic_language', $language);           
        $result = $this->db->get();        
        $searchresult = $result->result();       
        return $searchresult;
    }
    
       
    
    function getAllVideosFromTopics($topic_id,$lang,$limit,$offset)
    {
      
        if($topic_id == 'all')
        {
            $topic_array = array();
            $topics_id = $this->getAllTopics($lang);
            foreach($topics_id as $topic)
            {
                $topic_array[] = $topic->topic_id;
            }
            
            $this->db->select('videos.*,video_topic_relation.*');       
            $this->db->from('videos'); 
            $this->db->join('video_topic_relation', 'video_topic_relation.video_id = videos.video_id', 'left');
            $this->db->where(array('videos.video_status' =>'1'));
            $this->db->like('title', $keyword);
            $this->db->group_by('videos.video_id'); 
            $this->db->limit($limit, $offset);
        }
        else
        {
            $this->db->select('videos.*,video_topic_relation.*');       
            $this->db->from('videos'); 
            $this->db->join('video_topic_relation', 'video_topic_relation.video_id = videos.video_id', 'left'); 
            $this->db->where(array('videos.video_status' =>'1','video_topic_relation.topic_id'=>$topic_id));
            $this->db->like('title', $keyword);
            $this->db->limit($limit, $offset);
        }  
        
        $result = $this->db->get();     
        $searchresult = $result->result();  
        return $searchresult;
        
    }
    
    
    function filterResultCount($topic_id,$lang)
    {
        if($topic_id == 'all')
        {
            $topic_array = array();
            $topics_id = $this->getAllTopics($lang);
            foreach($topics_id as $topic)
            {
                $topic_array[] = $topic->topic_id;
            }
            
            $this->db->select('videos.*,video_topic_relation.*');       
            $this->db->from('videos'); 
            $this->db->join('video_topic_relation', 'video_topic_relation.video_id = videos.video_id', 'left');
            $this->db->where(array('videos.video_status' =>'1'));
            $this->db->like('title', $keyword);
            $this->db->group_by('videos.video_id'); 
            
        }
        else
        {
            $this->db->select('videos.*,video_topic_relation.*');       
            $this->db->from('videos'); 
            $this->db->join('video_topic_relation', 'video_topic_relation.video_id = videos.video_id', 'left'); 
            $this->db->where(array('videos.video_status' =>'1','video_topic_relation.topic_id'=>$topic_id));
            $this->db->like('title', $keyword);
            
        }  
        
        $result = $this->db->get();     
        return $result->num_rows();
    }
    function getAllVideosFromSearch($keyword,$topic,$lang,$limit, $offset)
    {

        $aa ='';
        if($topic!='' && $topic!='all')
        {
            $aa = "video_topic_relation.topic_id = $topic and";
        }
         $bb ='';
        if($keyword!='')
        {
            $bb = "AND ( videos.video_title LIKE '%$keyword%' OR videos.video_desc LIKE '%$keyword%'
                                                 OR  topic.topic_name LIKE '%$keyword%' OR hash.hash_name LIKE '%$keyword%')";
        }
        $query ="SELECT  videos.* FROM videos LEFT JOIN video_hash_relation ON video_hash_relation.video_id = videos.video_id
                                      LEFT JOIN video_topic_relation ON video_topic_relation.video_id = videos.video_id 
                                      LEFT JOIN topic ON video_topic_relation.topic_id = topic.topic_id 
                                      LEFT JOIN hash ON video_hash_relation.hash_id = hash.hash_id
                                      WHERE $aa  1 AND videos.video_status ='1'  $bb
                                       GROUP BY videos.video_id LIMIT $offset,$limit
                                        ";
        $result = $this->db->query($query);  
        $searchresult = $result->result();
        return $searchresult;
    }
    function videoSearchResultCount($keyword,$topic,$lang)
    {
        $aa ='';
       if($topic!='' && $topic!='all')
        {
            $aa = "video_topic_relation.topic_id = $topic and";
        }
         $bb ='';
        if($keyword!='')
        {
            $bb = "AND ( videos.video_title LIKE '%$keyword%' OR videos.video_desc LIKE '%$keyword%'
                                                 OR  topic.topic_name LIKE '%$keyword%' OR hash.hash_name LIKE '%$keyword%')";
        }

         $query ="SELECT videos.* FROM videos LEFT JOIN video_hash_relation ON video_hash_relation.video_id = videos.video_id
                                      LEFT JOIN video_topic_relation ON video_topic_relation.video_id = videos.video_id 
                                      LEFT JOIN topic ON video_topic_relation.topic_id = topic.topic_id 
                                      LEFT JOIN hash ON video_hash_relation.hash_id = hash.hash_id
                                      WHERE $aa 1 AND videos.video_status ='1' $bb
                                       GROUP BY videos.video_id  
                                        ";
        $result = $this->db->query($query);  
        return $result->num_rows();      
    }
    
    function getVideoDetails($video_id)
    {       
        $this->db->select('videos.*');       
        $this->db->from('videos');           
        $this->db->where('video_id', $video_id);
        $result = $this->db->get();        
        //echo $str = $this->db->last_query();exit;
        $searchresult = $result->result();
        return $searchresult;
    }

    function changePrivacySettings($videoId,$privacyValue)
    {
        $upDdata = array();
       $upDdata['video_youtube_status'] = $privacyValue; 
       if($privacyValue=='private')
       {
            $statusVal='0';
       }
       else
       {
        $statusVal='1';
       }
       $upDdata['video_status'] = $statusVal; 
       $this->db->update('videos', $upDdata, array('video_id' => $videoId)); 
    }
    function getYoutubeIdFromVideoId($videoid)
    {
        $this->db->select('videos.video_youtube_id');       
        $this->db->from('videos'); 
        $this->db->where(array('video_id'=>$videoid));  
        $result = $this->db->get();
        $searchresult = $result->result();   
        return $searchresult;              
    }
}   