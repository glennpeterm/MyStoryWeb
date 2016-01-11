<?php
Class M_Home extends CI_Model
{
    function __construct()
    {
        parent::__construct();
       $this->table = 'videos';
       $this->language  = $this->config->item('language');
    }
    
    
    
    function getFeaturedVideos($limit,$offset)
    {
        $this->db->select('videos.video_thumbnail_url,videos.video_id,videos.video_title,videos.video_desc,videos.video_youtube_id');        
        $this->db->from('videos');                   
        $this->db->where(array('video_status'=> 1,'video_highlight'=>'1'));
        $this->db->order_by('video_added_date', 'DESC');
        $this->db->limit($limit, $offset);
        $result = $this->db->get(); 
        $searchresult = $result->result();
        return $searchresult;
    }
    function getNormalVideos($limit,$offset)
    {
        $this->db->select('videos.video_thumbnail_url,videos.video_id,videos.video_title,videos.video_desc,videos.video_youtube_id');        
        $this->db->from('videos');                   
        $this->db->where(array('video_status'=> 1,'video_highlight'=>'0'));
        $this->db->order_by('video_added_date', 'DESC');
        $this->db->limit($limit, $offset);
        $result = $this->db->get(); 
        $searchresult = $result->result();
        return $searchresult;
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
    
    function getNormalVideosBasedOnTopic($topic_id,$limit,$offset)
    {
      
        if($topic_id == 'all')
        {
            $topic_array = array();
            $topics_id = $this->getAllTopics($this->language);
            foreach($topics_id as $topic)
            {
                $topic_array[] = $topic->topic_id;
            }
            
            $this->db->select('videos.*');       
            $this->db->from('videos'); 
            $this->db->join('video_topic_relation', 'video_topic_relation.video_id = videos.video_id', 'left');
            $this->db->where(array('video_highlight'=>'0','videos.video_status' =>'1'));
            $this->db->group_by('videos.video_id'); 
            $this->db->limit($limit, $offset);
        }
        else
        {
            $this->db->select('videos.*');       
            $this->db->from('videos'); 
            $this->db->join('video_topic_relation', 'video_topic_relation.video_id = videos.video_id', 'left'); 
            $this->db->where(array('video_highlight'=>'0','videos.video_status' =>'1','video_topic_relation.topic_id'=>$topic_id));
            $this->db->limit($limit, $offset);
        }  
        
        $result = $this->db->get();     
        $searchresult = $result->result();  
        return $searchresult;
        
    }
   function getFeaturedVideosBasedOnTopic($topic_id,$limit,$offset)
    {
      
        if($topic_id == 'all')
        {
            $topic_array = array();
            $topics_id = $this->getAllTopics($this->language);
            foreach($topics_id as $topic)
            {
                $topic_array[] = $topic->topic_id;
            }
            
            $this->db->select('videos.*');       
            $this->db->from('videos'); 
            $this->db->join('video_topic_relation', 'video_topic_relation.video_id = videos.video_id', 'left');
            $this->db->where(array('video_highlight'=>'1','videos.video_status' =>'1'));
            $this->db->group_by('videos.video_id'); 
            $this->db->limit($limit, $offset);
        }
        else
        {
            $this->db->select('videos.*');       
            $this->db->from('videos'); 
            $this->db->join('video_topic_relation', 'video_topic_relation.video_id = videos.video_id', 'left'); 
            $this->db->where(array('video_highlight'=>'1','videos.video_status' =>'1','video_topic_relation.topic_id'=>$topic_id));
            $this->db->limit($limit, $offset);
        }  
        
        $result = $this->db->get();     
        $searchresult = $result->result();  
        return $searchresult;
        
    }
    function getAllVideoLanguages()
    {
        $this->db->distinct();
        $this->db->select('language,code');
        $this->db->from('videos');  
        $this->db->join('languages', 'languages.code =  videos.video_language'); 
        $result = $this->db->get(); 
        $searchresult = $result->result();       
        return $searchresult;
    }
    function getAllVideoCountries()
    {
        $this->db->distinct();
        $this->db->select('video_country');
        $this->db->from('videos');  
        $this->db->where(array('videos.video_country !='=>''));
        $result = $this->db->get();        
        $searchresult = $result->result();       
        return $searchresult;
    }
    
    function getNormalVideosBasedOnLang($langcode,$limit,$offset)
    {
      
        if($langcode == 'all')
        {        
            $this->db->select('videos.*');       
            $this->db->from('videos');             
            $this->db->where(array('videos.video_highlight'=>'0','videos.video_status' =>'1'));
            $this->db->group_by('videos.video_id'); 
            $this->db->limit($limit, $offset);
        }
        else
        {
            $this->db->select('videos.*');       
            $this->db->from('videos'); 
            $this->db->where(array('videos.video_highlight'=>'0','videos.video_status' =>'1','videos.video_language'=>$langcode));
            $this->db->limit($limit, $offset);
            
        }  
        
        $result = $this->db->get();     
        $searchresult = $result->result();  
        
        return $searchresult;
        
    }
    
    function getFeaturedVideosBasedOnLang($langcode,$limit,$offset)
    {
      
        if($langcode == 'all')
        {
            $this->db->select('videos.*');       
            $this->db->from('videos'); 
            $this->db->where(array('video_highlight'=>'1','videos.video_status' =>'1'));
            $this->db->group_by('videos.video_id'); 
            $this->db->limit($limit, $offset);
        }
        else
        {
            $this->db->select('videos.*');       
            $this->db->from('videos');            
            $this->db->where(array('video_highlight'=>'1','videos.video_status' =>'1','videos.video_language'=>$langcode));
            $this->db->limit($limit, $offset);
        }  
        
        $result = $this->db->get();     
        $searchresult = $result->result();  
        
        return $searchresult;
        
    }
    function getNormalVideosBasedOnCountry($countrycode,$limit,$offset)
    {
      
        if($countrycode == 'all')
        {        
            $this->db->select('videos.*');       
            $this->db->from('videos');             
            $this->db->where(array('videos.video_highlight'=>'0','videos.video_status' =>'1'));
            $this->db->group_by('videos.video_id'); 
            $this->db->limit($limit, $offset);
        }
        else
        {
            $this->db->select('videos.*');       
            $this->db->from('videos'); 
            $this->db->where(array('videos.video_highlight'=>'0','videos.video_status' =>'1','videos.video_country'=>$countrycode));
            $this->db->limit($limit, $offset);
            
        }  
        
        $result = $this->db->get();     
        $searchresult = $result->result();  
        
        return $searchresult;
        
    }
    
    function getFeaturedVideosBasedOnCountry($countrycode,$limit,$offset)
    {
      
        if($countrycode == 'all')
        {
            $this->db->select('videos.*');       
            $this->db->from('videos'); 
            $this->db->where(array('video_highlight'=>'1','videos.video_status' =>'1'));
            $this->db->group_by('videos.video_id'); 
            $this->db->limit($limit, $offset);
        }
        else
        {
            $this->db->select('videos.*');       
            $this->db->from('videos');            
            $this->db->where(array('video_highlight'=>'1','videos.video_status' =>'1','videos.video_country'=>$countrycode));
            $this->db->limit($limit, $offset);
        }  
        
        $result = $this->db->get();     
        $searchresult = $result->result();  
        
        return $searchresult;
        
    }
    
     function getNormalVideosBasedOnVideoCount($counttype,$limit,$offset)
    {
      
        if($counttype == 'all')
        {        
            $this->db->select('videos.*');       
            $this->db->from('videos');             
            $this->db->where(array('videos.video_highlight'=>'0','videos.video_status' =>'1'));
            $this->db->group_by('videos.video_id'); 
            $this->db->limit($limit, $offset);
        }
        else
        {
            $this->db->select('videos.*');       
            $this->db->from('videos'); 
            $this->db->where(array('videos.video_highlight'=>'0','videos.video_status' =>'1'));
            if($counttype == 1)
            {
                $this->db->order_by('videos.video_youtube_likes', 'desc');
            }
            elseif ($counttype == 2) 
            {
                $this->db->order_by('videos.video_youtube_view_count', 'desc');
            }
            elseif ($counttype == 3) 
            {
                $this->db->order_by('videos.video_twitter_share', 'desc');
            }
            elseif ($counttype == 4) 
            {
                $this->db->order_by('videos.video_added_date', 'desc');
            }
            $this->db->limit($limit, $offset);
            
        }  
        
        $result = $this->db->get();     
        $searchresult = $result->result();  
        
        return $searchresult;        
    }
    
    function getFeaturedVideosBasedOnVideoCount($counttype,$limit,$offset)
    {
      
        if($counttype == 'all')
        {
            $this->db->select('videos.*');       
            $this->db->from('videos'); 
            $this->db->where(array('video_highlight'=>'1','videos.video_status' =>'1'));
            $this->db->group_by('videos.video_id'); 
            $this->db->limit($limit, $offset);
        }
        else
        {
            $this->db->select('videos.*');       
            $this->db->from('videos');            
            $this->db->where(array('video_highlight'=>'1','videos.video_status' =>'1'));
            if($counttype == 1)
            {
                $this->db->order_by('videos.video_youtube_likes', 'desc');
            }
            elseif ($counttype == 2) 
            {
                $this->db->order_by('videos.video_youtube_view_count', 'desc');
            }
            elseif ($counttype == 3) 
            {
                $this->db->order_by('videos.video_twitter_share', 'desc');
            }
            elseif ($counttype == 4) 
            {
                $this->db->order_by('videos.video_added_date', 'desc');
            }
            $this->db->limit($limit, $offset);
        }  
        
        $result = $this->db->get();     
        $searchresult = $result->result();  
        
        return $searchresult;
        
    }
}   