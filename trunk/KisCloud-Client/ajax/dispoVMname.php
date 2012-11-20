<?php
session_start();
include '../config.php'; 

$name =     $_POST['vmname'];
$id_user=   $_SESSION['id_user'];

// connexion à la base
$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$bdd = new PDO('mysql:host=localhost;dbname='.$bdd, $user_bdd, $user_bdd_password, $pdo_options);

// recup des disk portant le meme nom pour cet user
$requet1 = $bdd->prepare("SELECT * FROM VM WHERE nom_vm='$name' AND id_user='$id_user'");
$requet1->execute();
$count = $requet1->rowCount();
// retourn le nombre de ligne trouvé. Si il y a une ligne alors le nom est prit
echo $count;

?>
