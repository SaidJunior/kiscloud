<?php
session_start(); // On démarre la session AVANT toute chose
include_once 'include/global.php';
// récupération des element envoyés par le client
$login = htmlentities($_POST["login"]);
$password = htmlentities($_POST["password"]);

// requette de recherche de l'user		
$requet1 = $bdd->query("SELECT * FROM USERS WHERE login_user='$login' AND mdp_user='$password'; ");

//on stocke les données
$donnees = $requet1->fetch();

// on ferme la connexion à la BDD
$requet1->closeCursor();

//traitement
if(($_POST["login"]==$donnees['login_user'])&&($_POST["password"])==$donnees['mdp_user']){
    //creation de la session
    $_SESSION['login'] = $donnees['login_user'];
    $_SESSION['id_user'] = $donnees['id_user'];
    $_SESSION['status_user'] = $donnees['status_user'];
    
    echo $donnees['status_user']; //login ok
    
}else{
    echo 0; // acces refusé
    
}


?>
