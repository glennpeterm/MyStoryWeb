<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('featured_videos'))
{
    function featured_videos()
    {
	$ci = &get_instance();
	$ci->load->model('M_Videos');        
	return $ci->M_Videos->featuredVideos();        
    }   
}
if ( ! function_exists('recentStories'))
{
     
function recentStories()
    {
        $ci = &get_instance();
	$ci->load->model('M_Videos');        
	return $ci->M_Videos->recentStories();  
    }
}

