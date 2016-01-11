<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//class for Topics handling
class hashtag extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper(array('form'));
        $this->load->library('form_validation');
        $this->lang->load('common');       
        $this->lang->load('hashtag');
        $this->load->model('M_Topics', '', TRUE);
        $this->load->model('M_Hashtag', '', TRUE);
        $this->userid    = $this->session->userdata('kms_ad_id');
        $this->user_role = $this->session->userdata('kms_ad_role');      
        $this->language  = $this->config->item('language');
             
    }
    //    Topics listing  action      
    public function index()
    {
        $data = array();
        $data['header'] = $this->load->view('v_header',$data, true);
        $data['menu']   = $this->load->view('v_leftmenu',$data, true);
        $data['footer'] = $this->load->view('v_footer',$data, true);
        
        $data['hashtags']= $this->M_Hashtag->getAllHashtags($this->language,$this->user_role);
        $this->load->view('hashtag/v_hashtag_list',$data);
    }
    //    End of Topics listing  action
    
     //    Topics add  action       
    public function add($id="")
    {
       //print_r($_POST);exit;
        $data = array();   
        $data['header'] = $this->load->view('v_header',$data, true);
        $data['menu']   = $this->load->view('v_leftmenu',$data, true);
        $data['footer'] = $this->load->view('v_footer',$data, true);
        
        if($id!='')
          {
                $this->id         = $id;
                $hashtag_details    = $this->M_Hashtag->getHashtagDetails($id);
                if (!$hashtag_details)
                {
                        $this->session->set_flashdata('error', lang('no_data_err_msg'));
                        redirect('hashtags/add');
                }
                 //set values to db values
                $data['id']             = $hashtag_details->hash_id;
                $data['hashtag_name']	= $hashtag_details->hash_name;  
          }
          else 
          {
              redirect('hashtag/index');           
          }
        
        
        if($this->input->post('submit'))
        {
            
            $this->form_validation->set_rules('hashtag_name', lang('hashtag_name'), 'trim|required|xss_clean');  

            $data['hashtag_name']  = $this->input->post('hashtag_name'); 
            if($this->form_validation->run() == FALSE)
            {
                
                $this->load->view('hashtag/v_hashtag',$data);
                return false;
            }
            else 
            {
               
                $datas = array(
                        'id'           => $this->input->post('id'),                            
                        'hashtag_name' => strtolower($this->input->post('hashtag_name')),                        
                        'language'     => $this->language

                       );
                $result_count = $this->M_Hashtag->hashtagAlreadyExist($this->input->post('hashtag_name'),$this->language,$this->user_role,$this->input->post('id'));
                if($result_count > 0)
                {
                     $this->session->set_flashdata('error', lang('data_exist_err_msg'));
                     redirect('hashtag/add');
                }
                else
                {                
                    $result =$this->M_Hashtag->saveDetails($datas);
                    if($result=='false')
                    {
                       $this->session->set_flashdata('error', lang('insertn_err_msg'));
                       redirect('hashtag/add');
                    }
                    else
                    {
                       $this->session->set_flashdata('message', lang('insertn_sucss_msg'));
                       redirect('hashtag/index');
                    }
                }
            }
        }
        $this->load->view('hashtag/v_hashtag',$data);
    }
    
    //    End of Topics add  action
    
    //     Topics delete  action       
    public function delete($id)
    {       
        
        $id= $this->M_Hashtag->deleteHashtag($id);
        $this->session->set_flashdata('message',lang('deltn_sucs_msg'));        
        redirect('hashtag/index');
        
    }
    //     End of Topics delete  action  
         
    //     Topics view  action      
    public function view($id)
    { 
        $data = array();
        $data['header'] = $this->load->view('v_header',$data, true);
        $data['menu']   = $this->load->view('v_leftmenu',$data, true);
        $data['footer'] = $this->load->view('v_footer',$data, true);
        if($id!='')
        {
            $this->id         = $id;
            $data['hashtag_details']   = $this->M_Hashtag->getHashtagDetails($id);
           
           
            if (!$data['hashtag_details'])
            {
                $this->session->set_flashdata('error', lang('no_data_err_msg'));
                redirect('hashtags/index');
            }
            $this->load->view('hashtag/v_hashtag_view',$data);
        }
    }
    
   //     End of Topics view  action    
    
}
