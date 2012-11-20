<?php
session_start();    // on a besoin de la session pour connaitre l'id du pelo et son login
include_once "../../include/global.php"; 

// on recup l'id BDD de la sauvegarde à effectuer et du booleen de delete   
$size =     $_POST['size'];
$name =     $_POST['name'];
$id_user=   $_SESSION['id_user'];
$login=     $_SESSION['login'];

// suppression du disk
$requet1 = $bdd->query("INSERT INTO VIRTUAL_DISK VALUES (default,'$name','$size','/home/Vdrive/$name','$id_user')");

// si tous c'est bien passé on envoi l'id BDD de la derniere insertion, 0 sinon
if ($requet1){
    //TODO ici appeler le script de clem pour creer le dossier user et le disque
    echo $bdd->lastInsertId('VIRTUAL_DISK');;
}else{
    echo 0;
}

?>
