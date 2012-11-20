<?php

include_once '../include/global.php';

$requetListNode = $bdd->query("SELECT * FROM MANAGER;");
$resultListNode = $requetListNode->fetch();
$error = false;

$node_id = $resultListNode['id_manager'];
$ip = "127.0.0.1";
$ssh_username = $resultListNode['ssh_login_manager'];
$ssh_password = $resultListNode['ssh_password'];
$ssh_fingerprint = $resultListNode['ssh_finger_print'];

$manager = new Manager();
$managerDelegate = new ManagerDelegate($manager);

$managerDelegate->checkNFSMountPoint($ip, $ssh_username, $ssh_password, $ssh_fingerprint);
if(!$manager->getNfs_folder_mounted()){
    $managerDelegate->mountNFSMountPoint($ip, $ssh_username, $ssh_password, $ssh_fingerprint);
}
if($manager->getNfs_folder_mounted()){
    $managerDelegate->checkNFSDisk($ip, $ssh_username, $ssh_password, $ssh_fingerprint);
    $disk_size = $manager->getNfs_disk_size();
    $disk_free = $manager->getNfs_disk_free();   
    
    $requetListNode = $bdd->query("UPDATE NFS SET disk_used_nfs='".$disk_size."', disk_free_nfs='".$disk_free."' WHERE ip_nfs='".$ip."';");
}


