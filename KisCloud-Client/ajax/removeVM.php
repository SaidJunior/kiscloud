<?php
include '../config.php'; 
// on recup l'id BDD de la sauvegarde à effectuer et du booleen de delete   
$id_vm =        $_POST['id'];
$deleteDisk=    $_POST['deleteDisk'];

// connexion à la base
$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$bdd = new PDO('mysql:host=localhost;dbname='.$bdd, $user_bdd, $user_bdd_password, $pdo_options);
//si le booleen est a 1 alors on a demandé a supprimer également le disk.
// on recupere son id pour la suppresion plus tard
if($deleteDisk==1){
   $requet0 = $bdd->query("SELECT * FROM VM_DISK where id_vm ='$id_vm'; ");
   $donnees = $requet0->fetch();
   $id_disk=$donnees['id_virtual_disk']; 
}

// suppresion des ligne dans la table VM_DISK
$requet1 = $bdd->query("DELETE FROM VM_DISK where id_vm='$id_vm'");

// suppression de la vm
$requet2 = $bdd->query("DELETE FROM VM where id_vm='$id_vm'");
// TODO: ajouter ici script clem sup VM

//si le booleen est a un alors on supprime également le disque
if($deleteDisk==1){
   $requet3 = $bdd->query("DELETE FROM VIRTUAL_DISK where id_virtual_disk='$id_disk'"); 
   // TODO: ajouter script clem pour suppresion physique du disk
}

// si tous c'est bien passé on envoi 1, 0 sinon
if ($requet1&&$requet2){
    //TODO ici appeler le script de clem
    echo 1;
}else{
    echo 0;
}

?>
