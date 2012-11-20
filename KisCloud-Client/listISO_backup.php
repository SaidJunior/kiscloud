
<script type="text/javascript">
//*************************************************************************
//      Variables globales
//*************************************************************************   
 var id_iso_to_delete;
 
//*************************************************************************
//      Appel du modal de confirmation de suppression d'une iso'
//*************************************************************************
function confirmDeleteISO(id_iso){
    $('#modalConfirmDeleteISO').modal('show');
    id_iso_to_delete=id_iso; 
}

//*************************************************************************
//      Demande au serveur la suppression de l'iso
//*************************************************************************
function deleteISO(){
    //fermeture modal
    $('#modalConfirmDeleteISO').modal('hide');
    // envoi en ajax de l'id a supprimer
    $.ajax({ 
            type: "POST", 
            url: "ajax/removeISO.php", 
            data: "id="+id_iso_to_delete,
            success: function(msg){ 
                if(msg==1){
                    // on efface la ligne de la sauvegarde via la fonction
                    var row = document.getElementById("rowISO"+id_iso_to_delete);
                    row.parentNode.removeChild(row);
                    $("div#messageISO").show();
                    $("div#messageISO").html("<div class=\"alert alert-success\" href=\"#\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button><strong>Success</strong> ISO file deleted.</div>");
                    var t = setTimeout("$(\"div#messageISO\").hide()",3000);
                }else{
                    // machine injoiniable
                    $("div#messageISO").show();
                    $("div#messageISO").html("<div class=\"alert alert-error\" href=\"#\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button><strong>Error</strong> Server problem.</div>");
                    var t = setTimeout("$(\"div#messageISO\").hide()",3000);
                }
            }
        });
}

</script>

<?php
session_start();
//si la session existe on affiche la page
if ((isset($_SESSION['login'])) && (!empty($_SESSION['login']))){
?>
    <h1>ISO list</h1>
    <!-- Bouton pour appeler le formulaire d'upload d'une ISO -->
    <div class="row-fluid" style="height: 50px">  
        <div class="span3">
            <a class="btn btn-primary" href="#modalUploadISO" role="button" class="btn" data-toggle="modal">Add ISO</a>
        </div>
        <div class="span9"><div id="messageISO"></div></div>
    </div></br>
    
   
    <?php
    // requette  pour rapporter les iso actuelle ratachée a un vm		
    $requet1 = $bdd->query("SELECT * FROM ISO WHERE id_user='$id_user' AND id_iso NOT IN (SELECT id_iso FROM VM WHERE id_user ='$id_user') ");
    // le seconde requette donne les iso non ratachée a un vm et donc supprimable
    $requet2 = $bdd->query("SELECT * FROM ISO WHERE id_user='$id_user' AND id_iso IN (SELECT id_iso FROM VM WHERE id_user ='$id_user') ");

    ?>
    <!-- Tableau list des iso -->
    <table id="TableISO" class="table table-hover">
        <thead>
            <tr>
                <th>ISO's name</th>
                <th>Description</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php  
            // affichage iso ratachées a une VM
            while ($iso = $requet1->fetch()){  
                ?> 
                    <tr id="rowISO<?php echo $iso['id_iso'];?>">
                        <td><?php echo $iso['name_iso'];?></td>
                        <td><?php echo $iso['description_iso'];?></td>
                        <td><a class="btn pull-left" href="javascript:confirmDeleteISO(<?php echo $iso['id_iso'];?>)"><i class="icon-remove"></i></a></td>
                    </tr>
                <?php
            }
            // affichage des iso non ratachées et donc supprimable
            while ($iso = $requet2->fetch()){  
                ?> 
                    <tr>
                        <td><?php echo $iso['name_iso'];?></td>
                        <td><?php echo $iso['description_iso'];?></td>
                        <td>-</td>
                    </tr>
                <?php
            }
            ?> 
        </tbody>
    </table>
    
    <!-- Modal confirmation de suppression d'une iso -->
    <div class="modal hide fade" id="modalConfirmDeleteISO">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Confirm delete this ISO file?</h3>
      </div>
      <div class="modal-body">
        The disk image will be permanently delete from server.
      </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
        <input type="button" OnClick="deleteISO()" VALUE="Apply" class="btn btn-primary">
      </div>
    </div>
    
    <!-- Modal formulaire d'ajout d'une iso -->
    <div class="modal hide fade" id="modalUploadISO">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Upload ISO file</h3>
      </div>
      <form id="fileupload" action="server/php/" class="form-horizontal" method="POST" enctype="multipart/form-data">
  
      <div class="modal-body">
        <!-- formulaire de creation d'un disk -->
            <!-- recup du fichier sur le client -->
            <div class="control-group">
                  <label class="control-label" for="parcourir">Browse</label>
                  <div class="controls">
                       <input id="fileupload" type="file" name="files[]" data-url="server/php/" multiple>
                        <div id="progress">
                            <div class="bar" style="width: 0%;"></div>
                        </div>
                  </div>
            </div>
            <!-- Description -->
            <div class="control-group">
                <label class="control-label" for="description">Description</label>
                <div class="controls">
                  <textarea rows="3"></textarea>
                </div>
            </div>
       

      <!-- footer -->  
      </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
        <button type="submit" class="btn btn-primary start">
            <i class="icon-upload icon-white"></i>
            <span>Start upload</span>
        </button>
      </div>
     </form>
    </div>
<script src="js/vendor/jquery.ui.widget.js"></script>
<script src="js/jquery.iframe-transport.js"></script>
<script src="js/jquery.fileupload.js"></script>
<script src="js/jquery.fileupload-fp.js"></script>
<script src="js/jquery.fileupload-ui.js"></script>
<script src="js/main.js"></script>
<?php  
}else{
    // pas de login en session : proposer la connexion
    header('Location: login.php');  
}

?>
