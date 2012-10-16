<?php


?>

<script type="text/javascript">
             
    //	Function lancé à la fin du chargement de la page

    function deleteNode() { 
 
        // données à récupéré
        $.ajax({ 
            type: "POST", 
            url: "php/formulaire/deleteNode.php", 
            data: "id_noeud="+id_noeud,
            success: function(msg){
                if(msg>0){    
                    //document.getElementById('database').deleteRow(numRowToDelete);
                    $('#modalDeleteNode').modal('hide');
                    getAjaxUsers();
                }else{
                    $('#console').html("<div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button><h4>Error</h4> can't delete this node</div>");			
                }
            }
        });		
    }

</script>


<!-- Formulaire -->
<div>
    <h4>    Do you really want to delete this user ?</h4>
</div>

<div id="console"></div>