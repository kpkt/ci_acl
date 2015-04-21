<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Authentications extends CI_Controller {

    /**
     * __construct method     
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('AuthenticationModel');
        $this->load->model('UserModel');
    }

    /**
     * login method     
     * @return void
     */
    public function login() {
        //set form validation
        $this->form_validation->set_rules(array(
            array('field' => 'username', 'label' => 'Username', 'rules' => 'trim|required'),
            array('field' => 'password', 'label' => 'Password', 'rules' => 'trim|required|callback_password_verify')
        ));
        //if validation not run, just show form
        if ($this->form_validation->run() == FALSE) {
            $data['main'] = 'authentications/login'; //set view
            $this->load->view('layouts/login', $data); //set layout
        } else {
            $data = array(
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
            );
            $result = $this->AuthenticationModel->login($data); //load model
            if ($result) {
                redirect('users/index'); // back to the login    
            } else {
                $this->session->set_flashdata('item', array('message' => 'Wrong Username/Password. Please try again.', 'class' => 'danger')); //danger or success            
                redirect('authentications/login'); // back to the login   
            }
        }
    }

    /**
     * logout method     
     * @return void
     */
    public function logout() {
        $this->session->unset_userdata('user_session');
        redirect('authentications/login', 'refresh');
    }

    /**
     * register method     
     * @return void
     */
    public function register() {
        //set form validation
        $this->form_validation->set_rules(array(
            array('field' => 'username', 'label' => 'Username', 'rules' => 'required'),
            array('field' => 'password', 'label' => 'Password', 'rules' => 'trim|required|min_length[5]|callback_password_check|matches[password2]'),
            array('field' => 'password2', 'label' => 'Verify Password', 'rules' => 'trim|required'),
            array('field' => 'name', 'label' => 'Name', 'rules' => 'required'),
            array('field' => 'email', 'label' => 'Email', 'rules' => 'required|valid_email')
        ));
        //if validation not run, just show form
        if ($this->form_validation->run() == FALSE) {
            $data['main'] = 'authentications/register'; //set view
            $this->load->view('layouts/login', $data); //set layout
        } else {
            $data = array(
                'username' => $this->input->post('username'),
                'password' => $this->AuthenticationModel->pwd_hash($this->input->post('password')),
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
            );
            $this->UserModel->create($data); //load model
            //set flash message
            $this->session->set_flashdata('item', array('message' => 'Registration Successful', 'class' => 'success')); //danger or success            
            redirect('authentications/login'); // back to the index
        }
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
