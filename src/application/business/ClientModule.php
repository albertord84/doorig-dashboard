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
        private $Client; // Client Reference
        private $Module; // Module Reference
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

//            $this->CI->load->model("Clients_model");
//            $this->CI->load->model("Modules_model");
            $this->CI->load->model("Clients_modules_model");
            $this->CI->Clients_modules_model->set_client_id($client->Id);

            $this->Client = $client;
            $this->Module = $module;
        }

        /**
         * 
         * @throws Exception
         */
        public function load_data() {
            $data = $this->CI->Clients_modules_model->get_by_module_id($this->Module->Id);
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

        public function update($id, $client_id = NULL, $module_id = NULL, $active = NULL, $init_date = NULL, $end_date = NULL, $login_token = NULL) {
            $client_module_id = $this->CI->Clients_modules_model->update($id, $client_id, $module_id, $active, $init_date, $end_date, $login_token);
            $this->load_data($client_module_id);
            return $client_module_id;
        }

    }

}
?>