<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Type extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('msg');
		$this->load->model('Cate');
	}
	
	/**
	*分类添加显示
	*/
	public function cateadd()
	{
		$data = $this->Cate->getcateall();
		$catearr = $this->Cate->getCate($data);
		$this->load->view('admin/cate/add',['catearr'=>$catearr]);
	}

	//分类添加
	public function cateinsert()
	{
		$data = $this->input->post();
		$res = $this->db->insert('cate',$data);
		if($res){
			echo "<script>alert('提交成功');</script>";
			redirect('admin/Type/catelist');
		}else{
			error('添加失败');
		}
	}
	/**
	* 分类列表
	*/
	public function catelist(){
		$data = $this->Cate->getcateall();
		$list = $this->Cate->getlevcate($data);
		$this->load->view('admin/cate/list',['list'=>$list]);
	}

	//分类删除
	public function catedel()
	{
		$id = $this->input->post('id');
		$res = $this->db->delete('cate',['cate_id'=>$id]);
		if($res){
			echo 1;
		}else{
			echo 0;
		}
	}

	public function catemodify()
	{
		$id = $this->input->get('id');
		$data['id'] = $id;
		$data['row'] = $this->Cate->rowtype($id);
		$arr = $this->Cate->getcateall();
		$data['list'] = $this->Cate->getCate($arr);
		$this->load->view('admin/cate/modify',$data);
	}

	public function cateupdate()
	{
		$id = $this->input->post('id');
		$data['cate_name'] = $this->input->post('cate_name');
		$data['pid'] = $this->input->post('pid');
		$res = $this->db->update('cate',$data,['cate_id'=>$id]);
		if($res){
			redirect('admin/Type/catelist');
		}else{
			error('操作失败');
		}
	}

}