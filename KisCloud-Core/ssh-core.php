<?php

class SSHcore {

    // SSH Host 
    private $ssh_host = null;
    // SSH Port 
    private $ssh_port = 22;
    // SSH Server Fingerprint 
    private $ssh_server_fp = null;
    // SSH_Check_Fingerprint
    private $check_fp = null;
    // SSH Username 
    private $ssh_auth_user = null;
    // SSH Public Key File 
    private $ssh_auth_pub = '/home/username/.ssh/id_rsa.pub';
    // SSH Private Key File 
    private $ssh_auth_priv = '/home/username/.ssh/id_rsa';
    // SSH Private Key Passphrase (null == no passphrase) / Password 
    private $ssh_auth_pass = null;
    // SSH Connection 
    private $connection = null;
    // SSH Methode
    private static $methods = array(
        'kex' => 'diffie-hellman-group1-sha1',
        'client_to_server' => array(
            'crypt' => '3des-cbc',
            'comp' => 'none'),
        'server_to_client' => array(
            'crypt' => 'aes256-cbc,aes192-cbc,aes128-cbc',
            'comp' => 'none'));
    // SSH Callbacks
    private static $callbacks = array('disconnect' => 'my_ssh_disconnect');

    public function __construct($ssh_host, $ssh_port, $ssh_server_fp) {
        $this->ssh_host = $ssh_host;
        $this->ssh_port = $ssh_port;
        $this->ssh_server_fp = $ssh_server_fp;
    }

    public function getSsh_host() {
        return $this->ssh_host;
    }

    private function setSsh_host($ssh_host) {
        $this->ssh_host = $ssh_host;
    }

    public function getSsh_port() {
        return $this->ssh_port;
    }

    private function setSsh_port($ssh_port) {
        $this->ssh_port = $ssh_port;
    }

    public function getSsh_server_fp() {
        return $this->ssh_server_fp;
    }

    private function setSsh_server_fp($ssh_server_fp) {
        $this->ssh_server_fp = $ssh_server_fp;
    }

    public function getSsh_auth_user() {
        return $this->ssh_auth_user;
    }

    private function setSsh_auth_user($ssh_auth_user) {
        $this->ssh_auth_user = $ssh_auth_user;
    }

    public function getSsh_auth_pub() {
        return $this->ssh_auth_pub;
    }

    private function setSsh_auth_pub($ssh_auth_pub) {
        $this->ssh_auth_pub = $ssh_auth_pub;
    }

    public function getSsh_auth_priv() {
        return $this->ssh_auth_priv;
    }

    private function setSsh_auth_priv($ssh_auth_priv) {
        $this->ssh_auth_priv = $ssh_auth_priv;
    }

    public function getSsh_auth_pass() {
        return $this->ssh_auth_pass;
    }

    private function setSsh_auth_pass($ssh_auth_pass) {
        $this->ssh_auth_pass = $ssh_auth_pass;
    }

    public function getConnection() {
        return $this->connection;
    }

    private function setConnection($connection) {
        $this->connection = $connection;
    }

    private function connect() {
        if (!($this->connection = ssh2_connect($this->ssh_host, $this->ssh_port))) {
            throw new Exception('Cannot connect to server');
        }
        if ($this->check_fp) {
            $fingerprint = ssh2_fingerprint($this->connection, SSH2_FINGERPRINT_MD5 | SSH2_FINGERPRINT_HEX);
            if (strcmp($this->ssh_server_fp, $fingerprint) !== 0) {
                throw new Exception('Unable to verify server identity!');
            }
        }
    }

    public function init_connection() {
        $this->check_fp = false;
        $this->connect();
        $this->ssh_server_fp = ssh2_fingerprint($this->connection);
    }
    
    public function connect_password($ssh_auth_user, $ssh_auth_pass) {
        $this->check_fp = true;
        $this->ssh_auth_user = $ssh_auth_user;
        $this->ssh_auth_pass = $ssh_auth_pass;
        $this->connect();

        if (!ssh2_auth_password($this->connection, $this->ssh_auth_user, $this->ssh_auth_pass)) {
            throw new Exception('Autentication rejected by server');
        }
    }

    public function connect_pubkey($ssh_auth_user, $ssh_auth_pub, $ssh_auth_priv, $ssh_auth_pass) {
        $this->check_fp = true;
        $this->ssh_auth_user = $ssh_auth_user;
        $this->ssh_auth_pub = $ssh_auth_pub;
        $this->ssh_auth_priv = $ssh_auth_priv;
        $this->ssh_auth_pass = $ssh_auth_pass;
        $this->connect();

        if (!ssh2_auth_pubkey_file($this->connection, $this->ssh_auth_user, $this->ssh_auth_pub, $this->ssh_auth_priv, $this->ssh_auth_pass)) {
            throw new Exception('Autentication rejected by server');
        }
    }

    public function exec($cmd) {
        if (!($stream = ssh2_exec($this->connection, $cmd))) {
            throw new Exception('SSH command failed');
        }
        stream_set_blocking($stream, true);
        $data = "";
        while ($buf = fread($stream, 4096)) {
            $data .= $buf;
        }
        fclose($stream);
        return $data;
    }

    private function my_ssh_disconnect($reason, $message, $language) {
        printf("Server disconnected with reason code [%d] and message: %s\n", $reason, $message);
    }

    public function disconnect() {
        $this->exec('echo "EXITING" && exit;');
        $this->connection = null;
    }

    public function __destruct() {
        $this->disconnect();
    }

}

?>
