<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//Class for managing Selfie  Videos
class Selfie_Videos extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper(array('form'));
        $this->load->library('form_validation');
        $this->load->library('google');
        $this->load->library('Youtubeapi');
        $this->lang->load('common');
        $this->lang->load('video');      
        $this->load->model('M_Videos', '', TRUE);
        $this->load->model('M_Topics', '', TRUE);        
        $this->userid    = $this->session->userdata('kms_ad_id');
        $this->user_role = $this->session->userdata('kms_ad_role');      
        $this->language  = $this->config->item('language');
        $this->video_type  = "selfie";   
             
    }
    
    // Selfie  video listing action
    public function index()
    {
       
        $this->session->unset_userdata('banner_url');
        $this->session->unset_userdata('featured_url');
        $data = array();
        $data['header'] = $this->load->view('v_header',$data, true);
        $data['menu']   = $this->load->view('v_leftmenu',$data, true);
        $data['footer'] = $this->load->view('v_footer',$data, true);
        
        $resultdata  = $this->M_Videos->getAllVideoDetails($this->video_type);
        $topics_array = array (); 
       /* $i =0;
        foreach ($resultdata as $video) {
            
            $video_topics_details     = $this->M_Videos->getVideoTopicDetails($video->video_id);
                        
            foreach($video_topics_details as $topics)
            {
               $topics_array [] = $topics->topic_name;
            }
            $topics_array_impld = implode (", ", $topics_array);
            $resultdata[$i]->topics = $topics_array_impld;
            $i++;
        }
        */
        $data['selfie_details'] = $resultdata;
        $this->load->view('selfie_videos/v_selfie_video_list',$data);
    }
    // End of Selfie  video listing action
    public function selfiesViewed()
    {
        
        $videoid = $_POST['videoid'];
        $status  = 1;
        $this->M_Videos->viewedStatusUpdation($videoid , $status); 
        echo $newselfies = $this->M_Videos->newSelfievideos();
        
    } 
    // Selfie  video add action
   
     public function add($id="")
    {
        $banner_page_url   = site_url("banner_videos");
        $featured_page_url = site_url("featured_videos");
         if(isset($_SERVER['HTTP_REFERER']))
        {
        if($_SERVER['HTTP_REFERER'] == $banner_page_url)
        {
            $this->session->set_userdata('banner_url', $banner_page_url);             
            $this->session->unset_userdata('featured_url');
        }
        elseif($_SERVER['HTTP_REFERER'] == $featured_page_url)
        {
            $this->session->set_userdata('featured_url', $featured_page_url);
            $this->session->unset_userdata('banner_url');
        } 
        }
        $data = array();   
        $data['header'] = $this->load->view('v_header',$data, true);
        $data['menu']   = $this->load->view('v_leftmenu',$data, true);
        $data['footer'] = $this->load->view('v_footer',$data, true);
        
        $data['hashtag'] = $this->M_Videos->getHashtags($this->language,$this->user_role);
        $data['topics']  = $this->M_Videos->getTopics($this->language,$this->user_role);
        $data['countries']  = $this->M_Videos->getAllCountry();
        $data['languages']  = $this->M_Videos->getAllLanguages();
        if($id!='')
        {
            $this->id                 = $id;
            $video_details            = $this->M_Videos->getVideoDetails($id,$this->video_type);
            $video_hahtag_details     = $this->M_Videos->getVideoHahtagDetails($id);
            $video_topics_details     = $this->M_Videos->getVideoTopicDetails($id);

            if (empty($video_details)&& empty($video_hahtag_details) && empty($video_topics_details))
            {
                    $this->session->set_flashdata('error', lang('no_data_err_msg'));
                    redirect('selfie_videos');
            }
                       
            $hashtag_array = array ();                
            foreach($video_hahtag_details as $hastag)
            {
               $hashtag_array [] = $hastag->hash_name;
            }

            $hashtag_array_impld = implode (", ", $hashtag_array);
                        
            $topics_array = array ();                
            foreach($video_topics_details as $topics)
            {
               $topics_array [] = $topics->topic_id;
            }
            
   
            $data['id']                 = $video_details[0]->video_id;
            $data['video_title']        = $video_details[0]->video_title;
            $data['video_desc']         = $video_details[0]->video_desc;
            $data['video_short_desc']   = $video_details[0]->video_short_desc;
            $data['scripture_text']     = $video_details[0]->scripture_text;
            $data['book_id']            = $video_details[0]->book_id;
            $data['book_name']          = $video_details[0]->book_name;
            $data['book_order']         = $video_details[0]->book_order;
            $data['chapter']            = $video_details[0]->chapter;
            $data['verse']              = $video_details[0]->verse;
            $data['bible_name']         = $video_details[0]->bible_name;
            $data['embed_code']         = $video_details[0]->video_embed;
            $data['country']            = $video_details[0]->video_country;
            $data['language']           = $video_details[0]->language;
            $data['language_name']      = $video_details[0]->video_language;
            $data['video_youtube_id']   = $video_details[0]->video_youtube_id;
            $data['video_url']          = $video_details[0]->video_url;
            $data['video_thumbnail_url']= $video_details[0]->video_thumbnail_url;
            $data['video_status']       = $video_details[0]->video_status;
            $data['highlight_video']    = $video_details[0]->video_highlight;
            $data['banner_video']       = $video_details[0]->video_banner;
            $data['hashtag_array']      = $hashtag_array_impld;
            $data['topics_array']       = $topics_array;   
            $data['type']               = 'edit';     
            $data['youtube_likes_count']= $video_details[0]->video_youtube_likes;
            $data['youtube_views_count']= $video_details[0]->video_youtube_view_count;
            $data['twitter_share']      = $video_details[0]->video_twitter_share;       
                
        }
        else 
        {
            redirect('selfie_videos');
        }
        
        
        if($this->input->post('submit'))
        {
                    
            
            $this->form_validation->set_rules('video_title', lang('video_title'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('video_desc', lang('video_desc'), 'trim|required|xss_clean');  
            $this->form_validation->set_rules('video_short_desc',  lang('video_short_desc'), 'trim|required|xss_clean'); 
            $this->form_validation->set_rules('topics', lang('topics'), 'required|xss_clean'); 
            $this->form_validation->set_rules('video_tag', lang('video_tag'), 'required|xss_clean');
            $this->form_validation->set_rules('status', lang('txt_status'), 'required|xss_clean');
            if($this->input->post('id')=='')
            {    
                $this->form_validation->set_rules('video_id', lang('video_id'), 'trim|required|xss_clean'); 
            }

           $data['video_title']        = $this->input->post('video_title');
           $data['video_desc']         = $this->input->post('video_desc');    
           $data['video_short_desc']   = $this->input->post('video_short_desc');
           $data['video_id']           = $this->input->post('video_id');
           $data['video_status']       = $this->input->post('status');          
           $data['hashtag_array']      = $this->input->post('video_tag');
           $video_topics               = $this->input->post('topics');
           $data['country']            = $this->input->post('country');
           $data['language']           = $this->input->post('language');
           
           $videoStatus = $this->input->post('status');

           if($videoStatus !=$this->input->post('prev_status'))
           {
            if($videoStatus=='1')
            {
                $privacyValue = 'unlisted';
            }
            else
            {
                $privacyValue = 'private';
            }
            //get youtube video id from database id
            $youtube_id = $this->M_Videos->getYoutubeIdFromVideoId($id);
            $youtubeid = $youtube_id[0]->video_youtube_id;   
            //update video privacy status in youtube
            $res = $this->youtubeapi->updateYoutubeVideoDetailsAPI($youtubeid,$privacyValue); 
           }
           
           if(isset($_POST['high_light_status']))
          {
              $data['highlight_video'] = "1";
          }  
          else 
              
          {
              $data['highlight_video'] = "0";
          }
          if(isset($_POST['banner_status']))
            {
              $data['banner_video'] = "1";
            }  
            else 

            {
              $data['banner_video'] = "0";
            }
             
            
           $topics_array1 = array (); 
           if(!empty($video_topics)){
            foreach($video_topics as $topics)
            {
               $topics_array1 [] = $topics;
            }
              }
            if(!empty($topics_array1)){
            $data['topics_array']   = $topics_array1;  
            }
            if($this->form_validation->run() == FALSE)
            {
                
                $this->load->view('selfie_videos/v_selfie_video_edit',$data);
                return false;
            }
            else 
            {
                $datas = array(
                       'id'                => $this->input->post('id'),                            
                       'video_title'       => $this->input->post('video_title'),
                       'video_desc'        => $this->input->post('video_desc'),
                       'video_short_desc'  => $this->input->post('video_short_desc'),
                       'video_youtube_id'  => $data['video_youtube_id'],
                       'country'           => $this->input->post('country'),
                       'language'          => $this->input->post('language'),
                       'embed_code'        => $data['embed_code'],
                       'video_url'         => $data['video_url'],
                       'thumbnail_url'     => $data['video_thumbnail_url'],
                       'topics'            => $this->input->post('topics'),
                       'video_tag'         => $this->input->post('video_tag'),
                       'video_status'      => $this->input->post('status'),
                       'scripture_text'    => $data['scripture_text'],
                        'book_id'           => $data['book_id'],
                        'book_name'         => $data['book_name'],
                        'book_order'        => $data['book_order'],
                        'chapter'           => $data['chapter'],
                        'verse'             => $data['verse'],
                        'bible_name'        => $data['bible_name'],
                       'highlight'         => $data['highlight_video'] ,
                       'banner'            => $data['banner_video'],
                       'video_type'        => $this->video_type
                      );  
                                   
                $result_videoid =$this->M_Videos->saveDetails($datas);
                if($result_videoid=='false')
                {
                    $this->session->set_flashdata('error', lang('insertn_err_msg'));
                    redirect('selfie_videos');
                }
                else 
                {
                    $this->session->set_flashdata('message', lang('insertn_sucss_msg'));
                    redirect('selfie_videos/view/'.$result_videoid);
                }
            }
        }
        
             $this->load->view('selfie_videos/v_selfie_video_edit',$data);
 
        
       
    }
    
    // End of Selfie  video add action
    
    // Selfie  video delete action
    public function delete($id)
    {       
        $video_details            = $this->M_Videos->getVideoDetails($id,$this->video_type); 
        $video_id = $video_details[0]->video_youtube_id;
        $id= $this->M_Videos->deleteVideoDetails($id,$this->video_type);
        $this->youtubeapi->deleteYoutubeVideo($video_id); 
        $this->session->set_flashdata('message', lang('deltn_sucs_msg'));        
        redirect('selfie_videos/index');
        
    }
    // End of Selfie  video delete action
    
    //  Selfie  video view  action
    public function view($id)
    { 
        $banner_page_url   = site_url("banner_videos");
        $featured_page_url = site_url("featured_videos");
        if(isset($_SERVER['HTTP_REFERER']))
        {
            if($_SERVER['HTTP_REFERER'] == $banner_page_url)
            {
                $this->session->set_userdata('banner_url', $banner_page_url);
                $this->session->unset_userdata('featured_url');
            }
            elseif($_SERVER['HTTP_REFERER'] == $featured_page_url)
            {
                $this->session->set_userdata('featured_url', $featured_page_url);
                $this->session->unset_userdata('banner_url');
            } 
        }
       $data = array();
       $data['header'] = $this->load->view('v_header',$data, true);
       $data['menu']   = $this->load->view('v_leftmenu',$data, true);
       $data['footer'] = $this->load->view('v_footer',$data, true);
        if($id!='')
        {
            $this->id                 = $id;
            $video_details            = $this->M_Videos->getVideoDetails($id,$this->video_type);           
            if (!$video_details)
            {
                $this->session->set_flashdata('error', lang('no_data_err_msg'));
                redirect('selfie_videos/index');
            }
            else
            {
               //$videoDetailsAry = $this->youtubeapi->youtubeVideoDetailsAPI($video_details[0]->video_youtube_id);  
                
                $video_hahtag_details     = $this->M_Videos->getVideoHahtagDetails($id);
                $video_topics_details     = $this->M_Videos->getVideoTopicDetails($id);
                $hashtag_array = array ();                
                foreach($video_hahtag_details as $hastag)
                {
                   $hashtag_array [] = $hastag->hash_name;
                }

                $hashtag_array_impld = implode (", ", $hashtag_array);

                $topics_array = array ();                
                foreach($video_topics_details as $topics)
                {
                   $topics_array [] = $topics->topic_name;
                }
                $topics_array_impld = implode (", ", $topics_array);
                
                 //set values to db values               
                $data['video_id']               = $video_details[0]->video_id;
                $data['video_title']            = $video_details[0]->video_title;
                $data['video_desc']             = $video_details[0]->video_desc;
                $data['video_short_desc']       = $video_details[0]->video_short_desc; 
                $data['youtube_id']             = $video_details[0]->video_youtube_id;
                $data['video_country']          = $video_details[0]->video_country;
                $data['language']               = $video_details[0]->language;
                $data['language_name']      = $video_details[0]->video_language;
                $data['embed_code']             = $video_details[0]->video_embed;
                $data['video_url']              = $video_details[0]->video_url;
                $data['uploaded_by']            = $video_details[0]->first_name." ".$video_details[0]->last_name;
                $data['highlight_video']        = $video_details[0]->video_highlight;
                $data['banner_video']           = $video_details[0]->video_banner;
                $data['video_status']           = $video_details[0]->video_status;
                $data['scripture_text']         = $video_details[0]->scripture_text;
                $data['hashtag_array']          = $hashtag_array_impld;
                $data['topics_array']           = $topics_array_impld;
                $data['youtube_likes_count']= $video_details[0]->video_youtube_likes;
                $data['youtube_views_count']= $video_details[0]->video_youtube_view_count;
                $data['twitter_share']      = $video_details[0]->video_twitter_share;
                
                              
                $this->load->view('selfie_videos/v_selfie_video_view',$data);
            }
        }
    }
    //  End of Selfie  video view  action
    
    
    //  Ajax function for Selfie video status changing
    public function setstatus()
    {        
        $status = $this->input->post('status');
        if($status=='1')
        {
            $privacyValue = 'unlisted';
        }
        else
        {
            $privacyValue = 'private';
        }
        //get youtube video id from database id
        $id = $this->input->post('id');
        $youtube_id = $this->M_Videos->getYoutubeIdFromVideoId($id);
        $youtubeid = $youtube_id[0]->video_youtube_id;   
        //update video privacy status in youtube
        $res = $this->youtubeapi->updateYoutubeVideoDetailsAPI($youtubeid,$privacyValue); 
        

        $res = $this->M_Videos->setStatus($status);
        if($res){
            echo 'success';exit;
        }
        echo 'failed';exit;
    }
    
    //  End of Ajax function for Selfie  video status changing
    
   function banner_limit()
    {
       $result_count = $this->M_Videos->bannerVideoCount();  
        echo $result_count;
    }
  
}
