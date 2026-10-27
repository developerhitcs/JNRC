<div class="page-content">
	<div class="dez-bnr-inr overlay-black-middle" style="background-image:url(<?php echo base_url('assets/images/nursebanner.jpg');?>);">
		<div class="container">
			<div class="dez-bnr-inr-entry">
				<h1 class="text-white">Institution New Affiliation Second Step</h1>
			</div>
		</div>
	</div>	
	<div class="breadcrumb-row">
		<div class="container">
			<ul class="list-inline">
				<li><a href="<?php  echo base_url('');?>">Home</a></li>
				<li>Institution New Affiliation Second Step</li>
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
							<form action="<?php echo base_url('affiliation_save_form2');?>" method="POST" enctype='multipart/form-data'>
								<h5 class="widget-title">Program,Seats and Total No. of Admitted Student Details ANM/GNM :-</h5>
								<div class="row">
									<div class="form-group col-sm-4">
										<label>Programme Name :<span style="color:red; font-weight: bold;"> *</span></label>
										<input type="text" class="form-control" name="prog_name" id="prog_name" value=""  required="" >
									</div>
									<div class="form-group col-sm-4">
										<label>Board Name:<span style="color:red; font-weight: bold;"> *</span></label>
										<input type="text" class="form-control" name="board_name" id="board_name" value="" required="" >
									</div>							   
									<div class="form-group col-sm-4">
										<label>School Code :<span style="color:red; font-weight: bold;"> *</span></label>
										<input type="text" class="form-control" name="school_code" id="school_code" value="" required="" >
									</div>
									<div class="form-group col-sm-4">
										<label>Seats :<span style="color:red; font-weight: bold;"> *</span></label>
										<input type="text" class="form-control" name="seats" id="seats" value="" required="" >
									</div>							   
									<div class="form-group col-sm-4">
										<label>No. of Student Admitted in Previous 3 Years :<span style="color:red; font-weight: bold;"> *</span></label>
										<input type="text" class="form-control" name="admitted_previous_3years" id="admitted_previous_3years" value="" required="" >
									</div>
									<div class="form-group col-sm-4">
										<label>No. of Student Admitted :<span style="color:red; font-weight: bold;"> *</span></label>
										<input type="text" class="form-control" name="no_of_student1" id="no_of_student1" value="" required="" >
									</div>
									<div class="form-group col-sm-4">
										<label>No. of Student Admitted :<span style="color:red; font-weight: bold;"> *</span></label>
										<input type="text" class="form-control" name="no_of_student2" id="no_of_student2" value="" required="" >
									</div>
									<div class="form-group col-sm-4">
										<label>No. of Student Admitted :<span style="color:red; font-weight: bold;"> *</span></label>
										<input type="text" class="form-control" name="no_of_student3" id="no_of_student3" value="" required="" >
									</div>
									<div class="form-group col-sm-4">
										<label>Total No. of Student Under Training :<span style="color:red; font-weight: bold;"> *</span></label>
										<input type="text" class="form-control" name="student_under_Training" id="student_under_Training" value="" required="" >
									</div>
								</div>
								<h5 class="widget-title">Laboratory Room Details :-</h5>
								<div class="row">
									<div class="col-sm-12 table-responsive">
										<table class="table table-bordered" id="result_lab">
											<tr>
												<td><strong>S.No.</strong></td>
												<td align="center"><strong>Laboratory Name</strong></td>
												<td align="center"><strong>Size of Laboratory</strong></td>
												<td align="center"><strong>No. of Equipments</strong></td>
												<td align="center"><strong>No. of Dummies & Dolls</strong></td>
												<td align="center"><strong>Entry Date</strong></td>
												<td align="center"><strong>Action</strong></td>
											</tr>
											<tr>
												<td><input type="text" class="form-control"  value="1." readonly ></td>
												<td><input type="text" class="form-control" name="lab_name[]" id="lab_name" value="" required="" ></td>
												<td><input type="text" class="form-control" name="lab_size[]" id="lab_size" value="" required="" ></td>
												<td><input type="text" class="form-control" name="no_equp[]" id="no_equp" value="" required="" ></td>
												<td><input type="text" class="form-control" name="no_dum[]" id="no_dum" value="" required="" ></td>
												<td><input type="date" class="form-control" name="ent_date_lab[]" id="ent_date_lab" value="" required="" ></td>
												<td align="center"><button type="button" class="btn btn-primary" id="add_lab">Add</button></td>
											</tr>
										</table>
									</div>
								</div>
								<h5 class="widget-title">Class Room Details :-</h5>
								<div class="row">
									<div class="col-sm-12 table-responsive">
										<table class="table table-bordered" id="result_cls">
											<tr>
												<td><strong>S.No.</strong></td>
												<td align="center"><strong>Class Utilized for which Program</strong></td>
												<td align="center"><strong>No. of the Class Rooms</strong></td>
												<td align="center"><strong>Size of the Class Rooms</strong></td>												
												<td align="center"><strong>Action</strong></td>												
											</tr>
											<tr>
												<td><input type="text" class="form-control"  value="1." readonly ></td>
												<td><input type="text" class="form-control" name="no_utilized_cls[]" id="no_utilized_cls" value="" required="" ></td>
												<td><input type="text" class="form-control" name="no_cls[]" id="no_cls" value="" required="" ></td>
												<td><input type="text" class="form-control" name="size_cls[]" id="size_cls" value="" required="" ></td>
												<td align="center"><button type="button" class="btn btn-primary" id="add_cls">Add</button></td>
											</tr>
										</table>
									</div>
								</div>
								<h5 class="widget-title">Building and Penalty Details : - </h5>
								<div class="row">
									<div class="col-sm-12">                 
										<div class="table-responsive">
											<table id="building" class="table table-bordered" >
												<tr>
													<td>1.</td>
													<td>
														<label>Online Registration of all the said details on the website for 2016-2017 academic year :<span style="color:red; font-weight: bold;"> *</span></label>
													</td>
													<td>
														<label for="onln_reg1"><input class="form-check-input" type="radio" name="onln_reg" id="onln_reg1" value="Yes" required="" > Yes</label>&nbsp;&nbsp;
														<label for="onln_reg2"><input class="form-check-input" type="radio" name="onln_reg" id="onln_reg2" value="No" required=""> No</label>
													</td>
												</tr>
												<tr>
													<td>2.</td>
													<td>
														<label>General Profile :<span style="color:red; font-weight: bold;"> *</span></label>
													</td>
													<td>
														<label for="general1"><input class="form-check-input" type="radio" name="general" id="general1" value="Yes" required="" > Yes</label>&nbsp;&nbsp;
														<label for="general2"><input class="form-check-input" type="radio" name="general" id="general2" value="No" required=""> No</label>
													</td>
												</tr>
												<tr>
													<td>3.</td>
													<td>
														<label>Physical :<span style="color:red; font-weight: bold;"> *</span></label>
													</td>
													<td>
														<label for="physical1"><input class="form-check-input" type="radio" name="physical" id="physical1" value="Yes" required=""> Yes</label>&nbsp;&nbsp;
														<label for="physical2"><input class="form-check-input" type="radio" name="physical" id="physical2" value="No" required=""> No</label>
													</td>
												</tr>
												<tr>
													<td>4.</td>
													<td>
														<label>Clinical :<span style="color:red; font-weight: bold;"> *</span></label>
													</td>
													<td>
														<label for="clinical1"><input class="form-check-input" type="radio" name="clinical" id="clinical1" value="Yes"> Yes</label>&nbsp;&nbsp;
														<label for="clinical2"><input class="form-check-input" type="radio" name="clinical" id="clinical2" value="No"> No</label>
													</td>
												</tr>
												<tr>
													<td>5.</td>
													<td>
														<label>Admission :<span style="color:red; font-weight: bold;"> *</span></label>
													</td>
													<td>
														<label for="admission1"><input class="form-check-input" type="radio" name="admission" id="admission1" value="Yes" required=""> Yes</label>&nbsp;&nbsp;
														<label for="admission2"><input class="form-check-input" type="radio" name="admission" id="admission2" value="No" required=""> No</label>
													</td>
												</tr>
												<tr>
													<td >6.</td>
													<td>
														<label>Teachers :<span style="color:red; font-weight: bold;"> *</span></label>
													</td>
													<td>
														<label for="teachers1"><input class="form-check-input" type="radio" name="teachers" id="teachers1" value="Yes" required="" > Yes</label>&nbsp;&nbsp;
														<label for="teachers2"><input class="form-check-input" type="radio" name="teachers" id="teachers2" value="No" required=""> No</label>
													</td>
												</tr>
												<tr>
													<td >7.</td>
													<td>
														<label>Previous year annual fee paid :<span style="color:red; font-weight: bold;"> *</span></label>
													</td>
													<td>
														<input class="form-control" type="text" name="pre_year" id="pre_year"  required="">
													</td>
												</tr> 
												<tr>
													<td >8.</td>
													<td>
														<label>Current year annual fee Rs.25000 (JNRC) :<span style="color:red; font-weight: bold;"> *</span></label>
													</td>
													<td>
														<input class="form-control" type="text" name="curr_year" id="curr_year" required="" >
													</td>
												</tr> 
												<tr>
												<tr>
													<td >9.</td>
													<td>
														<label>Challan Attachment :<span style="color:red; font-weight: bold;"> *</span></label>
													</td>
													<td>
														<input class="form-control" type="file" name="challan_attach" id="curr_year" required="" >
													</td>
												</tr> 
												<tr>
													<td >10.</td>
													<td>
														<label>Building Status :<span style="color:red; font-weight: bold;"> *</span></label>
													</td>
													<td>
														<input class="form-control" type="text" name="building" id="building" required="">
													</td>
												</tr>
												<tr>
													<td>11.</td>
													<td>
														<label>Location (Institution's full address) of the building :<span style="color:red; font-weight: bold;"> *</span></label>
													</td>
													<td>
														<textarea class="form-control" name="loc_full_address" id="loc_full_address" required=""></textarea>
													</td>
												</tr>
												<tr>
													<td >12.</td>
													<td>
													<label>Total area of the building :<span style="color:red; font-weight: bold;"> *</span></label>
													</td>
													<td>
														<input class="form-control" type="text" name="tot_area" id="tot_area" required="">
													</td>
												</tr>
												<tr>
													<td >13.</td>
													<td>
														<label>Blueprint should be signed by the authority :<span style="color:red; font-weight: bold;"> *</span></label>
													</td>
													<td>
														<input class="form-control" type="file" name="blueprint" id="blueprint" required="">
													</td>
												</tr>
												<tr>
													<td >14.</td>
													<td>
														<label>In whose name the building/land is registered :<span style="color:red; font-weight: bold;"> *</span></label>
													</td>
													<td>
														<input class="form-control" type="text" name="build_name" id="build_name" required="">
													</td>
												</tr>
												<tr>
													<td >15.</td>
													<td>
														<label>Building completion certificate/ Building status report attested by registered architect with valid registration number as per INC cercular dated 10.03.2016 along with the following details :<span style="color:red; font-weight: bold;"> *</span></label>
													</td>
													<td>Upload Certificate  <input type="file" class="form-control" name="build_cert_img" required="">
													</td>
												</tr>						
											</table>
										</div>
									</div>
								</div>
								<h5 class="widget-title">Penalty Details : - </h5>
								<div class="row">
									<div class="col-sm-12">                 
										<div class="table-responsive">
											<table id="building" class="table table-bordered">                    
												<tr>
													<td >1.</td>
													<td>
														<label>If, Penalty of the building asked during 2016-2017 then submit the D.D. of Penalty in form of "Secretary, Jharkhand Nursing Council, Ranchi" :<span style="color:red; font-weight: bold;"> *</span></label>
													</td>
													<td>
														<label for="penalty1"><input class="form-check-input" type="radio" name="penalty" id="penalty1" value="Yes" required=""> Yes</label>&nbsp;&nbsp;
														<label for="penalty2"><input class="form-check-input" type="radio" name="penalty" id="penalty2" value="No" required=""> No</label>
													</td>
												</tr>
												<tr>
													<td>2.</td>
													<td>
														<label>Demand Draft(DD) Number :<span style="color:red; font-weight: bold;"> *</span></label>
													</td>
													<td>
														<input class="form-control" type="text" name="dd_number" id="dd_number"required="" >
													</td>
												</tr>
												<tr>
													<td>3.</td>
													<td>
														<label>Demand Draft(DD) Attachment :<span style="color:red; font-weight: bold;"> *</span></label>
													</td>
													<td>
														<input  type="file"  class="form-control" name="demand_draft_img" id="demand_draft" required="" > Upload Demand Draft
													</td>
												</tr>
												<tr>
													<td>4.</td>
													<td>
														<label>Demand Draft(DD) Date :<span style="color:red; font-weight: bold;"> *</span></label>
													</td>
													<td>
														<input class="form-control" type="date" name="dd_date" id="dd_date" required="" >
													</td>
												</tr>
												<tr>
													<td>5.</td>
													<td>
														<label>Built-up area of Teaching Block  :<span style="color:red; font-weight: bold;"> *</span></label>
													</td>
													<td>
														<input class="form-control" type="text" name="build_area" id="build_area" required="" >
													</td>
												</tr>
												<tr>
													<td >6.</td>
													<td>
														<label>Built-up area of Hostel Block :<span style="color:red; font-weight: bold;"> *</span></label>
													</td>
													<td>
														<input class="form-control" type="text" name="build_hostel" id="build_hostel" required="" >
													</td>
												</tr>
												<tr>
													<td >7.</td>
													<td>
														<label>Entry Date :<span style="color:red; font-weight: bold;"> *</span></label>
													</td>
													<td>
														<input class="form-control" type="date" name="ent_date_pen" id="ent_date_pen" required="" >
													</td>
												</tr>
												<tr>
													<td >8.</td>
													<td>
														<label>Two photographs of the complete building taken from different angle duly certificate by the architect :<span style="color:red; font-weight: bold;"> *</span></label>
													</td>
													<td>
														<input  type="file" class="form-control" name="build_img_1" id="build_1" required="" ><br>
														<input  type="file" class="form-control" name="build_img_2" id="build_2" required="" >
													</td>
												</tr>
											</table>
										</div>
									</div>
								</div> 
								<div class="row">
									<div class="col-sm-5"></div>
									<div class="wizard-buttons  col-sm-3">
										<button type="submit" name="save" class="btn btn-success btn-submit">Save & Next</button>									
										<a href="<?php echo base_url('new-affiliation-details');?>" class="btn btn-danger">Back</a>
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
			
			
<script>
var ppl = 1;
$("#add_lab").click(function(){
	ppl = ppl + 1;
	var app = '<tr id="row'+ppl+'"><td><input type="text" name="sl_no[]" class="form-control"  id="sl_no_'+ppl+'" value="'+ppl+'" readonly></td><td><input type="text" name="lab_name[]" class="form-control" id="lab_name_'+ppl+'"></td><td><input type="text" name="lab_size[]" class="form-control" id="lab_size_'+ppl+'"></td><td><input type="text" name="no_equp[]" class="form-control" id="no_equp_'+ppl+'"></td><td><input type="text" name="no_dum[]" class="form-control" id="no_dum_'+ppl+'"></td><td><input type="date" name="ent_date_lab[]" class="form-control" id="ent_date_lab_'+ppl+'"></td><td class="clsrmv_'+ppl+'" id="'+ppl+'" onclick="remov_lab(this)"><button class="btn btn-danger">Remove</button></td></tr>';
	$("#result_lab").append(app);
	var rowCountLab = $('#result_lab tr').length;
	//$("#result3").val(rowCount - 2);
	//$("#autofill_prdct").val('');
});

function remov_lab(arg)
{
	//alert(arg.id);
	var str = arg.id;
	//alert(str);
	 $(arg).parent('tr').remove();
}

/// class room details


var ppc = 1;
$("#add_cls").click(function(){
	ppc = ppc + 1;
	var app = '<tr id="row'+ppc+'"><td><input type="text" name="sl_no[]" class="form-control"  id="sl_no_'+ppc+'" value="'+ppc+'" readonly></td><td><input type="text" class="form-control" name="no_utilized_cls[]" id="no_utilized_cls_'+ppc+'" value="" ></td><td><input type="text" name="no_cls[]" class="form-control" id="no_cls_'+ppc+'"></td><td><input type="text" name="size_cls[]" class="form-control" id="size_cls'+ppc+'"></td><td class="clsrmv_'+ppc+'" id="'+ppc+'" onclick="remov_cls(this)"><button class="btn btn-danger">Remove</button></td></tr>';
	$("#result_cls").append(app);
	var rowCountcls = $('#result_cls tr').length;
	
});

function remov_cls(arg)
{
	//alert(arg.id);
	var str = arg.id;
	//alert(str);
	 $(arg).parent('tr').remove();
}
</script>