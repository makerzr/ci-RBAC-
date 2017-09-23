<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Team extends CI_Model
{
	public function getteam()
	{
		return $this->db->get('team')->result_array();
	}

	public function rowteam($id)
	{
		return $this->db->where(['team_id'=>$id])->get('team')->result_array();
	}

	public function teamlist()
	{
		return $this->db->limit(3)->get('team')->result_array();
	}
}

?>