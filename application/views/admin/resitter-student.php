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
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header-warning">
						<span><?php echo $title; ?></span>
					</div>
					<div class="card-body">			
						<div class="toolbar mt-2">							
						</div>
						<div class="material-datatables">
							<table id="datatables" class="table table-responsive table-bordered">
								<thead>
									<th>#</th>
									<th>Course</th>
									<th>Issue By</th>
									<th>Ref No.</th>
									<th>Name</th>
									<th>Aadhar</th>
									<th>DOB</th>
									<th>Report</th>
									<th>Image</th>
									<th>Action</th>
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
											<td><?php echo $key['issue_by'];?></td>
											<td><?php echo $key['ref_no'];?></td>
											<td><?php echo $key['name'];?></td>
											<td><?php echo $key['aadhar'];?></td>
											<td><?php echo $key['dob'];?></td>
												<td>
													<a href="<?php echo base_url('uploads/exam_form/'.$key['ref_no'].'/'.$key['file1'].''); ?>" class="btn btn-sm btn-info btn-block" target="_blank">Matric</a>
													<a href="<?php echo base_url('uploads/exam_form/'.$key['ref_no'].'/'.$key['file2'].''); ?>" class="btn btn-sm btn-info btn-block" target="_blank">Inter</a>
												</td>
											<td><img class="img-responsive img-thumbnail" src="<?php echo base_url('uploads/exam_form/'.$key['ref_no'].'/'.$key['img1'].''); ?>" style="height:70px;"></td>
											<td> 
												<a title="View Detail" href="<?php echo base_url('admin_view_exam_detail/').$key['id'];?>"  class="btn btn-sm btn-info"><i class="fa fa-eye"></i> </a>
												<a title="Edit" href="javascript:void();" data-toggle="modal" data-target="#ViewmyModal<?php echo $key['id'];?>" class="btn btn-sm btn-success"><i class="fa fa-pencil" ></i>  </a>  
												<a title="Get Admit Card" href="<?php echo base_url('get_admit/').$key['id'];?>" class="btn btn-sm btn-primary" target="_blank"><i class="fa fa-print"></i></a>
											</td>
										</tr>
										<div class="modal fade" id="ViewmyModal<?php echo $key['id'];?>" tabindex="-1" role="dialog">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">Edit Detail</h5>
														<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">X</button>	
													</div>
													<div class="modal-body">
														<form action="<?php echo base_url('edit_admin_exam_form');?>" method="post" id="save_form">
															<div class="row">
																<input type="hidden" name="edit_ref_id" value="<?php echo $key['id'];?>">
																<div class="col-sm-12">
																	<div class="form-group bmd-form-group">
																		<label class="bmd-label-floating"> Name: </label>
																		<input type="text" name="edit_student_name" value="<?php echo $key['name'];?>" class="form-control" required="" autocomplete="off">
																	</div>
																</div>
																<div class="col-sm-12">
																	<div class="form-group bmd-form-group">
																		<label class="bmd-label-floating">Remarks: </label>
																		<input type="text" name="edit_remarks" value="<?php echo $key['remarks'];?>" class="form-control"  autocomplete="off">
																	</div>
																</div>
															</div>
															
															<button type="submit" class="btn btn-success">Update changes</button>
														
														</form>
													</div>
												</div>
											</div>
										</div>
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
function get_school_session() 
{
	var session = $('.session').val();
	//alert(school_code);
	$.ajax(
	{
		url:"<?php echo base_url('fetch_session');?>",
		method:"POST",
		data:{session:session},
		dataType:"text",
		success:function(data)
		{
			console.log(data);
			$('#session_type').html(data); 
		} 
	});
}
  
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
		} 
	});
}
</script>
