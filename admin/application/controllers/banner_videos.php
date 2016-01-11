<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//Class for managing Banner Videos
class Banner_Videos extends CI_Controller {
    
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
        
        $data['banner_video_details']  = $this->M_Videos->getAllBannerVideoDetails();
        $this->load->view('banner_videos/v_banner_video_list',$data);
    }
    // End of Banner video listing action
    
 
  
    
    
    //  Ajax function for Scripture video status changing
    public function set_banner_status()
    {        
        $res = $this->M_Videos->set_banner_status();
        if($res){
            echo 'success';exit;
        }
        echo 'failed';exit;
    }
    
    //  End of Ajax function for Scripture video status changing
  
   
   
  
   // End of Banner video share action
    
}
