<?php

include_once ("include/global.php");

$node = new Node();
$nodeDelegate = new NodeDelegate($node);

$nodeDelegate->getNodeRequirement("192.168.56.20", "root", "azerty");

echo "Ip: ".$node->getIp()."<br />";
echo "SSH Fingerprint: ".$node->getSsh_fingerprint()."<br />";
echo "SSH Username: ".$node->getSsh_username()."<br />";

if($node->getVtd_enabled()){
    echo "VT-d enabled on this host with: ".$node->getVtd_type()."<br />";
}else{
    echo "VT-d not active on this host...<br />";
}

if($node->getValid_centos()){
    echo "CentOS version: ".$node->getCentos_version()."<br />";
}else{
    echo "No CentOS 6.x OS<br />";
}

$disk = new Disk();
$diskDelegate = new DiskDelegate($disk);
$diskDelegate->createDisk("tata01", 20, "/tmp");

if($disk->getError()==false){
   echo "Disk '".$disk->getPath()."/".$disk->getName().".qcow2' created (".$disk->getSize()."G) !<br />";
}else{
    echo "Error when create Disk: ".$disk->getError_value()."<br />";
}

?>
