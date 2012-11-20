<?php

session_start();
if ((isset($_SESSION['login'])) && (!empty($_SESSION['login'])) && isset($_SESSION['status_user']) && ($_SESSION['status_user'] == "admin")) {
    include_once '../../include/global.php';
//connexion à la base

    if (isset($_POST["ip_NFS"]) && isset($_POST["path_NFS"])) {
        $ip_nfsServer = htmlentities($_POST["ip_NFS"]);
        $path = htmlentities($_POST["path_NFS"]);
        //$ip_nfsServer = "192.168.56.10";
        //$path = "/opt/KISStorage/";
//SQL
        $ip = "127.0.0.1";
        $ssh_username = "root";
        $ssh_password = "azerty";
        $ssh_fingerprint = "27C2CA58D4B66FF39C0E38BF4D5CD7B9";


        $error = false;
        $JS_LOAD = "<script type=\"text/javascript\">$('#consoleConfManager').html('";

        $manager = new Manager();
        $managerDelegate = new ManagerDelegate($manager);

        $managerDelegate->checkNFSFolder($ip, $ssh_username, $ssh_password, $ssh_fingerprint);

        if (!$manager->getNfs_folder_created()) {
            $managerDelegate->installNFSFolder($ip, $ssh_username, $ssh_password, $ssh_fingerprint);
            $managerDelegate->checkNFSFolder($ip, $ssh_username, $ssh_password, $ssh_fingerprint);
            if ($manager->getNfs_folder_created()) {
                $error = true;
                $JS_LOAD .= "<div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>Unable to create NFS Folder.</div>";
            }
        }

        if (!$error) {
            $managerDelegate->checkNFSConfiguration($ip, $ssh_username, $ssh_password, $ssh_fingerprint, $ip_nfsServer, $path);
            if (!$manager->getNfs_configured()) {
                $managerDelegate->installNFSConfiguration($ip, $ssh_username, $ssh_password, $ssh_fingerprint, $ip_nfsServer, $path);
                $managerDelegate->checkNFSConfiguration($ip, $ssh_username, $ssh_password, $ssh_fingerprint, $ip_nfsServer, $path);
                if (!$manager->getNfs_configured()) {
                    $error = true;
                    $JS_LOAD .= "<div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>Unable to configure NFS.</div>";
                }
            }
        }

        if (!$error) {
            $managerDelegate->umountNFSMountPoint($ip, $ssh_username, $ssh_password, $ssh_fingerprint);
            $managerDelegate->checkNFSMountPoint($ip, $ssh_username, $ssh_password, $ssh_fingerprint);
            if (!$manager->getNfs_folder_mounted()) {
                $managerDelegate->mountNFSMountPoint($ip, $ssh_username, $ssh_password, $ssh_fingerprint);
                $managerDelegate->checkNFSMountPoint($ip, $ssh_username, $ssh_password, $ssh_fingerprint);
                if (!$manager->getNfs_folder_mounted()) {
                    $error = true;
                    $JS_LOAD .= "<div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>Unable to mount NFS folder<br />Please verify the NFS IP Address and Path<br />Please verify if the remote NFS Folder contain the folder \"users\"</div>";
                }
            }
        }

        if (!$error) {
            $managerDelegate->checkNFSDisk($ip, $ssh_username, $ssh_password, $ssh_fingerprint);
            //SQL
            $disk_size = $manager->getNfs_disk_size();
            $disk_free = $manager->getNfs_disk_free();
            $requetDeleteNFS = $bdd->query("DELETE FROM NFS;");
            $requetAddNFS = $bdd->query("INSERT INTO NFS VALUES(default,'$ip_nfsServer','$path', '$disk_size', '$disk_free');");
            $JS_LOAD .= "<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>NFS is configured correctly.</div>";
            $requetDeleteNFS->closeCursor();
            $requetAddNFS->closeCursor();
        }

        $JS_LOAD .= "');</script>";

        echo $JS_LOAD;
    }
} else {
    header('Location: ../index.php');
}
?>
