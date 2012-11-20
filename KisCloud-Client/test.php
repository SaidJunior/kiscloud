<?php

$tableau_final=array();

$tableau1=  [1,"test1"];
array_push($tableau_final, $tableau1);

$tableau2= [2,"test2"];
array_push($tableau_final, $tableau2);

//boucle qui affiche
foreach ($tableau_final as $tab) {
    echo $tab[0];
    echo $tab[1];
    echo "</br>";
}


?>
