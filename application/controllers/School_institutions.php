<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class School_institutions extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
		$this->load->model('Dashboard_model');
		$this->load->model('Affiliation_model');
		$this->load->model('Model_school_institutions');
	}
	
	
	public function index()
	{
		$this->load->view('institution/login');		
	}
	
	public function institution_verification()
	{
		$course=$this->input->post('course');
		$username=$this->input->post('username');
		$password=$this->input->post('password');

		$login_res=$this->Model_school_institutions->Login_verify($course,$username,$password);
		
				//   echo "<pre>";
    // print_r([
    //     'course'       => $course,
    //     'username'     => $username,
    //     'password'     => $password,
    // ]);
    // print_r($login_res);
    // exit;
    
		if($login_res==true)
		{
			$School_Data=$this->Model_school_institutions->Login_verify_Details($course,$username,$password);
			foreach($School_Data as $userdata)
			{
				$this->session->set_userdata(array(
					'school_course' 	=> 	$course,
					'school_id' 	=> 	$userdata['id'],
					'school_email'	=>	$userdata['email'],
					'school_name'	=>	$userdata['school_name'],
					'school_code'	=>	$userdata['school_code'],
					'loginstatus'	=> '1',
					'role'			=> 'institute',
					
				));	
			}
			redirect(base_url('institution_dashboard'));
		}
		else
		{
			$_SESSION['errmsg']="Login Failed ? Username and Password Wrong.... Please Try Again";
			redirect(base_url('institution_login'));
		}		
	}
	
	public function login_verification()
	{
		if($this->session->userdata('school_code')==null || $this->session->userdata('loginstatus')==null)
		{
			$_SESSION['errmsg']="Login Verification Detail Not Matched...? Please Try Again.";
			redirect(base_url('institution_login'));
		}
	}
	public function logout_institution()
	{
		$this->session->unset_userdata('school_course');	
		$this->session->unset_userdata('school_id');	
		$this->session->unset_userdata('school_email');	
		$this->session->unset_userdata('school_name');	
		$this->session->unset_userdata('loginstatus');	
		$this->session->unset_userdata('role');	
		redirect(base_url(''));
	}
	
	/*
	-----------------------------------------------------------------------------------------------------
	-----------------------------------------------------------------------------------------------------
	---------------------------------------- Institutions After Login Section ===============================================
	=====================================================================================================
	=====================================================================================================
	*/
	
	public function institution_dashboard()
	{
		$this->login_verification();
		$this->load->view('institution/include/header');
		$this->load->view('institution/dashboard');
		$this->load->view('institution/include/footer');
	}
	
	
	
	public function institution_certification_details()
	{		
		$this->login_verification();
		$school_id=$this->session->userdata('school_id');
		$data['institution_details']=$this->Model_school_institutions->Get_institution_details('college_list','id',$school_id);
		$this->load->view('institution/include/header',$data);
		$this->load->view('institution/certification-details');
		$this->load->view('institution/include/footer');
	}
	
	public function fill_exam_form()
	{		
		$this->login_verification();
		$school_id=$this->session->userdata('school_id');
		$data['institution_details']=$this->Model_school_institutions->Get_institution_details('college_list','id',$school_id);
		$data['batch_session']= $this->Model_school_institutions->Get_Affected_Details('batch_session_tb');
		
			 $data['subjects'] = $this->db->get('subjects_details_tb')->result_array();
			 
		$this->load->view('institution/include/header',$data);
		$this->load->view('institution/student_exam_form');
		$this->load->view('institution/include/footer');
	}
	
	public function get_subjects_by_course()
{
    $course = $this->input->post('course');
    $this->db->where('course', $course);
    $query = $this->db->get('subjects_details_tb');
    $subjects = $query->result_array();
    
    header('Content-Type: application/json');
    echo json_encode($subjects);
}
	
	
	
	public function submit_exam_form()
	{
		$this->login_verification();
		$aadhar=$this->input->post('aadhar');
		$anm_new= $this->Model_school_institutions->count_aadhar($aadhar);
		$data_count=$this->db->affected_rows($anm_new);
// 		if($data_count == 1)
// 		{
// 			$_SESSION['msg']="warning";
// 			$_SESSION['errmsg']="Aadhar Card Number Already Exists.";
// 			redirect($_SERVER['HTTP_REFERER']);
// 		}
// 		else
// 		{
			date_default_timezone_set('Asia/Kolkata');
			$session = $this->Model_school_institutions->Get_Affected_Details('batch_session_tb');
			$batch_session=$session[0]['current_session'];
			
			$empdata = $this->Model_school_institutions->Get_Affected_Details('exam_form_tb');
			$prev_emp_id=$this->db->affected_rows($empdata);		
			$inital = $prev_emp_id + 1;
			$profile_id_temp = str_pad($inital, 5, '0', STR_PAD_LEFT);
			$year=date('Y');
			$stucode = 'JNRC'.$year.'-'.$profile_id_temp;
			
			
			if(!is_dir('uploads/exam_form/'.$stucode)) 
			{
				mkdir('./uploads/exam_form/' .$stucode, 0777, TRUE);
			}
			
			$config['upload_path'] = 'uploads/exam_form/'.$stucode; 
			$config['allowed_types'] = 'jpg|png|jpeg|pdf';
			$config['max_size'] = '2048000';
			
			
			$this->load->library('upload',$config);		
			// Candidate Photo
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
			// Candidate Signature
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
			// Matric Verification Report
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
			// Inter Verification Report
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
			
			// Passing Marksheet
			if($this->upload->do_upload('passing_marksheet')==true)
			{
				$data['uploaddata']=$this->upload->data();
				foreach($data as $d)
				{
					$passing_marksheet=$d['file_name'];
				}
			}
			else
			{
				$_SESSION['msg']="warning";
				$_SESSION['errmsg']="Image Should Be .JPG , .PNG and .JPEG  Or Image Size 50kb And Passport Size. ";
				redirect($_SERVER['HTTP_REFERER']);
			}
			
			 $selectedSubjects = $this->input->post('selected_subjects') ?? [];
			
			$input_data=array(
			'batch_session' 		=> $batch_session,
			'ref_no' 		=> $stucode,
			'issue_by' 		=> $_SESSION['school_code'],
			
			'course'		=> $this->input->post('course'),
			'name'			=> $this->input->post('name'),
			'father_name'	=> $this->input->post('father_name'),
			'mother_name'	=> $this->input->post('mother_name'),
			'dob'			=> $this->input->post('dob'),
			'age'			=> $this->input->post('age'),
			'aadhar'		=> $this->input->post('aadhar'),
			'marital'		=> $this->input->post('marital'),
			'nationality'	=> $this->input->post('nationality'),
			'perm_address'	=> $this->input->post('perm_address'),
			 'phone_number' => $this->input->post('phone_number'),
			'train_school'	=> $this->input->post('train_school'), 
			'medium_exam'	=> $this->input->post('medium_exam'),
            'cmlrank'   	=> $this->input->post('cmlrank'),
            
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

    		  
            // Subjects - only store if checkbox was checked
            'sub_1' => in_array('1', $selectedSubjects) ? $this->input->post('sub_1') : '', 
            'sub_2' => in_array('2', $selectedSubjects) ? $this->input->post('sub_2') : '', 
            'sub_3' => in_array('3', $selectedSubjects) ? $this->input->post('sub_3') : '',
            'sub_4' => in_array('4', $selectedSubjects) ? $this->input->post('sub_4') : '',
            'sub_5' => in_array('5', $selectedSubjects) ? $this->input->post('sub_5') : '',
            'sub_6' => in_array('6', $selectedSubjects) ? $this->input->post('sub_6') : '',
            'sub_7' => in_array('7', $selectedSubjects) ? $this->input->post('sub_7') : '',
            'sub_8' => in_array('8', $selectedSubjects) ? $this->input->post('sub_8') : '',  
            
    		
			
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
			
			
			if($data_count == 0){
    			if($input_data['age'] < 17){
    			    $_SESSION['msg']="warning";
    				$_SESSION['errmsg']="You are not able to fill form...... Your age must be between 17 to 100 ";
    				redirect($_SERVER['HTTP_REFERER']);
    			} else if($input_data['age'] > 100){
    			    $_SESSION['msg']="warning";
    				$_SESSION['errmsg']="You are not able to fill form...... Your age must be between 17 to 100 ";
    				redirect($_SERVER['HTTP_REFERER']);
    			}
    			else{
        			$data1 = array_map('ucwords', $input_data);
        			// file uploading here...
        			$data2=array(
        			'img1'		=> $candidate,
        			'img2'		=> $signature,
        			'file1'		=> $matric,
        			'file2'		=> $inter,
        			 'passing_marksheet'           => $passing_marksheet
        			);
        			$data=array_merge($data1,$data2);	
        // 			print_r($data);
        // 			die;
        			
        			$check_insert = $this->Model_school_institutions->Submit_Exam_Details('exam_form_tb',$data);
			    }
			}	
			else{
    			$data1 = array_map('ucwords', $input_data);
    			// file uploading here...
    			$data2=array(
    			'img1'		=> $candidate,
    			'img2'		=> $signature,
    			'file1'		=> $matric,
    			'file2'		=> $inter,
    			 'passing_marksheet'           => $passing_marksheet
    			);
    			$data=array_merge($data1,$data2);	
    // 			print_r($data);
    // 			die;
    			
    			$check_insert = $this->Model_school_institutions->Submit_Exam_Details('exam_form_tb',$data);
			}	
			if(!empty($check_insert))
			{
				$_SESSION['msg']="success";
				$_SESSION['errmsg']="Exam Form Submit Successfully";
				redirect(base_url('pre_view_exam_form/'.$check_insert.''));
			}
			else
			{
				$_SESSION['msg']="danger";
				$_SESSION['errmsg']="Exam Form Submit Failed. Due Internal Server Error...";
				redirect($_SERVER['HTTP_REFERER']);
			}
// 		}
	
	}
	
	public function view_exam_form($id='')
	{		
		$this->login_verification();
		$school_id=$this->session->userdata('school_id');
		$data['exam_form']=$this->Model_school_institutions->Get_institution_details('exam_form_tb','id',$id);
		$data['institution_details']=$this->Model_school_institutions->Get_institution_details('college_list','id',$school_id);
		$data['batch_session']= $this->Model_school_institutions->Get_Affected_Details('batch_session_tb');
		$this->load->view('institution/include/header',$data);
		$this->load->view('institution/view_student_exam_form');
		$this->load->view('institution/include/footer');
	}
	
	
	public function pre_view_exam_form($id='')
	{		
		$this->login_verification();
		$school_id=$this->session->userdata('school_id');
		$data['exam_form']=$this->Model_school_institutions->Get_institution_details('exam_form_tb','id',$id);
		$data['institution_details']=$this->Model_school_institutions->Get_institution_details('college_list','id',$school_id);
		$data['batch_session']= $this->Model_school_institutions->Get_Affected_Details('batch_session_tb');
		$this->load->view('institution/include/header',$data);
		$this->load->view('institution/pre_view_student_exam_form');
		$this->load->view('institution/include/footer');
	}
	
	public function final_update_exam_form()
	{
		$this->login_verification();
		$aadhar=$this->input->post('aadhar');
		$anm_new= $this->Model_school_institutions->count_aadhar($aadhar);
		$data_count=$this->db->affected_rows($anm_new);
// 		print_r($data_count);
// 		die;
// 		if($data_count > 1)
// 		{
// 			$_SESSION['msg']="warning";
// 			$_SESSION['errmsg']="Aadhar Card Number Already Exists.";
// 			redirect($_SERVER['HTTP_REFERER']);
// 		}
// 		else
// 		{
			date_default_timezone_set('Asia/Kolkata');
			$session = $this->Model_school_institutions->Get_Affected_Details('batch_session_tb');
			$batch_session=$session[0]['current_session'];			
			
			// details update by this id & Value 
			$id =$this->input->post('update_id');
			
			$session = $this->Model_school_institutions->Get_Ref_Affected_Details('exam_form_tb',$id);
			$ref_no=$session[0]['ref_no'];			
			$config['upload_path'] = 'uploads/exam_form/'.$ref_no; 
			$config['allowed_types'] = 'jpg|png|jpeg|pdf';
			$config['max_size'] = '10240000';
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
			// Passing Marksheet
			if (!empty($_FILES['passing_marksheet']['name'])) 
			{	
				if($this->upload->do_upload('passing_marksheet')==true)
				{
					$data['uploaddata']=$this->upload->data();
					foreach($data as $d)
					{
						$passing_marksheet=$d['file_name'];
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
				$passing_marksheet=$this->input->post('old_passing_marksheet');
			}
			
			$input_data=array(
			'batch_session' => $batch_session,
			'issue_by' 		=> $_SESSION['school_code'],		
			'course'		=> $this->input->post('course'),
			'name'			=> $this->input->post('name'),
			'father_name'	=> $this->input->post('father_name'),
			'mother_name'	=> $this->input->post('mother_name'),
			'dob'			=> $this->input->post('dob'),
			'age'			=> $this->input->post('age'),
			'aadhar'		=> $this->input->post('aadhar'),
			'marital'		=> $this->input->post('marital'),
			'nationality'	=> $this->input->post('nationality'),
			'perm_address'	=> $this->input->post('perm_address'),
			'phone_number'  => $this->input->post('phone_number'),
			'train_school'	=> $this->input->post('train_school'),
			'medium_exam'	=> $this->input->post('medium_exam'),
			 'cmlrank'       => $this->input->post('cmlrank') ,

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
			
		if($data_count == 1){
			if($input_data['age'] < 17){
			    $_SESSION['msg']="warning";
				$_SESSION['errmsg']="You are not able to fill form...... Your age must be between 17 to 100 ";
				redirect($_SERVER['HTTP_REFERER']);
			} else if($input_data['age'] > 100){
			    $_SESSION['msg']="warning";
				$_SESSION['errmsg']="You are not able to fill form...... Your age must be between 17 to 100 ";
				redirect($_SERVER['HTTP_REFERER']);
			}
			else{
    			$data1 = array_map('ucwords', $input_data);
    			// file uploading here...
    			$data2=array(
    			'img1'		=> $candidate,
    			'img2'		=> $signature,
    			'file1'		=> $matric,
    			'file2'		=> $inter,
    			'passing_marksheet'   => $passing_marksheet
    			);
    			$data=array_merge($data1,$data2);	
    			echo $data;
    			$check_update = $this->Model_school_institutions->Update_institution_details('exam_form_tb',$data,$id);
			}
		}	
		else{
			    $data1 = array_map('ucwords', $input_data);
    			// file uploading here...
    			$data2=array(
    			'img1'		=> $candidate,
    			'img2'		=> $signature,
    			'file1'		=> $matric,
    			'file2'		=> $inter,
    			'passing_marksheet'   => $passing_marksheet
    			);
    			$data=array_merge($data1,$data2);	
    			echo $data;
    			$check_update = $this->Model_school_institutions->Update_institution_details('exam_form_tb',$data,$id);
			    
		}
			if($check_update==true)
			{
				$_SESSION['msg']="success";
				$_SESSION['errmsg']="Exam Form Final Submit Successfully";
				redirect(base_url('pre_view_exam_form/'.$id.''));
			}
			else
			{
				$_SESSION['msg']="danger";
				$_SESSION['errmsg']="Exam Form Final Submit Failed. Due Internal Server Error...";
				redirect($_SERVER['HTTP_REFERER']);
			}
// 		}
	
	}
	
	
	
	
	public function all_exam_form_details()
	{		
		$this->login_verification();
		$id=$this->session->userdata('school_code');
		$data['batch_session_year']=$this->Model_school_institutions->Get_distinct_institution_details('exam_form_tb','batch_session','issue_by',$id);
		$this->load->view('institution/include/header',$data);
		$this->load->view('institution/all-exam-form');
		$this->load->view('institution/include/footer');
	}
	
	public function search_exam_form_details()
	{		
		$this->login_verification();
		$id=$this->session->userdata('school_code');
		
		if(!empty($this->input->post('search')) || !empty($this->input->post('course')))
		{
			$session=$this->input->post('session');
			$course=$this->input->post('course');
			$exam_form_details=$this->Model_school_institutions->Get_exam_form_details('exam_form_tb',$id,$session,$course);
			$count=$this->db->affected_rows($exam_form_details);
			?>
			<div class="card">
				<div class="card-header-success">
					<span><?php echo $course; ?> Submitted Exam Form List Details</span>		
				</div>	
				<div class="card-body">						
					<div class="material-datatables table-responsive">
						<?php 
						if($count==0)
						{
							echo '<h3 class="text-danger text-center"> <b>No Record Found </b></h3>';
						}
						else
						{
							?>
							<table class="table table-bordered">
								<thead>
									<th>S.No</th>
									<th>Course</th>
									<th>Issue By</th>
									<th>Ref No.</th>
									<th>Name</th>
									<th>Father's Name</th>
									<th>Aadhar</th>
									<th>DOB</th>
									<th>Remarks</th>
									<th>Image</th>
									<th>Action</th>
								</thead>
								<tbody>
									<?php			
									$i=1; 
									foreach ($exam_form_details as $key )
									{
										?>
										<tr>
											<td><?php echo $i;?></td>
											<td><?php echo $key['course'];?></td>
											<td><?php echo $key['issue_by'];?></td>
											<td><?php echo $key['ref_no'];?></td>
											<td><?php echo $key['name'];?></td>
											<td><?php echo $key['father_name'];?></td>
											<td><?php echo $key['aadhar'];?></td>
											<td><?php echo $key['dob'];?></td>
											<td class="text-danger"><?php echo $key['remarks'];?></td>											
											<td><img class="img-responsive img-thumbnail" src="<?php echo base_url('uploads/exam_form/'.$key['ref_no'].'/'.$key['img1'].''); ?>" style="height:50px;"></td>
											<td> 
												<a title="View Detail" href="<?php echo base_url('pre_view_exam_form/').$key['id'];?>" target="_blank" class="btn btn-sm btn-info"><i class="fa fa-eye"></i> </a>
												<a title="edit Detail" href="<?php echo base_url('view_exam_form/').$key['id'];?>" target="_blank" class="btn btn-sm btn-success"><i class="fa fa-edit"></i> </a>
											</td>
										</tr>									
										<?php
										$i++; 									
									}
									?>
								</tbody>
							</table>
							<?php
						}
						?>
					</div>			
				</div>
			</div>
			<?php			
		}
		
		
	}
	
	
	
	public function how_to_fill_exam_form_details()
	{		
		$this->login_verification();
		$school_id=$this->session->userdata('school_id');
		$this->load->view('institution/include/header');
		$this->load->view('institution/how-to-fill');
		$this->load->view('institution/include/footer');
	}
	
	
	
	
	
	public function edit_institution_details()
	{		
		$this->login_verification();
		$school_id=$this->session->userdata('school_id');
		$data['institution_details']=$this->Model_school_institutions->Get_institution_details('college_list','id',$school_id);
		$this->load->view('institution/include/header',$data);
		$this->load->view('institution/edit-details');
		$this->load->view('institution/include/footer');
	}
	
	
	
	public function update_institution_details()
	{		
		$this->login_verification();
		$id=$this->session->userdata('school_id');
		$data=array(
			'email' => $this->input->post('email'),
			'phone' => $this->input->post('phone')
		);
		$update_result=$this->Model_school_institutions->Update_institution_details('college_list',$data,$id);
		if($update_result==true)
		{
			$_SESSION['msg']="success";
			$_SESSION['errmsg']="Email-id And Mobile Number Update Successfully.";
			redirect($_SERVER['HTTP_REFERER']);
		}
		else
		{
			$_SESSION['msg']="success";
			$_SESSION['errmsg']="Email-id And Mobile Number Update Failed..? Due To Internal Server Error...";
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
	
	
	
	
	public function change_password_institution_details()
	{		
		$this->login_verification();
		$school_id=$this->session->userdata('school_id');
		$this->load->view('institution/include/header');
		$this->load->view('institution/change-password');
		$this->load->view('institution/include/footer');
	}
	
	
	public function update_password_institution_details()
	{		
		$this->login_verification();
		$old=md5($this->input->post('old'));
		$new=$this->input->post('new');
		$con=$this->input->post('con');
		
		if($new==$con)
		{
			$id=$this->session->userdata('school_id');
			$login_res=$this->Model_school_institutions->password_matched($id,$old);
			if($login_res==true)
			{
				
				$data=array(
					'password' => md5($new),
					'show_pass' => $new,
				);
				$update_result=$this->Model_school_institutions->Update_institution_details('college_list',$data,$id);
				if($update_result==true)
				{
					$_SESSION['msg']="success";
					$_SESSION['errmsg']="Password Update Successfully.";
					redirect($_SERVER['HTTP_REFERER']);
				}
				else
				{
					$_SESSION['msg']="success";
					$_SESSION['errmsg']="Password Update Failed..? Due To Internal Server Error...";
					redirect($_SERVER['HTTP_REFERER']);
				}
			}
			else
			{
				$_SESSION['msg']="danger";
				$_SESSION['errmsg']="Old Password Does Not Matched To Entered Old Password";
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
		else
		{
			$_SESSION['msg']="warning";
			$_SESSION['errmsg']="New Password And Confirm Password  Does Not Matched...? Please Try Again....";
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
	
	
	
}