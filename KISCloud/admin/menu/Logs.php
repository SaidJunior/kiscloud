<?php
session_start();
if ((isset($_SESSION['login'])) && (!empty($_SESSION['login'])) && isset($_SESSION['status_user']) && ($_SESSION['status_user'] == "admin")) {
    ?>
    <!-- Partie Logs -->

    <p>Section Logs.</p>

    <?php
} else {
    header('Location: ../index.php');
}
?>