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

    public function getNodeRequirement() {
        $sshConnector = new SSHConnector("192.168.56.20", "22", null);
        $sshConnector->init_connection();
        $sshConnector->connect_password("root", "azerty");
        
        //Test VT-d
        $parserVTD = new ParserVTD($this->getCoreObject());
        $parserVTD->setExec_output($sshConnector->exec("grep -E 'svm|vmx' /proc/cpuinfo"));
        $parserVTD->parseExec_output();
        
        //Test CentOS
        $paserCentOS = new ParserCentOS($this->getCoreObject());
        $paserCentOS->setExec_output($sshConnector->exec("cat /etc/redhat-release"));
        $paserCentOS->parseExec_output();
    }

}

?>
