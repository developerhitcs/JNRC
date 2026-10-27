
<style>
.inst 
{
	color: #1167e7;
    box-shadow: 3px 2px 6px 0px;
    padding: 10px;
    border-radius: 50px;
    width: 100%;
	font-weight: 700;
}
.inst:hover 
{
	color: red;
}
.my_div
{
	border: 1px solid black;
	height: auto;
	background-position-x: 0%;
	background-position-y: 0%;
	background-size: auto auto;
	background-size: cover;
	background-position: bottom;
	border-radius: 20px;
}
.clg_dash
{
	padding: 27px;
}
.close-btn
{
	float:right;
	margin-top: -40px;
}

</style>
<div class="page-content">
	<div class="dez-bnr-inr overlay-black-middle" style="background-image:url(<?php echo base_url();?>assets/images/nursebanner.jpg);">
		<div class="container">
			<div class="dez-bnr-inr-entry">
				<h1 class="text-white">Institution Dashboard</h1>
			</div>
		</div>
	</div>
	
	<div class="breadcrumb-row">
		<div class="container">
			<ul class="list-inline">
				<li><a href="<?php echo base_url('');?>">Home</a></li>
				<li>Institution Dashboard</li>
				<li style="float:right;">
					<span style=" color: red;"> Welcome <?php echo $this->session->inst_name;?> !! </span> 
					<a onclick="return confirm('Are you sure you want to logout?')" href="<?php echo base_url('logout_user');?>" class="btn btn-danger btn-round" style=" color: #fff;">Logout</a>
				</li>
			</ul>
		</div>
	</div>
	
	<div class="section-full bg-gray content-inner">
		<div class="container">  
			<div class="section-content">
				<?php foreach($row as $key){}  ?>
				<div class="row">
					<div class="col-sm-1"></div>
					<div class="col-sm-10">
						<?php
						if($this->session->flashdata('data_change_pass'))
						{ 
							?>
							<div class="alert alert-danger alert-dismissible">
								<a href="javascript:void();" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								<center><?php echo $this->session->flashdata('data_change_pass'); ?></center>
							</div>
							<?php 
						} 
						elseif($key['phone']=='' OR $key['email']=='')
						{
							?>
							<div class="alert alert-danger alert-dismissible">
								<a href="javascript:void();" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								<center>Your contact details are not updated !! Please update in Edit School Detail</center>
							</div>
							<?php 
						} 
						else
						{
							?>
							<div class="alert alert-info alert-dismissible" >
								<a href="javascript:void();" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								<a href="<?php echo base_url('how_to_fill_form');?>" target="_blank"><center>Please click here to know 'how to fill form' and 'how to do payment' !</center>
								</a>
							</div>
							<?php 
						}
						?>
					</div>
					<div class="col-sm-1"></div>
				</div>
				<div class="row">
					<div class="col-sm-1"></div>
					<div class="col-sm-10">
						<div class=" my_div">
							<div class="row">
								<div class="col-sm-4 clg_dash ">
									<a href='<?php echo base_url('new-affiliation-details'); ?>' class='inst btn btn-block'>New Affiliation</a>
								</div>
								<?php
								if($affiliation_details > 0)
								{
									?>								
									<div class="col-sm-4 clg_dash">
										<a href='<?php echo base_url('view_institution_renewal_form'); ?>' class='inst btn btn-block'>Renew & View Affiliation</a>
									</div>
									<?php
								}
								else
								{
									?>								
									<div class="col-sm-4 clg_dash">
										<a href='javascript:void();'  onclick="return confirm('Your Affiliation Form Details Not Submitted Yet...! First Fill Your Affiliation Details')" class='inst btn btn-block'>Renew & View Affiliation</a>
									</div>
									<?php
								}
								?>
								<div class="col-sm-4 clg_dash">
									<a href='<?php echo base_url('register_student'); ?>' class='inst btn btn-block'>Student Registration</a>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-4 clg_dash ">
									<a href="javascript:void();" onclick="edit_school_detail()" class='inst btn btn-block'>Edit School Detail</a>
								</div>
								<div class="col-sm-4 clg_dash">
									<a href='<?php echo base_url(); ?>exam_form' class='inst btn btn-block'>Examination Form</a>
								</div>
								<div class="col-sm-4 clg_dash">
									<a href='<?php echo base_url(); ?>get_admit_card' class='inst btn btn-block'>Get Admit Card</a>
								</div>
							</div>
							<div class="row">			
								<div class="col-sm-4 clg_dash ">
									<a href="javascript:void();" onclick="changepwd()" class='inst btn btn-block'>Change Password</a>
								</div>
								<div class="col-sm-4 clg_dash">
									<a href="<?php echo base_url('how_to_fill_form');?>" class='inst btn btn-block'>How to Fill Exam Form?</a>
								</div>
								<div class="col-sm-4 clg_dash">
									<a href="<?php echo base_url('submitted_exam_form');?>" class='inst btn btn-block'>Submitted Exam Form</a>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-1"></div>
				</div>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
function show_year() {
$('#year_row').show(300);
}
function edit_school_detail() {
$('#SchoolDetail').modal('show');
}
function changepwd()
{
$("#change_pwd").modal('show');
}
</script>

<!--Change Password-->
<div id="change_pwd" class="modal" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="blue bigger">Update Password</h4>
				<button type="button" class="close-btn btn btn-sm btn-danger" data-dismiss="modal">&times;</button>				
			</div>
			<div class="modal-body">				
				<form action="<?php echo base_url('change_password');?>" method="post">
					<div class="row">
						<div class="col-xs-12 col-sm-6">
							<input type="hidden" name="edit_wallet_id" id="edit_wallet_id">
							<div class="form-group">
								<label for="form-field-username">Enter Old Password</label>
								<input type="text" id="old_pass"  value="" class="form-control" name="old_pass" />
							</div>
						</div>
						<div class="col-xs-12 col-sm-6">
							<div class="form-group">
								<label for="form-field-username">New Password</label>
								<input type="text" id="new_pass"  value="" class="form-control" name="new_pass"/>
							</div>
						</div>
						<div class="col-xs-12 col-sm-12">
							<div class="form-group">
								<label for="form-field-username">Confirm Password</label>
								<input type="text" id="conf_pass"  value="" class="form-control" name="conf_pass"/>
							</div>
						</div>
						<div class="col-sm-12">
							<button class="btn btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-times"></i>Cancel</button>
							<button type="submit" class="btn btn-sm btn-primary"><i class="ace-icon fa fa-check"></i>Update</button>
						</div>
					</div>
				</form>				
			</div>
		</div>
	</div>
</div>
<!--Change Password Ends-->



<!--School Detail-->
<div id="SchoolDetail" class="modal" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="blue bigger">Update School Details</h4>
				<button type="button" class="close-btn btn btn-sm btn-danger" data-dismiss="modal">&times;</button>				
			</div>
			<div class="modal-body">
				<div class="row">
					<form action="<?php echo base_url('change_school_detail');?>" method="post">
						<div class="col-xs-12 col-sm-6">
							<input type="hidden" name="school_code" id="school_code" value="<?php echo $key['school_code'];?>">
							<div class="form-group">
								<label for="form-field-username">Enter Phone No.</label>
								<input type="text" id="phone"  value="<?php echo $key['phone'];?>" class="form-control" name="phone" />
							</div>
						</div>
						<div class="col-xs-12 col-sm-6">
							<div class="form-group">
								<label for="form-field-username">Enter Email ID</label>
								<input type="email" id="email"  value="<?php echo $key['email'];?>" class="form-control" name="email"/>
							</div>
						</div>
						<div class="col-sm-12">
							<b>NOTE:</b> More than one numbers can be saved.<br><br>
						</div>
						<div class="col-sm-12">
							<button class="btn btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-times"></i>Cancel</button>
							<button type="submit" class="btn btn-sm btn-primary"><i class="ace-icon fa fa-check"></i>Update</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!--Wallet Form Ends-->

