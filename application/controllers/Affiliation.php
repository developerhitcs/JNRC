<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Affiliation extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Affiliation_model');
		error_reporting(E_ALL & ~E_NOTICE);
	}
	public function save_affil()
	{
			$ip = $_SERVER['REMOTE_ADDR'];
			$chairperson = $this->input->post('chairperson');
			$society = $this->input->post('society');
			$address = $this->input->post('address');
			$soc_members = $this->input->post('soc_members');
			$state = $this->input->post('state');
			$district = $this->input->post('district');
			$tehsil = $this->input->post('tehsil');
			$pin = $this->input->post('pin');
			$landline = $this->input->post('landline');
			$mobile = $this->input->post('mobile');
			$email = $this->input->post('email');
			$institution = $this->input->post('institution');
			$address_ins = $this->input->post('address_ins');
			$state_ins = $this->input->post('state_ins');
			$district_ins = $this->input->post('district_ins');
			$tehsil_ins = $this->input->post('tehsil_ins');
			$pin_ins = $this->input->post('pin_ins');
			$landline_ins = $this->input->post('landline_ins');
			$fax_ins = $this->input->post('fax_ins');
			$ins_under = $this->input->post('ins_under');
			$ins_email = $this->input->post('ins_email');
			$applicant_id = $this->input->post('applicant_id');
			$fee_code = $this->input->post('fee_code');
			$ent_date = $this->input->post('ent_date');
			$principal = $this->input->post('principal');
			$email_prin = $this->input->post('email_prin');
			$landline_prin = $this->input->post('landline_prin');
			$fax_prin = $this->input->post('fax_prin');
			$mobile_prin = $this->input->post('mobile_prin');
			$student_total = $this->input->post('student_total');
			$student_msc = $this->input->post('student_msc');
			$student_pbb = $this->input->post('student_pbb');
			$distance_edu = $this->input->post('distance_edu');
			$other_short = $this->input->post('other_short');
			$onln_reg = $this->input->post('onln_reg');
			$general = $this->input->post('general');
			$physical = $this->input->post('physical');
			$clinical = $this->input->post('clinical');
			$admission = $this->input->post('admission');
			$teachers = $this->input->post('teachers');
			$pre_year = $this->input->post('pre_year');
			$building = $this->input->post('building');
			$loc_full_address = $this->input->post('loc_full_address');
			$tot_area = $this->input->post('tot_area');
			$blueprint = $this->input->post('blueprint');
			$build_name = $this->input->post('build_name');
			$penalty = $this->input->post('penalty');
			$dd_number = $this->input->post('dd_number');
			$dd_date = $this->input->post('dd_date');
			$build_area = $this->input->post('build_area');
			$build_hostel = $this->input->post('build_hostel');
			$ent_date_pen = $this->input->post('ent_date_pen');
			$parent_hos = $this->input->post('parent_hos');
			$clin_addr = $this->input->post('clin_addr');
			$clin_beds = $this->input->post('clin_beds');
			$clin_bed_occu = $this->input->post('clin_bed_occu');
			$clin_exp = $this->input->post('clin_exp');
			$clin_ent = $this->input->post('clin_ent');
			$affl_hos = $this->input->post('affl_hos');
			$affl_address = $this->input->post('affl_address');
			$affl_beds = $this->input->post('affl_beds');
			$affl_bed_occu = $this->input->post('affl_bed_occu');
			$affl_ent = $this->input->post('affl_ent');
			$nur_no_hiv = $this->input->post('nur_no_hiv');
			$dec_name = $this->input->post('dec_name');
			$app_dec_name = $this->input->post('app_dec_name');
			$nur_jour_nat = $this->input->post('nur_jour_nat');
			$anti_rag = $this->input->post('anti_rag');
			$sodowo = $this->input->post('sodowo');
			$nur_ent = $this->input->post('nur_ent');
			$nur_jour_int = $this->input->post('nur_jour_int');
			$anti_rag_mob = $this->input->post('anti_rag_mob');
			$nur_place = $this->input->post('nur_place');
			//$gfa_name = $_POST['gfa_name'];
			//$gfa_hiv = $_POST['gfa_hiv'];
			//$gfa_tb = $_POST['gfa_tb'];
			$records_lab = count($_POST['lab_name']);
			$records_faculty = count($_POST['fac_name']);
			$records_gfa = count($_POST['gfa_name']);
			$data=array(
					'chairperson' 	=> $chairperson,
					'society' 	=> $society,
					'address' 	=> $address,
					'soc_members' 	=> $soc_members,
					'state' 	=> $state,
					'district' 	=> $district,
					'tehsil' 	=> $tehsil,
					'pin' 	=> $pin,
					'landline' 	=> $landline,
					'mobile' 	=> $mobile,
					'email' 	=> $email,
					'institution' 	=> $institution,
					'address_ins' 	=> $address_ins,
					'state_ins' 	=> $state_ins,
					'district_ins' 	=> $district_ins,
					'tehsil_ins' 	=> $tehsil_ins,
					'pin_ins' 	=> $pin_ins,
					'landline_ins' 	=> $landline_ins,
					'fax_ins' 	=> $fax_ins,
					'ins_under' 	=> $ins_under,
					'ins_email' 	=> $ins_email,
					'applicant_id' 	=> $applicant_id,
					'fee_code' 	=> $fee_code,
					'ent_date' 	=> $ent_date,
					'principal' 	=> $principal,
					'email_prin' 	=> $email_prin,
					'landline_prin' 	=> $landline_prin,
					'fax_prin' 	=> $fax_prin,
					'mobile_prin' 	=> $mobile_prin,
					'student_total' 	=> $student_total,
					'student_msc' 	=> $student_msc,
					'student_pbb' 	=> $student_pbb,
					'distance_edu' 	=> $distance_edu,
					'other_short' 	=> $other_short,
					'onln_reg' 	=> $onln_reg,
					'general' 	=> $general,
					'physical' 	=> $physical,
					'clinical' 	=> $clinical,
					'admission' 	=> $admission,
					'teachers' 	=> $teachers,
					'pre_year' 	=> $pre_year,
					'building' 	=> $building,
					'loc_full_address' 	=> $loc_full_address,
					'tot_area' 	=> $tot_area,
					'blueprint' 	=> $blueprint,
					'build_name' 	=> $build_name,
					'penalty' 	=> $penalty,
					'dd_number' 	=> $dd_number,
					'dd_date' 	=> $dd_date,
					'build_area' 	=> $build_area,
					'build_hostel' 	=> $build_hostel,
					'ent_date_pen' 	=> $ent_date_pen,
					'parent_hos' 	=> $parent_hos,
					'clin_addr' 	=> $clin_addr,
					'clin_beds' 	=> $clin_beds,
					'clin_bed_occu' 	=> $clin_bed_occu,
					'clin_exp' 	=> $clin_exp,
					'clin_ent' 	=> $clin_ent,
					'affl_hos' 	=> $affl_hos,
					'affl_address' 	=> $affl_address,
					'affl_beds' 	=> $affl_beds,
					'affl_bed_occu' 	=> $affl_bed_occu,
					'affl_ent' 	=> $affl_ent,
					'nur_no_hiv' 	=> $nur_no_hiv,
					'dec_name' 	=> $dec_name,
					'app_dec_name' 	=> $app_dec_name,
					'nur_jour_nat' 	=> $nur_jour_nat,
					'anti_rag' 	=> $anti_rag,
					'sodowo' 	=> $sodowo,
					'nur_ent' 	=> $nur_ent,
					'nur_jour_int' 	=> $nur_jour_int,
					'anti_rag_mob' 	=> $anti_rag_mob,
					'nur_place' 	=> $nur_place
					);
			//print_r($data);
			$this->Affiliation_model->insertUser('affiliation',$data);

			//lab insertion
			for($i=0; $i<$records_lab; $i++) {
				$data_gfa =array(
						'lab_name' 	=> $_POST['lab_name'][$i],
						'lab_size' 	=> $_POST['lab_size'][$i],
						'no_equp' 	=> $_POST['no_equp'][$i],
						'no_dum' 	=> $_POST['no_dum'][$i],
						'no_cls' 	=> $_POST['no_cls'][$i],
						'size_cls' 	=> $_POST['size_cls'][$i],
						'ent_date_lab' 	=> $_POST['ent_date_lab'][$i]
					);
				$this->Affiliation_model->insertUser('aff_lab',$data_gfa);
				
			}

			//faculty insertion
			for($i=0; $i<$records_faculty; $i++) {
				$data_gfa =array(
						'fac_name' 	=> $_POST['fac_name'][$i],
						'fac_inst' 	=> $_POST['fac_inst'][$i],
						'fac_r_num' 	=> $_POST['fac_r_num'][$i],
						'fac_ug' 	=> $_POST['fac_ug'][$i],
						'fac_gen' 	=> $_POST['fac_gen'][$i],
						'fac_pass' 	=> $_POST['fac_pass'][$i],
						'fac_pg' 	=> $_POST['fac_pg'][$i],
						'fac_des' 	=> $_POST['fac_des'][$i],
						'fac_join' 	=> $_POST['fac_join'][$i],
						'fac_adhr' 	=> $_POST['fac_adhr'][$i],
						'fac_dip' 	=> $_POST['fac_dip'][$i],
						'fac_qual' 	=> $_POST['fac_qual'][$i],
						'fac_ent' 	=> $_POST['fac_ent'][$i]
					);
				$this->Affiliation_model->insertUser('aff_fac',$data_gfa);
				
			}

			//gfatm insertion
			for($i=0; $i<$records_gfa; $i++) {
				$data_gfa =array(
						'gfa_name' 	=> $_POST['gfa_name'][$i],
						'gfa_hiv' 	=> $_POST['gfa_hiv'][$i],
						'gfa_tb' 	=> $_POST['gfa_tb'][$i]
					);
				$this->Affiliation_model->insertUser('aff_gfatm',$data_gfa);
				
			}
			redirect('success_affl');
	}
}