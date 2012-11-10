<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NodeDelegate
 *
 * @author clement
 */
class ManagerDelegate extends KisCore {

    //put your code here

    public function __construct($coreObject) {
        parent::__construct($coreObject);
    }

    public function checkSSHConnection($ip, $ssh_username, $ssh_password) {
        $sshConnector = new SSHConnector($ip, "22", null);
        $sshConnector->init_connection();
    }

    public function getManagerRequirement($ip, $ssh_username, $ssh_password) {

        $this->getCoreObject()->setIp($ip);
        $this->getCoreObject()->setSsh_username($ssh_username);
        $this->getCoreObject()->setSsh_password($ssh_password);


        $sshConnector = new SSHConnector($ip, "22", null);
        $sshConnector->init_connection();

        $this->getCoreObject()->setSsh_fingerprint($sshConnector->getSsh_server_fp());

        $sshConnector->connect_password($ssh_username, $ssh_password);

        //Test CentOS
        $parserCentOS = new ParserCentOS($this->getCoreObject());
        $parserCentOS->setExec_output($sshConnector->exec("cat /etc/redhat-release"));
        $parserCentOS->parseExec_output();

        //Test RPCBind
        //Test nfs-utils
        //Test 
    }

    public function installManagerRequirement($ip, $ssh_username, $ssh_password, $ssh_fingerprint) {
        $sshConnector = new SSHConnector($ip, "22", $ssh_fingerprint);
        $sshConnector->connect_password($ssh_username, $ssh_password);

        //need to complete with qemu hypervisor
        //yum install -y nfs-utils rpcbind qemu-img
    }

    public function checkNFSConfiguration($ip, $ssh_username, $ssh_password, $ssh_fingerprint, $ip_nfsServer, $path) {
        $sshConnector = new SSHConnector($ip, "22", $ssh_fingerprint);
        $sshConnector->connect_password($ssh_username, $ssh_password);

        $parserNFSConf = new ParserNFSConfiguration($this->getCoreObject(), $ip_nfsServer, $path);
        $parserNFSConf->setExec_output($sshConnector->exec("cat /etc/fstab"));
        $parserNFSConf->parseExec_output();
    }

    public function installNFSConfiguration($ip, $ssh_username, $ssh_password, $ssh_fingerprint, $ip_nfsServer, $path) {
        $sshConnector = new SSHConnector($ip, "22", $ssh_fingerprint);
        $sshConnector->connect_password($ssh_username, $ssh_password);

        $sshConnector->exec("cp /etc/fstab /etc/fstab.tmp");
        $sshConnector->exec("sed -e '/## KISCLOUD ##/,/## END KISCLOUD ##/d' < /etc/fstab.tmp > /etc/fstab");
        $sshConnector->exec("echo -e \"## KISCLOUD ##\n" . $ip_nfsServer . ":" . $path . " /opt/KISCloud/nfs/ nfs defaults 1 1\n## END KISCLOUD ##\" >> /etc/fstab");
    }

    public function checkNFSFolder($ip, $ssh_username, $ssh_password, $ssh_fingerprint) {
        $sshConnector = new SSHConnector($ip, "22", $ssh_fingerprint);
        $sshConnector->connect_password($ssh_username, $ssh_password);


        $parserNFSFolder = new ParserNFSFolder($this->getCoreObject());
        $parserNFSFolder->setExec_output($sshConnector->exec("ls /opt/KISCloud/nfs/"));
        $parserNFSFolder->parseExec_output();
    }

    public function installNFSFolder($ip, $ssh_username, $ssh_password, $ssh_fingerprint) {
        $sshConnector = new SSHConnector($ip, "22", $ssh_fingerprint);
        $sshConnector->connect_password($ssh_username, $ssh_password);

        $sshConnector->exec("mkdir -p /opt/KISCloud/nfs/");
    }

    public function checkNFSMountPoint($ip, $ssh_username, $ssh_password, $ssh_fingerprint) {
        $sshConnector = new SSHConnector($ip, "22", $ssh_fingerprint);
        $sshConnector->connect_password($ssh_username, $ssh_password);


        $parserNFSMountPoint = new ParserNFSMountPoint($this->getCoreObject());
        $parserNFSMountPoint->setExec_output($sshConnector->exec("ls /opt/KISCloud/nfs/users"));
        $parserNFSMountPoint->parseExec_output();
    }

    public function mountNFSMountPoint($ip, $ssh_username, $ssh_password, $ssh_fingerprint) {
        $sshConnector = new SSHConnector($ip, "22", $ssh_fingerprint);
        $sshConnector->connect_password($ssh_username, $ssh_password);

        $sshConnector->exec("mount /opt/KISCloud/nfs/");
    }

    public function umountNFSMountPoint($ip, $ssh_username, $ssh_password, $ssh_fingerprint) {
        $sshConnector = new SSHConnector($ip, "22", $ssh_fingerprint);
        $sshConnector->connect_password($ssh_username, $ssh_password);

        $sshConnector->exec("umount /opt/KISCloud/nfs/");
    }

    public function checkNFSDisk($ip, $ssh_username, $ssh_password, $ssh_fingerprint) {
        $sshConnector = new SSHConnector($ip, "22", $ssh_fingerprint);
        $sshConnector->connect_password($ssh_username, $ssh_password);

        $parserCPUUsage = new ParserNFSDisk($this->getCoreObject());
        $parserCPUUsage->setExec_output($sshConnector->exec("df"));
        $parserCPUUsage->parseExec_output();
    }

}

?>
