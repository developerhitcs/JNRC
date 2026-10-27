<!DOCTYPE html>
<html>
<head>
	<title> Admit Card </title>
	<style>
		table 
		{
			font-family: centuery;
			width: 100%;
		}

		td, th 
		{
			padding: 5px;			
		}
		p
		{
			font-family: centuery;
			margin:15px 0px;			
		}
	</style>
</head>
<body>
	<?php 
	foreach ($row as $key) 
	{	
		?>
		<center>
			<h2 id="yourStyle">JHARKHAND NURSES REGISTRATION COUNCIL </h2>
			<img src="<?php echo $_SERVER["DOCUMENT_ROOT"].'/assets/images/logo_pdf.jpg';?>" >
			<h4 style="margin-top: -0px"><u>ADMIT CARD</u></h4>
		</center> 
		<div class="row">
			<table style="width: 100%;" border="1" cellspacing="0">
				<thead>
					<tr>
						<td>
							<p>
								<span style="float:left;"><b>Roll No.</b> <?php echo $key['admit_card_roll_no'];?></span> 
								<span style="float:right;"> <b>Ref No.</b> <?php echo $key['ref_no'];?></span> 
								<br>
								<div style="margin:5px 0px;"></div>
								Miss/Mrs./Mr. <b><?php echo $key['name'];?></b> S/o, D/o Shri <b><?php echo $key['father_name'];?></b> born on <?php echo $key['dob'];?> is allowed to appear at the 
								<b><?php echo $key['course'];?></b> Examination to be held on <b><?php echo $key['batch_session'];?></b> at Centre
								<br><br><br>
								from School of Nursing <b><?php echo $key['train_school'];?></b>. 
								<br>
							</p>
						</td> 
						<td>
							<div style="float:right">
								<img src="<?php echo $_SERVER['DOCUMENT_ROOT'].'/uploads/exam_form/'.$key['reff_no'].'/'.$key['img1']; ?>" style=" width:130px; height: 120px;">
								<br> <span style="padding:5px 0px;">Photo of Candidate</span>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<center><b>SUBJECT & DATE OF EXAMINATION</b></center><br>
							<?php
							foreach ($subject_row as $k) 
							{
								if($key['course']==$k['course'])
								{
									echo $k['subject_list'];
								}
							}
							?>
						</td>
						<td>
							<div style="float:right">
								<img src="<?php echo $_SERVER['DOCUMENT_ROOT'].'/uploads/exam_form/'.$key['reff_no'].'/'.$key['img2']; ?>" style=" width:150px; height: 50px;">
								<br>Signature of Candidate	
							</div>
						</td>
					</tr>
				</thead>
			</table>
		</div>
		<?php
	}
	?>

		
	<table style="width: 100%; margin-top:50px;">
		<tr>
			<td>Signature of Candidate</td>
			<td style="text-align:center;">Signature of Principal</td>
			<td style="text-align:right;">Signature of Director/ Superitendent/Civil Surgeon</td> 
		</tr> 
		<tr>
			<td></td>
			<td></td>
			<td style="text-align:right;padding-top: 50px;padding-bottom:10px;">Signature of Registrar</td>
		</tr>	
	</table>
	<hr>
	<table style="width: 100%;">
		<tr>
			<td valign="top"><i>Note:<i></td>
			<td colspan="2"><i>The result of the examination of the candidates will be communicated to the Institution concerned from the office of the Jharkhand Nurses Registration Council as soon as the result is approved and published.</i></td>
		</tr>
	</table>

	<div style="page-break-before:always">&nbsp;</div>
	<table style="width: 100%; text-align:justify;" border="1" cellspacing="0">
		<tbody>
			<tr>
				<td align="center"><b>Instructions</b></td>
			</tr>
			<tr>
				<td>
					<p>1. Candidate is required to show her Admit Card to the Centre Superintendent or Invigilator appointed by the JNRC, Ranchi before entering the examination hall. </p>
					<p>2. Candidates will take their seats five minutes before the time fixed for the examination. A candidate coming later than thirty minutes of the starting of examination shall not be allowed to appear.</p>
					<p>3. Candidate shall not write anything on the question paper. </p>
					<p>4. Candidates are not allowed to bring note books, text books, any electronic device and paper of any kind into the examination hall. </p>
					<p>5. No candidate will be allowed to leave the room within an hour after the distribution of question papers. </p>
					<p>6. Only after examination, candidate shall take question paper outside the hall. No other types of paper shall be removed from the hall. </p>
					<p>7. Any student disobeying these rules shall be liable for disqualification. </p>
					<p>8. Complaints, if any, should be submitted within thirty days of the publication of result through the training Institution.</p>
					<p>9.  Any particulars concerning training submitted by the candidate or Institution on the examination applications or any other correspondence concerning examination, found incorrect, the candidate shall be liable to be disqualified from appearing at the examination or cancellation of examination. </p>
					<p>10. Any candidate found using unfair or illegal means during examination shall be liable to be debarred and rusticated from appearing at three consecutive examination.</p>
				</td>
			</tr>
		</tbody>
	</table> 
</body>
</html>