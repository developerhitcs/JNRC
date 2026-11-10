<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <?php if (!empty($message)): ?>
                    <div class="alert alert-<?php echo html_escape($message_type); ?>"><?php echo html_escape($message); ?></div>
                <?php endif; ?>
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Passed-out Sessions</h4>
                        <p class="card-category">Visible sessions appear in the institution form. Existing submissions keep their saved session text.</p>
                    </div>
                    <div class="card-body">
                        <p><a class="btn btn-outline-primary" href="<?php echo base_url('admin/passed-out'); ?>">Back to registration review</a></p>
                        <h5>Add Session</h5>
                        <?php echo form_open('admin/passed-out/sessions/save'); ?>
                            <input type="hidden" name="session_id" value="0">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Session label (example: 2020-22)</label>
                                    <input class="form-control" name="session_label" maxlength="100" required>
                                </div>
                                <div class="col-md-3">
                                    <label>Show to institutions</label>
                                    <select class="form-control" name="is_visible">
                                        <option value="1">Visible</option>
                                        <option value="0">Hidden</option>
                                    </select>
                                </div>
                                <div class="col-md-3"><button class="btn btn-success" type="submit">Add Session</button></div>
                            </div>
                        <?php echo form_close(); ?>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead><tr><th>Session</th><th>Visibility</th><th>Update</th><th>Delete</th></tr></thead>
                                <tbody>
                                <?php if (empty($sessions)): ?>
                                    <tr><td colspan="4">No sessions configured.</td></tr>
                                <?php else: ?>
                                    <?php foreach ($sessions as $session): ?>
                                        <tr>
                                            <td>
                                                <?php echo form_open('admin/passed-out/sessions/save', array('id' => 'session-form-' . (int) $session['id'])); ?>
                                                <input type="hidden" name="session_id" value="<?php echo (int) $session['id']; ?>">
                                                <?php echo form_close(); ?>
                                                <input class="form-control" form="session-form-<?php echo (int) $session['id']; ?>" name="session_label" maxlength="100" required value="<?php echo html_escape($session['session_label']); ?>">
                                            </td>
                                            <td>
                                                <select class="form-control" form="session-form-<?php echo (int) $session['id']; ?>" name="is_visible">
                                                    <option value="1" <?php echo $session['is_visible'] ? 'selected' : ''; ?>>Visible</option>
                                                    <option value="0" <?php echo !$session['is_visible'] ? 'selected' : ''; ?>>Hidden</option>
                                                </select>
                                            </td>
                                            <td><button class="btn btn-sm btn-primary" form="session-form-<?php echo (int) $session['id']; ?>" type="submit">Save</button></td>
                                            <td>
                                                <?php echo form_open('admin/passed-out/sessions/save'); ?>
                                                    <input type="hidden" name="session_id" value="<?php echo (int) $session['id']; ?>">
                                                    <input type="hidden" name="action" value="delete">
                                                    <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Delete this session from the selection list? Existing forms retain their saved session.');">Delete</button>
                                                <?php echo form_close(); ?>
                                            </td>
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
