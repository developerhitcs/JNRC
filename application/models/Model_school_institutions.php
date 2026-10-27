<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_school_institutions extends CI_model
{

	public function Login_verify($course,$username,$password)
	{
		
		$this->db->select("*");
		$this->db->from('college_list');
		$this->db->where('course_type',$course);
		$this->db->where('school_code',$username);
		$this->db->where('show_pass',$password);
		
		if($res=$this->db->get())
		{
			return $res->row_array();
		}
		else
		{
			return false;
		}
	}
	public function Login_verify_Details($course,$username,$password)
	{
		$this->db->select("*");
		$this->db->from('college_list');
		$this->db->where('course_type',$course);
		$this->db->where('school_code',$username);
		$this->db->where('show_pass',$password);
		$query = $this->db->get();
		$row = $query->result_array();
		return $row;
	}
	
	public function password_matched($id,$old)
	{
		
		$this->db->select("*");
		$this->db->from('college_list');
		$this->db->where('id',$id);
		$this->db->where('password',$old);
		if($res=$this->db->get())
		{
			return $res->row_array();
		}
		else
		{
			return false;
		}
	}
	
	public function Get_institution_details($table,$where,$value)
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($where,$value);
		$query = $this->db->get();
		$row = $query->result_array();
		return $row;
	}
	
	public function Insert_College_Details($table, $data)
	{
		$this->db->insert($table,$data);
		$in_id= $this->db->insert_id();
		return true;
	}
	public function Update_institution_details($table,$data,$id)
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
	
	public function Get_Affected_Details($table)
	{
		$this->db->select('*');
		$this->db->from($table);
		$query = $this->db->get();
		$row = $query->result_array();
		return $row;
	}
	public function Get_Ref_Affected_Details($table,$id)
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('id',$id);
		$query = $this->db->get();
		$row = $query->result_array();
		return $row;
	}
	public function count_aadhar($value)
	{
		$this->db->select('*');
		$this->db->from('exam_form_tb');
		$this->db->where('aadhar',$value);		
		$query = $this->db->get();
		$row = $query->result_array();
		return $row;
	}
	public function Submit_Exam_Details($table, $data)
	{
		$this->db->insert($table,$data);
		$in_id= $this->db->insert_id();
		return $in_id;
	}
	public function Get_distinct_institution_details($table,$distinct,$where,$value)
	{
		$this->db->distinct();
		$this->db->select($distinct);
		$this->db->where($where,$value);
		$query = $this->db->get($table);
		$row = $query->result_array();
		
		return $row;
	}
	
	public function Get_exam_form_details($table,$id,$session,$course)
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('issue_by',$id);
		$this->db->where('batch_session',$session);
		$this->db->where('course',$course);		
		$query = $this->db->get();
		$row = $query->result_array();
		return $row;
	}
}
?>