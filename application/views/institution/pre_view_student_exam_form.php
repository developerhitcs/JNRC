
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<?php
				if (isset($_SESSION['errmsg'])) 
				{
					?>
					<div class="alert alert-<?php echo $_SESSION['msg']; ?> alert-dismissible">
						<strong><?php echo $_SESSION['errmsg']; ?></strong>
						<button type="button" class="btn btn-danger btn-sm" data-dismiss="alert" aria-label="Close" style="float:right;margin-top:-5px;"><span aria-hidden="true">&times;</span></button>  
					</div>
					<?php
					unset($_SESSION['msg']);
					unset($_SESSION['errmsg']);
				}
				?>
			</div>
		</div> 
		<?php foreach($exam_form as $key){} ?>
		<?php foreach($batch_session as $bs){} ?>
		<div class="row">
			<div class="col-md-12">  
				<div class="card">
					<div class="card-header-primary">
						<span>Examination Form Details Preview</span>		
					</div>	
					<div class="card-body">
						<div id='printdivi'>
							<div class="row">
								<div class="col-sm-1"></div>
								<div class="col-sm-2">
									<center>
									<img src="<?php echo base_url('assets/images/logo_pdf.png');?>" class="img-fluid" style="width:100px;">
									</center>
								</div>
								<div class="col-sm-8 text-center">										
									<h3><b style="font-weight: 900;">JHARKHAND NURSES REGISTRATION COUNCIL, RANCHI</b></h3>
									<h4><b style="font-weight: 600;">EXAMINATION APPLICATION FORM </b></h4>										
								</div>
								<div class="col-sm-1"></div>
							</div><hr>
							<h4 class="text-danger" style="font-weight: 800;">PERSONAL INFORMATION :-</h4><hr>
							<div class="material-datatables table-responsive">
								<table class="table table-striped table-bordered" style="width: 100%">
									<tbody>
										<tr>
											<th width="20%">Course</th>
											<td  width="30%"><?php echo $key['course']; ?></td>
											<th  width="20%">Name</th>  
											<td  width="30%"><?php echo $key['name'];?></td>
										</tr>
										<tr>
											<th >Father's Name</th>
											<td><?php echo $key['father_name'];?></td>
											<th>Mother's Name</th>  
											<td><?php echo $key['mother_name'];?></td>
										</tr>
										<tr>
											<th >Date of Birth</th>
											<td><?php echo $key['dob'];?></td>
											<th>Age</th>  
											<td><?php echo $key['age'];?></td>
										</tr>
										<tr>
											<th >Aadhar No.</th>
											<td><?php echo $key['aadhar'];?></td>
											<th>Marital Status</th>  
											<td><?php  echo $key['marital'];?></td>
										</tr>
										<tr>
											<th >Nationality</th>
											<td><?php echo $key['nationality'];?></td>
											<th >Permanent Address</th>
											<td><?php echo $key['perm_address'];?></td>
										</tr>
										<tr>
											<th >Name of Training School</th>
											<td><?php echo $key['train_school'];?></td>
											<th>Medium of Exam</th>  
											<td><?php echo $key['medium_exam'];?></td>
										</tr>
											<tr>
											<th >Passing Marksheet</th>
											<td><a href="<?php echo base_url('uploads/exam_form/'.$key['ref_no'].'/'.$key['passing_marksheet'].''); ?>" target="_blank" class="btn btn-sm btn-success">View Passing Marksheet</a></td>
												<th>CML Rank</th>  
											<td><?php echo $key['cmlrank'];?></td>
										</tr>
									</tbody>
								</table>
							</div>
							<h4 class="text-danger" style="font-weight: 800;">EDUCATIONAL QUALIFICATIONS :-</h4><hr>
							<div class="material-datatables table-responsive">
								<table class="table table-striped table-bordered" style="width: 100%">
									<thead>
										<tr>
											<th style="width: 5%">Sl. No.</th>
											<th style="width: 30%">Name of Board/ University</th>
											<th style="width: 8%">Year of Passing</th>
											<th style="width: 8%">Roll No.</th>
											<th style="width: 8%">Total Marks Obtained</th>
											  <th style="width: 30%">Name of the School/College</th>
											  <th style="width: 10%">Upload Verification Report(*)</th>
											
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>1.</td>
											<td><?php echo $key['board_1'];?></td>
											<td><?php echo $key['year_1'];?></td>
											<td><?php echo $key['roll_1'];?></td>
											<td><?php echo $key['marks_1'];?></td>
											<td><?php echo $key['school_1'];?></td>
											<td><a href="<?php echo base_url('uploads/exam_form/'.$key['ref_no'].'/'.$key['file1'].''); ?>" target="_blank" class="btn btn-sm btn-success">View Matric Report</a></td>
										</tr>
										<tr>
											<td>2.</td>
											<td><?php echo $key['board_2'];?></td>
											<td><?php echo $key['year_2'];?></td>
											<td><?php echo $key['roll_2'];?></td>
											<td><?php echo $key['marks_2'];?></td>
											<td><?php echo $key['school_2'];?></td>
											<td><a href="<?php echo base_url('uploads/exam_form/'.$key['ref_no'].'/'.$key['file2'].''); ?>" target="_blank" class="btn btn-sm btn-success">View Inter Report</a></td>
										</tr>
										<tr>
											<td>3.</td>
											<td><?php echo $key['board_3'];?></td>
											<td><?php echo $key['year_3'];?></td>
											<td><?php echo $key['roll_3'];?></td>
											<td><?php echo $key['marks_3'];?></td>
											<td><?php echo $key['school_3'];?></td>
											<td></td>						 
										</tr>
										<tr>
											<td>4.</td>
											<td><?php echo $key['board_4'];?></td>
											<td><?php echo $key['year_4'];?></td>
											<td><?php echo $key['roll_4'];?></td>
											<td><?php echo $key['marks_4'];?></td>
											<td><?php echo $key['school_4'];?></td>
											<td></td>						  
										</tr>
									</tbody>
								</table>						
							</div>
							<div class="row">
								<div class="col-sm-8">
									<h4 class="text-danger" style="font-weight: 800;">I WISH TO BE EXAMINED IN THE FOLLOWING SUBJECTS :-</h4><hr>
									<div class="material-datatables table-responsive">
										<table class="table table-striped table-bordered" style="width: 100%">
											<tbody>
												<tr>
													<td>A.</td>
													<td><?php echo $key['sub_1'];?></td>
													<td>B.</td>
													<td><?php echo $key['sub_2'];?></td>
												</tr>
												<tr>
													<td>C.</td>
													<td><?php echo $key['sub_3'];?></td>
													<td>D.</td>
													<td><?php echo $key['sub_4'];?></td>
												</tr>
												<tr>
													<td>E.</td>
													<td><?php echo $key['sub_5'];?></td>
													<td>F.</td>
													<td><?php echo $key['sub_6'];?></td>
												</tr>
												<tr>
													<td>G.</td>
													<td><?php echo $key['sub_7'];?></td>
													<td>H.</td>
													<td><?php echo $key['sub_8'];?></td>
												</tr>
											</tbody>
										</table>						
									</div>
								</div>
								<div class="col-sm-4">
									<h4 class="text-danger" style="font-weight: 800;">Candidate Photo / Signature  :-</h4><hr>
									<img class="img-fluid img-thumbnail" src="<?php echo base_url('uploads/exam_form/'.$key['ref_no'].'/'.$key['img1'].''); ?>" style="height:100px">
									<img class="img-fluid img-thumbnail" src="<?php echo base_url('uploads/exam_form/'.$key['ref_no'].'/'.$key['img2'].''); ?>" style="height:100px">
								</div>
							</div>
							<div class="form-check mr-auto">
								<label class="text-success" style="font-size: 18px;font-weight: 600;">											
									<input type="checkbox" name="resitter_status" id="resitter" onclick="show_full()" <?php if($key['resitter_status']=='On'){ echo 'checked';} ?>> 
									Are You A Resitter candidate Yes Then Click Checkbox Otherwise Not :-												
								</label>
							</div>
							<div class="resitter_div" style="<?php if($key['resitter_status']=='On'){ echo 'display: inline;';} else {echo 'display: none;';}  ?>">
								<h4 class="text-danger" style="font-weight: 800;">FOR RE-SITTER CANDIDATES :-</h4><hr>
								<p class="p_text">
									I sat <b><?php echo $key['no_times'];?></b> times, the last examination. I sat for was in the month of <b><?php echo $key['rmonth1'];?> </b>from <b><?php echo $key['rtrainschool'];?></b> Training School, under Roll <b><?php echo $key['rroll1'];?></b> No.<b><?php echo $key['rno1'];?></b>
									I have passed <b><?php echo $key['rcourse'];?> <?php echo $key['ryear2'];?> </b> Examination conducted by Jharkhand Nurses Registration Council <b> <?php echo $key['rcouncil'];?> </b> School of Nursing in the month of <b> <?php echo $key['rmonth2'];?></b> with Roll <b> <?php echo $key['rroll2'];?></b> No. <b> <?php echo $key['rno2'];?></b> I wish to be examined in <b> <?php echo $key['rlang'];?></b>.
								</p>
							</div>
				 
							<h4 class="text-danger" style="font-weight: 800;">ENDORSEMENT BY SCHOOL OF NURSING :- </h4><hr>
							<p class="p_text">	
								I consider Miss/Mrs./Sr. <b><?php echo $key['ename'];?></b> Year Student is suitable for appearing in ensuing examination to be held in the month of <b><?php echo $key['emonth1'];?></b> for appearing in ensuing examination to be held in the month of  <b><?php echo $key['emonth1'];?></b> Year <b><?php echo $key['eyear1'];?></b> conducted by Jharkhand Nurses Registration Council. 
								Her work/Clinical Work is satisfactory.	Her conduct is <b><?php echo $key['econduct'];?></b> 
							</p>
							<div class="material-datatables table-responsive">
								<table class="table table-striped table-bordered" style="width: 100%">
									<tbody>
									<tr>
									<td></td>
									<td>PTS/1st Year</td>
									<td>2nd Year</td>
									<td>3rd Year</td>
									</tr>
									<tr>
									<td>Date of Joining</td>
									<td><b><?php echo $key['edoj1'];?></b></td>
									<td><b><?php echo $key['edoj2'];?></b></td>
									<td><b><?php echo $key['edoj3'];?></b></td>
									</tr>
									<tr>
									<td>Total Leaved availed in</td>
									<td><b><?php echo $key['eleave1'];?></b></td>
									<td><b><?php echo $key['eleave2'];?></b></td>
									<td><b><?php echo $key['eleave3'];?></b></td>
									</tr>

									</tbody>
								</table>
							</div>
							
							<div class="row">
								<div class="col-sm-12 ">
									<p class="p_text">
										We certify that she has put in <b><?php echo $key['eyear2'];?></b> Year <b><?php echo $key['emonth2'];?></b>
										Month and <b><?php echo $key['eday'];?></b> days training exclusive of leave and has attended 75% Lectures/Clinical in each subject field / 
										Clinical experience and that she is "Eligible" to appear at the examination as per terms and condition lad / id down by INDIAN NURSING COUNCIL Syllabus.
									</p>
								</div>
							</div>
							<br>
							<div class="material-datatables table-responsive">
								<h4 class="text-danger" style="font-weight: 800;">SHE / HE HAS ATTENDED THE UNDERMENTIONED NUMBER OF LECTURES  :-</h4><hr>
								<table class="table table-striped table-bordered" style="width: 100%; text-align: center;">
									<tbody>
										<tr>
											<td rowspan="2"></td>
											<td rowspan="2"><strong>SUBJECT</strong></td>
											<td colspan="3"><strong>NUMBER OF LECTURES</strong></td>
										</tr>
										<tr>
											<td><strong>DELIVERED</strong></td>
											<td><strong>ATTENDED</strong></td>
											<td><strong>PERCENTAGE</strong></td>
										</tr>
										<tr>
											<td>A.</td>
											<td><b><?php echo $key['lsub_1'];?></b></td>
											<td><b><?php echo $key['ldel_1'];?></b></td>
											<td><b><?php echo $key['latt_1'];?></b></td>
											<td><b><?php echo $key['lper_1'];?></b></td>
										</tr>
										<tr>
											<td>B.</td>
											<td><b><?php echo $key['lsub_2'];?></b></td>
											<td><b><?php echo $key['ldel_2'];?></b></td>
											<td><b><?php echo $key['latt_2'];?></b></td>
											<td><b><?php echo $key['lper_2'];?></b></td>
										</tr>
										<tr>
											<td>C.</td>
											<td><b><?php echo $key['lsub_3'];?></b></td>
											<td><b><?php echo $key['ldel_3'];?></b></td>
											<td><b><?php echo $key['latt_3'];?></b></td>
											<td><b><?php echo $key['lper_3'];?></b></td>
										</tr>
										<tr>
											<td>D.</td>
											<td><b><?php echo $key['lsub_4'];?></b></td>
											<td><b><?php echo $key['ldel_4'];?></b></td>
											<td><b><?php echo $key['latt_4'];?></b></td>
											<td><b><?php echo $key['lper_4'];?></b></td>
										</tr>
										<tr>
											<td>E.</td>
											<td><b><?php echo $key['lsub_5'];?></b></td>
											<td><b><?php echo $key['ldel_5'];?></b></td>
											<td><b><?php echo $key['latt_5'];?></b></td>
											<td><b><?php echo $key['lper_5'];?></b></td>
										</tr>
										<tr>
											<td>F.</td>
											<td><b><?php echo $key['lsub_6'];?></b></td>
											<td><b><?php echo $key['ldel_6'];?></b></td>
											<td><b><?php echo $key['latt_6'];?></b></td>
											<td><b><?php echo $key['lper_6'];?></b></td>
										</tr>
										<tr>
											<td>G.</td>
											<td><b><?php echo $key['lsub_7'];?></b></td>
											<td><b><?php echo $key['ldel_7'];?></b></td>
											<td><b><?php echo $key['latt_7'];?></b></td>
											<td><b><?php echo $key['lper_7'];?></b></td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="form-check mr-auto">
								<label>
									<input type="checkbox" checked readonly> 
									I have verified all the fields carefully and the information given by me are true to my belief and knowledge.
								</label>
							</div>
							<center>
								<a href="<?php echo base_url('view_exam_form/').$key['id'];?>" class="btn btn-success"><i class="fa fa-edit"></i> Edit Details</a>
								<a href="javascript:void();" onclick="printDiv('printdivi')" class="btn btn-danger"><i class="fa fa-print"></i> Print</a>
							</center>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
function printDiv(divName) 
{      
	var printContents = document.getElementById(divName).innerHTML;
	var originalContents = document.body.innerHTML;
	document.body.innerHTML = printContents;
	window.print();
	document.body.innerHTML = originalContents;
}
function show_full()
{
	var ab = $('#resitter').is(':checked'); 
	if(ab==true)
	{ 
		$('.resitter_div').show(200);		
	}
	else
	{
		$('.resitter_div').hide(200);		
	}
}
</script>


