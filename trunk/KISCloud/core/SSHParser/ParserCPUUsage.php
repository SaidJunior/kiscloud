<?php

class ParserCPUUsage extends SSHParser {

    //put your code here·
    public function __construct($coreObject) {
        parent::__construct($coreObject);
    }

    function parseExec_output() {
        //$data = explode("\n", $this->getExec_output(), -88);
        $data = explode("\n", $this->getExec_output(), 4);
        $data2 = explode(',', $data[2]);
        //removes the CPU: from the table
        $data3 = end(explode(':', $data2[0]));

        $cpu_used = floatval($data3);
        $cpu_libre = floatval($data2[3]);

        $this->getCoreObject()->setCpu_free($cpu_libre);
        $this->getCoreObject()->setCpu_used($cpu_used);
        //$this->getCoreObject()->setCpu_total();
    }
}

?>
