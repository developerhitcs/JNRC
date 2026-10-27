<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admit Card Verification - JNRC</title>
    <style>
        body { margin: 0; padding: 24px; background: #f3f5f8; color: #202733; font: 16px Arial, sans-serif; }
        main { box-sizing: border-box; max-width: 640px; margin: 32px auto; padding: 28px; background: #fff; border-radius: 8px; box-shadow: 0 2px 12px #0001; }
        h1 { margin-top: 0; font-size: 24px; }
        .status { padding: 12px; border-radius: 4px; font-weight: bold; }
        .valid { color: #155724; background: #d4edda; }
        .invalid { color: #721c24; background: #f8d7da; }
        .student-photo { display: block; max-width: 180px; max-height: 220px; margin: 20px auto; object-fit: contain; }
        dl { display: grid; grid-template-columns: 150px 1fr; gap: 12px; }
        dt { font-weight: bold; }
        dd { margin: 0; overflow-wrap: anywhere; }
        @media (max-width: 480px) { body { padding: 12px; } main { margin: 12px auto; padding: 20px; } dl { grid-template-columns: 1fr; gap: 4px; } dd { margin-bottom: 10px; } }
    </style>
</head>
<body>
    <main>
        <h1>JNRC Admit Card Verification</h1>
        <?php if ($is_valid): ?>
            <p class="status valid">VALID — This admit card is currently released by JNRC.</p>
            <?php if ($photo_url !== ''): ?>
                <img class="student-photo" src="<?php echo html_escape($photo_url); ?>" alt="Student photograph">
            <?php else: ?>
                <p>Student photograph unavailable.</p>
            <?php endif; ?>
            <dl>
                <dt>Student name</dt>
                <dd><?php echo html_escape($student['name']); ?></dd>
                <dt>Father's name</dt>
                <dd><?php echo html_escape($student['father_name']); ?></dd>
                <dt>Reference number</dt>
                <dd><?php echo html_escape($student['ref_no']); ?></dd>
            </dl>
        <?php else: ?>
            <p class="status invalid">INVALID — This admit card could not be verified or is no longer active.</p>
        <?php endif; ?>
    </main>
</body>
</html>
