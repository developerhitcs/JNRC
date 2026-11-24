<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admit Card Verification - JNRC</title>
    <style>
        body { margin: 0; padding: 24px; background: #f3f5f8; color: #202733; font: 16px Arial, sans-serif; }
        main { box-sizing: border-box; max-width: 820px; margin: 32px auto; padding: 28px; background: #fff; border-radius: 8px; box-shadow: 0 2px 12px #0001; }
        h1 { margin-top: 0; font-size: 24px; text-align: center; }
        .status { padding: 12px; border-radius: 4px; font-weight: bold; }
        .valid { color: #155724; background: #d4edda; }
        .invalid { color: #721c24; background: #f8d7da; }
        .verification-card { display: grid; grid-template-columns: minmax(0, 1fr) 210px; gap: 24px; align-items: stretch; padding: 20px; border: 1px solid #d9e0e8; border-radius: 8px; background: #fff; }
        .student-details { align-self: center; }
        dl { display: grid; grid-template-columns: 150px minmax(0, 1fr); gap: 14px 16px; margin: 0; }
        dt { font-weight: bold; }
        dd { margin: 0; overflow-wrap: anywhere; }
        .photo-card { box-sizing: border-box; padding: 12px; border: 1px solid #d9e0e8; border-radius: 8px; background: #f8fafc; text-align: center; }
        .photo-frame { display: flex; min-height: 220px; align-items: center; justify-content: center; overflow: hidden; border-radius: 4px; background: #fff; }
        .student-photo { display: block; max-width: 100%; max-height: 220px; object-fit: contain; }
        .photo-placeholder { margin: 12px; color: #64748b; }
        .photo-label { margin: 10px 0 0; font-size: 13px; font-weight: bold; }
        @media (max-width: 600px) {
            body { padding: 12px; }
            main { margin: 12px auto; padding: 20px; }
            .verification-card { grid-template-columns: 1fr; gap: 20px; }
            dl { grid-template-columns: 1fr; gap: 4px; }
            dd { margin-bottom: 10px; }
            .photo-card { max-width: 240px; width: 100%; margin: 0 auto; }
        }
    </style>
</head>
<body>
    <main>
        <h1>JNRC Admit Card </h1>
        <?php if ($is_valid): ?>
            <section class="verification-card" aria-label="Verified admit card details">
                <div class="student-details">
                    <dl>
                        <dt>Student name</dt>
                        <dd><?php echo html_escape($student['name']); ?></dd>
                        <dt>Father's name</dt>
                        <dd><?php echo html_escape($student['father_name']); ?></dd>
                        <dt>Reference number</dt>
                        <dd><?php echo html_escape($student['ref_no']); ?></dd>
                        <dt>Institution</dt>
                        <dd><?php echo html_escape($student['train_school']); ?></dd>
                    </dl>
                </div>
                <aside class="photo-card" aria-label="Candidate photograph">
                    <div class="photo-frame">
                        <?php if ($photo_url !== ''): ?>
                            <img class="student-photo" src="<?php echo html_escape($photo_url); ?>" alt="Candidate photograph">
                        <?php else: ?>
                            <p class="photo-placeholder">Student photograph unavailable.</p>
                        <?php endif; ?>
                    </div>
                    <p class="photo-label">Candidate photo</p>
                </aside>
            </section>
        <?php else: ?>
            <p class="status invalid">INVALID — This admit card could not be verified or is no longer active.</p>
        <?php endif; ?>
    </main>
</body>
</html>
