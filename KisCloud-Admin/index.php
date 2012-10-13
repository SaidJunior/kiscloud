<!DOCTYPE html>
<html>
  <head>
    <title>Administration Portal</title>
	<meta charset="utf-8">
	<!-- scripts -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/jquery-1.8.2.min.js"></script>
	<link href="css/head.css" rel="stylesheet">
	<script src="js/bootstrap.js"></script>	
        
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
          
         
           $(function(){
               $("#myModal").modal();
               $('#myModal').modal('hide');
               
               $("#modifyModal").modal();
               $('#modifyModal').modal('hide');
               
               $("#deleteModal").modal();
               $('#deleteModal').modal('hide');

            });
          
            function modifyUser(id,login,password,name,firstname,mail,status,numRow){
                $('#modifyModal').modal('show');
                id_user_to_modify=id;
                login_user=login;
                password_user=password;
                name_user=name;
                firstname_user=firstname;
                mail_user=mail;
                status_user=status;  
                numRowToDelete=numRow;
            };
          
            function confirmdeleteUser(id,numRow){
                $('#deleteModal').modal('show');
                id_user_to_delete=id;
                numRowToDelete=numRow;
             };
             
             function checknbNFS_Manager(){
                 
             } 
  
   	</script>

  </head>
  <body>
      <?php include("php/menu/navbar.php"); ?>
       
<!--       LISTE DES USERS-->
    	<?php
	//connexion à la base
	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	$bdd = new PDO('mysql:host=localhost;dbname=KISCLOUD', 'root', 'p@ssw0rd', $pdo_options);	
	$requetListUsers = $bdd->query("SELECT * FROM USERS; "); // requette pour recup la liste des utilisateurs
	?>
      
<!--       LISTE NFS-->
        <?php
	//connexion à la base
	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	$bdd = new PDO('mysql:host=localhost;dbname=KISCLOUD', 'root', 'p@ssw0rd', $pdo_options);	
	$requetNFS = $bdd->query("SELECT count(id_NFS) AS nbNFS FROM NFS; "); // requette pour recup le nombre de NFS
        $nbFS = $requetNFS->fetch();
        
        $requetManager = $bdd->query("SELECT count(id_manager) AS nbManager FROM MANAGER; "); // requette pour recup le nombre de manager
	$nbManager = $requetManager->fetch();

        ?>
  
	 <!-- Menu --> 
         <div class="tabbable tabs-left">			
            <ul class="nav nav-tabs">	
		<li class="active"><a href="#confManager" data-target="#confManager" data-toggle="tab"><h4>Configuration Manager</h4></a></li>
                
                <?php 
//                if ($nbManager['nbManager'] == '1' && $nbFS['nbNFS'] == '1'){
                ?>
                    <li><a href="#node" data-target="#node"data-toggle="tab"><h4>Manage Node</h4></a></li>
                    <li><a href="#users" data-target="#users"data-toggle="tab"><h4>Manage User</h4></a></li>
                <?php
//                } 
                ?>
                
          
                
                
		<li><a href="#ressources" data-target="#ressources" data-toggle="tab"><h4>Ressources</h4></a></li>
		<li><a href="#vm" data-target="#vm" data-toggle="tab"><h4>VM's Users</h4></a></li>
		<li><a href="#logs" data-target="#logs" data-toggle="tab"><h4>Logs</h4></a></li>
	   </ul>
            
           <div class="tab-content">
				 
                 <?php include("php/menu/ConfigurationManager.php"); ?>
                 <?php include("php/menu/ManageNode.php"); ?>
                 <?php include("php/menu/ManageUser.php"); ?>
                 <?php include("php/menu/Ressources.php"); ?>
                 <?php include("php/menu/VmUsers.php"); ?>
                 <?php include("php/menu/Logs.php"); ?>
                
	   </div> <!--/tabcontent --> 
       </div><!--/tabbable tabs-left --> 
		
  </body>
</html>
