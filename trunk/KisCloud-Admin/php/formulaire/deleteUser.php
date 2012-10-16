<?php
// Recuperation des variables envoyées par le client
	$id = $_POST["id_user_to_delete"];

	// envoi dans la base de données

	//connexion à la base
        include("../menu/connectDataBase.php");
        
	// suppression de la base		
	$requetDeleteUser = $bdd->query("DELETE FROM USERS WHERE id_user='$id';");

        if($requetDeleteUser){
            echo 1;
        }else{
            echo 0;
        }
        
        $requetDeleteUser->closeCursor();

?>
