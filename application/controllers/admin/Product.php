<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->helper('msg');
		$this->load->model('Pro');
		$this->load->library('upload');
		$this->load->library('pagination'); 
	}
	

//案例列表
	public function caselist($offset='')
	{
		
		$perPage = 2;
		$config['base_url'] = site_url('Admin/product/caselist');
		$config['total_rows'] = $this->db->count_all('case');
		$config['per_page'] = $perPage;
		$config ['next_link'] = '下一页>';
		$config ['prev_link'] = '<上一页';

		$this->pagination->initialize($config);
		//分页
		$data['link'] =  $this->pagination->create_links();
		//查询数据
		$limit = $config['per_page'];
		$data['list'] = $this->db->limit($limit,$offset)->get('case')->result_array();

		$this->load->view('admin/case/list',$data);
	}



	public function caseadd()
	{
		$this->load->view('admin/case/add');
	}
	//案列添加
	public function caseinsert()
	{
		$data['case_title'] = $this->input->post('case_title');
		$data['case_content'] = $this->input->post('case_content');
		$data['add_time'] = time();

		$config['upload_path']      = './public/uploads/';
        $config['allowed_types']    = 'gif|jpg|png';
        $config['max_size']     = 100;
        $config['max_width']        = 1024;
        $config['max_height']       = 768;
        //初始化配置文件
        $this->upload->initialize($config);
        if ( ! $this->upload->do_upload('case_img'))
        {
           error('上传失败');die;
        }
        else
        {
            $data['case_img'] = $this->upload->data('file_name');
    
        }
        $res = $this->db->insert('case',$data);
        if($res){
        	echo "<script>alert('提交成功');</script>";
        	redirect('admin/Product/caselist');
        }else{
        	error('添加失败');
        }
	}

	//案例删除
	public function casedel()
	{
		$id = $this->input->post('id');
		$res = $this->db->delete('case',['case_id'=>$id]);
		if($res){
			echo 1;
		}else{
			echo 0;die;
		}
	}

	//修改默认
	public function casemodify()
	{
		$id = $this->input->get('id');
		$data['id'] = $id;
		$data['row'] = $this->Pro->rowcase($id);
		$this->load->view('admin/case/modify',$data);
	}

	//修改案列
	public function caseupdate()
	{
		$data['case_title'] = $this->input->post('case_title');
		$data['case_content'] = $this->input->post('case_content');
		$data['add_time'] = time();
		$config['upload_path']      = './public/uploads/';
        $config['allowed_types']    = 'gif|jpg|png';
        $config['max_size']     = 100;
        $config['max_width']        = 1024;
        $config['max_height']       = 768;
        $this->upload->initialize($config);
        if ( ! $this->upload->do_upload('case_img'))
        {
           error('上传失败');die;
        }
        else
        {
            $data['case_img'] = $this->upload->data('file_name');
    
        }
        $id = $this->input->post('id');
        $res = $this->db->update('case',$data,['case_id'=>$id]);
        if($res){
        	redirect('admin/Product/caselist');
        }else{
        	error('操作失败');
        }
	}



}