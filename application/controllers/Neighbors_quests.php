<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Neighbors_quests extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->model('quest_model');
    }

    public function index() {
        $data['page_title'] = "Neighbors' Quests";
        $data['this_page'] = 'home';
        $this->load->view('templates/head', $data);
        $this->load->view('home/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function about() {
        $data['page_title'] = "Neighbors' Quests - About Us";
        $data['this_page'] = 'about';
        $this->load->view('templates/head', $data);
        $this->load->view('about/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function contact() {
        $data['page_title'] = "Neighbors' Quests - Contact Us";
        $data['this_page'] = 'contact';
        $this->load->view('templates/head', $data);
        $this->load->view('contact/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function explore() {
        $data['page_title'] = "Neighbors' Quests - Explore";
        $data['this_page'] = 'explore';
        $data['quests'] = $this->quest_model->get_all_quests();
        $this->load->view('templates/head', $data);
        $this->load->view('explore/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function myquests() {
        if(isset($this->session->user_id)) {
            $data['page_title'] = "Neighbors' Quests - My Quests";
            $data['this_page'] = 'myquests';
            $data['quests'] = $this->quest_model->get_my_quests();
            $this->load->view('templates/head', $data);
            $this->load->view('given/index', $data);
            $this->load->view('templates/footer', $data);
        }
        else {
            $this->login();
        }
    }

    public function newquest() {
        $data['page_title'] = "Neighbors' Quests - New Quest";
        $data['this_page'] = 'given';
        $this->load->view('templates/head', $data);
        $this->load->view('given/add', $data);
        $this->load->view('templates/footer', $data);
    }

    public function adventures() {
        $data['page_title'] = "Neighbors' Quests - My Adventures";
        $data['this_page'] = 'adventures';
        $this->load->view('templates/head', $data);
        $this->load->view('active/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function login() {
        $data['page_title'] = "Neighbors' Quests - Sign up/Login";
        $data['this_page'] = 'login';
        $this->load->view('templates/head', $data);
        $this->load->view('login/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function logout() {
        $data['page_title'] = "Neighbors' Quests - Sign up/Login";
        $data['this_page'] = 'login';
        $this->login_model->logout_user();
        $this->load->view('templates/head', $data);
        $this->load->view('login/index', $data);
        $this->load->view('templates/footer', $data);
    }
}