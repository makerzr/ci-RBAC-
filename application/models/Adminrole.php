<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminrole extends CI_Model
{
	/**
	*用户添加角色
	*@param $resid string 用户id
	*@return $value 角色的id
	*/
	public function adminAddRole($resid,$value)
	{
		$data =[
			'admin_id'=>$resid,
			'role_id'=>intval($value)
		];
		return $this->db->insert('admin_role',$data);
	}
	/**
	*根据admin_id 获取已经有的角色
	*/
	public function admingetrole($id)
	{
		return  $this->db->select('role_id')->get_where('admin_role',['admin_id'=>$id])->result_array();
	}
	/**
	*删除取消的角色
	*/
	public function deladminrole($resid,$value)
	{
		$data =[
			'admin_id'=>$resid,
			'role_id'=>intval($value)
		];
		return $this->db->delete('admin_role',$data);
	}
	/**
	*删除所有的权限
	*/
	public function delallrole($admin_id)
	{
		return $this->db->where('admin_id',$admin_id)->delete('admin_role');
	}
}