<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <?php if (!empty($message)): ?>
                    <div class="alert alert-<?php echo html_escape($message_type); ?>"><?php echo html_escape($message); ?></div>
                <?php endif; ?>
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Passed-out Registration Forms</h4>
                        <p class="card-category">Create registration applications for students who have completed their training.</p>
                    </div>
                    <div class="card-body">
                        <p><a class="btn btn-primary" href="<?php echo base_url('institution/passed-out/new'); ?>">New Registration Form</a></p>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Form No.</th>
                                        <th>Student</th>
                                        <th>Batch</th>
                                        <th>Registration as</th>
                                        <th>Status</th>
                                        <th>JNRC remark</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if (empty($records)): ?>
                                    <tr><td colspan="7">No registration forms have been created.</td></tr>
                                <?php else: ?>
                                    <?php foreach ($records as $record): ?>
                                        <tr>
                                            <td><?php echo html_escape($record['form_number'] ?: '-'); ?></td>
                                            <td><?php echo html_escape($record['full_name']); ?></td>
                                            <td><?php echo html_escape($record['session_label_snapshot']); ?></td>
                                            <td><?php echo html_escape($record['registration_type']); ?></td>
                                            <td><?php echo html_escape(ucwords(str_replace('_', ' ', $record['status']))); ?></td>
                                            <td><?php echo html_escape($record['review_remark'] ?: '-'); ?></td>
                                            <td>
                                                <a class="btn btn-sm btn-info" href="<?php echo base_url('institution/passed-out/view/' . (int) $record['id']); ?>">View</a>
                                                <?php if (in_array($record['status'], array('draft', 'rejected', 'revision_requested'), TRUE)): ?>
                                                    <a class="btn btn-sm btn-warning" href="<?php echo base_url('institution/passed-out/edit/' . (int) $record['id']); ?>">Edit</a>
                                                <?php else: ?>
                                                    <span class="text-muted">Locked for review</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <?php if ($page > 1): ?>
                            <a class="btn btn-sm btn-outline-primary" href="<?php echo base_url('institution/passed-out?page=' . ($page - 1)); ?>">Previous</a>
                        <?php endif; ?>
                        <?php if (count($records) === $limit): ?>
                            <a class="btn btn-sm btn-outline-primary" href="<?php echo base_url('institution/passed-out?page=' . ($page + 1)); ?>">Next</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
