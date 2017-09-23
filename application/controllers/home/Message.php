<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('msg');
    }


    public function index()
    {
        $this->load->view('home/callme/message');
    }

    //留言
    public function msginsert()
    {
    	$data = $this->input->post();
    	$res = $this->db->insert('message',$data);
    	if($res){
    		echo "<script>alert('ok');</script>";
    		redirect('home/message/index');
    	}else{
    		error('添加失败');
    	}
    }

}

?>