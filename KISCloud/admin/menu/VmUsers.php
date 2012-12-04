<?php
session_start();
if ((isset($_SESSION['login'])) && (!empty($_SESSION['login'])) && isset($_SESSION['status_user']) && ($_SESSION['status_user'] == "admin")) {
    include_once '../../include/global.php';
    ?>
    <link rel="shortcut icon" type="image/ico" href="http://www.datatables.net/favicon.ico" />

    <style type="text/css" title="currentStyle">
        @import "../css/datatables/demo_page.css";
        @import "../css/datatables/demo_table.css";
    </style>
    <script type="text/javascript" language="javascript" src="../js/datatables/jquery.js"></script>
    <script type="text/javascript" language="javascript" src="../js/datatables/jquery.dataTables.js"></script>

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
            $requetListVM = $bdd->query("SELECT * 
FROM VM v JOIN VM_DISK vd ON v.id_vm=vd.id_vm
JOIN VIRTUAL_DISK d ON vd.id_virtual_disk=d.id_virtual_disk
JOIN USERS u ON v.id_user=u.id_user; ");

            while ($resultListVM = $requetListVM->fetch()) {// pour chaque ligne de la reponse
                $ip_noeud=null;
                if($resultListVM['id_noeud']!=null){
                    $requetNodeInfos = $bdd->query("SELECT * FROM VM v JOIN NOEUD n ON v.id_noeud=n.id_noeud WHERE v.id_vm=".$resultListVM['id_vm'].";");
                    $resultNodeInfos = $requetNodeInfos->fetch();
                    $ip_noeud = $resultNodeInfos['ip_noeud'];
                }
                ?> 

                <tr>
                    <td class="center"><?php echo $resultListVM['nom_user']; ?></td>
                    <td class="center"><?php echo $resultListVM['prenom_user']; ?></td>
                    <td class="center"><?php echo $resultListVM['nom_vm']; ?></td>
                    <td class="center"><?php echo $resultListVM['systeme']; ?></td>
                    <td class="center"><?php echo $resultListVM['ram_vm']; ?> Mo</td>
                    <td class="center"><?php echo $resultListVM['taille_virtual_disk']; ?>G</td>
                    <td class="center"><?php echo $ip_noeud ?></td>
                    <td class="center"><?php echo $resultListVM['percent_proc_vm']; ?> %</td>
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