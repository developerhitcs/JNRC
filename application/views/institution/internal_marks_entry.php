<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <?php if (!empty($message)): ?>
                    <div class="alert alert-<?php echo html_escape($message_type); ?>"><?php echo html_escape($message); ?></div>
                <?php endif; ?>
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Enter Internal Marks</h4>
                        <p class="card-category"><?php echo html_escape($context['course'] . ' — ' . $context['session_label']); ?> · <?php echo html_escape($institution['school_name']); ?></p>
                    </div>
                    <div class="card-body">
                        <p><a class="btn btn-outline-primary" href="<?php echo base_url('institution/internal-marks'); ?>">Back to sessions</a></p>
                        <?php if ($submission && $submission['status'] === 'submitted'): ?>
                            <div class="alert alert-success">Submitted and locked<?php echo $submission['submitted_at'] ? ' on ' . html_escape($submission['submitted_at']) : ''; ?>. Contact JNRC for corrections.</div>
                        <?php elseif (!$window_open): ?>
                            <div class="alert alert-warning">The entry window is closed or has not started. You can view saved marks but cannot make changes.</div>
                        <?php endif; ?>
                        <?php if (empty($assessments)): ?>
                            <div class="alert alert-warning">No assessment components are configured for this course and session. Contact JNRC.</div>
                        <?php else: ?>
                            <form method="get" action="<?php echo base_url('institution/internal-marks/entry'); ?>">
                                <input type="hidden" name="session" value="<?php echo html_escape($context['session_label']); ?>">
                                <input type="hidden" name="course" value="<?php echo html_escape($context['course']); ?>">
                                <div class="row">
                                    <div class="col-md-8">
                                        <label>Subject and assessment component</label>
                                        <select class="form-control" name="assessment" onchange="this.form.submit()">
                                            <option value="">Select subject / component</option>
                                            <?php foreach ($assessments as $assessment): ?>
                                                <option value="<?php echo (int) $assessment['id']; ?>" <?php echo $selected_assessment && (int) $selected_assessment['id'] === (int) $assessment['id'] ? 'selected' : ''; ?>>
                                                    <?php echo html_escape($assessment['subject_code'] . ' — ' . $assessment['subject_name_snapshot'] . ' / ' . ucfirst($assessment['component']) . ' (max ' . number_format((float) $assessment['max_marks'], 2) . ')'); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        <?php endif; ?>

                        <?php if ($selected_assessment): ?>
                            <hr>
                            <h5><?php echo html_escape($selected_assessment['subject_code'] . ' — ' . $selected_assessment['subject_name_snapshot']); ?></h5>
                            <p>Component: <?php echo html_escape(ucfirst($selected_assessment['component'])); ?> · Maximum: <?php echo number_format((float) $selected_assessment['max_marks'], 2); ?> · Pass mark: <?php echo number_format((float) $selected_assessment['pass_marks'], 2); ?></p>
                            <?php if (empty($students)): ?>
                                <div class="alert alert-warning">No eligible students with assigned examination roll numbers were found for this course and session.</div>
                            <?php else: ?>
                                <?php echo form_open('institution/internal-marks/save'); ?>
                                    <input type="hidden" name="session" value="<?php echo html_escape($context['session_label']); ?>">
                                    <input type="hidden" name="course" value="<?php echo html_escape($context['course']); ?>">
                                    <input type="hidden" name="assessment_id" value="<?php echo (int) $selected_assessment['id']; ?>">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-sm">
                                            <thead>
                                                <tr><th>Roll No.</th><th>Exam Ref.</th><th>Student</th><th>Father's Name</th><th>Attendance</th><th>Marks / <?php echo number_format((float) $selected_assessment['max_marks'], 2); ?></th></tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($students as $student): ?>
                                                <?php $entry = isset($entries[$student['id']]) ? $entries[$student['id']] : NULL; ?>
                                                <tr>
                                                    <td><?php echo html_escape($student['admit_card_roll_no']); ?></td>
                                                    <td><?php echo html_escape($student['ref_no']); ?></td>
                                                    <td><?php echo html_escape($student['name']); ?></td>
                                                    <td><?php echo html_escape($student['father_name']); ?></td>
                                                    <td>
                                                        <select class="form-control" name="attendance_status[<?php echo (int) $student['id']; ?>]" <?php echo (!$window_open || ($submission && $submission['status'] === 'submitted')) ? 'disabled' : ''; ?>>
                                                            <option value="" <?php echo !$entry ? 'selected' : ''; ?>>Select</option>
                                                            <option value="present" <?php echo $entry && $entry['attendance_status'] === 'present' ? 'selected' : ''; ?>>Present</option>
                                                            <option value="absent" <?php echo $entry && $entry['attendance_status'] === 'absent' ? 'selected' : ''; ?>>Absent</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input class="form-control" type="number" min="0" max="<?php echo html_escape($selected_assessment['max_marks']); ?>" step="0.01" name="marks[<?php echo (int) $student['id']; ?>]" value="<?php echo $entry && $entry['marks_obtained'] !== NULL ? html_escape($entry['marks_obtained']) : ''; ?>" <?php echo (!$window_open || ($submission && $submission['status'] === 'submitted')) ? 'disabled' : ''; ?>>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php if ($window_open && (!$submission || $submission['status'] !== 'submitted')): ?>
                                        <button class="btn btn-secondary" type="submit" name="action" value="draft">Save Draft</button>
                                        <button class="btn btn-success" type="submit" name="action" value="submit" onclick="return confirm('Submit all configured internal marks? This will lock the submission.');">Submit All &amp; Lock</button>
                                    <?php endif; ?>
                                <?php echo form_close(); ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
