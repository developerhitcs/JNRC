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
					<span style=" color: red;"> Welcome <?php echo $this->session->inst_name;?> !! </span> 
					<a onclick="return confirm('Are you sure you want to logout?')" href="<?php echo base_url('logout_user');?>" class="btn btn-danger btn-round" style=" color: #fff;">Logout</a>
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
								<td style="width:50%;">Your Registration Number Is</td>							
								<td style="width:50%;"><?php //echo $value['id'];?></td>
							</tr>					
													
						</tbody>
					</table>
					<h3>Institution and Society/Trust/Mission Details : - </h3>
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
									<td>Chairperson/Registrar Name:</br><?php // echo $value['chairperson'];?></td>
									<td>Name of the Instiution:</br><?php // echo $value['institution'];?></td>
									<td>Applicant ID:</br><?php // echo $value['id'];?></td>
								</tr>
								<tr>
									<td>Society/Trust Name:</br><?php // echo $value['society'];?></td>
									<td>Address of the Instiution:</br><?php // echo $value['address_ins'];?></td>
									<td>Fee Code:</br><?php // echo $value['fee_code'];?></td>
								</tr>
								<tr>
									
									<td>Address:</br><?php // echo $value['address'];?></td>
									<td>Name of the Principal:</br><?php // echo $value['principal'];?></td>
									<td>Entry Date:</br><?php // echo $value['ent_date'];?></td>
								</tr>
								<tr>
									<td>List of Society Members:</br><?php // echo $value['soc_members'];?></td>
									
									<td>District:</br><?php // echo $value['district_ins'];?></td>
									<td>Email of the Principal:</br><?php // echo $value['email_prin'];?></td>
								</tr>
								<tr>
									<td>State Name:</br><?php // echo $value['state'];?></td>
									
									<td>Tehsil/Block:</br><?php // echo $value['tehsil_ins'];?></td>
									<td>Landline No.:</br><?php // echo $value['landline_prin'];?></td>
								</tr>
								<tr>
									<td>District:</br><?php // echo $value['district'];?></td>
									
									<td>Pincode:</br><?php // echo $value['pin_ins'];?></td>
									<td>Fax No.:</br><?php // echo $value['fax_prin'];?></td>
								</tr>
								<tr>
									<td>Tehsil/Block:</br><?php //echo $value['tehsil'];?></td>
									
									<td>Landline No.:</br><?php //echo $value['landline_ins'];?></td>
									<td>Mobile No.:</br><?php //echo $value['mobile_prin'];?></td>
								</tr>
								<tr>
									<td>Pincode:</br><?php //echo $value['pin'];?></td>
									
									<td>Fax No.:</br><?php //echo $value['fax_ins'];?></td>
									<td></td>
								</tr>
								<tr>
									<td>Landline No.:</br><?php //echo $value['landline'];?></td>
									
									<td>Inst is Under:</br><?php //echo $value['ins_under'];?></td>
									<td></td>
								</tr>
								<tr>
									<td>Mobile No.:</br><?php //echo $value['mobile'];?></td>
									
									<td>Institution Email:</br><?php // echo $value['ins_email'];?></td>
									<td></td>
								</tr>
								<tr>
									<td>Society/Trust Email:</br><?php //echo $value['email'];?></td>
									<td></td>
									<td></td>
								</tr>
							</tbody>
						</table> 
					</div>
					<div class="table-responsive">
						<table class="table table-bordered table-responsive">
							<tbody>
								<tr>
									<td >Program,Seats and Total No. of Admitted Student Details</td>							
									<td ><?php //echo $value['student_total'];?></td>
								</tr>							
								<tr>
									<td >M.Sc(N) Student Details</td>							
									<td ><?php //echo $value['student_msc'];?></td>
								</tr>							
								<tr>
									<td >Affiliated Hospital Details</td>
									<td ><?php // echo $value['student_pbb'];?></td>
								</tr>							
								<tr>
									<td >PBB.Sc(N) Student Details</td>							
									<td ><?php // echo $value['student_pbb'];?></td>
								</tr>							
								<tr>
									<td >Distance Education Details</td>							
									<td ><?php //echo $value['distance_edu'];?></td>
								</tr>							
								<tr>
									<td >Other Short Term Course Details</td>							
									<td ><?php //echo $value['other_short'];?></td>
								</tr>						
							</tbody>
						</table>
					</div>
					<h3>Other Short Term Course Details : -</h3>
					<div class="table-responsive">
						<table class="table table-bordered table-responsive">
							<tr>
								<td>Sl. No.</td>
								<td>Laboratory Name</td>
								<td>Size of Laboratory</td>
								<td>No. of Equipments & Articles</td>
								<td>No. of Dummies & Dolls</td>
								<td>No. of the Class Rooms</td>
								<td>Size of the Class Rooms</td>
								<td>Entry Date</td>
							</tr>
							<?php
							$i=1;
							foreach ($todos_lab as $key => $value_lab) 
							{
								?>						
								<tr>
									<td><?php echo $i;?></td>
									<td><?php echo $value_lab['lab_name'];?></td>
									<td><?php echo $value_lab['lab_size'];?></td>
									<td><?php echo $value_lab['no_equp'];?></td>
									<td><?php echo $value_lab['no_dum'];?></td>
									<td><?php echo $value_lab['no_cls'];?></td>
									<td><?php echo $value_lab['size_cls'];?></td>
									<td><?php echo $value_lab['ent_date_lab'];?></td>				
								</tr>
								<?php 
								$i++; 
							} 
							?>
						</table>
					</div>
					<h3>Building and Penalty Details : - </h3>
					<table class="table table-bordered table-responsive">
						<thead>
							<tr>
								<td style="width: 50%;"><center>Building</center></td>
								<td style="width: 50%;"><center>Penalty<center></td>							
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Online Registration of all the said details on the website for 2016-2017 academic year:<?php //echo $value['onln_reg'];?></td>
								<td>If, Penalty of the building asked during 2016-2017 then submit the D.D. of Penalty in form of "Secretary, Jharkhand Nursing Council, Ranchi":<?php //echo $value['penalty'];?></td>
							</tr>
							<tr>
								<td>General Profile:<?php // echo $value['general'];?>Physical:<?php // echo $value['physical'];?>Clinical:<?php // echo $value['clinical'];?>Admission:<?php // echo $value['admission'];?>Teachers:<?php // echo $value['teachers'];?></td>
								<td>Demand Draft(DD) Number:<?php // echo $value['dd_number'];?></td>
							</tr>
							<tr>
								<td>Previous Year Annual Fees Paid:<?php // echo $value['pre_year'];?></td>
								<td>Demand Draft(DD) Attachment:</td>
							</tr>
							<tr>
								<td>Challan Attachment:<?php // echo $value['id'];?></td>
								<td>Demand Draft(DD) Date:<?php // echo $value['dd_date'];?></td>
							</tr>
							<tr>
								<td>Building Status:<?php // echo $value['building'];?></td>
								<td>Built-up area of Teaching Block:<?php // echo $value['build_area'];?></td>
							</tr>
							<tr>
								<td>Location (Institution's full address) of the building:<?php // echo $value['loc_full_address'];?></td>
								<td>Built-up area of Hostel Block:<?php // echo $value['build_hostel'];?></td>
							</tr>
							<tr>
								<td>Total area of the building:<?php // echo $value['tot_area'];?></td>
								<td>Entry Date:<?php // echo $value['ent_date_pen'];?></td>
							</tr>
							<tr>
								<td>Blue print should be signed by the Authority:<?php // echo $value['blueprint'];?></td>
								<td>Building Completion Certificate/Building status report attested by refistered architect with valid registration number as per INC circular dated 10.03.2016: along with the following details:<?php // echo $value['build_name'];?></td>
							</tr>
							<tr>
								<td>Two photographs of the complete building taken from different angle duly certificate by the architect:</td>
								<td>
									<img src="<?php echo base_url('assets/img/img.jpg'); ?>" class="img-responsive" style="height:50px;">
									<hr>
									<img src="<?php echo base_url('assets/img/img.jpg'); ?>" class="img-responsive" style="height:50px;">
								</td>
							</tr>
						</tbody>
					</table>
					<h3>Teaching Faculty Details : -</h3>
					<table class="table-bordered table-responsive">
						<tr>
							<td>S.No.</td>
							<td>Faculty Name, Gender, Designation and Qualification</td>
							<td>Institute Name, Passing Year, Date of Joining and Qualification Certificate</td>
							<td>RN/RM Number, Certificate, NUID No. and Entry Date</td>
							<td>Teaching Experience and Faculty Image</td>
						</tr>
						<?php
						$i=1;
						foreach ($todos_fac as $value_fac) 
						{
							?>
						
							<tr>
								<td><?php echo $i.'.'; ?></td>
								<td>Faculty Name: <?php echo $value_fac['fac_name']?></td>
								<td>Institute Name: <?php echo $value_fac['fac_inst']?></td>
								<td>RN/RM Number: <?php echo $value_fac['fac_r_num']?></td>
								<td>UG Teaching Exp.: <?php echo $value_fac['fac_ug']?></td>
							</tr>
							<tr>
								<td></td>
								<td>Gender: <?php echo $value_fac['fac_gen']?></td>
								<td>Passing Year: <?php echo $value_fac['fac_pass']?></td>
								<td>RN/RM Certificate: </td>
								<td>PG Teaching Exp.: <?php echo $value_fac['fac_pg']?></td>
							</tr>
							<tr>
								<td></td>
								<td>Designation: <?php echo $value_fac['fac_des']?></td>
								<td>Date of Joining: <?php echo $value_fac['fac_join']?></td>
								<td>Aadhar Number: <?php echo $value_fac['fac_adhr']?></td>
								<td>Diploma Teaching Exp.: <?php echo $value_fac['fac_dip']?></td>
							</tr>
							<tr>
								<td></td>
								<td>Qualification: <?php echo $value_fac['fac_qual']?></td>
								<td>Qualification Certificate Attachment: </td>
								<td>Entry Date: <?php echo $value_fac['fac_ent']?></td>
								<td>Faculty Image: <div style="border:1px solid black; width:120px; height:135px;"></div></td>
							</tr>
							<?php 
							$i++;
						}
						?>
					</table>
					<h3>Affiliated Hospital Details : -</h3>
					<table class="table-bordered table-responsive">
						<tr>
							<td>Sl. No.</td>
							<td>Hospital Name</td>
							<td>Address</td>
							<td>Number of Beds</td>
							<td>Bed Occupancy</td>
							<td>Entry Date</td>
						</tr>
						<tr>
							<td>1. </td>
							<td><?php //echo $value['affl_hos']?></td>
							<td><?php //echo $value['affl_address']?></td>
							<td><?php //echo $value['affl_beds']?></td>
							<td><?php //echo $value['affl_bed_occu']?></td>
							<td><?php //echo $value['affl_ent']?></td>
						</tr>
					</table>
					
					<h3>Library Facilities and Declaration Details : -</h3>
					<table class="table-bordered table-responsive">
						<tr>
							<td>Nursing Books</td>
							<td>Anti Ragging and HIV/AIDS/TB Details</td>
							<td>Declaration</td>
							<td>Date and Place</td>
						</tr>
						<tr>
							<td>Nursing Books :</br><?php //echo $value['nur_books']?></td>
							<td>Total Number of students have been trained in HIV/AIDS/TB Module :</br><?php // echo $value['nur_no_hiv']?></td>
							<td>Declaration Candidate Name :</br><?php //echo $value['dec_name']?></td>
							<td>Applicant Name :</br><?php //echo $value['app_dec_name']?></td>
						</tr>
						<tr>
							<td>Number of Nursing Journals Subscribed (National) :</br><?php //echo $value['nur_jour_nat']?></td>
							<td>Anti Ragging Monitoring Committee, If yes Members & their Mobile Numbers :</br><?php //echo $value['anti_rag']?></td>
							<td>S/O, D/O or W/O :</br><?php //echo $value['sodowo']?></td>
							<td>Date :</br><?php //echo $value['nur_ent']?></td>
						</tr>
						<tr>
							<td>Number of Nursing Journals Subscribed (International) :</br><?php //echo $value['nur_jour_int']?></td>
							<td>Anti Ragging Squad, If yes Members & their Mobile Numbers :</br><?php //echo $value['anti_rag_mob']?></td>
							<td></td>
							<td>Place :</br><?php //echo $value['nur_place']?></td>
						</tr>
					</table>
					<h3>Name of the Faculty trained under GFATM Programme Details : -</h3>
					<table class="table-bordered table-responsive">
							
							<tr>
								<td>Sl. No.</td>
								<td>Name of the Faculty</td>
								<td>HIV/AIDS</td>
								<td>TB</td>
							</tr>

							<?php
							$i=1;
							foreach ($todos_gfa as $key => $value_gfa) 
							{
								?>
								<tr>
									<td><?php echo $i;?></td>
									<td><?php echo $value_gfa['gfa_name'];?></td>
									<td><?php echo $value_gfa['gfa_hiv'];?></td>
									<td><?php echo $value_gfa['gfa_tb'];?></td>
								</tr>
								<?php 
								$i++; 
							} 
							?>
					</table>				
					<div class="row">
						<div class="col-sm-4"></div>
						<div class="col-sm-2">
							<a href="javascript:void();" class="btn btn-success btn-block">Edit </a>
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
	