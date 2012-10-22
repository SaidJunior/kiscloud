<?php

class ParserRpcbind extends SSHParser {

    //put your code here·
    public function __construct($coreObject) {
        parent::__construct($coreObject);
    }

    public function parseExec_output() {

        $pattern = '/rpcbind/';

        preg_match($pattern, $this->getExec_output(), $matches);

        if (count($matches) != 0) {
            $this->getCoreObject()->setRpcbind(true);
        } else {
            $this->getCoreObject()->setRpcbind(false);
        }
    }

}

?>
