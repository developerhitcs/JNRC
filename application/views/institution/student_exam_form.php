
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
					    	<span>Examination Application Form <small class="badge badge-danger"> fillup date without late fine  22/08/2026 - 28/08/2026 and with late fine 29/08/2026 - 30/08/2026   </small></span> 	
						<!--<span>Examination Application Form <small class="badge badge-danger"><?php echo $bs['form_open']; ?> ( Last Date Without Fine 30/06/2025 ) AND ( Last Date With Fine 01/07/2025 to 02/07/2025) 02/07/2025 </small></span>		-->
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
										    <!--onchange="myFunction()"-->
											<label class="bmd-label-floating">Choose Course <small class="text-danger">*</small></label>
										<select class="form-control" name="course" required id="courseSelect" onchange="loadSubjects()">
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
											<input type="text" name="dob" id="dob" onmouseenter="find_age();" class="form-control datepicker" value="dd/mm/yyyy" required="" autocomplete="off" >
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group bmd-form-group is-filled">
											<label class="bmd-label-floating">Age : <small class="text-danger">*</small></label>
											<input type="text" class="form-control" id="age" name="age" value="0"  required="" readonly autocomplete="off" >
											<!--<input type="text" class="form-control" id="age" name="age" value="0" min="17" max="35" required="" readonly autocomplete="off" >-->
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group bmd-form-group">
											<label class="bmd-label-floating">Aadhar No. <small class="text-danger">*</small></label>
											<input type="tel" maxlength="12" pattern = "[0-9]+" class="form-control" name="aadhar" required="" autocomplete="off" >
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
									<div class="col-sm-4">
										<div class="form-group bmd-form-group">
											<label class="bmd-label-floating">Name of Training School <small class="text-danger">*</small></label>
											<input type="text" class="form-control" name="train_school" value="<?php echo $_SESSION['school_name']; ?>" readonly required="" autocomplete="off" >
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group bmd-form-group is-filled">
											<label class="bmd-label-floating">Choose Medium of Exam <small class="text-danger">*</small></label>
											<select class="form-control" name="medium_exam" required="">
												<option value="">Select Medium of Exam</option>
												<option value="Hindi">Hindi</option>
												<option value="English">English</option>
											</select>								
										</div>
									</div>
        							<div class="col-sm-4">
                                	<div class="form-group bmd-form-group">
                                		<label class="bmd-label-floating">
                                			CML Rank <small class="text-danger">*</small>
                                		</label>
                                		<input type="text" class="form-control" name="cmlrank" required="" autocomplete="off">
                                		<small class="form-text text-danger">If you do not have a CML Rank, please enter "NA".</small>
                                	</div>
                                </div>


									<div class="col-sm-6">
										<div class="form-group bmd-form-group">
											<label class="bmd-label-floating">Address <small class="text-danger">*</small></label>
											<input type="text" class="form-control" name="perm_address" required="" autocomplete="off">
										</div>
									</div>
									<div class="col-sm-6">
                                        <div class="form-group bmd-form-group">
                                            <label class="bmd-label-floating">
                                                Phone Number <small class="text-danger">*</small>
                                            </label>
                                            <input type="text" class="form-control" name="phone_number" maxlength="10" required="" autocomplete="off">
                                        </div>
                                    </div>
									<!-- 	<div class="col-sm-6">-->
									<!--	<label class="form-group bmd-form-group">-->
									<!--		<label class="bmd-label-floating">Passing Marksheet <small class="text-danger">*</small>-->
									<!--		<input type="file" name="passing_marksheet"  required=""></label>-->
									<!--		<input type="file" class="form-control" name="passing_marksheet" required="" >-->
								 <!--           <br>-->
									<!--		<p>Note:- <strong style="color:red;">Those students who are in their 2nd year, kindly upload your 1st year marksheet, and those students who are in their 3rd year, kindly upload your 2nd year marsheet.</strong></p>-->
									
									<!--</div>-->
									    <div class="col-sm-12" id="passingMarks" >																	
										<label class="bmd-label-floating">Passing Marksheet <small class="text-danger">*</small></label>
										<input type="file" class="form-control"  name="passing_marksheet" >
									    <p>Note:- <strong style="color:red;">Those students who are in their 2nd year, kindly upload your 1st year marksheet, and those students who are in their 3rd year, kindly upload your 2nd year marsheet. 1st year candidates must upload their passing certificate from the previous year.(eg:- 10th, 12th)</strong></p>
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
										<h4 class="text-primary" style="font-weight: 800;">I WISH TO BE EXAMINED IN THE FOLLOWING SUBJECTS :-</h4>
										<p  style="font-weight: 600;color:black;">Note:- <span style="color:red;">Registered candidate select only those subject in which he/she failed.</span></p><hr>
<div class="material-datatables table-responsive">
    <table class="table table-striped table-bordered" style="width: 100%" id="subjectTable">
        <thead>
            <tr>
                <th width="5%">No.</th>
                <th width="40%">Subject</th>
                <th width="5%">Select</th>
                <th width="5%">No.</th>
                <th width="40%">Subject</th>
                <th width="5%">Select</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>A.</td>
                <td><input type="text" name="sub_1" id="sub_1" class="form-control subject-input" readonly></td>
                <td><input type="checkbox" name="selected_subjects[]" value="1" class="form-check-input subject-select"></td>
                <td>B.</td>
                <td><input type="text" name="sub_2" id="sub_2" class="form-control subject-input" readonly></td>
                <td><input type="checkbox" name="selected_subjects[]" value="2" class="form-check-input subject-select"></td>
            </tr>
            <tr>
                <td>C.</td>
                <td><input type="text" name="sub_3" id="sub_3" class="form-control subject-input" readonly></td>
                <td><input type="checkbox" name="selected_subjects[]" value="3" class="form-check-input subject-select"></td>
                <td>D.</td>
                <td><input type="text" name="sub_4" id="sub_4" class="form-control subject-input" readonly></td>
                <td><input type="checkbox" name="selected_subjects[]" value="4" class="form-check-input subject-select"></td>
            </tr>
            <tr>
                <td>E.</td>
                <td><input type="text" name="sub_5" id="sub_5" class="form-control subject-input" readonly></td>
                <td><input type="checkbox" name="selected_subjects[]" value="5" class="form-check-input subject-select"></td>
                <td>F.</td>
                <td><input type="text" name="sub_6" id="sub_6" class="form-control subject-input" readonly></td>
                <td><input type="checkbox" name="selected_subjects[]" value="6" class="form-check-input subject-select"></td>
            </tr>
            <tr>
                <td>G.</td>
                <td><input type="text" name="sub_7" id="sub_7" class="form-control subject-input" readonly></td>
                <td><input type="checkbox" name="selected_subjects[]" value="7" class="form-check-input subject-select"></td>
                <td>H.</td>
                <td><input type="text" name="sub_8" id="sub_8" class="form-control subject-input" readonly></td>
                <td><input type="checkbox" name="selected_subjects[]" value="8" class="form-check-input subject-select"></td>
            </tr>
        </tbody>
    </table>
</div>

<style>
/* Modern table styling */
#subjectTable {
    border-collapse: separate;
    border-spacing: 0;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 15px rgba(0,0,0,0.1);
}

/* Header styling */
#subjectTable thead th {
    background-color: #4a6fdc;
    color: white;
    font-weight: 500;
    padding: 12px 8px;
    border: none;
}

/* Cell styling */
#subjectTable td {
    padding: 10px 8px;
    vertical-align: middle;
    border-bottom: 1px solid #e0e0e0;
}

/* Subject input field styling */
.subject-input {
    background-color: #f8f9ff;
    border: 1px solid #e0e0e0;
    border-radius: 6px;
    padding: 8px 12px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 14px;
}

.subject-input:hover {
    background-color: #eef2ff;
    border-color: #c9d2ff;
}

.subject-input:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(74, 111, 220, 0.2);
    border-color: #4a6fdc;
}

/* Checkbox styling */
.subject-select {
    position: relative;
    width: 20px;
    height: 20px;
    cursor: pointer;
    -webkit-appearance: none;
    appearance: none;
    background-color: white;
    border: 2px solid #d1d5db;
    border-radius: 4px;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
}

.subject-select:checked {
    background-color: #4a6fdc;
    border-color: #4a6fdc;
}

.subject-select:checked::after {
    content: "✓";
    color: white;
    font-size: 12px;
    font-weight: bold;
}

.subject-select:hover {
    border-color: #9fa8da;
}

/* Row highlighting */
.table-primary {
    background-color: #f0f4ff;
}

.table-primary td {
    border-bottom: 1px solid #d6e0ff;
}

/* Hover effect for rows */
#subjectTable tbody tr:hover {
    background-color: #f5f7ff;
}

/* Number column styling */
#subjectTable td:first-child,
#subjectTable td:nth-child(4) {
    font-weight: 500;
    color: #4a6fdc;
    text-align: center;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    #subjectTable {
        font-size: 14px;
    }
    .subject-input {
        padding: 6px 8px;
    }
}
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    // Load subjects when course is selected
    $('#courseSelect').change(function() {
        var course = $(this).val();
        if(course) {
            $.ajax({
                url: '<?= base_url("get_subjects_by_course") ?>',
                type: 'POST',
                data: {course: course},
                dataType: 'json',
                success: function(response) {
                    // Clear all fields first
                    $('.subject-input').val('');
                    $('.subject-select').prop('checked', false);
                    
                    // Fill the subjects
                    response.forEach(function(subject, index) {
                        if(index < 8) {
                            $(`#sub_${index+1}`).val(subject.subject_name);
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Error:", error);
                    alert("Failed to load subjects. Please try again.");
                }
            });
        }
    });
    
    // Toggle row highlighting when checkbox is clicked
    $(document).on('change', '.subject-select', function() {
        $(this).closest('tr').toggleClass('table-primary', this.checked);
    });
    
    // Allow clicking on subject field to toggle checkbox
    $(document).on('click', '.subject-input', function() {
        var checkbox = $(this).closest('td').next().find('.subject-select');
        checkbox.prop('checked', !checkbox.prop('checked')).trigger('change');
    });
});
</script>
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
									<div class="col-sm-12 mt-3"><hr>									
										<div class="form-check mr-auto">
											<label class="text-warning" style="font-size: 18px;font-weight: 600;">											
												<input name="resitter_status" id="resitter" onclick="show_full()" type="checkbox" > 
												Are You A Registered candidate Yes Then Click Checkbox Otherwise Not :-
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
														<input type="text" class="form-control" name="no_times" autocomplete="off" >
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group bmd-form-group">
														<label class="bmd-label-floating">the last examination. I sat for was in the month of</label>
														<input type="text" class="form-control" name="rmonth1"  autocomplete="off" >
													</div>
												</div>
												<div class="col-sm-3">
													<div class="form-group bmd-form-group">
														<label class="bmd-label-floating">Year</label>
														<input type="text" class="form-control" name="ryear1"  autocomplete="off" >
													</div>
												</div>
												<div class="col-sm-3">
													<div class="form-group bmd-form-group">
														<label class="bmd-label-floating">From Name Of Training School</label>
														<input type="text" class="form-control" name="rtrainschool"  autocomplete="off" >
													</div>
												</div>
												<div class="col-sm-2">
													<div class="form-group bmd-form-group">
														<label class="bmd-label-floating">Under Roll </label>
														<input type="text" class="form-control" name="rroll1"  autocomplete="off" >
													</div>
												</div>
												<div class="col-sm-2">
													<div class="form-group bmd-form-group">
														<label class="bmd-label-floating">Number </label>
														<input type="text" class="form-control" name="rno1"  autocomplete="off" >
													</div>
												</div>
												<div class="col-sm-2">
													<div class="form-group bmd-form-group is-filled">
														<label class="bmd-label-floating">I have passed </label>
														<select class="form-control" name="ryear2" >
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
															<option value="">Select Course</option>
															<option value="ANM">ANM</option>
															<option value="GNM">GNM</option>
														</select>								
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group bmd-form-group">
														<label class="bmd-label-floating">Examination conducted by Jharkhand Nurses Registration Council from</label>
														<input type="text" class="form-control" name="rcouncil"  autocomplete="off" >
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group bmd-form-group">
														<label class="bmd-label-floating">School of Nursing in the month of</label>
														<input type="text" class="form-control" name="rmonth2"  autocomplete="off" >
													</div>
												</div>
												<div class="col-sm-4">
													<div class="form-group bmd-form-group">
														<label class="bmd-label-floating">With Roll</label>
														<input type="text" class="form-control" name="rroll2"  autocomplete="off" >
													</div>
												</div>
												<div class="col-sm-4">
													<div class="form-group bmd-form-group">
														<label class="bmd-label-floating">Number</label>
														<input type="text" class="form-control" name="rno2"  autocomplete="off" >
													</div>
												</div>
												<div class="col-sm-4">
													<div class="form-group bmd-form-group is-filled">
														<label class="bmd-label-floating">I wish to be examined in Language </label>
														<select class="form-control" name="rlang" >
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
											<label>
												<input type="checkbox" value="" required=""> 
												I have verified all the fields carefully and the information given by me are true to my belief and knowledge.
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
<script>
// function myFunction() {
// var x = document.getElementById("mySelect").value;
//     // console.log("Line no 539",x);
// if (x === "2nd Year GNM")
//   $("#passingMarks").show();
// else if (x === "3rd Year GNM")
//   $("#passingMarks").show();
//   else if (x === "1st Year GNM")
//   $("#passingMarks").hide();
//   else if (x === "2nd Year ANM")
//   $("#passingMarks").show();
//   else if (x === "1st Year ANM")
//   $("#passingMarks").hide();
// }
</script>

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
