<script type="text/javascript">
function removeVM(){
    var deleteDisk = 0;
    // recup de la checkbox
    if(document.getElementById('confirmCheckbox').checked){
        deleteDisk = 1;
    }
    $.ajax({ 
            type: "POST", 
            url: "ajax/removeVM.php", 
            data: "id="+idVMtoDelete+"&deleteDisk="+deleteDisk,
            success: function(msg){ 
                if(msg>0){
                    // on vire le modal
                    $('#modalRemoveVM').modal('hide');
                    // on efface la ligne de la vm
                    var row = document.getElementById("idRowVM"+idVMtoDelete);
                    row.parentNode.removeChild(row);
                    //affiche popup success
                    $("div#message_vm").show();
                    $("div#message_vm").html("<div class=\"alert alert-success\" href=\"#\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button><strong>Success</strong> Virtual machine deleted.</div>");
                    var t = setTimeout("$(\"div#message_vm\").hide()",3000);


                }else{
                    // erreur
                    $('#modalRemoveVM').modal('hide');
                    $("div#message_vm").show();
                    $("div#message_vm").html("<div class=\"alert alert-block\" href=\"#\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button><strong>Warning</strong> Server error.</div>");
                    var t = setTimeout("$(\"div#message_vm\").hide()",3000);
                }
            }
        });
}
</script>

<!-- Modale de confirmation de suppression -->
<div class="modal hide fade" id="modalRemoveVM">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Delete the virtual machine?</h3>
  </div>
  <div class="modal-body">
    <input type="checkbox" id="confirmCheckbox">  Also delete virtual drive 
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Annuler</button>
    <input type="button" OnClick="removeVM()" VALUE="Confirmer" class="btn btn-primary">
  </div>
</div>
 

