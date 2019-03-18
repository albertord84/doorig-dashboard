<?php

namespace business {

    require_once config_item('business-class');
    require_once config_item('business-error-codes-class');

    /**
     * @category Business class
     * 
     * @access public
     *
     * @todo Define an Client business class.
     * 
     */
    class Module extends Business {

        const dashboard = 0; //Dashboard module'
        const visibility = 1; //Visibility module'
        const post_stories = 2; //Post Stories module'
        const leads = 3; //Leads extraction module'
        const directs = 4; //Sending directs module'
        const statistic = 5; //Stadistic metrix module'

        public $Id;
        public $Name;
        public $Description;

        /**
         * 
         * @todo Class constructor.
         * 
         */
        function __construct() {
            parent::__construct();

            $CI = &get_instance();
            $CI = &get_instance();
            $CI->load->model("Modules_model");
        }

        /**
         * 
         * @throws Exception
         */
        public function load_data(int $Id) {
            $this->Id = $Id;
            $CI = &get_instance();
            $data = $CI->Modules_model->get_by_id($this->Id);
            if ($data == null) {
                throw ErrorCodes::getException(ErrorCodes::DATA_NOT_FOUND);
            }
            $this->fill_data($data);
        }

        private function fill_data(\stdClass $data = NULL) {
            if ($data) {
                $this->Name = $data->name;
                $this->Description = $data->description;
            } else {
//throw ErrorCodes::getException(ErrorCodes::CLIENT_DATA_NOT_FOUND);
            }
        }

    }

}
?>