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
	public function index($slug='all',$status='all',$filter="1"){
		$header = [];
		$body = [];
		$footer = [];




		$this->load->view("template/site_admin_header",$header);
		$this->load->view('admin/intervention/index',$body);
		$this->load->view("template/site_admin_footer",$footer);

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


		//form validation

		$this->form_validation->set_rules('inter_note', 'Note' , 'required|trim');
		$this->form_validation->set_rules('user_id', 'student', 'required|trim');
		$this->form_validation->set_rules('senti_id', 'sentiment', 'required|trim');
		$this->form_validation->set_rules('sched_id', 'meeting schedule', 'required|trim');
		$this->form_validation->set_rules('inter_case', 'Select Case', 'required|trim');

		if($this->input->post("create_case")){
			if($this->form_validation->run() == false){
			 	$body['msg_error'] = validation_errors();
			}else{
				$data = $this->input->post();
				unset($data["create_case"]);
				$table  = 'inter_plan';
				$data['inter_created'] = $this->getDatetimeNow();
				$this->model_base->insert_data($data, $table);
				// ./. create anal report ./.

				$tbname = 'senti_sched';
				$col = 'sched_id';
				$data_update = array('sched_status' => $data['inter_case']);
				$this->model_base->update_data($data['sched_id'],$col,$data_update,$tbname);

				$this->session->set_flashdata('msg_success', 'Case analyze success!');
				redirect('admin/intervention/index/all/all' ,'refresh');


			}

		}

		$this->load->view("template/site_admin_header",$header);
		$this->load->view('admin/intervention/create',$body);
		$this->load->view("template/site_admin_footer",$footer);


	}
}	