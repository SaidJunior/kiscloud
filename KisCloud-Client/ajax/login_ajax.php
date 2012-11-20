<?php
session_start(); // On démarre la session AVANT toute chose
// récupération des element envoyés par le client
$login =    $_POST["login"];
$password = $_POST["password"];

//connexion à la base
$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$bdd = new PDO('mysql:host=localhost;dbname=KISCLOUD', 'kiscloud', 'p@ssw0rd', $pdo_options);


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
    echo $donnees['status_user']; //login ok
    
}else{
    echo 0; // acces refusé
    
}


?>
