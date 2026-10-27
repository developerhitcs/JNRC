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
			padding: 2px;			
		}
		body {  
         font-size: 14px;
}

	</style>
</head>
<body>
    <?php
// Normalize subject name to ensure consistent comparison
function normalize_subject($subject) {
    // Replace en dash, em dash, and other similar characters
    $subject = str_replace(['–', '—', 'â€“'], '-', $subject);
    $subject = trim(preg_replace('/\s+/', ' ', $subject)); // remove extra spaces
    return strtolower($subject); // optional case-insensitive match
}
?>

<?php foreach ($row as $key ) 
{
	?>
	<center>
		<h2 id="yourStyle" style="padding-top: -55px">JHARKHAND NURSES REGISTRATION COUNCIL  </h2>
		<img src="<?php echo $_SERVER['DOCUMENT_ROOT']; echo '/assets/images/logo_pdf.png' ?>" style="padding-top: 10px">
		<h2  style="padding-top: -28px"><u>ADMIT CARD</u></h2>
	</center> 
	
	<table style="width: 100%;" border="1" cellspacing="0">
			<tr >
				<td colspan="3" valign="top">
	<table style="width: 100%; font-size: 15px; border-collapse: collapse; margin-bottom: 10px;">
    <!-- Roll No. and Ref No. Row -->
    <tr>
        <td style="padding: 6px 6px 10px 6px; vertical-align: top;"><strong>Roll No.:</strong> <?php echo $key['admit_card_roll_no']; ?></td>
        <td style="padding: 6px 6px 10px 6px; text-align: right; vertical-align: top;"><strong>Ref No.:</strong> <?php echo $key['ref_no']; ?></td>
    </tr>

    <!-- Candidate Details Row -->
    <tr>
        <td colspan="2" style="padding: 10px 6px 6px 6px; text-align: justify; line-height: 1.5;">
            Miss/Mrs./Mr. <strong><?php echo $key['name']; ?></strong>, S/o, D/o Shri <strong><?php echo $key['father_name']; ?></strong>, born on <strong><?php echo $key['dob']; ?></strong>, is allowed to appear in the 
            <strong><?php echo $key['course']; ?></strong> examination to be held on <strong><?php echo $key['batch_session']; ?></strong> at Centre 
            <strong><?php echo $selected_center_name; ?></strong> from School of Nursing <strong><?php echo $key['train_school']; ?></strong>.
        </td>
    </tr>
</table>


				</td> 
				<td align="right" width="160">
					<img src="<?php echo $_SERVER['DOCUMENT_ROOT'].'/uploads/exam_form/'.$key['ref_no'].'/'.$key['img1']; ?>" style=" width:130px; height: 110px;margin-top:15px;margin-right:35px;">
					<br> <p style="margin-right:40px;"> Photo of Candidate</p> 
				</td>
			</tr>
			<tr>
				<td colspan="3" valign="top">
                     <table style="width: 100%">
                    <tr>
                        <td colspan="3" align="center"><b>SUBJECT & DATE OF EXAMINATION</b></td>
                    </tr>
                    <tr>
                        <th style="text-align:left;">Subject</th>
                        <th style="text-align:left;">Date</th>
                        <th style="text-align:left;">Time</th>
                    </tr>
                
                    <?php 
                      
                    $showAllCourses = ['1st Year ANM', '1st Year GNM'];
                
                
                        if (in_array($key['course'], $showAllCourses)) {
                           
                            $filtered_subjects = array_filter($subject_row, function($sub) use ($key) {
                                return $sub['course'] === $key['course'];
                            });
                        } else {
                          
                            $selected_subjects = array_filter([
                                $key['sub_1'],
                                $key['sub_2'],
                                $key['sub_3'],
                                $key['sub_4'],
                                $key['sub_5'],
                                $key['sub_6'],
                                $key['sub_7'],
                                $key['sub_8'],
                            ]);
                
                            $filtered_subjects = array_filter($subject_row, function($sub) use ($key, $selected_subjects) {
                                return (
                                    $sub['course'] === $key['course'] &&
                                    in_array($sub['subject_name'], $selected_subjects)
                                );
                            });
                        }
                
                        // Step 2: Sort subjects by exam_date (with fallback)
                        usort($filtered_subjects, function($a, $b) {
                            $dateA = ($a['exam_date'] !== '0000-00-00') ? strtotime($a['exam_date']) : PHP_INT_MAX;
                            $dateB = ($b['exam_date'] !== '0000-00-00') ? strtotime($b['exam_date']) : PHP_INT_MAX;
                            return $dateA - $dateB;
                        });
                
                        // Step 3: Label subjects alphabetically
                        $labelIndex = 0;
                        $alphabetLabels = range('A', 'Z');
                    ?>
                
                    <?php foreach ($filtered_subjects as $sub): ?>
                        <tr>
                            <td><?= $alphabetLabels[$labelIndex++] ?>. <?= $sub['subject_name'] ?></td>
                            <td style="white-space: nowrap;">
                                <?= ($sub['exam_date'] !== '0000-00-00') ? date('d-m-Y', strtotime($sub['exam_date'])) : '' ?>
                            </td>
                            <td>
                                <?= ($sub['time'] !== '00:00:00') ? date('h:i A', strtotime($sub['time'])) : '' ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>

				</td> 
				<td align="right" width="160">

						<img src="<?php echo $_SERVER['DOCUMENT_ROOT'].'/uploads/exam_form/'.$key['ref_no'].'/'.$key['img2']; ?>" style=" width:150px; height: 50px;margin-top:15px;margin-right:20px;">
						<br> <p style="margin-right:40px;">Signature of Candidate</p> 	
					
				</td>
			</tr>
		
	</table>
	
<table  style="width: 100%; margin-top: 60px;">    
   <tr>
    <td style="white-space: nowrap;">
        <b>Signature of Candidate</b>
    </td>
    <td style="white-space: nowrap;">
        <b>Signature of Principal</b>
    </td>
    <td align="right" style="white-space: nowrap;">
        <b>Signature of Director/ Superintendent/Civil Surgeon</b>
    </td>
</tr>

   
  <!-- Registrar Signature and Info - Centered -->
  
<tr>
    <td colspan="3" align="right" style="padding-top: 20px;padding-left:480px;">
        <div style="display: inline-block; text-align: center;">
            <img src="<?= 'file://'.FCPATH.'uploads/signatures/registrarsignature.png' ?>"  
                 alt="Registrar Signature"
                 style="height: 95px;"><br>
            <strong>Registrar</strong><br>
            Jharkhand Nurses Registration Council<br>
            Jharkhand, Ranchi
        </div>
    </td>
</tr>


    <!-- Divider -->
    <tr>
        <td colspan="3">
            <hr>
        </td>
    </tr>
</table>

	<table style="width: 100%;">
		<tr>
		<td valign="top"><i><b>Note:</b><i></td>
		<td colspan="2"><i>The result of the examination of the candidates will be communicated to the Institution concerned from the office of the Jharkhand Nurses Registration Council as soon as the result is approved and published.</i></td>
		</tr>
	</table>
	
	
	<div style="page-break-before:always">&nbsp;</div>
	<?php 
	
}
?>
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