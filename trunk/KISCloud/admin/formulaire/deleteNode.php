<?php

session_start();
if ((isset($_SESSION['login'])) && (!empty($_SESSION['login'])) && isset($_SESSION['status_user']) && ($_SESSION['status_user'] == "admin")) {
    include_once '../../include/global.php';

// Recuperation des variables envoyées par le client
    $id = $_POST["id_noeud"];

//connexion à la base  
// suppression de la base		
    $requetDeleteNode = $bdd->query("DELETE FROM NOEUD WHERE id_noeud='$id';");

    if ($requetDeleteNode) {
        echo 1;
    } else {
        echo 0;
    }

    $requetDeleteNode->closeCursor();
} else {
    header('Location: ../index.php');
}
?>