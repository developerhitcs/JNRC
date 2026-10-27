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
				<h1 class="text-white">School & College Renewal</h1>
			</div>
		</div>
	</div>	
	<div class="breadcrumb-row">
		<div class="container">
			<ul class="list-inline">
				<li><a href="<?php echo base_url('');?>">Home</a></li>
				<li>School & College Renewal</li>
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
				<div class="row">
					<div class="col-sm-2"></div>
					<div class="col-sm-8 my_div">
						<div class="row">
							<center><u><h3 style="color: navy;">Renew Affiliation</h3></u></center>							
							<div class="col-sm-6 clg_dash">
								<a href="<?php echo base_url('view_form/10');?>" class='inst btn btn-block'>1. View or Edit Details</a>
							</div>
							<div class="col-sm-6 clg_dash">
								<a href="https://www.onlinesbi.com/sbicollect/icollecthome.htm?corpID=955755" target="_blank" class='inst btn btn-block'>2. Payment Online</a>
							</div>
						</div>
						
						<div class="row"><br>
						<center><a href="<?php echo base_url('inst_after_login');?>" class="btn btn-success btn-sm"><i class="fa fa-arrow-left"></i> Go Back</a></center>
						</div>
						<br>
					</div>
				</div>	
			</div>
		</div>
	</div>
</div>