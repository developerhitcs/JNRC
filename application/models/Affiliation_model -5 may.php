<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Affiliation_model extends CI_model{
	
	public function insertUser($table,$data)
	{
		$this->db->insert($table,$data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
}

?>