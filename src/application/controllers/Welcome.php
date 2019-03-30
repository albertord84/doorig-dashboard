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

    //PRIMARY FUNCTIONS----------------------------------------------------------
    public function aaa() {
//        $Client = unserialize($this->session->userdata('client'));
//        var_dump($Client);
        var_dump($GLOBALS['sistem_config']);
        //$this->session->sess_destroy();
    }

    public function index($login_token = NULL) {
        try {
            $Client = NULL;
            if ($login_token) {
                //$this->session->sess_regenerate(TRUE);
                $this->session->set_userdata('client', NULL);
                $url = $GLOBALS['sistem_config']->BASE_SITE_URL . "signin/dashboard_confirm_login_token";
                $GuzClient = new \GuzzleHttp\Client(['verify' => false]);
                $response = $GuzClient->post($url, [
                    GuzzleHttp\RequestOptions::FORM_PARAMS => ['login_token' => $login_token]
                ]);
                $StatusCode = $response->getStatusCode();
                $content = $response->getBody()->getContents();
                $content = json_decode($content);
                if ($StatusCode == 200 && isset($content->code) && $content->code === 0) {
                    $Client = new Client();
                    $client_id = $content->ClientId;
                    if ($content->NewClient)
                        $Client->insert_new_doorig_client($content->ClientId);
                    $Client->load_data($client_id);
                    $Client->load_modules(TRUE);

                    // Load DOORIG INFO
                    @$Client->load_doorig_info();

                    $this->session->set_userdata('client', serialize($Client));
                }
            } else if ($this->session->userdata('client')) {
                $Client = unserialize($this->session->userdata('client'));
            }
            if ($Client) {
                $a=json_encode(object_to_array($Client));
                $param["client"] = json_encode(object_to_array($Client));
                $param["lateral_menu"] = $this->request_lateral_menu($Client->Id);
                $param["modals"] = $this->request_modals();
                $param['SCRIPT_VERSION'] = $GLOBALS['sistem_config']->SCRIPT_VERSION;
                $this->load->view('dashboard_view', $param);
            } else {
                header("Location:" . $GLOBALS['sistem_config']->BASE_SITE_URL);
            }
        } catch (Exception $exc) {
//            header("Location:" . $GLOBALS['sistem_config']->BASE_SITE_URL);
            echo $exc->getMessage();
        }
    }

    public function logout_all() {

        $Client = new Client(0);
        $Client = unserialize($this->session->userdata('client'));
        if ($Client instanceof Client && !$Client->ClientModules) {
            $Client->ClientModules = new \business\ClientModules($Client);
        }
        if ($Client)
            $Client->logout_all();

        header('Location: ' . $GLOBALS['sistem_config']->BASE_SITE_URL);
    }

    public function log_out() {
        //$this->user_model->insert_washdog($this->session->userdata('id'), 'CLOSING SESSION');
        $this->session->set_userdata('client_module', NULL);
        $this->session->set_userdata('client', NULL);
        $this->session->sess_destroy();
        
        header('Location: ' . $GLOBALS['sistem_config']->BASE_SITE_URL);
    }

    public function message_view() {
        $Client = unserialize($this->session->userdata('client'));
        $param["client_datas"] = json_encode($Client);
        $param["lateral_menu"] = $this->request_lateral_menu($Client->Id);
        $param["modals"] = $this->request_modals();
        $param['SCRIPT_VERSION'] = $GLOBALS['sistem_config']->SCRIPT_VERSION;
        $this->load->view('message_view', $param);
    }

    public function contact_us() {
        //@TODO: hacer esto funcionar
        $datas = $this->input->post();
        $datas['contact_subject'];
        $datas['contact_message'];
        $Client = unserialize($this->session->userdata('client'));
        $Client->Id;
        try {
            Client::send_contact_us($datas["email"], $datas["username"], $datas["message"], $datas["company"], $datas["phone"]);
        } catch (\Exception $e) {
            return Response::ResponseFAIL($e->getMessage(), $e->getCode())->toJson();
        }
        Response::ResponseOK(T("Mensagem enviada com sucesso."))->toJson();
    }

    public function payment_view() {
        $Client = unserialize($this->session->userdata('client'));
        $param["client_id"] = $Client->DoorigInfo->Id;
        $param["email"] = $Client->DoorigInfo->Email;
        $param["lateral_menu"] = $this->request_lateral_menu($Client->Id);
        $param["modals"] = $this->request_modals();
        $param['SCRIPT_VERSION'] = $GLOBALS['sistem_config']->SCRIPT_VERSION;
        $this->load->view('payment_view', $param);
    }

    public function sumarize_view() {
        //$param["client_datas"] = json_encode(unserialize($this->session->userdata('client_datas')));
        $param["lateral_menu"] = $this->load->view('lateral_menu', '', true);
        $param["modals"] = $this->load->view('modals', '', true);
        $param['SCRIPT_VERSION'] = $GLOBALS['sistem_config']->SCRIPT_VERSION;
        $this->load->view('message_view', $param);
    }

    //SECONDARY FUNCTIONS----------------------------------------------------------
    public function internal_index($login_token) {
        try {
            $url = $GLOBALS['sistem_config']->BASE_SITE_URL . "signin/dashboard_confirm_login_token";
            $GuzClient = new \GuzzleHttp\Client(['verify' => false]);
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

                $this->session->set_userdata('client', serialize($Client));
                $param["client"] = $Client;
                $param["lateral_menu"] = $this->load->view('lateral_menu', '', true);
                $param["modals"] = $this->load->view('modals', '', true);
                $param['SCRIPT_VERSION'] = $GLOBALS['sistem_config']->SCRIPT_VERSION;
                $this->load->view('dashboard_view', $param);
            } else {
                var_dump($content);
//                header("Location:" . $GLOBALS['sistem_config']->BASE_SITE_URL);
            }
        } catch (Exception $exc) {
//            header("Location:" . $GLOBALS['sistem_config']->BASE_SITE_URL);
            echo $exc->getMessage();
        }
    }

    public function confirm_login($login_token) {
        # guzzle client define
        $client = new GuzzleHttp\Client(['verify' => false]);

        #This url define speific Target for guzzle
        $url = $GLOBALS['sistem_config']->BASE_SITE_URL . "/index.php/signin/dashboard_confirm_login_token";

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
                $param["lateral_menu"] = $this->load->view('lateral_menu', '', true);
                $param["modals"] = $this->load->view('modals', '', true);
                $param['SCRIPT_VERSION'] = $GLOBALS['sistem_config']->SCRIPT_VERSION;
                $this->load->view('dashboard_view', $param);
            }
        } catch (GuzzleHttp\Exception\BadResponseException $e) {
            #guzzle repose for future use
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            print_r($responseBodyAsString);
        }
    }

    public function call_to_generate_access_token() {
        //esta funcion deve estar en todfos los módulos
        $datas = $this->input->post();

        try {
            $client_id = unserialize($this->session->userdata('client'))->Id;
            //var_dump($this->session->userdata('client'));
//            $datas["final_module_id"] = 1;
//            $client_id = 1;
            //1. llamar a la funcion generate_access_token que esta en el dasboard por Guzle
            $url = $GLOBALS['sistem_config']->DASHBOARD_SITE_URL . "welcome/generate_access_token";
            $GuzClient = new \GuzzleHttp\Client(['verify' => false]);
            $response = $GuzClient->post($url, [
                GuzzleHttp\RequestOptions::FORM_PARAMS => [
                    'client_id' => $client_id,
                    'module_id' => $datas["module_id"]
            ]]);

            $StatusCode = $response->getStatusCode();
            $content = $response->getBody()->getContents();
            $content = json_decode($content);
            if ($StatusCode == 200 && $content->code == 0) {
                //3. Response
                $Response = new ResponseLoginToken($content->LoginToken, "", $client_id);
                return $Response->toJson();
            } else {
                var_dump($content);
//                header("Location:" . $GLOBALS['sistem_config']->BASE_SITE_URL);
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
            //$datas["module_id"] = 5;
            //$datas["client_id"] = 1;
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
            $ClientModule->set_login_token($login_token);

            //4. retornar el access_token
            $Response = new ResponseLoginToken($login_token, "", $Client->Id);
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
            if ($ClientModule->Login_token == $datas["access_token"]) {
                //4. Remove login_token from DB
                $ClientModule->update($ClientModule->Id, NULL, NULL, NULL, NULL, NULL, "ok");
                //5. retornar Ok y el objeto modulo
                $Response = new ResponseClientModule($ClientModule);
                return $Response->toJson();
            } else {
                Response::ResponseFAIL("Codigo de acesso não encontrado", -1)->toJson();
                return;
            }
        } catch (Exception $exc) {
            Response::ResponseFAIL($exc->getMessage(), $exc->getCode())->toJson();
            return;
        }
    }

    public function request_lateral_menu($client_id) {
        $GuzClient = new \GuzzleHttp\Client(['verify' => false]);
        $url = $GLOBALS["sistem_config"]->DASHBOARD_SITE_URL . "Clients/get_lateral_menu";
        $response = $GuzClient->post($url, [
            GuzzleHttp\RequestOptions::FORM_PARAMS => [
                'client_id' => $client_id
        ]]);
        $StatusCode = $response->getStatusCode();
        $content = $response->getBody()->getContents();
        if ($StatusCode == 200) {
            return $content;
        }
    }

    public function request_modals() {
        $GuzClient = new \GuzzleHttp\Client(['verify' => false]);
        $url = $GLOBALS["sistem_config"]->DASHBOARD_SITE_URL . "Clients/get_modals";
        $response = $GuzClient->get($url);
        $StatusCode = $response->getStatusCode();
        $content = $response->getBody()->getContents();
        if ($StatusCode == 200) {
            return $content;
        }
    }

}
