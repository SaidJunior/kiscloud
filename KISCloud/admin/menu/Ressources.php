<?php
session_start();
if ((isset($_SESSION['login'])) && (!empty($_SESSION['login'])) && isset($_SESSION['status_user']) && ($_SESSION['status_user'] == "admin")) {

    include_once '../../include/global.php';
    // ********* STORAGE *********
    $requetSelectStorageNFS = $bdd->query("SELECT disk_used_nfs,disk_free_nfs FROM NFS; "); // requete pour recup le total de la ram
    $resultSelectStorageNFS = $requetSelectStorageNFS->fetch();

    $storageFree = $resultSelectStorageNFS['disk_free_nfs'];
    $storageUsed = $resultSelectStorageNFS['disk_used_nfs'];
    $storageTotal = $storageFree + $storageUsed;



    // ********* CPU *********
    $requetSelectCpuTotal = $bdd->query("SELECT SUM(cpu_total) AS totalCpu FROM NOEUD; "); // requete pour recup le total du cpu
    $resultSelectCpuTotal = $requetSelectCpuTotal->fetch();
    $cpuTotal = $resultSelectCpuTotal['totalCpu'];

    $requetSelectCpuFree = $bdd->query("SELECT SUM(cpu_free) AS freeCpu FROM NOEUD; "); // requete pour recup du cpu libre
    $resultSelectCpuFree = $requetSelectCpuFree->fetch();
    $cpuFree = $resultSelectCpuFree['freeCpu'];

    // ********* RAM *********

    $requetSelectRamTotal = $bdd->query("SELECT SUM(ram_total) AS totalRam FROM NOEUD; "); // requete pour recup le total de la ram
    $resultSelectRamTotal = $requetSelectRamTotal->fetch();
    $ramTotal = $resultSelectRamTotal['totalRam'];

    $requetSelectRamFree = $bdd->query("SELECT SUM(ram_free) AS freeRam FROM NOEUD; "); // requete pour recup de la ram libre
    $resultSelectRamFree = $requetSelectRamFree->fetch();
    $ramFree = $resultSelectRamFree['freeRam'];

    //****** DISK PREVISIONNELLE *******//

    $requetSelectRealDisk = $bdd->query("SELECT SUM(taille_virtual_disk) AS realDisk FROM VIRTUAL_DISK; "); // requete pour recup de la ram libre
    $resultSelectRealDisk = $requetSelectRealDisk->fetch();
    $SumDiskVM = $resultSelectRealDisk['realDisk'];

    //****** RAM PREVISIONNELLE *******//
    $requetSelectRealRam = $bdd->query("SELECT SUM(ram_vm) AS realRam FROM VM; "); // requete pour recup de la ram libre
    $resultSelectRealRam = $requetSelectRealRam->fetch();
    $SumRamVM = $resultSelectRealRam['realRam'];



    $storageReel = ($storageTotal - $SumDiskVM);
    $ramReel = ($ramTotal - $SumRamVM);
    ?>
    <!--  *** RESSOURCES GLOBALES *** -->

    <legend></legend>
    <legend><h4><p class="text-info">Global Resources</p></h4></legend>

    <table class="table table-hover table-bordered table_ressources" > 

        <thead>  <!-- début table de tête -->
            <tr>
                <th>Storage</th>
                <th>CPU</th>
                <th>RAM</th>						 
            </tr>
        </thead> <!-- fin table de tête -->
        <tbody>  
            <tr>
                <td><h4><?php echo $storageTotal; ?> Go</h4></td>
                <td><h4><?php echo $cpuTotal; ?> GHz</h4></td>
                <td><h4><?php echo $ramTotal; ?> Mo</h4></td>     
            </tr>
        </tbody>      
    </table>


    <!--  *** RESSOURCES LIBRES *** -->
    <legend></legend>
    <legend><h4><p class="text-info">Current Resources (With Operating System Usages)</p></h4></legend>

    <table class="table table-hover table-bordered table_ressources" > 

        <thead>  <!-- début table de tête -->
            <tr>
                <th>Storage</th>
                <th>CPU</th>
                <th>RAM</th>						 
            </tr>
        </thead> <!-- fin table de tête -->   
        <tbody>       
            <tr>  
                <td>
                    <?php
                    if (($storageFree > $storageTotal / 10) && ($storageFree <= $storageTotal / 3.33)) {
                        ?>
                        <h4><p class="text-warning"><?php echo $storageFree; ?> Go</p></h4>
                        <?php
                    } else if ($storageFree <= $storageTotal / 10) {
                        ?>
                        <h4><p class="text-error"><?php echo $storageFree; ?> Go</p></h4>
                        <?php
                    } else {
                        ?>
                        <h4><p class="text-success"><?php echo $storageFree; ?> Go</p></h4>
                        <?php
                    }
                    ?>
                </td>
                <!--  *** CPU *** -->
                <td>                
                    <?php
                    if (($cpuFree > $cpuTotal / 10) && ($cpuFree <= $cpuTotal / 3.33)) {
                        ?>
                        <h4><p class="text-warning"><?php //echo $cpuFree; ?></p></h4>
                        <?php
                    } else if ($cpuFree <= $cpuTotal / 10) {
                        ?>
                        <h4><p class="text-error"><?php //echo $cpuFree; ?></p></h4>
                        <?php
                    } else {
                        ?>
                        <h4><p class="text-success"><?php //echo $cpuFree; ?></p></h4>
                        <?php
                    }
                    ?> 
                </td>
                <!--  *** RAM *** -->
                <td>
                    <?php
                    if (($ramFree <= $ramTotal / 10) && ($ramFree > $ramTotal / 3.33)) {
                        ?>
                        <h4><p class="text-warning"><?php echo $ramFree; ?> Mo</p></h4>
                        <?php
                    } else if ($ramFree <= $cpuTotal / 3.33) {
                        ?>
                        <h4><p class="text-error"><?php echo $ramFree; ?> Mo</p></h4>
                        <?php
                    } else {
                        ?>
                        <h4><p class="text-success"><?php echo $ramFree; ?> Mo</p></h4>
                        <?php
                    }
                    ?>
                </td>
            </tr>
        </tbody>
    </table>


    <!--  *** RESSOURCES REELLES *** -->


    <legend></legend>
    <legend><h4><p class="text-info">VMs Resources (If all VMs are running with full disk)</p></h4></legend>

    <table class="table table-hover table-bordered table_ressources" > 

        <thead>  <!-- début table de tête -->
            <tr>
                <th>Storage</th>
                <th>CPU</th>
                <th>RAM</th>						 
            </tr>
        </thead> <!-- fin table de tête -->   
        <tbody>       
            <tr>  
                <td>
                    <?php
                    if (($storageReel > $storageTotal / 10) && ($storageReel <= $storageTotal / 3.33)) {
                        ?>
                        <h4><p class="text-warning"><?php echo $storageReel; ?> Go</p></h4>
                        <?php
                    } else if ($storageReel <= $storageTotal / 10) {
                        ?>
                        <h4><p class="text-error"><?php echo $storageReel; ?> Go</p></h4>
                        <?php
                    } else {
                        ?>
                        <h4><p class="text-success"><?php echo $storageReel; ?> Go</p></h4>
                        <?php
                    }
                    ?>
                </td>

                <td>                 <!--  *** CPU *** -->
                    <?php
                    if ($cpuFree <= $cpuTotal / 10) {
                        ?>
                        <h4><p class="text-error"><?php echo ''; ?> </p></h4>
                        <?php
                    } else if ($cpuFree <= $cpuTotal / 3.33) {
                        ?>
                        <h4><p class="text-warning"><?php echo ''; ?> </p></h4>
                        <?php
                    } else {
                        ?>
                        <h4><p class="text-success"><?php echo ''; ?> </p></h4>
                        <?php
                    }
                    ?> 
                </td>
                <!--  *** RAM *** -->
                <td>
                    <?php
                    if (($ramReel > $ramTotal / 10) && ($ramReel <= $ramTotal / 3.33)) {
                        ?>
                        <h4><p class="text-warning"><?php echo $ramReel; ?> Mo</p></h4>
                        <?php
                    } else if ($ramReel <= $ramTotal / 10) {
                        ?>
                        <h4><p class="text-error"><?php echo $ramReel; ?> Mo</p></h4>
                        <?php
                    } else {
                        ?>
                        <h4><p class="text-success"><?php echo $ramReel; ?> Mo</p></h4>
                        <?php
                    }
                    ?>
                </td>
            </tr>
        </tbody>
    </table>



    <?php
} else {
    header('Location: ../index.php');
}
?>