
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
	<div class="dez-bnr-inr overlay-black-middle" style="background-image:url(<?php echo base_url('assets/images/nursebanner.jpg');?>);">
		<div class="container">
			<div class="dez-bnr-inr-entry">
				<h1 class="text-white">Institution New Affiliation</h1>
			</div>
		</div>
	</div>
	
	<div class="breadcrumb-row">
		<div class="container">
			<ul class="list-inline">
				<li><a href="<?php  echo base_url('');?>">Home</a></li>
				<li>Institution New Affiliation</li>
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
					<div class="col-sm-1"></div>
					<div class="col-sm-10">	
						<div class="my_div">	
							<h3 class="text-center"><u>  Complete the whole proccess for new institution  affiliation  </u></h3>
							<div class="row">
								<div class="col-sm-6 clg_dash">
									<a href="<?php echo base_url('new-affiliation-form1');?>" class='inst btn btn-block' >1. Institution, Society/Trust/Mission Details</a>
								</div>
								<div class="col-sm-6 clg_dash">
									<a href="<?php echo base_url('form2');?>" class='inst btn btn-block' >2. Seat Availability and Other Details</a>
								</div>
								<div class="col-sm-4 clg_dash">
									<a href="<?php echo base_url('form3');?>" class='inst btn btn-block' >3. Teaching Faculty Details</a>
								</div>	
								<div class="col-sm-4 clg_dash">
									<a href="<?php echo base_url('form4');?>" class='inst btn btn-block' >4. Clinical Facility & Other Details</a>
								</div>
								<div class="col-sm-4 clg_dash">
									<a href="https://www.onlinesbi.com/sbicollect/icollecthome.htm?corpID=955755" target="_blank" class='inst btn btn-block' >5. Make Payment Online</a>
								</div>
							</div>						
							<div class="row">
								<center><a href="<?php echo base_url('inst_after_login');?>" class="btn btn-success btn-sm"><i class="fa fa-arrow-left"></i> Go Back</a></center><br>
							</div>						
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
