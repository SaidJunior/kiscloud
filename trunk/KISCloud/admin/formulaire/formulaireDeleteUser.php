
<script type="text/javascript">
             
    //	Function lancé à la fin du chargement de la page

    function deleteUser() { 
 
        // données à récupéré
        $.ajax({ 
            type: "POST", 
            url: "formulaire/deleteUser.php", 
            data: "id_user_to_delete="+id_user_to_delete,
            success: function(msg){
                if(msg>0){    
                    //document.getElementById('database').deleteRow(numRowToDelete);
                    $('#myModalDeleteUser').modal('hide');
                    getAjaxUsers();
                }else{
                    alert("echec de suppression de la ligne")			
                }
            }
        });		
    }

</script>


<!-- Formulaire -->
<div>
    <h4>    Do you really want to delete this user ?</h4>
</div>






