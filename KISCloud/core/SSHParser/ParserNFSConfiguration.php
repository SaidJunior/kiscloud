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

    private $ip_nfsServer=null;
    private $path=null;
    
    public function __construct($coreObject, $ip_nfsServer, $path) {
        parent::__construct($coreObject);
        $this->ip_nfsServer=$ip_nfsServer;
        $this->path=$path;
    }

    public function parseExec_output() {
        //$this->ip_manager:$this->path /opt/KISCloud/nfs/ nfs defaults 1 1
        $replaced_path = str_replace("/", "\/", $this->path);
        $pattern = "/".$this->ip_nfsServer.":".$replaced_path." \/opt\/KISCloud\/nfs\/ nfs defaults 1 1/i";
        $matches="";

        preg_match($pattern, $this->getExec_output(), $matches);
        if (count($matches) == 0) {
            //not configured
            $this->getCoreObject()->setNfs_configured(false);
        }else{
            $this->getCoreObject()->setNfs_configured(true);
        }
    }

    
}

?>
