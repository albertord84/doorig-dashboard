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

        /**
         * 
         * @todo Class constructor.
         * 
         */
        function __construct() {
            parent::__construct();

            $this->ClientModules = new ClientModules($this);

            $this->CI->load->model('Clients_model');
            $this->CI->load->model('Clients_modules_model');
        }

        /**
         * Get client data
         * @param int $client_id
         * @return DataSet  
         */
        public function load_data(int $id) {
            $data = $this->CI->Clients_model->get_by_id($id);
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
            $data = $this->CI->Clients_model->get_by_login_token($login_token);
            if ($data == null) {
                throw ErrorCodes::getException(ErrorCodes::VALIDATION_TOKEN_NOT_FOUND);
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

        /**
         * Get module data
         * @param int $active
         * @return DataSet  
         */
        public function load_modules(int $active) {
            $this->CI->Clients_modules_model->set_client_id($this->Id);
            $this->ClientModules->load_data($active);
        }

        public function insert($pay_id = NULL, $login_token = NULL) {
            if (Client::exist($email, ClientStatus::ACTIVE)) {  
                throw ErrorCodes::getException(ErrorCodes::EMAIL_ALREADY_EXIST);
            }
            $client_id = $this->CI->Clients_model->save($pay_id, $login_token);
            return $client_id;
        }

        public function update($id, $pay_id = NULL, $login_token = NULL) {
            $client_id = $this->CI->Clients_model->update($id, $pay_id, $login_token);
            return $client_id;
        }

        //---------------SIGNIN FUNCTIONS-----------------------------

        /**
         * 
         * @return type
         */
        static function get_clients() {
            return $this->CI->Clients_model->get_all();
        }

    }

}
?>
