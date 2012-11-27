<?php

class ParserDiskFile extends SSHParser {

    public function __construct($coreObject) {
        parent::__construct($coreObject);
    }

    function parseExec_output() {
        //Error: ls: cannot access /opt/KISCloud/nfs/: No such file or directory
        $pattern = '/No such file or directory/i';
        //Check only error
        preg_match($pattern, $this->getExec_error(), $matches);
        if (count($matches) != 0) {
            //Folder not create
            $this->getCoreObject()->setDisk_file_created(false);
        } else {
            $this->getCoreObject()->setDisk_file_created(true);
        }
    }
}

?>
