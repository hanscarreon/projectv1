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
	public function index($name="name",$case="study",$con="con",$pos='all',$filter="1"){

		$header = [];
		$body = [];
		$footer = [];

		$pos =  $this->session->userdata('user_pos');

		$body["user_name"] = $this->uri->segment("4");
		$body["case_study"] = $this->uri->segment("5");
		$body["case_con"] = $this->uri->segment("6");
		$body["user_pos"] = $pos;

		if($this->input->post("search_mode")){
			$this->form_validation->set_rules('search_name', 'search name', 'trim');
			if ($this->form_validation->run() == FALSE) {
				$body['msg_error'] = validation_errors();
			} else {
				$data = $this->input->post();
				unset($data['search_mode']);
				if(!empty($data["search_name"])){
					$data["search_name"] = $data["search_name"];
				}else{
					$data["search_name"] ="name";
				}
				
				redirect('admin/dashboard/index/' . $data['search_name'] . '/'.$body["case_study"].'/'.$body["case_con"],'refresh');
			}
		}

		$config = array();
		$config["base_url"] = base_url() .'admin/dashboard/index/'.$body["user_name"].'/'.$body["case_study"].'/'.$body["case_con"].'/'.$body["user_pos"].'/';
		$this->db->join("user", "sentiment_case.user_id = user.user_id");
		$this->_sorting($name,$case,$con,$pos);
		$total_row = $this->model_base->count_data('sentiment_case');
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

		$this->db->join("user", "sentiment_case.user_id = user.user_id");
		$this->_sorting($name,$case,$con,$pos);
		$this->db->where('sentiment_case.case_status','published');
		// // $this->db->group_by('sentiment.user_id,user.user_id');
		$body['sentiments'] = $this->model_base->get_all('sentiment_case');
		$this->db->flush_cache();


		$col = "case_study";
		$val = "positive";
		$this->_count_sort($pos);
		$body["positive"] = $this->model_base->count_data_status("sentiment_case",$col,$val);

		$col = "case_study";
		$val = "neutral";
		$this->_count_sort($pos);
		$body["neutral"] = $this->model_base->count_data_status("sentiment_case",$col,$val);

		$col = "case_study";
		$val = "negative";
		$this->_count_sort($pos);
		$body["negative"] = $this->model_base->count_data_status("sentiment_case",$col,$val);


		$this->_count_sort($pos);
		$overall = $this->model_base->count_data('sentiment_case');
		// $body["total"]= $config["total_rows"];
		$body["total"]= $overall;
		$this->load->view("template/site_admin_header",$header);
		$this->load->view('admin/view_dashboard',$body);
		$this->load->view("template/site_admin_footer",$footer);

	}
	public function _count_sort($pos){
		$this->db->join("user", "sentiment_case.user_id = user.user_id");
		$this->db->where('case_status','published');
		$this->db->where('case_con','ongoing');
    	$this->db->where('user.user_pos',$pos);


	}
	
    public function _sorting($name,$cases,$con,$pos){
		$this->db->where('case_status','published');

    	if($name != 'name'){
			$namesearch = array('user.user_fname' => $name, 'user.user_lname' => $name, 'user.user_mname' => $name);
			$this->db->or_having($namesearch);
    	}

    	if($cases != 'study'){
    		$this->db->where('case_study',$cases);
    	}
    	if($con != 'con'){
    		$this->db->where('case_con',$con);
    	}else{
    		$this->db->where('case_con','ongoing');

    	}
    	$this->db->where('user.user_pos',$pos);
    }
    public function delete_case($case_id) {
		$body['sentiments'] = $this->model_base->delete_data($case_id, 'case_id', 'case_status', 'sentiment_case');
		$this->session->set_flashdata('msg_success', 'Case Deleted!');	
		redirect('admin/dashboard/index/name/study/con','refresh');
		
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