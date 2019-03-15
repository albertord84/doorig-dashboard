<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use business\Client;
use business\Module;
use business\ClientModule;
use business\Response\Response;

class Clients extends CI_Controller {

    function __construct() {
        parent::__construct();

        require_once config_item('business-client-class');
        require_once config_item('business-client-module-class');
        require_once config_item('business-module-class');
        require_once config_item('business-response-class');
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

    public function set_contrated_module() {
        //2. Save MD5 to validate login from dashboard
        $datas = $this->input->post();

        try {
            //$datas["module_id"] = 5;
            //$datas["client_id"] = 1;
            //2. Get cliente & module data
            $Client = new Client();
            $Client->load_data($datas["client_id"]);
            $Module = new Module();
            $Module->load_data($datas["module_id"]);

            //3. Update cliente modules with $login_token
            $ClientModule = new ClientModule($Client, $Module);
            $ClientModule->load_data();
            $ClientModule->setActive();

            //4. retornar el access_token
            return Response::ResponseOK()->toJson();
        } catch (Exception $exc) {
            Response::ResponseFAIL($exc->getMessage(), $exc->getCode())->toJson();
            return;
        }
    }

}
?>

