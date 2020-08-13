<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule extends CI_Controller {

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
	public function index($slug="all",$status="all",$mod='all',$filter="1"){
		$header = [];
		$body = [];
		$footer = [];
		
		$body["user_name"] = $this->uri->segment("4");
		$body["senti_status"] = $this->uri->segment("5");
		$body["sched_mod"] = $this->uri->segment("6");

		$config = array();
		$config["base_url"] = base_url() .'admin/schedule/set/'.$body["user_name"].'/'.$body["senti_status"].'/'.$body["sched_mod"].'/';
		$this->_sorting($slug,$status,$mod);
		$total_row = $this->model_base->count_data('senti_sched');
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



		$this->_sorting($slug,$status,$mod);
		$body['schedules'] = $this->model_base->get_all('senti_sched');
		$this->db->flush_cache();




		$this->load->view("template/site_admin_header",$header);
		$this->load->view('admin/schedule/index',$body);
		$this->load->view("template/site_admin_footer",$footer);
	}
	public function _sorting($slug,$status,$mod){
		$this->db->join("user", "senti_sched.user_id = user.user_id");
		$this->db->join("sentiment", "senti_sched.senti_id = sentiment.senti_id");
		$this->db->where("sentiment.senti_status", 'meeting');
		if($slug != 'all'){
			$this->db->like("user.user_fname", $slug);
			$this->db->or_like("user.user_lname", $slug);
			$this->db->or_like("user.user_mname", $slug);
		}
		if($mod != 'all'){
			$this->db->where("sched_mod", $mod);
		}
		if($status != 'all'){
				
			$this->db->where("sched_status", $status);
		}else{
			$this->db->where("sched_status", 'active');
		}
	}
	public function set($user,$senti,$type){
		$header = [];
		$body = [];
		$footer = [];



		$this->form_validation->set_rules('sched_date', 'schedule date', 'required');
		$this->form_validation->set_rules('user_id', 'student', 'required|trim');
		$this->form_validation->set_rules('senti_id', 'sentiment', 'required|trim');
		

		if($this->input->post("set_date")){
			 if ($this->form_validation->run() == FALSE){
			 	$body['msg_error'] = validation_errors();
        	}
        	else{
        		$data = $this->input->post();
				unset($data['set_date']);
				$table = "senti_sched";
				$data['sched_created'] = $this->getDatetimeNow();
        		$data['sched_mod'] = $type;
				$this->model_base->insert_data($data, $table);
				$data_update = array('senti_status' => 'meeting' );
				$col = 'senti_id';
				$tbname = 'sentiment';
				$this->model_base->update_data($data['senti_id'],$col,$data_update,$tbname);
				$this->session->set_flashdata('msg_success', 'Date set!');
				$this->db->flush_cache();
 				
				redirect('admin/schedule/index/all/all' ,'refresh');
          		
       		 }

		}
		$col = "user_id";
		$table_name = 'user';
		$body['user'] = $this->model_base->get_one($user,$col,$table_name);
		$this->db->flush_cache();

		$col = "senti_id";
		$table_name = 'sentiment';
		$body['senti'] = $this->model_base->get_one($senti,$col,$table_name);
		$this->db->flush_cache();


		$this->load->view("template/site_admin_header",$header);
		$this->load->view('admin/schedule/create',$body);
		$this->load->view("template/site_admin_footer",$footer);

	}
	public function proceed($id){

		$data = array('sched_status' => 'ongoing' );
		$col = 'sched_id';
		$tbname = 'senti_sched';
		$this->model_base->update_data($id,$col,$data,$tbname);
		$this->session->set_flashdata('msg_success', 'Meeting ongoing!');
		$this->db->flush_cache();	
		redirect('admin/schedule/index/all/ongoing' ,'refresh');	
	}
	public function done($id){

		$data = array('sched_status' => 'done' );
		$col = 'sched_id';
		$tbname = 'senti_sched';
		$this->model_base->update_data($id,$col,$data,$tbname);
		$this->session->set_flashdata('msg_success', 'Meeting done!');
		$this->db->flush_cache();	
		redirect('admin/schedule/index/all/done' ,'refresh');	
	}
	public function resched($user,$senti,$sched_id){
		$header = [];
		$body = [];
		$footer = [];

		$col = "user_id";
		$table_name = 'user';
		$body['user'] = $this->model_base->get_one($user,$col,$table_name);
		$this->db->flush_cache();

		$col = "senti_id";
		$table_name = 'sentiment';
		$body['senti'] = $this->model_base->get_one($senti,$col,$table_name);
		$this->db->flush_cache();

		$this->form_validation->set_rules('sched_date', 'schedule date', 'required');
		$this->form_validation->set_rules('sched_id', 'Reschedule', 'required|trim');
		

		if($this->input->post("set_date")){
			 if ($this->form_validation->run() == FALSE){
			 	$body['msg_error'] = validation_errors();
        	}
        	else{
        		$data = $this->input->post();
				unset($data['set_date']);
				$table = "senti_sched";
				$data['sched_update'] = $this->getDatetimeNow();
				$data['sched_status'] = 'resched';
				$col = 'sched_id';
				$this->model_base->update_data($sched_id,$col,$data,$table);
				$this->session->set_flashdata('msg_success', 'Reschedule date set!');
				$this->db->flush_cache();
 				
				redirect('admin//schedule/index/all/resched' ,'refresh');
          		
       		 }

		}

		$this->load->view("template/site_admin_header",$header);
		$this->load->view('admin/schedule/edit',$body);
		$this->load->view("template/site_admin_footer",$footer);

	}

	public function follow($user,$senti,$sched_id){
		$header = [];
		$body = [];
		$footer = [];

		$col = "user_id";
		$table_name = 'user';
		$body['user'] = $this->model_base->get_one($user,$col,$table_name);
		$this->db->flush_cache();

		$col = "senti_id";
		$table_name = 'sentiment';
		$body['senti'] = $this->model_base->get_one($senti,$col,$table_name);
		$this->db->flush_cache();

		$this->load->view("template/site_admin_header",$header);
		$this->load->view('admin/schedule/follow-up',$body);
		$this->load->view("template/site_admin_footer",$footer);

	}
}	















