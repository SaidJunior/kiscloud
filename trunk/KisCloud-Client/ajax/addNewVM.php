<?php
session_start();    // on a besoin de la session pour connaitre l'id du pelo et son login
include '../config.php'; 

// recup des données envoyé parle client
$id_user=   $_SESSION['id_user'];
$systeme=   $_POST['systeme'];
$name_vm=   $_POST['name_vm'];
$nb_proc=   $_POST['nb_proc'];
$memory=    $_POST['memory'];
$vDisk=     $_POST['vDisk'];
$iso=       $_POST['iso'];

// connexion à la base
$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$bdd = new PDO('mysql:host=localhost;dbname='.$bdd, $user_bdd, $user_bdd_password, $pdo_options);

// ajout de la vm
$requet1 = $bdd->query("INSERT INTO VM VALUES (default,'$name_vm','$systeme','stop','$nb_proc','$memory',100,NULL,NULL,'$id_user',NULL,$iso)");
// recup du dernier id
$id_new_vm= $bdd->lastInsertId('VM');
//ajout du disk
$requet2 = $bdd->query("INSERT INTO VM_DISK VALUES ('$vDisk','$id_new_vm')");

// si tous c'est bien passé on envoi l'id BDD de la derniere insertion, 0 sinon
if ($requet1 && $requet2){
    //TODO ici appeler le script de clem pour creer le dossier user et le disque
    echo $id_new_vm;
}else{
    echo 0;
}

?>

