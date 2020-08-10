<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_base extends CI_Model {

	public function insert_data($data, $table_name) {
		$this->db->insert($table_name, $data);
		return $this->db->insert_id();
	}

	public function update_data($id, $col, $data, $table_name) {
		$this->db->where($col, $id);
		$this->db->update($table_name, $data); 
	}
	public function update_status($id,$col_id,$col,$data,$table_name){
		$this->db->set($col,$data);
		$this->db->where($col_id,$id);
		$this->db->update($table_name);
	}

	public function delete_data($id, $col, $col_del, $table_name) {
		$data[$col_del] = 'deleted';
		$this->db->where($col, $id);
		$this->db->update($table_name, $data); 
	}

	public function get_one($id, $col, $table_name) {
		$this->db->select('*');
		$this->db->from($table_name);
		$this->db->where($col, $id); 
		$query = $this->db->get();
		return $query->result_array(); 	
	}
	public function get_onev2($id, $col, $table_name, $con,$stat) {
		$this->db->select('*');
		$this->db->from($table_name);
		$this->db->where($con, $stat);
		$this->db->where($col, $id);
		$query = $this->db->get();
		return $query->result_array(); 	
	}

	public function get_all($table_name) {
		$this->db->select('*');
		$this->db->from($table_name);
		$query = $this->db->get();
		return $query->result_array(); 	
	}
	
	public function count_data($table_name) {
		$query = $this->db->get($table_name);
		$num = $query->num_rows();
		return $num;
	}
	public function count_data_status($table_name,$col,$val) {
		$this->db->select('*');
		$this->db->from($table_name);
		$this->db->where("senti_status !=","deleted");
		$this->db->where($col,$val);
		$query = $this->db->get();
		$num = $query->num_rows();
		return $num;
	}

	public function like_data($data, $col, $table_name) {
		$this->db->select('*');
		$this->db->from($table_name);
		$this->db->like($col, $data);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_lastData($col, $table_name) {
		$this->db->select('*');
		$this->db->from($table_name);
		$this->db->order_by($col,"DESC");
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_firstData($col, $table_name) {
		$this->db->select('*');
		$this->db->from($table_name);
		$this->db->order_by($col,"ASC");
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function get_ajax($search) {
	 	if ($search == null) {
	 		return null;
	 	}
		$this->db->select('*');
		$this->db->from("motorcycles");
		$this->db->like("mot_brand", $search,'after');
		$this->db->or_like("mot_model", $search,'both');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function get_ajax2($keyword) {
	 	if ($keyword == null) {
	 		return null;
	 	}
		$this->db->select('*');
		$this->db->from("motorcycles");
		$this->db->like("mot_keyword", $keyword,'both');
		$query = $this->db->get();
		return $query->result_array();
	}

}