<?php

include_once '../../../core/include/global.php';
//connexion à la base
include("../menu/connectDataBase.php");

// Recuperation des variables envoyées par le client
$login = $_POST["login"];
$password = $_POST["password"];
$name = $_POST["name"];
$firstname = $_POST["firstname"];
$mail = $_POST["mail"];
$status = $_POST["status"];

// insertion		
$requetAddUser = $bdd->query("INSERT INTO USERS VALUES(default,'$login','$password','$name','$firstname','$mail','$status',null);");

if ($requetAddUser) {
    $id_nouveau = $bdd->lastInsertId();
    $requetAddUser->closeCursor();

    $user = new User();
    $userDelegate = new UserDelegate($user);

    ////////////////////////////
    // Requete SQL Vers Manager
    ////////////////////////////
    $requestManager = $bdd->query("SELECT * FROM MANAGER;"); // requete pour recup le nombre de manager
    $resultManager = $requestManager->fetch();
    $login_sshManager = $resultManager['ssh_login_manager'];
    $password_sshManager = $resultManager['ssh_password'];
    $fingerPrint_sshManager = $resultManager['ssh_finger_print'];
    $ip = "127.0.0.1";

    $userDelegate->checkUserFolder($ip, $login_sshManager, $password_sshManager, $fingerPrint_sshManager, $id_nouveau);
    if (!$user->getUser_folder_created()) {
        $userDelegate->createUserFolder($ip, $login_sshManager, $password_sshManager, $fingerPrint_sshManager, $id_nouveau);
        $userDelegate->checkUserFolder($ip, $login_sshManager, $password_sshManager, $fingerPrint_sshManager, $id_nouveau);
        if ($user->getUser_folder_created()) {
            echo $id_nouveau;
        } else {
            //Delete last ID
            //Return error
        }
    } else {
        echo $id_nouveau;
    }
} else {
    echo 0;
}
?>

