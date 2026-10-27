
<div class="content">
	<div class="container-fluid">
		<div class="row">			
			<div class="col-md-12">
				<?php
				if (isset($_SESSION['errmsg'])) 
				{
					?>
					<div class="alert alert-<?php echo $_SESSION['msg']; ?> alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
						<strong><?php echo $_SESSION['errmsg']; ?></strong>
					</div>
					<?php
					unset($_SESSION['errmsg']);
				}
				?>
			</div>
		</div>
		<div class="card">
			<div class="card-header-info">
				<span>Add New Notification</span>
			</div>
			<div class="card-body">	<br>							
				<form method="POST" action="<?php echo base_url('save_notification');?>" enctype="multipart/form-data">
					<div class="row">	
						<div class="col-sm-4">
							<div class="form-group bmd-form-group">
								<label class="bmd-label-floating">Enter Notification here</label>
								<input type="text" name="notification" class="form-control"autocomplete="off" required>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group bmd-form-group">
								<select name="status" class="form-control" required>
									<option value="">Notification Status</option>
									<option value="Active">Active</option>		
									<option value="Deactive">Deactive</option>		
								</select>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group bmd-form-group">
								<select name="ds_status" class="form-control" required>
									<option value="">Dash Status</option>
									<option value="Active">Active</option>		
									<option value="Deactive">Deactive</option>		
								</select>
							</div>
						</div>
						<div class="col-sm-12">
							<label class="bmd-label-floating">Upload  Documents </label>
							<input type="file" class="form-control" name="file1">
						</div>
						<div class="col-sm-3 mt-2">
							<input type="submit" name="submit" value="Add Notification" class="btn bnt-block btn-success">
						</div>
					</div>						
				</form>	
			</div>
		</div>	
		
		
		
		
		
		
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header-success">
						<span>Notification List</span>
					</div>
					<div class="card-body">
						<table id="datatables" class="table table-striped table-bordered">
							<thead>
								<th>S.No.</th>
								<th>Notification</th>						
								<th>File</th>						
								<th>Status</th>						
								<th>Dash Status</th>						
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
										<td><?php echo $key['notification'];?></td>
										<td>
										<?php 
										if($key['file1']!='')
										{
											?>
											<a href="<?php echo base_url('uploads/notification/'); echo $key['file1'];?>" target="_blank">View Attachment</a>
											<?php 
										} 
										else
										{
											echo 'No Attachments...!!!';
										}
										?>
										</td>
										<td><span class="badge  badge-info"><?php echo $key['status'];?></span></td>
										<td><span class="badge  badge-success"><?php echo $key['dash_status'];?></span></td>
										<td>
											<a title="Edit" class="btn btn-success btn-sm" data-toggle="modal" data-target="#EditModal<?php echo $key['id'];?>" href="javascript:void();"><i class="fa fa-pencil"></i></a>
											<a title="Delete" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?')"  href="<?php echo base_url('delete_notif/'); echo $key['id'];?>"><i class="fa fa-trash"></i></a>  
										</td>
									</tr>
									<!-- modal --> 
									<div class="modal fade" id="EditModal<?php echo $key['id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog modal-lg">
											<div class="modal-content">
												<div class="modal-header">
													<h4 class="modal-title">Edit Notification</h4>
													<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" aria-label="Close">X</button>
												</div>
												<div class="modal-body">																	
													<form method="post" action="<?php echo base_url('edit_notification');?>" enctype="multipart/form-data">
														<div class="row">
															<input type="hidden" name="up_id" value="<?php echo $key['id'];?>"   required>
															<div class="col-sm-4">
																<div class="form-group bmd-form-group">
																	<label class="bmd-label-floating">Enter Notification here</label>
																	<input type="text" class="form-control" name="notification" value="<?php echo $key['notification'];?>"  required >
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group bmd-form-group is-filled">
																	<label class="bmd-label-floating">Choose Notification Status </label>
																	<select name="status" class="form-control"  required>
																		<option selected value="<?php echo $key['status'];?>"><?php echo $key['status'];?></option>		
																		<option value="">Notification Status</option>
																		<option value="Active">Active</option>		
																		<option value="Deactive">Deactive</option>		
																	</select>
																</div>														
															</div>														
															<div class="col-sm-4">
																<div class="form-group bmd-form-group is-filled">
																	<label class="bmd-label-floating">Choose Notification Status </label>
																	<select name="ds_status" class="form-control"  required>
																		<option selected value="<?php echo $key['dash_status'];?>"><?php echo $key['dash_status'];?></option>		
																		<option value="">Dash Status</option>
																		<option value="Active">Active</option>		
																		<option value="Deactive">Deactive</option>		
																	</select>
																</div>
															</div>
															<div class="col-sm-12">	
																<label class="bmd-label-floating">Upload Renewal Certificate </label>
																<input type="file" class="form-control" name="file1" style="width:100%;">
																<input type="hidden"  value="<?php echo $key['file1'];?>" name="old_file1">
															</div>
														</div><br>
														<input type="submit" value="Update Notification" class="btn btn-success">
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

<script type="text/javascript">
window.setTimeout(function() 
{
  $(".alert").fadeTo(500, 0).slideUp(500, function(){
  $(this).remove(); 
  });
}, 3000);
</script>



