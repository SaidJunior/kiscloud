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
class VMDelegate extends KisCore {

    public function __construct($coreObject) {
        parent::__construct($coreObject);
    }

    public function startVM($ip, $ssh_username, $ssh_password, $ssh_fingerprint, $vm_nom, $vm_systeme, $vm_nb_processeur, $vm_ram, $disk_name, $disk_path, $iso, $port_vnc, $port_proxy) {
        $sshConnector = new SSHConnector($ip, "22", $ssh_fingerprint);
        $sshConnector->connect_password($ssh_username, $ssh_password);
        
        $sshConnector->exec("");
        
    }
    
    public function stopVM($ip, $ssh_username, $ssh_password, $ssh_fingerprint, $vm_nom) {
        $sshConnector = new SSHConnector($ip, "22", $ssh_fingerprint);
        $sshConnector->connect_password($ssh_username, $ssh_password);
        
    }
    
}
?>
