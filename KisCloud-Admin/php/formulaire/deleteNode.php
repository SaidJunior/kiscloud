<?php

// Recuperation des variables envoyées par le client
	$id = $_POST["id_noeud"];

	//connexion à la base
        include("../menu/connectDataBase.php");
        
        // suppression de la base		
	$requetDeleteNode = $bdd->query("DELETE FROM NOEUD WHERE id_noeud='$id';");

        if($requetDeleteNode){
            echo 1;
        }else{
            echo 0;
        }
        
        $requetDeleteNode->closeCursor();


?>
