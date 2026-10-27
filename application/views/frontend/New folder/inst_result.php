<!-- <?php 
echo '<pre>';
print_r($row);
echo '</pre>';
?> -->
<style type="text/css">
	.table>thead>tr>th {
    vertical-align: inherit;
    /* border-bottom: 2px solid #ddd; */
}
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
     padding: none; 
    line-height: 1.42857143;
    vertical-align: none;
    border-top: 1px solid #ddd;
}
th {
     text-align: none; 
}
td, th {
     padding: none; 
}
td{
	color:black;
}

</style>
<div class="row">
<div class="col-sm-12 table-responsive">

	<?php if($row[0]['year']=='gnm_year_1'){; ?>
 									<table id="view_table" class="table table-striped table-bordered" style="width: 100%">
                                            <thead class="text-primary">
                                            	<tr>
	                                                <th style="width: 30px;" rowspan="4">Sl.no.</th>
	                                                <th rowspan="4">School Code</th>
	                                                <th rowspan="4">Roll No.</th>
	                                                <th rowspan="4">Name</th>
	                                                <th rowspan="4">Father's Name</th>
	                                                <th rowspan="4">Date of Birth</th>
	                                                <th colspan="30">Subjects</th>
	                                                <th rowspan="3" colspan="2">Grand Total</th>
	                                                <th rowspan="4">Division</th>
	                                                <th rowspan="4">Remarks</th>
	                                            </tr>
	                                            <tr>
	                                            	<th colspan="6">Bio- Science <br>(Anatomy + <br>Physio, Micro)<br> (Written)
	                                            	</th>
	                                            	<th colspan="6">Behavioral Science <br>(Psychology,<br> Sociology)<br>  (Written)

	                                            	</th>
	                                            	<th colspan="6">Fundamental of <br>Nursing – I<br>
	                                            		(Written) 
	                                            	</th>
	                                            	<th colspan="6">Community Health <br> Nursing – I<br>(Written)
	                                            	</th>
	                                            	<th colspan="6">Practical - I
	                                            	</th>
	                                            </tr>
	                                            <tr>
	                                            	<th colspan="2">Internal</th>
	                                            	<th colspan="2">External</th>
	                                            	<th colspan="2">Total</th>
	                                            	<th colspan="2">Internal</th>
	                                            	<th colspan="2">External</th>
	                                            	<th colspan="2">Total</th>
	                                            	<th colspan="2">Internal</th>
	                                            	<th colspan="2">External</th>
	                                            	<th colspan="2">Total</th>
	                                            	<th colspan="2">Internal</th>
	                                            	<th colspan="2">External</th>
	                                            	<th colspan="2">Total</th>
	                                            	<th colspan="2">Internal</th>
	                                            	<th colspan="2">External</th>
	                                            	<th colspan="2">Total</th>
	                                            </tr>
	                                            <tr>
	                                            	<th>F.M.- 25</th>
	                                            	<th>P.M.-13</th>     	
	                                            	<th>F.M.-75</th>     	
	                                            	<th>P.M.-38</th>     	
	                                            	<th>F.M.-100</th>     	
	                                            	<th>P.M.-50</th> 
	                                            	
	                                            	<th>F.M.- 25</th> 
	                                            	<th>P.M.-13</th> 
	                                            	<th>F.M.-75</th> 
	                                            	<th>P.M.-38</th> 
	                                            	<th>F.M.-100</th> 
	                                            	<th>P.M.-50</th> 
	                                            	
	                                            	<th>F.M.- 25</th> 
	                                            	<th>P.M.-13</th> 
	                                            	<th>F.M.-75</th> 
	                                            	<th>P.M.-38</th> 
	                                            	<th>F.M.-100</th> 
	                                            	<th>P.M.-50</th> 

	                                            	<th>F.M.- 25</th> 
	                                            	<th>P.M.-13</th> 
	                                            	<th>F.M.-75</th> 
	                                            	<th>P.M.-38</th> 
	                                            	<th>F.M.-100</th> 
	                                            	<th>P.M.-50</th>  

	                                            	<th>F.M.-50</th> 
	                                            	<th>P.M.-25</th> 
	                                            	<th>F.M.-50</th> 
	                                            	<th>P.M.-25</th> 
	                                            	<th>F.M.-100</th> 
	                                            	<th>P.M.-50</th>
	                                            
	                                            	<th>F.M.-500</th>
	                                            	<th>P.M.-250</th>

	                                            </tr>
                                            </thead>
                                            <tbody class="text-primary">
                                               <?php $i=1; ?>
                                               <?php foreach ($row as $key ) { ?>
                                                <tr>
                                                    <td><?php echo $i;?></td>
                                                    <td><?php echo $key['school_code'];?></td>
                                                    <td><?php echo $key['roll_no'];?></td>
                                                    <td><?php echo $key['name'];?></td>
                                                    <td><?php echo $key['father_name'];?></td>
                                                    <td><?php echo $key['dob'];?></td>
                                                    <td colspan="2"><?php echo $key['course1_int'];?></td>
                                                    <td colspan="2"><?php echo $key['course1_ext'];?></td>
                                                    <td colspan="2"><?php echo $key['course1_tot'];?></td>
                                                    <td colspan="2"><?php echo $key['course2_int'];?></td>
                                                    <td colspan="2"><?php echo $key['course2_ext'];?></td>
                                                    <td colspan="2"><?php echo $key['course2_tot'];?></td>
                                                    <td colspan="2"><?php echo $key['course3_int'];?></td>
                                                    <td colspan="2"><?php echo $key['course3_ext'];?></td>
                                                    <td colspan="2"><?php echo $key['course3_tot'];?></td>
                                                    <td colspan="2"><?php echo $key['course4_int'];?></td>
                                                    <td colspan="2"><?php echo $key['course4_ext'];?></td>
                                                    <td colspan="2"><?php echo $key['course4_tot'];?></td>
                                                    <td colspan="2"><?php echo $key['course5_int'];?></td>
                                                    <td colspan="2"><?php echo $key['course5_ext'];?></td>
                                                    <td colspan="2"><?php echo $key['course5_tot'];?></td>
                                                    <td colspan="2"><?php echo $key['grand_total'];?></td>
                                                    <td><?php echo $key['division'];?></td>
                                                    <td><?php echo $key['remarks'];?></td>
                                                   
                                                </tr>
                                                <?php $i++; 
                                                /*if($i==5) break;*/
                                            } ?>
                                            </tbody>
                                        </table>
                                        <?php } elseif ($row[0]['year']=='gnm_year_2'){?>

 									<table id="view_table" class="table table-striped table-bordered" style="width: 100%">
                                            <thead class="text-primary">
                                            	<tr>
	                                                <th style="width: 30px;" rowspan="4">Sl.no.</th>
	                                                <th rowspan="4">School Code</th>
	                                                <th rowspan="4">Roll No.</th>
	                                                <th rowspan="4">Name</th>
	                                                <th rowspan="4">Father's Name</th>
	                                                <th rowspan="4">Date of Birth</th>
	                                                <th colspan="40">Subjects</th>
	                                                <th rowspan="3" colspan="2">Grand Total</th>
	                                                <th rowspan="4">Division</th>
	                                                <th rowspan="4">Remarks</th>
	                                            </tr>
	                                            <tr>
	                                            	<th colspan="6">Medical Surgical <br>Nursing – I <br>(Written)
	                                            	</th>
	                                            	<th colspan="6">Medical Surgical <br>Nursing – II <br>(Written)
	                                            	</th>
	                                            	<th colspan="6">Mental Health & <br>Psychiatric Nursing <br>(Written)
	                                            	</th>
	                                            	<th colspan="6">Child Health <br>Nursing (Written)
	                                            	</th>
	                                            	<th colspan="6">Practical - I <br>Medical+ Surgical <br>Nursing
	                                            	</th>
	                                            	<th colspan="6">Practical - II <br>Child Health <br>Nursing
	                                            	</th>
	                                            	<th colspan="4">Practical - III <br> Psychiatric <br>Nursing
	                                            	</th>
	                                            </tr>
	                                            <tr>
	                                            	<th colspan="2">Internal</th>
	                                            	<th colspan="2">External</th>
	                                            	<th colspan="2">Total</th>

	                                            	<th colspan="2">Internal</th>
	                                            	<th colspan="2">External</th>
	                                            	<th colspan="2">Total</th>

	                                            	<th colspan="2">Internal</th>
	                                            	<th colspan="2">External</th>
	                                            	<th colspan="2">Total</th>
	                                            	
	                                            	<th colspan="2">Internal</th>
	                                            	<th colspan="2">External</th>
	                                            	<th colspan="2">Total</th>
	                                            	
	                                            	<th colspan="2">Internal</th>
	                                            	<th colspan="2">External</th>
	                                            	<th colspan="2">Total</th>
	                                            	
	                                            	<th colspan="2">Internal</th>
	                                            	<th colspan="2">External</th>
	                                            	<th colspan="2">Total</th>

	                                            	<th colspan="2">Internal</th>
	                                            	<th colspan="2">Total</th>
	                                            </tr>
	                                            <tr>
	                                            	<th>F.M.- 25</th>
	                                            	<th>P.M.-13</th>     	
	                                            	<th>F.M.-75</th>     	
	                                            	<th>P.M.-38</th>     	
	                                            	<th>F.M.-100</th>     	
	                                            	<th>P.M.-50</th> 
	                                            	
	                                            	<th>F.M.- 25</th> 
	                                            	<th>P.M.-13</th> 
	                                            	<th>F.M.-75</th> 
	                                            	<th>P.M.-38</th> 
	                                            	<th>F.M.-100</th> 
	                                            	<th>P.M.-50</th> 
	                                            	
	                                            	<th>F.M.- 25</th> 
	                                            	<th>P.M.-13</th> 
	                                            	<th>F.M.-75</th> 
	                                            	<th>P.M.-38</th> 
	                                            	<th>F.M.-100</th> 
	                                            	<th>P.M.-50</th> 
	                                            	
	                                            	<th>F.M.-50</th> 
	                                            	<th>P.M.-25</th> 
	                                            	<th>F.M.-50</th> 
	                                            	<th>P.M.-25</th> 
	                                            	<th>F.M.-100</th> 
	                                            	<th>P.M.-50</th> 

	                                            	<th>F.M.-50</th> 
	                                            	<th>P.M.-25</th> 
	                                            	<th>F.M.-50</th> 
	                                            	<th>P.M.-25</th> 
	                                            	<th>F.M.-100</th> 
	                                            	<th>P.M.-50</th> 

	                                            	<th>F.M.-50</th> 
	                                            	<th>P.M.-25</th> 
	                                            	<th>F.M.-50</th> 
	                                            	<th>P.M.-25</th> 
	                                            	<th>F.M.-100</th> 
	                                            	<th>P.M.-50</th>

	                                            	<th>F.M.-100</th> 
	                                            	<th>P.M.-50</th>
	                                            	<th>F.M.-100</th> 
	                                            	<th>P.M.-50</th>
	                                            
	                                            	<th>F.M.-700</th>
	                                            	<th>P.M.-350</th>

	                                            </tr>
                                            </thead>
                                            <tbody class="text-primary">
                                               <?php $i=1; ?>
                                               <?php foreach ($row as $key ) { ?>
                                                <tr>
                                                    <td><?php echo $i;?></td>
                                                    <td><?php echo $key['school_code'];?></td>
                                                    <td><?php echo $key['roll_no'];?></td>
                                                    <td><?php echo $key['name'];?></td>
                                                    <td><?php echo $key['father_name'];?></td>
                                                    <td><?php echo $key['dob'];?></td>
                                                    <td colspan="2"><?php echo $key['course1_int'];?></td>
                                                    <td colspan="2"><?php echo $key['course1_ext'];?></td>
                                                    <td colspan="2"><?php echo $key['course1_tot'];?></td>
                                                    <td colspan="2"><?php echo $key['course2_int'];?></td>
                                                    <td colspan="2"><?php echo $key['course2_ext'];?></td>
                                                    <td colspan="2"><?php echo $key['course2_tot'];?></td>
                                                    <td colspan="2"><?php echo $key['course3_int'];?></td>
                                                    <td colspan="2"><?php echo $key['course3_ext'];?></td>
                                                    <td colspan="2"><?php echo $key['course3_tot'];?></td>
                                                    <td colspan="2"><?php echo $key['course4_int'];?></td>
                                                    <td colspan="2"><?php echo $key['course4_ext'];?></td>
                                                    <td colspan="2"><?php echo $key['course4_tot'];?></td>
                                                    <td colspan="2"><?php echo $key['course5_int'];?></td>
                                                    <td colspan="2"><?php echo $key['course5_ext'];?></td>
                                                    <td colspan="2"><?php echo $key['course5_tot'];?></td>
                                                    <td colspan="2"><?php echo $key['course6_int'];?></td>
                                                    <td colspan="2"><?php echo $key['course6_ext'];?></td>
                                                    <td colspan="2"><?php echo $key['course6_tot'];?></td>
                                                    <td colspan="2"><?php echo $key['course7_int'];?></td>
                                                    <td colspan="2"><?php echo $key['course7_tot'];?></td>
                                                    <td colspan="2"><?php echo $key['grand_total'];?></td>
                                                    <td><?php echo $key['division'];?></td>
                                                    <td><?php echo $key['remarks'];?></td>
                                                   
                                                </tr>
                                                <?php $i++; } 
                                                /*if($i==5) break;*/
                                                ?>
                                            </tbody>
                                        </table>
                                        <?php } elseif ($row[0]['year']=='gnm_year_3'){?>

 									<table id="view_table" class="table table-striped table-bordered" style="width: 100%">
                                            <thead class="text-primary">
                                            	<tr>
	                                                <th style="width: 30px;" rowspan="4">Sl.no.</th>
	                                                <th rowspan="4">School Code</th>
	                                                <th rowspan="4">Roll No.</th>
	                                                <th rowspan="4">Name</th>
	                                                <th rowspan="4">Father's Name</th>
	                                                <th rowspan="4">Date of Birth</th>
	                                                <th colspan="24">Subjects</th>
	                                                <th rowspan="3" colspan="2">Grand Total</th>
	                                                <th rowspan="4">Division</th>
	                                                <th rowspan="4">Remarks</th>
	                                            </tr>
	                                            <tr>
	                                            	<th colspan="6">Midwifery &<br> Gynaecology <br> (Written)
	                                            	</th>
	                                            	<th colspan="6">Community Health<br> Nursing - II <br>(Written)
	                                            	</th>
	                                            	<th colspan="6">Practical – I <br> Midwifery
	                                            	</th>
	                                            	<th colspan="6">Practical II <br> Community Health <br> Nursing - II
	                                            	</th>
	                                            </tr>
	                                            <tr>
	                                            	<th colspan="2">Internal</th>
	                                            	<th colspan="2">External</th>
	                                            	<th colspan="2">Total</th>

	                                            	<th colspan="2">Internal</th>
	                                            	<th colspan="2">External</th>
	                                            	<th colspan="2">Total</th>

	                                            	<th colspan="2">Internal</th>
	                                            	<th colspan="2">External</th>
	                                            	<th colspan="2">Total</th>

	                                            	<th colspan="2">Internal</th>
	                                            	<th colspan="2">External</th>
	                                            	<th colspan="2">Total</th>
	                                            </tr>
	                                            <tr>
	                                            	<th>F.M.- 25</th>
	                                            	<th>P.M.-13</th>     	
	                                            	<th>F.M.-75</th>     	
	                                            	<th>P.M.-38</th>     	
	                                            	<th>F.M.-100</th>     	
	                                            	<th>P.M.-50</th> 
	                                            	
	                                            	<th>F.M.- 25</th> 
	                                            	<th>P.M.-13</th> 
	                                            	<th>F.M.-75</th> 
	                                            	<th>P.M.-38</th> 
	                                            	<th>F.M.-100</th> 
	                                            	<th>P.M.-50</th> 
	                                            	
	                                            	<th>F.M.-50</th> 
	                                            	<th>P.M.-25</th> 
	                                            	<th>F.M.-50</th> 
	                                            	<th>P.M.-25</th> 
	                                            	<th>F.M.-100</th> 
	                                            	<th>P.M.-50</th> 

	                                            	<th>F.M.-50</th> 
	                                            	<th>P.M.-25</th> 
	                                            	<th>F.M.-50</th> 
	                                            	<th>P.M.-25</th> 
	                                            	<th>F.M.-100</th> 
	                                            	<th>P.M.-50</th>
	                                            
	                                            	<th>F.M.-600</th>
	                                            	<th>P.M.-300</th>

	                                            </tr>
                                            </thead>
                                            <tbody class="text-primary">
                                               <?php $i=1; ?>
                                               <?php foreach ($row as $key ) { ?>
                                                <tr>
                                                    <td><?php echo $i;?></td>
                                                    <td><?php echo $key['school_code'];?></td>
                                                    <td><?php echo $key['roll_no'];?></td>
                                                    <td><?php echo $key['name'];?></td>
                                                    <td><?php echo $key['father_name'];?></td>
                                                    <td><?php echo $key['dob'];?></td>
                                                    <td colspan="2"><?php echo $key['course1_int'];?></td>
                                                    <td colspan="2"><?php echo $key['course1_ext'];?></td>
                                                    <td colspan="2"><?php echo $key['course1_tot'];?></td>
                                                    <td colspan="2"><?php echo $key['course2_int'];?></td>
                                                    <td colspan="2"><?php echo $key['course2_ext'];?></td>
                                                    <td colspan="2"><?php echo $key['course2_tot'];?></td>
                                                    <td colspan="2"><?php echo $key['course3_int'];?></td>
                                                    <td colspan="2"><?php echo $key['course3_ext'];?></td>
                                                    <td colspan="2"><?php echo $key['course3_tot'];?></td>
                                                    <td colspan="2"><?php echo $key['course4_int'];?></td>
                                                    <td colspan="2"><?php echo $key['course4_ext'];?></td>
                                                    <td colspan="2"><?php echo $key['course4_tot'];?></td>
                                                    <td colspan="2"><?php echo $key['grand_total'];?></td>
                                                    <td><?php echo $key['division'];?></td>
                                                    <td><?php echo $key['remarks'];?></td>
                                                   
                                                </tr>
                                                <?php $i++; } 
                                                /*if($i==5) break;*/
                                                ?>
                                            </tbody>
                                        </table>
                                        <?php }elseif ($row[0]['year']=='anm_year_1'){?>

 									<table id="view_table" class="table table-striped table-bordered" style="width: 100%">
                                            <thead class="text-primary">
                                            	<tr>
	                                                <th style="width: 30px;" rowspan="4">Sl.no.</th>
	                                                <th rowspan="4">School Code</th>
	                                                <th rowspan="4">Roll No.</th>
	                                                <th rowspan="4">Name</th>
	                                                <th rowspan="4">Father's Name</th>
	                                                <th rowspan="4">Date of Birth</th>
	                                                <th colspan="36">Subjects</th>
	                                                <th rowspan="3" colspan="2">Grand Total</th>
	                                                <th rowspan="4">Division</th>
	                                                <th rowspan="4">Remarks</th>
	                                            </tr>
	                                            <tr>
	                                            	<th colspan="6">Community Health<br> Nursing <br>(Written)
	                                            	</th>
	                                            	<th colspan="6">Health Promotion <br>(Written)
	                                            	</th>
	                                            	<th colspan="6">Primary Health Care <br>(Prevention of diseases <br>restoration of health)<br> (Written)
	                                            	</th>
	                                            	<th colspan="6">Child Health <br>Nursing (Written)
	                                            	</th>
	                                            	<th colspan="6">Practical - I
	                                            	</th>
	                                            	<th colspan="6">Practical - II
	                                            	</th>
	                                            </tr>
	                                            <tr>
	                                            	<th colspan="2">Internal</th>
	                                            	<th colspan="2">External</th>
	                                            	<th colspan="2">Total</th>

	                                            	<th colspan="2">Internal</th>
	                                            	<th colspan="2">External</th>
	                                            	<th colspan="2">Total</th>

	                                            	<th colspan="2">Internal</th>
	                                            	<th colspan="2">External</th>
	                                            	<th colspan="2">Total</th>
	                                            	
	                                            	<th colspan="2">Internal</th>
	                                            	<th colspan="2">External</th>
	                                            	<th colspan="2">Total</th>
	                                            	
	                                            	<th colspan="2">Internal</th>
	                                            	<th colspan="2">External</th>
	                                            	<th colspan="2">Total</th>
	                                            	
	                                            	<th colspan="2">Internal</th>
	                                            	<th colspan="2">External</th>
	                                            	<th colspan="2">Total</th>

	                                            </tr>
	                                            <tr>
	                                            	<th>F.M.- 25</th>
	                                            	<th>P.M.-13</th>     	
	                                            	<th>F.M.-75</th>     	
	                                            	<th>P.M.-38</th>     	
	                                            	<th>F.M.-100</th>     	
	                                            	<th>P.M.-50</th> 
	                                            	
	                                            	<th>F.M.- 25</th> 
	                                            	<th>P.M.-13</th> 
	                                            	<th>F.M.-75</th> 
	                                            	<th>P.M.-38</th> 
	                                            	<th>F.M.-100</th> 
	                                            	<th>P.M.-50</th> 
	                                            	
	                                            	<th>F.M.- 25</th> 
	                                            	<th>P.M.-13</th> 
	                                            	<th>F.M.-75</th> 
	                                            	<th>P.M.-38</th> 
	                                            	<th>F.M.-100</th> 
	                                            	<th>P.M.-50</th> 
	                                            	
	                                            	<th>F.M.-50</th> 
	                                            	<th>P.M.-25</th> 
	                                            	<th>F.M.-50</th> 
	                                            	<th>P.M.-25</th> 
	                                            	<th>F.M.-100</th> 
	                                            	<th>P.M.-50</th> 

	                                            	<th>F.M.-100</th> 
	                                            	<th>P.M.-50</th> 
	                                            	<th>F.M.-100</th> 
	                                            	<th>P.M.-50</th> 
	                                            	<th>F.M.-200</th> 
	                                            	<th>P.M.-100</th> 

	                                            	<th>F.M.-100</th> 
	                                            	<th>P.M.-50</th> 
	                                            	<th>F.M.-100</th> 
	                                            	<th>P.M.-50</th> 
	                                            	<th>F.M.-200</th> 
	                                            	<th>P.M.-100</th>
	                                            
	                                            	<th>F.M.-800</th>
	                                            	<th>P.M.-400</th>

	                                            </tr>
                                            </thead>
                                            <tbody class="text-primary">
                                               <?php $i=1; ?>
                                               <?php foreach ($row as $key ) { ?>
                                                <tr>
                                                    <td><?php echo $i;?></td>
                                                    <td><?php echo $key['school_code'];?></td>
                                                    <td><?php echo $key['roll_no'];?></td>
                                                    <td><?php echo $key['name'];?></td>
                                                    <td><?php echo $key['father_name'];?></td>
                                                    <td><?php echo $key['dob'];?></td>
                                                    <td colspan="2"><?php echo $key['course1_int'];?></td>
                                                    <td colspan="2"><?php echo $key['course1_ext'];?></td>
                                                    <td colspan="2"><?php echo $key['course1_tot'];?></td>
                                                    <td colspan="2"><?php echo $key['course2_int'];?></td>
                                                    <td colspan="2"><?php echo $key['course2_ext'];?></td>
                                                    <td colspan="2"><?php echo $key['course2_tot'];?></td>
                                                    <td colspan="2"><?php echo $key['course3_int'];?></td>
                                                    <td colspan="2"><?php echo $key['course3_ext'];?></td>
                                                    <td colspan="2"><?php echo $key['course3_tot'];?></td>
                                                    <td colspan="2"><?php echo $key['course4_int'];?></td>
                                                    <td colspan="2"><?php echo $key['course4_ext'];?></td>
                                                    <td colspan="2"><?php echo $key['course4_tot'];?></td>
                                                    <td colspan="2"><?php echo $key['course5_int'];?></td>
                                                    <td colspan="2"><?php echo $key['course5_ext'];?></td>
                                                    <td colspan="2"><?php echo $key['course5_tot'];?></td>
                                                    <td colspan="2"><?php echo $key['course6_int'];?></td>
                                                    <td colspan="2"><?php echo $key['course6_ext'];?></td>
                                                    <td colspan="2"><?php echo $key['course6_tot'];?></td>
                                                    
                                                    <td colspan="2"><?php echo $key['grand_total'];?></td>
                                                    <td><?php echo $key['division'];?></td>
                                                    <td><?php echo $key['remarks'];?></td>
                                                   
                                                </tr>
                                                <?php $i++; } 
                                                /*if($i==5) break;*/
                                                ?>
                                            </tbody>
                                        </table>
                                        <?php } elseif ($row[0]['year']=='anm_year_2'){?>

 									<table id="view_table" class="table table-striped table-bordered" style="width: 100%">
                                            <thead class="text-primary">
                                            	<tr>
	                                                <th style="width: 30px;" rowspan="4">Sl.no.</th>
	                                                <th rowspan="4">School Code</th>
	                                                <th rowspan="4">Roll No.</th>
	                                                <th rowspan="4">Name</th>
	                                                <th rowspan="4">Father's Name</th>
	                                                <th rowspan="4">Date of Birth</th>
	                                                <th colspan="24">Subjects</th>
	                                                <th rowspan="3" colspan="2">Grand Total</th>
	                                                <th rowspan="4">Division</th>
	                                                <th rowspan="4">Remarks</th>
	                                            </tr>
	                                            <tr>
	                                            	<th colspan="6">Midwifery <br>(Written)
	                                            	</th>
	                                            	<th colspan="6">Health Centre <br>Management <br>(Written)

	                                            	</th>
	                                            	<th colspan="6">Practical - I <br>(Midwifery)
	                                            	</th>
	                                            	<th colspan="6">Practical - II (PHC Ng. & Health <br> Centre Management)
	                                            	</th>
	                                            </tr>
	                                            <tr>
	                                            	<th colspan="2">Internal</th>
	                                            	<th colspan="2">External</th>
	                                            	<th colspan="2">Total</th>

	                                            	<th colspan="2">Internal</th>
	                                            	<th colspan="2">External</th>
	                                            	<th colspan="2">Total</th>

	                                            	<th colspan="2">Internal</th>
	                                            	<th colspan="2">External</th>
	                                            	<th colspan="2">Total</th>
	                                            	
	                                            	<th colspan="2">Internal</th>
	                                            	<th colspan="2">External</th>
	                                            	<th colspan="2">Total</th>

	                                            </tr>
	                                            <tr>
	                                            	<th>F.M.- 25</th>
	                                            	<th>P.M.-13</th>     	
	                                            	<th>F.M.-75</th>     	
	                                            	<th>P.M.-38</th>     	
	                                            	<th>F.M.-100</th>     	
	                                            	<th>P.M.-50</th> 
	                                            	
	                                            	<th>F.M.- 25</th> 
	                                            	<th>P.M.-13</th> 
	                                            	<th>F.M.-75</th> 
	                                            	<th>P.M.-38</th> 
	                                            	<th>F.M.-100</th> 
	                                            	<th>P.M.-50</th> 
	                                           
	                                            	<th>F.M.-100</th> 
	                                            	<th>P.M.-50</th> 
	                                            	<th>F.M.-100</th> 
	                                            	<th>P.M.-50</th> 
	                                            	<th>F.M.-200</th> 
	                                            	<th>P.M.-100</th> 

	                                            	<th>F.M.-100</th> 
	                                            	<th>P.M.-50</th> 
	                                            	<th>F.M.-100</th> 
	                                            	<th>P.M.-50</th> 
	                                            	<th>F.M.-200</th> 
	                                            	<th>P.M.-100</th>
	                                            
	                                            	<th>F.M.-600</th>
	                                            	<th>P.M.-300</th>

	                                            </tr>
                                            </thead>
                                            <tbody class="text-primary">
                                               <?php $i=1; ?>
                                               <?php foreach ($row as $key ) { ?>
                                                <tr>
                                                    <td><?php echo $i;?></td>
                                                    <td><?php echo $key['school_code'];?></td>
                                                    <td><?php echo $key['roll_no'];?></td>
                                                    <td><?php echo $key['name'];?></td>
                                                    <td><?php echo $key['father_name'];?></td>
                                                    <td><?php echo $key['dob'];?></td>
                                                    <td colspan="2"><?php echo $key['course1_int'];?></td>
                                                    <td colspan="2"><?php echo $key['course1_ext'];?></td>
                                                    <td colspan="2"><?php echo $key['course1_tot'];?></td>
                                                    <td colspan="2"><?php echo $key['course2_int'];?></td>
                                                    <td colspan="2"><?php echo $key['course2_ext'];?></td>
                                                    <td colspan="2"><?php echo $key['course2_tot'];?></td>
                                                    <td colspan="2"><?php echo $key['course3_int'];?></td>
                                                    <td colspan="2"><?php echo $key['course3_ext'];?></td>
                                                    <td colspan="2"><?php echo $key['course3_tot'];?></td>
                                                    <td colspan="2"><?php echo $key['course4_int'];?></td>
                                                    <td colspan="2"><?php echo $key['course4_ext'];?></td>
                                                    <td colspan="2"><?php echo $key['course4_tot'];?></td>
                                                    
                                                    <td colspan="2"><?php echo $key['grand_total'];?></td>
                                                    <td><?php echo $key['division'];?></td>
                                                    <td><?php echo $key['remarks'];?></td>
                                                   
                                                </tr>
                                                <?php $i++; } 
                                                /*if($i==5) break;*/
                                                ?>
                                            </tbody>
                                        </table>
                                        <?php } ?>
                                    </div>
                                    </div>