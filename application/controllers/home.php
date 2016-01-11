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

class Home extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->helper('url');  
        $this->lang->load('video');
        $this->lang->load('common');
        $this->load->model('M_Home', '', TRUE);      
        $this->language  = $this->config->item('language');
        
    }
     // --------------------------------------------------------------------
    /**
	 * list all videos in home page
	 * 
	 * @return  list all videos (both featured and normal video) 
	 */
    public function index()
    {
        $featured_limit = 4;
        $normal_limit  = 16;
        $offset = 0;
        
        $topic_id       = '';
        $langcode       = '';
        $countrycode    = '';
        $count_type     = 'all';
        
        $data['topics']= $this->M_Home->getAllTopics($this->language);
        $data['all_languages'] = $this->M_Home->getAllVideoLanguages();
        $data['all_countries'] = $this->M_Home->getAllVideoCountries();
        $data['banner_videos'] = $this->M_Home->getAllBannerVideos();
       //echo $this->db->last_query();exit;
          
        $featured_videos_array  = $this->M_Home->getAllFeaturedVideos($topic_id,$langcode,$countrycode,$count_type,$featured_limit,$offset);
        $normal_videos_array    = $this->M_Home->getAllNormalVideos($topic_id,$langcode,$countrycode,$count_type,$normal_limit,$offset);
        if(count($featured_videos_array)== 4 && count($normal_videos_array)== 16 )
        {
            $featured_videos_array =  $featured_videos_array;
            $normal_videos_array  =  $normal_videos_array ;
        }
        elseif(count($featured_videos_array)==0)
        {
            $normal_videos_array    = $this->M_Home->getAllNormalVideos($topic_id,$langcode,$countrycode,$count_type,20,$offset);
        }
        elseif(count($featured_videos_array)==1)
        {
            $normal_videos_array    = $this->M_Home->getAllNormalVideos($topic_id,$langcode,$countrycode,$count_type,16,$offset);
        }
        elseif(count($normal_videos_array)== 0)
        {
            $featured_videos_array  = $this->M_Home->getAllFeaturedVideos($topic_id,$langcode,$countrycode,$count_type,8,$offset);
        }
        
        $data['featured_videos_array'] =  $this->phpObjectToArray($featured_videos_array);
        $data['normal_videos_array']  =   $this->phpObjectToArray($normal_videos_array );
        $data['featured_videos_array_count'] =  $this->M_Home->getAllFeaturedVideosCount($topic_id,$langcode,$countrycode,$count_type);
        $data['normal_videos_array_count'] =  $this->M_Home->getAllNormalVideosCount($topic_id,$langcode,$countrycode,$count_type);
        $this->load->view('videos/home-page',$data); 
    }
    
     // --------------------------------------------------------------------
     /**
	 * lazy loading page for home page
	 * 
	 * @param   integer topicid
         * @param   string langcode
         * @param   integer country code
         * @param   integer counttype(eg:youtubecount,twitter count etc)   
         * @param   integer current page
         * @param   integer current limit of the featured video 
         * @param   integer current limit of the normal video 
	 * @return  list all videos based on search keyword
	 */
    public function home_listing()
    {
        $featured_limit = 4;
        $normal_limit  = 16;
        $featured_offset = $_POST['featured_current_limit'];
        $normal_offset = $_POST['normal_current_limit'];
       // $topic_id       = $_POST['topic_id'];
       // $langcode       = $_POST['langcode'];
         //$countrycode       = $_POST['countrycode'];
       // $count_type       = $_POST['count_type'];
        
        $topic_id       = $_POST['topic_id'];
        $langcode       = $_POST['langcode'];
        $countrycode    = $_POST['countrycode'];
        $count_type     = $_POST['count_type'];
      
        $featured_videos_array = array();
        $normal_videos_array = array();
       if($featured_offset>1)
        {
           $featured_videos_array  = $this->M_Home->getAllFeaturedVideos($topic_id,$langcode,$countrycode,$count_type,$featured_limit,$featured_offset);
          
        }
        if($normal_offset>1)
        {
           
           $normal_videos_array    = $this->M_Home->getAllNormalVideos($topic_id,$langcode,$countrycode,$count_type,$normal_limit,$normal_offset);
            
        }
        
        //echo 'nrml'.count($normal_videos_array).'feat'.count($featured_videos_array);exit;
          
        if(count($featured_videos_array)== 4 && count($normal_videos_array)== 16 )
        {
            $featured_videos_array =  $featured_videos_array;
            $normal_videos_array  =  $normal_videos_array ;
        }
        elseif(count($featured_videos_array)==0)
        {            
            $normal_videos_array    = $this->M_Home->getAllNormalVideos($topic_id,$langcode,$countrycode,$count_type,20,$normal_offset);
                   
        }
        elseif(count($featured_videos_array)==1)
        {
            $normal_videos_array    = $this->M_Home->getAllNormalVideos($topic_id,$langcode,$countrycode,$count_type,16,$normal_offset);                    
        }
        elseif(count($normal_videos_array)== 0)
        {
            $featured_videos_array  = $this->M_Home->getAllFeaturedVideos($topic_id,$langcode,$countrycode,$count_type,8,$featured_offset);           
         
        }
        
        $data['featured_videos_array'] =  $this->phpObjectToArray($featured_videos_array);
        $data['normal_videos_array']  =   $this->phpObjectToArray($normal_videos_array );
       $output='';
     
       $fv =  $data['featured_videos_array'];
       $sv = $data['normal_videos_array']  ;
      
       /*if($featured_offset>1){
            echo '<pre>';
            print_r($featured_videos_array);
            echo '</pre>';
            echo '<pre>';
            print_r($normal_videos_array);
            echo '</pre>';
            exit;
           
       }*/
       krsort($fv);
       krsort($sv);
     //  $output .= '<div class="video_wrapper">';

     // check is any featured videos available
        if (count($fv) > 0) {
            $order = 'left';	// feature video is in left align or right align
            $sv_row = false; 
            // checking 4 sv in a row needed
            while (count($fv) > 0) { // read each featured videos
   
		// PRINT FEATURED VIDEO - LEFT ALIGN
		if ($order == 'left') {
                  $frst_array =  array_pop($fv);
                  
                    
			$output .= '<div class="large_video mobile_responsive">
                                    <div onclick="assignId('.$frst_array['video_id'].')">
                                    <img src="https://i.ytimg.com/vi/'. $frst_array['video_youtube_id'].'/sddefault.jpg">
                                    <div class="featured_video_sign"></div>
                                    <div class="details">   ';                          
                                                    
                                                    $dot ='......';
                                                    $desc= substr($frst_array['video_short_desc'],0,50);
                                                    if(strlen($frst_array['video_short_desc'])>50)
                                                    {
                                                    $desc= substr($frst_array['video_short_desc'],0,50).$dot;

                                                    }

                                                    $title = substr($frst_array['video_title'],0,18);
                                                    if(strlen($frst_array['video_title'])>18)
                                                    {
                                                    $title= substr($frst_array['video_title'],0,18).$dot;

                                                    }                                                    
                                                 $output .= '<h3>'.$title.'</h3><p>'.$desc.'</p></div></div></div>';
                               
		          }
		
		// PRINT NON-FEATURED VIDEO - LEFT/RIGHT ALIGN
		$cnt = 1;
		if ((count($sv) >= 4) or (count($fv) <= 0 and count($sv) > 0)) {
			$output .= '<div class="large_video"><ul>';	
                      
				while (count($sv) > 0 and $cnt <= 4) { // read next 4 non-featured videos
                                    
                                    $frst_array =  array_pop($sv);
					$output .='<li>
                                                    <div class="search_video_list" onclick="assignId('.$frst_array['video_id'].')">
                                                    <img src="https://i.ytimg.com/vi/'. $frst_array['video_youtube_id'].'/sddefault.jpg">
                                                    <div class="vdetails">  '; 
                                                        $dot ='......';
                                                        $desc= substr($frst_array['video_short_desc'],0,50);
                                                        if(strlen($frst_array['video_short_desc'])>50)
                                                        {
                                                        $desc= substr($frst_array['video_short_desc'],0,50).$dot;

                                                        }

                                                        $title = substr($frst_array['video_title'],0,18);
                                                        if(strlen($frst_array['video_title'])>18)
                                                        {
                                                        $title= substr($frst_array['video_title'],0,18).$dot;

                                                        }                                                    
                                                    $output .= '<h3>'.$title.'</h3><p>'.$desc.'</p></div></div></li>';                                                   
					$cnt++;
                                      
				}
			$output .='</ul></div>';
		}

		// check non-featured videos row is possible
		if (((count($fv) + 1) * 4 <= count($sv)) and $sv_row == false) {
			// PRINT 4 NON-FEATURED VIDEOS IN A ROW					
			$output .='<div class="smallgrid_holder">
				<ul>';
					$cnt = 1;
                                         
					while (count($sv) > 0 and $cnt <= 4) {					
						if ($cnt % 2 != 0 and $cnt != 1) { $output .='</ul><ul>'; } 
                                                  $frst_array =  array_pop($sv);
                                               
						$output .= '<li>
                                                            <div class="search_video_list" onclick="assignId('.$frst_array['video_id'].')">
                                                            <img src="https://i.ytimg.com/vi/'. $frst_array['video_youtube_id'].'/sddefault.jpg">
                                                            <div class="vdetails">  '; 
                                                                $dot ='......';
                                                                $desc= substr($frst_array['video_short_desc'],0,50);
                                                                if(strlen($frst_array['video_short_desc'])>50)
                                                                {
                                                                $desc= substr($frst_array['video_short_desc'],0,50).$dot;

                                                                }

                                                                $title = substr($frst_array['video_title'],0,18);
                                                                if(strlen($frst_array['video_title'])>18)
                                                                {
                                                                $title= substr($frst_array['video_title'],0,18).$dot;

                                                                }                                                    
                                                            $output .= '<h3>'.$title.'</h3><p>'.$desc.'</p></div></div></li>';                                                       
						            $cnt++;
					} 
				$output .='</ul>
			</div>';
			$sv_row = true;
		}

		// PRINT FEATURED VIDEO - RIGHT ALIGN
		if ($order == 'right') {
                     $frst_array =  array_pop($fv);
			$output .='<div class="large_video mobile_responsive">
                                   <div onclick="assignId('.$frst_array['video_id'].')">
                                   <img src="https://i.ytimg.com/vi/'. $frst_array['video_youtube_id'].'/sddefault.jpg">
                                  <div class="featured_video_sign"></div>
                                  <div class="details">   '; 
                                        $dot ='......';
                                        $desc= substr($frst_array['video_short_desc'],0,50);
                                        if(strlen($frst_array['video_short_desc'])>50)
                                        {
                                        $desc= substr($frst_array['video_short_desc'],0,50).$dot;

                                        }

                                        $title = substr($frst_array['video_title'],0,18);
                                        if(strlen($frst_array['video_title'])>18)
                                        {
                                        $title= substr($frst_array['video_title'],0,18).$dot;

                                        }                                                    
                                    $output .= '<h3>'.$title.'</h3><p>'.$desc.'</p></div></div></div>';                                
		 }

		$order = $order == 'left' ? 'right' : 'left';
               
                
		
	} // end featured videos loop

	// check any more non-featured videos available
	if (count($sv) > 0) {
		$output .= '<div class="smallgrid_holder">
			<ul>';
					$cnt = 1;
				while (count($sv) > 0) {
					if ($cnt % 2 != 0 and $cnt != 1) { $output .='</ul><ul>'; } 
                                        $frst_array =  array_pop($sv);
                                        
					$output .='<li>
                                                  <div class="search_video_list" onclick="assignId('.$frst_array['video_id'].')">
                                                   <img src="https://i.ytimg.com/vi/'. $frst_array['video_youtube_id'].'/sddefault.jpg">
                                                   <div class="vdetails">  '; 
                                                        $dot ='......';
                                                        $desc= substr($frst_array['video_short_desc'],0,50);
                                                        if(strlen($frst_array['video_short_desc'])>50)
                                                        {
                                                        $desc= substr($frst_array['video_short_desc'],0,50).$dot;

                                                        }

                                                        $title = substr($frst_array['video_title'],0,18);
                                                        if(strlen($frst_array['video_title'])>18)
                                                        {
                                                        $title= substr($frst_array['video_title'],0,18).$dot;

                                                        }                                                    
                                                    $output .= '<h3>'.$title.'</h3><p>'.$desc.'</p></div></div></li>';                                                   
					 $cnt++;
				}
			$output .='</ul>
		</div> ';
            }
        }elseif (count($sv) > 0) { // check only non-featured videos are available 
	$output .= '<div class="smallgrid_holder">
		<ul>';
			$cnt = 1;
			while (count($sv) > 0) {
				if ($cnt % 2 != 0 and $cnt != 1) { $output .='</ul><ul>'; }                                     
                                       $frst_array =  array_pop($sv);
                                       
                                      
				$output .='<li>
                                           <div class="search_video_list" onclick="assignId('.$frst_array['video_id'].')">
                                            <img src="https://i.ytimg.com/vi/'. $frst_array['video_youtube_id'].'/sddefault.jpg">
                                             <div class="vdetails">  '; 
                                                        $dot ='......';
                                                        $desc= substr($frst_array['video_short_desc'],0,50);
                                                        if(strlen($frst_array['video_short_desc'])>50)
                                                        {
                                                        $desc= substr($frst_array['video_short_desc'],0,50).$dot;

                                                        }

                                                        $title = substr($frst_array['video_title'],0,18);
                                                        if(strlen($frst_array['video_title'])>18)
                                                        {
                                                        $title= substr($frst_array['video_title'],0,18).$dot;

                                                        }                                                    
                                                    $output .= '<h3>'.$title.'</h3><p>'.$desc.'</p></div></div></li>'; 
                                             
				 $cnt++;
			} 
		$output .='</ul>
	</div>';
        }else{
	//echo 'no videos';
    }
        $output .='<div class="clear"></div>';

        $data	= array(

                    'html'   =>	$output,
                    'featured_offset'  => count( $data['featured_videos_array']),
                    'normal_offset'  => count($data['normal_videos_array'])
                     );
	echo json_encode($data);
    }
     // --------------------------------------------------------------------
     /**
	 * function for converting stdclass object into array
	 * 
	 * @param   stdclass object         	
	 * @return  return as array
	 */
    function phpObjectToArray($phpObject)
    {
        if(!is_object($phpObject) && !is_array($phpObject))
            return $phpObject;

        $phpArray=array();
        foreach($phpObject as $member=>$data)
        {
            $phpArray[$member]=$this->phpObjectToArray($data);

        }
        return $phpArray;
    }
     // --------------------------------------------------------------------
     /**
	 * list all videos based on the home page drop down values
	 * 
	 * @param   integer topicid
         * @param   string langcode
         * @param   integer country code
         * @param   integer counttype(eg:youtubecount,twitter count etc)   
         * @param   integer current page
         * @return  list all videos based on drop down values
	 */
    public function condtn_based_listing()
    {
        $featured_limit = 4;
        $normal_limit   = 16;
        $offset         = 0;
        $topic_id       = $_POST['topic_id'];
        $langcode       = $_POST['langcode'];
        $countrycode    = $_POST['countrycode'];
        $count_type     = $_POST['count_type'];
         
        $featured_videos_array = array();
        $normal_videos_array = array();
       
        $featured_videos_array  = $this->M_Home->getAllFeaturedVideos($topic_id,$langcode,$countrycode,$count_type,$featured_limit,$offset);
     
        $normal_videos_array    = $this->M_Home->getAllNormalVideos($topic_id,$langcode,$countrycode,$count_type,$normal_limit,$offset);

        $featured_videos_array_count =  $this->M_Home->getAllFeaturedVideosCount($topic_id,$langcode,$countrycode,$count_type);
        $normal_videos_array_count =  $this->M_Home->getAllNormalVideosCount($topic_id,$langcode,$countrycode,$count_type);
         
        if(count($featured_videos_array)== 4 && count($normal_videos_array)== 16 )
        {
            $featured_videos_array =  $featured_videos_array;
            $normal_videos_array  =  $normal_videos_array ;
        }
        elseif(count($featured_videos_array)==0)
        {
            $normal_videos_array    = $this->M_Home->getAllNormalVideos($topic_id,$langcode,$countrycode,$count_type,20,$offset);
        }
        elseif(count($featured_videos_array)==1)
        {
            $normal_videos_array    = $this->M_Home->getAllNormalVideos($topic_id,$langcode,$countrycode,$count_type,16,$offset);
        }
        elseif(count($normal_videos_array)== 0)
        {
            $featured_videos_array  = $this->M_Home->getAllFeaturedVideos($topic_id,$langcode,$countrycode,$count_type,8,$offset);
        }
        
        $data['featured_videos_array'] =  $this->phpObjectToArray($featured_videos_array);
        $data['normal_videos_array']  =   $this->phpObjectToArray($normal_videos_array );
         $output='';
     
       $fv =  $data['featured_videos_array'];
       $sv = $data['normal_videos_array']  ;
       
       krsort($fv);
       krsort($sv);
     //  $output .= '<div class="video_wrapper">';

     // check is any featured videos available
        if (count($fv) > 0) {
            $order = 'left';	// feature video is in left align or right align
            $sv_row = false; 
            // checking 4 sv in a row needed
            while (count($fv) > 0) { // read each featured videos
   
		// PRINT FEATURED VIDEO - LEFT ALIGN
		if ($order == 'left') {
                  $frst_array =  array_pop($fv);
                  
                    
			$output .= '<div class="large_video mobile_responsive">
                                    <div onclick="assignId('.$frst_array['video_id'].')">
                                    <img src="https://i.ytimg.com/vi/'. $frst_array['video_youtube_id'].'/sddefault.jpg">
                                     <div class="featured_video_sign"></div>
                                     <div class="details">   ';                          
                                                    
                                                    $dot ='......';
                                                    $desc= substr($frst_array['video_short_desc'],0,50);
                                                    if(strlen($frst_array['video_short_desc'])>50)
                                                    {
                                                    $desc= substr($frst_array['video_short_desc'],0,50).$dot;

                                                    }

                                                    $title = substr($frst_array['video_title'],0,18);
                                                    if(strlen($frst_array['video_title'])>18)
                                                    {
                                                    $title= substr($frst_array['video_title'],0,18).$dot;

                                                    }                                                    
                                                 $output .= '<h3>'.$title.'</h3><p>'.$desc.'</p></div></div></div>';
                               
		          }
		
		// PRINT NON-FEATURED VIDEO - LEFT/RIGHT ALIGN
		$cnt = 1;
		if ((count($sv) >= 4) or (count($fv) <= 0 and count($sv) > 0)) {
			$output .= '<div class="large_video"><ul>';	
                      
				while (count($sv) > 0 and $cnt <= 4) { // read next 4 non-featured videos
                                    
                                    $frst_array =  array_pop($sv);
					$output .='<li>
                                                    <div class="search_video_list" onclick="assignId('.$frst_array['video_id'].')">
                                                    <img src="https://i.ytimg.com/vi/'. $frst_array['video_youtube_id'].'/sddefault.jpg">
                                                    <div class="vdetails">  '; 
                                                        $dot ='......';
                                                        $desc= substr($frst_array['video_short_desc'],0,50);
                                                        if(strlen($frst_array['video_short_desc'])>50)
                                                        {
                                                        $desc= substr($frst_array['video_short_desc'],0,50).$dot;

                                                        }

                                                        $title = substr($frst_array['video_title'],0,18);
                                                        if(strlen($frst_array['video_title'])>18)
                                                        {
                                                        $title= substr($frst_array['video_title'],0,18).$dot;

                                                        }                                                    
                                                    $output .= '<h3>'.$title.'</h3><p>'.$desc.'</p></div></div></li>';                                                   
					$cnt++;
                                      
				}
			$output .='</ul></div>';
		}

		// check non-featured videos row is possible
		if (((count($fv) + 1) * 4 <= count($sv)) and $sv_row == false) {
			// PRINT 4 NON-FEATURED VIDEOS IN A ROW					
			$output .='<div class="smallgrid_holder">
				<ul>';
					$cnt = 1;
                                         
					while (count($sv) > 0 and $cnt <= 4) {					
						if ($cnt % 2 != 0 and $cnt != 1) { $output .='</ul><ul>'; } 
                                                  $frst_array =  array_pop($sv);
                                               
						$output .= '<li>
                                                            <div class="search_video_list" onclick="assignId('.$frst_array['video_id'].')">
                                                            <img src="https://i.ytimg.com/vi/'. $frst_array['video_youtube_id'].'/sddefault.jpg">
                                                            <div class="vdetails">  '; 
                                                                $dot ='......';
                                                                $desc= substr($frst_array['video_short_desc'],0,50);
                                                                if(strlen($frst_array['video_short_desc'])>50)
                                                                {
                                                                $desc= substr($frst_array['video_short_desc'],0,50).$dot;

                                                                }

                                                                $title = substr($frst_array['video_title'],0,18);
                                                                if(strlen($frst_array['video_title'])>18)
                                                                {
                                                                $title= substr($frst_array['video_title'],0,18).$dot;

                                                                }                                                    
                                                            $output .= '<h3>'.$title.'</h3><p>'.$desc.'</p></div></div></li>';                                                       
						            $cnt++;
					} 
				$output .='</ul>
			</div>';
			$sv_row = true;
		}

		// PRINT FEATURED VIDEO - RIGHT ALIGN
		if ($order == 'right') {
                     $frst_array =  array_pop($fv);
			$output .='<div class="large_video mobile_responsive">
                                   <div onclick="assignId('.$frst_array['video_id'].')">
                                   <img src="https://i.ytimg.com/vi/'. $frst_array['video_youtube_id'].'/sddefault.jpg">
                                   <div class="featured_video_sign"></div>
                                   <div class="details">   '; 
                                        $dot ='......';
                                        $desc= substr($frst_array['video_short_desc'],0,50);
                                        if(strlen($frst_array['video_short_desc'])>50)
                                        {
                                        $desc= substr($frst_array['video_short_desc'],0,50).$dot;

                                        }

                                        $title = substr($frst_array['video_title'],0,18);
                                        if(strlen($frst_array['video_title'])>18)
                                        {
                                        $title= substr($frst_array['video_title'],0,18).$dot;

                                        }                                                    
                                    $output .= '<h3>'.$title.'</h3><p>'.$desc.'</p></div></div></div>';                                
		 }

		$order = $order == 'left' ? 'right' : 'left';
               
                
		
	} // end featured videos loop

	// check any more non-featured videos available
	if (count($sv) > 0) {
		$output .= '<div class="smallgrid_holder">
			<ul>';
					$cnt = 1;
				while (count($sv) > 0) {
					if ($cnt % 2 != 0 and $cnt != 1) { $output .='</ul><ul>'; } 
                                        $frst_array =  array_pop($sv);
                                        
					$output .='<li>
                                                  <div class="search_video_list" onclick="assignId('.$frst_array['video_id'].')">
                                                   <img src="https://i.ytimg.com/vi/'. $frst_array['video_youtube_id'].'/sddefault.jpg">
                                                   <div class="vdetails">  '; 
                                                        $dot ='......';
                                                        $desc= substr($frst_array['video_short_desc'],0,50);
                                                        if(strlen($frst_array['video_short_desc'])>50)
                                                        {
                                                        $desc= substr($frst_array['video_short_desc'],0,50).$dot;

                                                        }

                                                        $title = substr($frst_array['video_title'],0,18);
                                                        if(strlen($frst_array['video_title'])>18)
                                                        {
                                                        $title= substr($frst_array['video_title'],0,18).$dot;

                                                        }                                                    
                                                    $output .= '<h3>'.$title.'</h3><p>'.$desc.'</p></div></div></li>';                                                   
					 $cnt++;
				}
			$output .='</ul>
		</div> ';
            }
        }elseif (count($sv) > 0) { // check only non-featured videos are available 
	$output .= '<div class="smallgrid_holder">
		<ul>';
			$cnt = 1;
			while (count($sv) > 0) {
				if ($cnt % 2 != 0 and $cnt != 1) { $output .='</ul><ul>'; }                                     
                                       $frst_array =  array_pop($sv);
                                       
                                      
				$output .='<li>
                                           <div class="search_video_list" onclick="assignId('.$frst_array['video_id'].')">
                                            <img src="https://i.ytimg.com/vi/'. $frst_array['video_youtube_id'].'/sddefault.jpg">
                                             <div class="vdetails">  '; 
                                                        $dot ='......';
                                                        $desc= substr($frst_array['video_short_desc'],0,50);
                                                        if(strlen($frst_array['video_short_desc'])>50)
                                                        {
                                                        $desc= substr($frst_array['video_short_desc'],0,50).$dot;

                                                        }

                                                        $title = substr($frst_array['video_title'],0,18);
                                                        if(strlen($frst_array['video_title'])>18)
                                                        {
                                                        $title= substr($frst_array['video_title'],0,18).$dot;

                                                        }                                                    
                                                    $output .= '<h3>'.$title.'</h3><p>'.$desc.'</p></div></div></li>'; 
                                             
				 $cnt++;
			} 
		$output .='</ul>
	</div>';
        }else{
	//echo 'no videos';
    }
        $output .='<div class="clear"></div>';

        $data	= array(

                    'html'   =>	$output,
                    'featured_offset'  => count( $data['featured_videos_array']),
                    'normal_offset'  => count($data['normal_videos_array']),
                    'total_feat' => $featured_videos_array_count,
                    'total_norml' => $normal_videos_array_count
                     );
	echo json_encode($data);
    }
}
 
/* End of file home.php */
/* Location: ./application/controllers/home.php */   
