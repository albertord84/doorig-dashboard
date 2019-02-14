<?php

ini_set('xdebug.var_display_max_depth', 256);
ini_set('xdebug.var_display_max_children', 256);
ini_set('xdebug.var_display_max_data', 1024);

use business\Response\Response;
use business\Client;

class Welcome extends CI_Controller {

    public function index($login_token) {
        $param["lateral_menu"] = $this->load->view('lateral_menu');
        $param["modals"] = $this->load->view('modals', '', true);
        $this->load->view('dashboard_view', $param);
    }
    
    public function index4($login_token) {
        try {
            $url = $GLOBALS['sistem_config']->BASE_SITE_URL . "index.php/signin/dashboard_confirm_login_token";
            $GuzClient = new \GuzzleHttp\Client();
            $response = $GuzClient->post($url, [
                GuzzleHttp\RequestOptions::JSON => ['login_token' => $login_token]
            ]);
            
            $StatusCode = $response->getStatusCode();
            $content = $response->getBody()->getContents();
            if ($StatusCode == 200 && $content->code == 0) {
                // @TODO Alberto: Load contreted modules
                
                
                $param["lateral_menu"] = $this->load->view('lateral_menu');
                $this->load->view('dashboard_view', $param);
            } else {
                header("Location:" . $GLOBALS['sistem_config']->BASE_SITE_URL);
            }
        } catch (\Exception $exc) {
            header("Location:" . $GLOBALS['sistem_config']->BASE_SITE_URL);
            //echo $exc->getTraceAsString();
        }
        header("Location:" . $GLOBALS['sistem_config']->BASE_SITE_URL);
    }

    public function message_view() {
        $param["lateral_menu"] = $this->load->view('lateral_menu');
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
        try {
            $client_id = $this->session->userdata('client_id');

            //llamar a la funcion generate_access_token que esta en el dasboard por Guzle

            
        } catch (Exception $exc) {
            Response::ResponseFAIL($exc->getMessage(), $exc->getCode())->toJson();
            return;
        }

        $Response = new ResponseLoginToken($login_token, $Client->Node->URL);
        return $Response->toJson();
    }
    
  
    public function generate_access_token() {
        //1. Generate MD5 redirection token
        $key = $Client->Id . time();
        $login_token = md5($key);

        //2. Save MD5 to validate login from dashboard
        
        //3. retornar el access_token y el status del modulo StatusModule

    }

}
