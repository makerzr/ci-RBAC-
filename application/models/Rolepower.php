<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rolepower extends CI_Model
{
	/**
	*通过角色分配相关的权限
	*@param $role_id 角色的id
	*@param $power_id 权限的id
	*@return boolean
	*/
	public function rolegetpower($role_id,$power_id)
	{
		$data = [
			'role_id'=>$role_id,
			'power_id'=>$power_id
		];
		return $this->db->insert('role_power',$data);
	}
	/**
	*根据角色id,查询出它的权限
	*@param $role_id
	*@return array
	*/
	public function roleIdGetpower($role_id)
	{
		return $this->db->select('power_id')->get_where('role_power',['role_id'=>$role_id])->result_array();
	}
	/**
	*给角色取消权限
	*/
	public function delRolePower($role_id,$value)
	{
		$data =[
			'role_id'=>$role_id,
			'power_id'=>intval($value)
		];
		return $this->db->delete('role_power',$data);
	}
}