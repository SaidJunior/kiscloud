<?php

include_once "../../include/global.php";
// on recup l'id BDD de la sauvegarde à effectuer et du booleen de delete   
$id_disk = $_POST['id'];

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
// suppression du disk
    $requet1 = $bdd->query("DELETE FROM VIRTUAL_DISK where id_virtual_disk='$id_disk'");

// si tous c'est bien passé on envoi 1, 0 sinon
    if ($requet1) {
        //TODO ici appeler le script de clem
        echo 1;
    } else {
        echo 0;
    }
}else{
    echo 0;
}
?>
