<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Home extends CI_Controller {

     /*---------------------------------------------------------------------------------------------------*/
    public function index() {

        $this->load->view('home/inc/header_view');
        $this->load->view('home/home_view');
        $this->load->view('home/inc/footer_view');

        //  echo 'Home Page';
    }

     /*---------------------------------------------------------------------------------------------------*/
    
    public function register(){
        
        $this->load->view('home/inc/header_view');
        $this->load->view('home/register_view');
        $this->load->view('home/inc/footer_view');

    }
    /*public function code(){
        
        echo hash('sha256', 'admin' . SALT);
        
        
    }*/
    
     /*---------------------------------------------------------------------------------------------------*/
    

}

?>
