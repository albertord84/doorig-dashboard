<?php

namespace business {

    require_once config_item('business-class');
    require_once config_item('business-client-class');
    require_once config_item('business-module-class');
    require_once config_item('business-client-module-class');
    require_once config_item('business-error-codes-class');

    /**
     * @category Business class
     * 
     * @access public
     *
     * @todo Define an Client business class.
     * 
     */
    class ClientModules extends Business {

        public $Modules;
        private $Client; // Client Reference

        /**
         * 
         * @todo Class constructor.
         * 
         */
        function __construct(Client &$client) {
            parent::__construct();

            $this->CI->load->model("Clients_modules_model");

            $this->Client = $client;
            $this->Modules = array();
        }

        /**
         * 
         * @throws Exception
         */
        public function load_data(int $active) {
            $data = $this->CI->Clients_modules_model->get_all($this->Client->Id);

            $this->fill_data($data);
        }

        private function fill_data(array $modules = NULL) {
            if (count($modules)) {
                foreach ($modules as $key => $module) {
                    $Module = new Module();
                    $Module->load_data($module->id);
                    $this->Modules[$key] = new ClientModule($this->Client, $Module);
                    $this->Modules[$key]->fill_data($module);
                }
            } else {
                //throw ErrorCodes::getException(ErrorCodes::CLIENT_DATA_NOT_FOUND);
            }
        }

    }

}
?>