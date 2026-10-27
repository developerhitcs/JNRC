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
		.header-logo-image { width: 76px; height: 76px; }
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

/* ---------- Dummy images: replace later by real files / data URIs ---------- */
$DUMMY_LOGO  = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAIAAAC3ytZVAAAD1klEQVR42u3cPUjzQBgH8MenBSWTcbV+LVJQZyeHClKROjnVWUHXTgEnByd1FnRx6yRCK9KW2tRZcHAKCNqlTtI6BYdi3iFQ+sba5uPukrvrTb3jDwk/uFzhHzJ2fX1tGAaMBgAAxA3DSCaTqVRqZKHrOgJAKpXSdX1kYRgG2hPJRXRdt/cHdpekFela/Mchp0ivhZNDNhGHRR8OeUR+W/TnkEGkr8WfHGKL/GUxiENUkQEWQzjEExlsMZxDJJGhFq44xBBxY+GWg3cRlxYeOPgVcW/hjYNHEU8Wnjn4EvFq4YeDFxEfFj45oi/iz8I/R5RFfFsE4oimSBCLoBxREwloQYAjOiLBLchwREGEiAUxjnBFSFmQ5AhLhKAFYQ72ImQtyHOwFCFuQYWDjQgNC1octEUoWVDkoCdCz4IuBw0RqhbUOciK0LZgwUFKhIEFI47gImws2HEEEWFmwZTDnwhLC9YcXkUYW4TA4V6EvUU4HG5EQrEIjWOwSFgWABBnc5n9/f2rq6velcfHx2q1WigUFEXZ3NxcW1sDgFqtVigUJicnn56e9vb2pqam7GSlUonH451Op5vkm8MxXl5e6vX60dGRoijlcrlWq6mqallWuVw+Pz+PxWLFYvHy8lLTtN6kaZqnp6eqqi4vLwvFcXd3t7u7qygKAKTT6Xa7XSwW2+32wcFBLBYDgI2NjdfX15+fn96koijZbPbm5oYeRzjPjo+Pj/n5+e50Z2fn7e3NNM2ZmRl7ZWJiIpfLIaIjubCw0Gw2RdssjlGv18fHx7+/v+3p/f398/Pz19fX2dmZI2lZloAny/T09Pv7e/ccmZubSyQSs7Ozt7e3ALC1tZXL5T4/Px1JAGg0GolEQjSOTCaTz+dN09R1fXV1NZ/Pb29vr6+vNxqNh4cHAKhUKojYmwQA0zTtJPebpdPpHB8f278XFxez2Wyr1dI0TVXVarWaTqeXlpYsy2o2m6VSqVQqZTIZ+5m6srLSarVOTk7sg9ZO0rvPMU3TDg8PIWJdUSj/xC4uLjCavVlYnR5GtkMMRQSj3CGyF8GI96mMRTD6fSpLEeSiW2Ymgrx0y2xEkKOenYEI8tWz0xZB7t45oCqC3L1zQFUEubOgKoI8WtATQU4tKIkgvxY0RJBrC+IiyLsFWREUwIKgCIphQUoEhbEgIoIiWQQXQcEsAoqgeBZBRFBIC98iKKqFPxEU2MKHCIpt4VUEhbfwJIIyWLgXQUksXIqgPBZuRFAqi6EiKJvFYBGU0GKACMpp8ZcISmvRVwRltvgtgpJbOETi3W9ijz4en0wm/wEyFsMy8MVzAwAAAABJRU5ErkJggg==';
$DUMMY_PHOTO = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIIAAABuCAIAAABk51xTAAAEyElEQVR42u2bP0szQRDGx2Gr68RSRY2ggWgXsBLZRi0UbA1YWJzgNxBip1b5AIoWikLyART806yWAStROKsookUKsbognOQt8hIlMRr1bm/2braLmYSd+2WeZ2696djb23McB3iFuoTjOMlkUkrJ1yKspZRCAJBSKqX4coTFwHEcUXtRJ8FloRNA7YK/Y6gDUEoxCT0MPl5nbHibBUo/g08wMAn9DD7HwCQ0MwAA0eoDbNoBGfLn9w1ffJJNO+gi+EaUWKB0MmgLA5MImkG7GJhEoAx+gIFJBMfgG4vm9imIpsgHDNw++VsEvxElFqiAGPweA5PwkcGfMDAJvxj8xhvYtP9uyP5jiLlp+5U1+rWhGAqUj7889HFbsSLhb/Wjv5uLCQnfFRh932LkSQThgiKIjUa1fQouKRHQjqPXPgWaCwa69cgIVNC/Jww6gQiQ0FDTqCENo0no0VWhJxkTTVvnhoW2rMwybc37RM3pGSFQ+n8rqD9J4iRCqVcMJVWyJMLSTAwrYYIkQvQtEWLadNqn0Lchws2fQvtEoXlDCmoQokARaaBJYAiLBJ2bGCoY9JMgdSMpgNLSY9oEj1VoYdBg2jRPUxBIroAEiuyJFlEMQZCgfKpIF4O/JIif7JLG4BcJ+qfrAsivv7RPpvyvyQAMv26fDHouBMGc9SOBMuvZHJMwtE/CuOejDMPQDgkTn1Gj6w2Li4uDg4MA8Pb2trCwkEgkbNve2dmpk9jf39/d3QWAi4uLs7MzIcTLy0sqlVpaWrq8vDw5OQGA29vb4eFhAJicnKxUKrUwz/Omp6fHx8cZQxs7E2J1dRUAHh4etre319bWGmoin88rpbq6us7Pz7PZbLFYHBsby+Vy19fX6XQ6nU4DgG3btS+5uro6Pj7OZrOWZbmum8vlOjs7R0ZGWJTaXb29veVyuZVAHRwcZDKZYrEopbQsa35+/vDwsDny6Ogok8lYlgUAX4Qxhpbr5uamr6+v1buVSuX+/r5uBgMDA4+Pj81hT09P/f399ZetwliUGpfneevr69Vq1bIs27brf/kYAACvr68TExN1W65Wq+18eZthjOHdG1r9xbZtpVQikSiVSjXTllLe3d319PQ0f1t3d3epVBoaGqq9bBXGovTjUwrP86SUMzMzhULBdV0p5enp6dbW1uzsbHN8PQwAXNctFAqfhnE1/PioLp/PA8Do6Ojz8/PGxkatE52bmyuXy6lUquEjDWFTU1PNMSGujpWVleXl5Yg96W7WHdzm5iZGctrAuIkKjOrEh1kkRIQnPgyabRHRnvgwZbYF4zDxQV+gMCZTN8RJYHymbiiTwFhNPpElIeI2BkuzfRIxHHsi2D5hbEfPSAkUxnn8jw4JjPkIJhESIuYjmERMW8SzCKiZNjIDCgKFzIACCWQGFEggM6BAQsSqKSLbPgkuAgrtEzIDCgKFzIACCWQGFEgINmQKpi24CCiYNjIDCgKFzIACCWQGFEggM6BAQnBTRKF9ElwEFNonZAYUBAqZAQUSyAwokBBsyBRMW3ARUDBtZAYUBAqZAQUSyAwokEBmQIGE4KaIQvskuAgotE/IDCgIFDIDCiSQGVAgIdiQKZi24CII3bT/Y1BKOY7jOA5fmlBWMpn8B/mhatDky7k2AAAAAElFTkSuQmCC';
$DUMMY_SIGN  = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAAAyCAIAAAAx7rVNAAAElklEQVR42u3cTyh8WxwA8O/MPX4kZjAl+bcgzKDEzG5kjJKibIiNlBpEbETdBZIUympKwsKUTEQ2/iQLNyyULsmULpqoMbKZTJOFyZ2Ztzj9zpu8936P9/y45/c739Wdc+6Zzjmfe7733G4zKofDAQCSJAELCkOv1yNJkrq6ukiR1Wpl86L8EAQBH0iShF7JkTpmqWQ5ovMn4V9XIbNUslx0oH9qxiwVLvfvhMxS4XLvIGSWypT7L4TMUlFy/4uQWSpB7mMImeUXyn0wIbP8fLmfRcgsP03upxP+zpafPFL0aQP75S2/alzo84f6i1l++SjQFw6eakvl9BkpYTooslRgD5GiJkixlkq+tpAyL3aFWFKR4REoO77Ekq57MwJK4hMsKd0hI6AtPtyS9mcbJRLe3t4uLy/LssxxXEdHh06na29vn5+fB4C9vT1BEDiOi4+Pt9lsKSkpANDa2pqamlpXV4cNyMmYx+Fw2O12rVYriuLOzg4AXF5eFhQU+P3+wsLCw8PDhYUFfDJp2NbWlpubG4lEnp+fW1paDAYDLsGnlZWV1dbWMsIfxezs7MDAQEpKyvHxsdPp7O3txeUul0sUxZGREY7jNjY25ubmeJ4HgNjYWI1Gk5aWhteTLMvkq05PT2tqas7OziwWi8lkMplMgiC43W6z2Yy9j46O/mZSEBocHAQAj8czPT09MTFBStgqfFMEAoGXlxcAMBqNWq2WlG9tbTU1NXEcBwDV1dXX19fhcFitVgNAQ0PD2tra0NAQADidTmIZDAatVuvKyko4HCbZ0ul0vjFnZmZmPj4+skT67mhubh4dHS0pKSkvLy8sLCTld3d3WVlZ+DguLq6vr49UFRUVra+vX1xc4POxkCiKCQkJkiTd3Nz09PQg9O7Bulyu6A4wwrdGRUWF0WgURXFxcdFkMjU0NOByspK2t7dPT0/9fv/U1BRp1djYuLq6Ojw8THYo+/v7wWDQ5/PJsry8vJyRkfHGPYssy2NjY6FQ6P7+fnJykpSQKywvL48R/iiLPjw85OfnWyyW0tJSnucJYVpamsfjycnJqa2trays7O7ujm5oMBgCgcDS0pIsy1arNRwO7+/vj4+PA8D5+fnZ2RnGEwRBlmVBEPBHlUqFs3EoFMI5OfpeuLm5eXBwUF9fr+R7oVppHVKpVHa73efzAcDT05NOpyNVVVVVa2troVAIAHZ3d8mMYxJBEGw2m9vtxgnz6uoqOzsbvv/wwOVykXshQshqteImSUlJuOr8/JzsOUkUFxe73W6WSN8XiYmJNpvNbrfHxMSo1erOzk5SZTabvV4vz/PJyclmszkSieCEiUnIAsJboZOTk6KiIlz47ds3jUbj9XpxLo1+CtTr9SQb9/f3v+pMenq6x+OJRCLRiTQvL6+5uVlBFz3P89E/i4Hf+C0Pjc/4MzMziMnR/v4SMTnaLRGTo90SMTnaLRGTo90SMTnaLRGTo90SMTnaLRGTo90SMTnaLRGTo90SMTnaLRGTo90SMTnaLRGTo90SMTnaLRGTo90SMTnaLREAzMzM6PV6+P7niK8OWCg8/gAnH6fDLQ28hwAAAABJRU5ErkJggg==';
$DUMMY_QR    = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGkAAABpCAIAAAC24JptAAACE0lEQVR42u2czQ2DMAxGTdU5YBIWYQM2YBM2yCJMAovQa5VDRMjn0CrPNwSlzZN/ajtxZ7Wk7/vE3Wmavi9DCNfvRnIcR50VdT/Cbtu278txHK/ffYrdyxDYwe6f5B1dn+cpc6XdfWcaObgS8VsReofNwg52rcaKEn+f5ZWz/u5mvWoYhjorQu+wWdjBrhXp0t6xxLNGn933/fqr0nWU9MNRHcVvRegdNgs72BEr1J41qrkLq0yRRHkFsQKbhR0CO/OtQQmL/cLMwX6jfYHewQ52sGs1VpQ0pP0iyVMtdvQOm4Ud7BAzs25ZlnmeJS5cuHez5OE6S1jXFb3DZmEHu2ZiRVYbQfh3PyuwZNWv6kQhYgU2CzvYGf0K/b7XrIf9/H1WUEr/KvQOm4Ud7KhBFfenhUmIn/u/LeQV2CzsYNdwDUrYCniq5yCMM+kvQu+wWdjBjrxCvdHVL+sQBqWs34zeYbOwg10r8g4hpEfx1Sn++PXUhcGBfVDYLOxgx7ltqzortVqa4XcGEL3DZmEHO2Z8qA/BlczVFiYhqkhCXoHNwg52xp5Z9zmz1abQmq4fH91F77BZ2MGOvOLRObN+Z6+FMQq9w2ZhBztixaNzZoVdBWHoMGpQ2CzsYEes8O1XlOQVJZUiv6Ma6B02CzvYGXNmreYk2bSD9xseZXe7KOQV2Czs2pppZJmDHW7fLXmz3xd9APEzQTJKshUrAAAAAElFTkSuQmCC';

$rows        = (isset($row) && is_array($row)) ? $row : array();
$subjects    = (isset($subject_row) && is_array($subject_row)) ? $subject_row : array();
$centre_name = isset($selected_center_name) ? $selected_center_name : '';
$root        = rtrim(isset($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : '', '/');
$fcpath      = defined('FCPATH') ? FCPATH : ($root . '/');

$logo = ac_pick(
	isset($logo_data_uri) ? $logo_data_uri : '',
	ac_file_uri($fcpath . 'assets/images/logo_pdf.png'),
	$DUMMY_LOGO
);
$reg_sign = ac_pick(
	ac_file_uri($fcpath . 'uploads/signatures/registrarsignature.png'),
	isset($registrar_signature_uri) ? $registrar_signature_uri : ''
);   // optional
?>

<?php foreach ($rows as $key )
{
	if (!is_array($key)) { continue; }
	$kid    = ac_get($key, 'id');
	$course = ac_get($key, 'course');

	$photo = ac_pick(
		(isset($photo_data_uris) && is_array($photo_data_uris)) ? ac_get($photo_data_uris, $kid) : '',
		ac_file_uri($root . '/uploads/exam_form/' . ac_get($key, 'ref_no') . '/' . ac_get($key, 'img1')),
		isset($dummy_photo_uri) ? $dummy_photo_uri : '',
		$DUMMY_PHOTO
	);
	$sign = ac_pick(
		(isset($signature_data_uris) && is_array($signature_data_uris)) ? ac_get($signature_data_uris, $kid) : '',
		ac_file_uri($root . '/uploads/exam_form/' . ac_get($key, 'ref_no') . '/' . ac_get($key, 'img2')),
		isset($dummy_signature_uri) ? $dummy_signature_uri : '',
		$DUMMY_SIGN
	);
	$qr = ac_pick(
		(isset($qr_data_uris) && is_array($qr_data_uris)) ? ac_get($qr_data_uris, $kid) : '',
		$DUMMY_QR
	);

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
				<img class="header-logo-image" src="<?php echo $logo; ?>" alt="JNRC logo">
			</td>

			<td class="header-title">
				<div class="council-name">JHARKHAND NURSES REGISTRATION COUNCIL</div>
                <br>
				<div class="card-title"><u>ADMIT CARD</u></div>
			</td>
			<td class="header-qr">
				<img class="header-qr-image" src="<?php echo $qr; ?>" alt="Admit card verification QR code">
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
				<img src="<?php echo $photo; ?>" alt="Candidate photo" style="width: 122px; height: 104px;">
				<div>Photo of Candidate</div>
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
				<img class="signature-image" src="<?php echo $sign; ?>" alt="Candidate signature"><br>
				<strong>Signature of Candidate</strong>
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