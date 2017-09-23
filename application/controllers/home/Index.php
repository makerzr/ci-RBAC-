<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Index extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Pro');
	}

	//后台首页显示
	public function index()
	{
	if(file_exists('index.html')){
	echo file_get_contents('index.html');
}
//不存在的静态文件 我们通过ob来缓存,并且生成静态文件
		else{
		$data['list'] = $this->Pro->prolist();
		$data['gtx'] = $this->Pro->newscate();
		$data['amd'] = $this->Pro->newscase();	
		//开启页面静态化
		ob_start();
		$this->load->view("home/index/index",$data);
		//通过ob_get_contents()函数可以缓存里面的内容
		$res = ob_get_contents();
		//file_put_contents()函数写入新的文件
		file_put_contents('index.html',$res);
		}
	}

	public function content()
	{
		$id = $this->input->get('id');
		$data['str'] = $this->Pro->rowcase($id);
		$this->load->view('home/case/case_content',$data);
	}

}

?>