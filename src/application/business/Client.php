<?php

namespace business {

    require_once config_item('business-class');
    require_once config_item('business-client-modules-class');
    require_once config_item('business-client-status-class');
    require_once config_item('business-error-codes-class');

    /**
     * @category Business class
     * 
     * @access public
     *
     * @todo Define an Client business class.
     * 
     */
    class Client extends Business {

        /**
         * 
         * @access public
         * @var type
         *  
         */
        public $Id;
        public $Pay_id;
        public $Login_token;
        public $ClientModules;
        public $DoorigInfo;             // Client DOORIG general information Class

        /**
         * 
         * @todo Class constructor.
         * 
         */
        function __construct(int $id = NULL) {
            parent::__construct();

            $this->Id = $id;

            $this->ClientModules = new ClientModules($this);

            $CI = &get_instance();
            $CI->load->model('Clients_model');
            $CI->load->model('Clients_modules_model');
        }

        /**
         * Get client data
         * @param int $client_id
         * @return DataSet  
         */
        public function load_data(int $id) {
            $CI = &get_instance();
            $data = $CI->Clients_model->get_by_id($id);
            if ($data == null) {
                throw ErrorCodes::getException(ErrorCodes::CLIENT_ID_NOT_FOUND);
            }

            $this->fill_data($data);
        }

        /**
         * Get client data
         * @param int $login_token
         * @return DataSet  
         */
        public function load_data_by_login_token(string $login_token) {
            $CI = &get_instance();
            $data = $CI->Clients_model->get_by_login_token($login_token);
            if ($data == null) {
                throw ErrorCodes::getException(ErrorCodes::VALIDATION_TOKEN_NOT_FOUND);
            }

            $this->fill_data($data);
        }

        /**
         * Get client data
         * @param int $login_token
         * @return DataSet  
         */
        public function load_data_by_doorig_client_id(int $client_id) {
            $CI = &get_instance();
            $data = $CI->Clients_model->get_by_doorig_client_id($client_id);
            if ($data == null) {
                throw ErrorCodes::getException(ErrorCodes::CLIENT_ID_NOT_FOUND);
            }

            $this->fill_data($data);
        }

        private function fill_data(\stdClass $data = NULL) {
            if ($data) {
                $this->Id = $data->id;
                $this->Pay_id = $data->pay_id;
                $this->Login_token = $data->login_token;
            } else {
//throw ErrorCodes::getException(ErrorCodes::CLIENT_DATA_NOT_FOUND);
            }
        }

        public function load_doorig_info(int $id = NULL) {
            try {
                $this->Id = $id ? $id : $this->Id;
                if ($this->Id) {
                    $url = $GLOBALS['sistem_config']->BASE_SITE_URL . 'welcome/get_doorig_info';

                    $GuzClient = new \GuzzleHttp\Client(['verify' => false]);
                    $response = $GuzClient->post($url, [
                        \GuzzleHttp\RequestOptions::FORM_PARAMS => ['client_id' => $this->Id]
                    ]);

                    $StatusCode = $response->getStatusCode();
                    $content = $response->getBody()->getContents();
                    $content = json_decode($content);
                    if ($StatusCode == 200 && isset($content->code) && $content->code == 0) {
                        $this->DoorigInfo = $content->array_object;
                    }
                } else {
                    throw new Exception("Missing client id!!!");
                }
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            }
        }

        /**
         * Get module data
         * @param int $active
         * @return DataSet  
         */
        public function load_modules(int $active) {
            $CI = &get_instance();
            $CI->Clients_modules_model->set_client_id($this->Id);
            $this->ClientModules->load_data($active);
        }

        public function insert_new_doorig_client(int $client_id) {
            if (!Client::exist($client_id)) {
                $client_id = $this->insert($client_id);

                $Module = new Module();
                $Client = new Client();
                $ClientModule = new ClientModule($Client, $Module);
                $ClientModule->save($client_id, Module::dashboard, TRUE);
                $ClientModule->save($client_id, Module::visibility, FALSE);
                $ClientModule->save($client_id, Module::directs, FALSE);
                $ClientModule->save($client_id, Module::post_stories, FALSE);
                $ClientModule->save($client_id, Module::statistic, FALSE);
                $ClientModule->save($client_id, Module::leads, FALSE);

                return $client_id;
            }
            return FALSE;
        }

        public function insert(int $id, int $pay_id = NULL, string $login_token = NULL) {
            if (Client::exist($id)) {
                throw ErrorCodes::getException(ErrorCodes::DATA_ALREADY_EXIST);
            }
            $CI = &get_instance();
            $client_id = $CI->Clients_model->save($id, $pay_id, $login_token);
            return $client_id;
        }

        public function update(int $id, int $pay_id = NULL, string $login_token = NULL) {
            $CI = &get_instance();
            $client_id = $CI->Clients_model->update($id, $pay_id, $login_token);
            return $client_id;
        }

//---------------SIGNIN FUNCTIONS-----------------------------

        /**
         * 
         * @return type
         */
        static function get_clients() {
            $CI = &get_instance();
            return $CI->Clients_model->get_all();
        }

        static function exist(int $id) {
            try {
                $Client = new Client($id);
                $Client->load_data($id);
                return TRUE;
            } catch (\Exception $exc) {
                //echo $exc->getTraceAsString();
            }

            return FALSE;
        }

        public function logout_all() {
            $ci = &get_instance();

            if (!$this->ClientModules->isLoaded()) {
                $this->ClientModules->load_data();
            }

            $ClientModule = new ClientModule();
            foreach ($this->ClientModules->Modules as $key => $ClientModule) {

                $this->logout_module($ClientModule);
                sleep(5);
            }
        }

        public function logout_module(ClientModule $ClientModule) {
            try {
                $url = $ClientModule->Module->Url . 'welcome/log_out';
                header('Location: ' . $url);
                //$GuzClient = new \GuzzleHttp\Client(['verify' => false]);
                //$response = $GuzClient->get($url);
                //$response = file_get_contents($url);

                //var_dump($response->getBody()->getContents());
                //var_dump($response);
            } catch (\Exception $exc) {
                //echo $exc->getTraceAsString();
            }
        }

    }

}
?>
