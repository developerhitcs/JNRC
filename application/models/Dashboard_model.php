<?php
class Dashboard_model extends CI_model
{
	
	
	
	
	public function Get_Institution_Data($table,$col_name='',$id='')
	{
		$this->db->select('*');
		$this->db->from($table);
		if($col_name != '')
		{
			$this->db->where($col_name,$id);
		}
		$this->db->order_by("renewal_status", "asc");		
		$this->db->order_by("school_code", "asc");
		$query = $this->db->get();
		$row = $query->result_array();
		return $row;
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function insert_excel($data)
	{
		$this->db->insert_batch('testing', $data);
		return true;
	}
	public function get_total() 
    {
        return $this->db->count_all("college_list");
    }
	public function get_current_page_records($limit, $start) 
    {
        $this->db->limit($limit, $start);
        $query = $this->db->get("college_list");
 
        if ($query->num_rows() > 0) 
        {
            foreach ($query->result() as $row) 
            {
                $data[] = $row;
            }
             
            return $data;
        }
 
        return false;
    }
	
	
	
	public function insert_notification_data($table, $data)
	{
		$this->db->insert($table,$data);
		return true;
	}	
	public function Get_Gallery_Data()
	{
		$this->db->select('*');
		$this->db->from('gallery');
		$query = $this->db->get();
		$row = $query->result_array();
		return $row;
	}
	public function Get_notification_data($table,$col_name='',$id='')
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($col_name,$id);
		$query = $this->db->get();
		$row = $query->result_array();
		return $row;
	}
	public function insert_data($table, $data)
	{
		$this->db->insert($table,$data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	var $DBNAME = '';
	public function insert_multiple_table($table, $data, $table2, $data2)
	{
		$this->db->insert($table,$data);
		$id = $this->db->insert_id();
		$this->DBNAME=$id;
		//inserting in 2nd table
		$data2['ref_id'] = $id;
		$this->db->insert($table2,$data2);
		$insert_id = $this->db->insert_id();		
		return $id;	
	}
	public function UpdatePassword($table,$data,$empcode)
	{
		$this->db->where('school_code', $empcode);
		$this->db->update($table, $data);
		$insert_id = $this->db->affected_rows();		
		return $insert_id;
	}
	public function GetData($table,$col_name='',$id='')
	{
		$this->db->select('*');
		$this->db->from($table);
		if($col_name != '')
		{
			$this->db->where($col_name,$id);
		}
		//$this->db->order_by("school_code", "asc");
		$query = $this->db->get();
		$row = $query->result_array();
		return $row;
	}
	public function GetDataAND($table,$col_name='',$id='',$col_name2='',$id2='')
	{
		$this->db->select('*');
		$this->db->from($table);
		if($col_name != '')
		{
			$this->db->where($col_name,$id);
		}
		if($col_name2 != '')
		{
			$this->db->where($col_name2,$id2);
		}
		$query = $this->db->get();
		$row = $query->result_array();
		return $row;
	}
	public function GetDataDesc($table,$col_name='',$id='')
	{
		/*if($id!='')
		$query = $this->db->query("select * from $table where $col_name='$id' or $col_name='$id2'");
		else*/
		$query = $this->db->query("select t1.*,t2.* from exam_form t1 inner join exam_form_back t2 on t1.id=t2.ref_id order by t1.id desc");	
		$row = $query->result_array();
		return $row;
	}
	public function GetDataDesc2($table,$col_name='',$id='',$limit='')
	{
		$this->db->select('*');
		$this->db->from($table);
		if($col_name != '')
		{
			$this->db->where($col_name,$id);
		}
		$this->db->order_by('id','desc');
		if($limit != '')
		{
			$this->db->limit($limit);
		}
		$query = $this->db->get();
		$row = $query->result_array();
		return $row;
	}
	public function GetDataLast50($table,$col_name='',$id='')
	{
		$query = $this->db->query("select t1.*,t2.* from exam_form t1 inner join exam_form_back t2 on t1.id=t2.ref_id order by t1.id desc limit 50");	
		//$query = $this->db->query("select t1.*,t2.* from exam_form t1 inner join exam_form_back t2 on t1.id=t2.ref_id order by t1.id ");	
		$row = $query->result_array();
		return $row;
	}
	public function GetDistinct($table,$column){
		$query = $this->db->query("select distinct($column) from $table order by issue_by asc");	
		$row = $query->result_array();
		return $row;
	}
	public function GetData3($course='',$school_code='')
	{
		if($course!='' AND $school_code!='')
		$query = $this->db->query("select t1.*,t2.* from exam_form t1 inner join exam_form_back t2 on t1.id=t2.ref_id  where course='$course' and issue_by='$school_code' order by t1.id desc");
		elseif($course!='')
		$query = $this->db->query("select t1.*,t2.* from exam_form t1 inner join exam_form_back t2 on t1.id=t2.ref_id  where course='$course' order by t1.id desc");
		elseif($school_code!='')
		$query = $this->db->query("select t1.*,t2.* from exam_form t1 inner join exam_form_back t2 on t1.id=t2.ref_id  where issue_by='$school_code' order by t1.id desc");	
		$row = $query->result_array();
		return $row;
	}
	public function GetData4($table,$table2='',$col_name='',$id='',$id2='')
	{
		if($id!='')
		$query = $this->db->query("select * from $table where $col_name='$id' or $col_name='$id2'");
		else
		$query = $this->db->query("select * from $table");	
		$row = $query->result_array();
		return $row;
	}
	public function GetDataSelected($select,$table,$col_name='',$id='')
	{
		$this->db->select($select);
		$this->db->from($table);
		if($col_name != '')
		{
			$this->db->where($col_name,$id);
		}
		$query = $this->db->get();
		$row = $query->result_array();
		return $row;
	}
	public function GetDataOrder($table,$col_name='',$id='')
	{
		$this->db->select('*');
		$this->db->from($table);
		if($col_name != '')
		{
			$this->db->where($col_name,$id);
		}
		$this->db->order_by('position');
		$query = $this->db->get();
		$row = $query->result_array();
		return $row;
	}
	public function GetDataCount($table)
	{
		$query = $this->db->query("SELECT count(*) as count FROM $table");
		$row = $query->result_array();
		return $row;
	}
	public function GetData2($table,$col_name='',$id='',$col_name1='',$id1='',$col_name2='',$id2='',$col_name3='',$id3='')
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($col_name,$id);
		$this->db->where($col_name1,$id1);
		if($id2 != '')
		{
			$this->db->where($col_name2,$id2);
		}
		if($id3 != '')
		{
			$this->db->where($col_name3,$id3);
		}
		$query = $this->db->get();
		$row = $query->result_array();
		//print_r($row);
		//die;
		return $row;
	}
	public function GetEmail()
	{
		$query = $this->db->query("SELECT email FROM `college_list` where email is not null");
		$row = $query->result_array();
		return $row;
	}
	public function Get_data_exam($id='')
	{
		if($id!='')
		$query = $this->db->query("select t1.*,t2.* from exam_form t1 inner join exam_form_back t2 on t1.id=t2.ref_id where t1.id=$id");
		else
		{
			if($_SESSION['role']=='institute'){
				$school_code = $_SESSION['school_code'];
				$query = $this->db->query("select t1.*,t2.* from exam_form t1 inner join exam_form_back t2 on t1.id=t2.ref_id where t1.issue_by='$school_code'");
			}	
			else
				$query = $this->db->query("select t1.*,t2.* from exam_form t1 inner join exam_form_back t2 on t1.id=t2.ref_id ");
		}
		$row = $query->result_array();
		return $row;
	}
	public function Get_data_admit($id='')
	{
		$query = $this->db->query("select t1.*,t2.*,t3.*,t4.subject_list from exam_form t1 inner join exam_form_back t2 on t1.id=t2.ref_id inner join final_list t3 on t1.ref_no=t3.ref_no inner join subjects t4 on t3.course=t4.course where t2.ref_id='$id'");
		$row = $query->result_array();
		return $row;
	}
	public function Get_data_admit_course($course='',$issue_by='')
	{
		$query = $this->db->query("select t1.*,t2.*,t3.*,t4.subject_list from exam_form t1 inner join exam_form_back t2 on t1.id=t2.ref_id inner join final_list t3 on t1.ref_no=t3.ref_no inner join subjects t4 on t3.course=t4.course where t1.course='$course' and t1.issue_by='$issue_by' limit 50");
		$row = $query->result_array();
		return $row;
	}
	
	public function GetDataJ($select,$table1,$table2,$q1)
	{
		$this->db->select($select);
		$this->db->from($table1);
		$this->db->join($table2, $q1);
		//$this->db->order_by("school_code", "asc");
		$this->db->limit(20);  
		$query = $this->db->get();
		$row = $query->result_array();
		return $row;
	}
	
	public function GetDataJ2($select,$table1,$table2,$q1,$col_name='',$id='',$col_name2='',$id2='',$col_name3='',$id3='',$col_name4='',$id4='')
	{
		$this->db->select($select);
		$this->db->from($table1);
		$this->db->join($table2, $q1);
		if($col_name != '')
		{
			$this->db->where($col_name,$id);
		}
		if($col_name2 != '')
		{
			$this->db->where($col_name2,$id2);
		}
		if($col_name3 != '')
		{
			$this->db->where($col_name3,$id3);
			$this->db->or_where($col_name4,$id4);
		}
		$query = $this->db->get();
		$row = $query->result_array();
		return $row;
	}
	public function GetDataBoth($table,$col_name='',$id='',$id2='')
	{
		$this->db->select('*');
		$this->db->from($table);
		if($col_name != '')
		{
			$this->db->where($col_name,$id);
			$this->db->or_where($col_name,$id2);
		}
		$query = $this->db->get();
		$row = $query->result_array();
		return $row;
	}
	public function GetDataBlock($select,$table,$col_name='',$id='')
	{
		$this->db->select($select);
		$this->db->from($table);
		if($col_name != '')
		{
			$this->db->where($col_name,$id);
		}
		$query = $this->db->get();
		$row = $query->result_array();
		//print_r($row);
		return $row;
	}
	public function GetDataAppr($select,$table,$col_name='',$id='')
	{
		$this->db->select($select);
		$this->db->from($table);
		if($col_name != '')
		{
			$this->db->where_in($col_name,$id);
		}
		$query = $this->db->get();
		$row = $query->result_array();
		print_r($row);
		return $row;
	}
	public function GetDataAppr2($select,$table,$col_name='',$id='')
	{
		$this->db->select($select);
		$this->db->from('tbl_notification');
		$this->db->join('common_table', 'tbl_notification.com_tbl_id=common_table.id');
		$this->db->join('table_name', 'common_table.tbl_name_id=table_name.id');
		if($col_name != '')
		{
			$this->db->where_in($col_name,$id);
		}
		$query = $this->db->get();
		$row = $query->result_array();
		//print_r($row[0]['ref_name']);--working
		//echo $row[0]['ref_name'];--working
		return $row;
	}
	public function GetDataJoin($table2,$q2,$col_name='',$id='')
	{
		$this->db->select('*');
		$this->db->from('common_table');
		$this->db->join($table2, 'common_table.id='.$q2);
		if($col_name != '')
		{
			$this->db->where_in($col_name, $id);
		}
		$this->db->where('common_table.status', 1);
		//$this->db->order_by('common_table.id', 'DESC');
		$query = $this->db->get();
		$row = $query->result_array();
		return $row;
	}
	public function GetDataJoinSearch($table2,$q2,$col_name='',$id='')
	{
		$this->db->select('*');
		$this->db->from('common_table');
		$this->db->join($table2, 'common_table.id='.$q2);
		if($col_name != '')
		{
			$this->db->where_in($col_name, $id);
		}
		//$this->db->where('common_table.status', 1);
		$this->db->order_by('common_table.id', 'DESC');
		$query = $this->db->get();
		$row = $query->result_array();
		return $row;
	}
	public function GetDataJoinView($table2,$q2,$col_name='',$id='')
	{
		$this->db->select('*');
		$this->db->from('common_table');
		$this->db->join($table2, 'common_table.id='.$q2);
		if($col_name != '')
		{
			$this->db->where_in($col_name, $id);
		}
		//$this->db->where('common_table.status', 1);
		//$this->db->order_by('common_table.id', 'DESC');
		$query = $this->db->get();
		$row = $query->result_array();
		return $row;
	}
	public function MatchData($table,$col_name='',$com_tbl_id='')
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($col_name,$com_tbl_id);
		$query = $this->db->get();
		$row =  $query->result_array();
		return $row;	
	}
	public function GetDataJoin3($select,$table1,$table2,$q1,$q2,$table3='',$q3='',$q4='')
	{
		$this->db->select($select);
		$this->db->from($table1);
		$this->db->join($table2, $q1.$q2);
		if($table3 != '')
		{
			$this->db->join($table3, $q3.$q4);
		}
		//if($_SESSION['role']=='district'){
			$where_column = 't1.status';
			$this->db->where($where_column, 1);
		//}
		$query = $this->db->get();
		$row = $query->result_array();
		//print_r($row);
		return $row;
	}
	public function GetCoordinates($id='')
	{
		$this->db->select('tbl_coordinates.*');
		$this->db->from('common_table');
		$this->db->join('tbl_coordinates', 'common_table.id=tbl_coordinates.com_tbl_id');
		$this->db->where('common_table.id',$id);
		$query = $this->db->get();
		$row = $query->result_array();
		return $row;
	}
	public function GetDataLimit($table)
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->order_by('id','desc');
		$this->db->limit('1');
		$query = $this->db->get();
		$row = $query->result_array();
		return $row;
	}
	public function Update($table,$data,$id,$where_col)
	{
		$this->db->where($where_col, $id);
		$this->db->update($table, $data);
		$insert_id = $this->db->affected_rows();		
		return $insert_id;
	}
	public function UpdateExamForm($id,$table,$data,$table2,$data2)
	{
		$this->db->where('id', $id);
		$this->db->update($table, $data);
		$this->db->where('ref_id', $id);
		$this->db->update($table2, $data2);
		$insert_id = $this->db->affected_rows();		
		return $insert_id;
	}
	public function Update_Notification_Data($table,$data,$id)
	{
		$this->db->where('id',$id);
		$this->db->update($table,$data);
		return true;
	}
	public function UpdateNotif($table,$data,$id)
	{
		$this->db->where('id', $id);
		$this->db->update($table, $data);
		$insert_id = $this->db->affected_rows();
		return $insert_id;
	}
	public function delete_row($table,$col_name,$id)
	{
		$this->db->where($col_name, $id);
		$this->db->delete($table);
		return true;
	}
	public function DeletePic($table,$col_name='',$id='')
	{
		$this->load->helper("file");
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($col_name,$id);
		$query = $this->db->get();
		foreach ($query->result() as $row)
		{
        	echo $path =  base_url(); echo $row->img1;
		}
		if(delete_files($path)) 
		{
		     echo 'deleted successfully';
		}
		else 
		{
		     echo 'errors occured';
		}
	}
	public function GetNames($table1,$table2,$q1,$q2,$table3='',$q3='',$q4='',$district_id='',$block_id='',$panchayat_id=''){
		$this->db->select('*');
		$this->db->from($table1);
		$this->db->join($table2, $q1.$q2);
		if($table3 != '')
		{
			$this->db->join($table3, $q3.$q4);
		}
		if($district_id!=''){
			//$where = '(t1.district_id=$district_id)';
       		$this->db->where('t1.district_id',$district_id);
		}
		if($block_id!=''){
			//$where = '(t1.district_id=$district_id)';
       		$this->db->where('t1.block_id',$block_id);
       		$this->db->where('t1.district_id',$district_id);	
		}
		if($panchayat_id!=''){
			//$where = '(t1.district_id=$district_id)';
       		$this->db->where('t1.id',$panchayat_id);
       		$this->db->where('t1.district_id',$district_id);
       		$this->db->where('t1.block_id',$block_id);
		}
		$this->db->order_by('t1.id','desc');
		$this->db->limit('1');
		$query = $this->db->get();
		$row = $query->result_array();
		//print_r($row);
		//die;
		return $row;
	}
	public function GetNamesForView($com_tbl_id){
		$this->db->select('tpl.*,td.district,tb.block,tp.panchayat');
		$this->db->from('tbl_panchayat_level tpl');
		$this->db->join('tbl_district td', 'tpl.district_id=td.id');
		$this->db->join('tbl_block tb', 'tpl.block_id=tb.id');
		$this->db->join('tbl_panchayat tp', 'tpl.panchayat_id=tp.id');
		$this->db->where('tpl.com_tbl_id',$com_tbl_id);
		$query = $this->db->get();
		$row = $query->result_array();
		return $row;
	}
	public function GetDistrictId($dist_name){
		$this->db->select('tpl.*,td.district');
		$this->db->from('tbl_panchayat_level tpl');
		$this->db->join('tbl_district td', 'tpl.district_id=td.id');
		$this->db->where('td.district',$dist_name);
		$query = $this->db->get();
		$row = $query->result_array();
		return $row;
	}
	public function GetRow($keyword,$col_name='',$table='') {        
        //$this->db->order_by('id', 'DESC');
        $this->db->select($col_name);
        $this->db->distinct();
        $this->db->like($col_name, $keyword);
        return $this->db->get($table)->result_array();
    }
	public function GetRowSecond($keyword,$col_name='',$table='',$main_crop='') {        
        $this->db->select($col_name);
        $this->db->distinct();
        $this->db->like($col_name, $keyword);
        $this->db->where('scn_name', $main_crop);
        $this->db->order_by('id', 'DESC');
        return $this->db->get($table)->result_array();
    }
}
?>