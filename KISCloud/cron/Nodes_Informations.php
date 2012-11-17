<?php

include_once '../include/global.php';

$requetListNode = $bdd->query("SELECT * FROM NOEUD; ");
while ($resultListNode = $requetListNode->fetch()) {
    $error = false;

    $node_id = $resultListNode['id_noeud'];
    $ip = $resultListNode['ip_noeud'];
    $ssh_username = $resultListNode['ssh_login_node'];
    $ssh_password = $resultListNode['ssh_password_node'];
    $ssh_fingerprint = $resultListNode['ssh_fingerprint'];

    $node = new Node();
    $nodeDelegate = new NodeDelegate($node);

    try {
        $nodeDelegate->getNodeInformations($ip, $ssh_username, $ssh_password, $ssh_fingerprint);
    } catch (Exception $e) {
        $error = true;
    }

    if (!$error) {
        $nodeDelegate->checkRAMUsage($ip, $ssh_username, $ssh_password, $ssh_fingerprint);
        $nodeDelegate->checkCPUUsage($ip, $ssh_username, $ssh_password, $ssh_fingerprint);
        $nodeDelegate->checkCPUInfo($ip, $ssh_username, $ssh_password, $ssh_fingerprint);

        $nodeDelegate->checkNFSMountPoint($ip, $ssh_username, $ssh_password, $ssh_fingerprint);
        if (!$node->getNfs_folder_mounted()) {
            $nodeDelegate->mountNFSMountPoint($ip, $ssh_username, $ssh_password, $ssh_fingerprint);
            $nodeDelegate->checkNFSMountPoint($ip, $ssh_username, $ssh_password, $ssh_fingerprint);
            if (!$node->getNfs_folder_mounted()) {
                $error = true;
            }
        }

        //update ram usage, etc..
        $bdd->query("UPDATE NOEUD SET ram_total='" . $node->getRam_total() . "', ram_free='" . $node->getRam_free() . "',  cpu_total='" . $node->getCpu_speed() . "', cpu_free='" . $node->getCpu_free() . "', centOS_version='" . $node->getCentos_version() . "', vtd_type='" . $node->getVtd_type() . "', nb_proc_noeud='" . $node->getCpu_nb() . "', status_node='UP' WHERE id_noeud='" . $node_id . "';");
    }

    if ($error) {
        //Switch node off
        $bdd->query("UPDATE NOEUD SET status_node='DOWN',  ram_free='???', cpu_free='???' WHERE id_noeud='" . $node_id . "';");
    }
}
?>
