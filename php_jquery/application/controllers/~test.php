<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Test extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('user_model');
      
        /*retrieve data*/
        // $result = $this->user_model->get();
        //$result = $this->user_model->get(array('user_id' => 3, 'login' => 'johnny'));
       // $result = $this->user_model->get(array('login !=' => 'johnny'));
        
        /*insert data*/
       // $result = $this->user_model->insert( ['login' => 'emmy1'] );
        //$result = $this->user_model->insert( ['login' => 'emmy1'] );
        //$result = $this->user_model->insert( ['login' => 'emmy1'] );
        
        /* delete data*/
        //$result = $this->user_model->delete(4);
        //$result = $this->user_model->delete(['login' => 'emmy1']);
         
         /* update data*/
         //$result = $this->user_model->update(['password' => 'piggy'], 5);
        // $result = $this->user_model->update(['password' => 'piggy', 'login' => 'henny'],5 );
        
        /* insertUpdate data*/
        $result = $this->user_model->insertUpdate(['login' => 'Donny2'], 18);
        
        echo '<pre>';
        print_r($result);
        
        
    }
    
    public function index(){
        
        $this->output->enable_profiler(true);
    }





    /*=============== TESTS ============================================*/
    public function test_get() {

        $data = $this->user_model->get(2);
        print_r($data);

        $this->output->enable_profiler();
    }

    public function insert() {

        $data = array('login' => 'jethro');
        $this->user_model->insert($data);
    }

    public function update() {

        // $data = array( 'login' => 'Peggy');
        $this->user_model->update(['login' => 'Peggy'], 1);
    }

    public function delete() {

        $this->user_model->delete(2);
    }

}

?>
