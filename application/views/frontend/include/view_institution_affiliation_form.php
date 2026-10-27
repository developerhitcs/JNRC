<div class="page-content">
	<div class="dez-bnr-inr overlay-black-middle" style="background-image:url(<?php echo base_url();?>assets/images/nursebanner.jpg);">
		<div class="container">
			<div class="dez-bnr-inr-entry">
				<h1 class="text-white">Institution Affiliation Renewal Form Details </h1>
			</div>
		</div>
	</div>
	
	<div class="breadcrumb-row">
		<div class="container">
			<ul class="list-inline">
				<li><a href="<?php echo base_url('');?>">Home</a></li>
				<li>Institution Affiliation Renewal Form Details</li>
				<li style="float:right;">
					<span style=" color:red;"> Welcome <?php echo $this->session->inst_name;?> !! </span> 
					<a onclick="return confirm('Are you sure you want to logout?')" href="<?php echo base_url('logout_user');?>" class="btn btn-danger btn-round" style=" color:#fff;">Logout</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="section-full bg-white content-inner">
		<div class="container">  
			<div class="section-content">
				<form>
					<table class="table table-bordered table-responsive">
						<tbody>
							<tr>
								<td style="width➠50%;">Your Registration Number Is</td>							
								<td style="width➠50%;"><?php //echo $value['id'];?></td>
							</tr>				
						</tbody>
					</table>
					<h3 class="widget-title">Institution and Society/Trust/Mission Details ➠  </h3>
					<?php  foreach($affiliation_details as $af_de) { } ?>
					<div class="table-responsive">					
						<table class="table table-bordered table-responsive">
							<thead>
								<tr>
									<th>Society/Trust/Mission</th>
									<th>Institution Details</th>
									<th>Fee Code/Principal Details</th>
								</tr>
							</thead>
							<tbody>	
								<tr>
									<td>Chairperson/Registrar Name ➠ <?php echo $af_de->chairperson_registrar_name;?></td>
									<td>Name of the Instiution ➠ <?php echo $af_de->name_of_instuition;?></td>
									<td>Applicant ID ➠ <?php echo $af_de->applicant_id;?></td>
								</tr>
								<tr>
									<td>Society/Trust Name➠ <?php echo $af_de->society_trust_name;?></td>
									<td>Address of the Instiution➠ <?php echo $af_de->address_of_instuition;?></td>
									<td>Fee Code➠ <?php echo $af_de->fee_code;?></td>
								</tr>
								<tr>
									
									<td>Address➠ <?php echo $af_de->address;?></td>
									<td>State Name➠ <?php echo $af_de->inst_state;?></td>
									<td>Entry Date➠ <?php echo $af_de->fee_entry_date;?></td>
								</tr>
								<tr>
									<td>List of Society Members➠ <?php echo $af_de->list_of_society_members;?></td>
									<td>District➠ <?php echo $af_de->inst_district;?></td>
									<td>Name of the Principal➠ <?php echo $af_de->name_of_princi;?></td>
								</tr>
								<tr>
									<td>State Name➠ <?php echo $af_de->state_name;?></td>
									<td>Tehsil/Block➠ <?php echo $af_de->inst_tehsil;?></td>
									<td>Email of the Principal➠ <?php echo $af_de->email_of_princi;?></td>
								</tr>
								<tr>
									<td>District➠ <?php echo $af_de->district_name;?></td>									
									<td>Pincode➠ <?php echo $af_de->inst_pincode;?></td>
									<td>Landline No.➠ <?php echo $af_de->land_of_princi;?></td>							
								</tr>
								<tr>
									<td>Tehsil/Block➠ <?php echo $af_de->tehsil_block;?></td>									
									<td>Landline No.➠ <?php echo $af_de->inst_landline;?></td>
									<td>Fax No.➠ <?php echo $af_de->faxno_of_princi;?></td>
								</tr>
								<tr>
									<td>Pincode➠ <?php echo $af_de->pin_code;?></td>									
									<td>Fax No.➠ <?php echo $af_de->inst_fax_no;?></td>
									<td>Mobile No.➠ <?php echo $af_de->mobile_of_princi;?></td>
								</tr>
								<tr>
									<td>Landline No.➠ <?php echo $af_de->insta_email;?></td>									
									<td>Inst is Under➠ <?php echo $af_de->inst_under;?></td>
									<td></td>
								</tr>
								<tr>
									<td>Mobile No.➠ <?php echo $af_de->mobile_no;?></td>									
									<td>Institution Email➠ <?php echo $af_de->insta_email;?></td>
									<td></td>
								</tr>
								<tr>
									<td>Society/Trust Email➠ <?php echo $af_de->society_trust_email;?></td>
									<td></td>
									<td></td>
								</tr>
							</tbody>
						</table> 
					</div>
					
					<h3 class="widget-title">Program,Seats and Total No. of Admitted Student Details ANM/GNM ➠  </h3>
					<div class="table-responsive">
						<table class="table table-bordered table-responsive">
							<tbody>
								<tr>
									<td>Programme Name </td>							
									<td><?php echo $af_de->programme_name;?></td>
								</tr>							
								<tr>
									<td>Board Name</td>							
									<td><?php echo $af_de->board_name;?></td>
								</tr>							
								<tr>
									<td>School Code</td>
									<td><?php echo $af_de->school_code;?></td>
								</tr>							
								<tr>
									<td>Seats</td>							
									<td><?php echo $af_de->total_seats;?></td>
								</tr>							
								<tr>
									<td>No. of Student Admitted in Previous 3 Years </td>							
									<td><?php echo $af_de->previous_3year_student;?></td>
								</tr>							
								<tr>
									<td>No. of Student Admitted</td>							
									<td><?php echo $af_de->admitted_no_student1;?></td>
								</tr>	
								<tr>
									<td>No. of Student Admitted</td>							
									<td><?php echo $af_de->admitted_no_student2;?></td>
								</tr>
								<tr>
									<td>No. of Student Admitted</td>							
									<td><?php echo $af_de->admitted_no_student3;?></td>
								</tr>
								<tr>
									<td>Total No. of Student Under Training</td>							
									<td><?php echo $af_de->student_under_training;?></td>
								</tr>
							</tbody>
						</table>
					</div>
					<h3 class="widget-title">Laboratory Room Details ➠ </h3>
					<div class="table-responsive">
						<table class="table table-bordered table-responsive">
							<thead>
								<tr>
									<td>Sl. No.</td>
									<td>Laboratory Name</td>
									<td>Size of Laboratory</td>
									<td>No. of Equipments & Articles</td>
									<td>No. of Dummies & Dolls</td>
									<td>Entry Date</td>
								</tr>
							</thead>
							<tbody>
								<?php
								$i=1;
								foreach ($affliation_lab as $value_lab) 
								{
									?>						
									<tr>
										<td><?php echo $i;?></td>
										<td><?php echo $value_lab->lab_name; ?></td>
										<td><?php echo $value_lab->lab_size; ?></td>
										<td><?php echo $value_lab->no_equp; ?></td>
										<td><?php echo $value_lab->no_dum; ?></td>
										<td><?php echo $value_lab->ent_date_lab;?></td>				
									</tr>
									<?php 
									$i++; 
								} 
								?>
							</tbody>
						</table>
					</div>
					<h3 class="widget-title">Class Room Details ➠ </h3>
					<div class="table-responsive">
						<table class="table table-bordered table-responsive">
							<thead>
								<tr>
									<td>Sl. No.</td>
									<td>Class Utilized for which Program</td>
									<td>No. of the Class Rooms</td>
									<td>Size of the Class Rooms</td>
								</tr>
							</thead>
							<tbody>
								<?php
								$i=1;
								foreach ($affliation_classroom as $value_cls) 
								{
									?>						
									<tr>
										<td><?php echo $i;?></td>
										<td><?php echo $value_cls->no_cls;?></td>
										<td><?php echo $value_cls->no_cls;?></td>
										<td><?php echo $value_cls->size_cls;?></td>
									</tr>
									<?php 
									$i++; 
								} 
								?>
							</tbody>
						</table>
					</div>
					<h3 class="widget-title">Building and Penalty Details ➠ </h3>
					<table class="table table-bordered table-responsive">
						<thead>
							<tr>
								<td style="width➠ 50%;"><center>Building</center></td>
								<td style="width➠ 50%;"><center>Penalty<center></td>							
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Online Registration of all the said details on the website for 2016-2017 academic year➠ <?php echo $af_de->board_name;?></td>
								<td>If, Penalty of the building asked during 2016-2017 then submit the D.D. of Penalty in form of "Secretary, Jharkhand Nursing Council, Ranchi" ➠  <?php echo $af_de->dd_penalty_sec;?> </td>
							</tr>
							<tr>
								<td>
								General Profile ➠ <?php echo $af_de->general_profile;?> <hr>
								Physical ➠ <?php echo $af_de->physical;?>
								</td>
								<td>Demand Draft(DD) Number➠ <?php echo $af_de->dd_no;?></td>
							</tr>
							<tr>
								<td> 
									Clinical ➠ <?php echo $af_de->clinical;?> <hr>
									Admission ➠ <?php echo $af_de->admission;?><hr>
									Teachers ➠ <?php echo $af_de->teacher;?>
								</td>								
								<td>Demand Draft(DD) Attachment ➠ <img src="<?php echo base_url('uploads_affliation/');?><?php echo $af_de->dd_attach;?>" style="height:50px;" 	></td>
							</tr>
							<tr>
								<td> Previous Year Annual Fees Paid ➠ <?php echo $af_de->previous_year_fee;?> </td>								
								<td>Demand Draft(DD) Date ➠ <?php echo $af_de->dd_date;?></td>
							</tr>
							<tr>
								<td>Current Year Annual Fees Paid ➠ <?php echo $af_de->current_year_fee;?> </td>								
								<td>Demand Draft(DD) Date ➠ <?php echo $af_de->dd_date;?></td>
							</tr>
							<tr>
								<td>Challan Attachment ➠
									<img src="<?php echo base_url('uploads_affliation/');?><?php echo $af_de->challan_attach;?>"  style="height:50px;">
								</td>								
								<td></td>
							</tr>
							<tr>
								<td>Building Status ➠ <?php echo $af_de->building_status;?> </td>								
								<td>
									Built-up area of Teaching Block ➠ <?php echo $af_de->teaching_blocks;?><hr>
									Built-up area of Hostel Block ➠ <?php echo $af_de->hostel_blocks;?>
								</td>
							</tr>
							<tr>
								<td> Location (Institution's full address) of the building ➠ <?php echo $af_de->inst_building_address;?></td>
								<td>Entry Date ➠ <?php echo $af_de->entry_date;?></td>
							</tr>
							<tr>
								<td>Total area of the building ➠ <?php echo $af_de->total_area_building;?></td>
								<td>
									Two photographs of the complete building taken from different angle duly certificate by the architect ➠
									<img src="<?php echo base_url('uploads_affliation/');?><?php echo $af_de->building_img1;?>" style="height:50px;">
									<img src="<?php echo base_url('uploads_affliation/');?><?php echo $af_de->building_img2;?>" style="height:50px;">
								</td>
								
							</tr>							
							<tr>
								<td> Blue print should be signed by the Authority ➠ 
									<img src="<?php echo base_url('uploads_affliation/');?><?php echo $af_de->blueprint_sign_auth;?>"  style="height:50px;">
								</td>
								<td></td>
							</tr>
							<tr>
								<td> In Whose Name The Building / Land is Registered ➠ <?php echo $af_de->building_registered_name;?></td>
								<td></td>
							</tr>
							<tr>
								<td> Building completion certificate/ Building status report attested by registered architect with valid registration number as per INC cercular dated 10.03.2016 along with the following details ➠
									<img src="<?php echo base_url('uploads_affliation/');?><?php echo $af_de->build_comp_certi_img;?>"  style="height:50px;">
								</td>
								<td></td>
							</tr>							
						</tbody>
					</table>
					<h3 class="widget-title">Teaching Faculty Details ➠ </h3>
					<table class="table table-bordered">
						<thead>
							<tr>
								<td>S.No.</td>
								<td>Faculty Name, Gender, Designation and Qualification</td>
								<td>Institute Name, Passing Year, Date of Joining and Qualification Certificate</td>
								<td>RN/RM Number, Certificate, NUID No. and Entry Date</td>
								<td>Teaching Experience and Faculty Image</td>
							</tr>
						</thead>
						<tbody>
							<?php
							$i=1;
							foreach ($affliation_fac as $value_fac) 
							{
								?>							
								<tr>
									<td><?php echo $i.'.'; ?></td>
									<td>Faculty Name ➠ <?php echo $value_fac->fac_name; ?></td>
									<td>Institute Name ➠ <?php echo $value_fac->fac_inst; ?></td>
									<td>RN/RM Number ➠ <?php echo $value_fac->fac_r_num; ?></td>
									<td>UG Teaching Exp. ➠ <?php echo $value_fac->fac_ug; ?></td>
								</tr>
								<tr>
									<td></td>
									<td>Gender ➠ <?php echo $value_fac->fac_gen; ?></td>
									<td>Passing Year ➠ <?php echo $value_fac->fac_pass; ?></td>
									<td>RN/RM Certificate ➠ </td>
									<td>PG Teaching Exp. ➠ <?php echo $value_fac->fac_pg; ?></td>
								</tr>
								<tr>
									<td></td>
									<td>Designation ➠ <?php echo $value_fac->fac_des; ?></td>
									<td>Date of Joining ➠ <?php echo $value_fac->fac_join; ?></td>
									<td>Aadhar Number ➠ <?php echo $value_fac->fac_adhr; ?></td>
									<td>Diploma Teaching Exp. ➠ <?php echo $value_fac->fac_dip; ?></td>
								</tr>
								<tr>
									<td></td>
									<td>Qualification ➠ <?php echo $value_fac->fac_qual;?></td>
									<td>Qualification Certificate Attachment ➠ <img src="<?php echo base_url('uploads_affliation/');?><?php echo $value_fac->fac_qua_img; ?>" style="height:50px;"></td>
									<td>Entry Date ➠ <?php echo $value_fac->fac_ent; ?></td>
									<td>Faculty Image ➠ <img src="<?php echo base_url('uploads_affliation/');?><?php echo $value_fac->fac_img; ?>" style="height:50px;"></td>
								</tr>
								<?php 
								$i++;
							}
							?>
						</tbody>
					</table>
					<h3 class="widget-title">Clinical Faculty Details ➠ </h3>
					<table class="table-bordered table-responsive">
						<thead>
							<tr>
								<td>S.No.</td>
								<td>Parrent Hospital Name</td>
								<td>No. Of Beds</td>
								<td>Bed Occupancy</td>
								<td>Receipt Of The Hospital</td>
								<td>Permission Letter Of Clinical Exp.</td>
								<td>Permission Letter Of Clinical Exp.</td>
								<td>Entry Date</td>
								<td>Address</td>
							</tr>
						</thead>
						<tbody>
							<?php
							$i=1;
							foreach ($clinical_fac as $value_fac) 
							{
								?>
							
								<tr>
									<td><?php echo $i.'.'; ?></td>
									<td><?php echo $value_fac->parent_hospital; ?></td>
									<td><?php echo $value_fac->no_of_beds; ?></td>
									<td><?php echo $value_fac->cni_bed_occupancy; ?></td>
									<td><img src="<?php echo base_url('uploads_affliation/');?><?php echo $value_fac->receipt_of_hospital_img; ?>" style="height:50px;"></td>
									<td><?php echo $value_fac->prem_letter_of_hosp;?></td>
									<td><?php echo $value_fac->cni_exp_stu;?></td>
									<td><?php echo $value_fac->cni_entry_date;?></td>
									<td><?php echo $value_fac->cni_address;?></td>
								</tr>
								
								<?php 
								$i++;
							}
							?>
						</tbody>
					</table>
					<h3 class="widget-title">Affiliated Hospital Details ➠ </h3>
					<table class="table-bordered table-responsive">
						<thead>
							<tr>
								<td>S. No.</td>
								<td>Hospital Name</td>							
								<td>Number of Beds</td>
								<td>Bed Occupancy</td>
								<td>Entry Date</td>
								<td>Address</td>
							</tr>
						</thead>
						<tbody>
							<?php
							$i=1;
							foreach ($affliation_hospital as $value_hos) 
							{
								?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $value_hos->aff_hospital; ?></td>
									<td><?php echo $value_hos->aff_no_of_beds; ?></td>
									<td><?php echo $value_hos->aff_bed_occupacy; ?></td>
									<td><?php echo $value_hos->aff_entry_date; ?></td>
									<td><?php echo $value_hos->aff_address;?></td>
								</tr>
								<?php
								$i++;
							}
							?>
						</tbody>
					</table>
					
					<h3 class="widget-title">Library Facilities and Declaration Details ➠ </h3>
					<table class="table-bordered table-responsive">
						<thead>
							<tr>
								<td>Nursing Books</td>
								<td>Anti Ragging and HIV/AIDS/TB Details</td>
								<td>Declaration</td>
								<td>Date and Place</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Nursing Books ➠ <?php echo $af_de->nursing_book;?></td>
								<td>Total Number of students have been trained in HIV/AIDS/TB Module ➠ <?php echo $af_de->hivs_tv_ads_module;?></td>
								<td>Declaration Candidate Name ➠ <?php echo $af_de->dec_cand_name;?></td>
								<td>Applicant Name ➠ <?php echo $af_de->so_do_wo;?></td>
							</tr>
							<tr>
								<td>Number of Nursing Journals Subscribed (National) ➠ <?php echo $af_de->no_of_nursing_journals_na;?></td>
								<td>Anti Ragging Monitoring Committee, If yes Members & their Mobile Numbers ➠ <?php echo $af_de->anti_ragg_mod;?></td>
								<td>S/O, D/O or W/O ➠ <?php echo $af_de->so_do_wo;?></td>
								<td>Date ➠ <?php echo $af_de->lib_dec_date;?></td>
							</tr>
							<tr>
								<td>Number of Nursing Journals Subscribed (International) ➠ <?php echo $af_de->no_of_nursing_journals_int;?></td>
								<td>Anti Ragging Squad, If yes Members & their Mobile Numbers ➠ <?php echo $af_de->anti_ragg_sq;?></td>
								<td></td>
								<td>Place ➠ <?php echo $af_de->lib_place;?></td>
							</tr>
						</tbody>
					</table>
					
					<h3 class="widget-title">Name of the Faculty trained under GFATM Programme Details ➠ </h3>
					<table class="table-bordered table-responsive">
						<thead>	
							<tr>
								<td>Sl. No.</td>
								<td>Name of the Faculty</td>
								<td>HIV/AIDS</td>
								<td>TB</td>
							</tr>
						</thead>
						<tbody>
							<?php
							$i=1;
							foreach ($affliation_gfatm as  $value_gfa) 
							{
								?>
								<tr>
									<td><?php echo $i;?></td>
									<td><?php echo $value_gfa->faculty_name;?></td>
									<td><?php echo $value_gfa->gfa_hiv;?></td>
									<td><?php echo $value_gfa->gfa_tb;?></td>
								</tr>
								<?php 
								$i++; 
							} 
							?>
						</tbody>
					</table>				
					<div class="row">
						<div class="col-sm-4"></div>
						<div class="col-sm-2">
							<a href="<?php echo base_url('edit_institution_renewal_form'); ?>" class="btn btn-success btn-block">Edit </a>
						</div>
						<div class="col-sm-2">
							<a href="<?php echo base_url('inst_after_login'); ?>" class="btn btn-danger btn-block">Back </a>
						</div>
						<div class="col-sm-4"></div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
	