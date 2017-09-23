<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
session_start();
class Index extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->load->library('session');
        $this->load->model('Adminlist');
        $this->load->model('Rolelist');
        $this->load->model('Powerlist');
        $this->load->model('Adminrole');
        $this->load->model('Rolepower');
        //加载验证码辅助函数
        $this->load->helper('captcha');
        $this->load->helper('url');
	}

        /**
    *检测是否登录方法
    */
    public function checklogin()
    {
        $admin_id = $_SESSION['admin_id'];
        if(!$admin_id){
            redirect('admin/login/login');
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
            if(!in_array($path_info,$onearray)){
                echo "您没有权限访问";die();
            }
            }else{
                echo "您没有权限访问";die();
            }
        }
    }
	//后台首页显示
	public function index()
	{
		$this->checklogin();
		$this->load->view('admin/index/index');
	}
}

?>