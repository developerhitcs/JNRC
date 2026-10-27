<div class="page-content">
	<div class="dez-bnr-inr overlay-black-middle" style="background-image:url(<?php echo base_url('assets/images/nursebanner.jpg');?>);">
		<div class="container">
			<div class="dez-bnr-inr-entry">
				<h1 class="text-white">Institution New Affiliation Fourth Step</h1>
			</div>
		</div>
	</div>	
	<div class="breadcrumb-row">
		<div class="container">
			<ul class="list-inline">
				<li><a href="<?php  echo base_url('');?>">Home</a></li>
				<li>Institution New Affiliation Fourth Step</li>
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
							<form action="<?php echo base_url('save_form4');?>" method="POST" enctype='multipart/form-data'>
								<div class="row">
									<div class="col-sm-12 table-responsive">
										<h5 class="widget-title">Clinical Facility Details : -</h5>	
										<div class="row">
											<div class="col-sm-12 table-responsive">
												<table class="table table-bordered" id="result_cnl">
													<thead align="center">
														<tr>
															<td>No.</td>
															<td>Parent Hospital Name</td>
															<td>No. of Beds</td>
															<td>Bed Occupancy</td>
															<td>Receipt of the Hospital</td>
															<td>Permission letter of Hospital for Clinical Exp</td>
															<td>Clinical Experience of the Students</td>
															<td>Entry Date</td>
															<td>Address</td>
															<td>Action</td>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td><input type="text" class="form-control"  value="1." readonly ></td>
															<td><input type="text" class="form-control" name="cli_hosp_name[]" id="cli_hosp_name" value="" required="" ></td>
															<td><input type="text" class="form-control" name="cli_no_of_beds[]" id="cli_no_of_beds" value="" required="" ></td>
															<td><input type="text" class="form-control" name="cli_bed_occupancy[]" id="cli_bed_occupancy" value="" required="" ></td>
															<td><input type="file" class="form-control" name="cli_receipt_hosp_img[]" id="cli_receipt_hosp_img" value="" required="" ></td>
															<td></td>
															<td></td>
															<td><input type="date" class="form-control" name="cli_entry_date[]" id="cli_entry_date" value="" required="" ></td>
															<td><input type="text" class="form-control" name="cli_address[]" id="cli_address" value="" required="" ></td>
															<td><button type="button" class="btn btn-primary" id="add_cnl">Add</button></td>
														</tr>
													</tbody>
												</table>
											</div>																	
										</div>
										
										<h5 class="widget-title">Affiliated Hospital Details : -</h5>
										<div class="row">
											<div class="col-sm-12 table-responsive">
												<table class="table table-bordered" id="result_lab">
													<thead>
														<tr>
															<td>S.No.</td>
															<td>Hospital Name</td>
															<td>No. of Beds</td>
															<td>Bed Occupancy</td>
															<td>Entry Date</td>
															<td>Address</td>
															<td>Action</td>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td><input type="text" class="form-control"  value="1." readonly ></td>
															<td><input type="text" class="form-control" name="hosp_name[]" id="lab_name" value="" required="" ></td>
															<td><input type="text" class="form-control" name="no_of_beds[]" id="lab_size" value="" required="" ></td>
															<td><input type="text" class="form-control" name="bed_occupancy[]" id="no_equp" value="" required="" ></td>
															<td><input type="date" class="form-control" name="entry_date[]" id="no_dum" value="" required="" ></td>
															<td><input type="text" class="form-control" name="address[]" id="ent_date_lab" value="" required="" ></td>
															<td><button type="button" class="btn btn-primary" id="add_lab">Add</button></td>
														</tr>
													</tbody>
												</table>
											</div>																	
										</div>
										
										<h5 class="widget-title">Library Facilities and Declaration Details : -</h5>
										<div class="row"> 
											<div class="col-sm-12"> 
												<table class="table table-bordered">
													<thead>
														<tr>
															<td> Nursing Books</td>
															<td>Anti Ragging & HIV/AIDS/TB Details</td>
															<td>Declaration</td>
															<td>Date and Place</td>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td>Nursing Books<input type="text" class="form-control" name="nurs_books" id="nurs_books" value="" required="" ></td>
															<td>Total Number of students have been trained in HIV/AIDS/TB Module:<input type="text" class="form-control" name="nur_no_hiv" id="nur_no_hiv" value="" required="" ></td>
															<td>Declaration Candidate Name:<input type="text" class="form-control" name="dec_name" id="dec_name" value="" required="" ></td>
															<td>Applicant Name:<input type="text" class="form-control" name="app_dec_name" id="app_dec_name" value="" required="" ></td>
														</tr>
														<tr>
															<td>Number of Nursing Journals Subscribed (National):<input type="text" class="form-control" name="nur_jour_nat" id="nur_jour_nat" value="" required="" ></td>
															<td>Anti Ragging Monitoring Committee, If yes Members & their Mobile Numbers:<input type="text" class="form-control" name="anti_rag" id="anti_rag" value="" required="" ></td>
															<td>S/O, D/O or W/O:<input type="text" class="form-control" name="sodowo" id="sodowo" value="" required="" ></td>
															<td>Date:<input type="date" class="form-control" name="nur_ent" id="nur_ent" value="" required="" ></td>
														</tr>
														<tr>
															<td>Number of Nursing Journals Subscribed (International):<input type="text" class="form-control" name="nur_jour_int" id="nur_jour_int" value="" required="" ></td>
															<td>Anti Ragging Squad, If yes Members & their Mobile Numbers:<input type="text" class="form-control" name="anti_rag_mob" id="anti_rag_mob" value="" required=""></td>
															<td></td>
															<td>Place:<input type="text" class="form-control" name="nur_place" id="nur_place" value="" required="" ></td>
														</tr>
													</tbody>
												 </table>
											</div>
										</div>
										<h5 class="widget-title">Name of the Faculty trained under GFATM Programme Details : -</h5>
										<div class="row"> 
											<div class="col-sm-12"> 
												<table class="table table-bordered" id="result_gfa">
													<thead>
														<tr>
															<td style="width:70px;">S.No.</td>
															<td>Name of the Faculty</td>
															<td>HIV/AIDS</td>
															<td>TB</td>
															<td>Action</td>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td><input type="text" class="form-control"  value="1." readonly ></td>
															<td><input type="text" class="form-control" name="gfa_name[]" id="gfa_name" value="" required="" ></td>
															<td><input type="text" class="form-control" name="gfa_hiv[]" id="gfa_hiv" value="" required="" ></td>
															<td><input type="text" class="form-control" name="gfa_tb[]" id="gfa_tb" value="" required="" ></td>
															<td><button type="button" class="btn btn-primary" id="add_gfatm">Add</button></td>
														</tr>
													</tbody>
												</table>
											</div>
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
var cln = 1;
$("#add_cnl").click(function(){
	cln = cln + 1;
	var app = '<tr id="row'+cln+'"><td><input type="text" name="sl_no[]" class="form-control"   value="'+cln+'" readonly></td><td><input type="text" class="form-control" name="cli_hosp_name[]" id="cli_hosp_name" value="" required="" ></td><td><input type="text" class="form-control" name="cli_no_of_beds[]" id="cli_no_of_beds" value="" required="" ></td><td><input type="text" class="form-control" name="cli_bed_occupancy[]" id="cli_bed_occupancy" value="" required="" ></td><td><input type="file" class="form-control" name="cli_receipt_hosp_img[]" id="cli_receipt_hosp_img" value="" required="" ></td><td></td><td></td><td><input type="date" class="form-control" name="cli_entry_date[]" id="cli_entry_date" value="" required="" ></td><td><input type="text" class="form-control" name="cli_address[]" id="cli_address" value="" required="" ></td><td class="clsrmv_'+cln+'" id="'+cln+'" onclick="remov_cln(this)"><button class="btn btn-danger">Remove</button></td></tr>';
	$("#result_cnl").append(app);
	var rowCountLab = $('#result_cnl tr').length;
	//$("#result3").val(rowCount - 2);
	//$("#autofill_prdct").val('');
});

function remov_cln(arg)
{
	var str = arg.id;
	$(arg).parent('tr').remove();
}
</script>

<script>
var ppl = 1;
$("#add_lab").click(function(){
	ppl = ppl + 1;
	var app = '<tr id="row'+ppl+'"><td><input type="text" name="sl_no[]" class="form-control"   value="'+ppl+'" readonly></td><td><input type="text" name="hosp_name[]" class="form-control" ></td><td><input type="text" name="no_of_beds[]" class="form-control" ></td><td><input type="text" name="bed_occupancy[]" class="form-control" ></td><td><input type="date" name="entry_date[]" class="form-control" ></td><td><input type="text" name="address[]" class="form-control" ></td><td class="clsrmv_'+ppl+'" id="'+ppl+'" onclick="remov_lab(this)"><button class="btn btn-danger">Remove</button></td></tr>';
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
</script>
						
				
               
<script>
var ppg = 1;
$("#add_gfatm").click(function(){
	ppg = ppg + 1;
	var app = '<tr id="row'+ppg+'"><td><input type="text" name="category[]" class="form-control"  id="str_'+ppg+'" value="'+ppg+'" readonly></td><td><input type="text" name="gfa_name[]" class="form-control" id="gfa_name'+ppg+'"></td><td><input type="text" name="gfa_hiv[]" class="form-control" id="gfa_hiv'+ppg+'"></td><td><input type="text" name="gfa_tb[]" class="form-control" id="gfa_tb'+ppg+'"></td><td class="clsrmv_'+ppg+'" id="'+ppg+'" onclick="remov_gfa(this)"><button type="button" class="btn btn-danger" id="add_gfatm">Remove</button></td></tr>';
	$("#result_gfa").append(app);
	var rowCount = $('#result_gfa tr').length;
	//$("#result4").val(rowCount - 2);
	//$("#autofill_prdct").val('');
});

function remov_gfa(arg)
{
	//alert(arg.id);
	var str = arg.id;
  //alert(str);
  $(arg).parent('tr').remove();
}
</script>
