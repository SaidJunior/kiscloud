<?php
include_once "../../include/global.php";

$id_vm=$_POST['id'];

// on verifieque la vm est lancée
$requet1 = $bdd->query("SELECT * FROM VM WHERE id_vm='$id_vm'");

$donnees=$requet1->fetch();
// on recup le status
$status= $donnees['status'];
if($status=="stop"){
    // retour a 0
    echo 0;
}else{
    echo $donnees['port_proxy'];
}


?>
