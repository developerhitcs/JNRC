<?php
class College_model extends CI_model
{

	public function Get_College_List($table)
	{
		$this->db->select('*');
		$this->db->from($table);
		$query = $this->db->get();
		$row = $query->result_array();
		return $row;
	}
	public function Insert_College_Details($table, $data)
	{
		$this->db->insert($table,$data);
		return true;
	}
	public function Update_College_Details($table,$data,$id)
	{
		$this->db->where('id', $id);
		$this->db->update($table, $data);
		return true;
	}
	
	public function Delete_College_Details($table,$col_name,$id)
	{
		$this->db->where($col_name, $id);
		$this->db->delete($table);
		return true;
	}
	

}

?>