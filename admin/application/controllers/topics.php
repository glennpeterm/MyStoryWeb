<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//class for Topics handling
class Topics extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper(array('form'));
        $this->load->library('form_validation');
        $this->lang->load('common');
        $this->lang->load('topics');
        $this->load->model('M_Topics', '', TRUE);
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
        
        $data['topics']= $this->M_Topics->getAllTopics($this->language,$this->user_role);
        $this->load->view('topics/v_topics_list',$data);
    }
    //    End of Topics listing  action
    
     //    Topics add  action       
    public function add($id="")
    {
       
        $data = array();   
        $data['header'] = $this->load->view('v_header',$data, true);
        $data['menu']   = $this->load->view('v_leftmenu',$data, true);
        $data['footer'] = $this->load->view('v_footer',$data, true);
        
        if($id!='')
        {
            $this->id         = $id;
            $topic_details    = $this->M_Topics->getTopicDetails($id);

            if (!$topic_details)
            {
                $this->session->set_flashdata('error', lang('no_data_err_msg'));
                redirect('topics/add');
            }
             //set values to db values

            $topicLinkVal = str_replace('http://', '', $topic_details->topic_link);
            $topicLinkVal = str_replace('https://', '', $topicLinkVal);


            $data['id']             = $topic_details->topic_id;
            $data['topic_name'] 	= $topic_details->topic_name;
            $data['topic_title']    = $topic_details->topic_title;
            $data['topic_link']     = $topicLinkVal;
            $data['topic_status']	= $topic_details->topic_status; 
        }
        else 
        {
            $data['id']          = $id;
            $data['topic_name']  = ''; 
            $data['topic_title'] = ''; 
            $data['topic_link']  = ''; 
        }
        
        
        if($this->input->post('submit'))
        {

            $this->form_validation->set_rules('topic_name', lang('topic_name'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('topic_title', lang('topic_title'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('topic_link', lang('topic_link'), 'trim|required|xss_clean');

            $data['topic_name']  = $this->input->post('topic_name'); 
            $data['topic_title'] = $this->input->post('topic_title'); 
            $data['topic_link']  = $this->input->post('topic_link'); 
            if($this->form_validation->run() == FALSE)
            {
                $this->load->view('topics/v_topics',$data);
                return false;
            }
            else 
            {
                if($this->input->post('status')== 1)
                {
                    $status = 'active';
                }
                else 
                {
                    $status = 'inactive';
                }
                $topicLink = $this->input->post('topic_link');
                if(strpos($this->input->post('topic_link'), "http") == 0)
                {
                    $topicLink = 'http://'.$this->input->post('topic_link');
                }

                $datas = array(
                        'id'           => $this->input->post('id'),                            
                        'topic_name'   => $this->input->post('topic_name'), 
                        'topic_title'  => $this->input->post('topic_title'), 
                        'topic_link'   => $topicLink, 
                        'topic_status' => $status, 
                        'language'     => $this->language

                       );
               $topicid =$this->input->post('id');
                $result_count = $this->M_Topics->topicAlreadyExist($this->input->post('topic_name'),$this->language,$this->user_role,$this->input->post('id'));
                if($result_count > 0)
                {
                     $this->session->set_flashdata('error', lang('data_exist_err_msg'));
                     redirect('topics/add/'.$topicid);
                }
                else
                {                
                    $result =$this->M_Topics->saveDetails($datas);
                    if($result=='false')
                    {
                       $this->session->set_flashdata('error', lang('insertn_err_msg'));
                       redirect('topics/add');
                    }
                    else
                    {
                       $this->session->set_flashdata('message', lang('insertn_sucss_msg'));
                       redirect('topics/index');
                    }
                }
            }
        }
        $this->load->view('topics/v_topics',$data);
    }
    
    //    End of Topics add  action
    
    //     Topics delete  action       
    public function delete($id)
    {       
        
        $id= $this->M_Topics->deleteTopics($id);
        $this->session->set_flashdata('message', lang('deltn_sucs_msg'));        
        redirect('topics/index');
        
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
            $data['topic_details']   = $this->M_Topics->getTopicDetails($id);
           
            if (!$data['topic_details'])
            {
                $this->session->set_flashdata('error', 'No Such Data In DataBase');
                redirect('topics/index');
            }
            $this->load->view('topics/v_topics_view',$data);
        }
    }
    
   //     End of Topics view  action    
    //  Ajax function for topic status changing
    public function setstatus()
    {  
        $res = $this->M_Topics->setStatus();
        if($res){
        
            echo 'success';exit;
        }
        echo 'failed';exit;
    }
    
    //  End of Ajax function for topic status changing
    
}
