<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_sample_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function queryGetAll() {
        $sql = "SELECT * FROM `table` where `field` = 0";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
}