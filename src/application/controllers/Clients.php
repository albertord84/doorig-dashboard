<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use business\Client;

class Clients extends CI_Controller {

    function __construct() {
        parent::__construct();

        require_once config_item('business-client-class');
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

