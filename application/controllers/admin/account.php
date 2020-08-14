<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

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
	public function index($filter){
		$header = [];
		$body = [];
		$footer = [];
		$body["filter"] = $filter;
		$this->load->view("template/site_admin_header",$header);
		$this->load->view('admin/account/index',$body);
		$this->load->view("template/site_admin_footer",$footer);

	}

	public function create(){
		$header = [];
		$body = [];
		$footer = [];
		$body["data"] = "test";


		// form validation create account
		$this->form_validation->set_rules('user_email', 'Email', 'required|trim|valid_email|is_unique[user.user_email]');
		$this->form_validation->set_rules('user_name', 'Username', 'required|trim|min_length[5]|is_unique[user.user_name]');
		// $this->form_validation->set_rules('user_pass', 'Password', 'trim|required|matches[user_password_conf]|min_length[5]|md5'); 
		$this->form_validation->set_rules('user_pass', 'Password', 'trim|required|min_length[5]|md5'); 
		$this->form_validation->set_rules('user_fname', 'Firstname', 'required|trim');
		$this->form_validation->set_rules('user_lname', 'Lastname', 'required|trim');
		$this->form_validation->set_rules('user_mname', 'Middlename', 'required|trim');
		$this->form_validation->set_rules('user_role', 'Role', 'required|trim');
		$this->form_validation->set_rules('user_pos', 'Curriculum', 'required|trim');
		// $this->form_validation->set_rules('usr_contact', 'Contact Number', 'required|trim');

		if($this->input->post("create_account")){
			 if ($this->form_validation->run() == FALSE){
			 	$body['msg_error'] = validation_errors();
				$body["data"] = "error";
        	}
        	else{
        		$data = $this->input->post();
				unset($data['create_account']);

				$data['user_created'] = $this->getDatetimeNow();
				$this->model_base->insert_data($data, 'user');
				$this->session->set_flashdata('msg_success', 'Successfully created!');
				$this->db->flush_cache();
				redirect('admin/account/view' ,'refresh');
          		
       		 }

		}
		$this->load->view("template/site_admin_header",$header);
		$this->load->view('admin/account/create',$body);
		$this->load->view("template/site_admin_footer",$footer);

	}
	public function view(){
		$header = [];
		$body = [];
		$footer = [];
		$body["filter"] = "test";
		
		$this->load->view("template/site_admin_header",$header);
		$this->load->view('admin/account/view',$body);
		$this->load->view("template/site_admin_footer",$footer);

	}

}