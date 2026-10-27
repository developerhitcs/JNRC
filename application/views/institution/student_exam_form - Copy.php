
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
		<?php foreach($batch_session as $bs){} ?>
		<div class="row">
			<div class="col-md-12">  
				<div class="card">
					<div class="card-header-info">
						<span>Examination Application Form <small class="badge badge-warning">(Form Filling Start Date <?php echo $bs['form_open']; ?> ) (Form Filling Closing Date <?php echo $bs['form_close']; ?> ) </small></span>		
					</div>	
					<div class="card-body">
						<?php
						if($bs['status']=='Active')
						{
							?>
							<form method="post" action="<?php echo base_url('submit_exam_form');?>" enctype="multipart/form-data">
								<div class="row">								
									<div class="col-sm-4">
										<div class="form-group bmd-form-group is-filled">
											<label class="bmd-label-floating">Choose Course <small class="text-danger">*</small></label>
											<select class="form-control" name="course" required="">
												<option value="">Select Course</option>
												<?php
												if($_SESSION['school_course']=='ANM')
												{
													?>
													<option value="1st Year ANM">1st Year ANM</option>
													<option value="2nd Year ANM">2nd Year ANM</option>																		
													<?php
												}
												else
												{
													?>
													<option value="1st Year GNM">1st Year GNM</option>
													<option value="2nd Year GNM">2nd Year GNM</option>
													<option value="3rd Year GNM">3rd Year GNM</option>																	
													<?php
												}
												?>
												
											</select>								
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group bmd-form-group">
											<label class="bmd-label-floating">Name <small class="text-danger">*</small></label>
											<input type="text" class="form-control" name="name" required="" autocomplete="off" >
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group bmd-form-group">
											<label class="bmd-label-floating">Father's Name <small class="text-danger">*</small></label>
											<input type="text" class="form-control" name="father_name" required="" autocomplete="off" >
										</div>
									</div>	
									<div class="col-sm-4">
										<div class="form-group bmd-form-group">
											<label class="bmd-label-floating">Mother's Name <small class="text-danger">*</small></label>
											<input type="text" class="form-control" name="mother_name" required="" autocomplete="off" >
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group bmd-form-group is-filled">
											<label class="bmd-label-floating">Date Of Birth <small class="text-danger">*</small></label>
											<input type="text" name="dob" id="dob" onchange="find_age();" class="form-control datepicker" value="dd/mm/yyyy" required="" autocomplete="off" >
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group bmd-form-group">
											<label class="bmd-label-floating">Age : (must be between 17-35) <small class="text-danger">*</small></label>
											<input type="text" class="form-control" id="age" name="age" required="" autocomplete="off" >
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group bmd-form-group">
											<label class="bmd-label-floating">Aadhar No. <small class="text-danger">*</small></label>
											<input type="text" class="form-control" name="aadhar" required="" autocomplete="off" >
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group bmd-form-group is-filled">
											<label class="bmd-label-floating">Choose Marital Status <small class="text-danger">*</small></label>
											<select class="form-control" name="marital" required="">
												<option value="">Select Marital Status</option>
												<option value="Married">Married</option>
												<option value="Unmarried">Unmarried</option>
												<option value="Widow">Widow</option>
												<option value="Divorcee">Divorcee</option>
											</select>								
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group bmd-form-group">
											<label class="bmd-label-floating">Nationality <small class="text-danger">*</small></label>
											<input type="text" class="form-control" name="nationality" value="Indian" readonly required="" autocomplete="off" >
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group bmd-form-group">
											<label class="bmd-label-floating">Name of Training School <small class="text-danger">*</small></label>
											<input type="text" class="form-control" name="train_school" value="<?php echo $_SESSION['school_name']; ?>" readonly required="" autocomplete="off" >
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group bmd-form-group is-filled">
											<label class="bmd-label-floating">Choose Medium of Exam <small class="text-danger">*</small></label>
											<select class="form-control" name="medium_exam" required="">
												<option value="">Select Medium of Exam</option>
												<option value="Hindi">Hindi</option>
												<option value="English">English</option>
											</select>								
										</div>
									</div>
									<div class="col-sm-12">
										<div class="form-group bmd-form-group">
											<label class="bmd-label-floating">Address <small class="text-danger">*</small></label>
											<input type="text" class="form-control" name="perm_address" required="" autocomplete="off">
										</div>
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
														<td><input type="text" name="board_1" class="form-control " placeholder="Matric Details" required=""></td>
														<td><input type="text" name="year_1" class="form-control " required=""></td>
														<td><input type="text" name="roll_1" class="form-control" required=""></td>
														<td><input type="text" name="marks_1" class="form-control" required=""></td>
														<td><input type="text" name="school_1" class="form-control " required=""></td>
														<td><input type="file" name="matric"  class="form-control " required=""></td>
													</tr>
													<tr>
														<td>2.</td>
														<td><input type="text" name="board_2" class="form-control " placeholder="Intermediate Details" required=""></td>
														<td><input type="text" name="year_2" class="form-control" required=""></td>
														<td><input type="text" name="roll_2" class="form-control" required=""></td>
														<td><input type="text" name="marks_2" class="form-control" required=""></td>
														<td><input type="text" name="school_2" class="form-control " required=""></td>
														<td><input type="file" name="inter" class="form-control " required=""></td>
													</tr>
													<tr>
														<td>3.</td>
														<td><input type="text" name="board_3" class="form-control"></td>
														<td><input type="text" name="year_3" class="form-control"></td>
														<td><input type="text" name="roll_3" class="form-control"></td>
														<td><input type="text" name="marks_3" class="form-control"></td>
														<td><input type="text" name="school_3" class="form-control "></td>
														<td></td>
													</tr>
													<tr>
														<td>4.</td>
														<td><input type="text" name="board_4" class="form-control"></td>
														<td><input type="text" name="year_4" class="form-control"></td>
														<td><input type="text" name="roll_4" class="form-control"></td>
														<td><input type="text" name="marks_4" class="form-control"></td>
														<td><input type="text" name="school_4" class="form-control "></td>
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
														<td><input type="text" name="sub_1" class="form-control"></td>
														<td>B.</td>
														<td><input type="text" name="sub_2" class="form-control"></td>
													</tr>
													<tr>
														<td>C.</td>
														<td><input type="text" name="sub_3" class="form-control"></td>
														<td>D.</td>
														<td><input type="text" name="sub_4" class="form-control"></td>
													</tr>
													<tr>
														<td>E.</td>
														<td><input type="text" name="sub_5" class="form-control"></td>
														<td>F.</td>
														<td><input type="text" name="sub_6" class="form-control"></td>
													</tr>
													<tr>
														<td>G.</td>
														<td><input type="text" name="sub_7" class="form-control"></td>
														<td>H.</td>
														<td><input type="text" name="sub_8" class="form-control"></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="col-sm-6">																	
										<label class="bmd-label-floating">Candidate Photo :  (Max size 50 KB in .jpg or .png format) <small class="text-danger">*</small></label>
										<input type="file" class="form-control"  name="candidate" id="img1" onchange="readURL(this);" required="" autocomplete="off" >
										<img id="blah" class="img-thumbnail img-fluid"/>
									</div>
									<div class="col-sm-6">																	
										<label class="bmd-label-floating">Candidate Signature : (Max size 30 KB in .jpg or .png format)<small class="text-danger">*</small></label>
										<input type="file" class="form-control"  name="signature" id="img2" onchange="readURL1(this);" required="" autocomplete="off" >
										<img id="blah1" class="img-thumbnail img-fluid"/>
									</div>	
									<div class="col-sm-12 mt-3">									
										<div class="form-check mr-auto">
											<label class="form-check-label text-warning" style="font-size: 18px;font-weight: 600;">											
												<input class="form-check-input" name="resitter_status" id="resitter" onclick="show_full()" type="checkbox" value="" aria-required="true"> 
												Are You A Resitter candidate Yes Then Click Checkbox Otherwise Not :-
												<span class="form-check-sign"><span class="check"></span></span>
											</label>
										</div>
									</div>
									<div class="col-md-12" >
										<div class="resitter_div" style="display: none;">									
											<div class="row">										
												<div class="col-sm-12 mt-3 text-primary">	
													<h4 class="text-primary" style="font-weight: 800;">FOR RE-SITTER CANDIDATES :-</h4><hr>
												</div>
												<div class="col-sm-3">
													<div class="form-group bmd-form-group">
														<label class="bmd-label-floating">I sat No Of Times</label>
														<input type="text" class="form-control" name="no_times" required="" autocomplete="off" >
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group bmd-form-group">
														<label class="bmd-label-floating">the last examination. I sat for was in the month of</label>
														<input type="text" class="form-control" name="rmonth1" required="" autocomplete="off" >
													</div>
												</div>
												<div class="col-sm-3">
													<div class="form-group bmd-form-group">
														<label class="bmd-label-floating">Year</label>
														<input type="text" class="form-control" name="ryear1" required="" autocomplete="off" >
													</div>
												</div>
												<div class="col-sm-3">
													<div class="form-group bmd-form-group">
														<label class="bmd-label-floating">From Name Of Training School</label>
														<input type="text" class="form-control" name="rtrainschool" required="" autocomplete="off" >
													</div>
												</div>
												<div class="col-sm-2">
													<div class="form-group bmd-form-group">
														<label class="bmd-label-floating">Under Roll </label>
														<input type="text" class="form-control" name="rroll1" required="" autocomplete="off" >
													</div>
												</div>
												<div class="col-sm-2">
													<div class="form-group bmd-form-group">
														<label class="bmd-label-floating">Number.</label>
														<input type="text" class="form-control" name="rno1" required="" autocomplete="off" >
													</div>
												</div>
												<div class="col-sm-2">
													<div class="form-group bmd-form-group is-filled">
														<label class="bmd-label-floating">I have passed </label>
														<select class="form-control" name="ryear2" required="">
															<option value="">Select Year</option>
															<option value="Hindi">First Year</option>
															<option value="English">Second Year</option>
														</select>								
													</div>
												</div>
												<div class="col-sm-3">
													<div class="form-group bmd-form-group is-filled">
														<label class="bmd-label-floating">Course </label>
														<select class="form-control" name="rcourse" required="">
															<option value="">Select Course</option>
															<option value="ANM">ANM</option>
															<option value="GNM">GNM</option>
														</select>								
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group bmd-form-group">
														<label class="bmd-label-floating">Examination conducted by Jharkhand Nurses Registration Council from</label>
														<input type="text" class="form-control" name="rcouncil" required="" autocomplete="off" >
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group bmd-form-group">
														<label class="bmd-label-floating">School of Nursing in the month of</label>
														<input type="text" class="form-control" name="rmonth2" required="" autocomplete="off" >
													</div>
												</div>
												<div class="col-sm-4">
													<div class="form-group bmd-form-group">
														<label class="bmd-label-floating">With Roll</label>
														<input type="text" class="form-control" name="rroll2" required="" autocomplete="off" >
													</div>
												</div>
												<div class="col-sm-4">
													<div class="form-group bmd-form-group">
														<label class="bmd-label-floating">Number</label>
														<input type="text" class="form-control" name="rno2" required="" autocomplete="off" >
													</div>
												</div>
												<div class="col-sm-4">
													<div class="form-group bmd-form-group is-filled">
														<label class="bmd-label-floating">I wish to be examined in Language </label>
														<select class="form-control" name="rlang" required="">
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
											<input type="text" class="form-control" name="ename" required="" autocomplete="off" >
										</div>
									</div>
									<div class="col-sm-8">
										<div class="form-group bmd-form-group">
											<label class="bmd-label-floating">Year Student is suitable For appearing in ensuing examination to be held in the month of</label>
											<input type="text" class="form-control" name="emonth1" required="" autocomplete="off" >
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group bmd-form-group">
											<label class="bmd-label-floating">Year</label>
											<input type="text" class="form-control" name="eyear1" required="" autocomplete="off" >
										</div>
									</div>
									<div class="col-sm-9">
										<div class="form-group bmd-form-group">
											<label class="bmd-label-floating">Conducted by Jharkhand Nurses Registration Council. Her work/Clinical Work is satisfactory. Her conduct is</label>
											<input type="text" class="form-control" name="econduct" required="" autocomplete="off" >
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
														<td><input type="text" name="edoj1" class="form-control doj"></td>
														<td><input type="text" name="edoj2" class="form-control doj"></td>
														<td><input type="text" name="edoj3" class="form-control doj"></td>
													</tr>
													<tr>
														<td>Total Leaved availed in</td>
														<td><input type="text" name="eleave1" class="form-control"></td>
														<td><input type="text" name="eleave2" class="form-control"></td>
														<td><input type="text" name="eleave3" class="form-control"></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group bmd-form-group">
											<label class="bmd-label-floating">We certify that she has put in Year</label>
											<input type="text" class="form-control" name="eyear2" required="" autocomplete="off" >
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group bmd-form-group">
											<label class="bmd-label-floating">Month And</label>
											<input type="text" class="form-control" name="emonth2" required="" autocomplete="off" >
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group bmd-form-group">
											<label class="bmd-label-floating">Number Of Days</label>
											<input type="text" class="form-control" name="eday" required="" autocomplete="off" >
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
														<td><input type="text" name="lsub_1" class="form-control"></td>
														<td><input type="text" name="ldel_1" class="form-control"></td>
														<td><input type="text" name="latt_1" class="form-control"></td>
														<td><input type="text" name="lper_1" class="form-control"></td>
													</tr>
													<tr>
														<td>B.</td>
														<td><input type="text" name="lsub_2" class="form-control"></td>
														<td><input type="text" name="ldel_2" class="form-control"></td>
														<td><input type="text" name="latt_2" class="form-control"></td>
														<td><input type="text" name="lper_2" class="form-control"></td>
													</tr>
													<tr>
														<td>C.</td>
														<td><input type="text" name="lsub_3" class="form-control"></td>
														<td><input type="text" name="ldel_3" class="form-control"></td>
														<td><input type="text" name="latt_3" class="form-control"></td>
														<td><input type="text" name="lper_3" class="form-control"></td>
													</tr>
													<tr>
														<td>D.</td>
														<td><input type="text" name="lsub_4" class="form-control"></td>
														<td><input type="text" name="ldel_4" class="form-control"></td>
														<td><input type="text" name="latt_4" class="form-control"></td>
														<td><input type="text" name="lper_4" class="form-control"></td>
													</tr>
													<tr>
														<td>E.</td>
														<td><input type="text" name="lsub_5" class="form-control"></td>
														<td><input type="text" name="ldel_5" class="form-control"></td>
														<td><input type="text" name="latt_5" class="form-control"></td>
														<td><input type="text" name="lper_5" class="form-control"></td>
													</tr>
													<tr>
														<td>F.</td>
														<td><input type="text" name="lsub_6" class="form-control"></td>
														<td><input type="text" name="ldel_6" class="form-control"></td>
														<td><input type="text" name="latt_6" class="form-control"></td>
														<td><input type="text" name="lper_6" class="form-control"></td>
													</tr>
													<tr>
														<td>G.</td>
														<td><input type="text" name="lsub_7" class="form-control"></td>
														<td><input type="text" name="ldel_7" class="form-control"></td>
														<td><input type="text" name="latt_7" class="form-control"></td>
														<td><input type="text" name="lper_7" class="form-control"></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="col-sm-12">
										<div class="form-check mr-auto">
											<label class="form-check-label">
												<input class="form-check-input" type="checkbox" value="" required="" aria-required="true"> 
												I have verified all the fields carefully and the information given by me are true to my belief and knowledge.
												<span class="form-check-sign"><span class="check"></span></span>
											</label>
										</div>
									</div>
									<div class="col-sm-12">
										<button type="submit" class="btn btn-success">Submit & Continue</button>
									</div>
								</div>
							</form>
							<?php
						}
						else
						{
							echo'<h2 class="text-danger"><b>Examination Form Currently Not Available. </b></h2>';
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

// $(function() 
// {
	// $( "#dob" ).datepicker(
	// { 
		// changeYear: true,
		// minDate: '-3M',
		// maxDate: '+28D',
	// });
// });

// $('.datepicker').datepicker(
// { 
	// min: new Date(20,3,2020),
	// max: new Date(20,7,2020)
// })

// $(document).ready(function()
// {
	// // $("#dob").datepicker
	// // ({
		// // format:'dd/mm/yyyy',
		// // startDate:'01/01/1985',
		// // endDate:'01/01/2003'
	// // });
	// // $(".doj").datepicker
	// // ({
		// // format:'dd/mm/yyyy'
	// // });

	// $("#dob").change(function()
	// {
		// var dob = $('#dob').val();
		// alert(dob);
		// var str=dob.split('/');    
		// var firstdate=new Date(str[2],str[1],str[0]);
		// var today = new Date();        
		// var dayDiff = Math.ceil(today.getTime() - firstdate.getTime()) / (1000 * 60 * 60 * 24 * 365);
		// var age = parseInt(dayDiff);
		// $("#age").val(age);
	// });
// });
function find_age()
{
	var dob = $('#dob').val();
	alert(dob);
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
			.attr('src', e.target.result)
			.height(200);
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
			.attr('src', e.target.result)
			.height(200);
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
