<?php

include_once ("include/global.php");

$ip="192.168.56.20";
$ssh_username="root";
$ssh_password="azerty";
$ssh_fingerprint="91CD913E05C1D7B7B8B487CA74D9FEC7";



$node = new Node();
$nodeDelegate = new NodeDelegate($node);

$nodeDelegate->checkNFSFolder($ip, $ssh_username, $ssh_password, $ssh_fingerprint);

if($node->getNfs_folder_created()){
    echo "NFS folder configured<br />";
}else{
    echo "NFS folder not configured<br />";
    echo "Create NFS folder...";
    $nodeDelegate->installNFSFolder($ip, $ssh_username, $ssh_password, $ssh_fingerprint);
    $nodeDelegate->checkNFSFolder($ip, $ssh_username, $ssh_password, $ssh_fingerprint);
    if($node->getNfs_folder_created()){
        echo "Done<br />";
    }else{
        echo "Failed<br />";
    }
}

?>
