<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
		$this->load->model('Admin_model');
		$this->load->model('Affiliation_model');
	}
	public function index()
	{
		$data['row'] = $this->Admin_model->Get_notification_data('notification','status','Active');
		$this->load->view('frontend/include/header');
		$this->load->view('frontend/index',$data);
		$this->load->view('frontend/include/footer');
	}
	public function admin_login()
	{
		$this->load->view('frontend/admin_login');
	}
	public function registration()
	{
		$array = array('view'=>'registration');
		$this->load->view('frontend/template',$array);
	}
	public function institution()
	{
		$data['anm_new'] = $this->Admin_model->GetData('college_list','course_type','ANM_new');
		$data['anm_renew'] = $this->Admin_model->GetData('college_list','course_type','ANM_renew');
		$data['gnm_new'] = $this->Admin_model->GetData('college_list','course_type','GNM_new');
		$data['gnm_renew'] = $this->Admin_model->GetData('college_list','course_type','GNM_renew');
		$data['basic_bsc'] = $this->Admin_model->GetData('college_list','course_type','basic_bsc');
		$data['post_basic_bsc'] = $this->Admin_model->GetData('college_list','course_type','post_basic_bsc');
		$data['msc'] = $this->Admin_model->GetData('college_list','course_type','msc');
		$data['anm_school_enhance'] = $this->Admin_model->GetData('college_list','course_type','anm_school_enhance');
		$data['gnm_school_enhance'] = $this->Admin_model->GetData('college_list','course_type','gnm_school_enhance');
		$this->load->view('frontend/include/header');
		$this->load->view('frontend/institution',$data);
		$this->load->view('frontend/include/footer');
	}
	public function how_to_fill_form()      //view page of login
	{
		$array = array('view'=>'how_to_fill_form');
		$this->load->view('frontend/template',$array);
	}
	
	public function gallery()
	{
		$data['gallery'] = $this->Admin_model->Get_Gallery_Data();
		$this->load->view('frontend/include/header');
		$this->load->view('frontend/gallery',$data);
		$this->load->view('frontend/include/footer');		
	}
	public function fees()
	{
		$array = array('view'=>'fees');
		$this->load->view('frontend/template',$array);
	}
	public function members()
	{
		$array = array('view'=>'members');
		$this->load->view('frontend/template',$array);
	}
	public function contact()
	{
		$array = array('view'=>'contact');
		$this->load->view('frontend/template',$array);
	}
	public function about_us()
	{
		$array = array('view'=>'about_us');
		$this->load->view('frontend/template',$array);
	}
	public function circulars()
	{
		$array = array('view'=>'circulars');
		$this->load->view('frontend/template',$array);
	}
	
	public function register_student()
	{
		$array = array('view'=>'register_student');
		$this->load->view('frontend/template',$array);
	}
	public function admission_student()
	{
		$array = array('view'=>'admission_student');
		$this->load->view('frontend/template',$array);
	}
	public function old_student()
	{
		$array = array('view'=>'old_student_edit');
		$this->load->view('frontend/template',$array);
	}
	public function student_renewal()
	{
		$array = array('view'=>'student_renewal');
		$this->load->view('frontend/template',$array);
	}
	public function success_exam_form($id='')
	{
		$data['row'] = $this->Admin_model->GetData('exam_form','id',$id);
		$this->load->view('frontend/include/header');
		$this->load->view('frontend/success_exam_form',$data);
		$this->load->view('frontend/include/footer');
	}
	public function success_renewal($id='')
	{
		$data['row'] = $this->Admin_model->GetData('renewal','id',$id);
		$this->load->view('frontend/include/header');
		$this->load->view('frontend/success_renewal',$data);
		$this->load->view('frontend/include/footer');
	}
	public function submitted_exam_form()
	{
		if($_SESSION['role']=='institute')
		{
		$school_code = $_SESSION['school_code'];
		$data['row'] = $this->Admin_model->Get_data_exam();
		$this->load->view('frontend/include/header');
		$this->load->view('frontend/submitted_exam_form',$data);
		$this->load->view('frontend/include/footer');
		}
		else{
			$_SESSION['role']='';
			redirect('inst_login','refresh');
		}
	}
	public function download()
	{
		
		$data['row'] = $this->Admin_model->GetDataOrder('documents','status',1);
    	$this->load->view('frontend/include/header');
		$this->load->view('frontend/download',$data);
		$this->load->view('frontend/include/footer');
	}
	
	
	
	
	public function view_institution_renewal_form()
	{
		if ($this->session->role == 'institute') 
		{
			
			$college_id=$_SESSION['uid'];	
			$data['affiliation_details'] = $this->Affiliation_model->Get_Affliation_Data('affiliation_tb',$college_id);			
			$data['affliation_lab'] = $this->Affiliation_model->Get_Affliation_Data('affliation_lab_tb',$college_id);
			$data['affliation_classroom'] = $this->Affiliation_model->Get_Affliation_Data('affliation_classroom_tb',$college_id);
			$data['affliation_fac'] = $this->Affiliation_model->Get_Affliation_Data('affiliation_faculty_tb',$college_id);
			$data['affliation_hospital'] = $this->Affiliation_model->Get_Affliation_Data('affiliation_hospital_tb',$college_id);
			$data['clinical_fac'] = $this->Affiliation_model->Get_Affliation_Data('affliation_clinical_tb',$college_id);
			$data['affliation_gfatm'] = $this->Affiliation_model->Get_Affliation_Data('affliation_gfatm_tb',$college_id);
			$this->load->view('frontend/include/header');
			$this->load->view('frontend/view_institution_affiliation_form',$data);
			$this->load->view('frontend/include/footer');
		}
		else
        {
			redirect('inst_login', 'refresh');
		}
	}
	public function edit_institution_renewal_form()
	{
		if ($this->session->role == 'institute') 
		{
			
			$college_id=$_SESSION['uid'];	
			$data['affiliation_details'] = $this->Affiliation_model->Get_Affliation_Data('affiliation_tb',$college_id);			
			$data['affliation_lab'] = $this->Affiliation_model->Get_Affliation_Data('affliation_lab_tb',$college_id);
			$data['affliation_classroom'] = $this->Affiliation_model->Get_Affliation_Data('affliation_classroom_tb',$college_id);
			$data['affliation_fac'] = $this->Affiliation_model->Get_Affliation_Data('affiliation_faculty_tb',$college_id);
			$data['affliation_hospital'] = $this->Affiliation_model->Get_Affliation_Data('affiliation_hospital_tb',$college_id);
			$data['clinical_fac'] = $this->Affiliation_model->Get_Affliation_Data('affliation_clinical_tb',$college_id);
			$data['affliation_gfatm'] = $this->Affiliation_model->Get_Affliation_Data('affliation_gfatm_tb',$college_id);
			$this->load->view('frontend/include/header');
			$this->load->view('frontend/edit_institution_affiliation_form',$data);
			$this->load->view('frontend/include/footer');
		}
		else
        {
			redirect('inst_login', 'refresh');
		}
	}
	
	
	public function update_institution_renewal_details()
	{
		if ($this->session->role == 'institute') 
		{
			$college_id=$_SESSION['uid'];
			
			$config['upload_path']='./uploads_affliation/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['remove_spaces'] = false;
			$config['overwrite'] = true;		
			//$config['max_width'] = '';
			//$config['max_height'] = '';
			//$config['max_size'] = '2000000';
				
			if ( ! empty($_FILES['demand_draft_img']['name']))
			{
				$this->load->library('upload',$config);				
				$this->upload->do_upload('demand_draft_img');
				$data2['uploaddata']=$this->upload->data();
				foreach($data2 as $d2)
				{
					$demand_draft_img=$d2['file_name'];
				}
			}
			else
			{
				$demand_draft_img=$this->input->post('demand_draft_img_old');
			}
			
			if ( ! empty($_FILES['build_cert_img']['name']))
			{
				$this->load->library('upload',$config);	
				$this->upload->do_upload('build_cert_img');
				$data1['uploaddata']=$this->upload->data();
				foreach($data1 as $bd)
				{
					$build_cert_img=$bd['file_name'];
				}
			}
			else
			{
				$build_cert_img=$this->input->post('old_build_cert_img');
			}
			
			
			
			
			
			
			
			
			if ( ! empty($_FILES['challan_attach']['name']))
			{
				$this->load->library('upload',$config);	
				$this->upload->do_upload('challan_attach');
				$data3['uploaddata']=$this->upload->data();
				foreach($data3 as $d3)
				{
					 $challan_attach=$d3['file_name'];
				}
			}
			else
			{
				$challan_attach=$this->input->post('challan_attach_old');
			}
			
			
			
			
			if ( ! empty($_FILES['build_img_1']['name']))
			{
				$this->load->library('upload',$config);	
				$this->upload->do_upload('build_img_1');
				$data['uploaddata']=$this->upload->data();
				foreach($data as $d)
				{
					$build_img_1=$d['file_name'];
				}
			}
			else
			{
				$build_img_1=$this->input->post('old_build_img_1');
			}
			
			
			
			if ( ! empty($_FILES['build_img_2']['name']))
			{	$this->load->library('upload',$config);		
				$this->upload->do_upload('build_img_2');
				$data['uploaddata']=$this->upload->data();
				foreach($data as $d)
				{
					$build_img_2=$d['file_name'];
				}
			}
			else
			{
				$build_img_2=$this->input->post('old_build_img_2');
			}
			
			
			
			if ( ! empty($_FILES['blueprint']['name']))
			{
				$this->load->library('upload',$config);	
				$this->upload->do_upload('blueprint');
				$data['uploaddata']=$this->upload->data();
				foreach($data as $d)
				{
					$blueprint=$d['file_name'];
				}			
			}
			else
			{
				$blueprint=$this->input->post('old_blueprint');
			}
			
			$data=array(
				'college_id'=> $_SESSION['uid'],				
				'chairperson_registrar_name' => $this->input->post('chairperson'),
				'society_trust_name' => $this->input->post('society'),
				'list_of_society_members' => $this->input->post('soc_members'),
				'state_name' => $this->input->post('state'),
				'district_name' => $this->input->post('district'),
				'tehsil_block' => $this->input->post('tehsil'),
				'pin_code' => $this->input->post('pin'),
				'landline_no' => $this->input->post('landline'),
				'mobile_no' => $this->input->post('mobile'),
				'society_trust_email' => $this->input->post('email'),
				'address' => $this->input->post('address'),				
				'name_of_instuition' => $this->input->post('institution'),
				'address_of_instuition' => $this->input->post('address_ins'),
				'inst_state' => $this->input->post('state_ins'),
				'inst_district' => $this->input->post('district_ins'),
				'inst_tehsil' => $this->input->post('tehsil_ins'),
				'inst_pincode' => $this->input->post('pin_ins'),
				'inst_landline' => $this->input->post('landline_ins'),
				'inst_fax_no' => $this->input->post('fax_ins'),
				'inst_under' => $this->input->post('ins_under'),
				'insta_email' => $this->input->post('ins_email'),				
				'applicant_id' => $this->input->post('applicant_id'),
				'fee_code' => $this->input->post('fee_code'),
				'fee_entry_date' => $this->input->post('ent_date'),
				'name_of_princi' => $this->input->post('principal'),
				'email_of_princi' => $this->input->post('email_prin'),
				'land_of_princi' => $this->input->post('landline_prin'),
				'faxno_of_princi' => $this->input->post('fax_prin'),
				'mobile_of_princi' => $this->input->post('mobile_prin'),				
				'programme_name' => $this->input->post('prog_name'),
				'board_name' => $this->input->post('board_name'),
				'school_code' => $this->input->post('school_code'),
				'total_seats' => $this->input->post('seats'),
				'previous_3year_student' => $this->input->post('admitted_previous_3years'),
				'admitted_no_student1' => $this->input->post('no_of_student1'),
				'admitted_no_student2' => $this->input->post('no_of_student2'),
				'admitted_no_student3' => $this->input->post('no_of_student3'),
				'student_under_training' => $this->input->post('student_under_Training'),				
				'online_reg_academic_year' => $this->input->post('onln_reg'),
				'general_profile' => $this->input->post('general'),
				'physical' => $this->input->post('physical'),
				'clinical' => $this->input->post('clinical'),
				'admission' => $this->input->post('admission'),
				'teacher' => $this->input->post('teachers'),
				'previous_year_fee' => $this->input->post('pre_year'),
				'current_year_fee' => $this->input->post('curr_year'),
				'challan_attach' => $challan_attach,
				'building_status' => $this->input->post('building'),
				'inst_building_address' => $this->input->post('loc_full_address'),
				'total_area_building' => $this->input->post('tot_area'),
				'blueprint_sign_auth' => $blueprint,			
				'building_registered_name' => $this->input->post('build_name'),			
				'build_comp_certi_img' => $build_cert_img,				
				'dd_penalty_sec' => $this->input->post('penalty'),
				'dd_no' => $this->input->post('dd_number'),
				'dd_attach' => $demand_draft_img,
				'dd_date' => $this->input->post('dd_date'),
				'cr_dd_date' => $this->input->post('cr_dd_date'),
				'teaching_blocks' => $this->input->post('build_area'),
				'hostel_blocks' => $this->input->post('build_hostel'),
				'entry_date' => $this->input->post('ent_date_pen'),
				'building_img1' => $build_img_1,
				'building_img2' => $build_img_2,				
				'nursing_book' => $this->input->post('nurs_books'),
				'no_of_nursing_journals_na' => $this->input->post('nur_jour_nat'),
				'no_of_nursing_journals_int' => $this->input->post('nur_jour_int'),				
				'hivs_tv_ads_module' => $this->input->post('nur_no_hiv'),				
				'anti_ragg_mod' => $this->input->post('anti_rag'),
				'anti_ragg_sq' => $this->input->post('anti_rag_mob'),				
				'dec_cand_name' => $this->input->post('dec_name'),				
				'so_do_wo' => $this->input->post('sodowo'),				
				'applicant_name' => $this->input->post('app_dec_name'),				
				'lib_dec_date' => $this->input->post('nur_ent'),			
				'lib_place' => $this->input->post('nur_place')
			);
			
			$update_result = $this->Affiliation_model->update_affliation_data('affiliation_tb',$data,$college_id);
			if($update_result==true)
			{
				$records_lab = count($_POST['lab_id']);
				for($i=0; $i<$records_lab; $i++)
				{	
					$lab_id = $_POST['lab_id'][$i];			
					$lab_data =array(
						'college_id' => $college_id,
						'lab_name' 	=> $_POST['lab_name'][$i],
						'lab_size' 	=> $_POST['lab_size'][$i],
						'no_equp' 	=> $_POST['no_equp'][$i],
						'no_dum' 	=> $_POST['no_dum'][$i],
						'ent_date_lab' 	=> $_POST['ent_date_lab'][$i]
						);
					$save_lab_result = $this->Affiliation_model->update_affili_data('affliation_lab_tb',$lab_data,$lab_id);
				}
				
				$records_cls = count($_POST['cls_id']);
				for($i=0; $i<$records_cls; $i++)
				{		
					$cls_id = $_POST['cls_id'][$i];			
					$class_data =array(
						'college_id' => $college_id,
						'utilize_class' => $_POST['no_utilized_cls'][$i],
						'no_cls' 	=> $_POST['no_cls'][$i],
						'size_cls' 	=> $_POST['size_cls'][$i]
					);
					$save_class_result = $this->Affiliation_model->update_affili_data('affliation_classroom_tb',$class_data,$cls_id);			
				
				}
					
				$records_hosp = count($_POST['hosp_id']);
				for($i=0; $i<$records_hosp; $i++)
				{		
					$hosp_id = $_POST['hosp_id'][$i];		
					$hosp_data =array(
						'college_id' => $college_id,
						'aff_hospital' 	=> $_POST['hosp_name'][$i],
						'aff_no_of_beds' 	=> $_POST['no_of_beds'][$i],
						'aff_bed_occupacy' 	=> $_POST['bed_occupancy'][$i],
						'aff_entry_date' 	=> $_POST['entry_date'][$i],
						'aff_address' 	=> $_POST['hosp_address'][$i]
						);
					$hosp_result=$this->Affiliation_model->update_affili_data('affiliation_hospital_tb',$hosp_data,$hosp_id);
				}
				
				$records_gfa = count($_POST['gfa_id']);
				for($i=0; $i<$records_gfa; $i++)
				{	
					$gfa_id = $_POST['gfa_id'][$i];		
					$gfa_data =array(
						'college_id' => $college_id,
						'faculty_name' 	=> $_POST['gfa_name'][$i],
						'gfa_hiv' 	=> $_POST['gfa_hiv'][$i],
						'gfa_tb' 	=> $_POST['gfa_tb'][$i]
					);
					$gfa_result=$this->Affiliation_model->update_affili_data('affliation_gfatm_tb',$gfa_data,$gfa_id);			
				
				}	
					
					
				$_SESSION['msg']="success";
				$_SESSION['errmsg']="Affiliation Update Successfully";
				redirect($_SERVER['HTTP_REFERER']);
			}
			else
			{
				$_SESSION['msg']="danger";
				$_SESSION['errmsg']="Affiliation Update Failed";
				redirect($_SERVER['HTTP_REFERER']);
			}		
		}
		else
        {
			redirect('inst_login', 'refresh');
		}
	}
	
	
	//oldest affilation page
	public function affiliation()		
	{
		$this->load->view('frontend/include/header');
		$this->load->view('frontend/affiliation_1',$data);
		$this->load->view('frontend/include/footer');
	}
	
	public function new_affiliation_details()         //new affilation page
	{
		$this->load->model('Affiliation_model');
		if ($this->session->role == 'institute') 
		{
			$this->load->view('frontend/include/header');  
			$this->load->view('frontend/affiliation_3');  
			$this->load->view('frontend/include/footer');  
        }
        else
        {
			redirect('inst_login', 'refresh');
		}
	}

	public function affiliation2()			//old affiliation page
	{
		//print_r($_SESSION['role']);
		//echo $this->session->role;
		if ($this->session->role == 'institute') 
		{
			//print_r($_SESSION['role']);
			//die;
			$appl_id = $this->Affiliation_model->GetDataLimit('affiliation');
			//print_r($appl_id);
			$array = array('view'=>'affiliation_2','appl_id'=>$appl_id);
			$this->load->view('frontend/template',$array);  
        }
        else
        {
			redirect('inst_login', 'refresh');
		}
	}
	public function affiliation3()         //new affilation page
	{
		$this->load->model('Affiliation_model');
		if ($this->session->role == 'institute') 
		{
			$appl_id['row1'] = $this->Affiliation_model->GetData('tbl_status',1,'form1');
			$appl_id['row2'] = $this->Affiliation_model->GetData('tbl_status',1,'form2');
			$appl_id['row3'] = $this->Affiliation_model->GetData('tbl_status',1,'form3');
			$appl_id['row4'] = $this->Affiliation_model->GetData('tbl_status',1,'form4');	
			$appl_id['row5'] = $this->Affiliation_model->GetData('tbl_status',1,'form5');	
			$this->load->view('frontend/include/header');  
			$this->load->view('frontend/affiliation_3',$appl_id);  
			$this->load->view('frontend/include/footer');  
        }
        else
        {
			redirect('inst_login', 'refresh');
		}
	}
	public function renew_affiliation()         //renewal page
	{
		$this->load->model('Affiliation_model');
		if ($this->session->role == 'institute') 
		{
			$appl_id['row1'] = $this->Affiliation_model->GetData('tbl_status',1,'form1');
			$appl_id['row2'] = $this->Affiliation_model->GetData('tbl_status',1,'form2');
			$appl_id['row3'] = $this->Affiliation_model->GetData('tbl_status',1,'form3');
			$appl_id['row4'] = $this->Affiliation_model->GetData('tbl_status',1,'form4');	
			$appl_id['row5'] = $this->Affiliation_model->GetData('tbl_status',1,'form5');	
			$this->load->view('frontend/include/header');  
			$this->load->view('frontend/renew_affiliation',$appl_id);  
			$this->load->view('frontend/include/footer');  
        }
        else
        {
			redirect('inst_login', 'refresh');
		}
	}
	public function inst_login()      //view page of login
	{
		$this->load->view('frontend/include/header');
		$this->load->view('frontend/inst_login');
		$this->load->view('frontend/include/footer');
	}
	public function change_password()
	{
		$old_pass = $this->input->post('old_pass');
		$new_pass = $this->input->post('new_pass');
		$conf_pass = $this->input->post('conf_pass');
		$school_code=$_SESSION['school_code'];
		$school_details = $this->Admin_model->GetData('college_list','school_code',$school_code);
		//print_r($ret_details); die;
		$pre_ret_pass=$school_details[0]['password'];
		if($new_pass==$conf_pass){
			if(md5($old_pass)==$pre_ret_pass){
				$data=array('password' => md5($new_pass), 'show_pass' => $new_pass);
				$check_update = $this->Admin_model->UpdatePassword('college_list',$data,$school_code);
				$this->session->set_flashdata('data_change_pass',"Password Changed !! Please logout and login again.");
				redirect($_SERVER['HTTP_REFERER']);
			}
			else
			{
				$this->session->set_flashdata('data_change_pass',"Password is wrong !!");
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
		else
		{
			$this->session->set_flashdata('data_change_pass',"Password not matched !!");
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
	public function change_school_detail()
	{
		$phone = $this->input->post('phone');
		$email = $this->input->post('email');
		$school_code = $this->input->post('school_code');
		
	
				$data=array('phone' => $phone, 'email' => $email);
				$check_update = $this->Admin_model->UpdatePassword('college_list',$data,$school_code);
				if($check_update)
				$this->session->set_flashdata('data_change_pass',"Your Details are updated !! Thank you !!");
				redirect('inst_after_login','refresh');
			
	}
	public function inst_after_login()      //view page of login
	{
		if($_SESSION['role']=='institute')
		{
			$college_id=$_SESSION['uid'];
			$school_code = $_SESSION['school_code'];
			//$convertedDob = date("d/m/Y", strtotime($dob));
			$affiliation_details = $this->Affiliation_model->Get_Affliation_Data('affiliation_tb',$college_id);			
			$data['affiliation_details']=$this->db->affected_rows($affiliation_details);
			$data['row'] = $this->Admin_model->GetData('college_list','school_code',$school_code);
			//print_r($data);
			$this->load->view('frontend/include/header');
			$this->load->view('frontend/inst_after_login',$data);
			$this->load->view('frontend/include/footer');
		}
		else
		{
			$_SESSION['role']='';
			redirect('inst_login','refresh');
		}
	}

	/*public function upl()
	{
		$array = array('view'=>'upload_form');
		$this->load->view('frontend/template',$array);
	}*/ 
	function pdf_gen(){
		$id = $this->uri->segment(2);
    	$data['todos'] = $this->Affiliation_model->GetData('affiliation',$id,'id');
    	$data['todos_lab'] = $this->Affiliation_model->GetData('aff_lab',$id,'aff_id');
    	$data['todos_fac'] = $this->Affiliation_model->GetData('aff_fac',$id,'aff_id');
    	$data['todos_gfa'] = $this->Affiliation_model->GetData('aff_gfatm',$id,'aff_id');
	    $this->load->library('pdf'); 
	    $this->load->view('main_report',$data);
	    $html = $this->output->get_output();
	    $this->dompdf->load_html($html);
	    //$this->$dompdf->setPaper('A4', 'landscape');
		$this->dompdf->render();
		$this->dompdf->stream("welcome.pdf");
	}
	function invoice($value=''){
		$id = $this->uri->segment(2);
    	$data['todos'] = $this->Affiliation_model->GetData('affiliation',$id,'id');
    	$data['todos_lab'] = $this->Affiliation_model->GetData('aff_lab',$id,'aff_id');
    	$data['todos_fac'] = $this->Affiliation_model->GetData('aff_fac',$id,'aff_id');
    	$data['todos_gfa'] = $this->Affiliation_model->GetData('aff_gfatm',$id,'aff_id');
    	//print_r($data);
    	//print_r($data_lab);
		$this->load->view('main_temp',$data);
	}
	function test_print()
	{
		$this->load->library('pdf'); 
		$html = '<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><title>New Order Placed</title></head><body><h1>Test Printing...</h1></body></html>';
		//$html = $this->output->get_output();
	    $this->dompdf->load_html($html);
	    $this->dompdf->render();
		$this->dompdf->stream("welcome.pdf");
	}
	/*function save_inst()
	{
			$inst_name = $this->input->post('ins_name');
			$school_code = $this->input->post('school_code');
			$district = $this->input->post('dist');
			$ins_address = $this->input->post('address');
			$email = $this->input->post('email');
			$phone_no = $this->input->post('phone');
			//$user = $this->input->post('username');
			$user = $this->input->post('school_code');
			$password = $this->input->post('password');
			$ip = $_SERVER['REMOTE_ADDR'];
			$data=array(
					'inst_name' 	=> $inst_name,
					'school_code' 	=> $school_code,
					'district' 	=> $district,
					'ins_address' 	=> $ins_address,
					'email' 	=> $email,
					'phone_no' 	=> $phone_no,
					'user'  => $user,
					//'user'  => $user,
					'password'  => md5($password),
					'show_pass'  => $password,
					'ip'  => $ip
			);
			$check_school_code = $this->Admin_model->GetData('users_inst','school_code',$school_code);
			if($check_school_code) 
				echo "<h1>School code already Exists</h1>";
			else
				{
				$this->load->model('Affiliation_model');
				$last_id = $this->Affiliation_model->insertUser('users_inst',$data);
				//die;
				$data_notif['inst_id'] = $last_id;
				$data_notif['username'] = $user;
				$this->Affiliation_model->insertUser('tbl_status',$data_notif);
				$this->session->set_flashdata('useradd','User Successfully Registered.');
				redirect('');
			}
	}*/
	// login module function 
	public function login_inst()			
	{
			$this->load->model('Login_model');
			$username = $this->input->post('username');
			$password = $this->input->post('password');	
			$data = array(
					'school_code' => $username
			);
			$row = $this->Login_model->MatchUsername('college_list',$data);
    		if($row)
    		{
    			foreach($row as $userdata){}
    			if(md5($password)==$userdata['password'])
    			{
	    			$id = $userdata['id'];
	    			$email = $userdata['email'];
	    			$username = $userdata['school_name'];
	    			$school_code = $userdata['school_code'];
	    			$role = 'institute';
	    			$inst_name = $userdata['school_name'];
	    			$this->session->set_userdata(array(
								'uid' 			=> 	$id,
								'email'			=>	$email,
								'username'		=>	$username,
								'school_code'	=>	$school_code,
								'loginstatus'	=> '1',
								'role'			=> $role,
								'inst_name'		=> $inst_name,
						));	
					redirect('inst_after_login','refresh'); 
    			}
	    		else
	    		{
	    			$this->session->set_flashdata('pwdnotmatch','Password Is Not Correct !!');
					redirect('inst_login','refresh');
	    		}
			}
			else
	    	{
	    		$this->session->set_flashdata('unnotmatch','Username Is Wrong !!');
				redirect('inst_login','refresh');
	    	}
	}
	public function logout_user()
	{
		$this->session->unset_userdata('uid');	
		$this->session->unset_userdata('email');	
		$this->session->unset_userdata('username');	
		$this->session->unset_userdata('loginstatus');	
		$this->session->unset_userdata('role');	
		$this->session->set_flashdata('logout','Logout Successfully');
		redirect('inst_login', 'refresh');
	}
	public function success_affl()
	{
		$this->load->model('Affiliation_model');
		$appl_id = $this->Affiliation_model->GetDataLimit('affiliation');
		$array = array('view'=>'success','appl_id'=>$appl_id);
		$this->load->view('frontend/template',$array); 
	}
		public function new_affiliation_form1()
	{
		if ($this->session->role == 'institute') 
		{
			$this->load->view('frontend/include/header');  
			$this->load->view('frontend/form1');  
			$this->load->view('frontend/include/footer'); 
		}
		 else
        {
			redirect('inst_login', 'refresh');
		}
	}
	public function new_affiliation_form2()
	{
		if ($this->session->role == 'institute') 
		{
			$this->load->view('frontend/include/header');  
			$this->load->view('frontend/form2');  
			$this->load->view('frontend/include/footer');
		}
		 else
        {
			redirect('inst_login', 'refresh');
		}
	}
	public function form3()
	{
		if ($this->session->role == 'institute') 
		{
			$this->load->view('frontend/include/header');  
			$this->load->view('frontend/form3');  
			$this->load->view('frontend/include/footer'); 
		}
		else
        {
			redirect('inst_login', 'refresh');
		}
	}
	public function form4()
	{
		//$appl_id = $this->Affiliation_model->GetDataLimit('affiliation');
		//$appl_id['last_id'] = $this->Affiliation_model->GetDataLimit('affiliation');
		if ($this->session->role == 'institute') 
		{
		$this->load->view('frontend/include/header');  
			$this->load->view('frontend/form4');  
			$this->load->view('frontend/include/footer'); 
			}
		 else
        {
			redirect('inst_login', 'refresh');
		}
	}
	
	public function save_affliation_form1()
	{		
		if($_SESSION['role']=='institute')
		{
			$user_id = $_SESSION['uid'];
			$ip = $_SERVER['REMOTE_ADDR'];
			$data=array(
			'college_id'=> $_SESSION['uid'],
			'chairperson_registrar_name' => $this->input->post('chairperson'),
			'society_trust_name' => $this->input->post('society'),
			'list_of_society_members' => $this->input->post('soc_members'),
			'state_name' => $this->input->post('state'),
			'district_name' => $this->input->post('district'),
			'tehsil_block' => $this->input->post('tehsil'),
			'pin_code' => $this->input->post('pin'),
			'landline_no' => $this->input->post('landline'),
			'mobile_no' => $this->input->post('mobile'),
			'society_trust_email' => $this->input->post('email'),
			'address' => $this->input->post('address'),
			'name_of_instuition' => $this->input->post('institution'),
			'address_of_instuition' => $this->input->post('address_ins'),
			'inst_state' => $this->input->post('state_ins'),
			'inst_district' => $this->input->post('district_ins'),
			'inst_tehsil' => $this->input->post('tehsil_ins'),
			'inst_pincode' => $this->input->post('pin_ins'),
			'inst_landline' => $this->input->post('landline_ins'),
			'inst_fax_no' => $this->input->post('fax_ins'),
			'inst_under' => $this->input->post('ins_under'),
			'insta_email' => $this->input->post('ins_email'),
			'applicant_id' => $this->input->post('applicant_id'),
			'fee_code' => $this->input->post('fee_code'),
			'fee_entry_date' => $this->input->post('ent_date'),
			'name_of_princi' => $this->input->post('principal'),
			'email_of_princi' => $this->input->post('email_prin'),
			'land_of_princi' => $this->input->post('landline_prin'),
			'faxno_of_princi' => $this->input->post('fax_prin'),
			'mobile_of_princi' => $this->input->post('mobile_prin')		
			);
			
			$save_result = $this->Affiliation_model->save_affliation_data('affiliation_tb',$data);
			if($save_result==true)
			{
				$_SESSION['msg']="success";
				$_SESSION['errmsg']="Affiliation Form Submit Successfully";
				redirect($_SERVER['HTTP_REFERER']);			
			}
			else
			{
				$_SESSION['msg']="danger";
				$_SESSION['errmsg']="Affiliation Form Submit Failed";
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
		else
		{
			redirect('inst_login', 'refresh');
		}
	}
	
	
	public function affiliation_save_form2()
	{
		if($_SESSION['role']=='institute')
		{
			$config['upload_path']='./uploads_affliation/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['remove_spaces'] = true;
			$config['overwrite'] = true;		
			//$config['max_width'] = '';
			//$config['max_height'] = '';
			//$config['max_size'] = '2000000';
			$this->load->library('upload',$config);
			
			$this->upload->do_upload('build_cert_img');
			$data['uploaddata']=$this->upload->data();
			foreach($data as $d)
			{
				$build_cert_img=$d['file_name'];
			}
			
			$this->upload->do_upload('demand_draft_img');
			$data['uploaddata']=$this->upload->data();
			foreach($data as $d)
			{
				$demand_draft_img=$d['file_name'];
			}
			
			$this->upload->do_upload('build_img_1');
			$data['uploaddata']=$this->upload->data();
			foreach($data as $d)
			{
				$build_img_1=$d['file_name'];
			}
			
			$this->upload->do_upload('build_img_2');
			$data['uploaddata']=$this->upload->data();
			foreach($data as $d)
			{
				$build_img_2=$d['file_name'];
			}
			
			$this->upload->do_upload('challan_attach');
			$data['uploaddata']=$this->upload->data();
			foreach($data as $d)
			{
				$challan_attach=$d['file_name'];
			}
			$this->upload->do_upload('blueprint');
			$data['uploaddata']=$this->upload->data();
			foreach($data as $d)
			{
				$blueprint=$d['file_name'];
			}
			$college_id = $_SESSION['uid'];
			$data=array(
				'programme_name' => $this->input->post('prog_name'),
				'board_name' => $this->input->post('board_name'),
				'school_code' => $this->input->post('school_code'),
				'total_seats' => $this->input->post('seats'),
				'previous_3year_student' => $this->input->post('admitted_previous_3years'),
				'admitted_no_student1' => $this->input->post('no_of_student1'),
				'admitted_no_student2' => $this->input->post('no_of_student2'),
				'admitted_no_student3' => $this->input->post('no_of_student3'),
				'student_under_training' => $this->input->post('student_under_Training'),			
				'online_reg_academic_year' => $this->input->post('onln_reg'),
				'general_profile' => $this->input->post('general'),
				'physical' => $this->input->post('physical'),
				'clinical' => $this->input->post('clinical'),
				'admission' => $this->input->post('admission'),
				'teacher' => $this->input->post('teachers'),
				'previous_year_fee' => $this->input->post('pre_year'),
				'current_year_fee' => $this->input->post('curr_year'),
				'challan_attach' => $challan_attach,
				'building_status' => $this->input->post('building'),
				'inst_building_address' => $this->input->post('loc_full_address'),
				'total_area_building' => $this->input->post('tot_area'),
				'blueprint_sign_auth' => $blueprint,			
				'building_registered_name' => $this->input->post('build_name'),			
				'build_comp_certi_img' => $build_cert_img,			
				'dd_penalty_sec' => $this->input->post('penalty'),
				'dd_no' => $this->input->post('dd_number'),
				'dd_attach' => $demand_draft_img,
				'dd_date' => $this->input->post('dd_date'),
				'teaching_blocks' => $this->input->post('build_area'),
				'hostel_blocks' => $this->input->post('build_hostel'),
				'entry_date' => $this->input->post('ent_date_pen'),
				'building_img1' => $build_img_1,
				'building_img2' => $build_img_2
			);
						
			$update_result = $this->Affiliation_model->update_affliation_data('affiliation_tb',$data,$college_id);
			if($update_result==true)
			{
				$records_lab = count($_POST['lab_name']);
				for($i=0; $i<$records_lab; $i++)
				{				
					$lab_data =array(
						'college_id' => $college_id,
						'lab_name' 	=> $_POST['lab_name'][$i],
						'lab_size' 	=> $_POST['lab_size'][$i],
						'no_equp' 	=> $_POST['no_equp'][$i],
						'no_dum' 	=> $_POST['no_dum'][$i],
						'ent_date_lab' 	=> $_POST['ent_date_lab'][$i]
						);
					$save_lab_result = $this->Affiliation_model->save_affliation_data('affliation_lab_tb',$lab_data);
				}
				
				$records_cls = count($_POST['no_utilized_cls']);
				for($i=0; $i<$records_cls; $i++)
				{				
					$class_data =array(
						'college_id' => $college_id,
						'utilize_class' 	=> $_POST['no_utilized_cls'][$i],
						'no_cls' 	=> $_POST['no_cls'][$i],
						'size_cls' 	=> $_POST['size_cls'][$i]
					);
					$save_class_result = $this->Affiliation_model->save_affliation_data('affliation_classroom_tb',$class_data);			
				
				}
				if($save_lab_result==true || $save_class_result==true)
				{
					$_SESSION['msg']="success";
					$_SESSION['errmsg']="Affiliation Form Submit Successfully";
					redirect($_SERVER['HTTP_REFERER']);	
				}	
				else
				{
					$_SESSION['msg']="danger";
					$_SESSION['errmsg']="Affiliation Form Submit Failed";
					redirect($_SERVER['HTTP_REFERER']);
				}
			}
			else
			{
				$_SESSION['msg']="danger";
				$_SESSION['errmsg']="Affiliation Form Submit Failed";
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
		else
		{
			redirect('inst_login', 'refresh');
		}	
	}
	
	
	public function save_form3()
	{
		$college_id = $_SESSION['uid'];
		$records_faculty = count($_POST['fac_name']);
		
		//faculty insertion
		$files = $_FILES;
		for($i=0; $i<$records_faculty; $i++) 
		{
			$_FILES = array();
			foreach( $files['qual_cert'] as $k=>$v )
			{
				echo $_FILES['qual_cert'][$k] = $v[$i];                
			}
			foreach( $files['fac_img'] as $k=>$v )
			{
				echo $_FILES['fac_img'][$k] = $v[$i];                
			}
			$data =array(
				'college_id' => $college_id,
				'fac_name' 	=> $_POST['fac_name'][$i],
				'fac_inst' 	=> $_POST['fac_inst'][$i],
				'fac_r_num' => $_POST['fac_r_num'][$i],
				'fac_ug' 	=> $_POST['fac_ug'][$i],
				'fac_gen' 	=> $_POST['fac_gen'][$i],
				'fac_pass' 	=> $_POST['fac_pass'][$i],
				'fac_rn_rm_cert'=> $_POST['rn_rm_certified'][$i],
				'fac_pg' 	=> $_POST['fac_pg'][$i],
				'fac_des' 	=> $_POST['fac_des'][$i],
				'fac_join' 	=> $_POST['fac_join'][$i],
				'fac_adhr' 	=> $_POST['fac_adhr'][$i],
				'fac_dip' 	=> $_POST['fac_dip'][$i],
				'fac_qual' 	=> $_POST['fac_qual'][$i],
				'fac_ent' 	=> $_POST['fac_ent'][$i]
			);
			$config['upload_path']='./uploads_affliation/';
			$config['allowed_types'] = 'png|gif|jpg|pdf|doc|docx';
			$config['max_size'] = '2048000';
			$this->load->library('upload',$config);
			if ($this->upload->do_upload('qual_cert')) 
			{
				$datas = $this->upload->data();
				$data['fac_qua_img'] = $datas['file_name'];
			}			
			if ($this->upload->do_upload('fac_img')) 
			{
				$datas = $this->upload->data();
				$data['fac_img'] = $datas['file_name'];
			}
			$teaching_result = $this->Affiliation_model->save_affliation_data('affiliation_faculty_tb',$data);			
		}
		if($teaching_result==true)
		{
			$_SESSION['msg']="success";
			$_SESSION['errmsg']="Teaching Faculty Form Details Submit Successfully";
			redirect($_SERVER['HTTP_REFERER']);	
		}	
		else
		{
			$_SESSION['msg']="danger";
			$_SESSION['errmsg']="Teaching Faculty Form Details Submit Failed";
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function save_form4()
	{
		if($_SESSION['role']=='institute')
		{
			$college_id = $_SESSION['uid'];
						
			$records_faculty = count($_POST['cli_hosp_name']);		
			//CLINICAL FACILITY  INSERTION
			$files = $_FILES;
			for($i=0; $i<$records_faculty; $i++) 
			{
				$_FILES = array();
				foreach( $files['cli_receipt_hosp_img'] as $k=>$v )
				{
					echo $_FILES['cli_receipt_hosp_img'][$k] = $v[$i];                
				}
				
				$data =array(
					'college_id' => $college_id,
					'parent_hospital' 	=> $_POST['cli_hosp_name'][$i],
					'no_of_beds' 	=> $_POST['cli_no_of_beds'][$i],
					'cni_bed_occupancy' => $_POST['cli_bed_occupancy'][$i],
					//'prem_letter_of_hosp' 	=> $_POST['fac_ug'][$i],
					//'cni_exp_stu' 	=> $_POST['fac_gen'][$i],
					'cni_entry_date' 	=> $_POST['cli_entry_date'][$i],
					'cni_address'=> $_POST['cli_address'][$i]
				);
				$config['upload_path']='./uploads_affliation/';
				$config['allowed_types'] = 'png|gif|jpg|pdf|doc|docx';
				$config['max_size'] = '2048000';
				$this->load->library('upload',$config);
				if ($this->upload->do_upload('cli_receipt_hosp_img')) 
				{
					$datas = $this->upload->data();
					$data['receipt_of_hospital_img'] = $datas['file_name'];
				}			
				
				$teaching_result = $this->Affiliation_model->save_affliation_data('affliation_clinical_tb',$data);			
			}
			
			$data_update=array(				
				'nursing_book' => $this->input->post('nurs_books'),
				'no_of_nursing_journals_na' => $this->input->post('nur_jour_nat'),
				'no_of_nursing_journals_int' => $this->input->post('nur_jour_int'),
				'hivs_tv_ads_module' => $this->input->post('nur_no_hiv'),
				'anti_ragg_mod' => $this->input->post('anti_rag'),
				'anti_ragg_sq' => $this->input->post('anti_rag_mob'),
				'dec_cand_name' => $this->input->post('dec_name'),
				'so_do_wo' => $this->input->post('sodowo'),
				'applicant_name' => $this->input->post('app_dec_name'),	
				'lib_dec_date' => $this->input->post('nur_ent'),			
				'lib_place' => $this->input->post('nur_place')
			);						
			$update_result = $this->Affiliation_model->update_affliation_data('affiliation_tb',$data_update,$college_id);
			if($update_result==true)
			{
				$records_lab = count($_POST['hosp_name']);
				for($i=0; $i<$records_lab; $i++)
				{				
					$lab_data =array(
						'college_id' => $college_id,
						'aff_hospital' 	=> $_POST['hosp_name'][$i],
						'aff_no_of_beds' 	=> $_POST['no_of_beds'][$i],
						'aff_bed_occupacy' 	=> $_POST['bed_occupancy'][$i],
						'aff_entry_date' 	=> $_POST['entry_date'][$i],
						'aff_address' 	=> $_POST['address'][$i]
						);
					$save_lab_result = $this->Affiliation_model->save_affliation_data('affiliation_hospital_tb',$lab_data);
				}
				
				$records_cls = count($_POST['gfa_name']);
				for($i=0; $i<$records_cls; $i++)
				{				
					$class_data =array(
						'college_id' => $college_id,
						'faculty_name' 	=> $_POST['gfa_name'][$i],
						'gfa_hiv' 	=> $_POST['gfa_hiv'][$i],
						'gfa_tb' 	=> $_POST['gfa_tb'][$i]
					);
					$save_class_result = $this->Affiliation_model->save_affliation_data('affliation_gfatm_tb',$class_data);			
				
				}
				if($save_lab_result==true || $save_class_result==true)
				{
					$_SESSION['msg']="success";
					$_SESSION['errmsg']="Affiliation Form Submit Successfully";
					redirect($_SERVER['HTTP_REFERER']);	
				}	
				else
				{
					$_SESSION['msg']="danger";
					$_SESSION['errmsg']="Affiliation Form Submit Failed";
					redirect($_SERVER['HTTP_REFERER']);
				}
			}
			else
			{
				$_SESSION['msg']="danger";
				$_SESSION['errmsg']="Affiliation Form Submit Failed";
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
		else
		{
			redirect('inst_login', 'refresh');
		}		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function save_student()
	{
			//$user_id = $_SESSION['uid'];
			$ip = $_SERVER['REMOTE_ADDR'];
			$state = $this->input->post('state');
			$name = $this->input->post('name');
			$father_name = $this->input->post('father_name');
			$dob = $this->input->post('dob');
			$age = $this->input->post('age');
			$years = $this->input->post('years');
			$edu = $this->input->post('edu');
			$prof = $this->input->post('prof');
			$perm_address = $this->input->post('perm_address');
			$corr_address = $this->input->post('corr_address');
			$category = $this->input->post('category');
			$reg_no = $this->input->post('reg_no');
			$dated = $this->input->post('dated');
			$valid_upto = $this->input->post('valid_upto');
			$school_train = $this->input->post('school_train');
			$period_train = $this->input->post('period_train');
			$roll = $this->input->post('roll');
			$present_post = $this->input->post('present_post');
			$data=array(
					'state'	=> $state,
					'name' 	=> $name,
					'father_name' 	=> $father_name,
					'dob' 	=> $dob,
					'age' 	=> $age,
					'years' 	=> $years,
					'edu' 	=> $edu,
					'prof' 	=> $prof,
					'perm_address' 	=> $perm_address,
					'corr_address' 	=> $corr_address,
					'category' 	=> $category,
					'reg_no' 	=> $reg_no,
					'dated' 	=> $dated,
					'valid_upto' 	=> $valid_upto,
					'school_train' 	=> $school_train,
					'period_train' 	=> $period_train,
					'roll' 	=> $roll,
					'present_post' 	=> $present_post
					);
					$this->load->model('Affiliation_model');
					$check_insert = $this->Affiliation_model->insertUser('register',$data);
					if($check_insert){
					redirect('affiliation');
					}
					else{
						redirect('');
					}
	}
	
	public function save_admission_student(){
		$ens = $this->input->post('ens');
		$date_month = $this->input->post('date_month');
		$cour_year = $this->input->post('cour_year');
		$name = $this->input->post('name');
		$father_name = $this->input->post('father_name');
		$mother_name = $this->input->post('mother_name');
		$aadhar = $this->input->post('aadhar');
		$dob = $this->input->post('dob');
		$age = $this->input->post('age');
		$married = $this->input->post('married');
		$perm_address = $this->input->post('perm_address');
		$corr_address = $this->input->post('corr_address');
		$school_train = $this->input->post('school_train');
		$board_1 = $this->input->post('board_1');
		$year_1 = $this->input->post('year_1');
		$roll_1 = $this->input->post('roll_1');
		$total_1 = $this->input->post('total_1');
		$school_1 = $this->input->post('school_1');
		$board_2 = $this->input->post('board_2');
		$year_2 = $this->input->post('year_2');
		$roll_2 = $this->input->post('roll_2');
		$total_2 = $this->input->post('total_2');
		$school_2 = $this->input->post('school_2');
		$board_3 = $this->input->post('board_3');
		$year_3 = $this->input->post('year_3');
		$roll_3 = $this->input->post('roll_3');
		$total_3 = $this->input->post('total_3');
		$school_3 = $this->input->post('school_3');
		$board_4 = $this->input->post('board_4');
		$year_4 = $this->input->post('year_4');
		$roll_4 = $this->input->post('roll_4');
		$total_4 = $this->input->post('total_4');
		$school_4 = $this->input->post('school_4');
		$board_5 = $this->input->post('board_5');
		$year_5 = $this->input->post('year_5');
		$roll_5 = $this->input->post('roll_5');
		$total_5 = $this->input->post('total_5');
		$school_5 = $this->input->post('school_5');
		$sub1 = $this->input->post('sub1');
		$sub2 = $this->input->post('sub2');
		$sub3 = $this->input->post('sub3');
		$sub4 = $this->input->post('sub4');
		$sub5 = $this->input->post('sub5');
		$sub6 = $this->input->post('sub6');
		$lang = $this->input->post('lang');
		$data = array(
					'ens' => $ens,
					'date_month' => $date_month,
					'date_month' => $date_month,
					'cour_year' => $cour_year,
					'name' => $name,
					'father_name' => $father_name,
					'mother_name' => $mother_name,
					'aadhar' => $aadhar,
					'dob' => $dob,
					'age' => $age,
					'married' => $married,
					'perm_address' => $perm_address,
					'corr_address' => $corr_address,
					'school_train' => $school_train,
					'board_1' => $board_1,
					'year_1' => $year_1,
					'roll_1' => $roll_1,
					'total_1' => $total_1,
					'school_1' => $school_1,
					'board_2' => $board_2,
					'year_2' => $year_2,
					'roll_2' => $roll_2,
					'total_2' => $total_2,
					'school_2' => $school_2,
					'board_3' => $board_3,
					'year_3' => $year_3,
					'roll_3' => $roll_3,
					'total_3' => $total_3,
					'school_3' => $school_3,
					'board_4' => $board_4,
					'year_4' => $year_4,
					'roll_4' => $roll_4,
					'total_4' => $total_4,
					'school_4' => $school_4,
					'board_5' => $board_5,
					'year_5' => $year_5,
					'roll_5' => $roll_5,
					'total_5' => $total_5,
					'school_5' => $school_5,
					'sub1' => $sub1,
					'sub2' => $sub2,
					'sub3' => $sub3,
					'sub4' => $sub4,
					'sub5' => $sub5,
					'sub6' => $sub6,
					'lang' => $lang,
		);
		//image insertion
						$config['upload_path'] = 'uploads/admission_student/'; 
						$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
						$config['max_size'] = '2048000';
						$this->load->library('upload',$config);
						$this->upload->initialize($config);
						if ($this->upload->do_upload('img1')) {
				            $datas = $this->upload->data();
				          	$img1 = 'uploads/item_group/' . $datas['file_name'];
				            $data['img1'] = $img1;
				        }
				   $check_insert =  $this->Admin_model->insert_data('admission_student',$data);
				   if($check_insert)
					{
						redirect('inst_after_login');
					}
					else
					{
						redirect('admission_student');
					}	
	}
	public function get_old_student_data(){
		$this->load->model('Affiliation_model');
		$reg_no = $this->input->post('reg_no');
		$data['row'] = $this->Affiliation_model->GetData('admission_student',$reg_no,'id');
    	//print_r($data);
    	//print_r($data_lab);
    	$this->load->view('frontend/include/header');
		$this->load->view('frontend/old_student',$data);
		$this->load->view('frontend/include/footer');
	}
	public function inst_result($year=''){
		$school_code = $_SESSION['school_code'];
		$data['row'] = $this->Admin_model->GetDataJ('t1.*,t2.*','student_result t1','student_marks t2',' t1.id=t2.student_result_id','t1.school_code',$school_code,'t2.year',$year);
    	$this->load->view('frontend/include/header');
		$this->load->view('frontend/inst_result',$data);
		$this->load->view('frontend/include/footer');
	}
	public function exam_form()
	{
    	$this->load->view('frontend/include/header');
		$this->load->view('frontend/exam_form');
		$this->load->view('frontend/include/footer');
	}
	public function save_student_renewal()
	{
			//$user_id = $_SESSION['uid'];
			date_default_timezone_set('Asia/Kolkata');
			$ip = $_SERVER['REMOTE_ADDR'];
			$name = $this->input->post('name');
			$father_name = $this->input->post('father_name');
			$dob = $this->input->post('dob');
			$reg_no = $this->input->post('reg_no');
			$category = $this->input->post('category');
			$school_train = $this->input->post('school_train');
			$perm_address = $this->input->post('perm_address');
			$place_post = $this->input->post('place_post');
			$mobile_no = $this->input->post('mobile_no');
			$aadhar_no = $this->input->post('aadhar_no');
			$empdata = $this->Admin_model->GetDataLimit('renewal');
			$prev_emp_id = $empdata[0]['id'];
			$inital = $prev_emp_id + 1;
			$profile_id_temp = str_pad($inital, 4, '0', STR_PAD_LEFT);
			$stucode = 'REN19'.$profile_id_temp;
			$data=array(
					'name' 	=> $name,
					'father_name' 	=> $father_name,
					'dob' 	=> $dob,
					'reg_no' 	=> $reg_no,
					'category' 	=> $category,
					'school_train' 	=> $school_train,
					'perm_address' 	=> $perm_address,
					'place_post' 	=> $place_post,
					'mobile_no' 	=> $mobile_no,
					'aadhar_no' 	=> $aadhar_no,
					'ref_no'		=> $stucode,
					'created'=>date("Y-m-d  h:i:s A"),
					);
					$this->load->model('Affiliation_model');
					$check_insert = $this->Admin_model->insert_data('renewal',$data);
					if($check_insert){
						redirect("success_renewal/$check_insert");
					}
					else{
						redirect('');
					}
	}
	public function save_exam_form()
	{
			date_default_timezone_set('Asia/Kolkata');
			$issue_by = $_SESSION['school_code'];
			$course = $this->input->post('course');
			$name = $this->input->post('name');
			$father_name = $this->input->post('father_name');
			$mother_name = $this->input->post('mother_name');
			$dob = $this->input->post('dob');
			$age = $this->input->post('age');
			$aadhar = $this->input->post('aadhar');
			$marital = $this->input->post('marital');
			$nationality = $this->input->post('nationality');
			$perm_address = $this->input->post('perm_address');
			$train_school = $this->input->post('train_school');
			$medium_exam = $this->input->post('medium_exam');
			$board_1 = $this->input->post('board_1');
			$year_1 = $this->input->post('year_1');
			$roll_1 = $this->input->post('roll_1');
			$marks_1 = $this->input->post('marks_1');
			$school_1 = $this->input->post('school_1');
		
			$board_2 = $this->input->post('board_2');
			$year_2 = $this->input->post('year_2');
			$roll_2 = $this->input->post('roll_2');
			$marks_2 = $this->input->post('marks_2');
			$school_2 = $this->input->post('school_2');
		
			$board_3 = $this->input->post('board_3');
			$year_3 = $this->input->post('year_3');
			$roll_3 = $this->input->post('roll_3');
			$marks_3 = $this->input->post('marks_3');
			$school_3 = $this->input->post('school_3');
			$board_4 = $this->input->post('board_4');
			$year_4 = $this->input->post('year_4');
			$roll_4 = $this->input->post('roll_4');
			$marks_4 = $this->input->post('marks_4');
			$school_4 = $this->input->post('school_4');
			$sub_1 = $this->input->post('sub_1');
			$sub_2 = $this->input->post('sub_2');
			$sub_3 = $this->input->post('sub_3');
			$sub_4 = $this->input->post('sub_4');
			$sub_5 = $this->input->post('sub_5');
			$sub_6 = $this->input->post('sub_6');
			$sub_7 = $this->input->post('sub_7');
			$sub_8 = $this->input->post('sub_8');
			$img1 = $this->input->post('img1');
			$img2 = $this->input->post('img2');
			$ip = $_SERVER['REMOTE_ADDR'];
			//2nd table
			$no_times = $this->input->post('no_times');
			$rmonth1 = $this->input->post('rmonth1');
			$ryear1 = $this->input->post('ryear1');
			$rtrainschool = $this->input->post('rtrainschool');
			$rroll1 = $this->input->post('rroll1');
			$rno1 = $this->input->post('rno1');
			$ryear2 = $this->input->post('ryear2');
			$rcourse = $this->input->post('rcourse');
			$rcouncil = $this->input->post('rcouncil');
			$rmonth2 = $this->input->post('rmonth2');
			$rroll2 = $this->input->post('rroll2');
			$rno2 = $this->input->post('rno2');
			$rlang = $this->input->post('rlang');
			$ename = $this->input->post('ename');
			$emonth1 = $this->input->post('emonth1');
			$eyear1 = $this->input->post('eyear1');
			$econduct = $this->input->post('econduct');
			$edoj1 = $this->input->post('edoj1');
			$edoj2 = $this->input->post('edoj2');
			$edoj3 = $this->input->post('edoj3');
			$eleave1 = $this->input->post('eleave1');
			$eleave2 = $this->input->post('eleave2');
			$eleave3 = $this->input->post('eleave3');
			$eyear2 = $this->input->post('eyear2');
			$emonth2 = $this->input->post('emonth2');
			$eday = $this->input->post('eday');
			$lsub_1 = $this->input->post('lsub_1');
			$lsub_2 = $this->input->post('lsub_2');
			$lsub_3 = $this->input->post('lsub_3');
			$lsub_4 = $this->input->post('lsub_4');
			$lsub_5 = $this->input->post('lsub_5');
			$lsub_6 = $this->input->post('lsub_6');
			$lsub_7 = $this->input->post('lsub_7');
			$ldel_1 = $this->input->post('ldel_1');
			$ldel_2 = $this->input->post('ldel_2');
			$ldel_3 = $this->input->post('ldel_3');
			$ldel_4 = $this->input->post('ldel_4');
			$ldel_5 = $this->input->post('ldel_5');
			$ldel_6 = $this->input->post('ldel_6');
			$ldel_7 = $this->input->post('ldel_7');
			$latt_1 = $this->input->post('latt_1');
			$latt_2 = $this->input->post('latt_2');
			$latt_3 = $this->input->post('latt_3');
			$latt_4 = $this->input->post('latt_4');
			$latt_5 = $this->input->post('latt_5');
			$latt_6 = $this->input->post('latt_6');
			$latt_7 = $this->input->post('latt_7');
			$lper_1 = $this->input->post('lper_1');
			$lper_2 = $this->input->post('lper_2');
			$lper_3 = $this->input->post('lper_3');
			$lper_4 = $this->input->post('lper_4');
			$lper_5 = $this->input->post('lper_5');
			$lper_6 = $this->input->post('lper_6');
			$lper_7 = $this->input->post('lper_7');
			$empdata = $this->Admin_model->GetDataLimit('exam_form');
			$prev_emp_id = $empdata[0]['id'];
			$inital = $prev_emp_id + 1;
			$profile_id_temp = str_pad($inital, 4, '0', STR_PAD_LEFT);
			$stucode = 'JNRC19'.$profile_id_temp;
			$data=array(
									'ref_no' => $stucode,
									'issue_by' => $issue_by,
									'course'	=> $course,
									'name'	=> $name,
									'father_name'	=> $father_name,
									'mother_name'	=> $mother_name,
									'dob'	=> $dob,
									'age'	=> $age,
									'aadhar'	=> $aadhar,
									'marital'	=> $marital,
									'nationality'	=> $nationality,
									'perm_address'	=> $perm_address,
									'train_school'	=> $train_school,
									'medium_exam'	=> $medium_exam,
								
									'board_1'	=> $board_1,
									'year_1'	=> $year_1,
									'roll_1'	=> $roll_1,
									'marks_1'	=> $marks_1,
									'school_1'	=> $school_1,									
									'board_2'	=> $board_2,
									'year_2'	=> $year_2,
									'roll_2'	=> $roll_2,
									'marks_2'	=> $marks_2,
									'school_2'	=> $school_2,
								
									'board_3'	=> $board_3,
									'year_3'	=> $year_3,
									'roll_3'	=> $roll_3,
									'marks_3'	=> $marks_3,
									'school_3'	=> $school_3,
								
									'board_4'	=> $board_4,
									'year_4'	=> $year_4,
									'roll_4'	=> $roll_4,
									'marks_4'	=> $marks_4,
									'school_4'	=> $school_4,
			
									'sub_1'	=> $sub_1,
									'sub_2'	=> $sub_2,
									'sub_3'	=> $sub_3,
									'sub_4'	=> $sub_4,
									'sub_5'	=> $sub_5,
									'sub_6'	=> $sub_6,
									'sub_7'	=> $sub_7,
									'sub_8'	=> $sub_8,
									'date'=>date("Y-m-d"),
									'created'=>date("Y-m-d  h:i:s A"),
									'ip'=>$ip,
									);
							//image insertion
							$data_back = array(
									'no_times'	=> $no_times,
			
									'rmonth1'	=> $rmonth1,
									'ryear1'	=> $ryear1,
									'rtrainschool'	=> $rtrainschool,
									'rroll1'	=> $rroll1,
									'rno1'	=> $rno1,
									'ryear2'	=> $ryear2,
									'rcourse'	=> $rcourse,
									'rcouncil'	=> $rcouncil,
									'rmonth2'	=> $rmonth2,
									'rroll2'	=> $rroll2,
									'rno2'	=> $rno2,
									'rlang'	=> $rlang,
			
									'ename'	=> $ename,
									'emonth1'	=> $emonth1,
									'eyear1'	=> $eyear1,
									'econduct'	=> $econduct,
									'edoj1'	=> $edoj1,
									'edoj2'	=> $edoj2,
									'edoj3'	=> $edoj3,
									'eleave1'	=> $eleave1,
									'eleave2'	=> $eleave2,
									'eleave3'	=> $eleave3,
									'eyear2'	=> $eyear2,
									'emonth2'	=> $emonth2,
									'eday'	=> $eday,
			
									'lsub_1'	=> $lsub_1,
									'ldel_1'	=> $ldel_1,
									'latt_1'	=> $latt_1,
									'lper_1'	=> $lper_1,
			
									'lsub_2'	=> $lsub_2,
									'ldel_2'	=> $ldel_2,
									'latt_2'	=> $latt_2,
									'lper_2'	=> $lper_2,
			
									'lsub_3'	=> $lsub_3,
									'ldel_3'	=> $ldel_3,
									'latt_3'	=> $latt_3,
									'lper_3'	=> $lper_3,
			
									'lsub_4'	=> $lsub_4,
									'ldel_4'	=> $ldel_4,
									'latt_4'	=> $latt_4,
									'lper_4'	=> $lper_4,
									'lsub_5'	=> $lsub_5,
									'ldel_5'	=> $ldel_5,
									'latt_5'	=> $latt_5,
									'lper_5'	=> $lper_5,
									'lsub_6'	=> $lsub_6,
									'ldel_6'	=> $ldel_6,
									'latt_6'	=> $latt_6,
									'lper_6'	=> $lper_6,
									'lsub_7'	=> $lsub_7,
									'ldel_7'	=> $ldel_7,
									'latt_7'	=> $latt_7,
									'lper_7'	=> $lper_7,
			
									);
			//$data['ref_id']=$empcode;
		
						
			
									if (!is_dir('uploads/exam_form/'.$stucode)) {
										  mkdir('./uploads/exam_form/' . $stucode, 0777, TRUE);
									}
									$config['upload_path'] = 'uploads/exam_form/'.$stucode; 
									$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
									$config['max_size'] = '2048000';
									$this->load->library('upload',$config);
									if ($this->upload->do_upload('img1')) {
							            $datas = $this->upload->data();
							          	$img1 = 'uploads/exam_form/'.$stucode .'/'. $datas['file_name'];
							            $data['img1'] = $img1;
							        }
									if ($this->upload->do_upload('img2')) {
							            $datas = $this->upload->data();
							          	$img2 = 'uploads/exam_form/'.$stucode .'/'. $datas['file_name'];
							            $data['img2'] = $img2;
							        }
									if ($this->upload->do_upload('file1')) {
							            $datas = $this->upload->data();
							          	$file1 = 'uploads/exam_form/'.$stucode .'/'. $datas['file_name'];
							            $data['file1'] = $file1;
							        }
									if ($this->upload->do_upload('file2')) {
							            $datas = $this->upload->data();
							          	$file2 = 'uploads/exam_form/'.$stucode .'/'. $datas['file_name'];
							            $data['file2'] = $file2;
							        }
							$check_insert = $this->Admin_model->insert_multiple_table('exam_form',$data,'exam_form_back',$data_back);
			
							/*echo $check_insert;*/
							if($check_insert)
								redirect("preview_exam_form/$check_insert");
							else
								redirect("exam_form");
			
	}
	public function update_exam_form()
	{
			date_default_timezone_set('Asia/Kolkata');
			$ref_id = $this->input->post('ref_id');
			$ref_no = $this->input->post('ref_no');
			$course = $this->input->post('course');
			$name = $this->input->post('name');
			$father_name = $this->input->post('father_name');
			$mother_name = $this->input->post('mother_name');
			$dob = $this->input->post('dob');
			$age = $this->input->post('age');
			$aadhar = $this->input->post('aadhar');
			$marital = $this->input->post('marital');
			$nationality = $this->input->post('nationality');
			$perm_address = $this->input->post('perm_address');
			$train_school = $this->input->post('train_school');
			$medium_exam = $this->input->post('medium_exam');
			$board_1 = $this->input->post('board_1');
			$year_1 = $this->input->post('year_1');
			$roll_1 = $this->input->post('roll_1');
			$marks_1 = $this->input->post('marks_1');
			$school_1 = $this->input->post('school_1');
			
			$board_2 = $this->input->post('board_2');
			$year_2 = $this->input->post('year_2');
			$roll_2 = $this->input->post('roll_2');
			$marks_2 = $this->input->post('marks_2');
			$school_2 = $this->input->post('school_2');
			
			$board_3 = $this->input->post('board_3');
			$year_3 = $this->input->post('year_3');
			$roll_3 = $this->input->post('roll_3');
			$marks_3 = $this->input->post('marks_3');
			$school_3 = $this->input->post('school_3');
			$board_4 = $this->input->post('board_4');
			$year_4 = $this->input->post('year_4');
			$roll_4 = $this->input->post('roll_4');
			$marks_4 = $this->input->post('marks_4');
			$school_4 = $this->input->post('school_4');
			$sub_1 = $this->input->post('sub_1');
			$sub_2 = $this->input->post('sub_2');
			$sub_3 = $this->input->post('sub_3');
			$sub_4 = $this->input->post('sub_4');
			$sub_5 = $this->input->post('sub_5');
			$sub_6 = $this->input->post('sub_6');
			$sub_7 = $this->input->post('sub_7');
			$sub_8 = $this->input->post('sub_8');
			$old_image = $this->input->post('old_image');
			//$sub_8 = $this->input->post('sub_8');
			$img1=NULL;
			$img2=NULL;
			$file1=NULL;
			$file2=NULL;
			$config['upload_path'] = 'uploads/exam_form/'.$ref_no; 
			$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
			$config['max_size'] = '2048000';
			$this->load->library('upload',$config);
			if ($this->upload->do_upload('img1')) {
	            $datas= $this->upload->data();
	          	$img1 = 'uploads/exam_form/'.$ref_no .'/'. $datas['file_name'];
	        }
	        if($img1==null)	
				$img1=$this->input->post('old_image');
			if ($this->upload->do_upload('img2')) {
	            $datas= $this->upload->data();
	          	$img2 = 'uploads/exam_form/'.$ref_no .'/'. $datas['file_name'];
	        }
	        if($img2==null)	
				$img2=$this->input->post('old_sign');
			if ($this->upload->do_upload('file1')) {
	            $datas= $this->upload->data();
	          	$file1 = 'uploads/exam_form/'.$ref_no .'/'. $datas['file_name'];
	        }
	        if($file1==null)	
				$file1=$this->input->post('mat_rep');
			if ($this->upload->do_upload('file2')) {
	            $datas= $this->upload->data();
	          	$file2 = 'uploads/exam_form/'.$ref_no .'/'. $datas['file_name'];
	        }
	        if($file2==null)	
				$file2=$this->input->post('inter_rep');
	        
	        /*echo $img1;
	        echo '<br>';
	        echo $img2; echo '<br>';
	        echo $file1; echo '<br>';
	        echo $file2;
	        die;*/
			
			//2nd table
			$no_times = $this->input->post('no_times');
			$rmonth1 = $this->input->post('rmonth1');
			$ryear1 = $this->input->post('ryear1');
			$rtrainschool = $this->input->post('rtrainschool');
			$rroll1 = $this->input->post('rroll1');
			$rno1 = $this->input->post('rno1');
			$ryear2 = $this->input->post('ryear2');
			$rcourse = $this->input->post('rcourse');
			$rcouncil = $this->input->post('rcouncil');
			$rmonth2 = $this->input->post('rmonth2');
			$rroll2 = $this->input->post('rroll2');
			$rno2 = $this->input->post('rno2');
			$rlang = $this->input->post('rlang');
			$ename = $this->input->post('ename');
			$emonth1 = $this->input->post('emonth1');
			$eyear1 = $this->input->post('eyear1');
			$econduct = $this->input->post('econduct');
			$edoj1 = $this->input->post('edoj1');
			$edoj2 = $this->input->post('edoj2');
			$edoj3 = $this->input->post('edoj3');
			$eleave1 = $this->input->post('eleave1');
			$eleave2 = $this->input->post('eleave2');
			$eleave3 = $this->input->post('eleave3');
			$eyear2 = $this->input->post('eyear2');
			$emonth2 = $this->input->post('emonth2');
			$eday = $this->input->post('eday');
			$lsub_1 = $this->input->post('lsub_1');
			$lsub_2 = $this->input->post('lsub_2');
			$lsub_3 = $this->input->post('lsub_3');
			$lsub_4 = $this->input->post('lsub_4');
			$lsub_5 = $this->input->post('lsub_5');
			$lsub_6 = $this->input->post('lsub_6');
			$lsub_7 = $this->input->post('lsub_7');
			$ldel_1 = $this->input->post('ldel_1');
			$ldel_2 = $this->input->post('ldel_2');
			$ldel_3 = $this->input->post('ldel_3');
			$ldel_4 = $this->input->post('ldel_4');
			$ldel_5 = $this->input->post('ldel_5');
			$ldel_6 = $this->input->post('ldel_6');
			$ldel_7 = $this->input->post('ldel_7');
			$latt_1 = $this->input->post('latt_1');
			$latt_2 = $this->input->post('latt_2');
			$latt_3 = $this->input->post('latt_3');
			$latt_4 = $this->input->post('latt_4');
			$latt_5 = $this->input->post('latt_5');
			$latt_6 = $this->input->post('latt_6');
			$latt_7 = $this->input->post('latt_7');
			$lper_1 = $this->input->post('lper_1');
			$lper_2 = $this->input->post('lper_2');
			$lper_3 = $this->input->post('lper_3');
			$lper_4 = $this->input->post('lper_4');
			$lper_5 = $this->input->post('lper_5');
			$lper_6 = $this->input->post('lper_6');
			$lper_7 = $this->input->post('lper_7');
			$ip = $_SERVER['REMOTE_ADDR'];
			
			$data=array(
									'course'	=> $course,
									'name'	=> $name,
									'father_name'	=> $father_name,
									'mother_name'	=> $mother_name,
									'dob'	=> $dob,
									'age'	=> $age,
									'aadhar'	=> $aadhar,
									'marital'	=> $marital,
									'nationality'	=> $nationality,
									'perm_address'	=> $perm_address,
									'train_school'	=> $train_school,
									'medium_exam'	=> $medium_exam,
									
									'board_1'	=> $board_1,
									'year_1'	=> $year_1,
									'roll_1'	=> $roll_1,
									'marks_1'	=> $marks_1,
									'school_1'	=> $school_1,
									
									'board_2'	=> $board_2,
									'year_2'	=> $year_2,
									'roll_2'	=> $roll_2,
									'marks_2'	=> $marks_2,
									'school_2'	=> $school_2,
									
									'board_3'	=> $board_3,
									'year_3'	=> $year_3,
									'roll_3'	=> $roll_3,
									'marks_3'	=> $marks_3,
									'school_3'	=> $school_3,
									
									'board_4'	=> $board_4,
									'year_4'	=> $year_4,
									'roll_4'	=> $roll_4,
									'marks_4'	=> $marks_4,
									'school_4'	=> $school_4,
				
									'sub_1'	=> $sub_1,
									'sub_2'	=> $sub_2,
									'sub_3'	=> $sub_3,
									'sub_4'	=> $sub_4,
									'sub_5'	=> $sub_5,
									'sub_6'	=> $sub_6,
									'sub_7'	=> $sub_7,
									'sub_8'	=> $sub_8,
									'img1'	=> $img1,
									'img2'	=> $img2,
									'file1'	=> $file1,
									'file2'	=> $file2,
									'date'=>date("Y-m-d"),
									'modified'=>date("Y-m-d  h:i:s A"),
									'ip'=>$ip,
									);
							//image insertion
							$data_back = array(
									'no_times'	=> $no_times,
				
									'rmonth1'	=> $rmonth1,
									'ryear1'	=> $ryear1,
									'rtrainschool'	=> $rtrainschool,
									'rroll1'	=> $rroll1,
									'rno1'	=> $rno1,
									'ryear2'	=> $ryear2,
									'rcourse'	=> $rcourse,
									'rcouncil'	=> $rcouncil,
									'rmonth2'	=> $rmonth2,
									'rroll2'	=> $rroll2,
									'rno2'	=> $rno2,
									'rlang'	=> $rlang,
				
									'ename'	=> $ename,
									'emonth1'	=> $emonth1,
									'eyear1'	=> $eyear1,
									'econduct'	=> $econduct,
									'edoj1'	=> $edoj1,
									'edoj2'	=> $edoj2,
									'edoj3'	=> $edoj3,
									'eleave1'	=> $eleave1,
									'eleave2'	=> $eleave2,
									'eleave3'	=> $eleave3,
									'eyear2'	=> $eyear2,
									'emonth2'	=> $emonth2,
									'eday'	=> $eday,
				
									'lsub_1'	=> $lsub_1,
									'ldel_1'	=> $ldel_1,
									'latt_1'	=> $latt_1,
									'lper_1'	=> $lper_1,
				
									'lsub_2'	=> $lsub_2,
									'ldel_2'	=> $ldel_2,
									'latt_2'	=> $latt_2,
									'lper_2'	=> $lper_2,
				
									'lsub_3'	=> $lsub_3,
									'ldel_3'	=> $ldel_3,
									'latt_3'	=> $latt_3,
									'lper_3'	=> $lper_3,
				
									'lsub_4'	=> $lsub_4,
									'ldel_4'	=> $ldel_4,
									'latt_4'	=> $latt_4,
									'lper_4'	=> $lper_4,
									'lsub_5'	=> $lsub_5,
									'ldel_5'	=> $ldel_5,
									'latt_5'	=> $latt_5,
									'lper_5'	=> $lper_5,
									'lsub_6'	=> $lsub_6,
									'ldel_6'	=> $ldel_6,
									'latt_6'	=> $latt_6,
									'lper_6'	=> $lper_6,
									'lsub_7'	=> $lsub_7,
									'ldel_7'	=> $ldel_7,
									'latt_7'	=> $latt_7,
									'lper_7'	=> $lper_7,
									);
			
							
							$check_update = $this->Admin_model->UpdateExamForm($ref_id,'exam_form',$data,'exam_form_back',$data_back);
				
							/*echo $check_insert;*/
							if($check_update)
								redirect("preview_exam_form/$ref_id");
							else
								redirect("exam_form");
			
				
	}
	public function preview_exam_form($value)
	{
		$data['row'] = $this->Admin_model->Get_data_exam($value);
		$this->load->view('frontend/include/header');
		$this->load->view('frontend/preview_exam_form',$data);
		$this->load->view('frontend/include/footer');
	}
	public function get_admit($value)
	{
		$data['row'] = $this->Admin_model->Get_data_admit($value);
		$this->load->library('pdf');
		$this->load->view('frontend/admit_card_pdf',$data);	  
		$html = $this->output->get_output();
	    $this->dompdf->load_html($html);
	   	$this->dompdf->render();
	   	$ref_no = $data['row'][0]['ref_no'];
		$this->dompdf->stream($ref_no.".pdf");
		/*, array("Attachment" => false)*/
	}
	public function get_renewal_form($value='')
	{
		if($this->input->post('ref_no')!=''){
					$value=$this->input->post('ref_no');
					$mobile_no=$this->input->post('mobile_no');
					$data['row'] = $this->Admin_model->GetDataAND('renewal','ref_no',$value,'mobile_no',$mobile_no);
					if(empty($data['row']))
						redirect('student_renewal');
		}
		else{
				$data['row'] = $this->Admin_model->GetData('renewal','ref_no',$value);
		}
		$this->load->library('pdf');
		$this->load->view('frontend/renewal_pdf',$data);	  
		$html = $this->output->get_output();
	    $this->dompdf->load_html($html);
	   	$this->dompdf->render();
	   	$ref_no = $data['row'][0]['ref_no'];
		$this->dompdf->stream($ref_no.".pdf", array("Attachment" => false));
		/*, array("Attachment" => false)*/
	}
	public function get_admit_course($value,$value2)
	{
		$data['row'] = $this->Admin_model->Get_data_admit_course($value,$value2);
		$this->load->library('pdf');
		$this->load->view('frontend/admit_card_pdf_course',$data);	  
		$html = $this->output->get_output();
	    $this->dompdf->load_html($html);
	   	$this->dompdf->render();
	   	//$ref_no = $data['row'][0]['ref_no'];
		$this->dompdf->stream("admit_card.pdf", array("Attachment" => false));
		/*, array("Attachment" => false)*/
	}
	public function edit_exam_form($ref_id)
	{
		if($this->input->post('admission_stud')=='Edit'){
		$data['row'] = $this->Admin_model->Get_data_exam($ref_id);
		$this->load->view('frontend/include/header');
		$this->load->view('frontend/edit_exam_form',$data);
		$this->load->view('frontend/include/footer');
		}
		elseif($this->input->post('admission_stud')=='Continue')
		{
			redirect("success_exam_form/$ref_id");
		}
	}
	public function view_result(){
		$array = array('view'=>'view_result');
		$this->load->view('frontend/template',$array);
	}
	public function get_admit_card(){
		$array = array('view'=>'get_admit_card');
		$this->load->view('frontend/template',$array);
	}
	public function get_result()
	{
		$school_code = $this->input->post('school_code');
		$roll_no = $this->input->post('roll_no');
		$dob = $this->input->post('dob');
		$convertedDob = date("j/n/Y", strtotime($dob));
		$convertedDob2 = date("j/m/Y", strtotime($dob));
		$data['row'] = $this->Admin_model->GetDataJ2('t1.*,t2.*','student_result t1','student_marks t2',' t1.id=t2.student_result_id','t1.school_code',$school_code,'t1.roll_no',$roll_no,'t1.dob',$convertedDob,'t1.dob',$convertedDob2);
		//print_r($data['row']);
		//die;
		$this->load->view('frontend/include/header');
		$this->load->view('frontend/show_result',$data);
		$this->load->view('frontend/include/footer');
	}
	public function result_pdf()
	{
		$this->load->library('pdf');
		echo $school_code = $this->input->post('send_school_code');
		echo $roll_no = $this->input->post('send_roll_no');
		echo $dob = $this->input->post('send_dob');
		//die;
		$data['row'] = $this->Admin_model->GetDataJ('t1.*,t2.*','student_result t1','student_marks t2',' t1.id=t2.student_result_id','t1.school_code',$school_code,'t1.roll_no',$roll_no,'t1.dob',$dob);
		$this->load->view('frontend/result_pdf',$data);
	    $html = $this->output->get_output();
	    $this->dompdf->load_html($html); 
		//$customPaper = array(0,0,360,360);
	    $this->dompdf->load_html($html);
		//$this->dompdf->set_paper($customPaper);
	    $this->dompdf->render();
		$this->dompdf->stream("result.pdf", array("Attachment" => false));
	}
	public function show_admit_card()
	{
		$this->load->library('pdf');
		$course = $this->input->post('course');
		$id = $this->input->post('reg_no');
		$aadhar = $this->input->post('aadhar');
		$dob = $this->input->post('dob');
		$data['row'] = $this->Admin_model->GetData2('exam_form','course',$course,'dob',$dob,'aadhar',$aadhar,'id',$id);
		$this->load->view('frontend/admit_card_pdf',$data);
	    $html = $this->output->get_output();
	    $this->dompdf->load_html($html);
	   	$this->dompdf->render();
		$this->dompdf->stream("admit card.pdf", array("Attachment" => false));
	}
	public function send_contact_email()
	{
		//Load email library
        $this->load->library('email');
        //SMTP & mail configuration
        $config = array(
            'protocol'  => 'smtp',
            'smtp_host' => 'mail.jnrcranchi.com',
            'smtp_port' => 465,	//587for non ssl
            'smtp_user' => 'info@jnrcranchi.com',
            'smtp_pass' => 'I_Pj$72pF^~{',
            'mailtype'  => 'html',
            'charset'   => 'iso-8859-1'
        );
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $mobile = $this->input->post('mobile');
        $subject = $this->input->post('subject');
       	$message = $this->input->post('message');
        //Email content
        $htmlContent = '<h1>Query</h1>';
        $htmlContent .= '<p>Name: '.$Name.'</p>';
        $htmlContent .= '<p>Email ID: '.$email.'</p>';
        $htmlContent .= '<p>Mobile: '.$mobile.'</p>';
        $htmlContent .= '<p>Subject: '.$subject.'</p>';
        $htmlContent .= '<p>Message: '.$message.'</p>';
        $this->email->to('registrarjnrc@rediffmail.com');
        $this->email->to('firozakhter3@gmail.com');
        //$this->email->to('prashant1hitcs@gmail.com');
        //$this->email->to('jnrcranchi1@gmail.com');
        //$this->email->cc('prashant1hitcs@gmail.com');
        //$this->email->cc();
        $this->email->from('info@jnrcranchi.com','JNRC Ranchi');
        $this->email->subject($subject);
        $this->email->message($htmlContent);
        //$this->email->attach('http://jnrcranchi.com/uploads/notification/ash_banner.jpg');
        //$this->email->attach($file_path);
        //Send email
        if($this->email->send())
        {
        	echo "Email Sent";
        	$this->session->set_flashdata('data_add','Email has been sent Successfully.');
				redirect('contact');
        }
        else
        {echo "Not sent";
			redirect('');
		}
	}
}