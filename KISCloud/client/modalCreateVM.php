<script type="text/javascript">
//****************************************************************
//  Ajoute une ligne au tableau des VM
//****************************************************************  
function insertNewRowVM(msg,name_vm,nb_proc,memory,systeme,iso){
    //recuperation de la table
    var table = document.getElementById("TableVM");

    //recup nombre de ligne actuelle
    var rowCount = table.rows.length;

    //insertion d'une ligne vide
    var row = table.insertRow(rowCount);
    
    //premiere colonne bouton d'action
    
    // 4eme pour la suppression
    var cell0 = row.insertCell(0);
    //var newdiv = document.createElement('div');
    
    cell0.innerHTML ="<div class=\"btn-group\"><a class=\"btn dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\"><span class=\"caret\"></span></a> <ul class=\"dropdown-menu\"><li><a tabindex=\"-1\" href=\"#\"><i class=\"icon-play\"></i> Start</a></li><li><a tabindex=\"-1\" href=\"#\"><i class=\"icon-stop\"></i> Stop</a></li><li><a tabindex=\"-1\" href=\"#\"><i class=\"icon-eye-open\"></i> Console</a></li><li><a tabindex=\"-1\" href=\"#\"><i class=\"icon-pencil\"></i> Modify</a></li><li><a tabindex=\"-1\" href=\"#\"><i class=\"icon-remove\"></i> Delete</a></li>     </ul>        </div>";				
   
    // deuxieme colonne nom de la vm
    var cell1 = row.insertCell(1);
    cell1.innerHTML = name_vm;

    // troiseme colone nb_proc
    var cell2 = row.insertCell(2);
    cell2.innerHTML = nb_proc;
    
    // colonne RAM
    var cell3 = row.insertCell(3);
    cell3.innerHTML = memory;
    
    // colonne pourcentage proc
    var cell4 = row.insertCell(4);
    cell4.innerHTML = "100 %";
    
    // colonne systeme
    var cell5 = row.insertCell(5);
    var img = document.createElement('img');
    img.src ='img/'+systeme+'-icon.png';
    img.style.height="40px";
    img.style.width="40px";
    cell5.appendChild(img);
    
    // colonne status
    var cell6 = row.insertCell(6);
    var img = document.createElement('i');          // image X
    img.className="icon-stop";
    cell6.appendChild(img);
    
    // colonne bound iso
    var cell7 = row.insertCell(7);
    cell7.innerHTML = iso;
    
}    
//****************************************************************
//  Fonction de test du formulaire.
//  - renvoi true si le formulaire est ok
//****************************************************************  
function checkFormOk(){
     //*************************************************************************************
     // on rez tout les tooltip et les couleurs(au cas ou c'est pas le premier appel)
     //*************************************************************************************
     var tabTooltip = ["name_vm","memory"];
     for(var i= 0; i < tabTooltip.length; i++){
             //alert(tabTooltip[i]);
             document.getElementById(tabTooltip[i]).parentNode.parentNode.className='control-group'; 
             $(tabTooltip[i]).tooltip('hide');
     }
         
     $('#windows').tooltip('hide');
     document.getElementById("windows").parentNode.parentNode.parentNode.className='control-group'; 
     
    //*************************************************************************				
    //variable de retour vrai tant qu'il n'y a pas au moins une erreur
    //*************************************************************************
    var retour = true;
    
    //****************************************
    //check de la selection de l'os.
    //****************************************
    // Si aucun bouton n'est actif alors l'os n'est pas choisi
    if(document.getElementById("linux").className == "btn" && document.getElementById("windows").className=="btn"){
        retour =false;
        $('#windows').tooltip('show');	//TODO ce code est bon mais il faut attendre la corection du framework
        document.getElementById("windows").parentNode.parentNode.parentNode.className='control-group error'; 

    }
    
    //****************************************
    //check de la saisie d'un nom de vm
    //  - non vide
    //  - pas de caractere special
    //  - disponible sur le serveur
    //****************************************
    //recup de la valeur
    var name_vm = document.getElementById("name_vm").value;
    var reg;
    //vérifier si login vide
    if(name_vm ==""){ 
            retour =false;
            $('#name_vm').tooltip('show');
            document.getElementById("name_vm").parentNode.parentNode.className ='control-group error';

    }else{
            //verification caratere
            reg = new RegExp("^[a-zA-Z0-9_-]{3,16}$");
            if (!reg.test(name_vm)){ //si la regex est pas bonne
                retour =false;
                // on recup la div de control parente afin de changer la couleur au rouge
                document.getElementById("name_vm").parentNode.parentNode.className='control-group error';
                $('#name_vm').tooltip('hide')
                                        .attr('data-original-title', 'Not allowed charater')
                                        .tooltip('fixTitle')
                                        .tooltip('show');
            }else{
                //**************************************
                //  Test de la disponibilité du nom de vm
                //**************************************
                $.ajax({
                    type: "POST",               
                    async:false,               
                    url: "ajax/dispoVMname.php",     
                    data: "vmname="+name_vm, 
                    success: function(msg){
                        
                        if(msg>0){ // nom vm pas dispo
                            retour= false;
                            // on recup la div de control parente afin de changer la couleur au rouge
                            document.getElementById("name_vm").parentNode.parentNode.className='control-group error';
                            $('#name_vm').tooltip('hide')
                                            .attr('data-original-title', 'Name allready exist')
                                            .tooltip('fixTitle')
                                            .tooltip('show');
                        }                    
                    }
                });
            }
    }
    
    //****************************************
    //  check de la mémoire saisie 
    //  - non null
    //  - uniquement un integer authorisé
    //  - > a 3 caractere
    //  - 3 go max pour la demo
    //****************************************
    //recup de la valeur
    var memory = document.getElementById("memory").value;
    var reg;
    //vérifier si login vide
    if(memory ==""){ 
            retour =false;
            $('#memory').tooltip('show');
            document.getElementById("memory").parentNode.parentNode.className ='control-group error';

    }else{
            //verification caratere
            reg = new RegExp("^[0-9]{3,16}$");
            if (!reg.test(memory)){ //si la regex est pas bonne
                retour =false;
                // on recup la div de control parente afin de changer la couleur au rouge
                document.getElementById("memory").parentNode.parentNode.className='control-group error';
                $('#memory').tooltip('hide')
                                        .attr('data-original-title', 'Only integer allowed')
                                        .tooltip('fixTitle')
                                        .tooltip('show');
            }else{
                // taille max 2 go
                if (memory>2048){
                    retour =false;
                    // on recup la div de control parente afin de changer la couleur au rouge
                    document.getElementById("memory").parentNode.parentNode.className='control-group error';
                    $('#memory').tooltip('hide')
                                            .attr('data-original-title', '2048 Mo max')
                                            .tooltip('fixTitle')
                                            .tooltip('show');
                }
            }
    }
    
    //************************************
    //      On retourne la valeur retour
    //************************************
    return retour;
}
       
//****************************************************************
//  Fonction d'ajout d'un VM.
//  - Test si le formulaire est ok
//  - envoi en ajax les info au serveur pour la creation de la vm
//****************************************************************
function addVM(){
    //****************************
    //  si le formulaire est ok on envoit en ajax
    //****************************
    if(checkFormOk()){
        //***************************
        //recup des donnes a envoyer
        //***************************
        // type systeme
        if(document.getElementById("linux").className != "btn" ){
            var systeme = "linux";
        }else{
            var systeme = "windows";
        }
        
        //nom VM
        var name_vm = document.getElementById("name_vm").value;
        // nb proc
        var nb_proc_index= document.getElementById("nb_proc").selectedIndex;
        var nb_proc = document.getElementById("nb_proc")[nb_proc_index].value;
        // memoire
        var memory = document.getElementById("memory").value;
        
        // virtual disk
        var vDisk= document.getElementById("select_dipo_disk").value;
        // iso bounded
        var iso =  document.getElementById("select_bound_iso").value; 
            
        //***************************    
        // envoi en ajax
        //***************************
        
        $.ajax({
            type: "POST",               
            url: "ajax/addNewVM.php", 
            async:true,
            data: "systeme="+systeme+"&name_vm="+name_vm+"&nb_proc="+nb_proc+"&memory="+memory+"&vDisk="+vDisk+"&iso="+iso, 
            success: function(msg){
                if(msg>0){ // tout est ok
                    // on previens que c'est ok'
                    $('#modal_add_vm').modal('hide');
                    // insertion de la ligne de la vm
                    //affichage message success
                    $("div#message_vm").show();
                    $("div#message_vm").html("<div class=\"alert alert-success\" href=\"#\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button><strong>Success</strong> Virtual machine added.</div>");
                    var t = setTimeout("$(\"div#message_vm\").hide()",3000);
                    var iso_selected=document.getElementById("select_bound_iso");
                    var iso_text =  iso_selected.options[iso_selected.selectedIndex].text;
                    insertNewRowVM(msg,name_vm,nb_proc,memory,systeme,iso_text);
                }else{
                    // erreur serveur
                    // on previens que c'est ok'
                    $('#modal_add_vm').modal('hide');
                    //affichage message success
                    $("div#message_vm").show();
                    $("div#message_vm").html("<div class=\"alert alert-error\" href=\"#\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button><strong>Alert</strong> Server error.</div>");
                    var t = setTimeout("$(\"div#message_vm\").hide()",3000);
                }                    
            }
        });
    }
       
}
</script>
<link type="text/css" href="css/jquery-ui-slider.css" rel="stylesheet" />
<div class="modal hide fade" id="modal_add_vm">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>New virtual machine</h3>
  </div>
    
  <!-- body -->
  <form name="formulaire" action="#" id="formulaire" class="form-horizontal">
    <div class="modal-body">
      <!-- type de systeme -->
      <div class="control-group">
            <label id="test" class="control-label" for="typeOS">Type OS</label>
            <div class="controls">
                    <!-- bouton radio de selection -->
                    <div class="btn-group" data-toggle="buttons-radio">
                      <button type="button" id="linux" class="btn">Linux</button>
                      <button type="button" id="windows" class="btn" rel="tooltip" data-placement="right" data-original-title="OS non séléctionné" >Windows</button>
                    </div>
            </div>
      </div>

      <!-- nom de la VM -->
      <div class="control-group">
            <label class="control-label" for="name_vm">Name</label>
            <div class="controls">
              <input type="text" id="name_vm" placeholder="name" rel="tooltip" data-placement="right" data-original-title="No name selected">
            </div>
      </div>
      
      <!-- Nombre de processeur virtuel -->
      <div class="control-group">
            <label class="control-label" for="nb_proc">Virtual proc</label>
            <div class="controls">
              <select id="nb_proc">
                <option value="1">1</option>
                <option value="2">2</option>
              </select>
            </div>
      </div>
      
      <!-- memoire vive -->
      <div class="control-group">
            <label class="control-label" for="memory">Memory</label>
            <div class="controls">
              <input type="text" id="memory" placeholder="Megabytes values" rel="tooltip" data-placement="right" data-original-title="No memory size entered">
            </div>
      </div>
      
      <!-- pourcentage processeur -->
      <div class="control-group">
            <label class="control-label" for="ram">Percent processor</label>
            <div class="controls">
                <div style="width: 220px" id="filter"></div><div id="echo"> %</div>
            </div>
      </div>

      <!-- disque dur virtuel obligatoire -->
      <div class="control-group">
            <label class="control-label" for="virtual_disk">Virtual disk</label>
            <div class="controls">
              <select id="select_dipo_disk">
                  <!-- javascript s'occupe ici de remplir les options -->
              </select>
            </div>
      </div>
      
      <!-- bounded iso -->
      <div class="control-group">
            <label class="control-label" for="iso">Bound ISO</label>
            <div class="controls">
              <select id="select_bound_iso">
                  <!-- javascript s'occupe ici de remplir les options -->
              </select>
            </div>
      </div>

    </div>


    <!-- footer -->  
    <div class="modal-footer">
      <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
      <input type="button" OnClick="addVM()" VALUE="Create" class="btn btn-primary">
    </div>
  </form>
</div> 

<script type="text/javascript">
//*************************************************************
//  Recupere les disques disponibles pour la creation d'une VM
//*************************************************************
$('#modal_add_vm').on('shown', function () {
  // on rez le select au cas ou c'est pas le premier appel
  document.getElementById("select_dipo_disk").innerHTML = ""; 
  document.getElementById("select_bound_iso").innerHTML = ""; 
  // on recup les données sur les disques dispo
  $.ajax({ 
        type: "POST", 
        url: "ajax/listVirtualDisk.php", 
        dataType: 'json',
        success: function(msg){
            // on reçoit alors un tableau si le tableau est vide alors aucun disque est dispo.
            if(msg.length==0){
                //alors tableau vide et donc aucun disk dispo. on previent l'user quil faut en creer un avant
                $('#modal_add_vm').modal('hide');// on cache le modal
                $("div#message_vm").show();     // affichage de l'alert
                $("div#message_vm").html("<div class=\"alert alert-block\" href=\"#\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button><strong>Warning</strong> No virtual drive available. Please create one first</div>");
                var t = setTimeout("$(\"div#message_vm\").hide()",3000);
                
            }else{
                for (var i = 0, il = msg.length; i < il; i++) {
                  // on insere un select par reponse dans le tableau
                  var oSelField = document.getElementById("select_dipo_disk");
                  var oOption = document.createElement("OPTION");
                  oSelField.options.add(oOption);
                  oOption.text = msg[i][1];
                  oOption.value = msg[i][0];
                  
                }  
            }
            
            
        }
    });
  
    //************************************************************
    // seconde requette ajax pour recup tous les iso disponible
    //************************************************************
    $.ajax({ 
        type: "POST", 
        url: "ajax/listISO.php", 
        dataType: 'json',
        success: function(msg2){
            // le tableau reçu contient les ISO disponible
            for (var i = 0, il = msg2.length; i < il; i++) {
                // in insere un select par reponse dans le tableau
                var oSelField2 = document.getElementById("select_bound_iso");
                var oOption2 = document.createElement("OPTION");
                oSelField2.options.add(oOption2);
                oOption2.text = msg2[i][1]; //valeur affiché
                oOption2.value = msg2[i][0];// valeur caché id BDD
              }
        }
    });
  
});
</script>

<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
<script src="js/jquery-ui-slider.min.js"></script>
<script type="text/javascript">
$("#filter").slider({
    orientation: "horizontal",
    range: "min",
    min: 1,
    max: 100,
    value: 100,
    slide: function (event, ui) {
        $("#echo").html(ui.value+" %");
    }
});
$("#echo").html($("#filter").slider("value")+" %");

</script>

