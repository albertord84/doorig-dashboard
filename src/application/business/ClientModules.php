<?php

namespace business {

    require_once config_item('business-class');
    require_once config_item('business-client-class');
    require_once config_item('business-loader-class');
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
    class ClientModules extends Loader {

        public $Modules;
        private $Client; // Client Reference

        const dashboard = 0;
        const visibility = 1;
        const post_stories = 2;
        const directs = 3;
        const leads = 4;
        const statistic = 5;

        /**
         * 
         * @todo Class constructor.
         * 
         */
        function __construct(Client &$client) {
            parent::__construct();

            $CI = &get_instance();
            $CI->load->model("Clients_modules_model");
            $CI->Clients_modules_model->set_client_id($client->Id);

            $this->Client = $client;
            $this->Modules = array();
        }

        /**
         * 
         * @throws Exception
         */
        public function load_data(int $active = 1) {
            $CI = &get_instance();
            $data = $CI->Clients_modules_model->get_all($active);

            $this->fill_data($data);
        }

        protected function fill_data($modules = NULL) {
            if (count($modules)) {
                foreach ($modules as $key => $client_module) {
                    $Module = new Module();
                    $Module->load_data($client_module->module_id);
                    $this->Modules[$Module->Name] = new ClientModule($this->Client, $Module);
                    $this->Modules[$Module->Name]->fill_data($client_module);
                    //$this->Modules[$key] = new ClientModule($this->Client, $Module);
                    //$this->Modules[$key]->fill_data($module);
                }
            } else {
                //throw ErrorCodes::getException(ErrorCodes::CLIENT_DATA_NOT_FOUND);
            }
        }

        /**
         *  
         */
        public function remove_item(int $client_module_id) {
            try {
                $end_date = $end_date ? $end_date : time();
                $key = $this->hasModule($client_module_id);
                if ($key) {
                    $this->Modules[$key]->update($key, NULL, NULL, $active = FALSE, $start_date = NULL, $end_date);
                    unset($this->Modules[$key]);
                }
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            }
        }

        public function add_item(int $module_id, bool $active = TRUE, string $init_date = NULL, string $end_date = NULL) {
            try {
                if ($this->hasStatus($client_module_id))
                    return;
                $init_date = $init_date ? $init_date : (string) time();

                $Module = new Module();
                $Module->load_data($module_id);

                $client_module_item = new ClientModule($this->Client, $Module);
                $client_module_item_id = $client_module_item->save($this->Client->Id, $client_module_id, $active, $init_date, $end_date);
                $client_module_item->load_data_by_id($$client_module_item_id);

                $this->Modules[$$client_module_item_id] = $client_module_item;
                return $$client_module_item_id;
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            }
        }

        public function hasModule(int $module_id, int $active = 1) {
            $Module = new Module();
            $client_module_item = new ClientModule($this->Client, $Module);
            foreach ($this->Modules as $key => $client_module_item) {
                if ($client_module_item->Module->Id == $module_id)
                    return $key;
            }
            return FALSE;
        }

    }

}
?>