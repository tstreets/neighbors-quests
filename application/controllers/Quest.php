<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quest extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('quest_model');
    }

    public function savefile() {
        $info = $this->input->post();
        $info['image'] = $_FILES['image'];
        $data['msgs'] = $this->quest_model->save_file($info);
        echo json_encode($data['msgs']);
    }

}