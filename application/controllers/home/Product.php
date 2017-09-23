<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('msg');
		$this->load->model('Pro');
		$this->load->library('pagination'); 
	}

	//后台首页显示
	public function index($offset='')
	{
		$perPage =2;          //每页显示的记录数
		$config['base_url'] = site_url('Home/product/index');
 //导入分页类URL
		$config['total_rows'] = $this->db->count_all('case');  //计算总记录数
		// print_r($config['total_rows']);die;
       //自定义分页连接  
        $config['per_page'] =$perPage;
        $config['next_link'] = '下一页>'; 
		$config['prev_link'] = '<上一页';  
		$this->pagination->initialize($config);      //初始化分类页     
		$data['link'] = $this->pagination->create_links();
		$limit = $config['per_page'];
		$this->db->limit($limit,$offset);	
		$data['list'] = $this->Pro->getcase();
		$this->load->view('home/case/case',$data);
	}

	public function content()
	{
		$id = $this->input->get('id');
		$data['str'] = $this->Pro->rowcase($id);
		$this->load->view('home/case/case_content',$data);
	}




}

?>