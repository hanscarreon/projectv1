<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'libraries/REST_Controller.php';

class Account extends REST_Controller{

  public function __construct(){

    parent::__construct();
    //load database
    $this->load->database();
	$this->load->helper('url','date', 'form','security');
    $this->load->library(array("form_validation"));
	$this->load->model('model_base');

  }

  public function Create_post(){
     $_POST = json_decode(file_get_contents("php://input"), true);  // get post value
    // form validation for inputs
   // form validation create account

		$this->form_validation->set_rules('user_email', 'Email', 'required|trim|valid_email|is_unique[user.user_email]');
		$this->form_validation->set_rules('user_name', 'Username', 'required|trim|min_length[5]|is_unique[user.user_name]');
		// $this->form_validation->set_rules('user_pass', 'Password', 'trim|required|matches[user_password_conf]|min_length[5]|md5'); 
		$this->form_validation->set_rules('user_pass', 'Password', 'trim|required|min_length[5]|md5'); 
		$this->form_validation->set_rules('user_fname', 'Firstname', 'required|trim');
		$this->form_validation->set_rules('user_lname', 'Lastname', 'required|trim');
		$this->form_validation->set_rules('user_mname', 'Middlename', 'required|trim');
		$this->form_validation->set_rules('user_pos', 'Curriculum', 'required|trim');
		// $this->form_validation->set_rules('usr_contact', 'Contact Number', 'required|trim');
    if($this->form_validation->run() == FALSE){
    	// echo json_encode(validation_errors());
    	echo validation_errors();
    	// return JSON.stringify(validation_errors());
    }else{
       $data = $this->input->post();
    	 $data['user_created'] = $this->getDatetimeNow();
    	 $data['user_role'] = "student";
         $table = "user";
         	if($this->model_base->insert_data($data, $table)){
    				$this->db->flush_cache();

    	          $this->response(array(
    	            "status" => 1,
    	            "message" => "Student Account Created!"
    	          ), REST_Controller::HTTP_OK);

         	}else{
         		  $this->response(array(
    	            "status" => 0,
    	            "message" => "Failed to Create Account!"
    	          ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
         	}
    }
  

  }
  public function receiver_get(){
      
  }



}