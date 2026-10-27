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
					</div>
					<?php
					unset($_SESSION['msg']);
					unset($_SESSION['errmsg']);
				}
				?>
			</div>
		</div>   
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header-info">
						<span>Upload Result</span>
					</div>
					<div class="card-body">	
						<form method="POST" action="<?php echo base_url('upload_result');?>" enctype="multipart/form-data">
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group bmd-form-group is-filled">
										<label class="bmd-label-floating">Choose Session Year </label>
										<select id="required" class="form-control " name="session_year" required=""> 
											<option value="">Select Session Year</option>
											<option value="OCTOBER-2018">October 2018</option>
										</select>
									</div>  
								</div>  
								<div class="col-sm-4">
									<div class="form-group bmd-form-group is-filled">
										<label class="bmd-label-floating">Choose School Code </label>
										<select id="required" class="form-control school_code"  name="school_code" required="" onchange="get_school_course()" required="">
											<option value="">Select School Code</option>
											<?php 
											foreach ($code as $code) 
											{ 
												?>
												<option value="<?php echo $code['school_code'];?>"><?php echo $code['school_code'];?></option>                            
												<?php 
											}
											?>
										</select> 
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group bmd-form-group is-filled">
										<label class="bmd-label-floating">Choose Course Type </label>
										<select id="course_type" class="form-control" name="course_type" required="" >
											<option value="">Select Course Type</option>           
										</select> 
									</div>
								</div>							
								<div class="col-sm-12">
									<label class="bmd-label-floating">Choose Excel (Only .csv format) File</label>								
									<input type="file" class="form-control" name="file" accept=".csv" required="" >
								</div>
								<div class="col-sm-2 mt-2">
									<input type="submit" name="submit" value="Upload Result" class="btn btn-success btn-block">
								</div>
							</div>
						</form>	
					</div>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header-success" >
						<span>Search Result</span>
					</div>			
					<div class="card-body">
						<div class="toolbar">				
							<form action="<?php echo base_url('admin_search_result');?>" method='post' target="_blank">  
								<div class="row">
									<div class="col-sm-3">
										<select id="required" class="form-control " name="session_year" required=""> 
											<option value="">Select Session Year</option>
											<option value="OCTOBER-2018">October 2018</option>
										</select>
									</div>  
									<div class="col-sm-3">
										<select id="required" class="form-control school_code"  name="school_code" required="" onchange="get_school_course()" required="">
											<option value="">Select School Code</option>
											<?php 
											foreach ($code as $code) 
											{ 
												?>
												<option value="<?php echo $code['school_code'];?>"><?php echo $code['school_code'];?></option>                            
												<?php 
											}
											?>
										</select> 
									</div>
									<div class="col-sm-3">
										<select id="course_type" class="form-control" name="course_type" required="" >
											<option value="">Select Course Type</option>           
										</select> 
									</div>
									<div class="col-sm-3">
										<input type="submit" name="submit" value="Search Result" class="btn btn-info">
									</div>
								</div>
							</form>
						</div><hr>
						<div class="material-datatables">							
							<table id="datatables" class="table table-responsive table-striped table-bordered">
								<thead>
									<tr>
										<th rowspan="4">Sl.no.</th>
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
										<th colspan="6">Bio- Science (Anatomy + Physio, Micro) (Written)</th>
										<th colspan="6">Behavioral Science(Psychology, Sociology)(Written)</th>
										<th colspan="6">Fundamental of Nursing – I(Written) </th>
										<th colspan="6">Community Health  Nursing – I (Written)</th>
										<th colspan="6">Practical - I</th>
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
								<tbody>
									<?php $i=1;
									foreach ($row as $key ) 
									{ 
										?>
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
										<?php 
										$i++; 
									} 
									?>
								</tbody>
							</table>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">    
function get_school_course() 
{
	var school_code = $('.school_code').val();
	//alert(school_code);
	$.ajax(
	{
		url:"<?php echo base_url('fetch_course');?>",
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











