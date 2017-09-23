<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Newer extends CI_Model
{
	public function getnews()
	{
		$data = $this->db->select('news.*,cate.*')
		->from('news')
		->join('cate','news.cate_id=cate.cate_id')
		->get()
		->result_array();
		return $data;
	}
	public function uprow($id)
	{
		return $this->db->where(['news_id'=>$id])->get('news')->result_array();
	}

	//限定条件
	public function rownews()
	{
		return $this->db->order_by('add_time','desc')->limit(1)->get('news')->result_array();
	}
	public function rownew()
	{
		return $this->db->order_by('add_time','asc')->limit(6)->get('news')->result_array();
	}

	public function rows()
	{
		return $this->db->order_by('add_time','desc')->limit(3)->get('news')->result_array();
	}
	//查询单个文章
	 public function news($id)
    {
    	return $this->db->where(['news_id'=>$id])->get('news')->result_array();
    }
	public function newslist()
	{
		return $this->db->limit(3)->get('news')->result_array();
	}
	//限定分类文章
	public function catenews($id)
	{
		return $this->db->where(['cate_id'=>$id])->order_by('add_time','desc')->limit(1)->get('news')->result_array();
	}
	public function caterows($id)
	{
		return $this->db->where(['cate_id'=>$id])->order_by('add_time','desc')->limit(3)->get('news')->result_array();
	}
	public function catenew($id)
	{
		return $this->db->where(['cate_id'=>$id])->order_by('add_time','asc')->limit(6)->get('news')->result_array();
	}



}

?>