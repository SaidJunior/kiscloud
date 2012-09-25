<?php
include ("ssh-core.php");

$sshCore = new SSHcore("192.168.56.20", "22", null);
$sshCore->init_connection();
$sshCore->connect_password("root", "azerty");
echo $sshCore->exec("cat /proc/self/maps ; pwd ; ls -l");

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
