<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rolelist extends CI_Model
{
    /**
    *获取所有的 角色列表信息
    */
    public function getallrole()
    {
        return $this->db->get('role')->result_array();
    }
    /**
    *根据role_id查询相关的信息
    *
    */
    public function getonerole($role_id)
    {
        return $this->db->get_where('role',['role_id'=>$role_id])->row_array();
    }
    /**
    *添加角色的操作
    *@param $rolename 角色名称
    *@return boolean
    */
    public function addrole($rolename)
    {
        $data =[
            'role_name'=>$rolename
        ];
        return $this->db->insert('role',$data);
    }
    /**
    *修改角色
    *@param $role_id
    *@param $role_name
    *@return boolean
    */
    public function editrole($roleid,$rolename)
    {
        $data = [
            'role_name'=>$rolename
        ];
        $this->db->where('role_id',$roleid);
        return $this->db->update('role',$data);

    }
}