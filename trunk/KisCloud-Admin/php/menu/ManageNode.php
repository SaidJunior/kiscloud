<!-- Partie Manage Node --> 
    
<?php
       include("connectDataBase.php");
//        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
//        $bdd = new PDO('mysql:host=localhost;dbname=KISCLOUD', 'root', 'p@ssw0rd', $pdo_options);
       
          $requetNFS = $bdd->query("SELECT count(id_NFS) AS nbNFS FROM NFS; "); // requette pour recup le nombre de NFS
          $nbFS = $requetNFS->fetch();
          
          $requetManager = $bdd->query("SELECT count(id_manager) AS nbManager FROM MANAGER; "); // requette pour recup le nombre de manager
          $nbManager = $requetManager->fetch();

          if($nbFS['nbNFS'] == "1" && $nbManager['nbManager'] == "1"){     
?>

<script type="text/javascript">

    var numRowToDelete;
    var id_noeud;
    
        function confirmDeleteNode(id,numRow){
        id_noeud=id;
        numRowToDelete=numRow;
        $('#modalDeleteNode').modal({
            show: true,
            keyboard: true,
            remote: 'php/formulaire/formulaireDeleteNode.php'
        })
    };


</script>

				         
<a class="btn btn-primary" href="#modalAddNode"  role="button" class="btn" data-remote="php/formulaire/formulaireAddNode.php" data-toggle="modal">Add Node</a>

<!--   ** MODAL ADD NODE ** -->

<div class="modal hide fade" id="modalAddNode" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Add Node</h3>
    </div>
    <div class="modal-body">

    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        <button onclick="addNode()" class="btn btn-primary">Save Node</button>
    </div>
</div>


<!--** MODAL DELETE NODE **-->

<div class="modal hide fade" id="modalDeleteNode" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Delete Node</h3>
    </div>
    <div class="modal-body">

    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        <button onclick="deleteNode()" class="btn btn-primary">Delete User</button>
    </div>
</div>


<!--          ** DONNEES EN BASE **-->

<table class="table table-hover" id="database">
    <thead>  
        <tr>
            <th>@IP</th>
            <th>RAM</th>
            <th>Processes</th>
            <th>Login</th>
            <th>Password</th>
            <th>Status</th>
            <th></th>						 
        </tr>
    </thead> <!-- fin table de tête -->

    <!-- Données de la requête -->
    <tbody> <!-- debut la table corps -->
        <?php
        //connexion à la base
        include("connectDataBase.php");

        $requetListNode = $bdd->query("SELECT * FROM NOEUD; "); // requette pour recup la liste des utilisateurs
        $numRow = 1;
        while ($requetListNode = $requetListNode->fetch()) {// pour chaque ligne de la reponse
            ?> 

            <tr>
                <td><?php echo $requetListNode['ip_noeud']; ?></td>
                <td><?php echo $requetListNode['ram_noeud']; ?></td>
                <td><?php echo $requetListNode['nb_proc_noeud']; ?></td>
                <td><?php echo $requetListNode['ssh_login_node']; ?></td>
                <td><?php echo $requetListNode['ssh_password_node']; ?></td>
                <td><?php echo $requetListNode['status_node']; ?></td>
                <td><a class="btn btn-primary" href="#modalDeleteNode" onclick="confirmDeleteNode(<?php echo $resultListUsers['id_user']; ?>,<?php echo $numRow; ?>)" role="button" class="btn">Delete</a></td>
            </tr>	

            <?php
            $numRow++;
        } // ferme le while du resultat de la requête
        ?>	
    </tbody> <!-- fin la table corps -->
</table> <!-- fin la table complète --> 

        <?php
          }else{
        ?>
            <p>
                 <h4> Impossible to manage node until Manager and NFS are not informed</h4>

                <h4> Please check <b>"Configuration Manager"</b></h4>
            </p>

       <?php 
       
        } 
       ?>
