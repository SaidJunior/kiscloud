<?php
// Recuperation des variables envoyées par le client
	$id = $_POST["id_user_to_delete"];

	// envoi dans la base de données

	//connexion à la base
	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	$bdd = new PDO('mysql:host=localhost;dbname=KISCLOUD', 'root', 'p@ssw0rd', $pdo_options);
//	// suppression de la base		
	$requetDeleteUser = $bdd->query("DELETE FROM USERS WHERE id_user='$id';");

        if($requetDeleteUser){
            echo 1;
        }else{
            echo 0;
        }
        
        $requetDeleteUser->closeCursor();

?>
