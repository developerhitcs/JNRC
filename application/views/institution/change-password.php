<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="offset-2"></div>
			<div class="col-lg-8">
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
			<div class="offset-2"></div>
		</div> 
		<div class="row">
			<div class="offset-2"></div>  
			<div class="col-md-8">  
				<div class="card">
					<div class="card-header-info">
						<span>Change You Password</span>		
					</div>	
					<div class="card-body">						
						<form method="post" action="<?php echo base_url('update_password_institution_details');?>"  >
							<div class="form-group bmd-form-group">
								<label class="bmd-label-floating">Enter Old Password </label>
								<input type="password" class="form-control" name="old" autocomplete="off" required="" >
							</div>						
							<div class="form-group bmd-form-group">
								<label class="bmd-label-floating">Enter New Password </label>
								<input type="password" class="form-control" name="new"  autocomplete="off" required="" >
							</div>
							<div class="form-group bmd-form-group">
								<label class="bmd-label-floating">Enter Confirm Password </label>
								<input type="password" class="form-control" name="con"  autocomplete="off" required="" >
							</div>
							<button type="submit" class="btn btn-success btn-block">Change Password</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

