<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('unreadmailcount'))
{
    function unreadmailcount($var = '')
    {
	$ci = &get_instance();
	$ci->load->model('M_Inbox');        
	return $ci->M_Inbox->countAllUnreadMessages();
        
    }   
}

if ( ! function_exists('isLogin'))
{
    function isLogin($var = '')
    {
	$ci = &get_instance();
	$userid = $ci->session->userdata('kms_ad_id');       
	if($userid=='')
        {		
           redirect($ci->config->item('base_url'));
         }
	        
    }   
}
if ( ! function_exists('selfiesCount'))
{
    function selfiesCount($var = '')
    {
	$ci = &get_instance();
	$ci->load->model('M_Videos');        
	return $ci->M_Videos->newSelfievideos();
	        
    }   
}