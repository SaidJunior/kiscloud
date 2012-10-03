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
        $paserCentOS = new ParserCentOS($this->getCoreObject());
        $paserCentOS->setExec_output($sshConnector->exec("cat /etc/redhat-release"));
        $paserCentOS->parseExec_output();

        //Test x86_64
        //Test RPCBind
        //Test nfs-utils
        //Test 
    }

    public function installNodeRequirement($ip, $ssh_username, $ssh_password, $ssh_fingerprint) {
        $sshConnector = new SSHConnector($ip, "22", $ssh_fingerprint);
        $sshConnector->connect_password($ssh_username, $ssh_password);

        //need to complete with qemu hypervisor
        //yum install -y nfs-utils rpcbind qemu-img
    }

    public function checkNFSConfiguration($ip, $ssh_username, $ssh_password, $ssh_fingerprint, $ip_manager, $path) {
        $sshConnector = new SSHConnector($ip, "22", $ssh_fingerprint);
        $sshConnector->connect_password($ssh_username, $ssh_password);

        //cat /etc/fstab
        $paserNFSConf = new ParserNFSConfiguration($this->getCoreObject(), $ip_manager, $path);
        $paserNFSConf->setExec_output($sshConnector->exec("cat /etc/fstab"));
        $paserNFSConf->parseExec_output();

    }

    public function installNFSConfiguration($ip, $ssh_username, $ssh_password, $ssh_fingerprint) {
        $sshConnector = new SSHConnector($ip, "22", $ssh_fingerprint);
        $sshConnector->connect_password($ssh_username, $ssh_password);

        

    }

    public function checkNFSFolder($ip, $ssh_username, $ssh_password, $ssh_fingerprint) {
        $sshConnector = new SSHConnector($ip, "22", $ssh_fingerprint);
        $sshConnector->connect_password($ssh_username, $ssh_password);
        
        
        $paserNFSFolder = new ParserNFSFolder($this->getCoreObject());
        $paserNFSFolder->setExec_output($sshConnector->exec("ls /opt/KISCloud/nfs/"));
        $paserNFSFolder->parseExec_output();

    }

    public function installNFSFolder($ip, $ssh_username, $ssh_password, $ssh_fingerprint) {
        $sshConnector = new SSHConnector($ip, "22", $ssh_fingerprint);
        $sshConnector->connect_password($ssh_username, $ssh_password);

        $sshConnector->exec("mkdir -p /opt/KISCloud/nfs/");
    }

}

?>
