 <?php
Class M_Videos extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        
        $this->user_role = $this->session->userdata('kms_ad_role');
        $this->userid    = $this->session->userdata('kms_ad_id');      
        $this->language  = $this->config->item('language');
       
    }
   
     // insert and update scripture videos            
    function saveDetails($datas)
    {
        
        $scripture_text = '';
        if(isset($datas['scripture_text']))
        {
            $scripture_text = $datas['scripture_text'];
        }
        $country = '';
        if(isset($datas['country']))
        {
            $country = $datas['country'];
        }
        $language = '';
        if(isset($datas['language']))
        {
            $language = $datas['language'];
        }
        
        $book_id = '';
        if(isset($datas['book_id']))
        {
            $book_id = $datas['book_id'];
        }
        $book_name = '';
        if(isset($datas['book_name']))
        {
            $book_name = $datas['book_name'];
        }
        $book_order = '';
        if(isset($datas['book_order']))
        {
            $book_order = $datas['book_order'];
        }
        $chapter = '';
        if(isset($datas['chapter']))
        {
            $chapter = $datas['chapter'];
        }
        $verse = '';
        if(isset($datas['verse']))
        {
            $verse = $datas['verse'];
        }
        $bible_name = '';
        if(isset($datas['bible_name']))
        {
            $bible_name = $datas['bible_name'];
        }
        
        $insert_data = array(    
                       
                        'video_title'           => $datas['video_title'],
                        'video_desc'            => $datas['video_desc'],   
                        'video_short_desc'      => $datas['video_short_desc'],    
                        'scripture_text'        => $scripture_text, 
                        'book_id'               => $book_id, 
                        'book_name'             => $book_name, 
                        'book_order'            => $book_order, 
                        'chapter'               => $chapter, 
                        'verse'                 => $verse,
                        'bible_name'            => $bible_name, 
            
                        'video_youtube_id'      => $datas['video_youtube_id'],
                        'video_language'        => $language,
                        'video_country'         => $country,
                        'video_embed'           => $datas['embed_code'],
                        'video_url'             => $datas['video_url'],
                        'video_thumbnail_url'   => $datas['thumbnail_url'],
                        'video_status'          => $datas['video_status'],
                        'video_highlight'       => $datas['highlight'],
                        'video_banner'          => $datas['banner'],
                        'video_type'            => $datas['video_type']
                       ); 
        
        
                    
        if($datas['id'])
        {
            $this->db->where('video_id',$datas['id']);
            $this->db->update('videos', $insert_data);
            $del_videoid         = $this->deleteVideoHashTopicDetails($datas['id']);                
            $new_tagsarray       = $this->saveHashdata($datas['video_tag'],$datas['id']);
            $new_topicsarray     = $this->saveTopicsdata($datas['topics'],$datas['id']);
            $lastid= $datas['id'];
            
            if( empty( $new_tagsarray )|| empty( $new_topicsarray )|| empty($lastid))
            {
                $returnval= 'false';
                return $returnval;
            }
            else
            {
                $returnval= $lastid;
                return $returnval;
            }
        }
       else 
       {  

            $this->db->insert('videos', $insert_data);
            $lastid          = $this->db->insert_id();   
            $new_tagsarray   = $this->saveHashdata($datas['video_tag'],$lastid);
            $new_topicsarray = $this->saveTopicsdata($datas['topics'],$lastid);
            
            if( empty( $new_tagsarray )|| empty( $new_topicsarray )|| empty($lastid))
            {
                $returnval= 'false';
                return $returnval;
            }
            else
            {
                $returnval= $lastid;
                return $returnval;
            }

      }
        
    }
    // end of insert and update scripture videos      
    
    // delete function for deleting hash tags and topics related to a particular video relation
    function deleteVideoHashTopicDetails($videoid)
    {
        $del_query ="DELETE FROM video_hash_relation, video_topic_relation
                    USING  video_hash_relation,  video_topic_relation
                    WHERE video_hash_relation.video_id  = video_topic_relation.video_id  AND
                    video_topic_relation.video_id  = ".$videoid;
        $this->db->query($del_query);
        return $videoid;
      
    }
    
    // end of delete function for deleting hash tags and topics related to a particular video relation
    
    // hash tag save function for particular video id
    function saveHashdata($videotags,$videoid)
    {
        $tags_array =array();
        $exploded_array = explode(",",$videotags);
        foreach ($exploded_array as $tags)
        {          
            $tagid  = $this->getTagid($tags);
            
            if(!$tagid)
            { 
                 $tags_array[] = $this->newTagInsertion($tags);
            }
           else 
            {
                $tags_array[] = $tagid;
            }
        }
        foreach($tags_array as $new_tags)
        {
            $insert_data = array(
                        'video_id'   => $videoid,
                        'hash_id'    => $new_tags
                     );
            $this->db->insert('video_hash_relation', $insert_data);
            $lastid = $this->db->insert_id();
                        
        }
        return $tags_array;
    }
    
     // End of hash tag save function for particular video id
    
    // insert function for new tag entry in video add section
    function newTagInsertion($tags)
    {
        $insert_data = array(                                                
                        'hash_name'   => strtolower($tags),
                        'hash_language'   => $this->language
            );
        $this->db->insert('hash', $insert_data);
        $lastid = $this->db->insert_id();
        return $lastid ;
    }
    
      
    // End of insert function for new tag entry in video add section
    
    // insertion function for all topics related to a particular video id
    function saveTopicsdata($videotopics,$videoid)
    {
        $topics_array =array();
        foreach($videotopics as $topic_id)
        {
            $insert_data = array(
                        'video_id'   => $videoid,
                        'topic_id'    => $topic_id
                     );
            $this->db->insert('video_topic_relation', $insert_data);
            $topics_array [] = $topic_id;
            $lastid = $this->db->insert_id();                        
        }
        return $topics_array;
        
    }
    
     // End of insertion function for all topics related to a particular video id
    
    // function for fetching hash tag id using hahtag name
    function getTagid($tags)
    {
        
        $videotag = trim($tags);
        $this->db->select('hash.hash_id');
        $this->db->from('hash');        
        if($this->user_role!=1)
        {
            $this->db->where('hash_language', $this->language);
        }  
        $this->db->where('hash_name', strtolower($videotag));
        $result = $this->db->get();
        $row = $result->row();        
        if($result->num_rows() > 0){
        return $row->hash_id;
        }
    }
     // End of function for fetching hash tag id using hahtag name
    
       // function for fetching all videodetials
    function getAllVideoDetails($video_type)
    {
        if($video_type == 'selfie')
        {
            $this->db->select('videos.*,user.first_name,user.last_name');
        }
        else 
            {
            $this->db->select('videos.*');
        }
        
        $this->db->from('videos'); 
        
        if($video_type == 'selfie')
        {
            $this->db->join('user', 'user.id = videos.user_id', 'left');
        }
        $this->db->where('video_type',  $video_type);
        $this->db->order_by("video_added_date", "desc"); 
        if($this->user_role!=1)
        {
            //$this->db->where('video_language',  $this->language);
        }     
        $result = $this->db->get();        
        $searchresult = $result->result();   
        //echo $this->db->last_query();exit;
        return $searchresult;
        
    }
   
    // function for fetching vidodetails of a particular video id
    function getVideoDetails($videoid,$video_type)
    {
        
        if($video_type == 'selfie')
        {
            $this->db->select('videos.*,user.first_name,user.last_name,languages.language');
        }
        else 
            {
            $this->db->select('videos.*');
        }
        
        $this->db->from('videos'); 
       
        if($video_type == 'selfie')
        {
            $this->db->join('user', 'user.id = videos.user_id', 'left');
            $this->db->join('languages', 'languages.code = videos.video_language', 'left');
        }
        
        $this->db->where('video_type',  $video_type);
        if($this->user_role!=1)
        {
           // $this->db->where('video_language', $this->language);
        }     
        $this->db->where('video_id', $videoid);
        $result = $this->db->get();        
        //echo $str = $this->db->last_query();exit;
        $searchresult = $result->result();
        return $searchresult;
    }
    // end of function for fetching vidodetails of a particular video id
    
    // function for fetching hastag detils of a particular video id
    function getVideoHahtagDetails($videoid)
    {
        $this->db->select('video_hash_relation.*,hash.hash_name');
        $this->db->from('video_hash_relation');
        $this->db->join('hash', 'hash.hash_id = video_hash_relation.hash_id', 'left');
        if($this->user_role!=1)
        {
            $this->db->where('hash.hash_language', $this->language);
        }     
        $this->db->where('video_hash_relation.video_id', $videoid);
        $result = $this->db->get();        
        //echo $str = $this->db->last_query();exit;
        $searchresult = $result->result();
        return $searchresult;
    }
     // End of function for fetching hastag detils of a particular video id
    
     // function for fetching topic detils of a particular video id
    function getVideoTopicDetails($videoid)
    {
        $this->db->select('video_topic_relation.*,topic.topic_name');
        $this->db->from('video_topic_relation');
        $this->db->join('topic', 'topic.topic_id = video_topic_relation.topic_id', 'left');
        if($this->user_role!=1)
        {
            $this->db->where('topic.topic_language', $this->language);
        }     
        $this->db->where('video_topic_relation.video_id', $videoid);
        $result = $this->db->get();       
        $searchresult = $result->result();
        return $searchresult;
    }
    
    
     // End function for fetching hastag detils of a particular video id
    
    //function for fetching all hashtags
    function getHashtags($language,$role)
    {
        $this->db->select('hash.hash_name');
        $this->db->from('hash');        
        if($role!=1)
        {
            $this->db->where('hash_language', $language);
        }     
        $result = $this->db->get();        
        $searchresult = $result->result();
        return $searchresult;
        
    }
     
    // End of function for fetching all hashtags
    
    //function for fetching all topics
    function getTopics($language,$role)
    {
        $this->db->select('topic.*');
        $this->db->from('topic');   
        $this->db->where('topic_status', 'active');     
        if($role!=1)
        {
            $this->db->where('topic_language', $language);
        }     
        $result = $this->db->get();        
        $searchresult = $result->result();
        return $searchresult;
        
    }
    // End of function for fetching all topics
    
    //function for deleting particular videoid
    function deleteVideoDetails($id,$video_type)
    {
        $videoid = $this->deleteVideoHashTopicDetails($id);
        $this->db->where(array('video_id'=> $id,'video_type' => $video_type))->delete('videos');
        return $id;
    }
    // End of function for deleting particular videoid
    
 
   
    // function for setting  video status
    public function setStatus($statusVal)
    {                
       $upDdata = array();
       $upDdata['video_status'] = $statusVal; 
       $this->db->update('videos', $upDdata, array('video_id' => $this->input->post('id')));      
       return true;
    }
    // End of function for setting  video status
    
    
    
    // checking function for video id already exist in DB
    function videoidAlreadyExist($videoid,$language,$role,$video_type)
    {
        $this->db->select('videos.*');
        $this->db->from('videos');        
        if($role!=1)
        {
            $this->db->where('video_language', $language);
        }  
        $this->db->where(array('video_youtube_id'=>$videoid,'video_type' => $video_type));        
        
        $result = $this->db->get();     
      //  echo $this->db->last_query();exit;
        return $result->num_rows();  
    }
    
    function bannerVideoCount()
    {
        
        $this->db->select('videos.*');
        $this->db->from('videos');        
        if( $this->user_role!=1)
        {
            //$this->db->where('video_language', $this->language);
        }  
        $this->db->where(array('video_banner'=>"1"));        
        
        $result = $this->db->get();     
        return $result->num_rows();  
    }
    
    
       // function for fetching all bannervideos
    function getAllBannerVideoDetails()
    {
        
         $this->db->select('videos.*');
      
        $this->db->from('videos'); 
       
        $this->db->where('video_banner',  "1");
        if($this->user_role!=1)
        {
            //$this->db->where('video_language',  $this->language);
        }     
        $result = $this->db->get();        
        $searchresult = $result->result();   
        return $searchresult;
        
    }
   
     // function for setting  banner status
    public function set_banner_status()
    {                
       $upDdata = array();
       $upDdata['video_banner'] = $this->input->post('status'); 
       $this->db->update('videos', $upDdata, array('video_id' => $this->input->post('id')));    
       return true;
    }
    // End of function for setting  banner status
    
    
       // function for fetching all featured videos
     function getAllFeaturedVideoDetails()
    {        
        $this->db->select('videos.*');      
        $this->db->from('videos'); 
       
        $this->db->where('video_highlight',  "1");
        if($this->user_role!=1)
        {
            //$this->db->where('video_language',  $this->language);
        }   
        
        $result = $this->db->get();  
        $searchresult = $result->result();   
        return $searchresult;        
    }
    
    
     // function for setting  featued status
    public function set_featured_status()
    {                
       $upDdata = array();
       $upDdata['video_highlight'] = $this->input->post('status'); 
       $this->db->update('videos', $upDdata, array('video_id' => $this->input->post('id')));    
       return true;
    }

    function getAllCountry()
    {
        $this->db->select('countries.*');      
        $this->db->from('countries'); 
        $result = $this->db->get();  
        $searchresult = $result->result();   
        return $searchresult;  
    }

    function getAllLanguages()
    {
        $this->db->select('languages.*');      
        $this->db->from('languages'); 
        $result = $this->db->get();  
        $searchresult = $result->result();   
        return $searchresult;  
    }
    
    
    function newSelfievideos()
    {
        $this->db->select('videos.*');
        $this->db->from('videos');        
        $this->db->where(array('video_type' => 'selfie','selfies_viewed'=>0));           
        $result = $this->db->get();
        return $result->num_rows(); 
    }
    
    function viewedStatusUpdation($id ,$status)
    {
       $data = array(
                'selfies_viewed'    =>$status
                );
       if($status == 1)
       {
           $this->db->where(array('video_type' => 'selfie','selfies_viewed'=>0));    
           
       }       
        $this->db->where('video_id', $id);
        $this->db->update('videos', $data);        
        
        return $id; 
    }
    
    function getAllbooknames()
    {
        $this->db->select('bible_books.*');
        $this->db->from('bible_books');    
        $result = $this->db->get();
        $searchresult = $result->result(); 
        return $searchresult;
    }
    
    function chaptersvalues($id)
    {
        $this->db->select('bible_books.chapters,bible_books.book_id,bible_books.book_order,bible_books.bible_name,bible_books.book_name');
        $this->db->from('bible_books'); 
        $this->db->where(array('book_id' => $id));    
        $result = $this->db->get();
        $searchresult = $result->result(); 
        return $searchresult;
    }
    function versevalues($chapterno,$bookorder)
    {
        $this->db->select('bible_verse.verse');
        $this->db->from('bible_verse'); 
        $this->db->where(array('book_order' => $bookorder,'chapter'=>$chapterno));    
        $this->db->order_by('bible_verse.verse', 'asc'); 
        $result = $this->db->get();
        $searchresult = $result->result(); 
        return $searchresult;
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
