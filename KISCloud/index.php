<?php
session_start();
//si la session existe on affiche la page
if ((isset($_SESSION['login'])) && (!empty($_SESSION['login'])) && isset($_SESSION['status_user']) && (!empty($_SESSION['status_user']))){
    
    if($_SESSION['status_user']=="admin"){
        header('Location: admin/index.php');  
    }else if($_SESSION['status_user']=="client"){
        header('Location: client/index.php');  
    }
    
}else{
    // pas de login en session : proposer la connexion
    header('Location: login.php');  
}

?>
