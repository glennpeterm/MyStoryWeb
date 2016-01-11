<?php
Class M_Home extends CI_Model
{
    function __construct()
    {
        parent::__construct();
       $this->table = 'videos';
       $this->language  = $this->config->item('language');
    }
    
   // --------------------------------------------------------------------

	/**
	 * fetch all topics
	 *
	 * list all topics based on language code
	 *
	 * @param	string langcode
	 * @return	list all topics 
	 */
    function getAllTopics($language)
    {
        $this->db->select('topic.*');
        $this->db->from('topic');        
        $this->db->where('topic_language', $language);           
        $result = $this->db->get();        
        $searchresult = $result->result();       
        return $searchresult;
    }
    
   // --------------------------------------------------------------------

	/**
	 * fetch all languages related to video
	 *
	 * list all languages
	 *
	 * @return  list all languages 
	 */
    function getAllVideoLanguages()
    {
        $this->db->distinct();
        $this->db->select('language,code');
        $this->db->from('videos');  
        $this->db->join('languages', 'languages.code =  videos.video_language'); 
        $this->db->where(array('videos.video_status'=>'1'));
        $result = $this->db->get(); 
        $searchresult = $result->result();       
        return $searchresult;
    }
    // --------------------------------------------------------------------

	/**
	 * fetch all countries related to video
	 *
	 * list all countries
	 *
	 * @return  list all countries 
	 */
    function getAllVideoCountries()
    {
        $this->db->distinct();
        $this->db->select('video_country');
        $this->db->from('videos');  
        $this->db->where(array('videos.video_status'=>'1'));
        $this->db->where(array('videos.video_country !='=>''));
        $result = $this->db->get();        
        $searchresult = $result->result();       
        return $searchresult;
    }

     // --------------------------------------------------------------------

	/**
	 * fetch all featuredvideos based on topics,langcode,video count and country
	 *
	 * list all featured videos
	 *
	 * @return  list all featured videos
	 */
    function getAllFeaturedVideos($topic_id,$langcode,$countrycode,$count_type,$limit,$offset)
    {
         $join = '';
         $condition = '';
       if($topic_id != '')
       {
            if($topic_id != 'all')
            {
                $join = " JOIN video_topic_relation ON video_topic_relation.video_id = videos.video_id";
                $condition .= " AND video_topic_relation.topic_id = $topic_id";
            }
       }
       if($langcode != '')
       {
            if($langcode != 'all')
            {
                 $condition .= " AND videos.video_language = '$langcode'";
            }
       }
       if($countrycode != '')
       {
            if($countrycode != 'all')
            {
                 $condition .= " AND videos.video_country = '$countrycode'";
            }
       }
       if($count_type !='')
       {    
           if($count_type != 'all')
            {
                if($count_type == 1)
                {
                   $orderby_condtn = " ORDER BY videos.video_youtube_likes desc ";
                }
                elseif ($count_type == 2) 
                {
                    $orderby_condtn = " ORDER BY videos.video_youtube_view_count desc ";                    
                }
                elseif ($count_type == 3) 
                {
                    $orderby_condtn = " ORDER BY videos.video_twitter_share desc "; 
                    
                }
                elseif ($count_type == 4) 
                {
                    $orderby_condtn = " ORDER BY videos.video_added_date desc "; 
                    
                }
            }
            else
            {
                $orderby_condtn = " ORDER BY videos.video_added_date desc "; 
            }
           
       }
        
       $db_query = "SELECT videos.*
                    FROM (videos) ".$join." WHERE videos.video_highlight =  '1'
                    AND videos.video_status =  '1' ".$condition. $orderby_condtn." LIMIT $offset,$limit ";
       $result = $this->db->query($db_query);     
        $searchresult = $result->result();  
        
        return $searchresult;           
        
    }
    // --------------------------------------------------------------------

	/**
	 * fetch all normalvideos based on topics,langcode,video count and country
	 *
	 * list all normal videos
	 *
	 * @return  list all normal videos
	 */    
   function getAllNormalVideos($topic_id,$langcode,$countrycode,$count_type,$limit,$offset)
    {
         $join = '';
         $condition = '';
       if($topic_id != '')
       {
            if($topic_id != 'all')
            {
                $join = " JOIN video_topic_relation ON video_topic_relation.video_id = videos.video_id";
                $condition .= " AND video_topic_relation.topic_id = $topic_id";
            }
       }
       if($langcode != '')
       {
            if($langcode != 'all')
            {
                 $condition .= " AND videos.video_language = '$langcode'";
            }
       }
       if($countrycode != '')
       {
            if($countrycode != 'all')
            {
                 $condition .= " AND videos.video_country = '$countrycode'";
            }
       }
       if($count_type !='')
       {    
           if($count_type != 'all')
            {
                if($count_type == 1)
                {
                   $orderby_condtn = " ORDER BY videos.video_youtube_likes desc ";
                }
                elseif ($count_type == 2) 
                {
                    $orderby_condtn = " ORDER BY videos.video_youtube_view_count desc ";                    
                }
                elseif ($count_type == 3) 
                {
                    $orderby_condtn = " ORDER BY videos.video_twitter_share desc "; 
                    
                }
                elseif ($count_type == 4) 
                {
                    $orderby_condtn = " ORDER BY videos.video_added_date desc "; 
                    
                }
            }
            else
            {
                $orderby_condtn = " ORDER BY videos.video_added_date desc "; 
            }
           
       }
        
       $db_query = "SELECT videos.*
                    FROM (videos) ".$join." WHERE videos.video_highlight =  '0'
                    AND videos.video_status =  '1' ".$condition. $orderby_condtn." LIMIT $offset,$limit ";
       $result = $this->db->query($db_query);     
        $searchresult = $result->result();  
        
        return $searchresult;           
        
    }
    // --------------------------------------------------------------------

	/**
	 * fetch all featured videos count based on topics,langcode,video count and country
	 *
	 *  featured video count
	 *
	 * @return  featured video count
	 */   
    function getAllFeaturedVideosCount($topic_id,$langcode,$countrycode,$count_type)
    {
         $join = '';
         $condition = '';
       if($topic_id != '')
       {
            if($topic_id != 'all')
            {
                $join = " JOIN video_topic_relation ON video_topic_relation.video_id = videos.video_id";
                $condition .= " AND video_topic_relation.topic_id = $topic_id";
            }
       }
       if($langcode != '')
       {
            if($langcode != 'all')
            {
                 $condition .= " AND videos.video_language = '$langcode'";
            }
       }
       if($countrycode != '')
       {
            if($countrycode != 'all')
            {
                 $condition .= " AND videos.video_country = '$countrycode'";
            }
       }
       if($count_type !='')
       {    
           if($count_type != 'all')
            {
                if($count_type == 1)
                {
                   $orderby_condtn = " ORDER BY videos.video_youtube_likes desc ";
                }
                elseif ($count_type == 2) 
                {
                    $orderby_condtn = " ORDER BY videos.video_youtube_view_count desc ";                    
                }
                elseif ($count_type == 3) 
                {
                    $orderby_condtn = " ORDER BY videos.video_twitter_share desc "; 
                    
                }
                elseif ($count_type == 4) 
                {
                    $orderby_condtn = " ORDER BY videos.video_added_date desc "; 
                    
                }
            }
            else
            {
                $orderby_condtn = " ORDER BY videos.video_added_date desc "; 
            }
           
       }
        
       $db_query = "SELECT videos.*
                    FROM (videos) ".$join." WHERE videos.video_highlight =  '1'
                    AND videos.video_status =  '1' ".$condition. $orderby_condtn;
       $result = $this->db->query($db_query);     
       return $result->num_rows();     
        
    }
    // --------------------------------------------------------------------

	/**
	 * fetch all normal videos count based on topics,langcode,video count and country
	 *
	 *  normal video count
	 *
	 * @return  normal video count
	 */       
   function getAllNormalVideosCount($topic_id,$langcode,$countrycode,$count_type)
    {
         $join = '';
         $condition = '';
       if($topic_id != '')
       {
            if($topic_id != 'all')
            {
                $join = " JOIN video_topic_relation ON video_topic_relation.video_id = videos.video_id";
                $condition .= " AND video_topic_relation.topic_id = $topic_id";
            }
       }
       if($langcode != '')
       {
            if($langcode != 'all')
            {
                 $condition .= " AND videos.video_language = '$langcode'";
            }
       }
       if($countrycode != '')
       {
            if($countrycode != 'all')
            {
                 $condition .= " AND videos.video_country = '$countrycode'";
            }
       }
       if($count_type !='')
       {    
           if($count_type != 'all')
            {
                if($count_type == 1)
                {
                   $orderby_condtn = " ORDER BY videos.video_youtube_likes desc ";
                }
                elseif ($count_type == 2) 
                {
                    $orderby_condtn = " ORDER BY videos.video_youtube_view_count desc ";                    
                }
                elseif ($count_type == 3) 
                {
                    $orderby_condtn = " ORDER BY videos.video_twitter_share desc "; 
                    
                }
                elseif ($count_type == 4) 
                {
                    $orderby_condtn = " ORDER BY videos.video_added_date desc "; 
                    
                }
            }
            else
            {
                $orderby_condtn = " ORDER BY videos.video_added_date desc "; 
            }
           
       }
        
       $db_query = "SELECT videos.*
                    FROM (videos) ".$join." WHERE videos.video_highlight =  '0'
                    AND videos.video_status =  '1' ".$condition. $orderby_condtn;
       $result = $this->db->query($db_query);     
       return $result->num_rows(); 
        
    }
     // --------------------------------------------------------------------

	/**
	 * fetch 5 banner videos
	 *
	 * @return  list all banner videos of limit 5
	 */  
    function getAllBannerVideos()
    {
        $this->db->select('videos.*');        
        $this->db->from('videos');                   
        $this->db->where(array('video_status'=> 1,'video_banner'=>'1'));
        $this->db->order_by('video_added_date', 'DESC');
        $this->db->limit(5);
        $result = $this->db->get(); 
        $searchresult = $result->result();
        return $searchresult;
    }
}   