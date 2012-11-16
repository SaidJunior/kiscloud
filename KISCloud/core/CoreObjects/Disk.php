<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Disk
 *
 * @author clement
 */
class Disk extends CoreObjects {

    private $name=null;
    private $size=null;
    private $path=null;
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getSize() {
        return $this->size;
    }

    public function setSize($size) {
        $this->size = $size;
    }

    public function getPath() {
        return $this->path;
    }

    public function setPath($path) {
        $this->path = $path;
    }
    
}

?>
