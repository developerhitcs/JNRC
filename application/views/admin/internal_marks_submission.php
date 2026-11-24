<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <?php if (!empty($message)): ?>
                    <div class="alert alert-<?php echo html_escape($message_type); ?>"><?php echo html_escape($message); ?></div>
                <?php endif; ?>
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Internal Marks Submission</h4>
                        <p class="card-category"><?php echo html_escape($submission['institution_name_snapshot'] . ' (' . $submission['school_code'] . ')'); ?> · <?php echo html_escape($submission['course'] . ' — ' . $submission['session_label']); ?></p>
                    </div>
                    <div class="card-body">
                        <p><strong>Status:</strong> <?php echo html_escape(ucfirst($submission['status'])); ?>
                            <?php if ($submission['submitted_at']): ?> · Submitted <?php echo html_escape($submission['submitted_at']); ?><?php endif; ?>
                        </p>
                        <?php if (!empty($submission['reopen_reason'])): ?>
                            <div class="alert alert-warning"><strong>Latest reopen reason:</strong> <?php echo nl2br(html_escape($submission['reopen_reason'])); ?></div>
                        <?php endif; ?>
                        <p><a class="btn btn-outline-primary" href="<?php echo base_url('admin/internal-marks'); ?>">Back to submissions</a></p>
                        <?php if (empty($assessments)): ?>
                            <p>No marks have been saved yet.</p>
                        <?php else: ?>
                            <h5>Marks by subject — Admin edits</h5>
                            <p class="text-muted">Admin changes take effect immediately. Enter a reason for every save; the previous and new values are recorded below.</p>
                            <?php foreach ($assessments as $assessment): ?>
                                <h6><?php echo html_escape($assessment['subject_code'] . ' — ' . $assessment['subject_name_snapshot'] . ' / ' . ucfirst($assessment['component'])); ?>
                                    (max <?php echo number_format((float) $assessment['max_marks'], 2); ?>)</h6>
                                <?php if (empty($assessment['entries'])): ?>
                                    <p>No student entries have been saved for this component.</p>
                                <?php else: ?>
                                    <?php echo form_open('admin/internal-marks/submission/' . (int) $submission['id'] . '/edit'); ?>
                                        <input type="hidden" name="assessment_id" value="<?php echo (int) $assessment['id']; ?>">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-sm">
                                                <thead><tr><th>Roll No.</th><th>Student</th><th>Attendance</th><th>Marks</th></tr></thead>
                                                <tbody>
                                                <?php foreach ($assessment['entries'] as $entry): ?>
                                                    <tr>
                                                        <td><?php echo html_escape($entry['roll_number_snapshot']); ?></td>
                                                        <td><?php echo html_escape($entry['student_name_snapshot']); ?></td>
                                                        <td>
                                                            <select class="form-control" name="attendance_status[<?php echo (int) $entry['student_id']; ?>]" required>
                                                                <option value="present" <?php echo $entry['attendance_status'] === 'present' ? 'selected' : ''; ?>>Present</option>
                                                                <option value="absent" <?php echo $entry['attendance_status'] === 'absent' ? 'selected' : ''; ?>>Absent</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input class="form-control" type="number" min="0" max="<?php echo html_escape($assessment['max_marks']); ?>" step="0.01" name="marks[<?php echo (int) $entry['student_id']; ?>]" value="<?php echo $entry['marks_obtained'] === NULL ? '' : html_escape($entry['marks_obtained']); ?>">
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="form-group">
                                            <label>Reason for Admin change (required)</label>
                                            <textarea class="form-control" name="reason" maxlength="2000" rows="2" required></textarea>
                                        </div>
                                        <button class="btn btn-primary" type="submit">Save Admin Changes</button>
                                    <?php echo form_close(); ?>
                                    <hr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <?php if ($submission['status'] === 'submitted'): ?>
                            <hr>
                            <h5>Allow institution to edit</h5>
                            <?php echo form_open('admin/internal-marks/reopen/' . (int) $submission['id']); ?>
                                <div class="form-group">
                                    <label for="reopen-reason">Reason (required)</label>
                                    <textarea class="form-control" id="reopen-reason" name="reason" maxlength="2000" rows="3" required></textarea>
                                </div>
                                <button class="btn btn-warning" type="submit">Allow Institution Edits</button>
                            <?php echo form_close(); ?>
                            <p class="text-muted">This explicitly unlocks the submission for the institution, even if the normal entry window has closed. The institution must submit again to lock the corrected marks.</p>
                        <?php elseif ($submission['status'] === 'reopened'): ?>
                            <div class="alert alert-info">The institution is currently allowed to edit this submission, including outside the normal entry window. It will lock again when the institution resubmits.</div>
                        <?php endif; ?>

                        <hr>
                        <h5>Audit history</h5>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead><tr><th>When</th><th>Actor</th><th>Action</th><th>Reason</th><th>Details / value changes</th></tr></thead>
                                <tbody>
                                <?php if (empty($audit)): ?>
                                    <tr><td colspan="5">No audit activity.</td></tr>
                                <?php else: ?>
                                    <?php foreach ($audit as $event): ?>
                                        <?php
                                        $audit_details = $event['details'] ? json_decode($event['details'], TRUE) : NULL;
                                        $audit_details = $audit_details === NULL
                                            ? ($event['details'] ?: '-')
                                            : json_encode($audit_details, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                                        ?>
                                        <tr>
                                            <td><?php echo html_escape($event['created_at']); ?></td>
                                            <td><?php echo html_escape(ucfirst($event['actor_type']) . ($event['actor_id'] ? ' #' . $event['actor_id'] : '')); ?></td>
                                            <td><?php echo html_escape(str_replace('_', ' ', ucfirst($event['action']))); ?></td>
                                            <td><?php echo nl2br(html_escape($event['reason'] ?: '-')); ?></td>
                                            <td><pre><?php echo html_escape($audit_details); ?></pre></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
