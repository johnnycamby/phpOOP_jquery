<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Api extends CI_Controller {
    /* --------------------------------------------------------------------------------------------------- */

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('todo_model');
        $this->load->model('note_model');
    }

    /* --------------------------------------------------------------------------------------------------- */

    private function _require_login() {


        if ($this->session->userdata('user_id') == false) {

            $this->output->set_output(json_encode([

                'result' => 0,
                'error' => 'You are not authorized'
            ]));
            return false;
        }
    }

    /* --------------------------------------------------------------------------------------------------- */

    public function login() {


        /* use of input prevents xxs attackers and sanitation */
        $login = $this->input->post('login');
        $password = $this->input->post('password');

        /* Load user model */
        //$this->load->model('user_model');

        $result = $this->user_model->get([

            'login' => $login,
            'password' => hash('sha256', $password . SALT)
        ]);

        $this->output->set_content_type('application_json');

        if ($result) {

            $this->session->set_userdata(['user_id' => $result[0]['user_id']]);
            $this->output->set_output(json_encode(['result' => 1]));
            return false;
        }

        $this->output->set_output(json_encode(['result' => 0]));
    }

    /* --------------------------------------------------------------------------------------------------- */

    public function register() {

        /* Load user model */
        //$this->load->model('user_model');

        $this->output->set_content_type('application_json');

        $this->form_validation->set_rules('login', 'Login', 'required|min_length[3]|max_length[16]|is_unique[user.login]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[4]|max_length[16]|matches[confirm_password]');
        //$this->form_validation->set_message('valid_email', 'for all cheaters');

        if ($this->form_validation->run() == false) {

            $this->output->set_output(json_encode([

                'result' => 0,
                'error' => $this->form_validation->error_array()]));
            return false;
        }

        /* use of input prevents xxs attackers and sanitation */
        $login = $this->input->post('login');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $confirm_password = $this->input->post('confirm_password');

        /* Load user model again if the validation fails */
        //  $this->load->model('user_model');

        $user_id = $this->user_model->insert([

            'login' => $login,
            'password' => hash('sha256', $password . SALT),
            'email' => $email
        ]);

        if ($user_id) {

            $this->session->set_userdata(['user_id' => $user_id]);
            $this->output->set_output(json_encode(['result' => 1]));
            return false;
        }

        $this->output->set_output(json_encode([

            'result' => 0,
            'error' => 'User not created'
        ]));
    }

    /* --------------------------------------------------------------------------------------------------- */

    public function get_todo($id = null) {

        $this->_require_login();

        if ($id != null) {

            $result = $this->todo_model->get([

                'todo_id' => $id,
                'user_id' => $this->session->userdata('user_id')
            ]);
        } else {

            $result = $this->todo_model->get([
                'user_id' => $this->session->userdata('user_id')
            ]);
        }

        // $query = $this->db->get('todo');
        // $result = $query->result_array();

        $this->output->set_output(json_encode($result));
    }

    /* --------------------------------------------------------------------------------------------------- */

    public function create_todo() {

        $this->_require_login();

        $this->form_validation->set_rules('content', 'Content', 'required|max_length[255]');

        if ($this->form_validation->run() == false) {

            $this->output->set_output(json_encode([

                'result' => 0,
                'error' => $this->form_validation->error_array()
            ]));

            return false;
        }


        $result = $this->todo_model->insert([

            'content' => $this->input->post('content'),
            'user_id' => $this->session->userdata('user_id')
        ]);

        if ($result) {

            /* Get the freshest entry for the DOM */
            // $query = $this->db->get_where('todo', ['todo_id' => $this->db->insert_id()]);

            $this->output->set_output(json_encode([

                'result' => 1,
                //'data' => result()
                'data' => array(
                    'todo_id' => $result,
                    'content' => $this->input->post('content'),
                    'complete' => 0
                )
            ]));
            return false;
        }

        $this->output->set_output(json_encode([

            'result' => 0,
            'error' => 'Could not insert record'
        ]));
    }

    /* --------------------------------------------------------------------------------------------------- */

    public function update_todo() {

        $this->_require_login();
        $todo_id = $this->input->post('todo_id');
        $completed = $this->input->post('completed');

        $result = $this->todo_model->update([

            'completed' => $completed
                ], $todo_id);

        // $this->db->where(['todo_id' => $todo_id]);
        // $this->db->update('todo', ['completed' => $completed]);
        //  $result = $this->db->affected_rows();

        if ($result) {

            $this->output->set_output(json_encode([

                'result' => 1
            ]));

            return false;
        }

        $this->output->set_output(json_encode([

            'result' => 0,
            'message' => 'Could not update.'
        ]));
        return false;
    }

    /* --------------------------------------------------------------------------------------------------- */

    public function get_note($id = null) {

        $this->_require_login();

        if ($id != null) {

            $result = $this->note_model->get([

                'note_id' => $id,
                'user_id' => $this->session->userdata('user_id')
            ]);
        } else {

            $result = $this->note_model->get([
                'user_id' => $this->session->userdata('user_id')
            ]);
        }

        // $query = $this->db->get('todo');
        // $result = $query->result_array();

        $this->output->set_output(json_encode($result));
    }

    /* --------------------------------------------------------------------------------------------------- */

    public function delete_todo() {

        $this->_require_login();

        $result = $this->todo_model->delete([

            'todo_id' => $this->input->post('todo_id'),
            'user_id' => $this->session->userdata('user_id')
        ]);

        if ($result) {

            $this->output->set_output(json_encode([

                'result' => 1
            ]));

            return false;
        }

        $this->output->set_output(json_encode([

            'result' => 0,
            'message' => 'Could not delete.'
        ]));
    }

    /* --------------------------------------------------------------------------------------------------- */

    public function create_note() {

        $this->_require_login();

        $this->form_validation->set_rules('title', 'title', 'required|max_length[50]');
        $this->form_validation->set_rules('content', 'Content', 'required|max_length[255]');

        if ($this->form_validation->run() == false) {

            $this->output->set_output(json_encode([

                'result' => 0,
                'error' => $this->form_validation->error_array()
            ]));

            return false;
        }


        $result = $this->note_model->insert([

            'title' => $this->input->post('title'),
            'content' => $this->input->post('content'),
            'user_id' => $this->session->userdata('user_id')
        ]);

        if ($result) {

            /* Get the freshest entry for the DOM */
            // $query = $this->db->get_where('todo', ['todo_id' => $this->db->insert_id()]);

            $this->output->set_output(json_encode([

                'result' => 1,
                //'data' => result()
                'data' => array(
                    'note_id' => $result,
                    'title' => $this->input->post('title'),
                    'content' => $this->input->post('content')
                )
            ]));
            return false;
        }

        $this->output->set_output(json_encode([

            'result' => 0,
            'error' => 'Could not insert record'
        ]));
    }

    /* --------------------------------------------------------------------------------------------------- */

    public function update_note() {

        $this->_require_login();

        $note_id = $this->input->post('note_id');

        $result = $this->note_model->update([

            'title' => $this->input->post('title'),
            'content' => $this->input->post('content'),
                ], $note_id);


        /*  if ($result) { */

        $this->output->set_output(json_encode(['result' => 1]));

        return false;
        /*  } */

        //=>  /*Do not check teh $result because if no affected rows happened they will think its an error*/


        /* $this->output->set_output(json_encode([

          'result' => 0,
          'message' => 'Could not update.'
          ]));

          return false; */
    }

    /* --------------------------------------------------------------------------------------------------- */

    public function delete_note() {

        $this->_require_login();

        $result = $this->note_model->delete([

            'note_id' => $this->input->post('note_id'),
            'user_id' => $this->session->userdata('user_id')
        ]);

        if ($result) {

            $this->output->set_output(json_encode([

                'result' => 1
            ]));

            return false;
        }

        $this->output->set_output(json_encode([

            'result' => 0,
            'message' => 'Could not delete.'
        ]));
    }

    /* --------------------------------------------------------------------------------------------------- */
}

?>
