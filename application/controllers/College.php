<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class College extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();	
		$this->load->database();
		$this->load->library('session');		
		$this->load->helper(array('form','url','cookie'));
		$this->load->library('form_validation');
		
		$this->load->model('College_model');
	}
	
	public function login_verification()
	{
		if($this->session->userdata('role_admin')==null)
		{
			redirect(base_url('adminjnrc'));
		}
	}
	
   public function college_list()
{
    $this->login_verification();

    // CSRF (for forms inside view)
    $data['csrf_name'] = $this->security->get_csrf_token_name();
    $data['csrf_hash'] = $this->security->get_csrf_hash();

    $data['row'] = $this->College_model->Get_College_List('college_list');
    $data['title'] = "College List";

    $this->load->view('admin/include/header', $data);
    $this->load->view('admin/include/sidebar');
    $this->load->view('admin/college_list', $data);
    $this->load->view('admin/include/footer');
}
public function save_school()
{
    $this->login_verification();
    date_default_timezone_set('Asia/Kolkata');

    $this->load->library('form_validation');

    /* ---------- STRICT VALIDATION ---------- */
    $this->form_validation->set_rules(
        'school_name',
        'School Name',
        'required|trim|regex_match[/^[a-zA-Z0-9 .,-]+$/]'
    );
    $this->form_validation->set_rules(
        'school_code',
        'School Code',
        'required|trim|regex_match[/^[a-zA-Z0-9_-]+$/]'
    );
    $this->form_validation->set_rules('seat', 'Seat', 'required|numeric');
    $this->form_validation->set_rules(
        'course_type',
        'Course Type',
        'required|in_list[ANM,GNM,BSC,PBSC,MSC]'
    );
    $this->form_validation->set_rules('email', 'Email', 'valid_email');
    $this->form_validation->set_rules(
        'phone',
        'Phone',
        'required|numeric|exact_length[10]'
    );
    $this->form_validation->set_rules(
        'address',
        'Address',
        'required|trim'
    );
    $this->form_validation->set_rules(
        'password',
        'Password',
        'required|min_length[6]'
    );

    if ($this->form_validation->run() === FALSE)
    {
        $this->session->set_flashdata('msg', 'danger');
        $this->session->set_flashdata('errmsg', validation_errors());
        redirect($_SERVER['HTTP_REFERER']);
    }

    /* ---------- CLEAN INPUT (BLOCK HTML + SCRIPT) ---------- */
    $school_name = strip_tags(
        $this->security->xss_clean($this->input->post('school_name', TRUE))
    );

    $school_code = strip_tags(
        $this->security->xss_clean($this->input->post('school_code', TRUE))
    );

    $address = strip_tags(
        $this->security->xss_clean($this->input->post('address', TRUE))
    );

    $plain_password = $this->input->post('password', TRUE);

    /* ---------- DATA ---------- */
    $data = array(
        'school_name' => $school_name,
        'school_code' => $school_code,
        'seat'        => (int)$this->input->post('seat', TRUE),
        'course_type' => $this->security->xss_clean($this->input->post('course_type', TRUE)),
        'email'       => $this->security->xss_clean($this->input->post('email', TRUE)),
        'phone'       => $this->security->xss_clean($this->input->post('phone', TRUE)),
        'address'     => $address,
        'addon_date'  => $this->security->xss_clean($this->input->post('date', TRUE)),

        /* 🔐 PASSWORD HANDLING */
        'password'  => password_hash($plain_password, PASSWORD_BCRYPT),

        /* ⚠️ NOT RECOMMENDED — ONLY IF REQUIRED */
        'show_pass' => $plain_password,

        'created' => date('Y-m-d H:i:s'),
        'ip'      => $this->input->ip_address()
    );

    if ($this->College_model->Insert_College_Details('college_list', $data))
    {
        $this->session->set_flashdata('msg', 'success');
        $this->session->set_flashdata('errmsg', 'New School Added Successfully');
    }
    else
    {
        $this->session->set_flashdata('msg', 'danger');
        $this->session->set_flashdata('errmsg', 'Insert Failed');
    }

    redirect($_SERVER['HTTP_REFERER']);
}



	
  public function edit_school()
{
    $this->login_verification();
    date_default_timezone_set('Asia/Kolkata');

    $this->load->library('form_validation');

    /* ---------- VALIDATION ---------- */
    $this->form_validation->set_rules(
        'edit_id',
        'ID',
        'required|numeric'
    );
    $this->form_validation->set_rules(
        'edit_school_name',
        'School Name',
        'required|trim|regex_match[/^[a-zA-Z0-9 .,-]+$/]'
    );
    $this->form_validation->set_rules(
        'edit_school_code',
        'School Code',
        'required|trim|regex_match[/^[a-zA-Z0-9_-]+$/]'
    );
    $this->form_validation->set_rules(
        'edit_seat',
        'Seat',
        'required|numeric'
    );
    $this->form_validation->set_rules(
        'edit_course_type',
        'Course Type',
        'required|in_list[ANM,GNM,BSC,PBSC,MSC]'
    );
    $this->form_validation->set_rules(
        'edit_email',
        'Email',
        'valid_email'
    );
    $this->form_validation->set_rules(
        'edit_phone',
        'Phone',
        'required|numeric|exact_length[10]'
    );
    $this->form_validation->set_rules(
        'edit_address',
        'Address',
        'required|trim'
    );

    if ($this->form_validation->run() === FALSE)
    {
        $this->session->set_flashdata('msg', 'danger');
        $this->session->set_flashdata('errmsg', validation_errors());
        redirect($_SERVER['HTTP_REFERER']);
    }

    $id = (int)$this->input->post('edit_id');

    /* ---------- CLEAN INPUT ---------- */
    $school_name = strip_tags(
        $this->security->xss_clean($this->input->post('edit_school_name', TRUE))
    );

    $school_code = strip_tags(
        $this->security->xss_clean($this->input->post('edit_school_code', TRUE))
    );

    $address = strip_tags(
        $this->security->xss_clean($this->input->post('edit_address', TRUE))
    );

    /* ---------- DATA ---------- */
    $data = array(
        'school_name' => $school_name,
        'school_code' => $school_code,
        'seat'        => (int)$this->input->post('edit_seat', TRUE),
        'course_type' => $this->security->xss_clean($this->input->post('edit_course_type', TRUE)),
        'email'       => $this->security->xss_clean($this->input->post('edit_email', TRUE)),
        'phone'       => $this->security->xss_clean($this->input->post('edit_phone', TRUE)),
        'address'     => $address,
        'addon_date'  => $this->security->xss_clean($this->input->post('date', TRUE)),
        'modified'    => date('Y-m-d H:i:s'),
        'ip'          => $this->input->ip_address()
    );

    /* ---------- PASSWORD UPDATE (OPTIONAL) ---------- */
    if (!empty($this->input->post('edit_password')))
    {
        $plain_password = $this->input->post('edit_password', TRUE);

        $data['password']  = password_hash($plain_password, PASSWORD_BCRYPT);
        $data['show_pass'] = $plain_password; // ⚠️ Not recommended (business decision)
    }

    if ($this->College_model->Update_College_Details('college_list', $data, $id))
    {
        $this->session->set_flashdata('msg', 'success');
        $this->session->set_flashdata('errmsg', 'School Details Updated Successfully');
    }
    else
    {
        $this->session->set_flashdata('msg', 'danger');
        $this->session->set_flashdata('errmsg', 'Update Failed');
    }

    redirect($_SERVER['HTTP_REFERER']);
}

	
    public function delete_school($value='')
	{
    	$this->login_verification();	
    	$id = $this->uri->segment(2);
    	$delete =  $this->College_model->Delete_College_Details('college_list','id',$id);
    	if($delete==true)
    	{
    		$_SESSION['msg']="success";
			$_SESSION['errmsg']="School Details Delete Successfully...";
			redirect($_SERVER['HTTP_REFERER']);
    	}
    	else
    	{
    		$_SESSION['msg']="danger";
			$_SESSION['errmsg']="School Details Delete Failed. Due To Internal Server Error";
			redirect($_SERVER['HTTP_REFERER']);
    	}  
    	
    }
	
	public function college_renewal()
{
    $this->login_verification();
    date_default_timezone_set('Asia/Kolkata');

    $data = array(
        'row'       => $this->College_model->Get_College_List('college_list'),
        'title'     => 'College Renewal',

        // CSRF
        'csrf_name' => $this->security->get_csrf_token_name(),
        'csrf_hash' => $this->security->get_csrf_hash()
    );

    $this->load->view('admin/include/header', $data);
    $this->load->view('admin/include/sidebar');
    $this->load->view('admin/college_renewal', $data);
    $this->load->view('admin/include/footer');
}

	
	public function update_renewal()
{
    $this->login_verification();
    date_default_timezone_set('Asia/Kolkata');

    /* ---------- FORM VALIDATION ---------- */
    $this->load->library('form_validation');

    $this->form_validation->set_rules('update_id', 'ID', 'required|numeric');
    $this->form_validation->set_rules('renewal_status', 'Renewal Status', 'required');
    $this->form_validation->set_rules('renewal_date', 'Renewal Date', 'required');
    $this->form_validation->set_rules('renewal_expiry_date', 'Expiry Date', 'required');

    if ($this->form_validation->run() === FALSE) {
        $this->session->set_flashdata('msg', 'danger');
        $this->session->set_flashdata('errmsg', validation_errors());
        redirect($_SERVER['HTTP_REFERER']);
    }

    /* ---------- FILE UPLOAD ---------- */
    $renewal_certificate = $this->input->post('old_renewal_ceritificate', TRUE);

    if (!empty($_FILES['renewal_ceritificate']['name'])) {

        $config = array(
            'upload_path'   => './uploads_affliation/certificate/',
            'allowed_types' => 'pdf|png|jpg|jpeg',
            'max_size'      => 2048,
            'encrypt_name'  => TRUE
        );

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('renewal_ceritificate')) {
            $this->session->set_flashdata('msg', 'warning');
            $this->session->set_flashdata('errmsg', $this->upload->display_errors());
            redirect($_SERVER['HTTP_REFERER']);
        }

        $upload_data = $this->upload->data();
        $renewal_certificate = $upload_data['file_name'];
    }

    /* ---------- DATA ---------- */
    $id = (int)$this->input->post('update_id', TRUE);

    $data = array(
        'renewal_status'        => $this->security->xss_clean($this->input->post('renewal_status', TRUE)),
        'renewal_date'          => $this->security->xss_clean($this->input->post('renewal_date', TRUE)),
        'renewal_expiry_date'   => $this->security->xss_clean($this->input->post('renewal_expiry_date', TRUE)),
        'renewal_ceritificate'  => $renewal_certificate,
        'modified'              => date('Y-m-d H:i:s'),
        'ip'                    => $this->input->ip_address()
    );

    if ($this->College_model->Update_College_Details('college_list', $data, $id)) {
        $this->session->set_flashdata('msg', 'success');
        $this->session->set_flashdata('errmsg', 'College Renewal Details Updated Successfully');
    } else {
        $this->session->set_flashdata('msg', 'danger');
        $this->session->set_flashdata('errmsg', 'Update Failed');
    }

    redirect($_SERVER['HTTP_REFERER']);
}

}