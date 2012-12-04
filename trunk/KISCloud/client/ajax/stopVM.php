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
    if ($result["status"] == "run") {
        //Kill VM
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
        $vm_disk_path = $disk_path."".$disk_name.".qcow2";
        
        $vm = new VM();
        $vmDelegate = new VMDelegate($vm);
        $vmDelegate->stopVM($ip, $ssh_username, $ssh_password, $ssh_fingerprint, $vm_disk_path);
        //Kill Proxy
        $requetManager = $bdd->query("SELECT * FROM MANAGER;");
        $resultManager = $requetManager->fetch();
        $ip_manager = "127.0.0.1";
        $ssh_username_manager = $resultManager['ssh_login_manager'];
        $ssh_password_manager = $resultManager['ssh_password'];
        $ssh_fingerprint_manager = $resultManager['ssh_finger_print'];
        $vmDelegate->stopConsole($ip_manager, $ssh_username_manager, $ssh_password_manager, $ssh_fingerprint_manager, 5900+$port_proxy);
        //Update Database
        $requetUpdateVMStatus = $bdd->query("UPDATE VM SET status='sto', port_vnc=null, port_proxy=null, id_noeud=null WHERE id_vm='" . $id_vm . "';");
        
        echo 1;
    } else {
        echo "-1";
    }
} else {
    echo "-2";
}

?>
