<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Affiliation_model extends CI_model
{
	
	public function save_affliation_data($table,$data)
	{		
		$this->db->insert($table,$data);
		return true;
	}
	
	public function update_affliation_data($table,$data,$college_id)
	{
		$this->db->where('college_id',$college_id);
		$this->db->update($table,$data);
		return true;
	}
	public function update_affili_data($table,$data,$college_id)
	{
		$this->db->where('id',$college_id);
		$this->db->update($table,$data);
		return true;
	}
	public function Get_Affliation_Data($table,$college_id)
	{
		$res=$this->db->query("select * from ".$table." where `college_id`='$college_id'");
		$query = $res->result();
		return $query;
	}
	
	public function insertUser($table,$data)
	{
		$this->db->insert($table,$data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	public function GetData($table,$id='',$col_name)
	{
		$this->db->select('*');
		$this->db->from($table);
		/*if($from!='')
		{
			$this->db->where($from,$id);
		}*/
		//$this->db->where('id',$id);
		$this->db->where($col_name,$id);
		$query = $this->db->get();
		$row = $query->result_array();
		return $row;
	}
	public function GetDataLimit($table,$limit='')
	{
		$this->db->select('*');
		$this->db->from($table);
		/*if($from!='')
		{
			$this->db->where($from,$id);
		}*/
		//$this->db->where('id',$id);
		//$this->db->where($col_name,$id);
		//$this->db->limit($limit,'1');
		$this->db->order_by('id', "desc");
		$this->db->limit('1');
		$query = $this->db->get();
		$row = $query->result_array();
		//print_r($row);
		return $row;
	}
	public function Update($table,$data,$id,$where_col)
	{
		$this->db->where($where_col, $id);
		$this->db->update($table, $data);
		$insert_id = $this->db->affected_rows();		
		return $insert_id;
	}
}

?>