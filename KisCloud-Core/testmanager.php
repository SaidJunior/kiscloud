<?php

include_once ("include/global.php");

$ip = "127.0.0.1";
$ssh_username = "root";
$ssh_password = "azerty";
$ssh_fingerprint = "27C2CA58D4B66FF39C0E38BF4D5CD7B9";


$manager = new Manager();
$managerDelegate = new ManagerDelegate($manager);

$managerDelegate->checkNFSFolder($ip, $ssh_username, $ssh_password, $ssh_fingerprint);

if ($manager->getNfs_folder_created()) {
    echo "NFS folder configured<br />";
} else {
    echo "NFS folder not configured<br />";
    echo "Create NFS folder...";
    $managerDelegate->installNFSFolder($ip, $ssh_username, $ssh_password, $ssh_fingerprint);
    $managerDelegate->checkNFSFolder($ip, $ssh_username, $ssh_password, $ssh_fingerprint);
    if ($manager->getNfs_folder_created()) {
        echo "Done<br />";
    } else {
        echo "Failed<br />";
    }
}

$ip_nfsServer = "192.168.56.10";
$path = "/opt/KISStorage/";

$managerDelegate->checkNFSConfiguration($ip, $ssh_username, $ssh_password, $ssh_fingerprint, $ip_nfsServer, $path);
if ($manager->getNfs_configured()) {
    echo "NFS Configuration OK<br />";
} else {
    echo "NFS Not configured<br />";
    echo "Configure NFS...";
    $managerDelegate->installNFSConfiguration($ip, $ssh_username, $ssh_password, $ssh_fingerprint, $ip_nfsServer, $path);
    $managerDelegate->checkNFSConfiguration($ip, $ssh_username, $ssh_password, $ssh_fingerprint, $ip_nfsServer, $path);
    if ($manager->getNfs_configured()) {
        echo "Done<br />";
    } else {
        echo "Failed<br />";
    }
}

$managerDelegate->checkNFSMountPoint($ip, $ssh_username, $ssh_password, $ssh_fingerprint);
if ($manager->getNfs_folder_mounted()) {
    echo "NFS Folder mount OK<br />";
} else {
    echo "NFS Folder NOT mount<br />";
    echo "Mount NFS Folder...";
    $managerDelegate->mountNFSMountPoint($ip, $ssh_username, $ssh_password, $ssh_fingerprint);
    $managerDelegate->checkNFSMountPoint($ip, $ssh_username, $ssh_password, $ssh_fingerprint);
    if ($manager->getNfs_folder_mounted()) {
        echo "Done<br />";
    } else {
        echo "Failed<br />";
    }
}

$managerDelegate->checkNFSDisk($ip_nfsServer, $ssh_username, $ssh_password, $ssh_fingerprint);
echo "Total NFS disk space (Mo): " . $manager->getNfs_disk_size() . "<br />";
echo "Free NFS disk space (Mo): " . $manager->getNfs_disk_free() . "<br />";
?>
