<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ParserNFSConfiguration
 *
 * @author clement
 */
class ParserNFSConfiguration extends SSHParser {

    private $ip_manager=null;
    private $path=null;
    
    public function __construct($coreObject, $ip_manager, $path) {
        parent::__construct($coreObject);
        $this->ip_manager=$ip_manager;
        $this->path=$path;
    }

    public function parseExec_output() {
        //$this->ip_manager:$this->path /opt/KISCloud/nfs/ nfs defaults 1 1
        $pattern = '/Formatting/i';
        $matches="";
        preg_match($pattern, $this->getExec_output(), $matches);
        if (count($matches) == 0) {
            
        }
    }

    
}

?>
