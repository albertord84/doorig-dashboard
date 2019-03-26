<?php

namespace business {

    require_once config_item('business-class');
    require_once config_item('business-client-class');
    require_once config_item('business-error-codes-class');

    /**
     * @category Business class
     * 
     * @access public
     *
     * @todo Define an Proxy business class.
     * 
     */
    class Payment extends Loader {

        public $client_id, $gateway_client_id, $gateway_id;

        function __construct(int $client_id = NULL) {
            $ci = &get_instance();
            $ci->load->model('Client_payment_model');

            $this->client_id = $client_id;
        }

        public function load_data() {
            //$this->Id = $id ? $id : $this->Id;

            $ci = &get_instance();
            $data = $ci->Client_payment_model->get_by_id($this->client_id);

            if ($data)
                $this->fill_data($data);
        }

        public function fill_data(\stdClass $data) {
            $this->client_id = $data->client_id;
            $this->gateway_client_id = $data->gateway_client_id;
            $this->gateway_id = $data->gateway_id;
        }

        public function save_data() {
            
        }

        public function vindi_notification_post() {
            try {
                //1. Get and Save Raw Content Input String
                $post_str = file_get_contents('php://input');
                $path = __dir__ . '/../../../logs/vindi/';
                $file = $path . "vindi_notif_post-" . date("d-m-Y") . ".log";
                $result = file_put_contents($file, "\n\n", FILE_APPEND);
                $result = file_put_contents($file, serialize($post_str), FILE_APPEND);

                //2. Converto Raw Object to string
                $post = urldecode($post_str);
                $post = json_decode($post);

                //3. Process input object
                if (isset($post->event) && isset($post->event->type)) {
                    //4.1 Recurrence created succefully
                    if ($post->event->type == "charge_created") {
                        $gateway_client_id = $post->event->data->charge->customer->id;
                        $Client->MarkInfo->load_data();
                        //4.1 Save Client 
                        $Client = new Client();
                        $Client->load_data_by_gateway_client_id();
                        //[]
                        $Client->MarkInfo = new \business\MarkInfo($Client);
                        //$gateway_client_id = $post->event->data->bill->customer->id;
                        //$gateway_payment_key = $post->event->data->bill->subscription->id;
                        $Client->MarkInfo->saveGatewayInfo();
                    }
                    //4.2 Bill paid succefully
                    if ($post->event->type == "bill_paid") {
                        if (isset($post->event->data) && isset($post->event->data->bill) && $post->event->data->bill->status = "paid") {
                            $result = file_put_contents($file, "\n bill_paid DETECTED!!:\n", FILE_APPEND);
                            // Activate User
                            //$gateway_client_id = $post->event->data->bill->customer->id;
                            $gateway_payment_key = $post->event->data->bill->subscription->id;
                            //1. activar cliente
                            $this->load->model('class/user_model');
                            $this->load->model('class/user_status');
                            $this->load->model('class/client_model');
                            //$client_id = $this->client_model->get_client_id_by_gateway_client_id($gateway_client_id);
                            $client_id = $this->client_model->get_client_id_by_gateway_payment_key($gateway_payment_key);
                            if ($client_id) {
                                $this->user_model->update_user($client_id, array(
                                    'status_id' => user_status::ACTIVE));
                                $result = file_put_contents($file, "$client_id: ACTIVED" . "\n\n", FILE_APPEND);
                                //2. pay_day un mes para el frente
                                $this->client_model->update_client(
                                        $client_id, array('pay_day' => strtotime("+1 month", time())));
                                $result = file_put_contents($file, "$client_id: +1 month from now" . "\n\n\n", FILE_APPEND);
                            } else {
                                $result = file_put_contents($file, "Subscription($gateway_payment_key): NOT FOUND HERE!!!" . "\n\n\n", FILE_APPEND);
                            }
                            //die("Activate client -> Payment done!! -> Dia da cobrança um mês para frente");
                        }
                    }
                } else {
                    $result = file_put_contents($file, "\nERROR:\n", FILE_APPEND);
                    $result = file_put_contents($file, $post, FILE_APPEND);
                    $result = file_put_contents($file, "\nERROR END\n", FILE_APPEND);
                    echo "FAIL";
                    return;
                }
            } catch (\Exception $exc) {
                echo $exc->getTraceAsString();
                $result = file_put_contents($file, "$client_id: " . $exc->getTraceAsString() . "\n\r\n\r", FILE_APPEND);
                return;
            }

            if ($result === FALSE) {
                echo "FAIL";
                return;
            }
            echo "OK";
        }

        // USADOS INTERNAMENTE PELOS ROBOTS DE PAGAMENTO
        public function check_payment_vindi() {
            require_once $_SERVER['DOCUMENT_ROOT'] . '/follows-worker/worker/class/Gmail.php';
            require_once $_SERVER['DOCUMENT_ROOT'] . '/follows-worker/worker/class/system_config.php';
            $GLOBALS['sistem_config'] = new follows\cls\system_config();
            echo "Check Payment Inited...!<br>\n";
            echo date("Y-m-d h:i:sa");
            $this->load->model('class/user_model');
            $this->load->model('class/client_model');
            $this->load->model('class/user_role');
            $this->load->model('class/user_status');
            // Get all users
            $this->db->select('*');
            $this->db->from('clients');
            $this->db->join('users', 'clients.user_id = users.id');
            $this->db->join('client_payment', 'clients.user_id = client_payment.dumbu_client_id');
            //$this->db->where('id', "1");
            $this->db->where('role_id', user_role::CLIENT);
            $this->db->where('status_id <>', user_status::DELETED);
            $this->db->where('status_id <>', user_status::BEGINNER);
            $this->db->where('status_id <>', user_status::DONT_DISTURB);
            //$this->db->where('gateway_id', 1); // 1 -> Id da mundipagg
            //        $this->db->where('status_id <>', user_status::BLOCKED_BY_PAYMENT);
            // TODO: COMMENT MAYBE
            //        $this->db->or_where('status_id', user_status::BLOCKED_BY_PAYMENT);  // This status change when the client update his pay data
            //        $this->db->or_where('status_id', user_status::ACTIVE);
            //        $this->db->or_where('status_id', user_status::BLOCKED_BY_INSTA);
            //        $this->db->or_where('status_id', user_status::VERIFY_ACCOUNT);
            //        $this->db->or_where('status_id', user_status::UNFOLLOW);
            //        $this->db->or_where('status_id', user_status::BLOCKED_BY_TIME);
            //        $this->db->or_where('status_id', user_status::INACTIVE);
            //        $this->db->or_where('status_id', user_status::PENDING);
            $clients = $this->db->get()->result_array();
            // Check payment for each user
            foreach ($clients as $client) {
                if ($this->is_client_vindi($client['user_id'])) { // Si é cliente da VINDI
                    $clientname = $client['name'];
                    $clientid = $client['user_id'];
                    var_dump($clientid . ": " . $clientname);
                    $now = new DateTime("now");
                    //$payday = strtotime($client['pay_day']);
                    $payday = new DateTime();
                    $payday->setTimestamp($client['pay_day']);
                    $diff_info = $payday->diff($now);
                    $diff_days = $diff_info->days;
                    $today = strtotime("today");
                    if ($now > $payday && $client['status_id'] != user_status::BLOCKED_BY_PAYMENT) { // wheter not have order key
                        print "\n<br>Client pay data data expired!!!: $clientname (id: $clientid)<br>\n";
                        $days_left = $GLOBALS['sistem_config']->DAYS_TO_BLOCK_CLIENT - $diff_days;
                        if ($GLOBALS['sistem_config']->DAYS_TO_BLOCK_CLIENT - $diff_days > 0) {
                            if ($GLOBALS['sistem_config']->DAYS_TO_BLOCK_CLIENT - $diff_days == 4) {
                                $client['email'] = "josergm86@gmail.com";
                                $this->send_payment_email($client, 4);
                            } else if ($GLOBALS['sistem_config']->DAYS_TO_BLOCK_CLIENT - $diff_days == 3) {
                                $client['email'] = "josergm86@gmail.com";
                                $this->send_payment_email($client, 3);
                            } else {
                                $this->send_payment_email($client, $GLOBALS['sistem_config']->DAYS_TO_BLOCK_CLIENT - $diff_days);
                                $this->user_model->insert_washdog($clientid, "EMAIL SENT ($days_left day(s) left) IN check_payment_vindi()");
                                print "Days left: " . ($GLOBALS['sistem_config']->DAYS_TO_BLOCK_CLIENT - $diff_days) . "<br>\n";
                            }
                        } else {
                            $this->load->model('class/user_status');
                            $this->user_model->update_user($clientid, array('status_id' => user_status::BLOCKED_BY_PAYMENT, 'status_date' => time()));
                            $this->user_model->insert_washdog($clientid, "SET TO BLOCKED_BY_PAYMENT IN check_payment_vindi()");
                            $this->send_payment_email($client);
                        }
                    }
                }
            }
            try {
                $Gmail = new follows\cls\Gmail();
                //$Gmail->send_mail("albertord84@gmail.com", "Alberto Reyes", 'DUMBU VINVI payment checked!!! ', 'DUMBU VINVI payment checked!!! ');
                $Gmail->send_mail("josergm86@gmail.com", "Jose Ramon ", 'DUMBU VINVI payment checked!!! ', 'DUMBU VINVI payment checked!!! ');
                $Gmail->send_mail("jangel.riveaux@gmail.com", "Jose Angel Riveaux ", 'DUMBU VINVI payment checked!!! ', 'DUMBU VINVI payment checked!!! ');
            } catch (Exception $ex) {
                echo 'Emails was not send';
            }
            echo "\n\n<br>Job Done!" . date("Y-m-d h:i:sa") . "\n\n";
        }

        public function is_client_vindi($client_id) {
            $client = NULL;
            try {
                $this->db->select('*');
                $this->db->from('client_payment');
                $this->db->where('dumbu_client_id', $client_id);
                $client = $this->db->get()->row_array();
            } catch (\Exception $exc) {
                return $exc;
            }
            return is_array($client) && $client["gateway_id"] == 2;
        }

        public function vindi_addClient() {
            $Vindi = new \Vindi\Vindi();
            $credit_card_name = urldecode($_POST['credit_card_name']);
            $user_email = urldecode($_POST['user_email']);
            $result = $Vindi->addClient($credit_card_name, $user_email);
            echo json_encode($result);
        }

        public function vindi_addClientPayment() {
            require_once $_SERVER['DOCUMENT_ROOT'] . '/follows-worker/worker/class/system_config.php';
            $GLOBALS['sistem_config'] = new follows\cls\system_config();
            require_once $_SERVER['DOCUMENT_ROOT'] . '/follows-worker/worker/class/PaymentVindi.php';
            $Vindi = new \follows\cls\Payment\Vindi();
            $user_id = urldecode($_POST['user_id']);
            $datas = (array) json_decode(urldecode($_POST['datas']));
            $result = $Vindi->addClientPayment($user_id, $datas);
            echo json_encode($result);
        }

        public function vindi_cancel_recurrency_payment() {
            require_once $_SERVER['DOCUMENT_ROOT'] . '/follows-worker/worker/class/system_config.php';
            $GLOBALS['sistem_config'] = new follows\cls\system_config();
            require_once $_SERVER['DOCUMENT_ROOT'] . '/follows-worker/worker/class/PaymentVindi.php';
            $Vindi = new \follows\cls\Payment\Vindi();
            $client_payment_key = urldecode($_POST['client_payment_key']);
            $result = $Vindi->cancel_recurrency_payment($client_payment_key);
            echo json_encode($result);
        }

        public function vindi_create_payment() {
            require_once $_SERVER['DOCUMENT_ROOT'] . '/follows-worker/worker/class/system_config.php';
            $GLOBALS['sistem_config'] = new follows\cls\system_config();
            require_once $_SERVER['DOCUMENT_ROOT'] . '/follows-worker/worker/class/PaymentVindi.php';
            $Vindi = new \follows\cls\Payment\Vindi();
            $user_id = urldecode($_POST['user_id']);
            $prod_1real_id = urldecode($_POST['prod_1real_id']);
            $amount = urldecode($_POST['amount']);
            $result = $Vindi->create_payment($user_id, $prod_1real_id, $amount);
            echo json_encode($result);
        }

        public function vindi_create_recurrency_payment() {
            require_once $_SERVER['DOCUMENT_ROOT'] . '/follows-worker/worker/class/system_config.php';
            $GLOBALS['sistem_config'] = new follows\cls\system_config();
            require_once $_SERVER['DOCUMENT_ROOT'] . '/follows-worker/worker/class/PaymentVindi.php';
            $Vindi = new \follows\cls\Payment\Vindi();
            $user_id = urldecode($_POST['user_id']);
            $pay_day = json_decode(urldecode($_POST['pay_day']));
            $plane_type = json_decode(urldecode($_POST['plane_type']));
            $result = $Vindi->create_recurrency_payment($user_id, $pay_day, $plane_type);
            echo json_encode($result);
        }

    }

}    