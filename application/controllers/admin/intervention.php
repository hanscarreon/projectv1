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
	public function index($slug='all',$case='all',$status='all',$filter="1"){
		$header = [];
		$body = [];
		$footer = [];

		$body["user_name"] = $this->uri->segment("4");
		$body["inter_plan_case"] = $this->uri->segment("5");
		$body["inter_plan_status"] = $this->uri->segment("6");

		$config = array();
		$config["base_url"] = base_url() .'admin/schedule/set/'.$body["user_name"].'/'.$body["inter_plan_case"].'/'.$body["inter_plan_status"].'/';
		$this->db->where('inter_status !=', 'deleted');
		$total_row = $this->model_base->count_data('inter_plan');
		$config["total_rows"] = $total_row;
		$config['per_page'] = 8;
		$config['uri_segment'] = 7;
		$config['num_links'] = 5;
		$config['use_page_numbers'] = TRUE;

		// open btn
		$config['full_tag_open'] = '<nav aria-label="..."> <ul class="pagination">';
		$config['full_tag_close'] = '</ul> </nav>';
		// prev btn
		$config['prev_link'] = '<li class="page-item" ><span class="page-link">Previous</span></li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		// next btn
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['next_link'] = '<li class="page-item" ><span class="page-link">Next</span></li>';
		//  active btn
		$config['cur_tag_open'] = '<li class="page-item active"> <a class="page-link" href="">';
		$config['cur_tag_close'] = '</a></li>';
		// number link
		$config['num_tag_open'] = '<li class="page-item" ><span class="page-link">';
		$config['num_tag_close'] = '</span></li>';
		// first
		$config['first_tag_open'] = '<li class="page-item" ><span class="page-link">';
		$config['first_link'] = 'First'; 
		$config['first_tag_close'] = '</span></li>';
		// last
		$config['last_tag_open'] = '<li class="page-item" ><span class="page-link">';
		$config['last_link'] = 'Last';
		$config['last_tag_close'] = '</span></li>';

		$this->pagination->initialize($config);
		$offset = ($filter - 1) * $config["per_page"];
		$this->db->limit( $config["per_page"] , $offset);
		$this->db->flush_cache();

		
		$this->_sorting($slug,$case,$status);
		$body['plans'] = $this->model_base->get_all('inter_plan');
		$this->db->flush_cache();




		$this->load->view("template/site_admin_header",$header);
		$this->load->view('admin/intervention/index',$body);
		$this->load->view("template/site_admin_footer",$footer);

	}
	public function _sorting($slug, $case, $status){
		$this->db->where('inter_status !=','deleted');
		$this->db->where('inter_case!=','follow-up');
		$this->db->join("user", "inter_plan.user_id = user.user_id");
		$this->db->join("sentiment", "inter_plan.senti_id = sentiment.senti_id");
		$this->db->join("senti_sched", "inter_plan.senti_id = senti_sched.senti_id");
		if($slug != 'all'){
			$this->db->like("user.user_fname", $slug);
			$this->db->or_like("user.user_lname", $slug);
			$this->db->or_like("user.user_mname", $slug);

		}
		if($case != 'all'){
			$this->db->where('inter_case',$case);
		}
		// if($status != 'all'){
		// 	$this->db->where('inter_status',$status);
		// }


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
				$tbname = 'senti_sched';
				$col = 'sched_id';
				$data_update = array('sched_status' => $data['inter_case'],
									'sched_note' => $data['inter_note'],
									'sched_update' => $this->getDatetimeNow()
									);
				$this->model_base->update_data($data['sched_id'],$col,$data_update,$tbname);

				
				$table  = 'inter_plan';
				unset($data["inter_note"]);
				$data['inter_created'] = $this->getDatetimeNow();
				$this->model_base->insert_data($data, $table);

				$this->session->set_flashdata('msg_success', 'Case analyze success!');
				redirect('admin/intervention/index/all/all' ,'refresh');


			}

		}

		$this->load->view("template/site_admin_header",$header);
		$this->load->view('admin/intervention/create',$body);
		$this->load->view("template/site_admin_footer",$footer);


	}
}	