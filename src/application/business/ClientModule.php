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

            $this->CI->load->model("Clients_model");
            $this->CI->load->model("Modules_model");

            $this->Client = $client;
            $this->Module = $module;
        }

        /**
         * 
         * @throws Exception
         */
        public function load_data() {
            $data = $this->CI->Nodes_model->get_by_client_module_id($this->Client->Id, $this->Module->Id);
            if ($data == null) {
                throw ErrorCodes::getException(ErrorCodes::CLIENT_DATA_NOT_FOUND);
            }
            $this->fill_data($data);
        }

        public function fill_data(\stdClass $data = NULL) {
            if ($data) {
                $this->Active = $data->active;
                $this->Init_date = $data->init_date;
                $this->End_date = $data->end_date;
                $this->Login_token = $data->login_token;
            } else {
                //throw ErrorCodes::getException(ErrorCodes::CLIENT_DATA_NOT_FOUND);
            }
        }

    }

}
?>