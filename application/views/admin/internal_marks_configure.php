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
                        <p class="card-category">Set theory/practical internal maxima and pass marks for each subject and control the submission window.</p>
                    </div>
                    <div class="card-body">
                        <p><a class="btn btn-outline-primary" href="<?php echo base_url('admin/internal-marks'); ?>">Back to submissions</a></p>
                        <form method="get" action="<?php echo base_url('admin/internal-marks/configure'); ?>">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Session</label>
                                    <select class="form-control" name="session" required>
                                        <option value="">Select</option>
                                        <?php $sessions = array(); foreach ($contexts as $context) { $sessions[$context['session_label']] = $context['session_label']; } ?>
                                        <?php foreach ($sessions as $session): ?>
                                            <option value="<?php echo html_escape($session); ?>" <?php echo $selected_session === $session ? 'selected' : ''; ?>><?php echo html_escape($session); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Course / year</label>
                                    <select class="form-control" name="course" required>
                                        <option value="">Select</option>
                                        <?php $courses = array(); foreach ($contexts as $context) { $courses[$context['course']] = $context['course']; } ?>
                                        <?php foreach ($courses as $course): ?>
                                            <option value="<?php echo html_escape($course); ?>" <?php echo $selected_course === $course ? 'selected' : ''; ?>><?php echo html_escape($course); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-4"><button class="btn btn-primary" type="submit">Load Subjects</button></div>
                            </div>
                        </form>

                        <?php if ($selected_session !== '' && $selected_course !== ''): ?>
                            <hr>
                            <form method="post" action="<?php echo base_url('admin/internal-marks/configure/save'); ?>">
                                <input type="hidden" name="session" value="<?php echo html_escape($selected_session); ?>">
                                <input type="hidden" name="course" value="<?php echo html_escape($selected_course); ?>">
                                <h5><?php echo html_escape($selected_course . ' — ' . $selected_session); ?></h5>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="marks-start">Entry opens</label>
                                        <input class="form-control" id="marks-start" type="datetime-local" name="starts_at" required value="<?php echo !empty($window['starts_at']) ? html_escape(str_replace(' ', 'T', substr($window['starts_at'], 0, 16))) : ''; ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="marks-end">Entry deadline</label>
                                        <input class="form-control" id="marks-end" type="datetime-local" name="ends_at" required value="<?php echo !empty($window['ends_at']) ? html_escape(str_replace(' ', 'T', substr($window['ends_at'], 0, 16))) : ''; ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check mt-4">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="is_open" value="1" <?php echo !empty($window['is_open']) ? 'checked' : ''; ?>>
                                                Allow institution entry during this window
                                                <span class="form-check-sign"><span class="check"></span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-muted mt-2">Only configured components can be entered. Changes to component settings are locked after marks have been saved; window dates and availability may still be changed.</p>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm">
                                        <thead>
                                            <tr><th>Subject</th><th>Component</th><th>Enabled</th><th>Maximum</th><th>Pass mark</th></tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($subjects as $subject): ?>
                                            <?php foreach (array('theory', 'practical') as $component): ?>
                                                <?php $config = $subject['components'][$component]; ?>
                                                <tr>
                                                    <?php if ($component === 'theory'): ?>
                                                        <td rowspan="2"><?php echo html_escape($subject['subject_code'] . ' — ' . $subject['subject_name']); ?></td>
                                                    <?php endif; ?>
                                                    <td><?php echo html_escape(ucfirst($component)); ?></td>
                                                    <td>
                                                        <input type="checkbox" name="assessments[<?php echo (int) $subject['id']; ?>][<?php echo $component; ?>][enabled]" value="1" <?php echo !empty($config['is_enabled']) ? 'checked' : ''; ?>>
                                                    </td>
                                                    <td><input class="form-control" type="number" min="0.01" step="0.01" name="assessments[<?php echo (int) $subject['id']; ?>][<?php echo $component; ?>][max_marks]" value="<?php echo html_escape($config['max_marks']); ?>"></td>
                                                    <td><input class="form-control" type="number" min="0" step="0.01" name="assessments[<?php echo (int) $subject['id']; ?>][<?php echo $component; ?>][pass_marks]" value="<?php echo html_escape($config['pass_marks']); ?>"></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <button class="btn btn-success" type="submit">Save Configuration</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
