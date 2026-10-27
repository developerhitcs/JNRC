	<div class="page-content">
        <div class="breadcrumb-row">
            <div class="container">
                <ul class="list-inline">
                    <li><a href="<?php echo base_url('');?>">Home</a></li>
                    <li>EXAMINATION APPLICATION FORM </li>
                </ul>
            </div>
        </div>
        <div class="section-full bg-gray content-inner">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 bg-white">
						<center>
							<h1>EXAMINATION APPLICATION FORM </h1>
						</center>
						<form  enctype="multipart/form-data" method="POST" action="<?php echo base_url('save_exam_form');?>"> 
							<span style="color:red; font-weight: bold;"> (*)</span> Marked fields are mandatory.
							<div class="row">
								<div class="form-group col-sm-6">
									<label for="date_adm">Course:<span style="color:red; font-weight: bold;"> *</span></label>
									<select class="form-control" name="course" id="course" required="">
										<option value="">--Select--</option>
										<option value="gnm_year_1">1st Year GNM</option>
										<option value="gnm_year_2">2nd Year GNM</option>
										<option value="gnm_year_3">3rd Year GNM</option>
										<option value="anm_year_1">1st Year ANM</option>
										<option value="anm_year_2">2nd Year ANM</option>
									</select>
								</div>
								<div class="form-group col-sm-6">
									<label for="stud_name">Name :<span style="color:red; font-weight: bold;"> *</span></label>
									<input type="text" class="form-control autocapitalize" name="name" id="name" value="" required="">
								</div>
							</div>
							<div class="row">
								<div class="form-group col-sm-6">
									<label for="father_name">Father's Name :<span style="color:red; font-weight: bold;"> *</span></label>
									<input type="text" class="form-control autocapitalize" name="father_name" id="father_name" required="">
								</div>
								<div class="form-group col-sm-6">
									<label for="mother_name">Mother's Name :<span style="color:red; font-weight: bold;"> *</span></label>
									<input type="text" class="form-control autocapitalize" name="mother_name" id="mother_name" required="">
								</div>
							</div>
							<div class="row">
								<div class="form-group col-sm-6">
									<label for="dob">Date of Birth :<span style="color:red; font-weight: bold;"> *</span></label>
									<input type="text"  class="form-control" name="dob" id="dob" required="">
								</div>
								<div class="form-group col-sm-6">
									<label for="class">Age : (must be between 17-35)<span style="color:red; font-weight: bold;"> *</span></label>
									<input type="number" class="form-control" name="age" id="age" required="" placeholder="Age must be between 17-35 " autocomplete="off" readonly="">
								</div>
							</div>
							<div class="row">
								<div class="form-group col-sm-6">
								<label for="class">Aadhar No. :<span style="color:red; font-weight: bold;"> *</span></label>
								<input type="number" class="form-control" name="aadhar" id="aadhar" required="">
								</div>
								<div class="form-group col-sm-6" style="margin-bottom: 27px;">
								<label>Marital Status :<span style="color:red; font-weight: bold; "> *</span></label><br>
								<input class="form-check-input" type="radio" name="marital" value="1" required="">
								Married
								&nbsp;&nbsp;
								<input class="form-check-input" type="radio" name="marital" value="2">
								Unmarried
								&nbsp;&nbsp;
								<input class="form-check-input" type="radio" name="marital" value="3">
								Widow
								&nbsp;&nbsp;
								<input class="form-check-input" type="radio" name="marital" value="4">
								Divorcee
								</div>
							</div>
							<div class="row">
								<div class="form-group col-sm-6">
									<label for="nationality">Nationality :<span style="color:red; font-weight: bold;"> *</span></label>
									<input type="text" class="form-control autocapitalize" name="nationality" id="nationality" required="">
								</div>
								<div class="form-group col-sm-6">
									<label for="perm_address">Permanent Address: <span style="color:red; font-weight: bold;"> *</span></label> 
									<textarea class="form-control" name="perm_address" id="perm_address"></textarea> 
								</div>
							</div>
							<div class="row">
								<div class="form-group col-sm-6">
									<label for="class_apply">Name of Training School :<span style="color:red; font-weight: bold;"> *</span></label>
									<input type="text" class="form-control" name="train_school" id="train_school" required="">
								</div>
								<div class="form-group col-sm-6">
									<label>Medium of Exam :<span style="color:red; font-weight: bold;"> *</span></label><br>
									<input class="form-check-input" type="radio" name="medium_exam" value="1" required="">
									Hindi
									&nbsp;&nbsp;
									<input class="form-check-input" type="radio" name="medium_exam" value="2">
									English
								</div>
							</div>
							<hr>
							<div class="table-responsive">
								<table class="table table-striped table-bordered" style="width: 100%">
									<caption><h5><center>EDUCATIONAL QUALIFICATIONS</center></h5></caption>
									<thead>
										<tr>
											<th style="width: 5%">Sl. No.</th>
											<th>Name of Board/ University</th>
											<th style="width: 13%">Year of Passing</th>
											<th style="width: 10%">Roll No.</th>
											<th style="width: 10%">Total Marks Obtained</th>
											<th>Name of the School/College</th>
											<th style="width: 10%">Upload Verification Report(*) <br><small style="    font-size: 69%;">(Less than 1 MB can be uploaded in JPG or PDF format)</small></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>1.</td>
											<td><input type="text" name="board_1" class="form-control autocapitalize" placeholder="Enter Matric Details"></td>
											<td><input type="text" name="year_1" class="form-control "></td>
											<td><input type="text" name="roll_1" class="form-control"></td>
											<td><input type="text" name="marks_1" class="form-control"></td>
											<td><input type="text" name="school_1" class="form-control autocapitalize"></td>
											<td><input type="file" name="file1" required=""></td>
										</tr>
										<tr>
											<td>2.</td>
											<td><input type="text" name="board_2" class="form-control autocapitalize" placeholder="Enter Intermediate Details"></td>
											<td><input type="text" name="year_2" class="form-control"></td>
											<td><input type="text" name="roll_2" class="form-control"></td>
											<td><input type="text" name="marks_2" class="form-control"></td>
											<td><input type="text" name="school_2" class="form-control autocapitalize"></td>
											<td><input type="file" name="file2" required=""></td>
										</tr>
										<tr>
											<td>3.</td>
											<td><input type="text" name="board_3" class="form-control autocapitalize"></td>
											<td><input type="text" name="year_3" class="form-control"></td>
											<td><input type="text" name="roll_3" class="form-control"></td>
											<td><input type="text" name="marks_3" class="form-control"></td>
											<td><input type="text" name="school_3" class="form-control autocapitalize"></td>
										</tr>
										<tr>
											<td>4.</td>
											<td><input type="text" name="board_4" class="form-control autocapitalize"></td>
											<td><input type="text" name="year_4" class="form-control"></td>
											<td><input type="text" name="roll_4" class="form-control"></td>
											<td><input type="text" name="marks_4" class="form-control"></td>
											<td><input type="text" name="school_4" class="form-control autocapitalize"></td>
										</tr>
									</tbody>
								</table>
							</div>
							<hr>
							<div class="table-responsive">
								<table class="table table-striped table-bordered" style="width: 100%">
									<caption><h5><center>I WISH TO BE EXAMINED IN THE FOLLOWING SUBJECTS</center></h5></caption>
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
							<div class="row">	
								<div class="form-group col-sm-6">
									<label for="img">Candidate Photo :<span style="color:red; font-weight: bold;"> *</span> (Max size 50 KB in .jpg or .png format) </label>
									<input type="file"  name="img1" class="form-control" id="img1" onchange="readURL(this);">
									<img id="blah"/>
								</div>
								<div class="form-group col-sm-6">
									<label for="img">Candidate Signature :<span style="color:red; font-weight: bold;"> *</span> (Max size 30 KB in .jpg or .png format) </label>
									<input type="file" name="img2" id="img2" class="form-control" onchange="readURL1(this);">
									<img id="blah1" />
								</div>
							</div>
							<div class="row">	
								<div class="form-group col-sm-6">
									<h4>Are you a resitter candidate? <input type="checkbox" value="Yes" id="resitter" onclick="show_full()" >  Yes</h4>
								</div>
							</div>

									<div class="row resitter_div" style="display: none;">
										<div class="col-sm-10">
										<div class="col-sm-12 table-responsive">
										<h3><center>FOR RE-SITTER CANDIDATES</center></h3>
										<div class="row">
										<div class="col-sm-2 ">I sat </div>
										<div class="col-sm-2"><input type="number" name="no_times" class="form-control" placeholder="No. Times"></div>
										<div class="col-sm-7" > times, the last examination. I sat for was in the month of</div>
										<div class="col-sm-1" >
										<input type="text" name="rmonth1" class="form-control" style="width: 100px; margin-left: -62px;" placeholder="Month">
										</div>


										<div class="col-sm-2"> year </div>
										<div class="col-sm-2"><input type="number" name="ryear1" class="form-control" placeholder="Year"> </div>
										<div class="col-sm-1" >from</div>
										<div class="col-sm-7" >
										<input type="text" name="rtrainschool" class="form-control" placeholder="Name of Training School"> 
										</div>

										<div class="col-sm-4">Training School, under Roll</div> 
										<div class="col-sm-4"><input type="text" name="rroll1" class="form-control" placeholder="Roll"></div>

										<div class="col-sm-2 ">No. </div>
										<div class="col-sm-2">
										<input type="text" name="rno1" class="form-control"  placeholder="No."></div>

										</div> 


										<div class="row">
										<div class="col-sm-2 ">I have passed </div>
										<div class="col-sm-2">
										<select name="ryear2" class="form-control" style="width:150px; ">
										<option value="">Select Year</option>
										<option value="First Year">First Year</option>
										<option value="Second Year">Second Year</option>
										</select>
										</div>
										<div class="col-sm-2">
										<select name="rcourse" class="form-control" style="width:150px; ">
										<option>Select Course</option>
										<option value="ANM">ANM</option>
										<option value="GNM">GNM</option>
										</select>
										</div>
										<div class="col-sm-6">Examination conducted by Jharkhand Nurses  </div>


										</div>

										<div class="row" style="margin-top: 10px">
										<div class="col-sm-3 ">Registration Council from </div>
										<div class="col-sm-9 "><input type="text" name="rcouncil" class="form-control" ></div>
										</div>

										<div class="row" >
										<div class="col-sm-4 ">School of Nursing in the month of </div>
										<div class="col-sm-3 "><input type="text" name="rmonth2" class="form-control" placeholder="Enter Month"></div>

										<div class="col-sm-2 " >with Roll </div>
										<div class="col-sm-2 "><input type="text" name="rroll2" class="form-control" placeholder="Roll"></div>
										<div class="col-sm-2 ">No. </div>
										<div class="col-sm-2 "><input type="text" name="rno2" class="form-control" placeholder="No."></div>
										</div>

										<div class="row" >
										<div class="col-sm-3 ">I wish to be examined in  </div>
										<div class="col-sm-3" >
										<input class="form-check-input" type="radio" name="rlang" value="English"  >
										English
										&nbsp;&nbsp;
										<input class="form-check-input" type="radio" name="rlang" value="Hindi" >
										Hindi
										</div>
										<div class="col-sm-3 ">language</div>
										</div>
										</div>
										</div>
									</div>


							<h3><center>ENDORSEMENT BY SCHOOL OF NURSING</center></h3>
							<div class="row">
								<div class="col-sm-3 ">I consider Miss/Mrs./Sr. </div>
								<div class="col-sm-6"><input type="text" name="ename" class="form-control" ></div>
								<div class="col-sm-3" > Year Student is suitable</div>
							</div>
							<br>
							<div class="row">
								<div class="col-sm-6"> For appearing in ensuing examination to be held in the month of  </div>
								<div class="col-sm-2"><input type="text" name="emonth1" class="form-control" > </div>
								<div class="col-sm-1" >Year</div>
								<div class="col-sm-3"><input type="text" name="eyear1" class="form-control" > </div>
								
							</div> 
							
							<div class="row">
								<div class="col-sm-6">Conducted by Jharkhand Nurses Registration Council.</div>
							</div> 
							<div class="row">
								<div class="col-sm-4">Her work/Clinical Work is satisfactory. Her conduct is </div>
								<div class="col-sm-8">
									<input type="text" name="econduct" class="form-control" >
								</div>
							</div>
							<br>
							<div class="table-responsive">
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

							<div class="row">
								<div class="col-sm-3 ">We certify that she has put in </div>
								<div class="col-sm-2 "><input type="text" name="eyear2" class="form-control" placeholder="Year"></div>
								<div class="col-sm-1" >Year</div>
								<div class="col-sm-2"><input type="text" name="emonth2" class="form-control" placeholder="Month"> </div>
								<div class="col-sm-2" >Month And</div>
								<div class="col-sm-2" ><input type="text" name="eday" class="form-control" placeholder="No. of Days" ></div>	
							</div><hr>
							<div class="row">

								<div class="col-sm-12" >Days training exclusive of leave and has attended 75% Lectures/Clinical in each subject .</div> 
								<div class="col-sm-12" >Field/ Clinical experience and that she is "Eligible" to appear at the examination as per terms and condition lad\id down by INDIAN NURSING COUNCIL Syllabus.</div>
							</div>


							<div class="table-responsive">
								<table class="table table-striped table-bordered" style="width: 100%; text-align: center;">
									<caption><h5><center><I>HE/SHE HAS ATTENDED THE UNDERMENTIONED NUMBER OF LECTURES</I></center></h5></caption>
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
							<div class="row">
								<div class="form-check col-sm-12" style="margin-top: 10px; margin-bottom: 10px;">
									<input type="checkbox" class="form-check-input" id="confirm" required="">
									I have verified all the fields carefully and the information given by me  are true to my belief and knowledge. 
								</div>
							</div>
							<center>
								<input type="submit" name="admission_stud" class="btn btn-primary" value="Submit & Continue">
							</center><br>
						</form> 
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- <fieldset>
<div class="row">
<div class="col-sm-10">
<h2>New Exam Form submission is over. Check all submitted forms. Please wait for admit card. Take printout of the admit card and physically sign with the council authority. Make sure to bring payment receipt with you. <br><br> Thankyou !!</h2>
</div></div>
</fieldset> --->


<script type="text/javascript">
function show_full(){
var ab = $('#resitter').is(':checked'); 
if(ab==true){ 
$('.resitter_div').show(200);

}
else{
$('.resitter_div').hide(200);
}
}
</script>
<script type="text/javascript">
function readURL(input) {
if (input.files && input.files[0]) {
var reader = new FileReader();

reader.onload = function (e) {
$('#blah')
.attr('src', e.target.result)
.width(225)
.height(200);
};
reader.readAsDataURL(input.files[0]);
}
}
function readURL1(input) {
if (input.files && input.files[0]) {
var reader = new FileReader();

reader.onload = function (e) {
$('#blah1')
.attr('src', e.target.result)
.width(250)
.height(100);
};
reader.readAsDataURL(input.files[0]);
}
}

/* $(function () {


$('form').on('submit', function (e) {
// alert('form is submitting');
e.preventDefault();


$.ajax({
type: 'post',
url: '<?php echo base_url();?>save_exam_form',
data: $('form').serialize(),
success: function (result) {
//console.log(result);
//alert('form was submitted');
document.location.href = 'success_exam_form/'+result;
}
});

});

});*/
</script>
<script type="text/javascript" charset="utf-8">
//Capitalize first letter while typing in side of input field
jQuery(document).ready(function($) {
$('.autocapitalize').keyup(function(event) {
var textBox = event.target;
var start = textBox.selectionStart;
var end = textBox.selectionEnd;
textBox.value = textBox.value.charAt(0).toUpperCase() + textBox.value.slice(1);
textBox.setSelectionRange(start, end);
});
});
</script>