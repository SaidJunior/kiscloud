<?php      
	// Recuperation des variables envoyées par le client
        $id =                   $_GET["id"];
	$login = 		$_GET["login"];
	$password=		$_GET["password"];
	$name=                  $_GET["name"];
	$firstname=             $_GET["firstname"];
	$mail=			$_GET["mail"];
	$status=		$_GET["status"];
      

        
	//***********************************
	// envoi dans la base de données
	//***********************************
	//connexion à la base
	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	$bdd = new PDO('mysql:host=localhost;dbname=KISCLOUD', 'root', 'p@ssw0rd', $pdo_options);
	// insertion		
	
        $requetModifyUser = $bdd->query("UPDATE USERS SET login_user=$login,mdp_user=$password,nom_user=$name,prenom_user=$firstname,mail_user=$mail,status_user=$status WHERE id_user=$id;");
        
        if($requetModifyUser){
            $id_nouveau = $bdd->lastInsertId();
            echo $id_nouveau;
        }else{
            echo 0;
        }
	$requetModifyUser->closeCursor();
	
?>
