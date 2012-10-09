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
class Manager extends CoreObjects {
    
    private $ip = null;
    private $ssh_fingerprint = null;
    private $ssh_username = null;
    private $ssh_password = null;
    private $valid_centos = null;
    private $centos_version = null;
    
    private $nfs_folder_created = false;
    private $nfs_configured = false;
    private $nfs_folder_mounted = false;
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getIp() {
        return $this->ip;
    }

    public function setIp($ip) {
        $this->ip = $ip;
    }

    public function getSsh_fingerprint() {
        return $this->ssh_fingerprint;
    }

    public function setSsh_fingerprint($ssh_fingerprint) {
        $this->ssh_fingerprint = $ssh_fingerprint;
    }

    public function getSsh_username() {
        return $this->ssh_username;
    }

    public function setSsh_username($ssh_username) {
        $this->ssh_username = $ssh_username;
    }

    public function getSsh_password() {
        return $this->ssh_password;
    }

    public function setSsh_password($ssh_password) {
        $this->ssh_password = $ssh_password;
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
    
    public function getNfs_folder_created() {
        return $this->nfs_folder_created;
    }

    public function setNfs_folder_created($nfs_folder_created) {
        $this->nfs_folder_created = $nfs_folder_created;
    }

    public function getNfs_configured() {
        return $this->nfs_configured;
    }

    public function setNfs_configured($nfs_configured) {
        $this->nfs_configured = $nfs_configured;
    }

    public function getNfs_folder_mounted() {
        return $this->nfs_folder_mounted;
    }

    public function setNfs_folder_mounted($nfs_folder_mounted) {
        $this->nfs_folder_mounted = $nfs_folder_mounted;
    }
    
}

?>
