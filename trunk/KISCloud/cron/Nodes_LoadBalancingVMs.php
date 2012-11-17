<?php

include_once '../include/global.php';

$requetListNode = $bdd->query("SELECT * FROM NOEUD WHERE status_node='DOWN';");
while ($resultListNode = $requetListNode->fetch()) {
    $error = false;
    $node_id = $resultListNode['id_noeud'];

    //Foreach VMS on this node
    //{
    
        //Select another node UP
    
        //Start VM on this node
    
    //}
    
}


?>
