<?php
session_start();    // on a besoin de la session pour connaitre l'id du pelo et son login
include_once "../../include/global.php";

// on recup l'id BDD de la sauvegarde à effectuer et du booleen de delete   
$id_vm=$_POST['id'];
$id_user=$_SESSION['id_user'];

// suppression du disk
$requet1 = $bdd->query("SELECT v.nom_vm, v.systeme, v.nb_processeur_vm, v.ram_vm, vd.nom_disk, vd.path_nas_virtual_disk, i.name_iso
FROM VM_DISK d JOIN VIRTUAL_DISK vd ON d.id_virtual_disk=vd.id_virtual_disk
JOIN VM v ON d.id_vm=v.id_vm
JOIN ISO i ON v.id_iso=i.id_iso");

// si tous c'est bien passé on envoi l'id BDD de la derniere insertion, 0 sinon
if ($requet1){
    //TODO ici appeler le script de clem pour creer le dossier user et le disque
    echo 1;
}else{
    echo 0;
}
?>
