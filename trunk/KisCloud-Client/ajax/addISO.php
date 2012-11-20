<?php
session_start();    // on a besoin de la session pour connaitre l'id du pelo et son login
include '../config.php'; 

// on recup l'id BDD de la sauvegarde à effectuer et du booleen de delete   
$name_iso=$_POST['name'];
$id_user=   $_SESSION['id_user'];


// connexion à la base
$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$bdd = new PDO('mysql:host=localhost;dbname='.$bdd, $user_bdd, $user_bdd_password, $pdo_options);

// suppression du disk
$requet1 = $bdd->query("INSERT INTO ISO VALUES (default,'$name_iso','-','$id_user')");

// si tous c'est bien passé on envoi l'id BDD de la derniere insertion, 0 sinon
if ($requet1){
    //TODO ici appeler le script de clem pour creer le dossier user et le disque
    echo 1;
}else{
    echo 0;
}

?>
