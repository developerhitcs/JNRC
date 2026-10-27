<style>
.title-margin
{
	
    padding-bottom: 5px;
    border-bottom: 1px dashed  #c3c3c3;
    text-align: left;
	font-family: cursive;
}
</style>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<?php
				if (isset($_SESSION['errmsg'])) 
				{
					?>
					<div class="alert alert-<?php echo $_SESSION['msg']; ?> alert-dismissible">
						<strong><?php echo $_SESSION['errmsg']; ?></strong>
						<button type="button" class="btn btn-danger btn-sm" data-dismiss="alert" aria-label="Close" style="float:right;margin-top:-5px;"><span aria-hidden="true">&times;</span></button>  
					</div>
					<?php
					unset($_SESSION['msg']);
					unset($_SESSION['errmsg']);
				}
				?>
			</div>
		</div> 
		<?php foreach($institution_details as $key) {} ?>
		<div class="row">
			<div class="col-md-12">  
				<div class="card">
					<div class="card-header-info">
						<span>Certification Details</span>		
					</div>	
					<div class="card-body">						
						<h4 class="card-title title-margin">School Name : <?php echo $key['school_name']; ?></h4>
						<h4 class="card-title title-margin">School Code : <?php echo $key['school_code']; ?></h4>						
						<h4 class="card-title title-margin">School Seat : <?php echo $key['seat']; ?></h4>						
						<h4 class="card-title title-margin">Contntent Type : <?php echo $key['course_type']; ?></h4>						
						<h4 class="card-title title-margin">Mobile Number : <?php echo $key['phone']; ?></h4>						
						<h4 class="card-title title-margin">Email-Id : <?php echo $key['email']; ?></h4>						
						<h4 class="card-title title-margin">Address : <?php echo $key['address']; ?></h4>
						<br>
						<h4 class="card-title title-margin">Certification Status : 
							<?php
							if($key['renewal_status']=='Active')
							{
								?>
								<span class="badge badge-success"><?php echo $key['renewal_status'];?></span>
								<?php
							}
							else
							{
								?>
								<span class="badge badge-danger"><?php echo $key['renewal_status'];?></span>
								<?php
							}
							?>
						</h4>
						<h4 class="card-title title-margin">Certification Renewal Date   : <?php echo $key['renewal_date']; ?></h4>
						<h4 class="card-title title-margin">Certification Expiry Date  : <?php echo $key['renewal_expiry_date']; ?></h4>
						
						<h4 class="card-title title-margin">Ceritificate:</h4>
						<a href="<?php echo base_url('uploads_affliation/certificate/'); echo $key['renewal_ceritificate']; ?>" target="_blank">
							<img src="<?php echo base_url('uploads_affliation/certificate/'); echo $key['renewal_ceritificate']; ?>" class="img-thumbnail" style="height:100px;">
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


