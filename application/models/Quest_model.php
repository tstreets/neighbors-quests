<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quest_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function get_all_quests() {
        $sql = "SELECT * FROM `quest`";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_my_quests() {
        $giver_id = $this->session->user_id;
        $sql = "SELECT * FROM `quest`
                WHERE `giver_id` = '$giver_id'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function add_quest($info) {
        $messages = array();
        $messages['status'] = 0;
        $messages['failed'] = '';

        $giver_id = $this->session->user_id;
        $name = $info['name'];
        $image = $info['image']['name'];
        $details = $info['details'];
        $urgency = $info['urgency'];
        $difficulty = $info['difficulty'];
        $address = $info['address'];
        $today = date("Y-m-d");
        $reward = $info['reward'];

        
        $sql = "INSERT INTO `quest` (`id`,`giver_id`,`adventurer_id`,`name`,`image`,`details`,`urgency`,`difficulty`, `address`, `create_date`, `complete_date`, `reward`) VALUES (NULL, '$giver_id', NULL, '$name', '$image', '$details','$urgency', '$difficulty', '$address', '$today', NULL, $reward)";
        $query = $this->db->query($sql);

        $quest_id = $this->db->insert_id();
        if($quest_id){
            $messages['status'] = 1;
        }

        return $messages['status'];  
    }

    public function save_file($info) {
        $msg = array();
        $msg['status'] = 0;
        $msg['path'] = "";

        $image = $info['image'];
        $name = $info['image']['name'];
        
        $path = 'assets/images/'.$this->session->user_id;
        $filename = $path.'/'.$name;

        if(!is_dir($path)) {
            mkdir($path);
        }

        $msg['path'] = $filename;

        if(move_uploaded_file($image["tmp_name"], $filename)) {
            $msg['add'] = $this->add_quest($info);
            if($msg['add'] == 1) {
                $msg['status'] = 1;
            }
        }

        return $msg;
    }
}