<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . 'libraries/google/src/Google/Client.php';

class Google extends Google_Client {
    function __construct($params = array()) {
        parent::__construct();
    }
} 
?>