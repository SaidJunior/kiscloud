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
include_once 'SSHParser/ParserDiskCreate.php';
include_once 'SSHParser/ParserNFSConfiguration.php';
include_once 'SSHParser/ParserNFSFolder.php';

abstract class SSHParser {

    //The value of the exec command
    private $exec_return_code = null;
    //The output value of the exec command
    private $exec_output = null;
    //The Error Output of th exec command
    private $exec_error = null;
    //Object need to be return
    private $coreObject = null;

    public function __construct($coreObject) {
        $this->coreObject = $coreObject;
    }

    abstract function parseExec_output();

    public function getExec_return_code() {
        return $this->exec_return_code;
    }

    private function setExec_return_code($exec_return_code) {
        $this->exec_return_code = $exec_return_code;
        //need to set with setExec_output($exec_output);
    }

    public function getExec_output() {
        return $this->exec_output;
    }

    public function setExec_output($exec_output) { //Get an array with error value and others
        //print_r($exec_output);
        $this->exec_output = $exec_output["out"];

        $this->setExec_error($exec_output["error"]);
        $this->setExec_return_code($exec_output["staus_code"]);
    }

    public function getExec_error() {
        return $this->exec_error;
    }

    private function setExec_error($exec_error) {
        if (is_array($exec_error) && count($exec_error)>0) {
            $error_string = implode("<br />", $exec_error);
            $this->exec_error = $error_string;
        }else{
            $this->exec_error = $exec_error;
        }
    }

    public function getCoreObject() {
        return $this->coreObject;
    }

    private function setCoreObject($coreObject) {
        $this->coreObject = $coreObject;
    }

}

?>
