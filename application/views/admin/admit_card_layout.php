<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title> Admit Card </title>
	<style>
		@page { margin: 28px 32px; }
		body { font-family: "Times New Roman", serif; font-size: 14px; line-height: 18px; color: #111; }
		table { width: 100%; border-collapse: collapse; }
		td, th { padding: 7px; vertical-align: middle; }
		.header { margin-bottom: 18px; border: 0; table-layout: fixed; }
		.header td { padding: 0; text-align: center; border: 0; }
		.header-logo { width: 14%; text-align: left !important; }
		.header-title { width: 72%; }
		.header-qr { width: 14%; text-align: right !important; }
		.header-logo-image { width: 85px; height: 76px; }
		.header-qr-image { width: 76px; height: 76px; }
		.council-name { display: block; font-size: 18px; line-height: 24px; font-weight: bold; text-align: center; white-space: nowrap; }
		.card-title { display: block; font-size: 17px; line-height: 22px; font-weight: bold; text-align: center; margin-top: 6px; }
        .exam-layout { border: 1px solid #222; table-layout: fixed; }
		.exam-layout > tbody > tr > td { border: 1px solid #555; padding: 0; }
		.exam-layout > tbody > tr > td:first-child { width: 75%; }
		.details { height: 165px; table-layout: fixed; }
		.details td { border: 0; padding: 0; }
		.details-copy { vertical-align: top; padding: 0; }
		.roll-reference td { border: 1px solid #555; border-top: 0; }
		.student-details { table-layout: fixed; border-collapse: collapse; border-spacing: 0; font-size: 14px; line-height: 17px; }
		.student-details td { border: 1px solid #777; padding: 2px 4px; vertical-align: top; }
		.student-details .field-label { width: 20%; font-weight: bold; }
		.student-details .field-value { width: 30%; text-align: left; word-wrap: break-word; }
		.photo-cell, .candidate-signature-cell { width: 25%; text-align: center; }
		.photo-cell { height: 165px; }
		.candidate-signature-cell { vertical-align: middle; }
		.section-title { font-weight: bold; text-align: center; }
		.subjects { table-layout: fixed; }
		.subjects td, .subjects th { border: 1px solid #555; }
		.subjects-cell { vertical-align: top; }
		.subjects th { background: #f0f0f0; text-align: left; }
		.signatures { margin-top: 34px; }
		.signatures td { text-align: center; vertical-align: bottom; }
		.signature-image { width: 125px; height: 42px; }
		.footer { margin-top: 12px; margin-bottom: 18px; }
		.registrar-cell { width: 100%; text-align: right; vertical-align: bottom; }
		.registrar-block { width: 38%; }
		.registrar-block td { text-align: center; }
		.registrar-image { width: 175px; height: 58px; }
		.note { border-top: 1px solid #555; }
		.note td { padding: 10px 7px 0; vertical-align: top; }
		.instructions-page { page-break-before: always; }
		.instructions-frame { border: 1px solid #222; padding: 0px; vertical-align: top; }
		.instructions-page h3 { margin: 5px 0 0 5px; font-size: 18px; line-height: 24px; text-align: center; }
		.instruction-table  { border-top: 1px solid #222; }
		.instruction-table td { border: 0; padding: 8px 7px; vertical-align: top; line-height: 18px; }
		.instruction-number { width: 32px; text-align: right; }
	</style>
</head>
<body>
<?php
/* ---------- Safe helpers (all optional values fall back, nothing can break the layout) ---------- */
if (!function_exists('ac_e')) {
	function ac_e($v, $d = '-') {
		if ($v === null || $v === '') { return $d; }
		return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');
	}
}
if (!function_exists('ac_get')) {
	function ac_get($arr, $k, $d = '') {
		return (is_array($arr) && isset($arr[$k]) && $arr[$k] !== null) ? $arr[$k] : $d;
	}
}
if (!function_exists('ac_file_uri')) {   // local file -> data URI, '' if the file is missing
	function ac_file_uri($path) {
		if (!$path || !@is_file($path) || !@is_readable($path)) { return ''; }
		$ext  = strtolower(pathinfo($path, PATHINFO_EXTENSION));
		$mime = ($ext === 'jpg' || $ext === 'jpeg') ? 'image/jpeg' : (($ext === 'gif') ? 'image/gif' : 'image/png');
		$raw  = @file_get_contents($path);
		return ($raw === false || $raw === '') ? '' : 'data:' . $mime . ';base64,' . base64_encode($raw);
	}
}
if (!function_exists('ac_pick')) {       // first non-empty value
	function ac_pick() {
		foreach (func_get_args() as $a) { if ($a !== null && $a !== '') { return $a; } }
		return '';
	}
}

$rows        = (isset($row) && is_array($row)) ? $row : array();
$subjects    = (isset($subject_row) && is_array($subject_row)) ? $subject_row : array();
$centre_name = isset($selected_center_name) ? $selected_center_name : '';
$fcpath      = defined('FCPATH') ? FCPATH : '';

$logo = ac_pick(
	isset($logo_data_uri) ? $logo_data_uri : '',
	$fcpath !== '' ? ac_file_uri($fcpath . 'assets/images/logo_pdf.png') : ''
);
$reg_sign = ac_pick(
	isset($registrar_signature_uri) ? $registrar_signature_uri : '',
	$fcpath !== '' ? ac_file_uri($fcpath . 'uploads/signatures/registrarsignature.png') : ''
);
?>

<?php foreach ($rows as $key )
{
	if (!is_array($key)) { continue; }
	$kid    = ac_get($key, 'id');
	$course = ac_get($key, 'course');

	$photo = (isset($photo_data_uris) && is_array($photo_data_uris)) ? ac_get($photo_data_uris, $kid) : '';
	$sign = (isset($signature_data_uris) && is_array($signature_data_uris)) ? ac_get($signature_data_uris, $kid) : '';
	$qr = (isset($qr_data_uris) && is_array($qr_data_uris)) ? ac_get($qr_data_uris, $kid) : '';

	$filtered_subjects = array_values(array_filter($subjects, function ($subject) use ($course) {
		return ac_get($subject, 'course') === $course;
	}));
	usort($filtered_subjects, function($a, $b) {
		$da = ac_get($a, 'exam_date'); $db = ac_get($b, 'exam_date');
		$ta = ($da !== '' && $da !== '0000-00-00') ? (int)strtotime($da) : PHP_INT_MAX;
		$tb = ($db !== '' && $db !== '0000-00-00') ? (int)strtotime($db) : PHP_INT_MAX;
		return ($ta < $tb) ? -1 : (($ta > $tb) ? 1 : 0);
	});
	$labelIndex = 0;
	$alphabetLabels = range('A', 'Z');
	?>
	<table class="header">
		<tr>
			<td class="header-logo">
				<?php if ($logo !== ''): ?>
					<img class="header-logo-image" src="<?php echo $logo; ?>" alt="JNRC logo">
				<?php endif; ?>
			</td>

			<td class="header-title">
				<div class="council-name">JHARKHAND NURSES REGISTRATION COUNCIL</div>
                <br>
				<div class="card-title"><u>ADMIT CARD</u></div>
			</td>
			<td class="header-qr">
				<?php if ($qr !== ''): ?>
					<img class="header-qr-image" src="<?php echo $qr; ?>" alt="Admit card verification QR code">
				<?php endif; ?>
			</td>

		</tr>

	</table>

	<table class="exam-layout">
		<colgroup>
			<col style="width: 8.333%;">
			<col style="width: 8.333%;">
			<col style="width: 8.333%;">
			<col style="width: 8.333%;">
			<col style="width: 8.333%;">
			<col style="width: 8.333%;">
			<col style="width: 8.333%;">
			<col style="width: 8.333%;">
			<col style="width: 8.333%;">
			<col style="width: 8.333%;">
			<col style="width: 8.333%;">
			<col style="width: 8.337%;">
		</colgroup>
		<tr>
			<td colspan="9">
				<table class="details">
					<tr>
						<td class="details-copy">
							<table>
								
								<tr>
									<td colspan="2" style="padding: 0;">
										<table class="student-details">
											<tr>
												<td class="field-label"><strong>Roll No.:</strong></td>
												<td class="field-value"><?php echo ac_e(ac_get($key, 'admit_card_roll_no')); ?></td>
												<td class="field-label"><strong>Ref No.:</strong></td>
												<td class="field-value"><?php echo ac_e(ac_get($key, 'ref_no')); ?></td>
											</tr>
											<tr>
												<td class="field-label">Candidate:</td>
												<td class="field-value"><?php echo ac_e(ac_get($key, 'name')); ?></td>
												<td class="field-label">Father's Name:</td>
												<td class="field-value"><?php echo ac_e(ac_get($key, 'father_name')); ?></td>
											</tr>
											<tr>
												<td class="field-label">Date of Birth:</td>
												<td class="field-value"><?php echo ac_e(ac_get($key, 'dob')); ?></td>
												<td class="field-label">Course:</td>
												<td class="field-value"><?php echo ac_e($course); ?></td>
											</tr>
											<tr>
												<td class="field-label">Exam Session:</td>
												<td class="field-value"><?php echo ac_e(ac_get($key, 'batch_session')); ?></td>
												<td class="field-label">Exam Center:</td>
												<td class="field-value"><?php echo ac_e($centre_name); ?></td>
											</tr>
											<tr>
												<td class="field-label">Institution:</td>
												<td class="field-value" colspan="3"><?php echo ac_e(ac_get($key, 'train_school')); ?></td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
			<td class="photo-cell" colspan="3">
				<?php if ($photo !== ''): ?>
					<img src="<?php echo $photo; ?>" alt="Candidate photo" style="width: 122px; height: 104px;">
					<div>Photo of Candidate</div>
				<?php else: ?>
					<div>Candidate photo unavailable</div>
				<?php endif; ?>
			</td>
		</tr>
		<tr>
			<td class="subjects-cell" colspan="9">
				<table class="subjects">
					<tr><td class="section-title" colspan="3">SUBJECT &amp; DATE OF EXAMINATION</td></tr>
					<tr>
						<th style="width: 60%;">Subject</th>
						<th style="width: 20%;">Date</th>
						<th style="width: 20%;">Time</th>
					</tr>
					<?php if (empty($filtered_subjects)) { ?>
						<tr><td colspan="3" style="text-align: center;"><i>Subject schedule not available</i></td></tr>
					<?php } ?>
					<?php foreach ($filtered_subjects as $sub):
						$d = ac_get($sub, 'exam_date');
						$t = ac_get($sub, 'time');
						$lab = isset($alphabetLabels[$labelIndex]) ? $alphabetLabels[$labelIndex] . '. ' : '';
						$labelIndex++;
					?>
						<tr>
							<td><?php echo $lab . ac_e(ac_get($sub, 'subject_name'), ''); ?></td>
							<td><?php echo ($d !== '' && $d !== '0000-00-00') ? ac_e(date('d-m-Y', strtotime($d)), '') : ''; ?></td>
							<td><?php echo ($t !== '' && $t !== '00:00:00') ? ac_e(date('h:i A', strtotime($t)), '') : ''; ?></td>
						</tr>
					<?php endforeach; ?>
				</table>
			</td>
			<td class="candidate-signature-cell" colspan="3">
				<?php if ($sign !== ''): ?>
					<img class="signature-image" src="<?php echo $sign; ?>" alt="Candidate signature"><br>
					<strong>Signature of Candidate</strong>
				<?php else: ?>
					<strong>Signature of Candidate</strong><br>
					<span>Not available</span>
				<?php endif; ?>
			</td>
		</tr>
	</table>

	<table class="signatures">
		<tr>
			<td style="width: 33%;">
				<br>
				<strong>Signature of Candidate</strong>
			</td>
			<td style="width: 33%;"><br><strong>Signature of Principal</strong></td>
			<td style="width: 34%;"><br><strong>Signature of Director / Superintendent / Civil Surgeon</strong></td>
		</tr>
	</table>

	<table class="footer">
		<tr>
			<td class="registrar-cell">
				<table class="registrar-block" align="right">
					<tr>
						<td>
							<?php if ($reg_sign !== ''): ?>
								<img class="registrar-image" src="<?php echo $reg_sign; ?>" alt="Registrar signature"><br>
							<?php endif; ?>
							<strong>Registrar</strong><br>
							Jharkhand Nurses Registration Council<br>
							Jharkhand, Ranchi
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

	<table class="note">
		<tr>
			<td style="width: 44px;"><i><strong>Note:</strong></i></td>
			<td><i>The result of the examination of the candidates will be communicated to the Institution concerned from the office of the Jharkhand Nurses Registration Council as soon as the result is approved and published.</i></td>
		</tr>
	</table>
	<?php

}
?>
<table class="instructions-page">
	<tr>
		<td class="instructions-frame">

			<h3>Instructions</h3>
            <br>
            <br>
			<table class="instruction-table">
				<tr><td class="instruction-number">1.</td><td>Candidate is required to show her Admit Card to the Centre Superintendent or Invigilator appointed by the JNRC, Ranchi before entering the examination hall.</td></tr>
				<tr><td class="instruction-number">2.</td><td>Candidates will take their seats five minutes before the time fixed for the examination. A candidate coming later than thirty minutes of the starting of examination shall not be allowed to appear.</td></tr>
				<tr><td class="instruction-number">3.</td><td>Candidate shall not write anything on the question paper.</td></tr>
				<tr><td class="instruction-number">4.</td><td>Candidates are not allowed to bring note books, text books, any electronic device and paper of any kind into the examination hall.</td></tr>
				<tr><td class="instruction-number">5.</td><td>No candidate will be allowed to leave the room within an hour after the distribution of question papers.</td></tr>
				<tr><td class="instruction-number">6.</td><td>Only after examination, candidate shall take question paper outside the hall. No other types of paper shall be removed from the hall.</td></tr>
				<tr><td class="instruction-number">7.</td><td>Any student disobeying these rules shall be liable for disqualification.</td></tr>
				<tr><td class="instruction-number">8.</td><td>Complaints, if any, should be submitted within thirty days of the publication of result through the training Institution.</td></tr>
				<tr><td class="instruction-number">9.</td><td>Any particulars concerning training submitted by the candidate or Institution on the examination applications or any other correspondence concerning examination, found incorrect, the candidate shall be liable to be disqualified from appearing at the examination or cancellation of examination.</td></tr>
				<tr><td class="instruction-number">10.</td><td>Any candidate found using unfair or illegal means during examination shall be liable to be debarred and rusticated from appearing at three consecutive examination.</td></tr>
			</table>
		</td>
	</tr>
</table>
</body>
</html>