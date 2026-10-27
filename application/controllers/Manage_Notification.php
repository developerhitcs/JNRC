<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Manage_Notification extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();	
		$this->load->database();
		$this->load->library('session');		
		$this->load->helper(array('form','url','cookie'));
		$this->load->library('form_validation');
		
		$this->load->model('Manage_Notification_model');
	}
	
	public function login_verification()
	{
		if($this->session->userdata('role_admin')==null)
		{
			redirect(base_url('adminjnrc'));
		}
	}
	
	public function documents()
	{
		$this->login_verification();		
		$data['title'] = "Documents";
		$data['row'] = $this->Manage_Notification_model->Get_Data('documents');
		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/documents');
		$this->load->view('admin/include/footer');		
	}
	
	public function save_document()
	{
		$this->login_verification();
		
		$title = $this->input->post('title');
		$document = $this->input->post('document');
		$position = $this->input->post('position');
		
		$config['upload_path']='./uploads/document/';
		$config['allowed_types']='pdf|png|jpg|jpeg';
		$config['overwrite'] = TRUE;
		$config['max_size'] = 2048000;
		 
		$this->load->library('upload',$config);
		if($this->upload->do_upload('document'))
		{
			$data['uploaddata']=$this->upload->data();
			foreach($data as $d)
			{
				$document='uploads/document/'.$d['file_name'];
			}
		}
		else
		{
			$_SESSION['msg']="warning";
			$_SESSION['errmsg']="Check Document File Details .";
			redirect($_SERVER['HTTP_REFERER']);
		}
		
		$data = array('title' => $title, 'document' => $document, 'position' => $position);
		
		$check_insert = $this->Manage_Notification_model->Submit_Data('documents',$data);
		if($check_insert==true)		
		{
			$_SESSION['msg']="success";
			$_SESSION['errmsg']="New Document Upload Successfully...";
			redirect($_SERVER['HTTP_REFERER']);
		}
		else
		{
			$_SESSION['msg']="danger";
			$_SESSION['errmsg']="New Document Upload Failed. Due To Internal Server Error";
			redirect($_SERVER['HTTP_REFERER']);
		}		
	}
	
	public function edit_document()
	{
		$this->login_verification();
		$id = $this->input->post('edit_id');
		$title = $this->input->post('edit_title');
		$position = $this->input->post('edit_position');
		$config['upload_path'] = 'uploads/document/'; 
		$config['allowed_types'] = 'jpg|png|jpeg|pdf';
		$config['max_size'] = '1024000';
		$this->load->library('upload',$config);
		if (!empty($_FILES['document']['name'])) 
		{		
			if($this->upload->do_upload('document')==true)
			{
				$data['uploaddata']=$this->upload->data();
				foreach($data as $d)
				{
					$document='uploads/document/'.$d['file_name'];
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
			$document=$this->input->post('old_document');
		}
		$data = array('title' => $title,'position' => $position,'document'=>$document);
		
		$check_update = $this->Manage_Notification_model->Update_Details('documents',$data,$id);
		if($check_update==true)		
		{
			$_SESSION['msg']="success";
			$_SESSION['errmsg']="Documents Update Successfully...";
			redirect($_SERVER['HTTP_REFERER']);
		}
		else
		{
			$_SESSION['msg']="danger";
			$_SESSION['errmsg']="Documents Update Failed. Due To Internal Server Error";
			redirect($_SERVER['HTTP_REFERER']);
		}	
		
	}
	public function delete_document($value='')
	{
    	$this->login_verification();
		$id = $this->uri->segment(2);
    	$check_delete =  $this->Manage_Notification_model->Delete_Details('documents','id',$id);
		if($check_delete==true)		
		{
			$_SESSION['msg']="success";
			$_SESSION['errmsg']="Documents Delete Successfully...";
			redirect($_SERVER['HTTP_REFERER']);
		}
		else
		{
			$_SESSION['msg']="danger";
			$_SESSION['errmsg']="Documents Delete Failed. Due To Internal Server Error";
			redirect($_SERVER['HTTP_REFERER']);
		}  
    }
	
	
    public function upload_gallery()
    {
        $this->login_verification();

        $data = [
            'title'     => 'Gallery',
            'row'       => $this->Manage_Notification_model->Get_Data('gallery'),

            // CSRF
            'csrf_name' => $this->security->get_csrf_token_name(),
            'csrf_hash' => $this->security->get_csrf_hash()
        ];

        $this->load->view('admin/include/header', $data);
        $this->load->view('admin/include/sidebar');
        $this->load->view('admin/upload_gallery', $data);
        $this->load->view('admin/include/footer');
    }

    /* ===============================
       SAVE GALLERY
    =============================== */
   public function save_upload_gallery()
{
    $this->login_verification();
    date_default_timezone_set('Asia/Kolkata');

    /* ---------- CSRF IS AUTO-HANDLED BY CI ---------- */

    /* ---------- FORM VALIDATION ---------- */
    $this->form_validation->set_rules(
        'title',
        'Image Title',
        'required|trim|min_length[3]|max_length[150]|regex_match[/^[a-zA-Z0-9\s\-\_\.]+$/]'
    );

    if ($this->form_validation->run() === FALSE) {
        $this->session->set_flashdata('msg', 'danger');
        $this->session->set_flashdata('errmsg', strip_tags(validation_errors()));
        redirect($_SERVER['HTTP_REFERER']);
    }

    /* ---------- FILE REQUIRED ---------- */
    if (empty($_FILES['img1']['name'])) {
        $this->session->set_flashdata('msg', 'danger');
        $this->session->set_flashdata('errmsg', 'Image file is required');
        redirect($_SERVER['HTTP_REFERER']);
    }

    /* ---------- UPLOAD PATH ---------- */
    $upload_path = FCPATH . 'uploads/gallery/';

    if (!is_dir($upload_path)) {
        mkdir($upload_path, 0755, TRUE);
    }

    /* ---------- UPLOAD CONFIG ---------- */
    $config = [
        'upload_path'      => $upload_path,
        'allowed_types'    => 'jpg|jpeg|png|gif|pdf|doc|docx',
        'max_size'         => 1024, // 1MB
        'encrypt_name'     => TRUE,
        'file_ext_tolower' => TRUE,
        'remove_spaces'    => TRUE
    ];

    $this->load->library('upload', $config);

    if (!$this->upload->do_upload('img1')) {
        $this->session->set_flashdata('msg', 'danger');
        $this->session->set_flashdata('errmsg', strip_tags($this->upload->display_errors()));
        redirect($_SERVER['HTTP_REFERER']);
    }

    $upload_data = $this->upload->data();

    /* ---------- EXTRA FILE SECURITY ---------- */
    $allowed_mimes = [
        'image/jpeg',
        'image/png',
        'image/gif',
        'application/pdf',
        'application/msword',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
    ];

    if (!in_array($upload_data['file_type'], $allowed_mimes)) {
        unlink($upload_data['full_path']);
        $this->session->set_flashdata('msg', 'danger');
        $this->session->set_flashdata('errmsg', 'Invalid file type detected');
        redirect($_SERVER['HTTP_REFERER']);
    }

    /* ---------- SANITIZED DATA ---------- */
    $data = [
        'title'   => $this->security->xss_clean(
            trim($this->input->post('title', TRUE))
        ),
        'img1'    => 'uploads/gallery/' . basename($upload_data['file_name']),
        'created' => date('Y-m-d H:i:s'),
        'ip'      => $this->input->ip_address()
    ];

    /* ---------- DB INSERT ---------- */
    if ($this->Manage_Notification_model->Submit_Data('gallery', $data)) {
        $this->session->set_flashdata('msg', 'success');
        $this->session->set_flashdata('errmsg', 'Gallery Image Uploaded Successfully');
    } else {
        $this->session->set_flashdata('msg', 'danger');
        $this->session->set_flashdata('errmsg', 'Upload Failed');
    }

    redirect($_SERVER['HTTP_REFERER']);
}

	
	public function delete_gallery($value='')
	{
		$this->login_verification();
    	$id = $this->uri->segment(2);
    	$check_delete =  $this->Manage_Notification_model->Delete_Details('gallery','id',$id);
    	if($check_delete==true)		
		{
			$_SESSION['msg']="success";
			$_SESSION['errmsg']="Gallery Image Delete Successfully...";
			redirect($_SERVER['HTTP_REFERER']);
		}
		else
		{
			$_SESSION['msg']="danger";
			$_SESSION['errmsg']="Gallery Image Delete Failed. Due To Internal Server Error";
			redirect($_SERVER['HTTP_REFERER']);
		}  		
    }
	public function notification()
	{
		$this->login_verification();
		$data['title'] = "Dashboard";
		$data['row'] = $this->Manage_Notification_model->Get_Data('notification');
		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/include/sidebar');
		$this->load->view('admin/notifications');
		$this->load->view('admin/include/footer');		
	}
	
	public function save_notification()
	{
		$this->login_verification();			
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
		$check_insert = $this->Manage_Notification_model->Submit_Data('notification',$data);
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
	public function edit_notification()
	{
		$this->login_verification();			
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
		$check_insert = $this->Manage_Notification_model->Update_Details('notification',$data,$id);
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
	public function delete_notif($value='')
	{
		$this->login_verification();
    	$id = $this->uri->segment(2);
    	$res =  $this->Manage_Notification_model->Delete_Details('notification','id',$id);
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
}