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

class Termsofservice extends CI_Controller {
    
    function __construct() {
        parent::__construct();
       
        $this->lang->load('pages');
        $this->lang->load('common');
                
    }
    
    
    public function index()
    {
        $data = array();
        $data['header'] = $this->load->view('v_header',$data, true);       
        $data['footer'] = $this->load->view('v_footer',$data, true); 
             
 
        $this->load->view('pages/v_terms_and_conditions',$data); 
    }
}

/* End of file pages.php */
/* Location: ./application/controllers/pages.php */