<?php
 
foreach ($row as $key) {
}

?>

<br>
<fieldset id='printdivi'>
<center>
	<h1>JHARKHAND NURSES REGISTRATION COUNCIL, RANCHI</h1>
<img src="<?php echo base_url('assets/images/logo_pdf.png');?>" style="padding: -20px">
	<h4>EXAMINATION APPLICATION FORM </h4>
</center>
<div class="row">
			<div class="col-sm-2"></div>
				<div class="col-sm-10">
					 <form  enctype="multipart/form-data" method="POST" action="<?php echo base_url('edit_exam_form/').$key['ref_id'];?>"> 
            
						

              
							<!-- <span style="color:red; font-weight: bold;"> (*)</span> Marked fields are mandatory. -->
              <div class="col-sm-10 table-responsive">
						<div class="row" >

              <table class="table table-striped table-bordered" style="width: 100%">
              <caption><h5><center>PERSONAL INFORMATION</center></h5></caption>
             
                
              
              <tbody>
                <tr>
                  <th width="20%">Course</th>
                  <td  width="30%"><?php if($key['course']=='gnm_year_1')echo '1st Year GNM'; elseif($key['course']=='gnm_year_2')echo '2nd Year GNM'; elseif($key['course']=='gnm_year_3')echo '3rd Year GNM'; elseif($key['course']=='anm_year_1')echo '1st Year ANM';elseif($key['course']=='anm_year_2')echo '2nd Year ANM';?></td>
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
                  <!-- <th>Marital Status</th>  
                  <td><?php if($key['marital']==1)echo 'Married'; elseif($key['marital']==2) echo 'Unmarried'; elseif($key['marital']==3) echo 'Divorced';?></td> -->
                  <th >Name of Training School</th>
                  <td><?php echo $key['train_school'];?></td>
                  <th>Medium of Exam</th>  
                  <td><?php echo $key['medium_exam'];?></td>

                </tr>
                <!-- <tr>
                  
                  
                  <td></td>
                  <td></td>
                </tr> -->
                
              </tbody>
            </table>
          
         

          
				 
          </div>
				  </div>

				  <div class="col-sm-11 table-responsive">
				  	<table class="table table-striped table-bordered" style="width: 100%">
				  		<caption><h5><center>EDUCATIONAL QUALIFICATIONS</center></h5></caption>
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
				  				<td><a href="<?php echo base_url().$key['file1'];?>" target="_blank" class="btn btn-xs btn-success">View Matric Report</a></td>
				  			</tr>
				  			<tr>
				  				<td>2.</td>
				  				<td><?php echo $key['board_2'];?></td>
				  				<td><?php echo $key['year_2'];?></td>
				  				<td><?php echo $key['roll_2'];?></td>
				  				<td><?php echo $key['marks_2'];?></td>
				  				<td><?php echo $key['school_2'];?></td>
                  <td><a href="<?php echo base_url().$key['file2'];?>" target="_blank" class="btn btn-xs btn-success">View Inter Report</a></td>
				  			</tr>
				  			<tr>
				  				<td>3.</td>
				  				<td><?php echo $key['board_3'];?></td>
				  				<td><?php echo $key['year_3'];?></td>
				  				<td><?php echo $key['roll_3'];?></td>
				  				<td><?php echo $key['marks_3'];?></td>
				  				<td><?php echo $key['school_3'];?></td>
                 
				  			</tr>
				  			<tr>
				  				<td>4.</td>
				  				<td><?php echo $key['board_4'];?></td>
				  				<td><?php echo $key['year_4'];?></td>
				  				<td><?php echo $key['roll_4'];?></td>
				  				<td><?php echo $key['marks_4'];?></td>
				  				<td><?php echo $key['school_4'];?></td>
                  
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
				  <div class="row">
				  <div class="form-group col-sm-6">
					<label for="img">Candidate Photo :<span style="color:red; font-weight: bold;"> *</span> (Max size 50 KB in .jpg or .png format) </label>
				  </div>
				  <div class="form-group col-sm-6">
          			<!-- <input type="file"  name="img1" id="img1" onchange="readURL(this);"> -->
          			 <img id="blah" src="<?php echo base_url('/'). $key['img1'];?>" style="width: 150px;height:165px">
					</div>
				 </div>
				  <div class="row">
				  <div class="form-group col-sm-6">
					<label for="img">Candidate Signature :<span style="color:red; font-weight: bold;"> *</span> (Max size 30 KB in .jpg or .png format) </label>
				  </div>
				  <div class="form-group col-sm-6">
					<!-- <input type="file" name="img2" id="img2"  onchange="readURL1(this);"> -->
          			 <img id="blah" src="<?php echo base_url('/'). $key['img2'];?>" style="width: 200px;height:75px">
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
              <div class="col-sm-12 ">I sat <b><?php echo $key['no_times'];?></b> times, the last examination. I sat for was in the month of <b><?php echo $key['rmonth1'];?> </b>from <b><?php echo $key['rtrainschool'];?></b> Training School, under Roll <b><?php echo $key['rroll1'];?></b>No.<b> <?php echo $key['rno1'];?></b>

                <br>I have passed <b><?php echo $key['rcourse'];?> <?php echo $key['ryear2'];?> </b> Examination conducted by Jharkhand Nurses Registration Council <b> <?php echo $key['rcouncil'];?> </b> School of Nursing in the month of <b> <?php echo $key['rmonth2'];?></b> with Roll <b> <?php echo $key['rroll2'];?></b> No. <b> <?php echo $key['rno2'];?></b> I wish to be examined in <b> <?php echo $key['rlang'];?></b></div>
             
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
              <div class="col-sm-12 ">I consider Miss/Mrs./Sr. <b><?php echo $key['ename'];?></b> Year Student is suitable for appearing in ensuing examination to be held in the month of <b><?php echo $key['emonth1'];?></b> for appearing in ensuing examination to be held in the month of  <b><?php echo $key['emonth1'];?></b> Year <b><?php echo $key['eyear1'];?></b> conducted by Jharkhand Nurses Registration Council. <br>
                Her work/Clinical Work is satisfactory.
                <br>
                Her conduct is <b><?php echo $key['econduct'];?></b>
              </div>
              </div>
               
             
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
              </div><!-- ENd of Row -->

              <div class="row" style="margin-top: 10px">
              <div class="col-sm-12 ">We certify that she has put in <b><?php echo $key['eyear2'];?></b> Year <b><?php echo $key['emonth2'];?></b>
               Month and </b> Year <b><?php echo $key['eday'];?></b> days training exclusive of leave and has attended 75% Lectures/Clinical in each subject field/ Clinical experience and that she is "Eligible" to appear at the examination as per terms and condition lad\id down by INDIAN NURSING COUNCIL Syllabus.
             </div>

              </div>
              <div class="row">
                 <table class="table table-striped table-bordered" style="width: 100%; text-align: center;">
              <caption><h5><center><I>SHE HAS ATTENDED THE UNDERMENTIONED NUMBER OF LECTURES</I></center></h5></caption>
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
              </div>
              </span>
             

              

           <!-- </div>
               </div>
              </div> -->




            
        <div>
			  <div>
			  <center>

          <input type="submit" name="admission_stud" class="btn btn-success" value="Edit">
          <a onclick="printDiv('printdivi')" class="btn btn-danger">Print</a>
        <?php if($_SERVER['HTTP_REFERER']!=base_url('submitted_exam_form')){?>
        <input type="submit" name="admission_stud" class="btn btn-primary" value="Continue">

      </center>
        <?php }else{?>
        <a href="<?php echo base_url('submitted_exam_form');?>" class="btn btn-primary">Back To List</a>
        
        <?php } ?>
			  </div>
			  </fieldset>
				</form>
			</div>
		</div>
    <script type="text/javascript">
        function printDiv(divName) {
        
             var printContents = document.getElementById(divName).innerHTML;
             var originalContents = document.body.innerHTML;

             document.body.innerHTML = printContents;

             window.print();

             document.body.innerHTML = originalContents;
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