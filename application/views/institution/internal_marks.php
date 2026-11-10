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
                        <p class="card-category">Select an examination session and course to enter marks for your institution's eligible students.</p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead><tr><th>Session</th><th>Course / year</th><th>Entry window</th><th>Status</th><th>Action</th></tr></thead>
                                <tbody>
                                <?php if (empty($contexts)): ?>
                                    <tr><td colspan="5">No internal marks entry windows are configured for your institution yet.</td></tr>
                                <?php else: ?>
                                    <?php foreach ($contexts as $context): ?>
                                        <?php
                                        $now = date('Y-m-d H:i:s');
                                        $open = (int) $context['is_open'] === 1 && $now >= $context['starts_at'] && $now <= $context['ends_at'];
                                        $submission = $context['submission'];
                                        ?>
                                        <tr>
                                            <td><?php echo html_escape($context['session_label']); ?></td>
                                            <td><?php echo html_escape($context['course']); ?></td>
                                            <td><?php echo html_escape($context['starts_at'] . ' to ' . $context['ends_at']); ?></td>
                                            <td>
                                                <?php if ($submission): ?>
                                                    <?php echo html_escape(ucfirst($submission['status'])); ?>
                                                <?php else: ?>
                                                    Not started
                                                <?php endif; ?>
                                                <?php if ($open): ?><span class="text-success"> (Open)</span><?php else: ?><span class="text-muted"> (Closed)</span><?php endif; ?>
                                            </td>
                                            <td>
                                                <a class="btn btn-sm <?php echo $open ? 'btn-primary' : 'btn-outline-secondary'; ?>" href="<?php echo base_url('institution/internal-marks/entry?' . http_build_query(array('session' => $context['session_label'], 'course' => $context['course']))); ?>">
                                                    <?php echo $submission && $submission['status'] === 'submitted' ? 'View' : 'Enter marks'; ?>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="alert alert-info">Final submission locks the marks. If corrections are needed after submission, contact JNRC to request reopening.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
