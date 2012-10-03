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
        $pattern = 'x86_64';
        preg_match($pattern, $this->getExec_output(), $matches);
        if (count($matches) == 0) {
            //64 bit kernel not supported
            $this->getCoreObject()->setArch64bit(false);
        } else {
            //64 bit kernel supported
            $this->getCoreObject()->setArch64bit(true);
            $this->getCoreObject()->setCentos_version($matches[1]);//can use [0]
        }
    }

}

?>
