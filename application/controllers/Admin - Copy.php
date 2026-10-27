<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Admin_model');
	}
	public function index()
	{
		if($_SESSION['role_admin']=='admin')
		{
			$data['title'] = "Dashboard";
			$data['row'] = $this->Admin_model->GetData('college_list');
			$data['exam_form'] = $this->Admin_model->GetData('exam_form');
			$data['renewal'] = $this->Admin_model->GetDataCount('renewal');
			$this->load->view('admin/include/header',$data);
			$this->load->view('admin/include/sidebar');
			$this->load->view('admin/dashboard');
			$this->load->view('admin/include/footer');
		}
		else{
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
		 else{
		 	$_SESSION['role_admin']='';
		 	redirect('login_page','refresh');
		 }	
	}
	public function prashant_sql()
	{
		$data['title'] = "Manage SQL";
		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/include/sidebar');
		//$this->load->view('admin/include/right_sidebar');
		$this->load->view('admin/manage_sql');
		$this->load->view('admin/include/footer');
	}
	public function run_query()
	{
			$data['title'] = "Manage SQL";
			$SQL = $this->input->post('query_text');
			$query = $this->db->query($SQL);
			$data['result'] = $query->result_array();
			//echo '<pre>';
			//print_r($result);
			//echo '</pre>';
			$this->load->view('admin/include/header',$data);
			$this->load->view('admin/include/sidebar');
			$this->load->view('admin/manage_sql');
			$this->load->view('admin/include/footer');
	}
	public function maps()
	{
		$array = array('view'=>'maps');
		$this->load->view('admin/template',$array);
	}
	public function notification()
	{
		if($_SESSION['role_admin']=='admin')
		{
			$data['title'] = "Dashboard";
			$data['row'] = $this->Admin_model->GetData('notification');
			$this->load->view('admin/include/header',$data);
			$this->load->view('admin/include/sidebar');
			$this->load->view('admin/notifications');
			$this->load->view('admin/include/footer');
		}
		else{
			$_SESSION['role_admin']='';
			redirect('adminjnrc','refresh');
		}
	}
	public function documents()
	{
		if($_SESSION['role_admin']=='admin')
		{
			$data['title'] = "Documents";
			$data['row'] = $this->Admin_model->GetData('documents');
			$this->load->view('admin/include/header',$data);
			$this->load->view('admin/include/sidebar');
			$this->load->view('admin/documents');
			$this->load->view('admin/include/footer');
		}
		else{
			$_SESSION['role_admin']='';
			redirect('adminjnrc','refresh');
		}
	}
	public function icons()
	{
		$array = array('view'=>'icons');
		$this->load->view('admin/template',$array);
	}
	public function table()
	{
		$array = array('view'=>'table');
		$this->load->view('admin/template',$array);
	}
	public function typography()
	{
		$array = array('view'=>'typography');
		$this->load->view('admin/template',$array);
	}
	public function upgrade()
	{
		$array = array('view'=>'upgrade');
		$this->load->view('admin/template',$array);
	}
	public function user()
	{
		$array = array('view'=>'user');
		$this->load->view('admin/template',$array);
	}
	public function save_notification()
	{
		if($_SESSION['role_admin']=='admin')
		{			
			$config['upload_path'] = 'uploads/notification/'; 
			$config['allowed_types'] = 'pdf|csv|gif|jpg|png';
			$config['overwrite'] = true;		
			$config['max_size'] = '2048000';
			$this->load->library('upload',$config);
			if($this->upload->do_upload('file1'))
			{
				$data['uploaddata']=$this->upload->data();
				foreach($data as $d)
				{
					$notification_file=$d['file_name'];
				}
			}
			else
			{
				redirect($_SERVER['HTTP_REFERER']);
			}
			$data = array(
			'notification' => $this->input->post('notification'),
			'file1' => $notification_file,
			'status' => $this->input->post('status'),
			'dash_status' => $this->input->post('ds_status')
			);
			$check_insert = $this->Admin_model->insert_notification_data('notification',$data);
			if($check_insert==true)
			{
				$_SESSION['msg']="success";
				$_SESSION['errmsg']="Notification Upload Successfully";
				redirect($_SERVER['HTTP_REFERER']);
			}
			else
			{
				$_SESSION['msg']="danger";
				$_SESSION['errmsg']="Notification Upload Failed";
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
		else
		{
			$_SESSION['role_admin']='';
			redirect('adminjnrc','refresh');
		}
	}
    public function delete_notif($value='')
	{
    	$id = $this->uri->segment(2);
    	$res =  $this->Admin_model->delete_row('notification','id',$id);
		if($res==true)
		{
			$_SESSION['msg']="success";
			$_SESSION['errmsg']="Notification Delete Successfully";
			redirect($_SERVER['HTTP_REFERER']);
		}
		else
		{
			$_SESSION['msg']="danger";
			$_SESSION['errmsg']="Notification Delete Failed";
			redirect($_SERVER['HTTP_REFERER']);
		}
    }
	public function save_document()
	{
		if($_SESSION['role_admin']=='admin')
		{
		$title = $this->input->post('title');
		$document = $this->input->post('document');
		$position = $this->input->post('position');
		$data = array('title' => $title, 'document' => $document, 'position' => $position);
		$config['upload_path'] = 'uploads/document/'; 
						$config['allowed_types'] = 'pdf|csv|gif|jpg|png|jpeg|docx|doc';
						$config['max_size'] = '2048000';
						$this->load->library('upload',$config);
						$this->upload->initialize($config);
						if ($this->upload->do_upload('document')) {
				            $datas = $this->upload->data();
				          	$document = 'uploads/document/' . $datas['file_name'];
				            $data['document'] = $document;
				        }
				        else{
				            echo "cant upload file";
				            echo $this->upload->display_errors();
				            die;
				        }
		$check_insert = $this->Admin_model->insert_data('documents',$data);
		if($check_insert){
			redirect('documents');
		}
		else{
			redirect('table');
		}
		}
		else{
			$_SESSION['role_admin']='';
			redirect('adminjnrc','refresh');
		}
	}
	public function edit_notification()
	{
		if($_SESSION['role_admin']=='admin')
		{			
			$config['upload_path'] = 'uploads/notification/'; 
			$config['allowed_types'] = 'pdf|csv|gif|jpg|png';
			$config['overwrite'] = true;		
			$config['max_size'] = '2048000';
			$this->load->library('upload',$config);
			if ( ! empty($_FILES['file1']['name']))
			{			 
				if($this->upload->do_upload('file1'))
				{
					$data['uploaddata']=$this->upload->data();
					foreach($data as $d)
					{
						$notification_file=$d['file_name'];
					}
				}
				else
				{
					$_SESSION['msg']="warning";
					$_SESSION['errmsg']="Check Player Image File Details . Image File Format Must Be png , jpg , jpeg. ";
					redirect($_SERVER['HTTP_REFERER']);
				}
			}
			else
			{
				$notification_file=$this->input->post('old_file1');
			}
			$data = array(
			'notification' => $this->input->post('notification'),
			'file1' => $notification_file,
			'status' => $this->input->post('status'),
			'dash_status' => $this->input->post('ds_status')
			);
			$id=$this->input->post('up_id');
			// print_r($data);
			// die;
			$check_insert = $this->Admin_model->Update_Notification_Data('notification',$data,$id);
			if($check_insert==true)
			{
				$_SESSION['msg']="success";
				$_SESSION['errmsg']="Notification Update Successfully";
				redirect($_SERVER['HTTP_REFERER']);
			}
			else
			{
				$_SESSION['msg']="danger";
				$_SESSION['errmsg']="Notification Update Failed";
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
		else
		{
			$_SESSION['role_admin']='';
			redirect('adminjnrc','refresh');
		}
	}
	public function edit_document()
	{
		if($_SESSION['role_admin']=='admin')
		{
		$id = $this->input->post('edit_id');
		$title = $this->input->post('edit_title');
		$position = $this->input->post('edit_position');
		$data = array('title' => $title,'position' => $position);
		$check_update = $this->Admin_model->UpdateNotif('documents',$data,$id);
			if($check_update)
			{
				$this->session->set_flashdata('data_add','Data has been Successfully Added.');
				redirect('documents');
			}
			else
			{
				redirect('');
			}
		}
		else{
			$_SESSION['role_admin']='';
			redirect('adminjnrc','refresh');
		}
	}
	public function upload_gallery()
	{
		if($_SESSION['role_admin']=='admin')
		{
		$data['title'] = "Gallery";
		$data['row'] = $this->Admin_model->GetData('gallery');
		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/upload_gallery',$data);
		$this->load->view('admin/include/footer');	
		}
		else{
			$_SESSION['role_admin']='';
			redirect('adminjnrc','refresh');
		}
	}
	public function save_upload_gallery()
	{
		if($_SESSION['role_admin']=='admin')
		{
			$data['title'] = $this->input->post('title');
		$config['upload_path'] = 'uploads/gallery/'; 
		$config['allowed_types'] = 'gif|jpg|jpeg|png|doc|docx|pdf';
		$config['max_size'] = '1024';
						$this->load->library('upload',$config);
						if ($this->upload->do_upload('img1')) {	
					        $datas = $this->upload->data();
				          	$img1 = 'uploads/gallery/' . $datas['file_name'];
				            $data['img1'] = $img1;
					      }
			$check_insert = $this->Admin_model->insert_data('gallery',$data);
			if($check_insert)
			{
				$this->session->set_flashdata('data_add','Image Successfully Uploaded.');
				redirect('upload_gallery');
			}
			else
			{
				redirect('dashboard');
			}
		}
		else{
			$_SESSION['role_admin']='';
			redirect('adminjnrc','refresh');
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
    public function notif_status() {
        echo $id = $this->input->post('id');
        echo $status = $this->input->post('status');
        $data = array(
            'status' => '1',
        );
        $this->Admin_model->UpdateNotif('notification', $data, $id);
    }
    public function notif_status_off() {
        echo $id = $this->input->post('id');
        echo $status = $this->input->post('status');
        $data = array(
            'status' => '0',
        );
        $this->Admin_model->UpdateNotif('notification', $data, $id);
    }
    public function dash_status() {
        echo $id = $this->input->post('id');
        //$status = $this->input->post('status');
        $data = array(
            'dash_status' => '1',
        );
         $this->Admin_model->UpdateNotif('notification', $data, $id);
    }
    public function dash_status_off() {
        echo $id = $this->input->post('id');
        echo $status = $this->input->post('status');
        $data = array(
            'dash_status' => '0',
        );
        $this->Admin_model->UpdateNotif('notification', $data, $id);
    }
    public function document_status() {
        echo $id = $this->input->post('id');
        echo $status = $this->input->post('status');
        $data = array(
            'status' => '1',
        );
        $this->Admin_model->update('documents', $data, $id);
    }
    public function document_status_off() {
        echo $id = $this->input->post('id');
        echo $status = $this->input->post('status');
        $data = array(
            'status' => '0',
        );
        $this->Admin_model->update('documents', $data, $id);
    }
    public function delete_gallery($value=''){
    	$id = $this->uri->segment(2);
    	$data['row'] =  $this->Admin_model->delete_row('gallery','id',$id);
    	redirect("upload_gallery");	
    }
    public function delete_renewal($value=''){
    	$id = $this->uri->segment(2);
    	$data['row'] =  $this->Admin_model->delete_row('renewal','id',$id);
    	redirect("admin_view_renewal");	
    }
    public function delete_document($value=''){
    	if($_SESSION['role_admin']=='admin')
		{
    	$id = $this->uri->segment(2);
    	$data['row'] =  $this->Admin_model->delete_row('documents','id',$id);
    	redirect("documents");	
    	}
		else{
			$_SESSION['role_admin']='';
			redirect('adminjnrc','refresh');
		}
    }
    public function college_list(){
    	if($_SESSION['role_admin']=='admin')
		{
    	if($this->input->post('school_type'))
    	{
    		$school_type = $this->input->post('school_type');
    		if($school_type=='anm_school')
    		{
    			$data['row'] = $this->Admin_model->GetData4('college_list','course_type','ANM_new','ANM_renew');	
    		} 
    		elseif($school_type=='gnm_school')
    		{
    			$data['row'] = $this->Admin_model->GetData4('college_list','course_type','GNM_new','GNM_renew');	
    		} 
    		else{
    			$data['row'] = $this->Admin_model->GetData4('college_list');	
    		}
    	}
    	else{
    		$data['row'] = $this->Admin_model->GetData4('college_list');
		}
		$data['title'] = "College List";
		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/college_list');
		$this->load->view('admin/include/footer');
		}
		else{
			$_SESSION['role_admin']='';
			redirect('adminjnrc','refresh');
		}
    }
    public function save_school(){
    	if($_SESSION['role_admin']=='admin')
		{
		date_default_timezone_set('Asia/Kolkata');
    	$school_name = $this->input->post('school_name');
    	$school_code = $this->input->post('school_code');
    	$address = $this->input->post('address');
    	$course_type = $this->input->post('course_type');
    	$seat = $this->input->post('seat');
    	$phone = $this->input->post('phone');
    	$password = $this->input->post('password');
    	$ip = $_SERVER['REMOTE_ADDR'];
    	$data = array(
    		'school_name' => $school_name,
    		'school_code' => $school_code,
    		'address' => $address,
    		'course_type' => $course_type,
    		'seat' => $seat,
    		'phone' => $phone,
    		'password' => $password,
    		'created'=> date("Y-m-d  h:i:s A"),
    		'ip'=> $ip
    		);
	    	$check_insert = $this->Admin_model->insert_data('college_list',$data);
	    	if($check_insert)
	    	{
	    		redirect('college_list');
	    	}
	    	else
	    	{
	    		redirect('dashboard');
	    	}
    	}
		else{
			$_SESSION['role_admin']='';
			redirect('adminjnrc','refresh');
		}
    }
    public function edit_school(){
    	if($_SESSION['role_admin']=='admin')
		{
		date_default_timezone_set('Asia/Kolkata');
    	$id = $this->input->post('edit_id');
    	$school_name = $this->input->post('edit_school_name');
    	$school_code = $this->input->post('edit_school_code');
    	$address = $this->input->post('edit_address');
    	$course_type = $this->input->post('edit_course_type');
    	$seat = $this->input->post('edit_seat');
    	$email = $this->input->post('edit_email');
    	$phone = $this->input->post('edit_phone');
    	$password = $this->input->post('edit_password');
    	$ip = $_SERVER['REMOTE_ADDR'];
    	$data = array(
    		'school_name' => $school_name,
    		'school_code' => $school_code,
    		'address' => $address,
    		'course_type' => $course_type,
    		'seat' => $seat,
    		'email' => $email,
    		'phone' => $phone,
    		'password' => md5($password),
    		'show_pass' => $password,
    		'modified'=> date("Y-m-d  h:i:s A"),
    		'ip'=> $ip
    		);
    	$check_update = $this->Admin_model->UpdateNotif('college_list',$data,$id);
    	if($check_update)
    	{
    		redirect('college_list');
    	}
    	else
    	{
    		redirect('dashboard');
    	}
    	}
		else{
			$_SESSION['role_admin']='';
			redirect('adminjnrc','refresh');
		}
    }
    public function delete_school($value=''){
    	if($_SESSION['role_admin']=='admin')
		{
    	$id = $this->uri->segment(2);
    	$data['row'] =  $this->Admin_model->delete_row('college_list','id',$id);
    	redirect("college_list");
    	}
		else{
			$_SESSION['role_admin']='';
			redirect('adminjnrc','refresh');
		}	
    }
	public function admin_view_exam_form()
	{
		if($_SESSION['role_admin']=='admin')
		{
			if($this->input->post('submit')=='Show All')
			{
				$data['row'] = $this->Admin_model->GetDataDesc('exam_form');
			}
			elseif($this->input->post('submit')=='Search') 
			{
				if($this->input->post('course_type') OR $this->input->post('school_code'))
				{
					$course_type = $this->input->post('course_type');
					$school_code = $this->input->post('school_code');
					if($course_type=='anm_year_1')
					{
						$data['row'] = $this->Admin_model->GetData3('anm_year_1',$school_code);	
					}
					elseif($course_type=='anm_year_2')
					{
						$data['row'] = $this->Admin_model->GetData3('anm_year_2',$school_code);
					}
					elseif($course_type=='gnm_year_1')
					{
						$data['row'] = $this->Admin_model->GetData3('gnm_year_1',$school_code);
					}					
					elseif($course_type=='gnm_year_2')
					{
						$data['row'] = $this->Admin_model->GetData3('gnm_year_2',$school_code);	
					}
					elseif($course_type=='gnm_year_3')
					{
						$data['row'] = $this->Admin_model->GetData3('gnm_year_3',$school_code);	
					}
					else
					{
						$data['row'] = $this->Admin_model->GetData3('',$school_code);
					}
				}
			}	
			elseif($this->input->post('submit')=='Get Admit Card') 
			{
				if($this->input->post('course_type') OR $this->input->post('school_code'))
				{
					$course_type = $this->input->post('course_type');
					$school_code = $this->input->post('school_code');
					$this->get_admit_course($course_type,$school_code);	
				}
			}			
			else
			{
				$data['row'] = $this->Admin_model->GetDataLast50('exam_form');
				$data['code'] = $this->Admin_model->GetDistinct('exam_form','issue_by');
				$data['title'] = "Exam Form";
				$this->load->view('admin/include/header',$data);
				$this->load->view('admin/include/sidebar');
				$this->load->view('admin/admin_exam_form');
				$this->load->view('admin/include/footer');
			}
		}
		else
		{
			$_SESSION['role_admin']='';
			redirect('adminjnrc','refresh');
		} 
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
    public function test_show_all(){
    }
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
	    	$check_update = $this->Admin_model->Update('exam_form_back',$data,$ref_id,'ref_id');
	    	if($check_update)
	    	{
	    		redirect('admin_view_exam_form');
	    	}
	    	else
	    	{
	    		redirect('dashboard');
	    	}
		}
		else{
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
		else{
			$_SESSION['role_admin']='';
			redirect('adminjnrc','refresh');
		}
    }
    public function fetch_course()
    {
    	$school_code = $this->input->post('school_code');
		$data = $this->Admin_model->GetDataSelected('course_type','college_list','school_code',$school_code);
		echo "<option value=''>Show All</option>";
		foreach($data as $value)
		{
			//echo "<option value='".$value['id']."'>".$value['block']."</option>";
			//echo $value['course_type'];
			if($value['course_type']=='ANM_renew' or $value['course_type']=='ANM_new')
			{
				echo "<option value='anm_year_1'>ANM 1st Year</option>";
				echo "<option value='anm_year_2'>ANM 2nd Year</option>";
			}
			elseif ($value['course_type']=='GNM_renew' or $value['course_type']=='GNM_new') 
			{
				echo "<option value='gnm_year_1'>GNM 1st Year</option>";
				echo "<option value='gnm_year_2'>GNM 2nd Year</option>";
				echo "<option value='gnm_year_3'>GNM 3rd Year</option>";
			}
		}
		//echo "hii prashant";
    }
    public function admin_view_result(){
    	if($_SESSION['role_admin']=='admin')
		{
    	if($this->input->post('session_year'))
    	{
    		 $session_year = $this->input->post('session_year');
    		 $school_code = $this->input->post('school_code');
    		 $course_type = $this->input->post('course_type');
    		 if($course_type=='')
    		 {
    		 	$data['row'] = $this->Admin_model->GetDataJ('t1.*,t2.*','student_result t1','student_marks t2',' t1.id=t2.student_result_id','t1.school_code',$school_code);
    		 }
    		 else{
    			$data['row'] = $this->Admin_model->GetDataJ('t1.*,t2.*','student_result t1','student_marks t2',' t1.id=t2.student_result_id','t1.school_code',$school_code,'t2.year',$course_type);
    			}
    	}
    	else{
			$data['row'] = $this->Admin_model->GetDataJ('t1.*,t2.*','student_result t1','student_marks t2',' t1.id=t2.student_result_id','t1.school_code','RIM');
		}
			$data['code'] = $this->Admin_model->GetData('college_list');
			$data['title'] = "Result";
			$this->load->view('admin/include/header',$data);
			$this->load->view('admin/include/sidebar');
			$this->load->view('admin/admin_view_result');
			$this->load->view('admin/include/footer');
		//} 
		}
		else{
			$_SESSION['role_admin']='';
			redirect('adminjnrc','refresh');
		}
    }
    public function admin_view_renewal(){
    	if($_SESSION['role_admin']=='admin')
		{
		$search_by = $this->input->post('search_by');
		$value = $this->input->post('value');
		if($search_by=='')	
			$data['row'] = $this->Admin_model->GetDataDesc2('renewal','','',50);
		elseif($search_by=='show_all')	
			$data['row'] = $this->Admin_model->GetDataDesc2('renewal');
		else
			$data['row'] = $this->Admin_model->GetData('renewal',$search_by,$value);
		$data['title'] = "Renewal";
		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/admin_view_renewal');
		$this->load->view('admin/include/footer'); 
		}
		else{
			$_SESSION['role_admin']='';
			redirect('adminjnrc','refresh');
		}
    }
    public function admin_view_registration(){
    	if($_SESSION['role_admin']=='admin')
		{
		$data['row'] = $this->Admin_model->GetData('student_detail');
		$data['title'] = "Registration";
		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/admin_view_registration',$data);
		$this->load->view('admin/include/footer'); 
		}
		else{
			$_SESSION['role_admin']='';
			redirect('adminjnrc','refresh');
		}
    }
    public function send_test_email()
	{
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
        $Name = $this->input->post('name');
        $email = $this->input->post('mail_id');
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
}