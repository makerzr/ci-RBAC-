<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Adminlist extends CI_Model
{
	/**
	*查询所有的管理员
	*/
	public function getadminlist()
	{
		return $this->db->order_by('admin_id','DESC')->get('admin')->result_array();
	}
	/**
	*根据id查询单个的管理员信息
    * @param id string
    * @return array
    */
	public function getoneadmin($id)
    {
        return $this->db->get_where('admin',['admin_id'=>$id])->row_array();
    }
    /**
    *添加新的管理员
    *@param $data array
    *@return boolean
    */
    public function addAdminGetId($data)
    {
    	$add = $this->db->insert('admin',$data);
    	if ($add) {
    		return $this->db->insert_id();
    	}
    }
    /**
    *根据admin_id修改数据
    *@param $admin_id string
    *@param $data array 要更新数据
    *@return boolean
    */
    public function editadmin($admin_id,$data)
    {
    	$this->db->where('admin_id',$admin_id);
    	return $this->db->update('admin',$data);
    }
    /**
    *根据用户名和密码来查询
    *@param $admin_name string
    *@param $admin_pwd string
    *@return boolean
    **/
    public function checkadmin($admin_name,$admin_pwd)
    {
        $data =[
            'admin_name'=>$admin_name,
            'admin_pwd'=>md5($admin_pwd)
        ];
        return $this->db->get_where('admin',$data)->row_array();
    }

}