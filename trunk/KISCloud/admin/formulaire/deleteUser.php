<?php

session_start();
if ((isset($_SESSION['login'])) && (!empty($_SESSION['login'])) && isset($_SESSION['status_user']) && ($_SESSION['status_user'] == "admin")) {
    include_once '../../include/global.php';

//connexion à la base
// Recuperation des variables envoyées par le client
    $id = $_POST["id_user_to_delete"];

    if ($id != 1) {
// suppression de la base
        $requetDeleteUser = $bdd->query("DELETE FROM USERS WHERE id_user='$id';");

        if ($requetDeleteUser) {

            $user = new User();
            $userDelegate = new UserDelegate($user);
            /////////////////////////////////////////////////
            // Requete SQL Vers Manager Delete des dossiers
            /////////////////////////////////////////////////
            $requestManager = $bdd->query("SELECT * FROM MANAGER;"); // requete pour recup le nombre de manager
            $resultManager = $requestManager->fetch();
            $login_sshManager = $resultManager['ssh_login_manager'];
            $password_sshManager = $resultManager['ssh_password'];
            $fingerPrint_sshManager = $resultManager['ssh_finger_print'];
            $ip = "127.0.0.1";

            $userDelegate->checkUserFolder($ip, $login_sshManager, $password_sshManager, $fingerPrint_sshManager, $id);
            if ($user->getUser_folder_created()) {
                $userDelegate->deleteUserFolder($ip, $login_sshManager, $password_sshManager, $fingerPrint_sshManager, $id, $PATH_FILE);
                $userDelegate->checkUserFolder($ip, $login_sshManager, $password_sshManager, $fingerPrint_sshManager, $id);
                if (!$user->getUser_folder_created()) {
                    echo 1;
                } else {
                    //delete trop long :P
                }
            }
        } else {
            echo 0;
        }
        $requetDeleteUser->closeCursor();
    } else {
        echo -1;
    }
} else {
    header('Location: ../index.php');
}
?>