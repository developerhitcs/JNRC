<?php
 
foreach ($row as $key) {
}

?>

<br>
<center>
	<h1>JHARKHAND NURSES REGISTRATION COUNCIL, RANCHI</h1>
<img src="<?php echo base_url('assets/images/logo_pdf.png');?>" style="padding: -20px">
	<h4>EXAMINATION APPLICATION FORM </h4>
</center>
<div class="row">
			<div class="col-sm-2"></div>
				<div class="col-sm-10">
					 <form  enctype="multipart/form-data" method="POST" action="<?php echo base_url('update_exam_form');?>"> 
            
						<fieldset>
							<span style="color:red; font-weight: bold;"> (*)</span> Marked fields are mandatory.
						<div class="row">
          <div class="col-sm-10">
            <input type="hidden" name="ref_id" value="<?php echo $key['ref_id'];?>">
            <input type="hidden" name="ref_no" value="<?php echo $key['ref_no'];?>">
				  <div class="form-group col-sm-6">
					<label for="date_adm">Course:<span style="color:red; font-weight: bold;"> *</span></label>
					<select class="form-control" name="course" id="course" required="">

						<option value="">--Select--</option>
						<option value="gnm_year_1" <?php if($key['course']=="gnm_year_1")echo 'selected';?>>1st Year GNM</option>
						<option value="gnm_year_2" <?php if($key['course']=="gnm_year_2")echo 'selected';?>>2nd Year GNM</option>
						<option value="gnm_year_3" <?php if($key['course']=="gnm_year_3")echo 'selected';?>>3rd Year GNM</option>
						<option value="anm_year_1" <?php if($key['course']=="anm_year_1")echo 'selected';?>>1st Year ANM</option>
						<option value="anm_year_2" <?php if($key['course']=="anm_year_2")echo 'selected';?>>2nd Year ANM</option>
					</select>
				  </div>
				  <div class="form-group col-sm-6">
					<label for="stud_name">Name :<span style="color:red; font-weight: bold;"> *</span></label>
					<input type="text" class="form-control" name="name" id="name" value="<?php echo $key['name'];?>" required="">
				  </div>
				  
				  <div class="form-group col-sm-6">
					<label for="father_name">Father's Name :<span style="color:red; font-weight: bold;"> *</span></label>
					<input type="text" class="form-control" name="father_name" id="father_name" required="" value="<?php echo $key['father_name'];?>">
				  </div>
				  <div class="form-group col-sm-6">
					<label for="mother_name">Mother's Name :<span style="color:red; font-weight: bold;"> *</span></label>
					<input type="text" class="form-control" name="mother_name" id="mother_name" required="" value="<?php echo $key['mother_name'];?>">
				  </div>
				  <div class="form-group col-sm-6">
					<label for="dob">Date of Birth :<span style="color:red; font-weight: bold;"> *</span></label>
					<input type="text"  class="form-control" name="dob" id="dob" required="" value="<?php echo $key['dob'];?>">
				  </div>

				 	<div class="form-group col-sm-6">
					<label for="class">Age : (must be between 17-35)<span style="color:red; font-weight: bold;"> *</span></label>
					<input type="number" class="form-control" name="age" id="age" required="" placeholder="Age must be between 17-35" readonly="" value="<?php echo $key['age'];?>">
				  </div>

				 	<div class="form-group col-sm-6">
					<label for="class">Aadhar No. :<span style="color:red; font-weight: bold;"> *</span></label>
					<input type="number" class="form-control" name="aadhar" id="aadhar" required="" value="<?php echo $key['aadhar'];?>">
				  </div>
				   <div class="form-group col-sm-6" style="margin-bottom: 27px;">
					<label>Marital Status :<span style="color:red; font-weight: bold; "> *</span></label><br>
					  <input class="form-check-input" type="radio" name="marital" value="1" required="" <?php if($key['marital']=="Married")echo 'checked';?>>
					    Married
					  &nbsp;&nbsp;
					  <input class="form-check-input" type="radio" name="marital" value="2" <?php if($key['marital']=="Unmarried")echo 'checked';?>>
					    Unmarried
					  &nbsp;&nbsp;
					  <input class="form-check-input" type="radio" name="marital" value="3" Unmarried <?php if($key['marital']=="Widow")echo 'checked';?>>
					    Widow
					  &nbsp;&nbsp;
					  <input class="form-check-input" type="radio" name="marital" value="4" <?php if($key['marital']=="Divorcee")echo 'checked';?>>
					    Divorcee
				  </div>
				  <div class="form-group col-sm-6">
					<label for="percentage">Nationality :</label>
					<input type="text" class="form-control" name="nationality" id="nationality" required="" value="<?php echo $key['nationality'];?>">
				  </div>
				  <div class="form-group col-sm-6">
					<label for="perm_address">Permanent Address: &nbsp; &nbsp;
    				</label> 
					<textarea class="form-control" name="perm_address" id="perm_address" ><?php echo $key['perm_address'];?></textarea> 
				  </div>
				 <div class="form-group col-sm-6">
					<label for="class_apply">Name of Training School :<span style="color:red; font-weight: bold;"> *</span></label>
					<input type="text" class="form-control" name="train_school" id="train_school" required="" value="<?php echo $key['train_school'];?>">
					</div>

				   <div class="form-group col-sm-6">
					<label>Medium of Exam :<span style="color:red; font-weight: bold;"> *</span></label><br>
					  <input class="form-check-input" type="radio" name="medium_exam" value="1" required="" <?php if($key['medium_exam']=="Hindi")echo 'checked';?>>
					    Hindi
					  &nbsp;&nbsp;
					  <input class="form-check-input" type="radio" name="medium_exam" value="2" <?php if($key['medium_exam']=="English")echo 'checked';?>>
					    English
				  </div>
          </div>
				  </div>

				  <div class="col-sm-12 table-responsive">
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
				  				<td><input type="text" name="board_1" class="form-control" placeholder="Enter Matric Details" value="<?php echo $key['board_1'];?>"></td>
				  				<td><input type="text" name="year_1" class="form-control" value="<?php echo $key['year_1'];?>"></td>
				  				<td><input type="text" name="roll_1" class="form-control" value="<?php echo $key['roll_1'];?>"></td>
				  				<td><input type="text" name="marks_1" class="form-control" value="<?php echo $key['marks_1'];?>"></td>
                  <td><input type="text" name="school_1" class="form-control" value="<?php echo $key['school_1'];?>">
                  </td>
				  				<td>
				  					<input type="hidden" name="mat_rep" value="<?php echo $key['file1'];?>">
				  					<a href="<?php echo base_url().$key['file1'];?>" target="_blank" class="btn btn-xs btn-success">View Matric Report</a><br>

				  					Change: <input type="file"  name="file1" id="file1">

				  					</td>
				  			</tr>
				  			<tr>
				  				<td>2.</td>
				  				<td><input type="text" name="board_2" class="form-control" placeholder="Enter Intermediate Details" value="<?php echo $key['board_2'];?>"></td>
				  				<td><input type="text" name="year_2" class="form-control" value="<?php echo $key['year_2'];?>"></td>
				  				<td><input type="text" name="roll_2" class="form-control" value="<?php echo $key['roll_2'];?>"></td>
				  				<td><input type="text" name="marks_2" class="form-control" value="<?php echo $key['marks_2'];?>"></td>
				  				<td><input type="text" name="school_2" class="form-control" value="<?php echo $key['school_2'];?>"></td>
                  <td><input type="hidden" name="inter_rep" value="<?php echo $key['file2'];?>">
				  					<a href="<?php echo base_url().$key['file2'];?>" target="_blank" class="btn btn-xs btn-success">View Inter Report</a><br>

				  					Change: <input type="file"  name="file2" id="file2"></td>
				  			</tr>
				  			<tr>
				  				<td>3.</td>
				  				<td><input type="text" name="board_3" class="form-control" value="<?php echo $key['board_3'];?>"></td>
				  				<td><input type="text" name="year_3" class="form-control" value="<?php echo $key['year_3'];?>"></td>
				  				<td><input type="text" name="roll_3" class="form-control" value="<?php echo $key['roll_3'];?>"></td>
				  				<td><input type="text" name="marks_3" class="form-control" value="<?php echo $key['marks_3'];?>"></td>
				  				<td><input type="text" name="school_3" class="form-control" value="<?php echo $key['school_3'];?>"></td>
                 
				  			</tr>
				  			<tr>
				  				<td>4.</td>
				  				<td><input type="text" name="board_4" class="form-control" value="<?php echo $key['board_4'];?>"></td>
				  				<td><input type="text" name="year_4" class="form-control" value="<?php echo $key['year_4'];?>"></td>
				  				<td><input type="text" name="roll_4" class="form-control" value="<?php echo $key['roll_4'];?>"></td>
				  				<td><input type="text" name="marks_4" class="form-control" value="<?php echo $key['marks_4'];?>"></td>
				  				<td><input type="text" name="school_4" class="form-control" value="<?php echo $key['school_4'];?>"></td>
                  
				  			</tr>
				  		</tbody>
				  	</table>
				  </div>
          <div class="col-sm-10">
          <div class="col-sm-12 table-responsive">
				  	<table class="table table-striped table-bordered" style="width: 100%">
				  		<caption><h5><center>I WISH TO BE EXAMINED IN THE FOLLOWING SUBJECTS</center></h5></caption>
				  		<tbody>
				  			<tr>
				  				<td>A.</td>
				  				<td><input type="text" name="sub_1" class="form-control" value="<?php echo $key['sub_1'];?>"></td>
				  				<td>B.</td>
				  				<td><input type="text" name="sub_2" class="form-control" value="<?php echo $key['sub_2'];?>"></td>
				  			</tr>
				  			<tr>
				  				<td>C.</td>
				  				<td><input type="text" name="sub_3" class="form-control" value="<?php echo $key['sub_3'];?>"></td>
				  				<td>D.</td>
				  				<td><input type="text" name="sub_4" class="form-control" value="<?php echo $key['sub_4'];?>"></td>
				  			</tr>
                <tr>
                  <td>E.</td>
                  <td><input type="text" name="sub_5" class="form-control" value="<?php echo $key['sub_5'];?>"></td>
                  <td>F.</td>
                  <td><input type="text" name="sub_6" class="form-control" value="<?php echo $key['sub_6'];?>"></td>
                </tr>
				  			<tr>
				  				<td>G.</td>
				  				<td><input type="text" name="sub_7" class="form-control" value="<?php echo $key['sub_7'];?>"></td>
				  				<td>H.</td>
				  				<td><input type="text" name="sub_8" class="form-control" value="<?php echo $key['sub_8'];?>"></td>
				  			</tr>
				  		</tbody>
				  	</table>
          </div>
				  </div>
				  <div class="row">
				  <div class="form-group col-sm-6">
					<label for="img">Candidate Photo :<span style="color:red; font-weight: bold;"> *</span> (Max size 50 KB in .jpg or .png format) </label>
				  </div>
				  <div class="form-group col-sm-6">
          			<!-- <input type="file"  name="img1" id="img1" onchange="readURL(this);"> -->
          			<img id="blah" src="<?php echo base_url('/'). $key['img1'];?>" style="width: 150px;height:165px"><br><br>
          			<input type="hidden" name="old_image" value="<?php echo $key['img1'];?>">
          			Change Photo: <input type="file"  name="img1" id="img1" onchange="readURL(this);"> 
					</div>
				 </div>
				  <div class="row">
				  <div class="form-group col-sm-6">
					<label for="img">Candidate Signature :<span style="color:red; font-weight: bold;"> *</span> (Max size 30 KB in .jpg or .png format) </label>
				  </div>
				  <div class="form-group col-sm-6">
					<!-- <input type="file" name="img2" id="img2"  onchange="readURL1(this);"> -->
          			<input type="hidden" name="old_sign" value="<?php echo $key['img2'];?>">
                	<img id="blah1" src="<?php echo base_url('/'). $key['img2'];?>" style="width: 200px;height:75px"> <br><br>

                	Change Signature: <input type="file"  name="img2" id="img2" onchange="readURL1(this);">
					</div>
          <div class="form-group col-sm-6">
           <h4>Are you a resitter candidate? <input type="checkbox" value="Yes" id="resitter" onclick="show_full()" >  Yes</h4>
           </div>
				 </div>
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
        <!-- For Resitter Candidates -->
        <div class="row resitter_div" style="display: none;">

        <div class="col-sm-10">
          <div class="col-sm-12 table-responsive">
            <h3><center>FOR RE-SITTER CANDIDATES</center></h3>
            
              <div class="row">
              <div class="col-sm-2 ">I sat </div>
              <div class="col-sm-2"><input type="number" name="no_times" class="form-control" placeholder="No. Times" value="<?php echo $key['no_times'];?>"></div>
              <div class="col-sm-7" > times, the last examination. I sat for was in the month of</div>
               <div class="col-sm-1" >
                <input type="text" name="rmonth1" class="form-control" style="width: 100px; margin-left: -62px;" placeholder="Month" value="<?php echo $key['rmonth1'];?>">
              </div>

              <!-- line end -->
               <div class="col-sm-2"> year </div>
               <div class="col-sm-2"><input type="number" name="ryear1" class="form-control" placeholder="Year" value="<?php echo $key['ryear1'];?>"> </div>
               <div class="col-sm-1" >from</div>
               <div class="col-sm-7" >
                <input type="text" name="rtrainschool" class="form-control" placeholder="Name of Training School" value="<?php echo $key['rtrainschool'];?>"> 
              </div>
<!-- line end -->
              <div class="col-sm-4">Training School, under Roll</div> 
              <div class="col-sm-4"><input type="number" name="rroll1" class="form-control" placeholder="Roll" value="<?php echo $key['rroll1'];?>"></div>

              <div class="col-sm-2 ">No. </div>
              <div class="col-sm-2">
                <input type="number" name="rno1" class="form-control"  placeholder="No." value="<?php echo $key['rno1'];?>"></div>
               
              </div> <!-- ENd of Row -->


              <div class="row">
                <div class="col-sm-2 ">I have passed </div>
                 <div class="col-sm-2">
                    <select name="ryear2" class="form-control" style="width:150px; ">
                      <option value="">Select Year</option>
                      <option value="First Year" <?php if($key['ryear2']=="First Year")echo 'selected';?>>First Year</option>
                      <option value="Second Year" <?php if($key['ryear2']=="First Year")echo 'selected';?>>Second Year</option>
                    </select>
                </div>
                <div class="col-sm-2">
              <select name="rcourse" class="form-control" style="width:150px; ">
                  <option>Select Course</option>
                  <option value="ANM" <?php if($key['rcourse']=="ANM")echo 'selected';?>>ANM</option>
                  <option value="GNM" <?php if($key['rcourse']=="GNM")echo 'selected';?>>GNM</option>
                </select>
              </div>
              <div class="col-sm-6">Examination conducted by Jharkhand Nurses  </div>

 
              </div><!-- ENd of Row -->

              <div class="row" style="margin-top: 10px">
              <div class="col-sm-3 ">Registration Council from </div>
              <div class="col-sm-9 "><input type="text" name="rcouncil" class="form-control" value="<?php echo $key['rcouncil'];?>"></div>
              </div>

              <div class="row" >
              <div class="col-sm-4 ">School of Nursing in the month of </div>
              <div class="col-sm-3 "><input type="text" name="rmonth2" class="form-control" placeholder="Enter Month" value="<?php echo $key['rmonth2'];?>"></div>
              
              <div class="col-sm-2 " >with Roll </div>
              <div class="col-sm-2 "><input type="number" name="rroll2" class="form-control" placeholder="Roll"  value="<?php echo $key['rroll2'];?>"></div>
              <div class="col-sm-2 ">No. </div>
              <div class="col-sm-2 "><input type="number" name="rno2" class="form-control" placeholder="No."  value="<?php echo $key['rno2'];?>"></div>
              </div>

              <div class="row" >
               <div class="col-sm-3 ">I wish to be examined in  </div>
              <div class="col-sm-3">
              <input class="form-check-input" type="radio" name="rlang" value="English"  <?php if($key['rlang']=="English")echo 'checked';?>>
              Hindi
            &nbsp;&nbsp;
            <input class="form-check-input" type="radio" name="rlang" value="Hindi" <?php if($key['rlang']=="Hindi")echo 'checked';?>>
              English
              </div>
              <div class="col-sm-3 ">language</div>
              </div>
              </div>
              </div>
              </div>

           <!-- </div>
               </div>
              </div> -->
        
        <!-- For Resitter Candidates -->
        <div class="row">
        <div class="col-sm-10">
          <div class="col-sm-12 table-responsive">
            <h3><center>ENDORSEMENT BY SCHOOL OF NURSING</center></h3>
            
              <div class="row">
              <div class="col-sm-3 ">I consider Miss/Mrs./Sr. </div>
              <div class="col-sm-6"><input type="text" name="ename" class="form-control" value="<?php echo $key['ename'];?>"></div>
              <div class="col-sm-3" > Year Student is suitable</div>
              </div>

              <!-- line end -->
              <div class="row">
               <div class="col-sm-7"> for appearing in ensuing examination to be held in the month of  </div>
               <div class="col-sm-2"><input type="text" name="emonth1" class="form-control" value="<?php echo $key['emonth1'];?>"> </div>
               <div class="col-sm-1" >Year</div>
               <div class="col-sm-2"><input type="text" name="eyear1" class="form-control" value="<?php echo $key['eyear1'];?>"> </div>
<!-- line end -->
              
              <div class="col-sm-6">conducted by Jharkhand Nurses Registration Council.</div> 
              
               
              </div> <!-- ENd of Row -->


              <div class="row">
                <div class="col-sm-5 ">Her work/Clinical 
                Work is satisfactory. </div>
                <div class="col-sm-3 ">Her conduct is </div>
                 <div class="col-sm-4">
                    <input type="text" name="econduct" class="form-control" value="<?php echo $key['econduct'];?>">
                </div>
              </div><!-- ENd of Row -->

              <div class="row">
                
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
                  <td><input type="text" name="edoj1" id="edoj1" class="form-control doj" value="<?php echo $key['edoj1'];?>"></td>
                  <td><input type="text" name="edoj2" id="edoj2" class="form-control doj" value="<?php echo $key['edoj2'];?>"></td>
                  <td><input type="text" name="edoj3" id="edoj3" class="form-control doj" value="<?php echo $key['edoj3'];?>"></td>
                </tr>
                <tr>
                  <td>Total Leaved availed in</td>
                  <td><input type="text" name="eleave1" class="form-control" value="<?php echo $key['eleave1'];?>"></td>
                  <td><input type="text" name="eleave2" class="form-control" value="<?php echo $key['eleave2'];?>"></td>
                  <td><input type="text" name="eleave3" class="form-control" value="<?php echo $key['eleave3'];?>"></td>
                </tr>
                
              </tbody>
            </table>
              </div><!-- ENd of Row -->

              <div class="row" style="margin-top: 10px">
              <div class="col-sm-4 ">We certify that she has put in </div>
              <div class="col-sm-2 "><input type="text" name="eyear2" class="form-control" placeholder="Year" value="<?php echo $key['eyear2'];?>"></div>
              <div class="col-sm-1" >Year</div>
               <div class="col-sm-2"><input type="text" name="emonth2" class="form-control" placeholder="Month" value="<?php echo $key['emonth2'];?>"> </div>
               <div class="col-sm-3" >Month and</div>

               <div class="col-sm-3" sty><input type="text" name="eday" class="form-control" placeholder="No. of Days" value="<?php echo $key['eday'];?>"></div>
               <div class="col-sm-9" >days training exclusive of leave and has attended 75% Lectures/Clinical in each subject</div> 
               <div class="col-sm-12" >field/ Clinical experience and that she is "Eligible" to appear at the examination as per terms and condition lad\id down by INDIAN NURSING COUNCIL Syllabus.</div>
              </div>
              <div class="row">
                 <table class="table table-striped table-bordered" style="width: 100%; text-align: center;" >
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
                  <td><input type="text" name="lsub_1" class="form-control" value="<?php echo $key['lsub_1'];?>"></td>
                  <td><input type="text" name="ldel_1" class="form-control" value="<?php echo $key['ldel_1'];?>"></td>
                  <td><input type="text" name="latt_1" class="form-control" value="<?php echo $key['latt_1'];?>"></td>
                  <td><input type="text" name="lper_1" class="form-control" value="<?php echo $key['lper_1'];?>"></td>
                </tr>
                <tr>
                  <td>B.</td>
                  <td><input type="text" name="lsub_2" class="form-control" value="<?php echo $key['lsub_2'];?>"></td>
                  <td><input type="text" name="ldel_2" class="form-control" value="<?php echo $key['ldel_2'];?>"></td>
                  <td><input type="text" name="latt_2" class="form-control" value="<?php echo $key['latt_2'];?>"></td>
                  <td><input type="text" name="lper_2" class="form-control" value="<?php echo $key['lper_2'];?>"></td>
                </tr>
                <tr>
                  <td>C.</td>
                  <td><input type="text" name="lsub_3" class="form-control" value="<?php echo $key['lsub_3'];?>"></td>
                  <td><input type="text" name="ldel_3" class="form-control" value="<?php echo $key['ldel_3'];?>"></td>
                  <td><input type="text" name="latt_3" class="form-control" value="<?php echo $key['latt_3'];?>"></td>
                  <td><input type="text" name="lper_3" class="form-control" value="<?php echo $key['lper_3'];?>"></td>
                </tr>
                <tr>
                  <td>D.</td>
                  <td><input type="text" name="lsub_4" class="form-control" value="<?php echo $key['lsub_4'];?>"></td>
                  <td><input type="text" name="ldel_4" class="form-control" value="<?php echo $key['ldel_4'];?>"></td>
                  <td><input type="text" name="latt_4" class="form-control" value="<?php echo $key['latt_4'];?>"></td>
                  <td><input type="text" name="lper_4" class="form-control" value="<?php echo $key['lper_4'];?>"></td>
                </tr>
                <tr>
                  <td>E.</td>
                  <td><input type="text" name="lsub_5" class="form-control" value="<?php echo $key['lsub_5'];?>"></td>
                  <td><input type="text" name="ldel_5" class="form-control" value="<?php echo $key['ldel_5'];?>"></td>
                  <td><input type="text" name="latt_5" class="form-control" value="<?php echo $key['latt_5'];?>"></td>
                  <td><input type="text" name="lper_5" class="form-control" value="<?php echo $key['lper_5'];?>"></td>
                </tr>
                <tr>
                  <td>F.</td>
                  <td><input type="text" name="lsub_6" class="form-control" value="<?php echo $key['lsub_6'];?>"></td>
                  <td><input type="text" name="ldel_6" class="form-control" value="<?php echo $key['ldel_6'];?>"></td>
                  <td><input type="text" name="latt_6" class="form-control" value="<?php echo $key['latt_6'];?>"></td>
                  <td><input type="text" name="lper_6" class="form-control" value="<?php echo $key['lper_6'];?>"></td>
                </tr>
                <tr>
                  <td>G.</td>
                  <td><input type="text" name="lsub_7" class="form-control" value="<?php echo $key['lsub_7'];?>"></td>
                  <td><input type="text" name="ldel_7" class="form-control" value="<?php echo $key['ldel_7'];?>"></td>
                  <td><input type="text" name="latt_7" class="form-control" value="<?php echo $key['latt_7'];?>"></td>
                  <td><input type="text" name="lper_7" class="form-control" value="<?php echo $key['lper_7'];?>"></td>
                </tr>
                
              </tbody>
            </table>
              </div>
             

              

           <!-- </div>
               </div>
              </div> -->




            
        <div>
			  <div>
			  <center><!-- <input type="submit" name="admission_stud" class="btn btn-primary" value="Submit"> -->

          <input type="submit" name="admission_stud" class="btn btn-primary" value="Update"></center>
			  </div>
			  </fieldset>
				</form>
			</div>
		</div>

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