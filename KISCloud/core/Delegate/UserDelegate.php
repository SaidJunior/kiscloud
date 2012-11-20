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
class UserDelegate extends KisCore {

    public function __construct($coreObject) {
        parent::__construct($coreObject);
    }

    public function checkUserFolder($ip, $ssh_username, $ssh_password, $ssh_fingerprint, $id) {
        $sshConnector = new SSHConnector($ip, "22", $ssh_fingerprint);
        $sshConnector->connect_password($ssh_username, $ssh_password);

        $parserUserFolder = new ParserUserFolder($this->getCoreObject());
        $parserUserFolder->setExec_output($sshConnector->exec('ls /opt/KISCloud/nfs/users/' . $id));
        $parserUserFolder->parseExec_output();
    }

    public function createUserFolder($ip, $ssh_username, $ssh_password, $ssh_fingerprint, $id, $root_path) {
        $sshConnector = new SSHConnector($ip, "22", $ssh_fingerprint);
        $sshConnector->connect_password($ssh_username, $ssh_password);

        $sshConnector->exec('mkdir -p /opt/KISCloud/nfs/users/' . $id . '/disks');
        $sshConnector->exec('mkdir -p /opt/KISCloud/nfs/users/' . $id . '/isos');
        
        $sshConnector->exec('ln -s /opt/KISCloud/nfs/users/' . $id . ' ' . $root_path . '/client/server/php/files/');
        
        $sshConnector->exec('chmod u=rwX,g=rwX,o=rwX -R /opt/KISCloud/nfs/users/' . $id . '/*');

        //Chown apache:virt ???
    }

    public function deleteUserFolder($ip, $ssh_username, $ssh_password, $ssh_fingerprint, $id, $root_path) {
        $sshConnector = new SSHConnector($ip, "22", $ssh_fingerprint);
        $sshConnector->connect_password($ssh_username, $ssh_password);

        $sshConnector->exec('rm -rf /opt/KISCloud/nfs/users/' . $id);
        $sshConnector->exec('rm -rf ' . $root_path . '/client/server/php/files/' . $id);
    }

}

?>
