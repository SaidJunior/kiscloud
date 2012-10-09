<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DiskDelegate
 *
 * @author clement
 */
class DiskDelegate extends KisCore {

    public function __construct($coreObject) {
        parent::__construct($coreObject);
    }
    
    public function createDisk($name, $size, $path){
        $localExec = new LocalExec();
        
        $this->getCoreObject()->setName($name);
        $this->getCoreObject()->setSize($size);
        $this->getCoreObject()->setPath($path);
        
        $parserDiskCreate = new ParserDiskCreate($this->getCoreObject());
        $parserDiskCreate->setExec_output($localExec->exec("qemu-img create -f qcow2 ".$path."/".$name.".qcow2 ".$size."G"));
        $parserDiskCreate->parseExec_output();
    }
    
}

?>
