<script type="text/javascript">
// variable globales
var idVMtoDelete;
/**
 * Affiche la console pour la vm selectionnée
 */
function startVM(id_vm){
    $.ajax({ 
        type: "POST",
        url: "ajax/startVM.php", 
        data: "id="+idVMtoDelete,        
        success: function(msg){ 
            if(msg==1){
                // la vm est pas lancée'
                $("div#message_vm").show();
                $("div#message_vm").html("<div class=\"alert alert-block\" href=\"#\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button><strong>Warning</strong> Stop VM first.</div>");
                var t = setTimeout("$(\"div#message_vm\").hide()",3000);
            }
        }
    });
}

function showConsole(id_vm){
    // on interoge le serveur pour savoir si la vm est lancée ou non
    $.ajax({ 
        type: "POST", 
        url: "ajax/showConsole.php", 
        data: "id="+id_vm,
        success: function(msg){ 
            if(msg>0){
                // si c'est supérieur a 0 on a reçu le port pour le proxy'
                window.open('http://localhost/kiscloud/no-vnc/vnc_auto.html?host=127.0.0.1&port='+msg);
                
            }else{
                // la vm n'est pas lancée'
                $("div#message_vm").show();
                $("div#message_vm").html("<div class=\"alert alert-block\" href=\"#\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button><strong>Warning</strong> VM not launched.</div>");
                var t = setTimeout("$(\"div#message_vm\").hide()",3000);
            }
        }
    });
    
}
/**
* Supprime la vm de la base si elle est arreté
 */
function confirmeDeleteVM(id){
    //test pour savoir si la vm est lancé ou non
    $.ajax({ 
        type: "POST",
        async:false,
        url: "ajax/checkVMisAlive.php", 
        data: "id="+idVMtoDelete,        
        success: function(msg){ 
            if(msg==1){
                //  la vm est bien stopé on peut demander la confirmation
                $('#modalRemoveVM').modal('show');
                // on stoke l'id au cas ou la suppresion est validé
                idVMtoDelete=id;
            }else{
                // la vm n'est pas lancée'
                $("div#message_vm").show();
                $("div#message_vm").html("<div class=\"alert alert-block\" href=\"#\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button><strong>Warning</strong> Stop VM first.</div>");
                var t = setTimeout("$(\"div#message_vm\").hide()",3000);
            }
        }
    });
    
}
</script>


<h1>VMs list</h1>
<!-- bouton d'ajout d'une sauvegarde + span message d'alert -->
<div class="row-fluid" style="height: 50px">  
      <div class="span3"><a class="btn btn-success" href="#modal_add_vm" role="button" class="btn" data-toggle="modal"><i class="icon-plus icon-white"></i> New VM</a></div>
      <div class="span9">   <div id="message_vm"></div></div>
</div></br>

<!-- requete sql pour recup les vm de l'user -->
<?php
    include_once "../include/global.php";
    $id_user=$_SESSION['id_user'];
    
    
    // requette de recup de toute les sauvegardes		
    $requet1 = $bdd->query("SELECT * FROM VM where id_user='$id_user' ;");
?>

<div style="height: 600px">
    <!-- Tableau des VM de l'utilisateur -->
    <table id="TableVM" class="table table-hover" >
        <thead>
            <tr>
              <th>Action</th>
              <th>Name</th>
              <th>Nb proc</th>
              <th>RAM</th>
              <th>Percent proc</th>
              <th>System</th>
              <th>Status</th>
              <th>Bound ISO</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($virtual_disk = $requet1->fetch()){  // pour chaque ligne de la reponse
                // si l'id_iso est null on affiche un tiret
                if($virtual_disk['id_iso']==""){
                    $name_iso="-";
                }else{
                    //sinon il faut recuperer le nom de l'iso
                    $id_iso = $virtual_disk['id_iso'];
                    $requet2 = $bdd->query("SELECT * FROM ISO where id_iso=$id_iso ;");
                    $donnees= $requet2->fetch();
                    $name_iso=$donnees['name_iso'];
                }
            ?>    

                <tr>
                    <!-- colonne boutton d'action -->
                    <td>
                        <div class="btn-group">
                          <a class="btn dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <li><a tabindex="-1" href="#"><i class="icon-play"></i> Start</a></li>
                            <li><a tabindex="-1" href="#"><i class="icon-stop"></i> Stop</a></li>
                            <li><a tabindex="-1" href="javascript:showConsole(<?php echo $virtual_disk['id_vm'];?>)"><i class="icon-eye-open"></i> Console</a></li>
                            <li><a tabindex="-1" href="javascript:confirmeDeleteVM(<?php echo $virtual_disk['id_vm'];?>)"><i class="icon-remove"></i> Delete</a></li>
                          </ul>
                        </div>
                    </td>
                    <!-- colonne nom vm -->
                    <td><?php echo $virtual_disk['nom_vm'];?></td>
                    <!-- colonne nb proc -->
                    <td><?php echo $virtual_disk['nb_processeur_vm'];?></td>
                    <!-- colonne ram -->
                    <td><?php echo $virtual_disk['ram_vm'];?> Mo</td>
                    <!-- colonne percnt prov -->
                    <td><?php echo $virtual_disk['percent_proc_vm'];?> %</td>
                    <!-- colonne type de systeme -->
                    <td><img src="img/<?php echo $virtual_disk['systeme'];?>-icon.png" width="40px" height="40px" class="img-rounded"></td>
                    <!-- colonne Status -->
                    <td><i class="icon-<?php echo $virtual_disk['status'];?>"></i></td>
                    <!-- colonne iso ratachée -->
                    <td><?php echo $name_iso;?></td>
                </tr>
           <?php
           } 
           ?>
        </tbody>
    </table>
</div>   

<!-- Modale de creation d'une vm et suppresion -->
<?php
   include 'modalCreateVM.php';
   include 'modalRemoveVM.php';
?>
        

