<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Cate extends CI_Model
{
	public function getcateall()
	{
		return $this->db->get('cate')->result_array();
	}

  public function getCate($data,$cate_id=0){
        $dropdata = $this->getlevcate($data,$cate_id);
        foreach($dropdata as $val){
            $dropmenu[$val['cate_id']] = $val['cate_name'];
        }
        return $dropmenu;
    }

     /**
    * 处理代层级的数据
    */
   public function getlevcate($data,$cate_id='',$level=0,$pid=0){
        static $arr = array();
        if(is_array($data)&&count($data)>0){
            foreach($data as $val){
                //  判断层级
                if($val['pid']==$pid&&$val['cate_id']!=$cate_id){
                    /*追加层级*/
                    $val['level'] = $level;
                    $val['cate_name'] = str_repeat('||——',$level).$val['cate_name'];
                    // 把追加好的层级放新数组
                    $arr[] = $val;
                    $this->getlevcate($data,$cate_id,$level+1,$val['cate_id']);
                }
            }
        }
        return $arr;
    }

    public function rowtype($id)
    {
    	return $this->db->where(['cate_id'=>$id])->get('cate')->result_array();
    }

    public function Catelist()
    {
       //顶级
        $data = $this->getDataList();
        // 处理成代子级的数据
        foreach($data as $key=>$val){
            $data[$key]['son'] = $this->getDataList($val['cate_id']);
            foreach($data[$key]['son'] as $k=>$v){
                $data[$key]['son'][$k]['son'] = $this->getDataList($v['cate_id']);
            }
        }
        return $data;
    }

    public function getDataList($pid=0)
    {
        return $this->db->where(['pid'=>$pid])->get('cate')->result_array();

    } 

}

?>