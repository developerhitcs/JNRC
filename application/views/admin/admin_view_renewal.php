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
					<div class="card-header-success">
						<span>All Student Renewal Form Lists</span>		
					</div>	
					<div class="card-body">	
						<div class="toolbar">
							<br>
							<div class="row">
								<div class="col-sm-10">
									<form action="<?php echo base_url('admin_view_renewal');?>" method='post'>  
										<div class="row">
											<div class="col-sm-5">
												<div class="form-group bmd-form-group is-filled">
													<label class="bmd-label-floating">Choose Search By </label>
													<select class="form-control" name="search_by" id="search_by" onchange="change_place()">
														<option value="">--Search By--</option>
														<option value="name">Name</option>
														<option value="reg_no">Registration No.</option>
														<option value="ref_no">Refernce No.</option>
														<option value="father_name">Father's Name</option>
														<option value="aadhar_no">Aadhar No.</option>
														<option value="mobile_no">Mobile No.</option>
														<option value="show_all">Show All Data</option>
													</select>
												</div>											
											</div>											
											<div class="col-sm-5">
												<div class="form-group bmd-form-group">
													<label class="bmd-label-floating" id="value">Enter</label>
													<input type="text" name="value"  class="form-control">
												</div>
											</div>
											<div class="col-sm-2">
												<button type="submit" name="submit" class="btn btn-primary btn-block"><i class="fa fa-search"></i> Search</button>
											</div>
										</div>
									</form>
								</div>
								<div class="col-sm-2">
									<form action="<?php echo base_url('export/createRenewalXLS');?>" method="post">
										<input type="submit" name="Export Data" value="Generate All Data" class="btn btn-success btn-block">
									</form> 
								</div> 
							</div><hr> 			
						</div>
						<div class="material-datatables">
							<table id="datatables" class="table table-striped table-bordered" style="width: 100%">
								<thead>
									<th>#</th>
									<th>Name</th>
									<th style="width:30%">School Trained</th>
									<th>Ref No.</th>
									<th>Reg No.</th>	
									<th>Filling Date</th>
									<th class="disabled-sorting">Action</th>
								</thead>
								<tbody>
									<?php 
									$i=1;
									foreach ($row as $key ) 
									{ 
										?>
										<tr>
											<td><?php echo $i;?></td>
											<td><?php echo $key['name'];?></td>
											<td><?php echo $key['school_train'];?></td>
											<td><?php echo $key['ref_no'];?></td>
											<td><?php echo $key['reg_no'];?></td>
											<td><?php echo $key['created'];?></td>
											<td> 
												<a href="<?php echo base_url('get_renewal_form/').$key['ref_no'];?>" target="_blank" class="btn btn-success btn-sm" ><i class="fa fa-print"></i></a>
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
	</div>
</div>

<script type="text/javascript">
function change_place(val)
{
	var search_by = $("#search_by>option:selected").text();
	if(search_by=='Show All Data')
	{
		search_by='Nothing. Click on Search';
	}
	else
	{
		search_by=search_by;
	}
	//$("#value").attr('text','Enter '+search_by);
	$("#value").html('Enter '+search_by)  
}
</script>