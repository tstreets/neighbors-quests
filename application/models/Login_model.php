<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function check_user($info) {
        $messages = array();
        $messages['status'] = 0;
        $messages['failed'] = '';

        $email = $info['email'];
        $password = $info['password'];

        $sql = "SELECT * FROM `user` WHERE `email` = '".$email."' LIMIT 1";
        $query = $this->db->query($sql);
        $row = $query->row_array();

        if($row) {
            if(password_verify($password, $row["password"])){
                $this->session->user_id = $row['id'];
                $messages['status'] = 1;
            } 
            else {
                $messages['failed'] = 'password';
            }
        }
        else {
            $messages['failed'] = 'username';
        }

        return $messages;        
    }

    public function queryGetAll() {
        $sql = "SELECT * FROM `table` where `field` = 0";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function signup_user($info) {
        $messages = array();
        $messages['status'] = 0;
        $messages['failed'] = '';

        $email = $info['email'];
        $password = $info['password'];
        $fullname = $info['fullname'];
        $birthdate = $info['birthdate'];
        $today = date("Y-m-d");
        $encrypted_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "SELECT * FROM `user` WHERE `email` = '$email' LIMIT 1";
        $query = $this->db->query($sql);
        $row = $query->row_array();

        if($row) {
            // user email already exists
            $messages['failed'] = 'Email already exists';
        }
        else {
            // create user
            $messages['status'] = 1;
            $sql1 = "INSERT INTO `user` (`id`,`full_name`,`image`,`email`,`password`,`birth_date`,`join_date`,`last_visit`) VALUES (NULL, '$fullname', NULL, '$email', '$encrypted_password', '$birthdate','$today', '$today')";
            $query1 = $this->db->query($sql1);
            
            $user_id = $this->db->insert_id();
            if($user_id){
                $this->session->user_id = $user_id;
            }
        }

        return $messages;  
    }

    public function logout_user() {
        $this->session->user_id = null;
    }
}