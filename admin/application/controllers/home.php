<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct(){
            
            parent::__construct();
            $this->lang->load('common');
            $this->lang->load('user');
            $this->load->model('m_home');
	}
    
	public function index()
	{
        
            $this->load->helper('url');
            $data = array();
            $data['header'] = $this->load->view('v_header',$data, true);
            $data['menu']   = $this->load->view('v_leftmenu',$data, true);
            $data['footer'] = $this->load->view('v_footer',$data, true);
            
            $data['selfies_status']   = $this->m_home->getSelfiesStatus();
            $data['users_count']      = $this->m_home->getRegisteredUsersCount();
            $data['userDataForGraph']   = $this->m_home->getUserDataForGraph();
            $data['selfieDataForGraph']   = $this->m_home->getSelfieDataForGraph();
            $data['selfies_rejected'] = 0;
            $this->load->view('v_home',$data);


	}

}


