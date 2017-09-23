<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Pro extends CI_Model
{
	public function getcase()
	{
		return $this->db->get('case')->result_array();
	}

	//限定条件
	public function rowcase($id)
	{
		return $this->db->where(['case_id'=>$id])->get('case')->result_array();
	}

	public function prolist()
	{
		return $this->db->limit(3)->get('case')->result_array();
	}
	public function newscate()
	{
		return $this->db->order_by('add_time','desc')->limit(1)->get('news')->result_array();
	}
	public function newscase()
	{
		return $this->db->order_by('add_time','desc')->limit(3,5)->get('news')->result_array();
	}

}

?>