<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cases extends CI_Controller {

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
	
	public function view($id){
		$header = [];
		$body = [];
		$footer = [];
		
		$this->load->view("template/site_admin_header",$header);
		$this->load->view('admin/case/index',$body);
		$this->load->view("template/site_admin_footer",$footer);
	}
}