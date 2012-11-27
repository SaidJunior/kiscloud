<?php

session_start();    // on a besoin de la session pour connaitre l'id du pelo et son login
include_once "../../include/global.php";

// on recup l'id BDD de la sauvegarde à effectuer et du booleen de delete   
$size = $_POST['size'];
$name = $_POST['name'];
$id_user = $_SESSION['id_user'];
$login = $_SESSION['login'];

$path_Disk = "/opt/KISCloud/nfs/users/$id_user/disks/";

//TODO ici appeler le script de clem pour creer le dossier user et le disque
$requestManager = $bdd->query("SELECT * FROM MANAGER;"); // requete pour recup le nombre de manager
$resultManager = $requestManager->fetch();
$ssh_username = $resultManager['ssh_login_manager'];
$ssh_password = $resultManager['ssh_password'];
$ssh_fingerprint = $resultManager['ssh_finger_print'];
$ip = "127.0.0.1";
$disk = new Disk();
$diskDelegate = new DiskDelegate($disk);
$diskDelegate->createDisk($ip, $ssh_username, $ssh_password, $ssh_fingerprint, $name, $size, $path_Disk);
$diskDelegate->diskFileCreated($ip, $ssh_username, $ssh_password, $ssh_fingerprint, $name, $path_Disk);
if ($disk->getDisk_file_created()) {
    // Ajout du disk
    $requet1 = $bdd->query("INSERT INTO VIRTUAL_DISK VALUES (default,'$name','$size','$path_Disk','$id_user')");

    // si tous c'est bien passé on envoi l'id BDD de la derniere insertion, 0 sinon
    if ($requet1) {
        echo $bdd->lastInsertId('VIRTUAL_DISK');
    } else {
        echo 0;
    }
} else {
    echo "-1";
}
?>
