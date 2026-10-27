
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
		<?php foreach($row as $ed){} ?>
		
		<div class="row">
			<div class="col-md-12">  
				<div class="card">
					<div class="card-header-warning">
						<span>Admin Edit Examination Application Form </span>		
					</div>	
					<div class="card-body">
						
							<form method="post" action="<?php echo base_url('admin_final_update_exam_form');?>" enctype="multipart/form-data">
								<input type="hidden" name="update_id" value="<?php echo $ed['id']; ?>">
								<div class="row">								
									<div class="col-sm-4">
										<div class="form-group bmd-form-group is-filled">
											<label class="bmd-label-floating">Choose Course <small class="text-danger">*</small></label>
											<select class="form-control" name="course" required="">
												<option value="<?php echo $ed['course']; ?>" selected><?php echo $ed['course']; ?></option>
											</select>								
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group bmd-form-group">
											<label class="bmd-label-floating">Name <small class="text-danger">*</small></label>
											<input type="text" class="form-control" name="name" value="<?php echo $ed['name']; ?>" required="" autocomplete="off" >
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group bmd-form-group">
											<label class="bmd-label-floating">Father's Name <small class="text-danger">*</small></label>
											<input type="text" class="form-control" name="father_name" value="<?php echo $ed['father_name']; ?>" required="" autocomplete="off" >
										</div>
									</div>	
									<div class="col-sm-4">
										<div class="form-group bmd-form-group">
											<label class="bmd-label-floating">Mother's Name <small class="text-danger">*</small></label>
											<input type="text" class="form-control" name="mother_name" value="<?php echo $ed['mother_name']; ?>" required="" autocomplete="off" >
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group bmd-form-group is-filled">
											<label class="bmd-label-floating">Date Of Birth <small class="text-danger">*</small></label>
											<input type="text" name="dob" id="dob"  class="form-control datepicker" value="<?php echo $ed['dob']; ?>" required="" autocomplete="off" >
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group bmd-form-group">
											<label class="bmd-label-floating">Age : (must be between 17-35) <small class="text-danger">*</small></label>
											<input type="text" class="form-control"  name="age" required="" value="<?php echo $ed['age']; ?>" autocomplete="off" >
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group bmd-form-group">
											<label class="bmd-label-floating">Aadhar No. <small class="text-danger">*</small></label>
											<input type="tel" maxlength="12" pattern = "[0-9]+" class="form-control" name="aadhar" required="" value="<?php echo $ed['aadhar']; ?>" autocomplete="off" >
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group bmd-form-group is-filled">
											<label class="bmd-label-floating">Choose Marital Status <small class="text-danger">*</small></label>
											<select class="form-control" name="marital" required="">
												<option value="<?php echo $ed['marital']; ?>" selected><?php echo $ed['marital']; ?></option>
												
											</select>								
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group bmd-form-group">
											<label class="bmd-label-floating">Nationality <small class="text-danger">*</small></label>
											<input type="text" class="form-control" name="nationality" value="<?php echo $ed['nationality']; ?>" readonly required="" autocomplete="off" >
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group bmd-form-group">
											<label class="bmd-label-floating">Name of Training School <small class="text-danger">*</small></label>
											<input type="text" class="form-control" name="train_school" value="<?php echo $ed['train_school']; ?>" readonly required="" autocomplete="off" >
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group bmd-form-group is-filled">
											<label class="bmd-label-floating">Choose Medium of Exam <small class="text-danger">*</small></label>
											<select class="form-control" name="medium_exam" required="">
												<option value="<?php echo $ed['medium_exam']; ?>" selected><?php echo $ed['medium_exam']; ?></option>
												
											</select>								
										</div>
									</div>
										<div class="col-sm-4">
										<div class="form-group bmd-form-group">
											<label class="bmd-label-floating">CML Rank <small class="text-danger">*</small></label>
											<input type="text" class="form-control" name="cmlrank" value="<?php echo $ed['cmlrank']; ?>"  required="" autocomplete="off" >
										</div>
									</div>
									<div class="col-sm-6">  
										<div class="form-group bmd-form-group">
											<label class="bmd-label-floating">Address <small class="text-danger">*</small></label>
											<input type="text" class="form-control" name="perm_address" required="" value="<?php echo $ed['perm_address']; ?>" autocomplete="off">
										</div>
									</div>
									<div class="col-sm-6">
    <div class="form-group bmd-form-group">
        <label class="bmd-label-floating">
            Phone Number <small class="text-danger">*</small>  
        </label>
        <input type="text" 
               class="form-control" 
               name="phone_number"
               maxlength="10"
               required=""
               value="<?php echo $ed['phone_number']; ?>"
               autocomplete="off">
    </div>
</div>
									 <div class="col-sm-12"  >																	
										<label class="bmd-label-floating">Passing Marksheet <small class="text-danger">*</small></label>
										<!--<input type="file" class="form-control"  name="passing_marksheet" >-->
										<br>
										<input type="hidden" name="old_passing_marksheet" value="<?php echo $ed['passing_marksheet']; ?>" class="form-control " required="">
										<a href="<?php echo base_url('uploads/exam_form/'.$ed['ref_no'].'/'.$ed['passing_marksheet'].''); ?>" target="_blank" class="btn btn-sm btn-success"><i class="fa fa-eye"></i> Click To View</a>
										
									    <p>Note:- <strong style="color:red;">Those students who are in their 2nd year, kindly upload your 1st year marksheet, and those students who are in their 3rd year, kindly upload your 2nd year marsheet.</strong></p>
									</div>
									<div class="col-sm-12 mt-3">
										<h4 class="text-primary" style="font-weight: 800;">EDUCATIONAL QUALIFICATIONS :-</h4><hr>
										<div class="material-datatables table-responsive">
											<table class="table table-striped table-bordered" style="width: 100%">
												<thead>
													<tr>
														<th>#</th>
														<th>Name of Board</th>
														<th>Passing Year</th>
														<th>Roll No.</th>
														<th>Total Marks Obtained</th>
														<th>Name of The School/College</th>
														<th>Upload Verification Report <br><small class="text-danger">(Less than 1 MB AND JPG or PDF format)</small></th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>1.</td>
														<td><input type="text" name="board_1" value="<?php echo $ed['board_1']; ?>" class="form-control " placeholder="Matric Details" required=""></td>
														<td><input type="text" name="year_1" value="<?php echo $ed['year_1']; ?>" class="form-control " required=""></td>
														<td><input type="text" name="roll_1" value="<?php echo $ed['roll_1']; ?>" class="form-control" required=""></td>
														<td><input type="text" name="marks_1" value="<?php echo $ed['marks_1']; ?>" class="form-control" required=""></td>
														<td><input type="text" name="school_1" value="<?php echo $ed['school_1']; ?>" class="form-control " required=""></td>
														<td>
															<input type="file" name="matric"  class="form-control " >
															<input type="hidden" name="old_matric" value="<?php echo $ed['file1']; ?>" class="form-control " required="">
															<a href="<?php echo base_url('uploads/exam_form/'.$ed['ref_no'].'/'.$ed['file1'].''); ?>" target="_blank" class="btn btn-sm btn-success"><i class="fa fa-eye"></i> Click To View</a>
														</td>
													</tr>
													<tr>
														<td>2.</td>
														<td><input type="text" name="board_2" value="<?php echo $ed['board_2']; ?>" class="form-control " placeholder="Intermediate Details" required=""></td>
														<td><input type="text" name="year_2" value="<?php echo $ed['year_2']; ?>" class="form-control" required=""></td>
														<td><input type="text" name="roll_2" value="<?php echo $ed['roll_2']; ?>" class="form-control" required=""></td>
														<td><input type="text" name="marks_2" value="<?php echo $ed['marks_2']; ?>" class="form-control" required=""></td>
														<td><input type="text" name="school_2" value="<?php echo $ed['school_2']; ?>" class="form-control " required=""></td>
														<td>
															<input type="file" name="inter" class="form-control ">
															<input type="hidden" name="old_inter" class="form-control " value="<?php echo $ed['file2']; ?>" required="">
															<a href="<?php echo base_url('uploads/exam_form/'.$ed['ref_no'].'/'.$ed['file2'].''); ?>" target="_blank" class="btn btn-sm btn-success"><i class="fa fa-eye"></i> Click To View</a>
														</td>
													</tr>
													<tr>
														<td>3.</td>
														<td><input type="text" name="board_3" value="<?php echo $ed['board_3']; ?>" class="form-control"></td>
														<td><input type="text" name="year_3" value="<?php echo $ed['year_3']; ?>" class="form-control"></td>
														<td><input type="text" name="roll_3" value="<?php echo $ed['roll_3']; ?>" class="form-control"></td>
														<td><input type="text" name="marks_3" value="<?php echo $ed['marks_3']; ?>" class="form-control"></td>
														<td><input type="text" name="school_3" value="<?php echo $ed['school_3']; ?>" class="form-control "></td>
														<td></td>
													</tr>
													<tr>
														<td>4.</td>
														<td><input type="text" name="board_4" value="<?php echo $ed['board_4']; ?>" class="form-control"></td>
														<td><input type="text" name="year_4" value="<?php echo $ed['year_4']; ?>" class="form-control"></td>
														<td><input type="text" name="roll_4" value="<?php echo $ed['roll_4']; ?>" class="form-control"></td>
														<td><input type="text" name="marks_4" value="<?php echo $ed['marks_4']; ?>" class="form-control"></td>
														<td><input type="text" name="school_4" value="<?php echo $ed['school_4']; ?>" class="form-control "></td>
														<td></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="col-sm-12 mt-3 ">
										<h4 class="text-primary" style="font-weight: 800;">I WISH TO BE EXAMINED IN THE FOLLOWING SUBJECTS :-</h4><hr>
										<div class="material-datatables table-responsive">
											<table class="table table-striped table-bordered " style="width: 100%">
												<tbody>
													<tr>
														<td>A.</td>
														<td><input type="text" name="sub_1" value="<?php echo $ed['sub_1']; ?>" class="form-control"></td>
														<td>B.</td>
														<td><input type="text" name="sub_2" value="<?php echo $ed['sub_2']; ?>" class="form-control"></td>
													</tr>
													<tr>
														<td>C.</td>
														<td><input type="text" name="sub_3" value="<?php echo $ed['sub_3']; ?>" class="form-control"></td>
														<td>D.</td>
														<td><input type="text" name="sub_4" value="<?php echo $ed['sub_4']; ?>" class="form-control"></td>
													</tr>
													<tr>
														<td>E.</td>
														<td><input type="text" name="sub_5" value="<?php echo $ed['sub_5']; ?>" class="form-control"></td>
														<td>F.</td>
														<td><input type="text" name="sub_6" value="<?php echo $ed['sub_6']; ?>" class="form-control"></td>
													</tr>
													<tr>
														<td>G.</td>
														<td><input type="text" name="sub_7" value="<?php echo $ed['sub_7']; ?>" class="form-control"></td>
														<td>H.</td>
														<td><input type="text" name="sub_8" value="<?php echo $ed['sub_8']; ?>" class="form-control"></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="col-sm-6">																	
										<label class="bmd-label-floating">Candidate Photo :  (Max size 50 KB in .jpg or .png format) <small class="text-danger">*</small></label>
										<input type="file" class="form-control"  name="candidate" id="img1" onchange="readURL(this);" autocomplete="off" >
										<input type="hidden" class="form-control"  name="old_candidate" value="<?php echo $ed['img1']; ?>"  required="" autocomplete="off" >
										<div class="row">
											<div class="col-sm-6">
												<label class="bmd-label-floating">Current Candidate Photo :- </label><br>
												<img src="<?php echo base_url('uploads/exam_form/'.$ed['ref_no'].'/'.$ed['img1'].''); ?>" class="img-thumbnail img-fluid"/>
											</div>
											<div class="col-sm-6">
												<label class="bmd-label-floating">New Photo :- </label><br>
												<img id="blah" class="img-thumbnail img-fluid"/>
											</div>
											
										</div>
										
									</div>
									<div class="col-sm-6">																	
										<label class="bmd-label-floating">Candidate Signature : (Max size 30 KB in .jpg or .png format)<small class="text-danger">*</small></label>
										<input type="file" class="form-control"  name="signature" id="img2" onchange="readURL1(this);" autocomplete="off" >
										<input type="hidden" class="form-control"  name="old_signature" value="<?php echo $ed['img2']; ?>" required="" autocomplete="off" >
										<div class="row">
											<div class="col-sm-6">
												<label class="bmd-label-floating">Current Signature Photo :- </label><br>
												<img src="<?php echo base_url('uploads/exam_form/'.$ed['ref_no'].'/'.$ed['img2'].''); ?>" class="img-thumbnail img-fluid"/>
											</div>
											<div class="col-sm-6">
												<label class="bmd-label-floating">New Photo :- </label><br>
												<img id="blah1" class="img-thumbnail img-fluid"/>
											</div>
											
										</div>
									</div>	
									
									<div class="col-sm-12 mt-3">
										<hr>
										<div class="form-check mr-auto">
											<label class="text-warning" style="font-size: 18px;font-weight: 600;">											
												<input type="checkbox" name="resitter_status" id="resitter" onclick="show_full()" <?php if($ed['resitter_status']=='On'){ echo 'checked';} ?>> 
												Are You A Resitter candidate Yes Then Click Checkbox Otherwise Not :-												
											</label>
										</div>
									</div>
									<div class="col-md-12" >
										<div class="resitter_div" style="<?php if($ed['resitter_status']=='On'){ echo 'display: inline;';} else {echo 'display: none;';}  ?>">
											<div class="row">										
												<div class="col-sm-12 mt-3 text-primary">	
													<h4 class="text-primary" style="font-weight: 800;">FOR RE-SITTER CANDIDATES :-</h4><hr>
												</div>
												<div class="col-sm-3">
													<div class="form-group bmd-form-group">
														<label class="bmd-label-floating">I sat No Of Times</label>
														<input type="text" class="form-control" name="no_times" value="<?php echo $ed['no_times']; ?>"  autocomplete="off" >
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group bmd-form-group">
														<label class="bmd-label-floating">the last examination. I sat for was in the month of</label>
														<input type="text" class="form-control" name="rmonth1" value="<?php echo $ed['rmonth1']; ?>"  autocomplete="off" >
													</div>
												</div>
												<div class="col-sm-3">
													<div class="form-group bmd-form-group">
														<label class="bmd-label-floating">Year</label>
														<input type="text" class="form-control" name="ryear1" value="<?php echo $ed['ryear1']; ?>"  autocomplete="off" >
													</div>
												</div>
												<div class="col-sm-3">
													<div class="form-group bmd-form-group">
														<label class="bmd-label-floating">From Name Of Training School</label>
														<input type="text" class="form-control" name="rtrainschool" value="<?php echo $ed['rtrainschool']; ?>"  autocomplete="off" >
													</div>
												</div>
												<div class="col-sm-2">
													<div class="form-group bmd-form-group">
														<label class="bmd-label-floating">Under Roll</label>
														<input type="text" class="form-control" name="rroll1" value="<?php echo $ed['rroll1']; ?>"  autocomplete="off" >
													</div>
												</div>
												<div class="col-sm-2">
													<div class="form-group bmd-form-group">
														<label class="bmd-label-floating"> Number</label>
														<input type="text" class="form-control" name="rno1" value="<?php echo $ed['rno1']; ?>"  autocomplete="off" >
													</div>
												</div>
												<div class="col-sm-2">
													<div class="form-group bmd-form-group is-filled">
														<label class="bmd-label-floating">I have passed </label>
														<select class="form-control" name="ryear2" >
															<option value="<?php echo $ed['ryear2']; ?>" selected><?php echo $ed['ryear2']; ?></option>
															<option value="">Select Year</option>
															<option value="1st Year">1st Year</option>
															<option value="2nd Year">2nd Year</option>
														</select>								
													</div>
												</div>
												<div class="col-sm-3">
													<div class="form-group bmd-form-group is-filled">
														<label class="bmd-label-floating">Course </label>
														<select class="form-control" name="rcourse" >
															<option value="<?php echo $ed['rcourse']; ?>" selected><?php echo $ed['rcourse']; ?></option>
															<option value="">Select Course</option>
															<option value="ANM">ANM</option>
															<option value="GNM">GNM</option>
														</select>								
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group bmd-form-group">
														<label class="bmd-label-floating">Examination conducted by Jharkhand Nurses Registration Council from</label>
														<input type="text" class="form-control" name="rcouncil" value="<?php echo $ed['rcouncil']; ?>"  autocomplete="off" >
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group bmd-form-group">
														<label class="bmd-label-floating">School of Nursing in the month of</label>
														<input type="text" class="form-control" name="rmonth2" value="<?php echo $ed['rmonth2']; ?>"  autocomplete="off" >
													</div>
												</div>
												<div class="col-sm-4">
													<div class="form-group bmd-form-group">
														<label class="bmd-label-floating">With Roll</label>
														<input type="text" class="form-control" name="rroll2" value="<?php echo $ed['rroll2']; ?>"  autocomplete="off" >
													</div>
												</div>
												<div class="col-sm-4">
													<div class="form-group bmd-form-group">
														<label class="bmd-label-floating">Number</label>
														<input type="text" class="form-control" name="rno2" value="<?php echo $ed['rno2']; ?>"  autocomplete="off" >
													</div>
												</div>
												<div class="col-sm-4">
													<div class="form-group bmd-form-group is-filled">
														<label class="bmd-label-floating">I wish to be examined in Language </label>
														<select class="form-control" name="rlang" >
															<option value="<?php echo $ed['rlang']; ?>" selected><?php echo $ed['rlang']; ?></option>
															<option value="">Select Language</option>
															<option value="English">English</option>
															<option value="Hindi">Hindi</option>
														</select>								
													</div>
												</div>										
											</div>									
										</div>									
									</div>
									
									
									<div class="col-sm-12 mt-3">
										<h4 class="text-primary" style="font-weight: 800;">ENDORSEMENT BY SCHOOL OF NURSING :-</h4><hr>
									</div>
									<div class="col-sm-4">
										<div class="form-group bmd-form-group">
											<label class="bmd-label-floating">I consider Miss/Mrs./Sr.</label>
											<input type="text" class="form-control" name="ename" value="<?php echo $ed['ename']; ?>" required="" autocomplete="off" >
										</div>
									</div>
									<div class="col-sm-8">
										<div class="form-group bmd-form-group">
											<label class="bmd-label-floating">Year Student is suitable For appearing in ensuing examination to be held in the month of</label>
											<input type="text" class="form-control" name="emonth1" value="<?php echo $ed['emonth1']; ?>" required="" autocomplete="off" >
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group bmd-form-group">
											<label class="bmd-label-floating">Year</label>
											<input type="text" class="form-control" name="eyear1" value="<?php echo $ed['eyear1']; ?>" required="" autocomplete="off" >
										</div>
									</div>
									<div class="col-sm-9">
										<div class="form-group bmd-form-group">
											<label class="bmd-label-floating">Conducted by Jharkhand Nurses Registration Council. Her work/Clinical Work is satisfactory. Her conduct is</label>
											<input type="text" class="form-control" name="econduct" value="<?php echo $ed['econduct']; ?>" required="" autocomplete="off" >
										</div>
									</div>
									<div class="col-sm-12 mt-3">
										<div class="material-datatables table-responsive">
											<table class="table table-striped table-bordered" style="width: 100%">
												<thead>
													<tr>
														<th></th>
														<th>PTS/1st Year</th>
														<th>2nd Year</th>
														<th>3rd Year</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>Date of Joining</td>
														<td><input type="text" name="edoj1" value="<?php echo $ed['edoj1']; ?>" class="form-control doj"></td>
														<td><input type="text" name="edoj2" value="<?php echo $ed['edoj2']; ?>" class="form-control doj"></td>
														<td><input type="text" name="edoj3" value="<?php echo $ed['edoj3']; ?>" class="form-control doj"></td>
													</tr>
													<tr>
														<td>Total Leaved availed in</td>
														<td><input type="text" name="eleave1" value="<?php echo $ed['eleave1']; ?>" class="form-control"></td>
														<td><input type="text" name="eleave2" value="<?php echo $ed['eleave2']; ?>" class="form-control"></td>
														<td><input type="text" name="eleave3" value="<?php echo $ed['eleave3']; ?>" class="form-control"></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group bmd-form-group">
											<label class="bmd-label-floating">We certify that she has put in Year</label>
											<input type="text" class="form-control" name="eyear2" value="<?php echo $ed['eyear2']; ?>" required="" autocomplete="off" >
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group bmd-form-group">
											<label class="bmd-label-floating">Month And</label>
											<input type="text" class="form-control" name="emonth2" value="<?php echo $ed['emonth2']; ?>" required="" autocomplete="off" >
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group bmd-form-group">
											<label class="bmd-label-floating">Number Of Days</label>
											<input type="text" class="form-control" name="eday" value="<?php echo $ed['eday']; ?>" required="" autocomplete="off" >
										</div>
									</div>
									
									<div class="col-sm-12 mt-3">
										<p><b>Days training exclusive of leave and has attended 75% Lectures/Clinical in each subject . </b></p>
										<p><b>Field/ Clinical experience and that she is "Eligible" to appear at the examination as per terms and condition lad\id down by INDIAN NURSING COUNCIL Syllabus.</b></p>
										<h4 class="text-primary" style="font-weight: 800;">HE/SHE HAS ATTENDED THE UNDERMENTIONED NUMBER OF LECTURES :-</h4><hr>
										<div class="material-datatables table-responsive">
											<table class="table table-striped table-bordered " style="width: 100%">
												<thead>
													<tr>
														<th rowspan="2">#</th>
														<th rowspan="2">SUBJECT</th>
														<th colspan="3">NUMBER OF LECTURES</th>
													</tr>
													<tr>
														<th>DELIVERED</th>
														<th>ATTENDED</th>
														<th>PERCENTAGE</th>
													</tr>
												<thead>
												<tbody>
													<tr>
														<td>A.</td>
														<td><input type="text" name="lsub_1" value="<?php echo $ed['lsub_1']; ?>" class="form-control"></td>
														<td><input type="text" name="ldel_1" value="<?php echo $ed['ldel_1']; ?>" class="form-control"></td>
														<td><input type="text" name="latt_1" value="<?php echo $ed['latt_1']; ?>" class="form-control"></td>
														<td><input type="text" name="lper_1" value="<?php echo $ed['lper_1']; ?>" class="form-control"></td>
													</tr>
													<tr>
														<td>B.</td>
														<td><input type="text" name="lsub_2" value="<?php echo $ed['lsub_2']; ?>" class="form-control"></td>
														<td><input type="text" name="ldel_2" value="<?php echo $ed['ldel_2']; ?>" class="form-control"></td>
														<td><input type="text" name="latt_2" value="<?php echo $ed['latt_2']; ?>" class="form-control"></td>
														<td><input type="text" name="lper_2" value="<?php echo $ed['lper_2']; ?>" class="form-control"></td>
													</tr>
													<tr>
														<td>C.</td>
														<td><input type="text" name="lsub_3" value="<?php echo $ed['lsub_3']; ?>" class="form-control"></td>
														<td><input type="text" name="ldel_3" value="<?php echo $ed['ldel_3']; ?>" class="form-control"></td>
														<td><input type="text" name="latt_3" value="<?php echo $ed['latt_3']; ?>" class="form-control"></td>
														<td><input type="text" name="lper_3" value="<?php echo $ed['lper_3']; ?>" class="form-control"></td>
													</tr>
													<tr>
														<td>D.</td>
														<td><input type="text" name="lsub_4" value="<?php echo $ed['lsub_4']; ?>" class="form-control"></td>
														<td><input type="text" name="ldel_4" value="<?php echo $ed['ldel_4']; ?>" class="form-control"></td>
														<td><input type="text" name="latt_4" value="<?php echo $ed['latt_4']; ?>" class="form-control"></td>
														<td><input type="text" name="lper_4" value="<?php echo $ed['lper_4']; ?>" class="form-control"></td>
													</tr>
													<tr>
														<td>E.</td>
														<td><input type="text" name="lsub_5" value="<?php echo $ed['lsub_5']; ?>" class="form-control"></td>
														<td><input type="text" name="ldel_5" value="<?php echo $ed['ldel_5']; ?>" class="form-control"></td>
														<td><input type="text" name="latt_5" value="<?php echo $ed['latt_5']; ?>" class="form-control"></td>
														<td><input type="text" name="lper_5" value="<?php echo $ed['lper_5']; ?>" class="form-control"></td>
													</tr>
													<tr>
														<td>F.</td>
														<td><input type="text" name="lsub_6" value="<?php echo $ed['lsub_6']; ?>" class="form-control"></td>
														<td><input type="text" name="ldel_6" value="<?php echo $ed['ldel_6']; ?>" class="form-control"></td>
														<td><input type="text" name="latt_6" value="<?php echo $ed['latt_6']; ?>" class="form-control"></td>
														<td><input type="text" name="lper_6" value="<?php echo $ed['lper_6']; ?>" class="form-control"></td>
													</tr>
													<tr>
														<td>G.</td>
														<td><input type="text" name="lsub_7" value="<?php echo $ed['lsub_7']; ?>" class="form-control"></td>
														<td><input type="text" name="ldel_7" value="<?php echo $ed['ldel_7']; ?>" class="form-control"></td>
														<td><input type="text" name="latt_7" value="<?php echo $ed['latt_7']; ?>" class="form-control"></td>
														<td><input type="text" name="lper_7" value="<?php echo $ed['lper_7']; ?>" class="form-control"></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="col-sm-12">
										<div class="form-check mr-auto">
											<label>
												<input type="checkbox" value="" required="" > 
												I have verified all the fields carefully and the information given by me are true to my belief and knowledge.
											</label>
										</div>
									</div>
									<div class="col-sm-12">
										<button type="submit" class="btn btn-success">Update Your Details</button>
										<button type="reset" class="btn btn-info">Reset</button>
									</div>
								</div>
							</form>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
function find_age()
{
	var dob = $('#dob').val();
	var str=dob.split('/');    
	var firstdate=new Date(str[2],str[1],str[0]);
	var today = new Date();        
	var dayDiff = Math.ceil(today.getTime() - firstdate.getTime()) / (1000 * 60 * 60 * 24 * 365);
	var age = parseInt(dayDiff);
	$("#age").val(age);
}
</script>
<script type="text/javascript">
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
function readURL(input) 
{
	if (input.files && input.files[0]) 
	{
		var reader = new FileReader();
		reader.onload = function (e) 
		{
			$('#blah')
			.attr('src', e.target.result);
		};
		reader.readAsDataURL(input.files[0]);
	}
}
function readURL1(input) 
{
	if (input.files && input.files[0]) 
	{
		var reader = new FileReader();
		reader.onload = function (e) 
		{
			$('#blah1')
			.attr('src', e.target.result);
		};
		reader.readAsDataURL(input.files[0]);
	}
}


//Capitalize first letter while typing in side of input field
// jQuery(document).ready(function($) 
// {
	// $('.form-control').keyup(function(event) 
	// {
		// var textBox = event.target;
		// var start = textBox.selectionStart;
		// var end = textBox.selectionEnd;
		// textBox.value = textBox.value.charAt(0).toUpperCase() + textBox.value.slice(1);
		// textBox.setSelectionRange(start, end);
	// });
// });
</script>
