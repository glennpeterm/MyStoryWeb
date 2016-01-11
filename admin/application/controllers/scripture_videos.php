<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//Class for managing Scripture Videos
class Scripture_Videos extends CI_Controller {
    
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
        $this->video_type  = "scripture";    
    }
    
    // Scripture video listing action
    public function index()
    {
        $this->session->unset_userdata('banner_url');
        $this->session->unset_userdata('featured_url');
        $data = array();
        $data['header'] = $this->load->view('v_header',$data, true);
        $data['menu']   = $this->load->view('v_leftmenu',$data, true);
        $data['footer'] = $this->load->view('v_footer',$data, true);
        
        $data['scripture_details']  = $this->M_Videos->getAllVideoDetails($this->video_type);        
        $this->load->view('scripture_videos/v_scripture_video_list',$data);
    }
    // End of Scripture video listing action
    
    // Scripture video add action
   
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
        $data['bible_book_names']   = $this->M_Videos->getAllbooknames();
                
        if($id!='')
        {
            $this->id                 = $id;
            $video_details            = $this->M_Videos->getVideoDetails($id,$this->video_type);
            $video_hahtag_details     = $this->M_Videos->getVideoHahtagDetails($id);
            $video_topics_details     = $this->M_Videos->getVideoTopicDetails($id);

            if (empty($video_details)&& empty($video_hahtag_details) && empty($video_topics_details))
            {
                    $this->session->set_flashdata('error', lang('no_data_err_msg'));
                    redirect('scripture_videos/add');
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
            $data['embed_code']         = $video_details[0]->video_embed;
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
            
            $data['db_bible_book_id']   = $video_details[0]->book_id;
            $data['book_name']          = $video_details[0]->book_name;
            $data['db_bible_book_order']= $video_details[0]->book_order;
            $data['chapter']            = $video_details[0]->chapter;
            $data['verse']              = $video_details[0]->verse;
            $data['bible_name']         = $video_details[0]->bible_name;
            
            $chapter = $this->M_Videos->chaptersvalues($video_details[0]->book_id);
            $data['chapter_array'] = explode(',',$chapter[0]->chapters);
               
            $verse = $this->M_Videos->versevalues($video_details[0]->chapter,$video_details[0]->book_order);
            $data['verse_array'] = $verse; 
                
        }
        else 
        {
            $data['id']           = $id;
            $data['video_title']  = '';
            $data['video_desc']   = '';
            $data['scripture_text']   = '';
            $data['video_short_desc']   = '';
            $data['video_id']     = '';
            $data['type']         = 'add';
            $data['banner_video']   = '';
            $data['highlight_video'] = '';
        }
        
        
        if($this->input->post('submit'))
        {       

            $this->form_validation->set_rules('video_title', lang('video_title'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('video_desc',  lang('video_desc'), 'trim|required|xss_clean'); 
            $this->form_validation->set_rules('video_short_desc',  lang('video_short_desc'), 'trim|required|xss_clean'); 
            $this->form_validation->set_rules('bible_books',lang('bookname'),'trim|required|xss_clean'); 

            $this->form_validation->set_rules('chapterno',lang('chapter'),'trim|required|xss_clean'); 
            $this->form_validation->set_rules('verseno',lang('verse'),'trim|required|xss_clean'); 
             
            $this->form_validation->set_rules('scripture_text',  lang('scripture_text'), 'trim|required|xss_clean'); 
            $this->form_validation->set_rules('topics', lang('topics'), 'required|xss_clean'); 
            $this->form_validation->set_rules('video_tag', lang('video_tag'), 'required|xss_clean');
            $this->form_validation->set_rules('status', lang('txt_status'), 'required|xss_clean');
            if($this->input->post('id')=='')
            {    
                $this->form_validation->set_rules('video_id',  lang('video_id'), 'trim|required|xss_clean|callback_videoid_check'); 
            }
            
           $data['video_title']        = $this->input->post('video_title');
           $data['video_desc']         = $this->input->post('video_desc');
           $data['video_short_desc']   = $this->input->post('video_short_desc');
           $data['scripture_text']   = $this->input->post('scripture_text');
           
           $data['book_id']     = $this->input->post('bible_book_id');
          // $data['book_name']   = $this->input->post('bible_book_name');
           $data['book_order']  = $this->input->post('bible_book_order');
           $data['chapter']     = $this->input->post('chapterno');
           $data['verse']       = $this->input->post('verseno');
           $data['bible_name']  = $this->input->post('bible_name');
           $data['db_bible_book_id'] = $this->input->post('bible_books');
          
          
           if($this->input->post('bible_books')!= '')
           {           
                $chapter = $this->M_Videos->chaptersvalues($this->input->post('bible_books'));
            
                $data['chapter_array'] = explode(',',$chapter[0]->chapters);
             
                $data['book_name']   = $chapter[0]->book_name;
                $data['db_bible_book_order'] = $chapter[0]->book_order;
                $data['bible_name'] = $chapter[0]->bible_name;
          
           
                if($data['chapter'] != ''&& $data['book_order'] !='')
                {
                    $verse = $this->M_Videos->versevalues($this->input->post('chapterno'),$this->input->post('bible_book_order'));
                    $data['verse_array'] = $verse;
                }
           }
           
           
           $data['video_id']           = $this->input->post('video_id');
           $data['video_status']       = $this->input->post('status');
          
           $data['hashtag_array']      = $this->input->post('video_tag');
           $video_topics               = $this->input->post('topics');
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
                if($this->input->post('id')=='')
                {
                    $this->load->view('scripture_videos/v_scripture_videos',$data);
                    return false;
                }
                elseif($this->input->post('id')!=''){
                   $this->load->view('scripture_videos/v_scripture_video_edit',$data); 
                   return false;
                }
            }
            else 
            { 
                if($this->input->post('id')=='')
                {
                    $videoDetailsAry = $this->youtubeapi->youtubeVideoDetailsAPI($this->input->post('video_id')); 
                    if($videoDetailsAry==0)
                    {
                       // $this->session->set_flashdata('error', lang('youtube_data_fetch_error'));
                        $data['youtube_error']= lang('youtube_data_fetch_error');
                        $this->load->view('scripture_videos/v_scripture_videos',$data);
                        return false;
                        //redirect('scripture_videos/add');
                    }
                   
                    $datas = array(
                            'id'                => $this->input->post('id'),  
                            'user_id'           => '',
                            'video_title'       => $this->input->post('video_title'),
                            'video_desc'        => $this->input->post('video_desc'),
                            'video_short_desc'  => $this->input->post('video_short_desc'),
                            'scripture_text'    => $this->input->post('scripture_text'),
                        
                            'book_id'     => $this->input->post('bible_book_id'),
                            'book_name'   => $data['book_name'],
                            'book_order'  => $this->input->post('bible_book_order'),
                            'chapter'     => $this->input->post('chapterno'),
                            'verse'       => $this->input->post('verseno'),
                            'bible_name'  => $this->input->post('bible_name'),
                            'video_youtube_id'  => $this->input->post('video_id'),
                            'embed_code'        => $videoDetailsAry['embedCode']."</iframe>",
                            'video_url'         => "https://www.youtube.com/watch?v=".$this->input->post('video_id'),
                            'thumbnail_url'     => $videoDetailsAry['videoThumbnail'],
                            'topics'            => $this->input->post('topics'),
                            'video_tag'         => $this->input->post('video_tag'),
                            'video_status'      => $this->input->post('status'),
                            'highlight'         => $data['highlight_video'] ,
                            'banner'            => $data['banner_video'],                            
                            'video_type'        => $this->video_type
                            
                        );
                }
                else
                {
                    
                      
                   $datas = array(
                          'id'                => $this->input->post('id'), 
                          'user_id'           => '',
                          'video_title'       => $this->input->post('video_title'),
                          'video_desc'        => $this->input->post('video_desc'),
                          'video_short_desc'  => $this->input->post('video_short_desc'),
                          'scripture_text'    => $this->input->post('scripture_text'),
                            'book_id'     => $this->input->post('bible_book_id'),
                            'book_name'   => $data['book_name'],
                            'book_order'  => $this->input->post('bible_book_order'),
                            'chapter'     => $this->input->post('chapterno'),
                            'verse'       => $this->input->post('verseno'),
                            'bible_name'  => $this->input->post('bible_name'),
                          'video_youtube_id'  => $data['video_youtube_id'],
                          'embed_code'        => $data['embed_code'],
                          'video_url'         => $data['video_url'],
                          'thumbnail_url'     => $data['video_thumbnail_url'],
                          'topics'            => $this->input->post('topics'),
                          'video_tag'         => $this->input->post('video_tag'),
                          'video_status'      => $this->input->post('status'),
                          'highlight'         => $data['highlight_video'] ,
                          'banner'            => $data['banner_video'],                          
                          'video_type'        => $this->video_type   
                         ); 
                  
                }                

                $result_videoid =$this->M_Videos->saveDetails($datas);
               
                if($result_videoid=='false')
                {
                    $this->session->set_flashdata('error', lang('insertn_err_msg'));
                    redirect('scripture_videos/add');
                }
                else 
                {
                    $this->session->set_flashdata('message', lang('insertn_sucss_msg'));
                    redirect('scripture_videos/view/'.$result_videoid);
                }
            }
            
        }
        
        if($id!='')
        {
               $this->load->view('scripture_videos/v_scripture_video_edit',$data);
 
        }
        else {
                $this->load->view('scripture_videos/v_scripture_videos',$data);
        }
       
    }
    
    // End of Scripture video add action
    
    // Scripture video delete action
    public function delete($id)
    {       
        
        $id= $this->M_Videos->deleteVideoDetails($id,$this->video_type);
        $this->session->set_flashdata('message', lang('deltn_sucs_msg'));        
        redirect('scripture_videos/index');
        
    }
    // End of Scripture video delete action
    
    //  Scripture video view  action
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
                redirect('scripture_videos/index');
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
                $data['scripture_text']         = $video_details[0]->scripture_text;   
                $data['youtube_id']             = $video_details[0]->video_youtube_id;
                $data['embed_code']             = $video_details[0]->video_embed;
                $data['video_url']              = $video_details[0]->video_url;
                $data['video_status']           = $video_details[0]->video_status;
                $data['highlight_video']        = $video_details[0]->video_highlight;
                $data['banner_video']           = $video_details[0]->video_banner;
                $data['hashtag_array']          = $hashtag_array_impld;
                $data['topics_array']           = $topics_array_impld;   
                $data['youtube_likes_count']= $video_details[0]->video_youtube_likes;
                $data['youtube_views_count']= $video_details[0]->video_youtube_view_count;
                $data['twitter_share']      = $video_details[0]->video_twitter_share;

                /*
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
                */

                $this->load->view('scripture_videos/v_scripture_video_view',$data);
            }
        }
    }
    //  End of Scripture video view  action
    
    
    //  Ajax function for Scripture video status changing
    public function setstatus()
    {        
        $res = $this->M_Videos->setStatus();
        if($res){
            echo 'success';exit;
        }
        echo 'failed';exit;
    }
    
    //  End of Ajax function for Scripture video status changing
    function banner_limit()
    {
       $result_count = $this->M_Videos->bannerVideoCount();  
        echo $result_count;
    }
   
   
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
   // End of Scripture video share action
    
    public function getchapters()
    {
       $id = $_POST['id']; 
       $result_values = $this->M_Videos->chaptersvalues($id);  
       $chapters = explode(',',$result_values[0]->chapters);
       $book_id = $result_values[0]->book_id;
       $book_order = $result_values[0]->book_order;
       $bible_name = $result_values[0]->bible_name;       
      
       
       $output = '';
       if($id !== ''){

            $output .= "<div class='form-group'><label class='col-sm-3 control-label'>".lang('chapter')."</label><div class='col-sm-7' >";            
            $output .= "<select class='form-control chapterno' name='chapterno' onchange='showverse(this);'><option value=''>".lang('select')."</option>";

            foreach($chapters as $value){

                $output .= "<option value=".$value.">". $value . "</option>";

            }

            $output .= "</select>  <span style='color:red'>". form_error('chapterno')."</span> </span></div></div>";

        } 
        
        $data	= array(

                    'html'   =>	$output,
                    'bible_book_id'  => $book_id,
                    'bible_book_order'  => $book_order,
                    'bible_name'      => $bible_name
                     );
	echo json_encode($data);
       
       exit;
    }
    
    public function getverse()
    {
       $chapterno = $_POST['chapterno']; 
       $bookorder  = $_POST['bookorder'];
      
       $result_values = $this->M_Videos->versevalues($chapterno,$bookorder); 
       
       $output = '';
       if($chapterno !== ''){

            $output .= "<div class='form-group'><label class='col-sm-3 control-label'>".lang('verse')."</label><div class='col-sm-7' >";

            $output .= "<select class='form-control verseno'  name='verseno' onchange='showtext();'><option value=''>".lang('select')."</option>";

            foreach($result_values as $value){

                $output .= "<option value=".$value->verse.">". $value->verse . "</option>";

            }
            $output .= "</select> <span style='color:red'>". form_error('verseno')."</span> </div></div>";

        } 
       echo $output;
       exit;
    }
    
    public function getscripturetext()
    {
       $bible_book_id = $_POST['bible_book_id']; 
       $chapterid     = $_POST['chapterno'];
       $verseno       = $_POST['verseno']; 
       
         $service_url = "http://dbt.io/text/verse?key=c850c2830657874c0a1ca5e68724ed15&dam_id=ENGESVO2ET&book_id=$bible_book_id&chapter_id=$chapterid&verse_start=$verseno&v=2";
              
        $curl = curl_init($service_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $curl_response = curl_exec($curl);
        if ($curl_response === false) {
        $info = curl_getinfo($curl);
        curl_close($curl);
        die('error occured during curl exec. Additioanl info: ' . var_export($info));
        }
        curl_close($curl);
        $decoded = json_decode($curl_response);
        
       echo $decoded[0]->verse_text;exit;
        
       
    }
    
      
}
