<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//class for configuration handling
class Configuration extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper(array('form'));
        $this->load->library('form_validation');
        $this->lang->load('common');
        $this->lang->load('config');
        $this->load->model('M_Configuration', '', TRUE);
        $this->userid    = $this->session->userdata('kms_ad_id');
        $this->user_role = $this->session->userdata('kms_ad_role');      
        $this->language  = $this->config->item('language');
             
    }
   
    
     //   configuration add  action       
    public function index()
    {
       
        $data = array();   
        $data['header'] = $this->load->view('v_header',$data, true);
        $data['menu']   = $this->load->view('v_leftmenu',$data, true);
        $data['footer'] = $this->load->view('v_footer',$data, true);        
        $youtubeClientIdAry    = $this->M_Configuration->getConfigurationDetails('youtube_clientId');
        $youtubeClientSecretAry    = $this->M_Configuration->getConfigurationDetails('youtube_clientSecret');
        $youtubeRefreshTokenAry    = $this->M_Configuration->getConfigurationDetails('youtube_refreshToken');
        
   
        $data['youtubeClientId'] = $youtubeClientIdAry->configuration_data;  
        $data['youtubeClientSecret'] = $youtubeClientSecretAry->configuration_data;  
        $data['youtubeRefreshToken'] = $youtubeRefreshTokenAry->configuration_data;  

       
        if($this->input->post('submit'))
        {  
            $this->form_validation->set_rules('youtubeClientId',lang('youtubeClientId'), 'trim|required|xss_clean');  
            $this->form_validation->set_rules('youtubeClientSecret',lang('youtubeClientSecret'), 'trim|required|xss_clean');  
            $this->form_validation->set_rules('youtubeRefreshToken',lang('youtubeRefreshToken'), 'trim|required|xss_clean');  

            $data['config_data']  = $this->input->post('config_data'); 
            if($this->form_validation->run() == FALSE)
            {
                $this->load->view('configuration/v_configuration',$data);
                return false;
            }
            else 
            {
               
                $datas = array(
                        'config_data'   => strtolower($this->input->post('config_data')),                        
                        'language'     => $this->language

                       );
                $insertVal = array(
                    'youtube_clientId' => $this->input->post('youtubeClientId') ,
                    'youtube_clientSecret' => $this->input->post('youtubeClientSecret') ,
                    'youtube_refreshToken' => $this->input->post('youtubeRefreshToken') ,

                     );        

                $result =$this->M_Configuration->saveDetails($insertVal);
                if($result=='false')
                {
                   $this->session->set_flashdata('error', lang('insertn_err_msg'));
                   redirect('configuration');
                }
                else
                {
                   $this->session->set_flashdata('message',lang('insertn_sucss_msg'));
                   redirect('configuration');
                }
               
            }
        }
        $this->load->view('configuration/v_configuration',$data);
    }



    function saveRefreshToken($token)
    {
         $insertVal = array(
                                      'youtube_refreshToken' => $token ,

                     );   
        saveDetails($insertVal);
    }
    
    //    End of configuration add  action
    
    
    
}
