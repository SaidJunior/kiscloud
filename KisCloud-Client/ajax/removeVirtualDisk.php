<?php
include '../config.php'; 
// on recup l'id BDD de la sauvegarde à effectuer et du booleen de delete   
$id_disk = $_POST['id'];

// connexion à la base
$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$bdd = new PDO('mysql:host=localhost;dbname='.$bdd, $user_bdd, $user_bdd_password, $pdo_options);

// suppression du disk
$requet1 = $bdd->query("DELETE FROM VIRTUAL_DISK where id_virtual_disk='$id_disk'");

// si tous c'est bien passé on envoi 1, 0 sinon
if ($requet1){
    //TODO ici appeler le script de clem
    echo 1;
}else{
    echo 0;
}

?>
