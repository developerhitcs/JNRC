<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <?php if (!empty($message)): ?>
                    <div class="alert alert-<?php echo html_escape($message_type); ?>"><?php echo html_escape($message); ?></div>
                <?php endif; ?>
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Internal Marks Configuration</h4>
                        <p class="card-category">Choose a session and course to create or edit its assessment and entry-window configuration.</p>
                    </div>
                    <div class="card-body">
                        <p><a class="btn btn-outline-primary" href="<?php echo base_url('admin/internal-marks'); ?>">Back to submissions</a></p>
                        <h5>Configured entry windows</h5>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr><th>Session</th><th>Course / year</th><th>Entry opens</th><th>Deadline</th><th>Window status</th><th>Enabled components</th><th>Action</th></tr>
                                </thead>
                                <tbody>
                                <?php if (empty($configured_windows)): ?>
                                    <tr><td colspan="7">No windows saved yet. Select a session and course below to configure one.</td></tr>
                                <?php else: ?>
                                    <?php foreach ($configured_windows as $configured_window): ?>
                                        <tr>
                                            <td><?php echo html_escape($configured_window['session_label']); ?></td>
                                            <td><?php echo html_escape($configured_window['course']); ?></td>
                                            <td><?php echo html_escape($configured_window['starts_at']); ?></td>
                                            <td><?php echo html_escape($configured_window['ends_at']); ?></td>
                                            <td><?php echo (int) $configured_window['is_open'] === 1 ? 'Enabled' : 'Disabled'; ?></td>
                                            <td><?php echo (int) $configured_window['enabled_component_count']; ?></td>
                                            <td>
                                                <a class="btn btn-sm btn-primary" href="<?php echo base_url('admin/internal-marks/configure/edit?' . http_build_query(array('session' => $configured_window['session_label'], 'course' => $configured_window['course']))); ?>">
                                                    View / Edit
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <h5>Create or open a configuration</h5>
                        <p class="text-muted">Select a session and course, then click Load Subjects. On the next page, set the window dates, enable at least one component, enter its maximum and pass marks, and click Save Configuration.</p>
                        <form method="get" action="<?php echo base_url('admin/internal-marks/configure/edit'); ?>">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Session</label>
                                    <select class="form-control" name="session" required>
                                        <option value="">Select</option>
                                        <?php $sessions = array(); foreach ($contexts as $context) { $sessions[$context['session_label']] = $context['session_label']; } ?>
                                        <?php foreach ($sessions as $session): ?>
                                            <option value="<?php echo html_escape($session); ?>"><?php echo html_escape($session); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Course / year</label>
                                    <select class="form-control" name="course" required>
                                        <option value="">Select</option>
                                        <?php $courses = array(); foreach ($contexts as $context) { $courses[$context['course']] = $context['course']; } ?>
                                        <?php foreach ($courses as $course): ?>
                                            <option value="<?php echo html_escape($course); ?>"><?php echo html_escape($course); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-4"><button class="btn btn-primary" type="submit">Load Subjects</button></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
