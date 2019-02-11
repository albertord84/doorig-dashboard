<?php

ini_set('xdebug.var_display_max_depth', 256);
ini_set('xdebug.var_display_max_children', 256);
ini_set('xdebug.var_display_max_data', 1024);

use business\Response\Response;
use business\Client;

class Welcome extends CI_Controller {

    public function index() {
        $param["lateral_menu"] = $this->load->view('lateral_menu');
        $this->load->view('dashboard_view', $param);
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
        $param["lateral_menu"] = $this->load->view('lateral_menu');
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

}
