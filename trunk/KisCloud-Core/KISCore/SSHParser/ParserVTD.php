<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ParserVTD
 *
 * @author clement
 */
class ParserVTD extends SSHParser {

    public function __construct($coreObject) {
        parent::__construct($coreObject);
    }

    public function parseExec_output() {
        $pattern = '/vmx/i';
        preg_match($pattern, $this->getExec_output(), $matches);
        if (count($matches)==0) {
            //No VMX virtualization
            $pattern = '/svm/i';
            preg_match($pattern, $this->getExec_output(), $matches);
            if (count($matches)>0) {
                //SVM Virtualisation
                $this->getCoreObject()->setVtd_enabled(true);
                $this->getCoreObject()->setVtd_type("svm");
            }else{
                $this->getCoreObject()->setVtd_enabled(false);
            }
        } else {
            //VMX virtualisation
            $this->getCoreObject()->setVtd_enabled(true);
            $this->getCoreObject()->setVtd_type("vmx");
        }
    }

}

?>
