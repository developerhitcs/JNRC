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
						<span>Upload Documents</span>			   
					</div>			
					<div class="card-body">				
						<form method="POST" action="<?php echo base_url('save_document');?>" enctype="multipart/form-data">
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group bmd-form-group">
										<label class="bmd-label-floating">Enter Document Title</label>
										<input type="text" name="title" class="form-control" autocomplete="off">
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group bmd-form-group">
										<label class="bmd-label-floating">Enter Position</label>
										<input type="text" name="position" class="form-control" autocomplete="off">
									</div>
								</div>
								<div class="col-sm-12">
									<label class="bmd-label-floating">Attach File</label>
									<input type="file" class="form-control" name="document">
								</div>
								<div class="col-sm-2 mt-2">
									<input type="submit" name="submit" value="Upload" class="btn btn-success">
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
					<div class="card-header-success">
						<span>Documents Upload List</span>
					</div>
					<div class="card-body">
						<table id="datatables" class="table table-striped table-bordered">
							<thead>
								<th>S.no.</th>
								<th>Document Title</th>
								<th>File</th>
								<th>Position</th>
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
										<td><?php echo $key['title'];?></td>
										<td><?php if($key['document']!=''){?><a href="<?php echo base_url(''); echo $key['document'];?>" target="_blank">View</a><?php } else{}?></td>
										<td><?php echo $key['position'];?></td>
										<td>
											<a title="Edit" class="btn btn-success btn-sm" href="javascript:void();" data-toggle="modal" data-target="#EditModal<?php echo $key['id'];?>"><i class="fa fa-pencil"></i></a> 
											<a title="Delete" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?')"  href="<?php echo base_url('delete_document');?>/<?php echo $key['id'];?>"><i class="fa fa-trash"></i></a> 
										</td>
									</tr>
									<div class="modal fade" id="EditModal<?php echo $key['id'];?>">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">Edit Document</h5>
													<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" aria-label="Close">X</button>
												</div>
												<div class="modal-body">
													<form action="<?php echo base_url('edit_document');?>" method="post" id="save_form" enctype="multipart/form-data">
														<div class="row">
															<input type="hidden" name="edit_id" value="<?php echo $key['id'];?>">
															<div class="col-sm-12">
																<div class="form-group bmd-form-group">
																	<label class="bmd-label-floating">Title: </label>
																	<input type="text" name="edit_title" value="<?php echo $key['title'];?>" class="form-control" required="" autocomplete="off">
																</div>
															</div>
															<div class="col-sm-12">
																<div class="form-group bmd-form-group">
																	<label class="bmd-label-floating">Position: </label>
																	<input type="text" name="edit_position" value="<?php echo $key['position'];?>" class="form-control" required="" autocomplete="off">
																</div>										
															</div>
															<div class="col-sm-12">
																<label class="bmd-label-floating">Attach File</label>
																<input type="file" class="form-control" name="document">
																<input type="hidden" name="old_document" value="<?php echo $key['document'];?>" class="form-control" required="" autocomplete="off">
															</div>
															<div class="col-sm-12">
																<button type="submit" class="btn btn-success">Update changes</button>
																<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>																
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
</div>

