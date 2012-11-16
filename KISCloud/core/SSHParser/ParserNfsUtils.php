<?php

class ParserNfsUtils extends SSHParser {

    //put your code here·
    public function __construct($coreObject) {
        parent::__construct($coreObject);
    }

    public function parseExec_output() {

        $pattern = '/nfs-utils/';

        preg_match($pattern, $this->getExec_output(), $matches);

        if (count($matches) != 0) {
            $this->getCoreObject()->setNfs_utils(true);
        } else {
            $this->getCoreObject()->setNfs_utils(false);
        }
    }

}

?>
