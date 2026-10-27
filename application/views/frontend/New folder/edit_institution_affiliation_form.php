<style>
.table > tbody > tr > td
{
	font-weight:600;
}
</style>
<div class="page-content">
	<div class="dez-bnr-inr overlay-black-middle" style="background-image:url(<?php echo base_url();?>assets/images/nursebanner.jpg);">
		<div class="container">
			<div class="dez-bnr-inr-entry">
				<h1 class="text-white">Edit Institution Affiliation Renewal Form Details </h1>
			</div>
		</div>
	</div>
	
	<div class="breadcrumb-row">
		<div class="container">
			<ul class="list-inline">
				<li><a href="<?php echo base_url('');?>">Home</a></li>
				<li>Edit Institution Affiliation Renewal Form Details</li>
				<li style="float:right;">
					<span style=" color:red;"> Welcome <?php echo $this->session->inst_name;?> !! </span> 
					<a onclick="return confirm('Are you sure you want to logout?')" href="<?php echo base_url('logout_user');?>" class="btn btn-danger btn-round" style=" color:#fff;">Logout</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="section-full bg-white content-inner">
		<div class="container">  
			<div class="row">
				<div class="col-md-12">
					<?php
					if (isset($_SESSION['errmsg'])) 
					{
					  ?>
					  <div class="alert alert-<?php echo $_SESSION['msg']; ?> alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
							<strong><?php echo $_SESSION['errmsg']; ?></strong>
					  </div>
					  <?php
					  unset($_SESSION['msg']);
					  unset($_SESSION['errmsg']);
					}
					?>
				</div>
			</div>
			<div class="section-content">
				<form method="post" action="<?php echo base_url('update_institution_renewal_details');?>" enctype="multipart/form-data">
					<?php  foreach($affiliation_details as $af_de) { } ?>					
					<table class="table table-bordered table-responsive">
						<tbody>
							<tr>
								<td style="width:50%;">Your Registration Number Is</td>							
								<td style="width:50%;"><input type="text" value="<?php echo $af_de->id;?>" class="form-control" readonly></td>
							</tr>				
						</tbody>
					</table>
					<h3 class="widget-title">Institution and Society/Trust/Mission Details ➠  </h3>
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
									<td>Chairperson/Registrar Name ➠ <input type="text" name="chairperson" value="<?php echo $af_de->chairperson_registrar_name;?>" class="form-control" ></td>
									<td>Name of the Instiution ➠ <input type="text" name="institution" value="<?php echo $af_de->name_of_instuition;?>" class="form-control"> </td>
									<td>Applicant ID ➠ <input type="text" name="applicant_id" value="<?php echo $af_de->applicant_id;?>" class="form-control" ></td>
								</tr>
								<tr>
									<td>Society/Trust Name ➠ <input type="text" name="society" value="<?php echo $af_de->society_trust_name;?>" class="form-control" ></td>
									<td>Address of the Instiution ➠ <input type="text"  name="address_ins" value="<?php echo $af_de->address_of_instuition;?>" class="form-control" ></td>
									<td>Fee Code ➠ <input type="text" name="fee_code" value="<?php echo $af_de->fee_code;?>" class="form-control" ></td>
								</tr>
								<tr>
									
									<td>Address ➠ <input type="text" name="address" value="<?php echo $af_de->address;?>" class="form-control" ></td>
									<td>State Name ➠ <input type="text" name="state_ins" value="<?php echo $af_de->inst_state;?>" class="form-control" ></td>
									<td>Entry Date ➠ <input type="text" name="ent_date" value="<?php echo $af_de->fee_entry_date;?>" class="form-control" ></td>
								</tr>
								<tr>
									<td>List of Society Members ➠ <input name="soc_members" type="text" value="<?php echo $af_de->list_of_society_members;?>" class="form-control" ></td>
									<td>District ➠ <input type="text" name="district_ins" value="<?php echo $af_de->inst_district;?>" class="form-control" ></td>
									<td>Name of the Principal ➠ <input name="principal" type="text" value="<?php echo $af_de->name_of_princi;?>" class="form-control" ></td>
								</tr>
								<tr>
									<td>State Name ➠ <input type="text" name="state" value="<?php echo $af_de->state_name;?>" class="form-control" ></td>
									<td>Tehsil/Block ➠ <input type="text" name="tehsil_ins" value="<?php echo $af_de->inst_tehsil;?>" class="form-control" ></td>
									<td>Email of the Principal ➠ <input  name="email_prin" type="text" value="<?php echo $af_de->email_of_princi;?>" class="form-control" ></td>
								</tr>
								<tr>
									<td>District ➠ <input type="text" name="district" value="<?php echo $af_de->district_name;?>" class="form-control" ></td>									
									<td>Pincode ➠ <input type="text" name="pin_ins" value="<?php echo $af_de->inst_pincode;?>" class="form-control" ></td>
									<td>Landline No. ➠ <input type="text" name="landline_prin" value="<?php echo $af_de->land_of_princi;?>" class="form-control" ></td>							
								</tr>
								<tr>
									<td>Tehsil/Block ➠ <input type="text" name="tehsil" value="<?php echo $af_de->tehsil_block;?>" class="form-control" ></td>									
									<td>Landline No. ➠ <input type="text" name="landline_ins" value="<?php echo $af_de->inst_landline;?>" class="form-control" ></td>
									<td>Fax No. ➠ <input type="text" name="fax_prin" value="<?php echo $af_de->faxno_of_princi;?>" class="form-control" > </td>
								</tr>
								<tr>
									<td>Pincode ➠ <input type="text" name="pin" value="<?php echo $af_de->pin_code;?>" class="form-control" ></td>									
									<td>Fax No. ➠ <input type="text" name="fax_ins" value="<?php echo $af_de->inst_fax_no;?>" class="form-control" ></td>
									<td>Mobile No. ➠ <input type="text" name="mobile_prin" value="<?php echo $af_de->mobile_of_princi;?>" class="form-control" ></td>
								</tr>
								<tr>
									<td>Landline No. ➠ <input type="text" name="landline" value="<?php echo $af_de->insta_email;?>" class="form-control" ></td>									
									<td>Inst is Under ➠ <input type="text" name="ins_under" value="<?php echo $af_de->inst_under;?>" class="form-control" ></td>
									<td></td>
								</tr>
								<tr>
									<td>Mobile No. ➠ <input type="text" name="mobile" value="<?php echo $af_de->mobile_no;?>" class="form-control" ></td>									
									<td>Institution Email ➠ <input type="text" name="ins_email" value="<?php echo $af_de->insta_email;?>" class="form-control" ></td>
									<td></td>
								</tr>
								<tr>
									<td>Society/Trust Email ➠ <input type="text" name="email" value="<?php echo $af_de->society_trust_email;?>" class="form-control" ></td>
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
									<td><input type="text" name="prog_name" value="<?php echo $af_de->programme_name;?>" class="form-control" ></td>
								</tr>							
								<tr>
									<td>Board Name</td>							
									<td><input type="text" name="board_name" value="<?php echo $af_de->board_name;?>" class="form-control" ></td>
								</tr>							
								<tr>
									<td>School Code</td>
									<td><input type="text" name="school_code" value="<?php echo $af_de->school_code;?>" class="form-control" ></td>
								</tr>							
								<tr>
									<td>Seats</td>							
									<td><input type="text" name="seats" value="<?php echo $af_de->total_seats;?>" class="form-control" ></td>
								</tr>							
								<tr>
									<td>No. of Student Admitted in Previous 3 Years </td>							
									<td><input type="text" name="admitted_previous_3years" value="<?php echo $af_de->previous_3year_student;?>" class="form-control" ></td>
								</tr>							
								<tr>
									<td>No. of Student Admitted</td>							
									<td><input type="text" name="no_of_student1" value="<?php echo $af_de->admitted_no_student1;?>" class="form-control" ></td>
								</tr>	
								<tr>
									<td>No. of Student Admitted</td>							
									<td><input type="text" name="no_of_student2" value="<?php echo $af_de->admitted_no_student2;?>" class="form-control" ></td>
								</tr>
								<tr>
									<td>No. of Student Admitted</td>							
									<td><input type="text" name="no_of_student3" value="<?php echo $af_de->admitted_no_student3;?>" class="form-control" ></td>
								</tr>
								<tr>
									<td>Total No. of Student Under Training</td>							
									<td><input type="text" name="student_under_Training" value="<?php echo $af_de->student_under_training;?>" class="form-control" ></td>
								</tr>
							</tbody>
						</table>
					</div>
					<h3 class="widget-title">Laboratory Room Details ➠ </h3>
					<div class="table-responsive">
						<table class="table table-bordered table-responsive" id="result_lab">
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
								$lab_id=1;
								foreach ($affliation_lab as $value_lab) 
								{
									?>						
									<tr>
										<td>
											<input type="text" value="<?php echo $lab_id;?>" class="form-control" readonly >
											<input type="hidden" name="lab_id[]" value="<?php echo $value_lab->id;?>" class="form-control" >
										</td>
										<td><input type="text" name="lab_name[]" value="<?php echo $value_lab->lab_name; ?>" class="form-control" ></td>
										<td><input type="text" name="lab_size[]" value="<?php echo $value_lab->lab_size; ?>" class="form-control" ></td>
										<td><input type="text" name="no_equp[]" value="<?php echo $value_lab->no_equp; ?>" class="form-control" ></td>
										<td><input type="text" name="no_dum[]" value="<?php echo $value_lab->no_dum; ?>" class="form-control" ></td>
										<td><input type="date" name="ent_date_lab[]" value="<?php echo $value_lab->ent_date_lab;?>" class="form-control" ></td>				
										
									</tr>
									<?php 
									$lab_id++; 
								} 
								?>
							</tbody>
						</table>
					</div>
					<h3 class="widget-title">Class Room Details ➠ </h3>
					<div class="table-responsive">
						<table class="table table-bordered table-responsive" id="result_cls">
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
								$cls_id=1;
								foreach ($affliation_classroom as $value_cls) 
								{
									?>						
									<tr>
										<td>
											<input type="text" value="<?php echo $cls_id;?>" class="form-control" readonly >
											<input type="hidden" name="cls_id[]" value="<?php echo $value_cls->id;?>" class="form-control" >
										</td>
										<td><input type="text" name="no_utilized_cls[]" value="<?php echo $value_cls->no_cls;?>" class="form-control" ></td>
										<td><input type="text" name="no_cls[]" value="<?php echo $value_cls->no_cls;?>" class="form-control" ></td>
										<td><input type="text" name="size_cls[]" value="<?php echo $value_cls->size_cls;?>" class="form-control" ></td>
										
									</tr>
									<?php 
									$cls_id++; 
								} 
								?>
							</tbody>
						</table>
					</div>
					<h3 class="widget-title">Building and Penalty Details ➠ </h3>
					<table class="table table-bordered table-responsive">
						<thead>
							<tr>
								<td style="width:50%;"><center>Building</center></td>
								<td style="width:50%;"><center>Penalty<center></td>							
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									Online Registration of all the said details on the website for 2016-2017 academic year ➠ 
									<input type="text" name="onln_reg" value="<?php echo $af_de->board_name;?>" class="form-control" >
								</td>
								<td>
									If, Penalty of the building asked during 2016-2017 then submit the D.D. of Penalty in form of "Secretary, Jharkhand Nursing Council, Ranchi" ➠  
									<input type="text" name="penalty" value="<?php echo $af_de->dd_penalty_sec;?>" class="form-control" >
								</td>
							</tr>
							<tr>
								<td>
									General Profile ➠ 	<input type="text" name="general" value="<?php echo $af_de->general_profile;?>" class="form-control" >
									<br> 
									Physical ➠	<input type="text" name="physical" value="<?php echo $af_de->physical;?>" class="form-control" >
								</td>
								<td>Demand Draft(DD) Number ➠ <input type="text" name="dd_number" value="<?php echo $af_de->dd_no;?>" class="form-control" >
								</td>
							</tr>
							<tr>
								<td> 
									Clinical ➠ <input type="text" name="clinical" value="<?php echo $af_de->clinical;?>" class="form-control" > <br>
									Admission ➠ <input type="text"  name="admission" value="<?php echo $af_de->admission;?>" class="form-control" > <br>
									Teachers ➠ <input type="text" name="teachers" value="<?php echo $af_de->teacher;?>" class="form-control" >
								</td>								
								<td>Demand Draft(DD) Attachment ➠ <br>
									<img src="<?php echo base_url('uploads_affliation/');?><?php echo $af_de->dd_attach;?>" class="img-responsive img-thumbnail" style="height:70px;" 	>
									<input type="hidden" name="demand_draft_img_old" value="<?php echo $af_de->dd_attach;?>" class="form-control" >
									<input type="file" name="demand_draft_img" class="form-control" >
								</td>
							</tr>
							<tr>
								<td> Previous Year Annual Fees Paid ➠ <input type="text" name="pre_year" value="<?php echo $af_de->previous_year_fee;?>" class="form-control" > </td>								
								<td>Demand Draft(DD) Date ➠ <input type="date" name="dd_date" value="<?php echo $af_de->dd_date;?>" class="form-control" > </td>
							</tr>
							<tr>
								<td>Current Year Annual Fees Paid ➠ <input type="text" name="curr_year" value="<?php echo $af_de->current_year_fee;?>" class="form-control" >  </td>								
								<td>Demand Draft(DD) Date ➠ <input type="date" name="cr_dd_date" value="<?php echo $af_de->dd_date;?>" class="form-control" > </td>
							</tr>
							<tr>
								<td>Challan Attachment ➠
									<br>
									<img src="<?php echo base_url('uploads_affliation/');?><?php echo $af_de->challan_attach;?>"   class="img-responsive img-thumbnail" style="height:50px;">
									<input type="hidden" name="challan_attach_old" value="<?php echo $af_de->challan_attach;?>" class="form-control" >
									<input type="file" name="challan_attach" class="form-control" >
								</td>								
								<td></td>
							</tr>
							<tr>
								<td>Building Status ➠ <br> <input type="text" name="building_status" value="<?php echo $af_de->building_status;?>" class="form-control" > </td>								
								<td>
									Built-up area of Teaching Block ➠ <input type="text" name="build_area" value="<?php echo $af_de->teaching_blocks;?>" class="form-control" > <br>
									Built-up area of Hostel Block ➠ <input type="text" name="build_hostel" value="<?php echo $af_de->hostel_blocks;?>" class="form-control" >
								</td>
							</tr>
							<tr>
								<td> Location (Institution's full address) of the building ➠ <input type="text" name="loc_full_address" value="<?php echo $af_de->inst_building_address;?>" class="form-control" > </td>
								<td>Entry Date ➠ <input type="date" name="ent_date_pen" value="<?php echo $af_de->entry_date;?>" class="form-control" > </td>
							</tr>
							<tr>
								<td>Total area of the building ➠ <input type="text" name="tot_area" value="<?php echo $af_de->total_area_building;?>" class="form-control" > </td>
								<td>
									Two photographs of the complete building taken from different angle duly certificate by the architect ➠
									<br>
									<img src="<?php echo base_url('uploads_affliation/');?><?php echo $af_de->building_img1;?>" class="img-responsive img-thumbnail" style="height:50px;">
									<img src="<?php echo base_url('uploads_affliation/');?><?php echo $af_de->building_img2;?>" class="img-responsive img-thumbnail" style="height:50px;">
									<input type="file" name="build_img_1" class="form-control" >
									<input type="hidden" name="old_build_img_1" value="<?php echo $af_de->building_img1;?>" class="form-control" >
									<input type="hidden" name="old_build_img_2" value="<?php echo $af_de->building_img1;?>" class="form-control" >
									<input type="file" name="build_img_2" class="form-control" >
								</td>								
							</tr>							
							<tr>
								<td> Blue print should be signed by the Authority ➠ <br>
									<img src="<?php echo base_url('uploads_affliation/');?><?php echo $af_de->blueprint_sign_auth;?>" class="img-responsive img-thumbnail"  style="height:50px;">
									<input type="hidden" name="old_blueprint" value="<?php echo $af_de->blueprint_sign_auth;?>" class="form-control" >
									<input type="file" name="blueprint" class="form-control" >
								</td>
								<td></td>
							</tr>
							<tr>
								<td> In Whose Name The Building / Land is Registered ➠ <input type="text" name="build_name" value="<?php echo $af_de->building_registered_name;?>" class="form-control" > </td>
								<td></td>
							</tr>
							<tr>
								<td> Building completion certificate/ Building status report attested by registered architect with valid registration number as per INC cercular dated 10.03.2016 along with the following details ➠
									<br>
									<img src="<?php echo base_url('uploads_affliation/');?><?php echo $af_de->build_comp_certi_img;?>" class="img-responsive img-thumbnail" style="height:50px;">
									<input type="hidden" name="old_build_cert_img" value="<?php echo $af_de->build_comp_certi_img;?>" class="form-control" >
									<input type="file" name="build_cert_img" class="form-control" >
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
									<td>
										<?php echo $i.'.'; ?>
										<input type="hidden" name="fac_id[]" value="<?php echo $value_fac->id; ?>" class="form-control" >
									</td>
									<td>Faculty Name ➠ <input type="text" name="fac_name[]" value="<?php echo $value_fac->fac_name; ?>" class="form-control" > </td>
									<td>Institute Name ➠ <input type="text" name="fac_inst[]" value="<?php echo $value_fac->fac_inst; ?>" class="form-control" > </td>
									<td>RN/RM Number ➠ <input type="text" name="fac_r_num[]" value="<?php echo $value_fac->fac_r_num; ?>" class="form-control" ></td>
									<td>UG Teaching Exp. ➠ <input type="text" name="fac_ug[]" value="<?php echo $value_fac->fac_ug; ?>" class="form-control" ></td>
								</tr>
								<tr>
									<td></td>
									<td>Gender ➠ <input type="text" name="fac_gen[]" value="<?php echo $value_fac->fac_gen; ?>" class="form-control" ></td>
									<td>Passing Year ➠ <input type="text" name="fac_pass[]" value="<?php echo $value_fac->fac_pass; ?>" class="form-control" ></td>
									<td>RN/RM Certificate  ➠ <input type="text" name="rn_rm_certified[]" value="<?php echo $value_fac->fac_pg; ?>" class="form-control" ></td>
									<td>PG Teaching Exp. ➠ <input type="text" name="fac_pg[]" value="<?php echo $value_fac->fac_pg; ?>" class="form-control" ></td>
								</tr>
								<tr>
									<td></td>
									<td>Designation ➠ <input type="text" name="fac_des[]" value="<?php echo $value_fac->fac_des; ?>" class="form-control" ></td>
									<td>Date of Joining ➠ <input type="date" name="fac_join[]" value="<?php echo $value_fac->fac_join; ?>" class="form-control" ></td>
									<td>Aadhar Number ➠ <input type="text" name="fac_adhr[]" value="<?php echo $value_fac->fac_adhr; ?>" class="form-control" ></td>
									<td>Diploma Teaching Exp. ➠ <input type="text" name="fac_dip[]" value="<?php echo $value_fac->fac_dip; ?>" class="form-control" ></td>
								</tr>
								<tr>
									<td></td>
									<td>Qualification ➠ <input type="text" name="fac_qual[]" value="<?php echo $value_fac->fac_qual;?>" class="form-control" ></td>
									<td>
										Qualification Certificate Attachment ➠
										<img src="<?php echo base_url('uploads_affliation/');?><?php echo $value_fac->fac_qua_img; ?>" style="height:50px;">
										<input type="file" name="qual_cert[]" class="form-control">
										<input type="hidden" name="old_qual_cert[]" value="<?php echo $value_fac->fac_qua_img; ?>" class="form-control">
									</td>
									<td>Entry Date ➠ <input type="date" name="fac_ent[]" value="<?php echo $value_fac->fac_ent; ?>" class="form-control" ></td>
									<td>
										Faculty Image ➠ 
										<img src="<?php echo base_url('uploads_affliation/');?><?php echo $value_fac->fac_img; ?>" style="height:50px;">
										<input type="file" name="fac_img[]" class="form-control">
										<input type="hidden" name="old_fac_img[]" value="<?php echo $value_fac->fac_img; ?>" class="form-control">
									</td>
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
								<td style="width:150px;">Address</td>
							</tr>
						</thead>
						<tbody>
							<?php
							$i=1;
							foreach ($clinical_fac as $value_fac) 
							{
								?>
							
								<tr>
									<td>
										<input type="text" value="<?php echo $i.'.'; ?>" class="form-control">
										<input type="hidden" name="cln_id[]" value="<?php echo $value_fac->id; ?>" class="form-control">
									</td>
									<td><input type="text" name="cli_hosp_name[]" value="<?php echo $value_fac->parent_hospital; ?>" class="form-control"></td>
									<td><input type="text" name="cli_no_of_beds[]" value="<?php echo $value_fac->no_of_beds; ?>" class="form-control"></td>
									<td><input type="text" name="cli_bed_occupancy[]" value="<?php echo $value_fac->cni_bed_occupancy; ?>" class="form-control"></td>
									<td>
										<img src="<?php echo base_url('uploads_affliation/');?><?php echo $value_fac->receipt_of_hospital_img; ?>" style="height:60px;">
										<input type="file" name="cli_receipthosp_img[]" class="form-control">
										<input type="hidden" name="receipt_of_hospital_img_old[]" value="<?php echo $value_fac->receipt_of_hospital_img; ?>" class="form-control">
									</td>
									<td></td>
									<td></td>
									<td><input type="date" name="cli_entry_date[]" value="<?php echo $value_fac->cni_entry_date;?>" class="form-control"></td>
									<td><input type="text" name="cli_address[]" value="<?php echo $value_fac->cni_address;?>" class="form-control"></td>
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
									<td>
										<input type="text" value="<?php echo $i;?>" class="form-control" readonly>
										<input type="hidden" name="hosp_id[]" value="<?php echo $value_hos->id;?>" class="form-control" readonly>
									</td>
									<td><input type="text" name="hosp_name[]" value="<?php echo $value_hos->aff_hospital; ?>" class="form-control"></td>
									<td><input type="text" name="no_of_beds[]" value="<?php echo $value_hos->aff_no_of_beds; ?>" class="form-control"></td>
									<td><input type="text" name="bed_occupancy[]" value="<?php echo $value_hos->aff_bed_occupacy; ?>" class="form-control"></td>
									<td><input type="text" name="entry_date[]" value="<?php echo $value_hos->aff_entry_date; ?>" class="form-control"></td>
									<td><input type="text" name="hosp_address[]" value="<?php echo $value_hos->aff_address;?>" class="form-control"></td>
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
								<td>Nursing Books ➠ <input type="text" name="nurs_books" value="<?php echo $af_de->nursing_book;?>" class="form-control"></td>
								<td>Total Number of students have been trained in HIV/AIDS/TB Module ➠ <input type="text" name="nur_no_hiv" value="<?php echo $af_de->hivs_tv_ads_module;?>" class="form-control"></td>
								<td>Declaration Candidate Name ➠ <input type="text" name="dec_name" value="<?php echo $af_de->dec_cand_name;?>" class="form-control"></td>
								<td>Applicant Name ➠ <input type="text" name="app_dec_name" value="<?php echo $af_de->so_do_wo;?>" class="form-control"></td>
							</tr>
							<tr>
								<td>Number of Nursing Journals Subscribed (National) ➠ <input type="text" name="nur_jour_nat" value="<?php echo $af_de->no_of_nursing_journals_na;?>" class="form-control"></td>
								<td>Anti Ragging Monitoring Committee, If yes Members & their Mobile Numbers ➠ <input type="text" name="anti_rag" value="<?php echo $af_de->anti_ragg_mod;?>" class="form-control"></td>
								<td>S/O, D/O or W/O ➠ <input type="text" name="sodowo" value="<?php echo $af_de->so_do_wo;?>" class="form-control"></td>
								<td>Date ➠ <input type="date" name="nur_ent" value="<?php echo $af_de->lib_dec_date;?>" class="form-control"></td>
							</tr>
							<tr>
								<td>Number of Nursing Journals Subscribed (International) ➠ <input type="text" name="nur_jour_int" value="<?php echo $af_de->no_of_nursing_journals_int;?>" class="form-control"></td>
								<td>Anti Ragging Squad, If yes Members & their Mobile Numbers ➠ <input type="text" name="anti_rag_mob" value="<?php echo $af_de->anti_ragg_sq;?>" class="form-control"></td>
								<td></td>
								<td>Place ➠ <input type="text" name="nur_place" value="<?php echo $af_de->lib_place;?>" class="form-control"></td>
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
									<td>
										<input type="text" value="<?php echo $i;?>" class="form-control" readonly>
										<input type="hidden" name="gfa_id[]" value="<?php echo $value_gfa->id;?>" class="form-control" readonly>
									</td>
									<td><input type="text" name="gfa_name[]" value="<?php echo $value_gfa->faculty_name;?>" class="form-control"></td>
									<td><input type="text" name="gfa_hiv[]" value="<?php echo $value_gfa->gfa_hiv;?>" class="form-control"></td>
									<td><input type="text" name="gfa_tb[]" value="<?php echo $value_gfa->gfa_tb;?>" class="form-control"></td>
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
							<button type="submit" class="btn btn-success btn-block">Update </button>
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
