<?php

namespace business\Response {

    use business\ClientModule;

    require_once config_item('business-response-class');
    require_once config_item('business-client-module-class');

    /**
     * Description of Response
     *
     * @author albertord
     */
    class ResponseClientModule extends Response {

        public $ClientModule;

        function __construct(ClientModule &$Module, int $code = 0, string $message = "") {
            parent::__construct($code, $message);

            $this->ClientModule = $Module;
            unset($this->ClientModule->CI);
            $this->output_array += array('ClientModule' => $this->ClientModule);
        }

        public function toJson() {
            get_instance()->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($this->output_array));
        }

    }

}
