<!-- Partie Configuration Manager --> 

<script type="text/javascript">

    function checkManager(){
        var verif = true
        //recupération des données a envoyer				
        var password_Manager= document.getElementById("passwordManager").value;
                
        if(password_Manager ==""){
            verif=false;
            $('#passwordManager').tooltip('show');
            document.getElementById("passwordManager").parentNode.parentNode.className ='control-group error';      
        }
                
        return verif
    }
    
    function checkFormNFS(){
        var verif = true
        //recupération des données a envoyer
        var ip_NFS = document.getElementById("ipNFS").value;				
        var path_NFS= document.getElementById("pathNFS").value;
                
               
                    
        if(ip_NFS ==""){ 
            verif =false;
            $('#ipNFS').tooltip('show');
            document.getElementById("ipNFS").parentNode.parentNode.className ='control-group error';
                
        }else{
            var reg= new RegExp("^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?).(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?).(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?).(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$");
            if(!reg.test(ip_NFS)){ 
                verif =false;
                document.getElementById("ipNFS").parentNode.parentNode.className ='control-group error';
                $('#ipNFS').tooltip('hide')
                .attr('data-original-title', 'Adresse incorecte')
                .tooltip('fixTitle')
                .tooltip('show');
            }
        }
                
        if(path_NFS ==""){ 
            verif =false;
            $('#pathNFS').tooltip('show');
            document.getElementById("pathNFS").parentNode.parentNode.className ='control-group error';      
        }         
        return verif;
    }
            
            
    function saveManager(){ 
        if(checkManager()== true){
            var login_Manager = document.getElementById("loginManager").value;				
            var password_Manager= document.getElementById("passwordManager").value;
            
            $.ajax({ 
                type: "POST", 
                url: "php/formulaire/addManager.php", 
                data: "login_Manager="+login_Manager+"&password_Manager="+password_Manager,
                success: function(msg){
                    $('#consoleConfManager').html(msg);
                    $('#ipNFS').attr('disabled', false);
                    $('#pathNFS').attr('disabled', false);           
                }
            });
        }else{
                    $('#consoleConfManager').html("<div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>please check Manager parameters</div>");
        }
   
    }
            
    function saveNFS(){ 
    
    <?php
       include("connectDataBase.php");
          $requetManager = $bdd->query("SELECT count(id_manager) AS nbManager FROM MANAGER; "); // requette pour recup le nombre de manager
          $nbManager = $requetManager->fetch();
          
          if ($nbManager['nbManager'] == "1"){     
    ?>

                if(checkFormNFS()==true){

                    var ip_NFS = document.getElementById("ipNFS").value;				
                    var path_NFS= document.getElementById("pathNFS").value;


                    $.ajax({ 
                        type: "POST", 
                        url: "php/formulaire/addNFS.php", 
                        data: "ip_NFS="+ip_NFS+"&path_NFS="+path_NFS,
                        success: function(msg){
                            $('#consoleConfManager').html(msg);
                        }
                    });
                }else{
                       $('#consoleConfManager').html("<div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>please check NFS parameters</div>");
                    } 
                    
     <?php
             } else {
     ?>
             $('#consoleConfManager').html("<div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>please enter a Manager before</div>");
     <?php
             } 
     ?>
   
    }
            


</script>

<div id="consoleConfManager"></div>

<div class="form-horizontal">

    <!--  *** MANAGER *** -->

    <div class="control-group">
        <label><h2>Manager</h2></label>

    </div>

    <div class="control-group">
        <label class="control-label" for="loginManager">Login</label>
        <div class="controls">
            <input type="text" id="loginManager" disabled="true" value="root">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="passwordManager">Password</label>
        <div class="controls">
            <input type="password" id="passwordManager" placeholder="">
        </div>
    </div>

    <div class="control-group">
        <div class="controls">      
            <button class="btn btn-primary" onclick="saveManager()" id="buttonSaveNFS" >Save Manager</button>
        </div>
    </div>
</div>

<div class="form-horizontal">  

    <!-- *** NFS *** -->
    <div class="control-group">
        <label><h2>NFS</h2></label> 
    </div> 

    <div class="control-group">
        <label class="control-label" for="ipNFS">IP Address</label>
        <div class="controls">
            <input type="text" id="ipNFS" disabled="true" placeholder="10.20.30.40">
        </div>
    </div>

    <div class="control-group" >
        <label class="control-label" for="pathNFS">Path</label>
        <div class="controls">
            <input type="text" id="pathNFS" disabled="true" placeholder="/opt/nfs/etc/.../">
        </div>
    </div>

    <div class="control-group">
        <div class="controls">      
            <button class="btn btn-primary" onclick="saveNFS()" id="buttonSaveNFS" data-dismiss="modal" aria-hidden="true">Save NFS</button>
        </div>
    </div>  

</div>

