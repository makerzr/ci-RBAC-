<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Msg extends CI_Model
{
	public function getmsg()
	{
		return $this->db->get('message')->result_array();
	}

}

?>