<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
		$this->load->model('Dashboard_model');
		$this->load->model('Affiliation_model');
	}
	public function index()
	{
		$data['row'] = $this->Dashboard_model->Get_notification_data('notification','status','Active');
		$this->load->view('frontend/include/header');
		$this->load->view('frontend/index',$data);
		$this->load->view('frontend/include/footer');
	}
	
	public function registration()
	{
		$array = array('view'=>'registration');
		$this->load->view('frontend/template',$array);
	}
	public function institution()
	{
		
		$anm_new= $this->Dashboard_model->Get_Institution_Data('college_list','course_type','ANM');
		$data['anm_new'] = $anm_new;
		$data['anm']=$this->db->affected_rows($anm_new);	
		
		$gnm_new = $this->Dashboard_model->Get_Institution_Data('college_list','course_type','GNM');
		$data['gnm_new'] = $gnm_new;
		$data['gnm']=$this->db->affected_rows($gnm_new);	
		
		$basic_bsc = $this->Dashboard_model->Get_Institution_Data('college_list','course_type','BSC');
		$data['basic_bsc'] = $basic_bsc;
		$data['bsc']=$this->db->affected_rows($basic_bsc);
		
		$post_basic_bsc = $this->Dashboard_model->Get_Institution_Data('college_list','course_type','PBSC');
		$data['post_basic_bsc'] = $post_basic_bsc;
		$data['pbsc']=$this->db->affected_rows($post_basic_bsc);
		
		$msc = $this->Dashboard_model->Get_Institution_Data('college_list','course_type','MSC');
		$data['msc'] = $msc;
		$data['ms']=$this->db->affected_rows($msc);
		
		$this->load->view('frontend/include/header');
		$this->load->view('frontend/institution',$data);
		$this->load->view('frontend/include/footer');
	}
	
	
	public function gallery()
	{
		$data['gallery'] = $this->Dashboard_model->Get_Gallery_Data();
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
    // Load helpers & library (if not in constructor)
    $this->load->helper(array('url', 'captcha'));
    $this->load->library('session');

    // Remove old captcha
    $this->session->unset_userdata('captcha_word');

    // CAPTCHA config
    $vals = array(
        'img_path'   => FCPATH . 'public_ftp/contact_captcha/',
        'img_url'    => base_url('public_ftp/contact_captcha/'),
        'img_width'  => 170,
        'img_height' => 50,
        'word_length'=> 5,
        'expiration' => 300,
        'colors' => array(
            'background' => array(255,255,255),
            'border' => array(0,0,0),
            'text' => array(0,0,0),
            'grid' => array(220,220,220)
        )
    );

    // Create captcha
    $cap = create_captcha($vals);

    // Save captcha word in session
    $this->session->set_userdata('captcha_word', $cap['word']);

    // Pass captcha image to view
    $data['captcha_image'] = $cap['image'];

    // Load view ONCE
    $this->load->view('frontend/template', [
        'view' => 'contact',
        'data' => $data
    ]);
}




	public function about_us()
	{
		$array = array('view'=>'about_us');
		$this->load->view('frontend/template',$array);
	}
	public function jnrc_notice()
	{
        $data['row'] = $this->Dashboard_model->Get_notification_data('notification','status','Active');
		$this->load->view('frontend/include/header');
		$this->load->view('frontend/jnrc_notice',$data);
		$this->load->view('frontend/include/footer');

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
	
	public function student_renewal()
	{
		$array = array('view'=>'student_renewal');
		$this->load->view('frontend/template',$array);
	}
	
	public function success_renewal($id='')
	{
		$data['row'] = $this->Dashboard_model->GetData('renewal','id',$id);
		$this->load->view('frontend/include/header');
		$this->load->view('frontend/success_renewal',$data);
		$this->load->view('frontend/include/footer');
	}
	
	public function download()
	{
		
		$data['row'] = $this->Dashboard_model->GetDataOrder('documents','status',1);
    	$this->load->view('frontend/include/header');
		$this->load->view('frontend/download',$data);
		$this->load->view('frontend/include/footer');
	}

	public function view_result(){
		$array = array('view'=>'view_result');
		$this->load->view('frontend/template',$array);
	}
	
	
	
	
	
}