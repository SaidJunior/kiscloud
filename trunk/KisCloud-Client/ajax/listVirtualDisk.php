<?php
session_start();
// il faut trouver les disques virtuel disponible non encore rataché à une vm
include '../config.php';
//connexion à la base
$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$bdd = new PDO('mysql:host=localhost;dbname='.$bdd, $user_bdd, $user_bdd_password, $pdo_options);
//recup id user
$id_user=$_SESSION['id_user'];
//$id_user=1;
// requette de recup de tous les disques non rataché
$requet1 = $bdd->query("SELECT * FROM VIRTUAL_DISK where id_user ='$id_user' 
                        and id_virtual_disk not in (SELECT id_virtual_disk FROM VM_DISK); ");

// preparation d'un tableau de retour
$tableau_final=array();

//chaque reponse est ajoutée au tableau
while ($virtual_disk = $requet1->fetch()){
    $tab_temp[0]=$virtual_disk['id_virtual_disk'];
    $tab_temp[1]=$virtual_disk['nom_disk'];
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
