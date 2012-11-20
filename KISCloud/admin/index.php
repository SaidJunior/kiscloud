<?php
session_start();
if ((isset($_SESSION['login'])) && (!empty($_SESSION['login'])) && isset($_SESSION['status_user']) && ($_SESSION['status_user'] == "admin")) {
include_once '../include/global.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Administration Portal</title>
        <meta charset="utf-8">
        <!-- scripts -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <script src="../js/jquery-1.8.2.min.js"></script>
        <link href="../css/head.css" rel="stylesheet">
        <script src="../js/bootstrap.js"></script>	
    </head>
    <body>
        <?php include("menu/navbar.php"); ?>

        <!-- Menu --> 
        <script type="text/javascript">

            function getAjaxConfManager(){ 
                $.ajax({ 
                    type: "GET", 
                    url: "menu/ConfigurationManager.php", 
                    success: function(msg){
                        $('#confManager').html(msg);
                    }
                });
            }
            function getAjaxNode(){ 
                $.ajax({ 
                    type: "GET", 
                    url: "menu/ManageNode.php", 
                    success: function(msg){
                        $('#node').html(msg);
                    }
                });
            }
            function getAjaxUsers(){ 
                $.ajax({ 
                    type: "GET", 
                    url: "menu/ManageUser.php", 
                    success: function(msg){
                        $('#users').html(msg);
                    }
                });
            }
            function getAjaxRessources(){ 
                $.ajax({ 
                    type: "GET", 
                    url: "menu/Ressources.php", 
                    success: function(msg){
                        $('#ressources').html(msg);
                    }
                });
            }
            function getAjaxVM(){ 
                $.ajax({ 
                    type: "GET", 
                    url: "menu/VmUsers.php", 
                    success: function(msg){
                        $('#vm').html(msg);
                    }
                });
            }
            function getAjaxLogs(){ 
                $.ajax({ 
                    type: "GET", 
                    url: "menu/Logs.php", 
                    success: function(msg){
                        $('#logs').html(msg);
                    }
                });
            }
        </script>
        <div class="tabbable tabs-left">			
            <ul class="nav nav-tabs">	
                <li class="active"><a href="#confManager" onclick="getAjaxConfManager()" data-target="#confManager" data-toggle="tab"><h4>Configuration Manager</h4></a></li>
                <li><a href="#node" data-target="#node" onclick="getAjaxNode()" data-toggle="tab"><h4>Manage Node</h4></a></li>
                <li><a href="#users" data-target="#users" onclick="getAjaxUsers()" data-toggle="tab"><h4>Manage User</h4></a></li>
                <li><a href="#ressources" data-target="#ressources" onclick="getAjaxRessources()" data-toggle="tab"><h4>Ressources</h4></a></li>
                <li><a href="#vm" data-target="#vm" onclick="getAjaxVM()" data-toggle="tab"><h4>VM's Users</h4></a></li>
                <li><a href="#logs" data-target="#logs" onclick="getAjaxLogs()" data-toggle="tab"><h4>Logs</h4></a></li>
            </ul>

            <div class="tab-content">

                <div id="confManager" class="tab-pane active">
                    <script type="text/javascript">getAjaxConfManager();</script>
                </div>
                <div id="node" class="tab-pane" ></div>
                <div id="users" class="tab-pane" ></div>
                <div id="ressources" class="tab-pane" ></div>
                <div id="vm" class="tab-pane" ></div>
                <div id="logs" class="tab-pane"></div>
                
            </div> <!--/tabcontent --> 
        </div><!--/tabbable tabs-left --> 

    </body>
</html>
<?php
}else{
    header('Location: ../index.php'); 
}
?>