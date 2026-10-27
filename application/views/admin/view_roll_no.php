<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">  
				<div class="card">
					<div class="card-header-success">
						<span>All Student Admit Card Roll Number Details</span>		
					</div>	
					<div class="card-body">	
						<div class="toolbar">							
							<!-- Add Aditional Section Contntent Here.... -->					
						</div>
						<div class="material-datatables">
							<table class="table table-striped table-bordered" style="width: 100%">
								<thead>
									<th>ANM1 #</th>
									<th>School Code</th>									
									<th>Course</th>									
									<th>Reference Number</th>								
									<th>Roll Number</th>								
									<th>Name</th>								
								</thead>
								<tbody>
									<?php 
									$i=1; 
									foreach ($anm1 as $key) 
									{ 
										$course='ANM1';	
										?>
										<tr>
											<td><?php echo $i; ?></td>
											<td><?php echo $sc=$key['issue_by'];?></td>
											<td><?php echo $course;?></td>
											<td><?php echo $ref=$key['ref_no'];?></td>
											<td><?php echo $roll=$key['issue_by'].'/'.$course.'/'.$i; ?></td>
											<td><?php echo $name=$key['name'];?></td>										
										</tr>
										<?php 
										$i++; 
									} 
									?>
								</tbody>
							
								<thead>
									<th>ANM2 #</th>
									<th>School Code</th>									
									<th>Course</th>									
									<th>Reference Number</th>								
									<th>Roll Number</th>								
									<th>Name</th>								
								</thead>
								<tbody>
									<?php 
									$i=1; 
									foreach ($anm2 as $key) 
									{ 
										$course='ANM2';	
										?>
										<tr>
											<td><?php echo $i; ?></td>
											<td><?php echo $sc=$key['issue_by'];?></td>
											<td><?php echo $course;?></td>
											<td><?php echo $ref=$key['ref_no'];?></td>
											<td><?php echo $roll=$key['issue_by'].'/'.$course.'/'.$i; ?></td>
											<td><?php echo $name=$key['name'];?></td>										
										</tr>
										<?php 
										$i++; 
									} 
									?>
								</tbody>
								<thead>
									<th>GNM1 #</th>
									<th>School Code</th>									
									<th>Course</th>									
									<th>Reference Number</th>								
									<th>Roll Number</th>								
									<th>Name</th>								
								</thead>
								<tbody>
									<?php 
									$i=1; 
									foreach ($gnm1 as $key) 
									{ 
										$course='GNM1';	
										?>
										<tr>
											<td><?php echo $i; ?></td>
											<td><?php echo $sc=$key['issue_by'];?></td>
											<td><?php echo $course;?></td>
											<td><?php echo $ref=$key['ref_no'];?></td>
											<td><?php echo $roll=$key['issue_by'].'/'.$course.'/'.$i; ?></td>
											<td><?php echo $name=$key['name'];?></td>										
										</tr>
										<?php 
										$i++; 
									} 
									?>
								</tbody>
								<thead>
									<th>GNM2 #</th>
									<th>School Code</th>									
									<th>Course</th>									
									<th>Reference Number</th>								
									<th>Roll Number</th>								
									<th>Name</th>								
								</thead>
								<tbody>
									<?php 
									$i=1; 
									foreach ($gnm2 as $key) 
									{ 
										$course='GNM2';	
										?>
										<tr>
											<td><?php echo $i; ?></td>
											<td><?php echo $sc=$key['issue_by'];?></td>
											<td><?php echo $course;?></td>
											<td><?php echo $ref=$key['ref_no'];?></td>
											<td><?php echo $roll=$key['issue_by'].'/'.$course.'/'.$i; ?></td>
											<td><?php echo $name=$key['name'];?></td>										
										</tr>
										<?php 
										$i++; 
									} 
									?>
								</tbody>
								<thead>
									<th>GNM3 #</th>
									<th>School Code</th>									
									<th>Course</th>									
									<th>Reference Number</th>								
									<th>Roll Number</th>								
									<th>Name</th>								
								</thead>
								<tbody>
									<?php 
									$i=1; 
									foreach ($gnm3 as $key) 
									{ 
										$course='GNM3';	
										?>
										<tr>
											<td><?php echo $i; ?></td>
											<td><?php echo $sc=$key['issue_by'];?></td>
											<td><?php echo $course;?></td>
											<td><?php echo $ref=$key['ref_no'];?></td>
											<td><?php echo $roll=$key['issue_by'].'/'.$course.'/'.$i; ?></td>
											<td><?php echo $name=$key['name'];?></td>										
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

