<?php
defined('BASEPATH') OR exit('No direct script access allowed');
session_start();
class Manage extends CI_Controller {
	public function __construct(){
		parent::__construct();
		// $this->load->library('session');
		$this->load->helper('msg');
		$this->load->model('Team');
		$this->load->model('Adminlist');
        $this->load->model('Rolelist');
        $this->load->model('Powerlist');
		$this->load->model('Adminrole');
		$this->load->model('Rolepower');
		$this->load->library('upload');
	}
	/**
    *检测是否登录方法
    */
    public function checklogin()
    {
        $admin_id = $_SESSION['admin_id'];
        // var_dump($admin_id);die();
        if(!$admin_id){
            redirect('admin/admin/login');
        }else{
            //有session的话判断是否有权限
            //①根据admin_id,获取角色id
            $role_id = $this->Adminrole->admingetrole($admin_id);
            if($role_id){
                //把角色id转成一位数据
            $newroleid = array_column($role_id,'role_id');
            //根据角色id查询权限
            foreach($newroleid as $val){
                $power_id =$this->Rolepower->roleIdGetpower($val);
            }
            //把它转成一位数组
            $newpowerid = array_column($power_id,'power_id');
            $routes=[];
            //通过power_id,获取route
            foreach($newpowerid as$key=>$val){

                $route[]=$this->Powerlist->getroute($val);
            }
            //转成二位数组
            $twoarray = $this->Powerlist->array_merge_rec($route);
            $onearray =array_column($twoarray,'route');
            $path_info =ltrim($_SERVER["PATH_INFO"],'/');
            // var_dump($path_info);
            if(!in_array($path_info,$onearray)){
                echo "您没有权限访问";die();
            }
            }else{
                echo "您没有权限访问";die();
            }
        }
    }
	
	/**
	*用户添加显示
	*/
	public function useradd()
	{
		$data['roles'] = $this->Team->getteam();
		$this->load->view('admin/team/add',$data);
	}
	public function userinsert()
	{
		// $data['team_img'] = $this->input->post('team_img');
		// $data['team_name'] = $this->input->post('team_name');
		// $data['team_position'] = $this->input->post('team_position');
		// $data['team_manifo'] = $this->input->post('team_manifo');
		$data = $this->input->post();
		$config['upload_path']      = './public/uploads/';
        $config['allowed_types']    = 'gif|jpg|png';
        $config['max_size']     = 100;
        $config['max_width']        = 1024;
        $config['max_height']       = 768;
        //初始化配置文件
        $this->upload->initialize($config);
        if ( ! $this->upload->do_upload('team_img'))
        {
           error('上传失败');die;
        }
        else
        {
            $data['team_img'] = $this->upload->data('file_name');
    
        }
		$res = $this->db->insert('team',$data);
		$insert_id = $this->db->insert_id();
		if($res){
			echo "<script>alert('提交成功');</script>";
			redirect('admin/Manage/userlist');
		}
		else{
			error('添加失败');
		}
	}

	/**
	* 用户列表
	*/
	public function userlist(){
		$this->checklogin();
		$data['admin'] = $this->Team->getteam();
		// echo $this->db->last_query();die;
		// print_r($data);die;
		$this->load->view('admin/team/list',$data);
	}
	/**
	* 用户删除
	*/
	public function userdel()
	{
		$id = $this->input->post('id');
		$res = $this->db->delete('team',['team_id'=>$id]);
		if($res){
			echo 1;
		}else{
			echo 0;
		}
		// error('删除失败');
			
	}
	/**
	* 修改默认
	*/
	public function usermodify(){
		$id = $this->input->get('id');
		$data['id'] = $id;
		$data['row'] = $this->Team->rowteam($id);
		$this->load->view('admin/team/modify',$data);
	}
	/**
	* 执行修改
	*/
	public function userupdate(){
		$data['team_name'] = $this->input->post('team_name');
		$data['team_manifo'] = $this->input->post('team_manifo');
		$data['team_position'] = $this->input->post('team_position');

		$config['upload_path']      = './public/uploads/';
        $config['allowed_types']    = 'gif|jpg|png';
        $config['max_size']     = 100;
        $config['max_width']        = 1024;
        $config['max_height']       = 768;
        $this->upload->initialize($config);
        if ( ! $this->upload->do_upload('team_img'))
        {
           error('上传失败');die;
        }
        else
        {
            $data['team_img'] = $this->upload->data('file_name');
    
        }
        
		$id = $this->input->post('id');
		$res = $this->db->update('team',$data,['team_id'=>$id]);
		if($res){
			redirect('admin/Manage/userlist');
		}
		else
		{
			error('操作失败');
		}
	}



}