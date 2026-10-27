<?php
if($this->session->userdata('school_code')==null || $this->session->userdata('loginstatus')==null)
{
	$_SESSION['errmsg']="Login Verification Detail Not Matched...? Please Try Again.";
	redirect(base_url('institution_login'));
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' /> 	
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('assets/images/favicon.png');?>" />
    <title>Jharkhand Nursing Council || Institution Dashboard</title>
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
	<!-- CSS Files -->
	<link href="<?php echo base_url('assets_admin/css/material-dashboard.minf066.css?v=2.1.0'); ?>" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
		.p_text
		{
			text-align: justify;
			font-size: 17px;
			font-weight: 400;
			text-transform: capitalize;
		}
		.p_text b
		{
			text-decoration: underline;
			color: #9931b1;
		}
	</style>
</head>
<body>
    
<div class="sidebar" data-color="rose" data-background-color="light" data-image="<?php echo base_url('assets_admin/img/sidebar-1.jpg')?>">
	<div class="logo">		
		<a href="javascript:void(0);" class="simple-text logo-normal">
			Jharkhand Nurses <br> Registration Council
		</a>
	</div>
	<div class="sidebar-wrapper">        
        <ul class="nav">
			
			<li class="nav-item active">
				<a class="nav-link" href="<?php echo base_url('institution_dashboard'); ?>">
					<i class="material-icons">dashboard</i><p> Dashboard </p>
				</a>
			</li>
			<li class="nav-item ">
				<a class="nav-link" data-toggle="collapse" href="#pagesExamples">
					<i class="material-icons">school</i>
					<p>Manage Affiliation <b class="caret"></b></p>
				</a>
				<div class="collapse" id="pagesExamples">
					<ul class="nav">
						<li class="nav-item ">
							<a class="nav-link" href="#">
								<i class="material-icons">verified</i>
								<span class="sidebar-normal">Institution Details</span>
							</a>
						</li>
						<li class="nav-item ">
							<a class="nav-link" href="#">
								<i class="material-icons">verified</i>
								<span class="sidebar-normal">Seat Availability Details</span>
							</a>
						</li>
						<li class="nav-item ">
							<a class="nav-link" href="#">
								<i class="material-icons">verified</i>
								<span class="sidebar-normal">Clinical & Other Details</span>
							</a>
						</li>
						<li class="nav-item ">
							<a class="nav-link" target="_blank" href="https://www.onlinesbi.com/sbicollect/icollecthome.htm?corpID=955755">
								<i class="material-icons">verified</i>
								<span class="sidebar-normal">Make Payment Online</span>
							</a>
						</li>
					</ul>
				</div>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#" >
				  <i class="material-icons">verified</i>
				  <p>View Affiliation Details</p>
				</a>
            </li>
			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url('institution_certification_details'); ?>" >
					<i class="material-icons">card_giftcard</i>
					<p>Certification Details</p>
				</a>
            </li>
			<li class="nav-item">
				<a class="nav-link" href="#" >
				  <i class="material-icons">how_to_reg</i>
				  <p>Student Registration</p>
				</a>
            </li> 			
			<li class="nav-item ">
				<a class="nav-link" data-toggle="collapse" href="#exam">
					<i class="material-icons">menu_book</i>
					<p>Manage Exam Form <b class="caret"></b></p>
				</a>
				<div class="collapse" id="exam">
					<ul class="nav">
						<li class="nav-item ">
							<a class="nav-link" href="<?php echo base_url('fill_exam_form');?>">
								<i class="material-icons">verified</i>
								<span class="sidebar-normal">Examination Form</span>
							</a>
						</li>
						<li class="nav-item ">
							<a class="nav-link" href="<?php echo base_url('all_exam_form_details'); ?>">
								<i class="material-icons">verified</i>
								<span class="sidebar-normal">Submitted Exam Form</span>
							</a>
						</li>
						<li class="nav-item ">
							<a class="nav-link" href="<?php echo base_url('how_to_fill_exam_form_details'); ?>">
								<i class="material-icons">verified</i>
								<span class="sidebar-normal">How To Fill Exam Form</span>
							</a>
						</li>												
					</ul>
				</div>
			</li>
            
            <li class="nav-item">
				<a class="nav-link" href="<?php echo base_url('edit_institution_details'); ?>" >
				  <i class="material-icons">list_alt</i>
				  <p>Edit School Details</p>
				</a>
            </li> 
           <li class="nav-item">
				<a class="nav-link" href="<?php echo base_url('change_password_institution_details'); ?>" >
				  <i class="material-icons">no_encryption</i>
				  <p>Change Password</p>
				</a>
            </li> 
           
			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url('logout_institution');?>" >
				  <i class="material-icons">power_settings_new</i>
				  <p> Logout</p>
				</a>
            </li> 
			<li class="nav-item active">
				<a class="nav-link" target="_blank" href="<?php echo base_url(''); ?>">
					<i class="material-icons">language</i><p> Go Back Website </p>
				</a>
			</li>
		</ul>
    </div>
</div>
<div class="main-panel">
	<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
		<div class="container-fluid">
			<div class="navbar-wrapper">
				<div class="navbar-minimize">
				<button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
					<i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
					<i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
				</button>
				</div>
				<a class="navbar-brand" href="<?php echo base_url('institution_dashboard'); ?>">
					Dashboard 
				</a>
				<div class="mobile">
					<img class="img-fluid img-thumbnail" src="<?php echo base_url('assets_admin/img/logo.png')?>">
				</div>
			</div>
			<button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
				<span class="sr-only">Toggle navigation</span>
				<span class="navbar-toggler-icon icon-bar"></span>
				<span class="navbar-toggler-icon icon-bar"></span>
				<span class="navbar-toggler-icon icon-bar"></span>
			</button>
			<div class="collapse navbar-collapse justify-content-end">

			<ul class="navbar-nav">
				<li class="nav-item dropdown">
					<a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="material-icons">person</i>
						<p class="d-lg-none d-md-block">Account</p>
					</a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
						<a class="dropdown-item" href="<?php echo base_url('edit_institution_details');?>">Edit School Details</a>
						<a class="dropdown-item" href="<?php echo base_url('change_password_institution_details');?>">Change Password</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="<?php echo base_url('logout_institution');?>">Log out</a>
					</div>
				</li>
			</ul>
			</div>
		</div>
	</nav> 
           
