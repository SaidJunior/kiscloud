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
            
            
            function saveManager(){ 
                if(checkManager()== true){
                    var login_Manager = document.getElementById("loginManager").value;				
                    var password_Manager= document.getElementById("passwordManager").value;

  
                    $.ajax({ 
                               type: "POST", 
                               url: "php/formulaire/addManager.php", 
                               data: "login_Manager="+login_Manager+"&password_Manager="+password_Manager,
                               success: function(msg){
                                   $('#console').html(msg);
                               }
                      });
                }else{
                    alert("Problem with manager, please check parameters");
                }
   
            }
            
           function saveNFS(){ 
             
                    var ip_NFS = document.getElementById("ipNFS").value;				
                    var path_NFS= document.getElementById("pathNFS").value;

  
                    $.ajax({ 
                            type: "POST", 
                            url: "php/formulaire/addNFS.php", 
                            data: "ip_NFS="+ip_NFS+"&path_NFS="+path_NFS,
                             success: function(msg){
                                 $('#console').html(msg);
                             }
                    });
                
   
            }
            


       </script>
 
       <div id="console"></div>
       
        <div id="confManager" class="tab-pane active">
            
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
                          <input type="text" id="ipNFS" placeholder="10.20.30.40">
                     </div>
                 </div>

                 <div class="control-group">
                    <label class="control-label" for="pathNFS">Path</label>
                    <div class="controls">
                            <input type="text" id="pathNFS" placeholder="/opt/nfs/etc/.../">
                    </div>
                </div>

                <div class="control-group">
                    <div class="controls">      
                        <button class="btn btn-primary" onclick="saveNFS()" id="buttonSaveNFS" data-dismiss="modal" aria-hidden="true">Save NFS</button>
                    </div>
               </div>  
                
            </div>
     </div>

