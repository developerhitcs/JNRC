<style>
.title span
{
	font-size: 25px;
    font-weight: 600;
    font-style: oblique;
}
</style>
<div class="content">
	<div class="container-fluid">				
		<div class="row">
			<div class="col-md-4">  
				<div class="card">
					<div class="card-header-success">
						<span>Welcome Admin</span>		
					</div>	
					<div class="card-body mb-3">						
						<h3 class="title"><span><?php echo $_SESSION['first_name'].' '. $_SESSION['last_name']; ?></span> </h3>
					</div>
				</div>
			</div>
			<div class="col-md-4">  
				<div class="card">
					<div class="card-header-warning">
						<span>Database Backup</span>		
					</div>	
					<div class="card-body">						
						<a href="<?php echo base_url('keep_backup');?>" class="btn btn-danger">Database Backup</a>
					</div>
				</div>
			</div>
			<div class="col-md-4">  
				<div class="card">
					<div class="card-header-info">
						<span>Generate List</span>		
					</div>	
					<div class="card-body">						
						<a href="<?php echo base_url('export/createXLS');?>" class="btn btn-success">Generate List</a>
					</div>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-4">  
				<div class="card">
					<div class="card-header-danger">
						<span>Total School</span>		
					</div>	
					<div class="card-body">						
						<h3 class="title"><span>No Of Schools : </span> <?php echo $anm+$gnm+$bsc+$pbsc+$msc; ?> </h3>
					</div>
				</div>
			</div>
			<div class="col-md-4">  
				<div class="card">
					<div class="card-header-info">
						<span>Total ANM School</span>		
					</div>	
					<div class="card-body">						
						<h3 class="title"><span>No Of Schools : </span> <?php echo $anm; ?> </h3>
					</div>
				</div>
			</div>
			<div class="col-md-4">  
				<div class="card">
					<div class="card-header-warning">
						<span>Total GNM School</span>		
					</div>	
					<div class="card-body">						
						<h3 class="title"><span>No Of Schools : </span> <?php echo $gnm; ?> </h3>
					</div>
				</div>
			</div>
			<div class="col-md-4">  
				<div class="card">
					<div class="card-header-info">
						<span>Total BSC School</span>		
					</div>	
					<div class="card-body">						
						<h3 class="title"><span>No Of Schools : </span> <?php echo $bsc; ?> </h3>
					</div>
				</div>
			</div>		
		
			<div class="col-md-4">  
				<div class="card">
					<div class="card-header-warning">
						<span>Total PBSC School</span>		
					</div>	
					<div class="card-body">						
						<h3 class="title"><span>No Of Schools : </span> <?php echo $pbsc; ?> </h3>
					</div>
				</div>
			</div>
			<div class="col-md-4">  
				<div class="card">
					<div class="card-header-success">
						<span>Total MSC School</span>		
					</div>	
					<div class="card-body">						
						<h3 class="title"><span>No Of Schools : </span> <?php echo $msc; ?> </h3>
					</div>
				</div>
			</div>							
		</div>
		
		<div class="row">			
			<div class="col-md-6">  
				<div class="card">
					<div class="card-header-warning">
						<span>Total Renewal Forms Lists</span>		
					</div>	
					<div class="card-body">						
						<h3 class="title"><span>No Of Forms : </span><?php echo $renewal; ?> </h3>
					</div>
					<div class="card-footer">
						<div class="stats">
							<i class="material-icons text-warning">info</i>
							<a href="<?php echo base_url('admin_view_renewal'); ?>">View More Details...</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">  
				<div class="card">
					<div class="card-header-success">
						<span>Total Exam Forms</span>		
					</div>	
					<div class="card-body">						
						<h3 class="title"><span>No Of Exam Forms : </span>
					
							<?php echo $exam_form; ?>
						</h3>
					</div>
					<div class="card-footer">
						<div class="stats">
							<i class="material-icons text-success">info</i>
							<a href="<?php echo base_url('admin_view_exam_form'); ?>">View More Details...</a>
						</div>
					</div>
				</div>
			</div>			
		</div>
	</div>
</div>

            
           