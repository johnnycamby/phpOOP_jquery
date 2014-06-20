<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class MY_Form_validation extends CI_Form_validation {

    function __construct($config = array()) {
        
        parent::__construct($config);
    }

    
    public function error_array(){
        
        if (count($this->_error_array > 0)) {
            
        
            return $this->_error_array;
            
        }
        
        
    }
}
?>
