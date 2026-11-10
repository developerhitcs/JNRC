<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <?php if (!empty($message)): ?>
                    <div class="alert alert-<?php echo html_escape($message_type); ?>"><?php echo html_escape($message); ?></div>
                <?php endif; ?>
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Passed-out Registration Review</h4>
                        <p class="card-category">Review institution-verified student registration forms.</p>
                    </div>
                    <div class="card-body">
                        <p>
                            <a class="btn btn-primary" href="<?php echo base_url('admin/passed-out/sessions'); ?>">Manage Passed-out Sessions</a>
                            <span><?php echo (int) $total; ?> form(s)</span>
                        </p>
                        <form method="get" action="<?php echo base_url('admin/passed-out'); ?>">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Status</label>
                                    <select class="form-control" name="status">
                                        <option value="">All statuses</option>
                                        <?php foreach (array('submitted', 'approved', 'rejected', 'revision_requested', 'draft') as $status): ?>
                                            <option value="<?php echo $status; ?>" <?php echo $filters['status'] === $status ? 'selected' : ''; ?>><?php echo html_escape(ucwords(str_replace('_', ' ', $status))); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Passed-out session</label>
                                    <input class="form-control" name="session" value="<?php echo html_escape($filters['session']); ?>" placeholder="Example: 2020-22">
                                </div>
                                <div class="col-md-4">
                                    <label>Student / form / registration / institution code</label>
                                    <input class="form-control" name="search" value="<?php echo html_escape($filters['search']); ?>">
                                </div>
                                <div class="col-md-2"><button class="btn btn-primary" type="submit">Filter</button></div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Form No.</th>
                                        <th>Applicant</th>
                                        <th>Registration No.</th>
                                        <th>Institution</th>
                                        <th>Batch</th>
                                        <th>Registration as</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if (empty($records)): ?>
                                    <tr><td colspan="8">No registration forms match these filters.</td></tr>
                                <?php else: ?>
                                    <?php foreach ($records as $record): ?>
                                        <tr>
                                            <td><?php echo html_escape($record['form_number'] ?: '-'); ?></td>
                                            <td><?php echo html_escape($record['full_name']); ?></td>
                                            <td><?php echo html_escape($record['registration_number'] ?: '-'); ?></td>
                                            <td><?php echo html_escape($record['institution_name_snapshot']); ?> (<?php echo html_escape($record['school_code']); ?>)</td>
                                            <td><?php echo html_escape($record['session_label_snapshot']); ?></td>
                                            <td><?php echo html_escape($record['registration_type']); ?></td>
                                            <td><?php echo html_escape(ucwords(str_replace('_', ' ', $record['status']))); ?></td>
                                            <td><a class="btn btn-sm btn-info" href="<?php echo base_url('admin/passed-out/' . (int) $record['id']); ?>">Review</a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <form method="get" action="<?php echo base_url('admin/passed-out/export'); ?>">
                            <input type="hidden" name="status" value="<?php echo html_escape($filters['status']); ?>">
                            <input type="hidden" name="session" value="<?php echo html_escape($filters['session']); ?>">
                            <input type="hidden" name="search" value="<?php echo html_escape($filters['search']); ?>">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="export-start-date">Created from</label>
                                    <input class="form-control" id="export-start-date" type="date" name="start_date" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="export-end-date">Created through</label>
                                    <input class="form-control" id="export-end-date" type="date" name="end_date" required>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-success" type="submit">Export date range to Excel</button>
                                </div>
                            </div>
                        </form>
                        <?php if ($page > 1): ?>
                            <a class="btn btn-sm btn-outline-primary" href="<?php echo base_url('admin/passed-out?' . http_build_query(array_merge($filters, array('page' => $page - 1)))); ?>">Previous</a>
                        <?php endif; ?>
                        <?php if ($page < $pages): ?>
                            <a class="btn btn-sm btn-outline-primary" href="<?php echo base_url('admin/passed-out?' . http_build_query(array_merge($filters, array('page' => $page + 1)))); ?>">Next</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
