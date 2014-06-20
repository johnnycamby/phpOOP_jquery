<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class User_Model extends CRUD_Model {

    protected $_table = 'user';
    protected $_primary_key = 'user_id';
    
    function __construct() {
        
        parent::__construct();
    }
}

?>
