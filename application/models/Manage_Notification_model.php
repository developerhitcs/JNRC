<?php
class Manage_Notification_model extends CI_model
{

	public function Get_Data($table)
	{
		$this->db->select('*');
		$this->db->from($table);
		$query = $this->db->get();
		$row = $query->result_array();
		return $row;
	}
	public function Submit_Data($table, $data)
	{
		$this->db->insert($table,$data);
		return true;
	}
	public function Update_Details($table,$data,$id)
	{
		$this->db->where('id', $id);
		$this->db->update($table, $data);
		return true;
	}
	
	public function Delete_Details($table,$col_name,$id)
	{
		$this->db->where($col_name, $id);
		$this->db->delete($table);
		return true;
		//return ($update == true) ? true : false;
	}
	

}

?>
