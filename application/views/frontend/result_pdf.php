<!-- <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet" type="text/css" media="all" /> -->

          <style type="text/css">
          	#view_table td{
          		
          		text-align: center;
          	}
          	
          </style>
          <script type="text/javascript">
          	$('#yourStyle').circleType({radius: 800});
          </script>
            </br>
            <?php foreach ($row as $key ) {}?>
            <fieldset >
                 <center><h2 id="yourStyle" style="padding-top: -20px">
                 JHARKHAND NURSES REGISTRATION COUNCIL </h2>
                 <img src="<?php echo $_SERVER['DOCUMENT_ROOT']; echo '/assets/images/logo_pdf.png' ?>" style="padding: -20px">
                 <h4 style="padding: -2px">DETAILED MARKS CARD</h4>
                 <?php if($key['year']=='gnm_year_1') { ?>
                 <p style="padding-top: -20px">FIRST YEAR GENERAL NURSING & MIDWIFERY</p>
                 <?php } elseif($key['year']=='gnm_year_2') { ?>
                 <p style="padding-top: -20px">SECOND YEAR GENERAL NURSING & MIDWIFERY</p>
                 <?php } elseif($key['year']=='gnm_year_3') { ?>
                 <p style="padding-top: -20px">THIRD YEAR GENERAL NURSING & MIDWIFERY</p>
                 <?php }if($key['year']=='anm_year_1') { ?>
                 <p style="padding-top: -20px">FIRST YEAR AUXILIARY NURSING & MIDWIFERY</p>
                 <?php } elseif($key['year']=='anm_year_2') { ?>
                 <p style="padding-top: -20px">SECOND YEAR AUXILIARY NURSING & MIDWIFERY</p>
                 <?php } elseif($key['year']=='anm_year_3') { ?>
                 <p style="padding-top: -20px">THIRD YEAR AUXILIARY NURSING & MIDWIFERY</p>
                 <?php } ?>
             	</center> 
                 
					<table class="table table-striped table-bordered" style="width: 100%">
						<thead class="text-primary">
                          <tr>
	                           <th>Examination:</th>
	                           <td colspan="3"><?php echo $key['session'] ?></td>
	                           <th>Roll No.</th>
	                           <td colspan="3"><?php echo $key['school_code']; echo ' - '.$key['roll_no'] ?></td>
                          </tr>
                          <tr>
	                           <th>School Code:</th>
	                           <td colspan="3"><?php echo $key['school_code']; ?></td>
	                           <td></td>
	                           <td></td>
                          </tr>
                          <tr>
	                           <th>Name:</th>
	                           <td colspan="3"><?php echo $key['name'] ?></td>
	                           <td></td>
	                           <td></td>
                          </tr>
                          <tr>
	                           <th>Father's Name:</th>
	                           <td colspan="3"><?php echo $key['father_name'] ?></td>
	                           <td></td>
	                           <td></td>

                          </tr>
                          <tr>
	                           <th>Date of Birth:</th>
	                           <td colspan="3"><?php echo $key['dob'] ?></td>
	                           <td></td>
	                           <td></td>
                          </tr>
                      </thead>
					</table>                 
                  <table id="view_table" class="table table-striped table-bordered" style="width: 100%" border="1px" cellspacing="0">
                       <thead class="text-primary">
                          <tr>
	                           <th rowspan="2"><center>Name of Subject</center></th>
	                           <th rowspan="2"><center>Full<br>Marks</center></th>
	                           <th rowspan="2"><center>Pass<br>Marks</center></th>
	                            <th colspan="3"><center>Marks Obtained</center></th>
                          </tr>
                          <tr>
                          	  
                          	   <th><center>Internal<br>Theory<br>Full Marks 25 <br> Practical <br> Full Marks 100</center></th>
	                           <th><center>External<br>Theory<br>Full Marks 75 <br> Practical <br> Full Marks 100</center></th>
	                           <th><center>Total</center></th>
                          </tr>
                          <?php if($key['year']=='gnm_year_1'){
                          	$int_total = $key['course1_int'] + $key['course2_int'] + $key['course3_int'] + $key['course4_int'] + $key['course5_int'];
                          	$ext_total = $key['course1_ext'] + $key['course2_ext'] + $key['course3_ext'] + $key['course4_ext'] + $key['course5_ext'];
                          	?>
                          <tr>
	                          	<th>Bio- Science (Anatomy + Physio, Micro) (Written)</th>
	                          	<td>100</td>
	                          	<td>50</td>
	                          	<td><?php echo $key['course1_int'] ?></td>
	                          	<td><?php echo $key['course1_ext'] ?></td>
	                          	<td><?php echo $key['course1_tot'] ?></td>
                          </tr>
                          <tr>
	                           	<th>Behavioral Science (Psychology, Sociology)  (Written)</th>
	                          	<td>100</td>
	                          	<td>50</td>
	                          	<td><?php echo $key['course2_int'] ?></td>
	                          	<td><?php echo $key['course2_ext'] ?></td>
	                          	<td><?php echo $key['course2_tot'] ?></td>
                          </tr>
                          <tr>
	                           	<th>Fundamental of Nursing – I (Written) </th>
	                          	<td>100</td>
	                          	<td>50</td>
	                          	<td><?php echo $key['course3_int'] ?></td>
	                          	<td><?php echo $key['course3_ext'] ?></td>
	                          	<td><?php echo $key['course3_tot'] ?></td>
                          </tr>
                          <tr>
	                           	<th>Community Health Nursing – (Written)</th>
	                          	<td>100</td>
	                          	<td>50</td>
	                          	<td><?php echo $key['course4_int'] ?></td>
	                          	<td><?php echo $key['course4_ext'] ?></td>
	                          	<td><?php echo $key['course4_tot'] ?></td>
                          </tr>
                          <tr>
                          		<th>Practical - I</th>
	                          	<td>100</td>
	                          	<td>50</td>
	                          	<td><?php echo $key['course5_int'] ?></td>
	                          	<td><?php echo $key['course5_ext'] ?></td>
	                          	<td><?php echo $key['course5_tot'] ?></td>
                          </tr>
                          <tr>
	                           <td style="text-align:right; !important"><strong>Grand Total</strong></td>
	                           <td>500</td>
	                          	<td>250</td>
	                          	<td><?php echo $int_total; ?></td>
	                          	<td><?php echo $ext_total; ?></td>
	                           	<td><?php echo $key['grand_total'] ?></td>
                          </tr>
                          <?php }elseif($key['year']=='gnm_year_2'){ 
                          	$int_total = $key['course1_int'] + $key['course2_int'] + $key['course3_int'] + $key['course4_int'] + $key['course5_int']+ $key['course6_int']+ $key['course7_int'];
                          	$ext_total = $key['course1_ext'] + $key['course2_ext'] + $key['course3_ext'] + $key['course4_ext'] + $key['course5_ext']+ $key['course6_ext'];
                          	
                          	?>
                          <tr>
                          	<th>Medical Surgical Nursing – I (Written)</th>
                          	<td>100</td>
	                        <td>50</td>
                          	<td><?php echo $key['course1_int'] ?></td>
                          	<td><?php echo $key['course1_ext'] ?></td>
                          	<td><?php echo $key['course1_tot'] ?></td>
                          </tr>
                          <tr>
	                           	<th>Medical Surgical Nursing – II (Written)</th>
	                           	<td>100</td>
	                        	<td>50</td>
	                          	<td><?php echo $key['course2_int'] ?></td>
	                          	<td><?php echo $key['course2_ext'] ?></td>
	                          	<td><?php echo $key['course2_tot'] ?></td>
                          </tr>
                          <tr>
	                           	<th>Mental Health & Psychiatric Nursing (Written)</th>
	                           	<td>100</td>
	                        	<td>50</td>
	                          	<td><?php echo $key['course3_int'] ?></td>
	                          	<td><?php echo $key['course3_ext'] ?></td>
	                          	<td><?php echo $key['course3_tot'] ?></td>
                          </tr>
                          <tr>
	                           	<th>Child Health Nursing (Written)</th>
	                           	<td>100</td>
	                        	<td>50</td>
	                          	<td><?php echo $key['course4_int'] ?></td>
	                          	<td><?php echo $key['course4_ext'] ?></td>
	                          	<td><?php echo $key['course4_tot'] ?></td>
                          </tr>
                          <tr>
	                           	<th>Practical - I Medical+ Surgical Nursing</th>
	                           	<td>100</td>
	                        	<td>50</td>
	                          	<td><?php echo $key['course5_int'] ?></td>
	                          	<td><?php echo $key['course5_ext'] ?></td>
	                          	<td><?php echo $key['course5_tot'] ?></td>
                          </tr>
                          <tr>
                          		<th>Practical - II Child Health Nursing</th>
                          		<td>100</td>
	                        	<td>50</td>
	                          	<td><?php echo $key['course6_int'] ?></td>
	                          	<td><?php echo $key['course6_int'] ?></td>
	                          	<td><?php echo $key['course6_tot'] ?></td>
                          </tr>
                          <tr>
                          		<th>Practical - III Psychiatric Nursing</th>
                          		<td>100</td>
	                        	<td>50</td>
	                          	<td><?php echo $key['course7_int'] ?></td>
	                          	<td>-</td>
	                          	<td><?php echo $key['course7_tot'] ?></td>
                          </tr>
                          <tr>
	                           <td style="text-align:right; !important"><strong>Grand Total</strong></td>
	                           <td>700</td>
	                          	<td>350</td>
	                          	<td><?php echo $int_total; ?></td>
	                          	<td><?php echo $ext_total; ?></td>
	                           	<td><?php echo $key['grand_total'] ?></td>
                          </tr>
                          <?php }elseif($key['year']=='gnm_year_3'){ 
                          	$int_total = $key['course1_int'] + $key['course2_int'] + $key['course3_int'] + $key['course4_int'];
                          	$ext_total = $key['course1_ext'] + $key['course2_ext'] + $key['course3_ext'] + $key['course4_ext'];
                          	?>
                          <tr>
	                          	<th>Midwifery & Gynaecology (Written)</th>
	                          	<td>100</td>
	                        	<td>50</td>
	                          	<td><?php echo $key['course1_int'] ?></td>
	                          	<td><?php echo $key['course1_ext'] ?></td>
	                          	<td><?php echo $key['course1_tot'] ?></td>
                          </tr>
                          <tr>
	                           	<th>Community Health Nursing - II (Written)</th>
	                           	<td>100</td>
	                        	<td>50</td>
	                          	<td><?php echo $key['course2_int'] ?></td>
	                          	<td><?php echo $key['course2_ext'] ?></td>
	                          	<td><?php echo $key['course2_tot'] ?></td>
                          </tr>
                          <tr>
	                           	<th>Practical – I Midwifery</th>
	                           	<td>100</td>
	                        	<td>50</td>
	                          	<td><?php echo $key['course3_int'] ?></td>
	                          	<td><?php echo $key['course3_ext'] ?></td>
	                          	<td><?php echo $key['course3_tot'] ?></td>
                          </tr>
                          <tr>
	                           	<th>Practical II Community Health Nursing - II</th>
	                           	<td>100</td>
	                        	<td>50</td>
	                          	<td><?php echo $key['course4_int'] ?></td>
	                          	<td><?php echo $key['course4_ext'] ?></td>
	                          	<td><?php echo $key['course4_tot'] ?></td>
                          </tr>
                          <tr>
	                           <td style="text-align:right; !important"><strong>Grand Total</strong></td>
	                           <td>400</td>
	                          	<td>200</td>
	                          	<td><?php echo $int_total; ?></td>
	                          	<td><?php echo $ext_total; ?></td>
	                           	<td><?php echo $key['grand_total'] ?></td>
                          </tr>
                          <?php }elseif($key['year']=='anm_year_1'){                           	$int_total = $key['course1_int'] + $key['course2_int'] + $key['course3_int'] + $key['course4_int']+ $key['course5_int']+ $key['course6_int'];
                          	$ext_total = $key['course1_ext'] + $key['course2_ext'] + $key['course3_ext'] + $key['course4_ext']+ $key['course5_ext']+ $key['course6_ext'];
                          	?>
                          <tr>
	                          	<th>Community Health Nursing (Written)</th>
	                          	<td>100</td>
	                        	<td>50</td>
	                          	<td><?php echo $key['course1_int'] ?></td>
	                          	<td><?php echo $key['course1_ext'] ?></td>
	                          	<td><?php echo $key['course1_tot'] ?></td>
                          </tr>
                          <tr>
	                           	<th>Health Promotion (Written)</th>
	                           	<td>100</td>
	                        	<td>50</td>
	                          	<td><?php echo $key['course2_int'] ?></td>
	                          	<td><?php echo $key['course2_ext'] ?></td>
	                          	<td><?php echo $key['course2_tot'] ?></td>
                          </tr>
                          <tr>
	                           	<th>Primary Health Care (Prevention of diseases <br>restoration of health) (Written)</th>
	                           	<td>100</td>
	                        	<td>50</td>
	                          	<td><?php echo $key['course3_int'] ?></td>
	                          	<td><?php echo $key['course3_ext'] ?></td>
	                          	<td><?php echo $key['course3_tot'] ?></td>
                          </tr>
                          <tr>
	                           	<th>Child Health Nursing (Written)</th>
	                           	<td>100</td>
	                        	<td>50</td>
	                          	<td><?php echo $key['course4_int'] ?></td>
	                          	<td><?php echo $key['course4_ext'] ?></td>
	                          	<td><?php echo $key['course4_tot'] ?></td>
                          </tr>
                          <tr>
	                           	<th>Practical - I</th>
	                           	<td>200</td>
	                        	<td>100</td>
	                          	<td><?php echo $key['course5_int'] ?></td>
	                          	<td><?php echo $key['course5_ext'] ?></td>
	                          	<td><?php echo $key['course5_tot'] ?></td>
                          </tr>
                          <tr>
	                           	<th>Practical - II</th>
	                           	<td>200</td>
	                        	<td>100</td>
	                          	<td><?php echo $key['course6_int'] ?></td>
	                          	<td><?php echo $key['course6_ext'] ?></td>
	                          	<td><?php echo $key['course6_tot'] ?></td>
                          </tr>
                          <tr>
	                           <td style="text-align:right; !important"><strong>Grand Total</strong></td>
	                           <td>800</td>
	                          	<td>400</td>
	                          	<td><?php echo $int_total; ?></td>
	                          	<td><?php echo $ext_total; ?></td>
	                           	<td><?php echo $key['grand_total'] ?></td>
                          </tr>
                          <?php }elseif($key['year']=='anm_year_2'){ 
                          	$int_total = $key['course1_int'] + $key['course2_int'] + $key['course3_int'] + $key['course4_int'];
                          	$ext_total = $key['course1_ext'] + $key['course2_ext'] + $key['course3_ext'] + $key['course4_ext'];
                          	?>
                          <tr>
	                          	<th>Midwifery (Written)</th>
	                          	<td>100</td>
	                        	<td>50</td>
	                          	<td><?php echo $key['course1_int'] ?></td>
	                          	<td><?php echo $key['course1_ext'] ?></td>
	                          	<td><?php echo $key['course1_tot'] ?></td>
                          </tr>
                          <tr>
	                           	<th>Health Centre Management (Written)</th>
	                           	<td>100</td>
	                        	<td>50</td>
	                          	<td><?php echo $key['course2_int'] ?></td>
	                          	<td><?php echo $key['course2_ext'] ?></td>
	                          	<td><?php echo $key['course2_tot'] ?></td>
                          </tr>
                          <tr>
	                           	<th>Practical - I (Midwifery)</th>
	                           	<td>200</td>
	                        	<td>100</td>
	                          	<td><?php echo $key['course3_int'] ?></td>
	                          	<td><?php echo $key['course3_ext'] ?></td>
	                          	<td><?php echo $key['course3_tot'] ?></td>
                          </tr>
                          <tr>
	                           	<th>Practical - II (PHC Ng. & Health <br> Centre Management)</th>
	                           	<td>200</td>
	                        	<td>100</td>
	                          	<td><?php echo $key['course4_int'] ?></td>
	                          	<td><?php echo $key['course4_ext'] ?></td>
	                          	<td><?php echo $key['course4_tot'] ?></td>
                          </tr>
                          <tr>
	                           <td style="text-align:right; !important"><strong>Grand Total</strong></td>
	                           <td>600</td>
	                          	<td>300</td>
	                          	<td><?php echo $int_total; ?></td>
	                          	<td><?php echo $ext_total; ?></td>
	                           	<td><?php echo $key['grand_total'] ?></td>
                          </tr>
                          <?php }?>
                          
                          
                  		</thead>
                  </table>           
                
            </fieldset>

<?php
  
$number = $key['grand_total'];
   $no = round($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'One', '2' => 'Two',
    '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
    '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
    '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
    '13' => 'Thirteen', '14' => 'Fourteen',
    '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
    '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
    '30' => 'Thirty', '40' => 'Fourty', '50' => 'Fifty',
    '60' => 'Sixty', '70' => 'Seventy',
    '80' => 'Eighty', '90' => 'Ninety');
   $digits = array('', 'Hundred', 'Thousand', 'lakh', 'crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';
  //echo $result . "Rupees  " . $points . " Paise";
  //echo $result;
 ?> 
                  <table class="table table-striped table-bordered" style="width: 100%; margin-top: 50px;">
						<thead class="text-primary">
                          <tr>
	                           <td><strong>1. Division</strong></td>
	                           
	                           <td><?php echo $key['division'] ?></td>
                          </tr>
                          <tr>
	                           <td><strong>2. Remarks</strong></td>
	                           
	                           <td><?php echo $key['remarks'] ?></td>
                          </tr>
                          <tr>
	                           <th>3. Total marks Obtained <br>(in letters)</th>
	                           <td><?php echo $result?></td>
                          </tr>
                      </thead>
					</table>   
           <p style="font-size: 12px">This is a computer generated temporary marksheet. Candidate must get original marksheet from college</p>
