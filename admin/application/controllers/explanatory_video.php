<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Explanatory_Video extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper(array('form'));
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('pagination');
        $this->lang->load('common');
        $this->lang->load('explanatory');
        $this->load->model('M_Explanatory_Video', '', TRUE);
        $this->userid    = $this->session->userdata('kms_ad_id');
        $this->user_role = $this->session->userdata('kms_ad_role');      
        $this->language  = $this->config->item('language');
             
    }
    
    public function index()
    {
        $data = array();
        $data['header'] = $this->load->view('v_header',$data, true);
        $data['menu']   = $this->load->view('v_leftmenu',$data, true);
        $data['footer'] = $this->load->view('v_footer',$data, true);
        
       $data['expln_videos']= $this->M_Explanatory_Video->getAllVideos($this->language,$this->user_role);
       $this->load->view('explanatory/v_explan_video_list',$data);
    }
     public function add($id="")
    {
        
        $data = array();
        
        
        $data['header'] = $this->load->view('v_header',$data, true);
        $data['menu']   = $this->load->view('v_leftmenu',$data, true);
        $data['footer'] = $this->load->view('v_footer',$data, true);
        
        if($id!='')
          {
                $this->id         = $id;
                $video_details    = $this->M_Explanatory_Video->getVideoDetails($id);
                if (!$video_details)
                {
                        $this->session->set_flashdata('error', 'No Such Data In DataBase');
                        redirect('explanatory_video/add');
                }
                 //set values to db values
                $data['id']             = $video_details->exvideo_id;
                $data['title']	        = $video_details->exvideo_title;
                $data['desc']           = $video_details->exvideo_desc;
                $data['embedcode']      = $video_details->exvideo_embed;
                $data['video_status']   = $video_details->exvideo_status;
                
          }
          else
          {
                $data['id']          = $id;
                $data['title']       = '';
                $data['desc']        = '';
                $data['embedcode']   = '';
          }
        
        
        if($this->input->post('submit'))
        {

            $this->form_validation->set_rules('embedcode', 'Embed Video Code', 'trim|required|xss_clean');  

            $data['embedcode']      = $this->input->post('embedcode');
            $data['title']          = $this->input->post('title');
            $data['desc']           = $this->input->post('desc');
            $data['id']             = $this->input->post('id');
            $data['video_status']   = $this->input->post('status');
              
            if($this->form_validation->run() == FALSE)
            {
               
                $this->load->view('explanatory/v_explan_video',$data);
                return false;
            }
            else 
            {
                $datas = array(
                        'id'           => $this->input->post('id'),                            
                        'title'        => $this->input->post('title'),
                        'desc'         => $this->input->post('desc'),
                        'embedcode'    => $this->input->post('embedcode'),
                        'video_status' => $this->input->post('status'),
                        'language'     => $this->language

                       );

                 $result_videoid =$this->M_Explanatory_Video->saveDetails($datas);
               // echo  $this->db->last_query();exit;
                if($result_videoid=='false')
                {
                    $this->session->set_flashdata('error', 'Entered data is not valid ');
                    redirect('explanatory_video/add');
                }
                else
                {
                    $this->session->set_flashdata('message', 'Record Added Succesfully');
                    redirect('explanatory_video/view/'.$result_videoid);
                }
            }
        }
       
        $this->load->view('explanatory/v_explan_video',$data);
    }
    
    public function delete($id)
    {       
        
        $id= $this->M_Explanatory_Video->deleteVideos($id);
        $this->session->set_flashdata('message', 'Record Deleted Succesfully');        
        redirect('explanatory_video/index');
        
    }
    
    public function view($id)
    { 
        $data = array();
        $data['header'] = $this->load->view('v_header',$data, true);
        $data['menu']   = $this->load->view('v_leftmenu',$data, true);
        $data['footer'] = $this->load->view('v_footer',$data, true);
        if($id!='')
        {
            $this->id         = $id;
            $data['video_details']   = $this->M_Explanatory_Video->getVideoDetails($id);
           
            if (!$data['video_details'])
            {
                    $this->session->set_flashdata('error', 'No Such Data In DataBase');
                    redirect('explanatory_video/index');
            }
            
            $this->load->view('explanatory/v_explan_video_view',$data);
        }
    }
    
    public function setstatus()
    {        
        $res = $this->M_Explanatory_Video->setStatus();
        if($res){
            echo 'success';exit;
        }
        echo 'failed';exit;
    }
    
    
   
    
}
