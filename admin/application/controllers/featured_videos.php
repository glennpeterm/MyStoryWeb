<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//Class for managing Banner Videos
class Featured_Videos extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->lang->load('common');
        $this->lang->load('video');        
        $this->load->model('M_Videos', '', TRUE);
        $this->userid    = $this->session->userdata('kms_ad_id');
        $this->user_role = $this->session->userdata('kms_ad_role');      
        $this->language  = $this->config->item('language');
        
    }
    
    // Banner video listing action
    public function index()
    {
        $data = array();
        $data['header'] = $this->load->view('v_header',$data, true);
        $data['menu']   = $this->load->view('v_leftmenu',$data, true);
        $data['footer'] = $this->load->view('v_footer',$data, true);
        
        $data['featured_video_details']  = $this->M_Videos->getAllFeaturedVideoDetails();
        $this->load->view('featured_videos/v_featured_video_list',$data);
    }
    // End of Banner video listing action
    
 
  
    
    
    //  Ajax function for Scripture video status changing
    public function set_featured_status()
    {        
        $res = $this->M_Videos->set_featured_status();
        if($res){
            echo 'success';exit;
        }
        echo 'failed';exit;
    }
    
    //  End of Ajax function for Scripture video status changing
  
   
   
  
   // End of Banner video share action
    
}
