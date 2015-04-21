<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Groups extends CI_Controller {

    /**
     * __construct method     
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('GroupModel');   
    }

    /**
     * index method     
     * @return void
     */
    public function index() {

        $data['groups'] = $this->GroupModel->listing();
        $data['main'] = 'groups/index';
        $this->load->view('layouts/default', $data);
    }

    /**
     * add method     
     * @return void
     */
    public function add() {
        //set form validation
        $this->form_validation->set_rules(array(
            array('field' => 'name', 'label' => 'Name', 'rules' => 'required')
        ));
        //if validation not run, just show form
        if ($this->form_validation->run() == FALSE) {
            $data['main'] = 'groups/add'; //set view
            $this->load->view('layouts/default', $data); //set layout
        } else {
            $data = array(
                'name' => $this->input->post('name')
            );
            $this->GroupModel->create($data); //load model
            //set flash message
            $this->session->set_flashdata('item', array('message' => 'Registration Successful', 'class' => 'success')); //danger or success            
            redirect('groups/index'); // back to the index
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */