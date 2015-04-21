<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pengguna extends CI_Controller {

   
    /**
     * isRegistered method     
     * @return void
     */
    public function daftar_ahli() {
        if (($this->session->userdata('user_session') == FALSE)) {
            $this->session->set_flashdata('item', array('message' => 'You are not authorized. Please login!', 'class' => 'danger')); //danger or success            
            redirect('authentications/login');
        }
    }

   
}
