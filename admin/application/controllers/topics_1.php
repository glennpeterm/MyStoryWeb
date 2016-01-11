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
        $this->userid    = $this->session->userdata('kms_ad_role');
        $this->user_role = $this->session->userdata('kms_ad_id');      
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
                        $this->session->set_flashdata('error', 'No Such Data In DataBase');
                        redirect('topics/add');
                }
                 //set values to db values
                $data['id']             = $topic_details->topic_id;
                $data['topic_name']	= $topic_details->topic_name;  
          }
          else 
          {
              $data['id']          = $id;
              $data['topic_name']  = '';             
          }
        
        
        if($this->input->post('submit'))
        {

            $this->form_validation->set_rules('topic_name', 'Topic Name', 'trim|required|xss_clean');  

            $data['topic_name']  = $this->input->post('topic_name'); 
            if($this->form_validation->run() == FALSE)
            {
                $this->load->view('topics/v_topics',$data);
                return false;
            }
            else 
            {
               
                $datas = array(
                        'id'           => $this->input->post('id'),                            
                        'topic_name'   => strtolower($this->input->post('topic_name')),                        
                        'language'     => $this->language

                       );
                $result_count = $this->M_Topics->topicAlreadyExist($this->input->post('topic_name'),$this->language,$this->user_role,$this->input->post('id'));
                if($result_count > 0)
                {
                     $this->session->set_flashdata('error', 'Topic Already Exist In DataBase');
                     redirect('topics/add');
                }
                else
                {                
                    $result =$this->M_Topics->saveDetails($datas);
                    if($result=='false')
                    {
                       $this->session->set_flashdata('error', 'Entered data is not valid ');
                       redirect('topics/add');
                    }
                    else
                    {
                       $this->session->set_flashdata('message', 'Record Added Succesfully');
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
        $this->session->set_flashdata('message', 'Record Deleted Succesfully');        
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
    
}
