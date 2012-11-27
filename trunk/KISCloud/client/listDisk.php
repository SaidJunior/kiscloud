<script type="text/javascript">
    //*************************************
    //  Variables globales
    //*************************************
    var idDiskToDelete; // le numero id bdd du disk à supprimer
    var rowDiskToDelete;//le numero de ligne
    //***************************************
    // Affichage du modal de conformation de suppression
    //***************************************
    function confirmVirtualDisk(id_disk){
       // affichage modal de confirmation
        $('#modalConfirmDeleteDisk').modal('show');
        // on place l'id dans la variables globale
        idDiskToDelete=id_disk;
        
    }
    //***************************************
    // Suppression d'un disk non rattaché a une vm
    //***************************************
    function deleteVirtualDisk(){
        //fermeture modal
        $('#modalConfirmDeleteDisk').modal('hide');
        // envoi en ajax de l'id a supprimer
        $.ajax({ 
                type: "POST", 
                url: "ajax/removeVirtualDisk.php", 
                data: "id="+idDiskToDelete,
                success: function(msg){ 
                    if(msg==1){
                        // on efface la ligne de la sauvegarde
                        var row = document.getElementById("rowDisk"+idDiskToDelete);
                        row.parentNode.removeChild(row);
                        $("div#message").show();
                        $("div#message").html("<div class=\"alert alert-success\" href=\"#\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button><strong>Success</strong> Virtual drive deleted.</div>");
                        var t = setTimeout("$(\"div#message\").hide()",3000);
                    }else{
                        // machine injoiniable
                        $("div#message").show();
                        $("div#message").html("<div class=\"alert alert-error\" href=\"#\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button><strong>Error</strong> Server problem.</div>");
                        var t = setTimeout("$(\"div#message\").hide()",3000);
                    }
                }
            });
    }
    //***************************************
    // Creation du disk apres verification
    //***************************************
    function createVirtualDisk(){
    
        if(checkVirtualDiskForm()){ //si le formualire est correctement saisi on envoi en ajax
            //recup des valeurs ok
            var size = document.getElementById("size").value;
            var name = document.getElementById("name").value;
            $.ajax({ 
                type: "POST", 
                url: "ajax/addVirtualDisk.php", 
                data: "size="+size+"&name="+name,
                success: function(msg){ 
                    if(msg>0){  // si c'est superieur a 0 alors ona reçu un id'
                        // on previens que c'est ok'
                        $('#modalCreateDisk').modal('hide');
                        //insertion de la nouvelle ligne
                        insertNewRowVirtualDisk(size,name,msg);
                        //affichage message success
                        $("div#message").show();
                        $("div#message").html("<div class=\"alert alert-success\" href=\"#\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button><strong>Success</strong> Virtual drive added.</div>");
                        var t = setTimeout("$(\"div#message\").hide()",3000);
                    }else{
                        // machine injoiniable
                        if(msg==0){
                        $('#modalCreateDisk').modal('hide');
                        $("div#message").show();
                        $("div#message").html("<div class=\"alert alert-error\" href=\"#\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button><strong>Error</strong> Server problem.</div>");
                        var t = setTimeout("$(\"div#message\").hide()",3000);
                    }
                        if(msg==-1){
                            $('#modalCreateDisk').modal('hide');
                            $("div#message").show();
                            $("div#message").html("<div class=\"alert alert-error\" href=\"#\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button><strong>Error</strong> Unabled to create Disk.</div>");
                            var t = setTimeout("$(\"div#message\").hide()",3000);
                        }
                    }
                }
            });
        }
    }
    
    //***************************************
    // vérification du formulaire
    //***************************************
    function checkVirtualDiskForm(){
        var retour = true;
        //***************************************
        // vérification taille saisie
        //***************************************
        // recup de la valeur
        var size = document.getElementById("size").value;
        // si la valeur est vide
        if(size ==""){ 
            retour =false;
            $('#size').tooltip('show');
            document.getElementById("size").parentNode.parentNode.className ='control-group error';
        }else{
            // on test que ça soit bien un nombre
            reg = new RegExp("^[0-9]+$");
             if (!reg.test(size)){ //si la regex est pas bonne
                 retour = false;
                 $('#size').tooltip('show');
                 document.getElementById("size").parentNode.parentNode.className ='control-group error';
             }else{
                 // taille inférieur a 4
                 if((size<4)){
                     retour = false;
                     document.getElementById("size").parentNode.parentNode.className ='control-group error';
                     $('#size').tooltip('hide')
                                .attr('data-original-title', 'Too small')
                                .tooltip('fixTitle')
                                .tooltip('show');
                 }else{
                     //taille supperieur a 1000
                     if((size>1000)){
                            retour = false;
                            document.getElementById("size").parentNode.parentNode.className ='control-group error';
                            $('#size').tooltip('hide')
                                       .attr('data-original-title', 'Too bigger')
                                       .tooltip('fixTitle')
                                       .tooltip('show');
                     }
                 }
             }
            
        }
        //***************************************
        // vérification nom saisi
        //***************************************
        // recup valeur
        var name = document.getElementById("name").value;
        // si la valeur est vide
        if(name ==""){
            retour =false;
            $('#name').tooltip('show');
            document.getElementById("name").parentNode.parentNode.className ='control-group error';
            
        }else{
            // pas de caractere chelou
            reg = new RegExp("^[a-zA-Z0-9_-]+$");
                if (!reg.test(name)){ //si la regex est pas bonne
                    retour =false;
                    document.getElementById("name").parentNode.parentNode.className ='control-group error';
                    $('#name').tooltip('hide')
                                .attr('data-original-title', 'Not a valid name')
                                .tooltip('fixTitle')
                                .tooltip('show');
                }else{
                    // tester si le nom existe pas deja en base
                    $.ajax({ 
                        type: "POST", 
                        url: "ajax/dispoVirtualDisk.php", 
                        async:false,  // desactive l'asynchrone pour recup la reponse obligatoirement
                        data: "name="+name,
                        success: function(msg){ 
                             if(msg>0){
                               retour =false;
                               document.getElementById("name").parentNode.parentNode.className ='control-group error';
                                $('#name').tooltip('hide')
                                            .attr('data-original-title', 'Name already used')
                                            .tooltip('fixTitle')
                                            .tooltip('show');
                                         }
                        }
                    });
                }
        } 
        
        // retour apres tests
        return retour;
    }
    //*************************************************
    //  Insertion d'un nouveau disque dans le tableau
    //*************************************************
    function  insertNewRowVirtualDisk(size, name,id){
        //recuperation de la table
        var table = document.getElementById("TableHardDisk");

        //recup nombre de ligne actuelle
        var rowCount = table.rows.length;

        //insertion d'une ligne vide
        var row = table.insertRow(rowCount);
        row.id="rowDisk"+id;        // ajout d'un id pour la suppression
        //premiere colonne taille
        var cell0 = row.insertCell(0);
        cell0.innerHTML =size+" Go";

        // deuxieme colonne nom du disque
        var cell1 = row.insertCell(1);
        cell1.innerHTML = name;
        
        // troiseme colone bound to
        var cell2 = row.insertCell(2);
        cell2.innerHTML = "-";
        
        // 4eme pour la suppression
        var cell3 = row.insertCell(3);
        var img = document.createElement('i');          // image X
        img.className="icon-trash";
        var buttonnode= document.createElement('a');    // le bouton
        buttonnode.className="btn pull-left";
        buttonnode.appendChild(img);                    // l'image va dans le boutton
        buttonnode.onclick = function() {               // la function
            confirmVirtualDisk(id);
        };
        cell3.appendChild(buttonnode);
        
    }
</script>
<?php
session_start();
//si la session existe on affiche la page
if ((isset($_SESSION['login'])) && (!empty($_SESSION['login']))){
?>
<h1>Virtual Disk List</h1>
<!-- Bouton pour creer un nouveau disque -->
<div class="row-fluid" style="height: 50px">  
    <div class="span3">
        <a class="btn btn-success" href="#modalCreateDisk" role="button" class="btn" data-toggle="modal"><i class="icon-plus icon-white"></i> New virtual disk</a>
    </div>
    <div class="span9"><div id="message"></div></div>
</div></br>


<!-- requette sql pour rapporter les disques durs virtuelles annsi que leur VM ratachée  -->
<?php
    include_once "../include/global.php";
//connexion à la base
$id_user=$_SESSION['id_user'];

// requette de recup tous les disk rattachés a un vm		
$requet1 = $bdd->query("SELECT nom_disk, taille_virtual_disk, nom_vm,VD.id_virtual_disk
                        FROM VIRTUAL_DISK VD
                        inner join VM_DISK VMD on VD.id_virtual_disk=VMD.id_virtual_disk 
                        inner join VM on VM.id_vm = VMD.id_vm
                        inner join USERS on USERS.id_user = VM.id_user
                        WHERE USERS.id_user =$id_user");
// recup les disques non rattaché a une vm
$requet2 = $bdd->query("SELECT nom_disk, taille_virtual_disk,id_virtual_disk
                        FROM VIRTUAL_DISK VD inner join USERS U on U.id_user = VD.id_user
                        AND U.id_user = $id_user
                        AND VD.id_virtual_disk not in (select id_virtual_disk FROM VM_DISK);");
 
?>
<!-- Tableau list des disques durs virtuelles -->
<table id="TableHardDisk" class="table table-hover">
    <thead>
        <tr>
            <th>Disk size</th>
            <th>Name</th>
            <th>Bound to</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php  
            $numRow = 1;
                // affichage disque relié a une VM
                while ($virtual_disk = $requet1->fetch()){  // pour chaque ligne de la reponse
         ?> 
                    <tr>
                        <td><?php echo $virtual_disk['taille_virtual_disk'];?> Go</td>
                        <td><?php echo $virtual_disk['nom_disk'];?></td>
                        <td><?php echo $virtual_disk['nom_vm'];?></td>
                        <td>-</td>
                    </tr>
          <?php
                    $numRow++;
                }
                //affichage disque sans VM
                while ($virtual_disk = $requet2->fetch()){
          ?>          
                    <tr id="rowDisk<?php echo $virtual_disk['id_virtual_disk'];?>">
                        <td><?php echo $virtual_disk['taille_virtual_disk'];?> Go</td>
                        <td><?php echo $virtual_disk['nom_disk'];?></td>
                        <td>-</td>
                        <td><a class="btn pull-left" href="javascript:confirmVirtualDisk(<?php echo $virtual_disk['id_virtual_disk'];?>)"><i class="icon-trash"></i></a></td>
                    </tr>
                  
          <?php
                    $numRow++;  
                }
          ?>
    </tbody>
</table>
    
<!-- Modal confirmation de suppression -->
<div class="modal hide fade" id="modalConfirmDeleteDisk">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Confirm delete?</h3>
  </div>
  <div class="modal-body">
    The virtual drive will be permanently delete from server.
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
    <input type="button" OnClick="deleteVirtualDisk()" VALUE="Apply" class="btn btn-primary">
  </div>
</div>

<!-- Modal formulaire de creation d'un disque -->
<div class="modal hide fade" id="modalCreateDisk">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>New virtual disk</h3>
  </div>
  <div class="modal-body">
    <!-- formulaire de creation d'un disk -->
    <form name="formulaire" action="#" id="formulaire" class="form-horizontal">
        <!-- taille disk -->
        <div class="control-group">
              <label class="control-label" for="size">Size</label>
              <div class="controls">
                  <input type="text" id="size" placeholder=">4 in Gigabyte" rel="tooltip" data-placement="right" data-original-title="Enter a size"> Go
              </div>
        </div>
        <!-- Nom disk -->
        <div class="control-group">
            <label class="control-label" for="name">Name</label>
            <div class="controls">
              <input type="text" id="name" placeholder="My_disk_with_no_spaces" rel="tooltip" data-placement="right" data-original-title="Enter a name">
            </div>
        </div>
    </form>
    
  <!-- footer -->  
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
    <input type="button" OnClick="createVirtualDisk()" VALUE="Apply" class="btn btn-primary">
  </div>
</div>
 
<?php  
}else{
    // pas de login en session : proposer la connexion
    header('Location: login.php');  
}

?>