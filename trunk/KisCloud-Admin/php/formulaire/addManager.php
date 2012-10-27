<?php

//Include
include_once '../../../core/include/global.php';
//connexion à la base
include("../menu/connectDataBase.php");

if (isset($_POST["login_Manager"]) && isset($_POST["password_Manager"])) {
    //post
    $ssh_username = htmlentities($_POST["login_Manager"]);
    $ssh_password = htmlentities($_POST["password_Manager"]);

    $error = false;
    $JS_LOAD = "<script type=\"text/javascript\">$('#consoleConfManager').html('";

    $manager = new Manager();
    $managerDelegate = new ManagerDelegate($manager);

    try {
        $managerDelegate->getManagerRequirement("127.0.0.1", $ssh_username, $ssh_password);
    } catch (Exception $e) {
        $error = true;
        //$JS_LOAD .= "<div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>Exception reçue : " . $e->getMessage() . "</div>";
        $JS_LOAD .= "<div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>Unable to connect. Please verify your login/password</div>";
    }

    if (!$error) {
        
        $ssh_fingerprint = $manager->getSsh_fingerprint();
        //SQL
        $requeteDeleteManager = $bdd->query("use KISCLOUD; SET SQL_SAFE_UPDATES=0; Delete from MANAGER ;");
        $requeteDeleteManager->closeCursor();

        $requetAddManager = $bdd->query("INSERT INTO MANAGER VALUES(default, '$ssh_fingerprint','$ssh_username','$ssh_password');");
        $requetAddManager->closeCursor();

        $JS_LOAD .= "<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>Manager is configured correctly.</div>";
    }

    $JS_LOAD .= "');</script>";
    echo $JS_LOAD;
}
?>
