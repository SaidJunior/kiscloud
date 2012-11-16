<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ParserCentOS
 *
 * @author clement
 */
class ParserCentOS extends SSHParser {

    public function __construct($coreObject) {
        parent::__construct($coreObject);
    }

    public function parseExec_output() {
        $pattern = '/CentOS release (6.\d+)/i';
        preg_match($pattern, $this->getExec_output(), $matches);
        if (count($matches) == 0) {
            //No Centos 6.x
            $this->getCoreObject()->setValid_centos(false);
        } else {
            //CentOS 6.x ok
            $this->getCoreObject()->setValid_centos(true);
            $this->getCoreObject()->setCentos_version($matches[1]);
        }
    }
}

?>