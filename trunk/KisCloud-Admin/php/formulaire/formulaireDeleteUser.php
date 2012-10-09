
<!DOCTYPE html>
<html>
    <head>
	<meta charset="utf-8">
	<script type="text/javascript">
             
             //	Function lancé à la fin du chargement de la page

            function deleteUser() { 
 
                        // données à récupéré
                        $.ajax({ 
                            type: "POST", 
                            url: "php/formulaire/deleteUser.php", 
                            data: "id_user_to_delete="+id_user_to_delete,
                            success: function(msg){
                                 if(msg>0){    
                                    document.getElementById('database').deleteRow(numRowToDelete);
                                    $("#deleteModal").modal();
                                    $('#deleteModal').modal('hide');
                                }else{
                                        alert("echec de suppression de la ligne")			
                                }
                            }
                        });		
            }

	</script>
</head>
<body>     
       		
     <!-- Formulaire -->
     <div class="modal" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel"></h3>
        </div>
		  
	<!-- body -->
	<div class="modal-body">
            <form name="formulaire" action="#" id="formulaire" class="form-horizontal">
                
                <h4>    Do you really want to delete this user ?</h4>

	</div>
		  
            <!-- footer -->
            <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                    <button onclick="deleteUser()" class="btn btn-primary">Delete User</button>
            </div>
		 
</div>
</body>
</html>
	

	  
	
