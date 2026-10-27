<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admit Card</title>
    <style>
        @page { margin: 28px 34px; }
        body { font-family: "Times New Roman", serif; font-size: 13px; color: #000; }
        table { width: 100%; border-collapse: collapse; }
        td, th { padding: 6px; vertical-align: top; }
        p { margin: 8px 0; }
        .heading { text-align: center; }
        .heading h2 { margin: 0 0 6px; font-size: 20px; }
        .heading img { width: 78px; height: 78px; }
        .heading h3 { margin: 6px 0 12px; font-size: 18px; text-decoration: underline; }
        .details, .instructions { border: 1px solid #000; }
        .details td { border: 1px solid #000; }
        .photo, .signature { width: 155px; text-align: center; }
        .photo img { width: 120px; height: 130px; }
        .signature img { width: 140px; height: 48px; }
        .subject-table th, .subject-table td { border-bottom: 1px solid #bbb; text-align: left; }
        .qr { width: 130px; text-align: center; }
        .qr img { width: 100px; height: 100px; }
        .registrar { text-align: right; }
        .registrar img { width: 130px; height: 48px; }
        .note { margin-top: 16px; }
        .instructions { margin-top: 18px; }
        .instructions p { margin: 6px 0; }
    </style>
</head>
<body>
<?php foreach ($row as $student): ?>
    <div class="heading">
        <h2>JHARKHAND NURSES REGISTRATION COUNCIL</h2>
        <?php if (!empty($logo_data_uri)): ?>
            <img src="<?php echo html_escape($logo_data_uri); ?>" alt="JNRC logo">
        <?php endif; ?>
        <h3>ADMIT CARD</h3>
    </div>

    <table class="details">
        <tr>
            <td>
                <table>
                    <tr>
                        <td><strong>Roll No.:</strong> <?php echo html_escape($student['admit_card_roll_no']); ?></td>
                        <td style="text-align:right"><strong>Ref No.:</strong> <?php echo html_escape($student['ref_no']); ?></td>
                    </tr>
                </table>
                <p style="text-align:justify;line-height:1.6">
                    Miss/Mrs./Mr. <strong><?php echo html_escape($student['name']); ?></strong>,
                    S/o, D/o Shri <strong><?php echo html_escape($student['father_name']); ?></strong>,
                    born on <strong><?php echo html_escape($student['dob']); ?></strong>, is allowed to appear in the
                    <strong><?php echo html_escape($student['course']); ?></strong> examination to be held on
                    <strong><?php echo html_escape($student['batch_session']); ?></strong> at Centre
                    <strong><?php echo html_escape($selected_center_name); ?></strong> from School of Nursing
                    <strong><?php echo html_escape($student['train_school']); ?></strong>.
                </p>
            </td>
            <td class="photo">
                <img src="<?php echo html_escape($dummy_photo_uri); ?>" alt="Sample candidate photo"><br>
                Photo of Candidate (sample)
            </td>
        </tr>
        <tr>
            <td>
                <div style="text-align:center"><strong>SUBJECT &amp; DATE OF EXAMINATION</strong></div>
                <table class="subject-table">
                    <thead>
                        <tr><th>Subject</th><th>Date</th><th>Time</th></tr>
                    </thead>
                    <tbody>
                        <?php if (empty($subject_row)): ?>
                            <tr><td colspan="3">Subject schedule not available</td></tr>
                        <?php else: ?>
                            <?php foreach ($subject_row as $index => $subject): ?>
                                <tr>
                                    <td><?php echo chr(65 + ($index % 26)) . '. ' . html_escape($subject['subject_name']); ?></td>
                                    <td><?php echo $subject['exam_date'] !== '0000-00-00' ? date('d-m-Y', strtotime($subject['exam_date'])) : ''; ?></td>
                                    <td><?php echo $subject['time'] !== '00:00:00' ? date('h:i A', strtotime($subject['time'])) : ''; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </td>
            <td class="signature">
                <img src="<?php echo html_escape($dummy_signature_uri); ?>" alt="Sample candidate signature"><br>
                Signature of Candidate (sample)
            </td>
        </tr>
    </table>

    <table style="margin-top:42px">
        <tr>
            <td><strong>Signature of Candidate</strong></td>
            <td style="text-align:center"><strong>Signature of Principal</strong></td>
            <td style="text-align:right"><strong>Signature of Director/ Superintendent/Civil Surgeon</strong></td>
        </tr>
        <tr>
            <td class="qr" style="padding-top:24px">
                <img src="<?php echo html_escape($qr_data_uris[$student['id']]); ?>" alt="Admit card verification QR">
                <div>Scan to verify this admit card</div>
            </td>
            <td colspan="2" class="registrar" style="padding-top:18px">
                <img src="<?php echo html_escape($registrar_signature_uri); ?>" alt="Sample Registrar signature"><br>
                <strong>Registrar</strong><br>
                Jharkhand Nurses Registration Council<br>
                Jharkhand, Ranchi
            </td>
        </tr>
    </table>

    <table class="note">
        <tr>
            <td><strong><em>Note:</em></strong></td>
            <td><em>The result of the examination of the candidates will be communicated to the Institution concerned from the office of the Jharkhand Nurses Registration Council as soon as the result is approved and published.</em></td>
        </tr>
    </table>
<?php endforeach; ?>

<table class="instructions">
    <tr><td style="text-align:center"><strong>Instructions</strong></td></tr>
    <tr><td>
        <p>1. Candidate is required to show her Admit Card to the Centre Superintendent or Invigilator appointed by the JNRC, Ranchi before entering the examination hall.</p>
        <p>2. Candidates will take their seats five minutes before the time fixed for the examination. A candidate coming later than thirty minutes of the starting of the examination shall not be allowed to appear.</p>
        <p>3. Candidate shall not write anything on the question paper.</p>
        <p>4. Candidates are not allowed to bring notebooks, textbooks, electronic devices, or papers of any kind into the examination hall.</p>
        <p>5. No candidate will be allowed to leave the room within an hour after the distribution of question papers.</p>
        <p>6. Candidates shall not remove question papers or other papers from the examination hall.</p>
        <p>7. Any student disobeying these rules shall be liable for disqualification.</p>
        <p>8. Complaints, if any, should be submitted within thirty days of the publication of result through the training Institution.</p>
        <p>9. Incorrect particulars concerning training or examination may result in disqualification or cancellation of the examination.</p>
        <p>10. Any candidate found using unfair or illegal means during examination shall be liable to be debarred and rusticated from appearing at three consecutive examinations.</p>
    </td></tr>
</table>
</body>
</html>
