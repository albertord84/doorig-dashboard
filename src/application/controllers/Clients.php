<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use business\Client;

class Clients extends CI_Controller {

    function __construct() {
        parent::__construct();

        require_once config_item('business-client-class');
    }

    public function get_lateral_menu() {
        $client_id = $this->input->post()["client_id"];
        $Client = new Client($client_id);
        $Client->load_doorig_info();
        $param['email'] = $Client->DoorigInfo->Email;
        
        $lateral_menu = $this->load->view('lateral_menu', $param, TRUE);
        print_r($lateral_menu);
    }
    
    public function get_modals() {
        $modals = $this->load->view("modals", "", TRUE);
        print_r($modals);
    }

    public function index() {

        var_dump("Thanks God!");

        $Client = new Client();
        $Client->load_data(1);
        $Client->load_modules(TRUE);

        var_dump($Client->ClientModules);
    }

}
?>

