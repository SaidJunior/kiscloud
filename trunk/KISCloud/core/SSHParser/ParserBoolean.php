<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class ParserBoolean extends SSHParser {

    public function __construct($coreObject) {
        parent::__construct($coreObject);
    }

    public function parseExec_output() {
        
    }
    
    public function parseExistFile(){
        $find=false;
        $pattern = '/No such file or directory/i';
        //Check only error
        preg_match($pattern, $this->getExec_error(), $matches);
        if (count($matches) != 0) {
            //Folder not create
            $find=false;
        }else{
            $find=true;
        }
        return $find;
    }

}

?>
