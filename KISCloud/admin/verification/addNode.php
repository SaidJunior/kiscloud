<?php

session_start();

include_once '../../include/global.php';

$session = "";
$JS_LOAD = "";

if (!isset($_GET['s'])) {
    $session = uniqid('', true);
    $_SESSION['step_' . $session] = 0;
    $_SESSION['log_' . $session] = "";
    //Attributes
    $node = new Node();
    $nodeDelegate = new NodeDelegate($node);
    $_SESSION['delegate_' . $session] = serialize($nodeDelegate);
} else {
    $session = htmlentities($_GET['s']);
}

if (isset($_SESSION['step_' . $session]) && isset($_SESSION['log_' . $session])) {

    //Load Object State

    $nodeDelegate = unserialize($_SESSION['delegate_' . $session]);
    $node = $nodeDelegate->getCoreObject();
    $error = false;
    $JS_LOAD = "";

    switch ($_SESSION['step_' . $session]) {
        case 0:
            $_SESSION['step_' . $session]++;
            $JS_LOAD .= "<script type=\"text/javascript\">
                        sessionId='" . $session . "';
                        updateModalAddNode();
                    </script>";
            break;

        case 1:
            $_SESSION['log_' . $session] = ""; //Clear Session LOG 
            if (isset($_POST['ip']) && isset($_POST['login']) && isset($_POST['password'])) {
                $ip = htmlentities($_POST['ip']);
                $username = htmlentities($_POST['login']);
                $password = $_POST['password'];

                $nodeDelegate->getNodeRequirement($ip, $username, $password);

                $_SESSION['log_' . $session] .= "<p class=\"text-success\">Connecting to " . $username . ":*****@" . $ip . "</p>";
                $_SESSION['log_' . $session] .= "<p class=\"text-info\">Checking Hardware and OS requirements...</p>";

                if ($node->getVtd_enabled()) {
                    $_SESSION['log_' . $session] .= "<p class=\"text-success\">VT-d enabled on this host<br />VT-d type: " . $node->getVtd_type() . "</p>";
                } else {
                    $_SESSION['log_' . $session] .= "<p class=\"text-error\">VT-d not active on this host...</p>";

                    $_SESSION['log_' . $session] .= "<p class=\"text-warning\">(verification/addNode.php:: Please uncomment \$error in production mode)</p>";
                    //$error = true;
                }

                if ($node->getValid_centos()) {
                    $_SESSION['log_' . $session] .= "<p class=\"text-success\">CentOS version: " . $node->getCentos_version() . "</p>";
                } else {
                    $_SESSION['log_' . $session] .= "<p class=\"text-error\">No CentOS 6.x OS</p>";
                    $error = true;
                }

                if ($node->getArch64bit()) {
                    $_SESSION['log_' . $session] .= "<p class=\"text-success\">64 bit kernel supported</p>";
                } else {
                    $_SESSION['log_' . $session] .= "<p class=\"text-error\">64 bit kernel not supported</p>";
                    $error = true;
                }
                
                $nodeDelegate->checkRAMUsage($ip, $username, $password, $node->getSsh_fingerprint());
                
            } else {
                $error = true;
                $_SESSION['log_' . $session] .= "<p class=\"text-error\">Unabled to receive the data's form...</p>";
            }
            //end
            if ($error) {
                $JS_LOAD .= "<script type=\"text/javascript\">
                        finished=true;
                        $('#loading').html('<p class=\"text-error\">Error, we can\'t install this node...</p>');
                        $('#modalAddNodeVerificationButton').attr('class', 'btn btn-danger');
                        $('#modalAddNodeVerificationButton').html('Close');
                    </script>";
            } else {
                $_SESSION['step_' . $session]++;
                $JS_LOAD .= "<script type=\"text/javascript\">
                        updateModalAddNode();
                    </script>";
            }
            break;

        case 2:
            $_SESSION['log_' . $session] .= "<p class=\"text-info\">Checking packages dependencies...</p>";

            if ($node->getQemu_image()) {
                $_SESSION['log_' . $session] .= "<p class=\"text-success\">'qemu-img' installed</p>";
            } else {
                $_SESSION['log_' . $session] .= "<p class=\"text-error\">'qemu-img' not found</p>";
                $error = true;
            }
            $_SESSION['log_' . $session] .= "<p class=\"text-warning\">Need to check all packages</p>";

            //end
            if ($error) {
                //Go step 3
                $_SESSION['step_' . $session] = 3;
            } else {
                //Go step 4
                $_SESSION['step_' . $session] = 4;
            }
            $JS_LOAD .= "<script type=\"text/javascript\">
                        updateModalAddNode();
                    </script>";
            break;

        case 3:
            //Install dependency
            $_SESSION['log_' . $session] .= "<p class=\"text-info\">Installing dependencies...</p>";

            $nodeDelegate->installNodeRequirement($node->getIp(), $node->getSsh_username(), $node->getSsh_password(), $node->getSsh_fingerprint());

            //-> Go to step 2
            $_SESSION['step_' . $session] = 2;

            //Check Errors ???
            //end
            $JS_LOAD .= "<script type=\"text/javascript\">
                        updateModalAddNode();
                    </script>";
            break;

        case 4:
            //Dependency Installed
            //Check NFS Folder
            $_SESSION['log_' . $session] .= "<p class=\"text-info\">Checking NFS Folder configuration...</p>";

            $nodeDelegate->checkNFSFolder($node->getIp(), $node->getSsh_username(), $node->getSsh_password(), $node->getSsh_fingerprint());

            if ($node->getNfs_folder_created()) {
                //Go to step 6
                $_SESSION['log_' . $session] .= "<p class=\"text-success\">NFS Folder configured</p>";
                $_SESSION['step_' . $session] = 6;
            } else {
                //Go to step 5
                $_SESSION['log_' . $session] .= "<p class=\"text-error\">NFS Folder not configured</p>";
                $_SESSION['step_' . $session] = 5;
            }

            //end
            $JS_LOAD .= "<script type=\"text/javascript\">
                        updateModalAddNode();
                    </script>";
            break;

        case 5:
            //Create NFS Forlder Configuration
            $_SESSION['log_' . $session] .= "<p class=\"text-info\">Create NFS Folder Configuration...</p>";

            $nodeDelegate->installNFSFolder($node->getIp(), $node->getSsh_username(), $node->getSsh_password(), $node->getSsh_fingerprint());
            //Go to step 4
            $_SESSION['step_' . $session] = 4;
            //End
            $JS_LOAD .= "<script type=\"text/javascript\">
                        updateModalAddNode();
                    </script>";
            break;

        case 6:
            //Check NFS FSTAB Configuration
            ////////////////////////////
            // Requete SQL Vers NFS
            ////////////////////////////
            $requetSelectNFS = $bdd->query("SELECT * FROM NFS;"); // requete pour recup le nombre de manager
            $resultSelectNFS = $requetSelectNFS->fetch();
            $ip_nfsServer = $resultSelectNFS['ip_nfs'];
            $path = $resultSelectNFS['path_nfs'];

            ////////////////////////////
            $_SESSION['log_' . $session] .= "<p class=\"text-info\">Checking NFS Configuration...</p>";
            $nodeDelegate->checkNFSConfiguration($node->getIp(), $node->getSsh_username(), $node->getSsh_password(), $node->getSsh_fingerprint(), $ip_nfsServer, $path);

            if ($node->getNfs_configured()) {
                //Go to step 8
                $_SESSION['log_' . $session] .= "<p class=\"text-success\">NFS Configuration OK</p>";
                $_SESSION['step_' . $session] = 8;
            } else {
                //Go to step 7
                $_SESSION['log_' . $session] .= "<p class=\"text-error\">NFS Not Configured</p>";
                $_SESSION['step_' . $session] = 7;
            }

            //End
            $JS_LOAD .= "<script type=\"text/javascript\">
                        updateModalAddNode();
                    </script>";
            break;

        case 7:
            //Configure NFS Fstab
            ////////////////////////////
            // Requete SQL Vers NFS
            ////////////////////////////
            $ip_nfsServer = "192.168.56.10";
            $path = "/opt/KISStorage/";
            $_SESSION['log_' . $session] .= "<p class=\"text-warning\">Need to do SQL Request for NFS Config</p>";
            ////////////////////////////
            $_SESSION['log_' . $session] .= "<p class=\"text-info\">Configuring NFS...</p>";
            $nodeDelegate->installNFSConfiguration($node->getIp(), $node->getSsh_username(), $node->getSsh_password(), $node->getSsh_fingerprint(), $ip_nfsServer, $path);

            //go to step 6
            $_SESSION['step_' . $session] = 6;
            //End
            $JS_LOAD .= "<script type=\"text/javascript\">
                        updateModalAddNode();
                    </script>";
            break;

        case 8:
            //Checking NFS Mount Point
            $_SESSION['log_' . $session] .= "<p class=\"text-info\">Checking NFS Mount Point...</p>";
            $nodeDelegate->checkNFSMountPoint($node->getIp(), $node->getSsh_username(), $node->getSsh_password(), $node->getSsh_fingerprint());

            if ($node->getNfs_folder_mounted()) {
                //go to step 10
                $_SESSION['step_' . $session] = 10;
                $_SESSION['log_' . $session] .= "<p class=\"text-success\">NFS Folder Mounted Correctly</p>";
            } else {
                //go to step 9
                $_SESSION['step_' . $session] = 9;
                $_SESSION['log_' . $session] .= "<p class=\"text-error\">NFS Folder Not Mounted</p>";
            }
            //End
            $JS_LOAD .= "<script type=\"text/javascript\">
                        updateModalAddNode();
                    </script>";
            break;

        case 9:
            //Mount NFS Folder
            $_SESSION['log_' . $session] .= "<p class=\"text-info\">Mounting NFS Folder...</p>";
            $nodeDelegate->mountNFSMountPoint($node->getIp(), $node->getSsh_username(), $node->getSsh_password(), $node->getSsh_fingerprint());

            //go to step 8 
            $_SESSION['step_' . $session] = 8;
            //end
            $JS_LOAD .= "<script type=\"text/javascript\">
                        updateModalAddNode();
                    </script>";
            break;

        case 10:
            $_SESSION['log_' . $session] .= "<p class=\"text-info\">Add Node in the database...</p>";

            //DB
            //connexion à la base
            // insertion
            $bdd->query("INSERT INTO NOEUD VALUES(default,'" . $node->getIp() . "','" . $node->getSsh_username() . "','" . $node->getSsh_password() . "','" . $node->getSsh_fingerprint() . "','" . $node->getRam_total() . "', '" . $node->getRam_free() . "',  '" . $node->getCpu_total() . "','" . $node->getCpu_free() . "','" . $node->getCentos_version() . "','" . $node->getVtd_type() . "',null,null);");
            //$node->ram;
            //$node->nbproc;
            $_SESSION['log_' . $session] .= "<p class=\"text-success\">Node added in the database.</p>";

            $_SESSION['log_' . $session] .= "<p class=\"text-success\">Node Added in the infrastructure</p>";
            $JS_LOAD .= "<script type=\"text/javascript\">
                        finished=true;
                        $('#loading').html('<p class=\"text-success\">Done</p>');
                        $('#modalAddNodeVerificationButton').attr('class', 'btn btn-success');
                        $('#modalAddNodeVerificationButton').html('Close');
                    </script>";
            break;
    }

    //Save Object State
    $_SESSION['delegate_' . $session] = serialize($nodeDelegate);

    //Print result
    echo $_SESSION['log_' . $session];
    echo $JS_LOAD;
}
?>
