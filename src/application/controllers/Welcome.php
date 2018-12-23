<?php

ini_set('xdebug.var_display_max_depth', 256);
ini_set('xdebug.var_display_max_children', 256);
ini_set('xdebug.var_display_max_data', 1024);

class Welcome extends CI_Controller {


    
    public function index() {
//        $this->is_ip_hacker();
//        $language = $this->input->get();
//        $this->load->model('class/system_config');
//        $GLOBALS['sistem_config'] = $this->system_config->load();
//        if (isset($language['language']))
//            $param['language'] = $language['language'];
//        else
//            $param['language'] = $GLOBALS['sistem_config']->LANGUAGE;
//        $param['SERVER_NAME'] = $GLOBALS['sistem_config']->SERVER_NAME;
//        $param['SCRIPT_VERSION'] = $GLOBALS['sistem_config']->SCRIPT_VERSION;
//        $GLOBALS['language'] = $param['language'];
        $this->load->view('home', $param);
    }
    
    public function login_view() {
        $this->load->view('login');
    }
    
    public function signin_view() {
        $this->load->view('signin');
    }
    
    public function pass_reset() {
        $this->load->view('pass-reset');
    }
    
    public function faqs_view() {
        $this->load->view('faq');
    }
    
}
