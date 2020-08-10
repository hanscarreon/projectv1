<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
	public function index($slug="all",$mood="mood",$status="status",$filter="1"){

		$header = [];
		$body = [];
		$footer = [];

		$body["user_name"] = $this->uri->segment("4");
		$body["senti_mood"] = $this->uri->segment("5");
		$body["senti_status"] = $this->uri->segment("6");

		if($this->input->post("search_mode")){
			$this->form_validation->set_rules('search_name', 'search name', 'trim');
			$this->form_validation->set_rules('senti_mood', 'search name', 'trim');
			$this->form_validation->set_rules('senti_status', 'search name', 'trim');
			if ($this->form_validation->run() == FALSE) {
				$body['msg_error'] = validation_errors();
			} else {
				$data = $this->input->post();
				unset($data['search_mode']);
				if(!empty($data["search_name"])){
					$data["search_name"] = $data["search_name"];
				}else{
					$data["search_name"] ="all";
				}

				if(!empty($data["senti_mood"])){
					$data["senti_mood"] = $data["senti_mood"];
				}else{
					$data["senti_mood"] ="mood";
				}
				if(!empty($data["senti_status"])){
					$data["senti_status"] = $data["senti_status"];
				}else{
					$data["senti_status"] ="status";
				}
				redirect('admin/dashboard/index/' . $data['search_name'] . '/'.$data["senti_mood"].'/'.$data["senti_status"],'refresh');
			}
		}

		$config = array();
		$config["base_url"] = base_url() .'admin/dashboard/index/'.$body["user_name"].'/'.$body["senti_mood"].'/'.$body["senti_status"].'/';
		$this->_sorting($slug,$mood,$status);
		$total_row = $this->model_base->count_data('sentiment');
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
		// $this->db->join("user", "sentiment.user_id = user.user_id");
		$this->_sorting($slug,$mood,$status);
		$this->db->where('sentiment.senti_status','published');
		// $this->db->group_by('sentiment.user_id,user.user_id');
		$body['sentiments'] = $this->model_base->get_all('sentiment');
		$this->db->flush_cache();


		$col = "senti_mood";
		$val = "positive";
		$body["positive"] = $this->model_base->count_data_status("sentiment",$col,$val);

		$col = "senti_mood";
		$val = "neutral";
		$body["neutral"] = $this->model_base->count_data_status("sentiment",$col,$val);

		$col = "senti_mood";
		$val = "negative";
		$body["negative"] = $this->model_base->count_data_status("sentiment",$col,$val);

		$body["total"]=$total_row;
		$this->load->view("template/site_admin_header",$header);
		$this->load->view('admin/view_dashboard',$body);
		$this->load->view("template/site_admin_footer",$footer);

	}
	
    public function _sorting($slug,$mood,$status){
    	// $this->db->where('mot_status ', 'published');
		$this->db->join("user", "sentiment.user_id = user.user_id");

    	if($mood != 'mood'){
    		$this->db->where('senti_mood',$mood);
    	}
    	if($status != 'status'){
    		$this->db->where('senti_status',$status);

    	}
    	if($slug != 'all'){
    		$this->db->like('user.user_fname',$slug,'both');
    		$this->db->or_like('user.user_lname',$slug,'both');
    		$this->db->or_like('user.user_mname',$slug,'both');

    	}


    }








    public function check($text){
		$header = [];
		$body = [];
		$footer = [];

		$text = "Fuck you mother fucker";
		$data = $this->detect_sentiment($text);
		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
		$body["state"] = $data["data"]["state"]; // state result
		// $body["status"] = $data;
		// $body["status"] = $data;


		$this->load->view("template/site_admin_header",$header);
		$this->load->view('admin/view_dashboard',$body);
		$this->load->view("template/site_admin_footer",$footer);

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
	  
     

}