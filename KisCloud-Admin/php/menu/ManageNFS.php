<!-- Partie Manage NFS --> 

<html>
    <head>
	<meta charset="utf-8">
	<script type="text/javascript">
            
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
            
            
            function saveNFS(){ 
                if(checkFormNFS()==true){
                    var ip_NFS = document.getElementById("ipNFS").value;				
                    var path_NFS= document.getElementById("pathNFS").value;
                    
                    $.ajax({ 
                            type: "POST", 
                            url: "php/formulaire/addNFS.php", 
                            data: "ip_NFS="+ip_NFS+"&path_NFS="+path_NFS,
                            success: function(msg){               
                                 alert(msg);
                            }
                     });
                    
                    
                }else{
                    alert("problems, please check parameters");
                };
      
            }

       </script>
</head>
<body>
        <div id="nfs" class="tab-pane" >

                <form class="form-horizontal">
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
                </form>
        </div>
</body>
</html>