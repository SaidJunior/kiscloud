<?php

session_start();
if ((isset($_SESSION['login'])) && (!empty($_SESSION['login'])) && isset($_SESSION['status_user']) && ($_SESSION['status_user'] == "admin")) {
    ?>

    <p>Section VM Users.</p>				         

    <?php

} else {
    header('Location: ../index.php');
}
?>