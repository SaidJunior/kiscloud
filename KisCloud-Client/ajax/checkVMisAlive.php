<?php
session_start();
include '../config.php'; 

$id_vm=   $_POST['id'];

// connexion à la base
$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$bdd = new PDO('mysql:host=localhost;dbname='.$bdd, $user_bdd, $user_bdd_password, $pdo_options);

// recup des disk portant le meme nom pour cet user
$requet1 = $bdd->query("SELECT * FROM VM WHERE id_vm='$id_vm'");
$donnees = $requet1->fetch();
if($donnees['status']=="play"){
   //alors la vm est lancé. suppression impossible
   echo 0;
}else{
    //vm bien stopé
   echo 1;
}

?>
