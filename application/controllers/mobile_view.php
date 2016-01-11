<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package     CodeIgniter
 * @author      ExpressionEngine Dev Team
 * @copyright   Copyright (c) 2008 - 2014, EllisLab, Inc.
 * @license     http://codeigniter.com/user_guide/license.html
 * @link        http://codeigniter.com
 * @since       Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Config Class
 *
 * This class contains functions that manage mobile view
 *
 * @package     CodeIgniter
 * @subpackage  Libraries
 * @category    Libraries
 * @author      ExpressionEngine Dev Team
 * @link        http://codeigniter.com/user_guide/libraries/config.html
 */
class Mobile_View extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('google');
        $this->load->library('Youtubeapi');
        $this->load->model('M_Mobile_View', '', TRUE);        
        
    }
    
    
    public function index()
    {
      
    }
    // --------------------------------------------------------------------

    /**
     * Selfie video listing page
     * 
     * @param   integer user id 
     * @param   string  language name
     * @return  list all selfie videos
     */
    public function mystory($userid,$lang)
    {
        $data = array();
        $data['userid'] = $userid;
        $data['lang']   = $lang;
        $data['selfie_videos']  = $this->M_Mobile_View->getAllSelfieVideos($userid,$lang);
        $this->load->view('mobile_view/v_mystory_listing',$data); 
    }
    
    // --------------------------------------------------------------------

    /**
     * Selfie video deleting
     * 
     * @param   integer selfie video id
     * @param   integer  userid
         * @param   string  language name
     * @return  list all selfie videos
     */
    
    public function my_story_delete($video_id,$userid,$lang)
    {      
       $youtube_id = $this->M_Mobile_View->getYoutubeVideoid($video_id);
       $youtubeid = $youtube_id[0]->video_youtube_id;   
       $this->youtubeapi->deleteYoutubeVideo($youtubeid); 
       $this->M_Mobile_View->deleteSelfieVideos($video_id);   
       redirect(base_url().'mobile_view/mystory/'.$userid.'/'.$lang);exit;
    }
    
    // --------------------------------------------------------------------

    /**
     * main video listing page
     * 
     * @param   string  language name
     * @return  list all videos
     */
    public function videos_listing($lang)
    {
        $data = array();
        $data['lang'] = $lang;
        $records_per_page = 10;
        $offset = 0;
        $data['topics']= $this->M_Mobile_View->getAllTopics($lang);
        $count              = $this->M_Mobile_View->getAllChannelVideosCount($lang);
        $data['total_pages']  = ceil($count / $records_per_page);        
       // $data['all_videos']  = $this->M_Mobile_View->getAllChannelVideos($lang,$limit, $offset);
        $this->load->view('mobile_view/channels_listing',$data); 
    }
        
      // --------------------------------------------------------------------

    /**
     * ajax video listing page for filtering searching and lazy loading
     * @param   integer   current page value
     * @param   string  language name
         * @param   integer   topic id
         * @param   integer   search keyword
     * @return  list all videos
     */
    public function listing()
    {

        $current_page               = $_POST['p'];
        $lang                       = $_POST['lang'];        
        $page               = intval( $_POST['p'] );
        $current_page           = $page - 1;
        $records_per_page       = 20; // records to show per page
        $start              = $current_page * $records_per_page;
        
        
        
        
        if(isset($_POST['type']))
        {
            $result_videos           = $this->M_Mobile_View->getAllChannelVideos($lang,$records_per_page, $start); 
            $search_result_count     = $this->M_Mobile_View->getAllChannelVideosCount($lang);
        }
        else
        {
            //$topic_id               = $_POST['topic_id'];
             $keyword  ='';
             $topic_id  ='';
            if(isset($_POST['keyword']))
            {
                $keyword                = $_POST['keyword'];
            }

             if(isset($_POST['topic_id']))
            {
                $topic_id                = $_POST['topic_id'];
            }

            $result_videos          = $this->M_Mobile_View->getAllVideosFromSearch($keyword,$topic_id,$lang,$records_per_page, $start);
            $search_result_count    = $this->M_Mobile_View->videoSearchResultCount($keyword,$topic_id,$lang);     
        }


        /*
        if(isset($_POST['topic_id']))
        {
            if($_POST['topic_id']!='')
            {
                $topic_id             = $_POST['topic_id'];
                $result_videos        = $this->M_Mobile_View->getAllVideosFromTopics($topic_id,$lang,$records_per_page, $start);
                $search_result_count  = $this->M_Mobile_View->filterResultCount($topic_id,$lang);           
            }
        }
        elseif(isset($_POST['keyword']))
        { 
            if($_POST['keyword']!='')
            {
                $keyword                = $_POST['keyword'];
                $result_videos          = $this->M_Mobile_View->getAllVideosFromSearch($keyword,$lang,$records_per_page, $start);
                $search_result_count    = $this->M_Mobile_View->videoSearchResultCount($keyword,$lang);           
            }
            else
            {
                $result_videos           = $this->M_Mobile_View->getAllChannelVideos($lang,$records_per_page, $start); 
                $search_result_count     = $this->M_Mobile_View->getAllChannelVideosCount($lang);
            }
        }
        else
        {           
            $result_videos           = $this->M_Mobile_View->getAllChannelVideos($lang,$records_per_page, $start); 
            $search_result_count     = $this->M_Mobile_View->getAllChannelVideosCount($lang);
           
        }
     */
        $dot ='......';
        $output='';
           
        if(isset($result_videos))
        {
            if(count($result_videos)>0)
            {
                foreach ($result_videos as $results)
                {
                    $desc= substr($results->video_desc,0,65);
                     if(strlen($results->video_desc)>65)
                         {
                          $desc= substr($results->video_desc,0,65).$dot;
                         
                         }
                         
                    $output .= '<a style="text-decoration: none" href="'.base_url().'mobile_view/video_details/'.$results->video_id.'/'.$lang.'"><div class="list_holder">
                                 
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td width="7%" align="left" valign="top"><div class="list_img"><img src="'.$results->video_thumbnail_url.'"></div></td>
                                    <td width="93%">
                                        <h2>'. $results->video_title.'</h2>
                                        <h3>'.$desc.'</h3>
                                        <h4>'. $results->video_type.'</h4>
                                    </td>
                                 </tr>
                                </table>
                               
                                </div></a>';
                } 
            } 
            else
            {
                $output .='<div style="font-family: Abel, sans-serif;font-size:30px; color:#ccc;">No Results</div>';
            } 
            
        }
     
        $total_pages        =   ceil($search_result_count / $records_per_page);
        $data   = array(
                           
                            'html'   => $output,
                            'count'  => $total_pages
                          );
    echo json_encode($data);
       // echo  $output;exit;    
        
    }
  // --------------------------------------------------------------------

    /**
     * video detail page
     * @param   integer  video id
     * @return  video detail page
     */

    public function video_details($video_id,$lang,$userid=NULL)
    {
        $data['userid'] = $userid;
        $data['lang']   = $lang;
        $data['video_details']  = $this->M_Mobile_View->getVideoDetails($video_id);
        $this->load->view('mobile_view/v_video_details',$data); 
    }

    public function myStoryPrivacyUpdate($video_id,$userid,$lang,$privacyValue)
    {      
       $youtube_id = $this->M_Mobile_View->getYoutubeIdFromVideoId($video_id);
       $youtubeid = $youtube_id[0]->video_youtube_id;   
       $res = $this->youtubeapi->updateYoutubeVideoDetailsAPI($youtubeid,$privacyValue); 
       $this->M_Mobile_View->changePrivacySettings($video_id,$privacyValue);   
       redirect(base_url().'mobile_view/mystory/'.$userid.'/'.$lang);exit;
    }

}

/* End of file mobile_view.php */
/* Location: ./application/controllers/mobile_view.php */
