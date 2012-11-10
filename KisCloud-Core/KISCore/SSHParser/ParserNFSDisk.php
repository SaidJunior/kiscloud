<?php

class ParserNFSDisk extends SSHParser {

    //put your code here·
    public function __construct($coreObject) {
        parent::__construct($coreObject);
    }

    function parseExec_output() {
        $pattern = '/\/opt\/KISCloud\/nfs/i';
 
        $tmp = explode("\n", $this->getExec_output());
        for ($i = 0; $i <= count($tmp); $i++) {
            //echo "index = " . $i . "<br />" . $tmp[$i] . "<br />";
            preg_match($pattern, $tmp[$i], $matches);
            if (count($matches) > 0) {
                //echo "index = " . $i . "<br />" . $tmp[$i] . "<br />";
                $data = preg_split(" ", $tmp[$i], PREG_SPLIT_NO_EMPTY);
                $data = explode(" ", trim($tmp[$i]));
                //var_dump($data);
            }
        }
        $this->getCoreObject()->setNfs_disk_size(round(intval($data[0]) / 1048576, 2));
        $this->getCoreObject()->setNfs_disk_free(round(intval($data[7]) / 1048576, 2));
    }

}

?>