<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sentiment extends CI_Controller {

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

	public function index($name="name",$con="con",$pos="pos",$filter="1"){
		$header = [];
		$body = [];
		$footer = [];

		$pos =  $this->session->userdata('user_pos');
		$body["user_pos"] = $pos;
		$body['user_name'] = $this->uri->segment("4");
		$body['case_con'] = $this->uri->segment("5");
		
		$config = array();
		$config["base_url"] = base_url() .'admin/schedule/set/'.$body["user_name"].'/'.$body["case_con"].'/'.$body["user_pos"].'/';
		$this->_sorting($name,$con,$pos);
		$total_row = $this->model_base->count_data('sentiment_case as sm');
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

		$this->_sorting($name,$con,$pos);
		$body['sentiments'] = $this->model_base->get_all('sentiment_case as sm');
		$this->db->flush_cache();


		
		

		$this->load->view("template/site_admin_header",$header);
		$this->load->view('admin/case/index',$body);
		$this->load->view("template/site_admin_footer",$footer);

	}
	public function _sorting($name,$con,$pos){
		$this->db->join("user", "sm.user_id = user.user_id");
		// $this->db->join("user", "sm.user_id = user.user_id");
		$this->db->where('user.user_pos',$pos);
		$this->db->where('sm.case_status','published');
		// $this->db->group_by('sm.case_id');



		if($con != "con"){
			$this->db->where('sm.case_con',$con);
		}
		
		if($name != "name"){
			$namesearch = array('user.user_fname' => $name, 'user.user_lname' => $name, 'user.user_mname' => $name);
			$this->db->or_having($namesearch);
		}
		

	}


}