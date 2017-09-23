<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Floor extends CI_Model
{
	public function getteam()
	{
		return $this->db->get('cate')->result_array();
	}

}

?>