<?php

namespace business\Response {

    require_once config_item('business-response-class');

    /**
     * Description of Response
     *
     * @author albertord
     */
    class ResponseLoginToken extends Response {

        public $code = 0;
        public $message = "";
        public $LoginToken;

        function __construct(string $LoginToken, int $code = 0, string $message = "") {
            parent::__construct($code, $message);

            $this->LoginToken = $LoginToken;
            $this->output_array += array('LoginToken' => $this->LoginToken);
        }

        public function toJson() {
            get_instance()->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($this->output_array));
        }

    }

}
