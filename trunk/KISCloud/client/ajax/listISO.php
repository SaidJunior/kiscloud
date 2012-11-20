<?php
session_start();
// il faut trouver les disques virtuel disponible non encore rataché à une vm
include_once "../../include/global.php"; 

//recup id user
$id_user=$_SESSION['id_user'];
//$id_user=1;
// requette de recup de tous les disques non rataché
$requet1 = $bdd->query("SELECT * FROM ISO where id_user ='$id_user'; ");

// preparation d'un tableau de retour
$tableau_final=array();

//chaque reponse est ajoutée au tableau
while ($iso = $requet1->fetch()){
    $tab_temp[0]=$iso['id_iso'];
    $tab_temp[1]=$iso['name_iso'];
    array_push($tableau_final, $tab_temp);
    
}

//envoi du tableau
echo json_encode($tableau_final);
//print_r($arr);
// test affichage valeur
//$sizeof_arr = sizeof($arr);
//for ($i=0; $i<$sizeof_arr; $i++) {
//    echo $arr[$i];
//}


?>
