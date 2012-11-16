<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ParserArch64
 *
 * @author Anthony
 */
class ParserArch64 extends SSHParser {

    //put your code here
    public function __construct($coreObject) {
        parent::__construct($coreObject);
    }

    public function parseExec_output() {
        $pattern = '/x86_64/i';
        preg_match($pattern, $this->getExec_output(), $matches);
        //print_r($matches);
        if (count($matches) == 0) {
            //64 bit kernel not supported
            $this->getCoreObject()->setArch64bit(FALSE);
        } else {
            //64 bit kernel supported
            $this->getCoreObject()->setArch64bit(TRUE);
        }
    }

}

?>
