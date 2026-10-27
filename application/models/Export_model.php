<?php
class Export_model extends CI_model{

	public function examList()
	{
		//$query = $this->db->query("select t1.*,t2.* from exam_form t1 inner join exam_form_back t2 on t1.id=t2.ref_id order by t1.id desc limit 50");	
		//$query = $this->db->query("select t1.*,t2.* from exam_form t1 inner join exam_form_back t2 on t1.id=t2.ref_id order by t1.issue_by, t1.course");	
		$query = $this->db->query("select * from `exam_form_tb` order by id ASC ");	
		$row = $query->result();
		//print_r($row);
		return $row;
	}
	public function Get_Affected_Details($table)
	{
		$this->db->select('*');
		$this->db->from($table);
		$query = $this->db->get();
		$row = $query->result_array();
		return $row;
	}
	public function Get_exam_data($table,$session,$course)
	{
// 		$query = $this->db->query("select * from $table where batch_session='$session' and course='$course'  ORDER by roll_id ASC  ");
// tausif
		$query = $this->db->query("SELECT * FROM $table WHERE batch_session = '$session' AND course = '$course' AND date > '2026-08-21' ORDER BY roll_id ASC;");
		$row = $query->result();
		return $row;
	}
	public function renewalList()
	{
		$query = $this->db->query("select * from renewal order by id desc");	
		$row = $query->result();
		//print_r($row);
		return $row;
	}
}

?>