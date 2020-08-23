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
	public function index($name='name',$case='case',$pos="pos",$filter="1"){
		$header = [];
		$body = [];
		$footer = [];

		
		$body["user_name"] = $this->uri->segment("4");
		$body["plan_case"] = $this->uri->segment("5");
		$pos =  $this->session->userdata('user_pos');
		$body["user_pos"] = $pos;

		$config = array();
		$config["base_url"] = base_url() .'admin/schedule/set/'.$body["user_name"].'/'.$body["plan_case"].'/'.$body["user_pos"].'/';
		$this->_sorting($name,$case,$pos);
		$total_row = $this->model_base->count_data('sentiment_plan as sp');
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

		
		$this->_sorting($name,$case,$pos);
		$body['plans'] = $this->model_base->get_all('sentiment_plan as sp');
		$this->db->flush_cache();


		$this->load->view("template/site_admin_header",$header);
		$this->load->view('admin/intervention/index',$body);
		$this->load->view("template/site_admin_footer",$footer);

	}
	public function _sorting($name, $case, $pos){
		$this->db->where('sp.plan_status !=','deleted');
		$this->db->join("user", "sp.stud_id = user.user_id");
		$this->db->join("sentimend_meeting", "sp.meet_id = sentimend_meeting.meet_id");
		$this->db->group_by("sp.plan_id");
		if($name != "name"){
			$namesearch = array('user.user_fname' => $name, 'user.user_lname' => $name, 'user.user_mname' => $name);
			$this->db->or_having($namesearch);
		}
		if($case != 'case'){
			$this->db->where('sp.plan_case',$case);
		}
		if($pos != 'pos'){
			$this->db->where('user.user_pos',$pos);
		}


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
	public function view($id){
		$header = [];
		$body = [];
		$footer = [];

		$this->form_validation->set_rules('plan_id', 'ID', 'required|trim');

		if($this->input->post("upload_file")){

			if ($this->form_validation->run() == FALSE){
				$body['msg_error'] = validation_errors();
		   }else{
			   $data = $this->input->post();
			   unset($data["upload_file"]);
			   // success
			   $config['upload_path']   = './uploads/plans'; 
			   $config['allowed_types'] = 'pdf'; 
			   $config['encrypt_name'] = FALSE; 
			   $config['max_size'] = "10000000"; // Can be set to particular file size , here it is 2 MB(2048 Kb)
			   $this->load->library('upload', $config);
			   $this->upload->initialize($config);

			   $upload_data = array();
			   $table = "sentiment_plan";
			   $upload_data['plan_update'] = $this->getDatetimeNow();
			   $col = 'plan_id';
			   if ( !$this->upload->do_upload('plan_file')) {
				$body['msg_error'] = $this->upload->display_errors();
		 		}else { 
					$upload = $this->upload->data();
					$upload_data['plan_file'] = 'uploads/plans/' . $upload['file_name'];
					$this->model_base->update_data($data['plan_id'],$col,$upload_data,$table);
					$this->db->flush_cache();
					$this->session->set_flashdata('msg_success', 'Upload Success!');
					redirect('/admin/intervention/index/name/ongoing' ,'refresh');
				}
					

		   }

		}


		$col = "plan_id";
		$table_name = 'sentiment_plan as sp';
		$this->db->join('user', 'sp.stud_id = user.user_id');
		$this->db->join('sentimend_meeting', 'sp.meet_id = sentimend_meeting.meet_id');
		$this->db->join('sentiment_case', 'sp.case_id = sentiment_case.case_id');
		$body['plan'] = $this->model_base->get_one($id,$col,$table_name);
		$this->db->flush_cache();

		// $col = "user_id";
		// $table_name = 'user as us';
		// $this->db->join('sentimend_meeting', 'us.user_id = sentimend_meeting.stud_id');
		// $body['plan'] = $this->model_base->get_one($body['plan'][0]['user_id'],$col,$table_name);
		// $this->db->flush_cache();

		$this->load->view("template/site_admin_header",$header);
		$this->load->view('admin/intervention/view',$body);
		$this->load->view("template/site_admin_footer",$footer);

	}
}	