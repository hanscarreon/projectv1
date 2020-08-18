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
	public function index($name="name", $case="case",$status="case",$pos='all',$filter="1"){
		$header = [];
		$body = [];
		$footer = [];

		$pos =  $this->session->userdata('user_pos');
		$body["user_pos"] = $pos;
		$body["user_name"] = $this->uri->segment("4");
		$body["meet_case"] = $this->uri->segment("5");
		$body["meet_status"] = $this->uri->segment("6");

		$config = array();
		$config["base_url"] = base_url() .'admin/schedule/set/'.$body["user_name"].'/'.$body["meet_case"].'/'.$body["meet_status"].'/'.$body["user_pos"].'/';
		$this->_sorting($name,$case,$status,$pos);
		
		$total_row = $this->model_base->count_data('sentimend_meeting as sm');
		$config["total_rows"] = $total_row;
		$config['per_page'] = 6;
		$config['uri_segment'] = 8;
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

		$body["time_now"] = $this->getDatetimeNow();
		
		$this->_sorting($name,$case,$status,$pos);
		$body['schedules'] = $this->model_base->get_all('sentimend_meeting as sm');
		$this->db->flush_cache();




		$this->load->view("template/site_admin_header",$header);
		$this->load->view('admin/schedule/index',$body);
		$this->load->view("template/site_admin_footer",$footer);
	}
	public function _sorting($name,$case,$status,$pos){
		$this->db->join('user','user.user_id = sm.stud_id');
		$this->db->join('sentiment_case','sentiment_case.case_id = sm.case_id');
		$this->db->where('user.user_pos',$pos);

		if($name != 'name'){
			$this->db->like("user.user_fname", $name);
			$this->db->or_like("user.user_lname", $name);
			$this->db->or_like("user.user_mname", $name);
		}
		if($case != 'case'){
			$this->db->where("meet_case", $case);
		}else{
			$this->db->where("meet_case", 'waiting');

		}
		if($status != 'status'){
				
			$this->db->where("meet_status", $status);
		}else{
			$this->db->where("meet_status", 'published');
		}
	}
	public function set($user,$senti){
		$header = [];
		$body = [];
		$footer = [];




		$this->form_validation->set_rules('meet_date', 'schedule date', 'required|trim');
		$this->form_validation->set_rules('stud_id', 'student', 'required|trim');
		$this->form_validation->set_rules('case_id', 'sentiment', 'required|trim');
		$this->form_validation->set_rules('adv_id', 'sentiment', 'required|trim');
		

		if($this->input->post("set_date")){
			 if ($this->form_validation->run() == FALSE){
			 	$body['msg_error'] = validation_errors();
        	}
        	else{
        		$data = $this->input->post();
				unset($data['set_date']);
				$table = "sentimend_meeting";
				$data['meet_created'] = $this->getDatetimeNow();
				$this->model_base->insert_data($data, $table); // create meeting data

				// update case condition to meeting 
				$update_data = array('case_con' => 'meeting' );
				$id = $data['case_id'];
				$col = 'case_id';
				$tbname = 'sentiment_case';
				$this->model_base->update_data($id,$col,$update_data,$tbname);


				$this->session->set_flashdata('msg_success', 'Date set!');
				$this->db->flush_cache();
 				
				redirect('admin/schedule/index/name/meeting/case' ,'refresh');
          		
       		 }

		}
		$col = "user_id";
		$table_name = 'user';
		$body['user'] = $this->model_base->get_one($user,$col,$table_name);
		$this->db->flush_cache();

		$col = "case_id";
		$table_name = 'sentiment_case';
		$body['senti'] = $this->model_base->get_one($senti,$col,$table_name);
		$this->db->flush_cache();


		$this->load->view("template/site_admin_header",$header);
		$this->load->view('admin/schedule/create',$body);
		$this->load->view("template/site_admin_footer",$footer);

	}
	public function ongoing($id){
		$header = [];
		$body = [];
		$footer = [];

		$col = "meet_id";
		$table_name = 'sentimend_meeting';
		$body['meeting'] = $this->model_base->get_one($id,$col,$table_name);
		$this->db->flush_cache();


		$col = "user_id";
		$table_name = 'user';
		$student = $body['meeting'][0]['stud_id'];
		$body['student'] = $this->model_base->get_one($student,$col,$table_name);
		$this->db->flush_cache();

		$col = "case_id";
		$table_name = 'sentiment_case';
		$case = $body['meeting'][0]['case_id'];
		$body['case'] = $this->model_base->get_one($case,$col,$table_name);
		$this->db->flush_cache();


		$this->form_validation->set_rules('stud_id', 'Student ID', 'required');
		$this->form_validation->set_rules('case_id', 'Case ID', 'required|trim');
		$this->form_validation->set_rules('meet_id', 'Meeting ID', 'required|trim');
		$this->form_validation->set_rules('meet_note', 'Note', 'required|trim');
		$this->form_validation->set_rules('case_con', 'Case', 'required|trim');
		if($this->input->post("case_review")){
			if($this->form_validation->run() == FALSE){
			 	$body['msg_error'] = validation_errors();
			}else{

				$data = $this->input->post();
				unset($data['case_review']);

					$case_data = array( 
					'case_con' => $data['case_con'],
					'case_updated' => $this->getDatetimeNow()
					 );
					$case_col = 'case_id';
					$case_tbname = 'sentiment_case';
					//  /. case var
				
					$meet_data = array( 
						'meet_case' => 'done',
						'meet_note'=> $data['meet_note'],
						'meet_updated' => $this->getDatetimeNow()
						 );
					$meet_col = 'meet_id';
					$meet_tbname = 'sentimend_meeting';
					//  /. meet var

				if($data['case_con'] != 'plan'){
					$this->model_base->update_data($data['case_id'],$case_col,$case_data,$case_tbname);
					$this->db->flush_cache();	
					// /. update case
					
					$this->model_base->update_data($data['meet_id'],$meet_col,$meet_data,$meet_tbname);
					$this->db->flush_cache();	
					// /. update meeting
					$this->session->set_flashdata('msg_success', ''.ucfirst($data['case_con']).'!');

					redirect('admin/dashboard/index/name/study/con/'. $data['case_con'] ,'refresh');	
				}else{
					$meet_data['meet_mark'] = 'plan';
					$this->model_base->update_data($data['case_id'],$case_col,$case_data,$case_tbname);
					$this->db->flush_cache();	
					// /. update case
					
					$this->model_base->update_data($data['meet_id'],$meet_col,$meet_data,$meet_tbname);
					$this->db->flush_cache();	
					// /. update meeting

					$plan_data = array();
					$plan_data['plan_created'] = $this->getDatetimeNow();
					$plan_data['case_id'] = $data['case_id'];
					$plan_data['stud_id'] = $data['stud_id'];
					$plan_data['adv_id']  = $this->session->userdata('user_id');
					$plan_data['meet_id'] = $data['meet_id'];
					$last_id = $this->model_base->insert_data($plan_data,'sentiment_plan');

					$follow_up = array();
					$follow_up['meet_mark'] =  'follow';
					$follow_up['plan_id'] = $last_id;
					$follow_up['case_id'] =  $data['case_id'];
					$follow_up['stud_id'] =  $data['stud_id'];
					$follow_up['adv_id']  = $this->session->userdata('user_id');
					$this->model_base->insert_data($follow_up,'sentimend_meeting');

					$this->session->set_flashdata('msg_success', ''.ucfirst($data['case_con']).'!');
					redirect('admin/dashboard/index/name/study/con/'. $data['case_con'] ,'refresh');	

				}

					




			// $this->session->set_flashdata('msg_success', 'Analyze case submit!');

			}
		}


		$this->load->view("template/site_admin_header",$header);
		$this->load->view('admin/schedule/ongoing',$body);
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















