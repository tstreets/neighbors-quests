<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('login_model');
    }

    public function login() {
        $info = $this->input->get();
        $data['messages'] = $this->login_model->check_user($info);
        echo json_encode($data);
    }

    public function signup() {
        $info = $this->input->get();
        $data['messages'] = $this->login_model->signup_user($info);
        echo json_encode($data);
    }

    public function logout() {
        $this->login_model->logout_user();
    }

}