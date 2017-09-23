<?php
defined('BASEPATH') OR exit('No direct script access allowed');
session_start();
class Message extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('msg');
		$this->load->model('Msg');
		$this->load->model('Adminlist');
        $this->load->model('Rolelist');
        $this->load->model('Powerlist');
		$this->load->model('Adminrole');
		$this->load->model('Rolepower');
		// $this->load->library('session');
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
	* 留言列表
	*/
	public function msglist(){
		$this->checklogin();
		$data['gtx'] = $this->Msg->getmsg();
		$this->load->view('admin/message/list',$data);
	}

	//留言删除
	public function msgdel()
	{
		$id = $this->input->post('id');
		$res = $this->db->delete('message',['message_id'=>$id]);
		if($res){
			echo 1;
		}else{
			echo 0;
		}
	}


}