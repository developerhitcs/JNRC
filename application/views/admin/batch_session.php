<style>
.title-margin
{
	
    padding-bottom: 5px;
    border-bottom: 1px dashed  #c3c3c3;
    text-align: left;
	font-family: cursive;
}
</style>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<?php
				if (isset($_SESSION['errmsg'])) 
				{
					?>
					<div class="alert alert-<?php echo $_SESSION['msg']; ?> alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
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
					<div class="card-header-primary">
						<span>Insruction : Examination Form Proccess</span>		
					</div>	
					<div class="card-body">	
						<p><b>1. Edit Current Exam Batch Session Name .</b></p>
						<p><b>2. Then Create Examination Table For This Batch Session.</b></p>
						<p><b>3. After Examination Form Filling Date Close Then Generate Admit Card Roll No.</b> </p>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">  
				<div class="card">
					<div class="card-header-success">
						<span>1. Exam Batch Session Details</span>		
					</div>	
					<div class="card-body">	
						<div class="toolbar">							
							<!-- Add Aditional Section Contntent Here.... -->					
						</div>
						<div class="material-datatables">
							<table id="datatables" class="table table-striped table-bordered" style="width: 100%">
								<thead>
									<th>#</th>
									<th>Current Exam Batch Session </th>
									<th>Form Filling Open Date </th>
									<th>Form Filling Closing Date</th>
									<th>Status</th>
									<th class="disabled-sorting">Action</th>
								</thead>
								<tbody>
									<?php 
									$i=1; 
									foreach ($row as $key) 
									{ 
										?>
										<tr>
											<td><?php echo $i;?></td>
											<td><?php echo $key['current_session'];?></td>											
											<td><?php echo $key['form_open'];?></td>											
											<td><?php echo $key['form_close'];?></td>										
											<td><?php echo $key['status'];?></td>										
											<td>
												<a class="btn btn-success btn-sm" title="Edit" data-toggle="modal" data-target="#EditmyModal<?php echo $key['id'];?>" href="javascript:void();"><i class="fa fa-pencil"></i></a> 
											</td>
										</tr>
										
										
										<div class="modal" id="EditmyModal<?php echo $key['id'];?>">
											<div class="modal-dialog modal-md">
												<div class="modal-content">
													<!-- Modal Header -->
													<div class="modal-header">														
														<h4 class="modal-title">Edit Current Batch Session</h4>
														<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">X</button>																																	
													</div>
													<div class="modal-body">
														<form method="post" action="<?php echo base_url('update_batch_session');?>"  >
															<input type="hidden" name="edit_id" value="<?php echo $key['id'];?>">											
															<div class="row">
																<div class="col-sm-12">
																	<div class="form-group bmd-form-group">
																		<label class="bmd-label-floating">Current Batch Session </label>
																		<input type="text" class="form-control" value="<?php echo $key['current_session'];?>" name="session" required="" autocomplete="off">
																	</div>
																</div>
																<div class="col-sm-6">
																	<div class="form-group bmd-form-group is-filled">
																		<label class="bmd-label-floating">Form Filling Open Date </label>
																		<input type="text" name="open_date" class="form-control datepicker" value="<?php echo $key['form_open'];?>"  autocomplete="off" >
																	</div>
																</div>
																<div class="col-sm-6">
																	<div class="form-group bmd-form-group is-filled">
																		<label class="bmd-label-floating">Form Filling Close Date </label>
																		<input type="text" name="close_date" class="form-control datepicker" value="<?php echo $key['form_close'];?>" autocomplete="off">
																	</div>																	
																</div>
																<div class="col-sm-12">
																	<div class="form-group bmd-form-group is-filled">
																		<label class="bmd-label-floating">Choose Status </label>
																		<select class="form-control" name="status" required="">
																			<option value="<?php echo $key['status'];?>" selected><?php echo $key['status'];?></option>																			
																			<option value="">Choose Status</option>
																			<option value="Active">Active</option>
																			<option value="Expired">Expired</option>																			
																		</select>								
																	</div>
																</div>
																<div class="col-sm-2">
																	<button type="submit" class="btn btn-success btn-block">Update</button>
																</div>								
															</div>
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
		
		<div class="row">
			<div class="col-md-6">  
				<div class="card">
					<div class="card-header-info">
						<span>2. Create Examination Table</span>		
					</div>	
					<div class="card-body">							
						<form method="post" action="<?php echo base_url('create_table_session');?>"  >
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group bmd-form-group">
										<label class="bmd-label-floating">Current Batch Session </label>
										<input type="text" class="form-control" value="<?php echo $key['current_session'];?>" name="session" required="" readonly="" autocomplete="off">
									</div>
								</div>								
								<div class="col-sm-4">
									<button type="submit" class="btn btn-success btn-block">Create</button>
								</div>								
							</div>
						</form>									
					</div>
				</div>
			</div>
			<div class="col-md-6">  
				<div class="card">
					<div class="card-header-warning">
						<span>3. Generate Admit Card Roll No</span>		
					</div>	
					<div class="card-body">							
						<form method="post" action="<?php echo base_url('generate_rollno_session');?>"  >
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group bmd-form-group">
										<label class="bmd-label-floating">Current Batch Session </label>
										<input type="text" class="form-control" value="<?php echo $key['current_session'];?>" name="session" required="" readonly="" autocomplete="off">
									</div>
								</div>
								
								<div class="col-sm-4">
									<button type="submit" class="btn btn-success btn-block">Generate Roll No</button>
								</div>								
							</div>
						</form>									
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

