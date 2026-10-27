<!DOCTYPE html>
<html lang="en">
<head>
	<title>Jharkhand Nursing Council</title>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets_admin/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0' name='viewport' />
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
	<link href="<?php echo base_url('assets_admin/css/material-dashboard.minf066.css?v=2.1.0')?>" rel="stylesheet" />
</head>
<body class="off-canvas-sidebar">
<div class="wrapper wrapper-full-page">
	<div class="page-header login-page" style="background-color: #03A9F4;">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 ml-auto mr-auto">
					<?php
					if (isset($_SESSION['errmsg'])) 
					{
						?>
						<div class="alert alert-danger alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
							<strong><?php echo $_SESSION['errmsg']; ?></strong>
						</div>
						<?php
						unset($_SESSION['errmsg']);
					}
					?>
					<br><br>					
					
					<div class="card card-login card-hidden">
						<div class="card-header card-header-primary text-center">
							<img class="img-fluid img-thumbnail" src="<?php echo base_url('assets/images/nar2.png');?>">
						</div>
						<div class="card-body">
							<h4 class="card-title text-center">Institution Login Panel</h4>
							<hr><br>
							<form class="form" method="post" action="<?php echo base_url('institution_verification');?>">
								<div class="col-lg-12">
									<div class="form-group bmd-form-group is-filled">
										<label class="bmd-label-floating">Choose School Course </label>
										<select class="form-control" name="course" required="" autocomplete="off">
											<option value="">Choose School Course</option>
											<option value="ANM">ANM</option>
											<option value="GNM">GNM</option>											
											<!--<option value="BSC">BSC</option>											
											<option value="PBSC">PBSC</option>											
											<option value="MSC">MSC</option>-->											
										</select> 
									</div>
									<div class="form-group bmd-form-group">
										<label class="bmd-label-floating">Username / School Code</label>
										<input type="text" name="username" class="form-control" required="" autocomplete="off">
									</div>
									<div class="form-group bmd-form-group">
										<label class="bmd-label-floating">Password</label>
										<input type="password" name="password" class="form-control" required="" autocomplete="off">
									</div>
									<button type="submit" class="btn btn-success btn-round mt-2">Login Now</button>
								</div>								
							</form>							
						</div>						
						<div class="form-check">
							<label class="form-check-label text-black">								 
								Don't Rember Your Password...?
								<a href="javascript:void();">Click Forget Password</a>
							</label>
						</div>
					</div>					
				</div>
			</div>
		</div>
	</div>
</div>
<script src="<?php echo base_url('assets_admin/js/core/jquery.min.js')?>"></script>
<script src="<?php echo base_url('assets_admin/js/core/popper.min.js')?>"></script>
<script src="<?php echo base_url('assets_admin/js/core/bootstrap-material-design.min.js')?>"></script>
<script src="<?php echo base_url('assets_admin/js/plugins/perfect-scrollbar.jquery.min.js')?>"></script>
<script src="<?php echo base_url('assets_admin/js/plugins/jquery.validate.min.js')?>"></script>
<script src="<?php echo base_url('assets_admin/js/plugins/jquery.bootstrap-wizard.js')?>"></script>
<script src="<?php echo base_url('assets_admin/js/plugins/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('assets_admin/js/material-dashboard.minf066.js?v=2.1.0')?>"></script>
<script>
$(document).ready(function() 
{
	md.checkFullPageBackgroundImage();
	setTimeout(function() 
	{
		$('.card').removeClass('card-hidden');
	}, 700);
});

window.setTimeout(function() 
{
	$(".alert").fadeTo(500, 0).slideUp(500, function()
	{
		$(this).remove(); 
	});
}, 5000);
</script>
</body>
</html>
