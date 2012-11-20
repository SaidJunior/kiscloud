<?php

session_start();
if ((isset($_SESSION['login'])) && (!empty($_SESSION['login'])) && isset($_SESSION['status_user']) && ($_SESSION['status_user'] == "admin")) {
    ?>
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
                        if(msg==0){
                            $('#myModalDeleteUser').modal('hide');
                            $('#consoleUser').html("<div class=\"alert alert-error\">Unable to delete this User<button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button></div>");
                        }else if(msg==-1){
                            $('#myModalDeleteUser').modal('hide');
                            $('#consoleUser').html("<div class=\"alert alert-error\">Unable to delete Admin User<button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button></div>");
                        }			
                    }
                }
            });		
        }

    </script>


    <!-- Formulaire -->
    <div>
        <h4>    Do you really want to delete this user ?</h4>
    </div>

    <?php

} else {
    header('Location: ../index.php');
}
?>




