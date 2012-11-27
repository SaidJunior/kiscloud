<?php
session_start();
if ((isset($_SESSION['login'])) && (!empty($_SESSION['login'])) && isset($_SESSION['status_user']) && ($_SESSION['status_user'] == "admin")) {
    include_once '../../include/global.php';

    $requetNFS = $bdd->query("SELECT count(id_NFS) AS nbNFS FROM NFS; "); // requette pour recup le nombre de NFS
    $nbFS = $requetNFS->fetch();

    $requetManager = $bdd->query("SELECT count(id_manager) AS nbManager FROM MANAGER; "); // requette pour recup le nombre de manager
    $nbManager = $requetManager->fetch();

    if ($nbFS['nbNFS'] == "1" && $nbManager['nbManager'] == "1") {
        ?>
        <script type="text/javascript">
            //initialisation
            var id_user_to_delete;
            var id_user_to_modify;
            var login_user;
            var password_user;
            var name_user;
            var firstname_user;
            var mail_user;
            var status_user;   
            var numRowToDelete;
                              
            function confirmdeleteUser(id,numRow){
                id_user_to_delete=id;
                numRowToDelete=numRow;
                $('#myModalDeleteUser').modal({
                    show: true,
                    keyboard: true,
                    remote: 'formulaire/formulaireDeleteUser.php'
                })
            };
        </script>


        <div id="consoleUser"></div>

        <!-- bouton d'ajout d'un utilisateur -->
        <a class="btn btn-success" href="#myModalAddUser"  role="button" class="btn" data-remote="formulaire/formulaireAddUser.php" data-toggle="modal">Add User</a>	

        <!--   ** MODAL ADD USER ** -->

        <div class="modal hide fade" id="myModalAddUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">Add User</h3>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                <button onclick="addUser()" class="btn btn-primary">Save user</button>
            </div>
        </div>

        <!--** MODAL DELETE USER **-->

        <div class="modal hide fade" id="myModalDeleteUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">Delete User</h3>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                <button onclick="deleteUser()" class="btn btn-danger">Delete User</button>
            </div>
        </div>


        <table class="table table-hover" id="database">
            <thead>  <!-- début table de tête -->
                <tr>
                    <th>Id</th>
                    <th>Login</th>
                    <th>Password</th>
                    <th>Name</th>
                    <th>FirstName</th>
                    <th>Email Address</th>
                    <th>Status</th>
                    <th></th>						 
                </tr>
            </thead> <!-- fin table de tête -->

            <!-- Données de la requête -->
            <tbody> <!-- debut la table corps -->
                <?php
                //connexion à la base
                $requetListUsers = $bdd->query("SELECT * FROM USERS; "); // requette pour recup la liste des utilisateurs
                $numRow = 1;
                while ($resultListUsers = $requetListUsers->fetch()) {// pour chaque ligne de la reponse
                    ?> 

                    <tr>
                        <td><?php echo $resultListUsers['id_user']; ?></td>
                        <td><?php echo $resultListUsers['login_user']; ?></td>
                        <td><?php echo $resultListUsers['mdp_user']; ?></td>
                        <td><?php echo $resultListUsers['nom_user']; ?></td>
                        <td><?php echo $resultListUsers['prenom_user']; ?></td>
                        <td><?php echo $resultListUsers['mail_user']; ?></td>
                        <td><?php echo $resultListUsers['status_user']; ?></td>
                        <td><a class="btn btn-danger" href="#myModalDeleteUser" onclick="confirmdeleteUser(<?php echo $resultListUsers['id_user']; ?>,<?php echo $numRow; ?>)" role="button" class="btn">Delete</a></td>
                    </tr>	

                    <?php
                    $numRow++;
                } // ferme le while du resultat de la requête
                ?>	
            </tbody> <!-- fin la table corps -->
        </table> <!-- fin la table complète --> 

        <?php
    } else {
        ?>
        <div class="alert alert-error">
            <button type="button" class="close" data-dismiss="alert">x</button>please check Manager or NFS parameters
        </div>

        <?php
    }
} else {
    header('Location: ../index.php');
}
?>

