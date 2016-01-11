<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// Class for managing Testimonial videos
class Testimonial_Videos extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper(array('form'));
        $this->load->library('form_validation');
        $this->load->library('google');
        $this->load->library('Youtubeapi');
        $this->lang->load('common');
        $this->lang->load('video');
        $this->load->model('M_Topics', '', TRUE);
        $this->load->model('M_Videos', '', TRUE);
        $this->userid    = $this->session->userdata('kms_ad_id');
        $this->user_role = $this->session->userdata('kms_ad_role');      
        $this->language  = $this->config->item('language');
        $this->video_type  = "testimonial";
             
    }
    
    // Testimonal video listing action
    public function index()
    {
        $this->session->unset_userdata('banner_url');
        $this->session->unset_userdata('featured_url');
        $data = array();
        $data['header'] = $this->load->view('v_header',$data, true);
        $data['menu']   = $this->load->view('v_leftmenu',$data, true);
        $data['footer'] = $this->load->view('v_footer',$data, true);
        
        $data['testimonial_details']  = $this->M_Videos->getAllVideoDetails($this->video_type);
        $this->load->view('testimonial_videos/v_testimonial_video_list',$data);
    }
    
    // End of Testimonal video listing action
    
    // Testimonal video add action
    
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
         //if (isset($_POST['submit'])){ print_r($_POST);exit;}
        $data = array();   
        $data['header'] = $this->load->view('v_header',$data, true);
        $data['menu']   = $this->load->view('v_leftmenu',$data, true);
        $data['footer'] = $this->load->view('v_footer',$data, true);
        
        $data['hashtag'] = $this->M_Videos->getHashtags($this->language,$this->user_role);
        $data['topics']  = $this->M_Videos->getTopics($this->language,$this->user_role);
        if($id!='')
        {
            $this->id                 = $id;
            $video_details            = $this->M_Videos->getVideoDetails($id,$this->video_type);
            $video_hahtag_details     = $this->M_Videos->getVideoHahtagDetails($id);
            $video_topics_details     = $this->M_Videos->getVideoTopicDetails($id);

            if (empty($video_details)&& empty($video_hahtag_details) && empty($video_topics_details))
            {
                $this->session->set_flashdata('error', lang('no_data_err_msg'));
                redirect('testimonial_videos/add');
            }
             //set values to db values
            $videoDetailsAry = $this->youtubeapi->youtubeVideoDetailsAPI($video_details[0]->video_youtube_id); 
            if($videoDetailsAry['videoLikes'] == '')
            {
                $data['youtube_likes_count']  = 0;
            }
            else
            {
                $data['youtube_likes_count']    = $videoDetailsAry['videoLikes'];
            }             
           
            $data['fb_likes_count']         = 0;
            $data['total_likes_count']      = $data['youtube_likes_count'] + $data['fb_likes_count'];
            
            
            
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
            $data['video_youtube_id']   = $video_details[0]->video_youtube_id;            
            $data['embed_code']         = $video_details[0]->video_embed;
            $data['video_url']          = $video_details[0]->video_url;
            $data['video_thumbnail_url']= $video_details[0]->video_thumbnail_url;
            $data['video_status']       = $video_details[0]->video_status;
            $data['highlight_video']    = $video_details[0]->video_highlight;
            $data['banner_video']       = $video_details[0]->video_banner;
            $data['hashtag_array']      = $hashtag_array_impld;
            $data['topics_array']       = $topics_array;   
            $data['type']               = 'edit';          
                
        }
        else 
        {
            $data['id']           = $id;
            $data['video_title']  = '';
            $data['video_desc']   = '';
            $data['video_id']     = '';
            $data['type']         = 'add';
            $data['banner_video']   = '';
            $data['highlight_video'] = '';

        }
        
        
        if($this->input->post('submit'))
        {
            $this->form_validation->set_rules('video_title', lang('video_title'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('video_desc', lang('video_desc'), 'trim|required|xss_clean');          
            $this->form_validation->set_rules('topics', lang('topics'), 'required|xss_clean'); 
            $this->form_validation->set_rules('video_tag', lang('video_tag'), 'required|xss_clean');
            $this->form_validation->set_rules('status', lang('txt_status'), 'required|xss_clean');
            if($this->input->post('id')=='')
            {    
                $this->form_validation->set_rules('video_id', lang('video_id'), 'trim|required|xss_clean|callback_videoid_check'); 
            }
            $data['id']                  = $this->input->post('id');
            $data['video_title']         = $this->input->post('video_title');
            $data['video_desc']          = $this->input->post('video_desc');         
            $data['video_id']            = $this->input->post('video_id');
            $data['video_status']        = $this->input->post('status');
          
            $data['hashtag_array']       = $this->input->post('video_tag');
            $video_topics                = $this->input->post('topics');
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
                $this->load->view('testimonial_videos/v_testimonial_videos',$data);
                return false;
            }
            else 
            {
                if($this->input->post('id')=='')
                {
                    $videoDetailsAry = $this->youtubeapi->youtubeVideoDetailsAPI($this->input->post('video_id')); 
                   
                    if($videoDetailsAry==0)
                    {
                        $this->session->set_flashdata('error',  lang('youtube_data_fetch_error'));
                        redirect('testimonial_videos/add');
                    }
                   
                    
                    $datas = array(
                            'id'                 => $this->input->post('id'), 
                            'user_id'            => '',
                            'video_title'        => $this->input->post('video_title'),
                            'video_desc'         => $this->input->post('video_desc'),
                            'video_youtube_id'   => $this->input->post('video_id'),
                            'embed_code'         => $videoDetailsAry['embedCode']."</iframe>",
                            'video_url'          => "https://www.youtube.com/watch?v=".$this->input->post('video_id'),
                            'thumbnail_url'      => $videoDetailsAry['videoThumbnail'],
                            'topics'             => $this->input->post('topics'),
                            'video_tag'          => $this->input->post('video_tag'),
                            'video_status'       => $this->input->post('status'),
                            'highlight'          => $data['highlight_video'] ,
                             'banner'            => $data['banner_video'],
                            'language'           => $this->language,
                            'video_type'         => $this->video_type   
                           );
                                        
                    
                }
                else
                {
                     $datas = array(
                            'id'                => $this->input->post('id'),    
                            'user_id'           => '',
                            'video_title'       => $this->input->post('video_title'),
                            'video_desc'        => $this->input->post('video_desc'),
                            'video_youtube_id'  => $data['video_youtube_id'],
                            'embed_code'        => $data['embed_code'],
                            'video_url'         => $data['video_url'],
                            'thumbnail_url'     => $data['video_thumbnail_url'],
                            'topics'            => $this->input->post('topics'),
                            'video_tag'         => $this->input->post('video_tag'),
                            'video_status'      => $this->input->post('status'),
                            'highlight'         => $data['highlight_video'] ,
                            'banner'            => $data['banner_video'],
                            'language'          => $this->language,
                            'video_type'        => $this->video_type   
                           );  
                }
                
                $result_videoid =$this->M_Videos->saveDetails($datas);
                //echo  $this->db->last_query();exit;
                if($result_videoid=='false')
                {
                    $this->session->set_flashdata('error', lang('insertn_err_msg'));
                    redirect('testimonial_videos/add');
                }
                else 
                {
                    $this->session->set_flashdata('message',  lang('insertn_sucss_msg'));
                    redirect('testimonial_videos/view/'.$result_videoid);
                }
            }
        }
        
        
       if($id!='')
        {
              $this->load->view('testimonial_videos/v_testimonial_edit',$data);
 
        }
        else {
               $this->load->view('testimonial_videos/v_testimonial_videos',$data);
        }
    }
    
    // End of Testimonal video add action
    
    // Testimonal video delete action
    public function delete($id)
    {       
        
        $id= $this->M_Videos->deleteVideoDetails($id,$this->video_type);
        $this->session->set_flashdata('message', lang('deltn_sucs_msg'));        
        redirect('testimonial_videos/index');
        
    }
    // End of Testimonal video add action
    
    // Testimonal video view action
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
            $this->id         = $id;
            $video_details    = $this->M_Videos->getVideoDetails($id,$this->video_type);
               
                   /* if($videoDetailsAry==0)
                    {
                        $this->session->set_flashdata('error', 'Data Insertion Error Occurs.Check your youtube video id.');
                        redirect('testimonial_videos/add');
                    }*/
            if (!$video_details)
            {
                $this->session->set_flashdata('error',  lang('no_data_err_msg'));
                redirect('testimonial_videos/index');
            }
            else
            {
                                
                $videoDetailsAry = $this->youtubeapi->youtubeVideoDetailsAPI($video_details[0]->video_youtube_id); 
                
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
                $data['embed_code']             = $video_details[0]->video_embed;
                $data['youtube_id']             = $video_details[0]->video_youtube_id;
                $data['video_url']              = $video_details[0]->video_url;
                $data['video_status']           = $video_details[0]->video_status;
                $data['highlight_video']        = $video_details[0]->video_highlight;
                $data['banner_video']           = $video_details[0]->video_banner;
                $data['hashtag_array']          = $hashtag_array_impld;
                $data['topics_array']           = $topics_array_impld; 
                
                if($videoDetailsAry['videoLikes'] == '')
                {
                    $data['youtube_likes_count']  = 0;
                }
                else
                {
                    $data['youtube_likes_count']    = $videoDetailsAry['videoLikes'];
                } 
                         
                $data['fb_likes_count']         = 0;
                $data['total_likes_count']      = $data['youtube_likes_count'] + $data['fb_likes_count'];
                
                
                
                $this->load->view('testimonial_videos/v_testimonial_video_view',$data);
            }
        }
    }
    // End of Testimonal video view action
    
    // Ajax function for changing  testimonial video status
    public function setstatus()
    {        
        $res = $this->M_Videos->setStatus();
        if($res){
            echo 'success';exit;
        }
        echo 'failed';exit;
    }
    // End of Ajax function for changing  testimonial video status
    
   
   
    public function videoid_check($input)
    {
        $result_count = $this->M_Videos->videoidAlreadyExist($input,$this->language,$this->user_role,$this->video_type);
        if($result_count > 0)
        {
            $msg = lang('data_exist_err_msg');
            $this->form_validation->set_message("videoid_check", $msg);
            return false; 
        }
        else 
        {
           return true; 
        }
       
    }
  

}
