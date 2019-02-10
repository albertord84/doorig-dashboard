<?php

namespace business {

    require_once config_item('business-class');
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
        public $Proxy_id;
        public $Name;
        public $Email;
        public $Password;
        public $Status_id;
        public $Node_id;
        public $Phone;
        public $Verification_code;
        public $Init_date;
        public $Last_access;
        public $Utm_source;
        public $Utm_campain;
        public $Login_token;

        /**
         * 
         * @todo Class constructor.
         * 
         */
        function __construct() {
            parent::__construct();

            $ci = &get_instance();
            $ci->load->model('Clients_model');
        }

        /**
         * Get client data
         * @param int $client_id
         * @return DataSet  
         */
        public function load_data(int $id) {
            $ci = &get_instance();
            $data = $ci->Clients_model->get_by_id($id);
            if ($data == null) {
                throw ErrorCodes::getException(ErrorCodes::CLIENT_ID_NOT_FOUND);
            }

            $this->fill_data($data);
        }

        /**
         * Get client data
         * @param int $email
         * @return DataSet  
         */
        public function load_data_by_email(string $email) {
            $ci = &get_instance();
            $data = $ci->Clients_model->get_by_email($email);
            if ($data == null) {
                throw ErrorCodes::getException(ErrorCodes::EMAIL_NOT_FOUND);
            }

            $this->fill_data($data);
        }

        /**
         * Get client data
         * @param int $email
         * @return DataSet  
         */
        public function load_data_by_login_token(string $login_token) {
            $ci = &get_instance();
            $data = $ci->Clients_model->get_by_login_token($login_token);
            if ($data == null) {
                throw ErrorCodes::getException(ErrorCodes::VALIDATION_TOKEN_NOT_FOUND);
            }

            $this->fill_data($data);
        }

        private function fill_data(\stdClass $data = NULL) {
            if ($data) {
                $this->Id = $data->id;
                $this->Name = $data->name;
                $this->Email = $data->email;
                $this->Password = $data->password;
                $this->Status_id = $data->status_id;
                $this->Node_id = $data->node_id;
                $this->Phone = $data->phone;
                $this->Verification_code = $data->verification_code;
                $this->Init_date = $data->init_date;
                $this->Last_access = $data->last_access;
                $this->Utm_source = $data->utm_source;
                $this->Utm_campain = $data->utm_campain;
                $this->Login_token = $data->login_token;
            } else {
                //throw ErrorCodes::getException(ErrorCodes::CLIENT_DATA_NOT_FOUND);
            }
        }

        public function insert($email, $name, $password, $status_id = 1, $node_id = 1, $phone = NULL, $verification_code = NULL, $init_date = NULL, $last_access = NULL, $utm_source = NULL, $utm_campain = NULL, $login_token = NULL) {
            if (Client::exist($email, ClientStatus::ACTIVE)) {
                throw ErrorCodes::getException(ErrorCodes::EMAIL_ALREADY_EXIST);
            }
            $ci = &get_instance();
            $client_id = $ci->Clients_model->save($email, $name, $password, $status_id, $node_id, $phone, $verification_code, $init_date, $last_access, $utm_source, $utm_campain, $login_token);
            return $client_id;
        }

        public function update($id, $email = NULL, $name = NULL, $password = NULL, $status_id = NULL, $node_id = NULL, $phone = NULL, $verification_code = NULL, $init_date = NULL, $last_access = NULL, $utm_source = NULL, $utm_campain = NULL, $login_token = NULL) {
            if (($email != NULL) && (Client::exist($email, ClientStatus::ACTIVE))) { // Whether I want to change the email, I check the new email do not exist
                throw ErrorCodes::getException(ErrorCodes::EMAIL_ALREADY_EXIST);
            }
            $ci = &get_instance();
            $client_id = $ci->Clients_model->update($id, $email, $name, $password, $status_id, $node_id, $phone, $verification_code, $init_date, $last_access, $utm_source, $utm_campain, $login_token);
            return $client_id;
        }

        /**
         * 
         * @todo
         * @param type
         * @return
         * 
         */
        public function set_client_status($id = NULL, $status_id = NULL) {
            $ci = &get_instance();
            try {
                $id = $id ? $id : $this->id;
                $status_id = $status_id ? $status_id : $this->status_id;
                $result = $ci->Clients_model->update($id, NULL, NULL, NULL, $status_id);
            } catch (\Exception $exc) {
                echo $exc->getTraceAsString();
            }
        }

        /**
         * 
         * @param type $password
         * @return boolean
         */
        public function check_pass($password) {
            if ($this->Password === $password) {
                return TRUE;
            }
            return FALSE;
        }

        /**
         * 
         * @param type $password
         * @return boolean
         */
        public function confirm_secure_code($Verification_code) {
            if ($this->Verification_code === $Verification_code) {
                return TRUE;
            }
            return FALSE;
        }

        //---------------SIGNIN FUNCTIONS-----------------------------

        /**
         * 
         * @return type
         */
        static function get_clients() {
            $ci = &get_instance();
            return $ci->Clients_model->get_all();
        }

        /**
         * Check if $password match with client password
         * @param string $email
         * @param string $password
         * @throws Exception
         */
        static function do_login(string $email, string $password) {
            $Client = new Client();
            try {
                $Client->load_data_by_email($email);
                if ($Client->check_pass($password) == FALSE) {
                    throw ErrorCodes::getException(ErrorCodes::WRONG_PASSWORD);
                }
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            }
            return $Client;
        }

        static function exist(string $email, int $status = 0) {
            try {
                $Client = new Client();
                $Client->load_data_by_email($email);
                return $status? $Client->Status_id == $status : TRUE;
            } catch (\Exception $exc) {
                //echo $exc->getTraceAsString();
            }
            
            return FALSE;
        }

    }

}
?>
