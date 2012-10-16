<?php

    $login_Manager = $_POST["login_Manager"];
    $password_Manager = $_POST["password_Manager"];
 
//      //connexion à la base
        include("../menu/connectDataBase.php");
       

           $requeteDeleteManager = $bdd->query("use KISCLOUD; SET SQL_SAFE_UPDATES=0; Delete from MANAGER ;");
           $requeteDeleteManager->closeCursor();
           
           $requetAddManager = $bdd->query("INSERT INTO MANAGER VALUES(default, null,'$login_Manager','$password_Manager');");
           $requetAddManager->closeCursor();
           echo '<div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    Manager parameters were inserted in database
                </div>';
?>
