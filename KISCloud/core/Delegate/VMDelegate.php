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

    public function startVM($ip, $ssh_username, $ssh_password, $ssh_fingerprint, $vm_nom, $vm_systeme, $vm_nb_processeur, $vm_ram, $disk_name, $disk_path, $iso, $port_vnc) {
        $sshConnector = new SSHConnector($ip, "22", $ssh_fingerprint);
        $sshConnector->connect_password($ssh_username, $ssh_password);
        
        $sshConnector->exec("/usr/libexec/qemu-kvm -enable-kvm -drive file=".$iso.",if=ide,index=1,media=cdrom -drive file=".$disk_path."".$disk_name.".qcow2,if=virtio,index=0,media=disk,format=qcow2,cache=none -m ".$vm_ram." -cpu host -smp ".$vm_nb_processeur." -vnc :".$port_vnc." -net nic -net user -daemonize");
        
    }
    
    public function stopVM($ip, $ssh_username, $ssh_password, $ssh_fingerprint, $vm_disk_path) {
        $sshConnector = new SSHConnector($ip, "22", $ssh_fingerprint);
        $sshConnector->connect_password($ssh_username, $ssh_password);

        $sshConnector->exec("kill -9 `ps -ef | grep ".$vm_disk_path." | grep -v grep | awk '{print $2}'`");
    }
    
    public function startConsole($ip, $ssh_username, $ssh_password, $ssh_fingerprint, $path_script, $ip_noeud, $port_vnc, $port_proxy) {
        $sshConnector = new SSHConnector($ip, "22", $ssh_fingerprint);
        $sshConnector->connect_password($ssh_username, $ssh_password);
        
        $sshConnector->exec($path_script." -D 0.0.0.0:".$port_proxy." ".$ip_noeud.":".$port_vnc);
        
    }
    
    public function stopConsole($ip, $ssh_username, $ssh_password, $ssh_fingerprint, $port_proxy) {
        $sshConnector = new SSHConnector($ip, "22", $ssh_fingerprint);
        $sshConnector->connect_password($ssh_username, $ssh_password);

        $sshConnector->exec("kill -9 `ps -ef | grep 0.0.0.0:".$port_proxy." | grep -v grep | awk '{print $2}'`");
    }
    ///wsproxy.py -D 0.0.0.0:5901 147.171.79.216:5901
    
}
?>
