<?php

ini_set('xdebug.var_display_max_depth', 256);
ini_set('xdebug.var_display_max_children', 256);
ini_set('xdebug.var_display_max_data', 1024);

use business\Response\Response;
use business\Client;

class Welcome extends CI_Controller {

    public function index() {
        $this->load->view('dashboard', $param);
    }

    public function confirm_login($login_token) {
        try {
            $url = "http://" . $GLOBALS['sistem_config']->BASE_SITE_URL . "/index.php/signin/dashboard_confirm_login_token";
            $GuzClient = new \GuzzleHttp\Client();
            $response = $GuzClient->post($url, [
                GuzzleHttp\RequestOptions::JSON => ['login_token' => $login_token]
            ]);
        } catch (\Exception $exc) {
            echo $exc->getTraceAsString();
        }

        $StatusCode = $response->getStatusCode();
        if ($StatusCode == 200) {
            $this->load->view('dashboard', $param);
        }
    }

}
