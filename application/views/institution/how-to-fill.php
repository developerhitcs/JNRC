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
		<div class="row">
			<div class="col-md-12">  
				<div class="card">
					<div class="card-header-info">
						<span>How To Fill Examination Form Details</span>		
					</div>	
					<div class="card-body">						
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Instructions</th>
									<th>Read/ View</th>
								</tr>
							</thead>
							<tbody>							
								<tr>
									<td>1. How to Entry Form</td>
									<td><a href="<?php echo base_url('uploads/gallery/fill.png');?>" style="font-weight: bold; color:green; " target="_blank">View</a></td>
								</tr>
								<tr>
									<td>2. You will see preview page</td>
									<td><a href="#" style="font-weight: bold; color:green; " target="_blank">View</a></td>
								</tr>
								<tr>
									<td>3. How to Edit Form</td>
									<td><a href="<?php echo base_url('uploads/gallery/fill.png');?>" style="font-weight: bold; color:green; " target="_blank">View</a></td>
								</tr>
								<tr>
									<td>4. You will get final form filling completion message and Reference no.</td>
									<td><a href="#" style="font-weight: bold; color:green; " target="_blank">View</a></td>
								</tr>
								<tr>
									<td>5. How to do Payment ?  </td>
									<td><a href="#" style="font-weight: bold; color:green; " target="_blank">View</a></td>
								</tr>
								<tr>
									<td>6. You will get confirmation page like this</td>
									<td><a href="#" style="font-weight: bold; color:green; " target="_blank">View</a></td>
								</tr>
								<tr>
									<td><b>1. Please fill 'reference no.' of student in 'registration no. field in payment page'. <br>2. Do not use comma or any special character in Institution Name field <br>3. Pay fees amount according to your course. </b></td>
									<td></td>
								</tr>

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 search_result">  
				
			</div>
		</div>
	</div>
</div>
