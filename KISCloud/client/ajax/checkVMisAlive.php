<?php
session_start();
include_once "../../include/global.php";

$id_vm=   $_POST['id'];

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
