<style>
#EditModal,#ResultModal{
margin-top: -65px; important!
}

</style>
<div class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header" data-background-color="purple">
                            <h4 class="title">Result</h4>
                           
                        </div>
                        
                        <div class="card-content">
                          <div class="row">
                                <form action="<?php echo base_url();?>admin_view_result" method='post'>  
                                <div class="col-sm-2">
                                    <select id="required" class="form-control form-control-chosen-required" data-placeholder="Select Course" name="session_year" required=""> 
                                      <option value="show_all">Select Session Year</option>
                                      <option value="OCTOBER-2018" selected="">October 2018</option>
                                    </select>
                                </div>  
                                <div class="col-sm-2">
                                <select id="required" class="form-control form-control-chosen-required school_code" data-placeholder="School Code" name="school_code" required="" onchange="get_school_course()">
                                  <option></option>
                                  <?php foreach ($code as $code) { ?>
                                       <option value="<?php echo $code['school_code'];?>"><?php echo $code['school_code'];?></option>                            
                                    <?php }
                                  ?>
                                </select> 
                                </div>
                                <div class="col-sm-2">
                                     <!-- <select id="course_abc" class="form-control form-control-chosen-required course_abc" data-placeholder="Select Course" name="course_type" required=""> -->  
                                      <select id="course_type" class="form-control" name="course_type" >
                                      <option></option>           
                                      <!-- <option value="">Show All</option>
                                      <option value="anm_year_1">ANM 1st Year</option>
                                      <option value="anm_year_2">ANM 2nd Year</option>
                                      <option value="gnm_year_1">GNM 1st Year</option>
                                      <option value="gnm_year_2">GNM 2nd Year</option>
                                      <option value="gnm_year_3">GNM 3rd Year</option> -->
                                    </select> 
                                </div>  
                                
                                <div class="col-sm-1">
                                    <input type="submit" name="submit" value="Search By Course" class="btn btn-primary">
                                </div>

                                </form>
                            </div>
                             <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <!-- <div class="card-header" data-background-color="purple">
                                        <h4 class="title">Simple Table</h4>
                                        <p class="category">Here is a subtitle for this table</p>
                                    </div> -->
                                    <div class="card-content table-responsive">
                                        <!-- <table class="table" id="view_table"> -->
                                            
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit modal -->
            <!-- modal --> 
            <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Edit School</h5>
                  <!-- <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                    X
                  </button> -->
                </div>
                <div class="modal-body">
                  <form action="<?php echo base_url();?>edit_school" method="post" id="save_form">
                    <div class="row" style=" margin-top: -27px;">
                     
                    
                      <input type="hidden" name="edit_id" id="edit_id">
                    
                    <div class="form-group col-sm-12">
                      <label>School Name: </label>
                      <input type="text" name="edit_school_name" id="edit_school_name" class="form-control" required="" autocomplete="off">
                    </div>
                    <div class="col-sm-4">
                        <input type="text" name="edit_school_code" id="edit_school_code" class="form-control" placeholder="School Code" autocomplete="off">
                    </div>
                    <div class="form-group col-sm-12">
                      <label>Address: </label>
                      <input type="text" name="edit_address" id="edit_address" class="form-control" required="" autocomplete="off">
                    </div>
                    <div class="form-group col-sm-12">
                      <label>Course Type: </label>
                      <select class="form-control" name='edit_course_type' id='edit_course_type' required="">
                                        <option value=''>Choose School Type</option>
                                        <option value='ANM_new'>ANM (new)</option>
                                        <option value='ANM_renew'>ANM (renewal)</option>
                                        <option value='GNM_new'>GNM (new)</option>
                                        <option value='GNM_renew'>GNM (renewal)</option>
                                        <option value='basic_bsc'>Basic B.SC(n)</option>
                                        <option value='post_basic_bsc'>Post Basic B.SC(n)</option>
                                        <option value='msc'>M.Sc(n)</option>
                                        <option value='anm_school_enhance'>ANM School Enhancement</option>
                                        <option value='gnm_school_enhance'>GNM School Enhancement</option>
                      </select>
                    </div>
                    <div class="form-group col-sm-12">
                      <label>Seat: </label>
                      <input type="text" name="edit_seat" id="edit_seat" class="form-control" required="" autocomplete="off">
                    </div>
                    
                    </div>
                  
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Update changes</button>
                </div>
                </form>
              </div>
            </div>
          </div>

          <!-- Result modal -->
            <!-- modal --> 
            <div class="modal fade" id="ResultModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Upload Result</h5>
                  <!-- <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                    X
                  </button> -->
                </div>
                <div class="modal-body">
                  
                  
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Update changes</button>
                </div>
               
              </div>
            </div>
          </div>

<?php 
         echo $this->session->flashdata('email_sent'); 
       
      ?>
            <!-- modal ending -->
            <!-- Email modal -->
            <!-- modal --> 
            <div class="modal fade" id="EmailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Email Notification</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="<?php echo base_url();?>email" method="post" id="save_form">
                    <div class="row">
                      <input type="hidden" name="edit_id" id="edit_id">
                    
                    <div class="form-group col-sm-12">
                      <label>Email ID: </label>
                      <input type="text" name="email_id" id="email_id" class="form-control" required="" autocomplete="off">
                    </div>
                    <div class="form-group col-sm-12">
                      <label>Subject: </label>
                      <input type="text" name="subject" id="subject" class="form-control" required="" autocomplete="off">
                    </div>
                    <div class="form-group col-sm-12">
                      <label>Notification Message: </label>
                      <input type="text" name="message" id="message" class="form-control" required="" autocomplete="off">
                    </div>
                    
                    </div>
                  
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Send Email</button>
                </div>
                </form>
              </div>
            </div>
          </div>


            <!-- modal ending -->
            <script type="text/javascript">    
    function chang(id)    
    {        
        if($('#cl_'+id).prop('checked'))        
            {                       
                var value='1';          
                var txt;            
                if (confirm("Are you sure u want to change status?")) {              
                    $.ajax({                
                        url:"<?php echo site_url('notif_status')?>",                
                        method:"POST",                
                        data:{status:value,id:id},                
                        success:function(data)                
                        {                    
                            console.log(data);                
                        },            
                    });         
                } else {            }                   
            }        
            else        
                {             
            $.ajax({                
                url:"<?php echo site_url('notif_status_off')?>",                
                method:"POST",                
                data:{id:id},                
                success:function(data)                
                    {                    
                        console.log(data);                
                    },            
                });        
            }    
        }
        function edit_school(d,e,f,g,h,i){
           $("#EditModal").modal('show');
           $("#edit_id").val(d);
           $("#edit_school_name").val(e);
           $("#edit_school_code").val(f);
           $("#edit_address").val(g);
           $("#edit_course_type").val(h);
           $("#edit_seat").val(i);
           //$("#edit_block").val(f);
          }
          function send_email(d,e){
            $("#EmailModal").modal('show');
           $("#edit_id").val(d);
           $("#message").val(e);
          }
          function upload_result(){
            $("#ResultModal").modal('show');
           
          }
          function get_school_course() {
              var school_code = $('.school_code').val();
              //alert(school_code);
             $.ajax({
                url:"<?php echo base_url();?>fetch_course",
                method:"POST",
                data:{school_code:school_code},
                dataType:"text",
                success:function(data)
                {
                  console.log(data);
                  $('#course_type').html(data); 
                 $("#course_type").prop('selectedIndex', 1);
                } 
             });
            }
</script>
           