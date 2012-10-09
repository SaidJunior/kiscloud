
<!DOCTYPE html>
<html>
    <head>
	<meta charset="utf-8">
	<script type="text/javascript">
            
             //	Function lancé à la fin du chargement de la page
             
             function addRow(id,login,password,name,firstname,mail,status){

                         //recuperation de la table
                    var table = document.getElementById("database");

                        //recup nombre de ligne actuelle
                    var rowCount = table.rows.length;
                    
                        //insertion d'une ligne vide
                    var row = table.insertRow(rowCount);
   
                    var cell0 = row.insertCell(0);
                    cell0.innerHTML= id ;	
                    
                    var cell1 = row.insertCell(1);
                    cell1.innerHTML = login;
   
                    var cell2 = row.insertCell(2);
                    cell2.innerHTML = password;

                     var cell3 = row.insertCell(3);
                     cell3.innerHTML = name;

                     var cell4 = row.insertCell(4);
                     cell4.innerHTML = firstname;
     
                     var cell5 = row.insertCell(5);
                     cell5.innerHTML = mail;

                     var cell6 = row.insertCell(6);
                     cell6.innerHTML = status;
                     
                     // Bouton de controle
                     var cell7 = row.insertCell(7);
                     cell7.innerHTML = "<a class=\"btn btn-primary\">Modify </a>"; 
 
                     var cell8 = row.insertCell(8);
                     cell8.innerHTML = "<a class=\"btn btn-primary\">Delete</a>"; 
                     cell8.onclick="confirmdeleteUser(id)";
             }


             function checkFormOk(){
                 var retour = true
                 
                  // verif login
                  var login = document.getElementById("login").value; 
                  //vérifier si login vide
                   if(login ==""){ 
                        retour =false;
			$('#login').tooltip('show');
			document.getElementById("login").parentNode.parentNode.className ='control-group error';
								
                   }
                   //verif du password
                   var password = document.getElementById("password").value;
                       if(password ==""){ // si mot de passe vide.    
                            retour =false;
                            $('#password').tooltip('show');
                            document.getElementById("password").parentNode.parentNode.className ='control-group error';
                       }
                            
                     //verif du nom
                     var password = document.getElementById("name").value;
                         if(password ==""){ // si mot de passe vide.    
                            retour =false;
                            $('#name').tooltip('show');
                            document.getElementById("name").parentNode.parentNode.className ='control-group error';
                          }
                          
                      //verif du prenom
                          var password = document.getElementById("firstname").value;
                            if(password ==""){ // si mot de passe vide.    
				retour =false;
				$('#firstname').tooltip('show');
				document.getElementById("firstname").parentNode.parentNode.className ='control-group error';
                            }
                          
                          //verif du mail
                          var password = document.getElementById("mail").value;
                            if(password ==""){ // si mot de passe vide.    
				retour =false;
				$('#mail').tooltip('show');
				document.getElementById("mail").parentNode.parentNode.className ='control-group error';
                          }
                               
                          return retour;
                 
             }
            
             function updateUser() {	// à la soumission du formulaire     
                            
                                 
                  if(checkFormOk() == true){
    
                        // recupération des données a envoyer	
                        var login = document.getElementById("login").value;				
                        var password= document.getElementById("password").value;		
                        var name = document.getElementById("name").value;
                        var firstname = document.getElementById("firstname").value;
                        var mail = document.getElementById("mail").value;
                        var status= document.getElementById("status").value;

                        // envois en ajax des données sur le serveurs
                        $.ajax({ 
                                type: "POST", 
                                url: "php/formulaire/modifyUser.php", 
                                data: "id="+id+"&login="+login+"&password="+password+"&name="+name+"&firstname="+firstname+"&mail="+mail+"&status="+status,
                                 success: function(msg){          
                                            if(msg>0){
                                                $('#modifyModal').modal();
                                                $('#modifyModal').modal('hide');
                                                document.getElementById('database').deleteRow(numRowToDelete);
                                                addRow(id_user_to_modify,login,password,name,firstname,mail,status);
                                            }else{
                                                    alert("echec de la modification de la ligne")			
                                            }
                                        }
                        });

		 }else{
                      alert("Unable to create user, please check fields");
                 };
//					
              }
		
			
		

	</script>
</head>
<body>     
       		
     <!-- Formulaire -->
     <div class="modal" id="modifyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel">Modify User</h3>
        </div>
		  
	<!-- body -->
	<div class="modal-body">
            <form name="formulaire" action="#" id="formulaire" class="form-horizontal">
			  
		<!-- Login -->
		<div class="control-group">
                      <label class="control-label" for="login">Login</label>
			<div class="controls">
                            <input type="text" id="login" placeholder="login" rel="tooltip" data-placement="right">
			</div>
		</div>
			  
		<!-- password -->
                <div class="control-group">
		       <label class="control-label" for="password">Password</label>
			<div class="controls">
                            <input type="text" id="password" placeholder="password" rel="tooltip" data-placement="right">
			</div>
		</div>
			  
		<!-- name -->
		<div class="control-group">
                       <label class="control-label" for="name">Name</label>
			<div class="controls">
                            <input type="text" id="name" placeholder="name" rel="tooltip" data-placement="right">
			</div>
		</div>
			  
		<!-- firstname -->
		<div class="control-group">
			<label class="control-label" for="firstname">FirstName</label>
			<div class="controls">
                            <input type="text" id="firstname" placeholder="firstname" rel="tooltip" data-placement="right">
			</div>
		</div>
			  
		<!-- mail -->
		<div class="control-group">
			<label class="control-label" for="mail">E-mail Address</label>
			<div class="controls">
                            <input type="text" id="mail" placeholder="e-mail address" rel="tooltip" data-placement="right">
			</div>
		</div>
                          
                <!-- status -->
		<div class="control-group">
                        <label class="control-label" for="status">Status</label>
			<div class="controls">
                            <select id="status">
                                <option><label class="control-label" for="client">client</label></option>
                                <option><label class="control-label" for="admin">admin</label></option>
                              
                            </select>
			</div>
		</div>             

	</div>
		  
            <!-- footer -->
            <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                    <button onclick="updateUser()" class="btn btn-primary">Save Changes</button>
            </div>
    </form>
		 
</div>
</body>
</html>
	

	  
	
