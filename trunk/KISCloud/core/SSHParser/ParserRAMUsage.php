<?php

class ParserRAMUsage extends SSHParser {

    //put your code here·
    public function __construct($coreObject) {
        parent::__construct($coreObject);
    }

    function parseExec_output() {
        //$data = explode("\n", file_get_contents("/proc/meminfo"));
        $data = explode("\n", $this->getExec_output());
        $meminfo = array();
        foreach ($data as $line) {
            @list($key, $val) = explode(":", $line);
            $meminfo[$key] = trim($val);
        }
        //return $meminfo;
        //removes the KB then...
        //...conversion en Mega Octet en division par 1024
        $tmp = (explode (" ", $meminfo['MemTotal']));
        $this->getCoreObject()->setRam_total(intval(($tmp[0]) / 1024));
        $tmp = (explode (" ", $meminfo['MemFree']));
        $this->getCoreObject()->setRam_free(intval(($tmp[0]) / 1024));
    }

}

?>