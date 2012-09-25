<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KisCore
 *
 * @author clement
 */

include_once 'Delegate/NodeDelegate.php';

abstract class KisCore {
    
    private $coreObject;
    
    public function __construct($coreObject) {
        $this->coreObject = $coreObject;
    }
        
    public function getCoreObject() {
        return $this->coreObject;
    }

    public function setCoreObject($coreObject) {
        $this->coreObject = $coreObject;
    }
    
}

?>
