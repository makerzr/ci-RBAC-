<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Cate');
		$this->load->model('Newer');

	}

	//后台首页显示
	public function index()
	{
		
		$data['cates'] = $this->Cate->Catelist();
		// print_r($data);die;
		$data['img'] = $this->Newer->rownews();
		$data['newlist'] = $this->Newer->rownew();
		$data['news'] = $this->Newer->rows();
		
		$this->load->view('home/news/news',$data);
	}
	public function content()
	{
		$id = $this->input->get('id');
		$data['list'] = $this->Newer->news($id);
		$this->load->view('home/news/news_content',$data);
	}
	public function catelist()
	{
		$id = $this->input->get('id');
		$data['arr'] = $this->Newer->catenews($id);
		$data['cates'] = $this->Cate->Catelist();
		$data['news'] = $this->Newer->caterows($id);
		$data['newlist'] = $this->Newer->catenew($id);
		$this->load->view('home/news/news_list',$data);
	}


}

?>