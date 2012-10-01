<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SSHParser
 *
 * @author clement
 */
include_once 'SSHParser/ParserVTD.php';
include_once 'SSHParser/ParserCentOS.php';

abstract class SSHParser {

    //The value of the exec command
    private $exec_return_code = null;
    //The output value of the exec command
    private $exec_output = null;
    //Object need to be return
    private $coreObject = null;

    public function __construct($coreObject) {
        $this->coreObject = $coreObject;
    }

    abstract function parseExec_output();

    public function getExec_return_code() {
        return $this->exec_return_code;
    }

    public function setExec_return_code($exec_return_code) {
        $this->exec_return_code = $exec_return_code;
    }

    public function getExec_output() {
        return $this->exec_output;
    }

    public function setExec_output($exec_output) {
        $this->exec_output = $exec_output;
    }

    public function getCoreObject() {
        return $this->coreObject;
    }

    public function setCoreObject($coreObject) {
        $this->coreObject = $coreObject;
    }

}

?>
