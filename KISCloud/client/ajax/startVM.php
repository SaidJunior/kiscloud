<?php

session_start();    // on a besoin de la session pour connaitre l'id du pelo et son login
include_once "../../include/global.php";

// on recup l'id BDD de la sauvegarde à effectuer et du booleen de delete   
$id_vm = $_POST['id'];
$id_user = $_SESSION['id_user'];

$requet1 = $bdd->query("SELECT * FROM VM WHERE id_vm='" . $id_vm . "';");
$result = $requet1->fetch();

if ($result["id_user"] == $id_user) {

// si tous c'est bien passé on envoi l'id BDD de la derniere insertion, 0 sinon
    if ($result["status"] == "sto") {
        //TODO ici appeler le script de clem pour creer le dossier user et le disque
        //Selectionner un noeud
        $requet_node = $bdd->query("SELECT * FROM NOEUD WHERE status_node='UP' order by ram_free desc LIMIT 1;");
        $resultNode = $requet_node->fetch();
        $node_id = $resultNode['id_noeud'];
        //Set du noeud dans la db
        $requetUpdateVMNode = $bdd->query("UPDATE VM SET id_noeud='" . $node_id . "' WHERE id_vm='" . $id_vm . "';");
        //selectionner un port vnc libre sur le noeud
        $requet_vnc = $bdd->query("SELECT v.port_vnc FROM VM v JOIN NOEUD n ON v.id_noeud=n.id_noeud WHERE status='run' order by v.port_vnc;");
        $port_vnc = 1;
        $port_vnc_find = false;
        while (($resultVnc = $requet_vnc->fetch()) && !$port_vnc_find) {
            if ($port_vnc == $resultVnc['port_vnc']) {
                $port_vnc++;
            } else {
                $port_vnc_find = true;
            }
        }
        //Set du port vnc dans la db
        $requetUpdateVMVNC = $bdd->query("UPDATE VM SET port_vnc='" . $port_vnc . "' WHERE id_vm='" . $id_vm . "';");
        //selectionner un port vnc_proxy libre sur le master
        $requet_proxy = $bdd->query("SELECT v.port_proxy FROM VM v WHERE status='run' order by v.port_proxy;");
        $port_proxy = 1;
        $port_proxy_find = false;
        while (($resultProxy = $requet_proxy->fetch()) && !$port_proxy_find) {
            if ($port_proxy == $resultProxy['port_proxy']) {
                $port_proxy++;
            } else {
                $port_proxy_find = true;
            }
        }
        //Set du port vnc_proxy dans la db
        $requetUpdateVMProxy = $bdd->query("UPDATE VM SET port_proxy='" . $port_proxy . "' WHERE id_vm='" . $id_vm . "';");
        //Appel core avec les params pour start la vm
        $requetVMInfos = $bdd->query("SELECT n.ip_noeud, n.ssh_login_node, n.ssh_password_node, n.ssh_fingerprint, v.id_user, v.nom_vm, v.systeme, v.nb_processeur_vm, v.ram_vm, v.port_vnc, v.port_proxy, d.nom_disk, d.path_nas_virtual_disk, i.name_iso
FROM VM v JOIN VM_DISK vd ON v.id_vm=vd.id_vm
JOIN VIRTUAL_DISK d ON vd.id_virtual_disk=d.id_virtual_disk
JOIN ISO i ON v.id_iso=i.id_iso
JOIN NOEUD n ON v.id_noeud=n.id_noeud
WHERE v.id_user='".$id_user."' AND v.id_vm='".$id_vm."';");
        $resultVMInfos = $requetVMInfos->fetch();
        
        $ip = $resultVMInfos['ip_noeud'];
        $ssh_username = $resultVMInfos['ssh_login_node'];
        $ssh_password = $resultVMInfos['ssh_password_node'];
        $ssh_fingerprint = $resultVMInfos['ssh_fingerprint'];
        $id_user = $resultVMInfos['id_user'];
        $vm_nom = $resultVMInfos['nom_vm'];
        $vm_systeme = $resultVMInfos['systeme'];
        $vm_nb_processeur = $resultVMInfos['nb_processeur_vm'];
        $vm_ram = $resultVMInfos['ram_vm'];
        $port_vnc = $resultVMInfos['port_vnc'];
        $port_proxy = $resultVMInfos['port_proxy'];
        $disk_name = $resultVMInfos['nom_disk'];
        $disk_path = $resultVMInfos['path_nas_virtual_disk'];
        $iso = "/opt/KISCloud/nfs/users/".$id_user."/isos/".$resultVMInfos['name_iso'];
        
        $vm = new VM();
        $vmDelegate = new VMDelegate($vm);
        $vmDelegate->startVM($ip, $ssh_username, $ssh_password, $ssh_fingerprint, $vm_nom, $vm_systeme, $vm_nb_processeur, $vm_ram, $disk_name, $disk_path, $iso, $port_vnc);
        
        $requetUpdateVMStatus = $bdd->query("UPDATE VM SET status='run' WHERE id_vm='" . $id_vm . "';");
        
        //Start du script SH sur le manager
        $requetManager = $bdd->query("SELECT * FROM MANAGER;");
        $resultManager = $requetManager->fetch();
        $ip_manager = "127.0.0.1";
        $ssh_username_manager = $resultManager['ssh_login_manager'];
        $ssh_password_manager = $resultManager['ssh_password'];
        $ssh_fingerprint_manager = $resultManager['ssh_finger_print'];
        $path_script=$PATH_FILE."/client/no-vnc/utils/wsproxy.py";
        $vmDelegate->startConsole($ip_manager, $ssh_username_manager, $ssh_password_manager, $ssh_fingerprint_manager, $path_script, $ip, 5900+$port_vnc, 5900+$port_proxy);
        
        echo 1;
    } else {
        echo "-1";
    }
} else {
    echo "-2";
}
?>
