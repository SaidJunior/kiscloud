<?php

session_start();
if ((isset($_SESSION['login'])) && (!empty($_SESSION['login'])) && isset($_SESSION['status_user']) && ($_SESSION['status_user'] == "admin")) {
    ?>
    <script type="text/javascript">
        function logOut(){
            $.ajax({ 
                type: "POST", 
                url: "../kill_session.php", 
                success: function(){ 
                    window.location.replace("index.php");
                }
            });                
        }
    </script>
    <!-- Bande noir header --> 
    <div class="navbar navbar-inverse navbar-fixed-top">	
        <div class="navbar-inner">
            <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"/>
                <a class="brand" href="#">Administration Portal</a>
                <li><button class="btn btn btn-danger"onclick="logOut()" class="btn">Logout</button></li>
            </div> <!-- container-->
        </div> <!-- navbar-inner-->
    </div><!--/.navbar-inverse -->
    <?php

} else {
    header('Location: ../index.php');
}
?>