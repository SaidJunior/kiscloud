<?php
    $ip_NFS = $_POST["ip_NFS"];
    $path_NFS = $_POST["path_NFS"];
    
    
    //connexion à la base
        include("../menu/connectDataBase.php");


            $requetDeleteNFS = $bdd->query("DELETE FROM NFS;");
            $requetAddNFS = $bdd->query("INSERT INTO NFS VALUES(default,'$ip_NFS','$path_NFS');");
            echo '<div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    NFS parameters were inserted in database
                </div>';
            $requetDeleteNFS->closeCursor();
            $requetAddNFS->closeCursor();           
?>
