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
class User extends CoreObjects {
    
    private $id = null;
    private $login = null;
    private $password = null;
    private $firstname = null;
    private $lastname = null;
    private $mail = null;
    private $status = null;
    private $cookie_id = null;
    
    private $user_folder_created = false;
    
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getLogin() {
        return $this->login;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getFirstname() {
        return $this->firstname;
    }

    public function setFirstname($firstname) {
        $this->firstname = $firstname;
    }

    public function getLastname() {
        return $this->lastname;
    }

    public function setLastname($lastname) {
        $this->lastname = $lastname;
    }

    public function getMail() {
        return $this->mail;
    }

    public function setMail($mail) {
        $this->mail = $mail;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getCookie_id() {
        return $this->cookie_id;
    }

    public function setCookie_id($cookie_id) {
        $this->cookie_id = $cookie_id;
    }
    
    public function getUser_folder_created() {
        return $this->user_folder_created;
    }

    public function setUser_folder_created($user_folder_created) {
        $this->user_folder_created = $user_folder_created;
    }
    
}

?>
