<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style>
	h4 {
	margin: 0.3em;
	}	
	#main_table{
	 border:1px solid black;
	 width:100%; 
	 margin-top: 40px;
	}
	table{
	 border:1px solid black;
	 width:100%; 
	 //margin-top: 40px;
	}
	th{
		padding: 10px;
		text-align: center;
	}
	td{
		padding: 5px;
	}
	.blank{
		padding: 10px;
	}
	</style>
	
	
<style>
* {
    box-sizing: border-box;
}


.column {
    float: left;
    width: 50%;
    padding: 10px;
    height: 300px; 
}


.row:after {
    content: "";
    display: table;
    clear: both;
}
</style>

</head>
<?php
foreach ($todos as $key => $value) {
}

?>
<body>
	<table id="main_table" rules="all" >
		<tbody>
			<tr style="border:0px;"><td colspan="3"><center><strong><h4>YOUR REGISTRATION NUMBER IS:<?php echo $value['id'];?></h4></strong></center></td></tr>
			<tr><td colspan="3"><strong><h4>Institution and Society/Trust/Mission Details</h4></strong></td></tr>
			<tr>
				<th>Society/Trust/Mission</th>
				<th>Institution Details</th>
				<th>Fee Code/Principal Details</th>
			</tr>
			<tr>
				<td><strong>Chairperson/Registrar Name:</strong></br><?php echo $value['chairperson'];?></td>
				<td><strong>Name of the Instiution:</strong></br><?php echo $value['institution'];?></td>
				<td><strong>Applicant ID:</strong></br><?php echo $value['id'];?></td>
			</tr>
			<tr>
				<td><strong>Society/Trust Name:</strong></br><?php echo $value['society'];?></td>
				<td><strong>Address of the Instiution:</strong></br><?php echo $value['address_ins'];?></td>
				<td><strong>Fee Code:</strong></br><?php echo $value['fee_code'];?></td>
			</tr>
			<tr>
				
				<td><strong>Address:</strong></br><?php echo $value['address'];?></td>
				<td><strong>Name of the Principal:</strong></br><?php echo $value['principal'];?></td>
				<td><strong>Entry Date:</strong></br><?php echo $value['ent_date'];?></td>
			</tr>
			<tr>
				<td><strong>List of Society Members:</strong></br><?php echo $value['soc_members'];?></td>
				
				<td><strong>District:</strong></br><?php echo $value['district_ins'];?></td>
				<td><strong>Email of the Principal:</strong></br><?php echo $value['email_prin'];?></td>
			</tr>
			<tr>
				<td><strong>State Name:</strong></br><?php echo $value['state'];?></td>
				
				<td><strong>Tehsil/Block:</strong></br><?php echo $value['tehsil_ins'];?></td>
				<td><strong>Landline No.:</strong></br><?php echo $value['landline_prin'];?></td>
			</tr>
			<tr>
				<td><strong>District:</strong></br><?php echo $value['district'];?></td>
				
				<td><strong>Pincode:</strong></br><?php echo $value['pin_ins'];?></td>
				<td><strong>Fax No.:</strong></br><?php echo $value['fax_prin'];?></td>
			</tr>
			<tr>
				<td><strong><strong>Tehsil/Block:</strong></br><?php echo $value['tehsil'];?></td>
				
				<td><strong>Landline No.:</strong></br><?php echo $value['landline_ins'];?></td>
				<td><strong>Mobile No.:</strong></br><?php echo $value['mobile_prin'];?></td>
			</tr>
			<tr>
				<td><strong>Pincode:</strong></br><?php echo $value['pin'];?></td>
				
				<td><strong>Fax No.:</strong></br><?php echo $value['fax_ins'];?></td>
				<td></td>
			</tr>
			<tr>
				<td><strong>Landline No.:</strong></br><?php echo $value['landline'];?></td>
				
				<td><strong>Inst is Under:</strong></br><?php echo $value['ins_under'];?></td>
				<td></td>
			</tr>
			<tr>
				<td><strong>Mobile No.:</strong></br><?php echo $value['mobile'];?></td>
				
				<td><strong>Institution Email:</strong></br><?php echo $value['ins_email'];?></td>
				<td></td>
			</tr>
			<tr>
				<td><strong>Society/Trust Email:</strong></br><?php echo $value['email'];?></td>
				
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td colspan="3" class="blank"></td>
			</tr>
			<tr>
				<td colspan="3"><center><strong>Program,Seats and Total No. of Admitted Student Details</strong></center></td>
			</tr>
			<tr>
				<td colspan="3"><?php echo $value['student_total'];?></td>
			</tr>
			<tr>
				<td colspan="3" class="blank"></td>
			</tr>
			<tr>
				<td colspan="3"><center><strong>M.Sc(N) Student Details</strong></center></td>
			</tr>
			<tr>
				<td colspan="3"><?php echo $value['student_msc'];?></td>
			</tr>
			<tr>
				<td colspan="3" class="blank"></td>
			</tr>
			<tr>
				<td colspan="3"><center><strong>Affiliated Hospital Details</strong></center></td>
			</tr>
			<tr>
				<td colspan="3" class="blank"></td>
			</tr>
			<tr>
				<td colspan="3"><center><strong>PBB.Sc(N) Student Details</strong></center></td>
			</tr>
			<tr>
				<td colspan="3"><?php echo $value['student_pbb'];?></td>
			</tr>
			<tr>
				<td colspan="3" class="blank"></td>
			</tr>
			<tr>
				<td colspan="3"><center><strong>Distance Education Details</strong></center></td>
			</tr>
			<tr>
				<td colspan="3"><?php echo $value['distance_edu'];?></td>
			</tr>
			<tr>
				<td colspan="3" class="blank"></td>
			</tr>
			<tr>
				<td colspan="3"><center><strong>Other Short Term Course Details</strong></center></td>
			</tr>
			<tr>
				<td colspan="3"><?php echo $value['other_short'];?></td>
			</tr>
			<tr>
				<td colspan="3" class="blank"></td>
			</tr>
			<tr>
				<td colspan="3">
					<table rules="all">
						<tr>
							<td><strong>Sl. No.</strong></td>
							<td><strong>Laboratory Name</strong></td>
							<td><strong>Size of Laboratory</strong></td>
							<td><strong>No. of Equipments & Articles</strong></td>
							<td><strong>No. of Dummies & Dolls</strong></td>
							<td><strong>No. of the Class Rooms</strong></td>
							<td><strong>Size of the Class Rooms</strong></td>
							<td><strong>Entry Date</strong></td>
						</tr>
						<?php
							$i=1;
							foreach ($todos_lab as $key => $value_lab) {
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
						<?php $i++; } ?>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="3" class="blank"></td>
			</tr>
			<tr>
				<td colspan="3"><center><strong>Building and Penalty Details</strong></center></td>
			</tr>
			<tr>
				<td colspan="3">
					<table rules="all">
						<tr>
							<td style="width: 50%;"><center><strong>Building</strong></center></td>
							<td style="width: 50%;"><center><strong>Penalty</strong><center></td>							
						</tr>
						<tr>
							<td><strong>Online Registration of all the said details on the website for 2016-2017 academic year:</strong><?php echo $value['onln_reg'];?></td>
							<td><strong>If, Penalty of the building asked during 2016-2017 then submit the D.D. of Penalty in form of "Secretary, Jharkhand Nursing Council, Ranchi":</strong><?php echo $value['penalty'];?></td>
						</tr>
						<tr>
							<td><strong>General Profile:</strong><?php echo $value['general'];?><strong>Physical:</strong><?php echo $value['physical'];?><strong>Clinical:</strong><?php echo $value['clinical'];?><strong>Admission:</strong><?php echo $value['admission'];?><strong>Teachers:</strong><?php echo $value['teachers'];?></td>
							<td><strong>Demand Draft(DD) Number:</strong><?php echo $value['dd_number'];?></td>
						</tr>
						<tr>
							<td><strong>Previous Year Annual Fees Paid:</strong><?php echo $value['pre_year'];?></td>
							<td><strong>Demand Draft(DD) Attachment:</strong></td>
						</tr>
						<tr>
							<td><strong>Challan Attachment:</strong><?php echo $value['id'];?></td>
							<td><strong>Demand Draft(DD) Date:</strong><?php echo $value['dd_date'];?></td>
						</tr>
						<tr>
							<td><strong>Building Status:</strong><?php echo $value['building'];?></td>
							<td><strong>Built-up area of Teaching Block:</strong><?php echo $value['build_area'];?></td>
						</tr>
						<tr>
							<td><strong>Location (Institution's full address) of the building:</strong><?php echo $value['loc_full_address'];?></td>
							<td><strong>Built-up area of Hostel Block:</strong><?php echo $value['build_hostel'];?></td>
						</tr>
						<tr>
							<td><strong>Total area of the building:</strong><?php echo $value['tot_area'];?></td>
							<td><strong>Entry Date:</strong><?php echo $value['ent_date_pen'];?></td>
						</tr>
						<tr>
							<td><strong>Blue print should be signed by the Authority:</strong><?php echo $value['blueprint'];?></td>
							<td><strong>Building Completion Certificate/Building status report attested by refistered architect with valid registration number as per INC circular dated 10.03.2016: along with the following details:</strong><?php echo $value['build_name'];?></td>
						</tr>
						<tr>
							<td><strong>Two photographs of the complete building taken from different angle duly certificate by the architect:</strong></td>
							<td>
							<div class="row">
                               <div class="column" style="border:1px solid black;">
                                 <h2>image 1</h2>   
                               </div> 
                             <div class="column" style="border:1px solid black;">
                             <h2>image 2</h2>
                           </div>
                     		</div>
							</td>
						</tr>
						
					</table>
				</td>
			</tr>
			<!-- //teaching faculty section -->
						<tr>
							<td colspan="3" class="blank"></td>
						</tr>
						<tr>
							<td colspan="3"><center><strong>Teaching Faculty Details</strong></center></td>
						</tr>
						<tr>
							<td colspan="3">
								<table rules="all">
									<tr>
										<td><strong>Sl. No.</strong></td>
										<td><strong>Faculty Name, Gender, Designation and Qualification</strong></td>
										<td><strong>Institute Name, Passing Year, Date of Joining and Qualification Certificate</strong></td>
										<td><strong>RN/RM Number, Certificate, NUID No. and Entry Date</strong></td>
										<td><strong>Teaching Experience and Faculty Image</strong></td>
									</tr>
									<?php
										$i=1;
										foreach ($todos_fac as $key => $value_fac) {
									?>
									
									<tr>
										<td ><?php echo $i.'.'; ?></td>
										<td><strong>Faculty Name: </strong><?php echo $value_fac['fac_name']?></td>
										<td><strong>Institute Name: </strong><?php echo $value_fac['fac_inst']?></td>
										<td><strong>RN/RM Number: </strong><?php echo $value_fac['fac_r_num']?></td>
										<td><strong>UG Teaching Exp.: </strong><?php echo $value_fac['fac_ug']?></td>
									</tr>
									<tr>
										<td></td>
										<td><strong>Gender: </strong><?php echo $value_fac['fac_gen']?></td>
										<td><strong>Passing Year: </strong><?php echo $value_fac['fac_pass']?></td>
										<td><strong>RN/RM Certificate: </strong></td>
										<td><strong>PG Teaching Exp.: </strong><?php echo $value_fac['fac_pg']?></td>
									</tr>
									<tr>
										<td></td>
										<td><strong>Designation: </strong><?php echo $value_fac['fac_des']?></td>
										<td><strong>Date of Joining: </strong><?php echo $value_fac['fac_join']?></td>
										<td><strong>Aadhar Number: </strong><?php echo $value_fac['fac_adhr']?></td>
										<td><strong>Diploma Teaching Exp.: </strong><?php echo $value_fac['fac_dip']?></td>
									</tr>
									<tr>
										<td></td>
										<td><strong>Qualification: </strong><?php echo $value_fac['fac_qual']?></td>
										<td><strong>Qualification Certificate Attachment: </strong></td>
										<td><strong>Entry Date: </strong><?php echo $value_fac['fac_ent']?></td>
										<td><strong>Faculty Image: </strong><div style="border:1px solid black; width:120px; height:135px;"></div></td>
									</tr>
									<?php $i++; }?>
								</table>
							</td>
						</tr>
			<!-- //teaching faculty section -->
			<!-- //affiliated hospital section -->
			
			<tr>
				<td colspan="6">
					<table rules="all">
						<tr>
				<td colspan="6" class="blank"></td>
			</tr>
			<tr>
				<td colspan="6"><center><strong>Affiliated Hospital Details</strong></center></td>
			</tr>
						<tr>
							<td><strong>Sl. No.</strong></td>
							<td><strong>Hospital Name</strong></td>
							<td><strong>Address</strong></td>
							<td><strong>Number of Beds</strong></td>
							<td><strong>Bed Occupancy</strong></td>
							<td><strong>Entry Date</strong></td>
						</tr>
						<tr>
							<td>1. </td>
							<td><?php echo $value['affl_hos']?></td>
							<td><?php echo $value['affl_address']?></td>
							<td><?php echo $value['affl_beds']?></td>
							<td><?php echo $value['affl_bed_occu']?></td>
							<td><?php echo $value['affl_ent']?></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="3" class="blank"></td>
			</tr>
			<tr>
				<td colspan="3"><center><strong>Library Facilities and Declaration Details</strong></center></td>
			</tr>
			<tr>
				<td colspan="4">
				<table rules="all">
						<tr>
							<td><strong>Nursing Books</strong></td>
							<td><strong>Anti Ragging and HIV/AIDS/TB Details</strong></td>
							<td><strong>Declaration</strong></td>
							<td><strong>Date and Place</strong></td>
						</tr>
						<tr>
							<td><strong>Nursing Books :</strong></br><?php echo $value['nur_books']?></td>
							<td><strong>Total Number of students have been trained in HIV/AIDS/TB Module :</strong></br><?php echo $value['nur_no_hiv']?></td>
							<td><strong>Declaration Candidate Name :</strong></br><?php echo $value['dec_name']?></td>
							<td><strong>Applicant Name :</strong></br><?php echo $value['app_dec_name']?></td>
						</tr>
						<tr>
							<td><strong>Number of Nursing Journals Subscribed (National) :</strong></br><?php echo $value['nur_jour_nat']?></td>
							<td><strong>Anti Ragging Monitoring Committee, If yes Members & their Mobile Numbers :</strong></br><?php echo $value['anti_rag']?></td>
							<td><strong>S/O, D/O or W/O :</strong></br><?php echo $value['sodowo']?></td>
							<td><strong>Date :</strong></br><?php echo $value['nur_ent']?></td>
						</tr>
						<tr>
							<td><strong>Number of Nursing Journals Subscribed (International) :</strong></br><?php echo $value['nur_jour_int']?></td>
							<td><strong>Anti Ragging Squad, If yes Members & their Mobile Numbers :</strong></br><?php echo $value['anti_rag_mob']?></td>
							<td></td>
							<td><strong>Place :</strong></br><?php echo $value['nur_place']?></td>
						</tr>
					</table>
				</td>
			</tr>
			<!-- //affiliated hospital section -->
		</tbody>
	</table> 
	<table rules="all">
			<tr>
				<td colspan="4" class="blank"></td>
			</tr>
			<tr>
				<td colspan="4"><center><strong>Name of the Faculty trained under GFATM Programme Details</strong></center></td>
			</tr>
			<tr>
				<td><strong>Sl. No.</strong></td>
				<td><strong>Name of the Faculty</strong></td>
				<td><strong>HIV/AIDS</strong></td>
				<td><strong>TB</strong></td>
			</tr>

			<?php
				$i=1;
				foreach ($todos_gfa as $key => $value_gfa) {
			?>
			<tr>
				<td><?php echo $i;?></td>
				<td><?php echo $value_gfa['gfa_name'];?></td>
				<td><?php echo $value_gfa['gfa_hiv'];?></td>
				<td><?php echo $value_gfa['gfa_tb'];?></td>
			</tr>
			<?php $i++; } ?>
	</table>
</body>
</html>