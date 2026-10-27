<div class="page-content">
	<!-- inner page banner -->
	<div class="dez-bnr-inr overlay-black-middle" style="background-image:url(<?php echo base_url();?>assets/images/nursebanner.jpg);">
		<div class="container">
			<div class="dez-bnr-inr-entry">
				<h1 class="text-white">Nursing Institutions & School List</h1>
			</div>
		</div>
	</div>
	<!-- inner page banner END -->
	<!-- Breadcrumb row -->
	<div class="breadcrumb-row">
		<div class="container">
			<ul class="list-inline">
				<li><a href="<?php echo base_url('');?>">Home</a></li>
				<li>Nursing Institutions & School List</li>
			</ul>
		</div>
	</div>
	<!-- Breadcrumb row END -->
	<div class="content-area">
		<div class="container">
			<div class="row text-center">
				<div class="col-lg-2 col-md-6 col-sm-6 col-6">
					<div class="counter-style-1 m-b30">
						<div class="text-primary">
							<span class="counter"><?php echo $anm + $gnm + $bsc + $pbsc + $ms; ?></span>
						</div>
						<span class="counter-text">Total School</span>
					</div>
				</div>
				<div class="col-lg-2 col-md-6 col-sm-6 col-6">
					<div class="counter-style-1 m-b30">
						<div class="text-primary">
							<span class="counter"><?php echo $anm; ?></span>
						</div>
						<span class="counter-text">ANM School</span>
					</div>
				</div>
				<div class="col-lg-2 col-md-6 col-sm-6 col-6">
					<div class="counter-style-1 m-b30">
						<div class="text-primary">
							<span class="counter"><?php echo $gnm; ?></span>
						</div>
						<span class="counter-text">GNM School</span>
					</div>
				</div>
				<div class="col-lg-2 col-md-6 col-sm-6 col-6">
					<div class="counter-style-1 m-b30">
						<div class="text-primary">
							<span class="counter"><?php echo $bsc; ?></span>
						</div>
						<span class="counter-text">BSC School</span>
					</div>
				</div>
				<div class="col-lg-2 col-md-6 col-sm-6 col-6">
					<div class="counter-style-1 m-b30">
						<div class="text-primary">
							<span class="counter"><?php echo $pbsc; ?></span>
						</div>
						<span class="counter-text">PBSC School</span>
					</div>
				</div>
				<div class="col-lg-2 col-md-6 col-sm-6 col-6">
					<div class="counter-style-1 m-b30">
						<div class="text-primary">
							<span class="counter"><?php echo $ms; ?></span>
						</div>
						<span class="counter-text">MSC School</span>
					</div>
				</div>
			</div>
		</div>
       
		<div class="container">
			<div class="row">
				<!-- Left part start -->
				<div class="col-md-12">
					<!-- blog start -->
					<div class="blog-post blog-single">					   
						<div class="dez-post-text">		
						
							<div class="table-responsive">
								<h4 class="widget-title">ANM School List</h4> 
								<table class="table table-striped table-bordered">
									<thead>								
										<tr>
											<th>S. No.</th>
											<th style="width:30%">School Name</th>
											<th style="width:30%">Address</th>
											<th>School Code</th>
											<th>Course</th>
											<th>Seat</th>
											<th>Certification</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$i=1; 
										foreach($anm_new as $anm_new)
										{
											if($anm_new['renewal_status']=='Active')
											{
												$status='<span class="label label-primary">Active</span>';
											}
											else
											{
												$status='<span class="label label-danger">Expired</span>';
											}
											?>
											<tr>
												<td><?php echo $i.'.'; ?></td>
												<td><?php echo $anm_new['school_name']; ?></td>
												<td><?php echo $anm_new['address']; ?></td>
												<td><?php echo $anm_new['school_code']; ?></td>
												<td><?php echo $anm_new['course_type']; ?></td>
												<td><?php echo $anm_new['seat']; ?></td>
												<td><?php echo $status; ?></td>
											</tr>
											<?php 
											$i++; 
										} 
										?>
									</tbody>
								</table>
							</div>


							<div class="table-responsive">
								<h4 class="widget-title">GNM School List</h4>
								<table class="table table-striped table-bordered">
									<thead>									
										<tr>
											<th>S. No.</th>
											<th style="width:30%">School Name</th>
											<th style="width:30%">Address</th>
											<th>School Code</th>
											<th>Course</th>
											<th>Seat</th>
											<th>Certification</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$i=1; 
										foreach($gnm_new as $gnm_new)
										{
											if($gnm_new['renewal_status']=='Active')
											{
												$status='<span class="label label-primary">Active</span>';
											}
											else
											{
												$status='<span class="label label-danger">Expired</span>';
											}
											?>
											<tr>
												<td><?php echo $i.'.'; ?></td>
												<td><?php echo $gnm_new['school_name']; ?></td>
												<td><?php echo $gnm_new['address']; ?></td>
												<td><?php echo $gnm_new['school_code']; ?></td>
												<td><?php echo $gnm_new['course_type']; ?></td>
												<td><?php echo $gnm_new['seat']; ?></td>
												<td><?php echo $status; ?></td>
											</tr>
											<?php 
											$i++; 
										} 
										?>
									</tbody>
								</table>
							</div>

  

							<div class="table-responsive">  
								<h4 class="widget-title">Basic B.SC School List</h4>
								<table class="table table-striped table-bordered">
									<thead>								
										<tr>
											<th>S. No.</th>
											<th style="width:30%">School Name</th>
											<th style="width:30%">Address</th>
											<th>School Code</th>
											<th>Course</th>
											<th>Seat</th>
											<th>Certification</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$i=1; 
										foreach($basic_bsc as $basic_bsc)
										{
											if($basic_bsc['renewal_status']=='Active')
											{
												$status='<span class="label label-primary">Active</span>';
											}
											else
											{
												$status='<span class="label label-danger">Expired</span>';
											}
											?>
											<tr>
												<td><?php echo $i.'.'; ?></td>
												<td><?php echo $basic_bsc['school_name']; ?></td>
												<td><?php echo $basic_bsc['address']; ?></td>
												<td><?php echo $basic_bsc['school_code']; ?></td>
												<td><?php echo $basic_bsc['course_type']; ?></td>
												<td><?php echo $basic_bsc['seat']; ?></td>
												<td><?php echo $status; ?></td>
											</tr>
											<?php 
											$i++; 
										} 
										?>
									</tbody>
								</table>
							</div>


							<div class="table-responsive"> 
								<h4 class="widget-title">Post Basic B.SC School List</h4>
								<table class="table table-striped table-bordered">
									<thead>								
										<tr>
											<th>S. No.</th>
											<th style="width:30%">School Name</th>
											<th style="width:30%">Address</th>
											<th>School Code</th>
											<th>Course</th>
											<th>Seat</th>
											<th>Certification</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$i=1; 
										foreach($post_basic_bsc as $post_basic_bsc)
										{
											if($post_basic_bsc['renewal_status']=='Active')
											{
												$status='<span class="label label-primary">Active</span>';
											}
											else
											{
												$status='<span class="label label-danger">Expired</span>';
											}
											?>
											<tr>
												<td><?php echo $i.'.'; ?></td>
												<td><?php echo $post_basic_bsc['school_name']; ?></td>
												<td><?php echo $post_basic_bsc['address']; ?></td>
												<td><?php echo $post_basic_bsc['school_code']; ?></td>
												<td><?php echo $post_basic_bsc['course_type']; ?></td>
												<td><?php echo $post_basic_bsc['seat']; ?></td>
												<td><?php echo $status; ?></td>
											</tr>
											<?php 
											$i++; 
										} 
										?>
									</tbody>
								</table>
							</div>
							
							
							<div class="table-responsive"> 
								<h4 class="widget-title">M.SC School List</h4>
								<table class="table table-striped table-bordered">
									<thead>								
										<tr>
											<th>S. No.</th>
											<th style="width:30%">School Name</th>
											<th style="width:30%">Address</th>
											<th>School Code</th>
											<th>Course</th>
											<th>Seat</th>
											<th>Certification</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$i=1; foreach($msc as $msc)
										{
											if($msc['renewal_status']=='Active')
											{
												$status='<span class="label label-primary">Active</span>';
											}
											else
											{
												$status='<span class="label label-danger">Expired</span>';
											}
											?>
											<tr>
												<td><?php echo $i.'.'; ?></td>
												<td><?php echo $msc['school_name']; ?></td>
												<td><?php echo $msc['address']; ?></td>
												<td><?php echo $msc['school_code']; ?></td>
												<td><?php echo $msc['course_type']; ?></td>
												<td><?php echo $msc['seat']; ?></td>
												<td><?php echo $status; ?></td>
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
</div>
