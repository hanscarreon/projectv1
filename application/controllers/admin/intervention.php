<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Intervention extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper(array('url','date', 'form'));
		$this->load->library(array('form_validation', 'session', 'pagination'));
		$this->load->model('model_base');
		if ( $this->have_sess_admin() != true ){
			$this->logout_admin();	
		}

	}
	public function index(){

	}
	public function create($user_id,$senti_id,$sched_id){
		$header = [];
		$body = [];
		$footer = [];

		$col = "user_id";
		$table_name = 'user';
		$body['user'] = $this->model_base->get_one($user_id,$col,$table_name);
		$this->db->flush_cache();

		$col = "senti_id";
		$table_name = 'sentiment';
		$body['senti'] = $this->model_base->get_one($senti_id,$col,$table_name);
		$this->db->flush_cache();

		$this->load->view("template/site_admin_header",$header);
		$this->load->view('admin/intervention/create',$body);
		$this->load->view("template/site_admin_footer",$footer);


	}
}	