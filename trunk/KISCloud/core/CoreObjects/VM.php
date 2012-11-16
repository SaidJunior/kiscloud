<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Manager
 *
 * @author clement
 */
class VM extends CoreObjects {
    
    private $id = null;
    private $name = null;
    private $os = null;
    private $status = null;
    private $nb_proc = null;
    private $nb_ram = null;
    private $vnc_port = null;
    private $vnc_proxy = null;
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getOs() {
        return $this->os;
    }

    public function setOs($os) {
        $this->os = $os;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getNb_proc() {
        return $this->nb_proc;
    }

    public function setNb_proc($nb_proc) {
        $this->nb_proc = $nb_proc;
    }

    public function getNb_ram() {
        return $this->nb_ram;
    }

    public function setNb_ram($nb_ram) {
        $this->nb_ram = $nb_ram;
    }

    public function getVnc_port() {
        return $this->vnc_port;
    }

    public function setVnc_port($vnc_port) {
        $this->vnc_port = $vnc_port;
    }

    public function getVnc_proxy() {
        return $this->vnc_proxy;
    }

    public function setVnc_proxy($vnc_proxy) {
        $this->vnc_proxy = $vnc_proxy;
    }

}

?>