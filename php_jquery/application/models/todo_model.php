<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Todo_Model extends CRUD_Model {

    protected $_table = 'todo';
    protected $_primary_key = 'todo_id';
    
    function __construct() {
        
        parent::__construct();
    }
}

?>
