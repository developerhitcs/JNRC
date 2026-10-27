<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();			
		$this->load->database();
		$this->load->library('session');		
		$this->load->helper(array('form','url','cookie'));
		$this->load->library('form_validation');
		$this->load->model('Admin_model');
	}
	public function index()
	{
		$_SESSION['role_admin'];		
		if($_SESSION['role_admin']=='admin')
		{
			
			$current_date=date('d/m/Y');
			
			$session = $this->Admin_model->Get_Affected_Details('batch_session_tb');
			$id=$session[0]['id'];
			$batch_session=$session[0]['current_session'];
			$form_close=$session[0]['form_close'];					
			if($current_date==$form_close)	
			{
				$data = array('status' =>'Expired');	
				$this->Admin_model->Update_Status_Data('batch_session_tb',$data,'id',$id);
			}
			
			$form_open=$session[0]['form_open'];	
			if($current_date==$form_open)	
			{
				$data = array('status' =>'Active');	
				$this->Admin_model->Update_Status_Data('batch_session_tb',$data,'id',$id);
			}
			
			$data['college_list'] = $this->Admin_model->Get_Affected_Details('college_list');
			foreach($data['college_list'] as $cl)
			{
				if($cl['renewal_expiry_date']==$current_date)
				{
					$id=$cl['id'];
					$data = array('renewal_status' =>'Expired');	
					$this->Admin_model->Update_Status_Data('college_list',$data,'id',$id);
				}
			}
			
			$data['title'] = "Dashboard";			
			$anm_new= $this->Admin_model->Count_Institution_Data('college_list','course_type','ANM');
			$data['anm']=$this->db->affected_rows($anm_new);	
			
			$gnm_new = $this->Admin_model->Count_Institution_Data('college_list','course_type','GNM');
			$data['gnm']=$this->db->affected_rows($gnm_new);	
			
			$basic_bsc = $this->Admin_model->Count_Institution_Data('college_list','course_type','BSC');
			$data['bsc']=$this->db->affected_rows($basic_bsc);
			
			$post_basic_bsc = $this->Admin_model->Count_Institution_Data('college_list','course_type','PBSC');
			$data['pbsc']=$this->db->affected_rows($post_basic_bsc);
			
			$msc = $this->Admin_model->Count_Institution_Data('college_list','course_type','MSC');
			$data['msc']=$this->db->affected_rows($msc);
			
			$renewal = $this->Admin_model->Count_Institution_Data('renewal','','');
			$data['renewal']=$this->db->affected_rows($renewal);
			
			
			
// 			$exam_form = $this->Admin_model->Count_Institution_Data('exam_form_tb','batch_session',$batch_session);
// 			$data['exam_form']=$this->db->affected_rows($exam_form);

$exam_form = $this->Admin_model->Count_Institution_Data(
    'exam_form_tb',
    'batch_session',
    $batch_session,
    true
);

$data['exam_form'] = count($exam_form);
			
			$this->load->view('admin/include/header',$data);
			$this->load->view('admin/include/sidebar');
			$this->load->view('admin/dashboard');
			$this->load->view('admin/include/footer');
		}
		else
		{
			$_SESSION['role_admin']='';
			redirect('adminjnrc','refresh');
		}
	}
	public function keep_backup()
	{
		if($_SESSION['role_admin']=='admin')
		{
			date_default_timezone_set('Asia/Kolkata');
			$var = date("Y-m-d");
			$date = str_replace('/', '-', $var);
			$new_date = date('d_m_Y', strtotime($date));
			$fileName='db_backup_'.$new_date.'.zip';
			$this->load->dbutil();   
			$backup =& $this->dbutil->backup();  
			$this->load->helper('file');
			write_file('uploads/db_backup/'.$fileName, $backup); 
			$this->load->helper('download');
			force_download($fileName, $backup);
		}
		else
		{
			$_SESSION['role_admin']='';
			redirect('login_page','refresh');
		}	
	}
	public function omprakash_testing()
	{
		$data['title'] = "Manage SQL";
		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/manage_sql');
		$this->load->view('admin/include/footer');
	}
	public function om_run_query()
	{
		$data['title'] = "Manage SQL";
		$SQL = $this->input->post('query_text');
		$query = $this->db->query($SQL);
		$data['result'] = $query->result_array();
		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/manage_sql');
		$this->load->view('admin/include/footer');
	}
	
	public function admin_batch_session()
	{
		if($_SESSION['role_admin']=='admin')
		{
			$data['title'] = "Manage Batch Session";
			$data['row'] = $this->Admin_model->GetData('batch_session_tb','','');
			$this->load->view('admin/include/header',$data);
			$this->load->view('admin/include/sidebar');
			$this->load->view('admin/batch_session');
			$this->load->view('admin/include/footer');
		}
		else
		{
			$_SESSION['role_admin']='';
			redirect('adminjnrc','refresh');
		} 
	}
	public function update_batch_session()
	{
		if($_SESSION['role_admin']=='admin')
		{
			$id = $this->input->post('edit_id');			
			$data = array(
				'current_session' => $this->input->post('session'),
				'form_open' => $this->input->post('open_date'),
				'form_close' => $this->input->post('close_date'),
				'status' => $this->input->post('status')
			);			
			$check_update = $this->Admin_model->Update_Notification_Data('batch_session_tb',$data,$id);
			if($check_update==true)		
			{
				$_SESSION['msg']="success";
				$_SESSION['errmsg']="Batch Session Update Successfully...";
				redirect($_SERVER['HTTP_REFERER']);
			}
			else
			{
				$_SESSION['msg']="danger";
				$_SESSION['errmsg']="Batch Session  Update Failed. Due To Internal Server Error";
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
		else
		{
			$_SESSION['role_admin']='';
			redirect('adminjnrc','refresh');
		} 
		
	}
	
	public function generate_rollno_session()
	{
		if($_SESSION['role_admin']=='admin')
		{
			$session = $this->input->post('session');
			
			//change every year
			if($session == "October 2022"){
			    $admitCardRollSequence = '22/Oct';
			}
			if($session == "April 2023"){
			    $admitCardRollSequence = '23/Apr';
			}
			if($session == "October 2023"){
			    $admitCardRollSequence = '23/Oct';
			}
			if($session == "April 2024"){
			    $admitCardRollSequence = '24/Apr';
			}
			if($session == "October 2024"){
			    $admitCardRollSequence = '24/Oct';
			}
			if($session == "April 2025"){
                $admitCardRollSequence = '25/Apr';
            }

            if($session == "October 2025"){
                $admitCardRollSequence = '25/Oct';
            }
                        if($session == "April 2026"){
                $admitCardRollSequence = '26/Apr';
            }
            
            if($session == "October 2026"){
                $admitCardRollSequence = '26/Oct';
            }

			
			
			// 1st Year ANM Roll Number......
			$course = '1st Year ANM';
			$data['row'] = $this->Admin_model->Get_exam_data('exam_form_tb',$session,$course);   
			$i=1;
			foreach($data['row'] as $key)
			{
				$id=$key['id'];
				$course='ANM1';	
				$roll=$admitCardRollSequence.'/'.$key['issue_by'].'/'.$course.'/'.$i;				
				$data = array('roll_id'=> $i,'admit_card_roll_no' =>$roll);
				$check_update = $this->Admin_model->Update_Roll_Number_Data('exam_form_tb',$data,$id,$session);   
				$i++;
			}
			
			// 2nd Year ANM Roll Number......
			$course = '2nd Year ANM';
			$data['row'] = $this->Admin_model->Get_exam_data('exam_form_tb',$session,$course);
			$i=1;
			foreach($data['row'] as $key)
			{
				$id=$key['id'];
				$course='ANM2';	
				$roll=$key['issue_by'].'/'.$course.'/'.$i;				
				$data = array('roll_id'=> $i,'admit_card_roll_no' =>$roll);
				$check_update = $this->Admin_model->Update_Roll_Number_Data('exam_form_tb',$data,$id,$session);
				$i++;
			}
			
			// 1st Year GNM Roll Number......
			$course = '1st Year GNM';
			$data['row'] = $this->Admin_model->Get_exam_data('exam_form_tb',$session,$course);
			$i=1;
			foreach($data['row'] as $key)
			{
				$id=$key['id'];
				$course='GNM1';	
				$roll=$admitCardRollSequence.'/'.$key['issue_by'].'/'.$course.'/'.$i;				
				$data = array('roll_id'=> $i,'admit_card_roll_no' =>$roll);
				$check_update = $this->Admin_model->Update_Roll_Number_Data('exam_form_tb',$data,$id,$session);
				$i++;
			}
			
			// 2nd Year GNM Roll Number......
			$course = '2nd Year GNM';
			$data['row'] = $this->Admin_model->Get_exam_data('exam_form_tb',$session,$course);
			$i=1;
			foreach($data['row'] as $key)
			{
				$id=$key['id'];
				$course='GNM2';	
				$roll=$key['issue_by'].'/'.$course.'/'.$i;				
				$data = array('roll_id'=> $i,'admit_card_roll_no' =>$roll);
				$check_update = $this->Admin_model->Update_Roll_Number_Data('exam_form_tb',$data,$id,$session);
				$i++;
			}
			
			// 3rd Year GNM Roll Number......
			$course = '3rd Year GNM';
			$data['row'] = $this->Admin_model->Get_exam_data('exam_form_tb',$session,$course);
			$i=1;
			foreach($data['row'] as $key)
			{
				$id=$key['id'];
				$course='GNM3';	
				$roll=$key['issue_by'].'/'.$course.'/'.$i;				
				$data = array('roll_id'=> $i,'admit_card_roll_no' =>$roll);
				$check_update = $this->Admin_model->Update_Roll_Number_Data('exam_form_tb',$data,$id,$session);
				$i++;
			}
			
			if($check_update==true)		
			{
				$_SESSION['msg']="success";
				$_SESSION['errmsg']="Roll No Generate Successfully...";
				redirect($_SERVER['HTTP_REFERER']);
			}
			else
			{
				$_SESSION['msg']="danger";
				$_SESSION['errmsg']="Roll No Generate  Failed. Due To Internal Server Error";
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
		else
		{
			$_SESSION['role_admin']='';
			redirect('adminjnrc','refresh');
		} 
		
	}
	
	public function view_roll_no()
	{
		if($_SESSION['role_admin']=='admin')
		{	
			$session = $this->Admin_model->Get_Affected_Details('batch_session_tb');
			$batch_session=$session[0]['current_session'];
			$data['anm1'] = $this->Admin_model->Get_exam_data('exam_form_tb',$batch_session,'1st Year ANM');
			$data['anm2'] = $this->Admin_model->Get_exam_data('exam_form_tb',$batch_session,'2nd Year ANM');
			$data['gnm1'] = $this->Admin_model->Get_exam_data('exam_form_tb',$batch_session,'1st Year GNM');
			$data['gnm2'] = $this->Admin_model->Get_exam_data('exam_form_tb',$batch_session,'2nd Year GNM');
			$data['gnm3'] = $this->Admin_model->Get_exam_data('exam_form_tb',$batch_session,'3rd Year GNM');
			$data['title'] = "Admit Card Roll Number";					
			$this->load->view('admin/include/header',$data);
			$this->load->view('admin/include/sidebar');
			$this->load->view('admin/view_roll_no');
			$this->load->view('admin/include/footer');
		}
		else
		{
			$_SESSION['role_admin']='';
			redirect('adminjnrc','refresh');
		} 
	}
	
	public function admin_view_exam_form()
	{
		if($_SESSION['role_admin']=='admin')
		{	
			$session = $this->Admin_model->Get_Affected_Details('batch_session_tb');
			$batch_session=$session[0]['current_session'];
			
			$session = $this->input->post('session');
			$course_type = $this->input->post('course_type');
			$school_code = $this->input->post('school_code');
			$limit = $this->input->post('limit');
			if($this->input->post('submit')=='Search')
			{								
				$data['row'] = $this->Admin_model->GetData3($session,$course_type,$school_code);	
				$data['batch_session_year']=$this->Admin_model->Get_distinct_institution_details('exam_form_tb','batch_session');				
				$data['code'] = $this->Admin_model->GetDistinct('exam_form_tb','issue_by',$batch_session);
				$data['title'] = "Examination Form Search Results";	
				$data['card_title'] = "By School Code ".$school_code." And  Course ".$course_type."";
			}
			elseif($this->input->post('submit')=='Get_Admit_Card') 
			{
				$this->session->set_userdata(array(
					'session' 	=> 	$session,
					'course_type' 	=> 	$course_type,
					'school_code'	=>	$school_code,
					'limit'	=>	$limit,
					 'center_id'     => $this->input->post('center_id')  // ✅ Add this line
				));	
				redirect(base_url('get_admit_course'));				
			}
			else
			{
				$data['row'] = $this->Admin_model->GetDataLast50('exam_form_tb');
				$data['batch_session_year']=$this->Admin_model->Get_distinct_institution_details('exam_form_tb','batch_session');
				$data['code'] = $this->Admin_model->GetDistinct('exam_form_tb','issue_by',$batch_session);
				$data['title'] = "Examination Form  Lists";					
				$data['card_title'] = "Last 100 Form Detail";					
			}
			
			$data['centers'] = $this->db->get('center_tb')->result();
			
			
			$this->load->view('admin/include/header',$data);
			$this->load->view('admin/include/sidebar');
			$this->load->view('admin/admin_exam_form');
			$this->load->view('admin/include/footer');
		}
		else
		{
			$_SESSION['role_admin']='';
			redirect('adminjnrc','refresh');
		} 
	}


	public function create_table_session()
	{
		if($_SESSION['role_admin']=='admin')
		{			
			$session = $this->Admin_model->Get_Affected_Details('exam_form_tb');
			$batch_session=$session[0]['batch_session'];			
			$current_session = $this->input->post('session');
			if($batch_session==$current_session)
			{
				$_SESSION['msg']="danger";
				$_SESSION['errmsg']="The Batch Session Already Exists....";
				redirect($_SERVER['HTTP_REFERER']);
			}
			else
			{
				date_default_timezone_set('Asia/Kolkata');
				$date = date('d_m_Y_h_i_s');		
				$backup_old_folder='exam_form_backup_'.$date;				
				rename("/home/zsqrtzxp/public_html/uploads/exam_form","/home/zsqrtzxp/public_html/uploads/".$backup_old_folder."");
				mkdir("/home/zsqrtzxp/public_html/uploads/exam_form"); 
				$data= $this->Admin_model->Create_Batch_Session_Table();
				if($data==true)
				{				
					$_SESSION['msg']="success";
					$_SESSION['errmsg']="New Batch Session Table Creted Successfully...";
					redirect($_SERVER['HTTP_REFERER']);
				}
				else
				{
					$_SESSION['msg']="danger";
					$_SESSION['errmsg']="New Batch Session Table Creted Failed. Due To Internal Server Error";
					redirect($_SERVER['HTTP_REFERER']);
				}
			}
		}
		else
		{
			$_SESSION['role_admin']='';
			redirect('adminjnrc','refresh');
		} 
	}
	public function fetch_session()
    {
    	$session = $this->input->post('session');
    	$data = $this->Admin_model->Get_distinct_code_details('exam_form_tb','issue_by','batch_session',$session);
		echo "<option value=''>Choose School Code</option>";
		foreach($data as $val)
		{
			?>
<option value="<?php echo $val['issue_by'];?>"><?php echo $val['issue_by'];?></option>
<?php
		}
    }
	
	public function fetch_course()
    {
    	$school_code = $this->input->post('school_code');
		$data = $this->Admin_model->GetDataSelected('course_type','college_list','school_code',$school_code);
		echo "<option value=''>Choose Batch Year</option>";
		foreach($data as $value)
		{
			if($value['course_type']=='ANM')
			{
				echo '<option value="1st Year ANM">1st Year ANM</option>';
				echo '<option value="2nd Year ANM">2nd Year ANM</option>';				
			}
			elseif ($value['course_type']=='GNM') 
			{
				echo '<option value="1st Year GNM">1st Year GNM</option>';
				echo '<option value="2nd Year GNM">2nd Year GNM</option>';
				echo '<option value="3rd Year GNM">3rd Year GNM</option>';
			}
		}
    }
	
	
	
//   public function get_admit_course()
// {
// 	if ($_SESSION['role_admin'] == 'admin') {
// 		$session    = $this->session->userdata('session');
// 		$course     = $this->session->userdata('course_type');
// 		$issue_by   = $this->session->userdata('school_code');
// 		$limit      = $this->session->userdata('limit');
// 		$center_id  = $this->session->userdata('center_id');

// 		// Get center name
// 		$center_query = $this->db->get_where('center_tb', ['id' => $center_id])->row();
// 		$data['selected_center_name'] = $center_query ? $center_query->name_center : '';

// 		// Get admit card data
// 		$data['row'] = $this->Admin_model->Get_data_admit_course($session, $course, $issue_by, $limit);

// 		// Get subject list from updated subject details table
// 		$this->db->where('course', $course);
// 		$this->db->order_by('exam_date', 'ASC');
// 		$data['subject_row'] = $this->db->get('subjects_details_tb')->result_array();

// 		// Generate PDF
// 		$this->load->library('pdf');
// 		$this->load->view('admin/admit_card_pdf_course', $data);
// 		$html = $this->output->get_output();

// 		$this->dompdf->load_html($html);
// 		$this->dompdf->render();
// 		$this->dompdf->stream($issue_by . "_admit_card_form.pdf", array("Attachment" => false));
// 	} else {
// 		$_SESSION['role_admin'] = '';
// 		redirect('adminjnrc', 'refresh');
// 	}
// }

public function get_admit_course()
{
    if ($this->session->userdata('role_admin') !== 'admin') {
        redirect('adminjnrc', 'refresh');
        return;
    }

    ini_set('memory_limit', '256M');
    set_time_limit(120);

    $session = $this->session->userdata('session');
    $course = $this->session->userdata('course_type');
    $issue_by = $this->session->userdata('school_code');
    $limit = $this->session->userdata('limit');
    $center_id = $this->session->userdata('center_id');

    $valid_limits = array(
        'limit 30', 'limit 30,60', 'limit 60,90', 'limit 90,120',
        'limit 120,150', 'limit 150,180', 'limit 180,210', 'limit 210,240'
    );
    if (
        !is_string($session) || $session === ''
        || !is_string($course) || $course === ''
        || !is_string($issue_by) || $issue_by === ''
        || !in_array($limit, $valid_limits, TRUE)
        || !is_numeric($center_id) || (int) $center_id < 1
    ) {
        show_error('Select a session, institution, course, print range, and exam center before generating admit cards.', 400);
        return;
    }

    $center = $this->db
        ->select('name_center')
        ->where('id', (int) $center_id)
        ->get('center_tb')
        ->row_array();
    if (!$center) {
        show_error('The selected exam center no longer exists. Return to the exam form list and select a valid center.', 400);
        return;
    }

    $data['selected_center_name'] = $center['name_center'];
    $data['row'] = $this->Admin_model->Get_data_admit_course($session, $course, $issue_by, $limit);
    if (empty($data['row'])) {
        show_error('No exam forms were found for the selected filters and print range.', 404);
        return;
    }

    $this->db
        ->where('course', $course)
        ->order_by('exam_date', 'ASC');
    $data['subject_row'] = $this->db->get('subjects_details_tb')->result_array();

    $this->load->library('pdf');
    $html = $this->load->view('admin/admit_card_pdf_course', $data, TRUE);
    if (!is_string($html) || trim($html) === '') {
        show_error('The admit-card layout could not be rendered.', 500);
        return;
    }

    $this->dompdf->load_html($html);
    $this->dompdf->set_paper('A4', 'portrait');
    $this->dompdf->render();
    $filename = preg_replace('/[^A-Za-z0-9._-]/', '_', $issue_by) . '_admit_card_form.pdf';
    $this->dompdf->stream($filename, array('Attachment' => FALSE));
}

// public function get_admit_course()
// {
//     if ($_SESSION['role_admin'] == 'admin') {

//         $session   = $this->session->userdata('session');
//         $course    = $this->session->userdata('course_type');
//         $issue_by  = $this->session->userdata('school_code');
//         $limit     = $this->session->userdata('limit');
//         $center_id = $this->session->userdata('center_id');

//         // Get center name
//         $center_query = $this->db->get_where(
//             'center_tb',
//             ['id' => $center_id]
//         )->row();

//         $data['selected_center_name'] = $center_query
//             ? $center_query->name_center
//             : '';

//         // Get admit card data
//         $data['row'] = $this->Admin_model->Get_data_admit_course(
//             $session,
//             $course,
//             $issue_by,
//             $limit
//         ); 
          
  
  
//         // Get subject list 
//         $this->db->where('course', $course);
//         $this->db->order_by('exam_date', 'ASC');

//         $data['subject_row'] = $this->db
//             ->get('subjects_details_tb')
//             ->result_array();

//         // Generate PDF
//         $this->load->library('pdf');

//         $this->load->view(
//             'admin/admit_card_pdf_course',
//             $data
//         );

//         $html = $this->output->get_output();

//         $this->dompdf->load_html($html);
//         $this->dompdf->render();

//         $this->dompdf->stream(
//             $issue_by . "_admit_card_form.pdf",
//             array("Attachment" => false)
//         );

//     } else {

//         $_SESSION['role_admin'] = '';

//         redirect('adminjnrc', 'refresh');
//     }
// }
	
    public function edit_admin_exam_form()
    {
    	if($_SESSION['role_admin']=='admin')
		{
			date_default_timezone_set('Asia/Kolkata');
			$ref_id = $this->input->post('edit_ref_id');
			$remarks = $this->input->post('edit_remarks');
			$ip = $_SERVER['REMOTE_ADDR'];
			$data = array(
			'remarks'=>$remarks,	
			'emodified'=> date("Y-m-d  h:i:s A"),
    		'eip'=> $ip
    		);
	    	$check_update = $this->Admin_model->Update('exam_form_tb',$data,$ref_id,'id');
	    	if($check_update==true)		
			{
				$_SESSION['msg']="success";
				$_SESSION['errmsg']="Remarks Update Successfully...";
				redirect($_SERVER['HTTP_REFERER']);
			}
			else
			{
				$_SESSION['msg']="danger";
				$_SESSION['errmsg']="Remarks Update Failed. Due To Internal Server Error";
				redirect($_SERVER['HTTP_REFERER']);
			}	
		}
		else
		{
			$_SESSION['role_admin']='';
			redirect('adminjnrc','refresh');
		}
    }
    public function admin_view_exam_detail($id)
    {
    	if($_SESSION['role_admin']=='admin')
		{
			$data['title'] = "Exam Form Detail";
			$data['row'] = $this->Admin_model->Get_data_exam($id);
			$this->load->view('admin/include/header',$data);
			$this->load->view('admin/include/sidebar');
			$this->load->view('admin/admin_view_exam_detail');
			$this->load->view('admin/include/footer');
		}
		else
		{
			$_SESSION['role_admin']='';
			redirect('adminjnrc','refresh');
		}
    }
	public function admin_edit_exam_detail($id)
    {
    	if($_SESSION['role_admin']=='admin')
		{
			$data['title'] = "Exam Form Detail";
			$data['row'] = $this->Admin_model->Get_data_exam($id);
			$this->load->view('admin/include/header',$data);
			$this->load->view('admin/include/sidebar');
			$this->load->view('admin/admin_edit_exam_detail');
			$this->load->view('admin/include/footer');
		}
		else
		{
			$_SESSION['role_admin']='';
			redirect('adminjnrc','refresh');
		}
    }
	
	public function admin_final_update_exam_form()
	{
		if($_SESSION['role_admin']=='admin')
		{
			$aadhar=$this->input->post('aadhar');
			$anm_new= $this->Admin_model->count_aadhar($aadhar);
			$data_count=$this->db->affected_rows($anm_new);
// 			if($data_count > 1)
// 			{
// 				$_SESSION['msg']="warning";
// 				$_SESSION['errmsg']="Aadhar Card Number Already Exists.";
// 				redirect($_SERVER['HTTP_REFERER']);
// 			}
// 			else
// 			{
				date_default_timezone_set('Asia/Kolkata');
				$session = $this->Admin_model->Get_Affected_Details('batch_session_tb');
				$batch_session=$session[0]['current_session'];			
				
				// details update by this id & Value 
				$id =$this->input->post('update_id');
				
				$session = $this->Admin_model->Get_Ref_Affected_Details('exam_form_tb',$id);
				$ref_no=$session[0]['ref_no'];			
				$config['upload_path'] = 'uploads/exam_form/'.$ref_no; 
				$config['allowed_types'] = 'jpg|png|jpeg|pdf';
				$config['max_size'] = '1024000';
				$this->load->library('upload',$config);
				
				// Candidate Photo
				if (!empty($_FILES['candidate']['name'])) 
				{		
					if($this->upload->do_upload('candidate')==true)
					{
						$data['uploaddata']=$this->upload->data();
						foreach($data as $d)
						{
							$candidate=$d['file_name'];
						}
					}
					else
					{
						$_SESSION['msg']="warning";
						$_SESSION['errmsg']="Image Should Be .JPG , .PNG and .JPEG  Or Image Size 50kb And Passport Size. ";
						redirect($_SERVER['HTTP_REFERER']);
					}
				}
				else
				{
					$candidate=$this->input->post('old_candidate');
				}
				// Candidate Signature
				if (!empty($_FILES['signature']['name'])) 
				{	
					if($this->upload->do_upload('signature')==true)
					{
						$data['uploaddata']=$this->upload->data();
						foreach($data as $d)
						{
							$signature=$d['file_name'];
						}
					}
					else
					{
						$_SESSION['msg']="warning";
						$_SESSION['errmsg']="Image Should Be .JPG , .PNG and .JPEG  Or Image Size 50kb And Passport Size. ";
						redirect($_SERVER['HTTP_REFERER']);
					}
				}
				else
				{
					$signature=$this->input->post('old_signature');
				}
				
				// Matric Verification Report
				if (!empty($_FILES['matric']['name'])) 
				{	
					if($this->upload->do_upload('matric')==true)
					{
						$data['uploaddata']=$this->upload->data();
						foreach($data as $d)
						{
							$matric=$d['file_name'];
						}
					}
					else
					{
						$_SESSION['msg']="warning";
						$_SESSION['errmsg']="Image Should Be .JPG , .PNG and .JPEG  Or Image Size 50kb And Passport Size. ";
						redirect($_SERVER['HTTP_REFERER']);
					}
				}
				else
				{
					$matric=$this->input->post('old_matric');
				}
				// Inter Verification Report
				if (!empty($_FILES['inter']['name'])) 
				{	
					if($this->upload->do_upload('inter')==true)
					{
						$data['uploaddata']=$this->upload->data();
						foreach($data as $d)
						{
							$inter=$d['file_name'];
						}
					}
					else
					{
						$_SESSION['msg']="warning";
						$_SESSION['errmsg']="Image Should Be .JPG , .PNG and .JPEG  Or Image Size 50kb And Passport Size. ";
						redirect($_SERVER['HTTP_REFERER']);
					}
				}
				else
				{
					$inter=$this->input->post('old_inter');
				}
				
				$input_data=array(
				'name'			=> $this->input->post('name'),
				'father_name'	=> $this->input->post('father_name'),
				'mother_name'	=> $this->input->post('mother_name'),
				'dob'			=> $this->input->post('dob'),
				'age'			=> $this->input->post('age'),
				'aadhar'		=> $this->input->post('aadhar'),
				'marital'		=> $this->input->post('marital'),
				'nationality'	=> $this->input->post('nationality'),
				'perm_address'	=> $this->input->post('perm_address'),
				'medium_exam'	=> $this->input->post('medium_exam'),
				'cmlrank'	=> $this->input->post('cmlrank'),

				'board_1'		=> $this->input->post('board_1'),  
				'year_1'		=> $this->input->post('year_1'), 
				'roll_1'		=> $this->input->post('roll_1'),
				'marks_1'		=> $this->input->post('marks_1'),
				'school_1'		=> $this->input->post('school_1'),
				
				'board_2'		=> $this->input->post('board_2'),
				'year_2'		=> $this->input->post('year_2'),
				'roll_2'		=> $this->input->post('roll_2'),
				'marks_2'		=> $this->input->post('marks_2'),
				'school_2'		=> $this->input->post('school_2'),

				'board_3'		=> $this->input->post('board_3'),
				'year_3'		=> $this->input->post('year_3'),
				'roll_3'		=> $this->input->post('roll_3'),
				'marks_3'		=> $this->input->post('marks_3'),
				'school_3'		=> $this->input->post('school_3'),

				'board_4'		=> $this->input->post('board_4'),
				'year_4'		=> $this->input->post('year_4'),
				'roll_4'		=> $this->input->post('roll_4'),
				'marks_4'		=> $this->input->post('marks_4'),
				'school_4'		=> $this->input->post('school_4'),

				'sub_1'		=> $this->input->post('sub_1'),
				'sub_2'		=> $this->input->post('sub_2'),
				'sub_3'		=> $this->input->post('sub_3'),
				'sub_4'		=> $this->input->post('sub_4'),
				'sub_5'		=> $this->input->post('sub_5'),
				'sub_6'		=> $this->input->post('sub_6'),
				'sub_7'		=> $this->input->post('sub_7'),
				'sub_8'		=> $this->input->post('sub_8'),
									
				'resitter_status'	=> $this->input->post('resitter_status'),
				'no_times'			=> $this->input->post('no_times'),
				'rmonth1'			=> $this->input->post('rmonth1'),
				'ryear1'			=> $this->input->post('ryear1'),
				'rtrainschool'		=> $this->input->post('rtrainschool'),
				'rroll1'			=> $this->input->post('rroll1'),
				'rno1'				=> $this->input->post('rno1'),
				'ryear2'			=> $this->input->post('ryear2'),
				'rcourse'			=> $this->input->post('rcourse'),
				'rcouncil'			=> $this->input->post('rcouncil'),
				'rmonth2'			=> $this->input->post('rmonth2'),
				'rroll2'			=> $this->input->post('rroll2'),
				'rno2'				=> $this->input->post('rno2'),
				'rlang'				=> $this->input->post('rlang'),
				
				'ename'		=> $this->input->post('ename'),
				'emonth1'	=> $this->input->post('emonth1'),
				'eyear1'	=> $this->input->post('eyear1'),
				'econduct'	=> $this->input->post('econduct'),
				'edoj1'		=> $this->input->post('edoj1'),
				'edoj2'		=> $this->input->post('edoj2'),
				'edoj3'		=> $this->input->post('edoj3'),
				'eleave1'	=> $this->input->post('eleave1'),
				'eleave2'	=> $this->input->post('eleave2'),
				'eleave3'	=> $this->input->post('eleave3'),
				'eyear2'	=> $this->input->post('eyear2'),
				'emonth2'	=> $this->input->post('emonth2'),
				'eday'		=> $this->input->post('eday'),

				'lsub_1'	=> $this->input->post('lsub_1'),
				'ldel_1'	=> $this->input->post('ldel_1'),
				'latt_1'	=> $this->input->post('latt_1'),
				'lper_1'	=> $this->input->post('lper_1'),

				'lsub_2'	=> $this->input->post('lsub_2'),
				'ldel_2'	=> $this->input->post('ldel_2'),
				'latt_2'	=> $this->input->post('latt_2'),
				'lper_2'	=> $this->input->post('lper_2'),

				'lsub_3'	=> $this->input->post('lsub_3'),
				'ldel_3'	=> $this->input->post('ldel_3'),
				'latt_3'	=> $this->input->post('latt_3'),
				'lper_3'	=> $this->input->post('lper_3'),

				'lsub_4'	=> $this->input->post('lsub_4'),
				'ldel_4'	=> $this->input->post('ldel_4'),
				'latt_4'	=> $this->input->post('latt_4'),
				'lper_4'	=> $this->input->post('lper_4'),
				
				'lsub_5'	=> $this->input->post('lsub_5'),
				'ldel_5'	=> $this->input->post('ldel_5'),
				'latt_5'	=> $this->input->post('latt_5'),
				'lper_5'	=> $this->input->post('lper_5'),
				
				'lsub_6'	=> $this->input->post('lsub_6'),
				'ldel_6'	=> $this->input->post('ldel_6'),
				'latt_6'	=> $this->input->post('latt_6'),
				'lper_6'	=> $this->input->post('lper_6'),
				
				'lsub_7'	=> $this->input->post('lsub_7'),
				'ldel_7'	=> $this->input->post('ldel_7'),
				'latt_7'	=> $this->input->post('latt_7'),
				'lper_7'	=> $this->input->post('lper_7'),
				
				'date'  	=> date("Y-m-d"),
				'created'	=> date("Y-m-d  h:i:s A"),
				'ip' 		=> $_SERVER['REMOTE_ADDR']
				);
				
				
				$data1 = array_map('ucwords', $input_data);
				// file uploading here...
				$data2=array(
				'img1'		=> $candidate,
				'img2'		=> $signature,
				'file1'		=> $matric,
				'file2'		=> $inter
				);
				$data=array_merge($data1,$data2);	
				
				$check_update = $this->Admin_model->Update_institution_details('exam_form_tb',$data,$id);
				if($check_update==true)
				{
					$_SESSION['msg']="success";
					$_SESSION['errmsg']="Exam Form Final Update Successfully";
					redirect($_SERVER['HTTP_REFERER']);
				}
				else
				{
					$_SESSION['msg']="danger";
					$_SESSION['errmsg']="Exam Form Final Update Failed. Due Internal Server Error...";
					redirect($_SERVER['HTTP_REFERER']);
				}
// 			}
		}
		else
		{
			$_SESSION['role_admin']='';
			redirect('adminjnrc','refresh');
		} 
	}
	
	
	public function resitter_student_details()
	{
		if($_SESSION['role_admin']=='admin')
		{	
			$session = $this->Admin_model->Get_Affected_Details('batch_session_tb');
			$batch_session=$session[0]['current_session'];		
			
			$data['row'] = $this->Admin_model->Get_Resitter_Data('exam_form_tb');
			
			$data['title'] = "Resitter Student Details";					
			$data['card_title'] = "Resitter Student Details";					
						
			$this->load->view('admin/include/header',$data);
			$this->load->view('admin/include/sidebar');
			$this->load->view('admin/resitter-student');
			$this->load->view('admin/include/footer');
		}
		else
		{
			$_SESSION['role_admin']='';
			redirect('adminjnrc','refresh');
		} 
	}
   
	public function get_admit($value)
	{
		$data['row'] = $this->Admin_model->Get_data_admit($value);
		$data['subject_row'] = $this->Admin_model->Get_admit_sub();
		$this->load->library('pdf');
		
		$this->load->view('admin/admit_card_pdf',$data);	  
		$html = $this->output->get_output();
	    $this->dompdf->load_html($html);
	   	$this->dompdf->render();
	   	$ref_no = $data['row'][0]['ref_no'];
		$this->dompdf->stream($ref_no.".pdf", array("Attachment" => false));
		/*, array("Attachment" => false)*/
	}
   
   
	public function upload_result()
	{
		$this->load->library('excel');
		if(isset($_FILES["file"]["name"]))
		{
			$path = $_FILES["file"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			foreach($object->getWorksheetIterator() as $worksheet)
			{
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();
				for($row=1; $row<=$highestRow; $row++)
				{
					$f_name = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
					$l_name = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					$data[]= array(
						'fname'  => $f_name,
						'lname'  => $l_name
					);					
				}
				$check_insert=$this->Admin_model->insert_excel($data);
				if($check_insert==true)		
				{
					$_SESSION['msg']="success";
					$_SESSION['errmsg']="Result Upload Successfully...";
					redirect($_SERVER['HTTP_REFERER']);
				}
				else
				{
					$_SESSION['msg']="danger";
					$_SESSION['errmsg']="Result Upload Failed. Due To Internal Server Error";
					redirect($_SERVER['HTTP_REFERER']);
				}	
			}
		} 
	} 
   
    public function admin_view_result()
	{
    	if($_SESSION['role_admin']=='admin')
		{
			$data['row'] = $this->Admin_model->GetDataJ('t1.*,t2.*','student_result t1','student_marks t2',' t1.id=t2.student_result_id');
			$data['code'] = $this->Admin_model->GetData('college_list');
			$data['title'] = "Result";
			$this->load->view('admin/include/header',$data);
			$this->load->view('admin/include/sidebar');
			$this->load->view('admin/admin_view_result');
			$this->load->view('admin/include/footer');			
		}
		else
		{
			$_SESSION['role_admin']='';
			redirect('adminjnrc','refresh');
		}
    }
	
	public function admin_search_result()
	{
    	if($_SESSION['role_admin']=='admin')
		{
			echo $session_year = $this->input->post('session_year');
			echo '<br>';
			echo $school_code = $this->input->post('school_code');
			echo '<br>';
			echo $course_type = $this->input->post('course_type');
			
			die;
		 
			// $data['row'] = $this->Admin_model->GetDataJ('t1.*,t2.*','student_result t1','student_marks t2',' t1.id=t2.student_result_id');
			// $data['code'] = $this->Admin_model->GetData('college_list');
			// $data['title'] = "Result";
			// $this->load->view('admin/include/header',$data);
			// $this->load->view('admin/include/sidebar');
			// $this->load->view('admin/admin_view_result');
			// $this->load->view('admin/include/footer');			
		}
		else
		{
			$_SESSION['role_admin']='';
			redirect('adminjnrc','refresh');
		}
    }
	
	
    public function admin_view_renewal()
	{
    	if($_SESSION['role_admin']=='admin')
		{
			$search_by = $this->input->post('search_by');
			$value = $this->input->post('value');
			if($search_by=='')
			{	
				$data['row'] = $this->Admin_model->GetDataDesc2('renewal','','',50);
			}
			elseif($search_by=='show_all')
			{			
				$data['row'] = $this->Admin_model->GetDataDesc2('renewal');
			}
			else
			{
				$data['row'] = $this->Admin_model->GetData('renewal',$search_by,$value);
			}
			$data['title'] = "Renewal";
			$this->load->view('admin/include/header',$data);
			$this->load->view('admin/include/sidebar');
			$this->load->view('admin/admin_view_renewal');
			$this->load->view('admin/include/footer'); 
		}
		else
		{
			$_SESSION['role_admin']='';
			redirect('adminjnrc','refresh');
		}
    }
	
	
    public function admin_view_registration()
	{
    	if($_SESSION['role_admin']=='admin')
		{
			$data['row'] = $this->Admin_model->GetData('student_detail');
			$data['title'] = "Registration";
			$this->load->view('admin/include/header',$data);
			$this->load->view('admin/include/sidebar');
			$this->load->view('admin/admin_view_registration',$data);
			$this->load->view('admin/include/footer'); 
		}
		else
		{
			$_SESSION['role_admin']='';
			redirect('adminjnrc','refresh');
		}
    }
	
	
	
	
	public function  Pagi()
	{
		$this->load->library('pagination');
		$this->load->helper('url');
		$params = array();
		$limit_per_page = 1;
		$start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$total_records = $this->Admin_model->get_total();

		if ($total_records > 0) 
		{
			// get current page records
			$params["results"] = $this->Admin_model->get_current_page_records($limit_per_page, $start_index);

			$config['base_url'] = base_url() . 'Pagi';
			$config['total_rows'] = $total_records;
			$config['per_page'] = $limit_per_page;
			$config["uri_segment"] = 3;

			$this->pagination->initialize($config);

			// build paging links
			$params["links"] = $this->pagination->create_links();
		}

		$this->load->view('icons', $params);
	}
	
	
    public function send_test_email()
	{
	   $input_captcha = $this->input->post('captcha');
    $session_captcha = $this->session->userdata('captcha_word');

    if (strcasecmp($input_captcha, $session_captcha) != 0) {
        $this->session->set_flashdata('data_add', 'Invalid CAPTCHA.');
        redirect('contact');
        return;
    }

    // Clear captcha after validation
    $this->session->unset_userdata('captcha_word');


		//Load email library
        $this->load->library('email');
        //SMTP & mail configuration
        $config = array(
            'protocol'  => 'mail',
            'smtp_host' => 'mail.jnrcranchi.com',
            'smtp_port' => 465,	//587for non ssl
            'smtp_user' => 'info@jnrcranchi.com',
            'smtp_pass' => 'x80ynuQo4+uS',
            'mailtype'  => 'html',
            'charset'   => 'iso-8859-1'
        );
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");
        $Name    = html_escape($this->input->post('name', TRUE));
		$email   = html_escape($this->input->post('mail_id', TRUE));
		$mobile  = html_escape($this->input->post('mobile', TRUE));
		$subject = html_escape($this->input->post('subject', TRUE));
		$message = html_escape($this->input->post('message', TRUE));
        //Email content
        $htmlContent = '<h1>Query</h1>';
        $htmlContent .= '<p>Name: '.$Name.'</p>';
        $htmlContent .= '<p>Email ID: '.$email.'</p>';
        $htmlContent .= '<p>Mobile: '.$mobile.'</p>';
        $htmlContent .= '<p>Subject: '.$subject.'</p>';
        $htmlContent .= '<p>Message: '.$message.'</p>';
        //$this->email->to('prashant1hitcs@gmail.com');
        $this->email->to('firozakhter3@gmail.com');
        //$this->email->to('jnrcranchi1@gmail.com');
        $this->email->from('info@jnrcranchi.com','JNRC Ranchi');
        $this->email->subject($subject);
        $this->email->message($htmlContent);
        if($this->email->send())
        {
        	echo "Email Sent";
        	$this->session->set_flashdata('data_add','Email has been sent Successfully.');
				redirect('contact');
        }
        else
        {echo "Not sent";
			show_error($this->email->print_debugger());
		}
	}
	
		public function email() {
		if($_SESSION['role_admin']=='admin')
		{
        //Load email library
        $this->load->library('email');
        //SMTP & mail configuration
        $config = array(
            'protocol'  => 'mail',
            'smtp_host' => 'mail.jnrcranchi.com',
			//'smtp_crypto' => 'ssl',
            'smtp_port' => 465,
            'smtp_user' => 'info@jnrcranchi.com',
            'smtp_pass' => 'x80ynuQo4+uS',
            'mailtype'  => 'html',
            'charset'   => 'iso-8859-1'
        );
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");
        $message = $this->input->post('message');
        $file_path = $this->input->post('file_path');
        $to = $this->input->post('email_id');
        $is_send_to_all = $this->input->post('is_send_to_all');
        if($is_send_to_all)
        {
        	$items=array();
        	$data = $this->Admin_model->GetEmail();
        	foreach ($data as $key) {
        	 	$items[] = $key['email'];
        	}
        	$to = implode(',', $items);
        }
        else
        {
        	$to = $this->input->post('email_id');
        }
        $subject = $this->input->post('subject');
        //Email content
        $htmlContent = '<h1>Notification</h1>';
        $htmlContent .= '<p>'.$message.'</p>';
        $this->email->to($to);
        //$this->email->cc();
        $this->email->from('info@jnrcranchi.com','JNRC Ranchi');
        $this->email->subject($subject);
        $this->email->message($htmlContent);
        //$this->email->attach('http://jnrcranchi.com/uploads/notification/ash_banner.jpg');
        $this->email->attach($file_path);
        //Send email
        if($this->email->send())
        {
        	echo "Email Sent Successfully";
        	$this->session->set_flashdata('data_add','Email has been sent Successfully.');
				//redirect('notification');
        }
        else
        {echo "Not sent";
			//redirect('notification');
     show_error($this->email->print_debugger());
		}
		}
		else{
			$_SESSION['role_admin']='';
			redirect('adminjnrc','refresh');
		}
    }
    
      
public function add_center() {
    if($this->session->userdata('role_admin') == 'admin') {
        $data['title'] = "Add Center";
        $data['centers'] = $this->db->get('center_tb')->result(); // Fetch all centers
        $this->load->view('admin/include/header', $data);
        $this->load->view('admin/include/sidebar');
        $this->load->view('admin/center');
        $this->load->view('admin/include/footer');
    } else {
        $this->session->unset_userdata('role_admin');
        redirect('adminjnrc', 'refresh');  
    }
}



public function save_center() {
    $this->load->database();
    $this->load->library('form_validation');

    $this->form_validation->set_rules('name_center', 'Center Name', 'required|trim');

    if ($this->form_validation->run() == FALSE) {
        $this->session->set_flashdata('error', validation_errors());
        redirect('center'); // Redirect to the form again
    } else {
        $name = $this->input->post('name_center', TRUE);

        $data = array(
            'name_center' => $name
        );

        $insert = $this->db->insert('center_tb', $data);

        if ($insert) {
            $this->session->set_flashdata('success', '✅ New Center Added Successfully!');
        } else {
            $this->session->set_flashdata('error', '❌ Failed to Add Center.');
        }

        redirect('center'); // Redirect to your center form/list page
    }
}

public function update_center($id) {
    $this->form_validation->set_rules('name_center', 'Center Name', 'required|trim');

    if ($this->form_validation->run() == FALSE) {
        $this->session->set_flashdata('error', validation_errors());
    } else {
        $data = ['name_center' => $this->input->post('name_center', TRUE)];
        $this->db->where('id', $id);
        if ($this->db->update('center_tb', $data)) {
            $this->session->set_flashdata('success', 'Center updated successfully!');
        } else {
            $this->session->set_flashdata('error', 'Failed to update center.');
        }
    }

    redirect('admin/add_center');
}

public function delete_center($id) {
    $this->db->where('id', $id);
    if ($this->db->delete('center_tb')) {
        $this->session->set_flashdata('success', 'Center deleted successfully!');
    } else {
        $this->session->set_flashdata('error', 'Failed to delete center.');
    }
    redirect('admin/add_center');
}



public function set_exam_datetime() {
    if($this->session->userdata('role_admin') == 'admin') {
        $data['courses'] = $this->db->distinct()->select('course')->get('subjects_details_tb')->result_array();
        $data['title'] = "Set Subject Date/Time";
        $data['subject_details'] = $this->db->get('subjects_details_tb')->result_array();

        $this->load->view('admin/include/header', $data);
        $this->load->view('admin/include/sidebar');
        $this->load->view('admin/set_exam_datetime', $data);
        $this->load->view('admin/include/footer');
    } else {
        $this->session->unset_userdata('role_admin');
        redirect('adminjnrc', 'refresh');
    }
}


public function get_subjects_by_course()
{
    // Check authentication
    if($this->session->userdata('role_admin') != 'admin') {
        echo json_encode(['error' => 'Unauthorized access']);
        return;
    }
    
    $course = $this->input->post('course');
    $subjects = $this->db->where('course', $course)->get('subjects_details_tb')->result_array();
    echo json_encode($subjects);
}

public function update_subject_datetime() {
    // Check authentication
    if($this->session->userdata('role_admin') != 'admin') {
        $this->session->set_flashdata('error', 'Unauthorized access');
        redirect('adminjnrc', 'refresh');
        return;
    }
    
    $course = $this->input->post('course');
    $year = $this->input->post('year');
    $subject_name = $this->input->post('subject_name');
    $exam_date = $this->input->post('exam_date');
    $exam_time = $this->input->post('exam_time');

    $this->db->where([
        'course' => $course,
        'year' => $year,
        'subject_name' => $subject_name
    ]);
    $this->db->update('subjects_details_tb', [
        'exam_date' => $exam_date,
        'time' => $exam_time
    ]);

    $this->session->set_flashdata('msg', 'Exam date and time updated successfully!');
    redirect('admin/set_exam_datetime');
}

public function get_subjects_by_course_year() {
    // Check authentication
    if($this->session->userdata('role_admin') != 'admin') {
        echo '<option value="">Unauthorized access</option>';
        return;
    }
    
    $course = $this->input->post('course');
    $year = $this->input->post('year');

    $subjects = $this->db->get_where('subjects_details_tb', ['course' => $course, 'year' => $year])->result();

    echo '<option value="">Select Subject</option>';
    foreach ($subjects as $sub) {
        echo '<option value="'.$sub->subject_name.'">'.$sub->subject_name.'</option>';
    }
}



}



    
    
    
    
    
    
    