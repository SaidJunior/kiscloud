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
    private $ip = null;
    private $ssh_fingerprint = null;
    private $ssh_username = null;
    private $ssh_password = null;
    private $valid_centos = null;
    private $centos_version = null;
    private $vtd_enabled = null;
    private $vtd_type = null;
    private $arch64bit = false;
    
    private $qemu_image = false;
    private $rpcbind = false;
    private $nfs_utils = false;
    private $bridge_utils = false;

    private $nfs_folder_created = false;
    private $nfs_configured = false;
    private $nfs_folder_mounted = false;
    
    private $ram_total = null;
    private $ram_free = null;
    
    private $cpu_speed = null;
    private $cpu_nb = null;
    private $cpu_total = null;
    private $cpu_free = null;
    private $cpu_used = null;

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

    public function getArch64bit() {
        return $this->arch64bit;
    }

    public function setArch64bit($arch64bit) {
        $this->arch64bit = $arch64bit;
    }

    public function getQemu_image() {
        return $this->qemu_image;
    }

    public function setQemu_image($qemu_image) {
        $this->qemu_image = $qemu_image;
    }

    
    public function getNfs_folder_mounted() {
        return $this->nfs_folder_mounted;
    }

    public function setNfs_folder_mounted($nfs_folder_mounted) {
        $this->nfs_folder_mounted = $nfs_folder_mounted;
    }

    public function getRpcbind() {
        return $this->rpcbind;
    }

    public function setRpcbind($rpcbind) {
        $this->rpcbind = $rpcbind;
    }

    public function getNfs_utils() {
        return $this->nfs_utils;
    }

    public function setNfs_utils($nfs_utils) {
        $this->nfs_utils = $nfs_utils;
    }

    public function setBridge_utils($bridge_utils) {
        $this->bridge_utils = $bridge_utils;
    }

    public function getBridge_utils() {
        return $this->bridge_utils;
    }

    public function getRam_total() {
        return $this->ram_total;
    }

    public function setRam_total($ram_total) {
        $this->ram_total = $ram_total;
    }

    public function getRam_free() {
        return $this->ram_free;
    }

    public function setRam_free($ram_free) {
        $this->ram_free = $ram_free;
    }

    public function getCpu_total() {
        return $this->cpu_total;
    }

    public function setCpu_total($cpu_total) {
        $this->cpu_total = $cpu_total;
    }

    public function getCpu_free() {
        return $this->cpu_free;
    }

    public function setCpu_free($cpu_free) {
        $this->cpu_free = $cpu_free;
    }

    public function getCpu_nb() {
        return $this->cpu_nb;
    }

    public function setCpu_nb($cpu_nb) {
        $this->cpu_nb = $cpu_nb;
    }

    public function getCpu_speed() {
        return $this->cpu_speed;
    }

    public function setCpu_speed($cpu_speed) {
        $this->cpu_speed = $cpu_speed;
    }

    public function getCpu_used() {
        return $this->cpu_used;
    }

    public function setCpu_used($cpu_used) {
        $this->cpu_used = $cpu_used;
    }

}

?>
