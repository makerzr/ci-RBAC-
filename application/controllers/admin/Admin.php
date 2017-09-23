<?php
defined('BASEPATH') OR exit('No direct script access allowed');
session_start();
class Admin extends CI_Controller
{
	public function __construct() {
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
            redirect('admin/login');
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
    //生成验证码  
    public function code()  
    {  
        //调用函数生成验证码,上述的参数也可以继续使用  
        $vals = array(  
            'word_length' => 5
        );  
        create_captcha($vals);  
    } 
	/**
	*后台登录界面
	*
	*/
	public function login()
	{
        if($this->input->post()){
            $admin_name = $this->input->post('name');
            $admin_pwd = $this->input->post('password');
            $code = $this->input->post('code');
            if (empty($admin_name)) {
                echo "adminnonull";
                die();
            }
            if(empty($admin_pwd))
            {
                echo "pwdnonull";
                die();
            }
            if(empty($code))
            {
                echo "codenonull";
                die();
            }
            //取出session中的验证码
            $codeword = strtolower($_SESSION['codeword']);
            if(strtolower($code)!=$codeword){
                echo "codenoright";
                die();
            }
            //检测输入的账号和密码是否正确
            $chekres = $this->Adminlist->checkadmin($admin_name,$admin_pwd);
            if (!$chekres) {
                echo "nameorpwdnoright";
                die();
            }else{
                //为真的话,把admin_id,存入session中,
                $_SESSION['admin_id']=$chekres['admin_id'];
                //跳转
                echo "goindex";die();
            }
        }
		$this->load->view('admin/login');	
	}
	/**
	*后台登录成功默认页面
	*/
	public function index()
	{
        // $this->checklogin();
		$this->load->view('admin/index/index');
	}
	/**
	*后台网站设置页面
	*/
	public function info()
	{
        $this->checklogin();
		$this->load->view('admin/info');
	}
	/**
	*后台用户管理列表页
	*
	*/
	public function adminlist()
	{
        $this->checklogin();
	    if($this->input->get()){
           $id =$this->input->get('id');
           $oneadmin=$this->Adminlist->getoneadmin($id);
           //获取id查询已有的角色
           $getrole = $this->Adminrole->admingetrole($id);
            if($oneadmin){
                $data =[
                    'info'=>$oneadmin,
                    'role'=>$getrole            
                    ];
                echo json_encode($data);
                die();
            }
            echo  $getrole;
        }
        $rolelist['data'] = $this->Rolelist->getallrole();
		$rolelist['array']=$this->Adminlist->getadminlist();
		$this->load->view('admin/adminlist',$rolelist);
	}
    /**
    *添加管理员
    */
    public function addadmin()
    {        
        $this->checklogin();       
        if($this->input->post()){
            $admin_name = $this->input->post('addadmin_name');
            $admin_pwd =$this->input->post('addadmin_pwd');
            $true_name =$this->input->post('addtrue_name');
            $mobile =$this->input->post('addmobile');
            $status = $this->input->post('addstatus');
            $role_id = $this->input->post('role_id');
            //处理接收过来的角色id,去掉逗号
            $newroleid =rtrim($role_id,',');
            //字符串转成数据
            $arrayroleid = explode(',',$newroleid);
            $data =[
                'admin_name'=>$admin_name,
                'admin_pwd'=>md5($admin_pwd),
                'true_name'=>$true_name,
                'mobile'=>$mobile,
                'status'=>$status,
                'logins'=>0,
                'reg_time'=>time(),
                'lastlogin'=>0
            ];
            //插入成功的id
            $resid = $this->Adminlist->addAdminGetId($data);
            //如果不为空的话,插入记录到角色表里面
            if($newroleid!=''){
                foreach($arrayroleid as $key => $value){
                    $addrole = $this->Adminrole->adminAddRole($resid,$value);
                }
                if($addrole){
                    echo "yes";
                }else{
                    echo "no";
                }
            }
        }
    }
	/**
	*修改管理员
    *
    */
	public function updateadmin()
    {
        $this->checklogin(); 
        if($this->input->post()){
            $admin_id = $this->input->post('admin_id');
            $admin_name = $this->input->post('admin_name');
            $admin_pwd =$this->input->post('admin_pwd');
            $true_name =$this->input->post('true_name');
            $mobile =$this->input->post('mobile');
            $status = $this->input->post('status');
            $roleid=$this->input->post('role_id');
            $r_id = rtrim($roleid,',');
            $data=[
                'admin_name'=>$admin_name,
                'admin_pwd'=>md5($admin_pwd),
                'true_name'=>$true_name,
                'mobile'=>$mobile,
                'status'=>$status
            ];
            $updateres = $this->Adminlist->editadmin($admin_id,$data);
            if($updateres){
                echo "OK";
            }else{
                echo "NO";
            }
            if($roleid!=''){
                //首先获取当前id下的角色
                $oldrole = $this->Adminrole->admingetrole($admin_id);
                $oldroleid = array_column($oldrole,'role_id');
                $newroleid =explode(',',$r_id);
                $addroleid = array_diff($newroleid, $oldroleid);
                $delroleid = array_diff($oldroleid, $newroleid);
                //新增role
                foreach ($addroleid as $val) {
                   $addrole = $this->Adminrole->adminAddRole($admin_id,$val);
                }
                //删除role
                foreach($delroleid as $val){
                    $addrole = $this->Adminrole->deladminrole($admin_id,$val);
                }
            }else{
                //删除所有的role权限
                $delres = $this->Adminrole->delallrole($admin_id);
            }
        }
    }
    /**
    *角色列表页面
    *
    */
    public function rolelist()
    {
        $this->checklogin();
        if($this->input->get()){
            $role_id =$this->input->get('role_id');
            $roleinfo= $this->Rolelist->getonerole($role_id);
            if($roleinfo){
                echo $roleinfo['role_name'];
                die();
            }else{
                echo "false";
                die();
            }
        }
        $allrole['array']=$this->Powerlist->getallpower();
        $allrole['data']= $this->Rolelist->getallrole();
        $this->load->view('admin/rolelist',$allrole);
    }
    /**
    *添加角色
    */
    public function addrole()
    {
        $this->checklogin();
        $rolename = $this->input->post('rolename');
        $res = $this->Rolelist->addrole($rolename);
        if($res)
        {   
            echo "OK";
        }else{
            echo "NO";
        }
    }
    /**
    *修改角色
    */
    public function updaterole()
    {
        $this->checklogin();
        $roleid = $this->input->post('role_id');
        $rolename = $this->input->post('role_name');
        $res= $this->Rolelist->editrole($roleid,$rolename);
        if ($res) {
            echo "yes";       
        }else{
            echo  "NO";
        }
    }
    /**
    *权限列表页面
    *
    */
    public function powerlist()
    {
        $this->checklogin();
        if($this->input->get()){
            $power_id =$this->input->get('power_id');
            $onepowerinfo = $this->Powerlist->getonepower($power_id);
            echo json_encode($onepowerinfo);
            die();
        }
        $list['data'] = $this->Powerlist->getallpower();
        $this->load->view('admin/powerlist',$list);
    }
    /**
    *根据 role_id  获取角色名并且获取已经有的权限
    */
    public function  getRoleName()
    {
        if($this->input->get())
        {
            $role_id = $this->input->get('role_id');
            $res =$this->Rolelist->getonerole($role_id);
            //根据role_id获取权限
            $power_id = $this->Rolepower->roleIdGetpower($role_id);
            $data =[
                'rolename'=>$res['role_name'],
                'power_id'=>$power_id
            ];
            echo json_encode($data);
        }
    }
    /**
    *给角色添加权限
    */
    public function roleAddPower()
    {
        $this->checklogin();
        if($this->input->get()){
            $role_id = $this->input->get('role_id');
            $powerid =$this->input->get('powerid');
            //去掉逗号
            $power_id = rtrim($powerid,',');
                //首先获取当前角色下的权限id
                $oldpowerid = $this->Rolepower->roleIdGetpower($role_id);
                $oldpid = array_column($oldpowerid,'power_id');
                //转成数据
                $newpowerid = explode(',', $power_id);
                $addpowerid = array_diff($newpowerid, $oldpid);
                $delpowerid = array_diff($oldpid, $newpowerid);
                //给角色新增权限
                if($powerid!=''){
                    foreach ($addpowerid as $val) {
                   $role = $this->Rolepower->rolegetpower($role_id,$val);
                    }
                }
                    //删除角色权限
                foreach($delpowerid as $val){
                    $role = $this->Rolepower->delRolePower($role_id,$val);
                    }
                if($role)
                {
                    echo "OK";
                }else{
                    echo "NO";
                }  
        }
    }
    /**
    *新增权限
    */
    public function addPower()
    {
        $this->checklogin();
        if($this->input->get()){
            $powername =$this->input->get('powername');
            $urls = $this->input->get('routes');
            //执行新增权限的方法
            $addres = $this->Powerlist->addNewPower($powername,$urls);
            if($addres){
                echo "OK";
            }else{
                echo "NO";
            }
        }
    }
    /**
    *修改权限
    */
    public function updatepower()
    {
        if($this->input->post()){
            $power_name =$this->input->post('power_name');
            $route = $this->input->post('route');
            $power_id =$this->input->post('power_id');
            $data =[
                'power_name'=>$power_name,
                'route'=>$route
            ];
            $res = $this->Powerlist->editpower($power_id,$data);
            if ($res) {
                echo "OK";
            }else{
                echo 'NO';
            }
        }
    }
}