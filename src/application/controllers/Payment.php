<?php

ini_set('xdebug.var_display_max_depth', 256);
ini_set('xdebug.var_display_max_children', 256);
ini_set('xdebug.var_display_max_data', 1024);

use business\Client;
use business\ClientModule;
use business\Module;
use business\Response\Response;
use business\Response\ResponseLoginToken;
use business\Response\ResponseClientModule;

class Payment extends CI_Controller {

    function __construct() {
        parent::__construct();
        require_once config_item('business-client-class');
        require_once config_item('business-client-modules-class');
        require_once config_item('business-client-module-class');
        require_once config_item('business-module-class');
        require_once config_item('business-response-class');
        require_once config_item('business-response-login-token-class');
        require_once config_item('business-response-client-module-class');
    }
    
    public function payment() {
        $Client_id = unserialize($this->session->userdata('client'))->Id;
        $datas = $this->input->post();
        
        $datas['cc-number'];
        $datas['cc-cvv'];
        $datas['cc-name'];
        $datas['cc-month'];
        $datas['cc-year'];
        $datas['cc-cpf'];
        $datas['promotional-code'];
        
        return Response::ResponseOK()->toJson();
    }
        
    

}
