<div class="page-content">
	<!-- inner page banner -->
	<div class="dez-bnr-inr overlay-black-middle" style="background-image:url(<?php echo base_url();?>assets/images/nursebanner.jpg);">
		<div class="container">
			<div class="dez-bnr-inr-entry">
				<h1 class="text-white">View Result</h1>
			</div>
		</div>
	</div>
	<!-- inner page banner END -->
	<!-- Breadcrumb row -->
	<div class="breadcrumb-row">
		<div class="container">
			<ul class="list-inline">
				<li><a href="<?php echo base_url('');?>">Home</a></li>
				<li>View Result</li>
			</ul>
		</div>
	</div>
	<div class="section-full bg-gray content-inner">
		<div class="container">  
			<div class="section-content">
				<div class="row">					  
					<div class="post card-container col-lg-2 col-md-6 col-sm-6 col-xs-12"></div>
					<div class="post card-container col-lg-8 col-md-6 col-sm-6 col-xs-12">
						<div class="widget bg-white p-a20 widget_services noc">
							<h5 class="widget-title">Enter Details </h5>
							<form action="<?php echo base_url('get_result');?>" method="POST">
								<div class="form-group">
									<label>School Code :</label>
									<input type="text" class="form-control" name="school_code" id="school_code" required autocomplete="off">
								</div>
								<div class="form-group">
									<label>Roll No. :</label>
									<input type="text" class="form-control" name="roll_no" id="roll_no"  required autocomplete="off">
								</div>
								<div class="form-group">
									<label>DOB :</label>
									<input type="text" class="form-control" name="dob" id="dob" required autocomplete="off">
								</div>
								<div class="wizard-buttons">
									<button type="submit" name="save" class="btn btn-primary btn-submit">Submit</button>
									<a href="<?php echo base_url();?>" class="btn btn-danger">Back</a>
								</div>
							</form>
						</div>
					</div>          
				</div>             
			</div>
		</div>
	</div><br>	   
</div>		   
