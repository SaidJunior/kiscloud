<?php
session_start();
include_once "../../include/global.php";  
// on recup le nom du fichier qui vient d'etre supprimé
$name_iso = $_POST['name'];
$id_user=   $_SESSION['id_user'];
//$name_iso = "Ubuntu.iso";
//$id_user='2';


// dans un premier temps on trouve l'id corespondant au fichier grace au now et à l'id user
$requet1 = $bdd->query("SELECT * FROM ISO where name_iso='$name_iso' and id_user='$id_user'");
$donnees=$requet1->fetch();
$id_iso= $donnees['id_iso'];

// recup des vm qui ont cette iso rattachée
$requet3= $bdd->query("SELECT * FROM VM where id_iso='$id_iso' and id_user='$id_user'");
// chaque entrée est mis à null
while ($vm = $requet3->fetch()){
    $id_vm=$vm['id_vm'];
    $requet4= $bdd->query("UPDATE VM SET id_iso=NULL WHERE id_user='$id_user' AND id_vm='$id_vm'");
 }

// suppression de l'iso dans la table ISO
$requet2 = $bdd->query("DELETE FROM ISO WHERE id_iso='$id_iso'");
 
// si tous c'est bien passé on envoi 1, 0 sinon
if ($requet1&&$requet2){
    //TODO ici appeler le script de clem pour supprimer le fichier
    echo 1;
}else{
    echo 0;
}

?>
