<?php      
	// Recuperation des variables envoyées par le client
	$login = $_POST["login"];
	$password= $_POST["password"];
	$name= $_POST["name"];
	$firstname= $_POST["firstname"];
	$mail= $_POST["mail"];
	$status= $_POST["status"];

	// envoi dans la base de données

	//connexion à la base
	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	$bdd = new PDO('mysql:host=localhost;dbname=KISCLOUD', 'root', 'p@ssw0rd', $pdo_options);
//	// insertion		
	$requetAddUser = $bdd->query("INSERT INTO USERS VALUES(default,'$login','$password','$name','$firstname','$mail','$status',null);");

        if($requetAddUser){
            $id_nouveau = $bdd->lastInsertId();
            echo $id_nouveau;
        }else{
            echo 0;
        }
        
        $requetAddUser->closeCursor();
	
?>

