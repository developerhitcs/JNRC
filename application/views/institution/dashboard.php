
<div class="content">
	<div class="container-fluid">				
		<div class="row">
			<div class="col-md-12">  
				<div class="card">
					<div class="card-header-success">
						<span>Welcome Institution Admin</span>		
					</div>	
					<div class="card-body">						
						<h3 class="title"><b><?php echo $_SESSION['school_name']; ?> ( <span class="text-danger"> <?php echo $_SESSION['school_course']; ?> </span> ). </b></h3>
					</div>
				</div>
			</div>		
			<div class="col-md-12">  
				<div class="card">
					<div class="card-header-info">
						<span>Go Back To Website</span>		
					</div>	
					<div class="card-body">						
						<a class="btn btn-warning" target="_blank" href="<?php echo base_url(''); ?>">
							<i class="material-icons">language</i> Go Back Website 
						</a>
					</div>
				</div>
			</div>	
		</div>		
	</div>
</div>
