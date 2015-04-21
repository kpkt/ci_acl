<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller {

    /**
     * isRegistered method     
     * @return void
     */
    public $defaultPassword = 'sp5OXx46Iw';

    /**
     * __construct method     
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('UserModel');
        $this->load->model('AuthenticationModel');
        $this->isRegistered();
    }

    /**
     * isRegistered method     
     * @return void
     */
    public function isRegistered() {
        if (($this->session->userdata('user_session') == FALSE)) {
            $this->session->set_flashdata('item', array('message' => 'You are not authorized. Please login!', 'class' => 'danger')); //danger or success            
            redirect('authentications/login');
        }
    }

    /**
     * index method     
     * @return void
     */
    public function index() {

        $data['users'] = $this->UserModel->listing();
        $data['main'] = '/users/index';
        $this->load->view('layouts/default', $data);
    }

    /**
     * add method     
     * @return void
     */
    public function add() {
        //set form validation
        $this->form_validation->set_rules(array(
            array('field' => 'username', 'label' => 'Username', 'rules' => 'required'),
            array('field' => 'name', 'label' => 'Name', 'rules' => 'required'),
            array('field' => 'email', 'label' => 'Email', 'rules' => 'required|valid_email')
        ));
        //if validation not run, just show form
        if ($this->form_validation->run() == FALSE) {
            $data['main'] = 'users/add'; //set view
            $this->load->view('layouts/default', $data); //set layout
        } else {
            $data = array(
                'username' => $this->input->post('username'),
                'password' => $this->AuthenticationModel->pwd_hash($this->config->item('default_password')),
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
            );
            $this->UserModel->create($data); //load model
            //set flash message
            $this->session->set_flashdata('item', array('message' => 'Registration Successful', 'class' => 'success')); //danger or success            
            redirect('users/index'); // back to the index
        }
    }

    /**
     * change_password method     
     * @param string user_id
     * @param string username
     */
    public function change_password($user_id = null) {
        //Cheching data is not empty
        if (!empty($user_id) && !$this->UserModel->exists($user_id)) {
            $this->session->set_flashdata('item', array('message' => 'Invalid or Data not found!', 'class' => 'danger')); //danger or success            
            redirect('users/index'); // back to the index
        }
        //fetch user record for the given employee no
        $data['user'] = $this->UserModel->read($user_id);

        //set form validation
        $this->form_validation->set_rules(array(
            array('field' => 'current_password', 'label' => 'Password', 'rules' => 'trim|required'),
            array('field' => 'new_password', 'label' => 'Password', 'rules' => 'trim|required|min_length[5]|callback_password_check|matches[new_password2]'),
            array('field' => 'new_password2', 'label' => 'Verify Password', 'rules' => 'trim|required')
        ));
        //if validation not run, just show form
        if ($this->form_validation->run() == FALSE) {
            $data['main'] = '/users/change_password';
            $this->load->view('layouts/default', $data);
        } else {
            $macthing = array(
                'username' => $this->input->post('username'),
                'current_password' => $this->input->post('current_password'),
            );
            $password_match = $this->AuthenticationModel->check_current_password($macthing);//check current user password
            if ($password_match) {
                $data = array(
                    'user_id' => $this->input->post('user_id'),
                    'password' => $this->AuthenticationModel->pwd_hash($this->input->post('new_password'))
                );
                $this->UserModel->modified($data); //load model
                //set flash message
                $this->session->set_flashdata('item', array('message' => 'The user has been saved', 'class' => 'success')); //danger or success            
                redirect('users/index'); // back to the index
            } else {
                $this->session->set_flashdata('item', array('message' => 'Current Password not match', 'class' => 'danger')); //danger or success            
                redirect('users/change_password/' . $data['user_id']); // back to the index
            }
        }
    }

   
    /**
     * edit method     
     * @param string user_id
     */
    public function edit($user_id = null) {
        //Cheching data is not empty
        if (!empty($user_id) && !$this->UserModel->exists($user_id)) {
            $this->session->set_flashdata('item', array('message' => 'Invalid or Data not found!', 'class' => 'danger')); //danger or success            
            redirect('users/index'); // back to the index
        }
        //fetch user record for the given employee no
        $data['user'] = $this->UserModel->read($user_id);

        //set form validation
        $this->form_validation->set_rules(array(
            array('field' => 'name', 'label' => 'Username', 'rules' => 'required'),
            array('field' => 'email', 'label' => 'Email', 'rules' => 'required|valid_email')
        ));
        //if validation not run, just show form
        if ($this->form_validation->run() == FALSE) {
            $data['main'] = '/users/edit';
            $this->load->view('layouts/default', $data);
        } else {
            $data = array(
                'user_id' => $this->input->post('user_id'),
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email')
            );
            $this->UserModel->modified($data); //load model
            //set flash message
            $this->session->set_flashdata('item', array('message' => 'The user has been saved', 'class' => 'success')); //danger or success            
            redirect('users/index'); // back to the index
        }
    }

    /**
     * view method     
     * @param string user_id
     */
    public function view($user_id) {
        //Cheching data is not empty
        if (!$this->UserModel->exists($user_id)) {
            $this->session->set_flashdata('item', array('message' => 'Invalid or Data not found!', 'class' => 'danger')); //danger or success            
            redirect('users/index'); // back to the index
        }

        $data['user'] = $this->UserModel->read($user_id);
        $data['main'] = '/users/view';
        $this->load->view('layouts/default', $data);
    }

    /**
     * delete method     
     * @param string user_id
     */
    public function delete($user_id) {
        //Cheching data is not empty
        if (!$this->UserModel->exists($user_id)) {
            $this->session->set_flashdata('item', array('message' => 'Invalid or Data not found!', 'class' => 'danger')); //danger or success            
            redirect('users/index'); // back to the index
        }

        if ($this->UserModel->delete($user_id)) {
            //set flash message
            $this->session->set_flashdata('item', array('message' => 'User deleted', 'class' => 'success')); //danger or success            
            redirect('users/index'); // back to the index
        }
        #$this->session->set_flashdata('item', array('message' => 'User was not deleted', 'class' => 'danger')); //danger or success            
        #redirect('users/index'); // back to the index    
    }

###Validation callback###

    /**
     * validation callback   
     * @return void
     */
    public function password_check($str) {
        $string = strtolower($str);
        $badPasswords = $this->config->item('bad_password');
        foreach ($badPasswords as $key => $val) {
            if (strlen(strstr($string, "$val")) > 0) {
                $this->form_validation->set_message('password_check', 'Your password is too similar to your name or email address or other common/simple passwords.');
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

}
