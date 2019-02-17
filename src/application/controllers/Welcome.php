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

class Welcome extends CI_Controller {    
        
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

    
    public function indextmp($client_id) {
                $Client = new Client();
                $Client->load_data_by_doorig_client_id($client_id);
                $Client->load_modules(TRUE);   
                var_dump($Client);
        
        
        $param["lateral_menu"] = $this->load->view('lateral_menu', '', true);
        $param["modals"] = $this->load->view('modals', '', true);
        $this->load->view('dashboard_view', $param);
    }
    
    public function index($login_token) {
        try {
            $url = $GLOBALS['sistem_config']->BASE_SITE_URL . "signin/dashboard_confirm_login_token";
            $GuzClient = new \GuzzleHttp\Client();
            $response = $GuzClient->post($url, [
                GuzzleHttp\RequestOptions::FORM_PARAMS => ['login_token' => $login_token]
            ]);

            $StatusCode = $response->getStatusCode();
            $content = $response->getBody()->getContents();
            $content = json_decode($content);
            if ($StatusCode == 200 && isset($content->code) && $content->code === 0) {
                // @TODO Alberto: Load contreted modules
                $Client = new Client();
                $Client->load_data_by_doorig_client_id($content->ClientId);
                $Client->load_modules(TRUE);

                $param["lateral_menu"] = $this->load->view('lateral_menu', '', true);
                $param["modals"] = $this->load->view('modals', '', true);
                $this->load->view('dashboard_view', $param);
            } else {
                header("Location:" . $GLOBALS['sistem_config']->BASE_SITE_URL);
            }
        } catch (Exception $exc) {
            header("Location:" . $GLOBALS['sistem_config']->BASE_SITE_URL);
            echo $exc->getMessage();
        }
        header("Location:" . $GLOBALS['sistem_config']->BASE_SITE_URL);
    }
    

    public function confirm_login($login_token) {
        # guzzle client define
        $client = new GuzzleHttp\Client();

        #This url define speific Target for guzzle
        $url = "http://" . $GLOBALS['sistem_config']->BASE_SITE_URL . "/index.php/signin/dashboard_confirm_login_token";

        #guzzle
        try {
            # guzzle post request example with form parameter
            $response = $client->request('POST',
                    $url,
                    ['form_params'
                        => ['login_token' => $login_token]
                    ]
            );
            #guzzle repose
            $json = $response->getBody();
            $data = json_decode($json);
            var_dump($data);
            if ($data->code == 0) {
                $param["lateral_menu"] = $this->load->view('lateral_menu');
                $this->load->view('dashboard_view', $param);
            }
        } catch (GuzzleHttp\Exception\BadResponseException $e) {
            #guzzle repose for future use
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            print_r($responseBodyAsString);
        }
    }

    public function message_view() {
        $param["lateral_menu"] = $this->load->view('lateral_menu', '', true);
        $param["modals"] = $this->load->view('modals', '', true);
        $this->load->view('message_view', $param);
    }

    public function message() {
        $this->is_ip_hacker();
        $this->load->model('class/system_config');
        $GLOBALS['sistem_config'] = $this->system_config->load();
        $this->load->library('Gmail');
        $language = $this->input->get();
        if (isset($language['language']))
            $param['language'] = $language['language'];
        else
            $param['language'] = $GLOBALS['sistem_config']->LANGUAGE;
        $param['SERVER_NAME'] = $GLOBALS['sistem_config']->SERVER_NAME;
        $GLOBALS['language'] = $param['language'];
        $datas = $this->input->post();
        $result = $this->gmail->send_client_contact_form($datas['name'], $datas['email'], $datas['message'], $datas['company'], $datas['telf']);
        if ($result['success']) {
            $result['message'] = $this->T('Mensagem enviada, agradecemos seu contato', array(), $GLOBALS['language']);
        }
        echo json_encode($result);
    }

    public function call_to_generate_access_token() {
        //esta funcion deve estar en todfos los módulos
        $datas = $this->input->post();


        try {
            $client_id = $this->session->userdata('client_id');


            $datas["module_id"] = 1;
            $client_id = 1;


            //1. llamar a la funcion generate_access_token que esta en el dasboard por Guzle
            $url = $GLOBALS['sistem_config']->DASHBOARD_SITE_URL . "/welcome/generate_access_token";
            $GuzClient = new \GuzzleHttp\Client();
            $response = $GuzClient->post($url, [
                GuzzleHttp\RequestOptions::JSON => ['client_id' => $client_id],
                GuzzleHttp\RequestOptions::JSON => ['module_id' => $datas["module_id"]]
            ]);

            $StatusCode = $response->getStatusCode();
            $content = $response->getBody()->getContents();
            $content = json_decode($content);
            if ($StatusCode == 200 && $content->code == 0) {
                //3. Response
                $Response = new ResponseLoginToken($content->LoginToken);
                return $Response->toJson();
            } else {
                header("Location:" . $GLOBALS['sistem_config']->BASE_SITE_URL);
            }
        } catch (Exception $exc) {
            Response::ResponseFAIL($exc->getMessage(), $exc->getCode())->toJson();
            return;
        }
    }

    public function generate_access_token() {
        //2. Save MD5 to validate login from dashboard
        $datas = $this->input->post();


        try {

            $datas["module_id"] = 5;
            $datas["client_id"] = 1;

            //1. Generate login token
            $key = $datas["client_id"] . $datas["module_id"] . time();
            $login_token = md5($key);

            //2. Get cliente & module data
            // @TODO Alberto: Load contreted modules
            $Client = new Client();
            $Client->load_data($datas["client_id"]);
            $Module = new Module();
            $Module->load_data($datas["module_id"]);

            //3. Update cliente modules with $login_token
            $ClientModule = new ClientModule($Client, $Module);
            $ClientModule->load_data();
            $ClientModule->update($ClientModule->Id, null, null, null, null, null, $login_token);

            //4. retornar el access_token
            $Response = new ResponseLoginToken($login_token);
            return $Response->toJson();
        } catch (Exception $exc) {
            Response::ResponseFAIL($exc->getMessage(), $exc->getCode())->toJson();
            return;
        }
    }

    public function confirm_access_token() {
        //2. Save MD5 to validate login from dashboard
        $datas = $this->input->post();


        try {

            $datas["login_token"] = "a1fe9db8763995f8ef18377c78c63ddb";
            $datas["client_id"] = 1;
            $datas["module_id"] = 5;

            //1. Get cliente & module data
            // @TODO Alberto: Load contreted modules
            $Client = new Client();
            $Client->load_data($datas["client_id"]);
            $Module = new Module();
            $Module->load_data($datas["module_id"]);

            //2. Load Client module with data
            $ClientModule = new ClientModule($Client, $Module);
            $ClientModule->load_data();

            //3. Check Login Token
            if ($ClientModule->Login_token == $datas["login_token"]) {
                //4. Remove login_token from DB
//                $ClientModule->update($ClientModule->Id, NULL, NULL, NULL, NULL, NULL, "ok");
                //5. retornar Ok y el objeto modulo
                $Response = new ResponseClientModule($ClientModule);
                return $Response->toJson();
            } else {
                header("Location:" . $GLOBALS['sistem_config']->BASE_SITE_URL);
            }
        } catch (Exception $exc) {
            Response::ResponseFAIL($exc->getMessage(), $exc->getCode())->toJson();
            return;
        }
    }

}
