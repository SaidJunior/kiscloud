<?php

class ParserNFSDisk extends SSHParser {

    //put your code here·
    public function __construct($coreObject) {
        parent::__construct($coreObject);
    }

    function parseExec_output() {
        $pattern = '/\/opt\/KISCloud\/nfs/i';
        $info = array();

        $tmp = explode("\n", $this->getExec_output());
        for ($i = 0; $i <= count($tmp); $i++) {
            //echo "index = " . $i . "<br />" . $tmp[$i] . "<br />";
            $found = preg_match($pattern, $tmp[$i], $matches = null);
            if ($found == 1) {
                //echo "index = " . $i . "<br />" . $tmp[$i] . "<br />";
                $data = explode(' ', $tmp[$i]);
                for ($j = 0; $j <= count($data); $j++) {
                    if ($data[$j] != null && $data[$j] != " ")
                        $info[] = $data[$j];
                }
                //var_dump($info);
            }
        }
        $this->getCoreObject()->setNfs_disk_size(round(intval($info[0]) / 1048576, 2));
        $this->getCoreObject()->setNfs_disk_free(round(intval($info[2]) / 1048576, 2));
    }

}

?>