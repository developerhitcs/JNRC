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
		<?php foreach($institution_details as $id) {} ?>
		<div class="row">
			<div class="col-md-12">  
				<div class="card">
					<div class="card-header-info">
						<span>Update Details</span>		
					</div>	
					<div class="card-body">						
						<form method="post" action="<?php echo base_url('update_institution_details');?>"  >
							<div class="row">								
								<div class="col-sm-6">
									<div class="form-group bmd-form-group">
										<label class="bmd-label-floating">Email </label>
										<input type="email" class="form-control" name="email" value="<?php echo $id['email'];?>" required="" autocomplete="off" >
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group bmd-form-group">
										<label class="bmd-label-floating">Phone </label>
										<input type="tel" maxlength="10" class="form-control" name="phone" value="<?php echo $id['phone'];?>" required="" autocomplete="off" >
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
	</div>
</div>

