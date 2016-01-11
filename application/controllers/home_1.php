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
    public function index()
    {
        $featured_limit = 4;
        $normal_limit  = 16;
        $offset = 0;
        $data['topics']= $this->M_Home->getAllTopics($this->language);
        $data['all_languages']= $this->M_Home->getAllVideoLanguages();
        $data['all_countries']= $this->M_Home->getAllVideoCountries();
          
        $featured_videos_array  = $this->M_Home->getFeaturedVideos($featured_limit,$offset);
        $normal_videos_array    = $this->M_Home->getNormalVideos($normal_limit,$offset);
        if(count($featured_videos_array)== 4 && count($normal_videos_array)== 16 )
        {
            $featured_videos_array =  $featured_videos_array;
            $normal_videos_array  =  $normal_videos_array ;
        }
        elseif(count($featured_videos_array)==0)
        {
            $normal_videos_array    = $this->M_Home->getNormalVideos(20,$offset);
        }
        elseif(count($featured_videos_array)==1)
        {
            $normal_videos_array    = $this->M_Home->getNormalVideos(16,$offset);
        }
        elseif(count($normal_videos_array)== 0)
        {
            $featured_videos_array  = $this->M_Home->getFeaturedVideos(8,$offset);
        }
        
        $data['featured_videos_array'] =  $this->phpObjectToArray($featured_videos_array);
        $data['normal_videos_array']  =   $this->phpObjectToArray($normal_videos_array );
        $this->load->view('videos/home-page',$data); 
    }
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
        $featured_videos_array = array();
        $normal_videos_array = array();
       if($featured_offset>1)
        {
            if(isset($_POST['topic_id']))
            {
                if($_POST['topic_id']!='')
                {
                    $topic_id       = $_POST['topic_id'];
                    $featured_videos_array  = $this->M_Home->getFeaturedVideosBasedOnTopic($topic_id,$featured_limit,$featured_offset);  
               }
            }
            elseif(isset($_POST['langcode']))
            {
                if($_POST['langcode']!='')
                {
                    $langcode       = $_POST['langcode'];
                    $featured_videos_array  = $this->M_Home->getFeaturedVideosBasedOnLang($langcode,$featured_limit,$featured_offset);  
               }
            }
            elseif(isset($_POST['countrycode']))
            {
                if($_POST['countrycode']!='')
                {
                    $countrycode       = $_POST['countrycode'];
                    $featured_videos_array  = $this->M_Home->getFeaturedVideosBasedOnCountry($countrycode,$featured_limit,$featured_offset);  
               }
            }
            elseif(isset($_POST['count_type']))
            {
                if($_POST['count_type']!='')
                {
                    $count_type       = $_POST['count_type'];
                    $featured_videos_array  = $this->M_Home->getFeaturedVideosBasedOnVideoCount($count_type,$featured_limit,$featured_offset);  
               }
            }
            else
            {
                $featured_videos_array  = $this->M_Home->getFeaturedVideos($featured_limit,$featured_offset);
            }
          
        }
        if($normal_offset>1)
        {
            if(isset($_POST['topic_id']))
            {
                if($_POST['topic_id']!='')
                {
                     $topic_id       = $_POST['topic_id'];
                    $normal_videos_array    = $this->M_Home->getNormalVideosBasedOnTopic($topic_id,$normal_limit,$normal_offset);
                }
            }
            elseif(isset($_POST['langcode']))
            {
                if($_POST['langcode']!='')
                {
                     $langcode       = $_POST['langcode'];
                    $normal_videos_array  = $this->M_Home->getNormalVideosBasedOnLang($langcode,$normal_limit,$normal_offset);  
                  
               }
            }
            elseif(isset($_POST['countrycode']))
            {
                if($_POST['countrycode']!='')
                {
                     $countrycode       = $_POST['countrycode'];
                    $normal_videos_array  = $this->M_Home->getNormalVideosBasedOnCountry($countrycode,$normal_limit,$normal_offset);  
                  
               }
            }
            elseif(isset($_POST['count_type']))
            {
                if($_POST['count_type']!='')
                {
                     $count_type       = $_POST['count_type'];
                    $normal_videos_array  = $this->M_Home->getNormalVideosBasedOnVideoCount($count_type,$normal_limit,$normal_offset);  
                  
               }
            }
            else
            {
                $normal_videos_array    = $this->M_Home->getNormalVideos($normal_limit,$normal_offset);
            }
            
        }
        //echo 'nrml'.count($normal_videos_array).'feat'.count($featured_videos_array);exit;
          
        if(count($featured_videos_array)== 4 && count($normal_videos_array)== 16 )
        {
            $featured_videos_array =  $featured_videos_array;
            $normal_videos_array  =  $normal_videos_array ;
        }
        elseif(count($featured_videos_array)==0)
        {
            if(isset($_POST['topic_id']))
            {
                if($_POST['topic_id']!='')
                {
                     $topic_id       = $_POST['topic_id'];
                    $normal_videos_array    = $this->M_Home->getNormalVideosBasedOnTopic($topic_id,20,$normal_offset);
                }
            }
            elseif(isset($_POST['langcode']))
            {
                if($_POST['langcode']!='')
                {
                    $langcode       = $_POST['langcode'];
                    $normal_videos_array  = $this->M_Home->getNormalVideosBasedOnLang($langcode,20,$normal_offset);  
               }
            }
            elseif(isset($_POST['countrycode']))
            {
                if($_POST['countrycode']!='')
                {
                    $countrycode       = $_POST['countrycode'];
                    $normal_videos_array  = $this->M_Home->getNormalVideosBasedOnCountry($countrycode,20,$normal_offset);  
               }
            }
            elseif(isset($_POST['count_type']))
            {
                if($_POST['count_type']!='')
                {
                    $count_type       = $_POST['count_type'];
                    $normal_videos_array  = $this->M_Home->getNormalVideosBasedOnVideoCount($count_type,20,$normal_offset);  
               }
            }
            else
            {
                $normal_videos_array    = $this->M_Home->getNormalVideos(20,$normal_offset);
            }
            
        }
        elseif(count($featured_videos_array)==1)
        {
            if(isset($_POST['topic_id']))
            {
                if($_POST['topic_id']!='')
                {
                     $topic_id       = $_POST['topic_id'];
                    $normal_videos_array    = $this->M_Home->getNormalVideosBasedOnTopic($topic_id,16,$normal_offset);
                }
            }
            elseif(isset($_POST['langcode']))
            {
                if($_POST['langcode']!='')
                {
                    $langcode       = $_POST['langcode'];
                    $normal_videos_array  = $this->M_Home->getNormalVideosBasedOnLang($langcode,16,$normal_offset);  
               }
            }
            elseif(isset($_POST['countrycode']))
            {
                if($_POST['countrycode']!='')
                {
                    $countrycode       = $_POST['countrycode'];
                    $normal_videos_array  = $this->M_Home->getNormalVideosBasedOnCountry($countrycode,16,$normal_offset);  
               }
            }
            elseif(isset($_POST['count_type']))
            {
                if($_POST['count_type']!='')
                {
                    $count_type       = $_POST['count_type'];
                    $normal_videos_array  = $this->M_Home->getNormalVideosBasedOnVideoCount($count_type,16,$normal_offset);  
               }
            }
            else
            {
                 $normal_videos_array    = $this->M_Home->getNormalVideos(16,$normal_offset);
            }           
        }
        elseif(count($normal_videos_array)== 0)
        {
            
            if(isset($_POST['topic_id']))
            {
                if($_POST['topic_id']!='')
                {
                     $topic_id       = $_POST['topic_id'];
                    $featured_videos_array  = $this->M_Home->getFeaturedVideosBasedOnTopic($topic_id,8,$featured_offset);
                }
            }
            elseif(isset($_POST['langcode']))
            {
                if($_POST['langcode']!='')
                {
                    $langcode       = $_POST['langcode'];
                    $featured_videos_array  = $this->M_Home->getFeaturedVideosBasedOnLang($langcode,8,$featured_offset);  
               }
            }
            elseif(isset($_POST['countrycode']))
            {
                if($_POST['countrycode']!='')
                {
                    $countrycode       = $_POST['countrycode'];
                    $featured_videos_array  = $this->M_Home->getFeaturedVideosBasedOnCountry($countrycode,8,$featured_offset);  
               }
            }
             elseif(isset($_POST['count_type']))
            {
                if($_POST['count_type']!='')
                {
                    $count_type       = $_POST['count_type'];
                    $featured_videos_array  = $this->M_Home->getFeaturedVideosBasedOnVideoCount($count_type,8,$featured_offset);  
               }
            }
            else
            {
                 $featured_videos_array  = $this->M_Home->getFeaturedVideos(8,$featured_offset);
            }
           
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
                  
                    
			$output .= '<div class="large_video">
                                    <div class="search_video_list "onclick="assignId('.$frst_array['video_id'].')">
                                    <img src="https://i.ytimg.com/vi/'. $frst_array['video_youtube_id'].'/sddefault.jpg">
                                    <div class="featured_video_sign"></div>
                                    <div class="details">   ';                          
                                                    
                                                    $dot ='......';
                                                    $desc= substr($frst_array['video_desc'],0,20);
                                                    if(strlen($frst_array['video_desc'])>20)
                                                    {
                                                    $desc= substr($frst_array['video_desc'],0,20).$dot;

                                                    }

                                                    $title = substr($frst_array['video_title'],0,10);
                                                    if(strlen($frst_array['video_title'])>10)
                                                    {
                                                    $title= substr($frst_array['video_title'],0,10).$dot;

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
                                                    <div class="search_video_list "onclick="assignId('.$frst_array['video_id'].')">
                                                    <img src="https://i.ytimg.com/vi/'. $frst_array['video_youtube_id'].'/sddefault.jpg">
                                                    <div class="vdetails">  '; 
                                                        $dot ='......';
                                                        $desc= substr($frst_array['video_desc'],0,20);
                                                        if(strlen($frst_array['video_desc'])>20)
                                                        {
                                                        $desc= substr($frst_array['video_desc'],0,20).$dot;

                                                        }

                                                        $title = substr($frst_array['video_title'],0,10);
                                                        if(strlen($frst_array['video_title'])>10)
                                                        {
                                                        $title= substr($frst_array['video_title'],0,10).$dot;

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
                                                            <div class="search_video_list "onclick="assignId('.$frst_array['video_id'].')">
                                                            <img src="https://i.ytimg.com/vi/'. $frst_array['video_youtube_id'].'/sddefault.jpg">
                                                            <div class="vdetails">  '; 
                                                                $dot ='......';
                                                                $desc= substr($frst_array['video_desc'],0,20);
                                                                if(strlen($frst_array['video_desc'])>20)
                                                                {
                                                                $desc= substr($frst_array['video_desc'],0,20).$dot;

                                                                }

                                                                $title = substr($frst_array['video_title'],0,10);
                                                                if(strlen($frst_array['video_title'])>10)
                                                                {
                                                                $title= substr($frst_array['video_title'],0,10).$dot;

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
			$output .='<div class="large_video">
                                   <div class="search_video_list "onclick="assignId('.$frst_array['video_id'].')">
                                   <img src="https://i.ytimg.com/vi/'. $frst_array['video_youtube_id'].'/sddefault.jpg">
                                  <div class="featured_video_sign"></div>
                                  <div class="details">   '; 
                                        $dot ='......';
                                        $desc= substr($frst_array['video_desc'],0,20);
                                        if(strlen($frst_array['video_desc'])>20)
                                        {
                                        $desc= substr($frst_array['video_desc'],0,20).$dot;

                                        }

                                        $title = substr($frst_array['video_title'],0,10);
                                        if(strlen($frst_array['video_title'])>10)
                                        {
                                        $title= substr($frst_array['video_title'],0,10).$dot;

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
                                                  <div class="search_video_list "onclick="assignId('.$frst_array['video_id'].')">
                                                   <img src="https://i.ytimg.com/vi/'. $frst_array['video_youtube_id'].'/sddefault.jpg">
                                                   <div class="vdetails">  '; 
                                                        $dot ='......';
                                                        $desc= substr($frst_array['video_desc'],0,20);
                                                        if(strlen($frst_array['video_desc'])>20)
                                                        {
                                                        $desc= substr($frst_array['video_desc'],0,20).$dot;

                                                        }

                                                        $title = substr($frst_array['video_title'],0,10);
                                                        if(strlen($frst_array['video_title'])>10)
                                                        {
                                                        $title= substr($frst_array['video_title'],0,10).$dot;

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
                                           <div class="search_video_list "onclick="assignId('.$frst_array['video_id'].')">
                                            <img src="https://i.ytimg.com/vi/'. $frst_array['video_youtube_id'].'/sddefault.jpg">
                                             <div class="vdetails">  '; 
                                                        $dot ='......';
                                                        $desc= substr($frst_array['video_desc'],0,20);
                                                        if(strlen($frst_array['video_desc'])>20)
                                                        {
                                                        $desc= substr($frst_array['video_desc'],0,20).$dot;

                                                        }

                                                        $title = substr($frst_array['video_title'],0,10);
                                                        if(strlen($frst_array['video_title'])>10)
                                                        {
                                                        $title= substr($frst_array['video_title'],0,10).$dot;

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
    
    public function topic_based_listing()
    {
        $featured_limit = 4;
        $normal_limit   = 16;
        $offset         = 0;
        $topic_id       = $_POST['topic_id'];
        $featured_videos_array = array();
        $normal_videos_array = array();
       
        $featured_videos_array  = $this->M_Home->getFeaturedVideosBasedOnTopic($topic_id,$featured_limit,$offset);

     
        $normal_videos_array    = $this->M_Home->getNormalVideosBasedOnTopic($topic_id,$normal_limit,$offset);
                 
               // echo $this->db->last_query();exit;
        if(count($featured_videos_array)== 4 && count($normal_videos_array)== 16 )
        {
            $featured_videos_array =  $featured_videos_array;
            $normal_videos_array  =  $normal_videos_array ;
        }
        elseif(count($featured_videos_array)==0)
        {
            $normal_videos_array    = $this->M_Home->getNormalVideosBasedOnTopic($topic_id,20,$offset);
        }
        elseif(count($featured_videos_array)==1)
        {
            $normal_videos_array    = $this->M_Home->getNormalVideosBasedOnTopic($topic_id,16,$offset);
        }
        elseif(count($normal_videos_array)== 0)
        {
            $featured_videos_array  = $this->M_Home->getFeaturedVideosBasedOnTopic($topic_id,8,$offset);
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
                  
                    
			$output .= '<div class="large_video">
                                    <div class="search_video_list "onclick="assignId('.$frst_array['video_id'].')">
                                    <img src="https://i.ytimg.com/vi/'. $frst_array['video_youtube_id'].'/sddefault.jpg">
                                     <div class="featured_video_sign"></div>
                                     <div class="details">   ';                          
                                                    
                                                    $dot ='......';
                                                    $desc= substr($frst_array['video_desc'],0,20);
                                                    if(strlen($frst_array['video_desc'])>20)
                                                    {
                                                    $desc= substr($frst_array['video_desc'],0,20).$dot;

                                                    }

                                                    $title = substr($frst_array['video_title'],0,10);
                                                    if(strlen($frst_array['video_title'])>10)
                                                    {
                                                    $title= substr($frst_array['video_title'],0,10).$dot;

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
                                                    <div class="search_video_list "onclick="assignId('.$frst_array['video_id'].')">
                                                    <img src="https://i.ytimg.com/vi/'. $frst_array['video_youtube_id'].'/sddefault.jpg">
                                                    <div class="vdetails">  '; 
                                                        $dot ='......';
                                                        $desc= substr($frst_array['video_desc'],0,20);
                                                        if(strlen($frst_array['video_desc'])>20)
                                                        {
                                                        $desc= substr($frst_array['video_desc'],0,20).$dot;

                                                        }

                                                        $title = substr($frst_array['video_title'],0,10);
                                                        if(strlen($frst_array['video_title'])>10)
                                                        {
                                                        $title= substr($frst_array['video_title'],0,10).$dot;

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
                                                            <div class="search_video_list "onclick="assignId('.$frst_array['video_id'].')">
                                                            <img src="https://i.ytimg.com/vi/'. $frst_array['video_youtube_id'].'/sddefault.jpg">
                                                            <div class="vdetails">  '; 
                                                                $dot ='......';
                                                                $desc= substr($frst_array['video_desc'],0,20);
                                                                if(strlen($frst_array['video_desc'])>20)
                                                                {
                                                                $desc= substr($frst_array['video_desc'],0,20).$dot;

                                                                }

                                                                $title = substr($frst_array['video_title'],0,10);
                                                                if(strlen($frst_array['video_title'])>10)
                                                                {
                                                                $title= substr($frst_array['video_title'],0,10).$dot;

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
			$output .='<div class="large_video">
                                   <div class="search_video_list "onclick="assignId('.$frst_array['video_id'].')">
                                   <img src="https://i.ytimg.com/vi/'. $frst_array['video_youtube_id'].'/sddefault.jpg">
                                   <div class="featured_video_sign"></div>
                                   <div class="details">   '; 
                                        $dot ='......';
                                        $desc= substr($frst_array['video_desc'],0,20);
                                        if(strlen($frst_array['video_desc'])>20)
                                        {
                                        $desc= substr($frst_array['video_desc'],0,20).$dot;

                                        }

                                        $title = substr($frst_array['video_title'],0,10);
                                        if(strlen($frst_array['video_title'])>10)
                                        {
                                        $title= substr($frst_array['video_title'],0,10).$dot;

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
                                                  <div class="search_video_list "onclick="assignId('.$frst_array['video_id'].')">
                                                   <img src="https://i.ytimg.com/vi/'. $frst_array['video_youtube_id'].'/sddefault.jpg">
                                                   <div class="vdetails">  '; 
                                                        $dot ='......';
                                                        $desc= substr($frst_array['video_desc'],0,20);
                                                        if(strlen($frst_array['video_desc'])>20)
                                                        {
                                                        $desc= substr($frst_array['video_desc'],0,20).$dot;

                                                        }

                                                        $title = substr($frst_array['video_title'],0,10);
                                                        if(strlen($frst_array['video_title'])>10)
                                                        {
                                                        $title= substr($frst_array['video_title'],0,10).$dot;

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
                                           <div class="search_video_list "onclick="assignId('.$frst_array['video_id'].')">
                                            <img src="https://i.ytimg.com/vi/'. $frst_array['video_youtube_id'].'/sddefault.jpg">
                                             <div class="vdetails">  '; 
                                                        $dot ='......';
                                                        $desc= substr($frst_array['video_desc'],0,20);
                                                        if(strlen($frst_array['video_desc'])>20)
                                                        {
                                                        $desc= substr($frst_array['video_desc'],0,20).$dot;

                                                        }

                                                        $title = substr($frst_array['video_title'],0,10);
                                                        if(strlen($frst_array['video_title'])>10)
                                                        {
                                                        $title= substr($frst_array['video_title'],0,10).$dot;

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
      
    public function lang_based_listing()
    {
        $featured_limit = 4;
        $normal_limit   = 16;
        $offset         = 0;
        $langcode       = $_POST['langcode'];
        $featured_videos_array = array();
        $normal_videos_array = array();
       
        $featured_videos_array  = $this->M_Home->getFeaturedVideosBasedOnLang($langcode,$featured_limit,$offset);

     
        $normal_videos_array    = $this->M_Home->getNormalVideosBasedOnLang($langcode,$normal_limit,$offset);
                 
                // echo $this->db->last_query();exit;
        if(count($featured_videos_array)== 4 && count($normal_videos_array)== 16 )
        {
            $featured_videos_array =  $featured_videos_array;
            $normal_videos_array  =  $normal_videos_array ;
        }
        elseif(count($featured_videos_array)==0)
        {
            $normal_videos_array    = $this->M_Home->getNormalVideosBasedOnLang($langcode,20,$offset);
        }
        elseif(count($featured_videos_array)==1)
        {
            $normal_videos_array    = $this->M_Home->getNormalVideosBasedOnLang($langcode,16,$offset);
        }
        elseif(count($normal_videos_array)== 0)
        {
            $featured_videos_array  = $this->M_Home->getFeaturedVideosBasedOnLang($langcode,8,$offset);
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
                  
                    
			$output .= '<div class="large_video">
                                    <div class="search_video_list "onclick="assignId('.$frst_array['video_id'].')">
                                    <img src="https://i.ytimg.com/vi/'. $frst_array['video_youtube_id'].'/sddefault.jpg">
                                     <div class="featured_video_sign"></div>
                                     <div class="details">   ';                          
                                                    
                                                    $dot ='......';
                                                    $desc= substr($frst_array['video_desc'],0,20);
                                                    if(strlen($frst_array['video_desc'])>20)
                                                    {
                                                    $desc= substr($frst_array['video_desc'],0,20).$dot;

                                                    }

                                                    $title = substr($frst_array['video_title'],0,10);
                                                    if(strlen($frst_array['video_title'])>10)
                                                    {
                                                    $title= substr($frst_array['video_title'],0,10).$dot;

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
                                                    <div class="search_video_list "onclick="assignId('.$frst_array['video_id'].')">
                                                    <img src="https://i.ytimg.com/vi/'. $frst_array['video_youtube_id'].'/sddefault.jpg">
                                                    <div class="vdetails">  '; 
                                                        $dot ='......';
                                                        $desc= substr($frst_array['video_desc'],0,20);
                                                        if(strlen($frst_array['video_desc'])>20)
                                                        {
                                                        $desc= substr($frst_array['video_desc'],0,20).$dot;

                                                        }

                                                        $title = substr($frst_array['video_title'],0,10);
                                                        if(strlen($frst_array['video_title'])>10)
                                                        {
                                                        $title= substr($frst_array['video_title'],0,10).$dot;

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
                                                            <div class="search_video_list "onclick="assignId('.$frst_array['video_id'].')">
                                                            <img src="https://i.ytimg.com/vi/'. $frst_array['video_youtube_id'].'/sddefault.jpg">
                                                            <div class="vdetails">  '; 
                                                                $dot ='......';
                                                                $desc= substr($frst_array['video_desc'],0,20);
                                                                if(strlen($frst_array['video_desc'])>20)
                                                                {
                                                                $desc= substr($frst_array['video_desc'],0,20).$dot;

                                                                }

                                                                $title = substr($frst_array['video_title'],0,10);
                                                                if(strlen($frst_array['video_title'])>10)
                                                                {
                                                                $title= substr($frst_array['video_title'],0,10).$dot;

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
			$output .='<div class="large_video">
                                   <div class="search_video_list "onclick="assignId('.$frst_array['video_id'].')">
                                   <img src="https://i.ytimg.com/vi/'. $frst_array['video_youtube_id'].'/sddefault.jpg">
                                   <div class="featured_video_sign"></div>
                                   <div class="details">   '; 
                                        $dot ='......';
                                        $desc= substr($frst_array['video_desc'],0,20);
                                        if(strlen($frst_array['video_desc'])>20)
                                        {
                                        $desc= substr($frst_array['video_desc'],0,20).$dot;

                                        }

                                        $title = substr($frst_array['video_title'],0,10);
                                        if(strlen($frst_array['video_title'])>10)
                                        {
                                        $title= substr($frst_array['video_title'],0,10).$dot;

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
                                                  <div class="search_video_list "onclick="assignId('.$frst_array['video_id'].')">
                                                   <img src="https://i.ytimg.com/vi/'. $frst_array['video_youtube_id'].'/sddefault.jpg">
                                                   <div class="vdetails">  '; 
                                                        $dot ='......';
                                                        $desc= substr($frst_array['video_desc'],0,20);
                                                        if(strlen($frst_array['video_desc'])>20)
                                                        {
                                                        $desc= substr($frst_array['video_desc'],0,20).$dot;

                                                        }

                                                        $title = substr($frst_array['video_title'],0,10);
                                                        if(strlen($frst_array['video_title'])>10)
                                                        {
                                                        $title= substr($frst_array['video_title'],0,10).$dot;

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
                                           <div class="search_video_list "onclick="assignId('.$frst_array['video_id'].')">
                                            <img src="https://i.ytimg.com/vi/'. $frst_array['video_youtube_id'].'/sddefault.jpg">
                                             <div class="vdetails">  '; 
                                                        $dot ='......';
                                                        $desc= substr($frst_array['video_desc'],0,20);
                                                        if(strlen($frst_array['video_desc'])>20)
                                                        {
                                                        $desc= substr($frst_array['video_desc'],0,20).$dot;

                                                        }

                                                        $title = substr($frst_array['video_title'],0,10);
                                                        if(strlen($frst_array['video_title'])>10)
                                                        {
                                                        $title= substr($frst_array['video_title'],0,10).$dot;

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
    
    public function country_based_listing()
    {
        $featured_limit = 4;
        $normal_limit   = 16;
        $offset         = 0;
        $countrycode       = $_POST['countrycode'];
        $featured_videos_array = array();
        $normal_videos_array = array();
       
        $featured_videos_array  = $this->M_Home->getFeaturedVideosBasedOnCountry($countrycode,$featured_limit,$offset);

     //echo $this->db->last_query();
        $normal_videos_array    = $this->M_Home->getNormalVideosBasedOnCountry($countrycode,$normal_limit,$offset);
                 
               //  echo $this->db->last_query();exit;
        if(count($featured_videos_array)== 4 && count($normal_videos_array)== 16 )
        {
            $featured_videos_array =  $featured_videos_array;
            $normal_videos_array  =  $normal_videos_array ;
        }
        elseif(count($featured_videos_array)==0)
        {
            $normal_videos_array    = $this->M_Home->getNormalVideosBasedOnCountry($countrycode,20,$offset);
        }
        elseif(count($featured_videos_array)==1)
        {
            $normal_videos_array    = $this->M_Home->getNormalVideosBasedOnCountry($countrycode,16,$offset);
        }
        elseif(count($normal_videos_array)== 0)
        {
            $featured_videos_array  = $this->M_Home->getFeaturedVideosBasedOnCountry($countrycode,8,$offset);
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
                  
                    
			$output .= '<div class="large_video">
                                    <div class="search_video_list "onclick="assignId('.$frst_array['video_id'].')">
                                    <img src="https://i.ytimg.com/vi/'. $frst_array['video_youtube_id'].'/sddefault.jpg">
                                     <div class="featured_video_sign"></div>
                                     <div class="details">   ';                          
                                                    
                                                    $dot ='......';
                                                    $desc= substr($frst_array['video_desc'],0,20);
                                                    if(strlen($frst_array['video_desc'])>20)
                                                    {
                                                    $desc= substr($frst_array['video_desc'],0,20).$dot;

                                                    }

                                                    $title = substr($frst_array['video_title'],0,10);
                                                    if(strlen($frst_array['video_title'])>10)
                                                    {
                                                    $title= substr($frst_array['video_title'],0,10).$dot;

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
                                                    <div class="search_video_list "onclick="assignId('.$frst_array['video_id'].')">
                                                    <img src="https://i.ytimg.com/vi/'. $frst_array['video_youtube_id'].'/sddefault.jpg">
                                                    <div class="vdetails">  '; 
                                                        $dot ='......';
                                                        $desc= substr($frst_array['video_desc'],0,20);
                                                        if(strlen($frst_array['video_desc'])>20)
                                                        {
                                                        $desc= substr($frst_array['video_desc'],0,20).$dot;

                                                        }

                                                        $title = substr($frst_array['video_title'],0,10);
                                                        if(strlen($frst_array['video_title'])>10)
                                                        {
                                                        $title= substr($frst_array['video_title'],0,10).$dot;

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
                                                            <div class="search_video_list "onclick="assignId('.$frst_array['video_id'].')">
                                                            <img src="https://i.ytimg.com/vi/'. $frst_array['video_youtube_id'].'/sddefault.jpg">
                                                            <div class="vdetails">  '; 
                                                                $dot ='......';
                                                                $desc= substr($frst_array['video_desc'],0,20);
                                                                if(strlen($frst_array['video_desc'])>20)
                                                                {
                                                                $desc= substr($frst_array['video_desc'],0,20).$dot;

                                                                }

                                                                $title = substr($frst_array['video_title'],0,10);
                                                                if(strlen($frst_array['video_title'])>10)
                                                                {
                                                                $title= substr($frst_array['video_title'],0,10).$dot;

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
			$output .='<div class="large_video">
                                   <div class="search_video_list "onclick="assignId('.$frst_array['video_id'].')">
                                   <img src="https://i.ytimg.com/vi/'. $frst_array['video_youtube_id'].'/sddefault.jpg">
                                   <div class="featured_video_sign"></div>
                                   <div class="details">   '; 
                                        $dot ='......';
                                        $desc= substr($frst_array['video_desc'],0,20);
                                        if(strlen($frst_array['video_desc'])>20)
                                        {
                                        $desc= substr($frst_array['video_desc'],0,20).$dot;

                                        }

                                        $title = substr($frst_array['video_title'],0,10);
                                        if(strlen($frst_array['video_title'])>10)
                                        {
                                        $title= substr($frst_array['video_title'],0,10).$dot;

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
                                                  <div class="search_video_list "onclick="assignId('.$frst_array['video_id'].')">
                                                   <img src="https://i.ytimg.com/vi/'. $frst_array['video_youtube_id'].'/sddefault.jpg">
                                                   <div class="vdetails">  '; 
                                                        $dot ='......';
                                                        $desc= substr($frst_array['video_desc'],0,20);
                                                        if(strlen($frst_array['video_desc'])>20)
                                                        {
                                                        $desc= substr($frst_array['video_desc'],0,20).$dot;

                                                        }

                                                        $title = substr($frst_array['video_title'],0,10);
                                                        if(strlen($frst_array['video_title'])>10)
                                                        {
                                                        $title= substr($frst_array['video_title'],0,10).$dot;

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
                                           <div class="search_video_list "onclick="assignId('.$frst_array['video_id'].')">
                                            <img src="https://i.ytimg.com/vi/'. $frst_array['video_youtube_id'].'/sddefault.jpg">
                                             <div class="vdetails">  '; 
                                                        $dot ='......';
                                                        $desc= substr($frst_array['video_desc'],0,20);
                                                        if(strlen($frst_array['video_desc'])>20)
                                                        {
                                                        $desc= substr($frst_array['video_desc'],0,20).$dot;

                                                        }

                                                        $title = substr($frst_array['video_title'],0,10);
                                                        if(strlen($frst_array['video_title'])>10)
                                                        {
                                                        $title= substr($frst_array['video_title'],0,10).$dot;

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
     public function count_based_listing()
     {
        $featured_limit = 4;
        $normal_limit   = 16;
        $offset         = 0;
        $count_type       = $_POST['count_type'];
        $featured_videos_array = array();
        $normal_videos_array = array();
       
        $featured_videos_array  = $this->M_Home->getFeaturedVideosBasedOnVideoCount($count_type,$featured_limit,$offset);

        $normal_videos_array    = $this->M_Home->getNormalVideosBasedOnVideoCount($count_type,$normal_limit,$offset);
                 
        if(count($featured_videos_array)== 4 && count($normal_videos_array)== 16 )
        {
            $featured_videos_array =  $featured_videos_array;
            $normal_videos_array  =  $normal_videos_array ;
        }
        elseif(count($featured_videos_array)==0)
        {
            $normal_videos_array    = $this->M_Home->getNormalVideosBasedOnVideoCount($count_type,20,$offset);
        }
        elseif(count($featured_videos_array)==1)
        {
            $normal_videos_array    = $this->M_Home->getNormalVideosBasedOnVideoCount($count_type,16,$offset);
        }
        elseif(count($normal_videos_array)== 0)
        {
            $featured_videos_array  = $this->M_Home->getFeaturedVideosBasedOnVideoCount($count_type,8,$offset);
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
                  
                    
			$output .= '<div class="large_video">
                                    <div class="search_video_list "onclick="assignId('.$frst_array['video_id'].')">
                                    <img src="https://i.ytimg.com/vi/'. $frst_array['video_youtube_id'].'/sddefault.jpg">
                                     <div class="featured_video_sign"></div>
                                     <div class="details">   ';                          
                                                    
                                                    $dot ='......';
                                                    $desc= substr($frst_array['video_desc'],0,20);
                                                    if(strlen($frst_array['video_desc'])>20)
                                                    {
                                                    $desc= substr($frst_array['video_desc'],0,20).$dot;

                                                    }

                                                    $title = substr($frst_array['video_title'],0,10);
                                                    if(strlen($frst_array['video_title'])>10)
                                                    {
                                                    $title= substr($frst_array['video_title'],0,10).$dot;

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
                                                    <div class="search_video_list "onclick="assignId('.$frst_array['video_id'].')">
                                                    <img src="https://i.ytimg.com/vi/'. $frst_array['video_youtube_id'].'/sddefault.jpg">
                                                    <div class="vdetails">  '; 
                                                        $dot ='......';
                                                        $desc= substr($frst_array['video_desc'],0,20);
                                                        if(strlen($frst_array['video_desc'])>20)
                                                        {
                                                        $desc= substr($frst_array['video_desc'],0,20).$dot;

                                                        }

                                                        $title = substr($frst_array['video_title'],0,10);
                                                        if(strlen($frst_array['video_title'])>10)
                                                        {
                                                        $title= substr($frst_array['video_title'],0,10).$dot;

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
                                                            <div class="search_video_list "onclick="assignId('.$frst_array['video_id'].')">
                                                            <img src="https://i.ytimg.com/vi/'. $frst_array['video_youtube_id'].'/sddefault.jpg">
                                                            <div class="vdetails">  '; 
                                                                $dot ='......';
                                                                $desc= substr($frst_array['video_desc'],0,20);
                                                                if(strlen($frst_array['video_desc'])>20)
                                                                {
                                                                $desc= substr($frst_array['video_desc'],0,20).$dot;

                                                                }

                                                                $title = substr($frst_array['video_title'],0,10);
                                                                if(strlen($frst_array['video_title'])>10)
                                                                {
                                                                $title= substr($frst_array['video_title'],0,10).$dot;

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
			$output .='<div class="large_video">
                                   <div class="search_video_list "onclick="assignId('.$frst_array['video_id'].')">
                                   <img src="https://i.ytimg.com/vi/'. $frst_array['video_youtube_id'].'/sddefault.jpg">
                                   <div class="featured_video_sign"></div>
                                   <div class="details">   '; 
                                        $dot ='......';
                                        $desc= substr($frst_array['video_desc'],0,20);
                                        if(strlen($frst_array['video_desc'])>20)
                                        {
                                        $desc= substr($frst_array['video_desc'],0,20).$dot;

                                        }

                                        $title = substr($frst_array['video_title'],0,10);
                                        if(strlen($frst_array['video_title'])>10)
                                        {
                                        $title= substr($frst_array['video_title'],0,10).$dot;

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
                                                  <div class="search_video_list "onclick="assignId('.$frst_array['video_id'].')">
                                                   <img src="https://i.ytimg.com/vi/'. $frst_array['video_youtube_id'].'/sddefault.jpg">
                                                   <div class="vdetails">  '; 
                                                        $dot ='......';
                                                        $desc= substr($frst_array['video_desc'],0,20);
                                                        if(strlen($frst_array['video_desc'])>20)
                                                        {
                                                        $desc= substr($frst_array['video_desc'],0,20).$dot;

                                                        }

                                                        $title = substr($frst_array['video_title'],0,10);
                                                        if(strlen($frst_array['video_title'])>10)
                                                        {
                                                        $title= substr($frst_array['video_title'],0,10).$dot;

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
                                           <div class="search_video_list "onclick="assignId('.$frst_array['video_id'].')">
                                            <img src="https://i.ytimg.com/vi/'. $frst_array['video_youtube_id'].'/sddefault.jpg">
                                             <div class="vdetails">  '; 
                                                        $dot ='......';
                                                        $desc= substr($frst_array['video_desc'],0,20);
                                                        if(strlen($frst_array['video_desc'])>20)
                                                        {
                                                        $desc= substr($frst_array['video_desc'],0,20).$dot;

                                                        }

                                                        $title = substr($frst_array['video_title'],0,10);
                                                        if(strlen($frst_array['video_title'])>10)
                                                        {
                                                        $title= substr($frst_array['video_title'],0,10).$dot;

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
    public function list_test()
    {
        $this->load->view('videotest/list_menu.html'); 
    }
}
    