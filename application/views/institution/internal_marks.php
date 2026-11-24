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
                            <table class="table table-hover internal-marks-context-table">
                                <thead>
                                    <tr>
                                        <th>Session / course</th>
                                        <th>Entry window</th>
                                        <th>Status</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if (empty($contexts)): ?>
                                    <tr><td colspan="4">No internal marks entry windows are configured for your institution yet.</td></tr>
                                <?php else: ?>
                                    <?php foreach ($contexts as $context): ?>
                                        <?php
                                        $now = date('Y-m-d H:i:s');
                                        $open = (int) $context['is_open'] === 1 && $now >= $context['starts_at'] && $now <= $context['ends_at'];
                                        if ((int) $context['is_open'] !== 1) {
                                            $window_status = 'Closed by JNRC';
                                        } elseif ($now < $context['starts_at']) {
                                            $window_status = 'Not started';
                                        } elseif ($now > $context['ends_at']) {
                                            $window_status = 'Closed';
                                        } else {
                                            $window_status = 'Open';
                                        }
                                        $submission = $context['submission'];
                                        $window_badge = $open ? 'badge-success' : ($window_status === 'Not started' ? 'badge-warning' : 'badge-secondary');
                                        $start_time = strtotime($context['starts_at']);
                                        $end_time = strtotime($context['ends_at']);
                                        ?>
                                        <tr>
                                            <td>
                                                <strong><?php echo html_escape($context['session_label']); ?></strong>
                                                <small class="d-block text-muted"><?php echo html_escape($context['course']); ?></small>
                                            </td>
                                            <td>
                                                <div class="internal-marks-window-date"><span>Opens</span><?php echo html_escape($start_time ? date('d M Y, g:i A', $start_time) : $context['starts_at']); ?></div>
                                                <div class="internal-marks-window-date"><span>Closes</span><?php echo html_escape($end_time ? date('d M Y, g:i A', $end_time) : $context['ends_at']); ?></div>
                                            </td>
                                            <td>
                                                <span class="badge <?php echo $window_badge; ?>">Window: <?php echo html_escape($window_status); ?></span>
                                                <?php if ($submission && $submission['status'] === 'submitted'): ?>
                                                    <span class="badge badge-info">Marks: submitted</span>
                                                    <small class="d-block text-muted">Ask JNRC Admin to reopen submitted marks for changes.</small>
                                                <?php elseif ($submission && $submission['status'] === 'reopened'): ?>
                                                    <span class="badge badge-warning">Marks: editing reopened</span>
                                                <?php elseif ($submission): ?>
                                                    <span class="badge badge-light">Marks: draft saved</span>
                                                    <?php if ($open): ?><small class="d-block text-muted">You can continue editing until the window closes.</small><?php endif; ?>
                                                <?php else: ?>
                                                    <span class="badge badge-light">Marks: not submitted</span>
                                                    <?php if ($open): ?><small class="d-block text-muted">You can enter and submit marks until the window closes.</small><?php endif; ?>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-right">
                                                <a class="btn btn-sm <?php echo ($open || ($submission && $submission['status'] === 'reopened')) ? 'btn-primary' : 'btn-outline-secondary'; ?>" href="<?php echo base_url('institution/internal-marks/entry?' . http_build_query(array('session' => $context['session_label'], 'course' => $context['course']))); ?>">
                                                    <?php
                                                    if ($submission && $submission['status'] === 'submitted') {
                                                        echo 'View submission';
                                                    } elseif ($submission && $submission['status'] === 'draft') {
                                                        echo 'Continue entry';
                                                    } elseif ($submission && $submission['status'] === 'reopened') {
                                                        echo 'Edit submission';
                                                    } elseif ($open) {
                                                        echo 'Enter marks';
                                                    } else {
                                                        echo 'View';
                                                    }
                                                    ?>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="alert alert-info">You can enter or edit drafts while the window is open. After submission, changes require JNRC Admin access.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .internal-marks-context-table th,
        .internal-marks-context-table td {
            vertical-align: middle;
        }

        .internal-marks-context-table th:first-child {
            min-width: 150px;
        }

        .internal-marks-context-table th:nth-child(2) {
            min-width: 210px;
        }

        .internal-marks-context-table th:nth-child(3) {
            min-width: 200px;
        }

        .internal-marks-window-date {
            white-space: nowrap;
        }

        .internal-marks-window-date span {
            display: inline-block;
            width: 52px;
            color: #777;
            font-size: 12px;
            text-transform: uppercase;
        }

        .internal-marks-context-table .badge {
            margin: 2px 3px 4px 0;
            padding: 6px 9px;
        }
    </style>
</div>
