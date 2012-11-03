<?php

class ParserCPUUsage extends SSHParser {

    //put your code here·
    public function __construct($coreObject) {
        parent::__construct($coreObject);
    }

    function parseExec_output() {
        //$data = explode("\n", $this->getExec_output(), -88);
        $data = explode("\n", $this->getExec_output());
        $data2 = explode(',', $data[2]);
        $cpuinfo = explode("%", $data2[3]);
        $cpu_libre = $cpuinfo[0];

        $this->getCoreObject()->setCpu_free($cpu_libre);
    }
}

?>
