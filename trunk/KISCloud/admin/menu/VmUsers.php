<?php

session_start();
if ((isset($_SESSION['login'])) && (!empty($_SESSION['login'])) && isset($_SESSION['status_user']) && ($_SESSION['status_user'] == "admin")) {
    include_once '../../include/global.php';
    ?>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<link rel="shortcut icon" type="image/ico" href="http://www.datatables.net/favicon.ico" />
		
		<style type="text/css" title="currentStyle">
                    @import "../css/datatables/demo_page.css";
                    @import "../css/datatables/demo_table.css";
		</style>
		<script type="text/javascript" language="javascript" src="../../js/datatables/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="../../js/datatables/jquery.dataTables.js"></script>

<table cellpadding="0" cellspacing="0" border="0" class="display" id="listVM" width="90%">
	<thead>
		<tr>
                    <th>Name's User</th>
                    <th>FirstName's User</th>
                    <th>VM's name</th>
                    <th>OS</th>
                    <th>RAM</th>
                    <th>Size's disk</th>
                    <th>node</th>
                    <th>CPU</th>    
		</tr>
	</thead>
	<tbody>
         <?php
         
        $requetListVM = $bdd->query("Select * From VM INNER JOIN ISO ON VM.id_iso = ISO.id_iso 
                 INNER JOIN NOEUD ON VM.id_noeud = NOEUD.id_noeud
                 INNER JOIN USERS ON VM.id_user = USERS.id_user; "); // requette pour recup la liste des utilisateurs
 
         while ($resultListVM = $requetListVM->fetch()) {// pour chaque ligne de la reponse
            ?> 
  
            <tr>
                <td class="center"><?php echo $resultListVM['nom_user']; ?></td>
                <td class="center"><?php echo $resultListVM['prenom_user']; ?></td>
                <td class="center"><?php echo $resultListVM['nom_vm']; ?></td>
                <td class="center"><?php echo $resultListVM['systeme']; ?></td>
                <td class="center"><?php echo $resultListVM['ram_vm']; ?></td>
                <td class="center"><?php echo $resultListVM['prenom_user']; ?></td>
                <td class="center"><?php echo $resultListVM['ip_noeud']; ?></td>
                <td class="center"><?php echo $resultListVM['cpu_total']; ?></td>
            </tr>	

            <?php
        } // ferme le while du resultat de la requête
        ?>	
                
        </tbody>
        
        <tfoot>
		<tr>
                    <th>Name's User</th>
                    <th>FirstName's User</th>
                    <th>VM's name</th>
                    <th>OS</th>
                    <th>RAM</th>
                    <th>Size's disk</th>
                    <th>node</th>
                    <th>CPU</th> 
		</tr>
	</tfoot>
</table>
<script type="text/javascript" charset="utf-8">			
    $('#listVM').dataTable();			
</script>				         

    <?php

} else {
    header('Location: ../index.php');
}
?>