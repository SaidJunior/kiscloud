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
    
    public function createDisk($ip, $ssh_username, $ssh_password, $ssh_fingerprint, $disk_name, $disk_size, $disk_path) {
        $sshConnector = new SSHConnector($ip, "22", $ssh_fingerprint);
        $sshConnector->connect_password($ssh_username, $ssh_password);

        $parserDiskCreate = new ParserDiskCreate($this->getCoreObject());
        $parserDiskCreate->setExec_output($sshConnector->exec("qemu-img create -f qcow2 ".$disk_path."/".$disk_name.".qcow2 ".$disk_size."G"));
        $parserDiskCreate->parseExec_output();
    }
    
    public function deleteDisk($ip, $ssh_username, $ssh_password, $ssh_fingerprint, $disk_name, $disk_path) {
        $sshConnector = new SSHConnector($ip, "22", $ssh_fingerprint);
        $sshConnector->connect_password($ssh_username, $ssh_password);

        $sshConnector->exec("rm -f ".$disk_path."/".$disk_name.".qcow2");
    }
    
    public function diskFileCreated($ip, $ssh_username, $ssh_password, $ssh_fingerprint, $disk_name, $disk_path) {
        $sshConnector = new SSHConnector($ip, "22", $ssh_fingerprint);
        $sshConnector->connect_password($ssh_username, $ssh_password);

        $parserDiskFile = new ParserDiskFile($this->getCoreObject());
        $parserDiskFile->setExec_output($sshConnector->exec("ls ".$disk_path."/".$disk_name.".qcow2"));
        $parserDiskFile->parseExec_output();
    }
    
}

?>
