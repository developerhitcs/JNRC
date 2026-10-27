<div class="page-content">
	<div class="dez-bnr-inr overlay-black-middle" style="background-image:url(<?php echo base_url('assets/images/nursebanner.jpg');?>);">
		<div class="container">
			<div class="dez-bnr-inr-entry">
				<h1 class="text-white">Institution New Affiliation First Step</h1>
			</div>
		</div>
	</div>	
	<div class="breadcrumb-row">
		<div class="container">
			<ul class="list-inline">
				<li><a href="<?php  echo base_url('');?>">Home</a></li>
				<li>Institution New Affiliation First Step</li>
				<li style="float:right;">
					<span style=" color: red;"> Welcome <?php echo $this->session->inst_name;?> !! </span> 
					<a onclick="return confirm('Are you sure you want to logout?')" href="<?php  echo base_url('logout_user');?>" class="btn btn-danger btn-round" style=" color: #fff;">Logout</a>
				</li>
			</ul>
		</div>
	</div>
	
	<div class="section-full bg-gray content-inner">
		<div class="container">  
			<div class="section-content">
				<div class="row">
					<div class="col-md-12">
						<?php
						if (isset($_SESSION['errmsg'])) 
						{
						  ?>
						  <div class="alert alert-<?php echo $_SESSION['msg']; ?> alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
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
					<div class="post card-container col-lg-12 col-md-6 col-sm-6 col-xs-12">
						<div class="widget bg-white p-a20 widget_services noc">
							<form action="<?php echo base_url('save_affliation_form1');?>" method="POST">
								<h5 class="widget-title">Society/ Trust/ Mission Details : - <?php //echo $_SESSION['uid']; ?></h5>	
								<div class="row">                  
									<div class="form-group col-sm-6">
										<label>Chairperson/ Registrar Name :<span style="color:red; font-weight: bold;"> *</span></label>
										<input type="text" class="form-control" name="chairperson" id="chairperson" value="" required="" autofocus="">
									</div>
									<div class="form-group col-sm-6">
										<label>Society/ Trust Name :<span style="color:red; font-weight: bold;"> *</span></label>
										<input type="text" class="form-control" name="society" id="society" value="" required="" >
									</div>
								</div>
								<div class="row">
									<div class="form-group col-sm-3">
										<label>List of Society Members :<span style="color:red; font-weight: bold;"> *</span></label>
										<input type="text" class="form-control" name="soc_members" id="soc_members" value="" required="" >
									</div>
									<div class="form-group col-sm-3">
										<label>State Name :<span style="color:red; font-weight: bold;"> *</span></label>
										<input type="text" class="form-control" name="state" id="state" value="" required="" >
									</div>
									<div class="form-group col-sm-3">
										<label>District :<span style="color:red; font-weight: bold;"> *</span></label>
										<input type="text" class="form-control" name="district" id="district" value="" required="" >
									</div>
									<div class="form-group col-sm-3">
										<label>Tehsil/ Block :<span style="color:red; font-weight: bold;"> *</span></label>
										<input type="text" class="form-control" name="tehsil" id="tehsil" value="" required="" >
									</div>
								</div>                
								<div class="row">									
									<div class="form-group col-sm-3">
										<label>Pin Code :<span style="color:red; font-weight: bold;"> *</span></label>
										<input type="number" class="form-control" name="pin" id="pin" value="" required="" >
									</div>
									<div class="form-group col-sm-3">
										<label>Landline No. :</label>
										<input type="number" class="form-control" name="landline" id="landline" value="" required="" >
									</div>
									<div class="form-group col-sm-3">
										<label>Mobile No. :<span style="color:red; font-weight: bold;"> *</span></label>
										<input type="number" class="form-control" name="mobile" id="mobile" value="" required="" >
									</div>
									<div class="form-group col-sm-3">
										<label>Society/ Trust Email :<span style="color:red; font-weight: bold;"> *</span></label>
										<input type="email" class="form-control" name="email" id="email" value="" required="" >
									</div>
								</div>
								<div class="row">
									<div class="form-group col-sm-12">
										<label>Address :<span style="color:red; font-weight: bold;"> *</span></label>
										<textarea class="form-control" name="address" id="address" required=""></textarea>
									</div>
								</div>
								<h5 class="widget-title">Institution Details :-</h5>	
								<div class="row">
									<div class="form-group col-sm-4">
										<label>Name of the institution :<span style="color:red; font-weight: bold;"> *</span></label>
										<input type="text" class="form-control" name="institution" id="institution" value="" required="" >
									</div>
									<div class="form-group col-sm-4">
										<label>Address of the Institution :<span style="color:red; font-weight: bold;"> *</span></label>
										<input type="text" class="form-control" name="address_ins" id="address_ins" value="" required="" >
									</div>
									<div class="form-group col-sm-4">
										<label>State :<span style="color:red; font-weight: bold;"> *</span></label>
										<input type="text" class="form-control" name="state_ins" id="state_ins" value="" required="" >
									</div>
								</div>
								<div class="row">
									<div class="form-group col-sm-4">
										<label>District :<span style="color:red; font-weight: bold;"> *</span></label>
										<input type="text" class="form-control" name="district_ins" id="district_ins" value="" required="" >
									</div>
									<div class="form-group col-sm-4">
										<label>Tehsil :<span style="color:red; font-weight: bold;"> *</span></label>
										<input type="text" class="form-control" name="tehsil_ins" id="tehsil_ins" value="" required="" >
									</div>
									<div class="form-group col-sm-4">
										<label>Pin Code :<span style="color:red; font-weight: bold;"> *</span></label>
										<input type="number" class="form-control" name="pin_ins" id="pin_ins" value="" required="" >
									</div>
								</div>                
								<div class="row">
									<div class="form-group col-sm-3">
										<label>Landline No. :<span style="color:red; font-weight: bold;"> *</span></label>
										<input type="number" class="form-control" name="landline_ins" id="landline_ins" value="" required="" >
									</div>
									<div class="form-group col-sm-3">
										<label>Fax No. :<span style="color:red; font-weight: bold;"> *</span></label>
										<input type="number" class="form-control" name="fax_ins" id="fax_ins" value="" required="" >
									</div>
									<div class="form-group col-sm-3">
										<label>Institution is Under :<span style="color:red; font-weight: bold;"> *</span></label>
										<input type="text" class="form-control" name="ins_under" id="ins_under" value="" required="" >
									</div>
									<div class="form-group col-sm-3">
										<label>Institution Email:<span style="color:red; font-weight: bold;"> *</span></label>
										<input type="email" class="form-control" name="ins_email" id="ins_email" value=""  required="">
									</div>
								</div>
								<h5 class="widget-title">Fee Code/Principal Details :-</h5>	                
								<div class="row">
									<div class="form-group col-sm-4">
										<label>Application ID :<span style="color:red; font-weight: bold;"> *</span></label>
										<input type="text" class="form-control" name="applicant_id" id="applicant_id" required="" value="<?php   //echo  $last_id['id'] + 1;?>" readonly="" >
									</div>
									<div class="form-group col-sm-4">
										<label>Fee Code :<span style="color:red; font-weight: bold;"> *</span></label>
										<input type="text" class="form-control" name="fee_code" id="fee_code" required="" value="" >
									</div>
									<div class="form-group col-sm-4">
										<label>Entry Date :<span style="color:red; font-weight: bold;"> *</span></label>
										<input type="date" class="form-control" name="ent_date" id="ent_date" required="" value="" >
									</div>
								</div>
								<div class="row">
									<div class="form-group col-sm-4">
										<label>Name of the Principal :<span style="color:red; font-weight: bold;"> *</span></label>
										<input type="text" class="form-control" name="principal" id="principal" value="" required="" >
									</div>
									<div class="form-group col-sm-4">
										<label>Email of the Principal :<span style="color:red; font-weight: bold;"> *</span></label>
										<input type="email" class="form-control" name="email_prin" id="email_prin" value="" required="" >
									</div>
									<div class="form-group col-sm-4">
										<label>Landline No. :<span style="color:red; font-weight: bold;"> *</span></label>
										<input type="number" class="form-control" name="landline_prin" id="landline_prin" value="" required="" >
									</div>
								</div>
								<div class="row">
									<div class="form-group col-sm-6">
										<label>Fax No. :<span style="color:red; font-weight: bold;"> *</span></label>
										<input type="number" class="form-control" name="fax_prin" id="fax_prin" value="" required="" >
									</div>
									<div class="form-group col-sm-6">
										<label>Mobile No. :<span style="color:red; font-weight: bold;"> *</span></label>
										<input type="number" class="form-control" name="mobile_prin" id="mobile_prin" value="" required="" >
									</div>
								</div>								
								<div class="row">
									<div class="col-sm-4"></div>
									<div class="col-sm-2">
										<button type="submit" name="save" class="btn btn-success btn-submit btn-block">Save & Next</button>
									</div>
									<div class="col-sm-2">
										<a href="<?php echo base_url('new-affiliation-details');?>" class="btn btn-danger btn-block">Back </a>
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