<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <?php if (!empty($message)): ?>
                    <div class="alert alert-<?php echo html_escape($message_type); ?>"><?php echo html_escape($message); ?></div>
                <?php endif; ?>
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Internal Marks Window</h4>
                        <p class="card-category"><?php echo html_escape($course . ' — ' . $session); ?></p>
                    </div>
                    <div class="card-body">
                        <p>
                            <a class="btn btn-outline-primary" href="<?php echo base_url('admin/internal-marks/configure'); ?>">Back to configured windows</a>
                        </p>

                        <h5><?php echo $window ? 'Edit window and component settings' : 'Create window and component settings'; ?></h5>
                        <?php echo form_open('admin/internal-marks/configure/save'); ?>
                            <input type="hidden" name="session" value="<?php echo html_escape($session); ?>">
                            <input type="hidden" name="course" value="<?php echo html_escape($course); ?>">
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
                            <p class="text-muted mt-2">Changes to assessment definitions are locked after marks have been entered. Window dates and availability may still be changed.</p>
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
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
