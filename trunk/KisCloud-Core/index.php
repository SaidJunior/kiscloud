<?php

include_once ("include/global.php");

$node = new Node();
$nodeDelegate = new NodeDelegate($node);

$nodeDelegate->getNodeRequirement();

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

?>
