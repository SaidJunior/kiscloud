<?php
session_start();
if ((isset($_SESSION['login'])) && (!empty($_SESSION['login'])) && isset($_SESSION['status_user']) && ($_SESSION['status_user'] == "admin")) {
    ?>
    <form name="formulaire" action="#" id="formulaire" class="form-horizontal">

        <!-- IP -->
        <div class="control-group">
            <label class="control-label" for="ipNode">IP Address</label>
            <div class="controls">
                <input type="text" id="ipNode" rel="tooltip" data-placement="right" >
            </div>
        </div>


        <!-- login node -->
        <div class="control-group">
            <label class="control-label" for="sshLoginNode">Login ssh</label>
            <div class="controls">
                <input type="text" id="sshLoginNode" rel="tooltip" disabled="true" value="root" data-placement="right">
            </div>
        </div>

        <!-- password node -->
        <div class="control-group">
            <label class="control-label" for="sshPasswordNode">Password ssh</label>
            <div class="controls">
                <input type="password" id="sshPasswordNode" rel="tooltip" data-placement="right">
            </div>
        </div>

    </div>

    </form>

    <?php
} else {
    header('Location: ../index.php');
}
?>