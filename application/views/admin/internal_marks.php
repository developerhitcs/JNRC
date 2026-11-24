<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <?php if (!empty($message)): ?>
                    <div class="alert alert-<?php echo html_escape($message_type); ?>"><?php echo html_escape($message); ?></div>
                <?php endif; ?>
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Internal Marks</h4>
                        <p class="card-category">Configure subject components and entry windows, review institution submissions, and export marks.</p>
                    </div>
                    <div class="card-body">
                        <p><a class="btn btn-primary" href="<?php echo base_url('admin/internal-marks/configure'); ?>">Configure Assessments &amp; Entry Windows</a></p>
                        <form method="get" action="<?php echo base_url('admin/internal-marks'); ?>">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Examination session / batch</label>
                                    <select class="form-control" name="session">
                                        <option value="">All sessions</option>
                                        <?php $sessions = array(); foreach ($contexts as $context) { $sessions[$context['session_label']] = $context['session_label']; } ?>
                                        <?php foreach ($sessions as $session): ?>
                                            <option value="<?php echo html_escape($session); ?>" <?php echo $filters['session'] === $session ? 'selected' : ''; ?>><?php echo html_escape($session); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Course / year</label>
                                    <select class="form-control" name="course">
                                        <option value="">All courses</option>
                                        <?php $courses = array(); foreach ($contexts as $context) { $courses[$context['course']] = $context['course']; } ?>
                                        <?php foreach ($courses as $course): ?>
                                            <option value="<?php echo html_escape($course); ?>" <?php echo $filters['course'] === $course ? 'selected' : ''; ?>><?php echo html_escape($course); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label>Institution</label>
                                    <select class="form-control" name="school_code">
                                        <option value="">All institutions</option>
                                        <?php foreach ($institutions as $institution): ?>
                                            <option value="<?php echo html_escape($institution['school_code']); ?>" <?php echo $filters['school_code'] === $institution['school_code'] ? 'selected' : ''; ?>>
                                                <?php echo html_escape($institution['school_name'] . ' (' . $institution['school_code'] . ')'); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label>Status</label>
                                    <select class="form-control" name="status">
                                        <option value="">All statuses</option>
                                        <?php foreach (array('draft', 'submitted', 'reopened') as $status): ?>
                                            <option value="<?php echo $status; ?>" <?php echo $filters['status'] === $status ? 'selected' : ''; ?>><?php echo html_escape(ucfirst($status)); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-2"><button class="btn btn-primary" type="submit">Filter</button></div>
                            </div>
                        </form>
                        <p class="mt-3">
                            <a class="btn btn-success" href="<?php echo base_url('admin/internal-marks/export?' . http_build_query($filters)); ?>">Export filtered marks to Excel-compatible CSV</a>
                        </p>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Session</th><th>Course</th><th>Institution</th>
                                        <th>Status</th><th>Saved entries</th><th>Updated</th><th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if (empty($submissions)): ?>
                                    <tr><td colspan="7">No internal marks submissions match these filters.</td></tr>
                                <?php else: ?>
                                    <?php foreach ($submissions as $submission): ?>
                                        <tr>
                                            <td><?php echo html_escape($submission['session_label']); ?></td>
                                            <td><?php echo html_escape($submission['course']); ?></td>
                                            <td><?php echo html_escape($submission['institution_name_snapshot'] . ' (' . $submission['school_code'] . ')'); ?></td>
                                            <td><?php echo html_escape(ucfirst($submission['status'])); ?></td>
                                            <td><?php echo (int) $submission['entry_count']; ?></td>
                                            <td><?php echo html_escape($submission['updated_at']); ?></td>
                                            <td><a class="btn btn-sm btn-info" href="<?php echo base_url('admin/internal-marks/submission/' . (int) $submission['id']); ?>">Review</a></td>
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
