<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_MOdel {

	public function addUser($data){
        $this->db->insert('users',$data);
        return $this->db->insert_id();
    }

    public function checkEmail($email){
    	$this->db->select('id');
        $this->db->from('users');
        $this->db->where(array('email'=>$email));
        return $this->db->get()->num_rows();
    }

    public function checkLogin($data){
    	$this->db->select('*');
        $this->db->from('users');
        $this->db->where(array('email'=>$data['lemail'],'password'=>$data['lpassword']));
        return $this->db->get()->row_array();
    }
}
