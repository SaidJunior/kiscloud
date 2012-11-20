<?php
session_start();
//si la session existe on affiche la page
if ((isset($_SESSION['login'])) && (!empty($_SESSION['login']))){
    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>KisCloud</title>
        <!-- Perso css -->
        <link href="css/mycss.css" rel="stylesheet">
        <!-- Bootstrap css -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Bootstrap js -->
        <script src="js/jquery-latest.js"></script>
        <script src="js/bootstrap.js"></script>
        
        <!-- fonction js -->
        <script type="text/javascript">
            // activation du tableau
            $(document).ready(function() {
               $('#myTab a').click(function (e) {
                 e.preventDefault();
                 $(this).tab('show');
               });
             });
             //fonction de deconnexion
             function logOut(){
                  $.ajax({ 
                    type: "POST", 
                    url: "kill_session.php", 
                    success: function(){ 
                        window.location.replace("index.php");
                    }
                });                
             }
       </script>
    </head>
    <body>
    <!-- Bande noir header      --> 
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">KisCloud</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="#wiki">Wiki</a></li>
              <li><a href="#contact">Contact</a></li>
              <li><button class="btn btn btn-danger"onclick="logOut()" class="btn">Logout</button></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
    
    <!-- Conteneur avec slide bar a gauche et corp à droite      --> 
    <div class="container-fluid">
        <div class="row-fluid">
          <div class="span2">
            <!--Sidebar content-->
            <ul class="nav nav-pills nav-stacked" id="myTab">
                <li class ="active">
                    <a href="#listVM">VM's</a>
                </li>
                <li>
                    <a href="#virtualDisk">Virtuals disks</a>
                </li>
                <li>
                    <a href="#listISO">ISO</a>
                </li>
            </ul>
          </div>
          <div class="span10">
            <!--Body content-->
            <div class="tab-content">
                <div class="tab-pane active" id="listVM"><?php include 'listVM.php'; ?></div>
                <div class="tab-pane" id="virtualDisk"><?php include 'listDisk.php'; ?></div>
                <div class="tab-pane" id="listISO"><?php include 'listISO.php'; ?></div>
            </div>
          </div>
        </div>
    </div>
        
    </body>
       
<?php  
}else{
    // pas de login en session : proposer la connexion
    header('Location: login.php');  
}

?>
