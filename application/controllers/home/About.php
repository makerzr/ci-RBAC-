<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('msg');
		$this->load->model('Team');
	}
	

	public function index(){
		$data['list'] = $this->Team->teamlist();
		$this->load->view('home/about/about',$data);
	}

}