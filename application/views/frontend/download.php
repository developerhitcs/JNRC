<div class="page-content">
	<!-- inner page banner -->
	<div class="dez-bnr-inr overlay-black-middle" style="background-image:url(<?php echo base_url();?>assets/images/nursebanner.jpg);">
		<div class="container">
			<div class="dez-bnr-inr-entry">
				<h1 class="text-white">Download </h1>
			</div>
		</div>
	</div>
	<!-- inner page banner END -->
	<!-- Breadcrumb row -->
	<div class="breadcrumb-row">
		<div class="container">
			<ul class="list-inline">
				<li><a href="#">Home</a></li>
				<li>Download </li>
			</ul>
		</div>
	</div>
	<!-- Breadcrumb row END -->	
	<div class="section-full bg-gray content-inner">
		<div class="container">  
			<div class="section-content">
				<div class="row">					
					<div class="post card-container col-lg-12">
						<div class="widget bg-white p-a20 widget_services">
							<h5 class="widget-title">Download Offline Forms</h5>							
							<ul>
								<?php 
								foreach ($row as $key) 
								{ 
									?>
									<li>
										<?php echo $key['title']; ?>
										<a href="<?php echo base_url(); echo $key['document'];?>" target='_blank' style="float:right;">Download</a>
									</li>
									<?php 
								} 
								?>
							</ul>
						</div>	
					</div>
				</div>
			</div>
		</div>
	</div>
</div>			
