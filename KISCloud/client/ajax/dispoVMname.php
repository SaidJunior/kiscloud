<?php
session_start();
include_once "../../include/global.php";

$name =     $_POST['vmname'];
$id_user=   $_SESSION['id_user'];

// recup des disk portant le meme nom pour cet user
$requet1 = $bdd->prepare("SELECT * FROM VM WHERE nom_vm='$name' AND id_user='$id_user'");
$requet1->execute();
$count = $requet1->rowCount();
// retourn le nombre de ligne trouvé. Si il y a une ligne alors le nom est prit
echo $count;

?>
