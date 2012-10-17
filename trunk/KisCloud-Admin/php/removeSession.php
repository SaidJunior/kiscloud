<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();

if(isset($_POST['removeSession'])){
    $session = $_POST['removeSession'];
    if (isset($_SESSION['step_' . $session]) && isset($_SESSION['log_' . $session])) {
        unset($_SESSION['step_' . $session]);
        unset($_SESSION['log_' . $session]);
        unset($_SESSION['delegate_' . $session]);
        echo "ok";
    }
}

?>
