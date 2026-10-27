	<div class="row">

		<div class="col-sm-3"></div>

		<div class="col-sm-6">

			 <?php  

                foreach ($row as $key) { }                              

            ?>  

	<center><img src="<?php echo base_url();?>assets/images/Approve_icon.svg" style="width:150px; height:150px;">

		<h3 style="color:green;" >SUCCESS !</h3></br></center>

		<p style="text-align:center">Thank you <span style="font-weight: bold;"> <?php 

			echo $key['name'];

		?> </span> for Renewal !!  </br>Your Reference No. is <b><?php echo $key['ref_no'];?><b><span style="font-weight: bold;"><!-- <?php 

			echo $appl_id['id'];

		?> --></span></br> Please keep it for your future references..<br>

		<!-- </br>Note: This is <b>NOT</b> roll no. It's only for reference purpose<br> -->

		<!-- <form action="<?php echo base_url('show_admit_card');?>" method="post">

			<input type="hidden" name="course" value="<?php echo $key['course'];?>"> 

			<input type="hidden" name="dob" value="<?php echo $key['dob'];?>"> 

			<input type="hidden" name="aadhar" value="<?php echo $key['aadhar'];?>"> 

			<button type="submit">Click here to get admit card.</button>

			</form> -->

		<a href="<?php echo base_url('student_renewal');?>" style="font-weight: bold; color:green; ">Back to Form</a>

		
		<br>
		<br>
		 <a href="<?php echo base_url('get_renewal_form/').$key['ref_no'];?>" target="_blank" class="btn btn-danger">Print Renewal Form</a></p>

			<!--<u>Download Admit Card</u></a> -->

		

</div>

</div>