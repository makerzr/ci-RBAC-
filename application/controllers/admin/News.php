<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->helper('msg');
		$this->load->helper('url');
		$this->load->model('Newer');
		$this->load->model('Cate');
		$this->load->library('upload');
		$this->load->library('pagination'); 
	}
	

//新闻列表
	public function newslist($offset='')
	{
		      //导入分页类
		$perPage =3;          //每页显示的记录数
		$config['base_url'] = site_url('admin/News/newslist');
 	   //导入分页类URL
		$config['total_rows'] = $this->db->count_all('news');  //计算总记录数
       //自定义分页连接  
        $config['per_page'] =$perPage;
        $config['next_link'] = '下一页>'; 
		$config['prev_link'] = '<上一页';  
		$this->pagination->initialize($config);      //初始化分类页     
		$data['link'] = $this->pagination->create_links();
		$limit = $config['per_page'];
		$this->db->limit($limit,$offset);	
		$data['results']=$this->Newer->getnews();
		$this->load->view('admin/news/list',$data);
	}



	public function newsadd()
	{
		$data = $this->Cate->getcateall();
		$newsarr = $this->Cate->getCate($data);
		$this->load->view('admin/news/add',['newsarr'=>$newsarr]);
	}
	//新闻添加
	public function newsinsert()
	{
		$data['news_title'] = $this->input->post('news_title');
		$data['news_content'] = $this->input->post('news_content');
		$data['cate_id'] = $this->input->post('cate_id');
		$data['add_time'] = time();

		$config['upload_path']      = './public/uploads/';
        $config['allowed_types']    = 'gif|jpg|png';
        $config['max_size']     = 1000;
        $config['max_width']        = 1024;
        $config['max_height']       = 768;
        //初始化配置文件
        $this->upload->initialize($config);
        if ( ! $this->upload->do_upload('news_img'))
        {
           error('上传失败');die;
        }
        else
        {
            $data['news_img'] = $this->upload->data('file_name');
    
        }
        $res = $this->db->insert('news',$data);
        if($res){
        	echo "<script>alert('提交成功');</script>";
        	redirect('admin/News/newslist');
        }else{
        	error('添加失败');
        }
	}

	//新闻删除
	public function newsdel()
	{
		$id = $this->input->post('id');
		$res = $this->db->delete('news',['news_id'=>$id]);
		if($res){
			echo 1;
		}else{
			echo 0;die;
		}
	}

	//修改默认
	public function newsmodify()
	{
		$id = $this->input->get('id');
		$data['id'] = $id;
		$data['row'] = $this->Newer->uprow($id);
		// print_r($data['row']);die;
		$arr = $this->Cate->getcateall();
		$data['newsarr'] = $this->Cate->getCate($arr);
		$this->load->view('admin/news/modify',$data);
	}

	//修改案列
	public function newsupdate()
	{
		$data['news_title'] = $this->input->post('news_title');
		$data['news_content'] = $this->input->post('news_content');
		$data['cate_id'] = $this->input->post('cate_id');
		$data['add_time'] = time();
		$config['upload_path']      = './public/uploads/';
        $config['allowed_types']    = 'gif|jpg|png';
        $config['max_size']     = 100;
        $config['max_width']        = 1024;
        $config['max_height']       = 768;
        $this->upload->initialize($config);
        if ( ! $this->upload->do_upload('news_img'))
        {
           error('上传失败');die;
        }
        else
        {
            $data['news_img'] = $this->upload->data('file_name');
    
        }
        $id = $this->input->post('id');
        $res = $this->db->update('news',$data,['news_id'=>$id]);
        if($res){
        	redirect('admin/News/newslist');
        }else{
        	error('操作失败');
        }
	}



}