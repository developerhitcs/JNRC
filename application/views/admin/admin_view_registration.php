
<div class="content">
	<div class="container-fluid">		
		<div class="card">
			<div class="card-header-success">
				<span>Student Registration Lists</span>				   
			</div>				
			<div class="card-body">	
				<div class="toolbar">
					<form action="<?php echo base_url('#');?>" method='post'>  
						<div class="row">
							<div class="col-sm-5">
								<select name="course_type" class="form-control" onchange="">
								  <option value="show_all">Show All</option>
								  <option value="anm_year_1">ANM 1st Year</option>
								  <option value="anm_year_2">ANM 2nd Year</option>
								  <option value="gnm_year_1">GNM 1st Year</option>
								  <option value="gnm_year_2">GNM 2nd Year</option>
								  <option value="gnm_year_3">GNM 3rd Year</option>
								</select>
							</div>
							<div class="col-sm-4">
								<input type="submit" name="submit" value="Search By Course" class="btn btn-primary">
							</div>
						</div>
					</form>
					<hr>					
				</div>
				<div class="material-datatables">
					<table id="datatables" class="table table-striped table-bordered">
						<thead>
							<th style="width: 30px;">Sl.no.</th>
							<th>Course</th>
							<th>Name</th>
							<th>Aadhar</th>
							<th>DOB</th>
							<th>Exam Medium</th>
							<th>Image</th>
							<th>Signature</th>
							<th style="width: 80px;">Action</th>
						</thead>
						<tbody>
							<?php 
							$i=1; 
							foreach ($row as $key ) 
							{
							   ?>
								<tr>
									<td><?php echo $i;?></td>
									<td><?php echo $key['course'];?></td>
									<td><?php echo $key['name'];?></td>
									<td><?php echo $key['aadhar'];?></td>
									<td><?php echo $key['dob'];?></td>
									<td><?php echo $key['medium_exam'];?></td>
									<td><img src="<?php echo base_url(); echo  $key['img1']; ?>" style=" width:150px; height: 165px;"></td>
									<td><img src="<?php echo base_url(); echo  $key['img2']; ?>" style=" width:200px; height: 75px;"></td>
									<td>
										<!-- <a title="Edit" onclick="edit_school('<?php echo $key['id'];?>','<?php echo $key['school_name'];?>','<?php echo $key['school_code'];?>','<?php echo $key['address'];?>','<?php echo $key['course_type'];?>','<?php echo $key['seat'];?>')"><i class="fa fa-pencil" style="color:green;"></i></a> |
										<a title="Delete" onclick="return confirm('Are you sure you want to delete this item?')"  href="<?php echo base_url();?>delete_school/<?php echo $key['id'];?>"><i class="fa fa-trash" style="color:red;"></i></a> | <a title="Upload Result" onclick="upload_result()" <i class="fa fa-upload" aria-hidden="true"></i></a> --> 
									</td>
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
     