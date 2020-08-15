<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper(array('url','date', 'form'));
		$this->load->library(array('form_validation', 'session', 'pagination'));
		// $this->load->model('model_base');

	}
	public function index(){
		$header = [];
		$body = [];
		$footer = [];
		$body["user"] = "";

		if ( $this->have_sess_admin() == true ){
			redirect('admin/dashboard','refresh');
		}else{
			$this->load->model('model_login');
			$this->form_validation->set_rules('user_name', 'Username', 'required|trim');
			$this->form_validation->set_rules('user_pass', 'Password', 'required|trim|min_length[5]');

			if($this->input->post()) {
				if ($this->form_validation->run() == FALSE) {
					$body['msg_error'] = validation_errors();

				}else{
					$data = $this->input->post();
					$table = "user";
					// $account = $this->model_login->login($data["user_name"],$data["user_pass"], "user");
					$account = $this->model_login->login($data, $table);
					// $body["account"]= $account;
					if( count($account) >= 1){
	    				$this->session->set_flashdata('msg_success', 'Successfully log in!');
	    				$this->session->set_userdata($account[0]);	
						redirect('admin/dashboard/index/name/study/con/col/','refresh');

					}else{
	    				$body['msg_error'] = 'Invalid Account';

					}
				}
			}

		}
		

		$this->load->view('view_login',$body);

	}
	public function logout() {
       $this->session->sess_destroy();
       redirect('login', 'refresh'); 
   }
   
}






