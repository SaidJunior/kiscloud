<?php

include_once ("../../include/global.php");

$ip = "192.168.56.20";
$ssh_username = "root";
$ssh_password = "azerty";
$ssh_fingerprint = "91CD913E05C1D7B7B8B487CA74D9FEC7";



$node = new Node();
$nodeDelegate = new NodeDelegate($node);

$nodeDelegate->checkNFSFolder($ip, $ssh_username, $ssh_password, $ssh_fingerprint);

if ($node->getNfs_folder_created()) {
    echo "NFS folder configured<br />";
} else {
    echo "NFS folder not configured<br />";
    echo "Create NFS folder...";
    $nodeDelegate->installNFSFolder($ip, $ssh_username, $ssh_password, $ssh_fingerprint);
    $nodeDelegate->checkNFSFolder($ip, $ssh_username, $ssh_password, $ssh_fingerprint);
    if ($node->getNfs_folder_created()) {
        echo "Done<br />";
    } else {
        echo "Failed<br />";
    }
}

$ip_nfsServer = "192.168.56.10";
$path = "/opt/KISStorage/";

$nodeDelegate->checkNFSConfiguration($ip, $ssh_username, $ssh_password, $ssh_fingerprint, $ip_nfsServer, $path);
if ($node->getNfs_configured()) {
    echo "NFS Configuration OK<br />";
} else {
    echo "NFS Not configured<br />";
    echo "Configure NFS...";
    $nodeDelegate->installNFSConfiguration($ip, $ssh_username, $ssh_password, $ssh_fingerprint, $ip_nfsServer, $path);
    $nodeDelegate->checkNFSConfiguration($ip, $ssh_username, $ssh_password, $ssh_fingerprint, $ip_nfsServer, $path);
    if ($node->getNfs_configured()) {
        echo "Done<br />";
    } else {
        echo "Failed<br />";
    }
}

$nodeDelegate->checkNFSMountPoint($ip, $ssh_username, $ssh_password, $ssh_fingerprint);
if ($node->getNfs_folder_mounted()) {
    echo "NFS Folder mount OK<br />";
} else {
    echo "NFS Folder NOT mount<br />";
    echo "Mount NFS Folder...";
    $nodeDelegate->mountNFSMountPoint($ip, $ssh_username, $ssh_password, $ssh_fingerprint);
    $nodeDelegate->checkNFSMountPoint($ip, $ssh_username, $ssh_password, $ssh_fingerprint);
    if ($node->getNfs_folder_mounted()) {
        echo "Done<br />";
    } else {
        echo "Failed<br />";
    }
}
?>
