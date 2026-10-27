<div class="page-content">
        <!-- inner page banner -->
        <div class="dez-bnr-inr overlay-black-middle" style="background-image:url(<?php echo base_url();?>assets/images/nursebanner.jpg);">
            <div class="container">
                <div class="dez-bnr-inr-entry">
                    <h1 class="text-white">Gallery</h1>
                </div>
            </div>
        </div>
        <!-- inner page banner END -->
        <!-- Breadcrumb row -->
        <div class="breadcrumb-row">
            <div class="container">
                <ul class="list-inline">
                    <li><a href="#">Home</a></li>
                    <li>Gallery</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb row END -->

        <div class="content-area">
            <div class="container">
                <div class="row">
                    <!-- Left part start -->
                    <div class="col-md-12">
                        <!-- blog start -->
                        <div class="blog-post blog-single">
                          
	
                            
                            <div class="dez-post-text">
								
								<?php
								foreach($gallery as $g)
								{
									?>
									<div class="col-md-4" style="margin-top:20px;">
										<img src="<?php echo $g['img1'] ?>">
									</div>
									<?php
								}
								?>
							
								<!--<div class="col-md-4">
									<img src="<?php echo base_url();?>assets/images/main-slider/slide6.jpg">
								</div>
								<div class="col-md-4">
									<img src="<?php echo base_url();?>assets/images/main-slider/slide7.jpg">
								</div>
								<div class="col-md-4">
									<img src="<?php echo base_url();?>assets/images/main-slider/slide8.jpg">
								</div>
								
								<div class="col-md-4">
									<img src="<?php echo base_url();?>assets/images/main-slider/slide9.jpg">
								</div>
								<div class="col-md-4">
									<img src="<?php echo base_url();?>assets/images/main-slider/slide10.jpg">
								</div>
								<div class="col-md-4">
									<img src="<?php echo base_url();?>assets/images/main-slider/slide7.jpg">
								</div>-->
                               
                            </div>
                          
                        </div>
                        
                    </div>
                    <!-- Left part END -->
                   
                </div>
            </div>
        </div>
    </div>
    <!-- Content END-->
    <style>
.noc {}

.nom {
    padding-left: 0;
    padding-right: 0;
}
p{text-align:justify;}
.scroll {
    margin: 0;
    padding: 7px;
    text-align: center;
    color: red;
}
</style>
    <style>
    .dez-bnr-inr {
    height: 135px;
    background-position: 0px 0px;
    }
    .side-bar .widget {box-shadow: none;}


</style>