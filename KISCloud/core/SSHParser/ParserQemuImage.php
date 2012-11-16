<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ParserQemuImage
 *
 * @author Anthony
 */
class ParserQemuImage extends SSHParser {

    
    //put your code here
    public function __construct($coreObject) {
        parent::__construct($coreObject);
    }

    public function parseExec_output() {

        $pattern = '/qemu-img/';

        preg_match($pattern, $this->getExec_output(), $matches);
        
        if (count($matches) != 0) {
            $this->getCoreObject()->setQemu_image(true);
        } else {
            $this->getCoreObject()->setQemu_image(false);
        }
    }

}

?>
