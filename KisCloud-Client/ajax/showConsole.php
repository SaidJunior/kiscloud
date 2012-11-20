<?php
include '../config.php'; 

$id_vm=     $_POST['id'];

// connexion à la base
$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$bdd = new PDO('mysql:host=localhost;dbname='.$bdd, $user_bdd, $user_bdd_password, $pdo_options);

// on verifieque la vm est lancée
$requet1 = $bdd->query("SELECT * FROM VM WHERE id_vm='$id_vm'");

$donnees=$requet1->fetch();
// on recup le status
$status= $donnees['status'];
if($status=="off"){
    // retour a 0
    echo 0;
}else{
    $port_proxy=$donnees['port_proxy'];
    echo $port_proxy;
}


?>
