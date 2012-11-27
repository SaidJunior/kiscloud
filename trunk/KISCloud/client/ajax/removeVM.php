<?php

include_once "../../include/global.php";
// on recup l'id BDD de la sauvegarde à effectuer et du booleen de delete   
$id_vm = $_POST['id'];
$deleteDisk = $_POST['deleteDisk'];

//si le booleen est a 1 alors on a demandé a supprimer également le disk.
// on recupere son id pour la suppresion plus tard
if ($deleteDisk == 1) {
    $requet0 = $bdd->query("SELECT * FROM VM_DISK where id_vm ='$id_vm'; ");
    $donnees = $requet0->fetch();
    $id_disk = $donnees['id_virtual_disk'];
}

// suppresion des ligne dans la table VM_DISK
$requet1 = $bdd->query("DELETE FROM VM_DISK where id_vm='$id_vm'");

// suppression de la vm
$requet2 = $bdd->query("DELETE FROM VM where id_vm='$id_vm'");
// TODO: ajouter ici script clem sup VM
//si le booleen est a un alors on supprime également le disque
if ($deleteDisk == 1) {
    // TODO: ajouter script clem pour suppresion physique du disk
    $requestDisk = $bdd->query('SELECT * FROM VIRTUAL_DISK WHERE id_virtual_disk=' . $id_disk . ';');
    $resultDisk = $requestDisk->fetch();
    $disk_name = $resultDisk['nom_disk'];
    $disk_path = $resultDisk['path_nas_virtual_disk'];

    $requestManager = $bdd->query("SELECT * FROM MANAGER;"); // requete pour recup le nombre de manager
    $resultManager = $requestManager->fetch();
    $ssh_username = $resultManager['ssh_login_manager'];
    $ssh_password = $resultManager['ssh_password'];
    $ssh_fingerprint = $resultManager['ssh_finger_print'];
    $ip = "127.0.0.1";
    $disk = new Disk();
    $diskDelegate = new DiskDelegate($disk);
    $diskDelegate->deleteDisk($ip, $ssh_username, $ssh_password, $ssh_fingerprint, $disk_name, $disk_path);
    $diskDelegate->diskFileCreated($ip, $ssh_username, $ssh_password, $ssh_fingerprint, $disk_name, $disk_path);
    if (!$disk->getDisk_file_created()) {
        $requet3 = $bdd->query("DELETE FROM VIRTUAL_DISK where id_virtual_disk='$id_disk'");
    }
}

// si tous c'est bien passé on envoi 1, 0 sinon
if ($requet1 && $requet2 && $requet3) {
    echo 1;
} else {
    echo 0;
}
?>
