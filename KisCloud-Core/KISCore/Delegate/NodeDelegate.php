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
class NodeDelegate extends KisCore {

    //put your code here

    public function __construct($coreObject) {
        parent::__construct($coreObject);
    }

    public function getNodeRequirement($ip, $ssh_username, $ssh_password) {

        $this->getCoreObject()->setIp($ip);
        $this->getCoreObject()->setSsh_username($ssh_username);
        $this->getCoreObject()->setSsh_password($ssh_password);


        $sshConnector = new SSHConnector($ip, "22", null);
        $sshConnector->init_connection();

        $this->getCoreObject()->setSsh_fingerprint($sshConnector->getSsh_server_fp());

        $sshConnector->connect_password($ssh_username, $ssh_password);

        //Test VT-d
        $parserVTD = new ParserVTD($this->getCoreObject());
        //$parserVTD->setExec_output($sshConnector->exec("grep -E 'svm|vmx' /proc/cpuinfo"));
        $parserVTD->setExec_output($sshConnector->exec("cat /proc/cpuinfo"));
        $parserVTD->parseExec_output();

        //Test CentOS
        $parserCentOS = new ParserCentOS($this->getCoreObject());
        $parserCentOS->setExec_output($sshConnector->exec("cat /etc/redhat-release"));
        $parserCentOS->parseExec_output();

        //Test x86_64
        $parserArch64 = new ParserArch64($this->getCoreObject());
        $parserArch64->setExec_output($sshConnector->exec("uname -a"));
        $parserArch64->parseExec_output();

        
        //Test nfs-utils
        $parserNfsUtils = new ParserNfsUtils($this->getCoreObject());
        $parserNfsUtils->setExec_output($sshConnector->exec("rpm -qa"));
        $parserNfsUtils->parseExec_output();
        
        //Bridge-utils
        $parserBridgeUtils = new ParserBridgeUtils($this->getCoreObject());
        $parserBridgeUtils->setExec_output($sshConnector->exec("rpm -qa"));
        $parserBridgeUtils->parseExec_output();
        
        
        //Test qemu-image
        $parserQemuImg = new ParserQemuImage($this->getCoreObject());
        $parserQemuImg->setExec_output($sshConnector->exec("rpm -qa"));
        $parserQemuImg->parseExec_output();
        
        //Test rpcbind
        $parserRpcbind = new ParserRpcbind($this->getCoreObject());
        $parserRpcbind->setExec_output($sshConnector->exec("rpm -qa"));
        $parserRpcbind->parseExec_output();
    }

    public function installNodeRequirement($ip, $ssh_username, $ssh_password, $ssh_fingerprint) {
        $sshConnector = new SSHConnector($ip, "22", $ssh_fingerprint);
        $sshConnector->connect_password($ssh_username, $ssh_password);
        //need to complete with qemu hypervisor
        //add the bridge-utils install commande
        //yum install -y nfs-utils rpcbind qemu-img
        $sshConnector->exec("yum install -y nfs-utils rpcbind qemu-img");
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

}

?>
