<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class CRUD_Model extends CI_Model {

    protected $_table = null;
    protected $_primary_key = null;

    /* ------------------------------------------------------------------------------------------------------------------------------------------------------------ */

    function __construct() {

        parent::__construct();
    }

    /* ------------------------------------------------------------------------------------------------------------------------------------------------------------ */

    /**
     * @usage 
     * All records   :: $this->user_model->get()
     * Single record :: $this->user_model->get(2)
     * Custom        :: $this->user_model->get(array('any' => 'param'))
     */
    public function get($id = null, $order_by = null) {

        if (is_numeric($id)) {

            $this->db->where($this->_primary_key, $id);
        } if (is_array($id)) {

            foreach ($id as $_key => $_value) {

                $this->db->where($_key, $_value);
            }
        }

        $q = $this->db->get($this->_table);

        return $q->result_array();
    }

    /* ------------------------------------------------------------------------------------------------------------------------------------------------------------ */

    /**
     * 
     * @useage ::
     *           $data = array( 'login' => 'jethro' );
     *           $result = $this->user_model->insert( $data );
     *         ::
     * @param array $data
     * 
     */
    public function insert($data) {

        $this->db->insert($this->_table, $data);

        return $this->db->insert_id();
    }

    /* ------------------------------------------------------------------------------------------------------------------------------------------------------------ */

    /**
     * @useage ::
     *           $data = array('login' => 'Peggy');
     *           $this->user_model->update($data, 1);
     *         ::
     * @param type $data
     * @param type $user_id
     * @return type
     * e.g $this->user_model->update('login' => 'johnny', ['date_created' => '0']);
     */
    public function update($new_data, $where) {


        if (is_numeric($where)) {

            $this->db->where($this->_primary_key, $where);
        } elseif (is_array($where)) {

            foreach ($where as $_key => $_value) {

                $this->db->where($_key, $_value);
            }
        } else {

            die('You must pass a second parameter to the UPDATE() method.');
        }

        $this->db->update($this->_table, $new_data);

        return $this->db->affected_rows();
    }

    /* ------------------------------------------------------------------------------------------------------------------------------------------------------------ */

    /**
     * If the record exists update if it doesn't exist then insert 
     * @usage insertUpdate([name' => 'johnny'], 12)
     * 
     * 
     */
    public function insertUpdate($data, $id = false) {

        if (!$id) {

            die('You must pass a second parameter to the insertUpdate() method.');
        }

        $this->db->select($this->_primary_key);
        $this->db->where($this->_primary_key, $id);
        $q = $this->db->get($this->_table);

        $result = $q->num_rows();

        if ($result == 0) {

            /* Insert */
            return $this->insert($data);
        }
        /* Insert */
        return $this->update($data, $id);
    }

    /* ------------------------------------------------------------------------------------------------------------------------------------------------------------ */

    /**
     * 
     * @usage ::
     *          $this->user_model->delete(array('name' => 'johnny'));
     *        ::
     * @param type $user_id
     * @return type
     */
    public function delete($id) {

        if (is_numeric($id)) {

            $this->db->where($this->_primary_key, $id);
        } elseif (is_array($id)) {

            foreach ($id as $_key => $_value) {

                $this->db->where($_key, $_value);
            }
        } else {


            die('You must pass a parameter to the DELETE() ');
        }


        //$data = array('user_id' => $user_id);
        $this->db->delete($this->_table);
        return $this->db->affected_rows();
    }

    /* ------------------------------------------------------------------------------------------------------------------------------------------------------------ */
}

?>
