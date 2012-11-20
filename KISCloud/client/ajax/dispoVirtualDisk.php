<?php
session_start();
include_once "../../include/global.php"; 

$name =     $_POST['name'];
$id_user=   $_SESSION['id_user'];

// recup des disk portant le meme nom pour cet user
$requet1 = $bdd->prepare("SELECT * FROM VIRTUAL_DISK WHERE nom_disk='$name' AND id_user='$id_user'");
$requet1->execute();
$count = $requet1->rowCount();
// retourn le nombre de ligne trouvé. Si il y a une ligne alors le nom est prit
echo $count;


?>
