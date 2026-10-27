	<div class="row">
		<div class="col-sm-3"></div>
		<div class="col-sm-6">
			<?php  
                foreach ($appl_id as $appl_id) { }                              
            ?> 
	<center><img src="<?php echo base_url();?>assets/images/Approve_icon.svg" style="width:150px; height:150px;">
		<h3 style="color:green;" >SUCCESS !</h3></br></center>
		<p style="text-align:center">Thank you <span style="font-weight: bold;"><?php 
			echo $appl_id['institution'];
		?></span> for Registration !! Your Affiliation process is completed.. </br>Your Registration No. is <span style="font-weight: bold;"><?php 
			echo $appl_id['id'];
		?></span></br> Please keep it for your future references..<br> <a href="<?php echo base_url();?>" style="font-weight: bold; color:green; ">Back to home</a></p>
		
		<!-- <a href="admit_card.php?<?php echo $send;?>=<?php echo $last_id;?>" style="color:red; font-weight: bold;" target="_blank">
			<u>Download Admit Card</u></a> -->
		
</div>
</div>