<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Note_Model extends CRUD_Model {

    protected $_table = 'note';
    protected $_primary_key = 'note_id';
    
    function __construct() {
        
        parent::__construct();
    }
}

?>
