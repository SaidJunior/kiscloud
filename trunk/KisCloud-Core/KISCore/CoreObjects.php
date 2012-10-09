<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CoreObjects
 *
 * @author clement
 */

include_once 'CoreObjects/Node.php';
include_once 'CoreObjects/Manager.php';
include_once 'CoreObjects/Disk.php';

class CoreObjects {
    //put your code here
    
    private $error=null;
    private $error_value=null;
    
    public function __construct() {
        $this->error=false;
        $this->error_value="";
    }
    
    public function getError() {
        return $this->error;
    }

    public function setError($error) {
        $this->error = $error;
    }

    public function getError_value() {
        return $this->error_value;
    }

    public function setError_value($error_value) {
        $this->error_value = $error_value;
    }

}

?>
