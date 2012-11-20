<?php
session_start(); // On démarre la session AVANT toute chose
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>KisCloud</title>

        <!-- Bootstrap css -->
        <link href="css/bootstrap.css" rel="stylesheet"> 

    </head>
    <body>
        <!-- BigVideo Dependencies -->
        <script src="js/jquery-1.8.2.min.js"></script>
        <script src="js/jquery-ui-1.8.22.custom.min.js"></script>
        <script src="js/jquery.imagesloaded.min.js"></script>
        <script src="js/video.js"></script>
        <!-- BigVideo js -->
        <script src="js/bigvideo.js"></script>
        <!-- Bootstrap js -->
        <script src="js/bootstrap.js"></script>
        <!-- Lancement de la video cloud -->
        <script>
            $(function() {
                var BV = new $.BigVideo();
                BV.init();
                BV.show('vids/cloud.mp4',{ambient:true});
                // Handler du le input password. si la touche enter est préssée on valide le formulaire
                $("#password").keyup(function(event){
                    if(event.keyCode == 13){
                        $("#validate").click();
                    }
                });
               
            });
        </script>

        <script type="text/javascript">
            //************************************************************************************
            //  Fonction de login. Envoi en ajax au serveur pour test sur la base de données
            //************************************************************************************
            function login(){
                // si les données sont dans un format correct on appel la fonction ajax
                if(checkSaisi()){
                    //récupération des valeurs saisis
                    var login =     document.getElementById("login").value;
                    var password=   document.getElementById("password").value;
                    // envois en ajax des données sur le serveurs
                    $.ajax({ 
                        type: "POST", 
                        url: "login_ajax.php", 
                        data: "login="+login+"&password="+password,
                        success: function(msg){ 
                            if(msg=="admin" || msg=="client"){
                                window.location.replace("index.php");
                            }
                            if(msg==0){
                                // Login ou passe incorecte
                                $("div#erreur").show();
                                $("div#erreur").html("<div class=\"alert\" href=\"#\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button><strong>Attention!</strong> Login ou mot de passe incorrectes.</div>");
                                var t = setTimeout("$(\"div#erreur\").hide()",3000);
                            }
                        }
                    });
                }else{
                    //alert("saisi incorecte");
                }
            }
        
            //************************************************************************************
            //  Fonction de test de la saisi
            //************************************************************************************
            function checkSaisi(){
            
                //rez des couleurs
                document.getElementById('login').parentNode.parentNode.className='control-group'; 
                document.getElementById('password').parentNode.parentNode.className='control-group'; 
                //récupération des valeurs saisis
                var login =     document.getElementById("login").value;
                var password=   document.getElementById("password").value;
                //init d'un booleen de retour
                var retour = true;
                //**********************************
                //check de la saisi du login
                //**********************************
                if(login ==""){
                    retour = false;
                    //affichage tooltip et mise en rouge
                    $('#login').tooltip('show');
                    document.getElementById("login").parentNode.parentNode.className ='control-group error';
                }else{
                    //on test que le login est dans un format correct
                    reg = new RegExp("^[a-zA-Z0-9_-]");
                    if (!reg.test(login)){ //si la regex est pas bonne
                        retour =false;
                        // on recup la div de control parente afin de changer la couleur au rouge
                        document.getElementById("login").parentNode.parentNode.className='control-group error';
                        $('#login').tooltip('hide')
                        .attr('data-original-title', 'Carractère non autorisé')
                        .tooltip('fixTitle')
                        .tooltip('show');
                    }
                }
            
                //**********************************
                //check de la saisi du mot de passe
                //**********************************
                if(password ==""){ // si mot de passe vide.
                    retour =false;
                    $('#password').tooltip('show');
                    document.getElementById("password").parentNode.parentNode.className ='control-group error';
                }
                return retour;
            }
        
        </script>

        <!-- Page login KisCloud-->
        <div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <!-- header login -->
            <div class="modal-header" style="height: 50px">
                <div class="row-fluid">
                    <div class="span3"><h3 id="myModalLabel">KisCloud</h3></div>
                    <div class="span9 "><div id="erreur"></div><!-- span erreur -->    </div>
                </div>


            </div>
            <!-- body login-->
            <div class="modal-body">
                <form name="formulaire" action="#" id="formulaire" class="form-horizontal">
                    <!-- Login -->
                    <div class="control-group">
                        <label class="control-label" for="login">Login</label>
                        <div class="controls">
                            <input type="text" id="login" placeholder="login" rel="tooltip" data-placement="right" data-original-title="Login non saisi">
                        </div>
                    </div>

                    <!-- password -->
                    <div class="control-group">
                        <label class="control-label" for="password">Password</label>
                        <div class="controls">
                            <input type="password" id="password" placeholder="Password" rel="tooltip" data-placement="right" data-original-title="Mot de passe vide non authorisé">
                        </div>
                    </div>

                </form>
            </div>
            <!-- footer -->
            <div class="modal-footer">
                <button id="validate" onclick="login()"type="submit" class="btn btn-primary" >Log me in</button>
            </div>
        </div>      

    </body>
</html>
