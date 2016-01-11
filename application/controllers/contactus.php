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

class Contactus extends CI_Controller {
    
    function __construct() {
        parent::__construct();
       
        $this->lang->load('pages');
        $this->lang->load('common');
        $this->load->helper(array('form'));
        $this->load->library('form_validation');
        $this->load->model('M_Pages', '', TRUE);     
        
    }
    
    
    public function index()
    {
        $data = array();
        $data['header'] = $this->load->view('v_header',$data, true);       
        $data['footer'] = $this->load->view('v_footer',$data, true); 
        
        $this->form_validation->set_rules('contact_name',  lang('name'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('contact_email',  lang('email'), 'trim|required|xss_clean|valid_email');  
        $this->form_validation->set_rules('contact_message', lang('message'), 'trim|required|xss_clean'); 
        
        $data['contact_name']        = $this->input->post('contact_name');
        $data['contact_email']       = $this->input->post('contact_email');    
        $data['contact_message']     = $this->input->post('contact_message');
        
        if($this->form_validation->run() == FALSE)
            {
                
                $this->load->view('pages/v_contact',$data); 
                return false;
            }
            else 
            {
                $datas = array(
                    
                          'contact_name'     => $this->input->post('contact_name'),
                          'contact_email'    => $this->input->post('contact_email'),
                          'contact_message'  => $this->input->post('contact_message'),
                    
                         );
                 $result_videoid =$this->M_Pages->saveDetails($datas);
               
                if($result_videoid=='false')
                {
                    $this->session->set_flashdata('error', lang('failure_msg'));
                    redirect('contactus');
                }
                else 
                {
                    $this->session->set_flashdata('message', lang('succes_msg'));
                    redirect('contactus');
                }
            }
        $this->load->view('pages/v_contact',$data); 
    }
}

/* End of file pages.php */
/* Location: ./application/controllers/pages.php */