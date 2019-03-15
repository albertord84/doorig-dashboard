<?php

namespace business {

    require_once config_item('business-class');
    require_once config_item('business-client-class');
    require_once config_item('business-module-class');
    require_once config_item('business-error-codes-class');

    /**
     * @category Business class
     * 
     * @access public
     *
     * @todo Define an Client business class.
     * 
     */
    class ClientModule extends Business {

        public $Id;
        public $Client; // Client Reference
        public $Module; // Module Reference
        public $Active;
        public $Init_date;
        public $End_date;
        public $Login_token;

        /**
         * 
         * @todo Class constructor.
         * 
         */
        function __construct(Client &$client, Module &$module) {
            parent::__construct();

            $CI = &get_instance();
//            $CI->load->model("Clients_model");
//            $CI->load->model("Modules_model");
            $CI->load->model("Clients_modules_model");
            $CI->Clients_modules_model->set_client_id($client->Id);

            $this->Client = $client;
            $this->Module = $module;
        }

        /**
         * 
         * @throws Exception
         */
        public function load_data() {
            $CI = &get_instance();
            $data = $CI->Clients_modules_model->get_by_module_id($this->Module->Id);
            if ($data == null) {
                throw ErrorCodes::getException(ErrorCodes::CLIENT_DATA_NOT_FOUND);
            }
            $this->fill_data($data);
        }

        public function fill_data(\stdClass $data = NULL) {
            if ($data) {
                $this->Id = $data->id;
                $this->Active = $data->active;
                $this->Init_date = $data->init_date;
                $this->End_date = $data->end_date;
                $this->Login_token = $data->login_token;
            } else {
                //throw ErrorCodes::getException(ErrorCodes::CLIENT_DATA_NOT_FOUND);
            }
        }

        public function set_login_token($login_token) {
            $CI = &get_instance();
            $CI->Clients_modules_model->update($this->Id, NULL, NULL, NULL, NULL, NULL, $login_token);
        }

        static public function update($id, $client_id = NULL, $module_id = NULL, $active = NULL, $init_date = NULL, $end_date = NULL, $login_token = NULL) {
            $CI = &get_instance();
            $CI->Clients_modules_model->update($id, $client_id, $module_id, $active, $init_date, $end_date, $login_token);
        }

        public function setActive(bool $active = TRUE) {
            $CI = &get_instance();
            $client_module_id = $CI->Clients_modules_model->update($this->Id, $client_id = NULL, $module_id = NULL, $active, $init_date = time(), $end_date = NULL, $login_token = NULL);
            $this->load_data($client_module_id);
            return $client_module_id;
        }

    }

}
?>