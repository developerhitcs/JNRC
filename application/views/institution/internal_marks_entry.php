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
                            <div class="alert alert-success">
                                Submitted and locked<?php echo $submission['submitted_at'] ? ' on ' . html_escape($submission['submitted_at']) : ''; ?>.
                                The entry window may remain open until <?php echo html_escape($context['ends_at']); ?>, but this submission cannot be edited unless JNRC Admin reopens it.
                            </div>
                        <?php elseif ($submission && $submission['status'] === 'reopened'): ?>
                            <div class="alert alert-warning">
                                JNRC Admin has allowed corrections<?php if (!empty($submission['reopen_reason'])): ?>: <?php echo nl2br(html_escape($submission['reopen_reason'])); ?><?php endif; ?>.
                                Your edits are being audited; resubmit to lock the corrected marks.
                            </div>
                        <?php elseif (!$window_open): ?>
                            <div class="alert alert-warning">The entry window is closed or has not started. You can view saved marks but cannot make changes.</div>
                        <?php endif; ?>
                        <form method="get" action="<?php echo base_url('institution/internal-marks/entry'); ?>" class="mb-4">
                            <input type="hidden" name="session" value="<?php echo html_escape($context['session_label']); ?>">
                            <input type="hidden" name="course" value="<?php echo html_escape($context['course']); ?>">
                            <div class="row align-items-end">
                                <div class="col-md-8">
                                    <label for="student-identifier">Student roll number or exam reference number</label>
                                    <input id="student-identifier" class="form-control" type="text" name="student_identifier" value="<?php echo html_escape($student_identifier); ?>" autocomplete="off" required>
                                    <small class="form-text text-muted">The number is matched against this institution’s exam forms for the selected session and course.</small>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-primary" type="submit">Find Student</button>
                                </div>
                            </div>
                        </form>
                        <?php if ($student_lookup_error !== ''): ?>
                            <div class="alert alert-warning"><?php echo html_escape($student_lookup_error); ?></div>
                        <?php endif; ?>
                        <h5>Students added to this session</h5>
                        <p class="text-muted">Select a student to open their configured subject components and marks.</p>
                        <?php if (empty($students)): ?>
                            <div class="alert alert-warning">No eligible exam-form students with assigned roll numbers were found for this institution, session, and course.</div>
                        <?php else: ?>
                            <div class="table-responsive mb-4">
                                <table class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr><th>Roll No.</th><th>Exam Reference</th><th>Student</th><th>Father's Name</th><th>Action</th></tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($students as $roster_student): ?>
                                        <?php
                                        $roster_identifier = !empty($roster_student['ref_no'])
                                            ? $roster_student['ref_no']
                                            : $roster_student['admit_card_roll_no'];
                                        $is_current_student = $student && (int) $student['id'] === (int) $roster_student['id'];
                                        ?>
                                        <tr class="<?php echo $is_current_student ? 'table-active' : ''; ?>">
                                            <td><?php echo html_escape($roster_student['admit_card_roll_no']); ?></td>
                                            <td><?php echo html_escape($roster_student['ref_no']); ?></td>
                                            <td><?php echo html_escape($roster_student['name']); ?></td>
                                            <td><?php echo html_escape($roster_student['father_name']); ?></td>
                                            <td>
                                                <a class="btn btn-sm <?php echo $is_current_student ? 'btn-secondary' : 'btn-primary'; ?>" href="<?php echo base_url('institution/internal-marks/entry?' . http_build_query(array(
                                                    'session' => $context['session_label'],
                                                    'course' => $context['course'],
                                                    'student_identifier' => $roster_identifier
                                                ))); ?>">
                                                    <?php echo $submission && $submission['status'] === 'submitted' ? 'View' : ($is_current_student ? 'Selected' : 'Enter marks'); ?>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                        <?php if ($student): ?>
                            <div class="table-responsive mb-4">
                                <table class="table table-bordered table-sm">
                                    <tbody>
                                        <tr>
                                            <th>Student Name</th>
                                            <td><?php echo html_escape($student['name']); ?></td>
                                            <th>Roll No.</th>
                                            <td><?php echo html_escape($student['admit_card_roll_no']); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Exam Reference</th>
                                            <td><?php echo html_escape($student['ref_no']); ?></td>
                                            <th>Father's Name</th>
                                            <td><?php echo html_escape($student['father_name']); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                        <?php if (empty($assessments)): ?>
                            <div class="alert alert-warning">No assessment components are configured for this course and session. Contact JNRC.</div>
                        <?php elseif ($student): ?>
                            <h5>Configured subject components</h5>
                            <p class="text-muted">Only components enabled by JNRC for this session and course are listed.</p>
                            <?php
                            $subject_rowspans = array();
                            foreach ($assessments as $assessment) {
                                $subject_id = (int) $assessment['subject_id'];
                                $subject_rowspans[$subject_id] = isset($subject_rowspans[$subject_id])
                                    ? $subject_rowspans[$subject_id] + 1
                                    : 1;
                            }
                            $rendered_subjects = array();
                            ?>
                            <?php echo form_open('institution/internal-marks/save'); ?>
                                <input type="hidden" name="session" value="<?php echo html_escape($context['session_label']); ?>">
                                <input type="hidden" name="course" value="<?php echo html_escape($context['course']); ?>">
                                <input type="hidden" name="student_id" value="<?php echo (int) $student['id']; ?>">
                                <input type="hidden" name="student_identifier" value="<?php echo html_escape($student_identifier); ?>">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm">
                                        <thead>
                                            <tr>
                                                <th>Subject</th>
                                                <th>Component</th>
                                                <th>Attendance</th>
                                                <th>Maximum</th>
                                                <th>Pass mark</th>
                                                <th>Marks obtained</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($assessments as $assessment): ?>
                                            <?php
                                            $assessment_id = (int) $assessment['id'];
                                            $subject_id = (int) $assessment['subject_id'];
                                            $entry = isset($entries[$assessment_id]) ? $entries[$assessment_id] : NULL;
                                            ?>
                                            <tr>
                                                <?php if (!isset($rendered_subjects[$subject_id])): ?>
                                                    <th rowspan="<?php echo (int) $subject_rowspans[$subject_id]; ?>" style="vertical-align: middle;">
                                                        <?php echo html_escape($assessment['subject_code'] . ' — ' . $assessment['subject_name_snapshot']); ?>
                                                    </th>
                                                    <?php $rendered_subjects[$subject_id] = TRUE; ?>
                                                <?php endif; ?>
                                                <td><?php echo html_escape(ucfirst($assessment['component'])); ?></td>
                                                <td>
                                                    <select class="form-control" name="attendance_status[<?php echo $assessment_id; ?>]" <?php echo !$institution_edit_allowed ? 'disabled' : ''; ?>>
                                                        <?php if (!$entry): ?>
                                                            <option value="" selected>Not entered</option>
                                                        <?php endif; ?>
                                                        <option value="present" <?php echo $entry && $entry['attendance_status'] === 'present' ? 'selected' : ''; ?>>Present</option>
                                                        <option value="absent" <?php echo $entry && $entry['attendance_status'] === 'absent' ? 'selected' : ''; ?>>Absent</option>
                                                    </select>
                                                </td>
                                                <td><?php echo number_format((float) $assessment['max_marks'], 2); ?></td>
                                                <td><?php echo number_format((float) $assessment['pass_marks'], 2); ?></td>
                                                <td>
                                                    <input class="form-control" type="number" min="0" max="<?php echo html_escape($assessment['max_marks']); ?>" step="0.01" name="marks[<?php echo $assessment_id; ?>]" value="<?php echo $entry && $entry['marks_obtained'] !== NULL ? html_escape($entry['marks_obtained']) : ''; ?>" <?php echo !$institution_edit_allowed ? 'disabled' : ''; ?>>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php if ($institution_edit_allowed): ?>
                                    <button class="btn btn-secondary" type="submit" name="action" value="draft">Save Draft</button>
                                    <button class="btn btn-success" type="submit" name="action" value="submit" onclick="return confirm('Lock the complete institution submission? This only succeeds after every configured component is filled for every eligible student.');">Submit All &amp; Lock</button>
                                    <p class="form-text text-muted">You can save a draft with some components still blank. Final submission locks all marks and is available only after every configured component is complete for all eligible students.</p>
                                <?php endif; ?>
                            <?php echo form_close(); ?>
                        <?php elseif ($student_identifier === '' && !empty($assessments)): ?>
                            <div class="alert alert-info">Enter a student roll number or exam reference number to load the exam-form details and configured subjects.</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
