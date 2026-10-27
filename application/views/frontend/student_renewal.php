<div class="page-content">
	<!-- inner page banner -->
	<div class="dez-bnr-inr overlay-black-middle" style="background-image:url(<?php echo base_url();?>assets/images/nursebanner.jpg);">
		<div class="container">
			<div class="dez-bnr-inr-entry">
				<h1 class="text-white">Student Renewal</h1>
			</div>
		</div>
	</div>
	<!-- inner page banner END -->
	<!-- Breadcrumb row -->
	<div class="breadcrumb-row">
		<div class="container">
			<ul class="list-inline">
				<li><a href="<?php echo base_url('');?>">Home</a></li>
				<li>Student Renewal</li>
			</ul>
		</div>
	</div>
	<div class="section-full bg-gray content-inner">
		<div class="container">  
			<div class="section-content">
				<div class="row">					
					<div class="post card-container col-lg-12 col-md-6 col-sm-6 col-xs-12">
						<div class="widget bg-white p-a20 widget_services noc">
							<h5 class="widget-title">Student Renewal Form  </h5>
							<button href="#" onclick="ref_no()" class="pull-right btn btn-info" style="margin-top:-20px">Click here if you have already applied.</button>
							<form action="<?php echo base_url('save_student_renewal');?>" method="POST" enctype='multipart/form-data'>
								<br>
								<div class="row">
									<div class="form-group col-sm-4">
										<label>Registration No. :<span style="color:red; font-weight: bold;"> *</span></label>
										<input type="text" class="form-control" name="reg_no" id="reg_no" value="" required="">
									</div>
									<div class="form-group col-sm-4">
										<label>Name :<span style="color:red; font-weight: bold;"> *</span></label>
										<input type="text" class="form-control" name="name" id="name" value="" required="" >
									</div>
									<div class="form-group col-sm-4">
										<label>Father's Name :<span style="color:red; font-weight: bold;"> *</span></label>
										<input type="text" class="form-control" name="father_name" id="father_name" value="" required="">
									</div>								
								</div>
								<div class="row">
									<div class="form-group col-sm-4">
										<label>Category of Registration :
										<span style="color:red; font-weight: bold;"> *</span></label>
										<select class="form-control" name="category" required="">
											<option value="Nurse">Nurse</option>
											<option value="Midwife">Midwife</option>
											<option value="GNM">GNM</option>
											<option value="ANM">ANM</option>
											<option value="Health Supervisor (Female)">Health Supervisor (Female)</option>
										</select>
									</div>
									<div class="form-group col-sm-4">
										<label>DOB :<span style="color:red; font-weight: bold;"> *</span></label>
										<input type="text"  class="form-control doj" name="dob"  required="" placeholder="dd/mm/yyyy">
									</div>
									<div class="col-sm-4">
										<label>Name of Training School/College :<span style="color:red; font-weight: bold;"> *</span></label>
										<input type="text" class="form-control" name="school_train" id="school_train" value="" required="">
									</div>
								</div>

								<div class="row">
									<div class="col-sm-6">
										<label>Mobile No.:<span style="color:red; font-weight: bold;"> *</span></label>
										<input type="number" class="form-control" name="mobile_no" id="mobile_no" value="" required="">
									</div>

									<div class="col-sm-6">
										<label>Aadhar No.:<span style="color:red; font-weight: bold;"> *</span></label>
										<input type="number" class="form-control" name="aadhar_no" id="aadhar_no" value="" required="">
									</div>
								</div>
								<div class="row"><br>
									<div class="col-sm-6">
										<label>Present place of Posting (If in Govt. Service) :</label>
										<textarea class="form-control" name="place_post" cols="5"></textarea>
									</div>
									<div class="col-sm-6">
										<label>Permanent Address :<span style="color:red; font-weight: bold;"> *</span></label>
										<textarea class="form-control" name="perm_address" cols="5" required=""></textarea>
									</div>
								</div>

								<div class="row"><br>									
									<div class="wizard-buttons  col-sm-3">
										<button type="submit" name="save" class="btn btn-primary btn-submit">Submit</button>
										<a href="<?php echo base_url();?>" class="btn btn-danger">Back</a>										
									</div>
								</div> 
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!--School Detail-->
<div id="SchoolDetail" class="modal" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="">Get your Renewal Form</h4>
				<button type="button" class="btn btn-danger btn-sm pull-right" data-dismiss="modal" style="margin-top:-40px;">X</button>				
			</div>
			<div class="modal-body">				
				<form action="<?php echo base_url('get_renewal_form');?>" method="post">
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label for="form-field-username">Enter Reference No. *</label>							
								<input type="text" id="ref_no"  value="" class="form-control" name="ref_no" required="" />
							</div>
						</div>
						<div class="col-xs-12 col-sm-12">
							<div class="form-group">
								<label for="form-field-username">Enter Mobile No. *</label>
								<input type="number" id="mobile_no"  value="" class="form-control" name="mobile_no" required="" />
							</div>
						</div>						
						<div class="col-sm-12">
							<button type="submit" class="btn btn-sm btn-primary"><i class="ace-icon fa fa-check"></i>Get Form</button>
							<button class="btn btn-sm btn-danger" data-dismiss="modal"><i class="ace-icon fa fa-times"></i>Cancel</button>						
						</div><br><br>
					</div>
				</form>				
			</div>
		</div>
	</div>
</div>

<!--Wallet Form Ends-->

<script type="text/javascript">
function ref_no() 
{
	$('#SchoolDetail').modal('show');
}
</script>