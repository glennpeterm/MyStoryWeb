<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

class Videos extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->helper('url');  
        $this->lang->load('video');
        $this->lang->load('common');
        $this->load->model('M_Videos', '', TRUE);     
        $this->load->library('email'); 
        $this->language  = $this->config->item('language');
        
    }
    
  
   public function index()
   {        

   }
       
     // --------------------------------------------------------------------

	/**
	 * video detail page
	 * 
	 * @param   integer video id	
	 * @return  video detail page
	 */
    public function video_details($video_id)
    {
        if($video_id!='')
        {
            $data = array();
            $data['header'] = $this->load->view('v_header',$data, true);       
            $data['footer'] = $this->load->view('v_footer',$data, true);       
            $video_details_array  = $this->M_Videos->getVideoDetails($video_id);

            $video_hahtag_details     = $this->M_Videos->getVideoHahtagDetails($video_id);
            $video_topics_details     = $this->M_Videos->getVideoTopicDetails($video_id);
            $hashtag_array = array ();  
            $j= 0;
            foreach($video_hahtag_details as $hastag)
            {             
               $hashtag_array[$j] ['key']   = $hastag->hash_id;
               $hashtag_array[$j] ['value'] = $hastag->hash_name;
               $j++;
            }

            $topics_array = array (); 
            $i=0;
            foreach($video_topics_details as $topics)
            {
               $topics_array[$i] ['value']   = $topics->topic_title;
               $topics_array[$i] ['key']     = $topics->topic_link;
               $i++;
            }
          
            $data['hashtag_array']          = $hashtag_array;
            $data['topics_array']           = $topics_array; 
            if(!empty($video_details_array))
            {
                $data['video_details']     = $video_details_array[0];
            }    
            else
            {
                redirect('home');
            }  
           
            $this->load->view('videos/v_video_details',$data); 
        }
        else
        {
            redirect('home');
        }    
    }
     // --------------------------------------------------------------------
     /**
	 * video search page
	 * 
	 * @param   string search		
	 * @return  list all videos based on search keyword
	 */
    public function search()
    {
        if($_GET['search'] != '')
        {
            $data = array();
            $data['header'] = $this->load->view('v_header',$data, true);       
            $data['footer'] = $this->load->view('v_footer',$data, true);  
            $lang                       = $this->language;        
            $page			= 1;
            $current_page		= $page - 1;
            $records_per_page	        = 12; // records to show per page
            $start			= $current_page * $records_per_page;
            $keyword                    = addslashes($_GET['search']);
            $result_videos          = $this->M_Videos->getAllVideosFromSearch($keyword,$lang,$records_per_page, $start);
            $search_result_count    = $this->M_Videos->videoSearchResultCount($keyword,$lang); 
            $data['keyword']        = $_GET['search'];
            $data['result_videos']  = $result_videos;
            $data['result_count']   = $search_result_count;
            $data['total_pages']		=	ceil($search_result_count / $records_per_page);

            $this->load->view('videos/v_search_result',$data); 
        }
        else 
            {
                redirect('home');
            
            }
    }
     // --------------------------------------------------------------------
     /**
	 * lazy loading page for video search result
	 * 
	 * @param   string keyword
         * @param   integer current page		
	 * @return  list all videos based on search keyword
	 */
     public function listing()
    {
        $current_page               = $_POST['p'];
        $lang                       = $this->language;             
        $page			    = intval( $_POST['p'] );
	$current_page		    = $page - 1;
	$records_per_page	    = 12; // records to show per page
	$start			    = $current_page * $records_per_page;
        $keyword                    = addslashes($_POST['keyword']);
        $result_videos          = $this->M_Videos->getAllVideosFromSearch($keyword,$lang,$records_per_page, $start);
        $search_result_count    = $this->M_Videos->videoSearchResultCount($keyword,$lang); 
        
         $dot ='......';
        $output='';
        if($search_result_count>0)
            {
                foreach ($result_videos as $results)
                {
                    $desc= substr($results->video_desc,0,20);
                     if(strlen($results->video_desc)>20)
                         {
                          $desc= substr($results->video_desc,0,20).$dot;
                         
                         }
                         
                         $title = substr($results->video_title,0,10);
                     if(strlen($results->video_title)>10)
                         {
                          $title= substr($results->video_title,0,10).$dot;
                         
                         }
                         
                         $output .= '<div class="search_video_list"onclick="assignId('.$results->video_id .')">
        	<div><img src="https://i.ytimg.com/vi/'. $results->video_youtube_id.'/sddefault.jpg"></div>
        	<a href="#">
                <div class="vdetails">
                    <h3>'.$title.'</h3>
                    <p>'.$desc.'</p>
                </div>
            </a>
        </div>';
                }
            }
            else
            {
                $output .='<div id="no_result">'.lang('no_results').'</div>';
            } 
           //echo $output;exit;
          $total_pages		=	ceil($search_result_count / $records_per_page);
        $data	= array(
                           
                            'html'   =>	$output,
                            'total_pages'  => $total_pages
                          );
	echo json_encode($data);
    }
     // --------------------------------------------------------------------
     /**
	 * video popup on search page
	 * 
	 * @param   string videoid
         * @return  display video in a popup
	 */
    public function video_popup()
    {
        $video_id           = $_POST['video_id'];
        $data = array();

        $video_details_array  = $this->M_Videos->getVideoDetails($video_id);


        $video_topics_details     = $this->M_Videos->getVideoTopicDetails($video_id);

        $topics_array = array (); 
        $i=0;
        foreach($video_topics_details as $topics)
        {
           $topics_array[$i] ['value']   = $topics->topic_title;
           $topics_array[$i] ['key']     = $topics->topic_link;
           $i++;
        }

        $data['topics_array']           = $topics_array; 
        if(!empty($video_details_array))
        {
            $data['video_details']     = $video_details_array[0];
        }      

       $video_popup_data = $this->load->view('videos/video_popup',$data, true); 
       echo $video_popup_data;
      exit;
    }
     // --------------------------------------------------------------------
      /**
	 * list all videos based on tag
	 * 
	 * @param   string tag		
	 * @return  list all videos based on tag
	 */
    public function tag_search($tag)
    {
        if($tag != '')
        {
           
            $data = array();
            $data['header'] = $this->load->view('v_header',$data, true);       
            $data['footer'] = $this->load->view('v_footer',$data, true);  
            $lang                   = $this->language;        
            $page	            = 1;
            $current_page	    = $page - 1;
            $records_per_page	    = 12; // records to show per page
            $start		    = $current_page * $records_per_page;
            $keyword                = addslashes($tag);
            $result_videos          = $this->M_Videos->getAllVideosFromTags($keyword,$lang,$records_per_page, $start);
            $search_result_count    = $this->M_Videos->countOfAllVideosFromTags($keyword,$lang); 
            $data['keyword']        = $tag;
            $tagname                = $this->M_Videos->getTagname($tag,$lang);
            $data['tagname']        = $tagname[0]->hash_name;
            $data['result_videos']  = $result_videos;
            $data['result_count']   = $search_result_count;
            $data['total_pages']		=	ceil($search_result_count / $records_per_page);

            $this->load->view('videos/v_tag_search_result',$data); 
        }
        else 
            {
                redirect('home');
            
            }
    }
    
     // --------------------------------------------------------------------
     /**
	 * lazy loading page for list all videos based on tag
	 * 
	 * @param   string keyword
         * @param   integer current page		
	 * @return  list all videos based on tag
	 */
    public function tag_based_video_listing()
    {
        $current_page               = $_POST['p'];
        $lang                       = $this->language;             
        $page			    = intval( $_POST['p'] );
	$current_page		    = $page - 1;
	$records_per_page	    = 12; // records to show per page
	$start			    = $current_page * $records_per_page;
        $keyword                    = addslashes($_POST['keyword']);
        $result_videos          = $this->M_Videos->getAllVideosFromTags($keyword,$lang,$records_per_page, $start);
        $search_result_count    = $this->M_Videos->countOfAllVideosFromTags($keyword,$lang); 
        
         $dot ='......';
        $output='';
        if($search_result_count>0)
            {
                foreach ($result_videos as $results)
                {
                    $desc= substr($results->video_desc,0,20);
                     if(strlen($results->video_desc)>20)
                         {
                          $desc= substr($results->video_desc,0,20).$dot;
                         
                         }
                         
                         $title = substr($results->video_title,0,10);
                     if(strlen($results->video_title)>10)
                         {
                          $title= substr($results->video_title,0,10).$dot;
                         
                         }
                         
                         $output .= '<div class="search_video_list"onclick="assignId('.$results->video_id .')">
        	<div><img src="https://i.ytimg.com/vi/'. $results->video_youtube_id.'/sddefault.jpg"></div>
        	<a href="#">
                <div class="vdetails">
                    <h3>'.$title.'</h3>
                    <p>'.$desc.'</p>
                </div>
            </a>
        </div>';
                }
            }
            else
            {
                $output .='<div id="no_result">'.lang('no_results').'</div>';
            } 
          
        $total_pages		=	ceil($search_result_count / $records_per_page);
        $data	= array(
                           
                            'html'   =>	$output,
                            'total_pages'  => $total_pages
                          );
	echo json_encode($data);
    }

    function flagVideo()
    {
      $data['id'] = $_POST['video_id'];
      $data['issues'] = $this->M_Videos->getIssues();
      $video_popup_data = $this->load->view('videos/v_flag_video',$data, true); 
      echo $video_popup_data;
      exit;
    }
    function addflag()
    {
     
      $res  = $this->M_Videos->addFlagReport($_POST);
      $issueName = $this->M_Videos->getIssueById($_POST['issueTypeVal']);
      $videoDetails = $this->M_Videos->getVideoDetails($_POST['video_id']);
      $this->email->set_mailtype("html");
      $this->email->from(WEBSITE_FROM_EMAIL,WEBSITE_FROM_NAME);
      $this->email->to('MyStorySupport@onehope.net');
      $this->email->subject("Inappropriate Video - ".$videoDetails[0]->video_title);
      $mail_content = "Hi Admin,<br><br>";
      $mail_content.= "<b>Contact Information:</b><br>";
      $mail_content.= "Name : ".$_POST['fname']." ".$_POST['lname']."<br>";
      $mail_content.= "Email : ".$_POST['email']."<br><br>";
      $mail_content.= "<b>Issue Details:</b><br>";
      $mail_content.= "Video URL : <a target='_blank' href='".base_url()."videos/video_details/".$_POST['video_id']."'>".base_url()."videos/video_details/".$_POST['video_id']."</a><br><br><br>";
      $mail_content.= "Issue : ".$issueName[0]->flag_issue."<br>";
      if($_POST['addilCmts']!='')
      {
        $mail_content.= "Additional Comments : ".$_POST['addilCmts']."<br>";
      }
      
      
      $this->email->message($mail_content);     
      $this->email->send(); 


      echo "success";
      exit;
    }

    

}

/* End of file videos.php */
/* Location: ./application/controllers/videos.php */
