<?php

class ParserCPUInfo extends SSHParser {

    //put your code here·
    public function __construct($coreObject) {
        parent::__construct($coreObject);
    }

    function parseExec_output() {

        $pattern = '/processor/i';
        preg_match($pattern, $this->getExec_output(), $matches);

        $data = explode("\n", $this->getExec_output());
        $cpuinfo = array();
        foreach ($data as $line) {
            @list($key, $val) = explode(":", $line);
            $cpuinfo[trim($key)] = trim($val);
        }
        //var_dump($cpuinfo);
        $this->getCoreObject()->setCpu_nb(count($matches));
        $this->getCoreObject()->setCpu_speed(intval($cpuinfo['cpu MHz']) * count($matches));
    }

}

?>
