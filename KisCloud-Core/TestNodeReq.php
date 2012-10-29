<?php

include_once ("include/global.php");

$ip = "192.168.56.20";
$ssh_username = "root";
$ssh_password = "azerty";
$ssh_fingerprint = "91CD913E05C1D7B7B8B487CA74D9FEC7";

$node = new Node();
$nodeDelegate = new NodeDelegate($node);

$nodeDelegate->getNodeRequirement($ip, $ssh_username , $ssh_password);

echo "Ip: " . $node->getIp() . "<br />";
echo "SSH Fingerprint: " . $node->getSsh_fingerprint() . "<br />";
echo "SSH Username: " . $node->getSsh_username() . "<br />";

if ($node->getVtd_enabled()) {
    echo "VT-d enabled on this host with: " . $node->getVtd_type() . "<br />";
} else {
    echo "VT-d not active on this host...<br />";
}

if ($node->getValid_centos()) {
    echo "CentOS version: " . $node->getCentos_version() . "<br />";
} else {
    echo "No CentOS 6.x OS<br />";
}

if ($node->getArch64bit()) {
    echo "64 bit kernel supported: " . $node->getArch64bit() . "<br />";
} else {
    echo "64 bit kernel not supported<br />";
}

if ($node->getQemu_image()) {
    echo "Processor emulator 'Qemu' installed: " . $node->getQemu_image() . "<br />";
} else {
    echo "Processor emulator not found. Installing Missing Node Requirements...". "<br />";
    //Installing qemu hypervisor
    $nodeDelegate->installNodeRequirement($ip, $ssh_username , $ssh_password, $ssh_fingerprint);
    if ($node->getQemu_image()){
        echo "Done<br />";
    } else {
        echo "Failed<br />";
    }
}

if ($node->getRpcbind()) {
    echo "Rcpbind Installed: " . $node->getRpcbind() . "<br />";
} else {
    echo "Rcpbind not found. Installing Missing Node Requirements...". "<br />";
    //Installing qemu hypervisor
    $nodeDelegate->installNodeRequirement($ip, $ssh_username , $ssh_password, $ssh_fingerprint);
    if ($node->getRpcbind()){
        echo "Done<br />";
    } else {
        echo "Failed<br />";
    }
}

if ($node->getNfs_utils()) {
    echo "Nfs-utils Installed: " . $node->getNfs_utils() . "<br />";
} else {
    echo "Nfs-utils not found. Installing Missing Node Requirements...". "<br />";
    //Installing qemu hypervisor
    $nodeDelegate->installNodeRequirement($ip, $ssh_username , $ssh_password, $ssh_fingerprint);
    if ($node->getNfs_utils()){
        echo "Done<br />";
    } else {
        echo "Failed<br />";
    }
}

if ($node->getBridge_utils()) {
    echo "Bridge-utils Installed: " . $node->getBridge_utils() . "<br />";
} else {
    echo "Bridge-utils not found. Installing Missing Node Requirements...". "<br />";
    //Installing qemu hypervisor
    $nodeDelegate->installNodeRequirement($ip, $ssh_username , $ssh_password, $ssh_fingerprint);
    if ($node->getBridge_utils()){
        echo "Done<br />";
    } else {
        echo "Failed<br />";
    }
    
}

$nodeDelegate->checkRAMUsage($ip, $ssh_username , $ssh_password, $ssh_fingerprint);
echo "Memoire Total: " . $node->getRam_total() . "<br />";
//var_dump($node->getMemo_status());

$nodeDelegate->checkRAMUsage($ip, $ssh_username , $ssh_password, $ssh_fingerprint);
echo "Memoire Libre: " . $node->getRam_free() . "<br />";
?>
