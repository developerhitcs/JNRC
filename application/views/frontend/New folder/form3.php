<div class="page-content">
	<div class="dez-bnr-inr overlay-black-middle" style="background-image:url(<?php echo base_url('assets/images/nursebanner.jpg');?>);">
		<div class="container">
			<div class="dez-bnr-inr-entry">
				<h1 class="text-white">Institution New Affiliation Third Step</h1>
			</div>
		</div>
	</div>	
	<div class="breadcrumb-row">
		<div class="container">
			<ul class="list-inline">
				<li><a href="<?php  echo base_url('');?>">Home</a></li>
				<li>Institution New Affiliation Third Step</li>
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
							<form action="<?php echo base_url('save_form3');?>" method="POST" enctype='multipart/form-data'>
								<h5 class="widget-title">Teaching Faculty Details : -</h5>
							
								<div class="row">
									<div class="col-sm-12">
										<table class="table table-bordered" id="result_faculty">
											<thead>
												<tr>
													<th>S.No.</th>
													<th>Faculty Name, Gender, Designation & Qualification</th>
													<th>Institute Name, Passing Year, Date of Joining and Qualification Certificatre</th>
													<th>RN/RM Number, RN/RM Certificate,NUID No. and Entry Date</th>
													<th>Teaching Experience and Faculty Image</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td><input type="text" class="form-control"  value="1." readonly ></td>
													<td>Faculty Name<input type="text" class="form-control" name="fac_name[]" id="fac_name" value="" required="" ></td>
													<td>Institute Name<input type="text" class="form-control" name="fac_inst[]" id="fac_inst" value="" required="" ></td>
													<td>RN/RM Number:<input type="text" class="form-control" name="fac_r_num[]" id="fac_r_num" value="" required="" ></td>
													<td>UG Teaching Exp.:<input type="text" class="form-control" name="fac_ug[]" id="fac_ug" value="" required="" ></td>
													<td><a class="btn btn-primary pull-right" id="add_faculty" data-added="0"><i class="glyphicon glyphicon-plus"></i> Add </a></td>
												</tr>
												<tr>
													<td></td>
													<td>Gender<input type="text" class="form-control" name="fac_gen[]" id="fac_gen" value="" required="" ></td>
													<td>Passing Year<input type="text" class="form-control" name="fac_pass[]" id="fac_pass" value="" required="" ></td>
													<td>RN/RM Certificate : <input type="text" class="form-control" name="rn_rm_certified[]" id="rn_rm_certified" value="" required="" > </td>
													<td>PG Teaching Exp.:<input type="text" class="form-control" name="fac_pg[]" id="fac_pg" value="" required="" ></td>
													<td></td>
												</tr>
												<tr>
													<td></td>
													<td>Designation<input type="text" class="form-control" name="fac_des[]" id="fac_des" value="" required="" ></td>
													<td>Date of Joining<input type="date" class="form-control" name="fac_join[]" id="fac_join" value="" required="" ></td>
													<td>Aadhar Number<input type="text" class="form-control" name="fac_adhr[]" id="fac_adhr" value="" required="" ></td>
													<td>Diploma Teaching Exp.:<input type="text" class="form-control" name="fac_dip[]" id="fac_dip" value="" required="" ></td>
													<td></td>
												</tr>
												<tr>
													<td></td>
													<td>Qualification<input type="text" class="form-control" name="fac_qual[]" id="fac_qual" value="" required="" ></td>
													<td>Qualification Certificate:</br><input type="file" class="form-control" name="qual_cert[]" id="qual_cert" required=""></td>
													<td>Entry Date:<input type="date" class="form-control" name="fac_ent[]" id="fac_ent" value="" required="" ></td>
													<td>Faculty Image:
													  <input type="file" class="form-control" name="fac_img[]" id="fac_img" value="Upload" required="" ></td>
													  <td></td>
												</tr>
											</tbody>
										</table>									 
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
var ppf = 1;
$("#add_faculty").click(function(){
	ppf = ppf + 1;
	var app = '<tr id="rowf'+ppf+'"><td ><input type="text" name="sl_no[]" class="form-control"  id="slno_'+ppf+'" value="'+ppf+'" readonly></td><td>Faculty Name<input type="text" name="fac_name[]" class="form-control" id="fac_name'+ppf+'"></td><td>Institute Name<input type="text" name="fac_inst[]" class="form-control" id="fac_inst'+ppf+'"></td><td>RN/RM Number:<input type="text" name="fac_r_num[]" class="form-control" id="fac_r_num'+ppf+'"></td><td>UG Teaching Exp.:<input type="text" name="fac_ug[]" class="form-control" id="fac_ug'+ppf+'"></td><td class="clsrmv_'+ppf+'" id="'+ppf+'" onclick="remov_faculty(this)"><button class="btn btn-danger">Remove</button></td></tr><tr id="rowf1'+ppf+'"><td></td><td>Gender<input type="text" name="fac_gen[]" class="form-control" id="fac_gen'+ppf+'"></td><td>Passing Year<input type="text" name="fac_pass[]" class="form-control" id="fac_pass'+ppf+'"></td><td>RN/RM Certificate:</br>Please attach certificate with the documents</td><td>PG Teaching Exp.:<input type="text" name="fac_pg[]" class="form-control" id="fac_pg'+ppf+'"></td><td class="clsrmv_'+ppf+'" id="'+ppf+'" onclick="remov(this)"></td></tr><tr id="rowf2'+ppf+'"><td></td><td>Designation<input type="text" name="fac_des[]" class="form-control" id="fac_des'+ppf+'"></td><td>Date of Joining<input type="date" name="fac_join[]" class="form-control" id="fac_join'+ppf+'"></td><td>Aadhar Number:<input type="text" name="fac_adhr[]" class="form-control" id="fac_adhr'+ppf+'"></td><td>Diploma Teaching Exp.:<input type="text" name="fac_dip[]" class="form-control" id="fac_dip'+ppf+'"></td><td class="clsrmv_'+ppf+'" id="'+ppf+'" onclick="remov(this)"></td></tr><tr id="rowf3'+ppf+'"><td></td><td>Qualification<input type="text" name="fac_qual[]" class="form-control" id="fac_qual'+ppf+'"></td><td>Qualification Certificate:</br><input type="file" class="form-control" name="qual_cert[]" id="qual_cert'+ppf+'"></td><td>Entry Date:<input type="date" name="fac_ent[]" class="form-control" id="fac_ent'+ppf+'"></td><td>Faculty Image:</br><input type="file" class="form-control"  name="fac_img[]" id="fac_img" value="Upload" ></td><td></td></tr>';
	$("#result_faculty").append(app);
	var rowCount = $('#result_faculty tr').length;
	$("#result3").val(rowCount - 2);
	$("#autofill_prdct").val('');
});

function remov_faculty(arg)
{
	//alert(arg.id);
	var str2 = arg.id;
//alert(str2);
 // $(arg).parent('tr').remove();
 $('#rowf'+str2).remove();
 $('#rowf1'+str2).remove();
 $('#rowf2'+str2).remove();
 $('#rowf3'+str2).remove();
 
}
</script>