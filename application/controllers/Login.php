<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');		
		$this->load->helper(array('form','url','cookie'));
		$this->load->helper(['url', 'form', 'captcha']); 
		$this->load->library('form_validation');
		$this->load->model('Login_model');
	}

	
	public function index()
	{
		$array = array('view'=>'index');
		$this->load->view('frontend/template',$array);
	}

    public function admin_login()
    {
        $captcha = $this->_generate_captcha();

        $data['captcha_img'] = $captcha['image'];

        $this->load->view('admin/admin_login', $data);
    }



/* ===============================
   LOGIN PROCESS
=============================== */


public function log()


{


    $username = trim($this->input->post('username', TRUE));
    $password = $this->input->post('password', TRUE);
    $captcha  = trim($this->input->post('captcha', TRUE));

    /* ---------- CAPTCHA ---------- */
    if (
        empty($captcha) ||
        !$this->session->userdata('captcha_word') ||
        strcasecmp($captcha, $this->session->userdata('captcha_word')) !== 0
    ) {
        $this->session->unset_userdata('captcha_word');
        $this->session->set_flashdata('error', 'Invalid CAPTCHA');
        redirect('adminjnrc');
    }

    /* ---------- PASSWORD POLICY ---------- */
    $strong_password = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';

    if (!preg_match($strong_password, $password)) {
        $this->session->set_flashdata(
            'error',
            'Password must be at least 8 characters and include uppercase, lowercase, number and special character'
        );
        redirect('adminjnrc');
    }

    /* ---------- USER CHECK ---------- */
    $where = [
        'username' => $username,
        'role'     => 'admin'
    ];

    $row = $this->Login_model->MatchUsername('users', $where);

    if ($row) {
        foreach ($row as $userdata) {

            $stored_password = $userdata['password'];

            if (
                password_verify($password, $stored_password) ||
                md5($password) === $stored_password
            ) {

                // Auto-upgrade MD5
                if (md5($password) === $stored_password) {
                    $this->db->where('id', $userdata['id'])
                             ->update('users', [
                                 'password' => password_hash($password, PASSWORD_DEFAULT)
                             ]);
                }

                $this->session->set_userdata([
                    'uid'         => $userdata['id'],
                    'email'       => $userdata['email'],
                    'username'    => $userdata['username'],
                    'first_name'  => $userdata['first_name'],
                    'last_name'   => $userdata['last_name'],
                    'loginstatus' => 1,
                    'role_admin'  => $userdata['role']
                ]);

                $this->session->unset_userdata('captcha_word');
                redirect('admin');
            }
        }
    }

    /* ---------- FAILED LOGIN ---------- */
    $this->session->unset_userdata('captcha_word');
    $this->session->set_flashdata('error', 'Invalid Username or Password');
    // redirect('adminjnrc');
}


/* ===============================
   CAPTCHA GENERATOR
=============================== */
private function _generate_captcha()
{
    $this->load->helper('captcha');

    $vals = [
        'word'      => substr(str_shuffle('ABCDEFGHJKLMNPQRSTUVWXYZ23456789'), 0, 6),
        'img_path'  => FCPATH . 'public_ftp/captcha/',
        'img_url'   => base_url('public_ftp/captcha/'),
        'img_width' => 160,
        'img_height'=> 50,
        'expiration'=> 300
    ];

    $cap = create_captcha($vals);

    if ($cap === FALSE) {
        log_message('error', 'CAPTCHA failed: ' . print_r($vals, true));
        show_error('CAPTCHA generation failed');
    }

    $this->session->set_userdata('captcha_word', $cap['word']);

    return $cap;
}



	
	public function logout()
	{
		$this->session->unset_userdata('uid');	
		$this->session->unset_userdata('email');	
		$this->session->unset_userdata('username');	
		$this->session->unset_userdata('loginstatus');	
		$this->session->unset_userdata('created');	
		$this->session->unset_userdata('first_name');	
		$this->session->unset_userdata('last_name');	
		$this->session->unset_userdata('role_admin');	
		$this->session->set_flashdata('logout','Logout Successfully');
		redirect('adminjnrc','refresh');
	}
	
}