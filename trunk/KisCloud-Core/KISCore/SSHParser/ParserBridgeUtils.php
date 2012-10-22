<?php

class ParserBridgeUtils extends SSHParser {

    //put your code here·
    public function __construct($coreObject) {
        parent::__construct($coreObject);
    }

    public function parseExec_output() {

        $pattern = '/bridge-utils/';

        preg_match($pattern, $this->getExec_output(), $matches);

        if (count($matches) != 0) {
            $this->getCoreObject()->setBridge_utils(true);
        } else {
            $this->getCoreObject()->setBridge_utils(false);
        }
    }

}

?>