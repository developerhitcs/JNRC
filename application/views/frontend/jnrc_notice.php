<div class="page-content">
	<!-- inner page banner -->
	<div class="dez-bnr-inr overlay-black-middle" style="background-image:url(<?php echo base_url(); ?>assets/images/nursebanner.jpg);">
		<div class="container">
			<div class="dez-bnr-inr-entry">
				<h1 class="text-white">NOTIFICATIONS</h1>
			</div>
		</div>
	</div>
	<!-- inner page banner END -->
	<!-- Breadcrumb row -->
	<div class="breadcrumb-row">
		<div class="container">
			<ul class="list-inline">
				<li><a href="#">Home</a></li>
				<li>NOTIFICATIONS</li>
			</ul>
		</div>
	</div>
	<!-- Breadcrumb row END -->

	<div class="content-area">
		<div class="container">
			<div class="row">
				<!-- Left part start -->
				<div class="col-md-1"></div>
				<div class="col-md-10">
					<!-- blog start -->
					<div class="blog-post blog-single">



						<div class="dez-post-text">
							<blockquote>NOTIFICATIONS.</blockquote>
							<ul class="list-arrow">
								<li><a href="https://drive.google.com/drive/folders/1zUOnSDo6a-eG2Edcb0uxAEbTDLuNG-L5?usp=sharing" target="_blank"><img src="<?php echo base_url(); ?>assets/img/new-ani.gif" style="width:40px;" /> Learning Resource Package for Integrated CCH (Certificate Course in Community Health ) curriculum for BSc and PBSc Nursing courses.</a></li>
								<?php
								foreach ($row as $key) {
									if ($key['file1'] == null) {
								?>
										<li><a href="javascript:void();" target="_blank"><img src="<?php echo base_url(); ?>assets/img/new-ani.gif" style="width:40px;" /><?php echo $key['notification']; ?></a></li>
									<?php
									} else {
									?>
										<li><a href="<?php echo base_url('uploads/notification/');
																	echo $key['file1']; ?>" target="_blank"><img src="<?php echo base_url(); ?>assets/img/new-ani.gif" style="width:40px;" /><?php echo $key['notification']; ?></a></li>
								<?php
									}
								}
								?>
								<!-- <li>To establish and maintain a uniform standard of nursing education for Nurses, Auxiliary Nurse Midwives and by doing periodical inspection of the institution.</li> -->

							</ul>


						</div>
						<!--<div class="dez-post-media dez-img-effect zoom-slow"> <a href="#"><img src="<?php echo base_url(); ?>assets/images/main-slider/slide6.jpg" alt=""></a> </div>-->

					</div>

				</div>
				<!-- Left part END -->

			</div>
		</div>
	</div>
</div>
