<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Powerlist extends CI_Model
{
    /**
    *查询所有的权限列表
    *
    */
    public function getallpower()
    {
        return $this->db->order_by('power_id','desc')->get('power')->result_array();
    }
    /**
    *根据单个power_id 查询信息
    *@param $power_id string 
    *@return array
    */
    public function getonepower($power_id)
    {
        return $this->db->get_where('power',['power_id'=>$power_id])->row_array();
    }
    /**
    *添加新的权限
    */
    public function addNewPower($powername,$urls)
    {
        $data =[
            'power_name'=>$powername,
            'route'=>$urls
        ];
        return $this->db->insert('power',$data);
    }
    /**
    *修改权限
    *@param $power_id 
    *@return array
    */
    public function editpower($power_id,$data)
    {
        $this->db->where('power_id',$power_id);
        return $this->db->update('power',$data);      
    }
    /**
    *查询所有的权限id
    *
    */
    public function getallpowerid()
    {
        return $this->db->select('power_id')->get('power')->result_array();
    }
    /**
    *根据权限id获取路由
    */
    public function getroute($power_id)
    {
        return $this->db->select('route')->where('power_id',$power_id)->get('power')->result_array();
    }
    /**
    *3维数组转一维数组
    */
    public function array_merge_rec($array) {  // 参数是使用引用传递的
    // 定义一个新的数组
    $new_array = array ();
    // 遍历当前数组的所有元素
    foreach ( $array as $item ) {
        if (is_array ( $item )) {
            // 如果当前数组元素还是数组的话，就递归调用方法进行合并
            $this->array_merge_rec ( $item );
            // 将得到的一维数组和当前新数组合并
            $new_array = array_merge ( $new_array, $item );
        } else {
            // 如果当前元素不是数组，就添加元素到新数组中
            $new_array [] = $item;
        }
    }
    // 修改引用传递进来的数组参数值
    $array = $new_array;
        return $array;
    }
}