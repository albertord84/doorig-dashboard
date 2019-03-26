<?php

namespace business {

    require_once config_item('business-class');
    require_once config_item('business-client-modules-class');
    require_once config_item('business-client-status-class');
    require_once config_item('business-error-codes-class');

    class DashBoard extends Business {

        function __construct() {
            parent::__construct();

            require_once config_item('business-client-class');
            require_once config_item('business-client-module-class');
            require_once config_item('business-module-class');
            require_once config_item('business-response-class');
        }

        static function logout_all() {
            $ci = &get_instance();
            $ci->load->model('Modules_model');

            $modules = $ci->Modules_model->get_all();
            foreach ($modules as $key => $module) {
                
            }
        }

        static function logout() {
            $this->session->sess_destroy();
        }

    }

}

?>
