<?php

class ParserCPUInfo extends SSHParser {

    //put your code here·
    public function __construct($coreObject) {
        parent::__construct($coreObject);
    }

    function parseExec_output() {

        $pattern = '/processor/i';
        //$subject = "levellevel test test level level test love";
        //$multi = preg_match_all($pattern, $subject, $matches=null);
        //echo $multi . "<br />";
        $multiplier = preg_match_all($pattern, $this->getExec_output(), $matches = null);
        $data = explode("\n", $this->getExec_output());
        $cpuinfo = array();
        foreach ($data as $line) {
            @list($key, $val) = explode(":", $line);
            $cpuinfo[trim($key)] = trim($val);
        }
        $singleCpu = end(explode(" ", $cpuinfo['model name']));
        $this->getCoreObject()->setCpu_nb($multiplier);
        $this->getCoreObject()->setCpu_speed(floatval($singleCpu) * $multiplier);
    }

}

?>
