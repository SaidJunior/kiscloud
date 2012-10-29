<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ParserNFSFolder
 *
 * @author clement
 */
class ParserUserFolder extends SSHParser {
    
    public function __construct($coreObject) {
        parent::__construct($coreObject);
    }

    public function parseExec_output() {
        //Error: ls: cannot access /opt/KISCloud/nfs/: No such file or directory
        $pattern = '/No such file or directory/i';
        //Check only error
        preg_match($pattern, $this->getExec_error(), $matches);
        if (count($matches) != 0) {
            //Folder not create
            $this->getCoreObject()->setUser_folder_created(false);
        }else{
            $this->getCoreObject()->setUser_folder_created(true);
        }
    }
    //put your code here
}

?>
