<?php
    $ip_NFS = $_POST["ip_NFS"];
    $path_NFS = $_POST["path_NFS"];
    

    
    //connexion à la base
	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	$bdd = new PDO('mysql:host=localhost;dbname=KISCLOUD', 'root', 'p@ssw0rd', $pdo_options);
	// selection de la base	

        if($bdd->lastInsertId() == '0'){
            $requetDeleteUser = $bdd->query("DELETE FROM NFS;");
            $requetAddNFS = $bdd->query("INSERT INTO NFS VALUES(default,'$ip_NFS','$path_NFS');");
            echo 'parameters were inserted in database';
            $requetDeleteUser->closeCursor();
            $requetAddNFS->closeCursor();    
        }
//        else{
// 
//            
//            $requetDeleteUser = $bdd->query("DELETE FROM NFS WHERE id_nfs='$id_lastNFS';");
//            $requetUpdateNFS = $bdd->query("INSERT INTO NFS VALUES(default,'$ip_NFS','$path_NFS');");
//            echo 'parameters were updated in database';
//            $requetDeleteUser->closeCursor();
//            $requetUpdateNFS->closeCursor();
//        }
//        
        

?>
