<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'libraries/REST_Controller.php';

class Student extends REST_Controller{

  public function __construct(){

    parent::__construct();
    //load database
    $this->load->database();
	$this->load->helper('url','date', 'form','security');
    $this->load->library(array("form_validation"));
	$this->load->model('model_base');

  }

  public function detect_sentiment($string){
		$string = urlencode($string);
		$api_key = "7b50350a2caa3035c741f773f8ad85";
		$url = 'https://api.paysify.com/sentiment?api_key='.$api_key.'&string='.$string.'';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		$response = json_decode($result,true);
		curl_close($ch);
		return $response;
   }

  public function index_post(){
     $_POST = json_decode(file_get_contents("php://input"), true);  // get post value

    // form validation for inputs
    $this->form_validation->set_rules("senti_text", "sentiment text", "required");
    $this->form_validation->set_rules("user_id", "sentiment text", "required");
    if($this->form_validation->run() == FALSE){
    	// echo json_encode(validation_errors());
    	echo validation_errors();
    	// return JSON.stringify(validation_errors());

    }else{
  	 $data = $this->input->post();
	 $data['senti_create'] = $this->getDatetimeNow();
	 $data['senti_text'] = $this->input->post("senti_text");
	 $data['senti_mood'] = $this->input->post("senti_text");
	 $senti_mood = $this->detect_sentiment($data['senti_mood']);
	 $data['senti_mood'] = strtolower($senti_mood['data']['state']);
     $table = "sentiment";
     	if($this->model_base->insert_data($data, $table)){
				$this->db->flush_cache();

	          $this->response(array(
	            "status" => 1,
	            "message" => "Student has been created"
	          ), REST_Controller::HTTP_OK);

     	}else{
     		  $this->response(array(
	            "status" => 0,
	            "message" => "Failed to create student"
	          ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);

     	}

    }
  

  }
  public function login_post(){
  	// echo "Get";

  }

  public function index_get(){
  	// echo "Get";

  }



}