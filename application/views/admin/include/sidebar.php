    
<div class="sidebar" data-color="rose" data-background-color="light" data-image="<?php echo base_url('assets_admin/img/sidebar-1.jpg')?>">
	<div class="logo">
		
		<a href="javascript:void(0);" class="simple-text logo-normal">
			Jharkhand Nurses <br> Registration Council
		</a>
	</div>
	<div class="sidebar-wrapper">        
        <ul class="nav">
			<li class="nav-item active">
				<a class="nav-link" href="<?php echo base_url('admin'); ?>">
					<i class="material-icons">dashboard</i><p> Dashboard </p>
				</a>
			</li>
			
		   	<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url('college_list'); ?>" >  
				  <i class="material-icons">school</i>
				  <p>Manage College</p>
				</a>
            </li> 
            
                     <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('center'); ?>">
            <i class="material-icons">add_location</i>
            <p>Add Center</p>
          </a>
        </li>
        
        <li class="nav-item">
  <a class="nav-link" href="<?php echo base_url('admin/set_exam_datetime'); ?>">
    <i class="material-icons">event</i>
    <p>Set Subject Date/Time</p>
  </a>
</li>


            
			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url('college_renewal'); ?>" >
				  <i class="material-icons">verified</i>
				  <p>College Renewal</p>
				</a>
            </li> 
			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url('admin_view_registration'); ?>" >
				  <i class="material-icons">how_to_reg</i>
				  <p>Manage Registration</p>
				</a>
            </li> 
			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url('admin/passed-out'); ?>">
					<i class="material-icons">how_to_reg</i>
					<p>Passed-out Registration</p>
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
							<a class="nav-link" href="<?php echo base_url('admin_batch_session');?>">
								<i class="material-icons">fact_check</i>
								<span class="sidebar-normal">Exam Session & Roll No</span>
							</a>
						</li>
						<li class="nav-item ">
							<a class="nav-link" href="<?php echo base_url('admin_view_exam_form'); ?>">
								<i class="material-icons">menu_book</i>
								<span class="sidebar-normal">Manage Exam Form</span>
							</a>
						</li>
						<li class="nav-item ">
							<a class="nav-link" href="<?php echo base_url('resitter_student_details'); ?>">
								<i class="material-icons">event_seat</i>
								<span class="sidebar-normal">Resitter Student Details</span>
							</a>
						</li>	
						<li class="nav-item ">
							<a class="nav-link" href="<?php echo base_url('view_roll_no'); ?>">
								<i class="material-icons">how_to_reg</i>
								<span class="sidebar-normal">View Admit Card Roll No</span>
							</a>
						</li>
						<li class="nav-item ">
							<a class="nav-link" href="<?php echo base_url('admin/admit-cards'); ?>">
								<i class="material-icons">picture_as_pdf</i>
								<span class="sidebar-normal">Release Admit Card</span>
							</a>
						</li>
						<li class="nav-item ">
							<a class="nav-link" href="<?php echo base_url('admin/internal-marks'); ?>">
								<i class="material-icons">edit_note</i>
								<span class="sidebar-normal">Internal Marks</span>
							</a>
						</li>
					</ul>
				</div>
			</li>
			
            <li class="nav-item">
				<a class="nav-link" href="<?php echo base_url('admin_view_result'); ?>" >
				  <i class="material-icons">list_alt</i>
				  <p>Manage Results</p>
				</a>
            </li> 
           <li class="nav-item">
				<a class="nav-link" href="<?php echo base_url('admin_view_renewal'); ?>" >
				  <i class="material-icons">perm_contact_calendar</i>
				  <p>Manage Student Renewal</p>
				</a>
            </li> 
            <li class="nav-item">
				<a class="nav-link" href="<?php echo base_url('documents'); ?>" >
				  <i class="material-icons">publish</i>
				  <p>Upload Documents</p>
				</a>
            </li> 
			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url('notification'); ?>" >
				  <i class="material-icons">add_alert</i>
				  <p>Manage Notification</p>
				</a>
            </li> 
			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url('upload_gallery'); ?>" >
				  <i class="material-icons">collections</i>
				  <p>Manage Gallery</p>
				</a>
            </li>
			        
			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url('logout');?>" >
				  <i class="material-icons">power_settings_new</i>
				  <p> Logout</p>
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
				<a class="navbar-brand" href="<?php echo base_url('admin'); ?>">
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
						<a class="dropdown-item" href="<?php echo base_url('profile');?>">Profile</a>
						<a class="dropdown-item" href="<?php echo base_url('change_password');?>">Change Password</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="<?php echo base_url('logout');?>">Log out</a>
					</div>
				</li>
			</ul>
			</div>
		</div>
	</nav> 
           