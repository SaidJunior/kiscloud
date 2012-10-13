<!-- Partie Manage Users --> 
    <div id="users" class="tab-pane" >
        
         <p>Section Manage Users.</p>	
        <!-- bouton d'ajout d'un utilisateur -->
        <?php include("php/formulaire/formulaireAddUser.php"); ?>
        <?php include("php/formulaire/formulaireModifyUser.php"); ?>
        <?php include("php/formulaire/formulaireDeleteUser.php"); ?>
         <a class="btn btn-primary" href="#myModal"  role="button" class="btn" data-toggle="modal">Add User</a>	
       
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
<!--			  <th></th>							  -->
                        </tr>
                    </thead> <!-- fin table de tête -->
							 
        	     <!-- Données de la requête -->
                   <tbody> <!-- debut la table corps -->
                       <?php
                       $numRow = 1;
			while ($resultListUsers = $requetListUsers->fetch()){// pour chaque ligne de la reponse
                        ?> 
                              
                        <tr>
                          <td><?php echo $resultListUsers['id_user'];?></td>
                          <td><?php echo $resultListUsers['login_user'];?></td>
                          <td><?php echo $resultListUsers['mdp_user'];?></td>
                          <td><?php echo $resultListUsers['nom_user'];?></td>
                          <td><?php echo $resultListUsers['prenom_user'];?></td>
                          <td><?php echo $resultListUsers['mail_user'];?></td>
                          <td><?php echo $resultListUsers['status_user'];?></td>
<!--                          <td><a class="btn btn-primary" onclick="modifyUser(<?php echo $resultListUsers['id_user'];?>,<?php echo $resultListUsers['login_user'];?>,<?php echo $resultListUsers['mdp_user'];?>,<?php echo $resultListUsers['nom_user'];?>,<?php echo $resultListUsers['prenom_user'];?>,<?php echo $resultListUsers['mail_user'];?>,<?php echo $resultListUsers['status_user'];?>,<?php echo $numRow;?>) "role="button" class="btn" data-toggle="modal">Modify</a></td>			-->
                          <td><a class="btn btn-primary" onclick="confirmdeleteUser(<?php echo $resultListUsers['id_user'];?>,<?php echo $numRow;?>)" role="button" class="btn" data-toggle="modal">Delete</a></td>
                        </tr>	
                        
                    <?php
                      $numRow++;
                        } // ferme le while du resultat de la requête
                     ?>	
                     </tbody> <!-- fin la table corps -->
	</table> <!-- fin la table complète -->                     
    </div>		
