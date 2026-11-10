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
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr><th>Roll No.</th><th>Student</th><th>Subject</th><th>Component</th><th>Max</th><th>Pass</th><th>Attendance</th><th>Marks</th></tr>
                                </thead>
                                <tbody>
                                <?php if (empty($entries)): ?>
                                    <tr><td colspan="8">No marks have been saved yet.</td></tr>
                                <?php else: ?>
                                    <?php foreach ($entries as $entry): ?>
                                        <tr>
                                            <td><?php echo html_escape($entry['roll_number_snapshot']); ?></td>
                                            <td><?php echo html_escape($entry['student_name_snapshot']); ?></td>
                                            <td><?php echo html_escape($entry['subject_code'] . ' — ' . $entry['subject_name_snapshot']); ?></td>
                                            <td><?php echo html_escape(ucfirst($entry['component'])); ?></td>
                                            <td><?php echo number_format((float) $entry['max_marks'], 2); ?></td>
                                            <td><?php echo number_format((float) $entry['pass_marks'], 2); ?></td>
                                            <td><?php echo html_escape(ucfirst($entry['attendance_status'])); ?></td>
                                            <td><?php echo $entry['marks_obtained'] === NULL ? '-' : number_format((float) $entry['marks_obtained'], 2); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                        <?php if ($submission['status'] === 'submitted'): ?>
                            <hr>
                            <h5>Reopen for institution correction</h5>
                            <?php echo form_open('admin/internal-marks/reopen/' . (int) $submission['id']); ?>
                                <div class="form-group">
                                    <label for="reopen-reason">Reason (required)</label>
                                    <textarea class="form-control" id="reopen-reason" name="reason" maxlength="2000" rows="3" required></textarea>
                                </div>
                                <button class="btn btn-warning" type="submit">Reopen Submission</button>
                            <?php echo form_close(); ?>
                            <p class="text-muted">The institution can edit after reopening only while the configured entry window is open.</p>
                        <?php elseif ($submission['status'] === 'reopened'): ?>
                            <div class="alert alert-info">This submission is reopened; the institution may edit it while its entry window is open.</div>
                        <?php endif; ?>

                        <hr>
                        <h5>Audit history</h5>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead><tr><th>When</th><th>Actor</th><th>Action</th><th>Reason</th></tr></thead>
                                <tbody>
                                <?php if (empty($audit)): ?>
                                    <tr><td colspan="4">No audit activity.</td></tr>
                                <?php else: ?>
                                    <?php foreach ($audit as $event): ?>
                                        <tr>
                                            <td><?php echo html_escape($event['created_at']); ?></td>
                                            <td><?php echo html_escape(ucfirst($event['actor_type'])); ?></td>
                                            <td><?php echo html_escape(str_replace('_', ' ', ucfirst($event['action']))); ?></td>
                                            <td><?php echo nl2br(html_escape($event['reason'] ?: '-')); ?></td>
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
