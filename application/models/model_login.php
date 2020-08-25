<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_login extends CI_Model {

	public function login_base ($data, $table) {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('bas_name', $data['bas_name']); 
		$this->db->where('bas_pass', md5($data['bas_pass'])); 
		$query = $this->db->get();
		return $query->result_array(); 			
	}	

	public function login ($data, $table) {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->or_having('user_name', $data['user_name']); 
		$this->db->or_having('user_email', $data['user_email']); 
		$this->db->where('user_pass', md5($data['user_pass'])); 
		$this->db->where('user_role', 'admin'); 
		$query = $this->db->get();
		return $query->result_array(); 		
	}

	public function login_normal ($data, $table) {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('acc_username', $data['acc_username']); 
		$this->db->where('acc_password', md5($data['acc_password'])); 
		$query = $this->db->get();
		return $query->result_array(); 			
	}

	public function login_user ($data, $table) {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('usr_username', $data['usr_username']); 
		$this->db->where('usr_password', md5($data['usr_password'])); 
		$query = $this->db->get();
		return $query->result_array(); 			
	}	

	public function login_user_by_email ($data, $table) {
		// $this->db->select('*');
		$this->db->from($table);
		$this->db->where('usr_email', $data['usr_email']); 
		$this->db->where('usr_password', md5($data['usr_password'])); 
		$query = $this->db->get();
		return $query->result_array(); 			
	}	

}

/* End of file model_login.php */
/* Location: ./application/models/model_login.php */