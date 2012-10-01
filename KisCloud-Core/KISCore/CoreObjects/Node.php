<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CoreNode
 *
 * @author clement
 */
class Node extends CoreObjects {

    //put your code here
    
    private $valid_centos = null;
    private $centos_version = null;
    private $vtd_enabled = null;
    private $vtd_type = null;

    public function __construct() {
        parent::__construct();
    }

    public function getValid_centos() {
        return $this->valid_centos;
    }

    public function setValid_centos($valid_centos) {
        $this->valid_centos = $valid_centos;
    }

    public function getCentos_version() {
        return $this->centos_version;
    }

    public function setCentos_version($centos_version) {
        $this->centos_version = $centos_version;
    }
    
    public function getVtd_enabled() {
        return $this->vtd_enabled;
    }

    public function setVtd_enabled($vtd_enabled) {
        $this->vtd_enabled = $vtd_enabled;
    }

    public function getVtd_type() {
        return $this->vtd_type;
    }

    public function setVtd_type($vtd_type) {
        $this->vtd_type = $vtd_type;
    }

}

?>
