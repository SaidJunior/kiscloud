<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ParserDiskCreate
 *
 * @author clement
 */

class ParserDiskCreate extends SSHParser {

    public function __construct($coreObject) {
        parent::__construct($coreObject);
    }

    public function parseExec_output() {
        $pattern = '/Formatting/i';
        preg_match($pattern, $this->getExec_output(), $matches);
        if (count($matches) == 0) {
            //Disk error
            $this->getCoreObject()->setError(true);
            $this->getCoreObject()->setError_value($this->getExec_error());
        }
    }

}

?>
